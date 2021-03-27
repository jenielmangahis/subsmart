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
    .left {
      float: left;
    }
    .p-40 {
      padding-left: 15px !important;
      padding-top: 10px !important;
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
    .float-right.d-md-block {
      position: relative;
      bottom: 5px;
    }
    .pd-17 {
      position: relative;
      left: 17px;
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
    @media only screen and (max-width: 600px) {
      .p-40 {
        padding-top: 0px !important;
      }
      .pr-b10 {
        position: relative;
        bottom: 0px;
      }
    }
    svg#svg-sprite-menu-close {
      position: relative;
      bottom: 62px !important;
    }
</style>
<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/notifications'); ?>
    <?php include viewPath('includes/sidebars/workorder'); ?>
    <div wrapper__section>
        <div class="container-fluid p-40">
            <div class="card card_holder">
                <div class="page-title-box" style="padding:14px 0 0 0;">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h1 class="page-title">Workorder Type</h1>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                    <?php ////if (hasPermissions('add_plan')): ?>
                                    <a href="<?php echo url('workstatus/add') ?>" class="btn btn-primary" style="position: relative;bottom: 2px;"><i
                                                class="fa fa-plus"></i> New Workorder type</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pl-3 pr-3 mt-0 row">
                  <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                      <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Manage Workorder Type</span>
                  </div>
                </div>
                <!-- end row -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">List of Workorder Type</h3>
                        </div>
                        <div class="box-body">
                            <table id="dataTable1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Color</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($workstatus as $row): ?>
                                    <tr>
                                        <td width="60"><?php echo $row->id ?></td>
                                        <td>
                                            <?php echo $row->title ?>
                                        </td>
                                        <td>
                                            <div style="width:100px;height:25px;background:<?php echo $row->color ?>"></div>
                                        </td>

                                        <td>
                                            <?php //if (hasPermissions('plan_edit')): ?>
                                                <a href="<?php echo url('workstatus/edit/' . $row->id) ?>"
                                                   class="btn btn-sm btn-default" title="Edit item"
                                                   data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                            <?php //endif ?>
                                            <?php //if (hasPermissions('plan_delete')): ?>
                                                <a href="<?php echo url('workstatus/delete/' . $row->id) ?>"
                                                   class="btn btn-sm btn-default"
                                                   onclick='return confirm("Do you really want to delete this item ? \nIt may cause errors where it is currently being used !!")'
                                                   title="Delete item" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
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
    </div>
    <!-- end container-fluid -->
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
    $('#dataTable1').DataTable()

</script>
