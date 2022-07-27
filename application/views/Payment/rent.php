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
                                <h4>Payment</h4>
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
                                    <li><a href="#">Payment</a></li>
                                    <li><a href="#">Rent</a></li>
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
            <div class="animated fadeIn">
                 <div class="">
                     <div class="card-header">
                        <a href="<?php echo base_url('Payment/addrent');?>"><?php echo form_submit(['type'=>'submit','class'=>'btn btn-info btn-md'
                            ,'value'=>'Add Rent']); ?>
                        </a>
                    </div>
                    <div class="col-sm-12 box-body table-responsive no-padding">
                        <table class="table table-hover table-striped" style="text-align:center; margin-top:2px;border:1px solid black;
                        border-radius:6px !important;border-collapse: separate; ">
                            <thead style="border-top:1px dashed black;">
                                <tr>
                                    <th style="text-align:center;">Payment ID</th>
                                    <th >Booking ID</th>
                                    <th >Rent ID</th>
                                    <th >Rent amount</th>
                                    <th >Rent Date</th>
                                    <th colspan="2" style="text-align:center;">Operation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($rent as $row): ?>
                                    <tr scope="row">
                                        <td><?php echo $row['pay_id'];?></td>
                                        <td><?php echo $row['book_id'];?></td>
                                        <td><?php echo $row['rent_id'];?></td>
                                        <td><?php echo $row['rent_amount'];?></td>
                                        <td><?php echo $row['rent_date'];?></td>
                                        <td>
                                        <?php echo form_open('Payment/delete_rent');
                                    echo form_hidden('rent_id',$row['rent_id']);?>
                                            <button type="submit" class="del_installment btn btn-danger btn-sm glyphicon glyphicon-trash">
                                            </button>
                                            <?php echo form_close();?>
                                        </td>
                                        <td>
                                        <?php echo form_open('Payment/edit_rent'); ?>
                                <?php echo form_hidden('rent_id',$row['rent_id']);?>
                                <?php echo form_hidden('pay_id',$row['pay_id']);?>
                                                <button type="submit" class="update_booking btn btn-info btn-sm    glyphicon glyphicon-pencil">
                                                </button>
                                            <?php echo form_close(); ?>
                                            
                                        </td>
                                        </td>          
                                    </tr>
                                <?php endforeach; ?> 
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3"style="float:right;"><?php echo $this->pagination->create_links() ?></div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
