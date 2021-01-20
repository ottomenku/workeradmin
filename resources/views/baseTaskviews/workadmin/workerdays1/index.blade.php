@extends($param['crudview'].'.index')
@section('table')
              
                 @foreach($data['workers']  as $worker)
                                <a href=" {!! MoHandF::url($param['baseroute'],$param['getT'],['w_id'=>$worker['id']]) !!}" 
                                title="worker választás">
                          @if ($param['getT']['w_id']==$worker['id'])    
                           <button class="btn btn-danger btn-xs">
                          @else
                          <button class="btn btn-warning btn-xs">
                          @endif
                                    {!!    $worker['user']['name'] !!}
                                </button>
                                </a>
                   @endforeach  
             
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Datum</th><th>User</th><th>Nap tipus</th><th>Megjegyzés</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data['list']  as $item)
                                    <tr>
                                        <td>{{ $item->datum }}</td>
                                        <td>{{ $item->worker->user->name }}</td><td>{{ $item->daytype->name }}</td>
                                        <td>{{
                                           str_limit($item->managernote, $limit = 30, $end = '...') }}</td>
                                        <td>
                                    {!! 
                                        MoHandF::linkButton([
                                        'link'=> MoHandF::url($param['baseroute'].'/'.$item->id.'/edit',$param['getT']),
                                        'fa'=>'pencil-square-o']) 
                                    !!}
                                    {!!
                                         MoHandF::delButton([
                                        'tip'=>'del',
                                        'link'=>MoHandF::url($param['baseroute'].'/'.$item->id,$param['getT']),
                                        'fa'=>'trash-o']) 
                                    !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                         </div>

@endsection
