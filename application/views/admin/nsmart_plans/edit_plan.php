<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/admin_header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/admin/nsmart_plans'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <div class="row align-items-center">
                            <div class="col-sm-12">
                                <h3 class="page-title" style="margin-top: 5px;margin-bottom:10px;"><i class="fa fa-edit"></i> Edit Plan</h3>
                            </div>
                        </div>
                        <div class="pl-3 pr-3 mt-0 row">
                            <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Edit plan</span>
                            </div>
                        </div>
                        <br />
                        <?php include viewPath('flash'); ?>
                        <?php echo form_open_multipart('admin/update_nsmart_plan', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
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
                                      <label>Plan Price</label> <span class="form-required">*</span> 
                                      <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" name="plan_price" value="<?= $nSmartPlan->price; ?>" id="plan_price" class="form-control" required="" autocomplete="off" min="0" step="0.01" />
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                                  <div class="col-sm-4">
                                      <label>Price Per License</label> <span class="form-required">*</span> 
                                      <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" name="price_per_license" value="<?= $nSmartPlan->price_per_license; ?>" id="price_per_license" class="form-control" required="" autocomplete="off" min="0" step="0.01" />
                                      </div>
                                  </div>
                                  <div class="col-sm-4">
                                      <div class="form-group">
                                          <label>Default Number of License</label> <span class="form-required">*</span>
                                          <input type="number" name="num_license" id="num_license" class="form-control" value="<?= $nSmartPlan->num_license; ?>" required="" autocomplete="off" min="1"/>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-sm-4">
                                      <div class="form-group">
                                          <label>Discount</label> <span class="form-required">*</span>
                                          <input type="number" name="plan_discount" value="<?= $nSmartPlan->discount; ?>" id="plan_discount" class="form-control" required="" autocomplete="off" min="0" step="0.01" />
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
                              </div>
                          </div>

                          <div class="col-md-">
                            <a class="btn btn-default" href="<?php echo base_url('admin/nsmart_plans'); ?>">Cancel</a>
                            
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
<?php include viewPath('includes/admin_footer'); ?>