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
                        <div class="col-12 col-md-6">
                            <label class="content-title">Panel Type</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle"><?= $alarm_info->panel_type;  ?></span>
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
                    <button type="button" id="checkList" class="nsm-button w-100 ms-0 mt-3 ">
                       <i class='bx bx-fw bx-list-check'></i> Checklists
                    </button>
                </div>
                <div class="col-12 col-md-4">
                    <button type="button" id="emailtemplate-office--trigger" class="nsm-button w-100 ms-0 mt-3 ">
                        <i class='bx bx-fw bx-history'></i> Welcome Email
                    </button>
                </div>
                <div class="col-12 col-md-4">
                    <button role="button" class="nsm-button w-100 ms-0 mt-3" onclick="window.open('<?= base_url('survey/') ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');">
                        <i class='bx bx-fw bx-question-mark'></i> Survey
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $("#checkList").click(function () {
        $('#checkListModal').modal("show");
    });
});
</script>

<div class="modal fade nsm-modal" tabindex="-1" role="dialog" id="emailtemplate-office--modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Welcome Email</h5>
        <button type="button" data-bs-dismiss="modal" aria-label="Close">
            <i class="bx bx-fw bx-x m-0"></i>
        </button>
      </div>
      <div class="modal-body loading">
        <style>
            #emailtemplate-office--modal .modal-body.loading .nsm-button,
            #emailtemplate-office--modal .modal-body.loading .letters-wrapper {
                display: none;
            }
            #emailtemplate-office--modal .modal-body:not(.loading) .letters-loader {
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
                <a target="_blank" href="<?= base_url('EsignEditor/create?category=Welcome Letters') ?>" class="nsm-link">Create Letter</a>
            </div>
            <button type="button" class="nsm-button primary w-100 ms-0">
                <i class="bx bx-fw bx-send"></i> Send Welcome Email
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
                                <input class="form-check-input ms-0" type="radio" name="selectedemail">
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

<div class="modal fade nsm-modal" tabindex="-1" role="dialog" id="checkListModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Select Checklist</h5>
        <button type="button" data-bs-dismiss="modal" aria-label="Close">
            <i class="bx bx-fw bx-x m-0"></i>
        </button>
      </div>
        <div class="modal-body">
            <?php foreach($job_check_lists as $check_list): ?>
                <div class="nsm-card mb-2 h-auto">
                    <div class="nsm-card-content">
                        <div class="d-flex">
                            <div>
                                <span class="content-title d-block"><?= $check_list->checklist_name ?></span>
                                <small><?= $check_list->checklist_name == 'SAMPLE A' ? 'Set as default': '' ?></small>
                            </div>
                            <div class="d-flex justify-content-end align-items-center" style="margin-left: auto;">
                                <input class="form-check-input ms-0" type="checkbox" name="selectedemail" <?= $check_list->checklist_name == 'SAMPLE A' ? 'checked': '' ?>>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
  </div>
</div>
