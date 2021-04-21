<?php
defined('BASEPATH') or exit('No direct script access allowed');
add_css(array(
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
));
?>

<?php include viewPath('includes/header'); ?>
<?php include viewPath('customer/css/add_advance_css'); ?>
<style>
    .input-group-prepend {
        height: 30px !important;
    }
    .table_head_customer{
        border-color: #999999;
        border-style: Solid;
        border-width: 1px;
    }
    .table_body_customer{
        border-color: #999999;
        border-style: Solid;
        border-width: 1px;
        background-color: #E5EBF2;
    }
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/customer'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">

            <div class="card">
                <div class="row pl-0 pr-0">
                    <div class="col-md-12 pl-0 pr-0">
                        <div class="col-md-12 pr-3" style="padding-left: 15px;">
                            <h3 class="page-title mt-0">New Transaction/Account History</h3>
                            <div class="pl-3 pr-3 mt-1 row">
                                <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                  <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">
                                      Make it easy for your customers by offering additional ways to pay.  The payments landscape is ever-changing.
                                      Simply select the payment method and hit the button to Pre-Auth Now or Capture Now  the payment.
                                      Each transaction will be saved in each customer history.
                                  </span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="radio" name="commision_scheme[]" class="form-controls" value="1" checked id="commision_scheme1" <?php if(isset($office_info)){ echo $office_info->commision_scheme == 1 ? 'checked': ''; } ?> >
                                <span >Credit Card</span> &nbsp;&nbsp;

                                <input type="radio" name="commision_scheme[]" class="form-controls" value="1" id="commision_scheme1" <?php if(isset($office_info)){ echo $office_info->commision_scheme == 1 ? 'checked': ''; } ?> >
                                <span >Debit Card</span> &nbsp;&nbsp;

                                <input type="radio" name="commision_scheme[]" class="form-controls" value="1" id="commision_scheme1" <?php if(isset($office_info)){ echo $office_info->commision_scheme == 1 ? 'checked': ''; } ?> >
                                <span >Cash</span> &nbsp;&nbsp;

                                <input type="radio" name="commision_scheme[]" class="form-controls" value="1" id="commision_scheme1" <?php if(isset($office_info)){ echo $office_info->commision_scheme == 1 ? 'checked': ''; } ?> >
                                <span >ACH</span> &nbsp;&nbsp;

                                <input type="radio" name="commision_scheme[]" class="form-controls" value="1" id="commision_scheme1" <?php if(isset($office_info)){ echo $office_info->commision_scheme == 1 ? 'checked': ''; } ?> >
                                <span >Venmo</span> &nbsp;&nbsp;

                                <input type="radio" name="commision_scheme[]" class="form-controls" value="1" id="commision_scheme1" <?php if(isset($office_info)){ echo $office_info->commision_scheme == 1 ? 'checked': ''; } ?> >
                                <span >Paypal</span> &nbsp;&nbsp;

                                <input type="radio" name="commision_scheme[]" class="form-controls" value="1" id="commision_scheme1" <?php if(isset($office_info)){ echo $office_info->commision_scheme == 1 ? 'checked': ''; } ?> >
                                <span >Square</span> &nbsp;&nbsp;

                                <input type="radio" name="commision_scheme[]" class="form-controls" value="1" id="commision_scheme1" <?php if(isset($office_info)){ echo $office_info->commision_scheme == 1 ? 'checked': ''; } ?> >
                                <span >eCheck</span> &nbsp;&nbsp;

                                <input type="radio" name="commision_scheme[]" class="form-controls" value="0" id="commision_scheme" <?php if(isset($office_info)){ echo $office_info->commision_scheme == 0 ? 'checked': ''; } ?>>
                                <span>Others</span>
                            </div>
                            <br>
                            <form id="customer_form">
                                <div class="row pl-0 pr-0">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>
                                                <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Customer Information</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row form_line">
                                                    <div class="col-md-2">
                                                        <label>First Name</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" name="first_name" id="first_name" value="<?php if(isset($profile_info->first_name)){ echo $profile_info->first_name; } ?>" required/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-2">
                                                        <label for="">Last Name </label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" name="last_name" id="last_name" value="<?php if(isset($profile_info)){ echo $profile_info->last_name; } ?>" required/>
                                                    </div>
                                                </div>
                                               <div class="row form_line">
                                                    <div class="col-md-2">
                                                        <label for="">Address </label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" name="mail_add" id="mail_add" value="<?php if(isset($profile_info->mail_add)){ echo $profile_info->mail_add; } ?>" required/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-2">
                                                        <label for="">City </label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="city" id="city" value="<?php if(isset($profile_info->city)){ echo $profile_info->city; } ?>" />
                                                    </div>

                                                    <div class="col-md-2">
                                                        <label for="">State </label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="city" id="city" value="<?php if(isset($profile_info->city)){ echo $profile_info->state; } ?>" />
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-2">
                                                        <label for="">Zip </label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="state" id="state" value="<?php if(isset($profile_info->state)){ echo $profile_info->zip_code; } ?>" />
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-2">
                                                        <label for="">Email </label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="email" class="form-control" name="email" id="email" value="<?php if(isset($profile_info)){ echo $profile_info->email; } ?>" />
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-2">
                                                        <label for="">Phone </label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="email" class="form-control" name="email" id="email" value="<?php if(isset($profile_info)){ echo $profile_info->phone_m; } ?>" />
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-2">
                                                        <label for="">Date of Birth </label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" disabled class="form-control" name="email" id="email" value="<?php if(isset($profile_info)){ echo $profile_info->date_of_birth; } ?>" />
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-2">
                                                        <label for="">Customer Type </label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input  disabled class="form-control" name="email" id="email" value="<?php if(isset($profile_info)){ echo $profile_info->customer_type; } ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>
                                                <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Payment Information</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        <label>Card Number</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="first_name" id="first_name" value="<?php if(isset($billing_info ) && $billing_info->credit_card_num != 0){ echo $billing_info->credit_card_num; } ?>" required/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        <label for="">Expiration </label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <select id="exp_month" name="exp_month" data-customer-source="dropdown" class="input_select" >
                                                                    <option  value=""></option>
                                                                    <option  value="1">01</option>
                                                                    <option  value="2">02</option>
                                                                    <option  value="3">03</option>
                                                                    <option  value="4">04</option>
                                                                    <option  value="5">05</option>
                                                                    <option  value="6">06</option>
                                                                    <option  value="7">07</option>
                                                                    <option  value="8">08</option>
                                                                    <option  value="9">09</option>
                                                                    <option  value="10">10</option>
                                                                    <option  value="11">11</option>
                                                                    <option  value="12">12</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <select id="exp_year" name="exp_year" data-customer-source="dropdown" class="input_select" >
                                                                    <option  value=""></option>
                                                                    <option  value="2021">2021</option>
                                                                    <option  value="2022">2022</option>
                                                                    <option  value="2023">2023</option>
                                                                    <option  value="2024">2024</option>
                                                                    <option  value="2025">2025</option>
                                                                    <option  value="2026">2026</option>
                                                                    <option  value="2027">2027</option>
                                                                    <option  value="2028">2028</option>
                                                                    <option  value="2029">2029</option>
                                                                    <option  value="2030">2030</option>
                                                                    <option  value="2031">2031</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        <label for="">Transaction Subtotal </label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="mail_add" id="mail_add"  required/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        <label for="">Tax Amount </label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="city" id="city"  required/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        <label for="">Transaction Amount </label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="state" id="state"  required/>
                                                    </div>
                                                </div>

                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        <label for="">Transaction Category</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select id="transaction_category" name="transaction_category" data-customer-source="dropdown" class="input_select" >
                                                            <option  value=""></option>
                                                            <option  value="E">Equipment</option>
                                                            <option  value="MMR">MMR</option>
                                                            <option  value="RMR">RMR</option>
                                                            <option  value="MS">Monthly Subscription</option>
                                                            <option  value="AF">Activation Fee</option>
                                                            <option  value="FM">First Month</option>
                                                            <option  value="AFM">Activation + First Month</option>
                                                            <option  value="D">Deposit</option>
                                                            <option  value="O">Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        <label for="">Notes</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <textarea type="text" style="background-color: #fdeac3;" class="form-controls" rows="5" cols="50" name="country" id="country" ></textarea>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Pre Auth Now</button>
                                                <button type="submit" class="btn btn-primary">Capture Now</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>
                                                <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Transaction History</h6>
                                            </div>
                                            <div class="card-body">

                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>


        </div>
        <!-- end container-fluid -->

        <?php
        // JS to add only Customer module
        add_footer_js(array(
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
        ));
        ?>
        <?php include viewPath('includes/footer'); ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js" integrity="sha512-2xXe2z/uA+2SyT/sTSt9Uq4jDKsT0lV4evd3eoE/oxKih8DSAsOF6LUb+ncafMJPAimWAXdu9W+yMXGrCVOzQA==" crossorigin="anonymous"></script>

        <?php include viewPath('customer/js/billing_js'); ?>
