<?php
//figyelem ugyanolyan hulcsnál lefagy!!!!!!!!!!!
    return [
        'base'=>[
            'role'=>['admin'],
            'viewpar' => [
                    'forminclude'=>'baseTaskviews.baseform_include', //alap formgenerátor becsatolása a form.blade-be
                    'menu' => [
                    /*    'admin' => [ // áthelyezve a sidebarba hogy sima kontrolernél is legyen
                            1 => ['m/ad.ad.ceg', 'Cégek'],
                            2 => ['m/ad.ad.timetypes', ' Időtipusok'],
                            3 => ['m/ad.ad.daytypes', ' Natipusok'],
                            4 => ['m/ad.ad.basedays', 'Naptár'],
                            5 => ['/', ' Home'],
                        ],*/
                    ] ]  
    ],
];
