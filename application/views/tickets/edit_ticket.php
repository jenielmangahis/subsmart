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
</style>

   <style>
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
                    <div class="col-md-6">
                        <label for="customers" class="required"><b>Customer</b></label>
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
                    </div>
                    <div class="col-md-3">
                        <br><a href="<?= base_url('customer/add_advance'); ?>" class="nsm-button primary" target="_new" id=""><i class='bx bx-plus'></i> New Customer</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="city"><b>Business Name</b> (optional)</label>
                        <input type="text" class="form-control" name="business_name" id="business_name" placeholder="Business Name" value="<?php echo $tickets->business_name; ?>"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="job_location" class="required"><b>Service Location</b></label>
                        <input type="text" class="form-control" name="service_location" id="service_location"
                                required placeholder="Enter Location"
                                onChange="jQuery('#customer_name').text(jQuery(this).val());" value="<?php echo $tickets->service_location; ?>"/>
                    </div>
                    <div class="col-md-2">
                        <label for="job_location" class="required"><b>City</b></label>
                        <input type="text" class="form-control" name="customer_city" id="customer_city"
                                required placeholder="Enter City" 
                                onChange="jQuery('#customer_name').text(jQuery(this).val());" value="<?php echo $tickets->acs_city; ?>"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <label for="job_location" class="required"><b>State</b></label>
                        <input type="text" class="form-control" name="customer_state" id="customer_state"
                                required placeholder="Enter State" 
                                onChange="jQuery('#customer_name').text(jQuery(this).val());" value="<?php echo $tickets->acs_state; ?>"/>
                    </div>
                    <div class="col-md-2">
                        <label for="job_location" class="required"><b>Zip Code</b></label>
                        <input type="text" class="form-control" name="customer_zip" id="customer_zip"
                                required placeholder="Enter Zip Code" 
                                onChange="jQuery('#customer_name').text(jQuery(this).val());" value="<?php echo $tickets->acs_zip; ?>"/>
                    </div>
                    <div class="col-md-2" style="display: ;">
                        <label for="job_location" class="required"><b>Customer Phone #</b></label>
                        <input type="text" class="form-control" name="customer_phone" id="customer_phone" required placeholder="Enter Phone Number"  value="<?php echo $tickets->customer_phone; ?>"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="job_name"><b>Service description</b> (optional)</label>
                        <!-- <input type="text" class="form-control" name="job_name" id="job_name" placeholder="Enter Job Name" required/> -->
                        <textarea class="form-control" name="service_description"><?php echo $tickets->service_description; ?></textarea>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="city">Service Tag</label><label style="float:right;margin-bottom:10px;"><a class="nsm-button primary" target="_new" href="<?= base_url('job/job_tags'); ?>">Manage Tag</a></label>
                        <select class="form-control" name="job_tag">
                            <?php foreach($tags as $t){ ?>
                                <option value="<?= $t->name; ?>" <?php if($t->name == $tickets->job_tag){ echo 'selected'; } ?>><?= $t->name; ?></option>
                            <?php } ?>
                        </select>
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
                                            <input type="text" class="form-control" value="<?php echo $tickets->ticket_date; ?>" name="ticket_date" id="ticket_date"
                                                    placeholder="Enter Ticket Date" data-date-format='yyyy-mm-dd' required>
                                            <!-- <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-th"></span>
                                            </div> -->
                                        <!-- </div> -->
                                    </div>
                                    <div class="col-md-3">
                                        <label for="expiry_date" class="required"><b>Schedule Time From</b></label>
                                        <!-- <input type="text" class="form-control" name="expiry_date" id="expiry_date" required placeholder="Enter Expiry Date" autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());" /> -->
                                        <!-- <div class="input-group date" data-provide="datepicker">
                                            <input type="text" class="form-control" name="expiry_date" id="expiry_date"
                                                    placeholder="Enter Expiry Date">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-th"></span>
                                            </div>
                                        </div> -->
                                        <input type="text" class="form-control" name="scheduled_time" id="scheduled_time"  value="<?php echo $tickets->scheduled_time; ?>" />
                                        <!-- <select id="scheduled_time" name="scheduled_time" class="form-control">
                                            <option value="8-10">8-10</option>
                                            <option value="10-12">10-12</option>
                                            <option value="12-2">12-2</option>
                                            <option value="2-4">2-4</option>
                                            <option value="4-6">4-6</option>
                                        </select> -->
                                    </div>
                                    <div class="col-md-3">
                                        <label for="expiry_date" class="required"><b>Schedule Time To</b></label>
                                        <input type="text" class="form-control" name="scheduled_time_to" id="scheduled_time_to"  value="<?php echo $tickets->scheduled_time_to; ?>" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="purchase_order_number"><b>Purchase Order#</b></label>
                                        <input type="text" class="form-control" name="purchase_order_no"
                                            id="purchase_order_no" placeholder="Enter Purchase Order#"
                                            autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());" value="<?php echo $tickets->purchase_order_no; ?>"/>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="zip"><b>Ticket Status</b></label>
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
                                        <label for="zip"><b>Panel Type</b></label>
                                            <select name="panel_type" id="panel_type" class="form-control" data-value="<?= isset($tickets) ? $tickets->panel_type : "" ?>">
                                                <option <?php if(isset($tickets)){ if($tickets->panel_type == ''){echo "selected";} } ?>  value="0">- none -</option>
                                                <option <?php if(isset($tickets)){ if($tickets->panel_type == 'AERIONICS'){echo "selected";} } ?> value="AERIONICS">AERIONICS</option>
                                                <option <?php if(isset($tickets)){ if($tickets->panel_type == 'AlarmNet'){echo "selected";} } ?> value="AlarmNet">AlarmNet</option>
                                                <option <?php if(isset($tickets)){ if($tickets->panel_type == 'Alarm.com'){echo "selected";} } ?> value="Alarm.com">Alarm.com</option>
                                                <option <?php if(isset($tickets)){ if($tickets->panel_type == 'Alula'){echo "selected";} } ?> value="Alula">Alula</option>
                                                <option <?php if(isset($tickets)){ if($tickets->panel_type == 'Bosch'){echo "selected";} } ?> value="Bosch">Bosch</option>
                                                <option <?php if(isset($tickets)){ if($tickets->panel_type == 'DSC'){echo "selected";} } ?> value="DSC">DSC</option>
                                                <option <?php if(isset($tickets)){ if($tickets->panel_type == 'ELK'){echo "selected";} } ?> value="ELK">ELK</option>
                                                <option <?php if(isset($tickets)){ if($tickets->panel_type == 'FBI'){echo "selected";} } ?> value="FBI">FBI</option>
                                                <option <?php if(isset($tickets)){ if($tickets->panel_type == 'GRI'){echo "selected";} } ?> value="GRI">GRI</option>
                                                <option <?php if(isset($tickets)){ if($tickets->panel_type == 'GE'){echo "selected";} } ?> value="GE">GE</option>
                                                <option <?php if(isset($tickets)){ if($tickets->panel_type == 'Honeywell'){echo "selected";} } ?> value="Honeywell">Honeywell</option>
                                                <option <?php if(isset($tickets)){ if($tickets->panel_type == 'Honeywell Touch'){echo "selected";} } ?> value="Honeywell Touch">Honeywell Touch</option>
                                                <option <?php if(isset($tickets)){ if($tickets->panel_type == 'Honeywell 3000'){echo "selected";} } ?> value="Honeywell 3000">Honeywell 3000</option>
                                                <option <?php if(isset($tickets)){ if($tickets->panel_type == 'Honeywell'){echo "selected";} } ?> value="Honeywell Vista">Honeywell Vista</option>
                                                <option <?php if(isset($tickets)){ if($tickets->panel_type == 'Honeywell Vista with Sem'){echo "selected";} } ?> value="Honeywell Vista with Sem">Honeywell Vista with Sem</option>
                                                <option <?php if(isset($tickets)){ if($tickets->panel_type == 'Honeywell Lyric'){echo "selected";} } ?> value="Honeywell Lyric">Honeywell Lyric</option>
                                                <option <?php if(isset($tickets)){ if($tickets->panel_type == 'IEI'){echo "selected";} } ?> value="IEI">IEI</option>
                                                <option <?php if(isset($tickets)){ if($tickets->panel_type == 'MIER'){echo "selected";} } ?> value="MIER">MIER</option>
                                                <option <?php if(isset($tickets)){ if($tickets->panel_type == '2 GIG'){echo "selected";} } ?> value="2 GIG">2 GIG</option>
                                                <option <?php if(isset($tickets)){ if($tickets->panel_type == '2 GIG Go Panel 2'){echo "selected";} } ?> value="2 GIG Go Panel 2">2 GIG Go Panel 2</option>
                                                <option <?php if(isset($tickets)){ if($tickets->panel_type == '2 GIG Go Panel 3'){echo "selected";} } ?> value="2 GIG Go Panel 3">2 GIG Go Panel 3</option>
                                                <option <?php if(isset($tickets)){ if($tickets->panel_type == 'Qolsys'){echo "selected";} } ?> value="Qolsyx">Qolsys</option>
                                                <option <?php if(isset($tickets)){ if($tickets->panel_type == 'Qolsys IQ Panel 2'){echo "selected";} } ?> value="Qolsys IQ Panel 2">Qolsys IQ Panel 2</option>
                                                <option <?php if(isset($tickets)){ if($tickets->panel_type == 'Qolsys IQ Panel 2 Plus'){echo "selected";} } ?> value="Qolsys IQ Panel 2 Plus">Qolsys IQ Panel 2 Plus</option>
                                                <option <?php if(isset($tickets)){ if($tickets->panel_type == 'Qolsys IQ Panel 3'){echo "selected";} } ?> value="Qolsys IQ Panel 3">Qolsys IQ Panel 3</option>
                                                <option <?php if(isset($tickets)){ if($tickets->panel_type == 'Custom'){echo "selected";} } ?> value="Custom">Custom</option>
                                                <option <?php if(isset($tickets)){ if($tickets->panel_type == 'Other'){echo "selected";} } ?> value="Other">Other</option>
                                            </select>
                                    </div>
                                    <div class="col-md-3" id="technicianDiv">
                                        <label for="purchase_order_number"><b>Assigned Technician</b></label>
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
                                <div class="row" style="background-color:white;">
                                    <div class="col-md-3 form-group">
                                        <label for="zip"><b>Service Type</b></label>
                                        <div class="input-group">
                                            <select class="form-control" name="service_type" id="service_type">
                                                <?php foreach($serviceType as $sType){ ?>
                                                    <option value="<?php echo $sType->service_name; ?>" <?php if($sType->service_name == $tickets->service_type){ echo 'selected'; } ?>><?php echo $sType->service_name; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="input-group-btn">
                                                <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addServiceType">Add New</a>
                                            </span>
                                        </div><!-- /input-group -->
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="zip"><b>Warranty Type</b></label>
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
                                        <label for="zip"><b>Employee</b></label>
                                        <!-- <input type="text" class="form-control" name="scheduled_time" id="employeeID" /> -->
                                        <select class="form-control mb-3" name="employee_id">
                                            <option value="0">Select Name</option>
                                            <?php foreach($users_lists as $ulist){ ?>
                                                <option <?php if($ulist->id == $tickets->employee_id){ echo "selected";} ?> value="<?php echo $ulist->id ?>"><?php echo $ulist->FName .' '.$ulist->LName; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="zip"><b>Job Description</b></label>
                                        <textarea class="form-control" name="job_description"><?php echo $tickets->job_description; ?></textarea>
                                    </div>
                                </div>
                                <div class="row" style="background-color:white;font-size:16px;">
                                    <div class="col-md-3">
                                        <a href="#" style="color:#02A32C;"><b>Items list</b></a> | <b>Items Summary</b>
                                    </div>
                                    <div class="col-md-6">
                                    </div>
                                    <div class="col-md-3" align="right">
                                        <b>Show qty as: </b>
                                        <select class="dropdown">
                                            <option>Quantity</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row" id="plansItemDiv" style="background-color:white;">
                                    <div class="col-md-12 table-responsive">
                                        <!-- <table class="table table-hover">
                                            <input type="hidden" name="count" value="0" id="count">
                                            <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Description</th>
                                                <th width="100px">Quantity</th>
                                                <th>Location</th>
                                                <th width="100px">Cost</th>
                                                <th width="100px">Discount</th>
                                                <th>Tax(%)</th>
                                                <th>Total</th>
                                            </tr>
                                            </thead>
                                            <tbody id="table_body">
                                            <tr>
                                                <td><select name="item_type[]" class="form-control">
                                                        <option value="product">Product</option>
                                                        <option value="material">Material</option>
                                                        <option value="service">Service</option>
                                                    </select></td>
                                                <td><input type="text" class="form-control getItems"
                                                        onKeyup="getItems(this)" name="item[]">
                                                    <ul class="suggestions"></ul>
                                                </td>
                                                <td><input type="text" class="form-control quantity" name="quantity[]"
                                                        data-counter="0" id="quantity_0" value="1"></td>
                                                <td><input type="text" class="form-control" name="location[]"></td>
                                                <td><input type="number" class="form-control price" name="price[]"
                                                        data-counter="0" id="price_0" min="0" value="0"></td>
                                                <td><input type="number" class="form-control discount" name="discount[]"
                                                        data-counter="0" id="discount_0" min="0" value="0" readonly></td>
                                                <td><span id="span_tax_0">0.00 (7.5%)</span></td>
                                                <td><span id="span_total_0">0.00</span></td>
                                            </tr>
                                            </tbody>
                                        </table> -->
                                        <table class="table table-hover">
                                            <thead style="background-color:#E9E8EA;">
                                            <tr>
                                                <th>Name</th>
                                                <th>Group</th>
                                                <!-- <th>Description</th> -->
                                                <th width="150px">Quantity</th>
                                                <!-- <th>Location</th> -->
                                                <th width="150px">Price</th>
                                                <th class="hidden_mobile_view" width="150px">Discount</th>
                                                <th class="hidden_mobile_view" width="150px">Tax (Change in %)</th>
                                                <th class="hidden_mobile_view">Total</th>
                                                <th class=""></th>
                                            </tr>
                                            </thead>
                                            <tbody id="jobs_items_table_body">
                                                <?php
                                                    $i = 0;
                                                    foreach($itemsLists as $itemL){ ?>
                                                    <?php //print_r($itemsLists); ?>
                                                <tr style="display:;">
                                                    <td width="30%">
                                                        <input type="text" class="form-control getItems" onKeyup="getItems(this)" name="items[]" value="<?php echo $itemL->title; ?>">
                                                        <ul class="suggestions"></ul>
                                                        <div class="show_mobile_view"><span class="getItems_hidden"></span></div>
                                                        <input type="hidden" name="item_id[]" id="itemid" class="itemid" value="<?php echo $itemL->items_id; ?>">
                                                        <input type="hidden" name="packageID[]" value="0">
                                                    </td>
                                                    <td width="20%">
                                                        <div class="dropdown-wrapper">
                                                            <select name="item_type[]" id="item_typeid" class="form-control">
                                                                <option <?php if(isset($itemsLists)){ if($itemL->item_type == "product"){ echo 'selected'; } } ?> value="product">Product</option>
                                                                <option <?php if(isset($itemsLists)){ if($itemL->item_type == "material"){ echo 'selected'; } } ?> value="material">Material</option>
                                                                <option <?php if(isset($itemsLists)){ if($itemL->item_type == "service"){ echo 'selected'; } } ?> value="service">Service</option>
                                                                <option <?php if(isset($itemsLists)){ if($itemL->item_type == "fee"){ echo 'selected'; } } ?> value="fee">Fee</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td width="10%"><input type="number" class="form-control quantity mobile_qty" name="quantity[]" data-counter="<?php echo $i; ?>" id="quantity_<?php echo $i; ?>" value="<?php echo $itemL->qty; ?>"></td>
                                                    <td width="1<?php echo $i; ?>%"><input type="text" class="form-control price price hidden_mobile_view" name="price[]" data-counter="<?php echo $i; ?>" id="price_<?php echo $i; ?>" value="<?php echo $itemL->costing; ?>">
                                                        <input type="hidden" class="priceqty" id="priceqty_<?php echo $i; ?>" value="<?php echo $itemL->costing; ?>"> 
                                                        <div class="show_mobile_view"></div>
                                                        <input id="priceM_qty<?php echo $i; ?>" value="0"  type="hidden" name="price_qty[]" class="form-control hidden_mobile_view price_qty">
                                                    </td>
                                                    <td width="10%" class="hidden_mobile_view"><input type="number" class="form-control discount" name="discount[]" data-counter="<?php echo $i; ?>" id="discount_<?php echo $i; ?>" min="0"  value="<?php echo $itemL->discount; ?>"></td>
                                                    <td width="10%" class="hidden_mobile_view"><input type="text" class="form-control tax_change" name="tax[]" data-counter="<?php echo $i; ?>" id="tax1_<?php echo $i; ?>" min="0"  value="<?php echo number_format($itemL->tax,2, '.', ','); ?>" readonly=""></td>
                                                    <td width="10%" class="hidden_mobile_view"><input type="hidden" class="form-control " name="total[]" data-counter="<?php echo $i; ?>" id="item_total_<?php echo $i; ?>" min="0"  value="<?php echo $itemL->total; ?>">$<span id="span_total_<?php echo $i; ?>"><?php echo number_format($itemL->total,2, '.', ','); ?></span></td>
                                                    <td><a href="#" class="remove btn btn-sm btn-danger" id="<?php echo $i; ?>"><i class="fa fa-trash" aria-hidden="true"></i>Remove</a></td>
                                                </tr>
                                                <?php  $i++; } ?>
                                            <input type="hidden" name="count" value="<?php echo $i; ?>" id="count">
                                            </tbody>
                                        </table>
                                        <a class="link-modal-open" href="#" id="add_another_items" data-toggle="modal" data-target="#item_list"><span class="fa fa-plus-square fa-margin-right"></span>Add Items</a>
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
                                    </div>
                                    <div class="col-md-4">
                                        <table class="table" style="text-align:left;">
                                            <tr>
                                                <td>Subtotal</td>
                                                <!-- <td></td> -->
                                                <td colspan="2" align="right"><span id="span_sub_total_invoice"> <?php echo $tickets->subtotal; ?> </span> <input type="hidden" name="subtotal" id="item_total"></td>
                                            </tr>
                                            <tr>
                                                <td>Taxes</td>
                                                <!-- <td></td> -->
                                                <td colspan="2" align="right">$ <span id="total_tax_"><?php echo $tickets->taxes; ?></span><input type="hidden" name="taxes" id="total_tax_input"></td>
                                            </tr>
                                            <tr>
                                                <td style="width:250px;"><input type="text" class="form-control" placeholder="Adjustment" name="adjustment" value="<?php echo $tickets->adjustment; ?>"></td>
                                                <td style="width:150px;"><input type="number"  class="form-control adjustment_input" name="adjustment_value" id="adjustment_input" value="<?php echo $tickets->adjustment_value; ?>"></td>
                                                <td align="right"><?php echo $tickets->adjustment_value; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Markup</td>
                                                <td><a href="#" style="color:#02A32C;">set markup</a></td>
                                                <td align="right"><?php echo $tickets->markup; ?><input type="hidden" name="markup" id="markup_input_form" class="markup_input" value="<?php echo $tickets->markup; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td><b>Grand Total ($)</b></td>
                                                <td></td>
                                                <td align="right"><b><span id="grand_total"><?php echo $tickets->grandtotal; ?></span></b><input type="hidden" name="grandtotal" id="grand_total_input" value='<?php echo $tickets->grandtotal; ?>'></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <div class="select-wrap">
                                            <b>Payment Method</b>
                                                <select name="payment_method" id="payment_method" class="form-control">
                                                    <!-- <option value="">Choose method</option> -->
                                                    <option <?php if(isset($tickets)){ if($tickets->payment_method == "Cash"){ echo 'selected'; } } ?> value="Cash">Cash</option>
                                                    <option <?php if(isset($tickets)){ if($tickets->payment_method == "Check"){ echo 'selected'; } } ?> value="Check">Check</option>
                                                    <option <?php if(isset($tickets)){ if($tickets->payment_method == "Credit Card"){ echo 'selected'; } } ?> value="Credit Card">Credit Card</option>
                                                    <option <?php if(isset($tickets)){ if($tickets->payment_method == "Debit Card"){ echo 'selected'; } } ?> value="Debit Card">Debit Card</option>
                                                    <option <?php if(isset($tickets)){ if($tickets->payment_method == "ACH"){ echo 'selected'; } } ?> value="ACH">ACH</option>
                                                    <option <?php if(isset($tickets)){ if($tickets->payment_method == "Venmo"){ echo 'selected'; } } ?> value="Venmo">Venmo</option>
                                                    <option <?php if(isset($tickets)){ if($tickets->payment_method == "Paypal"){ echo 'selected'; } } ?> value="Paypal">Paypal</option>
                                                    <option <?php if(isset($tickets)){ if($tickets->payment_method == "Square"){ echo 'selected'; } } ?> value="Square">Square</option>
                                                    <option <?php if(isset($tickets)){ if($tickets->payment_method == "Invoicing"){ echo 'selected'; } } ?> value="Invoicing">Invoicing</option>
                                                    <option <?php if(isset($tickets)){ if($tickets->payment_method == "Warranty Work"){ echo 'selected'; } } ?> value="Warranty Work">Warranty Work</option>
                                                    <option <?php if(isset($tickets)){ if($tickets->payment_method == "Home Owner Financing"){ echo 'selected'; } } ?> value="Home Owner Financing">Home Owner Financing</option>
                                                    <option <?php if(isset($tickets)){ if($tickets->payment_method == "e-Transfer"){ echo 'selected'; } } ?> value="e-Transfer">e-Transfer</option>
                                                    <option <?php if(isset($tickets)){ if($tickets->payment_method == "Other Credit Card Professor"){ echo 'selected'; } } ?> value="Other Credit Card Professor">Other Credit Card Professor</option>
                                                    <option <?php if(isset($tickets)){ if($tickets->payment_method == "Other Payment Type"){ echo 'selected'; } } ?> value="Other Payment Type">Other Payment Type</option>
                                                </select>
                                            </div> 
                                        </div>     
                                        <div class="form-group col-md-4">
                                            <b>Amount<small class="help help-sm"> ( $ )</small></b>
                                            <input type="text" class="form-control payment_amount" name="payment_amount" id="payment_amount" placeholder="Enter Amount" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <b>Billing Date</b>
                                            <!-- <input type="date" class="form-control input-element border-top-0 border-right-0 border-left-0" name="billing_date" id=""  /> -->
                                            <select name="billing_date" id="" class="form-control">
                                                    <option value="">0</option>
                                                    <?php for ($i=1; $i<=31; $i++ ) { ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                        </div>
                                </div>
                                
                                <div class="row">                   
                                    <div class="col-md-12">
                                                <div id="invoicing" style="display:none;">
                                                    <!-- <input type="checkbox" id="same_as"> <b>Same as above Address</b> <br><br> -->
                                                    <div class="row">                   
                                                        <div class="col-md-6 form-group">
                                                            <label for="monitored_location" class="label-element">Mail Address</label>
                                                            <input type="text" class="form-control input-element" name="mail-address"
                                                                id="mail-address" placeholder="Monitored Location"/>
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label for="city" class="label-element">City</label>
                                                                <input type="text" class="form-control input-element" name="mail_locality" id="mail_locality" placeholder="Enter Name" />
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label for="state" class="label-element">State</label>
                                                            <input type="text" class="form-control input-element" name="mail_state"
                                                                id="mail_state" 
                                                                placeholder="Enter State"/>
                                                        </div>
                                                    <!-- </div>
                                                    <div class="row">   -->
                                                        <div class="col-md-6 form-group">
                                                            <label for="zip" class="label-element">ZIP</label> 
                                                                <input type="text" id="mail_postcode" name="mail_postcode" class="form-control input-element"  placeholder="Enter Zip"/>
                                                        </div>

                                                        <div class="col-md-6 form-group">
                                                            <label for="cross_street" class="label-element">Cross Street</label>
                                                            <input type="text" class="form-control input-element" name="mail_cross_street"
                                                                id="mail_cross_street" 
                                                                placeholder="Cross Street"/>
                                                        </div>                                        
                                                    </div>
                                                </div>
                                            <div id="check_area" style="display:none;">
                                                <div class="row">                   
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type" class="label-element">Check Number</label>
                                                        <input type="text" class="form-control input-element" name="check_number" id="check_number"/>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type" class="label-element">Routing Number</label>
                                                        <input type="text" class="form-control input-element" name="routing_number" id="routing_number"/>
                                                    </div>                                             
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type" class="label-element">Account Number</label>
                                                        <input type="text" class="form-control input-element" name="account_number" id="account_number"/>
                                                    </div>                                       
                                                </div>
                                            </div>
                                            <div id="credit_card" style="display:none;">
                                                <div class="row">                   
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type" class="label-element">Credit Card Number</label>
                                                        <input type="text" class="form-control input-element" name="credit_number" id="credit_number" placeholder="0000 0000 0000 000" />
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type" class="label-element">Credit Card Expiration</label>
                                                        <input type="text" class="form-control input-element" name="credit_expiry" id="credit_expiry" placeholder="MM/YYYY"/>
                                                    </div>  
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type" class="label-element">CVC</label>
                                                        <input type="text" class="form-control input-element" name="credit_cvc" id="credit_cvc" placeholder="CVC"/>
                                                    </div>                                             
                                                </div>
                                            </div>
                                            <div id="debit_card" style="display:none;">
                                                <div class="row">                   
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type" class="label-element">Credit Card Number</label>
                                                        <input type="text" class="form-control input-element" name="debit_credit_number" id="credit_number2" placeholder="0000 0000 0000 000" />
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type" class="label-element">Credit Card Expiration</label>
                                                        <input type="text" class="form-control input-element" name="debit_credit_expiry" id="credit_expiry" placeholder="MM/YYYY"/>
                                                    </div>  
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type" class="label-element">CVC</label>
                                                        <input type="text" class="form-control input-element" name="debit_credit_cvc" id="credit_cvc" placeholder="CVC"/>
                                                    </div>                                            
                                                </div>
                                            </div>
                                            <div id="ach_area" style="display:none;">
                                                <div class="row">                   
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type" class="label-element">Routing Number</label>
                                                        <input type="text" class="form-control input-element" name="ach_routing_number" id="ach_routing_number" />
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type" class="label-element">Account Number</label>
                                                        <input type="text" class="form-control input-element" name="ach_account_number" id="ach_account_number" />
                                                    </div>  
                                                </div>
                                            </div>
                                            <div id="venmo_area" style="display:none;">
                                                <div class="row">                   
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type" class="label-element">Account Credential</label>
                                                        <input type="text" class="form-control input-element" name="account_credentials" id="account_credentials"/>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type" class="label-element">Account Note</label>
                                                        <input type="text" class="form-control input-element" name="account_note" id="account_note"/>
                                                    </div>  
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type" class="label-element">Confirmation</label>
                                                        <input type="text" class="form-control input-element" name="confirmation" id="confirmation"/>
                                                    </div>                                            
                                                </div>
                                            </div>
                                            <div id="paypal_area" style="display:none;">
                                                <div class="row">                   
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type" class="label-element">Account Credential</label>
                                                        <input type="text" class="form-control input-element" name="paypal_account_credentials" id="paypal_account_credentials"/>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type" class="label-element">Account Note</label>
                                                        <input type="text" class="form-control input-element" name="paypal_account_note" id="paypal_account_note"/>
                                                    </div>  
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type" class="label-element">Confirmation</label>
                                                        <input type="text" class="form-control input-element" name="paypal_confirmation" id="paypal_confirmation"/>
                                                    </div>                                            
                                                </div>
                                            </div>
                                            <div id="square_area" style="display:none;">
                                                <div class="row">                   
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type" class="label-element">Account Credential</label>
                                                        <input type="text" class="form-control input-element" name="square_account_credentials" id="square_account_credentials"/>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type" class="label-element">Account Note</label>
                                                        <input type="text" class="form-control input-element" name="square_account_note" id="square_account_note"/>
                                                    </div>  
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type" class="label-element">Confirmation</label>
                                                        <input type="text" class="form-control input-element" name="square_confirmation" id="square_confirmation"/>
                                                    </div>                                            
                                                </div>
                                            </div>
                                            <div id="warranty_area" style="display:none;">
                                                <div class="row">                   
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type" class="label-element">Account Credential</label>
                                                        <input type="text" class="form-control input-element" name="warranty_account_credentials" id="warranty_account_credentials"/>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type" class="label-element">Account Note</label>
                                                        <input type="text" class="form-control input-element" name="warranty_account_note" id="warranty_account_note"/>
                                                    </div>                                         
                                                </div>
                                            </div>
                                            <div id="home_area" style="display:none;">
                                                <div class="row">                   
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type" class="label-element">Account Credential</label>
                                                        <input type="text" class="form-control input-element" name="home_account_credentials" id="home_account_credentials"/>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type" class="label-element">Account Note</label>
                                                        <input type="text" class="form-control input-element" name="home_account_note" id="home_account_note"/>
                                                    </div>                                         
                                                </div>
                                            </div>
                                            <div id="e_area" style="display:none;">
                                                <div class="row">                   
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type" class="label-element">Account Credential</label>
                                                        <input type="text" class="form-control input-element" name="e_account_credentials" id="e_account_credentials"/>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type" class="label-element">Account Note</label>
                                                        <input type="text" class="form-control input-element" name="e_account_note" id="e_account_note"/>
                                                    </div>                                         
                                                </div>
                                            </div>
                                            <div id="other_credit_card" style="display:none;">
                                                <div class="row">                   
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type" class="label-element">Credit Card Number</label>
                                                        <input type="text" class="form-control input-element" name="other_credit_number" id="other_credit_number" placeholder="0000 0000 0000 000" />
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type" class="label-element">Credit Card Expiration</label>
                                                        <input type="text" class="form-control input-element" name="other_credit_expiry" id="other_credit_expiry" placeholder="MM/YYYY"/>
                                                    </div>  
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type" class="label-element">CVC</label>
                                                        <input type="text" class="form-control input-element" name="other_credit_cvc" id="other_credit_cvc" placeholder="CVC"/>
                                                    </div>                                             
                                                </div>
                                            </div>
                                            <div id="other_payment_area" style="display:none;">
                                                <div class="row">                   
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type">Account Credential</label>
                                                        <input type="text" class="form-control input-element" name="other_payment_account_credentials" id="other_payment_account_credentials"/>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="job_type">Account Note</label>
                                                        <input type="text" class="form-control input-element" name="other_payment_account_note" id="other_payment_account_note"/>
                                                    </div>                                         
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="row">
                                <!-- <div class="form-group col-md-12"> -->
                                    <div class="col-md-4">
                                        <b>Sales Rep's Name</b>
                                        <input type="text" name="sales_rep_view" class="form-control" value="<?php echo logged('FName').' '.logged('LName'); ?>">
                                        <input type="hidden" name="sales_rep" class="form-control" value="<?php echo $tickets->sales_rep; ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <b>Cell Phone</b>
                                        <input type="text" name="sales_rep_no" class="form-control" value="<?php echo $tickets->sales_rep_no; ?>" placeholder="Enter Cellphone Number">
                                    </div>                       
                                    <div class="col-md-4">
                                        <b>Team Leader / Mentor</b>
                                        <input type="text" name="tl_mentor" class="form-control" placeholder="Enter Team Leader/Mentor" value="<?php echo $tickets->tl_mentor; ?>">
                                    </div>                                        
                                </div>
                                <div class="row" style="background-color:white;">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><h6>Instructions: </h6></label><br> <span class="help help-sm help-block">Optional internal notes, will not appear to customer</span>
                                            <textarea name="instructions" cols="40" rows="2" class="form-control"><?php echo $tickets->instructions; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label><h6>Message to Customer</h6></label><br> <span class="help help-sm help-block">Add a message that will be displayed on the Ticket.</span>
                                            <textarea name="message" cols="40" rows="4" class="form-control"><?php echo $tickets->message; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label><h6>Terms &amp; Conditions</h6></label><br> <span class="help help-sm help-block">Mention your company's T&amp;C that will appear on the Ticket.</span>
                                            <textarea name="terms_conditions" cols="40" rows="4" class="form-control"><?php echo $tickets->terms_conditions; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="background-color:white;">
                                    <div class="col-md-4">
                                        <label for="billing_date"><h6>Attachments</h6></label><br> 
                                        <span class="help help-sm help-block">Optionally attach files to this invoice. Allowed type: pdf, doc, dock, png, jpg, gif</span>
                                        <input type="file" name="attachments" id="attachments" class="form-control"/>
                                    </div>
                                </div>
                                <div class="row" style="background-color:white;">
                                    <div class="col-md-12 form-group">
                                        <button type="submit" class="btn btn-warning but" style="border-radius: 0 !important;border:solid gray 1px;">Update</button>
                                        <button type="button" class="nsm-button primary but" style="border-radius: 0 !important;">Preview</button>
                                        <a href="<?php echo base_url('customer/ticketslist/') ?>" class="btn but-red">Cancel this</a>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo form_close(); ?>
            <!-- Modal -->
            <div class="modal fade" id="item_list" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newcustomerLabel">Item Lists</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="modal_items_list" class="table-hover" style="width: 100%;">
                                        <thead>
                                        <tr>
                                            <td> Name</td>
                                            <td> Price</td>
                                            <td> Action</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($items as $item){ // print_r($item); ?>
                                            <tr>
                                                <td><?php echo $item->title; ?></td>                                                
                                                <td><?php echo $item->price; ?></td>
                                                <td><button id="<?= $item->id; ?>" data-quantity="<?= $item->units; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>" type="button" data-dismiss="modal" class="btn btn-sm btn-default select_item">Add
                                                <span class="fa fa-plus"></span>
                                            </button></td>
                                            </tr>
                                            
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer modal-footer-detail">
                            <div class="button-modal-list">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fa fa-remove"></span> Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php //echo $file_selection; ?>

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
 
 $('#sel-customer_t').change(function(){
 var id  = $(this).val();
//  alert(id);

     $.ajax({
         type: 'POST',
         url:"<?php echo base_url(); ?>accounting/addLocationajax",
         data: {id : id },
         dataType: 'json',
         success: function(response){
            //  alert('success');
             // console.log(response['customer']);
         // $("#job_location").val(response['customer'].mail_add + ' ' + response['customer'].cross_street + ' ' + response['customer'].city + ' ' + response['customer'].state + ' ' + response['customer'].country);

         // var phone = response['customer'].phone_h;
         // var new_phone = phone.value.replace(/(\d{3})\-?/g,'$1-');
         var phone = response['customer'].phone_h;
             // phone = normalize(phone);
         
         var mobile = response['customer'].phone_m;
             // mobile = normalize(mobile);

         var test_p = phone.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3")
         var test_m = mobile.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3")
         
         $("#service_location").val(response['customer'].mail_add);
         $("#customer_city").val(response['customer'].city);
         $("#customer_state").val(response['customer'].state);
         $("#customer_zip").val(response['customer'].zip_code);
         $("#customer_phone").val(response['customer'].phone_h);
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
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css" rel="stylesheet" />
<script>
$('#scheduled_time').timepicker({
  timeFormat: 'hh:mm a',
  interval: 30,
  minTime: '8',
  maxTime: '11:00 PM',
  startTime: '08:00 AM',
  dynamic: false,
  dropdown: true,
  scrollbar: true
});

$('#scheduled_time')
  .timepicker('option', 'change', function(time) {
    var later = new Date(time.getTime() + (2 * 60 * 60 * 1000));
    $('#scheduled_time_to').timepicker('option', 'minTime', time);
    $('#scheduled_time_to').timepicker('setTime', later);
  });

$('#scheduled_time_to').timepicker({
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
$('#ticket_date').datepicker({
    dateFormat: 'yyyy-mm-dd'
});
</script>
