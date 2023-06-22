<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('v2/includes/header');
echo put_header_assets();
?>

<input type="hidden" name="controller-method" value="<?= $ctrlMethod; ?>">

<div class="wrapper" role="wrapper">
   <?php echo $folder_manager; ?>
</div>
<style>
   a {
      text-decoration: none;
   }
</style>


<div class="modal nsm-modal fade" id="usersModal" tabindex="-1" role="dialog" aria-labelledby="usersModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="usersModalLabel">Sharing</h5>
            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
         </div>
         <div class="modal-body">
            <p>Select who can use this template</p>

            <table id="usersTable" class="table" style="width: 100%;">
               <thead>
                  <tr>
                     <th></th>
                     <th>Name</th>
                     <th>Email</th>
                  </tr>
               </thead>
            </table>
         </div>
         <div class="modal-footer">
            <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="nsm-button primary d-flex align-items-center">
               <div class="spinner-border spinner-border-sm m-0 d-none" role="status">
                  <span class="sr-only">Loading...</span>
               </div>
               <span class="ml-1">Share</span>
            </button>
         </div>
      </div>
   </div>
</div>

<div class="modal nsm-modal fade" id="deleteTemplateModal" tabindex="-1" role="dialog" aria-labelledby="deleteTemplateModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="deleteTemplateModalLabel">Delete</h5>
            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
         </div>
         <div class="modal-body">
            <p>Are you sure you want to delete this template?</p>
         </div>
         <div class="modal-footer">
            <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="nsm-button primary d-flex align-items-center">
               <div class="spinner-border spinner-border-sm m-0 d-none" role="status">
                  <span class="sr-only">Loading...</span>
               </div>
               <span class="ml-1">Delete</span>
            </button>
         </div>
      </div>
   </div>
</div>

<div class="modal nsm-modal fade" id="uploadTemplateThumbnail" tabindex="-1" role="dialog" aria-labelledby="uploadTemplateThumbnailLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="uploadTemplateThumbnailLabel">Change Template Thumbnail</h5>
            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
         </div>
         <div class="modal-body">
            <div class="fillAndSign__selectFile">
               <img id="uploadTemplateThumbnailFilePreview" src="#" />

               <div class="custom-file">
                  <input type="file" accept="image/*" class="custom-file-input" id="uploadTemplateThumbnailFile">
                  <label class="custom-file-label" for="uploadTemplateThumbnailFile">
                     <span class="custom-file-label__inner"></span>
                  </label>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="nsm-button primary d-flex align-items-center">
               <div class="spinner-border spinner-border-sm m-0 d-none" role="status">
                  <span class="sr-only">Loading...</span>
               </div>
               <span class="ml-1">Save</span>
            </button>
         </div>
      </div>
   </div>
</div>


<script src="<?= base_url("assets/js/v2/folders_files.js") ?>"></script>
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

   .dropdown-color {
      color: black !important;
   }

   #modal-folder-manager-alert .modal-header {
      background-color: white !important;
   }
</style>
<?php include viewPath('v2/includes/footer'); ?>