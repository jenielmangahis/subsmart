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
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">When</label>
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <input type="text" name="appointment_date" id="appointment_date" class="nsm-field form-control datepicker" placeholder="Date" required style="padding: 0.375rem 0.75rem;">
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" name="appointment_time" id="appointment_time" class="nsm-field form-control timepicker" placeholder="Time" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Which Employee</label>
                            <span id="wait-list-add-employee-popover" data-toggle="popover" data-placement="right"data-container="body">
                                <select class="nsm-field form-select" name="appointment_user_id" id="appointment-user"></select>
                            </span>                                                        
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
                            <span id="add-customer-popover" data-toggle="popover" data-placement="right"data-container="body">
                                <select class="nsm-field form-select" name="appointment_customer_id" id="appointment-customer"></select>
                            </span>
                        </div>
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Appointment Type</label>
                            <select name="appointment_type_id" class="nsm-field form-select" required style="display: inline-block;width: 30%;">
                                <?php $start = 0; ?>
                                <?php foreach ($appointmentTypes as $a) { ?>
                                    <option <?= $start == 0 ? 'selected="selected"' : ''; ?> value="<?= $a->id; ?>"><?= $a->name; ?></option>
                                <?php $start++;
                                } ?>
                            </select>
                            <a class="nsm-button" href="<?= base_url('appointment_types/index'); ?>" style="display: inline-block;padding: 2px;margin: 1px;position: relative;top: 3px;padding-right: 10px;">
                                <i class='bx bx-fw bx-plus'></i> Manage Type
                            </a>
                        </div>
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Tags</label>
                            <span id="add-tag-popover" data-toggle="popover" data-placement="right"data-container="body">
                                <select class="nsm-field form-select" name="appointment_tags[]" id="appointment-tags" multiple="multiple"></select>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="display:block;">
                    <div style="float:left;">
                        <button type="button" id="calendar-add-job" class="nsm-button primary" style="display:inline-block;"><i class='bx bxs-calendar-plus'></i> Create Job</button>
                        <button type="button" id="calendar-add-ticket" class="nsm-button primary" style="display:inline-block;"><i class='bx bxs-calendar-plus'></i> Create Service Ticket</button>
                    </div>
                    <div style="float:right;">
                        <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button primary">Schedule</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="create_waitlist_modal" tabindex="-1" aria-labelledby="create_waitlist_modal_label" aria-hidden="true">
    <div class="modal-dialog">
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
                                    <input type="text" name="appointment_date" class="nsm-field form-control datepicker" placeholder="Date" required style="padding: 0.375rem 0.75rem;">
                                    </span>
                                </div>
                                <div class="col-12 col-md-6">
                                    <span id="waitlist-time-popover" data-toggle="popover" data-placement="right"data-container="body">
                                        <input type="text" name="appointment_time" class="nsm-field form-control timepicker" placeholder="Time" required />
                                    </span>
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
    <div class="modal-dialog">
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
                <button type="button" class="nsm-button" id="btn_checkout_appointment">Checkout</button>
                <button type="button" class="nsm-button" style="display: none;" id="btn_payment_details_appointment">Payment Details</button>
                <button type="button" class="nsm-button primary" id="btn_edit_appointment">Edit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="edit_appointment_modal" tabindex="-1" aria-labelledby="edit_appointment_modal_label" aria-hidden="true">
    <div class="modal-dialog">
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