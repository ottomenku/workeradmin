<?php
//figyelem ugyanolyan hulcsnál lefagy!!!!!!!!!!!
//BaseWithRouteController
return [

    'base'=>[
   // 'allowed'=>false,   
   // 'delFromParrent'=>[ 'viewpar.menu.superadmin.egy'] ,
    'obClass'=>['ProbaHandler'=>'App\Handlers\ProbaHandler'],
    'viewpar'=>[
        'route'=>'m/proba', //ez alapján múködnek a gombok

        ]
    ],
    'index' => [
       // 'allowed'=>true,
          'funcs' => [
     20=>['ProbaHandler::test',[],'DATA']     
        ],  
        'return'=>['dump']                     
],

/*
    'index' => [
    // 'delFromParrent'=>[ 'funcspppp'],
       //'role'=>'manager',
     //  'replaceACT'=>false,
        'viewpar'=>[ 

            'taskheader'=>'Worker manager, Cég:{ACT.cegnev}',
            'view'=>'index',
            'table'=>[
                'id'=>['Id',],
                'name'=>['Felhasználó név','$item->user->name'] ,
                'fullname'=>['Teljes név'] ,
               'email'=>['Email','$item->user->email']
                ],
                'table_action'=> ['show'=>true,'edit'=>true,'destroy'=>true  ]
            ]   ,   
            'funcs' => [
               10=>['replaceACT',[]] , 
                20=>['baseOB::getWorkers',['{ACT}','{OB.Request}'],'DATA.tabledata']  
                ],
        ],

    'create' => [
        'viewpar'=>[ 
            'taskheader'=>'Új dolgozó Cég:{ACT.cegnev}',
            'form'=>[   
                'password'=> ['text','Jelszó',['required' => 'required']],
            ],    
        ], 
          'funcs' => [
                10=>['replaceACT',[]] 
            ],
    ],

    'store' => [
        'funcs' => [
           8=>['replaceACT',[]] , 
            10=>['validateToDATA',[],'DATA.valid'],
            20=>['baseOB::workerCreate',['{DATA.valid}','{ACT}']]  
           ],
           'return'=>['redirect','{ACT.viewpar.route}','Dolgozó mentve:'] 
     ],
        
     'edit' => [
        'viewpar'=>[           
            'taskheader'=>'{ACT.name} adatainak mődosítása Cég:{ACT.cegnev}',
        ],
        'funcs' => [
            8=>['replaceACT',[]] , 
            10=>['baseOB::findWorkerArr',['{ACT.viewpar.id}'],'DATA'] ,
           // 15=>['ceg::toArray',[],'DATA.ceg'],
              ],
     ],

   
  
    'update' => [ 'succes_message'=>'Dolgozó adatai frissítve!',
   // 'delFromParrent'=>[ 'funcs'],
    'funcs' => [
        8=>['replaceACT',[]] , 
        10=>['validateToDATA',[],'DATA.valid'],
       20=>['baseOB::workerUpdate',['{ACT.viewpar.id}','{DATA.valid}']]     
        ],
    
    ],
     'show' => [],
    'destroy' => [  'delFromParrent'=>[ 'funcs'],
    'funcs' => [
        8=>['replaceACT',[]], 
        10=>['baseOB::workerDestroy',['{ACT.viewpar.id}']]     
        ]],
        */
];