<style>
.custom-ticket-header{
    background-color: #6a4a86;
    color: #ffffff;
    font-size: 15px !important;
    padding: 10px;
    display:block;
}
#quick-add-service-ticket-form-container .nsm-table thead td{
    background-color:#6a4a86;
    color:#ffffff;
}
#quick-add-service-ticket-form-container .modal-body{
    overflow-x:hidden;
}
#quick-add-service-ticket-form-container #modal_items_list td:nth-child(8){
 text-align:right !important;
}
.link-modal-open{
    text-decoration:none !important;
}
.cc-expiry-month, .cc-expiry-year{
    display:inline-block;
    width:44% !important;
    flex:none !important;
}
.cc-separator{
    display: inline-block;
    padding: 6px;
    font-size: 16px;
}
.grp-billing-check,.grp-billing-ach{
    display:none;
}
</style>
<input type="hidden" id="siteurl" value="<?=base_url();?>">
<input type="hidden" id="redirect-calendar" name="redirect_calendar" value="<?= $redirect_calendar; ?>">
<div class="row" style="margin-top:0px;">    
    <div class="col-md-6">
        <div class="nsm-card primary">
            <div class="nsm-card-content">
                    <label for="sel-customer_t" class="required"><b>Customer</b></label>
                    <a class="link-modal-open nsm-button btn-small" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modalNewCustomer" style="float:right;"><span class="fa fa-plus fa-margin-right"></span>New Customer</a>
                    <select id="sel-customer_t" name="customer_id" data-customer-source="dropdown" required="" class="form-control searchable-dropdown" placeholder="Select">
                        <option value="0">- Select Customer -</option>
                        <?php foreach($customers as $c){ ?>
                            <option value="<?= $c->prof_id; ?>"><?= $c->first_name . ' ' . $c->last_name; ?></option>
                        <?php } ?>
                    </select>
                    <label for="business_name" class="mt-2"><b>Business Name</b> (optional)</label>
                    <input type="text" class="form-control" name="business_name" id="business_name" placeholder="Business Name" />
                    
                    <label for="ticket_customer_phone" class="required mt-2"><b>Customer Phone Number</b></label>
                    <input type="text" class="form-control phone_number" name="customer_phone" id="ticket_customer_phone" required maxlength="12" placeholder="xxx-xxx-xxxx" />

                    <label for="job_tag" class="mt-2"><b>Service Tag</b></label>
                    <select class="form-control" name="job_tag" id="job_tag">
                        <?php foreach($tags as $t){ ?>
                            <option value="<?= $t->name; ?>"><?= $t->name; ?></option>
                        <?php } ?>
                    </select>

                    <label for="service_description" class="mt-2"><b>Service description</b> (optional)</label>
                    <textarea class="form-control" name="service_description" id="service_description" style="height:100px;"></textarea>
                    
            </div>
        </div>        
    </div>

    <div class="col-md-6">
        <div class="nsm-card primary">
            <div class="nsm-card-content">                
                <label for="customer_city" class="required"><b>City</b></label>
                <input type="text" class="form-control" name="customer_city" id="customer_city"
                        required placeholder="Enter City" 
                        onChange="jQuery('#customer_name').text(jQuery(this).val());"/>
                <label for="service_location" class="required mt-2"><b>Service Location</b></label>
                <textarea class="form-control" name="service_location" id="service_location" style="height:100px;" required></textarea>
                
                <label for="customer_state" class="required mt-2"><b>State</b></label>
                <input type="text" class="form-control" name="customer_state" id="customer_state"
                        required placeholder="Enter State" 
                        onChange="jQuery('#customer_name').text(jQuery(this).val());"/>

                <label for="customer_zip" class="required mt-2"><b>Zip Code</b></label>
                <input type="text" class="form-control" name="customer_zip" id="customer_zip"
                        required placeholder="Enter Zip Code" 
                        onChange="jQuery('#customer_name').text(jQuery(this).val());"/>                
            </div>
        </div>        
    </div>
</div>  

<div class="row mt-2">
    <div class="col-12">
        <div class="nsm-card primary">
            <div class="nsm-card-content">
                <div class="row">
                    <div class="col-md-3">
                        <label for="ticket_no" class="required"><b>Service Ticket No.</b></label>
                        <input type="text" class="form-control" name="ticket_no" id="ticket_no"
                                required placeholder="Enter Ticket#" a value="<?= $prefix . $next_num; ?>" readonly="" />
                    </div>
                    <div class="col-md-3">
                        <label for="ticket_date" class="required"><b>Schedule Date</b></label>
                        <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" value="<?= date("m/d/Y", strtotime($default_start_date)); ?>" name="ticket_date" id="ticket_date"
                                    placeholder="Enter Ticket Date" required>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="scheduled_time" class="required"><b>Schedule Time From</b></label>
                        <select id="scheduled_time" name="scheduled_time" class="nsm-field form-select" required>
                            <option value="">From</option>
                            <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                <option <?= $default_start_time == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="scheduled_time_to" class="required"><b>Schedule Time To</b></label>
                        <select id="scheduled_time_to" name="scheduled_time_to" class="nsm-field form-select " required>
                            <option value="">To</option>
                            <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                <option value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-3">
                        <label for="purchase_order_number"><b>Purchase Order#</b></label>
                        <input type="text" class="form-control" name="purchase_order_no"
                            id="purchase_order_no" placeholder="Enter Purchase Order#"
                            autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());"/>
                    </div>
                    <div class="col-md-3">
                        <label for="ticket_status"><b>Ticket Status</b></label>
                        <select id="ticket_status" name="ticket_status" class="form-control">
                            <!-- <option value="New">New</option> -->
                            <!-- <option value="Draft">Draft</option> -->
                            <option value="Scheduled" selected="">Scheduled</option>
                            <option value="Arrived">Arrived</option>
                            <option value="Started">Started</option>
                            <option value="Approved">Approved</option>
                            <option value="Finished">Finished</option>
                            <option value="Invoiced">Invoiced</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="panel_type"><b>Panel Type</b></label>
                            <select name="panel_type" id="panel_type" class="form-control" data-value="<?= isset($alarm_info) ? $alarm_info->panel_type : "" ?>">
                                <option value="None">- None -</option>
                                <option value="AERIONICS">AERIONICS</option>
                                <option value="AlarmNet">AlarmNet</option>
                                <option value="Alarm.com">Alarm.com</option>
                                <option value="Alula">Alula</option>
                                <option value="Bosch">Bosch</option>
                                <option value="DSC">DSC</option>
                                <option value="ELK">ELK</option>
                                <option value="FBI">FBI</option>
                                <option value="GRI">GRI</option>
                                <option value="GE">GE</option>
                                <option value="Honeywell">Honeywell</option>
                                <option value="Honeywell Touch">Honeywell Touch</option>
                                <option value="Honeywell 3000">Honeywell 3000</option>
                                <option value="Honeywell Vista">Honeywell Vista</option>
                                <option value="Honeywell Vista with Sem">Honeywell Vista with Sem</option>
                                <option value="Honeywell Lyric">Honeywell Lyric</option>
                                <option value="IEI">IEI</option>
                                <option value="MIER">MIER</option>
                                <option value="2 GIG">2 GIG</option>
                                <option value="2 GIG Go Panel 2">2 GIG Go Panel 2</option>
                                <option value="2 GIG Go Panel 3">2 GIG Go Panel 3</option>
                                <option value="Qolsyx">Qolsys</option>
                                <option value="Qolsys IQ Panel 2">Qolsys IQ Panel 2</option>
                                <option value="Qolsys IQ Panel 2 Plus">Qolsys IQ Panel 2 Plus</option>
                                <option value="Qolsys IQ Panel 3">Qolsys IQ Panel 3</option>
                                <option value="Custom">Custom</option>
                                <option value="Other">Other</option>
                            </select>
                    </div>
                    <div class="col-md-3" id="technicianDiv">
                        <label for="service_type"><b>Service Type</b></label>
                        <div class="input-group">
                            <select id="service_type" name="service_type" class="form-control">
                                <option value="Services">Services</option>
                                <option value="Event">Event</option>
                                <option value="Estimate">Estimate</option>
                                <option value="Job">Job</option>
                            </select>
                        </div>
                    </div>                    
                </div>
                <div class="row mt-4" style="background-color:white;">
                    <div class="col-md-3 form-group">
                        <label for="plan_type"><b>Plan Type</b></label>
                        <select class="form-control" name="plan_type" id="plan_type" required="">
                            <option value="">Select</option>
                            <?php foreach($planTypeOptions as $key => $planType){ ?>
                                <option value="<?= $key; ?>"><?= $planType; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="warranty_type"><b>Warranty Type</b></label>
                        <select id="warranty_type" name="warranty_type" data-customer-source="dropdown" class="form-control" required="">
                            <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == ""){ echo 'selected'; } } ?> value="">Select</option>
                            <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "Limited. 90 Days"){ echo 'selected'; } } ?> value="Limited. 90 Days">Limited 90 Days</option>
                            <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "1 Year"){ echo 'selected'; } } ?>  value="1 Year">1 Year</option>
                            <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "$25 Trip"){ echo 'selected'; } } ?>  value="$25 Trip">$25 Trip</option>
                            <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "$50 Trip and $65 Deductible"){ echo 'selected'; } } ?>  value="$50 Trip and $65 Deductible">$50 Trip and $65 Deductible</option>
                            <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "Extended"){ echo 'selected'; } } ?>  value="Extended">Extended</option>
                            <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "None"){ echo 'selected'; } } ?>  value="None">None</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="employee_id"><b>Created By</b></label>                        
                        <select class="form-control mb-3" name="employee_id" id="employee_id">
                            <option value="<?= logged('id'); ?>" selected=""><?= logged('FName') . ' ' . logged('LName'); ?></option>
                        </select>
                    </div>                    
                </div>
                <div class="row mt-4" style="background-color:white;">
                    <div class="col-md-6 form-group">
                        <label for="ticket-appointment-user"><b>Assigned Technician</b></label>
                        <select class="form-control nsm-field form-select" name="assign_tech[]" id="ticket-appointment-user" multiple="multiple">
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="job_description"><b>Job Description</b></label>                        
                        <textarea name="job_description" id="job_description" class="form-control" required="" style="height:100px;"></textarea>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="is_with_esign" id="is-with-esign" value="1">
                            <label class="form-check-label" for="is-with-esign">eSign Required</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>       

    <div class="row mt-2" id="with-esign-inputs-container" style="display:none;">
        <div class="col-12">
            <div class="nsm-card primary">
                <div class="nsm-card-header">
                    <div class="nsm-card-title">
                        <span class="custom-ticket-header"><i class='bx bxs-pen'></i> eSign Information</span>
                    </div>
                </div>
                <div class="row mt-4" style="background-color:white;">
                    <div class="col-md-6 form-group">
                        <div class="row">
                            <div class="col-md-6 form-group mt-2">
                                <label for="service-ticket-monthly-monitoring-rate"><b>Change Monthly Monitoring Rate</b></label>
                                <select style="display:inline-block;" class="form-control nsm-field form-select" name="monthly_monitoring_rate" id="service-ticket-monthly-monitoring-rate">
                                    <option value="0.00">Select Plan Rate</option>
                                    <?php foreach( $ratePlans as $rp ){ ?>
                                        <option value="<?= $rp->amount; ?>"><?= $rp->plan_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group mt-2">
                                <label for=""><b>Monthly Monitoring Rate</b></label>
                                <input style="display:inline-block;" type="number" id="plan-value" name="monthly_monitoring_rate_value" value="0.00" class="form-control" />
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="col-md-6 form-group mt-2" id="service-ticket-esign-template">                            
                        <label for="esign-template-list"><b>eSign Templates</b></label>
                        <select class="form-control nsm-field form-select" name="esign_template" id="esign-templates">
                            <?php foreach($esignTemplates as $e){ ?>
                                <?php 
                                    $template_name = $e->name;
                                    if( $e->is_default == 1 ){
                                        $template_name = $e->name .'(default)';
                                    }    
                                ?>
                                <option <?= $e->is_default == 1 ? 'selected="selected"' : ''; ?> value="<?= $e->id; ?>"><?= $template_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6 form-group mt-2">
                        <div class="row">
                            <div class="col-md-6 form-group mt-2">
                                <label for="service-ticket-installation-cost"><b>Installation Cost</b></label>
                                <input type="number" step="any" class="form-control" value="0.00" name="installation_cost" id="service-ticket-installation-cost">
                            </div>
                            <div class="col-md-6 form-group mt-2">
                                <label for="service-ticket-otp"><b>One Time (Program and Setup)</b></label>
                                <input type="number" step="any" class="form-control" value="0.00" name="otp" id="service-ticket-otp">
                            </div>
                        </div>
                    </div>                        
                </div>
                <div class="row" style="background-color:white;">                        
                    <div class="col-md-6 form-group mt-2">
                        <label for="bill_method"><b>Billing Method</b></label>
                        <div class="input-group">
                            <select id="bill_method" name="bill_method" class="form-select">
                                <option value="CC">Credit Card</option>
                                <option value="CHECK">Check</option>
                                <option value="ACH">ACH</option>/option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 form-group mt-2">
                        <label for="customer_monitoring_id"><b>Monitoring ID</b></label>
                        <input type="text" class="form-control" name="customer_monitoring_id" id="customer_monitoring_id"/>
                    </div>
                    
                    <div class="grp-billing-cc">                      
                        <div class="col-md-12 form-group mt-2 group-cc">
                            <div class="row">                                
                                <div class="col-md-6 form-group mt-2">
                                    <label for="customer_cc_num"><b>Credit Card Number</b></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="customer_cc_num" id="customer_cc_num"/>
                                    </div>
                                </div>
                                <div class="col-md-2 form-group mt-2">
                                    <label for="customer_cc_expiry_date_month"><b>Expiry Date</b></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control cc-expiry-month" style="width:60px !important;" maxlength="2" size="2" name="customer_cc_expiry_date_month" id="customer_cc_expiry_date_month" placeholder="MM"/>
                                        <span class="cc-separator">/</span>
                                        <input type="text" class="form-control cc-expiry-year" style="width:65px !important;" maxlength="4" size="4" name="customer_cc_expiry_date_year" id="customer_cc_expiry_date_year" placeholder="YYYY"/>
                                    </div>
                                </div>
                                <div class="col-md-2 form-group mt-2">
                                    <label for="customer_cc_cvc"><b>CVC</b></label>
                                    <div class="input-group" style="width:35%;">
                                        <input type="text" class="form-control cc-cvc" maxlength="3" size="3" name="customer_cc_cvc" id="customer_cc_cvc"/>
                                    </div>
                                </div>
                            </div>                                
                        </div>
                    </div>
                    <div class="grp-billing-check">                      
                        <div class="col-md-12 form-group mt-2 group-cc">
                            <div class="row">                                
                                <div class="col-md-6 form-group mt-2">
                                    <label for="customer_check_number"><b>Check Number</b></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="customer_check_number" id="customer_check_number"/>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group mt-2">
                                    <label for="customer_check_routing_number"><b>Routing Number</b></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="customer_check_routing_number" id="customer_check_routing_number"/>
                                    </div>
                                </div>                                    
                            </div>    
                            <div class="row">
                                <div class="col-md-6 form-group mt-2">
                                    <label for="customer_check_bank_name"><b>Bank Name</b></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="customer_check_bank_name" id="customer_check_bank_name"/>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group mt-2">
                                    <label for="customer_check_account_number"><b>Account Number</b></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="customer_check_account_number" id="customer_check_account_number"/>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="grp-billing-ach">                      
                        <div class="col-md-12 form-group mt-2 group-cc">
                            <div class="row">                                
                                <div class="col-md-6 form-group mt-2">
                                    <label for="customer_ach_account_number"><b>Account Number</b></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="customer_ach_account_number" id="customer_ach_account_number"/>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group mt-2">
                                    <label for="customer_ach_routing_number"><b>Routing Number</b></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="customer_ach_routing_number" id="customer_ach_routing_number"/>
                                    </div>
                                </div>
                            </div>                                
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    <div class="row mt-2" id="with-esign-emergency-contacts-container" style="display:none;">
        <div class="col-12">
            <div class="nsm-card primary">
                <div class="nsm-card-header">
                    <div class="nsm-card-title">
                        <span class="custom-ticket-header"><i class="bx bx-fw bx-user"></i> Emergency Contacts</span>
                    </div>
                </div>
                <div class="nsm-card-content">
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4 ">Contact Name 1</div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-6" style="padding-right:2px !important;">
                                                <input type="text" class="form-control" placeholder="First Name" name="contact_first_name1" id="contact_first_name1" value="" style="margin-bottom: 5px;"/>
                                            </div>
                                            <div class="col-6" style="padding-left:2px !important;">
                                                <input type="text" class="form-control" placeholder="Last Name" name="contact_last_name1" id="contact_last_name1" value="" style="margin-bottom: 5px;" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-4 ">Relationship</div>
                                    <div class="col-md-8">
                                        <select data-type="emergency_contact_relationship" class="form-control" name="contact_relationship1" id="contact_relationship1">
                                            <?php foreach($contactRelationshipOptions as $value){ ?>
                                                <option value="<?= $value; ?>"><?= $value; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-4">Phone Number</div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="contact_phone1" id="contact_phone1" value=""/>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-4">Contact Name 2</div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-6" style="padding-right:2px !important;">
                                                <input type="text" class="form-control" placeholder="First Name" name="contact_first_name2" id="contact_first_name2" value="" style="margin-bottom: 5px;"/>
                                            </div>
                                            <div class="col-6" style="padding-left:2px !important;">
                                                <input type="text" class="form-control" placeholder="Last Name" name="contact_last_name2" id="contact_last_name2" value="" style="margin-bottom: 5px;" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-4 ">Relationship</div>
                                    <div class="col-md-8">
                                        <select data-type="emergency_contact_relationship" class="form-control" name="contact_relationship2" id="contact_relationship2">
                                            <?php foreach($contactRelationshipOptions as $value){ ?>
                                                <option value="<?= $value; ?>"><?= $value; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-4">Phone Number</div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="contact_phone2" id="contact_phone2" value=""/>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-6">
                                
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    Contact Name 3
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-6" style="padding-right:2px !important;">
                                            <input type="text" class="form-control" placeholder="First Name" name="contact_first_name3" id="contact_first_name3" value="" style="margin-bottom: 5px;"/>
                                        </div>
                                        <div class="col-6" style="padding-left:2px !important;">
                                            <input type="text" class="form-control" placeholder="Last Name" name="contact_last_name3" id="contact_last_name3" value="" style="margin-bottom: 5px;" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4 ">
                                    Relationship
                                </div>
                                <div class="col-md-8">
                                    <select data-type="emergency_contact_relationship" class="form-control" name="contact_relationship3" id="contact_relationship3">
                                        <?php foreach($contactRelationshipOptions as $value){ ?>
                                            <option value="<?= $value; ?>"><?= $value; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    Phone Number
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="contact_phone3" id="contact_phone3" value=""/>
                                </div>
                            </div>

                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-12">
            <div class="nsm-card primary">
                <div class="nsm-card-header">
                    <div class="nsm-card-title">
                        <span class="custom-ticket-header"><i class='bx bx-list-ul'></i> Item List</span>
                    </div>
                </div>
                <div class="nsm-card-content">
                    <hr />
                    <div class="row" id="plansItemDiv" style="background-color:white;">
                        <div class="col-md-12 table-responsive">                        
                        <input type="hidden" name="count" value="0" id="service-ticket-item-count">
                            <table class="table" id="service-ticket-add-item-list">                            
                                <thead>
                                <tr>
                                    <th style="width:25%;">Name</th>
                                    <th style="width:20%;">Group</th>
                                    <th style="width:10%;">Quantity</th>
                                    <th style="width:10%;">Price</th>
                                    <th style="width:10%;">Discount</th>
                                    <th style="width:10%;">Tax</th>
                                    <th style="width:10%;text-align:right;">Total</th>
                                    <th class=""></th>
                                </tr>
                                </thead>
                                <tbody id="service-ticket-items"></tbody>
                            </table>
                            <button class="link-modal-open nsm-button primary small link-modal-open" type="button" id="add-another-items" data-bs-toggle="modal" data-bs-target="#item_list">
                                <i class='bx bx-plus'></i>Add Items
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row mt-5">
                                <div class="col-md-6 form-group">
                                    <label for="ticket-appointment-user"><b>Adjustment Name</b></label>
                                    <input type="text" id="adjustment-name" name="adjustment_name" value="" class="form-control" />
                                    
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="adjustment-amount"><b>Adjustment Amount</b></label>                        
                                    <input type="number" id="adjustment-amount" name="adjustment_amount" value="0.00" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <table class="table" style="text-align:left;">
                                <tr>
                                    <td>Subtotal</td>
                                    <td colspan="2" align="right">$ <span id="span_sub_total_invoice">0.00</span> <input type="hidden" name="subtotal" id="item_total"></td>
                                </tr>
                                <tr>
                                    <td>Taxes</td>
                                    <td colspan="2" align="right">$ <span id="total_tax_">0.00</span><input type="hidden" name="taxes" id="total_tax_input"></td>
                                </tr>
                                <tr>
                                    <td>Adjustment</td>
                                    <td colspan="2" align="right">$ <span id="adjustment_amount">0.00</span></td>
                                </tr>
                                <tr style="display:none;">
                                    <td>Monthly Monitoring Rate</td>
                                    <td colspan="2" align="right">$ <span id="span_mmr">0.00</span></td>
                                </tr>
                                <tr style="display:none;">
                                    <td>Installation Cost</td>
                                    <td colspan="2" align="right">$ <span id="span_installation_cost">0.00</span></td>
                                </tr>
                                <tr style="display:none;">
                                    <td>One Time (Program and Setup)</td>
                                    <td colspan="2" align="right">$ <span id="span_otp">0.00</span></td>
                                </tr>
                                <tr>
                                    <td><b>Grand Total</b></td>
                                    <td></td>
                                    <td align="right"><b>$ <span id="grand_total">0.00</span></b><input type="hidden" name="grandtotal" id="grand_total_input" value='0'></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end 2nd row -->
<div class="row mt-2">
    <div class="col-12">
        <div class="nsm-card primary">
            <div class="nsm-card-content">                                
                <div class="row mt-4">
                    <div class="col-md-4">
                        <b>Sales Rep's Name</b>
                        <input type="text" name="sales_rep_view" class="form-control" value="<?php echo logged('FName').' '.logged('LName'); ?>">
                        <input type="hidden" name="sales_rep" class="form-control" value="<?php echo logged('id'); ?>">
                    </div>
                    <div class="col-md-4">
                        <b>Mobile Phone</b>
                        <input type="text" name="sales_rep_no" class="form-control phone_number" value="<?php echo logged('mobile'); ?>" maxlength="12" placeholder="xxx-xxx-xxxx">
                    </div>                       
                    <div class="col-md-4">
                        <b>Team Leader / Mentor</b>
                        <input type="text" name="tl_mentor" class="form-control" placeholder="Enter Team Leader/Mentor">
                    </div>                                        
                </div>
                <div class="row mt-4">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label><h6>Message to Customer</h6></label><br> <span class="help help-sm help-block">Add a message that will be displayed on the Ticket.</span>
                            <textarea name="message" cols="40" rows="4" class="form-control">I would be happy to have an opportunity to work with you.</textarea>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label><h6>Terms &amp; Conditions</h6></label><br> <span class="help help-sm help-block">Mention your company's T&amp;C that will appear on the Ticket.</span>
                            <textarea name="terms_conditions" cols="40" rows="4" class="form-control">YOU EXPRESSLY AUTHORIZE ADI AND ITS AFFILIATES TO RECEIVE PAYMENT FOR THE LISTED SERVICES ABOVE. BY SIGNING BELOW BUYER AGREES TO THE TERMS OF YOUR SERVICE AGREEMENT AND ACKNOWLEDGES RECEIPT OF A COPY OF THIS SERVICE AGREEMENT.</textarea>
                        </div>
                    </div>
                </div>
                <div class="row mt-2" style="background-color:white;">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><h6>Instructions / Notes: </h6></label><br> <span class="help help-sm help-block">Optional internal notes, will not appear to customer</span>
                            <textarea name="instructions" cols="40" rows="2"
                                    class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal New Customer -->
<div class="modal fade nsm-modal" id="modalNewCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Customer</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bx bx-fw bx-x m-0"></i>

                </button>
            </div>
            <div class="modal-body pt-0 pl-3 pb-3"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary saveCustomer">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="quick-add-service-ticket-item-list" tabindex="-1"  aria-labelledby="quickAddServiceTicketLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" style="margin-top:5%;margin-left:31%;">
        <div class="modal-content" style="width:700px !important;">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Items List</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-12 grid-mb">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" for="modal_items_list" placeholder="Search List">
                            </div>
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="col-sm-12">
                            <table id="modal_items_list" class="nsm-table" style="width: 100%;">
                                <thead>
                                <tr>
                                    <td data-name="Add" style="width: 5% !important;"></td>
                                    <td data-name="Name"><strong>Name</strong></td>
                                    <td data-name="Type"><strong>Type</strong></td>
                                    <td data-name="Qty"><strong>Stock</strong></td>
                                    <td data-name="Price" style="text-align:right;"><strong>Price</strong></td>                                    
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($items as $item){ ?>
                                    <?php $item_qty = get_total_item_qty($item->id); ?>
                                    <?php //if ($item_qty[0]->total_qty > 0) { ?>
                                        <tr id="<?php echo "ITEMLIST_PRODUCT_$item->id"; ?>">
                                            <td class="nsm-text-primary">
                                                <button type="button"  data-dismiss="modal" class='nsm nsm-button default quick-add-service-ticket-item' id="<?= $item->id; ?>" data-item_type="<?= ucfirst($item->type); ?>" data-quantity="<?= $item_qty[0]->total_qty; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>" data-location_name="<?= $item->location_name; ?>" data-location_id="<?= $item->location_id; ?>"><i class='bx bx-plus-medical'></i></button>
                                            </td>
                                            <td class="nsm-text-primary"><?php echo $item->title; ?></td>
                                            <td class="nsm-text-primary"><?php echo $item->type; ?></td>
                                            <td><?php echo $item_qty[0]->total_qty > 0 ? $item_qty[0]->total_qty : "0"; ?></td>
                                            <td style="text-align:right;"><?php echo $item->price; ?></td>                                            
                                        </tr>
                                    <?php //} ?>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    // $('#esign-templates').select2({
    //     dropdownParent: $("#service-ticket-esign-template"),
    //     placeholder: 'Select template',
    // });

    $('#employee_id').select2({
        ajax: {
            url: base_url + 'autocomplete/_company_users',
            dataType: 'json',
            delay: 250,                
            data: function(params) {
                return {
                    q: params.term,
                    page: params.page
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;

                return {
                    results: data,
                };
            },
            /*formatResult: function(item) {
                return '<div>' + item.FName + ' ' + item.LName + '<br />test<small>' + item.email + '</small></div>';
            },*/
            cache: true
        },
        dropdownParent: $("#modal-quick-add-service-ticket"),
        placeholder: 'Select User',
        minimumInputLength: 0,
        templateResult: formatRepoUser,
        templateSelection: formatRepoSelectionUser
    });

    $('#ticket-appointment-user').select2({
        ajax: {
            url: base_url + 'autocomplete/_company_users',
            dataType: 'json',
            delay: 250,                
            data: function(params) {
                return {
                    q: params.term,
                    page: params.page
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;

                return {
                    results: data,
                };
            },
            /*formatResult: function(item) {
                return '<div>' + item.FName + ' ' + item.LName + '<br />test<small>' + item.email + '</small></div>';
            },*/
            cache: true
        },
        dropdownParent: $("#modal-quick-add-service-ticket"),
        placeholder: 'Select User',
        minimumInputLength: 0,
        templateResult: formatRepoUser,
        templateSelection: formatRepoSelectionUser
    });

    $('#sel-customer_t').select2({     
        dropdownParent: $("#modal-quick-add-service-ticket"),   
        minimumInputLength: 0        
    });

    $('#add-another-items').on('click', function(){
        $('#quick-add-service-ticket-item-list').modal('show');
    });

    $('#adjustment-amount').on('input', function(){
        computeGrandTotal();
    });

    $('#sel-customer_t').change(function(){
        var id  = $(this).val();
        var url = base_url + 'ticket/_get_customer_basic_information'
        $.ajax({
            type: 'POST',
            url:url,
            data: {id : id },
            dataType: 'json',
            success: function(response){            
                if( response.phone_m != null ){
                    $("#ticket_customer_phone").val(response.phone_m);
                }else{
                    $("#ticket_customer_phone").val(response.phone_h);
                }

                var service_location = response.mail_add + ' ' + response.city + ', ' + response.state + ' ' + response.zip_code;
                $("#service_location").val(service_location);
                $("#customer_city").val(response.city);
                $("#customer_state").val(response.state);
                $("#customer_zip").val(response.zip_code);                
                $("#customer_zip").val(response.zip_code);
                $("#business_name").val(response.business_name);
                
                $("#customer_cc_num").val(response.cc_num);
                $("#customer_cc_expiry_date_month").val(response.cc_exp_month);
                $("#customer_cc_expiry_date_year").val(response.cc_exp_year);
                $("#customer_cc_cvc").val(response.cc_cvc);

                var mmr  = parseFloat(response.mmr);
                var otps = parseFloat(response.otps);
                $("#plan-value").val(mmr.toFixed(2));
                $("#service-ticket-otp").val(otps.toFixed(2));
                $('#span_mmr').html(mmr.toFixed(2));
                $('#span_otp').html(otps.toFixed(2))

                $("#customer_monitoring_id").val(response.cs_account);

                $("#customer_check_account_number").val(response.acct_num);
                $("#customer_check_bank_name").val(response.bank_name);
                $("#customer_check_routing_number").val(response.routing_num);
                $("#customer_check_number").val(response.check_num);

                $("#customer_ach_account_number").val(response.acct_num);
                $("#customer_ach_routing_number").val(response.routing_num);

                if( response.panel_type != '' && response.panel_type != null ){
                    $('#panel_type').val(response.panel_type);
                }else{
                    $('#panel_type').val('None');
                }

                if( response.plan_type != '' && response.plan_type != null ){
                    $('#plan_type').val(response.plan_type);
                }else{
                    $('#plan_type').val('');
                }

                if( response.warranty_type != '' && response.warranty_type != null ){
                    $('#warranty_type').val(response.warranty_type);
                }else{
                    $('#warranty_type').val('');
                }

                //Start Emergency Contacts
                if( response.ec1_firstname != '' && response.ec1_firstname != null ){
                    $('#contact_first_name1').val(response.ec1_firstname);
                }else{
                    $('#contact_first_name1').val('');
                }

                if( response.ec1_lastname != '' && response.ec1_lastname != null ){
                    $('#contact_last_name1').val(response.ec1_lastname);
                }else{
                    $('#contact_last_name1').val('');
                }

                if( response.ec1_phone != '' && response.ec1_phone != null ){
                    $('#contact_phone1').val(response.ec1_phone);
                }else{
                    $('#contact_phone1').val('');
                }

                if( response.ec1_relationship != '' && response.ec1_relationship != null ){
                    $('#contact_relationship1').val(response.ec1_relationship);
                }else{
                    $('#contact_relationship1').val('');
                }


                if( response.ec2_firstname != '' && response.ec2_firstname != null ){
                    $('#contact_first_name2').val(response.ec2_firstname);
                }else{
                    $('#contact_first_name2').val('');
                }

                if( response.ec2_lastname != '' && response.ec2_lastname != null ){
                    $('#contact_last_name2').val(response.ec2_lastname);
                }else{
                    $('#contact_last_name2').val('');
                }

                if( response.ec2_phone != '' && response.ec2_phone != null ){
                    $('#contact_phone2').val(response.ec2_phone);
                }else{
                    $('#contact_phone2').val('');
                }

                if( response.ec2_relationship != '' && response.ec2_relationship != null ){
                    $('#contact_relationship2').val(response.ec2_relationship);
                }else{
                    $('#contact_relationship2').val('');
                }


                if( response.ec3_firstname != '' && response.ec3_firstname != null ){
                    $('#contact_first_name3').val(response.ec3_firstname);
                }else{
                    $('#contact_first_name3').val('');
                }

                if( response.ec3_lastname != '' && response.ec3_lastname != null ){
                    $('#contact_last_name3').val(response.ec3_lastname);
                }else{
                    $('#contact_last_name3').val('');
                }

                if( response.ec3_phone != '' && response.ec3_phone != null ){
                    $('#contact_phone3').val(response.ec3_phone);
                }else{
                    $('#contact_phone3').val('');
                }

                if( response.ec3_relationship != '' && response.ec3_relationship != null ){
                    $('#contact_relationship3').val(response.ec3_relationship);
                }else{
                    $('#contact_relationship3').val('');
                }
                //End Emergency contacts

                if( response.bill_method == 'CC' ){
                    $('#bill_method').val('CC');
                    $('.grp-billing-cc').show();
                    $('.grp-billing-check').hide();
                    $('.grp-billing-ach').hide();
                }else if( response.bill_method == 'ACH' ){
                    $('#bill_method').val('ACH');
                    $('.grp-billing-cc').hide();
                    $('.grp-billing-check').hide();
                    $('.grp-billing-ach').show();
                }else{
                    $('#bill_method').val('CHECK');
                    $('.grp-billing-cc').hide();
                    $('.grp-billing-check').show();
                    $('.grp-billing-ach').hide();
                }

                if( response.panel_type != '' ){
                    $('#panel_type').val(response.panel_type);
                }

                computeGrandTotal();
            },
            error: function(response){
    
            }
        });
    });

    $("#modal_items_list").nsmPagination({itemsPerPage:10});
    $("#search_field").on("input", debounce(function() {
        tableSearch($(this));        
    }, 1000));

    // $('#modal_items_list').DataTable({
    //     "autoWidth" : false,
    //     "columnDefs": [
    //     { width: 540, targets: 0 },
    //     { width: 100, targets: 0 },
    //     { width: 100, targets: 0 }
    //     ],
    //     "ordering": false,
    // });

    $('.quick-add-service-ticket-item').on('click', function(){
        var idd = this.id;
        var title = $(this).data('itemname');
        var price = $(this).data('price');
        
        if(!$(this).data('quantity')){
          var qty = 1;
        }else{
          //var qty = $(this).data('quantity');
          var qty = 1;
        }

        var count = parseInt($("#service-ticket-item-count").val()) + 1;
        $("#service-ticket-item-count").val(count);
        var total_ = price * qty;
        var tax_ =(parseFloat(total_).toFixed(2) * 7.5) / 100;
        var taxes_t = parseFloat(tax_).toFixed(2);
        var total = parseFloat(total_).toFixed(2);
        var withCommas = Number(total).toLocaleString('en');
        total = '$' + withCommas + '.00';
        $("#ITEMLIST_PRODUCT_"+idd).hide();
        markup = "<tr id=\"ss\">" +
            "<td><input value='"+title+"' type=\"text\" name=\"items[]\" class=\"form-control getItems\" ><input type=\"hidden\" value='"+idd+"' name=\"item_id[]\"><input type=\"hidden\" name=\"itemid[]\" id=\"itemid\" class=\"itemid\" value='"+idd+"'><input type=\"hidden\" name=\"packageID[]\" value=\"0\"></td>\n" +
            "<td><div class=\"dropdown-wrapper\"><select name=\"item_type[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></div></td>\n" +
            "<td><input data-itemid='"+idd+"' min='0' id='quantity_"+count+"' value='"+qty+"' type=\"number\" name=\"quantity[]\" data-counter='"+count+"'  min=\"0\" class=\"form-control quantity mobile_qty \"></td>\n" +
            // "<td>\n" + '<input type="number" class="form-control qtyest" name="quantity[]" data-counter="' + count + '" id="quantity_' + count + '" min="1" value="1">\n' + "</td>\n" +
            "<td><input data-itemid='"+idd+"' min='0' step='any' id='price_"+count+"' value='"+price+"'  type=\"number\" name=\"price[]\" data-counter='"+count+"' class=\"form-control price \" placeholder=\"Unit Price\"><input type=\"hidden\" class=\"priceqty\" id='priceqty_"+idd+"'></td>\n" +
            // "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter="0" id=\"discount_0\" min="0" value="0" ></td>\n" +
            // "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
            "<td class=\"\"><input type=\"number\" name=\"discount[]\" value=\"0\" class=\"form-control discount\" data-counter='"+count+"' id='discount_"+count+"'></td>\n" +
            // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
            "<td class=\"\"><input type=\"text\" data-itemid='"+idd+"' class=\"form-control tax_change\" name=\"tax[]\" data-counter='"+count+"' id='tax1_"+count+"' readonly min=\"0\" value='"+taxes_t+"'></td>\n" +
            "<td style=\"text-align: right\" class=\"\"><span data-subtotal='"+total_+"' id='span_total_"+count+"' class=\"total_per_item\">"+total+
            // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
            "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text"+count+"' value='"+total+"'></td>" +
            "<td>\n" +
            "<a href=\"javascript:void(0);\" class=\"quick-add-service-item-remove btn btn-sm nsm-button primary\" id='"+idd+"'><i class=\"bx bx-fw bx-trash\"></i></a>\n" +
            "</td>\n" +
            "</tr>";
        tableBody = $("#service-ticket-items");
        tableBody.append(markup);   

        $('#quick-add-service-ticket-item-list').modal('hide');
        quickAddServiceTicketItemCalculation(count);
    });

    $(document).on("focusout", ".quantity", function () {
      var counter = $(this).data("counter");
      quickAddServiceTicketItemCalculation(counter);
    });

    $(document).on("change", ".quantity", function () {
      var counter = $(this).data("counter");
      quickAddServiceTicketItemCalculation(counter);
    });

    $(document).on("change", ".price", function () {
      var counter = $(this).data("counter");
      quickAddServiceTicketItemCalculation(counter);
    });

    $(document).on("focusout", ".price", function () {
      var counter = $(this).data("counter");
      quickAddServiceTicketItemCalculation(counter);
    });

    $(document).on("focusout", ".discount", function () {
      var counter = $(this).data("counter");
      quickAddServiceTicketItemCalculation(counter);
    });

    $(document).on("focusout", ".tax_change", function () {
      var counter = $(this).data("counter");
      quickAddServiceTicketItemCalculation(counter);
    });

    $(document).on("click", '.quick-add-service-item-remove', function(){
        $(this).closest('tr').remove();
        var counter = parseInt($("#service-ticket-item-count").val()) - 1;
        if( counter == 0 ){
            $("#span_sub_total_invoice").text('0.00');
            $("#item_total").val(0);

            $("#grand_total").text('0.00');
            $("#grand_total_input").val(0);

            $("#total_tax_").text('0.00');
            $("#total_tax_input").val(0);

            computeGrandTotal();
        }else{        
          var fixedSubtotal = calculateSubtotal();
          $("#item_total").val(fixedSubtotal);
          $("#item_total_text").html(fixedSubtotal);
          $("#span_sub_total_invoice").text(fixedSubtotal);
          
          var idd = this.id;
          $("#ITEMLIST_PRODUCT_"+idd).show();

          var fixedTaxes = calculateTaxes();
          $("#total_tax_").text(fixedTaxes);
          $("#total_tax_input").val(fixedTaxes);

          computeGrandTotal();
        }
        
        $("#service-ticket-item-count").val(counter);
    });

    function computeGrandTotal(){
        var fixedSubtotal = calculateSubtotal();
        var fixedTaxes = calculateTaxes();
        // var otp = $('#service-ticket-otp').val();
        // //var mmr = $('#service-ticket-monthly-monitoring-rate').val();
        // var mmr = $('#plan-value').val();
        // var installation_cost = $('#service-ticket-installation-cost').val();

        var otp = 0;        
        var mmr = 0;
        var installation_cost = 0;
        var adjustment_amount = $('#adjustment-amount').val();
        
        if( isNaN(adjustment_amount) || adjustment_amount == '' ){
            adjustment_amount = 0;
        }

        var grandTotal = parseFloat(fixedSubtotal) + parseFloat(fixedTaxes) + parseFloat(otp) + parseFloat(mmr) + parseFloat(installation_cost) + parseFloat(adjustment_amount);

        $("#grand_total").text(grandTotal.toFixed(2));
        $("#grand_total_input").val(grandTotal.toFixed(2));
    }

    function quickAddServiceTicketItemCalculation(counter) {
      var price = $("#price_" + counter).val();
      var quantity = $("#quantity_" + counter).val();
      var discount = $("#discount_" + counter).val();
      var tax = (parseFloat(price) * 7.5) / 100;
      var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(2);
      var subtotaltax = 0;
      var stotal_cost = 0;

      if( discount == '' ){
        discount = 0;
      }
      
      var total = (
        (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
        parseFloat(discount)
      ).toFixed(2);

      $("#span_total_" + counter).text(total);
      $("#sub_total_text" + counter).val(total);
      $("#discount_" + counter).val(discount);
      $("#tax1_" + counter).val(tax1);

      var fixedSubtotal = calculateSubtotal();
      $("#item_total").val(fixedSubtotal);
      $("#item_total_text").html(fixedSubtotal);
      $("#span_sub_total_invoice").text(fixedSubtotal);

      var fixedTaxes = calculateTaxes();
      $("#total_tax_").text(fixedTaxes);
      $("#total_tax_input").val(fixedTaxes);

      computeGrandTotal();
    }

    function calculateTaxes() {
      let retval = 0;
      const $rows = document.querySelectorAll("#service-ticket-items tr");

      [...$rows].forEach($row => {
        const $tax = $row.querySelector("[name^=tax]");
        retval = retval + Number($tax.value);
      });

      return retval.toFixed(2);
    }

    function calculateSubtotal() {
      let retval = 0;
      const $rows = document.querySelectorAll("#service-ticket-items tr");

      [...$rows].forEach($row => {
        const $price = $row.querySelector("[name^=price]");
        const $quantity = $row.querySelector("[name^=quantity]");
        const $discount = $row.querySelector("[name^=discount]");

        const price = Number($price.value);
        const quantity = Number($quantity.value);
        const discount = Number($discount.value);
        retval = retval + (price * quantity) - discount;
      });

      return retval.toFixed(2);
    }

    $('#is-with-esign').on('change', function(){
        if( $(this).is(':checked') ){
            $('#with-esign-inputs-container').fadeIn();
            $('#with-esign-emergency-contacts-container').fadeIn();
        }else{
            $('#with-esign-inputs-container').fadeOut();
            $('#with-esign-emergency-contacts-container').fadeOut();
        }
    });

    $('#service-ticket-monthly-monitoring-rate').on('change', function(){
        var selected = $(this).val();
        $('#plan-value').val(selected);
        $('#span_mmr').html(selected);
        computeGrandTotal();
    });

    $('#service-ticket-installation-cost').on('change', function(){
        var amount = parseFloat($(this).val());
        if( amount > 0 ){
            $('#span_installation_cost').html(amount.toFixed(2))
        }else{
            $('#span_installation_cost').html('0.00');
        }

        computeGrandTotal();
    });

    $('#service-ticket-otp').on('change', function(){
        var amount = parseFloat($(this).val());
        if( amount > 0 ){
            $('#span_otp').html(amount.toFixed(2));
        }else{
            $('#span_otp').html('0.00');
        }

        computeGrandTotal();
    });

    $('.phone_number').keydown(function(e) {
        var key = e.charCode || e.keyCode || 0;
        $text = $(this);
        if (key !== 8 && key !== 9) {
            if ($text.val().length === 3) {
                $text.val($text.val() + '-');
            }
            if ($text.val().length === 7) {
                $text.val($text.val() + '-');
            }
        }
        return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
    });

    $('#bill_method').on('change', function(){
        var selected = $(this).val();

        if( selected == 'CC' ){
            $('.grp-billing-cc').show();
            $('.grp-billing-check').hide();
            $('.grp-billing-ach').hide();
        }else if( selected == 'ACH' ){
            $('.grp-billing-cc').hide();
            $('.grp-billing-check').hide();
            $('.grp-billing-ach').show();
        }else{
            $('.grp-billing-cc').hide();
            $('.grp-billing-check').show();
            $('.grp-billing-ach').hide();
        }
    });

    $("#scheduled_time").on( 'change', function () {
        var tag_id = this.value;
        var end_time = moment.utc(tag_id,'hh:mm a').add(<?= $time_interval; ?>,'hour').format('h:mm a');

        if(end_time === 'Invalid date') {
            $('#scheduled_time_to').val("");
        }else{
            $('#scheduled_time_to').val(end_time);
        }
    });
});
</script>
<script>
$(document).on('click', '.saveCustomer', function() {

    var first_name      = $('[name="first_name"]').val();
    var middle_name     = $('[name="middle_name"]').val();
    var last_name       = $('[name="last_name"]').val();
    var contact_email   = $('[name="contact_email"]').val();
    var contact_mobile  = $('[name="contact_mobile"]').val();
    var contact_phone   = $('[name="contact_phone"]').val();
    var customer_type   = $('[name="customer_type"]').val();
    var street_address  = $('[name="street_address"]').val();
    var suite_unit      = $('[name="suite_unit"]').val();
    var city            = $('[name="city"]').val();
    var postcode        = $('[name="postcode"]').val();
    var state           = $('[name="state"]').val();

    //new added
    var suffix_name             = $('[name="suffix_name"]').val();
    var date_of_birth           = $('[name="date_of_birth"]').val();
    var social_security_number  = $('[name="social_security_number"]').val();
    var status                  = $('[name="status"]').val();

    // alert(first_name);

    $.ajax({
        type: 'POST',
        url: "<?php echo base_url(); ?>estimate/addNewCustomer",
        data: {
            first_name: first_name,
            middle_name: middle_name,
            last_name: last_name,
            contact_email: contact_email,
            contact_mobile: contact_mobile,
            contact_phone: contact_phone,
            customer_type: customer_type,
            street_address: street_address,
            suite_unit: suite_unit,
            city: city,
            postcode: postcode,
            state: state,
            suffix_name: suffix_name,
            date_of_birth: date_of_birth,
            social_security_number: social_security_number,
            status: status
        },
        dataType: 'json',
        success: function(response) {
            // alert('success');
            location.reload();
        },
        error: function(response) {
            location.reload();

        }
    });
});
</script>

<script src="<?php echo $url->assets ?>js/add.js"></script>