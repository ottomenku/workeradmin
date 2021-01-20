
    @if($viewpar['checking'] ?? false)

    @php $formroute= $viewpar['formroute'] ?? $viewpar['route']; @endphp
    {!! Form::open(['method' => 'POST', 'url' => $formroute, 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
    <br/> 
    <button class="btn btn-outline-{{$viewpar['gomb1,']['class'] ?? 'success'}} button-xs" value="{{$viewpar['gomb1']['val'] ?? 'pub'}}" type="submit">{{$viewpar['gomb1']['label'] ?? 'A kijelöltek engedélyezése'}}</button>
    <button class="btn btn-outline-{{$viewpar['gomb2,']['val'] ?? 'danger'}}" value="{{$viewpar['gomb2,']['val'] ?? 'unpub'}}" type="submit">{{$viewpar['gomb2']['label'] ?? 'A kijelöltek tiltása'}}</button>
    <div class="btn btn-outline-{{$viewpar['gomb2,']['val'] ?? 'danger'}}" ><input type="checkbox" id="checkAll" name="checkAll">{{$viewpar['gomb2']['label'] ?? 'összes kijelölése'}}</div>
    @endif
    <br/>


 

    
