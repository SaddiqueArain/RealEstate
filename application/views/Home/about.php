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
                    <h1 style="color: black;background-color: transparent;">About us</h1>
                </div>
            </div>
        </div>
    </header>

    <!-- container -->
    <section class="container" style="margin-top:40px;">
        <div class="row">
            <!-- main content -->
                <div class="col-md-12">
                    <div class="about-logo">
                        <h3>We are awesome <span class="color">TEAM</span></h3>
                        <p>Fahad Estate is the leading real estate and rental marketplace dedicated to empowering consumers with data, inspiration and knowledge around the place they call home, and connecting them with the best local professionals who can help.</p>
                            <p>Fahad Estate serves the full lifecycle of owning and living in a home: buying, selling, renting, financing, remodeling and more. It starts with Fahad Estate's living database of homes - including homes for sale, homes for rent and homes not currently on the market, as well as estimate home values, Rent estimates and other home-related information.</p>
                    </div>
                      
                </div>
               
                <br>

                              <!-- /main -->

            <!-- Sidebar -->
            
        </div>
    </section>
    <br>
    <!-- /container -->
    <section class="team-content" style="border-top:1px solid gray">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Our Team</h3>
                    <p>Here we have some of our partners and big clients that are invlove in the development of the real estate. They are the main persons of this industry.</p>
                    <br />
                </div>
            </div>
            <div class="row">

                <div class="col-md-3 col-sm-6 col-xs-6">
                    <!-- Team Member -->
                    <div class="team-member">
                        <!-- Image Hover Block -->
                        <div class="member-img">
                            <!-- Image  -->
                            <img class="img-responsive" src="<?php echo base_url('home/assets/images/photo-1.jpg');?>" alt="">
                        </div>
                        <!-- Member Details -->
                        <h4>Fahad</h4>
                        <!-- Designation -->
                        <span class="pos">CEO</span>
                        <div class="team-socials">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-google-plus"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-dribbble"></i></a>
                            <a href="#"><i class="fa fa-github"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <!-- Team Member -->
                    <div class="team-member pDark">
                        <!-- Image Hover Block -->
                        <div class="member-img">
                            <!-- Image  -->
                            <img class="img-responsive" src="<?php echo base_url('home/assets/images/photo-2.jpg');?>" alt="">
                        </div>
                        <!-- Member Details -->
                        <h4>Larry Doe</h4>
                        <!-- Designation -->
                        <span class="pos">Director</span>
                        
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <!-- Team Member -->
                    <div class="team-member pDark">
                        <!-- Image Hover Block -->
                        <div class="member-img">
                            <!-- Image  -->
                            <img class="img-responsive" src="<?php echo base_url('home/assets/images/photo-3.jpg');?>" alt="">
                        </div>
                        <!-- Member Details -->
                        <h4>Ranith Kays</h4>
                        <!-- Designation -->
                        <span class="pos">Manager</span>
                       
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <!-- Team Member -->
                    <div class="team-member pDark">
                        <!-- Image Hover Block -->
                        <div class="member-img">
                            <!-- Image  -->
                            <img class="img-responsive" src="<?php echo base_url('home/assets/images/photo-4.jpg');?>" alt="">
                        </div>
                        <!-- Member Details -->
                        <h4>Joan Ray</h4>
                        <!-- Designation -->
                        <span class="pos">Creative</span>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
          <?php include"footer.php" ?>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <!-- JavaScript libs are placed at the end of the document so the pages load faster -->
    
   
    
    
    
</body>
</html>
