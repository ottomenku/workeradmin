<?php
//figyelem ugyanolyan hulcsnál lefagy!!!!!!!!!!!
return [
'base' => [
    'viewpar' => [
        'template' => 'admin_crudgenerator',
         'frame' => 'backend',
         'Taskviews' => 'baseTaskviews'  ,
    ],
],
'index' => [
  'viewpar'=>[ 
    'view'=>'index',
    'tableinclude'=>'includes.table.table',
    'tableFuncInc'=>'includes.table.actionFunc',    
  ],
    'funcs' => [ 
      10=>['baseOB::moIndex',[],'DATA.tabledata'] 
    ],
'return'=>['view']  
],
'create' => [
    'viewpar'=>[
        'taskhead'=>'Új rekord',
        'view'=>'form',
       // 'form'=>['formStart'=>['formstartCreate',[],false]], //nem zárja le a formot
        'form'=>['formStart'=>['formstartCreate']],//lezárja a formot
        ],
  'return'=>['view']  
    ],
    
'store' => [
  'funcs' => [
    10=>['validateToDATA',[],'DATA.valid'],
    20=>['baseOB::moCreate',['{DATA.valid}']]     
    ],
    'return'=>['redirect','{ACT.viewpar.route}','Adatok mentve'] 

],
'show' => [
  'funcs' => [
    10=>['baseOB::show',['{ACT.viewpar.id}'],'DATA']     
     ],
    'return'=>['view','{ACT.viewpar.route}.show'] 
],
'edit' => [
  'funcs' => [
    10=>['baseOB::moEdit',['{ACT.viewpar.id}'],'DATA']     
         ],

    'viewpar'=>[ 
        'taskhead'=>'Új rekord',
        'view'=>'form',
        'form'=>['formStart'=>['formstartEdit']],
    ],
    'return'=>['view'] 
],
'update' => [
    'succes_message'=>'Adatok frissítése sikeres!',
    'funcs' => [
      10=>['validateToDATA',[],'DATA.valid'],   
      20=>['baseOB::moUpdate',['{ACT.viewpar.id}','{DATA.valid}']],   
      ],
    'return'=>['redirect','{ACT.viewpar.route}'] 
],
'destroy' => [
  'funcs' => [
    10=>['baseOB::moDestroy',['{ACT.id}']]    
    ],
    'return'=>['redirect','{ACT.viewpar.route}','{ACT.succes_message}'] 
],
'pub' => [ 
  'funcs' => [
      10=>['baseOB::pub',['{ACT.viewpar.id}']]     
  ],
  'return'=>['redirect','{ACT.viewpar.route}'] 
],
'unpub' => [ 
  'funcs' => [
      10=>['baseOB::unpub',['{ACT.viewpar.id}']]     
  ],
  'return'=>['redirect','{ACT.viewpar.route}']           
],

];
