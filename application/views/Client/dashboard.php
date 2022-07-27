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

        <input type="hidden" id="total_properties_forsale_chart" value="<?php echo $total_properties_forsale ?>"/>
        <input type="hidden" id="total_properties_forrent_chart" value="<?php echo $total_properties_forrent ?>"/>
        <input type="hidden" id="total_properties_oninstallment_chart" value="<?php echo $total_properties_oninstallment ?>"/>
        <input type="hidden" id="total_properties_onrent_chart" value="<?php echo $total_properties_onrent ?>"/>
        <input type="hidden" id="total_properties_sold_chart" value="<?php echo $total_properties_sold ?>"/>
        <input type="hidden" id="total_properties_purchase_chart" value="<?php echo $total_properties_purchase ?>"/>
      
     
      <div class="row">
        
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-map"></i></span>

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
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-map"></i></span>

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
     
        <div class="col-md-4 col-sm-6 col-xs-12">
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
         </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>

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

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-map"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Properties</span>
              <span class="info-box-text">Sold</span>
              <span class="info-box-number"><?php echo $total_properties_sold; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-map"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Properties</span>
              <span class="info-box-text">Purchase</span>
              <span class="info-box-number"><?php echo $total_properties_purchase; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
       
        <!-- /.col -->
      </div>
      
      <div class="row">
        <div class="card col-sm-12" style="height:auto;width:auto;min-width:98%;display:inline-flex">
          <canvas id="myChart" ></canvas>
        </div>

      </div>
  

        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <script type="text/javascript">
var ctx = document.getElementById("myChart").getContext('2d');

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

 var total_properties_purchase_chart = document.getElementById('total_properties_purchase_chart');
 total_properties_purchase_chart = Number(total_properties_purchase_chart.value);

var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["Properties for Sale","Properties for Rent","Properties on Installment","Properties on Rent","Properties Sold"],
        datasets: [{
            label: 'Graphical Representation',
            data: [total_properties_forsale_chart,total_properties_forrent_chart,total_properties_oninstallment_chart,total_properties_onrent_chart,total_properties_sold_chart],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                 'rgba(255, 206, 86, 1)',
                
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
});

 </script>
