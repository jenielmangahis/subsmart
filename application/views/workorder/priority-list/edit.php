<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.page-title, .box-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
  padding-top: 0px;
  position: relative;
  bottom: 2px;
}
.pr-b10 {
  position: relative;
  bottom: 15px;
}
.page-title-box {
    padding-bottom: 2px !important;
    padding-top: 10px !important;
}
.float-right.d-none.d-md-block {
    position: relative;
    top: 0px;
}
.p-40 {
  padding-top: 40px !important;
}
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 20px !important;
  padding-left: 20px !important;
}
@media only screen and (max-width: 600px) {
  .p-40 {
    padding-top: 0px !important;
  }
  .float-right.d-none.d-md-block {
      position: relative;
      bottom: 0px;
  }
  .pr-b10 {
    position: relative;
    bottom: 0px;
  }
}
</style>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/notifications'); ?>
    <?php include viewPath('includes/sidebars/schedule'); ?>
    <div wrapper__section>
        <div class="container-fluid p-40">
            <section class="content">
                <!-- Default box -->
                <div class="box">
                    <!--
                    <div class="page-title-box">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <h1 class="page-title">New Priority</h1>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active">Set priority name.</li>
                                </ol>
                            </div>
                            <div class="col-sm-6">
                                <div class="float-right d-none d-md-block">
                                    <div class="dropdown">
                                        <a href="<?php echo url('workorder/priority/') ?>" class="btn btn-primary"
                                           aria-expanded="false">
                                            <i class="mdi mdi-settings mr-2"></i> Go Back to Job Type
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    -->
                    <?php echo form_open('workorder/priority/save', ['class' => 'form-validate', 'method' => 'post']); ?>
                    <?php if (!empty($priority)) { ?>
                        <input type="hidden" name="id" value="<?php echo $priority->id ?>">
                    <?php } ?>
                    <div class="row custom__border">
                        <div class="col-xl-12">
                            <div class="card">

                                <div class="page-title-box" style="padding-top:0px;">
                                    <div class="row align-items-center">
                                        <div class="col-sm-6">
                                            <h3 class="page-title">Edit Priority</h3>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="float-right d-none d-md-block">
                                              <div class="dropdown">
                                                  <a href="<?php echo url('workorder/priority/') ?>" class="btn btn-primary"
                                                     aria-expanded="false">
                                                      <i class="mdi mdi-settings mr-2"></i> Go Back to List
                                                  </a>
                                              </div>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pl-3 pr-3 mt-2 row">
                                  <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                      <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Here is where you will create how you want to name the events or jobs on the calendar. This priority list is where you assigned the most important thing you have to do or deal with, or must be done or dealt with before everything else you have to do. It can be based on the most important to least important base on funding or state of need.</span>
                                  </div>
                                </div>

                                <div class="card-body" style="padding:0px;">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="title">Name *</label>
                                                <input type="text" class="form-control" name="title" id="title" value="<?php echo (!empty($priority)) ? $priority->title : '' ?>" required
                                                       placeholder="Enter title" autofocus/>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mt-1">
                                            <button type="submit" class="btn btn-flat btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php echo form_close(); ?>
                </div>
                <!-- /.box -->
            </section>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
    $(document).ready(function () {
        $('.form-validate').validate();
    })
</script>
