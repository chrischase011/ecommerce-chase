<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<![endif]-->
	
	<!-- Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta charset="utf-8">
	<meta name="description" content="Web Apparel - Your choice for Filipino Brands">
    <meta name="keywords" content="Web Apparel, Iconic Alley, Clothes, Filipino">
    <meta name="author" content="Hypertext Assassins">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
  <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{$title}}</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/internal.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/bootstrap.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/fontawesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('assets/css/animate.css') }}" type="text/css">
	<script src="{{ URL::asset('assets/js/jquery-3.5.1.min.js') }}"></script>
  <script src="{{ URL::asset('assets/js/bootstrap.js') }}"></script>
	<script src="{{ URL::asset('assets/js/bootstrap.bundle.min.js') }}"></script>
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
	<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/font-awesome.css') }}" media="all">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/simple-line-icons.css') }}" media="all">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/owl.carousel.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/owl.theme.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/jquery.bxslider.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/jquery.mobile-menu.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/revslider.css') }}" >
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/style.css') }}" media="all">

  <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/flexslider.css') }}">
	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,600,600italic,400italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
  <script src="{{ URL::asset('assets/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
  <script src="{{ URL::asset('assets/js/city.min.js') }}"></script>
  <script src="{{ URL::asset('assets/js/jquery.creditCardValidator.js') }}"></script>
  <script src='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.js'></script>
  <link href='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.css' rel='stylesheet' />
  <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.min.js"></script>
<link
rel="stylesheet"
href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.css"
type="text/css"
/>
<!-- Promise polyfill script required to use Mapbox GL Geocoder in IE 11 -->
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
</head>
<style type="text/css">
  body{
    background-color: #292b2c;
  }
  
</style>
<style>
/* width */
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
</style>
<body class="cms-index-index index">
	
	
<div id="page"> 
  <!-- Header -->
  <header>
    <div class="header-container">
      <div class="header-top">
        <div class="container">
          <div class="row">

            <style type="text/css">
              .notif .notif-down{
                display: none;
                background-color: #fff;
              }
              .notif:hover .notif-down{
                display: block;
                background-color: #fff;
              }
            </style>
              <!-- Header Top Links -->
              <div class="toplinks">
                <div class="links">
                @if(Auth::check())
                  @if(Auth::user()->usercontrol == "1")
                    <div class="check"><a title="Admin Dashboard" href="{{ route('dashboard') }}"><span class="hidden-xs">Admin</span></a></div>
                  @endif
                <div class="check"><a title="My Cart" href="{{ route('cart') }}"><span class="hidden-xs">My Cart</span></a></div>
                  <div class="myaccount"><a title="My Account" href="{{ route('profile') }}"><span class="hidden-xs">My Account</span></a></div>
                  <div class="check"><a title="Checkout" href="{{ route('checkout') }}"><span class="hidden-xs">Checkout</span></a></div>
                  <div class="check"><a title="Tracking" href="{{ route('tracking') }}"><span class="hidden-xs">Tracking</span></a></div>
                    <div class="notif"><a title="Notification" href="{{ route('notification') }}"><span class="hidden-xs">Notification
                     
                    <span class="badge badge-pill badge-danger">{{count($notifications)}}</span>
                   </span></a></div>
                  <!-- Header Company -->
                  @else
                  <!-- End Header Company -->

                  <div class="login"><a href="{{ route('signinSignup') }}"><span class="hidden-xs">Sign in</span></a></div>
                  @endif
                    @if(Auth::check())
                    <div class="logout"><a href="{{ route('logout') }}"><span class="hidden-xs">Logout</span></a></div>
                    @endif
                </div>
              
              </div>
              <!-- End Header Top Links --> 
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- end header --> 
   <div class="modal fade bs-example-modal-lg " id="searchModal">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content bg-dark">
                    <div class="modal-header">
                      <button aria-label="Close" data-dismiss="modal" class="close" type="button"><img src="{{ asset('assets/images/interstitial-close.png') }}" alt="close"> </button>
                    </div>
                    <div class="modal-body">
                      <form class="navbar-form">
                        <div id="search">
                          <div class="input-group">
                            <input name="search" placeholder="Search" class="form-control" type="text">
                            <button type="button" class="btn-search"><i class="fa fa-search"></i></button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

  <!-- Navbar -->
  <nav class="">
    <div class="container">
          <!-- Header Logo -->
          <div class="logo d-none d-sm-block"><a title="logo" href="{{ url('/') }}"><img alt="Datson" src="{{ asset('assets/img/logo.png') }}" style="width: 200px; height: 150px;"></a></div>
          <!-- End Header Logo --> 

        <div class="mm-toggle-wrap" style="">
          <div class="mm-toggle"><i class="fa fa-reorder"></i><span class="mm-label text-black">Menu</span> </div>
        </div>
<ul class="nav hidden-xs hidden-sm menu-item menu-item-left d-none d-sm-block">
            <li class="level0 parent drop-menu"><a href="{{ url('/') }}" class="text-black"><span >Home</span></a>
              
            </li>
            <li class="level0 parent drop-menu"><a href="{{ route('link',['name' => 'Women']) }}"><span>Women</span> </a></li>
           
            <li class="level0 parent drop-menu"><a href="{{ route('link',['name' => 'Men']) }}"><span>Men</span></a></li>
            </ul>
            <ul class="nav hidden-xs menu-item menu-item-left d-none d-sm-block">
             <li class="level0 parent drop-menu"><a href="{{ route('link',['name' => 'Other']) }}"><span>Other Products</span></a>
            </li>
            <li class="mega-menu"><a class="level-top" href="{{ route('shop') }}"><span>Shop</span></a>
              
            </li>
          
          </ul>
          
          
      
    </div>
  </nav>
  <!-- end nav -->

  @yield('content')


  <!-- Footer -->
  <footer>
    
    
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-xs-12 coppyright">&copy; All Rights Reserved.</div>
          
        </div>
      </div>
    </div>
  </footer>
</div>
                
              
</body>
<script type="text/javascript">

</script>
<div id="mobile-menu" style="">

  <ul>
    <li>
      <button class="btn btn-dark w-25 mm-toggle"><</button>
    </li>
    <li>
      <div class="home"><a href="{{ route('/') }}"><i class="icon-home"></i>Home</a> </div>
    </li>
    @if(Auth::check())
      @if(Auth::user()->usercontrol == "1")
        <li><a href="{{ route('dashboard') }}">Admin</a></li>
      @endif
    @endif
    <li><a href="{{ route('shop') }}">Shop</a></li>
    @if(Auth::check())
      <li><a href="{{ route('cart') }}">Cart</a></li>
      <li><a href="{{ route('profile') }}">My Account</a></li>
      <li><a href="{{ route('checkout') }}">Checkout</a></li>
      <li><a href="{{ route('tracking') }}">Tracking</a></li>
      <li><a href="{{ route('notification') }}">Notifications <span class="badge badge-pill badge-danger">{{count($notifications)}}</span></a></li>

    @endif
    <li><a href="{{ route('link',['name' => 'Men']) }}">Men</a>
    </li>
    <li><a href="{{ route('link',['name' => 'Women']) }}">Women</a>
    </li>
    <li><a href="{{ route('link',['name' => 'Other']) }}">Other Products</a>
    </li>
    @if(Auth::check())
    <li><a href="{{ route('logout') }}">Logout</a></li>
    @else
      <li><a href="{{ route('signinSignup') }}">Sign in/Sign up</a></li>
    @endif
  </ul>
 

<!-- End Footer -->

<!-- JavaScript -->

<script type="text/javascript" src="{{ URL::asset('assets/js/common.js') }}"></script> 
<script type="text/javascript" src="{{ URL::asset('assets/js/countdown.js') }}"></script> 
<script type="text/javascript" src="{{ URL::asset('assets/js/owl.carousel.min.js') }}"></script> 
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.mobile-menu.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.flexslider.js') }}"></script> 
<script type="text/javascript" src="{{ URL::asset('assets/js/parallax.js') }}"></script> 
<script type="text/javascript" src="{{ URL::asset('assets/js/cloud-zoom.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/revslider.js') }}"></script> 
<script type="text/javascript" src="{{ URL::asset('assets/js/revolution-slider.js') }}"></script> 
<script type="text/javascript" src="{{ URL::asset('assets/js/revolution.extension.js') }}"></script> 

  <script type="text/javascript">
var dthen1 = new Date("12/25/17 11:59:00 PM");
	start = "05/03/15 03:02:11 AM";
	start_date = Date.parse(start);
	var dnow1 = new Date(start_date);
	if (CountStepper > 0)
	ddiff = new Date((dnow1) - (dthen1));
	else
	ddiff = new Date((dthen1) - (dnow1));
	gsecs1 = Math.floor(ddiff.valueOf() / 1000);
	
	var iid1 = "countbox_1";
	CountBack_slider(gsecs1, "countbox_1", 1);
	
	var dthen1 = new Date("12/12/17 11:59:00 PM");
	start = "01/20/16 03:02:11 AM";
	start_date = Date.parse(start);
	var dnow1 = new Date(start_date);
	if (CountStepper > 0)
	ddiff = new Date((dnow1) - (dthen1));
	else
	ddiff = new Date((dthen1) - (dnow1));
	gsecs1 = Math.floor(ddiff.valueOf() / 1000);
	
	var iid1 = "countbox_2";
	CountBack_slider(gsecs1, "countbox_2", 1);
</script>

<script type="text/javascript">
					var tpj=jQuery;			
					var revapi4;
					tpj(document).ready(function() {
						if(tpj("#rev_slider_4_1").revolution == undefined){
							revslider_showDoubleJqueryError("#rev_slider_4_1");
						}else{
							revapi4 = tpj("#rev_slider_4_1").show().revolution({
								sliderType:"standard",
								sliderLayout:"fullwidth",
								dottedOverlay:"none",
								delay:9000,
								navigation: {
									keyboardNavigation:"off",
									keyboard_direction: "horizontal",
									mouseScrollNavigation:"off",
									onHoverStop:"off",
									touch:{
										touchenabled:"on",
										swipe_threshold: 75,
										swipe_min_touches: 1,
										swipe_direction: "horizontal",
										drag_block_vertical: false
									}
									,
									arrows: {
										style:"zeus",
										enable:true,
										hide_onmobile:true,
										hide_under:750,
										hide_onleave:true,
										hide_delay:200,
										hide_delay_mobile:1200,
										tmp:'<div class="tp-title-wrap">  	<div class="tp-arr-imgholder"></div> </div>',
										left: {
											h_align:"left",
											v_align:"center",
											h_offset:30,
											v_offset:0
										},
										right: {
											h_align:"right",
											v_align:"center",
											h_offset:30,
											v_offset:0
										}
									}
									,
									bullets: {
										enable:true,
										hide_onmobile:true,
										hide_under:600,
										style:"metis",
										hide_onleave:true,
										hide_delay:200,
										hide_delay_mobile:1200,
										direction:"horizontal",
										h_align:"center",
										v_align:"bottom",
										h_offset:0,
										v_offset:30,
										space:5,
										tmp:'<span class="tp-bullet-img-wrap">  <span class="tp-bullet-image"></span></span><span class="tp-bullet-title">title</span>'
									}
								},
								viewPort: {
									enable:true,
									outof:"pause",
									visible_area:"80%"
								},
								responsiveLevels:[1240,1024,778,480],
								gridwidth:[768,1024,778,480],
								gridheight:[890,600,500,400],
								lazyType:"none",
								parallax: {
									type:"mouse",
									origo:"slidercenter",
									speed:2000,
									levels:[2,3,4,5,6,7,12,16,10,50],
								},
								shadow:0,
								spinner:"off",
								stopLoop:"off",
								stopAfterLoops:-1,
								stopAtSlide:-1,
								shuffle:"off",
								autoHeight:"off",
								hideThumbsOnMobile:"off",
								hideSliderAtLimit:0,
								hideCaptionAtLimit:0,
								hideAllCaptionAtLilmit:0,
								debugMode:false,
								fallbacks: {
									simplifyAll:"off",
									nextSlideOnWindowFocus:"off",
									disableFocusListener:false,
								}
							});
						}
					});	/*ready*/
				</script>

</html>
