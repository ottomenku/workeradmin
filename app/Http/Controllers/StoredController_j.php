<?php

namespace App\Http\Controllers;
//use App\Roles;
use App\Baseday;
use App\Stored;
use App\Time;
use App\Worker;
use App\Http\Controllers\Controller;
use jeremykenedy\LaravelRoles\Models\Role;
use Illuminate\Http\Request;
use App\Facades\CalendarHandler ;
class StoredController_j extends Controller
{

    


    public function getStoreds($data)
    {
        $stored= new Stored();
        $data['storeds']=$stored->getStoreds($data);
 
     //  var_dump($data) ;
         return view('MocalendarVue.admin.calendarAdminStored', compact('data'));
    } 
   

    public function index($year=null,$month=null,$cegid='worker')
    {
        $stored= new Stored();
        $data['storeds']=$stored->getStoreds($year,$month,$cegid);
        return view('MocalendarVue.admin.calendarAdminStored', compact('data'));
    }  
    public function timeframes(Request $request)
    {
        $data=[];
        $vData = $request->all();
        $justworkdays=false;
        if($vData['justworkdays']=='workdays'){$justworkdays=true;};
        $start = $vData['start'] ?? '2019-12-31' ;
        $end = $vData['end'] ?? '2020-01-10';
        $cegid = $vData['cegid'] ?? 1; // 1re vissza cserélni!
        $workerids = $vData['workerids'] ?? [];


        if(empty($workerids )){$workerids=Worker::where([['ceg_id','=',$cegid]])->get()->pluck('id')->toarray();}
    $basedays=Baseday::where([['datum','>=',$start],['datum','<=',$end],['ceg_id','=',1]])
 
    ->with('daytype')->get()->pluck('daytype.workday','datum')->toarray();
  $calendarDay =CalendarHandler::getWorkDays($start,$end);
     $days= array_merge($calendarDay,$basedays);
$daysNum=count($days);
$workdaysnum=count(array_filter($days));
$szorzo=$vData['szorzo'] ?? 8 ;

if( $justworkdays){$timeFrame=$workdaysnum*$szorzo;}
else{$timeFrame=$daysNum*$szorzo;}

$timesob=new Time();

foreach ($workerids as  $workerid) {
$worker=Worker::find($workerid);
$times[$workerid]['sumTime']= $timesob->with('worker')->where([ ['datum', '>=', $start],['datum', '<=', $end],['worker_id', '=', $workerid]])->sum('hour');
  $times[$workerid]['workername']=$worker->workername;
 $times[$workerid]['dif'] =$times[$workerid]['sumTime']-$timeFrame;
  $times[$workerid]['class'] ='difminusz';
  if($times[$workerid]['dif']>0){ $times[$workerid]['class'] ='difplusz';}
  
}
$data['start']=$start;
$data['end']=$end;
$data['justworkdays']=$justworkdays;
$data['daysNum']= $daysNum ;
$data['workdaysNum']=  $workdaysnum;
$data['szorzo']= $szorzo ;
$data['timeFrame']=$timeFrame ;
$data['times']= $times ;

 //return var_dump($data);
    //echo $times[0]['sum(hour)'];
 // return var_dump($timesob->with('worker')->where([ ['datum', '>=', $start],['datum', '<=', $end],['worker_id', '=', 5]])->selectRaw('sum(hour)')->get()->toarray() );
    return response()->json($data);
}  
    public function jsonStoredsData($year = null, $month = null, $cegid = 'worker')
    {
        $stored= new Stored();
        $data['storeds']=$stored->getStoreds($year,$month,$cegid);
        return response()->json($data);
    }

    public function postStoredsData(Request $request)
    {
       // $request = new Request();
       // $this->validate($request, [ ]);
        $vData = $request->all();
        $year = $vData['ev'] ?? null;
        $month = $vData['ho'] ?? null;
        $cegid = $vData['cegid'] ?? 'worker';
        return  $this->jsonStoredsData($year,$month,$cegid);
    } 
    
    public function refreshStoreds($year=null,$month=null,$cegid='worker')
    {
        return  $this->jsonStoredsData($year,$month,$cegid);
    }     
    public function zarStoreds($year=null,$month=null,$cegid='worker',$id)
    {
        $stored=  Stored::find($id);
        $stored->update(["lezarva"=>true]);
        return  $this->jsonStoredsData($year,$month,$cegid);
    }        
    public function nyitStoreds($year=null,$month=null,$cegid='worker',$id)
    {
        $stored=  Stored::find($id);
        $stored->update(["lezarva"=>false]);
        return  $this->jsonStoredsData($year,$month,$cegid);
    }  
    public function deltStoreds($year=null,$month=null,$cegid='worker',$id)
    {
        Stored::destroy($id); 
        return  $this->jsonStoredsData($year,$month,$cegid);
    }  
}
