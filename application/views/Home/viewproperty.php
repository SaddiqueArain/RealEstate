<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<header id="head" class="secondary">
		<div class="container">
			      <div class="navbar navbar-inverse" style="background-color:black !important;opacity: 0.3;position: fixed; ">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                <a class="navbar-brand" href="index.html">
                    <img src="<?php echo base_url('home/assets/images/logo2.png');?>"  alt="Techro HTML5 template"></a>
            </div>
            <div>
                <?php if($msg = $this->session->flashdata('Insert_Success')):
                    $msg_class = $this->session->flashdata('msg_class')?>
                <div class="alert <?php echo $msg_class ?>">
                    <?php echo $msg; ?>
                </div>
                <?php endif;?>
                </div>
            <div class="navbar-collapse collapse">
              
                <ul class="nav navbar-nav pull-right mainNav">
                    <li class="active"><a href="<?php echo base_url('Home/index');?>">Home</a></li>
                    <li><a href="<?php echo base_url('Home/about');?>">About</a></li>
                   
                    
                    <li><a href="<?php echo base_url('Home/projects');?>">Projects</a></li>
                    <li><a href="<?php echo base_url('Home/getproperties');?>">Properties</a></li>
                    <li><a href="<?php echo base_url('Home/contact');?>">Contact</a></li>
                    <?php if(!$this->session->userdata('logged_in'))
                    {?>
                    <li><a href="<?php echo base_url('Login/index');?>">Sign in</a></li>
                    <?php }
                      else{ ?>
                              <li><a href="<?php if($this->session->userdata('user_type')=="admin")
                              { echo base_url('Admin/index');} else{echo base_url('Client/index');}?>">Panel</a></li>
                              <li><a href="<?php echo base_url('Login/logout');?>">Logout</a></li>
                    <?php } ?>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
			<div class="row">
				<div class="col-sm-8">
					<h1>Property Information</h1>
				</div>
			</div>
		</div>
	</header>

	<!-- container -->
	<div class="container">
		<?php foreach($property as $row):?>
				<div class="row">
					<div class="col-md-6">
						<h3 class="section-title"> 
						<?php echo $row['prop_area']; echo " "; echo $row['prop_name'];
							
						?></h3>

						<img src="<?php echo $row['prop_img_link'];?>" style="width:80%;height:80%;">
					
					</div>
					<div class="col-md-6">
						<div class="row">
							<h3 class="section-title">Property Details</h3>
								
							<div class="col-md-6">
								<div class="contact-info">
									<h5><?php echo $row['prop_type']; echo " ";?>Type</h5>

									<p><?php echo $row['category_name'];?></p>
									
									<h5>Price</h5>
									<p><?php echo $row['prop_value'];?></p>
									
									<h5>Location</h5>
									<p><?php echo $row['prop_location']; echo " "; echo $row['prop_city']?></p>

									<h5>Bath(s)</h5>
									<p><?php echo $row['bathrooms'];?></p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="contact-info">
									<h5>Area</h5>
									<p><?php echo $row['prop_area'];?></p>
									
									<h5>Purpose</h5>
									<?php $purpose =  $row['prop_status'];
										if($purpose=="Available for Buying")
										{?>
										<p>For Sale</p>
										<?php }
										else
										{?>
										<p>For Rent</p>
										<?php } ?>
									<h5>Added</h5>
									<p><?php echo $row['added_time'];?></p>

									<h5>Bedroom(s)</h5>
									<p><?php echo $row['bedrooms'];?></p>
								</div>

							</div>

						</div>
										
					</div>
					
					<div class="col-md-6">
							<?php echo form_open('Booking/buyer_booking');?>
							<?php echo form_hidden('propid',$row['propid']);
								echo form_hidden('seller_id',$row['uid']);
								echo form_hidden('buyer_id',$this->session->userdata('uid'));
								?>
								<?php if($this->session->userdata('logged_in')){?>
								<h3 class="section-title">Broker &nbsp
							<?php echo form_checkbox(['class'=>'check','name'=>'broker','value'=>'accept']);?>
		                       
							<div class="col-md-6" style="float:right;background:transparent;">
							<?php echo form_submit(['type'=>'submit','class'=>'update_property btn btn-default'
                      ,'value'=>'Book']);?>
						</div> <?php } else{?><h3>To make booking please Log in</h3><?php }?></h3>

							

					</div>

							
											</div>
										<?php endforeach;?>
			</div>


      <?php include"footer.php" ?>

   
    <!-- JavaScript libs are placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url('home/assets/js/modernizr-latest.js');?>"></script> 
    <script type='text/javascript' src="<?php echo base_url('home/assets/js/jquery.min.js')?>"></script>
    <script type='text/javascript' src="<?php echo base_url('home/assets/js/fancybox/jquery.fancybox.pack.js');?>"></script>
    
    <script type='text/javascript' src="<?php echo base_url('home/assets/js/jquery.mobile.customized.min.js');?>"></script>
    <script type='text/javascript' src="<?php echo base_url('home/assets/js/jquery.easing.1.3.js');?>"></script> 
    <script type='text/javascript' src="<?php echo base_url('home/assets/js/camera.min.js');?>"></script> 
    <script src="<?php echo base_url('home/assets/js/bootstrap.min.js');?>"></script> 
    <script src="<?php echo base_url('home/assets/js/custom.js');?>"></script>
    
    
    
</body>
</html>
