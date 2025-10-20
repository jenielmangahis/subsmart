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

    .addNewEquipment {
        border-color: lightgray;
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
            <div class="row g-3">
                <div class="col-lg-12 mb-1">
                    <input type="text" class="form-control equipmentSearchBar" placeholder="Search">
                </div>
                <div class="col-lg-12">
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
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="equipmentAccordion display_none border rounded mb-2" equipment-type="communication">
                        <button class="btn w-100 text-start accordionButton text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#communicationCollapse">
                            <strong>Communication <span class="communicationDeviceCount">(1)</span></strong>
                        </button>
                        <div class="collapse show" id="communicationCollapse">
                            <div class="px-3 border-top">
                                <div class="d-flex align-items-center mt-3 mb-3 gap-3">
                                    <i class="<?php echo $equipmentIcons['communication']; ?> fs-4 text-muted"></i>
                                    <div class="d-flex flex-column">
                                        <small class="text-muted upperEquipmentDetail"><?php echo $alarmcom_info['modeminfo_network']; ?></small>
                                        <strong class="text-muted">Cellular</strong>
                                    </div>
                                    <div class="equipmentSerial ms-auto text-end">
                                        <strong class="text-muted mx-1"><?php echo $alarmcom_info['modeminfo_imei']; ?></strong>
                                        <span class="text-success"><i class="fas fa-check-circle"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="equipmentAccordion display_none border rounded mb-2" equipment-type="panel">
                        <button class="btn w-100 text-start accordionButton text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#panelCollapse">
                            <strong>Panel <span class="panelDeviceCount">(1)</span></strong>
                        </button>
                        <div class="collapse show" id="panelCollapse">
                            <div class="px-3 border-top">
                                <div class="d-flex align-items-center mt-3 mb-3 gap-3">
                                    <i class="<?php echo $equipmentIcons['panel']; ?> fs-4 text-muted"></i>
                                    <div class="d-flex flex-column">
                                        <small class="text-muted upperEquipmentDetail"><?php echo $alarmcom_info['panel_version']; ?></small>
                                        <strong class="text-muted panelDeviceName">Panel</strong>
                                    </div>
                                    <div class="equipmentSerial ms-auto text-end">
                                        <strong class="text-muted mx-1 panelDeviceId">127</strong>
                                        <span class="text-success"><i class="fas fa-check-circle"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="equipmentAccordion display_none border rounded mb-2" equipment-type="sensor">
                        <button class="btn w-100 text-start accordionButton text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#sensorCollapse">
                            <strong>Sensor <span class="sensorDeviceCount">(0)</span></strong>
                        </button>
                        <div class="collapse" id="sensorCollapse"></div>
                    </div>
                    <div class="equipmentAccordion display_none border rounded mb-2" equipment-type="peripheral">
                        <button class="btn w-100 text-start accordionButton text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#peripheralCollapse">
                            <strong>Peripheral <span class="peripheralDeviceCount">(0)</span></strong>
                        </button>
                        <div class="collapse" id="peripheralCollapse"></div>
                    </div>
                    <div class="equipmentAccordion display_none border rounded mb-2" equipment-type="video">
                        <button class="btn w-100 text-start accordionButton text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#videoCollapse">
                            <strong>Video Device <span class="videoDeviceCount">(0)</span></strong>
                        </button>
                        <div class="collapse" id="videoCollapse"></div>
                    </div>
                    <div class="equipmentAccordion display_none border rounded mb-2" equipment-type="access_point">
                        <button class="btn w-100 text-start accordionButton text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#access_pointCollapse">
                            <strong>Access Point & Chime <span class="access_pointDeviceCount">(0)</span></strong>
                        </button>
                        <div class="collapse" id="access_pointCollapse"></div>
                    </div>
                    <div class="equipmentAccordion display_none border rounded mb-2" equipment-type="zwave">
                        <button class="btn w-100 text-start accordionButton text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#zwaveCollapse">
                            <strong>Z-Wave Device <span class="zwaveDeviceCount">(0)</span></strong>
                        </button>
                        <div class="collapse" id="zwaveCollapse"></div>
                    </div>
                    <div class="equipmentAccordion display_none border rounded mb-2" equipment-type="liftmaster">
                        <button class="btn w-100 text-start accordionButton text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#liftmasterCollapse">
                            <strong>Lift Master <span class="liftmasterDeviceCount">(0)</span></strong>
                        </button>
                        <div class="collapse" id="liftmasterCollapse"></div>
                    </div>
                    <div class="equipmentAccordion display_none border rounded mb-2" equipment-type="geo">
                        <button class="btn w-100 text-start accordionButton text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#geoCollapse">
                            <strong>Geo Device <span class="geoDeviceCount">(0)</span></strong>
                        </button>
                        <div class="collapse" id="geoCollapse"></div>
                    </div>
                    <div class="equipmentAccordion display_none border rounded" equipment-type="voice">
                        <button class="btn w-100 text-start accordionButton text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#voiceCollapse">
                            <strong>Voice Device <span class="voiceDeviceCount">(0)</span></strong>
                        </button>
                        <div class="collapse" id="voiceCollapse"></div>
                    </div>
                    <div class="col mt-2 equipmentLoader">
                        <div class="text-center">
                            <div class="spinner-border text-secondary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<script>
    function getAlarmEquipmentDetails(customer_id) {
        $.ajax({
            url: `${window.origin}/AlarmApiPortal/searchAlarmEquipment`,
            type: "POST",
            data: {
                customer_id: `${customer_id}`,
            },
            beforeSend: function() {
                $('.equipmentAccordion').hide();
                $('.equipmentLoader').fadeIn('fast');
                $('.equipmentWidgetRefreshButton').removeClass('btn-primary').addClass('btn-secondary').attr('disabled', true).html('<i class="fas fa-spinner fa-pulse"></i>');
            },
            success: function(response) {
                const equipmentDetails = JSON.parse(response);

                // Panel Device
                const panelDevice = equipmentDetails.panel
                const panelDeviceCount = panelDevice.length;
                const panelDeviceName = panelDevice[0].webSiteDeviceName;
                const panelDeviceId = panelDevice[0].deviceId;
                if (panelDeviceCount > 0) {
                    $('.panelDeviceCount').text(`(${panelDeviceCount})`);
                    $('.panelDeviceName').text(panelDeviceName);
                    $('.panelDeviceId').text(panelDeviceId);
                } else {
                    $('.panelDeviceCount').text(`(0)`).addClass('fw-normal text-muted');
                    $('#panelCollapse').html('<div class="p-3 border-top">Nothing to show...</div>');
                }
            

                // Sensor Device
                const sensorDevice = equipmentDetails.sensor
                const sensorDeviceCount = sensorDevice.length;
                if (sensorDeviceCount > 0) {
                    let sensorHTML = "";
                    for (let index = 0; index < sensorDeviceCount; index++) {
                        sensorHTML += `
                            <div class="px-3 border-top">
                                <div class="d-flex align-items-center mt-3 mb-3 gap-3">
                                    <i class="<?php echo $equipmentIcons['sensor']; ?> fs-4 text-muted"></i>
                                    <div class="d-flex flex-column">
                                        <small class="text-muted upperEquipmentDetail">${sensorDevice[index].deviceName}</small>
                                        <strong class="text-muted">${sensorDevice[index].webSiteDeviceName}</strong>
                                    </div>
                                    <div class="equipmentSerial ms-auto text-end">
                                        <strong class="text-muted mx-1">${sensorDevice[index].deviceId}</strong>
                                        <span class="text-success"><i class="fas fa-check-circle"></i></span>
                                    </div>
                                </div>
                            </div> 
                        `;
                    }
                    $('#sensorCollapse').html( `${sensorHTML}`);
                    $('.sensorDeviceCount').text(`(${sensorDeviceCount})`);
                } else {
                    $('.sensorDeviceCount').text(`(0)`).addClass('fw-normal text-muted');
                    $('#sensorCollapse').html('<div class="p-3 border-top">Nothing to show...</div>');
                }
           
                // Peripheral Device
                const peripheralDevice = equipmentDetails.peripheral
                const peripheralDeviceCount = peripheralDevice.length;
                if (peripheralDeviceCount > 0) {
                    let peripheralHTML = "";
                    for (let index = 0; index < peripheralDeviceCount; index++) {
                        peripheralHTML += `
                            <div class="px-3 border-top">
                                <div class="d-flex align-items-center mt-3 mb-3 gap-3">
                                    <i class="<?php echo $equipmentIcons['peripheral']; ?> fs-4 text-muted"></i>
                                    <div class="d-flex flex-column">
                                        <small class="text-muted upperEquipmentDetail">${peripheralDevice[index].deviceName}</small>
                                        <strong class="text-muted">${peripheralDevice[index].webSiteDeviceName}</strong>
                                    </div>
                                    <div class="equipmentSerial ms-auto text-end">
                                        <strong class="text-muted mx-1">${peripheralDevice[index].deviceId}</strong>
                                        <span class="text-success"><i class="fas fa-check-circle"></i></span>
                                    </div>
                                </div>
                            </div> 
                        `;
                    }
                    $('#peripheralCollapse').html( `${peripheralHTML}`);
                    $('.peripheralDeviceCount').text(`(${peripheralDeviceCount})`);
                } else {
                    $('.peripheralDeviceCount').text(`(0)`).addClass('fw-normal text-muted');
                    $('#peripheralCollapse').html('<div class="p-3 border-top">Nothing to show...</div>');
                }

                // Video Device
                const videoDevice = equipmentDetails.video
                const videoDeviceCount = videoDevice.length;
                if (videoDeviceCount > 0) {
                    let videoHTML = "";
                    for (let index = 0; index < videoDeviceCount; index++) {
                        let deviceId = (videoDevice[index].mac) ? videoDevice[index].mac : videoDevice[index].deviceId;
                        let deviceName = (videoDevice[index].videoDeviceModel) ? videoDevice[index].videoDeviceModel : videoDevice[index].deviceName;

                        videoHTML += `
                            <div class="px-3 border-top">
                                <div class="d-flex align-items-center mt-3 mb-3 gap-3">
                                    <i class="<?php echo $equipmentIcons['video']; ?> fs-4 text-muted"></i>
                                    <div class="d-flex flex-column">
                                        <small class="text-muted upperEquipmentDetail">${deviceName}</small>
                                        <strong class="text-muted">${videoDevice[index].webSiteDeviceName}</strong>
                                    </div>
                                    <div class="equipmentSerial ms-auto text-end">
                                        <strong class="text-muted mx-1">${deviceId}</strong>
                                        <span class="text-success"><i class="fas fa-check-circle"></i></span>
                                    </div>
                                </div>
                            </div> 
                        `;
                    }
                    $('#videoCollapse').html( `${videoHTML}`);
                    $('.videoDeviceCount').text(`(${videoDeviceCount})`);
                } else {
                    $('.videoDeviceCount').text(`(0)`).addClass('fw-normal text-muted');
                    $('#videoCollapse').html('<div class="p-3 border-top">Nothing to show...</div>');
                }

                // Access Point & Chimes Device
                const access_pointDevice = equipmentDetails.access_point
                const access_pointDeviceCount = access_pointDevice.length;
                if (access_pointDeviceCount > 0) {
                    let access_pointHTML = "";
                    for (let index = 0; index < access_pointDeviceCount; index++) {
                        let deviceId = (access_pointDevice[index].mac) ? access_pointDevice[index].mac : access_pointDevice[index].deviceId;
                        let deviceName = (access_pointDevice[index].access_pointDeviceModel) ? access_pointDevice[index].access_pointDeviceModel : access_pointDevice[index].deviceName;

                        access_pointHTML += `
                            <div class="px-3 border-top">
                                <div class="d-flex align-items-center mt-3 mb-3 gap-3">
                                    <i class="<?php echo $equipmentIcons['access_point']; ?> fs-4 text-muted"></i>
                                    <div class="d-flex flex-column">
                                        <small class="text-muted upperEquipmentDetail">${deviceName}</small>
                                        <strong class="text-muted">${access_pointDevice[index].webSiteDeviceName}</strong>
                                    </div>
                                    <div class="equipmentSerial ms-auto text-end">
                                        <strong class="text-muted mx-1">${deviceId}</strong>
                                        <span class="text-success"><i class="fas fa-check-circle"></i></span>
                                    </div>
                                </div>
                            </div> 
                        `;
                    }
                    $('#access_pointCollapse').html( `${access_pointHTML}`);
                    $('.access_pointDeviceCount').text(`(${access_pointDeviceCount})`);
                } else {
                    $('.access_pointDeviceCount').text(`(0)`).addClass('fw-normal text-muted');
                    $('#access_pointCollapse').html('<div class="p-3 border-top">Nothing to show...</div>');
                }

                // Z-Wave Device
                const zwaveDevice = equipmentDetails.zwave
                const zwaveDeviceCount = zwaveDevice.length;
                if (zwaveDeviceCount > 0) {
                    let zwaveHTML = "";
                    for (let index = 0; index < zwaveDeviceCount; index++) {
                        let deviceId = (zwaveDevice[index].mac) ? zwaveDevice[index].mac : zwaveDevice[index].deviceId;
                        let deviceName = (zwaveDevice[index].zwaveDeviceModel) ? zwaveDevice[index].zwaveDeviceModel : zwaveDevice[index].deviceName;

                        zwaveHTML += `
                            <div class="px-3 border-top">
                                <div class="d-flex align-items-center mt-3 mb-3 gap-3">
                                    <i class="<?php echo $equipmentIcons['zwave']; ?> fs-4 text-muted"></i>
                                    <div class="d-flex flex-column">
                                        <small class="text-muted upperEquipmentDetail">${deviceName}</small>
                                        <strong class="text-muted">${zwaveDevice[index].webSiteDeviceName}</strong>
                                    </div>
                                    <div class="equipmentSerial ms-auto text-end">
                                        <strong class="text-muted mx-1">${deviceId}</strong>
                                        <span class="text-success"><i class="fas fa-check-circle"></i></span>
                                    </div>
                                </div>
                            </div> 
                        `;
                    }
                    $('#zwaveCollapse').html( `${zwaveHTML}`);
                    $('.zwaveDeviceCount').text(`(${zwaveDeviceCount})`);
                } else {
                    $('.zwaveDeviceCount').text(`(0)`).addClass('fw-normal text-muted');
                    $('#zwaveCollapse').html('<div class="p-3 border-top">Nothing to show...</div>');
                }

                // Lift Master Device
                const liftmasterDevice = equipmentDetails.liftmaster
                const liftmasterDeviceCount = liftmasterDevice.length;
                if (liftmasterDeviceCount > 0) {
                    let liftmasterHTML = "";
                    for (let index = 0; index < liftmasterDeviceCount; index++) {
                        let deviceId = (liftmasterDevice[index].mac) ? liftmasterDevice[index].mac : liftmasterDevice[index].deviceId;
                        let deviceName = (liftmasterDevice[index].liftmasterDeviceModel) ? liftmasterDevice[index].liftmasterDeviceModel : liftmasterDevice[index].deviceName;

                        liftmasterHTML += `
                            <div class="px-3 border-top">
                                <div class="d-flex align-items-center mt-3 mb-3 gap-3">
                                    <i class="<?php echo $equipmentIcons['liftmaster']; ?> fs-4 text-muted"></i>
                                    <div class="d-flex flex-column">
                                        <small class="text-muted upperEquipmentDetail">${deviceName}</small>
                                        <strong class="text-muted">${liftmasterDevice[index].webSiteDeviceName}</strong>
                                    </div>
                                    <div class="equipmentSerial ms-auto text-end">
                                        <strong class="text-muted mx-1">${deviceId}</strong>
                                        <span class="text-success"><i class="fas fa-check-circle"></i></span>
                                    </div>
                                </div>
                            </div> 
                        `;
                    }
                    $('#liftmasterCollapse').html( `${liftmasterHTML}`);
                    $('.liftmasterDeviceCount').text(`(${liftmasterDeviceCount})`);
                } else {
                    $('.liftmasterDeviceCount').text(`(0)`).addClass('fw-normal text-muted');
                    $('#liftmasterCollapse').html('<div class="p-3 border-top">Nothing to show...</div>');
                }

                // Geo Device
                const geoDevice = equipmentDetails.geo
                const geoDeviceCount = geoDevice.length;
                if (geoDeviceCount > 0) {
                    let geoHTML = "";
                    for (let index = 0; index < geoDeviceCount; index++) {
                        let deviceId = (geoDevice[index].mac) ? geoDevice[index].mac : geoDevice[index].deviceId;
                        let deviceName = (geoDevice[index].geoDeviceModel) ? geoDevice[index].geoDeviceModel : geoDevice[index].deviceName;

                        geoHTML += `
                            <div class="px-3 border-top">
                                <div class="d-flex align-items-center mt-3 mb-3 gap-3">
                                    <i class="<?php echo $equipmentIcons['geo']; ?> fs-4 text-muted"></i>
                                    <div class="d-flex flex-column">
                                        <small class="text-muted upperEquipmentDetail">${deviceName}</small>
                                        <strong class="text-muted">${geoDevice[index].webSiteDeviceName}</strong>
                                    </div>
                                    <div class="equipmentSerial ms-auto text-end">
                                        <strong class="text-muted mx-1">${deviceId}</strong>
                                        <span class="text-success"><i class="fas fa-check-circle"></i></span>
                                    </div>
                                </div>
                            </div> 
                        `;
                    }
                    $('#geoCollapse').html( `${geoHTML}`);
                    $('.geoDeviceCount').text(`(${geoDeviceCount})`);
                } else {
                    $('.geoDeviceCount').text(`(0)`).addClass('fw-normal text-muted');
                    $('#geoCollapse').html('<div class="p-3 border-top">Nothing to show...</div>');
                }

                // Voice Device
                const voiceDevice = equipmentDetails.voice
                const voiceDeviceCount = voiceDevice.length;
                if (voiceDeviceCount > 0) {
                    let voiceHTML = "";
                    for (let index = 0; index < voiceDeviceCount; index++) {
                        voiceHTML += `
                            <div class="px-3 border-top">
                                <div class="d-flex align-items-center mt-3 mb-3 gap-3">
                                    <i class="<?php echo $equipmentIcons['voice']; ?> fs-4 text-muted"></i>
                                    <div class="d-flex flex-column">
                                        <small class="text-muted upperEquipmentDetail">${voiceDevice[index].deviceName}</small>
                                        <strong class="text-muted">${voiceDevice[index].webSiteDeviceName}</strong>
                                    </div>
                                    <div class="equipmentSerial ms-auto text-end">
                                        <strong class="text-muted mx-1">${voiceDevice[index].deviceId}</strong>
                                        <span class="text-success"><i class="fas fa-check-circle"></i></span>
                                    </div>
                                </div>
                            </div> 
                        `;
                    }
                    $('#voiceCollapse').html( `${voiceHTML}`);
                    $('.voiceDeviceCount').text(`(${voiceDeviceCount})`);
                } else {
                    $('.voiceDeviceCount').text(`(0)`).addClass('fw-normal text-muted');
                    $('#voiceCollapse').html('<div class="p-3 border-top">Nothing to show...</div>');
                }

                $('.equipmentAccordion').fadeIn('fast');
                $('.equipmentLoader').hide();
                $('.equipmentWidgetRefreshButton').removeClass('btn-secondary').addClass('btn-primary').removeAttr('disabled').html('<small>REFRESH</small>');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('.equipmentAccordion').fadeIn('fast');
                $('.equipmentLoader').hide();
                $('.equipmentWidgetRefreshButton').removeClass('btn-secondary').addClass('btn-primary').removeAttr('disabled').html('<small>REFRESH</small>');
            }
        });
    }

    $(document).ready(function () {
        getAlarmEquipmentDetails("<?php echo $alarmcom_info['customer_id']; ?>");
    });

    $(document).on('click', '.equipmentWidgetRefreshButton', function() {
        getAlarmEquipmentDetails("<?php echo $alarmcom_info['customer_id']; ?>");
    });

    $(document).on('click', '.equipmentItem', function () {
        const equipment_type = $(this).attr('equipment-type');
        if ($(this).hasClass('equipmentItemSelected')) {
            $('.equipmentAccordion').fadeIn('fast');
            $('.equipmentItem').removeClass('equipmentItemSelected');
        } else {    
            $('.equipmentAccordion').hide();

            switch (equipment_type) {
                case "notes":
                    $('.equipmentAccordion[equipment-type="notes"]').fadeIn('fast');
                    break;
                case "communication":
                    $('.equipmentAccordion[equipment-type="communication"]').fadeIn('fast');
                    break;
                case "panel":
                    $('.equipmentAccordion[equipment-type="panel"]').fadeIn('fast');
                    break;
                case "sensor":
                    $('.equipmentAccordion[equipment-type="sensor"]').fadeIn('fast');
                    break;
                case "peripheral":
                    $('.equipmentAccordion[equipment-type="peripheral"]').fadeIn('fast');
                    break;
                case "video":
                    $('.equipmentAccordion[equipment-type="video"]').fadeIn('fast');
                    break;
                case "access_point":
                    $('.equipmentAccordion[equipment-type="access_point"]').fadeIn('fast');
                    break;
                case "zwave":
                    $('.equipmentAccordion[equipment-type="zwave"]').fadeIn('fast');
                    break;
                case "liftmaster":
                    $('.equipmentAccordion[equipment-type="liftmaster"]').fadeIn('fast');
                    break;
                case "geo":
                    $('.equipmentAccordion[equipment-type="geo"]').fadeIn('fast');
                    break;
                case "voice":
                    $('.equipmentAccordion[equipment-type="voice"]').fadeIn('fast');
                    break;
            }

            $('.equipmentItem').removeClass('equipmentItemSelected');
            $(this).addClass('equipmentItemSelected');
        }
    });
    
    $('.equipmentSearchBar').on('input', function () {
        const query = $(this).val().toLowerCase();

        $('.equipmentAccordion').each(function () {
            let matchFound = false;

            $(this).find('.px-3').each(function () {
                const text = $(this).text().toLowerCase();
                if (text.includes(query)) {
                    $(this).fadeIn('fast');
                    matchFound = true;
                } else {
                    $(this).fadeOut('fast');
                }
            });

            if (matchFound) {
                $(this).fadeIn('fast');
            } else {
                $(this).fadeOut('fast');
            }
        });
    });
</script>
