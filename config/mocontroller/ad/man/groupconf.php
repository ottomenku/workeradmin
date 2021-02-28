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
       ],

],
];
