<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<?php include viewPath('inventory/css/lists_css'); ?>
<style>
.page-title, .box-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
  padding-top: 5px;
}
</style>
    <div class="wrapper" role="wrapper">
        <?php include viewPath('includes/sidebars/inventory'); ?>
        <!-- page wrapper start -->
        <div wrapper__section>
            <?php include viewPath('includes/notifications'); ?>
            <div class="container-fluid p-40">
                <div class="row custom__border">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body hid-desk pt-0" style="padding-bottom:0; padding-left:0; padding-right:0;">
                                <div class="row margin-bottom-ter mb-2 align-items-center" style="background-color:white; padding:0;">
                                    <div class="col-auto pl-0">
                                        <h5 class="page-title pt-0 mb-0 mt-0" style="position:relative;top:2px;">Services</h5>
                                    </div>
                                    <div class="col text-right-sm d-flex justify-content-end align-items-center">
                                        <div class="float-right d-md-block">
                                            <a class="btn btn-primary btn-sm" href="<?= base_url('inventory/services/add'); ?>"><span class="fa fa-plus"></span> Add New Service</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pl-3 pr-3 mt-0 row">
                                <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Track and manage the storage, request, transfer, and consumption of every item in your inventory, and ensure that your mobile workforce
                                    has the right parts in stock to do their job.</span>
                                </div>
                            </div>
                            <div class="row">
                                <input type="hidden" id="selectedIds">
                                <div class="col-md-12" id="servicesInventory">
                                        <div class="dropdown" style="position: relative;display: inline-block;margin-bottom:10px;">
                                            <button class="btn btn-default batch-action-dp" type="button" data-toggle="dropdown" style="border-radius: 36px;" aria-expanded="false">
                                                Batch actions&nbsp;<i class="fa fa-angle-down fa-lg" style="margin-left:10px;"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(200px, 46px, 0px);">
                                                <li><a href="#" class="dropdown-item deleteSelect">Delete selected</a></li>
                                            </ul>
                                        </div>
                                        <table class="table table-hover table-bordered table-striped" style="width:100%;" id="customServiceItemsTable">
                                            <thead>
                                            <tr>
                                                <th class="text-center"><input style="transform: scale(1.5); height: 20px;" type="checkbox" class="" id="inventoryServiceCheckAll" value=""></th>
                                                <th scope="col"><strong>Item</strong></th>
                                                <th scope="col"><strong>Cost</strong></th>
                                                <th scope="col"><strong>Estimated Time</strong></th>
                                                <th scope="col"><strong>Billing Type</strong></th>
                                                <th scope="col" class="text-center"><strong>Actions</strong></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($items as $item) : ?>
                                                <?php if($item[1] != "header") : ?>
                                                    <tr>
                                                        <td class="text-center"><input style="transform: scale(1.5);" type="checkbox" class="inventoryService" data-id="<?php echo $item[3]; ?>" value=""></td>
                                                        <td><?php echo $item[0]; ?></td>
                                                        <td><?php echo $item[4]; ?></td>
                                                        <td><?php echo $item[6]; ?></td>
                                                        <td><?php echo $item[5]; ?></td>
                                                        <td style="width:12%" class="pl-3">
                                                            <div class="dropdown dropdown-btn text-center">
                                                                <button class="btn btn-default" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                                    <span class="btn-label">Manage <i class="fa fa-caret-down fa-sm" style="margin-left:10px;"></i></span></span>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                                    <li role="presentation">
                                                                        <a role="menuitem" tabindex="-1" href="<?= base_url('inventory/edit_services/' . $item[10]); ?>"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                                        <!-- <a role="menuitem" tabindex="-1" href="javascript:void(0)" class="editItemBtn"  data-id="<?php echo $item[3]; ?>"><span class="fa fa-pencil-square-o icon"></span> Edit</a> -->
                                                                    </li>
                                                                    <li role="separator" class="divider"></li>
                                                                    <li role="presentation">
                                                                        <a href="javascript:void(0)" id="<?= $item[3]; ?>" role="menuitem" tabindex="-1"  class="delete_service">
                                                                            <span class="fa fa-trash-o icon"></span> Delete
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php else : ?>
                                                    <tr style="background-color:#D3D3D3;">
                                                        <td>&nbsp;</td>
                                                        <td colspan="4"><b><?php echo $item[0]; ?></b></td>
                                                        <td style="display: none"></td>
                                                        <td style="display: none"></td>
                                                        <td style="display: none"></td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                <?php endif; ?>
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
    $(".delete_service").on("click", function(event) {
        var ID = this.id;
        // alert(ID);
        Swal.fire({
            title: 'Continue to remove this Service?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#32243d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/inventory/delete",
                    data: { id: ID}, // serializes the form's elements.
                    success: function(data) {
                        if (data === "1") {
                            window.location.reload();
                        } else {
                            console.log(data);
                        }
                    }
                });
            }
        });
    });

    $("#customServiceItemsTable").DataTable({
        "autoWidth" : false,
       "columnDefs": [
            { width: 10, targets: 0 }            
        ],
        "ordering": false,
    });
</script>
