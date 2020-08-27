<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="tab-pane fade standard-accordion" id="admin">
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
                <label for="">Entered by</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Time Entered</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Assign To</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Pre-install Survey</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Custom Field 1</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Language</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Date Enter</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Sales Rep</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Post-install Survey</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Custom Field 2</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
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