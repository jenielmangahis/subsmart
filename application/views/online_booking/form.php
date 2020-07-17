<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_booking'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/addons'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Online Booking</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Manage your online booking</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <?php include viewPath('includes/booking_tabs'); ?>  

                        <div class="row">
                            <div class="col-md-6">
                                
                                <div class="row dashboard-container-1">
                                    <div class="col-md-12" style="margin-bottom: 20px;">
                                        <strong>Customize the way the form looks and get notifications on new booking inquiries.</strong>
                                    </div>
                                    <div class="col-md-12">
                                        <strong>Customize Form Fields</strong>
                                        <br />
                                        Select the fields that will be part of the form and required ones.
                                    </div>
                                    <div class="col-md-12" style="margin-top: 20px;">
                                        <table class="table">
                                          <thead>
                                            <tr>
                                              <th width="40%" scope="col"><strong>Field</strong></th>
                                              <th width="20%" scope="col"><strong>Visible</strong></th>
                                              <th width="20%" scope="col"><strong>Required</strong></th>
                                              <th width="20%" scope="col"><strong>-</strong></th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                                <td width="60%">
                                                    Name
                                                </td>
                                                <td width="20%">
                                                    <div class="checkbox checkbox-sm">
                                                        <input type="checkbox" name="visible[]" value="visible[]" class="checkbox-select" id="sun_0">
                                                        <label for="visible_0"></label>
                                                    </div>
                                                </td>
                                                <td width="20%" style="">
                                                    <div class="checkbox checkbox-sm">
                                                        <input type="checkbox" name="required[]" value="required[]" class="checkbox-select" id="vrequired_0">
                                                        <label for="sun_0"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="form-field-delete" data-category-delete-modal="open" data-id="13526" href="#">
                                                        <span class="fa fa-trash"></span>
                                                    </a>                                                    
                                                </td>
                                            </tr>
                                          </tbody>
                                        </table>   

                                        <div class="field-name-container" id="field-name-container" style="display: none;">

                                            <div class="form-group" id="">
                                                <label>Field Name</label> <span class="help">(e.g. Do you have pets)</span>
                                                <input type="text" name="field_name" value="" class="form-control" autocomplete="off">
                                            </div>
                                            <div class="form-group" id="">
                                                <button class="btn btn-success">Add</button>
                                                <a style="padding-left: 9px;" id="hide-add-form-field-row" data-time-slot="btn-add" href="javascript:void(0);">I'm done adding fields</a>
                                            </div>

                                        </div>

                                        <a style="padding-left: 9px;" id="add-form-field-row" data-time-slot="btn-add" href="javascript:void(0);"><span class="fa fa-plus-square fa-margin-right add-form-field-row"></span> Add Form Field</a>                                                                               
                                    </div>
                                </div>                                 

                            </div>
                            <div class="col-md-6">

                                <div class="row dashboard-container-1">
                                    <div class="col-md-12">

                                        <div style="padding: 40px; border: 0px solid rgb(221, 221, 221); background: rgb(242, 242, 242) none repeat scroll 0% 0%;">
                                            <div class="weight-medium margin-bottom">Preview Form</div> 
                                            <div style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; padding: 30px;">
                                                <div id="app" class="markate-widget-contact" style="color: rgb(34, 34, 34); font-size: 16px; font-family: &quot;roboto&quot;, Arial, Helvetica, sans-serif;">
                                                    <form name="widget-contact" method="post">
                                                        <div class="form-group">
                                                            <label>Name</label> <span class="form-required">*</span> 
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Phone</label> <span class="form-required">*</span> 
                                                            <input type="tel" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Address</label>
                                                            <input type="text" id="address" placeholder="" class="form-control pac-target-input" autocomplete="off">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Message</label>
                                                            <textarea rows="2" class="form-control"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Preferred time to contact</label>
                                                            <select name="form.contactTime" class="form-control">
                                                                <option value="0" selected="selected">Any time</option> 
                                                                <option value="1">7am to 10am</option> 
                                                                <option value="2">10am to Noon</option> 
                                                                <option value="3">Noon to 4pm</option> 
                                                                <option value="4">4pm to 7pm</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>How did you hear about us</label>
                                                            <input type="text" class="form-control"></div>
                                                    </form> 
                                                    <hr class="card-hr"> 
                                                    <div class="widget-contact-submit"><button class="btn btn-primary btn-lg">Book Now</button></div>
                                                </div>
                                            </div>
                                        </div> 

                                    </div>
                                </div>  
                                
                            </div>
                        </div> 
                        <hr />
                        <div>
                            <button class="btn btn-success">Save</button>
                            <a style="float: right;" href="#" class="btn btn-success"> Continue >> </a>
                        </div>

                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer_booking'); ?>