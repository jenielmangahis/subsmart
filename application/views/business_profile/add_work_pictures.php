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
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/marketing'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <?php //echo form_open_multipart('sms_automation/save', ['class' => 'form-validate', 'id' => 'create_sms_automation', 'autocomplete' => 'off']); ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mt-0">

                        <div class="row">
                          <div class="col-sm-6 left">
                            <h3 class="page-title">Add Work Pictures</h3>
                          </div>
                          <div class="col-sm-6 right dashboard-container-1">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                        <a href="<?php echo url('users/portfolio') ?>" class="btn btn-primary" aria-expanded="false">
                                            <i class="mdi mdi-settings mr-2"></i> Go Back to list
                                        </a>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="alert alert-warning mt-2 mb-0" role="alert">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                            </span>
                        </div>

                        <div class="card-body">
                                
                                <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
                                <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
                                <!-- Change /upload-target to your upload address -->
                                <form action="<?= url('users/upload_work_pictures'); ?>" class="dropzone"></form>
                            
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <?php //echo form_close(); ?>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php //include viewPath('includes/footer'); ?>
<script>
$(document).ready(function(){
});
</script>



