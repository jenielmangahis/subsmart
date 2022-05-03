<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Profile</span>
            </div>
        </div>
        <div class="nsm-card-content">
            <div class="row g-3">
                <div class="col-12">
                    <div class="d-flex align-items-center">
                        <div class="nsm-profile me-3">
                            <?php if ($profile_info->customer_type === 'Business'): ?>
                                <span>
                                <?php 
                                    $parts = explode(' ', strtoupper(trim($profile_info->business_name)));
                                    echo count($parts) > 1 ? $parts[0][0] . end($parts)[0] : $parts[0][0];
                                ?>
                                </span>
                            <?php else: ?>
                                <span><?= ucwords($profile_info->first_name[0]) . ucwords($profile_info->last_name[0]) ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="row w-100">
                            <div class="col-12 col-md-6">
                                <span class="content-title">
                                    <?php if ($profile_info->customer_type === 'Business'): ?>
                                        <?= $profile_info->business_name ?>
                                    <?php else: ?>
                                        <?= $profile_info->first_name . ' ' . $profile_info->last_name ?>
                                    <?php endif; ?>    
                                </span>
                                <span class="content-subtitle d-block"><?= $profile_info->email ?></span>
                            </div>
                            <div class="col-12 col-md-6 text-end">
                                <?php
                                switch (strtoupper($profile_info->status)):
                                    case "INSTALLED":
                                        $badge = "success";
                                        break;
                                    case "CANCELLED":
                                        $badge = "error";
                                        break;
                                    case "COLLECTIONS":
                                        $badge = "secondary";
                                        break;
                                    case "CHARGED BACK":
                                        $badge = "primary";
                                        break;
                                    default:
                                        $badge = "";
                                        break;
                                endswitch;
                                ?>
                                <span class="nsm-badge <?= $badge ?>"><?= !is_null($profile_info->status) ? $profile_info->status : 'Pending'; ?></span>
                                <span class="content-subtitle d-block"><?= $profile_info->phone_h ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?php echo base_url("/customer/preview/$profile_info->prof_id"); ?>">
                        View Profile
                    </a>
                    <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?php echo base_url("/customer/add_advance/$profile_info->prof_id"); ?>">
                        Edit Profile
                    </a>
                </div>
                <div class="col-12 col-md-7 text-end">
                    <div class="form-check d-inline-block me-3">
                        <input class="form-check-input" type="checkbox" value="1" id="notify_by_sms" name="notify_by_sms" checked>
                        <label class="form-check-label" for="notify_by_sms">
                            Notify by SMS
                        </label>
                    </div>
                    <div class="form-check d-inline-block">
                        <input class="form-check-input" type="checkbox" value="1" id="notify_by_email" name="notify_by_email" checked>
                        <label class="form-check-label" for="notify_by_email">
                            Notify by Email
                        </label>
                    </div>
                </div>
                <div class="col-12" id="customerquickactions">
                    <div class="d-flex justify-content-end mb-3">
                        <a href="#" class="nsm-link" id="managequickactions">Manage Quick Actions</a>
                    </div>

                    <div class="nsm-empty empty-message">
                        Click Manage Quick Actions to view available shortcuts for this customer.
                    </div>

                    <div class="actions-wrapper" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 8px;"></div>
                    
                    <div class="d-none">
                        <!-- Actions will come from database -->
                        <button role="button" class="nsm-button w-100 ms-0">
                            <i class='bx bx-fw bx-import'></i> 1-Click Import and Audit, Pull reports & Create audit
                        </button>
                        <a href="<?=base_url('EsignEditor/wizard?customer_id=' . $profile_info->prof_id)?>" role="button" class="nsm-button d-flex justify-content-center align-items-center w-100 ms-0">
                            <i class='bx bx-fw bxs-magic-wand'></i> Run Dispute Wizard, Create letters/correct errors
                        </a>
                        <button role="button" class="nsm-button w-100 ms-0">
                            <i class='bx bx-fw bx-message-rounded-check'></i> Send Secure Message, Via Client Portal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" tabindex="-1" role="dialog" id="managequickactionsmodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Customer Quick Actions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Select the actions you would like to display in this customer's profile</p>

        <div>
            <div class="actions-loader d-flex align-items-center justify-content-center" style="min-height: 300px;">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div class="actions-wrapper"></div>
        </div>

        <template>
            <div class="nsm-card mb-2 h-auto">
                <div class="nsm-card-content">
                    <div class="d-flex">
                        <div class="d-flex align-items-baseline" style="gap: 8px;">
                            <i class="icon d-none" style="position: relative; top: 3px;"></i>
                            <span class="content-title d-block mb-1"></span>
                        </div>
                        <div class="d-flex justify-content-end align-items-center" style="margin-left: auto;">
                            <div class="form-check form-switch">
                                <input class="form-check-input ms-0" type="checkbox" checked="">
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