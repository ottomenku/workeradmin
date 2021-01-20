@extends('layouts.backend')
@include('layouts.sidebar')  
@section('content')
 <style>
.mobold{
font-weight:bold; 
color:#203047;

}
 </style>
<section id="main-content">  
    <section class="wrapper">
        <div class="row">   
            <div class="col-lg-12 main-chart">
                <div class="panel panel-default">
                    <div style="background-color:#203047;color:white"  class="panel-heading"><h4>{{  $param['cim'] or ''  }} Dashboard</h4></div>
                    <div class="panel-body">
<center><h3>Álltalános infók</h3></center>
Az applkáció munkaidő nyilvámntartásra lett kifejlesztve.Alapból négy jogosultsági szinttel rendelkezik: 
    </br>
    <span class="mobold">Felhasználó (user): </span> az oldalra csak user jogosultsággal lehet belépni 
    email címmel és jelszóval.Minden más jogosultság endelkezik user jogosultsággal is.
    </br>
    <span class="mobold">Dolgozó (worker):</span>adminisztrálhatja saját adatait, valamint a saját naptárát. A saját naptárán végzett módosítások csak akkor "élesednek" ha a workadmin jóvá hagyja.A módosítások mindaddig szerkeszthetők, törölhetők míg a workadmin jóvá nem hagyja vagy el nem utasítja.
    </br>
    <span class="mobold">Workadmin:</span> Módosíthatja bármelyik worker adatait, naptárát és jóvá hagyhatja vagy elutasíthatja a dolgozók módosításait.
    </br>
    <span class="mobold">Manager:</span>Új felhasználókat,dolgozókat vehet fel és  be állíthatja a jogosultságaikat.Adminisztrálhatja a személyes adataikat rendelkezik workadmin jogosultsággal is.
    </br>
  <!---  <span class="mobold">Szuper admin :</span>Rendelkezik manager és workadmin jogosultsággal is.
    </br> --> </br>
    A bejelenkezett felhasználónak csak a jogosultságával használható menüpontok jelennek meg.
<center><h3> Vezérlő gombok,ikonok</h3></center>

    <i class="fa fa-info-circle fa-2x" style="color:#2A6496;"></i> : Rkkattintva egy információs modal ablakot jelenít meg. Rendszerint a menüpontokhoz tartozó álltalános infókkal.
        </br>
    <i class="fa fa-comment fa-2x"></i> :Az egérmutatóval felé állva egy  tooltip ablakot láthatunk az adott egységhez tartozó infókkal.
              
    
<h4>Adatok kezelése:</h4>
<a  class="btn btn-success btn-xs" > <i class="fa fa-plus" aria-hidden="true"></i> </a>
 : Új rekord felvitele az aktuális táblázatba.
</br></br>
 <a href="#" <button="" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a> 
: Az aktuális rekord szerkesztése.
 </br></br>
<button type="submit" class="btn btn-danger btn-xs" ><i class="fa fa-trash-o" aria-hidden="true"></i></button>
: Törlés.    <span class="mobold"> Figyelem! Nem visszavonható!</span>.  Ha érzékeny adat erre felugró ablak figyelmeztet, ahol a törlést jóvá kell hagyni.
</br>   </br>    

<button class="btn btn-info btn-xs"> <i class="fa fa-eye" aria-hidden="true"></i> </button>               
: A rekord összes hozzáférhető adatának megtekintése. A táblázatba nem mindig fér bele minden.
</br>   </br> 
<a  class="btn btn-success btn-xs"><i class="fa fa-check-square-o" aria-hidden="true"></i></a>
: A rekord láthatóvá tétele a többi felhasználó számára.
</br>   </br>                   
<span class="btn btn-danger btn-xs" ><i class="fa fa-times" aria-hidden="true"></i> </span>
: A rekord láthatatlanná tétele a többi felhasználó számára. (nem kell törölni, ha még később használni akarjuk)
</div>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection
