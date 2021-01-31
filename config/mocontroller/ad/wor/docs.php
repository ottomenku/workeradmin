<?php
//figyelem ugyanolyan hulcsnál lefagy!!!!!!!!!!!
//BaseWithRouteController


return [

    'base'=>[
        'funcs' => [ 
            3=>['replaceACT',[]] 
          ],  
    'validations' =>['foto'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'] ,
   // 'delFromParrent'=>[ 'viewpar.menu.superadmin.egy'] ,
    'obClass'=>['baseOB'=>'App\Doc','worker'=>'App\Worker'],
    'viewpar'=>[
        'route'=>'m/ad.wor.docs', //ez alapján múködnek a gombok
  
        ]
    ],
    'index' => [
    // 'delFromParrent'=>[ 'funcspppp'],
       //'role'=>'manager',worker_id', 'origin', 'name', 'filename', 'path', 'worknote', 'worknote', 'pub'
     //  'replaceACT'=>false,
        'viewpar'=>[ 

            'taskheader'=>'Worker manager, Cég:{ACT.cegnev}',
            'view'=>'index',
            'table'=>[
               // 'id'=>['Id',],
              //  'join_1'=>['Dolgozó','worker','workername'] ,
                'name'=>['doc'] ,
                 'created_at'=>['Dátum'] ,
               // 'fullname'=>['Teljes név'] ,
              //  'join_2'=>['Email','user','email'],
              //  'actions'=> ['Action',[['show',['style'=>'none']],'download','ifpub'] ]
              'actions'=> ['Action',['download'] ]
                ],
                
            ]   ,   
            'funcs' => [
               10=>['replaceACT',[]] , 
             //  20=>['baseOB::getManagerAdatkezeles',['{ACT}','{OB.Request}'],'DATA.tabledata']  
             20=>['baseOB::getWorkerDocs',[],'DATA.tabledata']  
                ],
             //  'return'=>['dump']    
        ],

    'create' => [
        'viewpar'=>[ 
            'taskheader'=>'Új dolgozó Cég:{ACT.cegnev}',
            
        ], 
          'funcs' => [
                10=>['replaceACT',[]] ,
                 20=>['worker::getWorkers',[],'DATA']  
            ],
      
        //  'return'=>['dump'],

          'return'=>['viewsimple','admin_crudgenerator.docs.create']
    ],

    'store' => [
        'funcs' => [
           8=>['replaceACT',[]] , 
            10=>['validateToDATA',[],'DATA.valid'],
            20=>['baseOB::storeAdatkezeles',['{DATA.valid}','{ACT}']]  
           ],
           'return'=>['redirect','{ACT.viewpar.route}','Dolgozó mentve:'] 
     ],
     'download' => [
        'funcs' => [
           8=>['replaceACT',[]] , 
          //  10=>['validateToDATA',[],'DATA.valid'],
            20=>['baseOB::download',['{ACT.viewpar.id}'],'DATA.file']  
           ],
        //  'return'=>['redirect','{ACT.viewpar.route}','letöltés'] 
        'return'=>['downloadFromStorage'] 
     ],    
     'edit' => [
        'viewpar'=>[           
            'taskheader'=>'{ACT.name} adatainak mődosítása Cég:{ACT.cegnev}',
        ],
        'funcs' => [
            8=>['replaceACT',[]] , 
            10=>['baseOB::moEdit',['{ACT.viewpar.id}'],'DATA'] ,
           // 15=>['ceg::toArray',[],'DATA.ceg'],
              ],
     ],

   
  
    'update' => [ 'succes_message'=>'Dolgozó adatai frissítve!',
   // 'delFromParrent'=>[ 'funcs'],
    'funcs' => [
        8=>['replaceACT',[]] , 
        10=>['validateToDATA',[],'DATA.valid'],
       20=>['baseOB::moUpdate',['{ACT.viewpar.id}','{DATA.valid}']]     
        ],
    
    ],

    'destroy' => [  'delFromParrent'=>[ 'funcs'],
    'funcs' => [
        8=>['replaceACT',[]], 
        10=>['baseOB::destroyOne',['{ACT.viewpar.id}']]     
        ]],
 // az ad.groupcomf funkcióinak használata itt is kell hogy legyen kulcs és nem lehet üres------        
'pub' => ['allowed'=>true],
'unpub' => ['allowed'=>true],
'show' => ['allowed'=>true], 
];