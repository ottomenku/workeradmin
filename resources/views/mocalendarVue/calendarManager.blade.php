@extends($viewpar['template'].'.backendVue')

@section('content')


<div class="col-md-9">
  
    <div class="card-header">
      <div class="row">
        <div class="col-md-7">
          @include('mocalendarVue.inc.actions_manager',['refreshTask' => "freshdata"])
        </div>
        <div class="col-md-5">
          <div class="row">
            <div class="col-10">
              <h3  v-if="typeof(workers[actWorkerid]) !== 'undefined'" > @{{workers[actWorkerid].workername}}</h3>
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
      <div class=" card">

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
      <div class="row">     
          <div class="col-md-9">
            <div class="table-responsive">    
        <!-- calendar ---------------------------------------------------------------->    
            @include('mocalendarVue.inc.calendar_dev')
            <hr>
        <!-- usercard list---------------------------------------------------------------->      
            <div style="margin: 0px;padding: 0px; "  class="row"> 
              <div style="margin: 0px;padding: 0px; "  v-bind:style=" worker.id==actWorkerid ? 'border: 3px solid blue;' : 'border: none;'  "
                v-for="worker in workers" class="col-6 col-md-4 usercard" v-on:click="setActWorkerid(worker)">
               <div>
                  <img  v-bind:src="worker.foto" alt="foto" style="margin-right: 5px; width:30%; float:left;">
            
                    <h6 style="padding:5px"><b>@{{worker.workername}}</b></h6>
                    <p style="margin: 0px;padding: 0px;" >@{{worker.position}}</p>
                  
                    <div style="display: none;">
                      <input v-model="workerids" type="checkbox" name="workerids[]" v-bind:value="worker.id">
                    </div>

              </div>
            </div>
          </div>
        </div>
          <div class="col-md-3">
            <div style="" 
            v-for="(item, datum) in SumData" class="col-6 col-md-4 usercard" >
              @{{datum}}  kkkk
            </div>
           <div >
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@include('mocalendarVue.inc.modal_template')




@endsection