@extends('layouts.plain')
@section('content')
<style type="text/css">
	body{
		background-color: #292b2c;
	}
</style>
<div class="container-fluid">
	<img src="{{ asset('assets/img/logo.png') }}" class="mx-5" style="width: 200px; height: 120px;">
</div>
<br><br><br>

<div class="container">
	<div class="row d-flex justify-content-center">
		<div class="col-lg-12 col-sm-12">
			<center> 
				<div class="card w-25">
					<div class="card-header">
						<h4 class="card-title">Sign in/Sign up</h4>
					</div>
					<div class="card-body">
						<button class="btn btn-primary w-100" onclick="$('#signin').modal('show')">Sign in</button><br>
						<button class="btn btn-danger w-100 my-2" onclick="$('#signup').modal('show')">Sign up</button>
						<center><a href="{{ url('/') }}"><small>Back to Home</small></a></center>
					</div>
					<div class="card-footer">
						<small>&copy;<script type="text/javascript">document.write(new Date().getFullYear())</script>  All Rights Reserved. <a href="{{ url('/') }}" target="_blank">Web Apparel</a></small>
					</div>
				</div>
			</center>
		</div>
	</div>
</div>


<div class="modal fade" id="signin">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Sign in</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
			</div>
			<form action="{{ route('signin') }}" method="post">
				{{csrf_field()}}
			<div class="modal-body">
				@if(session()->has('error'))
				<script type="text/javascript">$('#signin').modal('show')</script>
				<div class="alert alert-danger xx">
					{!! session()->get('error') !!}
				</div>
				@endif
				@if(session()->has('message'))
				<script type="text/javascript">$('#signin').modal('show')</script>
				<div class="alert alert-info xx">
					{!! session()->get('message') !!}
				</div>
				@endif
				@if(session()->has('notSign'))
				<script type="text/javascript">$('#signin').modal('show')</script>
				<div class="alert alert-info xx">
					{!! session()->get('notSign') !!}
				</div>
				@endif
				<div class="form-row">
					<input type="text" name="username" class="form-control @error('lusername') is-invalid @enderror" placeholder="Username" required>
					@error('username')
					<script type="text/javascript">$('#signin').modal('show')</script>
						<div class="invalid-feedback">
							<strong>{{$message}}</strong>
						</div>
					@enderror
				</div>
				<div class="form-row my-3">
					<input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
					@error('password')
					<script type="text/javascript">$('#signin').modal('show')</script>
						<div class="invalid-feedback">
							<strong>{{$message}}</strong>
						</div>
					@enderror
				</div>
			</div>
			<div class="modal-footer">
				<div class="form-row">
					<div class="col-lg-12">
						<button type="submit" class="btn btn-primary">Sign in</button>
					</div>
				</div>
				<div class="form-row my-2">
					<div class="col-lg-12">
						<small>Don't have an account? <a href="javascript:void(0)" onclick="signUp()">Sign up</a> now.</small>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="signup">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Sign up</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
			</div>
			<form action="{{ route('signup') }}" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
			<div class="modal-body">
				<div class="form-row">
					<input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username" required>
					@error('username')
					<script type="text/javascript">$('#signup').modal('show')</script>
						<div class="invalid-feedback">
							<strong>{{$message}}</strong>
						</div>
					@enderror
				</div>
				<div class="form-row my-1">
					<input type="password" name="regPassword" class="form-control @error('regPassword') is-invalid @enderror" placeholder="Password" required>
					@error('regPassword')
				<script type="text/javascript">$('#signup').modal('show')</script>
						<div class="invalid-feedback">
							<strong>{{$message}}</strong>
						</div>
					@enderror
				</div>
				
				<div class="form-row my-1">
					<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-mail" required>
					@error('email')
					<script type="text/javascript">$('#signup').modal('show')</script>
						<div class="invalid-feedback">
							<strong>{{$message}}</strong>
						</div>
					@enderror
				</div>
				<div class="form-row my-1">
					<input type="text" name="regFname" class="form-control col-lg-4 @error('regFname') is-invalid @enderror" placeholder="First Name" required> 
					@error('regFname')
					<script type="text/javascript">$('#signup').modal('show')</script>
						<div class="invalid-feedback">
							<strong>{{$message}}</strong>
						</div>
					@enderror
					<input type="text" name="regLname" class="form-control col-lg-4 @error('regLname') is-invalid @enderror" placeholder="Last Name" required>
					@error('regLname')
					<script type="text/javascript">$('#signup').modal('show')</script>
						<div class="invalid-feedback">
							<strong>{{$message}}</strong>
						</div>
					@enderror
					<input type="text" name="regMI" class="form-control col-lg-4" placeholder="M.I. (Optional)">
				</div>
				<div class="form-row my-1">
					<input type="text" name="regAddress" class="form-control" placeholder="Address">
				</div>
				<div class="form-row my-1">
					<label class="col-lg-3">Gender</label>
					<div class="col-lg-9">
						<label><input type="radio" name="regGender" value="Male" required> Male</label>
						<label><input type="radio" name="regGender" value="Female" required> Female</label>
					</div>
				</div>
				<div class="form-row my-1">
					<label class="col-lg-3">Birthday</label>
					<div class="col-lg-9">
						<input type="date" name="regBday" class="form-control" required>
					</div>
				</div>
				<div class="form-row my-1">
					<label class="col-lg-3">Profile Picture</label>
					<div class="col-lg-9">
						<input type="file" name="regPhoto" id="uploadPhoto" accept="image/jpeg" required>
					</div>
				</div>
				<div class="form-row my-1">
					<label class="col-lg-3">Preview</label>
					
						<img src="" class="previewPic border" style="width:150px; height: 150px;" alt="Preview">
				</div>
			</div>
			<div class="modal-footer">
				<div class="form-row">
					<div class="col-lg-12">
						<button type="submit" class="btn btn-danger">Sign up</button>
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


		});
	setTimeout(function(){
		$(".xx").fadeOut('slow');
	},5000)

	function signUp()
	{
		$('#signin').modal('hide');
		$('#signup').modal('show');
	}
</script>
@endsection