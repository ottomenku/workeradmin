<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <style> *{font-family: DejaVu Sans !important;} </style><!-- jók az ékezetes betúi --->
    <!-- include libraries(jQuery, bootstrap) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-hu-HU.js"></script>
<style>
 .cp{cursor: pointer;}

</style>

<script>
$(document).ready(function() {
    $('#summernote').summernote({
        lang: 'hu-HU', // default: 'en-US'
      //  placeholder: 'Hello stand alone ui',
      fontNames: ['DejaVu Sans'],
        tabsize: 2,
        height: 400,
        buttons: {
           worker : workerDataInsert,
           ceg: cegDataInsert
        },  
        toolbar: [
            ['mybutton', ['worker']],
            ['mybutton2', ['ceg']],
       //   ['style', ['style']],
       ['style', ['style','bold', 'italic', 'underline', 'clear']],
       ['font', ['strikethrough', 'superscript', 'subscript']],
       ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
       //   ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
  });

</script> 
</head>
<body>
    
    <div style="display:none;"><!-- editor adatbeszúró mezők -->
        <ul class="workerattribute d-none" style="cursor: pointer;">
           <li data-value="<<['worker']['name']>>">Név</li>
           <li data-value="<<['worker']['user']['email']>>">Email</li>
           <li data-value="<<['worker']['fullname']>>">Teljes név</li>
           <li data-value="<<['worker']['position']>>">Beosztás</li>
           <li data-value="<<['worker']['workername']>>">Egyesi név</li>
           <li data-value="<<['worker']['mothername']>>">Anyja neve</li>
           <li data-value="<<['worker']['city']>>">Lakhely (város)</li>
           <li data-value="<<['worker']['cim']>>">Cím</li>
           <li data-value="<<['worker']['tel']>>">Tel</li>
           <li data-value="<<['worker']['birth']>>">Születési idő</li>
           <li data-value="<<['worker']['birthplace']>>">Születési hely</li>  
           <li data-value="<<['worker']['ado']>>">Adószám</li>  
           <li data-value="<<['worker']['tb']>>">TB szám</li>  
           <li data-value="<<['worker']['start]>>">Munkaviszony kezdete</li> 
           <li data-value="<<['worker']['start]>>">Munkaviszony vége</li> 
   
       </ul> 
       
       <ul class="cegattribute d-none" style="cursor: pointer;">
           <li data-value="<<['ceg']['cegnev']>>">cégnév</li>
           <li data-value="<<['ceg']['adoszam']>>">Adószám</li>
           <li data-value="<<['ceg']['ugyvezeto']>>">Ügyvezető</li>
           <li data-value="<<['ceg']['szekhely']>>">Székhely (város)</li>    	
          <li data-value="<<['ceg']['cim']>>">cím</li>
       </ul>
       </div> 
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
            <div class="col-md-9"> 
            @yield('content')
            </div>
        </div>
        </div>
    </main>

    <hr/>


</div>
<script>    
    var workerDataInsert = function (context) {
        var ui = $.summernote.ui;
      
        var event = ui.buttonGroup([
            ui.button({
                contents: 'Dolgozói adatok beszúrása <i class="fa fa-caret-down" aria-hidden="true"></i><span class="caret"></span>',
              //  tooltip: 'When you insert',
                data: {
                    toggle: 'dropdown'
                }
            }),
            ui.dropdown({
                className: 'drop-default summernote-list cp',
                contents: $('.workerattribute').html(),
                callback: function ($dropdown) {                    
                    $dropdown.find('li').each(function () {
                        $(this).click(function () {  
                      $('#summernote').summernote('editor.restoreRange');
                        $('#summernote').summernote('editor.focus');
                           $('#summernote').summernote('editor.insertText', $(this).data('value'));
                       // $('#summernote').summernote('editor.insertText', 'fghsghsghg');

                        });
                    });
                }
            })
        ]);        

        return event.render();    // return button as jquery object
      }
      var cegDataInsert = function (context) {
        var ui = $.summernote.ui;
      
        var event = ui.buttonGroup([
            ui.button({
                contents: 'Cég adatok beszúrása <i class="fa fa-caret-down" aria-hidden="true"></i><span class="caret"></span>',
              //  tooltip: 'When you insert',
                data: {
                    toggle: 'dropdown'
                }
            }),
            ui.dropdown({
                className: 'drop-default summernote-list cp',
                contents: $('.cegattribute').html(),
                callback: function ($dropdown) {                    
                    $dropdown.find('li').each(function () {
                        $(this).click(function () {  
                      $('#summernote').summernote('editor.restoreRange');
                        $('#summernote').summernote('editor.focus');
                           $('#summernote').summernote('editor.insertText', $(this).data('value'));
                       // $('#summernote').summernote('editor.insertText', 'fghsghsghg');

                        });
                    });
                }
            })
        ]);        

        return event.render();    // return button as jquery object
      }
    /*  var preview = function (){
        
        var dataString =  $("#summernote").html();
        
        $.ajax({
          type: "POST",
          url: "/m/ad.man.doc.doctemplate/create",
          data: {
            "html": dataString,
            "_token": "{{ csrf_token() }}"
          },
          success: function(datas) {
            var w = window.open('about:blank');
            w.document.open();
            w.document.write(datas);
            w.document.close();
        },
        error: function(jqXHR) {
            showError("...");
        }
         /* success: function() {
            $('#form').html("<div id='message'></div>");
            $('#message').html("<h2>Message Submitted.</h2>")
            .append("<p>Thank you for contacting me, I will be in touch soon.</p>")
            .hide()
            .fadeIn(1500);
          }
        });
        return false;
        
        }*/
    </script> 
   
</body>
</html>