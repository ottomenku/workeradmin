<?php
//figyelem ugyanolyan hulcsnál lefagy!!!!!!!!!!!
//TODO megcsinálni a publikálást, hogy automatikusan beírja a kérelmet az adatbázisba
return [
    'base'=>[
        'role'=>['manager'],
        'funcs' => [ 
          3=>['replaceACT',[]] 
        ],
        'obClass'=>['baseOB'=>'App\Booking','daytype'=>'App\Daytype'],
        'viewpar'=>[
            'route'=>'m/ad.man.booking', //ez alapján múködnek a gombok
          ] 
    ],
    'index' => [
        'viewpar'=>[
            'createbutton'=>false,
            'view'=>'index',
            'tableinclude'=>'includes.table.table',
            'tableFuncInc'=>'includes.table.actionFunc',
            'table'=>[
                'join_1'=>['Dolgozó','worker','workername'],
                'join_2'=>['Kérelem','daytype','name'],// 'vezérlő kulcs'=>'label','join funkció','mezőnév'
                'start'=>['Kezdés'],
                'end'=>['Vége'],
                'files'=>['Dokumentumok','filelist'],  // 'vezérlő kulcs'=>'label','join funkció'  kilistázza a kapcsolt fájlokat.Letöltő linkkel és egy törlő  gombbal              
                'actions'=> ['Állapot',['status']],
                'actions'=> ['Action',['newpub','newunpub', 'notnew_ifpub',
                  ['ifnotnew',['basepub']],
                  ]]
            ], 
          ], 

          'funcs' => [ 
                  10=>['baseOB::getAdminlist',[],'DATA.tabledata'] 
                ],
              'return'=>['view'] 
        
          ],       
  'unpub' => [ //------------------------
    'funcs' => [
      10=>['baseOB::unpub',['{ACT.viewpar.id}']]    
      ],
      'return'=>['redirect','{ACT.viewpar.route}'] 
    ],

  'pub' => [ //------------------------ 
    'funcs' => [
      10=>['baseOB::pub',['{ACT.viewpar.id}']]    
      ],
      'return'=>['redirect','{ACT.viewpar.route}'] 
    ], 

  'basepub' => [//------------------------  
    'funcs' => [
      10=>['baseOB::basepub',['{ACT.viewpar.id}']]    
      ],
      'return'=>['redirect','{ACT.viewpar.route}'] 
    ], 
  'destroy' => [//------------------------
      'funcs' => [
        10=>['baseOB::delWorker',['{ACT.viewpar.id}']]    
        ],

    ],
  'destroyfile' => [//------------------------
      'funcs' => [
        10=>['baseOB::delFileWorker',['{ACT.id}'],'DATA']    
        ],
        'return'=>['redirect','{ACT.viewpar.route}']   
    ],
  'download' => [//------------------------
      'funcs' => [
        10=> ['baseOB::download',['{ACT.id}'],'DATA.file']     
        ],
      'return'=>['download'] 
    ],          
              
];
