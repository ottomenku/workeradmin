@extends($viewpar['template'].'.backendVue')

@section('content')


<div  class="col-md-9">
    <div id="app" class="card">
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
  <div v-bind:style=" calworkerid==0 ? 'border: 3px solid blue;' : 'border: none;' " class="col-md-2 col-sm-4 col-xs-6 usercard">
    
         
    <div v-on:click="setCalworkerid('base')">   
      <img src="/images/img_avatar.png" alt="Avatar" style="width:100%;">

      <div class="usercardcontainer" >
        <h5><b>Empty user</b></h5>  
        <p>szerkesztő </p>  

        
    </div>
  </div>
</div>
  <div v-bind:style=" worker.id==calworkerid ? 'border: 3px solid blue;' : 'border: none;' "
   v-for="worker in workers" class="col-md-2 col-sm-4 col-xs-6 usercard">
    
      <label  class="checkcontainer">
        <input  v-model="workerids" type="checkbox" name="workerids[]" v-bind:value="worker.id">
        <span class="checkmarkcheckbox2" style="width:100%; border-style: double; font-size:0.8em; height:25px;">  
          <span v-if="workerids.includes(worker.id)" style="color:white;"> <i class="fa fa-check-square"></i> kijelölve  </span>
          <span style="color:grey;"v-else><i class="fa fa-minus-square"></i>  kijelölés</span>
        </span>
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


<style>
  .table th, .table td {
      padding: 0.25rem;
    }

    [class*="col-"],  /* Elements whose class attribute begins with "col-" */
    [class^="col-"] { /* Elements whose class attribute contains the substring "col-" */
      padding-left: 5px;
      padding-right: 0;
    }
  /* card ----------- */
  .card header {
    padding: 10px;
    background-color: rgb(41,73,130);
    color: #fff;
  }

  .usercard {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
  /*  pointer: 
    width: 20%;
    float:left;
    padding: 5px;*/
  }
  
  .usercard:hover {
    box-shadow: 0 8px 16px 0 rgba(14, 6, 128, 0.8);
  }
  
  .usercardcontainer {
    padding: 2px 16px;
  }
 

/* checkbox radiobutton------------------------------ */

  /* The container */
  .checkcontainer {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }
  
  /* Hide the browser's default radio button */
  .checkcontainer input {
   position: absolute;
    opacity: 0;
    cursor: pointer;
  }
  
  /* Create a custom radio button */
  .checkmarkradio {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border-radius: 50%;
  }
  
  /* On mouse-over, add a grey background color ------------*/
  .checkcontainer:hover input ~ .checkmarkradio {
    background-color: ;
  }
  
  /* When the radio button is checked, add a blue background */
  .checkcontainer input:checked ~ .checkmarkradio {
    background-color: #2196F3;
  }
  /* Show the indicator (dot/circle) when checked */
  .checkcontainer input:checked ~ .checkmarkradio:after {
    display: block;
  }
  
  /* Style the indicator (dot/circle) */
  .checkcontainer .checkmarkradio:after {
     top: 9px;
    left: 9px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: white;
  }
  
  /* közös */
  .checkmarkradio:after, .checkmarkcheckbox:after {
    content: "";
    position: absolute;
    display: none;
  }
  
  /* Create a custom checkbox */
  .checkmarkcheckbox {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
  }
  
  
  /* On mouse-over, add a grey background color */
  .checkcontainer:hover input ~ .checkmarkcheckbox {
    background-color: ;
  }
  
  /* When the checkbox is checked, add a blue background ---------*/
  .checkcontainer input:checked ~ .checkmarkcheckbox {
    background-color: #2196F3;
  }
  /* On mouse-over, add a grey background color */
  .checkcontainer:hover input ~ .checkmarkcheckbox {
    background-color: ;
  }
  
  /* When the checkbox is checked, add a blue background */
  .checkcontainer input:checked ~ .checkmarkcheckbox {
    background-color: #2196F3;
  }
  
  /* Show the checkmark when checked */
  .checkcontainer input:checked ~ .checkmarkcheckbox:after {
    display: block;
  }
  
  /* Style the checkmark/indicator */
  .checkcontainer .checkmarkcheckbox:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
  }
  
  /* Create a custom checkbox2 */
  .checkmarkcheckbox2 {
    position: absolute;
    top: 0;
    left: 0;
  /*  height: 20px;*/
    width: 100%;
    background-color: #eee;
  }
  
  
  /* On mouse-over, add a grey background color */
  .checkcontainer:hover input ~ .checkmarkcheckbox2 {
    background-color: rgb(170, 109, 109);
  }
  
  /* When the checkbox is checked, add a blue background ---------*/
  .checkcontainer input:checked ~ .checkmarkcheckbox2 {
    background-color:rgb(170, 109, 109);
  }
  /* On mouse-over, add a grey background color */
  .checkcontainer:hover input ~ .checkmarkcheckbox2 {
    background-color:rgb(170, 109, 109) ;
  }
  
  
  /* Show the checkmark when checked */
  .checkcontainer input:checked ~ .checkmarkcheckbox2:after {
    display: block;
  }
  
  /* Style the checkmark/indicator */
  .checkcontainer .checkmarkcheckbox2:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
  }
  

   
</style>

@endsection

