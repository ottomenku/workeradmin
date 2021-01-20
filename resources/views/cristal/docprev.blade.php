@php
//$docs=$data['doc'] ?? [];
$cats=$data['cat'] ?? [];
@endphp
<div class="container">

      <h4>{{$doc->name}}</h4>  
     <img src="/docprev/thumb/{{$doc->prev}}"  width="400px" alt=""> 
     <span>{{$doc->mote}}</span>


</div>

 