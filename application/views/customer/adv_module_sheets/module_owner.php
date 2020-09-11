<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class=" module_ac" style="top:-210px;">
    <div class="row">
        <div class="col-md-12 module_header">
            <p class="module_title">Owner Module</p>
        </div>
        <div class="col-sm-12" id="access_module">
            <div class="col-sm-12 text-right-sm" style="align:right;">
                <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                    <input type="checkbox" name="owner_switch" class="onoffswitch-checkbox" data-customize="open" id="onoff-owner">
                    <label class="onoffswitch-label" for="onoff-owner">
                        <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label class="alarm_label"> <span >SSN </span>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="own_ssn" id="own_ssn" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label class="alarm_label"> <span >Firstname </span>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="own_fname" id="own_fname" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label class="alarm_label"> <span >Lastname </span>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="own_lname" id="own_lname" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label class="alarm_label"> <span >Address </span>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="own_address" id="own_address" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label class="alarm_label"> <span >City </span>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="own_city" id="own_city" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label class="alarm_label"> <span >State </span>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="own_state" id="own_state" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label class="alarm_label"> <span >Zip </span>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="own_zip" id="own_zip" />
                </div>
            </div>
        </div>

        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label class="alarm_label"> <span >Sign Guarantee</span>
                </div>
                <div class="col-md-8">
                    <input type="checkbox" name="own_sign" value="1" checked id="own_sign">
                </div>
            </div>
        </div>
    </div>
</div>