<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Assign</span>
            </div>
        </div>
        <div class="nsm-card-content">
            <div class="row g-3">
                <div class="col-12">
                    <div class="d-flex align-items-center mb-3">
                        <?php
                        $image = userProfilePicture(null);
                        if (is_null($image)) {
                        ?>
                            <div class="nsm-profile me-3">
                                <span>TF</span>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="nsm-profile me-3" style="background-image: url('https://app.creditrepaircloud.com/uploads/61803_cmpny/contacts/1_photo_team_1579652503.png');"></div>
                        <?php
                        }
                        ?>
                        <div class="row w-100">
                            <div class="col-12 col-md-6">
                                <span class="content-title">Lauren Williams</span>
                                <span class="content-subtitle d-block">FICO HEROES</span>
                            </div>
                            <div class="col-12 col-md-6 text-end">
                                <span class="nsm-badge primary">ADMIN</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <button class="nsm-button w-100 ms-0" id="emailtemplate-assign--trigger">
                        <i class='bx bx-fw bx-edit'></i> Send Welcome Email
                    </button>
                </div>
                <div class="col-12 col-md-6">
                        <button class="nsm-button primary w-100 ms-0" onclick="window.open('<?= base_url('customer/module/'.$cus_id) ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');">
                            <i class='bx bx-fw bx-eraser'></i> Visit Website
                        </button>
                </div>
                <div class="col-12">
                    <button class="nsm-button w-100 ms-0 ">
                        <i class='bx bx-fw bx-history'></i> Send Reset Password
                    </button>
                </div>
            </div>
         <div class="nsm-card-content mt-4">
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
                            <label class="content-title">Assign To</label>
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
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="row g-2">
                        <div class="col-12 col-md-6">
                            <label class="content-title">Provider</label>
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
                <div class="col-12">
                    <button role="button" class="nsm-button primary w-100 ms-0 mt-3" onclick="window.open('<?= base_url('timesheet/attendance_logs') ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');">
                        <i class='bx bx-fw bx-history'></i> History Log
                    </button>
                </div>
            </div>
        </div>

        </div>
    </div>
</div>

<div class="modal fade nsm-modal" tabindex="-1" role="dialog" id="emailtemplate-assign--modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Assign Email</h5>
        <button type="button" data-bs-dismiss="modal" aria-label="Close">
            <i class="bx bx-fw bx-x m-0"></i>
        </button>
      </div>
      <div class="modal-body loading">
        <style>
            #emailtemplate-assign--modal .modal-body.loading .nsm-button,
            #emailtemplate-assign--modal .modal-body.loading .letters-wrapper {
                display: none;
            }
            #emailtemplate-assign--modal .modal-body:not(.loading) .letters-loader {
                display: none !important;
            }
        </style>
        <div>
            <div class="nsm-callout d-none"></div>

            <div class="letters-wrapper"></div>
            <div class="letters-loader d-flex align-items-center justify-content-center" style="min-height: 200px;">
                <div class="spinner-border" role="status"></div>
            </div>

            <div class="d-flex justify-content-end mb-3">
                <a target="_blank" href="<?= base_url('EsignEditor/create?category=Assign Letters') ?>" class="nsm-link">Create Letter</a>
            </div>
            <button type="button" class="nsm-button primary w-100 ms-0">
                <i class="bx bx-fw bx-send"></i> Send Assign Email
            </button>
        </div>

        <template>
            <div class="nsm-card mb-2 h-auto">
                <div class="nsm-card-content">
                    <div class="d-flex">
                        <div>
                            <span class="content-title d-block"></span>
                        </div>
                        <div class="d-flex justify-content-end align-items-center" style="margin-left: auto;">
                            <div class="form-check form-switch">
                                <input class="form-check-input ms-0" type="radio" name="selectedassignemail">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
      </div>
    </div>
  </div>
</div>