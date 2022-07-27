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
    <!-- endinject -->
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
          <div class="row w-100">
            <div class="col-lg-4 mx-auto">
              <div class="auto-form-wrapper">
                <?php echo form_open('Login/is_validate')?>
                 <div class="form-group">
                    <label class="label">Username</label>
                    <div class="input-group">
                      <?php echo form_input(['class'=>'form-control','placeholder'=>'User Name',
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
                    <label class="label">Password</label>
                    <div class="input-group">
                       <?php echo form_password(['class'=>'form-control','placeholder'=>'Password',
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
                       <?php echo form_submit(['type'=>'submit','class'=>'btn btn-primary submit-btn btn-block'
                                         ,'value'=>'Login']); ?>
                  </div>
            <!--      <div class="form-group">
                    <button class="btn btn-block g-login ">
                      <a id="google_login" class="circle google" href="#">
                          <i class="fa fa-google" style="color:red;"></i>
                      </a>
                      Log in with Google</button>
                  </div>   -->
                  <div class="text-block text-center my-3">
                    <span class="text-small font-weight-semibold">Not a member ?</span>
                    <a href="<?php echo base_url('User/index');?>" class="text-black text-small">Create new account</a>
                  </div>
               <?php echo form_close()?>
                <?php if($msg = $this->session->flashdata('Login_Failed')):

                  $msg_class = $this->session->flashdata('msg_class')
                  ?>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="alert <?php echo $msg_class ?>">
                        <?php echo $msg; ?>
                      </div>
                    </div>
                  </div>
                <?php endif;?>
              </div>
              <p class="footer-text text-center"></p>
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
  </body>
</html>