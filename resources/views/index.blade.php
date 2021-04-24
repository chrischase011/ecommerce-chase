@extends('layouts.app')
@section('content')
<div class="container-fluid bg-dark">
	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
				<div class="carousel-item active">
    			  <img src="{{ asset('assets/img/webapparel/packaging/packaging.png') }}" class="d-block w-100" style="height: 300px;" alt="package">
    			</div>
    			<div class="carousel-item">
    			  <img src="{{ asset('assets/img/webapparel/loyaltycard/1.png') }}" class="d-block w-100" style="height: 300px;" alt="...">
    			</div>
    			<div class="carousel-item">
    			  <img src="{{ asset('assets/img/webapparel/clothes/MEN/barong.jpg') }}" class="d-block w-100" style="height: 300px;" alt="...">
    			</div>
    			<div class="carousel-item">
    			  <img src="{{ asset('assets/img/webapparel/clothes/WOMEN/bandila.jpg') }}" class="d-block w-100" style="height: 300px;" alt="...">
    			</div>
  			</div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>
<div class="container-fluid" style="background-color: #ff3333;">
	<div class="container p-2 justify-content-center">
		<div class="row text-white">
			<div class="col-lg-4">
				<h1 class="text-center"><i class="fa fa-truck"></i></h1>
				<h5 class='text-center'>Free Shipping</h5>
				<h6 class="text-center" style="font-size: 12px;">Within Metro Manila</h6>
			</div>
			<div class="col-lg-4">
				<h1 class="text-center"><i class="fa fa-mobile-alt"></i></h1>
				<h5 class='text-center'>Call us</h5> 
				<h6 class="text-center" style="font-size: 12px;">09068936093</h6>
			</div>
			<div class="col-lg-4">
				<h1 class="text-center"><i class="fa fa-map-marker-alt"></i></h1>
				<h5 class='text-center'>Our Location</h5>
				<h6 class="text-center" style="font-size: 12px;">Makati City</h6>
			</div>
		</div>
	</div>
</div>
<div class="container py-4">
	
		<div class="row">
			<div class="col-lg-6">
				<h4>Men's Apparel</h4>
			</div>
			<div class="col-lg-6">
				<div class="d-flex float-right mr-5">
					<span class="h5 mr-2">View All</span> 
				</div>
			</div>
		</div>
		  <div class="swiper-container">
    <div class="swiper-wrapper">
      <div class="swiper-slide">Slide 1</div>
      <div class="swiper-slide">Slide 2</div>
      <div class="swiper-slide">Slide 3</div>
    </div>
    <!-- Add Arrows -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
</div>
<script type="text/javascript">
	var swiper = new Swiper('.swiper-container', {
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
</script>
<br><br><br><br><br><br><br><br><br><br>
@endsection