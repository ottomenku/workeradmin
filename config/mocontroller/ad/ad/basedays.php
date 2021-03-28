<?php
//figyelem ugyanolyan hulcsnál lefagy!!!!!!!!!!!
    return [
        'base'=>[
            'role'=>['admin'],
            'funcs' => [ 
              3=>['replaceACT',[]] 
            ],
            'obClass'=>['baseOB'=>'App\Baseday','daytype'=>'App\Daytype'],
            'viewpar'=>[
                'route'=>'m/ad.ad.basedays', //ez alapján múködnek a gombok
                    'form'=>[          
                       // 'daytype_id'=>['select','Naptípus',[]],
                        'name'=>['text','Cím',[]],
                        'workday'=>['radiolist','',[['1','munkanap' ],['0','szabadnap',true ]]] ,
                        'note'=>['text','Megjegyzés',[]],
                       // 'workday'=>['radiolist','',[['1','Munkanap' ],['0','Pihenőnap',true ]]] ,
                        'datum'=> ['date','',[]],
                        'pub'=>['radiolist','',[['1','Tiltva' ],['0','Engedélyezve',true ]]] ,
                         'submit'=>['submit','Mentés'], //,'submit'=>['submit','Ment','class'=>'btn btn-danger'] 
                        'formend'=>['formend']
                ] ] 
        ],
        'index' => [
            'viewpar'=>[ 
                'table'=>[
                    //'id'=>[],
                    'datum'=>['Dátum',],
                       'name'=>['cím'],
                      'note'=>['megjegyzés'],            
                   // 'join_1'=>['Naptipus','daytype','name'],
                    //'join_'=>['Munkanap','daytype','workday'],
                     'actions'=> ['Action',['edit','destroy','ifpub'] ]
                ],
                ] ,  
           // 'return'=>['dump']         
        ],
  // az ad.groupcomf funkcióinak használata itt is kell hogy legyen kulcs és nem lehet üres------
    'create' => [
        'funcs' => [ 
            60=>['daytype::baseDaytypesPluck',[],'DATA.daytype_id_list'] 
        ],
    // 'delFromParrent'=>['return', 'funcs','viewpar'] , //örökölt külcsok törlése ha nem kell
   // 'return'=>['dump'] 
    ],
  'edit' => [
    'funcs' => [ 
        5=>['daytype::baseDaytypesPluck',[],'DATA.daytype_id_list'] 
      ],
    ],

  'store' => ['allowed'=>true],
  'show' => ['allowed'=>true],

  'update' => ['allowed'=>true],
  'destroy' => ['allowed'=>true],
  'pub' => ['allowed'=>true],
  'unpub' => ['allowed'=>true],

];