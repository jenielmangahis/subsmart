<style>
.quick-view-schedule-container .title-border{
    background-color: #6a4a86;
    color: #ffffff;
    font-size: 15px;
    padding: 10px;
}
.total-summary{
    list-style: none;
    padding: 0px;
}
.total-summary li{
    display: inline-block;
    width: 49%;
    margin-bottom: 6px;
}
.total-summary li span{
    display: block;
}
.total-summary li .right-text{
    text-align: right;
}
</style>
<div class="">
    <div class="row">
        <div class="col-md-12">
        <div class="right-text">
            <span class="page-title " style="font-weight: bold;font-size: 2.5rem; float: right"><?=  $jobs_data->job_number;  ?>
            </span>
        </div>
        </div>
    </div>
    <div class="card-body quick-view-schedule-container">
        <div class="row">
            <div class="col-md-5">
                <?php if ($company_info->business_image != ""): ?>
                <img style="max-width: 130px; max-height: 130px;" id="attachment-image" alt="Attachment"
                    src="<?= base_url('/uploads/users/business_profile/'.$company_info->id.'/'.$company_info->business_image); ?>">
                <?php endif; ?>
            </div>
            <div class="col-md-7">
                <table class="right-text" style="width: 100%;">
                    <tbody>
                        <tr>
                            <td align="right" width="35%">Job Type :</td>
                            <td align="right" width="">
                                <strong><?= $jobs_data->job_type;  ?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Job Tags:</td>
                            <td align="right">
                                <strong><?= $jobs_data->tags != '' ? $jobs_data->tags : '---';  ?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">From :</td>
                            <td align="right">
                                <?php 
                                    $job_start_date = $jobs_data->start_date . ' ' . $jobs_data->start_time;                                    
                                    $job_date = date('m/d/Y g:i a', strtotime($job_start_date));
                                    echo $job_date;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">To :</td>
                            <td align="right">
                                <?php
                                    $job_end_date   = $jobs_data->end_date . ' ' . $jobs_data->end_time;
                                    $job_date = date('m/d/Y g:i a', strtotime($job_end_date));
                                    echo $job_date;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Priority :</td>
                            <td align="right" style="color: darkred;">
                                <?=  $jobs_data->priority; ?>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Status :</td>
                            <td align="right" class="job-status">
                                <b><?=  $jobs_data->status; ?></b>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>            
        </div>
        <div class="row mt-5">
            <div class="col-md-8">
                <h6 class="title-border">FROM :</h6>
                <div style="padding:0px 9px; font-size: 14px;">
                    <span style="font-size:16px;font-weight: bold; display: block; margin-bottom:6px;">
                        <i class='bx bx-buildings'></i> <?= $company_info->business_name; ?>
                    </span>                    
                    <span><?= $company_info->street; ?></span><br>
                    <span><?= $company_info->city.', '.$company_info->state.' '.$company_info->postal_code; ?></span><br>
                    <?php if( $company_info->business_email != '' ){ ?>
                        <span> Email: <a href="mailto:<?= $company_info->business_email; ?>"><?= $company_info->business_email; ?></a></span><br />
                    <?php } ?>
                    <span> Contact Number: <?= formatPhoneNumber($company_info->business_phone); ?></span>
                </div>
                <br>
                <h6 class="title-border">TO : </h6>
                <div style="padding:0px 9px; font-size: 14px;">
                    <?php if( $jobs_data->customer_type == 'Business' && $jobs_data->acs_business_name != '' ){ ?>
                        <span style="font-size:16px;font-weight: bold; display: block; margin-bottom:6px;">
                            <i class='bx bx-user-circle' ></i> <?= $jobs_data->first_name .' '. $jobs_data->last_name; ?> - 
                            <i class='bx bx-buildings'></i> <?= $jobs_data->acs_business_name; ?>
                        </span>
                    <?php }else{ ?>
                        <span style="font-size:16px;font-weight: bold; display: block; margin-bottom:6px;">
                            <i class='bx bx-user-circle' ></i> <?= $jobs_data->first_name .' '. $jobs_data->last_name; ?>
                        </span>
                    <?php } ?>                    
                    <span><?= $jobs_data->mail_add; ?></span><br>
                    <span><?= $jobs_data->cust_city.', '.$jobs_data->cust_state.' '.$jobs_data->cust_zip_code ; ?></span><br />
                    <?php if( $jobs_data->cust_email != '' ){ ?>
                        <span>Email: <a href="mailto:<?= $jobs_data->cust_email; ?>"><?= $jobs_data->cust_email; ?></a></span><br>
                    <?php } ?>                
                    <!-- <span>Phone: <?= $jobs_data->phone_h !="" || $jobs_data->phone_h !=null ? $jobs_data->phone_h : 'N/A'; ?> </span><br>    -->             
                    <span>Contact Number: <?= $jobs_data->phone_m !="" || $jobs_data->phone_m !=null ? formatPhoneNumber($jobs_data->phone_m) : 'N/A'; ?></span><br>
                </div>
            </div>
            <div class="col-md-4">
                <h6 class="title-border">TECHNICIANS :</h6>
                <?php 
                    $assigned_employees = array();
                    //$assigned_employees[] = $jobs_data->e_employee_id;
                    if( $jobs_data->employee2_id > 0 ){
                        $assigned_employees[] = $jobs_data->employee2_id;
                    }
                    if( $jobs_data->employee3_id > 0 ){
                        $assigned_employees[] = $jobs_data->employee3_id;
                    }
                    if( $jobs_data->employee4_id > 0 ){
                        $assigned_employees[] = $jobs_data->employee4_id;
                    }
                    if( $jobs_data->employee5_id > 0 ){
                        $assigned_employees[] = $jobs_data->employee5_id;
                    }
                    if( $jobs_data->employee6_id > 0 ){
                        $assigned_employees[] = $jobs_data->employee6_id;
                    }
                ?>
                <?php foreach($assigned_employees as $eid){ ?>
                    <div class="nsm-list-icon primary" style="background-color:#ffffff;">
                        <div class="nsm-profile" style="background-image: url('<?= userProfileImage($eid); ?>');" data-img="<?= userProfileImage($eid); ?>"></div>                            
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-12" style="margin-top: 16px;">
                <h6 class="title-border">JOB DETAILS :</h6>
                <?php 
                    $installation_cost = 0;
                    $monthly_monitoring = 0;
                    $program_setup = 0;
                ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>Items</td>
                            <td>Qty</td>
                            <td>Price</td>
                            <td style="text-align:right;">Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $subtotal = 0.00;
                            foreach ($jobs_data_items as $item):
                            $total = $item->cost * $item->qty;
                        ?>
                        <tr>
                            <td>
                                <?= $item->title; ?>
                                <?php 
                                    if( $item->title != '' ){
                                        echo $item->title;
                                    }else{
                                        echo $item->job_item_name;
                                    }
                                ?>        
                            </td>
                            <td><?= $item->qty; ?></td>
                            <td>$<?= $item->cost; ?></td>
                            <td style="text-align:right;">$<?= number_format((float)$total, 2, '.', ','); ?></td>
                        </tr>
                        <?php
                        $subtotal = $subtotal + $total;
                        endforeach;
                        $GRAND_TOTAL = $subtotal + $jobs_data->tax_rate;
                    ?>                    
                    </tbody>
                </table>
                <hr />                
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-5 p-4">
                        <center>
                            <strong>Our Team will arrive between <?= $jobs_data->start_time. ' and '.$jobs_data->end_time;  ?></strong><br>
                            <small style="text-align: center;">Thank you for your business, Please
                                call <?= $company_info->business_name; ?>
                                at <?= $company_info->business_phone; ?>
                                for quality customer service.</small>
                        </center>
                    </div>
                    <div class="col-7">
                        <?php 
                            $installation_cost = 0;
                            $monthly_monitoring = 0;
                            $program_setup = 0;
                        ?>
                        <ul class="total-summary">
                            <li>Sub Total</li>
                            <li><span class="right-text">$<?= number_format((float)$subtotal, 2, '.', ','); ?></span></li>

                            <li>Sales Tax</li>
                            <li><span class="right-text">$<?= number_format((float)$jobs_data->tax_rate, 2, '.', ','); ?></span></li>
                            <?php if( in_array($cid, exempted_company_ids()) ){ ?>
                                <?php 
                                    if( $latest_job_payment ){
                                        $installation_cost = $latest_job_payment->installation_cost;
                                        $monthly_monitoring = $latest_job_payment->monthly_monitoring;
                                        $program_setup = $latest_job_payment->program_setup;
                                    }
                                ?>
                                <li>Installation Cost</li>
                                <li><span class="right-text">$<?= number_format((float)$installation_cost, 2, '.', ','); ?></span></li>

                                <li>One time (Program and Setup)</li>
                                <li><span class="right-text">$<?= number_format((float)$program_setup, 2, '.', ','); ?></span></li>

                                <li>Monthly Monitoring</li>
                                <li><span class="right-text">$<?= number_format((float)$monthly_monitoring, 2, '.', ','); ?></span></li>
                            <?php } ?>
                            <?php $GRAND_TOTAL = $GRAND_TOTAL + $installation_cost + $monthly_monitoring + $program_setup; ?>
                            <li><b>Total Due</b></li>
                            <li><span class="right-text"><b>$<?= number_format((float)$GRAND_TOTAL, 2, '.', ','); ?></span></b></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>