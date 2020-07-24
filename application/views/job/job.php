<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/job'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                        <?php if (empty($job_data)) : ?>
                            <?php echo form_open('job/saveJob', ['class' => 'form-validate require-validation', 'id' => 'item_categories_form', 'autocomplete' => 'off']); ?>
                        <?php else :?>
                            <?php echo form_open('job/updateJob', ['class' => 'form-validate require-validation', 'id' => 'item_categories_form', 'autocomplete' => 'off']); ?>
                        <?php endif;?>
                            <h2 class="page-title text-left">Create Job</h2>
                            <hr>
                            <div class="row">
                                <div class="col-md-2 text-left" style="margin-top:10px;">
                                    <label for="job_number">Job Number: <?php echo (!empty($job_data)) ? $job_data->job_number : $job_number; ?></label>
                                    <input type="hidden" name="jobNumber" value="<?php echo (!empty($job_data)) ? $job_data->job_number : $job_number; ?>">
                                </div>
                                <div class="col-md-2 text-left" style="margin-top:10px;">
                                    <label for="createdBy">Added By: <?php echo getLoggedFullName(0); ?></label>
                                    <input type="hidden" name="createdBy" value="<?php echo getLoggedUserID(); ?>">
                                </div>
                                <div class="col-md-2 text-left" style="margin-top:10px;">
                                    <label for="job_name">Added Date:</label>
                                    <label for="job_name"><?php echo (!empty($job_data)) ? date_format(date_create($job_data->created_date),"Y-m-d") : date('Y-m-d'); ?></label>
                                </div>
                                <div class="col-md-6 text-right">
                                    <input type="hidden" id="jobId" name="jobId" value="<?php echo(!empty($job_data)) ? $job_data->jobs_id : 0; ?>">
                                    <?php if(empty($job_data)) : ?>
                                    <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
                                    <?php else : ?>
                                    <button type="submit" class="btn btn-primary" id="editBtn">Edit</button>
                                    <?php endif;?>
                                    <a class="btn btn-default" id="cancelJobBtn" href="<?php echo url('job') ?>">Cancel</a>
                                </div>
                            </div>
                            <hr>
                            <div class="row mt-5">
                                <div class="col-md-3 text-left form-group">
                                    <label for="job_name">Job Title</label>
                                    <?php if(!empty($job_data)) : ?>
                                        <input type="text" class="form-control" name="job_name" id="job_name" value="<?php echo $job_data->job_name; ?>" required/>
                                    <?php else: ?>
                                        <input type="text" class="form-control" name="job_name" id="job_name" required/>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-3 text-left form-group">
                                    <label for="job_customer">Customer</label>
                                    <?php if(!empty($job_other_info)) : ?>
                                        <label for="">: <?php echo getLoggedFullName($job_other_info->id); ?></label> 
                                        <input type="hidden" id="job_owner_name" name="job_owner_name" value="<?php echo getLoggedName(); ?>">
                                        <input type="hidden" id="job_owner_email" name="job_owner_email" value="<?php echo getUserEmail(logged('id')); ?>">
                                        <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $job_other_info->id; ?>">
                                        <input type="hidden" id="customer_email" name="customer_email" value="<?php echo getUserEmail($job_other_info->id); ?>">
                                    <?php else: ?>
                                        <select class="form-control" id="job_customer" name="job_customer">
                                            <?php if(!empty($customers)) : ?>
                                                <option disabled selected>--Select--</option>
                                                <?php foreach($customers as $customer) : ?>
                                                    <option value="<?php echo $customer->user_id; ?>"><?php echo $customer->contact_name; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <input type="hidden" id="customer_id" name="customer_id" value="">
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-3 text-left form-group">
                                    <p>&nbsp;</p>
                                    <?php if(empty($job_other_info)) : ?>
                                    <a href="<?php echo url('customer/add') ?>"><span
                                                class="fa fa-plus fa-margin-right"></span>New Customer</a>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-3 form-group">
                                </div>
                                <div class="col-md-2 text-left form-group">
                                    <label for="exampleFormControlSelect1">Job Type</label>
                                    <select class="form-control" name="job_type" id="exampleFormControlSelect1" required>
                                    <?php foreach($job_settings as $job_set) : ?>
                                        <?php if($job_set->setting_type == "Job Type") :?>
                                        <option value="<?php echo $job_set->job_settings_id; ?>"><?php echo $job_set->value; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-1 form-group">
                                </div>
                                <div class="col-md-3 text-left form-group">
                                    <label for="job_location">Job Location</label>
                                    <?php if(!empty($job_other_info)) : ?>
                                        <label for="">: <?php echo getJobAddress($job_other_info->address_id); ?></label>
                                        <input type="hidden" id="job_location_id" name="job_location_id" value="<?php echo $job_other_info->address_id; ?>">
                                    <?php else: ?>
                                        <select class="form-control" id="customer_location" name="customer_location">
                                        </select>
                                        <input type="hidden" id="job_location_id" name="job_location_id">
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-3 text-left form-group">
                                    <?php if(empty($job_other_info)) : ?>
                                        <p>&nbsp;</p>
                                    <?php endif; ?>
                                    <a href="#" id="newLocationBtn" style="display:none;" data-toggle="modal" data-target="#modalAddressLocation">
                                        <span class="fa fa-plus fa-margin-right"></span>New Location
                                    </a>
                                </div>
                                <div class="col-md-3 form-group">
                                </div>
                                <div class="col-md-2 text-left form-group">
                                    <label for="exampleFormControlSelect1">Priority</label>
                                    <select class="form-control" id="job_priority" name="job_priority">
                                        <?php if(!empty($job_other_info)) : ?>
                                            <option value="<?php echo $job_other_info->priority; ?>" selected><?php echo ucwords($job_other_info->priority) . ' Priority'; ?></option>
                                            <?php foreach($job_settings as $job_set) : ?>
                                                <?php if($job_set->setting_type == "priority" && $job_set->value != $job_other_info->priority) :?>
                                                    <option value="<?php echo $job_set->value; ?>"><?php echo $job_set->value; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <?php foreach($job_settings as $job_set) : ?>
                                                 <?php if($job_set->setting_type == "priority") :?>
                                                    <option value="<?php echo $job_set->value; ?>"><?php echo $job_set->value; ?></option>
                                                 <?php endif; ?>
                                             <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-1 form-group">
                                </div>
                                <div class="col-md-3 text-left form-group">
                                    <label for="exampleFormControlSelect1">Status</label>
                                    <select class="form-control" id="job_status" name="job_status">
                                        <?php if(!empty($job_other_info)) : ?>
                                            <option value="<?php echo $job_other_info->status; ?>" selected><?php echo ucwords($job_other_info->status); ?></option>
                                            <?php foreach($job_settings as $job_set) : ?>
                                                <?php if($job_set->setting_type == "Job Status" && $job_set->value != $job_other_info->status) :?>
                                                <option value="<?php echo $job_set->value; ?>"><?php echo $job_set->value; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <?php foreach($job_settings as $job_set) : ?>
                                                <?php if($job_set->setting_type == "Job Status") :?>
                                                <option value="<?php echo $job_set->value; ?>"><?php echo $job_set->value; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                </div>
                                <div class="col-md-6 text-left form-group">
                                    <label for="exampleFormControlSelect1">Description:</label>
                                    <textarea class="form-control" placeholder="Message" id="job_description" name="job_description" class="phone-input-contact" style="height: 95px;"></textarea>
                                </div>
                            </div>
                            <hr style="border-top: 2px solid gray;">
                            <div class="row mb-5" style="background: none;">
                                <div class="pt-5">
                                    <div class="col-md-12" style="margin-bottom:10px;">
                                        <button type="button" class="btn btn-primary col-md-12" id="addEstimate">Estimate</button>
                                    </div>
                                    <div class="col-md-12" style="margin-bottom:10px;">
                                        <button type="button" class="btn btn-primary col-md-12" id="addWorkOrder">Work Order</button>
                                    </div>
                                    <div class="col-md-12" style="margin-bottom:10px;">
                                        <button type="button" class="btn btn-primary col-md-12" id="addInvoice">Invoice</button>
                                    </div>
                                    <div class="col-md-12" style="margin-bottom:10px;">
                                        <button type="button" class="btn btn-primary col-md-12">Survey</button>
                                    </div>
                                </div>
                                <div class="col-md-10 pt-5 text-left" id="currentForms">
                                    <h4 for="exampleFormControlSelect1">Current Forms</h4>
                                    <hr>
                                    <table class="table table-hover table-bordered table-striped" style="width:100%;" id="currentFormsTable">
                                        <thead>
                                            <tr>
                                                <th scope="col"><strong>Form Number</strong></th>
                                                <th scope="col"><strong>Type</strong></th>
                                                <th scope="col"><strong>Note</strong></th>
                                                <th scope="col"><strong>Status</strong></th>
                                                <th scope="col"><strong>Created</strong></th>
                                                <th scope="col"><strong>Completed</strong></th>
                                                <th scope="col"><strong>Created By</strong></th>
                                                <th scope="col"><strong>Action</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(!empty($estimates)) : ?>
                                            <?php foreach($estimates as $estimate) : ?>
                                                <tr>
                                                    <td class="pl-3"><?php echo 'EST-' . $estimate->estimate_number; ?></td>
                                                    <td class="pl-3">Estimate</td>
                                                    <td class="pl-3"><?php echo $estimate->description; ?></td>
                                                    <td class="pl-3"><?php echo $estimate->status; ?></td>
                                                    <td class="pl-3"><?php echo date_format(date_create($estimate->estimate_date),"d/m/Y"); ?></td>
                                                    <td class="pl-3"><?php echo date_format(date_create($estimate->expiry_date),"d/m/Y"); ?></td>
                                                    <td class="pl-3"><?php echo getLoggedFullName($job_other_info->id)?></td>
                                                    <td class="pl-3">
                                                        <a href="javascript:void(0)" class="btn btn-warning btn-sm"><span class="fa fa-pencil"></span> Edit</a>&nbsp;
                                                        <a href="<?php echo base_url('job/deleteJobForm?type=estimate&id='.$estimate->id .'&job_num='.$job_data->job_number); ?>" class="btn btn-danger btn-sm deleteJobCurrentForm"><span class="fa fa-trash"></span> Delete</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <?php if(!empty($invoices)) : ?>
                                            <?php foreach($invoices as $invoice) : ?>
                                                <tr>
                                                    <td class="pl-3"><?php echo 'INV-' . $invoice->invoice_number; ?></td>
                                                    <td class="pl-3">Invoice</td>
                                                    <td class="pl-3"><?php echo $invoice->description; ?></td>
                                                    <td class="pl-3"><?php echo $invoice->status; ?></td>
                                                    <td class="pl-3"><?php echo date_format(date_create($invoice->created_date),"d/m/Y"); ?></td>
                                                    <td class="pl-3">&nbsp;</td>
                                                    <td class="pl-3"><?php echo getLoggedFullName($invoice->created_by)?></td>
                                                    <td class="pl-3">
                                                        <a href="javascript:void(0)" class="btn btn-warning btn-sm"><span class="fa fa-pencil"></span> Edit</a>&nbsp;
                                                        <a href="<?php echo base_url('job/deleteJobForm?type=invoice&id='.$invoice->invoice_id .'&job_num='.$job_data->job_number); ?>" class="btn btn-danger btn-sm deleteJobCurrentForm"><span class="fa fa-trash"></span> Delete</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        </tbody>
                                    </table> 
                                </div>
                                <div class="col-md-10 pt-5 text-left" id="estimateForms" style="display:none;">
                                    <div class="row">
                                        <div class="row col-md-8">
                                            <h4 class="pl-2" for="exampleFormControlSelect1">Estimate</h4>
                                        </div>
                                        <div class="row col-md-4" style="display:none;">
                                            <label class="pt-2 pr-2" for="">Added By:</label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row pl-2 pt-2 pb-2">
                                        <div class="row col-md-8">
                                            <div class="row col-md-6">
                                                <label class="pt-2 pr-2" for="">Estimate Date:</label>
                                                <input type="text" class="form-control col-md-6" id="estimateDate">
                                            </div>
                                            <div class="row col-md-6">
                                                <label class="pt-2 pr-3 pl-3" for="">Expiry Date:</label>
                                                <input type="text" class="form-control col-md-6" id="expiryDateEstimate">
                                            </div>
                                        </div>
                                        <div class="row col-md-4">
                                            <label class="pt-2 pr-2" for="">Status:</label>
                                            <select class="form-control col-md-10" id="estimateStatus">
                                                <option value="Draft" selected>Draft</option>
                                                <option value="Scheduled">Scheduled</option>
                                                <option value="In progress">In progress</option>
                                                <option value="Completed">Completed</option>
                                                <option value="Canceled">Canceled</option>
                                                <option value="Postponed">Postponed</option>
                                            </select>
                                        </div>
                                        <div class="row pt-3 col-md-8">
                                            <div class="row col-md-6">
                                                <label class="pt-2 pr-2" for="">Estimate Value:</label>
                                                <input type="number" class="form-control col-md-6" id="estimate_value">
                                            </div>
                                            <div class="row col-md-6">
                                                <label class="pt-2 pr-3 pl-3" for="">Deposit Request:</label>
                                                <input type="number" class="form-control col-md-6" id="deposit_request">
                                            </div>
                                        </div>
                                        <div class="row col-md-4 pt-3 pl-0">
                                            <div class="col-md-6" style="margin-bottom:10px;">
                                                <button type="button" class="btn btn-primary col-md-12" id="saveEstimate">Save</button>
                                            </div>
                                            <div class="col-md-6" style="margin-bottom:10px;">
                                                <button type="button" class="btn btn-default col-md-12 previewCurrentJobTable">Preview</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pl-2 pt-1 pb-2">
                                        <div class="row col-md-8">
                                            <label class="pt-2 pr-4" for="">Description:</label>
                                            <input type="text" class="form-control col-md-9" id="estimateDescription" placeholder="">
                                        </div>
                                        <div class="row col-md-4 pl-0">
                                            <div class="col-md-6" style="margin-bottom:10px; display:none;">
                                                <button class="btn btn-primary col-md-12">Edit</button>
                                            </div>
                                            <div class="col-md-6" style="margin-bottom:10px;">
                                                <button type="button" class="btn btn-primary col-md-12 pl-1 pr-1" id="sendEmailCustomer">Send to Customer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-10 pt-5 text-left" id="workOrderForms" style="display:none;">
                                    <div class="row">
                                        <div class="row col-md-8">
                                            <h4 class="pl-2" for="exampleFormControlSelect1">Work Order</h4>
                                        </div>
                                        <div class="row col-md-4" style="display:none;">
                                            <label class="pt-2 pr-2" for="">Added By:</label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row pl-2 pt-2 pb-2">
                                        <div class="row col-md-8">
                                            <label class="pt-2 pr-2" for="">Created Date:</label>
                                            <input type="text" class="form-control col-md-3" id="workOrderCreatedDate" placeholder="">
                                        </div>
                                        <div class="row col-md-4">
                                            <label class="pt-2 pr-2" for="">Status:</label>
                                            <select class="form-control col-md-10" id="exampleFormControlSelect1">
                                                <option value="Draft" selected>Draft</option>
                                                <option value="Scheduled">Scheduled</option>
                                                <option value="In progress">In progress</option>
                                                <option value="Completed">Completed</option>
                                                <option value="Canceled">Canceled</option>
                                                <option value="Postponed">Postponed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row pl-2 pt-2 pb-2">
                                        <div class="row col-md-8">
                                            <label class="pt-2 pr-4" for="">Description:</label>
                                            <input type="text" class="form-control col-md-9" id="inlineFormInputName" placeholder="">
                                        </div>
                                        <div class="row col-md-4">
                                            <div class="col-md-6" style="margin-bottom:10px;">
                                                <button class="btn btn-primary col-md-12">Save</button>
                                            </div>
                                            <div class="col-md-6" style="margin-bottom:10px;">
                                                <button class="btn btn-primary col-md-12">Scheduled Appointment</button>
                                            </div>
                                            <div class="col-md-6" style="margin-bottom:10px; display:none;">
                                                <button class="btn btn-primary col-md-12">Edit</button>
                                            </div>
                                            <div class="col-md-6" style="margin-bottom:10px;">
                                                <button type="button" class="btn btn-primary col-md-12" data-toggle="modal" data-target="#assignEmployeeModal">Assign Employees</button>
                                            </div>
                                            <div class="col-md-6" style="margin-bottom:10px;">
                                                <button type="button" class="btn btn-default col-md-12 previewCurrentJobTable">Preview</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-10 pt-5 text-left" id="invoiceForms" style="display:none;">
                                    <div class="row">
                                        <div class="row col-md-8">
                                            <h4 class="pl-2" for="exampleFormControlSelect1">Invoice</h4>
                                        </div>
                                        <div class="row col-md-4" style="display:none;">
                                            <label class="pt-2 pr-2" for="">Added By:</label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row pl-2 pt-2 pb-2">
                                        <div class="row col-md-8">
                                            <label class="pt-2 pr-2" for="">Created Date</label>
                                            <input type="text" class="form-control col-md-3" name="invoiceCreatedDate" id="invoiceCreatedDate">
                                            <input type="hidden" id="jobNum" name="jobNum" value="<?php echo (!empty($job_data)) ? $job_data->job_number : $job_number; ?>">
                                        </div>
                                        <div class="row col-md-4">
                                            <label class="pt-2 pr-2" for="">Status</label>
                                            <select class="form-control col-md-10" id="invoiceStatus">
                                                <option value="Draft" selected>Draft</option>
                                                <option value="Scheduled">Scheduled</option>
                                                <option value="In progress">In progress</option>
                                                <option value="Completed">Completed</option>
                                                <option value="Canceled">Canceled</option>
                                                <option value="Postponed">Postponed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row pl-2 pt-2 pb-2">
                                        <div class="row col-md-8">
                                            <label class="pt-2 pr-4" for="">Description</label>
                                            <input type="text" class="form-control col-md-9" name="invoiceDescription" id="invoiceDescription" placeholder="">
                                        </div>
                                        <div class="row col-md-4">
                                            <div class="col-md-6" style="margin-bottom:10px;">
                                                <button type="button" id="saveJobInvoice" class="btn btn-primary col-md-12">Save</button>
                                            </div>
                                            <div class="col-md-6" style="margin-bottom:10px;">
                                                <button type="button" class="btn btn-default col-md-12 previewCurrentJobTable">Preview</button>
                                            </div>
                                            <div class="col-md-6" style="margin-bottom:10px;  display:none;">
                                                <button type="button" class="btn btn-primary col-md-12">Edit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5" style="background: none;">
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
                                    <div class="tab-content text-left" id="myTabContent">
                                        <div class="tab-pane fade show active margin-top" id="items" role="tabpanel" aria-labelledby="items-tab">
                                            <h4>Items</h4>
                                            <button type="button" class="btn btn-primary margin-bottom" id="addItems">Add Items</button>
                                            <div id="addItemsTableDiv">
                                                <table class="table table-hover table-bordered table-striped" style="width:100%;" id="addItemsTable">
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
                                                        <?php if (!empty($jobItems)) : ?>
                                                        <?php $subtotal=0;?>
                                                        <?php foreach($jobItems as $jobItem) : ?>
                                                            <tr>
                                                                <td class="pl-3"><?php echo $jobItem['title']; ?></td>
                                                                <td class="pl-3"><?php echo $jobItem['type']; ?></td>
                                                                <td class="pl-3">&nbsp;</td>
                                                                <td class="pl-3">
                                                                    <span style="cursor:pointer" data-id="<?php echo $jobItem['ihi_id']; ?>" data-value="<?php echo $jobItem['qty']; ?>" class="fa fa-lg fa-minus-circle pr-2 deductItemQty"></span>
                                                                    <span class="jobItemQty">
                                                                        <?php echo $jobItem['qty']; ?>
                                                                    </span>
                                                                    <span style="cursor:pointer" data-id="<?php echo $jobItem['ihi_id']; ?>" data-value="<?php echo $jobItem['qty']; ?>" class="fa fa-lg fa-plus-circle pl-2 addItemQty"></span></td>
                                                                <td class="pl-3"><a href="javascript:void(0)" data-toggle="modal" data-target="#modalItemLocation">Set Location</a></td>
                                                                <td class="pl-3"><?php echo number_format(floatval($jobItem['price']), 2); ?></td>
                                                                <td class="pl-3"><?php echo number_format(floatval($jobItem['discount']), 2); ?></td>
                                                                <td class="pl-3"><?php echo number_format(0, 2); ?></td>
                                                                <td class="pl-3"><?php echo number_format(floatval($jobItem['price'])*floatval($jobItem['qty']), 2); ?><?php $subtotal += floatval($jobItem['price'])*floatval($jobItem['qty']); ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        <?php endif;?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php if (!empty($jobItems)) : ?>
                                            <div class="row pt-4" id="itemsTableSubTotal">
                                                <div class="col-md-7">
                                                &nbsp;
                                                </div>
                                                <div class="col-md-5 row pr-0">
                                                    <div class="col-sm-6"></div>
                                                    <div class="col-sm-3">
                                                        <label style="padding: 0 .75rem;"><strong>Subtotal</strong></label>
                                                    </div>
                                                    <div class="col-sm-3 text-left pr-3">
                                                        <label id="invoice_sub_total">$<?php echo number_format(floatval($subtotal), 2); ?></label>
                                                        <input type="hidden" name="sub_total" id="sub_total_form_input" value='0'>
                                                    </div>
                                                    <div class="col-sm-6"></div>
                                                    <div class="col-sm-6"><hr></div>
                                                    <div class="col-sm-6"></div>
                                                    <div class="col-sm-3">
                                                        <label style="padding: 0 .75rem;"><strong>Adjustment</strong></label>
                                                    </div>
                                                    <div class="col-sm-3 text-left">
                                                        <input type="text" name="adjustment_total" id="adjustment_input" value="0" class="form-control" style="width:100px; display:inline-block">
                                                        <span class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Optional it allows you to adjust the total amount Eg. +10 or -10." data-original-title="" title=""></span>
                                                    </div>
                                                    <div class="col-sm-6"></div>
                                                    <div class="col-sm-6"><hr></div>
                                                    <div class="col-sm-6"></div>
                                                    <div class="col-sm-3">
                                                        <label style="padding: .375rem .75rem;"><strong>Tax</strong></label>
                                                    </div>
                                                    <div class="col-sm-3 text-left pr-3">
                                                        <label id="invoice_tax_total">$0.00</label>
                                                        <input type="hidden" name="grand_total" id="grand_total_form_input" value='0'>
                                                    </div>
                                                    <div class="col-sm-6"></div>
                                                    <div class="col-sm-6"><hr></div>
                                                    <div class="col-sm-6"></div>
                                                    <div class="col-sm-3">
                                                        <label style="padding: .375rem .75rem;"><strong>Grand Total</strong></label>
                                                    </div>
                                                    <div class="col-sm-3 text-left pr-3">
                                                        <label id="invoice_grand_total">$<?php echo number_format(floatval($subtotal), 2); ?></label>
                                                        <input type="hidden" name="grand_total" id="grand_total_form_input" value='0'>
                                                    </div>
                                                    <div class="col-sm-6"></div>
                                                    <div class="col-sm-6"><hr></div>
                                                </div>
                                            </div>
                                            <?php endif;?>
                                            <div id="addItemsForms" style="display:none;">
                                                <h5>Pick Items</h5>
                                                <div class="row">
                                                    <div class="col-md-1" style="margin-top:10px;">
                                                        <label for="invoice_job_location">Item Groups</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <select class="form-control" id="jobPickItems">
                                                            <option value="service" selected>Service</option>
                                                            <option value="material">Material</option>
                                                            <?php foreach($items_categories as $cat) : ?>
                                                                <option value="<?php echo $cat->item_categories_id; ?>"><?php echo $cat->name; ?></option>
                                                            <?php endforeach; ?>
                                                            <option>Fees</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row pt-5">
                                                    <div class="col-md-1" style="margin-top:10px;">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div id="itemsFeesDiv">
                                                            <table class="table table-hover table-bordered table-striped" style="width:100%;" id="itemsFeesTable">
                                                                <thead>
                                                                    <tr>
                                                                        <th>&nbsp;</th>
                                                                        <th scope="col"><strong>Item</strong></th>
                                                                        <th scope="col"><strong>Cost</strong></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div style="display:none;" id="addOnsItemsDiv">
                                                            <table class="table table-hover table-bordered table-striped" style="width:100%;" id="addOnsItemTable">
                                                                <thead>
                                                                    <tr>
                                                                        <th>&nbsp;</th>
                                                                        <th><strong>Item</strong></th>
                                                                        <th><strong>Vendor</strong></th>
                                                                        <th><strong>Cost</strong></th>
                                                                        <th><strong>On-Hand</strong></th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9 pt-3 text-right">
                                                        <button type="button" class="btn btn-primary" id="finishedItemForm">Finished</button>
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
                                            <div class="row pl-3 pt-2 pb-2">
                                                <div class="row col-md-12">
                                                    <label class="pt-2 pr-2">Billing Date</label>
                                                    <input type="text" class="form-control col-md-2" id="billingDate">
                                                </div>
                                            </div>
                                            <div class="row pl-3 pt-2 pb-2">
                                                <label class="pt-2 pr-2" for="">Deposit Due</label>
                                                <label class="pt-2 pr-2" for="">$00.00</label>
                                            </div>
                                            <div class="row pl-3 pt-2 pb-2">
                                                <label class="pt-2 pr-2" for="">Total Due</label>
                                                <label class="pt-2 pr-2" for="">$00.00</label>
                                            </div>
                                            <div class="row pt-3 pl-3">
                                                <label for="" style="margin-right:105px;">Choose payment method</label>
                                                <div class="form-check form-check-inline pr-4">
                                                    <input class="form-check-input payment_method" checked type="radio" name="payment_method" id="inlineRadio1" value="creditcard">
                                                    <label class="form-check-label" for="inlineRadio1">Credit Cards</label>
                                                </div>
                                                <div class="form-check form-check-inline pr-4">
                                                    <input class="form-check-input payment_method" type="radio" name="payment_method" id="inlineRadio2" value="check">
                                                    <label class="form-check-label" for="inlineRadio2">Check</label>
                                                </div>
                                                <div class="form-check form-check-inline pr-4">
                                                    <input class="form-check-input payment_method" type="radio" name="payment_method" id="inlineRadio3" value="cash">
                                                    <label class="form-check-label" for="inlineRadio3">Cash</label>
                                                </div>
                                                <div class="form-check form-check-inline pr-4">
                                                    <input class="form-check-input payment_method" type="radio" name="payment_method" id="inlineRadio4" value="paypal">
                                                    <label class="form-check-label" for="inlineRadio4">Paypal</label>
                                                </div>
                                            </div>
                                            <div id="creditcarddiv">                                            
                                                <div class="row pt-4 pl-4">
                                                    <label class="pt-2 pr-2" for="">Card Type</label>
                                                    <select name="cardType" id="show_card_type" class="form-control mb-2" style="display:inline-block; width: 170px;">
                                                        <option value="Visa">Visa</option>
                                                        <option value="Master">Mastercard</option>
                                                        <option value="Discover">Discover</option>
                                                        <option value="AMEX">American Express</option>
                                                    </select>
                                                    <label class="pt-2 pl-4 pr-2" for="">Card Number</label>
                                                    <input type="text" class="form-control col-md-3" name="cardNumber" id="cardNumber" placeholder="">
                                                </div>
                                                <div class="row pt-2 pl-4">
                                                    <div class="row col-md-2">
                                                        <label class="pt-2 pr-2" for="">CVV #</label>
                                                        <input type="text" class="form-control col-md-8" name="cvv" id="cvv" placeholder="">
                                                    </div>
                                                    <div class="row col-md-6">
                                                        <label class="pt-2 pl-4 pr-2" for="">Exp Date</label>
                                                        <input type="text" class="form-control col-md-3" name="billingExpDate" id="billingExpDate" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="checkdiv" style="display:none;">    
                                                <h4>Billing</h4>     
                                                <label for="" style="margin-right:105px;">Check Payment Information</label>
                                            </div>
                                            <div id="cashdiv" style="display:none;">    
                                                <h4>Cash</h4>     
                                                <div class="row pl-2 pt-2 pb-2">
                                                    <div class="row col-md-12">
                                                        <label class="pt-2 pr-2">Amount in Cash</label>
                                                        <input type="text" class="form-control col-md-2" id="amountInCash">
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="paypaldiv" style="display:none;">    
                                                <h4>PayPal</h4>     
                                                <a href="<?php echo base_url('job/buy/1'); ?>" target="_blank" class="btn btn-primary col-md-2">Connect with PayPal</a>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade pa-10 margin-left margin-top" id="history" role="tabpanel" aria-labelledby="history-tab">
                                            <h4>History</h4>
                                            <table class="table table-hover table-bordered table-striped" style="width:100%;" id="jobHistoryTable">
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
                        <?php echo form_close(); ?>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <div id="dialog" title="Error">
                <p id="dialogMsg"></p>
            </div>                                                         
            <!-- Modal Service Address -->
            <div class="modal fade" id="modalItemLocation" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Item Name</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">                       
                            <table class="table table-hover table-bordered table-striped" style="width:100%;" id="currentFormsTable">
                                <thead>
                                    <tr>
                                        <th scope="col"><strong>Item</strong></th>
                                        <th scope="col"><strong>Location</strong></th>
                                        <th scope="col"><strong>Special Instruction</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>                                       
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Address -->
            <div class="modal fade" id="modalAddressLocation" tabindex="-1" role="dialog"
                 aria-labelledby="newLocationLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newLocationLabel">New Location</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">                                
                            <div class="row">
                                <div class="col-md-12 text-left form-group">
                                    <label for="job_name">Address 1</label>
                                    <input type="text" class="form-control" name="address1" id="address1" placeholder="Address 1" required/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-left form-group">
                                    <label for="address2">Address 2</label>
                                    <input name="address2" id="address2" class="form-control" type="text" placeholder="Address 2">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 text-left form-group">
                                    <label for="city">City</label>
                                    <input name="city" id="city" class="form-control" type="text" placeholder="City">
                                </div>
                                <div class="col-md-4 text-left form-group">
                                    <label for="state">State</label>
                                    <input name="state" id="state" class="form-control" type="text" placeholder="State">
                                </div>
                                <div class="col-md-4 text-left form-group">
                                    <label for="postal_code">Postal Code</label>
                                    <input id="postal_code" name="postal_code" class="form-control" type="text" placeholder="Postal Code">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="saveNewLocation" data-dismiss="modal">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="assignEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="assignEmployeeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="assignEmployeeModalLabel">Assign Employees</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 text-left form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="job_customer">Role</label>
                                    <select class="form-control" id="assign_role" name="assign_role">
                                        <?php if(!empty($emp_roles)) : ?>
                                            <?php foreach($emp_roles as $role) : ?>
                                                <?php if($role->title == "Tech") : ?>
                                                    <?php $default_role = $role->id; ?>
                                                    <option value="<?php echo $role->id; ?>" selected><?php echo $role->title; ?></option>
                                                <?php endif; ?>
                                                <?php if($role->title != "Tech") : ?>
                                                    <option value="<?php echo $role->id; ?>"><?php echo $role->title; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>  
                                <div class="col-md-4">
                                    <label for="job_customer">Employees</label>
                                    <select class="form-control" id="assign_emp" name="assign_emp">
                                        <?php if(!empty($employees)) : ?>
                                            <?php foreach($employees as $employee) : ?>
                                                <?php if ($default_role == $employee->role_id) : ?>
                                                    <option value="<?php echo $employee->id; ?>"><?php echo $employee->title; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div> 
                                <div class="col-md-4">
                                    <br>
                                    <button type="button" class="btn btn-primary mt-2" id="add_assign_emp">Assign Employee</button>
                                </div>  
                            </div>
                        </div>  
                        <table class="table table-hover table-bordered table-striped" style="width:100%;" id="assignEmpTable">
                            <thead>
                                <tr>
                                    <th scope="col"><strong>Name</strong></th>
                                    <th scope="col"><strong>Role</strong></th>
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
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>