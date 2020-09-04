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
        flex-flow: wrap;
        flex: 0 0 41.666667%;
        max-width: 32%;
        height: 100%;
    }
    .module_header{
        /** background-color: #5f0a87;
      background-image: linear-gradient(326deg, #862987 0%, #5f0a87 74%); */
        background-color: #32243d;
        color : #fff;
        text-align: center;
        font-size: 15px;
        font-weight: bold;
        max-height: 30px;
        max-width: 100%;
        margin-bottom: 10px;
    }
    .module_title{
        padding-top: 3px;
    }

    .required{
        color : red!important;
    }

    .form-control {
        font-size: 11px !important;
        height: 28px !important;
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
    .form-line{
        padding-bottom: 4px;
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
                                <!--<li class="breadcrumb-item active">Add your new customer.</li>-->
                                <?php if (!isset($profile_info)){ ?>
                                    <li class="breadcrumb-item active">* Fill up Profile form in order to open up other modules *</li>
                                <?php }else{
                                    ?>
                                    <li class="breadcrumb-item active">* Update customer info per module. *</li>
                                    <?php
                                } ?>
                            </ol>
                        </div>
                        <div class="col-sm-12">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                    <?php //if (hasPermissions('WORKORDER_MASTER')) : ?>
                                    <a href="<?php echo base_url('customer') ?>" class="btn btn-primary" aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> Go Back to Customer
                                    </a>
                                    <?php //endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <?php //echo form_open_multipart('customer/save', ['class' => 'form-validate require-validation', 'id' => 'customer_form', 'autocomplete' => 'off']); ?>

                <div class="row" >
                    <div class="col-md-12">
                        <div class="cards">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <!--<div class="banking-tab-container">
                                            <div class="rb-01">
                                                <ul class="nav nav-tabs border-0">
                                                    <li class="nav-item">
                                                        <a class="h6 mb-0 nav-link banking-sub-tab active" data-toggle="tab" href="#profile">Profile</a>
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
                                                    <?php //endif; ?>
                                                </ul>
                                            </div>
                                        </div>-->
                                        <!--<div class="tab-content mt-4" >
                                            <?php
//                                            include viewPath('customer/adv_module_sheets/sheet_profile');
//                                            include viewPath('customer/adv_module_sheets/sheet_account');
//                                            include viewPath('customer/adv_module_sheets/sheet_address');
//                                            include viewPath('customer/adv_module_sheets/sheet_billing');
//                                            include viewPath('customer/adv_module_sheets/sheet_alarm');
//                                            include viewPath('customer/adv_module_sheets/sheet_office');
//                                            include viewPath('customer/adv_module_sheets/sheet_admin');
//                                            include viewPath('customer/adv_module_sheets/sheet_tech');
//                                            include viewPath('customer/adv_module_sheets/sheet_access');
                                            //include viewPath('customer/adv_module_sheets/sheet_cust');
                                            ?>
                                        </div>-->
                                    </div>
                                    <div class="row">
                                        <div class="module_ac">
                                            <div class="row">
                                            <div class="col-md-12 module_header">
                                                <p class="module_title">Profile Module</p>
                                            </div>
                                            <div class="col-sm-12" id="profile_module">
                                                <div class="col-sm-12 text-right-sm" style="align:right;">
                                                    <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                                                    <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                                                        <input type="checkbox" name="office_switch" class="onoffswitch-checkbox" data-customize="open" id="onoff-prof">
                                                        <label class="onoffswitch-label" for="onoff-prof">
                                                            <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Sales Area <span class="required"> *</span></label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="fk_sa_id" name="fk_sa_id" data-customer-source="dropdown" class="form-control searchable-dropdown" required>
                                                                <?php foreach ($sales_area as $sa): ?>
                                                                    <option value="<?= $sa->sa_id; ?>"><?= $sa->sa_name; ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Name Prefix</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="prefix" name="prefix" data-customer-source="dropdown" class="form-control searchable-dropdown">
                                                                <option value=""></option>
                                                                <option value="Captain">Captain</option>
                                                                <option value="Cnl.">Cnl.</option>
                                                                <option value="Colonel">Colonel</option>
                                                                <option value="Dr.">Dr.</option>
                                                                <option value="Gen.">Gen.</option>
                                                                <option value="Judge">Judge</option>
                                                                <option value="Lady">Lady</option>
                                                                <option value="Lieutenant">Lieutenant</option>
                                                                <option value="Lord">Lord</option>
                                                                <option value="Lt.">Lt.</option>
                                                                <option value="Madam">Madam</option>
                                                                <option value="Maj.">Maj.</option>
                                                                <option value="Major">Major</option>
                                                                <option value="Master">Master</option>
                                                                <option value="Miss">Miss</option>
                                                                <option value="Mister">Mister</option>
                                                                <option value="Mr.">Mr.</option>
                                                                <option value="Mrs.">Mrs.</option>
                                                                <option value="Ms.">Ms.</option>
                                                                <option value="Pastor">Pastor</option>
                                                                <option value="Private">Private</option>
                                                                <option value="Prof.">Prof.</option>
                                                                <option value="Pvt.">Pvt.</option>
                                                                <option value="Rev.">Rev.</option>
                                                                <option value="Sergeant">Sergeant</option>
                                                                <option value="Sgt">Sgt</option>
                                                                <option value="Sir">Sir</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">First Name</label> <span class="required"> *</span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="first_name" id="first_name" value="<?php if(isset($profile_info->first_name)){ echo $profile_info->first_name; } ?>" required/>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Middle Initial</label>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="text" class="form-control" maxlength="2" name="middle_name" id="middle_name" value="<?php if(isset($profile_info)){ echo $profile_info->middle_name; } ?>" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Last Name</label> <span class="required"> *</span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="last_name" id="last_name" value="<?php if(isset($profile_info)){ echo $profile_info->last_name; } ?>" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Date Of Birth </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control date_of_birth" id="date_of_birth" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Suffix</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="suffix" name="suffix" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                                                                <option value="">Select</option>
                                                                <option value="DS">DS</option>
                                                                <option value="Esq.">Esq.</option>
                                                                <option value="II">II</option>
                                                                <option value="III">III</option>
                                                                <option value="IV">IV</option>
                                                                <option value="Jr.">Jr.</option>
                                                                <option value="MA">MA</option>
                                                                <option value="MBA">MBA</option>
                                                                <option value="MD">MD</option>
                                                                <option value="MS">MS</option>
                                                                <option value="PhD">PhD</option>
                                                                <option value="RN">RN</option>
                                                                <option value="Sr.">Sr.</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Business Name</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="business_name" id="business_name" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Email</label> <span class="required"> *</span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="email" class="form-control" name="email" id="email" value="<?php if(isset($profile_info)){ echo $profile_info->email; } ?>" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Social Security Number</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="ssn" id="ssn" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Phone (H)</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="phone_h" id="phone_h" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Phone (W)</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="phone_w" id="phone_w" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Phone (M)</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="phone_m" id="phone_m" value="<?php if(isset($profile_info->phone_m)){ echo $profile_info->phone_m; } ?>"  />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Fax</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="fax" id="fax" value="<?php if(isset($profile_info->fax)){ echo $profile_info->fax; } ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Mailing Address</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="mail_add" id="mail_add" value="<?php if(isset($profile_info->mail_add)){ echo $profile_info->mail_add; } ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">City</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="city" id="city" value="<?php if(isset($profile_info->city)){ echo $profile_info->city; } ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">State</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="state" id="state" value="<?php if(isset($profile_info->state)){ echo $profile_info->state; } ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Country</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="country" id="country" value="<?php if(isset($profile_info->country)){ echo $profile_info->country; } ?> " />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Zip Code</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="zip_code" id="zip_code" value="<?php if(isset($profile_info->zip_code)){ echo $profile_info->zip_code; } ?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Cross Street</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="cross_street" id="cross_street" value="<?php if(isset($profile_info->cross_street)){ echo $profile_info->cross_street; } ?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Subdivision</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="subdivision" id="subdivision" value="<?php if(isset($profile_info->subdivision)){ echo $profile_info->subdivision; } ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Image/Logo File</label><br/>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="img_path" id="img_path" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br><br>

                                        </div>
                                    </div>
                                        <div class=" module_ac">
                                            <div class="row">
                                            <div class="col-md-12 module_header">
                                                <p class="module_title">Billing Information</p>
                                            </div>
                                            <div class="col-sm-12" id="billing_module">
                                                <div class="col-sm-12 text-right-sm" style="align:right;">
                                                    <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                                                    <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                                                        <input type="checkbox" name="billing_switch" class="onoffswitch-checkbox" data-customize="open" id="onoff-bill">
                                                        <label class="onoffswitch-label" for="onoff-bill">
                                                            <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Card Holder First Name</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="card_fname" id="card_fname" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Card Holder Last Name</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="card_lname" id="card_lname" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Card Holder Address </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="card_address" id="card_address" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">City State ZIP</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control" name="city" id="city" />
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control" name="state" id="state" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="text" class="form-control" name="zip" id="zip" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Monthly Monitoring Rate* $</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="mmr" name="mmr" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                                                                <option value="0.00">0.00</option>
                                                                <option value="20.00">20.00</option>
                                                                <option value="24.99">24.99</option>
                                                                <option value="25.00">25.00</option>
                                                                <option value="26.99">26.99</option>
                                                                <option value="27.99">27.99</option>
                                                                <option value="29.99">29.99</option>
                                                                <option value="31.00">31.00</option>
                                                                <option value="31.99">31.99</option>
                                                                <option value="32.99">32.99</option>
                                                                <option value="34.99">34.99</option>
                                                                <option value="35.00">35.00</option>
                                                                <option value="35.99">35.99</option>
                                                                <option value="36.99">36.99</option>
                                                                <option value="37.99">37.99</option>
                                                                <option value="38.99">38.99</option>
                                                                <option value="39.99">39.99</option>
                                                                <option value="40.99">40.99</option>
                                                                <option value="41.15">41.15</option>
                                                                <option value="41.99">41.99</option>
                                                                <option value="42.99">42.99</option>
                                                                <option value="43.99">43.99</option>
                                                                <option value="44.95">44.95</option>
                                                                <option value="44.99">44.99</option>
                                                                <option value="45.99">45.99</option>
                                                                <option value="46.99">46.99</option>
                                                                <option value="47.95">47.95</option>
                                                                <option value="47.99">47.99</option>
                                                                <option value="48.99">48.99</option>
                                                                <option value="49.95">49.95</option>
                                                                <option value="49.99">49.99</option>
                                                                <option value="50.99">50.99</option>
                                                                <option value="51.95">51.95</option>
                                                                <option value="51.99">51.99</option>
                                                                <option value="52.99">52.99</option>
                                                                <option value="53.95">53.95</option>
                                                                <option value="53.99">53.99</option>
                                                                <option value="54.49">54.49</option>
                                                                <option value="54.99">54.99</option>
                                                                <option value="55.99">55.99</option>
                                                                <option value="56.99">56.99</option>
                                                                <option value="57.99">57.99</option>
                                                                <option value="58.99">58.99</option>
                                                                <option value="59.99">59.99</option>
                                                                <option value="60.99">60.99</option>
                                                                <option value="61.99">61.99</option>
                                                                <option value="62.99">62.99</option>
                                                                <option value="63.99">63.99</option>
                                                                <option value="64.99">64.99</option>
                                                                <option value="65.99">65.99</option>
                                                                <option value="67.99">67.99</option>
                                                                <option value="69.99">69.99</option>
                                                                <option value="70.99">70.99</option>
                                                                <option value="71.99">71.99</option>
                                                                <option value="72.98">72.98</option>
                                                                <option value="73.99">73.99</option>
                                                                <option value="74.99">74.99</option>
                                                                <option value="75.99">75.99</option>
                                                                <option value="77.99">77.99</option>
                                                                <option value="85.99">85.99</option>
                                                                <option value="89.99">89.99</option>
                                                                <option value="95.00">95.00</option>
                                                                <option value="97.85">97.85</option>
                                                                <option value="129.00">129.00</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Billing Frequency</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="bill_freq" name="bill_freq" data-customer-source="dropdown" class="form-control searchable-dropdown">
                                                                <option value="">- Select -</option>
                                                                <option value="One Time Only">One Time Only</option>
                                                                <option value="Every 1 Month">Every 1 Month</option>
                                                                <option value="Every 3 Months">Every 3 Months</option>
                                                                <option value="Every 6 Months">Every 6 Months</option>
                                                                <option value="Every 1 Year">Every 1 Year</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Billing Day of Month</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="bill_day" name="bill_day" data-customer-source="dropdown" class="form-control searchable-dropdown">
                                                                <option value="0"></option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                                <option value="12">12</option>
                                                                <option value="13">13</option>
                                                                <option value="14">14</option>
                                                                <option value="15">15</option>
                                                                <option value="16">16</option>
                                                                <option value="17">17</option>
                                                                <option value="18">18</option>
                                                                <option value="19">19</option>
                                                                <option value="20">20</option>
                                                                <option value="21">21</option>
                                                                <option value="22">22</option>
                                                                <option value="23">23</option>
                                                                <option value="24">24</option>
                                                                <option value="25">25</option>
                                                                <option value="26">26</option>
                                                                <option value="27">27</option>
                                                                <option value="28">28</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Contract Term* (months)</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="contract_term" name="contract_term" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                                                                <option value="0"></option>
                                                                <option value="36">36</option>
                                                                <option value="60">60</option>
                                                                <option value="12">12</option>
                                                                <option value="24">24</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Billing Method</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="bill_method" name="bill_method" data-customer-source="dropdown" class="form-control searchable-dropdown">
                                                                <option  value="0">None</option>
                                                                <option value="1">Credit Card</option>
                                                                <option value="2">Check</option>
                                                                <option value="3">eCheck</option>
                                                                <option value="4">Manual Billing</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Billing Start Date</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control date_picker" name="bill_start_date" id="bill_start_date" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Billing End Date</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control date_picker" name="bill_end_date" id="bill_end_date" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Check Number</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="check_num" id="check_num" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Routing Number</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="routing_num" id="routing_num" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Account Number</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="acct_num" id="acct_num" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Credit Card Number</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="credit_card_num" id="credit_card_num" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Credit Card Expiration</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control" name="credit_card_exp" id="credit_card_exp" required/>
                                                                </div>/
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control" name="credit_card_exp_mm_yyyy" id="credit_card_exp_mm_yyyy" required/>
                                                                </div> <small>(MM/YYYY)</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Collections Date</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control date_picker" name="collect_date" id="collect_date" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Collections Amount $</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="collect_amt" id="collect_amt" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Contract Extension Date</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control date_picker" name="contract_ext_date" id="contract_ext_date" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Social Security Number</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="ssn" id="ssn" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <div class=" module_ac">
                                        <div class="row">
                                            <div class="col-md-12 module_header">
                                                <p class="module_title">Account Information</p>
                                            </div>
                                            <div class="col-sm-12" id="account_module">
                                                <div class="col-sm-12 text-right-sm" style="align:right;">
                                                    <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                                                    <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                                                        <input type="checkbox" name="office_switch" class="onoffswitch-checkbox" data-customize="open" id="onoff-acct">
                                                        <label class="onoffswitch-label" for="onoff-acct">
                                                            <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Entered By</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="entered_by" id="entered_by" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Time Entered</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="time_entered" id="time_entered" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Sales Date</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control date_picker" name="sales_date" id="sales_date" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Credit Score </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="credit_score" id="credit_score" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Monitoring Company </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="mon_comp" name="mon_comp" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                                                                <option value=""></option>
                                                                <option value="1">Brinks Home Security</option>
                                                                <option value="0">CCTV ONLY</option>
                                                                <option value="1101">CMS</option>
                                                                <option selected="selected" value="1102">Other</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Account Type </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="acct_type" name="acct_type" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                                                                <option value="">Select</option>
                                                                <option value="In-House">In-House</option>
                                                                <option value="Purchase">Purchase</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Monitoring ID</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="mon_id" id="mon_id" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Language</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="language" name="language" data-customer-source="dropdown" class="form-control searchable-dropdown">
                                                                <option value="">Select</option>
                                                                <option value="English">English</option>
                                                                <option value="Spanish">Spanish</option>
                                                                <option value="Mandarin Chinese">Mandarin Chinese</option>
                                                                <option value="French">French</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Signal Confirmation #</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="signal_confirm_num" id="signal_confirm_num" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Monitoring Confirmation </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="mon_confirmation" id="mon_confirmation" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Abort Code</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="abort_code" id="abort_code" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Sales Rep</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="sales_rep" name="sales_rep" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                                                                <option value="">Select</option>
                                                                <?php foreach ($sales_area as $sa): ?>
                                                                    <option value="<?= $sa->sa_id; ?>"><?= $sa->sa_name; ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Technician</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="technician" name="technician" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                                                                <option value="">- Select -</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Save Date</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control date_picker" name="save_date" id="save_date" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Save By</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="save_by" name="save_by" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                                                                <option value="">- Select -</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Cancellation Date</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control date_picker" name="cancel_date" id="cancel_date" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Cancellation Reason</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="cancel_reason" name="cancel_reason" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                                                                <option value="">Select</option>
                                                                <option value="Dissatisfied with Service">Dissatisfied with Service</option>
                                                                <option value="Financial Hardship">Financial Hardship</option>
                                                                <option value="Fulfilled Contract">Fulfilled Contract</option>
                                                                <option value="Moving">Moving</option>
                                                                <option value="Non-Payment">Non-Payment</option>
                                                                <option value="Paid BOC">Paid BOC</option>
                                                                <option value="Passed Away">Passed Away</option>
                                                                <option value="Still Under Contruct">Still Under Contruct</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <label for="sched_conflict"><span>Check for Schedule Conflict</span></label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="checkbox" name="sched_conflict" value="Email" checked id="sched_conflict">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Install Date</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control date_picker" name="install_date" id="install_date" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Tech Arrival Time</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="tech_arrive_time" name="tech_arrive_time" data-customer-source="dropdown" class="form-control searchable-dropdown">
                                                                <option value=""></option>
                                                                <option value="7AM">7:00 AM</option>
                                                                <option value="7.5AM">7:30 AM</option>
                                                                <option selected="selected" value="8AM">8:00 AM</option>
                                                                <option value="8.5AM">8:30 AM</option>
                                                                <option value="9AM">9:00 AM</option>
                                                                <option value="9.5AM">9:30 AM</option>
                                                                <option value="10AM">10:00 AM</option>
                                                                <option value="10.5AM" disabled="disabled">10:30 AM</option>
                                                                <option value="11AM" disabled="disabled">11:00 AM</option>
                                                                <option value="11.5AM" disabled="disabled">11:30 AM</option>
                                                                <option value="12PM" disabled="disabled">12:00 PM</option>
                                                                <option value="12.5PM" disabled="disabled">12:30 PM</option>
                                                                <option value="1PM" disabled="disabled">1:00 PM</option>
                                                                <option value="1.5PM" disabled="disabled">1:30 PM</option>
                                                                <option value="2PM" disabled="disabled">2:00 PM</option>
                                                                <option value="2.5PM" disabled="disabled">2:30 PM</option>
                                                                <option value="3PM" disabled="disabled">3:00 PM</option>
                                                                <option value="3.5PM" disabled="disabled">3:30 PM</option>
                                                                <option value="4PM" disabled="disabled">4:00 PM</option>
                                                                <option value="4.5PM" disabled="disabled">4:30 PM</option>
                                                                <option value="5PM" disabled="disabled">5:00 PM</option>
                                                                <option value="5.5PM" disabled="disabled">5:30 PM</option>
                                                                <option value="6PM" disabled="disabled">6:00 PM</option>
                                                                <option value="6.5PM" disabled="disabled">6:30 PM</option>
                                                                <option value="7PM" disabled="disabled">7:00 PM</option>
                                                                <option value="7.5PM" disabled="disabled">7:30 PM</option>
                                                                <option value="8PM" disabled="disabled">8:00 PM</option>
                                                                <option value="8.5PM" disabled="disabled">8:30 PM</option>
                                                                <option value="9PM" disabled="disabled">9:00 PM</option>
                                                                <option value="9.5PM" disabled="disabled">9:30 PM</option>
                                                                <option value="10PM" disabled="disabled">10:00 PM</option>
                                                                <option value="10.5PM" disabled="disabled">10:30 PM</option>
                                                                <option value="11PM" disabled="disabled">11:00 PM</option>
                                                                <option value="11.5PM" disabled="disabled">11:30 PM</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Tech Departure Time</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="tech_depart_time" name="tech_depart_time" data-customer-source="dropdown" class="form-control searchable-dropdown">
                                                                <option value=""></option>
                                                                <option value="7AM">7:00 AM</option>
                                                                <option value="7.5AM">7:30 AM</option>
                                                                <option selected="selected" value="8AM">8:00 AM</option>
                                                                <option value="8.5AM">8:30 AM</option>
                                                                <option value="9AM">9:00 AM</option>
                                                                <option value="9.5AM">9:30 AM</option>
                                                                <option value="10AM">10:00 AM</option>
                                                                <option value="10.5AM" disabled="disabled">10:30 AM</option>
                                                                <option value="11AM" disabled="disabled">11:00 AM</option>
                                                                <option value="11.5AM" disabled="disabled">11:30 AM</option>
                                                                <option value="12PM" disabled="disabled">12:00 PM</option>
                                                                <option value="12.5PM" disabled="disabled">12:30 PM</option>
                                                                <option value="1PM" disabled="disabled">1:00 PM</option>
                                                                <option value="1.5PM" disabled="disabled">1:30 PM</option>
                                                                <option value="2PM" disabled="disabled">2:00 PM</option>
                                                                <option value="2.5PM" disabled="disabled">2:30 PM</option>
                                                                <option value="3PM" disabled="disabled">3:00 PM</option>
                                                                <option value="3.5PM" disabled="disabled">3:30 PM</option>
                                                                <option value="4PM" disabled="disabled">4:00 PM</option>
                                                                <option value="4.5PM" disabled="disabled">4:30 PM</option>
                                                                <option value="5PM" disabled="disabled">5:00 PM</option>
                                                                <option value="5.5PM" disabled="disabled">5:30 PM</option>
                                                                <option value="6PM" disabled="disabled">6:00 PM</option>
                                                                <option value="6.5PM" disabled="disabled">6:30 PM</option>
                                                                <option value="7PM" disabled="disabled">7:00 PM</option>
                                                                <option value="7.5PM" disabled="disabled">7:30 PM</option>
                                                                <option value="8PM" disabled="disabled">8:00 PM</option>
                                                                <option value="8.5PM" disabled="disabled">8:30 PM</option>
                                                                <option value="9PM" disabled="disabled">9:00 PM</option>
                                                                <option value="9.5PM" disabled="disabled">9:30 PM</option>
                                                                <option value="10PM" disabled="disabled">10:00 PM</option>
                                                                <option value="10.5PM" disabled="disabled">10:30 PM</option>
                                                                <option value="11PM" disabled="disabled">11:00 PM</option>
                                                                <option value="11.5PM" disabled="disabled">11:30 PM</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Panel Type </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="panel_type" name="panel_type" data-customer-source="dropdown" class="form-control searchable-dropdown">
                                                                <option value=""></option>
                                                                <option selected="selected" value="DIGI">Landline</option>
                                                                <option value="DW2W">Landline W/ 2-Way</option>
                                                                <option value="DWCB">Landline W/ Cell Backup</option>
                                                                <option value="D2CB">Landline W/ 2-Way &amp; Cell Backup</option>
                                                                <option value="CPDB">Cell Primary</option>
                                                                <option value="CP2W">Cell Primary w/2Way</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Pre-Install Survey</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="pre_install_survey" name="pre_install_survey" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                                                                <option value=""></option>
                                                                <option value="Pass">Pass</option>
                                                                <option value="Fail">Fail</option>
                                                                <option value="Pending">Pending</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Post-Install Survey</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="post_install_survey" name="post_install_survey" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                                                                <option value="">Select</option>
                                                                <option value="Pass">Pass</option>
                                                                <option value="Fail">Fail</option>
                                                                <option value="Pending">Pending</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Monitoring Waived</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="mon_waived" name="mon_waived" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                                                                <option selected="selected" value="0"></option>
                                                                <option value="1">1 Month</option>
                                                                <option value="2">2 Months</option>
                                                                <option value="3">3 Months</option>
                                                                <option value="4">4 Month</option>
                                                                <option value="5">5 Months</option>
                                                                <option value="6">6 Months</option>
                                                                <option value="7">7 Month</option>
                                                                <option value="8">8 Months</option>
                                                                <option value="9">9 Months</option>
                                                                <option value="10">10 Month</option>
                                                                <option value="11">11 Months</option>
                                                                <option value="12">12 Months</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="rebate_offer"><span>Rebate Offered</span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="checkbox" name="rebate_offer" value="1" id="rebate_offer">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="">Rebate Check # 1</label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" name="rebate_check1" id="rebate_check1" />
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label for="">Amount $</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="number" class="form-control" name="amount1" id="amount1" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="">Rebate Check # 2</label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" name="rebate_check2" id="rebate_check2" />
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label for="">Amount $</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="number" class="form-control" name="amount2" id="amount2" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Activation Fee</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="activation_fee" name="activation_fee" data-customer-source="dropdown" class="form-control searchable-dropdown">
                                                                <option selected="selected" value="0.000000">0.0000</option>
                                                                <option value="0.0000">0.00</option>
                                                                <option value="49.0000">49.00</option>
                                                                <option value="49.9500">49.95</option>
                                                                <option value="49.9900">49.99</option>
                                                                <option value="69.0000">69.00</option>
                                                                <option value="75.0000">75.00</option>
                                                                <option value="88.0000">88.00</option>
                                                                <option value="90.0000">90.00</option>
                                                                <option value="99.0000">99.00</option>
                                                                <option value="99.9900">99.99</option>
                                                                <option value="100.0000">100.00</option>
                                                                <option value="140.9900">140.99</option>
                                                                <option value="149.0000">149.00</option>
                                                                <option value="150.0000">150.00</option>
                                                                <option value="180.0000">180.00</option>
                                                                <option value="199.0000">199.00</option>
                                                                <option value="249.0000">249.00</option>
                                                                <option value="291.0000">291.00</option>
                                                                <option value="299.0000">299.00</option>
                                                                <option value="329.0000">329.00</option>
                                                                <option value="349.0000">349.00</option>
                                                                <option value="349.0100">349.01</option>
                                                                <option value="351.0100">351.01</option>
                                                                <option value="369.0000">369.00</option>
                                                                <option value="379.0000">379.00</option>
                                                                <option value="399.0000">399.00</option>
                                                                <option value="424.0000">424.00</option>
                                                                <option value="449.0000">449.00</option>
                                                                <option value="450.0000">450.00</option>
                                                                <option value="463.0000">463.00</option>
                                                                <option value="499.0000">499.00</option>
                                                                <option value="599.0000">599.00</option>
                                                                <option value="647.9900">647.99</option>
                                                                <option value="699.0000">699.00</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="radio" name="way_of_pay[]" value="Email"  id="way_of_pay_none">
                                                            <label for="way_of_pay_none"><span>None</span></label>

                                                            <input type="radio" name="way_of_pay[]" value="Check"  id="way_of_pay_check">
                                                            <label for="way_of_pay_check"><span>Check</span></label>

                                                            <input type="radio" name="way_of_pay[]" value="Credit"  id="way_of_pay_credit">
                                                            <label for="way_of_pay_credit"><span>Credit</span></label>

                                                            <input type="radio" name="way_of_pay[]" value="Paid" id="way_of_pay_paid">
                                                            <label for="way_of_pay_paid"><span>Paid</span></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Lead Source</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="lead_source" name="lead_source" data-customer-source="dropdown" class="form-control searchable-dropdown">
                                                                <option value="">Select</option>
                                                                <option value="Customer Referral">Customer Referral</option>
                                                                <option value="Door">Door</option>
                                                                <option value="Door Hanger">Door Hanger</option>
                                                                <option value="Flyer Mail Outs">Flyer Mail Outs</option>
                                                                <option value="Outbound Calls">Outbound Calls</option>
                                                                <option value="Phone">Phone</option>
                                                                <option value="Radio Ad">Radio Ad</option>
                                                                <option value="Social Media">Social Media</option>
                                                                <option value="TV Ad">TV Ad</option>
                                                                <option value="Unknown">Unknown</option>
                                                                <option value="Website">Website</option>
                                                                <option value="Yard Sign">Yard Sign</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                        <div class=" module_ac">
                                            <div class="row">
                                                <div class="col-md-12 module_header">
                                                    <p class="module_title">Address Information</p>
                                                </div>
                                                <div class="col-sm-12" id="address_module">
                                                    <div class="col-sm-12 text-right-sm" style="align:right;">
                                                        <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                                                        <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                                                            <input type="checkbox" name="address_switch" class="onoffswitch-checkbox" data-customize="open" id="onoff-add">
                                                            <label class="onoffswitch-label" for="onoff-add">
                                                                <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Sales Area</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="fk_sa_id" name="fk_sa_id" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                                                                <?php foreach ($sales_area as $sa): ?>
                                                                    <option value="<?= $sa->sa_id; ?>"><?= $sa->sa_name; ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Company</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="company" id="company" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Address </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="address" id="address" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Cross Street</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="cross_street" id="cross_street" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Subdivision</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="subdivision" id="subdivision" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">City State ZIP</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control" name="city" id="city" />
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control" name="state" id="state" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="text" class="form-control" name="zip" id="zip" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Country</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="country" name="country" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                                                                <option value="USA">USA</option>
                                                                <option value="Canada">Canada</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Home/Panel Phone </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="phone_home" id="phone_home" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Cell Phone </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="phone_cell" id="phone_cell" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Alternate Phone </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="phone_alternate" id="phone_alternate" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <br><br>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Contact First Name</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="contact1_lastname" id="contact1_lastname" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Contact Last Name</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="contact1_lastname" id="contact1_lastname" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Contact Phone </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <input type="number" class="form-control" name="contact1_phone" id="contact1_phone" />
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <select id="contact1_phone_type" name="contact1_phone_type" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                        <option value="">Select</option>
                                                                        <option value="Cell">Cell</option>
                                                                        <option value="Fax">Fax</option>
                                                                        <option value="Home">Home</option>
                                                                        <option value="Pager">Pager</option>
                                                                        <option value="Work">Work</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Contact Relationship</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="contact1_relationship" name="contact1_relationship" data-customer-source="dropdown" class="form-control searchable-dropdown">
                                                                <option value="">- Select -</option>
                                                                <option value="DLR">Dealer</option>
                                                                <option value="EMP">Employee</option>
                                                                <option value="FRND">Friend</option>
                                                                <option value="JAN">Janitorial</option>
                                                                <option value="MNT">Maintenance</option>
                                                                <option value="MGR">Manager</option>
                                                                <option value="NGH">Neighbor</option>
                                                                <option value="SEC">On Site</option>
                                                                <option selected="selected" value="OWN">Owner</option>
                                                                <option value="REL">Relative</option>
                                                                <option value="RES">Resident</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <br><br>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Contact First Name</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="contact2_firstname" id="contact2_firstname" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Contact Last Name</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="contact2_lastname" id="contact2_lastname" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Contact Phone </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <input type="number" class="form-control" name="contact2_phone" id="contact2_phone" />
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <select id="contact2_phone_type" name="contact2_phone_type" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                                                                        <option value="">Select</option>
                                                                        <option value="Cell">Cell</option>
                                                                        <option value="Fax">Fax</option>
                                                                        <option value="Home">Home</option>
                                                                        <option value="Pager">Pager</option>
                                                                        <option value="Work">Work</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Contact Relationship</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="contact2_relationship" name="contact2_relationship" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                                                                <option value="">- Select -</option>
                                                                <option value="DLR">Dealer</option>
                                                                <option value="EMP">Employee</option>
                                                                <option value="FRND">Friend</option>
                                                                <option value="JAN">Janitorial</option>
                                                                <option value="MNT">Maintenance</option>
                                                                <option value="MGR">Manager</option>
                                                                <option value="NGH">Neighbor</option>
                                                                <option value="SEC">On Site</option>
                                                                <option selected="selected" value="OWN">Owner</option>
                                                                <option value="REL">Relative</option>
                                                                <option value="RES">Resident</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" module_ac">
                                            <div class="row">
                                                <div class="col-md-12 module_header">
                                                    <p class="module_title">Alarm Information</p>
                                                </div>
                                                <div class="col-sm-12" id="address_module">
                                                    <div class="col-sm-12 text-right-sm" style="align:right;">
                                                        <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                                                        <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                                                            <input type="checkbox" name="alarm_switch" class="onoffswitch-checkbox" data-customize="open" id="onoff-alarm">
                                                            <label class="onoffswitch-label" for="onoff-alarm">
                                                                <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Monitoring Company</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="monitor_comp" id="monitor_comp" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Monitoring ID</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="monitor_id" id="monitor_id" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Install Date</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control date_picker" name="install_date" id="install_date" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Credit Score</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="credit_score" id="credit_score" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Account Type</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select name="acct_type" id="acct_type" class="form-control">
                                                                <option value=""></option>
                                                                <option selected="selected" value="In-House">In-House</option>
                                                                <option value="Purchase">Purchase</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Account Information</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="acct_info" id="acct_info" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Abort/Password Code</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="passcode" id="passcode" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Installer Code</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="install_code" id="install_code" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Monitoring Confirmation #</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="mcn" id="mcn" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Signal Confirmation #</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="scn" id="scn" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Contact Name #1</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="contact1" id="contact1" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Contact Name #2</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="contact2" id="contact2" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Contact Name #3</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="contact3" id="contact3" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Contact Name #4</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="contact4" id="contact4" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Contact Name #5</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="contact5" id="contact5" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Panel Type</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select name="panel_type" id="panel_type" class="form-control">
                                                                <option value=""></option>
                                                                <option selected="selected" value="DIGI">Landline</option>
                                                                <option value="DW2W">Landline W/ 2-Way</option>
                                                                <option value="DWCB">Landline W/ Cell Backup</option>
                                                                <option value="D2CB">Landline W/ 2-Way &amp; Cell Backup</option>
                                                                <option value="CPDB">Cell Primary</option>
                                                                <option value="CP2W">Cell Primary w/2Way</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">System Type</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="system_type" id="system_type" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Monitoring Waived</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="mon_waived" id="mon_waived" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Rebate Offered:</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="rebate_offer" id="rebate_offer" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Verification:</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="verification" name="verification" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                                                                <option value="TrunsUnion">TrunsUnion</option>
                                                                <option value="Experian">Experian </option>
                                                                <option value="Equifax ">Equifax  </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Rebate Check 1</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="rebate_check1" id="rebate_check1" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Rebate Check 2</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="rebate_check2" id="rebate_check2" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Warranty Type</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="warranty_type" id="warranty_type" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 1</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="custom_field1" id="custom_field1" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                        </div>
                                                        <div class="col-md-8">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" module_ac">
                                            <div class="row">
                                                <div class="col-md-12 module_header">
                                                    <p class="module_title">Office Use Information</p>
                                                </div>
                                                <div class="col-sm-12" id="address_module">
                                                    <div class="col-sm-12 text-right-sm" style="align:right;">
                                                        <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                                                        <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                                                            <input type="checkbox" name="office_switch" class="onoffswitch-checkbox" data-customize="open" id="onoff-office">
                                                            <label class="onoffswitch-label" for="onoff-office">
                                                                <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="welcome_sent"><span>Welcome kit Sent</span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="checkbox" name="welcome_sent" value="1" id="welcome_sent">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="rebate1"><span>Rebate Received</span>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <input type="radio" name="rebate[]" value="1" id="rebate1" checked required>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="rebate"><span>Rebate Paid</span>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <input type="radio" name="rebate[]" value="0"  id="rebate">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <label for="">Commision Scheme Override</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="radio" name="commision_scheme[]" value="1" id="commision_scheme1" checked required>
                                                            <label for="commision_scheme1"><span>On</span></label>

                                                            <input type="radio" name="commision_scheme[]" value="0" id="commision_scheme">
                                                            <label for="commision_scheme"><span>Off</span></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Rep Commission $</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="rep_comm" id="rep_comm" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Rep Upfront Pay</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="rep_upfront_pay" id="rep_upfront_pay" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Tech Commission $</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="tech_comm" id="tech_comm" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="tech_upfront_pay">Tech Upfront Pay $</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="tech_upfront_pay" id="tech_upfront_pay" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Rep Tiered Upfront Bonus</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <i>$0.00</i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Rep Tiered Holdfund Bonus</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <i>$0.00</i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Rep Deductions Total</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <i>$0.00</i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Tech Deductions Total</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <i>$0.00</i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">RepHold Fund Charge Back $</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="rep_charge_back" id="rep_charge_back" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Rep Payroll Charge Back $</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="rep_payroll_charge_back" id="rep_payroll_charge_back" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Points Scheme Override</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="radio" name="pso[]" value="1" id="pso1" checked required>
                                                            <label for="pso1"><span>On</span></label>

                                                            <input type="radio" name="pso[]" value="0" id="pso">
                                                            <label for="pso"><span>Off</span></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Points Included</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="points_include" id="points_include" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Price Per Point $</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="price_per_point" id="price_per_point" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Purchase Price $</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="purchase_price" id="purchase_price" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Purchase Multiple</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="purchase_multiple" id="purchase_multiple" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Purchase Discount $</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="purchase_discount" id="purchase_discount" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" module_ac">
                                            <div class="row">
                                                <div class="col-md-12 module_header">
                                                    <p class="module_title">Admin Information</p>
                                                </div>
                                                <div class="col-sm-12" id="address_module">
                                                    <div class="col-sm-12 text-right-sm" style="align:right;">
                                                        <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                                                        <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                                                            <input type="checkbox" name="admin_switch" class="onoffswitch-checkbox" data-customize="open" id="onoff-admin">
                                                            <label class="onoffswitch-label" for="onoff-admin">
                                                                <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Entered by</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="entered_by" id="entered_by" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Time Entered</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="time_entered" name="time_entered" data-customer-source="dropdown" class="form-control searchable-dropdown">
                                                                <option value=""></option>
                                                                <option value="7AM">7:00 AM</option>
                                                                <option value="7.5AM">7:30 AM</option>
                                                                <option selected="selected" value="8AM">8:00 AM</option>
                                                                <option value="8.5AM">8:30 AM</option>
                                                                <option value="9AM">9:00 AM</option>
                                                                <option value="9.5AM">9:30 AM</option>
                                                                <option value="10AM">10:00 AM</option>
                                                                <option value="10.5AM" disabled="disabled">10:30 AM</option>
                                                                <option value="11AM" disabled="disabled">11:00 AM</option>
                                                                <option value="11.5AM" disabled="disabled">11:30 AM</option>
                                                                <option value="12PM" disabled="disabled">12:00 PM</option>
                                                                <option value="12.5PM" disabled="disabled">12:30 PM</option>
                                                                <option value="1PM" disabled="disabled">1:00 PM</option>
                                                                <option value="1.5PM" disabled="disabled">1:30 PM</option>
                                                                <option value="2PM" disabled="disabled">2:00 PM</option>
                                                                <option value="2.5PM" disabled="disabled">2:30 PM</option>
                                                                <option value="3PM" disabled="disabled">3:00 PM</option>
                                                                <option value="3.5PM" disabled="disabled">3:30 PM</option>
                                                                <option value="4PM" disabled="disabled">4:00 PM</option>
                                                                <option value="4.5PM" disabled="disabled">4:30 PM</option>
                                                                <option value="5PM" disabled="disabled">5:00 PM</option>
                                                                <option value="5.5PM" disabled="disabled">5:30 PM</option>
                                                                <option value="6PM" disabled="disabled">6:00 PM</option>
                                                                <option value="6.5PM" disabled="disabled">6:30 PM</option>
                                                                <option value="7PM" disabled="disabled">7:00 PM</option>
                                                                <option value="7.5PM" disabled="disabled">7:30 PM</option>
                                                                <option value="8PM" disabled="disabled">8:00 PM</option>
                                                                <option value="8.5PM" disabled="disabled">8:30 PM</option>
                                                                <option value="9PM" disabled="disabled">9:00 PM</option>
                                                                <option value="9.5PM" disabled="disabled">9:30 PM</option>
                                                                <option value="10PM" disabled="disabled">10:00 PM</option>
                                                                <option value="10.5PM" disabled="disabled">10:30 PM</option>
                                                                <option value="11PM" disabled="disabled">11:00 PM</option>
                                                                <option value="11.5PM" disabled="disabled">11:30 PM</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Assign To</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="assign_to" id="assign_to" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Pre-install Survey</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="pre_install_survey" id="pre_install_survey" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 1</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="custom_field1" id="custom_field1" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Language</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="language" id="language" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Date Enter</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control date_picker" name="date_enter" id="date_enter" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Sales Rep</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="sales_rep" name="sales_rep" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                                                                <option value="">Select</option>
                                                                <?php foreach ($sales_area as $sa): ?>
                                                                    <option value="<?= $sa->sa_id; ?>"><?= $sa->sa_name; ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Post-install Survey</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="post_install_survey" id="post_install_survey" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 2</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="custom_field2" id="custom_field2" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" module_ac">
                                            <div class="row">
                                                <div class="col-md-12 module_header">
                                                    <p class="module_title">Tech Information</p>
                                                </div>
                                                <div class="col-sm-12" id="address_module">
                                                    <div class="col-sm-12 text-right-sm" style="align:right;">
                                                        <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                                                        <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                                                            <input type="checkbox" name="tech_switch" class="onoffswitch-checkbox" data-customize="open" id="onoff-tech">
                                                            <label class="onoffswitch-label" for="onoff-tech">
                                                                <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Tech Arrive Time</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="tech_arrive_time" name="tech_arrive_time" data-customer-source="dropdown" class="form-control searchable-dropdown">
                                                                <option value=""></option>
                                                                <option value="7AM">7:00 AM</option>
                                                                <option value="7.5AM">7:30 AM</option>
                                                                <option selected="selected" value="8AM">8:00 AM</option>
                                                                <option value="8.5AM">8:30 AM</option>
                                                                <option value="9AM">9:00 AM</option>
                                                                <option value="9.5AM">9:30 AM</option>
                                                                <option value="10AM">10:00 AM</option>
                                                                <option value="10.5AM" disabled="disabled">10:30 AM</option>
                                                                <option value="11AM" disabled="disabled">11:00 AM</option>
                                                                <option value="11.5AM" disabled="disabled">11:30 AM</option>
                                                                <option value="12PM" disabled="disabled">12:00 PM</option>
                                                                <option value="12.5PM" disabled="disabled">12:30 PM</option>
                                                                <option value="1PM" disabled="disabled">1:00 PM</option>
                                                                <option value="1.5PM" disabled="disabled">1:30 PM</option>
                                                                <option value="2PM" disabled="disabled">2:00 PM</option>
                                                                <option value="2.5PM" disabled="disabled">2:30 PM</option>
                                                                <option value="3PM" disabled="disabled">3:00 PM</option>
                                                                <option value="3.5PM" disabled="disabled">3:30 PM</option>
                                                                <option value="4PM" disabled="disabled">4:00 PM</option>
                                                                <option value="4.5PM" disabled="disabled">4:30 PM</option>
                                                                <option value="5PM" disabled="disabled">5:00 PM</option>
                                                                <option value="5.5PM" disabled="disabled">5:30 PM</option>
                                                                <option value="6PM" disabled="disabled">6:00 PM</option>
                                                                <option value="6.5PM" disabled="disabled">6:30 PM</option>
                                                                <option value="7PM" disabled="disabled">7:00 PM</option>
                                                                <option value="7.5PM" disabled="disabled">7:30 PM</option>
                                                                <option value="8PM" disabled="disabled">8:00 PM</option>
                                                                <option value="8.5PM" disabled="disabled">8:30 PM</option>
                                                                <option value="9PM" disabled="disabled">9:00 PM</option>
                                                                <option value="9.5PM" disabled="disabled">9:30 PM</option>
                                                                <option value="10PM" disabled="disabled">10:00 PM</option>
                                                                <option value="10.5PM" disabled="disabled">10:30 PM</option>
                                                                <option value="11PM" disabled="disabled">11:00 PM</option>
                                                                <option value="11.5PM" disabled="disabled">11:30 PM</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Tech Complete Time</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="tech_complete_time" name="tech_complete_time" data-customer-source="dropdown" class="form-control searchable-dropdown">
                                                                <option value=""></option>
                                                                <option value="7AM">7:00 AM</option>
                                                                <option value="7.5AM">7:30 AM</option>
                                                                <option selected="selected" value="8AM">8:00 AM</option>
                                                                <option value="8.5AM">8:30 AM</option>
                                                                <option value="9AM">9:00 AM</option>
                                                                <option value="9.5AM">9:30 AM</option>
                                                                <option value="10AM">10:00 AM</option>
                                                                <option value="10.5AM" disabled="disabled">10:30 AM</option>
                                                                <option value="11AM" disabled="disabled">11:00 AM</option>
                                                                <option value="11.5AM" disabled="disabled">11:30 AM</option>
                                                                <option value="12PM" disabled="disabled">12:00 PM</option>
                                                                <option value="12.5PM" disabled="disabled">12:30 PM</option>
                                                                <option value="1PM" disabled="disabled">1:00 PM</option>
                                                                <option value="1.5PM" disabled="disabled">1:30 PM</option>
                                                                <option value="2PM" disabled="disabled">2:00 PM</option>
                                                                <option value="2.5PM" disabled="disabled">2:30 PM</option>
                                                                <option value="3PM" disabled="disabled">3:00 PM</option>
                                                                <option value="3.5PM" disabled="disabled">3:30 PM</option>
                                                                <option value="4PM" disabled="disabled">4:00 PM</option>
                                                                <option value="4.5PM" disabled="disabled">4:30 PM</option>
                                                                <option value="5PM" disabled="disabled">5:00 PM</option>
                                                                <option value="5.5PM" disabled="disabled">5:30 PM</option>
                                                                <option value="6PM" disabled="disabled">6:00 PM</option>
                                                                <option value="6.5PM" disabled="disabled">6:30 PM</option>
                                                                <option value="7PM" disabled="disabled">7:00 PM</option>
                                                                <option value="7.5PM" disabled="disabled">7:30 PM</option>
                                                                <option value="8PM" disabled="disabled">8:00 PM</option>
                                                                <option value="8.5PM" disabled="disabled">8:30 PM</option>
                                                                <option value="9PM" disabled="disabled">9:00 PM</option>
                                                                <option value="9.5PM" disabled="disabled">9:30 PM</option>
                                                                <option value="10PM" disabled="disabled">10:00 PM</option>
                                                                <option value="10.5PM" disabled="disabled">10:30 PM</option>
                                                                <option value="11PM" disabled="disabled">11:00 PM</option>
                                                                <option value="11.5PM" disabled="disabled">11:30 PM</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Time Given</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="time_given" name="time_given" data-customer-source="dropdown" class="form-control searchable-dropdown">
                                                                <option value=""></option>
                                                                <option value="7AM">7:00 AM</option>
                                                                <option value="7.5AM">7:30 AM</option>
                                                                <option selected="selected" value="8AM">8:00 AM</option>
                                                                <option value="8.5AM">8:30 AM</option>
                                                                <option value="9AM">9:00 AM</option>
                                                                <option value="9.5AM">9:30 AM</option>
                                                                <option value="10AM">10:00 AM</option>
                                                                <option value="10.5AM" disabled="disabled">10:30 AM</option>
                                                                <option value="11AM" disabled="disabled">11:00 AM</option>
                                                                <option value="11.5AM" disabled="disabled">11:30 AM</option>
                                                                <option value="12PM" disabled="disabled">12:00 PM</option>
                                                                <option value="12.5PM" disabled="disabled">12:30 PM</option>
                                                                <option value="1PM" disabled="disabled">1:00 PM</option>
                                                                <option value="1.5PM" disabled="disabled">1:30 PM</option>
                                                                <option value="2PM" disabled="disabled">2:00 PM</option>
                                                                <option value="2.5PM" disabled="disabled">2:30 PM</option>
                                                                <option value="3PM" disabled="disabled">3:00 PM</option>
                                                                <option value="3.5PM" disabled="disabled">3:30 PM</option>
                                                                <option value="4PM" disabled="disabled">4:00 PM</option>
                                                                <option value="4.5PM" disabled="disabled">4:30 PM</option>
                                                                <option value="5PM" disabled="disabled">5:00 PM</option>
                                                                <option value="5.5PM" disabled="disabled">5:30 PM</option>
                                                                <option value="6PM" disabled="disabled">6:00 PM</option>
                                                                <option value="6.5PM" disabled="disabled">6:30 PM</option>
                                                                <option value="7PM" disabled="disabled">7:00 PM</option>
                                                                <option value="7.5PM" disabled="disabled">7:30 PM</option>
                                                                <option value="8PM" disabled="disabled">8:00 PM</option>
                                                                <option value="8.5PM" disabled="disabled">8:30 PM</option>
                                                                <option value="9PM" disabled="disabled">9:00 PM</option>
                                                                <option value="9.5PM" disabled="disabled">9:30 PM</option>
                                                                <option value="10PM" disabled="disabled">10:00 PM</option>
                                                                <option value="10.5PM" disabled="disabled">10:30 PM</option>
                                                                <option value="11PM" disabled="disabled">11:00 PM</option>
                                                                <option value="11.5PM" disabled="disabled">11:30 PM</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Date Given</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control date_picker" name="date_given" id="date_given" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Tech Assign</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="tech_assign" id="tech_assign" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 1</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="custom_field1" id="custom_field1" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 2</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="custom_field2" id="custom_field2" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 3</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="custom_field3" id="custom_field3" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 4</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="custom_field4" id="custom_field4" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">URL</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="url" id="url" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" module_ac">
                                            <div class="row">
                                                <div class="col-md-12 module_header">
                                                    <p class="module_title">Access Information</p>
                                                </div>
                                                <div class="col-sm-12" id="access_module">
                                                    <div class="col-sm-12 text-right-sm" style="align:right;">
                                                        <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                                                        <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                                                            <input type="checkbox" name="tech_switch" class="onoffswitch-checkbox" data-customize="open" id="onoff-tech">
                                                            <label class="onoffswitch-label" for="onoff-tech">
                                                                <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Portal Status (on/off)</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="radio" name="portal_status[]" value="1" id="portal_status1" checked required>
                                                            <label for="portal_status1"><span>On</span></label>

                                                            <input type="radio" name="portal_status[]" value="0"  id="portal_status">
                                                            <label for="rebate"><span>Off</span></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Reset Password (Button)</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="reset_password" id="reset_password" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Login</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="login" id="login" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Password</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="password" id="password" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 1</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="custom_field1" id="custom_field1" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 2</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="custom_field2" id="custom_field2" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Cancellation Date</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control date_picker" name="cancel_date" id="cancel_date" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Collection Date</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control date_picker" name="collect_date" id="collect_date" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Cancellation Reason</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="cancel_reason" id="cancel_reason" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Collection Amount</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="collect_amount" id="collect_amount" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" module_ac">
                                            <div class="row">
                                                <div class="col-md-12 module_header">
                                                    <p class="module_title">Customizable Module</p>
                                                </div>
                                                <div class="col-sm-12" id="access_module">
                                                    <div class="col-sm-12 text-right-sm" style="align:right;">
                                                        <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                                                        <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                                                            <input type="checkbox" name="custom_switch" class="onoffswitch-checkbox" data-customize="open" id="onoff-cust">
                                                            <label class="onoffswitch-label" for="onoff-cust">
                                                                <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 1</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="customfield1" id="customfield1" />

                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="#"><span style="padding-top:7px !important; " class="fa fa-pencil pull-right"></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 2</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="customfield2" id="customfield2" />

                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="#"><span style="padding-top:7px !important; " class="fa fa-pencil pull-right"></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 3</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="customfield3" id="customfield3" />

                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="#"><span style="padding-top:7px !important; " class="fa fa-pencil pull-right"></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 4</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="customfield4" id="customfield4" />

                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="#"><span style="padding-top:7px !important; " class="fa fa-pencil pull-right"></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 5</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="customfield5" id="customfield5" />

                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="#"><span style="padding-top:7px !important; " class="fa fa-pencil pull-right"></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 6</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="customfield6" id="customfield6" />

                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="#"><span style="padding-top:7px !important; " class="fa fa-pencil pull-right"></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 7</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="customfield7" id="customfield7" />

                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="#"><span style="padding-top:7px !important; " class="fa fa-pencil pull-right"></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 8</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="customfield8" id="customfield8" />

                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="#"><span style="padding-top:7px !important; " class="fa fa-pencil pull-right"></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 9</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="customfield9" id="customfield9" />

                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="#"><span style="padding-top:7px !important; " class="fa fa-pencil pull-right"></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 10</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="customfield10" id="customfield10" />

                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="#"><span style="padding-top:7px !important; " class="fa fa-pencil pull-right"></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 11</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="customfield11" id="customfield11" />

                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="#"><span style="padding-top:7px !important; " class="fa fa-pencil pull-right"></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 12</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="customfield12" id="customfield12" />

                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="#"><span style="padding-top:7px !important; " class="fa fa-pencil pull-right"></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 13</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="customfield13" id="customfield13" />

                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="#"><span style="padding-top:7px !important; " class="fa fa-pencil pull-right"></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 14</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="customfield14" id="customfield14" />

                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="#"><span style="padding-top:7px !important; " class="fa fa-pencil pull-right"></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 15</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="customfield15" id="customfield15" />

                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="#"><span style="padding-top:7px !important; " class="fa fa-pencil pull-right"></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 16</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="customfield16" id="customfield16" />

                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="#"><span style="padding-top:7px !important; " class="fa fa-pencil pull-right"></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 17</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="customfield17" id="customfield17" />

                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="#"><span style="padding-top:7px !important; " class="fa fa-pencil pull-right"></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 18</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="customfield18" id="customfield18" />

                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="#"><span style="padding-top:7px !important; " class="fa fa-pencil pull-right"></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 19</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="customfield19" id="customfield19" />

                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="#"><span style="padding-top:7px !important; " class="fa fa-pencil pull-right"></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 20</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="customfield20" id="customfield20" />

                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="#"><span style="padding-top:7px !important; " class="fa fa-pencil pull-right"></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 21</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="customfield21" id="customfield21" />

                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="#"><span style="padding-top:7px !important; " class="fa fa-pencil pull-right"></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 22</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="customfield22" id="customfield22" />

                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="#"><span style="padding-top:7px !important; " class="fa fa-pencil pull-right"></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 23</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="customfield23" id="customfield23" />

                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="#"><span style="padding-top:7px !important; " class="fa fa-pencil pull-right"></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-line">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Custom Field 24</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="customfield24" id="customfield24" />

                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="#"><span style="padding-top:7px !important; " class="fa fa-pencil pull-right"></span></a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div> <!-- end card -->
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

                <!--  <div class="module_ac">
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

                <!--<div class="col-md-12 module_ac_long">
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
                </div>-->

                <!-- <div class="col-md-12 module_ac_long">
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
                </div> -->

                <!-- <div class="col-md-12 module_ac_long">
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
                            </div>

                        </div>
                        <br>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
        <!-- end container-fluid -->
<?php include viewPath('includes/footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(document).ready(function () {
        $("#date_of_birth").datetimepicker({
            format: "L",
            //minDate: new Date(),
        });
        $(".date_picker").datetimepicker({
            format: "l",
            //'setDate': new Date(),
            //minDate: new Date(),
        });
        $('.date_picker').val(new Date().toLocaleDateString());
    });
</script>
<script>

    // document.getElementById('contact_mobile').addEventListener('input', function (e) {
    //     var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
    //     e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    // });
    // document.getElementById('contact_phone').addEventListener('input', function (e) {
    //     var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
    //     e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    // });

    // function validatecard() {
    //     var inputtxt = $('.card-number').val();
    //
    //     if (inputtxt == 4242424242424242) {
    //         $('.require-validation').submit();
    //     } else {
    //         alert("Not a valid card number!");
    //         return false;
    //     }
    // }
    $(document).ready(function() {
        $("#profile_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/customer/add_data_sheet",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Success"){
                        save_sucess("Profile Info successfully saved!");
                        window.location.href="/customer";
                    }
                    console.log(data);
                }
            });
        });

        $("#account_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/customer/crud_account_module",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Success"){
                        save_sucess("Account Information successfully saved!");
                    }
                    console.log(data);
                }
            });
        });

        $("#address_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/customer/crud_address_module",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Success"){
                        save_sucess("Address Information successfully saved!");
                    }
                    console.log(data);
                }
            });
        });

        $("#billing_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/customer/crud_billing_module",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Success"){
                        save_sucess("Billing Information Successfully Saved!");
                    }
                    console.log(data);
                }
            });
        });

        $("#alarm_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/customer/crud_alarm_module",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Success"){
                        save_sucess("Alarm Industry Information Successfully Saved!");
                    }
                    console.log(data);
                }
            });
        });

        $("#office_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/customer/crud_office_module",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Success"){
                        save_sucess("Office Use Information Successfully Saved!");
                    }
                    console.log(data);
                }
            });
        });

        $("#admin_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/customer/crud_admin_module",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Success"){
                        save_sucess("Admin Information Successfully Saved!");
                    }
                    console.log(data);
                }
            });
        });

        $("#tech_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/customer/crud_tech_module",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Success"){
                        save_sucess("Tech Information Successfully Saved!");
                    }
                    console.log(data);
                }
            });
        });

        $("#access_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/customer/crud_access_module",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Success"){
                        save_sucess("Acount Access Information Successfully Saved!");
                    }
                    console.log(data);
                }
            });
        });

        function save_sucess(information){
            Swal.fire(
                'Good job!',
                information,
                'success'
            );
        }

        function sucess(){
            Swal.fire({
                title: 'Good job!',
                text: "Profile Info successfully saved!",
                icon: 'sucess',
                showCancelButton: false,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            });
        }
    });
</script>
<style>
    .select2-container--open{       z-index: 0;}
    span.select2-selection.select2-selection--single {
        font-size: 16px;
    }
</style>