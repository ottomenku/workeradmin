
 
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th>Name</th><th>Note</th><th>Létszám</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data['list'] as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td><td>{{ $item->note }}</td><td>{{ $item->sum }}</td>
                                        <td> 
                                                <a href="{{ url('/'.$param['routes']['base'].'/calendar/' . $item->id,$param['getT']) }}" 
                                                title="View "><button class="btn btn-info btn-xs">
                                                <i class="fa fa-calendar" aria-hidden="true"></i> </button></a>
                                                <a href="{{ url('/'.$param['routes']['base'].'/' . $item->id,$param['getT']) }}" 
                                                    title="View "><button class="btn btn-info btn-xs">
                                                    <i class="fa fa-users" aria-hidden="true"></i> </button></a>
                                                <a href="{!!  MoHandF::url($param['routes']['base'].'/'.$item->id.'/edit',$param['getT']) !!} "
                                                class="btn btn-primary btn-xs" title="edit">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 
                                                </a> 
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

