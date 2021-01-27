<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<style type="text/css">
    .wrapper *{
        font-size: 14px;
    }
    #map {
        height: 200px;
        width: 100%;
        padding: 0;
    }

    .left-sidebar-main .card {
        padding: 0px;
    }
    .left-sidebar-main .card .page-title {
        display: flex;
        align-items: center;    
    }
    .left-sidebar-main .card .page-title svg {
        margin-right: 0;
    }
    .form-group-icon {
        position: relative;
    }
    .form-group-icon i {
        position: absolute;
        left: 10px;
        top: 16px;
        color: #222222;
    }
    .form-group-icon input {
        padding: 15px 35px;
    }
    .btn-primary.text-link {
        padding: 6px 8px;
        background: none;
        color: #45a73c; 
    }
    .btn-primary.text-link:hover {
        background-color: #45a73c;
        color: #fff;
    }
    .table-custom table th,
    .table-custom table td {
        border: none;
    }
    .table-custom table {
        border: none;
    }
    .table-custom table td a i {
        color: #45a73c;
        padding-left: 0px;
    }
    .table-custom table td.d-flex {
        padding-top: 23px;
    }
    .table-custom table td a {
        padding-left: 11px;
    }
    .table-hover tbody tr:hover, .table-striped tbody tr:nth-of-type(odd), .thead-default th {
        background-color: #fff;
    }
    .upload input[type=file]:before {
        width: 100%;
        height: 60px;
        font-size: 16px;
        line-height: 32px;
        content: 'Upload Existing Estimate';
        display: inline-block;
        background: #45a73c;
        padding: 5px 10px;
        text-align: center;
        color: #fff;
        border-radius: 0px;
    }
    .upload.workorder input[type=file]:before {
        content: 'Upload Workorder';
    }
    .upload.invoice input[type=file]:before {
        content: 'Upload Invoice';
    }
    .upload input[type=file] {
        cursor: pointer;
        width: 100%;
        height: 44px;
        overflow: hidden;
    }
    .card-body .edit-icon {
        position: absolute;
        right: 20px;
        top: 25px;
    }
    .card-body .edit-icon button{
        padding: 0px;
        border: none;
        background: none;
    }
    .label-width label {
        width: 125px;
    }
    #new_customer .modal-lg {
        max-width: 100%;
    }
    .contact-info h3{
        color: rgba(0, 0, 0, 0.87);
        font-size: 16px;
        font-weight: 500;
        font-family: "Roboto", "Helvetica", "Arial", sans-serif;
        line-height: 1.5em;
        display: flex;
        align-items: center;
    } 
    .contact-info svg {
        margin-right:15px;
    }
    .address-proof {
        width: 100%;
    }
    .address-proof iframe {
        width:100%;
        max-height: 250px;
    }
    .modal-footer-detail {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    display: block;
    border: 0;
    border-top: 1px solid rgba(0,0,0,.1);
    width: 100%;
}
.card-header .btn:after {
    content: '-';
    font-size: 50px;
    color: green;
    position: absolute;
    top: -5px;
    right: 18px;
}

.card-header .btn.collapsed:after {
    content: '+';
    font-size: 34px;
    color: green;
    position: absolute;
    top: 7px;
    /* left: 0px; */
    right: 20px;
}
.card-header .btn, .card-header .btn:hover, .card-header .btn:focus, .card-header .btn.focus {
    color: #000;
    text-decoration: none;
    border-bottom: 1px solid #e5e5e5;
    box-shadow: none;
    padding: 0px;
    width: 100%;
}
.card-header {
    border: none;
    padding: 0px;
    background: none;
}
.accordion .card-body {
    padding-left: 0px;
    padding-right: 0px;
    padding-bottom: 0px;
}
.accordion .card-body .form-group {
    margin-bottom: 0px !important;
}
.accordion .card-body {
    padding-bottom: 16px;
}
.left-sidebar-main .accordion .card {
    border: none !important;
}
.left-sidebar-main .card .accordion .page-title {
    display: flex;
    align-items: center;
    border-bottom: 1px solid #e9ecef !important;
    margin: 0px;
    padding: 10px 0px;
}
.label-width .form-control {
    width: 42%;
}
.left-sidebar-main .card.table-custom .modal {
    padding-right: 0px !important;
}
.block-btn-main .btn-full {
    padding: 12px 8px;
}
.block-btn-main .btn-full .btn {
    width: 100%;
}

.file-upload-drag {
    display: block;
    position: relative;
    width: 60%;
}
.file-upload-drag .drop {
    width: 100%;
    height: 100%;
    border: 4px dashed #45a73c;
    border-spacing: 25px;
    overflow: hidden;
    text-align: center;
    -webkit-transition: all 0.5s ease-out;
    -moz-transition: all 0.5s ease-out;
    transition: all 0.5s ease-out;
    -ms-transition: all 0.5s ease-out;
    -o-transition: all 0.5s ease-out;
    margin: auto;
    /* position: absolute; */
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    display: table;
    text-align: center;
    border-radius: 24px;
    -webkit-border-radius: 24px;
    -moz-border-radius: 24px;
    -ms-border-radius: 24px;
    -o-border-radius: 24px;
    color: #000;
}
.file-upload-drag .drop .cont {
    width: 100%;
    height: 100px;
    color: #fff;
    -webkit-transition: all 0.5s ease-out;
    -moz-transition: all 0.5s ease-out;
    transition: all 0.5s ease-out;
    margin: auto;
    /* position: absolute; */
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    display: table-cell;
    vertical-align: middle;
    text-align: center;
}
.file-upload-drag .drop .cont p {
    font-size: 20px;
    line-height: 20px;
    margin: 15px 0px;
    color: #000;
    font-weight: bold;
}
.file-upload-drag .drop input[type=file] {
    width: 100%;
    height: 100%;
    cursor: pointer;
    background: transparent;
    opacity: 0;
    margin: auto;
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
}
.file-upload-drag .drop .cont p.or-text {
    color: #e0e0e0;
    font-size: 16px;
}
.color-box-custom {
    padding: 20px 0px;
}
.color-box-custom ul {
    margin: 0px;
    padding: 0px;
    list-style: none;
}
.color-box-custom ul li {
    display: inline-block;
}
.color-box-custom ul li span {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: #000;
    display: block;
}
.color-box-custom ul li span.bg-1 {
    background-color: #4baf51;
}
.color-box-custom ul li span.bg-2 {
    background-color: #d86566;
}
.color-box-custom ul li span.bg-3 {
    background-color: #e57399;
}
.color-box-custom ul li span.bg-4 {
    background-color: #b273b3;
}
.color-box-custom ul li span.bg-5 {
    background-color: #8b63d7;
}
.color-box-custom ul li span.bg-6 {
    background-color: #678cda;
}
.color-box-custom ul li span.bg-7 {
    background-color: #59bdb3;
}
.color-box-custom ul li span.bg-8 {
    background-color: #64ae89;
}
.color-box-custom ul li span.bg-9 {
    background-color: #f1a740;
}

    #customer_info td, #customer_info th{
        border-top: 0 !important;
    }
    #customer_info>tbody>tr>td{
        padding: 3px 8px !important;
    }
    .card-body {
        padding: 1.25rem 1.25rem 0 1.25rem !important;
    }
    .customer_right_icon{
        float: right;
        font-size: 22px;
    }
    .add_new_customer{
        color :#32243d;
    }
</style>

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/job'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="row custom__border left-sidebar-main">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="page-title">
                                <svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px;position: relative; top: 1.4px;">
                                    <path d="M9 11.75c-.69 0-1.25.56-1.25 1.25s.56 1.25 1.25 1.25 1.25-.56 1.25-1.25-.56-1.25-1.25-1.25zm6 0c-.69 0-1.25.56-1.25 1.25s.56 1.25 1.25 1.25 1.25-.56 1.25-1.25-.56-1.25-1.25-1.25zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8 0-.29.02-.58.05-.86 2.36-1.05 4.23-2.98 5.21-5.37C11.07 8.33 14.05 10 17.42 10c.78 0 1.53-.09 2.25-.26.21.71.33 1.47.33 2.26 0 4.41-3.59 8-8 8z"></path>
                                </svg> &nbsp;Customer
                            </h6>
                            <div class="edit-icon">
                                <button class="MuiButtonBase-root MuiIconButton-root" tabindex="0" type="button">
                                <span class="MuiIconButton-label"><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px;">
                                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34a.9959.9959 0 00-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"></path></svg></span>
                                    <span class="MuiTouchRipple-root"></span></button>
                            </div>
                            <hr>
                            <small>Select Existing Customer</small>
                            <select id="customers" class="form-control">
                                <option value="">None</option>
                                <?php if(!empty($customers)): ?>
                                    <?php foreach ($customers as $customer): ?>
                                        <option value="<?= $customer->prof_id; ?>"><?= $customer->last_name.','.$customer->first_name.' ' .$customer->middle_name; ?></option>
                                     <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <table id="customer_info" class="table">
                                <thead>
                                    <tr>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="cust_fullname">xxxxx xxxxx</td>
                                        <td><a href=""><span class="fa fa-user customer_right_icon"></span></a></td>
                                    </tr>
                                    <tr>
                                        <td id="cust_address">-------------</td>
                                        <td><a href=""><span class="fa fa-map-marker customer_right_icon"></span></a></td>
                                    </tr>
                                    <tr>
                                        <td id="cust_number">(xxx) xxx-xxxx</td>
                                        <td><a href=""><span class="fa fa-phone customer_right_icon"></span></a></td>
                                    </tr>
                                    <tr>
                                        <td id="cust_email">xxxxx@xxxxx.xxx</td>
                                        <td><a href=""><span class="fa fa-envelope-o customer_right_icon"></span></a></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="modal-footer">
                                <a class="pt-1 pl-2 text-right add_new_customer" href="javascript:void(0)" id="add_another_invoice" data-toggle="modal" data-target="#new_customer">
                                    <span class="fa fa-plus-square fa-margin-right"></span>Add New Customer
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h6 class="page-title">
                                Map
                            </h6>
                            <div class="col-md-12">
                                <div id="map"></div>
                            </div>
                            <br>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h6 class="page-title"><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px; margin-right: -8px; position: relative; top: 1.4px;"><path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"></path></svg>  &nbsp; &nbsp;Schedule Job</h6>

                            <hr>
                            <div class="form-group label-width d-flex align-items-center">
                               <label>From</label>
                               <input type="date" class="form-control">
                               <select id="inputState" class="form-control">
                                <option selected="">Start time</option>
                                <option value="5:00 AM">5:00 AM</option>
                                <option value="5:30 AM">5:30 AM</option>
                                <option value="6:00 AM">6:00 AM</option>
                                <option value="6:30 AM">6:30 AM</option>
                                <option value="7:00 AM">7:00 AM</option>
                                <option value="7:30 AM">7:30 AM</option>
                                <option value="">8:00 AM</option>
                                <option value="">8:30 AM</option>
                                <option value="">9:00 AM</option>
                                <option value="">9:30 AM</option>
                                <option value="">10:00 AM</option>
                                <option value="">10:30 AM</option>
                                <option value="">11:00 AM</option>
                                <option value="">11:30 AM</option>
                                <option value="">12:00 AM</option>
                                <option value="">12:30 AM</option>
                                <option value="">1:00 PM</option>
                                <option value="">1:30 PM</option>
                                <option value="">2:00 PM</option>
                                <option value="">2:30 PM</option>
                                <option value="">3:00 PM</option>
                                <option value="">3:30 PM</option>
                                <option value="">4:00 PM</option>
                                <option value="">4:30 PM</option>
                              </select>
                            </div>
                            <div class="form-group label-width d-flex align-items-center">
                               <label >To</label>
                               <input type="date" class="form-control mr-2">
                               <select id="inputState" class="form-control">
                                <option selected="">End time</option>
                                   <option value="5:00 AM">5:00 AM</option>
                                   <option value="5:30 AM">5:30 AM</option>
                                   <option value="6:00 AM">6:00 AM</option>
                                   <option value="6:30 AM">6:30 AM</option>
                                   <option value="7:00 AM">7:00 AM</option>
                                   <option value="7:30 AM">7:30 AM</option>
                                   <option value="">8:00 AM</option>
                                   <option value="">8:30 AM</option>
                                   <option value="">9:00 AM</option>
                                   <option value="">9:30 AM</option>
                                   <option value="">10:00 AM</option>
                                   <option value="">10:30 AM</option>
                                   <option value="">11:00 AM</option>
                                   <option value="">11:30 AM</option>
                                   <option value="">12:00 AM</option>
                                   <option value="">12:30 AM</option>
                                   <option value="">1:00 PM</option>
                                   <option value="">1:30 PM</option>
                                   <option value="">2:00 PM</option>
                                   <option value="">2:30 PM</option>
                                   <option value="">3:00 PM</option>
                                   <option value="">3:30 PM</option>
                                   <option value="">4:00 PM</option>
                                   <option value="">4:30 PM</option>
                               </select>
                            </div>
                            <select id="inputState" class="form-control">
                                <option selected="">Select Employee</option>
                                <?php if(!empty($employees)): ?>
                                    <?php foreach ($employees as $employee): ?>
                                        <option value="<?= $employee->id; ?>"><?= $employee->LName.','.$employee->FName; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                              </select>
                              <div class="color-box-custom">
                                  <h6>Event Color on Calendar</h6>
                                  <ul>
                                      <li>
                                        <span class="color-scheme bg-1"></span>
                                      </li>
                                      <li>
                                        <span class="color-scheme bg-2"></span>
                                      </li>
                                      <li>
                                        <span class="color-scheme bg-3"></span>
                                      </li>
                                      <li>
                                        <span class="color-scheme bg-4"></span>
                                      </li>
                                      <li>
                                        <span class="color-scheme bg-5"></span>
                                      </li>
                                      <li>
                                        <span class="color-scheme bg-6"></span>
                                      </li>
                                      <li>
                                        <span class="color-scheme bg-7"></span>
                                      </li>
                                      <li>
                                        <span class="color-scheme bg-8"></span>
                                      </li>
                                      <li>
                                        <span class="color-scheme bg-9"></span>
                                      </li>
                                  </ul>
                               </div>
                               <h6>Customer Reminder Notification</h6>
                                <select name="event_notify_at" class="form-control">
                                    <option value="0">None</option>
                                    <option value="PT5M">5 minutes before</option>
                                    <option value="PT15M">15 minutes before</option>
                                    <option value="PT30M">30 minutes before</option>
                                    <option value="PT1H">1 hour before</option>
                                    <option value="PT2H">2 hours before</option>
                                    <option value="PT4H">4 hours before</option>
                                    <option value="PT6H">6 hours before</option>
                                    <option value="PT8H">8 hours before</option>
                                    <option value="PT12H">12 hours before</option>
                                    <option value="PT16H">16 hours before</option>
                                    <option value="P1D" selected="selected">1 day before</option>
                                    <option value="P2D">2 days before</option>
                                    <option value="PT0M">On date of event</option>
                                </select>
                              <h6>Time Zone</h6>
                               <select id="inputState" class="form-control">
                                <option selected="">Central Time (UTC -5)</option>
                                <option>...</option>
                              </select>
                            <hr>
                            <button type="button" class="btn btn-primary pull-right text-link"> <span class="fa fa-plus"></span> Share Job</button>

                        </div>
                        <br>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <!-- <h6 class="page-title"><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px; margin-right: -8px; position: relative; top: 1.4px;"><path d="M22 10l-6-6H4c-1.1 0-2 .9-2 2v12.01c0 1.1.9 1.99 2 1.99l16-.01c1.1 0 2-.89 2-1.99v-8zm-7-4.5l5.5 5.5H15V5.5z"></path></svg>  &nbsp; &nbsp;Private notes</h6>
                            <hr>
                            <div class="form-group">
                               <input type="text" class="form-control">
                            </div> -->
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingFour">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                            <h6 class="page-title"><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px; margin-right: -8px; position: relative; top: 1.4px;">
                                                <g>
                                                    <path d="M6.535,10.29l6.585,6.683c0.289,0.294,0.723,0.294,1.013,0l1.663-1.689c0.362-0.294,0.362-0.806,0.072-1.028l-6.584-6.68 c0.651-1.689,0.29-3.671-1.085-5.066C6.752,1.042,4.582,0.748,2.844,1.555l3.112,3.157l-2.17,2.203L0.601,3.758 c-0.868,1.762-0.507,3.963,0.94,5.432C2.917,10.584,4.87,10.953,6.535,10.29z"></path>
                                                    <path d="M21.708,12.354c-0.926-3.883-4.409-6.774-8.576-6.774c-0.538,0-1.06,0.062-1.571,0.154l0.518,2.057 c0.344-0.055,0.693-0.093,1.053-0.093c2.988,0,5.519,1.956,6.386,4.655H17.12l3.404,3.724l3.404-3.724H21.708z"></path>
                                                    <path d="M13.132,21.115c-3.126,0-5.746-2.144-6.49-5.038h2.232L5.47,12.354l-3.404,3.723h2.403 c0.782,4.075,4.361,7.156,8.664,7.156c2.982,0,5.615-1.482,7.212-3.749l-1.784-1.177C17.345,20.001,15.375,21.115,13.132,21.115z"></path>
                                                </g>
                                            </svg>  &nbsp; &nbsp;Services Box</h6>
                                            </button>
                                        </h2>
                                        </div>

                                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                        <div class="card-body">

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <!-- <h6 class="page-title"><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px; margin-right: -8px; position: relative; top: 1.4px;"><path d="M22 10l-6-6H4c-1.1 0-2 .9-2 2v12.01c0 1.1.9 1.99 2 1.99l16-.01c1.1 0 2-.89 2-1.99v-8zm-7-4.5l5.5 5.5H15V5.5z"></path></svg>  &nbsp; &nbsp;Private notes</h6>
                            <hr>
                            <div class="form-group">
                               <input type="text" class="form-control">
                            </div> -->
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <h6 class="page-title"> <span style="font-size: 20px;"  class="fa fa-book"></span> Private notes </h6>
                                            </button>
                                        </h2>

                                        </div>

                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <input type="text" class="form-control">
                                            </div>
                                            <br><br>
                                            <div style="float: right;">
                                                <span style="font-size: 20px;" class="fa fa-history"></span> &nbsp;
                                                <span style="font-size: 20px;" class="fa fa-pencil"></span> &nbsp;
                                                <span style="font-size: 20px;" class="fa fa-ellipsis-v"></span> &nbsp;
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <!-- <h6 class="page-title"><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px; margin-right: -8px; position: relative; top: 1.4px;"><path d="M22 10l-6-6H4c-1.1 0-2 .9-2 2v12.01c0 1.1.9 1.99 2 1.99l16-.01c1.1 0 2-.89 2-1.99v-8zm-7-4.5l5.5 5.5H15V5.5z"></path></svg>  &nbsp; &nbsp;Job Tags</h6>
                            <hr>
                            <div class="form-group">
                               <input type="text" class="form-control">
                            </div> -->
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                        <h6 class="page-title"><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px; margin-right: -8px; position: relative; top: 1.4px;"><path d="M22 10l-6-6H4c-1.1 0-2 .9-2 2v12.01c0 1.1.9 1.99 2 1.99l16-.01c1.1 0 2-.89 2-1.99v-8zm-7-4.5l5.5 5.5H15V5.5z"></path></svg>  &nbsp; &nbsp;Job Tags</h6>
                                        </button>
                                    </h2>
                                    </div>

                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <small>Select Tag</small>
                                            <select id="inputState" class="form-control">
                                                <?php if(!empty($tags)): ?>
                                                    <?php foreach ($tags as $tag): ?>
                                                        <option value="<?= $tag->id; ?>"><?= $tag->name; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h6 class="page-title"><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px;"><circle cx="12" cy="12" r="3.2"></circle><path d="M9 2L7.17 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2h-3.17L15 2H9zm3 15c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z"></path></svg>  &nbsp; &nbsp;Photos / attachments</h6>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <!-- <h6 class="page-title"><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px; margin-right: -8px; position: relative; top: 1.4px;"><path d="M22 10l-6-6H4c-1.1 0-2 .9-2 2v12.01c0 1.1.9 1.99 2 1.99l16-.01c1.1 0 2-.89 2-1.99v-8zm-7-4.5l5.5 5.5H15V5.5z"></path></svg>  &nbsp; &nbsp;Url link</h6>
                            <hr>
                            <div class="form-group">
                               <input type="text" class="form-control">
                            </div> -->
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                        <h6 class="page-title"><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px; margin-right: -8px; position: relative; top: 1.4px;"><path d="M22 10l-6-6H4c-1.1 0-2 .9-2 2v12.01c0 1.1.9 1.99 2 1.99l16-.01c1.1 0 2-.89 2-1.99v-8zm-7-4.5l5.5 5.5H15V5.5z"></path></svg>  &nbsp; &nbsp;Url link</h6>
                                        </button>
                                    </h2>
                                    </div>

                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="form-group col-md-12">
                                                <label for="attachment">Attachments</label>
                                                <p>Optionally attach files to this work order. Allowed type: pdf, doc, docx, png, jpg, gif.</p>
                                                <input type="file" class="form-control" name="attachment" id="attachment">
                                            </div>

                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#fill-eSign" aria-expanded="true" aria-controls="collapseOne">
                                        <h6 class="page-title"><span style="font-size: 20px;"  class="fa fa-edit"></span>Fill & eSign</h6>
                                    </button>
                                </h2>
                            </div>
                            <div id="fill-eSign" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">

                                    <div style="float: right;">
                                        <span style="font-size: 20px;" class="fa fa-pencil"></span> &nbsp;
                                        <span style="font-size: 20px;" class="fa fa-history"></span> &nbsp;
                                        <span style="font-size: 20px;" class="fa fa-ellipsis-v"></span> &nbsp;
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#approval" aria-expanded="true" aria-controls="collapseOne">
                                        <h6 class="page-title"><span style="font-size: 20px;"  class="fa fa-check-circle-o"></span> Approval</h6>
                                    </button>
                                </h2>
                            </div>
                            <div id="approval" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">


                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="prev-btn float-right">
                       <button type="button" class="btn btn-primary">Preview</button>
                    </div> -->
                </div>
                <div class="col-md-8">

                    <div class="stepwizard">
                        <div class="stepwizard-row setup-panel">
                            <div class="stepwizard-step col-xs-3">
                                <a href="#step-1" type="button" class="btn btn-success btn-circle"><span class="fa fa-calendar-check-o"></span></a>
                                <p class=""><small>Schedule</small></p>
                            </div>
                            <div class="stepwizard-step col-xs-3">
                                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled"><span class="fa fa-ship"></span></a>
                                <p><small>OMW</small></p>
                            </div>
                            <div class="stepwizard-step col-xs-3">
                                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled"><span class="fa fa-hourglass-start"></span></a>
                                <p><small>Start</small></p>
                            </div>
                            <div class="stepwizard-step col-xs-3">
                                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled"><span class="fa fa-stop"></span></a>
                                <p><small>Finish</small></p>
                            </div>
                            <div class="stepwizard-step col-xs-3">
                                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled"><span class="fa fa-paper-plane"></span></a>
                                <p><small>Invoice</small></p>
                            </div>
                            <div class="stepwizard-step col-xs-3">
                                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">
                                    <span class="fa fa-credit-card"></span></a>
                                <p><small>Pay</small></p>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="card table-custom">
                        <div class="card-body">
                            <h6 class="page-title">&nbsp; Import Existing Estimate,Workorder or Invoice</h6>
                            <hr/>
                            <table class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                                 <thead>
                                    <tr>

                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                        <td class="upload" colspan="5">
                                         <input id="files" type="file">
                                        </td>
                                    </tr>
                                     <tr>
                                        <td class="upload workorder" colspan="5">
                                         <input id="files" type="file">
                                        </td>
                                    </tr>
                                     <tr>
                                        <td class="upload invoice" colspan="5">
                                         <input id="files" type="file">
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td colspan="5">
                                           <button type="button" class="btn btn-primary"><span class="fa fa-download"></span> Import</button>

                                        </td>
                                    </tr>
                                 </tbody>
                             </table>
                            <div class="col-sm-12">
                                <hr>
                            </div>

                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr></tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h6>Job Items Listing</h6>
                                        </td>
                                        <td></td>
                                        <td>
                                            <small>Job Tags</small>
                                            <input type="text" class="form-control" value="Residential" readonly="readonly">
                                        </td>
                                        <td></td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary"><span class="fa fa-paper-plane-o"  style=""></span></button>
                                            <button type="button" class="btn btn-sm btn-primary"><span class="fa fa-file"  style="color:;"></span></button>
                                            <button type="button" class="btn btn-sm btn-primary"><span class="fa fa-print" style="color:;"></span></button>

                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary"><span class="fa fa-plus"  style="color:;"></span></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="35%">
                                           <small>Item name</small>
                                            <input type="text" name="check_description[]" class="form-control checkDescription" >
                                        </td>
                                        <td>
                                            <small>Qty</small>
                                            <input type="text" name="check_description[]" class="form-control checkDescription">
                                        </td>
                                        <td>
                                            <small>Unit Price</small>
                                            <input type="text" name="check_amount[]" class="form-control checkModelAmount" value="0" placeholder="Unit Price">
                                        </td>
                                        <td>
                                            <small>Unit Cost</small>
                                            <input type="text" name="check_description[]" class="form-control checkDescription">
                                        </td>
                                        <td>
                                            <small>Inventory Location</small>
                                            <input type="text" name="check_description[]" class="form-control checkDescription">
                                        </td>
                                        <td style="text-align: center" class="d-flex">$00<a href="#" class="remove-check-row"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a class="link-modal-open pt-1 pl-2" href="javascript:void(0)" id="add_another_invoice">
                                                <span class="fa fa-plus-square fa-margin-right"></span>Add Items
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-sm-12">
                                <p>Description of Job (optional)</p>
                                <textarea name="description" class="form-control" ></textarea>
                                <hr/>
                            </div>

                            <div class="col-md-12 table-responsive">
                                <div class="row">
                                    <div class="col-md-6">
                                        &nbsp;<div class="file-upload-drag">
                                            <div class="drop">
                                                <div class="cont">
                                                    <div class="tit">
                                                        <p>Thumbnail</p>
                                                        <p class="or-text">Or</p>
                                                        <p>PDF</p>
                                                        <p class="or-text">Or</p>
                                                        <p>URL Link</p>
                                                        <p>To see import source</p>
                                                        <!-- <p class="or-text">Or</p>
                                                        <label>Choose File</label> -->
                                                    </div>
                                                </div>
                                                <input id="filetoupload" name="filetoupload" type="file" />
                                                <!-- <img id="dis_image" style="display:none;" src="#" alt="your image" /> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 row pr-0">
                                        <div class="col-sm-6">
                                            <label style="padding: 0 .75rem;">Subtotal</label>
                                        </div>
                                        <div class="col-sm-6 text-right pr-3">
                                            <label id="invoice_sub_total">$1,695.00</label>
                                            <input type="hidden" name="sub_total" id="sub_total_form_input" value='0'>
                                        </div>
                                        <div class="col-sm-12">
                                            <hr>
                                        </div>
                                        <div class="col-sm-6">
                                            <small>Tax Rate</small>
                                            <select id="inputState" class="form-control">
                                                <option >None</option>
                                                <option selected="">FL Tax(7.5%)</option>
                                            </select>
                                         </div>
                                        <div class="col-sm-6 text-right pr-3">
                                            <label id="invoice_sub_total">$0.00</label>
                                            <input type="hidden" name="sub_total" id="sub_total_form_input" value='0'>
                                        </div>
                                        <div class="col-sm-12">
                                            <hr>
                                        </div>
                                        <div class="col-sm-6">

                                        </div>
                                        <div class="col-sm-6 text-right pr-3">
                                            <a class="link-modal-open pt-1 pl-2" href="javascript:void(0)" id="add_another_invoice">
                                                <span class="fa fa-plus-square fa-margin-right"></span>Discount
                                            </a>
                                        </div>
                                        <div class="col-sm-12">
                                            <hr>
                                        </div>
                                        <div class="col-sm-6">

                                        </div>
                                        <div class="col-sm-6 text-right pr-3">
                                            <a class="link-modal-open pt-1 pl-2" href="javascript:void(0)" id="add_another_invoice">
                                                <span class="fa fa-plus-square fa-margin-right"></span>Deposit
                                            </a>
                                        </div>
                                        <div class="col-sm-12">
                                            <hr>
                                        </div>
                                        <div class="col-sm-6">
                                            <label style="padding: 0 .75rem;">Total</label>
                                        </div>
                                        <div class="col-sm-6 text-right pr-3">
                                            <label id="invoice_sub_total">$1,695.00</label>
                                            <input type="hidden" name="sub_total" id="sub_total_form_input" value='0'>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <hr>
                                    </div>
                                    <div class="col-sm-12">
                                        <div style="float: right;">
                                            <img width="100" id="customer-signature" alt="Customer Signature" src="/uploads/customer/16092352902893436525feafb5aae2b1.png">
                                            <center><span><b>John Doe</b></span></center><br>
                                            <span>------------------------</span><br>
                                            <center><span>Approved By</span></center><br>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-sm-12">
                                    <div class="card" style="border-color: #363636 !important;border: 1px solid;">
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="card-header">
                                                    <a href=""><span class="fa fa-columns" style="float: right;padding-right: 20px;"></span></a>
                                                    <h5 style="padding-left: 20px;" class="mb-0">Notes</h5>
                                                </div>
                                                <div class="card-body">
                                                    <span class="help help-sm help-block">State a note for more information.</span>
                                                </div>
                                                <div class="card-footer">
                                                    <div style="float: right;">
                                                        <span style="font-size: 20px;" class="fa fa-pencil"></span> &nbsp;
                                                        <span style="font-size: 20px;" class="fa fa-history"></span> &nbsp;
                                                        <span style="font-size: 20px;" class="fa fa-ellipsis-v"></span> &nbsp;
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    </div>

                                    <div class="col-sm-12">
                                    <div class="card" style="border-color: #e0e0e0;border: 1px solid;">
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="card-header">
                                                    <a href=""><span class="fa fa-columns" style="float: right;padding-right: 20px;"></span></a>
                                                    <h5 style="padding-left: 20px;">Url Link</h5>

                                                </div>
                                                <div class="card-body">
                                                    <span class="help help-sm help-block">Upload url link or a pdf link </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>

                                    <div class="col-sm-12">
                                    <div class="card" style="border-color: #e0e0e0;border: 1px solid;">
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="card-header">
                                                    <a href=""><span class="fa fa-columns" style="float: right;padding-right: 20px;"></span></a>
                                                    <h5 style="padding-left: 20px;">Photos/Attachments</h5>

                                                </div>
                                                <div class="card-body">
                                                    <span class="help help-sm help-block">download pdf,jpg,png</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <input class="form-control" value="Thank you for your business, Please call Nsmartrac at xxx-xxx-xxxx for quality customer service.">
                                    </div>
                                    <div class="col-sm-12">
                                        <hr>
                                    </div>
                                </div>
                                <br>


                            </div>
                            <div class="row">

                                <div class="col-sm-12">
                                    <button type="button" class="btn btn-primary"><span class="fa fa-search-plus"></span> Preview</button>
                                    <button type="button" class="btn btn-primary"><span class="fa fa-calendar-check-o"></span> Schedule</button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card table-custom">
                        <div class="card-body">

                            <div class="card" style="border-color: #363636 !important;border: 1px solid;">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="card-header">
                                            <a href=""><span class="fa fa-columns" style="float: right;padding-right: 20px;"></span></a>
                                            <h5 style="padding-left: 20px;" class="mb-0">Payment Details</h5>
                                        </div>
                                        <div class="card-body">
                                            <span class="help help-sm help-block">Record and process invoice</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card" style="border-color: #363636 !important;border: 1px solid;">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="card-header">
                                            <a href=""><span class="fa fa-columns" style="float: right;padding-right: 20px;"></span></a>
                                            <h5 style="padding-left: 20px;" class="mb-0">Devices Audit</h5>
                                        </div>
                                        <div class="card-body">
                                            <span class="help help-sm help-block">Record all items used on jobs</span>
                                            <br>
                                            <div style="margin-right:15px; padding-top:1px;font-size: 10px !important;" align="left" class="normaltext1">
                                                <a href="javascript:void(0);" id="moreFields" class="more_fields" style="color:#58bc4f;"><span class="fa fa-plus"></span> Add Device </a>&nbsp;&nbsp;
                                                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
                                            </div>
                                            <table cellpadding="0" cellspacing="3" class="table table-striped table-bordered"">
                                                <thead>
                                                <tr>
                                                    <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                                                        <b>Name</b>
                                                    </td>
                                                    <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                                                        <b>Sold By</b></td>
                                                    <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                                                        <b>Points</b></td>
                                                    <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                                                        <b>Retail Cost</b></td>
                                                    <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                                                        <b>Purchase Price</b></td>
                                                    <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                                                        <b>Qty</b></td>
                                                    <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                                                        <b>Tot Points</b></td>
                                                    <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                                                        <b>Tot Cost</b></td>
                                                    <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                                                        <b>Tot Purchase Price</b></td>
                                                    <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                                                        <b>Net</b></td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php if (isset($device_info)) : ?>
                                                    <?php foreach ($device_info as $device) { ?>
                                                        <tr>
                                                            <td style="text-align: left; border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                                                                <?= $device->device_name; ?>
                                                            </td>
                                                            <td style="text-align: left; border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                                                                <?= $device->sold_by; ?>
                                                            </td>
                                                            <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                                                                <?= $device->device_points; ?>
                                                            </td>
                                                            <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px; color: #336699; text-align: right">
                                                                <?= '$'.$device->retail_cost; ?>
                                                            </td>
                                                            <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px; color: #CC3300; text-align: right">
                                                                <?= '$'.$device->purch_price; ?>
                                                            </td>
                                                            <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                                                                <?= $device->device_qty; ?>
                                                            </td>
                                                            <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                                                                <?= $device->total_points; ?>
                                                            </td>
                                                            <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px; color: #336699; text-align: right">
                                                                <?= '$'.$device->total_cost; ?>
                                                            </td>
                                                            <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px; color: #CC3300; text-align: right">
                                                                <?= '$'.$device->total_purch_price; ?>
                                                            </td>
                                                            <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px; color: Green; text-align: right">
                                                                <?= '$'.$device->device_net; ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php endif ?>
                                                </tbody>
                                            </table>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card" style="border-color: #363636 !important;border: 1px solid;">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="card-header">
                                            <a href=""><span class="fa fa-columns" style="float: right;padding-right: 20px;"></span></a>
                                            <h5 style="padding-left: 20px;" class="mb-0">Activity Feeds</h5>
                                        </div>
                                        <div class="card-body">
                                            <span class="help help-sm help-block">History log of customer</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>

                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>

<!-- Modal -->
<div class="modal fade" id="new_customer" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newcustomerLabel">Add new customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form id="new_customer_form">
      <div class="modal-body">
        <div class="contact-info">
            <div class="row">

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Middle Initial</label>
                                    <input type="text" name="middle_name" class="form-control" placeholder="optional" >
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone_h" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="email" name="mail_add" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="email" name="city" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>State</label>
                                    <input type="email" name="state" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Zip Code</label>
                                    <input type="email" name="zip_code" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control"  placeholder="Company">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control"  placeholder="Job Title">
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                          <label class="form-check-label" for="exampleRadios1">
                            Homeowner
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                          <label class="form-check-label" for="exampleRadios2">
                            Business
                          </label>
                        </div>
                    </div>-->
                    <hr>

            </div>
        </div>
        <!--<div class="contact-info">
            <h3 class="c13 c20"><svg class="MuiSvgIcon-root-362 jss355" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px;"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"></path></svg>Address</h3>
            <div class="row">
                <form>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" class="form-control"  placeholder="Street">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control"  placeholder="Unit">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <input type="text" class="form-control"  placeholder="City">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <select id="inputState" class="form-control">
                                <option selected>State</option>
                                <option>...</option>
                              </select>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control"  placeholder="Zip">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control"  placeholder="Address Note">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary pull-left text-link">+ Address</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="address-proof">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d389100.8208036594!2d-73.13514834535813!3d40.3678466330292!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sin!4v1611070455636!5m2!1sen!2sin" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                    </div>
                    <hr>
                </form>
            </div>
        </div> -->
        <!--<div class="contact-info">
            <h3 class="c13 c20"><svg class="MuiSvgIcon-root-362 jss355" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px;"><path d="M22 10l-6-6H4c-1.1 0-2 .9-2 2v12.01c0 1.1.9 1.99 2 1.99l16-.01c1.1 0 2-.89 2-1.99v-8zm-7-4.5l5.5 5.5H15V5.5z"></path></svg>Notes</h3>
            <div class="row">
                <form>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" class="form-control"  placeholder="Customer notes">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control"  placeholder="This customer bills to">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" class="form-control"  placeholder="Customer tags (press enter)">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control"  placeholder="Lead Source" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                </form>
            </div>
        </div> -->
      </div>
      <div class="modal-footer modal-footer-detail">
        <!--<div class="checkbox-modal">
            <input type="checkbox" id="receive" name="receive" value="receive">
            <label for="receive"> Receive notifications</label><br>
        </div>-->
        <div class="button-modal-list">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fa fa-remove"></span> Close</button>
            <button type="button" class="btn btn-primary"><span class="fa fa-paper-plane-o"></span> Save</button>
        </div>
      </div>
        </form>
    </div>
  </div>
</div>


<?php include viewPath('includes/footer'); ?>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBK803I2sEIkUtnUPJqmyClYQy5OVV7-E4&callback=initMap&libraries=&v=weekly"></script>
<script>

    $(document).ready(function() {
        $("#customers").on( 'change', function () {
            var customer_selected = this.value;
            //var firstDropVal = $('#pick').val();
            // $('.btn_redeem').data('request-data',end);
            console.log(customer_selected);
            if(customer_selected !== ""){
                $.ajax({
                    type: "POST",
                    url: "/job/get_customer_selected",
                    data: {id : customer_selected}, // serializes the form's elements.
                    success: function(data)
                    {
                        var customer_data = JSON.parse(data);
                        console.log(customer_data);
                        console.log(customer_data[0].first_name);
                        $('#cust_fullname').text(customer_data[0].first_name + ' ' + customer_data[0].last_name);
                        $('#cust_address').text(customer_data[0].mail_add + ' ' + customer_data[0].city + ',' + ' ' + customer_data[0].state + ' ' + customer_data[0].zip_code);
                        $('#cust_number').text(customer_data[0].phone_h);
                        $('#cust_email').text(customer_data[0].email);
                        initMap(customer_data[0].mail_add + ' ' + customer_data[0].city + ' ' + ' ' + customer_data[0].state + ' ' + customer_data[0].zip_code);
                    }
                });
            }else{
                $('#cust_fullname').text('xxxxx xxxxx');
                $('#cust_address').text('-------------');
                $('#cust_number').text('(xxx) xxx-xxxx');
                $('#cust_email').text('xxxxx@xxxxx.xxx');
                initMap();
            }
        });

    });

</script>
<script>
    var geocoder;
    function initMap(address=null) {
        if(address == null){
            address = '6866 Pine Forest Rd Pensacola FL 32526';
        }
        const myLatLng = { lat: -25.363, lng: 131.044 };
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 12,
            center: myLatLng,
        });
        new google.maps.Marker({
            position: myLatLng,
            map,
            title: "Hello World!",
        });
        geocoder = new google.maps.Geocoder();
        codeAddress(geocoder, map,address);
    }
    function codeAddress(geocoder, map,address) {
        geocoder.geocode({'address': address}, function(results, status) {
            if (status === 'OK') {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
            } else {
                console.log(status);
                console.log('Geocode was not successful for the following reason: ' + status);
            }
        });
    }
</script>

