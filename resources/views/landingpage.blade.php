<!DOCTYPE html>
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
									<li>
										<i class="far fa-clock"></i> Mon - Fri 09:00 AM - 5:00 PM
									</li>
									<li>
										<i class="fas fa-phone"></i> Call Us: 
										<a href="#">(049) 837 3689</a>
									</li>
									<li>
										<i class="far fa-paper-plane"></i>
										<a href="{{url('/contact')}}">help@megasonclinicstarosa.com</a>
									</li>
								</ul>
							</div>
							<div class="col-lg-4">
								<div class="header-right-content">
									<ul class="top-header-social">
										<!-- You can change Social Media Links from Below -->
										<!-- <li>
											<a href="https://www.facebook.com/">
												<i class="fab fa-facebook-f"></i>
											</a>
										</li>
										<li>
											<a href="https://twitter.com/">
												<i class="fab fa-twitter"></i>
											</a>
										</li>
										<li>
											<a href="https://www.linkedin.com/">
												<i class="fab fa-linkedin-in"></i>
											</a>
										</li>
										<li>
											<a href="https://www.instagram.com/">
												<i class="fab fa-instagram"></i>
											</a>
										</li> -->
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
												<li class="nav-item">
													<a href="{{ url('/') }}" class="nav-link active">Home</a>
												</li>
												<li class="nav-item">
													<a href="{{ url('/about') }}" class="nav-link ">About Us</a>
												</li>
												<li class="nav-item">
													<a href="{{ url('/services') }}" class="nav-link ">Services</a>
												</li>
												<li class="nav-item">
													<a href="{{ url('/contact') }}" class="nav-link">Contact</a>
												</li>
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
					<div class="home-slides owl-carousel owl-theme">
						<div class="main-banner item-bg1">
							<div class="d-table">
								<div class="d-table-cell">
									<div class="container">
										<div class="main-banner-content">
											<span>MEGASON DIAGNOSTIC CLINIC</span>
											<h1>Best Diagnostics Centre in Laguna</h1>
											<p>Are you looking for the best clinic in town? Megason Diagnostic is the best among all Diagnostic Centres in Santa Rosa, Laguna. We provide a comprehensive range of imaging services and pathology tests at the best price. Our Diagnostic Centre in Sta. Rosa has over 10+ expert staff who deliver premium diagnostic imaging service and Pathology lab tests in an efficient, pleasant, and stress-free atmosphere. </p>
											<div class="btn-box">
												<a href="{{ url('/register') }}" class="btn btn-primary">Make an appointment
													<i class="fas fa-bell"></i>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="circle-shape1">
								<img src="assets/img/circle-shape1.png" alt="image">
								</div>
								<div class="circle-shape2">
									<img src="assets/img/circle-shape2.png" alt="image">
									</div>
									<div class="shape1">
										<img src="assets/img/shape/1.png" alt="image">
										</div>
									</div>
									<div class="main-banner item-bg2">
										<div class="d-table">
											<div class="d-table-cell">
												<div class="container">
													<div class="main-banner-content">
														<span>Welcome to the Megason Website. Feel free!</span>
														<h1>Premier Outpatient & Diagnostic Centre</h1>
														<p>One-stop clinic with renowned consultants</p>
														<div class="btn-box">
															<a href="{{ url('/register') }}" class="btn btn-primary">Make an appointment 
																<i class="fas fa-bell"></i>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="circle-shape1">
											<img src="assets/img/circle-shape1.png" alt="image">
											</div>
											<div class="circle-shape2">
												<img src="assets/img/circle-shape2.png" alt="image">
												</div>
												<div class="shape1">
													<img src="assets/img/shape/1.png" alt="image">
													</div>
												</div>
												<div class="main-banner item-bg3">
													<div class="d-table">
														<div class="d-table-cell">
															<div class="container">
																<div class="main-banner-content">
																	<span>Health Service</span>
																	<h1>Your Health is Our Top Priority</h1>
																	<p>We use state-of-the-art equipment, the most advanced technology, and professional faculty to provide a superior patient experience with world-class reporting. Our Diagnostic center is located in the heart of Laguna, convenient for people of all ages.</p>
																	<div class="btn-box">
																		<a href="{{ url('/register') }}" class="btn btn-primary">Make an appointment 
																			<i class="fas fa-bell"></i>
																		</a>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="circle-shape1">
														<img src="assets/img/circle-shape1.png" alt="image">
														</div>
														<div class="circle-shape2">
															<img src="assets/img/circle-shape2.png" alt="image">
															</div>
															<div class="shape1">
																<img src="assets/img/shape/1.png" alt="image">
																</div>
															</div>
														</div>
														<section class="main-services-area ptb-50">
															<div class="container">
																<div class="section-title">
																	<!-- <h2>Our Core Values</h2>
																	<p>People choose us among other Diagnostic centers in Sta. Rosa because we offer high-quality services at the best price. </p>
																</div>
																<div class="row">
																	<div class="col-lg-3 col-md-6 col-sm-6">
																		<div class="main-services-box">
																			<div class="icon">
																				<i class="flaticon-doctor"></i>
																			</div>
																			<h3>
																				<a href="#">Dedication</a>
																			</h3>
																		</div>
																	</div>
																	<div class="col-lg-3 col-md-6 col-sm-6">
																		<div class="main-services-box">
																			<div class="icon">
																				<i class="flaticon-dental-chair"></i>
																			</div>
																			<h3>
																				<a href="#">Determination</a>
																			</h3>
																		</div>
																	</div>
																	<div class="col-lg-3 col-md-6 col-sm-6">
																		<div class="main-services-box">
																			<div class="icon">
																				<i class="flaticon-care"></i>
																			</div>
																			<h3>
																				<a href="#">Discipline</a>
																			</h3>
																		</div>
																	</div>
																	<div class="col-lg-3 col-md-6 col-sm-6">
																		<div class="main-services-box">
																			<div class="icon">
																				<i class="flaticon-brain"></i>
																			</div>
																			<h3>
																				<a href="#">Excellence</a>
																			</h3> -->
																		</div>
																	</div>
																</div>
															</div>
															<div class="shape2">
																<img src="assets/img/shape/2.png" alt="image">
																</div>
															</section>
															<section class="about-area">
																<div class="container-fluid p-0">
																	<div class="row m-0">
																		<div class="col-lg-6 col-md-12 p-0">
																			<div class="about-image">
																				<img src="assets/img/front.jpg" alt="image">
																				</div>
																			</div>
																			<div class="col-lg-6 col-md-12 p-0">
																				<div class="about-content">
																					<span>About Us</span>
																					<h2>The Roots of Megason Diagnostic Clinic.
	
																						<BR>Since 2021
																						</h2>
																						<p>
																						Luis Salvador Capuchino  started this clinic with the motivation to help society. The Megason Clinic is the leading diagnostic services provider in Sta. Rosa. We offer a wide range of clinical laboratory tests and Imaging. You can access Diagnostic services at a time to suit you.The center has successfully provided quality medical services at a very reasonable cost under highly qualified medical professionals & efficient management. It has excellent infrastructure and a reassuring environment to aid services given by dedicated medical professionals.</p>
																						<p>Everything he does is governed by objectives.</p>
																						<ul>
																							<!-- <li>
																								<i class="flaticon-check-mark"></i> The welfare of our patients.
																							</li>
																							<li>
																								<i class="flaticon-check-mark"></i> Ensuring accuracy and timely delivery of reports.
																							</li>
																							<li>
																								<i class="flaticon-check-mark"></i> Bring out the best in our employed individuals
																							</li> -->
																						</ul>
																						<a href="{{ url('/about') }}" class="btn btn-primary">Know More 
																							<i class="flaticon-right-chevron"></i>
																						</a>
																					</div>
																				</div>
																			</div>
																		</div>
																	</section>
																	<!-- <section class="fun-facts-area ptb-100">
																		<div class="container">
																			<div class="row"> -->
																				<!-- <div class="col-lg-3 col-md-3 col-sm-3 col-6">
																					<div class="single-fun-facts"> -->
																						<!-- <div class="icon">
																							<i class="flaticon-doctor-1"></i>
																						</div>
																						<h3>
																							<span class="odometer" data-count="10"></span>
																							<span class="optional-icon">+</span>
																						</h3>
																						<p>Expert Doctors</p>
																					</div>
																				</div>
																				<div class="col-lg-3 col-md-3 col-sm-3 col-6">
																					<div class="single-fun-facts">
																						<div class="icon">
																							<i class="flaticon-light-bulb"></i>
																						</div>
																						<h3>
																							<span class="odometer" data-count="20"></span>
																							<span class="optional-icon">K</span>
																						</h3>
																						<p>Problem Solved</p>
																					</div>
																				</div>
																				<div class="col-lg-3 col-md-3 col-sm-3 col-6">
																					<div class="single-fun-facts">
																						<div class="icon">
																							<i class="flaticon-science"></i>
																						</div>
																						<h3>
																							<span class="odometer" data-count="11"></span>
																							<span class="optional-icon">Yrs</span>
																						</h3>
																						<p>Experiences</p>
																					</div>
																				</div>
																				<div class="col-lg-3 col-md-3 col-sm-3 col-6">
																					<div class="single-fun-facts">
																						<div class="icon">
																							<i class="flaticon-trophy"></i>
																						</div>
																						<h3>
																							<span class="odometer" data-count="5"></span>
																							<span class="optional-icon">+</span>
																						</h3>
																						<p>Award Winning</p>
																					</div> -->
																				</div>
																			</div>
																		</div>
																	</section>
																	<section class="feedback-area ptb-100">
																		<div class="container">
																			<!-- <div class="section-title">
																				<span>Feedback</span>
																				<h2>Our Happy Clients Says About Us</h2>
																				<p>
The Megason Clinic is the leading diagnostic services provider in Sta. Rosa. We offer a wide range of clinical laboratory tests and Imaging. You can access Diagnostic services at a time to suit you.</p>
																			</div>
																			<div class="feedback-slides">
																				<div class="client-thumbnails">
																					<div>
																						<div class="item">
																							<div class="img-fill">
																								<img src="assets/img/client-image/2.jpg" alt="client">
																								</div>
																							</div>
																							<div class="item">
																								<div class="img-fill">
																									<img src="assets/img/client-image/4.jpg" alt="client">
																									</div>
																								</div>
																								<div class="item">
																									<div class="img-fill">
																										<img src="assets/img/client-image/1.jpg" alt="client">
																										</div>
																									</div>
																									<div class="item">
																										<div class="img-fill">
																											<img src="assets/img/client-image/5.jpg" alt="client">
																											</div>
																										</div>
																										<div class="item">
																											<div class="img-fill">
																												<img src="assets/img/client-image/1.jpg" alt="client">
																												</div>
																											</div>
																											<div class="item">
																												<div class="img-fill">
																													<img src="assets/img/client-image/3.jpg" alt="client">
																													</div>
																												</div>
																												<div class="item">
																													<div class="img-fill">
																														<img src="assets/img/client-image/5.jpg" alt="client">
																														</div>
																													</div>
																													<div class="item">
																														<div class="img-fill">
																															<img src="assets/img/client-image/3.jpg" alt="client">
																															</div>
																														</div>
																													</div>
																												</div>
																												<div class="client-feedback">
																													<div>
																														<div class="item">
																															<div class="single-feedback">
																																<h3>Bong Go</h3>
																																<span>VIP Patient</span>
																																<p>Thanks for the last minute X-ray. Appointment was quick and easy. Got my scan report on the same day via my Email.
</p>
																															</div>
																														</div>
																														<div class="item">
																															<div class="single-feedback">
																																<h3>Andrew Lee</h3>
																																<span>Patient</span>
																																<p>All the experience was amazing. Highly recommended clinic nearby Laguna.</p>
																															</div>
																														</div>
																														<div class="item">
																															<div class="single-feedback">
																																<h3>Jessica Warner</h3>
																																<span>Patient</span>
																																<p>What a great experience with this diagnostics center! The Center is very clean & well maintained. All the staff is polite and supportive.
</p>
																															</div>
																														</div>
																														<div class="item">
																															<div class="single-feedback">
																																<h3>Ross Taylor</h3>
																																<span>Patient</span>
																																<p> I visited this clinic, and they guided me very nicely. The staff and doctor are amicable. Outstanding service! Thank you for the excellent service. I will recommend this clinic.</p>
																															</div>
																														</div>
																														<div class="item">
																															<div class="single-feedback">
																																<h3>Ms. Michelle Gomez</h3>
																																<span>Manager</span>
																																<p>We are pushing for the primary goal of giving quality care and treatment to our clients. </p>
																															</div>
																														</div>
																														<div class="item">
																															<div class="single-feedback">
																																<h3>Ms. Camela Alfaro</h3>
																																<span>President</span>
																																<p>We are proud to launch one of the best diagnostic centers.</p>
																															</div>
																														</div>
																														<div class="item">
																															<div class="single-feedback">
																																<h3>Mr. Patrick Encenares</h3>
																																<span>CEO</span>
																																<p>This clinic is a potential world renowned because of our practice of treatment for a great price.</p>
																															</div>
																														</div>
																														<div class="item">
																															<div class="single-feedback">
																																<h3>Karen Nina</h3>
																																<span>Patient</span>
																																<p>Great experience with this diagnostic center which was very neat and well-maintained. All staff are kind and supportive.
</p>
																															</div>
																														</div>
																													</div>
																													<button class="prev-arrow slick-arrow">
																														<i class='flaticon-left-arrow'></i>
																													</button>
																													<button class="next-arrow slick-arrow">
																														<i class='flaticon-arrow-pointing-to-right'></i>
																													</button>
																												</div>
																											</div> -->
																										</div>
																									</section>
																									<section class="footer-area">
																										<div class="container">
																											<div class="row">
																												<div class="col-lg-3 col-md-6 col-sm-6">
																													<div class="single-footer-widget">
																														<div class="logo">
																															<a href="#">
																																<img src="assets/img/white-logo.png" alt="image">
																																</a>
																																<p >Megason Diagnostic Clinic network of multi-specialty clinics providing a wide range of outpatient healthcare assistance. From medical checkups, doctor consultations, health screening to other medical practices, we have all of these covered to give the best and quality care you deserve.</p>
																															</div>
																														</div>
																													</div>
																													<div class="col-lg-3 col-md-6 col-sm-6">
																														<div class="single-footer-widget pl-5">
																															<h3>Services</h3>
																															<ul class="departments-list">
																																<li>
																																	<a href="{{ url('services') . '#xray' }}">X-Ray</a>
																																</li>
																																<li>
																																	<a href="{{ url('services') . '#xray' }}">Ultrasound</a>
																																</li>
																																<li>
																																	<a href="{{ url('services') . '#xray' }}">Laboratory</a>
																																</li>
																																<li>
																																	<a href="{{ url('services') . '#Echo' }}">2D Echo</a>
																																</li>
																																<li>
																																	<a href="{{ url('services') . '#Echo' }}">ECG</a>
																																</li>
																																<li>
																																	<a href="{{ url('services') . '#Echo' }}">Executive General Check Up </a>
																																</li>
																																<li>
																																	<a href="{{ url('services') . '#Echo' }}">Medical Certificate</a>
																																</li>
																															</ul>
																														</div>
																													</div>
																													<div class="col-lg-3 col-md-6 col-sm-6">
																														<div class="single-footer-widget pl-5">
																															<h3>Pages Links</h3>
																															<ul class="links-list">
																																<li>
																																	<a href="{{ url('/') }}">Home</a>
																																</li>
																																<li>
																																	<a href="{{ url('/about') }}">About Us </a>
																																</li>
																																<li>
																																	<a href="{{ url('/services') }}">Services </a>
																																</li>
																																<li>
																																	<a href="{{ url('/contact') }}">Contact Us</a>
																																</li>
																																<li>
																																	<a href="{{ url('/login') }}">Registration/Login</a>
																																</li>
																															</ul>
																														</div>
																													</div>
																													<div class="col-lg-3 col-md-6 col-sm-6">
																														<div class="single-footer-widget">
																															<h3>Opening Hours</h3>
																															<ul class="opening-hours">
																																<li>Monday 
																																	<span>9:00AM - 5:00PM</span>
																																</li>
																																<li>Tuesday 
																																	<span>9:00AM - 5:00PM</span>
																																</li>
																																<li>Wednesday 
																																	<span>9:00AM - 5:00PM</span>
																																</li>
																																<li>Thursday 
																																	<span>9:00AM - 5:00PM</span>
																																</li>
																																<li>Friday 
																																	<span>9:00AM - 5:00PM</span>
																																</li>
																																<li>Saturday 
																																	<span>CLOSED</span>
																																</li>
																																<li>Sunday 
																																	<span>CLOSED</span>
																																</li>
																																
																															</ul>
																														</div>
																													</div>
																												</div>
																												<div class="copyright-area">
																													<p>Copyright 
																														<i class="far fa-copyright"></i> 2021 Megason.
																														<a href="#" target="_blank"></a>
																													</p>
																												</div>
																											</div>
</section>
<div class="go-top">
    <i class="fas fa-chevron-up"></i>
</div>
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

</body>
</html>