<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class=" module_ac" style="top:-280px;">
    <div class="row">
        <div class="col-md-12 module_header">
            <p class="module_title">Address Information</p>
        </div>
        <div class="col-sm-12" id="address_module">
            <div class="col-sm-12 text-right-sm" style="align:right;">
                <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                    <input type="checkbox" name="address_switch" class="onoffswitch-checkbox" data-customize="open" id="onoff-add">
                    <label class="onoffswitch-label" for="onoff-add">
                        <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Sales Area</label>
                </div>
                <div class="col-md-8">
                    <select id="fk_sa_id_add" name="fk_sa_id_add" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                        <?php foreach ($sales_area as $sa): ?>
                            <option value="<?= $sa->sa_id; ?>"><?= $sa->sa_name; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Company</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="company" id="company" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Address </label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="address" id="address" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Cross Street</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="cross_street" id="cross_street" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Subdivision</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="subdivision" id="subdivision" />
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
                            <input type="text" class="form-control" name="city" id="city" />
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="state" id="state" />
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
                    <input type="text" class="form-control" name="zip" id="zip" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Country</label>
                </div>
                <div class="col-md-8">
                    <select id="country" name="country" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                        <option value="USA">USA</option>
                        <option value="Canada">Canada</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Home/Panel Phone </label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="phone_home" id="phone_home" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Cell Phone </label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="phone_cell" id="phone_cell" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Alternate Phone </label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="phone_alternate" id="phone_alternate" />
                </div>
            </div>
        </div>
        <br><br>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Contact First Name</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="contact1_firstname" id="contact1_firstname" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Contact Last Name</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="contact1_lastname" id="contact1_lastname" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Contact Phone </label>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-8">
                            <input type="number" class="form-control" name="contact1_phone" id="contact1_phone" />
                        </div>
                        <div class="col-md-4">
                            <select id="contact1_phone_type" name="contact1_phone_type" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                <option value="">Select</option>
                                <option value="Cell">Cell</option>
                                <option value="Fax">Fax</option>
                                <option value="Home">Home</option>
                                <option value="Pager">Pager</option>
                                <option value="Work">Work</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Contact Relationship</label>
                </div>
                <div class="col-md-8">
                    <select id="contact1_relationship" name="contact1_relationship" data-customer-source="dropdown" class="form-control searchable-dropdown">
                        <option value="">- Select -</option>
                        <option value="DLR">Dealer</option>
                        <option value="EMP">Employee</option>
                        <option value="FRND">Friend</option>
                        <option value="JAN">Janitorial</option>
                        <option value="MNT">Maintenance</option>
                        <option value="MGR">Manager</option>
                        <option value="NGH">Neighbor</option>
                        <option value="SEC">On Site</option>
                        <option selected="selected" value="OWN">Owner</option>
                        <option value="REL">Relative</option>
                        <option value="RES">Resident</option>
                    </select>
                </div>
            </div>
        </div>

        <br><br>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Contact First Name</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="contact2_firstname" id="contact2_firstname" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Contact Last Name</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="contact2_lastname" id="contact2_lastname" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Contact Phone </label>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-8">
                            <input type="number" class="form-control" name="contact2_phone" id="contact2_phone" />
                        </div>
                        <div class="col-md-4">
                            <select id="contact2_phone_type" name="contact2_phone_type" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                                <option value="">Select</option>
                                <option value="Cell">Cell</option>
                                <option value="Fax">Fax</option>
                                <option value="Home">Home</option>
                                <option value="Pager">Pager</option>
                                <option value="Work">Work</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Contact Relationship</label>
                </div>
                <div class="col-md-8">
                    <select id="contact2_relationship" name="contact2_relationship" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                        <option value="">- Select -</option>
                        <option value="DLR">Dealer</option>
                        <option value="EMP">Employee</option>
                        <option value="FRND">Friend</option>
                        <option value="JAN">Janitorial</option>
                        <option value="MNT">Maintenance</option>
                        <option value="MGR">Manager</option>
                        <option value="NGH">Neighbor</option>
                        <option value="SEC">On Site</option>
                        <option selected="selected" value="OWN">Owner</option>
                        <option value="REL">Relative</option>
                        <option value="RES">Resident</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>