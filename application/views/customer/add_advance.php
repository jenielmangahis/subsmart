<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>

<style>
    .module_ac {
        background: #f2f2f2;
        border-radius: 1px;
        flex-direction: column; /*added*/
        display: inline-block;
        grid-gap: 15px;
        flex-flow: wrap;
        flex: 0 0 41.666667%;
        max-width: 30%;
        position: relative;
        padding-right: 15px;
        padding-left: 15px;
        padding-bottom: 15px;
        border: 2px solid #32243d !important;
        margin-left: 10px;
        margin-bottom: 20px;
        float: left;
        overflow-y:auto;
        overflow-x: auto;
        white-space: nowrap;
    }
    .module_header{
        /** background-color: #5f0a87;
      background-image: linear-gradient(326deg, #862987 0%, #5f0a87 74%); */

        background-color: #32243d;
        color : #fff;
        text-align: center;
        max-height: 40px;
        max-width: 100%;
        margin-bottom: 10px;
    }
    .module_ac2 {
        background: #f2f2f2;
        border-radius: 1px;
        display: flex;
        flex-flow: wrap;
        flex: 0 0 41.666667%;
        max-width: 100%;
        position: relative;
        padding-right: 15px;
        padding-left: 15px;
        padding-bottom: 15px;
        border: 2px solid #32243d !important;
        margin-left: 10px;
        margin-bottom: 20px;
    }
    .module_ac3 {
        background: #f2f2f2;
        border-radius: 1px;
        border-left : #0b2e13 20px;
        height : 130px;
    }

    .module_ac_long {
        background: #f2f2f2;
        border-radius: 1px;
        display: inline-block;
        flex-direction: column; /*added*/
        grid-gap: 15px;
        flex-flow: wrap;
        flex: 0 0 91%;
        max-width: 100%;
        position: relative;
        padding-right: 15px;
        padding-left: 15px;
        padding-bottom: 15px;
        border: 2px solid #32243d !important;
        margin-left: 10px;
        margin-bottom: 20px;
        float: left;
        overflow-y: auto;
        overflow-x: auto;
        white-space: nowrap;
        height:auto;
        min-height: 100px;
    }

    .form-control {
        font-size: 12px;
        height: 30px !important;
        line-height: 150%;
    }
    label{
        font-size: 12px !important;
        margin-bottom: 1px !important;
    }
    hr{
        border: 0.5px solid #32243d !important;
        width: 100%;
    }
    .form-group {
        margin-bottom: 3px !important;
    }
    .banking-tab-container {
        border-bottom: 1px solid grey;
        padding-left: 0;
    }
</style>

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/customer'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4>New Advance Customer</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Add your new customer.</li>
                        </ol>
                    </div>
                    <div class="col-sm-12">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <?php //if (hasPermissions('WORKORDER_MASTER')) : ?>
                                <a href="<?php echo base_url('customer') ?>" class="btn btn-primary"
                                   aria-expanded="false">
                                    <i class="mdi mdi-settings mr-2"></i> Go Back to Customer
                                </a>
                                <?php //endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <?php echo form_open_multipart('customer/save', ['class' => 'form-validate require-validation', 'id' => 'customer_form', 'autocomplete' => 'off']); ?>
            <style>
                .switch {
                    margin-top: 7px;
                    float:right;
                }

            </style>
            <div class="row custom__border">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="banking-tab-container">
                                        <div class="rb-01">
                                            <ul class="nav nav-tabs border-0">
                                                <li class="nav-item">
                                                    <a class="h6 mb-0 nav-link banking-sub-tab active" data-toggle="tab" href="#profile">Profile</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#other">Other Info</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#account">Account</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#address">Address</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#billing">Billing</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#alarm">Alarm</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#office">Office Use</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#admin">Admin</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#tech">Tech</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#access">Access</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#customizable">Customizable</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#payment">Payment</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#owner">Owner</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#assign">Assigned</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#notes">Notes</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#devices">Devices</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-content mt-4" >
                                        <?php
                                            include viewPath('customer/adv_module_sheets/sheet_profile');
                                            include viewPath('customer/adv_module_sheets/sheet_account');
                                            include viewPath('customer/adv_module_sheets/sheet_address');
                                            include viewPath('customer/adv_module_sheets/sheet_billing');
                                        ?>
                                        <div class="tab-pane fade standard-accordion" id="alarm">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-12 text-right-sm" style="align:right;">
                                                        <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                                                        <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                                                            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize">
                                                            <label class="onoffswitch-label" for="onoff-customize">
                                                                <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Monitoring Company</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Monitoring ID</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Install Date</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Credit Score</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Account Type</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Account Information</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Abort/Password Code</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Installer Code</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Monitoring confirmation number</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Signal confirmation number</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Contact Name #2</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Contact Name #2</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Contact Name #3</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Contact Name #3</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Contact Name #3</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Contact Name #3</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Panel Type</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">System Type</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Monitoring Waived</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Rebate Offered:</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Verification:</label><br/>
                                                        <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                            <option value="TrunsUnion">TrunsUnion</option>
                                                            <option value="Experian">Experian </option>
                                                            <option value="Equifax ">Equifax  </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Rebate Check 1</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Rebate Check 2</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Warranty Type</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 1</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="col-sm-12">
                                                    <div class="col-sm-12 text-right-sm" style="align:right;">
                                                        <button type="submit" class="btn btn-flat btn-primary"><span class="fa fa-remove"></span> Cancel</button>
                                                        <button type="submit" class="btn btn-flat btn-primary"><span class="fa fa-send"></span> Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade standard-accordion" id="office">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-12 text-right-sm" style="align:right;">
                                                        <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                                                        <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                                                            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize">
                                                            <label class="onoffswitch-label" for="onoff-customize">
                                                                <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="checkbox checkbox-sec margin-right">
                                                        <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                                                        <label for="notify_by_sms"><span>Welcome kit Sent</span></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-9"></div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="checkbox checkbox-sec margin-right">
                                                                <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                                                                <label for="notify_by_sms"><span>Rebate Received</span></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="checkbox checkbox-sec margin-right">
                                                                <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                                                                <label for="notify_by_sms"><span>Rebate Paid</span></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="">Commision Scheme Override</label><br/>
                                                    <div class="checkbox checkbox-sec margin-right">
                                                        <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                                                        <label for="notify_by_sms"><span>On</span></label>
                                                    </div>
                                                    <div class="checkbox checkbox-sec margin-right">
                                                        <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                                                        <label for="notify_by_sms"><span>Off</span></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Rep Commission $</label><br/>
                                                        <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Rep Upfront Pay</label><br/>
                                                        <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Tech Commission $</label><br/>
                                                        <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Tech Upfront Pay $</label><br/>
                                                        <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Rep Tiered Upfront Bonus</label><br/>
                                                        <i>$0.00</i>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Rep Tiered Holdfund Bonus</label><br/>
                                                        <i>$0.00</i>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Rep Deductions Total</label><br/>
                                                        <i>$0.00</i>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Tech Deductions Total</label><br/>
                                                        <i>$0.00</i>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Rep Hold Fund Charge Back $</label><br/>
                                                        <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Rep Payroll Charge Back $</label><br/>
                                                        <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                                <div class="col-md-12">
                                                    <label for="">Points Scheme Override</label><br/>
                                                    <div class="checkbox checkbox-sec margin-right">
                                                        <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                                                        <label for="notify_by_sms"><span>On</span></label>
                                                    </div>
                                                    <div class="checkbox checkbox-sec margin-right">
                                                        <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                                                        <label for="notify_by_sms"><span>Off</span></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Points Included</label><br/>
                                                        <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Price Per Point $</label><br/>
                                                        <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Purchase Price $</label><br/>
                                                        <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Purchase Multiple</label><br/>
                                                        <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Purchase Discount $</label><br/>
                                                        <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>

                                                <hr>
                                                <div class="col-sm-12">
                                                    <div class="col-sm-12 text-right-sm" style="align:right;">
                                                        <button type="submit" class="btn btn-flat btn-primary"><span class="fa fa-remove"></span> Cancel</button>
                                                        <button type="submit" class="btn btn-flat btn-primary"><span class="fa fa-send"></span> Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade standard-accordion" id="admin">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-12 text-right-sm" style="align:right;">
                                                        <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                                                        <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                                                            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize">
                                                            <label class="onoffswitch-label" for="onoff-customize">
                                                                <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Entered by</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Time Entered</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Assign To</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Pre-install Survey</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 1</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Language</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Date Enter</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Sales Rep</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Post-install Survey</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 2</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>

                                                <hr>
                                                <div class="col-sm-12">
                                                    <div class="col-sm-12 text-right-sm" style="align:right;">
                                                        <button type="submit" class="btn btn-flat btn-primary"><span class="fa fa-remove"></span> Cancel</button>
                                                        <button type="submit" class="btn btn-flat btn-primary"><span class="fa fa-send"></span> Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade standard-accordion" id="tech">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-12 text-right-sm" style="align:right;">
                                                        <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                                                        <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                                                            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize">
                                                            <label class="onoffswitch-label" for="onoff-customize">
                                                                <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Tech Arrive Time</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Tech Complete Time</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Time Given</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Date Given</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">TECH Assign</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 1</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 2</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 3</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 4</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">URL</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>

                                                <hr>
                                                <div class="col-sm-12">
                                                    <div class="col-sm-12 text-right-sm" style="align:right;">
                                                        <button type="submit" class="btn btn-flat btn-primary"><span class="fa fa-remove"></span> Cancel</button>
                                                        <button type="submit" class="btn btn-flat btn-primary"><span class="fa fa-send"></span> Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade standard-accordion" id="access">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-12 text-right-sm" style="align:right;">
                                                        <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                                                        <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                                                            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize">
                                                            <label class="onoffswitch-label" for="onoff-customize">
                                                                <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Portal Status (on/off)</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Reset Password (Button)</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Login</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Password</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 1</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 2</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Cancellation Date</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Collection Date</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Cancellation Reason</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Collection Amount</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="col-sm-12">
                                                    <div class="col-sm-12 text-right-sm" style="align:right;">
                                                        <button type="submit" class="btn btn-flat btn-primary"><span class="fa fa-remove"></span> Cancel</button>
                                                        <button type="submit" class="btn btn-flat btn-primary"><span class="fa fa-send"></span> Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade standard-accordion" id="customizable">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-12 text-right-sm" style="align:right;">
                                                        <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                                                        <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                                                            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize">
                                                            <label class="onoffswitch-label" for="onoff-customize">
                                                                <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 1</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 2</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 3</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 4</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 5</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 6</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 7</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 8</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 9</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 10</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 11</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 12</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 13</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 14</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 15</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 16</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 17</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 18</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 19</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 20</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 21</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 22</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 23</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Custom Field 24</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="col-sm-12">
                                                    <div class="col-sm-12 text-right-sm" style="align:right;">
                                                        <button type="submit" class="btn btn-flat btn-primary"><span class="fa fa-remove"></span> Cancel</button>
                                                        <button type="submit" class="btn btn-flat btn-primary"><span class="fa fa-send"></span> Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br><br><br>

                                <!--<div class="module_ac" style="max-width: 90%;">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="checkbox checkbox-sec margin-right">
                                                <input type="checkbox" name="notify_by" value="Email" id="notify_by_email">
                                                <label for="notify_by_email"><span>Rep Paper</span></label>
                                            </div>
                                            <div class="form-group" id="customer_type_group">
                                                <label for=""></label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div><br>

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4">

                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for=""></label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for=""></label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Status</label><br/>
                                                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                    <option value="0">Scheduled</option>
                                                    <option value="0">Re-Scheduled</option>
                                                    <option value="0">Past Date</option>
                                                    <option value="0">Cancel Pending</option>
                                                    <option value="0">Service Customer</option>
                                                    <option value="0">Charged Back</option>
                                                    <option value="0">Installed</option>
                                                    <option value="0">Cancelled</option>
                                                    <option value="0">Collections</option>
                                                    <option value="0">No Show</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->

                                <!--<div class=" module_ac">
                                                <div class="row">
                                                    <div class="col-md-12 module_header">
                                                        <div class="onoffswitch grid-onoffswitch switch">
                                                            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize"> <label class="onoffswitch-label" for="onoff-customize"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span></label>
                                                        </div>
                                                        <h6>Account Information</h6>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Entered By</label><br/>
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Time Entered</label><br/>
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Sales Date</label><br/>
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Credit Score *</label><br/>
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Monitoring Company *</label><br/>
                                                            <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                <option value="0">- none -</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Account Type *</label><br/>
                                                            <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                <option value="0">Select</option>
                                                                <option value="0">In-House</option>
                                                                <option value="0">Purchase</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Monitoring ID</label><br/>
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Language</label><br/>
                                                            <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                <option value="0">Select</option>
                                                                <option value="English">English</option>
                                                                <option value="Spanish">Spanish</option>
                                                                <option value="Mandarin Chinese">Mandarin Chinese</option>
                                                                <option value="French">French</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Signal Confirmation Number</label><br/>
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Monitoring Confirmation </label><br/>
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Abort Code</label><br/>
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Sales Rep</label><br/>
                                                            <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                <option value="0">- none -</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Technician</label><br/>
                                                            <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                <option value="0">- none -</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Save Date</label><br/>
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Save By</label><br/>
                                                            <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                <option value="0">- none -</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Cancellation Date</label><br/>
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Cancellation Reason</label><br/>
                                                            <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                <option value="0">Select</option>
                                                                <option value="0">Dissatisfied with Service</option>
                                                                <option value="0">Financial Hardship</option>
                                                                <option value="0">Fulfilled Contract</option>
                                                                <option value="0">Moving</option>
                                                                <option value="0">Non-Payment</option>
                                                                <option value="0">Paid BOC</option>
                                                                <option value="0">Passed Away</option>
                                                                <option value="0">Still Under Contruct</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="checkbox checkbox-sec margin-right">
                                                            <input type="checkbox" name="notify_by" value="Email" checked id="notify_by_email">
                                                            <label for="notify_by_email"><span>Check for Schedule Conflict</span></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Install Date</label><br/>
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Tech Arrival Time</label><br/>
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Tech Departure Time</label><br/>
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Panel Type *</label><br/>
                                                            <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                <option value="0">- none -</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Pre-Install Survey</label><br/>
                                                            <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                <option value="0">Select</option>
                                                                <option value="0">Pass</option>
                                                                <option value="0">Fail</option>
                                                                <option value="0">Pending</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Post-Install Survey</label><br/>
                                                            <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                <option value="0">Select</option>
                                                                <option value="0">Pass</option>
                                                                <option value="0">Fail</option>
                                                                <option value="0">Pending</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Monitoring Waived</label><br/>
                                                            <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                <option value="0">- none -</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="checkbox checkbox-sec margin-right">
                                                            <input type="checkbox" name="notify_by" value="Email" checked id="notify_by_email">
                                                            <label for="notify_by_email"><span>Rebate Offered</span></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group" id="customer_type_group">
                                                                    <label for="">Rebate Check # 1</label><br/>
                                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group" id="customer_type_group">
                                                                    <label for="">Amount $</label><br/>
                                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group" id="customer_type_group">
                                                                    <label for="">Rebate Check # 2</label><br/>
                                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group" id="customer_type_group">
                                                                    <label for="">Amount $</label><br/>
                                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group" id="customer_type_group">
                                                                    <label for="">Activation Fee</label><br/>
                                                                    <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                        <option value="0">- none -</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group" id="customer_type_group">
                                                                    <div class="checkbox checkbox-sec margin-right">
                                                                        <input type="checkbox" name="notify_by" value="Email" checked id="notify_by_email">
                                                                        <label for="notify_by_email"><span>None</span></label>
                                                                    </div>
                                                                    <div class="checkbox checkbox-sec margin-right">
                                                                        <input type="checkbox" name="notify_by" value="Email" checked id="notify_by_email">
                                                                        <label for="notify_by_email"><span>Check</span></label>
                                                                    </div>
                                                                    <div class="checkbox checkbox-sec margin-right">
                                                                        <input type="checkbox" name="notify_by" value="Email" checked id="notify_by_email">
                                                                        <label for="notify_by_email"><span>Credit</span></label>
                                                                    </div>
                                                                    <div class="checkbox checkbox-sec margin-right">
                                                                        <input type="checkbox" name="notify_by" value="Email" checked id="notify_by_email">
                                                                        <label for="notify_by_email"><span>Paid</span></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Lead Source</label><br/>
                                                            <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                <option value="0">Select</option>
                                                                <option value="0">Customer Referral</option>
                                                                <option value="0">Door</option>
                                                                <option value="0">Door Hanger</option>
                                                                <option value="0">Flyer Mail Outs</option>
                                                                <option value="0">Outbound Calls</option>
                                                                <option value="0">Phone</option>
                                                                <option value="0">Radio Ad</option>
                                                                <option value="0">Social Media</option>
                                                                <option value="0">TV Ad</option>
                                                                <option value="0">Unknown</option>
                                                                <option value="0">Website</option>
                                                                <option value="0">Yard Sign</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                         </div>-->

                                <!--<div class=" module_ac">
                                    <div class="row">
                                        <div class="col-md-12 module_header">
                                            <div class="onoffswitch grid-onoffswitch switch">
                                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize"> <label class="onoffswitch-label" for="onoff-customize"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span></label>
                                            </div>
                                            <h6>Address Information</h6>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Sales Area</label><br/>
                                                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                    <option value="0">- none -</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Name Prefix</label><br/>
                                                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                    <option value="0">Select</option>
                                                    <option value="0">Captain</option>
                                                    <option value="0">Cnl.</option>
                                                    <option value="0">Colonel</option>
                                                    <option value="0">Dr.</option>
                                                    <option value="0">Gen.</option>
                                                    <option value="0">Judge</option>
                                                    <option value="0">Lady</option>
                                                    <option value="0">Lieutenant</option>
                                                    <option value="0">Lord</option>
                                                    <option value="0">Lt.</option>
                                                    <option value="0">Madam</option>
                                                    <option value="0">Maj.</option>
                                                    <option value="0">Major</option>
                                                    <option value="0">Master</option>
                                                    <option value="0">Miss</option>
                                                    <option value="0">Mister</option>
                                                    <option value="0">Mr.</option>
                                                    <option value="0">Mrs.</option>
                                                    <option value="0">Ms.</option>
                                                    <option value="0">Pastor</option>
                                                    <option value="0">Private</option>
                                                    <option value="0">Prof.</option>
                                                    <option value="0">Pvt.</option>
                                                    <option value="0">Rev.</option>
                                                    <option value="0">Sergeant</option>
                                                    <option value="0">Sgt</option>
                                                    <option value="0">Sir</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">First Name</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Middle Initial</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Last Name</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Date of Birth</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Name Suffix</label><br/>
                                                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                    <option value="0">Select</option>
                                                    <option value="0">DS</option>
                                                    <option value="0">Esq.</option>
                                                    <option value="0">II</option>
                                                    <option value="0">III</option>
                                                    <option value="0">IV</option>
                                                    <option value="0">Jr.</option>
                                                    <option value="0">MA</option>
                                                    <option value="0">MBA</option>
                                                    <option value="0">MD</option>
                                                    <option value="0">MS</option>
                                                    <option value="0">PhD</option>
                                                    <option value="0">RN</option>
                                                    <option value="0">Sr.</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Company</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Address *</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Cross Street</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Subdivision</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">City State ZIP</label><br/>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Country</label><br/>
                                                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                    <option value="0">USA</option>
                                                    <option value="0">Canada</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Home/Panel Phone *</label><br/>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Cell Phone </label><br/>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Alternate Phone </label><br/>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Email</label><br/>
                                                <input type="email" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Contact First Name</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Contact Last Name</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Contact Phone </label><br/>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                            <option value="0">Select</option>
                                                            <option value="0">Cell</option>
                                                            <option value="0">Fax</option>
                                                            <option value="0">Home</option>
                                                            <option value="0">Pager</option>
                                                            <option value="0">Work</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Contact Relationship</label><br/>
                                                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                    <option value="0">- none -</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Contact First Name</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Contact Last Name</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Contact Phone </label><br/>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                            <option value="0">Select</option>
                                                            <option value="0">Cell</option>
                                                            <option value="0">Fax</option>
                                                            <option value="0">Home</option>
                                                            <option value="0">Pager</option>
                                                            <option value="0">Work</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Contact Relationship</label><br/>
                                                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                    <option value="0">- none -</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->

                                <!--<div class="module_ac">
                                    <div class="row">
                                        <div class="col-md-12 module_header">
                                            <div class="onoffswitch grid-onoffswitch switch">
                                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize"> <label class="onoffswitch-label" for="onoff-customize"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span></label>
                                            </div>
                                            <h6>Admin Module</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Entered by</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Time Entered</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Assign To</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Pre-install Survey</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Custom Field 1</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Language</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Date Enter</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Sales Rep</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Post-install Survey</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Custom Field 2</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->

                                <!--<div class="module_ac" >
                                    <div class="row">
                                        <div class="col-md-12 module_header">
                                            <div class="onoffswitch grid-onoffswitch switch">
                                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize"> <label class="onoffswitch-label" for="onoff-customize"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span></label>
                                            </div>
                                            <h6>Billing Information</h6>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Card Holder First Name</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Card Holder Last Name</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Card Holder Address </label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">City State ZIP</label><br/>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Monthly Monitoring Rate* $</label><br/>
                                                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                    <option value="0">0.00</option>
                                                    <option value="0">5.00</option>
                                                    <option value="0">6.95</option>
                                                    <option value="0">6.95</option>
                                                    <option value="0">17.99</option>
                                                    <option value="0">19.91</option>
                                                    <option value="0">19.99</option>
                                                    <option value="0">20.00</option>
                                                    <option value="0">21.25</option>
                                                    <option value="0">21.91</option>
                                                    <option value="0">21.99</option>
                                                    <option value="0">22.00</option>
                                                    <option value="0">22.99</option>
                                                    <option value="0">24.99</option>
                                                    <option value="0">25.00</option>
                                                    <option value="0">25.91</option>
                                                    <option value="0">25.99</option>
                                                    <option value="0">26.99</option>
                                                    <option value="0">27.91</option>
                                                    <option value="0">27.99</option>
                                                    <option value="0">29.91</option>
                                                    <option value="0">29.97</option>
                                                    <option value="0">29.99</option>
                                                    <option value="0">30.00</option>
                                                    <option value="0">30.33</option>
                                                    <option value="0">30.50</option>
                                                    <option value="0">31.00</option>
                                                    <option value="0">31.95</option>
                                                    <option value="0">31.99</option>
                                                    <option value="0">32.41</option>
                                                    <option value="0">32.91</option>
                                                    <option value="0">32.99</option>
                                                    <option value="0">33.91</option>
                                                    <option value="0">34.91</option>
                                                    <option value="0">34.99</option>
                                                    <option value="0">35.00</option>
                                                    <option value="0">35.91</option>
                                                    <option value="0">35.95</option>
                                                    <option value="0">35.99</option>
                                                    <option value="0">36.91</option>
                                                    <option value="0">36.95</option>
                                                    <option value="0">36.99</option>
                                                    <option value="0">37.91</option>
                                                    <option value="0">37.99</option>
                                                    <option value="0">38.00</option>
                                                    <option value="0">38.91</option>
                                                    <option value="0">38.99</option>
                                                    <option value="0">39.00</option>
                                                    <option value="0">39.91</option>
                                                    <option value="0">39.95</option>
                                                    <option value="0">39.97</option>
                                                    <option value="0">39.99</option>
                                                    <option value="0">40.00</option>
                                                    <option value="0">40.91</option>
                                                    <option value="0">40.95</option>
                                                    <option value="0">40.99</option>
                                                    <option value="0">41.91</option>
                                                    <option value="0">41.95</option>
                                                    <option value="0">41.99</option>
                                                    <option value="0">42.91</option>
                                                    <option value="0">42.97</option>
                                                    <option value="0">42.99</option>
                                                    <option value="0">43.98</option>
                                                    <option value="0">44.91</option>
                                                    <option value="0">44.93</option>
                                                    <option value="0">44.95</option>
                                                    <option value="0">44.97</option>
                                                    <option value="0">44.99</option>
                                                    <option value="0">45.00</option>
                                                    <option value="0">45.91</option>
                                                    <option value="0">45.95</option>
                                                    <option value="0">46.95</option>
                                                    <option value="0">46.99</option>
                                                    <option value="0">47.07</option>
                                                    <option value="0">47.91</option>
                                                    <option value="0">47.94</option>
                                                    <option value="0">47.95</option>
                                                    <option value="0">47.97</option>
                                                    <option value="0">47.99</option>
                                                    <option value="0">48.65</option>
                                                    <option value="0">48.91</option>
                                                    <option value="0">48.95</option>
                                                    <option value="0">48.97</option>
                                                    <option value="0">49.91</option>
                                                    <option value="0">49.95</option>
                                                    <option value="0">49.97</option>
                                                    <option value="0">49.99</option>
                                                    <option value="0">50.00</option>
                                                    <option value="0">50.91</option>
                                                    <option value="0">50.99</option>
                                                    <option value="0">51.00</option>
                                                    <option value="0">51.91</option>
                                                    <option value="0">51.95</option>
                                                    <option value="0">51.99</option>
                                                    <option value="0">52.91</option>
                                                    <option value="0">52.95</option>
                                                    <option value="0">53.37</option>
                                                    <option value="0">53.91</option>
                                                    <option value="0">53.92</option>
                                                    <option value="0">53.95</option>
                                                    <option value="0">53.97</option>
                                                    <option value="0">53.99</option>
                                                    <option value="0">54.91</option>
                                                    <option value="0">54.95</option>
                                                    <option value="0">54.97</option>
                                                    <option value="0">54.99</option>
                                                    <option value="0">55.00</option>
                                                    <option value="0">55.91</option>
                                                    <option value="0">55.95</option>
                                                    <option value="0">55.97</option>
                                                    <option value="0">55.99</option>
                                                    <option value="0">56.91</option>
                                                    <option value="0">56.95</option>
                                                    <option value="0">56.99</option>
                                                    <option value="0">57.91</option>
                                                    <option value="0">57.97</option>
                                                    <option value="0">57.99</option>
                                                    <option value="0">58.91</option>
                                                    <option value="0">58.95</option>
                                                    <option value="0">58.99</option>
                                                    <option value="0">59.34</option>
                                                    <option value="0">59.91</option>
                                                    <option value="0">59.95</option>
                                                    <option value="0">59.97</option>
                                                    <option value="0">59.99</option>
                                                    <option value="0">60.99</option>
                                                    <option value="0">61.99</option>
                                                    <option value="0">62.91</option>
                                                    <option value="0">62.99</option>
                                                    <option value="0">63.91</option>
                                                    <option value="0">63.99</option>
                                                    <option value="0">64.91</option>
                                                    <option value="0">64.95</option>
                                                    <option value="0">64.99</option>
                                                    <option value="0">65.99</option>
                                                    <option value="0">66.91</option>
                                                    <option value="0">67.91</option>
                                                    <option value="0">67.99</option>
                                                    <option value="0">69.91</option>
                                                    <option value="0">69.99</option>
                                                    <option value="0">70.99</option>
                                                    <option value="0">71.99</option>
                                                    <option value="0">72.98</option>
                                                    <option value="0">73.99</option>
                                                    <option value="0">74.91</option>
                                                    <option value="0">74.95</option>
                                                    <option value="0">74.98</option>
                                                    <option value="0">74.99</option>
                                                    <option value="0">75.99</option>
                                                    <option value="0">77.99</option>
                                                    <option value="0">79.90</option>
                                                    <option value="0">79.91</option>
                                                    <option value="0">79.99</option>
                                                    <option value="0">80.98</option>
                                                    <option value="0">81.95</option>
                                                    <option value="0">81.99</option>
                                                    <option value="0">84.99</option>
                                                    <option value="0">85.95</option>
                                                    <option value="0">85.99</option>
                                                    <option value="0">87.99</option>
                                                    <option value="0">88.00</option>
                                                    <option value="0">88.91</option>
                                                    <option value="0">89.91</option>
                                                    <option value="0">89.97</option>
                                                    <option value="0">89.99</option>
                                                    <option value="0">93.94</option>
                                                    <option value="0">94.99</option>
                                                    <option value="0">97.85</option>
                                                    <option value="0">99.00</option>
                                                    <option value="0">99.90</option>
                                                    <option value="0">99.91</option>
                                                    <option value="0">99.94</option>
                                                    <option value="0">99.97</option>
                                                    <option value="0">99.98</option>
                                                    <option value="0">99.99</option>
                                                    <option value="0">100.99</option>
                                                    <option value="0">101.97</option>
                                                    <option value="0">103.98</option>
                                                    <option value="0">103.99</option>
                                                    <option value="0">104.99</option>
                                                    <option value="0">105.98</option>
                                                    <option value="0">107.90</option>
                                                    <option value="0">108.98</option>
                                                    <option value="0">109.90</option>
                                                    <option value="0">109.91</option>
                                                    <option value="0">109.99</option>
                                                    <option value="0">113.98</option>
                                                    <option value="0">115.98</option>
                                                    <option value="0">118.98</option>
                                                    <option value="0">119.99</option>
                                                    <option value="0">120.98</option>
                                                    <option value="0">129.00</option>
                                                    <option value="0">129.99</option>
                                                    <option value="0">134.99</option>
                                                    <option value="0">139.91</option>
                                                    <option value="0">149.99</option>
                                                    <option value="0">161.23</option>
                                                    <option value="0">199.97</option>
                                                    <option value="0">255.00</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Billing Frequency</label><br/>
                                                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                    <option value="0">- none -</option>
                                                    <option value="One Time Only">One Time Only</option>
                                                    <option value="Every 1 Month">Every 1 Month</option>
                                                    <option value="Every 3 Months">Every 3 Months</option>
                                                    <option value="Every 6 Months">Every 6 Months</option>
                                                    <option value="Every 1 Year">Every 1 Year</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Billing Day of Month</label><br/>
                                                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                    <option value="0"></option>
                                                    <option value="0">1</option>
                                                    <option value="0">2</option>
                                                    <option value="0">3</option>
                                                    <option value="0">4</option>
                                                    <option value="0">5</option>
                                                    <option value="0">6</option>
                                                    <option value="0">7</option>
                                                    <option value="0">8</option>
                                                    <option value="0">9</option>
                                                    <option value="0">10</option>
                                                    <option value="0">11</option>
                                                    <option value="0">12</option>
                                                    <option value="0">13</option>
                                                    <option value="0">14</option>
                                                    <option value="0">15</option>
                                                    <option value="0">16</option>
                                                    <option value="0">17</option>
                                                    <option value="0">18</option>
                                                    <option value="0">19</option>
                                                    <option value="0">20</option>
                                                    <option value="0">21</option>
                                                    <option value="0">22</option>
                                                    <option value="0">23</option>
                                                    <option value="0">24</option>
                                                    <option value="0">25</option>
                                                    <option value="0">26</option>
                                                    <option value="0">27</option>
                                                    <option value="0">28</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Contract Term* (months)</label><br/>
                                                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                    <option value="0"></option>
                                                    <option value="0">36</option>
                                                    <option value="0">60</option>
                                                    <option value="0">12</option>
                                                    <option value="0">24</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Billing Method</label><br/>
                                                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                    <option value="0">- none -</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Billing Start Date</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Billing End Date</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Check Number</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Routing Number</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Account Number</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Credit Card Number</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Credit Card Expiration</label><br/>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>/
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div> (MM/YYYY)
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Social Security Number</label><br/>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div> -
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div> -
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Collections Date</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Collections Amount $</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Contract Extension Date</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->

                                <!--<div class="module_ac">
                                    <div class="row">
                                        <div class="col-md-12 module_header">
                                            <div class="onoffswitch grid-onoffswitch switch">
                                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize"> <label class="onoffswitch-label" for="onoff-customize"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span></label>
                                            </div>
                                            <h6>Tech Module</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Tech Arrive Time</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Tech Complete Time</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Time Given</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Date Given</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">TECH Assign</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Custom Field 1</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Custom Field 2</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Custom Field 3</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Custom Field 4</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">URL</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>



                                    </div>
                                </div>-->

                                <!--<div class="module_ac">
                                    <div class="row">
                                        <div class="col-md-12 module_header">
                                            <div class="onoffswitch grid-onoffswitch switch">
                                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize"> <label class="onoffswitch-label" for="onoff-customize"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span></label>
                                            </div>
                                            <h6>Account Access Module</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Portal Status (on/off)</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Reset Password (Button)</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Login</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Password</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Custom Field 1</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Custom Field 2</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Cancellation Date</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Collection Date</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Cancellation Reason</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Collection Amount</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->

                               <!-- <div class="module_ac">
                                        <div class="row">
                                            <div class="col-md-12 module_header">
                                                <div class="onoffswitch grid-onoffswitch switch">
                                                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize"> <label class="onoffswitch-label" for="onoff-customize"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span></label>
                                                </div>
                                                <h6>Alarm Industry Module</h6>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Monitoring Company</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Monitoring ID</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Install Date</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Credit Score</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Account Type</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Account Information</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Abort/Password Code</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Installer Code</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Monitoring confirmation number</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Signal confirmation number</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Contact Name #2</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Contact Name #2</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Contact Name #3</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Contact Name #3</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Contact Name #3</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Contact Name #3</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Panel Type</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">System Type</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Monitoring Waived</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Rebate Offered:</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Verification:</label><br/>
                                                    <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                        <option value="TrunsUnion">TrunsUnion</option>
                                                        <option value="Experian">Experian </option>
                                                        <option value="Equifax ">Equifax  </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Rebate Check 1</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Rebate Check 2</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Warranty Type</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 1</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->

                                <!--<div class="module_ac">
                                        <div class="row">
                                            <div class="col-md-12 module_header">
                                                <div class="onoffswitch grid-onoffswitch switch">
                                                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize"> <label class="onoffswitch-label" for="onoff-customize"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span></label>
                                                </div>
                                                <h6>Customizable Industry Module</h6>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 1</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 2</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 3</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 4</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 5</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 6</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 7</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 8</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 9</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 10</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 11</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 12</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 13</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 14</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 15</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 16</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 17</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 18</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 19</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 20</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 21</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 22</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 23</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 24</label><a href="#"><span class="fa fa-pencil pull-right"></span></a><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->

                                <!--<div class="module_ac">
                                    <div class="row">
                                        <div class="col-md-12 module_header">
                                            <div class="onoffswitch grid-onoffswitch switch">
                                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize"> <label class="onoffswitch-label" for="onoff-customize"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span></label>
                                            </div>
                                            <h6>Profile Module</h6>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Sales Area</label><br/>
                                                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                    <option value="0">- none -</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">First Name</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Last Name</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Middle Name</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Name Prefix</label><br/>
                                                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                    <option value="0">Select</option>
                                                    <option value="0">Captain</option>
                                                    <option value="0">Cnl.</option>
                                                    <option value="0">Colonel</option>
                                                    <option value="0">Dr.</option>
                                                    <option value="0">Gen.</option>
                                                    <option value="0">Judge</option>
                                                    <option value="0">Lady</option>
                                                    <option value="0">Lieutenant</option>
                                                    <option value="0">Lord</option>
                                                    <option value="0">Lt.</option>
                                                    <option value="0">Madam</option>
                                                    <option value="0">Maj.</option>
                                                    <option value="0">Major</option>
                                                    <option value="0">Master</option>
                                                    <option value="0">Miss</option>
                                                    <option value="0">Mister</option>
                                                    <option value="0">Mr.</option>
                                                    <option value="0">Mrs.</option>
                                                    <option value="0">Ms.</option>
                                                    <option value="0">Pastor</option>
                                                    <option value="0">Private</option>
                                                    <option value="0">Prof.</option>
                                                    <option value="0">Pvt.</option>
                                                    <option value="0">Rev.</option>
                                                    <option value="0">Sergeant</option>
                                                    <option value="0">Sgt</option>
                                                    <option value="0">Sir</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Surffix</label><br/>
                                                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                    <option value="0">- none -</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Business Name</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Email</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">SSN</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">DOB</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Phone (H)</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Phone (W)</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Phone (M)</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Fax</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Mailing Address</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Image/Logo File</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">City</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">State</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Country</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Zip Code</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Cross Street</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Subdivision</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkbox checkbox-sec margin-right">
                                                <input type="checkbox" name="notify_by" value="Email" checked id="prev_add">
                                                <label for="prev_add"><span>Check for Schedule Conflict</span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->

                                <!--<div class="module_ac">
                                    <div class="row">
                                        <div class="col-md-12 module_header">
                                            <div class="onoffswitch grid-onoffswitch switch">
                                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize"> <label class="onoffswitch-label" for="onoff-customize"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span></label>
                                            </div>
                                            <h6>Office Use</h6>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkbox checkbox-sec margin-right">
                                                <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                                                <label for="notify_by_sms"><span>Welcome kit Sent</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="checkbox checkbox-sec margin-right">
                                                        <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                                                        <label for="notify_by_sms"><span>Rebate Received</span></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="checkbox checkbox-sec margin-right">
                                                        <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                                                        <label for="notify_by_sms"><span>Rebate Paid</span></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Commision Scheme Override</label><br/>
                                            <div class="checkbox checkbox-sec margin-right">
                                                <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                                                <label for="notify_by_sms"><span>On</span></label>
                                            </div>
                                            <div class="checkbox checkbox-sec margin-right">
                                                <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                                                <label for="notify_by_sms"><span>Off</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Rep Commission $</label><br/>
                                                <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Rep Upfront Pay</label><br/>
                                                <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Rep Tiered Upfront Bonus</label><br/>
                                                <i>$0.00</i>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Rep Tiered Holdfund Bonus</label><br/>
                                                <i>$0.00</i>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Rep Deductions Total</label><br/>
                                                <i>$0.00</i>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Tech Commission $</label><br/>
                                                <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Tech Upfront Pay $</label><br/>
                                                <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Tech Deductions Total</label><br/>
                                                <i>$0.00</i>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Rep Hold Fund Charge Back $</label><br/>
                                                <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Rep Payroll Charge Back $</label><br/>
                                                <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Points Scheme Override</label><br/>
                                            <div class="checkbox checkbox-sec margin-right">
                                                <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                                                <label for="notify_by_sms"><span>On</span></label>
                                            </div>
                                            <div class="checkbox checkbox-sec margin-right">
                                                <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                                                <label for="notify_by_sms"><span>Off</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Points Included</label><br/>
                                                <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Price Per Point $</label><br/>
                                                <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Purchase Price $</label><br/>
                                                <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Purchase Multiple</label><br/>
                                                <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Purchase Discount $</label><br/>
                                                <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->

                                <div class="module_ac">
                                    <div class="row">
                                        <div class="col-md-12 module_header">
                                            <div class="onoffswitch grid-onoffswitch switch">
                                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize"> <label class="onoffswitch-label" for="onoff-customize"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span></label>
                                            </div>
                                            <h6>Payment Information</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="checkbox checkbox-sec margin-right">
                                                <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                                                <label for="notify_by_sms"><span>Credit Card</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="checkbox checkbox-sec margin-right">
                                                <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                                                <label for="notify_by_sms"><span>eCheck</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Card Number</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for="">Credit Card Expiration</label><br/>
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group" id="customer_type_group">
                                                        <label for=""></label>(MM/YYYY)
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Transaction Subtotal</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Tax Amount</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Transaction Amount</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Transaction Category</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Note</label><br/>
                                                <textarea class="form-controls" cols="55" rows="5"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <button type="submit" class="btn btn-flat btn-primary">Pre-Add Mode</button>
                                                <button type="submit" class="btn btn-flat btn-primary">Capture New </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="module_ac">
                                    <div class="row">
                                        <div class="col-md-12 module_header">
                                            <div class="onoffswitch grid-onoffswitch switch">
                                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize"> <label class="onoffswitch-label" for="onoff-customize"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span></label>
                                            </div>
                                            <h6>Customer Information</h6>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">First Name</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Last Name</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Address</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">City</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">State</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Zip</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="module_ac">
                                    <div class="row">
                                        <div class="col-md-12 module_header">
                                            <div class="onoffswitch grid-onoffswitch switch">
                                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize"> <label class="onoffswitch-label" for="onoff-customize"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span></label>
                                            </div>
                                            <h6>Owner Information</h6>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Social Security Number</label><br/>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div> -
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div> -
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">First Name</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Last Name</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Address 1</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Address 2</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Address 3</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">City State ZIP</label><br/>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="pay_history">Pay History</label><br/>
                                                <select id="pay_history" name="pay_history" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>

                                <!--<div class="module_ac">
                                    <div class="row">
                                        <div class="col-md-12 module_header">
                                            <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                            </label>
                                            <h6>Custom Fields</h6>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group" id="customer_type_group">
                                                <label for="">Contract Extension Date</label><br/>
                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                            </div>
                                        </div>

                                    </div>
                                </div>   -->

                                <div class="col-md-12 module_ac_long">
                                    <div class="row">
                                        <div class="col-md-12 module_header">
                                            <div class="onoffswitch grid-onoffswitch switch">
                                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize"> <label class="onoffswitch-label" for="onoff-customize"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span></label>
                                            </div>
                                            <h6>Existing Notes</h6>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <textarea class="form-controls"> </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 module_ac_long">
                                    <div class="row">
                                    <div class="col-md-12 module_header">
                                        <div class="onoffswitch grid-onoffswitch switch">
                                            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize"> <label class="onoffswitch-label" for="onoff-customize"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span></label>
                                        </div>
                                        <h6>Devices</h6>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-flat btn-primary">Cancel</button><br>
                                            <button type="submit" class="btn btn-flat btn-primary">Delete </button><br>
                                            <button type="submit" class="btn btn-flat btn-primary">Save</button>
                                        </div>
                                        <div class="col-md-10">
                                            <table class="table  table-bordered table-to-list" data-id="work_orders">
                                                <thead>
                                                <tr>
                                                    <th>Del</th>
                                                    <th>Name</th>
                                                    <th>Sold By</th>
                                                    <th>Points</th>
                                                    <th>Retail Cost</th>
                                                    <th>Purchase Price</th>
                                                    <th>Qty</th>
                                                    <th>Tot Points</th>
                                                    <th>Tot Cost</th>
                                                    <th>Tot Purchase Price</th>
                                                    <th>Total</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>asdf</td>
                                                    <td>asdf</td>
                                                    <td>asdf</td>
                                                    <td>asdf</td>
                                                    <td>asdf</td>
                                                    <td>asdf</td>
                                                    <td>asdf</td>
                                                    <td>asdf</td>
                                                    <td>asdf</td>
                                                    <td>asdf</td>
                                                    <td>asdf</td>
                                                    <td>
                                                        <button type="submit" class="btn btn-flat btn-primary"> Edit </button>
                                                        <button type="submit" class="btn btn-flat btn-primary">Delete </button>

                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                        </div>
                                    </div>

                                    </div>
                                </div>

                                <div class="col-md-12 module_ac_long">
                                    <div class="row">
                                        <div class="col-md-12 module_header">
                                            <div class="onoffswitch grid-onoffswitch switch">
                                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize"> <label class="onoffswitch-label" for="onoff-customize"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span></label>
                                            </div>
                                            <h6>New Notes</h6>
                                        </div>

                                        <div class="col-md-12">  <br>
                                            <textarea class="form-controls"> </textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <br>
                                            <div class="form-group right">
                                                <button type="submit" class="btn btn-flat btn-primary">Cancel</button>
                                                <button type="submit" class="btn btn-flat btn-primary">Delete </button>
                                                <button type="submit" class="btn btn-flat btn-primary">Save</button>
                                                <!-- <a href="<?php echo url('customer') ?>" class="btn btn-danger">Cancel this</a>-->
                                            </div>

                                        </div>
                                        <br>
                                    </div>
                                </div>

                                </div>

                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>

            <style>

            </style>
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

            <!-- Modal Service Address -->
            <div class="modal fade" id="modalServiceGroup" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Group</h5>
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
            <div class="modal fade" id="modalAddNewCustomerTypes" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Customer Type</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="frm_add_new_customer_types" name="modal-form" method="post">
                                <div class="validation-error" style="display: none;"></div>
                                <div class="form-group">
                                    <label>Type</label> <span class="form-required">*</span>
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
            <div class="modal fade" id="modalAddNewGroup" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <b class="modal-title" id="exampleModalLabel">Add New Group</b>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="padding:30px 30px 10px 30px;">
                            <form id="frm_add_new_group" name="modal-form" method="post">
                                <div class="validation-error" style="display: none;"></div>
                                <div class="form-group">
                                    <label>Group Name</label> <span class="form-required">*</span>
                                    <input type="text" name="title" value="" class="form-control" required
                                           autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Description</label> <span class="form-required">*</span>
                                    <textarea class="form-control" required name="description" autocomplete="off"></textarea>
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

    $(document).ready(function() {
        $("input[name=birthday]").keydown(function(event) {
            // Allow only backspace and delete
            if ( event.keyCode == 46 || event.keyCode == 8 ) {
                // let it happen, don't do anything
            }
            else {
                // Ensure that it is a number and stop the keypress
                if (event.keyCode < 48 || event.keyCode > 57 ) {
                    event.preventDefault();
                }
            }
        });

        $("input[name=birthday]").keyup(function(event){
            console.log($(this).val());
            if ($(this).val().length == 2){
                $(this).val($(this).val() + "/");
            }else if ($(this).val().length == 5){
                $(this).val($(this).val() + "/");
            }
        });
    });
</script>
<style>
    .select2-container--open{       z-index: 0;}
    span.select2-selection.select2-selection--single {
        font-size: 16px;
    }
</style>