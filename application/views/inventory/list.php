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
                                        <a href="<?= url('customer/export') ?>">
                                            <button type="button" class="btn btn-primary btn-sm" id="exportCustomers"><span class="fa fa-upload"></span> Export</button>
                                        </a>
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
                            <?php if ($type == 'product' || empty($type)) : ?>
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
                                            <th scope="col" class="text-center"><strong>Actions</strong></th>
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
                                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)" class="editItemBtn"  data-id="<?php echo $item[3]; ?>"><span class="fa fa-pencil-square-o icon"></span> Edit</a></li>
                                                                <li role="separator" class="divider"></li>
                                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('inventory/delete?id='.$item[3]); ?>" class="deleteJobCurrentForm"><span class="fa fa-trash-o icon"></span> Delete</a></li>
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
                            <?php elseif ($type == 'service') : ?>
                                <div class="col-md-12" id="servicesInventory">
                                    <div class="row pt-4">
                                        <h4 for="exampleFormControlSelect1" class="col-md-10 text-left">Services</h4>
                                        <div style="margin-bottom:10px;" class="col-md-2 text-right">
                                            <button class="btn btn-primary" id="addNewServiceInventory">Add Services</button>
                                        </div>
                                    </div>
                                    <div class="dropdown" style="position: relative;display: inline-block;margin-bottom:10px;">
                                        <button class="btn btn-default batch-action-dp" type="button" data-toggle="dropdown" style="border-radius: 36px;" aria-expanded="false">
                                            Batch actions&nbsp;<i class="fa fa-angle-down fa-lg" style="margin-left:10px;"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(200px, 46px, 0px);">
                                            <li><a href="#" class="dropdown-item deleteSelect">Delete selected</a></li>
                                        </ul>
                                    </div>
                                    <table class="table table-hover table-bordered table-striped" style="width:100%;" id="serviceItemsTable">
                                        <thead>
                                        <tr>
                                            <th class="text-center"><input type="checkbox" class="form-control" id="inventoryServiceCheckAll" value=""></th>
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
                                                    <td class="text-center"><input type="checkbox" class="inventoryService" data-id="<?php echo $item[3]; ?>" value=""></td>
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
                                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)" class="editItemBtn"  data-id="<?php echo $item[3]; ?>"><span class="fa fa-pencil-square-o icon"></span> Edit</a></li>
                                                                <li role="separator" class="divider"></li>
                                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('inventory/delete?id='.$item[3]); ?>" class="deleteJobCurrentForm"><span class="fa fa-trash-o icon"></span> Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php else : ?>
                                                <tr style="background-color:#D3D3D3;">
                                                    <td>&nbsp;</td>
                                                    <td colspan="4"><?php echo $item[0]; ?></td>
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
                            <?php elseif ($type == 'fees') : ?>
                                <div class="col-md-12" id="feesInventory">
                                    <div class="row pt-4">
                                        <h4 class="col-md-10 text-left" for="exampleFormControlSelect1">Fees</h4>
                                        <div class="col-md-2 text-right" style="margin-bottom:10px;">
                                            <button class="btn btn-primary" id="addNewFeesInventory">Add Fee</button>
                                        </div>
                                    </div>
                                    <div class="dropdown" style="position: relative;display: inline-block;margin-bottom:10px;">
                                        <button class="btn btn-default batch-action-dp" type="button" data-toggle="dropdown" style="border-radius: 36px;" aria-expanded="false">
                                            Batch actions&nbsp;<i class="fa fa-angle-down fa-lg" style="margin-left:10px;"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(200px, 46px, 0px);">
                                            <li><a href="#" class="dropdown-item deleteSelect">Delete selected</a></li>
                                        </ul>
                                    </div>
                                    <table class="table table-hover table-bordered table-striped" style="width:100%;" id="feesItemsTable">
                                        <thead>
                                        <tr>
                                            <th class="text-center"><input type="checkbox" class="form-control" id="inventoryFeesCheckAll" value=""></th>
                                            <th scope="col"><strong>Item</strong></th>
                                            <th scope="col"><strong>Cost</strong></th>
                                            <th scope="col"><strong>Billing Type</strong></th>
                                            <th scope="col" class="text-center"><strong>Actions</strong></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($items as $item) : ?>
                                            <?php if($item[1] != "header") : ?>
                                                <tr>
                                                    <td class="text-center"><input type="checkbox" class="inventoryFees" data-id="<?php echo $item[3]; ?>" value=""></td>
                                                    <td><?php echo $item[0]; ?></td>
                                                    <td><?php echo $item[4]; ?></td>
                                                    <td><?php echo $item[5]; ?></td>
                                                    <td style="width:12%" class="pl-3">
                                                        <div class="dropdown dropdown-btn text-center">
                                                            <button class="btn btn-default" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                                <span class="btn-label">Manage <i class="fa fa-caret-down fa-sm" style="margin-left:10px;"></i></span></span>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)" class="editItemBtn"  data-id="<?php echo $item[3]; ?>"><span class="fa fa-pencil-square-o icon"></span> Edit</a></li>
                                                                <li role="separator" class="divider"></li>
                                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('inventory/delete?id='.$item[3]); ?>" class="deleteJobCurrentForm"><span class="fa fa-trash-o icon"></span> Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php else : ?>
                                                <tr style="background-color:#D3D3D3;">
                                                    <td>&nbsp;</td>
                                                    <td colspan="3"><?php echo $item[0]; ?></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php elseif ($type == 'itemgroup') : ?>
                                <div class="col-md-12" id="itemGroups">
                                    <div class="row col-md-12 pt-4 pl-0">
                                        <h4 class="col-md-10 pl-2 text-left" for="exampleFormControlSelect1">Create Item Groups</h4>
                                    </div>
                                    <?php echo form_open('inventory/saveItemsCategories', ['class' => 'form-validate require-validation', 'id' => 'item_categories_form', 'autocomplete' => 'off']); ?>
                                    <div class="row pl-2 pt-2 pb-2">
                                        <div class="row col-md-12">
                                            <label class="pt-2 pr-3">Group Name</label>
                                            <input type="text" id="groupNameField" name="groupName" required class="form-control col-md-6">
                                        </div>
                                    </div>
                                    <div class="row pl-2 pt-2 pb-2">
                                        <div style="margin-top:10px;" class="row col-md-12 pl-3">
                                            <label class="pt-2 pr-4">Description</label>
                                            <textarea rows="3" style="height:150px !important;" id="descriptionItemCat"  name="descriptionItemCat" class="form-control col-md-6"></textarea>
                                        </div>
                                    </div>

                                    <div style="margin-top:10px;" class="row pl-3">
                                        <div class="col-md-7 text-right pr-5">
                                            <button type="button" class="btn btn-default" id="cancelAddItemGroups">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            <?php endif; ?>
                            <div class="col-md-10" id="newItemInventory" style="display:none;">
                                <div class="row pt-4">
                                    <h4 for="exampleFormControlSelect1" class="col-md-10 pl-0 text-left">New Item</h4>
                                </div>
                                <?php echo form_open_multipart('inventory/saveItems', ['class' => 'form-validate require-validation', 'id' => 'new_item_form', 'autocomplete' => 'off']); ?>
                                <div class="row col-md-12">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Item Name</label>
                                    <input type="text" id="itemName" name="item_name" class="form-control col-md-5" required>
                                    <input type="hidden" name="item_type" value="inventory">
                                    <input type="hidden" name="item_id" id="itemId" value="0">
                                    <input type="hidden" name="event_type" id="event_type" value="save_another">
                                    <button type="submit" class="btn btn-primary col-md-2 ml-3" id="saveAddAnother">Save & Add Another</button>
                                </div>
                                <div class="row col-md-12 pt-2">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Description</label>
                                    <textarea rows="3" id="descriptionItem" name="description" class="form-control col-md-5"  required></textarea>
                                    <button type="submit" class="btn btn-primary col-md-2 ml-3" id="save_close_item">Save & Close</button>

                                </div>
                                <div class="row col-md-12 pt-2">
                                    <!-- <label class="col-md-2 pt-2 pl-0 text-left"></label> -->
                                    <div class="col-md-2 pt-2 pl-0" style="margin-left:17%;">
                                        <input type="checkbox" id="rebateField" name="cost" value="0">
                                        <label>Rebate Item</label></div>
                                </div>
                                <div class="row col-md-12 pt-2">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Brand</label>
                                    <input type="text" id="brandField" name="brand" class="form-control col-md-5" required>
                                    <button type="button" class="btn btn-default col-md-2 ml-3" id="closeAddNewItem">Close</button>
                                </div>
                                <div class="row col-md-12 pt-2">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Cost</label>
                                    <input type="text" id="costField" name="cost" class="form-control col-md-5" required>
                                </div>
                                <div class="row col-md-12 pt-2">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Retail Price</label>
                                    <input type="text" id="retailField" name="retailField" class="form-control col-md-5" required>
                                </div>
                                <div class="row col-md-12 pt-2">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Cost Per</label>
                                    <select class="form-control col-md-5" name="cost_per" id="cost_per" required>
                                        <option value="each" selected>Each</option>
                                        <option>Weight</option>
                                        <option>Length</option>
                                        <option>Area</option>
                                        <option>Volume</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                                <div class="row col-md-12 pt-2">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Unit</label>
                                    <input type="text" id="unitItem" name="unit" class="form-control col-md-5">
                                </div>
                                <div class="row col-md-12 pt-2">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Vendor</label>
                                    <select class="form-control col-md-5" name="vendor" id="exampleFormControlSelect1" required>
                                        <option disabled>Select</option>
                                        <option value="1">Vendor A</option>
                                        <option value="2">Vendor B</option>
                                    </select>
                                </div>
                                <div class="row col-md-12 pt-2">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Product URL</label>
                                    <input type="text" id="productUrlItem" name="product_url" class="form-control col-md-5" required>
                                </div>
                                <div class="row col-md-12 pt-2">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Costs of Goods</label>
                                    <input type="text" id="cogsItem" name="cost_of_goods" class="form-control col-md-5" required>
                                </div>
                                <div class="row col-md-12 pt-2">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Model Number</label>
                                    <input type="text" id="modelNumItem" name="model_number" class="form-control col-md-5" required>
                                </div>

                                <div class="row col-md-12 pt-2">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Serial Number</label>
                                    <input type="text" id="modelNumItem" name="serial_number" class="form-control col-md-5" >
                                </div>

                                <div class="row col-md-12 pt-2">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Points</label>
                                    <input type="text" id="modelNumItem" name="points" class="form-control col-md-5" >
                                </div>

                                <div class="row col-md-12 pt-2">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Quantity Order</label>
                                    <input type="text" id="modelNumItem" name="qty_order" class="form-control col-md-5" >
                                </div>

                                <div class="row col-md-12 pt-2">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Reorder Point</label>
                                    <input type="text" id="modelNumItem" name="re_order_points" class="form-control col-md-5" >
                                </div>

                                <div class="row col-md-12 pt-4">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Item Group</label>
                                    <select class="form-control col-md-5" name="item_category" id="exampleFormControlSelect1">
                                        <?php foreach($items_categories as $cat) : ?>
                                            <option value="<?php echo $cat->item_categories_id; ?>"><?php echo $cat->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="row col-md-12 pt-2" id="addLocationDiv">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Location</label>
                                    <button type="button" class="btn btn-primary col-md-3" id="addLocationNewItem" data-toggle="modal" data-target="#modalAddLocation">Add Location</button>
                                </div>
                                <div class="row col-md-12 pt-4">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Attach Image</label>
                                    <select class="form-control col-md-3" name="attach_img_item" id="attach_img_item">
                                        <option value="upload" selected>Upload</option>
                                        <option value="file_vault">Choose From File Vault</option>
                                    </select>
                                    <label class="col-md-1 pt-2 pl-0 text-left"></label>
                                    <button type="button" class="btn btn-primary col-md-1" id="goUpload">Go</button>
                                    <input type="file" onchange="readURL(this);" name="attach_photo" id="attach_photo" style="display:none;">
                                </div>
                                <div class="row col-md-12 pt-4">
                                    <label class="col-md-2 pt-2 pl-0 text-left"></label>
                                    <img id="img_profile" src="<?php echo $url->assets ?>img/img_default.png" alt="">
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                            <div class="col-md-10" id="newServiceInventory" style="display:none;">
                                <div class="row col-md-12 pt-4 pl-0">
                                    <h4 class="col-md-10 pl-0 text-left" for="exampleFormControlSelect1">New Service</h4>
                                </div>
                                <?php echo form_open('inventory/saveServiceItems', ['class' => 'form-validate require-validation', 'id' => 'service_item_form', 'autocomplete' => 'off']); ?>
                                <div class="row col-md-12">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Service Name</label>
                                    <input type="text" id="groupNameField" name="service_name" class="form-control col-md-5" required>
                                    <input type="hidden" name="service_item_type" value="service">
                                    <button type="submit" class="btn btn-primary col-md-2 ml-3">Submit</button>
                                </div>
                                <div class="row col-md-12 pt-2">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Description</label>
                                    <textarea rows="3" id="exampleFormControlTextarea1" name="service_description" class="form-control col-md-5" required></textarea>
                                    <button type="button" class="btn btn-default col-md-2 ml-3" id="cancelAddNewService">Cancel</button>
                                </div>
                                <div class="row col-md-12 pt-2">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Cost</label>
                                    <input type="text" id="groupNameField" name="service_cost" class="form-control col-md-5" required>
                                </div>
                                <div class="row col-md-12 pt-2">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Frequency</label>
                                    <select class="form-control col-md-5" name="service_frequency" id="exampleFormControlSelect1">
                                        <option selected>One Time</option>
                                        <option>Daily</option>
                                        <option>Monthly</option>
                                        <option>Yearly</option>
                                    </select>
                                </div>
                                <div class="row col-md-12 pt-2">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Time Estimate</label>
                                    <input type="text" name="serviceTimeEstimate" class="form-control col-md-5">
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                            <div class="col-md-10" id="newFeesInventory" style="display:none;">
                                <div class="row col-md-12 pt-4 pl-0">
                                    <h4 class="col-md-10 pl-0 text-left" for="exampleFormControlSelect1">New Fee</h4>
                                </div>
                                <?php echo form_open('inventory/saveFeeItems', ['class' => 'form-validate require-validation', 'id' => 'fees_item_form', 'autocomplete' => 'off']); ?>
                                <div class="row col-md-12">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Fee Name</label>
                                    <input type="text" id="groupNameField" name="fee_name" class="form-control col-md-5" required>
                                    <input type="hidden" name="fee_item_type" value="fees">
                                    <button type="submit" class="btn btn-primary col-md-2 ml-3">Submit</button>
                                </div>
                                <div class="row col-md-12 pt-2">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Description</label>
                                    <textarea rows="3" id="exampleFormControlTextarea1" name="fee_desc" class="form-control col-md-5" required></textarea>
                                    <button type="button" class="btn btn-default col-md-2 ml-3" id="cancelAddNewFee">Cancel</button>
                                </div>
                                <div class="row col-md-12 pt-2">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Cost</label>
                                    <input type="text" id="groupNameField" name="fee_cost" class="form-control col-md-5" required>
                                </div>
                                <div class="row col-md-12 pt-2">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Frequency</label>
                                    <select class="form-control col-md-5" name="fee_frequency" id="exampleFormControlSelect1">
                                        <option selected>One Time</option>
                                        <option>Daily</option>
                                        <option>Monthly</option>
                                        <option>Yearly</option>
                                    </select>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                            <div class="col-md-10" id="newServiceInventory" style="display:none;">
                                <div class="row col-md-12 pt-4 pl-0">
                                    <h4 class="col-md-10 pl-0 text-left" for="exampleFormControlSelect1">New Service</h4>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Service Name</label>
                                    <input type="text" id="groupNameField" class="form-control col-md-5">
                                    <button class="btn btn-primary col-md-2 ml-3">Submit</button>
                                </div>
                                <div class="row col-md-12 pt-2">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Description</label>
                                    <textarea rows="3" id="exampleFormControlTextarea1" class="form-control col-md-5"></textarea>
                                    <button class="btn btn-default col-md-2 ml-3">Cancel</button>
                                </div>
                                <div class="row col-md-12 pt-2">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Cost</label>
                                    <input type="text" id="groupNameField" class="form-control col-md-5">
                                </div>
                                <div class="row col-md-12 pt-2">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Frequency</label>
                                    <select class="form-control col-md-5" id="exampleFormControlSelect1">
                                        <option selected>One Time</option>
                                        <option>Daily</option>
                                        <option>Monthly</option>
                                        <option>Yearly</option>
                                    </select>
                                </div>
                                <div class="row col-md-12 pt-2">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Time Estimate</label>
                                    <input type="text" id="groupNameField" class="form-control col-md-5">
                                </div>
                            </div>
                            <div class="col-md-10" id="newFeesInventory" style="display:none;">
                                <div class="row col-md-12 pt-4 pl-0">
                                    <h4 class="col-md-10 pl-0 text-left" for="exampleFormControlSelect1">New Fee</h4>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Fee Name</label>
                                    <input type="text" id="groupNameField" class="form-control col-md-5">
                                    <button class="btn btn-primary col-md-2 ml-3">Submit</button>
                                </div>
                                <div class="row col-md-12 pt-2">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Description</label>
                                    <textarea rows="3" id="exampleFormControlTextarea1" class="form-control col-md-5"></textarea>
                                    <button class="btn btn-default col-md-2 ml-3">Cancel</button>
                                </div>
                                <div class="row col-md-12 pt-2">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Cost</label>
                                    <input type="text" id="groupNameField" class="form-control col-md-5">
                                </div>
                                <div class="row col-md-12 pt-2">
                                    <label class="col-md-2 pt-2 pl-0 text-left">Frequency</label>
                                    <select class="form-control col-md-5" id="exampleFormControlSelect1">
                                        <option selected>One Time</option>
                                        <option>Daily</option>
                                        <option>Monthly</option>
                                        <option>Yearly</option>
                                    </select>
                                </div>
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

        <!-- Modal New Customer -->
        <div class="modal fade" id="modalNewCustomer" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Customer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body pt-0 pl-3 pb-3"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

        <div class="modal fade" id="modalAddNewSource" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Source</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="frm_add_new_source" name="modal-form" method="post">
                                <div class="validation-error" style="display: none;"></div>
                                <div class="form-group">
                                    <label>Source Name</label> <span class="form-required">*</span>
                                    <input type="text" name="title" value="" class="form-control"
                                           autocomplete="off">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary save">Save changes</button>
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