<style>
hr{
    border: 0.5px solid #32243d !important;
    width: 100%;
}
.form-group {
    margin-bottom: 2px !important;
}
.banking-tab-container {
    border-bottom: 1px solid grey;
    padding-left: 0;
}
.form-line{
    padding-bottom: 1px;
}
.pb-30 {
  padding-bottom: 30px;
}
h5.card-title.mb-0, p.card-text.mt-txt {
  text-align: center !important;
}
.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 54% !important;
    right: 9px !important;
}
.card-deck-upgrades {
  display: block;
}
.card-deck-upgrades div {
    padding: 20px;
    float: left;
    width: 33.33%;
}
.card-body.align-left {
  width: 100% !important;
}
.card-deck-upgrades div a {
    display: block;
    width: 100%;
    min-height: 400px;
    float: left;
    text-align: center;
}
.page-title, .box-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
  padding-top: 5px;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.left {
  float: left;
}
.p-40 {
  padding-left: 15px !important;
  padding-top: 10px !important;
}
a.btn-primary.btn-md {
    height: 38px;
    display: inline-block;
    border: 0px;
    padding-top: 7px;
    position: relative;
    top: 0px;
}
.card.p-20 {
    padding-top: 18px !important;
}
.fr-right {
  float: right;
  justify-content: flex-end;
}
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 20px !important;
  padding-left: 20px !important;
}
.page-title-box {
    padding: 15px 0px 0px 0px !important;
}
.pd-17 {
  position: relative;
  left: 17px;
}
a.btn.btn-primary {
    position: relative;
    bottom: 14px;
}
@media only screen and (max-width: 1300px) {
  .card-deck-upgrades div a {
      min-height: 440px;
  }
}
@media only screen and (max-width: 1250px) {
  .card-deck-upgrades div a {
      min-height: 480px;
  }
  .card-deck-upgrades div {
    padding: 10px !important;
  }
}
svg#svg-sprite-menu-close {
    position: relative;
    bottom: 169px;
}
@media only screen and (max-width: 600px) {
  .p-40 {
    padding-top: 0px !important;
  }
  a.btn.btn-primary {
      position: relative;
      bottom: 0px;
  }
  .pr-b10 {
    position: relative;
    bottom: 0px;
  }
}
</style>
<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
 <?php include viewPath('includes/sidebars/inventory'); ?>
   <?php include viewPath('includes/notifications'); ?>
   <div wrapper__section>
   <div class="container-fluid p-40">
    <div class="card card_holder">
      <div class="page-title-box">
         <div class="row align-items-center">
            <div class="col-sm-6">
               <h1 class="page-title pt-0">Plans</h1>
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
      <div class="pl-3 pr-3 mt-0 row">
        <div class="col mb-1 left alert alert-warning mt-0 mb-2">
            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Manage Company Plan.</span>
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
