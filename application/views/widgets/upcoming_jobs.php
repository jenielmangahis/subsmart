<div class="col-lg-3 col-md-6 col-sm-12"  id="widget_<?= $id ?>">
    <div class="card" style="margin-top:0;">
        <div class="card-header">
            <i class="fa fa-calendar" aria-hidden="true"></i> Upcoming jobs
        </div>
        <div class="card-body" style="padding:5px 10px;">
            <div style="height: 310px; overflow-y: scroll">
            <?php
            $jobCounter = 0;
            if ($job) {
                foreach ($job as $jb) :
                    ?>
                    <div class="mb-2 col-lg-12 float-left" style="border-bottom: 1px solid #ccc; padding-bottom: 5px; cursor: pointer">
                        <h6><?= strtoupper(get_format_date_with_day($jb->date_created)); ?></h6>
                        <div class="col-lg-3 float-left no-padding" style="border-right:1px solid #ccc;">
                            <h6 style="font-weight:700; margin:0;"><?php echo strtoupper(get_format_time($jb->date_created)); ?></h6>
                            <div class="job-status"><?php echo strtoupper($jb->status); ?></div>
                            <span class="job-caption text-center">Arrival window</span><br/>
                            <span class="job-caption text-center">
                                <?php echo get_format_time($jb->date_created); ?>-<?php echo get_format_time_plus_hours($jb->date_created); ?>
                            </span>
                        </div>
                        <div class="col-lg-7 float-left" style="padding-right: 0;">
                            <h6 style="font-weight:700; margin:0;"><?php echo strtoupper($jb->job_name); ?></h6>
                            <p style="color: #9d9e9d; "><?php echo strtoupper($jb->job_location); ?></p>
                        </div>
                        <div class="col-lg-2 float-right">
                            <img src="<?= base_url() ?>uploads/users/default.png" alt="user" class="rounded-circle nav-user-img vertical-center">
                        </div>
                    </div>

                    <?php
                endforeach;
            }
            ?>
            </div>
            <div class="text-center">
                <a class="text-info" href="<?= base_url() ?>job">SEE ALL JOBS</a>
            </div>
           
        </div>

    </div>
</div>
