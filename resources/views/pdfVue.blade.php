@php
  $b='lllllllll';
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} </title>

 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> 
  -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@php
$now=$now =Carbon\Carbon::now();
$ev= $viewpar['id'] ?? $now->year;
$ho= $viewpar['id1'] ?? $now->month;
$week= $now->weekOfYear;
@endphp

 <script>
     window.storedToShow=@json($data['fulldata'] );

     window.storeds=@json($data['storeds'] ?? []) ;
 
  window.solver=JSON.parse(window.storeds['solverdata']); 
     window.ev={{$ev}} ; 
    window.ho={{$ho}} ; 
     window.workers=@json( $data['workers'] ?? []) ;
     window.workerids=@json( $data['workerids'] ?? []) ;
    window.par=@json($viewpar ?? []) ; 
    window.data=@json($data ?? []) ;
    
    window.workersselect=@json( $data['workersSelect'] ?? []) ;
    window.daytypes=@json( $data['daytypes'] ?? []) ;
    window.timetypes=@json( $data['timetypes'] ?? []) ;
    window.times=@json( $data['times'] ?? []) ;
    window.workerdays=@json($data['workerdays'] ?? []);
    
    window.basedays= @json($data['basedays'] ?? []);
    //window.cegbasedays=@json( $data['cegbasedays'] ?? []);

    window.calendar= @json($data['calendar'] ?? []);
    window.calendarbase= @json($data['calendarbase'] ?? []);
   
    window.baseroute=@json($viewpar['baseroute'] ?? 'm/ad.wor.time/');
    window.host=@json($viewpar['host'] ?? 'http://localhost:8000/'); 
   
</script>

    <!-- eredetiből-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  

</head>
<body>
    <div>
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li><a href="{{ url('/admin') }}">Dashboard <span class="sr-only">(current)</span></a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ url('/login') }}">Login</a></li>
                            <li><a class="nav-link" href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if (Session::has('flash_message'))
                <div class="container">
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ Session::get('flash_message') }}
                    </div>
                </div>
            @endif
            @if (Session::has('error_message'))
            <div class="container">
                <div class="alert alert-danger">
                    {{ Session::get('error_message') }}
                </div>
            </div>
        @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="container" dusk="category.index" >
                <div class="row">
 

                    <div  class="col-md-9">
                        <div class="card">
                            <div class="card-header">{{ $viewpar['taskheader'] ?? $viewpar['app_name'] ?? $viewpar['route'] ?? 'index' }}
                            </div>
                            <div class="card-body"> 
                                    <br>
                                    <div id="app"> 
                                        <!-- modal-------->
                                        
                                           
                                        
                                           
                                           <div>munkanapok : @{{solver.sumWorkerdays}}  </div>  
                                           <div class="" v-for="(wday, dkey) in solver.days">  
                                                @{{dkey}}:  @{{wday.days}} , összesen: @{{wday.sumdays}}
                                           </div>
                                           <div class="" v-for="(wtime, tkey) in solver.times">  
                                            @{{tkey}}:  @{{wtime.hours}} , összesen: @{{wtime.sumhours}}
                                       </div>
                                    
                                                <section class="th">
                                                                
                                                    <span>Hétfő</span>
                                                    <span>Kedd</span>
                                                    <span>Szerda</span>
                                                    <span>Csütörtök</span>
                                                    <span>Péntek</span>
                                                    <span>Szombat</span>
                                                    <span>Vasárnap</span>
                                                </section>
                                                <div class="week" v-for="(week, weekindex) in storedToShow.calendar">      
                                                    <div  v-bind:class="item.class" v-for="(item, datum) in week" v-bind:data-date="item.day"> 
                                                        <div  class="dayheader" v-if="item.name !== 'empty'">
                                                           
                                                            <span v-if="typeof basedays[datum] !== 'undefined'" class="dayhead" > 
                                                                @{{basedays[datum]}}
                                                            </span>
                                                        </div>    
                                                    <div class="daynumber" > @{{item.day}} </div>                 
                                                    <div v-if="typeof(workerdays.datekey[workerid])  !== 'undefined'" >
                                                        <div  v-bind:class="[workerdays.class]" v-for="workerdays in workerdays.datekey[workerid][datum]" >
                                                            @{{workerdays.daytype.name}} 
                                                                 
                                                        </div> 
                                                    </div> 
                                                    <div  v-if="typeof(times.datekey[workerid]) !== 'undefined'" >      
                                                        <div  v-bind:class="[time.class]"  v-for="(time) in times.datekey[workerid][datum]" >
                                                            @{{time.start.substring(0,5)}}- @{{time.end.substring(0,5)}}         
                                                           
                                                        </div>
                                                    </div> 
                                                    </div> 
                                                </div> 
                                            </div> 
                                        </div> 
                                    </div> 

                                </div> 
                        
            </div>
            </div>
        </main>

        <hr/>


    </div>
    <!-- Default bootstrap modal example -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>

                </div>
                <div id="modalbody" class="modal-body">

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(Session::has('flash_message'))
                    <!-- class="alert alert-success"  -->
                    <div id="alertdiv" class="alert {{ Session::get('alert-class', 'alert-info') }}">
                        {{ Session::get('flash_message') }}
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
 
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>

</body>
</html>
