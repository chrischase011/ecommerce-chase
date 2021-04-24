@extends('layouts.app')
@section('content')
@if(session()->has('changePassSuccess'))
	<script type="text/javascript">
		Swal.fire({
			title: "{!! session()->get('changePassSuccess')!!}",
			icon: 'success',
			allowOutsideClick: false,
			allowEscapeKey: false
		});
	</script>
@endif
@if(session()->has('changePassError'))
	<script type="text/javascript">
		Swal.fire({
			title: "{!! session()->get('changePassError')!!}",
			icon: 'error',
			allowOutsideClick: false,
			allowEscapeKey: false
		});
	</script>
@endif
@if(session()->has('changeInfoSuccess'))
	<script type="text/javascript">
		Swal.fire({
			title: "{!! session()->get('changeInfoSuccess')!!}",
			icon: 'success',
			allowOutsideClick: false,
			allowEscapeKey: false
		});
	</script>
@endif
<div class="container-fluid bg-light my-5">
	<div class="container">
		<h3 class="py-2">{{Auth::user()->fname." ".Auth::user()->lname}}'s Account</h3>

		<div class="form-row">
			<div class="col-lg-12">
			<h5>Recent Orders</h5>
			<table class="table table-light table-striped table-responsive w-100">
			<thead>
				<tr>
					<th>Tracking No.</th>
					<th>Order(s)</th>
					<th>Name</th>
					<th>Shipping Address</th>
					<th>Shipping Fee</th>
					<th>Total Payment</th>
					<th>Courier</th>
					<th>Delivery Date</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
			@foreach($checkouts as $checkout)
				<tr>
					<td>{{$checkout->tracking_number}}</td>
					<td>
						@foreach($carts as $cart)
							@foreach($products as $product)
								<?php
									$cartIDs = explode(",", $checkout->cart_id);
									for ($i=0; $i < count($cartIDs); $i++) { 
										if($cart->id == $cartIDs[$i])
										{
											if($product->product_number == $cart->product_number){
												
												?>
												<a href='{{ route('view', ['no' => $product->product_number]) }}'>{{$product->product_name}}</a> ({{$cart->quantity}})<br>
												<?php

											}
										}
									}
								?>
							@endforeach
						@endforeach
					</td>
					<td>{{$checkout->name}}</td>
					<td>{{$checkout->address}}, {{$checkout->city}}, {{$checkout->country}}</td>
					<td>₱ {{$checkout->shipping_fee}}</td>
					<td>₱ {{$checkout->grand_total}}</td>
					<td>
						@if($checkout->courier != "")
						{{$checkout->courier}}
						@endif
					</td>	
					<td>
						@if($checkout->delivery != "")
						{{$checkout->delivery}}
						@endif
					</td>
					<td>
						@if($checkout->status == "0")
							<span class="badge badge-pill badge-primary">Processing</span>
						@elseif($checkout->status == "1")
							<span class="badge badge-pill badge-warning">To be shipped</span>
						@elseif($checkout->status == "2")
							<span class="badge badge-pill badge-success">Delivered</span>
						@elseif($checkout->status == "3")
							<span class="badge badge-pill badge-danger">Rejected</span>
						@elseif($checkout->status == "4")
							<span class="badge badge-pill badge-danger">Cancelled</span>
						@endif
					</td>
				</tr>
			@endforeach
			</tbody>
					
				</table>
			</div>
		</div>
		<div class="form-row my-3">
			<div class="col-lg-12">
				<h5>Account Settings</h5>
			</div>
		</div>
		<div class="form-row my-3">
			<div class="col-lg-12">
				<div class="form-row">
					<div class="col-lg-12">
						<button class="btn btn-light border w-100" onclick="$('#changePass').modal('show')">Change Password</button>
					</div>
				</div>
				<div class="form-row my-1">
					<div class="col-lg-12">
						<button class="btn btn-light border w-100" onclick="$('#changeInfo').modal('show')">Change Account Information</button>
					</div>
				</div>

			</div>
		</div>
	</div>
	<br><br><br><br>
</div>
<div class="modal fade" id="changePass">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Change Password</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
			</div>
			<form action="{{ route('changePass') }}" method="post" id="changePass">
				{{csrf_field()}}
			<div class="modal-body">
				<div class="form-row">
					<label class="col-lg-3">Current Password</label>
					<div class="col-lg-9">
						<input type="password" name="currentPass" class="form-control">
					</div>
				</div>
				<div class="form-row">
					<label class="col-lg-3">New Password</label>
					<div class="col-lg-9">
						<input type="password" id="newPass" name="newPass" class="form-control">
						<span class="passLength"></span>
					</div>
				</div>
				<div class="form-row">
					<label class="col-lg-3">Confirm Password</label>
					<div class="col-lg-9">
						<input type="password" id="confirmPass" name="confirmPass" class="form-control">
						<span class="passErr"></span>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-danger" type="submit" id="savePass">Save Changes</button>
			</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="changeInfo">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Account Information</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
			</div>
			<form action="{{ route('changeInfo') }}" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
			<div class="modal-body">
				<div class="form-row">
					<input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username" required value="{{Auth::user()->username}}">
					@error('username')
					<script type="text/javascript">$('#changeInfo').modal('show')</script>
						<div class="invalid-feedback">
							<strong>{{$message}}</strong>
						</div>
					@enderror
				</div>
				
				<div class="form-row my-1">
					<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-mail" required value="{{Auth::user()->email}}">
					@error('email')
					<script type="text/javascript">$('#changeInfo').modal('show')</script>
						<div class="invalid-feedback">
							<strong>{{$message}}</strong>
						</div>
					@enderror
				</div>
				<div class="form-row my-1">
					<input type="text" name="regFname" class="form-control col-lg-4 @error('regFname') is-invalid @enderror" placeholder="First Name" required value="{{Auth::user()->fname}}"> 
					@error('regFname')
					<script type="text/javascript">$('#changeInfo').modal('show')</script>
						<div class="invalid-feedback">
							<strong>{{$message}}</strong>
						</div>
					@enderror
					<input type="text" name="regLname" class="form-control col-lg-4 @error('regLname') is-invalid @enderror" placeholder="Last Name" required value="{{Auth::user()->lname}}">
					@error('regLname')
					<script type="text/javascript">$('#changeInfo').modal('show')</script>
						<div class="invalid-feedback">
							<strong>{{$message}}</strong>
						</div>
					@enderror
					<input type="text" name="regMI" class="form-control col-lg-4" value="{{Auth::user()->mi}}" placeholder="M.I. (Optional)">
				</div>
				<div class="form-row my-1">
					<input type="text" name="regAddress" class="form-control" placeholder="Address" value="{{Auth::user()->address}}">
				</div>
				<div class="form-row my-1">
					<label class="col-lg-3">Birthday</label>
					<div class="col-lg-9">
						<input type="date" name="regBday" class="form-control" required value="{{Auth::user()->bday}}">
					</div>
				</div>
				<div class="form-row my-1">
					<label class="col-lg-3">Profile Picture</label>
					<div class="col-lg-9">
						<input type="file" name="regPhoto" id="uploadPhoto" class="@error('regPhoto') is-invalid @enderror" accept="image/jpeg">
						@error('regPhoto')
					<script type="text/javascript">$('#changeInfo').modal('show')</script>
						<div class="invalid-feedback">
							<strong>{{$message}}</strong>
						</div>
					@enderror
					</div>
				</div>
				<div class="form-row my-1">
					<label class="col-lg-3">Preview</label>
					
						<img src="data:jpeg;base64,{{Auth::user()->pic_location}}" class="previewPic border" style="width:150px; height: 150px;" alt="Preview">
				</div>
				<div class="form-row my-1">
					<label class="col-lg-3">Confirm Password</label>
					<div class="col-lg-9">
						<input type="password" name="confirmPassword" class="form-control" required>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="form-row">
					<div class="col-lg-12">
						<button type="submit" class="btn btn-danger">Save Changes</button>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$("#uploadPhoto").change(function(){
	var input = this;
	var url = $(this).val();
	var ext = url.substring(url.lastIndexOf('.') +1).toLowerCase();

	if(input.files && input.files[0]&& (ext == "png" || ext == "jpeg" || ext == "jpg")){
		var reader = new FileReader();
		reader.onload=function(e){
			$(".previewPic").attr("src",e.target.result);
			console.log(url);
		}
		reader.readAsDataURL(input.files[0]);

	}
	else{

		$(".previewPic").attr("src","");
		console.log(url);
	}


});

		$("#confirmPass").on('input', function(){
			var np = $("#newPass").val();
			var cp = $("#confirmPass").val();

			if(np == cp)
			{
				$(".passErr").removeClass('text-danger').addClass('text-success').text("Password is matched.");
			}
			else
			{
				$(".passErr").removeClass('text-success').addClass('text-danger').text("Password did not match.");
			}
		});
		$("#newPass").on('input', function(){
			var np = $("#newPass").val();

			if(np.length >= 8 && np.length < 12)
			{
				$(".passLength").removeClass('text-danger text-success').addClass('text-warning').text("Password is good.");
			}
			else if(np.length >= 12){
				$(".passLength").removeClass('text-danger text-warning').addClass('text-success').text("Password is too strong.");
			}
			else
			{
				$(".passLength").removeClass('text-success text-warning').addClass('text-danger').text("Password is too short");
			}
		});
		$("#changePass").submit(function(){
			var np = $("#newPass").val();
			var cp = $("#confirmPass").val();
			var cup = $("#currentPass").val();
			if(cup == "" || cp == "" || np == ""){
				Swal.fire({
					title: "Please input following fields",
					icon: 'error',

				});
				return false;
			}
			else if(np != cp)
			{
				Swal.fire({
					title: "Password did not match",
					icon: 'error',

				});
				return false;
			}
			else if(np.length < 8)
			{
				Swal.fire({
					title: "Password length is short",
					icon: 'error',
				});
				return false;
			}
			else{
				return true;
			}
		});

	});

</script>
@endsection