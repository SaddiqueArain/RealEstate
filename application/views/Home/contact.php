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
					<br>
					<br>
					<br>
					<br>
					<h1 style="color: black">Contact us</h1>
				</div>
			</div>
		</div>
	</header>

	<!-- container -->
	<div class="container">
				<div class="row">
					<div class="col-md-6">
						<h3 class="section-title">Your Message</h3>
						<p>
						If you have any query and suggestion you can contact us.
						</p>
						
						<?php echo form_open('Home/insert_message')?>
							<div class="form-group">
								<label>Name</label>
								<?php echo form_input(['class'=>'form-control','placeholder'=>'Full Name','name'=>'full_name','value'=>set_value('full_name')]);?>
                      			<?php echo form_error('full_name'); ?>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Email</label>
									<?php echo form_input(['class'=>'form-control','placeholder'=>'Email','name'=>'email','value'=>set_value('email')]);?>
                      				<?php echo form_error('email'); ?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Phone</label>
									<?php echo form_input(['class'=>'form-control','placeholder'=>'Contact Number','name'=>'contact_number','value'=>set_value('contact_number')]);?>
                      				<?php echo form_error('contact_number'); ?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Subject</label>
							<?php echo form_input(['class'=>'form-control','placeholder'=>'Subject','name'=>'subject','value'=>set_value('subject')]);?>
                      				<?php echo form_error('subject'); ?>
							</div>
							<div class="form-group">
								<label>Message</label>
								<?php echo form_textarea(['class'=>'form-control','placeholder'=>'Write your message here','name'=>'message','value'=>set_value('message'),'style'=>'height:200px;']);?>
                      			<?php echo form_error('message'); ?>
							</div>
							<button type="submit" class="btn" style="background:#6D4DC8">Send message</button><p><br/></p>
						<?php echo form_close()?>
					</div>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<h3 class="section-title">Office Address</h3>
								<div class="contact-info">
									<h5>Address</h5>
									<p>5th Street, Carl View - United States</p>
									
									<h5>Email</h5>
									<p>info@webthemez.com</p>
									
									<h5>Phone</h5>
									<p>+09 123 1234 123</p>
								</div>
							</div>
							<div class="col-md-6">
								<h3 class="section-title">Timings</h3>
								<div class="contact-info">
									<h5>Monday - Friday</h5>
									<p>09:00 AM - 6:30 PM</p>
									
									<h5>Saturday</h5>
									<p>Closed</p>
									
									<h5>Sunday</h5>
									<p>Closed</p>
								</div>
							</div>
						</div>
						<h3 class="section-title">Get connected</h3>
						<p>
						Lorem ipsumn qersl ioinm sersoe non urna dolor sit amet, consectetur piesn qersl ioinm sersoe non urna dolor aecena.
						</p>						
					</div>
				</div>
			</div>

       <?php include"footer.php" ?>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <!-- JavaScript libs are placed at the end of the document so the pages load faster -->
    
    
   </body>
</html>
