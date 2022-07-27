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
                                <li class="active">Edit</li>
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
      <?php echo form_open_multipart('Project/update_project');
            echo form_hidden('project_id',$project->project_id)?>
            <div class="form-group">
                <div class="row">
                  <div class="col-lg-3">
                    <?php echo form_input(['class'=>'form-control','placeholder'=>'Project Title',
                        'name'=>'project_title','id'=>'project_title','value'=>set_value('project_title',$project->project_title)]);?>
                        
                         <?php echo form_error('project_title'); ?>
                  </div>
                 
                    <div class="col-lg-3">
                          <?php 
                              $options = array(
                                  ''=>'Select Status',
                                  'On Going'=>'On Going',
                                  'Completed'=>'Completed',
                                  'Pause'=>'Pause'
                                      );
                              echo form_dropdown(['class'=>'form-control','name'=>'status','id'=>'proj_status'],
                                  $options,set_value('status',$project->status));
                          
                              echo form_error('status'); 
                          ?>
                    </div>
                    <div class="col-lg-3">
                      <select id="owner_id" name="owner_id" class="form-control">
                        <option value="">Select Project Owner</option>
                        <?php foreach($owner as $row):
                          if($project->owner_id===$row['uid'])
                            {?>
                         <option selected value="<?php echo $row['uid']; ?>"><?php echo $row['full_name']; ?></option>
                         <?php }else
                         {?>
                          <option  value="<?php echo $row['uid']; ?>"><?php echo $row['full_name']; ?></option>
                        <?php } endforeach;?>
                      </select>
                      <?php echo form_error('owner_id'); ?>
                    </div>
                    <div class="col-lg-3">
                      <select id="project_type_id" name="project_type_id" class="form-control">
                        <option value="">Select Project Owner</option>
                        <?php foreach($type as $row):
                          if($project->project_type_id===$row['project_type_id'])
                            {?>
                         <option selected value="<?php echo $row['project_type_id']; ?>"><?php echo $row['type_name']; ?></option>
                         <?php }else
                         {?>
                          <option  value="<?php echo $row['project_type_id']; ?>"><?php echo $row['type_name']; ?></option>
                        <?php } endforeach;?>
                      </select>
                      <?php echo form_error('project_type_id'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-3">
                      <?php echo form_input(['class'=>'form-control','placeholder'=>'Location',
                          'name'=>'location','id'=>'location','value'=>set_value('location',$project->location)]);?>
                          
                           <?php echo form_error('location'); ?>
                    </div>
                    <div class="col-lg-3">
                        <select id="city" name="city" class="form-control">
                        <option value="">Select City</option>
                          <?php foreach($city as $row):
                            if($project->city===$row['city_name'])
                              {?>
                           <option selected value="<?php echo $row['city_name']; ?>"><?php echo $row['city_name']; ?></option>
                          <?php }else
                           {?>
                            <option  value="<?php echo $row['city_name']; ?>"><?php echo $row['city_name']; ?></option>
                            <?php } endforeach; ?>
                        </select>
                        <?php echo form_error('city'); ?>
                    </div>
                    <div class="col-lg-3">
                      <?php echo form_input(['class'=>'form-control','placeholder'=>'Price',
                          'name'=>'price','id'=>'price','value'=>set_value('price',$project->price)]);?>
                          
                           <?php echo form_error('price'); ?>
                    </div>
                     <div class="col-lg-3" id="complete_date">
                      <?php echo form_input(['class'=>'form-control','placeholder'=>'Completion Date',
                          'name'=>'complete_date','id'=>'date','value'=>set_value('complete_date',$project->completion_date)]);?>
                     </div>
                </dir>
            </div>
            <br>
            <div class="form-group">
                <div class="row">
                   <div class="col-lg-12">
                    <?php echo form_textarea(['class'=>'form-control','placeholder'=>'Project Description',
                        'name'=>'project_description','id'=>'project_description','value'=>set_value('project_description',$project->project_description)]);?>
                        
                         <?php echo form_error('project_description'); ?>
                  </div>
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
  //alert("Sadsasd");
  window.onload = function(){
     document.getElementById("complete_date").style.display = 'none';
    var status = document.getElementById("proj_status").value;
   // alert(status);
        if(status=="Completed")
        {
          document.getElementById("complete_date").style.display = 'block';
          
        }
        else
        {
          document.getElementById("complete_date").style.display = 'none';
          document.getElementById("date").value = "-1";
        }
  }
$(document).ready(function(){
 
 
 
 $('#proj_status').change(function(){
  var status = $(this).val();
  if(status=="Completed")
  {

    document.getElementById("complete_date").style.display = 'block';
    var today = new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var dateTime = date+' '+time;
    document.getElementById("date").value = dateTime;

  }
  else
  {
    document.getElementById("complete_date").style.display = 'none';
    document.getElementById("date").value = "-1";
  }
 });
 
});
</script>

        