<?php 
    $contact1 = null;
    $contact2 = null;
    $contact3 = null;

    if (isset($contacts)) {
        if (isset($contacts[0])) {
            $contact1 = $contacts[0];
        }

        if (isset($contacts[1])) {
            $contact2 = $contacts[1];
        }

        if (isset($contacts[2])) {
            $contact3 = $contacts[2];
        }
    }
?>
<div class="nsm-card primary">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><i class="bx bx-fw bx-user"></i>Emergency Contacts</span>
        </div>
    </div>
    <div class="nsm-card-content"><hr>
        <div class="row form_line">
            <div class="col-md-4 ">
                Contact Name 1
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-6" style="padding-right:2px !important;">
                        <input type="text" class="form-control" placeholder="First Name" name="contact_first_name1" id="contact_first_name1" value="<?= isset($contact1) ? $contact1->first_name : "" ?>" style="margin-bottom: 5px;"/>
                    </div>
                    <div class="col-6" style="padding-left:2px !important;">
                        <input type="text" class="form-control" placeholder="Last Name" name="contact_last_name1" id="contact_last_name1" value="<?= isset($contact1) ? $contact1->last_name : "" ?>" style="margin-bottom: 5px;" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4 ">
                Relationship
            </div>
            <div class="col-md-8">
                <select data-type="emergency_contact_relationship" class="form-control" name="contact_relationship1">
                    <option><?= isset($contact1) ? $contact1->relation : "" ?></option>
                </select>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Phone Number
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="contact_phone1" id="contact_phone1" value="<?= isset($contact1) ? $contact1->phone : "" ?>"/>
            </div>
        </div>
        <div class="row form_line mt-3">
            <div class="col-md-4">
                Contact Name 2
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-6" style="padding-right:2px !important;">
                        <input type="text" class="form-control" placeholder="First Name" name="contact_first_name2" id="contact_first_name2" value="<?= isset($contact2) ? $contact2->first_name : "" ?>" style="margin-bottom: 5px;"/>
                    </div>
                    <div class="col-6" style="padding-left:2px !important;">
                        <input type="text" class="form-control" placeholder="Last Name" name="contact_last_name2" id="contact_last_name2" value="<?= isset($contact2) ? $contact2->last_name : "" ?>" style="margin-bottom: 5px;" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4 ">
                Relationship
            </div>
            <div class="col-md-8">
                <select data-type="emergency_contact_relationship" class="form-control" name="contact_relationship2">
                    <option><?= isset($contact2) ? $contact2->relation : "" ?></option>
                </select>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Phone Number
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="contact_phone2" id="contact_phone2" value="<?= isset($contact2) ? $contact2->phone : "" ?>"/>
            </div>
        </div>
        <div class="row form_line mt-3">
            <div class="col-md-4">
                Contact Name 3
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-6" style="padding-right:2px !important;">
                        <input type="text" class="form-control" placeholder="First Name" name="contact_first_name3" id="contact_first_name3" value="<?= isset($contact3) ? $contact3->first_name : "" ?>" style="margin-bottom: 5px;"/>
                    </div>
                    <div class="col-6" style="padding-left:2px !important;">
                        <input type="text" class="form-control" placeholder="Last Name" name="contact_last_name3" id="contact_last_name3" value="<?= isset($contact3) ? $contact3->last_name : "" ?>" style="margin-bottom: 5px;" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4 ">
                Relationship
            </div>
            <div class="col-md-8">
                <select data-type="emergency_contact_relationship" class="form-control" name="contact_relationship3">
                    <option><?= isset($contact3) ? $contact3->relation : "" ?></option>
                </select>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Phone Number
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="contact_phone3" id="contact_phone3" value="<?= isset($contact3) ? $contact3->phone : "" ?>"/>
            </div>
        </div>
    </div>
</div>