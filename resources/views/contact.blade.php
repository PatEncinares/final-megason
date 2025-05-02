{{-- // if($_POST)
// {
//    $name = $_POST['name'];
//     $email = $_POST['email'];
//     $message = $_POST['message'];
//     $subject = $_POST['msg_subject'];
//     $email = $_POST['email'];
//     $message = $_POST['message']; 
// /*
// // send email to administrator
// $to = "help@megasonclinicstarosa.com"; // email of administrator - receiver
// $from = "help@megasonclinicstarosa.com"; // email of sender
// $subject = "$subject"; // subject of email
// $body = "
// Hello Admin, a patient has sent you a new message: <br>
// Name of Patient: $name <br>
// Email ID: $email <br>
// Message: $message
// ";
// mail($to,$from,$subject,$body);
// echo "Thank you. We will contact you soon!";*/

// require("class.phpmailer.php");
//             $mail = new PHPMailer();
//             $mail->IsSMTP();
//             $mail->SMTPDebug = 0;
//             $mail->Host = 'megasonclinicstarosa.com';
//             $mail->SMTPAuth = 'true';
//             $mail->SMTPSecure = "tls";
//             $mail->Port = 587;
//             $mail->Username = 'no_reply@megasonclinicstarosa.com';
//             $mail->Password = 'G5?AeNai0P%#megason@@@1111';
//             $mail->From = 'no_reply@megasonclinicstarosa.com';
//             $mail->FromName = 'MEGASON';
//             $mail->AddAddress('help@megasonclinicstarosa.com');
//             $mail->IsHTML(true);
            
//             $mail->Subject = $subject;
//             $mail->Body = "
// Hello, a Patient has made a Contact us Message : <br>
// Name of Patient : $name <br>
// Email ID. : $email <br>
// Message : $message
// ";
//     if($mail->Send())
//     {
//        echo "Thank You. We will contact you soon!"; 
//     }
//     else
//     {
//         echo "Something went wrong.";
//     }
// }
// --}}
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
<li class="nav-item"><a href="{{ url('/') }}" class="nav-link active">Home</a></li>
<li class="nav-item"><a href="{{url('/about')}}" class="nav-link ">About Us</a></li>
<li class="nav-item"><a href="{{url('/services')}}" class="nav-link ">Services</a></li>
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


<!-- 

<section class="page-title-area page-title-bg4">
<div class="d-table">
<div class="d-table-cell">
<div class="container">
<div class="page-title-content">
<h2>Contact</h2>
<ul>
<li><a href="{{ url('/') }}">Home</a></li>
<li>Contact</li>
</ul>
</div>
</div>
</div>
</div>
</section> -->


<section class="contact-area ptb-100">
<div class="container">
<div class="section-title">
<span>Send Message</span>
<h2>Drop us a message for any query or to make an appointment.</h2>
<p>We would like to hear from you!</p>
</div>
<div class="row">
<div class="col-lg-4 col-md-12">

</div>
<div class="col-lg-5 col-md-12">
<div class="contact-info">
<ul>
<li>
<div class="icon">
<i class="fas fa-map-marker-alt"></i>
</div>
<span>Address</span>
 Unit 9, Levant Business Center, Diversion Rd Cor Rizal Blvd, Santa Rosa, 4026 Laguna
</li>
<li>
<div class="icon">
<i class="fas fa-envelope"></i>
</div>
<span>Email</span>
<a href="#"> help@megasonclinicstarosa.com</a>

</li>
<li>
<div class="icon">
<i class="fas fa-phone-volume"></i>
</div>
<span>Phone</span>
<a href="#">  (049) 837 3689</a>

</li>
</ul>
</div>
</div>
</div>
</div>
<div class="bg-map"><img src="{{asset('assets/img/bg-map.png')}}" alt="image"></div>
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