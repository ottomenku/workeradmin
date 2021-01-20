@php 

$months_magyar=['hónapok','Január','Február','Március','Április','Május','Június','Július','Augusztus','Szeptember','Október','November','Decenber'];
$months=$viewpar['calendar']['months'] ?? $months_magyar; unset($months[0]);// kiveszi az alapfeliratot és 1-el kezdődikaz index nem 0-val!!!!!
$template=$viewpar['template'] ?? 'admin_crudgenerator';
@endphp

@extends($template.'.backendVue')

@section('content')


<div  class="col-md-9">
    <div class="card">
        <div class="card-header">{{ $viewpar['taskheader'] ?? $viewpar['app_name'] ?? $viewpar['route'] ?? 'index' }}
        </div>
        <div class="card-body"> 
                <br>
<style>
  .difminusz{ color:red;}
  .difplusz{ color:green;}    
</style>
<!-- vue applikáció--------------------------->                     
<div id="app">

<!-- modal button----------------------------->
<div  class="float-right"><i style="color:blue;font-size:2rem;"
        v-on:click="showModalInfo()"class="fa fa-info-circle"></i> 
</div>


<!-- modal info------------------------------->
  <modal v-if="showInfo" @close="showInfo = false">    
  <div slot="body">  
  info szöveg
  </div>
  </modal>

<!-- modal--------------------------------------->
    <modal v-if="showModal" @close="showModal = false">    
    <div slot="body">  
    @include('mocalendarVue.inc.solver')
    </div>
    </modal>
<!--  panel---------------------------------------->                 
      <div class="container">
      <ul class="nav nav-tabs nav-justified">
      <li class="nav-item">
          <a class="nav-link" @click.prevent="setAdminActive('stored')" :class="{ active: isAdminActive('stored') }" href="#stored">Zárások</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" @click.prevent="setAdminActive('timeframe')" :class="{ active: isAdminActive('timeframe') }" href="#newform">Időkeret</a>
        </li>

      </ul>        
    <div class="tab-content py-3" id="myTabContent">
    <div class="tab-pane fade" :class="{ 'active show': isAdminActive('stored') }" id="stored">
    
<!-- funkció gombok ---------------------------------->
      @include('mocalendarVue.inc.ev_ho',['refreshTask' => "stored"])
<!-- stored ------------------------------------------>        
       @include('mocalendarVue.inc.stored_table')

      </div>
      <div class="tab-pane fade" :class="{ 'active show': isAdminActive('timeframe') }" id="timeframe">
  @include('mocalendarVue.admin.inc.timeframe')
      </div>
<!-- stored -------------------------------------------->
     

</div>  
</div> 







 

  
</div>
</div>
</div>
</div>

<!-- modal template -------------------------------------------------->
@include('mocalendarVue.inc.modal')



@endsection

