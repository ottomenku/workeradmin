@extends($param['crudview'].'.index')
@section('table')
              
                 @foreach($data['workers']  as $worker)
                                <a href=" {!! MoHandF::url($param['routes']['base'],$param['getT'],['w_id'=>$worker['id']]) !!}" 
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
                                        <th>Datum</th><th>User</th><th>Nap tipus</th><th>Kérelem</th><th>Megjegyzés</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data['list']  as $item)
                                    <tr>
                                        @php
                                        $color='grey';$nedpub=false;
                                        if($item->daytype_id!=$item->wish_id){ $color='red'; $nedpub=true;}
                                        $daytypename=$item->daytype->name ?? '0';
                                        @endphp
                                        <td>{{ $item->datum }}</td>
                                        <td>{{ $item->worker->user->name }}</td><td>{{ $daytypename}}</td>
                                        <td><span style="color:{{ $color }}">{{ $data['daytype'][$item->wish_id] }}</span></td>
                                        <td>{{
                                           str_limit($item->managernote, $limit = 30, $end = '...') }}</td>
                                        <td>
                                            @if($nedpub)
                                                <a href="{!!  MoHandF::url($param['routes']['base'],$param['getT'],['task'=>'pub','id'=>$item->id]) !!} " 
                                                class="btn btn-success btn-xs" >
                                                        <i class="fa fa-check" aria-hidden="true"></i> 
                                                </a>
                                            @endif
   {!!
                                         MoHandF::delButton([
                                        'tip'=>'del',
                                        'link'=>MoHandF::url($param['routes']['base'].'/'.$item->id,$param['getT']),
                                        'fa'=>'trash-o']) 
                                    !!}
<!--

                                    {!! 
                                        MoHandF::linkButton([
                                        'link'=> MoHandF::url($param['routes']['base'].'/'.$item->id.'/edit',$param['getT']),
                                        'fa'=>'pencil-square-o']) 
                                    !!}
                                 
-->                                   
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                         </div>

@endsection
