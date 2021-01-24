<?php
return [
    'base' => [
        'obClass'=>['baseOB'=>'App\Time','day'=>'App\Day','baseday'=>'App\Baseday','timetype'=>'App\Timetype','daytype'=>'App\Daytype',
        'worker'=>'App\Worker','stored'=>'App\Stored','CalendarHandler'=>'App\Handlers\CalendarHandler'],
        'funcs' => [
                5 => ['replaceACT', []],
                10 => ['validateToDATA', [], 'DATA.valid'],
        ],
 
    ],
// index ----------------------------
    'index' => [
        'viewpar' => [
            'taskheader' => 'Munkaidők, Cég:{ACT.cegnev}', 
        ],
        'funcs' => [
            //elsőnek kell lefuttatmi mert felül írja a DATA-t (felülírja a base validálást)
            10 => ['CalendarHandler::getFullcalendarData', ['{ACT.routpars.id}', '{ACT.routpars.id1}'], 'DATA'],
            20 => ['worker::getWorkersToSelect', [], 'DATA.workersSelect'],
            20 => ['worker::getWorkersIdkey', [], 'DATA.workers'],
            40=> ['worker::getWorkerids', [], 'DATA.workerids']],
            
    ],
// calendar ----------------------------------
    'calendar' => [
        'funcs' => [
            //elsőnek kell lefuttatmi mert felül írja a DATA-t( felülírja a base validálást)
            10 => ['CalendarHandler::getFullcalendarData', ['{ACT.routpars.id}', '{ACT.routpars.id1}'], 'DATA'],
        ],
       
    ],
// times ********************************************************  

 //    10 => ig base functions: replace, validálás
//storetimes---------------------------------- 
    'storetimes' => [
        'funcs' => [       
            20 => ['baseOB::storetimesManSimple', ['{DATA.valid}'], 'DATA.times'],
        ],
        'return' => ['json', ['times' => 'DATA.times']],
    ],
//deltimes -------------------------------------
    'deltimes' => [
        'funcs' => [
            20 => ['baseOB::deltimesMan', ['{DATA.valid}'], 'DATA.times'],
        ],
        'return' => ['json', ['times' => 'DATA.times']],
    ],
 //deltime----------------------------------------   
    'deltime' => [
        'funcs' => [
            20 => ['baseOB::deltimeMan', ['{DATA.valid}'], 'DATA.times'],
        ],
        'return' => ['json', ['times' => 'DATA.times']],
    ],
//timerreset-------------------------------------------
    'timesreset' => [
        'funcs' => [
            20 => ['baseOB::timesResetMan', ['{DATA.valid}'], 'DATA.times'],
        ],
        'return' => ['json', ['times' => 'DATA.times']],
    ],

 // days **********************************************************************   
 //del------------------------
    'delday' => [
        'funcs' => [
            20 => ['day::deldayMan', ['{DATA.valid}'], 'DATA.workerdays'],
        ],
        'return' => ['json', ['workerdays' => 'DATA.workerdays']],
    ],
//reset------------------------------------
    'daysreset' => [
        'funcs' => [
            20 => ['day::daysResetMan', ['{DATA.valid}'], 'DATA.workerdays'],
        ],
        'return' => ['json', ['workerdays' => 'DATA.workerdays']],
    ],
//store---------------------------------------
    'storedays' => [
        'funcs' => [
            20 => ['day::storeDaysMan', ['{DATA.valid}'], 'DATA.workerdays'],
        ],
        'return' => ['json', ['workerdays' => 'DATA.workerdays']],
    ],

];
