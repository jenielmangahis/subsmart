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
                  <h1 class="page-title">Shared Library</h1>
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item active">Accessible folders and files within the company</li>
                  </ol>
               </div>
               <div class="col-sm-6">
                  
               </div>
            </div>
         </div>
      </div>
                    
      <div class="row">
         <div class="col-xl-12">
               <div>
                  <?php echo $folder_manager; ?>
               </div>
         </div>
         <!-- end row -->           
      </div>
   </div>
   <!-- end container-fluid -->
</div>

<!-- page wrapper end -->

<?php include viewPath('includes/footer'); ?>
<script src="<?php echo $url->assets ?>js/folders_files.js"></script>
<script>
   $(document).ready( function () {

    } );
</script>