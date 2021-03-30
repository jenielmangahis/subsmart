<div class="card">
    <div class="card-header">
        <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Customer Profle</h6>
    </div>
    <div class="card-body">
        <div class="row form_line">
            <div class="col-md-4">
                <label>Sales Area <span class="required"> *</span></label>
            </div>
            <div class="col-md-8">
                <select id="fk_sa_id" name="fk_sa_id" data-customer-source="dropdown" class="input_select searchable-dropdown" required>
                    <?php foreach ($sales_area as $sa): ?>
                        <option <?php if(isset($profile_info)){ if($profile_info->fk_sa_id == $sa->sa_id){ echo 'selected'; } } ?> value="<?= $sa->sa_id; ?>"><?= $sa->sa_name; ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                <label for="">Business Name</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="business_name" id="business_name" value="<?php if(isset($profile_info)){ echo $profile_info->business_name; } ?>"/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                <label>First Name <span class="required"> *</span></label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="first_name" id="first_name" value="<?php if(isset($profile_info->first_name)){ echo $profile_info->first_name; } ?>" required/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                <label for="">Middle Initial</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" maxlength="1" name="middle_name" id="middle_name" value="<?php if(isset($profile_info)){ echo $profile_info->middle_name; } ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                <label for="">Last Name <span class="required"> *</span></label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="last_name" id="last_name" value="<?php if(isset($profile_info)){ echo $profile_info->last_name; } ?>" required/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                <label>Name Prefix</label>
            </div>
            <div class="col-md-8">
                <select id="prefix" name="prefix" data-customer-source="dropdown" class="form-controls input_select searchable-dropdown">
                    <?php
                    for ($prefix=0;$prefix<28;$prefix++){
                        ?>
                        <option <?php if(isset($profile_info)){ if($profile_info->prefix == prefix_name($prefix)){ echo 'selected'; } } ?> value="<?= prefix_name($prefix); ?>">
                            <?= prefix_name($prefix); ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                <label for="">Suffix</label>
            </div>
            <div class="col-md-8">
                <select id="suffix" name="suffix" data-customer-source="dropdown" class="input_select searchable-dropdown" >
                    <?php
                    for ($suffix=0;$suffix<14;$suffix++){
                        ?>
                        <option <?php if(isset($profile_info)){ if($profile_info->suffix == suffix_name($suffix)){ echo 'selected'; } } ?> value="<?= suffix_name($suffix); ?>"><?= suffix_name($suffix); ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                <label for="">Address <span class="required"> *</span></label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="mail_add" id="mail_add" value="<?php if(isset($profile_info->mail_add)){ echo $profile_info->mail_add; } ?>" required/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                <label for="">City <span class="required"> *</span></label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="city" id="city" value="<?php if(isset($profile_info->city)){ echo $profile_info->city; } ?>" required/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                <label for="">State <span class="required"> *</span></label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="state" id="state" value="<?php if(isset($profile_info->state)){ echo $profile_info->state; } ?>" required/>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-4">
                <label for="">Zip Code</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="zip_code" id="zip_code" value="<?php if(isset($profile_info->zip_code)){ echo $profile_info->zip_code; } ?>"/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                <label for="">Cross Street</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="cross_street" id="cross_street" value="<?php if(isset($profile_info->cross_street)){ echo $profile_info->cross_street; } ?>"/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                <label for="">County</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="country" id="country" value="<?php if(isset($profile_info->country)){ echo $profile_info->country; } ?> " />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                <label for="">Subdivision</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="subdivision" id="subdivision" value="<?php if(isset($profile_info->subdivision)){ echo $profile_info->subdivision; } ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                <label for="">Social Security No.</label>
            </div>
            <div class="col-md-8">
                <input type="text" placeholder="xxx-xx-xxxx" maxlength="11" class="form-control" name="ssn" id="ssn" value="<?php if(isset($profile_info)){ echo $profile_info->ssn; } ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                <label for="">Date Of Birth </label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="date_of_birth" id="date_picker" value="<?php if(isset($profile_info)){ echo $profile_info->date_of_birth; } ?>"/>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-4">
                <label for="">Email <span class="required"> *</span></label>
            </div>
            <div class="col-md-8">
                <input type="email" class="form-control" name="email" id="email" value="<?php if(isset($profile_info)){ echo $profile_info->email; } ?>" required/>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-4">
                <label for="">Phone (H)</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="phone_h" id="phone_h" value="<?php if(isset($profile_info)){ echo $profile_info->phone_h; } ?>" />
            </div>
        </div>
        <!--<div class="row form_line">
            <div class="col-md-4">
                <label for="">Phone (W)</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="phone_w" id="phone_w" value="<?php if(isset($profile_info)){ echo $profile_info->phone_w; } ?>" />
            </div>
        </div>-->
        <div class="row form_line">
            <div class="col-md-4">
                <label for="">Phone (M) <span class="required"> *</span></label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="phone_m" id="phone_m" value="<?php if(isset($profile_info->phone_m)){ echo $profile_info->phone_m; } ?>" required />
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <label for="">Contact Name 1</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="contact_name1" id="contact_name1" value="<?php if(isset($alarm_info)){ echo $alarm_info->contact_name1; } ?>"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">Contact Phone 1</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="contact1" id="contact1" value="<?php if(isset($alarm_info)){ echo $alarm_info->contact1; } ?>"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">Contact Name 2</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="contact_name2" id="contact_name2" value="<?php if(isset($alarm_info)){ echo $alarm_info->contact_name2; } ?>"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">Contact Phone 2</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="contact2" id="contact2" value="<?php if(isset($alarm_info)){ echo $alarm_info->contact2; } ?>"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">Contact Name 3</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="contact_name3" id="contact_name3" value="<?php if(isset($alarm_info)){ echo $alarm_info->contact_name3; } ?>" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">Contact Phone 3</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="contact3" id="contact3" value="<?php if(isset($alarm_info)){ echo $alarm_info->contact3; } ?>"/>
            </div>
        </div>

        <!--<div class="row form_line">
            <div class="col-md-4">
                <label for="">Fax</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="fax" id="fax" value="<?php if(isset($profile_info->fax)){ echo $profile_info->fax; } ?>" />
            </div>
        </div>-->
        <div class="row form_line">
            <div class="col-md-4">
                <label class="alarm_label"> <span >Pay History </span>
            </div>
            <div class="col-md-8">
                <select id="pay_history" name="pay_history" class="input_select searchable-dropdown">
                    <option <?php if(isset($profile_info)){ if($profile_info->pay_history == 1){ echo 'selected'; } } ?> value="1">1 - Excellent</option>
                    <option <?php if(isset($profile_info)){ if($profile_info->pay_history == 2){ echo 'selected'; } } ?> value="2">2 - Good</option>
                    <option <?php if(isset($profile_info)){ if($profile_info->pay_history == 3){ echo 'selected'; } } ?> value="3">3 - Fair</option>
                    <option <?php if(isset($profile_info)){ if($profile_info->pay_history == 4){ echo 'selected'; } } ?> value="4">4 - Poor</option>
                    <option <?php if(isset($profile_info)){ if($profile_info->pay_history == 5){ echo 'selected'; } } ?> value="5">5 - Unsatisfactory</option>
                </select>
            </div>
        </div>
    </div>

    <?php include viewPath('customer/advance_customer_forms/customer_billing_info'); ?>
</div>