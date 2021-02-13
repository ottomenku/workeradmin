<?php
//figyelem ugyanolyan hulcsnál lefagy!!!!!!!!!!!
//BaseWithRouteController


return [

    'base'=>[
    'role'=>['manager'], //changeuser/aD15ll465ghAjfEbbulkkkkllllllhgzz/35  ggg2 manager
    'validations' =>['foto'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'] ,
    'obClass'=>['baseOB'=>'App\Doctemplate'],
    'viewpar'=>[
        'route'=>'m/ad.man.doc.general', //ez alapján múködnek a gombok
        ]
    ], 

    'index' => [
      'viewpar'=>[ 

        'taskheader'=>'Dokumentum generáló',
        'view'=>'index',
        'table'=>[
            'id'=>['Id'],
           // 'join_1'=>['Dolgozó','worker','workername'] ,
          'name'=>['Azonosító'] ,
           'created_at'=>['Dátum'] ,
           // 'fullname'=>['Teljes név'] ,
          //  'join_2'=>['Email','user','email'],
          //  'actions'=> ['Action',[['show',['style'=>'none']],'download','ifpub'] ]
          'actions'=> ['Action',['download','destroy'] ]
            ],
            
        ]   ,   
        'funcs' => [
           10=>['replaceACT',[]] , 
         //  20=>['baseOB::getManagerAdatkezeles',['{ACT}','{OB.Request}'],'DATA.tabledata']  
         20=>['baseOB::getTemplates',[],'DATA.tabledata']  
            ],
         //  'return'=>['dump']  
         'return'=>['view'] 
    ], 
    'create' => [
      'viewpar'=>[ 
          'taskheader'=>'Új dokumentum sablon generálás',
          
      ], 
        'funcs' => [
              10=>['replaceACT',[]] ,
               20=>['worker::getWorkers',[],'DATA.workers'],  
               25=>['worker::getUserCeg',[],'DATA.ceg']  
        ],
         
    
      //  'return'=>['dump']

        'return'=>['viewsimple','admin_crudgenerator.docs.create']
  ],

];