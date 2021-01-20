@extends($param['crudview'].'.create')
@section('form')
@if($data['worker_id']<1)
@foreach($data['workers'] as $unit)
<a href=" {!! MoHandF::url($param['routes']['base'].'/create',$param['getT'],['worker_id'=>$unit['id']]) !!}" 
    title="dolgozó választás"
@if ($param['getT']['worker_id']==$unit['id'])    
class="btn btn-danger btn-xs">
@else
class="btn btn-warning btn-xs">
@endif
        {!!    $unit['user']['name'] !!}
    
    </a>
@endforeach  
@else
 {!! Form::hidden('worker_id ', $data['worker_id']) !!}

 <div class="form-group {{ $errors->has('wroleunit_id') ? 'has-error' : ''}}">
    {!! Form::label('wroleunit_id', 'Munkarend', ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7">
             {!! Form::select('wroleunit_id',$data['wrunit'],
             $data->wrole_id, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('wroleunit_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group {{ $errors->has('datum') ? 'has-error' : ''}}">
    {!! Form::label('datum', 'Dátum', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('datum', null, ['class' => 'form-control datepicker']) !!}
        {!! $errors->first('datum', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('note') ? 'has-error' : ''}}">
    {!! Form::label('note', 'Jegyzet', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('note', null, ['class' => 'form-control ']) !!}
        {!! $errors->first('note', '<p class="help-block">:message</p>') !!}
    </div>
</div>

        {!! Form::hidden('pub',1) !!}

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
@endif
@endsection
