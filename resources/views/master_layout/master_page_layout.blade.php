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
  <title>A1 Driving School Accounting System</title>

  <!-- Favicons-->
  <link rel="icon" href="{{ URL::asset('images/favicon/favicon-32x32.png')}}" sizes="32x32">
  
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- CORE CSS-->
  <link href="{{ URL::asset('css/materialize.css')}}" rel="stylesheet" media="screen,projection">
  <link href="{{ URL::asset('css/style.css')}}" rel="stylesheet" media="screen,projection">
  <!-- Custome CSS-->    
  <link href="{{ URL::asset('css/custom/custom.css')}}" rel="stylesheet" media="screen,projection">

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="{{ URL::asset('js/plugins/prism/prism.css')}}" rel="stylesheet" media="screen,projection">
  <link href="{{ URL::asset('js/plugins/perfect-scrollbar/perfect-scrollbar.css')}}" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="{{ URL::asset('js/plugins/data-tables/css/jquery.dataTables.min.css')}}" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="{{ URL::asset('js/plugins/chartist-js/chartist.min.css')}}" type="text/css" rel="stylesheet" media="screen,projection">
</head>

<body>
  <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START HEADER -->
  <header id="header" class="page-topbar">
        <!-- start header nav-->
        @include('header.header')
        <!-- end header nav-->
  </header>
  <!-- END HEADER -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START MAIN -->
  <div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">
      <!-- START LEFT SIDEBAR NAV-->
      @include('sidebar.sidebar')
      <!-- END LEFT SIDEBAR NAV-->
      <!-- //////////////////////////////////////////////////////////////////////////// -->
      <!-- START CONTENT -->
      <section id="content">
        @include('errors.validation')
        @include('sidebar.breadcrumbs')
        @yield('content')
      </section>
      <!-- END CONTENT -->
    </div>
    <!-- END WRAPPER -->
  </div>
  <!-- END MAIN -->



  <!-- //////////////////////////////////////////////////////////////////////////// -->
  <!-- START FOOTER -->
  <footer class="page-footer red darken-1">
    @include('footer.footer')
  </footer>
    <!-- END FOOTER -->
   @include('scripts.scripts');
</body>

</html>