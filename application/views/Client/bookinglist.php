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
                                <h4>Booking</h4>
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
                        <a href="<?php echo base_url('Home/getproperties');?>"><?php echo form_submit(['type'=>'submit','class'=>'btn btn-info btn-md'
                            ,'value'=>'New Booking']); ?>
                        </a>
                    </div>
                    <div class="col-sm-12 box-body table-responsive no-padding">
                        <table class="table table-hover table-striped" style="text-align:center; margin-top:2px;border:1px solid black;
                        border-radius:6px !important;border-collapse: separate; ">
                            <thead  style="border-top:1px dashed black;">
                                <tr>
                                    <th style="text-align:center;">Booking ID</th>
                                    <th style="text-align:center;">Property Name</th>
                                    <th style="text-align:center;">Buyer Name</th>
                                    <th style="text-align:center;">Seller Name</th>
                                    <th style="text-align:center;">Broker Name</th>
                                    <th style="text-align:center;">Property Image</th>
                                    <th colspan="2" style="text-align:center;">Operation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($booking as $row): ?>
                                <?php $seller_id = $row['seller_id']; ?>
                                <?php $broker_id = $row['broker_id']; ?>
                                    <tr >
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
                                        <td><a  href="<?php echo $row['prop_img_link'];?>" class="fancybox"><img src="<?php echo $row['prop_img_link'];?>" style="width:50px;height:50px;"></a></td>
                                        <td>
                                            <?php echo form_open('Client/getPayment'); ?>
                                             <?php echo form_hidden('book_id',$row['book_id']);?>
                                            <button type="submit" class="pay_property btn btn-outline-primary btn-sm"><i class="fa fa-dollar"></i></button>
                                            <?php form_close();?>
                                        </td>
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
