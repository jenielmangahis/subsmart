<style>
.nsm-date {
    /*display: block;*/
    width: 73px;
    height: 73px;
    /*margin: 26px auto;*/
    background: #fff;
    text-align: center;
    font-family: 'Helvetica', sans-serif;
    position: relative;
    display: inline-block;
    margin-bottom: 9px;
}

.nsm-date .binds {
    position: absolute;
    height: 15px;
    width: 60px;
    background: transparent;
    border: 2px solid #999;
    border-width: 0 5px;
    top: -6px;
    left: 0;
    right: 0;
    margin: auto;
}

.nsm-date .month {
    background: #6A4A86;
    display: block;
    padding: 8px 0;
    color: #fff;
    font-size: 12px;
    font-weight: bold;
    /*border-bottom: 2px solid #333;*/
    /*box-shadow: inset 0 -1px 0 0 #666;*/
}

.nsm-date .day {
    display: block;
    margin: 0;
    padding: 6x 0;
    font-size: 27px;
    background-color: #DAD1E0;
    /*box-shadow: 0 0 3px #ccc;*/
    position: relative;
}

.nsm-date .day::after {
    content: '';
    display: block;
    height: 100%;
    width: 96%;
    position: absolute;
    top: 3px;
    left: 2%;
    z-index: -1;
    box-shadow: 0 0 3px #ccc;
}

.nsm-date .day::before {
    content: '';
    display: block;
    height: 100%;
    width: 90%;
    position: absolute;
    top: 6px;
    left: 5%;
    z-index: -1;
    box-shadow: 0 0 3px #ccc;
}
.nsm-calendar-container{
    display: inline-block;
}
.nsm-calendar-info-container{
    display: inline-block;
    width: 119px;
}
.vl {
    border-left: 2px solid #6A4A86;
    height: 82px;
    display: inline-block;
    margin-left: 14px;
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
                        <div class="nsm-list-icon primary">                            
                            <div class="nsm-profile" style="background-image: url('<?php echo userProfileImage($jb->e_employee_id); ?>');" data-img="<?php echo $data_img; ?>"></div>                            
                        </div>
                    </td>
                    <td>
                        <label class="content-title" style="cursor: pointer">                            
                            <?php 
                                $tags = '';
                                if( $jb->tags_name != '' ){
                                    $tags = ' - ' . $jb->tags_name;
                                }

                                echo $jb->job_number . ' : ' . $jb->job_type . $tags;
                            ?>        
                        </label>
                        <?php //if (!empty($settings['work_order_show_customer']) && $settings['work_order_show_customer'] == 1) : ?>
                            <!-- <label class="content-subtitle d-block mb-1" style="cursor: pointer"><?= $event->event_description; ?></label> -->
                        <?php //endif; ?>
                        <?php if (!empty($settings['work_order_show_details']) && $settings['work_order_show_details'] == 1) : ?>
                            <label class="content-subtitle d-block" style="cursor: pointer"><?= $jb->job_description; ?></label>
                        <?php endif; ?>
                        <?php if (!empty($settings['work_order_show_price']) && $settings['work_order_show_price'] == 1) : ?>
                            <label class="content-subtitle d-block" style="cursor: pointer;margin-top: 10px; font-weight: bold;">Total Amount : $<?= number_format((float)$jb->job_total_amount, 2, '.', ','); ?></label>
                        <?php endif; ?>
                    </td>
                    <td class="text-end">
                            <?php 
                                $event_month = date("F", strtotime($jb->start_date));
                                $event_day   = date("d", strtotime($jb->start_date));
                            ?>
                            <div class="nsm-calendar-container">
                                <div class="nsm-date">
                                    <span class="binds"></span>
                                    <span class="month"><?= $event_month; ?></span>
                                    <h1 class="day"><?= $event_day; ?></h1>
                                </div>
                                <!-- <div class="vl"></div> -->
                            </div>
                            <div class="nsm-calendar-info-container" style="text-align:center;">
                                <span class="nsm-badge primary"><?php echo strtoupper($jb->status); ?></span>
                                <label class="content-subtitle mt-1 d-block text-uppercase" style="cursor: pointer"><?php echo $jb->start_time; ?>-<?php echo $jb->end_time; ?></label>
                            </div>
                        </div>
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