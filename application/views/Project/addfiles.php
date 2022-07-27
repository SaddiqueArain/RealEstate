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
                            <h4>Add Project Files</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                            <?php if($msg = $this->session->flashdata('Insert_Success')):
                            $msg_class = $this->session->flashdata('msg_class')?>
                        <div class="alert <?php echo $msg_class ?>">
                            <?php echo $msg; ?>
                        </div>
                        <?php endif;?>
                          
                          <?php if($msg = $this->session->flashdata('Insert_Failed')):
                            $msg_class = $this->session->flashdata('msg_class')?>
                        <div class="alert <?php echo $msg_class ?>">
                            <?php echo $msg; ?>
                        </div>
                            <?php endif;?>
                         
                    </div>
                <div class="col-sm-4">
                    <div class=" float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Project</a></li>
                                <li><a href="#">Add Project Files</a></li>
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
         <div class="card">
            <div class="card-body">
      <?php echo form_open_multipart('Project/insert_project_files');?>
                    <div class="row">
                        <div class="col-sm-4">
                          <label for="project_name">Prject Title</label>
                            <select id="project_name" name="project_name" class="form-control">
                                <option value="">Select Project</option>
                              <?php foreach($project as $row):?>
                                <option value="<?php echo $row['project_id']; ?>"><?php echo $row['project_title']; ?></option>
                              <?php endforeach;?>
                            </select>
                                <?php echo form_error('project_name'); ?>
                          </div>
                          <div class="col-sm-6">
                              <label for="project_files">Project_Files</label>
                              <?php echo form_upload('file[]', null,'multiple');?>
                         </div>
                      </div>
                    <br>
                    <br>
                <?php echo form_submit(['type'=>'submit','class'=>'btn btn-success btn-sm'
                 ,'value'=>'Submit']); ?>
            </div>
            
          </div>
        </div>
            
        <?php echo form_close();?>
      
     
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
  buttonWidth:'300px'
 });
 
 
 
 
});
</script>
