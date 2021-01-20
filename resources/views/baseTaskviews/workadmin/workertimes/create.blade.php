@extends($param['crudview'].'.create')
@section('form')

@if(isset($data['worker_id']))
 {!! Form::hidden('worker_id', $data['worker_id']) !!}
 @else
 <div class="form-group {{ $errors->has('worker_id') ? 'has-error' : ''}}">
    {!! Form::label('worker_id', 'Doldozó választás', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
      
        {!! Form::select('worker_id', $data['workers'], null, ['class' => 'form-control', 'required' => 'required']) !!}
        
         {!! $errors->first('worker_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@endif
<div class="form-group {{ $errors->has('timetype_id') ? 'has-error' : ''}}">
    {!! Form::label('timetype_id', 'Timetype Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
      
        {!! Form::select('timetype_id', $data['timetype'], null, ['class' => 'form-control', 'required' => 'required']) !!}
        
         {!! $errors->first('timetype_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@if(isset($data['datum']))
{!! Form::hidden('datum', $data['datum']) !!}
@else
<div class="form-group {{ $errors->has('datum') ? 'has-error' : ''}}">
    {!! Form::label('datum', 'Dátum', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::input('text', 'datum', null, ['class' => 'form-control datepicker', 'required' => 'required']) !!}
        {!! $errors->first('datum', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@endif
<div class="form-group {{ $errors->has('start') ? 'has-error' : ''}}">
    {!! Form::label('start', 'Start', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::input('time', 'start', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('start', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('end') ? 'has-error' : ''}}">
    {!! Form::label('end', 'End', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::input('time', 'end', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('end', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('hour') ? 'has-error' : ''}}">
    {!! Form::label('hour', 'Hour', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('hour', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('hour', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

@endsection