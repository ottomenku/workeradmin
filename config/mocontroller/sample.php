<?php
//figyelem ugyanolyan hulcsnál lefagy!!!!!!!!!!!
return [
// a smple csoport minden routjára érvénye 
//a sample csoporton belüli csoportok pl. man valamint a sample csoporton belüli routok-Controllerek felül írhatják   
'groupconf'=>[
   //minden taskra érvényes beálítások az aktális taskok fgelül írhatják
    'base'=>[//alap beállítások
        'validations' =>['foto'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'] ,   
        'succes_message'=>'Adatok frissítése sikerült', // sikeres redirect függvények üzenete, meg lehet adni a return-al is
       // 'funcrun_ksort'=>true, //a funcs tömb kulcs szerinti rendezése ha szükséges 1*obkey.func szintaxis (indexelés) esetén (alapértelmezés)
        'delFromParrent'=>[ 'viewpar.menu.superadmin.egy'] ,
        'obClass'=>['baseOB'=>'App\User'], 
        //viewnek átadandó paraméterek
        'viewpar'=>[
            'forminclude'=>'baseTaskviews.baseform_include' //alap formgenerátor becsatolása a form.blade-be
        ],
        //funcrun----
        'funcs' => [
            //obkey.funktionName_index)'=>[['parméter1','paraméter2'..max 4],'res kulcs. ide teszi az eredményt'],
            //_index azért van hogy tobbször meglehessen ugyanazt a függvényt hívni, nem szükséges, a funcRun() nem veszi figyelembe.
            'obkey.funktionName_1'=>[['string','ACT.user.id','DATA.'],'ACT.res'],
            'funktionName'=>[],
            'baseOB.all'=>[[],'DATA.tabledata'],
            'indexSetData'=>[[],'DATA.tabledata'],
        ],
        //moReturn()------
        'return'=>['redirect','{ACT.viewpar.route}','{ACT.succes_message}'] , 
        'return'=>['redirect','/home','Sikerült!'],
        'return'=>['view'],  // az ACT.view  lesz a view de elé teszi ACT.baseTaskviews-et
        'return'=>['view', 'form'] , // a form  lesz a view de elé teszi ACT.baseTaskviews-et
        'return'=>['viewfull', 'baseTaskviews.form'], // a view teljes elérési útját meg kell adni
        'return'=>['taskrun', 'Message'], //az aktuális task függvényt futtaja le ha van
        'return'=>['ACTkiir'] // a $this->funcname() függvényt futtaja ha létezik, ha nem akkor a task függvényt
        //ha nem adunk meg return kulcsot akkor is 'return'=>['funcname'] hívódik meg (default)
    ],
//tábla------------------------------------
        'index' => [
        'searchcolumn' => ['name','tel'],
           'searchinput'=>'search',
          'paginate'=>25,
            'viewpar'=>[ 
                'view'=>'index',
                'table'=>[
                    'actions'=> ['Action',[['show',['style'=>'none']],'download','ifpub'] ] // show gomb stílusát kkapcsolja
                ],
               // 'table_action'=> ['edit'=>true,'destroy'=>true  ] // régi
                ] ,     
            'funcs' => [
            'indexSetData'=>[[],'DATA.tabledata']
            ]
    
        ],
 //form-------------------------------------       
        'create' => [
            'funcs' => [
            'baseOB.pluck'=>[['name','id' ],'DATA.select_list']     
            ],
            'viewpar'=>[ 
                'taskhead'=>'Létrehozás',
                'view'=>'form' ,
               'form'=>[
                    'formstart'=>['formstartCreate'] , //automatikusan lezárja a create formot
                    'formStart'=>['formstartEdit',[],false] // nem zárja le a szerkesztő formot, Üres tömböt ad át paraméternek
                    ,'name'=>['text','Név',[]]
                    ,'datum'=> ['date','Dátum',['required' => 'required']]
                    ,'email'=> ['email','Email',['required' => 'required']]
                    ,'check'=>['check','label','value'] 
                    ,'check2'=>['check','label','value'] 
                    ,'check3'=>['checklist','label',[['name','value','label',true ],['name','value','label']]] 
                ,'checkgroupname'=>['checkgroup','checkgrouplabel',[['value','label',true ],['value','label']],['par'=>'parval']] 
                ,'select'=>['select','selectlabel',[]] //selectnél a listának a $data[$name.'_list']-> kell lenie
                ,'radio'=>['radio','label','value'] 
                ,'pub'=>['radiolist','',[['1','Tiltva',true ],['0','Engedélyezve',true ]]] 
                ,'file'=>['file','filelabel'] 
                ,'submit'=>['submit','Ment user'] //,'submit'=>['submit','Ment','class'=>'btn btn-danger'] 
                ,'formend'=>['formend']
        // file: 
        // radio:name=>['radio,'label','value'] 
        //
        //image :
    
                ]
            ] ,
            'return'=>['view'] 
        ]
],
// alap --------------------------------
'ceg' =>[   
    'base'=>[
        'obClass'=>['baseOB'=>'App\Ceg'],
        'viewpar'=>[
            'route'=>'ad.man.ceg', //ez alapján múködnek a gombok
            'form'=>[
                'submit'=>['submit','Ment user'], //,'submit'=>['submit','Ment','class'=>'btn btn-danger'] 
                'formend'=>['formend']
            ],
            ]
    ],
    'index' => ['viewpar'=>[ 
        'table'=>[
            'id'=>[],
            'name'=>['Felhasználó név'],
            'email'=>['Email','$item->email']
                ], ] ,               
    ],
    'create' => [
        'viewpar'=>[ 
         'taskhead'=>'Új cég',
        ],
    ],
    'store' => [],
    'show' => [],
    'edit' => [],
    'update' => [ 'succes_message'=>'Cég adatok frissítése sikeres!',],
    'destroy' => [ ],
],

];