@extends('layouts.app')
@section('content')
<style type="text/css">
	body{
		background-color: #292b2c;
	}
</style>
<br><br><br>
@if(session()->has('addCart'))
	<script type="text/javascript">
		Swal.fire({
			title: "{!! session()->get('addCart')!!}",
			icon: 'success',
			allowOutsideClick: false,
			allowEscapeKey: false
		}).then((e) =>{
			window.location.href = '{{ route('cart') }}';
		});
	</script>
@endif
@if(session()->has('errorCart1'))
	<script type="text/javascript">
		Swal.fire({
			title: "{!! session()->get('errorCart1')!!}",
			icon: 'error',
			allowOutsideClick: false,
			allowEscapeKey: false
		});
	</script>
@endif
@if(session()->has('errorCart2'))
	<script type="text/javascript">
		Swal.fire({
			title: "{!! session()->get('errorCart2')!!}",
			icon: 'error',
			allowOutsideClick: false,
			allowEscapeKey: false
		});
	</script>
@endif

@foreach($products as $product)
<div class="container-fluid my-3 bg-light p-3">
	<input type="hidden" id="origPrice" value="{{$product->product_price}}">
		<div class="row">
			<div class="col-lg-6">
				<img src="{{ asset($product->product_imagelink) }}" class="w-100" style="max-height: 500px;">
			</div>
			<div class="col-lg-6 ">
				<div class="card w-100">
					<div class="card-header">
						<h4 class="card-title text-center">{{$product->product_name}}</h4>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col-lg-2">
								<div id="initialRate" class="my-1"></div> 
							</div>
							<div class="col-lg-10">
								<small class="text-muted mt-1">{{count($ratings)}} Review(s) | {{number_format($starAvg,1)}} </small>
							</div>
						</div>
						<hr>
						<div class="form-row">
							<div class="col-lg-9">
								<h1 style="font-family: 'Lucida Handwriting'; color: #C2A476;">₱ <span class="pPrice">{{number_format($product->product_price,2)}}</span></h1>
							</div>
							<div class="col-lg-3">
								@if($product->quantity > 0)
								<p class="availability in-stock pull-right"><span>In Stock</span></p>
								@else
								<p class="availability out-of-stock pull-right"><span>Out of Stock</span></p>
								@endif
							</div>
						</div>
						<div class="form-row">
							<span class="text-muted text-lg font-weight-bold" style="font-family: 'Raleway', sans-serif;">Description</span><br>
							
						</div>
						<div class="form-row">
							<p class="text-muted text-sm" style="font-family: 'Raleway', sans-serif;">@if($product->product_desc != "")
                    		{{$product->product_desc}}
                    	@else
                    		No Description
                    	@endif
                    		</p>
						</div>
						<hr>
						<form action="{{ route('addToCart') }}" method="post">
								{{csrf_field()}}
								<input type="hidden" id="origPrice" name="origPrice" value="{{$product->product_price}}">
								<input type="hidden" name="pNo" id="pNo" value="{{$product->product_number}}">
								<input type="hidden" id="subtotal" name="subtotal" value="{{$product->product_price}}">
						<div class="form-row">
							
							<div class="col-lg-4">
								<div class="d-flex">
									<button type="button" class="btn btn-light border" onclick="minus()"><i class="fa fa-minus"></i></button> <input type="text" id="quan" value="1" name="quan" style="text-align: center; width: 40px;"> <button type="button" class="btn btn-light border" onclick="plus()"><i class="fa fa-plus"></i></button>

									
								</div>
								
							</div>
							<div class="col-lg-8">
								<div class="d-flex">
									@if($product->quantity > 0)
									<button type="submit" class="btn text-white" style="background-color: #C2A476;"><i class="fa fa-shopping-cart mr-1"></i>Add To Cart</button>
									@else
									<button type="button" class="btn text-white" disabled style="background-color: #C2A476;"><i class="fa fa-shopping-cart mr-1"></i>Add To Cart</button>
									@endif
								</div>
							</div>
							
						</div>
						</form>
					</div>
				</div>
				{{-- Review --}}
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<div class=" col-lg-12 col-sm-12 col-xs-12 ">
              <div class="add-info">
                <ul id="product-detail-tab" class="nav nav-tabs" role="tablist">
                  <li class="active"> <a href="#product_tabs_description" data-toggle="tab" class="text-black active" style="color: black !important;"> Product Description </a> </li>
                  <li class="mx-3"> <a href="#reviews_tabs" data-toggle="tab" class=" text-black" style="color: black !important;">Reviews</a> </li>
                  
                </ul>
                <div id="productTabContent" class="tab-content">
                  <div class="tab-pane fade in show active p-2" id="product_tabs_description">
                    <div class="std">
                    	@if($product->product_desc != "")
                    		<p>{{$product->product_desc}}</p>
                    	@else
                    		<p>No Description</p>
                    	@endif
                      
                    </div>
                  </div>
                  <div class="tab-pane fade" id="reviews_tabs">
                   	<div class="form-row my-2">
					<div class="col-lg-12">
						<div class="card p-3" style="max-height: 900px; overflow: auto;">
							<h5 class="card-title">Ratings and Reviews</h5>
							<div class="card-body">
								<div class="form-row">
									<div class="col-lg-12">
										<form action="{{ route('ratings') }}" method="post">
											{{csrf_field()}}
											<input type="hidden" name="pNumber" value="{{$product->product_number}}">
											<input type="hidden" name="userID" value="@if(Auth::check()){{Auth::user()->id}}@endif">
										<center>
											<div id="rate"></div>
											<input type="hidden" name="rateStar" id="rateStar">
										</center>
										<div class="form-row my-1">
											<div class="col-lg-12">
												<textarea name="reviewS" class="form-control w-100" style="resize: none; font-size: 13px; overflow: hidden; border-top: none; border-right: none;border-left: none;" placeholder="Leave a Review"></textarea>
												<button type="submit" class="btn btn-primary float-right btn-sm my-2">Post</button>

											</div>
										</div>
										</form>
									</div>
								</div>
								<div class="form-row">
									<div class="col-lg-12">
										@if(count($ratings) > 0)
											@foreach($ratings as $rating)
												<div class="card my-2 p-2">
													<h5 class="card-title">
														@foreach($users as $user)
															<div class="d-flex">
															@if($user->id == $rating->user_id)
															
                  								  <img alt="Image placeholder" class="rounded-circle" style="width: 50px;" src="data:jpeg;base64,{{$user->pic_location}}">
																@if($user->mi != "")
																	<span class="h6 my-3 mx-2">{{$user->fname." ".$user->mi." ".$user->lname}} </span>
																@else
																	<span class="h6 my-3 mx-2">{{$user->fname." ".$user->lname}}</span>
																@endif
																
															@endif
														</div>
															
														@endforeach
													</h5>
													<div class="card-body">
														<div class="form-row">
															<div class="col-lg-6">
																<div id="rated{{$rating->id}}"></div>

												<script type="text/javascript">
												$("#rated{{$rating->id}}").rateYo({
												rating: {{$rating->rating}},
												starWidth: "15px",
												fullStar: true,
												readOnly: true,
												onInit: function(rating, rateYoInstance)
												{
													
												}
											});
											</script>
															</div>
															<div class="col-lg-6">
																<span class="text-muted float-right">{{$rating->created_at}}</span>
															</div>
														</div>
														<div class="form-row my-2">
															<div class="col-lg-12">
																<span class="text-muted">{{$rating->review}}</span>
															</div>
														</div>
														
													</div>
												</div>
											@endforeach
										@endif
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
                  </div>
                
                </div>
              </div>
            </div>
			</div>
		</div>
</div>
@endforeach
<!-- Related Products Slider -->
  <section class="related-pro wow bounceInUp animated bg-light">
    <div class="container">
      <div class="slider-items-products">
        <div class="new_title center">
          <h2>Other Products</h2>
        </div>
        <div id="related-products-slider" class="product-flexslider hidden-buttons">
          <div class="slider-items slider-width-col4 products-grid">
          	@foreach($relatedProducts as $relatedProduct)

            <div class="item">
              <div class="item-inner">
                <div class="item-img">
                  <div class="item-img-info"><a href="{{ route('view', ['no' => $relatedProduct->product_number]) }}" title="{{$relatedProduct->product_name}}" class="product-image"><img src="{{ asset($relatedProduct->product_imagelink) }}" alt="Retis lapen casen"></a>
                    
                    <div class="actions">
                      <div class="quick-view-btn"><a href="{{ route('view', ['no' => $relatedProduct->product_number]) }}" data-toggle="tooltip" data-placement="right" title="" data-original-title="Quick View"> <span>Quick View</span></a></div>
                    </div>
                  </div>
                </div>
                <div class="item-info">
                  <div class="info-inner">
                    <div class="item-title"><a href="{{ route('view', ['no' => $relatedProduct->product_number]) }}" title="{{$relatedProduct->product_name}}">R{{$relatedProduct->product_name}}</a> </div>
                    <div class="item-content">
                      <div class="item-price">
                        <div class="price-box"><span class="regular-price"><span class="price">₱ {{number_format($relatedProduct->product_price,2)}}</span> </span> </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Related Products Slider End --> 

<script type="text/javascript">
	$(function(){
		$("#quan").on("change keyUp keyDown input",function(){

			var x = $('#quan').val();
			if(x == "")
			{
				$('#quan').val("0");
				price = 0;
			}
			if(isNaN(x))
			{
				$('#quan').val("0");
				price = 0;
			}
			var num = parseInt(x);
			var y = $("#origPrice").val();
			var o = parseFloat(y);
			price = o * num;
			$(".pPrice").text(price.toFixed(2));
			$("#subtotal").val(price);
		});
	});
	function minus()
	{
		var x = $('#quan').val();
		var num = parseInt(x);
		var p = $(".pPrice").text();
		var price = parseFloat(p);
		var y = $("#origPrice").val();
		var o = parseFloat(y);
		if(num < 1)
		{
			num = 0;
		}
		else
		{
			num--;
			price -= o;
		}
		$("#quan").val(num);
		$(".pPrice").text(price.toFixed(2));
		$("#subtotal").val(price);
	}
	function plus()
	{
		var x = $('#quan').val();
		var num = parseInt(x);
		var p = $(".pPrice").text();
		var price = parseFloat(p);
		var y = $("#origPrice").val();
		var o = parseFloat(y);
		num++;
		price += o;
		$("#quan").val(num);
		$(".pPrice").text(price.toFixed(2));
		$("#subtotal").val(price);
	}
	var st = '{{$starAvg}}';
	var stt = 0;
	if(st == "")
	{
		stt=0;
	}
	else
	{
		stt = parseInt(st);
	}
	$("#initialRate").rateYo({
		rating: stt,
		starWidth: "13px",
		starHeight:"10px",
		readOnly: true,
		onInit: function(rating, rateYoInstance)
		{
			
		},
		onSet: function(rating, rateYoInstance)
		{

		}
	});
	$("#rate").rateYo({
		starWidth: "22px",
		fullStar: true,
		onInit: function(rating, rateYoInstance)
		{
			
		},
		onSet: function(rating, rateYoInstance)
		{
			$("#rateStar").val(rating);
		}
	});
</script>
@endsection