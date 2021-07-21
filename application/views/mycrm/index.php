<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.hide {
    display:none;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/mycrm'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
    <div class="container-page">
    <div class="container-fluid">

<h1>My Account</h1>

<div class="row">
    <div class="col-md-12 col-lg-12">

<div class="card">
    <h3>General</h3>
    <ul class="ul-table">
        <li>
            <div class="row">
                <div class="col-md-2">
                    <strong>Email</strong>
                </div>
                <div class="col-md-3">moresecureadi@gmail.com</div>
                <div class="col-md-4 text-right">
                    <a data-cardeditor-open="email" href="#">Edit</a>
                </div>
            </div>
        </li>
        <li class="card-content hide" data-cardeditor-id="email">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <form id="account-email-edit" data-cardeditor-url="https://www.markate.com/api/v1/pro/account/settings/email_update" method="post" action="#">
    <div class="validation-error hide"></div>
    <div class="row">
        <div class="col-sm-16">
            <div class="form-group">
                <label>New Email Address</label> <span class="form-required">*</span>
                <input type="text" name="email" value="moresecureadi@gmail.com" class="form-control" autocomplete="off" placeholder="Email" required="">
                <span class="validation-error-field hide" data-formerrors-for-name="email" data-formerrors-message="true"></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-primary margin-right" data-cardeditor-action="submit" data-label-on-submit="Saving..." name="btn-save" type="button">Save</button>
        <a class="a-ter-v1" data-cardeditor-close="email" href="#">Cancel</a>
    </div>
</form>                </div>
            </div>
        </li>
        <li>
            <div class="row">
                <div class="col-md-2">
                    <strong>Password</strong>
                </div>
                <div class="col-md-3">********</div>
                <div class="col-md-4 text-right">
                    <a data-cardeditor-open="password" href="#">Edit</a>
                </div>
            </div>
        </li>
        <li class="border-bottom card-content hide" data-cardeditor-id="password">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-4">
                    <div class="content">
                        <form id="account-password-edit" data-cardeditor-url="https://www.markate.com/api/v1/pro/account/settings/password_update" method="post" action="#">
    <div class="validation-error hide"></div>
    <div class="row">
        <div class="col-sm-9">
            <div class="form-group">
                <label>Current Password</label> <span class="form-required">*</span>
                <input type="password" name="password" value="" class="form-control" autocomplete="off" placeholder="" required="">
                <span class="validation-error-field hide" data-formerrors-for-name="password" data-formerrors-message="true"></span>
            </div>
            <div class="form-group">
                <label>New Password</label> <span class="form-required">*</span>
                <input type="password" name="password_new" value="" class="form-control" autocomplete="off" placeholder="" required="">
                <span class="validation-error-field hide" data-formerrors-for-name="password_new" data-formerrors-message="true"></span>
            </div>
            <div class="form-group">
                <label>Re-type New Password:</label> <span class="form-required">*</span>
                <input type="password" name="password_new_confirm" value="" class="form-control" autocomplete="off" placeholder="" required="">
                <span class="validation-error-field hide" data-formerrors-for-name="password_new_confirm" data-formerrors-message="true"></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-primary margin-right" data-cardeditor-action="submit" name="btn-save" type="button">Save</button>
        <a class="a-ter-v1" data-cardeditor-close="password" href="#">Cancel</a>
    </div>
</form>                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>

<div class="card-spacer"></div>


<div class="card-spacer"></div>

<div class="card">
    <h3>Other Settings</h3>
    <ul class="ul-table">
        <li>
            <div class="row">
                <div class="col-md-5">
                    <strong>Account Deactivation</strong>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-4 text-right">
                    <a data-cardeditor-open="account-close" href="#">Edit</a>
                </div>
            </div>
        </li>
        <li class="card-content hide" data-cardeditor-id="account-close">
            <div class="row">
                <div class="col-md-5"></div>
                <div class="col-md-3">
                    <form id="account-close" data-cardeditor-url="https://www.markate.com/api/v1/pro/account/settings/account_close" method="post" action="#">
    <div class="validation-error hide"></div>
    <div class="row">
        <div class="col-sm-7">
            <div class="form-group">
                <label>What happens when you deactivate your account?</label>
                <ul class="ul-padding">
                    <li>Your profile will not be shown on Markate anymore.</li>
                    <li>Any opened jobs will be cancelled or refunded.</li>
                    <li>You won't be able to reactivate your account.</li>
                </ul>
            </div>
            <div class="form-group">
                <label>Why are you leaving?</label> <span class="form-required">*</span>
                <select name="account_close_reason" class="form-control" autocomplete="off" required="">
<option value="0">-- Choose a reason --</option>
<option value="1">The quality of the service was less than expected</option>
<option value="2">I have no time to use it</option>
<option value="3">I can't find what I am looking for</option>
<option value="4">I'd like to create a new account</option>
<option value="5">I had a negative experience as customer or pro</option>
<option value="6">I found the site difficult to use</option>
<option value="7">The level of customer service was less than expected</option>
<option value="8">This is temporary; I will be back</option>
<option value="9">I have another Markate account</option>
<option value="100">Other reason</option>
</select>
                <span class="validation-error-field hide" data-formerrors-for-name="account_close_reason" data-formerrors-message="true"></span>
            </div>
            <div class="form-group">
                <label>Tell us more</label> <span class="help help-sm">(optional, but required if you select "Other Reason" above)</span>
                <textarea name="account_close_message" cols="40" rows="3" class="form-control" autocomplete="off"></textarea>
                <span class="validation-error-field hide" data-formerrors-for-name="account_close_message" data-formerrors-message="true"></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-primary margin-right" data-cardeditor-action="submit" name="btn-save" type="button">Deactivate Account</button>
        <a class="a-ter-v1" data-cardeditor-close="account-close" href="#">Cancel</a>
    </div>
</form>                </div>
            </div>
        </li>
    </ul>
</div>

    </div>
</div>
    </div>
</div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>