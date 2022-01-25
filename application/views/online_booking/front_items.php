<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_front_booking'); ?>
<style>
.booking-category-name{
  background-color: #32243d;
  color: #ffffff;
  font-size: 16px;
  padding: 10px;
  margin: 0px;
}
.service-item-img{
  width: 100%;
}
.service-item-name{
  font-size: 27px;
  font-weight: bold;  
}
.service-item-price {
    font-size: 17px;
    font-weight: bold;
}
.service-item-name, .service-item-description, .price-container{
  display: block;
}
.service-item-description{
  font-size: 15px;
}
.service-item-price{
  float: left;
}
.btn-booking-add-to-cart{
  float: right;
}
.tbl-booking-products{
  /*border-collapse:separate;
  border-spacing:0 8px;*/
}
.product-container{
  margin-top: 20px;
  overflow: auto;
  max-height: 600px;
}
</style>
    <!-- page wrapper start -->
    <div class="col-xl-9 left">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title-v2"><?php echo $booking_settings ? $booking_settings->page_title : 'Online Booking'; ?></h1>
                    </div>
                </div>
                <div class="pl-3 pr-3 mt-2 row" style="position: relative;top: 7px;">
                  <div class="col mb-4 left alert alert-warning mt-0 mb-0">
                      <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;"><?php echo $booking_settings->page_instruction; ?></span>
                  </div>
                </div>
            </div>
            <?php echo form_open_multipart('booking/products/'.$eid, [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
            <div class="row" style="margin-bottom: 15px;">
              <div class="col-xl-12" style="text-align:right;">                
                 <a class="view-grid btn btn-sm btn-primary" href="<?php echo base_url('booking/products/'.$eid.'?style=grid') ?>" style="margin-right: 10px;"><span class="fa fa-th fa-margin-right"></span> Grid view</a>
                 <a class="view-grid active btn btn-sm btn-primary" href="<?php echo base_url('booking/products/'.$eid) ?>"><span class="fa fa-list-ul fa-margin-right"></span> List view</a>
                </div>                
              </div>              
            </div>
            <?php echo form_close(); ?>
            <!-- end row -->
            <div class="row">
                <?php include viewPath('flash'); ?>
                <div class="col-xl-12 product-container">
                    <?php foreach($products as $p){ ?>
                      <h3 class="booking-category-name"><?php echo $p['category']->name; ?></h3>
                      <table class="table tbl-booking-products">
                      <?php foreach($p['products'] as $item){ ?>
                        <tr style="background-color:#ffffff;" class="row-padding">
                          <td style="width:25%; vertical-align: top;">
                            <?php                      
                                $service_item_thumb = $item->image;
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
                            <img class="service-item-img" src="<?php echo $service_item_thumb_img; ?>">
                          </td>
                          <td>
                            <span class="service-item-name"><?php echo $item->name; ?></span>
                            <p class="service-item-description font-italic text-muted mb-0 small"><?php echo $item->description; ?></p>
                            <hr />
                            <div class="price-container">
                              <span class="service-item-price">$<?php echo number_format($item->price,2) . '/' . $item->price_unit; ?></span> 
                              <div class="product__qty-box sdv-qty" style="float:right;">
                                <button class="btn qty_minus product__qty-btn" data-id="<?php echo $item->id; ?>" type="button"><span class="fa fa-minus"></span></button>
                                <input class="form-control-qty product__qty" id="qty-input-<?php echo $item->id; ?>" type="text" name="qty[<?php echo $item->id; ?>]" value="1">
                                <button class="btn qty_plus product__qty-btn"  data-id="<?php echo $item->id; ?>" type="button"><span class="fa fa-plus"></span></button>
                                <a class="btn btn-sm btn-primary btn-add-cart" data-id="<?php echo $item->id; ?>" href="javascript:void(0);">Add to cart</a>
                              </div>                           
                            </div>
                          </td>
                        </tr>
                      <?php } ?>
                      </table>
                    <?php } ?>                    
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <?php include viewPath('includes/sidebars/front_items_cart'); ?>    
    <!-- page wrapper end -->
<?php include viewPath('includes/booking_front_modals'); ?>    

<?php include viewPath('includes/footer_front_booking'); ?>

<script>  
  function continue_cart(){    
      var eid = "<?php echo $eid; ?>";
      window.location.href = base_url + "booking/products_schedule/"+eid;
  }

  $(function(){

  });

</script>
