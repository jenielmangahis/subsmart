<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Alarm</span>
            </div>
        </div>
        <div class="nsm-card-content">
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <div class="row g-2">
                        <div class="col-12 col-md-6">
                            <label class="content-title">Monitoring Co</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($alarm_info)){ echo $alarm_info->monitor_comp; } ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Install Date</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ echo $office_info->install_date; } ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Account Type</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($alarm_info)){ echo $alarm_info->acct_type; } ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Password</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($alarm_info)){ echo $alarm_info->passcode; } ?>
                            </span>
                        </div>
                        
                        <div class="col-12 col-md-6">
                            <label class="content-title">Mon. Waived</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ echo $office_info->monitoring_waived; } ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">RebateCheck1</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ echo $office_info->rebate_check1; } ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Warranty Type</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($alarm_info)){ echo $alarm_info->warranty_type; } ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Monitoring Confirmation Number</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($alarm_info)){ echo $alarm_info->mcn; } ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Account Cost</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                            $<?php if(isset($alarm_info)){ echo $alarm_info->account_cost; } ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="row g-2">
                        <div class="col-12 col-md-6">
                            <label class="content-title">ID</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($alarm_info)){ echo $alarm_info->monitor_id; } ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Credit Score</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ echo $office_info->credit_score; } ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Account Info</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($alarm_info)){ echo $alarm_info->acct_info; } ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Installer Code</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($alarm_info)){ echo $alarm_info->install_code; } ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">System Type</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($alarm_info)){ echo $alarm_info->system_type; } ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Rebate Offer</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ echo $office_info->rebate_offer; } ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Verification</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ echo $office_info->verification; } ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">RebateCheck2</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ echo $office_info->rebate_check2; } ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Signal Confirmation Number</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($alarm_info)){ echo $alarm_info->scn; } ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Pass Thru Cost</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                $<?php if(isset($alarm_info)){ echo $alarm_info->pass_thru_cost; } ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <button role="button" class="nsm-button w-100 ms-0 mt-3">
                        <i class='bx bx-fw bx-user-pin'></i> Account On Test
                    </button>
                </div>
                <div class="col-12 col-md-4">
                    <a href="https://nsmartrac.com/" target="_blank">
                        <button role="button" class="nsm-button w-100 ms-0 mt-3">
                            <i class='bx bx-fw bx-link-external'></i> Website Url
                        </button>
                    </a>
                </div>
                <div class="col-12 col-md-4">
                    <button role="button" class="nsm-button primary w-100 ms-0 mt-3">
                        <i class='bx bx-fw bx-spreadsheet'></i> Record Sheet
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>