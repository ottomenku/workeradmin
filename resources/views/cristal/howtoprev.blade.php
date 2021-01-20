@php
//$howtos=$data['howto'] ?? [];
//$cats=$data['cat'] ?? [];
@endphp
<div class="container">

      <h4>{{$howto->name}}</h4>  
     <img src="/howtoprev/thumb/{{$howto->prev}}"  width="400px" alt=""> 
     <span>{{$howto->mote}}</span>


</div>

 