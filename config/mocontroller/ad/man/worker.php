<?php
//figyelem ugyanolyan hulcsnál lefagy!!!!!!!!!!!
//BaseWithRouteController

//TODO   megoldani hogy duplicate emailnél ne legyen végzetes kivétel, kúldjön hiba jelet  
return [

    'base'=>[
        'funcs' => [ 
            3=>['replaceACT',[]] 
          ],  
    'validations' =>[
        'foto'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'email'  => 'required|max:255',
    
    ] ,
   // 'delFromParrent'=>[ 'viewpar.menu.superadmin.egy'] ,
    'obClass'=>['baseOB'=>'App\Worker','ManagerHandler'=>'App\Handlers\ManagerHandler'],
    'viewpar'=>[
        'route'=>'m/ad.man.worker', //ez alapján múködnek a gombok
        'form'=>[   
            'name'=>['text','Felhasználónév (ezzel tud bejelenkezni,egyedi)',['required' => 'required']],
            'fullname'=>['text','Teljes (anyakönyvi) név',[]],
            'workername'=> ['text','Workwernév, Ez fog megjelenni a listákban táblázatoban,egyedi',[]],
            'email'=> ['email','Email',['required' => 'required']],
            'password'=> ['text','Jelszó (Ha üresen marad nem változik)',[]],
            'position'=> ['text','',[]],
            'image'=> ['image','foto',[]], //'fileupload name'=> ['tipus','mező név',[]],
            'cim'=> ['text','utca, házszám',[]],
            'város'=> ['text','Város (cím)',[]],
           // 'alapber'=> ['text','alapbér',[]],
           // 'bertipus'=> ['text','Bértipus',[]],    
            'mothername'=> ['text','Anyja neve',[]], 
            'tel'=> ['text','Telefonszám',[]],
            'ado'=> ['text','Adószám',[]],
            'tb'=> ['text','Tb. szám',[]],
            'szig'=> ['text','Szig',[]],
            'start'=> ['date','Munkaviszony kezdete',[]],
            'end'=> ['date','Munkaviszony vége',[]],
            'note'=> ['text','Megjegyzés',[]],
            'pub'=>['radiolist','',[['0','Tiltva' ],['1','Engedélyezve',true ]]] ,
            'submit'=>['submit','Ment user'] ,//,'submit'=>['submit','Ment','class'=>'btn btn-danger'] 
        ],
        ]
    ],
    'index' => [
    // 'delFromParrent'=>[ 'funcspppp'],
       //'role'=>'manager',
     //  'replaceACT'=>false,
        'viewpar'=>[ 

            'taskheader'=>'Dolgozók, Cég:{ACT.cegnev}',
            'view'=>'index',
            'table'=>[
               // 'id'=>['Id',],
                'join_1'=>['Felhasználó név','user','name'] ,
                'fullname'=>['Teljes név'] ,
                'join_2'=>['Email','user','email'],
                'actions'=> ['Action',['edit','destroy','ifpub'] ]
                ],
                
            ]   ,   
            'funcs' => [
               10=>['replaceACT',[]] , 
                20=>['baseOB::moIndex',['{ACT}','{OB.Request}'],'DATA.tabledata']  
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
        'validations' =>['email'  => 'required|unique:users|max:255', ] ,
        'funcs' => [
           8=>['replaceACT',[]] , 
            10=>['validateToDATA',[],'DATA.valid'],
            20=>['baseOB::moStore',['{DATA.valid}','{ACT}']]  
           ],
           'return'=>['redirect','{ACT.viewpar.route}','Dolgozó mentve:'] 
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
        10=>['baseOB::moDestroy',['{ACT.viewpar.id}']]     
        ]],
 // az ad.groupcomf funkcióinak használata itt is kell hogy legyen kulcs és nem lehet üres------        
'pub' => ['allowed'=>true],
'unpub' => ['allowed'=>true],
'show' => ['allowed'=>true], 
];