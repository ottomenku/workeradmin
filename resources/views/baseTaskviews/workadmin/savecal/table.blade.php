@php
$getT=$param['getT'];
@endphp 

<div class="table-responsive">
    <div class="table-responsive">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th>ID</th><th>Dolgozó</th><th>Év</th><th>Hó</th><th>Mentés neve</th><th>Megjegyzés</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($data['list']  as $item)
                <tr>
                    <td>{{ $item->id }}</td><td>{{ $item->worker_id }}</td>
                    <td>{{ $item->ev }}</td><td>{{ $item->ho }}</td><td>{{ $item->name }}</td><td>{{  $item->note }}</td>
                    <td>
                        <a href="{{ url('/'.$param['routes']['base'].'/calendar/' . $item->id,$param['getT']) }}" 
                            title="View" data-toggle="modal" data-target="#myLargeModalCalendar"><button class="btn btn-info btn-xs">
                            <i class="fa fa-calendar" aria-hidden="true"></i> </button></a>

                            <a href="{{ url('/'.$param['routes']['base'].'/solver/' . $item->id,$param['getT']) }}" 
                                title="View " data-toggle="modal" data-target="#myLargeModal"><button class="btn btn-info btn-xs">
                                <i class="fa fa-list" aria-hidden="true"></i> solver</button></a>
                              
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>
<!-- Modal large-->
<div class="modal fade modal-dialog-centered " id="myLargeModalCalendar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
    <div class="modal-header" style="background-color:blue;">
        <button type="button" style="color:red;background-color:white; opacity: 0.6;" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"> Naptar </h4>

    </div>
        <div class="modal-content">
         
            <div class="modal-body"><div id="myModalContent" class="te"></div></div>
         
        </div>    
        <!-- /.modal-content -->
         <div class="modal-footer">
          <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>-->
        </div>
    </div>