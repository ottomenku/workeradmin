@extends($viewpar['template'].'.backendVue')

@section('content')
@php 
//$year=$data['year'] ?? $this->PAR['getT']['ev'] ?? \Carbon::now()->year; 

//$checkbutton=$viewpar['calendar']['checkbutton'] ?? true;
$months_magyar=['hónapok','Január','Február','Március','Április','Május','Június','Július','Augusztus','Szeptember','Október','November','Decenber'];
$months=$viewpar['calendar']['months'] ?? $months_magyar; unset($months[0]);// kiveszi az alapfeliratot és 1-el kezdődikaz index nem 0-val!!!!!

//if($ev_ho_formurl_addgetT){$ev_ho_formurl= MoHandF::url($ev_ho_formurl,$viewpar['getT']);}
//<label for="timetype_id" class="col-3 control-label">Naptipus</label>     
 @endphp
<style>
    .table th, .table td {
        padding: 0.25rem;
      }
 
      [class*="col-"],  /* Elements whose class attribute begins with "col-" */
      [class^="col-"] { /* Elements whose class attribute contains the substring "col-" */
        padding-left: 5px;
        padding-right: 0;
      }

</style>
<div  class="col-md-9">
    <div class="card">
        <div class="card-header">{{ $viewpar['taskheader'] ?? $viewpar['app_name'] ?? $viewpar['route'] ?? 'index' }}
        </div>
        <div class="card-body"> 
                <br>
<!-- vue applikáció------------------------------------------------------>                     
<div id="app">
 ho: @{{ho}}
 <br>
 limk: @{{host}}@{{baseroute}}
 <br>
 workerids: @{{workerids}}
<br>
workerdays: @{{dayids}}
<br>
times2: @{{times2}}
<br>

   <!--  panel---------------------------------------------------------------------->                 
   <div class="container">
   <ul class="nav nav-tabs nav-justified">
    <li class="nav-item">
        <a class="nav-link" @click.prevent="setActive('home')" :class="{ active: isActive('home') }" href="#home">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" @click.prevent="setActive('newform')" :class="{ active: isActive('newform') }" href="#newform">Üj bejegyzés</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" @click.prevent="setActive('timeform')" :class="{ active: isActive('timeform') }" href="#timeform">Idők szerkesztése</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" @click.prevent="setActive('dayform')" :class="{ active: isActive('dayform') }" href="#dayform">Napok szerkesztése</a>
      </li>
  </ul>        
  <div class="tab-content py-3" id="myTabContent">
    <div class="tab-pane fade" :class="{ 'active show': isActive('home') }" id="home">Home content </div>

    <!-- uj form---------------------------------------------------------------------->        
    <div class="tab-pane fade" :class="{ 'active show': isActive('newform') }" id="newform">
        <hr> 
        Kijelölt napok:  @{{ datums }}  
        <hr>
        <div class="row">                             

            <div style=" padding-left: 5px; padding-right: 0;" class="col-2">    
                    <input class="form-control" v-model="timeFormDatas.start" name="start" type="time" id="start">       
            </div>      
            <div style=" padding-left: 5px; padding-right: 0;" class="col-2">                                    
                    <input class="form-control" v-model="timeFormDatas.end" name="end" type="time" id="end">                       
            </div>
            <div style=" padding-left: 5px; padding-right: 0;" class="col-2"> 
                    <input class="form-control" v-model="timeFormDatas.hour" name="hour" type="number" id="hour">              
            </div>
            <div style=" padding-left: 5px; padding-right: 20;"  class="col-3">           

                <select class="form-control input-sm " name="timetype_id"  v-model="actTimetype">
                    <option v-for="(timetype, index) in timetypes" :value="index">@{{timetype}}</option>
                    </select>
            </div>  
            <input  type="checkbox" name="pubtime" value="10">Jóváhagyás
            <button class=" btn btn-primary"  v-on:click="storetimes()" style=" margin:0 10px;" >           
                <i class="fa fa-save"></i>
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
                <select class="form-control input-sm " name="daytype_id"  v-model="actDaytype">
                    <option v-for="(daytype, index) in daytypes" :value="index">@{{daytype}}</option>
                    </select>
            </div> 
          
            <div class="col-6">     
                    <input class="form-control" v-model="dayFormDatas.adnote" name="adnote" type="text" id="workernote">                   
            </div>
            <input  type="checkbox" name="pubday" value="10">Jóváhagyás
            <button class="col-1 btn btn-primary" v-on:click="storedays()" style=" margin:0 10px;" >           
                <i class="fa fa-save"></i>
            </button> 
         
        </div>   
        Szabadság betegállomány stb  felvitele a kijelölt napokhoz

        <hr>         
    </div>
<!-- idők szerkesztése---------------------------------------------------------------------->     
<div class="tab-pane fade" :class="{ 'active show': isActive('timeform') }" id="timeform">
     
           
           <div class="table-responsive">
            <table class="table table-borderless">
                <thead>
                    <tr>
                       <th>Dátum</th><th>Start</th><th>End</th><th>Óra</th><th>Tipus</th><th>del</th>
                    </tr>
                </thead>
                <tbody>
                  
                    <tr v-bind:class="[times.idkey[timeid].class]" v-for="timeid in timeids">
                                             
                        <td>@{{times.idkey[timeid].datum}}</td><td>@{{times.idkey[timeid].start}}</td><td> @{{times.idkey[timeid].end}}</td>
                        <td> @{{times.idkey[timeid].hour}} </td><td> @{{times.idkey[timeid].timetype.name}} </td>
                        <td>
                            <i v-on:click="unchecktime(timeid)"class="fa fa-times-circle"></i> 
                        </td>                 
                   
                    </tr>
                      
             
                </tbody>
            </table>
            </div> 



       </br>
<div class="row">                             
     <div class=" col-sm-8 "> 
        <div class="row"> 
               <div style=" padding-left: 5px; padding-right: 0;" class=" col-3 ">    
                       <input class="form-control" v-model="timeFormDatas.start" name="ustart" type="time" id="ustart">       
               </div>      
               <div style=" padding-left: 5px; padding-right: 0;"  class="col-3">                                    
                       <input class="form-control" v-model="timeFormDatas.end" name="uend" type="time" id="uend">                       
               </div>
               <div style=" padding-left: 5px; padding-right: 0;" class="col-2"> 
                       <input class="form-control" v-model="timeFormDatas.hour" name="uhour" type="number" id="uhour">              
               </div>
               <div style=" padding-left: 5px; padding-right: 30px;"  class="col-4">           
   

                   <select class="form-control input-sm " name="timetype_id"  v-model="actTimetype">
                    <option v-for="(timetype, index) in timetypes" :value="index">@{{timetype}}</option>
                    </select>
               
                </div>  
        </div> 
    </div>    
        <div class="col-sm-3"> 
                <div class="row"> 
                     
                    <button class=" btn btn-primary"  v-on:click="updatetimes()" style=" margin:2px;" >           
                        <i class="fa fa-edit"></i>
                    </button> 
                        <button class=" btn btn-danger" v-on:click="deltimes()" style="margin:2px;">     
                        <i class="fa fa-trash"></i>
                    </button>  
                    <button class="btn btn-outline-success" v-on:click="deltimes()" style="margin:2px;">     
                        <i class="fa fa-check"></i>
                    </button> 
                    <button class=" btn btn-outline-danger" v-on:click="deltimes()" style="margin:2px;">     
                        <i class="fa fa-times-circle"></i>
                    </button> 
                </div>
        </div>   
    </div>
</div>
<!--  day form---------------------------------------------------------------------->    

<div class="tab-pane fade" :class="{ 'active show': isActive('dayform') }" id="dayform">
     
           
    <div class="table-responsive">
     <table class="table table-borderless">
         <thead>
             <tr>
                <th>Dátum</th><th>Tipus</th><th>worker Megjegyzés</th><th>Admin Megjegyzés</th><th>del</th>
             </tr>
         </thead>
         <tbody>        
             <tr v-bind:class="[workerdays.idkey[dayid].class]" v-for="dayid in dayids">                                   
                 <td>@{{workerdays.idkey[dayid].datum}}</td><td> @{{workerdays.idkey[dayid].daytype.name}} </td>
                 <td>@{{workerdays.idkey[dayid].worknote}}</td> <td>@{{workerdays.idkey[dayid].adnote}}</td>
                 <td>
                    <i v-on:click="uncheckday(dayid)" class="fa fa-times-circle"></i> 
                </td>                                            
             </tr>    
         </tbody>
     </table>
     </div> 



</br>
<div class="row">                             
<div class=" col-sm-8 "> 
 <div class="row"> 
       
        <div class="col-3">                     
            <select class="form-control input-sm " name="udaytype_id"  v-model="actDaytype">
                <option v-for="(daytype, index) in daytypes" :value="index">@{{daytype}}</option>
                </select>
        </div> 
      
        <div class="col-6">     
                <input class="form-control" v-model="dayFormDatas.workernote" name="uworkernote" type="text" id="uworkernote">                   
        </div>
     </div> 
     
 </div>  
 <div class="col-sm-3"> 
         <div class="row"> 
              
             <button class=" btn btn-primary"  v-on:click="updatetimes()" style=" margin:2px;" >           
                 <i class="fa fa-edit"></i>
             </button> 
                 <button class=" btn btn-danger" v-on:click="deltimes()" style="margin:2px;">     
                 <i class="fa fa-trash"></i>
             </button>  
             <button class="btn btn-outline-success" v-on:click="deltimes()" style="margin:2px;">     
                 <i class="fa fa-check"></i>
             </button> 
             <button class=" btn btn-outline-danger" v-on:click="deltimes()" style="margin:2px;">     
                 <i class="fa fa-times-circle"></i>
             </button> 
         </div>
 </div>   
</div>
</div>  
<!-- funkció gombok -------------------------------------------------->
</br>
                   <div class="row">    
                    <div class="col-xs-4"> 
                    <div class="input-group">  
                        <span  v-on:click="minusyear()" style="cursor: pointer;" class="btn btn-outline-secondary input-sm"><</span>
                        <input id="ev" size="2"  name="ev" type="text" v-on:change="changeEv()" v-bind:value="ev" class="form-control input-sm ">
                        <span v-on:click="addyear()" style="cursor: pointer;" class="btn btn-outline-secondary input-sm">></span>
                    </div>
                    </div> 

                    <div class="col-xs-2"> 
                        <select class="form-control input-sm " name="ho" v-on:change="changeHo()" v-model="ho">
                            <option v-for="mounth in mounths" :value="mounth.value">@{{ mounth.text }}</option>
                        </select>
                    </div>
                    <div class="col-xs-2"> 
                    <select class="form-control input-sm " name="timetype_id"  v-model="actchecklist">
                        <option v-for="(val, index) in checklist" :value="index">@{{val}}</option>
                    </select>
                    </div>
                    </div>  
<!-- calendar ---------------------------------------------------------------->
                                  
    <div id="calendar">
       <div v-for="(worker, workerid) in workers"  id="usercalendar"> 
           <span>@{{worker.fullname}}  </span>
           <input  v-model="workerids"  type="checkbox" name="workerid[]" v-bind:value="workerid">
                        <section class="th">
                            
                            <span>Hétfő</span>
                            <span>Kedd</span>
                            <span>Szerda</span>
                            <span>Csütörtök</span>
                            <span>Péntek</span>
                            <span>Szombat</span>
                            <span>Vasárnap</span>
                        </section>
                        <div class="week" v-for="(week, weekindex) in calendar">      
                            <div  v-bind:class="item.class" v-for="(item, datum) in week" v-bind:data-date="item.day"> 
                                <div v-bind:id="datum" v-on:click="setActive('newform')" class="dayheader" v-if="item.name !== 'empty'">
                                    <span class="" > <input class="{ workday: item.munkanap }" v-model="datums" type="checkbox" name="datum[]" v-bind:value="datum"> </span>
                                    <span v-if="typeof basedays[datum] !== 'undefined'" class="dayhead" > 
                                        @{{basedays[datum]}}
                                    </span>
                                </div>    
                            <div class="daynumber" > @{{item.day}} </div>                 
                            <div v-if="typeof(workerdays.datekey[workerid])  !== 'undefined'" >
                                <div  v-on:click="setActive('dayform')" v-bind:class="[workerdays.class]" v-for="workerdays in workerdays.datekey[workerid][datum]" >
                                    <input  class="{ workerdays.class }" v-model="dayids" type="checkbox" name="dayid[]" v-bind:value="workerdays.id">
                                    @{{workerdays.daytype.name}}        
                                </div> 
                            </div> 
                            <div  v-if="typeof(times.datekey[workerid]) !== 'undefined'" >      
                                <div v-on:click="setActive('timeform')" v-bind:class="[time.class]" v-on:click="selectime()" v-for="(time) in times.datekey[workerid][datum]" >
                                    <input   v-model="timeids" type="checkbox" name="timeid[]" v-bind:value="time.id">
                                    @{{time.start}}-@{{time.end}}         
                                </div>
                            </div> 
                            </div> 
                        </div> 
                    </div>  
        </div>    
</div>   



</div>

</div>

@endsection

