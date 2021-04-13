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
          <div class="col-md-8">
            <div class="table-responsive">    
        <!-- calendar ---------------------------------------------------------------->    
            @include('mocalendarVue.inc.calendar_dev')
            <hr>

        </div>
      </div>
          <div class="col-md-4">
            <span style="font-size: 1.3em; font-weight:bold; ">Összesítés:</span>
            <div   v-for="(item, key) in SumData" >
              @{{key}} : @{{item}}
            </div>
            <span style="font-size: 1.3em; font-weight:bold; ">Napok:</span>
            <div   v-for="(item, key) in SumDays" >
              @{{key}} : @{{item}}
            </div>
            <span style="font-size: 1.3em; font-weight:bold; ">Órák:</span>
            <div   v-for="(item, key) in SumTimes" >
              @{{key}} : @{{item}}
            </div>
        </div>
      
    </div>
  </div>
</div>
@include('mocalendarVue.inc.modal_template')




@endsection