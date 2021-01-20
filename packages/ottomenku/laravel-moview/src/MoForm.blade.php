@php
$form=[
'name'=>['input','text',['label'=>'Név','labelpar'=>['reset','class' => 'form-control']]]
,'datum'=> ['input','date',['inputpar'=>['required' => 'required']]]
];

@endphp

@foreach ($viewParam['form'] as $name=>$param)
@php
//$par=array_merge($baseFormtypes,$param);
$inputtype=$param['type']
$required='';
if($param['type'])
@endphp
@switch($param[0])
    @case(false)
    @break
    @case('input')
    <div class="{{form-group}}{{ $errors->has($name) ? 'has-error' : ''}}">
        @php $labelpar=array_merge(['class' => 'form-control'],$param[2]['labelpar']); @endph 
        {!! Form::label($name, $param[2]['label'],$labelpar ) !!}
        @switch($param[1])
            @php $inputpar=array_merge(['class' => 'form-control'],$param[2]['inputpar']); @endphp
            @case('number')
            {!! Form::number($name, null, $inputpar)!!}
            @break
            @case('text')
            @php $inputpar=array_merge(['class' => 'form-control'],$param[2]['inputpar']); @endphp
            {!! Form::text($name, null,   $inputpar)!!}
            @break
            @case('date')
            @php $inputpar=array_merge(['class' => 'form-control datepicker'],$param[2]['inputpar']); @endphp
            {!! Form::text($name, null,   $inputpar)!!}
            @break
        {!! $errors->first($name, '<p class="help-block">:message</p>') !!}
    </div>
    @break
    @default
    <span>Something went wrong, please try again</span>
@endswitch

@endforeach



@foreach ($viewParam['form'] as $name=>$param)
    @switch($param[0])
        @case('input')
        @php
        $lb=$param[2]['labelpar'] ?? [];
        $labelpar=array_merge(['class' => 'form-control'],$lb);
        @endphp 
        
            {!! Form::label($name, $param[2]['label'],$labelpar ) !!}
            @switch($param[1])
                @php $inp=$param[2]['inputpar'] ?? [];  $inputpar=array_merge(['class' => 'form-control'],$inp); @endphp
                @case('number')
                {!! Form::number($name, null, $inputpar)!!}
                @break
                @case('text')
                @php $inp=$param[2]['inputpar'] ?? [];  $inputpar=array_merge(['class' => 'form-control'],$inp); @endphp
                {!! Form::text($name, null,   $inputpar)!!}
                @break
                @case('date')
                @php $inp=$param[2]['inputpar'] ?? [];  $inputpar=array_merge(['class' => 'form-control datepicker'],$inp); @endphp
                {!! Form::text($name, null,   $inputpar)!!}
                @break
                @default
                <span>Something went wrong, please try again</span>
            @endswitch  
            {!! $errors->first($name, '<p class="help-block">:message</p>') !!}
        </div>
        @break
        @default
        <span>Something went wrong, please try again</span>
    @endswitch
@endforeach