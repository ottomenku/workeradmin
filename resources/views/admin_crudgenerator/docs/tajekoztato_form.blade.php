<div class="form-group">                                                                 
  <label for="name" class="col-md-4 control-label">Irányadó munkarend:</label>
    <div class="col-md-9">  
      <textarea class="form-control" name="munkarend" id="munkarend">
 Nevezett napi 4 óra figyelembevételével munkaidő keretben kerül foglalkoztatásra. A munkaidő keret kezdő időpontja a tárgyhó első napja, a munkaidőkeret záró időpontja a tárgyhó utolsó napja.     
      </textarea> 
    </div>     
</div>
<div class="form-group ">                                                                 
  <label for="name" class="col-md-4 control-label"> A munkáltatói jogkör gyakorlására jogosult</label>
    <div class="col-md-9">    
        <input class="form-control" required="required" name="ugyvezeto" type="text" id="ugyvezeto" 
        value="{{$data['ceg']['ugyvezeto']}}" >  </div>     
</div> 
<div class="form-group ">                                                                 
  <label for="name" class="col-md-4 control-label"> Kelt:</label>
    <div class="col-md-9">    
        <input class="form-control" required="required" name="kelt" type="text" id="kelt" 
        value="{{$data['ceg']['szekhely']}} , {{Carbon\Carbon::now()->toDateString()}} "> </div>     
</div> 

    
 