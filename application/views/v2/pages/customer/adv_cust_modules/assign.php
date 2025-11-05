<!-- <div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Assigned Tech</span>
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
                                <span class="content-title"><?= $assignedUser ? $assignedUser->FName . ' ' . $assignedUser->LName : '---'; ?></span>
                                <span class="content-subtitle d-block"><?= $assignedUser ? $assignedUser->company_name : '---'; ?></span>
                            </div>
                            <div class="col-12 col-md-6 text-end">
                                <span class="nsm-badge primary"><?= $assignedUser ? $assignedUser->role_name : '---'; ?></span>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        <hr />
         <div class="nsm-card-content mt-4">
            <div class="row g-3">
                <div class="col-12 col-md-6 mb-4">
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
                                        echo "---";
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
                                        echo "---";
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
                                        echo date("h:i A", strtotime($office_info->time_entered)); 
                                    } else {
                                        echo "---";
                                    }
                                ?>
                            </span>
                        </div>                        
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-4">
                    <div class="row g-2">
                        <div class="col-12 col-md-6">
                            <label class="content-title">Provider</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?= $customerGroup ? $customerGroup->title : '---'; ?>
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
                                        echo "---";
                                    }
                                ?>

                                <?php
                                    //$sales_rep = !empty($office_info->fk_sales_rep_office) ?  get_employee_name($office_info->fk_sales_rep_office) : '---';
                                ?>
                                <?php //$sales_rep->FName. ' ' . $sales_rep->LName; ?>
                            </span>
                        </div>                        
                    </div>                    
                </div>    
                <div class="col-12 col-md-6">
                    <button class="nsm-button primary w-100 ms-0" id="customer-edit-login-information">
                        <i class='bx bx-edit'></i> Edit Login Information
                    </button>
                </div>
                <div class="col-12 col-md-6">
                    <button class="nsm-button primary w-100 ms-0" id="customer-login-as-mobile-user">
                        <i class='bx bx-mobile-alt' ></i> Login as Mobile User
                    </button>
                </div>
                <div class="col-12 col-md-6">
                    <button class="nsm-button primary w-100 ms-0" id="customer-reset-password">
                        <i class='bx bx-reset' ></i> Reset Password
                    </button>
                </div>
                <div class="col-12 col-md-6">
                    <button class="nsm-button primary w-100 ms-0" id="customer-reset-2fa">
                        <i class='bx bx-reset' ></i> Reset 2FA
                    </button>
                </div>
                <div class="col-12 col-md-6">
                    <button class="nsm-button primary w-100 ms-0" id="emailtemplate-assign--trigger">
                        <i class='bx bx-envelope' ></i> Resend Welcome Email
                    </button>
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
                <div class="col-12 col-md-6">
                    <button class="nsm-button w-100 ms-0 ">
                        <i class='bx bx-fw bx-history'></i> Send Reset Password
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
</div> -->


<?php 
    $actionIcons = [
        "add_device" => "fas fa-plus",
        "command_catalog" => "fas fa-terminal",
        "login_user" => "fas fa-user-shield",
        "swap_module" => "fas fa-exchange-alt",
        "trouble_beeps" => "fas fa-volume-up",
        "pause_notifications" => "fas fa-bell",
        "sensor_walk_test" => "fas fa-walking",
        "ask_for_review" => "fas fa-comment-alt",
    ];

    // echo '<pre>';
    // print_r($profile_info prof_id);
    // echo '</pre>';
?>
<style>
    .utilityActionContainer {
        cursor: pointer;
    }

    .utilityActionItem {
        margin: 1px;
        transition: background 0.2s ease;
        white-space: nowrap;
    }

    .utilityActionItem:hover {
        outline: 1px solid #80808036;
        background: #00000005;
        border-radius: 5px;
    }

    .utilityActionItemSelected {
        outline: 1px solid #80808036;
        background: #6a4a8617;
        border-radius: 5px;
    }

    .upperEquipmentDetail {
        margin-bottom: -5px; 
        font-size: 12px;
    }

    .accordionButton {
        background: #0000000a;
    }

    .collapse {
        cursor: default;
    }
    
    .display_none {
        display: none;
    }

    .addEquipmentButton,
    .cancelAddEquipmentButton,
    .cancelEditEquipmentButton,
    .utilityActionContainer,
    .editdEquipmentButton,
    .updatePanelLocationButton,
    .cancelEditPanelLocationButton {
        border-color: lightgray;
    }

    .addEquipmentSave,
    .editEquipmentSave,
    .savePanelLocationButton {
        background: #6a4a86;
        border: 1px solid #6a4a86;
    }

    .alarmcomBadgeEquipment {
        background: #ff5700 !important;
        border: 1px solid #ff5700 !important;
        padding: 2.5px;
        position: absolute;
        top: 13px;
        width: unset !important;
    }

    .utilityActionItemBadge {
        background: #6a4a86 !important;
        border: 1px solid #6a4a86 !important;
        padding: 2.5px;
        position: absolute;
        top: 13px;
        width: unset !important;
    }

    .panelEquipmentLocation {
        margin-top: -4px;
    }

    .utilityInfoCategory {
        background: #00000008;
        border-radius: 5px;
        outline: 1px solid #0000000f;
        padding: 5px;
        margin-top: 10px;
    }

    .utilityContainer {
        height: unset;
        cursor: default;
    }

    .utilityCategoryName {
        font-weight: 500;
    }

    .utilityBackToCustomerList:hover {
        cursor: pointer;
        border: 1px solid lightgray !important;
    }
</style>
<div class="col-12 col-md-4">
    <div class="nsm-card nsm-grid utilityContainer">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Remote Utilities</span>
                <button class="btn btn-primary float-end opacity-50 btn-sm utilityWidgetRefreshButton"><small>REFRESH</small></button>
            </div>
        </div>
        <div class="nsm-card-content">
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle text-danger me-2"></i>
                            <h6 class="mb-0">Device Issues</h6>
                        </div>
                        <h6 class="mb-0">1 Active</h6>
                    </div>
                </div>
                <div class="col-lg-12 mb-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-cogs text-muted me-2"></i>
                            <h6 class="mb-0">System Diagnostic</h6>
                        </div>
                        <h6 class="mb-0">Never Run</h6>
                    </div>
                </div>
                <div class="col-lg-12">
                    <hr class="mb-2">
                </div>
                <div class="col-lg-12">
                    <div class="utilityActionContainer table-responsive d-flex">
                        <div class="utilityActionItem text-center px-3 mb-2" utility-action="add_device">
                            <span class="opacity-50">
                                <i class="<?php echo $actionIcons['add_device']; ?> fs-5 mb-2 mt-1"></i>
                                <br>
                                <small class="fw-bold">Add Device</small>
                            </span>
                        </div>
                        <div class="utilityActionItem text-center px-3 mb-2" utility-action="command_catalog">
                            <span class="opacity-50">
                                <i class="<?php echo $actionIcons['command_catalog']; ?> fs-5 mb-2 mt-1"></i>
                                <br>
                                <small class="fw-bold">Command Catalog</small>
                            </span>
                        </div>
                        <div class="utilityActionItem text-center px-3 mb-2" utility-action="login_user">
                            <span class="opacity-50">
                                <i class="<?php echo $actionIcons['login_user']; ?> fs-5 mb-2 mt-1"></i>
                                <br>
                                <small class="fw-bold">Login User</small>
                            </span>
                        </div>
                        <div class="utilityActionItem text-center px-3 mb-2" utility-action="swap_module">
                            <span class="opacity-50">
                                <i class="<?php echo $actionIcons['swap_module']; ?> fs-5 mb-2 mt-1"></i>
                                <br>
                                <small class="fw-bold">Swap Module</small>
                            </span>
                        </div>
                        <div class="utilityActionItem text-center px-3 mb-2" utility-action="trouble_beeps">
                            <span class="opacity-50">
                                <i class="<?php echo $actionIcons['trouble_beeps']; ?> fs-5 mb-2 mt-1"></i>
                                <br>
                                <small class="fw-bold">Trouble Beeps</small>
                            </span>
                        </div>
                        <div class="utilityActionItem text-center px-3 mb-2" utility-action="pause_notifications">
                            <span class="opacity-50">
                                <i class="<?php echo $actionIcons['pause_notifications']; ?> fs-5 mb-2 mt-1"></i>
                                <br>
                                <small class="fw-bold">Pause Notifications</small>
                            </span>
                        </div>
                        <div class="utilityActionItem text-center px-3 mb-2" utility-action="sensor_walk_test">
                            <span class="opacity-50">
                                <i class="<?php echo $actionIcons['sensor_walk_test']; ?> fs-5 mb-2 mt-1"></i>
                                <br>
                                <small class="fw-bold">Sensor Walk Test</small>
                            </span>
                        </div>
                        <div class="utilityActionItem text-center px-3 mb-2" utility-action="ask_for_review">
                            <span class="opacity-50">
                                <i class="<?php echo $actionIcons['ask_for_review']; ?> fs-5 mb-2 mt-1"></i>
                                <br>
                                <small class="fw-bold">Ask for Review</small>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 remoteDataContainer display_none">
                    <div class="text-center utilityInfoCategory">
                        <i class="fas fa-user text-muted mt-2 mb-1 fs-5"></i><br>
                        <small class="text-muted text-uppercase utilityCategoryName">Customer Info</small>
                        <h5 class="utilityCustomerInfo">0</h5>
                    </div>
                </div>
                <div class="col-lg-6 remoteDataContainer display_none">
                    <div class="text-center utilityInfoCategory">
                        <i class="fas fa-check-circle text-muted mt-2 mb-1 fs-5"></i><br>
                        <small class="text-muted text-uppercase utilityCategoryName">Status</small>
                        <h5 class="utilityStatusInfo">Active w/RMR</h5>
                    </div>
                </div>
                <div class="col-lg-6 remoteDataContainer display_none">
                    <div class="text-center utilityInfoCategory">
                        <i class="fas fa-folder text-muted mt-2 mb-1 fs-5"></i><br>
                        <small class="text-muted text-uppercase utilityCategoryName">Documents</small>
                        <h5 class="utilityDocumentsInfo">4 Entries</h5>
                    </div>
                </div>
                <div class="col-lg-6 remoteDataContainer display_none">
                    <div class="text-center utilityInfoCategory">
                        <i class="fas fa-image text-muted mt-2 mb-1 fs-5"></i><br>
                        <small class="text-muted text-uppercase utilityCategoryName">Gallery</small>
                        <h5 class="utilityGalleryInfo">4 Entries</h5>
                    </div>
                </div>
                <div class="col-lg-6 remoteDataContainer display_none">
                    <div class="text-center utilityInfoCategory">
                        <i class="fas fa-solar-panel text-muted mt-2 mb-1 fs-5"></i><br>
                        <small class="text-muted text-uppercase utilityCategoryName">Panel Type</small>
                        <h5 class="utilityPanelTypeInfo">None</h5>
                    </div>
                </div>
                <div class="col-lg-6 remoteDataContainer display_none">
                    <div class="text-center utilityInfoCategory">
                        <i class="fas fa-sign-in-alt text-muted mt-2 mb-1 fs-5"></i><br>
                        <small class="text-muted text-uppercase utilityCategoryName">Logins</small>
                        <h5 class="utilityLoginsInfo">None</h5>
                    </div>
                </div>
                <div class="col-lg-6 remoteDataContainer display_none">
                    <div class="text-center utilityInfoCategory">
                        <i class="fas fa-box-open text-muted mt-2 mb-1 fs-5"></i><br>
                        <small class="text-muted text-uppercase utilityCategoryName">Package</small>
                        <h5 class="utilityPackageInfo">None</h5>
                    </div>
                </div>
                <div class="col-lg-6 remoteDataContainer display_none">
                    <div class="text-center utilityInfoCategory">
                        <i class="fas fa-tv text-muted mt-2 mb-1 fs-5"></i><br>
                        <small class="text-muted text-uppercase utilityCategoryName">Monitoring</small>
                        <h5 class="utilityMonitoringInfo">Always</h5>
                    </div>
                </div>
                <div class="col-lg-6 remoteDataContainer display_none">
                    <div class="text-center utilityInfoCategory">
                        <i class="fas fa-file-invoice-dollar text-muted mt-2 mb-1 fs-5"></i><br>
                        <small class="text-muted text-uppercase utilityCategoryName">Ledger Balance</small>
                        <h5 class="utilityLedgerBalanceInfo">$0.00</h5>
                    </div>
                </div>
                <div class="col-lg-6 remoteDataContainer display_none">
                    <div class="text-center utilityInfoCategory">
                        <i class="fas fa-sticky-note text-muted mt-2 mb-1 fs-5"></i><br>
                        <small class="text-muted text-uppercase utilityCategoryName">Notes</small>
                        <h5 class="utilityNotesInfo">4 Entries</h5>
                    </div>
                </div>
                <div class="col mt-3 mb-2 remoteUtilityLoader">
                    <div class="text-center">
                        <div class="spinner-border text-secondary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="text-center utilityInfoCategory utilityBackToCustomerList">
                        <small class="text-muted text-uppercase fw-bold"><i class="fas fa-arrow-left text-muted"></i>&ensp;BACK TO CUSTOMER LISTS</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function getRemoteUtilityData() {
        $.ajax({
            type: "POST",
            url: `${window.origin}/AlarmApiPortal/searchApiData/getRemoteUtilityInfo`,
            data: {
                customer_id : <?php echo $profile_info->prof_id; ?>,
                alarmcom_customer_id : <?php echo ($alarmcom_info['customer_id']) ? $alarmcom_info['customer_id'] : 0 ; ?>,
            },
            beforeSend: function() {
                $('.remoteDataContainer').hide();
                $('.remoteUtilityLoader').fadeIn('fast');
            },
            success: function(response) {
                const data = JSON.parse(response);

                if (data) {
                    data.forEach(element => {
                        switch (element.category) {
                            case 'customer_info':
                                $('.utilityCustomerInfo').text(`${element.data}`);
                            break;
                            case 'status':
                                $('.utilityStatusInfo').text(`${element.data}`);
                            break;
                            case 'documents':
                                $('.utilityDocumentsInfo').text(`${element.data}`);
                            break;
                            case 'gallery':
                                $('.utilityGalleryInfo').text(`${element.data}`);
                            break;
                            case 'panel_version':
                                $('.utilityPanelTypeInfo').text(`${element.data}`);
                            break;
                            case 'login_name':
                                $('.utilityLoginsInfo').text(`${element.data}`);
                            break;
                            case 'package_description':
                                $('.utilityPackageInfo').text(`${element.data}`);
                            break;
                            case 'monitoring':
                                $('.utilityMonitoringInfo').text(`${element.data}`);
                            break;
                            case 'ledger_balance':
                                const balance = (element.data != null) ? element.data : 0.00;
                                $('.utilityLedgerBalanceInfo').text(parseFloat(balance).toLocaleString('en-US', { style: 'currency', currency: 'USD' }));
                            break;
                            case 'notes':
                                $('.utilityNotesInfo').text(`${element.data}`);
                            break;
                        }
                    });
                } else { }

                $('.remoteDataContainer').fadeIn('fast');
                $('.remoteUtilityLoader').hide();
                $('.utilityWidgetRefreshButton').removeClass('btn-secondary').addClass('btn-primary').removeAttr('disabled').html('<small>REFRESH</small>');
            },
            error: function() {
                $('.remoteDataContainer').fadeIn('fast');
                $('.remoteUtilityLoader').hide();
                Swal.fire({
                    icon: "error",
                    title: "Network Error!",
                    html: "Please check your connection and try again.",
                    showConfirmButton: true,
                });
            }
        });
    }

    $(function () {
        getRemoteUtilityData();
    });

    $(document).on('click', '.utilityWidgetRefreshButton', function () {
        $(this).removeClass('btn-primary').addClass('btn-secondary').attr('disabled', true).html('<i class="fas fa-spinner fa-pulse"></i>');
        getRemoteUtilityData();
    });

    $(document).on('click', '.utilityBackToCustomerList', function () {
        window.location.href = `${window.origin}/customer`;
    });
</script>
