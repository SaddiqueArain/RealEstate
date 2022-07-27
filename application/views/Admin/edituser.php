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
                            <h4>Edit User</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <?php if($msg = $this->session->flashdata('Update_Failed')):
                            $msg_class = $this->session->flashdata('msg_class')?>
                            <div class="alert <?php echo $msg_class ?>">
                                <?php echo $msg; ?>
                            </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class=" float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">User</a></li>
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
    <section class="content container-fluid">
      <div class="content">
      <?php echo form_open_multipart('Admin/update_user');
      echo form_hidden('uid',$userdetails->uid);?>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-3">
                      <label for="user_name">User Name</label>
                      <?php echo form_input(['class'=>'form-control','placeholder'=>'User Name','name'=>'user_name','value'=>set_value('user_name',$userdetails->user_name)]);?>
                         <?php echo form_error('user_name'); ?>
                    </div>
                     <div class="col-lg-3">
                       <label for="user_type">User Type</label>
                        <?php 
                              $options = array(
                                  ''=>'Select User Type',
                                  'buyer'=>'Buyer',
                                  'seller'=>'Seller',
                                  'broker'=>'Broker'
                                      );
                              echo form_dropdown(['class'=>'form-control','name'=>'user_type'],$options,set_value('user_type',$userdetails->user_type));
                          
                              echo form_error('user_type'); 
                          ?>
                    </div>
                    <div class="col-lg-3">
                       <label for="full_name">Full Name</label>
                        <?php echo form_input(['class'=>'form-control','placeholder'=>'Full Name','name'=>'full_name','value'=>set_value('full_name',$userdetails->full_name)]);?>
                         <?php echo form_error('full_name'); ?>
                    </div>
                    <div class="col-lg-3">
                       <label for="email">Email</label>
                      <?php echo form_input(['class'=>'form-control','placeholder'=>'Email','name'=>'email','value'=>set_value('email',$userdetails->email)]);?>
                      <?php echo form_error('email'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-3">
                       <label for="address">Address</label>
                      <?php echo form_input(['class'=>'form-control','placeholder'=>'Address','name'=>'address','value'=>set_value('address',$userdetails->address)]);?>
                         <?php echo form_error('address'); ?>
                    </div>
                    <div class="col-lg-3">
                       <label for="contact_no">Contact Number</label>
                      <?php echo form_input(['class'=>'form-control','placeholder'=>'Contact No','name'=>'contact_no','value'=>set_value('contact_no',$userdetails->contact_no)]);?>
                         <?php echo form_error('contact_no'); ?>
                    </div>
                    <div class="col-lg-3">
                       <label for="is_approved">Approve Status</label>
                      <?php echo form_input(['class'=>'form-control','placeholder'=>'Approval','name'=>'is_approved','value'=>set_value('contact_no',$userdetails->is_approved)]);?>
                         <?php echo form_error('is_approved'); ?>
                    </div>
                    <div class="col-lg-3">
                      <input type="hidden" name="getpath" value="<?php echo $userdetails->prof_img_link ?>">
                      <label for="userfile" style="margin-left:40px;">Profile Pic</label>

                        <div class="form-group" style=" margin-left:31px;">
                          <?php echo form_upload(['name'=>'userfile']);?>
                        </div>
                     <div class="text-danger">
                      <?php if(isset($upload_error)){ echo $upload_error;} ?>
                      </div>
                    </div>
                </div>
            </div>
            <div class="form-actions form-group">
                <?php echo form_submit(['type'=>'submit','class'=>'btn btn-success btn-sm'
                 ,'value'=>'Submit']); ?>
            </div>
        <?php echo form_close();?>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
