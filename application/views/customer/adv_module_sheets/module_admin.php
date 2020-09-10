<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class=" module_ac" style="top:-420px;">
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
                    <input type="text" class="form-control" name="entered_by" id="entered_by"  />
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
                    <input type="text" class="form-control" name="custom_field1_admin" id="custom_field1_admin" />
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
                    <select id="sales_rep_admin" name="sales_rep_admin" data-customer-source="dropdown" class="form-control searchable-dropdown" >
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
                    <input type="text" class="form-control" name="custom_field2_admin" id="custom_field2_admin" />
                </div>
            </div>
        </div>
    </div>
</div>