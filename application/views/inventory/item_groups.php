<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<?php include viewPath('inventory/css/lists_css'); ?>
    <div class="wrapper" role="wrapper">
        <?php include viewPath('includes/sidebars/inventory'); ?>
        <!-- page wrapper start -->
        <div wrapper__section>
            <?php include viewPath('includes/notifications'); ?>
            <div class="container-fluid p-40">
                <div class="row custom__border">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body hid-desk pt-0"
                                 style="padding-bottom:0px; padding-left:0px; padding-right:0px;">
                                <div class="row margin-bottom-ter mb-2 align-items-center"
                                     style="background-color:white; padding:0px;">
                                    <div class="col-auto pl-0">
                                        <h5 class="page-title pt-0 mb-0 mt-0" style="position:relative;top:2px;">Item Categories</h5>
                                    </div>
                                    <div class="col text-right-sm d-flex justify-content-end align-items-center">
                                        <div class="float-right d-md-block">
                                            <a class="btn btn-primary btn-sm" href="<?= base_url('inventory/item_groups/add') ?>"><span class="fa fa-plus"></span> Add New Category</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pl-3 pr-3 mt-0 row">
                                <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Manage your item categories</span>
                                </div>
                            </div>
                            <div class="row">
                                <input type="hidden" id="selectedIds">
                                <div class="col-md-12" id="feesInventory">
                                    <table class="table table-hover table-bordered table-striped" style="width:100%;" id="item_groups_table">
                                        <thead>
                                        <tr>
                                            <th scope="col"><strong>Name</strong></th>
                                            <th scope="col"><strong>Description</strong></th>
                                            <th scope="col" class="text-center"><strong>Actions</strong></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($item_categories as $item) : ?>
                                            <tr>
                                                <td><?= $item->name; ?></td>
                                                <td><?= $item->description; ?></td>
                                                <td style="width:12%" class="pl-3">
                                                    <div class="dropdown dropdown-btn text-center">
                                                        <button class="btn btn-default" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                            <span class="btn-label">Manage <i class="fa fa-caret-down fa-sm" style="margin-left:10px;"></i></span></span>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                            <li role="presentation">
                                                                <a role="menuitem" href="<?php echo url('inventory/item_groups/edit/'.$item->item_categories_id); ?>">
                                                                    <span class="fa fa-pencil-square-o icon"></span> Edit
                                                                </a>
                                                            </li>
                                                            <li role="separator" class="divider"></li>
                                                            <li role="presentation">
                                                                <a role="menuitem" data-id="<?php echo $item->item_categories_id; ?>" href="javascript:void(0);" class="delete-item-category"><span class="fa fa-trash-o icon"></span> Delete</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                </div>
            </div>
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
    $(function(){
        $("#item_groups_table").DataTable({});
        $(".delete-item-category").on("click", function(event) {
            var ID = $(this).attr('data-id');
            // alert(ID);
            Swal.fire({
                title: 'Are your sure you want to delete selected item category?',
                text: "",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#32243d',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        dataType:"json",
                        url: base_url + "/inventory/item_groups/delete",
                        data: { id: ID}, // serializes the form's elements.
                        success: function(data) {
                            if (data.is_success == 1) {
                                Swal.fire({
                                  title: 'Great!',
                                  text: 'Item category was successfully deleted.',
                                  icon: 'success',
                                  showCancelButton: false,
                                  confirmButtonColor: '#32243d',
                                  cancelButtonColor: '#d33',
                                  confirmButtonText: 'Ok'
                                }).then((result) => {
                                  location.href = base_url + "/inventory/item_groups";
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    confirmButtonColor: '#32243d',
                                    html: 'Cannot find data'
                                });
                            }
                        }
                    });
                }
            });
        });
    });
    
</script>
