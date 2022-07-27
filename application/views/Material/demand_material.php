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
                            <h4>Material</h4>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class=" float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Material</a></li>
                                <li class="active">Add</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>

    <!-- Main content -->
    <section class="content container-fluid" style="margin-top: -30px">
      <div class="content">
      <?php echo form_open('Material/demand_material');?>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                      <div class="col-sm-6">
                        <label>Cement</label>
                        <div class="col-lg-1">
                          <?php echo form_checkbox(['class'=>'check','name'=>'cement_chk','id'=>'cement_chk','value'=>'accept']);?>
                        </div>
                        <div class="col-lg-4"> 
                         <select name="cement" id="cement" class="form-control">
                          <option>Select Cement Type</option>
                         </select>
                        </div>
                        <div class="col-lg-4">
                          <input type="number" class='form-control' name='cement_quantity' id='cement_quantity' placeholder='Enter Quantity'>
                        </div>
                        <div class="col-lg-3">
                          <select name="cement_unit" id="cement_unit" class="form-control">
                            <option value="Bori">Bori</option>
                          </select>
                        </div>

                       
                    </div>
                    <div class="col-sm-6">
                        <label>Sand</label>
                        <div class="col-lg-1">
                          <?php echo form_checkbox(['class'=>'check','name'=>'sand_chk','id'=>'sand_chk','value'=>'accept']);?>
                        </div>
                        
                        <div class="col-lg-4">
                          <select name="sand" id="sand" class="form-control">
                          <option>Select Sand Type</option>
                        </select>
                        </div>
                         <div class="col-lg-4">
                              <input type="number" class='form-control' name='sand_quantity' id='sand_quantity' placeholder='Enter Quantity'>
                          </div>
                          <div class="col-lg-3">
                            <select name="sand_unit" id="sand_unit" class="form-control">
                              <option value="Trawly">Trawly</option>
                            </select>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-sm-6">
                        <label>Wood</label>
                        <div class="col-lg-1">
                            <?php echo form_checkbox(['class'=>'check','name'=>'wood_chk','id'=>'wood_chk','value'=>'accept']);?>
                        </div>
                        <div class="col-lg-4">
                          <select name="wood" id="wood" class="form-control">
                            <option>Select Wood Type</option>
                          </select> 
                        </div>
                         <div class="col-lg-4">
                              <input type="number" class='form-control' name='wood_quantity' id='wood_quantity' placeholder='Enter Quantity'>
                         </div>
                         <div class="col-lg-3">
                            <select name="wood_unit" id="wood_unit" class="form-control">
                              <option value="Foot">Foot</option>
                            </select>
                        </div>
                        
                    </div>
                    <div class="col-sm-6">
                        <label>Steel</label>
                            <div class="col-lg-1">
                                <?php echo form_checkbox(['class'=>'check','name'=>'steel_chk','id'=>'steel_chk','value'=>'accept']);?>
                            </div>
                            <div class="col-lg-4">
                              <select name="steel" id="steel" class="form-control">
                                <option>Select Type</option>
                              </select>
                            </div>
                            <div class="col-lg-4">
                              <input type="number" class='form-control' name='steel_quantity' id='steel_quantity' placeholder='Enter Quantity'>
                            </div>
                            <div class="col-lg-3">
                              <select name="steel_unit" id="steel_unit" class="form-control">
                                <option value="KG">KG</option>
                                <option value="Tons">Tons</option>
                              </select>
                            </div>
                      </div>
                  </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                      <div class="col-sm-6">
                          <label>Bricks</label>
                        <div class="col-lg-1">
                          <?php echo form_checkbox(['class'=>'check','name'=>'brick_chk','id'=>'brick_chk','value'=>'accept']);?>
                        </div>
                         <div class="col-lg-4">
                            <select name="brick" id="brick" class="form-control">
                              <option>Select Brick Type</option>
                            </select>
                         </div> 
                          <div class="col-lg-4">
                            <input type="number" class='form-control' name='brick_quantity' id='brick_quantity' placeholder='Enter Quantity'>
                          </div> 
                      </div>
                      <div class="col-sm-6">
                             <label>Tiles</label>
                            <div class="col-lg-1">
                                <?php echo form_checkbox(['class'=>'check','name'=>'tile_chk','id'=>'tile_chk','value'=>'accept']);?>
                            </div> 
                            <div class="col-lg-4">
                                <select name="tile" id="tile" class="form-control">
                                  <option>Select Tile Type</option>
                                </select>
                            </div>
                            <div class="col-lg-4">
                              <input type="number" class='form-control' name='tile_quantity' id='tile_quantity' placeholder='Enter Quantity'>
                            </div>
                              <div class="col-lg-3">
                                  <select name="tile_unit" id="tile_unit" class="form-control">
                                  <option value="Foot">Foot</option>
                                  </select>   
                            </div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                      <div class="col-sm-6">
                        <label>Plastics</label>
                          <div class="col-lg-1">
                            
                            <?php echo form_checkbox(['class'=>'check','name'=>'plastic_chk','id'=>'plastic_chk','value'=>'accept']);?>
                          </div>
                          <div class="col-lg-4">
                            <select name="plastic" id="plastic" class="form-control">
                              <option>Select Plastic Type</option>
                            </select>
                          </div>  
                          <div class="col-lg-4">
                            <input type="number" class='form-control' name='plastic_quantity' id='plastic_quantity' placeholder='Enter Quantity'>
                            </div>
                            <div class="col-lg-3">
                              <select name="plastic_unit" id="plastic_unit" class="form-control">
                              <option value="Foot">Foot</option>
                              </select>   
                          </div>   
                      </div>
                      <div class="col-sm-6">
                         <label>Glass</label>
                          <div class="col-lg-1">
                            
                            <?php echo form_checkbox(['class'=>'check','name'=>'glass_chk','id'=>'glass_chk','value'=>'accept']);?>
                          </div>
                          <div class="col-lg-4">  
                              <select name="glass" id="glass" class="form-control">
                                <option>Select Glass Type</option>
                              </select>
                          </div>
                           <div class="col-lg-4">
                            <input type="number" class='form-control' name='glass_quantity' id='glass_quantity' placeholder='Enter Quantity'>
                            </div>
                            <div class="col-lg-3">
                              <select name="glass_unit" id="glass_unit" class="form-control">
                              <option value="Foot">Foot</option>
                              </select>   
                          </div>   
                      </div>
                      
                    </div>   
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                      <div class="col-sm-6">
                          <label>Concrete</label>
                          <div class="col-lg-1">
                            <?php echo form_checkbox(['class'=>'check','name'=>'concrete_chk','id'=>'concrete_chk','value'=>'accept']);?>
                          </div>
                         <div class="col-lg-4">
                            <select name="concrete" id="concrete" class="form-control">
                              <option>Select Concrete Type</option>
                            </select>
                         </div>   
                           <div class="col-lg-4">
                            <input type="number" class='form-control' name='concrete_quantity' id='concrete_quantity' placeholder='Enter Quantity'>
                            </div>
                            <div class="col-lg-3">
                              <select name="concrete_unit" id="concrete_unit" class="form-control">
                              <option value="Trawly">Trawly</option>
                              </select>   
                          </div>    
                      </div>
                      <div class="col-sm-6">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-5"></div>
                        <div class="col-lg-5"></div>
                      </div>
                        
                    </div>
                </div>
            </div>
            <div class="form-actions form-group">
                <?php echo form_submit(['type'=>'submit','class'=>'btn btn-success btn-sm'
                 ,'value'=>'Submit Request']); ?>
            </div>
        <?php echo form_close();?>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script type="text/javascript">

$(document).ready(function(){
 
  document.getElementById('cement').style.visibility = 'hidden';
  document.getElementById('sand').style.visibility = 'hidden';
  document.getElementById('wood').style.visibility = 'hidden';
  document.getElementById('steel').style.visibility = 'hidden';
  document.getElementById('brick').style.visibility = 'hidden';
  document.getElementById('tile').style.visibility = 'hidden';
  document.getElementById('plastic').style.visibility = 'hidden';
  document.getElementById('glass').style.visibility = 'hidden';
  document.getElementById('concrete').style.visibility = 'hidden';

  document.getElementById('cement_unit').style.visibility = 'hidden';
  document.getElementById('sand_unit').style.visibility = 'hidden';
  document.getElementById('wood_unit').style.visibility = 'hidden';
  document.getElementById('steel_unit').style.visibility = 'hidden';
  document.getElementById('tile_unit').style.visibility = 'hidden';
  document.getElementById('plastic_unit').style.visibility = 'hidden';
  document.getElementById('glass_unit').style.visibility = 'hidden';
  document.getElementById('concrete_unit').style.visibility = 'hidden';

  document.getElementById('cement_quantity').style.visibility = 'hidden';
  document.getElementById('sand_quantity').style.visibility = 'hidden';
  document.getElementById('wood_quantity').style.visibility = 'hidden';
  document.getElementById('steel_quantity').style.visibility = 'hidden';
  document.getElementById('brick_quantity').style.visibility = 'hidden';
  document.getElementById('tile_quantity').style.visibility = 'hidden';
  document.getElementById('plastic_quantity').style.visibility = 'hidden';
  document.getElementById('glass_quantity').style.visibility = 'hidden';
  document.getElementById('concrete_quantity').style.visibility = 'hidden';
  // Type change
        $('#cement_chk').click(function(){
          var material_id = 1;

            if($(this).prop("checked") == true){
              document.getElementById('cement').style.visibility = 'visible';
              document.getElementById('cement_unit').style.visibility = 'visible';
              document.getElementById('cement_quantity').style.visibility = 'visible';
               $.ajax({

                        url:'<?php echo base_url('Material/getMaterialType');?>',
                        method: 'post',
                        data: {material_id: material_id},
                        dataType: 'json',
                        success: function(response){
                              document.getElementById('cement').style.visibility = 'visible';
                              document.getElementById('cement_unit').style.visibility = 'visible';
                              document.getElementById('cement_quantity').style.visibility = 'visible';
                      
                          // Remove options 
                        
                          $('#cement').find('option').not(':first').remove();

                          // Add options
                          $.each(response,function(index,data){
                             $('#cement').append('<option value="'+data['type_name']+'">'+data['type_name']+'</option>');
                          
                          });
                        }
                     });
            }
            else if($(this).prop("checked") == false){
                document.getElementById('cement').style.visibility = "hidden";
                document.getElementById('cement_unit').style.visibility = "hidden";
                document.getElementById('cement_quantity').style.visibility = "hidden";
            }
        });
        $('#sand_chk').click(function(){
          var material_id = 2;

            if($(this).prop("checked") == true){
              document.getElementById('sand').style.visibility = 'visible';
              document.getElementById('sand_unit').style.visibility = 'visible';
              document.getElementById('sand_quantity').style.visibility = 'visible';
               $.ajax({

                        url:'<?php echo base_url('Material/getMaterialType');?>',
                        method: 'post',
                        data: {material_id: material_id},
                        dataType: 'json',
                        success: function(response){
                              document.getElementById('sand').style.visibility = 'visible';
                              document.getElementById('sand_unit').style.visibility = 'visible';
                              document.getElementById('sand_quantity').style.visibility = 'visible';
                      
                          // Remove options 
                        
                          $('#sand').find('option').not(':first').remove();

                          // Add options
                          $.each(response,function(index,data){
                             $('#sand').append('<option value="'+data['type_name']+'">'+data['type_name']+'</option>');
                          
                          });
                        }
                     });
            }
            else if($(this).prop("checked") == false){
                document.getElementById('sand').style.visibility = "hidden";
                document.getElementById('sand_unit').style.visibility = "hidden";
                document.getElementById('sand_quantity').style.visibility = "hidden";
            }
        });
        $('#wood_chk').click(function(){
          var material_id = 3;

            if($(this).prop("checked") == true){
              document.getElementById('wood').style.visibility = 'visible';
              document.getElementById('wood_unit').style.visibility = 'visible';
              document.getElementById('wood_quantity').style.visibility = 'visible';
               $.ajax({

                        url:'<?php echo base_url('Material/getMaterialType');?>',
                        method: 'post',
                        data: {material_id: material_id},
                        dataType: 'json',
                        success: function(response){
                              document.getElementById('wood').style.visibility = 'visible';
                              document.getElementById('wood_unit').style.visibility = 'visible';
                              document.getElementById('wood_quantity').style.visibility = 'visible';
                      
                          // Remove options 
                        
                          $('#wood').find('option').not(':first').remove();

                          // Add options
                          $.each(response,function(index,data){
                             $('#wood').append('<option value="'+data['type_name']+'">'+data['type_name']+'</option>');
                          
                          });
                        }
                     });
            }
            else if($(this).prop("checked") == false){
                document.getElementById('wood').style.visibility = "hidden";
                document.getElementById('wood_unit').style.visibility = "hidden";
                document.getElementById('wood_quantity').style.visibility = "hidden";
            }
        });
        $('#steel_chk').click(function(){
          var material_id = 4;

            if($(this).prop("checked") == true){
              document.getElementById('steel').style.visibility = 'visible';
              document.getElementById('steel_unit').style.visibility = 'visible';
              document.getElementById('steel_quantity').style.visibility = 'visible';
               $.ajax({

                        url:'<?php echo base_url('Material/getMaterialType');?>',
                        method: 'post',
                        data: {material_id: material_id},
                        dataType: 'json',
                        success: function(response){
                              document.getElementById('steel').style.visibility = 'visible';
                              document.getElementById('steel_unit').style.visibility = 'visible';
                              document.getElementById('steel_quantity').style.visibility = 'visible';
                      
                          // Remove options 
                        
                          $('#steel').find('option').not(':first').remove();

                          // Add options
                          $.each(response,function(index,data){
                             $('#steel').append('<option value="'+data['type_name']+'">'+data['type_name']+'</option>');
                          
                          });
                        }
                     });
            }
            else if($(this).prop("checked") == false){
                document.getElementById('steel').style.visibility = "hidden";
                document.getElementById('steel_unit').style.visibility = "hidden";
                document.getElementById('steel_quantity').style.visibility = "hidden";
            }
        });
        $('#brick_chk').click(function(){
          var material_id = 5;

            if($(this).prop("checked") == true){
              document.getElementById('brick').style.visibility = 'visible';
              document.getElementById('brick_quantity').style.visibility = 'visible';
               $.ajax({

                        url:'<?php echo base_url('Material/getMaterialType');?>',
                        method: 'post',
                        data: {material_id: material_id},
                        dataType: 'json',
                        success: function(response){
                              document.getElementById('brick').style.visibility = 'visible';
                              document.getElementById('brick_quantity').style.visibility = 'visible';
                      
                          // Remove options 
                        
                          $('#brick').find('option').not(':first').remove();

                          // Add options
                          $.each(response,function(index,data){
                             $('#brick').append('<option value="'+data['type_name']+'">'+data['type_name']+'</option>');
                          
                          });
                        }
                     });
            }
            else if($(this).prop("checked") == false){
                document.getElementById('brick').style.visibility = "hidden";
                document.getElementById('brick_quantity').style.visibility = "hidden";
            }
        });
        $('#tile_chk').click(function(){
          var material_id = 6;

            if($(this).prop("checked") == true){
              document.getElementById('tile').style.visibility = 'visible';
              document.getElementById('tile_unit').style.visibility = 'visible';
              document.getElementById('tile_quantity').style.visibility = 'visible';
               $.ajax({

                        url:'<?php echo base_url('Material/getMaterialType');?>',
                        method: 'post',
                        data: {material_id: material_id},
                        dataType: 'json',
                        success: function(response){
                              document.getElementById('tile').style.visibility = 'visible';
                              document.getElementById('tile_unit').style.visibility = 'visible';
                              document.getElementById('tile_quantity').style.visibility = 'visible';
                      
                          // Remove options 
                        
                          $('#tile').find('option').not(':first').remove();

                          // Add options
                          $.each(response,function(index,data){
                             $('#tile').append('<option value="'+data['type_name']+'">'+data['type_name']+'</option>');
                          
                          });
                        }
                     });
            }
            else if($(this).prop("checked") == false){
                document.getElementById('tile').style.visibility = "hidden";
                document.getElementById('tile_unit').style.visibility = "hidden";
                document.getElementById('tile_quantity').style.visibility = "hidden";
            }
        });
        $('#plastic_chk').click(function(){
          var material_id = 7;

            if($(this).prop("checked") == true){
              document.getElementById('plastic').style.visibility = 'visible';
              document.getElementById('plastic_unit').style.visibility = 'visible';
              document.getElementById('plastic_quantity').style.visibility = 'visible';
               $.ajax({

                        url:'<?php echo base_url('Material/getMaterialType');?>',
                        method: 'post',
                        data: {material_id: material_id},
                        dataType: 'json',
                        success: function(response){
                              document.getElementById('plastic').style.visibility = 'visible';
                              document.getElementById('plastic_unit').style.visibility = 'visible';
                              document.getElementById('plastic_quantity').style.visibility = 'visible';
                      
                          // Remove options 
                        
                          $('#plastic').find('option').not(':first').remove();

                          // Add options
                          $.each(response,function(index,data){
                             $('#plastic').append('<option value="'+data['type_name']+'">'+data['type_name']+'</option>');
                          
                          });
                        }
                     });
            }
            else if($(this).prop("checked") == false){
                document.getElementById('plastic').style.visibility = "hidden";
                document.getElementById('plastic_unit').style.visibility = "hidden";
                document.getElementById('plastic_quantity').style.visibility = "hidden";
            }
        });
        $('#glass_chk').click(function(){
          var material_id = 8;

            if($(this).prop("checked") == true){
              document.getElementById('glass').style.visibility = 'visible';
              document.getElementById('glass_unit').style.visibility = 'visible';
              document.getElementById('glass_quantity').style.visibility = 'visible';
               $.ajax({

                        url:'<?php echo base_url('Material/getMaterialType');?>',
                        method: 'post',
                        data: {material_id: material_id},
                        dataType: 'json',
                        success: function(response){
                              document.getElementById('glass').style.visibility = 'visible';
                              document.getElementById('glass_unit').style.visibility = 'visible';
                              document.getElementById('glass_quantity').style.visibility = 'visible';
                      
                          // Remove options 
                        
                          $('#glass').find('option').not(':first').remove();

                          // Add options
                          $.each(response,function(index,data){
                             $('#glass').append('<option value="'+data['type_name']+'">'+data['type_name']+'</option>');
                          
                          });
                        }
                     });
            }
            else if($(this).prop("checked") == false){
                document.getElementById('glass').style.visibility = "hidden";
                document.getElementById('glass_unit').style.visibility = "hidden";
                document.getElementById('glass_quantity').style.visibility = "hidden";
            }
        });
        $('#concrete_chk').click(function(){
          var material_id = 9;

            if($(this).prop("checked") == true){
              document.getElementById('concrete').style.visibility = 'visible';
              document.getElementById('concrete_unit').style.visibility = 'visible';
              document.getElementById('concrete_quantity').style.visibility = 'visible';
               $.ajax({

                        url:'<?php echo base_url('Material/getMaterialType');?>',
                        method: 'post',
                        data: {material_id: material_id},
                        dataType: 'json',
                        success: function(response){
                              document.getElementById('concrete').style.visibility = 'visible';
                              document.getElementById('concrete_unit').style.visibility = 'visible';
                              document.getElementById('concrete_quantity').style.visibility = 'visible';
                      
                          // Remove options 
                        
                          $('#concrete').find('option').not(':first').remove();

                          // Add options
                          $.each(response,function(index,data){
                             $('#concrete').append('<option value="'+data['type_name']+'">'+data['type_name']+'</option>');
                          
                          });
                        }
                     });
            }
            else if($(this).prop("checked") == false){
                document.getElementById('concrete').style.visibility = "hidden";
                document.getElementById('concrete_unit').style.visibility = "hidden";
                document.getElementById('concrete_quantity').style.visibility = "hidden";
            }
        });
   

    
});
</script>