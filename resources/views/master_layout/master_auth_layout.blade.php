<!DOCTYPE html>
<html lang="en">

<!--================================================================================
	Item Name: Materialize - Material Design Admin Template
	Version: 3.1
	Author: GeeksLabs
	Author URL: http://www.themeforest.net/user/geekslabs
================================================================================ -->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
  <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
  <title>A1 Driving School Accounting System | Login</title>

  <!-- Favicons-->
  <link rel="icon" href="{{ URL::asset('images/favicon/favicon-32x32.png')}}" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="{{ URL::asset('images/favicon/apple-touch-icon-152x152.png')}}">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
  <!-- For Windows Phone -->


  <!-- CORE CSS-->
  <link href="{{ URL::asset('css/materialize.css')}}" rel="stylesheet" media="screen,projection">
  <link href="{{ URL::asset('css/style.css')}}" rel="stylesheet" media="screen,projection">
  <!-- Custome CSS-->    
  <link href="{{ URL::asset('css/custom/custom.css')}}" rel="stylesheet" media="screen,projection">

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="{{ URL::asset('js/plugins/prism/prism.css')}}" rel="stylesheet" media="screen,projection">
  <link href="{{ URL::asset('js/plugins/perfect-scrollbar/perfect-scrollbar.css')}}" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="{{ URL::asset('js/plugins/chartist-js/chartist.min.css')}}" type="text/css" rel="stylesheet" media="screen,projection">
</head>

<body>

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START MAIN -->
  <div id="main" style="padding-left: 0;">
    <!-- START WRAPPER -->
    <div class="wrapper">

      <!-- //////////////////////////////////////////////////////////////////////////// -->

      <!-- START CONTENT -->
      <section id="content">
        @yield('content')
      </section>
      <!-- END CONTENT -->


    <!-- ================================================
    Scripts
    ================================================ -->
    
    <!-- jQuery Library -->
    <script type="text/javascript" src="{{ URL::asset('js/plugins/jquery-1.11.2.min.js')}}"></script>
    <!--materialize js-->
    <script type="text/javascript" src="{{ URL::asset('js/materialize.js')}}"></script>
    <!--prism
    <script type="text/javascript" src="../js/prism/prism.js"></script>-->
    <!--scrollbar-->
    <script type="text/javascript" src="{{ URL::asset('js/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <!-- chartist -->
    <script type="text/javascript" src="{{ URL::asset('js/plugins/chartist-js/chartist.min.js')}}"></script>
    
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="{{ URL::asset('js/plugins.js')}}"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="{{ URL::asset('js/custom-script.js')}}"></script>
    
</body>

</html>