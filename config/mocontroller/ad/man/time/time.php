<?php
return [
  'base'=>[
  'obClass'=>[],
  'viewpar'=>[
      'baseroute'=>'m/ad.man.time.timesimple/', //ez alapján múködnek a gombok
      'route'=>'m/ad.man.time.timesimple/', //ez alapján múködnek a gombok
      ],
  ],

  // index ----------------------------
      'index' => [
          'viewpar' => [
              'taskheader' => 'Munkaidők, Cég:{ACT.cegnev}',        
          ], 
          'return'=>['viewFull','MOcalendarVue.calendarAdmin'] 
              //  'return'=>['dump']          
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