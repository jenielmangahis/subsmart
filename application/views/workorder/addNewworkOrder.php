<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
<?php include viewPath('includes/sidebars/workorder'); ?>
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
    .pointer {cursor: pointer;}
   </style>
    <!-- page wrapper start -->
    <div wrapper__section style="padding-left:1%;padding-top:2.5%;">
        <div class="container-fluid" style="background-color:white;">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3>New Work Orders</h3>
                        <!-- <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Manage workorders.</li>
                        </ol> -->
                    </div>
                </div>
            </div>
            <!-- end row -->
            <?php echo form_open_multipart('accounting/savenewWorkOrder', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>  

            <div class="row" style="margin-top:-30px;">
                <div class="col-xl-12">
                    <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title mb-5">Header</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <ol class="breadcrumb" style="margin-top:-30px;">
                                    <li class="breadcrumb-item active">This workorder agreement (the "agreement") is made as of 02-13-2021, by and between NSMARTRAC, (the "Company") and the ("Customer") as the address shown below (the "Premise/Service Location)</li>
                                </ol>
                            </div>
                        </div>
                        <br>

                        <div class="row">                   
                            <div class="col-md-3 form-group">
                                <label for="contact_name">Work Order #</label>
                                <input type="text" class="form-control" name="contact_name" id="contact_name" required autofocus />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="contact_email">Select Customer</label><label style="float:right;color:green;"><i class="fa fa-plus-square" aria-hidden="true"></i> New Customer</label>
                                <select id="sel-customer" name="customer_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                        <option value="0">- none -</option>
                                        <?php foreach($customers as $c){ ?>
                                            <option value="<?= $c->prof_id; ?>"><?= $c->first_name . ' ' . $c->last_name; ?></option>
                                        <?php } ?>
                                    </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="security_number">Security Number</label>
                                <input type="text" class="form-control" name="security_number" id="security_number" placeholder="xxx-xx-xxxx" required/>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="birthdate">Birth Date</label>
                                <input type="text" class="form-control" name="birthdate" id="date_of_birth" required/>
                            </div>
                        </div>
                        <div class="row">                   
                            <div class="col-md-3 form-group">
                                <label for="phone_no">Phone Number</label>
                                <input type="text" class="form-control" name="phone_no" id="phone_no" required  />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="mobile_no">Mobile Number</label>
                                <input type="text" class="form-control" name="mobile_no" id="mobile_no" required  />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" required  />
                            </div>
                        </div>
                        
                        <!-- end row -->
                        <div class="row">                    
                            <div class="col-md-4 form-group">
                                <label for="job_location">Job Location</label>
                                <!-- <label style="float:right;color:green;"><i class="fa fa-plus-square" aria-hidden="true"></i> New Location</label> -->
                                <input type="text" class="form-control" name="job_location" id="job_location" required/>
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="city">
                                    City
                                </label>
                                    <input type="text" class="form-control" name="city" id="city" />
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="state">
                                    State
                                </label>
                                    <input type="text" class="form-control" name="state" id="state" />
                            </div>
                            <div class="col-md-1 form-group">
                                <label for="zip">
                                    Zip code
                                </label>
                                    <input type="text" class="form-control" name="zip" id="zip" />
                            </div>
                            
                            <div class="col-md-3 form-group">
                                <label for="cross_street">
                                    Cross Street
                                </label>
                                    <input type="text" class="form-control" name="cross_street" id="cross_street" />
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="">Customer Type</label><br/>
                                <label class="radio-inline">
                                <input type="radio" name="customer_type" value="Residential" checked>Residential
                                </label>
                                <label class="radio-inline">
                                <input type="radio" name="customer_type" value="Commercial">Commercial
                                </label>
                            </div>
                        </div> 
                        <div class="row">
                        </div>-->

                        <div class="row">                   
                            <div class="col-md-4 form-group">
                                <label for="contact_phone">Password</label> <i class="fa fa-pencil" aria-hidden="true" ></i>
                                <input type="text" class="form-control" name="contact_phone" id="contact_phone" placeholder="Password" />
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="suit">Custom Field</label> <i class="fa fa-pencil" aria-hidden="true"></i>
                                <input type="text" class="form-control" name="suit" id="suit"/>
                            </div>
                        </div>
                        <div class="row">     
                            <div class="col-md-4 form-group">
                                <label for="suit">Custom Field</label> <i class="fa fa-pencil" aria-hidden="true"></i>
                                <input type="text" class="form-control" name="suit" id="suit"/>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="suit">Custom Field</label> <i class="fa fa-pencil" aria-hidden="true"></i>
                                <input type="text" class="form-control" name="suit" id="suit"/>
                            </div>
                        </div>
                        <div class="row">     
                            <div class="col-md-4 form-group">
                                <label for="suit">Custom Field</label> <i class="fa fa-pencil" aria-hidden="true"></i>
                                <input type="text" class="form-control" name="suit" id="suit"/>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="suit">Custom Field</label> <i class="fa fa-pencil" aria-hidden="true"></i>
                                <input type="text" class="form-control" name="suit" id="suit"/>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-md-4 form-group">
                                    <label for="state">State/Province</label>
                                    <select name="state" id="state" class="form-control">
                                        <option value="">Select</option>
                                        <?php foreach($states as $key=>$val) { ?>

                                        <option value="<?php echo $key?>"><?php echo $val;?></option>
                                        <?php }?>
                                    </select>
                            </div>                    
                        </div> -->
                        <!-- <div class="row">
                            <div class=" col-md-9">
                                <div class="work_nore">
                                    <h6>Work Order Items</h6>
                                    <p> You can set up the products or services for this work order. </p>
                                    <p><strong class="red">Note: prices will not be shown to the assigned employees but only to you. </strong></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Show qty as:</label>
                                <select class="custom-select form-control">
                                    <option>Quanity</option>
                                </select>
                            </div>
                        </div><br/> -->
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
                        <br>
                            <!-- <div class="row">
                                <div class="col-md-12">
                                <table class="table table-hover">
                                    <input type="hidden" name="count" value="0" id="count">
                                    <thead  style="background-color:#E9E8EA;">
                                        <tr>
                                            <th><b>Work Order Items</b></th>
                                            <th><b>Quantity</b></th>
                                            <th><b>Price</b></th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_body_work">
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" name="item[]">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control quantity" name="quantity[]" data-counter="0" id="quantity_0" value="1">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control price" name="price[]" data-counter="0" id="price_0" min="0" value="0">
                                            </td>
                                        </tr>                
                                    </tbody>
                                    </table>
                                    <a href="#" id="add_another_workOr" style="color:green;"><i class="fa fa-plus-square" aria-hidden="true"></i> Add Items</a>                                        
                                </div>
                            </div> -->
                            <div class="row" id="plansItemDiv" style="background-color:white;">
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-hover">
                                        <input type="hidden" name="count" value="0" id="count">
                                        <thead style="background-color:#E9E8EA;">
                                        <tr>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <!-- <th>Description</th> -->
                                            <th width="150px">Quantity</th>
                                            <!-- <th>Location</th> -->
                                            <th width="150px">Price</th>
                                            <th width="150px">Discount</th>
                                            <th width="150px">Tax (Change in %)</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody id="jobs_items_table_body">
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control getItems"
                                                       onKeyup="getItems(this)" name="items[]">
                                                <ul class="suggestions"></ul>
                                            </td>
                                            <td><select name="item_type[]" class="form-control">
                                                    <option value="product">Product</option>
                                                    <option value="material">Material</option>
                                                    <option value="service">Service</option>
                                                    <option value="fee">Fee</option>
                                                </select></td>
                                            <!-- <td> -->
                                                <!-- <input type="text" class="form-control getItems"
                                                       onKeyup="getItems(this)" name="desc[]">
                                                <ul class="suggestions"></ul> -->
                                                <!-- <input type="text" class="form-control" name="desc[]"> -->
                                            <!-- </td> -->
                                            <td width="150px"><input type="number" class="form-control quantity" name="quantity[]"
                                                       data-counter="0" id="quantity_0" value="1"></td>
                                            <!-- <td><input type="text" class="form-control" name="location[]"></td> -->
                                            <td width="150px"><input type="number" class="form-control price" name="price[]"
                                                       data-counter="0" id="price_0" min="0" value="0"></td>
                                            <td width="150px"><input type="number" class="form-control discount" name="discount[]"
                                                       data-counter="0" id="discount_0" min="0" value="0" ></td>
                                            <td width="150px"><input type="text" class="form-control tax_change" name="tax[]"
                                                       data-counter="0" id="tax1_0" min="0" value="0">
                                                       <!-- <span id="span_tax_0">0.0</span> -->
                                                       </td>
                                            <td width="150px"><input type="hidden" class="form-control " name="total[]"
                                                       data-counter="0" id="item_total_0" min="0" value="0">
                                                       $<span id="span_total_0">0.00</span></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!-- <a href="#" id="add_another_estimate" style="color:#02A32C;"><i class="fa fa-plus-square" aria-hidden="true"></i> Add another line</a> &emsp; -->
                                    <!-- <a href="#" id="add_another" style="color:#02A32C;"><i class="fa fa-plus-square" aria-hidden="true"></i> Add Items in bulk</a> -->
                                    <a class="link-modal-open" href="#" id="add_another_items" data-toggle="modal" data-target="#item_list"><span class="fa fa-plus-square fa-margin-right"></span>Add Items</a>
                                    <hr>
                                </div>
                            </div>
                            <!-- <div class="row" style="background-color:white;font-size:16px;">
                                <div class="col-md-7">
                                </div>
                                <div class="col-md-5">
                                    <table class="table" style="text-align:left;">
                                        <tr>
                                            <td>Subtotal</td>
                                            <td></td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td>Taxes</td>
                                            <td></td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td>Adjustments</td>
                                            <td></td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td>Deposited Collected</td>
                                            <td></td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td><b>Grand Total</b></td>
                                            <td></td>
                                            <td><b>0.00</b></td>
                                        </tr>
                                    </table>
                                </div>
                            </div> -->
                            <div class="row" style="background-color:white;font-size:16px;">
                                <div class="col-md-7">
                                </div>
                                <div class="col-md-5">
                                    <table class="table" style="text-align:left;">
                                        <tr>
                                            <td>Subtotal</td>
                                            <td></td>
                                            <td>$ <span id="span_sub_total_invoice">0.00</span>
                                                <input type="hidden" name="sub_total" id="item_total"></td>
                                        </tr>
                                        <tr>
                                            <td>Taxes</td>
                                            <td></td>
                                            <td>$ <span id="total_tax_">0.00</span><input type="hidden" name="total_tax_" id="total_tax_input"></td>
                                        </tr>
                                        <tr>
                                            <td style="width:250px;"><input type="text" name="adjustment_name" id="adjustment_name" placeholder="Adjustment Name" class="form-control" style="width:200px; display:inline; border: 1px dashed #d1d1d1"></td>
                                            <td style="width:150px;">
                                            <input type="number" name="adjustment_input" id="adjustment_input" value="0" class="form-control adjustment_input" style="width:100px; display:inline-block">
                                                <span class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Optional it allows you to adjust the total amount Eg. +10 or -10." data-original-title="" title=""></span>
                                            </td>
                                            <td>0.00</td>
                                        </tr>
                                        <!-- <tr>
                                            <td>Markup $<span id="span_markup"></td> -->
                                            <!-- <td><a href="#" data-toggle="modal" data-target="#modalSetMarkup" style="color:#02A32C;">set markup</a></td> -->
                                            <input type="hidden" name="markup_input_form" id="markup_input_form" class="markup_input" value="0">
                                        <!-- </tr> -->
                                        <tr>
                                            <td>Voucher</td>
                                            <td></td>
                                            <td><span id="offer_cost">0.00</span><input type="hidden" name="offer_cost" id="offer_cost_input"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Grand Total ($)</b></td>
                                            <td></td>
                                            <td><b><span id="grand_total">0.00</span>
                                                <input type="hidden" name="grand_total" id="grand_total_input" value='0'></b></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class=" col-md-9">
                                    <div class="work_nore">
                                        <h6>Checklist</h6>
                                        <p> You can set up a checklist for employees. </p>
                                        
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#checklistModal">+Select Checklist</button>
                                    </div>
                                </div>
                            </div>
                            <?php if(count($users) > 0) { ?>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <h6>Assign To <span>(Optional)</span></h6>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="checbox_lable">                                      
                                            <?php //foreach($users as $row) { ?>

                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="<?php e//cho $row->id;?>" name="assign_to[]" value="<?php //echo $row->id;?>"><?php// echo ucfirst($row->name);?>
                                                </label> 
                                            <?php }?> 
                                        </div>
                                    </div>
                                </div>                       
                            <?php //}?>    -->
                            <br><br>
                            <div class="row">                        
                                <div class="form-group col-md-4">
                                    <label for="start_date">Enter an offer code</label>
                                    <input type="text" class="form-control" name="offer_code" id="offer_code" />
                                    
                                    <div class="invalid_code" style="display:none;">
                                        <b style="color:red;">Invalid Code. Please check your code.</b>
                                    </div>  
                                    
                                </div>    
                                <div class="form-group col-md-4">
                                    <br><a class="btn btn-success validate_offer">VALIDATE</a>
                                </div>   
                                                                   
                            </div>
                            
                            <h6>JOB DETAIL</h6><br>
                            
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="Job Tag">Job Tag</label><label style="float:right;color:green;">Manage Tag</label>
                                <!-- <input type="text" class="form-control" name="city" id="city" placeholder="Enter City"/> -->
                                <select class="form-control">
                                            <option>---</option>
                                </select>
                            </div>
                        </div>
                            <!-- <div class="row">                        
                                <div class="form-group col-md-4">
                                    <label for="start_date">Date Issued</label>
                                    <input type="text" class="form-control" name="start_date" id="start_date" />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="start_time">Job Type</label>
                                    <select class="form-control" name="start_time">
                                    </select>
                                </div>                                           
                            </div>
                            <div class="row">                        
                                <div class="form-group col-md-4">
                                    <label for="end_date">Job Name</label>
                                    <input type="text" class="form-control" name="end_date" id="end_date" />
                                </div>                                         
                            </div>
                            <div class="row">  
                                <div class="form-group col-md-4">
                                    <label for="end_time">Job Description</label>
                                    <input type="text" class="form-control" name="end_time" id="end_time" />
                                </div>                                           
                            </div>
                            <div class="row">                        
                                <div class="form-group col-md-4">
                                    <label>Customer Reminder Notification</label>
                                    <select name="custom_reminder" id="custom_reminder" class="form-control custom-select">
                                        <option value="">None</option>
                                        <option value="5M">5 minutes before</option>
                                        <option value="15M">15 minutes before</option>
                                        <option value="30M">30 minutes before</option>
                                        <option value="1H">1 hour before</option>
                                        <option value="2H">2 hours before</option>
                                        <option value="4H">4 hours before</option>
                                        <option value="6H">6 hours before</option>
                                        <option value="8H">8 hours before</option>
                                        <option value="2H">12 hours before</option>
                                        <option value="16H">16 hours before</option>
                                        <option value="1D">1 day before</option>
                                        <option value="2D">2 days before</option>                   
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Event Color</label>
                                    <div class="color_checkbox p-0">
                                        <input type="color" class="form-control" name="event_color" id="event_color" style="width: 85%;height: 30px !important;padding: 2px;"/>
                                    </div>
                                </div>                                           
                            </div> -->
                            <div class="row">                        
                                <div class="form-group col-md-4">
                                    <label for="contact_name">Schedule Date Given</label>
                                    <input type="text" class="form-control" name="date_issued" id="date_issued" required />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="job_type">Job Type</label>
                                    <select name="job_type" id="job_type" class="form-control custom-select">
                                        <option value="Service">Service</option>
                                        <option value="Design">Design</option>
                                        <option value="Maintenance">Maintenance</option>
                                        <option value="Repair">Repair</option>
                                        <option value="Replace">Replace</option>
                                    </select>
                                </div>                                           
                            </div>
                            <div class="row">                        
                                <div class="form-group col-md-4">
                                    <label for="job_name">Job Name</label>
                                    <input type="text" class="form-control" name="job_name" id="job_name" required />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="job_desc">Job Description</label>
                                    <textarea name="job_desc" id="job_desc" cols="5" rows="2" class="form-control"></textarea> 
                                </div>                                           
                            </div>

                            <h6>PAYMENT DETAIL</h6><br>
                            <div class="row">                   
                                <div class="form-group col-md-4">
                                    <label for="job_type">Method</label>
                                    <select name="job_type" id="job_type" class="form-control custom-select">
                                        <option value="">Choose method</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Check">Check</option>
                                        <option value="Credit Card">Credit Card</option>
                                    </select>
                                </div>      
                                <div class="form-group col-md-4">
                                    <label for="job_type">Amount</label><small class="help help-sm"> ( $ )</small>
                                    <input type="text" class="form-control" name="pay_amount" id="pay_amount" required />
                                </div>                                       
                            </div>
                            <div class="row">                   
                                <div class="form-group col-md-4">
                                    <label for="job_type">Account Holder Name</label>
                                    <input type="text" class="form-control" name="pay_amount" id="pay_amount" required />
                                </div>      
                                <div class="form-group col-md-4">
                                    <label for="job_type">Account Number</label>
                                    <input type="text" class="form-control" name="pay_amount" id="pay_amount" placeholder="**** **** **** **** " required />
                                </div>                                       
                            </div>
                            <div class="row">                   
                                <div class="form-group col-md-4">
                                    <label for="job_type">Expiry</label>
                                    <input type="text" class="form-control" name="pay_amount" id="pay_amount" placeholder="MM/YY" required />
                                </div>      
                                <div class="form-group col-md-4">
                                    <label for="job_type">CVC</label>
                                    <input type="text" class="form-control" name="pay_amount" id="pay_amount" placeholder="CVC" required />
                                </div>                                       
                            </div>

                            <!-- ====== TERMS AND CONDITIONS ====== -->
                            <br><br><br>
                            <div class="row">
                                <div class=" col-md-12">
                                <label style="font-weight:bold;font-size:18px;">TERMS AND CONDITIONS</label><label style="float:right;color:green;"><a href="#" style="color:green;">Update Terms and Condition</a></label>
                                    <div style="height:200px; overflow:auto; background:#FFFFFF;"
                                         id="showuploadagreement">
                                        <p>2. Install of the system. Company agrees to schedule and install an alarm
                                            system and/or devices in connection with a Monitoring Agreement which
                                            customer will receive at the time of installation. Customer hereby agrees to
                                            buy the system/devices described below and incorporated herein for all
                                            purposes by this reference (the “System /Services”), in accordance with the
                                            terms and conditions set forth. IF CUSTOMER FAIL TO FULLFILL THE MONITORING
                                            AGREEMENT, Customer agrees to pay the consultation fee, the cost of the
                                            system and recovering fees.</p>
                                        <p>3. Customer agrees to have system maintained for an initial term of 60 months
                                            at the above monthly rate in exchange for a reduced cost of the system. Upon
                                            the execution of this agreement shall automatically start the billing
                                            process. Customer understands that the monthly payments must be paid through
                                            “Direct Billing” through their banking institution or credit card. Customers
                                            acknowledge that they authorize Company to obtain a Security System.
                                            Residential Clients: CUSTOMER HAS THE RIGHT TO CANCEL THIS TRANSACTION at
                                            any time prior to midnight on the 3rd business day after the above date of
                                            this work order in writing. Customer agrees that no verbal method is valid,
                                            and must be submitted only in writing. The date on this agreement is the
                                            agreed upon date for both the Company and the Customer</p>
                                        <p>4. Client verifies that they are owners of the property listed above. In the
                                            event the system has to be removed, Client agrees and understands that there
                                            will be an additional $299.00 restocking/removal fee and early termination
                                            fees will apply.</p>
                                        <p>5. Client understands that this is a new Monitoring Agreement through our
                                            central station. Alarm.com or .net is not affiliated nor has any bearing on
                                            the current monitoring services currently or previously initiated by Client
                                            with other alarm companies. By signing this work order, Client agrees and
                                            understands that they have read the above requirements and would like to
                                            take advantage of our services. Client understand that is a binding
                                            agreement for both party.</p>
                                        <p>6. Customer agrees that the system is preprogramed for each specific
                                            location. accordance with the terms and conditions set forth. IF CUSTOMER
                                            FAIL TO FULLFILL THE MONITORING AGREEMENT, Customer agrees to pay the
                                            consultation fee, the cost of the system and recovering fees. Customer
                                            agrees that this is a customized order. By signing this workorder, customer
                                            agrees that customized order can not be cancelled after three day of this
                                            signed document.</p>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">                        
                                <div class="form-group col-md-4">
                                    <label for="workorder_status">Status</label>
                                    <select name="workorder_status" id="workorder_status" class="form-control custom-select">
                                        <option value="New">New</option>
                                        <option value="Scheduled">Scheduled</option>
                                        <option value="Started">Started</option>
                                        <option value="Paused">Paused</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Invoiced">Invoiced</option>
                                        <option value="Withdrawn">Withdrawn</option>
                                        <option value="Closed">Closed</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="workorder_priority">Priority</label>
                                    <select name="workorder_priority" id="workorder_priority" class="form-control custom-select">
                                        <option value="Emergency">Emergency</option>
                                        <option value="Low">Low</option>
                                        <option value="Standard">Standard</option>
                                        <option value="Urgent">Urgent</option>                
                                    </select>
                                </div>                                           
                            </div>
                            

                            <div class="row">                        
                                <div class="form-group col-md-4">
                                    <label for="purchase_order">Purchase Order# (optional)</label>
                                    <input type="text" class="form-control" name="purchase_order" id="purchase_order" /> 
                                </div>                                        
                            </div>

                            <!-- ====== TERMS OF USE ====== -->
                            <div class="row">
                                <div class=" col-md-12">
                                    <label style="font-weight:bold;font-size:18px;">TERMS OF USE</label><label style="float:right;color:green;"><a href="#" style="color:green;">Update Terms of Use</a></label>
                                    <div style="height:100px; overflow:auto; background:#FFFFFF; padding-left:10px;"
                                         id="showuploadagreement">
                                         **This isn't everything... just a summary**</strong> You may CANCEL this
                                        transaction, within THREE BUSINESS DAYS from the above date. If You cancel, You
                                        must make available to US in substantially as good condition as when received,
                                        any goods delivered to You under this contract or sale, You may, if You wish,
                                        comply with Our instructions regarding the return shipment of the goods at Your
                                        expense and risk. To cancel this transaction, mail deliver a signed and
                                        postmarket, dated copy of this Notice of Cancellation or any other written
                                        notice to ALarm Direct, Inc., 6866 Pine Forest ROad, Suite B, Pensacola, FL
                                        32526. NOT LATER THAN MIDNIGHT OF {Date plus 3 business days}
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">        
                                <div class="form-group col-md-4">
                                    <label for="instructions">Instructions</label>
                                    <textarea name="instructions" id="instructions" cols="5" rows="2" class="form-control"></textarea>
                                </div>                                           
                            </div>

                             <!-- ====== SIGNATURE ====== -->
                            <div class="row">
                                <div class=" col-md-12">
                                    <div class="work_nore">
                                        <h6>Signature</h6>
                                        <p> By Signing below you verify that the above information is true and complete,
                                            and you authorize payment and confirmation with nSmarTrac. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class=" col-md-4">
                                    <h6>Company Representative Approval</h6>
                                    <div class="sigPad" id="smoothed1a" style="width:100%;border:solid gray 1px;">
                                    <!-- <a href="#" style="float:right;margin-right:10px;" class="smoothed1a_pencil" id="smoothed1a_pencil"><i class="fa fa-pencil" aria-hidden="true"></i></a> -->
                                        <ul class="sigNav">
                                            <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                            <li class="clearButton"><a href="#clear">Clear</a></li>
                                        </ul>
                                        <ul class="edit">
                                            <li class="smoothed1a_pencil pointer"><a onclick="myFunction()" style="float:right;margin-right:10px;" class="smoothed1a_pencil"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                        </ul>
                                        <div class="sig sigWrapper" id="smoothed1a_pencil" style="height:auto;pointer-events: none;">
                                            <div class="typed"></div>
                                            <canvas class="pad" id="company_representative_approval_signature1a"
                                                    width="400" height="250"></canvas>
                                            <input type="hidden" name="output-2" class="output">
                                        </div>
                                    </div>
                                    <input type="hidden" id="saveCompanySignatureDB1a"
                                           name="company_representative_approval_signature1a">
                                    <br>

                                    <label for="comp_rep_approval">Printed Name</label>
                                    <input type="text6" class="form-control mb-3"
                                           name="company_representative_printed_name"
                                           id="comp_rep_approval" placeholder=""/>

                                </div>
                                <div class=" col-md-4">
                                    <h6>Primary Account Holder</h6>
                                    <div class="sigPad" id="smoothed2a" style="width:100%;border:solid gray 1px;">
                                    <!-- <p style="float:right;margin-right:10px;"><i class="fa fa-pencil" aria-hidden="true"></i></p> -->
                                        <ul class="sigNav">
                                            <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                            <li class="clearButton"><a href="#clear">Clear</a></li>
                                        </ul>
                                        <ul class="edit">
                                            <li class="smoothed1a_pencil pointer"><a onclick="myFunctiontwo()" style="float:right;margin-right:10px;" class="smoothed1a_pencil"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                        </ul>
                                        <div class="sig sigWrapper" style="height:auto;pointer-events: none;">
                                            <div class="typed"></div>
                                            <canvas class="pad" id="primary_account_holder_signature2a" width="400"
                                                    height="250"></canvas>
                                            <input type="hidden" name="output-2" class="output">
                                        </div>
                                    </div>
                                    <input type="hidden" id="savePrimaryAccountSignatureDB2a"
                                           name="primary_account_holder_signature2a">
                                    <br>

                                    <label for="comp_rep_approval">Printed Name</label>
                                    <input type="text6" class="form-control mb-3" name="primary_account_holder_name"
                                           id="comp_rep_approval" placeholder=""/>

                                </div>
                                <div class=" col-md-4">
                                    <h6>Secondary Account Holder</h6>
                                    <div class="sigPad" id="smoothed3a" style="width:100%;border:solid gray 1px;">
                                    <!-- <p style="float:right;margin-right:10px;"><i class="fa fa-pencil" aria-hidden="true"></i></p> -->
                                        <ul class="sigNav">
                                            <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                            <li class="clearButton"><a href="#clear">Clear</a></li>
                                        </ul>
                                        <ul class="edit">
                                            <li class="smoothed1a_pencil pointer"><a onclick="myFunctionthree()" style="float:right;margin-right:10px;" class="smoothed1a_pencil"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                        </ul>
                                        <div class="sig sigWrapper" style="height:auto;pointer-events: none;">
                                            <div class="typed"></div>
                                            <canvas class="pad" id="secondary_account_holder_signature3a" width="400"
                                                    height="250"></canvas>
                                            <input type="hidden" name="output-2" class="output">
                                        </div>
                                    </div>
                                    <input type="hidden" id="saveSecondaryAccountSignatureDB3a"
                                           name="secondary_account_holder_signature3a">
                                    <br>

                                    <label for="comp_rep_approval">Printed Name</label>
                                    <input type="text6" class="form-control mb-3" name="secondery_account_holder_name"
                                           id="comp_rep_approval" placeholder=""/>

                                </div>
                            </div>


                            <div class="row" style="margin-top:80px;">                        
                                <div class="form-group col-md-4">
                                    <label for="attachment">Attach Photo</label>
                                    <!-- <p style="font-weight: 10;">Optionally attach files to this work order. Allowed type: pdf, doc, docx, png, jpg, gif.</p> -->
                                    <input type="file" class="form-control" name="attachment" id="attachment">
                                </div>                                                                
                            </div>
                            <div class="row">                        
                                <div class="form-group col-md-4">
                                    <label for="attachment">Document Links</label>
                                    <!-- <p style="font-weight: 10;">Optionally attach files to this work order. Allowed type: pdf, doc, docx, png, jpg, gif.</p> -->
                                    <input type="file" class="form-control" name="attachment" id="attachment">
                                </div>                                                                
                            </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <button type="submit" class="btn btn-flat btn-success">Submit</button>
                                <button type="submit" class="btn btn-flat btn-success">Preview</button>
                                <button type="submit" class="btn btn-flat btn-success" style="background-color: #32243d !important"><b>Save Template</b></button>
                                <a href="<?php echo url('workorder') ?>" class="btn ">Cancel this</a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <div class="modal fade" id="checklistModal" role="dialog">
                        <div class="modal-dialog">            
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Select Checklists</h4>
                            </div>
                            <div class="modal-body">
                            <p></p>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Add Selected</button>
                            </div>
                        </div>                
                    </div>
                </div>

            <?php echo form_close(); ?>

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

            <!-- Modal -->
            <div class="modal fade" id="item_list" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document" style="width:800px;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
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
                                    <table id="items_table_estimate" class="table table-hover" style="width: 100%;">
                                        <thead>
                                        <tr>
                                            <td> Name</td>
                                            <td> Qty</td>
                                            <td> Price</td>
                                            <td> Action</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($items as $item){ // print_r($item); ?>
                                            <tr>
                                                <td><?php echo $item->title; ?></td>
                                                <td></td>
                                                <td><?php echo $item->price; ?></td>
                                                <td><button id="<?= $item->id; ?>" data-quantity="<?= $item->units; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>" type="button" data-dismiss="modal" class="btn btn-sm btn-default select_item">
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

            <!-- Modal New Customer -->
            <div class="modal fade" id="modalNewCustomer" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Customer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body pt-0 pl-3 pb-3"></div>
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
                            <h5 class="modal-title" id="exampleModalLabel">Add New Source</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="frm_add_new_source" name="modal-form" method="post">
                                <div class="validation-error" style="display: none;"></div>
                                <div class="form-group">
                                    <label>Source Name</label> <span class="form-required">*</span>
                                    <input type="text" name="title" value="" class="form-control"
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
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<script>

    document.getElementById('contact_mobile').addEventListener('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });
    document.getElementById('contact_phone').addEventListener('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });

    function validatecard() {
        var inputtxt = $('.card-number').val();

        if (inputtxt == 4242424242424242) {
            $('.require-validation').submit();
        } else {
            alert("Not a valid card number!");
            return false;
        }
    }
</script>

<script>

$(document).ready(function(){
 
    $('#sel-customer').change(function(){
    var id  = $(this).val();
    // alert(id);

        $.ajax({
            type: 'POST',
            url:"<?php echo base_url(); ?>accounting/addLocationajax",
            data: {id : id },
            dataType: 'json',
            success: function(response){
                // alert('success');
                // console.log(response['customer']);
            $("#job_location").val(response['customer'].mail_add + ' ' + response['customer'].cross_street + ' ' + response['customer'].city + ' ' + response['customer'].state + ' ' + response['customer'].country);
            $("#email").val(response['customer'].email);
            $("#date_of_birth").val(response['customer'].date_of_birth);
            $("#phone_no").val(response['customer'].phone_h);
            $("#mobile_no").val(response['customer'].phone_m);
            $("#city").val(response['customer'].city);
            $("#state").val(response['customer'].state);
            $("#zip").val(response['customer'].zip_code);
            $("#cross_street").val(response['customer'].cross_street);
        
            },
                error: function(response){
                alert('Error'+response);
       
                }
        });
    });

    $(document).on('click','.setmarkup',function(){
       // alert('yeah');
        var markup_amount = $('#markup_input').val();

        $("#markup_input_form").val(markup_amount);
        $("#span_markup_input_form").text(markup_amount);
        $("#span_markup").text(markup_amount);

        $('#modalSetMarkup').modal('toggle');
    });
});

</script>

<script>

$(document).ready(function(){
 
    $('.validate_offer').click(function(){
    var offer_code  = $("#offer_code").val();
    // alert(offer_code);

        $.ajax({
            type: 'POST',
            url:"<?php echo base_url(); ?>accounting/findoffercode",
            data: {offer_code : offer_code },
            dataType: 'json',
            success: function(response){
                // data = response.trim();
                // alert('success');
            // alert(response['offer'].cost);
            if (response != null){   
                var cost = response['offer'].cost;
                $("#offer_cost").text( '- $' + response['offer'].cost);
                $("#offer_cost").val(response['offer'].cost);

                var grand = $("#grand_total_input").val();
                var new_grand = grand - parseFloat(cost);

                $("#grand_total").text(new_grand.toFixed(2));
                $("#grand_total_input").val(new_grand.toFixed(2));
                // alert('computed');
                $('.invalid_code').hide();
            }
            else{   
                
                alert('invalid');
            }
        
            },
                error: function(response){
                // alert('Error'+response);
                $('.invalid_code').show();
       
                }
        });
    });

});

</script>