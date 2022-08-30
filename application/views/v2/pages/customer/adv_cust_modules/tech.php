<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Tech</span>
            </div>
        </div>
        <div class="nsm-card-content">
            <div class="row g-3">
                <div class="col-12 col-md-9">
                    <div class="row g-2">
                        <div class="col-12 col-md-6">
                            <label class="content-title">Arrival Time</label>
                        </div>
                        <div class="col-12 col-md-6 text-end">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ echo $office_info->tech_arrive_time; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Departure Time</label>
                        </div>
                        <div class="col-12 col-md-6 text-end">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ echo $office_info->tech_depart_time; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Tech Assign</label>
                        </div>
                        <div class="col-12 col-md-6 text-end">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ echo getUser($office_info->technician); }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Date Given</label>
                        </div>
                        <div class="col-12 col-md-6 text-end">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ echo $office_info->save_date; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">CustomField1</label>
                        </div>
                        <div class="col-12 col-md-6 text-end">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ echo $office_info->office_custom_field1; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Link</label>
                        </div>
                        <div class="col-12 col-md-6 text-end">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ echo string_max_length($office_info->url,20); }; ?>
                            </span>
                        </div>
                    </div>
                </div>
                <?php if(isset($profile_info)): ?>
                <div class="col-12 col-md-3">
                    <div class="col-12">
                        <img class="w-100" src="<?php echo base_url()."assets/img/customer/qr/".$profile_info->prof_id.".png"?>">
                    </div>
                </div>
                <?php endif; ?>
                <div class="col-12">
                    <button role="button" class="nsm-button primary w-100 ms-0 mt-3" id="emailtemplate-qr--trigger">
                        <i class='bx bx-fw bx-qr'></i> Send QR
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" tabindex="-1" role="dialog" id="emailtemplate-qr--modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">QR Email</h5>
        <button type="button" data-bs-dismiss="modal" aria-label="Close">
            <i class="bx bx-fw bx-x m-0"></i>
        </button>
      </div>
      <div class="modal-body loading">
        <style>
            #emailtemplate-qr--modal .modal-body.loading .nsm-button,
            #emailtemplate-qr--modal .modal-body.loading .letters-wrapper {
                display: none;
            }
            #emailtemplate-qr--modal .modal-body:not(.loading) .letters-loader {
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
                <a target="_blank" href="<?= base_url('EsignEditor/create?category=QR Letters') ?>" class="nsm-link">Create Letter</a>
            </div>
            <button type="button" class="nsm-button primary w-100 ms-0">
                <i class="bx bx-fw bx-send"></i> Send QR Email
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