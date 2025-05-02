<!doctype html>
<html lang="zxx">


<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/slick.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/odometer.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css')}}"/>
    <title>HOME - Megason Diagnostic Clinic, Sta. Rosa</title>
    <link rel="icon" type="image/png" href="assets/img/favicon.png"/>
</head>
<body>

<div class="preloader">
<div class="loader">
<div class="loader-outter"></div>
<div class="loader-inner"></div>
<div class="indicator">
<svg width="16px" height="12px">
<polyline id="back" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
<polyline id="front" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
</svg>
</div>
</div>
</div>


<header class="header-area">
<div class="top-header">
<div class="container">
<div class="row align-items-center">
<div class="col-lg-8">
<ul class="header-contact-info">
<li><i class="far fa-clock"></i> Mon - Fri 09:00 AM - 5:00 PM</li>
<li><i class="fas fa-phone"></i> Call Us: <a href="#">(049) 837 3689</a></li>
<li><i class="far fa-paper-plane"></i> <a href="{{url('/contact')}}">help@megasonclinicstarosa.com</a></li>
</ul>
</div>
<div class="col-lg-4">
<div class="header-right-content">
<ul class="top-header-social">

<!-- You can change Social Media Links from Below -->
<!-- <li><a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a></li>
<li><a href="https://twitter.com/"><i class="fab fa-twitter"></i></a></li>
<li><a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a></li>
<li><a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a></li> -->
<!-- You can change Social Media Links from Below -->

</ul>
<div class="lang-select">
    @if (Route::has('login'))
    <div class="top-right links">
        @auth
            <a href="{{ url('/home') }}">Home</a>
        @else
            <a href="{{ route('login') }}">Login</a>
        @endauth
    </div>
@endif
</div>
</div>
</div>
</div>
</div>
</div>

<div class="navbar-area">
<div class="fovia-responsive-nav">
<div class="container">
<div class="fovia-responsive-menu">
<div class="logo">
<a href="{{ url('/') }}">
<img src="{{asset('assets/img/logo.png')}}" alt="logo">
</a>
</div>
</div>
</div>
</div>
<div class="fovia-nav">
<div class="container">
<nav class="navbar navbar-expand-md navbar-light">
<a class="navbar-brand" href="{{ url('/') }}">
<img src="{{asset('assets/img/logo.png')}}" alt="logo">
</a>
<div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
<ul class="navbar-nav">
<li class="nav-item"><a href="{{ url('/') }}" class="nav-link ">Home</a></li>
<li class="nav-item"><a href="{{ url('/about') }}" class="nav-link active">About Us</a></li>
<li class="nav-item"><a href="{{ url('/services') }}" class="nav-link ">Services</a></li>
<li class="nav-item"><a href="{{ url('/contact') }}" class="nav-link">Contact</a></li>
</ul>
<div class="others-options">

<a href="{{ url('/contact') }}" class="btn btn-primary">Contact Us</a>
</div>
</div>
</nav>
</div>
</div>
</div>

</header>



<section class="page-title-area page-title-bg1">
<div class="d-table">
<div class="d-table-cell">
<div class="container">
<div class="page-title-content">
<h2>About Us</h2>
<ul>
<li><a href="{{ url('/') }}">Home</a></li>
<li>About Us</li>
</ul>
</div>
</div>
</div>
</div>
</section>


<section class="services-details-area ptb-100">
<div class="container">
<div class="row">
<div class="col-lg-8 col-md-12">
<div class="services-details-desc">
<div class="services-details-image">
<img src="{{asset('assets/img/services/10.jpg')}}" alt="image">
</div>
<h3>Mission</h3>
<p>To inspire hope, and contribute to health and well-being by providing the best care to every patient through integrated clinical practice, education and research.</p>
<h3>Vision</h3>
<p>Megason Diagnostic Clinic will provide an unparalleled experience as the most trusted partner for health care.</p>
<div class="services-details-features">
<div class="row">
<div class="col-lg-6 col-md-6 col-sm-6">
<ul class="services-features-list">
<!-- <li><i class="flaticon-check-mark"></i> The welfare of our patients.</li>
<li><i class="flaticon-check-mark"></i> Ensuring accuracy and timely delivery of reports.</li>
<li><i class="flaticon-check-mark"></i> Bring out the best in employed individuals</li> -->
</ul>
</div>
<div class="col-lg-6 col-md-6 col-sm-6">
<ul class="services-features-list">
<!-- <li><i class="flaticon-check-mark"></i> Affordable service.</li>
<li><i class="flaticon-check-mark"></i> Licensed practitioners</li>
<li><i class="flaticon-check-mark"></i> Helping the community</li> -->
</ul>
</div>
</div>
</div>
<p>The center has successfully provided quality medical services at a very reasonable cost under highly qualified medical professionals & efficient management. It has excellent infrastructure and a reassuring environment to aid services given by dedicated medical professionals.</p>

<ul class="wp-block-gallery columns-3">
<li class="blocks-gallery-item">
<figure>
<img src="{{asset('assets/img/blog/9.jpg')}}" alt="image">
</figure>
</li>
<li class="blocks-gallery-item">
<figure>
<img src="{{asset('assets/img/blog/8.jpg')}}" alt="image">
</figure>
</li>
<li class="blocks-gallery-item">
<figure>
<img src="{{asset('assets/img/blog/7.jpg')}}" alt="image">
</figure>
</li>
</ul>
</div>
</div>
<!-- <div class="col-lg-4 col-md-12">
<aside class="widget-area" id="secondary">
<section class="widget widget_services_list">
<h3 class="widget-title">Our Services</h3>
<ul>
<li><a href="{{url('/about')}}" class="active">Xray <i class="flaticon-arrow-pointing-to-right"></i></a></li>
<li><a href="{{url('/about')}}">Ultrasound<i class="flaticon-arrow-pointing-to-right"></i></a></li>
<li><a href="{{url('/about')}}">Laboratory <i class="flaticon-arrow-pointing-to-right"></i></a></li>
<li><a href="{{url('/about')}}">2D Echo<i class="flaticon-arrow-pointing-to-right"></i></a></li>
<li><a href="{{url('/about')}}">ECG<i class="flaticon-arrow-pointing-to-right"></i></a></li>
<li><a href="{{url('/about')}}">Pre- Employment<i class="flaticon-arrow-pointing-to-right"></i></a></li>
<li><a href="{{url('/about')}}">Medical Certificate<i class="flaticon-arrow-pointing-to-right"></i></a></li>
<li><a href="{{url('/about')}}">Executive General Check Up <i class="flaticon-arrow-pointing-to-right"></i></a></li>
</ul>
</section>
<section class="widget widget_download">
<h3 class="widget-title">Download</h3>
<ul>

<li><a href="https://drive.google.com/file/d/1MWN6PHSy00Z5wozXk5-QzLqzFBDHJekk/view?usp=sharing" target="_blank">Our Brochure PDF<i class="far fa-file-pdf"></i></a></li>
<li><a href="https://www.iso.org/files/live/sites/isoorg/files/store/en/PUB100304.pdf" target="_blank">Our ISO Certificate<i class="far fa-file-pdf"></i></a></li>
<li><a href="https://media.celgene.com/content/uploads/VOI-Europe.pdf" target="_blank">Medical Technology<i class="far fa-file-pdf"></i></a></li>
</ul>
</section> -->
<section >

</section>
</aside>
</div>
</div>
</div>
</section>




<section class="footer-area">
<div class="container">

<div class="row">
<div class="col-lg-3 col-md-6 col-sm-6">
<div class="single-footer-widget">
<div class="logo">
<a href="#"><img src="{{asset('assets/img/white-logo.png')}}" alt="image"></a>
<p >Megason Diagnostic Clinic network of multi-specialty clinics providing a wide range of outpatient healthcare assistance. From medical checkups, doctor consultations, health screening to other medical practices, we have all of these covered to give the best and quality care you deserve.</p>
</div>

</div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6">
<div class="single-footer-widget pl-5">
<h3>Services</h3>
<ul class="departments-list">
<li><a href="{{url('/services')}}#xray">X-Ray</a></li>
<li><a href="{{url('/services')}}#xray">Ultrasound</a></li>
<li><a href="{{url('/services')}}#xray">Laboratory</a></li>
<li><a href="{{url('/services')}}#Echo">2D Echo</a></li>
<li><a href="{{url('/services')}}#Echo">ECG</a></li>
<li><a href="{{url('/services')}}#Echo">Executive General Check Up </a></li>
<li><a href="{{url('/services')}}#Echo">Medical Certificate</a></li>
</ul>
</div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6">
<div class="single-footer-widget pl-5">
<h3>Pages Links</h3>
<ul class="links-list">
<li><a href="{{ url('/') }}">Home</a></li>
<li><a href="{{ url('/about') }}">About Us </a></li>
<li><a href="{{ url('/services') }}">Services </a></li>
<li><a href="{{ url('/contact') }}">Contact Us</a></li>
<li><a href="{{ url('/login') }}">Register/Login</a></li>

</ul>
</div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6">
<div class="single-footer-widget">
<h3>Opening Hours</h3>
<ul class="opening-hours">
<li>Monday <span>9:00AM - 5:00PM</span></li>
<li>Tuesday <span>9:00AM - 5:00PM</span></li>
<li>Wednesday <span>9:00AM - 5:00PM</span></li>
<li>Thursday <span>9:00AM - 5:00PM</span></li>
<li>Friday <span>9:00AM - 5:00PM</span></li>
<li>Saturday <span>CLOSED</span></li>
<li>Sunday <span>CLOSED</span></li>
</ul>
</div>
</div>
</div>
<div class="copyright-area">
<p>Copyright <i class="far fa-copyright"></i> 2021 Megason.<a href="#" target="_blank"></a></p>
</div>
</div>
</section>

<div class="go-top"><i class="fas fa-chevron-up"></i></div>


<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/js/slick.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.meanmenu.js')}}"></script>
<script src="{{asset('assets/js/jquery.appear.min.js')}}"></script>
<script src="{{asset('assets/js/odometer.min.js')}}"></script>
<script src="{{asset('assets/js/parallax.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('assets/js/wow.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.ajaxchimp.min.js')}}"></script>
<script src="{{asset('assets/js/form-validator.min.js')}}"></script>
<script src="{{asset('assets/js/contact-form-script.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
{{-- <script src="//code.tidio.co/0wnbdquecpcfohnghrj3cx7n5zqtqb1k.js" async></script> --}}
</body>


</html>