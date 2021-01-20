<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} </title> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  @php
    $solver=$data['solver'];
    $workerid=$data['workerid'] ;
    $fulldata=$data['fulldata'];
    $times= $fulldata['times']['datekey'][$workerid] ?? [];
    $workerdays= $fulldata['workerdays']['datekey'][$workerid] ?? [];
  
  @endphp
  <style>
    tbody:before, tbody:after { display: none; }  
  </style>
</head>
<body>
    <main class="py-4">

        <div class="container" dusk="category.index" >
            <div class="row">
 

                <div  class="col-md-9">
                    <div class="card">
                        <div class="card-header"> Header  </div>
                        <div class="card-body"> 
                                         
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
                            
                                    
                        <section class="th">
                                        
                            <span>Hétfő</span>
                            <span>Kedd</span>
                            <span>Szerda</span>
                            <span>Csütörtök</span>
                            <span>Péntek</span>
                            <span>Szombat</span>
                            <span>Vasárnap</span>
                        </section>

                        @foreach ($fulldata['calendar'] as $weekindex=> $week)
                         <div class="week" >      
                            @foreach ($week as $datum=> $item)
                            <div  class="dayheader" >
                             <!--   <span  class="dayhead" > basedays.datum </span> -->
                            <div class="daynumber" > {{$item['day']}} </div> 
                            @if(isset($workerdays[$datum]))
                                @foreach ($workerdays[$datum] as $workerday)         
                                    <div  class="{{$workerday['class']}}" >
                                        {{$workerday['daytype']['name']}} 
                                            
                                    </div>     
                                @endforeach
                              @endif  
                              @if(isset($times[$datum]))
                                @foreach ($times[$datum] as $time)
                                <div  class="{{$time['class']}}" >
                                    {{substr($time['start'],0,5)}}- {{substr($time['end'],0,5)}}        
                                </div>    
                                @endforeach 
                                @endif  
                               </div>     
                            @endforeach
                        </div>  
                        @endforeach 
      
                                   


                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </main>
</body>
</html>
