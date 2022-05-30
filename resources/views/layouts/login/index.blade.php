<!doctype html>
<html lang="en">
  <head>
  	<title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="{{asset('style/login/css/style.css')}}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">@yield('title')</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
              @yield('images')
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Sign In</h3>
			      		</div>
								<!-- <div class="w-100"> -->
								<!-- 	<p class="social-media d-flex justify-content-end"> -->
								<!-- 		<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a> -->
								<!-- 		<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a> -->
								<!-- 	</p> -->
								<!-- </div> -->
			      	</div>
                  @yield('content')
                  @yield('form')
                  <!-- @yield('registration-link') -->
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="{{asset('style/login-templates/js/jquery.min.js')}}"></script>
  <script src="{{asset('style/login-templates/js/popper.js')}}"></script>
  <script src="{{asset('style/login-templates/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('style/login-templates/js/main.js')}}"></script>

	</body>
</html>


