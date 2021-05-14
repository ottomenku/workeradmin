@extends($viewpar['template'].'.'.$viewpar['frame'])
@php
 /*if(isset($data['formdata'])){
     $formdata=$data['formdata'];
   $data=$formdata;
   print_r($data);
    }*/
$base_par=[
'labelpar'=>['class' => 'col-md-4 control-label'],
'inputpar'=>['class' => 'form-control'], 
'formcreatepar'=>[ 'class' => 'form-horizontal', 'files' => true], //url a parméterben kell megadni vagy generál aroutból
'formeditpar'=>[ 'method' => 'PATCH','class' => 'form-horizontal', 'files' => true], 
'submit_class'=>'btn btn-primary', 
]; // helyi alap változók, a controllerel átadott $viewpar felülírja

 //be kell írni a composr.json-ba  "autoload": { "files": ["packages/ottomenku/laravel-mocontroller/src/helper.php" ]
// vagylétre kell hzni a \vendor\laravel\framework\src\Illuminate\Foundation\helpers.php-ban
$conf=setconf($base_par,$viewpar,'tpar'); //be kell másolni és mergelni a paramétereket a confba hogy a config()-al lehessen elérni, és ne kelljen vele foglalkozni hogy van e olyan kulc illetve könnyú alap alapértéket adni

$value = array_get($base_par, 'names.john', 'default'); //dot tömbelérés defaultal
@endphp
@section('content')
<div class="col-md-9">
    <div class="card">
       
        <div class="card-header">  {{ $viewpar['taskheader'] ?? 'Szerkesztés' }}</div>
        <div class="card-body">
                <a href="{{ url($viewpar['route']) }}" title="Back"><button class="btn btn-warning btn-sm">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Vissza</button>
                </a>
                     
            <br/>
            <br/>
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        @if(isset($viewpar['info']))       
                        <div  class="float-right">
                            <a href="#myModalInfo"   data-toggle="modal" data-content="modalInfobody"> <i style="color:blue;font-size:2rem;" class="fa fa-info-circle" aria-hidden="true"></i></a>
                        </div>          
                        @endif
            @php
       $formend=true;
            @endphp
            
            @foreach ($viewpar['form'] as $name=>$param)
            @php 
            $func=$param[0] ; 
           // $name = explode('*',$name)[0]; //indexelés eltávolítása nem biztos hogy kell
              @endphp     
                @switch($func)
                @case('html')
                @php
                // 'tex1'=> ['html','tipus',['szöveg','id="tex1"'],
                $tipus=$param[1] ?? 'span'; 
                $content=$param[2][0] ?? '';  
                $param=$param[2][1] ?? '';
                @endphp 
                <{{$tipus}} {{$param}}> {{$content}} </{{$tipus}}> 
                @break
                @case('formstartCreate')
                @php $url =$param['url'] ?? config('tpar.route').'/store';
                $formpar=$param[1] ?? [];  $formpar['url']=$url; $formend=$param[2] ?? $formend;  @endphp 
               {!! Form::model($data,array_merge(config('tpar.formcreatepar',[]),$formpar)) !!}          
                @break

                @case('formstartEdit')
                @php $url =$param['url'] ?? config('tpar.route').'/update/'. config('tpar.id');
                $formpar=$param[1] ?? [];  $formpar['url']=$url; $formend=$param[2] ?? $formend;  @endphp 
                {!! Form::model($data,array_merge(config('tpar.formeditpar',[]),$formpar)) !!}          
                @break
                @case('formend')
                {!! Form::close() !!}        
                @break
                @case('submit')
                <input dusk="savebutton" class="{{$param['class'] ?? config('tpar.submit_class')}}" type="submit" value="{{$param[1] ?? 'Mentés'}}">      
                @break
                @default
                @php
                $label=$param[1] ?? '' ;
                $labelp=$param[2]['labelpar'] ?? [];   
                $labelpar=array_merge(config('tpar.labelpar'),$labelp);
                @endphp
                <div class="form-group {{ $errors->has($name) ? 'has-error' : ''}}">                                                
                   
                    {!! Form::label($name, $label, $labelpar ) !!}
                 
                        <div class="col-md-6">    
                            @switch($func)
                                @case('htmlWithLabel')
                                @php
                                // 'tex1'=> ['htmlWithLabel','label',['span','szöveg','id="tex1"'],
                                $tipus=$param[2][0] ?? 'span'; 
                                $content=$param[2][1] ?? '';  
                                $param=$param[2][2] ?? '';
                                @endphp 
                              <{{$tipus}} {{$param}}> {{$content}} </{{$tipus}}>
                               @break
                                @case('selectFromPluck')
                                    @php
                                    //example: 'ceg_id'=>['selectFromPluck','label','$data key','checked'] ,
                                    //example: 'ceg_id'=>['selectFromPluck','Cég aki használhatja','cegs($data['cegs']-be keresi a pluck arrayt)','1(az egyes kulcs lesz a checked)'] ,
                                    $checked= $param[3] ?? null;
                                    @endphp 
                                    {!! Form::select($name, $data[$param[2]], $checked, []) !!}   
                                 @break
                               
                               @case('selectFromArr')
                                    @php
                                    //example 'pub'=>['selectFromArr','jogosultság(felirat)',['1'=>'Alap','5'=>'Pro','10'=>'VIP','0'=>'Tiltva'],'1(selected kulcs)'] 
                                    $checked= $param[3] ?? null;
                                    $inputp=$param[2]['inputpar'] ?? $param[2] ?? []; 
                                    $inputpar=config('tpar.inputpar'); 
                                    @endphp 
                                    {!! Form::select($name, $param[2], $checked, $inputpar) !!}   
                                 @break
                                @case('select')
                                 @php
                                     $checked= $data[$name] ?? $param[3] ?? null;
                                     $inputp=$param[2]['inputpar'] ?? $param[2] ?? []; 
                                    $inputpar=array_merge(config('tpar.inputpar',[]),$inputp); 
                                 @endphp 
                                {!! Form::select($name, $data[$name.'_list'], $checked, $inputpar) !!}   
                                @break 
                        @case('filelist')
                            @if(isset($data[$name]))   
                               @foreach ($data[$name] as $file)
                                <span style="color:blue;">  {{$file->name}} 
                                    <a href="{{ url($viewpar['route']).'/destroyfile/'. $file->id  }}" onclick="return confirm('Biztos hogy törölni akarja?')" title="törlés" class="btn btn-danger btn-sm">
                                         <i style="color:white;" class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>
                                </span></br>
                                   
                               @endforeach
                            @endif  
                         @break 
                                 @case('file')
                                  {!!   Form::file($name) !!} 
                                @break  
                                @case('image')
                                @if(isset($data[$param[1]]))
                                 <img src=" {{$data[$param[1]]}}" width="50px" height="50px">   
                                @else 
                                <img src="/images/img_avatar.png" width="50px" height="50px">  
                                @endif
                                {!!   Form::file($name) !!} 
                              @break   
                                @case('checklist')
                                     @foreach($param[2] as $checlist)
                                     @php 
                                     $listname=$checlist[0];
                                     $listvalue=$checlist[1];
                                     $listlabel=$checlist[2] ?? $listname;
                                     $listchecked= $checlist[3] ??  false;    
                                     if(isset($data[$listname]) && $data[$listname]==$listvalue ) { $listchecked=true; }
                                      @endphp 
                                     {{Form::checkbox($listname, $listvalue, $listchecked) }} {{$listlabel}}
                                     @endforeach
                               @break
                        
                               @case('checkgroup')
                               @foreach($param[2] as $listval=> $listlabel)
                               @php 
                               $listname=$name.'[]';
                              // $listvalue=$checlist[0];
                              // $listlabel=$checlist[1] ?? $listname;
                                $listchecked= false;    
                               if(isset($data[$listname]) && $data[$listname]==$listval ) { $listchecked=true; }
                               @endphp 
                               {{Form::checkbox($listname, $listval, $listchecked)}} {{$listlabel}}
                               @endforeach
                                @break

                            @case('check') 
                                @php 
                                $value=$param[2] ;
                                $label=$param[1] ?? $name; 
                                $dataval=$data[$name] ?? '';
                                $checked= false;
                                if(!isset($data[$name])){$checked= $param[3] ?? false;}
                                if($value==$dataval){ $checked= true;}
                                @endphp 
                              {{Form::checkbox($name, $value, $checked)}} {{$label}}
                            @break
                            @case('radio')
                              @php 
                              $value=$param[2] ;
                              $label=$param[1] ?? $name; 
                              $dataval=$data[$name] ?? '';
                              $checked= false;
                              if(!isset($data[$name])){$checked= $param[3] ?? false;}
                              if($value==$dataval){ $checked= true;}
                              @endphp 
                              {{Form::radio($name, $value, $checked)}} {{$label}}
                            @break
                            
                               @case('radiolist')
                               @foreach($param[2] as $checlist)
                               @php 
                               $listname=$name;
                               $listvalue=$checlist[0];
                               $listlabel=$checlist[1] ?? '';
                               $listchecked= $checlist[2] ??  false;    
                               if(isset($data[$listname]) && $data[$listname]==$listvalue ) { $listchecked=true; }
                                @endphp 
                                {{Form::radio($listname, $listvalue, $listchecked)}} {{$listlabel}}
                               @endforeach
                               @break               
                               @case('iconlist')
                            
                            @include('includes.table.icons')
                            
                             @break
                                @default
                                @php 
                                $inputp=$param[2]['inputpar'] ?? $param[2] ?? []; 
                               // $valuefinal=$data[$name] ?? null;
                                $inputpar=array_merge(config('tpar.inputpar',[]),$inputp); 
                                @endphp
                                 {!! Form::$func($name,null , $inputpar)!!}
                            @endswitch         
                         
                        {!! $errors->first($name, '<p class="help-block">:message</p>') !!} 
                    </div>     
                </div>
            @endswitch                        
            @endforeach            
            @if($formend)  {!! Form::close() !!}  @endif    
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection