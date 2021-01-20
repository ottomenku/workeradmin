<!DOCTYPE html>
<html lang="hu">
<head>
</head>
<body>
    <ul>
         @if ($data['noerror'])  
             <h3>Nincs hiba</h3>
                    @foreach($data['res'] as $key=>$val)
                    <li class="">
                        @if ($val !=null)
                            <span> {{$key}} : {{$val}} </span>
                        @endif
                    </li>
                    @endforeach
         @else   
          <h3>Error</h3> 
          <br/><span> {{serialize($data['errors'])}}  </span>
          @endif
    <ul>

</body>

</html