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
                            <h4>Add Payment</h4>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class=" float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Dashboard</a></li>
                                <li><a href="#">Payment</a></li>
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
    <section class="content container-fluid">
      <div class="content">
      <?php echo form_open('Payment/insert_payment');?>
            <div class="form-group">
                <div class="row">
                  <div class="col-lg-2">
                    <?php echo form_input(['class'=>'form-control','placeholder'=>'Booking ID',
                        'name'=>'book_id','id'=>'book_id','value'=>set_value('book_id'),'readonly'=>'true']);?>
                        
                         <?php echo form_error('book_id'); ?>
                    </div>
                    <div class="col-lg-3">
                        <select id="payment_method" name="payment_method" class="form-control">
                            <option value="">Select Payment Method</option>
                            <option value="By Cash">By Cash</option>
                            <option value="By Check">By Check</option>
                        </select>
                         <?php echo form_error('payment_method'); ?>
                    </div>
                    <div class="col-lg-3">
                         <select id="payment_type" name="payment_type" class="form-control">
                            <option value="">Select Payment Type</option>
                            <?php foreach($property as $row):
                                if($row['prop_status']=="Available for Buying")
                                  {?>
                            <option value="Full_Payment">Full_Payment</option>
                            <option value="Installment">Installment</option>
                            <?php }
                                  else
                                  {?> 
                            <option value="Rent">Rent</option>
                            <?php } endforeach; ?>
                        </select>
                         <?php echo form_error('payment_type'); ?>
                    </div>
                   <div class="col-lg-2">
                      <select id="chk" name="chk" class="form-control">
                        <?php foreach($booking as $row):
                          if($row['broker_id']=="-1")
                            {?>
                                <option value="Yes">Yes</option>
                                 <option value"No">No</option>
                      <?php }
                            else
                            {?>
                                <option value"No">No</option>
                                <option value="Yes">Yes</option>
                      <?php }  ?>
                      <input type="hidden" name="buyer_id" value="<?php echo $row['buyer_id'] ?>">
                    <?php endforeach;?>
                      </select>
                      <?php echo form_error('chk'); ?>
                    </div>
                    <div class="col-lg-2">
                        <select name="broker" id="broker" class="form-control">
                            <option value="">Select Broker</option>
                            <?php foreach($broker as $row): ?>
                            <option value="<?php echo $row['uid']; ?>" ><?php echo $row['full_name']; ?></option>
                            <?php endforeach; ?> 
                        </select>
                         <?php echo form_error('broker'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                  <div class="col-lg-3">
                      <?php foreach($property as $row):?>
                      <input type="text" name="prop_value" id="prop_value" value="<?php echo $row['prop_value'] ?>">
                      <input type="text" name="seller_id"  value="<?php echo $row['uid'] ?>">
                      <input type="text" name="propid"  value="<?php echo $row['propid'] ?>">
                      <?php  endforeach; ?>

                    </div>
                   <div class="col-lg-3">
                       <?php echo form_input(['class'=>'form-control','placeholder'=>'Downpayment',
                        'name'=>'downpayment','id'=>'downpayment','readonly'=>'true']);?>
                        
                         <?php echo form_error('downpayment'); ?>
                    </div>
                    <input type="text" name="commission" id="commission">
                <div class="col-lg-3">
                    <?php echo form_input(['class'=>'form-control','placeholder'=>'Rent Amount',
                      'name'=>'rentamount','id'=>'rentamount','readonly'=>'true' ]);?>
                       <?php echo form_error('rentamount'); ?>
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
  document.getElementById('rentamount').style.visibility = 'hidden';
     document.getElementById('broker').style.visibility = 'hidden';
     document.getElementById('commission').style.visibility = 'hidden';
  window.onload = function()
  {
      var val = $('#chk').val();
      if(val == "Yes")
      {
        document.getElementById('broker').style.visibility = 'visible';
        document.getElementById('commission').style.visibility = 'visible';
       
      }
      else
      {
        document.getElementById('broker').style.visibility = 'hidden';
        document.getElementById('commission').style.visibility = 'hidden';
      }
  }
    $(document).ready(function(){
     
     
       $('#payment_type').change(function(){
      var val = $(this).val();
      if(val == "Full_Payment")
      {
         document.getElementById('downpayment').value = document.getElementById('prop_value').value;
         document.getElementById('commission').value = (document.getElementById('downpayment').value/100)*10
      }
      else if(val == "Installment")
      {
        document.getElementById('downpayment').value = (document.getElementById('prop_value').value/100)*30;
        document.getElementById('commission').value = (document.getElementById('downpayment').value/100)*20;
     
      }
     else if(val == "Rent")
      {
        document.getElementById('downpayment').value = document.getElementById('prop_value').value*2;
        document.getElementById('rentamount').style.visibility = 'visible';
       
        document.getElementById('rentamount').value = document.getElementById('prop_value').value;
        document.getElementById('commission').value = (document.getElementById('prop_value').value);
     
      }
      else
      {
        //document.getElementById('downpayment').disabled = true;
         document.getElementById('downpayment').value = null;
        document.getElementById('rentamount').style.visibility = 'hidden';
      }
    });
  
  // Type change
    $('#chk').change(function(){
      var val = $(this).val();
      if(val == "Yes")
      {
        document.getElementById('broker').style.visibility = 'visible';
        document.getElementById('commission').style.visibility = 'visible';
       
      }
      else
      {
        document.getElementById('broker').style.visibility = 'hidden';
        document.getElementById('commission').style.visibility = 'hidden';
      }
    });
    
    });


  </script>
