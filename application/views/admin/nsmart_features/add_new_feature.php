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
                                <h3 class="page-title" style="margin-top: 5px;margin-bottom:10px;"><i class="fa fa-plus"></i> Add Feature</h3>
                            </div>
                        </div>
                        <div class="pl-3 pr-3 mt-0 row">
                            <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Create new plan feature</span>
                            </div>
                        </div>
                        <br />
                        <?php include viewPath('flash'); ?>
                        <?php echo form_open_multipart('admin/create_nsmart_feature', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>

                          <div class="form-group">
                              <label>Feature Name</label> <span class="form-required">*</span>
                              <input type="text" name="feature_name" value=""  class="form-control" required="" autocomplete="off" />
                          </div>
                          <div class="form-group">
                              <label>Description</label> <span class="form-required">*</span>
                              <textarea class="form-control" style="height: 200px !important;" required="" name="feature_description"></textarea>
                          </div>
                         
                          <div class="form-group">
                            <label>Select Heading</label>
                            <select name="feature_heading" class="form-control">
                              <?php foreach($planHeadings as $p) { ?>
                                <option value="<?php echo $p->id; ?>"><?php echo $p->title; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          
                          <div class="form-group">
                            <label>Select Plans</label>
                              <?php foreach($plans as $pln) { ?>
                                      <div class="input-group-text" style="margin-bottom: 10px; margin-left: 15px;">
                                        <input type="checkbox" name="plans[<?= $pln->nsmart_plans_id; ?>]" aria-label="Checkbox for following text input">
                                          &nbsp;&nbsp;<?php echo $pln->plan_name; ?>
                                      </div> 
                              <?php } ?>                         
                          </div>
                          

                          <div class="col-md-">
                            <a class="btn btn-default" href="<?php echo base_url('admin/nsmart_features'); ?>">Cancel</a>
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
<?php include viewPath('includes/admin_footer'); ?>