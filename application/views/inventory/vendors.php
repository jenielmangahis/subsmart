
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<?php include viewPath('inventory/css/lists_css'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/inventory'); ?>
    <?php include viewPath('includes/notifications'); ?>
    <div wrapper__section>
        <div class="container-fluid p-40">
            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body hid-desk pt-0"
                             style="padding-bottom:0px; padding-left:0px; padding-right:0px;">
                            <div class="row margin-bottom-ter mb-2 align-items-center"
                                 style="background-color:white; padding:0px;">
                                <div class="col-auto pl-0">
                                    <h5 class="page-title pt-0 mb-0 mt-0" style="position:relative;top:2px;">Vendors</h5>
                                </div>
                                <div class="col text-right-sm d-flex justify-content-end align-items-center">
                                    <div class="float-right d-md-block">
                                        <a class="btn btn-primary btn-sm" href="<?= base_url('inventory/fees/add') ?>"><span class="fa fa-plus"></span> Add New Vendor</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pl-3 pr-3 mt-0 row">
                            <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">no description yet.</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <table id="dataTable1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Vendor Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($vendors as $row): ?>
                                    <tr>
                                        <td><?= $row->vendor_name ?></td>
                                        <td><?= $row->email ?></td>
                                        <td><?= $row->phone ?></td>
                                        <td><?= $row->street_address.' '.$row->city. ' '.$row->state ?></td>
                                        <td>
                                            <a href="<?php echo url('plans/edit/'.$row->id) ?>" class="btn btn-sm btn-default" title="Edit item" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                            <a href="<?php echo url('plans/delete/'.$row->id) ?>" class="btn btn-sm btn-default" onclick='return confirm("Do you really want to delete this item ? \nIt may cause errors where it is currently being used !!")' title="Delete item" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
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
