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
<li class="nav-item"><a href="{{url('/about')}}" class="nav-link ">About Us</a></li>
<li class="nav-item"><a href="{{url('/services')}}" class="nav-link active">Services</a></li>
<li class="nav-item"><a href="{{url('/contact')}}" class="nav-link">Contact</a></li>
</ul>
<div class="others-options">

<a href="{{url('/contact')}}" class="btn btn-primary">Contact Us</a>
</div>
</div>
</nav>
</div>
</div>
</div>

</header>


<section class="page-title-area page-title-bg4">
<div class="d-table">
<div class="d-table-cell">
<div class="container">
<div class="page-title-content">
<h2>Our Services</h2>
<ul>
<li><a href="{{ url('/') }}">Home</a></li>
<li>Services</li>
</ul>
</div>
</div>
</div>
</div>
</section>

 
<section class="services-area ptb-100 bg-f4f9fd">
<div class="container" id="xray">
<div class="row">
<div class="col-lg-4 col-md-6 col-sm-6">
<div class="single-services-box bg-1" >
<div class="icon">
<i class="flaticon-check-mark"></i>
</div>
<h3><a href="#" >X-Ray Services</a></h3>
<p>We provide treatment regarding your joints and other bone issues, and we will do an X-ray and then notify you what the problem is! X-rays are a form of electromagnetic radiation, just like visible light. </p>

</div>
</div>
<div class="col-lg-4 col-md-6 col-sm-6">
<div class="single-services-box bg-2">
<div class="icon">
 <i class="flaticon-check-mark"></i>
</div>
<h3><a href="#">Ultrasound Services</a></h3>
<p>An ultrasound allows your doctor to see problems with organs, vessels, and tissues without needing to make an incision. Unlike other imaging techniques, ultrasound uses no radiation. </p>

</div>
</div>
<div class="col-lg-4 col-md-6 col-sm-6">
<div class="single-services-box bg-3">
<div class="icon">
<i class="flaticon-check-mark"></i>
</div>
<h3><a href="#">Laboratory Services</a></h3>
<p>A medical laboratory or clinical laboratory is a laboratory where tests are carried out on clinical specimens to obtain information about a patient's health to aid in the diagnosis, treatment, and prevention of disease. </p>

</div>
</div>
<div class="col-lg-4 col-md-6 col-sm-6" id="Echo">
<div class="single-services-box bg-4">
<div class="icon">
<i class="flaticon-check-mark"></i>
</div>
<h3><a href="#">2D Echo Services</a></h3>
<p>2D Echo test is a type of Echocardiography, consisting of other styles such as Cardiac Ultrasonography and 3D Echo test. This test is used to create images of the heart, para-cardiac structures, and great vessels with the help of sound waves, which will then be visualized on a monitor for easy access. </p>

</div>
</div>
<div class="col-lg-4 col-md-6 col-sm-6">
<div class="single-services-box bg-5">
<div class="icon">
<i class="flaticon-check-mark"></i>
</div>
<h3><a href="#">ECG Services</a></h3>
<p>An electrocardiogram records the electrical signals in your heart. It's a standard and painless test used to detect heart problems and monitor your heart's health quickly. Electrocardiograms — also called ECGs or EKGs — are often done in a doctor's office, a clinic, or a hospital room. </p>

</div>
</div>
<div class="col-lg-4 col-md-6 col-sm-6">
<div class="single-services-box bg-6">
<div class="icon">
<i class="flaticon-check-mark"></i>
</div>
<h3><a href="#">Medical Certificate</a></h3>
<p>A medical certificate or doctor's certificate is a written statement from a physician or another medically qualified health care provider which attests to the result of a medical examination of a patient. It can serve as a "sick note" or evidence of a health condition. An aegrotat or sick note is a type of medical certificate excusing a student's absence from school for illness reasons. </p>

</div>
</div>
<div class="col-lg-4 col-md-6 col-sm-6">
<div class="single-services-box bg-7">
<div class="icon">
<i class="flaticon-check-mark"></i>
</div>
<h3><a href="#">General Check Up </a></h3>
<p>In a physical examination, medical examination, or clinical examination, a medical practitioner examines a patient for any possible medical signs or symptoms of a medical condition. It generally consists of a series of questions about the patient's medical history followed by an examination based on the reported symptoms.</p>

</div>
</div>
<div class="col-lg-4 col-md-6 col-sm-6">
<div class="single-services-box bg-8">
<div class="icon">
<i class="flaticon-check-mark"></i>
</div>
<h3><a href="#">Pre- Employment Testing</a></h3>
<p>A pre-employment test is an examination given to job candidates by a potential employer before hiring. The purpose of these types of tests is to determine personality traits and characteristics, cognitive abilities, job knowledge and skills, and behaviors. </p>

</div>
</div>
<div class="col-lg-4 col-md-6 col-sm-6">
<div class="single-services-box bg-9">
<div class="icon">
<i class="flaticon-check-mark"></i>
</div>
<h3><a href="#">Physical Examination</a></h3>
<p>A physical examination is an evaluation of the body and its functions using inspection, palpation (feeling with the hands), percussion (tapping with the fingers), and auscultation (listening). </p>

</div>
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