

<div class="row"> 
    <!-- baloldali vezérlés -->   
           <div class="col-md-6"  > 
          
               <div class="row"> 
                   <div class="col-md-12">
                   <a href="{{ url('/'.$param['routes']['base'],$param['getT']) }}"  class="btn btn-warning btn-sm">Mégsem</a>
                   <button type="submit" name="change" value="del"  class=" btn-sm btn-danger">
                           <i class="fa fa-trash-o" aria-hidden="true"> Módosítások törlése</i> 
                   </button>
                   <span>Idők</span>
                       {{ Form::checkbox('timetask', 'time',true) }} 
                   <span>Naptípusok</span>        
                       {{ Form::checkbox('daytask', 'day',true) }} 
                   </div>
               </div>
               <div style="padding-top:15px;" class="row"> 
                    <div class="col-md-12" > 
                   @include('calendar.ev_ho')
                   </div>
               </div>
               <div style="padding-bottom:15px;" class="row"> 
                   <div class="col-md-12" > 
                   @include('calendar.checkbutton')
                   </div>
               </div>
           </div>
   <!-- tabform menü -->         
       <div class="col-md-6"  >
           <ul class="nav nav-tabs">
               <li class="active"><a data-toggle="tab" href="#sectionA">Nap típus,munkarend </a></li>
               <li><a data-toggle="tab" href="#sectionB">Munkaidő felvitel</a></li>
             
           </ul>
           <div class="tab-content">
               <div id="sectionA" class="tab-pane fade in active">
                   <div class="row" > 
                       <div class="col-md-6">  <span>Nap típus </span> 
                           {!! Form::select('daytype_id', $data['daytype'], 0, ['class' => 'form-control input-sm']) !!}       
                           {!! $errors->first('daytype_id', '<p class="help-block">:message</p>') !!}
                       </div>
                       <div class="col-md-6">  <span>Munkarend</span> 
                           {!! Form::select('wrole_id', $data['wrole'], 0, ['class' => 'form-control input-sm']) !!}       
                           {!! $errors->first('wrole_id', '<p class="help-block">:message</p>') !!}
                       </div>
                   </div> 
                   <div class="row" >    
                       <div style="padding-top:15px;padding-bottom:15px;" class="col-md-6"> 
                           <button type="submit" name="change" value="day_wrole"  class=" btn-primary btn btn-large">
                               <i class="fa fa-save" aria-hidden="true">  Nap,munkarend mentés</i> 
                           </button>
                       </div>   
                   </div> 
               
               </div>  
               <div id="sectionB" class="tab-pane fade">
                  
                       <div class="row"> 
                           <div class="col-md-6"><span>Kezdés</span>
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
                                   {!! Form::text('workernote2', null, ['class' => 'form-control input-sm']) !!}
                                   {!! $errors->first('workernote2', '<p class="help-block">:message</p>') !!}
                               </div>       
                       </div>
   
                           <div class="row"> 
                                <div style="padding-top:15px;padding-bottom:15px;" class="col-md-6"> 
                                    <button type="submit" name="change" value="time"  class=" btn-primary btn btn-large">
                                           <i class="fa fa-save" aria-hidden="true">  Munkaidő feltöltés</i> 
                                   </button>
   
                               </div>
                           </div>
                   </div>
           </div>
       </div>    
   </div>
   
   
@include('calendar.calendar')


  