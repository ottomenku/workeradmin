<div class="col-md-3">

  <div class="card">
    <div class="card-header">
      <a class="nav-link" href="#"><< Nyitólap </a>
      
    </div>
  </div> </br> 
    <ul class="nav nav-tabs" id="myTab" role="tablist">

      <li class="nav-item waves-effect waves-light">
            <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
              aria-controls="contact" aria-selected="true">Napok</a>
      </li>
      <li class="nav-item waves-effect waves-light">
            <a class="nav-link " id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
              aria-selected="false">Munkaidők</a>
      </li>

    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade active show" id="contact" role="tabpanel" aria-labelledby="contact-tab">
              <!-- napok form   https://fontawesome.com/v4.7.0/icons/ --------------------------------->
        <div class="row">
              <label for="daytype_id" class="col-3 control-label">Naptipus</label>

        </div>
        <div class="row">
                @php
                $checked="";
                @endphp
                @foreach ($data['daytypes'] as $daytype)
            <div class="col-11">
                  @php
                  $color=$daytype['color'] ?? 'gray';
                  $bgcolor='';
                  $hourcolor=$daytype['timetype']['color'] ?? 'gray';
                  $hourbgcolor='';
                  if(isset($daytype['background'])) {$bgcolor= ' background-color:'.$daytype['background'].';';}
                  if(isset($daytype['timetype']['background'])) {$hourbgcolor= '
                  background-color:'.$daytype['timetype']['background'].';';}
                  @endphp
                  <input type="radio" name="daytype_id" value="{{$daytype['id']}}" {{$checked}}>
                  <span>
                    <i style="font-size:1.2em; color:{{$color}}; {{$bgcolor}} " class="fa fa-{{$daytype['icon'] ?? ''}}"
                      aria-hidden="true"></i>
                    {{$daytype['name'] ?? ''}},
                    <span
                      style="font-size:1.2em; color:{{$hourcolor}}; {{$hourbgcolor}}">{{$daytype['timetype']['basehour'] ?? '0'}}
                      óra
                    </span>
                    </label>
            </div>
   
                @endforeach
          
            <div class="row">
                  <label for="daytype_id" class="col-3 control-label">megjegyzés</label>

            </div>
            <div class="row">
                <div class="col-11">
                    <input class="form-control" name="adnote" type="text" id="workernote">
                </div>
            
                <button class=" btn btn-primary" v-on:click="storedays()" style="margin:2px;">
                  <i class="fa fa-save"></i>
                </button>
                <button class=" btn btn-danger" v-on:click="daysreset()" style="margin:2px;">
                  <i class="fa fa-trash"></i>
                </button>
                <a href="m/ad.man.timetype/create" class=" btn btn-succes" style="margin:2px;">
                  <i class="fa fa-plus">Új naptipus</i>
                </a>
                <!--  napok form  end --------------------------------->
            </div>
          </div>
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

            <div class="row">


              <div style=" padding-left: 5px; padding-right: 0;" class="col-8">
                  <label for="hour" class="col-11 control-label">Óra </label>

                  <input class="form-control" name="hour" type="number" id="hour"
                    value="{{array_values($data['timetypes'])[0]['basehour']}}">

              </div>
              <div class="col-3">
                  <label for="hour" class="col-11 control-label">- </label>
                  <button class="btn btn-primary" data-toggle="collapse" data-target="#collapseExample">
                    +
                  </button>
              </div>
              <div class="collapse" id="collapseExample">

                  <div class="row">
                    <div class="col-11">
                      <label for="start" class="col-11 control-label">Kezdés </label>
                      <input class="form-control" name="start" type="time" id="start"
                        value="{{array_values($data['timetypes'])[0]['start']}}">
                    </div>
                    <div class="col-11">
                      <label for="end" class="col-11 control-label">Befejezés </label>
                      <input class="form-control" name="end" type="time" id="end"
                        value="{{array_values($data['timetypes'])[0]['end']}}">
                    </div>
                    <div class="col-11">
                      <label for="end" class="col-11 control-label">Megjegyzés </label>
                      <input class="form-control" name="adnote" type="text" id="workernote">
                    </div>
                  </div>
                </div>
                <div style=" padding-left: 5px; padding-right: 20;" class="col-11">

                  @foreach ($data['timetypes'] as $key=>$timetype)
                  <div class="col-11">
                    @php
                    $checked='';
                    if($timetype['id']== array_values($data['timetypes'])[0]['id'])
                    {$checked=' checked ';}
                    $color=$timetype['color'] ?? 'gray';
                    $bgcolor='';
                    if(isset($timetype['background'])) {$bgcolor= ' background-color:'.$timetype['background'].';';}
                    @endphp



                    <span
                      onclick="hourToInput('{{$timetype['basehour']}}','{{$timetype['start']}}','{{$timetype['end']}}')"
                      style="font-size:1.3em; color:{{$color}}; {{$bgcolor}}">
                      <input type="radio" name="timetype_id" value="{{$timetype['id']}}" {{$checked}}>
                      {{$timetype['name'] }}, {{$timetype['basehour'] ?? '0'}} óra

                    </span>
                  </div>
                  @endforeach

                </div>
                <button class=" btn btn-primary" v-on:click="storetimes()" style="margin:2px;">
                  <i class="fa fa-save"></i>
                </button>
                <button class=" btn btn-danger" v-on:click="timesreset()" style="margin:2px;">
                  <i class="fa fa-trash"></i>
                </button>
                <a href="m/ad.man.timetype/create" class=" btn btn-succes" style="margin:2px;">
                  <i class="fa fa-plus">Új időtipus</i>
                </a>
              </div>

            </div>

          </div>
  </div>       