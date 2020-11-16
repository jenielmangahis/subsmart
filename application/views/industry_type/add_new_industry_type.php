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
                        <h1 class="page-title"><i class="fa fa-plus"></i> Add Industry Type</h1>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <hr />
                        <?php include viewPath('flash'); ?>
                        <?php echo form_open_multipart('industry_type/create_type', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>

                          <div class="form-group">
                              <label>Industry Type Name</label> <span class="form-required">*</span>
                              <input type="text" name="name" value=""  class="form-control" required="" autocomplete="off" />
                          </div>
                          <br />
                          <div class="form-group">
                              <label>Business Type Name</label> <span class="form-required">*</span>
                              <select class="reg-select z-100 cmb-industry" id="business_type_name" name="business_type_name" required="">
                                 <?php foreach( $businessTypes as $businessType ){ ?>
                                      <option value="<?php echo $businessType; ?>"><?php echo $businessType; ?></option>
                                  <?php } ?>
                              </select>
                          </div>
                          <br />
                          <div class="col-md-6 float-left">
                            <div class="input-group">
                              <label>Industry Template Name</label> <span class="form-required">*</span>
                              <select class="reg-select z-100 cmb-industry" id="industry_template_id" name="industry_template_id" required="">
                                <option>--Select your Industry--</option>
                                  <?php foreach( $industryTemplate as $indTemplate ){ ?>
                                      <option value="<?php echo $indTemplate->id; ?>"><?php echo $indTemplate->name; ?></option>
                                  <?php } ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-5">
                            <a class="btn btn-default" href="<?php echo base_url('industry_type/index'); ?>">Cancel</a>
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