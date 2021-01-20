@php
$savecalid=$data['savecal']['id'] ?? 0;
$savecalname=$data['savecal']['savecalname'] ?? '';
@endphp


{{ $savecalname }}

<div class="row">   
    <div class="col-md-9"  > 
     @include('calendar.ev_ho')    
    </div> 
    <div class="col-md-2"  >
         @include('calendar.print')
    </div> 
</div>             


<div id="naptarprint">          
@include('calendar.calendar')
</div>