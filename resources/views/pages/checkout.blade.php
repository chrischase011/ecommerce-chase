@extends('layouts.app')
@section('content')
<style type="text/css">
	body{
		background-color: #292b2c;
	}
	
</style>
@if(session()->has('checkoutSuccess'))
	<script type="text/javascript">
		Swal.fire({
			title: "{!! session()->get('checkoutSuccess')!!}",
			icon: 'success',
			allowOutsideClick: false,
			allowEscapeKey: false
		}).then((e) => {
			if(e.isConfirmed)
			{
				window.location.href = '{{ route('tracking') }}';
			}
		});
	</script>
@endif
@if(session()->has('checkoutError'))
	<script type="text/javascript">
		Swal.fire({
			title: "{!! session()->get('checkoutError')!!}",
			icon: 'error',
			allowOutsideClick: false,
			allowEscapeKey: false
		});
	</script>
@endif
<div class="container-fluid bg-light my-5 h-100">
	<div class="page-title p-2">
            <h1 class="mx-5">Checkout</h1>

		<div class="container d-flex ">
			
				<a href="{{ route('checkout') }}"><span class="badge badge-pill badge-secondary h2 mr-3">Checkout Info</span></a>
				<a href="{{ route('tracking') }}"><span class="badge badge-pill badge-light border h2 mr-3">Tracking Info</span></a>
		</div>
    </div>
	<div class="container">

		<span>Tracking #: <span id="tr"></span></span><br>
		<div class="row">
			<div class="col-lg-8">
				<form action="{{ route('proceedCheckout') }}" method="post" id="proceedCheckout">
				{{csrf_field()}}
				<input type="hidden" id="tracking" name="tracking">
				<h4>Billing Information</h4>
				<div class="form-row">
					<div class="col-lg-6">
						<div class="form-group">
							<div class="col-lg-12">
								<label>First Name <span class="text-danger">*</span></label>
								<input type="text" name="fname" class="form-control w-100 @error('fname') is-invalid @enderror" value="{{Auth::user()->fname}}">
								@error('fname')
									<div class="invalid-feedback">
										<strong>{{$message}}</strong>
									</div>
								@enderror
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<div class="col-lg-12">
								<label>Last Name <span class="text-danger">*</span></label>
								<input type="text" name="lname" class="form-control w-100 @error('lname') is-invalid @enderror" value="{{Auth::user()->lname}}">
								@error('lname')
									<div class="invalid-feedback">
										<strong>{{$message}}</strong>
									</div>
								@enderror
							</div>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-lg-12">
						<div class="form-group">
							<div class="col-lg-12">
							<label>E-mail <span class="text-danger">*</span></label>
								<input type="text" name="email" class="form-control w-100 @error('email') is-invalid @enderror" value="{{Auth::user()->email}}">
								@error('email')
									<div class="invalid-feedback">
										<strong>{{$message}}</strong>
									</div>
								@enderror
							</div>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-lg-12">
						<div class="form-group">
							<h5>Please drag the point to your address</h5>
							<div id='map' class="w-100" style=' height: 300px;'></div>
								<script>
								mapboxgl.accessToken = 'pk.eyJ1IjoidGFlbW8wMTEwIiwiYSI6ImNraXBodWJpdzFkeW4yem9hMm51aHN6N2wifQ.YmxDTa1IljSeLY_Hn1VCLQ';
								var map = new mapboxgl.Map({
									container: 'map',
									style: 'mapbox://styles/taemo0110/ckipihrpz1kb517mgsls4qnlf'
								});
								
								var marker = new mapboxgl.Marker({
									draggable: true
									})
									.setLngLat([121.02660117762986, 14.569645455077122])
									.addTo(map);

									 function onDragEnd()
									 {
									 	var lngLat = marker.getLngLat();
									 	//$("#address").val(lngLat.lng);
									 	$.ajax({
									 		url: 'https://api.mapbox.com/geocoding/v5/mapbox.places/'+lngLat.lng+','+lngLat.lat+'.json?access_token=pk.eyJ1IjoidGFlbW8wMTEwIiwiYSI6ImNraXBodWJpdzFkeW4yem9hMm51aHN6N2wifQ.YmxDTa1IljSeLY_Hn1VCLQ',
									 		type: 'get',
									 		dataType: 'json',
									 		success: function(data){
									 			console.log(data.features['1'].place_name);
									 			$("#address").val(data.features['1'].text+", "+data.features['0'].text+", "+data.features['2'].text);
									 			$("#city").val(data.features['3'].text);
									 			$('#country').val(data.features['4'].text);
									 		}
									 	});
									 }
									 
									marker.on('dragend', onDragEnd);
								
								//mapbox://styles/mapbox/streets-v11
								</script>
							</div>
						</div>
					</div>
				<div class="form-row">
					<div class="col-lg-12">
						<div class="form-group">
							<div class="col-lg-12">
							<label>Address <span class="text-danger">*</span> (If the address is not accurate, please type the correct address)</label>
								<input type="text" id="address" name="address" class="form-control w-100 @error('address') is-invalid @enderror" value="">
								@error('address')
									<div class="invalid-feedback">
										<strong>{{$message}}</strong>
									</div>
								@enderror
							</div>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-lg-6">
						<div class="form-group">
							<div class="col-lg-12">
								<label>City <span class="text-danger">*</span></label>
								<input type="text" id="city" name="city" class="form-control w-100 @error('city') is-invalid @enderror" value="">
								@error('city')
									<div class="invalid-feedback">
										<strong>{{$message}}</strong>
									</div>
								@enderror
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<div class="col-lg-12">
								<label>Country <span class="text-danger">*</span></label>
								<input type="text" id="country" name="country" class="form-control @error('country') is-invalid @enderror">
								@error('country')
									<div class="invalid-feedback">
										<strong>{{$message}}</strong>
									</div>
								@enderror
							</div>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-lg-12">
						<div class="form-group">
							<div class="col-lg-12">
							<label>Contact # <span class="text-danger">*</span></label>
								<input type="text" name="contact" class="form-control w-100 @error('contact') is-invalid @enderror" value="">
								@error('contact')
									<div class="invalid-feedback">
										<strong>{{$message}}</strong>
									</div>
								@enderror
							</div>
						</div>
					</div>
				</div><br>
				<h4>Payment Method</h4>
				<div class="form-row">
					<div class="col-lg-12">
						<div class="form-group">
							<div class="col-lg-12">
							<label><input type="radio" name="pm" value="cod"> Cash on Delivery</label><br>
							<label><input type="radio"  name="pm" value="cc"> Credit Card</label>

							</div>
						</div>
					</div>
				</div>
				<div class="pm d-none">
				<h4>Payment Details</h4>
				<div class="form-row">
					<div class="col-lg-12">
						<div class="form-group">
							<div class="col-lg-12">
							<label>Name on Card</label>
								<input type="text" name="cardNoc" class="form-control w-100 @error('cardNoc') is-invalid @enderror" value="">
								@error('cardNoc')
									<div class="invalid-feedback">
										<strong>{{$message}}</strong>
									</div>
								@enderror
							</div>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-lg-12">
						<div class="form-group">
							<div class="col-lg-12">
							<label>Address</label>
								<input type="text" name="cardAddress" class="form-control w-100 @error('cardAddress') is-invalid @enderror" value="">
								@error('cardAddress')
									<div class="invalid-feedback">
										<strong>{{$message}}</strong>
									</div>
								@enderror
							</div>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-lg-12">
						<div class="form-group">
							<div class="col-lg-12">
							<label>Credit Card Number</label>
								<input type="text" name="cardNumber" class="form-control w-100 bb @error('cardNumber') is-invalid @enderror" value="">
							</div>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-lg-6">
						<div class="form-group">
							<div class="col-lg-12">
								<label>Expiry <span class="text-danger">*</span></label>
								<input type="text" name="cardExpiry" placeholder="MM/DD" maxlength="5" class="form-control w-100 @error('cardExpiry') is-invalid @enderror" value="">
								@error('cardExpiry')
									<div class="invalid-feedback">
										<strong>{{$message}}</strong>
									</div>
								@enderror
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<div class="col-lg-12">
								<label>CvC Code <span class="text-danger">*</span></label>
								<input type="text" name="cardCVC" class="form-control w-100 @error('cardCVC') is-invalid @enderror" value="">
								@error('cardCVC')
									<div class="invalid-feedback">
										<strong>{{$message}}</strong>
									</div>
								@enderror
							</div>
						</div>
					</div>
				</div>
				</div>
				<div class="form-row my-2">
					<div class="col-lg-12">
						<input type="hidden" name="cartID" id="cartID">
						<input type="hidden" name="tax" id="tax">
						<input type="hidden" name="subtotal" id="subtotal">
						<input type="hidden" name="grandTotal" id="grandTotal">
						<div class="form-group">
							<div class="col-lg-12">
							<button type="button" id="placeOrder" class="btn btn-success btn-sm w-100">Place Order</button>
							</div>
						</div>
					</div>
				</div>
				</form>
			</div>
			
			<div class="col-lg-4">
				<h4>Your Order</h4>
				<hr>
				<?php $subtotal = 0; ?>
				<script type="text/javascript">
					var cartID = "";
				</script>
				@foreach($carts as $cart)
					@foreach($products as $product)
						@if($product->product_number == $cart->product_number && $cart->isCheckout != "1")
							<?php $subtotal = $subtotal + $cart->subtotal; ?>
							<div class="form-row">
								<div class="col-lg-3">
									<img src="{{ asset($product->product_imagelink) }}" class="w-100 h-75 mh-75">
								</div>
								<div class="col-lg-9">
									<span class="font-weight-bold">{{$product->product_name}}</span><br>
									<span class="text-muted">@if($product->product_desc != "")
			                    		{{$product->product_desc}}
			                    	@else
			                    		No Description
			                    	@endif</span><br>
			                    	<span class="font-weight-bold">Price: ₱ {{number_format($product->product_price,2)}}</span>
			                    	<br>
			                    	<span class="font-weight-bold">Qty: {{$cart->quantity}}</span>
									
								</div>

							</div>
							<script type="text/javascript">
								cartID += '{{$cart->id}},';
							</script>
						@endif
					@endforeach
				@endforeach

					<div class="form-row">
						<div class="col-lg-12">
							<hr>
							<span class="font-weight-bold text-md">Tax (12%): ₱ <?php 
                        		$addFee_n = $subtotal * 0.12;
                        		echo number_format($addFee_n,2);
                        	?></span><br>
                        	<span class="font-weight-bold text-md">Subtotal: ₱ {{number_format($subtotal,2)}}</span><br>
                        	<span class="font-weight-bold text-md">Grand Total: ₱ {{number_format(($addFee_n + $subtotal),2)}}</span>
						</div>
					</div>
					<script type="text/javascript">
						$("#cartID").val(cartID);
						$("#tax").val('{{$addFee_n}}');
						$("#subtotal").val('{{$subtotal}}');
						$("#grandTotal").val('{{($addFee_n + $subtotal)}}');
					</script>
					<hr>
			</div>
		</div>
	</div>
	
</div>

<script type="text/javascript">
	function generateTrackingNumber(length)
	{
		var res = "";
		var num = "1234567890";
		var ret = "";
		for(var i = 0; i < length;i++)
		{
			res += num.charAt(Math.floor(Math.random() * num.length));
		}
		ret = "WA"+res;
		$("#tr").text(ret);
		$('#tracking').val(ret);
	}
	generateTrackingNumber(10);
	$(function(){	
		
		$("input[name='pm']").click(function(){
			var x = $("input[name='pm']:checked").val();
				
			if(x == "cc")
		{
			$(".pm").fadeIn('slow').addClass('d-block').removeClass('d-none');
		}
		else
		{
			$(".pm").fadeOut('slow').addClass('d-none').removeClass('d-block');
		}
		});

		var x = $("input[name='pm']:checked").val();	

		if(x == "cc")
		{
			$(".pm").fadeIn('slow').addClass('d-block').removeClass('d-none').fadeIn('slow');
		}
		else
		{
			$(".pm").fadeOut('slow').addClass('d-none').removeClass('d-block').fadeOut('slow');
		}
		
		$("#placeOrder").on("click", function(){
			var x = $("input[name='pm']:checked").val();	

			if(x == "cc")
			{
				
				var cc = $(".bb").validateCreditCard();
				if(cc.valid){
					$("#proceedCheckout").submit();
				}
				else
				{
					Swal.fire({
						title: "Invalid Credit Card Number",
						icon: 'error',

					});
				}

			}
			else
			{
				$("#proceedCheckout").submit();
			}
		});
	});
	

</script>

@endsection