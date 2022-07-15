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
                            <i class='bx bx-calendar-star'></i>
                        </div>
                    </td>
                    <td>
                        <label class="content-title" style="cursor: pointer"><?php echo $jb->job_number . ' : ' . $jb->job_type . ' - ' . $jb->tags_name; ?></label>
                        <?php if (!empty($settings['work_order_show_customer']) && $settings['work_order_show_customer'] == 1) : ?>
                            <label class="content-subtitle d-block mb-1" style="cursor: pointer"><?= $event->event_description; ?></label>
                        <?php endif; ?>
                        <?php if (!empty($settings['work_order_show_details']) && $settings['work_order_show_details'] == 1) : ?>
                            <label class="content-subtitle d-block" style="cursor: pointer"><?= $jb->job_description; ?></label>
                        <?php endif; ?>
                        <?php if (!empty($settings['work_order_show_price']) && $settings['work_order_show_price'] == 1) : ?>
                            <label class="content-subtitle d-block" style="cursor: pointer">Amount : $ <?= number_format((float)$jobs_total_amount[$jb->id], 2, '.', ','); ?></label>
                        <?php endif; ?>
                    </td>
                    <td class="text-end">
                        <span class="nsm-badge primary"><?php echo strtoupper($jb->status); ?></span>
                        <label class="content-subtitle mt-1 d-block text-uppercase" style="cursor: pointer"><?= date('M-d-Y', strtotime($jb->start_date)) ?> | <?php echo $jb->start_time; ?>-<?php echo $jb->end_time; ?></label>
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