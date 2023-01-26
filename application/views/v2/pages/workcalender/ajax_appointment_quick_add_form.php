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