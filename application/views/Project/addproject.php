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
                            <h4>Project</h4>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class=" float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Project</a></li>
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
    <section class="content container-fluid" style="margin-top: -30px;">
      <div class="content">
      <?php echo form_open_multipart('Project/insert_project');?>
            <div class="form-group">
                <div class="row">
                  <div class="col-lg-3">
                    <?php echo form_input(['class'=>'form-control','placeholder'=>'Project Title',
                        'name'=>'project_title','id'=>'project_title','value'=>set_value('project_title')]);?>
                        
                         <?php echo form_error('project_title'); ?>
                  </div>
                 
                    <div class="col-lg-3">
                        <select id="status" name="status" class="form-control">
                            <option value="">Select Status</option>
                            <option value="On Going">On Going</option>
                            <option value="Completed">Completed</option>
                            <option value="Pause">Pause</option>
                        </select>
                        
                         <?php echo form_error('status'); ?>
                    </div>
                     <div class="col-lg-3">
                    <select id="owner_id" name="owner_id" class="form-control">
                      <option value="">Select Project Owner</option>
                        <?php foreach($owner as $row):?>
                         <option value="<?php echo $row['uid']; ?>"><?php echo $row['full_name']; ?></option>
                        <?php endforeach;?>
                      </select>
                      <?php echo form_error('owner_id'); ?>
                    </div>
                    <div class="col-lg-3">
                      <select id="project_type_id" name="project_type_id" class="form-control">
                      <option value="">Select Project Type</option>
                        <?php foreach($type as $row):?>
                         <option value="<?php echo $row['project_type_id']; ?>"><?php echo $row['type_name']; ?></option>
                        <?php endforeach;?>
                      </select>
                      <?php echo form_error('project_type_id'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                  <div class="col-lg-4">
                    <?php echo form_input(['class'=>'form-control','placeholder'=>'Location',
                        'name'=>'location','id'=>'location','value'=>set_value('location')]);?>
                        
                         <?php echo form_error('location'); ?>
                  </div>
                  <div class="col-lg-4">
                      <select id="city" name="city" class="form-control">
                      <option value="">Select City</option>
                        <?php foreach($city as $row):?>
                         <option value="<?php echo $row['city_name']; ?>"><?php echo $row['city_name']; ?></option>
                        <?php endforeach;?>
                      </select>
                      <?php echo form_error('city'); ?>
                    </div>
                <div class="col-lg-4">
                    <?php echo form_input(['class'=>'form-control','placeholder'=>'Price',
                        'name'=>'price','id'=>'price','value'=>set_value('price')]);?>
                        
                         <?php echo form_error('price'); ?>
                </div>
            </div>
          </div>
            <div class="form-group">
                <div class="row">
                   <div class="col-lg-12">
                    <?php echo form_textarea(['class'=>'form-control','placeholder'=>'Project Description',
                        'name'=>'project_description','id'=>'project_description','value'=>set_value('project_description')]);?>
                        
                         <?php echo form_error('project_description'); ?>
                  </div>
                </div>
            </div>
            <div class="form-group">
                <dir class="row">
                   <div class="col-lg-4">
                        <select id="engineer_assoc" name="engineer_assoc[]" multiple class="form-control" >
                          <?php foreach ($engineer as $row):?>
                          <option value="<?php echo $row['uid'];?>"><?php echo $row['full_name'] ?></option>
                          <?php endforeach; ?>
                        </select>
                   </div>
                   <div class="col-lg-1">
                     
                   </div>
                   <div class="col-lg-3">
                      <label for="userfile" style="margin-left:40px;">Project Pic</label>

                        <div class="form-group" style=" margin-left:31px;">
                          <?php echo form_upload(['name'=>'userfile']);?>
                        </div>
                     <div class="text-danger">
                      <?php if(isset($upload_error)){ echo $upload_error;} ?>
                      </div>
                     
                    
                    </div>
                    
                   <div class="col-lg-4">
                      <label for="project_files">Project_Files</label>
                      <?php echo form_upload('file[]', null,'multiple');?>
                      
                    </div>
                </dir>
            </div>
            <div class="form-group">
                <div class="row">
                  
                    <div class="col-lg-4"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                  <div class="col-lg-4"></div>
                  <div class="col-lg-4">
                    <div class="form-actions form-group">
                <?php echo form_submit(['type'=>'submit','class'=>'btn btn-success btn-sm'
                 ,'value'=>'Submit']); ?>
            </div>
                  </div>
                  <div class="col-lg-4">
                  </div>
                </div>
            </div>
            
        <?php echo form_close();?>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script>
$(document).ready(function(){
 $('#engineer_assoc').multiselect({
  nonSelectedText: 'Select Engineer Associated',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'400px'
 });
 
 
 
});
</script>
