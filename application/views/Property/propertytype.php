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
                              <h4>Property Type</h4>
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
                    <?php if($msg = $this->session->flashdata('Delete_Success')):
                        $msg_class = $this->session->flashdata('msg_class')?>
                        <div class="alert <?php echo $msg_class ?>">
                            <?php echo $msg; ?>
                        </div>
                        <?php endif;?>
                    <?php if($msg = $this->session->flashdata('Delete_Failed')):
                        $msg_class = $this->session->flashdata('msg_class')?>
                        <div class="alert <?php echo $msg_class ?>">
                            <?php echo $msg; ?>
                        </div>
                        <?php endif;?>
                    <?php if($msg = $this->session->flashdata('Update_Success')):
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
                                <li><a href="#">Property</a></li>
                                <li><a href="#">Property Type</a></li>
                                    <li><a href="#">Type</a></li>
                                    <li class="active">Display</li>
                            </ol>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
    </section>
    <!-- Main content -->
    <section class="content container-fluid"style="margin-top:-30px;">
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <a href="<?php echo base_url('Property/insert_property_type');?>"><?php echo form_submit(['type'=>'submit','class'=>'btn btn-info btn-md'
                        ,'value'=>'Add Property Type']); ?>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 box-body table-responsive no-padding">
                    <table class="table table-striped"style="text-align:center; margin-top:2px;border:1px solid black;
                                border-radius:6px !important;border-collapse: separate; ">
                        <thead>
                            <tr>
                                <th scope="col" >Property Type ID</th>
                                <th scope="col">Property Type</th>
                                <th colspan="2" scope="col">Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($details as $row): ?>
                                <tr scope="row">
                                    <td><?php echo $row['prop_type_id'];?></td>
                                    <td><?php echo $row['prop_type'];?></td>
                                    <td>
                                        <button data-property-type="<?php echo $row['prop_type_id']; ?>" data-user="<?php echo $row['prop_type_id']; ?>"type="button" class="del_property_type btn btn-danger btn-sm glyphicon glyphicon-trash">
                                        </button>
                                    </td>
                                    <td>
                                        <?php echo form_open('Property/edit_property_type'); ?>
                                        <?php echo form_hidden('prop_type_id',$row['prop_type_id']);?>
                                            <button type="submit" class="update_property btn btn-info btn-sm    glyphicon glyphicon-pencil">
                                            </button>
                                        <?php echo form_close(); ?>
                                    </td>          
                                </tr>
                            <?php endforeach; ?> 
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
               
                <div class="col-sm-3"style="float:right;"><?php echo $this->pagination->create_links() ?></div>
            </div>
        </div>    
    </section>
</div>
       
<script type="text/javascript">
$(document).ready(function(){
    $('.del_property_type').click(function(event)
    {
            event.preventDefault();
            var url = "<?php echo base_url('Property/delete_property_type'); ?>";
            var property_type_id = $(this).data('property-type');
            var data = {prop_type_id:property_type_id};
            $.post(url,data,function(response)
            {
                setTimeout(function(){
                    window.location.reload();

                    }, 0)
            });
    });
});

</script>