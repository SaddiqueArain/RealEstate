     <?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-image: url('<?php echo base_url('assets/back.jpg');?>')!important ;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-6">
                        <div class="page-header ">
                            <div class="page-title">
                                <h4>Dashboard</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li class="active">Dashboard</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content container-fluid" style="margin-top:-30px;">
        <div class="content">

        <input type="hidden" id="total_users_chart" value="<?php echo $total_users ?>"/>
        <input type="hidden" id="request_users_chart" value="<?php echo $request_users ?>"/>
        <input type="hidden" id="total_sellers_chart" value="<?php echo $total_sellers ?>"/>
        <input type="hidden" id="total_buyers_chart" value="<?php echo $total_buyers ?>"/>
        <input type="hidden" id="total_brokers_chart" value="<?php echo $total_brokers ?>"/>
        <input type="hidden" id="total_engineers_chart" value="<?php echo $total_engineers ?>"/>
        <input type="hidden" id="total_properties_forsale_chart" value="<?php echo $total_properties_forsale ?>"/>
        <input type="hidden" id="total_properties_forrent_chart" value="<?php echo $total_properties_forrent ?>"/>
        <input type="hidden" id="total_properties_oninstallment_chart" value="<?php echo $total_properties_oninstallment ?>"/>
        <input type="hidden" id="total_properties_onrent_chart" value="<?php echo $total_properties_onrent ?>"/>
        <input type="hidden" id="total_properties_sold_chart" value="<?php echo $total_properties_sold ?>"/>
        <input type="hidden" id="total_bookings_chart" value="<?php echo $total_bookings ?>"/>
   
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Users</span>
              <span class="info-box-number"><?php echo $total_users; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Request Users</span>
              <span class="info-box-number"><?php echo $request_users; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Sellers</span>
              <span class="info-box-number"><?php echo $total_sellers; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Buyers</span>
              <span class="info-box-number"><?php echo $total_buyers; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>

      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Brokers</span>
              <span class="info-box-number"><?php echo $total_brokers; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Engineers</span>
              <span class="info-box-number"><?php echo $total_engineers; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-map"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Properties</span>
              <span class="info-box-text">For Sale</span>
              <span class="info-box-number"><?php echo $total_properties_forsale; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-map"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Properties</span>
              <span class="info-box-text">For Rent</span>
              <span class="info-box-number"><?php echo $total_properties_forrent; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-map"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Properties</span>
              <span class="info-box-text">ON Installment</span>
              <span class="info-box-number"><?php echo $total_properties_oninstallment; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Properties</span>
              <span class="info-box-text">ON Rent</span>
              <span class="info-box-number"><?php echo $total_properties_onrent; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-map"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Properties</span>
              <span class="info-box-text">Sold</span>
              <span class="info-box-number"><?php echo $total_properties_sold; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-book"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Bookings</span>
              <span class="info-box-number"><?php echo $total_bookings; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      
      
  

        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script type="text/javascript">
/*var ctx = document.getElementById("myChart").getContext('2d');
var total_users_chart = document.getElementById('total_users_chart');
total_users_chart = Number(total_users_chart.value);

var request_users_chart =  document.getElementById('request_users_chart');
 request_users_chart =  Number(request_users_chart.value);

var total_sellers_chart = document.getElementById('total_sellers_chart');
 total_sellers_chart = Number(total_sellers_chart.value);

var total_buyers_chart = document.getElementById('total_buyers_chart');
 total_buyers_chart = Number(total_buyers_chart.value);

var total_brokers_chart = document.getElementById('total_brokers_chart');
 total_brokers_chart = Number(total_brokers_chart.value);

var total_engineers_chart = document.getElementById('total_engineers_chart');
 total_engineers_chart = Number(total_engineers_chart.value);

var total_properties_forsale_chart = document.getElementById('total_properties_forsale_chart');
 total_properties_forsale_chart = Number(total_properties_forsale_chart.value);

var total_properties_forrent_chart = document.getElementById('total_properties_forrent_chart');
 total_properties_forrent_chart = Number(total_properties_forrent_chart.value);

var total_properties_oninstallment_chart = document.getElementById('total_properties_oninstallment_chart');
 total_properties_oninstallment_chart = Number(total_properties_oninstallment_chart.value);

var total_properties_onrent_chart = document.getElementById('total_properties_onrent_chart');
 total_properties_onrent_chart = Number(total_properties_onrent_chart.value);

var total_properties_sold_chart = document.getElementById('total_properties_sold_chart');
 total_properties_sold_chart = Number(total_properties_sold_chart.value);

var total_bookings_chart = document.getElementById('total_bookings_chart');
 total_bookings_chart = Number(total_bookings_chart.value);

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Users", "User Requests", "Sellers", "Buyers","Brokers","Engineers","Properties for Sale","Properties for Rent","Properties on Installment","Properties on Rent","Properties Sold","Bookings"],
        datasets: [{
            label: 'Graphical Representation',
            data: [total_users_chart,request_users_chart,total_sellers_chart,total_buyers_chart,total_brokers_chart,total_engineers_chart,total_properties_forsale_chart,total_properties_forrent_chart,total_properties_oninstallment_chart,total_properties_onrent_chart,total_properties_sold_chart,total_bookings_chart],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(0,255,0,0.3)',
                'rgba(255,0,255,0.3)',
                'rgb(0,0,255,0.9)',
                'rgba(128,0,128,0.5)',
                'rgb(0,255,255,1.0)',
                'rgb(0,128,128,0.8)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(0,255,0,1)',
                'rgba(255,0,255,1)',
                'rgb(0,0,255,1)',
                'rgba(128,0,128,1)',
                'rgb(0,255,255,1)',
                'rgb(0,128,128,1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});*/

 </script>
