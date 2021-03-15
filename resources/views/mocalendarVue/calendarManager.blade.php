@extends($viewpar['template'].'.backendVue')

@section('content')


<div  class="col-md-9">
    <div  class="card">
        <div class="card-header">

     <!-- {{ $viewpar['taskheader'] ?? $viewpar['app_name'] ?? $viewpar['route'] ?? 'index' }} ------>

          <span style="color:blue; font-size:1.5em;"> @{{calworker.fullname}}</span>  
          <!-- modal button----------------------------->
          <div  class="float-right"><i style="color:blue;font-size:2rem;"
                  v-on:click="showModalInfo()"class="fa fa-info-circle"></i> 
          </div>

        </div>
        <div class="card-body"> 
     
            
 <!-- modal info------------------------------->
          <modal v-if="showInfo" @close="showInfo = false">    
          <div slot="body">  
          {!! $viewpar['info'] ?? 'Ehhez a feladathoz nincs információ, ha problémája van kérjük hívja az ügyfélszolgálatot!' !!}
          </div>
          </modal>           
  <!-- modal  zárások-------->
          <modal v-if="showModal" @close="showModal = false">
              <div slot="body">            
                    @include('mocalendarVue.inc.showstored')  
              </div>
          </modal>
     
          <ul class="nav nav-tabs nav-justified">
            <li class="nav-item">
                <a class="nav-link" @click.prevent="setActive('home')" :class="{ active: isActive('home') }" href="#home">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" @click.prevent="setActive('stored')" :class="{ active: isActive('stored') }" href="#stored">Havi zárások</a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" @click.prevent="setActive('dayform')" :class="{ active: isActive('dayform') }" href="#dayform">Napok</a>
              </li>   
              <li class="nav-item">
                <a class="nav-link" @click.prevent="setActive('form')" :class="{ active: isActive('form') }" href="#form">Munkaidő felvitel</a>
              </li>
          </ul>        
          <div class="tab-content py-3" id="myTabContent">
            <div class="tab-pane fade" :class="{ 'active show': isActive('home') }" id="home">Home content </div>
            <div class="tab-pane fade" :class="{ 'active show': isActive('form') }" id="form">
   @include('mocalendarVue.inc.time_form')          
            </div>
            <div class="tab-pane fade" :class="{ 'active show': isActive('dayform') }" id="dayform">
  @include('mocalendarVue.inc.day_form')          
            </div>
            <!-- stored ---------------------------------------------------------------------->        
            <div class="tab-pane fade" :class="{ 'active show': isActive('stored') }" id="stored">
                <div class="table-responsive">
          @include('mocalendarVue.inc.stored_table')                             
          <button class=" btn btn-primary" v-on:click="storeStoreds()" style="margin:2px;">           
            <i class="fa fa-save"></i> Zárás/zárás frissítés 
        </button>  
            </div>
                
          </div> 
           </div>
   <!--  panel---------------------------------------------------------------------->                 
  <div class="table-responsive">       
<!-- calendar ---------------------------------------------------------------->
@include('mocalendarVue.inc.calendar_dev')    
 </div>
 <hr>  
<!-- funkció gombok -------------------------------------------------->                        
@include('mocalendarVue.inc.actions_manager',['refreshTask' => "freshdata"])       
<hr>
<div class="row">

  <div v-bind:style=" worker.id==calworkerid ? 'border: 3px solid blue;' : 'border: none;' "
   v-for="worker in workers" class="col-md-2 col-sm-4 col-xs-6 usercard">
   <label  class="checkcontainer">
    <input  v-model="workerids" type="checkbox" name="workerids[]" v-bind:value="worker.id">
   </label>
   
         
    <div v-on:click="setCalworkerid(worker)">   

      <img v-if="typeof(worker.foto)  !== 'undefined' && worker.foto != null" v-bind:src="worker.foto" style="width:100%;">
      <img v-else src="/images/img_avatar.png" alt="Avatar" style="width:100%;">

      <div class="usercardcontainer" >
        <h5><b>@{{worker.workername}}</b></h5>  
        <p>@{{worker.position}}</p>  

        
    </div>
  </div>
</div>


</div>
</div>   
    </div>
</div>
</div>
@include('mocalendarVue.inc.modal_template')




@endsection

