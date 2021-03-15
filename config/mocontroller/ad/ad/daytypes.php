<?php
//figyelem ugyanolyan hulcsnál lefagy!!!!!!!!!!!
    return [
        'base'=>[
            'role'=>['admin'],
            'funcs' => [ 
              3=>['replaceACT',[]] 
            ],
            'obClass'=>['baseOB'=>'App\Daytype','timetype'=>'App\Timetype'],
            'viewpar'=>[
                'route'=>'m/ad.ad.daytypes', //ez alapján múködnek a gombok
                    'form'=>[  
                        'timetype_id'=>['select','Alapértelmezett időtipus',[]],  
                        'name'=>['text','Név',[]],
                        'note'=>['text','Megjegyzés',[]],
                        'icon'=>['text','Icon',[]],
                        'iconlist'=>['iconlist','beszúrható Iconok',[]],
                        'color'=>['text','Szín',[]],
                        'background'=>['text','Háttérszín',[]],
                        'workday'=>['radiolist','',[['1','Munkanap' ],['0','Pihenőnap',true ]]] ,
                        'userallowed'=>['radiolist','',[['1','felhasználók kérhetik' ],['0','felhasználók nem kérhetik',true ]]] ,
                        'szorzo'=>['number','Szorzó',[ 'step' => '0.01']],
                        'fixplusz'=>['number','Fixplusz',[]],  
                        'pub'=>['radiolist','',[['1','Tiltva' ],['0','Engedélyezve',true ]]] ,
                         'submit'=>['submit','Naptípus mentése'], //,'submit'=>['submit','Ment','class'=>'btn btn-danger'] 
                        'formend'=>['formend']
                ] ] 
        ],
        'index' => [
            'viewpar'=>[ 
                'view'=>'index',
                'table'=>[
                    'name'=>['Név'],
                    'szorzo'=>['Szorzó'],
                    'icon_1'=>['Icon',['colname'=>'icon','colorcolname'=>'color','backgroundcolorcolname'=>'background']],
                    //'fixplusz'=>['fixplusz'],
                    'note'=>['megjegyzés'],
                   // 'workday'=>['Munkanap'],
                    'action_0'=> ['munkanap',[
                      ['ifplusz',['text',['valuecol'=>'workday','text'=>'Igen','style'=>'color:green;font-size:1em;',]]] ,
                       ['ifnull',['text',['valuecol'=>'workday','text'=>'nem','style'=>'color:red;font-size:1em;',]]] 
                      ]],
                   'action_1'=> ['Dolgozóknak',[
                    ['ifplusz',['text',['valuecol'=>'userallowed','text'=>'Enged','style'=>'color:green;font-size:1em;',]]] ,
                     ['ifnull',['text',['valuecol'=>'userallowed','text'=>'Tilt','style'=>'color:red;font-size:1em;',]]] 
                    ]],
                    'actions'=> ['Action',['edit','destroy','ifpub']]
                ],

                ] ,     
                'funcs' => [ 
                     10=>['baseOB::moIndex',[],'DATA.tabledata'] 
                   ],
            'return'=>['view'] 
           // 'return'=>['dump'] 
        ],
  // az ad.groupcomf funkcióinak használata itt is kell hogy legyen kulcs és nem lehet üres------
  'create' => [
    'allowed'=>true,
    'funcs' => [ 
      10=>['timetype::timetypesPluck',[],'DATA.timetype_id_list'] 
    ],

   // 'delFromParrent'=>['return', 'funcs','viewpar'] , //örökölt külcsok törlése ha nem kell
  ],
  'store' => ['allowed'=>true],
  'show' => ['allowed'=>true],
  'edit' => [    'funcs' => [ 
    10=>['baseOB::getDaytype',['{ACT.viewpar.id}'],'DATA'] ,
    30=>['timetype::timetypesPluck',[],'DATA.timetype_id_list'] 
  ],],
  'update' => ['allowed'=>true],
  'destroy' => ['allowed'=>true],
  'pub' => ['allowed'=>true],
  'unpub' => ['allowed'=>true],

];