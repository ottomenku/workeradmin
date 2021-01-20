




@extends($viewpar['template'].'.'.$viewpar['frame'])

@section('content')
@php
 $tableinclude= $viewpar['tableinclude'] ?? 'includes.table.table_old'; 
@endphp
<div class="col-md-9">
    <div class="card">
        <div class="card-header">{{ $viewpar['taskheader'] ?? $viewpar['app_name'] ?? $viewpar['route'] ?? 'index' }}</div>
        <div class="card-body">
         @if($viewpar['createbutton'] ?? true)   
            <a href="{{ url($viewpar['route'].'/create') }}" dusk="new" class="btn btn-success btn-sm" title="Uj dokumentum kategória">
                <i class="fa fa-plus" aria-hidden="true"></i> Add New
            </a>
        @endif    
        @if($viewpar['searchbox'] ?? false)   
            {!! Form::open(['method' => 'GET', 'url' => url($viewpar['route']), 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                <span class="input-group-append">
                    <button class="btn btn-secondary" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
            {!! Form::close() !!}
            @endif 
            @if($viewpar['tableform'] ?? false)

            @php $formroute= $viewpar['formroute'] ?? $viewpar['route']; @endphp
            {!! Form::open(['method' => 'POST', 'url' => $formroute, 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
            <br/> 
            <button class="btn btn-outline-{{$viewpar['gomb1,']['class'] ?? 'success'}} button-xs" value="{{$viewpar['gomb1']['val'] ?? 'pub'}}" type="submit">{{$viewpar['gomb1']['label'] ?? 'A kijelöltek engedélyezése'}}</button>
            <button class="btn btn-outline-{{$viewpar['gomb2,']['val'] ?? 'danger'}}" value="{{$viewpar['gomb2,']['val'] ?? 'unpub'}}" type="submit">{{$viewpar['gomb2']['label'] ?? 'A kijelöltek tiltása'}}</button>
            <div class="btn btn-outline-{{$viewpar['gomb2,']['val'] ?? 'danger'}}" ><input type="checkbox" id="checkAll" name="checkAll">{{$viewpar['gomb2']['label'] ?? 'összes kijelölése'}}</div>
            @endif
            <br/>
<!-- table --------------------------------------------->            

@include($tableinclude)
<!-- table --------------------------------------------->  

                <div class="pagination-wrapper"> </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@php 
//dump($data);
//dump($data['tabledata'][0]['email']);
@endphp
@endsection































@extends($viewpar['template'].'.'.$viewpar['frame'])

@section('content')
@php

function alterButton($ifparam,$data){
    $a= $data[$ifparam['a']];
    $res=false;
   if($ifparam['b']=='var'){$b= $data[$ifparam['b']];}else {$b= $ifparam['b'];}
   switch($ifparam['operator'])
     {  
        case('=') if($a==$b){$res=true;}  break
        case('<') if($a<$b){$res=true;}  break
        case('>') if($a>$b){$res=true;}  break   
        case('<=') if($a<=$b){$res=true;}  break 
        case('>=') if($a>=$b){$res=true;}  break 
    }
return $res;
}

//type: primary,  secondary, success, danger, warning, info, light, link
//méret: btn-lg,btn-sm  Körvonal: btn-outline-primary stb
$baseAction=[
    'basw'=>[ //minden gombra érvényes
        'classplus'=>'',  // ha plusz osztályt akarunk hozzáadni
        'var'=>'id',  // a mező aminek az értékét használja
        'action'=>'href', 
        'icon'='fa' //lehet üres     //TODO csinálni imaget stb...
        'type'=>'button', // html tag (a, div)
        'label'=>'', //felirat
        ],
    'show'=>[
        'button'=>'info', // a gomb tipusa a classban behelyettesíti
        'task'=>'show', // a kattintásra meghivandó task
        'fa'=>'fa fa-eye',
        'title'=>'show full data',
        //'dusk'=>"show"
        ],
    'edit'=>['class'=>'btn btn-danger btn-sm','task'=>'edit','fa'=>'fa fa-pencil-square-o','title'=>'Szerkesztés'],
    'destroy'=>['class'=>'btn btn-danger btn-sm','task'=>'destroy','fa'=>'fa fa-pencil-square-o','title'=>'Szerkesztés',onclick="return confirm('Biztos hogy törölni akarja?')" ],
    'pub'=>['class'=>'btn btn-secondary btn-sm','task'=>'pub','fa'=>'fa fa-check-circle','title'=>'Engedélyezés'],
    'unpub'=>['class'=>'btn btn-success btn-sm','task'=>'unpub','fa'=>'fa fa fa-circle','title'=>'Tiltás'],
    'close'=>['class'=>'btn btn-light btn-sm','task'=>'close','fa'=>'fa fa-unlock-alt','title'=>'Lezárás'],
    'unclose'=>['class'=>'btn btn-light btn-sm','task'=>'unclose','fa'=>'fa fa-lock','title'=>'Feloldás'],
];

$action=[];



    
@endphp


<div class="col-md-9">
    <div class="card">
        <div class="card-header">{{ $viewpar['taskheader'] ?? $viewpar['app_name'] ?? $viewpar['route'] ?? 'index' }}</div>
        <div class="card-body">
            <a href="{{ url($viewpar['route'].'/create') }}" dusk="new" class="btn btn-success btn-sm" title="Uj dokumentum kategória">
                <i class="fa fa-plus" aria-hidden="true"></i> Add New
            </a>
<!--kereső mező -->
            {!! Form::open(['method' => 'GET', 'url' => url($viewpar['route']), 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                <span class="input-group-append">
                    <button class="btn btn-secondary" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>         
            {!! Form::close() !!}
<!-- form nyitás ha kell -->              
            @if($viewpar['tableform'] ?? false)
            @php $formroute= $viewpar['formroute'] ?? $viewpar['route']; @endphp
            {!! Form::open(['method' => 'POST', 'url' => $formroute, 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
            <br/> 
<!-- akció gombok kijelöltekhez -->             
            <button class="btn btn-outline-{{$viewpar['gomb1,']['class'] ?? 'success'}} button-xs" value="{{$viewpar['gomb1']['val'] ?? 'pub'}}" type="submit">{{$viewpar['gomb1']['label'] ?? 'A kijelöltek engedélyezése'}}</button>
            <button class="btn btn-outline-{{$viewpar['gomb2,']['val'] ?? 'danger'}}" value="{{$viewpar['gomb2,']['val'] ?? 'unpub'}}" type="submit">{{$viewpar['gomb2']['label'] ?? 'A kijelöltek tiltása'}}</button>
            <div class="btn btn-outline-{{$viewpar['gomb2,']['val'] ?? 'danger'}}" ><input type="checkbox" id="checkAll" name="checkAll">{{$viewpar['gomb2']['label'] ?? 'összes kijelölése'}}</div>
            @endif
            <br/>
<!-- táblázat -->                
            <div class="table-responsive">
                <table class="table table-borderless">
    <!-- fejléc -->                        
                    <thead>
                        <tr>
                            @foreach($viewpar['table'] as $key=> $val)
                 
                            <th>     
                                @if(isset($viewpar['table_action']['check']))  
                                <!-- oszzes kijelölése ha kell-->   
                                <input class="checkbox" type="checkbox" name="all" value="true">
                                @endif 
                             </th>
                           
                            <th>
                                {{$val[0] ?? $key }}
                            //TODO rendező nyilak elkészítése
                            </th>
                            @endforeach
                            @if(!empty($viewpar['table_action'])) 
                            <!-- actioms  ha kell-->  
                            <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
     <!-- sorok -->                 
                    <tbody>
                    @foreach($data['tabledata'] ?? [] as $item)
                        <tr>
                        @foreach($viewpar['table'] as $key=>$val)
                            @php 
                            
                            if(isset($val[1])){
                            //TODO  az evalnál elegánsabb megoldást találni
                            eval('$value='.$val[1].';');  
                            }
                        else{$value=$item->$key;}
                            @endphp
                        <tr>     
                            @if(isset($viewpar['table_action']['check']))  
                            <input class="checkbox" type="checkbox" name="id[]" value="{{$item->id}}">
                            @endif 
                         </tr>    
                        <th> {{ $value }}  </th>
                        @endforeach
                        @foreach($viewpar['table_action'] as $key=>$val)



                        @endforeach
                        @if(!empty($viewpar['table_action']))        
                            <td>

                          
                        @if(isset($viewpar['table_action']['show']))  
                              <a href="{{ url($viewpar['route']).'/show/'. $item->id }}" title="View Category"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                        @endif
                        @if(isset($viewpar['table_action']['edit']))       
                              <a href="{{ url($viewpar['route']).'/edit/'. $item->id  }}" dusk="edit{{ $item->id }}" title="Edit Category"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                        @endif
                        @if(isset($viewpar['table_action']['destroy']))        
                        <a href="{{ url($viewpar['route']).'/destroy/'. $item->id  }}" dusk="destroy{{ $item->id }}"  onclick="return confirm('Biztos hogy törölni akarja?')" title="Edit Category"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>      
                        @endif 
                        @if(isset($viewpar['table_action']['destroy']))        
                        <a href="{{ url($viewpar['route']).'/destroy/'. $item->id  }}" dusk="destroy{{ $item->id }}"  onclick="return confirm('Biztos hogy törölni akarja?')" title="Edit Category"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>      
                        @endif  
                        
                            </td>
                    @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper"> </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@php 
//dump($data);
//dump($data['tabledata'][0]['email']);
@endphp
@endsection
