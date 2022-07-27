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
                                <h4>Message Details</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
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
                    <table class="table table-responsive table-bordered  table-hover table-striped" style="text-align: center;border:1px solid black; border-radius:6px !important;border-collapse: collapse;"  >
                        <thead >
                          <tr>
                                <th>Contact_Us ID</th>
                                <th >Subject</th>
                            </tr>
                       
                            <tr >
                                <td><?php echo $messages->contact_us_id;?></td>
                                <td><?php echo $messages->subject;?></td>
                            </tr>
                        </thead>
                    </table>
                    <table class="table table-responsive table-bordered table-hover table-striped">
                        <thead>
                        	<tr>
                                <th style="box-sizing: fixed;width: 180px;vertical-align:top">Message</th>
                            </tr>
                            <tr>
                              <td ><p style="border-style: none; text-align: left; text-align: justify;text-justify: inter-word;"><?php echo $messages->message;?></p>
                                <br>
                                    <div style="float: right;">
                                        <button onclick="reply_message()" class="cat_property btn btn-outline-primary btn-sm" id="btnreply"><i class="fa fa-reply"></i> <b>reply</b>
                                            </button>

                                    </div>
                                   
                                    <div id="reply">
                                        <?php echo form_open('Admin/reply_message'); ?>
                                        <?php echo form_hidden('contact_us_id',$messages->contact_us_id);?>
                                        <?php echo form_hidden('email',$messages->email);?>
                                        <?php echo form_hidden('subject',$messages->subject);?>
                                        <?php echo form_textarea(['class'=>'form-control','placeholder'=>'Write your reply here','name'=>'reply','value'=>set_value('reply'),'style'=>'height:100px;'])?>
                                        <br>
                                        <button type="submit" class="btn btn-success" style="float: right"><i class="fa fa-paper-plane"></i> 
                                            </button>
                                        <?php echo form_close(); ?>
                                    </div>
                    
                              </td>    
                            </tr>
                        </thead>
                    </table>
                    <br>
                </div>
            </div>
           
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
 <script type="text/javascript">
      document.getElementById("reply").style.display = 'none';
    function reply_message()
    {
        
         document.getElementById("btnreply").style.visibility = 'hidden';
         document.getElementById("reply").style.display = 'block';
    }
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
