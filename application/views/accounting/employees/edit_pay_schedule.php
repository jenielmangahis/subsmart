<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form method="post" id="edit-pay-schedule-form">
    <div id="edit-pay-schedule-modal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg w-75 m-auto">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Edit a pay schedule</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="padding-bottom: 1.25rem">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4 >Select when you pay your employees</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-row border-bottom">
                                                        <div class="form-group col-md-6">
                                                            <label for="pay-frequency">Pay frequency</label>
                                                            <select name="pay_frequency" id="pay-frequency" class="form-control">
                                                                <option value="every-week" <?=$paySchedule->pay_frequency === 'every-week' ? 'selected' : ''?>>Every week</option>
                                                                <option value="every-other-week" <?=$paySchedule->pay_frequency === 'every-other-week' ? 'selected' : ''?>>Every other week</option>
                                                                <option value="twice-month" <?=$paySchedule->pay_frequency === 'twice-month' ? 'selected' : ''?>>Twice a month</option>
                                                                <option value="every-month" <?=$paySchedule->pay_frequency === 'every-month' ? 'selected' : ''?>>Every month</option>
                                                            </select>
                                                            <div class="form-check form-check-inline mt-2 <?=$paySchedule->first_payday === null && !in_array($paySchedule->pay_frequency, ['twice-month', 'every-month']) ? 'hide' : ''?>">
                                                                <label for="custom-schedule" class="form-check-label mr-2">Custom schedule</label><br>
                                                                <input type="checkbox" name="custom_schedule" id="custom-schedule" class="js-switch" <?=$paySchedule->first_payday !== null ? 'selected' : ''?>/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row <?=$paySchedule->next_payday !== null && $paySchedule->first_payday === null ? '' : 'hide'?>">
                                                        <div class="col-md-12">
                                                            <div class="form-row mt-0">
                                                                <div class="form-group col-md-6">
                                                                    <label for="next-payday">Next payday</label>
                                                                    <input type="text" name="next_payday" id="next-payday" class="form-control datepicker" value="<?=$paySchedule->next_payday !== null ? date('m/d/Y', strtotime($paySchedule->next_payday)) : ''?>">
                                                                    <p class="m-0">Friday</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-row mt-0">
                                                                <div class="form-group col-md-6">
                                                                    <label for="next-pay-period-end">End of next pay period</label>
                                                                    <input type="text" name="next_pay_period_end" id="next-pay-period-end" class="form-control datepicker" value="<?=$paySchedule->next_pay_period_end !== null ? date('m/d/Y', strtotime($paySchedule->next_pay_period_end)) : ''?>">
                                                                    <p class="m-0">Wednesday</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row border-bottom custom-schedule-fields <?=$paySchedule->first_payday !== null && in_array($paySchedule->pay_frequency, ['twice-month', 'every-month']) ? '' : 'hide'?>">
                                                        <div class="form-group col-md-6">
                                                            <h5 <?=$paySchedule->pay_frequency === 'every-month' ? 'class="hide"' : ''?>>First pay period of the month</h5>
                                                            <label for="first_payday"><?=$paySchedule->pay_frequency === 'every-month' ? 'Payday of the month' : 'First payday of the month'?></label>
                                                            <select name="first_payday" id="first_payday" class="form-control">
                                                                <option value="1" <?=$paySchedule->first_payday === "1" ? 'selected' : ''?>>1st</option>
                                                                <option value="2" <?=$paySchedule->first_payday === "2" ? 'selected' : ''?>>2nd</option>
                                                                <option value="3" <?=$paySchedule->first_payday === "3" ? 'selected' : ''?>>3rd</option>
                                                                <option value="4" <?=$paySchedule->first_payday === "4" ? 'selected' : ''?>>4th</option>
                                                                <option value="5" <?=$paySchedule->first_payday === "5" ? 'selected' : ''?>>5th</option>
                                                                <option value="6" <?=$paySchedule->first_payday === "6" ? 'selected' : ''?>>6th</option>
                                                                <option value="7" <?=$paySchedule->first_payday === "7" ? 'selected' : ''?>>7th</option>
                                                                <option value="8" <?=$paySchedule->first_payday === "8" ? 'selected' : ''?>>8th</option>
                                                                <option value="9" <?=$paySchedule->first_payday === "9" ? 'selected' : ''?>>9th</option>
                                                                <option value="10" <?=$paySchedule->first_payday === "10" ? 'selected' : ''?>>10th</option>
                                                                <option value="11" <?=$paySchedule->first_payday === "11" ? 'selected' : ''?>>11th</option>
                                                                <option value="12" <?=$paySchedule->first_payday === "12" ? 'selected' : ''?>>12th</option>
                                                                <option value="13" <?=$paySchedule->first_payday === "13" ? 'selected' : ''?>>13th</option>
                                                                <option value="14" <?=$paySchedule->first_payday === "14" ? 'selected' : ''?>>14th</option>
                                                                <option value="15" <?=$paySchedule->first_payday === "15" ? 'selected' : ''?>>15th</option>
                                                                <option value="16" <?=$paySchedule->first_payday === "16" ? 'selected' : ''?>>16th</option>
                                                                <option value="17" <?=$paySchedule->first_payday === "17" ? 'selected' : ''?>>17th</option>
                                                                <option value="18" <?=$paySchedule->first_payday === "18" ? 'selected' : ''?>>18th</option>
                                                                <option value="19" <?=$paySchedule->first_payday === "19" ? 'selected' : ''?>>19th</option>
                                                                <option value="20" <?=$paySchedule->first_payday === "20" ? 'selected' : ''?>>20th</option>
                                                                <option value="21" <?=$paySchedule->first_payday === "21" ? 'selected' : ''?>>21st</option>
                                                                <option value="22" <?=$paySchedule->first_payday === "22" ? 'selected' : ''?>>22nd</option>
                                                                <option value="23" <?=$paySchedule->first_payday === "23" ? 'selected' : ''?>>23rd</option>
                                                                <option value="24" <?=$paySchedule->first_payday === "24" ? 'selected' : ''?>>24th</option>
                                                                <option value="25" <?=$paySchedule->first_payday === "25" ? 'selected' : ''?>>25th</option>
                                                                <option value="26" <?=$paySchedule->first_payday === "26" ? 'selected' : ''?>>26th</option>
                                                                <option value="27" <?=$paySchedule->first_payday === "27" ? 'selected' : ''?>>27th</option>
                                                                <option value="28" <?=$paySchedule->first_payday === "28" ? 'selected' : ''?>>28th</option>
                                                                <option value="29" <?=$paySchedule->first_payday === "29" ? 'selected' : ''?>>29th</option>
                                                                <option value="30" <?=$paySchedule->first_payday === "30" ? 'selected' : ''?>>30th</option>
                                                                <option value="0" <?=$paySchedule->first_payday === "0" ? 'selected' : ''?>>End of month</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="" class="w-100"><?=$paySchedule->pay_frequency === 'every-month' ? 'End of each pay period' : 'End of first pay period'?>End of first pay period</label>
                                                            <div class="form-check form-check-inline">
                                                                <input type="radio" name="end_of_first_pay_period" id="end_date_first_pay" class="form-check-input" value="end-date" <?=$paySchedule->end_of_first_pay_period === 'end-date' ? 'checked' : $paySchedule->end_of_first_pay_period === null ? 'checked' : ''?>>
                                                                <label for="end_date_first_pay">End date</label>
                                                                <input type="radio" name="end_of_first_pay_period" id="number_of_days_first_pay" class="form-check-input ml-2" value="number-of-days-before" <?=$paySchedule->end_of_first_pay_period === 'number-of-days-before' ? 'checked' : ''?>>
                                                                <label for="number_of_days_first_pay">Number of days before payday</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-row mt-0">
                                                                <div class="form-group col-md-6">
                                                                    <label for="first_pay_month">Month</label>
                                                                    <select name="first_pay_month" id="first_pay_month" class="form-control">
                                                                        <option value="same" <?=$paySchedule->first_pay_month === 'same' ? 'selected' : '' ?>>Same</option>
                                                                        <option value="previous" <?=$paySchedule->first_pay_month === 'previous' ? 'selected' : '' ?>>Previous</option>
                                                                        <option value="next" <?=$paySchedule->first_pay_month === 'next' ? 'selected' : '' ?>>Next</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group col-md-6">
                                                                    <label for="first_pay_day">Day</label>
                                                                    <select name="first_pay_day" id="first_pay_day" class="form-control">
                                                                        <option value="1" <?=$paySchedule->first_pay_day === '1' ? 'selected' : '' ?>>1st</option>
                                                                        <option value="2" <?=$paySchedule->first_pay_day === '2' ? 'selected' : '' ?>>2nd</option>
                                                                        <option value="3" <?=$paySchedule->first_pay_day === '3' ? 'selected' : '' ?>>3rd</option>
                                                                        <option value="4" <?=$paySchedule->first_pay_day === '4' ? 'selected' : '' ?>>4th</option>
                                                                        <option value="5" <?=$paySchedule->first_pay_day === '5' ? 'selected' : '' ?>>5th</option>
                                                                        <option value="6" <?=$paySchedule->first_pay_day === '6' ? 'selected' : '' ?>>6th</option>
                                                                        <option value="7" <?=$paySchedule->first_pay_day === '7' ? 'selected' : '' ?>>7th</option>
                                                                        <option value="8" <?=$paySchedule->first_pay_day === '8' ? 'selected' : '' ?>>8th</option>
                                                                        <option value="9" <?=$paySchedule->first_pay_day === '9' ? 'selected' : '' ?>>9th</option>
                                                                        <option value="10" <?=$paySchedule->first_pay_day === '10' ? 'selected' : '' ?>>10th</option>
                                                                        <option value="11" <?=$paySchedule->first_pay_day === '11' ? 'selected' : '' ?>>11th</option>
                                                                        <option value="12" <?=$paySchedule->first_pay_day === '12' ? 'selected' : '' ?>>12th</option>
                                                                        <option value="13" <?=$paySchedule->first_pay_day === '13' ? 'selected' : '' ?>>13th</option>
                                                                        <option value="14" <?=$paySchedule->first_pay_day === '14' ? 'selected' : '' ?>>14th</option>
                                                                        <option value="15" <?=$paySchedule->first_pay_day === '15' ? 'selected' : '' ?>>15th</option>
                                                                        <option value="16" <?=$paySchedule->first_pay_day === '16' ? 'selected' : '' ?>>16th</option>
                                                                        <option value="17" <?=$paySchedule->first_pay_day === '17' ? 'selected' : '' ?>>17th</option>
                                                                        <option value="18" <?=$paySchedule->first_pay_day === '18' ? 'selected' : '' ?>>18th</option>
                                                                        <option value="19" <?=$paySchedule->first_pay_day === '19' ? 'selected' : '' ?>>19th</option>
                                                                        <option value="20" <?=$paySchedule->first_pay_day === '20' ? 'selected' : '' ?>>20th</option>
                                                                        <option value="21" <?=$paySchedule->first_pay_day === '21' ? 'selected' : '' ?>>21st</option>
                                                                        <option value="22" <?=$paySchedule->first_pay_day === '22' ? 'selected' : '' ?>>22nd</option>
                                                                        <option value="23" <?=$paySchedule->first_pay_day === '23' ? 'selected' : '' ?>>23rd</option>
                                                                        <option value="24" <?=$paySchedule->first_pay_day === '24' ? 'selected' : '' ?>>24th</option>
                                                                        <option value="25" <?=$paySchedule->first_pay_day === '25' ? 'selected' : '' ?>>25th</option>
                                                                        <option value="26" <?=$paySchedule->first_pay_day === '26' ? 'selected' : '' ?>>26th</option>
                                                                        <option value="27" <?=$paySchedule->first_pay_day === '27' ? 'selected' : '' ?>>27th</option>
                                                                        <option value="28" <?=$paySchedule->first_pay_day === '28' ? 'selected' : '' ?>>28th</option>
                                                                        <option value="29" <?=$paySchedule->first_pay_day === '29' ? 'selected' : '' ?>>29th</option>
                                                                        <option value="30" <?=$paySchedule->first_pay_day === '30' ? 'selected' : '' ?>>30th</option>
                                                                        <option value="0" <?=$paySchedule->first_pay_day === '0' ? 'selected' : '' ?>>End of month</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group col-md-12 hide">
                                                                    <label for="first_pay_days_before">Days before payday</label>
                                                                    <select name="first_pay_days_before" id="first_pay_days_before" class="form-control">
                                                                        <option value="1" <?=$paySchedule->first_pay_days_before === '1' ? 'selected' : '' ?>>1</option>
                                                                        <option value="2" <?=$paySchedule->first_pay_days_before === '2' ? 'selected' : '' ?>>2</option>
                                                                        <option value="3" <?=$paySchedule->first_pay_days_before === '3' ? 'selected' : '' ?>>3</option>
                                                                        <option value="4" <?=$paySchedule->first_pay_days_before === '4' ? 'selected' : '' ?>>4</option>
                                                                        <option value="5" <?=$paySchedule->first_pay_days_before === '5' ? 'selected' : '' ?>>5</option>
                                                                        <option value="6" <?=$paySchedule->first_pay_days_before === '6' ? 'selected' : '' ?>>6</option>
                                                                        <option value="7" <?=$paySchedule->first_pay_days_before === '7' ? 'selected' : '' ?>>7</option>
                                                                        <option value="8" <?=$paySchedule->first_pay_days_before === '8' ? 'selected' : '' ?>>8</option>
                                                                        <option value="9" <?=$paySchedule->first_pay_days_before === '9' ? 'selected' : '' ?>>9</option>
                                                                        <option value="10" <?=$paySchedule->first_pay_days_before === '10' ? 'selected' : '' ?>>10</option>
                                                                        <option value="11" <?=$paySchedule->first_pay_days_before === '11' ? 'selected' : '' ?>>11</option>
                                                                        <option value="12" <?=$paySchedule->first_pay_days_before === '12' ? 'selected' : '' ?>>12</option>
                                                                        <option value="13" <?=$paySchedule->first_pay_days_before === '13' ? 'selected' : '' ?>>13</option>
                                                                        <option value="14" <?=$paySchedule->first_pay_days_before === '14' ? 'selected' : '' ?>>14</option>
                                                                        <option value="15" <?=$paySchedule->first_pay_days_before === '15' ? 'selected' : '' ?>>15</option>
                                                                        <option value="16" <?=$paySchedule->first_pay_days_before === '16' ? 'selected' : '' ?>>16</option>
                                                                        <option value="17" <?=$paySchedule->first_pay_days_before === '17' ? 'selected' : '' ?>>17</option>
                                                                        <option value="18" <?=$paySchedule->first_pay_days_before === '18' ? 'selected' : '' ?>>18</option>
                                                                        <option value="19" <?=$paySchedule->first_pay_days_before === '19' ? 'selected' : '' ?>>19</option>
                                                                        <option value="20" <?=$paySchedule->first_pay_days_before === '20' ? 'selected' : '' ?>>20</option>
                                                                        <option value="21" <?=$paySchedule->first_pay_days_before === '21' ? 'selected' : '' ?>>21</option>
                                                                        <option value="22" <?=$paySchedule->first_pay_days_before === '22' ? 'selected' : '' ?>>22</option>
                                                                        <option value="23" <?=$paySchedule->first_pay_days_before === '23' ? 'selected' : '' ?>>23</option>
                                                                        <option value="24" <?=$paySchedule->first_pay_days_before === '24' ? 'selected' : '' ?>>24</option>
                                                                        <option value="25" <?=$paySchedule->first_pay_days_before === '25' ? 'selected' : '' ?>>25</option>
                                                                        <option value="26" <?=$paySchedule->first_pay_days_before === '26' ? 'selected' : '' ?>>26</option>
                                                                        <option value="27" <?=$paySchedule->first_pay_days_before === '27' ? 'selected' : '' ?>>27</option>
                                                                        <option value="28" <?=$paySchedule->first_pay_days_before === '28' ? 'selected' : '' ?>>28</option>
                                                                        <option value="20" <?=$paySchedule->first_pay_days_before === '29' ? 'selected' : '' ?>>20</option>
                                                                        <option value="30" <?=$paySchedule->first_pay_days_before === '30' ? 'selected' : '' ?>>30</option>
                                                                        <option value="-9" <?=$paySchedule->first_pay_days_before === '-9' ? 'selected' : '' ?>>-9</option>
                                                                        <option value="-8" <?=$paySchedule->first_pay_days_before === '-8' ? 'selected' : '' ?>>-8</option>
                                                                        <option value="-7" <?=$paySchedule->first_pay_days_before === '-7' ? 'selected' : '' ?>>-7</option>
                                                                        <option value="-6" <?=$paySchedule->first_pay_days_before === '-6' ? 'selected' : '' ?>>-6</option>
                                                                        <option value="-5" <?=$paySchedule->first_pay_days_before === '-5' ? 'selected' : '' ?>>-5</option>
                                                                        <option value="-4" <?=$paySchedule->first_pay_days_before === '-4' ? 'selected' : '' ?>>-4</option>
                                                                        <option value="-3" <?=$paySchedule->first_pay_days_before === '-3' ? 'selected' : '' ?>>-3</option>
                                                                        <option value="-2" <?=$paySchedule->first_pay_days_before === '-2' ? 'selected' : '' ?>>-2</option>
                                                                        <option value="-1" <?=$paySchedule->first_pay_days_before === '-1' ? 'selected' : '' ?>>-1</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row border-bottom custom-schedule-fields <?=$paySchedule->pay_frequency === 'twice-month' && $paySchedule->first_payday !== null ? '' : 'hide'?>">
                                                        <div class="form-group col-md-6">
                                                            <h5>Second pay period of the month</h5>
                                                            <label for="second_payday">Second payday of the month</label>
                                                            <select name="second_payday" id="second_payday" class="form-control">
                                                                <option value="1" <?=$paySchedule->second_payday === '1' ? 'selected' : '' ?>>1st</option>
                                                                <option value="2" <?=$paySchedule->second_payday === '2' ? 'selected' : '' ?>>2nd</option>
                                                                <option value="3" <?=$paySchedule->second_payday === '3' ? 'selected' : '' ?>>3rd</option>
                                                                <option value="4" <?=$paySchedule->second_payday === '4' ? 'selected' : '' ?>>4th</option>
                                                                <option value="5" <?=$paySchedule->second_payday === '5' ? 'selected' : '' ?>>5th</option>
                                                                <option value="6" <?=$paySchedule->second_payday === '6' ? 'selected' : '' ?>>6th</option>
                                                                <option value="7" <?=$paySchedule->second_payday === '7' ? 'selected' : '' ?>>7th</option>
                                                                <option value="8" <?=$paySchedule->second_payday === '8' ? 'selected' : '' ?>>8th</option>
                                                                <option value="9" <?=$paySchedule->second_payday === '9' ? 'selected' : '' ?>>9th</option>
                                                                <option value="10" <?=$paySchedule->second_payday === '10' ? 'selected' : '' ?>>10th</option>
                                                                <option value="11" <?=$paySchedule->second_payday === '11' ? 'selected' : '' ?>>11th</option>
                                                                <option value="12" <?=$paySchedule->second_payday === '12' ? 'selected' : '' ?>>12th</option>
                                                                <option value="13" <?=$paySchedule->second_payday === '13' ? 'selected' : '' ?>>13th</option>
                                                                <option value="14" <?=$paySchedule->second_payday === '14' ? 'selected' : '' ?>>14th</option>
                                                                <option value="15" <?=$paySchedule->second_payday === '15' ? 'selected' : '' ?>>15th</option>
                                                                <option value="16" <?=$paySchedule->second_payday === '16' ? 'selected' : $paySchedule->second_payday === null ? 'selected' : '' ?>>16th</option>
                                                                <option value="17" <?=$paySchedule->second_payday === '17' ? 'selected' : '' ?>>17th</option>
                                                                <option value="18" <?=$paySchedule->second_payday === '18' ? 'selected' : '' ?>>18th</option>
                                                                <option value="19" <?=$paySchedule->second_payday === '19' ? 'selected' : '' ?>>19th</option>
                                                                <option value="20" <?=$paySchedule->second_payday === '20' ? 'selected' : '' ?>>20th</option>
                                                                <option value="21" <?=$paySchedule->second_payday === '21' ? 'selected' : '' ?>>21st</option>
                                                                <option value="22" <?=$paySchedule->second_payday === '22' ? 'selected' : '' ?>>22nd</option>
                                                                <option value="23" <?=$paySchedule->second_payday === '23' ? 'selected' : '' ?>>23rd</option>
                                                                <option value="24" <?=$paySchedule->second_payday === '24' ? 'selected' : '' ?>>24th</option>
                                                                <option value="25" <?=$paySchedule->second_payday === '25' ? 'selected' : '' ?>>25th</option>
                                                                <option value="26" <?=$paySchedule->second_payday === '26' ? 'selected' : '' ?>>26th</option>
                                                                <option value="27" <?=$paySchedule->second_payday === '27' ? 'selected' : '' ?>>27th</option>
                                                                <option value="28" <?=$paySchedule->second_payday === '28' ? 'selected' : '' ?>>28th</option>
                                                                <option value="29" <?=$paySchedule->second_payday === '29' ? 'selected' : '' ?>>29th</option>
                                                                <option value="30" <?=$paySchedule->second_payday === '30' ? 'selected' : '' ?>>30th</option>
                                                                <option value="0" <?=$paySchedule->second_payday === '0' ? 'selected' : '' ?>>End of month</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="" class="w-100">End of second pay period</label>
                                                            <div class="form-check form-check-inline">
                                                                <input type="radio" name="end_of_second_pay_period" id="end_date_second_pay" class="form-check-input" value="end-date" <?=$paySchedule->end_of_second_pay_period === 'end-date' ? 'checked' : $paySchedule->end_of_second_pay_period === null ? 'checked' : ''?>>
                                                                <label for="end_date_second_pay">End date</label>
                                                                <input type="radio" name="end_of_second_pay_period" id="number_of_days_second_pay" class="form-check-input ml-2" value="number-of-days-before" <?=$paySchedule->end_of_second_pay_period === 'number-of-days-before' ? 'checked' : ''?>>
                                                                <label for="number_of_days_second_pay">Number of days before payday</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-row mt-0">
                                                                <div class="form-group col-md-6">
                                                                    <label for="second_pay_month">Month</label>
                                                                    <select name="second_pay_month" id="second_pay_month" class="form-control">
                                                                        <option value="same" <?=$paySchedule->second_pay_month === 'same' ? 'selected' : ''?>>Same</option>
                                                                        <option value="previous" <?=$paySchedule->second_pay_month === 'previous' ? 'selected' : ''?>>Previous</option>
                                                                        <option value="next" <?=$paySchedule->second_pay_month === 'next' ? 'selected' : ''?>>Next</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group col-md-6">
                                                                    <label for="second_pay_day">Day</label>
                                                                    <select name="second_pay_day" id="second_pay_day" class="form-control">
                                                                        <option value="1" <?=$paySchedule->second_pay_day === '1' ? 'selected' : ''?>>1st</option>
                                                                        <option value="2" <?=$paySchedule->second_pay_day === '2' ? 'selected' : ''?>>2nd</option>
                                                                        <option value="3" <?=$paySchedule->second_pay_day === '3' ? 'selected' : ''?>>3rd</option>
                                                                        <option value="4" <?=$paySchedule->second_pay_day === '4' ? 'selected' : ''?>>4th</option>
                                                                        <option value="5" <?=$paySchedule->second_pay_day === '5' ? 'selected' : ''?>>5th</option>
                                                                        <option value="6" <?=$paySchedule->second_pay_day === '6' ? 'selected' : ''?>>6th</option>
                                                                        <option value="7" <?=$paySchedule->second_pay_day === '7' ? 'selected' : ''?>>7th</option>
                                                                        <option value="8" <?=$paySchedule->second_pay_day === '8' ? 'selected' : ''?>>8th</option>
                                                                        <option value="9" <?=$paySchedule->second_pay_day === '9' ? 'selected' : ''?>>9th</option>
                                                                        <option value="10" <?=$paySchedule->second_pay_day === '10' ? 'selected' : ''?>>10th</option>
                                                                        <option value="11" <?=$paySchedule->second_pay_day === '11' ? 'selected' : ''?>>11th</option>
                                                                        <option value="12" <?=$paySchedule->second_pay_day === '12' ? 'selected' : ''?>>12th</option>
                                                                        <option value="13" <?=$paySchedule->second_pay_day === '13' ? 'selected' : ''?>>13th</option>
                                                                        <option value="14" <?=$paySchedule->second_pay_day === '14' ? 'selected' : ''?>>14th</option>
                                                                        <option value="15" <?=$paySchedule->second_pay_day === '15' ? 'selected' : ''?>>15th</option>
                                                                        <option value="16" <?=$paySchedule->second_pay_day === '16' ? 'selected' : $paySchedule->second_pay_day === null ? 'selected' : ''?>>16th</option>
                                                                        <option value="17" <?=$paySchedule->second_pay_day === '17' ? 'selected' : ''?>>17th</option>
                                                                        <option value="18" <?=$paySchedule->second_pay_day === '18' ? 'selected' : ''?>>18th</option>
                                                                        <option value="19" <?=$paySchedule->second_pay_day === '19' ? 'selected' : ''?>>19th</option>
                                                                        <option value="20" <?=$paySchedule->second_pay_day === '20' ? 'selected' : ''?>>20th</option>
                                                                        <option value="21" <?=$paySchedule->second_pay_day === '21' ? 'selected' : ''?>>21st</option>
                                                                        <option value="22" <?=$paySchedule->second_pay_day === '22' ? 'selected' : ''?>>22nd</option>
                                                                        <option value="23" <?=$paySchedule->second_pay_day === '23' ? 'selected' : ''?>>23rd</option>
                                                                        <option value="24" <?=$paySchedule->second_pay_day === '24' ? 'selected' : ''?>>24th</option>
                                                                        <option value="25" <?=$paySchedule->second_pay_day === '25' ? 'selected' : ''?>>25th</option>
                                                                        <option value="26" <?=$paySchedule->second_pay_day === '26' ? 'selected' : ''?>>26th</option>
                                                                        <option value="27" <?=$paySchedule->second_pay_day === '27' ? 'selected' : ''?>>27th</option>
                                                                        <option value="28" <?=$paySchedule->second_pay_day === '28' ? 'selected' : ''?>>28th</option>
                                                                        <option value="29" <?=$paySchedule->second_pay_day === '29' ? 'selected' : ''?>>29th</option>
                                                                        <option value="30" <?=$paySchedule->second_pay_day === '30' ? 'selected' : ''?>>30th</option>
                                                                        <option value="0" <?=$paySchedule->second_pay_day === '0' ? 'selected' : ''?>>End of month</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group col-md-12 hide">
                                                                    <label for="second_pay_days_before">Days before payday</label>
                                                                    <select name="second_pay_days_before" id="second_pay_days_before" class="form-control">
                                                                        <option value="1" <?=$paySchedule->second_pay_days_before === '1' ? 'selected' : ''?>>1</option>
                                                                        <option value="2" <?=$paySchedule->second_pay_days_before === '2' ? 'selected' : ''?>>2</option>
                                                                        <option value="3" <?=$paySchedule->second_pay_days_before === '3' ? 'selected' : ''?>>3</option>
                                                                        <option value="4" <?=$paySchedule->second_pay_days_before === '4' ? 'selected' : ''?>>4</option>
                                                                        <option value="5" <?=$paySchedule->second_pay_days_before === '5' ? 'selected' : ''?>>5</option>
                                                                        <option value="6" <?=$paySchedule->second_pay_days_before === '6' ? 'selected' : ''?>>6</option>
                                                                        <option value="7" <?=$paySchedule->second_pay_days_before === '7' ? 'selected' : ''?>>7</option>
                                                                        <option value="8" <?=$paySchedule->second_pay_days_before === '8' ? 'selected' : ''?>>8</option>
                                                                        <option value="9" <?=$paySchedule->second_pay_days_before === '9' ? 'selected' : ''?>>9</option>
                                                                        <option value="10" <?=$paySchedule->second_pay_days_before === '10' ? 'selected' : ''?>>10</option>
                                                                        <option value="11" <?=$paySchedule->second_pay_days_before === '11' ? 'selected' : ''?>>11</option>
                                                                        <option value="12" <?=$paySchedule->second_pay_days_before === '12' ? 'selected' : ''?>>12</option>
                                                                        <option value="13" <?=$paySchedule->second_pay_days_before === '13' ? 'selected' : ''?>>13</option>
                                                                        <option value="14" <?=$paySchedule->second_pay_days_before === '14' ? 'selected' : ''?>>14</option>
                                                                        <option value="15" <?=$paySchedule->second_pay_days_before === '15' ? 'selected' : ''?>>15</option>
                                                                        <option value="16" <?=$paySchedule->second_pay_days_before === '16' ? 'selected' : ''?>>16</option>
                                                                        <option value="17" <?=$paySchedule->second_pay_days_before === '17' ? 'selected' : ''?>>17</option>
                                                                        <option value="18" <?=$paySchedule->second_pay_days_before === '18' ? 'selected' : ''?>>18</option>
                                                                        <option value="19" <?=$paySchedule->second_pay_days_before === '19' ? 'selected' : ''?>>19</option>
                                                                        <option value="20" <?=$paySchedule->second_pay_days_before === '20' ? 'selected' : ''?>>20</option>
                                                                        <option value="21" <?=$paySchedule->second_pay_days_before === '21' ? 'selected' : ''?>>21</option>
                                                                        <option value="22" <?=$paySchedule->second_pay_days_before === '22' ? 'selected' : ''?>>22</option>
                                                                        <option value="23" <?=$paySchedule->second_pay_days_before === '23' ? 'selected' : ''?>>23</option>
                                                                        <option value="24" <?=$paySchedule->second_pay_days_before === '24' ? 'selected' : ''?>>24</option>
                                                                        <option value="25" <?=$paySchedule->second_pay_days_before === '25' ? 'selected' : ''?>>25</option>
                                                                        <option value="26" <?=$paySchedule->second_pay_days_before === '26' ? 'selected' : ''?>>26</option>
                                                                        <option value="27" <?=$paySchedule->second_pay_days_before === '27' ? 'selected' : ''?>>27</option>
                                                                        <option value="28" <?=$paySchedule->second_pay_days_before === '28' ? 'selected' : ''?>>28</option>
                                                                        <option value="20" <?=$paySchedule->second_pay_days_before === '29' ? 'selected' : ''?>>20</option>
                                                                        <option value="30" <?=$paySchedule->second_pay_days_before === '30' ? 'selected' : ''?>>30</option>
                                                                        <option value="-9" <?=$paySchedule->second_pay_days_before === '-9' ? 'selected' : ''?>>-9</option>
                                                                        <option value="-8" <?=$paySchedule->second_pay_days_before === '-8' ? 'selected' : ''?>>-8</option>
                                                                        <option value="-7" <?=$paySchedule->second_pay_days_before === '-7' ? 'selected' : ''?>>-7</option>
                                                                        <option value="-6" <?=$paySchedule->second_pay_days_before === '-6' ? 'selected' : ''?>>-6</option>
                                                                        <option value="-5" <?=$paySchedule->second_pay_days_before === '-5' ? 'selected' : ''?>>-5</option>
                                                                        <option value="-4" <?=$paySchedule->second_pay_days_before === '-4' ? 'selected' : ''?>>-4</option>
                                                                        <option value="-3" <?=$paySchedule->second_pay_days_before === '-3' ? 'selected' : ''?>>-3</option>
                                                                        <option value="-2" <?=$paySchedule->second_pay_days_before === '-2' ? 'selected' : ''?>>-2</option>
                                                                        <option value="-1" <?=$paySchedule->second_pay_days_before === '-1' ? 'selected' : ''?>>-1</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <label for="name">Pay schedule name</label>
                                                            <input type="text" name="name" id="name" class="form-control w-50" value="<?=$paySchedule->name?>">
                                                            <div class="form-check form-check-inline mt-2">
                                                                <input type="checkbox" name="use_for_new_employees" id="use-for-new-emps" class="form-check-input" value="1" <?=$paySchedule->use_for_new_employees === "1" ? 'checked' : ''?>>
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
                                                                            <p class="m-0 pay-period"><span></span> - <span></span></p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <p>Pay date</p>
                                                                            <p class="m-0 pay-date"></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card shadow">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-8">
                                                                            <p>Pay period</p>
                                                                            <p class="m-0 pay-period"><span></span> - <span></span></p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <p>Pay date</p>
                                                                            <p class="m-0 pay-date"></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card shadow">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-8">
                                                                            <p>Pay period</p>
                                                                            <p class="m-0 pay-period"><span></span> - <span></span></p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <p>Pay date</p>
                                                                            <p class="m-0 pay-date"></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card shadow">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-8">
                                                                            <p>Pay period</p>
                                                                            <p class="m-0 pay-period"><span></span> - <span></span></p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <p>Pay date</p>
                                                                            <p class="m-0 pay-date"></p>
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