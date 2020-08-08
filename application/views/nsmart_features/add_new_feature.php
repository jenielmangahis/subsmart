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
                        <h1 class="page-title"><i class="fa fa-plus"></i> Add Feature</h1>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <hr />
                        <?php include viewPath('flash'); ?>
                        <?php echo form_open_multipart('nsmart_feature/create_feature', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>

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
                              <div class="input-group-text" style="margin-bottom: 10px; margin-left: 15px;">
                                <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;Simple Start
                              </div>  
                              <div class="input-group-text" style="margin-bottom: 10px; margin-left: 15px;">
                                <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;Issentials
                              </div>                          
                          </div>
                          

                          <div class="col-md-">
                            <a class="btn btn-default" href="<?php echo base_url('nsmart_features/index'); ?>">Cancel</a>
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