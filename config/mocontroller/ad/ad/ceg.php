<?php
//figyelem ugyanolyan hulcsnál lefagy!!!!!!!!!!!
//BaseWithRouteController
//TODO cégek letiltásának ellenőrzése dolgozók letiltásának megoldása
return [
        'base'=>[
            'funcs' => [ 
                3=>['replaceACT',[]] 
              ],
            'obClass'=>['baseOB'=>'App\Ceg','user'=>'App\User'],
            'viewpar'=>[
                'route'=>'m/ad.ad.ceg', //ez alapján múködnek a gombok
                    'form'=>[          
                        'cegnev'=>['text','Cég név',[]],
                        'note'=>['text','Megjegyzés',[]],
                        'name'=>['text','Manager neve',[]],
                        'email'=>['text','Manager Email',[]], 
                        'ugyvezeto'=>['text','Ügyvezető',[]],
                        'szekhely'=>['text','Székhely (város)',[]],
                        'cim'=>['text','Székhely Címe (utca, házszám)',[]],        
                        'ado'=>['text','Adószám',[]],      
                        'password'=>['text','Manager Jelszó',[]],
                     'pub'=>['radiolist','',[['0','Tiltva' ],['1','Engedélyezve',true ]]] ,
                         'submit'=>['submit','Cég mentése'], //,'submit'=>['submit','Ment','class'=>'btn btn-danger'] 
                        'formend'=>['formend']
                ] ]       
        ],
        'index' => [
            'viewpar'=>[ 
            'table'=>[
               // 'id'=>[],
                'cegnev'=>['Cég név'],
                'join_i'=>['Tulajdonos','user','name'],
                'join_2'=>['Email','user','email'],
                'note'=>['megjegyzés'],
                'actions'=>  ['Action',['edit','destroy','ifpub']]
                    ], ],
            'funcs' => [
               20=>['baseOB::getCeg',['{ACT}','{OB}'],'DATA.tabledata']     
                ],                 
        ],
        'create' => [
            'viewpar'=>[ 
            'taskhead'=>'Új cég',
        ]],
   
        'store' => [
           'funcs' => [
                10=>['validateToDATA',[],'DATA.valid'],
               20=>['baseOB::makeCeg',['{DATA.valid}']]     
                ],
            
        ],

        'show' => [],
        'edit' => [  'form'=>[
            'password'=>['text','Manager Jelszó (ha üres marad nem változik)']
        ],
            'funcs' => [
             10=>['baseOB::findCegArr',['{ACT.viewpar.id}'],'DATA'] ,
              // 15=>['ceg::toArray',[],'DATA.ceg'],
//20=>['user::findOrFail',['{DATA.ceg.user_id}', ['name', 'email']],'OB.user'] ,
            //   25=>['user::toArray',[],'DATA.user'],
               // '25*remove'=>['DATA_','user_password'] ,//azért van aláhüzás jel hogy stringként menjen át ne a dotkey értéke
            //  30=>['merge',['{DATA.ceg}','{DATA.user}'],'DATA'] ,

                 ],
               //  'return'=>['DATAkiir']  
        ],
        'update' => [ 'succes_message'=>'Cég adatok frissítése sikeres!',
        'delFromParrent'=>[ 'funcs'],
        'funcs' => [
            10=>['validateToDATA',[],'DATA.valid'],
           20=>['baseOB::updateCeg',['{ACT.viewpar.id}','{DATA.valid}']]  ,   
           30=>['replaceACT',[]] 
        ],
        
        ],
        'pub' => [ 
            'funcs' => [
                10=>['baseOB::pub',['{ACT.viewpar.id}']]     
            ],
            'return'=>['redirect','{ACT.viewpar.route}'] 
        ],
        'unpub' => [ 
            'funcs' => [
                10=>['baseOB::unpub',['{ACT.viewpar.id}']]     
            ],
            'return'=>['redirect','{ACT.viewpar.route}']           
        ],

        'destroy' => [ 
            //'delFromParrent'=>[ 'funcs'],
        'funcs' => [
            10=>['baseOB::destroyCeg',['{ACT.viewpar.id}']]     
            ]],
];