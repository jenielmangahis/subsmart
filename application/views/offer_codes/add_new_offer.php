<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_plan_builder'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/nsmart_plans'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title"><i class="fa fa-plus"></i> Add Offer Code</h1>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <hr />
                        <?php include viewPath('flash'); ?>
                        <?php echo form_open_multipart('offer_codes/create_offer_code', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>

                          <div class="form-group">
                              <label>Offer Code</label> <span class="form-required">*</span>
                              <input type="text" name="offer_code" value=""  class="form-control" required="" autocomplete="off" />
                          </div>
                           <div class="form-group">
                            <div class="row">
                                  <div class="col-sm-6">
                                       <label>Trial days</label> <span class="form-required">*</span>
                                      <div class="input-group">
                                        <div class="input-group-addon" data-for="service_fee">
                                            
                                        </div>
                                        <input type="number" name="trial_days" value="30" id="trial_days" class="form-control" required="" autocomplete="off" min="0" step="1" />
                                      </div>
                                  </div>
                              </div>
                          </div>
                          
                          <div class="col-md-">
                            <a class="btn btn-default" href="<?php echo base_url('offer_codes/index'); ?>">Cancel</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>

                      </div>
                      <?php echo form_close(); ?>
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
<?php include viewPath('includes/footer_plan_builder'); ?>