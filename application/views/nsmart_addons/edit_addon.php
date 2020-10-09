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
                        <?php echo form_open_multipart('nsmart_addons/update_addon', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                          <input type="hidden" name="addon_id" value="<?= $nSmartAddon->id; ?>">
                          <div class="form-group">
                              <label>Name</label> <span class="form-required">*</span>
                              <input type="text" name="addon_name" value="<?= $nSmartAddon->name; ?>" class="form-control" required="" autocomplete="off" />
                          </div>
                          <div class="form-group">
                              <label>Description</label> <span class="form-required">*</span>
                              <textarea class="form-control" style="height: 200px !important;" required="" name="description"><?= $nSmartAddon->description; ?></textarea>
                          </div>
                          <br />
                          <div class="form-group">
                            <div class="row">
                                  <div class="col-sm-8">
                                      <label>Price</label>
                                      <div class="input-group">
                                        <div class="input-group-addon" data-for="addon_price">
                                            <span class="fa fa-dollar"></span>
                                        </div>
                                        <input type="number" name="price" value="<?= $nSmartAddon->price; ?>" id="price" class="form-control" required="" autocomplete="off" min="0" step="0.01" />
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
                                            <?php foreach($option_status as $key => $value){ ?>
                                                <option <?= $nSmartAddon->status == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
                                            <?php } ?>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-sm-4">
                                    <a class="btn btn-danger btn-delete-plan" href="javascript:void(0);" data-id="<?= $nSmartAddon->id; ?>" style="margin-top: 28px;">Delete</a>
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-">
                            <a class="btn btn-default" href="<?php echo base_url('nsmart_addons/index'); ?>">Cancel</a>
                            
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