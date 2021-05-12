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
			<button type="button" class="btn btn-primary" data-dismiss="modal">Share</button>
		</div>
		</div>
	</div>
</div>

<!-- page wrapper end -->

<?php include viewPath('includes/footer'); ?>
<script src="<?php echo $url->assets ?>js/folders_files.js"></script>
<script>
   $(document).ready( function () {

    } );
</script>
