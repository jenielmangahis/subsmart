<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/admin_header'); ?>
<style>
.list-modules{
  list-style: none;
}
.list-modules li{
  display: inline-block;
  width: 30%;
  margin: 10px;
}
</style>
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
                                <h3 class="page-title" style="margin-top: 5px;margin-bottom:10px;"><i class="fa fa-check"></i> Assign Modules to Template</h3>
                            </div>
                        </div>
                        <div class="pl-3 pr-3 mt-0 row">
                            <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Assign industry modules to templates</span>
                            </div>
                        </div>
                        <br />
                        <?php include viewPath('flash'); ?>
                        <?php echo form_open_multipart('admin/update_industry_template_modules', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                          <input type="hidden" name="template_id" value="<?= $industryTemplate->id; ?>">
                          <div class="form-group">
                              <label>Template Name</label> <span class="form-required">*</span>
                              <input type="text" name="name" value="<?= $industryTemplate->name; ?>" class="form-control" required="" autocomplete="off" />
                          </div>
                          <br />
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="form-check">
                                          <label>Assign Modules</label> <span class="form-required"></span>
                                          <ul class="list-modules">
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
                                                        <li>
                                                          <div class="checkbox">
                                                            <input type="checkbox" <?php echo $checked; ?> class="form-check-input" name="modules[]" id="module-<?= $industryModule->id; ?>" value="<?php echo $industryModule->id; ?>" >
                                                           <label class="" for="module-<?= $industryModule->id; ?>"><?php echo $industryModule->name; ?></label>
                                                          </div>
                                                        </li>
                                               <?php }
                                                }  ?>
                                          </ul>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-">
                            <a class="btn btn-default" href="<?php echo base_url('admin/industry_template'); ?>">Cancel</a>
                            
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
<?php include viewPath('includes/admin_footer'); ?>