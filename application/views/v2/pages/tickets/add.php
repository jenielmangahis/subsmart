<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('v2/includes/header'); ?>

<style>
    
.select2-results__option {
    text-align: left;
}
.select2-container .select2-selection--single .select2-selection__rendered {
    text-align: left;
}
.autocomplete-img{
  height: 50px;
  width: 50px;
}
.autocomplete-left{
  display: inline-block;
  width: 65px;
}
.autocomplete-right{
    display: inline-block;
    width: 80%;
    vertical-align: top;
}
.clear{
  clear: both;
}

.signature_mobile
{
    display: none;
}

.show_mobile_view
{
    display: none;
}
hr{
    border: 0.5px solid #32243d !important;
    width: 100%;
}
.row{
    margin-top: 20px;
}
.banking-tab-container {
    border-bottom: 1px solid grey;
    padding-left: 0;
}
.form-line{
    padding-bottom: 1px;
}
.input_select{
    color: #363636;
    border: 2px solid #e0e0e0;
    box-shadow: none;
    display: inline-block !important;
    width: 100%;
    background-color: #fff;
    background-clip: padding-box;
    font-size: 11px !important;
}
.pb-30 {
  padding-bottom: 30px;
}
h5.card-title.mb-0, p.card-text.mt-txt {
  text-align: center !important;
}
.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 54% !important;
    right: 9px !important;
}
.card-deck-upgrades {
  display: block;
}
.card-deck-upgrades div {
    padding: 20px;
    float: left;
    width: 33.33%;
}
.card-body.align-left {
  width: 100% !important;
}
.card-deck-upgrades div a {
    display: block;
    width: 100%;
    min-height: 400px;
    float: left;
    text-align: center;
}
.page-title, .box-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
  padding-top: 5px;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.left {
  float: left;
}
.p-40 {
  padding-left: 15px !important;
  padding-top: 40px !important;
}
a.btn-primary.btn-md {
    height: 38px;
    display: inline-block;
    border: 0px;
    padding-top: 7px;
    position: relative;
    top: 0px;
}
.card.p-20 {
    padding-top: 18px !important;
}
.fr-right {
  float: right;
  justify-content: flex-end;
}
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 20px !important;
  padding-left: 20px !important;
}
.pd-17 {
  position: relative;
  left: 17px;
}
@media only screen and (max-width: 1300px) {
  .card-deck-upgrades div a {
      min-height: 440px;
  }
}
@media only screen and (max-width: 1250px) {
  .card-deck-upgrades div a {
      min-height: 480px;
  }
  .card-deck-upgrades div {
    padding: 10px !important;
  }
}
@media only screen and (max-width: 600px) {
  .p-40 {
    padding-top: 0px !important;
  }
  .pr-b10 {
    position: relative;
    bottom: 0px;
  }
}
#new_customer .row{
    margin-top:0px !important;
}
#quick-add-item .nsm-table thead td {
    background-color: #6a4a86;
    color: #ffffff;
}
.block-label{
    display:block;
    height:30px;
}
.block-label a{
    float:right;
}
.block-label b{
    position:relative;
    top:10px;
}
.but:hover {
    font-weight: 900;
    color:black;
}
.but-red:hover {
    font-weight: 900;
    color:red;
}
.required:after {
    content:" *";
    color: red;
}
.custom-ticket-header{
    background-color: #6a4a86;
    color: #ffffff;
    font-size: 15px;
    padding: 10px;
}
#jobs_items_table_body .remove i{
    position: relative;
    top: 1px;
    left: 7px;
}
#jobs_items_table_body .nsm-button {
    margin: 0 auto;
    display: block;
    padding: 4px;
}
.tax_change, .discount, .price {
    text-align: right;
}
.span-input {
    display: block;
    width: 100%;
    height: calc(1.5em + .75rem + 2px);
    padding: .375rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    text-align: right;
    background-color: #E9ECEF;
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
    <ul class="nsm-fab-options">        
        <li onclick="location.href='<?= base_url('customer/ticketslist'); ?>'">
            <div class="nsm-fab-icon">
                <i class="bx bx-fw bx-message-square-error"></i>
            </div>
            <span class="nsm-fab-label">List Service Ticket</span>
        </li>     
    </ul>   
</div>
<input type="hidden" id="siteurl" value="<?=base_url();?>">
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/service_tickets_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/service_ticket_subtabs'); ?>
    </div>
    
    <?php echo form_open_multipart('tickets/savenewTicket', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?> 
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary" id="updateHeaderDiv">
                            <!-- <button><i class='bx bx-fw bx:edit'></i></button> -->
                           <span class="updateHeader">
                            <?php if($headers){ echo $headers->content; }else{ ?>
                            Creating and Copying Customer Service Tickets in the  Customer Service module (CRM) are used to track customer service issues.  Service Tickets can be created from any Service Ticket Workbench or via the Service folder under Sales Category.  User can simply create on the Customer Account or directly from the calendar.  To save time Service Tickets can now also be created via a copy or from the Customer Items Owned screen. 
                            <?php } ?>
                            </span>
                            <i class="bx bx-fw bx-edit"></i>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="redirect-calendar" name="redirect_calendar" value="<?= $redirect_calendar; ?>">
                <div class="row">
                    <div class="col-md-5">
                        <div class="nsm-card primary">
                            <div class="nsm-card-content">
                                <label for="customers" class="required"><b>Customer</b></label>
                                <a class="link-modal-open nsm-button btn-small" href="javascript:void(0);" id="btn-add-new-customer" data-bs-toggle="modal" data-bs-target="#quick-add-customer" style="float:right;">Add New</a>
                                <select id="sel-customer_t" name="customer_id" data-customer-source="dropdown" required="" class="form-select searchable-dropdown" placeholder="Select">
                                    <option value="">- Select Customer -</option>
                                    <?php if( $default_customer_id > 0 ){ ?>
                                        <option value="<?= $default_customer_id; ?>" selected><?= $default_customer_name; ?></option>
                                    <?php } ?>  
                                </select>
                                <div class="row">
                                    <div class="col-md-6" style="display: ;">
                                        <label for="customer_phone" class="required"><b>Mobile Number</b></label>
                                        <input type="text" class="form-control phone_number" placeholder="xxx-xxx-xxxx" name="customer_phone" id="customer_phone" required  value=""/>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="business_name"><b>Business Name</b> (optional)</label>
                                        <input type="text" class="form-control" name="business_name" id="business_name" placeholder="Business Name" value=""/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12"> 
                                        <label for="job-tag"><b>Service Tag</b></label>
                                        <a class="nsm-button btn-small" style="float:right;" target="_new" href="<?= base_url('job/job_tags'); ?>">Manage Tag</a>
                                        <select class="form-select" name="job_tag" id="job-tag">
                                            <?php foreach($tags as $t){ ?>
                                                <option value="<?= $t->name; ?>"><?= $t->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <!-- <div class="col-md-12 mt-4">
                                        <label for="job_name"><b>Service description</b> (optional)</label>                                        
                                        <textarea class="form-control" name="service_description"></textarea>
                                    </div> -->
                                    <div class="col-md-12 mt-4">
                                        <label for="job_location" class="required"><b>Service Location</b></label>
                                        <a class="btn-use-different-address nsm-button default btn-small float-end" style="display:none;" id="btn-use-different-address" data-id="" href="javascript:void(0);">Use Other Address</a>
                                        <input type="text" class="form-control" name="customer_address" id="customer_address" required placeholder="Enter Location" value=""/>
                                        <input type="hidden" class="form-control" name="service_location" id="service_location" value=""/>
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <label for="customer_city" class="required"><b>City</b></label>
                                        <input type="text" class="form-control" name="customer_city" id="customer_city" required placeholder="Enter City" value=""/>
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <label for="customer_state" class="required"><b>State</b></label>
                                        <input type="text" class="form-control" name="customer_state" id="customer_state" required placeholder="Enter State" value=""/>
                                    </div>
                                    <div class="col-md-3 mt-4">
                                        <label for="customer_zip" class="required"><b>Zip Code</b></label>
                                        <input type="text" class="form-control" name="customer_zip" id="customer_zip" required placeholder="Enter Zip Code" value=""/>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="nsm-card primary">
                            <div class="nsm-card-content">
                                <div class="MAP_LOADER_CONTAINER">
                                    <div class="text-center MAP_LOADER">
                                        <iframe id="TEMPORARY_MAP_VIEW"
                                            src="http://maps.google.com/maps?output=embed" height="470" width="100%"
                                            style=""></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-content">
                            <div class="row">
                                    <div class="col-md-3">
                                        <label for="estimate_date" class="required"><b>Schedule Date</b></label>
                                        <input type="date" class="form-control" value="<?php echo date("Y-m-d"); ?>" name="ticket_date" id="ticket_date" placeholder="Enter Ticket Date" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="expiry_date" class="required"><b>Schedule Time From</b></label>
                                        <select id="scheduled_time" name="scheduled_time" class="nsm-field form-select" required>
                                            <option value="">From</option>
                                            <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                                <option value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
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
                                    <div class="col-md-3">
                                        <label for="purchase_order_number"><b>Purchase Order#</b></label>
                                        <input type="text" class="form-control" name="purchase_order_no"
                                            id="purchase_order_no" placeholder="Enter Purchase Order#"
                                            autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());" value=""/>
                                    </div>
                                </div>
                                <div class="row">        
                                    <div class="col-md-3">
                                        <label for="service_type" class="block-label"><b>Service Type</b> <a href="javascript:void(0);" class="nsm-button btn-small" id="btn-quick-add-service-type">Add New</a></label>
                                        <select class="form-select" name="service_type" id="service_type">
                                            <?php foreach($serviceType as $sType){ ?>
                                                <option value="<?php echo $sType->service_name; ?>"><?php echo $sType->service_name; ?></option>
                                            <?php } ?>
                                        </select>                                        
                                    </div>                            
                                    <div class="col-md-3">
                                        <label for="ticket_status" class="block-label"><b>Ticket Status</b></label>
                                        <!-- <input type="text" class="form-control" name="ticket_status" id="ticket_status" 
                                            placeholder="Enter Ticket Status" value="<?php //echo $tickets->ticket_status; ?>"/> -->
                                        <select id="ticket_status" name="ticket_status" class="form-select">
                                            <option value="New">New</option>
                                            <option value="Draft">Draft</option>
                                            <option value="Scheduled">Scheduled</option>
                                            <option value="Arrived">Arrived</option>
                                            <option value="Started">Started</option>
                                            <option value="Approved">Approved</option>
                                            <option value="Finished">Finished</option>
                                            <option value="Invoiced">Invoiced</option>
                                            <option value="Completed">Completed</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="panel_type" class="block-label"><b>Panel Type</b> <a href="javascript:void(0);" id="btn-quick-add-panel-type" class="btn-small nsm-button">Add New</a></label>                                            
                                        <select name="panel_type" id="panel_type" class="form-select" data-value="">
                                            <?php foreach($settingPanelTypes as $panelType){ ?>
                                                <option value="<?= $panelType->name; ?>"><?= $panelType->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3" id="technicianDiv">
                                        <label for="appointment-user" class="block-label"><b>Assigned Technician</b></label>
                                        <!-- <input type="text" class="form-control" name="assign_tech" id="assign_tech" /> -->
                                        <select class="form-select nsm-field form-select" name="assign_tech[]" id="appointment-user" multiple="multiple" tabindex="-1" aria-hidden="true" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">                                    
                                    <div class="col-md-3 form-group">
                                        <label for="warranty_type" class="block-label"><b>Warranty Type</b></label>
                                        <select id="warranty_type" name="warranty_type" data-customer-source="dropdown" class="form-select" >
                                            <option value="">Select</option>
                                            <option value="Limited. 90 Days">Limited 90 Days</option>
                                            <option value="1 Year">1 Year</option>
                                            <option value="$25 Trip">$25 Trip</option>
                                            <option value="$50 Trip and $65 Deductible">$50 Trip and $65 Deductible</option>
                                            <option value="Extended">Extended</option>
                                            <option value="None">None</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="plan_type" class="block-label"><b>Plan Type</b> <a href="javascript:void(0);" class="btn-small nsm-button" id="btn-quick-add-plan-type">Add New</a></label>
                                        <select class="form-select" name="plan_type" id="plan_type">
                                            <?php foreach($settingsPlanTypes as $planType){ ?>
                                                <option value="<?= $planType->name; ?>"><?= $planType->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="zip" class="block-label"><b>Created By</b></label>
                                        <!-- <input type="text" class="form-control" name="scheduled_time" id="employeeID" /> -->
                                        <select class="form-select mb-3" name="employee_id" id="employee_id">                                            
                                            <?php foreach($users_lists as $ulist){ ?>
                                                <option value="<?php echo $ulist->id ?>"><?php echo $ulist->FName .' '.$ulist->LName; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <!-- <div class="col-md-3 form-group mt-3">
                                        <label for="job_description"><b>Job Description</b></label>
                                        <textarea class="form-control" name="job_description" id="job_description"></textarea>
                                    </div> -->
                                </div>
                                <div class="row" id="plansItemDiv" style="background-color:white;">
                                    <h6 class='card_header custom-ticket-header'>Item List</h6>
                                    <div class="col-md-12 table-responsive">
                                        <input type="hidden" name="count" value="0" id="count">
                                        <table class="table table-hover table-borderless">
                                            <thead style="background-color:#E9E8EA;">
                                            <tr>
                                                <th>Name</th>
                                                <th style="width:20%;">Group</th>
                                                <!-- <th>Description</th> -->
                                                <th style="width:8%;">Quantity</th>
                                                <!-- <th>Location</th> -->
                                                <th style="width:8%;">Price</th>
                                                <th class="hidden_mobile_view" style="width:8%;">Discount</th>
                                                <th class="hidden_mobile_view" style="width:8%;">Tax</th>
                                                <th class="hidden_mobile_view" style="width:8%;">Total</th>
                                                <th class="" style="width:3%;"></th>
                                            </tr>
                                            </thead>
                                            <tbody id="jobs_items_table_body"></tbody>
                                        </table>
                                        <button class="link-modal-open nsm-button primary small link-modal-open" type="button" id="add_another_items">
                                            <i class='bx bx-plus'></i>Add Item
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end 2nd row -->
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-content">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <div class="select-wrap">
                                                    <b>Payment Method</b>
                                                    <select name="payment_method" id="payment_method" class="form-select">
                                                        <!-- <option value="">Choose method</option> -->
                                                        <option value="Cash">Cash</option>
                                                        <option value="Check">Check</option>
                                                        <option value="Credit Card">Credit Card</option>
                                                        <option value="Debit Card">Debit Card</option>
                                                        <option value="ACH">ACH</option>
                                                        <option value="Invoicing">Invoicing</option>
                                                        <option value="Warranty Work">Warranty Work</option>
                                                        <option value="Home Owner Financing">Home Owner Financing</option>
                                                        <option value="Other Payment Type">Other Payment Type</option>
                                                    </select>
                                                </div> 
                                            </div>     
                                            <div class="form-group col-md-3">
                                                <b>Amount</b>
                                                <input type="number" step="any" class="form-control payment_amount" name="payment_amount" id="payment_amount" placeholder="Enter Amount" />
                                            </div>
                                            <div class="form-group col-md-3">
                                                <b>Billing Date</b>
                                                <select name="billing_date" id="" class="form-select">
                                                    <option value="">0</option>
                                                    <?php for ($i=1; $i<=31; $i++ ) { ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>                                            
                                        </div>
                                        <div class="row" style="">
                                            <div class="col-12 col-md-12">
                                                <?php include viewPath('tickets/_payment_method_fields'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <table class="table table-borderless" style="text-align:left;">
                                            <tr>
                                                <td>Subtotal</td>
                                                <!-- <td></td> -->
                                                <td colspan="2" align="right"><span id="span_sub_total_invoice">0.00</span> <input type="hidden" name="subtotal" id="item_total" value="0.00"></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="is_tax_exempted" value="1" id="chk-tax-exempted">
                                                        <label class="form-check-label" for="chk-tax-exempted">
                                                            Taxes (check if no tax)
                                                        </label>
                                                    </div>
                                                </td>
                                                <!-- <td></td> -->
                                                <td colspan="2" align="right">$ <span id="total_tax_">0.00</span><input type="hidden" name="taxes" id="total_tax_input" value="0.00"></td>
                                            </tr>
                                            <?php if( $industrySpecificFields && array_key_exists('installation_cost', $industrySpecificFields) ){ ?>
                                                <?php if( !in_array('installation_cost', $disabled_industry_specific_fields) ){ ?>
                                                <tr>
                                                    <td colspan="2">Installation Cost</td>
                                                    <!-- <td></td> -->
                                                    <td align="right">
                                                        <input type="number" step="any" min="0" class="form-control" id="adjustment_ic" name="installation_cost" value="0.00" required="" style="text-align:right;width:50%;" />
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            <?php } ?>
                                            <?php if( $industrySpecificFields && array_key_exists('otps', $industrySpecificFields) ){ ?>
                                                <?php if( !in_array('otps', $disabled_industry_specific_fields) ){ ?>
                                                <tr>
                                                    <td colspan="2">One time (Program and Setup)</td>
                                                    <!-- <td></td> -->
                                                    <td align="right">
                                                        <input type="number" style="text-align:right;width:50%;" step="any" min="0" class="form-control" id="otps" name="otps" value="0.00" required="" />
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            <?php } ?>
                                            <?php if( $industrySpecificFields && array_key_exists('monthly_monitoring_rate', $industrySpecificFields) ){ ?>
                                                <?php if( !in_array('monthly_monitoring_rate', $disabled_industry_specific_fields) ){ ?>
                                                <tr>
                                                    <td colspan="2">Monthly Monitoring</td>
                                                    <!-- <td></td> -->
                                                    <td align="right">
                                                        <input type="number" style="text-align:right;width:50%;" step="any" min="0" class="form-control" id="adjustment_mm" name="monthly_monitoring" value="0.00" required="" />
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            <?php } ?>
                                            <tr>
                                                <td colspan="2">
                                                    <input type="text" class="form-control" placeholder="Adjustment" name="adjustment" value="" style="width:80%;display:inline;">
                                                    <span id="modal-help-popover-adjustment" class='bx bx-fw bx-help-circle' data-bs-trigger="hover" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="" style="margin-right: -19px;"></span>
                                                </td>
                                                <td align="right">
                                                    <input type="number" step="any" style="width:50%;float:right;text-align:right;" class="form-control adjustment_input" name="adjustment_value" id="adjustment_input" value="0.00">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Markup</td>
                                                <td></td>
                                                <td align="right">0.00<input type="hidden" name="markup" id="markup_input_form" class="markup_input" value="0"></td>
                                            </tr>
                                            <tr>
                                                <td><b>Grand Total ($)</b></td>
                                                <td></td>
                                                <td align="right"><b><span id="grand_total">0.00</span></b><input type="hidden" name="grandtotal" id="grand_total_input" value='0'></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-content">
                                <div class="row">
                                <!-- <div class="form-group col-md-12"> -->
                                    <div class="col-md-4">
                                        <b>Sales Representative Name</b>
                                        <input type="text" name="sales_rep_view" class="form-control" value="<?php echo logged('FName').' '.logged('LName'); ?>">
                                        <input type="hidden" name="sales_rep" class="form-control" value="<?php echo logged('id'); ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <b>Mobile Number</b>
                                        <input type="text" name="sales_rep_no" class="form-control" value="<?php echo logged('mobile'); ?>" placeholder="Enter Cellphone Number">
                                    </div>                       
                                    <div class="col-md-4">
                                        <b>Team Leader / Mentor</b>
                                        <input type="text" name="tl_mentor" class="form-control" placeholder="Enter Team Leader/Mentor">
                                    </div>                                        
                                </div>
                                <div class="row" style="background-color:white;">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><h6><b>Instructions / Notes </b><span style="margin-left:10px;" class="bx bxs-help-circle" id="help-popover-instructions"></span></h6></label>   
                                            <textarea name="instructions" cols="40" rows="2" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label><h6><b>Message to Customer</b><span style="margin-left:10px;" class="bx bxs-help-circle" id="help-popover-message-to-customer"></span></h6></label>
                                            <textarea name="message" cols="40" rows="4" class="form-control">I would be happy to have an opportunity to work with you.</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                        <label><h6><b>Terms &amp; Conditions</b><span style="margin-left:10px;" class="bx bxs-help-circle" id="help-popover-terms-conditions"></span></h6></label>
                                            <textarea name="terms_conditions" cols="40" rows="4" class="form-control">YOU EXPRESSLY AUTHORIZE ADI AND ITS AFFILIATES TO RECEIVE PAYMENT FOR THE LISTED SERVICES ABOVE. BY SIGNING BELOW BUYER AGREES TO THE TERMS OF YOUR SERVICE AGREEMENT AND ACKNOWLEDGES RECEIPT OF A COPY OF THIS SERVICE AGREEMENT.</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="background-color:white;">
                                    <div class="col-md-6">
                                        <label for="billing_date"><h6>Attachments <span style="margin-left:10px;" class="bx bxs-help-circle" id="help-popover-attachment"></span></h6></label>
                                        <input type="file" name="attachments" id="attachments"
                                                class="form-control"/>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <div class="form-check float-start">
                                            <input type="hidden" name="SEND_EMAIL_ON_SCHEDULE" value="false">
                                            <input class="form-check-input" id="SEND_EMAIL_ON_SCHEDULE" type="checkbox">
                                            <label class="form-check-label" for="SEND_EMAIL_ON_SCHEDULE">Send an email after scheduling this service ticket.</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <button type="submit" value="Scheduled" class="nsm-button primary" name="action"><i class="bx bx-fw bx-calendar-plus"></i> Schedule</button>
                                        <!-- <button name="action" value="Draft" type="submit"  class="btn btn-light but" style="border-radius: 0 !important;border:solid gray 1px;">Save</button>
                                        <button name="action" value="Scheduled" type="submit"  class="nsm-button primary but" style="border-radius: 0 !important;">Schedule</button> -->
                                        <a href="<?php echo url('customer/tickets') ?>" class="nsm-button default" style="padding: 9px;">Cancel</a>
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

                                <!-- Modal Additional Contact -->
                                <div class="modal fade" id="modalAdditionalContacts" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Contact</h5>
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

                                <!-- Modal Additional addServiceType -->
                                <div class="modal fade" id="addServiceType" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Service Type</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Service Name
                                                <input type="text" class="form-control" name="addServiceTypevalue" id="addServiceTypevalue" />
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary saveServiceType">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="modalAddNewSource" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add New Service Address</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="frm_add_new_source" name="modal-form" method="post">
                                                    <div class="validation-error" style="display: none;"></div>
                                                    <div class="form-group">
                                                        <label>Source Name</label> <span class="form-required">*</span>
                                                        <input type="text" name="source_name" value="" class="form-control"
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

                                
                                <!-- Modal add/update header -->
                                <div class="modal fade" id="updateHeaderModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update Header</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Content <br>
                                                <textarea class="form-control headereditor" id="" rows="10"><?php if($headers){ echo $headers->content; ?><?php }else{ ?>Creating and Copying Customer Service Tickets in the Customer Service module (CRM) are used to track customer service issues. Service Tickets can be created from any Service Ticket Workbench or via the Service folder under Sales Category. User can simply create on the Customer Account or directly from the calendar. To save time Service Tickets can now also be created via a copy or from the Customer Items Owned screen.<?php } ?></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <?php if($headers){ ?>
                                                    <button type="button" class="btn btn-danger updateHeaderSave">Update changes</button>
                                                <?php }else{ ?>
                                                    <button type="button" class="btn btn-success saveHeader">Save changes</button>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo form_close(); ?>
        <div class="modal fade" id="quick-add-item" tabindex="-1"  aria-labelledby="quickAddServiceTicketLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content" style="width:700px !important;">
                    <div class="modal-header">
                        <span class="modal-title content-title" style="font-size: 17px;">Items List</span>
                        <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
                    </div>
                    <div class="modal-body">
                            <div class="row">
                                <div class="col-12 col-md-12 grid-mb">
                                    <div class="nsm-field-group search">
                                        <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" for="quick-add-items-list" placeholder="Search List">
                                    </div>
                                </div>
                            </div>
                            <div class="row">                        
                                <div class="col-sm-12">
                                    <table id="quick-add-items-list" class="nsm-table">
                                        <thead>
                                        <tr>
                                            <td class="show" data-name="Add" style="width: 5% !important;"></td>
                                            <td class="show" data-name="Name"><strong>Name</strong></td>
                                            <td class="show" data-name="Type"><strong>Type</strong></td>
                                            <td class="show" data-name="Qty"><strong>Stock</strong></td>
                                            <td class="show" data-name="Price" style="text-align:right;"><strong>Price</strong></td>                                   
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($items as $item){ ?>
                                            <?php $item_qty = get_total_item_qty($item->id); ?>
                                            <?php //if ($item_qty[0]->total_qty > 0) { ?>
                                                <tr id="<?php echo "ITEMLIST_PRODUCT_$item->id"; ?>">
                                                    <td class="nsm-text-primary show">
                                                        <button type="button"  data-bs-dismiss="modal" class='nsm nsm-button default select_item' id="<?= $item->id; ?>" data-item_type="<?= ucfirst($item->type); ?>" data-quantity="1" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>"><i class='bx bx-plus-medical'></i></button>
                                                    </td>
                                                    <td class="nsm-text-primary show"><?php echo $item->title; ?></td>
                                                    <td class="nsm-text-primary show"><?php echo $item->type; ?></td>
                                                    <td class="show"><?php echo $item_qty[0]->total_qty > 0 ? $item_qty[0]->total_qty : "0"; ?></td>
                                                    <td class="show" style="text-align:right;"><?php echo $item->price; ?></td>                                            
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

        <div class="modal fade nsm-modal fade" id="modal-quick-add-panel-type" tabindex="-1" aria-labelledby="modal-quick-add-panel-type-label" aria-hidden="true">
            <div class="modal-dialog modal-md" style="margin-top:13%;">
                <form id="quick-add-panel-type-form" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title"> Quick Add : Panel Type</span>
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
                            <span class="modal-title content-title"> Quick Add : Plan Type</span>
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

        <?php //echo $file_selection; ?>
        <!-- Modal Additional addServiceType -->
        <div class="modal fade nsm-modal fade" id="modal-quick-add-service-type" tabindex="-1" aria-labelledby="modal-quick-add-service-type-label" aria-hidden="true">
            <div class="modal-dialog modal-md" style="margin-top:13%;">
                <form id="quick-add-service-type-form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title"> Quick Add : Service Type</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="row" style="margin-top:0px;">
                                <div class="col-md-12">
                                    <label for="name"><span class="text-danger">*</span> Service Name</label>
                                    <input type="text" class="form-control" name="addServiceTypevalue" id="addServiceTypevalue" required="" />
                                </div>
                            </div> 
                        </div>
                        <div class="modal-footer">                    
                            <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="nsm-button primary btn-create-service-type">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div> 

<?php //echo $file_selection; ?>
<?php include viewPath('v2/includes/customer/quick_add_customer'); ?>
<?php include viewPath('v2/includes/customer/other_address'); ?>
<script src="<?php echo $url->assets ?>dashboard/js/bootstrap.bundle.min.js"></script>

<?php include viewPath('v2/includes/footer'); ?>
<script>
    $('#SEND_EMAIL_ON_SCHEDULE').on('change', function(event) {
        event.preventDefault();
        if ($('#SEND_EMAIL_ON_SCHEDULE').prop('checked') == true) {
            $('input[name="SEND_EMAIL_ON_SCHEDULE"]').val('true');
        } else {
            $('input[name="SEND_EMAIL_ON_SCHEDULE"]').val('false');
        }
    });

    $('#employee_id').select2({});
    
    $('#sel-customer_t').select2({         
        ajax: {
            url: base_url + 'autocomplete/_company_customer',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;
                return {
                    results: data,
                };
            },
            cache: true
        },
        placeholder: 'Select Customer',        
        minimumInputLength: 0,
        templateResult: formatRepoCustomer,
        templateSelection: formatRepoCustomerSelection
    });

    function formatRepoCustomer(repo) {
        if (repo.loading) {
            return repo.text;
        }

        var $container = $(
            '<div>' + repo.first_name + ' ' + repo.last_name + '<br /><small>' + repo.address + ' / ' + repo.email + '</small></div>'
        );

        return $container;
    }

    function formatRepoCustomerSelection(repo) {
        if (repo.first_name != null) {
            return repo.first_name + ' ' + repo.last_name;
        } else {
            return repo.text;
        }
    }

    $('#appointment-user').select2({
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
            dropdownParent: $("#technicianDiv"),
            placeholder: 'Select User',
            minimumInputLength: 0,
            templateResult: formatRepoUser,
            templateSelection: formatRepoSelectionUser
        });

        
    function formatRepoUser(repo) {
        if (repo.loading) {
            return repo.text;
        }

        var $container = $(
            '<div><div class="autocomplete-left"><img class="autocomplete-img" src="' + repo.user_image + '" /></div><div class="autocomplete-right">' + repo.FName + ' ' + repo.LName + '<br /><small>' + repo.email + '</small></div></div>'
        );

        return $container;
    }

    
    function formatRepoSelectionUser(repo) {
        return (repo.FName) ? repo.FName + ' ' + repo.LName : repo.text;
    }
</script>
<script>
    function validatecard() {
        var inputtxt = $('.card-number').val();

        if (inputtxt == 4242424242424242) {
            $('.require-validation').submit();
        } else {
            alert("Not a valid card number!");
            return false;
        }
    }


    $(document).ready(function () {
        $('#sel-customer').select2();
        var customer_id = "<?php echo isset($_GET['customer_id']) ? $_GET['customer_id'] : '' ?>";
    });
</script>
<script type="module"  src="<?= base_url("assets/js/customer/dashboard/index.js") ?>"></script>

<script>
$(document).on('change', '#adjustment_ic, #otps, #adjustment_mm, #adjustment_input', function(){
    var adjustmentIdSelectors = ["adjustment_ic","otps","adjustment_mm", "adjustment_input"];
    var total_adjustment_selectors = 0;
    adjustmentIdSelectors.forEach(selector => {
        var $element = document.getElementById(selector);
        if ($element) {
            total_adjustment_selectors = parseFloat(total_adjustment_selectors) + parseFloat($element.value);                
        }
    });
    var item_total = $('#item_total').val();
    var tax_total  = $('#total_tax_input').val();
    var new_grand_total = total_adjustment_selectors + parseFloat(item_total) + parseFloat(tax_total);
    $('#grand_total_input').val(new_grand_total.toFixed(2));
    $('#grand_total').text(new_grand_total.toFixed(2));

});
document.getElementById("payment_method").onchange = function() {
    if (this.value == 'Cash') {
        // alert('cash');
		// $('#exampleModal').modal('toggle');
        $('#cash_area').show();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#invoicing').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    	}
    else if(this.value == 'Invoicing'){

        $('#cash_area').hide();
        $('#check_area').hide();
        $('#invoicing').show();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
	
    else if(this.value == 'Check'){
        // alert('Check');
        $('#cash_area').hide();
        $('#check_area').show();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'Credit Card'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').show();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'Debit Card'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').show();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#invoicing').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'ACH'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').show();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'Venmo'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#ach_area').hide();
        $('#invoicing').hide();
        $('#venmo_area').show();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'Paypal'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').show();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'Square'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#invoicing').hide();
        $('#debit_card').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').show();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'Warranty Work'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#invoicing').hide();
        $('#debit_card').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').show();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'Home Owner Financing'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').show();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'e-Transfer'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').show();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'Other Credit Card Professor'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').show();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'Other Payment Type'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').show();
    }
}
</script>
<script>
    
    $(".saveServiceType").on("click", function(e) {
            let service_name = $("#addServiceTypevalue").val();
            var $select = $('#service_type');

            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('tickets/saveServiceType'); ?>",
                data: {
                    service_name: service_name
                },
                dataType: 'json',
                success: function(response) {
                    location.reload();
                    $('#addServiceType').modal('hide');
                    $select.selectmenu("refresh", true);
                }
            });
        });
</script>

<script>
    
$(document).ready(function(){

    $(document).on('click', '.btn-use-other-address', function(){
        let prof_id = $(this).attr('data-id');
        let mail_add = $(this).attr('data-mailadd');
        let city = $(this).attr('data-city');
        let state = $(this).attr('data-state');
        let zip   = $(this).attr('data-zip');
        let other_address = $(this).attr('data-address');
        
        $('#other-address-customer').modal('hide');        
        $('#service_location').val(other_address);
        $('#customer_address').val(mail_add);
        $('#customer_city').val(city);
        $('#customer_state').val(state);
        $('#customer_zip').val(zip);

        let map_source = 'http://maps.google.com/maps?q='+other_address+'&output=embed';
        let map_iframe = '<iframe id="TEMPORARY_MAP_VIEW" src="'+map_source+'" height="300" width="100%" style=""></iframe>';
        $('.MAP_LOADER').hide().html(map_iframe).fadeIn('slow');

        $('.btn-use-different-address').popover({
            placement: 'top',
            html : true, 
            trigger: "hover focus",
            content: function() {
                return 'Use other address';
            } 
        }); 
    });

    $("#quick-add-items-list").nsmPagination({itemsPerPage:10});
    $("#search_field").on("input", debounce(function() {
        tableSearch($(this));        
    }, 1000));

    $('#btn-quick-add-plan-type').on('click', function(){
        $('#plan-type-name').val('');
        $('#modal-quick-add-plan-type').modal('show');
    });

    $('#btn-quick-add-panel-type').on('click', function(){
        $('#panel-type-name').val('');
        $('#modal-quick-add-panel-type').modal('show');
    });

    $('#btn-quick-add-service-type').on('click', function(){
        $('#modal-quick-add-service-type').modal('show');
    });

    $('#btn-add-new-customer').on('click', function(){
        $('#target-id-dropdown').val('sel-customer_t');
        $('#origin-modal-id').val('');
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

    $('#add_another_items').on('click', function(){
        $('#quick-add-item').modal('show');
    });

    $('#quick-add-panel-type-form').on('submit', function(e){
        e.preventDefault();
        var url = base_url + 'tickets/_create_panel_type';

        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: $('#quick-add-panel-type-form').serialize(),
            success: function(data) {    
                $('#btn-quick-add-panel-type-submit').html('Save');                   
                if (data.is_success) {
                    $('#modal-quick-add-panel-type').modal('hide');
                    var panel_type_name = $('#panel-type-name').val();
                    $('#panel_type').append($('<option>', {
                        value: panel_type_name,
                        text: panel_type_name
                    }));
                    $('#panel_type').val(panel_type_name);
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: data.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }
            },
            beforeSend: function() {
                $('#btn-quick-add-panel-type-submit').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#quick-add-plan-type-form').on('submit', function(e){
        e.preventDefault();
        var url = base_url + 'tickets/_create_plan_type';

        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: $('#quick-add-plan-type-form').serialize(),
            success: function(data) {    
                $('#btn-quick-add-plan-type-submit').html('Save');                   
                if (data.is_success) {
                    $('#modal-quick-add-plan-type').modal('hide');
                    var plan_type_name = $('#plan-type-name').val();
                    $('#plan_type').append($('<option>', {
                        value: plan_type_name,
                        text: plan_type_name
                    }));
                    $('#plan_type').val(plan_type_name);
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: data.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }
            },
            beforeSend: function() {
                $('#btn-quick-add-plan-type-submit').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#quick-add-service-type-form').on('submit',function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + "ticket/_create_service_type",
            dataType: 'json',
            data: $('#quick-add-service-type-form').serialize(),
            success: function(data) {    
                $('.btn-create-service-type').html('Save');                   
                if (data.is_success) {
                    $('#modal-quick-add-service-type').modal('hide');
                    $('#service_type').append( new Option(data.service_type,data.service_type) );    
                    $('#service_type').val(data.service_type);                 
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: data.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }
            },
            beforeSend: function() {
                $('.btn-create-service-type').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#modal-help-popover-adjustment').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'Optional it allows you to adjust the total amount Eg. +10 or -10.';
        }
    });

    $('#help-popover-message-to-customer').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Add a message that will be displayed on the Ticket.';
        } 
    });

    $('#help-popover-terms-conditions').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return "Mention your company's T&amp;C that will appear on the Ticket.";
        } 
    });

    $('#help-popover-instructions').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return "Optional internal notes, will not appear to customer";
        } 
    });

    $('#help-popover-attachment').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return "Optional attach files to this invoice. Allowed type: pdf, doc, dock, png, jpg, gif";
        } 
    });   

    $('#sel-customer_t').change(function(){
        var id  = $(this).val();
        $.ajax({
            type: 'POST',
            url: base_url + "ticket/_get_customer_basic_information",
            data: {id : id },
            dataType: 'json',
            success: function(response){            
                var phone = response.phone_h;
                var mobile = response.phone_m;
                var service_location = response.mail_add + ' ' + response.city + ', ' + response.state + ' ' + response.zip_code;
                $("#service_location").val(service_location);
                $("#customer_address").val(response.mail_add);
                $("#customer_city").val(response.city);
                $("#customer_state").val(response.state);
                $("#customer_zip").val(response.zip_code);
                $("#customer_phone").val(response.phone_m);
                $("#business_name").val(response.business_name);

                var map_source = 'http://maps.google.com/maps?q=' + service_location +
                            '&output=embed';
                var map_iframe = '<iframe id="TEMPORARY_MAP_VIEW" src="' + map_source +
                    '" height="370" width="100%" style=""></iframe>';
                $('.MAP_LOADER').hide().html(map_iframe).fadeIn('slow');

                $('#btn-use-different-address').attr('data-id', id);
                $('#btn-use-different-address').show();
        
            },error: function(response){
        
            }
        });
    });

    $("#new_customer_form").submit(function(e) {    
        e.preventDefault(); 
        var form = $(this);        
        $.ajax({
            type: "POST",
            url: base_url + "/customer/add_new_customer_from_jobs",
            data: form.serialize(), 
            success: function(data)
            {
                $('#new_customer').modal('hide');
                if(data === "Success"){
                    Swal.fire({                        
                        text: "Customer added successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            
                        //}
                    });                     
                }else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Cannot add data.',
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    });
                }
            }
        });
    });

    <?php if( $default_customer_id > 0 ){ ?>
        $('#sel-customer_t').click();
        load_customer_data('<?= $default_customer_id; ?>');
    <?php } ?>

    function load_customer_data(customer_id){
        $.ajax({
            type: "POST",
            url: base_url + 'customer/_get_customer_data',
            data: {customer_id:customer_id},
            dataType:'json',
            beforeSend: function(response) {
                
            },
            success: function(response) {
                var customer_business_name = response.business_name;
                var customer_name = response.first_name + ' ' + response.last_name;
                var customer_email = response.email;
                var customer_phone = response.phone_h;
                var customer_mobile = response.phone_m;
                var customer_address = response.mail_add;
                var service_location = response.mail_add + ' ' + response.city + ', ' + response.state + ' ' + response.zip_code; 

                if( customer_business_name == '' ){
                    customer_business_name = 'Not Specified';
                }                

                if( customer_email == '' ){
                    customer_email = 'Not Specified';
                }

                if( customer_phone == '' ){
                    customer_phone = 'Not Specified';
                }

                if( customer_mobile == '' ){
                    customer_mobile = 'Not Specified';
                }

                var customer_zip_code = response.zip_code;
                if( response.zip_code == '' ){
                    customer_zip_code = 'Not Specified';
                }

                var customer_state = response.state;
                if( response.state == '' ){
                    customer_state = 'Not Specified';
                }

                var customer_city = response.city;
                if( response.city == '' ){
                    customer_city = 'Not Specified';
                }
                
                $('#business_name').val(customer_business_name);
                $('#customer_mobile').val(customer_mobile);
                $('#customer_phone').val(customer_phone);
                $('#customer_zip').val(response.zip_code)
                $('#customer_state').val(customer_state);
                $('#customer_city').val(customer_city);
                $('#customer_address').val(customer_address);               
                $('#service_location').val(service_location);

                var map_source = 'http://maps.google.com/maps?q=' + service_location +
                            '&output=embed';
                var map_iframe = '<iframe id="TEMPORARY_MAP_VIEW" src="' + map_source +
                    '" height="370" width="100%" style=""></iframe>';
                $('.MAP_LOADER').hide().html(map_iframe).fadeIn('slow');
            },
            error: function(e) {
                
            }
        });
    }

    $('#chk-tax-exempted').on('change', function(){
        var counter = $("#count").val();
        calculation(counter);
    });

    $('#adjustment_ic, #otps, #adjustment_mm').on('change', function(){
        var counter = $("#count").val();
        calculation(counter);
    });
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css" rel="stylesheet" />
<script>
    
$('#modal_items_list').DataTable({
    "autoWidth" : false,
    "columnDefs": [
    { width: 540, targets: 0 },
    { width: 100, targets: 0 },
    { width: 100, targets: 0 }
    ],
    "ordering": false,
});
</script>
<script>

$(".updateHeader").on("click", function(e) {
    // alert('test');
    $('#updateHeaderModal').modal('show');
});


$(".saveHeader").on("click", function(e) {
    // alert('test');
    var content = $('.headereditor').val();
    // alert(content);
    
    $.ajax({
         type: 'POST',
         url:"<?php echo base_url(); ?>tickets/saveTickets",
         data: {content : content },
         dataType: 'json',
         success: function(response){
            $('#updateHeaderModal').modal('hide');
            $("#updateHeaderDiv").load(location.href + " #updateHeaderDiv");
         },
             error: function(response){
             //alert('Error'+response);
    
             }
     });
});

$(".updateHeaderSave").on("click", function(e) {
    // alert('test');
    var content = $(".headereditor").val();
    // alert(content);
    
    $.ajax({
         type: 'POST',
         url:"<?php echo base_url(); ?>tickets/updateHeader",
         data: {content : content },
         dataType: 'json',
         success: function(response){
            $('#updateHeaderModal').modal('hide');
            $("#updateHeaderDiv").load(location.href + " #updateHeaderDiv");
         },
             error: function(response){
             //alert('Error'+response);
    
             }
     });
});
</script>

<script>
// jQuery(document).ready(function () {
//     $(document).on('click','#customer_type',function(){
//         var values = $(this).val();
//         alert(values);
//     });
    $(document).on('click','.customer_type',function(){
        // alert('test');
        if ($('input[name=customer_type]:checked').val() == "Commercial") {
            // alert('test');
            $('#business_name_area').show();

        } else {
            $('#business_name_area').hide();

        }
    });
// });
</script> 
<script>
    $(".select_item2a").click(function () {
            var idd = this.id;
            var title = $(this).data('itemname');
            var price = parseInt($(this).attr('data-price'));
            // var qty = parseInt($(this).attr('data-quantity'));
            var location_name = $(this).data('location_name');
            var location_id = $(this).data('location_id');
            var item_type = $(this).data('item_type');
            // var total_ = price * qty;
            // var total_ = 0;
            // var total_price = price + total_;
            // var total = parseFloat(total_price).toFixed(2);
            // var withCommas = Number(total).toLocaleString('en');
            if(!$(this).data('quantity')){
              // alert($(this).data('quantity'));
              var qty = 1;
            }else{
              // alert('0');
              var qty = $(this).data('data-quantity');
            }

            var count = parseInt($("#count").val()) + 1;
            $("#count").val(count);
            var total_ = price * qty;
            var tax_ =(parseFloat(total_).toFixed(2) * 7.5) / 100;
            var taxes_t = parseFloat(tax_).toFixed(2);
            var total = parseFloat(total_).toFixed(2);
            var withCommas = Number(total).toLocaleString('en');
            total = '$' + withCommas + '.00';
            $("#ITEMLIST_PRODUCT_"+idd).hide();
            // markup = "<tr id='ss'>" +
            //     "<td width='35%'><small>Item name</small><input readonly value='"+title+"' type='text' name='item_name[]' class='form-control' ><input type='hidden' value='"+idd+"' name='item_id[]'></td>" +
            //     "<td><small>Qty</small><input data-itemid='"+idd+"' id='"+idd+"' value='1' type='number' name='item_qty[]' class='form-control item-qty-"+idd+" qty' min='0'></td>" +
            //     "<td><small>Unit Price</small><input data-id='"+idd+"' id='price"+idd+"' value='"+price+"'  type='number' name='item_price[]' class='form-control item-price' step='any' placeholder='Unit Price'></td>" +
            //     "<td><small>Item Type</small><input readonly type='text' class='form-control' value='"+item_type+"'></td>" +
            //     // "<td width='25%'><small>Inventory Location</small><input type='text' name='item_loc[]' class='form-control'></td>" +
            //     "<td><small>Amount</small><br><b data-subtotal='"+total_price+"' id='sub_total"+idd+"' class='total_per_item'>$"+total+"</b></td>" +
            //     "<td><button type='button' class='nsm-button items_remove_btn remove_item_row mt-2' onclick='$(`#ITEMLIST_PRODUCT_"+idd+"`).show();'><i class='bx bx-trash'></i></button></td>" +
            //     "</tr>";
            markup = "<tr id=\"ss\">" +
                "<td width=\"35%\"><input value='"+title+"' type=\"text\" name=\"items[]\" class=\"form-control getItems\" ><input type=\"hidden\" value='"+idd+"' name=\"item_id[]\"><div class=\"show_mobile_view\"></div><input type=\"hidden\" name=\"itemid[]\" id=\"itemid\" class=\"itemid\" value='"+idd+"'><input type=\"hidden\" name=\"packageID[]\" value=\"0\"></td>\n" +
                "<td width=\"20%\"><div class=\"dropdown-wrapper\"><select name=\"item_type[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></div></td>\n" +
                "<td width=\"10%\"><input data-itemid='"+idd+"' id='quantity_"+count+"' value='"+qty+"' type=\"number\" name=\"quantity[]\" data-counter='"+count+"'  min=\"0\" class=\"form-control quantity mobile_qty \"></td>\n" +
                // "<td>\n" + '<input type="number" class="form-control qtyest" name="quantity[]" data-counter="' + count + '" id="quantity_' + count + '" min="1" value="1">\n' + "</td>\n" +
                "<td width=\"10%\"><input data-itemid='"+idd+"' id='price_"+count+"' value='"+price+"'  type=\"text\" name=\"price[]\" data-counter='"+count+"' class=\"form-control price hidden_mobile_view\" placeholder=\"Unit Price\"><input type=\"hidden\" class=\"priceqty\" id='priceqty_"+idd+"'><div class=\"show_mobile_view\"><span class=\"price\">"+price+"</span></div></td>\n" +
                // "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter="0" id=\"discount_0\" min="0" value="0" ></td>\n" +
                // "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
                "<td width=\"10%\" class=\"hidden_mobile_view\"><input type=\"number\" name=\"discount[]\" value=\"0\" class=\"form-control discount\" data-counter='"+count+"' id='discount_"+count+"'></td>\n" +
                // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
                "<td width=\"20%\" class=\"hidden_mobile_view\"><input type=\"text\" data-itemid='"+idd+"' class=\"form-control tax_change\" name=\"tax[]\" data-counter='"+count+"' id='tax1_"+count+"' readonly min=\"0\" value='"+taxes_t+"'></td>\n" +
                "<td style=\"text-align: center\" class=\"hidden_mobile_view\" width=\"15%\"><span data-subtotal='"+total_+"' id='span_total_"+count+"' class=\"total_per_item\">"+total+
                // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
                "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text"+count+"' value='"+total+"'></td>" +
                "<td>\n" +
                "<a href=\"#\" class=\"remove nsm-button danger\" id='"+idd+"'><i class=\"bx bx-fw bx-trash\"></i></a>\n" +
                "</td>\n" +
                "</tr>";
            tableBody = $("#jobs_items_table_body");
            tableBody.append(markup);
            // markup2 = "<tr id=\"sss\">" +
            //     "<td >"+title+"</td>\n" +
            //     "<td >0</td>\n" +
            //     "<td >"+price+"</td>\n" +
            //     "<td id='device_qty"+idd+"'>"+qty+"</td>\n" +
            //     "<td id='device_sub_total"+idd+"'>"+total+"</td>\n" +
            //     "<td ></td>\n" +
            //     "<td ><a href=\"#\" data-name='"+title+"' data-price='"+price+"' data-quantity='"+qty+"' id='"+idd+"' class=\"edit_item_list\"><span class=\"fa fa-edit\"></span></a> </td>\n" + // <a href="javascript:void(0)" class="remove_audit_item_row"><span class="fa fa-trash"></span></i></a>
            //     "</tr>";
            markup2 = "<td></td>" +
                      "<td></td>" +
                      "<td></td>" +
                      "<td></td>" +
                      "<td></td>" +
                      "<td></td>" +
                      "<td></td>" +
                      "<td></td>";

            //device audit
            markup3 ="<tr id='ss'>" +
                "<td>" + title + "</td>" +
                "<td>" + item_type + "</td>" +
                "<td></td>" +
                "<td>" + price + "</td>" +
                "<td id='device_qty"+idd+"'>"+ qty + "</td>" +
                "<td id='device_sub_total"+idd+"'>" + total + "</td>" +
                "<td>" +
                "<input hidden name='item_id1[]' value='"+ idd +"'>" +
                "<input hidden name='location_qty[]' id='location_qty"+idd+"' value='"+ qty +"'>" +
                "<select id='location"+idd+"' name='location[]' class='form-control location'>" +
                "<option>Select Location</option>" +
                "<option value='" +location_id+ "' selected>" +location_name+ "</option>" +
                "<?php 
                    if ($getAllLocation) { 
                        foreach ($getAllLocation as $getAllLocations) {
                            if ($getAllLocations->default == "true") {
                                echo "<option selected value='$getAllLocations->loc_id'>$getAllLocations->location_name</option>";
                            } else {
                                echo "<option value='$getAllLocations->loc_id'>$getAllLocations->location_name</option>";
                            }
                        } 
                    } 
                ?>" +
                "</select>" +
                "</td>";

            tableBody3 = $("#device_audit_append");
            tableBody3.append(markup3);
            calculation(count);


            tableBody2 = $("#device_audit_datas");
            tableBody2.append(markup2);
            //calculate_subtotal();
            $(".location").select2({
                placeholder: "Choose Location"
            });
        });

        async function getLoc(id, qty) {
            var postData = new FormData();
            postData.append('id', id);
            postData.append('qty', qty);
            fetch('<?= base_url('job/getItemLocation') ?>',{
                method: 'POST',
                body: postData
            }).then(response => response.json()).then(response => {
                var { locations } = response;
                var select = document.querySelector('#location'+id);
                const locations_len = Object.keys(locations);
                // Avoid TypeError: Cannot set properties of null (setting 'innerHTML')
                if (select === null) return;
                console.log(locations);
                select.innerHTML = '';
                // Loop through each location and append a new option element to the select
                if(locations_len.length > 1){
                    var options = document.createElement('option');
                    options.text = "Select Location";
                    options.value = "0";
                    select.appendChild(options);
                }
                

                // Get all the location name promises
                var promises = locations.map(function(location) {
                    return getLocName(location.loc_id);
                });

                // Wait for all the promises to resolve
                Promise.all(promises).then(function(names) {
                    // Loop through each location and append a new option element to the select
                    locations.forEach(function(location, index) {
                        var option = document.createElement('option');
                        option.text = names[index];
                        option.value = location.id;
                        select.appendChild(option);
                    }); 
                });
            }).catch((error) =>{
                console.log(error);
            })
        }

        function getLocName(id){
            var postData = new FormData();
            postData.append('id', id);
            return fetch('<?= base_url('inventory/getLocationNameById') ?>',{
                method: 'POST',
                body: postData
            }).then(response => response.json()).then(response => {
                var { location } = response;
                return location.location_name;
            }).catch((error) =>{
                console.log(error);
            })
        }
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