<?php
//figyelem ugyanolyan hulcsnál lefagy!!!!!!!!!!!
//BaseWithRouteController
return [  
    'base'=>[
   // 'delFromParrent'=>[ 'viewpar.menu.superadmin.egy'] ,
    'obClass'=>['baseOB'=>'App\User'],
    'viewpar'=>[
        'route'=>'ad.man.user', //ez alapján múködnek a gombok
        'forminclude'=>'baseTaskviews.baseform_include' //alap formgenerátor becsatolása a form.blade-be
        ]
    ],
    'index' => [
        'viewpar'=>[ 
            'view'=>'index'
            ,'table'=>[
                'id'=>[]
                ,'name'=>['Felhasználó név']
                ,'email'=>['Email','$item->email']
                ]
                ,'table_action'=> ['show'=>true,'edit'=>true,'destroy'=>true  ]
            ]      
        ,'funcs' => [
        //'obkey.funktionName_1'=>[['string','ACT.user.id','DATA.']'ACT.res'],
        //'funktionName'=>[]
        //'baseOB.all'=>[[],'DATA.tabledata']
        '10*indexSetData'=>[[],'DATA.tabledata']
        ],
        'return'=>['view'] 
        ],

    'create' => [
        'viewpar'=>[ 
            'taskhead'=>'Új felhasználó',
            'form'=>[   
                'name'=>['text','Név',[]],
                'email'=> ['email','Email',['required' => 'required']],
                'password'=> ['password','Jelszó',['required' => 'required']],
                'password2'=> ['password','Jelszó újra',['required' => 'required']],
                'submit'=>['submit','Ment user'] ,//,'submit'=>['submit','Ment','class'=>'btn btn-danger'] 
            ],
        ],
    ],

    'store' => [
'delFromParrent'=>[ 'funcs.20*baseOB:create'],
      'funcs' => [
        '14*insertUser'=>[['DATA.valid'],'DATA.id'],     
        ],
        'return'=>['redirect','{ACT.viewpar.route}','Cég mentve:'] 
    ],
   
];