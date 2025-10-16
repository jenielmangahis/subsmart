<div class="nsm-card primary" id="funding-information-container">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><i class="bx bx-fw bx-user"></i>Funding Information</span>
        </div>
    </div>
    <div class="nsm-card-content"><hr>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'pre_install_survey') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-7"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'pre_install_survey'); ?></div>
            <div class="col-md-5">
                <select id="pre_install_survey" name="pre_install_survey" data-customer-source="dropdown" class="input_select" >
                    <option <?php if(isset($office_info)){ if($office_info->pre_install_survey == ""){ echo 'selected'; } } ?> value=""></option>
                    <option <?php if(isset($office_info)){ if($office_info->pre_install_survey == "Pass"){ echo 'selected'; } } ?> value="Pass">Pass</option>
                    <option <?php if(isset($office_info)){ if($office_info->pre_install_survey == "Fail"){ echo 'selected'; } } ?>value="Fail">Fail</option>
                    <option  <?php if(isset($office_info)){ if($office_info->pre_install_survey == "Pending"){ echo 'selected'; } } ?> value="Pending">Pending</option>
                </select>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'post_install_survey') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-7"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'post_install_survey'); ?></div>
            <div class="col-md-5">
                <select id="post_install_survey" name="post_install_survey" data-customer-source="dropdown" class="input_select" >
                    <option <?php if(isset($office_info)){ if($office_info->post_install_survey == ""){ echo 'selected'; } } ?> value="">Select</option>
                    <option <?php if(isset($office_info)){ if($office_info->post_install_survey == "Pass"){ echo 'selected'; } } ?> value="Pass">Pass</option>
                    <option <?php if(isset($office_info)){ if($office_info->post_install_survey == "Fail"){ echo 'selected'; } } ?> value="Fail">Fail</option>
                    <option <?php if(isset($office_info)){ if($office_info->post_install_survey == "Pending"){ echo 'selected'; } } ?> value="Pending">Pending</option>
                </select>
            </div>
        </div>
        <hr>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'monitoring_waived') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-7"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'monitoring_waived'); ?></div>
            <div class="col-md-5">
                <select id="monitoring_waived" name="monitoring_waived" data-customer-source="dropdown" class="input_select" >
                    <option  value=""></option>
                    <option <?= isset($office_info) && $office_info->monitoring_waived == 1 ?  'selected' : '';?> value="1">1 month</option>
                    <option <?= isset($office_info) && $office_info->monitoring_waived == 2 ?  'selected' : '';?> value="2">2 months</option>
                    <option <?= isset($office_info) && $office_info->monitoring_waived == 3 ?  'selected' : '';?> value="3">3 months</option>
                    <option <?= isset($office_info) && $office_info->monitoring_waived == 4 ?  'selected' : '';?> value="4">4 months</option>
                    <option <?= isset($office_info) && $office_info->monitoring_waived == 5 ?  'selected' : '';?> value="5">5 months</option>
                    <option <?= isset($office_info) && $office_info->monitoring_waived == 6 ?  'selected' : '';?> value="6">6 months</option>
                    <option <?= isset($office_info) && $office_info->monitoring_waived == 7 ?  'selected' : '';?> value="7">7 months</option>
                    <option <?= isset($office_info) && $office_info->monitoring_waived == 8 ?  'selected' : '';?> value="8">8 months</option>
                    <option <?= isset($office_info) && $office_info->monitoring_waived == 9 ?  'selected' : '';?> value="8">9 months</option>
                    <option <?= isset($office_info) && $office_info->monitoring_waived == 10 ?  'selected' : '';?> value="10">10 months</option>
                    <option <?= isset($office_info) && $office_info->monitoring_waived == 11 ?  'selected' : '';?> value="11">11 months</option>
                    <option <?= isset($office_info) && $office_info->monitoring_waived == 12 ?  'selected' : '';?> value="12">12 months</option>
                </select>
            </div>
        </div>

        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'rebate_offer') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-7">
                <label for="rebate_offer"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'rebate_offer'); ?></label>
            </div>
            <div class="col-md-5">
                <input type="checkbox" name="rebate_offer" class="form-controls" value="1"  id="rebate_offer" <?php if(isset($office_info)){ echo $office_info->rebate_offer == 1 ? 'checked': ''; } ?> >
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'rebate_check1') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-7"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'rebate_check1'); ?></div>
            <div class="col-md-5">
                <input type="number" class="form-control" name="rebate_check1" id="rebate_check1" value="<?php if(isset($office_info)){ echo  $office_info->rebate_check1; } ?>"/>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'rebate_check1_amt') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-7"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'rebate_check1_amt'); ?></div>
            <div class="col-md-5">
                <input type="number" step="0.01" class="form-control" name="rebate_check1_amt" id="rebate_check1_amt" value="<?php if(isset($office_info)){ echo  $office_info->rebate_check1_amt; } ?>"/>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'rebate_check2') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-7"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'rebate_check2'); ?></div>
            <div class="col-md-5">
                <input type="number" class="form-control" name="rebate_check2" id="rebate_check2" value="<?php if(isset($office_info)){ echo  $office_info->rebate_check2; } ?>"/>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'rebate_check2_amt') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-7"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'rebate_check2_amt'); ?></div>
            <div class="col-md-5">
                <input type="number" step="0.01" class="form-control" name="rebate_check2_amt" id="rebate_check2_amt" value="<?php if(isset($office_info)){ echo  $office_info->rebate_check2_amt; } ?>" />
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'activation_fee') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-7"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'activation_fee'); ?></div>
            <div class="col-md-5">
                <select data-value="<?= isset($office_info) ? $office_info->activation_fee : "" ?>" name="activation_fee" id="activation-fee" data-type="funding_info_activation_fee" class="form-control">
                    <option><?= isset($office_info) ? $office_info->activation_fee : "" ?></option>
                </select>
                <a href="javascript:void(0);" class="nsm-button btn-small" id="btn-quick-add-activation-fee"><span class="fa fa-plus"></span> Add Activation Fee</a>
            </div>
            <div class="col-md-12">
                <input type="radio" class="form-controls" name="way_of_pay" value="None" <?php if(isset($office_info)){ echo $office_info->way_of_pay == 'None' || $office_info->way_of_pay == '' || $office_info->way_of_pay == 'Email' ? 'checked': ''; }else {echo 'checked'; } ?>  id="way_of_pay_none">
                <span>None</span>

                <input type="radio" class="form-controls" name="way_of_pay" value="Check" <?php if(isset($office_info)){ echo $office_info->way_of_pay == 'Check'? 'checked': ''; } ?>  id="way_of_pay_check">
                <span>Check</span>

                <input type="radio" class="form-controls" name="way_of_pay" value="Credit" <?php if(isset($office_info)){ echo $office_info->way_of_pay == 'Credit'? 'checked': ''; } ?>  id="way_of_pay_credit">
                <span>Credit</span>

                <input type="radio" class="form-controls" name="way_of_pay" value="Paid" <?php if(isset($office_info)){ echo $office_info->way_of_pay == 'Paid'? 'checked': ''; } ?> id="way_of_pay_paid">
                <span>Paid</span>
            </div>
        </div>
        <hr>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'commision_scheme') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-7"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'commision_scheme'); ?></div>
            <div class="col-md-5">
                <input type="radio" name="commision_scheme[]" class="form-controls" value="1" id="commision_scheme1" <?php if(isset($office_info)){ echo $office_info->commision_scheme == 1 ? 'checked': ''; } ?> >
                <span >On</span> &nbsp;&nbsp;
                <input type="radio" name="commision_scheme[]" class="form-controls" value="0" id="commision_scheme" <?php if(isset($office_info)){ echo $office_info->commision_scheme == 0 ? 'checked': ''; } ?>>
                <span>Off</span>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'rep_comm') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-7"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'rep_comm'); ?></div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>                    
                    <!-- <input type="number" step="0.01" class="form-control input_select" id="rep_comm" name="rep_comm" value="<?php echo ($commission->totalCommission) ? number_format((float)$commission->totalCommission,2,'.','') : 0.0 ?>"> -->
                    <input type="number" step="0.01" class="form-control input_select" id="rep_comm" name="rep_comm" value="<?php echo ($office_info->rep_comm) ? number_format((float)$office_info->rep_comm,2,'.','') : 0.0 ?>">
                    <!-- <input type="number" step="any" class="form-control input_select" id="rep_comm" name="rep_comm" value="<?php echo ($sales_tech_commission->salesrep_commission) ? number_format((float)$sales_tech_commission->salesrep_commission,2,'.','') : 0.0 ?>"> -->
                </div>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'rep_upfront_pay') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-7"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'rep_upfront_pay'); ?></div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="rep_upfront_pay" value="<?php if(isset($office_info)){ echo $office_info->rep_upfront_pay; } ?>">
                </div>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'rep_tiered_bonus') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-7"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'rep_tiered_bonus'); ?></div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="rep_tiered_bonus" value="<?php if(isset($office_info)){ echo $office_info->rep_tiered_bonus; } ?>">
                </div>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'rep_holdfund_bonus') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-7"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'rep_holdfund_bonus'); ?></div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="rep_holdfund_bonus" value="<?php if(isset($office_info)){ echo $office_info->rep_holdfund_bonus; } ?>">
                </div>
            </div>
        </div>

        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'rep_deduction') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-7"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'rep_deduction'); ?></div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="rep_deduction" value="<?php if(isset($office_info)){ echo $office_info->rep_deduction; } ?>">
                </div>
            </div>
        </div>

        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'tech_comm') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-7"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'tech_comm'); ?></div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <!-- <input type="number" step="0.01" class="form-control input_select" id="tech_comm" name="tech_comm" value="<?php if(isset($office_info)){ echo $office_info->tech_comm; } ?>"> -->
                    <input type="number" step="any" class="form-control input_select" id="tech_comm" name="tech_comm" value="<?php echo ($sales_tech_commission->techrep_commission) ? number_format((float)$sales_tech_commission->techrep_commission,2,'.','') : 0.0 ?>">
                </div>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'tech_upfront_pay') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-7">
                <label for="tech_upfront_pay"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'tech_upfront_pay'); ?></div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="tech_upfront_pay" value="<?php if(isset($office_info)){ echo $office_info->tech_upfront_pay; } ?>">
                </div>
            </div>
        </div>

        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'tech_deduction') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-7"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'tech_deduction'); ?></div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="tech_deduction" value="<?php if(isset($office_info)){ echo $office_info->tech_deduction; } ?>">
                </div>
            </div>
        </div>

        <hr>

        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'rep_charge_back') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-7"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'rep_charge_back'); ?></div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="rep_charge_back" value="<?php if(isset($office_info)){ echo $office_info->rep_charge_back; } ?>">
                </div>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'rep_payroll_charge_back') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-7"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'rep_payroll_charge_back'); ?></div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="rep_payroll_charge_back" value="<?php if(isset($office_info)){ echo $office_info->rep_payroll_charge_back; } ?>">
                </div>
            </div>
        </div>
        <hr>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'pso') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-7"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'pso'); ?></div>
            <div class="col-md-5">
                <input type="radio" name="pso[]" class="form-controls" value="1" id="pso1" <?php if(isset($office_info)){ echo $office_info->pso == 1 ? 'checked': ''; } ?> >
                <span>On</span>
                &nbsp;&nbsp;
                <input type="radio" name="pso[]" class="form-controls" value="0" id="pso" <?php if(isset($office_info)){ echo $office_info->pso == 0 ? 'checked': ''; } ?> >
                <span>Off</span>
                </div>
        </div>

        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'points_include') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-7"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'points_include'); ?></div>
            <div class="col-md-5">
                <input type="number" step="0.01" class="form-control" name="points_include" id="points_include" value="<?php if(isset($office_info)){ echo $office_info->points_include !=0 ? $office_info->points_include : '';  } ?>"  />
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'price_per_point') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-7"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'price_per_point'); ?></div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="price_per_point" value="<?php if(isset($office_info)){ echo $office_info->price_per_point; } ?>">
                </div>
            </div>
        </div>
        <hr>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'purchase_price') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-7"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'purchase_price'); ?></div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="purchase_price" value="<?php if(isset($office_info)){ echo $office_info->purchase_price; } ?>">
                </div>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'purchase_multiple') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-7"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'purchase_multiple'); ?></div>
            <div class="col-md-5">
                <select id="purchase_multiple" name="purchase_multiple" data-customer-source="dropdown" class="input_select ">
                    <option <?php if(isset($office_info)){ if($office_info->purchase_multiple == ""){ echo 'selected'; } } ?> value="">Select</option>
                    <?php
                    for($pm=12;$pm<76;$pm++){
                        ?>
                            <option <?php if(isset($office_info)){ if($office_info->purchase_multiple == $pm.'x'){ echo 'selected'; } } ?> value="<?= $pm.'x'; ?>"><?= $pm.'x'; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'purchase_discount') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-7"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'purchase_discount'); ?></div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="purchase_discount" value="<?php if(isset($office_info)){ echo $office_info->purchase_discount; } ?>">
                </div>
            </div>
        </div>
        <hr>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'equipment_cost') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-7"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'equipment_cost'); ?></div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="equipment_cost" value="<?php if(isset($office_info)){ echo $office_info->equipment_cost; } ?>">
                </div>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'labor_cost') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-7"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'labor_cost'); ?></div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" id="labor_cost" name="labor_cost" value="<?php if(isset($office_info)){ echo $office_info->labor_cost; } ?>">
                </div>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'job_profit') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-7"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'job_profit'); ?></div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="job_profit" value="<?php if(isset($office_info)){ echo $office_info->job_profit; } ?>">
                </div>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'funding-information', 'url') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-12"><?= getCustomerFieldValue($companyFormSetting, 'funding-information', 'url'); ?></div>
            <div class="col-md-12">
                <input type="url" placeholder="https://sample.com" class="form-control" name="url" id="url" value="<?php if(isset($office_info)){ echo  $office_info->url; } ?>" />
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function calculateJobProfit() {
        let purchase_price = parseFloat($("input[name='purchase_price']").val());
        let equipment_cost = parseFloat($("input[name='equipment_cost']").val());
        let labor_cost = parseFloat($("input[name='labor_cost']").val());
        let job_profit_calculation = (purchase_price - (equipment_cost + labor_cost)).toFixed(2);
        $("input[name='job_profit']").val(job_profit_calculation);
    } calculateJobProfit();   

    $("input[name='purchase_price'], input[name='equipment_cost'], input[name='labor_cost'], input[name='job_profit_calculation']").on('change', function(event) {
        calculateJobProfit();
    });
</script>