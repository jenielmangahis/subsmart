<div class="card">
    <div class="card-header">
        <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Customer Information</h6>
    </div>
    <div class="card-body">
        <div class="row form_line">
            <div class="col-md-6">
                <label>Status</label>
            </div>
            <div class="col-md-6">
                <?= !empty($profile_info->status) ? $profile_info->status : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label>Customer Type</label>
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->status) ? $profile_info->status : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label>Sales Area</label>
            </div>
            <div class="col-md-6">
                <?php $salesArea='---'; foreach ($sales_area as $sa): ?>
                    <?php if(isset($profile_info) && $profile_info->fk_sa_id!=0){
                        if($profile_info->fk_sa_id == $sa->sa_id){
                            $salesArea = $sa->sa_name;
                        }
                    } ?>
                <?php endforeach ?>
                <?= $salesArea ?>
            </div>
        </div>
        <div class="row form_line" id="businessName">
            <div class="col-md-6" id="businessNameLabel">
                <label for="" >Business Name</label>
            </div>
            <div class="col-md-6" id="businessNameInput">
                <?= isset($profile_info) && !empty($profile_info->business_name) ? $profile_info->business_name : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label>First Name </label>
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->first_name) ? $profile_info->first_name : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Middle Initial</label>
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->middle_name) ? strtoupper($profile_info->middle_name) : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Last Name</label>
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->last_name) ? $profile_info->last_name : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label>Name Prefix</label>
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->prefix) ? $profile_info->prefix : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Suffix</label>
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->suffix) ? $profile_info->suffix : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Address </label>
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->mail_add) ? $profile_info->mail_add : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">City </label>
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->city) ? $profile_info->city : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">State </label>
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->state) ? $profile_info->state : '---';?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Zip Code</label>
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->zip_code) ? $profile_info->zip_code : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Cross Street</label>
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->cross_street) ? $profile_info->cross_street : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">County</label>
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->country) ? $profile_info->country : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Subdivision</label>
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->subdivision) ? $profile_info->subdivision : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Social Security No.</label>
            </div>
            <div class="col-md-6">
                <?php
                    $ssn_numbers = explode('-',$profile_info->ssn);
                    if(isset($ssn_numbers[2])){
                        echo '**-***-'.$ssn_numbers[2];
                    }else{
                        echo 'n/a';
                    }
                ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Date Of Birth </label>
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->date_of_birth) ? $profile_info->date_of_birth : '---';?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Email </label>
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->email) ? $profile_info->email : '---';?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Phone (H)</label>
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->phone_h) ? $profile_info->phone_h : '---';?>
            </div>
        </div>
        <!--<div class="row form_line">
            <div class="col-md-6">
                <label for="">Phone (W)</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="phone_w" id="phone_w" value="<?php if(isset($profile_info)){ echo $profile_info->phone_w; } ?>" />
            </div>
        </div>-->
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Phone (M)</label>
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->phone_m) ? $profile_info->phone_m : '---';?>
            </div>
        </div>
        <hr>
        <div class="row form_line">
            <div class="col-md-6 ">
                <label for="">Contact Name 1</label>
            </div>
            <div class="col-md-6">
                <?= !empty($profile_info->contact_name1) ? $profile_info->contact_name1 : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Contact Phone 1</label>
            </div>
            <div class="col-md-6">
                <?= !empty($profile_info->contact_phone1) ? $profile_info->contact_phone1 : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Contact Name 2</label>
            </div>
            <div class="col-md-6">
                <?= !empty($profile_info->contact_name2) ? $profile_info->contact_name2 : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Contact Phone 2</label>
            </div>
            <div class="col-md-6">
                <?= !empty($profile_info->contact_phone2) ? $profile_info->contact_phone2 : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Contact Name 3</label>
            </div>
            <div class="col-md-6">
                <?= !empty($profile_info->contact_name3) ? $profile_info->contact_name3 : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Contact Phone 3</label>
            </div>
            <div class="col-md-6">
                <?= !empty($profile_info->contact_phone3) ? $profile_info->contact_phone3 : '---';?>
            </div>
        </div>

        <!--<div class="row form_line" id="fax_">
            <div class="col-md-6">
                <label for="">Fax</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="fax" id="fax" value="<?php if(isset($profile_info->fax)){ echo $profile_info->fax; } ?>" />
            </div>
        </div>-->

    </div>

    <?php include viewPath('customer/advance_customer_forms/preview_billing_info'); ?>
</div>