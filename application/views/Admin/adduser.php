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
                            <h4>Add User</h4>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class=" float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">User</a></li>
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
    <section class="content container-fluid">
      <div class="content">
      <?php echo form_open_multipart('Admin/insert_user');?>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-3">
                      <label for="user_name">User Name</label>
                        <?php echo form_input(['class'=>'form-control','placeholder'=>'User Name','name'=>'user_name','value'=>set_value('user_name')]);?>
                         <?php echo form_error('user_name'); ?>
                    </div>
                     <div class="col-lg-3">
                      <label for="user_type">User Type</label>
                        <select name="user_type" id="user_type" class="form-control">
                            <option value="">Select User Type</option>
                            <option value="buyer">Buyer</option>
                            <option value="seller">Seller</option>
                            <option value="broker">Broker</option>
                            <option value="engineer">Engineer</option>
                        </select>
                         <?php echo form_error('user_type'); ?>
                    </div>
                    <div class="col-lg-3">
                      <label for="full_name">Full Name</label>
                        <?php echo form_input(['class'=>'form-control','placeholder'=>'Full Name','name'=>'full_name','value'=>set_value('full_name')]);?>
                         <?php echo form_error('full_name'); ?>
                    </div>
                    <div class="col-lg-3">
                      <label for="email">Email</label>
                      <?php echo form_input(['class'=>'form-control','placeholder'=>'Email','name'=>'email','value'=>set_value('email')]);?>
                      <?php echo form_error('email'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-3">
                      <label for="address">Address</label>
                      <?php echo form_input(['class'=>'form-control','placeholder'=>'Address','name'=>'address','value'=>set_value('address')]);?>
                         <?php echo form_error('address'); ?>
                    </div>
                    <div class="col-lg-3">
                      <label for="contact_no">Contact Number</label>
                      <?php echo form_input(['class'=>'form-control','placeholder'=>'Contact No','name'=>'contact_no','value'=>set_value('contact_no')]);?>
                         <?php echo form_error('contact_no'); ?>
                    </div>
                    <div class="col-lg-3">
                      <label for="userfile" style="margin-left:40px;">Profile Pic</label>

                        <div class="form-group"style=" margin-left:31px;">
                          <?php echo form_upload(['name'=>'userfile']);?>
                        </div>
                     <div class="text-danger">
                      <?php if(isset($upload_error)){ echo $upload_error;} ?>
                      </div>
                    </div>
                    <div class="col-lg-3" id="upload_cv">
                      <label for="userfile" style="margin-left:40px;">Upload CV</label>

                        <div class="form-group" style=" margin-left:31px;">
                          <?php echo form_upload(['name'=>'uploadcv']);?>
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
<script type="text/javascript">
  $(document).ready(function(){
 
  document.getElementById('upload_cv').style.visibility = 'hidden';
  // Type change
    $('#user_type').change(function(){
      var val = $(this).val();
      if(val == "engineer")
      {
        document.getElementById('upload_cv').style.visibility = 'visible';
      }
      else
      {
        document.getElementById('upload_cv').style.visibility = 'hidden';
      }
    });
  });
</script>