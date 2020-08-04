<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_front_booking'); ?>
<div>
    <!-- page wrapper start -->
    <div class="col-xl-8 left">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title-v2">Online Booking</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Manage your online booking</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-xl-12">
                <?php echo form_open_multipart('booking/products/'.$eid.'?style=grid', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                <div class="col-9 right-menu">
                  <div class="col-4 left pr-0 ml-4">
                    <input type="text" class="form-control-search left" value="<?php echo $search_query; ?>" name="search" placeholder="Search...">
                  </div>
                  <div class="col-1 left pl-1">
                    <button type="submit" class="search-booking-btn"><span class="fa fa-search"></span></button>
                  </div>
                  <div class="col-3 left pl-0 pr-0 pos-rlt-cs left-20">
                    <a class="view-grid" href="<?php echo base_url('booking/products/'.$eid.'?style=grid') ?>"><span class="fa fa-th fa-margin-right"></span> Grid view</a>
                  </div>
                  <div class="col-3 left pl-0 pr-0 pos-rlt-cs">
                    <a class="view-grid active" href="<?php echo base_url('booking/products/'.$eid) ?>"><span class="fa fa-list-ul fa-margin-right"></span> List view</a>
                  </div>
                </div>
                <?php echo form_close(); ?>
              </div>
            </div>
            <!-- end row -->
            <div class="row">
                <?php include viewPath('flash'); ?>
                <div class="col-xl-12">
                  <ul class="category-grid">
                  <?php foreach($products as $key => $value){ ?>            
                    <li class="category-li">
                        <div class="category__name"><?php echo $value['category']->name; ?></div>
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
                                       <button class="btn btn-green btn-sm btn-add-cart" data-id="<?php echo $p->id; ?>">Add to Cart</button>
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
  var base_url = "<?php echo base_url(); ?>";

  function continue_cart(){    
      var eid = "<?php echo $eid; ?>";
      window.location.href = base_url + "booking/products_schedule/"+eid;
  }

  $(function(){

  });

</script>

