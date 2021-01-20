<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Landing page, Template, Registration, Landing">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Grayrids">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Doc master</title>
    
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> nem működik vele a modallscript 
    <link rel="stylesheet" href="/cristal/css/bootstrap.min.css">
    <script src="/cristal/js/jquery-min.js"></script>
 -->
 <link rel="stylesheet" href="/cristal/css/line-icons.css">
<link rel="stylesheet" href="/cristal/css/main.css">
   <link rel="stylesheet" href="/cristal/css/font-awesome.min.css">
   <link rel="stylesheet" href="/cristal/css/responsive.css">
<!-- 
   

   
   
    <link rel="stylesheet" href="/cristal/css/owl.carousel.css">
    <link rel="stylesheet" href="/cristal/css/owl.theme.css">
    <link rel="stylesheet" href="/cristal/css/nivo-lightbox.css">
    <link rel="stylesheet" href="/cristal/css/magnific-popup.css">
    <link rel="stylesheet" href="/cristal/css/animate.css">
    <link rel="stylesheet" href="/cristal/css/menu_sideslide.css">
    
    -->
    
    <script>
            $( document ).ready(function() {
            $("#myModal").on("show.bs.modal", function(e) {
                var link = $(e.relatedTarget);
                $(this).find(".modal-body").load(link.attr("href"));
            });
    
            
            }); 
            
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
 
    <!-- Header Section Start -->

    <header id="video-area" style="background-size: cover; background-image: url('/images/background5.jpg');" data-stellar-background-ratio="0.5">



        
       <!-- <div id="block" data-vide-bg="cristal/video/video"></div> -->
          <div id="block"></div>
        <div class="fixed-top" style="background-color:#004C6D">

            <div class="container"  >
                <nav style="background-color:#004C6D" class="navbar navbar-expand-lg navbar navbar-dark ">
               <!--         <a class="navbar-brand" href="#">Navbar</a> -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"></span>
                        </button>
                        <div  class="collapse navbar-collapse" id="navbarNavDropdown">
                          <ul class="navbar-nav">
                           

                                    <!-- Authentication Links -->
                                    @guest
                             <li class="nav-item">       
                                  <a class="nav-link" data-remote="false" data-toggle="modal" data-target="#myModal" style="font-size: 1.2em;" dusk="login-link" href="{{ url('/loginmodal') }}">Belépés </a> 
                               <!--   <span class="nav-link" data-remote="false" data-toggle="modal" data-target="#myModal" style="font-size: 1.2em;" dusk="login-link" href="{{ url('/loginmodal') }}">Belépés </span> -->
                            </li>      
                              <li class="nav-item">       
                                 <!--    <a class="nav-link" data-remote="false" data-toggle="modal" data-target="#myModal" style="font-size: 1.2em;"  dusk="registration-link" href="{{ url('/regmodal') }}"> Regisztráció</a>-->
                                <a class="nav-link" style="font-size: 1.2em;"   href="{{ url('/register') }}"> Regisztráció</a>
                                </li>  
                                    @else
                                    <li class="nav-item">  
                                    <a class="nav-link" style="font-size: 1.2em;" dusk="logout-link" href="{{ url('/logout') }}" onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                        Kilépés
                                    </a>
                
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                
                                    @endguest
                            </li>
                            <li class="nav-item active">
                                    <a class="nav-link"style="font-size: 1.2em;"  href="#services">Szolgáltatásaink <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item active">
                              <a class="nav-link"  style="font-size: 1.2em;"href="#pricing">Népszerű Csomagjaink</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" style="font-size: 1.2em;" href="#blog">Híreink</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" style="font-size: 1.2em;" href="#contact">Kapcsolat</a>
                            </li>      

                        <!--    <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dropdown link
                              </a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                              </div>
                            </li>-->
                          </ul>
                        </div>
                      </nav>

        </div>



        </div>
        <div  class="overlay overlay-2"></div>

        @yield('content')


        <!-- Footer Section Start -->
        <footer>
            <div class="container" >
                <div class="row">
                    <div class="col-md-12">
                        <div class="social-icons wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="0.3s">
                            <ul>
                                <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li class="pinterest"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                <li class="dribbble"><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            </ul>
                        </div>
                        <div class="site-info wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="0.3s">
                            <p>All copyrights reserved &copy; 2017 - Designed & Developed by <a rel="nofollow"
                                    href="https://uideck.com">UIdeck</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Section End -->

        <!-- Go To Top Link -->
        <a href="#" class="back-to-top">
            <i class="lnr lnr-arrow-up"></i>
        </a>

     <!--    <div id="loader">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div> -->

        <!-- Default bootstrap modal example -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>

                    </div>
                    <div id="modalbody" class="modal-body" style="overflow:hidden;">

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
         

      
                 <!-- jQuery first, then Tether, then Bootstrap JS. 
  <script src="/cristal/js/jquery.nav.js"></script>                  
<script src="/cristal/js/bootstrap.min.js"></script>
        <script src="/cristal/js/tether.min.js"></script>
       
        <script src="/cristal/js/classie.js"></script>
        <script src="/cristal/js/mixitup.min.js"></script>
        <script src="/cristal/js/nivo-lightbox.js"></script>
        <script src="/cristal/js/owl.carousel.min.js"></script>
        <script src="/cristal/js/jquery.stellar.min.js"></script>
        
        <script src="/cristal/js/smooth-scroll.js"></script>
        <script src="/cristal/js/wow.js"></script>
        <script src="/cristal/js/menu.js"></script>
        <script src="/cristal/js/jquery.vide.js"></script>
        <script src="/cristal/js/jquery.counterup.min.js"></script>
        <script src="/cristal/js/jquery.magnific-popup.min.js"></script>
        <script src="/cristal/js/waypoints.min.js"></script>
        <script src="/cristal/js/form-validator.min.js"></script>
        <script src="/cristal/js/contact-form-script.js"></script>  
         <script src="/cristal/js/main.js"></script> 
         
-->
</body>

</html