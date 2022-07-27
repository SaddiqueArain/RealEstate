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
                                    <li><a href="#">Material Request</a></li>
                                    <li class="active">Demand</li>
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
                    <h4>Material Request</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 box-body table-responsive no-padding">
                    <table class="table table-hover table-striped"style="text-align:center; margin-top:2px;border:1px solid black;
                    border-radius:6px !important;border-collapse: separate; ">
                        <thead  style="border-top:1px dashed black;">
                            <tr>
                                <th >Demand ID</th>
                                <th >Full Name</th>
                                <th >Wood</th>
                                <th >Cement</th>
                                <th >Sand</th>
                                <th >Steel</th>
                                <th >Bricks</th>
                                <th >Tiles</th>
                                <th >Plastic</th>
                                <th >Glass</th>
                                <th >Concrete</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($demand as $row): ?>
                                <tr scope="row">
                                    <td><?php echo $row['demand_id'];?></td>
                                    <td><?php echo $row['full_name'];?></td>
                                    <td><?php echo $row['wood'];echo "  ";echo $row['wood_quantity'];?></td>
                                    <td><?php echo $row['cement'];echo "  ";echo $row['cement_quantity'];?></td>
                                    <td><?php echo $row['sand'];echo "  ";echo $row['sand_quantity'];?></td>
                                    <td><?php echo $row['steel'];echo "  ";echo $row['steel_quantity'];?></td>
                                    <td><?php echo $row['bricks'];echo "  ";echo $row['bricks_quantity'];?></td>
                                    <td><?php echo $row['tiles'];echo "  ";echo $row['tiles_quantity'];?></td>
                                    <td><?php echo $row['plastic'];echo "  ";echo $row['plastic_quantity'];?></td>
                                    <td><?php echo $row['glass'];echo "  ";echo $row['glass_quantity'];?></td>
                                    <td><?php echo $row['concrete'];echo "  ";echo $row['concrete_quantity'];?></td>
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
 