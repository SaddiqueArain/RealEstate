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
                            <h4>Edit Installment</h4>
                        </div>
                    </div>
                </div>
               <div class="col-sm-4">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <?php if($msg = $this->session->flashdata('Update_Failed')):
                            $msg_class = $this->session->flashdata('msg_class')?>
                            <div class="alert <?php echo $msg_class ?>">
                                <?php echo $msg; ?>
                            </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class=" float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Payment</a></li>
                                <li><a href="#">Installment</a></li>
                                <li class="active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>
    </div>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div class="content">
      <?php echo form_open('Payment/update_installment');
            echo form_hidden('pay_inst_id',$installment->pay_inst_id);?>
            <div class="card-header">
                <a href="<?php echo base_url('Payment/index');?>">
                    <button class='btn btn-info btn-md glyphicon glyphicon-hand-left'>  Back
                    </button>
                </a>
            </div>
            <br>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-3">
                        <select id="payment_id" name="payment_id" class="form-control">
                          <?php foreach($payment as $row): 
                            if($installment->pay_id===$row['pay_id'])
                              {
                              ?>
                                <option selected value="<?php echo $row['pay_id']; ?>" ><?php echo $row['pay_id']; ?></option>
                              <?php } 
                              else{?>
                                 <option value="<?php echo $row['pay_id']; ?>" ><?php echo $row['pay_id']; ?></option>
                          <?php } endforeach; ?>
                        </select>
                         <?php echo form_error('payment_id'); ?>
                    </div>
                    <div class="col-lg-3">
                        <?php echo form_input(['class'=>'form-control','placeholder'=>'Installment No',
                        'name'=>'installment_no','id'=>'installment_no',
                        'value'=>set_value('installment_no',$installment->installment_no)]);?>
                         <?php echo form_error('installment_no'); ?>
                    </div>
                    <div class="col-lg-3">
                       <?php echo form_input(['class'=>'form-control','placeholder'=>'Installment Amount',
                        'name'=>'installment_amount','id'=>'installment_amount',
                        'value'=>set_value('installment_amount',$installment->installment_amount)]);?>
                        
                         <?php echo form_error('installment_amount'); ?>
                    </div>
                    <div class="col-lg-3">
                      <input type="text" placeholder="property value" name="prop_value" id="prop_value">
                      <input type="text" placeholder="property ID" name="propid" id="propid">
                      <input type="text" placeholder="Buyer Id" name="buyer_id" id="buyer_id">
                      <input type="text" placeholder="Seller Id" name="seller_id" id="seller_id">
                      <input type="text" placeholder="Total Amount Paid" name="total_amount_paid" id="total_amount_paid" value="<?php echo $installment->total_amount_paid;?>">
                      <input type="text" placeholder="Booking ID" name="book_id" id="book_id">
                      
                      <input type="text" placeholder="Pre Pay ID" name="pre_pay_id" value="<?php echo $installment->pay_id; ?>">
                      
                      <input type="text" placeholder="pre property ID" name="pre_propid" id="pre_propid">
                      <input type="text" placeholder="Pre Booking ID" name="pre_book_id" id="pre_book_id">
                      
                      <input type="text" placeholder="pre Seller Id" name="pre_seller_id" id="pre_seller_id">
                    </div>
                 </div>
            </div>
            <div class="form-actions form-group">
                <?php echo form_submit(['type'=>'submit','class'=>'btn btn-success btn-sm'
                 ,'value'=>'Submit']); ?>
            </div>
        <?php echo form_close();?>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script type="text/javascript">
window.onload=function()
{
  
    var pay_id = $('#payment_id').val();
      // AJAX request
    $.ajax({
        url:'<?php echo base_url('Payment/getpropvalue');?>',
        method: 'post',
        data: {pay_id: pay_id},
        dataType: 'json',
        success: function(response){
         // $('#prop_owner').find('option').not(':first').remove();
          $.each(response,function(index,data){
            // $('#prop_owner').value = data['full_name'];
             //.append('<option value="'+data['uid']+'">'+data['full_name']+'</option>');
             document.getElementById("prop_value").value = data['prop_value'];
             document.getElementById("propid").value = data['propid'];
             document.getElementById("buyer_id").value = data['buyer_id'];
             document.getElementById("book_id").value = data['book_id'];
             document.getElementById("seller_id").value = data['seller_id'];


             document.getElementById("pre_propid").value = data['propid'];
             document.getElementById("pre_book_id").value = data['book_id'];
             document.getElementById("pre_seller_id").value = data['seller_id'];
          });
        }
     });
  
}
$(document).ready(function(){
 
  // Property ID Change
    $('#payment_id').change(function(){
      var pay_id = $(this).val();
      // AJAX request
    $.ajax({
        url:'<?php echo base_url('Payment/getpropvalue');?>',
        method: 'post',
        data: {pay_id: pay_id},
        dataType: 'json',
        success: function(response){
         // $('#prop_owner').find('option').not(':first').remove();
          $.each(response,function(index,data){
            // $('#prop_owner').value = data['full_name'];
             //.append('<option value="'+data['uid']+'">'+data['full_name']+'</option>');
             document.getElementById("prop_value").value = data['prop_value'];
             document.getElementById("propid").value = data['propid'];
             document.getElementById("buyer_id").value = data['buyer_id'];
             document.getElementById("seller_id").value = data['seller_id'];
             document.getElementById("book_id").value = data['book_id'];
          });
        }
     });
   });
});
</script>