@php  
    $times=$data['times'] ?? [];
    $timetypes=$data['timetypes'] ?? [];
@endphp 

<ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link " data-toggle="tab" href="#times">Idők</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " data-toggle="tab" href="#days">Napok ( szabadság betegállomány  stb.)</a>
        </li>
</ul>


<!-- Tab panes -->
<div class="tab-content" >   
    <div id="times" class="container tab-pane active"><br>

  <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Start</th><th>End</th><th>Óraszám</th><th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($times as $item)
                            <tr>
                                <td>{{  $item->start }}</td>
                                <td>{{ $item->end }}</td><td>{{ $item->hour }}</td>
                                <td>
                                    <a href="{{ url('/admin/category/' . $item->id . '/edit') }}" dusk="edit{{ $item->id }}" title="Edit Category"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>       
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>    
        </div>

        <hr>
                {!! Form::model($data,[
                   'method' => 'POST',
                'url' => ['/m/ad.wor.time/store'],
                'class' => 'form-horizontal',
                'files' => true  
                ]    
               ) !!}

                <div class="form-group {{ $errors->has('timetype_id') ? 'has-error' : ''}}">
                  
                </div>
                    {!! Form::hidden('datum', $data['datum'] ?? '') !!}
                    <div class="row">
                    <div class="col-4">            
                            {!! Form::label('timetype_id', 'Időtipus', ['class' => 'col-4 control-label']) !!}         
                            {!! Form::select('timetype_id', $data['timetype_id_list'], null, ['class' => 'form-control']) !!}   
                            {!! $errors->first('timetype_id', '<p class="help-block">:message</p>') !!}   
                    </div>    
                        <div class="col-8">
                            {!! Form::label('time_workernote', 'Megjegyzés', ['class' => 'col-8 control-label']) !!}
                            {!! Form::text('time_workernote', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('time_workernote', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                      
                    <div class="form-group {{ $errors->has('start') ? 'has-error' : ''}}">
                    <div class="row">
                        <div class="col-3">    
                            {!! Form::label('start', 'Start', ['class' => 'col-3 control-label']) !!}         
                            {!! Form::input('time', 'start', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('start', '<p class="help-block">:message</p>') !!}
                        </div>
                        <div class="col-3"> 
                            {!! Form::label('end', 'End', ['class' => 'col-3 control-label']) !!}             
                            {!! Form::input('time', 'end', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('end', '<p class="help-block">:message</p>') !!}
                        </div>
                        <div class="col-3">
                            {!! Form::label('hour', 'Óraszám', ['class' => 'col-3 control-label']) !!} 
                            {!! Form::number('hour', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('hour', '<p class="help-block">:message</p>') !!}
                        </div>
                        <div class="col-3">
                                {!! Form::label('submit', '-', ['class' => 'col-3 control-label']) !!} 
                            {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Mentés', ['class' => 'btn btn-primary']) !!}
                        </div>

                    </div>
                    </div>              
                </form>
                <hr>
    </div>

    <div id="days" class="container tab-pane fade"><br> 
        {!! Form::model($data, [
            'method' => 'POST',
            'url' => ['/m/ad.wor.time/daystore'],
            'class' => 'form-horizontal',
            'files' => true
        ]) !!}
        {!! Form::hidden('datum', $data['datum'] ?? '') !!}
        <div class="row">
                    <div class="col-4">            
                            {!! Form::label('daytype_id', 'Naptipus', ['class' => 'col-4 control-label']) !!}         
                            {!! Form::select('daytype_id', $data['daytype_id_list'], null, ['class' => 'form-control', 'required' => 'required']) !!}   
                            {!! $errors->first('daytype_id', '<p class="help-block">:message</p>') !!}   
                    </div>  
                    <div class="col-8">
                            {!! Form::label('workernote', 'Megjegyzés', ['class' => 'col-8 control-label']) !!}
                            {!! Form::text('workernote', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('workernote', '<p class="help-block">:message</p>') !!}
                        </div>
                        <div class="col-3">
                            {!! Form::label('submit', '-', ['class' => 'col-3 control-label']) !!} 
                        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Mentés', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
        <hr>
    </form>
    </div>
</div>         
             
  