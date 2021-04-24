@extends('admin.layout.admin')
@section('content')


 <!-- Header -->
    <!-- Header -->
    <div class="header bg-default pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Site Visitors</h5>
                      <span class="h2 font-weight-bold mb-0">{{count($visitorThisMonth)}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i class="ni ni-active-40"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                  	<?php
                  		$a = count($visitorThisMonth);
                  		$b = count($visitorLastMonth);
                  		$average = $a - $b ;
                  		$visitorPercentage = $average;
                  		if($visitorPercentage > 100)
                  		{
                  			$percentage = 100;
                  		}
                  		if($a > $b)
                  		{
                  			?>
                  			<span class="text-success mr-2"><i class="fa fa-arrow-up"> +{{$visitorPercentage}} </i></span>
                  		<?php
                  		}
                  		else{

                  			?>
                  			<span class="text-danger mr-2"><i class="fa fa-arrow-down"> -{{$visitorPercentage}} %</i></span>
                  			<?php
                  		}
                  	?>
                    
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">New users</h5>
                      <span class="h2 font-weight-bold mb-0">{{count($newUsersMonth)}}
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="ni ni-chart-pie-35"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                  	
                  			<span class="text-success mr-2"></span>
                  	
                  	<span class="text-danger mr-2"></span>
                    
                    <span class="text-nowrap"></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Monthly Sales</h5>
                      <span class="h2 font-weight-bold mb-0">
                        <?php 
                          $monthly = 0;
                        ?>
                        @foreach($monthlySales as $monthlySale)
                          <?php 
                            $monthly = $monthly + $monthlySale->grand_total;


                          ?>
                        @endforeach
                        <?php 
                        echo "₱ ".number_format($monthly,2);
                        ?>
                      </span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="ni ni-money-coins"></i>
                      </div>
                    </div>
                  </div>
                   <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"></span>
                    <span class="text-nowrap"></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Annual Sales</h5>
                      <span class="h2 font-weight-bold mb-0">
                         <?php 
                          $yearly = 0;
                        ?>
                        @foreach($yearlySales as $yearlySale)
                          <?php 
                            $yearly = $yearly + $yearlySale->grand_total;


                          ?>
                        @endforeach
                        <?php 
                        echo "₱ ".number_format($yearly,2);
                        ?>
                      </span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i class="ni ni-chart-bar-32"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"></span>
                    <span class="text-nowrap"></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Shipped</h5>
                      <span class="h2 font-weight-bold mb-0">{{count($totalShipped)}}
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i class="ni ni-chart-bar-32"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    
                        <span class="text-success mr-2"></span>
                    
                    <span class="text-danger mr-2"></span>
                    
                    <span class="text-nowrap"></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Delivered</h5>
                      <span class="h2 font-weight-bold mb-0">{{count($totalDelivered)}}
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-yellow text-white rounded-circle shadow">
                        <i class="ni ni-chart-bar-32"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    
                        <span class="text-success mr-2"></span>
                    
                    <span class="text-danger mr-2"></span>
                    
                    <span class="text-nowrap"></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Rejected</h5>
                      <span class="h2 font-weight-bold mb-0">{{count($totalRejected)}}
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                        <i class="ni ni-chart-bar-32"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    
                        <span class="text-success mr-2"></span>
                    
                    <span class="text-danger mr-2"></span>
                    
                    <span class="text-nowrap"></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Cancelled</h5>
                      <span class="h2 font-weight-bold mb-0">{{count($totalCancelled)}}
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                        <i class="ni ni-chart-bar-32"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    
                        <span class="text-success mr-2"></span>
                    
                    <span class="text-danger mr-2"></span>
                    
                    <span class="text-nowrap"></span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-6">
          <div class="card bg-secondary">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="text-muted text-uppercase ls-1 mb-1">Overview</h6>
                  <h5 class="h3 text-black mb-0">Sales value</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!-- Chart -->
              <div class="chart">
                <!-- Chart wrapper -->
                <canvas id="chart-sales" class="w-100 h-100"></canvas>
                
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>
                  <h5 class="h3 mb-0">Total orders</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!-- Chart -->
              <div class="chart">
                <canvas id="chart-order" class="chart-canvas w-100 h-100" ></canvas>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="card">
            <div class="card-header">
                <h3>Product Status</h3>
            </div>
            <div class="card-body">
                <table class="table table-light table-reponsive">
          <thead>
              <th>Product No.</th>
              <th>Product Name</th>
              <th>Category</th>
              <th>Quantity</th>
              <th>Status</th>
          </thead>
          <tbody>
            @foreach($products as $product)
              <tr>
                <td>{{$product->product_number}}</td>
                <td>{{$product->product_name}}</td>
                <td>{{$product->category}}</td>
                <td>{{$product->quantity}}</td>
                <td>
                  @if($product->quantity >= 499)
                  <span class="badge badge-pill badge-success">Maximum</span>
                  @elseif($product->quantity <= 499 && $product->quantity >= 300)
                    <span class="badge badge-pill badge-success">Average</span>
                  @elseif($product->quantity <= 299 && $product->quantity >= 100)
                    <span class="badge badge-pill badge-info">Good</span>
                  @elseif($product->quantity <= 99 && $product->quantity >= 1)
                    <span class="badge badge-pill badge-warning">Critical</span>
                  @elseif($product->quantity < 1)
                    <span class="badge badge-pill badge-danger">Out of stock</span>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            {{$products->links()}}
          </tfoot>
      </table>
            </div>
        </div>
    </div>
    <div class="container">
      <div class="card">
        <div class="card-header">
          <h3>Top Places and Country</h3>
        </div>
        <div class="card-body">
      <table class="table table-light table-reponsive">
        <thead>
          <th>Country</th>
          <th>Place</th>
          <th>Output</th>
        </thead>
        <tbody>
          @foreach($topCountry as $topCount)
            <tr>
              <th scope="col">{{$topCount->country}}</th>
              <td>{{$topCount->city}}</td>
              <td>{{$topCount->total_country}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
        </div>
      </div>
    </div>

    <script src="https://cdnjs.com/libraries/Chart.js"></script>
  <script type="text/javascript">
    $token = $('meta[name="csrf-token"]').attr('content');
    

            var ctx = $("#chart-sales");
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo $months; ?>,
        datasets: [{
            label: 'Monthly Sales 2020',
            data:{{$sales}},
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

     var ctx = $("#chart-order");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo $months; ?>,
        datasets: [{
            label: 'Total Orders',
            data:{{$orders}},
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
 </script>


   
@endsection