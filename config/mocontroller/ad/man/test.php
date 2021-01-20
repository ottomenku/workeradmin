<?php
return [
  
    'base' => [
        'obClass'=>['baseOB'=>'App\Time','day'=>'App\Day','baseday'=>'App\Baseday','timetype'=>'App\Timetype','daytype'=>'App\Daytype',
        'worker'=>'App\Worker','stored'=>'App\Stored','CalendarHandler'=>'App\Handlers\CalendarHandler'],
        'funcs' => [
                5 => ['replaceACT', []],
                10 => ['validateToDATA', [], 'DATA.valid'],
        ],
   'viewpar'=>[
      'baseroute'=>'m/ad.man.time.timesimple/', //ez alapján múködnek a gombok
      'route'=>'m/ad.man.time.timesimple/', //ez alapján múködnek a gombok
      ],
    ],
  // index ----------------------------
      'index' => [
        'funcs' => [
         // 15 => ['baseOB::loginUser', [], ],
         15 => ['baseOB::getWorkerids', [], 'DATA.workerids'],
         //20 => ['baseOB::getTimes', [['start'=>'2020-02-01','end'=>'2020-02-28'] ], 'DATA.times'],
          //20 => ['baseOB::getTimes', [['workerids'=>[5],'start'=>'2020-02-01','end'=>'2020-02-28'] ], 'DATA.times'],
          20 => ['baseOB::getTimes', [], 'DATA.times'],
    ],
          //'return'=>['viewFull','MOcalendarVue.calendarAdmin'] 
         'return'=>['dump']          
      ],
  // calendar ----------------------------------
      'calendar' => [
        'return'=>['json'] //Ha a groupconfba  tesszük kella z allowed külcs, mert nem lehet üres a task 
        // 'return'=>['viewFull','MOcalendarVue.calendar'] 
        //   'return'=>['dump']
      ],
// times ---------------------------------------------------- 

      'storetimes' => ['allowed'=>true] ,
      'deltimes' => [ 'allowed'=>true],
      'deltime' => ['allowed'=>true],
      'timesreset' => ['allowed'=>true] ,
  
// days------------------------------------------------------  

      'delday' => ['allowed'=>true],
      'daysreset' => ['allowed'=>true] ,
      'storedays' => ['allowed'=>true],
  

];