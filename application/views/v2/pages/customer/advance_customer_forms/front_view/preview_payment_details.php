<div class="nsm-card primary">
    <div class="nsm-card-content">
        <div class="row mb-3">
            <div class="col-12">
                <div class="nsm-card-title">
                    <span><i class='bx bx-fw bx-credit-card'></i> Payment Details</span>
                    <hr />
                </div>
            </div>
        </div>
        <div class="row g-1">
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Billing Method</label>
            </div>            
            <div class="col-12 col-md-6"></div>
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