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
                                    <li><a href="#">Buyer</a></li>
                                    <li><a href="#">Payment</a></li>
                                    <li class="active">History</li>
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
            <div class="animated fadeIn">
                 <div class="">
                    <div class="card-header">
                        <h4>Payment History</h4>
                    </div>
                    <div class="col-sm-12 box-body table-responsive no-padding">
                        <table class="table table-hover table-striped" style="text-align:center; margin-top:2px;border:1px solid black;
                        border-radius:6px !important;border-collapse: separate; ">
                            <thead  style="border-top:1px dashed black;">
                                <tr>
                                    <th style="text-align:center;">Payment ID</th>
                                    <th style="text-align:center;">Payment Method</th>
                                    <th style="text-align:center;">Payment Type</th>
                                    <th style="text-align:center;">Downpayment</th>
                                    <th style="text-align:center;">Total Amount Paid</th>
                                    <th style="text-align:center;">Remaining Amount</th>
                                    <th style="text-align:center;">Booking ID</th>
                                    <th style="text-align:center;">Property ID</th>
                                    <th style="text-align:center;">SELLER ID</th>
                                    <th style="text-align:center;">BUYER ID</th>
                                    <th style="text-align:center;">BROKER ID</th>
                                    <th style="text-align:center;">Status </th>
                                    
                                   
                                    <th colspan="2" style="text-align:center;">Operation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($payment as $row): ?>
                               
                                    <tr >
                                        <td><?php echo $row['pay_id'];?></td>
                                        <td><?php echo $row['payment_method'];?></td>
                                        <td><?php echo $row['payment_type'];?></td>
                                        <td><?php echo $row['downpayment'];?></td>
                                        <td><?php echo $row['total_amount_paid'];?></td>
                                        <td><?php echo $row['prop_value']-$row['total_amount_paid'];?></td>
                                       

                                        <td><?php echo $row['book_id'];?></td>
                                        <td><?php echo $row['propid'];?></td>
                                        <td><?php echo $row['seller_id'];?></td>
                                        <td><?php echo $row['buyer_id'];?></td>
                                        <td><?php echo $row['broker_id'];?></td>
                                        <td><?php echo $row['status'];?></td>
                                        
                                        
                                        <td>
                                            <button data-booking="<?php echo $row['propid']; ?>" data-toggle="propertydetails" 
                                                data-target="#details_property" data-user="<?php echo $row['propid']; ?>"
                                                type="button" class="cat_property btn btn-outline-primary btn-sm"><i class="fa fa-eye"></i>
                                            </button>
                                        </td>          
                                    </tr>
                                <?php endforeach; ?> 
                            </tbody>
                        </table>
                        <div class="propertydetails" id="details_property">
                            <div class="details-body">
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
   
    $('.cat_property').click(function(){
    
        var url = "<?php echo base_url('Property/getpropertycategory'); ?>";
         var property_id = $(this).data('booking');
        var data = {propid:property_id};
        $.post(url,data,function(response){
                    var obj = JSON.parse(response);
                    var size = Object.keys(obj).length;
                    var table = " <center> <h4>Details of Property</h4></center> <table class='table table-responsive table-striped' style='border:1px dashed black;border-radius:6px !important;border-collapse: separate;'>";
                    table += '<thead>';
                    table += '<th>';
                    table += ' Type';
                    table += '</th>';
                    table += '<th>';
                    table += ' Category';
                    table += '</th>';
                    table += '<th>';
                    table += ' Owner';
                    table += '</th>';
                    table += '<th>';
                    table += ' Area';
                    table += '</th>';
                    table += '<th>';
                    table += 'Bedrooms';
                    table += '</th>';
                    table += '<th>';
                    table += 'Bathrooms';
                    table += '</th>';
                    table += '<th>';
                    table += ' Value';
                    table += '</th>';
                    table += '<th>';
                    table += ' City';
                    table += '</th>';
                    table += '<th>';
                    table += ' Location';
                    table += '</th>';
                    table += '<tbody>';
                    for(var i=0;i<size;i++)
                    {
                    table += '<tr>';
                    table += '<td>';
                    table += obj[i].prop_type;
                    table += '</td>';
                    table += '<td>';
                    table += obj[i].category_name;
                    table += '</td>';
                    table += '<td>';
                    table += obj[i].full_name;
                    table += '</td>';
                    table += '<td>';
                    table += obj[i].prop_area;
                    table += '</td>';
                    table += '<td>';
                    table += obj[i].bedrooms;
                    table += '</td>';
                    table += '<td>';
                    table += obj[i].bathrooms;
                    table += '</td>';
                    table += '<td>';
                    table += obj[i].prop_value;
                    table += '</td>';
                    table += '<td>';
                    table += obj[i].prop_city;
                    table += '</td>';
                    table += '<td>';
                    table += obj[i].prop_location;
                    table += '</td>';
                    
                    table += '</tr>';
                    }
                    table += '</tbody>';
                    table += "</table>";
                    
                    $('.details-body').html(table);


                    });
    });
    
});
</script>
