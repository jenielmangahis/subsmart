<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/nsmart_plans'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title"><i class="fa fa-pencil"></i> Edit Offer Code</h1>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <hr />
                        <?php include viewPath('flash'); ?>
                        <?php echo form_open_multipart('offer_codes/update_edit_offer', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                          <input type="hidden" name="offer_id" value="<?= $offerCodes->id; ?>">
                          <div class="form-group">
                              <label>Offer Code</label> <span class="form-required">*</span>
                              <input type="text" name="offer_code" value="<?= $offerCodes->offer_code; ?>" class="form-control" required="" autocomplete="off" />
                          </div>
                          <div class="form-group">
                            <div class="row">
                                  <div class="col-sm-6">
                                       <label>Trial days</label> <span class="form-required">*</span>
                                      <div class="input-group">
                                        <div class="input-group-addon" data-for="service_fee">
                                            
                                        </div>
                                        <input type="number" name="trial_days" value="<?= $offerCodes->trial_days; ?>" id="trial_days" class="form-control" required="" autocomplete="off" min="0" step="1" />
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <br />
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-sm-4">
                                      <div class="form-group">
                                          <label>Status</label> <span class="form-required">*</span>
                                          <select name="status" class="form-control" autocomplete="off">
                                                <option <?= $offerCodes->status == 1? 'selected="selected"' : ''; ?> value="1">Active</option>
                                                <option <?= $offerCodes->status == 0 ? 'selected="selected"' : ''; ?> value="0">Unused</option>
                                          </select>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-">
                            <a class="btn btn-default" href="<?php echo base_url('offer_codes/index'); ?>">Cancel</a>
                            
                            <button type="submit" class="btn btn-primary">Update</button>
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
<?php include viewPath('includes/plan_builder_modals'); ?> 
<?php include viewPath('includes/footer_plan_builder'); ?>