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
                                <h4>Request</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
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
                                    <li><a href="#">Request</a></li>
                                    <li><a href="#">Booking</a></li>
                                    <li class="active">Approvals</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content container-fluid"  style="margin-top:-30px;">
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <h4>Booking Approvals</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 box-body table-responsive no-padding">
                    <table class="table table-hover table-striped" style=" text-align: center; margin-top:2px;border:1px solid black;
                    border-radius:6px !important;border-collapse: separate; ">
                        <thead  style="border-top:1px dashed black;">
                            <tr>
                                <th >Booking ID</th>
                                <th >Property Name</th>
                                <th >Buyer Name</th>
                                <th >Seller Name</th>
                                <th >Broker Name</th>
                                <th colspan="2" style="text-align:center;">Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($approvals as $row): ?>
                            <?php $seller_id = $row['seller_id']; ?>
                            <?php $broker_id = $row['broker_id']; ?>
                                <tr scope="row">
                                    <td><?php echo $row['book_id'];?></td>
                                    <td><?php echo $row['prop_name'];?></td>
                                    <td><?php echo $row['full_name'];?></td>
                                    <?php foreach($seller as $row2):?>
                                        <?php
                                            if ($seller_id==$row2['uid'])
                                            { 
                                            ?>
                                                <td><?php echo $row2['full_name'];?></td>

                                            <?php } ?>
                                        <?php endforeach;?>
                                    <td>
                                        <?php foreach($broker as $row3):
                                        
                                            if ($broker_id==$row3['uid'])
                                            { 
                                            ?>
                                                <?php echo $row3['full_name'];?>

                                        <?php }endforeach;?>
                                        </td>
                                    <td>
                                        <?php echo form_open('Payment/addpayment');?>
                                        <?php echo form_hidden('book_id',$row['book_id']);?>
                                        <?php echo form_hidden('propid',$row['propid']);?>
                                        <button type="submit" class="app btn btn-success">Approve</button>
                                        <?php echo form_close();?>
                                    </td>
                                    <td> <?php echo form_open('Admin/rejected_booking');?>
                                        <?php echo form_hidden('book_id',$row['book_id']);?>
                                        <?php echo form_hidden('propid',$row['propid']);?>
                                        <button type="submit" class="dis btn btn-danger">Disapprove</button>
                                        <?php echo form_close();?>
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
 