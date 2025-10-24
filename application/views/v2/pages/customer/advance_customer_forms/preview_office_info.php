<div class="nsm-card primary">
    <div class="nsm-card-content">
        <div class="row mb-3">
            <div class="col-12">
                <div class="nsm-card-title">
                    <span><i class="bx bx-fw bx-user"></i>Office Use Information</span>
                    <hr />
                </div>
            </div>
        </div>
        <div class="row g-1 mb-5">
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Entered By</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= $logged_in_user->FName . ' ' . $logged_in_user->LName; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Time Entered</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($office_info->time_entered) ?  date("h:i A", strtotime($office_info->time_entered)) : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Sales Date</label>
            </div>
            <div class="col-12 col-md-6">
                <?php 
                    $sales_date = '---';
                    if( $office_info && strtotime($office_info->sales_date) > 0 ){
                        $sales_date = date("m/d/Y", strtotime($office_info->sales_date));
                    }
                ?>
                <label class="content-subtitle"><?= $sales_date; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Credit Score</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($office_info) && !empty($office_info->credit_score) ?  $office_info->credit_score : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Verification</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($office_info) && !empty($office_info->verification) ?  $office_info->verification : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Pay History</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($office_info->pay_history) ?  pay_history($office_info->pay_history) : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Sales Rep</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">
                    <?php 
                        $fk_sales_rep_office = $office_info->fk_sales_rep_office ?? 0;
                        if( $fk_sales_rep_office == 0 && $woSubmittedLatest ){
                            $fk_sales_rep_office = $woSubmittedLatest->employee_id;
                        } 

                        $salesRep = get_user_by_id($fk_sales_rep_office);
                        if( $salesRep ){
                            $office_sales_rep_name = $salesRep->FName . ' ' . $salesRep->LName;
                        }
                    ?>
                    <?= $office_sales_rep_name; ?>
                </label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Technician</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">
                    <?php
                        $office_tech_name = '---';
                        if( $office_info->technician > 0 ){
                            $officeTech = get_user_by_id($office_info->technician);
                            if( $officeTech ){
                                $office_tech_name = $officeTech->FName . ' ' . $officeTech->LName;
                            }
                        }                    
                    ?>
                    <?= $office_tech_name; ?>                        
                </label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Install Date</label>
            </div>
            <div class="col-12 col-md-6">
                <?php 
                    $install_date = '---';            
                    if( $office_info && strtotime($office_info->install_date) > 0 ){
                        $install_date = date("m/d/Y", strtotime($office_info->install_date));
                    }else{
                        if( $woSubmittedLatest && strtotime($woSubmittedLatest->install_date) > 0 ){
                            $install_date = date("m/d/Y",strtotime($woSubmittedLatest->install_date));
                        }
                    }
                ?>
                <label class="content-subtitle"><?= $install_date; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Tech Arrival Time</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">
                    <?php 
                        $arrival_time = '---';
                        if( $jobLatest && $jobLatest->job_start_time != '' ){
                            $arrival_time = date("h:i A",strtotime($jobLatest->job_start_time));
                        }elseif( $office_info ){
                            $arrival_time = date("h:i A",strtotime($office_info->tech_arrive_time));
                        }

                        echo $arrival_time;
                    ?>
                </label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Tech Departure Time</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">
                <?php 
                        $departure_time = '---';
                        if( $jobLatest && $jobLatest->finished_time != '' ){
                            $departure_time = date("h:i A",strtotime($jobLatest->finished_time));
                        }elseif( $office_info ){
                            $departure_time = date("h:i A",strtotime($office_info->tech_depart_time));
                        }

                        echo $departure_time;
                    ?>
                </label>                
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Lead Source</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($office_info) && !empty($office_info->lead_source) ?  $office_info->lead_source : '---' ?></label>
            </div>            
            <?php 
                $is_container_hidden = '';
                if( isset($alarm_info) && $alarm_info->acct_type == 'In-House' ){
                    $is_container_hidden = 'style="display:none;"';
                }
            ?>
            <div class="col-12 col-md-6" <?= $is_container_hidden; ?>>
                <label class="content-subtitle fw-bold">Cancel Date</label>
            </div>
            <div class="col-12 col-md-6" <?= $is_container_hidden; ?>>
                <label class="content-subtitle"><?= isset($office_info) && !empty($office_info->cancel_date) ?  $office_info->cancel_date : '---' ?></label>
            </div>
            <div class="col-12 col-md-6" <?= $is_container_hidden; ?>>
                <label class="content-subtitle fw-bold">Cancel Reason</label>
            </div>
            <div class="col-12 col-md-6" <?= $is_container_hidden; ?>>
                <label class="content-subtitle"><?= isset($office_info) && !empty($office_info->cancel_reason) ?  $office_info->cancel_reason : '---' ?></label>
            </div>
            <div class="col-12 col-md-6" <?= $is_container_hidden; ?>>
                <label class="content-subtitle fw-bold">Collection Date</label>
            </div>
            <div class="col-12 col-md-6" <?= $is_container_hidden; ?>>
                <label class="content-subtitle"><?= isset($office_info) && !empty($office_info->collect_date) ?  $office_info->collect_date : '---' ?></label>
            </div>
            <div class="col-12 col-md-6" <?= $is_container_hidden; ?>>
                <label class="content-subtitle fw-bold">Collection Amount</label>
            </div>
            <div class="col-12 col-md-6" <?= $is_container_hidden; ?>>
                <label class="content-subtitle">$<?= isset($office_info) && !empty($office_info->collect_amount) ?  number_format((float)$office_info->collect_amount, 2, '.', ',') : '0.00' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Language</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($office_info->language) ?  $office_info->language : '---' ?></label>
            </div>
        </div>
    </div>
</div>