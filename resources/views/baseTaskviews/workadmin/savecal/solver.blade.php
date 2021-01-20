@php

$bruttober=0;
  @endphp 
  <button class='print-button'>
        <span>Nyomtatás</span>
       </button>
 
    <script>   
       $('.print-button').on('click', function() {  
           //window.print(); 
           var DocumentContainer = document.getElementById('myLargeModal');
           var WindowObject = window.open('', "PrintWindow", "width=750,height=650,top=50,left=50,toolbars=no,scrollbars=yes,status=no,resizable=yes");
           WindowObject.document.writeln(DocumentContainer.innerHTML);
           WindowObject.document.close();
           WindowObject.focus();
           WindowObject.print();
           WindowObject.close();
           return false; // why false?
         });
       
       </script>
<h3>Napösszesítő </h3>
<div  class="row">
  <div class="col-xs-4">
    <div class="col-xs-8">Összes nap:</div> <div class="col-xs-4">{{ $data['sum']['napsum'] }}</div>
  </div>  
  <div class="col-xs-4">
        <div class="col-xs-8">Munkanap:</div> <div class="col-xs-4">{{ $data['sum']['workday'] }}</div>
    </div> 
    <div class="col-xs-4">
            <div class="col-xs-8">ledolgozott nap:</div> <div class="col-xs-4">{{ $data['sum']['ledolg'] }}</div>
    </div>   
  
</div>
<h3>Naptipusok</h3>
    
<div class="table-responsive">
        <div class="table-responsive">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>Naptipus</th><th>sum</th><th>fixplusz</th><th>sum fixplusz</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach($data['dayT']  as $tip=>$item)
                        <tr>
                            <td>{{ $data['daytypes'][$tip]['name'] }}</td><td>{{ $item }}</td>
                            <td>{{$data['daytypes'][$tip]['fixplusz'] }}</td><td>{{ $data['daytypes'][$tip]['fixplusz']*$item }}</td>
                       
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
    </div>
    <h3>Munkaidők</h3>
    Alap órabér: {{ $data['oraber'] }}
<div class="table-responsive">
        <div class="table-responsive">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>idŐtipus</th><th>óra</th><th>fixplusz</th><th>sum fixplusz</th><th>szorzó</th><th>sumÓrabér</th><th>sum</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach($data['timeT']  as $tip=>$item)
                        <tr>
                            <td>{{ $data['timetypes'][$tip]['name'] }}</td><td>{{ $item }}</td>
                            <td>{{$data['timetypes'][$tip]['fixplusz'] }}</td><td>{{ $data['timetypes'][$tip]['fixplusz']*$item }}</td>
                            <td>{{$data['timetypes'][$tip]['szorzo'] }}</td><td>{{ $data['timetypes'][$tip]['szorzo']*$item*$data['oraber'] }}</td>
                            <td>{{ $data['timetypes'][$tip]['szorzo']*$item*$data['oraber'] +$data['timetypes'][$tip]['fixplusz']*$item }}</td>
                        </tr>
                        @php
                        $bruttober=$bruttober+$data['timetypes'][$tip]['fixplusz']*$item+$data['timetypes'][$tip]['szorzo']*$item*$data['oraber']  ;
                     @endphp 
                    @endforeach
                </tbody>
            </table>
        </div>
      
    </div> 
     <h3>Össz óra:{{  $data['sum']['timesum']  }} Bruttobér:{{  $bruttober }}</h3>