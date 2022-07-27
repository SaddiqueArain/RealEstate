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
                            <h4>Add Property</h4>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class=" float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Property</a></li>
                                <li class="active">Add</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>
    </div>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div class="content">
      <?php echo form_open_multipart('Property/addproperty');?>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-3">
                      <label for="prop_name">Property_Name</label>
                        <?php echo form_input(['class'=>'form-control','placeholder'=>'Property Name',
                        'name'=>'prop_name','value'=>set_value('prop_name')]);?>
                         <?php echo form_error('prop_name'); ?>
                    </div>
                    <div class="col-lg-3">
                      <label for="prop_status">Property_Status</label>
                        <select name="prop_status" class="form-control">
                            <option value="">Select Status</option>
                            <option value="Available for Rent">Available for Rent</option>
                            <option value="Available for Buying">Available for Buying</option>
                            <option value="Not Available">Not Available</option>
                        </select>
                         <?php echo form_error('prop_status'); ?>
                    </div>
                    <div class="col-lg-3">
                      <label for="prop_area">Property_Area</label>
                        <select name="prop_area" class="form-control">
                            <option value="">Select Area</option>
                            <?php foreach($area as $row): ?>
                            <option value="<?php echo $row['prop_area_id']; ?>" ><?php echo $row['prop_area']; ?></option>
                            <?php endforeach; ?> 
                        </select>
                         <?php echo form_error('prop_area'); ?>
                    </div>
                     <div class="col-lg-3">
                      <label for="prop_owner">Property_Owner</label>
                        <select name="prop_owner" class="form-control">
                            <option value="">Select Owner</option>
                            <?php if($this->session->userdata('user_type')!="admin"){?>
                            <option value="<?php echo $this->session->userdata('uid'); ?>" ><?php echo $this->session->userdata('full_name'); ?></option>
                            <?php }
                                  else
                                  { ?>
                            <?php foreach($owner as $row): ?>
                            <option value="<?php echo $row['uid']; ?>" ><?php echo $row['full_name']; ?></option>
                            <?php endforeach;} ?> 
                        </select>
                         <?php echo form_error('prop_owner'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-3">
                      <label for="prop_type">Property_Type</label>
                        <select id="prop_type" name="prop_type" class="form-control">
                            <option value="">Select Type</option>
                            <?php foreach($type as $row): ?>
                            <option value="<?php echo $row['prop_type_id']; ?>" ><?php echo $row['prop_type']; ?></option>
                            <?php endforeach; ?> 
                        </select>
                         <?php echo form_error('prop_type'); ?>
                    </div>
                    <div class="col-lg-3">
                      <label for="prop_city">Property_City</label>
                      <select id="prop_city" name="prop_city" class="form-control">
                            <option value="">Select City</option>
                            <?php foreach($city as $row): ?>
                            <option value="<?php echo $row['city_name']; ?>" ><?php echo $row['city_name']; ?></option>
                            <?php endforeach; ?> 
                        </select>
                         <?php echo form_error('prop_city'); ?>
                    </div>
                    <div class="col-lg-3">
                      <label for="prop_location">Property_Location</label>
                        <?php echo form_input(['class'=>'form-control','placeholder'=>'Property Location',
                        'name'=>'prop_location','value'=>set_value('prop_name')]);?>
                         <?php echo form_error('prop_location'); ?>
                    </div>
                    <div class="col-lg-3">
                      <label for="prop_value">Property_Price</label>
                        <?php echo form_input(['class'=>'form-control','placeholder'=>'Property Value',
                        'name'=>'prop_value','value'=>set_value('prop_name')]);?>
                         <?php echo form_error('prop_value'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-3" id="subtype">
                      <label for="type_category">Property_SubType</label>
                        <select id="type_category" name="type_category" class="form-control">
                            <option>Select Category</option>
                        </select>
                    </div>
                    <div class="col-lg-3" id="beds">
                      <label for="bedrooms">Bedrooms</label>
                         <?php echo form_input(['class'=>'form-control','placeholder'=>'Bedrooms',
                        'name'=>'bedrooms','value'=>set_value('prop_name')]);?>
                         <?php echo form_error('bedrooms'); ?>
                    </div>
                    <div class="col-lg-3" id="baths">
                      <label for="bathrooms">Bathhrooms</label>
                         <?php echo form_input(['class'=>'form-control','placeholder'=>'Bathrooms',
                        'name'=>'bathrooms','value'=>set_value('prop_name')]);?>
                         <?php echo form_error('bathrooms'); ?>
                    </div>
                    <div class="col-lg-3">
                      <label for="property_image">Property_Image</label>
                      <?php echo form_upload(['name'=>'userfile']);?>
                      
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
 
  document.getElementById('subtype').style.visibility = 'hidden';
  document.getElementById('beds').style.visibility = 'hidden';
  document.getElementById('baths').style.visibility = 'hidden';
    // Type change
    $('#prop_type').change(function(){
      var prop_type_id = $(this).val();
    //  alert(prop_type_id);
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
        if(prop_type_id=="")
        {
          document.getElementById('subtype').style.visibility = 'hidden';
          document.getElementById('beds').style.visibility = 'hidden';
          document.getElementById('baths').style.visibility = 'hidden';
        }
        else
        { 
             document.getElementById('subtype').style.visibility = 'visible';
        }
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
      if(cat_id=="8" || cat_id=="1" || cat_id=="2" || cat_id=="3")
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