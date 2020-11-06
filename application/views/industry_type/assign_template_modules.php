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
                        <h1 class="page-title"><i class="fa fa-pencil"></i> Assign Modules to Template</h1>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <hr />
                        <?php include viewPath('flash'); ?>
                        <?php echo form_open_multipart('industry_template/update_template_modules', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                          <input type="hidden" name="template_id" value="<?= $industryTemplate->id; ?>">
                          <div class="form-group">
                              <label>Template Name</label> <span class="form-required">*</span>
                              <input type="text" name="name" value="<?= $industryTemplate->name; ?>" class="form-control" required="" autocomplete="off" />
                          </div>
                          <br />
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-sm-3">
                                      <div class="form-group">
                                          <label>Assign Modules</label> <span class="form-required"></span>

                                          <?php if($industryModules){ 
                                                      $module_id = array();
                                                      if($industryTemplateModules) {
                                                        foreach ($industryTemplateModules as $key => $industryTemplateModule) {
                                                           $module_id[] = $industryTemplateModule->industry_module_id;
                                                        }
                                                      }


                                                     foreach ($industryModules as $key => $industryModule) {   
                                                         $checked = "";
                                                             if(in_array($industryModule->id, $module_id)  ){$checked = "checked";    }                  ?>
                                                        <div class="form-check">
                                                         <label class="form-check-label" for="exampleCheck1"> <input type="checkbox" <?php echo $checked; ?> class="form-check-input" name="modules[]" id="modules[]" value="<?php echo $industryModule->id; ?>" >
                                                          <?php echo $industryModule->name; ?></label>
                                                        </div>
                                               <?php }
                                                }  ?>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-">
                            <a class="btn btn-default" href="<?php echo base_url('industry_template/index'); ?>">Cancel</a>
                            
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