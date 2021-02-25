<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
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
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid" style="background-color:white;">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 style="font-family: Sarabun, sans-serif">New Work Orders</h3>
                        <!-- <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Manage workorders.</li>
                        </ol> -->
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <?php if (hasPermissions('WORKORDER_MASTER')) : ?>
                                    <a href="<?php echo base_url('invoice') ?>" class="btn btn-primary"
                                       aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> Go Back to Invoices
                                    </a>
                                <?php endif ?>
                            </div>
                        </div>
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
                                <input type="text" class="form-control" name="birthdate" id="birthdate"  placeholder="mm/dd/yy" required/>
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
                            <div class="col-md-3 form-group">
                                <label for="job_location">Job Location</label><label style="float:right;color:green;"><i class="fa fa-plus-square" aria-hidden="true"></i> New Location</label>
                                <!-- <input type="text" class="form-control" name="job_location" id="job_location" required/> -->
                                <div id="locationField">
                                    <input
                                        id="autocomplete"
                                        placeholder="Enter Location"
                                        onFocus="geolocate()"
                                        type="text"
                                        class="form-control"
                                    />
                                    </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="city">
                                    City
                                </label>
                                    <input type="text" class="form-control" name="city" id="locality" />
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="state">
                                    State
                                </label>
                                    <input type="text" class="form-control" name="state" id="administrative_area_level_1" />
                            </div>
                            <div class="col-md-1 form-group">
                                <label for="zip">
                                    Zip code
                                </label>
                                    <input type="text" class="form-control" name="zip" id="postal_code" />
                            </div>
                            
                            <div class="col-md-3 form-group">
                                <label for="cross_street">
                                    Cross Street
                                </label>
                                    <input type="text" class="form-control" name="cross_street" id="street_number" />
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
                                <!-- <label for="contact_phone">Password</label> <i class="fa fa-pencil" aria-hidden="true" ></i> -->
                                <span id="lblName" class="editable">Password</span> <i class="fa fa-pencil" aria-hidden="true"></i>
                                <input type="text" class="form-control" name="contact_phone" id="contact_phone" placeholder="Password" />
                            </div>
                            <div class="col-md-4 form-group">
                                <!-- <label for="suit">Custom Field</label> <i class="fa fa-pencil" aria-hidden="true"></i> -->
                                <span id="lblName" class="editable">Custom Field</span> <i class="fa fa-pencil" aria-hidden="true"></i>
                                <input type="text" class="form-control" name="cus1" id="suit"/>
                            </div>
                        </div>
                        <div class="row">     
                            <div class="col-md-4 form-group">
                                <!-- <label for="suit">Custom Field</label> <i class="fa fa-pencil" aria-hidden="true"></i> -->
                                <span id="lblName" class="editable">Custom Field</span> <i class="fa fa-pencil" aria-hidden="true"></i>
                                <input type="text" class="form-control" name="cus2" id="suit"/>
                            </div>
                            <div class="col-md-4 form-group">
                                <!-- <label for="suit">Custom Field</label> <i class="fa fa-pencil" aria-hidden="true"></i> -->
                                <span id="lblName" class="editable">Custom Field</span> <i class="fa fa-pencil" aria-hidden="true"></i>
                                <input type="text" class="form-control" name="cus3" id="suit"/>
                            </div>
                        </div>
                        <div class="row">     
                            <div class="col-md-4 form-group">
                                <!-- <label for="suit">Custom Field</label> <i class="fa fa-pencil" aria-hidden="true"></i> -->
                                <span id="lblName" class="editable">Custom Field</span> <i class="fa fa-pencil" aria-hidden="true"></i>
                                <input type="text" class="form-control" name="cus4" id="suit"/>
                            </div>
                            <div class="col-md-4 form-group">
                                <!-- <label for="suit">Custom Field</label> <i class="fa fa-pencil" aria-hidden="true"></i> -->
                                <span id="lblName" class="editable">Custom Field</span> <i class="fa fa-pencil" aria-hidden="true"></i>
                                <input type="text" class="form-control" name="cus5" id="suit"/>
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
                        <!-- <br><br> -->
                            <div class="row">
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
                            </div>
                            <div class="row" style="background-color:white;font-size:16px;">
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
                                    <input type="text" class="form-control" name="start_date" id="start_date" />
                                </div>    
                                <div class="form-group col-md-4">
                                    <br><button class="btn btn-success">VALIDATE</button>
                                </div>                                     
                            </div>
                            
                            <h6>JOB DETAIL</h6><br>
                            
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="city">Job Tag</label><label style="float:right;color:green;">Manage Tag</label>
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
                                    <input type="text" class="form-control" name="job_name" id="job_name" required  autofocus />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="job_desc">Job Description</label>
                                    <textarea name="job_desc" id="job_desc" cols="5" rows="2" class="form-control"></textarea> 
                                </div>                                           
                            </div>

                            <!-- ====== TERMS AND CONDITIONS ====== -->
                            <div class="row">
                                <div class=" col-md-12">
                                <label style="font-weight:bold;font-size:18px;">TERMS AND CONDITIONS</label><label style="float:right;color:green;"><a href="#" style="color:green;" data-toggle="modal" data-target="#update_tc">Update Terms of Use</a></label>
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
                                    <label style="font-weight:bold;font-size:18px;">TERMS OF USE</label><label style="float:right;color:green;"><a href="#" style="color:green;" data-toggle="modal" data-target="#update_TU">Update Terms of Use</a></label>
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
                                    <h5>Company Representative Approval</h5>
                                    <div class="sigPad" id="smoothed1a" style="width:100%;height:150px;border:solid gray 1px;">
                                    <p style="float:right;margin-right:10px;"><i class="fa fa-pencil" aria-hidden="true"></i></p>
                                        <ul class="sigNav">
                                            <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                            <li class="clearButton"><a href="#clear">Clear</a></li>
                                        </ul>
                                        <div class="sig sigWrapper" style="height:auto;">
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
                                    <h5>Primary Account Holder</h5>
                                    <div class="sigPad" id="smoothed2a" style="width:100%;height:150px;border:solid gray 1px;">
                                    <p style="float:right;margin-right:10px;"><i class="fa fa-pencil" aria-hidden="true"></i></p>
                                        <ul class="sigNav">
                                            <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                            <li class="clearButton"><a href="#clear">Clear</a></li>
                                        </ul>
                                        <div class="sig sigWrapper" style="height:auto;">
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
                                    <h5>Secondary Account Holder</h5>
                                    <div class="sigPad" id="smoothed3a" style="width:100%;height:150px;border:solid gray 1px;">
                                    <p style="float:right;margin-right:10px;"><i class="fa fa-pencil" aria-hidden="true"></i></p>
                                        <ul class="sigNav">
                                            <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                            <li class="clearButton"><a href="#clear">Clear</a></li>
                                        </ul>
                                        <div class="sig sigWrapper" style="height:auto;">
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
    <!-- Modal -->
    <div class="modal fade" id="update_tc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
<!-- <div class="modal fade" id="update_tc" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->

</div>

<?php include viewPath('includes/footer_accounting'); ?>
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
<script type="text/javascript">
$(function () {
    $(".editable").each(function () {
        var label = $(this);
 
        label.after("<input type = 'text' style = 'display:none' />");
 
        var textbox = $(this).next();
 
        textbox[0].name = this.id.replace("lbl", "txt");
 
        textbox.val(label.html());
 
        label.click(function () {
            $(this).hide();
            $(this).next().show();
        });
 
        textbox.focusout(function () {
            $(this).hide();
            $(this).prev().html($(this).val());
            $(this).prev().show();
        });
    });
});
</script>

<script>
      // This sample uses the Autocomplete widget to help the user select a
      // place, then it retrieves the address components associated with that
      // place, and then it populates the form fields with those details.
      // This sample requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script
      // src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
      let placeSearch;
      let autocomplete;
      const componentForm = {
        street_number: "short_name",
        route: "long_name",
        locality: "long_name",
        administrative_area_level_1: "short_name",
        country: "long_name",
        postal_code: "short_name",
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search predictions to
        // geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
          document.getElementById("autocomplete"),
          { types: ["geocode"] }
        );
        // Avoid paying for data that you don't need by restricting the set of
        // place fields that are returned to just the address components.
        autocomplete.setFields(["address_component"]);
        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        autocomplete.addListener("place_changed", fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        const place = autocomplete.getPlace();

        for (const component in componentForm) {
          document.getElementById(component).value = "";
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details,
        // and then fill-in the corresponding field on the form.
        for (const component of place.address_components) {
          const addressType = component.types[0];

          if (componentForm[addressType]) {
            const val = component[componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition((position) => {
            const geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude,
            };
            const circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy,
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>
    
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLLOmVj1SqAmP9kHcOBRaF4RbxyzHcOpM&callback=initAutocomplete&libraries=places&v=weekly" async ></script>