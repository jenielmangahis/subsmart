<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper">
   <?php include viewPath('includes/notifications'); ?>
   <div class="container-fluid">
   <div class="card card_holder">
      <div class="page-title-box">
         <div class="row align-items-center">
            <div class="col-sm-6">
               <h3 style="font-size:26px;" class="page-title">Roles</h3>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item active">Manage user roles</li>
               </ol>
            </div>
            <div class="col-sm-6">
               <div class="float-right d-none d-md-block">
                  <div class="dropdown">
                    <a href="<?php echo url('roles/add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> New User Role</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end row -->                     
      <section class="content">
         <!-- Default box -->
         <div class="box">
            <div class="box-header with-border">
               <h3 class="box-title">List of Roles</h3>              
            </div>
            <div class="box-body table-responsive">
               <table id="dataTable1" class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php foreach ($roles as $row): ?>
                     <tr>
                        <td width="60"><?php echo $row->id ?></td>
                        <td>
                           <?php echo $row->title ?>
                        </td>
                        <td>
                           <?php //if (hasPermissions('roles_edit')): ?>
                           <a href="<?php echo url('roles/edit/'.$row->id) ?>" class="btn btn-sm btn-default" title="Edit User Role" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                           <?php //endif ?>
                        </td>
                     </tr>
                     <?php endforeach ?>
                  </tbody>
               </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
               Footer
            </div>
            <!-- /.box-footer-->
         </div>
         <!-- /.box -->
      </section>
      <!-- end row -->           
   </div>
   </div>
   <!-- end container-fluid -->
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
   $('#dataTable1').DataTable({
   
     "order": []
   
   })
   
   
   
   $('.select2').select2();
   
   
   
</script>