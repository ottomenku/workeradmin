<div class="form-group {{ $errors->has('workerday_id') ? 'has-error' : ''}}">
    {!! Form::label('workerday_id', 'Workerday Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('workerday_id', null, ['class' => 'form-control']) !!}
        {!! $errors->first('workerday_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('daytype_id') ? 'has-error' : ''}}">
    {!! Form::label('daytype_id', 'Daytype Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('daytype_id', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('daytype_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('managernote') ? 'has-error' : ''}}">
    {!! Form::label('managernote', 'Managernote', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('managernote', null, ['class' => 'form-control']) !!}
        {!! $errors->first('managernote', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('workernote') ? 'has-error' : ''}}">
    {!! Form::label('workernote', 'Workernote', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('workernote', null, ['class' => 'form-control']) !!}
        {!! $errors->first('workernote', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('pub') ? 'has-error' : ''}}">
    {!! Form::label('pub', 'Pub', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('pub', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('pub', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
