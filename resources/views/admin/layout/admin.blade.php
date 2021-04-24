<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Web Apparel Dashboard">
  <meta name="author" content="Christopher Robin Chase ">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{$title}}</title>
   <script src="{{ URL::asset('assets/js/jquery-3.5.1.min.js') }}"></script>
  <!-- Favicon -->
  <link rel="icon" href="{{ URL::asset('assets/img/logo.png') }}" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/nucleo/css/nucleo.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="{{ URL::asset('admin/assets/css/argon.css?v=1.2.0') }}" type="text/css">

  <script src="{{ URL::asset('admin/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  
 
    <script src="{{ URL::asset('assets/sweetalert2/dist/sweetalert2.all.js') }}"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js"></script>
</head>
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
<body>
<!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="{{ asset('assets/img/logo.png') }}" class="navbar-brand-img" style="max-height: 150px !important;" alt="...">
        </a>
      </div><br><br><br><br>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('dashboard') }}">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('productManagement') }}">
                <i class="fa fa-tshirt text-primary"></i>
                <span class="nav-link-text">Product Management</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('userManagement') }}">
                <i class="fa fa-user-alt text-primary"></i>
                <span class="nav-link-text">User Management</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('salesManagement') }}">
                <i class="fa fa-dollar-sign text-primary"></i>
                <span class="nav-link-text">Sales Management</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('/') }}">
                <i class="fa fa-home text-primary"></i>
                <span class="nav-link-text">Go to Home</span>
              </a>
            </li>
            {{-- <li class="nav-item">
              <a class="nav-link" href="examples/icons.html">
                <i class="ni ni-planet text-orange"></i>
                <span class="nav-link-text">Icons</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="examples/map.html">
                <i class="ni ni-pin-3 text-primary"></i>
                <span class="nav-link-text">Google</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="examples/profile.html">
                <i class="ni ni-single-02 text-yellow"></i>
                <span class="nav-link-text">Profile</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="examples/tables.html">
                <i class="ni ni-bullet-list-67 text-default"></i>
                <span class="nav-link-text">Tables</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="examples/login.html">
                <i class="ni ni-key-25 text-info"></i>
                <span class="nav-link-text">Login</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="examples/register.html">
                <i class="ni ni-circle-08 text-pink"></i>
                <span class="nav-link-text">Register</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="examples/upgrade.html">
                <i class="ni ni-send text-dark"></i>
                <span class="nav-link-text">Upgrade</span>
              </a>
            </li> --}}
          </ul>
          <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Web Apparel</span>
          </h6>
          
        </div>
      </div>
    </div>
  </nav>
   <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-default border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Search form -->
          
          
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <div class="d-flex d-sm-none d-none d-sm-flex d-md-none">
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('dashboard') }}">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('productManagement') }}">
                <i class="fa fa-tshirt text-primary"></i>
                <span class="nav-link-text">Product Management</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('userManagement') }}">
                <i class="fa fa-user-alt text-primary"></i>
                <span class="nav-link-text">User Management</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('salesManagement') }}">
                <i class="fa fa-dollar-sign text-primary"></i>
                <span class="nav-link-text">Sales Management</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('/') }}">
                <i class="fa fa-dollar-sign text-primary"></i>
                <span class="nav-link-text">Home Page</span>
              </a>
            </li>
            </div>
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="data:jpeg;base64,{{Auth::user()->pic_location}}">
                  </span>
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold">{{Auth::user()->fname." ".Auth::user()->lname}}</span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu  dropdown-menu-right ">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Welcome!</h6>
                </div>
                <a href="{{ route('profile') }}" class="dropdown-item">
                  <i class="ni ni-single-02"></i>
                  <span>My profile</span>
                </a>
                
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Logout</span>
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  @yield('content')

      <!-- Footer -->
      <footer class="footer p-2">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6">
            <div class="copyright text-center  text-lg-left  text-muted">
              &copy; <script type="text/javascript">document.write(new Date().getFullYear())</script> <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Web Apparel</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>

</body>
  <script src="{{ URL::asset('admin/assets/vendor/js-cookie/js.cookie.js') }}"></script>
  <script src="{{ URL::asset('admin/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
  <script src="{{ URL::asset('admin/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
  <!-- Optional JS -->
   <!-- Argon JS -->
  <script src="{{ URL::asset('admin/assets/js/argon.js?v=1.2.0') }}"></script>


</html>
