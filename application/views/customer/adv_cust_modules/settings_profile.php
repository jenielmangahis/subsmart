<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="col-lg-12">
    <h6>Profile</h6>
    <div class="row">
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-1">
                    <label for="">First Name</label> <span class="required"> *</span>
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control" value="<?php if(isset($profile_info)){ echo $profile_info->first_name; } ?>" name="contact_name" id="contact_name" required/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-1">
                    <label for="">Middle Name</label> <span class="required"> *</span>
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control" value="<?php if(isset($profile_info)){ echo $profile_info->last_name; } ?>" name="contact_name" id="contact_name" required/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-1">
                    <label for="">Last Name</label> <span class="required"> *</span>
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control" value="<?php if(isset($profile_info)){ echo $profile_info->last_name; } ?>" name="contact_name" id="contact_name" required/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-1">
                    <label for="">Email</label>
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control" value="<?php if(isset($profile_info)){ echo $profile_info->email; } ?>" name="contact_name" id="contact_name" required/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-1">
                    <label for="">Suffix</label>
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control" value="" name="contact_name" id="contact_name" required/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-1">
                    <label for="">Last 4 of SSN</label>
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control" value="" name="contact_name" id="contact_name" required/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-1">
                    <label for="">Phone (H)</label>
                </div>
                <div class="col-md-5">
                    <input type="number" class="form-control" value="" name="contact_name" id="contact_name" required/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-1">
                    <label for="">Phone (M)</label>
                </div>
                <div class="col-md-5">
                    <input type="number" class="form-control" value="" name="contact_name" id="contact_name" required/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-1">
                    <label for="">Phone (W)</label>
                </div>
                <div class="col-md-5">
                    <input type="number" class="form-control" value="" name="contact_name" id="contact_name" required/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-1">
                    <label for="">DOB</label>
                </div>
                <div class="col-md-5">
                    <input type="number" class="form-control" value="" name="contact_name" id="contact_name" required/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-1">
                    <label for="">Fax</label>
                </div>
                <div class="col-md-5">
                    <input type="number" class="form-control" value="" name="contact_name" id="contact_name" required/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-1">
                    <label for="">Mailing Address</label>
                </div>
                <div class="col-md-5">
                    <input type="number" class="form-control" value="" name="contact_name" id="contact_name" required/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-1">
                    <label for="">City</label>
                </div>
                <div class="col-md-5">
                    <input type="number" class="form-control" value="" name="contact_name" id="contact_name" required/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-1">
                    <label for="">Zip Code</label>
                </div>
                <div class="col-md-5">
                    <input type="number" class="form-control" value="" name="contact_name" id="contact_name" required/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-1">
                    <label for="">State</label>
                </div>
                <div class="col-md-5">
                    <input type="number" class="form-control" value="" name="contact_name" id="contact_name" required/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-1">
                    <label for="">Country</label>
                </div>
                <div class="col-md-5">
                    <input type="number" class="form-control" value="" name="contact_name" id="contact_name" required/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-1">
                    <input type="checkbox" name="notify_by" value="Email" id="notify_by_email">
                </div>
                <div class="col-md-5">
                    <label for="notify_by_email"><span>Previous mailing address (only if at current mailing address for less than 2 years)</span></label>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-1">
                    <label for="">Status</label>
                </div>
                <div class="col-md-5">
                    <input type="number" class="form-control" value="" name="contact_name" id="contact_name" required/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-1">
                    <label for="">Assigned to</label>
                </div>
                <div class="col-md-5">
                    <input type="number" class="form-control" value="" name="contact_name" id="contact_name" required/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-1">
                    <label for="">Start Date</label>
                </div>
                <div class="col-md-5">
                    <input type="number" class="form-control" value="" name="contact_name" id="contact_name" required/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-1">
                    <label for="">Referred By</label>
                </div>
                <div class="col-md-5">
                    <input type="number" class="form-control" value="" name="contact_name" id="contact_name" required/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-1">
                    <input type="checkbox" name="notify_by" value="Email" id="notify_by_email">
                </div>
                <div class="col-md-5">
                    <label for="notify_by_email"><span>Portal Access</span></label>
                </div>
            </div>
        </div>
        <br>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-1">
                    <label for="">Client's User ID (Email)</label>
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-1">
                    <label for="">Language</label>
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-1">

                </div>
                <div class="col-md-5">
                    <button type="submit" class="btn btn-flat btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>