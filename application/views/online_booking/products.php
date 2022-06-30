<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 5px !important;
  padding-left: 39px !important;
  margin-top: 55px !important;
}
.row-category, .row-category a{
    background-color: #32243d;
    color: #ffffff;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/upgrades'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-20">
            <div class="row">
                <div class="col">
                  <h3 class="page-title mt-0">Online Booking</h3>
                </div>
                <div class="col-auto">
                    <div class="h1-spacer">
                        <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modalAddCategory"><i class="fa fa-category"></i> Add Category</button>
                        <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modalAddServiceItem"><i class="fa fa-plus"></i> Add Service/Item</button>
                    </div>
                </div>
            </div>
            <div class="pl-3 pr-3 mt-2 row" style="position: relative;top: 7px;">
              <div class="col mb-4 left alert alert-warning mt-0 mb-0">
                  <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Set the products or services with prices users can book.</span>
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

                        <div class="row dashboard-container-2"> 

                            <table class="table">
                              <thead>
                                <tr>
                                  <th width="60%" scope="col"><b>Categories & Products</b></th>
                                  <th width="20%" scope="col"><b>Visible</b></th>
                                  <th width="20%" scope="col"><b>Actions</b></th>
                                </tr>
                              </thead>
                              <tbody>

                                <?php foreach( $category as $cat ){ ?>
                                    <tr class="row-category">
                                      <td colspan="2" width="80%"><strong>Category Name:</strong> <?php echo $cat->name; ?></td>
                                      <td width="20%" style="">
                                            <a style="margin-right: 15px;" class="category-edit" data-category-edit-modal="open" data-id="<?php echo $cat->id; ?>" href="javascript:void(0);">
                                                <span class="fa fa-edit"></span> Edit
                                            </a>
                                            <a class="category-delete" data-category-delete-modal="open" data-id="<?php echo $cat->id; ?>" href="javascript:void(0);" data-name="<?php echo $cat->name; ?>">
                                                <span class="fa fa-trash"></span> Delete
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
                                                    <div class="service-items row">
                                                        <div class="col-2">
                                                            <img class="service-item-img" style="width: 100%;margin-top: 24px;" src="<?php echo $service_item_thumb_img; ?>" alt="..." class="img-thumbnail">
                                                        </div>
                                                        <div class="col-9">
                                                            <div class="service-item-cnt">
                                                                <div><b><?= $sitem->name; ?></b></div>                                                                
                                                                <div class="font-italic mb-0 small" style="color: #6c757d!important;font-size:17px; margin-top: 10px; margin-bottom:10px !important;"><?= $sitem->description; ?></div>
                                                                <div><b>Price: $<?= $sitem->price; ?>/<?= $sitem->price_unit; ?></b></div>
                                                            </div>
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
                                                        <span class="fa fa-edit"></span> Edit
                                                    </a>
                                                    <a class="service-item-delete" data-id="<?php echo $sitem->id; ?>" href="javascript:void(0);" data-name="<?php echo $sitem->name; ?>">
                                                        <span class="fa fa-trash"></span> Delete
                                                    </a>                                                    
                                                </td>
                                            </tr> 
                                        <?php } ?>
                                    <?php } ?>
                                   
                                <?php } ?>

                              </tbody>
                            </table>  
                        </div>                                  
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