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
                                    <h5 class="page-title pt-0 mb-0 mt-0" style="position:relative;top:2px;">Inventory</h5>
                                </div>
                                <div class="col text-right-sm d-flex justify-content-end align-items-center">
                                    <div class="float-right d-md-block">
                                        <a href="<?= url('inventor/import') ?>">
                                            <button type="button" class="btn btn-primary btn-sm" id="exportCustomers"><span class="fa fa-download"></span> Import</button>
                                        </a>
                                        <button type="button" class="btn btn-primary btn-sm" id="exportItems"><span class="fa fa-upload"></span> Export</button>
                                        <a class="btn btn-primary btn-sm" href="<?= base_url('inventory/add') ?>"><span class="fa fa-plus"></span> Add New Item</a>
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
                            <div class="col-md-12" id="onHandInventory">
                                    <div class="dropdown" style="position: relative;display: inline-block;margin-bottom:10px;">
                                        <button class="btn btn-default batch-action-dp" type="button" data-toggle="dropdown" style="border-radius: 36px;" aria-expanded="false">
                                            Batch actions&nbsp;<i class="fa fa-angle-down fa-lg" style="margin-left:10px;"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(200px, 46px, 0px);">
                                            <li><a href="#" class="dropdown-item deleteSelect">Delete selected</a></li>
                                        </ul>
                                    </div>
                                    <table class="table table-hover table-bordered table-striped" style="width:100%;" id="inventoryOnHandItems">
                                        <thead>
                                            <tr>
                                                <th class="text-center"><input type="checkbox" class="form-control" id="inventoryItemCheckAll" value=""></th>
                                                <th scope="col"><strong>Item</strong></th>
                                                <th scope="col"><strong>Model</strong></th>
                                                <th scope="col"><strong>Brand</strong></th>
                                                <th scope="col"><strong>QTY-OH</strong></th>
                                                <th scope="col"><strong>Qty-Ordered</strong></th>
                                                <th scope="col"><strong>Re-order Point</strong></th>
                                                <th scope="col"><strong>Locations</strong></th>
                                                <th scope="col" ><strong>Actions</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($items as $item) : ?>
                                            <?php if($item[1] != "header") : ?>
                                                <tr>
                                                    <td class="text-center"><input type="checkbox" class="inventoryItem" data-id="<?php echo $item[3]; ?>" value=""></td>
                                                    <td>
                                                        <strong><?php echo $item[0]; ?></strong><br>
                                                        <span><?php echo $item[1]; ?></span>
                                                    </td>
                                                    <td><?php echo $item[7]; ?></td>
                                                    <td><?php echo $item[2]; ?></td>
                                                    <td><?php echo getItemQtyOH($item[3]); ?></td>
                                                    <td><?php echo $item[8]; ?></td>
                                                    <td><?php echo $item[9]; ?></td>
                                                    <td>
                                                        <!-- <a href='#' data-id="<?php echo $item[3]; ?>" data-toggle="modal" id="seeLocation" data-target="#modalAddLocation">See Location</a>  -->
                                                        <div class="dropdown dropdown-btn text-center">
                                                            <button class="btn btn-default" type="button" data-id="<?php echo $item[3]; ?>" id="seeLocation" data-toggle="dropdown" aria-expanded="true">
                                                                <span class="btn-label">See Location <i class="fa fa-caret-down fa-sm" style="margin-left:10px;"></i></span></span>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-right" id="<?php echo 'locQtyList' . $item[3]; ?>" style="width:300px;" role="menu" aria-labelledby="dropdown-edit">
                                                                <li role="presentation" style="background-color:#D3D3D3;">
                                                                    <a role="menuitem" tabindex="-1" href="javascript:void(0)" class="editItemBtn"><span style="padding-right:150px;"> <strong>Location</strong></span><span style="border-left:1px solid black;"> <strong>Qty</strong></span>
                                                                </li>
                                                                <li role="separator" class="divider"></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td style="width:12%" class="pl-3">
                                                        <div class="dropdown dropdown-btn text-center">
                                                            <button class="btn btn-default" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                                <span class="btn-label">Manage <i class="fa fa-caret-down fa-sm" style="margin-left:10px;"></i></span></span>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)" class="editItemBtn"  data-id="<?php echo $item[3]; ?>">
                                                                        <span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                                </li>
                                                                <li role="separator" class="divider"></li>
                                                                <li role="presentation">
                                                                    <a href="javascript:void(0)" id="<?= $item[3]; ?>" role="menuitem" tabindex="-1" class="delete_item">
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
                                                    <td colspan="6"><?php echo $item[0]; ?></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
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

        <!-- Modal Service Address -->
        <div class="modal fade" id="modalAddLocation" tabindex="-1" role="dialog" aria-labelledby="addLocationLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLocationLabel">Add Location</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 text-left form-group" id="addLocationForm">
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="job_customer">Location</label>
                                    <input type="text" id="itemLocation" class="form-control col-md-12">

                                </div>  
                                <div class="col-md-4">
                                    <label for="job_customer">Quantity</label>
                                    <input type="number" id="itemQuantity" class="form-control col-md-12">

                                </div> 
                                <div class="col-md-3">
                                    <br>
                                    <button type="button" class="btn btn-primary mt-2" id="saveAddLocation">Add Location</button>
                                </div>  
                            </div>
                        </div>  
                        <table class="table table-hover table-bordered table-striped" style="width:100%;" id="addNewLocationTable">
                            <thead>
                                <tr>
                                    <th scope="col"><strong>Location</strong></th>
                                    <th scope="col"><strong>Quantity</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($assignEmployees)) : ?>
                                <?php foreach($assignEmployees as $emp) : ?>
                                    <tr>
                                        <td class="pl-3"><?php echo $emp['title']; ?></td>
                                        <td class="pl-3"><?php echo $emp['emp_role']; ?></td>                                
                                    </tr>
                                <?php endforeach; ?>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>
        <!-- end row -->
        </div>
        <!-- end container-fluid -->
</div>
    <!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
    $(function(){
        $(".delete_item").on("click", function(event) {
            var ID = this.id;
            // alert(ID);
            Swal.fire({
                title: 'Continue to remove this Item?',
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
                        url: "/inventory/delete",
                        data: { id: ID}, // serializes the form's elements.
                        success: function(data) {
                            if (data === "1") {
                                window.location.reload();
                            } else {
                                alert(data);
                            }
                        }
                    });
                }
            });
        });

        $("#exportItems").click(function(){
            window.location.href= base_url + 'inventory/export_list';
        });    
    });    
</script>
