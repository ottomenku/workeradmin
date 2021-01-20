<?php
//figyelem ugyanolyan hulcsnál lefagy!!!!!!!!!!!
    return [
        'base'=>[
            'role'=>['worker'],
            'funcs' => [ 
              3=>['replaceACT',[]] 
            ],
            'obClass'=>['baseOB'=>'App\Booking','daytype'=>'App\Daytype'],
            'viewpar'=>[
                'route'=>'m/ad.wor.booking', //ez alapján múködnek a gombok
                   'form'=>[          
                        'daytype_id'=>['select','selectlabel',[]],  
                        'start'=> ['date','Start',['required' => 'required']],
                       'end'=> ['date','End',[]],
                        'file'=>['file','dokumentumok feltöltése'] ,
                        'filelist'=>['filelist','Feltöltött dokumentumok:'] ,
                        'worknote'=>['text','Megjegyzés',[]],      
                         'submit'=>['submit','Kérelem mentése'], //,'submit'=>['submit','Ment','class'=>'btn btn-danger'] 
                        'formend'=>['formend']
                ] ] 
        ],
        'index' => [
            'viewpar'=>[
              //  'info'=>'jkhlsaf lkjfvh vklj sdkflvj klvj vkljfvklsadjv alsk vjkl',
                'view'=>'index',
                'tableinclude'=>'includes.table.table',
                'tableFuncInc'=>'includes.table.actionFunc',
                'table'=>[
                   // 'id'=>[],
                    'join_1'=>['Dolgozó','worker','workername'],
                //    'join_2'=>['Kérelem','daytype','name'],// 'vezérlő kulcs'=>'label','join funkció','mezőnév'
                 //    'join_3'=>['Doc','file','name'],
                    'start'=>['Kezdés'],
                    'end'=>['Vége'],
                   'files'=>['Dokumentumok','filelist'],  // 'vezérlő kulcs'=>'label','join funkció'  kilistázza a kapcsolt fájlokat.Letöltő linkkel és egy törlő  gombbal                  
                   'actions'=> ['Action',['status',
                    ['ifnew',['edit']],
                    ['ifnew',['destroy']] 
                    ]]
                ], 
            ], 
                'funcs' => [ 
                     10=>['baseOB::getlist',[],'DATA.tabledata'] 
                   ],
           'return'=>['view'] 
             //'return'=>['dump'] 
        ],
        'store' => [
            'funcs' => [
                10=>['validateToDATA',[],'DATA.valid'], 
                20=>['baseOB::store',['{DATA.valid}'],'DATA']   
                ],
      //'return'=>['dump']   
            ],


        'create' => [
            'funcs' => [
               10=>['daytype::workerDaytypesPluck',[],'DATA.daytype_id_list'],   
                ],
            'viewpar'=>[
              'info'=>'jkhlsaf lkjfvh vklj---------------------sadjv alsk vjkl',
                'taskhead'=>'Új rekord',
                'view'=>'form',
               // 'form'=>['formStart'=>['formstartCreate',[],false]], //nem zárja le a formot
                'form'=>['formStart'=>['formstartCreate']],//lezárja a formot
                ],
            'return'=>['view'] 
          // 'return'=>['dump']   
            ],
            'download' => [
              // 'allowed' =>true ,
                'funcs' => [
                 10=> ['baseOB::download',['{ACT.id}'],'DATA.file']     
                  ],
                'return'=>['download'] 
              ],
              'show' => [
                'funcs' => [
                 10=> ['baseOB::moShow',['{ACT.id}'],'DATA']     
                  ],
              ],

              'edit' => [
                //'viewpar'=>['info'=>'jkhlsaf lkjfvh vklj---------------------sadjv alsk vjkl'],
                'funcs' => [
                   // 20=>['baseOB::edit',['{ACT.viewpar.id}'],'DATA'] , 
                   30=>['daytype::workerDaytypesPluck',[],'DATA.daytype_id_list'],      
                    ],
    //'return'=>['dump']
            ],

            /*  'edit' => [
                  'funcs' => [    
                 20=>['baseOB::edit',['{ACT.viewpar.id}'],'DATA'] , 
                 30=>['daytype::workerDaytypesPluck',[],'DATA.daytype_id_list'],    
                      ],
                      'viewpar'=>[
                       // 'taskhead'=>'Új rekord',
                        'view'=>'form',
                       // 'form'=>['formStart'=>['formstartCreate',[],false]], //nem zárja le a formot
                        'form'=>['formStart'=>['formstartEdit']],//lezárja a formot
                        ],

               // 'return'=>['dump']
              ],*/
              'update' => [
                'funcs' => [
                  10=>['validateToDATA',[],'DATA.valid'],   
                  20=>['baseOB::moUpdate',['{ACT.viewpar.id}','{DATA.valid}']],   
                  ],
  
              ],
              'destroy' => [
               'funcs' => [
                  10=>['baseOB::delWorker',['{ACT.id}']]    
                  ],

              ],
            'destroyfile' => [
               'funcs' => [
                  10=>['baseOB::delFileWorker',['{ACT.id}'],'DATA']    
                  ],
                  'return'=>['redirect','{ACT.viewpar.route}']   
                //  'return'=>['dump']
              ],
              
];
