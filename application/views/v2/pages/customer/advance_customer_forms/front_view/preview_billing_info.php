<div class="nsm-card primary">
    <div class="nsm-card-content">
        <div class="row mb-3">
            <div class="col-12">
                <div class="nsm-card-title">
                    <span><i class='bx bx-fw bx-credit-card'></i> Billing Information</span>
                    <hr />
                </div>
            </div>
        </div>
        <div class="row g-1 mb-5">
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Card Holder First Name</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($billing_info) && !empty($billing_info->card_fname) ? $billing_info->card_fname : $profile_info->first_name ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Card Holder Last Name</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($billing_info) && !empty($billing_info->card_lname) ? $billing_info->card_lname : $profile_info->last_name ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Card Holder Address</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($billing_info) && !empty($billing_info->card_address) ? $billing_info->card_address : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">City State ZIP</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">
                    <?= isset($billing_info) && !empty($billing_info->city) ? $billing_info->city : '---' ?>
                    <?= isset($billing_info) && !empty($billing_info->state) ? $billing_info->state : '---' ?>
                    <?= isset($billing_info) && !empty($billing_info->zip) ? $billing_info->zip : '---' ?>
                </label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Rate Plan</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($billing_info) && !empty($billing_info->mmr) ? '$' . $billing_info->mmr : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Billing Frequency</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($billing_info) && !empty($billing_info->bill_freq) ? $billing_info->bill_freq : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Billing Day of Month</label>
            </div>
            <div class="col-12 col-md-6">
                <?php if($billing_info->bill_day == null){
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
                    ?>
                <label class="content-subtitle"><?= isset($day) && !empty($day) ? $day : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Contract Term* (months)</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($billing_info) && !empty($billing_info->contract_term) ? $billing_info->contract_term . ' months' : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Billing Start Date</label>
            </div>
            <div class="col-12 col-md-6">
                <?php 
                    $start_date = '<i class="text-muted">Not Specified</i>';
                    if( $billing_info && ( $billing_info->bill_start_date != '1970-01-01' && strtotime($billing_info->bill_start_date) > 0 ) ){
                        $start_date = date("m/d/Y", strtotime($billing_info->bill_start_date));
                    }
                ?>
                <label class="content-subtitle"><?php echo $start_date; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Billing End Date</label>
            </div>
            <div class="col-12 col-md-6">
                <?php 
                    $end_date = '<i class="text-muted">Not Specified</i>';
                    if( $billing_info && ( $billing_info->bill_end_date != '1970-01-01' && strtotime($billing_info->bill_end_date) > 0 ) ){
                        $end_date = date("m/d/Y", strtotime($billing_info->bill_end_date));
                    }
                ?>
                <label class="content-subtitle"><label class="content-subtitle"><?php echo $end_date; ?></label>
            </div>
            <?php if( $billing_info && $billing_info->next_billing_date != '' ){ ?>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Next Billing Date</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= date("m/d/Y", strtotime($billing_info->next_billing_date)); ?></label>
            </div>
            <?php } ?>
        </div>
    </div>
</div>