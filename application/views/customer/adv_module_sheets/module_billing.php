<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class=" module_ac" >
    <div class="row">
        <div class="col-md-12 module_header">
            <p class="module_title">Billing Information</p>
        </div>
        <div class="col-sm-12" id="billing_module">
            <div class="col-sm-12 text-right-sm" style="align:right;">
                <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                    <input type="checkbox" name="billing_switch" class="onoffswitch-checkbox" data-customize="open" id="onoff-bill">
                    <label class="onoffswitch-label" for="onoff-bill">
                        <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Card Holder First Name</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="card_fname" id="card_fname" value="<?php if(isset($billing_info)){ echo $billing_info->card_fname; } ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Card Holder Last Name</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="card_lname" id="card_lname" value="<?php if(isset($billing_info)){ echo $billing_info->card_lname; } ?>"/>
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Card Holder Address </label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="card_address" id="card_address" value="<?php if(isset($billing_info)){ echo $billing_info->card_address; } ?>"/>
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">City State ZIP</label>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="billing_city" id="billing_city" value="<?php if(isset($billing_info)){ echo $billing_info->city; } ?>" />
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="billing_state" id="billing_state" value="<?php if(isset($billing_info)){ echo $billing_info->state; } ?>"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="billing_zip" id="billing_zip" value="<?php if(isset($billing_info)){ echo $billing_info->zip; } ?>"/>
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Rate Plan $</label>
                    </div>
                    <div class="col-md-8">
                        <select id="mmr" name="mmr" data-customer-source="dropdown" class="input_select" required>
                            <option value="0.00">0.00</option>
                            <option value="20.00">20.00</option>
                            <option value="24.99">24.99</option>
                            <option value="25.00">25.00</option>
                            <option value="26.99">26.99</option>
                            <option value="27.99">27.99</option>
                            <option value="29.99">29.99</option>
                            <option value="31.00">31.00</option>
                            <option value="31.99">31.99</option>
                            <option value="32.99">32.99</option>
                            <option value="34.99">34.99</option>
                            <option value="35.00">35.00</option>
                            <option value="35.99">35.99</option>
                            <option value="36.99">36.99</option>
                            <option value="37.99">37.99</option>
                            <option value="38.99">38.99</option>
                            <option value="39.99">39.99</option>
                            <option value="40.99">40.99</option>
                            <option value="41.15">41.15</option>
                            <option value="41.99">41.99</option>
                            <option value="42.99">42.99</option>
                            <option value="43.99">43.99</option>
                            <option value="44.95">44.95</option>
                            <option value="44.99">44.99</option>
                            <option value="45.99">45.99</option>
                            <option value="46.99">46.99</option>
                            <option value="47.95">47.95</option>
                            <option value="47.99">47.99</option>
                            <option value="48.99">48.99</option>
                            <option value="49.95">49.95</option>
                            <option value="49.99">49.99</option>
                            <option value="50.99">50.99</option>
                            <option value="51.95">51.95</option>
                            <option value="51.99">51.99</option>
                            <option value="52.99">52.99</option>
                            <option value="53.95">53.95</option>
                            <option value="53.99">53.99</option>
                            <option value="54.49">54.49</option>
                            <option value="54.99">54.99</option>
                            <option value="55.99">55.99</option>
                            <option value="56.99">56.99</option>
                            <option value="57.99">57.99</option>
                            <option value="58.99">58.99</option>
                            <option value="59.99">59.99</option>
                            <option value="60.99">60.99</option>
                            <option value="61.99">61.99</option>
                            <option value="62.99">62.99</option>
                            <option value="63.99">63.99</option>
                            <option value="64.99">64.99</option>
                            <option value="65.99">65.99</option>
                            <option value="67.99">67.99</option>
                            <option value="69.99">69.99</option>
                            <option value="70.99">70.99</option>
                            <option value="71.99">71.99</option>
                            <option value="72.98">72.98</option>
                            <option value="73.99">73.99</option>
                            <option value="74.99">74.99</option>
                            <option value="75.99">75.99</option>
                            <option value="77.99">77.99</option>
                            <option value="85.99">85.99</option>
                            <option value="89.99">89.99</option>
                            <option value="95.00">95.00</option>
                            <option value="97.85">97.85</option>
                            <option value="129.00">129.00</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Billing Frequency</label>
                    </div>
                    <div class="col-md-8">
                        <select id="bill_freq" name="bill_freq" data-customer-source="dropdown" class="input_select">
                            <option <?php if(isset($billing_info)){ if($billing_info->bill_freq == ""){echo "selected";} } ?> value="">- Select -</option>
                            <option <?php if(isset($billing_info)){ if($billing_info->bill_freq == "One Time Only"){echo "selected";} } ?> value="One Time Only">One Time Only</option>
                            <option <?php if(isset($billing_info)){ if($billing_info->bill_freq == "Every 1 Month"){echo "selected";} } ?> value="Every 1 Month">Every 1 Month</option>
                            <option <?php if(isset($billing_info)){ if($billing_info->bill_freq == "Every 3 Months"){echo "selected";} } ?> value="Every 3 Months">Every 3 Months</option>
                            <option <?php if(isset($billing_info)){ if($billing_info->bill_freq == "Every 6 Months"){echo "selected";} } ?> value="Every 6 Months">Every 6 Months</option>
                            <option <?php if(isset($billing_info)){ if($billing_info->bill_freq == "Every 1 Year"){echo "selected";} } ?> value="Every 1 Year">Every 1 Year</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Billing Day of Month</label>
                    </div>
                    <div class="col-md-8">
                        <select id="bill_day" name="bill_day" data-customer-source="dropdown" class="input_select">
                            <?php
                                for ($days=0;$days<14;$days++){
                                    ?>
                                        <option <?php if(isset($billing_info)){ if($billing_info->bill_day == days_of_month($prefix)){ echo 'selected'; } } ?> value="<?= days_of_month($days); ?>"><?= days_of_month($days) < 1 ? '' : days_of_month($days) ; ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Contract Term* (months)</label>
                    </div>
                    <div class="col-md-8">
                        <select id="contract_term" name="contract_term" data-customer-source="dropdown" class="input_select" >
                            <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 0){echo "selected";} } ?> value="0"></option>
                            <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 36){echo "selected";} } ?> value="36">36</option>
                            <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 60){echo "selected";} } ?> value="60">60</option>
                            <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 12){echo "selected";} } ?> value="12">12</option>
                            <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 24){echo "selected";} } ?> value="24">24</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Billing Method</label>
                    </div>
                    <div class="col-md-8">
                        <select id="bill_method" name="bill_method" data-customer-source="dropdown" class="input_select">
                            <option <?php if(isset($billing_info)){ if($billing_info->bill_method == 0){echo "selected";} } ?>  value="0">None</option>
                            <option <?php if(isset($billing_info)){ if($billing_info->bill_method == 1){echo "selected";} } ?> value="1">Credit Card</option>
                            <option <?php if(isset($billing_info)){ if($billing_info->bill_method == 2){echo "selected";} } ?> value="2">Check</option>
                            <option <?php if(isset($billing_info)){ if($billing_info->bill_method == 3){echo "selected";} } ?> value="3">eCheck</option>
                            <option <?php if(isset($billing_info)){ if($billing_info->bill_method == 4){echo "selected";} } ?> value="4">Manual Billing</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Billing Start Date</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control " name="bill_start_date" id="date_picker" value="<?php if(isset($billing_info)){ echo $billing_info->bill_start_date; } ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Billing End Date</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control " name="bill_end_date" id="date_picker" value="<?php if(isset($billing_info)){ echo $billing_info->bill_end_date; } ?>"/>
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Check Number</label>
                    </div>
                    <div class="col-md-8">
                        <input type="number" class="form-control" name="check_num" id="check_num" value="<?php if(isset($billing_info)){ echo $billing_info->check_num; } ?>"/>
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Routing Number</label>
                    </div>
                    <div class="col-md-8">
                        <input type="number" class="form-control" name="routing_num" id="routing_num" value="<?php if(isset($billing_info)){ echo $billing_info->routing_num; } ?>"/>
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Account Number</label>
                    </div>
                    <div class="col-md-8">
                        <input type="number" class="form-control" name="acct_num" id="acct_num" value="<?php if(isset($billing_info)){ echo $billing_info->acct_num; } ?>"/>
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Credit Card Number</label>
                    </div>
                    <div class="col-md-8">
                        <input type="number" class="form-control" name="credit_card_num" id="credit_card_num" value="<?php if(isset($billing_info)){  $billing_info->credit_card_num == 0 ? '' :  $billing_info->credit_card_num; } ?>"/>
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Credit Card Expiration</label>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="credit_card_exp" id="credit_card_exp" value="<?php if(isset($billing_info)){ echo $billing_info->credit_card_exp; } ?>"/>
                            </div>/
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="credit_card_exp_mm_yyyy" id="credit_card_exp_mm_yyyy" value="<?php if(isset($billing_info)){ echo $billing_info->credit_card_exp_mm_yyyy; } ?>"/>
                            </div> <small>(MM/YYYY)</small>
                        </div>
                    </div>
                </div>
            </div>
            <!--<div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Collections Date</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control date_picker" name="collect_date" id="collect_date" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Collections Amount $</label>
                    </div>
                    <div class="col-md-8">
                        <input type="number" class="form-control" name="collect_amt" id="collect_amt" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Contract Extension Date</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control date_picker" name="contract_ext_date" id="contract_ext_date" />
                    </div>
                </div>
            </div>-->
        </div>
    </div>
</div>