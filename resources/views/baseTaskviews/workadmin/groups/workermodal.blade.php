@php

$getT=$param['getT'];
//$addroute=str_replace("_","/",$getT['addroute']);
//echo '--------------mmmmmm';
//print_r($data);

@endphp

<style>

        .flex-container {
            padding: 0;
            margin: 0;
            list-style: none;
            justify-content:flex-end;
            -ms-box-orient: horizontal;
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -moz-flex;
            display: -webkit-flex;
            display: flex;
          }
          .nowrap  { 
            -webkit-flex-wrap: nowrap;
            flex-wrap: nowrap;
          }
        
          .flex-item { 
            background: white;
            padding: 5px;
             /* width: 13.7%;
          height: 100px;*/
            margin: 0.3%;
            text-align: center;
            overflow:hidden;
          }
 
        </style>
{!! Form::open(['url' => MoHandF::url($param['routes']['base'].'/show2/'.$getT['group_id'] ),
'class' => 'form-horizontal', 'files' => true]) !!}

<input type="hidden"  name="edittask" value="addworker" > 

<button type="submit" class=" btn-success btn btn-large">

<i class="fa fa-plus" aria-hidden="true"> Kijelöltek hozzáadása</i> 
</button>

<ul class="flex-container nowrap" style="justify-content:flex-start;margin: 2%;"> 

    @foreach($data  as $item)
        <div style="border: 1px solid grey; border-radius: 3px;margin: 0.5%;">   
            <li class="flex-item" >
            <div style="height:60px;width:60px;">  
                @if(isset($item->foto))
                 <img src="/{{ $item->foto }}" alt="foto" height="50px" width="50px"> 
                @else
                <i class="fa fa-user fa-3x"  aria-hidden="true"></i>
                @endif
            </div>   
                                {{ $item['user']['name'] }}
<br/>
               
                                    <input type="checkbox"  name="worker_id[]" value="{{ $item['id'] }}" >        
            </li>                        
        </div>
    @endforeach    

</ul>       
          

