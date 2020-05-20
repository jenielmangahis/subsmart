<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper">
   <div class="container-fluid">
      <div class="page-title-box">
         <div class="row align-items-center">
            <div class="col-sm-6">
               <h1 class="page-title">Files</h1>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item active">Manage Files</li>
               </ol>
            </div>
            <div class="col-sm-6">
               <div class="float-right d-none d-md-block">
                  <div class="dropdown">
                     <?php if (hasPermissions('users_add')): ?>
                     <a href="<?php echo url('vault') ?>" class="btn btn-primary" aria-expanded="false">
                     <i class="mdi mdi-settings mr-2"></i> Go Back to Files
                     </a>   
                     <?php endif ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end row -->    
      <?php echo form_open_multipart('vault/save', [ 'id' => 'filevaultform', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>                 
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-body">
                  <div class="row">
				 <div class="col-md-4 form-group">
					<label for="title">Name<small> Set a name for your own reference</small></label>
					<input type="text" class="form-control" name="title" id="title" required placeholder="Enter Name" autofocus />
				 </div>
				 <div class="col-md-4 form-group">
					<label for="fullfile">Upload File<small> (Allowed type: pdf, doc, docx, rtf, png, jpg, gif. Max size 8MB.)</small></label>
					<input type="file" class="form-control" name="fullfile" id="fullfile" placeholder="Upload File" accept=".gif, .jpeg, .jpg, .png, .doc, .rtf, .docx, .pdf" required>
				 </div>
             <div class="col-md-4 form-group">
               <label for="title">Folder<small> Select destination folder</small></label>
               <div class="input-group">
                  <input type="text" class="form-control" name="fm_selected_folder_text" id="fm_selected_folder_text" placeholder="Selected Folder" disabled>
                  <input type="number" class="form-control" name="fm_selected_folder" id="fm_selected_folder" value=0 hidden>
                   <div class="input-group-btn">
                     <button class="btn btn-default" type="button" id="btn-folder-manager">
                       <i class="fa fa-folder-open-o"></i>
                     </button>
                   </div>
               </div>
             </div>
			  </div>
			  <!--<div class="row">
				 <div class="col-md-4 form-group">
					<label for="title">Attach to Estimates</small></label>
					<select name="estimate_resource" class="form-control">
						<option value="0">- select -</option>
						<option value="1">Residential and commercial estimates</option>
						<option value="2">Residential estimates</option>
						<option value="3">Commercial estimates</option>
					</select>
				 </div>
				 <div class="col-md-4 form-group">
					<label for="fullfile">Attach to Invoices</label>
					<select name="invoice_resource" class="form-control">
						<option value="0">- select -</option>
						<option value="1">Residential and commercial invoices</option>
						<option value="2">Residential invoices</option>
						<option value="3">Commercial invoices</option>
					</select>
				 </div>
			  </div>-->
                  <div class="row">
                     <div class="col-md-4 form-group">
                        <!-- <button type="submit" class="btn btn-flat btn-primary">Submit</button> -->
                        <button type="button" class="btn btn-flat btn-primary" id="savefilevault" button_for="add">Submit</button>
                     </div>
                  </div>
               </div>
            </div>
            <!-- end card -->
         </div>
      </div>
      <?php echo form_close(); ?>
      <!-- end row -->           
   </div>
   <!-- end container-fluid -->
</div>
<!-- page wrapper end -->

<?php echo $folder_manager; ?>
<?php include viewPath('includes/footer'); ?>
<script>
   $('#btn-select-folder-manager').click(function(){
      var caption = $(this).html();
      caption = caption.trim();

      if(caption == 'Cancel'){
         $(this).html('Select');
         
         $('#text-folder-manager').val('');
            $('#text-folder-manager').prop('disabled', true);

            $('#btn-create-folder-manager').html('Create');
            $('#btn-delete-folder-manager').prop('disabled', false); 
      } else {
         if(!jQuery.isEmptyObject(selected_folder)){
            $('#fm_selected_folder_text').val(selected_folder.path);
            $('#fm_selected_folder').val(selected_folder.id);

            $('#modal-folder-manager').modal('hide');
         } else {
            $('#fm_selected_folder_text').val('');
            $('#fm_selected_folder').val('0');

            $('#modal-folder-manager').modal('hide');
         }
      }  
    });
</script>
