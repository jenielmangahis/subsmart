<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form method="post" id="pay-schedule-form">
    <div id="add-pay-schedule-modal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg w-75 m-auto">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Add a pay schedule</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="padding-bottom: 1.25rem">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>Select when you pay your employees</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-row border-bottom">
                                                        <div class="form-group col-md-6">
                                                            <label for="pay-frequency">Pay frequency</label>
                                                            <select name="pay_frequency" id="pay-frequency" class="form-control">
                                                                <option value="every-week">Every week</option>
                                                                <option value="every-other-week">Every other week</option>
                                                                <option value="twice-month">Twice a month</option>
                                                                <option value="every-month">Every month</option>
                                                            </select>
                                                            <div class="form-check form-check-inline mt-2 hide">
                                                                <label for="custom-schedule" class="form-check-label mr-2">Custom schedule</label><br>
                                                                <input type="checkbox" name="custom_schedule" id="custom-schedule" class="js-switch"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-12">
                                                            <div class="form-row mt-0">
                                                                <div class="form-group col-md-6">
                                                                    <label for="next-payday">Next payday</label>
                                                                    <input type="text" name="next_payday" id="next-payday" class="form-control datepicker" value="<?=date('m/d/Y', strtotime("friday"))?>">
                                                                    <p class="m-0">Friday</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-row mt-0">
                                                                <div class="form-group col-md-6">
                                                                    <label for="next-pay-period-end">End of next pay period</label>
                                                                    <input type="text" name="next_pay_period_end" id="next-pay-period-end" class="form-control datepicker" value="<?=date('m/d/Y', strtotime("wednesday"))?>">
                                                                    <p class="m-0">Wednesday</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row border-bottom hide custom-schedule-fields">
                                                        <div class="form-group col-md-6">
                                                            <h5>First pay period of the month</h5>
                                                            <label for="first_payday">First payday of the month</label>
                                                            <select name="first_payday" id="first_payday" class="form-control">
                                                                <option value="1">1st</option>
                                                                <option value="2">2nd</option>
                                                                <option value="3">3rd</option>
                                                                <option value="4">4th</option>
                                                                <option value="5">5th</option>
                                                                <option value="6">6th</option>
                                                                <option value="7">7th</option>
                                                                <option value="8">8th</option>
                                                                <option value="9">9th</option>
                                                                <option value="10">10th</option>
                                                                <option value="11">11th</option>
                                                                <option value="12">12th</option>
                                                                <option value="13">13th</option>
                                                                <option value="14">14th</option>
                                                                <option value="15">15th</option>
                                                                <option value="16">16th</option>
                                                                <option value="17">17th</option>
                                                                <option value="18">18th</option>
                                                                <option value="19">19th</option>
                                                                <option value="20">20th</option>
                                                                <option value="21">21st</option>
                                                                <option value="22">22nd</option>
                                                                <option value="23">23rd</option>
                                                                <option value="24">24th</option>
                                                                <option value="25">25th</option>
                                                                <option value="26">26th</option>
                                                                <option value="27">27th</option>
                                                                <option value="28">28th</option>
                                                                <option value="20">20th</option>
                                                                <option value="30">30th</option>
                                                                <option value="end">End of month</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="" class="w-100">End of first pay period</label>
                                                            <div class="form-check form-check-inline">
                                                                <input type="radio" name="end_of_first_pay_period" id="end_date_first_pay" class="form-check-input" value="end-date" checked>
                                                                <label for="end_date_first_pay">End date</label>
                                                                <input type="radio" name="end_of_first_pay_period" id="number_of_days_first_pay" class="form-check-input ml-2" value="number-of-days-before">
                                                                <label for="number_of_days_first_pay">Number of days before payday</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-row mt-0">
                                                                <div class="form-group col-md-6">
                                                                    <label for="first_pay_month">Month</label>
                                                                    <select name="first_pay_month" id="first_pay_month" class="form-control">
                                                                        <option value="same">Same</option>
                                                                        <option value="previous">Previous</option>
                                                                        <option value="next">Next</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group col-md-6">
                                                                    <label for="first_pay_day">Day</label>
                                                                    <select name="first_pay_day" id="first_pay_day" class="form-control">
                                                                        <option value="1">1st</option>
                                                                        <option value="2">2nd</option>
                                                                        <option value="3">3rd</option>
                                                                        <option value="4">4th</option>
                                                                        <option value="5">5th</option>
                                                                        <option value="6">6th</option>
                                                                        <option value="7">7th</option>
                                                                        <option value="8">8th</option>
                                                                        <option value="9">9th</option>
                                                                        <option value="10">10th</option>
                                                                        <option value="11">11th</option>
                                                                        <option value="12">12th</option>
                                                                        <option value="13">13th</option>
                                                                        <option value="14">14th</option>
                                                                        <option value="15">15th</option>
                                                                        <option value="16">16th</option>
                                                                        <option value="17">17th</option>
                                                                        <option value="18">18th</option>
                                                                        <option value="19">19th</option>
                                                                        <option value="20">20th</option>
                                                                        <option value="21">21st</option>
                                                                        <option value="22">22nd</option>
                                                                        <option value="23">23rd</option>
                                                                        <option value="24">24th</option>
                                                                        <option value="25">25th</option>
                                                                        <option value="26">26th</option>
                                                                        <option value="27">27th</option>
                                                                        <option value="28">28th</option>
                                                                        <option value="20">20th</option>
                                                                        <option value="30">30th</option>
                                                                        <option value="end">End of month</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row border-bottom hide custom-schedule-fields">
                                                        <div class="form-group col-md-6">
                                                            <h5>Second pay period of the month</h5>
                                                            <label for="second_payday">Second payday of the month</label>
                                                            <select name="second_payday" id="second_payday" class="form-control">
                                                                <option value="1">1st</option>
                                                                <option value="2">2nd</option>
                                                                <option value="3">3rd</option>
                                                                <option value="4">4th</option>
                                                                <option value="5">5th</option>
                                                                <option value="6">6th</option>
                                                                <option value="7">7th</option>
                                                                <option value="8">8th</option>
                                                                <option value="9">9th</option>
                                                                <option value="10">10th</option>
                                                                <option value="11">11th</option>
                                                                <option value="12">12th</option>
                                                                <option value="13">13th</option>
                                                                <option value="14">14th</option>
                                                                <option value="15">15th</option>
                                                                <option value="16">16th</option>
                                                                <option value="17">17th</option>
                                                                <option value="18">18th</option>
                                                                <option value="19">19th</option>
                                                                <option value="20">20th</option>
                                                                <option value="21">21st</option>
                                                                <option value="22">22nd</option>
                                                                <option value="23">23rd</option>
                                                                <option value="24">24th</option>
                                                                <option value="25">25th</option>
                                                                <option value="26">26th</option>
                                                                <option value="27">27th</option>
                                                                <option value="28">28th</option>
                                                                <option value="20">20th</option>
                                                                <option value="30">30th</option>
                                                                <option value="end">End of month</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="" class="w-100">End of second pay period</label>
                                                            <div class="form-check form-check-inline">
                                                                <input type="radio" name="end_of_second_pay_period" id="end_date_second_pay" class="form-check-input" value="end-date" checked>
                                                                <label for="end_date_second_pay">End date</label>
                                                                <input type="radio" name="end_of_second_pay_period" id="number_of_days_second_pay" class="form-check-input ml-2" value="number-of-days-before">
                                                                <label for="number_of_days_second_pay">Number of days before payday</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-row mt-0">
                                                                <div class="form-group col-md-6">
                                                                    <label for="second_pay_month">Month</label>
                                                                    <select name="second_pay_month" id="second_pay_month" class="form-control">
                                                                        <option value="same">Same</option>
                                                                        <option value="previous">Previous</option>
                                                                        <option value="next">Next</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group col-md-6">
                                                                    <label for="second_pay_day">Day</label>
                                                                    <select name="second_pay_day" id="second_pay_day" class="form-control">
                                                                        <option value="1">1st</option>
                                                                        <option value="2">2nd</option>
                                                                        <option value="3">3rd</option>
                                                                        <option value="4">4th</option>
                                                                        <option value="5">5th</option>
                                                                        <option value="6">6th</option>
                                                                        <option value="7">7th</option>
                                                                        <option value="8">8th</option>
                                                                        <option value="9">9th</option>
                                                                        <option value="10">10th</option>
                                                                        <option value="11">11th</option>
                                                                        <option value="12">12th</option>
                                                                        <option value="13">13th</option>
                                                                        <option value="14">14th</option>
                                                                        <option value="15">15th</option>
                                                                        <option value="16">16th</option>
                                                                        <option value="17">17th</option>
                                                                        <option value="18">18th</option>
                                                                        <option value="19">19th</option>
                                                                        <option value="20">20th</option>
                                                                        <option value="21">21st</option>
                                                                        <option value="22">22nd</option>
                                                                        <option value="23">23rd</option>
                                                                        <option value="24">24th</option>
                                                                        <option value="25">25th</option>
                                                                        <option value="26">26th</option>
                                                                        <option value="27">27th</option>
                                                                        <option value="28">28th</option>
                                                                        <option value="20">20th</option>
                                                                        <option value="30">30th</option>
                                                                        <option value="end">End of month</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <label for="name">Pay schedule name</label>
                                                            <input type="text" name="name" id="name" class="form-control w-50" value="Every Friday">
                                                            <div class="form-check form-check-inline mt-2">
                                                                <input type="checkbox" name="use_for_new_employees" id="use-for-new-emps" class="form-check-input" value="1" checked>
                                                                <label for="use-for-new-emps" class="form-check-label">Use this pay schedule for employees you add after this one</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 pay-periods">
                                                    <h6 style="margin-top: 30px">Upcoming pay periods</h6>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="card shadow">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-8">
                                                                            <p>Pay period</p>
                                                                            <p class="m-0 pay-period"><span>03/25/2021</span> - </span>03/31/2021</span></p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <p>Pay date</p>
                                                                            <p class="m-0 pay-date">04/02/2021</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card shadow">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-8">
                                                                            <p>Pay period</p>
                                                                            <p class="m-0 pay-period"><span>04/01/2021</span> - <span>04/07/2021</span></p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <p>Pay date</p>
                                                                            <p class="m-0 pay-date">04/09/2021</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card shadow">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-8">
                                                                            <p>Pay period</p>
                                                                            <p class="m-0 pay-period"><span>04/08/2021</span> - <span>04/14/2021</span></p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <p>Pay date</p>
                                                                            <p class="m-0 pay-date">04/16/2021</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card shadow">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-8">
                                                                            <p>Pay period</p>
                                                                            <p class="m-0 pay-period"><span>04/15/2021</span> - <span>04/21/2021</span></p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <p>Pay date</p>
                                                                            <p class="m-0 pay-date">04/23/2021</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-secondary">
                    <div class="row w-100">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-md-4">
                            <div class="row h-100">
                                
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- Split dropup button -->
                            <button type="submit" class="btn btn-success float-right">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</form>
</div>