<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-image: url('<?php echo base_url('assets/back.jpg');?>')!important ;">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="margin-bottom:-15px;">
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
                                    <li><a href="#">Request</a></li>
                                    <li><a href="#">Property</a></li>
                                    <li class="active">Approvals</li>
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
            <div class="row">
                <div class="col-sm-12">
                    <h4>Property Approvals</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 box-body table-responsive no-padding">
                    <table class="table table-hover table-striped"style="text-align:center; margin-top:2px;border:1px solid black;
                        border-radius:6px !important;border-collapse: separate; ">
                        <thead  style="border-top:1px dashed black;">
                            <tr>
                                <th >Property ID</th>
                                <th >Property Name</th>
                                <th >Property Type</th>
                                <th >Property Status</th>
                                <th >Property Value</th>
                                <th >Booking Status</th>
                                <th >Property Image</th>
                                <th colspan="3"style="text-align:center;">Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($approvals as $row): ?>
                                <tr scope="row">
                                    <td><?php echo $row['propid'];?></td>
                                    <td><?php echo $row['prop_name'];?></td>
                                    <td><?php echo $row['prop_type'];?></td>
                                    <td><?php echo $row['prop_status'];?></td>
                                    <td><?php echo $row['prop_value'];?></td>
                                    <?php if($row['on_hold'] == 1)
                                    {?>
                                    <td>Available</td> 
                                    <?php } 
                                    else
                                    {?>
                                     <td>On Hold</td> 
                                     <?php }?>
                                    <td><a  href="<?php echo $row['prop_img_link'];?>" class="fancybox"><img src="<?php echo $row['prop_img_link'];?>" style="width:50px;height:50px;"></a></td>
                                     <td><button class="app btn btn-success" data-property="<?php echo $row['propid'];?>">Approve</button></td>
                                    <td><button class="dis btn btn-danger" data-property="<?php echo $row['propid'];?>">Disapprove</button></td>
                                   
                                    <td>
                                        <button data-property="<?php echo $row['propid']; ?>" data-toggle="modal" data-target="#myModal" data-user="<?php echo $row['propid']; ?>" type="button" class="cat_property btn btn-outline-primary btn-sm"><i class="fa fa-eye"></i>
                                        </button>
                                    </td>          
                                </tr>
                            <?php endforeach; ?> 
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
            <div class="row">
                <div class="col-sm-3"style="float:right;"><?php echo $this->pagination->create_links() ?></div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">

$(document).ready(function(){
     $('.app').click(function(event)
    {
        event.preventDefault();
            var url = "<?php echo base_url('Admin/approved_property');?>";
            var propid = $(this).data('property');
            var data = {propid:propid};
            $.post(url,data,function(response)
            {

                setTimeout(function(){
                    window.location.reload();

                    }, 0)
            });         
    });
     $('.dis').click(function(event)
    {
        event.preventDefault();
            var url = "<?php echo base_url('Admin/rejected_property');?>";
            var propid = $(this).data('property');
            var data = {propid:propid};
            $.post(url,data,function(response)
            {

                setTimeout(function(){
                    window.location.reload();

                    }, 0)
            });         
    });
   

    $('.cat_property').click(function(){
       
        //alert(propid);

        var url = "<?php echo base_url('Property/getpropertycategory'); ?>";
         var property_id = $(this).data('property');
        var data = {propid:property_id};
        $.post(url,data,function(response){
                    var obj = JSON.parse(response);
                    var size = Object.keys(obj).length;
                    var table = " <center> <h4>Information</h4></center> <table class='table table-responsive table-bordered'>";
                    table += '<thead>';
                    table += '<th>';
                    table += 'Type Category';
                    table += '</th>';
                    table += '<th>';
                    table += 'Property Owner';
                    table += '</th>';
                    table += '<th>';
                    table += 'Property Area';
                    table += '</th>';
                    table += '<th>';
                    table += 'Bedrooms';
                    table += '</th>';
                    table += '<th>';
                    table += 'Bathrooms';
                    table += '</th>';
                    table += '<th>';
                    table += 'Property City';
                    table += '</th>';
                    table += '<th>';
                    table += 'Property Location';
                    table += '</th>';
                    table += '<tbody>';
                    for(var i=0;i<size;i++)
                    {
                    table += '<tr>';
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
                    table += obj[i].prop_city;
                    table += '</td>';
                    table += '<td>';
                    table += obj[i].prop_location;
                    table += '</td>';

                    table += '</tr>';
                    }
                    table += '</tbody>';
                    table += "</table>";
                    
                    $('.modal-body').html(table);


                    });
    });
    
});
/*function loadUrl(newLocation)
{
  window.location.href = newLocation;
}*/
</script>
