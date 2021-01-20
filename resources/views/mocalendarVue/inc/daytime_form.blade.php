

<div class="row">                             

    <div style=" padding-left: 5px; padding-right: 0;" class="col-2">    
            <input class="form-control" name="start" type="time" id="start">       
    </div>      
    <div style=" padding-left: 5px; padding-right: 0;" class="col-2">                                    
            <input class="form-control" name="end" type="time" id="end">                       
    </div>
    <div style=" padding-left: 5px; padding-right: 0;" class="col-2"> 
            <input class="form-control" name="hour" type="number" id="hour">              
    </div>
    <div style=" padding-left: 5px; padding-right: 20;"  class="col-3">           

        <select class="form-control input-sm " name="timetype_id"  v-model="actTimetype">
            <option v-for="(timetype, index) in timetypes" :value="index">@{{timetype}}</option>
            </select>
    </div>  
    <button class=" btn btn-primary"  v-on:click="storetimes()" style="margin:2px;" >           
        <i class="fa fa-save"></i>
    </button> 
    <button class=" btn btn-danger" v-on:click="timesreset()" style="margin:2px;">     
        <i class="fa fa-trash"></i>
    </button>       
    
</div> 
Munkaidők felvitele a kijelölt napokhoz                
<hr>

<div class="row">
    <label for="daytype_id" class="col-3 control-label">Naptipus</label>  
      <label for="workernote" class="col-8 control-label">Megjegyzés</label>
</div>
<div class="row">     
    <div class="col-3">                     
        <select class="form-control input-sm " name="daytype_id" >
            <option v-for="(daytype, index) in daytypes" :value="index">@{{daytype}}</option>
            </select>
    </div> 
  
    <div class="col-6">     
            <input class="form-control"  name="adnote" type="text" id="workernote">                   
    </div>

    <button class=" btn btn-primary" v-on:click="storedays()" style="margin:2px;">           
        <i class="fa fa-save"></i>
    </button> 
    <button class=" btn btn-danger" v-on:click="daysreset()" style="margin:2px;">     
        <i class="fa fa-trash"></i>
    </button>   
</div>   
Szabadság betegállomány stb  felvitele a kijelölt napokhoz

<hr>        