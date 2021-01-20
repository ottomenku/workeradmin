<?php
return [
  'base'=>[
  'obClass'=>['stored'=>'App\Stored'],
  'viewpar'=>[
      'baseroute'=>'m/ad.man.time.stored/', //ez alapján múködnek a gombok
      'route'=>'m/ad.man.time.stored/', //ez alapján múködnek a gombok
      ],
  ],

  // index ----------------------------
      'index' => [
          'viewpar' => [
              'taskheader' => 'Munkaidők, Cég:{ACT.cegnev}',        
          ], 
          'funcs' => [
            //elsőnek kell lefuttatmi mert felül írja a DATA-t( felülírja a base validálást)
            50 => ['stored::getAdminStored', ['{ACT.routpars.id}', '{ACT.routpars.id1}'], 'DATA.stored'],
        ],
          'return'=>['viewFull','MOcalendarVue.storedAdmin'] 
              //  'return'=>['dump']          
      ],
  // calendar ----------------------------------
      'calendar' => [
        'return'=>['json'] //Ha a groupconfba  tesszük kella z allowed külcs, mert nem lehet üres a task 
        // 'return'=>['viewFull','MOcalendarVue.calendar'] 
        //   'return'=>['dump']
      ],
// times ---------------------------------------------------- 

      'saveStored' => ['allowed'=>true] ,
      'deltimes' => [ 'allowed'=>true],
      'deltime' => ['allowed'=>true],
      'timesreset' => ['allowed'=>true] ,
  
// days------------------------------------------------------  

      'delday' => ['allowed'=>true],
      'daysreset' => ['allowed'=>true] ,
      'storedays' => ['allowed'=>true],
  

];