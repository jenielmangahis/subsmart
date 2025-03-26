<style>
.quick-select-calendar-schedule-type{
    /*width: 100% !important;*/
    display: block;
    margin: 5px;
    /*padding-left: 25%;*/
    font-size: 20px;
}
#modal-quick-add-job .modal-lg, #modal-quick-add-service-ticket .modal-lg{
    max-width:1107px !important;
}
.nsm-button-danger, .nsm-button-danger:hover{
    color: #fff;
    background-color: #c82333;
    border-color: #bd2130;
}
.nsm-button-danger .bx{
    color : #ffffff !important;
}
#modal-quick-view-upcoming-schedule .modal-footer{
    display: block;
}
#modal-quick-view-upcoming-schedule .modal-footer .nsm-button{
    width: 48%;
    font-size: 17px;
}
#quick-access-calendar-loading{
    position: absolute;
    top: 589px;
    z-index: 9999;
    left: 40%;
    font-weight: bold;
}
.alert-purple{
    background-color: #6a4a86 !important;
    color: #ffffff;
}
@media only screen and (max-width : 480px) {
    #modal-quick-view-upcoming-schedule .modal-footer .nsm-button{
        width: 100% !important;
    }
}

</style>
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
                <span class="modal-title content-title">View Calendar Schedule</span>
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

<div class="modal fade nsm-modal fade" id="modal-view-upcoming-jobs-tickets" tabindex="-1" aria-labelledby="modal-view-upcoming-jobs-tickets-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">View Calendar Schedule</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" style="max-height:700px; overflow: auto;">
                <div class="view-schedule-container-old row"></div>
            </div>  
            <div class="modal-footer">
                <button type="button" class="nsm-button primary" data-id="" data-type="" id="btn_edit_job_ticket">Edit</button>
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

<!-- New calendar modals -->
<div class="modal fade nsm-modal fade" id="modal-quick-select-schedule-type" tabindex="-1" aria-labelledby="modal-quick-access-calendar-schedule-label" aria-hidden="true">
    <div class="modal-dialog modal-md" style="margin-top: 5%;">        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Select Schedule Type</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="quick-add-date-selected" value="" />   
                <div class="row">
                    <div class="col-12">
                        <a class="nsm-button primary quick-select-calendar-schedule-type" id="calendar-quick-add-job" href="javascript:void(0);"><i class="bx bx-fw bx-message-square-error"></i>Job</a>
                    </div>
                    <div class="col-12">
                        <a class="nsm-button primary quick-select-calendar-schedule-type" id="calendar-quick-add-service-ticket" href="javascript:void(0);"><i class="bx bx-fw bx bx-fw bx-note"></i>Service Ticket</a>
                    </div>
                    <div class="col-12">
                        <a class="nsm-button primary quick-select-calendar-schedule-type" id="calendar-quick-add-event" href="javascript:void(0);"><i class='bx bx-fw bx-calendar-event'></i>Event</a>
                    </div>
                    <div class="col-12">
                        <a class="nsm-button primary quick-select-calendar-schedule-type" id="calendar-quick-add-appointment" href="javascript:void(0);"><i class="bx bx-fw bx-calendar-event"></i>Appointment</a>
                    </div>
                    <div class="col-12">
                        <a class="nsm-button primary quick-select-calendar-schedule-type" id="calendar-quick-add-tc-off" href="javascript:void(0);"><i class='bx bx-fw bx-calendar-week' ></i>Technician Off</a>
                    </div>
                </div> 
            </div>            
        </div>        
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-quick-add-job" aria-labelledby="modal-quick-add-job-label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form method="post" id="quick-add-job-form">   
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Create Job</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="quick-add-job-form-container"></div>
                <div class="modal-footer" style="display:block;">                    
                    <div style="float:right;">
                        <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button primary" id="btn-job-submit">Schedule</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-quick-add-service-ticket" aria-labelledby="modal-quick-add-service-ticket-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="post" id="quick-add-service-ticket-form">   
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Create Service Ticket</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="quick-add-service-ticket-form-container"  style="max-height: 680px; overflow: auto;"></div>
                <div class="modal-footer" style="display:block;">                    
                    <div style="float:right;">
                        <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button primary" id="btn-service-ticket-submit">Schedule</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-quick-add-appointment" aria-labelledby="modal-quick-add-appointment-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="post" id="quick-add-appointment-form">   
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Create Appointment</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="quick-add-appointment-form-container" style="max-height: 800px; overflow:auto;"></div>
                <div class="modal-footer" style="display:block;">                    
                    <div style="float:right;">
                        <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button primary" id="btn-appointment-submit">Schedule</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-quick-add-tc-off" tabindex="-1" aria-labelledby="modal-quick-add-tc-off-label" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form id="quick-add-tc-off-form" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Schedule Technician Off</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="quick-add-tc-off-form-container"></div>
                <div class="modal-footer">                    
                    <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary" id="btn-quick-add-tc-off-submit">Schedule</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-quick-view-upcoming-schedule" data-source="" tabindex="-1" aria-labelledby="modal-quick-view-upcoming-schedule-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">View Calendar Schedule</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" style="max-height:550px; overflow: auto;">
                <div class="view-schedule-container"></div>
            </div> 
            <div class="modal-footer">
                <button type="button" class="nsm-button primary" data-id="" data-type="" id="upcoming-schedule-view-more-details"><i class="bx bx-window-open"></i> View More Details</button>
                <button type="button" class="nsm-button primary" data-id="" data-type="" id="quick-add-gcalendar"><i class="bx bxl-google"></i> Add to Google Calendar</button>
                <button type="button" class="nsm-button primary quick-edit-schedule" data-id="" data-type="" id="edit-upcoming-schedule"><i class='bx bx-edit-alt'></i> Edit</button>

                <!-- Job status -->
                <button type="button" class="nsm-button primary" data-ordernum="" data-id="" data-type="" id="job-status-arrived"><i class='bx bxs-truck'></i> Enroute</button>
                <button type="button" class="nsm-button primary" data-ordernum="" data-id="" data-type="" id="job-status-started"><i class='bx bx-time'></i> Started</button>
                <button type="button" class="nsm-button primary" data-ordernum="" data-id="" data-type="" id="job-status-finished"><i class='bx bxs-flag-checkered'></i> Finished</button>

                <!-- Ticket status -->
                <button type="button" class="nsm-button primary" data-ordernum="" data-id="" data-type="" id="ticket-status-arrived"><i class='bx bxs-truck'></i> Enroute</button>
                <button type="button" class="nsm-button primary" data-ordernum="" data-id="" data-type="" id="ticket-status-started"><i class='bx bx-time'></i> Started</button>
                <button type="button" class="nsm-button primary" data-ordernum="" data-id="" data-type="" id="ticket-status-finished"><i class='bx bxs-flag-checkered'></i> Finished</button>

                <!-- <button type="button" class="nsm-button primary calendar-view-esign" data-id="" data-type="" id="view-esign"><i class='bx bx-pen'></i> View eSign</button> -->
                <button type="button" class="nsm-button primary calendar-send-esign" data-id="" data-type="" id="send-esign"><i class='bx bx-pen'></i> Send eSign</button>
                <button type="button" class="nsm-button primary calendar-send-esign" data-id="" data-type="" id="send-ticket-esign"><i class='bx bx-pen'></i> Send eSign</button>
                <button type="button" class="nsm-button nsm-button-danger quick-delete-schedule" data-ordernum="" data-id="" data-type="" id="delete-upcoming-schedule"><i class='bx bx-trash'></i> Delete</button>
            </div>           
        </div>        
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-quick-job-arrived-status" tabindex="-1" aria-labelledby="modal-quick-job-arrived-status-label" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Job : Arrival</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <form id="frm-calendar-status-arrival" method="post">
                    <input type="hidden" name="job_id" id="calendar-job-arrival-id" value="">
                    <div class="row">
                        <div class="col-sm-12 mt-1 mb-3">
                            <label>This will start travel duration tracking.</label>
                        </div>
                        <div class="col-sm-12">
                            <label class="mb-2">Arrive at:</label>
                            <div class="input-group mb-3">
                                <input type="date" name="omw_date" id="omw_date" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                                <select id="omw_time" name="omw_time" class="form-control" required>
                                    <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                        <option value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="nsm-button primary">Save</button>
                        <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-quick-ticket-arrived-status" tabindex="-1" aria-labelledby="modal-quick-ticket-arrived-status-label" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Service Ticket : Arrival</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <form id="frm-calendar-ticket-status-arrival" method="post">
                    <input type="hidden" name="ticket_id" id="calendar-ticket-arrival-id" value="">
                    <div class="row">
                        <div class="col-sm-12 mt-1 mb-3">
                            <label>This will start travel duration tracking.</label>
                        </div>
                        <div class="col-sm-12">
                            <label class="mb-2">Arrive at:</label>
                            <div class="input-group mb-3">
                                <input type="date" name="omw_date" id="ticket_omw_date" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                                <select id="ticket_omw_time" name="omw_time" class="form-control" required>
                                    <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                        <option value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="nsm-button primary">Save</button>
                        <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-quick-job-started-status" tabindex="-1" aria-labelledby="modal-quick-job-started-status-label" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Job : Started</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <form id="frm-calendar-status-started" method="post">
                    <input type="hidden" name="job_id" id="calendar-job-started-id" value="">
                    <div class="row">
                        <div class="col-sm-12 mt-1 mb-3">
                            <label>This will stop travel duration tracking and start on job duration tracking.</label>
                        </div>
                        <div class="col-sm-12">
                            <label class="mb-2">Start at:</label>
                            <div class="input-group mb-3">
                                <input type="date" name="job_start_date" id="job_start_date" class="form-control" value="<?= date('Y-m-d');?>" required>
                                <select id="job_start_time" name="job_start_time" class="form-control" required>
                                    <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                    <option value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="nsm-button primary">Save</button>
                        <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-quick-ticket-started-status" tabindex="-1" aria-labelledby="modal-quick-ticket-started-status-label" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Service Ticket : Started</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <form id="frm-calendar-ticket-status-started" method="post">
                    <input type="hidden" name="ticket_id" id="calendar-ticket-started-id" value="">
                    <div class="row">
                        <div class="col-sm-12 mt-1 mb-3">
                            <label>This will stop travel duration tracking and start on job duration tracking.</label>
                        </div>
                        <div class="col-sm-12">
                            <label class="mb-2">Start at:</label>
                            <div class="input-group mb-3">
                                <input type="date" name="ticket_start_date" id="ticket_start_date" class="form-control" value="<?= date('Y-m-d');?>" required>
                                <select id="ticket_start_time" name="ticket_start_time" class="form-control" required>
                                    <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                    <option value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="nsm-button primary">Save</button>
                        <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-quick-job-finished-status" tabindex="-1" aria-labelledby="modal-quick-job-finished-status-label" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Job : Finish</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <form id="frm-calendar-status-finished" method="post">
                    <input type="hidden" name="job_id" id="calendar-job-finished-id" value="">                
                    <div class="row">
                        <div class="col-sm-12 mt-1 mb-3">
                            <label>This will stop on job duration tracking and mark the job end time.</label>
                        </div>
                        <div class="col-sm-12 mt-2">
                            <label class="mb-2">Finish job at:</label>
                            <div class="input-group">
                                <input type="date" name="job_finished_date" id="job_finished_date" class="form-control" value="<?php echo date('Y-m-d');?>" required>
                                <select id="job_finished_time" name="job_finished_time" class="form-control" required>
                                    <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                        <option value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="nsm-button primary">Save</button>
                        <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-quick-ticket-finished-status" tabindex="-1" aria-labelledby="modal-quick-ticket-finished-status-label" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Service Ticket : Finish</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <form id="frm-calendar-ticket-status-finished" method="post">
                    <input type="hidden" name="ticket_id" id="calendar-ticket-finished-id" value="">                
                    <div class="row">
                        <div class="col-sm-12 mt-1 mb-3">
                            <label>This will stop on job duration tracking and mark the job end time.</label>
                        </div>
                        <div class="col-sm-12 mt-2">
                            <label class="mb-2">Finish job at:</label>
                            <div class="input-group">
                                <input type="date" name="ticket_finished_date" id="job_finished_date" class="form-control" value="<?php echo date('Y-m-d');?>" required>
                                <select id="ticket_finished_time" name="ticket_finished_time" class="form-control" required>
                                    <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                        <option value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="nsm-button primary">Save</button>
                        <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="approveThisJobModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Send Esign</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="update_status_to_omw" method="post">
                    <div class="row">
                        <div class="col-sm-12 mt-1 mb-1">
                            <label>Electronic signatures, or e-signatures, are transforming the ways companies do business. Not only do they eliminate the hassle of manually routing paper agreements, but they also dramatically speed up the signature and approval process.</label>
                        </div>
                        <div class="col-sm-12 mb-4">
                            <div class="nsm-loader" style="height: 100px; min-height: unset;">
                            <i class="bx bx-loader-alt bx-spin"></i>
                            </div>

                            <div class="nsm-empty d-none" style="height: auto; padding: 1rem 0;">
                                <i class="bx bx-meh-blank"></i>
                                <span>No eSign template found.</span>
                            </div>

                            <div class="esign-templates d-none mt-1">
                                <label class="mb-1">Select your template below:</label>
                                <div class="dropdown">
                                    <button class="nsm-button dropdown-toggle m-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Dropdown button
                                    </button>
                                    <ul class="dropdown-menu"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">                        
                        <button disabled type="button" class="nsm-button primary approve-and-esign d-flex align-items-center" data-action="approve-and-esign">
                        <i class="bx bx-loader-alt bx-spin" style="margin-right: 5px;"></i>
                        <span>Send eSign</span>
                        </button>
                        <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="nsm-button" data-action="approve" id="approveThisJob" style="display: none;">Approve</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="approveThisTicketModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Send Esign</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="ticket_update_status_to_omw" method="post">
                    <div class="row">
                        <div class="col-sm-12 mt-1 mb-1">
                            <label>Electronic signatures, or e-signatures, are transforming the ways companies do business. Not only do they eliminate the hassle of manually routing paper agreements, but they also dramatically speed up the signature and approval process.</label>
                        </div>
                        <div class="col-sm-12 mb-4">
                            <div class="nsm-loader" style="height: 100px; min-height: unset;">
                            <i class="bx bx-loader-alt bx-spin"></i>
                            </div>

                            <div class="nsm-empty d-none" style="height: auto; padding: 1rem 0;">
                                <i class="bx bx-meh-blank"></i>
                                <span>No eSign template found.</span>
                            </div>

                            <div class="esign-templates d-none mt-1">
                                <label class="mb-1">Select your template below:</label>
                                <div class="dropdown">
                                    <button class="nsm-button dropdown-toggle m-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Dropdown button
                                    </button>
                                    <ul class="dropdown-menu"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">                        
                        <button disabled type="button" class="nsm-button primary ticket-approve-and-esign d-flex align-items-center" data-action="approve-and-esign">
                        <i class="bx bx-loader-alt bx-spin" style="margin-right: 5px;"></i>
                        <span>Send eSign</span>
                        </button>
                        <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="nsm-button" data-action="approve" id="approveThisTicket" style="display: none;">Approve</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-quick-edit-tc-off" tabindex="-1" aria-labelledby="modal-quick-edit-tc-off-label" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form id="quick-edit-tc-off-form" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Edit Schedule Technician Off</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="quick-edit-tc-off-form-container"></div>
                <div class="modal-footer">                    
                    <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary" id="btn-quick-add-tc-off-submit">Update Schedule</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-quick-add-event" aria-labelledby="modal-quick-add-event-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="post" id="quick-add-event-form">   
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Create Event</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="quick-add-event-form-container" style="max-height: 800px; overflow: auto;"></div>
                <div class="modal-footer" style="display:block;">                    
                    <div style="float:right;">
                        <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button primary" id="btn-event-submit">Schedule</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-quick-add-panel-type" tabindex="-1" aria-labelledby="modal-quick-add-panel-type-label" aria-hidden="true">
    <div class="modal-dialog modal-md" style="margin-top:13%;">
        <form id="quick-add-panel-type-form" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Create Panel Type</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="panel-type-name" class="content-subtitle fw-bold d-block mb-2">Name </label>
                            <input type="text" name="panel_type_name" id="panel-type-name" class="nsm-field form-control" placeholder="" required>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">                    
                    <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary" id="btn-quick-add-panel-type-submit">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade nsm-modal fade" id="modal-quick-add-plan-type" tabindex="-1" aria-labelledby="modal-quick-add-plan-type-label" aria-hidden="true">
    <div class="modal-dialog modal-md" style="margin-top:13%;">
        <form id="quick-add-plan-type-form" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Create Plan Type</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="plan-type-name" class="content-subtitle fw-bold d-block mb-2">Name </label>
                            <input type="text" name="plan_type_name" id="plan-type-name" class="nsm-field form-control" placeholder="" required>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">                    
                    <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary" id="btn-quick-add-plan-type-submit">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-quick-add-job-type" tabindex="-1" aria-labelledby="modal-quick-add-job-type-label" aria-hidden="true">
    <div class="modal-dialog modal-md" style="margin-top:13%;">
        <form id="quick-add-job-type-form" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Create Job Type</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="job-type-name" class="content-subtitle fw-bold d-block mb-2">Name </label>
                            <input type="text" name="job_type_name" id="job-type-name" class="nsm-field form-control" placeholder="" required>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">                    
                    <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary" id="btn-quick-add-job-type-submit">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-quick-add-job-tag" tabindex="-1" aria-labelledby="modal-quick-add-job-tag-label" aria-hidden="true">
    <div class="modal-dialog modal-md" style="margin-top:13%;">
        <form id="quick-add-job-tag-form" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Create Job Tag</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="job-tag-name" class="content-subtitle fw-bold d-block mb-2">Name </label>
                            <input type="text" name="job_tag_name" id="job-tag-name" class="nsm-field form-control" placeholder="" required>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">                    
                    <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary" id="btn-quick-add-job-tag-submit">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
