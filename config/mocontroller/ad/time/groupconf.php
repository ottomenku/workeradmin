<?php
return [
    'base' => [
        'obClass'=>['time'=>'App\Time','day'=>'App\Day','baseday'=>'App\Baseday','timetype'=>'App\Timetype','daytype'=>'App\Daytype',
        'worker'=>'App\Worker','user'=>'App\User','ceg'=>'App\Ceg','CalendarHandler'=>'App\Handlers\CalendarHandler'],
        'viewpar' => [
            'timemenu'=>true,
            //'baseroute' => 'm/ad.wor.time.timesimple/', //ez alapján múködnek a gombok
            'menu' => [
              /*  */
          ],
        ],

        'funcs' => [
            5 => ['replaceACT', []],
            10 => ['validateToDATA', [], 'DATA.valid'],
         ]
    ],
    'index' => [
       'delFromParrent' => ['obClass', 'funcs'],
        'return' => ['viewFull', 'MOcalendarVue.calendarWorkerDev'],
        //      'return'=>['dump']
    ],

    'getbasedata' => [//TODO: megnézni a worker miért nem múködik ha itt kikommenteljük a 18-as sort ott meg beírunk egy másik 18-ast
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
         'return' => ['json'],
        // 'return'=>['dump']
    ],
    'freshdata' => [
        'funcs' => [
            60 => ['CalendarHandler::getBaseCalendarData', ['{DATA.valid}', '{DATA}'], 'DATA'],
            70 => ['time::getTimesFromWorkerIds', ['{DATA.valid}','{DATA.valid.workerids}'], 'DATA.times'],
            80 => ['day::getDaysFromWorkerids', ['{DATA.valid}','{DATA.valid.workerids}'], 'DATA.workerdays'],
           // 90 => ['stored::getStoreds', ['{DATA.valid}'], 'DATA.storeds'],
        ],

        'return' => ['json'],
     //       'return'=>['dump']
    ],


//day functions-------------------------------------
    'resetdays' => [
        'funcs' => [
            20 => ['day::resetItem', ['{DATA.valid}']],
            25 => ['worker::getWorkersIdkeybase', [], 'DATA.workers'],
            30 => ['day::getDaysFromWorkers', ['{DATA.valid}','{DATA.workers}'], 'DATA.workerdays'],
            40 => ['time::getTimesFromWorkers', ['{DATA.valid}','{DATA.workers}'], 'DATA.times'],
        ],
        'return' => ['json'],
    ],
    'delday' => [
        'funcs' => [
            20 => ['day::delItem', ['{DATA.valid}']],
            25 => ['worker::getWorkersIdkeybase', [], 'DATA.workers'],
            30 => ['day::getDaysFromWorkers', ['{DATA.valid}','{DATA.workers}'], 'DATA.workerdays'],
            40 => ['time::getTimesFromWorkers', ['{DATA.valid}','{DATA.workers}'], 'DATA.times'],
        ],
        'return' => ['json'],
    ],
    'storedays' => [
        'funcs' => [
            20 => ['day::storeDays', ['{DATA.valid}']],
            25 => ['worker::getWorkersIdkeybase', [], 'DATA.workers'],
            30 => ['day::getDaysFromWorkers', ['{DATA.valid}','{DATA.workers}'], 'DATA.workerdays'],
            40 => ['time::getTimesFromWorkers', ['{DATA.valid}','{DATA.workers}'], 'DATA.times'],
        ],
        'return' => ['json'],
    ],
// time functioms---------------------------------------
    'resettimes' => [
        'funcs' => [
            20 => ['time::resetItem', ['{DATA.valid}']],
            25 => ['worker::getWorkersIdkeybase', [], 'DATA.workers'],
            30 => ['time::getTimesFromWorkers', ['{DATA.valid}','{DATA.workers}'], 'DATA.times'],
        ],
        'return' => ['json'],
    ],
    'deltime' => [
        'funcs' => [
            20 => ['time::delItem', ['{DATA.valid}']],
            25 => ['worker::getWorkersIdkeybase', [], 'DATA.workers'],
            30 => ['time::getTimesFromWorkers', ['{DATA.valid}','{DATA.workers}'], 'DATA.times'],
        ],
        'return' => ['json'],
    ],
    'storetimes' => [
        'funcs' => [
            20 => ['time::storeItems', ['{DATA.valid}']],
            25 => ['worker::getWorkersIdkeybase', [], 'DATA.workers'],
            30 => ['time::getTimesFromWorkers', ['{DATA.valid}','{DATA.workers}'], 'DATA.times'],
        ],
        'return' => ['json'],
    ],

];

