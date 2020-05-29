<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">

    <!-- page wrapper start -->
    <div>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Inventory</h1>
                    </div>
                    <div class="col-sm-12">
                        <div class="validation-error" id="estimate-error" style="display: none;">You selected Credit Card Payments as payment method for this invoice. Please configure the <a href="https://www.markate.com/pro/settings/payments/main">Online Payment processor</a> first to accept cart payments.</div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
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
                                    <div class="row col-md-12 pt-4">
                                        <h4 class="col-md-10 pl-0" for="exampleFormControlSelect1">Inventory On Hand</h4>
                                        <div class="col-md-2 text-right" style="margin-bottom:10px;">
                                            <button class="btn btn-primary col-md-12" id="addNewItemInventory">New Item</button>
                                        </div>
                                    </div>
                                    <div class="row col-md-6 pt-2 pb-4">
                                            <label class="pt-2 pr-5" for="">Status</label>
                                            <select class="form-control col-md-10" id="exampleFormControlSelect1">
                                                <option value="draft" selected>Show All</option>
                                                <option>Cameras</option>
                                                <option>Locks</option>
                                                <option>Personal Protection Device</option>
                                                <option>DVRs</option>
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
                                        </tbody>
                                    </table> 
                                </div>
                                <div class="col-md-10" id="servicesInventory" style="display:none;">
                                    <div class="row col-md-12 pt-4">
                                        <h4 class="col-md-10 pl-0" for="exampleFormControlSelect1">Services</h4>
                                        <div class="col-md-2 text-right" style="margin-bottom:10px;">
                                            <button class="btn btn-primary col-md-12">Add Services</button>
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
                                    <div class="row col-md-12 pt-4">
                                        <h4 class="col-md-10 pl-0" for="exampleFormControlSelect1">Fees</h4>
                                        <div class="col-md-2 text-right" style="margin-bottom:10px;">
                                            <button class="btn btn-primary col-md-12">Add Fee</button>
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
                                    <div class="row pl-2 pt-2 pb-2">
                                        <div class="row col-md-12">
                                            <label class="pt-2 pr-3">Group Name</label>
                                            <input type="text" id="groupNameField" class="form-control col-md-5">
                                        </div>
                                    </div>
                                    <div class="row pl-2 pt-2 pb-2">
                                        <div style="margin-top:10px;" class="row col-md-12 pl-3">
                                            <label class="pt-2 pr-4">Description</label>
                                            <textarea rows="3" style="height:150px !important;" id="exampleFormControlTextarea1" class="form-control col-md-5"></textarea>
                                        </div>
                                    </div>
                                    <div style="margin-top:10px;" class="row col-md-12 pl-3">
                                        <div style="margin-bottom:10px;" class="col-md-5 text-right">
                                            <button class="btn btn-default">Cancel</button>
                                        </div>
                                        <div class="col-md-6" style="margin-bottom:10px;">
                                            <button class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-10" id="newItemInventory" style="display:none;">
                                    <div class="row col-md-12 pt-4 pl-0">
                                        <h4 class="col-md-10 pl-0" for="exampleFormControlSelect1">New Item</h4>
                                    </div>
                                    <div class="row col-md-12">
                                        <label class="col-md-2 pt-2 pl-0 text-left">Item Name</label>
                                        <input type="text" id="groupNameField" class="form-control col-md-5">
                                        <button class="btn btn-primary col-md-2 ml-3">Save & Add Another</button>
                                    </div>
                                    <div class="row col-md-12 pt-2">
                                        <label class="col-md-2 pt-2 pl-0 text-left">Description</label>
                                        <textarea rows="3" id="exampleFormControlTextarea1" class="form-control col-md-5"></textarea>
                                        <button class="btn btn-primary col-md-2 ml-3">Save & Close</button>
                                    </div>
                                    <div class="row col-md-12 pt-2">
                                        <label class="col-md-2 pt-2 pl-0 text-left">Cost</label>
                                        <input type="text" id="groupNameField" class="form-control col-md-5">
                                        <button class="btn btn-default col-md-2 ml-3">Close</button>
                                    </div>
                                    <div class="row col-md-12 pt-2">
                                        <label class="col-md-2 pt-2 pl-0 text-left">Cost Per</label>
                                        <select class="form-control col-md-5" id="exampleFormControlSelect1">
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
                                        <input type="text" id="groupNameField" class="form-control col-md-5">
                                    </div>
                                    <div class="row col-md-12 pt-2">
                                        <label class="col-md-2 pt-2 pl-0 text-left">Vendor</label>
                                        <select class="form-control col-md-5" id="exampleFormControlSelect1">
                                            <option value="each" disabled>Select</option>
                                            <option>Vendor A</option>
                                            <option>Vendor B</option>
                                        </select>
                                    </div>
                                    <div class="row col-md-12 pt-2">
                                        <label class="col-md-2 pt-2 pl-0 text-left">Product URL</label>
                                        <input type="text" id="groupNameField" class="form-control col-md-5">
                                    </div>
                                    <div class="row col-md-12 pt-2">
                                        <label class="col-md-2 pt-2 pl-0 text-left">Costs of Goods</label>
                                        <input type="text" id="groupNameField" class="form-control col-md-5">
                                    </div>
                                    <div class="row col-md-12 pt-2">
                                        <label class="col-md-2 pt-2 pl-0 text-left">Model Number</label>
                                        <input type="text" id="groupNameField" class="form-control col-md-5">
                                    </div>
                                    <div class="row col-md-12 pt-4">
                                        <label class="col-md-2 pt-2 pl-0 text-left">Item Category</label>
                                        <select class="form-control col-md-5" id="exampleFormControlSelect1">
                                            <option value="each" selected>Cameras</option>
                                            <option>Locks</option>
                                            <option>DVR</option>
                                            <option>Add New</option>
                                        </select>
                                    </div>
                                    <div class="row col-md-12 pt-4">
                                        <label class="col-md-2 pt-2 pl-0 text-left">Attach Image</label>
                                        <select class="form-control col-md-3" id="exampleFormControlSelect1">
                                            <option value="each" selected>Upload</option>
                                            <option>Choose From File Vault</option>
                                        </select>
                                        <label class="col-md-1 pt-2 pl-0 text-left"></label>
                                        <button class="btn btn-primary col-md-1">Go</button>
                                    </div>
                                    <div class="row col-md-12 pt-4">
                                        <label class="col-md-2 pt-2 pl-0 text-left"></label>
                                        <img src="<?php echo $url->assets ?>img/img_default.png" alt="">
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