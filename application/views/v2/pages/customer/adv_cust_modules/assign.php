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
                                <span class="content-title">Tommy Fico</span>
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
                    <a href="#" target="_blank">
                        <button class="nsm-button primary w-100 ms-0">
                            <i class='bx bx-fw bx-eraser'></i> Visit Website
                        </button>
                    </a>
                </div>
                <div class="col-12">
                    <button class="nsm-button w-100 ms-0 ">
                        <i class='bx bx-fw bx-history'></i> Send Reset Password
                    </button>
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
                <a target="_blank" href="<?= base_url('EsignEditor/create') ?>" class="nsm-link">Create Letter</a>
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