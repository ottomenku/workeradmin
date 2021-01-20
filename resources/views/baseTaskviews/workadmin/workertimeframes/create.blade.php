@extends($param['crudview'].'.create')
@section('form')
@if($param['getT']['worker_id']<1)
@foreach($data['workers'] as $unit)
<a href=" {!! MoHandF::url($param['routes']['base'],$param['getT'],['worker_id'=>$unit['id']]) !!}" 
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
 {!! Form::hidden('worker_id ', $param['getT']['worker_id']) !!}

<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('start') ? 'has-error' : ''}}">
    {!! Form::label('start', 'Start', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('start', null, ['class' => 'form-control datepicker']) !!}
        {!! $errors->first('start', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('end') ? 'has-error' : ''}}">
    {!! Form::label('end', 'Vége', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('end', null, ['class' => 'form-control datepicker']) !!}
        {!! $errors->first('end', '<p class="help-block">:message</p>') !!}
    </div>
</div>

        {!! Form::hidden('pub', 0) !!}

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
@endif
@endsection
