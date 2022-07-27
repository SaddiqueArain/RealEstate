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
                                    <li><a href="#">Booking</a></li>
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
            <div class="animated fadeIn">
                 <div class="">
                    <div class="card-header">
                        <h4>Payment Details Against Booking ID <?php echo $book_payment->book_id;?></h4>
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
                                    <th style="text-align:center;">Payment Date</th>
                                    <th style="text-align:center;">Booking ID</th>
                                    <th colspan="2" style="text-align:center;">Operation</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                    <tr>
                                        <td><?php echo $book_payment->pay_id; ?></td>
                                        <td><?php echo $book_payment->payment_method; ?></td>
                                        <td><?php echo $book_payment->payment_type; ?></td>
                                        <td><?php echo $book_payment->downpayment; ?></td>
                                        <td><?php echo $book_payment->total_amount_paid; ?></td>
                                        <td><?php echo $book_payment->payment_date; ?></td>
                                        <td><?php echo $book_payment->book_id; ?></td>
                                        <td>
                                           <button data-payment="<?php echo $book_payment->pay_id; ?>" data-toggle="modal" 
                                                data-target="#myModal" data-user="<?php echo $book_payment->pay_id; ?>"
                                                type="button" class="cat_property btn btn-outline-primary btn-sm"><i class="fa fa-eye"></i>
                                        </td>          
                                    </tr>
                                
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
    
        var url = "<?php echo base_url('Client/getInstallment'); ?>";
         var pay_id = $(this).data('payment');
        var data = {pay_id:pay_id};
        $.post(url,data,function(response){
                    var obj = JSON.parse(response);
                    var size = Object.keys(obj).length;
                    var table = " <center> <h4>Details of Payment</h4></center> <table class='table table-responsive table-striped' style='border:1px dashed black;border-radius:6px !important;border-collapse: separate;'>";
                    table += '<thead>';
                    table += '<th>';
                    table += ' Installment ID';
                    table += '</th>';
                    table += '<th>';
                    table += ' Payment ID';
                    table += '</th>';
                    table += '<th>';
                    table += ' Installment No';
                    table += '</th>';
                    table += '<th>';
                    table += ' Installment Amount';
                    table += '</th>';
                    table += '<th>';
                    table += 'Paid Date';
                    table += '</th>';
                   
                    table += '<tbody>';
                    for(var i=0;i<size;i++)
                    {
                    table += '<tr>';
                    table += '<td>';
                    table += obj[i].pay_inst_id;
                    table += '</td>';
                    table += '<td>';
                    table += obj[i].pay_id;
                    table += '</td>';
                    table += '<td>';
                    table += obj[i].installment_no;
                    table += '</td>';
                    table += '<td>';
                    table += obj[i].installment_amount;
                    table += '</td>';
                    table += '<td>';
                    table += obj[i].paid_date;
                    table += '</td>';
                    
                    table += '</tr>';
                    }
                    table += '</tbody>';
                    table += "</table>";
                    
                    $('.modal-body').html(table);


                    });
    });
    
});
</script>
