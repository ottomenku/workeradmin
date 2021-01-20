@extends($param['crudview'].'.index')

@section('table')
</br></br></br>
<div class="col-md-3"> Dolgozó kiválasztása </div>
<div class="col-md-8">
@foreach($data['workers'] as $unit)
<a href=" {!! MoHandF::url($param['routes']['base'],$param['getT'],['worker_id'=>$unit['id']]) !!}" 
    title="dolgozó választás"
@if ($param['getT']['worker_id']==$unit['id'])    
class="btn btn-danger btn-xs">
@else
class="btn btn-warning btn-xs">
@endif
        {!!    $unit['user']['name'] !!}   
</a>
@endforeach  
</div>
</br></br>





                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th>Dolgozó neve</th><th>Műszak</th><th>Kérés</th><th>Dátum</th><th>Note</th><th>állapot</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data['list'] as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>
                                          @if(isset($item->worker->user->name))  {{ $item->worker->user->name }} @endif
                                        </td> 
                                        <td>@if(isset($data['wrunit'][$item->wroleunit_id])) {{ $data['wrunit'][$item->wroleunit_id] }} @endif</td>
                                        <td>@if(isset($data['wrunit'][$item->wish_id])){{ $data['wrunit'][$item->wish_id]}} @endif</td>
                                        <td>{{ $item->datum }}</td> <td>{{ $item->note }}</td>
                                        <td>

                                                @if($item->pub==1)
                                                 <span class="btn btn-primary btn-xs"> uj</span>
                                                @elseif($item->pub==0)
                                                <span class="btn btn-success btn-xs" title="">
                                                    <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                                </span>
                                                @elseif($item->pub==2)
                                                <span class="btn btn-danger btn-xs" title="">
                                                    <i class="fa fa-times" aria-hidden="true"></i> 
                                                </span>
                                                @endif
    
                                            </td>
                                     
                                        <td>
                                                @if($item->pub==1 )
                                    
                                                   <a href="{!!  MoHandF::url($param['routes']['base'],$param['getT'],['task'=>'pub','id'=>$item->id]) !!} "
                                                    class="btn btn-success btn-xs" title="Pub">
                                                       <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                                   </a>
                                                   <a href="{!!  MoHandF::url($param['routes']['base'],$param['getT'],['task'=>'unpub','id'=>$item->id]) !!} "
                                                   class="btn btn-danger btn-xs" title="Unpub">
                                                        <i class="fa fa-times" aria-hidden="true"></i> 
                                                    </a>
                                                   @elseif($item->pub==0 )
                                                   <a href="{!!  MoHandF::url($param['routes']['base'],$param['getT'],['task'=>'unpub','id'=>$item->id]) !!} "
                                                   class="btn btn-danger btn-xs" title="Unpub">
                                                       <i class="fa fa-times" aria-hidden="true"></i> 
                                                   </a>
                                                   @else
                                                   <a href="{!!  MoHandF::url($param['routes']['base'],$param['getT'],['task'=>'pub','id'=>$item->id]) !!} "
                                                   class="btn btn-success btn-xs" title="pub">
                                                       <i class="fa fa-check-square-o" aria-hidden="true"></i> 
                                                   </a>
                                                   @endif
    
                                                   {!! 
                                                    MoHandF::linkButton([
                                                    'link'=> MoHandF::url($param['routes']['base'].'/'.$item->id.'/edit',$param['getT']),
                                                    'fa'=>'pencil-square-o']) 
                                                !!}
                                   
                                        {!!
                                             MoHandF::delButton([
                                            'tip'=>'del',
                                            'link'=>MoHandF::url($param['routes']['base'].'/'.$item->id,$param['getT']),
                                            'fa'=>'trash-o']) 
                                        !!}
                                            </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                    </div>
 @endsection
