<?php
//figyelem ugyanolyan hulcsnál lefagy!!!!!!!!!!!
//BaseWithRouteController


return [

    'base'=>[

    'validations' =>['foto'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'] ,
    'viewpar'=>[
        'route'=>'m/ad.man.doc.adatkezeles', //ez alapján múködnek a gombok
        'doc_tmpl'=>'adatkezeles',
        ]
    ], 
// az ad.man.doc groupcomf funkcióinak használata itt is kell hogy legyen kulcs és nem lehet üres------       
    'index' => ['allowed'=>true ],
    'create' => ['allowed'=>true ],
    'store' => ['allowed'=>true ],
    'download' => ['allowed'=>true ],
    'destroy' => ['allowed'=>true ],
    'pub' => ['allowed'=>true],
    'unpub' => ['allowed'=>true]
];