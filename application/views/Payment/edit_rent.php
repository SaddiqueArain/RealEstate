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
                            <h4>Add Rent</h4>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class=" float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Dashboard</a></li>
                                <li><a href="#">Rent</a></li>
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
      <?php echo form_open('Payment/update_rent');
       echo form_hidden('rent_id',$rent->rent_id);?>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-4">
                      <label for="pay_id">Payment_ID</label>
                        <select id="pay_id" name="pay_id" class="form-control">
                            <?php foreach($payment as $row):
                                if($rent->pay_id==$row['pay_id'])
                                {?>
                                    <option selected value="<?php echo $row['pay_id']; ?>"><?php echo $row['pay_id']; ?></option>
                          <?php }
                                else
                                {?>
                                    <option  value="<?php echo $row['pay_id']; ?>"><?php echo $row['pay_id']; ?></option>
                              
                            <?php } endforeach; ?>
                        </select>
                         <?php echo form_error('pay_id'); ?>
                    </div>
                    <div class="col-lg-4">
                       <label for="book_id">Booking_ID</label>
                         <?php echo form_input(['class'=>'form-control','placeholder'=>'Booing ID',
                        'name'=>'book_id','id'=>'book_id','value'=>set_value('book_id'),'readonly'=>'true']);?>
                         <?php echo form_error('book_id'); ?>
                    </div>
                    <div class="col-lg-4">
                       <label for="rentamount">Rent_Amount</label>
                    <?php echo form_input(['class'=>'form-control','placeholder'=>'Rent Amount',
                        'name'=>'rentamount','id'=>'rentamount','value'=>set_value('rentamount')]);?>
                        
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
  window.onload=function()
  {
     var pay_id = $('#pay_id').val();
     
      $.ajax({
          url:'<?php echo base_url('Payment/get_bookingid');?>',
          method: 'post',
          data: {pay_id: pay_id},
          dataType: 'json',
          success: function(response){
           // $('#prop_owner').find('option').not(':first').remove();
            $.each(response,function(index,data){
              document.getElementById("book_id").value = data['book_id'];
                 
            });
          }
        });
      $.ajax({
          url:'<?php echo base_url('Payment/getpropvalue');?>',
          method: 'post',
          data: {pay_id: pay_id},
          dataType: 'json',
          success: function(response){
           // $('#prop_owner').find('option').not(':first').remove();
            $.each(response,function(index,data){
              document.getElementById("rentamount").value = data['prop_value'];
                 
            });
          }
        });
  }
     $(document).ready(function(){
       $('#pay_id').change(function(){
      var pay_id = $(this).val();
     
      $.ajax({
          url:'<?php echo base_url('Payment/get_bookingid');?>',
          method: 'post',
          data: {pay_id: pay_id},
          dataType: 'json',
          success: function(response){
           // $('#prop_owner').find('option').not(':first').remove();
            $.each(response,function(index,data){
              document.getElementById("book_id").value = data['book_id'];
                 
            });
          }
        });
      $.ajax({
          url:'<?php echo base_url('Payment/getpropvalue');?>',
          method: 'post',
          data: {pay_id: pay_id},
          dataType: 'json',
          success: function(response){
           // $('#prop_owner').find('option').not(':first').remove();
            $.each(response,function(index,data){
              document.getElementById("rentamount").value = data['prop_value'];
                 
            });
          }
        });
    });
  });

  </script>
  