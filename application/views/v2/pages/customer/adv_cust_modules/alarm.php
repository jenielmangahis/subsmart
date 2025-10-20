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
                            <label class="content-title">Account Type</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?= $alarm_info && $alarm_info->acct_type != '' ? $alarm_info->acct_type : '---'; ?>                                   
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
                            <label class="content-title">Abort Code / Password</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($alarm_info->passcode) {
                                        echo $alarm_info->passcode; 
                                    } else {
                                        echo "---";
                                    }
                                ?>
                            </span>
                        </div>  
                        <div class="col-12 col-md-6">
                            <label class="content-title">Installer Code</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?= $alarm_info && $alarm_info->install_code != '' ? $alarm_info->install_code : '---'; ?>      
                            </span>
                        </div>                         
                        <div class="col-12 col-md-6">
                            <label class="content-title">Service Package</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
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
                            <label class="content-title">Monthly Monitoring Rate</label>
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
                            <label class="content-title">Panel Type</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?= $alarm_info && $alarm_info->panel_type != '' ? $alarm_info->panel_type : '---'; ?>      
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
                            <label class="content-title">Site Type</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                ---
                            </span>
                        </div> 

                        <div class="col-12 col-md-6">
                            <label class="content-title">Secondary System Type</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                ---
                            </span>
                        </div> 

                        <div class="col-12 col-md-6">
                            <label class="content-title">Radio Serial Number</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                ---
                            </span>
                        </div> 

                        <div class="col-12 col-md-6">
                            <label class="content-title">Panel Location</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                ---
                            </span>
                        </div> 

                        <div class="col-12 col-md-6">
                            <label class="content-title">Transformer Location</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                ---
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
                        <div class="col-12 col-md-6 mt-4">
                            <label class="content-title">Dealer Number</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                               ---
                            </span>
                        </div>                                        
                        <div class="col-12 col-md-6 mt-4">
                            <label class="content-title">Service Provider</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
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
            <div class="row g-3 mt-4">
                <?php include viewPath('v2/pages/customer/adv_cust_modules/funding'); ?>    
            </div> 
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

    $('#btn-share-to-employees').on('click', function(){

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