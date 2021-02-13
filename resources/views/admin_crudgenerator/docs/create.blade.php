@extends('admin_crudgenerator.backend')

@section('content')


    <div class="col-md-9">
        <div class="card">
            <div class="card-header">Dashboard       
            </div>
 @php
 //$ceg=$data->ceg;
 @endphp            
            
                 
            <div class="card-body" >
             <div class="row" style="display: flex;">
            {!! Form::open(['url' => $viewpar["route"].'/store', 'class' => 'form-horizontal']) !!} 
           
            @include('admin_crudgenerator.docs.'.$viewpar["doc_tmpl"].'_form', ['ceg' => $data['ceg']]) 
                    @foreach ($data['workers'] as $worker)
                        <div style=" align-items: stretch; border: 1px solid gray; float:left; margin:5px ;" class="col-md-2 col-sm-4 col-xs-6 usercard">
                        
                            <label  class="checkcontainer">
                                <input  type="checkbox" name="workerids[]" value="{{$worker->id}}">
                                <span class="checkmarkcheckbox2" style="width:100%; border-style: double; font-size:0.8em; height:25px;">  
                                    <span style="color:rgb(255, 255, 255);"> <i class="fa fa-check-square"></i> kijelölve 
                                    </span>
                    
                                </span>
                            </label>
                            
                            <div >   
                            
                            @if (empty($worker->foto))
                                <img  src="/images/img_avatar.png" alt="Avatar" style="width:95%;">
                            @else
                                src="{{$worker->foto}}" style="width:95%;">
                            @endif
                            
                    
                                <div class="usercardcontainer" >
                                    <h5><b>{{$worker->workername}}</b></h5>  
                                    <p>{{$worker->position}}</p>         
                                </div>
                            </div>
                        </div>
                    @endforeach
                         
            </div>
            <div class="row">
            {!! Form::submit( 'Create', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!} 
            </div>
          </div>  
        </div>
     </div>
     <style>
        .table th, .table td {
            padding: 0.25rem;
          }
      
          [class*="col-"],  /* Elements whose class attribute begins with "col-" */
          [class^="col-"] { /* Elements whose class attribute contains the substring "col-" */
            padding-left: 5px;
            padding-right: 0;
          }
        /* card ----------- */
        .card header {
          padding: 10px;
          background-color: rgb(41,73,130);
          color: #fff;
        }
      
        .usercard {
          box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
          transition: 0.3s;
        /*  pointer: 
          width: 20%;
          float:left;
          padding: 5px;*/
        }
        
        .usercard:hover {
          box-shadow: 0 8px 16px 0 rgba(14, 6, 128, 0.8);
        }
        
        .usercardcontainer {
          padding: 2px 16px;
        }   
        <style>       
@endsection
