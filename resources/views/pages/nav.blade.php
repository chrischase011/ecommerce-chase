@extends('layouts.app')
@section('content')

<div class="container-fluid bg-light">
	  <div class="container">
 <!-- Featured Slider -->
  <section class="featured-pro container-fluid wow bounceInUp animated bg-light">
    <div class="slider-items-products container">
      <div class="new_title center">
        <h2>{{$name}} PRODUCTS</h2>
        <div class="starSeparator"></div>
      </div>
      <div id="featured-slider" class="product-flexslider hidden-buttons">
        <div class="slider-items slider-width-col4 products-grid">
          <!-- Item -->
          @foreach($products as $product)
          <div class="item">
            <div class="item-inner">
              <div class="item-img">
                <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="{{ route('view', ['no' => $product->product_number]) }}"> <img alt="" src="{{ asset($product->product_imagelink) }}"> </a>
                	@if($product->quantity < 1)
                	<div class="bg-light border-danger text-danger">Out of Stock</div>
                	@endif
                  <div class="actions">
                    <div class="quick-view-btn"><a href="{{ route('view', ['no' => $product->product_number]) }}" data-toggle="tooltip" data-placement="right" title="" data-original-title="Quick View"> <span>Quick View</span></a></div>
                    <div class="link-wishlist"><a href="#" data-toggle="tooltip" data-placement="right" title="" data-original-title="Wishlist"><span>Add to Wishlist</span></a></div>
                    
                  </div>
                  
                </div>
              </div>
              <div class="item-info">
                <div class="info-inner">
                  <div class="item-title"> <a title="Retis lapen casen" href="{{ route('view', ['no' => $product->product_number]) }}">{{$product->product_name}}</a> </div>
                  <div class="item-content">
                    <div class="item-price">
                      <div class="price-box"> <span class="regular-price"> <span class="price">₱ {{number_format($product->product_price,2)}}</span> </span> </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Item --> 
           @endforeach
  
          
        </div>
      </div>
    </div>
  </section>
  <!-- End Featured Slider -->
	  </div> 
</div>
@endsection