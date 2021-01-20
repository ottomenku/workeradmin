@extends($viewpar['template'].'.'.$viewpar['frame'])

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">{{ $viewpar['taskheader'] ?? $viewpar['app_name'] ?? $viewpar['route'] ?? 'index' }}</div>
        <div class="card-body">
            <a href="{{ url($viewpar['route'].'/create') }}" dusk="new" class="btn btn-success btn-sm" title="Uj dokumentum kategória">
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
            @if($viewpar['tableform'] ?? false)

            @php $formroute= $viewpar['formroute'] ?? $viewpar['route']; @endphp
            {!! Form::open(['method' => 'POST', 'url' => $formroute, 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
            <br/> 
            <button class="btn btn-outline-{{$viewpar['gomb1,']['class'] ?? 'success'}} button-xs" value="{{$viewpar['gomb1']['val'] ?? 'pub'}}" type="submit">{{$viewpar['gomb1']['label'] ?? 'A kijelöltek engedélyezése'}}</button>
            <button class="btn btn-outline-{{$viewpar['gomb2,']['val'] ?? 'danger'}}" value="{{$viewpar['gomb2,']['val'] ?? 'unpub'}}" type="submit">{{$viewpar['gomb2']['label'] ?? 'A kijelöltek tiltása'}}</button>
            <div class="btn btn-outline-{{$viewpar['gomb2,']['val'] ?? 'danger'}}" ><input type="checkbox" id="checkAll" name="checkAll">{{$viewpar['gomb2']['label'] ?? 'összes kijelölése'}}</div>
            @endif
            <br/>
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            @foreach($viewpar['table'] as $key=> $val)
                            <th>{{$val[0] ?? $key }}</th>
                            @endforeach
                            @if(!empty($viewpar['table_action'])) <th>Actions</th>@endif
                        </tr>
                    </thead>
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
                        <th> {{ $value }}  </th>
                        @endforeach
                        @if(!empty($viewpar['table_action']))        
                            <td>

                        @if(isset($viewpar['table_action']['check']))  
                        <input class="checkbox" type="checkbox" name="id[]" value="{{$item->id}}">
                        @endif       
                        @if(isset($viewpar['table_action']['show']))  
                              <a href="{{ url($viewpar['route']).'/show/'. $item->id }}" title="View Category"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                        @endif
                        @if(isset($viewpar['table_action']['edit']))       
                              <a href="{{ url($viewpar['route']).'/edit/'. $item->id  }}" dusk="edit{{ $item->id }}" title="Edit Category"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
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
