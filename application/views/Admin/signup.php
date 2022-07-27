<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Fahad Builders and Traders</title>
    <?php echo link_tag('assets/login-register/vendors/iconfonts/ionicons/css/ionicons.css');?>
    <?php echo link_tag('assets/login-register/vendors/iconfonts/typicons/src/font/typicons.css');?>
    <?php echo link_tag('assets/login-register/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css');?>
    <?php echo link_tag('assets/login-register/vendors/css/vendor.bundle.base.css');?>
    <?php echo link_tag('assets/login-register/vendors/css/vendor.bundle.addons.css');?>
     <?php echo link_tag('assets/css/login-register.css');?> 
     <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <?php echo link_tag('assets/login-register/css/shared/style.css');?>
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!-- Layout styles -->
     <?php echo link_tag('assets/login-register/css/demo_1/style.css');?>
    <!-- End Layout styles -->
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
          <div class="row w-100">
            <div class="col-lg-4 mx-auto">
              <h2 class="text-center mb-4">Register</h2>
              <div class="auto-form-wrapper" style="margin-top:-20px;width:120%;">
                <?php echo form_open_multipart('User/register') ?>
                  <div class="form-group">
                    <div class="input-group">
                      <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter User Name',
                        'name'=>'username','value'=>set_value('username')]); ?>
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                     <?php echo form_error('username'); ?>

                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <?php echo form_password(['class'=>'form-control','placeholder'=>'Enter Password',
                        'name'=>'pass']); ?>
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                    <?php echo form_error('pass'); ?>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <?php echo form_password(['class'=>'form-control','placeholder'=>'Enter Confirm Password',
                        'name'=>'cpass']); ?>
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                     <?php echo form_error('cpass'); ?>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter Full name',
                        'name'=>'fullname','value'=>set_value('fullname')]); ?>
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                    <?php echo form_error('fullname'); ?>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter email',
                        'name'=>'email','value'=>set_value('email')]); ?>
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                    <?php echo form_error('email'); ?>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter Address',
                        'name'=>'address','value'=>set_value('address')]); ?>
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                    <?php echo form_error('address'); ?>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter Contact Number',
                        'name'=>'contact','value'=>set_value('contact')]); ?>
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                    <?php echo form_error('contact'); ?>
                  </div>
                  <div class="form-group">
                   <div class="input-group">
                    <label class="label" style="padding:10px;"><b>User Type</b></label> 

                    <div class="form-group">
                      <select name="usertype" id="user_type" style="padding:4px; margin-left:30px;">
                        <option value="buyer">Buyer</option>
                        <option value="seller">Seller</option>
                        <option value="broker">Broker</option>
                        <option value="engineer">Engineer</option>
                      </select>
                       
                    
                    </div>
                      <?php echo form_error('usertype'); ?>
                    </div> 
                     
                    <div class="input-group">
                      <b>Profile Pic</b> 

                        <div class="form-group" style=" margin-left:31px;">
                          <?php echo form_upload(['name'=>'userfile']);?>
                        </div>
                     <div class="text-danger">
                      <?php if(isset($upload_error)){ echo $upload_error;} ?>
                      </div>
                     
                    </div>
                    <div class="input-group" id="upload_cv">
                      <b>Upload CV</b>

                        <div class="form-group" style=" margin-left:28px;">
                          <?php echo form_upload(['name'=>'uploadcv']);?>
                        </div>
                     <div class="text-danger">
                      <?php if(isset($upload_error)){ echo $upload_error;} ?>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                      <?php echo form_submit(['type'=>'submit','class'=>'btn btn-primary submit-btn btn-block'
                      ,'value'=>'Submit']); ?>
                  </div>
                  <div class="text-block text-center my-3">
                    <span class="text-small font-weight-semibold">Already have and account ?</span>
                    <a href="<?php echo base_url('Login/index');?>" class="text-black text-small">Login</a>
                  </div>
                <?php echo form_close()?>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?php echo base_url('assets/login-register/vendors/js/vendor.bundle.base.js');?>"></script>
    <script src="<?php echo base_url('assets/login-register/vendors/js/vendor.bundle.addons.js');?>"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="<?php echo base_url('assets/login-register/js/shared/off-canvas.js');?>"></script>
    <script src="<?php echo base_url('assets/login-register/js/shared/misc.js');?>"></script>
      <!-- endinject -->
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
  </body>
</html>
