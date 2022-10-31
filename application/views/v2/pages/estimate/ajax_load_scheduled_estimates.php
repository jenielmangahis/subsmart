<link href="https://fonts.googleapis.com/css?family=Roboto:300,100" rel="stylesheet">
<style>
.nsm-calendar {
    background: #DAD1E0;
    border-radius: 20%;
    width: 103px;
    height: 103px;
    margin: auto;
    vertical-align: middle;
    text-align: center;
    font: 300 28.5714285714px Roboto;
}
.nsm-calendar .week {
    color: red;
    padding: 13px;
    padding-bottom: 5px;
    font-size: 20px;
    font-weight: bold;
}
.nsm-calendar .date {
    font: 45px Roboto;
    margin-top: -7px;
    font-weight: bold;
}
.nsm-list-icon{
    float: right;
}
</style>
<table class="nsm-table" id="upcoming_jobs_table">
    <thead>
        <tr>
            <td></td>
            <td data-name="Estimate Details"></td>
            <td data-name="Status"></td>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($scheduledEstimates)) : ?>
            <?php foreach ($scheduledEstimates as $se) : ?>
                <tr class="schedule-jobs" style="cursor: pointer" onclick="location.href='<?php echo base_url('estimate/view/' . $se->id); ?>'">
                    <td>
                        <?php 
                            $estimate_month = date("F", strtotime($se->estimate_date));
                            $estimate_day   = date("d", strtotime($se->estimate_date));
                            $estimate_day_word = date("D", strtotime($se->estimate_date));
                        ?>
                        <div class="nsm-calendar" ng-app="myApp">
                            <div class="week">
                                <b><?= $estimate_day_word; ?></b>
                            </div>
                            <div class="date">
                                <?= $estimate_day; ?>
                            </div>
                        </div>    
                        <div class="nsm-calendar-info-container" style="text-align:center;">
                            <span class="nsm-badge primary"><?php echo strtoupper($se->status); ?></span>
                        </div>                    
                    </td>
                    <td style="vertical-align: text-top;padding-top: 28px;">
                        <label class="content-title" style="cursor: pointer;margin-bottom: 11px;font-size: 17px;">                            
                            <?php 
                                $tags = '---';
                                if( $se->tags != '' ){
                                    $tags = $se->tags;
                                }

                                echo $se->estimate_number . ' : ' . $tags;
                            ?>        
                        </label>
                        <label class="content-title" style="cursor: pointer;margin-bottom: 4px;">
                            <i class='bx bxs-user-rectangle'></i> <?= $se->first_name . ' ' . $se->last_name; ?>
                        </label>
                        <label class="content-title" style="cursor: pointer;margin-bottom: 4px;">
                            <i class='bx bxs-phone'></i> <?= $se->phone_m != '' ? $se->phone_m : '---'; ?>
                        </label>
                        <label class="content-title" style="cursor: pointer; color:#ff4d4d;">
                            <i class='bx bxs-calendar-x'></i> Expiry Date : <?= date("m/d/Y", strtotime($se->expiry_date)); ?>
                        </label>

                        <?php //if (!empty($settings['work_order_show_price']) && $settings['work_order_show_price'] == 1) : ?>
                            <!-- <label class="content-subtitle d-block" style="cursor: pointer;margin-top: 10px; font-weight: bold;">Total Amount : $<?= number_format((float)$jb->job_total_amount, 2, '.', ','); ?></label> -->
                        <?php //endif; ?>
                    </td>
                    <td class="text-end">
                        <?php if( $se->user_id > 0 ){ ?>
                        <div class="nsm-list-icon primary" style="background-color:#ffffff; justify-content:right;">
                            <div class="nsm-profile" style="background-image: url('<?php echo userProfileImage($se->user_id); ?>');" data-img="<?php echo userProfileImage($jb->e_employee_id); ?>"></div>                            
                        </div>                       
                        <?php } ?>     
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="4">
                    <div class="nsm-empty">
                        <span>No scheduled estimate for now.</span>
                    </div>
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>