<?php
defined('BASEPATH') or exit('No direct script access allowed');?>
<?php include viewPath('includes/header');?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
   <?php include viewPath('includes/sidebars/filevault');?>
   <div wrapper__section>
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

<div class="modal fade" id="usersModal" tabindex="-1" role="dialog" aria-labelledby="usersModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="usersModalLabel">Sharing</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
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
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			<button type="button" class="btn btn-primary d-flex align-items-center">
				<div class="spinner-border spinner-border-sm m-0 d-none" role="status">
					<span class="sr-only">Loading...</span>
				</div>
				<span class="ml-1">Share</span>
			</button>
		</div>
		</div>
	</div>
</div>

<div class="modal fade" id="deleteTemplateModal" tabindex="-1" role="dialog" aria-labelledby="deleteTemplateModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="deleteTemplateModalLabel">Delete</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
         <p>Are you sure you want to delete this template?</p>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			<button type="button" class="btn btn-primary d-flex align-items-center">
				<div class="spinner-border spinner-border-sm m-0 d-none" role="status">
					<span class="sr-only">Loading...</span>
				</div>
				<span class="ml-1">Delete</span>
			</button>
		</div>
		</div>
	</div>
</div>

<div class="modal fade" id="uploadTemplateThumbnail" tabindex="-1" role="dialog" aria-labelledby="uploadTemplateThumbnailLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="uploadTemplateThumbnailLabel">Change Template Thumbnail</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<div class="fillAndSign__selectFile">
				<div class="custom-file">
					<input type="file" accept="image/*" class="custom-file-input" id="uploadTemplateThumbnailFile">
					<label class="custom-file-label" for="uploadTemplateThumbnailFile">
						<span class="custom-file-label__inner"></span>
					</label>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			<button type="button" class="btn btn-primary d-flex align-items-center">
				<div class="spinner-border spinner-border-sm m-0 d-none" role="status">
					<span class="sr-only">Loading...</span>
				</div>
				<span class="ml-1">Save</span>
			</button>
		</div>
		</div>
	</div>
</div>

<!-- page wrapper end -->

<?php include viewPath('includes/footer');?>
<script src="<?php echo $url->assets ?>js/folders_files.js"></script>
<script>
   $(document).ready( function () {

    } );
</script>
