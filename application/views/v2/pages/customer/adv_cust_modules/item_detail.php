<div class="col-12 col-md-4">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Item Details</span>
            </div>
        </div>
        <div class="nsm-card-content">
            <div class="row g-3">
                <div class="col-md-12">
                    <div id="customer-items-container"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        load_customer_items();

        function load_customer_items(){
            let customer_id = '<?= $customer_profile_id; ?>';
            $.ajax({
                type: "POST",
                url: base_url + "customer/_load_item_details", 
                data: {customer_id : customer_id},
                success: function(html)
                {
                    $('#customer-items-container').html(html)
                },
                beforeSend: function(){
                    $('#customer-items-container').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        }
        $("#job-items-table").nsmPagination();
    });
</script>

<!-- Icon Library -->
<?php 
    $equipmentIcons = [
        "notes" => "fas fa-sticky-note",
        "communication" => "fas fa-broadcast-tower",
        "panel" => "fas fa-solar-panel",
        "sensor" => "fas fa-link",
        "peripheral" => "fas fa-network-wired",
        "video" => "fas fa-video",
        "access_point" => "fas fa-satellite-dish",
        "zwave" => "fas fa-wave-square",
        "liftmaster" => "fas fa-warehouse",
        "geo" => "fas fa-location-arrow",
        "voice" => "fas fa-microphone",
        "other" => "fas fa-ellipsis-h",
    ];

    // echo '<pre>';
    // print_r($alarmcom_info);
    // echo '</pre>';
?>
<style>
    .equipmentCategories {
        cursor: pointer;
    }

    .equipmentItem {
        margin: 1px;
        transition: background 0.2s ease;
    }

    .equipmentItem:hover {
        outline: 1px solid #80808036;
        background: #00000005;
        border-radius: 5px;
    }

    .equipmentItemSelected {
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
    .equipmentCategories,
    .editdEquipmentButton {
        border-color: lightgray;
    }

    .addEquipmentSave,
    .editEquipmentSave {
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

    .equipmentItemBadge {
        background: #6a4a86 !important;
        border: 1px solid #6a4a86 !important;
        padding: 2.5px;
        position: absolute;
        top: 13px;
        width: unset !important;
    }

</style>
<div class="col-12 col-md-4">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Equipment</span>
                <button class="btn btn-primary float-end opacity-50 btn-sm equipmentWidgetRefreshButton"><small>REFRESH</small></button>
            </div>
        </div>
        <div class="nsm-card-content">
            <div class="row">
                <div class="col-lg-12 mb-2">
                    <input type="text" class="form-control equipmentSearchBar" placeholder="Search">
                </div>
                <div class="col-lg-12 mb-2">
                    <div class="equipmentCategories table-responsive d-flex">
                        <div class="equipmentItem text-center px-3 mb-2" equipment-type="notes">
                            <span class="opacity-50">
                                <i class="<?php echo $equipmentIcons['notes']; ?>"></i>
                                <br>
                                <small class="fw-bold">Notes</small>
                            </span>
                        </div>
                        <div class="equipmentItem text-center px-3 mb-2" equipment-type="communication">
                            <span class="opacity-50">
                                <i class="<?php echo $equipmentIcons['communication']; ?>"></i>
                                <br>
                                <small class="fw-bold">Comm</small>
                            </span>
                        </div>
                        <div class="equipmentItem text-center px-3 mb-2" equipment-type="panel">
                            <span class="opacity-50">
                                <i class="<?php echo $equipmentIcons['panel']; ?>"></i>
                                <br>
                                <small class="fw-bold">Panel</small>
                            </span>
                        </div>
                        <div class="equipmentItem text-center px-3 mb-2" equipment-type="sensor">
                            <span class="opacity-50">
                                <i class="<?php echo $equipmentIcons['sensor']; ?>"></i>
                                <br>
                                <small class="fw-bold">Sensor</small>
                            </span>
                        </div>
                        <div class="equipmentItem text-center px-3 mb-2" equipment-type="peripheral">
                            <span class="opacity-50">
                                <i class="<?php echo $equipmentIcons['peripheral']; ?>"></i>
                                <br>
                                <small class="fw-bold">Perif</small>
                            </span>
                        </div>
                        <div class="equipmentItem text-center px-3 mb-2" equipment-type="video">
                            <span class="opacity-50">
                                <i class="<?php echo $equipmentIcons['video']; ?>"></i>
                                <br>
                                <small class="fw-bold">Video</small>
                            </span>
                        </div>
                        <div class="equipmentItem text-center px-3 mb-2" equipment-type="access_point">
                            <span class="opacity-50">
                                <i class="<?php echo $equipmentIcons['access_point']; ?>"></i>
                                <br>
                                <small class="fw-bold">AP</small>
                            </span>
                        </div>
                        <div class="equipmentItem text-center px-3 mb-2" equipment-type="zwave">
                            <span class="opacity-50">
                                <i class="<?php echo $equipmentIcons['zwave']; ?>"></i>
                                <br>
                                <small class="fw-bold">ZWave</small>
                            </span>
                        </div>
                        <div class="equipmentItem text-center px-3 mb-2" equipment-type="liftmaster">
                            <span class="opacity-50">
                                <i class="<?php echo $equipmentIcons['liftmaster']; ?>"></i>
                                <br>
                                <small class="fw-bold">LiftMaster</small>
                            </span>
                        </div>
                        <div class="equipmentItem text-center px-3 mb-2" equipment-type="geo">
                            <span class="opacity-50">
                                <i class="<?php echo $equipmentIcons['geo']; ?>"></i>
                                <br>
                                <small class="fw-bold">Geo</small>
                            </span>
                        </div>
                        <div class="equipmentItem text-center px-3 mb-2" equipment-type="voice">
                            <span class="opacity-50">
                                <i class="<?php echo $equipmentIcons['voice']; ?>"></i>
                                <br>
                                <small class="fw-bold">Voice</small>
                            </span>
                        </div>
                        <div class="equipmentItem text-center px-3 mb-2" equipment-type="other">
                            <span class="opacity-50">
                                <i class="<?php echo $equipmentIcons['other']; ?>"></i>
                                <br>
                                <small class="fw-bold">Other</small>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="equipmentAccordion display_none border rounded mb-2" equipment-type="communication">
                        <button class="btn w-100 text-start accordionButton text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#communicationCollapse">
                            <strong>Communication&ensp;<span class="communicationDeviceCount">(1)</span></strong>
                        </button>
                        <div class="collapse" id="communicationCollapse">
                            <div class="px-3 border-top position-relative">
                                <div class="d-flex align-items-center mt-3 mb-3 gap-3">
                                    <i class="<?php echo $equipmentIcons['communication']; ?> fs-4 text-muted"></i>
                                    <div class="d-flex flex-column">
                                        <small class="text-muted upperEquipmentDetail"><?php echo $alarmcom_info['modeminfo_network']; ?>&ensp;<span class="badge bg-primary opacity-50 alarmcomBadgeEquipment">alarm.com</span></small>
                                        <strong class="text-muted">Cellular</strong>
                                    </div>
                                    <div class="equipmentSerial ms-auto text-end">
                                        <strong class="text-muted mx-1"><?php echo $alarmcom_info['modeminfo_imei']; ?></strong>
                                        <span class="text-success opacity-75"><i class="fas fa-circle"></i></span>
                                    </div>
                                    <!-- <div class="equipmentEditItem ms-auto text-end display_none">
                                        <button class="btn btn-light editdEquipmentButton text-muted mx-1" type="button"></button>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="equipmentAccordion display_none border rounded mb-2" equipment-type="panel">
                        <button class="btn w-100 text-start accordionButton text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#panelCollapse">
                            <strong>Panel&ensp;<span class="panelDeviceCount">(1)</span></strong>
                        </button>
                        <div class="collapse" id="panelCollapse">
                            <div class="px-3 border-top position-relative">
                                <div class="d-flex align-items-center mt-3 mb-3 gap-3">
                                    <i class="<?php echo $equipmentIcons['panel']; ?> fs-4 text-muted"></i>
                                    <div class="d-flex flex-column">
                                        <small class="text-muted upperEquipmentDetail"><?php echo $alarmcom_info['panel_version']; ?>&ensp;<span class="badge bg-primary opacity-50 alarmcomBadgeEquipment">alarm.com</span></small>
                                        <strong class="text-muted panelDeviceName">Panel</strong>
                                    </div>
                                    <div class="equipmentSerial ms-auto text-end">
                                        <strong class="text-muted mx-1 panelDeviceId">127</strong>
                                        <span class="text-success opacity-75"><i class="fas fa-circle"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="equipmentAccordion display_none border rounded mb-2" equipment-type="sensor">
                        <button class="btn w-100 text-start accordionButton text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#sensorCollapse">
                            <strong>Sensor&ensp;<span class="sensorDeviceCount">(0)</span></strong>
                        </button>
                        <div class="collapse" id="sensorCollapse"></div>
                    </div>
                    <div class="equipmentAccordion display_none border rounded mb-2" equipment-type="peripheral">
                        <button class="btn w-100 text-start accordionButton text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#peripheralCollapse">
                            <strong>Peripheral&ensp;<span class="peripheralDeviceCount">(0)</span></strong>
                        </button>
                        <div class="collapse" id="peripheralCollapse"></div>
                    </div>
                    <div class="equipmentAccordion display_none border rounded mb-2" equipment-type="video">
                        <button class="btn w-100 text-start accordionButton text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#videoCollapse">
                            <strong>Video Device&ensp;<span class="videoDeviceCount">(0)</span></strong>
                        </button>
                        <div class="collapse" id="videoCollapse"></div>
                    </div>
                    <div class="equipmentAccordion display_none border rounded mb-2" equipment-type="access_point">
                        <button class="btn w-100 text-start accordionButton text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#access_pointCollapse">
                            <strong>Access Point & Chime&ensp;<span class="access_pointDeviceCount">(0)</span></strong>
                        </button>
                        <div class="collapse" id="access_pointCollapse"></div>
                    </div>
                    <div class="equipmentAccordion display_none border rounded mb-2" equipment-type="zwave">
                        <button class="btn w-100 text-start accordionButton text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#zwaveCollapse">
                            <strong>Z-Wave Device&ensp;<span class="zwaveDeviceCount">(0)</span></strong>
                        </button>
                        <div class="collapse" id="zwaveCollapse"></div>
                    </div>
                    <div class="equipmentAccordion display_none border rounded mb-2" equipment-type="liftmaster">
                        <button class="btn w-100 text-start accordionButton text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#liftmasterCollapse">
                            <strong>Lift Master&ensp;<span class="liftmasterDeviceCount">(0)</span></strong>
                        </button>
                        <div class="collapse" id="liftmasterCollapse"></div>
                    </div>
                    <div class="equipmentAccordion display_none border rounded mb-2" equipment-type="geo">
                        <button class="btn w-100 text-start accordionButton text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#geoCollapse">
                            <strong>Geo Device&ensp;<span class="geoDeviceCount">(0)</span></strong>
                        </button>
                        <div class="collapse" id="geoCollapse"></div>
                    </div>
                    <div class="equipmentAccordion display_none border rounded mb-2" equipment-type="voice">
                        <button class="btn w-100 text-start accordionButton text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#voiceCollapse">
                            <strong>Voice Device&ensp;<span class="voiceDeviceCount">(0)</span></strong>
                        </button>
                        <div class="collapse" id="voiceCollapse"></div>
                    </div>
                    <div class="equipmentAccordion display_none border rounded" equipment-type="other">
                        <button class="btn w-100 text-start accordionButton text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#otherCollapse">
                            <strong>Other Device&ensp;<span class="otherDeviceCount fw-normal text-muted">(0)</span></strong>
                        </button>
                        <div class="collapse" id="otherCollapse"></div>
                    </div>
                    <div class="col mt-2 equipmentLoader">
                        <div class="text-center">
                            <div class="spinner-border text-secondary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12"><hr></div>
                <div class="col-lg-12">
                    <button class="btn btn-light addEquipmentButton w-100" type="button"><i class="fas fa-plus text-muted"></i>&ensp;Add New Item</button>
                    <div class="addEquipmentContainer display_none">
                        <h5 class="fw-bold">Add New Item</h5>
                        <form class="addEquipmentForm">
                            <div class="row">
                                <div class="col-lg-12 d-none">
                                    <input type="hidden" class="form-control" name="addEquipmentCustomerId" value="<?php echo $profile_info->prof_id; ?>" required>
                                </div>
                                <div class="col-lg-8 mb-3 addCategoryContainer">
                                    <label class="form-label fw-xnormal">Category</label>
                                    <select class="form-select" name="addEquipmentCategory" required>
                                        <option value="" selected disabled hidden>&mdash;</option>
                                        <option value="dvr">Digital Video Recorder</option>
                                        <option value="nvr">Network Video Recorder</option>
                                        <option value="pers">Personal Emergency Response System</option>
                                    </select>
                                </div>  
                                <div class="col-lg-5 mb-3 display_none addQRCodeContainer">
                                    <label class="form-label fw-xnormal">NAV QR Code</label>
                                    <input type="file" class="form-control" name="addEquipmentQRCode">
                                </div>
                                <div class="col-lg-4 mb-3 addDeviceTypeContainer">
                                    <label class="form-label fw-xnormal">Device Type</label>
                                    <select class="form-select" name="addEquipmentDeviceType" required>
                                        <option value="" selected disabled hidden>&mdash;</option>
                                        <option value="communication">Communication</option>
                                        <option value="panel">Panel</option>
                                        <option value="sensor">Sensor</option>
                                        <option value="peripheral">Peripheral</option>
                                        <option value="video">Video</option>
                                        <option value="access_point">Access Point</option>
                                        <option value="zwave">Z-Wave</option>
                                        <option value="liftmaster">Lift Master</option>
                                        <option value="geo">Geo</option>
                                        <option value="voice">Voice</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 mb-3 addSerialNoContainer">
                                    <label class="form-label fw-xnormal">Serial No.</label>
                                    <input type="text" class="form-control" name="addEquipmentSerialNo" required>
                                </div>
                                <div class="col-lg-6 mb-3 addModelNoContainer">
                                    <label class="form-label fw-xnormal">Model No.</label>
                                    <input type="text" class="form-control" name="addEquipmentModelNo" required>
                                </div>
                                <div class="col-lg-7 mb-3 addNameContainer">
                                    <label class="form-label fw-xnormal">Name</label>
                                    <input type="text" class="form-control" name="addEquipmentName" required>
                                </div>
                                <div class="col-lg-2 mb-3 addQtyContainer">
                                    <label class="form-label fw-xnormal">Qty</label>
                                    <input type="number" class="form-control" name="addEquipmentQty" required min="0" value="1">
                                </div>
                                <div class="col-lg-3 mb-3 addStatusContainer">
                                    <label class="form-label fw-xnormal">Status</label>
                                    <select class="form-select" name="addEquipmentStatus" required>
                                        <option value="active" selected>Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                                <div class="col-lg-12">
                                    <div class="float-end mt-1">
                                        <button class="btn btn-light cancelAddEquipmentButton mx-1" type="button">Cancel</button>
                                        <button type="submit" class="btn btn-primary fw-bold addEquipmentSave"><i class="fas fa-file-import"></i>&ensp;Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="editEquipmentContainer display_none">
                        <h5 class="fw-bold">Edit Item</h5>
                        <form class="editEquipmentForm">
                            <div class="row">
                                <div class="col-lg-12 d-none">
                                    <input type="hidden" class="form-control" name="editEquipmentCustomerId" value="<?php echo $profile_info->prof_id; ?>" required>
                                    <input type="hidden" class="form-control" name="editEquipmentId" required>
                                </div>
                                <div class="col-lg-8 mb-3 editCategoryContainer">
                                    <label class="form-label fw-xnormal">Category</label>
                                    <select class="form-select" name="editEquipmentCategory" required>
                                        <option value="" selected disabled hidden>&mdash;</option>
                                        <option value="dvr">Digital Video Recorder</option>
                                        <option value="nvr">Network Video Recorder</option>
                                        <option value="pers">Personal Emergency Response System</option>
                                    </select>
                                </div>  
                                <div class="col-lg-5 mb-3 display_none editQRCodeContainer">
                                    <label class="form-label fw-xnormal">NAV QR Code</label>
                                    <input type="file" class="form-control" name="editEquipmentQRCode">
                                </div>
                                <div class="col-lg-4 mb-3 editDeviceTypeContainer">
                                    <label class="form-label fw-xnormal">Device Type</label>
                                    <select class="form-select" name="editEquipmentDeviceType" required>
                                        <option value="" selected disabled hidden>&mdash;</option>
                                        <option value="communication">Communication</option>
                                        <option value="panel">Panel</option>
                                        <option value="sensor">Sensor</option>
                                        <option value="peripheral">Peripheral</option>
                                        <option value="video">Video</option>
                                        <option value="access_point">Access Point</option>
                                        <option value="zwave">Z-Wave</option>
                                        <option value="liftmaster">Lift Master</option>
                                        <option value="geo">Geo</option>
                                        <option value="voice">Voice</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 mb-3 editSerialNoContainer">
                                    <label class="form-label fw-xnormal">Serial No.</label>
                                    <input type="text" class="form-control" name="editEquipmentSerialNo" required>
                                </div>
                                <div class="col-lg-6 mb-3 editModelNoContainer">
                                    <label class="form-label fw-xnormal">Model No.</label>
                                    <input type="text" class="form-control" name="editEquipmentModelNo" required>
                                </div>
                                <div class="col-lg-7 mb-3 editNameContainer">
                                    <label class="form-label fw-xnormal">Name</label>
                                    <input type="text" class="form-control" name="editEquipmentName" required>
                                </div>
                                <div class="col-lg-2 mb-3 editQtyContainer">
                                    <label class="form-label fw-xnormal">Qty</label>
                                    <input type="number" class="form-control" name="editEquipmentQty" required min="0" value="1">
                                </div>
                                <div class="col-lg-3 mb-3 editStatusContainer">
                                    <label class="form-label fw-xnormal">Status</label>
                                    <select class="form-select" name="editEquipmentStatus" required>
                                        <option value="active" selected>Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                                <div class="col-lg-12">
                                    <div class="float-start mt-1">
                                        <button type="button" class="btn btn-danger fw-bold removeEquipmentButton opacity-75"><i class="fas fa-trash"></i></button>
                                    </div>
                                    <div class="float-end mt-1">
                                        <button class="btn btn-light cancelEditEquipmentButton mx-1" type="button">Cancel</button>
                                        <button type="submit" class="btn btn-primary fw-bold editEquipmentSave"><i class="fas fa-save"></i>&ensp;Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var equipmentIcons = <?php echo json_encode($equipmentIcons); ?>;
    var deviceTypes = Object.keys(equipmentIcons).filter(key => key !== 'notes');

    function formDisabler(selector, state) {
        const element = $(selector);
        const submitButton = element.find('button[type="submit"]');
        element.find("input, button, textarea, select").prop('disabled', state);

        if (state) {
            // element.find('a').hide();
            if (!submitButton.data('original-content')) {
                submitButton.data('original-content', submitButton.html());
            }
            submitButton.prop('disabled', true).html('Processing...');
        } else {
            // element.find('a').show();
            const originalContent = submitButton.data('original-content');
            if (originalContent) {
                submitButton.prop('disabled', false).html(originalContent);
            }
        }
    }

    function getAlarmEquipmentDetails(customer_id) {
        $.ajax({
            url: `${window.origin}/AlarmApiPortal/searchAlarmEquipment`,
            type: "POST",
            data: { customer_id: `${customer_id}` },
            beforeSend: function() {
                $('.equipmentAccordion').hide();
                $('.equipmentLoader').fadeIn('fast');
            },
            success: function(response) {
                const equipmentDetails = JSON.parse(response);

                const panelDevice = equipmentDetails.panel || [];
                const panelDeviceCount = panelDevice.length;
                if (panelDeviceCount > 0) {
                    const panelDeviceName = panelDevice[0].webSiteDeviceName;
                    const panelDeviceId = panelDevice[0].deviceId;
                    $('.panelDeviceCount').text(`(${panelDeviceCount})`);
                    $('.panelDeviceName').text(panelDeviceName);
                    $('.panelDeviceId').text(panelDeviceId);
                } else {
                    $('.panelDeviceCount').text(`(0)`).addClass('fw-normal text-muted');
                }

                const renderDevices = (type, devices) => {
                    const count = devices.length;
                    const icon = equipmentIcons[type] || equipmentIcons['other'];
                    const collapseID = `#${type}Collapse`;
                    const countSelector = `.${type}DeviceCount`;

                    if (count > 0) {
                        let html = "";
                        devices.forEach(device => {
                            const deviceId = device.mac || device.deviceId;
                            const deviceName =
                                device.videoDeviceModel ||
                                device.access_pointDeviceModel ||
                                device.zwaveDeviceModel ||
                                device.liftmasterDeviceModel ||
                                device.geoDeviceModel ||
                                device.deviceName;

                            html += `
                                <div class="px-3 border-top position-relative">
                                    <div class="d-flex align-items-center mt-3 mb-3 gap-3">
                                        <i class="${icon} fs-4 text-muted"></i>
                                        <div class="d-flex flex-column">
                                            <small class="text-muted upperEquipmentDetail">
                                                ${deviceName}&ensp;
                                                <span class="badge bg-primary opacity-50 alarmcomBadgeEquipment">alarm.com</span>
                                            </small>
                                            <strong class="text-muted">${device.webSiteDeviceName}</strong>
                                        </div>
                                        <div class="equipmentSerial ms-auto text-end">
                                            <strong class="text-muted mx-1">${deviceId}</strong>
                                            <span class="text-success opacity-75"><i class="fas fa-circle"></i></span>
                                        </div>
                                    </div>
                                </div>`;
                        });

                        $(collapseID).html(html);
                        $(countSelector).text(`(${count})`).removeClass('fw-normal text-muted');
                    } else {
                        $(collapseID).html('');
                        $(countSelector).text(`(0)`).addClass('fw-normal text-muted');
                    }
                };

                renderDevices('sensor', equipmentDetails.sensor || []);
                renderDevices('peripheral', equipmentDetails.peripheral || []);
                renderDevices('video', equipmentDetails.video || []);
                renderDevices('access_point', equipmentDetails.access_point || []);
                renderDevices('zwave', equipmentDetails.zwave || []);
                renderDevices('liftmaster', equipmentDetails.liftmaster || []);
                renderDevices('geo', equipmentDetails.geo || []);
                renderDevices('voice', equipmentDetails.voice || []);
                getCustomerEquipment("<?php echo $profile_info->prof_id; ?>");

                $('.equipmentAccordion').fadeIn('fast');
                $('.equipmentLoader').hide();
                $('.equipmentWidgetRefreshButton').removeClass('btn-secondary').addClass('btn-primary').removeAttr('disabled').html('<small>REFRESH</small>');
            },
            error: function() {
                $('.equipmentAccordion').fadeIn('fast');
                $('.equipmentLoader').hide();
                $('.equipmentWidgetRefreshButton').removeClass('btn-secondary').addClass('btn-primary').removeAttr('disabled').html('<small>REFRESH</small>');
            }
        });
    }

    function getCustomerEquipment(customer_id) {
        $.ajax({
            type: "POST",
            url: `${window.origin}/Customer/getCustomerEquipment`,
            data: { customer_id: `${customer_id}` },
            success: function (response) {
                const data = JSON.parse(response);
                $('.equipmentItemContainer').remove();

                data.forEach(item => {
                    const type = item.device_type || 'other';
                    const icon = equipmentIcons[type] || equipmentIcons['other'];
                    const collapseID = `#${type}Collapse`;
                    const countSelector = `.${type}DeviceCount`;

                    const html = `
                        <div class="px-3 border-top position-relative equipmentItemContainer" data-id="${item.id}">
                            <div class="d-flex align-items-center mt-3 mb-3 gap-3">
                                <i class="${icon} fs-4 text-muted"></i>
                                <div class="d-flex flex-column">
                                    <small class="text-muted upperEquipmentDetail">
                                        ${item.model_no}&ensp;
                                        <span class="badge bg-primary opacity-50 equipmentItemBadge">nsmartrac</span>
                                    </small>
                                    <strong class="text-muted">
                                        ${item.equipment}&ensp;
                                        <small class="fw-normal">
                                            <a class="text-decoration-none editEquipmentButton" href="javascript:void(0)" equipment_id="${item.id}" category="${item.category}" device_type="${item.device_type}" serial_no="${item.serial_no}" model_no="${item.model_no}" qty="${item.qty}" equipment_name="${item.equipment}" status="${item.status}">
                                                <i class="fas fa-edit opacity-75"></i> Edit
                                            </a>
                                        </small>
                                    </strong>
                                </div>
                                <div class="equipmentSerial ms-auto text-end">
                                    <strong class="text-muted mx-1">${item.serial_no}</strong>
                                    ${
                                        item.status === 'inactive'
                                        ? `<span class="text-danger opacity-75"><i class="fas fa-circle"></i></span>`
                                        : `<span class="text-success opacity-75"><i class="fas fa-circle"></i></span>`
                                    }
                                </div>
                            </div>
                        </div>
                    `;

                    $(collapseID).prepend($(html).hide().fadeIn('fast')).collapse('show');
                    const count = $(`${collapseID} .px-3.border-top.position-relative`).length;
                    $(countSelector).text(`(${count})`).removeClass('fw-normal text-muted');
                });
            },
            error: function (xhr, status, error) {
                console.error("Error fetching equipment:", error);
            },
        });
    }

    $(document).ready(function () {
        $('.equipmentWidgetRefreshButton').click();
    });

    $(document).on('click', '.equipmentWidgetRefreshButton', function() {
        $(this).removeClass('btn-primary').addClass('btn-secondary').attr('disabled', true).html('<i class="fas fa-spinner fa-pulse"></i>');
        try {
            getAlarmEquipmentDetails("<?php echo $alarmcom_info['customer_id']; ?>");
        } catch (error) { }
    });

    $(document).on('click', '.equipmentItem', function () {
        const equipment_type = $(this).attr('equipment-type');
        const targetAccordion = $(`.equipmentAccordion[equipment-type="${equipment_type}"]`);

        if ($(this).hasClass('equipmentItemSelected')) {
            $('.equipmentAccordion').fadeIn('fast');
            $('.equipmentItem').removeClass('equipmentItemSelected');
        } else {    
            $('.equipmentAccordion').hide();
            targetAccordion.fadeIn('fast');

            $('.equipmentItem').removeClass('equipmentItemSelected');
            $(this).addClass('equipmentItemSelected');
        }
    });
    
    $('.equipmentSearchBar').on('input', function () {
        const query = $(this).val().trim().toLowerCase();

        if (!query) {
            $('.equipmentAccordion').fadeIn('fast');
            $('.equipmentAccordion .px-3').fadeIn('fast');
            return;
        }

        $('.equipmentAccordion').each(function () {
            const accordion = $(this);
            const items = accordion.find('.px-3');
            let hasMatch = false;

            items.each(function () {
                const text = $(this).text().toLowerCase();
                const match = text.includes(query);

                $(this).toggle(match);
                if (match) hasMatch = true;
            });

            accordion.toggle(hasMatch);
        });
    });

    $(document).on('click', '.addEquipmentButton', function() {
        $('.addEquipmentButton').hide();
        $('.addEquipmentContainer').fadeIn('fast');
        $('.editEquipmentContainer').hide();
    });

    $(document).on('click', '.cancelAddEquipmentButton', function() {
        $('.addEquipmentButton').fadeIn('fast');
        $('.addEquipmentContainer').hide();
        $('.editEquipmentContainer').hide();
    });

    $(document).on('click', '.editEquipmentButton', function () {
        $('.addEquipmentButton').hide();
        $('.addEquipmentContainer').hide();
        $('.editEquipmentContainer').fadeIn('fast');
        
        const equipmentData = {
            id: $(this).attr('equipment_id'),
            category: $(this).attr('category'),
            device_type: $(this).attr('device_type'),
            serial_no: $(this).attr('serial_no'),
            model_no: $(this).attr('model_no'),
            qty: $(this).attr('qty'),
            equipment_name: $(this).attr('equipment_name'),
            status: $(this).attr('status')
        };

        const form = $('.editEquipmentForm');
        form.find('input, select').val(null);
        form.find('[name="editEquipmentId"]').val(equipmentData.id);
        form.find('[name="editEquipmentCategory"]').val(equipmentData.category).trigger('change');
        form.find('[name="editEquipmentDeviceType"]').val(equipmentData.device_type).trigger('change');
        form.find('[name="editEquipmentSerialNo"]').val(equipmentData.serial_no);
        form.find('[name="editEquipmentModelNo"]').val(equipmentData.model_no);
        form.find('[name="editEquipmentName"]').val(equipmentData.equipment_name);
        form.find('[name="editEquipmentQty"]').val(equipmentData.qty);
        form.find('[name="editEquipmentStatus"]').val(equipmentData.status);

        const removeButton = $('.removeEquipmentButton');
        removeButton.attr({
            'equipment_id': equipmentData.id,
            'equipment_name': equipmentData.equipment_name,
            'device_type': equipmentData.device_type
        });

        const container = $('.editEquipmentContainer');
        $('html, body').animate({
            scrollTop: container.offset().top - 500
        }, 300, function () {
            container.attr('tabindex', -1).focus();
        });
    });

    $(document).on('click', '.cancelEditEquipmentButton', function() {
        $('.addEquipmentButton').fadeIn('fast');
        $('.addEquipmentContainer').hide();
        $('.editEquipmentContainer').hide();
    });

    $(document).on('submit', '.addEquipmentForm', function (e) {
        e.preventDefault();

        const addEquipmentForm = $(this);
        let addEquipmentFormData = new FormData(this);
        let category = addEquipmentFormData.get('addEquipmentCategory');
        let device_type = addEquipmentFormData.get('addEquipmentDeviceType');
        let serial_no = addEquipmentFormData.get('addEquipmentSerialNo');
        let model_no = addEquipmentFormData.get('addEquipmentModelNo');
        let qty = addEquipmentFormData.get('addEquipmentQty');
        let equipment_name = addEquipmentFormData.get('addEquipmentName');
        let status = addEquipmentFormData.get('addEquipmentStatus');
        let qrFile = addEquipmentFormData.get('addEquipmentQRCode');

        if (qrFile && qrFile.size > 5 * 1024 * 1024) {
            Swal.fire({
                icon: "warning",
                title: "QR Code Too Large",
                html: "Please upload a QR code file smaller than 5MB.",
                showConfirmButton: true,
                confirmButtonText: "Okay",
            });
            return false;
        }

        function submitForm() {
            $.ajax({
                type: "POST",
                url: `${window.origin}/Customer/saveCustomerEquipment`,
                data: addEquipmentFormData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    formDisabler(addEquipmentForm, true);
                },
                success: function (response) {
                    const item_id = response;

                    deviceTypes.forEach(type => {
                        if (device_type === type) {

                            const iconClass = equipmentIcons[type] || '';
                            const collapseID = `#${type}Collapse`;
                            const countSelector = `.${type}DeviceCount`;

                            const html = `
                                <div class="px-3 border-top position-relative equipmentItemContainer" data-id="${item_id}">
                                    <div class="d-flex align-items-center mt-3 mb-3 gap-3">
                                        <i class="${iconClass} fs-4 text-muted"></i>
                                        <div class="d-flex flex-column">
                                            <small class="text-muted upperEquipmentDetail">
                                                ${model_no}&ensp;
                                                <span class="badge bg-primary opacity-50 equipmentItemBadge">nsmartrac</span>
                                            </small>
                                            <strong class="text-muted">
                                                ${equipment_name}&ensp;
                                                <small class="fw-normal">
                                                    <a class="text-decoration-none editEquipmentButton" href="javascript:void(0)" equipment_id="${item_id}" category="${category}" device_type="${device_type}" serial_no="${serial_no}" model_no="${model_no}" qty="${qty}" equipment_name="${equipment_name}" status="${status}">
                                                        <i class="fas fa-edit opacity-75"></i> Edit
                                                    </a>
                                                </small>
                                            </strong>
                                        </div>
                                        <div class="equipmentSerial ms-auto text-end">
                                            <strong class="text-muted mx-1">${serial_no}</strong>
                                            ${
                                                status === 'inactive'
                                                ? `<span class="text-danger opacity-75"><i class="fas fa-circle"></i></span>`
                                                : `<span class="text-success opacity-75"><i class="fas fa-circle"></i></span>`
                                            }
                                        </div>
                                    </div>
                                </div>
                            `;

                            $(collapseID).prepend(html).collapse('show');

                            const count = $(`${collapseID} .px-3.border-top.position-relative`).length;
                            $(countSelector).text(`(${count})`).removeClass('fw-normal text-muted');
                        }
                    });

                    $('.addEquipmentButton').fadeIn('fast');
                    $('.addEquipmentContainer').hide();
                    addEquipmentForm.find('input, select').val(null);
                    $('input[name="addEquipmentQty"]').val(1);
                    $('select[name="addEquipmentStatus"]').val('active');
                    formDisabler(addEquipmentForm, false);
                },
                error: function () {
                    formDisabler(addEquipmentForm, false);
                    Swal.fire({
                        icon: "error",
                        title: "Network Error!",
                        html: "An unexpected error occurred. Please try again!",
                        showConfirmButton: true,
                        confirmButtonText: "Okay",
                    });
                },
            });
        }

        if (qrFile) {
            const reader = new FileReader();
            reader.onload = function () {
                addEquipmentFormData.set('addEquipmentQRCodeBase64', reader.result.split(',')[1]);
                submitForm();
            };
            reader.readAsDataURL(qrFile);
        } else {
            addEquipmentFormData.delete('addEquipmentQRCodeBase64');
            submitForm();
        }
    });

    $(document).on('submit', '.editEquipmentForm', function(e) {
        e.preventDefault();

        const editForm = $(this);
        let editFormData = new FormData(this);

        let equipment_id = editFormData.get('editEquipmentId');
        let category = editFormData.get('editEquipmentCategory');
        let device_type = editFormData.get('editEquipmentDeviceType');
        let serial_no = editFormData.get('editEquipmentSerialNo');
        let model_no = editFormData.get('editEquipmentModelNo');
        let qty = editFormData.get('editEquipmentQty');
        let equipment_name = editFormData.get('editEquipmentName');
        let status = editFormData.get('editEquipmentStatus');
        let qrFile = editFormData.get('editEquipmentQRCode');

        if (qrFile && qrFile.size > 5 * 1024 * 1024) {
            Swal.fire({
                icon: "warning",
                title: "QR Code Too Large",
                html: "Please upload a QR code file smaller than 5MB.",
                showConfirmButton: true,
                confirmButtonText: "Okay",
            });
            return false;
        }

        function submitForm() {
            $.ajax({
                type: "POST",
                url: `${window.origin}/Customer/updateCustomerEquipment`,
                data: editFormData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    formDisabler(editForm, true);
                },
                success: function(response) {
                    formDisabler(editForm, false);
                    const item_id = equipment_id;
                    const iconClass = equipmentIcons[device_type] || '';
                    const itemContainer = $(`.equipmentItemContainer[data-id="${item_id}"]`);
                    const oldDeviceType = itemContainer.closest('.collapse').attr('id')?.replace('Collapse', '') || '';
                    const newDeviceType = device_type;
                    const newCollapseID = `#${newDeviceType}Collapse`;
                    const newCountSelector = `.${newDeviceType}DeviceCount`;
                    const updatedHTML = `
                        <div class="px-3 border-top position-relative equipmentItemContainer" data-id="${item_id}">
                            <div class="d-flex align-items-center mt-3 mb-3 gap-3">
                                <i class="${iconClass} fs-4 text-muted"></i>
                                <div class="d-flex flex-column">
                                    <small class="text-muted upperEquipmentDetail">
                                        ${model_no}&ensp;
                                        <span class="badge bg-primary opacity-50 equipmentItemBadge">nsmartrac</span>
                                    </small>
                                    <strong class="text-muted">
                                        ${equipment_name}&ensp;
                                        <small class="fw-normal">
                                            <a class="text-decoration-none editEquipmentButton" href="javascript:void(0)" equipment_id="${item_id}" category="${category}" device_type="${device_type}" serial_no="${serial_no}" model_no="${model_no}" qty="${qty}" equipment_name="${equipment_name}" status="${status}">
                                                <i class="fas fa-edit opacity-75"></i> Edit
                                            </a>
                                        </small>
                                    </strong>
                                </div>
                                <div class="equipmentSerial ms-auto text-end">
                                    <strong class="text-muted mx-1">${serial_no}</strong>
                                    ${
                                        status === 'inactive'
                                        ? `<span class="text-danger opacity-75"><i class="fas fa-circle"></i></span>`
                                        : `<span class="text-success opacity-75"><i class="fas fa-circle"></i></span>`
                                    }
                                </div>
                            </div>
                        </div>
                    `;
                    
                    if (oldDeviceType !== newDeviceType) {
                        itemContainer.remove();
                        $(newCollapseID).prepend(updatedHTML).collapse('show');

                        const oldCountSelector = `.${oldDeviceType}DeviceCount`;
                        const oldCount = $(`#${oldDeviceType}Collapse .px-3.border-top.position-relative`).length;
                        $(oldCountSelector).text(`(${oldCount})`);

                        if (oldCount === 0) {
                            $(oldCountSelector).addClass('fw-normal text-muted');
                        }

                        const newCountSelector = `.${newDeviceType}DeviceCount`;
                        const newCount = $(`#${newDeviceType}Collapse .px-3.border-top.position-relative`).length;
                        $(newCountSelector).text(`(${newCount})`).removeClass('fw-normal text-muted');
                    } else {
                        itemContainer.html($(updatedHTML).html());

                        const countSelector = `.${newDeviceType}DeviceCount`;
                        const count = $(`#${newDeviceType}Collapse .px-3.border-top.position-relative`).length;
                        $(countSelector).text(`(${count})`);

                        if (count === 0) {
                            $(countSelector).addClass('fw-normal text-muted');
                        } else {
                            $(countSelector).removeClass('fw-normal text-muted');
                        }
                    }

                    $('.editEquipmentContainer').hide();
                    $('.addEquipmentButton').fadeIn('fast');
                },
                error: function() {
                    formDisabler(editForm, false);
                    Swal.fire({
                        icon: "error",
                        title: "Network Error!",
                        html: "Please check your connection and try again.",
                        showConfirmButton: true,
                    });
                }
            });
        }

        if (qrFile && qrFile.size > 0) {
            const reader = new FileReader();
            reader.onload = function() {
                editFormData.set('editEquipmentQRCodeBase64', reader.result.split(',')[1]);
                submitForm();
            };
            reader.readAsDataURL(qrFile);
        } else {
            editFormData.delete('editEquipmentQRCodeBase64');
            submitForm();
        }
    });

    $(document).on('click', '.removeEquipmentButton', function() {
        const button = $(this);
        const equipment_id = button.attr('equipment_id');
        const equipment_name = button.attr('equipment_name');
        const device_type = button.attr('device_type');

        Swal.fire({
            icon: "warning",
            title: "Remove Equipment",
            html: `Are you sure you want to remove <strong class="text-muted">${equipment_name}</strong>?`,
            showCancelButton: true,
            confirmButtonText: "Proceed",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: `${window.origin}/Customer/removeCustomerEquipment`,
                    data: {
                        id: equipment_id
                    },
                    dataType: "JSON",
                    beforeSend: function() {
                        Swal.fire({
                            icon: "info",
                            title: "Removing Equipment",
                            html: "Please wait while the process is running...",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => Swal.showLoading(),
                        });
                    },
                    success: function(response) {
                        const container = $(`.equipmentItemContainer[data-id="${equipment_id}"]`);
                        const collapse = container.closest('.collapse');
                        const deviceType = collapse.attr('id')?.replace('Collapse', '');
                        const countSelector = `.${deviceType}DeviceCount`;

                        container.fadeOut(300, function() {
                            $(this).remove();

                            const count = $(`#${deviceType}Collapse .px-3.border-top.position-relative`).length;
                            $(countSelector).text(`(${count})`);

                            if (count === 0) {
                                $(countSelector).addClass('fw-normal text-muted');
                            } else {
                                $(countSelector).removeClass('fw-normal text-muted');
                            }
                        });

                        Swal.fire({
                            icon: "success",
                            title: "Equipment Removed!",
                            html: `<strong class='text-primary'>${equipment_name}</strong> has been successfully removed.`,
                            showConfirmButton: true,
                            confirmButtonText: "Okay",
                        });

                        $('.editEquipmentContainer').hide();
                        $('.addEquipmentButton').fadeIn('fast');
                    },
                    error: function() {
                        Swal.fire({
                            icon: "error",
                            title: "Network Error!",
                            html: "Please check your connection and try again.",
                            showConfirmButton: true,
                            confirmButtonText: "Okay",
                        });
                    }
                });
            }
        });
    });

    $(document).on('change', 'select[name="addEquipmentCategory"]', function() {
        const value = $(this).val();
        switch (value) {
            case 'dvr':
                $('select[name="addEquipmentDeviceType"]').val('video');
                $('.addCategoryContainer').removeClass('col-lg-8').addClass('col-lg-7');
                $('.addSerialNoContainer, .addModelNoContainer').removeClass('col-lg-6').addClass('col-lg-4');
                $('.addQRCodeContainer').fadeIn('fast');
                $('input[ name="addEquipmentQRCode"]').attr('required', true);
                break;
            case 'nvr':
                $('select[name="addEquipmentDeviceType"]').val('video');
                $('.addCategoryContainer').removeClass('col-lg-7').addClass('col-lg-8');
                $('.addSerialNoContainer, .addModelNoContainer').removeClass('col-lg-4').addClass('col-lg-6');
                $('.addQRCodeContainer').hide();
                $('input[ name="addEquipmentQRCode"]').removeAttr('required');
                break;
            case 'pers':
                $('select[name="addEquipmentDeviceType"]').val('other');
                $('.addCategoryContainer').removeClass('col-lg-7').addClass('col-lg-8');
                $('.addSerialNoContainer, .addModelNoContainer').removeClass('col-lg-4').addClass('col-lg-6');
                $('.addQRCodeContainer').hide();
                $('input[ name="addEquipmentQRCode"]').removeAttr('required');
                break;
        }
    });

    $(document).on('change', 'select[name="editEquipmentCategory"]', function() {
        const value = $(this).val();
        switch (value) {
            case 'dvr':
                $('select[name="editEquipmentDeviceType"]').val('video');
                $('.editCategoryContainer').removeClass('col-lg-8').addClass('col-lg-7');
                $('.editSerialNoContainer, .editModelNoContainer').removeClass('col-lg-6').addClass('col-lg-4');
                $('.editQRCodeContainer').fadeIn('fast');
                break;
            case 'nvr':
                $('select[name="editEquipmentDeviceType"]').val('video');
                $('.editCategoryContainer').removeClass('col-lg-7').addClass('col-lg-8');
                $('.editSerialNoContainer, .editModelNoContainer').removeClass('col-lg-4').addClass('col-lg-6');
                $('.editQRCodeContainer').hide();
                $('input[ name="editEquipmentQRCode"]').removeAttr('required');
                break;
            case 'pers':
                $('select[name="editEquipmentDeviceType"]').val('other');
                $('.editCategoryContainer').removeClass('col-lg-7').addClass('col-lg-8');
                $('.editSerialNoContainer, .editModelNoContainer').removeClass('col-lg-4').addClass('col-lg-6');
                $('.editQRCodeContainer').hide();
                $('input[ name="editEquipmentQRCode"]').removeAttr('required');
                break;
        }
    });
</script>
