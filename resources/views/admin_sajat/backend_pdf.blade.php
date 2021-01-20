<!DOCTYPE html>

<html lang="hu">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>DASHGUM - FREE Bootstrap Admin Template</title>

    <!-- Bootstrap core CSS -->
    <link href="/assets/css/bootstrap.css" rel="stylesheet">
    <!--  external css -->
     <link href="/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!--<link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet"> -->
    <!-- Custom styles for this template -->
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/style-responsive.css" rel="stylesheet">

    <link href="/assets/css/custom.css" rel="stylesheet" />
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]
<script src="/assets/js/jquery-1.8.3.min.js"></script>
-->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  
  <script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
  <!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

 <script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>
 
 </head>

<body>

<section id="container" >

     @yield('content')
   
      <!--main content end-->
 
  </section>

 
  </body>
</html>
