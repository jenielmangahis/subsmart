<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Access</span>
            </div>
        </div>
        <div class="nsm-card-content">
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <div class="row g-2">
                        <div class="col-12 col-md-6">
                            <label class="content-title">Portal Status</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if($access_info->portal_status == 1){
                                        echo "On";
                                    } else {
                                        echo "Off";
                                    }; 
                                ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Login</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($access_info->access_login) {
                                        echo $access_info->access_login; 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Cancel Date</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($office_info->cancel_date) {
                                        echo $office_info->cancel_date; 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Cancel Reason</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($office_info->cancel_reason) {
                                        echo $office_info->cancel_reason; 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="row g-2">
                        <div class="col-12 col-md-6">
                            <label class="content-title">Collection Date</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($office_info->collect_date) {
                                        echo $office_info->collect_date; 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Collection Amount</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($office_info->collect_amount) {
                                        echo $office_info->collect_amount; 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button class="nsm-button light w-100 ms-0 mt-3" disabled>
                        <i class='bx bx-fw bx-link-external'></i> Send Link Reset Password
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>