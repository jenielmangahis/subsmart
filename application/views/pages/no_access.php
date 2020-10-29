<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper">
   <?php include viewPath('includes/notifications'); ?>
   <div class="container-fluid">
    <div class="card card_holder">
      <div class="page-title-box">
         <div class="row align-items-center">
            <div class="col-sm-6">
               <h1 class="page-title">nSmarTrac - No Access</h1>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item active">
                     Your user credential does not allow you to access the module. Go back to the 
                     <a href="<?php echo base_url('dashboard'); ?>"><span class="badge badge-secondary">Dashboard</span></a>
                  </li>
               </ol>
            </div>
         </div>
      </div>
      
      <!-- end row -->           
   </div>
   </div>
   <!-- end container-fluid -->
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
