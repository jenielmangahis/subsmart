<div class="col-xl-3 container-full-col">
   <div class="widget-cnt-right">
      <div class="widget-cnt-right__child">
         <div class="business">
            <?php
              $profile_image = $userProfile->profile_img;
              if(file_exists('uploads/users/user-profile/' . $profile_image) == FALSE || $profile_image == null) {

                  $profile_image = base_url('/assets/dashboard/images/online-booking.png');
                  if(isset($service_item_thumb)){
                    if(file_exists('uploads/service_item/' . $service_item_thumb) == FALSE || $service_item_thumb == null) {
                        $profile_image = base_url('/assets/dashboard/images/online-booking.png');
                    }else {
                        $profile_image = base_url('uploads/users/user-profile/'.$profile_image);
                    }
                  }

              } else {
                  $profile_image = base_url('uploads/users/user-profile/'.$profile_image);
              }
            ?>
            <img class="business__logo" src="<?php echo $profile_image; ?>">
            <div class="business__cnt">
               <div class="business__name"><?php echo $userProfile->FName . ' ' . $userProfile->LName; ?></div>
               <div class="business__phone"><?php echo isset($userProfile->phone) ? $userProfile->phone : ''; ?></div>
            </div>
         </div>
         <div class="widget-cart margin-bottom-sec" data-cart="cart">
            <div style="font-size: 18px; margin-bottom: 15px;">
               <span class="fa fa-shopping-cart fa-margin-right"></span> Cart Total:
               $<span class="total_cart_amount"><?php echo number_format($cart_data['total_cart_items'], 2); ?></span>   <span class="text-ter">(<?php echo count($cart_data['items']) ?> item(s))</span>

            </div>
            <div>
                <?php $is_cont_button_enable = true; $item_total_arr = array();?>
                <?php $sub_total = 0; $item_sub_total = 0; ?>
                <?php foreach($cart_data['items'] as $item){ ?>
                  
                  <div style="position: relative; margin-bottom: 10px;">
                    <div style="color: #487ca6;"><?php echo $item->name; ?></div>
                    <div class="text-ter" style="margin-bottom: 3px; padding-right: 20px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $item->description; ?></div>
                    <div><?php echo $item->ordered_qty; ?> x $<?php echo number_format($item->price,2); ?>/<?php echo $item->price_unit; ?></div>
                    <a class="a-ter delete-cart-item" data-id="<?php echo $item->id; ?>" href="#" style="position: absolute; top: 2px; right:0"><span class="fa fa-trash"></span></a>
                  </div>
                  <?php 
                    $sub_total = $item->ordered_qty * $item->price;
                    $item_sub_total += $sub_total;
                    $item_total_arr['grand_total'] = $item_sub_total;
                  ?>
                <?php } ?>
                <?php 
                  $minimum_booking_amount = $booking_settings->minimum_price_for_entier_booking >= 1 ? $booking_settings->minimum_price_for_entier_booking : 0;
                  $grand_item_total = isset($item_total_arr['grand_total']) ? $item_total_arr['grand_total'] : 0;
                  if($grand_item_total < $minimum_booking_amount) {
                    $is_cont_button_enable = false;
                  }
                  if($minimum_booking_amount == 0) {
                    $is_cont_button_enable = true;
                  }
                ?>
            </div>
            <br />
            <?php if($booking_settings->minimum_price_for_entier_booking >= 1) { ?>
              <div class="alert alert-danger">
                Minimum booking amount is <strong>$<?php echo number_format($booking_settings->minimum_price_for_entier_booking,2); ?></strong>
              </div>
            <?php } ?>
         </div>
          <!-- <div class="coupon">
              <div class="coupon__code">
                 <input type="text" name="coupon_code" value="" class="form-control form-control-md" placeholder="Enter coupon code" data-coupon="coupon_code">
              </div>
              <button class="btn btn-default btn-md coupon__btn" data-coupon="btn_submit" name="coupon_btn" type="submit">Apply</button>
          </div> -->
          <hr class="margin-top margin-bottom">
          <?php if($uri_segment_method_name != 'products') { ?>
                  <a class="btn btn-default btn-back left" href="javascript:history.go(-1);">« Back</a>
          <?php } ?>
          <?php 
            $a_button_text_name = "Continue";
            if($uri_segment_method_name == 'front_booking_form') {
              $a_button_text_name = "Book Now";
            }
          ?>
          <div class="text-right">
            <?php if($uri_segment_method_name == 'products') { ?>
              <?php if($is_cont_button_enable == false) { ?>
                <a class="btn btn-primary-grey" style="pointer-events: none; cursor: default;" data-form="continue" href="javascript:void(0);" onclick="javascript:continue_cart();"><?php echo $a_button_text_name; ?> »</a>
              <?php } else { ?>
                <a class="btn btn-primary-green" data-form="continue" href="javascript:void(0);" onclick="javascript:continue_cart();"><?php echo $a_button_text_name; ?> »</a>              
              <?php } ?>
            <?php }elseif($uri_segment_method_name == 'products_schedule') { ?>
                <?php if($is_cont_to_booking_form == false) { ?>
                  <a class="btn btn-primary-grey" id="schedule-next-link" style="pointer-events: none; cursor: default;" data-form="continue" href="javascript:void(0);" onclick="javascript:continue_cart();"><?php echo $a_button_text_name; ?> »</a>
                <?php } else { ?>
                  <a class="btn btn-primary-green" data-form="continue" href="javascript:void(0);" onclick="javascript:continue_cart();"><?php echo $a_button_text_name; ?> »</a>              
                <?php } ?>              
            <?php } ?>

          </div>
      </div>
   </div>
 </div>
