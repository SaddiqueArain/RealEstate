<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Fahad Builders and Traders</title>
  
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>

  <!-- Tell the browser to be responsive to screen width -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  
<!-- jQuery 3 -->
  <script src="<?php echo base_url('assets/bower/jquery/dist/jquery.min.js');?>"></script>
  <!-- Ionicons -->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/skin-purple-light.min.css');?>">

  <link rel="stylesheet" href="<?php echo base_url('home/assets/js/fancybox/jquery.fancybox.css');?>" type="text/css" media="screen" />
    
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />



<style type="text/css">
label{
  display: block;
}
.content-wrapper{
  overflow-y: auto;
}
.card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
  background-color:white; 
  
}

.card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}
.card-body{
  padding: 5px 8px;
}
.card-block
{
  width:100%;min-width:auto;height:2px;background-color:#aaa;position:absolute;left:-1px
}
.cat_property{
  border: 1px solid blue;
}
.cat_property:hover{
  background-color: blue;
  opacity: 0.6;
}
.fa-eye{
  color: blue;
}
.cat_property:hover .fa-eye{
  color: white;
}
.fa-reply{
  color: black;
}
.cat_property:hover .fa-reply{
  color: white;
}
.pay_property{
  border: 1px solid blue;
}
.pay_property:hover{
  background-color: blue;
  opacity: 0.6;
}
.fa-dollar{
  color: blue;
}
.pay_property:hover .fa-dollar{
  color: white;
}

.sidebar-menu .menu-open>a>.fa-angle-left, .sidebar-menu .menu-open>a>.pull-right-container>.fa-angle-left {
    -webkit-transform: rotate(-90deg);
    -ms-transform: rotate(-90deg);
    -o-transform: rotate(-90deg);
    transform: rotate(-90deg);
}
.skin-purple-light .wrapper, .skin-purple-light .main-sidebar, .skin-purple-light .left-side {
    background-color: #f9fafc;
}
@media screen and (max-width: 767px)
.table-responsive {
    width: 100%;
    margin-bottom: 15px;
    overflow-y: hidden;
    -ms-overflow-style: -ms-autohiding-scrollbar;
    border: 1px solid #ddd;
}

.table-responsive {
    min-height: .01%;
    overflow-x: auto;
}
table.table-bordered > thead > tr > th{
  border:1px solid black;
}
table.table-bordered >thead > tr >td{ border:1px solid black;}
table.table-bordered > tbody > tr > td{
    border:1px solid black;
}
th{
  text-align: center;
}

</style>
</head>
<body class="hold-transition skin-purple-light sidebar-mini">
<div class="wrapper">
  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>P</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>Panel</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- /.messages-menu -->

          <!-- Notifications Menu -->
          
          <!-- Tasks Menu -->
          <li class="dropdown tasks-menu">
            <!-- Menu Toggle Button -->
          </li>
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="<?php echo $this->session->userdata('prof_image');?>" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo $this->session->userdata('full_name'); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="<?php echo $this->session->userdata('prof_image');?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $this->session->userdata('full_name');echo '</br>'; $type = $this->session->userdata('user_type');if($type=="admin"){echo "ADMINSTRATOR";}elseif ($type=="buyer" || $type=="seller") {echo "CLIENT";  } ?>
                </p>
              </li>
             <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url('Home/index');?>" class="btn btn-default btn-flat">Main Site</a>
                </div>
               
                <div class="pull-right">
                  <a href="<?php echo base_url('Login/logout');?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>  
  </header>

