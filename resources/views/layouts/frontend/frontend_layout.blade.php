<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MultiShop - Online Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href={{asset("plugins/fontawesome-free/css/all.css")}} rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href={{asset("frontend_plugins/lib/animate/animate.min.css")}} rel="stylesheet">
    <link href={{asset("frontend_plugins/lib/owlcarousel/assets/owl.carousel.min.css")}} rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href={{asset("css/frontend/style.css")}} rel="stylesheet">

    {{-- custom css --}}

    <link href={{asset("css/frontend/custom_style.css")}} rel="stylesheet">
</head>

<body>

 @include("layouts.frontend.header")


  @yield('content')
  

  @include("layouts.frontend.footer")


  <!-- JavaScript Libraries -->
  <script src={{asset("js/frontend/jquery.min.js")}}></script>
  <script src={{asset("js/frontend/jquery_ajax.js")}}></script>
  <script src={{asset("js/frontend/bootstrap.min.js")}}></script>
  <script src={{asset("js/frontend/bootstrap.bundle.min.js")}}></script>
  <script src={{asset("frontend_plugins/lib/easing/easing.min.js")}}></script>
  <script src={{asset("frontend_plugins/lib/owlcarousel/owl.carousel.min.js")}}></script>

  {{-- <!-- Contact Javascript File -->
  <script src="mail/jqBootstrapValidation.min.js"></script>
  <script src="mail/contact.js"></script> --}}

  <!-- Template Javascript -->
  <script src={{asset("js/frontend/main.js")}}></script>
</body>

</html>