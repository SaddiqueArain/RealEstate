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
                                <h4>Messages</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                         <?php if($msg = $this->session->flashdata('Reply_Success')):
                            $msg_class = $this->session->flashdata('msg_class')?>
                        <div class="alert <?php echo $msg_class ?>">
                            <?php echo $msg; ?>
                        </div>
                        <?php endif;?>
                         <?php if($msg = $this->session->flashdata('Reply_Failed')):
                            $msg_class = $this->session->flashdata('msg_class')?>
                        <div class="alert <?php echo $msg_class ?>">
                            <?php echo $msg; ?>
                        </div>
                        <?php endif;?>
                            <?php if($msg = $this->session->flashdata('Approve_Success')):
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
                    </div>
                    <div class="col-sm-4">
                        <div class="float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Messages</a></li>
                                    <li class="active">List</li>
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
                    <h4>Messages</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 box-body table-responsive no-padding">
                    <table class="table table-hover table-striped" style=" text-align:center;margin-top:3px;border:1px solid black;
                    border-radius:6px !important;border-collapse: separate; ">
                        <thead  style="border-top:1px dashed black;">
                            <tr>
                                <th>Contact_Us ID</th>
                                <th >Full Name</th>
                                <th >Email</th>
                                <th >Contact No</th>
                                <th >Subject</th>
                                <th >Date_Time</th>
                                <th colspan="2" style="text-align:center;">Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($message as $row): ?>
                                <tr scope="row">
                                    <td><?php echo $row['contact_us_id'];?></td>
                                    <td><?php echo $row['full_name'];?></td>
                                    <td><?php echo $row['email'];?></td>
                                    <td><?php echo $row['contact_number'];?></td>
                                    <td><?php echo $row['subject'];?></td>
                                    <td><?php echo $row['date_time'];?></td>
                                    <td><button class="dis btn btn-danger btn-sm glyphicon glyphicon-trash" data-user="<?php echo $row['contact_us_id'];?>"></button></td>
                                                                        <td>
                                       <?php echo form_open('Admin/view_message'); ?>
                                        <?php echo form_hidden('contact_us_id',$row['contact_us_id']);?>
                                        <button type="submit" class="cat_property btn btn-outline-primary btn-sm"><i class="fa fa-eye"></i>
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
                <div class="col-sm-3" style="float:right;"><?php echo $this->pagination->create_links() ?></div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
 <script type="text/javascript">
$(document).ready(function(){
    $('.dis').click(function(event)
    {
        event.preventDefault();
            var url = "<?php echo base_url('Admin/delete_message');?>";
            var contact_us_id = $(this).data('user');
            var data = {contact_us_id:contact_us_id};
            $.post(url,data,function(response)
            {

                setTimeout(function(){
                    window.location.reload();

                    }, 0)
            });         
    });
   
});
</script>