 <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                       <th>Múszaknév</th><th>időegység</th><th>hossz</th><th>Munkaidők</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data['list'] as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td><td>{{ $item->unit }}</td><td>{{ $item->long }}</td>
                                        <td>
                                        @foreach($item->wroletime as $time) 
                                        {{ '['.str_limit($time->start, 5, '').'-'.str_limit($time->end, 5, '').']'  }}
                                        @endforeach
                                        </td>
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