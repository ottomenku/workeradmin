<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <style> *{font-family: DejaVu Sans !important; } </style><!-- jók az ékezetes betúi --->
</head>
<body style="font-size:0.8em;">
 
<style type=text/css>

  

.kiemel{font-weight: bold;}

    </style>
<div style="margin-left:3%;margin-right:3%">   <center><h3>TÁJÉKOZTATÓ</h3> </center>

 
<span class="kiemel">Munkavállaló neve:</span>{{$data['worker']['fullname']}}<br>
<span class="kiemel">Munkavállaló munkaköre:</span>{{$data['worker']['position']}} <br>

  <br><span>A Munka Törvénykönyvéről szóló 2012. évi I. törvény 46.§. alapján a foglalkoztatással kapcsolatban az alábbiakról tájékoztatom:</span>
   

  <br> <span class="kiemel"> 1. Munkába lépés napja:</span>  <span> {{$data['worker']['start']}}.</span>  
    
  <br>
   <span class="kiemel">2. Irányadó munkarend:</span><br>   
   <span> {{$data['munkarend']}}  </span><br>  
   <span class="kiemel" >3. A munkabér - munkaszerződésben meghatározott személyi alapbéren felüli – egyéb elemei:</span><br> 
    <span> Az alapbéren túli esetleges egyéb bérelemek, juttatások körét a munkaszerződés, valamint az egyéb belső munkaügyi szabályzatok tartalmazzák.</span><br> 
    
 <span class="kiemel" >4. Munkaköri leírás:</span> <br>  
 <span> A munkaszerződéshez kapcsolódó munkaköri leírás külön dokumentumban kerül meghatározásra.</span><br> 
    
  <span class="kiemel" >4.	A bérfizetés napja:</span> <br>  
 <span>   A jogszabályban meghatározott levonásokkal csökkentett – nettó – munkabér kifizetésére havonta, a tárgyhónapot követő hónap 10. napjáig kerül sor. Ha a bérfizetési nap pihenőnapra vagy munkaszüneti napra esik, a munkáltató a munkabért legkésőbb az ezt megelőző munkanapon fizeti ki. 
 </span><br>  
 
   <span class="kiemel" > 5. A rendes szabadság mértékének számítási módja és kiadásának szabályai:</span> <br>  
 <span>    A szabadság mértékéről, számítási módjáról és kiadásának szabályairól az Mt. 115-125. §-i tartalmaznak előírásokat, melyek a munkaszerződésben foglalt eltérésekkel alkalmazandóak.
  </span><br> 

   <span class="kiemel" >6. A napi munkaidő:</span> <br>  
 <span> Beosztás alapján a munkáltató határozza meg.</span><br> 
    
      <span class="kiemel" >7. A felekre irányadó felmondási idő megállapításának szabályai:</span> <br>  
 <span>   A felmondási idő szabályai tekintetében az Mt. 68-70.§-ai az irányadóak, a munkaszerződésben foglalt eltérésekkel.
 </span><br> 
    
       <span class="kiemel" > 8. Kollektív szerződésre vonatkozó tájékoztatás</span> <br>  
 <span> Önre nézve érvényes kollektív szerződés nincs hatályban. </span><br> 
    
      <span class="kiemel" >9. A munkáltatói jogkör gyakorlására jogosult:</span>   
 <span> {{$data['ceg']['ugyvezeto']}}</span><br> 
  <span>   A munkáltatói jogkör gyakorlására jogosult személyek utasításadási jogkörüket a munkavállalóval közölt más személyre is jogosultak ideiglenesen, vagy tartós jelleggel átruházni. </span><br>  

</span>

        <div style="padding-left:2%;">
        <br>  <br>Kelt: {{$data['kelt']}} .   
        <br><br><br>................................................
           <br> Munkáltató
        </div>

        <div style="float: right;padding-right:2%;">
         A tájékoztató 1 pld-át átvettem:   
       <br> <br><br>...............................................

        </div>
</div>

</body>
</html>