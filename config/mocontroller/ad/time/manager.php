<?php
//figyelem ugyanolyan hulcsnál lefagy!!!!!!!!!!!
//BaseWithRouteController
return [
    'base' => [
        'role' => ['manager'],
        'obClass' => ['baseOB' => 'App\Handlers\ManagerHandler','daytype' => 'App\Daytype','timetype' => 'App\Timetype'],
        'viewpar' => [
            'baseroute' => 'm/ad.time.manager/', //ez alapján múködnek a gombok
            'route' => 'm/ad.time.manager/',]
    ],
    'index' => [
        'funcs' => [
          20 => ['daytype::getCegDaytypes', [], 'DATA.daytypes'],  //groupconf hívja be
          30 => ['timetype::getCegTimetypes', [], 'DATA.timetypes'],
           // 30 => ['stored::getStoreds', ['{DATA.valid}'], 'DATA.storeds'],
        ],

        'viewpar' => [
          //  'info' => ' fghsghsgf  gdhfhdf', // a taskhoz tartozó infoszöveg
    ],
        // 'delFromParrent' => ['obClass', 'funcs'],
        'return' => ['viewFull', 'mocalendarVue.calendarManager'],
      //        'return'=>['dump']
    ],

    'getbasedata' => [
        'return'=>['json']
       //'return'=>['dump']
    ],
    'getbasedata2' => [
        'funcs' => [
          //  14 => ['timetype::allpluck', [], 'DATA.timetypes'],
          //  16 => ['daytype::allPluck', [], 'DATA.daytypes'],
          14 => ['daytype::getCegDayTypes', [], 'DATA.daytypes'],
          16 => ['timetype::getCegTimeTypes', [], 'DATA.timetypes'],
          18 => ['worker::getWorkersIdkeybase', [], 'DATA.workers'],
        //  19 => ['worker::getWorkerids', [], 'DATA.workerids'],
          20 => ['user::getCegPubArray', [], 'DATA.ceg'],
          60 => ['CalendarHandler::getBaseCalendarData', ['{DATA.valid}', '{DATA}'], 'DATA'],
          70 => ['time::getTimesFromWorkers', ['{DATA.valid}','{DATA.workers}'], 'DATA.times'],
          80 => ['day::getDaysFromWorkers', ['{DATA.valid}','{DATA.workers}'], 'DATA.workerdays'],
           // 90 => ['stored::getStoreds', ['{DATA.valid}'], 'DATA.storeds'],
        ],
         //'return' => ['json'],
         'return'=>['dump']
    ],
    'freshdata' => [
        'allowed'=>true,
    ],
//stored---------------------------
/*'delstored' => [
  'funcs' => [
      20 => ['stored::delStored', ['{DATA.valid}']],
      90 => ['stored::getStoreds', ['{DATA.valid}'], 'DATA.storeds'],
  ],
  'return' => ['json'],
],
'storestored' => [
  'funcs' => [
      20 => ['stored::storeStored', ['{DATA.valid}']],
      90 => ['stored::getStoreds', ['{DATA.valid}'], 'DATA.storeds'],
  ],
  'return' => ['json'],
],*/

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