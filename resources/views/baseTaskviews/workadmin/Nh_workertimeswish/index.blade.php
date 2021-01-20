@extends($param['crudview'].'.index')
@section('table')


      <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                    <th>User név</th> <th>Dátum</th><th>Start</th><th>End</th><th>Óra</th><th>Időtipus</th><th>Dolgozó megjegyzése</th><th>Admin megjegyzése</th><th>Elbírálás</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['list'] as $item)
                                    <tr>                                      
                                        <td>{{ $item->worker->user->name }}</td>  
                                        <td>{{ $item->datum }}</td> <td>{{ $item->start }}</td><td>{{ $item->end }}</td><td>{{ $item->hour }}</td>
                                       <td>{{ $item['timetype']['name'] }}</td>
                                        <td>
                                          {{ str_limit($item->workernote, 20,  '...') }}
                                        </td> 
                                        <td>
                                            {{ str_limit($item->managernote, 20,  '...') }}
                                          </td> 
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

                                        
                               <!--
                                    {!!
                                         MoHandF::delButton([
                                        'tip'=>'del',
                                        'link'=>MoHandF::url($param['routes']['base'].'/'.$item->id,$param['getT']),
                                        'fa'=>'trash-o']) 
                                    !!}
                                -->
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                         </div>
    



                

@endsection
