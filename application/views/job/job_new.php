<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    add_css(array(
        'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
        'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
        //"assets/css/accounting/sidebar.css",
        'assets/textEditor/summernote-bs4.css',
    ));
?>
<?php include viewPath('includes/header'); ?>

<!-- add css for this page -->
<?php include viewPath('job/css/job_new'); ?>

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/job'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <form method="post" name="myform" id="jobs_form">
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
                            <select id="customer_id" name="customer_id" class="form-control" required>
                                <option value="">None</option>
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
                                        <td><a href="<?= base_url('customer'); ?>"><span class="fa fa-user customer_right_icon"></span></a></td>
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
                                        <td><a id="mail_to" href="#"><span class="fa fa-envelope-o customer_right_icon"></span></a></td>
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
                               <input type="date" name="start_date" class="form-control" required>
                               <select id="inputState" name="start_time" class="form-control" required>
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
                               <input type="date" name="end_date" class="form-control mr-2" required>
                               <select id="inputState" name="end_time" class="form-control" required>
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
                            <select id="employee_id" name="employee_id" class="form-control">
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
                                      <?php if(isset($color_settings)): ?>
                                          <?php foreach ($color_settings as $color): ?>
                                              <li>
                                                  <a style="background-color: <?= $color->color_code; ?>;" id="<?= $color->id; ?>" type="button" class="btn btn-default color-scheme btn-circle bg-1">
                                                  </a>
                                              </li>
                                          <?php endforeach; ?>
                                      <?php endif; ?>
                                  </ul>
                                  <input value="" id="job_color_id" name="event_color" type="hidden" />
                            </div>
                            <h6>Customer Reminder Notification</h6>
                            <select name="customer_reminder_notification" class="form-control">
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
                            <select id="inputState" name="timezone" class="form-control">
                                <option selected="">Central Time (UTC -5)</option>
                                <option>...</option>
                            </select>
                            <h6>Select Job Tag</h6>
                            <select id="job_tags" name="tags" class="form-control">
                                <option value="">Select Tag</option>
                                <?php if(!empty($tags)): ?>
                                    <?php foreach ($tags as $tag): ?>
                                        <option value="<?= $tag->id; ?>"><?= $tag->name; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <hr>
                            <button type="button" class="btn btn-primary pull-right text-link"> <span class="fa fa-plus"></span> Share Job</button>
                        </div>
                        <br>
                    </div>
                    <div class="card" id="notes_left_card">
                        <div class="card-body">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                             <button style="display: flex;" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <h6 class="page-title"> <span style="font-size: 20px;"  class="fa fa-book"></span> &nbsp; Private Notes </h6>
                                            </button>
                                            <a href="javascript:void(0);" id="notes_left"><span class="fa fa-columns" style="float: right;padding-right: 45px;font-size: 20px;display: block;margin-top: -30px;"></span></a>
                                        </h2>
                                    </div>
                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="row">
                                                <div id="notes_edit_btn" class="pencil" style=" width:100%; height:100px;">
                                                </div>
                                                <div id="notes_input_div" style="display:none;">
                                                    <div style=" height:100px;">
                                                        <textarea name="message" cols="50" style="width: 100%;" rows="3" id="note_txt" class="input"></textarea>
                                                        <button type="button" class="btn btn-primary btn-sm" id="save_memo" style="color: #ffffff;"><span class="fa fa-save"></span> Save</button>
                                                     </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div style="float: right;">
                                                <a href="javascript:void(0);" id="edit_note"><span style="font-size: 20px;" class="fa fa-pencil"></span></a> &nbsp;
                                                <span style="font-size: 20px;" class="fa fa-history"></span> &nbsp;
                                                <span style="font-size: 20px;" class="fa fa-ellipsis-v"></span> &nbsp;
                                            </div>
                                        </div>
                                        </div>
                                    <br>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card" id="attach_left_card">
                        <div class="card-body">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h2 class="mb-0">
                                        <button style="display: flex;" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#photos_attachment" aria-expanded="true" aria-controls="collapseTwo">
                                            <h6 class="page-title"><span style="font-size: 20px;"  class="fa fa-image"></span>&nbsp; &nbsp;Photos / Attachments</h6>
                                        </button>
                                        <a href="javascript:void(0);" id="attach_left_btn_column"><span class="fa fa-columns" style="float: right;padding-right: 45px;font-size: 20px;display: block;margin-top: -30px;"></span></a>
                                    </h2>
                                </div>

                                <div id="photos_attachment" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="form-group col-md-12">
                                                <label for="attachment">Attachments</label>
                                                <p>Optionally attach files to this Job. Allowed type: pdf, doc, docx, png, jpg, gif.</p>
                                                <input type="file" class="form-control" name="attachment" id="attachment">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" id="url_left_card">
                        <div class="card-body">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <h2 class="mb-0">
                                            <button style="display: flex;" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#url_link_form" aria-expanded="true" aria-controls="url_link_form">
                                                <h6 class="page-title"><span style="font-size: 20px;"  class="fa fa-link"></span> &nbsp; &nbsp;Url Link </h6>
                                            </button>
                                        </h2>
                                        <a href="javascript:void(0);" id="url_left_btn_column">
                                            <span class="fa fa-columns" style="float: right;padding-right: 45px;font-size: 20px;display: block;margin-top: -30px;"></span>
                                        </a>
                                    </div>

                                    <div id="url_link_form" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <label>Enter Url</label>
                                            <input type="url" name="link" class="form-control checkDescription" >
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#fill-eSign" aria-expanded="true" aria-controls="collapseOne">
                                                <h6 class="page-title"><span style="font-size: 20px;"  class="fa fa-edit"></span>&nbsp;&nbsp;Fill & eSign</h6>
                                            </button>
                                            <!--<a href="javascript:void(0);" id="notes_left"><span class="fa fa-columns" style="float: right;padding-right: 45px;font-size: 20px;display: block;margin-top: -30px;"></span></a>-->
                                        </h2>
                                    </div>
                                    <div id="fill-eSign" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                       <div class="card-body">
                                            <a style="cursor: pointer;" id="fill_esign_btn" data-toggle="modal" data-target="#fill_esign" data-backdrop="static" data-keyboard="false">
                                                <center>
                                                    <img width="100" id="" alt="Customer Signature" src="/assets/img/jobs/add_file.png">
                                                </center>
                                            </a>
                                         </div>
                                        <div style="float: right;">
                                            <a ><span style="font-size: 20px;" class="fa fa-pencil"></span> &nbsp;</a>
                                            <span style="font-size: 20px;" class="fa fa-ellipsis-v"></span> &nbsp;
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" id="pd_left_card">
                        <div class="card-body">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button style="display: flex;" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#payment" aria-expanded="true" aria-controls="payment">
                                                <h6 class="page-title"><span style="font-size: 20px;"  class="fa fa-money"></span>&nbsp;&nbsp;Payment Details</h6>
                                            </button>
                                        </h2>
                                        <a href="javascript:void(0);" id="pd_left">
                                            <span class="fa fa-columns" style="float: right;padding-right: 45px;font-size: 20px;display: block;margin-top: -30px;"></span>
                                        </a>
                                    </div>
                                    <div id="payment" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <form role="form">
                                            <div class="col-sm-12">
                                                <div class="col-md-12">
                                                    <label for="">Method</label>
                                                    <select id="pay_method" name="pay_method" class="form-control">
                                                        <option value="CC">Credit Card</option>
                                                        <option value="CHECK">Check</option>
                                                        <option value="CASH">Cash</option>
                                                        <option value="ACH">ACH</option>
                                                        <option value="VENMO">Venmo</option>
                                                        <option value="PP">Paypal</option>
                                                        <option value="SQ">Square</option>
                                                        <option value="WW">Warranty Work</option>
                                                        <option value="HOF">Home Owner Financing</option>
                                                        <option value="eT">e-Transfer</option>
                                                        <option value="OCCP">Other Credit Card Processor</option>
                                                        <option value="OPT">Other Payment Type</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="">Amount</label>
                                                    <input class="form-control" id="pay_amount" type="number" placeholder="$0.00">
                                                </div>
                                                <div class="col-md-12">
                                                    <h6>Payment Details</h6>
                                                        <div class="row">
                                                            <div id="credit_card_form">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="input-group">
                                                                                    <input type="text" name="account_holder_name" class="form-control" id="cardNumber" placeholder="Account Holder Name" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="input-group">
                                                                                    <input type="number" name="card_number" class="form-control" id="cardNumber" placeholder="1234 1234 1234 1234" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                    <input type="text" name="card_expiry" class="form-control" id="expityMonth" placeholder="MM/YY" />
                                                                            </div>
                                                                       </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <input type="number" name="card_cvc" class="form-control" id="cvCode" placeholder="CVC" />
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-12">
                                                                            <label >Save card to file</label>
                                                                            <div class="onoffswitch grid-onoffswitch" style="float: right;">
                                                                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize">
                                                                                <label class="onoffswitch-label" for="onoff-customize">
                                                                                    <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span></label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12" style="text-align: center !important;">
                                                                            <br>
                                                                            <button type="button" class="btn btn-sm btn-primary">
                                                                                <span class="fa fa-search-plus"></span> Scan Payment
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="check_form" style="display: none;">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <div class="input-group">
                                                                                    <input type="number" name="route_number" class="form-control" id="cardNumber" placeholder="Routing #" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <div class="input-group">
                                                                                    <input type="number" name="account_number" class="form-control" id="cardNumber" placeholder="Account #" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12" style="text-align: center !important;">
                                                                            <br>
                                                                            <button type="button" class="btn btn-sm btn-primary">
                                                                                <span class="fa fa-search-plus"></span> Scan Payment
                                                                            </button>
                                                                            <br>
                                                                            <div class="form-group" style="text-align: center;">
                                                                                <input type="checkbox" name="notify_by" value="collected" id="notify_by_email">
                                                                                <label for="notify_by_email">Payment has been collected.</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="ach_form" style="display: none;">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <div class="input-group">
                                                                                    <input type="number" class="form-control" id="cardNumber" placeholder="Routing #"  />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <div class="input-group">
                                                                                    <input type="number" class="form-control" id="cardNumber" placeholder="Account #"  />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <select id="day_of_month_ach" class="form-control">
                                                                                    <option value="">Select Day of Month</option>
                                                                                    <?php for($x=1;$x<=31;$x++){ ?>
                                                                                        <option value="<?= $x; ?>"><?= $x; ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12" style="text-align: center !important;">
                                                                            <br>
                                                                            <button type="button" class="btn btn-sm btn-primary">
                                                                                <span class="fa fa-search-plus"></span> Scan Payment
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="cash_form" style="display: none;">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-12" style="text-align: center !important;">
                                                                            <br>

                                                                            <button type="button" class="btn btn-sm btn-primary">
                                                                                <span class="fa fa-search-plus"></span> Scan Payment
                                                                            </button>
                                                                            <br>
                                                                            <div class="form-group" style="text-align: center;">
                                                                                <input type="checkbox" name="notify_by" value="collected" id="notify_by_email">
                                                                                <label for="notify_by_email">Payment has been collected.</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="others_warranty_form" style="display: none;">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="input-group">
                                                                                    <input type="number" class="form-control" id="cardNumber" placeholder="Account Credential"  />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="input-group">
                                                                                    <textarea  class="form-control" id="cardNumber" placeholder="Account Note"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group" style="text-align: center;">
                                                                                <input type="checkbox" name="notify_by" value="collected" id="notify_by_email">
                                                                                <label for="notify_by_email">Document Signed</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="svp_form" style="display: none;">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="input-group">
                                                                                    <input type="number" class="form-control" id="cardNumber" placeholder="Account Credential"  />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="input-group">
                                                                                    <textarea  class="form-control" id="cardNumber" placeholder="Account Note"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="input-group">
                                                                                    <textarea  class="form-control" id="cardNumber" placeholder="Confirmation"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="col-md-12" style="text-align: center !important;">
                                                    <br>
                                                    <button type="button" id="save_payment" class="btn btn-sm btn-primary">
                                                        <span class="fa fa-paper-plane-o"></span> Save Payment
                                                    </button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" id="approval_card_left">
                        <div class="card-body">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button style="display: flex;" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#approval" aria-expanded="true" aria-controls="collapseOne">
                                                <h6 class="page-title"><span style="font-size: 20px;"  class="fa fa-check-circle-o"></span> Approval</h6>
                                            </button>
                                        </h2>
                                        <a href="javascript:void(0);" id="approval_btn_left"><span class="fa fa-columns" style="float: right;padding-right: 45px;font-size: 20px;display: block;margin-top: -30px;"></span></a>
                                    </div>
                                    <div id="approval" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="col-sm-12">
                                                <div style="text-align: center;">
                                                    <center>
                                                        <img width="100" id="customer-signature" alt="Customer Signature" src="/uploads/customer/16092352902893436525feafb5aae2b1.png">
                                                    </center>
                                                    <span id="authorizer">John Doe</span><br>
                                                    <span>------------------------</span><br>
                                                    <span>Approved By</span><br><br>

                                                    <small id="date_signed">Jan. 28,2021 2:30PM</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="float: right;">
                                            <a data-toggle="modal" data-target="#updateSignature" data-backdrop="static" data-keyboard="false">
                                                <span style="font-size: 20px;" class="fa fa-pencil"></span> &nbsp;
                                            </a>
                                            <!--<span style="font-size: 20px;" class="fa fa-ellipsis-v"></span> &nbsp; -->
                                        </div>
                                        <br>
                                    </div>
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
                                <a href="#step-1" type="button" class="btn btn-success btn-circle"><span style="font-size: 24px;" class="fa fa-calendar-check-o"></span></a>
                                <p class=""><small>Schedule</small></p>
                            </div>
                            <div class="stepwizard-step col-xs-3">
                                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled"><span style="font-size: 24px;" class="fa fa-ship"></span></a>
                                <p><small>OMW</small></p>
                            </div> &nbsp;&nbsp;
                            <div class="stepwizard-step col-xs-3">
                                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled"><span style="font-size: 24px;" class="fa fa-hourglass-start"></span></a>
                                <p><small>Start</small></p>
                            </div>
                            <div class="stepwizard-step col-xs-3">
                                <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled"><span style="font-size: 24px;" class="fa fa-check-circle-o"></span></a>
                                <p><small>Approved</small></p>
                            </div>
                            <div class="stepwizard-step col-xs-3">
                                <a href="#step-5" type="button" class="btn btn-default btn-circle" disabled="disabled"><span style="font-size: 24px;" class="fa fa-stop"></span></a>
                                <p><small>Finish</small></p>
                            </div>
                            <div class="stepwizard-step col-xs-3">
                                <a href="#step-6" type="button" class="btn btn-default btn-circle" disabled="disabled"><span style="font-size: 24px;" class="fa fa-paper-plane"></span></a>
                                <p><small>Invoice</small></p>
                            </div>
                            <div class="stepwizard-step col-xs-3">
                                <a href="#step-7" type="button" class="btn btn-default btn-circle" disabled="disabled">
                                    <span style="font-size: 24px;" class="fa  fa-credit-card"></span></a>
                                <p><small>Pay</small></p>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="card table-custom">

                            <div class="card-body">
                                <h6 class="page-title">&nbsp; Import Existing Estimate,Workorder or Invoice</h6>
                                <hr/>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="upload">
                                            <input id="files" type="file">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="upload workorder">
                                            <input id="files" type="file" value="Upload Workorder">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="upload invoice">
                                            <input id="files" type="file">
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary"><span class="fa fa-download"></span> Import</button>

                                <div class="col-sm-12">
                                    <hr>
                                </div>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <td>
                                            <h6>Job Items Listing</h6>
                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody id="jobs_items_table_body">
                                        <tr>
                                            <td>
                                                <small>Job Title</small>
                                                <input type="text" name="job_name" class="form-control checkDescription" >
                                            </td>
                                            <td>
                                            </td>
                                            <td>
                                                <small>Job Tags</small>
                                                <input type="text" name="job_tag" class="form-control" id="job_tags_right" readonly>
                                            </td>
                                            <td>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-primary"><span class="fa fa-paper-plane-o"  style=""></span></button>
                                                <button type="button" class="btn btn-sm btn-primary"><span class="fa fa-file"  style="color:;"></span></button>
                                                <button type="button" class="btn btn-sm btn-primary"><span class="fa fa-print" style="color:;"></span></button>
                                                <button type="button" class="btn btn-sm btn-primary"><span class="fa fa-plus"  style="color:;"></span></button>
                                            </td>
                                            <td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="35%">
                                                <small>Item name</small>
                                                <input type="text" name="item_name[]" class="form-control checkDescription" >
                                            </td>
                                            <td width="10%">
                                                <small>Qty</small>
                                                <input type="text" name="item_qty[]" class="form-control checkDescription">
                                            </td>
                                            <td width="15%">
                                                <small>Unit Price</small>
                                                <input type="text" name="item_price[]" class="form-control checkModelAmount" value="0" placeholder="Unit Price">
                                            </td>
                                            <td width="10%">
                                                <small>Unit Cost</small>
                                                <input type="text" name="item_cost[]" class="form-control checkDescription">
                                            </td>
                                            <td width="25%">
                                                <small>Inventory Location</small>
                                                <input type="text" name="item_loc[]" class="form-control checkDescription">
                                            </td>
                                            <td style="text-align: center" class="d-flex" width="15%">
                                                $00<a href="javascript:void(0)" class="remove_item_row"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="col-sm-12">
                                    <a class="link-modal-open" href="javascript:void(0)" id="add_another_item">
                                        <span class="fa fa-plus-square fa-margin-right"></span>Add Items
                                    </a>
                                </div>
                                <br>
                               <div class="col-sm-12">
                                    <p>Description of Job (optional)</p>
                                    <textarea name="job_description" class="form-control" ></textarea>
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
                                        <div class="col-sm-12" id="approval_card_right" style="display: none;">
                                            <div style="float: right;">
                                                <a href="javascript:void(0);" id="approval_btn_right"><span class="fa fa-columns" style="float: right;padding-right: 20px;"></span></a>
                                                <img width="100" id="customer_signature_right" alt="Customer Signature" src="/uploads/customer/16092352902893436525feafb5aae2b1.png">
                                                <center><span id="appoval_name_right">John Doe</span></center><br>
                                                <span>------------------------</span><br>
                                                <center><span>Approved By</span></center><br>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-sm-12">
                                            <div class="card" id="notes_right_card" style="border-color: #363636 !important;border: 1px solid;display: none;">
                                                <div class="row">
                                                    <div class="col-md-12 ">
                                                        <div class="card-header">
                                                            <a href="javascript:void(0);" id="notes_right"><span class="fa fa-columns" style="float: right;padding-right: 20px;"></span></a>
                                                            <h5 style="padding-left: 20px;" class="mb-0">Notes</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <span class="help help-sm help-block" id="notes_right_display"></span>
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
                                            <div class="card" id="url_right_card" style="border-color: #e0e0e0;border: 1px solid;display: none;">
                                                <div class="row">
                                                    <div class="col-md-12 ">
                                                        <div class="card-header">
                                                            <a id="url_right_btn_column" href="javascript:void(0);"><span class="fa fa-columns" style="float: right;padding-right: 20px;"></span></a>
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
                                        <div class="card" id="attach_right_card" style="border-color: #e0e0e0;border: 1px solid;display: none;">
                                            <div class="row">
                                                <div class="col-md-12 ">
                                                    <div class="card-header">
                                                        <a href="javascript:void(0);" id="attach_right_btn_column"><span class="fa fa-columns" style="float: right;padding-right: 20px;"></span></a>
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
                                    <input id="signature_link" type="hidden" name="signature_link">
                                    <input id="name" type="hidden" name="authorize_name">
                                    <input id="datetime_signed" type="hidden" name="datetime_signed">
                                    <div class="col-sm-12">
                                        <button type="button" class="btn btn-primary"><span class="fa fa-search-plus"></span> Preview</button>
                                        <button type="submit" class="btn btn-primary"><span class="fa fa-calendar-check-o"></span> Schedule</button>
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="card table-custom" >
                        <div class="card-body">
                            <div class="card" id="pd_right_card" style="border-color: #363636 !important;border: 1px solid;display: none;">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="card-header">
                                            <a href="javascript:void(0);" id="pd_right"><span class="fa fa-columns" style="float: right;padding-right: 20px;"></span></a>
                                            <h5 style="padding-left: 20px;" class="mb-0">Payment Details</h5>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <b>Method</b><br>
                                                        <span class="help help-sm help-block" id="pay_method_right">Credit Card</span>
                                                    </td>
                                                    <td>
                                                        <b>Amount</b><br>
                                                        <span class="help help-sm help-block" id="pay_amount_right">0.00</span>
                                                    </td>
                                                    <td>
                                                        <b>Payment Details</b><br>
                                                        <span class="help help-sm help-block">xx</span>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card" style="border-color: #363636 !important;border: 1px solid;">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="card-header">
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
            </form>
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
                                    <input type="text" name="phone_h" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="mail_add" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" name="city" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>State</label>
                                    <input type="text" name="state" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Zip Code</label>
                                    <input type="text" name="zip_code" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
            </div>
        </div>

      </div>
      <div class="modal-footer modal-footer-detail">
        <div class="button-modal-list">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fa fa-remove"></span> Close</button>
            <button type="submit" class="btn btn-primary"><span class="fa fa-paper-plane-o"></span> Save</button>
        </div>
      </div>
        </form>
    </div>
  </div>
</div>

<!-- Signature Modal -->
<div class="modal fade" id="updateSignature" role="dialog">
    <div class="close-modal" data-dismiss="modal">&times;</div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Approval</h4>
            </div>
            <div class="modal-body">
                <label>Authorizer Name</label>
                <input type="text" name="authorizer_name" id="authorizer_name" class="form-control" >
                <br>
                <small>Signature Below</small>
                <hr>
                <div id="signature" style='border:none;'>
                    <canvas id="signature-pad" class="signature-pad" width="430px" height="230px"></canvas>
                </div>
                <textarea style="display: none;" name="data[output]" id='output'></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" id="click" class="btn btn-primary save-signature" data-dismiss="modal">
                    <span class="fa fa-paper-plane-o"></span>Save
                </button>
            </div>
        </div>
    </div>
</div>

<!-- eSgin Modal -->
<div class="modal fade" id="fill_esign" role="dialog">
    <div class="close-modal" data-dismiss="modal">&times;</div>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Fill & eSign</h4>
            </div>
            <div class="modal-body">
                <a href="<?= base_url('esign/createTemplate'); ?>" style="float: right;" class="btn btn-sm btn-primary"><span class="fa fa-plus"></span> Add New</a>
                <select name="library_template" id="library_template" class="select2LibrarySelection dropdown form-control">
                    <option>Select Library Template</option>
                    <?php if(isset($esign_templates)) : ?>
                        <?php foreach($esign_templates as $esign_template){ ?>
                            <option value="<?= $esign_template->esignLibraryTemplateId; ?>"><?= $esign_template->title; ?></option>
                        <?php } ?>
                    <?php endif; ?>
                </select>
                <br>
                <small>Template</small>
                <hr>
                <textarea id="summernote" name="template"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> Close</button>
                <button type="button" id="click" class="btn btn-primary save-signature"><span class="fa fa-paper-plane-o"></span> Save</button>
            </div>
        </div>
    </div>
</div>

<?php
add_footer_js(array(
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
    'https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js',
    'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
    'https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js',
    'assets/textEditor/summernote-bs4.js',
));
include viewPath('includes/footer');
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBK803I2sEIkUtnUPJqmyClYQy5OVV7-E4&callback=initMap&libraries=&v=weekly"></script>

<?php include viewPath('job/js/job_new_js'); ?>

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

