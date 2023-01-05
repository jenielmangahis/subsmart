<div class="nsm-card">
    <div class="nsm-card-content">
        <div class="row mb-3">
            <div class="col-12">
                <div class="nsm-card-title">
                    <span>Customer Information</span>
                </div>
            </div>
        </div>
        <div class="row g-1 mb-5">
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Customer Type</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($profile_info->customer_type) ? $profile_info->customer_type : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Sales Area</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">
                    <?php $salesArea = '---';
                    foreach ($sales_area as $sa) : ?>
                        <?php if (isset($profile_info) && $profile_info->fk_sa_id != 0) {
                            if ($profile_info->fk_sa_id == $sa->sa_id) {
                                $salesArea = $sa->sa_name;
                            }
                        } ?>
                    <?php endforeach ?>
                    <?= $salesArea ?>
                </label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Business Name</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->business_name) ? $profile_info->business_name : '---'; ?></label>
            </div>
            <?php if($companyId == 1): ?>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Industry Type</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= $industryType ? $industryType->name : 'Not Specified'; ?></label>
            </div>
            <?php endif; ?>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">First Name</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->first_name) ? $profile_info->first_name : 'n/a'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Middle Initial</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->middle_name) ? strtoupper($profile_info->middle_name) : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Last Name</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->last_name) ? $profile_info->last_name : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Name Prefix</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->prefix) ? $profile_info->prefix : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Suffix</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->suffix) ? $profile_info->suffix : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Address</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->mail_add) ? $profile_info->mail_add : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">City</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->city) ? $profile_info->city : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">State</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->state) ? $profile_info->state : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Zip Code</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->zip_code) ? $profile_info->zip_code : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Cross Street</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->cross_street) ? $profile_info->cross_street : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">County</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->country) ? $profile_info->country : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Subdivision</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->subdivision) ? $profile_info->subdivision : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Social Security No.</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">
                    <?php
                    $ssn_numbers = explode('-', $profile_info->ssn);
                    if (isset($ssn_numbers[2])) {
                        echo '**-***-' . $ssn_numbers[2];
                    } else {
                        echo 'n/a';
                    }
                    ?>
                </label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Date Of Birth</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->date_of_birth) ? $profile_info->date_of_birth : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Email</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->email) ? $profile_info->email : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Phone (H)</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->phone_h) ? substr($profile_info->phone_h, 0, 13) : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Phone (M)</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->phone_h) ? substr($profile_info->phone_h, 20, 33) : '---'; ?></label>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <div class="nsm-card-title">
                    <span>Emergency Contacts</span>
                </div>
            </div>
        </div>
        <div class="row g-1 mb-5">
            <?php if (!empty($contacts)) : ?>
                <?php foreach ($contacts as $key => $contact): ?>
                    <?php if (!empty(trim($contact->name))): ?>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold">Contact Name <?= $key + 1; ?></label>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle"><?= $contact->name; ?></label>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold">Contact Phone <?= $key + 1; ?></label>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle"><?= empty($contact->phone) ? '---' : $contact->phone; ?></label>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold">Relationship <?= $key + 1; ?></label>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle"><?= empty($contact->relation) ? '---' : $contact->relation; ?></label>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="col-12">
                    <label class="content-subtitle">No emergency contacts found.</label>
                </div>
            <?php endif; ?>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <div class="nsm-card-title">
                    <span>Billing Information</span>
                </div>
            </div>
        </div>
        <div class="row g-1 mb-5">
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Card Holder First Name</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($billing_info) && !empty($billing_info->card_fname) ? $billing_info->card_fname : $profile_info->first_name ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Card Holder Last Name</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($billing_info) && !empty($billing_info->card_lname) ? $billing_info->card_lname : $profile_info->last_name ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Card Holder Address</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($billing_info) && !empty($billing_info->card_address) ? $billing_info->card_address : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">City State ZIP</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">
                    <?= isset($billing_info) && !empty($billing_info->city) ? $billing_info->city : '---' ?>
                    <?= isset($billing_info) && !empty($billing_info->state) ? $billing_info->state : '---' ?>
                    <?= isset($billing_info) && !empty($billing_info->zip) ? $billing_info->zip : '---' ?>
                </label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Rate Plan</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($billing_info) && !empty($billing_info->mmr) ? '$' . $billing_info->mmr : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Billing Frequency</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($billing_info) && !empty($billing_info->bill_freq) ? $billing_info->bill_freq : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Billing Day of Month</label>
            </div>
            <div class="col-12 col-md-6">
                <?php if($billing_info->bill_day == null){
                        if($billing_info->billing_start_date == null){
                            $insdate = strtotime($office_info->install_date);
                            $day = date("d", $insdate);
                        }else{
                            $insdate = strtotime($billing_info->billing_start_date);
                            $day = date("d", $insdate);
                        }
                    }else{
                        $day = $billing_info->bill_day;
                    }
                    ?>
                <label class="content-subtitle"><?= isset($day) && !empty($day) ? $day : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Contract Term* (months)</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($billing_info) && !empty($billing_info->contract_term) ? $billing_info->contract_term . ' months' : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Billing Start Date</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($billing_info) && !empty($billing_info->bill_start_date) ? $billing_info->bill_start_date : $office_info->install_date ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Billing End Date</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?php if(isset($billing_info)){ echo $billing_info->bill_end_date != null ? $billing_info->bill_end_date : date("m/d/Y", strtotime("$office_info->install_date +$billing_info->contract_term months"));; }?></label>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <div class="nsm-card-title">
                    <span>Payment Details</span>
                </div>
            </div>
        </div>
        <div class="row g-1">
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Billing Method</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?php $bm = bill_methods($billing_info->bill_method); ?> <?= !empty($bm['description']) ? $bm['description'] : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Check Number</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($billing_info->check_num) ? $billing_info->check_num : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Routing Number</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($billing_info->routing_num) ? $billing_info->routing_num : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Account Number</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($billing_info->acct_num) ? $billing_info->acct_num : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Credit Card Number</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($billing_info->credit_card_num) ? $billing_info->credit_card_num : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Credit Card Expiration</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">
                    <?= !empty($billing_info->credit_card_exp) ? $billing_info->credit_card_exp : '---' ?>
                    <?= !empty($billing_info->credit_card_exp_mm_yyyy) ? $billing_info->credit_card_exp_mm_yyyy : '---' ?>
                </label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Account Credential</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($billing_info->account_credential) ? $billing_info->account_credential : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Account Note</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($billing_info->account_note) ? $billing_info->account_note : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Confirmation</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($billing_info->confirmation) ? $billing_info->confirmation : '---' ?></label>
            </div>
        </div>
    </div>
</div>