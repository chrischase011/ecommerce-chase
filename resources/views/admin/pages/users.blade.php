@extends("admin.layout.admin")
@section('content')

<div class="container p-3">
	<div class="row">
		<div class="col-lg-6 col-md-5 col-6">	
			<h2>User Management</h2>
		</div>
	</div>
</div>
<table class="table table-light">
	<thead>
		<tr>
			<th>Picture</th>
			<th>Username</th>
			<th>E-mail</th>
			<th>Name</th>
			<th>Address</th>
			<th>Gender</th>
			<th>Birthday</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@if(count($users) > 0)
			@foreach($users as $user)
				<tr>
			<td><span class="avatar avatar-md rounded-circle">
                    <img alt="Image placeholder" src="data:jpeg;base64,{{$user->pic_location}}">
                  </span></td>
			<td>{{$user->username}}</td>
			<td>{{$user->email}}</td>
			<td>
				@if($user->mi != "")
					{{$user->fname." ".$user->mi." ".$user->lname}}
				@else
					{{$user->fname." ".$user->lname}}
				@endif
			</td>
			<td>{{$user->address}}</td>
			<td>{{$user->gender}}</td>
			<td>{{$user->bday}}</td>
			<td>
				
				<button class="btn btn-warning btn-sm" onclick="setAdmin('{{$user->id}}')">Set Admin</button>
				<button class="btn btn-danger btn-sm" onclick="delUser('{{$user->id}}')">Delete</button>
			</td>
		</tr>
			@endforeach
		@endif
		
	</tbody>
</table>
<script type="text/javascript">
	function setAdmin(id)
	{
		$token = $('meta[name="csrf-token"]').attr('content');
		Swal.fire({
			title: 'Are you sure you want to set this user as admin?',
			text: 'Any wrong action can result to damage',
			icon: 'question',
			showCancelButton: true
		}).then((e) => {
			if(e.isConfirmed)
			{
				$.ajax({
					url: '{{ route('setAdmin') }}',
					type: 'post',
					data: {"_token":$token,id:id},
					dataType: 'html',
					success: function(data)
					{
						if(data == 1)
						{
							Swal.fire({
								title: 'New admin is added',
								icon: 'success',
								allowOutsideClick: false,
								allowEscapeKey: false
							}).then((e) =>{
								if(e.isConfirmed)
								{
									window.location.reload();
								}
							});
						}
						else
						{
							Swal.fire({
								title: 'Unexpected error occurred',
								icon: 'error',
								allowOutsideClick: false,
								allowEscapeKey: false
							})
						}
					}
				});
			}
		});
	}
	function delUser(id)
	{
		$token = $('meta[name="csrf-token"]').attr('content');
		Swal.fire({
			title: 'Are you sure you want to delete this user?',
			text: 'Any wrong action can result to damage',
			icon: 'question',
			showCancelButton: true
		}).then((e) => {
			if(e.isConfirmed)
			{
				$.ajax({
					url: '{{ route('delUser') }}',
					type: 'post',
					data: {"_token":$token,id:id},
					dataType: 'html',
					success: function(data)
					{
						if(data == 1)
						{
							Swal.fire({
								title: 'Deleted Successfully',
								icon: 'success',
								allowOutsideClick: false,
								allowEscapeKey: false
							}).then((e) =>{
								if(e.isConfirmed)
								{
									window.location.reload();
								}
							});
						}
						else
						{
							Swal.fire({
								title: 'Unexpected error occurred',
								icon: 'error',
								allowOutsideClick: false,
								allowEscapeKey: false
							})
						}
					}
				});
			}
		});
	}
</script>
@endsection