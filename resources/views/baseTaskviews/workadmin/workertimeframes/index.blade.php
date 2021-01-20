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
<div class="col-md-3"> időkeret hozzáadása </div>
<div class="col-md-8">
        @if($param['getT']['worker_id']>1)

        @foreach($data['timeframes'] as $unit)
        <a href=" {!! MoHandF::url($param['routes']['base'],$param['getT'],['timeframe_id'=>$unit['id'],'task'=>'addtimeframe']) !!}" 
            title="dolgozó választás"
        @if ($param['getT']['timeframe_id']==$unit['id'])    
        class="btn btn-danger btn-xs">
        @else
        class="btn btn-warning btn-xs">
        @endif
                {!!    $unit['name'] !!}            
            </a>
        @endforeach 
    </br></br>
        @endif

</div>




                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th>Dolgozó neve</th><th>Munkarend</th><th>Start</th><th>End</th><th>Note</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data['list'] as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->worker->user->name }}</td> <td>{{ $item->timeframe->name }}</td><td>{{ $item->start }}</td> <td>{{ $item->end }}</td><td>{{ $item->note }}</td>
                                        <td>
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
