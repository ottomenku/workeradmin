<?php
//figyelem ugyanolyan hulcsnál nem tölti be !!!!!!!!!!!
// a többit igen...
return [
'base'=>[
    'viewpar'=>[ 
        'template'=>'cristal.index',
       // 'host'=>'http://workertime.mottoweb.hu/',
       'host'=>env('APP_URL').'/',
    'menu' => [
        'admin' => [ //áthelyezve a sidebarba hogy sima kontrollernél is megjelenjen
            1 => ['m/ad.ad.ceg', 'Cégek'],
           2 => ['m/ad.ad.timetypes', ' Időtipusok'],
           3 => ['m/ad.ad.daytypes', ' Natipusok'],
           4 => ['m/ad.ad.basedays', 'Naptár'],
           5 => ['/moreset', 'Jelszó változtatás'],
         //  6 => ['/', ' Home'],
        ],
    

        'superadmin' => [
            1 => ['/admin/pages', ' Pages'],
            2 => ['/admin/generator', ' Generátor'],
            3 => ['/moreset', 'Jelszó változtatás'],

        ],
        'manager' => [
            1 => ['m/ad.man.worker', 'Dolgozók'],
            10 => ['m/ad.time.manager', 'Munkaidők'],
            12 => ['m/ad.man.booking', ' Kérelmek'],
            15 => ['/moreset', 'Jelszó változtatás'],
           // 35 => ['/', ' Home'],
        ],
        'worker' => [
            10 => ['m/ad.time.worker', 'Munkaidők'],
            11 => ['m/ad.wor.docs', 'Dolumentumok'],
            12 => ['m/ad.wor.booking', ' Kérelmek'],
            15=> ['/moreset', 'Jelszó változtatás'],
            //20=> ['/', ' Home'],
           ]
       ] 
    ],
]
];