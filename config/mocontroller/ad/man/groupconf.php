<?php
//figyelem ugyanolyan hulcsnál lefagy!!!!!!!!!!!
//BaseWithRouteController   // App\Handlers\ManagerHandler
return ['base' => [
    'role' => ['manager'],
    'funcs' => [ 
        1=>['ManagerHandler::pubRes',[]] //ellenőrzi hogy a manager vagy a manager  cége nincs-e letiltva
      ],
      'obClass'=>['ManagerHandler'=>'App\Handlers\ManagerHandler'],
    'viewpar' => [
        'forminclude' => 'baseTaskviews.baseform_include', //alap formgenerátor becsatolása a form.blade-be
        'menu' => [
            'manager' => [
                1 => ['m/ad.man.worker', 'Dolgozók'],
            //    5 => ['ad.man.ceg', 'Cég'],
                10 => ['m/ad.time.manager', 'Munkaidők'],
              //  15 => ['m/ad.man.time.timesimple', 'Munkaidők egyszerűsített'],
              //  20 => ['m/ad.man.messages', 'Üzenetek'],
           //     25 => ['m/ad.man.docs', 'okumentumok'],
           //     30 => ['m/ad.man.time.stored', 'Zárások'],
                35 => ['/', ' Home'],

            ]
       ],
    ],
],
];
