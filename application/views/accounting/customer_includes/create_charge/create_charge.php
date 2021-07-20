<div class="full-screen-modal">
    <div id="create_charge_modal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">
                        <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                        Delayed Charge
                    </div>
                    <button type="button" class="close" id="closeModalExpense" data-dismiss="modal"
                        aria-label="Close"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <form action="#" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="recurring-form-part">
                                    <div class="recurring-title" style="margin-bottom: 10px;">Recurring Delayed Charge
                                    </div>
                                    <div class="row no-margin">
                                        <div class="col-md-12 no-padding">
                                            <div class="row no-margin">
                                                <div class="col-md-3  no-padding">
                                                    Template name
                                                    <input type="text" class="form-control"
                                                        name="recurring-template-name">
                                                </div>
                                                <div class="col-md-9">
                                                    <div>Type</div>
                                                    <div class="recurring-type">
                                                        <select class="form-control" name="recurring-type">
                                                            <option>Schedule</option>
                                                            <option>Reminder</option>
                                                            <option>Unschedule</option>
                                                        </select>
                                                    </div>
                                                    <div class="schedule-type">
                                                        <div class="recuring-label-type">
                                                            Create
                                                        </div>
                                                        <div class="recurring-days-in-advance">
                                                            <input type="number" class="form-control"
                                                                name="recurring-days-in-advance">
                                                        </div>
                                                        <div class="recuring-label-recurring-days-in-advance">
                                                            days in advance
                                                        </div>
                                                    </div>
                                                    <div class="reminder-type" style="display: none;">
                                                        <div class="label-1">
                                                            Remind
                                                        </div>
                                                        <div class="remind-days-before">
                                                            <input type="number" class="form-control"
                                                                name="remind-days-before">
                                                        </div>
                                                        <div class="label-2">
                                                            days before the transaction date
                                                        </div>
                                                    </div>

                                                    <div class="unschedule-type" style="display: none;">
                                                        <div class="label-1">
                                                            Unscheduled transactions don’t have timetables; you use them
                                                            as needed from the Recurring Transactions list.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="customer-info">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-3 divided">
                                            Customer
                                            <select class="form-control required" required name="customer_id"
                                                id="sel-customer2">
                                                <option></option>
                                                <?php foreach ($customers as $customer) : ?>
                                                <option
                                                    value="<?php echo $customer->prof_id; ?>"
                                                    data-text="<?php echo $customer->first_name . ' ' . $customer->last_name; ?>">
                                                    <?php echo $customer->first_name . ' ' . $customer->last_name; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="recurring-form-part below">
                            <div class="row no-margin">
                                <div class="col-md-12 no-padding">
                                    <div class="row no-margin">
                                        <div class="col-md-1  no-padding padding-tb-10">
                                            Interval
                                            <select class="form-control" name="recurring-interval">
                                                <option>Daily</option>
                                                <option>Weekly</option>
                                                <option>Monthly</option>
                                                <option>Yearly</option>
                                            </select>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="interval-part padding-tb-10">
                                                <div class="daily">
                                                    <div class="label" style="color:transparent;">transparent
                                                    </div>
                                                    <div class="label-1">every</div>
                                                    <div class="daily-days">
                                                        <input type="number" class="form-control" name="daily-days"
                                                            min="0">
                                                    </div>
                                                    <div class="label-2">day(s)</div>
                                                </div>
                                                <div class="weekly" style="display: none;">
                                                    <div class="label" style="color:transparent;">transparent
                                                    </div>
                                                    <div class="label-1">every</div>
                                                    <div class="weekly-every">
                                                        <input type="number" class="form-control" name="weekly-every"
                                                            min="0">
                                                    </div>
                                                    <div class="label-2">week(s) on</div>
                                                    <div class="weekly-weeks-on">
                                                        <select class="form-control" name="weekly-weeks-on">
                                                            <option>Monday</option>
                                                            <option>Tuesday</option>
                                                            <option>Wednesday</option>
                                                            <option>Thursday</option>
                                                            <option>Friday</option>
                                                            <option>Saturday</option>
                                                            <option>Sunday</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="yearly" style="display: none;">
                                                    <div class="label" style="color:transparent;">transparent
                                                    </div>
                                                    <div class="label-1">every</div>
                                                    <div class="yearly-month">
                                                        <select class="form-control" name="yearly-month">
                                                            <option>January</option>
                                                            <option>February</option>
                                                            <option>March</option>
                                                            <option>April</option>
                                                            <option>May</option>
                                                            <option>June</option>
                                                            <option>July</option>
                                                            <option>August</option>
                                                            <option>September</option>
                                                            <option>October</option>
                                                            <option>November</option>
                                                            <option>December</option>
                                                        </select>
                                                    </div>
                                                    <div class="yearly-day">
                                                        <select class="form-control" name="yearly-day">
                                                            <option>1st</option>
                                                            <option>2nd</option>
                                                            <option>3rd</option>
                                                            <option>4th</option>
                                                            <option>5th</option>
                                                            <option>6th</option>
                                                            <option>7th</option>
                                                            <option>8th</option>
                                                            <option>9th</option>
                                                            <option>10th</option>
                                                            <option>11th</option>
                                                            <option>12th</option>
                                                            <option>13th</option>
                                                            <option>14th</option>
                                                            <option>15th</option>
                                                            <option>16th</option>
                                                            <option>17th</option>
                                                            <option>18th</option>
                                                            <option>19th</option>
                                                            <option>20th</option>
                                                            <option>21st</option>
                                                            <option>22nd</option>
                                                            <option>23rd</option>
                                                            <option>24th</option>
                                                            <option>25th</option>
                                                            <option>26th</option>
                                                            <option>27th</option>
                                                            <option>28th</option>
                                                            <option>Last</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="monthly" style="display: none;">
                                                    <div class="label" style="color:transparent;">transparent
                                                    </div>
                                                    <div class="label-1">on</div>
                                                    <div class="monthly-day-of-week">
                                                        <select class="form-control" name="monthly-week-order">
                                                            <option>Day</option>
                                                            <option>First</option>
                                                            <option>Second</option>
                                                            <option>Second</option>
                                                            <option>Third</option>
                                                            <option>Forth</option>
                                                            <option>Last</option>
                                                        </select>
                                                    </div>
                                                    <div class="monthly-day">
                                                        <select class="form-control" name="monthly-day-of-the-week">
                                                            <option>Monday</option>
                                                            <option>Tuesday</option>
                                                            <option>Wednesday</option>
                                                            <option>Thursday</option>
                                                            <option>Friday</option>
                                                            <option>Saturday</option>
                                                            <option>Sunday</option>
                                                        </select>
                                                    </div>
                                                    <div class="label-2">of every</div>
                                                    <div class="monthly-months">
                                                        <input type="number" class="form-control" name="monthly-months"
                                                            min="0">
                                                    </div>
                                                    <div class="label-3">
                                                        months
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="date-part">
                                                <div class="input-field-1">
                                                    <div class="label">Start Date</div>
                                                    <input type="text" class="datepicker" name="recurring-start-date">
                                                </div>
                                                <div class="input-field-2">
                                                    <div class="label">End</div>
                                                    <select class="form-control" name="recurring-end-type">
                                                        <option>None</option>
                                                        <option>By</option>
                                                        <option>After</option>
                                                    </select>
                                                </div>
                                                <div class="input-field-3">
                                                    <div class="by-end-date" style="display: none;">
                                                        <div class="label">End Date</div>
                                                        <input type="text" class="datepicker" name="by-end-date">
                                                    </div>
                                                    <div class="after-occurrences" style="display: none;">
                                                        <div style="visibility: hidden;">End Date</div>
                                                        <input type="text" name="after-occurrences">
                                                        <div class="label">occurrences</div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row error-message-section" style="display: none;">
                            <div class="col-md-12">
                                <div class="error-message">
                                    <h3 class="title"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                        Something's not quite right</h3>
                                    <label for="title">Please double check your data.</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="delayed_charge_date">
                                    <div class="form-group">
                                        <label for="job_type">Delayed Charge date</label>
                                        <input type="date" class="form-control" name="delayed_charge_date" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="tags">
                                    <div class="form-group">
                                        <label for="job_type">Tags</label>
                                        <a href="#" class="manage-tags float-right">Manage Tags</a>
                                        <input type="text" class="form-control" name="tags" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <hr> -->
                    <div class="row no-margin" style="margin:0 15px;">
                        <div class="col-md-12">
                            <div class="items-section">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th width="150px">Quantity</th>
                                        <th width="150px">Price</th>
                                        <th width="150px">Discount</th>
                                        <th width="150px">Tax (Change in %)</th>
                                        <th style="text-align: right;">Total</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" style="display: none;" name="item_ids[]">
                                                <input type="text" class="form-control getItemssr required" required
                                                    name="items[]">
                                                <ul class="suggestions"></ul>
                                            </td>
                                            <td><select name="item_type[]" class="form-control">
                                                    <option value="product">Product</option>
                                                    <option value="material">Material</option>
                                                    <option value="service">Service</option>
                                                    <option value="fee">Fee</option>
                                                </select></td>
                                            <td width="150px"><input type="number"
                                                    class="form-control quantitysr required item-field-monitary"
                                                    required name="quantity[]" data-counter="0" value="">
                                            </td>
                                            <td width="150px"><input type="number"
                                                    class="form-control pricesr required item-field-monitary" required
                                                    name="price[]" data-counter="0" min="0" value=""></td>
                                            <td width="150px"><input type="number"
                                                    class="form-control discountsr required item-field-monitary"
                                                    required name="discount[]" data-counter="0" min="0" value="">
                                            </td>
                                            <td width="150px"><input type="text" class="form-control"
                                                    data-itemfieldtype="tax" required name="tax[]" data-type="tax"
                                                    data-counter="0" min="0" value="">
                                                <input type="text" class="tax-hide" name="tax_percent[]" value="7.5"
                                                    type="hidden">
                                            </td>
                                            <td width="150px" style="text-align: right;"><input type="hidden"
                                                    class="form-control total_per_input" name="total[]" data-counter="0"
                                                    min="0" value="">
                                                $<span class="total_per_item">0.00</span></td>
                                            <td class="item-action">
                                                <a href="#" class="delete-item">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="item-buttons">
                                        <button type="button" class="default-button add-lines">
                                            Add lines
                                        </button>
                                        <button type="button" class="default-button clear-all-lines">
                                            Clear all lines
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3">
                                    <div class="item-totals">
                                        <div class="label">Total:</div>
                                        <div class="amount">$0.00</div>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-2">
                                    Memo<br>
                                    <textarea style="height:100px;width:100%;" name="memo"></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="file-upload">
                                        <button class="file-upload-btn" type="button"
                                            onclick="$('.file-upload-input').trigger( 'click' )">Attachements</button>

                                        <div class="image-upload-wrap">
                                            <input class="file-upload-input" type='file' onchange="readURL(this);"
                                                accept="image/*" />
                                            <div class="drag-text">
                                                <i>Drag and drop files here or click the icon</i>
                                            </div>
                                        </div>
                                        <div class="file-upload-content">
                                            <img class="file-upload-image" src="#" alt="your image" />
                                            <div class="image-title-wrap">
                                                <button type="button" onclick="removeUpload()"
                                                    class="remove-image">Remove <span class="image-title">Uploaded
                                                        File</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                </div>
                            </div>
                            <hr>



                        </div>

                        <hr>
                        <div class="modal-footer-check">
                            <div class="row">
                                <div class="col-md-4">
                                    <button class="btn btn-dark cancel-button" id="closeCheckModal" type="button"
                                        data-dismiss="modal" aria-label="Close">Cancel</button>
                                    <button class="btn btn-dark cancel-button" id="cancel_recurring" type="button"
                                        style="display: none;">Cancel</button>
                                    <button class="btn btn-dark cancel-button" id="clearsalereceipt"
                                        type="button">Clear</button>

                                </div>
                                <div class="col-md-5" align="center">
                                    <div class="middle-links end">
                                        <a href="">Make recurring</a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="dropdown" style="float: right">
                                        <button class="btn btn-dark cancel-button px-4" data-submit-type="save"
                                            type="submit">Save</button>
                                        <button type="submit" data-submit-type="save-send" class="btn btn-success"
                                            id="checkSaved" style="border-radius: 20px 0 0 20px">Save and send</button>
                                        <button class="btn btn-success" type="button" data-toggle="dropdown"
                                            style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                            <span class="fa fa-caret-down"></span></button>
                                        <ul class="dropdown-menu dropdown-menu-right submit-submenu" role="menu">
                                            <li>
                                                <button type="submit" data-submit-type="save-close" id="checkSaved"
                                                    style="background: none;border: none; height: auto;font-size: 13px;padding: 10px;
                                                ">Save and close</button>
                                            </li>
                                            <li>
                                                <button type="submit" data-submit-type="save-new" id="checkSaved" style="background: none;border: none; height: auto;font-size: 13px;padding: 10px;
                                                ">Save and new</button>
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