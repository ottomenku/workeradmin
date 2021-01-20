
@extends($param['crudview'].'.edit')
@section('form')
<h3>{!! $data->worker->user->name !!}</h3>
<h3>{!! $data->datum !!}</h3>
<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    {!! Form::label('daytype_id', 'Naptipus', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
      
          {!! Form::select('daytype_id',$data['daytype'],
           $data->daytype_id, ['class' => 'form-control', 'required' => 'required']) !!}

        {!! $errors->first('daytype_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('managernote') ? 'has-error' : ''}}">
    {!! Form::label('managernote', 'Megjegyzés', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('managernote', $data->managernote, ['class' => 'form-control']) !!}
        {!! $errors->first('managernote', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<input type="hidden" name="worker_id" value="{!! $data->worker_id !!}">
<input type="hidden" name="datum" value="{!! $data->datum !!}">
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Mentés', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

@endsection