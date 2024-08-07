<div class="col-xl-3 container-full-col">
   <div class="widget-cnt-right">
      <div class="widget-cnt-right__child">
         <div class="business">
            <?php
              $profile_image = businessProfileImage($bussinessProfile->id);
              if( $profile_image == null ) {
                  $profile_image = base_url('/assets/dashboard/images/online-booking.png');
              }
            ?>
            <img class="business__logo" src="<?php echo $profile_image; ?>">
            <div class="business__cnt">
               <div class="business__name"><b><?php echo $bussinessProfile->business_name; ?></b></div>
               <div class="business__phone"><?php echo isset($bussinessProfile->business_phone) ? $bussinessProfile->business_phone : ''; ?></div>
            </div>
         </div>
         <div class="widget-cart margin-bottom-sec" data-cart="cart">

            <div style="font-size: 18px; margin-bottom: 15px;">

                <?php 
                  $discounted_amount = 0;
                  if(isset($coupon)) {
                    
                    if(isset($coupon['coupon']['type'])){ 
                      if($coupon['coupon']['type'] == 1) {
                        $new_total_amount  = ($coupon['coupon']['coupon_amount'] / 100) * $cart_data['total_amount'];                        
                      }else {
                        $new_total_amount =  $cart_data['total_amount'] - $coupon['coupon']['coupon_amount'];
                      } 
                    }else {
                        $new_total_amount =  $cart_data['total_amount'] - $coupon['coupon']['coupon_amount'];
                    }

                    $discounted_amount = $cart_data['total_amount'] - $new_total_amount;

                  }else{
                    $new_total_amount =  $cart_data['total_amount'] ;
                  }  
                ?>
               <span class="fa fa-shopping-cart fa-margin-right"></span> Cart Total:
               $<span class="total_cart_amount"><?php echo number_format($new_total_amount, 2); ?></span>   <span class="text-ter">(<?php echo count($cart_data['items']) ?> item(s))</span>

            </div>
            <div>
                <?php $is_cont_button_enable = true; $item_total_arr = array();?>
                <?php $sub_total = 0; $item_sub_total = 0; ?>
                <?php foreach($cart_data['items'] as $item){ ?>
                  
                  <div style="position: relative; margin-bottom: 10px;">
                    <div style="color: #487ca6;"><?php echo $item->name; ?></div>
                    <div class="text-ter" style="margin-bottom: 3px; padding-right: 20px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $item->description; ?></div>
                    <div><?php echo $item->ordered_qty; ?> x $<?php echo number_format($item->price,2); ?>/<?php echo $item->price_unit; ?></div>
                    <a class="a-ter delete-cart-item" data-id="<?php echo $item->id; ?>" href="javascript:void(0);" style="position: absolute; top: 2px; right:0"><span class="fa fa-trash"></span></a>
                  </div>
                  <?php 
                    $sub_total = $item->ordered_qty * $item->price;
                    $item_sub_total += $sub_total;
                    $item_total_arr['grand_total'] = $item_sub_total;
                  ?>
                <?php } ?>
                <?php $is_with_coupon = 0;  ?>
                <?php if(isset($coupon)){  ?>
                    <?php $is_with_coupon = 1;  ?>
                    <div style="position: relative; margin-bottom: 10px;">
                      <div style="color: #487ca6;"><?php echo "Coupon name: ". $coupon['coupon']['coupon_name']; ?></div>
                      <div class="text-ter" style="margin-bottom: 3px; padding-right: 20px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo "Coupon code: ". $coupon['coupon']['coupon_code'] ; ?></div>
                      <?php if(isset($coupon['coupon']['type'])){
                                if($coupon['coupon']['type'] == 1) { ?>
                                <div><?php echo $coupon['coupon']['coupon_amount'] . "% off" ; ?> / less <?php echo number_format($discounted_amount, 2); ?></div>
                          <?php } else { ?>
                                 <div><?php echo "$". number_format($coupon['coupon']['coupon_amount'],2). " off" ; ?></div>
                          <?php } ?>
                      <?php } else { ?>
                                <div><?php echo "$". number_format($coupon['coupon']['coupon_amount'],2). " off" ; ?></div>
                      <?php } ?>
                      
                      <a class="a-ter delete-coupon" data-id="1" href="javascript:void(0);" style="position: absolute; top: 2px; right:0"><span class="fa fa-trash"></span></a>
                    </div>
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
            <?php if( !empty($booking_schedule) ){ ?>
              <hr />
              <div class="schedule-container">
                <div style="color: #487ca6;">Selected Schedule</div>
                <div class="text-ter"><?php echo date("F d, Y", strtotime($booking_schedule['date'])) . ' - ' . $booking_schedule['time_start'] . ' - ' . $booking_schedule['time_end']; ?></div>
              </div>
            <?php } ?>
            <?php if($booking_settings->minimum_price_for_entier_booking >= 1) { ?>
              <hr />
              <div class="alert alert-danger">
                Minimum booking amount is <strong>$<?php echo number_format($booking_settings->minimum_price_for_entier_booking,2); ?></strong>
              </div>
            <?php } ?>
         </div>
          <?php if( $is_with_coupon == 0 ){ ?>
          <div class="coupon">
              <div class="coupon__code">
                 <input type="text" name="coupon_code" id="coupon_code" value="" class="form-control form-control-md" placeholder="Enter coupon code" data-coupon="coupon_code">
              </div>
              <a class="btn btn-default btn-md coupon__btn btn-apply-coupon" data-id="<?php echo $eid; ?>" href="javascript:void(0);">Apply</a>
          </div> 
          <?php } ?>
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
