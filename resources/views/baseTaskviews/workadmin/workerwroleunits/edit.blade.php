@extends($param['crudview'].'.edit')
@section('form')

<div class="form-group {{ $errors->has('wroleunit_id') ? 'has-error' : ''}}">
        {!! Form::label('wroleunit_id', 'Munkarend', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-7">
                 {!! Form::select('wroleunit_id',$data['wrunit'],
                 $data->wrole_id, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('wroleunit_id', '<p class="help-block">:message</p>') !!}
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
