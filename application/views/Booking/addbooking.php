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
                            <h4>Add Booking</h4>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class=" float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Booking</a></li>
                                <li class="active">Add</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div class="content">
      <?php echo form_open('Booking/insert_booking');?>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-4">
                       <label for="property_name">Property_Name</label>
                        <select id="property_name" name="property_name" class="form-control">
                            <option value="">Select Property</option>
                            <?php foreach($property as $row): ?>
                            <option value="<?php echo $row['propid']; ?>" ><?php echo $row['prop_name']; ?></option>
                            <?php endforeach; ?> 
                        </select>
                         <?php echo form_error('property_name'); ?>
                    </div>
                      
                       <input type="hidden" id="prop_value" name="prop_value">
                      
                     <div class="col-lg-2">
                       <label for="prop_owner">Property_Owner</label>
                        <input type="text" name="prop_owner" id="prop_owner" class="form-control" >
                        <input type="hidden" id="owner_id" name="owner_id">   
                        </select>
                         <?php echo form_error('prop_owner'); ?>
                    </div>
                    <div class="col-lg-2">
                       <label for="buyer">Buyer_Name</label>
                        <select name="buyer" class="form-control">
                            <option value="">Select Buyer</option>
                            <?php foreach($buyer as $row): ?>
                            <option value="<?php echo $row['uid']; ?>" ><?php echo $row['full_name']; ?></option>
                            <?php endforeach; ?> 
                        </select>
                         <?php echo form_error('buyer'); ?>
                    </div>
                    <div class="col-lg-2">
                       <label for="chk">Broker_status</label>
                      <select id="chk" name="chk" class="form-control">
                        <option>Broker</option>
                        <option value="Yes">Yes</option>
                        <option value"No">No</option>
                      </select>
                      <?php echo form_error('chk'); ?>
                    </div>
                    <div class="col-lg-2" id="broker_name">
                       <label for="broker">Broker_Name</label>
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
                       <label for="payment_method">Payment_Method</label>
                      <select id="payment" name="payment_method" class="form-control">
                        <option value="">Select Payment Method</option>
                        <option value="By Cash">By Cash</option>
                        <option value="By Check">By Check</option>
                      </select>
                         <?php echo form_error('payment'); ?>
                    </div>
                    <div class="col-lg-3">
                       <label for="payment_type">Payment_Type</label>
                      <select id="payment_type" name="payment_type" class="form-control">
                        <option value="">Select Payment Type</option>
                        
                      </select>
                         <?php echo form_error('payment_type'); ?>
                    </div>
                    <div class="col-lg-3">
                       <label for="downpayment">Downpayment</label>
                      <?php echo form_input(['class'=>'form-control','placeholder'=>'Downpayment',
                        'name'=>'downpayment','id'=>'downpayment','readonly'=>'true']);?>
                         <?php echo form_error('downpayment'); ?>
                    </div>
                    <!-- BROKER COMMISSION -->
                     <label id="commission_value" for="commission">Commission</label>
                    <input type="text" name="commission" id="commission">
                     <!-- END BROKER COMMISSION -->
                    <div class="col-lg-3" >
                      
                      <?php echo form_input(['class'=>'form-control','placeholder'=>'Rent Amount',
                        'name'=>'rentamount','id'=>'rentamount','readonly'=>'true' ]);?>
                         <?php echo form_error('rentamount'); ?>
                    </div>
                </div>
            </div>
            <div class="form-actions form-group">
                <?php echo form_submit(['type'=>'submit','class'=>'btn btn-success btn-sm'
                 ,'value'=>'Book Property']); ?>
            </div>
        <?php echo form_close();?>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script type="text/javascript">

$(document).ready(function(){
 
  document.getElementById('broker').style.visibility = 'hidden';
  document.getElementById('broker_name').style.visibility = 'hidden';
  document.getElementById('commission').style.visibility = 'hidden';
  document.getElementById('commission_value').style.visibility = 'hidden';
  document.getElementById('rentamount').style.visibility = 'hidden';
  document.getElementById('prop_owner').disabled = true;
  // Type change
    $('#chk').change(function(){
      var val = $(this).val();
      if(val == "Yes")
      {
        document.getElementById('broker').style.visibility = 'visible';
        document.getElementById('broker_name').style.visibility = 'visible';
        document.getElementById('commission').style.visibility = 'visible';
        document.getElementById('commission_value').style.visibility = 'visible';
       
      }
      else
      {
        document.getElementById('broker').style.visibility = 'hidden';
        document.getElementById('broker_name').style.visibility = 'hidden';
        document.getElementById('commission').style.visibility = 'hidden';
        document.getElementById('commission_value').style.visibility = 'hidden';
      }
    });
    $('#property_name').change(function(){
      var propid = $(this).val();
      // AJAX request
      document.getElementById("downpayment").value = '0';
    $.ajax({
        url:'<?php echo base_url('Property/getpropowner');?>',
        method: 'post',
        data: {propid: propid},
        dataType: 'json',
        success: function(response){
         // $('#prop_owner').find('option').not(':first').remove();
          $.each(response,function(index,data){
            // $('#prop_owner').value = data['full_name'];
             //.append('<option value="'+data['uid']+'">'+data['full_name']+'</option>');
             document.getElementById("prop_owner").value = data['full_name'];
             var prop_value = data['prop_value'];
             var prop_status = data['prop_status'];
             var uid = data['uid'];
             document.getElementById("owner_id").value = uid;
             document.getElementById("prop_value").value = prop_value;
             var myOptions = {
                  val1 : 'Select Payment Type',
                  Full_Payment : 'Full_Payment',
                  Installment : 'Installment',
                  
              };
              var myOptions2 = {
                val4 : 'Select Payment Type-',
                Rent : 'Rent',
                
              };
             
              var mySelect = $('#payment_type');
                  
             if(prop_status=="Available for Rent")
             {
              $('#payment_type').find('option').remove();
                  $.each(myOptions2, function(val, text) {
                   
                  mySelect.append(
                      $('<option></option>').val(val).html(text)
                  );
                });
             }
              if(prop_status!="Available for Rent")
             {
                 $('#payment_type').find('option').remove();
                  $.each(myOptions, function(val, text) {
                 
                  mySelect.append(
                      $('<option></option>').val(val).html(text)
                  );
                });
                
             }
          });
        }
     });
   });
     $('#payment_type').change(function(){
      var val = $(this).val();
      if(val == "Full_Payment")
      {
         //document.getElementById('downpayment').disabled = true;
         document.getElementById('downpayment').value = document.getElementById('prop_value').value;
         document.getElementById('commission').value = (document.getElementById('downpayment').value/100)*10
      }
      else
      {
       // document.getElementById('downpayment').disabled = true;
        document.getElementById('downpayment').value = (document.getElementById('prop_value').value/100)*30;
        document.getElementById('commission').value = (document.getElementById('downpayment').value/100)*20;
     
      }
      if(val == "Rent")
      {
        //document.getElementById('downpayment').disabled = true;
        document.getElementById('downpayment').value = document.getElementById('prop_value').value*2;
        document.getElementById('rentamount').style.visibility = 'visible';
        //document.getElementById('rentamount').disabled = true;
        document.getElementById('rentamount').value = document.getElementById('prop_value').value;
        document.getElementById('commission').value = (document.getElementById('prop_value').value);
     
      }
      else
      {
        //document.getElementById('downpayment').disabled = true;
        document.getElementById('rentamount').style.visibility = 'hidden';
      }
    });
});
</script>