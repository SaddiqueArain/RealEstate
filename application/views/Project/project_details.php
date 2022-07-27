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
                                <h4>Project Details</h4>
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
                                    <li><a href="#">Project</a></li>
                                    <li class="active">Details</li>
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
                <div class="col-sm-12 box-body table-responsive no-padding">
                    <table class="table table-hover table-striped" style="margin-top:2px;border:1px solid black;
                        border-radius:6px !important;border-collapse: separate; ">
                        <thead  style="border-top:1px dashed black;">
                            <tr>
                                <th style="text-align: left;">Project ID</th>
                                <th style="text-align: left;">Project Title</th>
                                <th style="text-align: left;">Project Type</th>
                                <th style="text-align: left;">Price</th>
                                <th style="text-align: left;">Location</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr scope="row">
                            
                                    <td><?php echo $project->project_id;?></td>
                                    <td><?php echo $project->project_title;?></td>
                                    <td><?php echo $project->type_name;?></td>
                                    <td><?php echo $project->price;?></td>
                                    <td><?php echo $project->location." ". $project->city ;?></td>
                               
                            </tr> 
                        </tbody>
                    </table>
                    <table class="table table-responsive table-bordered table-hover table-striped"  >
                        <thead >
                            <tr>
                                <th >Project Files</th>
                               <?php  $c=0; $cc=0; $dd=0; ?>
                                <?php foreach($files as $row): ?>
                                   <?php  $c++; ?>
                                    <td><object data="<?php echo $row['file_path_link'];?>" type="application/docx"><a href="<?php echo $row['file_path_link'];?>" download="<?php echo $row['file_name'];?>"><?php echo $row['file_name'].' download';?></a></object>
                                        <button data-project="<?php echo $row['file_id']; ?>" data-user="<?php echo $row['file_id']; ?>" type="button" class="del_file btn btn-danger btn-sm glyphicon glyphicon-trash">
                                        </button></td>
                                <?php endforeach;?>
                                
                            </tr>
                            <tr>
                                <th>Working Engineers</th>
                                <?php foreach ($engineer as $row): ?>
                                    <?php  $cc++; ?>
                                 <td><?php echo $row['full_name']." "; ?>
                                 <button data-project="<?php echo $row['project_eng_id']; ?>" data-user="<?php echo $row['project_eng_id']; ?>" type="button" class="del_engineer btn btn-danger btn-sm glyphicon glyphicon-trash">
                                        </button></td>
                                <?php endforeach; ?>
                            </tr>
                            <?php if($c>$cc)
                                  {
                                    $dd = $c;
                                  }
                                  else
                                  {
                                    $dd = $cc;
                                  }
                             ?>
                            <tr>
                                <th style="box-sizing: fixed;width: 180px;vertical-align:top">Project Description</th>
                                 <td colspan="<?php echo $dd; ?>" ><p style="text-align: left; text-align: justify;text-justify: inter-word;"><?php echo $project->project_description;?></p></td>
                            </tr>
                        </thead>
                        <tbody>
                            
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
    $('.del_file').click(function(event)
    {
            event.preventDefault();
            var url = "<?php echo base_url('Project/delete_project_file'); ?>";
            var file_id = $(this).data('project');
            var data = {file_id:file_id};
            $.post(url,data,function(response)
            {
                setTimeout(function(){
                    window.location.reload();

                    }, 0)
            });
    });
    $('.del_engineer').click(function(event)
    {
            event.preventDefault();
            var url = "<?php echo base_url('Project/delete_project_engineer'); ?>";
            var project_eng_id = $(this).data('project');
            var data = {project_eng_id:project_eng_id};
            $.post(url,data,function(response)
            {
                setTimeout(function(){
                    window.location.reload();

                    }, 0)
            });
    });
  
});
  </script>