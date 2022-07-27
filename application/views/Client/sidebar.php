<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg');?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('full_name') ?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input style="background-color: #f9fafc" type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header" style="background-color: #f9fafc">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="<?php echo base_url('Client/index');?>"><i class="fa fa-dashboard"></i><b><span>&nbsp&nbsp&nbsp Dashboard</span></b></a></li>
         <li class="treeview">
          <a href="#"><i class="fa fa-bell"></i> <span>Pending Requests</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('Client/pendingproperty');?>"><i class="fa fa-user"></i><b><span>Pending Properties</span></b></a>
            <li><a href="<?php echo base_url('Client/pendingbooking');?>"><i class="fa fa-book"></i><b><span>Pending Booking</span></b></a>
            </li>
          </ul>
        </li>
        <li><a href="<?php echo base_url('Client/do_demand');?>"><i class="fa fa-circle"></i><b><span>&nbsp&nbsp&nbsp Demand</span></b></a></li>
        <li><a href="<?php echo base_url('Client/propertylist');?>"><i class="fa fa-sitemap"></i><b><span>&nbsp&nbsp&nbsp My Properties</span></b></a></li>
        <li><a href="<?php echo base_url('Client/bookinglist');?>"><i class="fa fa-book"></i><b><span>&nbsp&nbsp&nbsp My Bookings</span></b></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-credit-card-alt"></i> <span>Payment Details</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('Payment/clientPayment');?>"><i class="fa fa-dollar"></i><b><span>Payment History</span></b></a>
            
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
