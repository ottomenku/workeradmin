<?php

namespace App;


use App\Worker;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Facades\CalendarHandler;
class Stored extends Model
{
    //use LogsActivity;
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'storeds';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ceg_id', 'user_id', 'worker_id', 'datum', 'name', 'note', 'fulldata', 'solverdata', 'lezarva', 'pub'];

    /**
     * workert és managert is kiszolgál
     */ 
    public function getStoreds($data)
    {
        $storeds = [];
        $data= CalendarHandler::getYearMonth($data);
        $storedob = new Stored();
        $user=\Auth::user();
        $res=[];
        
        if ($user->hasRole('worker')) {
          //  $worker = Worker::where('user_id', \Auth::user()->id)->first();
            $data['workerid'] = $user->getWorkerid();
            $storeds = $storedob->with('worker')->where([['datum', 'like', $data['year'] . '-' . $data['month']. '%'],['worker_id', '=', $data['workerid']]])->get();
        } else {  
                $storeds = $storedob->with('worker')->where([['datum', 'like', $data['year']. '-' . $data['month']. '%'], ['ceg_id', '=', $user->getCegid()]])->get();
        }
        foreach ($storeds as $stored) {$res[$stored->id] = $stored;}
        return $res;
    }
    /**
     * adminnnak cégenként
     */
    public function getAdminStoreds($data)
    {
        $storeds = [];
        $data= CalendarHandler::getYearMonth($data);
        $storedob = new Stored();
        //$user=\Auth::user();
        $res=[];
        $cegid=$data['viewparid'] ?? 1;
        $storeds = $storedob->with('worker')->where([['datum', 'like', $data['year']. '-' . $data['month']. '%'], ['ceg_id', '=', $cegid]])->get();
        
        foreach ($storeds as $stored) {$res[$stored->id] = $stored;}
        return $res;
    }
    public function idToKey($data)
    {
        $res=[];
        foreach ($data as $val) {
           foreach ($val as $key=>$value) { 
            $res[$key]=$value;
           }
        }
        return $res;
    }
/**
 * nem kell jogosultság vizsgálat mert csak a manager configból érhető el
 * ha le van zárva vagy ujat csinál, hanincs frissít
 * h
 */
    public function storeStored($data)
    {
        $data=CalendarHandler::getYearMonth($data);

        $Time = new Time();
        $times  = $Time->getTimes($data);
        $Day = new Day();
        $workerdays  = $Day->getDays($data) ; 
        //$DATA= CalendarHandler::getBaseCalendarData($data);
       

    foreach ($data['workerids'] as $workerid) {
       $worker = Worker::where('id',$workerid)->first();
           // $worker = Worker::findOrf($workerid);
          //  $data['user_id'] = $worker->user_id;
            $wheredata['user_id'] = $worker->user_id;
            $wheredata['worker_id'] = $workerid;
            $wheredata['ceg_id'] = $worker->ceg_id;
            $wheredata['datum'] = $data['year']. '-' . $data['month'] . '-01';-
            $wheredata['lezarva'] = false;
            $stored = $this->where($wheredata)->first();

            $fulldata = CalendarHandler::getBaseCalendarData($data);

            $fulldata['times']['datekey'][$workerid]=$times['datekey'][$workerid] ?? [];
            $fulldata['times']['idkey']= $this->idToKey($times['datekey'][$workerid] ?? []);
            $fulldata['workerdays']['datekey'][$workerid]=$workerdays['datekey'][$workerid] ?? [];
            $fulldata['workerdays']['idkey']= $this->idToKey($workerdays['datekey'][$workerid] ?? []);
            $fulldata['worker_id'] = $workerid;
            $Idata['fulldata'] =json_encode($fulldata);
            $Idata['solverdata'] = json_encode($this->getSolverData($fulldata));

            if ($stored) {$stored->update(['fulldata' => $Idata['fulldata'], 'solverdata' =>$Idata['solverdata']]);}
             else {
                $Idata['name'] = $data['year'] . '-' . $data['month'] . '-' . $worker->id;
                $Idata['worker_id'] =  $workerid;
                $Idata['user_id'] = $worker->user_id;
                $Idata['ceg_id'] = $worker->ceg_id;
                $Idata['datum'] = $data['year']. '-' . $data['month'] . '-01';
                $this->create($Idata);

            }
     }
}
/**
 * ha le van zárva nem törli
 */
public function delStored($data) //
{
    $stored=$this->findOrFail($data['id']);
    if($stored['lezarva'] == false)
    {$this->destroy($data['id']); }//lehet tömb is
  
}
public function zarStored($data)
{
    $stored = $this->find($data['id']);
    $stored->update(['lezarva' => true]);
   // return $this->getStoreds($data);

}
public function nyitStored($data)
{
    $stored = $this->find($data['id']);
    $stored->update(['lezarva' =>false]);
}




    public function getSolverData($fulldata)
    {
        $solver = [];
        $sumWorkerdays = 0;
        foreach ($fulldata['calendarbase'] as $key => $value) {
            if ($value['munkanap']) {$solver['workerdays'][] = $value['day'];
                $sumWorkerdays++;}
        }
        $solver['sumWorkerdays'] = $sumWorkerdays;
        foreach ($fulldata['times']['idkey'] as $key => $value) {
            if ($value['pub'] > 5) {
                $solver['times'][$value['timetype']['name']]['hours'][] = substr($value['datum'], -2) . '.(' . $value['hour'] . '), ';
                $solver['times'][$value['timetype']['name']]['sumhours'] = $solver['times'][$value['timetype']['name']]['sumhours'] ?? 0;
                $solver['times'][$value['timetype']['name']]['sumhours'] = $solver['times'][$value['timetype']['name']]['sumhours'] + $value['hour'];
            }
        }
        foreach ($fulldata['workerdays']['idkey'] as $key => $value) {
            if ($value['pub'] > 5) {
                $solver['days'][$value['daytype']['name']]['days'][] = substr($value['datum'], -2);
                $solver['days'][$value['daytype']['name']]['sumdays'] = $solver['days'][$value['daytype']['name']]['sumdays'] ?? 0;
                $solver['days'][$value['daytype']['name']]['sumdays'] = $solver['days'][$value['daytype']['name']]['sumdays'] + 1;
            }
        }

        return $solver;
    }

   



    public function show($id)
    {
        return $this->findOrfalse($id);
    }


    public function ceg()
    {
        return $this->belongsTo('App\Ceg');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function worker()
    {
        return $this->belongsTo('App\Worker');
    }
}
