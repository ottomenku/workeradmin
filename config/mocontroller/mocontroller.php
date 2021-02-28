<?php

return [
  // itt lehet definiálni hogy az admin controller milyen szintű felhasználónak milyen routot hívjon meg belépés után  
    'routeForRole' => [
        'superadmin' => ['m/ad.man.user'],
        'admin' => ['m/ad.ad.ceg'],
        'owner' => ['m/ad.man.worker'],
        'manager' => ['m/ad.time.manager'],
        'workadmin' => ['m/ad.wad.worker'],
        'worker' => ['m/ad.time.worker'],   
    ],

//type: primary,  secondary, success, danger, warning, info, light, link
//méret: btn-lg,btn-sm  Körvonal: btn-outline-primary stb
'baseAction'=>[
    'base'=>[ //minden gombra érvényes
        'classplus'=>'',  // ha plusz osztályt akarunk hozzáadni
        'var'=>'id',  // a mező aminek az értékét használja
        'action'=>'href', 
        'icon'=>'fa', //lehet üres     //TODO csinálni imaget stb...
        'type'=>'button', // html tag (a, div)
        'label'=>'', //felirat
        ],
    'show'=>[
       // 'button'=>'info', // a gomb tipusa a classban behelyettesíti
       'class'=>'btn btn-info btn-sm',
        'task'=>'show', // a kattintásra meghivandó task
        'fa'=>'fa fa-eye',
        'title'=>'show full data',
        'action'=>'href',
        //'dusk'=>"show"
        ],
        'previewid'=>[ 'class'=>'btn btn-info btn-sm', 'fa'=>'fa fa-eye', 'task'=>'previewid', 'title'=>'show','action'=>'href' ],
        'previewid_new_vindow'=>[ 'target'=>'_new','fa'=>'fa fa-eye', 'class'=>'btn btn-info btn-sm', 'task'=>'previewid', 'title'=>'show','action'=>'href' ],
        'download'=>['action'=>'href','class'=>'btn btn-primary btn-sm','task'=>'download','fa'=>'fa fa-download','title'=>'Letöltés'],
        'edit'=>['action'=>'href','class'=>'btn btn-primary btn-sm','task'=>'edit','fa'=>'fa fa-pencil-square-o','title'=>'Szerkesztés'],
        'destroy'=>['action'=>'href','class'=>'btn btn-danger btn-sm','task'=>'destroy','fa'=>'fa fa-trash-o','title'=>'Törlés','onclick'=>"return confirm('Biztos hogy törölni akarja?')" ],
        'pub'=>['action'=>'href','class'=>'btn btn-danger btn-sm','task'=>'pub','fa'=>'fa fa-times','title'=>'Tiltva, engedélyezés'],
        'unpub'=>['action'=>'href','class'=>'btn btn-success btn-sm','task'=>'unpub','fa'=>'fa fa-check','title'=>'Engedélyezve, tiltás'],
        'pub_info'=>['class'=>'btn btn-secondary btn-sm','task'=>'pub','fa'=>'fa fa-circle','title'=>'Engedélyezve'],
        'unpub_info'=>['class'=>'btn btn-success btn-sm','task'=>'unpub','fa'=>'fa fa fa-check-circle','title'=>'Tiltva'],
        'open'=>['action'=>'href','class'=>'btn btn-light btn-sm','task'=>'close','fa'=>'fa fa-unlock-alt','title'=>'Lezárás'],
        'close'=>['action'=>'href','class'=>'btn btn-outline-danger btn-sm','task'=>'open','fa'=>'fa fa-lock','title'=>'Feloldás'],
        'open_info'=>['class'=>'btn btn-light btn-sm','task'=>'close','fa'=>'fa fa-unlock-alt','title'=>'Lezárva'],
        'close_info'=>['class'=>'btn btn-light btn-sm','task'=>'open','fa'=>'fa fa-lock','title'=>'Feloldva'],
        'allowed'=>['class'=>'btn btn-light btn-sm','style'=>' color:green;','title'=>'Feloldás','text'=>'Efogadva'],
        'forbidden'=>['class'=>'btn btn-light btn-sm','style'=>' color:red;','title'=>'tiltva','text'=>'Problémás'],
        'new'=>['class'=>'btn btn-light btn-sm','title'=>'új','text'=>'Új'],
        'text'=>['class'=>'btn btn-light btn-sm','title'=>'text','text'=>'Szöveg'],
         'basepub'=>['action'=>'href','class'=>'btn btn-primary btn-sm','task'=>'basepub','fa'=>'fa fa-circle','title'=>'alaphelyzet'],
      
         'empty'=>[], //kell a feltételes gomb generáláshoz
    ],



 /*   'param' => 'base',
    'base' => [
    ],

    'nemcrud' => [
        'domain' => 'nemcrud',
        'marad' =>['marad1'],
    ],
    'index' => [
       // 'obClass' => ['baseOB'=>''],
      //  'funcRun' =>['this.index_setData'=>[[],'ACT.data.table']],// a this elhagyható az obkey kell ami az OB kulcsa nem a classname
     //  'delParrent' => 'todel',
    ],*/

];