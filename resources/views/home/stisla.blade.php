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
		<link rel="shortcut icon" href="{{asset('assets/img/pick me up.png')}}">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.14.1/css/mdb.min.css" rel="stylesheet">
		
	</head>

	<body>
		<div class="img-brand">
			<img src="{{asset('assets/img/pick me up.png')}}" alt="Brand">
		</div>
        @include('home.include.navbar')
        
		@yield('content')

		@include('home.include.footer')

		<script src="{{asset('js/jquery.min.js')}}"></script>
		<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('js/stisla.js')}}"></script>
		<script src="js/jquery.easeScroll.js"></script>
		<script src="sweetalert/dist/sweetalert.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.14.1/js/mdb.min.js"></script>
	</body>
</html>