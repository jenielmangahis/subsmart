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
    .navbar-side.closed{
        padding-top:100px !important;
    }
    .pointer {cursor: pointer;}

    .highlight{
    background-color:#CAA1FC;
    color:red;
    padding:12px;
}

#signature-pad {min-height:200px;}
#signature-pad canvas {background-color:white;left: 0;top: 0;width: 100%;min-height:250px;height: 100%}

#signature-pad2 {min-height:200px;}
#signature-pad2 canvas {background-color:white;left: 0;top: 0;width: 100%;min-height:250px;height: 100%}

#signature-pad3 {min-height:200px;}
#signature-pad3 canvas {background-color:white;left: 0;top: 0;width: 100%;min-height:250px;height: 100%}

#signature-padM {min-height:200px;}
#signature-padM canvas {background-color:white;left: 0;top: 0;width: 100%;min-height:250px;height: 100%}

#signature-pad2M {min-height:200px;}
#signature-pad2M canvas {background-color:white;left: 0;top: 0;width: 100%;min-height:250px;height: 100%}

#signature-pad3M {min-height:200px;}
#signature-pad3M canvas {background-color:white;left: 0;top: 0;width: 100%;min-height:250px;height: 100%}

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #10ab06;
}

input:focus + .slider {
  box-shadow: 0 0 1px #10ab06;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

.tr_qty{
    width:150px;
}


nav > .nav.nav-tabs{

border: none;
  color:#fff;
  background:#272e38;
  border-radius:0;

}
nav > div a.nav-item.nav-link,
nav > div a.nav-item.nav-link.active
{
border: none;
  padding: 18px 25px;
  color:#fff;
  background:#272e38;
  border-radius:0;
}

/* nav > div a.nav-item.nav-link.active:after
{
content: "";
position: relative;
bottom: -60px;
left: -10%;
border: 15px solid transparent;
border-top-color: #e74c3c ;
} */
.tab-content{
background: #fdfdfd;
  line-height: 25px;
  border: 1px solid #ddd;
  border-top:5px solid #e74c3c;
  border-bottom:5px solid #e74c3c;
  padding:30px 25px;
}

nav > div a.nav-item.nav-link:hover,
nav > div a.nav-item.nav-link:focus
{
border: none;
  background: #e74c3c;
  color:#fff;
  border-radius:0;
  transition:background 0.20s linear;
}

.signature_mobile
{
    display: none;
}

.show_mobile_view
{
    display: none;
}

.box-wrap 
{ 
    position: relative; 
    /* min-height: 250px;  */
    width:100%;
}

/* #canvas
{
 width: 100%;
 height: 100%;
 object-fit: contain;
} */
.tabbed-area div div 
{ 
    background: white; 
    padding: 20px; 
    min-height: 250px; 
    position: absolute; 
    top: -1px; 
    left: 0; 
    width: 100%; 
}

.tabbed-area div div, .tabs li a 
{ 
    border: 1px solid #ccc; 
}

#box-one:target, #box-two:target, #box-three:target {
  z-index: 1;
}


@media only screen and (max-device-width: 600px) {
    .label-element{
        position:absolute;
        top:-8px;
        left:25px;
        font-size:12px;
        color:#666;
        }
    .input-element{
        padding:30px 5px 10px 8px;
        width:100%;
        height:55px;
        /* border:1px solid #CCC; */
        font-weight: bold;
        margin-top: -15px;
        }

    .select-wrap 
    {
    border: 2px solid #e0e0e0;
    /* border-radius: 4px; */
    margin-top: -10px;
    /* margin-bottom: 10px; */
    padding: 0 5px 5px;
    width:100%;
    /* background-color:#ebebeb; */
    }

    .select-wrap label
    {
    font-size:10px;
    text-transform: uppercase;
    color: #777;
    padding: 2px 8px 0;
    }

    .m_select
    {
    /* background-color: #ebebeb;
    border:0px; */
    border-color: white !important;
    border:0px !important;
    outline:0px !important;
    }
    .select2 .select2-container .select2-container--default{
        /* background-color: #ebebeb;
    border:0px; */
    border-color: white !important;
    border:0px !important;
    outline:0px !important;
    }

    .select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #fff !important;
    border-radius: 4px;
    }

    .sub_label{
        font-size:12px !important;
    }

    .signature_web
    {
        display: none;
    }

    .signature_mobile
    {
        display: block;
    }

    .hidden_mobile_view{
        display: none;
    }

    .show_mobile_view
    {
        display: block;
    }

    .table_mobile
    {
        font-size:14px;
    }

    div.dropdown-wrapper select { 
    width:115% /* This hides the arrow icon */; 
    background-color:transparent /* This hides the background */; 
    background-image:none; 
    -webkit-appearance: none /* Webkit Fix */; 
    border:none; 
    box-shadow:none; 
    padding:0.3em 0.5em; 
    font-size:13px;
    }
    .signature-pad-canvas-wrapper {
    margin: 15px 0 0;
    border: 1px solid #cbcbcb;
    border-radius: 3px;
    overflow: hidden;
    position: relative;
}

    .signature-pad-canvas-wrapper::after {
        content: 'Name';
        border-top: 1px solid #cbcbcb;
        color: #cbcbcb;
        width: 100%;
        margin: 0 15px;
        display: inline-flex;
        position: absolute;
        bottom: 10px;
        font-size: 13px;
        z-index: -1;
    }
}
   </style>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
          <div class="card">
              <div class="page-title-box pt-1 pb-0">
                  <div class="row align-items-center">
                      <div class="col-sm-12">
                          </div>
                          <!-- <h3 class="page-title mt-0">New Lead</h3> -->
                          <h3 style="font-family: Sarabun, sans-serif">Update Work Order</h3>
                          <!-- <div class="pl-3 pr-3 mt-1 row">
                            <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">
                                    To create new lead go to Lead TAB and Select new. Enter all the Lead information as shown below.
                                    Enter Address information.  Enter Additional Information and Description
                                    and Finally click Save Button.  All required fields must have information.
                                </span>
                            </div>
                          </div> -->
                      </div>
                  </div>
              </div>
            <!-- end row -->
            <!-- <div class="row">
                <div class="col-md-12" style="background-color:#32243d;padding:1px;text-align:center;color:white;">
                    <h5>General Information</h5>
                </div>
            </div>
            <br> -->
            <?php echo form_open_multipart('workorder/UpdateWorkorder', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?> 
                    <div class="row">
                        <div class="col-md-12">
                            <div id="header_area">
                                <h4 class="mt-0 header-title mb-5">Header</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <ol class="breadcrumb" style="margin-top:-30px;"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                            <li class="breadcrumb-item active">
                                                <label style="background-color:#E8E8E9;" id="headerContent"><?php echo $headers->content; ?></label>
                                                <input type="hidden" name="header" value="<?php echo $headers->content; ?>">
                                            </li>
                                        </ol>
                                    </div> 
                                </div>
                                <br>

                                <input type="hidden" id="company_name" value="<?php echo $clients->business_name; ?>">
                                <input type="hidden" name="wo_id" value="<?php echo $workorder->id; ?>">
                                <input type="hidden" id="current_date" value="<?php echo @date('m-d-Y'); ?>">

                                <input type="hidden" id="content_input" class="form-control" name="header" value="<?php echo $headers->content; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">                   
                            <div class="col-md-3 form-group">
                                <label for="contact_name">Work Order #</label>
                                <input type="text" class="form-control" name="workorder_number" id="contact_name" value="<?php echo $workorder->work_order_number; ?>" readonly />
                            </div>
                            <div class="col-md-3 form-group">
								<label for="last_name">Last Name</label>
								<input type="text" class="form-control" name="customer[last_name]" id="last_name" required placeholder="Enter Last Name" value="<?php echo $customer->last_name; ?>" readonly/>
							</div>
							<div class="col-md-3 form-group">
								<label for="first_name">First Name</label>
								<input type="text" class="form-control" name="customer[first_name]" id="first_name" required placeholder="Enter First Name" value="<?php echo $customer->first_name; ?>" readonly/>
							</div>
                        </div>
                        <div class="row">
                        <div class="col-md-3 form-group">
                                <label for="security_number">Security Number</label>
                                <input type="text" class="form-control" name="security_number" id="security_number" placeholder="xxx-xx-xxxx" value="<?php echo $workorder->security_number; ?>"/>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="birthdate">Birth Date</label>
                                <input type="date" class="form-control" name="birthdate" id="date_of_birth" value="<?php echo $workorder->birthdate; ?>"/>
                            </div>
                            </div>
                        <div class="row">                   
                            <div class="col-md-3 form-group">
                                <label for="phone_no">Phone Number</label>
                                <input type="text" class="form-control" name="phone_number" id="phone_no" value="<?php echo $workorder->phone_number; ?>"/>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="mobile_no">Mobile Number</label>
                                <input type="text" class="form-control" name="mobile_number" id="mobile_no"  value="<?php echo $workorder->mobile_number; ?>" />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email"  value="<?php echo $workorder->email; ?>"   />
                            </div>
                        </div>
                        
                        <!-- end row -->
                        <div class="row" id="sel-cul">                    
                            <div class="col-md-4 form-group">
                                <label for="job_location">Job Location</label>
                                <!-- <label style="float:right;color:green;"><i class="fa fa-plus-square" aria-hidden="true"></i> New Location</label> -->
                                <input type="text" class="form-control" name="job_location" id="job_location"  value="<?php echo $workorder->job_location; ?>"/>
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="city">
                                    City
                                </label>
                                    <input type="text" class="form-control" name="city" id="city"  value="<?php echo $workorder->city; ?>"/>
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="state">
                                    State
                                </label>
                                    <input type="text" class="form-control" name="state" id="state"  value="<?php echo $workorder->state; ?>"/>
                            </div>
                            <div class="col-md-1 form-group">
                                <label for="zip">
                                    Zip code
                                </label>
                                    <input type="text" class="form-control" name="zip_code" id="zip"  value="<?php echo $workorder->zip_code; ?>"/>
                            </div>
                            
                            <div class="col-md-3 form-group">
                                <label for="cross_street">
                                    Cross Street
                                </label>
                                    <input type="text" class="form-control" name="cross_street" id="cross_street"  value="<?php echo $workorder->cross_street; ?>"/>
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
                                <label for="contact_phone">Password</label> 
                                <!-- <i class="fa fa-pencil" aria-hidden="true" ></i> -->
                                <input type="text" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $workorder->password; ?>"/>
                            </div>
                            <!-- <div class="col-md-4 form-group">
                                <label for="suit" class="mytxt">Custom Field</label> <i class="fa fa-pencil" aria-hidden="true"></i>
                                <input type="text" class="form-control" name="custom1_value" id="custom1_value"/>
                                <input type="hidden" class="custom1" name="custom1_field">
                            </div> -->
                        </div>
                        
                        <div class="row" id="thisdiv">
                        <?php foreach($custom_fields as $field){ ?>
                            <div class="col-md-3 form-group">
                                <label><?php echo $field->name; ?></label> <i class="fa fa-pencil" aria-hidden="true"></i>
                                <input type="text" class="form-control" name="custom_value[]" id="custom1_value" value="<?php echo $field->value; ?>"/>
                            </div>     
                            <!-- <div class="col-md-4 form-group">
                                <label for="suit" class="mytxt2">Custom Field</label> <i class="fa fa-pencil" aria-hidden="true"></i>
                                <input type="text" class="form-control" name="custom2_value" id="custom2_value"/>
                                <input type="hidden" class="custom2" name="custom2_field">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="suit" class="mytxt3">Custom Field</label> <i class="fa fa-pencil" aria-hidden="true"></i>
                                <input type="text" class="form-control" name="custom3_value" id="custom3_value"/>
                                <input type="hidden" class="custom3" name="custom3_field">
                            </div>
                        </div>
                        <div class="row">     
                            <div class="col-md-4 form-group">
                                <label for="suit" class="mytxt4">Custom Field</label> <i class="fa fa-pencil" aria-hidden="true"></i>
                                <input type="text" class="form-control" name="custom4_value" id="custom4_value"/>
                                <input type="hidden" class="custom4" name="custom4_field">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="suit" class="mytxt5">Custom Field</label> <i class="fa fa-pencil" aria-hidden="true"></i>
                                <input type="text" class="form-control" name="custom5_value" id="custom5_value"/>
                                <input type="hidden" class="custom5" name="custom5_field">
                            </div> -->
                            <?php } ?>
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
                                            <th class="hidden_mobile_view" width="150px">Discount</th>
                                            <th class="hidden_mobile_view" width="150px">Tax (Change in %)</th>
                                            <th class="hidden_mobile_view">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody id="jobs_items_table_body">
                                        <?php foreach($items_data as $data){ ?>
                                        <tr>
                                            <td width="30%">
                                            <div class="hidden_mobile_view">
                                                <input type="text" class="form-control getItems"
                                                       onKeyup="getItems(this)" name="items[]" value="<?php echo $data->item; ?>">
                                                <ul class="suggestions"></ul>
                                            </div>
                                            <div class="show_mobile_view">
                                            <?php echo $data->item; ?>
                                            </div>
                                            </td>
                                            <td width="20%">
                                            <div class="hidden_mobile_view">
                                            <select name="item_type[]" class="form-control">
                                                    <option value="product">Product</option>
                                                    <option value="material">Material</option>
                                                    <option value="service">Service</option>
                                                    <option value="fee">Fee</option>
                                                </select>
                                            </div>
                                            <div class="show_mobile_view">
                                            <?php echo $data->item_type; ?>
                                            </div>
                                            </td>
                                            <td width="10%"><input type="number" class="form-control quantity hidden_mobile_view" name="quantity[]"
                                                       data-counter="0" id="quantity_<?php echo $data->id; ?>" value="<?php echo $data->qty; ?>"><div class="show_mobile_view"><span><?php echo $data->qty; ?></span><input type="hidden" class="form-control quantity" name="quantity[]"
                                                       data-counter="0" id="quantity_0" value="<?php echo $data->qty; ?>"></div></td>
                                            <td width="10%"><input type="number" class="form-control price hidden_mobile_view" name="price[]"
                                                       data-counter="0" id="price_<?php echo $data->id; ?>" min="0" value="<?php echo $data->cost; ?>"><div class="show_mobile_view"><?php echo $data->cost; ?></div></td>
                                            <td class="hidden_mobile_view" width="10%"><input type="number" class="form-control discount" name="discount[]"
                                                       data-counter="0" id="discount_<?php echo $data->id; ?>" min="0" value="<?php echo $data->discount; ?>" ></td>
                                            <td class="hidden_mobile_view" width="10%"><input type="text" class="form-control tax_change" name="tax[]"
                                                       data-counter="0" id="tax1_<?php echo $data->id; ?>" min="0" value="<?php echo $data->tax; ?>">
                                                       <!-- <span id="span_tax_0">0.0</span> -->
                                                       </td>
                                            <td class="hidden_mobile_view" width="10%"><input type="hidden" class="form-control " name="total[]"
                                                       data-counter="0" id="item_total_<?php echo $data->id; ?>" min="0" value="<?php echo $data->total; ?>">
                                                       $<span id="span_total_<?php echo $data->id; ?>"><?php echo $data->total; ?></span></td>
                                        </tr>
                                        <?php } ?>
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
                                            <!-- <td></td> -->
                                            <td colspan="2" align="center">$ <span id="span_sub_total_invoice"><?php echo $workorder->subtotal; ?></span>
                                                <input type="hidden" name="subtotal" id="item_total" value="<?php echo $workorder->subtotal; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Taxes</td>
                                            <!-- <td></td> -->
                                            <td colspan="2" align="center">$ <span id="total_tax_"><?php echo $workorder->taxes; ?></span><input type="hidden" name="taxes" id="total_tax_input" value="<?php echo $workorder->taxes; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td style="width:;"><input type="text" name="adjustment_name" id="adjustment_name" placeholder="Adjustment Name" class="form-control" style="width:; display:inline; border: 1px dashed #d1d1d1" value="<?php echo $workorder->adjustment_name; ?>"></td>
                                            <td style="width:;">
                                            <input type="number" name="adjustment_value" id="adjustment_input" value="<?php echo $workorder->adjustment_value; ?>" class="form-control adjustment_input" style="width:100px; display:inline-block">
                                                <span class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Optional it allows you to adjust the total amount Eg. +10 or -10." data-original-title="" title=""></span>
                                            </td>
                                            <td><?php echo $workorder->adjustment_value; ?></td>
                                        </tr>
                                        <!-- <tr>
                                            <td>Markup $<span id="span_markup"></td> -->
                                            <!-- <td><a href="#" data-toggle="modal" data-target="#modalSetMarkup" style="color:#02A32C;">set markup</a></td> -->
                                            <input type="hidden" name="markup_input_form" id="markup_input_form" class="markup_input" value="0">
                                        <!-- </tr> -->
                                        <?php if(empty($workorder->voucher_value)){ ?>
                                        <tr id="saved" style="color:green;font-weight:bold;display:none;">
                                            <td>Amount Saved</td>
                                            <td></td>
                                            <td><span id="offer_cost">0.00</span><input type="hidden" name="voucher_value" id="offer_cost_input"></td>
                                        </tr>
                                        <?php }else{ ?>
                                            <tr id="saved" style="color:green;font-weight:bold;">
                                            <td>Amount Saved</td>
                                            <td></td>
                                            <td><span id="offer_cost"><?php echo $workorder->voucher_value; ?></span><input type="hidden" name="voucher_value" id="offer_cost_input" value="<?php echo $workorder->voucher_value; ?>"></td>
                                        </tr>
                                        <?php } ?>
                                        <tr style="color:blue;font-weight:bold;font-size:18px;">
                                            <td><b>Grand Total ($)</b></td>
                                            <!-- <td></td> -->
                                            <td colspan="2" align="center"><b><span id="grand_total"><?php echo $workorder->grand_total; ?></span>
                                                <input type="hidden" name="grand_total" id="grand_total_input" value='<?php echo $workorder->grand_total; ?>'></b></td>
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

                            <h5>Checklist</h5>
                            <small class="help help-sm">You can set up a checklist for employees.</small><br>
                            <br><br>
                            <div id="checklist_added"></div>
                            <!-- <div id="citems"> -->
                            <!-- </div> -->
                            <br><br>
                            <button class="btn btn-success" style="color:white;" data-toggle="modal" data-target="#checklist_modal"><i class="fa fa-plus-square" aria-hidden="true"></i> Select Checklist</button>

                            
                        <br><br><br><br>
                            <h6>JOB DETAIL</h6><br>
                            
                        <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="job_type">Job Type</label>
                                    <select name="job_type" id="job_type" class="form-control custom-select">
                                        <option value="<?php echo $workorder->job_type ?>"><?php echo $workorder->job_type ?></option>
                                    <?php foreach($job_types as $jt){ ?>
                                        <option value="<?php echo $jt->title ?>"><?php echo $jt->title ?></option>

                                    <?php } ?>
                                        <!-- <option value="Service">Service</option>
                                        <option value="Design">Design</option>
                                        <option value="Maintenance">Maintenance</option>
                                        <option value="Repair">Repair</option>
                                        <option value="Replace">Replace</option> -->
                                    </select>
                                </div>  
                            <div class="col-md-4 form-group">
                                <label for="Job Tag">Job Tag</label>
                                <!-- <label style="float:right;color:green;">Manage Tag</label> -->
                                <!-- <input type="text" class="form-control" name="job_tag" id="job_tag" /> -->
                                <select class="form-control" name="job_tag" id="job_tag">
                                            <option value="<?php echo $workorder->tags ?>"><?php echo $workorder->tags ?></option>
                                            <!-- <option>---</option> -->
                                            <?php foreach($job_tags as $tags){ ?>
                                                <option value="<?php echo $tags->name; ?>"><?php echo $tags->name; ?></option>
                                            <?php } ?>
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
                                    <input type="date" class="form-control" name="schedule_date_given" id="schedule_date_given" value="<?php echo $workorder->schedule_date_given; ?>" />
                                </div>      
                                <div class="form-group col-md-4">
                                    <label for="workorder_priority">Priority</label>
                                    <select name="priority" id="workorder_priority" class="form-control custom-select">
                                        <option value="<?php echo $workorder->priority ?>"><?php echo $workorder->priority ?></option>
                                        <option value="Emergency">Emergency</option>
                                        <option value="Low">Low</option>
                                        <option value="Standard">Standard</option>
                                        <option value="Urgent">Urgent</option>                
                                    </select>
                                </div>                                      
                            </div>
                            <div class="row">                        
                                <div class="form-group col-md-4">
                                    <label for="job_name">Job Name</label>
                                    <input type="text" class="form-control" name="job_name" id="job_name" value="<?php echo $workorder->job_name; ?>" />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="job_desc">Job Description</label>
                                    <textarea name="job_description" id="job_desc" cols="5" rows="2" class="form-control"><?php echo $workorder->job_description; ?></textarea> 
                                </div>                                           
                            </div>
                            <div class="row">                        
                                <div class="form-group col-md-4">
                                <div class="select-wrap">
                                    <label for="lead_source">Lead Source</label>
                                    <select id="lead_source" name="lead_source" class="form-control custom-select m_select">
                                        <option value="0">- none -</option>
                                        <?php foreach($lead_source as $lead){ ?>
                                            <option value="<?php echo $lead->ls_id; ?>"><?php echo $lead->ls_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>    
                                </div>                                     
                            </div>

                            
                            <h6>PAYMENT DETAIL</h6><br>
                            <div class="row">                   
                                <div class="form-group col-md-4">
                                    <label for="job_type">Payment Method</label>
                                    <select name="payment_method" id="payment_method" class="form-control custom-select">
                                        <option value="">Choose method</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Check">Check</option>
                                        <option value="Credit Card">Credit Card</option>
                                        <option value="Debit Card">Debit Card</option>
                                        <option value="ACH">ACH</option>
                                        <option value="Venmo">Venmo</option>
                                        <option value="Paypal">Paypal</option>
                                        <option value="Square">Square</option>
                                        <option value="Warranty Work">Warranty Work</option>
                                        <option value="Home Owner Financing">Home Owner Financing</option>
                                        <option value="e-Transfer">e-Transfer</option>
                                        <option value="Other Credit Card Professor">Other Credit Card Professor</option>
                                        <option value="Other Payment Type">Other Payment Type</option>
                                    </select>
                                </div>      
                                <div class="form-group col-md-4">
                                    <label for="job_type">Amount</label><small class="help help-sm"> ( $ )</small>
                                    <input type="text" class="form-control" name="payment_amount" id="payment_amount" value="<?php echo $workorder->payment_amount; ?>" />
                                </div>
                                <div class="form-group col-md-4" id="cash_area" style="display:none;">
                                                <br><br>
                                      <input type="checkbox" id="collected_checkbox"> <b style="font-size:14px;" id="collected_checkbox_label"> Cash collected already </b>          
                                </div>                                      
                            </div>
                            <div id="check_area" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Check Number</label>
                                        <input type="text" class="form-control" name="check_number" id="check_number"/>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Routing Number</label>
                                        <input type="text" class="form-control" name="routing_number" id="routing_number"/>
                                    </div>                                             
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Number</label>
                                        <input type="text" class="form-control" name="account_number" id="account_number"/>
                                    </div>                                       
                                </div>
                            </div>
                            <div id="credit_card" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Credit Card Number</label>
                                        <input type="text" class="form-control" name="credit_number" id="credit_number" placeholder="0000 0000 0000 000" />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type">Credit Card Expiration</label>
                                        <input type="text" class="form-control" name="credit_expiry" id="credit_expiry" placeholder="MM/YYYY"/>
                                    </div>  
                                    <div class="form-group col-md-3">
                                        <label for="job_type">CVC</label>
                                        <input type="text" class="form-control" name="credit_cvc" id="credit_cvc" placeholder="CVC"/>
                                    </div>                                             
                                </div>
                            </div>
                            <div id="debit_card" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Credit Card Number</label>
                                        <input type="text" class="form-control" name="debit_credit_number" id="credit_number" placeholder="0000 0000 0000 000" />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type">Credit Card Expiration</label>
                                        <input type="text" class="form-control" name="debit_credit_expiry" id="credit_expiry" placeholder="MM/YYYY"/>
                                    </div>  
                                    <div class="form-group col-md-3">
                                        <label for="job_type">CVC</label>
                                        <input type="text" class="form-control" name="debit_credit_cvc" id="credit_cvc" placeholder="CVC"/>
                                    </div>                                            
                                </div>
                            </div>
                            <div id="ach_area" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Routing Number</label>
                                        <input type="text" class="form-control" name="ach_routing_number" id="ach_routing_number" />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type">Account Number</label>
                                        <input type="text" class="form-control" name="ach_account_number" id="ach_account_number" />
                                    </div>  
                                </div>
                            </div>
                            <div id="venmo_area" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Credential</label>
                                        <input type="text" class="form-control" name="account_credentials" id="account_credentials"/>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type">Account Note</label>
                                        <input type="text" class="form-control" name="account_note" id="account_note"/>
                                    </div>  
                                    <div class="form-group col-md-3">
                                        <label for="job_type">Confirmation</label>
                                        <input type="text" class="form-control" name="confirmation" id="confirmation"/>
                                    </div>                                            
                                </div>
                            </div>
                            <div id="paypal_area" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Credential</label>
                                        <input type="text" class="form-control" name="paypal_account_credentials" id="paypal_account_credentials"/>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type">Account Note</label>
                                        <input type="text" class="form-control" name="paypal_account_note" id="paypal_account_note"/>
                                    </div>  
                                    <div class="form-group col-md-3">
                                        <label for="job_type">Confirmation</label>
                                        <input type="text" class="form-control" name="paypal_confirmation" id="paypal_confirmation"/>
                                    </div>                                            
                                </div>
                            </div>
                            <div id="square_area" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Credential</label>
                                        <input type="text" class="form-control" name="square_account_credentials" id="square_account_credentials"/>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type">Account Note</label>
                                        <input type="text" class="form-control" name="square_account_note" id="square_account_note"/>
                                    </div>  
                                    <div class="form-group col-md-3">
                                        <label for="job_type">Confirmation</label>
                                        <input type="text" class="form-control" name="square_confirmation" id="square_confirmation"/>
                                    </div>                                            
                                </div>
                            </div>
                            <div id="warranty_area" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Credential</label>
                                        <input type="text" class="form-control" name="warranty_account_credentials" id="warranty_account_credentials"/>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type">Account Note</label>
                                        <input type="text" class="form-control" name="warranty_account_note" id="warranty_account_note"/>
                                    </div>                                         
                                </div>
                            </div>
                            <div id="home_area" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Credential</label>
                                        <input type="text" class="form-control" name="home_account_credentials" id="home_account_credentials"/>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type">Account Note</label>
                                        <input type="text" class="form-control" name="home_account_note" id="home_account_note"/>
                                    </div>                                         
                                </div>
                            </div>
                            <div id="e_area" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Credential</label>
                                        <input type="text" class="form-control" name="e_account_credentials" id="e_account_credentials"/>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type">Account Note</label>
                                        <input type="text" class="form-control" name="e_account_note" id="e_account_note"/>
                                    </div>                                         
                                </div>
                            </div>
                            <div id="other_credit_card" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Credit Card Number</label>
                                        <input type="text" class="form-control" name="other_credit_number" id="other_credit_number" placeholder="0000 0000 0000 000" />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type">Credit Card Expiration</label>
                                        <input type="text" class="form-control" name="other_credit_expiry" id="other_credit_expiry" placeholder="MM/YYYY"/>
                                    </div>  
                                    <div class="form-group col-md-3">
                                        <label for="job_type">CVC</label>
                                        <input type="text" class="form-control" name="other_credit_cvc" id="other_credit_cvc" placeholder="CVC"/>
                                    </div>                                             
                                </div>
                            </div>
                            <div id="other_payment_area" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Credential</label>
                                        <input type="text" class="form-control" name="other_payment_account_credentials" id="other_payment_account_credentials"/>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type">Account Note</label>
                                        <input type="text" class="form-control" name="other_payment_account_note" id="other_payment_account_note"/>
                                    </div>                                         
                                </div>
                            </div>

                            <!-- ====== TERMS AND CONDITIONS ====== -->
                            <br><br><br>
                            <div class="row">
                                <div class=" col-md-12"><label style="float:right;color:green;"><a href="#" style="color:green;" data-toggle="modal" data-target="#terms_conditions_modal">Update Terms and Condition</a></label>
                                <label style="font-weight:bold;font-size:18px;">TERMS AND CONDITIONS</label>
                                    <div style="height:200px; overflow:auto; background:#FFFFFF;"
                                         id="thisdiv2">
                                            <p><?php echo $workorder->terms_and_conditions; ?></p>
                                            <input type="hidden" id="company_id" value="<?php echo getLoggedCompanyID(); ?>">
                                    </div>
                                    <input type="hidden" class="form-control" name="terms_conditions" id="terms_conditions" value="<?php echo $workorder->terms_and_conditions; ?>" />
                                </div>
                            </div>
                            <br><br>
                            <div class="row">                        
                                <div class="form-group col-md-4">
                                    <label for="workorder_status">Status</label>
                                    <select name="status" id="workorder_status" class="form-control custom-select">
                                        <option value="New">New</option>
                                        <option value="Draft">Draft</option>
                                        <option value="Scheduled">Scheduled</option>
                                        <option value="Started">Started</option>
                                        <option value="Paused">Paused</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Invoiced">Invoiced</option>
                                        <option value="Withdrawn">Withdrawn</option>
                                        <option value="Closed">Closed</option>
                                    </select>
                                </div>
                                <!-- <div class="form-group col-md-4">
                                    <label for="workorder_priority">Priority</label>
                                    <select name="priority" id="workorder_priority" class="form-control custom-select">
                                        <option value="Emergency">Emergency</option>
                                        <option value="Low">Low</option>
                                        <option value="Standard">Standard</option>
                                        <option value="Urgent">Urgent</option>                
                                    </select>
                                </div>                                            -->
                            </div>
                            

                            <div class="row">                        
                                <div class="form-group col-md-4">
                                    <label for="purchase_order">Purchase Order# (optional)</label>
                                    <input type="text" class="form-control" name="purchase_order_number" id="purchase_order" value="<?php echo $workorder->purchase_order_number; ?>" /> 
                                </div>                                        
                            </div>

                            <!-- ====== TERMS OF USE ====== -->
                            <div class="row">
                                <div class=" col-md-12">
                                    <label style="font-weight:bold;font-size:18px;">TERMS OF USE</label><label style="float:right;color:green;"><a href="#" style="color:green;" data-toggle="modal" data-target="#terms_use_modal">Update Terms of Use</a></label>
                                    <div style="height:100px; overflow:auto; background:#FFFFFF; padding-left:10px;"
                                         id="thisdiv3">
                                            <p><?php echo $workorder->terms_of_use; ?></p>
                                            <input type="hidden" id="company_id" value="<?php echo getLoggedCompanyID(); ?>">
                                    </div>
                                    <input type="hidden" class="form-control" name="terms_of_use" id="terms_of_use"  value="<?php echo $workorder->terms_of_use; ?>"/>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">        
                                <div class="form-group col-md-4">
                                    <label for="instructions">Instructions</label>
                                    <textarea name="instructions" id="instructions" cols="5" rows="2" class="form-control"><?php echo $workorder->instructions; ?></textarea>
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
                                <div class="col-md-4">
                                    <h6>Company Representative Approval &emsp; <a data-toggle="modal" data-target=".companySignature"><i class="fa fa-pencil" aria-hidden="true"></i></a> </h6>
                                    <img src="<?php echo $workorder->company_representative_signature; ?>">
                                    <br>

                                    <label for="comp_rep_approval">Printed Name</label>
                                    <input type="text6" class="form-control mb-3"
                                           name="company_representative_printed_name"
                                           id="comp_rep_approval" value="<?php echo $workorder->company_representative_name; ?>" />

                                </div>
                                <div class="col-md-4">
                                    <h6>Primary Account Holder &emsp; <a data-toggle="modal" data-target=".primarySignature"><i class="fa fa-pencil" aria-hidden="true"></i></a></h6>
                                    <img src="<?php echo $workorder->primary_account_holder_signature; ?>">
                                    <br>

                                    <label for="comp_rep_approval">Printed Name</label>
                                    <input type="text6" class="form-control mb-3" name="primary_account_holder_name"
                                           id="comp_rep_approval" placeholder="" value="<?php echo $workorder->primary_account_holder_name; ?>"/>

                                </div>
                                <div class="col-md-4">
                                    <h6>Secondary Account Holder &emsp; <a data-toggle="modal" data-target=".secondarySignature"><i class="fa fa-pencil" aria-hidden="true"></i></a></h6>
                                    <img src="<?php echo $workorder->secondary_account_holder_signature; ?>">
                                    <br>

                                    <label for="comp_rep_approval">Printed Name</label>
                                    <input type="text6" class="form-control mb-3" name="secondery_account_holder_name"
                                           id="comp_rep_approval" placeholder="" value="<?php echo $workorder->secondary_account_holder_name; ?>"/>

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

                <br><br><br><br><br>
                <div>

                     <div class="form-group">
                                <button type="submit" class="btn btn-flat btn-success">Submit</button>
                                <button type="submit" class="btn btn-flat btn-success">Preview</button>
                                <button type="submit" class="btn btn-flat btn-success" style="background-color: #32243d !important"><b>Save Template</b></button>
                                <button type="submit" class="btn btn-flat btn-success" id="esignButton">eSign</button>
                                <a href="<?php echo url('workorder') ?>" class="btn ">Cancel this</a>
                    </div>
                </div>
            <!-- end card -->
            </div>




        </div>

        <style>

        </style>
        <?php echo form_close(); ?>
    </div>
    <!-- end container-fluid -->
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

            <!-- first signature -->

            <div class="modal fade companySignature" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                            <div align="center">
                                <p style="padding:2%;background-color:#d2d2d2;width:380px;"> Company Representative Approval </p>
                            </div>
                                    <div class="box-wrap">
                                        
                                        <div id="box-one">
                                        <div class="row">
                                        <div class="col-md-12" style="padding:1%;">
                                        <center>
                                            <canvas id="canvas" style="border: solid gray 1px;"></canvas>
                                            <input type="hidden" class="form-control mb-3" name="company_representative_printed_name" id="comp_rep_approval1" value="Company Representative"/>
                                            <input type="hidden" id="saveCompanySignatureDB1aM" name="company_representative_approval_signature1aM">
                                            </div>
                                            </div>
                                            <br>
                                        </center>
                                        </div>
                                    
                                    </div>
                        
                        <div class="modal-footer">
                            <button type="button" onClick="submit()" class="btn btn-success enter_signature" id="enter_signature">Update</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <!-- <input type="submit" value="save" id="btnSaveSign"> -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- second signature -->

            <div class="modal fade primarySignature" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                            <div align="center">
                                <p style="padding:2%;background-color:#d2d2d2;width:380px;"> Primary Account Holder </p>
                            </div>
                                    <div class="box-wrap">
                                        
                                        <div id="box-one">
                                        <div class="row">
                                        <div class="col-md-12" style="padding:1%;">
                                        <center>
                                            <canvas id="canvas2" style="border: solid gray 1px;"></canvas>
                                            <input type="hidden" class="form-control mb-3" name="primary_representative_printed_name" id="comp_rep_approval2" value="Primary Account Holder"/>
                                            <input type="hidden" id="savePrimaryAccountSignatureDB2aM" name="primary_account_holder_signature2aM">
                                            </div>
                                            </div>
                                            <br>
                                        </center>
                                        </div>
                                    
                                    </div>
                        
                        <div class="modal-footer">
                            <button type="button" onClick="submit()" class="btn btn-success enter_signature" id="enter_signature">Update</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <!-- <input type="submit" value="save" id="btnSaveSign"> -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- third signature -->

            <div class="modal fade secondarySignature" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                            <div align="center">
                                <p style="padding:2%;background-color:#d2d2d2;width:380px;"> Secondary Account Holder </p>
                            </div>
                                    <div class="box-wrap">
                                        
                                        <div id="box-one">
                                        <div class="row">
                                        <div class="col-md-12" style="padding:1%;">
                                        <center>
                                            <canvas id="canvas3" style="border: solid gray 1px;"></canvas>
                                            <input type="hidden" class="form-control mb-3" name="secondary_representative_printed_name" id="comp_rep_approval3" value="Secondary Account Holder"/>
                                            <input type="hidden" id="saveSecondaryAccountSignatureDB3aM" name="secondary_account_holder_signature3aM">
                                            </div>
                                            </div>
                                            <br>
                                        </center>
                                        </div>
                                    
                                    </div>
                        
                        <div class="modal-footer">
                            <button type="button" onClick="submit()" class="btn btn-success enter_signature" id="enter_signature">Update</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <!-- <input type="submit" value="save" id="btnSaveSign"> -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="terms_conditions_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Update Terms and Conditions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <textarea class="form-control ckeditor editor1_tc" name="editor1" id="editor1" cols="40" rows="40">
                            <?php echo $terms_conditions->content; ?>
                            </textarea>
                            <input type="hidden" id="company_id_modal" value="<?php echo getLoggedCompanyID(); ?>">
                            <input type="hidden" id="update_tc_id" value="<?php echo $terms_conditions->id; ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary save_terms_and_conditions">Save changes</button>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Modal checklist -->
            <div class="modal fade" id="checklist_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Select Checklists</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <?php foreach($checklists as $checklist){ ?>
                            <input type="checkbox" id="checkist_checkbox" item-id="<?php echo $checklist->check_id; ?>" value="<?php echo $checklist->check_id; ?>"> <?php echo $checklist->checklist_name; ?><br>
                            <?php } ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary add_checklist_items">Add Selected</button>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="terms_use_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Update Terms of Use</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <textarea class="form-control ckeditor" name="update_tu" id="editor2" cols="40" rows="40">
                            <?php echo $terms_uses->content; ?>
                            </textarea>
                            <input type="hidden" id="company_id_modal" value="<?php echo getLoggedCompanyID(); ?>">
                            <input type="hidden" id="update_tu_id" value="<?php echo $terms_uses->id; ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary save_terms_of_use">Save changes</button>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="update_header_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Update Header</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <textarea class="form-control ckeditor" name="update_header_content" id="editor3" cols="40" rows="40">
                            <?php echo $headers->content; ?>
                            </textarea>
                            <input type="hidden" id="company_id_header" value="<?php echo getLoggedCompanyID(); ?>">
                            <input type="hidden" id="update_h_id" value="<?php echo $headers->id; ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary save_update_header">Save changes</button>
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
                                            <td> Rebatable</td>
                                            <td> Qty</td>
                                            <td> Price</td>
                                            <td> Action</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($items as $item){ // print_r($item); ?>
                                            <tr>
                                                <td><?php echo $item->title; ?></td>
                                                <td><?php echo $item->rebate; ?></td>
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

            <!-- Modal update custom -->
            <div class="modal fade" id="modalupdateCustom" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- <h5 class="modal-title" id="exampleModalLabel">New Customer</h5> -->
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" class="form-control" name="update_custom_id" id="update_custom_id">
                            <input type="text" class="form-control" name="update_custom_name" id="update_custom_name"><br>
                        </div>
                        <div class="modal-body pt-0 pl-3 pb-3"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary saveUpdateCustomField">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal New Customer -->
            <div class="modal fade" id="modalNewCustomer" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" data-keyboard="false" style="z-index: 1050 !important;">
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

            <div class="modal fade" id="docusignTemplateModal" tabindex="-1" role="dialog" aria-labelledby="docusignTemplateModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="docusignTemplateModalLabel">Select Template</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table id="templatesTable" class="table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                    </div>
                </div>
            </div>

<?php include viewPath('includes/footer'); ?>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlMWhWMHlxQzuolWb2RrfUeb0JyhhPO9c&libraries=places"></script>
<script>
function initialize() {
          var input = document.getElementById('job_location');
          var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();
                document.getElementById('city2').value = place.name;
                document.getElementById('cityLat').value = place.geometry.location.lat();
                document.getElementById('cityLng').value = place.geometry.location.lng();
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
</script>

<script type="text/javascript">
// $(window).on('beforeunload', function(){
//     var c = confirm();
//     if(c){
//         return true;
//     }
//     else
//         return false;
// });
</script>

<script>
// $('.enter_signature').click(function(){
//     // alert("nisulod");
//         if(signaturePad.isEmpty()){
//             console.log('it is empty');
//             return false;            
//         }
//     });

var signaturePad;
jQuery(document).ready(function () {
  var signaturePadCanvas = document.querySelector('#canvas');
//   var parentWidth = jQuery(signaturePadCanvas).parent().outerWidth();
//   signaturePadCanvas.setAttribute("width", parentWidth);
  signaturePad = new SignaturePad(signaturePadCanvas);

  signaturePadCanvas.width  = 780;
  signaturePadCanvas.height = 300;
});

var signaturePad2;
jQuery(document).ready(function () {
  var signaturePadCanvas2 = document.querySelector('#canvas2');
//   var parentWidth = jQuery(signaturePadCanvas).parent().outerWidth();
//   signaturePadCanvas.setAttribute("width", parentWidth);
  signaturePad2 = new SignaturePad(signaturePadCanvas2);

  signaturePadCanvas2.width  = 780;
  signaturePadCanvas2.height = 300;
});

var signaturePad3;
jQuery(document).ready(function () {
  var signaturePadCanvas3 = document.querySelector('#canvas3');
//   var parentWidth = jQuery(signaturePadCanvas).parent().outerWidth();
//   signaturePadCanvas.setAttribute("width", parentWidth);
  signaturePad3 = new SignaturePad(signaturePadCanvas3);

  signaturePadCanvas3.width  = 780;
  signaturePadCanvas3.height = 300;
});


$(document).on('click touchstart','#sign',function(){
    // alert('test');
    var canvas_web = document.getElementById("sign");    
    var dataURL = canvas_web.toDataURL("image/png");
    $("#saveCompanySignatureDB1aM_web").val(dataURL);
});

$(document).on('click touchstart','#sign2',function(){
    // alert('test');
    var canvas_web2 = document.getElementById("sign2");    
    var dataURL = canvas_web2.toDataURL("image/png");
    $("#saveCompanySignatureDB1aM_web2").val(dataURL);
});

$(document).on('click touchstart','#sign3',function(){
    // alert('test');
    var canvas_web3 = document.getElementById("sign3");    
    var dataURL = canvas_web3.toDataURL("image/png");
    $("#saveCompanySignatureDB1aM_web3").val(dataURL);
});

// var btn = document.getElementById('enter_signature');
// btn.onclick = function () {
//     document.getElementById('smoothed1a_pencil').remove();
//     this.remove();
// };

function submit() {
    
    // document.getElementById('smoothed1a_pencil').remove();
    // this.remove();

    // $("#smoothed1a").remove();
    // $("#smoothed2a").remove();
    // $("#smoothed3a").remove();

    // $(".signature_web").remove();

//   if (signaturePad.isEmpty() || signaturePad2.isEmpty() || signaturePad3.isEmpty()) {
//     // console.log("Empty!");
//     alert('Please check, you must sign all tab.')
//   }
//   else{
    // sigpad= $("#output-2a").val();
    var canvas = document.getElementById("canvas");    
    var dataURL = canvas.toDataURL("image/png");
    $("#saveCompanySignatureDB1aM").val(dataURL);

    var canvas2 = document.getElementById("canvas2");    
    var dataURL2 = canvas2.toDataURL("image/png");
    $("#savePrimaryAccountSignatureDB2aM").val(dataURL2);

    var canvas3 = document.getElementById("canvas3");    
    var dataURL3 = canvas3.toDataURL("image/png");
    $("#saveSecondaryAccountSignatureDB3aM").val(dataURL3);

    var input1 = $("#comp_rep_approval1").val();
    var input2 = $("#comp_rep_approval2").val();
    var input3 = $("#comp_rep_approval3").val();
    
    $.ajax({
    type : 'POST',
    url : "<?php echo base_url(); ?>accounting/testSave",
    data : {dataURL: dataURL, dataURL2: dataURL2, dataURL3: dataURL3},
    success: function(result){
        // $('#res').html('Signature Uploaded successfully');
        alert('Signature Uploaded successfully');
        console.log(dataURL);
        console.log(dataURL2);
        console.log(dataURL3);

        // var image = new Image();
        // image.src = '"' + dataURL + '"';
        // document.body.appendChild(image);

        var input_conf = '<br><div style="border:solid gray 1px;padding:2%;"><img id="image1" src="'+dataURL+'"></img><input type="hidden" class="form-control" name="signature1" id="signature1" value="'+ dataURL +'"><br><input type="text" class="form-control" name="name1" id="name1" value="'+ input1 +'" readonly></div><br><div style="border:solid gray 1px;padding:2%;"><img id="image1" src="'+dataURL2+'"></img><input type="hidden" class="form-control" name="signature2" id="signature2" value="'+ dataURL2 +'"><br><input type="text" class="form-control" name="name2" id="name2" value="'+ input2 +'" readonly></div><br><div style="border:solid gray 1px;padding:2%;"><img id="image1" src="'+dataURL3+'"></img><input type="hidden" class="form-control" name="signature3" id="signature3" value="'+ dataURL3 +'"><br><input type="text" class="form-control" name="name3" id="name3" value="'+ input3 +'" readonly></div>';

        $('.signatureArea').html(input_conf);

        // $(".sigWrapper").remove();

        $("#saveCompanySignatureDB1aM_web").val(dataURL);
        $("#saveCompanySignatureDB1aM_web2").val(dataURL2);
        $("#saveCompanySignatureDB1aM_web3").val(dataURL3);

        $(".output1").val(dataURL);
        $(".output2").val(dataURL2);
        $(".output3").val(dataURL3);

        $("#company_representative_printed_name").val(input1);
        $("#primary_account_holder_name").val(input2);
        $("#secondery_account_holder_name").val(input3);

        $('#signature_mobile').modal('toggle');
        // if (confirm('Some message')) {
        //     alert('Thanks for confirming');
        // } else {
        //     alert('Why did you press cancel? You should have confirmed');
        // }

        // location.reload();
    },
    });
//   }
}
</script>

<script src="<?php echo $url->assets ?>js/add.js"></script>
<script>
jQuery(document).ready(function () {
    $(document).on('click','#Commercial',function(){
        $('#business_name_area').show();
    });
    $(document).on('click','#customer_type',function(){
        $('#business_name_area').hide();
    });
    $(document).on('click','#advance',function(){
        $('#business_name_area').hide();
    });
});
</script>

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
    if(window.matchMedia("(max-width: 600px)").matches){
        // alert("This is a mobile device.");
        $(document).on("click", ".testing", function () {
            $('.getItems').hide();
            $('#item_typeid').removeClass('form-control');
            $(".sigWrapper").remove();
            // $(".output2").remove();
            // $(".output3").remove();
        });
        $(document).on("click", ".select_item", function () {
            $('.getItems').hide();
        });
    } 
    // else{
    //     $('.getItems_hidden').hide();
    // }
});
</script>

<script>
// $(document).on('click','.show_mobile_view',function(){
//     //    alert('yeah');
//     $('#update_group').modal('show');
// });
$(document).on('click','.groupChange',function(){
    //    alert('yeah');
    $('#item_group_type').val();
});
</script>

<script>
    $(function() {
        $("nav:first").addClass("closed");
    });
</script>

<script>
var wrapper = document.getElementById("signature-pad");
var canvas = wrapper.querySelector("canvas");

var sign = new SignaturePad(document.getElementById('sign'), {
  backgroundColor: 'rgba(255, 255, 255, 0)',
  penColor: 'rgb(0, 0, 0)'
});

function resizeCanvas() {
     var ratio =  Math.max(window.devicePixelRatio || 1, 1);

     canvas.width = canvas.offsetWidth * ratio;
     canvas.height = canvas.offsetHeight * ratio;
     canvas.getContext("2d").scale(ratio, ratio);
}

window.onresize = resizeCanvas;
resizeCanvas();
</script>

<script>
var wrapper = document.getElementById("signature-pad2");
var canvas = wrapper.querySelector("canvas");

var sign = new SignaturePad(document.getElementById('sign2'), {
  backgroundColor: 'rgba(255, 255, 255, 0)',
  penColor: 'rgb(0, 0, 0)'
});

function resizeCanvas() {
     var ratio =  Math.max(window.devicePixelRatio || 1, 1);

     canvas.width = canvas.offsetWidth * ratio;
     canvas.height = canvas.offsetHeight * ratio;
     canvas.getContext("2d").scale(ratio, ratio);
}

window.onresize = resizeCanvas;
resizeCanvas();
</script>

<script>
var wrapper = document.getElementById("signature-pad3");
var canvas = wrapper.querySelector("canvas");

var sign = new SignaturePad(document.getElementById('sign3'), {
  backgroundColor: 'rgba(255, 255, 255, 0)',
  penColor: 'rgb(0, 0, 0)'
});

function resizeCanvas() {
     var ratio =  Math.max(window.devicePixelRatio || 1, 1);

     canvas.width = canvas.offsetWidth * ratio;
     canvas.height = canvas.offsetHeight * ratio;
     canvas.getContext("2d").scale(ratio, ratio);
}

window.onresize = resizeCanvas;
resizeCanvas();
</script>

<script>
// var value = $("#headerContent").text();
// if(value.indexOf("agreement") != -1)
// //   alert("true");
// return $(this).text().replace("agreement", "yeahhhhh"); 
// else
//   alert("false");
// $(".headerContent").text(function () {
//     return $(this).text().replace("agreement", "yeahhhhh"); 
// });​​​​​

jQuery(function($){

// Replace 'td' with your html tag
$("#headerContent").html(function() { 

// Replace 'ok' with string you want to change, you can delete 'hello everyone' to remove the text
 var currentDate = $('#current_date').val();
      return $(this).html().replace("{curr_date}", currentDate);  

});
});

jQuery(function($){

// Replace 'td' with your html tag
$("#headerContent").html(function() { 

    var companyName = $('#company_name').val();
// Replace 'ok' with string you want to change, you can delete 'hello everyone' to remove the text
      return $(this).html().replace("{comp_name}", companyName);  

});
});

jQuery(function($){

// Replace 'td' with your html tag
$("#thisdiv3").html(function() { 

    // var companyName = $('#company_name').val();
    // var now = new Date();
    // now.setDate(now.getDate()+3);
    // var n=3; //number of days to add. 
    // var t = new Date();
    // t.setDate(t.getDate() + n); 
    // var month = "0"+(t.getMonth()+1);
    // var date = "0"+t.getDate();
    // month = month.slice(-2);
    // date = date.slice(-2);
    // var date = " "+ month +"-"+date +"-"+t.getFullYear();


    // var startDate = "16-APR-2021";
    var startDate = new Date();
    // var daaa = new Date();
    
    // var date = d.getDate();
    // var month = d.getMonth() + 1; // Since getMonth() returns month from 0-11 not 1-12
    // var year = d.getFullYear();
        
    // var startDate = date + "-" + month + "-" + year;

    // startDate = new Date(startDate.replace(/-/g, "/"));
    var endDate = "", noOfDaysToAdd = 3, count = 0;
    while(count < noOfDaysToAdd){
        endDate = new Date(startDate.setDate(startDate.getDate() + 1));
        if(endDate.getDay() != 0 && endDate.getDay() != 6){
        count++;
        }
    }
    //alert(endDate);
    var month = "0"+(endDate.getMonth()+1);
    var date = "0"+endDate.getDate();
    month = month.slice(-2);
    date = date.slice(-2);
    var date = " "+ month +"-"+date +"-"+endDate.getFullYear();

// alert(now);  
      return $(this).html().replace("{current_date_3}", date);  

});
});
</script>

<script>
// var value = $("#headerContent").text();
// if(value.indexOf("agreement") != -1)
// //   alert("true");
// return $(this).text().replace("agreement", "yeahhhhh"); 
// else
//   alert("false");
// $(".headerContent").text(function () {
//     return $(this).text().replace("agreement", "yeahhhhh"); 
// });​​​​​

jQuery(function($){

// Replace 'td' with your html tag
$("#content_input").val(function() { 

// Replace 'ok' with string you want to change, you can delete 'hello everyone' to remove the text
 var currentDate = $('#current_date').val();
      return $(this).val().replace("day", currentDate);  

});
});

jQuery(function($){

// Replace 'td' with your html tag
$("#content_input").val(function() { 

    var companyName = $('#company_name').val();
// Replace 'ok' with string you want to change, you can delete 'hello everyone' to remove the text
      return $(this).val().replace("ADI", companyName);  

});
});
</script>

<script>
$(document).on('click','#headerContent',function(){
    //    alert('yeah');
    $('#update_header_modal').modal('show');
});

$(document).on('click','.save_update_header',function(){
    //    alert('yeah');
    var id = $('#update_h_id').val();
    // var content = $('.editor1_tc').val();
    var content = CKEDITOR.instances['editor3'].getData();
    // alert(content);
      $.ajax({
            url:"<?php echo base_url(); ?>workorder/save_update_header",
            type: "POST",
            data: {id : id, content : content },
            success: function(dataResult){
                // $('#table').html(dataResult); 
                // alert('success')
                console.log(dataResult);
                $("#update_header_modal").modal('hide')
                $('#header_area').load(window.location.href +  ' #header_area');
            },
                error: function(response){
                alert('Error'+response);
       
                }
	    });
});

</script>

<script>
$(document).on('click','.save_terms_and_conditions',function(){
    //    alert('yeah');
    var id = $('#update_tc_id').val();
    // var content = $('.editor1_tc').val();
    var content = CKEDITOR.instances['editor1'].getData();
    // alert(content);
      $.ajax({
            url:"<?php echo base_url(); ?>workorder/save_update_tc",
            type: "POST",
            data: {id : id, content : content },
            success: function(dataResult){
                // $('#table').html(dataResult); 
                // alert('success')
                console.log(dataResult);
                $("#terms_conditions_modal").modal('hide')
                $('#thisdiv2').load(window.location.href +  ' #thisdiv2');
            },
                error: function(response){
                alert('Error'+response);
       
                }
	    });
        
    });

</script>

<script>
$(document).on('click','.save_terms_of_use',function(){
    //    alert('yeah');
    var id = $('#update_tu_id').val();
    // var content = $('.editor1_tc').val();
    var content = CKEDITOR.instances['editor2'].getData();
    // alert(content);
      $.ajax({
            url:"<?php echo base_url(); ?>workorder/save_update_tu",
            type: "POST",
            data: {id : id, content : content },
            success: function(dataResult){
                // $('#table').html(dataResult); 
                // alert('success')
                console.log(dataResult);
                $("#terms_use_modal").modal('hide')
                $('#thisdiv3').load(window.location.href +  ' #thisdiv3');
            },
                error: function(response){
                alert('Error'+response);
       
                }
	    });
        
    });

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
            // $("#job_location").val(response['customer'].mail_add + ' ' + response['customer'].cross_street + ' ' + response['customer'].city + ' ' + response['customer'].state + ' ' + response['customer'].country);
            $("#job_location").val(response['customer'].mail_add);
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

        $('.add_checklist_items').click(function(){
            // alert('test');
            $('input[id="checkist_checkbox"]:checked').each(function() {
            // alert(this.value);
            var id = this.value;
            // $("#checklist_added").html(this.value);
            // $("#checklist_modal").modal('hide')

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>workorder/getchecklistdetailsajax",
                dataType:"json",
                data : { id : id },
                success: function(response){

                  console.log('yeahhhhhhhhhhhhhhh'+response['checklists'][0].checklist_name); 
                  console.log(response); 

                  $("#checklist_modal").modal('hide')
                //   $("#checklist_added").html(response['checklists'].checklist_name);
                //   $(".business_name").html(response['client'].business_name);
                // var objJSON = JSON.parse(response['checklists'].checklist_name);
                // var inputs = "";
                // $.each(objJSON, function (i, v) {
                //     inputs += response['checklists'].checklist_name;
                // });

                
                var check = '<ul> <li id="view_details" c_id="'+ response['checklists'][0].id +'"><h6>'+ response['checklists'][0].checklist_name +'</h6> </li> </ul>';

                $("#checklist_added").append(check);
                
                var cID = response['checklists'][0].id;
                // alert(cID);

                
                // initialize tooltip
                $('#view_details').each(function(e){
                // $("#view_details").mouseover(function(){
                // track:true,
                // open: function( event, ui ) {
                    $(this).on('mouseover', function(){
                    var id = this.id;
                    var userid = $(this).attr('c_id');
                    // alert(userid);
                    
                        // $.ajax({
                        //     url:'fetch_details.php',
                        //     type:'post',
                        //     data:{userid:userid},
                        //     success: function(response){
                        //         alert(userid);
                        
                        //     // Setting content option
                        //     //$("#"+id).tooltip('option','content',response);
                        
                        //     }
                        });

                });

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>workorder/getchecklistitemsajax",
                    dataType:"json",
                    data : { cID : cID },
                    success: function(result){
                        // console.log('aaaaa'+result['citems'][0].item_name); 
                        // $("#citems").append(result['citems'][0].item_name);
                    },
                        error: function(result){
                        alert('Error'+result);
        
                    }

                });

                // $.each(response, function () {
                //     $("#checklist_added").html( this.checklist_name);
                //     // $("#pics_Id").append("<div>" + this.id + "</div>");
                // });


                },
                    error: function(response){
                    alert('Error'+response);
       
                }

              });
            });
        });


    });
</script>


<script>
$(document).ready(function(){

// $('.mytxtc').each(function(){
//     alert($(this).attr('label-id'););
    
// });
// $(".mytxtc").each(function () {

// var label = $(this).text(); // It will get current label text
// alert($(this).text());
// // roomOcc.push(label);

// });
$(function () {
    $('#collected_checkbox').click(function() {
        // alert('yes');
        var actualTime = "";
        $('#collected_checkbox_label').toggleClass("highlight");
    });
});

$('.mytxtc').each(function(e){
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
        // e.preventDefault();
        $(this).on('click', function(){
            var id = $(this).attr('label-id');
            var name = $(this).attr('label-name');
            $('#update_custom_id').val(id);
            $('#update_custom_name').val(name);
            // alert(id);
            // $(document).on("click", "label.mytxt", function () {
                // var txt = $(this).text();
                // $(this).replaceWith("<input class='mytxt'/>");
                // $(this).val(txt);
                // $('.custom_'+id).val(id);
            // });

            
        });

        // $(this).on("click", function () {
        //         var txt = $(this).val();
        //         $(this).replaceWith("<label class='mytxt'></label>");
        //         $(this).text(txt);
        //         $('.custom_'+id).val(txt);
        //     });
    });

$('.saveUpdateCustomField').on('click', function(){
    //   alert('yeah');
      var id = $('#update_custom_id').val();
      var name = $('#update_custom_name').val();

      $.ajax({
            url:"<?php echo base_url(); ?>workorder/save_update_custom_name",
            type: "POST",
            data: {id : id, name : name },
            success: function(dataResult){
                // $('#table').html(dataResult); 
                // alert('success')
                $("#modalupdateCustom").modal('hide')
                $('#thisdiv').load(window.location.href +  ' #thisdiv');
            }
	    });
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
                $('#saved').show();
                $('.invalid_code').hide();
            }
            else{   
                
                alert('invalid');
            }
        
            },
                error: function(response){
                // alert('Error'+response);
                $('.invalid_code').show();
                $("#offer_cost").text('0');
                $("#offer_cost").val('0');

                var total1 = $("#span_sub_total_invoice").text();
                var total2 = $("#adjustment_input").val();

                var total3  = parseFloat(total1) - parseFloat(total2);
                $("#grand_total").text(total3.toFixed(2));
                $("#grand_total_input").val(total3.toFixed(2));
                // var counter = $(this).data("counter");
                // calculation(counter);
       
                }
        });
    });

    function calculation(counter) {
  var price = $("#price_" + counter).val();
  var quantity = $("#quantity_" + counter).val();
  var discount = $("#discount_" + counter).val()
    ? $("#discount_" + counter).val()
    : 0;
  var tax = (parseFloat(price) * 7.5) / 100;
  var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
    2
  );
  var total = (
    (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
    parseFloat(discount)
  ).toFixed(2);

  $("#span_total_" + counter).text(total);
  $("#total_" + counter).val(total);
  $("#span_tax_" + counter).text(tax1);
  $("#tax1_" + counter).val(tax1);
  // $("#tax1_" + counter).val(tax1);
  // $("#tax_" + counter).val(tax1);
  // alert(tax1);

  if( $('#tax_'+ counter).length ){
    $('#tax_'+counter).val(tax1);
  }

  if( $('#item_total_'+ counter).length ){
    $('#item_total_'+counter).val(total);
  }

  var eqpt_cost = 0;
  var subtotal = 0;
  var adjustment_amount = 0;
  var cnt = $("#count").val();

  if (
    $("#adjustment_input").val() &&
    $("#adjustment_input").val().toString().length > 1
  ) {
    adjustment_amount = $("#adjustment_input").val().substr(1);
  }
  for (var p = 0; p <= cnt; p++) {
    var prc = $("#price_" + p).val();
    var quantity = $("#quantity_" + p).val();
    // var discount= $('#discount_' + p).val();
    // eqpt_cost += parseFloat(prc) - parseFloat(discount);
    subtotal += parseFloat($("#span_total_" + p).text());
    eqpt_cost += parseFloat(prc) * parseFloat(quantity);
  }

  $("#adjustment_amount").text(parseFloat(adjustment_amount));
  $("#adjustment_amount_form_input").val(parseFloat(adjustment_amount));
  $("#invoice_sub_total").text(subtotal.toFixed(2));
  $("#sub_total_form_input").val(subtotal.toFixed(2));

  $("#span_sub_total_0").text(subtotal.toFixed(2));

  var grandTotal = eval(
    $("#invoice_sub_total").text() + $("#adjustment_input").val()
  );
  $("#invoice_grand_total").text(parseFloat(grandTotal).toFixed(2));
  $("#grand_total_form_input").val(parseFloat(grandTotal).toFixed(2));

  eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
  $("#eqpt_cost").val(eqpt_cost);

  // alert('dri');

  if($("#grand_total").length && $("#grand_total").val().length)
  {
    // console.log('none');
    // alert('none');
  }else{
    $("#grand_total").text(grand_total_w.toFixed(2));
    $("#grand_total_input").val(grand_total_w.toFixed(2));

    var bundle1_total = $("#grand_total").text();
    var bundle2_total = $("#grand_total2").text();
    var super_grand = parseFloat(bundle1_total) + parseFloat(bundle2_total);
    $("#supergrandtotal").text(super_grand.toFixed(2));
    $("#supergrandtotal_input").val(super_grand.toFixed(2));
  }

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
}


});

</script>


<script>
$(document).on("click", "label.mytxt", function () {
        var txt = $(".mytxt").text();
        $(".mytxt").replaceWith("<input class='mytxt'/>");
        $(".mytxt").val(txt);
        $(".custom1").val(txt);
    });

    $(document).on("blur", "input.mytxt", function () {
        var txt = $(this).val();
        $(this).replaceWith("<label class='mytxt'></label>");
        $(".mytxt").text(txt);
        $(".custom1").val(txt);
});
$(document).on("click", "label.mytxt2", function () {
        var txt = $(".mytxt2").text();
        $(".mytxt2").replaceWith("<input class='mytxt2'/>");
        $(".mytxt2").val(txt);
        $(".custom2").val(txt);
    });

    $(document).on("blur", "input.mytxt2", function () {
        var txt = $(this).val();
        $(this).replaceWith("<label class='mytxt2'></label>");
        $(".mytxt2").text(txt);
        $(".custom2").val(txt);
});

$(document).on("click", "label.mytxt3", function () {
        var txt = $(".mytxt3").text();
        $(".mytxt3").replaceWith("<input class='mytxt3'/>");
        $(".mytxt3").val(txt);
        $(".custom3").val(txt);
    });

    $(document).on("blur", "input.mytxt3", function () {
        var txt = $(this).val();
        $(this).replaceWith("<label class='mytxt3'></label>");
        $(".mytxt3").text(txt);
        $(".custom3").val(txt);
});

$(document).on("click", "label.mytxt4", function () {
        var txt = $(".mytxt4").text();
        $(".mytxt4").replaceWith("<input class='mytxt4'/>");
        $(".mytxt4").val(txt);
        $(".custom4").val(txt);
    });

    $(document).on("blur", "input.mytxt4", function () {
        var txt = $(this).val();
        $(this).replaceWith("<label class='mytxt4'></label>");
        $(".mytxt4").text(txt);
        $(".custom4").val(txt);
});

$(document).on("click", "label.mytxt5", function () {
        var txt = $(".mytxt5").text();
        $(".mytxt5").replaceWith("<input class='mytxt5'/>");
        $(".mytxt5").val(txt);
        $(".custom5").val(txt);
    });

    $(document).on("blur", "input.mytxt5", function () {
        var txt = $(this).val();
        $(this).replaceWith("<label class='mytxt5'></label>");
        $(".mytxt5").text(txt);
        $(".custom5").val(txt);
});

$(document).on("click", "label.mytxt6", function () {
        var txt = $(".mytxt6").text();
        $(".mytxt6").replaceWith("<input class='form-control mytxt6' />");
        $(".mytxt6").val(txt);
        $(".custom6").val(txt);
    });

    $(document).on("blur", "input.mytxt6", function () {
        var txt = $(this).val();
        $(this).replaceWith("<label class='form-control mytxt6'></label>");
        $(".mytxt6").text(txt);
        $(".custom6").val(txt);
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
