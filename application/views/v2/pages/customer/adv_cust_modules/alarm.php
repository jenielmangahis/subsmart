<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block mb-4">
            <div class="nsm-card-title">
                <span>Alarm</span>
                <div class="form-check float-end">
                    <input class="form-check-input" type="checkbox" value="1" id="chk-show-zones">
                    <label class="form-check-label" for="chk-show-zones">
                        <b>Zones</b>
                    </label>
                </div>
            </div>
        </div>
        <div class="nsm-card-content">
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <div class="row g-2">
                        <div class="col-12 col-md-6">
                            <label class="content-title purple-label">Account Type</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle purple-label">
                                <?= $alarm_info && $alarm_info->acct_type != '' ? $alarm_info->acct_type : '---'; ?>                                   
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Dealer Number</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    $dealer_number = $default_dealer_number;
                                    if( $alarm_info && $alarm_info->dealer_number != '' ){
                                        $dealer_number = $alarm_info->dealer_number;
                                    }
                                ?>
                               <?= $dealer_number; ?>
                            </span>
                        </div> 
                        <div class="col-12 col-md-6">
                            <label class="content-title">Site Type</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    $site_type = '---';
                                    if( $defaultAlarmSiteType ){
                                        $site_type = $defaultAlarmSiteType->name;
                                    }

                                    if( $alarm_info && $alarm_info->site_type != '' ){
                                        $site_type = $alarm_info->site_type;
                                    }
                                ?>
                               <?= $site_type; ?>  
                            </span>
                        </div>      
                        <div class="col-12 col-md-6">
                            <label class="content-title">Monitoring Company</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?= $alarm_customer_info && $alarm_customer_info['dealer']['data'] ? $alarm_customer_info['dealer']['data']->dealerName : '---'; ?> 
                            </span>
                        </div>     
                        <div class="col-12 col-md-6">
                            <label class="content-title">Monitoring ID</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?= $alarm_info && $alarm_info->monitor_id != '' ? $alarm_info->monitor_id : '---'; ?>                                                                
                            </span>
                        </div>  
                        <div class="col-12 col-md-6">
                            <label class="content-title">Site Customer Type</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?= $profile_info->customer_type; ?>
                            </span>
                        </div>                                                                      
                        <div class="col-12 col-md-6">
                            <label class="content-title">Online</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?= $alarm_info && $alarm_info->online != '' ? $alarm_info->online : 'No'; ?>      
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">In Service</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?= $alarm_info && $alarm_info->in_service != '' ? $alarm_info->in_service : 'No'; ?>      
                            </span>
                        </div>  
                        <div class="col-12 col-md-6">
                            <label class="content-title">Warranty Type</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                 <?php 
                                    if ($alarm_info->warranty_type) {
                                        echo $alarm_info->warranty_type; 
                                    } else {
                                        echo "---";
                                    }
                                ?>
                            </span>
                        </div>                       
                        <div class="col-12 col-md-6">
                            <label class="content-title">Abort Code / Password</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    $passcode = '---';
                                    if( $woLatest ){
                                        $passcode = $woLatest->password;
                                    }

                                    if( $alarm_info && $alarm_info->passcode != '' ){
                                        $passcode = $alarm_info->passcode;
                                    }

                                    echo $passcode;
                                ?>
                            </span>
                        </div>  
                        <div class="col-12 col-md-6">
                            <label class="content-title">Installer Code</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    $installer_code = '---';

                                    if( $defaultInstallerCode ){
                                        $installer_code = $defaultInstallerCode->installer_code;
                                    }

                                    if( $alarm_info && $alarm_info->install_code != '' ){
                                        $installer_code = $alarm_info->install_code;
                                    }
                                    
                                ?>
                                <?= $installer_code; ?>      
                            </span>
                        </div>   
                        <div class="col-12 col-md-12">
                            <label class="content-title"></label>
                        </div>                      
                        <div class="col-12 col-md-12">
                            <label class="content-title"></label>
                        </div>                      
                        <div class="col-12 col-md-6">
                            <label class="content-title purple-label">Service Package</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle purple-label">
                                <?= $alarm_info && $alarm_info->comm_type != '' ? $alarm_info->comm_type : '---'; ?>      
                            </span>
                        </div>   
                        
                        <div class="col-12 col-md-6">
                            <label class="content-title">Account Cost</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($alarm_info->account_cost) {
                                        echo "$".$alarm_info->account_cost; 
                                    } else {
                                        echo "---";
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Pass Thru Cost</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?= $alarm_info && $alarm_info->pass_thru_cost > 0 ? $alarm_info->pass_thru_cost : '0'; ?>   
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Program and Setup</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?= $alarm_info && $alarm_info->otps > 0 ? $alarm_info->otps : '0'; ?>   
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Equipment Cost</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?= $alarm_info && $alarm_info->equipment_cost > 0 ? $alarm_info->equipment_cost : '0'; ?>   
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Gross Monitoring Rate</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?= $alarm_info && $alarm_info->monthly_monitoring > 0 ? $alarm_info->monthly_monitoring : '0'; ?>   
                            </span>
                        </div> 
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="row g-2">
                        <div class="col-12 col-md-6">
                            <label class="content-title purple-label">Panel Type</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle purple-label">
                                <?= $alarm_info && $alarm_info->panel_type != '' ? $alarm_info->panel_type : '---'; ?>      
                            </span>
                        </div>                                     
                        <div class="col-12 col-md-6">
                            <label class="content-title">Secondary System Type</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    $secondary_system_type = 'GSM';
                                    if( $alarm_info && $alarm_info->secondary_system_type != '' ){
                                        $secondary_system_type = $alarm_info->secondary_system_type;
                                    }
                                ?>
                                <?= $secondary_system_type; ?>    
                            </span>
                        </div> 

                        <div class="col-12 col-md-6">
                            <label class="content-title">Radio Serial Number</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?= $alarm_info && $alarm_info->radio_serial_number != '' ? $alarm_info->radio_serial_number : '---'; ?>    
                            </span>
                        </div> 

                        <div class="col-12 col-md-6">
                            <label class="content-title">Panel Location</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?= $alarm_info && $alarm_info->panel_location != '' ? $alarm_info->panel_location : '---'; ?>    
                            </span>
                        </div> 

                        <div class="col-12 col-md-6">
                            <label class="content-title">Transformer Location</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?= $alarm_info && $alarm_info->transformer_location != '' ? $alarm_info->transformer_location : '---'; ?>    
                            </span>
                        </div> 

                        <div class="col-12 col-md-6">
                            <label class="content-title">Dealer Number</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?= $alarm_info && $alarm_info->dealer_number != '' ? $alarm_info->dealer_number : '---'; ?>    
                            </span>
                        </div> 
                        <div class="col-12 col-md-12"></div>                                                                     

                        <div class="col-12 col-md-6">
                            <label class="content-title purple-label">Install Type</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle purple-label">
                                <?= $alarm_info && $alarm_info->install_type != '' ? $alarm_info->install_type : '---'; ?>    
                            </span>
                        </div> 

                        <div class="col-12 col-md-6">
                            <label class="content-title">DSL Voip</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?= $alarm_info && $alarm_info->dsl_voip != '' ? $alarm_info->dsl_voip : '---'; ?>    
                            </span>
                        </div> 

                        <div class="col-12 col-md-6">
                            <label class="content-title">Contract Status</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?= $alarm_info && $alarm_info->contract_status != '' ? $alarm_info->contract_status : '---'; ?>    
                            </span>
                        </div> 

                        <div class="col-12 col-md-6">
                            <label class="content-title">CSID Number</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?= $alarm_info && $alarm_info->csid_number != '' ? $alarm_info->csid_number : '---'; ?>    
                            </span>
                        </div> 

                        <div class="col-12 col-md-6">
                            <label class="content-title">Panel Phone Number</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?= $alarm_info && $alarm_info->panel_phone_number != '' ? $alarm_info->panel_phone_number : '---'; ?>    
                            </span>
                        </div> 

                        <div class="col-12 col-md-6">
                            <label class="content-title">Connection Type</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                  $connection_type = '---';
                                  if( $alarm_info ){
                                    $connection_type = 'Wireless';
                                    if( $alarm_info->connection_type != ''){
                                        $connection_type = $alarm_info->connection_type;
                                    } 
                                  }

                                ?>
                                <?= $connection_type; ?>    
                            </span>
                        </div> 

                        <div class="col-12 col-md-6">
                            <label class="content-title">Report Format</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?= $alarm_info && $alarm_info->report_format != '' ? $alarm_info->report_format : '---'; ?>    
                            </span>
                        </div>
                        
                        <div class="col-12 col-md-6">
                            <label class="content-title">Receiver Phone Number</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?= $alarm_info && $alarm_info->receiver_phone_number != '' ? $alarm_info->receiver_phone_number : '---'; ?>    
                            </span>
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="content-title">Master Code</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?= $alarm_info && $alarm_info->master_code != '' ? $alarm_info->master_code : '---'; ?>    
                            </span>
                        </div>

                        <?php if( $alarm_customer_info ){ ?>
                            <div class="col-12 col-md-6">
                                <label class="content-title">ID</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <span class="content-subtitle">
                                    <?= $alarm_customer_info && $alarm_customer_info['customer'] ? $alarm_customer_info['customer']->customerId : '---'; ?>
                                </span>
                            </div>   
                        <?php } ?>            
                        <div class="col-12 col-md-12"></div>                                             
                        <div class="col-12 col-md-12"></div>
                        <div class="col-12 col-md-6">
                            <label class="content-title purple-label">Service Provider</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle purple-label">
                                <?= $alarm_info && $alarm_info->dealer != '' ? trim($alarm_info->dealer) : '---'; ?>   
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Customer ID</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?= $alarm_info && $alarm_info->alarm_customer_id != '' ? $alarm_info->alarm_customer_id : '---'; ?>   
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Login</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?= $alarm_info && $alarm_info->alarm_login != '' ? $alarm_info->alarm_login : '---'; ?>   
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="alarm-zones-container"></div>  
            <div id="emergency-agencies-container"></div>   
            <?php if( $alarm_info && $alarm_info->acct_type != 'In-House' ){ ?>
                <?php include viewPath('v2/pages/customer/adv_cust_modules/funding'); ?>    
            <?php } ?>
            <?php if( $alarm_customer_info ){ ?>
                <?php if( $alarm_customer_info['equipments']['data'] ){ ?>
                    <div class="row g-3">
                    <div class="col-12 col-md-12"><hr /></div>
                        <?php foreach($alarm_customer_info['equipments']['data'] as $eq){ ?>
                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <div class="col-12 col-md-6"><label class="content-title">Device Name</label></div>
                                    <div class="col-12 col-md-6"><span class="content-subtitle"><?= $eq->webSiteDeviceName; ?></div>                                
                                    <div class="col-12 col-md-6"><label class="content-title">Install Date</label></div>
                                    <div class="col-12 col-md-6"><span class="content-subtitle"><?= date("m/d/Y H:i:s", strtotime($eq->installDate)); ?></span></div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?> 

                <div class="row g-3 mt-2">
                    <div class="col-12 col-md-6">
                        <!-- <button role="button" class="nsm-button w-100 ms-0 mt-3">
                            <i class='bx bx-fw bx-user-pin'></i> Account On Test
                        </button> -->                    
                        <button role="button" class="nsm-button w-100 ms-0 mt-3 btn-alarm-api-view-customer" data-id="<?= $alarm_customer_info['customer']->customerId; ?>">
                            <i class='bx bx-fw bx-user-pin'></i> View Alarm Customer Information
                        </button>                    
                    </div>
                    <div class="col-12 col-md-6">
                        <button role="button" class="nsm-button w-100 ms-0 mt-3 btn-alarm-api-system-check" data-id="<?= $alarm_customer_info['customer']->customerId; ?>">
                            <i class='bx bx-fw bx-cog'></i> System Check
                        </button>                    
                    </div>
                </div>
            <?php } ?>
            
            <div class="row g-3 mt-4">
                <div class="col-12 col-md-8"></div>
                <div class="col-12 col-md-4">
                    <button type="button" id="btn-share-to-employees" class="nsm-button primary w-100 ms-0 mt-2"><i class='bx bx-share' ></i> Share to Employees</button>
                </div> 
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-alarm-share-employee" tabindex="-1" aria-labelledby="modal-alarm-share-employee-modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Share Alarm Information to Employees</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <form id="frm-alarm-share-to-employees" method="POST">
                    <div class="row g-3">
                        <div class="col-md-12 form-group">
                            <label for="ticket-appointment-user" class="block-label"><b>Share to</b></label>
                            <select class="form-control nsm-field form-select" name="users[]" id="alarm-share-to-users" multiple="multiple" required>
                            </select>
                        </div>  
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="nsm-button primary" id="update-appointment-btn" form="frm-alarm-share-to-employees">Send</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-view-alarm-customer-info" data-source="" tabindex="-1" aria-labelledby="modal-quick-view-upcoming-schedule-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">View Customer</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="alarm-customer-info-container"></div>                                    
        </div>        
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-view-alarm-customer-system-check" data-source="" tabindex="-1" aria-labelledby="modal-quick-view-upcoming-schedule-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">System Check</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="alarm-customer-system-check-container"></div>                                    
        </div>        
    </div>
</div>

<script>
$(function(){
    
    load_customer_emergency_agencies();

    $('.btn-alarm-api-view-customer').on('click', function(){
        var customer_id = $(this).attr('data-id');
        
        $('#modal-view-alarm-customer-info').modal('show');
        showLoader($("#alarm-customer-info-container")); 

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: base_url + 'alarm_api/_view_customer',
             data: {customer_id:customer_id},
             success: function(o)
             {          
                $("#alarm-customer-info-container").html(o);
             }
          });
        }, 500);
    });

    $('#btn-share-to-employees').on('click', function(){
        $('#modal-alarm-share-employee').modal('show');
    });

    $('#chk-show-zones').on('change', function(){
        if( $(this).is(':checked') ){
            load_customer_zones();
        }else{
            $('#alarm-zones-container').html('');
        }
        
    });

    function load_customer_zones(){
        let url = base_url + 'customer/_alarm_customer_zones'  
        let customer_id = "<?= $customer_id; ?>";
        $.ajax({
            type: "POST",
            url: url,
            data: {customer_id:customer_id},
            success: function(o)
            {	
                $('#alarm-zones-container').html(o);
            },
            beforeSend:function(){
                $('#alarm-zones-container').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    }

    function load_customer_emergency_agencies(){
        let url = base_url + 'customer/_customer_emergency_agencies'  
        let customer_id = "<?= $customer_id; ?>";
        $.ajax({
            type: "POST",
            url: url,
            data: {customer_id:customer_id},
            success: function(o)
            {	
                $('#emergency-agencies-container').html(o);
            },
            beforeSend:function(){
                $('#emergency-agencies-container').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    }

    $('#alarm-share-to-users').select2({
        ajax: {
            url: base_url + 'autocomplete/_company_users',
            dataType: 'json',
            delay: 250,                
            data: function(params) {
                return {
                    q: params.term,
                    page: params.page
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;

                return {
                    results: data,
                };
            },
            /*formatResult: function(item) {
                return '<div>' + item.FName + ' ' + item.LName + '<br />test<small>' + item.email + '</small></div>';
            },*/
            cache: true
        },
        dropdownParent: $("#modal-alarm-share-employee"),
        placeholder: 'Select Users',
        minimumInputLength: 0,
        templateResult: formatRepoUser,
        templateSelection: formatRepoSelectionUser
    });

    function formatRepoUser(repo) {
        if (repo.loading) {
            return repo.text;
        }

        // var $container = $(
        //     '<div><div class="autocomplete-left"><img class="autocomplete-img" src="' + repo.user_image + '" /></div><div class="autocomplete-right">' + repo.FName + ' ' + repo.LName + '<br /><small>' + repo.email + '</small></div></div>'
        // );
        var $container = $(
            '<div>' + repo.FName + ' ' + repo.LName + '<br /><small>' + repo.email + '</small></div></div>'
        );

        return $container;
    }

    function formatRepoSelectionUser(repo) {
        return (repo.FName) ? repo.FName + ' ' + repo.LName : repo.text;
    }

    $('#frm-alarm-share-to-employees').on('submit', function(e){
        e.preventDefault();
    });

    $('.btn-alarm-api-system-check').on('click', function(){
        var customer_id = $(this).attr('data-id');
        
        $('#modal-view-alarm-customer-system-check').modal('show');
        showLoader($("#alarm-customer-system-check-container")); 

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: base_url + 'alarm_api/_customer_system_check',
             data: {customer_id:customer_id},
             success: function(o)
             {          
                $("#alarm-customer-system-check-container").html(o);
             }
          });
        }, 500);
    });

    $(document).on('submit', '#frm-save-zones', function(e){
        e.preventDefault();

        $.ajax({
            url: base_url + 'customer/_create_alarm_zones',
            type: "POST",
            dataType: "json",
            data: $('#frm-save-zones').serialize(),
            success: function(data) {
                $("#modal-create-zone").modal('hide');
                $('#btn-save-zones').html('Save');

                if (data.is_success == 1) {                  
                    load_customer_zones();
                } else {
                    Swal.fire({
                        showConfirmButton: false,
                        timer: 2000,
                        title: 'Failed',
                        text: data.msg,
                        icon: 'warning'
                    });
                }
            },
            beforeSend: function() {
                $('#btn-save-zones').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $(document).on('submit', '#frm-update-zones', function(e){
        e.preventDefault();

        $.ajax({
            url: base_url + 'customer/_update_alarm_zones',
            type: "POST",
            dataType: "json",
            data: $('#frm-update-zones').serialize(),
            success: function(data) {
                $("#modal-edit-zone").modal('hide');
                $('#btn-update-zones').html('Save');

                if (data.is_success == 1) {                  
                    load_customer_zones();
                } else {
                    Swal.fire({
                        showConfirmButton: false,
                        timer: 2000,
                        title: 'Failed',
                        text: data.msg,
                        icon: 'warning'
                    });
                }
            },
            beforeSend: function() {
                $('#btn-update-zones').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $(document).on("click", ".delete-zone-item", function() {
        let id = $(this).attr('data-id');
        let value = $(this).attr('data-value');

        Swal.fire({
            title: 'Delete Zone',
            html: `Are you sure you want to zone id <b>${value}</b>?<br/><br/>Note : This cannot be undone.`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + "customer/_delete_alarm_zone",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(result) {
                        Swal.close();
                        if (result.is_success) {
                            load_customer_zones();
                        } else {
                            Swal.fire({
                                title: 'Failed',
                                text: result.msg,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            });
                        }
                    },
                    beforeSend: function(){
                        Swal.fire({
                            icon: "info",
                            title: "Processing",
                            html: "Please wait while the process is running...",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                        });
                    }
                });
            }
        });
    });

    $(document).on('click', '#with-selected-delete-zones', function(){
        let total= $('#tbl-alarm-zones input[name="alarmZones[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Delete Zones',
                html: `Are you sure you want to delete selected rows?<br/><br/>Note : This cannot be undone.`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'customer/_delete_selected_zones',
                        dataType: 'json',
                        data: $('#frm-with-selected').serialize(),
                        success: function(result) {          
                            Swal.close();              
                            if( result.is_success == 1 ) {
                                load_customer_zones();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: result.msg,
                                });
                            }
                        },
                        beforeSend: function(){
                            Swal.fire({
                                icon: "info",
                                title: "Processing",
                                html: "Please wait while the process is running...",
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                showConfirmButton: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                },
                            });
                        }
                    });

                }
            });
        }        
    });

    $(document).on('submit', '#frm-save-emergency-agencies', function(e){
        e.preventDefault();

        $.ajax({
            url: base_url + 'customer/_create_emergency_agencies',
            type: "POST",
            dataType: "json",
            data: $('#frm-save-emergency-agencies').serialize(),
            success: function(data) {
                $("#modal-create-emergency-agencies").modal('hide');
                $('#btn-save-emergency-agencies').html('Save');

                if (data.is_success == 1) {                  
                    load_customer_emergency_agencies();
                } else {
                    Swal.fire({
                        showConfirmButton: false,
                        timer: 2000,
                        title: 'Failed',
                        text: data.msg,
                        icon: 'warning'
                    });
                }
            },
            beforeSend: function() {
                $('#btn-save-emergency-agencies').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $(document).on('submit', '#frm-update-emergency-agency', function(e){
        e.preventDefault();

        $.ajax({
            url: base_url + 'customer/_update_emergency_agency',
            type: "POST",
            dataType: "json",
            data: $('#frm-update-emergency-agency').serialize(),
            success: function(data) {
                $("#modal-edit-emergency-agency").modal('hide');
                $('#btn-update-emergency-agency').html('Save');

                if (data.is_success == 1) {                  
                    load_customer_emergency_agencies();
                } else {
                    Swal.fire({
                        showConfirmButton: false,
                        timer: 2000,
                        title: 'Failed',
                        text: data.msg,
                        icon: 'warning'
                    });
                }
            },
            beforeSend: function() {
                $('#btn-update-emergency-agency').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $(document).on("click", ".delete-emergency-agency-item", function() {
        let id = $(this).attr('data-id');
        let value = $(this).attr('data-value');

        Swal.fire({
            title: 'Delete Emergency Agency',
            html: `Are you sure you want to agency <b>${value}</b>?<br/><br/>Note : This cannot be undone.`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + "customer/_delete_emergency_agency",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(result) {
                        Swal.close();
                        if (result.is_success) {
                            load_customer_emergency_agencies();
                        } else {
                            Swal.fire({
                                title: 'Failed',
                                text: result.msg,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            });
                        }
                    },
                    beforeSend: function(){
                        Swal.fire({
                            icon: "info",
                            title: "Processing",
                            html: "Please wait while the process is running...",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                        });
                    }
                });
            }
        });
    });

    $(document).on('click', '#with-selected-delete-amergency-agencies', function(){
        let total= $('#tbl-emergency-agencies input[name="emergencyAgencies[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Delete Emergency Agency',
                html: `Are you sure you want to delete selected rows?<br/><br/>Note : This cannot be undone.`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'customer/_delete_selected_emergency_agencies',
                        dataType: 'json',
                        data: $('#frm-with-selected').serialize(),
                        success: function(result) {          
                            Swal.close();              
                            if( result.is_success == 1 ) {
                                load_customer_emergency_agencies();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: result.msg,
                                });
                            }
                        },
                        beforeSend: function(){
                            Swal.fire({
                                icon: "info",
                                title: "Processing",
                                html: "Please wait while the process is running...",
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                showConfirmButton: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                },
                            });
                        }
                    });

                }
            });
        }        
    });
});

function openNewWindow() {
  window.open("https://nsmartrac.com/", "_blank", "location=yes,height=1080,width=1500,scrollbars=yes,status=yes");
}
</script>