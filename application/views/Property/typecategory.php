<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#myInput").on("keyup",function(){
            var value = $(this).val().toLowerCase();
            $('#myTable tr').each(function(index){
                if (index != 0) {

                    $row = $(this);

                    var id = $row.find("td:first").text();

                    if (id.indexOf(value) != 0) {
                        $(this).hide();
                    }
                    else {
                        $(this).show();
                    }
                }
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
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
                              <h4>Type Category</h4>
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
                    <div class=" float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Property</a></li>
                                <li><a href="#">Property Type</a></li>
                                    <li><a href="#">Category</a></li>
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
    <section class="content container-fluid" style="margin-top:-30px;" >
        <div class="content">
            <div class="row">
                <div class="col-sm-6">
                    <a href="<?php echo base_url('Property/insert_typecategory');?>"><?php echo form_submit(['type'=>'submit','class'=>'btn btn-info btn-md'
                        ,'value'=>'Add Property Type']); ?>
                    </a>
                </div>
                <div class="col-sm-6">
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                      <input type="text" name="q" id="myInput" class="form-control" placeholder="Search...">
                      <span class="input-group-btn">
                          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                          </button>
                        </span>
                    </div>
                </form>
            </div>
            </div>
            <div class="row">
                <div class="col-sm-12 box-body table-responsive no-padding">
                    <table class="table table-striped table-hover" style="text-align: center; margin-top:3px;border:1px solid black;
                        border-radius:6px !important;border-collapse: separate; ">
                    <thead>
                        <tr>
                            <th>Type Category ID</th>
                            <th>Category Name</th>
                            <th>Property Type</th>
                            <th colspan="2">Operation</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php foreach($details as $row): ?>
                            <tr>
                                <td><?php echo $row['pro_typecat_id'];?></td>
                                <td><?php echo $row['category_name'];?></td>
                                <td><?php echo $row['prop_type'];?></td>
                                <td>
                                    <button data-type-category="<?php echo $row['pro_typecat_id']; ?>" data-user="<?php echo $row['pro_typecat_id']; ?>"type="button" class="del_type_category btn btn-danger btn-sm glyphicon glyphicon-trash">
                                    </button>
                                </td>
                                <td>
                                    <?php echo form_open('Property/edit_typecategory'); ?>
                                    <?php echo form_hidden('pro_typecat_id',$row['pro_typecat_id']);?>
                                        <button type="submit" class="update_property btn btn-info btn-sm glyphicon glyphicon-pencil">
                                        </button>
                                    <?php echo form_close(); ?>
                                </td>          
                            </tr>
                        <?php endforeach; ?> 

                    </tbody>
                </table>
                </div>
            </div>
            <div class="row">
               
                <div id="yes" class="col-sm-3" style="float:right;"><?php echo $this->pagination->create_links() ?></div>
            </div>
        </div>
            
    </section>
</div>


<script type="text/javascript">
$(document).ready(function(){
    $('.del_type_category').click(function(event)
    {
            event.preventDefault();
            var url = "<?php echo base_url('Property/delete_typecategory'); ?>";
            var type_category_id = $(this).data('type-category');
            var data = {type_category_id:type_category_id};
            $.post(url,data,function(response)
            {
                setTimeout(function(){
                    window.location.reload();

                    }, 0)
            });
    });
});

</script>