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
<div class="wrapper" role="wrapper">
   <?php include viewPath('includes/sidebars/filevault'); ?>
   <div wrapper__section>
      <div class="row">
         <div class="col-xl-12 p-40 pl-4 pr-4">
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
