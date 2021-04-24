@extends('layouts.app')
@section('content')

<div class="container-fluid bg-light my-5">
	<div class="container">
		<h3 class="py-2">Welcome to Shop</h3>

	<section class="related-pro wow bg-light">
    <div class="container">
      <div class="slider-items-products">
        <div class="new_title center">
          <h2>All Products</h2>
        </div>
        <div id="related-products-slider" class="product-flexslider hidden-buttons">
          <div class="slider-items slider-width-col4 products-grid">
          	@foreach($products as $product)

            <div class="item">
              <div class="item-inner">
                <div class="item-img">
                  <div class="item-img-info"><a href="{{ route('view', ['no' => $product->product_number]) }}" title="{{$product->product_name}}" class="product-image"><img src="{{ asset($product->product_imagelink) }}" alt="Retis lapen casen"></a>
                    
                    <div class="actions">
                      <div class="quick-view-btn"><a href="{{ route('view', ['no' => $product->product_number]) }}" data-toggle="tooltip" data-placement="right" title="" data-original-title="Quick View"> <span>Quick View</span></a></div>
                    </div>
                  </div>
                </div>
                <div class="item-info">
                  <div class="info-inner">
                    <div class="item-title"><a href="{{ route('view', ['no' => $product->product_number]) }}" title="{{$product->product_name}}">{{$product->product_name}}</a> </div>
                    <div class="item-content">
                      <div class="item-price">
                        <div class="price-box"><span class="regular-price"><span class="price">₱ {{number_format($product->product_price,2)}}</span> </span> </div>
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
  </section><br>
  <hr>
  <section class="related-pro wow bg-light">
    <div class="container">
      <div class="slider-items-products">
        <div class="new_title center">
          <h2>Men Products</h2>
        </div>
        <div id="related-products-slider" class="product-flexslider hidden-buttons">
          <div class="slider-items slider-width-col4 products-grid">
          	@foreach($menProducts as $menProduct)

            <div class="item">
              <div class="item-inner">
                <div class="item-img">
                  <div class="item-img-info"><a href="{{ route('view', ['no' => $menProduct->product_number]) }}" title="{{$menProduct->product_name}}" class="product-image"><img src="{{ asset($menProduct->product_imagelink) }}" alt="Retis lapen casen"></a>
                    
                    <div class="actions">
                      <div class="quick-view-btn"><a href="{{ route('view', ['no' => $menProduct->product_number]) }}" data-toggle="tooltip" data-placement="right" title="" data-original-title="Quick View"> <span>Quick View</span></a></div>
                    </div>
                  </div>
                </div>
                <div class="item-info">
                  <div class="info-inner">
                    <div class="item-title"><a href="{{ route('view', ['no' => $menProduct->product_number]) }}" title="{{$menProduct->product_name}}">{{$menProduct->product_name}}</a> </div>
                    <div class="item-content">
                      <div class="item-price">
                        <div class="price-box"><span class="regular-price"><span class="price">₱ {{number_format($menProduct->product_price,2)}}</span> </span> </div>
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
  </section><br>
  <hr>

    <section class="related-pro wow bg-light">
    <div class="container">
      <div class="slider-items-products">
        <div class="new_title center">
          <h2>Women Products</h2>
        </div>
        <div id="related-products-slider" class="product-flexslider hidden-buttons">
          <div class="slider-items slider-width-col4 products-grid">
          	@foreach($womenProducts as $womenProduct)

            <div class="item">
              <div class="item-inner">
                <div class="item-img">
                  <div class="item-img-info"><a href="{{ route('view', ['no' => $womenProduct->product_number]) }}" title="{{$womenProduct->product_name}}" class="product-image"><img src="{{ asset($womenProduct->product_imagelink) }}" alt="Retis lapen casen"></a>
                    
                    <div class="actions">
                      <div class="quick-view-btn"><a href="{{ route('view', ['no' => $womenProduct->product_number]) }}" data-toggle="tooltip" data-placement="right" title="" data-original-title="Quick View"> <span>Quick View</span></a></div>
                    </div>
                  </div>
                </div>
                <div class="item-info">
                  <div class="info-inner">
                    <div class="item-title"><a href="{{ route('view', ['no' => $womenProduct->product_number]) }}" title="{{$womenProduct->product_name}}">{{$womenProduct->product_name}}</a> </div>
                    <div class="item-content">
                      <div class="item-price">
                        <div class="price-box"><span class="regular-price"><span class="price">₱ {{number_format($womenProduct->product_price,2)}}</span> </span> </div>
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
  </section><br>
  <hr>

    <section class="related-pro wow bg-light">
    <div class="container">
      <div class="slider-items-products">
        <div class="new_title center">
          <h2>Other Products</h2>
        </div>
        <div id="related-products-slider" class="product-flexslider hidden-buttons">
          <div class="slider-items slider-width-col4 products-grid">
          	@foreach($otherProducts as $otherProduct)

            <div class="item">
              <div class="item-inner">
                <div class="item-img">
                  <div class="item-img-info"><a href="{{ route('view', ['no' => $otherProduct->product_number]) }}" title="{{$otherProduct->product_name}}" class="product-image"><img src="{{ asset($otherProduct->product_imagelink) }}" alt="Retis lapen casen"></a>
                    
                    <div class="actions">
                      <div class="quick-view-btn"><a href="{{ route('view', ['no' => $otherProduct->product_number]) }}" data-toggle="tooltip" data-placement="right" title="" data-original-title="Quick View"> <span>Quick View</span></a></div>
                    </div>
                  </div>
                </div>
                <div class="item-info">
                  <div class="info-inner">
                    <div class="item-title"><a href="{{ route('view', ['no' => $otherProduct->product_number]) }}" title="{{$otherProduct->product_name}}">{{$otherProduct->product_name}}</a> </div>
                    <div class="item-content">
                      <div class="item-price">
                        <div class="price-box"><span class="regular-price"><span class="price">₱ {{number_format($otherProduct->product_price,2)}}</span> </span> </div>
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

	</div>
</div>

@endsection