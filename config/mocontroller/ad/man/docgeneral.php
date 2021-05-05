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
    'obClass'=>['baseOB'=>'App\Doc','doctmpl'=>'App\Doctemplate','worker'=>'App\Worker','ceg'=>'App\Ceg'],
    'viewpar'=>[
        'route'=>'m/ad.man.docgeneral', //ez alapján múködnek a gombok
        'doc_tmpl'=>'tajekoztato',
  
        ]
    ],
    'previewid' => [
      'funcs' => [  
    20=>['baseOB::getPdfPathFromId',['{ACT.viewpar.id}'], "DATA.filestream"]  
          ],
     //   'return'=>['dump']  
        'return'=>['filestream'] 
      // 'return'=>['view'] 
  ],
  'download' => [
    'funcs' => [  
  20=>['baseOB::getPdfPathFromId',['{ACT.viewpar.id}'], "DATA.file"]  
        ],
   //   'return'=>['dump']  
      'return'=>['download'] 
    // 'return'=>['view'] 
],
  'docgeneralview' => [
    'funcs' => [  
      10=>['replaceACT',[]] ,
    20=>['worker::getWorker',['{ACT.routpars.id1}'], "DATA.worker"],  
    30=>['worker::getUserCeg',[], "DATA.ceg"] 
        ],
    //  'return'=>['dump']  
      'return'=>['bladepdfstream'] 
    // 'return'=>['view'] 
],

 
    'index' => [
    // 'delFromParrent'=>[ 'funcspppp'],
       //'role'=>'manager',worker_id', 'origin', 'name', 'filename', 'path', 'worknote', 'worknote', 'pub'
     //  'replaceACT'=>false,
        'viewpar'=>[ 
          'createbutton'=>false,
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

        'proba' => [
            'funcs' => [
               //  15=>['baseOB::proba',[],'DATA'] 
            ],    
            'return'=>['probablade']
          //  'return'=>['viewsimple','admin_crudgenerator.docs.doc_general']
      ],

        'create' => [
          'viewpar'=>[ 
              'taskheader'=>'Új dokumentum generálás',
              
          ], 
            'funcs' => [
                 10=>['replaceACT',[]] ,
                 15=>['doctmpl::getTemplate',['{ACT.viewpar.id}'],'DATA.item'] ,
                   20=>['worker::getWorkers',[],'DATA.workers'],  
                   25=>['worker::getUserCeg',[],'DATA.ceg']  
            ],
           // ACT['routpars']
        
         //  'return'=>['dump']
    
         'return'=>['viewsimple','admin_crudgenerator.docs.doc_general']
      ],

    'storeworkerdocs' => [
        'funcs' => [
           8=>['replaceACT',[]] , 
            10=>['validateToDATA',[],'DATA'],
           // 15=>['ManagerHandler::workerToData',[],'DATA.worker'],
         //  20=>['ManagerHandler::cegToData',[],'DATA.ceg'],
          //20=>['user::getWorker',[],'DATA'],
             25=>['baseOB::storeDocs',['{DATA}','{ACT}']]  //felül kell irni ha nme az alapértelmezettet akaerjuk: 20=>['baseOB::moCreate',['{DATA.valid}']]
          
          //  20=>['baseOB::storeAdatkezeles',['{DATA}','{ACT}']]  
           ],
           'return'=>['redirect','{ACT.viewpar.route}','Documentum elkészült:'] ,
           // 'return'=>['dump'],
       
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

    'destroy' => [ 
      'delFromParrent'=>[ 'funcs'],
      'funcs' => [
        3=>['replaceACT',[]],  
        10=>['baseOB::destroyOne',['{ACT.viewpar.id}']]     
        ]
      ],
 // az ad.groupcomf funkcióinak használata itt is kell hogy legyen kulcs és nem lehet üres------        
    'pub' => [  'funcs' => [
        10=>['baseOB::pub',['{ACT.viewpar.id}']]     
      ]],
    'unpub' => ['funcs' => [
      10=>['baseOB::unpub',['{ACT.viewpar.id}']]     
      ]]
//'show' => ['allowed'=>true], 
];