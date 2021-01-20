<?php
//figyelem ugyanolyan hulcsnál lefagy!!!!!!!!!!!
//BaseWithRouteController
return [
    'base' => [
        'role' => ['admin'],
        'obClass' => ['baseOB' => 'App\Handlers\ManagerHandler'],
        'viewpar' => [
            'baseroute' => 'm/ad.time.admin/', //ez alapján múködnek a gombok
            'route' => 'm/ad.time.admin/',
        ],
    ],
    'index' => [
      
        // 'delFromParrent' => ['obClass', 'funcs'],
        //'return' => ['viewFull', 'MOcalendarVue.calendarManager'],
        'return' => ['viewFull', 'mocalendarVue.calendarWorkerDev'],
            //  'return'=>['dump']
    ],
    'getceg' => [

         'return' => ['viewFull', 'mocalendarVue.calendarWorkerDev'],
        //     'return'=>['dump']
    ],
    'getbasedata' => [
        'delFromParrent' => ['funcs'],
        'funcs' => [
           /// 5 => ['replaceACT', []],
            10 => ['validateToDATA', [], 'DATA.valid'],
            90 => ['stored::getAdminStoreds', ['{DATA.valid}'], 'DATA.storeds'],
        ],
        'return' => ['json'],
        //     'return'=>['dump']
    ],
    'freshdata' => [
        'delFromParrent' => ['funcs'],
        'funcs' => [
           /// 5 => ['replaceACT', []],
            10 => ['validateToDATA', [], 'DATA.valid'],
            90 => ['stored::getAdminStoreds', ['{DATA.valid}'], 'DATA.storeds'],
        ],

        'return' => ['json'],
        //    'return'=>['dump']
    ],
//timeframes----------------------------------
'timeframes' => [
    'funcs' => [
      //  20 => ['stored::nyitStored', ['{DATA.valid}']],
        90 => ['CalendarHandler::timeframes', ['{DATA.valid}'], 'DATA.timeFrames'],
    ],
    'return' => ['json'],
  ],


//stored---------------------------
'nyitstored' => [
  'funcs' => [
      20 => ['stored::nyitStored', ['{DATA.valid}']],
      90 => ['stored::getAdminStoreds', ['{DATA.valid}'], 'DATA.storeds'],
  ],
  'return' => ['json'],
],
'zarstored' => [
  'funcs' => [
      20 => ['stored::zarStored', ['{DATA.valid}']],
      90 => ['stored::getAdminStoreds', ['{DATA.valid}'], 'DATA.storeds'],
  ],
  'return' => ['json'],
],


];