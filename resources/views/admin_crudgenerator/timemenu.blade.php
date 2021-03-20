<div class="col-md-2">

 <div class="card">
    <div class="card-header">
          <a class="nav-link" href="#">
                  << Nyitólap
                </a>
    </div>
 
</div> 
</br> 
<ul class="nav nav-tabs" id="myTab" role="tablist">
    
 <li class="nav-item waves-effect waves-light">
      <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="true">Napok</a>
    </li>
    <li class="nav-item waves-effect waves-light">
      <a class="nav-link " id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Munkaidők</a>
    </li>
   
</ul>
<div class="tab-content" id="myTabContent">
<div class="tab-pane fade active show" id="contact" role="tabpanel" aria-labelledby="contact-tab">
     <!-- napok form   https://fontawesome.com/v4.7.0/icons/ ---------------------------------> 
        <div class="row">
            <label for="daytype_id" class="col-3 control-label">Naptipus</label>  
           
        </div>
        <div class="row">     
                              
              
              @foreach ($data['daytypes'] as $daytype)
                <div class="col-11">  
              @php
              $color=$daytype['color']  ?? 'gray';
              $bgcolor='';
              $hourcolor=$daytype['timetype']['color']  ?? 'gray';
              $hourbgcolor='';
              if(isset($daytype['background'])) {$bgcolor= ' background-color:'.$daytype['background'].';';}
              if(isset($daytype['timetype']['background'])) {$hourbgcolor= ' background-color:'.$daytype['timetype']['background'].';';}
              @endphp

              <input type="radio"  name="daytype_id" value="{{$daytype['id']}}">
                
               <i style="font-size:1.8em; color:{{$color}}; {{$bgcolor}} " class="fa fa-{{$daytype['icon'] ?? ''}}" aria-hidden="true"></i>
            
                <label for="daytype_id" class="col-10 control-label">{{$daytype['name'] ?? ''}}
                <span style="font-size:1.3em; color:{{$hourcolor}}; {{$hourbgcolor}}" >{{$daytype['timetype']['basehour'] ?? '0'}} óra</span> 
                 </label>
                </div>
                
              @endforeach
        </div>
        <div class="row">
            <label for="daytype_id" class="col-3 control-label">megjegyzés</label>  
           
        </div>
        <div class="row">          
            <div class="col-11">     
                    <input class="form-control"  name="adnote" type="text" id="workernote">                   
            </div> 
        </div>
        <button class=" btn btn-primary" v-on:click="storedays()" style="margin:2px;">           
            <i class="fa fa-save"></i>
        </button> 
        <button class=" btn btn-danger" v-on:click="daysreset()" style="margin:2px;">     
            <i class="fa fa-trash"></i>
        </button> 
        <!--  napok form  end ---------------------------------> 
    </div>
 
   <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
   
    <div class="row">     
   

      <div style=" padding-left: 5px; padding-right: 0;" class="col-11"> 
        <label for="hour" class="col-11 control-label">Óra (ez lesz bérszámfejtve)</label> 
              <input class="form-control" name="hour" type="number" id="hour">              
      </div>
                       
      <div style=" padding-left: 5px; padding-right: 0;" class="col-6">    
        <label for="start" class="col-6 control-label">Kezdés </label> 
              <input class="form-control" name="start" type="time" id="start">       
      </div>      
      <div style=" padding-left: 5px; padding-right: 0;" class="col-6">  
        <label for="end" class="col-6control-label">Befejezés </label>                               
              <input class="form-control" name="end" type="time" id="end">                       
      </div>
      (csak tájékoztató adatok) </br> </br> 
      <div style=" padding-left: 5px; padding-right: 20;"  class="col-11">           

      @foreach ($data['timetypes'] as $timetype)
      <div onclick="hourToInput({{$timetype['basehour'] ?? ''}})" class="col-11">  
    @php
    $color=$timetype['color']  ?? 'gray';
    $bgcolor='';
    if(isset($timetype['background'])) {$bgcolor= ' background-color:'.$timetype['background'].';';}

    @endphp

    <input type="radio"  name="timetype_id" value="{{$timetype['id']}}">
      <span style="font-size:1.3em; color:{{$color}}; {{$bgcolor}}" >{{$timetype['name'] }} {{$timetype['basehour'] ?? '0'}} óra</span> 
      </div>
      
    @endforeach



</div>

      <button class=" btn btn-primary"  v-on:click="storetimes()" style="margin:2px;" >           
          <i class="fa fa-save"></i>
      </button> 
      <button class=" btn btn-danger" v-on:click="timesreset()" style="margin:2px;">     
          <i class="fa fa-trash"></i>
      </button>       
      
  </div> 

    </div>
  
</div>