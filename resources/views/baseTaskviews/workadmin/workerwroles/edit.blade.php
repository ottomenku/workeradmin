@extends($param['crudview'].'.edit')
@section('form')

<div class="form-group {{ $errors->has('wrole_id') ? 'has-error' : ''}}">
        {!! Form::label('wrole_id', 'Munkarend', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-7">
                 {!! Form::select('wrole_id',$data['wrole'],
                 $data->wrole_id, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('wrole_id', '<p class="help-block">:message</p>') !!}
        </div>
 </div>

<div class="form-group {{ $errors->has('start') ? 'has-error' : ''}}">
    {!! Form::label('start', 'Kezdés időpontja', ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-7">
        {!! Form::text('start', $data->start, ['class' => 'form-control datepicker']) !!}
        {!! $errors->first('start', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('end') ? 'has-error' : ''}}">
        {!! Form::label('end', 'Vége', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-7">
            {!! Form::text('end', $data->end, ['class' => 'form-control datepicker']) !!}
            {!! $errors->first('end', '<p class="help-block">:message</p>') !!}
        </div>
</div>
<div class="form-group {{ $errors->has('note') ? 'has-error' : ''}}">
        {!! Form::label('note', 'Megjegyzés', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-7">
            {!! Form::text('note',  $data->note, ['class' => 'form-control']) !!}
            {!! $errors->first('note', '<p class="help-block">:message</p>') !!}
        </div>
</div>



<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Mentés', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

@endsection
