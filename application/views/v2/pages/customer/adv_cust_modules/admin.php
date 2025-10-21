<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Admin</span>
            </div>
        </div>
        <div class="nsm-card-content">
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <div class="row g-2">
                        <div class="col-12 col-md-6">
                            <label class="content-title">Entered by</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($office_info->entered_by) {
                                        echo $office_info->entered_by; 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Time Entered</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($office_info->time_entered) {
                                        echo $office_info->time_entered; 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
                            </span>
                        </div>                        
                        <div class="col-12 col-md-6">
                            <label class="content-title">Pre Survey</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($office_info->pre_install_survey) {
                                        echo $office_info->pre_install_survey; 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Post Survey</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($office_info->post_install_survey) {
                                        echo $office_info->post_install_survey; 
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
                            <label class="content-title">Language</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($office_info->language) {
                                        echo $office_info->language; 
                                    } else {
                                        echo "English";
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Date Enter</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($office_info->sales_date) {
                                        echo $office_info->sales_date; 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Sales Rep</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($office_info->fk_sales_rep_office) {
                                        echo getUser($office_info->fk_sales_rep_office); 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>

                                <?php
                                    //$sales_rep = !empty($office_info->fk_sales_rep_office) ?  get_employee_name($office_info->fk_sales_rep_office) : '---';
                                ?>
                                <?php //$sales_rep->FName. ' ' . $sales_rep->LName; ?>
                            </span>
                        </div>                        
                        <div class="col-12 col-md-6">
                            <label class="content-title">Tech</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($office_info->technician) {
                                        echo getUser($office_info->technician);
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>            
            <?php include viewPath('v2/pages/customer/adv_cust_modules/billing'); ?>      
            <?php if( isAdmin() && in_array(logged('company_id'), adi_company_ids()) ){ ?>
                <?php include viewPath('v2/pages/customer/adv_cust_modules/payment_method_images'); ?>      
            <?php } ?>
            <div class="row g-3">
                <div class="col-12">
                    <button role="button" class="nsm-button primary w-100 ms-0 mt-3" onclick="window.open('<?= base_url('customer/activities/'.$profile_info->prof_id) ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');">
                         <i class='bx bx-fw bx-history'></i> History Log
                    </button>
                    <button role="button" class="nsm-button primary w-100 ms-0 mt-3" onclick="window.open('<?= base_url('/customer/add_advance/' . $profile_info->prof_id) ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');">
                        <i class='bx bx-fw bx-message-square-edit'></i> View/Edit Module
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>