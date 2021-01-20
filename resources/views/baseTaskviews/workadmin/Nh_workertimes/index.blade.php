@extends($param['crudview'].'.index')
@section('table')


      <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                     <th>Időtipus</th><th>Dátum</th><th>Start</th><th>End</th><th>Óra</th><th>Állapot</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['list'] as $item)
                                    <tr>
                                       
                                        <td>{{ $item['timetype']['name'] }}</td>
                                        <td>{{ $item->datum }}</td> <td>{{ $item->start }}</td><td>{{ $item->end }}</td><td>{{ $item->hour }}</td>
                                       
                                        <td>
                                         @if($item->pub==0 )
                                        <span
                                          class="btn btn-success btn-xs" title="pub">
                                              <i class="fa fa-check-square-o" aria-hidden="true"></i> 
                                          <span>
                                       @else
                                            <span
                                          class="btn btn-danger btn-xs" title="Unpub">
                                              <i class="fa fa-times" aria-hidden="true"></i> 
                                    </span>
                                       @endif
                                </td>
                                        <td>
                                            @if($item->pub==0 )

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
