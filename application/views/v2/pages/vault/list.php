<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('v2/includes/header');
echo put_header_assets();
?>

<div class="wrapper" role="wrapper">
   <?php echo $folder_manager; ?>
</div>

<script src="<?=base_url("assets/js/folders_files.js")?>"></script>
<style>
   .col-md-2 {
      position: relative;
      width: 100%;
   }
</style>
<?php include viewPath('v2/includes/footer');?>
