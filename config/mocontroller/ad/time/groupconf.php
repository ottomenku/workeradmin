<?php
return [
    'base' => [
        'obClass'=>['time'=>'App\Time','day'=>'App\Day','baseday'=>'App\Baseday','timetype'=>'App\Timetype','daytype'=>'App\Daytype',
        'worker'=>'App\Worker','stored'=>'App\Stored','CalendarHandler'=>'App\Handlers\CalendarHandler'],
        'viewpar' => [
            //'baseroute' => 'm/ad.wor.time.timesimple/', //ez alapján múködnek a gombok
            'menu' => [
              /*  'manager' => [
                    1 => ['m/ad.man.worker', 'Dolgozók'],
                    10 => ['m/ad.time.manager', 'Munkaidők'],
                  //  15 => ['m/ad.man.time.timesimple', 'Munkaidők egyszerűsített'],
                  //  20 => ['m/ad.man.messages', 'Üzenetek'],
               //     25 => ['m/ad.man.docs', 'okumentumok'],
               //     30 => ['m/ad.man.time.stored', 'Zárások'],
                    35 => ['/', ' Home'],
                ],
                'worker' => [
                    //   1 => ['ad.man.worker', 'Dolgozók'],
                     //  2 => ['ad.man.ceg', 'Cég'],
                     10 => ['m/ad.time.worker', 'Munkaidők'],
                       8 => ['/', ' Home'],
                        8 => ['m/ad.time.booking', ' Kérelmek'],
                       //  4 => ['/ad.man.user', ' user'],
                   ]*/
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
        //       'return'=>['dump']
    ],

    'getbasedata' => [
        'funcs' => [
            14 => ['timetype::allpluck', [], 'DATA.timetypes'],
            16 => ['daytype::allPluck', [], 'DATA.daytypes'],
            20 => ['baseOB::setWorkerAndCegPar', ['{DATA}'], 'DATA'],
            60 => ['CalendarHandler::getBaseCalendarData', ['{DATA.valid}', '{DATA}'], 'DATA'],
            70 => ['time::getTimes', ['{DATA.valid}'], 'DATA.times'],
            80 => ['day::getDays', ['{DATA.valid}'], 'DATA.workerdays'],
            90 => ['stored::getStoreds', ['{DATA.valid}'], 'DATA.storeds'],
        ],
        'return' => ['json'],
        //     'return'=>['dump']
    ],
    'freshdata' => [
        'funcs' => [
            60 => ['CalendarHandler::getBaseCalendarData', ['{DATA.valid}', '{DATA}'], 'DATA'],
            70 => ['time::getTimes', ['{DATA.valid}'], 'DATA.times'],
            80 => ['day::getDays', ['{DATA.valid}'], 'DATA.workerdays'],
            90 => ['stored::getStoreds', ['{DATA.valid}'], 'DATA.storeds'],
        ],

        'return' => ['json'],
        //    'return'=>['dump']
    ],


//day functions-------------------------------------
    'resetdays' => [
        'funcs' => [
            20 => ['day::resetItem', ['{DATA.valid}']],
            30 => ['day::getDays', ['{DATA.valid}'], 'DATA.workerdays'],
        ],
        'return' => ['json'],
    ],
    'delday' => [
        'funcs' => [
            20 => ['day::delItem', ['{DATA.valid}']],
            30 => ['day::getDays', ['{DATA.valid}'], 'DATA.workerdays'],
        ],
        'return' => ['json'],
    ],
    'storedays' => [
        'funcs' => [
            20 => ['day::storeItems', ['{DATA.valid}']],
            30 => ['day::getDays', ['{DATA.valid}'], 'DATA.workerdays'],
        ],
        'return' => ['json'],
    ],
// time functioms---------------------------------------
    'resettimes' => [
        'funcs' => [
            20 => ['time::resetItem', ['{DATA.valid}']],
            30 => ['time::getTimes', ['{DATA.valid}'], 'DATA.times'],
        ],
        'return' => ['json'],
    ],
    'deltime' => [
        'funcs' => [
            20 => ['time::delItem', ['{DATA.valid}']],
            30 => ['time::getTimes', ['{DATA.valid}'], 'DATA.times'],
        ],
        'return' => ['json'],
    ],
    'storetimes' => [
        'funcs' => [
            20 => ['time::storeItems', ['{DATA.valid}']],
          90 => ['time::getTimes', ['{DATA.valid}'], 'DATA.times'],
        ],
        'return' => ['json'],
    ],

];

