<?php
//figyelem ugyanolyan hulcsnál lefagy!!!!!!!!!!!
//BaseWithRouteController


return [

    'base'=>[
        'funcs' => [ 
            3=>['replaceACT',[]] 
          ],  
      
    'validations' =>[
    'foto'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    'filef' => 'required',
    'filef.*' => 'mimes:doc,pdf,docx,txt,xls,jpeg,png,jpg,gif',
    ] ,
   // 'delFromParrent'=>[ 'viewpar.menu.superadmin.egy'] ,
    'obClass'=>['baseOB'=>'App\Doc','worker'=>'App\Worker'],
    'viewpar'=>[
      'tableinclude'=>'includes.table.tableuj',
        'route'=>'m/ad.wor.docs', //ez alapján múködnek a gombok
      'form'=>[          
            'name'=>['text','Név (Nem kötelező, alapérteémezetten a fájlnév lesz )',[]],
            'filef'=>['file','fájl kivalasztás'],
            'note'=>['text','Megjegyzés',[]],
            'submit'=>['submit','feltöltés'], //,'submit'=>['submit','Ment','class'=>'btn btn-danger'] 
            'formend'=>['formend']
          ],
        ]
    ],
    'index' => [
    // 'delFromParrent'=>[ 'funcspppp'],
       //'role'=>'manager',worker_id', 'origin', 'name', 'filename', 'path', 'worknote', 'worknote', 'pub'
     //  'replaceACT'=>false,
        'viewpar'=>[ 
         // 'tableFuncInc'=>'includes.table.actionFunc',
         'tableFuncInc'=>'includes.table.simplePlusActionFunc',
            'taskheader'=>'Worker manager, Cég:{ACT.cegnev}',
            'view'=>'index',
            'table'=>[
               // 'id'=>['Id',],
              //  'join_1'=>['Dolgozó','worker','workername'] ,
                'name'=>['doc'] ,
                'type'=>['type'] ,
                'cat'=>['cat'] ,

                 'created_at'=>['Dátum'] ,
               // 'fullname'=>['Teljes név'] ,
              //  'join_2'=>['Email','user','email'],
             //    'actions'=> ['show','download'] 
            // 'actions'=> [['ifnotnew',['edit',['param']]],'show' ]
            'actions'=> ['download','destroynew']  ], 
          ],
         
            'funcs' => [
               10=>['replaceACT',[]] , 
             //  20=>['baseOB::getManagerAdatkezeles',['{ACT}','{OB.Request}'],'DATA.tabledata']  
             20=>['baseOB::getWorkerDocs',[],'DATA.tabledata']  
                ],
             //  'return'=>['dump']    
        ],

    'create' => [
        'viewpar'=>[ 
            'taskheader'=>'Új dodokumentum feltöltés',
            
        ], 
          'funcs' => [
                10=>['replaceACT',[]] ,
                 20=>['worker::getWorkers',[],'DATA']  
            ]

        //  'return'=>['dump'],

        //  'return'=>['viewsimple','admin_crudgenerator.docs.create']
    ],
    'proba' => [
      'funcs' => [
     //  10=>['validateToDATA',[],'DATA.valid'],
       20=>['baseOB::proba',[],'DATA'],   
      ],
       'return'=>['dump']  
    ],

    'destroy' => [  
    'delFromParrent'=>[ 'funcs'],
    'funcs' => [
        8=>['replaceACT',[]], 
        10=>['baseOB::destroyWorkerOne',['{ACT.viewpar.id}']]     
        ]
       // ,'return'=>['dump']  
      ],

    'store' => [
      'funcs' => [
       10=>['validateToDATA',[],'DATA.valid'],
       20=>['baseOB::storeWorkerDoc',['{OB.Request}','{DATA.valid}']]     
        ],
      //  'return'=>['dump']  
    ],

     'download' => [
        'funcs' => [
           8=>['replaceACT',[]] , 
          //  10=>['validateToDATA',[],'DATA.valid'],
            20=>['baseOB::download',['{ACT.viewpar.id}'],'DATA.file']  
           ],
        //  'return'=>['redirect','{ACT.viewpar.route}','letöltés'] 
        'return'=>['downloadFromStorage'] 
       // 'return'=>['dump']
     ],    
  /*   'edit' => [
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

 // az ad.groupcomf funkcióinak használata itt is kell hogy legyen kulcs és nem lehet üres------        
//'pub' => ['allowed'=>true],
//'unpub' => ['allowed'=>true],
//'show' => ['allowed'=>true], 
];