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
.custom-ticket-header{
    background-color: #6a4a86;
    color: #ffffff;
    font-size: 15px;
    padding: 10px;
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
#jobs_items_table_body i{
    position: relative;
    top: 0px;
    left: 2px;
}
#jobs_items_table_body .nsm-button{
    margin: 0 auto;
    display: block;
    padding: 4px;
}
.span-input{
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
    text-align:right;
    background-color:#E9ECEF;
}
.tax_change, .discount, .price {
    text-align:right;
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
#jobs_items_table_body .remove i{
    position: relative;
    top: 1px;
    left: 7px;
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo base_url('customer/addTicket') ?>'">
        <i class="bx bx-note"></i>
    </div>
</div>
<input type="hidden" id="siteurl" value="<?=base_url();?>">
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/service_tickets_tabs'); ?>
    </div>
    
    <input type="hidden" id="siteurl" value="<?=base_url();?>">
    <?php echo form_open_multipart('tickets/saveUpdateTicket', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?> 
    <input type="hidden" name="ticketID" value="<?php echo $tickets->id; ?>">
    <input type="hidden" name="invoiceID" value="<?php echo $invoicePayment ? $invoicePayment->invoice_id : '0'; ?>">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Creating and Copying Customer Service Tickets in the  Customer Service module (CRM) are used to track customer service issues.  Service Tickets can be created from any Service Ticket Workbench or via the Service folder under Sales Category.  User can simply create on the Customer Account or directly from the calendar.  To save time Service Tickets can now also be created via a copy or from the Customer Items Owned screen. 
                        </div>
                    </div>
                </div>
                <input type="hidden" id="redirect-calendar" name="redirect_calendar" value="<?= $redirect_calendar; ?>">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="nsm-card primary">
                                <div class="nsm-card-content">
                                    <label for="customers" class="required"><b>Customer</b></label>
                                    <a class="link-modal-open nsm-button btn-small" href="<?= base_url('customer/add_advance'); ?>" style="float:right;">Add New</a>
                                    <select id="sel-customer_t" name="customer_id" data-customer-source="dropdown" required="" class="form-control searchable-dropdown" placeholder="Select">
                                        <option value="">- Select Customer -</option>
                                        <?php foreach($customers as $c){ ?>
                                            <?php $default_customer_id = $tickets->customer_id;
                                                //if( $default_customer_id > 0 ){ ?>
                                                <option <?= $default_customer_id == $c->prof_id ? 'selected="selected"' : ''; ?> value="<?= $c->prof_id; ?>"><?= $c->first_name . ' ' . $c->last_name; ?></option>
                                            <?php //}else{ ?>
                                                <!-- <option value="</option> -->
                                            <?php //} ?>                                            
                                        <?php } ?>
                                    </select>
                                    <div class="row">
                                        <div class="col-md-6" style="display: ;">
                                            <label for="customer_phone" class="required"><b>Mobile Number</b></label>
                                            <input type="text" class="form-control phone_number" placeholder="xxx-xxx-xxxx" name="customer_phone" id="customer_phone" required  value="<?php echo $tickets->customer_phone; ?>"/>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="business_name"><b>Business Name</b> (optional)</label>
                                            <input type="text" class="form-control" name="business_name" id="business_name" placeholder="Business Name" value="<?php echo $tickets->business_name; ?>"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12"> 
                                            <label for="job-tag"><b>Service Tag</b></label>
                                            <a class="nsm-button btn-small" style="float:right;" target="_new" href="<?= base_url('job/job_tags'); ?>">Manage Tag</a>
                                            <select class="form-control" name="job_tag" id="job-tag">
                                                <?php foreach($tags as $t){ ?>
                                                    <option value="<?= $t->name; ?>" <?php if($t->name == $tickets->job_tag){ echo 'selected'; } ?>><?= $t->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-12 mt-4">
                                            <label for="job_name"><b>Service description</b> (optional)</label>                                            
                                            <textarea class="form-control" name="service_description"><?php echo $tickets->service_description; ?></textarea>
                                        </div>
                                        <div class="col-md-12 mt-4">
                                            <label for="job_location" class="required"><b>Service Location</b></label>
                                            <input type="text" class="form-control" name="service_location" id="service_location"
                                            required placeholder="Enter Location"
                                            onChange="jQuery('#customer_name').text(jQuery(this).val());" value="<?php echo $tickets->service_location; ?>"/>
                                        </div>
                                        <div class="row"> 
                                            <div class="col-md-4">
                                                <label for="job_location" class="required"><b>City</b></label>
                                                <input type="text" class="form-control" name="customer_city" id="customer_city"
                                                        required placeholder="Enter City" 
                                                        onChange="jQuery('#customer_name').text(jQuery(this).val());" value="<?php echo $tickets->acs_city; ?>"/>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="job_location" class="required"><b>State</b></label>
                                                <input type="text" class="form-control" name="customer_state" id="customer_state"
                                                        required placeholder="Enter State" 
                                                        onChange="jQuery('#customer_name').text(jQuery(this).val());" value="<?php echo $tickets->acs_state; ?>"/>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="job_location" class="required"><b>Zip Code</b></label>
                                                <input type="text" class="form-control" name="customer_zip" id="customer_zip"
                                                        required placeholder="Enter Zip Code" 
                                                        onChange="jQuery('#customer_name').text(jQuery(this).val());" value="<?php echo $tickets->acs_zip; ?>"/>
                                            </div>
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
                                        <label for="estimate_date" class="required"><b>Service Ticket No.</b></label>
                                        <input type="text" class="form-control" name="ticket_no" id="ticket_no"
                                                required placeholder="Enter Ticket#" autofocus value="<?php echo $tickets->ticket_no; ?>" readonly/>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="estimate_date" class="required"><b>Schedule Date</b></label>
                                        <!-- <input type="text" class="form-control" name="estimate_date" id="estimate_date" required placeholder="Enter Estimate Date" autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());" /> -->
                                        <!-- <div class="input-group date" data-provide="datepicker"> -->
                                            <input type="date" class="form-control" value="<?php echo date("Y-m-d",strtotime($tickets->ticket_date)); ?>" name="ticket_date" id="ticket_date"
                                                    placeholder="Enter Ticket Date" required>
                                            <!-- <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-th"></span>
                                            </div> -->
                                        <!-- </div> -->
                                    </div>
                                    <div class="col-md-3">
                                        <label for="expiry_date" class="required"><b>Schedule Time From</b></label>
                                        <select id="scheduled_time" name="scheduled_time" class="nsm-field form-select" required>
                                            <option value="">From</option>
                                            <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                                <option <?= $tickets->scheduled_time == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="expiry_date" class="required"><b>Schedule Time To</b></label>
                                        <select id="scheduled_time_to" name="scheduled_time_to" class="nsm-field form-select " required>
                                            <option value="">To</option>
                                            <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                                <option <?= $tickets->scheduled_time_to == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="purchase_order_number" class="block-label"><b>Purchase Order#</b></label>
                                        <input type="text" class="form-control" name="purchase_order_no"
                                            id="purchase_order_no" placeholder="Enter Purchase Order#"
                                            autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());" value="<?php echo $tickets->purchase_order_no; ?>"/>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="ticket_status" class="block-label"><b>Ticket Status</b></label>
                                        <!-- <input type="text" class="form-control" name="ticket_status" id="ticket_status" 
                                            placeholder="Enter Ticket Status" value="<?php //echo $tickets->ticket_status; ?>"/> -->
                                        <select id="ticket_status" name="ticket_status" class="form-control">
                                            <option <?php if(isset($tickets)){ if($tickets->ticket_status == 'New'){echo "selected";} } ?> value="New">New</option>
                                            <option <?php if(isset($tickets)){ if($tickets->ticket_status == 'Draft'){echo "selected";} } ?> value="Draft">Draft</option>
                                            <option <?php if(isset($tickets)){ if($tickets->ticket_status == 'Scheduled'){echo "selected";} } ?> value="Scheduled">Scheduled</option>
                                            <option <?php if(isset($tickets)){ if($tickets->ticket_status == 'Arrived'){echo "selected";} } ?> value="Arrived">Arrived</option>
                                            <option <?php if(isset($tickets)){ if($tickets->ticket_status == 'Started'){echo "selected";} } ?> value="Started">Started</option>
                                            <option <?php if(isset($tickets)){ if($tickets->ticket_status == 'Approved'){echo "selected";} } ?> value="Approved">Approved</option>
                                            <option <?php if(isset($tickets)){ if($tickets->ticket_status == 'Finished'){echo "selected";} } ?> value="Finished">Finished</option>
                                            <option <?php if(isset($tickets)){ if($tickets->ticket_status == 'Invoiced'){echo "selected";} } ?> value="Invoiced">Invoiced</option>
                                            <option <?php if(isset($tickets)){ if($tickets->ticket_status == 'Completed'){echo "selected";} } ?> value="Completed">Completed</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="panel_type" class="block-label"><b>Panel Type</b> <a href="javascript:void(0);" id="btn-quick-add-panel-type" class="btn-small nsm-button">Add New</a></label>                                            
                                        <select name="panel_type" id="panel_type" class="form-control" data-value="<?= isset($tickets) ? $tickets->panel_type : "" ?>">
                                            <?php foreach($settingPanelTypes as $panelType){ ?>
                                                <option <?= isset($tickets) && $tickets->panel_type == $panelType->name ? 'selected="selected"' : ''; ?> value="<?= $panelType->name; ?>"><?= $panelType->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3" id="technicianDiv">
                                        <label for="appointment-user" class="block-label"><b>Assigned Technician</b></label>
                                        <!-- <input type="text" class="form-control" name="assign_tech" id="assign_tech" /> -->
                                        <select class="form-control nsm-field form-select" name="assign_tech[]" id="appointment-user" multiple="multiple" tabindex="-1" aria-hidden="true" required>
                                            <?php
                                                $assigned_technician = unserialize($tickets->technicians);
                                                // var_dump($assigned_technician);
                                                    foreach($assigned_technician as $eid){
                                                        $user = getUserName($eid);
                                                        $data = json_decode(json_encode($user), true);
                                                        $ASSIGNED_TECHNICIAN_ID = $data['id'];
                                                        $ASSIGNED_TECHNICIAN_NAME = $data['name'];
                                                        echo $custom_html = "<option selected value='$ASSIGNED_TECHNICIAN_ID'>$ASSIGNED_TECHNICIAN_NAME</option>";
                                                    }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="service_type" class="block-label"><b>Service Type</b> <a href="#" class="nsm-button btn-small" id="btn-quick-add-service-type">Add New</a></label>
                                        <select class="form-control" name="service_type" id="service_type">
                                            <?php foreach($serviceType as $sType){ ?>
                                                <option value="<?php echo $sType->service_name; ?>" <?php if($sType->service_name == $tickets->service_type){ echo 'selected'; } ?>><?php echo $sType->service_name; ?></option>
                                            <?php } ?>
                                        </select>                                        
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="warranty_type" class="block-label"><b>Warranty Type</b></label>
                                        <select id="warranty_type" name="warranty_type" data-customer-source="dropdown" class="form-control" >
                                            <option <?php if(isset($tickets)){ if($tickets->warranty_type == ""){ echo 'selected'; } } ?> value="">Select</option>
                                            <option <?php if(isset($tickets)){ if($tickets->warranty_type == "Limited. 90 Days"){ echo 'selected'; } } ?> value="Limited. 90 Days">Limited 90 Days</option>
                                            <option <?php if(isset($tickets)){ if($tickets->warranty_type == "1 Year"){ echo 'selected'; } } ?>  value="1 Year">1 Year</option>
                                            <option <?php if(isset($tickets)){ if($tickets->warranty_type == "$25 Trip"){ echo 'selected'; } } ?>  value="$25 Trip">$25 Trip</option>
                                            <option <?php if(isset($tickets)){ if($tickets->warranty_type == "$50 Trip and $65 Deductible"){ echo 'selected'; } } ?>  value="$50 Trip and $65 Deductible">$50 Trip and $65 Deductible</option>
                                            <option <?php if(isset($tickets)){ if($tickets->warranty_type == "Extended"){ echo 'selected'; } } ?>  value="Extended">Extended</option>
                                            <option <?php if(isset($tickets)){ if($tickets->warranty_type == "None"){ echo 'selected'; } } ?>  value="None">None</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="plan_type" class="block-label"><b>Plan Type</b> <a href="javascript:void(0);" class="btn-small nsm-button" id="btn-quick-add-plan-type">Add New</a></label>
                                        <select class="form-control" name="plan_type" id="plan_type">
                                            <?php foreach($settingsPlanTypes as $planType){ ?>
                                                <option <?= $tickets && $tickets->plan_type == $planType->name ? 'selected="selected"' : ''; ?> value="<?= $planType->name; ?>"><?= $planType->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="zip" class="block-label"><b>Created By</b></label>
                                        <!-- <input type="text" class="form-control" name="scheduled_time" id="employeeID" /> -->
                                        <select class="form-control mb-3" name="employee_id" id="employee_id">
                                            <option value="0">Select Name</option>
                                            <?php foreach($users_lists as $ulist){ ?>
                                                <option <?php if($ulist->id == $tickets->employee_id){ echo "selected";} ?> value="<?php echo $ulist->id ?>"><?php echo $ulist->FName .' '.$ulist->LName; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <!-- <div class="col-md-3 form-group mt-3">
                                        <label for="job_description"><b>Job Description</b></label>
                                        <textarea class="form-control" name="job_description" id="job_description"><?php echo $tickets->job_description; ?></textarea>
                                    </div> -->
                                </div>
                                <div class="row" id="plansItemDiv" style="background-color:white;">
                                    <h6 class='card_header custom-ticket-header'>Item List</h6>
                                    <div class="col-md-12 table-responsive">
                                        <table class="table table-hover table-borderless">
                                            <thead style="background-color:#E9E8EA;">
                                            <tr>
                                                <th>Name</th>
                                                <th style="width:30%;">Group</th>
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
                                            <tbody id="jobs_items_table_body">
                                                <?php
                                                    $i = 0;
                                                    foreach($itemsLists as $itemL){ 
                                                ?>
                                                <tr style="">
                                                    <td>
                                                        <input type="text" class="form-control getItems" onKeyup="getItems(this)" name="items[]" value="<?php echo $itemL->title; ?>">
                                                        <ul class="suggestions"></ul>
                                                        <div class="show_mobile_view"><span class="getItems_hidden"></span></div>
                                                        <input type="hidden" name="item_id[]" id="itemid" class="itemid" value="<?php echo $itemL->items_id; ?>">
                                                        <input type="hidden" name="packageID[]" value="0">
                                                    </td>
                                                    <td>
                                                        <div class="dropdown-wrapper">
                                                            <select name="item_type[]" id="item_typeid" class="form-control">
                                                                <option <?php if(isset($itemsLists)){ if($itemL->item_type == "product"){ echo 'selected'; } } ?> value="product">Product</option>
                                                                <option <?php if(isset($itemsLists)){ if($itemL->item_type == "material"){ echo 'selected'; } } ?> value="material">Material</option>
                                                                <option <?php if(isset($itemsLists)){ if($itemL->item_type == "service"){ echo 'selected'; } } ?> value="service">Service</option>
                                                                <option <?php if(isset($itemsLists)){ if($itemL->item_type == "fee"){ echo 'selected'; } } ?> value="fee">Fee</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td><input type="number" class="form-control quantity mobile_qty" name="quantity[]" data-counter="<?php echo $i; ?>" id="quantity_<?php echo $i; ?>" value="<?php echo $itemL->qty; ?>"></td>

                                                    <td><input type="number" step="any" class="form-control price price hidden_mobile_view" name="price[]" data-counter="<?php echo $i; ?>" id="price_<?php echo $i; ?>" value="<?php echo $itemL->costing; ?>">
                                                        <input type="hidden" class="priceqty" id="priceqty_<?php echo $i; ?>" value="<?php echo $itemL->costing; ?>"> 
                                                        <div class="show_mobile_view"></div>
                                                        <input id="priceM_qty<?php echo $i; ?>" value="0"  type="hidden" name="price_qty[]" class="form-control hidden_mobile_view price_qty">
                                                    </td>
                                                    <td class="hidden_mobile_view"><input type="number" step="any" class="form-control discount" name="discount[]" data-counter="<?php echo $i; ?>" id="discount_<?php echo $i; ?>" min="0"  value="<?php echo $itemL->discount; ?>"></td>
                                                    <td class="hidden_mobile_view"><input type="text" class="form-control tax_change" name="tax[]" data-counter="<?php echo $i; ?>" id="tax1_<?php echo $i; ?>" min="0"  value="<?php echo number_format($itemL->tax,2, '.', ','); ?>" readonly=""></td>
                                                    <td class="hidden_mobile_view"><input type="hidden" class="form-control " name="total[]" data-counter="<?php echo $i; ?>" id="item_total_<?php echo $i; ?>" min="0"  value="<?php echo $itemL->total; ?>"><span class="span-input" id="span_total_<?php echo $i; ?>"><?php echo number_format($itemL->total,2, '.', ','); ?></span></td>
                                                    <td><a href="#" class="remove nsm-button" id="<?php echo $i; ?>"><i class="bx bx-fw bx-trash"></i></a></td>
                                                </tr>
                                                <?php  $i++; } ?>
                                            <input type="hidden" name="count" value="<?php echo $i; ?>" id="count">
                                            </tbody>
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
                                        <?php if( $tickets->user_docfile_template_id > 0 ){ ?>
                                            <div class="row">
                                                <div class="col-md-3 form-group mt-2">
                                                    <label for="service-ticket-monthly-monitoring-rate"><b>Change Monthly Monitoring Rate</b></label>
                                                    <select style="display:inline-block;" class="form-control nsm-field form-select" name="monthly_monitoring_rate" id="service-ticket-monthly-monitoring-rate">
                                                        <option value="0.00">Select Plan Rate</option>
                                                        <?php foreach( $ratePlans as $rp ){ ?>
                                                            <option value="<?= $rp->amount; ?>"><?= $rp->plan_name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 form-group mt-2">
                                                    <label for=""><b>Monthly Monitoring Rate</b></label>
                                                    <input style="display:inline-block;" type="number" id="plan-value" name="monthly_monitoring_rate_value" value="<?= $tickets->monthly_monitoring > 0 ? number_format($tickets->monthly_monitoring,2,".","") : '0.00'; ?>" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 form-group mt-2">
                                                    <label for="service-ticket-installation-cost"><b>Installation Cost</b></label>
                                                    <input type="number" step="any" class="form-control" value="<?= $tickets->installation_cost > 0 ? number_format($tickets->monthly_monitoring,2,".","") : '0.00'; ?>" name="installation_cost" id="service-ticket-installation-cost">
                                                </div>
                                                <div class="col-md-3 form-group mt-2">
                                                    <label for="service-ticket-otp"><b>One Time (Program and Setup)</b></label>
                                                    <input type="number" step="any" class="form-control" value="<?= $tickets->otp_setup > 0 ? number_format($tickets->monthly_monitoring,2,".","") : '0.00'; ?>" name="otp" id="service-ticket-otp">
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <div class="select-wrap">
                                                    <b>Payment Method</b>
                                                    <select name="payment_method" id="payment_method" class="form-control">
                                                        <!-- <option value="">Choose method</option> -->
                                                        <option <?php if(isset($tickets)){ if($tickets->payment_method == "Cash"){ echo 'selected'; } } ?> value="Cash">Cash</option>
                                                        <option <?php if(isset($tickets)){ if($tickets->payment_method == "Check"){ echo 'selected'; } } ?> value="Check">Check</option>
                                                        <option <?php if(isset($tickets)){ if($tickets->payment_method == "Credit Card"){ echo 'selected'; } } ?> value="Credit Card">Credit Card</option>
                                                        <option <?php if(isset($tickets)){ if($tickets->payment_method == "Debit Card"){ echo 'selected'; } } ?> value="Debit Card">Debit Card</option>
                                                        <option <?php if(isset($tickets)){ if($tickets->payment_method == "ACH"){ echo 'selected'; } } ?> value="ACH">ACH</option>
                                                        <!-- <option <?php if(isset($tickets)){ if($tickets->payment_method == "Venmo"){ echo 'selected'; } } ?> value="Venmo">Venmo</option> -->
                                                        <!-- <option <?php if(isset($tickets)){ if($tickets->payment_method == "Paypal"){ echo 'selected'; } } ?> value="Paypal">Paypal</option> -->
                                                        <!-- <option <?php if(isset($tickets)){ if($tickets->payment_method == "Square"){ echo 'selected'; } } ?> value="Square">Square</option> -->
                                                        <option <?php if(isset($tickets)){ if($tickets->payment_method == "Invoicing"){ echo 'selected'; } } ?> value="Invoicing">Invoicing</option>
                                                        <option <?php if(isset($tickets)){ if($tickets->payment_method == "Warranty Work"){ echo 'selected'; } } ?> value="Warranty Work">Warranty Work</option>
                                                        <option <?php if(isset($tickets)){ if($tickets->payment_method == "Home Owner Financing"){ echo 'selected'; } } ?> value="Home Owner Financing">Home Owner Financing</option>
                                                        <!-- <option <?php if(isset($tickets)){ if($tickets->payment_method == "e-Transfer"){ echo 'selected'; } } ?> value="e-Transfer">e-Transfer</option> -->
                                                        <!-- <option <?php if(isset($tickets)){ if($tickets->payment_method == "Other Credit Card Professor"){ echo 'selected'; } } ?> value="Other Credit Card Professor">Other Credit Card Professor</option> -->
                                                        <option <?php if(isset($tickets)){ if($tickets->payment_method == "Other Payment Type"){ echo 'selected'; } } ?> value="Other Payment Type">Other Payment Type</option>
                                                    </select>
                                                </div> 
                                            </div>     
                                            <div class="form-group col-md-3">
                                                <b>Amount</b>
                                                <input type="number" class="form-control payment_amount" value="<?= $invoicePayment && $invoicePayment->amount > 0 ? number_format($invoicePayment->amount,2,".","") : '0.00'; ?>" name="payment_amount" id="payment_amount" placeholder="Enter Amount" />
                                            </div>
                                            <div class="form-group col-md-3">
                                                <b>Billing Date</b>
                                                <select name="billing_date" id="" class="form-control">
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
                                                <td colspan="2" align="right"><span id="span_sub_total_invoice"> <?php echo $tickets->subtotal > 0 ? number_format($tickets->subtotal,2,".","") : '0.00'; ?> </span> <input type="hidden" name="subtotal" id="item_total"></td>
                                            </tr>
                                            <tr>
                                                <td>Taxes</td>
                                                <!-- <td></td> -->
                                                <td colspan="2" align="right"><span id="total_tax_"><?php echo $tickets->taxes > 0 ? number_format($tickets->taxes,2,".","") : '0.00'; ?></span><input type="hidden" name="taxes" id="total_tax_input"></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="text" class="form-control" placeholder="Adjustment" name="adjustment" value="<?php echo $tickets->adjustment; ?>" style="width:80%;display:inline;">
                                                    <span id="modal-help-popover-adjustment" class='bx bx-fw bx-help-circle' data-bs-trigger="hover" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="" style="margin-right: -19px;"></span>
                                                </td>
                                                <td colspan="2">
                                                    <input type="number" step="any" style="width:50%;float:right;text-align:right;" class="form-control adjustment_input" name="adjustment_value" id="adjustment_input" value="<?php echo $tickets->adjustment_value > 0 ? number_format($tickets->adjustment_value,2,".","") : '0.00'; ?>">
                                                </td>
                                                <!-- <td align="right"><?php echo $tickets->adjustment_value; ?></td> -->
                                            </tr>
                                            <tr>
                                                <td>Markup</td>
                                                <td><a href="#" style="color:#02A32C;display:none;">set markup</a></td>
                                                <td align="right"><?php echo $tickets->markup > 0 ? number_format($tickets->markup, 2, ".", "") : '0.00'; ?><input type="hidden" name="markup" id="markup_input_form" class="markup_input" value="<?php echo $tickets->markup > 0 ? number_format($tickets->markup, 2, ".", "") : '0.00'; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td><b>Grand Total ($)</b></td>
                                                <td></td>
                                                <td align="right"><b><span id="grand_total"><?php echo $tickets->grandtotal > 0 ? number_format($tickets->grandtotal,2,".","") : '0.00'; ?></span></b><input type="hidden" name="grandtotal" id="grand_total_input" value='<?php echo $tickets->grandtotal; ?>'></td>
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
                                        <b>Sales Representative</b>
                                        <input type="text" name="sales_rep_view" class="form-control" value="<?php echo logged('FName').' '.logged('LName'); ?>">
                                        <input type="hidden" name="sales_rep" class="form-control" value="<?php echo $tickets->sales_rep; ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <b>Mobile Phone</b>
                                        <input type="text" name="sales_rep_no" class="form-control phone_number" placeholder="xxx-xxx-xxxx" value="<?php echo $tickets->sales_rep_no; ?>">
                                    </div>                       
                                    <div class="col-md-4">
                                        <b>Team Leader / Mentor</b>
                                        <input type="text" name="tl_mentor" class="form-control" placeholder="Enter Team Leader/Mentor" value="<?php echo $tickets->tl_mentor; ?>">
                                    </div>                                        
                                </div>
                                <div class="row" style="background-color:white;">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><h6><b>Instructions / Notes </b><span style="margin-left:10px;" class="bx bxs-help-circle" id="help-popover-instructions"></span></h6></label>
                                            <textarea name="instructions" cols="40" rows="2" class="form-control"><?php echo $tickets->instructions; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label><h6><b>Message to Customer</b><span style="margin-left:10px;" class="bx bxs-help-circle" id="help-popover-message-to-customer"></span></h6></label>
                                            <textarea name="message" cols="40" rows="4" class="form-control"><?php echo $tickets->message; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label><h6><b>Terms &amp; Conditions</b><span style="margin-left:10px;" class="bx bxs-help-circle" id="help-popover-terms-conditions"></span></h6></label>
                                            <textarea name="terms_conditions" cols="40" rows="4" class="form-control"><?php echo $tickets->terms_conditions; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="background-color:white;">
                                    <div class="col-md-4">
                                        <label for="billing_date"><h6>Attachments <span style="margin-left:10px;" class="bx bxs-help-circle" id="help-popover-attachment"></span></h6></label>
                                        <input type="file" name="attachments" id="attachments" class="form-control"/>
                                    </div>
                                </div>
                                <div class="row" style="background-color:white;">
                                    <div class="col-md-12 form-group">
                                        <button type="submit" class="nsm-button primary" style="">Update</button>                                        
                                        <a href="<?php echo base_url('customer/ticketslist/') ?>" class="btn">Cancel</a>
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
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" for="quick-add-items-list" placeholder="Search List">
                            </div>
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="col-sm-12">
                            <table id="quick-add-items-list" class="nsm-table" style="width: 100%;">
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
                                                <button type="button"  data-dismiss="modal" class='nsm nsm-button default select_item' id="<?= $item->id; ?>" data-item_type="<?= ucfirst($item->type); ?>" data-quantity="<?= $item_qty[0]->total_qty; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>"><i class='bx bx-plus-medical'></i></button>
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
<script src="<?php echo $url->assets ?>dashboard/js/bootstrap.bundle.min.js"></script>
<?php include viewPath('v2/includes/footer'); ?>
<?php //include viewPath('includes/footer'); ?>


<script>
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

        /*$('#customers')
            .empty() //empty select
            .append($("<option/>") //add option tag in select
                .val(customer_id) //set value for option to post it
                .text("<?php echo get_customer_by_id($_GET['customer_id'])->contact_name ?>")) //set a text for show in select
            .val(customer_id) //select option of select2
            .trigger("change"); //apply to select2*/
    });
</script>
<script type="module"  src="<?= base_url("assets/js/customer/dashboard/index.js") ?>"></script>

<script>

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
$(document).ready(function(){

    $('#sel-customer_t').select2({     
        minimumInputLength: 0        
    });

    $('#btn-quick-add-plan-type').on('click', function(){
        $('#plan-type-name').val('');
        $('#modal-quick-add-plan-type').modal('show');
    });

    $('#btn-quick-add-panel-type').on('click', function(){
        $('#panel-type-name').val('');
        $('#modal-quick-add-panel-type').modal('show');
    });

    $('#service-ticket-monthly-monitoring-rate').on('change', function(){
        var selected = $(this).val();
        $('#plan-value').val(selected);
        //$('#span_mmr').html(selected);
        //computeGrandTotal();
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

    $("#quick-add-items-list").nsmPagination({itemsPerPage:10});
    $("#search_field").on("input", debounce(function() {
        tableSearch($(this));        
    }, 1000));

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

    $('#add_another_items').on('click', function(){
        $('#quick-add-item').modal('show');
    });

    $('#modal-help-popover-adjustment').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'Optional it allows you to adjust the total amount Eg. +10 or -10.';
        }
    });
 
    $('#sel-customer_t').change(function(){
        var id  = $(this).val();
        $.ajax({
            type: 'POST',
            url:"<?php echo base_url(); ?>accounting/addLocationajax",
            data: {id : id },
            dataType: 'json',
            success: function(response){            
                var phone = response['customer'].phone_h;
                var mobile = response['customer'].phone_m;
                var test_p = phone.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3")
                var test_m = mobile.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3")
            
            var service_location = response['customer'].mail_add + ' ' + response['customer'].city + ', ' + response['customer'].state + ' ' + response['customer'].zip_code;
            $("#service_location").val(service_location);
            $("#customer_city").val(response['customer'].city);
            $("#customer_state").val(response['customer'].state);
            $("#customer_zip").val(response['customer'].zip_code);
            $("#customer_phone").val(response['customer'].phone_m);
            $("#business_name").val(response['customer'].business_name);

            var map_source = 'http://maps.google.com/maps?q=' + service_location +
                        '&output=embed';
            var map_iframe = '<iframe id="TEMPORARY_MAP_VIEW" src="' + map_source +
                '" height="370" width="100%" style=""></iframe>';
            $('.MAP_LOADER').hide().html(map_iframe).fadeIn('slow');
            
            //  $("#email").val(response['customer'].email);
            //  $("#date_of_birth").val(response['customer'].date_of_birth);
            //  $("#phone_no").val(test_p);
            //  $("#mobile_no").val(test_m);
            //  $("#city").val(response['customer'].city);
            //  $("#state").val(response['customer'].state);
            //  $("#zip").val(response['customer'].zip_code);
            //  $("#cross_street").val(response['customer'].cross_street);
            //  $("#acs_fullname").val(response['customer'].first_name +' '+ response['customer'].last_name);

            //  $("#job_name").val(response['customer'].first_name + ' ' + response['customer'].last_name);

            //  $("#primary_account_holder_name").val(response['customer'].first_name + ' ' + response['customer'].last_name);
        
            },
                error: function(response){
                //alert('Error'+response);
        
                }
        });
    });

    $('#btn-quick-add-service-type').on('click', function(){
        $('#modal-quick-add-service-type').modal('show');
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
                    Swal.fire({
                        text: "Service Type was successfully created",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            $('#service_type').append( new Option(data.service_type,data.service_type) );    
                            $('#service_type').val(data.service_type);
                        //}
                    });                    
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
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css" rel="stylesheet" />
<script>
$('#scheduled_time1').timepicker({
  timeFormat: 'hh:mm a',
  interval: 30,
  minTime: '8',
  maxTime: '11:00 PM',
  startTime: '08:00 AM',
  dynamic: false,
  dropdown: true,
  scrollbar: true
});

$('#scheduled_time1')
  .timepicker('option', 'change', function(time) {
    var later = new Date(time.getTime() + (2 * 60 * 60 * 1000));
    $('#scheduled_time_to').timepicker('option', 'minTime', time);
    $('#scheduled_time_to').timepicker('setTime', later);
  });

$('#scheduled_time_to1').timepicker({
  timeFormat: 'hh:mm a',
  interval: 30,
  maxTime: '11:00 PM',
  startTime: '08:00 AM',
  dynamic: false,
  dropdown: true,
  scrollbar: true
});
</script>
<script>
    
// $('#modal_items_list').DataTable({
//     "autoWidth" : false,
//     "columnDefs": [
//     { width: 540, targets: 0 },
//     { width: 100, targets: 0 },
//     { width: 100, targets: 0 }
//     ],
//     "ordering": false,
// });
</script>

<script>
$('#ticket_date1').datepicker({
    dateFormat: 'yyyy-mm-dd'
});


$(document).ready(function() {       
    $('#customer_phone').keydown(function(e) {
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
