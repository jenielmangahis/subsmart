<div class="nsm-card primary">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><i class="bx bx-fw bx-user"></i>Customer Profile</span>
        </div>
    </div>
    <div class="nsm-card-content">
        <hr>
        <div class="row form_line">
            <div class="col-md-4">
                Status
            </div>
            <div class="col-md-8">
                <select data-type="customer_status" id="status" name="status" data-customer-source="dropdown" class="input_select" >
                    <option  value=""></option>
                    <?php foreach ($customer_status as $status): ?>
                        <option <?= isset($profile_info) ? ($profile_info->status == $status->name ? 'selected' : '') : '' ?> value="<?= $status->name ?>"><?= $status->name ?></option>
                    <?php endforeach; ?>
                </select>
                <a href="<?= base_url('customer/status'); ?>" target="_new" style="color:#58bc4f;font-size: 10px;"><span class="fa fa-plus"></span> Manage Status</a>&nbsp;&nbsp;
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
                <a href="javascript:void(0);" onclick="window.open('<?= base_url('customer/group') ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');" style="color:#58bc4f;font-size: 10px;"><span class="fa fa-plus"></span> Manage Customer Group</a>&nbsp;&nbsp;
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
                <select name="fk_sa_id" data-type="customer_sales_area" class="form-control">
                    <?php if( $salesAreaSelected ){ ?>
                        <option value="<?= $salesAreaSelected->sa_id; ?>"><?= $salesAreaSelected->sa_name; ?></option>
                    <?php } ?>
                </select>
                <a href="<?= base_url() ?>customer/settings/salesArea" target="_blank"  style="color:#58bc4f;font-size: 10px;"><span class="fa fa-plus"></span> Manage Sales Area</a>&nbsp;&nbsp;
            </div>
        </div>
        <?php 
            $business_name_css = 'display: none;';
            if(isset($profile_info) && $profile_info->customer_type == 'Business' ) { 
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
        <div class="row form_line">
            <div class="col-md-4">
                Country
            </div>
            <div class="col-md-8">
                <input data-type="customer_address_country" type="text" class="form-control" name="country" id="country" value="<?php if(isset($profile_info->country)){ echo $profile_info->country; } ?> " />
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
                County</span>
            </div>
            <div class="col-md-8">
                <input data-type="customer_address_county" type="text" class="form-control" name="county" id="county" value="<?php if(isset($profile_info->county)){ echo $profile_info->county; } ?>"/>
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
<?php include viewPath('v2/pages/customer/advance_customer_forms/customer_billing_info'); ?>
<script src="/assets/js/customer/components/email-input.js"></script>