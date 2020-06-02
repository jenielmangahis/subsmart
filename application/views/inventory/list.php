<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/inventory'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
    <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="page-title text-left">Inventory</h2>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="col-md-10" style="margin-bottom:10px;">
                                        <button class="btn btn-primary col-md-12" id="addOnHandInventory">On Hand</button>
                                    </div>
                                    <div class="col-md-10" style="margin-bottom:10px;">
                                        <button class="btn btn-primary col-md-12" id="addServicesInventory">Services</button>
                                    </div>
                                    <div class="col-md-10" style="margin-bottom:10px;">
                                        <button class="btn btn-primary col-md-12" id="addFeesInventory">Fees</button>
                                    </div>
                                    <div class="col-md-10" style="margin-bottom:10px;">
                                        <button class="btn btn-primary col-md-12" id="orderInventory">Order</button>
                                    </div>
                                    <div class="col-md-10" style="margin-bottom:10px;">
                                        <button class="btn btn-primary col-md-12" id="vendorInventory">Vendors</button>
                                    </div>
                                    <div class="col-md-10" style="margin-bottom:10px;">
                                        <button class="btn btn-primary col-md-12" id="reportsInventory">Reports</button>
                                    </div>
                                    <div class="col-md-10" style="margin-bottom:10px;">
                                        <button class="btn btn-primary col-md-12" id="addItemGroups">Item Groups</button>
                                    </div>
                                    <div class="col-md-10" style="margin-bottom:10px;">
                                        <button class="btn btn-primary col-md-12">Plans</button>
                                    </div>
                                </div>
                                <div class="col-md-10" id="onHandInventory">
                                    <div class="row pt-4">
                                        <h4 for="exampleFormControlSelect1" class="col-md-10 text-left">Inventory On Hand</h4>
                                        <div class="col-md-2 text-right" style="margin-bottom:10px;">
                                            <button class="btn btn-primary" id="addNewItemInventory">New Item</button>
                                        </div>
                                    </div>
                                    <div class="row col-md-6 pt-2 pb-4">
                                            <label class="pt-2 pr-5" for="">Select</label>
                                            <select class="form-control col-md-10" id="exampleFormControlSelect1">
                                                <option value="draft" selected>Show All</option>
                                                <?php foreach($items_categories as $cat) : ?>
                                                    <option value="<?php echo $cat->item_categories_id; ?>"><?php echo $cat->name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    <table class="table table-hover"> 
                                        <thead>
                                            <tr>
                                                <th scope="col"><strong>Item</strong></th>
                                                <th scope="col"><strong>Description</strong></th>
                                                <th scope="col"><strong>Brand</strong></th>
                                                <th scope="col"><strong>QTY-OH</strong></th>
                                                <th scope="col"><strong>Qty-Ordered</strong></th>
                                                <th scope="col"><strong>Locations</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($items as $item) : ?>
                                            <tr>
                                                <td><?php echo $item->title; ?></td>
                                                <td><?php echo $item->description; ?></td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table> 
                                </div>
                                <div class="col-md-10" id="servicesInventory" style="display:none;">
                                    <div class="row pt-4">
                                        <h4 for="exampleFormControlSelect1" class="col-md-10 text-left">Services</h4>
                                        <div style="margin-bottom:10px;" class="col-md-2 text-right">
                                            <button class="btn btn-primary" id="addNewServiceInventory">Add Services</button>
                                        </div>
                                    </div>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col"><strong>Item</strong></th>
                                                <th scope="col"><strong>Cost</strong></th>
                                                <th scope="col"><strong>Estimated Time</strong></th>
                                                <th scope="col"><strong>Billing Type</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table> 
                                </div>
                                <div class="col-md-10" id="feesInventory" style="display:none;">
                                    <div class="row pt-4">
                                        <h4 class="col-md-10 text-left" for="exampleFormControlSelect1">Fees</h4>
                                        <div class="col-md-2 text-right" style="margin-bottom:10px;">
                                            <button class="btn btn-primary" id="addNewFeesInventory">Add Fee</button>
                                        </div>
                                    </div>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col"><strong>Item</strong></th>
                                                <th scope="col"><strong>Cost</strong></th>
                                                <th scope="col"><strong>Billing Type</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table> 
                                </div>
                                <div class="col-md-10" id="itemGroups" style="display:none;">
                                    <div class="row col-md-12 pt-4 pl-0">
                                        <h4 class="col-md-10 pl-0" for="exampleFormControlSelect1">Create Item Groups</h4>
                                    </div>
                                    <?php echo form_open('inventory/saveItemsCategories', ['class' => 'form-validate require-validation', 'id' => 'item_categories_form', 'autocomplete' => 'off']); ?>
                                    <div class="row pl-2 pt-2 pb-2">
                                        <div class="row col-md-12">
                                            <label class="pt-2 pr-3">Group Name</label>
                                            <input type="text" id="groupNameField" name="groupName" required class="form-control col-md-5">
                                        </div>
                                    </div>
                                    <div class="row pl-2 pt-2 pb-2">
                                        <div style="margin-top:10px;" class="row col-md-12 pl-3">
                                            <label class="pt-2 pr-4">Description</label>
                                            <textarea rows="3" style="height:150px !important;" id="descriptionItemCat"  name="descriptionItemCat" class="form-control col-md-5"></textarea>
                                        </div>
                                    </div>

                                    <div style="margin-top:10px;" class="row pl-3">
                                        <div class="col-md-6 text-right pr-5">
                                            <button type="button" class="btn btn-default" id="cancelAddItemGroups">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                                <div class="col-md-10" id="newItemInventory" style="display:none;">
                                    <div class="row pt-4">
                                        <h4 for="exampleFormControlSelect1" class="col-md-10 pl-0 text-left">Create Item Groups</h4>
                                    </div>
                                    <?php echo form_open('inventory/saveItems', ['class' => 'form-validate require-validation', 'id' => 'new_item_form', 'autocomplete' => 'off']); ?>
                                    <div class="row col-md-12">
                                        <label class="col-md-2 pt-2 pl-0 text-left">Item Name</label>
                                        <input type="text" id="groupNameField" name="item_name" class="form-control col-md-5" required>
                                        <input type="hidden" name="item_type" value="material">
                                        <input type="hidden" name="event_type" id="event_type" value="save_another">
                                        <button type="submit" class="btn btn-primary col-md-2 ml-3">Save & Add Another</button>
                                    </div>
                                    <div class="row col-md-12 pt-2">
                                        <label class="col-md-2 pt-2 pl-0 text-left">Description</label>
                                        <textarea rows="3" id="exampleFormControlTextarea1" name="description" class="form-control col-md-5"  required></textarea>
                                        <button type="submit" class="btn btn-primary col-md-2 ml-3" id="save_close_item">Save & Close</button>
                                    </div>
                                    <div class="row col-md-12 pt-2">
                                        <label class="col-md-2 pt-2 pl-0 text-left">Cost</label>
                                        <input type="text" id="groupNameField" name="cost" class="form-control col-md-5" required>
                                        <button type="button" class="btn btn-default col-md-2 ml-3" id="closeAddNewItem">Close</button>
                                    </div>
                                    <div class="row col-md-12 pt-2">
                                        <label class="col-md-2 pt-2 pl-0 text-left">Cost Per</label>
                                        <select class="form-control col-md-5" name="cost_per" id="cost_per" required>
                                            <option value="each" selected>Each</option>
                                            <option>Weight</option>
                                            <option>Lenght</option>
                                            <option>Area</option>
                                            <option>Volume</option>
                                            <option>Other</option>
                                        </select>
                                    </div>
                                    <div class="row col-md-12 pt-2">
                                        <label class="col-md-2 pt-2 pl-0 text-left">Unit</label>
                                        <input type="text" id="groupNameField" name="unit" class="form-control col-md-5">
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
                                        <input type="text" id="groupNameField" name="product_url" class="form-control col-md-5" required>
                                    </div>
                                    <div class="row col-md-12 pt-2">
                                        <label class="col-md-2 pt-2 pl-0 text-left">Costs of Goods</label>
                                        <input type="text" id="groupNameField" name="cost_of_goods" class="form-control col-md-5" required>
                                    </div>
                                    <div class="row col-md-12 pt-2">
                                        <label class="col-md-2 pt-2 pl-0 text-left">Model Number</label>
                                        <input type="text" id="groupNameField" name="model_number" class="form-control col-md-5" required>
                                    </div>
                                    <div class="row col-md-12 pt-4">
                                        <label class="col-md-2 pt-2 pl-0 text-left">Item Category</label>
                                        <select class="form-control col-md-5" name="item_category" id="exampleFormControlSelect1" required>
                                            <option value="1" selected>Cameras</option>
                                            <option value="2">Locks</option>
                                            <option value="3">DVR</option>
                                            <option value="4">Add New</option>
                                        </select>
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
                                    <div class="row col-md-12">
                                        <label class="col-md-2 pt-2 pl-0 text-left">Service Name</label>
                                        <input type="text" id="groupNameField" class="form-control col-md-5">
                                        <button class="btn btn-primary col-md-2 ml-3">Submit</button>
                                    </div>
                                    <div class="row col-md-12 pt-2">
                                        <label class="col-md-2 pt-2 pl-0 text-left">Description</label>
                                        <textarea rows="3" id="exampleFormControlTextarea1" class="form-control col-md-5"></textarea>
                                        <button class="btn btn-default col-md-2 ml-3" id="cancelAddNewService">Cancel</button>
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
                                        <button class="btn btn-default col-md-2 ml-3" id="cancelAddNewFee">Cancel</button>
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
                    </div>
                    <!-- end card -->
                </div>
            </div>

            <!-- Modal Service Address -->
            <div class="modal fade" id="modalServiceAddress" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Service Address</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
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
</div>
<?php include viewPath('includes/footer'); ?>
<script src="<?php echo $url->assets ?>frontend/js/inventory/main.js"></script>