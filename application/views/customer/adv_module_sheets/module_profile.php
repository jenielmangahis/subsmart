<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="module_ac">
    <div class="row">
        <div class="col-md-12 module_header">
            <p class="module_title">Profile Module</p>
        </div>
        <div class="col-sm-12" id="profile_module">
            <div class="col-sm-12 text-right-sm" style="align:right;">
                <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                    <input type="checkbox" name="office_switch" class="onoffswitch-checkbox" data-customize="open" id="onoff-prof">
                    <label class="onoffswitch-label" for="onoff-prof">
                        <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Sales Area <span class="required"> *</span></label>
                    </div>
                    <div class="col-md-8">
                        <select id="fk_sa_id" name="fk_sa_id" data-customer-source="dropdown" class="input_select" required>
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
                        <label for="">Name Prefix</label>
                    </div>
                    <div class="col-md-8">
                        <select id="prefix" name="prefix" data-customer-source="dropdown" class="form-controls input_select">
                            <option value=""></option>
                            <option value="Captain">Captain</option>
                            <option value="Cnl.">Cnl.</option>
                            <option value="Colonel">Colonel</option>
                            <option value="Dr.">Dr.</option>
                            <option value="Gen.">Gen.</option>
                            <option value="Judge">Judge</option>
                            <option value="Lady">Lady</option>
                            <option value="Lieutenant">Lieutenant</option>
                            <option value="Lord">Lord</option>
                            <option value="Lt.">Lt.</option>
                            <option value="Madam">Madam</option>
                            <option value="Major">Major</option>
                            <option value="Master">Master</option>
                            <option value="Miss">Miss</option>
                            <option value="Mister">Mister</option>
                            <option value="Mr.">Mr.</option>
                            <option value="Maj.">Maj.</option>
                            <option value="Mrs.">Mrs.</option>
                            <option value="Ms.">Ms.</option>
                            <option value="Pastor">Pastor</option>
                            <option value="Private">Private</option>
                            <option value="Prof.">Prof.</option>
                            <option value="Pvt.">Pvt.</option>
                            <option value="Rev.">Rev.</option>
                            <option value="Sergeant">Sergeant</option>
                            <option value="Sgt">Sgt</option>
                            <option value="Sir">Sir</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">First Name</label> <span class="required"> *</span>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="first_name" id="first_name" value="<?php if(isset($profile_info->first_name)){ echo $profile_info->first_name; } ?>" required/>
                    </div>
                </div>
            </div>

            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Middle Initial</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" maxlength="2" name="middle_name" id="middle_name" value="<?php if(isset($profile_info)){ echo $profile_info->middle_name; } ?>" />
                    </div>
                </div>
            </div>

            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Last Name</label> <span class="required"> *</span>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="last_name" id="last_name" value="<?php if(isset($profile_info)){ echo $profile_info->last_name; } ?>" required/>
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Date Of Birth </label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="date_of_birth" id="date_picker" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Suffix</label>
                    </div>
                    <div class="col-md-8">
                        <select id="suffix" name="suffix" data-customer-source="dropdown" class="input_select" >
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
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Business Name</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="business_name" id="business_name" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Email</label> <span class="required"> *</span>
                    </div>
                    <div class="col-md-8">
                        <input type="email" class="form-control" name="email" id="email" value="<?php if(isset($profile_info)){ echo $profile_info->email; } ?>" required/>
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Social Security Number</label>
                    </div>
                    <div class="col-md-8">
                        <input type="number" class="form-control" name="ssn" id="ssn" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Phone (H)</label>
                    </div>
                    <div class="col-md-8">
                        <input type="number" class="form-control" name="phone_h" id="phone_h" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Phone (W)</label>
                    </div>
                    <div class="col-md-8">
                        <input type="number" class="form-control" name="phone_w" id="phone_w" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Phone (M)</label>
                    </div>
                    <div class="col-md-8">
                        <input type="number" class="form-control" name="phone_m" id="phone_m" value="<?php if(isset($profile_info->phone_m)){ echo $profile_info->phone_m; } ?>"  />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Fax</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="fax" id="fax" value="<?php if(isset($profile_info->fax)){ echo $profile_info->fax; } ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Mailing Address</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="mail_add" id="mail_add" value="<?php if(isset($profile_info->mail_add)){ echo $profile_info->mail_add; } ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">City</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="city" id="city" value="<?php if(isset($profile_info->city)){ echo $profile_info->city; } ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">State</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="state" id="state" value="<?php if(isset($profile_info->state)){ echo $profile_info->state; } ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Country</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="country" id="country" value="<?php if(isset($profile_info->country)){ echo $profile_info->country; } ?> " />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Zip Code</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="zip_code" id="zip_code" value="<?php if(isset($profile_info->zip_code)){ echo $profile_info->zip_code; } ?>"/>
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Cross Street</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="cross_street" id="cross_street" value="<?php if(isset($profile_info->cross_street)){ echo $profile_info->cross_street; } ?>"/>
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Subdivision</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="subdivision" id="subdivision" value="<?php if(isset($profile_info->subdivision)){ echo $profile_info->subdivision; } ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Image/Logo File</label><br/>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="img_path" id="img_path" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label class="alarm_label"> <span >Pay History </span>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="pay_history" id="pay_history" />
                    </div>
                </div>
            </div>
        </div>
        <br><br>

    </div>
</div>