<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pick Me Up - Landing Page</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('assets-landingpage/img/pick me up.png')}}" rel="icon">
  <link href="{{asset('assets-landingpage/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets-landingpage/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets-landingpage/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets-landingpage/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets-landingpage/vendor/venobox/venobox.css')}}" rel="stylesheet">
  <link href="{{asset('assets-landingpage/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('assets-landingpage/vendor/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets-landingpage/vendor/aos/aos.css')}}" rel="stylesheet">

  @yield('css')

  <!-- Template Main CSS File -->
  <link href="{{asset('assets-landingpage/css/style.css')}}" rel="stylesheet">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


  <!-- =======================================================
  * Template Name: Bootslander - v2.1.0
  * Template URL: https://bootstrapmade.com/bootslander-free-bootstrap-landing-page-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
@include('sweet::alert')
 
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <!-- Uncomment below if you prefer to use an image logo -->
        <h1 class="text-light ml-4 float-right"><a href="index.html"><span>Pick Me Up</span></a></h1>
        <img src="{{asset('assets-landingpage/img/pick me up.png')}}" alt="" class="img-fluid">
      </div>

      @yield('navbar')

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">

    @yield('hero')

    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
      <defs>
        <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
      </defs>
      <g class="wave1">
        <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
      </g>
      <g class="wave2">
        <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
      </g>
      <g class="wave3">
        <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
      </g>
    </svg>

  </section><!-- End Hero -->

  <main id="main">
    @yield('content')
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="footer-info">
              <h3>Pick Me Up !</h3>
              <p class="pb-3"><em></em></p>
              <p>
                Indonesia<br>
                Banyuwangi, Jawa Timur<br><br>
                <strong>Phone:</strong> +1 8817 ****<br>
                <strong>Email:</strong> info@example.com<br>
              </p>
              <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4></h4>
            <p></p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Pick Me Up !</span></strong>. 2020
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/bootslander-free-bootstrap-landing-page-template/ -->
        Designed by <a href="https://bootstrapmade.com/">AF</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('assets-landingpage/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('assets-landingpage/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets-landingpage/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
  <script src="{{asset('assets-landingpage/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('assets-landingpage/vendor/venobox/venobox.min.js')}}"></script>
  <script src="{{asset('assets-landingpage/vendor/waypoints/jquery.waypoints.min.js')}}"></script>
  <script src="{{asset('assets-landingpage/vendor/counterup/counterup.min.js')}}"></script>
  <script src="{{asset('assets-landingpage/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
  <script src="{{asset('assets-landingpage/vendor/aos/aos.js')}}"></script>

  @yield('js')

  <!-- Template Main JS File -->
  <script src="{{asset('assets-landingpage/js/main.js')}}"></script>

  <script type="text/javascript">
    window.setInterval('refresh()', 300000); 	// Call a function every 10000 milliseconds (OR 10 seconds).

    // Refresh or reload page.
    function refresh() {
        window .location.reload();
    }
  </script>

</body>

</html>