<?php include viewPath('includes/header'); ?>
<link rel="stylesheet" href="<?php echo $url->assets ?>builder/css/alarm.css">
<style>
  .custom-signaturepad {
    padding-left: 0;
    padding-right: 0;
  }
  .custom-signaturepad .sigWrapper canvas {
      width: 100%;
  }
  .custom-signaturepad .sigPad  {
    width: 100% !important;
  }
</style>
<style>

.my-div-container .card { 
    padding:3px !important;
    border:0px ;
}

.my-div-container .card .card-body { 
    padding:0px !important;
}

.my-div-container .card .card-body .row { 
    padding:0px !important;
}

.my-div-container .card .card-body .row .form-group { 
    padding-left:5px;
    padding-right:5px;
    margin-bottom:0px !important;
}

body {
    background: white !important;
}
.my-div-container .card .card-body .row .form-group .box-title { margin:0px; }
 
.float-left { float:left !important; }
.remove-padding { padding:0px !important; }
.one-row-label { line-height: 46px;margin-bottom: 0px !important; }

#table_body tr td {
    padding: 3px 2px !important;
}

label { margin-bottom:0px !important; }
</style>
<div class="wrapper " role="wrapper">
    <?php include viewPath('includes/sidebars/workorder'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid my-div-container">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-7">
                        <h1 class="page-title">ALARM DIRECT</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"><h5>Schedule of Equipment and Services</h5></li>
                        </ol>
                    </div>
                    <div class="col-sm-5">
                        <div class="fogm-bx">
                            <h5 class="box-title">Office use only</h5>
                            <textarea class="form-control" rows="3" placeholder=""></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <?php echo form_open_multipart('workorder/save', ['class' => 'form-validate require-validation', 'id' => 'workorder_form', 'autocomplete' => 'off']); ?>


            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <p>This Alarm System Work Order Agreement (the "Agreement") is made as of
                                <?php echo date('m/d/Y') ?>, by and between ADI, (the "Company") and the
                                ("Customer") as the address shown below (the "Premise/Monitored Location") </p>

                            <!-- ====== CUSTOMER ====== -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <label class="col-md-6 float-left one-row-label pl-0"><strong>Ticket #</strong></label>
                                            <input type="text" name="" placeholder="" class="form-control">
                                        </div>
                                        <div class="offset-md-6 col-md-3 form-group">
                                            <label class="col-md-6 float-left one-row-label mt-5 pl-0">Customer Type</label>
                                            <select name="customer[customer_type]"
                                                    class="form-control float-left col-md-6 mt-5" style="margin-top: 45px!important" 
                                                    id="customer_type">
                                                <?php foreach (get_config_item('customer_types') as $key => $customer_type) { ?>
                                                    <option value="<?php echo $customer_type ?>">
                                                        <?php echo $customer_type ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <h5 class="box-title">Customer</h5>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <label>Customer Name</label>
                                            <input type="text" name="" placeholder="Name" class="form-control">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Phone Number</label>
                                            <input type="text" name="" placeholder="Phone Number" class="form-control">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Acct #</label>
                                            <input type="text" name="" placeholder="Acct" class="form-control">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Panel Type/DVR Type</label>
                                            <input type="text" name="" placeholder="Panel Type/DVR Type" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <label>Monitored Location</label>
                                            <input type="text" name="" placeholder="Monitored Location" class="form-control">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>City</label>
                                            <input type="text" name="" placeholder="City" class="form-control">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>State</label>
                                            <input type="text" name="" placeholder="State" class="form-control">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Zip Code</label>
                                            <input type="text" name="" placeholder="Zip Code" class="form-control">
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>


                            <!-- ====== EMERGENCY CALL LIST ====== -->
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <h5 class="box-title">Service Description</h5>
                                    <textarea class="form-control" rows="3" placeholder="Service Event"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <h5 class="box-title">Notes to Tech</h5>
                                </div>
                                
                                <div class="col-md-4 form-group">
                                    <label>Tech :</label>
                                    <select class="form-control">
                                        <option>Brannon</option>
                                        <option>Brannon</option>
                                        <option>Brannon</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>2nd Tech :</label>
                                    <select class="form-control">
                                        <option>Tyler</option>
                                        <option>Brannon</option>
                                        <option>Brannon</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>3rd Tech :</label>
                                    <select class="form-control">
                                        <option>Tyler</option>
                                        <option>Brannon</option>
                                        <option>Brannon</option>
                                    </select>
                                </div>

                                <div class="col-sm-3 form-group">
                                    <label>Level</label>
                                    <input type="text" name="" placeholder="Level" class="form-control">
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>Time Schedule</label>
                                    <input type="text" name="" placeholder="Level" class="form-control">
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>Arrival Time</label>
                                    <input type="text" name="" placeholder="Level" class="form-control">
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>Service Ticket Created by :</label>
                                    <select class="form-control">
                                        <option>Tyler</option>
                                        <option>Brannon</option>
                                        <option>Brannon</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2 col-sm-3 form-group">
                                    <label class="mt-2">Warranty :</label>
                                </div>
                                <div class="col-md-10 col-sm-9 form-group">
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="" value="" id="c1">
                                        <label for="c1">Extended Warranty</label>
                                    </div>
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="" value="" id="c2">
                                        <label for="c2">Limited Warranty</label>
                                    </div>
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="" value="" id="c3">
                                        <label for="c3">No Coverage</label>
                                    </div>
                                </div>

                                <div class="col-md-2 col-sm-3 form-group">
                                    <label class="mt-2">Services :</label>
                                </div>
                                <div class="col-md-10 col-sm-9 form-group">
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="" value="" id="c4">
                                        <label for="c4">Security</label>
                                    </div>
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="" value="" id="c5">
                                        <label for="c5">DVR</label>
                                    </div>
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="" value="" id="c6">
                                        <label for="c6">PERS</label>
                                    </div>

                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="" value="" id="c7">
                                        <label for="c7">Alarm.com</label>
                                    </div>
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="" value="" id="c8">
                                        <label for="c8">IP Cam</label>
                                    </div>
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="" value="" id="c9">
                                        <label for="c9">WI-FI Card</label>
                                    </div>
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="" value="" id="c10">
                                        <label for="c10">Cell Primary</label>
                                    </div>
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="" value="" id="c11">
                                        <label for="c11">Door Lock</label>
                                    </div>
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="" value="" id="c12">
                                        <label for="c12">Themostate</label>
                                    </div>
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="" value="" id="c13">
                                        <label for="c13">Skybell</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label><strong style="margin-right: 15px;">IP Cam</strong></label>
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="" value="" id="c14">
                                        <label for="c14">Honeywell</label>
                                    </div>
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="" value="" id="c15">
                                        <label for="c15">Alarm.com</label>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label><strong style="margin-right: 15px;">DVR</strong></label>
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="" value="" id="c16">
                                        <label for="c16">Honeywell</label>
                                    </div>
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="" value="" id="c17">
                                        <label for="c17">Other</label>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label><strong style="margin-right: 15px;">Thermoetat</strong></label>
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="" value="" id="c18">
                                        <label for="c18">Honeywell</label>
                                    </div>
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="" value="" id="c19">
                                        <label for="c19">Alarm.com</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-6 pl-0">                                    
                                    <div class="col-md-12 pl-0">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th width="150px"><strong>Dooricoks</strong></th>
                                                    <th>Brass</th>
                                                    <th>Nckal</th>
                                                    <th>Bronza</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Deadbot</td>
                                                    <td><input type="text" name="" placeholder="" class="form-control"></td>
                                                    <td><input type="text" name="" placeholder="" class="form-control"></td>
                                                    <td><input type="text" name="" placeholder="" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td>Handa</td>
                                                    <td><input type="text" name="" placeholder="" class="form-control"></td>
                                                    <td><input type="text" name="" placeholder="" class="form-control"></td>
                                                    <td><input type="text" name="" placeholder="" class="form-control"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <h5 class="box-title">Zone Information</h5>
                                </div>
                                <div class="col-sm-12 col-md-6 pl-0">                                    
                                    <div class="col-md-12 pl-0">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Entry/Exit</th>
                                                    <th>Zn#</th>
                                                    <th>Verified</th>
                                                    <th>Location</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                                            <input type="radio" name="" value="" id="c1">
                                                            <label for="c1"></label>
                                                        </div>
                                                    </td>
                                                    <td>1</td>
                                                    <td>
                                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                                            <input type="radio" name="" value="" id="c2">
                                                            <label for="c2"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="" placeholder="" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                                            <input type="radio" name="" value="" id="c1">
                                                            <label for="c1"></label>
                                                        </div>
                                                    </td>
                                                    <td>2</td>
                                                    <td>
                                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                                            <input type="radio" name="" value="" id="c2">
                                                            <label for="c2"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="" placeholder="" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                                            <input type="radio" name="" value="" id="c1">
                                                            <label for="c1"></label>
                                                        </div>
                                                    </td>
                                                    <td>3</td>
                                                    <td>
                                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                                            <input type="radio" name="" value="" id="c2">
                                                            <label for="c2"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="" placeholder="" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                                            <input type="radio" name="" value="" id="c1">
                                                            <label for="c1"></label>
                                                        </div>
                                                    </td>
                                                    <td>4</td>
                                                    <td>
                                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                                            <input type="radio" name="" value="" id="c2">
                                                            <label for="c2"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="" placeholder="" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                                            <input type="radio" name="" value="" id="c1">
                                                            <label for="c1"></label>
                                                        </div>
                                                    </td>
                                                    <td>5</td>
                                                    <td>
                                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                                            <input type="radio" name="" value="" id="c2">
                                                            <label for="c2"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="" placeholder="" class="form-control">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- <button class="btn btn-block btn-lg btn-primary">Import</button>-->
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Entry/Exit</th>
                                                <th>Zn#</th>
                                                <th>Verified</th>
                                                <th>Location</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                                        <input type="radio" name="" value="" id="c1">
                                                        <label for="c1"></label>
                                                    </div>
                                                </td>
                                                <td>6</td>
                                                <td>
                                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                                        <input type="radio" name="" value="" id="c2">
                                                        <label for="c2"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" name="" placeholder="" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                                        <input type="radio" name="" value="" id="c1">
                                                        <label for="c1"></label>
                                                    </div>
                                                </td>
                                                <td>7</td>
                                                <td>
                                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                                        <input type="radio" name="" value="" id="c2">
                                                        <label for="c2"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" name="" placeholder="" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                                        <input type="radio" name="" value="" id="c1">
                                                        <label for="c1"></label>
                                                    </div>
                                                </td>
                                                <td>8</td>
                                                <td>
                                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                                        <input type="radio" name="" value="" id="c2">
                                                        <label for="c2"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" name="" placeholder="" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                                        <input type="radio" name="" value="" id="c1">
                                                        <label for="c1"></label>
                                                    </div>
                                                </td>
                                                <td>9</td>
                                                <td>
                                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                                        <input type="radio" name="" value="" id="c2">
                                                        <label for="c2"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" name="" placeholder="" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                                        <input type="radio" name="" value="" id="c1">
                                                        <label for="c1"></label>
                                                    </div>
                                                </td>
                                                <td>10</td>
                                                <td>
                                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                                        <input type="radio" name="" value="" id="c2">
                                                        <label for="c2"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" name="" placeholder="" class="form-control">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-offset-3 col-sm-6 offset-md-3 col-md-6 pl-0">
                                    <h5 class="box-title">Keypad Zones :</h5>
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="" value="" id="c31">
                                        <label for="c31">Duress (92)</label>
                                    </div>
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="" value="" id="c32">
                                        <label for="c32">Fire (95)</label>
                                    </div>
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="" value="" id="c33">
                                        <label for="c33">Honeywell</label>
                                    </div>
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="" value="" id="c34">
                                        <label for="c34">Honeywell</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label>Installation Notes/Comments :</label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>

                            <!-- ====== EQUIPMENT ====== -->
                            <?php /* ?>
                            <div class="row">
                                
                                <div class="form-group col-md-12">
                                    <h5 class="box-title">Additional Equipment/Services</h5>
                                </div>
                                
                                <div class="col-md-3 form-group">
                                    <div class="col-md-6 pl-0" style="float:left;">
                                        <label for="last_name">Type</label>
                                        <select name="panel_communication" class="form-control" id="customer_type">
                                            <option>--SELECT--</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 pr-0 pl-0" style="float:left;">
                                        <label for="last_name">Description</label>
                                        <select name="panel_communication" class="form-control" id="customer_type">
                                            <option>--SELECT--</option>
                                        </select>
                                    </div>
                                </div>
                            
                                <div class="col-md-9 form-group">

                                    <div class="col-md-1 form-group" style="float:left;">
                                        <label for="last_name">Qty</label>
                                        <input type="text" class="form-control" name="customer[company_name]" id="customer_company_name" required value="1"/>
                                    </div>

                                    <div class="col-md-4 form-group" style="float:left;">
                                        <label for="last_name">Location</label>
                                        <input type="text" class="form-control" name="customer[company_name]" id="customer_company_name" required />
                                    </div>
                                    
                                    <div class="col-md-1 form-group" style="float:left;">
                                        <label for="last_name">Cost</label>
                                        <input type="text" class="form-control" name="customer[company_name]" id="customer_company_name" required />
                                    </div>

                                    <div class="col-md-2 form-group" style="float:left;">
                                        <label for="last_name">Discount</label>
                                        <input type="text" class="form-control" name="customer[company_name]" id="customer_company_name" required />
                                    </div>

                                    <div class="col-md-2 form-group" style="float:left;">
                                        <label for="last_name">Tax</label>
                                        <input type="text" class="form-control" name="customer[company_name]" id="customer_company_name" required />
                                    </div>

                                    <div class="col-md-2 form-group" style="float:left;">
                                        <label for="last_name">Total</label>
                                        <input type="text" class="form-control" name="customer[company_name]" id="customer_company_name" required />
                                    </div>
                                </div>
                                
                                <div class="col-md-2 form-group">
                                    <button class="btn btn-xs btn-primary">Add Items</button>
                                </div>
                            </div>
                            <?php */ ?>



                            <!-- ====== Additional Equipment/Services ====== -->
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <h5 class="box-title">Equipment</h5>
                                </div>
                                <div class=" col-md-12">
                                    <?php if (!empty($estimate)) { ?>

                                        <div class="row" id="plansItemDiv">
                                            <?php if ($estimate->estimate_items != '') {

                                                $estimate_items = unserialize($estimate->estimate_items);
                                            } else {

                                                $estimate_items = [];
                                            } ?>
                                            <div class="col-md-12 table-responsive pl-0 pr-0 mb-0">
                                                <table class="table table-hover">
                                                    <input type="hidden" name="count" value="0" id="count">
                                                    <thead>
                                                    <tr>
                                                        <th>Intrusion Items</th>
                                                        <th>QTY</th>                                                
                                                        <th>Price</th>
                                                        <th>Total</th>
                                                        <th>Stock</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="table_body">
                                                    <?php if (count($estimate_items) > 0) { ?>
                                                        <input type="hidden" name="count"
                                                               value="<?php echo count($estimate_items) > 0 ? count($estimate_items) - 1 : 0; ?>"
                                                               id="count">
                                                        <?php $i = 0;
                                                        foreach ($estimate_items as $row) { ?>

                                                            <tr>
                                                            <td>
                                                                <select name="item_type[]" class="form-control">

                                                                    <option value="material" <?php if ($row['item_type'] == 'material') echo 'selected'; ?>>
                                                                        Material
                                                                    </option>
                                                                    <option value="product" <?php if ($row['item_type'] == 'product') echo 'selected'; ?>>
                                                                        Product
                                                                    </option>
                                                                    <option value="service" <?php if ($row['item_type'] == 'service') echo 'selected'; ?>>
                                                                        Service
                                                                    </option>
                                                                    </select></td><td>
                                                                    <input type="text" class="form-control getItems"
                                                                           onKeyup="getItems(this)" name="item[]"
                                                                           value="<?php echo $row['item']; ?>">
                                                                    <ul class="suggestions"></ul>
                                                                </td>
                                                                
                                                                <td>
                                                                    <input type="text" class="form-control quantity"
                                                                           name="quantity[]"
                                                                           data-counter="<?php echo $i; ?>"
                                                                           id="quantity_<?php echo $i; ?>"
                                                                           value="<?php echo $row['quantity'] ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control"
                                                                           name="location[]"
                                                                           value="<?php echo $row['location'] ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="number" class="form-control price"
                                                                           name="price[]"
                                                                           data-counter="<?php echo $i; ?>"
                                                                           id="price_<?php echo $i; ?>" min="0"
                                                                           value="<?php echo $row['price'] ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="number"
                                                                           value="<?php echo $row['discount'] ?>"
                                                                           class="form-control discount"
                                                                           name="discount[]"
                                                                           data-counter="<?php echo $i; ?>"
                                                                           id="discount_<?php echo $i; ?>" min="0"
                                                                           value="0"
                                                                           readonly>
                                                                </td>
                                                                <td>
                                                            <span id="span_tax_<?php echo $i; ?>"><?php $tax = ($row['price'] * 7.5 / 100) * $row['quantity'];
                                                                echo number_format($tax, 2) ?></span>
                                                                </td>
                                                                <td>
                                                            <span id="span_total_<?php echo $i; ?>"><?php $price = ($row['price'] + $tax) * $row['quantity'];
                                                                echo number_format($price, 2); ?></span>
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="remove">X</a>
                                                                </td>
                                                            </tr>
                                                            <?php $i++;
                                                        } ?>

                                                    <?php } else { ?>
                                                        <input type="hidden" name="count" value="0" id="count">
                                                        <tr>
                                                            <td><input type="text" class="form-control getItems"
                                                                       onKeyup="getItems(this)" name="item[]">
                                                                <ul class="suggestions"></ul>
                                                            </td>
                                                            <td><select name="item_type[]" class="form-control">
                                                                    <option value="service">Service</option>
                                                                    <option value="material">Material</option>
                                                                    <option value="product">Product</option>
                                                                </select></td>
                                                            <td><input type="text" class="form-control quantity"
                                                                       name="quantity[]" data-counter="0"
                                                                       id="quantity_0"
                                                                       value="1"></td>
                                                            <td><input type="text" class="form-control"
                                                                       name="location[]"></td>
                                                            <td><input type="number" class="form-control price"
                                                                       name="price[]"
                                                                       data-counter="0" id="price_0" min="0" value="0">
                                                            </td>
                                                            <td><input type="number" class="form-control discount"
                                                                       name="discount[]" data-counter="0"
                                                                       id="discount_0"
                                                                       min="0" value="0" readonly></td>
                                                            <td><span id="span_tax_0">0.00 (7.5%)</span></td>
                                                            <td><span id="span_total_0">0.00</span></td>
                                                        </tr>

                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                               &nbsp; <a href="#" class="btn btn-primary" id="add_another">Add Items</a>
                                            </div>
                                        </div><br/>

                                        <?php
                                        if ($estimate->estimate_eqpt_cost != '') {

                                            $estimate_eqpt_cost = unserialize($estimate->estimate_eqpt_cost);
                                        } else {

                                            $estimate_eqpt_cost = [];
                                        }
                                        ?>
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>Equipment Cost</td>
                                                <td class="d-flex align-items-center">$ <input type="text"
                                                                                               value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['eqpt_cost'] : 0.00; ?>"
                                                                                               name="eqpt_cost"
                                                                                               id="eqpt_cost"
                                                                                               onfocusout="cal_total_due()"
                                                                                               class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Sales Tax</td>
                                                <td class="d-flex align-items-center">$ <input type="text"
                                                                                               value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['sales_tax'] : 0.00; ?>"
                                                                                               name="sales_tax"
                                                                                               id="sales_tax"
                                                                                               onfocusout="cal_total_due()"
                                                                                               class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <input type="hidden"
                                                       value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['inst_cost'] : 0.00; ?>"
                                                       name="inst_cost"
                                                       id="inst_cost"
                                                       onfocusout="cal_total_due()"
                                                       class="form-control">
                                                <td>One Time Program and Setup</td>
                                                <td class="d-flex align-items-center">$ <input type="text"
                                                                                               value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['one_time'] : 0.00; ?>"
                                                                                               name="one_time"
                                                                                               id="one_time"
                                                                                               onfocusout="cal_total_due()"
                                                                                               class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Monthly Monitoring</td>
                                                <td class="d-flex align-items-center">$ <input type="text"
                                                                                               value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['m_monitoring'] : 0.00; ?>"
                                                                                               name="m_monitoring"
                                                                                               id="m_monitoring"
                                                                                               onfocusout="cal_total_due()"
                                                                                               class="form-control">
                                                </td>
                                            </tr>
                                        </table>


                                    <?php } else { ?>

                                        <div class="row" id="plansItemDiv">

                                            <div class="col-md-6 table-responsive pl-0 pr-0 mb-0">
                                                <table class="table table-hover mb-0">
                                                    <input type="hidden" name="count" value="0" id="count">
                                                    <thead>
                                                    <tr>
                                                        <th>Intrusion Items</th>
                                                        <th width="100px">QTY</th>
                                                        <th width="100px">Price</th>
                                                        <th width="100px">Total</th>
                                                        <th>Stock</th>
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
                                                        
                                                        <td><input type="text" class="form-control quantity"
                                                                   name="quantity[]"
                                                                   data-counter="0" id="quantity_0" value="1"></td>
                                                        <td><input type="text" class="form-control" name="location[]">
                                                        </td>
                                                        <td><select name="item_type[]" class="form-control">
                                                            <option value="product">Product</option>
                                                            <option value="material">Material</option>
                                                            <option value="service">Service</option>
                                                        </select>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <a href="#" class="btn btn-primary" style="margin-left:5px;" id="add_another">Add Items</a>
                                            </div>
                                            <div class="col-md-6 table-responsive pl-0 pr-0 mb-0">
                                                <table class="table table-hover mb-0">
                                                    <input type="hidden" name="count" value="0" id="count">
                                                    <thead>
                                                    <tr>
                                                        <th>Intrusion Items</th>
                                                        <th width="100px">QTY</th>
                                                        <th width="100px">Price</th>
                                                        <th width="100px">Total</th>
                                                        <th>Stock</th>
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
                                                        
                                                        <td><input type="text" class="form-control quantity"
                                                                   name="quantity[]"
                                                                   data-counter="0" id="quantity_0" value="1"></td>
                                                        <td><input type="text" class="form-control" name="location[]">
                                                        </td>
                                                        <td><select name="item_type[]" class="form-control">
                                                            <option value="product">Product</option>
                                                            <option value="material">Material</option>
                                                            <option value="service">Service</option>
                                                        </select>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <a href="#" class="btn btn-primary" style="margin-left:5px;" id="add_another">Add Items</a>
                                            </div>

                                            <div class="offset-md-3 col-md-3 pl-0 pr-0 mb-0">
                                                <div class="form-group">
                                                    <label>Total $</label>
                                                    <input type="text" name="" class="form-control">
                                                </div>
                                            </div>
                                            <div class="offset-md-3 col-md-3 pl-0 pr-0 mb-0">
                                                <div class="form-group">
                                                    <label>Total $</label>
                                                    <input type="text" name="" class="form-control">
                                                </div>
                                            </div>

                                            <div class="offset-md-9 col-md-3 pl-0 pr-0 mb-0">
                                                <div class="form-group">
                                                    <label>Grand Total $</label>
                                                    <input type="text" name="" class="form-control">
                                                </div>
                                            </div>
                                        </div><br/>

                                    <?php } ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat.</p>

                                    <h5 class="box-title">Payment Options</h5>
                                </div>

                                <div class="col-md-12">
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="" value="" id="c41">
                                        <label for="c41">Please Bill my credit card once for the amount above.</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="" value="" id="c42">
                                        <label for="c42">Please deduct this payment out of my information on file.</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="" value="" id="c43">
                                        <label for="c43">I would like to make a claim and agree to pay my deductable and agree to entered out my warranty service plan agreement.</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="" value="" id="c44">
                                        <label for="c44">I am paying for the service, today.</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2 col-sm-3 form-group">
                                    <label>Check #</label>
                                    <input type="text" name="" placeholder="Check" class="form-control">
                                </div>
                                <div class="col-md-2 col-sm-3 form-group">
                                    <label>Cash Amount #</label>
                                    <input type="text" name="" placeholder="Cash Amount" class="form-control">
                                </div>
                                <div class="col-md-4 col-sm-3 form-group">
                                    <label>Credit Card :</label>
                                    <input type="text" name="" placeholder="Credit Card" class="form-control">
                                </div>
                                <div class="col-md-2 col-sm-3 form-group">
                                    <label>Exp. Date :</label>
                                    <input type="text" name="" placeholder="Exp. Date" class="form-control">
                                </div>
                                <div class="col-md-2 col-sm-3 form-group">
                                    <label>CRC</label>
                                    <input type="text" name="" placeholder="CRC" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class=" col-md-12">
                                    <h6>Agreement</h6>
                                    <div style="height:400px; overflow:auto; background:#FFFFFF; padding-left:10px;" id="showuploadagreement">
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
                                <div class=" col-md-12 mt-3">
                                  <div class="row">
                                      <div class="col-md-4">
                                          <label for="billing_date">Upload user agreement</label>
                                          <input type="file" name="user_agreementupload" id="user_agreementupload" class="form-control">
                                      </div>
                                      <div class="col-md-1">
                                        <label for="or_separator"></label>
                                        <h5 name="or_separator" id="or_separator" class="text-center"> OR </h5>
                                      </div>
                                      <div class="col-md-7">
                                        <label for="title">File<small> Select document from file vault</small></label>
                                        <div class="input-group">
                                          <input type="text" class="form-control" name="fs_selected_file_text" id="fs_selected_file_text" placeholder="Selected File" disabled="">
                                          <input type="number" class="form-control" name="fs_selected_file" id="fs_selected_file" hidden="">
                                          <div class="input-group-btn">
                                            <button class="btn btn-default" type="button" id="btn-fileVault-SelectFile">
                                              <i class="fa fa-folder-open-o" aria-hidden="true"></i>
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class=" col-md-12">
                                    <div class="work_nore">
                                        <h6>Signature</h6>
                                        <p> By Signing below you verify that the above information is true and complete,
                                            and you authorize payment and confirmation with nSmarTrac. </p>
                                    </div>
                                </div>


                                <div class="col-md-12 float-left custom-signaturepad">
                                   
                                    <div class="col-md-4 float-left">
                                          <h6>Company Representative Approval</h6>
                                          <div class="sigPad" id="smoothed"> <!-- style="width:404px;" -->
                                              <ul class="sigNav">
                                                  <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                                  <li class="clearButton"><a href="#clear">Clear</a></li>
                                              </ul>
                                              <div class="sig sigWrapper" style="height:auto;">
                                                  <div class="typed"></div>
                                                  <canvas class="pad" id="company_representative_approval_signature"></canvas>  <!--  width="400" height="250" -->
                                                  <input type="hidden" name="output-2" class="output">
                                              </div>
                                          </div>
                                          <input type="hidden" id="saveCompanySignatureDB" name="company_representative_approval_signature">
                                          <!-- <br> -->
                                          <label for="comp_rep_approval">Printed Name</label>
                                          <input type="text6" class="form-control mb-3" name="company_representative_printed_name" id="comp_rep_approval" placeholder="">
                                    </div>

                                    <div class=" col-md-4 float-left">
                                          <h6>Primary Account Holder</h6>
                                          <div class="sigPad" id="smoothed2"> <!-- style="width:404px;" -->
                                              <ul class="sigNav">
                                                  <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                                  <li class="clearButton"><a href="#clear">Clear</a></li>
                                              </ul>
                                              <div class="sig sigWrapper" style="height:auto;">
                                                  <div class="typed"></div>
                                                  <canvas class="pad" id="primary_account_holder_signature"></canvas>  <!--  width="400" height="250" -->
                                                  <input type="hidden" name="output-2" class="output">
                                              </div>
                                          </div>
                                          <input type="hidden" id="savePrimaryAccountSignatureDB" name="primary_account_holder_signature">
                                          <!-- <br>-->
                                          <label for="comp_rep_approval">Printed Name</label>
                                          <input type="text6" class="form-control mb-3" name="primary_account_holder_name" id="comp_rep_approval" placeholder=""> 

                                    </div>


                                    <div class=" col-md-4 float-left">
                                          <h6>Secondary Account Holder</h6>
                                          <div class="sigPad" id="smoothed3"> <!-- style="width:404px;" -->
                                              <ul class="sigNav">
                                                  <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                                  <li class="clearButton"><a href="#clear">Clear</a></li>
                                              </ul>
                                              <div class="sig sigWrapper" style="height:auto;">
                                                  <div class="typed"></div>
                                                  <canvas class="pad" id="secondary_account_holder_signature"></canvas>  <!--  width="400" height="250" -->
                                                  <input type="hidden" name="output-2" class="output">
                                              </div>
                                          </div>
                                          <input type="hidden" id="saveSecondaryAccountSignatureDB" name="secondery_account_holder_signature">
                                          <!-- <br> -->
                                          <label for="comp_rep_approval">Printed Name</label>
                                          <input type="text6" class="form-control mb-3" name="secondery_account_holder_name" id="comp_rep_approval" placeholder=""> 

                                    </div>
                                </div>


                                <div class=" col-md-6">
                                    <h5>Company Representative Approval</h5>
                                    <div class="sigPad" id="smoothed" style="width:404px;">
                                        <ul class="sigNav">
                                            <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                            <li class="clearButton"><a href="#clear">Clear</a></li>
                                        </ul>
                                        <div class="sig sigWrapper" style="height:auto;">
                                            <div class="typed"></div>
                                            <canvas class="pad" id="company_representative_approval_signature" width="400" height="250"></canvas>
                                            <input type="hidden" name="output-2" class="output">
                                        </div>
                                    </div>
                                    <input type="hidden" id="saveCompanySignatureDB" name="company_representative_approval_signature">
                                    <br>

                                    <label for="comp_rep_approval">Printed Name</label>
                                    <input type="text6" class="form-control mb-3" name="company_representative_printed_name" id="comp_rep_approval" placeholder="">

                                </div>
                                <div class=" col-md-6">
                                    <h5>Primary Account Holder</h5>
                                    <div class="sigPad" id="smoothed2" style="width:404px;">
                                        <ul class="sigNav">
                                            <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                            <li class="clearButton"><a href="#clear">Clear</a></li>
                                        </ul>
                                        <div class="sig sigWrapper" style="height:auto;">
                                            <div class="typed"></div>
                                            <canvas class="pad" id="primary_account_holder_signature" width="400" height="250"></canvas>
                                            <input type="hidden" name="output-2" class="output">
                                        </div>
                                    </div>
                                    <input type="hidden" id="savePrimaryAccountSignatureDB" name="primary_account_holder_signature">
                                    <br>

                                    <label for="comp_rep_approval">Printed Name</label>
                                    <input type="text6" class="form-control mb-3" name="primary_account_holder_name" id="comp_rep_approval" placeholder="">

                                </div>
                                <div class=" col-md-6">
                                    <h5>Secondary Account Holder</h5>
                                    <div class="sigPad" id="smoothed3" style="width:404px;">
                                        <ul class="sigNav">
                                            <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                            <li class="clearButton"><a href="#clear">Clear</a></li>
                                        </ul>
                                        <div class="sig sigWrapper" style="height:auto;">
                                            <div class="typed"></div>
                                            <canvas class="pad" id="secondary_account_holder_signature" width="400" height="250"></canvas>
                                            <input type="hidden" name="output-2" class="output">
                                        </div>
                                    </div>
                                    <input type="hidden" id="saveSecondaryAccountSignatureDB" name="secondery_account_holder_signature">
                                    <br>

                                    <label for="comp_rep_approval">Printed Name</label>
                                    <input type="text6" class="form-control mb-3" name="secondery_account_holder_name" id="comp_rep_approval" placeholder="">

                                </div>
                            </div>

                            <div class="row">
                                <div class=" col-md-12">
                                    <h6>Agreement</h6>
                                    <div style="height:200px; overflow:auto; background:#FFFFFF; padding-left:10px;">
                                        <strong>**This isn't everything... just a summary**</strong> You may CANCEL this
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

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="initials">**INITIALS**</label>
                                        <input type="text" class="form-control" name="initials" id="initials" placeholder="">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel-group">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" href="#POST-SERVICEcollapse1">POST-SERVICE
                                                        SUMMARY
                                                        <i class="fa fa-angle-down" style="font-size: 31px;top: 4px;position: relative;font-weight: bolder;" aria-hidden="true"></i></a>
                                                </h4>
                                            </div>
                                            <div id="POST-SERVICEcollapse1" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class=" col-md-4 form-group">
                                                            <label for="post_service_lead_source">Lead Source</label>
                                                            <select name="post_service_summary[lead_source][name]" class="form-control" id="post_service_lead_source">
                                                                <option>--SELECT--</option>
                                                                                                                                    <option value="Self-Gen">
                                                                        Self-Gen                                                                    </option>
                                                                                                                                    <option value="Affiliate">
                                                                        Affiliate                                                                    </option>
                                                                                                                                    <option value="Telemarketing">
                                                                        Telemarketing                                                                    </option>
                                                                                                                                    <option value="OFC">
                                                                        OFC                                                                    </option>
                                                                                                                                    <option value="Social Media">
                                                                        Social Media                                                                    </option>
                                                                                                                                    <option value="Website">
                                                                        Website                                                                    </option>
                                                                                                                                    <option value="Other">
                                                                        Other                                                                    </option>
                                                                                                                            </select>
                                                            <div class="form-group mt-2" style="display: none">
                                                                <input type="text" name="post_service_summary[lead_source][other]" class="form-control" placeholder="Write it here..." required="">
                                                            </div>
                                                        </div>
                                                        <div class=" col-md-4 form-group">
                                                            <label for="post_service_pwd">Sales Representative</label>
                                                            <input type="text" class="form-control" name="post_service_summary[sales_rep]" id="post_service_pwd" placeholder="">
                                                        </div>
                                                        <div class=" col-md-4 form-group">
                                                            <label for="post_service_pre_install">If Takeover, name of
                                                                previous products:</label>
                                                            <input type="text" class="form-control" name="post_service_summary[previous_products]" id="post_service_pre_install" placeholder="">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="notes_to_tech"> Notes to Admin:</label>
                                                            <textarea name="post_service_summary[notes_to_admin]" id="notes_to_admin" rows="3" class="form-control"></textarea>
                                                        </div>
                                                        <div class="col-md-12 mt-5">
                                                            <div id="POST-SERVICEcollapse1">
                                                                <div class="panel-body">
                                                                    <div class="row">
                                                                        <div class=" col-md-4 form-group">
                                                                            <label for="post_service_uid">USERID</label>
                                                                            <input type="text" class="form-control" name="post_service_summary[userid]" id="post_service_uid" placeholder="">
                                                                        </div>
                                                                        <div class=" col-md-4 form-group">
                                                                            <label for="post_service_pwd">PASSWORD</label>
                                                                            <input type="text" class="form-control" name="post_service_summary[password]" id="post_service_pwd" placeholder="">
                                                                        </div>
                                                                        <div class=" col-md-4 form-group">
                                                                            <label for="post_service_pre_install">Pre-Install
                                                                                Conf.
                                                                                #</label>
                                                                            <input type="text" class="form-control" name="post_service_summary[pre_install_conf]" id="post_service_pre_install" placeholder="">
                                                                        </div>
                                                                        <div class=" col-md-4 form-group">
                                                                            <label for="post_service_wifi_pwd">WiFi
                                                                                Password</label>
                                                                            <input type="text" class="form-control" name="post_service_summary[wifi_password]" id="post_service_wifi_pwd" placeholder="">
                                                                        </div>
                                                                        <div class=" col-md-4 form-group">
                                                                            <label for="post_service_panel_location">Panel
                                                                                Location</label>
                                                                            <input type="text" class="form-control" name="post_service_summary[panel_location]" id="post_service_panel_location" placeholder="">
                                                                        </div>
                                                                        <div class=" col-md-4 form-group">
                                                                            <label for="post_service_trans_location">Transformer
                                                                                Location</label>
                                                                            <input type="text" class="form-control" name="post_service_summary[transformer_location]" id="post_service_trans_location" placeholder="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <button type="button" onClick="validatecard();"
                                            class="btn btn-flat btn-primary">
                                        Submit
                                    </button>
                                    <a href="<?php echo url('workorder') ?>" class="btn btn-danger">Cancel</a>
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
                <!-- end row -->
            </div>
            <!-- end container-fluid -->
        </div>
        <!-- page wrapper end -->
    </div>
</div>

<?php echo $file_selection; ?>
<?php include viewPath('includes/footer'); ?>

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

        // phone type change, add the value to hiddend field and show the text
        $(document.body).on('click', '.changePhoneType', function () {
            $(this).closest('.phone-input').find('.type-text').text($(this).text());
            $(this).closest('.phone-input').find('.type-input').val($(this).data('type-value'));
        });


        $('#user_agreementupload').change(function (e) {

            var file = this.files[0];
            var form = new FormData();
            form.append('upload', file);
            $.ajax({
                url: '/docread.php',
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: form,
                success: function (response) {
                    /* alert(response); */
                    $('#showuploadagreement').empty().html(response);
                }
            });
        });

    });
</script>
