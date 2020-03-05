<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<meta name="author" content="Kodinger">
		<meta name="keyword" content="Kodinger, template, html5, css3, bootstrap4">
		<meta name="description" content="HTML5 and CSS3 Template Based on Bootstrap 4">
		<title>Home</title>
		<link rel="stylesheet" href="{{asset('assets/icons/ionicons/css/ionicons.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
		<!-- <link rel="stylesheet" href="sweetalert/dist/sweetalert.css"> -->
		<link rel="stylesheet" href="{{asset('css/stisla.css')}}">
	</head>

	<body>
        @include('home.include.navbar')
        
		@yield('content')

		@include('home.include.footer')

		<script src="{{asset('js/jquery.min.js')}}"></script>
		<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
		<script src="js/jquery.easeScroll.js"></script>
		<script src="sweetalert/dist/sweetalert.min.js"></script>
		<script src="{{asset('js/stisla.js')}}"></script>
	</body>
</html>