<?php

namespace App;

use App\Handlers\CalendarHandler;
use App\Worker;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Storedi extends Model
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

    public function getStoredsData($year2 = null, $month2 = null, $cegid = 'worker')
    {
        $data = [];
        $storeds = [];
        $year = $year2 ?? Carbon::now()->year;
        $month = $month2 ?? Carbon::now()->month;
        $storedob = new Stored();
        if (strlen($month) < 2) {$month = '0' . $month;}
        if ($cegid == 'worker') {
          //  $worker = Worker::where('user_id', \Auth::user()->id)->first();
            $data['workerid'] = \Auth::user()->getWorkerid();
            $storeds = $storedob->with('worker')->where([['datum', 'like', $year . '-' . $month . '%'], ['worker_id', '=', $data['workerid']]])->get();
        } else {
            if ( \Auth::user()->hasCegid($cegid)) {
                $data['cegid'] = $cegid;
                $storeds = $storedob->with('worker')->where([['datum', 'like', $year . '-' . $month . '%'], ['ceg_id', '=', $cegid]])->get();
            }  
        }
        foreach ($storeds as $stored) {$data[$stored->id] = $stored;}
        return $data;
    }

 

    public function CreateFromData($data)
    {
        return $this->moCreate($data['ev'], $data['ho'], $data['workerids'], $data = []);
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

    public function moCreate($ev, $ho, $workerids = [])
    {
        if (!is_array($workerids)) {$workerids2[] = $workerids;} else { $workerids2 = $workerids;}
        foreach ($workerids2 as $workerid) {
            $data = [];
            $worker = Worker::find($workerid);
            $data['user_id'] = $worker->user_id;
            $data['worker_id'] = $workerid;
            $data['ceg_id'] = $worker->ceg_id;
            $data['datum'] = $ev . '-' . $ho . '-01';-
            $data['lezarva'] = false;
            $stored = $this->where($data)->first();

            $fulldata = \CalendarHandler::getWorkerCalendarData($workerid, $ev, $ho);
            $fulldata['worker_id'] = $workerid;
            $data['fulldata'] = json_encode($fulldata);
            $data['solverdata'] = json_encode($this->getSolverData($fulldata));

            if ($stored) {$stored->update(['fulldata' => $data['fulldata'], 'solverdata' => $data['solverdata']]);} else {
                $data['name'] = $ev . '-' . $ho . '-' . $worker->vorkername;
                $this->create($data);
            }
            // $data['name']=$ev.'-'.$ho.'-'.$workers->vorkername;
            // $this->updateOrCreate($data,['fulldata'=>json_encode($fulldata),'name'=>$ev.'-'.$ho.'-'.$workers->vorkername]);
        }
        return $this->showAdminList($ev, $ho);

    }

    public function lezarStoredFromPost($data)
    {
        $stored = $this->findOrfalse($data['id']);
        $stored->update(['lezarva' => true]);
        return $this->showAdminList($data['ev'], $data['ho']);

    }

    public function delStoredFromPost($data) //

    {
        $this->destroy($data['id']); //lehet tömb is
        return $this->showAdminList($data['ev'], $data['ho']);
    }
    public function show($id)
    {
        return $this->findOrfalse($id);
    }

    public function showWorkerList($year = null, $month = null)
    { 
        return $this->getStoredsData($year, $month);
    }

    public function showAdminList($year = null, $month = null)
    {
        $cegid = \Auth::user()->getCegid(); 
        $data=$this->getStoredsData($year,$month,$cegid);;
        return $data;

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
