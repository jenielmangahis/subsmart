<div class="nsm-card primary">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><i class='bx bx-fw bx-credit-card'></i>Billing Information</span>
            <?php 
                $recurring_end_date = date("Y-m-d");
                $current_date = date("Y-m-d");
                if( strtotime($billing_info->recurring_end_date) > 0 ){
                    $recurring_end_date = date("Y-m-d", strtotime($billing_info->recurring_end_date));
                }

                $is_recurring_active = '';
                if( $recurring_end_date > $current_date ){ 
                    $is_recurring_active = 'checked';
                }
            ?>
            <div class="form-check form-switch float-end">
                <input class="form-check-input" type="checkbox" role="switch" id="chkRecurringActive" <?= $is_recurring_active; ?> readonly>
                <label class="form-check-label" for="chkRecurringActive">Recurring Subscription</label>
            </div>
        </div>
    </div>
    <div class="nsm-card-content"><hr>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'billing-information', 'card_fname') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'billing-information', 'card_fname'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="card_fname" id="card_fname" value="<?= isset($billing_info) && !empty($billing_info->card_fname) ? $billing_info->card_fname : $profile_info->first_name;  ?>" />
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'billing-information', 'card_lname') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'billing-information', 'card_lname'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="card_lname" id="card_lname" value="<?= isset($billing_info) && !empty($billing_info->card_lname) ? $billing_info->card_lname : $profile_info->last_name ?>"/>
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'billing-information', 'card_address') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6">
                <label for="use_customer_address"><span>Use Customer Address</span>
            </label></div>
            <div class="col-md-6">
                <input type="checkbox" name="use_customer_address" class="form-controls" id="use_customer_address">
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'billing-information', 'card_address') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'billing-information', 'card_address'); ?></div>
            <div class="col-md-6">
                <input data-type="billing_address" type="text" class="form-control" name="card_address" id="card_address" value="<?php if(isset($billing_info)){ echo $billing_info->card_address; } ?>"/>
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'billing-information', 'billing_city') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'billing-information', 'billing_city'); ?></div>

            <div class="col-md-6">
                <input data-type="billing_address_city" type="text" class="form-control" name="billing_city" id="billing_city" value="<?php if(isset($billing_info)){ echo $billing_info->city != null ? $billing_info->city : $profile_info->city; } ?>" />
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'billing-information', 'billing_state') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'billing-information', 'billing_state'); ?></div>
            <div class="col-md-6">
                <input data-type="billing_address_state" type="text" class="form-control" name="billing_state" id="billing_state" value="<?php if(isset($billing_info)){ echo $billing_info->state != null ? $billing_info->state : $profile_info->state; } ?>"/>
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'billing-information', 'billing_zip') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'billing-information', 'billing_zip'); ?></div>
            <div class="col-md-6">
                <input data-type="billing_address_zip" type="text" class="form-control" name="billing_zip" id="billing_zip" value="<?php if(isset($billing_info)){ echo $billing_info->zip != null ? $billing_info->zip : $profile_info->zip_code; } ?>"/>
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'billing-information', 'equipment') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'billing-information', 'equipment'); ?></div>
            <div class="col-md-6">
                <div class="input-group">
                    <?php   
                        $billing_equipment = 0;
                        if( isset($billing_info) && $billing_info->equipment != '' ){
                            $billing_equipment = $billing_info->equipment;
                        }else{
                            if( $woSubmittedLatest ){
                                $billing_equipment = $woSubmittedLatest->subtotal;
                            }
                        }
                    ?>
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="equipment" value="<?= $billing_equipment; ?>" />
                </div>
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'billing-information', 'initial_dep') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'billing-information', 'initial_dep'); ?></div>
            <div class="col-md-6">
                <div class="input-group">
                    <?php   
                        $billing_initial_dep = 0;
                        if( isset($billing_info) && $billing_info->initial_dep != '' ){
                            $billing_initial_dep = $billing_info->initial_dep;
                        }else{
                            if( $woSubmittedLatest ){
                                $billing_initial_dep = $woSubmittedLatest->deposit_collected;
                            }
                        }
                    ?>
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="initial_dep" value="<?= $billing_initial_dep; ?>" >
                </div>
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'billing-information', 'mmr') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'billing-information', 'mmr'); ?></div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <select data-value="<?=$billing_info->mmr?>" id="mmr" name="mmr" data-type="billing_rate_plan" class="form-control" >
                            <option value="0">Select Amount</option>
                            <?php if( isset($billing_info) ){ ?>
                                <option value="<?= $billing_info->mmr; ?>"><?= $billing_info->mmr; ?></option>
                            <?php } ?>
                            
                        </select>
                        <a href="javascript:void(0);" class="nsm-button btn-small" id="btn-quick-add-rate-plan"><span class="fa fa-plus"></span> Add Rate Plan</a>        
                    </div>
                </div>
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'billing-information', 'bill_freq') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'billing-information', 'bill_freq'); ?></div>
            <div class="col-md-6">
                <select data-type="billing_frequency" id="bill_freq" name="bill_freq" data-customer-source="dropdown" class="input_select searchable-dropdown">
                    <option <?php if(isset($billing_info)){ if($billing_info->bill_freq == ""){echo "selected";} } ?> value="">- Select -</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->bill_freq == "One Time Only"){echo "selected";} } ?> value="One Time Only">One Time Only</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->bill_freq == "Every 1 Month"){echo "selected";} } ?> value="Every 1 Month">Every 1 Month</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->bill_freq == "Every 3 Months"){echo "selected";} } ?> value="Every 3 Months">Every 3 Months</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->bill_freq == "Every 6 Months"){echo "selected";} } ?> value="Every 6 Months">Every 6 Months</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->bill_freq == "Every 1 Year"){echo "selected";} } ?> value="Every 1 Year">Every 1 Year</option>
                </select>
            </div>
        </div>

        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'billing-information', 'contract_term') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'billing-information', 'contract_term'); ?></div>
            <div class="col-md-6">
                <select data-type="billing_contract_term" id="contract_term" name="contract_term" data-customer-source="dropdown" class="input_select searchable-dropdown" >
                    <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 0){echo "selected";} } ?> value="0">None</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 1){echo "selected";} } ?> value="1">1 month</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 6){echo "selected";} } ?> value="6">6 months</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 12){echo "selected";} } ?> value="12">12 months</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 18){echo "selected";} } ?> value="18">18 months</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 24){echo "selected";} } ?> value="24">24 months</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 36){echo "selected";} } ?> value="36">36 months</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 42){echo "selected";} } ?> value="42">42 months</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 48){echo "selected";} } ?> value="48">48 months</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 60){echo "selected";} } ?> value="60">60 months</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 72){echo "selected";} } ?> value="72">72 months</option>
                </select>
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'billing-information', 'bill_start_date') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'billing-information', 'bill_start_date'); ?></div>
            <div class="col-md-6">
                <?php 
                    $bill_start_date = '';
                    if( $billing_info && strtotime($billing_info->bill_start_date) > 0 ){
                        $bill_start_date = date("m/d/Y", strtotime($billing_info->bill_start_date));
                    }
                ?>
                <input data-type="billing_start_date" type="text" class="form-control " name="bill_start_date" id="bill_start_date" value="<?= $bill_start_date; ?>" />
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'billing-information', 'bill_end_date') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'billing-information', 'bill_end_date'); ?></div>
            <div class="col-md-6">
                <?php 
                    $bill_end_date = '';
                    if( $billing_info && strtotime($billing_info->bill_end_date) > 0 ){
                        $bill_end_date = date("m/d/Y", strtotime($billing_info->bill_end_date));
                    }
                ?>
                <!-- <input data-type="billing_end_date" type="text" class="form-control " name="bill_end_date" id="bill_end_date" value="<?php if(isset($billing_info)){ echo $billing_info->bill_end_date != null ? $billing_info->bill_end_date : date("m/d/Y", strtotime("$office_info->install_date +$billing_info->contract_term months"));; } ?>"/> -->
                <input data-type="billing_end_date" type="text" class="form-control " name="bill_end_date" id="bill_end_date" value="<?= $bill_end_date; ?>"/>
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'billing-information', 'bill_day') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'billing-information', 'bill_day'); ?></div>
            <div class="col-md-6">
                <select data-type="billing_month_day" id="bill_day" name="bill_day" data-customer-source="dropdown" class="input_select searchable-dropdown">
                    <option selected value="0">Select Day</option>
                    <?php
                    if($billing_info->bill_day == null){
                        if($billing_info->billing_start_date == null){
                            $insdate = strtotime($office_info->install_date);
                            $day = date("d", $insdate);
                        }else{
                            $insdate = strtotime($billing_info->billing_start_date);
                            $day = date("d", $insdate);
                        }
                    }else{
                        $day = $billing_info->bill_day;
                    }
                    for ($days=0;$days<32;$days++){
                        ?>
                            <option <?php if(isset($billing_info)){ if($day == days_of_month($days)){ echo 'selected'; } } ?> value="<?= days_of_month($days); ?>"><?= days_of_month($days) < 1 ? '' : days_of_month($days) ; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>   
        <?php if( $billing_info && $billing_info->next_billing_date != '' ){ ?>
        <div class="row form_line">
            <div class="col-md-6">
                Next Billing Date
            </div>
            <div class="col-md-6">
                <?php 
                    $next_billing_date = $billing_info->next_billing_date;
                    if( strtotime($billing_info->next_billing_date) > 0 ){
                        $next_billing_date = date("m/d/Y", strtotime($billing_info->next_billing_date));
                    }
                ?>
                <input type="text" class="form-control" value="<?= $next_billing_date; ?>" disabled="" />
            </div>
        </div> 
        <?php } ?>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'billing-information', 'late_fee') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'billing-information', 'late_fee'); ?></div>
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width:35px;" id="">$</span>
                    </div>
                    <input type="number" step="any" class="form-control input_select" name="late_fee" value="<?= isset($billing_info) ? $billing_info->late_fee : '0.00'; ?>" >
                </div>
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'billing-information', 'payment_fee') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'billing-information', 'payment_fee'); ?></div>
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width:35px;" id="">$</span>
                    </div>
                    <input type="number" step="any" class="form-control" name="payment_recorded" value="<?= (isset($billing_info) && $billing_info->payment_recorded > 0) ? number_format($billing_info->payment_recorded,2) : number_format($default_total_payment_recorded,2); ?>">
                </div>
            </div>
        </div>   
        <?php if(isset($billing_info)): ?>
            <!-- <a href="<?= base_url('customer/subscription_new/'.$this->uri->segment(3)) ?>">
                <button type="button" class="nsm-button primary"><span class="fa fa-plus"></span> Add Subscription</button>
            </a> -->
            <div class="mt-4 text-end">
                <button type="button" class="nsm-button primary btn-view-subscription"><span class="fa fa-list"></span> View Subscription</button>
            </div>
        <?php endif; ?>     
    </div>
</div>
