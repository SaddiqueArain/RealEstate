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
                <div class="col-sm-6">
                    <div class="page-header ">
                        <div class="page-title">
                            <h4>Add Installment</h4>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class=" float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Payment</a></li>
                                <li><a href="#">Installment</a></li>
                                <li class="active">Add</li>
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
    <section class="content container-fluid" style="margin-top: -30px;">
      <div class="content">
      <?php echo form_open('Payment/insert_installment');?>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-3">
                       <label>Payment ID</label>
                        <select id="payment_id" name="payment_id" class="form-control">
                            <option value="">Select Payment ID</option>
                            <?php foreach($payment as $row): ?>
                            <option value="<?php echo $row['pay_id']; ?>" ><?php echo $row['pay_id']; ?></option>
                            <?php endforeach; ?> 
                        </select>
                         <?php echo form_error('payment_id'); ?>
                    </div>
                    <div class="col-lg-3">
                       <label>Installment_No</label>
                        <?php echo form_input(['class'=>'form-control','placeholder'=>'Installment No',
                        'name'=>'installment_no','id'=>'installment_no']);?>
                         <?php echo form_error('installment_no'); ?>
                    </div>
                    <div class="col-lg-3">
                       <label>Installment Amount</label>
                       <?php echo form_input(['class'=>'form-control','placeholder'=>'Installment Amount',
                        'name'=>'installment_amount','id'=>'installment_amount']);?>
                        
                         <?php echo form_error('installment_amount'); ?>
                    </div>
                    <div class="col-lg-3">
                      <input type="hidden" placeholder="property value" name="prop_value" id="prop_value">
                      <input type="hidden" placeholder="property ID" name="propid" id="propid">
                      <input type="hidden" placeholder="Buyer Id" name="buyer_id" id="buyer_id">
                      <input type="hidden" placeholder="Booking ID" name="book_id" id="book_id">
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
             document.getElementById("book_id").value = data['book_id'];
          });
        }
     });
   });
});
</script>