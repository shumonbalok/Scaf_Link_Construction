<!DOCTYPE html>
<html lang="en">

<head>
	<!--meta tags-->
	<meta charset="UTF-8">
	<meta name="description" content="One Page Construction Website">
	<meta name="keywords" content="HTML,CSS,Bootstrap,JavaScript,Jquery">
	<meta name="author" content="Template.net">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{setting('site.title')}}</title>
	<link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
	<link rel="stylesheet" href="{{asset('frontend/css/owl.carousel.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('frontend/css/aos.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/style.css')}}">
	<!--Google fonts-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900&display=swap"
		rel="stylesheet">
</head>

<body>
	<!-- header start -->
	<header>
		<div class="container">
			<nav class="navbar navbar-expand-lg navbar-light">
				<a class="navbar-brand" href="{{url('/')}}">SCAF-LINK</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse"
					data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
					aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item active">
							<a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="#About us">About us</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="#Projects">Projects </a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="#Our Services">Our Services</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="#Blog">Blog</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="#Contact">Contact</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</header>
	<!-- header end -->

	<!-- banner start -->
	<section class="banner">
		<div class="gradient"></div>
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="banner-inner" data-aos="fade-up" data-aos-duration="1000">
						<h1>{{setting('site.top_headline')}}</h1>
						{{-- <button type="button" class="btn">Get Started</button> --}}
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- banner end -->

	<!-- counting start -->
	<section class="counting" id="Projects">
		<div class="container">
			<div class="counting-inner">
				<div class="gradient"></div>
				<div class="row text-center">
					<div class=" col-12 counting-inner-content">
						<div class="col-md-3 ">
							<div class="counter">
								<h2><span class="timer count-title count-number" data-to="25"
										data-speed="1500">0</span><span class="count-title">+</span></h2>
								<p class="count-text ">Years of Experience</p>
							</div>
						</div>
						<div class="col-md-3 ">
							<div class="counter">
								<h2><span class="timer count-title count-number" data-to="655"
										data-speed="1500">0</span><span class="count-title">+</span></h2>
								<p class="count-text ">Projects Completed</p>
							</div>
						</div>
						<div class="col-md-3 ">
							<div class="counter">
								<h2><span class="timer count-title count-number" data-to="35"
										data-speed="1500">0</span><span class="count-title">+</span></h2>
								<p class="count-text ">Investors Gathered</p>
							</div>
						</div>
						<div class="col-md-3 ">
							<div class="counter">
								<h2><span class="timer count-title count-number"
										data-to="{{setting('site.awards_worldwide')}}"
										data-speed="1500">{{setting('site.awards_worldwide')}}</span><span
										class="count-title">+</span></h2>
								<p class="count-text ">Awards Worldwide</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- counting end -->

	<!-- services start -->
	<section class="services" id="Our Services" data-aos="fade-up" data-aos-duration="1000">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="services-content">
						<h2>What we do, Our Services</h2>
						<div class="row">
							<div class="col-md-6">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
									incididunt ut labore et dolore magna aliqua. Faucibus a pellentesque sit amet.
									Ullamcorper di gnissim cras tincidunt lobortis feugiat vivamus at. Lorem ipsum
									adipiscing elit, sed do eiusmod tempor incididunt ut labore...</p>
							</div>
							<div class="col-md-6">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
									incididunt ut labore et dolore magna aliqua. Faucibus a pellentesque sit amet.
									Ullamcorper di gnissim cras tincidunt lobortis feugiat vivamus at. Lorem ipsum
									adipiscing elit, sed do eiusmod tempor incididunt ut labore...</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- services end -->

	<!-- services-carousel start -->
	<section class="services-carousel">
		<div class="container">
			<div class="row">
				<div class="col-12 owl-services">
					<div class="loop owl-carousel  owl-test nogap">
						@foreach ($services as $service)
						<div class="item">
							<div class="slide">
								<figure>
									<img src="{{Voyager::image($service->image)}}" alt="construction"
										class="img-fluid  people">
									<figcaption class="owl-services-content">
										<h4><a href="">{{$service->title}}</a></h4>
										<p>{{Str::limit($service->descp, 300, "...(Read more)")}}</p>
									</figcaption>
								</figure>
							</div>
						</div>
						@endforeach


					</div>

				</div>
			</div>
		</div>
	</section>
	<!-- services-carousel end -->

	<!-- portfolio start -->
	<section class="container">
		<div class="row">
			<div class="portfolio">
				<h2>See what we have done, Portfolio</h2>
				<!-- Gallary start -->
				<div class="Gallary">
					<div class="container">
						<div class="row ">
							<div class="col-md-12">
								<div id="blogCarousel" class="carousel slide" data-ride="carousel">
									<ol class="carousel-indicators">
										<li data-target="#blogCarousel" data-slide-to="0" class="active"></li>
										<li data-target="#blogCarousel" data-slide-to="1"></li>
										<li data-target="#blogCarousel" data-slide-to="2"></li>
									</ol>
									<!-- Carousel items -->
									<div class="carousel-inner">
										@foreach ($projects as $key => $project)
										<div class="carousel-item {{$key == 0 ? 'active' : ''}}">
											<div class="row">
												<div class="col-lg-6 ">
													<div class="content-1">
														<figure>
															<img src="{{Voyager::image($project->image)}}"
																alt="portfolio">
														</figure>
													</div>
												</div>
												<div class="col-lg-6 ">
													<div class="content-2">
														<h3>{{$project->name}}</h3>
														<p>{{$project->description}}</p>
														<p class="mt-2 text-muted">Location:
															<small>{{$project->Address}}</small>
														</p>
														<p class="text-muted">Type:
															<small>{{$project->type->name}}</small>
														</p>
													</div>
												</div>
											</div>
											<!--.row-->
										</div>
										@endforeach
									</div>
									<!--.carousel-inner-->
								</div>
								<!--.Carousel-->
							</div>
						</div>
					</div>
				</div>
				<!-- Gallary end-->
			</div>
		</div>
	</section>
	<!-- portfolio end -->

	<!-- construction-team start -->
	<section class="construction-team" id="Blog">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 thumbnail">
					<figure>
						<img src="{{asset('frontend/images/construction-team.jpg')}}" alt="construction-team">
					</figure>
				</div>
				<div class="col-lg-6 construction-team-inner">
					<div class="row">
						<div class="col-12">
							<h3>Our Dedicated Team</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adi piscing elit, sed do eiusmod tempor
								incididunt ut labore et dolore magna aliqua. Faucibus a pellent esque sit amet.
								adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
						</div>
					</div>
					<div id="carousel-example-multi" class="carousel slide carousel-multi-item " data-ride="carousel">

						<!-- Indicators -->
						<ol class="carousel-indicators">
							<li data-target="#carousel-example-multi" data-slide-to="0" class="active"></li>
							<li data-target="#carousel-example-multi" data-slide-to="1"></li>
							<li data-target="#carousel-example-multi" data-slide-to="2"></li>
							<li data-target="#carousel-example-multi" data-slide-to="3"></li>
							<li data-target="#carousel-example-multi" data-slide-to="4"></li>
						</ol>
						<!--/.Indicators-->
						<div class="carousel-inner " role="listbox">
							@foreach ($users->chunk(2) as $key => $chank_user)
							<div class="carousel-item {{$key == 0 ? 'active' : ''}}">
								<div class="row nogap">
									@foreach ($chank_user as $user)
									<div class=" col-md-6 col">
										<div class="card mb-2">
											<img class="card-img-top" src="{{Voyager::image($user->avatar)}}"
												alt="Card image cap">
											<div class="card-body">
												<h4 class="card-title ">{{$user->name}}</h4>
												<p class="card-text">{{$user->role->display_name}}</p>
												<span>
													<a href="">
														<i class="fab fa-facebook-square"></i>
													</a>
													<a href="">
														<i class="fab fa-twitter-square"></i>
													</a>
													<a href="">
														<i class="fab fa-linkedin"></i>
													</a>
													<a href="">
														<i class="fab fa-instagram"></i>
													</a>
												</span>
											</div>
										</div>
									</div>
									@endforeach
								</div>
							</div>
							@endforeach
						</div>
						<!--Controls-->
						<div class="controls-bottom">
							<a class="btn-floating" href="#carousel-example-multi" data-slide="prev"><i
									class="fas fa-chevron-left"></i></a>
							<a class="btn-floating" href="#carousel-example-multi" data-slide="next"><i
									class="fas fa-chevron-right"></i></a>
						</div>
						<!--/.Controls-->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- construction-team end -->

	<!-- construction-looking start -->
	<section class="construction-looking">
		<div class="container">
			<div class="looking-innar">
				<div class="row">
					<div class="col-lg-8" data-aos="fade-up" data-aos-duration="1000">
						<h2>Looking for Construction Solution?</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adi piscing elit, sed do eiusmod tempor incididunt ut
							labore et dolore magna aliqua. Faucibus a pellent esque sit amet. adipiscing elit, sed do
							eiusmod tempor incididunt ut labore.</p>
						<button type="submit" class="btn btn-primary">Get a Free Quote</button>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- construction-looking end -->

	<!-- testimonials start -->
	<section class="testimonials" id="About us">
		<div class="container">
			<div class="testimonials-inner">
				<div class="row">
					<div class="col-lg-8">
						<h2>Client Testimonials</h2>
						<p>Your Client Testimonials here sit amet, consectetur adi piscing elit, sed do eiusmod tempor
							incididunt ut
							labore et dolore magna aliqua. Faucibus a pellent esque sit amet. adipiscing elit, sed do
							eiusmod tempor incididunt ut labore.</p>

						@foreach ($testimonials as $key => $te)
						<div class="row">
							@if (fmod($key, 2) == 0)
							<div class="testimonials-content block">
								<div class="col-md-3">
									<figure>
										<img src="{{Voyager::image($te->image)}}" alt="{{$te->name}}">
									</figure>
								</div>
								<div class="col-md-9 content">
									<p>“{{$te->quote}}”</p>
									<span>{{$te->name}}</span>
									<h6>{{$te->profasion_companey}}</h6>
								</div>
							</div>
							@else
							<div class="testimonials-content block">

								<div class="col-md-9 content">
									<p>“{{$te->quote}}”</p>
									<span>{{$te->name}}</span>
									<h6>{{$te->profasion_companey}}</h6>
								</div>
								<div class="col-md-3">
									<figure>
										<img src="{{Voyager::image($te->image)}}" alt="{{$te->name}}">
									</figure>
								</div>
							</div>
							@endif

						</div>
						@endforeach
					</div>
					<div class="col-lg-4 thumbnail">
						<figure>
							<img src="{{asset('frontend/images/testimonial-img.jpg')}}" alt="testimonial-img">
						</figure>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- testimonials end -->

	<!-- contact-us start -->
	<section class="contact-us" id="Contact">
		<div class="container">
			<div class="contact-us-inner">
				<div class="row">
					<div class="col-xl-4 col-lg-4 block">
						<h3>Reach Us</h3>
						<p>{{setting('site.address')}}</p>
						<p>Phone {{setting('site.phone')}}</p>
						<a href="mailto:support@scaf-link.com"
							style="display:block;">{{setting('site.sup_email_address')}}</a>
						<a href="http://websiteconst.com"
							style="display: inline-block;border-bottom: 2px solid;">websiteconst.com</a>
						<span>
							<a href="">
								<i class="fab fa-facebook-square"></i>
							</a>
							<a href="">
								<i class="fab fa-twitter-square"></i>
							</a>
							<a href="">
								<i class="fab fa-linkedin"></i>
							</a>
							<a href="">
								<i class="fab fa-pinterest"></i>
							</a>
							<a href="">
								<i class="fab fa-google-plus"></i>
							</a>
							<a href="">
								<i class="fab fa-instagram"></i>
							</a>
						</span>
					</div>
					<div class="col-xl-8 col-lg-8">
						<h4 data-aos="fade-up" data-aos-duration="1000">Get a Free Quotation</h4>
						<form data-aos="fade-up" data-aos-duration="1300">
							<div class="form-group row">
								<div class="col-sm-6 col-12">
									<input type="text" class="form-control" placeholder="Your Name" required>
								</div>
								<div class="col-sm-6 col-12">
									<input type="text" class="form-control" placeholder="Your Email" required
										style="float: right;">
								</div>

							</div>

							<div class="form-group row">
								<div class="col-sm-12">
									<textarea type="text" class="form-control" placeholder="Your Detailed message"
										rows="6" required></textarea>
								</div>
							</div>
							<button type="submit" class="btn btn-primary">Get a Free Quote</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- contact-us end -->

	<!-- footer start -->
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="footer-inner">
						<ul class="navbar-nav">
							<li>
								<a href="">Home </a>
							</li>
							<span>/</span>
							<li>
								<a href="#About us">About us</a>
							</li>
							<span>/</span>
							<li>
								<a href="#Projects">Projects</a>
							</li>
							<span>/</span>
							<li>
								<a href="#Our Services">Our Services</a>
							</li>
							<span>/</span>
							<li>
								<a href="#Blog"> Read Blog</a>
							</li>
							<span>/</span>
							<li>
								<a href="#Contact">Contact us</a>
							</li>
						</ul>
						<p>(C) {{date('Y')}}, All Rights Reserved by Scaf-link Engineering Pte Ltd. Developed by
							<small><a href="http://shumoninventory.herokuapp.com">Shumon Pal</a></small>
						</p>
					</div>
				</div>
			</div>
		</div>
		<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-arrow-up"></i></button>
	</footer>
	<!-- footer end -->

	<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
	<script src="{{asset('frontend/js/popper.min.js')}}"></script>
	<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('frontend/js/owl.carousel.js')}}"></script>
	<script src="{{asset('frontend/js/aos.js')}}"></script>
	<script src="{{asset('frontend/js/custom.js')}}"></script>

</body>

</html>