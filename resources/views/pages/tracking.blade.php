@extends('layouts.app')
@section('content')
@if(session()->has('cancelSuccess'))
	<script type="text/javascript">
		Swal.fire({
			title: "{!! session()->get('cancelSuccess')!!}",
			icon: 'success',
			allowOutsideClick: false,
			allowEscapeKey: false
		});
	</script>
@endif
<div class="container-fluid bg-light my-5">
	<div class="page-title p-2">
            <h1 class="mx-5">Tracking Information</h1>

		<div class="container d-flex ">
			
				<a href="{{ route('checkout') }}"><span class="badge badge-pill badge-light h2 mr-3">Checkout Info</span></a>
				<a href="{{ route('tracking') }}"><span class="badge badge-pill badge-secondary border h2 mr-3">Tracking Info</span></a>
			
		</div>

    </div>
	<div class="container">
		<span class="text-danger text-xs">Note: If Items are delivered, please click delivered. Once the Item is to be shipped, you cannot cancel it.</span> 
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
				<th>Action</th>
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
					<td>
						@if($checkout->status == "0")
						
							<button type="button" class="btn btn-danger btn-sm" onclick="cancelItem('{{$checkout->id}}','{{$checkout->cart_id}}')">Cancel</button>
						
						
						@elseif($checkout->status == "1")					
						
								<button type="button" class="btn btn-success btn-sm" onclick="delivered('{{$checkout->id}}')">Delivered</button>
						
						@elseif($checkout->status == "3" || $checkout->status == "4")
							<button class="btn btn-danger btn-sm" onclick="viewReason('{{$checkout->id}}','{{$checkout->reason}}')">View</button>

						@endif
					</td>
					
				</tr>
			@endforeach
			</tbody>
			<tfoot>
				{{$checkouts->links()}}
			</tfoot>
		</table>
		<br><br>
	</div>
</div>
<div class="modal fade" id="viewReason">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Reason of Rejection</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body p-5">
				<p class="text-justify text-center" id="vReason"></p>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="rejectItem">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Cancel Item</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
			</div>
			<form action="{{ route('cancelItem') }}" method="post">
				{{csrf_field()}}
			<div class="modal-body">
				<input type="hidden" id="checkoutID" name="checkoutID">
				<input type="hidden" id="cartID" name="cartID">
				<div class="form-row">
					<h4 class="text-center">Enter Reason of Rejection</h4>
					<div class="col-lg-12">
						<textarea class="form-control" style="resize: none;" rows="10" placeholder="Enter Reason" name="reason"></textarea>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-danger">Reject</button>
			</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	function viewReason(id,reason)
	{
		$("#viewReason").modal('show');
		$("#vReason").text(reason);
	}
	function cancelItem(id,cartID)
	{
		$("#rejectItem").modal('show');
		$("#checkoutID").val(id);
		$("#cartID").val(cartID);
	}
	function delivered(id)
	{
		$token = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			url: '{{ route('delivered') }}',
			type: 'post',
			data: {'_token':$token,id:id},
			dataType: 'html',
			success: function(data)
			{
				if(data == 1)
				{
					Swal.fire({
						title: 'Thanks for purchasing.',
						text: 'Hope to see you again here. :)',
						icon: 'success',
						allowEscapeKey: false,
						allowOutsideClick: false
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
						title: 'Unexpected error occurred.',
						icon: 'error',
					});
				}
			}
		});
	}
</script>
@endsection