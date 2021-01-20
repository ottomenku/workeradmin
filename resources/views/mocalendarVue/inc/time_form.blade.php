<div class="row">
    <label for="daytype_id" class="col-2 control-label">Kezdés</label>  
      <label for="workernote" class="col-2 control-label">Befejezés</label>
      <label for="workernote" class="col-2 control-label">Óraszám</label>
      <label for="workernote" class="col-2 control-label">Időtipus</label>
</div>
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

        <select class="form-control input-sm " name="timetype_id"  >
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
