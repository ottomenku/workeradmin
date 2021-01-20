<?php
//figyelem ugyanolyan hulcsnál lefagy!!!!!!!!!!!
//BaseWithRouteController
return [

    'base'=>[
   // 'allowed'=>false,   
   // 'delFromParrent'=>[ 'viewpar.menu.superadmin.egy'] ,
    'obClass'=>['baseOB'=>'App\Worker','ManagerHandler'=>'App\Handlers\ManagerHandler'],
    'viewpar'=>[
        'route'=>'m/ad.man.worker', //ez alapján múködnek a gombok
        'form'=>[   
            'name'=>['text','Felhasználónév (egyedi)',['required' => 'required']],
            'fullname'=>['text','Teljes Név',[]],
            'email'=> ['email','Email',['required' => 'required']],
            'password'=> ['text','Jelszó (Ha üresen marad nem változik)',[]],
            'position'=> ['text','',[]],
            'foto'=> ['file','',[]],
            'fullname'=> ['text','',[]],
            'cim'=> ['text','',[]],
            'tel'=> ['text','',[]],
            'ado'=> ['text','',[]],
            'tb'=> ['text','',[]],
            'start'=> ['date','',[]],
            'end'=> ['date','',[]],
            'note'=> ['text','',[]],
            'pub'=>['radiolist','',[['1','Tiltva' ],['0','Engedélyezve',true ]]] ,
            'submit'=>['submit','Ment user'] ,//,'submit'=>['submit','Ment','class'=>'btn btn-danger'] 
        ],
        ]
    ],
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
];