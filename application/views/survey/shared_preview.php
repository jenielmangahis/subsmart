<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
  <style media="screen">
  .share-icon.d-flex i {
   width: 45px;
   height: 45px;
   align-items: center;
   display: flex;
   justify-content: center;
   color: rgb(76, 76, 76);
   background-color: #f0f0f0;
   border-radius: 50%;
   margin-right: .5rem;
 }
  </style>
   <?php include viewPath('includes/sidebars/marketing'); ?>
   <!-- page wrapper start -->
   <div wrapper__section>
      <div class="container-fluid">
         <div class="page-title-box">
         </div>
         <!-- end row -->
         <div class="row">
            <div class="col-xl-12">
              <div class="card">
                <div class="row">
                  <div class=" col-sm-3">
                    <h5 class="font-weight-normal">Share your typeform </h5>
                    <div class="card p-0">
                      <div class="card-body py-4">
                        <h6 class="card-title mt-0">Your typeform isn't published</h6>
                        <p class="card-text">Go to Create and publish your typeform so you can share the latest version.</p>
                      </div>
                    </div>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <button id="btn-copy-link" class="btn btn-outline-dark border-1 px-3" style="border-color: #e0e0e0 !important;">Copy</button>
                      </div>
                      <input id="value-link" type="text" class="form-control" value="<?= base_url() ?>survey/preview/<?= $survey->id ?>">
                    </div>
                  </div>
                  <div class=" col-sm-3">
                    <h5 class="font-weight-normal">More Ways to Share</h5>
                    <div id="shared" class=" d-flex"></div>
                  </div>
                </div>

              </div>
            </div>
            <!-- end card -->
         </div>
      </div>
      <!-- end row -->
   </div>
   <!-- end container-fluid -->
</div>
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
