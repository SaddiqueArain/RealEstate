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
					<h1>Project Information</h1>
				</div>
			</div>
		</div>
	</header>

	<!-- container -->
	<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h3 class="section-title"> 
						<?php echo $complete->project_title; echo " ";
							
						?></h3>
					</div>
					<div class="row">
						<div class="col-md-12" >
							<img src="<?php echo $complete->proj_img_link;?>">
					
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
						<div class="card ">
							<div class="card-body">
								<div class="card-heading" >
										<p style=" font-size: 24px;font-weight: 700;background-color: #fafafa;padding: 13px 20px;border-bottom: 1px solid #E9E9E9">Overview</p>		
								</div>
								<p style="font-weight: 400;margin-bottom: 17px;font-size: 24px;"> &nbsp&nbspDetails & Description</p>
								<div class="col-md-4">
								
									<ul>
										<li>
												Project ID   &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; <?php echo $complete->project_id; ?>
										</li>
										<br>
										<li>
												Project Type   &emsp;&emsp;&emsp;&emsp;&emsp;&emsp; <?php echo $complete->type_name; ?>
										</li>
										<br>
										<li>
												Project Owner &emsp;&emsp;&emsp;&emsp;&ensp;&nbsp;&nbsp;&nbsp; <?php echo $complete->full_name;?>
										</li>
										<br>
										
								</ul>
								</div>
								<div class="col-md-4">
									<ul>
										<li>
												Location&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;<?php echo $complete->location; ?>

										</li>
										<br>
										<li>
											City &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;  <?php echo $complete->city;?>
										</li>
												
										<br>
										<li>
												Price &emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&ensp;&nbsp;&nbsp;&nbsp; <?php echo $complete->price;?>
										</li>
										<br>
										
								</ul>
								</div>
								<div class="col-md-4">
									<ul>
										<li>
												Project Status&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;<?php echo $complete->status; ?>

										</li>
										<br>
										<li>
												Start On &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;  <?php echo $complete->starting_date;?>
										</li>
										<br>
										<li>
												Completed On &emsp;&emsp;&emsp;&emsp;&ensp;&nbsp;&nbsp; <?php echo $complete->completion_date;?>
										</li>
										<br>
										
								</ul>
								</div>
    							<p style="font-weight: 300;margin-bottom: 17px;font-size: 22px;"> &nbsp&nbspDescription</p>
    							<p style="text-align: left; text-align: justify;text-justify: inter-word;"><?php echo $complete->project_description;?></p>
    							<p style="font-weight: 300;margin-bottom: 17px;font-size: 22px;"> &nbsp&nbsp For More details Please <button id="myBtn" class="popup btn btn-success" style="background: green">Contact!</button>
  										
    								</p>
    								
							</div>
						</div>
					</div>
				</div>

					
					

						<div id="myModal" class="modal">

  						<!-- Modal content -->
							  <div class="modal-content">
							    <div class="modal-header">
							      <span class="close">&times;</span>
							      <h2>Contact Info</h2>
							    </div>
							    <div class="modal-body">
							      <p>Contact Number : <?php echo $complete->contact_no;  ?></p>
							      <p>Email Address : <?php echo $complete->email; ?></p>
							    </div>
							    <div class="modal-footer">
							      <h3></h3>
							    </div>
							  </div>

						</div>
	
											</div>
										
			


      <?php include"footer.php" ?>

   <script type="text/javascript">
   	var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

   </script>
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
