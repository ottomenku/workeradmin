<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    {!! Form::label('user_id', 'User Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('year') ? 'has-error' : ''}}">
    {!! Form::label('year', 'Year', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('year', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('year', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('mounth') ? 'has-error' : ''}}">
    {!! Form::label('mounth', 'Mounth', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('mounth', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('mounth', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('day') ? 'has-error' : ''}}">
    {!! Form::label('day', 'Day', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('day', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('day', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('hour') ? 'has-error' : ''}}">
    {!! Form::label('hour', 'Hour', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('hour', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('hour', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    {!! Form::label('type', 'Type', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('type', ['work', 'free', 'celeb'], null, ['class' => 'form-control']) !!}
        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
