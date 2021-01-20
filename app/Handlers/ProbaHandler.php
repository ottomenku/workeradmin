<?php
namespace App\Handlers;
use App\worker;
use App\User;
use App\Ceg; 
use Carbon\Carbon;
class ProbaHandler
{ 
    public function getDate($year='0',$month='0')
    {
        $current = new Carbon();
        if($year=='0' && $month=='0'){$dt = Carbon::create($current->year,$current->month, 1, 0);}
        elseif($year=='0'){           $dt = Carbon::create($current->year, $month , 1, 0); }
        elseif($month=='0') {        $dt = Carbon::create($year, $current->month , 1, 0);}    
        else{                         $dt = Carbon::create($year, $month , 1, 0);}
        return $dt;
    }
    public $days=['vasárnap','hétfő','kedd','szerda','csütörtök','péntek','szombat'];

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






  /*  
    public function getFirstEmptyDays($daysnumber,$days=[])
    {
        for ($i=0; $i <= $daysnumber; $i++) { 
            $days[]=  [
                'weeknum'=>$i,
                'name'=>'Empty',
                'type'=>'empty',
                'color'=>'gray'
            ];
        }
        return $days;
    }
    public function getLastEmptyDays($daysnumber=0,$days=[])
    {
        for ($i=$daysnumber; $i <= 6; $i++) { 
            $days[]=  [
                'weeknum'=>$i,
                'name'=>'Empty',
                'type'=>'empty',
                'color'=>'gray'
            ];
        }
        return $days;
    }
 */  
public function getMonthDays($year='0',$month='0')
{
    $date=$this->getDate($year,$month);
    $aktMonth=$date->month;
    
            while ($aktMonth == $date->month) { 
                //$datum=$year.'-'.$month.'-'.$date->day;
                $datum= $this->datumTwoChar($date->year.'-'.$date->month.'-'.$date->day);
                $nap=$date->day;
                $ujdays= [
                    'datatype'=>'base',
                    'name'=>$this->days[$date->dayOfWeek],
                    'day'=>$date->day,
                    'dayOfWeek'=>$date->dayOfWeek,
                    'datum'=>$datum,
                    'daytype_id'=>1,
                    'type'=>'Munkanap',
                    'munkanap'=>true,
                ]; 
                if( $date->dayOfWeek==0){$ujdays['daytype_id']=2;$ujdays['type']='Szabadnap';$ujdays['munkanap']=false;}
               if($date->dayOfWeek==6 ){$ujdays['daytype_id']=3;$ujdays['type']='Pihenőnap';$ujdays['munkanap']=false;}
                $days[$datum]= $ujdays;
                $date->addDay();
            }  
     return $days;       
}





    public function test()
    {
        
  /*   echo (new Carbon('first day of December 2008'))->addWeeks(2); 
     echo $dt->startOfWeek();    // 2012-01-30 00:00:00
     echo $dt->endOfWeek(); 
     $now = Carbon::now();
     $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
     $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');
     Carbon::createFromFormat('W-Y', '01-2018')*/
      //  $data['datum']=Carbon::createFromFormat('Y-m-d', '2018-01');
//Carbon::now();Carbon::createFromFormat('Y-m-d', '2018-01-05')
       return $this->getMonthDays($year='0',$month='0');
    }
}