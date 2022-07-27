<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-image: url('<?php echo base_url('assets/back.jpg');?>')!important ;">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="margin-bottom:-15px;">
        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header ">
                            <div class="page-title">
                                <h4>Projects</h4>
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
                        <div class="float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="#">Projects</a></li>
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
    <section class="content container-fluid" style="margin-top:-30px;">
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <a href="<?php echo base_url('Project/addproject');?>"><?php echo form_submit(['type'=>'submit','class'=>'btn btn-info btn-md'
                        ,'value'=>'Add Project']); ?>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 box-body table-responsive no-padding">
                    <table class="table table-hover table-striped" style="text-align:center; margin-top:2px;border:1px solid black;
                        border-radius:6px !important;border-collapse: separate; ">
                        <thead  style="border-top:1px dashed black;">
                            <tr>
                                <th >Project ID</th>
                                <th >Project Title</th>
                                <th >Project Status</th>
                                <th >Starting Date</th>
                                <th >Completion Date</th>
                                <th >Owner Name</th>
                                <th >Project Pic</th>
                                <th colspan="3" style="text-align:center;">Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($details as $row): ?>
                                <tr scope="row">
                                    <td><?php echo $row['project_id'];?></td>
                                    <td><?php echo $row['project_title'];?></td>
                                    <td><?php echo $row['status'];?></td>
                                    <td><?php echo $row['starting_date'];?></td>
                                    <td><?php if($row['completion_date']==="-1")
                                                { 
                                                    echo $row['status'];
                                                } 
                                                else
                                                {
                                                    echo $row['completion_date'];
                                                }
                                                ?>
                                    </td>
                                    <td><?php echo $row['full_name'];?></td>
                                    <td><a  href="<?php echo $row['proj_img_link'];?>" class="fancybox"><img src="<?php echo $row['proj_img_link'];?>" style="width:50px;height:50px;"></a></td>
                                    <td>
                                        <button data-project="<?php echo $row['project_id']; ?>" data-user="<?php echo $row['project_id']; ?>" type="button" class="del_project btn btn-danger btn-sm glyphicon glyphicon-trash">
                                        </button>
                                    </td>
                                    <td>
                                        <?php echo form_open('Project/edit_project'); ?>
                                        <?php echo form_hidden('project_id',$row['project_id']);?>
                                            <button type="submit" class="update_property btn btn-info btn-sm    glyphicon glyphicon-pencil">
                                            </button>
                                        <?php echo form_close(); ?>
                                        
                                    </td>
                                    <td>
                                        <?php echo form_open('Project/project_details'); ?>
                                        <?php echo form_hidden('project_id',$row['project_id']);?>
                                        <button type="submit" class="cat_property btn btn-outline-primary btn-sm"><i class="fa fa-eye"></i>
                                        </button>
                                         <?php echo form_close(); ?>
                                    </td>          
                                </tr>
                            <?php endforeach; ?> 
                        </tbody>
                    </table>
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog" style="overflow-y: scroll;">
                        <!-- Modal content-->
                            <div class="modal-content" >
                                <div class="modal-body" style="overflow-x: scroll;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3" style="float:right;"><?php echo $this->pagination->create_links() ?></div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">

$(document).ready(function(){
    $('.del_project').click(function(event)
    {
            event.preventDefault();
            var url = "<?php echo base_url('Project/delete_project'); ?>";
            var project_id = $(this).data('project');
            var data = {project_id:project_id};
            $.post(url,data,function(response)
            {
                setTimeout(function(){
                    window.location.reload();

                    }, 0)
            });
    });

  
});
/*function loadUrl(newLocation)
{
  window.location.href = newLocation;
}*/
</script>
