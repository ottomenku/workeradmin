<?php
//figyelem ugyanolyan hulcsnál lefagy!!!!!!!!!!!
return [
  'base'=>[
     // 'role'=>['admin'],
      'funcs' => [ 
        3=>['replaceACT',[]] 
      ],
      'obClass'=>['baseOB'=>'App\Timetype'],
      'viewpar'=>[
          'route'=>'m/ad.ad.timetypes', //ez alapján múködnek a gombok
              'form'=>[          
                  'name'=>['text','Név',[]],
                  'note'=>['text','Megjegyzés',[]],
                  'szorzo'=>['number','Szorzó',[ 'step' => '0.01']],
                //  'fixplusz'=>['number','Fixplusz',[]],  
                  'pub'=>['radiolist','',[['1','Tiltva' ],['0','Engedélyezve',true ]]] ,
                    'submit'=>['submit','Időtipus mentése'], //,'submit'=>['submit','Ment','class'=>'btn btn-danger'] 
                  'formend'=>['formend']
          ] ] 
  ],

  'index' => [
      'viewpar'=>[ 
          'table'=>[
              'name'=>['Név'],
              'szorzo'=>['Szorzó',],
              'note'=>['megjegyzés'],
              'actions'=> ['Action',['edit','destroy','ifpub']]
          ],     
          ] ,     
          'funcs' => [ 
                10=>['baseOB::moindex',[],'DATA.tabledata'] 
              ],
      'return'=>['view'] 
      // 'return'=>['dump'] 
  ],

  // az ad.groupcomf funkcióinak használata itt is kell hogy legyen kulcs és nem lehet üres------
  'create' => [
    'allowed'=>true,
   // 'delFromParrent'=>['return', 'funcs','viewpar'] , //örökölt külcsok törlése ha nem kell
  ],
  'store' => ['allowed'=>true],
  'show' => ['allowed'=>true],
  'edit' => ['allowed'=>true],
  'update' => ['allowed'=>true],
  'destroy' => ['allowed'=>true],
  'pub' => ['allowed'=>true],
  'unpub' => ['allowed'=>true],

];