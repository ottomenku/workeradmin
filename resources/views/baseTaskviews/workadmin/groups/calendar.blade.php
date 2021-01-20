@php
$getT=[];
$checkbutton_select_class=$param['calendar']['checkbutton_select_class'] ?? ['Munkanapok'=>'workerdayclass'];//['gombfelirat'=>'check_class']
$checkbox_name=$param['calendar']['checkbox_name'] ?? 'datum';
@endphp
{!! Form::open(['url' => MoHandF::url($param['routes']['base'].'/calendarsave/'. $data['group_id'],$getT), 
'class' => 'form-horizontal', 'files' => true]) !!}
<div class="row"> 
        <div class="col-md-6"  >  <span>Nap típus,munkarend változtatás </span> 
            <div class="row" style=" border: 1px solid lightslategray; padding:5px 5px 25px 5px;"> 
                <div class="col-md-6">  <span>Nap típus </span> 
                    {!! Form::select('daytype_id', $data['daytype'], 0, ['class' => 'form-control input-sm']) !!}       
                    {!! $errors->first('daytype_id', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="col-md-6">  <span>Munkarend</span> 
                    {!! Form::select('wrole_id', $data['wrole'], 0, ['class' => 'form-control input-sm']) !!}       
                    {!! $errors->first('wrole_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div> 
           
            </div>


        <div class="col-md-6" >  <span>Munkaidő felvitel</span>  
        <div  style=" border: 1px solid lightslategray; padding:5px 5px 25px 5px;"> 
            <div class="row"> 
                <div class="col-xs-6"><span>Kezdés</span>
                    {!! Form::input('time','start', null, ['class' => 'form-control input-sm']) !!}
                    {!! $errors->first('start', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="col-md-6"><span>Befejezés</span>
                    {!! Form::input('time','end', null, ['class' => 'form-control input-sm']) !!}
                    {!! $errors->first('end', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="row"> 
                    <div class="col-md-6">  <span>Idő típus </span>  
                        {!! Form::select('timetype_id', $data['timetype'], null, ['class' => 'form-control input-sm', 'required' => 'required']) !!}       
                        {!! $errors->first('timetype_id', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="col-md-6"><span>Megjegyzés</span>
                        {!! Form::text('note2', null, ['class' => 'form-control input-sm']) !!}
                        {!! $errors->first('note2', '<p class="help-block">:message</p>') !!}
                    </div>       
            </div>
            </div>
        </div>
</div>        
<div class="row"> 
    <div class="col-md-12"><div> -</div>
                <a href="{{ url('/'.$param['routes']['base'],$param['getT']) }}"  class="btn btn-warning btn-sm">Mégsem</a>
                {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Küldés', ['class' => 'btn-sm btn-primary','name' => 'change']) !!}
                {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Törlés', ['class' => 'btn-sm btn-danger','name' => 'del']) !!}
                <span>Idők</span>
                    {{ Form::checkbox('timetask', 'time',true) }} 
                <span>Naptípusok</span>        
                    {{ Form::checkbox('daytask', 'day',true) }} 
                <span>Munkarendek</span>        
                    {{ Form::checkbox('wroletask', 'wrole',true) }}    
                
                        <script>
                                function inversecheck(){
                                  
                                   $("input[name={{ $checkbox_name }}\\[\\]]").each(function(){
                                       $(this).prop('checked', !$(this).prop('checked'));
                                    }); 
                                 }
                                 function allcheck(){
                                   var checkBoxes = $("input[name={{ $checkbox_name }}\\[\\]]");
                                //   var checkBoxes = $("input[name=datum\\[\\]]");
                                   checkBoxes.prop("checked", true);  
                                 }
                                 function nocheck(){
                                   var checkBoxes = $("input[name={{ $checkbox_name }}\\[\\]]");
                                   checkBoxes.prop("checked", false);  
                                 }
                                 function classcheck(cl){
                                   $("."+cl).each(function(){
                                       $(this).prop('checked', true);
                                    }); 
                                 }
                           </script>        
        {!! Form::button( 'Mind', ['class' => 'btn input-sm','onclick' => 'allcheck()']) !!}
        {!! Form::button( 'Egyiksem', ['class' => 'btn  input-sm','onclick' => 'nocheck()']) !!}
        {!! Form::button('Inverse', ['class' => 'btn input-sm','onclick' => 'inversecheck()']) !!}

        @foreach($checkbutton_select_class as $key=>$val) 
        {!! Form::button( $key, ['class' => 'btn input-sm','onclick' => 'classcheck(\''.$val.'\')']) !!}
        @endforeach 
    </div>
</div>


@include('calendar.calendar')

{!! Form::close() !!}
  