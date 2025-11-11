<style>
.badge-primary{
    background-color: #007bff;
}
.badge{
    display: inline-block;
    padding: 0.25em 0.4em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.25rem;
    margin-top: 9px;
}
</style>
<div class="nsm-card primary">
    <div class="nsm-card-content">
        <div class="row mb-3">
            <div class="col-12">
                <div class="nsm-card-title">
                    <?php if($companyId == 58): ?>
                        <span><i class="bx bx-fw bx-user"></i>Solar Information</span>
                        <?php if( $profile_info->adt_sales_project_id > 0 ){ ?>
                            <span class="badge badge-primary" style="font-size:13px; float: right;">ADT Sales Portal Project Data</span>
                        <?php } ?>
                    <?php else: ?>
                        <span><i class="bx bx-fw bx-user"></i>Alarm Information</span>
                    <?php endif; ?>  
                    <hr />
                </div>
            </div>
        </div>
        <div class="row g-1 mb-5">
            <?php if($companyId == 58): ?>
                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Project ID" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->project_id ? $solar_info->project_id : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Lender Type" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->lender_type ? $solar_info->lender_type : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Proposed System Size" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->proposed_system_size ? $solar_info->proposed_system_size : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Proposed Modules" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->proposed_modules ? $solar_info->proposed_modules : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Proposed Inverter" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->proposed_inverter ? $solar_info->proposed_inverter : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Proposed Offset" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->proposed_offset ? $solar_info->proposed_offset : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Proposed Solar $" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->proposed_solar ? $solar_info->proposed_solar : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Proposed Utility $" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->proposed_utility ? $solar_info->proposed_utility : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Proposed Payment $" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->proposed_payment ? $solar_info->proposed_payment : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Annual Income" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->annual_income ? $solar_info->annual_income : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Tree Estimate" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->tree_estimate ? $solar_info->tree_estimate : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Roof Estimate" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->roof_estimate ? $solar_info->roof_estimate : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Utility Account #" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->utility_account ? $solar_info->utility_account : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Utility Login" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->utility_login ? $solar_info->utility_login : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Utility Password" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->utility_pass ? $solar_info->utility_pass : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Meter Number" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->meter_number ? $solar_info->meter_number : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Insurance Name" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->insurance_name ? $solar_info->insurance_name : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Insurance Number" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->insurance_number ? $solar_info->insurance_number : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Policy Number" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->policy_number ? $solar_info->policy_number : '---'  ?></label>
                    </div>
                </div>

                <div class="col-12">
                    <hr>
                </div>
            <?php else: ?>
                <div class="row p-0">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">Dealer Number</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->dealer_number) ? $alarm_info->dealer_number : '---'; ?></label>
                    </div>
                </div>  
                <div class="row p-0">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Monitoring Company" form="alarm_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->monitor_comp) ? $alarm_info->monitor_comp : '---'; ?></label>
                    </div>
                </div>
                <div class="row p-0">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">Contract Status</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->contract_status) ? $alarm_info->contract_status : '---'; ?></label>
                    </div>
                </div>
                <div class="row p-0">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Monitoring ID" form="alarm_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->monitor_id) ? $alarm_info->monitor_id : '---'; ?></label>
                    </div>
                </div>
                <div class="row p-0">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Account Type" form="alarm_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->acct_type) ? $alarm_info->acct_type : '---'; ?></label>
                    </div>
                </div>
                <div class="row p-0">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Site Type" form="alarm_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->site_type) ? $alarm_info->site_type : '---'; ?></label>
                    </div>
                </div>
                <div class="row p-0">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Online" form="alarm_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->online) ? $alarm_info->online : '---'; ?></label>
                    </div>
                </div>
                <div class="row p-0">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="In Service" form="alarm_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->in_service) ? $alarm_info->in_service : '---'; ?></label>
                    </div>
                </div>
                <div class="row p-0">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Abort/Password Code" form="alarm_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->passcode) ? $alarm_info->passcode : '---'; ?></label>
                    </div>
                </div>
                <div class="row p-0">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Installer Code" form="alarm_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <?php 
                            $install_code = '1423';
                            if( $alarm_info && $alarm_info->install_code != '' ){
                               $install_code =  $alarm_info->install_code;
                            }  
                        ?>
                        <label class="content-subtitle"><?= $install_code; ?></label>
                    </div>
                </div>
                <div class="row p-0">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">Master Code</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->master_code) ? $alarm_info->master_code : '---'; ?></label>
                    </div>                
                    <div class="col-12"><hr></div>
                </div>
                <div class="row p-0">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Equipment" form="alarm_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->equipment) ? $alarm_info->equipment : '---'; ?></label>
                    </div>
                </div>
                <div class="row p-0">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">Install Type</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->install_type) ? $alarm_info->install_type : '---'; ?></label>
                    </div>
                </div>
                <div class="row p-0">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Panel Type" form="alarm_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->panel_type) ? $alarm_info->panel_type : '---'; ?></label>
                    </div>
                </div>
                <div class="row p-0">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Warranty Type" form="alarm_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->warranty_type) ? $alarm_info->warranty_type : '---'; ?></label>
                    </div>
                </div>
                <div class="row p-0">           
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">Secondary System Type</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <?php 
                            $secondary_system_type = 'GSM';
                            if( $alarm_info && $alarm_info->secondary_system_type != '' ){
                                $secondary_system_type = $alarm_info->secondary_system_type;
                            }
                        ?>
                        <label class="content-subtitle"><?= $secondary_system_type; ?></label>
                    </div>
                </div>
                <div class="row p-0">    
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">Radio Serial Number</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->radio_serial_number) ? $alarm_info->radio_serial_number : '---'; ?></label>
                    </div>
                </div>
                <div class="row p-0">    
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">Panel Location</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->panel_location) ? $alarm_info->panel_location : '---'; ?></label>
                    </div>
                </div>
                <div class="row p-0">    
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">Transformer Location</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->transformer_location) ? $alarm_info->transformer_location : '---'; ?></label>
                    </div>
                </div>
                <div class="row p-0">    
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">Connection Type</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <?php 
                            $connection_type = '---';
                            if( $alarm_info ){
                            $connection_type = 'Wireless';
                            if( $alarm_info->connection_type != ''){
                                $connection_type = $alarm_info->connection_type;
                            } 
                            }

                        ?>
                        <label class="content-subtitle"><?= $connection_type; ?></label>
                    </div>
                </div>
                <div class="row p-0">    
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">CSID Number</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->csid_number) ? $alarm_info->csid_number : '---'; ?></label>
                    </div>
                </div>
                <div class="row p-0"> 
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">Report Format</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->report_format) ? $alarm_info->report_format : '---'; ?></label>
                    </div>
                </div>
                <div class="row p-0"> 
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">Receiver Phone Number</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->receiver_phone_number) ? $alarm_info->receiver_phone_number : '---'; ?></label>
                    </div>
                </div>
                <div class="row p-0"> 
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">Panel Phone Number</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->panel_phone_number) ? $alarm_info->panel_phone_number : '---'; ?></label>
                    </div>
                </div>
                <div class="row p-0"> 
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">DSL Voip</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->dsl_voip) ? $alarm_info->dsl_voip : '---'; ?></label>
                    </div>
                    <div class="col-12"><hr></div>
                </div>
                
                <div class="row p-0"> 
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">Service Provider</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->service_provider) ? $alarm_info->service_provider : '---'; ?></label>
                    </div>
                </div>

                <div class="row p-0"> 
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">System Package Type</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->comm_type) ? $alarm_info->comm_type : '---'; ?></label>
                    </div>
                </div>

                <div class="row p-0"> 
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">Add-on Feature Cost</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->addon_feature_cost) ? $alarm_info->addon_feature_cost : '---'; ?></label>
                    </div>
                </div>
                <div class="row p-0"> 
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">Account Cost</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle">$<?= !empty($alarm_info->account_cost) ? $alarm_info->account_cost : '0.00'; ?></label>
                    </div>
                </div>
                <div class="row p-0"> 
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">Pass Thru Cost</label>
                    </div>
                    <div class="col-12 col-md-6">
                    <?php 
                        $passThruCost = ($alarmcom_info['package_total_price'] != "") ? $alarmcom_info['package_total_price'] : $alarm_info->pass_thru_cost;
                        $passThruCostFormatted = '$' . number_format((float)$passThruCost, 2);
                    ?>
                        <label class="content-subtitle"><?php echo $passThruCostFormatted; ?></label>
                    </div>
                </div>
                <div class="row p-0"> 
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">Program and Setup</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->otps) ? $alarm_info->otps : '---'; ?></label>
                    </div>
                </div>
                <div class="row p-0"> 
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">Equipment Cost</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->equipment_cost) ? $alarm_info->equipment_cost : '---'; ?></label>
                    </div>
                </div>
                <div class="row p-0"> 
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">Gross Monitoring Rate</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->monthly_monitoring) ? $alarm_info->monthly_monitoring : '---'; ?></label>
                    </div>
                    <div class="col-12"><hr></div>
                </div>
                
                <div class="row p-0"> 
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">CSID Number</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->csid_number) ? $alarm_info->csid_number : '---'; ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Dealer" form="alarm_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->dealer) ? $alarm_info->dealer : '---'; ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Customer ID" form="alarm_info"></field-custom-name>
                        </label>
                    </div>
                    <?php 
                        $alarmcom_customer_id = ($alarmcom_info['customer_id'] != "") ? $alarmcom_info['customer_id'] : $alarm_info->alarm_customer_id;
                    ?>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $alarmcom_customer_id; ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Login" form="alarm_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <?php 
                            $alarm_login = $default_login_value;
                            if( isset($alarm_info) && $alarm_info->alarm_login != '' ){
                                $alarm_login = $alarm_info->alarm_login;
                            }
                        ?>
                        <label class="content-subtitle"><?= $alarm_login; ?></label>
                    </div>
                </div>
            <?php endif; ?> 
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <div class="nsm-card-title">
                    <span><i class="bx bx-fw bx-cog"></i>Access Information</span>
                    <hr />
                </div>
            </div>
        </div>
        <div class="row g-1 mb-5">
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Portal Status (on/off)</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">
                    <?php
                    if ($access_info->portal_status == 1) {
                        echo 'On';
                    } else {
                        echo 'Off';
                    }
                    ?>
                </label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Login</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($access_info->access_login) ?  $access_info->access_login : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Password</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($access_info->access_password) ?  $access_info->access_password : '---' ?></label>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <div class="nsm-card-title">
                    <span><i class="bx bx-fw bx-customize"></i>Custom Fields</span>
                    <hr />
                </div>
            </div>
        </div>
        <div class="row g-1 mb-5">
            <?php
                $fields = [];
                if (!empty($profile_info->custom_fields)) {
                    $fields = json_decode($profile_info->custom_fields, true);
                    $fields = is_array($fields) ? $fields : [];
                }
            ?>
            <?php if (!empty($fields) && is_array($fields)): ?>
                <?php foreach ($fields as $key => $field): ?>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold"><?=$field['name'];?></label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?=$field['value'];?></label>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 col-md-12">
                    <label class="content-subtitle">No custom field found.</label>
                </div>
            <?php endif; ?>
        </div>        
        <div class="row mb-3">
            <div class="col-12">
                <div class="nsm-card-title">
                    <span><i class="bx bx-fw bx-log-in"></i>Customer Portal</span>
                    <hr />
                </div>
            </div>
        </div>
        <div class="row g-1 mb-5">
            <div class="col-12 mt-3">
                <?php 
                    $customer_id = $this->uri->segment(3);
                    $customer_unique_id = hashids_encrypt($customer_id, '', 45);
                    $public_url = base_url('/client_hub/' . $customer_unique_id . "?source=share");
                ?>
                <label class="visually-hidden" for="customer-public-url">Username</label>
                <div class="input-group">
                <div class="input-group-text"><i class='bx bxs-user-rectangle'></i></div>
                    <input type="text" class="form-control customer-public-url" id="customer-public-url" placeholder="Customer Hub" disabled value="<?php echo $public_url; ?>" >                        
                </div>
                <button class="nsm-button primary w-40 ms-0 copy-customer-public-url mt-2" id="copy-customer-public-url" onClick="javascript:copyCustomerPublicUrl();" style="background-color: #6a4a86; color: #ffffff;"><i class='bx bx-copy-alt'></i> Copy to clipboard</button>  
            </div>   
        </div>
    </div>
</div>

<script>
$(function(){
    $(document).on('click', '.copy-customer-public-url', function(){
        const copyUrl = $("#customer-public-url").val();
        navigator.clipboard.writeText(copyUrl).then(() => {
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "URL Copied to clipboard",
                showConfirmButton: false,
                timer: 1000
            });
        }).catch(() => {
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Cannot copy url",
                showConfirmButton: false,
                timer: 1000
            });
        })
    });
});
</script>
