<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="tab-pane fade standard-accordion" id="admin">
    <form id="admin_form">
        <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-12 text-right-sm" style="align:right;">
                <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                    <input type="checkbox" name="admin_switch" class="onoffswitch-checkbox" data-customize="open" id="onoff-admin">
                    <label class="onoffswitch-label" for="onoff-admin">
                        <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Entered by</label><br/>
                <input type="text" class="form-control" name="entered_by" id="entered_by" required />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Time Entered</label><br/>
                <input type="text" class="form-control" name="time_entered" id="time_entered" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Assign To</label><br/>
                <input type="text" class="form-control" name="assign_to" id="assign_to" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Pre-install Survey</label><br/>
                <input type="text" class="form-control" name="pre_install_survey" id="pre_install_survey" />
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
                <label for="">Language</label><br/>
                <input type="text" class="form-control" name="language" id="language" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Date Enter</label><br/>
                <input type="text" class="form-control date_picker" name="date_enter" id="date_enter" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Sales Rep</label><br/>
                <select id="sales_rep" name="sales_rep" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                    <option value="">Select</option>
                    <?php foreach ($sales_area as $sa): ?>
                        <option value="<?= $sa->sa_id; ?>"><?= $sa->sa_name; ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Post-install Survey</label><br/>
                <input type="text" class="form-control" name="post_install_survey" id="post_install_survey" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Custom Field 2</label><br/>
                <input type="text" class="form-control" name="custom_field2" id="custom_field2" />
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