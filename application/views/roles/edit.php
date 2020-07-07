<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper">
   <?php include viewPath('includes/notifications'); ?>
   <div class="container-fluid">
      <div class="page-title-box">
         <div class="row align-items-center">
            <div class="col-sm-6">
               <h1 class="page-title">Roles</h1>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item active">Manage roles</li>
               </ol>
            </div>
         </div>
      </div>
      <!-- end row -->                     
      <section class="content">
         <!-- Default box -->
         <div class="box">
            <div class="box-header with-border">
               <h3 class="box-title">Edit Role</h3>
               <div class="box-tools pull-right">
                  <a href="<?php echo url('roles') ?>" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i> &nbsp;&nbsp; Go Back to Roles</a>
                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                     title="Collapse">
                  <i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
               </div>
            </div>
            <?php echo form_open('roles/update/'.$role->id, [ 'class' => 'form-validate' ]); ?>
            <div class="box-body">
               <div class="form-group">
                  <label for="formClient-Name">Name</label>
                  <input type="text" class="form-control" name="name" id="formClient-Name" required placeholder="Enter Name" autofocus value="<?php echo $role->title ?>" />
               </div>
               <div class="form-group">
                  <label for="formClient-Table">Permission</label>
                  <div class="row">
                     <div class="col-sm-6">
                        <table class="table table-bordered table-striped">
                           <thead>
                              <tr>
                                 <th>Name</th>
                                 <th width="50" class="text-center"><input type="checkbox" class="check-select-all-p"></th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <?php if (!empty($permissions = $this->permissions_model->get())): ?>
                                 <?php foreach ($permissions as $row): ?>
                                 <td><?php echo ucfirst($row->title) ?></td>
                                 <?php 
                                    $isChecked = in_array($row->code, $role_permissions) ? 'checked' : '';
                                    
                                    ?>
                                 <td width="50" class="text-center"><input type="checkbox" class="check-select-p" name="permission[]" value="<?php echo $row->code ?>" <?php echo $isChecked ?>></td>
                              </tr>
                              <?php endforeach ?>
                              <?php else: ?>
                              <tr>
                                 <td colspan="2" class="text-center">No Permissions Found</td>
                              </tr>
                              <?php endif ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
               <button type="submit" class="btn btn-flat btn-primary">Submit</button>
            </div>
            <!-- /.box-footer-->
            <?php echo form_close(); ?>
         </div>
         <!-- /.box -->
      </section>
      <!-- end row -->           
   </div>
   <!-- end container-fluid -->
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
   $(document).ready(function() {
   
     $('.form-validate').validate();
   
   
   
     $('.check-select-all-p').on('change', function() {
   
   
   
       $('.check-select-p').attr('checked', $(this).is(':checked'));
   
       
   
     })
   
   
   
     $('.table-DT').DataTable({
   
       "ordering": true,
   
       'order' : true,
   
       "paging": false,
   
     });
   
   
   
     var checked = true;
   
     $('.check-select-p').each(function() {
   
   
   
       if(!$(this).is(':checked'))
   
         checked = false;
   
   
   
         return checked;
   
   
   
     });
   
   
   
     if(checked){
   
       $('.check-select-all-p').attr('checked', true);
   
     }
   
   
   
   
   
   })
   
   
   
</script>
<script>
   //Initialize Select2 Elements
   
   $('.select2').select2()
   
</script>