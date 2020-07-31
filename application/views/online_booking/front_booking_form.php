<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_front_booking'); ?>
<div>
    <!-- page wrapper start -->
    <div class="col-xl-9 left">
        <div class="container-fluid pl-0 pr-0">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title-v2">Your contact details</h1>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                  <div class="sc-name">Please input your contact details to complete this booking.</div>
                </div>
            </div>
            <div class="row pt-4 enable-scroll">
                <div class="col-6 left">
                  <form>
                    <div class="margin-bottom">

                      <div class="form-group-booking">
                        <label>Full name</label>
                        <span class="form-required">*</span>
                        <input type="text" id="full_name" name="full_name" class="form-control">
                      </div>

                      <div class="form-group-booking">
                        <label>Contact number</label>
                        <span class="form-required">*</span>
                        <input type="text" name="contact_number" id="contact_number" class="form-control">
                      </div>

                      <?php foreach ($forms as $key => $form) { ?>

                          <?php if($form->is_visible == 1){ ?>
                              <div class="form-group-booking">
                                <label><?php echo $form->label; ?></label>
                                <?php if($form->is_required == 1){ ?><span class="form-required">*</span> <?php } ?>
                                    <?php if($form->field_name == "message" ){ ?>
                                        <textarea rows="2" name="message" id="message" class="form-control booking-txt-area"></textarea>
                                    <?php }elseif($form->field_name == "preferred_time_to_contact" ){ ?>      
                                          <select name="preferred_time_to_contact" id="preferred_time_to_contact" class="form-control">
                                            <option value="0" selected="selected">Any time</option>
                                            <option value="1">7am to 10am</option>
                                            <option value="2">10am to Noon</option>
                                            <option value="3">Noon to 4pm</option>
                                            <option value="4">4pm to 7pm</option>
                                          </select> 
                                    <?php }else{ ?>
                                          <input type="text" id="<?php echo $form->field_name; ?>" name="<?php echo $form->field_name; ?>" class="form-control">
                                    <?php }?>    
                              </div>                          
                          <?php } ?> 
                        
                       <?php }  ?>

                    </div>
                  </form>
                  <hr class="card-hr">
                  <div class="col-6 pl-1">
                    <a class="btn btn-primary-green" data-form="continue" href="#" onclick="javascript:continue_cart();">Book now</a>
                 </div>
                </div>
                <div class="col-6 left">
                  <div class="margin-bottom ptc-4">
                    <div class="weight-bold">Scheduled Date and Time</div>
                    <div>31-Jul-2020 8:00am-10:00am</div>
                  </div>
                  <div class="margin-bottom pt-4">
                    <div class="weight-bold">Service & Items</div>
                    <div>Items: 1, Total: $180.00</div>
                  </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <div class="col-xl-3 container-full-col">
      <div class="widget-cnt-right">
         <div class="widget-cnt-right__child">
            <div class="widget-cart margin-bottom-sec" data-cart="cart">
               <?php include viewPath('includes/sidebars/front_items_cart'); ?>
            </div>
         </div>
      </div>
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer_front_booking'); ?>
