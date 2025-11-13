<div class="nsm-card primary">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><i class="bx bx-fw bx-user"></i>Customer Profile</span>
            <div class="form-check" style="float:right;">
                <input class="form-check-input" type="checkbox" value="1" <?= $profile_info->is_favorite == 1 ? 'checked="checked"' : ''; ?> name="is_favorite" id="chk-favorite">
                <label class="form-check-label" for="chk-favorite">
                    Favorite
                </label>
            </div>
        </div>
    </div>
    <div class="nsm-card-content">
        <hr>
        <div class="row form_line">
            <div class="col-md-4">
                Status
            </div>
            <div class="col-md-8">
                <?php 
                    $status = '';
                    if( $defaultCustomerStatus ){
                        $status = $defaultCustomerStatus->name;
                    }

                    if( $profile_info ){
                        $status = $profile_info->status;
                    }
                ?>
                <select data-type="customer_status" id="status" name="status" data-customer-source="dropdown" class="input_select status-select" >
                    <option  value=""></option>
                    <?php foreach ($customer_status as $st): ?>
                        <option data-custom-value="<?= $st->name; ?>" <?= $status == $st->name ? 'selected="selected"' : ''; ?> value="<?= $st->name ?>"><?= $st->name ?></option>
                    <?php endforeach; ?>
                </select>
                <a href="javascript:void(0);" class="nsm-button btn-small" id="btn-quick-add-customer-status"><span class="fa fa-plus"></span> Add Status</a>
            </div>
        </div>        
        <div id="cancelled-related-fields-container-a" class="office_info-optional" <?= $profile_info->status != 'Cancelled' || $profile_info->status != 'Cancel' ? 'style="display:none;"' : ''; ?>>
            <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'office-use-information', 'cancel_date') == 0 ? 'style="display:none;"' : ''; ?>>
                <div class="col-md-4"><?= getCustomerFieldValue($companyFormSetting, 'office-use-information', 'cancel_date'); ?></div>
                <div class="col-md-8">
                    <input data-type="office_info_cancel_date" type="text" class="form-control" name="cancel_date" id="office-info-cancel-date" value="<?php if(isset($office_info)){ echo  $office_info->cancel_date; } ?>" />
                </div>
            </div>
            <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'office-use-information', 'cancel_reason') == 0 ? 'style="display:none;"' : ''; ?>>
                <div class="col-md-4"><?= getCustomerFieldValue($companyFormSetting, 'office-use-information', 'cancel_reason'); ?></div>
                <div class="col-md-8">
                    <select id="cancel_reason" name="cancel_reason" data-customer-source="dropdown" class="input_select" >
                        <option <?php if(isset($office_info)){ if($office_info->cancel_reason == ""){ echo 'selected'; } } ?> value="">Select</option>
                        <option <?php if(isset($office_info)){ if($office_info->cancel_reason == 'DS'){ echo 'selected'; } } ?> value="DS">Dissatisfied with Service</option>
                        <option <?php if(isset($office_info)){ if($office_info->cancel_reason == 'FH'){ echo 'selected'; } } ?> value="FH">Financial Hardship</option>
                        <option <?php if(isset($office_info)){ if($office_info->cancel_reason == 'FC'){ echo 'selected'; } } ?> value="FC">Fulfilled Contract</option>
                        <option <?php if(isset($office_info)){ if($office_info->cancel_reason == 'Moving'){ echo 'selected'; } } ?> value="Moving">Moving</option>
                        <option <?php if(isset($office_info)){ if($office_info->cancel_reason == 'NP'){ echo 'selected'; } } ?> value="NP">Non-Payment</option>
                        <option <?php if(isset($office_info)){ if($office_info->cancel_reason == 'Paid BOC'){ echo 'selected'; } } ?> value="Paid BOC">Paid BOC</option>
                        <option <?php if(isset($office_info)){ if($office_info->cancel_reason == 'PA'){ echo 'selected'; } } ?> value="PA">Passed Away</option>
                        <option <?php if(isset($office_info)){ if($office_info->cancel_reason == 'SUC'){ echo 'selected'; } } ?> value="SUC">Still Under Contruct</option>
                    </select>
                </div>
            </div>

            <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'office-use-information', 'collections') == 0 ? 'style="display:none;"' : ''; ?>>
                <div class="col-md-4"><?= getCustomerFieldValue($companyFormSetting, 'office-use-information', 'collections'); ?></div>
                <div class="col-md-8">
                    <select id="collections" name="collections" data-customer-source="dropdown" class="form-controls input_select">
                        <option value=""></option>
                        <option <?= isset($alarm_info) && $alarm_info->collections == 'In Process' ?  'selected' : '';?> value="In Process">In Process</option>
                        <option <?= isset($alarm_info) && $alarm_info->collections == 'Sent' ?  'selected' : '';?> value="Sent">Sent</option>
                        <option <?= isset($alarm_info) && $alarm_info->collections == 'None Collectable' ?  'selected' : '';?> value="None Collectable">None Collectable</option>
                        <option <?= isset($alarm_info) && $alarm_info->collections == 'In Collections' ?  'selected' : '';?> value="In Collections">In Collection</option>
                        <option <?= isset($alarm_info) && $alarm_info->collections == 'Civil Suit' ?  'selected' : '';?> value="Civil Suit">Civil Suit</option>
                        <option <?= isset($alarm_info) && $alarm_info->collections == 'Taken Action' ?  'selected' : '';?> value="Taken Action">Taken Action</option>
                    </select>
                </div>
            </div>

            <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'office-use-information', 'collect_date') == 0 ? 'style="display:none;"' : ''; ?>>
                <div class="col-md-4"><?= getCustomerFieldValue($companyFormSetting, 'office-use-information', 'collect_date'); ?></div>
                <div class="col-md-8">
                    <input data-type="office_info_collection_date" type="text" class="form-control date_picker" name="collect_date" id="office-use-collection-date" value="<?php if(isset($office_info)){ echo $office_info->collect_date; } ?>" />
                </div>
            </div>
            <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'office-use-information', 'collect_amount') == 0 ? 'style="display:none;"' : ''; ?>>
                <div class="col-md-4"><?= getCustomerFieldValue($companyFormSetting, 'office-use-information', 'collect_amount'); ?></div>
                <div class="col-md-8">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">$</span>
                        </div>
                        <input type="number" step="any" class="form-control input_select" name="collect_amount" id="office-info-collect-amount" value="<?php if(isset($office_info)){ echo $office_info->collect_amount; } ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Customer Type
            </div>
            <div class="col-md-8">
                <select 
                    id="customer_type" 
                    name="customer_type" 
                    data-customer-source="dropdown" 
                    class="form-controls input_select"
                    data-value="<?php if(isset($profile_info)) { echo $profile_info->customer_type; } ?>" 
                >
                    <option value="Residential">Residential</option>
                    <option value="Commercial">Commercial</option>
                </select>
            </div>
        </div>
        <?php 
            $business_name_css = 'display: none;';
            if(isset($profile_info) && $profile_info->customer_type == 'Commercial' ) { 
                $business_name_css = ''; 
            }
        ?>
        <div class="row" id="businessName" style="<?= $business_name_css; ?>">
            <div class="col-md-4" id="businessNameLabel">
                <label for="" >Business Name
            </div>
            <div class="col-md-8" id="businessNameInput">
                <input type="text" class="form-control" name="business_name" id="business_name" value="<?php if(isset($profile_info)){ echo $profile_info->business_name; } ?>"/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Customer Group
            </div>
            <div class="col-md-8">
                <select id="customer_group" name="customer_group" data-customer-source="dropdown" class="form-controls input_select">
                    <?php
                        foreach($customerGroups as $customer_groups) {
                            if ($customer_groups->id == $profile_info->customer_group_id) {
                                echo "<option value='$customer_groups->id' selected>$customer_groups->title</option>";
                            } else {
                                echo "<option value='$customer_groups->id'>$customer_groups->title</option>";
                            }
                        }
                    ?>
                </select>
                <a href="javascript:void(0);" class="nsm-button btn-small" id="btn-quick-add-customer-group"><span class="fa fa-plus"></span> Add Customer Group</a>
            </div>
        </div>
        <?php if($company_id == 1): ?>
        <div class="row form_line">
            <div class="col-md-4">
                Industry Type
            </div>
            <div class="col-md-8">
                <select 
                    id="industry_type" 
                    name="industry_type" 
                    data-customer-source="dropdown" 
                    class="form-controls input_select"
                >
                    <option>Select your Industry</option>
                    <?php $businessTypeName  = "";
                        foreach($industryTypes  as $industryType ){ ?>
                           <?php if ($businessTypeName!== $industryType->business_type_name ) { ?> 
                                    <optgroup label="<?php echo $industryType->business_type_name; ?>">
                           <?php  $businessTypeName =  $industryType->business_type_name; }      ?>  
                           <?php 
                            $selected_industry_type = 0;
                            if( isset($profile_info) ){
                                $selected_industry_type = $profile_info->industry_type_id;
                            }
                           ?>
                            <option <?= $selected_industry_type == $industryType->id ? 'selected="selected"' : ''; ?> value="<?php echo $industryType->id; ?>"><?php echo $industryType->name; ?></option>
                        <?php  }   ?>
                </select>
            </div>
        </div>
        <?php endif; ?>
        <div class="row form_line">
            <div class="col-md-4">
                Sales Area
            </div>
            <div class="col-md-8">
                <select name="fk_sa_id" data-type="customer_sales_area" class="form-control" id="sales-area">
                    <?php if( $salesAreaSelected ){ ?>
                        <option value="<?= $salesAreaSelected->sa_id; ?>"><?= $salesAreaSelected->sa_name; ?></option>
                    <?php } ?>
                </select>
                <a href="javascript:void(0);" class="nsm-button btn-small" id="btn-quick-add-sales-area"><span class="fa fa-plus"></span> Add Sales Area</a>                
            </div>
        </div>        
        <?php if( $profile_info ){ ?>
        <div class="row form_line">
            <div class="col-md-4">
                Customer ID <span class="required"> *</span>
            </div>
            <?php 
                $alarmcom_customer_id = ($alarmcom_info['customer_id'] != "") ? $alarmcom_info['customer_id'] : $profile_info->customer_no;
            ?>
            <div class="col-md-8">
                <input type="text" class="form-control" name="customer_no" id="customer_no" value="<?= $alarmcom_customer_id; ?>" required/>
            </div>
        </div>
        <?php } ?>
        <div class="row form_line">
            <div class="col-md-4">
                First Name <span class="required"> *</span>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="first_name" id="first_name" value="<?php if(isset($profile_info->first_name)){ echo $profile_info->first_name; } ?>" required/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Middle Initial
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" maxlength="1" name="middle_name" id="middle_name" value="<?php if(isset($profile_info)){ echo $profile_info->middle_name; } ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Last Name <span class="required"> *</span>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="last_name" id="last_name" value="<?php if(isset($profile_info)){ echo $profile_info->last_name; } ?>" required/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Name Prefix
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
                Suffix
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
        <!-- <div class="row form_line">
            <div class="col-md-4">
                Country
            </div>
            <div class="col-md-8">
                <input data-type="customer_address_country" type="text" class="form-control" name="country" id="country" value="<?php if(isset($profile_info->country)){ echo $profile_info->country; } ?> " />
            </div>
        </div> -->
        <div class="row form_line">
            <div class="col-md-4">
                County</span>
            </div>
            <div class="col-md-8">
                <input data-type="customer_address_county" type="text" class="form-control" name="county" id="county" value="<?php if(isset($profile_info->county)){ echo $profile_info->county; } ?>"/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Address <span class="required"> *</span>
            </div>
            <div class="col-md-8">
                <input data-type="customer_address" type="text" class="form-control" name="mail_add" id="mail_address" value="<?php if(isset($profile_info->mail_add)){ echo $profile_info->mail_add; } ?>" required/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                City <span class="required"> *</span>
            </div>
            <div class="col-md-8">
                <input data-type="customer_address_city" type="text" class="form-control" name="city" id="city" value="<?php if(isset($profile_info->city)){ echo $profile_info->city; } ?>" required/>
            </div>
        </div>        
        <div class="row form_line">
            <div class="col-md-4">
                State <span class="required"> *</span>
            </div>
            <div class="col-md-8">
                <input data-type="customer_address_state" type="text" class="form-control" name="state" id="state" value="<?php if(isset($profile_info->state)){ echo $profile_info->state; } ?>" required/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Zip Code <span class="required"> *</span>
            </div>
            <div class="col-md-8">
                <input required data-type="customer_address_zip" type="text" class="form-control" name="zip_code" id="zip_code" value="<?php if(isset($profile_info->zip_code)){ echo $profile_info->zip_code; } ?>"/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Cross Street
            </div>
            <div class="col-md-8">
                <input data-type="customer_address_street" type="text" class="form-control" name="cross_street" id="cross_street" value="<?php if(isset($profile_info->cross_street)){ echo $profile_info->cross_street; } ?>"/>
            </div>
        </div>                
        <div class="row form_line">
            <div class="col-md-4">
                Subdivision
            </div>
            <div class="col-md-8">
                <input data-type="customer_address_subdivision" type="text" class="form-control" name="subdivision" id="subdivision" value="<?php if(isset($profile_info->subdivision)){ echo $profile_info->subdivision; } ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Social Security No.
            </div>
            <div class="col-md-8">
                <input type="text" placeholder="xxx-xx-xxxx" maxlength="11" class="form-control" name="ssn" id="ssn" value="<?php if(isset($profile_info)){ echo $profile_info->ssn; } ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Date Of Birth 
            </div>
            <div class="col-md-8">
                <?php 
                    $date_of_birth = date("m/d/Y");
                    if( $profile_info && strtotime($profile_info->date_of_birth) > 0 ){
                        $date_of_birth = date("m/d/Y", strtotime($profile_info->date_of_birth));
                    }
                ?>
                <input type="text" placeholder="" class="form-control" name="date_of_birth" id="date_of_birth" value="<?= $date_of_birth; ?>" />
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-4">
                Email 
            </div>
            <div class="col-md-8">
                <input data-type="customer_email" type="email" class="form-control email-input-element" name="email" id="email" value="<?php if(isset($profile_info)){ echo $profile_info->email; } ?>" />
            </div>
        </div>

        <div class="row form_line">
            <?php 
            $phone_h;
            $phone_m;

            if(strpos($profile_info->phone_h, "Mobile:") !== false){
                $str = $profile_info->phone_h;
                $exp = explode("Mobile:",$str);
                $phone_h = preg_replace('/\s+/', '-', ltrim($exp[0]));
                $phone_m = preg_replace('/\s+/', '-', ltrim($exp[1]));
             }else{
                $phone = preg_replace('/\s+/', '-', ltrim($profile_info->phone_h));
             } ?>
            <div class="col-md-4">
                Phone (H)
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="phone_h" id="phone_h" value="<?php if(isset($profile_info)){ echo $phone_h == null ? $phone : $phone_h; } ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Phone (M) <span class="required"> *</span>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="phone_m" id="phone_m" value="<?php if(isset($profile_info->phone_h) || isset($profile_info->phone_m)){ echo $profile_info->phone_m != null ? $profile_info->phone_m : $phone_m; } ?>" required />
            </div>
        </div>
    </div>
</div>
<script src="/assets/js/customer/components/email-input.js"></script>