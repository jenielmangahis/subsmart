<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
 <?php include viewPath('includes/sidebars/inventory'); ?>
   <?php include viewPath('includes/notifications'); ?>
   <div wrapper__section>
   <div class="container-fluid">
    <div class="card card_holder">
      <div class="page-title-box">
         <div class="row align-items-center">
            <div class="col-sm-6">
               <h1 class="page-title">Plans</h1>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item active">Manage Company Plan</li>
               </ol>
            </div>
            <div class="col-sm-6">
               <div class="float-right d-none d-md-block">
                  <div class="dropdown">
                    <?php //if (hasPermissions('add_plan')): ?>
                    <a href="<?php echo url('plans/add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> New Plan</a>
                    <?php //endif ?>
                     
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
               <h3 class="box-title">List of Plans</h3>              
            </div>
            <div class="box-body">
               <table id="dataTable1" class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Status</th> 
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php foreach ($plans as $row): ?>
                     <tr>
                        <td width="60"><?php echo $row->id ?></td>
                        <td>
                           <?php echo $row->plan_name ?>
                        </td>
                        <td>
                           <?php echo ($row->status==1)?'Activated':'De-Activated'; ?>
                        </td>
                        
                        <td>
                           <?php //if (hasPermissions('plan_edit')): ?>
                           <a href="<?php echo url('plans/edit/'.$row->id) ?>" class="btn btn-sm btn-default" title="Edit item" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                           <?php //endif ?>
                           <?php //if (hasPermissions('plan_delete')): ?>
                           <a href="<?php echo url('plans/delete/'.$row->id) ?>" class="btn btn-sm btn-default" onclick='return confirm("Do you really want to delete this item ? \nIt may cause errors where it is currently being used !!")' title="Delete item" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                           <?php //endif ?>
                        </td>
                     </tr>
                     <?php endforeach ?>
                  </tbody>
               </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
               
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
   $('#dataTable1').DataTable()
   
</script>