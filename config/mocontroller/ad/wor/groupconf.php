<?php
//figyelem ugyanolyan hulcsnál lefagy!!!!!!!!!!!
//BaseWithRouteController
return ['base'=>[
    'obClass'=>[
       // 'ManagerHandler'=>'App\Handlers\ManagerHandler'
    ],
        'funcs' => [
            2=> ['setUserPar',[]],
          //  3=>['ManagerHandler::setCegPar',['{ACT}'],'ACT'] , 
            // 4=>['replaceACT',[]] , 
        ],
        'role'=>['worker'],   
        'viewpar'=>[
            'forminclude'=>'baseTaskviews.baseform_include', //alap formgenerátor becsatolása a form.blade-be
            'menut' => [
                'worker' => [
                 //   1 => ['ad.man.worker', 'Dolgozók'],
                  //  2 => ['ad.man.ceg', 'Cég'],
            /*        2 => ['m/ad.wor.time', ' Napló'],
                    3 => ['m/ad.wor.timesimple', ' egyszerúsitett napló'],
                    4 => ['m/ad.wor.time', ' Üzenetek'],
                    8 => ['/', ' Home'],
                    //  4 => ['/ad.man.user', ' user'],*/
                ]],
            ]   
    ],
];