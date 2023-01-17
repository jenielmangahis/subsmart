<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Billing</span>
            </div>
        </div>
        <div class="nsm-card-content">
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <div class="row g-2">
                        <div class="col-12 col-md-6">
                            <label class="content-title">MMR Method</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                            <?php if(isset($billing_info)){ echo $billing_info->bill_method; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Full Name</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($billing_info)){ echo (!empty($billing_info->card_fname)) ? $billing_info->card_fname : $profile_info->first_name." ".$profile_info->last_name ; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Address</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($billing_info)){ echo $profile_info->cross_street; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Account Number</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($billing_info)){ echo $billing_info->acct_num; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Routing Number</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($billing_info)){ echo $billing_info->routing_num; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Credit Card Number</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($billing_info)){ echo $billing_info->credit_card_num; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">CC Exp</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($billing_info)){ echo $billing_info->credit_card_exp; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">CCN CCV</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($billing_info)){ echo $billing_info->credit_card_exp_mm_yyyy; }; ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="row g-2">
                        <div class="col-12 col-md-6">
                            <label class="content-title">MMR</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                            $<?php if(isset($billing_info)){ echo $billing_info->mmr; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Billing Freq.</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($billing_info)){ echo $billing_info->bill_freq; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Billing Date</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($billing_info)){ echo $billing_info->bill_day; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Contract Term</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($billing_info)){ echo $billing_info->contract_term. ' months'; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Start Date</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($billing_info)){ echo (!empty($billing_info->bill_start_date)) ? $billing_info->bill_start_date : $office_info->install_date; } ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">End Date</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($billing_info)){ echo $billing_info->bill_end_date; }; ?>
                                <?= date("m/d/Y", strtotime("$office_info->install_date +60 months")); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button role="button" class="nsm-button primary w-100 ms-0 mt-3" onclick="window.open('<?= base_url('/customer/add_advance/' . $profile_info->prof_id) ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');">
                        <i class='bx bx-fw bx-message-square-edit'></i> View/Edit Module
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>