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
                        <h1 class="page-title"><i class="fa fa-pencil"></i> Edit Addon</h1>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <hr />
                        <?php include viewPath('flash'); ?>
                        <?php echo form_open_multipart('nsmart_upgrades/update_upgrade', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                          <input type="hidden" name="upgrade_id" value="<?= $nSmartUpgrades->id; ?>">
                          <div class="form-group">
                              <label>Name</label> <span class="form-required">*</span>
                              <input type="text" name="upgrade_name" value="<?= $nSmartUpgrades->name; ?>" class="form-control" required="" autocomplete="off" />
                          </div>
                          <div class="form-group">
                              <label>Description</label> <span class="form-required">*</span>
                              <textarea class="form-control" style="height: 200px !important;" required="" name="description"><?= $nSmartUpgrades->description; ?></textarea>
                          </div>
                          <br />
                          <div class="form-group">
                            <div class="row">
                                  <div class="col-sm-8">
                                      <label>SMS Fee</label>
                                      <div class="input-group">
                                        <div class="input-group-addon" data-for="addon_price">
                                            <span class="fa fa-dollar"></span>
                                        </div>
                                        <input type="number" name="sms_fee" value="<?= $nSmartUpgrades->sms_fee; ?>" id="sms_fee" class="form-control" required="" autocomplete="off" min="0" step="0.01" />
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <br />
                          <div class="form-group">
                            <div class="row">
                                  <div class="col-sm-8">
                                      <label>Service Fee</label>
                                      <div class="input-group">
                                        <div class="input-group-addon" data-for="addon_price">
                                            <span class="fa fa-dollar"></span>
                                        </div>
                                        <input type="number" name="service_fee" value="<?= $nSmartUpgrades->service_fee; ?>" id="service_fee" class="form-control" required="" autocomplete="off" min="0" step="0.01" />
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-sm-4">
                                      <div class="form-group">
                                          <label>Status</label> <span class="form-required">*</span>
                                          <select name="status" class="form-control" autocomplete="off">
                                      <option <?= $nSmartUpgrades->status == 1 ? 'selected="selected"' : ''; ?> value="1">Active</option>
                                      <option <?= $nSmartUpgrades->status == 0 ? 'selected="selected"' : ''; ?> value="0">Inactive</option>     
                                          </select>
                                      </div>
                                  </div>
                                  
                              </div>
                          </div>

                          <div class="col-md-">
                            <a class="btn btn-default" href="<?php echo base_url('nsmart_upgrades/index'); ?>">Cancel</a>
                            
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