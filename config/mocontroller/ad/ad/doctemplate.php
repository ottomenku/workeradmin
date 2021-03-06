<?php
//figyelem ugyanolyan hulcsnál lefagy!!!!!!!!!!!
//BaseWithRouteController


return [

    'base'=>[
    'role'=>['admin'], //changeuser/aD15ll465ghAjfEbbulkkkkllllllhgzz/35  ggg2 manager
    'validations' =>['name'  => 'required'] ,
    'obClass'=>['baseOB'=>'App\Doctemplate'],
    'viewpar'=>[
        'route'=>'m/ad.ad.doctemplate', //ez alapján múködnek a gombok
    ],
        'funcs' => [
          8=>['replaceACT',[]] 
          ]

        ],
  'preview' => [
        'funcs' => [  
          10=>['validateToDATA',[],'DATA'], 
            ],
        //  'return'=>['dump']  
         'return'=>['editorpdfstream'] 
        // 'return'=>['view'] 
    ],
    'previewid' => [
      'funcs' => [  
        10=>['baseOB::getTemplate',['{ACT.viewpar.id}'],'DATA'], 
          ],
       // 'return'=>['dump']  
        'return'=>['editorpdfstream'] 
      // 'return'=>['view'] 
  ],
    'proba' => [
      'funcs' => [  
      20=>['baseOB::getMenu',[], "DATA"]  
          ],
        'return'=>['dump']  
       // 'return'=>['pdfstream'] 
      // 'return'=>['view'] 
  ],

    'formeditsave' => [
      'funcs' => [ 
        8=>['replaceACT',[]] ,
        10=>['validateToDATA',[],'DATA'],
       20=>['baseOB::moUpdate',['{DATA}']]  
          ],
      'return'=>['redirect','{ACT.viewpar.route}','Documentumsablon változások mentve:'] ,
  ],
    'tmplstore' => [
      'funcs' => [ 
        8=>['replaceACT',[]] ,
        10=>['validateToDATA',[],'DATA'],
       20=>['baseOB::tmplstore',['{DATA}']]  
          ],
      'return'=>['redirect','{ACT.viewpar.route}','Documentumsablon elkészült:'] ,
  ],
    'index' => [
      'viewpar'=>[ 

        'taskheader'=>'Dokumentum generáló',
        'view'=>'index',
        'table'=>[
            'id'=>['Id'],
            'cat'=>['Categoria'] ,
          'name'=>['Azonosító'] ,
          'note'=>['Megjegyzés'] ,// 'fullname'=>['Teljes név'] ,
          //  'join_2'=>['Email','user','email'],
          //  'actions'=> ['Action',[['show',['style'=>'none']],'download','ifpub'] ]
         // 'actions'=> ['Action',['download','destroy'] ]
         'actions'=> ['Action',['previewid_new_vindow','edit','destroy','ifpub'] ]
            ],
            
        ]   ,   
        'funcs' => [
           10=>['replaceACT',[]] , 
         //  20=>['baseOB::getManagerAdatkezeles',['{ACT}','{OB.Request}'],'DATA.tabledata']  
         20=>['baseOB::getTemplates',[],'DATA.tabledata']  
            ],
       //      'return'=>['dump']  
       'return'=>['view'] 
    ], 
    'create' => [
      'viewpar'=>[ 
          'taskheader'=>'Új dokumentum sablon generálás',
          
      ], 
        'funcs' => [
           /*   10=>['replaceACT',[]] ,
               20=>['worker::getWorkers',[],'DATA.workers'],  
               25=>['worker::getUserCeg',[],'DATA.ceg']  */
        ],
         
    
      //  'return'=>['dump']

        'return'=>['viewsimple','admin_crudgenerator.docs.doc_tmpl_general']
  ],
  'edit' => [
    'viewpar'=>[           
        'taskheader'=>'Dokumentum sablon módosítása ',
    ],
    'funcs' => [
        10=>['baseOB::moEdit',['{ACT.viewpar.id}'],'DATA'] ,
       // 15=>['ceg::toArray',[],'DATA.ceg'],
          ],
      'return'=>['viewsimple','admin_crudgenerator.docs.doc_tmpl_edit']    
 ],



'update' => [ 'succes_message'=>'Dolgozó adatai frissítve!',
// 'delFromParrent'=>[ 'funcs'],
'funcs' => [

    10=>['validateToDATA',[],'DATA.valid'],
   20=>['baseOB::moUpdate',['{ACT.viewpar.id}','{DATA.valid}']]     
    ],

],

'destroy' => [ // 'delFromParrent'=>[ 'funcs'],
'funcs' => [
 
    10=>['baseOB::destroyOne',['{ACT.viewpar.id}']]     
    ]],
// az ad.groupcomf funkcióinak használata itt is kell hogy legyen kulcs és nem lehet üres------        
'pub' => ['allowed'=>true],
'unpub' => ['allowed'=>true],

];