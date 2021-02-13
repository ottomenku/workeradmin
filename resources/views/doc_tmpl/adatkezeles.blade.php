<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <style> *{font-family: DejaVu Sans !important;} </style><!-- jók az ékezetes betúi --->
</head>
<body>
 
<style type=text/css>

  

.kiemel{font-weight: bold;}

    </style>
<div style="margin:5%">   <center><h3>Nyilatkozat</h3> </center>

 <center><h4>Különleges személyes adatok kezeléséhez való hozzájárulásról a 327/2012 (XI.16) Korm. rendelet alapján</h4></center>
<span>
<span class="kiemel">Alulírott</span><br>
<span class="kiemel">Név:</span>{{$data['worker']['fullname']}}<br>
<span class="kiemel">Szül. hely, idő:</span>{{$data['worker']['birthplace']}} , {{$data['worker']['birth']}}<br>
<span class="kiemel">Lakhely:</span>{{$data['worker']['city']}}, {{$data['worker']['cim']}}<br><br>

    Az információs önrendelkezési jogról és az információszabadságról szóló 2011. évi CXII.
törvény vonatkozó paragrafusai alapján hozzájárulok a {{ $data['ceg']['cegnev'] }}-nél. (székhely:
{{ $data['ceg']['szekhely'] }}, {{ $data['ceg']['cim']}}, adószám: {{$data['ceg']['ado']}}, mint Adatkezelőnél történő, a
rehabilitációs foglalkoztatással kapcsolatos, akkreditációt érintő feladatokat ellátó
ügyintézők, a rehabilitációs mentor és tanácsadó, a Budapest Főváros Kormányhivatala
ellenőrzésre kirendelt munkatársai, foglalkozási rehabilitációs szakértői, a Magyar
Államkincstár (MÁK) ellenőrei ,valamint az EMMI, és a Nemzeti Adó- és Vámhivatal, a
személyi anyagomban foglalt, személyes adataimnak a 327/2012. (XI.16) Kormány rendelet
szerinti ellenőrzési eljárással összefüggésben, kötelezettség teljesítésének ellenőrzése
érdekében szükséges kezeléséhez.<br>
    A társaságnál, mint Adatkezelőnél az adatkezelés időtartama a munkaszerződés fennállásának
ideje. Az ellenőrzésre feljogosítottak az ellenőrzés ideje alatt jogosultak a személyes
dokumentumok kezelésére.</span>
<br>
<br>Kelt: {{$data['kelt']}}

<div style="float: right;padding:10%;">
<br>.........................
<br> aláírás
</div></div>

</body>
</html>