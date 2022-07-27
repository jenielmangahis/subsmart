<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
   <?php include viewPath('includes/sidebars/filevault'); ?>
   <div wrapper__section>
      <div class="row">
         <div class="col-xl-12">
               <div>
                  <?php echo $folder_manager; ?>
               </div>
         </div>

      </div>
   </div>

</div>



<?php include viewPath('includes/footer'); ?>
<script src="<?php echo $url->assets ?>js/folders_files.js"></script>
<script>
   $(document).ready( function () {

    } );
</script>
