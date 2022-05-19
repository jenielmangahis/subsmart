<style>
    .page-title, .box-title {
      font-family: Sarabun, sans-serif !important;
      font-size: 1.75rem !important;
      font-weight: 600 !important;
      padding-top: 5px;
    }
    .pr-b10 {
      position: relative;
      bottom: 10px;
    }
    .left {
      float: left;
    }
    .p-40 {
      padding-left: 15px !important;
      padding-top: 55px !important;
    }
    .card.p-20 {
        padding-top: 18px !important;
    }
    .fr-right {
      float: right;
      justify-content: flex-end;
    }
    .p-20 {
      padding-top: 25px !important;
      padding-bottom: 25px !important;
      padding-right: 20px !important;
      padding-left: 20px !important;
    }
    .float-right.d-md-block {
      position: relative;
      bottom: 5px;
    }
    .pd-17 {
      position: relative;
      left: 17px;
    }
    @media only screen and (max-width: 1300px) {
      .card-deck-upgrades div a {
          min-height: 440px;
      }
    }
    @media only screen and (max-width: 1250px) {
      .card-deck-upgrades div a {
          min-height: 480px;
      }
      .card-deck-upgrades div {
        padding: 10px !important;
      }
    }
    @media only screen and (max-width: 600px) {
      .p-40 {
        padding-top: 0px !important;
      }
      .pr-b10 {
        position: relative;
        bottom: 0px;
      }
    }
</style>
<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper">
   <?php include viewPath('includes/notifications'); ?>
   <div class="container-fluid p-40">
      <section class="content">
         <!-- Default box -->
         <div class="box">
            <?php echo form_open('workstatus/save', [ 'class' => 'form-validate' ]); ?>
            <div class="row custom__border">
				<div class="col-xl-12">
					<div class="card">
            <div class="page-title-box" style="padding:5px 0 0 0;">
              <div class="row align-items-center">
                <div class="col-sm-6">
                  <h1 class="page-title">Workorder Type</h1>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item active"></li>
                  </ol>
                </div>
                <div class="col-sm-6">
                  <div class="float-right d-none d-md-block">
                    <div class="dropdown">
                      <a href="<?php echo url('plans') ?>" class="btn btn-primary" aria-expanded="false">
                        <i class="mdi mdi-settings mr-2"></i> Go Back to Workorder Type
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="pl-3 pr-3 mt-0 row">
              <div class="col mb-2 left alert alert-warning mt-0 mb-2">
                  <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Add New Workorder Type</span>
              </div>
            </div>
						<div class="card-body mt-0 pl-0 pr-0">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
									  <label for="title">Title *</label>
									  <input type="text" class="form-control" name="title" id="title" required placeholder="Enter title" autofocus />
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
									  <label for="color">Color *</label>
									  <input type="color" class="form-control" name="color" id="color" required placeholder="Enter color"/>
									</div>
								</div>
								<div class="col-sm-6 mt-3">
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
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
   $(document).ready(function() {
     $('.form-validate').validate();
   })
</script>
