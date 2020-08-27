<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="tab-pane active standard-accordion" id="profile">
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
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Sales Area</label><br/>
                <select id="fk_sa_id" name="fk_sa_id" data-customer-source="dropdown" class="form-control searchable-dropdown">
                    <option value="">Select</option>
                    <?php foreach ($sales_area as $sa): ?>
                        <option value="<?= $sa->sa_id; ?>"><?= $sa->sa_name; ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="col-md-9"></div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">First Name</label><br/>
                <input type="text" class="form-control" name="first_name" id="first_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Last Name</label><br/>
                <input type="text" class="form-control" name="last_name" id="last_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Middle Name</label><br/>
                <input type="text" class="form-control" name="middle_name" id="middle_name" required/>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group" id="customer_type_group">
                <label for="">Name Prefix</label><br/>
                <select id="prefix" name="prefix" data-customer-source="dropdown" class="form-control searchable-dropdown">
                    <option value="0">Select</option>
                    <option value="0">Captain</option>
                    <option value="0">Cnl.</option>
                    <option value="0">Colonel</option>
                    <option value="0">Dr.</option>
                    <option value="0">Gen.</option>
                    <option value="0">Judge</option>
                    <option value="0">Lady</option>
                    <option value="0">Lieutenant</option>
                    <option value="0">Lord</option>
                    <option value="0">Lt.</option>
                    <option value="0">Madam</option>
                    <option value="0">Maj.</option>
                    <option value="0">Major</option>
                    <option value="0">Master</option>
                    <option value="0">Miss</option>
                    <option value="0">Mister</option>
                    <option value="0">Mr.</option>
                    <option value="0">Mrs.</option>
                    <option value="0">Ms.</option>
                    <option value="0">Pastor</option>
                    <option value="0">Private</option>
                    <option value="0">Prof.</option>
                    <option value="0">Pvt.</option>
                    <option value="0">Rev.</option>
                    <option value="0">Sergeant</option>
                    <option value="0">Sgt</option>
                    <option value="0">Sir</option>
                </select>
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group" id="customer_type_group">
                <label for="">Suffix</label><br/>
                <select id="suffix" name="suffix" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                    <option value="">Select</option>
                    <option value="DS">DS</option>
                    <option value="Esq.">Esq.</option>
                    <option value="II">II</option>
                    <option value="III">III</option>
                    <option value="IV">IV</option>
                    <option value="Jr.">Jr.</option>
                    <option value="MA">MA</option>
                    <option value="MBA">MBA</option>
                    <option value="MD">MD</option>
                    <option value="MS">MS</option>
                    <option value="PhD">PhD</option>
                    <option value="RN">RN</option>
                    <option value="Sr.">Sr.</option>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group" id="customer_type_group">
                <label for="">Business Name</label><br/>
                <input type="text" class="form-control" name="business_name" id="business_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Email</label><br/>
                <input type="text" class="form-control" name="email" id="email" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">

                <label for="">SSN</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Date Of Birth </label><br/>
                <input type="text" class="form-control" name="date_of_birth" id="date_of_birth" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Phone (H)</label><br/>
                <input type="text" class="form-control" name="phone_h" id="phone_h" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Phone (W)</label><br/>
                <input type="text" class="form-control" name="phone_w" id="phone_w" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Phone (M)</label><br/>
                <input type="text" class="form-control" name="phone_m" id="phone_m" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Fax</label><br/>
                <input type="text" class="form-control" name="fax" id="fax" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Mailing Address</label><br/>
                <input type="text" class="form-control" name="mail_add" id="mail_add" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">City</label><br/>
                <input type="text" class="form-control" name="city" id="city" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">State</label><br/>
                <input type="text" class="form-control" name="state" id="state" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Country</label><br/>
                <input type="text" class="form-control" name="country" id="country" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Zip Code</label><br/>
                <input type="text" class="form-control" name="zip_code" id="zip_code" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Cross Street</label><br/>
                <input type="text" class="form-control" name="cross_street" id="cross_street" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Subdivision</label><br/>
                <input type="text" class="form-control" name="subdivision" id="subdivision" required/>
            </div>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Image/Logo File</label><br/>
                <input type="text" class="form-control" name="img_path" id="img_path" required/>
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkbox checkbox-sec margin-right">
                <input type="checkbox" name="sched_conflict" value="Email" id="sched_conflict">
                <label for="sched_conflict"><span>Check for Schedule Conflict</span></label>
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