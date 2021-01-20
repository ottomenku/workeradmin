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
        @if(isset($viewpar['info']))       
        <div  class="float-right">
            <a href="#myModalInfo"   data-toggle="modal" data-content="modalInfobody"> <i style="color:blue;font-size:2rem;" class="fa fa-info-circle" aria-hidden="true"></i></a>
        </div>          
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