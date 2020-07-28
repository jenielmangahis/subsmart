<div class="col-xl-3 container-full-col">
   <div class="widget-cnt-right">
      <div class="widget-cnt-right__child">
         <div class="business">
            <?php 
              $profile_image = $userProfile->profile_img;
              if(file_exists('uploads/users/user-profile/' . $profile_image) == FALSE || $profile_image == null) {
                  
                  $profile_image = base_url('/assets/dashboard/images/online-booking.png');
                  if(file_exists('uploads/service_item/' . $service_item_thumb) == FALSE || $service_item_thumb == null) {
                      $profile_image = base_url('/assets/dashboard/images/online-booking.png');
                  } else {
                      $profile_image = base_url('uploads/users/user-profile/'.$profile_image);
                  }


              } else {
                  $profile_image = base_url('uploads/users/user-profile/'.$profile_image);
              }
            ?>
            <img class="business__logo" src="<?php echo $profile_image; ?>">
            <div class="business__cnt">
               <div class="business__name"><?php echo $userProfile->FName . ' ' . $userProfile->LName; ?></div>
               <div class="business__phone"><?php echo $userProfile->phone; ?></div>
            </div>
         </div>
         <div class="widget-cart margin-bottom-sec" data-cart="cart">
            <div style="font-size: 18px; margin-bottom: 15px;">
               <span class="fa fa-shopping-cart fa-margin-right"></span> Cart Total:
               $10.00    <span class="text-ter">(1 item)</span>
            </div>
            <div>
               <div data-item-rowid="975e79cac5282d1bc137abac18fd8ed1" style="position: relative; margin-bottom: 10px;">
                  <div style="color: #487ca6;">Sample Cleaning</div>
                  <div class="text-ter" style="margin-bottom: 3px; padding-right: 20px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">this is a sample description of category</div>
                  <div>1 x $10.00/each</div>
                  <a class="a-ter" data-cart="delete" data-id="975e79cac5282d1bc137abac18fd8ed1" href="#" style="position: absolute; top: 2px; right:0"><span class="fa fa-trash"></span></a>
               </div>
            </div>
            <div class="validation validation-error margin-top-sec">
               Minimum booking amount is $50.00<br>
            </div>
         </div>
         <div class="coupon">
            <div class="coupon__code">
               <input type="text" name="coupon_code" value="" class="form-control form-control-md" placeholder="Enter coupon code" data-coupon="coupon_code">
            </div>
            <button class="btn btn-default btn-md coupon__btn" data-coupon="btn_submit" name="coupon_btn" type="submit">Apply</button>
         </div>
         <hr class="margin-top margin-bottom">
         <div class="text-right">
            <a class="btn btn-primary-green disabled" data-form="continue" href="#">Continue »</a>
         </div>
      </div>
   </div>
 </div>