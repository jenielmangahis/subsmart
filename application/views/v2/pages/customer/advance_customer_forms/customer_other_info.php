<style>
.badge-primary{
    background-color: #007bff;
}
.badge{
    display: inline-block;
    padding: 0.25em 0.4em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.25rem;
    margin-top: 9px;
}
.customer-notes-list{
    max-height: 200px;
    overflow: auto;
}
</style>
<div class="nsm-card primary">
<div class="nsm-card primary">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><i class="bx bx-fw bx-user"></i>Access Information</span>
        </div>
    </div>
    <div class="nsm-card-content">
        <hr>
        <div class="row form_line">
            <div class="col-md-6">
                Portal Status (on/off)
            </div>
            <div class="col-md-6">
                <input type="radio" name="portal_status" value="1" id="portal_status1" <?php if(isset($access_info)){ echo $access_info->portal_status == 1 ? 'checked': ''; } ?> >
                <span>On</span>
                &nbsp;&nbsp;
                <input type="radio" name="portal_status" value="0"  id="portal_status" <?php if(isset($access_info)){ echo $access_info->portal_status == 0 ? 'checked': ''; } ?>>
                <span>Off</span>
            </div>
        </div>        
        <div class="row form_line">
            <div class="col-md-6">
                Login
            </div>
            <div class="col-md-6">
                <input data-type="access_info_user" type="text" class="form-control" name="access_login" id="login" value="<?php if(isset($access_info)){ echo $access_info->access_login; } ?>"/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Password
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <input data-type="access_info_pass" type="text" class="form-control" name="access_password" id="password" data-value="<?php if(isset($access_info)){ echo $access_info->access_password; } ?>"/>
                    <div class="input-group-append">
                        <button data-action="access_info_generate_pass" class="nsm-button primary" type="button" style="font-size:17px;padding: 0;width: 35px;margin-top:5px;margin-left:5px;">
                            <i class='bx bx-refresh'></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php if(isset($access_info)): ?>
        <div class="row form_line mt-2">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <button type="button" class="nsm-button primary btn-md" name="reset_password" data-id="<?= $access_info->fk_prof_id; ?>" id="btn-notify-customer-new-pw" >Send Email Reset </button>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<div class="nsm-card primary">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><i class="bx bx-fw bx-user"></i>Custom Field</span>
        </div>
    </div>
    <div class="nsm-card-content" id="custom_field" data-section="custom_field"><hr>
        <a href="javascript:void;" id="add_field" class="nsm-button btn-small pull-right"><span class="fa fa-plus"></span> Add Field</a>
        <br style="clear:both;" />
        <?php if(isset($profile_info)):  ?>
            <?php $custom_fields = json_decode($profile_info->custom_fields); ?>
            <?php if(!empty($custom_fields)): ?>
            <?php foreach ($custom_fields as $field): ?>
                <div class="row form_line">
                    <div class="col-md-5">
                        Name
                        <input type="text" class="form-control" name="custom_name[]" value="<?= $field->name; ?>" />
                    </div>
                    <div class="col-md-5">
                        Value
                        <input type="text" class="form-control" name="custom_value[]" value="<?= $field->value; ?>" />
                    </div>
                    <div class="col-md-2">
                        <button style="margin-top: 24px; font-size:12px;" type="button" class="nsm-button primary items_remove_btn remove_item_row"><i class='bx bx-trash'></i></button>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php endif; ?>
        <?php else: ?>
            <div class="row form_line">
                <div class="col-md-5">
                    Name
                    <input type="text" class="form-control" name="custom_name[]" value="" />
                </div>
                <div class="col-md-5">
                    Value
                    <input type="text" class="form-control" name="custom_value[]" value="" />
                </div>
                <div class="col-md-2">
                    <button style="margin-top: 24px; font-size:12px;" type="button" class="nsm-button primary items_remove_btn remove_item_row"><i class='bx bx-trash'></i></button>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>
<div class="nsm-card primary">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><i class="bx bx-fw bx-user"></i>Notes</span>
        </div>
    </div>
    <div class="nsm-card-content"><hr>
        <div class="row form-line">   
            <textarea type="text" class="form-controls" name="notes" id="notes" rows="5"><?= isset($profile_info) ? $profile_info->notes : ''; ?></textarea>
        </div>
    </div>
</div>
    <?php if(isset($customer_notes)) :?>
        <div class="nsm-card primary">
            <div class="nsm-card-header">
                <div class="nsm-card-title">
                    <span><i class="bx bx-fw bx-user"></i>Existing Notes</span>
                </div>
            </div>
            <div class="nsm-card-content">
                    <div class="row">
                        <div class="customer-notes-list">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tbody>
                            <?php foreach ($customer_notes as $note) : ?>
                                <tr>
                                    <td style="width: 880px; text-align: left; vertical-align: top; font-size: 11px; color: #336699; padding:5px;background-color: #d9d9d9;border: 1px; border-style: solid; border-color: #999999;">
                                        <i class='bx bxs-calendar-event'></i> <?= $note->datetime; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; border: 1px; border-style: solid; border-color: #999999; background-color: #FFFF71; font-size: 11px;padding:5px">
                                        <?= $note->note; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
            </div>
        </div>
    <?php endif; ?>
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
    
        <div class="row mt-4">
            <div class="col-12 text-end">
                <button type="button" class="nsm-button primary btn-cancel"><i class='bx bx-fw bx-x'></i>Cancel</button>
                <?php if(isset($profile_info)): ?>
                    <input type="hidden" name="customer_id" value="<?= $profile_info->prof_id; ?>"/>
                <?php endif; ?>
                <button type="submit" class="nsm-button primary">
                    <i class="bx bx-fw bx-paper-plane"></i> <?=isset($profile_info) ? 'Save Changes' : 'Save'; ?>
                </button>
            </div>
        </div>
    </div>
</div>
