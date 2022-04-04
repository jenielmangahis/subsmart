<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Owner</span>
            </div>
        </div>
        <div class="nsm-card-content">
        <div class="row g-3">
                <div class="col-12 col-md-6">
                    <div class="row g-2">
                        <div class="col-12 col-md-6">
                            <label class="content-title">SSN</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($profile_info)){ echo $profile_info->ssn; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Firstname</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($profile_info)){ echo $profile_info->first_name; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Lastname</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($profile_info)){ echo $profile_info->last_name; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Address</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($profile_info)){ echo $profile_info->country; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">State</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($profile_info)){ echo $profile_info->state; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Pay History</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($profile_info)){ echo $profile_info->pay_history; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">DOB</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php if(isset($profile_info)){ echo $profile_info->date_of_birth; }; ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="row g-2">
                        <div class="form-check d-inline-block">
                            <input class="form-check-input" type="checkbox" value="1" id="sign_guarantee" name="sign_guarantee" checked>
                            <label class="form-check-label" for="sign_guarantee">
                                Sign Guarantee
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <button role="button" class="nsm-button w-100 ms-0 mt-3" onclick="window.open('<?= base_url('job_checklists/list'); ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');">
                        <i class='bx bx-fw bx-send'></i> Send SMS
                    </button>
                </div>
                <div class="col-12 col-md-4">
                    <button role="button" class="nsm-button w-100 ms-0 mt-3">
                        <i class='bx bx-fw bx-mail-send'></i> Send Email
                    </button>
                </div>
                <div class="col-12 col-md-4">
                    <button role="button" class="nsm-button w-100 ms-0 mt-3" onclick="window.open('<?= base_url('survey'); ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');">
                        <i class='bx bx-fw bx-phone-call'></i> Call Customer
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>