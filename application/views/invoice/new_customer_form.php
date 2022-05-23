<form id="frm_new_customer" name="modal-form" style="display: block;">
    <div class="validation-error" style="display: none;"></div>

    <?php if (!empty($customer)) { ?>
        <input type="hidden" name="customer_id" value="<?php echo (!empty($customer)) ? $customer->id : '' ?>">
    <?php } ?>

    <?php if (!empty($action)) { ?>
        <input type="hidden" name="action_type" value="<?php echo (!empty($action)) ? $action : '' ?>">
    <?php } ?>

    <?php if (isset($data_index)) { ?>
        <input type="hidden" name="data_index" value="<?php echo (isset($data_index)) ? $data_index : '' ?>">
    <?php } ?>

    <div class="card-body pb-0">
        <div class="row">
            <div class="col-md-12 margin-bottom-ter no-padding">
                <div class="form-group" id="customer_type_group">
                    <label for="">Customer Type</label><br/>
                    <div class="checkbox checkbox-sec margin-right my-0 mr-3">
                        <input type="radio" name="customer_type" value="Residential"
                                checked="checked" id="customer_type"
                                onchange="toggle_advance_options()">
                        <label for="customer_type"><span>Residential</span></label>
                    </div>
                    <div class="checkbox checkbox-sec margin-right my-0 mr-3">
                        <input type="radio" name="customer_type" value="Commercial" id="Commercial"
                                onchange="toggle_advance_options()">
                        <label for="Commercial"><span>Commercial</span></label>
                    </div>
                    <div class="checkbox checkbox-sec margin-right my-0">
                        <input type="radio" name="customer_type" value="Advance" id="advance"
                                onchange="toggle_advance_options()">
                        <label for="advance"><span>Advance</span></label>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pl-0 pr-0 form-group">
                <label for="contact_name">Contact Name</label>
                <input type="text" class="form-control" name="contact_name" id="contact_name"
                        required placeholder="Enter Name" autofocus
                        onChange="jQuery('#customer_name').text(jQuery(this).val());"/>
            </div>
            <div class="col-md-6 pr-0 form-group">
                <label for="contact_email">Contact Email</label>
                <input type="email" class="form-control" name="contact_email" id="contact_email"
                        placeholder="Enter Email" required/>
            </div>
            <div class="col-md-6 pl-0 pr-0 form-group">
                <label for="contact_mobile">Mobile</label>
                <input type="text" class="form-control" name="contact_mobile" id="contact_mobile"
                        placeholder="(555) 555-5555" required/>
            </div>
            <div class="col-md-6 pr-0 form-group">
                <label for="contact_phone">Phone</label>
                <input type="text" class="form-control" name="contact_phone" id="contact_phone"
                        placeholder="(555) 555-5555"/>
            </div>
        </div>

        <div class="row">
            <div class="col-auto pl-0 form-group">
                <label for="">Preferred notification method</label><br/>
                <div class="checkbox checkbox-sec margin-right my-0 mr-3">
                    <input type="checkbox" name="notify_by" value="Email" checked
                            id="notify_by_email">
                    <label for="notify_by_email"><span>Notify By Email</span></label>
                </div>
                <div class="checkbox checkbox-sec margin-right my-0 mr-3">
                    <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                    <label for="notify_by_sms"><span>Notify By SMS/Text</span></label>
                </div>
            </div>
        </div>
        <div class="row">
            <a class="link-modal-open" href="javascript:void(0)" id="hide_more_info" style="display:none;">
            <span class="fa fa-minus fa-margin-right"></span>Add More Info</a>
            <a class="link-modal-open" href="javascript:void(0)" id="show_more_info">
            <span class="fa fa-plus fa-margin-right"></span>Add More Info</a>
        </div>
        <div id="customer_additional_info" style="display: none;">
            <div class="row pt-3">
                <div class="col-md-6 pl-0 pr-0 form-group">
                    <label for="street_address">Street Address</label>
                    <input type="text" class="form-control" name="street_address" id="street_address"
                            required placeholder="Enter Name" autofocus
                            onChange="jQuery('#customer_name').text(jQuery(this).val());"/>
                </div>
                <div class="col-md-6 pr-0 form-group">
                    <label for="suite_unit">Suite/Unit</label>
                    <input type="text" class="form-control" name="suite_unit" id="suite_unit" required
                            placeholder="Enter Name" autofocus
                            onChange="jQuery('#customer_name').text(jQuery(this).val());"/>
                </div>

                <div class="col-md-4 pl-0 pr-0 form-group">
                    <label for="city">City</label>
                    <input type="text" class="form-control" name="city" id="city" required
                            placeholder="Enter Name" autofocus
                            onChange="jQuery('#customer_name').text(jQuery(this).val());"/>
                </div>
                <div class="col-md-4 pr-0 form-group">
                    <label for="zip">Zip/Postal Code</label>
                    <input type="text" class="form-control" name="zip" id="zip" required
                            placeholder="Enter Name" autofocus
                            onChange="jQuery('#customer_name').text(jQuery(this).val());"/>
                </div>
                <div class="col-md-4 pr-0 form-group">
                    <label for="state">State/Province</label>
                    <select name="state" id="state" class="form-control">
                        <option value="" selected="selected">- select -</option>
                        <?php foreach (get_config_item('states') as $key => $state) { ?>
                            <option value="<?php echo $key ?>"><?php echo $state; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="row" id="advance_customer_view" style="display: none">

                <div class="row p-3">
                    <div class="col-md-12">
                        <h3>Account Information</h3>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="monitoring_id">Monitoring ID</label>
                        <input type="text" class="form-control" name="additional[monitoring_id]"
                                id="monitoring_id" placeholder="Monitoring ID"
                                onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled/>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="signal_confirmation_number">Signals Confirmation Number</label>
                        <input type="text" class="form-control"
                                name="additional[signal_confirmation_number]"
                                id="signal_confirmation_number"
                                placeholder="Enter Signals Confirmation Number"
                                onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled/>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="monitoring_confirmation">Monitoring Confirmation</label>
                        <input type="text" class="form-control"
                                name="additional[monitoring_confirmation]" id="monitoring_confirmation"
                                placeholder="Enter Monitoring Confirmation"
                                onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled/>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="customer_language">Language</label>
                        <select id="customer_language" name="additional[customer_language]"
                                class="form-control" placeholder="Select Language" disabled>
                            <option value="0">- none -</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="abort_code">Abort Code</label>
                        <input type="text" class="form-control" name="additional[abort_code]"
                                id="abort_code" placeholder="Enter Abort Code"
                                onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled/>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-md-6 form-group">
                        <label for="sales_rep">Sales Representative</label>
                        <input type="text" class="form-control" name="additional[sales_rep]"
                                id="sales_rep" placeholder="Enter Sales Representative"
                                onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled/>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="sales_rep_phone">Representative Phone Number</label>
                        <input type="text" class="form-control" name="additional[sales_rep_phone]"
                                id="sales_rep_phone" placeholder="Enter Phone Number"
                                onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled/>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="technician">Technician</label>
                        <input type="text" class="form-control" name="additional[technician]"
                                id="technician" placeholder="Enter Technician"
                                onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled/>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="technician_phone">Technician Phone Number</label>
                        <input type="text" class="form-control" name="additional[technician_phone]"
                                id="technician_phone" placeholder="Enter Technician Phone Number"
                                onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled/>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-md-4 form-group">
                        <label for="install_date">Install Date</label>
                        <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" name="additional[install_date]"
                                    id="install_date" disabled>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 form-group">
                        <div data-calendar="time-end-container">
                            <label for="technician_arrival_time">Technician Arrival Time</label>
                            <div class="form-group">
                                <div class='input-group date timepicker'>
                                    <input type='text' name="additional[technician_arrival_time]"
                                            class="form-control" id="technician_arrival_time" disabled/>
                                </div>
                            </div>
                            <span class="validation-error-field" data-formerrors-for-name="time_end"
                                    data-formerrors-message="true" style="display: none;"></span>
                        </div>
                    </div>
                    <div class="col-md-4 form-group">
                        <div data-calendar="time-end-container">
                            <label for="technician_departure_time">Technician Departure Time</label>
                            <div class="form-group">
                                <div class='input-group date timepicker'>
                                    <input type='text' name="additional[technician_departure_time]"
                                            class="form-control" id="technician_departure_time"
                                            disabled/>
                                </div>
                            </div>
                            <span class="validation-error-field" data-formerrors-for-name="time_end"
                                    data-formerrors-message="true" style="display: none;"></span>
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="panel_type">Panel Type</label>
                        <input type="text" class="form-control" name="additional[panel_type]"
                                id="panel_type" placeholder="Enter Panel Type"
                                onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled/>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="system_type">System Type</label>
                        <input type="text" class="form-control" name="additional[system_type]"
                                id="system_type" placeholder="Enter System Type"
                                onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled/>
                    </div>
                </div>


                <div class="row p-3">
                    <div class="col-md-12">
                        <h3>Credit Card Information</h3>
                    </div>
                    <div class=" col-md-12">
                        Credit Card Type:
                        <div class="checkbox checkbox-sec card-types margin-right mr-4">
                            <input type="radio" name="card[radio_credit_card]" value="Visa"
                                    checked="checked" id="radio_credit_card" disabled>
                            <label for="radio_credit_card"><span>Visa</span></label>
                        </div>
                        <div class="checkbox checkbox-sec margin-right mr-4">
                            <input type="radio" name="card[radio_credit_card]" value="Amex"
                                    id="radio_credit_cardAmex" disabled>
                            <label for="radio_credit_cardAmex"><span>Amex</span></label>
                        </div>
                        <div class="checkbox checkbox-sec margin-right mr-4">
                            <input type="radio" name="card[radio_credit_card]" value="Mastercard"
                                    id="radio_credit_cardMastercard" disabled>
                            <label for="radio_credit_cardMastercard"><span>Mastercard</span></label>
                        </div>
                        <div class="checkbox checkbox-sec margin-right mr-4">
                            <input type="radio" name="card[radio_credit_card]" value="Discover"
                                    id="radio_credit_cardMasterDiscover" disabled>
                            <label for="radio_credit_cardMasterDiscover"><span>Discover</span></label>
                        </div>

                    </div>
                    <div class=" col-md-12">
                        <div class="row" style="border:none; margin-bottom:20px; padding-bottom:0px;">
                            <div class=" col-md-6">
                                <label for="card_no">Card Number</label>
                                <input type="text" class="form-control card-number required"
                                        name="card[card_no]" id="card_no" placeholder="" required
                                        disabled/>
                            </div>
                            <div class="col-md-2">
                                <label class='form-label'>Expiration Month</label>
                                <input class='form-control card-expiry-month required'
                                        name="card[exp_month]" maxlength="256" placeholder='MM' size='2'
                                        min="1" max="12" value="" type='number' required disabled/>
                            </div>
                            <div class=" col-md-2">
                                <label for="exp_date">Expiration year</label>
                                <input type="text" class="form-control card-expiry-year required"
                                        name="card[exp_date]" id="exp_date" min="<?php echo date('Y') ?>"
                                        max="<?php echo date(Y) + 50 ?>" placeholder="" required
                                        disabled/>
                            </div>
                            <div class=" col-md-2">
                                <label for="cvv">CVV#</label>
                                <input type="text" class="form-control card-cvc required"
                                        name="card[cvv]" id="cvv" placeholder="" required disabled/>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>