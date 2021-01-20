
@extends($param['crudview'].'.create')
@section('form')
       @foreach($data['workers']  as $worker)
                        <a href=" {!! MoHandF::url($param['routes']['base'].'/create',$param['getT'],['w_id'=>$worker['id']]) !!}" 
                                title="worker választás" 
                          @if ($param['getT']['w_id']==$worker['id'])    
                            class="btn btn-danger btn-xs">
                          @else
                           class="btn btn-warning btn-xs">
                          @endif
                                    {!!    $worker['user']['name'] !!}
                                
                                </a>
                   @endforeach  
  @if($param['getT']['w_id']==0)
 <h3> Kérem jelöljön ki egy dolgozót!</h3>
  @else                 
 @include($param['view'].'.calendar')
@endif
@endsection