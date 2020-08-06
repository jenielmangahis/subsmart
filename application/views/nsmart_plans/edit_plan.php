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
                        <h1 class="page-title"><i class="fa fa-pencil"></i> Edit Plan</h1>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <hr />
                        <?php include viewPath('flash'); ?>
                        <?php echo form_open_multipart('nsmart_plans/update_plan', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                          <input type="hidden" name="plan_id" value="<?= $nSmartPlan->nsmart_plans_id; ?>">
                          <div class="form-group">
                              <label>Plan Name</label> <span class="form-required">*</span>
                              <input type="text" name="plan_name" value="<?= $nSmartPlan->plan_name; ?>" class="form-control" required="" autocomplete="off" />
                          </div>
                          <div class="form-group">
                              <label>Description</label> <span class="form-required">*</span>
                              <textarea class="form-control" style="height: 200px !important;" required="" name="plan_description"><?= $nSmartPlan->plan_description; ?></textarea>
                          </div>
                          <br />
                          <div class="form-group">
                            <div class="row">
                                  <div class="col-sm-8">
                                      <label>Price</label>
                                      <div class="input-group">
                                        <div class="input-group-addon" data-for="plan_price">
                                            <span class="fa fa-dollar"></span>
                                        </div>
                                        <input type="number" name="plan_price" value="<?= $nSmartPlan->price; ?>" id="plan_price" class="form-control" required="" autocomplete="off" />
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-sm-4">
                                      <div class="form-group">
                                          <label>Discount</label> <span class="form-required">*</span>
                                          <input type="number" name="plan_discount" value="<?= $nSmartPlan->discount; ?>" id="plan_discount" class="form-control" required="" autocomplete="off" />
                                      </div>
                                  </div>
                                  <div class="col-sm-4">
                                      <div class="form-group">
                                          <label>Percent</label> <span class="form-required">*</span>
                                          <select name="plan_discount_type" class="form-control">
                                            <?php foreach( $option_discount_types as $key => $value ){ ?>
                                                <option <?= $nSmartPlan->discount_type == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
                                            <?php } ?>
                                          </select>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-sm-4">
                                      <div class="form-group">
                                          <label>Status</label> <span class="form-required">*</span>
                                          <select name="plan_status" class="form-control" autocomplete="off">
                                            <?php foreach($option_status as $key => $value){ ?>
                                                <option <?= $nSmartPlan->status == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
                                            <?php } ?>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-sm-4">
                                    <a class="btn btn-danger btn-delete-plan" href="javascript:void(0);" data-id="<?= $nSmartPlan->nsmart_plans_id; ?>" style="margin-top: 28px;">Delete</a>
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-">
                            <a class="btn btn-default" href="<?php echo base_url('nsmart_plans/index'); ?>">Cancel</a>
                            
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
<?php include viewPath('includes/plan_builder_modals'); ?> 
<?php include viewPath('includes/footer_plan_builder'); ?>