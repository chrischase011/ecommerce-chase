@extends('layouts.app')
@section('content')
<style type="text/css">
	body{
		background-color: #292b2c;
	}
</style>
<!-- Main Container -->
  <section class="main-container col1-layout bg-light py-4">
    <div class="main container">
      <div class="col-main">
        <div class="cart">
          <div class="page-title">
            <h1>Shopping Cart</h1>
          </div>
          <div class="table-responsive">
            <form method="post" action="#">
              <fieldset>
                <table class="data-table cart-table" id="shopping-cart-table">
                  <thead>
                    <tr class="first last">
                      <th rowspan="1">Picture</th>
                      <th rowspan="1"><span class="nobr">Product Name</span></th>
                      <th rowspan="1" class="hidden-phone"><span class="nobr">Move to Wishlist</span></th>
                      <th colspan="1" class="a-center"><span class="nobr">Unit Price</span></th>
                      <th class="a-center " rowspan="1">Qty</th>
                      <th colspan="1" class="a-center">Subtotal</th>
                      <th class="a-center" rowspan="1">Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr class="first last">
                      <td class="a-right last" colspan="50"><button onclick="window.location.href='{{ route('shop') }}'" class="button btn-continue" title="Continue Shopping" type="button"><span>Continue Shopping</span></button>
                        <button class="button btn-update" title="Update Cart" value="update_qty" name="update_cart_action" type="button" onclick="window.location.reload()"><span>Update Cart</span></button>
                        {{$carts->links()}}
                        </td>
                    </tr>
                  </tfoot>
                  <tbody>
                  	<?php $subtotal = 0; ?>
                  	@foreach($carts as $cart)
                  		@foreach($products as $product)

                  			@if($product->product_number == $cart->product_number && $cart->isCheckout != "1")

                  			<?php $subtotal = $subtotal + $cart->subtotal; ?>

                  				<tr class="first odd">
                      <td class="image"><a class="product-image" title="" href="#"><img width="75" height="75" src="{{ asset($product->product_imagelink) }}"></a></td>
                      <td><h2 class="product-name"> <a href="#">{{$product->product_name}}</a> </h2></td>
                      <td class="a-center hidden-table"><a class="link-wishlist1 use-ajax" href="#">Move</a></td>
                      <td class="a-center hidden-table"><span class="cart-price"> <span class="price">₱ {{number_format($product->product_price,2)}}</span> </span></td>
                      <td class="a-center movewishlist"><input maxlength="12" class="input-text qty" title="Qty" size="4" value="{{$cart->quantity}}" name="" readonly></td>
                      <td class="a-center movewishlist"><span class="cart-price"> <span class="price">₱ {{number_format($cart->subtotal,2)}}</span> </span></td>
                      <td class="a-center last"><a class="button remove-item" title="Remove item" href="#" onclick="removeItem({{$cart->id}})"><span><span>Remove item</span></span></a></td>
                    </tr>
                  			@endif
                  		@endforeach
                  	@endforeach
                    
                  </tbody>
                </table>
              </fieldset>
            </form>
          </div>
          <!-- BEGIN CART COLLATERALS -->
          <div class="cart-collaterals row">
            <div class="col-sm-12">
              <div class="totals">
                <h3>Shopping Cart Total</h3>
                <div class="inner">
                  <table class="table shopping-cart-table-total" id="shopping-cart-totals-table">
                    <colgroup>
                    <col>
                    <col width="1">
                    </colgroup>
                    <tbody>
                      <tr>
                        <td colspan="1" class="a-left"> Tax (12%)</td>
                        <td class="a-right"><span class="price">₱ 
                        	
                        	<?php 
                        		$addFee_n = $subtotal * 0.12;
                        		echo number_format($addFee_n,2);
                        	?>
                        	
                        </span></td>
                      </tr>
                      <tr>
                        <td colspan="1" class="a-left"> Subtotal </td>
                        <td class="a-right"><span class="price">₱ {{number_format($subtotal,2)}}</span></td>
                      </tr>

                      <tr>
                        <td colspan="1" class="a-left"><strong>Grand Total</strong></td>
                        <td class="a-right"><strong><span class="price">₱ {{number_format(($addFee_n + $subtotal),2)}}</span></strong></td>
                      </tr>
                    </tbody>
                  </table>
                  <ul class="checkout">
                    <li>
                      <button onclick="window.location.href='{{ route('checkout') }}'" class="button btn-proceed-checkout" title="Proceed to Checkout" type="button"><span>Proceed to Checkout</span></button>
                    </li>
                    <br>
                   {{--  <li><a title="Checkout with Multiple Addresses" href="#">Checkout with Multiple Addresses</a> </li> --}}
                    <br>
                  </ul>
                </div>
              </div>
              <!--inner--> 
              
            </div>
          </div>
          
          <!--cart-collaterals--> 
          
        </div>
      </div>
    </div>
  </section>
<script type="text/javascript">
	function removeItem(id)
	{
		$token = $('meta[name="csrf-token"]').attr('content');
		Swal.fire({
			title: "Are you sure you want to remove item in the cart?",
			icon: "question",
			showCancelButton: true
		}).then((e) =>{
			if(e.isConfirmed)
			{
				$.ajax({
					url: '{{ route('removeItem') }}',
					type: 'post',
					data: {'_token':$token, id:id},
					dataType: 'html',
					success: function(data)
					{
						if(data == 1)
						{
							Swal.fire({
								title: "Removed successfully",
								icon: "success",
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
								title: "Unexpected Error Occurred",
								icon: "error",
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