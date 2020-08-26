<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="tab-pane fade standard-accordion" id="address">
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
                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                    <option value="0">- none -</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Name Prefix</label><br/>
                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
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
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">First Name</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Middle Initial</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Last Name</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Date of Birth</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Name Suffix</label><br/>
                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                    <option value="0">Select</option>
                    <option value="0">DS</option>
                    <option value="0">Esq.</option>
                    <option value="0">II</option>
                    <option value="0">III</option>
                    <option value="0">IV</option>
                    <option value="0">Jr.</option>
                    <option value="0">MA</option>
                    <option value="0">MBA</option>
                    <option value="0">MD</option>
                    <option value="0">MS</option>
                    <option value="0">PhD</option>
                    <option value="0">RN</option>
                    <option value="0">Sr.</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Company</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Address *</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Cross Street</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Subdivision</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
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
                <label for="">Country</label><br/>
                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                    <option value="0">USA</option>
                    <option value="0">Canada</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Home/Panel Phone *</label><br/>
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
                <label for="">Cell Phone </label><br/>
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
                <label for="">Alternate Phone </label><br/>
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
                <label for="">Email</label><br/>
                <input type="email" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Contact First Name</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Contact Last Name</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Contact Phone </label><br/>
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                    </div>
                    <div class="col-md-4">
                        <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                            <option value="0">Select</option>
                            <option value="0">Cell</option>
                            <option value="0">Fax</option>
                            <option value="0">Home</option>
                            <option value="0">Pager</option>
                            <option value="0">Work</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Contact Relationship</label><br/>
                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                    <option value="0">- none -</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Contact First Name</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Contact Last Name</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Contact Phone </label><br/>
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                    </div>
                    <div class="col-md-4">
                        <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                            <option value="0">Select</option>
                            <option value="0">Cell</option>
                            <option value="0">Fax</option>
                            <option value="0">Home</option>
                            <option value="0">Pager</option>
                            <option value="0">Work</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Contact Relationship</label><br/>
                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                    <option value="0">- none -</option>
                </select>
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