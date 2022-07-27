<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <!-- /.navbar -->
	<!-- Header -->
    <header id="head" style="height:530px !important;">
        <div class="container">
                <div class="navbar navbar-inverse" style="background-color:black !important; opacity: 0.3;position: fixed;">
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
                    <li class="active"><a href="<?php echo base_url('Home/index');?>" style="font-size:18px;">Home</a></li>
                    <li><a href="<?php echo base_url('Home/about');?>">About</a></li>
                   
                    
                    <li><a href="<?php echo base_url('Home/projects');?>" style="font-size:18px;">Projects</a></li>
                    <li><a href="<?php echo base_url('Home/getproperties');?>" style="font-size:18px;">Properties</a></li>
                    <li><a href="<?php echo base_url('Home/contact');?>" style="font-size:18px;">Contact</a></li>
                    <?php if(!$this->session->userdata('logged_in'))
                    {?>
                    <li><a href="<?php echo base_url('Login/index');?>" style="font-size:18px;">Sign in</a></li>
                    <?php }
                      else{ ?>
                              <li><a href="<?php if($this->session->userdata('user_type')=="admin")
                              { echo base_url('Admin/index');} else{echo base_url('Client/index');}?>" style="font-size:18px;">Panel</a></li>
                              <li><a href="<?php echo base_url('Login/logout');?>" style="font-size:18px;">Logout</a></li>
                    <?php } ?>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>

                    <div class="fluid_container">
                    <div class="camera_wrap camera_emboss pattern_1" id="camera_wrap_4">
                        <div data-thumb="<?php echo base_url('home/assets/images/slides/thumbs/img1.jpg');?>" data-src="<?php echo base_url('home/assets/images/slides/4.jpg');?>">
                        </div> 
                        <div data-thumb="<?php echo base_url('home/assets/images/slides/thumbs/2.jpg');?>" data-src="<?php echo base_url('home/assets/images/slides/2.jpg');?>">
                        </div>
                        <div data-thumb="<?php echo base_url('home/assets/images/slides/thumbs/3.jpg');?>" data-src="<?php echo base_url('home/assets/images/slides/3.jpg');?>">
                        </div> 
                    </div><!-- #camera_wrap_3 -->
                </div><!-- .fluid_container -->
        </div>
    </header>
    <!-- /Header -->

<div class="head-box" style="margin-top:-30px;background: #6D4DC8 ">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                        
                <h1 class="text-center  last" style="color:white;font-weight: bold;">Let’s find a home that’s perfect for you. </h1>
                
                <p class="text-center last">Search confidently with your trusted source of homes for sale or rent.</p>
                <center>
                 <?php echo form_open('Home/desired_property')?>
                    <div class="navbar" style="height:auto; width: 80%;">
                        <div class="dropdown">
                            <select class="input-group" name="prop_status" id="prop_status" style="font-size:16px;border:none;cursor:pointer;margin-top:14px;color:white;background:yellow;padding: 0px 4px 8px 10px;">
                                    <option value="Available for Buying">Buy</option>
                                    <option value="Available for Rent">Rent</option>
                            </select>   
                        </div>
                        <div class="dropdown">
                            <div class="input-group">
                                <select name="city_name" id="city_name" style="font-size:16px;border:none;cursor:pointer;margin-top:14px;color:white;background:#333;padding: 0px 4px 8px 10px;">
                                    
                                   <?php foreach($city as $row):?>
                                   <option value="<?php echo $row['city_name']; ?>"><?php echo $row['city_name']; ?></option>
                                    <?php endforeach; ?>
                                </select> 
                            </div>
                        </div>
                        <div class="dropdown">
                            <div class="input-group">

                                <select name="type" id="type" style="font-size:16px;border:none;cursor:pointer;margin-top:14px;color:white;background:#333;padding: 0px 4px 8px 10px;">
                                  
                                   <?php foreach($type as $row):?>
                                   <option value="<?php echo $row['prop_type'] ?>"><?php echo $row['prop_type'] ?></option>
                                    <?php endforeach; ?>
                                </select> 
                            </div>
                        </div>
                        <div class="dropdown">
                            <div class="input-group" id="category">
                                <select name="sub_type" id="sub_type" style="font-size:16px;border:none;cursor:pointer;margin-top:14px;color:white;background:#333;padding: 0px 4px 8px 10px;">
                                    
                                </select> 
                            </div>
                        </div>
                        <div class="dropdown">
                            <div class="input-group">
                                <select name="area" id="area" style="font-size:16px;border:none;cursor:pointer;margin-top:14px;color:white;background:#333;padding: 0px 4px 8px 10px;">
                                    <option value="0">Select Area</option>
                                    <?php foreach($area as $row):?>
                                   <option value="<?php echo $row['prop_area'] ?>"><?php echo $row['prop_area'] ?></option>
                                    <?php endforeach; ?>
                                </select> 
                            </div>
                        </div>
                        <div class="input-group">
                                <input type="text" name="location" placeholder="Location" style="font-size:16px;margin-top:9px;color:white;background:#333;padding: 0px 4px 10px 10px;">
                            <button style="margin-left: 5px;" id="all" type="submit" class="btn btn-default" ><i class="fa fa-search"></i></button>
                           
                        </div>
                        
                    </div>
                   <?php echo form_close();?>
                   </center>
                    </div><!-- end .col-sm-12 -->
                </div><!-- ene .row -->
            </div>
        </div>
      <section class="hero-text">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="aligncenter">
                    <br>
            
                    <h1 class="aligncenter">Welcome to our Fahad Estate</h1><p style="font-size: 16px;">Fahad Estate is committed to ensuring digital accessibility for individuals with disabilities. We are continuously working to improve the accessibility of our web experience for everyone, and we welcome feedback and accommodation requests. If you wish to report an issue or seek an accommodation, please</p><a href="<?php echo base_url('Home/contact');?>">Contact us</a></div>
            <br>
            <br>
            </div>

        </div>
    </div>
    </section>
        <section class="container">
            <div class="box-1">
            <div class="row">
            <div class="section-heading">
                            <h2>Our Services</h2>
                            <p>We are providing the helpfull services for our clients.</p>
                        </div>
                 
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="featured-box">
                        <i class="fa fa-eye fa-2x"></i>
                        <div class="text">
                            <h3>Buying</h3>
                            Discover your perfect home
                            With the most complete source of homes for sale & real estate near you.
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="featured-box">
                        <i class="fa fa-quote-right fa-2x"></i>
                        <div class="text">
                            <h3>Selling</h3>
                            Sell your home. Get the liquidity of selling your home without having to move.Sell with the guidance of a real estate professional.
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="featured-box">
                        <i class="fa fa-arrows fa-2x"></i>
                        <div class="text">
                            <h3>Renting</h3>
                            Discover your perfect rental
                            Search nearby apartments, condos, and homes for rent.
                        </div>
                    </div>
                </div>
            </div>
</div>
        </section>
        <section id="packages" class="secpadding">
        <div class="container">
             <h2><span>Properties</span></h2>
            <div class="row">
                <?php foreach($property as $row):?>
                <div class="col-md-3 col-sm-6">
                            <div class="cuadro_intro_hover " style="background-color:#cccccc;">
                                
                                <p style="text-align:center;">
                                    <img style="width:100%;height:100%;" src="<?php echo $row['prop_img_link'];?>" class="img-responsive" alt="">
                                </p>
                                <div class="caption">
                                    <div class="blur"></div>
                                    <div class="caption-text">
                                        <h3><?php echo $row['prop_name'];?></h3>
                                        <?php echo form_open('Home/propertyinfo');?> 
                                        <?php echo form_hidden('propid',$row['propid']);?> 
                                         <button type="submit" class="update_property btn btn-default">View</button>
                                        <?php echo form_close();?>
                                    </div>
                                </div>
                           
                            </div>
                        
                </div>
                 <?php endforeach;?>
                
            </div>    
         </div>
    </section>

      <section class="news-box secpadding">
        <div class="container">
            <h2><span>Current projects</span></h2>
            <div class="row">
                <?php foreach($current as $row):?>
                    <div class=" col-md-3 col-sm-6 ">
                        <div class="newsBox">
                            <div class="thumbnail">
                                <figure><img style="width: 100%;height: 100%" src="<?php echo $row['proj_img_link'];?>" class="img-responsive" alt=""></figure>
                                <div class="caption maxheight2">
                                    <div class="box_inner">
                                            <div class="box">
                                                <p class="title"><strong><?php echo $row['project_title'] ?></strong></p>
                                                
                                            </div>
                                            <div>
                                        <?php echo form_open('Home/currentprojectinfo');?> 
                                        <?php echo form_hidden('project_id',$row['project_id']);?> 
                                         <button type="submit" style="border-style: none;background: none;color: blue;">view more</button>

                                        <?php echo form_close();?>
                                                
                                            </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
   
  <section id="packages" class="secpadding">
        <div class="container">
             <h2><span>Completed Projects</span></h2>
            <div class="row">
                 <?php foreach($completed as $row):?>
                <div class="col-md-3 col-sm-6">
                            <div class="cuadro_intro_hover " style="background-color:#cccccc;">
                                <p style="text-align:center;">
                                    <img src="<?php echo $row['proj_img_link'];?>" class="img-responsive" alt="">
                                </p>
                                <div class="caption">
                                    <div class="blur"></div>
                                    <div class="caption-text">
                                        <h3><?php echo $row['project_title'] ?></h3> 
                                        <?php echo form_open('Home/completeprojectinfo');?> 
                                        <?php echo form_hidden('project_id',$row['project_id']);?> 
                                         <button type="submit" class="update_property btn btn-default">View</button>
                                        <?php echo form_close();?>
                                       
                                    </div>
                                </div>
                            </div>
                        
                </div>
                <?php endforeach; ?>
            </div>    
         </div>
    </section>
	
      
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
    <script>
        jQuery(function(){
            
            jQuery('#camera_wrap_4').camera({
                height: '500',
                loader: 'bar',
                pagination: false,
                thumbnails: false,
                hover: false,
                opacityOnGrid: false,
                imagePath: 'home/assets/images/'
            });

        });
    </script>
    <script type="text/javascript">
        window.onload =function(){
   /*document.getElementById("all").style.display = 'none';
         document.getElementById("one").style.display = 'none';
         document.getElementById("two").style.display = 'none';
         document.getElementById("three").style.display = 'none';
         document.getElementById("four").style.display = 'none';


         var category = document.getElementById("category").value;
    var prop_status = document.getElementById("prop_status").value;
    var city_name = document.getElementById("city_name").value;
    var area = document.getElementById("area").value;
    var location = document.getElementById("location").value;
    var type = document.getElementById("type").value;
    alert(type);
*/
     var type_id = document.getElementById("type").value;
     $.ajax({
            url:'<?php echo base_url('Home/getsubtype');?>',
            method: 'post',
            data: {type_id: type_id},
            dataType: 'json',
            success: function(response){
            
            //alert("yes");
              // Remove options 
             
              document.getElementById("category").style.display = 'block';
           $('#sub_type').find('option').remove();

             
              // Add options
              $.each(response,function(index,data){
                 $('#sub_type').append('<option value="'+data['category_name']+'">'+data['category_name']+'</option>');
              });
            }
         });

     }
$(document).ready(function(){
    
   // var type = document.getElementById("type").value;
   /* var category = document.getElementById("category").value;
    var prop_status = document.getElementById("prop_status").value;
    var city_name = document.getElementById("city_name").value;
    var area = document.getElementById("area").value;
    var location = document.getElementById("location").value;
*/
  /*  $('#type').change(function(){
        var type = $(this).val();
        alert(type);
    /*if(prop_status!="0")
    {
         document.getElementById("all").style.display = 'none';
         document.getElementById("one").style.display = 'block';
         document.getElementById("two").style.display = 'none';
         document.getElementById("three").style.display = 'none';
         document.getElementById("four").style.display = 'none';
    }*/
  /*  if(prop_status!="0" && type!="0")
    {
         document.getElementById("all").style.display = 'none';
         document.getElementById("one").style.display = 'none';
         document.getElementById("two").style.display = 'block';
         document.getElementById("three").style.display = 'none';
         document.getElementById("four").style.display = 'none';
    }
         
    });
    $('#city_name').change(function(){
        var city_name = $(this).val();
        if(prop_status!="0" && type!="0" && city_name!="0")
        {
            document.getElementById("all").style.display = 'none';
         document.getElementById("one").style.display = 'none';
         document.getElementById("two").style.display = 'none';
         document.getElementById("three").style.display = 'block';
         document.getElementById("four").style.display = 'none';
        }
        else if (prop_status!="0" && city_name!="0" && type=="0") {
             document.getElementById("all").style.display = 'none';
         document.getElementById("one").style.display = 'none';
         document.getElementById("two").style.display = 'block';
         document.getElementById("three").style.display = 'none';
         document.getElementById("four").style.display = 'none';
        }
    });

    $('#category').change(function(){
        var category = $(this).val();
        if(prop_status!="0" && type!="0" && city_name!="0" && category!="0")
        {
            document.getElementById("all").style.display = 'none';
         document.getElementById("one").style.display = 'none';
         document.getElementById("two").style.display = 'none';
         document.getElementById("three").style.display = 'none';
         document.getElementById("four").style.display = 'block';
        }
    });*/
    //document.getElementById("two").style.display = 'none';
    
    
  /////////////////////////////////////////////////////////////////

    document.getElementById("category").style.display = 'none';

    $('#type').change(function(){
      var type_id = $(this).val();
    if(type_id!="0")
    {

      // AJAX request
    
        $.ajax({
            url:'<?php echo base_url('Home/getsubtype');?>',
            method: 'post',
            data: {type_id: type_id},
            dataType: 'json',
            success: function(response){
            
            //alert("yes");
              // Remove options 
             
              document.getElementById("category").style.display = 'block';
             $('#sub_type').find('option').remove();

             
              // Add options
              $.each(response,function(index,data){
                 $('#sub_type').append('<option value="'+data['category_name']+'">'+data['category_name']+'</option>');
              });
            }
         });
    }
    else
    {
        document.getElementById("category").style.display = 'none';
    }
   });
});
    </script>
        

</body>
</html>
