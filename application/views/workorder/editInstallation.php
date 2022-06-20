<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
<?php include viewPath('includes/sidebars/workorder'); ?>
<!-- <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> -->
<style>
.box-left-mini{
    float:left;
    background-image:url(website-content/hotcampaign.png);
    /* width:292px; */
    /* height:141px; */
}

.box-left-mini .front {
    display: block;
    z-index: 5;
    position: relative;
}
.box-left-mini .front span {
    background: #fff
}

.box-left-mini .behind_container {
    background-color: #ff0;
    position: relative;
    top: -18px;
}
.box-left-mini .behind {
    display: block;
    z-index: 3;
}
img.company-logo2 {
    width: 170px;
    /* height: 70px; */
    object-fit: contain;
    margin: 0 auto;
    margin-top: 8px;
}
</style>
<style>
/* #chartdiv {
  width: 100%;
  height: 400px;
} */
input:focus {
    background-color: #ffa;
}
/* .table-responsive {
    display: table;
} */
table input[type=text],
    input[type=email],
    input[type=url],
    /* input[type=checkbox], */
    input[type=password] {
    width: 100%;
    font-size:14px;
}
/* 
table input[type=checkbox] {
    width: 100%;
} */

table{
    width:100%;
}

#eye {
  position:absolute;
  right:80%;
  top:6.5%;
}

table input.form-control {
   height:25px !important;
}

.input-group-text
{
    padding:3px !important;
}
.itemTable td:nth-of-type(1) {width:40%;}
.itemTable  td:nth-of-type(2) {width:10%;}
.itemTable  td:nth-of-type(3) {width:30%;}
.itemTable  td:nth-of-type(4) {width:20%;}

@media screen and (max-width:500px){
    body{
        /* color:white; */
        font-size:9px !important;
    }  
    table thead
    {
        font-size:12px;
    }
}

@media screen and (max-width:1400px){
    table input[type=text],
    input[type=email],
    input[type=url],
    /* input[type=checkbox], */
    input[type=password] {
    width: 100%;
    font-size:10px;
    }
    /* table input[type=checkbox] {
        width: 80%;
    } */
    table thead
    {
        font-size:14px;
    }
    .withCheck
    {
        width:100% !important;
    }
}
</style>

    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
          <div class="row" style="margin-top: 30px;">
            <div class="col">
                <h3 class="m-0">Alarm System Work Order Agreement</h3>
            </div>
        </div>

        <!-- <div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;margin-top:5px;margin-bottom:10px;">
          Create your workorder.
        </div> -->
          <div class="card">
            <!-- end row -->
            <!-- <div class="row">
                <div class="col-md-12" style="background-color:#32243d;padding:1px;text-align:center;color:white;">
                    <h5>General Information</h5>
                </div>
            </div>
            <br> -->
            <?php echo form_open_multipart('workorder/updateWorkorderAgreement', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?> 
                    <div class="row">
                        <div class="col-md-12">
                            <div id="header_area">
                                <h4 class="mt-0 header-title mb-5">Header</h4>
                                <div class="row">
                                    <div class="col-md-9">
                                        <ol class="breadcrumb" style="margin-top:-30px;"></i>
                                            <li class="breadcrumb-item active">
                                                <label style="background-color:#E8E8E9;" id="headerContent"><?php echo $workorder->header; ?></label>
                                                <input type="hidden" id="headerID" name="header" value="<?php echo $workorder->header; ?>">
                                                <input type="hidden" id="current_date" name="current_date" value="<?php echo @date('m-d-Y'); ?>">
                                                <input type="hidden" name="wo_id" value="<?php echo $workorder->id; ?>">
                                            </li>
                                        </ol>   
                                        <!-- <div class="row">        
                                        </div>                                      -->
                                    </div> 
                                    <div class="col-md-3">
                                        <div style="margin-top:-30px;"><img src="<?php echo base_url().'assets/img/alarm_logo.jpeg' ?>" class="company-logo2"/> </div>                            
                                    </div> 
                                </div>
                                <div class="row">            
                                    <div class="col-md-3 form-group" style="display:none;">
                                        <label for="contact_name" class="label-element">Work Order #</label>
                                            <input type="text" style="width:100%;" class="form-control input-element" name="workorder_number" id="workorder_number" value="<?php echo $workorder->work_order_number; ?>" readonly/>
                                                    <!-- <input type="text" class="form-control input-element" name="workorder_number" id="workorder-number" value="<?= $prefix . $val; ?>" required readonly/> -->
                                    </div> 
                                    <div class="form-group col-md-2">
                                        <div class="select-wrap">
                                            <label for="lead_source">Lead Source</label>
                                            <select id="lead_source" name="lead_source" class="form-control custom-select m_select">
                                                <?php foreach($lead_source as $leads){ ?>
                                                <option value="<?php echo $leads->ls_id; ?>" <?php if($workorder->lead_source_id == $leads->ls_id){ echo 'selected'; }else{ echo ''; } ?> ><?php echo $leads->ls_name; ?></option>
                                                <?php } ?>
                                             </select>
                                        </div>    
                                    </div> 
                                    <div class="form-group col-md-2">
                                        <div class="select-wrap">
                                            <label for="lead_source">Account Type</label>
                                            <select id="account_type" name="account_type" class="form-control custom-select m_select">
                                                <option value="<?php echo $workorder->account_type; ?>"><?php echo $workorder->account_type; ?></option>
                                                <option value="Residential">Residential</option>
                                                <option value="Commercial">Commercial</option>
                                                <option value="Rental">Rental</option>
                                                <option value="Inhouse">Inhouse</option>
                                             </select>
                                        </div>    
                                    </div> 
                                    <div class="form-group col-md-2">
                                        <div class="select-wrap">
                                            <label for="lead_source">Security Data</label>
                                            <select id="communication_type" name="communication_type" class="form-control custom-select m_select">
                                                <?php foreach($system_package_type as $lead){ ?>
                                                <option value="<?php echo $lead->name; ?>" <?php if($workorder->panel_communication == $lead->name){ echo 'selected'; }else{ echo ''; } ?>><?php echo $lead->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>    
                                    </div> 
                                    <div class="form-group col-md-2">
                                        <div class="select-wrap">
                                            <label for="lead_source">Panel Type</label>
                                            <select name="panel_type" id="panel_type" class="form-control input_select" data-value="<?= isset($workorder) ? $workorder->panel_type : "" ?>">
                                                <option <?php if(isset($workorder)){ if($workorder->panel_type == ''){echo "selected";} } ?>  value="0">- none -</option>
                                                <option <?php if(isset($workorder)){ if($workorder->panel_type == 'AERIONICS'){echo "selected";} } ?> value="AERIONICS">AERIONICS</option>
                                                <option <?php if(isset($workorder)){ if($workorder->panel_type == 'AlarmNet'){echo "selected";} } ?> value="AlarmNet">AlarmNet</option>
                                                <option <?php if(isset($workorder)){ if($workorder->panel_type == 'Alarm.com'){echo "selected";} } ?> value="Alarm.com">Alarm.com</option>
                                                <option <?php if(isset($workorder)){ if($workorder->panel_type == 'Alula'){echo "selected";} } ?> value="Alula">Alula</option>
                                                <option <?php if(isset($workorder)){ if($workorder->panel_type == 'Bosch'){echo "selected";} } ?> value="Bosch">Bosch</option>
                                                <option <?php if(isset($workorder)){ if($workorder->panel_type == 'DSC'){echo "selected";} } ?> value="DSC">DSC</option>
                                                <option <?php if(isset($workorder)){ if($workorder->panel_type == 'ELK'){echo "selected";} } ?> value="ELK">ELK</option>
                                                <option <?php if(isset($workorder)){ if($workorder->panel_type == 'FBI'){echo "selected";} } ?> value="FBI">FBI</option>
                                                <option <?php if(isset($workorder)){ if($workorder->panel_type == 'GRI'){echo "selected";} } ?> value="GRI">GRI</option>
                                                <option <?php if(isset($workorder)){ if($workorder->panel_type == 'GE'){echo "selected";} } ?> value="GE">GE</option>
                                                <option <?php if(isset($workorder)){ if($workorder->panel_type == 'Honeywell'){echo "selected";} } ?> value="Honeywell">Honeywell</option>
                                                <option <?php if(isset($workorder)){ if($workorder->panel_type == 'Honeywell Touch'){echo "selected";} } ?> value="Honeywell Touch">Honeywell Touch</option>
                                                <option <?php if(isset($workorder)){ if($workorder->panel_type == 'Honeywell 3000'){echo "selected";} } ?> value="Honeywell 3000">Honeywell 3000</option>
                                                <option <?php if(isset($workorder)){ if($workorder->panel_type == 'Honeywell'){echo "selected";} } ?> value="Honeywell Vista">Honeywell Vista</option>
                                                <option <?php if(isset($workorder)){ if($workorder->panel_type == 'Honeywell Vista with Sem'){echo "selected";} } ?> value="Honeywell Vista with Sem">Honeywell Vista with Sem</option>
                                                <option <?php if(isset($workorder)){ if($workorder->panel_type == 'Honeywell Lyric'){echo "selected";} } ?> value="Honeywell Lyric">Honeywell Lyric</option>
                                                <option <?php if(isset($workorder)){ if($workorder->panel_type == 'IEI'){echo "selected";} } ?> value="IEI">IEI</option>
                                                <option <?php if(isset($workorder)){ if($workorder->panel_type == 'MIER'){echo "selected";} } ?> value="MIER">MIER</option>
                                                <option <?php if(isset($workorder)){ if($workorder->panel_type == '2 GIG'){echo "selected";} } ?> value="2 GIG">2 GIG</option>
                                                <option <?php if(isset($workorder)){ if($workorder->panel_type == '2 GIG Go Panel 2'){echo "selected";} } ?> value="2 GIG Go Panel 2">2 GIG Go Panel 2</option>
                                                <option <?php if(isset($workorder)){ if($workorder->panel_type == '2 GIG Go Panel 3'){echo "selected";} } ?> value="2 GIG Go Panel 3">2 GIG Go Panel 3</option>
                                                <option <?php if(isset($workorder)){ if($workorder->panel_type == 'Qolsys'){echo "selected";} } ?> value="Qolsyx">Qolsys</option>
                                                <option <?php if(isset($workorder)){ if($workorder->panel_type == 'Qolsys IQ Panel 2'){echo "selected";} } ?> value="Qolsys IQ Panel 2">Qolsys IQ Panel 2</option>
                                                <option <?php if(isset($workorder)){ if($workorder->panel_type == 'Qolsys IQ Panel 2 Plus'){echo "selected";} } ?> value="Qolsys IQ Panel 2 Plus">Qolsys IQ Panel 2 Plus</option>
                                                <option <?php if(isset($workorder)){ if($workorder->panel_type == 'Qolsys IQ Panel 3'){echo "selected";} } ?> value="Qolsys IQ Panel 3">Qolsys IQ Panel 3</option>
                                                <option <?php if(isset($workorder)){ if($workorder->panel_type == 'Custom'){echo "selected";} } ?> value="Custom">Custom</option>
                                                <option <?php if(isset($workorder)){ if($alarm_info->panel_type == 'Other'){echo "selected";} } ?> value="Other">Other</option>
                                            </select>
                                        </div>    
                                    </div> 
                                </div>
                                <br>
                                <!-- <a class="btn btn-sm btn-primary btn-edit-header" href="javascript:void(0);">Edit</a> -->
                                <input type="hidden" id="company_name" value="<?php echo $clients->business_name; ?>">
                                <input type="hidden" id="current_date" value="<?php 
                                $dt = new DateTime();
                                $timestamp = time();
                                // $dt->setTimezone(new DateTimeZone($getSettings->value));
                                // $dt->setTimestamp($timestamp);
                                
                                // echo $dt->format('m-d-Y'); 
                                echo date('m-d-Y');
                                
                                ?>">

                                <input type="hidden" id="content_input" class="form-control" name="header2" value="<?php echo $workorder->header; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row" style="font-size:16px;">                   
                        <div class=" col-md-6 box-left-mini">
                            <center>
                            <div class="front" style="text-align:center;background-color:#4a5594;color:white;padding:0.5%;border-radius:20px;width:95%;">
                                <h5>Items</h5>
                            </div>
                            </center><br>
                            <div class="behind_container" style="background-color:#ced4e4;margin-top:-20px;padding:20px;">
                                <table  class="table-bordered itemTable">
                                    <thead align="center">
                                        <th>Items</th>
                                        <th>Qty</th>
                                        <th>Location</th>
                                        <th>Price</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach($agreeItem as $items){ ?>
                                        <tr>
                                            <td><input type="text" style="background-color:#ced4e4;" class="form-control border-top-0 border-right-0 border-left-0 border-bottom-0 items" name="item[]" value="<?php echo $items->item; ?>"><input type="hidden" class="" value="<?php echo $items->check_data; ?>" name="dataValue[]"></td>
                                            <td><input type="text" style="background-color:#ced4e4;" value="<?php echo $items->qty; ?>"class="form-control border-top-0 border-right-0 border-left-0 border-bottom-0" name="qty[]"></td>
                                            <td><input type="text" style="background-color:#ced4e4;" value="<?php echo $items->location; ?>" class="form-control border-top-0 border-right-0 border-left-0 border-bottom-0" name="location[]"></td>
                                            <td><input type="text" style="background-color:#ced4e4;" value="<?php echo $items->price; ?>" class="form-control border-top-0 border-right-0 border-left-0 border-bottom-0 allprices" name="price[]"  onkeyup="getTotalPrices()"></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <div class="row"> 
                                <div class="col-md-6">
                                    <input type="text" name="installation_date" class="form-control border-top-0 border-right-0 border-left-0" id="datepicker_date" value="<?php echo $agreeDetails->installation_date; ?>">
                                    <b>Installation Date:</b>
                                </div>
                                <div class="col-md-6">
                                    <select id="intall_time" name="intall_time" class="form-control custom-select m_select border-top-0 border-right-0 border-left-0">
                                        <option value="8-10" <?php if($agreeDetails->intall_time == '8-10'){ echo 'selected'; } ?> >8-10</option>
                                        <option value="10-12" <?php if($agreeDetails->intall_time == '10-12'){ echo 'selected'; } ?> >10-12</option>
                                        <option value="12-2" <?php if($agreeDetails->intall_time == '12-2'){ echo 'selected'; } ?> >12-2</option>
                                        <option value="2-4 <?php if($agreeDetails->intall_time == '2-4'){ echo 'selected'; } ?> ">2-4</option>
                                        <option value="4-6" <?php if($agreeDetails->intall_time == '4-6'){ echo 'selected'; } ?> >4-6</option>
                                    </select>
                                    <b>Install Time Date:</b>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">                   
                                <div class="form-group col-md-4">
                                    <div class="select-wrap">
                                        <b>Payment Method</b>
                                            <select name="payment_method" id="payment_method" class="form-control custom-select m_select border-top-0 border-right-0 border-left-0">
                                                <option value="" <?php if($workorder->payment_method == ''){ echo 'selected'; } ?>>Choose method</option>
                                                <option value="Cash" <?php if($workorder->payment_method == 'Cash'){ echo 'selected'; } ?>>Cash</option>
                                                <option value="Check" <?php if($workorder->payment_method == 'Check'){ echo 'selected'; } ?>>Check</option>
                                                <option value="Credit Card" <?php if($workorder->payment_method == 'Credit Card'){ echo 'selected'; } ?>>Credit Card</option>
                                                <option value="Debit Card" <?php if($workorder->payment_method == 'Debit Card'){ echo 'selected'; } ?>>Debit Card</option>
                                                <option value="ACH" <?php if($workorder->payment_method == 'ACH'){ echo 'selected'; } ?>>ACH</option>
                                                <option value="Venmo" <?php if($workorder->payment_method == 'Venmo'){ echo 'selected'; } ?>>Venmo</option>
                                                <option value="Paypal" <?php if($workorder->payment_method == 'Paypal'){ echo 'selected'; } ?>>Paypal</option>
                                                <option value="Square" <?php if($workorder->payment_method == 'Square'){ echo 'selected'; } ?>>Square</option>
                                                <option value="Invoicing" <?php if($workorder->payment_method == 'Invoicing'){ echo 'selected'; } ?>>Invoicing</option>
                                                <option value="Warranty Work" <?php if($workorder->payment_method == 'Warranty Work'){ echo 'selected'; } ?>>Warranty Work</option>
                                                <option value="Home Owner Financing" <?php if($workorder->payment_method == 'Home Owner Financing'){ echo 'selected'; } ?>>Home Owner Financing</option>
                                                <option value="e-Transfer" <?php if($workorder->payment_method == 'e-Transfer'){ echo 'selected'; } ?>>e-Transfer</option>
                                                <option value="Other Credit Card Professor" <?php if($workorder->payment_method == 'Other Credit Card Professor'){ echo 'selected'; } ?>>Other Credit Card Professor</option>
                                                <option value="Other Payment Type" <?php if($workorder->payment_method == 'Other Payment Type'){ echo 'selected'; } ?>>Other Payment Type</option>
                                            </select>
                                        </div> 
                                    </div>     
                                    <div class="form-group col-md-4">
                                        <b>Amount<small class="help help-sm"> ( $ )</small></b>
                                        <input type="text" class="form-control input-element border-top-0 border-right-0 border-left-0" name="payment_amount" id="payment_amount" value="<?php echo $workorder->payment_amount; ?>" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <b>Billing Date</b>
                                        <!-- <input type="date" class="form-control input-element border-top-0 border-right-0 border-left-0" name="billing_date" id=""  /> -->
                                        <select name="billing_date" id="" class="form-control custom-select m_select border-top-0 border-right-0 border-left-0">
                                                <option value=""></option>
                                                <?php for ($i=1; $i<=31; $i++ ) { ?>
                                                <option value="<?php echo $i; ?>" <?php if($agreeDetails->billing_date == $i){ echo 'selected'; }else{ echo ''; } ?>><?php echo $i; ?></option>
                                                <?php } ?>
                                            </select>
                                    </div>
                            </div>
                            <div class="row">                   
                                <div class="col-md-12">
                                            <input type="hidden" name="payment_method_value" id="payment_method_value" value="<?php echo $workorder->payment_method; ?>">
                                            <div id="invoicing" style="display:none;">
                                                <!-- <input type="checkbox" id="same_as"> <b>Same as above Address</b> <br><br> -->
                                                <div class="row">                   
                                                    <div class="col-md-6 form-group">
                                                        <label for="monitored_location" class="label-element">Mail Address</label>
                                                        <input type="text" class="form-control input-element" name="mail-address"
                                                            id="mail-address" placeholder="Monitored Location" value="<?php echo $payments->mail_address; ?>"/>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="city" class="label-element">City</label>
                                                            <input type="text" class="form-control input-element" name="mail_locality" id="mail_locality" placeholder="Enter Name" <?php echo $workorder->city; ?>/>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="state" class="label-element">State</label>
                                                        <input type="text" class="form-control input-element" name="mail_state"
                                                            id="mail_state" 
                                                            placeholder="Enter State" value="<?php echo $workorder->state; ?>"/>
                                                    </div>
                                                <!-- </div>
                                                <div class="row">   -->
                                                    <div class="col-md-6 form-group">
                                                        <label for="zip" class="label-element">ZIP</label> 
                                                            <input type="text" id="mail_postcode" name="mail_postcode" class="form-control input-element"  placeholder="Enter Zip" value="<?php echo $payments->zip_code; ?>"/>
                                                    </div>

                                                    <div class="col-md-6 form-group">
                                                        <label for="cross_street" class="label-element">Cross Street</label>
                                                        <input type="text" class="form-control input-element" name="mail_cross_street"
                                                            id="mail_cross_street" 
                                                            placeholder="Cross Street" value="<?php echo $payments->cross_street; ?>"/>
                                                    </div>                                        
                                                </div>
                                            </div>
                                        <div id="check_area" style="display:none;">
                                            <div class="row">                   
                                                <div class="form-group col-md-6">
                                                    <label for="job_type" class="label-element">Check Number</label>
                                                    <input type="text" class="form-control input-element" name="check_number" id="check_number" value="<?php echo $payments->check_number; ?>"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="job_type" class="label-element">Routing Number</label>
                                                    <input type="text" class="form-control input-element" name="routing_number" id="routing_number" value="<?php echo $payments->routing_number; ?>"/>
                                                </div>                                             
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="job_type" class="label-element">Account Number</label>
                                                    <input type="text" class="form-control input-element" name="account_number" id="account_number" value="<?php echo $payments->account_number; ?>"/>
                                                </div>                                       
                                            </div>
                                        </div>
                                        <div id="credit_card" style="display:none;">
                                            <div class="row">                   
                                                <div class="form-group col-md-6">
                                                    <label for="job_type" class="label-element">Credit Card Number</label>
                                                    <input type="text" class="form-control input-element" name="credit_number" id="credit_number" placeholder="0000 0000 0000 000" value="<?php echo $payments->credit_number; ?>"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="job_type" class="label-element">Credit Card Expiration</label>
                                                    <input type="text" class="form-control input-element" name="credit_expiry" id="credit_expiry" placeholder="MM/YYYY"/ value="<?php echo $payments->credit_expiry; ?>">
                                                </div>  
                                                <div class="form-group col-md-6">
                                                    <label for="job_type" class="label-element">CVC</label>
                                                    <input type="text" class="form-control input-element" name="credit_cvc" id="credit_cvc" placeholder="CVC" value="<?php echo $payments->credit_cvc; ?>"/>
                                                </div>                                             
                                            </div>
                                        </div>
                                        <div id="debit_card" style="display:none;">
                                            <div class="row">                   
                                                <div class="form-group col-md-6">
                                                    <label for="job_type" class="label-element">Credit Card Number</label>
                                                    <input type="text" class="form-control input-element" name="debit_credit_number" id="credit_number2" placeholder="0000 0000 0000 000" value="<?php echo $payments->credit_number; ?>" />
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="job_type" class="label-element">Credit Card Expiration</label>
                                                    <input type="text" class="form-control input-element" name="debit_credit_expiry" id="credit_expiry" placeholder="MM/YYYY" value="<?php echo $payments->credit_expiry; ?>"/>
                                                </div>  
                                                <div class="form-group col-md-6">
                                                    <label for="job_type" class="label-element">CVC</label>
                                                    <input type="text" class="form-control input-element" name="debit_credit_cvc" id="credit_cvc" placeholder="CVC" value="<?php echo $payments->credit_cvc; ?>"/>
                                                </div>                                            
                                            </div>
                                        </div>
                                        <div id="ach_area" style="display:none;">
                                            <div class="row">                   
                                                <div class="form-group col-md-6">
                                                    <label for="job_type" class="label-element">Routing Number</label>
                                                    <input type="text" class="form-control input-element" name="ach_routing_number" id="ach_routing_number" value="<?php echo $payments->routing_number; ?>" />
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="job_type" class="label-element">Account Number</label>
                                                    <input type="text" class="form-control input-element" name="ach_account_number" id="ach_account_number" value="<?php echo $payments->account_number; ?>" />
                                                </div>  
                                            </div>
                                        </div>
                                        <div id="venmo_area" style="display:none;">
                                            <div class="row">                   
                                                <div class="form-group col-md-6">
                                                    <label for="job_type" class="label-element">Account Credential</label>
                                                    <input type="text" class="form-control input-element" name="account_credentials" id="account_credentials" value="<?php echo $payments->account_credentials; ?>"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="job_type" class="label-element">Account Note</label>
                                                    <input type="text" class="form-control input-element" name="account_note" id="account_note" value="<?php echo $payments->account_note; ?>"/>
                                                </div>  
                                                <div class="form-group col-md-6">
                                                    <label for="job_type" class="label-element">Confirmation</label>
                                                    <input type="text" class="form-control input-element" name="confirmation" id="confirmation" value="<?php echo $payments->confirmation; ?>"/>
                                                </div>                                            
                                            </div>
                                        </div>
                                        <div id="paypal_area" style="display:none;">
                                            <div class="row">                   
                                                <div class="form-group col-md-6">
                                                    <label for="job_type" class="label-element">Account Credential</label>
                                                    <input type="text" class="form-control input-element" name="paypal_account_credentials" id="paypal_account_credentials" value="<?php echo $payments->account_credentials; ?>"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="job_type" class="label-element">Account Note</label>
                                                    <input type="text" class="form-control input-element" name="paypal_account_note" id="paypal_account_note" value="<?php echo $payments->account_note; ?>"/>
                                                </div>  
                                                <div class="form-group col-md-6">
                                                    <label for="job_type" class="label-element">Confirmation</label>
                                                    <input type="text" class="form-control input-element" name="paypal_confirmation" id="paypal_confirmation" value="<?php echo $payments->confirmation; ?>"/>
                                                </div>                                            
                                            </div>
                                        </div>
                                        <div id="square_area" style="display:none;">
                                            <div class="row">                   
                                                <div class="form-group col-md-6">
                                                    <label for="job_type" class="label-element">Account Credential</label>
                                                    <input type="text" class="form-control input-element" name="square_account_credentials" id="square_account_credentials" value="<?php echo $payments->account_credentials; ?>"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="job_type" class="label-element">Account Note</label>
                                                    <input type="text" class="form-control input-element" name="square_account_note" id="square_account_note" value="<?php echo $payments->account_note; ?>"/>
                                                </div>  
                                                <div class="form-group col-md-6">
                                                    <label for="job_type" class="label-element">Confirmation</label>
                                                    <input type="text" class="form-control input-element" name="square_confirmation" id="square_confirmation" value="<?php echo $payments->confirmation; ?>"/>
                                                </div>                                            
                                            </div>
                                        </div>
                                        <div id="warranty_area" style="display:none;">
                                            <div class="row">                   
                                                <div class="form-group col-md-6">
                                                    <label for="job_type" class="label-element">Account Credential</label>
                                                    <input type="text" class="form-control input-element" name="warranty_account_credentials" id="warranty_account_credentials" value="<?php echo $payments->account_credentials; ?>"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="job_type" class="label-element">Account Note</label>
                                                    <input type="text" class="form-control input-element" name="warranty_account_note" id="warranty_account_note" value="<?php echo $payments->account_note; ?>"/>
                                                </div>                                         
                                            </div>
                                        </div>
                                        <div id="home_area" style="display:none;">
                                            <div class="row">                   
                                                <div class="form-group col-md-6">
                                                    <label for="job_type" class="label-element">Account Credential</label>
                                                    <input type="text" class="form-control input-element" name="home_account_credentials" id="home_account_credentials" value="<?php echo $payments->account_credentials; ?>"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="job_type" class="label-element">Account Note</label>
                                                    <input type="text" class="form-control input-element" name="home_account_note" id="home_account_note" value="<?php echo $payments->account_note; ?>"/>
                                                </div>                                         
                                            </div>
                                        </div>
                                        <div id="e_area" style="display:none;">
                                            <div class="row">                   
                                                <div class="form-group col-md-6">
                                                    <label for="job_type" class="label-element">Account Credential</label>
                                                    <input type="text" class="form-control input-element" name="e_account_credentials" id="e_account_credentials" value="<?php echo $payments->account_credentials; ?>"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="job_type" class="label-element">Account Note</label>
                                                    <input type="text" class="form-control input-element" name="e_account_note" id="e_account_note" value="<?php echo $payments->account_note; ?>"/>
                                                </div>                                         
                                            </div>
                                        </div>
                                        <div id="other_credit_card" style="display:none;">
                                            <div class="row">                   
                                                <div class="form-group col-md-6">
                                                    <label for="job_type" class="label-element">Credit Card Number</label>
                                                    <input type="text" class="form-control input-element" name="other_credit_number" id="other_credit_number" placeholder="0000 0000 0000 000" value="<?php echo $payments->credit_number; ?>" />
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="job_type" class="label-element">Credit Card Expiration</label>
                                                    <input type="text" class="form-control input-element" name="other_credit_expiry" id="other_credit_expiry" placeholder="MM/YYYY" value="<?php echo $payments->credit_expiry; ?>"/>
                                                </div>  
                                                <div class="form-group col-md-6">
                                                    <label for="job_type" class="label-element">CVC</label>
                                                    <input type="text" class="form-control input-element" name="other_credit_cvc" id="other_credit_cvc" placeholder="CVC" value="<?php echo $payments->credit_cvc; ?>"/>
                                                </div>                                             
                                            </div>
                                        </div>
                                        <div id="other_payment_area" style="display:none;">
                                            <div class="row">                   
                                                <div class="form-group col-md-6">
                                                    <label for="job_type">Account Credential</label>
                                                    <input type="text" class="form-control input-element" name="other_payment_account_credentials" id="other_payment_account_credentials" value="<?php echo $payments->account_credentials; ?>"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="job_type">Account Note</label>
                                                    <input type="text" class="form-control input-element" name="other_payment_account_note" id="other_payment_account_note" value="<?php echo $payments->account_note; ?>"/>
                                                </div>                                         
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="row">                   
                                <div class="form-group col-md-12">
                                    <b>Notes</b>
                                    <!-- <textarea class="form-control" style="width:100%;"></textarea> -->
                                    <div class="form-group">
                                        <textarea class="form-control" name="notes" rows="3"> <?php echo $workorder->comments; ?></textarea>
                                    </div>
                                </div>                                        
                            </div>
                            <div class="row" style="margin-top:-46px;">
                                <!-- <div class="form-group col-md-12"> -->
                                    <div class="col-md-6">
                                        <input type="text" name="sales_re_name" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreeDetails->sales_re_name; ?>">
                                        <b>Sales Rep's Name</b>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="sale_rep_phone" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreeDetails->sale_rep_phone; ?>">
                                        <b>Cell Phone</b>
                                    </div>     
                                <!-- </div> -->
                            </div>   
                            <div class="row">                   
                                <div class="form-group col-md-12">
                                    <input type="text" name="team_leader" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreeDetails->team_leader; ?>">
                                    <b>Team Leader / Mentor</b>
                                </div>                                        
                            </div>
                        </div>
                        
                        <div class=" col-md-6">
                            <div style="padding:1%;border:solid black 1px;font-weight:bold;">
                                <div class="row" align="center">
									<div class="col-md-6">
										<input type="text" class="form-control input-element border-top-0 border-right-0 border-left-0" name="password" placeholder="Enter Password" required
												   id="password" value="<?php echo $workorder->password; ?>">
										<b>Password</b> <span class="form-required">*</span>
									</div>
									<div class="col-md-6">
										<input type="text" class="form-control input-element border-top-0 border-right-0 border-left-0" name="ssn"
												   id="ssn"
												   placeholder="XXX-XX-XXXX" value="<?php echo $workorder->security_number; ?>"/>
                                        <b>SSN</b> <small class="help help-sm">(optional)</small>
									</div>
                                </div>
                            </div>
                            <br>
                            <center>
                            <div class="front" style="text-align:center;background-color:#4a5594;color:white;padding:0.5%;border-radius:20px;width:100%;">
                                <h6>Please Fill in the Details:</h6>
                            </div>
                            </center>
                            <br>
                                <div class="row"> 
                                    <div class="col-md-6">
                                        <input type="text" name="firstname" id="firstname" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreeDetails->firstname; ?>" onkeyup="primaryName()">
                                        <b>First name:</b>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="lastname" id="lastname" class="form-control border-top-0 border-right-0 border-left-0" onkeyup="primaryName()" value="<?php echo $agreeDetails->lastname; ?>">
                                        <b>Last name:</b>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-6">
                                        <input type="text" name="firstname_spouse" id="firstname" class="form-control border-top-0 border-right-0 border-left-0" onkeyup="primaryName()" value="<?php echo $agreeDetails->firstname_spouse; ?>">
                                        <b>First name (Spouse):</b>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="lastname_spouse" id="lastname" class="form-control border-top-0 border-right-0 border-left-0" onkeyup="primaryName()" value="<?php echo $agreeDetails->lastname_spouse; ?>">
                                        <b>Last name (Spouse):</b>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-12">
                                        <input type="text" name="address" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreeDetails->address; ?>">
                                        <b>Address:</b>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-8">
                                        <input type="text" name="city" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreeDetails->city; ?>">
                                        <b>City:</b>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="state" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreeDetails->state; ?>"> 
                                        <b>State:</b>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-5">
                                        <input type="text" name="postcode" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreeDetails->postcode; ?>">
                                        <b>Postcode:</b>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" name="county" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreeDetails->county; ?>">
                                        <b>County:</b>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-12">
                                        <input type="text" name="phone" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $workorder->phone_number; ?>">
                                        <b>Phone:</b>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-12">
                                        <input type="text" name="mobile" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $workorder->mobile_number; ?>">
                                        <b>Mobile:</b>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-12">
                                        <input type="text" name="email" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $workorder->email; ?>">
                                        <b>Email:</b>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-5">
                                        <input type="text" name="first_ecn" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreeDetails->first_ecn; ?>">
                                        <b>1st Emergency Contact Name:</b>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" name="first_ecn_no" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreeDetails->first_ecn_no; ?>">
                                        <b>Phone:</b>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-5">
                                        <input type="text" name="second_ecn" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreeDetails->second_ecn; ?>">
                                        <b>2nd Emergency Contact Name:</b>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" name="second_ecn_no" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreeDetails->second_ecn_no; ?>">
                                        <b>Phone:</b>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-5">
                                        <input type="text" name="third_ecn" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreeDetails->third_ecn; ?>">
                                        <b>3rd Emergency Contact Name:</b>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" name="third_ecn_no" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreeDetails->third_ecn_no; ?>">
                                        <b>Phone:</b>
                                    </div>
                                </div>
                                <br>
                                <div class="row"> 
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-sm" style="width:80%;">
                                            <tr>
                                                <td>Equipment Cost</td>
                                                <td>
                                                    <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <h4>$ <span class="equipment_cost"><?php echo number_format($workorder->subtotal,2); ?></span></h4> 
                                                    </div> &nbsp;
                                                    <input type="hidden" class="form-control border-top-0 border-right-0 border-left-0 border-bottom-0" style="font-size:20px;font-weight:bold;color:black;background-color: #fff;height:100%;" aria-label="Amount (to the nearest dollar)" id="equipmentCost" name="equipmentCost" value="<?php echo number_format($workorder->subtotal,2); ?>" readonly>
                                                    </div>
                                                    <!-- <input type="text" class="form-control border-top-0 border-right-0 border-left-0 border-bottom-0"> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Sales Tax</td>
                                                <td>
                                                    <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <h4>$ &nbsp;<span class="sales_tax_total"><?php echo number_format($workorder->taxes,2); ?></span></h4> 
                                                    </div> &nbsp;
                                                    <input type="hidden" class="form-control border-top-0 border-right-0 border-left-0 border-bottom-0" style="font-size:20px;font-weight:bold;color:black;" aria-label="Amount (to the nearest dollar)" id="salesTax" name="salesTax" value="<?php echo number_format($workorder->taxes,2); ?>"  onkeyup="getTotalPrices()">
                                                    </div>
                                                    <!-- <input type="text" class="form-control border-top-0 border-right-0 border-left-0 border-bottom-0"> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Installation Cost</td>
                                                <td>
                                                    <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <h4>$</h4> 
                                                    </div> &nbsp;
                                                    <input type="text" class="form-control border-top-0 border-right-0 border-left-0 border-bottom-0" style="margin: 10px 0;font-family: Sarabun, sans-serif;font-weight: 600;color:black;font-size: 1.5rem;" aria-label="Amount (to the nearest dollar)" id="installationCost" name="installationCost" value="<?php echo number_format($workorder->installation_cost,2); ?>"  onkeyup="getTotalPrices()">
                                                    </div>
                                                    <!-- <input type="text" class="form-control border-top-0 border-right-0 border-left-0 border-bottom-0"> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>One time (Program and Setup)</td>
                                                <td>
                                                    <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <h4>$</h4> 
                                                    </div> &nbsp;
                                                    <input type="text" class="form-control border-top-0 border-right-0 border-left-0 border-bottom-0" style="margin: 10px 0;font-family: Sarabun, sans-serif;font-weight: 600;color:black;font-size: 1.5rem;" aria-label="Amount (to the nearest dollar)" id="otps" name="otps" value="<?php echo number_format($workorder->otp_setup,2); ?>"  onkeyup="getTotalPrices()">
                                                    </div>
                                                    <!-- <input type="text" class="form-control border-top-0 border-right-0 border-left-0 border-bottom-0"> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Monthly Monitoring</td>
                                                <td>
                                                    <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <h4>$</h4> 
                                                    </div> &nbsp;
                                                    <input type="text" class="form-control border-top-0 border-right-0 border-left-0 border-bottom-0" style="margin: 10px 0;font-family: Sarabun, sans-serif;font-weight: 600;color:black;font-size: 1.5rem;" aria-label="Amount (to the nearest dollar)" id="monthlyMonitoring" name="monthlyMonitoring" value="<?php echo number_format($workorder->monthly_monitoring,2); ?>"  onkeyup="getTotalPrices()">
                                                    </div>
                                                    <!-- <input type="text" class="form-control border-top-0 border-right-0 border-left-0 border-bottom-0"> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total Due</td>
                                                <td>
                                                    <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <h4>$ &nbsp;<span id="totalDue"><?php echo number_format($workorder->grand_total,2); ?></span></h4> 
                                                    </div> &nbsp;
                                                    <input type="hidden" class="form-control border-top-0 border-right-0 border-left-0 border-bottom-0 totalDue" style="font-size:20px;font-weight:bold;color:black;background-color: #fff;" aria-label="Amount (to the nearest dollar)" id="totalDue" name="totalDue" value="<?php echo number_format($workorder->grand_total,2); ?>" readonly>
                                                    </div>
                                                    <!-- <input type="text" class="form-control border-top-0 border-right-0 border-left-0 border-bottom-0"> -->
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!-- <br>
                                <div class="row"> 
                                    <div class="col-md-12" style="border: solid gray 1px;border-top-left-radius: 25px;border-top-right-radius: 25px;">
                                    <center><h4>ENERGY USAGE HISTORY SAMPLE</h4></center>
                                        <div id="chartdiv"></div>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-12" style="border: solid gray 1px;border-bottom-left-radius: 25px;border-bottom-right-radius: 25px;padding:2%;">
                                        <b style="font-size:16px;">Options:</b><br>
                                        <input type="checkbox" name="options[]" value="roof" class="form-"> Roof &emsp;
                                        <input type="checkbox" name="options[]" value="tree removal" class="form-"> Tree Removal &emsp;
                                        <input type="checkbox" name="options[]" value="battery package" class="form-"> Battery Package &emsp;
                                        <input type="checkbox" name="options[]" value="security" class="form-"> Security  <br>
                                        <input type="checkbox" name="options[]" value="others" class="form-"> Others
                                    </div>
                                </div> -->
                            
                        </div>
                    </div>

                    <br><br>
                             <!-- ====== SIGNATURE ====== -->
                             <div class="row">
                                <div class=" col-md-12">
                                    <div class="work_nore">
                                        <!-- <h6>Use of Personal Information Collected</h6>
                                        <p>We use the information we collect to provide you with our products and services and to respond to your questions. We also use the information for editorial and feedback purposes, for marketing and promotional purposes, to inform advertisers as to how many visitors have seen or clicked on their advertisements and to customize the content and layout of ClearCaptions' website. We also use the information we collect for statistical analysis of users' behavior, for product development, for content improvement, to ensure our product and services remain functioning and secure and to investigate and protect against any illegal activities or violations of our Terms of Service.</p> -->
                                        <h6>Agreement</h6>
                                        <div style="background:#FFFFFF; padding-left:10px;" id="thisdiv2">
                                        <?php echo $workorder->terms_and_conditions; ?></p>
                                                <input type="hidden" id="company_id" value="<?php echo getLoggedCompanyID(); ?>">
                                                <input type="hidden" class="form-control" name="terms_conditions" id="terms_conditions" value="<?php echo $workorder->terms_and_conditions; ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <!-- <div class="row signature_web"> -->
                            <div class="row signature_web">
                                <div class="col-md-4">
                                    <h6>Company Representative Approval &emsp; <a data-toggle="modal" data-target=".companySignature"><i class="fa fa-pencil" aria-hidden="true"></i></a> </h6>
                                    <img src="<?php echo base_url($workorder->company_representative_signature); ?>" class="img1">
                                    <div id="companyrep"></div>
                                    <br>

                                    <label for="comp_rep_approval">Printed Name</label>
                                    <!-- <input type="text" class="form-control mb-3"
                                           name="company_representative_printed_name"
                                           id="comp_rep_approval" value="<?php //echo $workorder->company_representative_name; ?>" />-->
                                        <select class="form-control mb-3" name="company_representative_printed_name">
                                            <option value="0">Select Name</option>
                                            <?php foreach($users_lists as $ulist){ ?>
                                                <option <?php if(isset($workorder)){ if($workorder->company_representative_name == $ulist->id){echo "selected";} } ?>  value="<?php echo $ulist->id ?>"><?php echo $ulist->FName .' '.$ulist->LName; ?></option>
                                            <?php } ?>
                                        </select>
                                           <input type="hidden" id="saveCompanySignatureDB1aM_web" name="company_representative_approval_signature1aM_web"> 

                                </div>
                                <div class="col-md-4">
                                    <h6>Primary Account Holder &emsp; <a data-toggle="modal" data-target=".primarySignature"><i class="fa fa-pencil" aria-hidden="true"></i></a></h6>
                                    <img src="<?php echo base_url($workorder->primary_account_holder_signature); ?>" class="img2">
                                    <div id="primaryrep"></div>
                                    <br>

                                    <label for="comp_rep_approval">Printed Name</label>
                                    <input type="text" class="form-control mb-3" name="primary_account_holder_name"
                                           id="comp_rep_approval" placeholder="" value="<?php echo $workorder->primary_account_holder_name; ?>"/>

                                        <!-- <select class="form-control mb-3" name="primary_account_holder_name">
                                            <option value="0">Select Name</option>
                                            <?php //foreach($users_lists as $ulist){ ?>
                                                <option <?php //if(isset($workorder)){ if($workorder->primary_account_holder_name == $ulist->id){echo "selected";} } ?>  value="<?php //echo $ulist->id ?>"><?php echo $ulist->FName .' '.$ulist->LName; ?></option>
                                            <?php //} ?>
                                        </select> -->

                                           <input type="hidden" id="saveCompanySignatureDB1aM_web2" name="primary_representative_approval_signature1aM_web">

                                </div>
                                <div class="col-md-4">
                                    <h6>Secondary Account Holder &emsp; <a data-toggle="modal" data-target=".secondarySignature"><i class="fa fa-pencil" aria-hidden="true"></i></a></h6>
                                    <img src="<?php echo base_url($workorder->secondary_account_holder_signature); ?>" class="img3">
                                    <div id="secondaryrep"></div>
                                    <br>

                                    <label for="comp_rep_approval">Printed Name</label>
                                    <input type="text" class="form-control mb-3" name="secondery_account_holder_name"
                                           id="comp_rep_approval" placeholder="" value="<?php echo $workorder->secondary_account_holder_name; ?>"/>
                                        <!-- <select class="form-control mb-3" name="secondery_account_holder_name">
                                            <option value="0">Select Name</option>
                                            <?php //foreach($users_lists as $ulist){ ?>
                                                <option <?php //if(isset($workorder)){ if($workorder->secondary_account_holder_name == $ulist->id){echo "selected";} } ?>  value="<?php //echo $ulist->id ?>"><?php echo $ulist->FName .' '.$ulist->LName; ?></option>
                                            <?php //} ?>
                                        </select> -->

                                           <input type="hidden" id="saveCompanySignatureDB1aM_web3" name="secondary_representative_approval_signature1aM_web">

                                </div>
                            </div>

                            <br><br><br><br><br>
                            <div>
                                <div class="form-group">
                                        <button type="submit" name="action" class="btn btn-flat btn-primary" value="submit">Submit</button>
                                        <!-- <button type="submit" name="action" class="btn btn-flat btn-success pdf_sheet" target="_blank" value="preview">Preview</button> -->
                                        <button type="submit" class="btn btn-flat btn-success"><b>Send to Customer</b></button>
                                        <a href="<?php echo url('workorder') ?>" class="btn btn-danger">Cancel this</a>
                                </div>
                            </div>



        <?php echo form_close(); ?>
    </div>
    <!-- end container-fluid -->
</div>

<!-- first signature -->

<div class="modal fade companySignature" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                            <div align="center">
                                <p style="padding:2%;background-color:#d2d2d2;width:380px;"> <b>Company Representative Approval </b></p>
                                <div align="center"><i><p style="padding:2%;background-color:#d2d2d2;width:80%;"> By Signing below you verify that the above information is true and complete,
                                            and you authorize payment and confirmation with nSmarTrac. </p></i></div>
                            </div>
                                    <div class="box-wrap">
                                        
                                        <div id="box-one">
                                        <div class="row">
                                        <div class="col-md-12" style="padding:1%;">
                                        <center>
                                        <div id="signArea" >
                                            <canvas id="canvasb" style="border: solid gray 1px;"></canvas>
                                            <input type="hidden" class="form-control mb-3" name="company_representative_printed_name" id="comp_rep_approval1" value="Company Representative"/>
                                            <input type="hidden" id="saveCompanySignatureDB1aMb" name="company_representative_approval_signature1aM">
                                            </div>
                                            </div>
                                            <br>
                                        </div>
                                        </center>
                                        </div>
                                    
                                    </div>
                        
                        <div class="modal-footer">
                        
                            <button id="clear" class="btn btn-danger">Clear</button>
                            <button type="button" class="btn btn-success edit_first_signature" id="enter_signature">Add</button>
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
                                <p style="padding:2%;background-color:#d2d2d2;width:380px;"> <b>Primary Account Holder</b> </p>
                                <div align="center"><i><p style="padding:2%;background-color:#d2d2d2;width:80%;"> By Signing below you verify that the above information is true and complete,
                                            and you authorize payment and confirmation with nSmarTrac. </p></i></div>
                            </div>
                                    <div class="box-wrap">
                                        
                                        <div id="box-one">
                                        <div class="row">
                                        <div class="col-md-12" style="padding:1%;">
                                        <center>
                                        <div id="signArea2" >
                                            <canvas id="canvas2b" style="border: solid gray 1px;"></canvas>
                                            <input type="hidden" class="form-control mb-3" name="primary_representative_printed_name" id="comp_rep_approval2" value="Primary Account Holder"/>
                                            <input type="hidden" id="savePrimaryAccountSignatureDB2aMb" name="primary_account_holder_signature2aM">
                                            </div>
                                            </div>
                                            <br>
                                            </div>
                                        </center>
                                        </div>
                                    
                                    </div>
                        
                        <div class="modal-footer">
                            <button id="clear2" class="btn btn-danger">Clear</button>
                            <button type="button" class="btn btn-success edit_second_signature" id="enter_signature">Add</button>
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
                                <p style="padding:2%;background-color:#d2d2d2;width:380px;"> <b>Secondary Account Holder</b> </p>
                                <div align="center"><i><p style="padding:2%;background-color:#d2d2d2;width:80%;"> By Signing below you verify that the above information is true and complete,
                                            and you authorize payment and confirmation with nSmarTrac. </p></i></div>
                            </div>
                                    <div class="box-wrap">
                                        
                                        <div id="box-one">
                                        <div class="row">
                                        <div class="col-md-12" style="padding:1%;">
                                        <center>
                                        <div id="signArea3" >
                                            <canvas id="canvas3b" style="border: solid gray 1px;"></canvas>
                                            <input type="hidden" class="form-control mb-3" name="secondary_representative_printed_name" id="comp_rep_approval3" value="Secondary Account Holder"/>
                                            <input type="hidden" id="saveSecondaryAccountSignatureDB3aMb" name="secondary_account_holder_signature3aM">
                                            </div>
                                            </div>
                                            <br>
                                        </div>
                                        </center>
                                        </div>
                                    
                                    </div>
                        
                        <div class="modal-footer">
                            <button id="clear3" class="btn btn-danger">Clear</button>
                            <button type="button" class="btn btn-success edit_third_signature" id="enter_signature">Add</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <!-- <input type="submit" value="save" id="btnSaveSign"> -->
                        </div>
                    </div>
                </div>
            </div>



<?php include viewPath('includes/footer'); ?>
<script src="<?php echo $url->assets;?>js/jquery-input-mask-phone-number.js"></script>

<!-- Resources -->
<script src="//cdn.amcharts.com/lib/4/core.js"></script>
<script src="//cdn.amcharts.com/lib/4/charts.js"></script>
<script src="//cdn.amcharts.com/lib/4/themes/animated.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>

<script>
  $( function() {
    $( "#datepicker_date" ).datepicker({
        format: 'mm/dd/yyyy'
    });
  } );

  $('#clear').click(function() {
  $('#signArea').signaturePad().clearCanvas();
});

$('#clear2').click(function() {
  $('#signArea2').signaturePad().clearCanvas();
});

$('#clear3').click(function() {
  $('#signArea3').signaturePad().clearCanvas();
});
</script>
<!-- Chart code -->
<script>
jQuery(document).ready(function () {

    var paymentMethod = $('#payment_method_value').val();
    
    if(paymentMethod == 'Cash')
    {
        
    }
    else if(paymentMethod == 'Check')
    {
        $("#check_area").show();
    }
    else if(paymentMethod == 'Credit Card')
    {
        $("#credit_card").show();
    }
    else if(paymentMethod == 'Debit Card')
    {
        $("#debit_card").show();
    }
    else if(paymentMethod == 'ACH')
    {
        $("#ach_area").show();
    }
    else if(paymentMethod == 'Venmo')
    {
        $("#venmo_area").show();
    }
    else if(paymentMethod == 'Paypal')
    {
        // alert('test');
        // $("#paypal_area").css("display", "block");
        $('#paypal_area').show();
    }
    else if(paymentMethod == 'Square')
    {
        $("#square_area").show();
    }
    else if(paymentMethod == 'Invoicing')
    {
        $("#invoicing").show();
    }
    else if(paymentMethod == 'Warranty Work')
    {
        $("#warranty_area").show();
    }
    else if(paymentMethod == 'Home Owner Financing')
    {
        $("#home_area").show();
    }
    else if(paymentMethod == 'e-Transfer')
    {
        $("#e_area").show();
    }
    else if(paymentMethod == 'Other Credit Card Professor')
    {
        $("#other_credit_card").show();
    }
    else if(paymentMethod == 'Other Payment Type')
    {
        $("#other_payment_area").show();
    }
    // else
    // {
    //     alert(paymentMethod);
    // }
});

function primaryName(){
     // $('.invAetf').keyup(function(e){
      // alert('kk');
      var one = $('#firstname').val();
      var two = $('#lastname').val();
      $('#primary_account_holder_name').val(one +' '+ two);
  }

  function getTotalPrices(){
    var val2 = 0;
      $('.allprices').each(function(){

        var a = $(this).val();
        
        var c = $(this).val(numeral(a).format('0,0[.]00'));
        var am=$(this).val(a.replaceAll(",",""));
        val2+=(parseFloat(c.val()) || 0);
        // var c = $(this).val(commaSeparateNumber(a));
      });
    //   $('#pg_av_total_read_data').val(commaSeparateNumber(val3));
    var installationCost = $('#installationCost').val();
    var otps = $('#otps').val();
    var monthlyMonitoring = $('#monthlyMonitoring').val();
    // var totalDue = $('#totalDue').val();
    
    // var eq = val2.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    var eq = val2;
    $('#equipmentCost').val(eq);
    $('.equipment_cost').html(eq);

    var ec = $('#equipmentCost').val();
    // var ec_wcomma = ec.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    
    var grandtaxes = (parseFloat(ec) * (7.5/100));
    // var grandtaxes = parseFloat(eq) * 0.075;
    $('#salesTax').val(grandtaxes.toFixed(2))
    var salesTax = $('#salesTax').val();
    $('.sales_tax_total').html(grandtaxes.toFixed(2));

    var overAllTotal = parseFloat(val2) + parseFloat(salesTax) + parseFloat(installationCost) + parseFloat(otps) + parseFloat(monthlyMonitoring);
    // var val3 = overAllTotal.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    var val3 = overAllTotal;

    var val4 = $('#totalDue').html(val3.toFixed(2));
    $('.totalDue').val(val3.toFixed(2));
    // });

    // var number = document.getElementById('pg_av_total_read_data');
    // number.onkeydown = function(e) {

    // }
  }
$('.checkOneOne').on('change', function() {
    $('input[name="' + this.name + '"]').not(this).prop('checked', false);
    $('.checkedDataOne').val(this.value);
});

$('.checkOneTwo').on('change', function() {
    $('input[name="' + this.name + '"]').not(this).prop('checked', false);
    $('.checkedDataTwo').val(this.value);
});

$('.checkOneThree').on('change', function() {
    $('input[name="' + this.name + '"]').not(this).prop('checked', false);
    $('.checkedDataThree').val(this.value);
});

$('.ctrans_check').on('change', function() {
    $('input[name="' + this.name + '"]').not(this).prop('checked', false);
    $('.dtrans_check').val(this.value);
});

$('.ccam_check').on('change', function() {
    $('input[name="' + this.name + '"]').not(this).prop('checked', false);
    $('.dcam_check').val(this.value);
});


// $('#checkedDataThree').on('change', function() {
//     $('input[id="' + this.name + '"]').not(this).prop('checked', false);

// //   var s = $('#checkedDataThree:checked').map(function() {
// //     return this.value;
// //   }).get().join(',');
// //   $('.checkedDataThree').val((s.length > 0 ? s : ""));
// });

/**
 * ---------------------------------------
 * This demo was created using amCharts 4.
 *
 * For more information visit:
 * https://www.amcharts.com/
 *
 * Documentation is available at:
 * https://www.amcharts.com/docs/v4/
 * ---------------------------------------
 */


am4core.useTheme(am4themes_animated);

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.paddingTop = 40;
// Add data
chart.data = [{
  "category": "Jan",
  "value": 1240
}, {
  "category": "Feb",
  "value": 1000
}, {
  "category": "Mar",
  "value": 450
}, {
  "category": "Apr",
  "value": 700
}, {
  "category": "May",
  "value": 800
}, {
  "category": "Jun",
  "value": 800
}, {
  "category": "Jul",
  "value": 780
}, {
  "category": "Aug",
  "value": 500
}, {
  "category": "Sep",
  "value": 100
}, {
  "category": "Oct",
  "value": 1000
}, {
  "category": "Nov",
  "value": 900
}, {
  "category": "Dec",
  "value": 620
}
];

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "category";
categoryAxis.renderer.grid.template.location = 0;

function createValueAxis(title, showgrid) {
  
  // Create axis
  var axis = chart.yAxes.push(new am4charts.ValueAxis());
  axis.renderer.grid.template.disabled = !showgrid;
    
  // Set up axis title
  axis.title.text = title;
  
  return axis;
}

function createSeries(key, title, axis) {
  var series = chart.series.push(new am4charts.ColumnSeries());
  series.dataFields.valueY = key;
  series.dataFields.categoryX = "category";
  series.yAxis = axis;
  return series;
}

createSeries(
  "value",
  "Series #1",
  createValueAxis("KWH", true)
);

// createSeries(
//   "value2",
//   "Series #2",
//   createValueAxis("Funding", false)
// );
</script>
<script>
    // var canvas = document.getElementById("canvas");    
    // var dataURL = canvas.toDataURL("image/png");
    // $("#saveCompanySignatureDB1aM").val(dataURL);

    // var canvas2 = document.getElementById("canvas2");    
    // var dataURL2 = canvas2.toDataURL("image/png");
    // $("#savePrimaryAccountSignatureDB2aM").val(dataURL2);

    // var canvas3 = document.getElementById("canvas3");    
    // var dataURL3 = canvas3.toDataURL("image/png");
    // $("#saveSecondaryAccountSignatureDB3aM").val(dataURL3);

$(document).on('click touchstart','#canvas',function(){
    // alert('test');
    var canvas_web = document.getElementById("canvas");    
    var dataURL = canvas_web.toDataURL("image/png");
    $("#saveCompanySignatureDB1aM").val(dataURL);
});

$(document).on('click touchstart','#canvas2',function(){
    // alert('test');
    var canvas_web2 = document.getElementById("canvas2");    
    var dataURL = canvas_web2.toDataURL("image/png");
    $("#savePrimaryAccountSignatureDB2aM").val(dataURL);
});

$(document).on('click touchstart','#canvas3',function(){
    // alert('test');
    var canvas_web3 = document.getElementById("canvas3");    
    var dataURL = canvas_web3.toDataURL("image/png");
    $("#saveSecondaryAccountSignatureDB3aM").val(dataURL);
});



$(document).on('click touchstart','.edit_first_signature',function(){
    // alert('test');
    var first = $("#saveCompanySignatureDB1aM").val();
    // alert(first);
    $("#saveCompanySignatureDB1aM_web").val(first);

    $(".img1").hide();

    var input_conf = '<img src="'+first+'">'

    $('#companyrep').html(input_conf);
    
    $('.companySignature').modal('hide');
    
});

$(document).on('click touchstart','.edit_second_signature',function(){
    // alert('test');
    var first = $("#savePrimaryAccountSignatureDB2aM").val();
    // alert(first);
    $("#saveCompanySignatureDB1aM_web2").val(first);

    $(".img2").hide();

    var input_conf = '<img src="'+first+'">'

    $('#primaryrep').html(input_conf);

    $('.primarySignature').modal('hide');
    
});

$(document).on('click touchstart','.edit_third_signature',function(){
    // alert('test');
    var first = $("#saveSecondaryAccountSignatureDB3aM").val();
    // alert(first);
    $("#saveCompanySignatureDB1aM_web3").val(first);

    $(".img3").hide();

    var input_conf = '<img src="'+first+'">'

    $('#secondaryrep').html(input_conf);

    $('.secondarySignature').modal('hide');
    
});
</script>
<script>
$('#security_number').keyup(function() {
        var val = this.value.replace(/\D/g, '');
        val = val.replace(/^(\d{3})/, '$1-');
        val = val.replace(/-(\d{2})/, '-$1-');
        val = val.replace(/(\d)-(\d{4}).*/, '$1-$2');
        this.value = val;
    });


// $('#phone_no').keyup(function () {
//     var foo = $(this).val().split("-").join(""); // remove hyphens
//     if (foo.length > 0) {
//         foo = foo.match(new RegExp('.{1,3}', 'g')).join("-");
//     }
//     $(this).val(foo);
// });

$('#phone_no').keyup(function() {
        var val = this.value.replace(/\D/g, '');
        val = val.replace(/^(\d{3})/, '$1-');
        val = val.replace(/-(\d{3})/, '-$1-');
        val = val.replace(/(\d)-(\d{4}).*/, '$1-$2');
        this.value = val;
    });

// $('#mobile_no').keyup(function () {
//     var foo = $(this).val().split("-").join(""); // remove hyphens
//     if (foo.length > 0) {
//         foo = foo.match(new RegExp('.{1,3}', 'g')).join("-");
//     }
//     $(this).val(foo);
// });

$('#mobile_no').keyup(function() {
        var val = this.value.replace(/\D/g, '');
        val = val.replace(/^(\d{3})/, '$1-');
        val = val.replace(/-(\d{3})/, '-$1-');
        val = val.replace(/(\d)-(\d{4}).*/, '$1-$2');
        this.value = val;
    });

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
  var signaturePadCanvas = document.querySelector('#canvasb');
//   var parentWidth = jQuery(signaturePadCanvas).parent().outerWidth();
//   signaturePadCanvas.setAttribute("width", parentWidth);
  signaturePad = new SignaturePad(signaturePadCanvas);

  signaturePadCanvas.width  = 780;
  signaturePadCanvas.height = 300;
});

var signaturePad2;
jQuery(document).ready(function () {
  var signaturePadCanvas2 = document.querySelector('#canvas2b');
//   var parentWidth = jQuery(signaturePadCanvas).parent().outerWidth();
//   signaturePadCanvas.setAttribute("width", parentWidth);
  signaturePad2 = new SignaturePad(signaturePadCanvas2);

  signaturePadCanvas2.width  = 780;
  signaturePadCanvas2.height = 300;
});

var signaturePad3;
jQuery(document).ready(function () {
  var signaturePadCanvas3 = document.querySelector('#canvas3b');
//   var parentWidth = jQuery(signaturePadCanvas).parent().outerWidth();
//   signaturePadCanvas.setAttribute("width", parentWidth);
  signaturePad3 = new SignaturePad(signaturePadCanvas3);

  signaturePadCanvas3.width  = 780;
  signaturePadCanvas3.height = 300;
});


$(document).on('click touchstart','#canvasb',function(){
    // alert('test');
    var canvas_web = document.getElementById("canvasb");    
    // alert(canvas_web);
    var dataURL = canvas_web.toDataURL("image/png");
    $("#saveCompanySignatureDB1aMb").val(dataURL);
});

$(document).on('click touchstart','#canvas2b',function(){
    // alert('test');
    var canvas_web2 = document.getElementById("canvas2b");    
    var dataURL = canvas_web2.toDataURL("image/png");
    $("#savePrimaryAccountSignatureDB2aMb").val(dataURL);
});

$(document).on('click touchstart','#canvas3b',function(){
    // alert('test');
    var canvas_web3 = document.getElementById("canvas3b");    
    var dataURL = canvas_web3.toDataURL("image/png");
    $("#saveSecondaryAccountSignatureDB3aMb").val(dataURL);
});


$(document).on('click touchstart','.edit_first_signature',function(){
    // alert('test');
    var first = $("#saveCompanySignatureDB1aMb").val();
    // alert(first);
    $("#saveCompanySignatureDB1aM_web").val(first);

    // $(".img1").hide();

    var input_conf = '<img src="'+first+'">'

    $('#companyrep').html(input_conf);
    
    $('.companySignature').modal('hide');
    
});

$(document).on('click touchstart','.edit_second_signature',function(){
    // alert('test');
    var first = $("#savePrimaryAccountSignatureDB2aMb").val();
    // alert(first);
    $("#saveCompanySignatureDB1aM_web2").val(first);

    // $(".img2").hide();

    var input_conf = '<img src="'+first+'">'

    $('#primaryrep').html(input_conf);

    $('.primarySignature').modal('hide');
    
});

$(document).on('click touchstart','.edit_third_signature',function(){
    // alert('test');
    var first = $("#saveSecondaryAccountSignatureDB3aMb").val();
    // alert(first);
    $("#saveCompanySignatureDB1aM_web3").val(first);

    // $(".img3").hide();

    var input_conf = '<img src="'+first+'">'

    $('#secondaryrep').html(input_conf);

    $('.secondarySignature').modal('hide');
    
});

$(document).on('click','.btn-edit-header',function(){
    //    alert('yeah');
    $('#update_header_modal').modal('show');
});
</script>

<script>
  $( function() {
    $( "#datepicker2" ).datepicker();
  } );
</script>


<script>

            $(document).ready(function() {
				// $('#canvas').signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:90});
                var canvas = document.getElementById("canvas");    
                var signaturePad = new SignaturePad(canvas);

                var canvas2 = document.getElementById("canvas2");    
                var signaturePad2 = new SignaturePad(canvas2);

                var canvas3 = document.getElementById("canvas3");    
                var signaturePad3 = new SignaturePad(canvas3);

                var canvas_web = document.getElementById("canvas_web");    
                var signaturePad4 = new SignaturePad(canvas_web);

			});

$("#btnSaveSign").click(function(e){
    var canvas = document.getElementById("canvas");    
    var dataURL = canvas.toDataURL("image/png");
    $("#saveCompanySignatureDB1aM").val(dataURL);
                        // console.log(dataURL);
						//ajax call to save image inside folder
						// $.ajax({
						// 	url: "<?php echo base_url(); ?>accounting/testSave",
						// 	data: { dataURL : dataURL },
						// 	type: 'post',
						// 	dataType: 'json',
						// 	success: function (response) {
						// 	   alert('success');
						// 	}
						// });

$.ajax({
    type : 'POST',
    url : "<?php echo base_url(); ?>accounting/testSave",
    data : {dataURL: dataURL},
    success: function(result){
    // $('#res').html('Signature Uploaded successfully');
    console.log(dataURL)
    // location.reload();
    
    },
    });
					
			});


</script>

<script>

function submit() {
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

        // var input_conf = '<br><div style="border:solid gray 1px;padding:2%;"><img id="image1" src="'+dataURL+'"></img><input type="hidden" class="form-control" name="signature1" id="signature1" value="'+ dataURL +'"><br><input type="text" class="form-control" name="name1" id="name1" value="'+ input1 +'" readonly></div><br><div style="border:solid gray 1px;padding:2%;"><img id="image1" src="'+dataURL2+'"></img><input type="hidden" class="form-control" name="signature2" id="signature2" value="'+ dataURL2 +'"><br><input type="text" class="form-control" name="name2" id="name2" value="'+ input2 +'" readonly></div><br><div style="border:solid gray 1px;padding:2%;"><img id="image1" src="'+dataURL3+'"></img><input type="hidden" class="form-control" name="signature3" id="signature3" value="'+ dataURL3 +'"><br><input type="text" class="form-control" name="name3" id="name3" value="'+ input3 +'" readonly></div>';

        var input_conf = '<br><div style="border:solid gray 1px;padding:2%;width:400px !important;"><img id="image1" src="'+dataURL+'"></img><input type="hidden" class="form-control" name="signature1" id="signature1" value="'+ dataURL +'"><br><input type="text" class="form-control" name="name1" id="name1" value="'+ input1 +'" readonly></div><br><div style="border:solid gray 1px;padding:2%;"><img id="image1" src="'+dataURL2+'"></img><input type="hidden" class="form-control" name="signature2" id="signature2" value="'+ dataURL2 +'"><br><input type="text" class="form-control" name="name2" id="name2" value="'+ input2 +'" readonly></div><br><div style="border:solid gray 1px;padding:2%;"><img id="image1" src="'+dataURL3+'"></img><input type="hidden" class="form-control" name="signature3" id="signature3" value="'+ dataURL3 +'"><br><input type="text" class="form-control" name="name3" id="name3" value="'+ input3 +'" readonly></div>';

        $("#saveCompanySignatureDB1aM_web").val(dataURL);
        $("#saveCompanySignatureDB1aM_web2").val(dataURL2);
        $("#saveCompanySignatureDB1aM_web3").val(dataURL3);

        $("#company_representative_printed_name").val(input1);
        $("#primary_account_holder_name").val(input2);
        $("#secondery_account_holder_name").val(input3);

        $('.signatureArea').html(input_conf);

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

<script>
$(document).ready(function(){
    if(window.matchMedia("(max-width: 600px)").matches){
        // alert("This is a mobile device.");
        $(document).on("click", ".testing", function () {
            $('.getItems').hide();
            $('#item_typeid').removeClass('form-control');
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
    $(document).on("focusout", "#one_time", function () {
        var counter = $(this).val();
        var m_monitoring = $("#m_monitoring").val();
        var subtotal = 0;
        // $("#span_total_0").each(function(){
            $('*[id^="span_total_"]').each(function(){
            subtotal += parseFloat($(this).text());
        });

        grand_tot = parseFloat(counter) + parseFloat(subtotal) + parseFloat(m_monitoring);
        //  alert(grand_tot);
        var grand = $("#grand_total_input").val(grand_tot.toFixed(2));

        $("#payment_amount").val(grand_tot.toFixed(2));
    });

    $(document).on("focusout", "#m_monitoring", function () {
        var counter = $(this).val();
        // var grand = $("#grand_total_input").val();
        var one_time = $("#one_time").val();
        var subtotal = 0;
        // $("#span_total_0").each(function(){
            $('*[id^="span_total_"]').each(function(){
            subtotal += parseFloat($(this).text());
        });

        grand_tot = parseFloat(counter) + parseFloat(subtotal) + parseFloat(one_time);
        //  alert(grand_tot);
        var grand = $("#grand_total_input").val(grand_tot.toFixed(2));
        $("#payment_amount").val(grand_tot.toFixed(2));
    });

    // $(document).on("checked", "#same_as", function () {
    //     alert('yeah');
    // });
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



<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlMWhWMHlxQzuolWb2RrfUeb0JyhhPO9c&libraries=places"></script> -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?= google_credentials()['api_key'] ?>&callback=initialize&libraries=&v=weekly"></script>
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

    document.getElementById('mobile_no_').addEventListener('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });
    document.getElementById('phone_no_').addEventListener('input', function (e) {
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
$("#headerID").val(function() { 

// Replace 'ok' with string you want to change, you can delete 'hello everyone' to remove the text
 var currentDate = $('#current_date').val();
      return $(this).val().replace("{curr_date}", currentDate);  

});
});

jQuery(function($){

// Replace 'td' with your html tag
$("#headerID").val(function() { 

    var companyName = $('#company_name').val();
// Replace 'ok' with string you want to change, you can delete 'hello everyone' to remove the text
      return $(this).val().replace("{comp_name}", companyName);  

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

jQuery(function($){

// Replace 'td' with your html tag
$("#terms_of_use").val(function() { 

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
      return $(this).val().replace("{current_date_3}", date);  

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

            // var phone = response['customer'].phone_h;
            // var new_phone = phone.value.replace(/(\d{3})\-?/g,'$1-');
            var phone = response['customer'].phone_h;
                // phone = normalize(phone);
            
            var mobile = response['customer'].phone_m;
                // mobile = normalize(mobile);

            var test_p = phone.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3")
            var test_m = mobile.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3")
            
            $("#job_location").val(response['customer'].mail_add);
            $("#email").val(response['customer'].email);
            $("#date_of_birth").val(response['customer'].date_of_birth);
            $("#phone_no").val(test_p);
            $("#mobile_no").val(test_m);
            $("#city").val(response['customer'].city);
            $("#state").val(response['customer'].state);
            $("#zip").val(response['customer'].zip_code);
            $("#cross_street").val(response['customer'].cross_street);
            $("#acs_fullname").val(response['customer'].first_name +' '+ response['customer'].last_name);

            $("#job_name").val(response['customer'].first_name + ' ' + response['customer'].last_name);

            $("#primary_account_holder_name").val(response['customer'].first_name + ' ' + response['customer'].last_name);
        
            },
                error: function(response){
                //alert('Error'+response);
       
                }
        });

        function normalize(phone) {
            //normalize string and remove all unnecessary characters
            phone = phone.replace(/[^\d]/g, "");

            //check if number length equals to 10
            if (phone.length == 10) {
                //reformat and return phone number
                return phone.replace(/(\d{3})(\d{3})(\d{4})/, "($1) $2-$3");
            }

            return null;
        }

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
    $(document).on('click', '.remove-checklist', function(){
        var checklist_row_id = $(this).attr('data-row');
        $("#s-checklist-"+checklist_row_id).remove();
    });

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

                  //console.log('yeahhhhhhhhhhhhhhh'+response['checklists'][0].checklist_name); 
                  //console.log(response); 

                  $("#checklist_modal").modal('hide')
                //   $("#checklist_added").html(response['checklists'].checklist_name);
                //   $(".business_name").html(response['client'].business_name);
                // var objJSON = JSON.parse(response['checklists'].checklist_name);
                // var inputs = "";
                // $.each(objJSON, function (i, v) {
                //     inputs += response['checklists'].checklist_name;
                // });

                //New Code
                var current_row  = $('.selected-checklists li').length + 1;
                var input_hidden = '<input type="hidden" name="checklists[]" value="'+response['checklists'][0].id+'" />';
                var check = '<li id="s-checklist-'+current_row+'" id="view_details" c_id="'+ response['checklists'][0].id +'">'+response['checklists'][0].checklist_name+' <a class="remove-checklist" data-row="'+current_row+'" href="javascript:void(0);"><i class="fa fa-trash-o icon"></i></a>'+input_hidden+'</li>';
                $(".selected-checklists").append(check);

                //Old code
                //var check = '<ul> <li id="view_details" ><h6>'+ response['checklists'][0].checklist_name +'</h6> </li> </ul>';
                //$("#checklist_added").append(check);

                
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

$('#modal_items_list').DataTable({
    "autoWidth" : false,
    "columnDefs": [
    { width: 540, targets: 0 },
    { width: 100, targets: 0 },
    { width: 100, targets: 0 }
    ],
    "ordering": false,
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
                $("#payment_amount").val(new_grand.toFixed(2));
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
                $("#payment_amount").val(total3.toFixed(2));
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
    $("#payment_amount").val(grand_total_w.toFixed(2));

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
$(".select_package").click(function () {
  var idd = this.id;
  console.log(idd);
  console.log($(this).data('itemname'));
  var title = $(this).data('itemname');
  var price = $(this).data('price');

    if(!$(this).data('quantity')){
    // alert($(this).data('quantity'));
    var qty = 0;
  }else{
    // alert('0');
    var qty = $(this).data('quantity');
  }
  

$.ajax({
    type: 'POST',
    url:"<?php echo base_url(); ?>workorder/select_package",
    data: {idd : idd },
    dataType: 'json',
    success: function(response){
        // alert('Successfully Change');
        console.log(response['items']);

        // var objJSON = JSON.parse(response['items'][0].title);
                var inputs = "";
                $.each(response['items'], function (i, v) {
                    inputs += v.title ;
                    var total_pu = v.price * v.units;
                    var total_tax = (v.price * v.units) * 7.5 / 100;
                    var total_temp = total_pu + total_tax;
                    var total = total_temp.toFixed(2);

                    
                  markup = "<tr id=\"ss\">" +
                      "<td width=\"35%\"><input value='"+v.title+"' type=\"text\" name=\"items[]\" class=\"form-control getItems\" ><input type=\"hidden\" value='"+v.id+"' name=\"itemid[]\" id=\"itemid\"><div class=\"show_mobile_view\"><span class=\"getItems_hidden\">"+v.title+"</span></div></td>\n" +
                      "<td width=\"20%\"><div class=\"dropdown-wrapper\"><select name=\"item_type[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></div></td>\n" +
                      "<td width=\"10%\"><input data-itemid='"+v.id+"' id='quantity_"+v.id+"' value='"+v.units+"' type=\"number\" name=\"quantity[]\" data-counter=\"0\"  min=\"0\" class=\"form-control qtyest2 mobile_qty \"></td>\n" +
                      "<td width=\"10%\"><input id='price_"+v.id+"' value='"+v.price+"'  type=\"number\" name=\"price[]\" class=\"form-control hidden_mobile_view \" placeholder=\"Unit Price\"><input type=\"hidden\" class=\"priceqty\" id='priceqty_"+v.id+"' value='"+total_pu+"'><div class=\"show_mobile_view\"><span class=\"price\">"+v.price+"</span><input type=\"hidden\" class=\"form-control price\" name=\"price_[]\" data-counter=\"0\" id=\"priceM_0\" min=\"0\" value='"+v.price+"'></div></td>\n" +
                    //   "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter=\"0\" id=\"discount_0\" value=\"0\" ></td>\n" +
                    // //  "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
                      "<td width=\"10%\" class=\"hidden_mobile_view\"><input type=\"number\" name=\"discount[]\" class=\"form-control discount\" id='discount_"+v.id+"' value=\"0\"></td>\n" +
                    // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
                      "<td width=\"20%\" class=\"hidden_mobile_view\"><input type=\"text\" data-itemid='"+v.id+"' class=\"form-control tax_change2\" name=\"tax[]\" data-counter=\"0\" id='tax1_"+v.id+"' min=\"0\" value='"+total_tax+"'></td>\n" +
                      "<td style=\"text-align: center\" class=\"hidden_mobile_view\" width=\"15%\"><span data-subtotal='"+total+"' id='span_total_"+v.id+"' class=\"total_per_item\">"+total+
                    // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
                      "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text"+v.id+"' value='"+total+"'></td>" +
                      "<td>\n" +
                        '<a href="#" class="remove btn btn-sm btn-success"><i class="fa fa-trash" aria-hidden="true"></i></a>\n' +
                        "</td>\n" +
                      "</tr>";
                    tableBody = $("#jobs_items_table_body");
                    tableBody.append(markup);
                    markup2 = "<tr id=\"sss\">" +
                      "<td >"+v.title+"</td>\n" +
                      "<td ></td>\n" +
                    "<td ></td>\n" +
                    "<td >"+v.price+"</td>\n" +
                    "<td ></td>\n" +
                    "<td >"+v.units+"</td>\n" +
                    "<td ></td>\n" +
                    "<td ></td>\n" +
                    "<td >0</td>\n" +
                    "<td ></td>\n" +
                      "<td ></td>\n" +
                      "</tr>";

                });
                // $("#input_container").html(inputs);
                
                tableBody2 = $("#device_audit_datas");
                tableBody2.append(markup2);
                // alert(inputs);

                var in_id = idd;
                var price = $("#price_" + in_id).val();
                var quantity = $("#quantity_" + in_id).val();
                var discount = $("#discount_" + in_id).val();
                var tax = (parseFloat(price) * 7.5) / 100;
                var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
                2
                );
                if( discount == '' ){
                discount = 0;
                }

                var total = (
                (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
                parseFloat(discount)
                ).toFixed(2);

                var total_wo_tax = price * quantity;

                // alert( 'yeah' + total);


                $("#priceqty_" + in_id).val(total_wo_tax);
                $("#span_total_" + in_id).text(total);
                $("#sub_total_text" + in_id).val(total);
                $("#tax_1_" + in_id).text(tax1);
                $("#tax1_" + in_id).val(tax1);
                $("#discount_" + in_id).val(discount);

                if( $('#tax_1_'+ in_id).length ){
                $('#tax_1_'+in_id).val(tax1);
                }

                if( $('#item_total_'+ in_id).length ){
                $('#item_total_'+in_id).val(total);
                }

                var eqpt_cost = 0;
                var total_costs = 0;
                var cnt = $("#count").val();
                var total_discount = 0;
                var pquantity = 0;
                for (var p = 0; p <= cnt; p++) {
                var prc = $("#price_" + p).val();
                var quantity = $("#quantity_" + p).val();
                var discount = $("#discount_" + p).val();
                var pqty = $("#priceqty_" + p).val();
                // var discount= $('#discount_' + p).val();
                // eqpt_cost += parseFloat(prc) - parseFloat(discount);
                pquantity += parseFloat(pqty);
                total_costs += parseFloat(prc);
                eqpt_cost += parseFloat(prc) * parseFloat(quantity);
                total_discount += parseFloat(discount);
                }
                //   var subtotal = 0;
                // $( total ).each( function(){
                //   subtotal += parseFloat( $( this ).val() ) || 0;
                // });

                var total_cost = 0;
                // $("#span_total_0").each(function(){
                $('*[id^="price_"]').each(function(){
                total_cost += parseFloat($(this).val());
                });

                // var totalcosting = 0;
                // $('*[id^="span_total_"]').each(function(){
                //   totalcosting += parseFloat($(this).val());
                // });


                // alert(total_cost);

                var tax_tot = 0;
                $('*[id^="tax1_"]').each(function(){
                tax_tot += parseFloat($(this).val());
                });

                over_tax = parseFloat(tax_tot).toFixed(2);
                // alert(over_tax);

                $("#sales_taxs").val(over_tax);
                $("#total_tax_input").val(over_tax);
                $("#total_tax_").text(over_tax);


                eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
                total_discount = parseFloat(total_discount).toFixed(2);
                stotal_cost = parseFloat(total_cost).toFixed(2);
                priceqty = parseFloat(pquantity).toFixed(2);
                // var test = 5;

                var subtotal = 0;
                // $("#span_total_0").each(function(){
                $('*[id^="span_total_"]').each(function(){
                subtotal += parseFloat($(this).text());
                });
                // $('#sum').text(subtotal);

                var subtotaltax = 0;
                // $("#span_total_0").each(function(){
                $('*[id^="tax_1_"]').each(function(){
                subtotaltax += parseFloat($(this).text());
                });


                var priceqty2 = 0;
                $('*[id^="priceqty_"]').each(function(){
                priceqty2 += parseFloat($(this).val());
                });

                $("#span_sub_total_invoice").text(priceqty2.toFixed(2));
                // $("#span_sub_total_invoice").text(priceqty);

                $("#eqpt_cost").val(eqpt_cost);
                $("#total_discount").val(total_discount);
                $("#span_sub_total_0").text(total_discount);
                // $("#span_sub_total_invoice").text(stotal_cost);
                // $("#item_total").val(subtotal.toFixed(2));
                $("#item_total").val(priceqty2.toFixed(2));

                var s_total = subtotal.toFixed(2);
                var adjustment = $("#adjustment_input").val();
                var grand_total = s_total - parseFloat(adjustment);
                var markup = $("#markup_input_form").val();
                var grand_total_w = grand_total + parseFloat(markup);

                // $("#total_tax_").text(subtotaltax.toFixed(2));
                // $("#total_tax_").val(subtotaltax.toFixed(2));




                $("#grand_total").text(grand_total_w.toFixed(2));
                $("#grand_total_input").val(grand_total_w.toFixed(2));
                $("#grand_total_inputs").val(grand_total_w.toFixed(2));
                $("#payment_amount").val(grand_total_w.toFixed(2));

                var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
                sls = parseFloat(sls).toFixed(2);
                $("#sales_tax").val(sls);
                cal_total_due();


    },
        error: function(response){
        alert('Error'+response);

        }
});

$('#clear').click(function() {
  $('#signArea').signaturePad().clearCanvas();
});

$('#clear2').click(function() {
  $('#signArea2').signaturePad().clearCanvas();
});

$('#clear3').click(function() {
  $('#signArea3').signaturePad().clearCanvas();
});
</script>
<script>
  $( function() {
    $( "#datepicker_dateissued" ).datepicker({
        format: 'mm/dd/yyyy'
    });
  } );

  $('#credit_number').keyup(function() {
  var foo = $(this).val().split("-").join(""); // remove hyphens
  if (foo.length > 0) {
    foo = foo.match(new RegExp('.{1,4}', 'g')).join("-");
  }
  $(this).val(foo);
});

$('#credit_number2').keyup(function() {
  var foo = $(this).val().split("-").join(""); // remove hyphens
  if (foo.length > 0) {
    foo = foo.match(new RegExp('.{1,4}', 'g')).join("-");
  }
  $(this).val(foo);
});

$('#other_credit_number').keyup(function() {
  var foo = $(this).val().split("-").join(""); // remove hyphens
  if (foo.length > 0) {
    foo = foo.match(new RegExp('.{1,4}', 'g')).join("-");
  }
  $(this).val(foo);
});
</script>

