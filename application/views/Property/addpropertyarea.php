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
                              <h4>Add Property Area</h4>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class=" float-right">
                          <div class="page-title">
                              <ol class="breadcrumb text-right">
                                  <li><a href="#">Property</a></li>
                                  <li><a href="#">Property Area</a></li>
                                  <li class="active">Add</li>
                              </ol>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
       </div>
  </section>
    <!-- Main content -->
<section class="content container-fluid" style="margin-top: -30px;">
  <div class="content">
      <?php echo form_open('Property/addpropertyarea');?>
        <div class="form-group">
            <div class="row">
                <div class="col-lg-6">
                    <label for="prop_area">Property_Area</label>
                    <?php echo form_input(['class'=>'form-control','placeholder'=>'Property Area',
                    'name'=>'prop_area']);?>
                     <?php echo form_error('prop_area'); ?>
                </div>
                <div class="col-lg-6"></div>
            </div>
        </div>
        <div class="form-actions form-group">
            <?php echo form_submit(['type'=>'submit','class'=>'btn btn-success btn-sm'
             ,'value'=>'Submit']); ?>
        </div>
      <?php echo form_close();?>
  </div>
</section>
       