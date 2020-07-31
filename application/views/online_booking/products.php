<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_booking'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/upgrades'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Online Booking</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Manage your online booking</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <?php include viewPath('includes/booking_tabs'); ?>   

                        <?php if($this->session->flashdata('message')) { ?>
                            <div class="row dashboard-container-1">
                                <div class="col-md-12">
                                    <div class="alert <?php echo $this->session->flashdata('alert_class'); ?>">
                                      <button type="button" class="close" data-dismiss="alert">&times</button>
                                      <?php echo $this->session->flashdata('message'); ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="ajax-alert-container"></div>

                        <div class="row dashboard-container-1">
                            <div class="col-md-8"><strong>Set the products or services with prices users can book.</strong></div>
                            <div class="col-md-4 text-right">
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalAddCategory">Add Category
                                </button>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalAddServiceItem">
                                Add Service/Item
                                </button>
                            </div>
                        </div>       

                        <div class="row dashboard-container-2"> 

                            <table class="table">
                              <thead>
                                <tr>
                                  <th width="60%" scope="col">Categories & Products</th>
                                  <th width="20%" scope="col">Visible</th>
                                  <th width="20%" scope="col">Actions</th>
                                </tr>
                              </thead>
                              <tbody>

                                <?php foreach( $category as $cat ){ ?>
                                    <tr>
                                      <td colspan="2" width="80%"><strong>Category Name:</strong> <?php echo $cat->name; ?></td>
                                      <td width="20%" style="">
                                            <a style="margin-right: 15px;" class="category-edit" data-category-edit-modal="open" data-id="<?php echo $cat->id; ?>" href="javascript:void(0);">
                                                <span class="fa fa-edit"></span> edit
                                            </a>
                                            <a class="category-delete" data-category-delete-modal="open" data-id="<?php echo $cat->id; ?>" href="javascript:void(0);" data-name="<?php echo $cat->name; ?>">
                                                <span class="fa fa-trash"></span>
                                            </a>
                                        </td>
                                    </tr>

                                    <?php if (array_key_exists($cat->id,$service_items)) { ?>
                                    <?php 
                                        $service_item = $service_items[$cat->id];
                                    ?>
                                        <?php foreach($service_item as $sitem) { ?>
                                            <tr style="">
                                                <td width="60%">
                                                    <?php 
                                                        
                                                        $service_item_thumb = $sitem->image;
                                                        if(file_exists('uploads/' . $service_item_thumb) == FALSE || $service_item_thumb == null) {
                                                            
                                                            $service_item_thumb_img = base_url('/assets/dashboard/images/online-booking.png');
                                                            if(file_exists('uploads/service_item/' . $service_item_thumb) == FALSE || $service_item_thumb == null) {
                                                                $service_item_thumb_img = base_url('/assets/dashboard/images/online-booking.png');
                                                            } else {
                                                                $service_item_thumb_img = base_url('uploads/service_item/'.$service_item_thumb);
                                                            }


                                                        } else {
                                                            $service_item_thumb_img = base_url('uploads/'.$service_item_thumb);
                                                        }
                                                        
                                                    ?>
                                                    <div style="margin-left: 30px;" class="service-items">
                                                        <img class="service-item-img" style="height: 80px; width: 80px;" src="<?php echo $service_item_thumb_img; ?>" alt="..." class="img-thumbnail">
                                                        <div class="service-item-cnt">
                                                            <div><?= $sitem->name; ?></div>
                                                            <div>Price: $<?= $sitem->price; ?>/<?= $sitem->price_unit; ?></div>
                                                            <div><?= $sitem->description; ?></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td width="20%">
                                                    <div class="onoffswitch">
                                                        <input type="checkbox" name="product-status[]" class="onoffswitch-checkbox onoffswitch-checkbox-productStatus" data-product-id="<?= $sitem->id; ?>" id="product-status-<?= $sitem->id; ?>" <?= $sitem->is_visible == 1 ? 'checked=""' : ''; ?> >
                                                        <label class="onoffswitch-label" for="product-status-<?= $sitem->id; ?>">
                                                            <span class="onoffswitch-inner"></span>
                                                            <span class="onoffswitch-switch"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td width="20%" style="">
                                                    <a style="margin-right: 15px;" class="service-item-edit" data-category-edit-modal="open" data-id="<?php echo $sitem->id; ?>" href="javascript:void(0);">
                                                        <span class="fa fa-edit"></span> edit
                                                    </a>
                                                    <a class="service-item-delete" data-id="<?php echo $sitem->id; ?>" href="javascript:void(0);" data-name="<?php echo $sitem->name; ?>">
                                                        <span class="fa fa-trash"></span>
                                                    </a>                                                    
                                                </td>
                                            </tr> 
                                        <?php } ?>
                                    <?php } ?>
                                   
                                <?php } ?>

                              </tbody>
                            </table>                                                                                

                        </div>
                        <hr />
                        <div style="text-align: right;"><a href="<?php echo base_url('more/addon/booking/time') ?>" class="btn btn-success"> Continue >> </a></div>                                  
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->

        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>

<?php include viewPath('includes/booking_modals'); ?>   
<?php include viewPath('includes/footer_booking'); ?>
<script>
$(function(){
    var base_url = "<?php echo base_url(); ?>";

    /*$(".service-item-delete").click(function(){
        var siid = $(this).attr("data-id");
        $("#siid").val(siid);
        $("#modalDeleteServiceItem").modal('show');
    });*/
});
</script>