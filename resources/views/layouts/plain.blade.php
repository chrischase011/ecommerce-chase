<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="description" content="Web Apparel - Your choice for Filipino Brands">
    <meta name="keywords" content="Web Apparel, Iconic Alley, Clothes, Filipino">
    <meta name="author" content="Hypertext Assassins">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>{{$title}}</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/bootstrap.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/fontawesome/css/all.min.css') }}">
	<script src="{{ URL::asset('assets/js/jquery-3.5.1.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/bootstrap.bundle.min.js') }}"></script>
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
    <script src="{{ URL::asset('assets/sweetalert2/dist/sweetalert2.min.js') }}"></script>
	
	<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
</head>
<body>
	<style type="text/css">
		/* width */
		::-webkit-scrollbar {
		  width: 10px;
		}

		/* Track */
		::-webkit-scrollbar-track {
		  background: #f1f1f1; 
		}
		 
		/* Handle */
		::-webkit-scrollbar-thumb {
		  background: #888; 
		}

		/* Handle on hover */
		::-webkit-scrollbar-thumb:hover {
		  background: #555; 
		}
	</style>
	@yield('content')
</body>
</html>