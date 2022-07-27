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
                            <h4>Edit Property</h4>
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
                    <div class="float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Property</a></li>
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
        <?php echo form_open_multipart('Property/update_property');
            echo form_hidden('propid',$specificdetails->propid);?>
              <div class="form-group">
                  <div class="row">
                      <div class="col-lg-3">
                         <label for="prop_name">Property_Name</label>
                          <?php echo form_input(['class'=>'form-control','placeholder'=>'Property Name',
                          'name'=>'prop_name','value'=>set_value('prop_name',$specificdetails->prop_name)]);?>
                           <?php echo form_error('prop_name'); ?>
                      </div>
                      <div class="col-lg-3">
                         <label for="prop_status">Property_Status</label>
                          <?php 
                              $options = array(
                                  ''=>'Select Status',
                                  'Available for Rent'=>'Available for Rent',
                                  'Available for Buying'=>'Available for Buying',
                                  'Not Available'=>'Not Available'
                                      );
                              echo form_dropdown(['class'=>'form-control','name'=>'prop_status'],
                                  $options,set_value('prop_status',$specificdetails->prop_status));
                          
                              echo form_error('prop_status'); 
                          ?>
                      </div>
                      <div class="col-lg-3">
                         <label for="prop_area">Property_Area</label>
                          <select name="prop_area" class="form-control">
                              <option value="">Select Area</option>
                              <?php foreach($area as $row): 

                              if($specificdetails->prop_area_id===$row['prop_area_id'])
                              {
                              ?>
                              <option  selected value="<?php echo $row['prop_area_id']; ?>" ><?php echo $row['prop_area']; ?></option>
                              <?php } 
                              else{?>
                                  <option   value="<?php echo $row['prop_area_id']; ?>" ><?php echo $row['prop_area']; ?></option>
                              
                              <?php } endforeach; ?> 
                          </select>
                          <?php  echo form_error('prop_area');  ?>
                      </div>
                       <div class="col-lg-3">
                         <label for="prop_owner">Property_Owner</label>
                          <select name="prop_owner" class="form-control">
                              <option value="">Select Owner</option>
                              <?php if($this->session->userdata('user_type')!="admin"){?>
                            <option selected value="<?php echo $this->session->userdata('uid'); ?>" ><?php echo $this->session->userdata('full_name'); ?></option>
                            <?php }
                                  else
                                  { ?>
                              <?php foreach($owner as $row):
                              if($specificdetails->uid===$row['uid'])
                              {
                              ?>
                              <option selected value="<?php echo $row['uid']; ?>" ><?php echo $row['full_name']; ?></option>
                              <?php } 
                              else{?>
                                  <option   value="<?php echo $row['uid']; ?>" ><?php echo $row['full_name']; ?></option>
                              
                              <?php } endforeach;} ?> 
                          </select>
                      </div>
                  </div>
              </div>
              <div class="form-group">
                  <div class="row">
                      <div class="col-lg-3">
                         <label for="prop_type">Property_Type</label>
                          <select id="prop_type" name="prop_type" class="form-control">
                              <option value="">Select Type</option>
                              <?php foreach($type as $row): 
                              if($specificdetails->prop_type_id===$row['prop_type_id'])
                              {
                              ?>
                                  <option selected value="<?php echo $row['prop_type_id']; ?>" ><?php echo $row['prop_type']; ?></option>
                              <?php } 
                              else
                                  {?>
                                  <option   value="<?php echo $row['prop_type_id']; ?>" ><?php echo $row['prop_type']; ?></option>
                              
                              <?php } endforeach; ?> 
                          </select>
                           <?php echo form_error('prop_type'); ?>
                      </div>
                      <div class="col-lg-3">
                         <label for="prop_city">Property_City</label>
                        <select name="prop_city" class="form-control">
                              <option value="">Select City</option>
                              <?php foreach($city as $row):
                               if($specificdetails->prop_type_id===$row['prop_type_id'])
                              {?>
                                  <option selected value="<?php echo $row['city_name']; ?>" ><?php echo $row['city_name']; ?></option>
                        <?php }
                              else
                              {?>
                                  <option  value="<?php echo $row['city_name']; ?>" ><?php echo $row['city_name']; ?></option>
                        <?php } endforeach; ?> 
                        </select>
                         <?php echo form_error('prop_city'); ?>
                    </div>
                      <div class="col-lg-3">
                         <label for="prop_location">Location</label>
                          <?php echo form_input(['class'=>'form-control','placeholder'=>'Property Location',
                          'name'=>'prop_location','value'=>set_value('prop_location',$specificdetails->prop_location)]);?>
                           <?php echo form_error('prop_location'); ?>
                      </div>
                      <div class="col-lg-3">
                         <label for="prop_value">Property_Price</label>
                          <?php echo form_input(['class'=>'form-control','placeholder'=>'Property Value',
                          'name'=>'prop_value','value'=>set_value('prop_value',$specificdetails->prop_value)]);?>
                           <?php echo form_error('prop_value'); ?>
                      </div>
                  </div>
              </div>
              <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3">
                       <label for="type_category">Type_Category</label>
                        <select id="type_category" name="type_category" class="form-control">
                              <option value="">Select City</option>
                              <?php foreach($category as $row):
                               if($specificdetails->pro_typecat_id===$row['pro_typecat_id'])
                              {?>
                                  <option selected value="<?php echo $row['pro_typecat_id']; ?>" ><?php echo $row['category_name']; ?></option>
                        <?php }
                              else
                              {?>
                                  <option  value="<?php echo $row['pro_typecat_id']; ?>" ><?php echo $row['category_name']; ?></option>
                        <?php } endforeach; ?> 
                        </select>
                         <?php echo form_error('type_category'); ?>
                    </div>
                    <div class="col-lg-3" id="beds">
                       <label for="bedrooms">Bedrooms</label>
                       <?php echo form_input(['class'=>'form-control','placeholder'=>'Bedrooms',
                      'name'=>'bedrooms','value'=>set_value('bedrooms',$specificdetails->bedrooms)]);?>
                       <?php echo form_error('bedrooms'); ?>
                   </div>
                   <div class="col-lg-3" id="baths">
                     <label for="bathrooms">Bathrooms</label>
                       <?php echo form_input(['class'=>'form-control','placeholder'=>'Bathrooms',
                      'name'=>'bathrooms','value'=>set_value('bathrooms',$specificdetails->bathrooms)]);?>
                       <?php echo form_error('bathrooms'); ?>
                   </div>
                   <div class="col-lg-3">
                    <input type="hidden" name="getpath" value="<?php echo $specificdetails->prop_img_link ?>">
                      <label for="property_image">Property_Image</label>
                      <input type="file" name="userfile">
                      <div class="text-danger">
                      <?php if(isset($upload_error)){ echo $upload_error;} ?>
                      </div>
                    </div>
                </div>
              </div>
               <div class="form-group">
                  <div class="row">
                    <div class="col-lg-4">
                    </div>
                    <div class="col-lg-4">
                       <label for="on_hold">Booking_Status</label>
                        <?php if($this->session->userdata('user_type')=="admin"){?>
                            
                      <select id="on_hold" name="on_hold" class="form-control">
                              <option value="">Select Booking Status</option>
                              <?php
                               if($specificdetails->on_hold==="1")
                              {?>
                                  <option selected value="1" ><?php echo "Available" ?></option>
                                  <option  value="0" ><?php echo "On Hold" ?></option>
                        <?php }
                              else
                              {?>
                                  <option  selected value="0" ><?php echo "On Hold" ?></option>
                                  <option  value="1" ><?php echo "Available" ?></option>
                        <?php }  ?> 
                        </select>
                        <?php } ?>
                     
                    </div>
                    <div class="col-lg-4">
                    </div>
                  </div>
              </div>
              <div class="form-actions form-group">
                  <?php echo form_submit(['type'=>'submit','class'=>'btn btn-success btn-sm'
                   ,'value'=>'Update']); ?>
              </div>
             <?php echo form_close();?>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script type="text/javascript">

$(document).ready(function(){
  
    // Type change
    $('#prop_type').change(function(){
      var prop_type_id = $(this).val();
    if(prop_type_id==1)
      {
           document.getElementById('beds').style.visibility = 'visible';
           document.getElementById('baths').style.visibility = 'visible';
      }
      else
      {
           document.getElementById('beds').style.visibility = 'hidden';
           document.getElementById('baths').style.visibility = 'hidden';
      }  
      // AJAX request
    $.ajax({
        url:'<?php echo base_url('Property/getPropTypeCategory');?>',
        method: 'post',
        data: {prop_type_id: prop_type_id},
        dataType: 'json',
        success: function(response){
              document.getElementById('type_category').style.visibility = 'visible';
      
          // Remove options 
        
          $('#type_category').find('option').not(':first').remove();

          // Add options
          $.each(response,function(index,data){
             $('#type_category').append('<option value="'+data['pro_typecat_id']+'">'+data['category_name']+'</option>');
          
          });
        }
     });
   });
    $('#type_category').change(function(){
      var cat_id = $(this).val();
      if(cat_id=="8" || cat_id=="1")
      {
           document.getElementById('baths').style.visibility = 'visible';
      }
      else
      {
           document.getElementById('baths').style.visibility = 'hidden';
      }
   });
});
</script>
