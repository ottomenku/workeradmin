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

    <title>{{ config('app.name', 'MOworktime') }} </title>
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    



@php
$now=$now =Carbon\Carbon::now();
$year=$data['year'] ?? $now->year;
$month=$data['month'] ?? $now->month;
$viewparid = $viewpar['id'] ?? 0
@endphp
    <!-- eredetiből-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <script>

        window.viewpar=@json($viewpar ?? []) ;
        window.viewparid={{$viewparid}}; 
        window.year= {{$year}};   
        window.month={{$month}};
        
        $( document ).ready(function() {

                $('#checkAll').click(function (event) {
                    if (this.checked) {
                        $('.checkbox').each(function () { //loop through each checkbox
                            $(this).prop('checked', true); //check 
                        });
                    } else {
                        $('.checkbox').each(function () { //loop through each checkbox
                            $(this).prop('checked', false); //uncheck              
                        });
                    }
                });
      //  $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true,defaultDate: new Date()});
      //  $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true,defaultDate:+30}); 
          
  });
  
    </script>
</head>
<body>
    <div id="app" >  
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

<!-- sidebar------------------------------------------------------->     
           
@include('admin_crudgenerator.sidebar')

<!-- content------------------------------------------------------>    
@yield('content')

            </div>
            </div>
        </main>
      
 </div>  
 <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>  

    <style>
        .table th, .table td {
            padding: 0.25rem;
          }
      
          [class*="col-"],  /* Elements whose class attribute begins with "col-" */
          [class^="col-"] { /* Elements whose class attribute contains the substring "col-" */
            padding-left: 5px;
            padding-right: 0;
          }
        /* card ----------- */
        .card header {
          padding: 10px;
          background-color: rgb(41,73,130);
          color: #fff;
        }
      
        .usercard {
          box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
          transition: 0.3s;
        /*  pointer: 
          width: 20%;
          float:left;
          padding: 5px;*/
        }
        
        .usercard:hover {
          box-shadow: 0 8px 16px 0 rgba(14, 6, 128, 0.8);
        }
        
        .usercardcontainer {
          padding: 2px 16px;
        }
       
      
      /* checkbox radiobutton------------------------------ */
      
        /* The container */
        .checkcontainer {
          display: block;
          position: relative;
          padding-left: 35px;
          margin-bottom: 12px;
          cursor: pointer;
          font-size: 22px;
          -webkit-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
          user-select: none;
        }
        
        /* Hide the browser's default radio button */
        .checkcontainer input {
         position: absolute;
          opacity: 0;
          cursor: pointer;
        }
        
        /* Create a custom radio button */
        .checkmarkradio {
          position: absolute;
          top: 0;
          left: 0;
          height: 25px;
          width: 25px;
          background-color: #eee;
          border-radius: 50%;
        }
        
        /* On mouse-over, add a grey background color ------------*/
        .checkcontainer:hover input ~ .checkmarkradio {
          background-color: ;
        }
        
        /* When the radio button is checked, add a blue background */
        .checkcontainer input:checked ~ .checkmarkradio {
          background-color: #2196F3;
        }
        /* Show the indicator (dot/circle) when checked */
        .checkcontainer input:checked ~ .checkmarkradio:after {
          display: block;
        }
        
        /* Style the indicator (dot/circle) */
        .checkcontainer .checkmarkradio:after {
           top: 9px;
          left: 9px;
          width: 8px;
          height: 8px;
          border-radius: 50%;
          background: white;
        }
        
        /* közös */
        .checkmarkradio:after, .checkmarkcheckbox:after {
          content: "";
          position: absolute;
          display: none;
        }
        
        /* Create a custom checkbox */
        .checkmarkcheckbox {
          position: absolute;
          top: 0;
          left: 0;
          height: 25px;
          width: 25px;
          background-color: #eee;
        }
        
        
        /* On mouse-over, add a grey background color */
        .checkcontainer:hover input ~ .checkmarkcheckbox {
          background-color: ;
        }
        
        /* When the checkbox is checked, add a blue background ---------*/
        .checkcontainer input:checked ~ .checkmarkcheckbox {
          background-color: #2196F3;
        }
        /* On mouse-over, add a grey background color */
        .checkcontainer:hover input ~ .checkmarkcheckbox {
          background-color: ;
        }
        
        /* When the checkbox is checked, add a blue background */
        .checkcontainer input:checked ~ .checkmarkcheckbox {
          background-color: #2196F3;
        }
        
        /* Show the checkmark when checked */
        .checkcontainer input:checked ~ .checkmarkcheckbox:after {
          display: block;
        }
        
        /* Style the checkmark/indicator */
        .checkcontainer .checkmarkcheckbox:after {
          left: 9px;
          top: 5px;
          width: 5px;
          height: 10px;
          border: solid white;
          border-width: 0 3px 3px 0;
          -webkit-transform: rotate(45deg);
          -ms-transform: rotate(45deg);
          transform: rotate(45deg);
        }
        
        /* Create a custom checkbox2 */
        .checkmarkcheckbox2 {
          position: absolute;
          top: 0;
          left: 0;
        /*  height: 20px;*/
          width: 100%;
          background-color: #eee;
        }
        
        
        /* On mouse-over, add a grey background color */
        .checkcontainer:hover input ~ .checkmarkcheckbox2 {
          background-color: rgb(170, 109, 109);
        }
        
        /* When the checkbox is checked, add a blue background ---------*/
        .checkcontainer input:checked ~ .checkmarkcheckbox2 {
          background-color:rgb(170, 109, 109);
        }
        /* On mouse-over, add a grey background color */
        .checkcontainer:hover input ~ .checkmarkcheckbox2 {
          background-color:rgb(170, 109, 109) ;
        }
        
        
        /* Show the checkmark when checked */
        .checkcontainer input:checked ~ .checkmarkcheckbox2:after {
          display: block;
        }
        
        /* Style the checkmark/indicator */
        .checkcontainer .checkmarkcheckbox2:after {
          left: 9px;
          top: 5px;
          width: 5px;
          height: 10px;
          border: solid white;
          border-width: 0 3px 3px 0;
          -webkit-transform: rotate(45deg);
          -ms-transform: rotate(45deg);
          transform: rotate(45deg);
        }
        
         
         
      </style>
</body>
</html>
