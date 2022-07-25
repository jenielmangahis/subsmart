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
   .col-md-2 {
      position: relative;
      width: 200px;
   }
   .fa-2x{
      margin:5px;
   }

   [isfolder="1"] {
      border-color: #e4e4e4 !important;
      box-shadow: none !important;
      color: #797979;
      font-weight: 600;
   }
   [isfolder="1"].bg-info {
      background-color: #e8f0fe!important;
      color: #1967d2 !important;
   }
   [isfolder="1"] table {
      width: 100% !important;
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

<?php include viewPath('v2/includes/footer');?>
