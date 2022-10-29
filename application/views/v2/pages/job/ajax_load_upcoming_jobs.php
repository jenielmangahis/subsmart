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
            <td data-name="Job Details"></td>
            <td data-name="Status"></td>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($upcomingJobs)) : ?>
            <?php foreach ($upcomingJobs as $jb) : ?>
                <tr class="schedule-jobs" style="cursor: pointer" onclick="location.href='<?php echo base_url('job/new_job1/' . $jb->id); ?>'">
                    <td>
                        <?php 
                            $event_month = date("F", strtotime($jb->start_date));
                            $event_day   = date("d", strtotime($jb->start_date));
                            $event_day_word = date("D", strtotime($jb->start_date));
                        ?>
                        <div class="nsm-calendar" ng-app="myApp">
                            <div class="week">
                                <b><?= $event_day_word; ?></b>
                            </div>
                            <div class="date">
                                <?= $event_day; ?>
                            </div>
                        </div>    
                        <div class="nsm-calendar-info-container" style="text-align:center;">
                            <span class="nsm-badge primary"><?php echo strtoupper($jb->status); ?></span>
                            <label class="content-subtitle mt-1 d-block text-uppercase" style="cursor: pointer"><?php echo $jb->start_time; ?>-<?php echo $jb->end_time; ?></label>
                        </div>                    
                    </td>
                    <td style="vertical-align: text-top;padding-top: 28px;">
                        <label class="content-title" style="cursor: pointer;margin-bottom: 11px;font-size: 17px;">                            
                            <?php 
                                $tags = '';
                                if( $jb->tags_name != '' ){
                                    $tags = $jb->tags_name;
                                }

                                //echo $jb->job_number . ' : SERVICE (' . $tags . ')';
                                echo $jb->job_number . ' : ' . $tags;
                            ?>        
                        </label>
                        <label class="content-title" style="cursor: pointer;margin-bottom: 4px;">
                            <i class='bx bxs-user-rectangle'></i> <?= $jb->first_name . ' ' . $jb->last_name; ?>
                        </label>
                        <label class="content-title" style="cursor: pointer;margin-bottom: 4px;">
                            <i class='bx bxs-phone'></i> <?= $jb->cust_phone != '' ? $jb->cust_phone : '---'; ?>
                        </label>
                        <label class="content-title" style="cursor: pointer">
                            <i class='bx bxs-map-pin'></i> <?= $jb->job_location; ?>
                        </label>
                        <?php //if (!empty($settings['work_order_show_price']) && $settings['work_order_show_price'] == 1) : ?>
                            <!-- <label class="content-subtitle d-block" style="cursor: pointer;margin-top: 10px; font-weight: bold;">Total Amount : $<?= number_format((float)$jb->job_total_amount, 2, '.', ','); ?></label> -->
                        <?php //endif; ?>
                    </td>
                    <td class="text-end">
                        <div class="nsm-list-icon primary" style="background-color:#ffffff; justify-content:right;">
                            <div class="nsm-profile" style="background-image: url('<?php echo userProfileImage($jb->e_employee_id); ?>');" data-img="<?php echo userProfileImage($jb->e_employee_id); ?>"></div>                            
                        </div>
                        <?php if( $jb->employee2_employee_id > 0 ){ ?>
                            <div class="nsm-list-icon primary" style="background-color:#ffffff; justify-content:right;">
                                <div class="nsm-profile" style="background-image: url('<?php echo userProfileImage($jb->employee2_employee_id); ?>');" data-img="<?php echo userProfileImage($jb->employee2_employee_id); ?>"></div>                            
                            </div>
                        <?php } ?>
                        <?php if( $jb->employee3_employee_id > 0 ){ ?>
                            <div class="nsm-list-icon primary" style="background-color:#ffffff; justify-content:right;">
                                <div class="nsm-profile" style="background-image: url('<?php echo userProfileImage($jb->employee3_employee_id); ?>');" data-img="<?php echo userProfileImage($jb->employee3_employee_id); ?>"></div>                            
                            </div>
                        <?php } ?>
                        <?php if( $jb->employee4_employee_id > 0 ){ ?>
                            <div class="nsm-list-icon primary" style="background-color:#ffffff; justify-content:right;">
                                <div class="nsm-profile" style="background-image: url('<?php echo userProfileImage($jb->employee4_employee_id); ?>');" data-img="<?php echo userProfileImage($jb->employee4_employee_id); ?>"></div>                            
                            </div>
                        <?php } ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="4">
                    <div class="nsm-empty">
                        <span>No upcoming jobs for now.</span>
                    </div>
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>