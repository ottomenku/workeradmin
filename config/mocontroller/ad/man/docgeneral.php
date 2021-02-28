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
    'obClass'=>['baseOB'=>'App\Doc','worker'=>'App\Worker','user'=>'App\User','ManagerHandler'=>'App\Handlers\ManagerHandler'],
    'viewpar'=>[
        'route'=>'m/ad.man.docgeneral', //ez alapján múködnek a gombok
        'doc_tmpl'=>'tajekoztato',
  
        ]
    ],
    'preview' => [
      'funcs' => [  
     // 20=>['baseOB::getMenu',[], "DATA"]  
          ],
     //   'return'=>['dump']  
        'return'=>['pdfstream'] 
      // 'return'=>['view'] 
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
                'join_1'=>['Dolgozó','worker','workername'] ,
                'name'=>['doc'] ,
                 'created_at'=>['Dátum'] ,
               // 'fullname'=>['Teljes név'] ,
              //  'join_2'=>['Email','user','email'],
              //  'actions'=> ['Action',[['show',['style'=>'none']],'download','ifpub'] ]
              'actions'=> ['Action',['previewid_new_vindow','download','destroy','ifpub'] ]
                ],
                
            ]   ,   
            'funcs' => [
               10=>['replaceACT',[]] , 
             //  20=>['baseOB::getManagerAdatkezeles',['{ACT}','{OB.Request}'],'DATA.tabledata']  
             20=>['baseOB::getManagerAdatkezeles',['{ACT.viewpar.doc_tmpl}'],'DATA.tabledata']  
                ],
             //  'return'=>['dump']    
        ],

        'create' => [
          'viewpar'=>[ 
              'taskheader'=>'Új dokumentum generálás',
              
          ], 
            'funcs' => [
                 10=>['replaceACT',[]] ,
                 15=>['baseOB::moEdit',['{ACT.viewpar.id}'],'DATA.item'] ,
                   20=>['worker::getWorkers',[],'DATA.workers'],  
                   25=>['worker::getUserCeg',[],'DATA.ceg']  
            ],
             
        
           // 'return'=>['dump']
    
            'return'=>['viewsimple','admin_crudgenerator.docs.doc_general']
      ],

    'storedoc' => [
        'funcs' => [
           8=>['replaceACT',[]] , 
            10=>['validateToDATA',[],'DATA'],
           // 15=>['ManagerHandler::workerToData',[],'DATA.worker'],
           20=>['ManagerHandler::cegToData',[],'DATA.ceg'],
          //20=>['user::getWorker',[],'DATA'],
             25=>['baseOB::storeDoc',['{DATA}','{ACT}']]  //felül kell irni ha nme az alapértelmezettet akaerjuk: 20=>['baseOB::moCreate',['{DATA.valid}']]
          
          //  20=>['baseOB::storeAdatkezeles',['{DATA}','{ACT}']]  
           ],
           'return'=>['redirect','{ACT.viewpar.route}','Documentum elkészült:'] ,
           // 'return'=>['dump'],
       
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
   /*  'edit' => [
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
    
    ],*/

    'destroy' => [  'delFromParrent'=>[ 'funcs'],
    'funcs' => [
        8=>['replaceACT',[]], 
        10=>['baseOB::destroyOne',['{ACT.viewpar.id}']]     
        ]],
 // az ad.groupcomf funkcióinak használata itt is kell hogy legyen kulcs és nem lehet üres------        
'pub' => ['allowed'=>true],
'unpub' => ['allowed'=>true]
//'show' => ['allowed'=>true], 
];