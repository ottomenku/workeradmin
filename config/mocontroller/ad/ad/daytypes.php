<?php
//figyelem ugyanolyan hulcsnál lefagy!!!!!!!!!!!
    return [
        'base'=>[
            'role'=>['admin'],
            'funcs' => [ 
              3=>['replaceACT',[]] 
            ],
            'validations' =>['icon'  => 'required'] ,
            'obClass'=>['baseOB'=>'App\Daytype','timetype'=>'App\Timetype','ceg'=>'App\Ceg'],
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
                        'userallowed'=>['radiolist','',[['1','Usereknek is' ],['10','Managereknek',true ],['100','Adminoknak' ]]] ,
                        'szorzo'=>['number','Szorzó',[ 'step' => '0.01']],
                        'fixplusz'=>['number','Fixplusz',[]], 
                        'ceg_id'=>['selectFromPluck','Cég aki használhatja','cegs','1'] ,
                        'pub'=>['radiolist','',[['0','Tiltva' ],['1','Engedélyezve',true ]]] ,
                         'submit'=>['submit','Naptípus mentése'], //,'submit'=>['submit','Ment','class'=>'btn btn-danger'] 
                        'formend'=>['formend']
                ] ] 
        ],
        'index' => [
            'viewpar'=>[ 
                'view'=>'index',
                'table'=>[
                    'name'=>['Név'],
                   // 'szorzo'=>['Szorzó'],
                   'join_i'=>['Tulajdonos','ceg','cegnev'],
                    'icon_1'=>['Icon',['colname'=>'icon','colorcolname'=>'color','backgroundcolorcolname'=>'background']],
                    //'fixplusz'=>['fixplusz'],
                    'note'=>['megjegyzés'],
                   // 'workday'=>['Munkanap'],
                    'action_0'=> ['munkanap',[
                      ['ifplusz',['text',['valuecol'=>'workday','text'=>'Igen','style'=>'color:green;font-size:1em;',]]] ,
                       ['ifnull',['text',['valuecol'=>'workday','text'=>'nem','style'=>'color:red;font-size:1em;',]]] 
                      ]],
               //    'action_1'=> ['Dolgozóknak',[
                //    ['ifplusz',['text',['valuecol'=>'userallowed','text'=>'Enged','style'=>'color:green;font-size:1em;',]]] ,
               //      ['ifnull',['text',['valuecol'=>'userallowed','text'=>'Tilt','style'=>'color:red;font-size:1em;',]]] 
               //     ]],
                    'actions'=> ['Action',['edit','destroy','ifpub']]
                ],

                ] ,     
                'funcs' => [ 
                   //  10=>['baseOB::moIndex',[],'DATA.tabledata'] 
                   10=>['baseOB::getAllWithCeg',[],'DATA.tabledata'] 
                   ],
            'return'=>['view'] 
           // 'return'=>['dump'] 
        ],
  // az ad.groupcomf funkcióinak használata itt is kell hogy legyen kulcs és nem lehet üres------
  'create' => [
    'allowed'=>true,
    'funcs' => [ 
      10=>['timetype::timetypesPluck',[],'DATA.timetype_id_list'] ,
      20=>['ceg::getCegPluck',[],'DATA.cegs'] 
    ],

   // 'delFromParrent'=>['return', 'funcs','viewpar'] , //örökölt külcsok törlése ha nem kell
  ],
  'store' => ['allowed'=>true],
  'show' => ['allowed'=>true],
  'edit' => [    'funcs' => [ 
   10=>['baseOB::getDaytype',['{ACT.viewpar.id}'],'DATA.formdata'] ,
   20=>['ceg::getCegPluck',[],'DATA.cegs'] ,
    30=>['timetype::timetypesPluck',[],'DATA.timetype_id_list'] 
  ],
 // 'return'=>['dump'] 
],
  'update' => ['allowed'=>true],
  'destroy' => ['allowed'=>true],
  'pub' => ['allowed'=>true],
  'unpub' => ['allowed'=>true],

];