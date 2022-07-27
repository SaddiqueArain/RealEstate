<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<aside class="main-sidebar" style="background-image: url('<?php echo base_url('assets/back.jpg');?>')!important ;">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $this->session->userdata('prof_image');?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('full_name') ?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
     
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header" style="background-color: #f9fafc">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="<?php echo base_url('Admin/index');?>"><i class="fa fa-dashboard"></i><b><span>&nbsp&nbsp&nbsp Dashboard</span></b></a></li>
         <li class="treeview">
          <a href="#"><i class="fa fa-bell"></i> <span>Request Approvals</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('Admin/userapprovals');?>"><i class="fa fa-user"></i><b><span>User Request</span></b></a>
            <li><a href="<?php echo base_url('Admin/propertyapprovals');?>"><i class="fa fa-map"></i><b><span>Property Request</span></b></a>
            <li><a href="<?php echo base_url('Admin/bookingapprovals');?>"><i class="fa fa-book"></i><b><span>Booking Request</span></b></a>
            <li><a href="<?php echo base_url('Admin/request_material');?>"><i class="fa fa-plus"></i><b><span>Material Request</span></b></a>
            </li>
          </ul>
        </li>
        <li><a href="<?php echo base_url('Admin/messages');?>"><i class="fa fa-envelope"></i><b><span>&nbsp&nbsp&nbspMessages</span></b></a></li>
        <li><a href="<?php echo base_url('Admin/userlist');?>"><i class="fa fa-user"></i><b><span>&nbsp&nbsp&nbspUsers</span></b></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-map"></i> <span>Property</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('Property/index');?>"><i class="fa fa-sitemap"></i><b><span>Property</span></b></a></li>
            <li><a href="<?php echo base_url('Property/propertyarea');?>"><i class="fa fa-sitemap"></i><b><span>Property Area</span></b></a>
            </li>
            <li class="treeview">
            	<a href="#"><i class="fa fa-map"></i> <span>Property Type</span>
            		<span class="pull-right-container">
                		<i class="fa fa-angle-left pull-right"></i>
              		</span>
          		</a>
          		<ul class="treeview-menu">
          			<li><a href="<?php echo base_url('Property/propertytype');?>"><i class="fa fa-sitemap"></i><b><span>Type</span></b></a></li>
           			 <li><a href="<?php echo base_url('Property/typecategory');?>"><i class="fa fa-sitemap"></i><b><span>Category</span></b></a>
          			  </li>
          		</ul>
            </li>
          </ul>
        </li>
        <li><a href="<?php echo base_url('Booking/index');?>"><i class="fa fa-book"></i><b><span>&nbsp&nbsp&nbsp Booking</span></b></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-credit-card-alt"></i> <span>Payment</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('Payment/index');?>"><i class="fa fa-dollar"></i><b><span>Payment Details</span></b></a>
            <li><a href="<?php echo base_url('Payment/installment');?>"><i class="fa fa-dollar"></i><b><span>Installment Details</span></b></a>
            <li><a href="<?php echo base_url('Payment/rent');?>"><i class="fa fa-dollar"></i><b><span>Rent Details</span></b></a>
            </li>
          </ul>
        </li>
        <hr>
        <li class="treeview">
          <a href="#"><i class="fa fa-building"></i> <span>Projects</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('Project/index');?>"><i class="fa fa-building"></i><b><span>Projects</span></b></a>
            <li><a href="<?php echo base_url('Project/add_engineer');?>"><i class="fa fa-user-plus"></i><b><span>Add Project Engineers</span></b></a>
            <li><a href="<?php echo base_url('Project/add_files');?>"><i class="fa fa-file"></i><b><span>Add Project Files</span></b></a>
            </li>
          </ul>
        </li>
        <li><a href="<?php echo base_url('Material/index');?>"><i class="fa fa-plus"></i><b><span>&nbsp&nbsp&nbsp Material</span></b></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
