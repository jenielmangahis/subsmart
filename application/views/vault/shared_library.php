<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
   <?php include viewPath('includes/sidebars/filevault'); ?>
   <div wrapper__section>
      <div class="row" style="padding: 40px 15px 0px 15px;">
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
