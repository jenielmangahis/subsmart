<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<?php include viewPath('inventory/css/lists_css'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/inventory'); ?>

    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid p-40">
            <div class="row custom__border">
                <div class="col-xl-12">
                <div class="card ">
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h3 class="box-title">List of Plans</h3>
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
                                        <td><?php echo $row->plan_name ?></td>
                                        <td> <?php echo ($row->status==1)?'Activated':'De-Activated'; ?></td>
                                        <td>
                                            <a href="<?php echo url('plans/edit/'.$row->id) ?>" class="btn btn-sm btn-default" title="Edit item" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                            <a href="<?php echo url('plans/delete/'.$row->id) ?>" class="btn btn-sm btn-default" onclick='return confirm("Do you really want to delete this item ? \nIt may cause errors where it is currently being used !!")' title="Delete item" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
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
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
    <?php include viewPath('includes/footer'); ?>
    <script>
        $('#dataTable1').DataTable()

    </script>
