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
                              <h4>Edit Type Category</h4>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-4">
                      <?php if($msg = $this->session->flashdata('Update_Failed')):
                          $msg_class = $this->session->flashdata('msg_class')?>
                          <div class="alert <?php echo $msg_class ?>">
                              <?php echo $msg; ?>
                          </div>
                      <?php endif;?>
                  </div>
                  <div class="col-sm-4">
                      <div class="float-right">
                          <div class="page-title">
                              <ol class="breadcrumb text-right">
                                  <li><a href="#">Property</a></li>
                                  <li><a href="#">Property Type</a></li>
                                  <li><a href="#">Category</a></li>
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
      <?php echo form_open('Property/update_typecategory');
      echo form_hidden('pro_typecat_id',$catdetails->pro_typecat_id);?>
        <div class="form-group">
            <div class="row">
                <div class="col-lg-6">
                  <label for="category_name">Category_Name</label>
                   <?php echo form_input(['class'=>'form-control','placeholder'=>'Category Name',
                        'name'=>'category_name','value'=>set_value('category_name',$catdetails->category_name)]);?>
                    <?php echo form_error('category_name'); ?>
                </div>
                <div class="col-lg-6">
                  <label for="prop_type">Property_Type</label>
                  <select id="prop_type" name="prop_type" class="form-control">
                        <option value="">Select Type</option>
                        <?php foreach($type as $row): 
                        if($catdetails->prop_type_id===$row['prop_type_id'])
                        {
                        ?>
                            <option selected value="<?php echo $row['prop_type_id']; ?>" ><?php echo $row['prop_type']; ?></option>
                        <?php } 
                        else
                            {?>
                            <option value="<?php echo $row['prop_type_id']; ?>" ><?php echo $row['prop_type']; ?></option>
                        
                        <?php } endforeach; ?> 
                  </select>
                      <?php echo form_error('prop_type'); ?>
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
       