<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper">
   <div class="container-fluid">
      <div class="page-title-box">
         <div class="row align-items-center">
            <div class="col-sm-6">
               <h1 class="page-title">Wizard</h1>
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
      <?php echo form_open_multipart('wizard/save', [ 'id' => 'filevaultform', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>                 
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-body">
                  <div class="row">
				 <div class="col-md-4 form-group">
					<label for="title">Name</label>
					<input type="text" class="form-control" name="title" id="title" required placeholder="Enter Name" autofocus />
				 </div>
				 <div class="col-md-4 form-group">
					<label for="description">Description<small> 
               </small></label>
               <textarea class="form-control" name="description" id="description" required placeholder="Upload File"></textarea>
				 </div>
            
			  </div>
			
                  <div class="row">
                     <div class="col-md-4 form-group">
                        <!-- <button type="submit" class="btn btn-flat btn-primary">Submit</button> -->
                        <button type="submit" class="btn btn-flat btn-primary" id="savefilevault" button_for="add">Submit</button>
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


<?php include viewPath('includes/footer'); ?>
<script>
  
</script>
