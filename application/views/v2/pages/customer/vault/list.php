<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('v2/includes/header');
echo put_header_assets();
?>
<?php include viewPath('v2/includes/estimate/estimate_modals'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_module_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            My Library is a place where you can quickly find and access all of your files, content, and customer information from anywhere, on any device. Create specific or general folders to better categorized your files for quicker access. Format to includes are PDF, DOC, JPEG, GIF, CSV and much more. It is your private storage area for you documents.
                        </div>
                    </div>
                </div>
                <div class="wrapper" role="wrapper">
                    <?php echo $folder_manager; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
   .col-md-2 {
      position: relative;
      width: 100%;
   }
</style>

<script src="<?=base_url("assets/js/folders_files.js")?>"></script>
<?php include viewPath('v2/includes/footer'); ?>