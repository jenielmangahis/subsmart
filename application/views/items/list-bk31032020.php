<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/estimate'); ?>
    <?php include viewPath('includes/notifications'); ?>
    <div wrapper__section>
        <div class="container-fluid">
            <div class="card card_holder">
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h1 class="page-title">Items</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Manage Company items</li>
                            </ol>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                    <?php //if (hasPermissions('items_add')): ?>
                                        <a href="<?php echo url('items/add') ?>" class="btn btn-primary"><i
                                                    class="fa fa-plus"></i> New Items</a>
                                    <?php //endif ?>
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"
                                            data-toggle="tooltip"
                                            title="Collapse">
                                        <i class="fa fa-minus"></i></button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"
                                            data-toggle="tooltip" title="Remove">
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
                            <h3 class="box-title">List of Items</h3>
                        </div>
                        <div class="box-body">
                            <table id="dataTable1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($items as $row): ?>
                                    <tr>
                                        <td width="60"><?php echo $row->id ?></td>
                                        <td>
                                            <?php echo $row->title ?>
                                        </td>
                                        <td>
                                            <?php echo $row->price ?>
                                        </td>
                                        <td>
                                            <?php echo $row->discount ?>
                                        </td>
                                        <td>
                                            <?php //if (hasPermissions('items_edit')): ?>
                                                <a href="<?php echo url('items/edit/' . $row->id) ?>"
                                                   class="btn btn-sm btn-default" title="Edit item"
                                                   data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                            <?php //endif ?>
                                            <?php //if (hasPermissions('items_delete')): ?>
                                                <a href="<?php echo url('items/delete/' . $row->id) ?>"
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
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<script>
    $('#dataTable1').DataTable()

</script>