<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    <!-- page wrapper start -->
    <div>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Create Job</h1>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <?php if (hasPermissions('WORKORDER_MASTER')) : ?>
                                    <a href="<?php echo base_url('invoice') ?>" class="btn btn-primary"
                                       aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> Go Back to Invoices
                                    </a>
                                <?php endif ?>
                            </div>
                        </div>
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
                                <div class="col-md-2" style="margin-top:10px;">
                                    <label for="job_name">Job Number:</label>
                                </div>
                                <div class="col-md-2" style="margin-top:10px;">
                                    <label for="job_name">Added By:</label>
                                </div>
                                <div class="col-md-2" style="margin-top:10px;">
                                    <label for="job_name">Added Date:</label>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button class="btn btn-primary" data-action="update">Save</button>
                                    <button class="btn btn-primary" data-action="send">Edit</button>
                                    <a class="btn btn-default" href="<?php echo url('invoice') ?>">Cancel</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label for="job_name">Job Title</label>
                                    <input type="text" class="form-control" name="job_name" id="job_name" required/>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="invoice_customer">Customer</label>
                                    <select id="invoice_customer" name="customer_id"
                                            data-inquiry-source="dropdown" class="form-control searchable-dropdown"
                                            placeholder="Select customer">
                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <p>&nbsp;</p>
                                    <a class="link-modal-open" href="javascript:void(0)" data-toggle="modal"
                                       data-target="#modalNewCustomer"><span
                                                class="fa fa-plus fa-margin-right"></span>New Customer</a>
                                </div>
                                <div class="col-md-3 form-group">
                                </div>
                                <div class="col-md-2 form-group">
                                    <label for="exampleFormControlSelect1">Job Type</label>
                                    <select class="form-control" id="exampleFormControlSelect1">
                                    <option value="1" selected>New Installation</option>
                                    <option>System Upgrade</option>
                                    <option>Maintenance</option>
                                    <option>Monitoring</option>
                                    <option>Repair</option>
                                    <option>Warranty Call</option>
                                    <option>Design</option>
                                    </select>
                                </div>
                                <div class="col-md-1 form-group">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="invoice_job_location">Job Location</label>
                                    <select id="invoice_job_location" name="invoice_job_location_id"
                                            data-inquiry-source="dropdown" class="form-control searchable-dropdown"
                                            placeholder="Select Address">
                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <p>&nbsp;</p>
                                    <a class="link-modal-open" href="javascript:void(0)" data-toggle="modal"
                                       data-target="#modalNewLocationAddress"><span
                                                class="fa fa-plus fa-margin-right"></span>New Location Address</a>
                                </div>
                                <div class="col-md-3 form-group">
                                </div>
                                <div class="col-md-2 form-group">
                                    <label for="exampleFormControlSelect1">Priority</label>
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option value="" selected>Low Priority</option>
                                        <option>Medium Priority</option>
                                        <option>High Priority</option>
                                    </select>
                                </div>
                                <div class="col-md-1 form-group">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="exampleFormControlSelect1">Status</label>
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option value="" selected>Status</option>
                                        <option>Scheduled</option>
                                        <option>Waiting on Customer</option>
                                        <option>In Progress</option>
                                        <option>Completed</option>
                                        <option>Invoiced</option>
                                        <option>Canceled</option>   
                                        <option>Closed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="col-md-12" style="margin-bottom:10px;">
                                        <button class="btn btn-primary col-md-12" id="addEstimate">Estimate</button>
                                    </div>
                                    <div class="col-md-12" style="margin-bottom:10px;">
                                        <button class="btn btn-primary col-md-12" id="addWorkOrder">Work Order</button>
                                    </div>
                                    <div class="col-md-12" style="margin-bottom:10px;">
                                        <button class="btn btn-primary col-md-12" id="addInvoice">Invoice</button>
                                    </div>
                                    <div class="col-md-12" style="margin-bottom:10px;">
                                        <button class="btn btn-primary col-md-12">Survey</button>
                                    </div>
                                </div>
                                <div class="col-md-10" id="currentForms">
                                    <h4 for="exampleFormControlSelect1">Current Forms</h4>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col"><strong>Form Number</strong></th>
                                                <th scope="col"><strong>Type</strong></th>
                                                <th scope="col"><strong>Description</strong></th>
                                                <th scope="col"><strong>Status</strong></th>
                                                <th scope="col"><strong>Created</strong></th>
                                                <th scope="col"><strong>Completed</strong></th>
                                                <th scope="col"><strong>Created By</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table> 
                                </div>
                                <div class="col-md-10" id="estimateForms" style="display:none;">
                                    <div class="row">
                                        <div class="row col-md-8">
                                            <h4 class="pl-2" for="exampleFormControlSelect1">Estimate</h4>
                                        </div>
                                        <div class="row col-md-4">
                                            <label class="pt-2 pr-2" for="">Added By:</label>
                                        </div>
                                    </div>
                                    <div class="row pl-2 pt-2 pb-2">
                                        <div class="row col-md-8">
                                            <div class="row col-md-5">
                                                <label class="pt-2 pr-2" for="">Estimate Date</label>
                                                <input type="text" class="form-control col-md-6" id="estimateDate">
                                            </div>
                                            <div class="row col-md-5">
                                                <label class="pt-2 pr-3 pl-3" for="">Expiry Date</label>
                                                <input type="text" class="form-control col-md-6" id="expiryDateEstimate">
                                            </div>
                                        </div>
                                        <div class="row col-md-4">
                                            <label class="pt-2 pr-2" for="">Status</label>
                                            <select class="form-control col-md-7" id="exampleFormControlSelect1">
                                                <option value="draft" selected>Draft</option>
                                                <option>Scheduled</option>
                                                <option>In progress</option>
                                                <option>Completed</option>
                                                <option>Canceled</option>
                                                <option>Postponed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row pl-2 pt-2 pb-2">
                                        <div class="row col-md-8">
                                            <label class="pt-2 pr-4" for="">Description</label>
                                            <input type="text" class="form-control col-md-7" id="inlineFormInputName" placeholder="">
                                        </div>
                                        <div class="row col-md-4">
                                            <div class="col-md-6" style="margin-bottom:10px;">
                                                <button class="btn btn-primary col-md-12">Save</button>
                                            </div>
                                            <div class="col-md-6" style="margin-bottom:10px;">
                                                <button class="btn btn-primary col-md-12">Preview</button>
                                            </div>
                                            <div class="col-md-6" style="margin-bottom:10px;">
                                                <button class="btn btn-primary col-md-12">Edit</button>
                                            </div>
                                            <div class="col-md-6" style="margin-bottom:10px;">
                                                <button class="btn btn-primary col-md-12">Send to Customer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-10" id="workOrderForms" style="display:none;">
                                    <div class="row">
                                        <div class="row col-md-8">
                                            <h4 class="pl-2" for="exampleFormControlSelect1">Work Order</h4>
                                        </div>
                                        <div class="row col-md-4">
                                            <label class="pt-2 pr-2" for="">Added By:</label>
                                        </div>
                                    </div>
                                    <div class="row pl-2 pt-2 pb-2">
                                        <div class="row col-md-8">
                                            <label class="pt-2 pr-2" for="">Created Date</label>
                                            <input type="text" class="form-control col-md-2" id="workOrderCreatedDate" placeholder="">
                                        </div>
                                        <div class="row col-md-4">
                                            <label class="pt-2 pr-2" for="">Status</label>
                                            <select class="form-control col-md-7" id="exampleFormControlSelect1">
                                                <option value="draft" selected>Draft</option>
                                                <option>Scheduled</option>
                                                <option>In progress</option>
                                                <option>Completed</option>
                                                <option>Canceled</option>
                                                <option>Postponed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row pl-2 pt-2 pb-2">
                                        <div class="row col-md-8">
                                            <label class="pt-2 pr-4" for="">Description</label>
                                            <input type="text" class="form-control col-md-6" id="inlineFormInputName" placeholder="">
                                        </div>
                                        <div class="row col-md-4">
                                            <div class="col-md-6" style="margin-bottom:10px;">
                                                <button class="btn btn-primary col-md-12">Save</button>
                                            </div>
                                            <div class="col-md-6" style="margin-bottom:10px;">
                                                <button class="btn btn-primary col-md-12">Scheduled Appointment</button>
                                            </div>
                                            <div class="col-md-6" style="margin-bottom:10px;">
                                                <button class="btn btn-primary col-md-12">Edit</button>
                                            </div>
                                            <div class="col-md-6" style="margin-bottom:10px;">
                                                <button class="btn btn-primary col-md-12">Assign Tech</button>
                                            </div>
                                            <div class="col-md-6" style="margin-bottom:10px;">
                                                <button class="btn btn-primary col-md-12">Preview</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-10" id="invoiceForms" style="display:none;">
                                    <div class="row">
                                        <div class="row col-md-8">
                                            <h4 class="pl-2" for="exampleFormControlSelect1">Invoice</h4>
                                        </div>
                                        <div class="row col-md-4">
                                            <label class="pt-2 pr-2" for="">Added By:</label>
                                        </div>
                                    </div>
                                    <div class="row pl-2 pt-2 pb-2">
                                        <div class="row col-md-8">
                                            <label class="pt-2 pr-2" for="">Created Date</label>
                                            <input type="text" class="form-control col-md-2" id="invoiceCreatedDate">
                                        </div>
                                        <div class="row col-md-4">
                                            <label class="pt-2 pr-2" for="">Status</label>
                                            <select class="form-control col-md-7" id="exampleFormControlSelect1">
                                                <option value="draft" selected>Draft</option>
                                                <option>Scheduled</option>
                                                <option>In progress</option>
                                                <option>Completed</option>
                                                <option>Canceled</option>
                                                <option>Postponed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row pl-2 pt-2 pb-2">
                                        <div class="row col-md-8">
                                            <label class="pt-2 pr-4" for="">Description</label>
                                            <input type="text" class="form-control col-md-6" id="inlineFormInputName" placeholder="">
                                        </div>
                                        <div class="row col-md-4">
                                            <div class="col-md-6" style="margin-bottom:10px;">
                                                <button class="btn btn-primary col-md-12">Save</button>
                                            </div>
                                            <div class="col-md-6" style="margin-bottom:10px;">
                                                <button class="btn btn-primary col-md-12">Preview</button>
                                            </div>
                                            <div class="col-md-6" style="margin-bottom:10px;">
                                                <button class="btn btn-primary col-md-12">Edit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="items-tab" data-toggle="tab" href="#items" role="tab" aria-controls="items" aria-selected="true">Items</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom_fields-tab" data-toggle="tab" href="#custom_fields" role="tab" aria-controls="custom_fields" aria-selected="false">Custom Fields</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="agreement-tab" data-toggle="tab" href="#agreement" role="tab" aria-controls="agreement" aria-selected="false">Agreement</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="attachments-tab" data-toggle="tab" href="#attachments" role="tab" aria-controls="attachments" aria-selected="false">Attachments</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="internal_notes-tab" data-toggle="tab" href="#internal_notes" role="tab" aria-controls="internal_notes" aria-selected="false">Internal Notes</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="billing-tab" data-toggle="tab" href="#billing" role="tab" aria-controls="billing" aria-selected="false">Billing</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="false">History</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active margin-top" id="items" role="tabpanel" aria-labelledby="items-tab">
                                            <h4>Items</h4>
                                            <button class="btn btn-primary margin-bottom" id="addItems">Add Items</button>
                                            <table class="table table-hover" id="itemsTable">
                                                <thead>
                                                    <tr>
                                                        <th scope="col"><strong>Item</strong></th>
                                                        <th scope="col"><strong>Type</strong></th>
                                                        <th scope="col"><strong>Category</strong></th>
                                                        <th scope="col"><strong>Quantity</strong></th>
                                                        <th scope="col"><strong>Location</strong></th>
                                                        <th scope="col"><strong>Cost Per</strong></th>
                                                        <th scope="col"><strong>Discount</strong></th>
                                                        <th scope="col"><strong>Tax</strong></th>
                                                        <th scope="col"><strong>Total Cost</strong></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                            <div class="row" id="itemsTableSubTotal">
                                                <div class="col-md-7">
                                                &nbsp;
                                                </div>
                                                <div class="col-md-5 row pr-0">
                                                    <div class="col-sm-5">
                                                        <label style="padding: 0 .75rem;">Subtotal</label>
                                                    </div>
                                                    <div class="col-sm-6 text-right pr-3">
                                                        <label id="invoice_sub_total">0.00</label>
                                                        <input type="hidden" name="sub_total" id="sub_total_form_input" value='0'>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <hr>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <input type="text" name="adjustment_name" value="" placeholder="Adjustment" class="form-control" style="width:200px; display:inline; border: 1px dashed #d1d1d1">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="adjustment_total" id="adjustment_input" value="0" class="form-control" style="width:100px; display:inline-block">
                                                        <span class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Optional it allows you to adjust the total amount Eg. +10 or -10." data-original-title="" title=""></span>
                                                    </div>
                                                    <div class="col-sm-3 text-right pt-2">
                                                        <label id="adjustment_amount">0.00</label>
                                                        <input type="hidden" name="adjustment_amount" id="adjustment_amount_form_input" value='0'>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <hr>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <label style="padding: .375rem .75rem;">Grand Total ($)</label>
                                                    </div>
                                                    <div class="col-sm-6 text-right pr-3">
                                                        <label id="invoice_grand_total">0.00</label>
                                                        <input type="hidden" name="grand_total" id="grand_total_form_input" value='0'>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <hr>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="addItemsForms" style="display:none;">
                                                <h5>Pick Items</h5>
                                                <div class="row">
                                                    <div class="col-md-1" style="margin-top:10px;">
                                                        <label for="invoice_job_location">Item Groups</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <select class="form-control" id="exampleFormControlSelect1">
                                                            <option value="" selected>Service</option>
                                                            <option>Material</option>
                                                            <option>Cameras</option>
                                                            <option>Locks</option>
                                                            <option>DVR</option>
                                                            <option>Fees</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row pt-5">
                                                    <div class="col-md-1" style="margin-top:10px;">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <table class="table table-hover" id="itemsTable">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col"><strong>Item</strong></th>
                                                                    <th scope="col"><strong>Cost</strong></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-9 text-right">
                                                        <button class="btn btn-primary" data-action="update">Finished</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade pa-10 margin-left margin-top" id="custom_fields" role="tabpanel" aria-labelledby="custom_fields-tab">
                                            <h4>Additional Fields</h4>
                                            <div class="row">
                                                <div class="col-md-2" style="margin-top:10px;">
                                                    <label for="invoice_job_location">Choose Fields Set</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option value="" disabled selected>Select</option>
                                                        <option>Alarm Industry Requirements</option>
                                                        <option>Customer Field Addition</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-1" style="margin-top:13px;">
                                                    <i class="fa fa-plus-circle fa-lg" style="color:green; margin-right:5px;" aria-hidden="true"></i>
                                                    <i class="fa fa-minus-circle fa-lg" style="color:red;" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade pa-10 margin-left margin-top" id="agreement" role="tabpanel" aria-labelledby="agreement-tab">
                                            <h4>User Agreement</h4>
                                            <div class="row">
                                                <div class="col-md-2" style="margin-top:10px;">
                                                    <label for="invoice_job_location">Choose Fields Set</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>Install Agreement</option>
                                                        <option>Monitoring Agreement</option>
                                                        <option>Warrenty</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-1" style="margin-top:13px;">
                                                    <i class="fa fa-plus-circle fa-lg" style="color:green; margin-right:5px;" aria-hidden="true"></i>
                                                    <i class="fa fa-minus-circle fa-lg" style="color:red;" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade pa-10 margin-left margin-top" id="attachments" role="tabpanel" aria-labelledby="attachments-tab">
                                            <h4>Attachments</h4>
                                            <div class="row">
                                                <div class="col-md-2" style="margin-top:10px;">
                                                    <label for="invoice_job_location">Choose Fields Set</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>Choose form File Vault</option>
                                                        <option>Upload</option>
                                                        <option>Camera</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade pa-10 margin-left margin-top" id="internal_notes" role="tabpanel" aria-labelledby="internal_notes-tab">
                                            <h4>Internal Notes</h4>
                                            <div class="row">
                                                <div class="col-md-10 pl-5" style="margin-top:10px;">
                                                    <textarea rows="3" class="form-control" id="exampleFormControlTextarea1"></textarea>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="col-md-8" style="margin-bottom:10px;">
                                                        <button class="btn btn-primary col-md-12">Save</button>
                                                    </div>
                                                    <div class="col-md-8" style="margin-bottom:10px;">
                                                        <button class="btn btn-default col-md-12">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade pa-10 margin-left margin-top" id="billing" role="tabpanel" aria-labelledby="billing-tab">
                                            <h4>Billing</h4>
                                            <div class="row pl-2 pt-2 pb-2">
                                                <div class="row col-md-12">
                                                    <label class="pt-2 pr-2">Billing Date</label>
                                                    <input type="text" class="form-control col-md-2" id="billingDate">
                                                </div>
                                            </div>
                                            <div class="row pl-2 pt-2 pb-2">
                                                <label class="pt-2 pr-2" for="">Deposit Due</label>
                                                <label class="pt-2 pr-2" for="">$00.00</label>
                                            </div>
                                            <div class="row pl-2 pt-2 pb-2">
                                                <label class="pt-2 pr-2" for="">Total Due</label>
                                                <label class="pt-2 pr-2" for="">$00.00</label>
                                            </div>
                                            <div class="row pt-2 pl-2">
                                                <label for="" style="margin-right:105px;">Choose payment method</label>
                                                <div class="form-check form-check-inline pr-4">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="creditcard">
                                                    <label class="form-check-label" for="inlineRadio1">Credit Cards</label>
                                                </div>
                                                <div class="form-check form-check-inline pr-4">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="check">
                                                    <label class="form-check-label" for="inlineRadio2">Check</label>
                                                </div>
                                                <div class="form-check form-check-inline pr-4">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="cash">
                                                    <label class="form-check-label" for="inlineRadio3">Cash</label>
                                                </div>
                                                <div class="form-check form-check-inline pr-4">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="paypal">
                                                    <label class="form-check-label" for="inlineRadio4">Paypal</label>
                                                </div>
                                            </div>
                                            <div class="row pt-4 pl-4">
                                                <label class="pt-2 pr-2" for="">Card Type</label>
                                                <select name="card_type[]" id="show_card_type" class="form-control mb-2" style="display:inline-block; width: 170px;">
                                                    <option value="Visa">Visa</option>
                                                    <option value="Mastercard">Mastercard</option>
                                                    <option value="Discover">Discover</option>
                                                    <option value="American Express">American Express</option>
                                                </select>
                                                <label class="pt-2 pl-4 pr-2" for="">Card Number</label>
                                                <input type="text" class="form-control col-md-3" id="inlineFormInputName" placeholder="">
                                            </div>
                                            <div class="row pt-2 pl-4">
                                                <div class="row col-md-2">
                                                    <label class="pt-2 pr-2" for="">CVV #</label>
                                                    <input type="text" class="form-control col-md-8" id="inlineFormInputName" placeholder="">
                                                </div>
                                                <div class="row col-md-6">
                                                    <label class="pt-2 pl-4 pr-2" for="">Exp Date</label>
                                                    <input type="text" class="form-control col-md-3" id="billingExpDate" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade pa-10 margin-left margin-top" id="history" role="tabpanel" aria-labelledby="history-tab">
                                            <h4>History</h4>
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col"><strong>Action</strong></th>
                                                        <th scope="col"><strong>User</strong></th>
                                                        <th scope="col"><strong>Date/Time</strong></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
<script src="<?php echo $url->assets ?>frontend/js/job_creation/main.js"></script>