<?php
//figyelem ugyanolyan hulcsnál lefagy!!!!!!!!!!!
//BaseWithRouteController
return [
    'base' => [
        'role' => ['worker'],
        'obClass' => ['baseOB' => 'App\Handlers\WorkerHandler'],
        'viewpar' => [
            'baseroute' => 'm/ad.time.worker/', //ez alapján múködnek a gombok
           // 'route' => 'm/ad.time.worker/',
        ],
    ],
    'index' => [
        'viewpar' => [
            'info' => ' fghsghsgf  gdhfhdf', // a taskhoz tartozó infoszöveg
    ],
        'allowed'=>true,
        // 'delFromParrent' => ['obClass', 'funcs'],
       'return' => ['viewFull', 'mocalendarVue.calendarWorker'],
        //       'return'=>['dump']
    ],

    'getbasedata' => [
        'allowed'=>true,
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
