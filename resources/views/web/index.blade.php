@php date_default_timezone_set('Asia/Dhaka') @endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<link rel="icon" href="{{ asset('imgs/brncht-logo.jpg') }}" type="image/x-icon">

		<title>@yield('title', config('app.name'))</title>
		<meta content="" name="description">
		<meta content="" name="keywords">

		<!-- Favicons -->
		<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
		<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
		<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
		<link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
		<link rel="mask-icon" href="{{ asset('favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="theme-color" content="#ffffff">

		<!-- Google Fonts -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Prompt:wght@600&family=Sriracha&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">
		<!-- font awesome -->
		<link href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">

		<!-- Vendor CSS Files -->
		<link href="{{ asset('web/assets/vendor/aos/aos.css') }}" rel="stylesheet">
		<link href="{{ asset('web/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('web/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
		<link href="{{ asset('web/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
		<link href="{{ asset('web/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

		<!-- Template Main CSS File -->
		<link href="{{ asset('web/assets/css/style.css') }}" rel="stylesheet">
		@stack('styles')
		<link href="{{ asset('web/assets/css/custom.css') }}" rel="stylesheet">
		<link href="{{ asset('web/assets/css/faruk.css') }}" rel="stylesheet">

	</head>
	<body>
		
		@include('web.includes.header')

		<div class="page-content">
			
			@yield('web_content')

			@include('web.includes.footer')

			<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

		</div>

		<!-- Vendor JS Files -->
		<script src="{{ asset('web/assets/js/jquery-3.7.0.min.js') }}"></script>
		<script src="{{ asset('web/assets/vendor/aos/aos.js') }}"></script>
		<script src="{{ asset('web/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ asset('web/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
		<script src="{{ asset('web/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
		<script src="{{ asset('web/assets/vendor/php-email-form/validate.js') }}"></script>

		<!-- Template Main JS File -->
		<script src="{{ asset('web/assets/js/main.js') }}"></script>

		<script>
			$(document).ready(function() {
				//
		    });
		</script>

		@stack('scripts')

	</body>
</html>
