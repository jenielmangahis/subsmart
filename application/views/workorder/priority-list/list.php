<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
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
.p-40 {
  padding-top: 40px !important;
}
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 20px !important;
  padding-left: 20px !important;
}
@media only screen and (max-width: 600px) {
  .p-40 {
    padding-top: 0px !important;
  }
  .pr-b10 {
    position: relative;
    bottom: 0px;
  }
}
</style>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/notifications'); ?>
    <?php include viewPath('includes/sidebars/workorder'); ?>
    <div wrapper__section>
        <div class="container-fluid p-40">
            <div class="card p-20 mt-0 card_holder">
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h3 class="page-title">Priority List</h3>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Manage work order priority list.</li>
                            </ol>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                    <?php ////if (hasPermissions('add_plan')): ?>
                                    <a href="<?php echo url('workorder/priority/add') ?>" class="btn btn-primary"><i
                                                class="fa fa-plus"></i> New Priority</a>

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
                            <h3 class="box-title">List of Priority</h3>
                        </div>
                        <div class="box-body">
                            <table id="dataTable1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th style="width: 10%;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($priorityList)) { ?>
                                    <?php foreach ($priorityList as $priority): ?>
                                        <tr>
                                            <td width="60"><?php echo $priority->id ?></td>
                                            <td>
                                                <?php echo $priority->title ?>
                                            </td>
                                            <td>
                                                <?php //if (hasPermissions('plan_edit')): ?>
                                                    <a href="<?php echo url('workorder/priority/edit/' . $priority->id) ?>"
                                                       class="btn btn-sm btn-info" title="Edit item"
                                                       data-toggle="tooltip"><i class="fa fa-pencil"></i> Edit</a>
                                                <?php //endif ?>
                                                <?php //if (hasPermissions('plan_delete')): ?>
                                                    <a href="<?php echo url('workorder/priority/delete/' . $priority->id) ?>"
                                                       class="btn btn-sm btn-danger remove-data-item"
                                                       title="Delete item" data-toggle="tooltip"><i
                                                                class="fa fa-trash"></i> Delete</a>
                                                <?php //endif ?>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php } ?>
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
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
    $('#dataTable1').DataTable()

</script>
