
           
@php

$getT=$param['getT'];
@endphp 

<div class="table-responsive">
    <div class="table-responsive">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th>ID</th><th>Foto</th><th>User név</th><th>Teljes név</th><th>Email</th><th>Munkakör</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($data['list']  as $item)
                <tr>
                    <td>{{ $item->id }}</td><td> <img src="/{{ $item->foto }}" alt="foto" height="20" width="25"> </td>
                    <td>{{ $item['user']['name'] }}</td><td>{{ $item->fullname }}</td><td>{{ $item['user']['email'] }}</td><td>{{  $item->position }}</td>
                    <td>
                        <a href="{{ url('/'.$param['routes']['base'].'/calendar/' . $item->id,$param['getT']) }}" 
                            title="View "><button class="btn btn-info btn-xs">
                            <i class="fa fa-calendar" aria-hidden="true"></i> </button></a>

                    
                  
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>
