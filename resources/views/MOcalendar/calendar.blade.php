@extends($viewpar['template'].'.'.$viewpar['frame'])

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">{{ $viewpar['taskheader'] ?? $viewpar['app_name'] ?? $viewpar['route'] ?? 'index' }}</div>
        <div class="card-body">
       <!--     <a href="{{ url($viewpar['route'].'/create') }}" dusk="new" class="btn btn-success btn-sm" title="Uj dokumentum kategória">
                <i class="fa fa-plus" aria-hidden="true"></i> Add New
            </a>
       
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
         -->
            @if($viewpar['checking'] ?? false)

            @php $formroute= $viewpar['formroute'] ?? $viewpar['route']; @endphp
            {!! Form::open(['method' => 'POST', 'url' => $formroute, 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
            <br/> 
            <button class="btn btn-outline-{{$viewpar['gomb1,']['class'] ?? 'success'}} button-xs" value="{{$viewpar['gomb1']['val'] ?? 'pub'}}" type="submit">{{$viewpar['gomb1']['label'] ?? 'A kijelöltek engedélyezése'}}</button>
            <button class="btn btn-outline-{{$viewpar['gomb2,']['val'] ?? 'danger'}}" value="{{$viewpar['gomb2,']['val'] ?? 'unpub'}}" type="submit">{{$viewpar['gomb2']['label'] ?? 'A kijelöltek tiltása'}}</button>
            <div class="btn btn-outline-{{$viewpar['gomb2,']['val'] ?? 'danger'}}" ><input type="checkbox" id="checkAll" name="checkAll">{{$viewpar['gomb2']['label'] ?? 'összes kijelölése'}}</div>
            @endif
            <br/>

@php
// TODO config file elkészítése
/*  use app\Http\Controllers\Worker\NaptarController;
    {{ NaptarController::proba('param') }}
    {{ App::make("app\Http\Controllers\Worker\NaptarController")->proba2('param') }} */

 //viewek--------------------------------------------   
 $calendarbase=$viewpar['calendar']['view']['base']  ?? 'MOcalendar';
 //$calendarview=$viewpar['calendar']['view']['calendarview'] ??  $calendarbase;
//echo  '-----------------'. $calendarbase;
 $pdf_print_view=$viewpar['calendar']['view']['pdf_print'] ??  $calendarbase.'.pdf_print';
 $ev_ho_view=$viewpar['calendar']['view']['ev_ho_view'] ??  $calendarbase.'.ev_ho';
 $checkbutton_view=$viewpar['calendar']['view']['checkbutto_view'] ??  $calendarbase.'.checkbutton';
 $style_view=$viewpar['calendar']['view']['style'] ??  $calendarbase.'.style';
 $days_view=$viewpar['calendar']['view']['days'] ?? $calendarbase.'.days';
//echo  '-----------------'.$days_view;

$daystyle=$viewpar['calendar']['daystyle'] ?? [
        'empty'=>'border: 1px solid silver;',
        'base'=>['li'=>'border: 1px solid silver;','div'=>'','span'=>'color:silver'],
        'hollyday'=>['li'=>'border: 1px solid red;','div'=>'','span'=>'color:red'],
        'special'=>['li'=>'border: 1px solid blue;','div'=>'','span'=>'color:blue'],
    ];
$timestyle=$viewpar['calendar']['timestyle'] ??[
        'base'=>['div'=>'border: 1px solid silver;','span'=>'color:blue'],
    ];
    $ev_ho_formurl=$viewpar['calendar']['routes']['ev_ho_form'] ?? '/m/ad.work.time';    
@endphp

@include($style_view)
{!! Form::open([
    'url' => $ev_ho_formurl, 
    'method' => 'GET',
    'class' => 'form-vertical'
    ]) !!}

<div class="row">
@include($ev_ho_view)

{!! Form::close() !!}

@include( $pdf_print_view)
</div>
<br>
@if( isset($viewpar['calendar']['style_plus']))
    @include($viewpar['calendar']['style_plus'].'.style_plus')
@endif  


              
<div id="naptar" style=" width: 100%;" >  
<div style="background-color:#c5c5d6;">

    <ul class="flex-container nowrap"  style="backgroun-color:white;">
       
        <li class="flex-item "  style="">Hétfő</li>
        <li class="flex-item "  style="">Kedd</li>
        <li class="flex-item "  style="">Szerda</li>
        <li class="flex-item "  style="">Csütörtök</li>
        <li class="flex-item "  style="">Péntek</li>
        <li class="flex-item "  style="; color:red;">Szombat</li>  
        <li class="flex-item "  style=";color:red;">Vasárnap</li>    
    </ul>
</div>     

@foreach($data['calendar'] as $dt) 
<!-- sorkezdés---------------------------------------------->
    @if($dt['dayOfWeek']==1 or $dt['day']==1) 
            <ul class="flex-container nowrap " style="justify-content:flex-start"> 
    <!-- **sortöltés üres divek---------------------------------------------------------->
        @php
        if( $dt['dayOfWeek']==0){$emptydiv=6;}
        else{$emptydiv=$dt['dayOfWeek']-1;}
        @endphp     
        @if ($emptydiv>0) 
            @for ($i = 0; $i < $emptydiv; $i++)
                <li class="flex-item" style="{{ $daystyle['empty'] }}">
                    
                </li>
            @endfor

        @endif
<!-- **------------------------------------------------------------------->               
    @endif
 <!-- Napok--------------------------------------------------->        
 @include($days_view)
<!-- sor lezárása ha teljes a hét------------------------->   
    @if($dt['dayOfWeek']==0) 
    </ul > 
    @endif 
@endforeach

 <!-- üres divek sortöltés és sorlezárás ha nem teljes a hét------------------------------------>
@if($dt['dayOfWeek']>0) 
    @for ($i = $dt['dayOfWeek']; $i < 7; $i++)
            <li class="flex-item" style="{{ $daystyle['empty'] }}"> </li>
    @endfor
</ul > 
@endif 
          
</div> 

</div>
</div>
</div>

@endsection

