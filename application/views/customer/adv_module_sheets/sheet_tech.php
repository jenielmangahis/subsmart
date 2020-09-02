<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="tab-pane fade standard-accordion" id="tech">
    <form id="tech_form">
        <div class="row">
        <div class="col-sm-12">
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
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Tech Arrive Time</label><br/>
                <input type="text" class="form-control" name="tech_arrive_time" id="tech_arrive_time" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Tech Complete Time</label><br/>
                <input type="text" class="form-control" name="tech_complete_time" id="tech_complete_time" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Time Given</label><br/>
                <input type="text" class="form-control" name="time_given" id="time_given" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Date Given</label><br/>
                <input type="text" class="form-control date_picker" name="date_given" id="date_given" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Tech Assign</label><br/>
                <input type="text" class="form-control" name="tech_assign" id="tech_assign" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Custom Field 1</label><br/>
                <input type="text" class="form-control" name="custom_field1" id="custom_field1" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Custom Field 2</label><br/>
                <input type="text" class="form-control" name="custom_field2" id="custom_field2" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Custom Field 3</label><br/>
                <input type="text" class="form-control" name="custom_field3" id="custom_field3" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Custom Field 4</label><br/>
                <input type="text" class="form-control" name="custom_field4" id="custom_field4" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">URL</label><br/>
                <input type="text" class="form-control" name="url" id="url" />
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