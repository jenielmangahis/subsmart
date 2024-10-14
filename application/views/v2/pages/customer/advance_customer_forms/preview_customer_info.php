<div class="card">
    <div class="card-header">
        <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Customer Information</h6>
    </div>
    <div class="card-body">
        <div class="row form_line">
            <div class="col-md-6">
                <label>Customer Type
            </div>
            <div class="col-md-6">
                <?= !empty($profile_info->customer_type) ? $profile_info->customer_type : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label>Sales Area
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
                <label for="" >Business Name
            </div>
            <div class="col-md-6" id="businessNameInput">
                <?= isset($profile_info) && !empty($profile_info->business_name) ? $profile_info->business_name : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label>First Name 
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->first_name) ? $profile_info->first_name : 'n/a';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Middle Initial
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->middle_name) ? strtoupper($profile_info->middle_name) : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Last Name
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->last_name) ? $profile_info->last_name : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label>Name Prefix
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->prefix) ? $profile_info->prefix : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Suffix
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->suffix) ? $profile_info->suffix : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Address 
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->mail_add) ? $profile_info->mail_add : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                City 
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->city) ? $profile_info->city : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                State 
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->state) ? $profile_info->state : '---';?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                Zip Code
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->zip_code) ? $profile_info->zip_code : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Cross Street
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->cross_street) ? $profile_info->cross_street : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                County
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->country) ? $profile_info->country : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Subdivision
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->subdivision) ? $profile_info->subdivision : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Social Security No.
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
                Date Of Birth 
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->date_of_birth) ? $profile_info->date_of_birth : '---';?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                Email 
            </div>
        </div>
        <div class="row g-1">
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Billing Method</label>
            </div>            
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?php $bm = bill_methods($billing_info->bill_method); ?> <?= !empty($bm['description']) ? $bm['description'] : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6" style="<?= $billing_info->bill_method != 'CHECK' && $billing_info->bill_method != 'ACH' ? 'display:none;' : ''; ?>">
                <label class="content-subtitle fw-bold">Check Number</label>
            </div>
            <div class="col-12 col-md-6" style="<?= $billing_info->bill_method != 'CHECK' && $billing_info->bill_method != 'ACH' ? 'display:none;' : ''; ?>">
                <label class="content-subtitle"><?= !empty($billing_info->check_num) ? $billing_info->check_num : '---' ?></label>
            </div>
            <div class="col-12 col-md-6" style="<?= $billing_info->bill_method != 'CHECK' && $billing_info->bill_method != 'ACH' ? 'display:none;' : ''; ?>">
                <label class="content-subtitle fw-bold">Routing Number</label>
            </div>
            <div class="col-12 col-md-6" style="<?= $billing_info->bill_method != 'CHECK' && $billing_info->bill_method != 'ACH' ? 'display:none;' : ''; ?>">
                <label class="content-subtitle"><?= !empty($billing_info->routing_num) ? $billing_info->routing_num : '---' ?></label>
            </div>
            <div class="col-12 col-md-6" style="<?= $billing_info->bill_method != 'CHECK' && $billing_info->bill_method != 'ACH' ? 'display:none;' : ''; ?>">
                <label class="content-subtitle fw-bold">Account Number</label>
            </div>
            <div class="col-12 col-md-6" style="<?= $billing_info->bill_method != 'CHECK' && $billing_info->bill_method != 'ACH' ? 'display:none;' : ''; ?>">
                <label class="content-subtitle"><?= !empty($billing_info->acct_num) ? $billing_info->acct_num : '---' ?></label>
            </div>

            <div class="col-12 col-md-6" style="<?= $billing_info->bill_method != 'CHECK' && $billing_info->bill_method != 'ACH' ? 'display:none;' : ''; ?>">
                <label class="content-subtitle fw-bold">Bank Name</label>
            </div>
            <div class="col-12 col-md-6" style="<?= $billing_info->bill_method != 'CHECK' && $billing_info->bill_method != 'ACH' ? 'display:none;' : ''; ?>">
                <label class="content-subtitle"><?= !empty($billing_info->bank_name) ? $billing_info->bank_name : '---' ?></label>
            </div>
            <div class="col-12 col-md-6" style="<?= $billing_info->bill_method != 'CC' ? 'display:none;' : ''; ?>">
                <label class="content-subtitle fw-bold">Credit Card Type</label>
            </div>
            <div class="col-12 col-md-6" style="<?= $billing_info->bill_method != 'CC' ? 'display:none;' : ''; ?>">
                <label class="content-subtitle"><?= !empty($billing_info->card_type) ? $billing_info->card_type : '---' ?></label>
            </div>
            <div class="col-12 col-md-6" style="<?= $billing_info->bill_method != 'CC' ? 'display:none;' : ''; ?>">
                <label class="content-subtitle fw-bold">Credit Card Number</label>
            </div>
            <div class="col-12 col-md-6" style="<?= $billing_info->bill_method != 'CC' ? 'display:none;' : ''; ?>">
                <?php 
                    if (logged("user_type") == 1){
                        $cc_num = $billing_info->credit_card_num;
                    }else{
                        $cc_num = strMask($billing_info->credit_card_num,'X');
                    }
                ?>
                <label class="content-subtitle"><?= !empty($billing_info->credit_card_num) ? $cc_num : '---' ?></label>
            </div>
            <div class="col-12 col-md-6" style="<?= $billing_info->bill_method != 'CC' ? 'display:none;' : ''; ?>">
                <label class="content-subtitle fw-bold">Credit Card Expiration</label>
            </div>
            <div class="col-12 col-md-6" style="<?= $billing_info->bill_method != 'CC' ? 'display:none;' : ''; ?>">
                <label class="content-subtitle">
                    <?= !empty($billing_info->credit_card_exp) ? $billing_info->credit_card_exp : '---' ?>                    
                </label>
            </div>
            <div class="col-12 col-md-6" style="<?= $billing_info->bill_method != 'CC' ? 'display:none;' : ''; ?>">
                <label class="content-subtitle fw-bold">Credit Card CVC</label>
            </div>
            <div class="col-12 col-md-6" style="<?= $billing_info->bill_method != 'CC' ? 'display:none;' : ''; ?>">
                <label class="content-subtitle">
                    <?= !empty($billing_info->credit_card_exp_mm_yyyy) ? $billing_info->credit_card_exp_mm_yyyy : '---' ?>
                </label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="phone_w" id="phone_w" value="<?php if(isset($profile_info)){ echo $profile_info->phone_w; } ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Phone (M)
            </div>
            <div class="col-md-6">
                <?= isset($profile_info) && !empty($profile_info->phone_m) ? $profile_info->phone_m : '---';?>
            </div>
        </div>
    </div>
    <div class="card-header">
        <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>
        <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Emergency Contacts</h6>
    </div>
    <div class="card-body">
        <?php if(!empty($contacts)): ?>
            <?php foreach ($contacts as $contact) : $x=1;?>
            <div class="row form_line">
                <div class="col-md-6 ">
                    Contact Name <?= $x; ?>
                </div>
                <div class="col-md-6">
                    <?= $contact->name; ?>
                </div>
            </div>
            <div class="row form_line">
                <div class="col-md-6">
                    Contact Phone <?= $x; ?>
                </div>
                <div class="col-md-6">
                    <?= $contact->phone; ?>
                </div>
            </div>
            <div class="row form_line">
                <div class="col-md-6">
                    Relationship
                </div>
                <div class="col-md-6">
                    <?= $contact->relation; ?>
                </div>
            </div>
            <?php endforeach; $x++; ?>
        <?php endif; ?>
    </div>
    <?php include viewPath('customer/advance_customer_forms/preview_billing_info'); ?>
</div>