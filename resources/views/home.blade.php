	@extends('layouts.frontend')
	@section('alt')
		class="alt"
	@endsection
	@section('extraStyle')
		#header{
		position:fixed
	}
	@endsection
	@section('title')
		Home
	@endsection

	@section('content')
		<!-- Banner -->
			<section class="banner full" style="z-index: 10">
				<article>
					<img src="images/slide01.jpg" alt="" />
					<div class="inner">
						<header>
							<p>When You Join Us You Join New <a href="#">Family</a></p>
							<h2>Welcome </h2>
						</header>
					</div>
				</article>
				<article>
					<img src="images/slide02.jpg" alt="" />
					<div class="inner">
						<header>
							<p>With Us You Will Get Best teaching From Professionals</p>
							<h2>High Knowlege</h2>
						</header>
					</div>
				</article>
				<article>
					<img src="images/slide03.jpg"  alt="" />
					<div class="inner">
						<header>
							<p>You Will Contact With Best Teachers In the Computer Science Field</p>
							<h2>Top Teachers</h2>
						</header>
					</div>
				</article>
				<article>
					<img src="images/slide04.jpg"  alt="" />
					<div class="inner">
						<header>
							<p>Our Labs Is Equippet With EveryThing You Need To Get Better</p>
							<h2>Best Labs</h2>
						</header>
					</div>
				</article>
				<article>
					<img src="images/slide05.jpg"  alt="" />
					<div class="inner">
						<header>
							<p>We Guarantee For You Jon Opportunities If You get Better</p>
							<h2>job opportunities</h2>
						</header>
					</div>
				</article>
			</section>
			@if(session()->has('message'))
            <div class="alert alert-success">
                {{session()->get('message')}}
            </div>
        @endif
        @if($errors->any())
            @include('layouts.errors')
        @endif
		<!-- One -->
			<section id="one" class="wrapper style2">
				<div class="inner">
					<div class="grid-style">

						<div>
							<div class="box">
								<div class="image fit">
									<img src="images/departments.jpg" alt="" />
								</div>
								<div class="content">
									<header class="align-center">
										<p>We Have Many Departments With Many Fields</p>
										<h2>Departments</h2>
									</header>
									<p> Cras aliquet urna ut sapien tincidunt, quis malesuada elit facilisis. Vestibulum sit amet tortor velit. Nam elementum nibh a libero pharetra elementum. Maecenas feugiat ex purus, quis volutpat lacus placerat malesuada.</p>
									<footer class="align-center">
										<a href="{{url('departments/overview')}}" class="button alt">View All Departments</a>
									</footer>
								</div>
							</div>
						</div>

						<div>
							<div class="box">
								<div class="image fit">
									<img src="images/rules.jpg" alt="" />
								</div>
								<div class="content">
									<header class="align-center">
										<p>You Have To Follow Rules To Get All Your Rights</p>
										<h2>College List</h2>
									</header>
									<p> Cras aliquet urna ut sapien tincidunt, quis malesuada elit facilisis. Vestibulum sit amet tortor velit. Nam elementum nibh a libero pharetra elementum. Maecenas feugiat ex purus, quis volutpat lacus placerat malesuada.</p>
									<footer class="align-center">
										<a href="{{url('/download/college/list')}}" class="button alt">Download Now</a>
									</footer>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section id="three" class="wrapper style2" style="padding-top: 0">
				<hr style="margin-bottom: 100px;margin-top: 0px">
				<div class="inner">
					<header class="align-center">
						<p class="special">Brief Information About Us</p>
						<h2>About Us</h2>
					</header>
					<p style="width: 80%;margin:0 auto;text-align: center">
						FCIH primary location was in Garden City, Cairo , Egypt then in 2002 ~ 2003 the faculty have been shifted gradually to the main campus in helwan. Getting into the race starting from 1999. FCIH always try to keep its standard student academic level. FCIH with all its resources serve a harmonic education system with new and pioneered education methods".
					</p>
				</div>
			</section>



		<!-- Two -->
			<section id="two" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p>We Again Guarantee You That You Will Enjoy And Will Get The Best Teaching And Knowledge</p>
						<h2>Your Are Our Son</h2>
					</header>
				</div>
			</section>

		<!-- Three -->
			<section id="three" class="wrapper style2">
				<div class="inner">
					<header class="align-center">
						<p class="special">Our Students That Make Succeess In the Future And Travel Around The World</p>
						<h2>Students Gallery</h2>
					</header>
					<div class="gallery">
						<div>
							<div class="image fit">
								<a href="#"><img src="images/pic01.jpg" alt="" /></a>
							</div>
						</div>
						<div>
							<div class="image fit">
								<a href="#"><img src="images/pic02.jpg" alt="" /></a>
							</div>
						</div>
						<div>
							<div class="image fit">
								<a href="#"><img src="images/pic03.jpg" alt="" /></a>
							</div>
						</div>
						<div>
							<div class="image fit">
								<a href="#"><img src="images/pic04.jpg" alt="" /></a>
							</div>
						</div>
					</div>
				</div>
			</section>


		<!-- Footer -->
			<footer id="footer">
				<div class="container">
					<ul class="icons">
						<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
					</ul>
				</div>
				<div class="copyright">
					&copy; Untitled. All rights reserved.
				</div>
			</footer>
@endsection	