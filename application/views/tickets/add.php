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
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
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
                    <div class="col-md-6">
                        <label for="customers" class="required"><b>Customer</b></label>
                        <select id="sel-customer_t" name="customer_id" data-customer-source="dropdown" required class="form-control searchable-dropdown" placeholder="Select">
                            <option>- Select Customer -</option>
                            <?php foreach($customers as $c){ ?>
                                <?php if( $default_customer_id > 0 ){ ?>
                                    <option <?= $default_customer_id == $c->prof_id ? 'selected="selected"' : ''; ?> value="<?= $c->prof_id; ?>"><?= $c->first_name . ' ' . $c->last_name; ?></option>
                                <?php }else{ ?>
                                    <option value="<?= $c->prof_id; ?>"><?= $c->first_name . ' ' . $c->last_name; ?></option>
                                <?php } ?>                                            
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <br>
                        <a class="link-modal-open" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modalNewCustomer" style="color:#02A32C;float:right;"><span class="fa fa-plus fa-margin-right" style="color:#02A32C;"></span>New Customer</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="city"><b>Business Name</b> (optional)</label>
                        <input type="text" class="form-control" name="business_name" id="business_name" placeholder="Business Name" value="" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="job_location" class="required"><b>Service Location</b></label>
                        <input type="text" class="form-control" name="service_location" id="service_location"
                                required placeholder="Enter Location"
                                onChange="jQuery('#customer_name').text(jQuery(this).val());"/>
                    </div>
                    <div class="col-md-2">
                        <label for="job_location" class="required"><b>City</b></label>
                        <input type="text" class="form-control" name="customer_city" id="customer_city"
                                required placeholder="Enter City" 
                                onChange="jQuery('#customer_name').text(jQuery(this).val());"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <label for="job_location" class="required"><b>State</b></label>
                        <input type="text" class="form-control" name="customer_state" id="customer_state"
                                required placeholder="Enter State" 
                                onChange="jQuery('#customer_name').text(jQuery(this).val());"/>
                    </div>
                    <div class="col-md-2">
                        <label for="job_location" class="required"><b>Zip Code</b></label>
                        <input type="text" class="form-control" name="customer_zip" id="customer_zip"
                                required placeholder="Enter Zip Code" 
                                onChange="jQuery('#customer_name').text(jQuery(this).val());"/>
                    </div>
                    <div class="col-md-2" style="display: ;">
                        <label for="job_location" class="required"><b>Customer Phone #</b></label>
                        <input type="text" class="form-control" name="customer_phone" id="customer_phone" required placeholder="Enter Phone Number" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="job_name"><b>Service description</b> (optional)</label>
                        <!-- <input type="text" class="form-control" name="job_name" id="job_name" placeholder="Enter Job Name" required/> -->
                        <textarea class="form-control" name="service_description"></textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="city">Service Tag</label><label style="float:right;margin-bottom:10px;"><a class="nsm-button primary" target="_new" href="<?= base_url('job/job_tags'); ?>">Manage Tag</a></label>
                        <select class="form-control" name="job_tag">
                            <?php foreach($tags as $t){ ?>
                                <option value="<?= $t->name; ?>"><?= $t->name; ?></option>
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
                                                required placeholder="Enter Ticket#" a value="<?= $prefix . $next_num; ?>" />
                                    </div>
                                    <div class="col-md-3">
                                        <label for="estimate_date" class="required"><b>Schedule Date</b></label>
                                        <!-- <input type="text" class="form-control" name="estimate_date" id="estimate_date" required placeholder="Enter Estimate Date" autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());" /> -->
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
                                        <!-- <input type="text" class="form-control" name="expiry_date" id="expiry_date" required placeholder="Enter Expiry Date" autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());" /> -->
                                        <!-- <div class="input-group date" data-provide="datepicker">
                                            <input type="text" class="form-control" name="expiry_date" id="expiry_date"
                                                    placeholder="Enter Expiry Date">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-th"></span>
                                            </div>
                                        </div> -->
                                        <input type="text" class="form-control" name="scheduled_time" id="scheduled_time" required />
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
                                        <input type="text" class="form-control" name="scheduled_time_to" id="scheduled_time_to" required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="purchase_order_number"><b>Purchase Order#</b></label>
                                        <input type="text" class="form-control" name="purchase_order_no"
                                            id="purchase_order_no" placeholder="Enter Purchase Order#"
                                            autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());"/>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="zip"><b>Ticket Status</b></label>
                                        <!-- <input type="text" class="form-control" name="ticket_status" id="ticket_status" 
                                            placeholder="Enter Ticket Status"/> -->
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
                                        <label for="purchase_order_number"><b>Assigned Technician</b></label>
                                        <!-- <input type="text" class="form-control" name="assign_tech" id="assign_tech" /> -->
                                        <select class="form-control nsm-field form-select" name="assign_tech[]" id="appointment-user" multiple="multiple" >
                                        </select>
                                    </div>
                                </div>
                                <div class="row" style="background-color:white;">
                                    <div class="col-md-3 form-group">
                                        <label for="zip"><b>Service Type</b></label>
                                        <div class="input-group">
                                            <!-- <select class="form-control" name="service_type" id="service_type">
                                                <?php //foreach($serviceType as $sType){ ?>
                                                    <option value="<?php //echo $sType->service_name; ?>"><?php //echo $sType->service_name; ?></option> -->
                                                <?php //} ?>
                                            <!-- </select> -->
                                            <select id="service_type" name="service_type" class="form-control">
                                                <option value="Services">Services</option>
                                                <option value="Event">Event</option>
                                                <option value="Estimate">Estimate</option>
                                                <option value="Job">Job</option>
                                            </select>
                                            <!-- <span class="input-group-btn">
                                                <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addServiceType">Add New</a>
                                            </span> -->
                                        </div><!-- /input-group -->
                                    </div>
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
                                        <!-- <input type="text" class="form-control" name="scheduled_time" id="employeeID" /> -->
                                        <select class="form-control mb-3" name="employee_id">
                                            <option value="0">Select Name</option>
                                            <?php foreach($users_lists as $ulist){ ?>
                                                <option <?php if($ulist->id == logged('id')){ echo "selected";} ?> value="<?php echo $ulist->id ?>"><?php echo $ulist->FName .' '.$ulist->LName; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="zip"><b>Job Description</b></label>
                                        <textarea class="form-control" name="job_description"></textarea>
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
                                            <input type="hidden" name="count" value="0" id="count">
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
                                            <!-- <tr style="display:;">
                                                <td width="30%">
                                                    <input type="text" class="form-control getItems"
                                                        onKeyup="getItems(this)" name="items[]">
                                                    <ul class="suggestions"></ul>
                                                    <div class="show_mobile_view"><span class="getItems_hidden"></span></div>
                                                    <input type="hidden" name="item_id[]" id="itemid" class="itemid" value="0">
                                                    <input type="hidden" name="packageID[]" value="0">
                                                </td>
                                                <td width="20%">
                                                <div class="dropdown-wrapper">
                                                    <select name="item_type[]" id="item_typeid" class="form-control">
                                                        <option value="product">Product</option>
                                                        <option value="material">Material</option>
                                                        <option value="service">Service</option>
                                                        <option value="fee">Fee</option>
                                                    </select>
                                                </div>

                                                    </td>
                                                <td width="10%"><input type="number" class="form-control quantity mobile_qty" name="quantity[]"
                                                        data-counter="0" id="quantity_0" value="1"></td>
                                                <td width="10%"><input type="text" class="form-control price price hidden_mobile_view" name="price[]"
                                                        data-counter="0" id="price_0" min="0" value="0"> <input type="hidden" class="priceqty" id="priceqty_0" value="0"> 
                                                        <div class="show_mobile_view">
                                                        </div><input id="priceM_qty0" value="0"  type="hidden" name="price_qty[]" class="form-control hidden_mobile_view price_qty"></td>
                                                <td width="10%" class="hidden_mobile_view"><input type="number" class="form-control discount" name="discount[]"
                                                        data-counter="0" id="discount_0" min="0" value="0"></td>
                                                <td width="10%" class="hidden_mobile_view"><input type="text" class="form-control tax_change" name="tax[]"
                                                        data-counter="0" id="tax1_0" min="0" value="0" >
                                                        </td>
                                                <td width="10%" class="hidden_mobile_view"><input type="hidden" class="form-control " name="total[]"
                                                        data-counter="0" id="item_total_0" min="0" value="0">
                                                        $<span id="span_total_0">0.00</span></td>
                                                <td><a href="#" class="remove btn btn-sm btn-danger" id="0"><i class="fa fa-trash" aria-hidden="true"></i>Remove</a></td>
                                            </tr> -->
                                            </tbody>
                                        </table>
                                        <a class="link-modal-open" href="#" id="add_another_items" data-toggle="modal" data-target="#item_list"><span class="fa fa-plus-square fa-margin-right"></span>Add Items</a> &emsp;
                                        <span class="link-modal-open nsm-link" id="createNewItem" style="border:solid white 1px;background-color:white;"><span class="fa fa-plus-square fa-margin-right"></span> Create New Item</span>
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
                                                <td colspan="2" align="right"><span id="span_sub_total_invoice">0.00</span> <input type="hidden" name="subtotal" id="item_total"></td>
                                            </tr>
                                            <tr>
                                                <td>Taxes</td>
                                                <!-- <td></td> -->
                                                <td colspan="2" align="right">$ <span id="total_tax_">0.00</span><input type="hidden" name="taxes" id="total_tax_input"></td>
                                            </tr>
                                            <tr>
                                                <td style="width:250px;"><input type="text" class="form-control" placeholder="Adjustment" name="adjustment"></td>
                                                <td style="width:150px;"><input type="number"  class="form-control adjustment_input" name="adjustment_value" id="adjustment_input" value="0"></td>
                                                <td align="right">0.00</td>
                                            </tr>
                                            <tr>
                                                <td>Markup</td>
                                                <td><a href="#" style="color:#02A32C;">set markup</a></td>
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
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <div class="select-wrap">
                                            <b>Payment Method</b>
                                                <select name="payment_method" id="payment_method" class="form-control">
                                                    <!-- <option value="">Choose method</option> -->
                                                    <option value="Cash">Cash</option>
                                                    <option value="Check">Check</option>
                                                    <option value="Credit Card">Credit Card</option>
                                                    <option value="Debit Card">Debit Card</option>
                                                    <option value="ACH">ACH</option>
                                                    <option value="Venmo">Venmo</option>
                                                    <option value="Paypal">Paypal</option>
                                                    <option value="Square">Square</option>
                                                    <option value="Invoicing">Invoicing</option>
                                                    <option value="Warranty Work">Warranty Work</option>
                                                    <option value="Home Owner Financing">Home Owner Financing</option>
                                                    <option value="e-Transfer">e-Transfer</option>
                                                    <option value="Other Credit Card Professor">Other Credit Card Professor</option>
                                                    <option value="Other Payment Type">Other Payment Type</option>
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
                                        <input type="hidden" name="sales_rep" class="form-control" value="<?php echo logged('id'); ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <b>Cell Phone</b>
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
                                            <label><h6>Instructions: </h6></label><br> <span class="help help-sm help-block">Optional internal notes, will not appear to customer</span>
                                            <textarea name="instructions" cols="40" rows="2" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
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
                                <div class="row" style="background-color:white;">
                                    <div class="col-md-6">
                                        <label for="billing_date"><h6>Attachments</h6></label><br> 
                                        <span class="help help-sm help-block">Optionally attach files to this invoice. Allowed type: pdf, doc, dock, png, jpg, gif</span>
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
                                        <a href="<?php echo url('customer/ticketslist') ?>" class="nsm-button default" style="padding: 9px;">Cancel</a>
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
                                            <td> Qty</td>
                                            <td> Price</td>
                                            <td> Action</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($items as $item){ // print_r($item);
                                                $item_qty = get_total_item_qty($item->id);    
                                        ?>
                                            <tr id="<?php echo "ITEMLIST_PRODUCT_$item->id"; ?>">
                                                    <td style="width: 0% !important;">
                                                        <button type="button"  data-dismiss="modal" class='btn btn-sm btn-light border-1 select_item2a' id="<?= $item->id; ?>" data-item_type="<?= ucfirst($item->type); ?>" data-quantity="<?= $item_qty[0]->total_qty; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>" data-location_name="<?= $item->location_name; ?>" data-location_id="<?= $item->location_id; ?>"><i class='bx bx-plus-medical'></i></button>
                                                    </td>
                                                    <td><?php echo $item->title; ?></td>
                                                    <td><?php echo $item_qty[0]->total_qty > 0 ? $item_qty[0]->total_qty : "0"; ?></td>
                                                    <td><?php echo $item->price; ?></td>
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

<?php //echo $file_selection; ?>

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
    
    $('#sel-customer_t').select2({         
        minimumInputLength: 0        
    });
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
            // console.log(response);
            // console.log(response.data);
            //  alert('success');
             // console.log(response['customer']);
         // $("#job_location").val(response['customer'].mail_add + ' ' + response['customer'].cross_street + ' ' + response['customer'].city + ' ' + response['customer'].state + ' ' + response['customer'].country);

         // var phone = response['customer'].phone_h;
         // var new_phone = phone.value.replace(/(\d{3})\-?/g,'$1-');
         var phone = response['customer'].phone_h;
             // phone = normalize(phone);
         
         var mobile = response['customer'].phone_m;
             // mobile = normalize(mobile);

        //  var test_p = phone.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3")
        //  var test_m = mobile.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3")
         
         $("#service_location").val(response['customer'].mail_add);
         $("#customer_city").val(response['customer'].city);
         $("#customer_state").val(response['customer'].state);
         $("#customer_zip").val(response['customer'].zip_code);
         $("#customer_phone").val(response['customer'].phone_h +' '+ response['customer'].phone_m);
         $("#business_name").val(response['customer'].business_name);
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
  timeFormat: 'h:mm a',
  interval: 30,
  minTime: '8',
  maxTime: '11:00 PM',
  startTime: '8:00 AM',
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
    CKEDITOR.replace('editor');
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
            calculate_subtotal();
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