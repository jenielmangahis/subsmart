<div class="modal fade nsm-modal fade" id="create_calendar_modal" tabindex="-1" aria-labelledby="create_calendar_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <?php echo form_open_multipart('', ['id' => 'create-google-calendar', 'class' => 'form-validate', 'autocomplete' => 'off']); ?>
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Create Google Calendar</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="gevent_gcid" id="gevent_gcid" value="">
                <div class="row-g-3">
                    <div class="col-12">
                        <label class="content-subtitle fw-bold d-block mb-2">Calendar Name *</label>
                        <input type="text" name="gcalendar_name" class="nsm-field form-control" required />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="nsm-button primary">Save</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="create_appointment_modal" aria-labelledby="create_appointment_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="frm-create-appointment" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Create Appointment</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="action_select_date" value="" />        
                    <input type="hidden" id="action_select_time" value="" />        
                    <input type="hidden" id="action_select_user" value="" />  
                    <div class="select-appointment-type">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <label class="content-subtitle fw-bold d-block mb-2">Appointment Type</label>
                                <select name="appointment_type_id" class="nsm-field form-select add-appointment-type" required style="display: inline-block;width: 60%;">
                                    <?php $start = 0; ?>
                                    <option value="0">- Select Appointment Type -</option>
                                    <?php foreach ($appointmentTypes as $a) { ?>
                                        <option value="<?= $a->id; ?>"><?= $a->name; ?></option>
                                    <?php $start++; } ?>
                                </select>
                                <!-- <a class="nsm-button" href="<?= base_url('appointment_types/index'); ?>" style="display: inline-block;padding: 2px;margin: 1px;position: relative;top: 3px;padding-right: 10px;">
                                    <i class='bx bx-fw bx-plus'></i> Manage Type
                                </a> -->
                            </div>
                        </div>
                    </div>      
                    <div class="row g-3 appointment-form" style="display: none;">
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">When</label>
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <input type="text" name="appointment_date" id="appointment_date" class="nsm-field form-control datepicker" placeholder="Date" required style="padding: 0.375rem 0.75rem;">                                    
                                </div>
                                <div class="col-12 col-md-3">
                                    <input type="text" name="appointment_time_from" id="appointment_time" class="nsm-field form-control timepicker-from" value="" placeholder="Time From" required />
                                </div>
                                <div class="col-12 col-md-3">
                                    <input type="text" name="appointment_time_to" id="appointment_time_to" class="nsm-field form-control timepicker-to" placeholder="Time To" value="<?= $default_time_to; ?>" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Created By</label>
                            <span id="wait-list-created-by">
                                <input type="text" value="<?= $userLogged->FName . ' ' . $userLogged->LName; ?>" class="nsm-field form-select" readonly="readonly" disabled="disabled">
                            </span>                                                        
                        </div>
                        <div class="col-12 event-description-container" style="<?= $default_appointment_type_id != 4 ? 'display: none;' : ''; ?>">
                            <label class="content-subtitle fw-bold d-block mb-2">Event Name</label>
                            <span id="wait-list-created-by">
                                <input type="text" value="" name="appointment_event_name" class="nsm-field form-control" />
                            </span>                                                        
                        </div>
                        <div class="col-12 event-location-container" style="<?= $default_appointment_type_id != 4 ? 'display: none;' : ''; ?>">
                            <label class="content-subtitle fw-bold d-block mb-2">Event Location</label>
                            <span id="wait-list-created-by">
                                <textarea id="appointment-event-location" name="appointment_event_location" class="nsm-field form-control"></textarea>
                            </span>                                                        
                        </div>
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2 create-tech-attendees">Attendees</label>
                            <span id="wait-list-add-employee-popover" data-toggle="popover" data-placement="right"data-container="body">
                                <select class="nsm-field form-select" name="appointment_user_id[]" id="appointment-user" multiple="multiple"></select>
                            </span>                                                        
                        </div>
                        <div class="col-12 appointment-add-sales-agent" style="display:none;">
                            <label class="content-subtitle fw-bold d-block mb-2">Sales Agent</label>
                            <span id="wait-list-add-sales-agent-popover" data-toggle="popover" data-placement="right"data-container="body">
                                <select class="nsm-field form-select" name="appointment_sales_agent_id" id="appointment-sales-agent-id"></select>
                            </span>                                                        
                        </div>
                        
                        <div class="col-12 customer-container" style="<?= $default_appointment_type_id == 4 ? 'display: none;' : ''; ?>">
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="content-subtitle fw-bold d-block mb-2">Which Customer</label>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="javascript:void(0);" class="content-subtitle d-block mb-2 nsm-link btn-quick-add-customer">Add New Customer</a>
                                </div>
                            </div>
                            <span id="add-customer-popover" data-toggle="popover" data-placement="right"data-container="body">
                                <select class="nsm-field form-select" name="appointment_customer_id" id="appointment-customer"></select>
                            </span>
                            <div class="customer-address"></div>
                        </div>
                        <div class="col-12">
                            <div class="row">  
                                <div class="col-6">
                                    <label class="content-subtitle fw-bold d-block mb-2">Status</label>
                                    <select name="appointment_status" class="nsm-field form-select appointment-status" required style="display: inline-block;">
                                        <option value="New">New</option>
                                        <option value="Draft">Draft</option>
                                        <option value="Scheduled">Scheduled</option>
                                        <option value="Arrival">Arrival</option>
                                        <option value="Paused">Paused</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Invoiced">Invoiced</option>
                                        <option value="Closed">Closed</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>                                    
                                </div>                              
                                <div class="col-6">
                                    <label class="content-subtitle fw-bold d-block mb-2">Priority</label>
                                    <select name="appointment_priority" class="nsm-field form-select add-appointment-priority" required>
                                        <?php foreach($appointmentPriorityEventOptions as $priority){ ?>
                                            <option value="<?= $priority; ?>"><?= $priority; ?></option>
                                        <?php } ?>
                                    </select>   
                                    <input type="text" value="" name="appointment_priority_others" placeholder="Please specify" class="nsm-field form-select priority-others" style="margin-top:5px;display: none;">
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-12 invoice-price-container" style="display:none;">
                            <div class="row">
                                <div class="col-6">
                                    <label class="content-subtitle fw-bold d-block mb-2">Invoice Number</label>
                                    <input type="text" id="appointment-invoice-number" name="appointment_invoice_number" class="nsm-field form-control" />
                                </div>
                                <div class="col-6">
                                    <label class="content-subtitle fw-bold d-block mb-2">Price</label>
                                    <input type="number" id="appointment-price" name="appointment_price" class="nsm-field form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <label class="content-subtitle fw-bold d-block mb-2">Tags</label>
                                    <span id="add-tag-popover" data-toggle="popover" data-placement="right"data-container="body" style="display: inline-block;width: 60% !important;">
                                        <select class="nsm-field form-select" name="appointment_tags[]" id="appointment-tags" multiple="multiple"></select>
                                    </span> 
                                    <?php 
                                        if( $default_appointment_type_id == 4 ){ //Events
                                            $manage_tags_url = base_url('events/event_tags');
                                        }else{
                                            $manage_tags_url = base_url('job/job_tags');
                                        }
                                    ?>
                                    <a class="nsm-button btn-manage-tags" href="<?= $manage_tags_url; ?>" style="display: inline-block;padding: 2px;margin: 1px;position: relative;top: 3px;padding-right: 10px;">
                                        <i class='bx bx-fw bx-plus'></i> Manage Tags
                                    </a>
                                </div>
                                <div class="col-6">
                                    <label class="content-subtitle fw-bold d-block mb-2">URL Link <small style="color:#ff4d4d;">(Must be public url)</small></label>
                                    <input type="text" name="url_link" id="ulr-link" class="nsm-field form-control" placeholder="URL Link" style="padding: 0.375rem 0.75rem;">
                                </div>                                
                            </div>
                        </div>                    
                        <div class="col-12">
                            <div class="col-12">
                                <label class="content-subtitle fw-bold d-block mb-2">Notes</label>
                                <textarea id="appointment-notes" name="appointment_notes" class="nsm-field form-control"></textarea>
                            </div>
                        </div>
                    </div>                    
                </div>
                <div class="modal-footer" style="display:block;">                    
                    <div style="float:right;">
                        <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button primary btn-create-appointment" style="display:none;">Schedule</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="create_waitlist_modal" tabindex="-1" aria-labelledby="create_waitlist_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form id="frm-create-appointment-wait-list" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Create Wait List</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Preferred Date</label>
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <span id="waitlist-date-popover" data-toggle="popover" data-placement="right"data-container="body">
                                    <input type="text" name="appointment_date" id="waitlist-date" class="nsm-field form-control datepicker" placeholder="Date" required style="padding: 0.375rem 0.75rem;">
                                    </span>
                                </div>
                                <div class="col-12 col-md-3">
                                    <span id="waitlist-time-popover" data-toggle="popover" data-placement="right"data-container="body">
                                        <input type="text" name="appointment_time_from" id="waitlist-time-from" class="nsm-field form-control timepicker" placeholder="Time From" required />
                                    </span>
                                </div>
                                <div class="col-12 col-md-3">
                                    <input type="text" name="appointment_time_to" id="waitlist-time-to" class="nsm-field form-control timepicker" placeholder="Time To" value="" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="content-subtitle fw-bold d-block mb-2">Which Customer</label>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="javascript:void(0);" class="content-subtitle d-block mb-2 nsm-link btn-quick-add-customer">Add New Customer</a>
                                </div>
                            </div>
                            <span id="waitlist-customer-popover" data-toggle="popover" data-placement="right"data-container="body">
                                <select class="nsm-field form-select" name="appointment_customer_id" id="wait-list-appointment-customer"></select>
                            </span>
                        </div>
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Appointment Type</label>
                            <span id="waitlist-appointment-type-popover" data-toggle="popover" data-placement="right"data-container="body">
                                <select name="appointment_type_id" id="wait-list-appointment-type" class="nsm-field form-select" required>
                                    <?php $start = 0; ?>
                                    <?php foreach ($appointmentTypes as $a) { ?>
                                        <option <?= $start == 0 ? 'selected="selected"' : ''; ?> value="<?= $a->id; ?>"><?= $a->name; ?></option>
                                    <?php $start++;
                                    } ?>
                                </select>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary">Schedule</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade nsm-modal fade" id="quick_add_customer_modal" tabindex="-1" aria-labelledby="quick_add_customer_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="frm-ql-add-customer" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Quick Add Customer</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Customer Name</label>
                            <div class="row g-3">
                                <div class="col-12 col-md-4">
                                    <input type="text" name="ql_customer_first_name" class="nsm-field form-control" placeholder="First Name" required>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="text" name="ql_customer_middle_name" class="nsm-field form-control" placeholder="Middle Name" required>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="text" name="ql_customer_last_name" class="nsm-field form-control" placeholder="Last Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Business Name</label>
                            <input type="text" name="ql_business_name" class="nsm-field form-control" placeholder="Business Name" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Email</label>
                            <input type="email" name="ql_customer_email" class="nsm-field form-control" placeholder="Email Address" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Mobile Number</label>
                            <input type="text" name="ql_customer_phone_number" class="nsm-field form-control" placeholder="Mobile Number" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="update_waitlist_modal" tabindex="-1" aria-labelledby="update_waitlist_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form id="frm-update-appointment-wait-list" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Update Wait List</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="wid" value="" id="wid">
                    <div class="row g-3" id="update_waitlist_container">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button error" id="btn_delete_waitlist">Delete</button>
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary">Schedule</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="view_appointment_modal" tabindex="-1" aria-labelledby="view_appointment_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">View Appointment</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row g-3" id="view_appointment_container">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button error" id="btn_delete_appointment">Delete</button>
                <!-- <button type="button" class="nsm-button" id="btn_checkout_appointment">Checkout</button>
                <button type="button" class="nsm-button" style="display: none;" id="btn_payment_details_appointment">Payment Details</button> -->
                <button type="button" class="nsm-button primary" id="btn_edit_appointment">Edit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="view_tcoff_modal" tabindex="-1" aria-labelledby="view_tcoff_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">View Technician Off Details</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row g-3" id="view_tcoff_container">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button error" id="btn_delete_tcoff">Delete</button>
                <button type="button" class="nsm-button primary" id="btn_edit_tcoff">Edit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="edit_appointment_modal" tabindex="-1" aria-labelledby="edit_appointment_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="frm-update-appointment" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Edit Appointment</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="aid" id="edit-aid" value="">
                    <div class="row g-3" id="edit_appointment_container">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="checkout_appointment_modal" tabindex="-1" aria-labelledby="checkout_appointment_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Checkout</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row g-3" id="checkoout_appointment_container">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="checkout_add_item_modal" tabindex="-1" aria-labelledby="checkout_add_item_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Select Item</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row g-3" id="checkoout_items_container">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="appointment_details_modal" tabindex="-1" aria-labelledby="appointment_details_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Appointment Payment Details</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row g-3" id="appointment_details_container">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Priority -->
<div class="modal fade nsm-modal fade" id="create_priority_modal" tabindex="-1" aria-labelledby="create_priority_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <?php echo form_open_multipart('', ['id' => 'create-workorder-priority', 'class' => 'form-validate', 'autocomplete' => 'off']); ?>
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Create Priority</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">                
                <div class="row-g-3">
                    <div class="col-12">
                        <label class="content-subtitle fw-bold d-block mb-2">Name *</label>
                        <input type="text" name="priority_name" class="nsm-field form-control" required />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="nsm-button primary btn-save-workorder-priority">Save</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="edit_priority_modal" tabindex="-1" aria-labelledby="edit_priority_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <?php echo form_open_multipart('', ['id' => 'update-workorder-priority', 'class' => 'form-validate', 'autocomplete' => 'off']); ?>
        <input type="hidden" name="pid" id="priority_id" value="">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Update Priority</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">                
                <div class="row-g-3">
                    <div class="col-12">
                        <label class="content-subtitle fw-bold d-block mb-2">Name *</label>
                        <input type="text" name="priority_name" id="edit_priority_name" class="nsm-field form-control" required />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="nsm-button primary btn-update-workorder-priority">Save</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- Appointment Types -->
<div class="modal fade nsm-modal fade" id="create_appointment_type_modal" tabindex="-1" aria-labelledby="create_appointment_type_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <?php echo form_open_multipart('', ['id' => 'frm-create-appointment-type', 'class' => 'form-validate', 'autocomplete' => 'off']); ?>
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Create Appointment Type</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">                
                <div class="row-g-3">
                    <div class="col-12">
                        <label class="content-subtitle fw-bold d-block mb-2">Name *</label>
                        <input type="text" name="appointment_type_name" class="nsm-field form-control" required />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="nsm-button primary btn-save-appointment-type">Save</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- Appointment Types -->
<div class="modal fade nsm-modal fade" id="edit_appointment_type_modal" tabindex="-1" aria-labelledby="edit_appointment_type_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <?php echo form_open_multipart('', ['id' => 'frm-update-appointment-type', 'class' => 'form-validate', 'autocomplete' => 'off']); ?>
        <input type="hidden" name="appointment_type_id" id="appointment-type-id" value="">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Edit Appointment Type</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">                
                <div class="row-g-3">
                    <div class="col-12">
                        <label class="content-subtitle fw-bold d-block mb-2">Name *</label>
                        <input type="text" name="appointment_type_name" id="appointment-type-name" class="nsm-field form-control" required />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="nsm-button primary btn-update-appointment-type">Save</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="view_upcoming_schedules_modal" tabindex="-1" aria-labelledby="view_upcoming_schedules_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Upcoming Schedules</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="view_upcoming_schedules_container"></div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="loading_modal" tabindex="-1" aria-labelledby="loading_modal_label" aria-hidden="true" style="margin-top:10%;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<!-- Create TC Off -->
<div class="modal fade nsm-modal fade" id="create_tc_off_modal" tabindex="-1" aria-labelledby="update_waitlist_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form id="frm-tc-off-schedule" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Schedule Technician Off</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3 tc-off-group">
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Leave Date</label>
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <input type="text" name="tc_off_start_date" id="tc_off_start_date" class="nsm-field form-control datepicker" placeholder="Start Date" required style="padding: 0.375rem 0.75rem;">                                    
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" name="tc_off_end_date" id="tc_off_end_date" class="nsm-field form-control datepicker" placeholder="End Date" required style="padding: 0.375rem 0.75rem;">                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2 create-tech-attendees">Technicians</label>
                            <select class="nsm-field form-select" name="tc_off_user_ids[]" id="tc-off-users" multiple="multiple"></select>
                        </div>
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2 create-tech-attendees">Assign Task To <small>(optional)</small></label>
                            <select class="nsm-field form-select" name="tc_off_task_to_user_id" id="tc-off-assign-to"></select>
                        </div>
                        <div class="col-12">
                            <div class="col-12">
                                <label class="content-subtitle fw-bold d-block mb-2">Task / Leave Details</label>
                                <textarea name="tc_off_task_details" id="tc-off-task-details" class="nsm-field form-control" required=""></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">                    
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Calendar Action Select -->
<!-- <div class="modal fade nsm-modal fade" id="calendar_action_select_modal" tabindex="-1" aria-labelledby="calendar_action_select_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <input type="hidden" id="action_select_date" value="" />        
        <input type="hidden" id="action_select_time" value="" />        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Select Action</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">                
                <div class="row-g-3">
                    <div class="col-12">
                        <button type="button" id="calendar-add-job" class="nsm-button primary" style="display:block; width: 100%;"><i class='bx bxs-calendar-plus'></i> Create Job</button>
                        <button type="button" id="calendar-add-ticket" class="nsm-button primary" style="display:block; width: 100%;"><i class='bx bxs-calendar-plus'></i> Create Service Ticket</button>
                        <button type="button" id="calendar-add-appointment" class="nsm-button primary" style="display:block; width: 100%;"><i class='bx bxs-calendar-plus'></i> Create Appointment</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->