<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }} </title> 
 @php
    $solver=$data['solver'];
    $workerid=$data['workerid'] ;
    $fulldata=$data['fulldata'];
    $times= $fulldata['times']['datekey'][$workerid] ?? [];
    $workerdays= $fulldata['workerdays']['datekey'][$workerid] ?? [];
  
  @endphp

</head>
<body>

        <div  style="width:800px;">
                  
                            <div>munkanapok : {{$solver['sumWorkerdays']}}  </div>  
                            @foreach ($solver['days'] as $dkey=> $wday)
                                <div class="">  
                                    {{$dkey}}:  {{implode(',',$wday['days'])}} , összesen: {{$wday['sumdays']}}
                                </div>
                            @endforeach
                            @foreach ($solver['times'] as $tkey=> $wtime)
                            <div class="">  
                                {{$tkey}}:  {{implode(',',$wtime['hours'])}} , összesen: {{$wtime['sumhours']}}
                            </div>
                            @endforeach

        <table border="1">
                <tr>
                    <th>Hétfő</th>
                    <th>Kedd</th>
                    <th>Szerda</th>
                    <th>Csütörtök</th>
                    <th>Péntek</th>
                    <th>Szombat</th> 
                    <th>Vasárnap</th>   
                </tr>
                               
                
                                    

             @foreach ($fulldata['calendar'] as $weekindex=> $week)
            <tr>    
                @foreach ($week as $datum=> $item)
                <td>
                <div>{{$item['day']}}  </div>
                    @if(isset($workerdays[$datum]))
                        @foreach ($workerdays[$datum] as $workerday)            
                    <div>        {{$workerday['daytype']['name']}} </div>     
                        @endforeach
                    @endif  
                    @if(isset($times[$datum]))
                        @foreach ($times[$datum] as $time)
                  
                     <div>    {{substr($time['start'],0,5)}}- {{substr($time['end'],0,5)}}</div>         
                    
                        @endforeach 
                    @endif       
        
                </td>     
                @endforeach
            </tr> 
            @endforeach 
      
            </table>                         


     </div>
    
</body>
</html>
