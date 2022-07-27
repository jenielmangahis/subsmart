<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('v2/includes/header');
echo put_header_assets();
?>

<input type="hidden" name="controller-method" value="<?=$ctrlMethod;?>">

<div class="wrapper" role="wrapper">
   <?php echo $folder_manager; ?>
</div>
<style>
   a{
      text-decoration:none;
   }
</style>
<script src="<?=base_url("assets/js/v2/folders_files.js")?>"></script>
<script>
   (() => {
      const $controller = document.querySelector(`[name=controller-method]`);
      const controller = $controller.value;

      const $tab = document.querySelector(`[data-controller=${controller}]`);
      if ($tab) {
         $tab.classList.add("active");
      }
   })();
</script>
<style>
   .col-md-2 {
      position: relative;
      width: 100%;
   }

   .dropdown-color{
      color:black !important;
   }
   #modal-folder-manager-alert .modal-header{
      background-color:white!important;
   }
</style>
<?php include viewPath('v2/includes/footer');?>
