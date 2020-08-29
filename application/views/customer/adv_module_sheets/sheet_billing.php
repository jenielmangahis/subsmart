<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="tab-pane fade standard-accordion" id="billing">
    <form id="billing_form">
        <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-12 text-right-sm" style="align:right;">
                <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                    <input type="checkbox" name="billing_switch" class="onoffswitch-checkbox" data-customize="open" id="onoff-billing">
                    <label class="onoffswitch-label" for="onoff-billing">
                        <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Card Holder First Name</label><br/>
                <input type="text" class="form-control" name="card_fname" id="card_fname" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Card Holder Last Name</label><br/>
                <input type="text" class="form-control" name="card_lname" id="card_lname" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Card Holder Address </label><br/>
                <input type="text" class="form-control" name="card_address" id="card_address" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">City State ZIP</label><br/>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="city" id="city" />
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="state" id="state" />
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="zip" id="zip" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Monthly Monitoring Rate* $</label><br/>
                <select id="mmr" name="mmr" data-customer-source="dropdown" class="form-control searchable-dropdown" >
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
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Billing Frequency</label><br/>
                <select id="bill_freq" name="bill_freq" data-customer-source="dropdown" class="form-control searchable-dropdown">
                    <option value="">- Select -</option>
                    <option value="One Time Only">One Time Only</option>
                    <option value="Every 1 Month">Every 1 Month</option>
                    <option value="Every 3 Months">Every 3 Months</option>
                    <option value="Every 6 Months">Every 6 Months</option>
                    <option value="Every 1 Year">Every 1 Year</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Billing Day of Month</label><br/>
                <select id="bill_day" name="bill_day" data-customer-source="dropdown" class="form-control searchable-dropdown">
                    <option value="0"></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Contract Term* (months)</label><br/>
                <select id="contract_term" name="contract_term" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                    <option value="0"></option>
                    <option value="36">36</option>
                    <option value="60">60</option>
                    <option value="12">12</option>
                    <option value="24">24</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Billing Method</label><br/>
                <select id="bill_method" name="bill_method" data-customer-source="dropdown" class="form-control searchable-dropdown">
                    <option  value="0">None</option>
                    <option value="1">Credit Card</option>
                    <option value="2">Check</option>
                    <option value="3">eCheck</option>
                    <option value="4">Manual Billing</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Billing Start Date</label><br/>
                <input type="text" class="form-control date_picker" name="bill_start_date" id="bill_start_date" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Billing End Date</label><br/>
                <input type="text" class="form-control date_picker" name="bill_end_date" id="bill_end_date" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Check Number</label><br/>
                <input type="number" class="form-control" name="check_num" id="check_num" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Routing Number</label><br/>
                <input type="number" class="form-control" name="routing_num" id="routing_num" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Account Number</label><br/>
                <input type="number" class="form-control" name="acct_num" id="acct_num" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Credit Card Number</label><br/>
                <input type="number" class="form-control" name="credit_card_num" id="credit_card_num" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Credit Card Expiration</label><br/>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="credit_card_exp" id="credit_card_exp" required/>
                    </div>/
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="credit_card_exp_mm_yyyy" id="credit_card_exp_mm_yyyy" required/>
                    </div> (MM/YYYY)
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Collections Date</label><br/>
                <input type="text" class="form-control date_picker" name="collect_date" id="collect_date" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Collections Amount $</label><br/>
                <input type="number" class="form-control" name="collect_amt" id="collect_amt" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Contract Extension Date</label><br/>
                <input type="text" class="form-control date_picker" name="contract_ext_date" id="contract_ext_date" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Social Security Number</label><br/>
                <div class="row">
                    <div class="col-md-12">
                        <input type="number" class="form-control" name="ssn" id="ssn" />
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="col-sm-12">
            <div class="col-md-1" style="display: none;">
                <div class="form-group" id="customer_type_group">
                    <input type="text" class="form-control" name="fk_prof_id" id="fk_prof_id" value="<?php if(isset($profile_info->prof_id)){ echo $profile_info->prof_id; } ?>">
                </div>
            </div>
            <div class="col-sm-12 text-right-sm" style="align:right;">
                <button type="submit" class="btn btn-flat btn-primary"><span class="fa fa-send"></span> Save</button>
            </div>
        </div>
    </div>
    </form>
</div>