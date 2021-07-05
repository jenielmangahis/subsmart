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
                                <h3 class="page-title" style="margin-top: 5px;margin-bottom:10px;"><i class="fa fa-edit"></i> Edit Industry Type</h3>
                            </div>
                        </div>
                        <div class="pl-3 pr-3 mt-0 row">
                            <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Edit industry type</span>
                            </div>
                        </div>
                        <br />
                        <?php include viewPath('flash'); ?>
                        <?php echo form_open_multipart('admin/update_industry_type', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                          <input type="hidden" name="type_id" value="<?= $industryType->id; ?>">
                          <div class="form-group">
                              <label>Industry Type Name</label> <span class="form-required">*</span>
                              <input type="text" name="name" value="<?= $industryType->name; ?>" class="form-control" required="" autocomplete="off" />
                          </div>
                          <br />
                          <br />
                          <div class="form-group">
                              <label>Business Type Name</label> <span class="form-required">*</span><br />
                              <select class="form-control cmb-industry" id="business_type_name" name="business_type_name" required="" style="width: 40%;">
                                 <?php foreach( $businessTypes as $businessType ){ ?>
                                      <option value="<?php echo $businessType; ?>" <?php if($businessTypeName==$businessType){ ?> selected  <?php  } ?>><?php echo $businessType; ?></option>
                                  <?php } ?>
                              </select>
                          </div>
                          <br />
                          <div class="form-group">
                              <label>Industry Template Name</label> <span class="form-required">*</span><br />
                              <select class="form-control cmb-industry" id="industry_template_id" name="industry_template_id" required="" style="width: 40%;">
                                <option>--Select your Industry--</option>
                                  <?php foreach( $industryTemplate as $indTemplate ){ ?>
                                      <option value="<?php echo $indTemplate->id; ?>" <?php if($industryType->industry_template_id==$indTemplate->id){ ?> selected  <?php  } ?>><?php echo $indTemplate->name; ?></option>
                                  <?php } ?>
                              </select>
                          </div>   
                          <br />
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-sm-4">
                                      <div class="form-group">
                                          <label>Status</label> <span class="form-required">*</span>
                                          <select name="status" class="form-control" autocomplete="off">
                                                <option <?= $industryType->status == 1? 'selected="selected"' : ''; ?> value="1">Active</option>
                                                <option <?= $industryType->status == 0 ? 'selected="selected"' : ''; ?> value="0">Inactive</option>
                                          </select>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-">
                            <a class="btn btn-default" href="<?php echo base_url('admin/industry_type'); ?>">Cancel</a>
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
<?php include viewPath('includes/footer_plan_builder'); ?>
<?php include viewPath('includes/admin_footer'); ?>