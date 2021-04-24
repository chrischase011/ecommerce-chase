@extends('admin.layout.admin')
@section('content')
<style type="text/css">
	tbody tr:hover{
		transition: 0.5s;
		background-color: #c2c2d6;
	}

</style>
@if(session()->has('shipSuccess'))
	<script type="text/javascript">
		Swal.fire({
			title: "{!! session()->get('shipSuccess')!!}",
			icon: 'success',
			allowOutsideClick: false,
			allowEscapeKey: false
		});
	</script>
@endif
@if(session()->has('shipError'))
	<script type="text/javascript">
		Swal.fire({
			title: "{!! session()->get('shipError')!!}",
			icon: 'error',
			allowOutsideClick: false,
			allowEscapeKey: false
		});
	</script>
@endif
@if(session()->has('rejectSuccess'))
	<script type="text/javascript">
		Swal.fire({
			title: "{!! session()->get('rejectSuccess')!!}",
			icon: 'success',
			allowOutsideClick: false,
			allowEscapeKey: false
		});
	</script>
@endif
@if(session()->has('rejectError'))
	<script type="text/javascript">
		Swal.fire({
			title: "{!! session()->get('rejectError')!!}",
			icon: 'error',
			allowOutsideClick: false,
			allowEscapeKey: false
		});
	</script>
@endif
<div class="container p-3">
	<div class="row">
		<div class="col-lg-12">
			<h2>Sales Management</h2>
		</div>
	</div>
</div>

<div class="container-fluid">
	<table class="table table-light table-responsive">
		<thead>
			<tr>
				<th>Tracking No.</th>
				<th>Order(s)</th>
				<th>Name</th>
				<th>Contact</th>
				<th>Shipping Address</th>
				<th>Shipping Fee</th>
				<th>Name on Card</th>
				<th>Card Address</th>
				<th>Credit Card No.</th>
				<th>Card Expiry</th>
				<th>Card CVC</th>
				<th>Total Payment</th>
				<th>Status</th>
				<th>Courier</th>
				<th>Delivery Date</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($checkouts as $checkout)
				<tr>
					<td>{{$checkout->tracking_number}}</td>
					<td class="">
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
					<td>{{$checkout->contact}}</td>
					<td>{{$checkout->address}}, {{$checkout->city}}, {{$checkout->country}}</td>
					<td>₱ {{$checkout->shipping_fee}}</td>
					<td>
						@if($checkout->noc != "")
							{{$checkout->noc}}
						@else
							Not available
						@endif
						</td>
					<td>
						@if($checkout->ccaddress != "")
							{{$checkout->ccaddress}}
						@else
							Not available
						@endif
						</td>
					<td>
						@if($checkout->ccnumber != "")
							{{$checkout->ccnumber}}
						@else
							Not available
						@endif
						</td>
					<td>
						@if($checkout->expiry != "")
							{{$checkout->expiry}}
						@else
							Not available
						@endif
						</td>
					<td>
						@if($checkout->cvc != "")
							{{$checkout->cvc}}
						@else
							Not available
						@endif
						</td>
					<td>₱ {{$checkout->grand_total}}</td>
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
					<td>{{$checkout->courier}}</td>	
					<td>{{$checkout->delivery}}</td>
					<td>
						@if($checkout->status == "1" || $checkout->status == "2")
						<button class="btn btn-success btn-sm" disabled>Ship</button> <button class="btn btn-danger btn-sm" disabled>Reject</button>
						@elseif($checkout->status == "3" || $checkout->status == "4")
							<button class="btn btn-danger btn-sm" onclick="viewReason('{{$checkout->id}}','{{$checkout->reason}}')">View Reason</button>
						@else
						<button class="btn btn-success btn-sm" onclick="shipItem('{{$checkout->id}}','{{$checkout->user_id}}')">Ship</button> <button class="btn btn-danger btn-sm" onclick="rejectItem('{{$checkout->id}}','{{$checkout->cart_id}}','{{$checkout->user_id}}')">Reject</button>
						
						@endif
						</td>
				</tr>
			@endforeach
		</tbody>
		<tfoot>
		<tr>
			<td colspan="4"><span class="">{{$checkouts->links()}}</span></td>
		</tr>
	</tfoot>
	</table>
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
<div class="modal fade" id="shipItem">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Ship Item</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
			</div>
			<form action="{{ route('shipItem') }}" method="post">
				{{csrf_field()}}
			<div class="modal-body">
				<input type="hidden" id="checkoutID" name="checkoutID">
				<input type="hidden" id="userID" name="userID">
				<div class="form-row">
						<label class="col-lg-3">Select Courier</label>
						<div class="col-lg-9">
							<select class="form-control w-100" name="courier">
								<option value="J&T Express">J&T Express</option>
								<option value="2Go">2Go</option>
								<option value="JRS Express">JRS Express</option>
								<option value="Mr. Speedy">Mr. Speedy</option>
							</select>
						</div>
				</div>
				<div class="form-row">
					<label class="col-lg-3">Shipping Fee</label>
					<div class="col-lg-9">
							<input type="number" name="shipFee" step="0.25" class="form-control">
						</div>
				</div>
				<div class="form-row">
						<label class="col-lg-3">Delivery Date</label>
						<div class="col-lg-9">
							<input type="date" name="delivery" class="form-control">
						</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success" type="submit">Ship Item</button>
			</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="rejectItem">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Reject Item</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
			</div>
			<form action="{{ route('rejectItem') }}" method="post">
				{{csrf_field()}}
			<div class="modal-body">
				<input type="hidden" id="RcheckoutID" name="RcheckoutID">
				<input type="hidden" id="cartID" name="cartID">
				<input type="hidden" id="RuserID" name="userID">
				<div class="form-row">
					<h3 class="text-center">Enter Reason of Rejection</h3>
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
	function shipItem(id,userID)
	{
		$("#shipItem").modal('show');
		$("#checkoutID").val(id);
		$("#userID").val(userID);
	}
	function rejectItem(id,cartID,userID)
	{
		$("#rejectItem").modal('show');
		$("#RcheckoutID").val(id);
		$("#cartID").val(cartID);
		$("#RuserID").val(userID);
	}
	function viewReason(id,reason)
	{
		$("#viewReason").modal('show');
		$("#vReason").text(reason);
	}
</script>
@endsection