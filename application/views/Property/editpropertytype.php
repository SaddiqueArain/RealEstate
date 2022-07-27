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
                  <div class="col-sm-4">
                      <div class="page-header ">
                          <div class="page-title">
                              <h4>Edit Property Type</h4>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-4">
                      <?php if($msg = $this->session->flashdata('Update_Failed')):
                          $msg_class = $this->session->flashdata('msg_class')?>
                          <div class="alert <?php echo $msg_class ?>">
                              <?php echo $msg; ?>
                          </div>
                      <?php endif;?>
                  </div>
                  <div class="col-sm-4">
                      <div class="float-right">
                          <div class="page-title">
                              <ol class="breadcrumb text-right">
                                  <li><a href="#">Property</a></li>
                                  <li><a href="#">Property Type</a></li>
                                  <li><a href="#">Type</a></li>
                                  <li class="active">Edit</li>
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
      <?php echo form_open('Property/update_property_type');
      echo form_hidden('prop_type_id',$typedetails->prop_type_id);?>
        <div class="form-group">
            <div class="row">
                <div class="col-lg-6">
                    <label for="prop_type">Property_Type</label>
                    <?php echo form_input(['class'=>'form-control','placeholder'=>'Property type',
                    'name'=>'prop_type','value'=>set_value('prop_type',$typedetails->prop_type)]);?>
                     <?php echo form_error('prop_type'); ?>
                </div>
                <div class="col-lg-6">
                </div>
            </div>
        </div>
        <div class="form-actions form-group">
            <?php echo form_submit(['type'=>'submit','class'=>'btn btn-success btn-sm'
             ,'value'=>'Update']); ?>
        </div>
      <?php echo form_close();?>
  </div>
</section>
       