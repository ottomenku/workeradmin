

     <span>Munkaidő felvitel</span>  
     <div  style=" border: 1px solid lightslategray; padding:5px 5px 25px 5px;"> 
         <div class="row"> 

             <div class="col-xs-2"><span>Kezdés</span>
                 {!! Form::input('time','start', null, ['class' => 'form-control input-sm']) !!}
                 {!! $errors->first('start', '<p class="help-block">:message</p>') !!}
             </div>
             <div class="col-xs-2"><span>Befejezés</span>
                 {!! Form::input('time','end', null, ['class' => 'form-control input-sm']) !!}
                 {!! $errors->first('end', '<p class="help-block">:message</p>') !!}
             </div>
             <div class="col-xs-1"><span>Óra</span>
                {!! Form::input('text','hour', null, ['class' => 'form-control input-sm']) !!}
                {!! $errors->first('hour', '<p class="help-block">:message</p>') !!}
            </div>
             <div class="col-xs-2">  <span>Idő típus </span>  
                {!! Form::select('timetype_id', $data['timetype'], null, ['class' => 'form-control input-sm', 'required' => 'required']) !!}       
                {!! $errors->first('timetype_id', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="col-xs-2"><span>Megjegyzés</span>
                {!! Form::input('text','timenote', null, ['class' => 'form-control input-sm']) !!}
                {!! $errors->first('timenote', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="col-xs-1"><span>-</span>
          {!! Form::submit( 'Idő hozzáadás', ['class' => 'btn-sm btn-primary','name' => 'addtime']) !!}
    
            </div>
                        
         </div>
         </div>


         <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>ID</th><th>Kezdés</th><th>befejezés</th><th>Óra</th><th>Időtipus</th><th>Megjegyzés</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>      
                        @foreach($data->wroletime as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    {{ $item->start }}<td>{{ $item->end }}</td>
                                </td> <td>{{ $item->hour }}</td><td>{{ $item->timetype->name }}</td><td>{{ $item->note }}</td>
                                <td>
               
                                    <a href="{!!  MoHandF::url($param['routes']['base'].'/deltime/'.$item->id.'/'.$data['id'],$param['getT']) !!} "
                                            class="btn btn-danger btn-xs" title="edit">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i> 
                                     </a> 
                                </td>
                            </tr>
                        @endforeach
                    
                    </tbody>
                </table>
               </div>

<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Munkarend Neve', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', $data->name, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('note') ? 'has-error' : ''}}">
    {!! Form::label('note', 'Megjegyzés', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('note', $data->note, ['class' => 'form-control']) !!}
        {!! $errors->first('note', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>


