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
                            <h4>Edit Booking</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                  <?php if($msg = $this->session->flashdata('Update_Failed')):
                            $msg_class = $this->session->flashdata('msg_class')?>
                        <div class="alert <?php echo $msg_class ?>">
                            <?php echo $msg; ?>
                        </div>
                            <?php endif;?>
                </div>
                <div class="col-sm-4">
                    <div class=" float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Booking</a></li>
                                <li class="active">Edit</li>
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
      <?php echo form_open('Booking/update_booking');
      echo form_hidden('book_id',$booking->book_id);?>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-2">
                      <label for="property_name">Property_name</label>
                        <select id="property_name" name="property_name" class="form-control">
                            <option value="">Select Property</option>
                            <?php foreach($property as $row): 
                            if($booking->propid===$row['propid'])
                              {
                              ?>
                              <option  selected value="<?php echo $row['propid']; ?>" ><?php echo $row['prop_name']; ?></option>
                              <?php } 
                              else{?>
                                  <option   value="<?php echo $row['propid']; ?>" ><?php echo $row['prop_name']; ?></option>
                              
                              <?php } endforeach; ?> 
                        </select>
                        <!-- For getting seller id update purpose-->
                       
                         <?php echo form_error('property_name'); ?>
                    </div>
                     <div class="col-lg-2">
                        <label for="prop_owner">Property Owner</label>
                        <?php foreach($owner as $row) 
                        if($booking->seller_id===$row['uid'])
                          {?>

                      <?php echo form_input(['class'=>'form-control','placeholder'=>'Property Owner',
                        'name'=>'prop_owner','id'=>'prop_owner','value'=>set_value('prop_owner',$row['full_name'])]);?>
                         <?php } echo form_error('prop_owner'); ?>
                     </div>
                     
                     <input type="hidden" name="owner_id" id="owner_id" value="<?php echo $booking->seller_id ?>">
                    <div class="col-lg-2">
                       <label for="buyer">Buyer_name</label>
                        <select id="buyer" name="buyer" class="form-control">
                            <option value="">Select Buyer</option>
                            <?php foreach($buyer as $row): 
                            if($booking->buyer_id===$row['uid'])
                              {
                              ?>
                              <option  selected value="<?php echo $row['uid']; ?>" ><?php echo $row['full_name']; ?></option>
                              <?php } 
                              else{?>
                                  <option   value="<?php echo $row['uid']; ?>" ><?php echo $row['full_name']; ?></option>
                              
                              <?php } endforeach; ?> 
                        </select>
                         <?php echo form_error('buyer'); ?>
                    </div>
                     
                    <div class="col-lg-3">
                       <label for="broker">Broker Name</label>
                        <select id="broker" name="broker" class="form-control">
                            <option value="">Select Broker</option>
                            <?php foreach($broker as $row): 
                            if($booking->broker_id===$row['uid'])
                              {
                              ?>
                              <option  selected value="<?php echo $row['uid']; ?>" ><?php echo $row['full_name']; ?></option>
                              <?php } 
                              else{?>
                                  <option   value="<?php echo $row['uid']; ?>" ><?php echo $row['full_name']; ?></option>
                              
                              <?php } endforeach; ?> 
                        </select>
                         <?php echo form_error('broker'); ?>
                    </div>
                    <!-- property value -->
                      <div class="col-lg-3">
                        <label for="prop_value">Property Value</label>
                       <input class= "form-control" type="text" id="prop_value" name="prop_value">
                     </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                  <input type="hidden" name="pay_id" value="<?php echo $booking->pay_id;?>">
                    <div class="col-lg-3">
                       <label for="payment">Payment Method</label>
                      <select id="payment" name="payment" class="form-control">
                            <option value="">Select Payment Method</option>
                            <?php foreach($payment as $row): 
                            if($booking->book_id===$row['book_id'])
                              {
                              ?>
                              <option  selected value="<?php echo $row['payment_method']; ?>" ><?php echo $row['payment_method']; ?></option>
                        <?php } ?>
                              <?php  endforeach; ?> 
                              <?php  
                              if($booking->payment_method=="By Cash")
                                {?>
                                      <option value="By Check" >By Check</option>
                          <?php }
                                else
                                {?>
                                      <option value="By Cash" >By Cash</option>
                          <?php }?>
                      </select>
                         <?php echo form_error('payment'); ?>
                    </div>
                    <div class="col-lg-3">
                       <label for="payment_type">Payment Type</label>
                      <select id="payment_type" name="payment_type" class="form-control">
                            <option value="">Select Payment Type</option>
                            <?php foreach($payment as $row): 
                            if($booking->book_id===$row['book_id'])
                              {
                              ?>
                              <option  selected value="<?php echo $row['payment_type']; ?>" ><?php echo $row['payment_type']; ?></option>
                        <?php } ?>
                              <?php  endforeach;  
                              if($booking->payment_type=="Full_Payment")
                                {?>
                                      <option value="Installment" >Installment</option>
                          <?php }
                                else if($booking->payment_type=="Installment")
                                {?>
                                      <option value="Full_Payment" >Full Payment</option>
                          <?php }
                               ?>
                      </select>
                         <?php echo form_error('payment_type'); ?>
                    </div>
                    <div class="col-lg-2">
                       <label for="downpayment">Downpayment</label>
                      <?php echo form_input(['class'=>'form-control','placeholder'=>'Downpayment',
                        'name'=>'downpayment','id'=>'downpayment','onchange'=>'calculatecommission()','value'=>set_value('downpayment',$booking->downpayment)]);?>
                         <?php echo form_error('downpayment'); ?>
                    </div>
                    
                    <div class="col-lg-2" id="commissions">
                      <label for="commission">Commission</label>
                      <?php echo form_input(['class'=>'form-control','placeholder'=>'Commission',
                        'name'=>'commission','id'=>'commission','value'=>set_value('commission')]);?>
                         <?php echo form_error('commission'); ?>
                    </div>
                    
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-3" id="rented">
                       <label for="rentamount">Rent</label>
                      <?php echo form_input(['class'=>'form-control','placeholder'=>'Rent Amount',
                        'name'=>'rentamount','id'=>'rentamount', 'value'=>set_value('rentamount')]);?>
                         <?php echo form_error('rentamount'); ?>
                    </div>
                    <div class="col-lg-3">
                      <input type="hidden" name="pre_seller_id" id="pre_seller_id">
                    </div>
                    <div class="col-lg-3">
                      <input type="hidden" name="pre_propid" id="pre_propid">
                    </div>
                    <div class="col-lg-3">
                      <input type="hidden" name="booking" id="booking" value="<?php echo $booking->book_id ?>">
                    </div>
                </div>
            </div>
            <div class="form-actions form-group">
                <?php echo form_submit(['type'=>'submit','class'=>'btn btn-success btn-sm'
                 ,'value'=>'Update']); ?>
            </div>
        <?php echo form_close();?>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script type="text/javascript">
  var payment_type = $('#payment_type').val();
document.getElementById("prop_owner").disabled = true;
 function calculatecommission()
 {
     // for commission calculate
     var payment = document.getElementById('payment_type').value;
     var broker_id = document.getElementById('broker').value;

       if(broker_id!=0)
       {
          if(payment=="Installment")
          {
              document.getElementById("commission").value = (document.getElementById('downpayment').value/100)*20; 
          }
          else if(payment=="Full_Payment")
          {
            document.getElementById("commission").value = (document.getElementById('downpayment').value/100)*10; 
          }
          else if(payment=="Rent")
          {
            document.getElementById("commission").value = (document.getElementById('downpayment').value/2); 
          }
       }
       else
       {
          document.getElementById("commission").value = 0;
       }
        
    
 }
 window.onload =function(){ 

  var broker_id = document.getElementById('broker').value;
  var payment = document.getElementById('payment_type').value;
  var pre_seller_id = document.getElementById('owner_id').value;
  document.getElementById("pre_seller_id").value = pre_seller_id;
  var pre_propid = document.getElementById('property_name').value;
  document.getElementById('pre_propid').value = pre_propid;
  
  if(broker_id!=0)
  {
    if(payment=="Installment")
    {
        document.getElementById("commission").value = (document.getElementById('downpayment').value/100)*20; 
        document.getElementById('downpayment').disabled = false;
    }
    else if(payment=="Full_Payment")
    {
      document.getElementById("commission").value = (document.getElementById('downpayment').value/100)*10; 
      document.getElementById('downpayment').disabled = true;
    }
    else if(payment=="Rent")
    {
      document.getElementById("commission").value = (document.getElementById('downpayment').value/2); 
      document.getElementById('downpayment').readOnly = true;
    }
  }
  else
  {
    if(payment=="Installment")
    {
        document.getElementById("commission").value = 0; 
        document.getElementById('downpayment').disabled = false;
    }
    else if(payment=="Full_Payment")
    {
      document.getElementById("commission").value = 0; 
      document.getElementById('downpayment').disabled = true;
    }
     else if(payment=="Rent")
    {
      document.getElementById("commission").value = 0; 
      document.getElementById('downpayment').readOnly = true;
     // document.getElementById('rentamount').disabled = true;
    }
   
  }
  var vall = $('#payment_type').val();
  if(vall=="Rent")
  {
   // alert("zza");
    document.getElementById('rentamount').style.visibility = 'visible';
    document.getElementById('rented').style.visibility = 'visible';
    var booking_id = document.getElementById('booking').value;
    $.ajax({
        url:'<?php echo base_url('Booking/getrent');?>',
        method: 'post',
        data: {book_id: booking_id},
        dataType: 'json',
        success: function(response){
          $.each(response,function(index,data){
             document.getElementById("rentamount").value = data['rent_amount'];
          });
        }
     });
    var propid = $('#property_name').val();
    $.ajax({
        url:'<?php echo base_url('Property/getpropowner');?>',
        method: 'post',
        data: {propid: propid},
        dataType: 'json',
        success: function(response){
          $.each(response,function(index,data){
             var prop_value = data['prop_value'];
             document.getElementById("prop_value").value = prop_value;
          });
        }
     });
  }
  else if(vall=="Full_Payment")
  {
    document.getElementById('rented').style.visibility = 'hidden';
    //document.getElementById('downpayment').disabled = 'true';
      var propid = $('#property_name').val();
      // AJAX request
    $.ajax({
        url:'<?php echo base_url('Property/getpropowner');?>',
        method: 'post',
        data: {propid: propid},
        dataType: 'json',
        success: function(response){
          $.each(response,function(index,data){
             var prop_value = data['prop_value'];
             document.getElementById("prop_value").value = prop_value;
          });
        }
     });
  }
  else
  {
    document.getElementById('rented').style.visibility = 'hidden';
      var propid = $('#property_name').val();
      // AJAX request
    $.ajax({
        url:'<?php echo base_url('Property/getpropowner');?>',
        method: 'post',
        data: {propid: propid},
        dataType: 'json',
        success: function(response){
          $.each(response,function(index,data){
             var prop_value = data['prop_value'];
             document.getElementById("prop_value").value = prop_value;
          });
        }
     });
  }
  
}

// when page is ready
$(document).ready(function(){
 //document.getElementById("rented").style.visibility = 'hidden';
  var payment = document.getElementById('payment_type').value;
   $('#broker').change(function(){
      var val = $(this).val();
      
  if(val!=0)
  {

   // document.getElementById('commissions').style.visibility = 'visible';
    if(payment=="Installment")
    {
        document.getElementById("commission").value = (document.getElementById('downpayment').value/100)*20; 
       // document.getElementById('downpayment').disabled = false;
    }
    else if(payment=="Full_Payment")
    {
      document.getElementById("commission").value = (document.getElementById('downpayment').value/100)*10; 
      //document.getElementById('downpayment').disabled = false;
    }
    else if(payment=="Rent")
    {
      document.getElementById("commission").value = (document.getElementById('downpayment').value/2); 
      document.getElementById('downpayment').readOnly = true;
    }
  }
  else
  {
    //alert("sad");
    if(payment=="Installment")
    {
        document.getElementById("commission").value = 0; 
        //document.getElementById('downpayment').disabled = false;
    }
    else if(payment=="Full_Payment")
    {
      document.getElementById("commission").value = 0; 
      //document.getElementById('downpayment').disabled = false;
    }
    else if(payment=="Rent")
    {
      document.getElementById("commission").value = 0; 
      document.getElementById('downpayment').readOnly = true;
    }
  }
    });
    $('#payment_type').change(function(){
      var payment_type = $(this).val();
      var broker_id = $('#broker').val();
      if(payment_type=="Full_Payment")
      {
        document.getElementById("rented").style.visibility = 'hidden';
        document.getElementById('downpayment').disabled = true;
        document.getElementById('downpayment').value = document.getElementById("prop_value").value;
        if(broker_id!=0)
        {
            document.getElementById("commission").value = (document.getElementById("downpayment").value/100)*10;
        }
      }
      else if(payment_type=="Installment")
      {
        document.getElementById("rented").style.visibility = 'hidden';
        document.getElementById('downpayment').disabled = false;
        document.getElementById("downpayment").value = (document.getElementById("prop_value").value/100)*30;
        if(broker_id!=0)
        {
          document.getElementById("commission").value = (document.getElementById("downpayment").value/100)*20;
        }
      }
      else if(payment_type=="Rent")
      {
        //alert("sad");
        document.getElementById("rented").style.visibility = 'visible';
        document.getElementById("downpayment").value = (document.getElementById("prop_value").value)*2;
        document.getElementById("rentamount").value = (document.getElementById("prop_value").value);
        document.getElementById('downpayment').readOnly = true;
        if(broker_id!=0)
        {
          document.getElementById("commission").value = (document.getElementById("downpayment").value/2);
        }
      }
    });

   //*******************

   $('#property_name').change(function(){
      var propid = $(this).val();
       document.getElementById("rented").style.visibility = 'hidden';
      // document.getElementById("rentamount").style.visibility = 'hidden';
      // AJAX request
      //alert(propid);
    $.ajax({
        url:'<?php echo base_url('Property/getpropowner');?>',
        method: 'post',
        data: {propid: propid},
        dataType: 'json',
        success: function(response){
         // $('#prop_owner').find('option').not(':first').remove();
          $.each(response,function(index,data){

             $('#prop_owner').value = data['full_name'];
             //.append('<option value="'+data['uid']+'">'+data['full_name']+'</option>');
             document.getElementById("prop_owner").value = data['full_name'];
             var prop_value = data['prop_value'];
             //alert(prop_value);
             var prop_status = data['prop_status'];
             //alert(prop_status);
             
             var uid = data['uid'];
             document.getElementById("owner_id").value = uid;
             
             

             var myOptions = {
                 // val1 : 'Select Payment Type',
                  Full_Payment : 'Full_Payment',
                  Installment : 'Installment',
                  
              };
              var myOptions2 = {
              //  val4 : 'Select Payment Type-',
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
               var payment_type = $('#payment_type').val();
            //  alert(payment_type);
              var broker_id = $('#broker').val();
             if(payment_type=="Full_Payment")
             {
                document.getElementById("rented").style.visibility = 'hidden';
                document.getElementById("rentamount").style.visibility = 'hidden';
                document.getElementById("prop_value").value = prop_value;
                document.getElementById("downpayment").value = prop_value;
                if(broker_id!=0)
                {
                    document.getElementById("commission").value = (document.getElementById("downpayment").value/100)*10;
                }
             }
             else if(payment_type=="Installment")
             {
                document.getElementById("rented").style.visibility = 'hidden';
                document.getElementById("rentamount").style.visibility = 'hidden';
                document.getElementById("prop_value").value = prop_value;
                document.getElementById("downpayment").value = (document.getElementById("prop_value").value/100)*30;
                if(broker_id!=0)
                {
                  document.getElementById("commission").value = (document.getElementById("downpayment").value/100)*20;
                }
             }
             else if(payment_type=="Rent")
             {
             // alert("sa");
                document.getElementById("rented").style.visibility = 'visible';
                document.getElementById("rentamount").style.visibility = 'visible';
                document.getElementById("prop_value").value = prop_value;
                document.getElementById("downpayment").value = (document.getElementById("prop_value").value*2);
                document.getElementById("rentamount").value = prop_value;
                if(broker_id!=0)
                {
                  document.getElementById("commission").value = (document.getElementById("downpayment").value/2);
                }
             }
            
          });
        }
     });
   });
   //*******************

 });

</script>