<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class=" module_ac" style="top:-300px;">
    <div class="row">
        <div class="col-md-12 module_header">
            <p class="module_title">Payment Module</p>
        </div>
        <div class="col-sm-12" id="access_module">
            <div class="col-sm-12 text-right-sm" style="align:right;">
                <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                    <input type="checkbox" name="payment_switch" class="onoffswitch-checkbox" data-customize="open" id="onoff-payment">
                    <label class="onoffswitch-label" for="onoff-payment">
                        <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="notify_by_sms"><span>Mode of Payment</span>
                </div>
                <div class="col-md-8">
                    <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                    <label for="notify_by_sms"><span>Credit Card</span></label>

                    <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                    <label for="notify_by_sms"><span>eCheck</span></label>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Card Number</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="contact_name" id="contact_name" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">CIC</label>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="contact_name" id="contact_name" />
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
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="contact_name" id="contact_name" />
                        </div>
                        <small>(MM/YYYY)</small>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Transaction Subtotal</label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="contact_name" id="contact_name" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Tax Amount</label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="contact_name" id="contact_name" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Transaction Amount</label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="contact_name" id="contact_name" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Transaction Category</label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="contact_name" id="contact_name" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Note</label>
                </div>
                <div class="col-md-8">
                    <textarea class="form-controls" cols="47" rows="5"></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-6">

                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-flat btn-primary">Pre-Add Mode</button>
                    <button type="submit" class="btn btn-flat btn-primary">Capture New </button>
                </div>

            </div>
        </div>
    </div>
</div>