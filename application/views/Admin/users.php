<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-image: url('<?php echo base_url('assets/back.jpg');?>')!important ;">
                            
    <!-- Content Header (Page header) -->
    <section class="content-header" >
        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header ">
                            <div class="page-title">
                                <h4>Users</h4>
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
                        <?php if($msg = $this->session->flashdata('Update_Success')):
                            $msg_class = $this->session->flashdata('msg_class')?>
                        <div class="alert <?php echo $msg_class ?>">
                            <?php echo $msg; ?>
                        </div>
                        <?php endif;?>
                         <?php if($msg = $this->session->flashdata('Update_Failed')):
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
                          <?php if($msg = $this->session->flashdata('Reject_Success')):
                            $msg_class = $this->session->flashdata('msg_class')?>
                        <div class="alert <?php echo $msg_class ?>">
                            <?php echo $msg; ?>
                        </div>
                          <?php endif;?>
                          <?php if($msg = $this->session->flashdata('Approve_Failed')):
                            $msg_class = $this->session->flashdata('msg_class')?>
                        <div class="alert <?php echo $msg_class ?>">
                            <?php echo $msg; ?>
                        </div>
                            <?php endif;?>
                          <?php if($msg = $this->session->flashdata('Reject_Failed')):
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
                                    <li><a href="#">Users</a></li>
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
                    <a href="<?php echo base_url('Admin/adduser');?>"><?php echo form_submit(['type'=>'submit','class'=>'btn btn-info btn-md'
                        ,'value'=>'Add User']); ?>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 box-body table-responsive no-padding">
                    <table class="table table-hover table-striped" style=" text-align:center;margin-top:3px;border:1px solid black;
                    border-radius:6px !important;border-collapse: separate; ">
                        <thead  style="border-top:1px dashed black;">
                            <tr>
                                <th>User ID</th>
                                <th >User Name</th>
                                <th >User Type</th>
                                <th >Full Name</th>
                                <th >Email</th>
                                <th >Contact No</th>
                                <th >Profile Image</th>
                                <th >Address</th>
                                <th colspan="2" style="text-align:center;">Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($user as $row): ?>
                                <tr scope="row">
                                    <td><?php echo $row['uid'];?></td>
                                    <td><?php echo $row['user_name'];?></td>
                                    <td><?php echo $row['user_type'];?></td>
                                    <td><?php echo $row['full_name'];?></td>
                                    <td><?php echo $row['email'];?></td>
                                    <td><?php echo $row['contact_no'];?></td>
                                    <td><a  href="<?php echo $row['prof_img_link'];?>" class="fancybox"><img src="<?php echo $row['prof_img_link'];?>" style="width:50px;height:50px;"></a></td>
                                    <td><?php echo $row['address'];?></td>
                                    <td><button class="dis btn btn-danger btn-sm glyphicon glyphicon-trash" data-user="<?php echo $row['uid'];?>"></button></td>
                                    <td>
                                        <?php echo form_open('Admin/edit_user'); ?>
                                        <?php echo form_hidden('uid',$row['uid']);?>
                                            <button type="submit" class="update_property btn btn-info btn-sm glyphicon glyphicon-pencil">
                                            </button>
                                        <?php echo form_close(); ?>
                                        
                                    </td>
                                    
                                </tr>
                            <?php endforeach; ?> 
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row" >
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
            var url = "<?php echo base_url('Admin/rejected_user');?>";
            var user_id = $(this).data('user');
            var data = {uid:user_id};
            $.post(url,data,function(response)
            {

                setTimeout(function(){
                    window.location.reload();

                    }, 0)
            });         
    });
   
});
</script>