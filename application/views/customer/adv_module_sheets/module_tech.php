<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class=" module_ac" style="top:-300px;">
    <div class="row">
        <div class="col-md-12 module_header">
            <p class="module_title">Tech Information</p>
        </div>
        <div class="col-sm-12" id="address_module">
            <div class="col-sm-12 text-right-sm" style="align:right;">
                <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                    <input type="checkbox" name="tech_switch" class="onoffswitch-checkbox" data-customize="open" id="onoff-tech">
                    <label class="onoffswitch-label" for="onoff-tech">
                        <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Tech Arrive Time</label>
                </div>
                <div class="col-md-8">
                    <div class="input-group bootstrap-timepicker timepicker">
                        <input id="tech_arrive_time" class="form-control timepicker" name="tech_arrive_time" data-provide="timepicker" data-template="modal" data-minute-step="1" data-modal-backdrop="true" type="text"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Tech Complete Time</label>
                </div>
                <div class="col-md-8">
                    <div class="input-group bootstrap-timepicker timepicker">
                        <input id="tech_complete_time" class="form-control timepicker" name="tech_complete_time" data-provide="timepicker" data-template="modal" data-minute-step="1" data-modal-backdrop="true" type="text"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Time Given</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control time_picker" name="time_given" id="time_given" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Date Given</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control date_picker" name="date_given" id="date_given" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Tech Assign</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="tech_assign" id="tech_assign" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Custom Field 1</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="custom_field1_tech" id="custom_field1_tech" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Custom Field 2</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="custom_field2_tech" id="custom_field2_tech" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Custom Field 3</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="custom_field3_tech" id="custom_field3_tech" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Custom Field 4</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="custom_field4_tech" id="custom_field4_tech" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">URL</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="url" id="url" />
                </div>
            </div>
        </div>
    </div>
</div>