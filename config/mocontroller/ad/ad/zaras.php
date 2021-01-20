<?php
//figyelem ugyanolyan hulcsnál lefagy!!!!!!!!!!!
//BaseWithRouteController
return [
    'base'=>[
    'obClass'=>[],
    'viewpar'=>[
        'baseroute'=>'m/ad.man.time.zaras/', //ez alapján múködnek a gombok
        'route'=>'m/ad.man.time.zaras/', //ez alapján múködnek a gombok
        ],
    ],

    // index ----------------------------
        'index' => [
            'viewpar' => [
                'taskheader' => 'Munkaidők, Cég:{ACT.cegnev}',        
            ], 
            'funcs' => [
                50 => ['stored::showAdminList', ['{ACT.routpars.id}', '{ACT.routpars.id1}'], 'DATA.storeds'],
            ],
            'return'=>['viewFull','MOcalendarVue.zaras'] 
                //  'return'=>['dump']          
        ],
    // calendar ----------------------------------
        'calendar' => [
            'funcs' => [
                50 => ['stored::showAdminList', ['{ACT.routpars.id}', '{ACT.routpars.id1}'], 'DATA.storeds'],
            ],
         'return'=>['json'] //Ha a groupconfba  tesszük kella z allowed külcs, mert nem lehet üres a task 
          // 'return'=>['viewFull','MOcalendarVue.calendar'] 
          //   'return'=>['dump']
        ],
//stored-------------------------
'storeclose' => [  
    'funcs' => [ 20 => ['stored::CreateFromData', ['{DATA.valid}'], 'DATA.storeds'],],
    'return' => ['json', ['storeds' => 'DATA.storeds']],]
 ,

'getStored' => [ 'allowed'=>true],


];