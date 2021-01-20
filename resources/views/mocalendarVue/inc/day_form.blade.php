
<div class="row">
    <label for="daytype_id" class="col-3 control-label">Naptipus</label>  
      <label for="workernote" class="col-8 control-label">Megjegyzés</label>
</div>
<div class="row">     
    <div class="col-3">                     
        <select class="form-control input-sm " name="daytype_id">
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
     