<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.page-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
}
.cell-inactive{
    background-color: #d9534f;
}
.left {
  float: left;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.p-40 {
  padding-top: 40px !important;
}
.tabs-menu {
    margin-bottom: 20px;
    padding: 0;
    margin-top: 20px;
}
.tabs-menu ul {
    list-style: none;
    margin: 0;
    padding: 0;
}
.md-right {
  float: right;
  width: max-content;
  display: block;
  padding-right: 0px;
}
.tabs-menu .active, .tabs-menu .active a {
    color: #2ab363;
}
.tabs-menu li {
    float: left;
    margin: 0;
    padding: 0px 83px 0px 0px;
    font-weight: 600;
    font-size: 17px;
}
label>input {
 visibility: visible;
 position: inherit;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/marketing'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <?php echo form_open_multipart('email_automation/save_template', ['class' => 'form-validate', 'id' => 'create_email_template', 'autocomplete' => 'off']); ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mt-0">

                        <div class="row">
                          <div class="col-sm-6 left">
                            <h3 class="page-title">Add Template</h3>
                          </div>                          
                        </div>
                        <div class="alert alert-warning mt-2 mb-0" role="alert">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Set a name and enter email subject and body.
                            </span>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8 form-group">
                                    <label for=""><b>Template Name</b><br /><small>For your reference.</small></label>
                                    <input type="text" class="form-control" name="name" id="" required placeholder="" autofocus/>
                                </div>
                            </div>

                            <div class="row">
                              <div class="col-md-8">
                                  <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="formClient-Name">Subject</label>
                                        <input type="text" class="form-control" name="email_subject" value="" id="email_subject" required placeholder="" autofocus/>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="formClient-Name">Email Body</label>
                                        <textarea name="email_body" cols="40" rows="30"  class="form-control" id="email_body" autocomplete="off"></textarea>
                                    </div>
                                  </div>                                  
                              </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-4 form-group md-right">                                    
                                    <button type="submit" class="btn btn-flat btn-primary margin-right btn-automation-save-draft" style="float: left;margin-right: 0px;">Save</button>
                                    <a class="btn btn-default" href="<?php echo url('email_automation/templates') ?>" style="float: left;margin-right: 10px;">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <?php echo form_close(); ?>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<script>
$(function(){
    // instance, using default configuration.
    CKEDITOR.replace('email_body', {
        height: '400'
        //removePlugins: 'toolbar',
        //allowedContent: 'p h1 h2 strong em; a[!href]; img[!src,width,height] alignment;'
    });

    CKEDITOR.config.allowedContent = true;
});
</script>
