@extends($viewpar['template'].'.backendVue')

@section('content')
@php 
//$year=$data['year'] ?? $this->PAR['getT']['ev'] ?? \Carbon::now()->year; 
$year=$viewpar['routpars']['id'] ?? Carbon\Carbon::now()->year; 
$ho=$viewpar['routpars']['id1'] ?? Carbon\Carbon::now()->month;
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
                <div id="app"> 


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
        <a class="nav-link" @click.prevent="setActive('editform')" :class="{ active: isActive('editform') }" href="#editform">Idők szerkesztése</a>
      </li>
  </ul>        
  <div class="tab-content py-3" id="myTabContent">
    <div class="tab-pane fade" :class="{ 'active show': isActive('home') }" id="home">Home content </div>
    <div class="tab-pane fade" :class="{ 'active show': isActive('newform') }" id="newform">
        <hr> 
        Kijelölt napok:  @{{ datums }}  
        <hr>
        <div class="row">                             

            <div class="col-2">    
                    <input class="form-control" v-model="timeFormDatas.start" name="start" type="time" id="start">       
            </div>      
            <div class="col-2">                                    
                    <input class="form-control" v-model="timeFormDatas.end" name="end" type="time" id="end">                       
            </div>
            <div class="col-2"> 
                    <input class="form-control" v-model="timeFormDatas.hour" name="hour" type="number" id="hour">              
            </div>
            <div class="col-3">           

                <select class="form-control input-sm " name="timetype_id"  v-model="actTimetype">
                    <option v-for="(timetype, index) in timetypes" :value="index">@{{timetype}}</option>
                    </select>
            </div>  
            
            <button class="col-1 btn btn-success"  v-on:click="storetimes()" style=" margin:0 10px;" >           
                <i class="fa fa-plus"></i>
            </button> 
                <button class="col-1 btn btn-danger" v-on:click="timedel()" style="margin:0px;">     
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
                <select class="form-control input-sm " name="daytype_id"  v-model="actDaytype">
                    <option v-for="(daytype, index) in daytypes" :value="index">@{{daytype}}</option>
                    </select>
            </div> 
          
            <div class="col-6">     
                    <input class="form-control" v-model="dayFormDatas.workernote" name="workernote" type="text" id="workernote">                   
            </div>
            <button class="col-1 btn btn-success" v-on:click="storedays()" style=" margin:0 10px;" >           
                <i class="fa fa-plus"></i>
            </button> 
         
        </div>   
        Szabadság betegállomány stb  felvitele a kijelölt napokhoz

        <hr>         
    </div>
    <div class="tab-pane fade" :class="{ 'active show': isActive('editform') }" id="editform">
     
           
           <div class="table-responsive">
            <table class="table table-borderless">
                <thead>
                    <tr>
                       <th>Dátum</th><th>Start</th><th>End</th><th>Óra</th><th>Tipus</th>
                    </tr>
                </thead>
                <tbody>
                  
                    <tr v-for="timeid in timeids">
                                             
                        <td>@{{times.idkey[timeid].datum}}</td><td>@{{times.idkey[timeid].start}}</td><td> @{{times.idkey[timeid].end}}</td>
                        <td> @{{times.idkey[timeid].hour}} </td><td> @{{times.idkey[timeid].timetype.name}} </td>
                                        
                    </div>
                    </tr>
                      
             
                </tbody>
            </table>
            </div> 



       </br>
           <div class="row">                             
   
               <div class="col-2">    
                       <input class="form-control" v-model="timeFormDatas.start" name="ustart" type="time" id="ustart">       
               </div>      
               <div class="col-2">                                    
                       <input class="form-control" v-model="timeFormDatas.end" name="uend" type="time" id="uend">                       
               </div>
               <div class="col-2"> 
                       <input class="form-control" v-model="timeFormDatas.hour" name="uhour" type="number" id="uhour">              
               </div>
               <div class="col-3">           
   

                   <select class="form-control input-sm " name="timetype_id"  v-model="actTimetype">
                    <option v-for="(timetype, index) in timetypes" :value="index">@{{timetype}}</option>
                    </select>
               
                </div>  
               
               <button class="col-1 btn btn-primary"  v-on:click="updatetimes()" style=" margin:0 10px;" >           
                   <i class="fa fa-save"></i>
               </button> 
                   <button class="col-1 btn btn-danger" v-on:click="deltimes()" style="margin:0px;">     
                   <i class="fa fa-trash"></i>
               </button>       
               
           </div>
  </div> 
   </div>     
<!-- funkció gombok -------------------------------------------------->

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
                                  
                    <main id="calendar">
                        <section class="th">
                            
                            <span>Hétfő</span>
                            <span>Kedd</span>
                            <span>Szerda</span>
                            <span>Csütörtök</span>
                            <span>Péntek</span>
                            <span>Szombat</span>
                            <span>Vasárnap</span>
                        </section>
                        <div class="week" v-for="(week, index) in calendar">      
                            <div  v-bind:class="item.class" v-for="(item, index) in week" v-bind:data-date="item.day"> 
                                <div v-bind:id="index" v-on:click="selectday()" class="dayheader" v-if="item.name !== 'empty'">
                                    <span class="" > <input class="{ workday: item.munkanap }" v-model="datums" type="checkbox" name="datum[]" v-bind:value="index"> </span>
                                    <span v-if="typeof basedays[index] !== 'undefined'" class="dayhead" > 
                                        @{{basedays[index]}}
                                    </span>
                                </div>    
                            <div class="daynumber" > @{{item.day}} </div>                 
                                <div v-if="typeof workerdays.datekey[index] !== 'undefined'" >
                                    <div v-bind:class="[workerdays.class]" v-for="(workerdays, index2) in workerdays.datekey[index]" >
                                        @{{workerdays.daytype.name}}        
                                    </div> 
                                </div> 
                                      
                                <div v-bind:class="[time.class]" v-on:click="selectime()" v-for="(time) in times.datekey[index]" v-if="typeof times.datekey[index] !== 'undefined'" >
                                    <input v-if="typeof workerdays.pub==1" class="{ workday: item.class }" v-model="timeids" type="checkbox" name="timeid[]" v-bind:value="time.id">
                                    @{{time.start.substring(0,5)}}- @{{time.end.substring(0,5)}}          
                                </div> 
                            </div> 
                            </div>   
                        </div>    
                    </main>   
                </div>

        </div>
    </div>
</div>
@endsection

