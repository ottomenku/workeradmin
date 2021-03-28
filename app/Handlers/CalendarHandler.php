<?php
namespace App\Handlers ;
use App\worker;
use App\User;
use App\Ceg; 
use  App\Timetype;
use  App\Daytype;
use  App\Baseday;
use  App\Time;
use  App\Day;
use Carbon\Carbon;
class CalendarHandler 
{ 



  /**
   * adott hónap napjai  getBaseCalendarData
    */ 
  public function getBaseCalendarData($pardata,$DATA=[])
  {
 $year=$pardata['year'] ??  Carbon::now()->year;
 $month=$pardata['month'] ?? Carbon::now()->month;
    //base calendart adatok--------------------------------
     // $DATA['calendarbase']  = $this->getMonthDays($year,$month) ;
     $DATA['calendarbase']  = $this->getMonthDays($year,$month)  ;    
    $DATA['calendar']  = $this->groupbyWeeks( $DATA['calendarbase'] ) ; 
  
    //  $Baseday = new Baseday();
   //   $DATA['basedays']  = $Baseday->getBaseDays($year,$month) ;
      //$DATA['cegbasedays']  =$Baseday->getBaseDays($year,$month,$cegid) ;
      return $DATA;
  }
  public function getMonthDays($year='0',$month='0')
{
    $date=$this->getDate($year,$month);
    $aktMonth=$date->month;
    $aktYear=$date->year;
   $bd= new  Baseday();
   $baseday= $bd->getBaseDays($aktYear,$aktMonth);
   if($date->dayOfWeek<1){$emptydaysNumber=6;}
   else{$emptydaysNumber=$date->dayOfWeek-1;}
    $days= $this->getEmptyDays($emptydaysNumber,[],$date->weekOfYear);

  
            while ($aktMonth == $date->month) { 
                //$datum=$year.'-'.$month.'-'.$date->day;
                $datum= $this->datumTwoChar($date->year.'-'.$date->month.'-'.$date->day);
                $nap=$date->day;            
                $munkanap=true; 
                $class='workday'; 
                $daytype='Munkanap';
                if( $date->dayOfWeek==0){$daytype='Szabadnap';$munkanap=false;$class='freeday';}
                if( $date->dayOfWeek==6){$daytype='Pihenőnap';$munkanap=false;$class='freeday';}
                $ujdays= [
                  //  'daytype'=>'Munkanap', //nem kell, de kelhet egy részletesebb naptárban
                    'basedaytype'=>'',    //ha rendkivüli nap annak a neve pl nemzeti ünnep, vagy ledolg 03.15
                    'note'=>[],           // arendkívüli nap jegyzete
                    'name'=>$this->days[$date->dayOfWeek], //TODO: töb nyelvűsíteni
                    'day'=>$date->day,
                    'datum'=> $datum,
                    'weekOfYear'=>$date->weekOfYear,
                    'dayOfYear'=>$date->dayOfYear , // a hetenkénti csoportosításhoz kellett de már nem
                    'dayOfWeek'=>$date->dayOfWeek,
                    'munkanap'=>$munkanap, //munkaidő számításnál van szerepe
                    'class'=>$class,
                    //  'times'=>[],
                    //'workerdays'=>[],
                ]; 
              if(isset($baseday[$datum])){
                $ujdays['basedaytype']=$baseday[$datum]['name'] ?? '';
                $ujdays['munkanap']=$baseday[$datum]['workday'] ?? $ujdays['munkanap'];
                $ujdays['note'][]=$baseday[$datum]['note'] ?? $ujdays['note'];
                if(isset($baseday[$datum]['note'])){$ujdays['note'][]=$baseday[$datum]['note'];}
                if($baseday[$datum]['workday']){$ujdays['class']='workday';}
                else{$ujdays['class']='freeday';}
              }
              $days[$datum]=$ujdays;
                $date->addDay(); 

            }  
            if($ujdays['dayOfWeek']<1){$emptydaysNumber=0;}
            else{$emptydaysNumber=7-$ujdays['dayOfWeek'];}
                $days= $this->getEmptyDays($emptydaysNumber,$days,$ujdays['weekOfYear'],'3333-33-'); 

     return $days;       
}
  /**
     * ha nincs megadva start és end akkor  a year és a month-ból ha az sincs akkor az aktuális hónapból állítja elő 
     */
    public function getStartEnd($data)
    { 
        if(empty($data['year'])){$data['year']= Carbon::now()->year;};
        if(empty($data['month'])){$data['month']= Carbon::now()->month;}
        if(strlen($data['month'])<2){ $data['month']='0'.$data['month'];}
        if(empty($data['start'])){$data['start']= $data['year'].'-'.$data['month'].'-01';}
        if(empty($data['end'])) {$data['end']=\CalendarHandler::getEndFromMonth($data['year'],$data['month']); }   
        return $data;
    }
  /**
     * ha nincs megadva  year és a month akkor az aktuális hónapból állítja elő 
     */
    public function getYearMonth($data)
    { 
        if(empty($data['year'])){$data['year']= Carbon::now()->year;};
        if(empty($data['month'])){$data['month']= Carbon::now()->month;}
        if(strlen($data['month'])<2){ $data['month']='0'.$data['month'];} 
        return $data;
    }


/*   public function getWorkerCalendarData($workerid,$year,$month)
    {
      $cegid=Worker::find($workerid)->ceg_id;
       $DATA= $this->getBaseCalendarData($year,$month,$cegid);
      //dolgozók bejegyzései----------------------------
      $Time = new Time();
      $DATA['times']  = $Time->getTimesYearMounth($workerid,$year,$month);
      $Day = new Day();
      $DATA['workerdays']  = $Day->getDaysYearMounth($workerid,$year,$month) ; 
      return $DATA;
    }**/
      /**
     * a dolgoző saját adatai az adott hónapban
     */
 

/**
 * a hónap utolsó napjának dteljes dátumáva tér vissza 
 */
public function getEndFromMonth($year='0',$month='0') 
{
        if(empty($year)){$year= Carbon::now()->year;}
        if(empty($month)) {$month= Carbon::now()->month;} //lehet egy vagy kétjegyű is
        $date = Carbon::createFromFormat('Y-m-d', $year.'-'.$month.'-01');
        return $date->endOfMonth()->toDateString();
 }


    public function getDate($year='0',$month='0')
    {
        $current = new Carbon();
        if($year=='0' && $month=='0'){$dt = Carbon::create($current->year,$current->month, 1, 0);}
        elseif($year=='0'){           $dt = Carbon::create($current->year, $month , 1, 0); }
        elseif($month=='0') {        $dt = Carbon::create($year, $current->month , 1, 0);}    
        else{                         $dt = Carbon::create($year, $month , 1, 0);}
        return $dt;
    }
    public $days=['vasárnap','hétfő','kedd','szerda','csütörtök','péntek','szombat',''];

    public function getMonths()
    { 
      return  [       
            1=>['name'=>'január','id'=>'1'],
            2=>['name'=>'február','id'=>'2'],
            3=>['name'=>'Március','id'=>'3'],
            4=>['name'=>'Április','id'=>'4'],
            5=>['name'=>'Május','id'=>'5'],
            6=>['name'=>'Június','id'=>'6'],
            7=>['name'=>'Július','id'=>'7'],
            8=>['name'=>'Augusztus','id'=>'8'],
            9=>['name'=>'Szeptember','id'=>'9'],
            10=>['name'=>'Október','id'=>'10'],
            11=>['name'=>'November','id'=>'11'],
            12=>['name'=>'December','id'=>'12']       
        ];    
    }
    public function twoChar($num)
    {
        if(strlen($num)<2){
            $num='0'.$num;
        }
      return  $num; 
    }
    public function datumTwoChar($datum,$sep='-')
    {
    $datumT= explode($sep,$datum);
    $datumT[1]=$this->twoChar($datumT[1]);
    $datumT[2]=$this->twoChar($datumT[2]);
      return  implode($sep,$datumT); 
    }



public function getEmptyDays($emptydaysNumber, $emptydays,$weekOfYear,$yearho='1111-11-')
{
   // $dayend=$daystart+$emptydaysNumber;

      for ($i=0; $i<$emptydaysNumber; $i++){
      //  if($i==7){$dayOfWeek=0;}else{$dayOfWeek=$i;} (int)$num
        $emptydays[$yearho.$i]= [
         //   'daytype'=>'', 
            'basedaytype'=>'',    //ha rendkivüli nap annak a neve pl nemzeti ünnep, vagy ledolg 03.15
            'note'=>'',
            'name'=>'empty',
            'day'=>'',
            'datum'=> '',
            'dayOfWeek'=>0,
            'weekOfYear'=> $weekOfYear,
            'dayOfYear'=>0 ,
            'type'=>'E',  // kivezetni
            'munkanap'=>false,
            'class'=>'empty',
          //  'times'=>[],
          //  'workerdays'=>[],

        ]; 
    }
    return $emptydays;
}
/**
 * adott időszak napjaival tér vissza dátum az index, az érték a munkanap(true, false)
 */
public function getWorkDays($start,$end)
{
    $date=Carbon::createFromFormat('Y-m-d',$start);
    $endDate=Carbon::createFromFormat('Y-m-d',$end);
    // hogy az utlosó nap még benne legyen----------------- 
    $endDate->addDay(); 
    $days=[];
    $x=0;
            while ($date != $endDate) { 
              $datum= $this->datumTwoChar($date->year.'-'.$date->month.'-'.$date->day);            
              $days[$datum]= 1;
              if($date->dayOfWeek==0){$days[$datum]= 0;}
              if($date->dayOfWeek==6 ){$days[$datum]= 0;}
              $date->addDay(); 
              $x++;
              if($x>1000){exit('Túl nagy időkeret');}
          }  
    return $days   ;   
 }


public function groupbyWeeks($days)
{
   $aktWeek=0; $i=0; //$i azért kell mert néha a december az első héttel ér véget és néha a január az 52.-el kezd
    foreach ($days as $date=> $day) {
        if($day['weekOfYear']!=$aktWeek){$aktWeek=$day['weekOfYear'];$i++;}
        $ujdays[$i.'-'.$aktWeek][$date]=$day;
        
    }
return $ujdays;
}


   /* public function getFullCalendars()
    { 
    14=>['timetype::getSelectList',[],'DATA.timetypes'] , 
    16=>['daytype::getSelectList',[],'DATA.daytypes'] , 
  
  20=>['CalendarHandler::getMonthDays',['{ACT.viewpar.id}','{ACT.viewpar.id1}'],'DATA.calendarbase'] ,
    30=>['baseOB::getWorkTimesToMan',['{ACT.viewpar.id}','{ACT.viewpar.id1}'],'DATA.times'] , 
     40=>['day::getWorkDaysToMan',['{ACT.viewpar.id}','{ACT.viewpar.id1}'],'DATA.workerdays'] , 
     50=>['baseday::getBaseDaysToMan',['{ACT.viewpar.id}','{ACT.viewpar.id1}'],'DATA.basedays'] ,
    55=>['baseday::getBaseDaysToMan',['{ACT.viewpar.routpars.id}','{ACT.viewpar.routpars.id1}',true],'DATA.cegbasedays'] ,
   //  60=>['CalendarHandler::mergeDays',['{DATA}'],'DATA.calendarbase'] ,
      70=>['CalendarHandler::groupbyWeeks',['{DATA.calendarbase}'],'DATA.calendar'] ,
     ],
      'return'=>['viewFull','MOcalendarVue.calendarAdmin'] 

    }


 /*   public function mergeDays($data)
    {
        $res=$data['calendarbase'];
        foreach($data['basedays'] as $key=>$val)
        {$res[$key]['basedays']=$val;}
        foreach($data['workerdays'] as $key=>$val)
        {$res[$key]['workerdays']=$val;}
        foreach($data['worktimes'] as $key=>$val)
        {$res[$key]['times']=$val['times'];}
       // $res=array_merge_recursive($data['calendar'],$data['basedays']);
        return $res;
    }*/
/*  public function timeframes($data)
  {
      $vData = $data['formdata'];
      $justworkdays=false;
      if($vData['justworkdays']=='workdays'){$justworkdays=true;};
      $vData=$this->getStartEnd($vData);
      $start = $vData['start'] ?? '2019-12-31' ;
      $end = $vData['end'] ?? '2020-01-10';
      $cegid = $data['viewparid'] ?? 1; // 1re vissza cserélni!
      $workerids = $data['workerids'] ?? [];


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
$times=[];
foreach ($workerids as  $workerid) {
$worker=Worker::find($workerid);
$times[$workerid]['sumTime']= $timesob->with('worker')->where([ ['datum', '>=', $start],['datum', '<=', $end],['pub', '>', 5],['worker_id', '=', $workerid]])->sum('hour');
$times[$workerid]['workername']=$worker->workername;
$times[$workerid]['dif'] =$times[$workerid]['sumTime']-$timeFrame;
$times[$workerid]['class'] ='difminusz';
if($times[$workerid]['dif']>0){ $times[$workerid]['class'] ='difplusz';}

}
$datar=[];
$datar['start']=$start;
$datar['end']=$end;
$datar['justworkdays']=$justworkdays;
$datar['daysNum']= $daysNum ;
$datar['workdaysNum']=  $workdaysnum;
$datar['szorzo']= $szorzo ;
$datar['timeFrame']=$timeFrame ;
$datar['times']= $times ;
//$res=[];
//$res['timeFrames']=$data;
// return response()->json($res);
//return response()->json($data);
return $datar;
} */

}