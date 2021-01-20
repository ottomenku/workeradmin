<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class TimeOld extends Model
{
    use LogsActivity;
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'times';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';
    protected $temp=[] ;
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['worker_id', 'timetype_id','datum', 'start', 'end', 'hour','adnote', 'worknote','pub'];
  /*   public function findTimeWithLists($id)
    {
        $data=$this->with('worker')->find($id)->toarray();
        $data=$this->getLists($data);
      return $data; 
    }*/

    public function timesToArr($times,$res=[])
    {
        foreach($times as $time){
            if($time->pub==0){$class='prescribed';}
              elseif($time->pub==1){$class='new';}
              elseif($time->pub>1){$class='allowed';}
              else{$class='notallowed';}
            $timeArr=$time->toarray();
            $timeArr['start']=substr($time->start,0,5);
             $timeArr['end']=substr($time->end,0,5);
            $timeArr['class']=$class;
            $res['datekey'][$time->worker_id][$time->datum][$time->id]=$timeArr;
            $res['idkey'][$time->id]=$timeArr;
        }
                                              
        return $res;
    }
    
    /**
     * adott dolgozó adott hónapjának napjai
     */
    public function getTimesYearMounth($workerid,$year='0',$month='0')
    { 
        $res=[];
        if(empty($year)){$year= Carbon::now()->year;}
        if(empty($month)) {$month= Carbon::now()->month;}
        if(strlen($month)<2){$month='0'.$month;}
        $start= $year.'-'.$month.'-01';
        $end=\CalendarHandler::getEndFromMonth($year,$month); 
        return $this->getTimesFlexi($workerid,$start,$end);
       
    }

  /**
     * adott dolgozó adott időszakának napjai
     */
    public function getTimesFlexi($workerid,$start='0',$end='0')
    { 
        $res['idkey']=[];
        $res['datekey']=[];
        $year= Carbon::now()->year;
        $month= Carbon::now()->month;
        if(empty($start)){$start= $year.'-'.$month.'-01';}
        if(empty($end)) {$end=\CalendarHandler::getEndFromMonth($year,$month); }  

       

        if(is_array($workerid)){
            foreach($workerid as $wid){
                $times= $this->with('timetype')->where([ ['datum', '>=', $start],['datum', '<=', $end],['worker_id', '=', $wid]])->get();        
                $res=$this->timesToArr($times,$res);
               // $res=array_merge($res,$res1);
            }
            return $res;
        }else{
            $times= $this->with('timetype')->where([ ['datum', '>=', $start],['datum', '<=', $end],['worker_id', '=', $workerid]])->get();            
          //  return $this->timesToArr($times,$res);
          return $this->timesToArr($times,$res);
        }
    }
    public function getTimes($workerid,$yearOrstart=0,$monthOrEnd=0)
    {
         $res=[];
        if(strlen($yearOrstart)<5 && strlen($monthOrEnd)<5 ){ 
          $res=   $this->getTimesYearMounth($workerid,$yearOrstart,$monthOrEnd);
        }
        else{$res= $this->getTimesFlexi($workerid,$yearOrstart,$monthOrEnd);  }
    return $res;  
    }

//worker-------------------------------------------------------------------------
/**
 * a weorker saját idejei az adott hónapban
 */
public function getWorkTimes($year='0',$month='0')
{
    $res=[];
    $worker=Worker::where('user_id', \Auth::user()->id)->first();
    $times= $this->getTimes($worker->id,$year,$month);
$res['datekey']=$times['datekey'][$worker->id];
$res['idkey']=$times['idkey'];
return $res;
}
public function updatetimesWorker($data) // a datum tömb kelle legyen
{  
    $worker=Worker::where('user_id', \Auth::user()->id)->first();
   $workerid=$worker->id;   
   foreach($data['ids'] as $id )
       {           
          // $data['datum']= $datum;
         $time= $this->findOrFail($id);
         if($time && $time->worker_id==$workerid && $time->pub==1){
            $time->update($data);
         }

       }

     return  $this->getWorkTimes($data['ev'],$data['ho']);
}

public function storetimesWorker($data) // a datum tömb kelle legyen
{  
    $worker=Worker::where('user_id', \Auth::user()->id)->first();
   $data['worker_id']=$worker->id;   
   foreach($data['datums'] as $datum )
       {           
           $data['datum']= $datum;
           $this->create($data);
       }

     return  $this->getWorkTimes($data['ev'],$data['ho']);
}



 //admin simple----------------------------------------
 public function storetimesManSimple($data) // a datum tömb kelle legyen
 { 
     $man=\Auth::user();
     $mancegid= Ceg::where('user_id',$man->id)->first()->id;
    
    foreach($data['workerids'] as $workerid )
     { 
         $worker=Worker::findOrFail($workerid);
         if($worker->ceg_id == $mancegid);
          {
                foreach($data['datums'] as $datum )
             {    
                $data['worker_id']=$workerid; 
                $data['pub']= 10;       
                 $data['datum']= $datum;
                $this->create($data);   
             }
          }
       
     }
      return  $this->getWorkTimesToMan($data['ev'],$data['ho']);
 }

 public function  deltimeMan($data) // a datum tömb kelle legyen
{  
    $man=\Auth::user();
    $mancegid= Ceg::where('user_id',$man->id)->first()->id;
    $time=$this->findOrFail($data['id']);
    $worker=Worker::findOrFail($time->worker_id);
    if($worker->ceg_id == $mancegid); {  $time->delete();}   
    return  $this->getWorkTimesToMan($data['ev'],$data['ho']);
}
public function timesResetMan($data) // a datum tömb kelle legyen
{  
    $man=\Auth::user();
    $mancegid= Ceg::where('user_id',$man->id)->first()->id;
    foreach($data['workerids'] as $workerid )
    { 
        $worker=Worker::findOrFail($workerid);
        if($worker->ceg_id == $mancegid);
         {
            foreach($data['datums'] as $datum )
            {           
               $times= $this->where([['worker_id',$workerid ],['datum',$datum ],['pub',10 ]])->get();
               foreach($times as $time )
                {          
                 $time->delete();
                }
            }
        }
    }
     return  $this->getWorkTimesToMan($data['ev'],$data['ho']);
}
public function updateWorkerTime($id,$data)
{
    $worker=Worker::where('user_id', \Auth::user()->id);
    $Time = $this->findOrFail($id);
    if($Time->pub>=0 && $Time->pub<20 && $worker->id==$Time->worker_id )
    {
        $Time->update($data); 
    }
}
 //admin----------------------------------------
 /**
 * A manager cégének összes munkaidő bejegyzése dolgozónként csoportosítva 
 */
public function getWorkTimesToMan($year=null,$month=null)
{
    $res=[];
   $user=\Auth::user();
   $cegid= Ceg::where('user_id',$user->id)->first()->id; 
   $workers= Worker::where('ceg_id', $cegid)->pluck('id')->toarray()  ;
   return $this->getTimes($workers,$year,$month);                                    

}
 public function createOrPubTime($workerid,$datum,$pub,$data) // a datum tömb kelle legyen
 { 
  // $res=false;
   $time =$this->where([
   ['worker_id', '=',$workerid],
   ['datum', '=',$datum],
   ['pub', '=',$pub],
   ])->first();
   if($time){$time->update($data);} 
   else{$this->create($data);}
 } 
 public function getPubTime($workerid,$datum,$pub) // a datum tömb kelle legyen
 { 
  // $res=false;
   $time =$this->where([
   ['worker_id', '=',$workerid],
   ['datum', '=',$datum],
   ['pub', '=',$pub],
   ])->first();
  //  if($Time){$res=true;} 
    return $time;
 } 
 public function getAllPubTime($workerid,$datum) // a datum tömb kelle legyen
 { 
  // $res=false;
   $timepubs =$this->where([
   ['worker_id', '=',$workerid],
   ['datum', '=',$datum],
   ])->pluck('pub')->toarray();
  //  if($Time){$res=true;} 
    return $timepubs;
 }  
 public function deltimesMan($data) // a datum tömb kelle legyen
{  
    $man=\Auth::user();
    $mancegid= Ceg::where('user_id',$man->id)->first()->id;
    foreach($data['workerids'] as $workerid )
    { 
        $worker=Worker::findOrFail($workerid);
        if($worker->ceg_id == $mancegid);
         {
            foreach($data['ids'] as $id )
            {           
                $time= $this->findOrFail($id);
                 $time->delete();
            }
        }
    }
     return  $this->getWorkTimesToMan($data['ev'],$data['ho']);
}



public function storetimesMan($data) // a datum tömb kelle legyen
{ 

    $man=\Auth::user();
    $mancegid= Ceg::where('user_id',$man->id)->first()->id;
   
   foreach($data['workerids'] as $workerid )
    { 
        $worker=Worker::findOrFail($workerid);
        if($worker->ceg_id == $mancegid);
         {
               foreach($data['datums'] as $datum )
            {    
                $data['worker_id']=$workerid; 
                $data['pub']= $data['pubbase'] ?? 0;       
                $data['datum']= $datum;
                $this->create($data);
            }
         }
      
    }
     return  $this->getWorkTimesToMan($data['ev'],$data['ho']);
}

 /*
 public function getTimesManFromWorkerids($workerids,$year=null,$month=null)
 {
     $res=[];
    $user=\Auth::user();
    $cegid= Ceg::where('user_id',$user->id)->first()->id; 

    foreach($workerids as $workerid){
        $worker= Worker::where('ceg_id', $cegid)->pluck('id');  
        if($worker->ceg_id==$cegid){
            $time= $this->getTimes($workerid,$year,$month);
            $res['datekey'][$workerid][$time->datum][]=$time;
            $res['idkey'][$time->id][]=$time;
        }  
     }                                     
     return $res;
 }**/
    public function getNewCegTimes($cegid)
    {
       //$Time= $this->where('id','<>',1);
       $Times= $this->whereHas('worker', function($query) use($cegid) {
            $query->where([['worker.ceg_id', $cegid],['pub', 0]]);
         });

         return  $Times;   
    } 
    public function getCegTimes($ACT,$cegid)
    {
         $Times= $this->whereHas('worker', function($query) use($cegid) {
            $query->where('worker.ceg_id', $cegid);
         });

         return  $Times;    
    } 

    /**
     * lennie kell datums és a worker_ids tömboknek 
     * ellenőrzi hogy van-e admin jogosutsáag (level) az usernek ée hogy a worker az ő cégéhez tartozik -e
     */
     public function makeAdminTimes($data,$level=null) 
     {
         if($level==null){$level= \Auth::user()->level(); }
         if($level>20) //moderátorok még nem vihetnek fel
         {
            $adminceg= Ceg::getUserCeg();
            $data['pub']=$level;
    
            foreach($data['worker_ids'] as $workerid )
            {
                $worker=Worker::find($workerid);
                if($worker->ceg_id==$adminceg->id){
                    $data['worker_id']=$workerid;
                    foreach($data['datums'] as $datum )
                    { 
                        $data['datum']= $datum;
                        $this->create($data);
                    } 
                }
               
            } 
        }   
    }
    public function updateAdminTime($id,$data)
    {
        $level=\Auth::user()->level();
        $Time = $this->findOrFail($id);
        $adminceg= Ceg::getUserCeg();
        $timeceg_id= Worker::find($data['worker_id'])->ceg_id;
        if($level>=abs($Time->pub) && $level>20 && $timeceg_id==$adminceg->id)
        {
            $data['pub']=$level;
            $Time->update($data); 
        }
    }
//---------------------------------------------------------------
    public function destroyTime($id,$level)
    {
        $Time = $this->findOrFail($id);
        if($level>=$Time->pub)
        {
          $this->destroy($id);
        }
    }
    public function pubTime($id,$level)
    {
        $Time = $this->findOrFail($id);

        if($level>20 && $level<= abs($Time->pub))
        {
            $data['pub']=$level;
            $Time->update($data);
             return '';
        }
         return '';
    }
    public function unpubTime($id,$level)
    {
        $Time = $this->findOrFail($id);
        if($level>20 && $level<= abs($Time->pub))
        {
            $data['pub']=-$level;
            $Time->update($data);
            return '';
        }
        return '';
    }

    //---------------------------
    public function getLists($data=[])
    {
        $data['timetype_id_list']= Timetype::all()->pluck('name', 'id');
        $data['worker_list']= Worker::with('user')->get()->pluck('user.name', 'id');
   return $data;
    }
 

    public function worker()
    {
        return $this->belongsTo('App\Worker')->with('user');
    }
    public function timetype()
    {
        return $this->belongsTo('App\Timetype');
    }

    public function getDescriptionForEvent($eventName)
    {
        return __CLASS__ . " model has been {$eventName}";
    }
}
