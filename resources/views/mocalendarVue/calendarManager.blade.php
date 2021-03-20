@extends($viewpar['template'].'.backendVue')

@section('content')


<div class="col-md-10">
  <div class=" card">
    <div class="card-header">
      <div class="row">
        <div class="col-md-6">
          @include('mocalendarVue.inc.actions_manager',['refreshTask' => "freshdata"])
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-10">
              <h3> @{{calworker.fullname}}</h3>
            </div>
            <!-- modal button----------------------------->
            <div class="col-2">
              <span class="float-right"><i style="color:blue;font-size:2rem;" v-on:click="showModalInfo()"
                  class="fa fa-info-circle"></i>
                </span>
            </div>
          </div>

        </div>

      </div>
    </div>
    <div class="card-body">


      <!-- modal info------------------------------->
      <modal v-if="showInfo" @close="showInfo = false">
        <div slot="body">
          {!! $viewpar['info'] ?? 'Ehhez a feladathoz nincs információ, ha problémája van kérjük hívja az
          ügyfélszolgálatot!' !!}
        </div>
      </modal>
      <!-- modal  zárások-------->
      <modal v-if="showModal" @close="showModal = false">
        <div slot="body">
          @include('mocalendarVue.inc.showstored')
        </div>
      </modal>


      <!--  panel---------------------------------------------------------------------->
      <div class="table-responsive">
        
        <div class="row">
          <div class="col-md-9">
        <!-- calendar ---------------------------------------------------------------->    
            @include('mocalendarVue.inc.calendar_dev')
            <hr>
        <!-- usercard list---------------------------------------------------------------->      
            <div style="margin-left: 1px;"  class="row"> 
              <div v-bind:style=" worker.id==calworkerid ? 'border: 3px solid blue;' : 'border: none;' "
                v-for="worker in workers" class="col-6 col-md-4 usercard" v-on:click="setCalworkerid(worker)">
               <div >
               
                 
                  <img v-if="typeof(worker.foto)  !== 'undefined' && worker.foto != null" v-bind:src="worker.foto"
                  style="margin-right: 5px; width:30%; float:left;">
                  <img v-else src="/images/img_avatar.png" alt="Avatar" style="margin-right: 5px; width:30%; float:left;">
                 
                  
                    <h6 style="padding:5px"><b>@{{worker.workername}}</b></h6>
                    <p>@{{worker.position}}</p>
                  
                    <div style="display: none;">
                      <input v-model="workerids" type="checkbox" name="workerids[]" v-bind:value="worker.id">
                    </div>

 
              </div>
            </div>
          </div>
          <div class="col-md-3">

          </div>

        </div>
      </div>
    </div>
  </div>
</div>

@include('mocalendarVue.inc.modal_template')




@endsection