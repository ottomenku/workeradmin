<?php
//figyelem ugyanolyan hulcsnál lefagy!!!!!!!!!!!
//BaseWithRouteController
return [
    'base' => [
        'role' => ['worker'],
        'obClass' => ['baseOB' => 'App\Handlers\WorkerHandler',
        'worker' => 'App\Worker','daytype' => 'App\Daytype','timetype' => 'App\Timetype'],
        'viewpar' => [
            'timemenu'=>false,
            'baseroute' => 'm/ad.time.worker/', //ez alapján múködnek a gombok
           // 'route' => 'm/ad.time.worker/',
        ],
    ],
    'index' => [
        'viewpar' => [
            'info' => ' fghsghsgf  gdhfhdf', // a taskhoz tartozó infoszöveg
    ],    
     'funcs' => [
        20 => ['daytype::getCegDaytypes', [], 'DATA.daytypes'],  //groupconf hívja be
        30 => ['timetype::getCegTimetypes', [], 'DATA.timetypes'],
        
      ],

       'return' => ['viewFull', 'mocalendarVue.calendarWorkerDev'],
        //       'return'=>['dump']
    ],

    'getbasedata' => [
        'funcs' => [
            18 => ['worker::getWorkerBase', [], 'DATA.workers'],
          ],

        
    ],
    'freshdata' => [
        'allowed'=>true,
    ],

//day functions-------------------------------------
    'resetdays' => [
        'allowed'=>true,
    ],
    'delday' => [
        'allowed'=>true,
    ],
    'storedays' => [
        'allowed'=>true,
    ],
// time functioms---------------------------------------
    'resettimes' => [
        'allowed'=>true,
    ],
    'deltime' => [
        'allowed'=>true,
    ],
    'storetimes' => [
        'allowed'=>true,
    ],

];
