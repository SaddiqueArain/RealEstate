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
					<h1 style="color: black">Our Projects</h1>
				</div>
			</div>
		</div>
	</header>

	<!-- container -->
	<section class="container">
		<div class="row">
			<div class="col-md-12">
				<section id="portfolio" class="page-section section appear clearfix">
					<br />
					<br />
					<p>
						Here all the projects that are developed or in propgress will be shown. You can view the information of any project from here. You can also contact with the owners of the project if you want to purchase make a partnership with the owner. View any project to know its information.
					<br />
						<br />
					</p>


					<div class="row">
						<nav id="filter" class="col-md-12 text-center">
							<ul>
								<li><a href="#" class="current btn-theme btn-small" data-filter="*">All</a></li>
								<li><a href="#" class="btn-theme btn-small" data-filter=".residencial">Residencial</a></li>
								<li><a href="#" class="btn-theme btn-small" data-filter=".offices">Offices</a></li>
								<li><a href="#" class="btn-theme btn-small" data-filter=".mall">Mall</a></li>
							</ul>
						</nav>
						<div class="col-md-12">
							<div class="row">
								<div class="portfolio-items isotopeWrapper clearfix" id="3">
									<?php foreach($residencial as $row):?>
									<article class="col-sm-4 isotopeItem residencial">
										<div class="portfolio-item">
											<img style="width:100%;height:240px;" src="<?php echo $row['proj_img_link'];?>" alt="" />
											<div class="portfolio-desc align-center">
												<div class="folio-info">
													<h5><?php echo $row['project_title'];?></h5>
													<?php $status = $row['status'];
													if($status==="Completed")
													{?>
														<?php echo form_open('Home/completeprojectinfo');?> 
				                                        <?php echo form_hidden('project_id',$row['project_id']);?> 
				                                         <button type="submit" style="margin-left:100px;" class="update_property btn btn-default">View</button>
				                                      <?php echo form_close();?>
													<?php 
													}
													else
													{?>
														<?php echo form_open('Home/currentprojectinfo');?> 
				                                        <?php echo form_hidden('project_id',$row['project_id']);?> 
				                                         <button type="submit" style="margin-left:100px;" class="update_property btn btn-default">View</button>
				                                      	<?php echo form_close();
				                                  	}?>
													
													
												</div>
											</div>
										</div>
									</article>
									<?php endforeach;?>
									<?php foreach($mall as $row):?>
									<article class="col-sm-4 isotopeItem mall">
										<div class="portfolio-item">
											<img style="width:100%;height:240px;" src="<?php echo $row['proj_img_link'];?>" alt="" />
											<div class="portfolio-desc align-center">
												<div class="folio-info">
													<h5><?php echo $row['project_title'];?></h5>
													<?php $status = $row['status'];
													if($status==="Completed")
													{?>
														<?php echo form_open('Home/completeprojectinfo');?> 
				                                        <?php echo form_hidden('project_id',$row['project_id']);?> 
				                                         <button type="submit" style="margin-left:100px;" class="update_property btn btn-default">View</button>
				                                      <?php echo form_close();?>
													<?php 
													}
													else
													{?>
														<?php echo form_open('Home/currentprojectinfo');?> 
				                                        <?php echo form_hidden('project_id',$row['project_id']);?> 
				                                         <button type="submit" style="margin-left:100px;" class="update_property btn btn-default">View</button>
				                                      	<?php echo form_close();
				                                  	}?>
													
													
												</div>
											</div>
										</div>
									</article>
									<?php endforeach;?>

									<?php foreach($offices as $row):?>
									<article class="col-sm-4 isotopeItem offices">
										<div class="portfolio-item">
											<img style="width:100%;height:240px;" src="<?php echo $row['proj_img_link'];?>" alt="" />
											<div class="portfolio-desc align-center">
												<div class="folio-info">
													<h5><?php echo $row['project_title'];?></h5>
													<?php $status = $row['status'];
													if($status==="Completed")
													{?>
														<?php echo form_open('Home/completeprojectinfo');?> 
				                                        <?php echo form_hidden('project_id',$row['project_id']);?> 
				                                         <button type="submit" style="margin-left:100px;" class="update_property btn btn-default">View</button>
				                                      <?php echo form_close();?>
													<?php 
													}
													else
													{?>
														<?php echo form_open('Home/currentprojectinfo');?> 
				                                        <?php echo form_hidden('project_id',$row['project_id']);?> 
				                                         <button type="submit" style="margin-left:100px;" class="update_property btn btn-default">View</button>
				                                      	<?php echo form_close();
				                                  	}?>
													
													
												</div>
											</div>
										</div>
									</article>
									<?php endforeach;?>

								</div>

							</div>


						</div>
					</div>

				</section>
			</div>
		</div>

	</section>
	       <?php include"footer.php" ?>

   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url('home/assets/js/jquery.cslider.js');?>"></script>
	<script src="<?php echo base_url('home/assets/js/jquery.isotope.min.js');?>"></script>
	<script src="<?php echo base_url('home/assets/js/fancybox/jquery.fancybox.pack.js');?>" type="text/javascript"></script>
	<script src="<?php echo base_url('home/assets/js/custom.js');?>"></script>
</body>
</html>
