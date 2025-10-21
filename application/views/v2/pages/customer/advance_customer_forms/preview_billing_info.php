<div class="nsm-card primary">
    <div class="nsm-card-content">
        <div class="row mb-3">
            <div class="col-12">
                <div class="nsm-card-title">
                    <span><i class="bx bx-fw bx-credit-card"></i>Billing Information</span>
                    <hr />
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
                <label class="content-subtitle fw-bold">Equipment</label>
            </div>
            <div class="col-12 col-md-6">
                <?php   
                    $billing_equipment = 0;
                    if( isset($billing_info) && $billing_info->equipment != '' ){
                        $billing_equipment = $billing_info->equipment;
                    }else{
                        if( $woSubmittedLatest ){
                            $billing_equipment = $woSubmittedLatest->subtotal;
                        }
                    }
                ?>
                <label class="content-subtitle"><?= $billing_equipment; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Initial Deposit</label>
            </div>
            <div class="col-12 col-md-6">
                <?php   
                    $billing_initial_dep = 0;
                    if( isset($billing_info) && $billing_info->initial_dep != '' ){
                        $billing_initial_dep = $billing_info->initial_dep;
                    }else{
                        if( $woSubmittedLatest ){
                            $billing_initial_dep = $woSubmittedLatest->deposit_collected;
                        }
                    }
                ?>
                <label class="content-subtitle"><?= $billing_initial_dep; ?></label>
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
                <?php 
                    $start_date = '<i class="text-muted">Not Specified</i>';
                    if( $billing_info && ( $billing_info->bill_start_date != '1970-01-01' && strtotime($billing_info->bill_start_date) > 0 ) ){
                        $start_date = date("m/d/Y", strtotime($billing_info->bill_start_date));
                    }
                ?>
                <label class="content-subtitle"><?php echo $start_date; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Billing End Date</label>
            </div>
            <div class="col-12 col-md-6">
                <?php 
                    $end_date = '<i class="text-muted">Not Specified</i>';
                    if( $billing_info && ( $billing_info->bill_end_date != '1970-01-01' && strtotime($billing_info->bill_end_date) > 0 ) ){
                        $end_date = date("m/d/Y", strtotime($billing_info->bill_end_date));
                    }
                ?>
                <label class="content-subtitle"><label class="content-subtitle"><?php echo $end_date; ?></label>
            </div>
            <?php if( $billing_info && $billing_info->next_billing_date != '' ){ ?>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Next Billing Date</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= date("m/d/Y", strtotime($billing_info->next_billing_date)); ?></label>
            </div>
            <?php } ?>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Late Fee Collected</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">$<?= isset($billing_info) ? $billing_info->late_fee : '0.00'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Payment Recorded</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">$<?= isset($billing_info) ? $billing_info->payment_fee : '0.00'; ?></label>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <div class="nsm-card-title">
                    <span><i class="bx bx-fw bx-credit-card"></i>Payment Details</span>
                    <hr />
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
            <div class="col-12 col-md-6" style="<?= $billing_info->bill_method != 'CC' && $billing_info->bill_method != 'Credit Card' ? 'display:none;' : ''; ?>">
                <label class="content-subtitle fw-bold">Credit Card Type</label>
            </div>
            <div class="col-12 col-md-6" style="<?= $billing_info->bill_method != 'CC' && $billing_info->bill_method != 'Credit Card' ? 'display:none;' : ''; ?>">
                <label class="content-subtitle"><?= !empty($billing_info->card_type) ? $billing_info->card_type : '---' ?></label>
            </div>
            <div class="col-12 col-md-6" style="<?= $billing_info->bill_method != 'CC' && $billing_info->bill_method != 'Credit Card' ? 'display:none;' : ''; ?>">
                <label class="content-subtitle fw-bold">Credit Card Number</label>
            </div>
            <div class="col-12 col-md-6" style="<?= $billing_info->bill_method != 'CC' && $billing_info->bill_method != 'Credit Card' ? 'display:none;' : ''; ?>">
                <?php 
                    if (logged("user_type") == 7){
                        $cc_num = $billing_info->credit_card_num;
                    }else{
                        $cc_num = maskString($billing_info->credit_card_num);
                    }
                ?>
                <label class="content-subtitle"><?= !empty($billing_info->credit_card_num) ? $cc_num : '---' ?></label>
            </div>
            <div class="col-12 col-md-6" style="<?= $billing_info->bill_method != 'CC' && $billing_info->bill_method != 'Credit Card' ? 'display:none;' : ''; ?>">
                <label class="content-subtitle fw-bold">Credit Card Expiration</label>
            </div>
            <div class="col-12 col-md-6" style="<?= $billing_info->bill_method != 'CC' && $billing_info->bill_method != 'Credit Card' ? 'display:none;' : ''; ?>">
                <label class="content-subtitle">
                    <?= !empty($billing_info->credit_card_exp) ? $billing_info->credit_card_exp : '---' ?>                    
                </label>
            </div>
            <div class="col-12 col-md-6" style="<?= $billing_info->bill_method != 'CC' && $billing_info->bill_method != 'Credit Card' ? 'display:none;' : ''; ?>">
                <label class="content-subtitle fw-bold">Credit Card CVC</label>
            </div>
            <div class="col-12 col-md-6" style="<?= $billing_info->bill_method != 'CC' && $billing_info->bill_method != 'Credit Card' ? 'display:none;' : ''; ?>">
                <label class="content-subtitle">
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