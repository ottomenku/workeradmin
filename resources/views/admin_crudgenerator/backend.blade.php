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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="/js/simplecolor.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 
 @php
 $now=$now =Carbon\Carbon::now();
 $ev=$data['ev'] ?? $viewpar['id'] ?? $viewpar['routpars']['id'] ?? $now->year;
 $ho=$data['ho'] ?? $viewpar['id1'] ?? $viewpar['routpars']['id1'] ??  $now->month;
 $week= $now->weekOfYear;
 @endphp
  

    <!-- eredetiből  llll-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <script>
            $(':checkbox[name=checkAll]').click (function () {
                $(':checkbox[name=id').prop('checked', this.checked);
              });
    </script>

    <script>
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
                var colors = [  
                '#ffff3d','990033', 'ff3366', 'cc0033', 'ff0033', 'ff9999', 'cc3366', 
                'cc0099', '990066', 'cc66cc', 'cc33cc', 'cc33ff', 'ffccff', '3399ff',  
                '6666cc', '6666ff', '666699', '333366', '333399', '330099', '3300cc', 
                '003366', '6699cc', '#0000FF', '006699', '3399cc', '0099cc', '66ccff',     
                '00ff99', '339966', '006633', '336633', '669966', '66cc66', '99ff99',
                'ccff00', '999900', 'cccc00', 'cccc33', '333300', '666600', '999933',  
                '996633', '330000', '663333', '996666', 'cc9999', '993333', 'cc6666',    
                'ff3333', 'cc3333', 'ff6666', '660000', '990000', 'cc0000',  '000000'];
              
                $('#color').simpleColor({ colors: colors });
                $('#background').simpleColor({ colors: colors });
        $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true,defaultDate: new Date()});
        $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true,defaultDate:+30});
        $("#myModal").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });
//crud generator blade----------------------------
            $(document).on('click', '.btn-add', function(e) {
                e.preventDefault();

                var tableFields = $('.table-fields'),
                    currentEntry = $(this).parents('.entry:first'),
                    newEntry = $(currentEntry.clone()).appendTo(tableFields);

                newEntry.find('input').val('');
                tableFields.find('.entry:not(:last) .btn-add')
                    .removeClass('btn-add').addClass('btn-remove')
                    .removeClass('btn-success').addClass('btn-danger')
                    .html('<span class="fa fa-minus"></span>');
            }).on('click', '.btn-remove', function(e) {
                $(this).parents('.entry:first').remove();

                e.preventDefault();
                return false;
            });
   //----------------------------------------------------------------         
    } );
    </script>
    <script>
    // call:  datasendModal({'url':'https://doc.mottoweb.hu/pay','formid':'billingdataform'})         
function datasendModal(dataout) {
    var datasend={};
    //var modalstatus='show';
   // if(dataout.modalstatus != null){modalstatus=dataout.modalstatus;}
    
    if(dataout.formid != null){
        datasend= $('form#'+dataout.formid).serialize();
    }  
    else{    
        if(dataout.data != null){datasend=dataout.data ;}
    }
  var csrf_token='{{ csrf_token() }}';
  
    $.ajax({
      url:dataout.url,
      //headers: {'X-CSRF-TOKEN':csrf_token},
      type: "POST",
     // beforeSend: function (xhr){ xhr.setRequestHeader('X-CSRF-TOKEN',csrf_token);},

     headers: {
       // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       'X-CSRF-TOKEN': csrf_token
    },
      data:datasend,
      dataType: 'json',
      success: function (data) { // session has script kezeli!
       if(!$('#myModal').is(':visible')){$('#myModal').modal('show');} 
        //  if(data.modalstatus != null){modalstatus=data.modalstatus;} //hide, show   
          $('#alertdiv').html(data.flash_message || '');
          $('#modalbody').html(data.html);
      //   $('#modalbody').html('csrf_token:'+csrf_token+'data.csrf_token:'+data.csrf_token);
       //  $.ajax.headers.X-CSRF-TOKEN=data.csrf_token;
          if(data.csrf_token != null){csrf_token = data.csrf_token;}
          if(data.gateway != null){document.location.href = data.gateway;}
          if(data.filedownload != null){ window.location=data.filedownload;}
      },
      error: function (jqXHR, exception) {
      alert('hiba:'+jqXHR.status);
      }
  });

};   
    </script>
</head>
<body>
    <div id="app">
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
                @include('admin_crudgenerator.sidebar')
               
                @yield('content')
            </div>
            </div>
        </main>

        <hr/>


    </div>
 <!-- Default bootstrap modal  ------------------>
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
<!-- info bootstrap modal ---------------------->
    <div class="modal fade" id="myModalInfo" tabindex="-1" role="dialog" aria-labelledby="myModalInfLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>

                </div>
                <div id="modalInfobody" class="modal-body">
                    @if(isset($viewpar['info']))
                             {!!  $viewpar['info'] !!}
                    @endif
               
                </div>

            </div>
        </div>
    </div>


</body>
</html>
