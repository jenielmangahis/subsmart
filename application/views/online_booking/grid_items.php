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
</style>
<div>
    <!-- page wrapper start -->
    <div class="col-xl-9 left">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h1 class="page-title-v2"><?php echo $booking_settings ? $booking_settings->page_title : 'Online Booking'; ?></h1>
                        <div class="pl-3 pr-3 mt-2 row" style="position: relative;top: 7px;">
                          <div class="col mb-4 left alert alert-warning mt-0 mb-0">
                              <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;"><?php echo $booking_settings->page_instruction; ?></span>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-bottom: 15px;">
              <div class="col-xl-12" style="text-align:right;">                
                 <a class="view-grid active btn btn-sm btn-primary" href="<?php echo base_url('booking/products/'.$eid.'?style=grid') ?>" style="margin-right: 10px;"><span class="fa fa-th fa-margin-right"></span> Grid view</a>
                 <a class="view-grid btn btn-sm btn-primary" href="<?php echo base_url('booking/products/'.$eid) ?>"><span class="fa fa-list-ul fa-margin-right"></span> List view</a>
                </div>                
              </div>              
            </div>
            <!-- end row -->
            <div class="row">
                <?php include viewPath('flash'); ?>
                <div class="col-xl-12">
                  <ul class="category-grid">
                  <?php foreach($products as $key => $value){ ?>            
                    <li class="category-li">
                        <div class="category__name booking-category-name"><?php echo $value['category']->name; ?></div>
                        <ul class="row row-list product-list">
                          <?php foreach( $value['products'] as $p ){ ?>
                            <li class="col-lg-4 product-li">
                              <div class="product" data-product-id="<?php echo $p->id; ?>">  
                                 <div class="product__img__cnt" data-product-id="<?php echo $p->id; ?>">                                                             
                                    <div class="product__img__hover" style="display: none;"><span>Quick Look</span></div>
                                    <?php 
                                      $service_item_thumb = $p->image;
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
                                    <img class="product__img" src="<?php echo $service_item_thumb_img; ?>">                                    
                                 </div>
                                 <div class="product__cnt">
                                    <div class="product__name" style="height: 25px;"><?php echo $p->name; ?></div>
                                    <div class="product__description">
                                       <p><?php echo $p->description; ?></p>
                                    </div>
                                    <div class="product__price">$<?php echo number_format($p->price, 2); ?><span class="product__price__unit">/<?php echo $p->price_unit; ?></span></div>
                                    <div class="product__actions">
                                       <div class="product__qty-box sdv-qty">
                                          <button class="btn qty_minus product__qty-btn" data-id="<?php echo $p->id; ?>" type="button"><span class="fa fa-minus"></span></button>
                                          <input class="form-control-qty product__qty" id="qty-input-<?php echo $p->id; ?>" type="text" name="qty[<?php echo $p->id; ?>]" value="1">
                                          <button class="btn qty_plus product__qty-btn"  data-id="<?php echo $p->id; ?>" type="button"><span class="fa fa-plus"></span></button>
                                       </div>
                                       <button class="btn btn-sm btn-primary btn-add-cart" data-id="<?php echo $p->id; ?>">Add to Cart</button>
                                    </div>
                                    <div class="product__view">
                                       <a href="#" data-product-modal="open" data-product-id="<?php echo $p->id; ?>">view more</a>
                                    </div>
                                 </div>
                              </div>
                           </li>
                          <?php } ?>
                        </ul>
                     </li>
                     <?php } ?>
                   </ul>                  
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <?php include viewPath('includes/sidebars/front_items_cart'); ?>    
    <!-- page wrapper end -->
</div>

<?php include viewPath('includes/booking_front_modals'); ?>  

<script>
var base_url = "<?php echo base_url(); ?>";
</script>

<?php include viewPath('includes/footer_front_booking'); ?>

<script>  
  function continue_cart(){    
      var eid = "<?php echo $eid; ?>";
      window.location.href = base_url + "booking/products_schedule/"+eid;
  }

  $(function(){

  });

</script>

