@extends($param['crudview'].'.index')
@section('table')
@include($param['view'].'.style')
    @php

/*  use app\Http\Controllers\Worker\NaptarController;
    {{ NaptarController::proba('param') }}
    {{ App::make("app\Http\Controllers\Worker\NaptarController")->proba2('param') }} */

    $yearnow[]=\Carbon::now()->year-2;
    
    $yearnow[]=\Carbon::now()->year-1;
    $yearnow[]=\Carbon::now()->year;
    $yearnow[]=\Carbon::now()->year+1;
    $yearnow[]=\Carbon::now()->year+2;
    
    $years=$data['years'] ?? $yearnow;
    
    $months=['Január','Február','Március','Április','Jájus','Június','Július','Augusztus','Szeptember','Október','November','Decenber'];
  
    @endphp

<!-- pdf gomb -->
<div id="editor"></div>
<button id="cmd">PDF Letöltés</button><button class='print-button'>
 <span>Nyomtatás</span>
</button>
<!-- pdf gomb -->

<!-- pdf script -->
<script>
var doc = new jsPDF();
var specialElementHandlers = {
    '#editor': function (element, renderer) {
        return true;
    }
};

$('#cmd').click(function () {   
    doc.fromHTML($('#naptar').html(), 15, 15, {
        'width': 170,
            'elementHandlers': specialElementHandlers
    });
    doc.save('sample-file.pdf');
});

$('.print-button').on('click', function() {  
    //window.print(); 
    var DocumentContainer = document.getElementById('naptar');
    var WindowObject = window.open('', "PrintWindow", "width=750,height=650,top=50,left=50,toolbars=no,scrollbars=yes,status=no,resizable=yes");
    WindowObject.document.writeln(DocumentContainer.innerHTML);
    WindowObject.document.close();
    WindowObject.focus();
    WindowObject.print();
    WindowObject.close();
    return false; // why false?
  });

</script>




     <br><br>        
        @foreach($years  as $year)
        <a href=" {!! MoHandF::url($param['routes']['base'],$param['getT'],['ev'=>$year]) !!}" 
          title="worker választás"
                              @if ($data['ev']==$year)    
                               class="btn btn-danger btn-xs">
                              @else
                               class="btn btn-warning btn-xs">
                              @endif         
                                        {!!    $year !!}
                                   
                                    </a>
                 @endforeach  
    <br><br>
                 @foreach($months  as $key=>$month)
                                    <a href=" {!! MoHandF::url($param['routes']['base'],$param['getT'],['ho'=>$key+1]) !!}" 
                                    title="worker választás"
                       @if ($data['ho']==$key+1)    
                               class="btn btn-danger btn-xs">
                              @else
                               class="btn btn-warning btn-xs">
                              @endif
                                        {!!    $month !!}
                                    
                                    </a>
                 @endforeach 

    <ul class="flex-container nowrap">
        <li class="flex-item "  style="height:40px;color:red;">Vasárnap</li>
        <li class="flex-item "  style="height:40px">Hétfő</li>
        <li class="flex-item "  style="height:40px">Kedd</li>
        <li class="flex-item "  style="height:40px">Szerda</li>
        <li class="flex-item "  style="height:40px">Csütörtök</li>
        <li class="flex-item "  style="height:40px">Péntek</li>
        <li class="flex-item "  style="height:40px; color:red;">Szombat</li>       
    </ul>
<div id="naptar">
        @foreach($data['calendar'] as $dt) 
         @if($dt['dayOfWeek']==0 or $dt['day']==1) 
              <ul class="flex-container nowrap" style="justify-content:flex-start"> 
                @if ($dt['day']==1 && $dt['dayOfWeek']>0 ) 
                    @for ($i = 0; $i < $dt['dayOfWeek']; $i++)
                       <li class="flex-item" style="border: 1px solid silver;"> </li>
                    @endfor
    
                @endif
         @endif
           @php
            $color = 'grey';
            $wishcolor =  'wishbase';
            if($dt['dayOfWeek']==0 || $dt['dayOfWeek']==6 ){ $color =  'red';}
            
            $daytype_id = $dt['daytype_id'] ?? 1; 
            if($dt['daytype_id']<1){$daytype_id = 1;}

            $wish_id=$dt['wish_id'] ?? $daytype_id ;
            
            if( $dt['datatype']!='base'){if($dt['daytype_id']>0 ){$color =  'green';}}
          
            if( $daytype_id!=$wish_id){$wishcolor = 'wishcolor';}

            @endphp
  

           <li class="flex-item" style="border: 1px solid silver;">
            <div style="color:{{ $color }}">{{ $dt['day'] }}., {{ $data['daytype'][$daytype_id] }}
             <!--   <a href="{!! MoHandF::url($param['routes']['base'],$param['getT'],['datum'=>$dt['datum']]) !!}" class="btn btn-success btn-xs"><i class="fa fa-plus" aria-hidden="true"></i>
                </a> -->

            </div>
          
                @foreach($dt['wrtimes'] as $time)  
               <div style="display: flex;width:100%;justify-content:flex-end;border: 1px solid silver; ">        
               <span style="color:blue">            {{ str_limit($time['start'], 5,'' ).'-'.str_limit($time['end'], 5,'' )  }}    
               </div> 
                @endforeach 
         
            </li>
     
        @if($dt['dayOfWeek']==6) 
        </ul > 
        @endif 
        @endforeach
        @if($dt['dayOfWeek']<6) 
                @for ($i = $dt['dayOfWeek']; $i < 6; $i++)
                       <li class="flex-item" style="border: 1px solid silver;"> </li>
                @endfor
        </ul > 
        @endif 
             
    </div>                

@endsection
