<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<?php include viewPath('includes/workorder/sign-modal'); ?>

<!-- Script for autosaving form -->
<script src="<?=base_url("assets/js/workorder/autosave-solar.js")?>"></script>

<!-- <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> -->
<style>
.box-left-mini{
    float:left;
    background-image:url(website-content/hotcampaign.png);
    width:100%;
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
#chartdiv {
  width: 100%;
  height: 400px;
}
.files input {
    outline: 2px dashed #92b0b3;
    outline-offset: -10px;
    -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
    transition: outline-offset .15s ease-in-out, background-color .15s linear;
    padding: 70px 0px 85px 30%;
    text-align: center !important;
    margin: 0;
    width: 100% !important;
}
.files input:focus{     outline: 2px dashed #92b0b3;  outline-offset: -10px;
    -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
    transition: outline-offset .15s ease-in-out, background-color .15s linear; border:1px solid #92b0b3;
 }
.files{ position:relative}
.files:after {  pointer-events: none;
    position: absolute;
    top: 60px;
    left: 0;
    width: 50px;
    right: 0;
    height: 56px;
    content: "";
    background-image: url(https://image.flaticon.com/icons/png/128/109/109612.png);
    display: block;
    margin: 0 auto;
    background-size: 100%;
    background-repeat: no-repeat;
}
.color input{ background-color:#f1f1f1;}
.files:before {
    position: absolute;
    bottom: 10px;
    left: 0;  pointer-events: none;
    width: 100%;
    right: 0;
    height: 57px;
    top:100px;
    content: " or drag it here. ";
    display: block;
    margin: 0 auto;
    color: #2ea591;
    font-weight: 600;
    text-transform: capitalize;
    text-align: center;
}

.leftangle{
        /* color:white; */
        font-size:16px;
    }  

    .kahon
    {
        padding:20px;
        border-radius:5px;
        background-color:white;
        width:50%;
    }

@media screen and (max-width:720px){
    .leftangle{
        /* color:white; */
        font-size:11px;
    }  
    .leftangle h6{
        /* color:white; */
        font-size:12px;
    } 
    .kahon
    {
        padding:10px;
        border-radius:5px;
        background-color:white;
        width:12%;
    }
    .lawas
    {
        text-align:center;
    }
    .estbill
    {
        width:50%;
    }
}


@media screen and (max-width:1000px){

.wo-signatureModal canvas {
    width: 100%;
    border: 1px solid #e4e4e4;
    position: relative;
    z-index: 1;
    height: 250px;
    margin-top: 1px;
}
.wo-signatureModal .mobileHeight {
    /* max-width: 500px; */
    margin: 1.75rem auto;
    width: 100% !important;
}
.alert-primary {
    color: #004085;
    background-color: #cce5ff;
    border-color: #b8daff;
    margin-top: -22px;
    font-size: 9px;
    margin-bottom: 0px;
}
.modal-title {
    font-size: 12px;
    margin: 0;
    color: #002638;
}
.modal-header {
    padding: 0.4rem 0.4rem;
}
.modal-body {
    /* padding: 10px 10px; */
}
}
</style>
<input type="hidden" value="<?= $workorder->id; ?>" id="workorderId"/>
<div class="wrapper" role="wrapper">
<?php include viewPath('includes/sidebars/workorder'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
          <div class="row" style="margin-top: 30px;">
            <div class="col">
                <h3 class="m-0">Solar Stimulus Data Control / 2022 - 2024</h3>
            </div>
        </div>

        <!-- <div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;margin-top:5px;margin-bottom:10px;">
          Create your workorder.
        </div> -->
          <div class="">
            <!-- end row -->
            <!-- <div class="row">
                <div class="col-md-12" style="background-color:#32243d;padding:1px;text-align:center;color:white;">
                    <h5>General Information</h5>
                </div>
            </div>
            <br> -->
            <?php echo form_open_multipart('workorder/savenewWorkorderSolar', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?> 
                    <div class="row">
                        <div class="col-md-12">
                            <div id="header_area">
                                <h4 class="mt-0 header-title mb-5">Header</h4>
                                <div class="row">
                                    <div class="col-md-9">
                                        <ol class="breadcrumb" style="margin-top:-30px;"></i>
                                            <li class="breadcrumb-item active">
                                                <label style="background-color:#E8E8E9;" id="headerContent"><?php echo $headers->content; ?></label>
                                                <input type="hidden" id="headerID" name="header" value="<?php echo $headers->content; ?>">
                                                <input type="hidden" id="current_date" name="current_date" value="<?php echo @date('m-d-Y'); ?>">
                                                <input type="hidden" name="wo_id" value="<?php 
                                                    foreach($ids as $id)
                                                    {
                                                        $add = $id->id + 1;
                                                        echo $add;
                                                    }
                                                    ?>">
                                            </li>
                                        </ol>   
                                        <div class="row">                   
                                            <div class="col-md-3 form-group">
                                                <label for="contact_name" class="label-element">Work Order #</label>
                                                    <input type="text" class="form-control input-element" name="workorder_number" id="workorder_number" value="<?php echo "WO-"; 
                                                            foreach ($number as $num):
                                                                    $next = $num->work_order_number;
                                                                    $arr = explode("-", $next);
                                                                    $date_start = $arr[0];
                                                                    $nextNum = $arr[1];
                                                                //    echo $number;
                                                            endforeach;
                                                            $val = $nextNum + 1;
                                                            echo str_pad($val,7,"0",STR_PAD_LEFT);
                                                            ?>" required readonly/>
                                                    <!-- <input type="text" class="form-control input-element" name="workorder_number" id="workorder-number" value="<?= $prefix . $val; ?>" required readonly/> -->
                                            </div>
                                            <div class="form-group col-md-3">
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
                                            
                                            <div class="form-group col-md-3">
                                                <div class="select-wrap">
                                                    <label for="lead_source">System Type</label>
                                                    <select id="system_type" name="system_type" class="form-control custom-select m_select">
                                                        <option value="0">- none -</option>
                                                        <?php foreach($system_package_type as $lead){ ?>
                                                        <option value="<?php echo $lead->name; ?>"><?php echo $lead->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>    
                                            </div> 
                                        </div>     
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <div class="select-wrap">
                                                    <label for="lead_source">Status</label>
                                                    <select name="status" id="workorder_status" class="form-control custom-select m_select">
                                                        <option <?= $workorder->w_status == 'New' ? 'selected="selected"' : ''; ?> value="New">New</option>
                                                        <option <?= $workorder->w_status == 'Draft' ? 'selected="selected"' : ''; ?> value="Draft">Draft</option>
                                                        <option <?= $workorder->w_status == 'Scheduled' ? 'selected="selected"' : ''; ?> value="Scheduled">Scheduled</option>
                                                        <option <?= $workorder->w_status == 'Started' ? 'selected="selected"' : ''; ?> value="Started">Started</option>
                                                        <option <?= $workorder->w_status == 'Paused' ? 'selected="selected"' : ''; ?> value="Paused">Paused</option>
                                                        <option <?= $workorder->w_status == 'Completed' ? 'selected="selected"' : ''; ?> value="Completed">Completed</option>
                                                        <option <?= $workorder->w_status == 'Invoiced' ? 'selected="selected"' : ''; ?> value="Invoiced">Invoiced</option>
                                                        <option <?= $workorder->w_status == 'Withdrawn' ? 'selected="selected"' : ''; ?> value="Withdrawn">Withdrawn</option>
                                                        <option <?= $workorder->w_status == 'Closed' ? 'selected="selected"' : ''; ?> value="Closed">Closed</option>
                                                    </select>
                                                </div>    
                                            </div>
                                            <div class="form-group col-md-3">
                                                <div class="select-wrap">
                                                    <label for="lead_source">Agent Name</label>
                                                    <select class="form-control mb-3" name="agent_id">
                                                        <option value="0">Select Agent</option>
                                                        <?php foreach($users_lists as $ulist){ ?>
                                                            <option value="<?php echo $ulist->id ?>"><?php echo $ulist->FName .' '.$ulist->LName; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>    
                                            </div> 
                                        </div>                                
                                    </div> 
                                    <div class="col-md-3">
                                        <div style="margin-top:-30px;"><img src="<?= getCompanyBusinessProfileImage(); ?>" class="company-logo2"/> </div>                            
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

                                <input type="hidden" id="content_input" class="form-control" name="header2" value="<?php echo $headers->content; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row leftangle">                   
                        <div class=" col-md-6 box-left-mini">
                            <center>
                            <div class="front" style="text-align:center;background-color:#4a5594;color:white;padding:1%;border-radius:20px;width:95%;">
                                <h4>Qualification Information for Solar</h4>
                            </div>
                            </center><br>
                            <div class="behind_container" style="background-color:#ced4e4;margin-top:-20px;padding:20px;">
                                <div class="row"> 
                                    <div class="col-md-2">
                                    <br><br>        
                                        <div class="kahon">A</div>
                                    </div>
                                    <div class="col-md-10">
                                    <br> <h6>Type of Roof</h6>
                                    <input type="radio" name="tor" value="Asphalt Single" class="form-"> Asphalt Single &emsp;
                                    <input type="radio" name="tor" value="Flat" class="form-"> Flat &emsp;
                                    <input type="radio" name="tor" value="Concrete Tile" class="form-"> Concrete Tile &emsp; <br>
                                    <input type="radio" name="tor" value="Clay Tile" class="form-"> Clay Tile &emsp;
                                    <input type="radio" name="tor" value="Steel Single" class="form-"> Steel Single &emsp;
                                    <input type="radio" name="tor" value="Metal" class="form-"> Metal
                                    <br><br><hr>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-2">
                                        <div class="kahon">B</div>
                                    </div>
                                    <div class="col-md-10">
                                    <h6>Square Footage of Home</h6>
                                    <input type="text" name="sfoh" class="form-control">
                                    <br><hr>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-2">
                                        <div class="kahon">C</div>
                                    </div>
                                    <div class="col-md-10">
                                    <h6>Age of Roof (Years)</h6>
                                    <input type="radio" name="aor" value="0-5" class="form-"> 0-5 &emsp;
                                    <input type="radio" name="aor" value="5-10" class="form-"> 5-10 &emsp;
                                    <input type="radio" name="aor" value="10-15" class="form-"> 10-15 &emsp;
                                    <input type="radio" name="aor" value="15-20" class="form-"> 15-20
                                    <br><br><hr>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-2">
                                        <div class="kahon">D</div>
                                    </div>
                                    <div class="col-md-10">
                                    <h6>Solar Panel Mounting Preference</h6>
                                    <input type="radio" name="spmp" value="Front Only" class="form-"> Front Only &emsp;
                                    <input type="radio" name="spmp" value="Back Only" class="form-"> Back Only &emsp;
                                    <input type="radio" name="spmp" value="Side Only" class="form-"> Side Only  <br>
                                    <input type="radio" name="spmp" value="No Preference" class="form-"> No Preference &emsp;
                                    <input type="radio" name="spmp" value="Other" class="form-"> Other
                                    <br><br><hr>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-2">
                                        <div class="kahon">E</div>
                                    </div>
                                    <div class="col-md-10">
                                    <h6>Home Owner Associations</h6>
                                    <input type="radio" name="hoa" value="Yes" class="form-"> Yes &emsp;
                                    <input type="radio" name="hoa" value="No" class="form-"> No &emsp;
                                    <br>
                                    <b>If Yes: Contact Name/Number</b>
                                    <input type="text" name="hoa_text" class="form-control">
                                    <br><hr>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-2">
                                        <div class="kahon">F</div>
                                    </div>
                                    <div class="col-md-10">
                                        <div style="float:right;" class="estbill">
                                            <!-- <center>$<input type="text" name="ebis_text" class="form-control" style="width:70%;"><br>
                                            Estimated Bill</center> -->
                                            <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="number" name="estimated_bill" class="form-control" aria-label="Amount">
                                            <!-- <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div> -->
                                            </div>
                                            <center>Estimated Bill</center>
                                        </div>
                                    <h6>Electric Bill is over $100</h6> 
                                    <input type="radio" name="ebis" value="Yes" class="form-"> Yes &emsp;
                                    <input type="radio" name="ebis" value="No" class="form-"> No &emsp;
                                    <br>
                                    <h6>How do you get your Invoice</h6>
                                    <input type="radio" name="hdygi" value="Paper" class="form-"> Paper &emsp;
                                    <input type="radio" name="hdygi" value="Paperless" class="form-"> Paperless &emsp;
                                    <!-- <input type="file" name="hdygi_file[]" multiple="multiple" class="form-control"> -->
                                    <div class="form-group files">
                                        <!-- <label>Upload Your File </label> -->
                                        <input type="file" name="hdygi_file[]" multiple="multiple" class="form-control">
                                    </div>
                                    <h6>Electric Bill Account #</h6>
                                    <input type="text" name="eba_text" class="form-control">
                                    <br><hr>
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom:70px;"> 
                                    <div class="col-md-2">
                                        <div style="padding:20px;border-radius:5px;background-color:white;width:50%;">G</div>
                                    </div>
                                    <div class="col-md-10">
                                    <h6>Employment Status</h6>
                                    <input type="radio" name="es" value="Employed" class="form-"> Employed &emsp;
                                    <input type="radio" name="es" value="Unemployed" class="form-"> Unemployed &emsp;
                                    <input type="radio" name="es" value="Retired" class="form-"> Retired <br>
                                    <input type="radio" name="es" value="Retired with Income" class="form-"> Retired with Income
                                    <!-- <hr> -->
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class=" col-md-6">
                            <div style="padding:3%;border:solid black 1px;font-weight:bold;">
                                Please fill in the form completely, and return it to a solar specialist or email to support@adtsolarpro.com for consideration.
                            </div>
                            <br><br>
                            <center>
                            <div class="front" style="text-align:center;background-color:#4a5594;color:white;padding:0.5%;border-radius:20px;width:100%;">
                                <h6>Please Fill in the Details:</h6>
                            </div>
                            </center>
                            <br>
                                <div class="row"> 
                                    <div class="col-md-6">
                                        <input type="text" name="firstname" id="firstname" class="form-control border-top-0 border-right-0 border-left-0" onkeyup="primaryName()" placeholder="Enter First Name">
                                        <b>First name:</b>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="lastname" id="lastname" class="form-control border-top-0 border-right-0 border-left-0" onkeyup="primaryName()" placeholder="Enter Last Name">
                                        <b>Last name:</b>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-12">
                                        <input type="text" name="address" class="form-control border-top-0 border-right-0 border-left-0" placeholder="Enter Address">
                                        <b>Address:</b>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-5">
                                        <input type="text" name="city" class="form-control border-top-0 border-right-0 border-left-0" placeholder="Enter City">
                                        <b>City:</b>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" name="country" class="form-control border-top-0 border-right-0 border-left-0" placeholder="Enter County">
                                        <b>County:</b>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-12">
                                        <input type="number" name="postcode" class="form-control border-top-0 border-right-0 border-left-0" placeholder="Enter Postcode">
                                        <b>Postcode:</b>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-12">
                                        <input type="text" name="phone" class="form-control border-top-0 border-right-0 border-left-0" placeholder="Enter Phone">
                                        <b>Phone:</b>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-12">
                                        <input type="text" name="mobile" class="form-control border-top-0 border-right-0 border-left-0" placeholder="Enter Mobile">
                                        <b>Mobile:</b>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-12">
                                        <input type="text" name="email" class="form-control border-top-0 border-right-0 border-left-0" placeholder="Enter Email">
                                        <b>Email:</b>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-12">
                                        <input type="text" name="comments" class="form-control border-top-0 border-right-0 border-left-0" placeholder="Enter Your comments here">
                                        <b>Comments:</b>
                                    </div>
                                </div>
                                <br>
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
                                        <input type="checkbox" name="options[]" value="battery package" class="form-"> Battery Package   &emsp;
                                        <input type="checkbox" name="options[]" value="security" class="form-"> Security &emsp;
                                        <input type="checkbox" name="options[]" value="others" class="form-"> Others
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                    <br>
                    <div class="row">                   
                        <div class="form-group col-md-4">
                            <div class="select-wrap">
                                <label for="job_type">Payment Method</label>
                                    <select name="payment_method" id="payment_method" class="form-control custom-select m_select">
                                        <option value="">Choose method</option>
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
                                <label for="job_type" class="label-element">Amount<small class="help help-sm"> ( $ )</small></label>
                                <input type="text" class="form-control input-element" name="payment_amount" id="payment_amount"  />
                            </div>
                    </div>
                    <div id="invoicing" style="display:none;">
                                        
                                        <input type="checkbox" id="same_as"> <b>Same as above Address</b> <br><br>
                                        <div class="row">                   
                                            <div class="col-md-4 form-group">
                                                <label for="monitored_location" class="label-element">Mail Address</label>
                                                <input type="text" class="form-control input-element" name="mail-address"
                                                    id="mail-address" placeholder="Monitored Location"/>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label for="city" class="label-element">City</label>
                                                    <input type="text" class="form-control input-element" name="mail_locality" id="mail_locality" placeholder="Enter Name" />
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label for="state" class="label-element">State</label>
                                                <input type="text" class="form-control input-element" name="mail_state"
                                                    id="mail_state" 
                                                    placeholder="Enter State"/>
                                            </div>
                                        </div>
                                        <div class="row">  
                                            <div class="col-md-4 form-group">
                                                <label for="zip" class="label-element">ZIP</label> 
                                                    <input type="text" id="mail_postcode" name="mail_postcode" class="form-control input-element"  placeholder="Enter Zip"/>
                                            </div>

                                            <div class="col-md-4 form-group">
                                                <label for="cross_street" class="label-element">Cross Street</label>
                                                <input type="text" class="form-control input-element" name="mail_cross_street"
                                                    id="mail_cross_street" 
                                                    placeholder="Cross Street"/>
                                            </div>                                        
                                        </div>
                                    </div>
                            <div id="check_area" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type" class="label-element">Check Number</label>
                                        <input type="text" class="form-control input-element" name="check_number" id="check_number"/>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type" class="label-element">Routing Number</label>
                                        <input type="text" class="form-control input-element" name="routing_number" id="routing_number"/>
                                    </div>                                             
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="job_type" class="label-element">Account Number</label>
                                        <input type="text" class="form-control input-element" name="account_number" id="account_number"/>
                                    </div>                                       
                                </div>
                            </div>
                            <div id="credit_card" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type" class="label-element">Credit Card Number</label>
                                        <input type="text" class="form-control input-element" name="credit_number" id="credit_number" placeholder="0000 0000 0000 000" />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type" class="label-element">Credit Card Expiration</label>
                                        <input type="text" class="form-control input-element" name="credit_expiry" id="credit_expiry" placeholder="MM/YYYY"/>
                                    </div>  
                                    <div class="form-group col-md-3">
                                        <label for="job_type" class="label-element">CVC</label>
                                        <input type="text" class="form-control input-element" name="credit_cvc" id="credit_cvc" placeholder="CVC"/>
                                    </div>                                             
                                </div>
                            </div>
                            <div id="debit_card" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type" class="label-element">Credit Card Number</label>
                                        <input type="text" class="form-control input-element" name="debit_credit_number" id="credit_number2" placeholder="0000 0000 0000 000" />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type" class="label-element">Credit Card Expiration</label>
                                        <input type="text" class="form-control input-element" name="debit_credit_expiry" id="credit_expiry" placeholder="MM/YYYY"/>
                                    </div>  
                                    <div class="form-group col-md-3">
                                        <label for="job_type" class="label-element">CVC</label>
                                        <input type="text" class="form-control input-element" name="debit_credit_cvc" id="credit_cvc" placeholder="CVC"/>
                                    </div>                                            
                                </div>
                            </div>
                            <div id="ach_area" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type" class="label-element">Routing Number</label>
                                        <input type="text" class="form-control input-element" name="ach_routing_number" id="ach_routing_number" />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type" class="label-element">Account Number</label>
                                        <input type="text" class="form-control input-element" name="ach_account_number" id="ach_account_number" />
                                    </div>  
                                </div>
                            </div>
                            <div id="venmo_area" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type" class="label-element">Account Credential</label>
                                        <input type="text" class="form-control input-element" name="account_credentials" id="account_credentials"/>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type" class="label-element">Account Note</label>
                                        <input type="text" class="form-control input-element" name="account_note" id="account_note"/>
                                    </div>  
                                    <div class="form-group col-md-3">
                                        <label for="job_type" class="label-element">Confirmation</label>
                                        <input type="text" class="form-control input-element" name="confirmation" id="confirmation"/>
                                    </div>                                            
                                </div>
                            </div>
                            <div id="paypal_area" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type" class="label-element">Account Credential</label>
                                        <input type="text" class="form-control input-element" name="paypal_account_credentials" id="paypal_account_credentials"/>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type" class="label-element">Account Note</label>
                                        <input type="text" class="form-control input-element" name="paypal_account_note" id="paypal_account_note"/>
                                    </div>  
                                    <div class="form-group col-md-3">
                                        <label for="job_type" class="label-element">Confirmation</label>
                                        <input type="text" class="form-control input-element" name="paypal_confirmation" id="paypal_confirmation"/>
                                    </div>                                            
                                </div>
                            </div>
                            <div id="square_area" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type" class="label-element">Account Credential</label>
                                        <input type="text" class="form-control input-element" name="square_account_credentials" id="square_account_credentials"/>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type" class="label-element">Account Note</label>
                                        <input type="text" class="form-control input-element" name="square_account_note" id="square_account_note"/>
                                    </div>  
                                    <div class="form-group col-md-3">
                                        <label for="job_type" class="label-element">Confirmation</label>
                                        <input type="text" class="form-control input-element" name="square_confirmation" id="square_confirmation"/>
                                    </div>                                            
                                </div>
                            </div>
                            <div id="warranty_area" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type" class="label-element">Account Credential</label>
                                        <input type="text" class="form-control input-element" name="warranty_account_credentials" id="warranty_account_credentials"/>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type" class="label-element">Account Note</label>
                                        <input type="text" class="form-control input-element" name="warranty_account_note" id="warranty_account_note"/>
                                    </div>                                         
                                </div>
                            </div>
                            <div id="home_area" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type" class="label-element">Account Credential</label>
                                        <input type="text" class="form-control input-element" name="home_account_credentials" id="home_account_credentials"/>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type" class="label-element">Account Note</label>
                                        <input type="text" class="form-control input-element" name="home_account_note" id="home_account_note"/>
                                    </div>                                         
                                </div>
                            </div>
                            <div id="e_area" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type" class="label-element">Account Credential</label>
                                        <input type="text" class="form-control input-element" name="e_account_credentials" id="e_account_credentials"/>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type" class="label-element">Account Note</label>
                                        <input type="text" class="form-control input-element" name="e_account_note" id="e_account_note"/>
                                    </div>                                         
                                </div>
                            </div>
                            <div id="other_credit_card" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type" class="label-element">Credit Card Number</label>
                                        <input type="text" class="form-control input-element" name="other_credit_number" id="other_credit_number" placeholder="0000 0000 0000 000" />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type" class="label-element">Credit Card Expiration</label>
                                        <input type="text" class="form-control input-element" name="other_credit_expiry" id="other_credit_expiry" placeholder="MM/YYYY"/>
                                    </div>  
                                    <div class="form-group col-md-3">
                                        <label for="job_type" class="label-element">CVC</label>
                                        <input type="text" class="form-control input-element" name="other_credit_cvc" id="other_credit_cvc" placeholder="CVC"/>
                                    </div>                                             
                                </div>
                            </div>
                            <div id="other_payment_area" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Credential</label>
                                        <input type="text" class="form-control input-element" name="other_payment_account_credentials" id="other_payment_account_credentials"/>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type">Account Note</label>
                                        <input type="text" class="form-control input-element" name="other_payment_account_note" id="other_payment_account_note"/>
                                    </div>                                         
                                </div>
                            </div>

                    <br><br>
                             <!-- ====== SIGNATURE ====== -->
                             <div class="row">
                                <div class=" col-md-12">
                                    <div class="work_nore lawas">
                                        <h6>Use of Personal Information Collected</h6>
                                        <p>We use the information we collect to provide you with our products and services and to respond to your questions. We also use the information for editorial and feedback purposes, for marketing and promotional purposes, to inform advertisers as to how many visitors have seen or clicked on their advertisements and to customize the content and layout of ClearCaptions' website. We also use the information we collect for statistical analysis of users' behavior, for product development, for content improvement, to ensure our product and services remain functioning and secure and to investigate and protect against any illegal activities or violations of our Terms of Service.</p>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <div class="row signature_web lawas">
                                <div class="col-md-4">
                                <h6>Company Representative Approval</h6> <a class="btn btn-success companySignature"><span class="fa fa-plus-square fa-margin-right"></span> Add Signature</a>
                                    <div id="companyrep"></div>

                                    <input type="hidden" id="saveCompanySignatureDB1a"
                                           name="company_representative_approval_signature1a">
                                    <br>

                                    <label for="comp_rep_approval">Printed Name</label>
                                    <!-- <input type="text6" class="form-control mb-3"
                                           name="company_representative_printed_name"
                                           id="company_representative_printed_name" placeholder=""/> -->
                                        <select class="form-control mb-3" name="company_representative_printed_name">
                                            <option value="0">Select Name</option>
                                            <?php foreach($users_lists as $ulist){ ?>
                                                <option <?php if($ulist->id == logged('id')){ echo "selected";} ?> value="<?php echo $ulist->id ?>"><?php echo $ulist->FName .' '.$ulist->LName; ?></option>
                                            <?php } ?>
                                        </select>
                                           <!-- <canvas id="canvas_web" style="border: 1px solid #ddd;"></canvas>
                                            <input type="text" class="form-control mb-3" name="company_representative_printed_name" id="comp_rep_approval1" placeholder="Printed Name"/> -->
                                            <!-- <input type="hidden" id="saveCompanySignatureDB1aM_web" name="company_representative_approval_signature1aM_web"> -->
                                            <div id="company_representative_div"></div>

                                </div>
                                <div class="col-md-4">
                                    <h6>Primary Account Holder</h6><a class="btn btn-warning primarySignature"><span class="fa fa-plus-square fa-margin-right"></span> Add Signature</a>
                                    <div id="primaryrep"></div>
                                    <input type="hidden" id="savePrimaryAccountSignatureDB2a"
                                           name="primary_account_holder_signature2a">
                                    <br>

                                    <label for="comp_rep_approval">Printed Name</label>
                                    <input type="text6" class="form-control mb-3" name="primary_account_holder_name"
                                           id="primary_account_holder_name" placeholder=""/>
                                    <!-- <select class="form-control mb-3" name="primary_account_holder_name">
                                            <option value="0">Select Name</option>
                                            <?php //foreach($users_lists as $ulist){ ?>
                                                <option value="<?php //echo $ulist->id ?>"><?php //echo $ulist->FName .' '.$ulist->LName; ?></option>
                                            <?php //} ?>
                                    </select> -->
                                    
                                           <!-- <input type="hidden" id="saveCompanySignatureDB1aM_web2" name="primary_representative_approval_signature1aM_web"> -->
                                           <div id="primary_representative_div"></div>

                                </div>
                                <div class="col-md-4">
                                    <h6>Secondary Account Holder</h6><a class="btn btn-danger secondarySignature"><span class="fa fa-plus-square fa-margin-right"></span> Add Signature</a>
                                    <div id="secondaryrep"></div>
                                    <input type="hidden" id="saveSecondaryAccountSignatureDB3a"
                                           name="secondary_account_holder_signature3a">
                                    <br>

                                    <label for="comp_rep_approval">Printed Name</label>
                                    <input type="text6" class="form-control mb-3" name="secondery_account_holder_name"
                                           id="secondery_account_holder_name" placeholder=""/>
                                        <!-- <select class="form-control mb-3" name="secondery_account_holder_name">
                                            <option value="0">Select Name</option>
                                            <?php //foreach($users_lists as $ulist){ ?>
                                                <option value="<?php //echo $ulist->id ?>"><?php //echo $ulist->FName .' '.$ulist->LName; ?></option>
                                            <?php //} ?>
                                        </select> -->

                                           <!-- <input type="hidden" id="saveCompanySignatureDB1aM_web3" name="secondary_representative_approval_signature1aM_web"> -->
                                           <div id="secondary_representative_div"></div>

                                </div>
                            </div>

                            <br><br><br><br><br>
                            <div>
                                <div class="form-group lawas">
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

<!-- Chart code -->
<script>

function primaryName(){
     // $('.invAetf').keyup(function(e){
      // alert('kk');
      var one = $('#firstname').val();
      var two = $('#lastname').val();
      $('#primary_account_holder_name').val(one +' '+ two);
  }
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
  "category": "J",
  "value": 1240
}, {
  "category": "F",
  "value": 1000
}, {
  "category": "M",
  "value": 450
}, {
  "category": "A",
  "value": 700
}, {
  "category": "M",
  "value": 800
}, {
  "category": "J",
  "value": 800
}, {
  "category": "J",
  "value": 780
}, {
  "category": "A",
  "value": 500
}, {
  "category": "S",
  "value": 100
}, {
  "category": "O",
  "value": 1000
}, {
  "category": "N",
  "value": 900
}, {
  "category": "D",
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

//   signaturePadCanvas.width  = 780;
  signaturePadCanvas.height = 300;
});

var signaturePad2;
jQuery(document).ready(function () {
  var signaturePadCanvas2 = document.querySelector('#canvas2b');
//   var parentWidth = jQuery(signaturePadCanvas).parent().outerWidth();
//   signaturePadCanvas.setAttribute("width", parentWidth);
  signaturePad2 = new SignaturePad(signaturePadCanvas2);

//   signaturePadCanvas2.width  = 780;
  signaturePadCanvas2.height = 300;
});

var signaturePad3;
jQuery(document).ready(function () {
  var signaturePadCanvas3 = document.querySelector('#canvas3b');
//   var parentWidth = jQuery(signaturePadCanvas).parent().outerWidth();
//   signaturePadCanvas.setAttribute("width", parentWidth);
  signaturePad3 = new SignaturePad(signaturePadCanvas3);

//   signaturePadCanvas3.width  = 780;
  signaturePadCanvas3.height = 300;
});

$(document).on('click touchstart','.companySignature',function(){
    $("#company-representative-approval-signature").modal("show");
});

$(document).on('click touchstart','.primarySignature',function(){
    $("#primary-account-holder-signature").modal("show");
});

$(document).on('click touchstart','.secondarySignature',function(){
    $("#secondary-account-holder-signature").modal("show");
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

