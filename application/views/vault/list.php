<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
   <?php include viewPath('includes/sidebars/filevault'); ?>
   <div wrapper__section>
      <div class="container-fluid">
         <div class="page-title-box">
            <div class="row align-items-center">
               <div class="col-sm-6">
                  <h1 class="page-title">Files</h1>
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item active">Manage Files</li>
                  </ol>
               </div>
               <div class="col-sm-6">
                  
               </div>
            </div>
         </div>
                       
         <div class="row">
            <div class="col-xl-12">
               <div class="card">
                  <div class="card-header">
                     <div class="float-right d-none d-md-block">
                        <div class="dropdown">
                           <?php //if (hasPermissions('users_add')): ?>
                           <a href="#" class="btn btn-primary" aria-expanded="false" id="btn-add-new-folder">
                           <i class="fa fa-folder mr-2"></i> Add New Folder
                           </a> 
                      
                           <?php //endif ?>
                        </div>
                     </div>
                  </div>
                  <div class="card-body">
                     <?php echo $folder_manager; ?>
                  </div>
               </div>
               <!-- end card -->
            </div>
         </div>
         <!-- end row -->           
      </div>
   </div>
   <!-- end container-fluid -->
</div>

<!-- page wrapper end -->

<?php include viewPath('includes/footer'); ?>
<script>
   $(document).ready( function () {

    } );
</script>