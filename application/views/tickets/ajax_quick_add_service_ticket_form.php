<style>
.custom-ticket-header{
    background-color: #6a4a86;
    color: #ffffff;
    font-size: 15px;
    padding: 10px;
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
</style>
<input type="hidden" id="siteurl" value="<?=base_url();?>">
<input type="hidden" id="redirect-calendar" name="redirect_calendar" value="<?= $redirect_calendar; ?>">
<div class="row" style="margin-top:0px;">    
    <div class="col-md-6">
        <div class="nsm-card primary">
            <div class="nsm-card-content">
                <label for="customers" class="required"><b>Customer</b></label>
                    <a class="link-modal-open" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modalNewCustomer" style="color:#02A32C;float:right;"><span class="fa fa-plus fa-margin-right" style="color:#02A32C;"></span>New Customer</a>
                    <select id="sel-customer_t" name="customer_id" data-customer-source="dropdown" required="" class="form-control searchable-dropdown" placeholder="Select">
                        <option value="0">- Select Customer -</option>
                        <?php foreach($customers as $c){ ?>
                            <option value="<?= $c->prof_id; ?>"><?= $c->first_name . ' ' . $c->last_name; ?></option>
                        <?php } ?>
                    </select>
                    <label for="city" class="mt-2"><b>Business Name</b> (optional)</label>
                    <input type="text" class="form-control" name="business_name" id="business_name" placeholder="Business Name" />
                    <label for="job_name" class="mt-2"><b>Service description</b> (optional)</label>
                    <textarea class="form-control" name="service_description"></textarea>
                    <label for="city" class="mt-2">Service Tag</label><label style="float:right;margin-bottom:10px;"></label>
                    <select class="form-control" name="job_tag">
                        <?php foreach($tags as $t){ ?>
                            <option value="<?= $t->name; ?>"><?= $t->name; ?></option>
                        <?php } ?>
                    </select>
            </div>
        </div>        
    </div>

    <div class="col-md-6">
        <div class="nsm-card primary">
            <div class="nsm-card-content">
                <label for="job_location" class="required"><b>City</b></label>
                <input type="text" class="form-control" name="customer_city" id="customer_city"
                        required placeholder="Enter City" 
                        onChange="jQuery('#customer_name').text(jQuery(this).val());"/>
                <label for="job_location" class="required mt-2"><b>Service Location</b></label>
                <input type="text" class="form-control" name="service_location" id="service_location"
                        required placeholder="Enter Location"
                        onChange="jQuery('#customer_name').text(jQuery(this).val());"/>
                <label for="job_location" class="required mt-2"><b>State</b></label>
                <input type="text" class="form-control" name="customer_state" id="customer_state"
                        required placeholder="Enter State" 
                        onChange="jQuery('#customer_name').text(jQuery(this).val());"/>

                <label for="job_location" class="required mt-2"><b>Zip Code</b></label>
                <input type="text" class="form-control" name="customer_zip" id="customer_zip"
                        required placeholder="Enter Zip Code" 
                        onChange="jQuery('#customer_name').text(jQuery(this).val());"/>
                <label for="job_location" class="required mt-2"><b>Customer Phone Number</b></label>
                <input type="text" class="form-control phone_number" name="customer_phone" id="ticket_customer_phone" required maxlength="12" placeholder="xxx-xxx-xxxx" />
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
                        <label for="estimate_date" class="required"><b>Service Ticket No.</b></label>
                        <input type="text" class="form-control" name="ticket_no" id="ticket_no"
                                required placeholder="Enter Ticket#" a value="<?= $prefix . $next_num; ?>" readonly="" />
                    </div>
                    <div class="col-md-3">
                        <label for="estimate_date" class="required"><b>Schedule Date</b></label>
                        <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" value="<?= date("m/d/Y", strtotime($default_start_date)); ?>" name="ticket_date" id="ticket_date"
                                    placeholder="Enter Ticket Date" required>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="expiry_date" class="required"><b>Schedule Time From</b></label>
                        <select id="scheduled_time" name="scheduled_time" class="nsm-field form-select" required>
                            <option value="">From</option>
                            <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                <option <?= $default_start_time == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="expiry_date" class="required"><b>Schedule Time To</b></label>
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
                        <label for="zip"><b>Ticket Status</b></label>
                        <select id="ticket_status" name="ticket_status" class="form-control">
                            <!-- <option value="New">New</option> -->
                            <option value="Draft">Draft</option>
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
                        <label for="zip"><b>Panel Type</b></label>
                            <select name="panel_type" id="panel_type" class="form-control" data-value="<?= isset($alarm_info) ? $alarm_info->panel_type : "" ?>">
                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == ''){echo "selected";} } ?>  value="0">- none -</option>
                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'AERIONICS'){echo "selected";} } ?> value="AERIONICS">AERIONICS</option>
                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'AlarmNet'){echo "selected";} } ?> value="AlarmNet">AlarmNet</option>
                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Alarm.com'){echo "selected";} } ?> value="Alarm.com">Alarm.com</option>
                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Alula'){echo "selected";} } ?> value="Alula">Alula</option>
                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Bosch'){echo "selected";} } ?> value="Bosch">Bosch</option>
                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'DSC'){echo "selected";} } ?> value="DSC">DSC</option>
                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'ELK'){echo "selected";} } ?> value="ELK">ELK</option>
                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'FBI'){echo "selected";} } ?> value="FBI">FBI</option>
                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'GRI'){echo "selected";} } ?> value="GRI">GRI</option>
                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'GE'){echo "selected";} } ?> value="GE">GE</option>
                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell'){echo "selected";} } ?> value="Honeywell">Honeywell</option>
                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell Touch'){echo "selected";} } ?> value="Honeywell Touch">Honeywell Touch</option>
                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell 3000'){echo "selected";} } ?> value="Honeywell 3000">Honeywell 3000</option>
                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell'){echo "selected";} } ?> value="Honeywell Vista">Honeywell Vista</option>
                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell Vista with Sem'){echo "selected";} } ?> value="Honeywell Vista with Sem">Honeywell Vista with Sem</option>
                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell Lyric'){echo "selected";} } ?> value="Honeywell Lyric">Honeywell Lyric</option>
                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'IEI'){echo "selected";} } ?> value="IEI">IEI</option>
                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'MIER'){echo "selected";} } ?> value="MIER">MIER</option>
                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == '2 GIG'){echo "selected";} } ?> value="2 GIG">2 GIG</option>
                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == '2 GIG Go Panel 2'){echo "selected";} } ?> value="2 GIG Go Panel 2">2 GIG Go Panel 2</option>
                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == '2 GIG Go Panel 3'){echo "selected";} } ?> value="2 GIG Go Panel 3">2 GIG Go Panel 3</option>
                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Qolsys'){echo "selected";} } ?> value="Qolsyx">Qolsys</option>
                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Qolsys IQ Panel 2'){echo "selected";} } ?> value="Qolsys IQ Panel 2">Qolsys IQ Panel 2</option>
                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Qolsys IQ Panel 2 Plus'){echo "selected";} } ?> value="Qolsys IQ Panel 2 Plus">Qolsys IQ Panel 2 Plus</option>
                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Qolsys IQ Panel 3'){echo "selected";} } ?> value="Qolsys IQ Panel 3">Qolsys IQ Panel 3</option>
                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Custom'){echo "selected";} } ?> value="Custom">Custom</option>
                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Other'){echo "selected";} } ?> value="Other">Other</option>
                            </select>
                    </div>
                    <div class="col-md-3" id="technicianDiv">
                        <label for="zip"><b>Service Type</b></label>
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
                        <label for="zip"><b>Warranty Type</b></label>
                        <select id="warranty_type" name="warranty_type" data-customer-source="dropdown" class="form-control" >
                            <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == ""){ echo 'selected'; } } ?> value="">Select</option>
                            <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "Limited. 90 Days"){ echo 'selected'; } } ?> value="Limited. 90 Days">Limited 90 Days</option>
                            <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "1 Year"){ echo 'selected'; } } ?>  value="1 Year">1 Year</option>
                            <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "$25 Trip"){ echo 'selected'; } } ?>  value="$25 Trip">$25 Trip</option>
                            <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "$50 Trip and $65 Deductible"){ echo 'selected'; } } ?>  value="$50 Trip and $65 Deductible">$50 Trip and $65 Deductible</option>
                            <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "Extended"){ echo 'selected'; } } ?>  value="Extended">Extended</option>
                            <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "None"){ echo 'selected'; } } ?>  value="None">None</option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="zip"><b>Created By</b></label>                        
                        <select class="form-control mb-3" name="employee_id">
                            <option value="0">Select Name</option>
                            <?php foreach($users_lists as $ulist){ ?>
                                <option <?php if($ulist->id == logged('id')){ echo "selected";} ?> value="<?php echo $ulist->id ?>"><?php echo $ulist->FName .' '.$ulist->LName; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for=""><b>Assigned Technician</b></label>
                        <select class="form-control nsm-field form-select" name="assign_tech[]" id="ticket-appointment-user" multiple="multiple">
                        </select>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="zip"><b>Job Description</b></label>                        
                        <textarea name="job_description" class="form-control" required="" style="height:100px;"></textarea>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="is_with_esign" id="is-with-esign" value="1">
                            <label class="form-check-label" for="is-with-esign">Is with eSign</label>
                        </div>
                    </div>
                </div>

                <div id="with-esign-inputs-container" style="display:none;">
                    <div class="row mt-4" style="background-color:white;">
                        <div class="col-md-6 form-group">
                            <div class="row">
                                <div class="col-md-6 form-group mt-2">
                                    <label for="service-ticket-monthly-monitoring-rate"><b>Monthly Monitoring Rate</b></label>
                                    <select style="display:inline-block;" class="form-control nsm-field form-select" name="monthly_monitoring_rate" id="service-ticket-monthly-monitoring-rate">
                                        <option value="0.00">Select Plan Rate</option>
                                        <?php foreach( $ratePlans as $rp ){ ?>
                                            <option value="<?= $rp->amount; ?>"><?= $rp->plan_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group mt-2">
                                    <label for=""><b>Monthly Monitoring Rate Value</b></label>
                                    <input style="display:inline-block;" type="text" id="plan-value" value="0.00" class="form-control" disabled="" readonly="" />
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="col-md-6 form-group" id="service-ticket-esign-template">                            
                            <label for="esign-template-list"><b>eSign Templates</b></label>
                            <select class="form-control nsm-field form-select" name="esign_template" id="esign-templates">
                                <?php foreach($esignTemplates as $e){ ?>
                                    <?php 
                                        $template_name = $e->name;
                                        if( $e->is_default == 1 ){
                                            $template_name = $e->name .'(default)';
                                        }    
                                    ?>
                                    <option value="<?= $e->id; ?>"><?= $template_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6 form-group mt-2">
                            <div class="row">
                                <div class="col-md-6 form-group mt-2">
                                    <label for="service-ticket-installation-cost"><b>Installation Cost</b></label>
                                    <input type="number" step="any" class="form-control" value="0.00" name="installation_cost" id="service-ticket-installation-cost" required>
                                </div>
                                <div class="col-md-6 form-group mt-2">
                                    <label for="service-ticket-otp"><b>One Time (Program and Setup)</b></label>
                                    <input type="number" step="any" class="form-control" value="0.00" name="otp" id="service-ticket-otp" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                

                <div class="row mt-4" style="background-color:white;font-size:16px;">
                    <h6 class='card_header custom-ticket-header'>Service Ticket Items Listing</h6>
                </div>
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
                    <div class="col-md-8"></div>
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
                                <td>Monthly Monitoring Rate</td>
                                <td colspan="2" align="right">$ <span id="span_mmr">0.00</span></td>
                            </tr>
                            <tr>
                                <td>Installation Cost</td>
                                <td colspan="2" align="right">$ <span id="span_installation_cost">0.00</span></td>
                            </tr>
                            <tr>
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
                        <b>Cell Phone</b>
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
    <div class="modal-dialog modal-md" style="margin-top:5%;">
        <div class="modal-content">
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
    $('#esign-templates').select2({
        dropdownParent: $("#modal-quick-add-service-ticket #with-esign-inputs-container"),
        placeholder: 'Select template',
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
                $("#service_location").val(response.mail_add);
                $("#customer_city").val(response.city);
                $("#customer_state").val(response.state);
                $("#customer_zip").val(response.zip_code);                
                $("#customer_zip").val(response.zip_code);
                $("#business_name").val(response.business_name);
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
        var otp = $('#service-ticket-otp').val();
        var mmr = $('#service-ticket-monthly-monitoring-rate').val();
        var installation_cost = $('#service-ticket-installation-cost').val();
        var grandTotal = parseFloat(fixedSubtotal) + parseFloat(fixedTaxes) + parseFloat(otp) + parseFloat(mmr) + parseFloat(installation_cost);

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
        }else{
            $('#with-esign-inputs-container').fadeOut();
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
            $('#span_otp').html(amount.toFixed(2))
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