<div class="full-screen-modal">
    <div id="time_activity_settings_modal">
        <div class="content">
            <div class="settings-modal-header">
                <div class="title">Choose what you use</div>
                <div class="close-button"><img
                        src="<?=base_url('assets/img/accounting/customers/close.png')?>"
                        alt="" style="width: 100px;"></div>
            </div>

            <div class="settings-modal-body">
                <div class="label">
                    Changes you make here apply to all timesheets
                </div>
                <div class="options">
                    <div class="form-check">
                        <div class="checkbox checkbox-sec margin-right">
                            <input type="checkbox" name="show_service" id="show_service" checked>
                            <label for="show_service"><span>Show service</span></label>
                        </div>
                    </div>
                    <div class="form-check">
                        <div class="checkbox checkbox-sec margin-right">
                            <input type="checkbox" name="make_time_activity_billable" id="make_time_activity_billable"
                                checked>
                            <label for="make_time_activity_billable"><span>Make time activities billable</span></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="time_activity_modal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">
                        <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                        Time Activity
                    </div>
                    <button type="button" class="close" id="closeModalExpense" data-dismiss="modal"
                        aria-label="Close"><i class="fa fa-times fa-lg"></i></button>
                    <button type="button" class="settings" id=""><i class="fa fa-cog" aria-hidden="true"></i>
                    </button>
                </div>
                <form action="#" method="post">
                    <input type="text" name="time_activity_id" style="display: none;">
                    <input type="text" name="show_services" value="1" style="display: none;">
                    <input type="text" name="make_time_activity_billable" value="1" style="display: none;">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="label">Date</div>
                                            <input type="date" class=""
                                                value="<?=date('Y-m-d')?>"
                                                name="date" required="">
                                        </div>
                                        <div class="form-group">
                                            <div class="label">Name</div>
                                            <select class="form-control required" name="vendors" required="">
                                                <?php
                                                foreach ($vendors as $vendor) {
                                                    echo '<option value="'.$vendor->vendor_id.'">'.$vendor->vendor_name.'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="label">Customer</div>
                                            <select class="form-control required" name="customer_id" required="">
                                                <option selected disabled></option>
                                                <?php
                                                foreach ($customers as $customer) {
                                                    echo '<option value="'.$customer->prof_id.'">'.$customer->first_name.' '.$customer->last_name.'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="services-section">
                                            <div class="form-group">
                                                <div class="label">Service</div>
                                                <select class="form-control" name="services" required="">
                                                    <option selected disabled></option>
                                                    <?php
                                                    foreach ($services as $items) {
                                                        echo '<option value="'.$items->id.'">'.$items->title.'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="make_time_activity_billable_section">
                                            <div class="billable-section">
                                                <div class="form-check">
                                                    <div class="checkbox checkbox-sec margin-right float-left">
                                                        <input type="checkbox" name="billable"
                                                            id="time_activity_billable" checked>
                                                        <label for="time_activity_billable"><span>Billable
                                                                (/hr)</span></label>
                                                    </div>
                                                    <div class="amount-part">
                                                        <div class="form-group">
                                                            <input type="text" value="0.0" required=""
                                                                name="billable-amount"
                                                                style="text-align: right;width: 70px!important;font-weight: 600;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="taxable-section">
                                                <div class="form-check">
                                                    <div class="checkbox checkbox-sec margin-right">
                                                        <input type="checkbox" name="taxable" id="time_activity_taxable"
                                                            checked>
                                                        <label for="time_activity_taxable"><span>Taxable</span></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="state-end-date-time-section">
                                            <div class="form-sec">
                                                <div class="label-part">

                                                </div>
                                                <div class="form-field-part">
                                                    <div class="form-check">
                                                        <div class="checkbox checkbox-sec margin-right">
                                                            <input type="checkbox" name="enter-start-end-times"
                                                                id="enter-start-end-times">
                                                            <label for="enter-start-end-times"><span>Enter Start and End
                                                                    Times</span></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-sec time-start-end">
                                                <div class="label-part no-height">
                                                    Time
                                                </div>
                                                <div class="form-field-part">
                                                    <div class="start-time-end-part" style="display: none;">
                                                        <div class="form-group">
                                                            <input type="time" class=""
                                                                value="<?=date('Y-m-d')?>"
                                                                name="start-time">
                                                            <div class="label">Start Time</div>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="time" class=""
                                                                value="<?=date('Y-m-d')?>"
                                                                name="end-time">
                                                            <div class="label">End Time</div>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" placeholder="hh:mm"
                                                                name="break-duration">
                                                            <div class="label">Break</div>
                                                        </div>
                                                    </div>
                                                    <div class="time-duration-part">
                                                        <div class="form-group">
                                                            <input type="text" placeholder="hh:mm" name="time-duration">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-sec">
                                                <div class="label-part">
                                                    Description
                                                </div>
                                                <div class="form-field-part">
                                                    <div class="form-group">
                                                        <textarea name="description" class="required" rows="6"
                                                            spellcheck="false" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-sec sumary-sec">
                                                <div class="label-part">
                                                    Sumary
                                                </div>
                                                <div class="form-field-part">
                                                    <div class="summary">
                                                        <span class="time_duration">1 hour</span>
                                                        at <span class="bill_per_hour">$900.00</span> per hour =
                                                        <span class="amount_billable">$900.00</span>
                                                    </div>
                                                    <div class="summary-error">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <hr> -->
                    <div class="modal-footer-check">
                        <div class="row">
                            <div class="col-md-4">
                                <button class="btn btn-dark cancel-button" id="closeCheckModal" type="button"
                                    data-dismiss="modal" aria-label="Close">Cancel</button>
                            </div>
                            <div class="col-md-5" align="center">
                            </div>
                            <div class="col-md-3">
                                <div class="dropdown" style="float: right">
                                    <button class="btn btn-dark cancel-button px-4" data-action="save"
                                        data-submit-type="save" type="submit">Save</button>
                                    <button type="submit" data-submit-type="save-new" data-action="save"
                                        class="btn btn-success" id="checkSaved"
                                        style="border-radius: 20px 0 0 20px">Save and new</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown"
                                        style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span>&nbsp;</button>
                                    <ul class="dropdown-menu dropdown-menu-right submit-submenu" role="menu">
                                        <li>
                                            <button type="submit" data-submit-type="save-close" data-action="save"
                                                id="checkSaved" style="background: none;border: none; height: auto;font-size: 13px;padding: 10px;
                                                ">Save and close</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div style="margin: auto;">
                    <span style="font-size: 14px"><i class="fa fa-lock fa-lg"
                            style="color: rgb(225,226,227);margin-right: 15px"></i>At nSmartrac, the privacy and
                        security of your information are top priorities.</span>
                </div>
                <div style="margin: auto">
                    <a href="" style="text-align: center">Privacy</a>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</div>