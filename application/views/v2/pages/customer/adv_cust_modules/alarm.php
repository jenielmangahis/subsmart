<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Alarm</span>
            </div>
        </div>
        <div class="nsm-card-content">
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <div class="row g-2">
                        <div class="col-12 col-md-6">
                            <label class="content-title">Monitoring Company</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?= $alarm_customer_info && $alarm_customer_info['dealer']['data'] ? $alarm_customer_info['dealer']['data']->dealerName : '---'; ?>                                
                                <?php 
                                    // if ($alarm_info->monitor_comp) {
                                    //     echo $alarm_info->monitor_comp; 
                                    // } else {
                                    //     echo "&mdash;";
                                    // }
                                ?>
                            </span>
                        </div>                        
                        <div class="col-12 col-md-6">
                            <label class="content-title">Account Type</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($alarm_info->acct_type) {
                                        echo $alarm_info->acct_type; 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Password</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($alarm_info->passcode) {
                                        echo $alarm_info->passcode; 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
                            </span>
                        </div>
                        
                        <div class="col-12 col-md-6">
                            <label class="content-title">Mon. Waived</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($office_info->monitoring_waived) {
                                        echo $office_info->monitoring_waived; 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">RebateCheck1</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($office_info->rebate_check1) {
                                        echo $office_info->rebate_check1; 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
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
                                        echo "&mdash;";
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Monitoring Confirmation Number</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($alarm_info->mcn) {
                                        echo $alarm_info->mcn; 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
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
                            <label class="content-title">ID</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?= $alarm_customer_info && $alarm_customer_info['customer'] ? $alarm_customer_info['customer']->customerId : '---'; ?>
                                <?php 
                                    // if ($alarm_info->monitor_id) {
                                    //     echo $alarm_info->monitor_id; 
                                    // } else {
                                    //     echo "&mdash;";
                                    // }
                                ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Credit Score</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($office_info->credit_score) {
                                        echo $office_info->credit_score; 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Account Info</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($alarm_info->alarm_cs_account) {
                                        echo $alarm_info->alarm_cs_account; 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Installer Code</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($alarm_info->install_code) {
                                        echo $alarm_info->install_code; 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">System Type</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($alarm_info->system_type) {
                                        echo $alarm_info->system_type; 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Rebate Offer</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($office_info->rebate_offer) {
                                        echo $office_info->rebate_offer; 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Verification</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($office_info->verification) {
                                        echo $office_info->verification; 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">RebateCheck2</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($office_info->rebate_check2) {
                                        echo $office_info->rebate_check2; 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Signal Confirmation Number</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($alarm_info->scn) {
                                        echo $alarm_info->scn; 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Pass Thru Cost</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($alarm_info->pass_thru_cost) {
                                        echo "$".$alarm_info->pass_thru_cost; 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>            
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
                <?php if( $alarm_customer_info ){ ?>
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
                <?php } ?>
                <!-- <div class="col-12 col-md-4">
                        <button role="button" class="nsm-button w-100 ms-0 mt-3" onclick="openNewWindow()">
                            <i class='bx bx-fw bx-link-external'></i> Website Url
                        </button>
                </div>
                <div class="col-12 col-md-4">
                    <button role="button" class="nsm-button primary w-100 ms-0 mt-3">
                        <i class='bx bx-fw bx-spreadsheet'></i> Record Sheet
                    </button>
                </div> -->
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
});

function openNewWindow() {
  window.open("https://nsmartrac.com/", "_blank", "location=yes,height=1080,width=1500,scrollbars=yes,status=yes");
}
</script>