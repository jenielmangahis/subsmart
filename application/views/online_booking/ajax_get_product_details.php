<div class="row">
  <div class="col-md-6">
    <?php 
      $service_item_thumb = $product->image;
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
  <div class="col-md-6">
    <div class="product__name" style="height: 25px;"><h2><?php echo $product->name; ?></h2></div>
    <br />
    <div class="product__description">
       <p><?php echo $product->description; ?></p>
    </div>
  </div>
</div>