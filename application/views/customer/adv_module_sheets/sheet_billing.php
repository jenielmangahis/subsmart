<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="tab-pane fade standard-accordion" id="billing">
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-12 text-right-sm" style="align:right;">
                <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize">
                    <label class="onoffswitch-label" for="onoff-customize">
                        <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Card Holder First Name</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Card Holder Last Name</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Card Holder Address </label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">City State ZIP</label><br/>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Monthly Monitoring Rate* $</label><br/>
                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                    <option value="0">0.00</option>
                    <option value="0">5.00</option>
                    <option value="0">6.95</option>
                    <option value="0">6.95</option>
                    <option value="0">17.99</option>
                    <option value="0">19.91</option>
                    <option value="0">19.99</option>
                    <option value="0">20.00</option>
                    <option value="0">21.25</option>
                    <option value="0">21.91</option>
                    <option value="0">21.99</option>
                    <option value="0">22.00</option>
                    <option value="0">22.99</option>
                    <option value="0">24.99</option>
                    <option value="0">25.00</option>
                    <option value="0">25.91</option>
                    <option value="0">25.99</option>
                    <option value="0">26.99</option>
                    <option value="0">27.91</option>
                    <option value="0">27.99</option>
                    <option value="0">29.91</option>
                    <option value="0">29.97</option>
                    <option value="0">29.99</option>
                    <option value="0">30.00</option>
                    <option value="0">30.33</option>
                    <option value="0">30.50</option>
                    <option value="0">31.00</option>
                    <option value="0">31.95</option>
                    <option value="0">31.99</option>
                    <option value="0">32.41</option>
                    <option value="0">32.91</option>
                    <option value="0">32.99</option>
                    <option value="0">33.91</option>
                    <option value="0">34.91</option>
                    <option value="0">34.99</option>
                    <option value="0">35.00</option>
                    <option value="0">35.91</option>
                    <option value="0">35.95</option>
                    <option value="0">35.99</option>
                    <option value="0">36.91</option>
                    <option value="0">36.95</option>
                    <option value="0">36.99</option>
                    <option value="0">37.91</option>
                    <option value="0">37.99</option>
                    <option value="0">38.00</option>
                    <option value="0">38.91</option>
                    <option value="0">38.99</option>
                    <option value="0">39.00</option>
                    <option value="0">39.91</option>
                    <option value="0">39.95</option>
                    <option value="0">39.97</option>
                    <option value="0">39.99</option>
                    <option value="0">40.00</option>
                    <option value="0">40.91</option>
                    <option value="0">40.95</option>
                    <option value="0">40.99</option>
                    <option value="0">41.91</option>
                    <option value="0">41.95</option>
                    <option value="0">41.99</option>
                    <option value="0">42.91</option>
                    <option value="0">42.97</option>
                    <option value="0">42.99</option>
                    <option value="0">43.98</option>
                    <option value="0">44.91</option>
                    <option value="0">44.93</option>
                    <option value="0">44.95</option>
                    <option value="0">44.97</option>
                    <option value="0">44.99</option>
                    <option value="0">45.00</option>
                    <option value="0">45.91</option>
                    <option value="0">45.95</option>
                    <option value="0">46.95</option>
                    <option value="0">46.99</option>
                    <option value="0">47.07</option>
                    <option value="0">47.91</option>
                    <option value="0">47.94</option>
                    <option value="0">47.95</option>
                    <option value="0">47.97</option>
                    <option value="0">47.99</option>
                    <option value="0">48.65</option>
                    <option value="0">48.91</option>
                    <option value="0">48.95</option>
                    <option value="0">48.97</option>
                    <option value="0">49.91</option>
                    <option value="0">49.95</option>
                    <option value="0">49.97</option>
                    <option value="0">49.99</option>
                    <option value="0">50.00</option>
                    <option value="0">50.91</option>
                    <option value="0">50.99</option>
                    <option value="0">51.00</option>
                    <option value="0">51.91</option>
                    <option value="0">51.95</option>
                    <option value="0">51.99</option>
                    <option value="0">52.91</option>
                    <option value="0">52.95</option>
                    <option value="0">53.37</option>
                    <option value="0">53.91</option>
                    <option value="0">53.92</option>
                    <option value="0">53.95</option>
                    <option value="0">53.97</option>
                    <option value="0">53.99</option>
                    <option value="0">54.91</option>
                    <option value="0">54.95</option>
                    <option value="0">54.97</option>
                    <option value="0">54.99</option>
                    <option value="0">55.00</option>
                    <option value="0">55.91</option>
                    <option value="0">55.95</option>
                    <option value="0">55.97</option>
                    <option value="0">55.99</option>
                    <option value="0">56.91</option>
                    <option value="0">56.95</option>
                    <option value="0">56.99</option>
                    <option value="0">57.91</option>
                    <option value="0">57.97</option>
                    <option value="0">57.99</option>
                    <option value="0">58.91</option>
                    <option value="0">58.95</option>
                    <option value="0">58.99</option>
                    <option value="0">59.34</option>
                    <option value="0">59.91</option>
                    <option value="0">59.95</option>
                    <option value="0">59.97</option>
                    <option value="0">59.99</option>
                    <option value="0">60.99</option>
                    <option value="0">61.99</option>
                    <option value="0">62.91</option>
                    <option value="0">62.99</option>
                    <option value="0">63.91</option>
                    <option value="0">63.99</option>
                    <option value="0">64.91</option>
                    <option value="0">64.95</option>
                    <option value="0">64.99</option>
                    <option value="0">65.99</option>
                    <option value="0">66.91</option>
                    <option value="0">67.91</option>
                    <option value="0">67.99</option>
                    <option value="0">69.91</option>
                    <option value="0">69.99</option>
                    <option value="0">70.99</option>
                    <option value="0">71.99</option>
                    <option value="0">72.98</option>
                    <option value="0">73.99</option>
                    <option value="0">74.91</option>
                    <option value="0">74.95</option>
                    <option value="0">74.98</option>
                    <option value="0">74.99</option>
                    <option value="0">75.99</option>
                    <option value="0">77.99</option>
                    <option value="0">79.90</option>
                    <option value="0">79.91</option>
                    <option value="0">79.99</option>
                    <option value="0">80.98</option>
                    <option value="0">81.95</option>
                    <option value="0">81.99</option>
                    <option value="0">84.99</option>
                    <option value="0">85.95</option>
                    <option value="0">85.99</option>
                    <option value="0">87.99</option>
                    <option value="0">88.00</option>
                    <option value="0">88.91</option>
                    <option value="0">89.91</option>
                    <option value="0">89.97</option>
                    <option value="0">89.99</option>
                    <option value="0">93.94</option>
                    <option value="0">94.99</option>
                    <option value="0">97.85</option>
                    <option value="0">99.00</option>
                    <option value="0">99.90</option>
                    <option value="0">99.91</option>
                    <option value="0">99.94</option>
                    <option value="0">99.97</option>
                    <option value="0">99.98</option>
                    <option value="0">99.99</option>
                    <option value="0">100.99</option>
                    <option value="0">101.97</option>
                    <option value="0">103.98</option>
                    <option value="0">103.99</option>
                    <option value="0">104.99</option>
                    <option value="0">105.98</option>
                    <option value="0">107.90</option>
                    <option value="0">108.98</option>
                    <option value="0">109.90</option>
                    <option value="0">109.91</option>
                    <option value="0">109.99</option>
                    <option value="0">113.98</option>
                    <option value="0">115.98</option>
                    <option value="0">118.98</option>
                    <option value="0">119.99</option>
                    <option value="0">120.98</option>
                    <option value="0">129.00</option>
                    <option value="0">129.99</option>
                    <option value="0">134.99</option>
                    <option value="0">139.91</option>
                    <option value="0">149.99</option>
                    <option value="0">161.23</option>
                    <option value="0">199.97</option>
                    <option value="0">255.00</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Billing Frequency</label><br/>
                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                    <option value="0">- none -</option>
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
                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                    <option value="0"></option>
                    <option value="0">1</option>
                    <option value="0">2</option>
                    <option value="0">3</option>
                    <option value="0">4</option>
                    <option value="0">5</option>
                    <option value="0">6</option>
                    <option value="0">7</option>
                    <option value="0">8</option>
                    <option value="0">9</option>
                    <option value="0">10</option>
                    <option value="0">11</option>
                    <option value="0">12</option>
                    <option value="0">13</option>
                    <option value="0">14</option>
                    <option value="0">15</option>
                    <option value="0">16</option>
                    <option value="0">17</option>
                    <option value="0">18</option>
                    <option value="0">19</option>
                    <option value="0">20</option>
                    <option value="0">21</option>
                    <option value="0">22</option>
                    <option value="0">23</option>
                    <option value="0">24</option>
                    <option value="0">25</option>
                    <option value="0">26</option>
                    <option value="0">27</option>
                    <option value="0">28</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Contract Term* (months)</label><br/>
                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                    <option value="0"></option>
                    <option value="0">36</option>
                    <option value="0">60</option>
                    <option value="0">12</option>
                    <option value="0">24</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Billing Method</label><br/>
                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                    <option value="0">- none -</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Billing Start Date</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Billing End Date</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Check Number</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Routing Number</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Account Number</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Credit Card Number</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Credit Card Expiration</label><br/>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                    </div>/
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                    </div> (MM/YYYY)
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Collections Date</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Collections Amount $</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Contract Extension Date</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Social Security Number</label><br/>
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                    </div> -
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                    </div> -
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="col-sm-12">
            <div class="col-sm-12 text-right-sm" style="align:right;">
                <button type="submit" class="btn btn-flat btn-primary"><span class="fa fa-remove"></span> Cancel</button>
                <button type="submit" class="btn btn-flat btn-primary"><span class="fa fa-send"></span> Save</button>
            </div>
        </div>
    </div>
</div>