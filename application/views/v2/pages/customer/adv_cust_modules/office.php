<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Office</span>
            </div>
        </div>
        <div class="nsm-card-content">
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <div class="row g-2">
                        <div class="col-12 col-md-6">
                            <label class="content-title">Welcome Kit</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ if($office_info->welcome_sent == 1){echo "On";}else{echo "Off";} }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">CSO</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ if($office_info->commision_scheme == 1){echo "On";}else{echo "Off";} }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Rep Comm.</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ echo $office_info->rep_comm; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Rep Pay</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ echo $office_info->rep_upfront_pay; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Tech Comm.</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ echo $office_info->tech_comm; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Tech Pay</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ echo $office_info->tech_upfront_pay; }; ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="row g-2">
                        <div class="col-12 col-md-6">
                            <label class="content-title">Rep Payroll</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ echo $office_info->rep_charge_back; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">PSO</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ echo $office_info->pso; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Points</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ echo $office_info->points_include; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Price Point</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ echo $office_info->price_per_point; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Purchase $</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ echo $office_info->purchase_price; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Purchase X's</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ echo $office_info->purchase_multiple; }; ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <button role="button" class="nsm-button w-100 ms-0 mt-3" onclick="window.open('<?= base_url('job_checklists/list'); ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');">
                        <i class='bx bx-fw bx-list-check'></i> Checklists
                    </button>
                </div>
                <div class="col-12 col-md-4">
                    <button role="button" class="nsm-button w-100 ms-0 mt-3">
                        <i class='bx bx-fw bx-history'></i> Welcome Email
                    </button>
                </div>
                <div class="col-12 col-md-4">
                    <button role="button" class="nsm-button w-100 ms-0 mt-3" onclick="window.open('<?= base_url('survey'); ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');">
                        <i class='bx bx-fw bx-question-mark'></i> Survey
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>