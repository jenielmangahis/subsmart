<style>
    .jobsRow:hover{
        background: #e8e8fa;
    }
</style>

<!--<div class="<?= $class ?>"  id="widget_<?= $id ?>">
    <div class="card" style="margin-top:0;">
        <div class="card-header" style="background: #6B5B95; color: white;">
            <i class="fa fa-calendar" aria-hidden="true"></i> Upcoming Jobs
        </div>
        <div class="card-body" style="padding:5px 10px;">
            <div style="<?= $height ?> overflow-y: scroll">
<?php
$jobCounter = 0;
if ($job) {
    foreach ($job as $jb) :
        ?>
                                <div class="mb-2 col-lg-12 float-left jobsRow" style="border-bottom: 1px solid #ccc; padding-bottom: 5px; cursor: pointer">

                                    <div class="col-lg-3 float-left no-padding text-center" style="border-right:1px solid #ccc; padding-right:5px;">
                                        <a href="<?php echo base_url('workcalender/'); ?>">
                                        <time style="font-size: 10px; text-align: left;" datetime="2021-02-09" class="icon-calendar-live">
                                            <em><?= date('D', strtotime($jb->date_created)) ?></em>
                                            <strong><?= date('M', strtotime($jb->date_created)) ?></strong>
                                            <span><?= date('d', strtotime($jb->date_created)) ?></span>
                                        </time>
                                        </a>
                                        <div class="job-status text-center mb-2" style="background:<?= $jb->event_color ?>; color:white;"><?php echo strtoupper($jb->status); ?></div>
                                        <span style="font-family: Sarabun, sans-serif !important;color: #9d9e9d;font-weight: 700;" class="text-center">ARRIVAL WINDOW</span><br/>
                                        <span class="job-caption text-center" style="font-weight:700; color: black; font-family: Sarabun, sans-serif !important; font-size:12px">
        <?php echo get_format_time($jb->date_created); ?>-<?php echo get_format_time_plus_hours($jb->date_created); ?>
                                        </span>
                                    </div>
                                    <div class="col-lg-7 float-left mt-2" style="padding-right: 0;">
                                        <a href="<?php echo base_url('job/job_preview/' . $jb->id); ?>">
                                            <h6 style="font-weight:700; margin:0;"><?php echo strtoupper($jb->job_type . ' - ' . $jb->job_description); ?></h6>                                
                                            <p style="color: #9d9e9d;font-weight: 700; margin-bottom: 0; "><?php echo strtoupper($jb->job_name); ?></p>
                                            <p style="color: #9d9e9d; "><?php echo ucwords(strtolower($jb->job_location)); ?></p>
                                        </a>
                                    </div>
                                    <div class="col-lg-2 float-right" style="margin-top:40px !important; ">
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
</div>-->
<div class="<?= $class ?>"  id="widget_<?= $id ?>">
    <div  style="width: 300px; border: 1px solid #58c04e; background: #58c04e; color:white;  border-radius: 10px; text-align: center;padding: 5px;position: relative;margin: 0 auto;top: 21px;z-index: 1000;">
        <i class="fa fa-calendar" aria-hidden="true"></i> Upcoming Jobs
    </div>
    <div class="card" style="border: 2px solid #30233d; margin-top:0; border-radius: 40px; padding:5px;">
        <div style="border: 5px solid #30233d; margin-top:0; border-radius: 40px; box-shadow: 1px 0px 15px 5px rgb(48, 35, 61);">
            <div class="card-body mt-3" style="padding:5px 10px; height: 300px;">
                <div style="<?= $height ?> overflow-y: scroll">
                    <?php
                    $jobCounter = 0;
                    if ($job) {
                        foreach ($job as $jb) :
                            ?>
                            <div class="mb-2 col-lg-12 float-left jobsRow" style="border-bottom: 1px solid #ccc; padding-bottom: 5px; cursor: pointer">

                                <div class="col-lg-3 float-left no-padding text-center" style="border-right:1px solid #ccc; padding-right:5px;">
                                    <a href="<?php echo base_url('workcalender/'); ?>">
                                        <time style="font-size: 10px; text-align: left;" datetime="2021-02-09" class="icon-calendar-live">
                                            <em><?= date('D', strtotime($jb->start_date)) ?></em>
                                            <strong style="background-color: #32243d;"><?= date('M', strtotime($jb->start_date)) ?></strong>
                                            <span><?= date('d', strtotime($jb->start_date)) ?></span>
                                        </time>
                                    </a>
                                    <div class="job-status text-center mb-2" style="background:<?= $jb->event_color ?>; color:white;"><?php echo strtoupper($jb->status); ?></div>
                                    <span style="font-family: Sarabun, sans-serif !important;color: #9d9e9d;font-weight: 700;font-size: 10px;" class="text-center">ARRIVAL TIME</span><br/>
                                    <span class="job-caption text-center" style="font-weight:700; color: black; font-family: Sarabun, sans-serif !important; font-size:10px">
                                        <?php echo get_format_time($jb->date_created); ?>-<?php echo get_format_time_plus_hours($jb->date_created); ?>
                                    </span>
                                </div>
                                <div class="col-lg-7 float-left mt-2" style="padding-right: 0;">
                                    <a href="<?php echo base_url('job/job_preview/' . $jb->id); ?>">
                                        <h6 style="font-weight:600; margin:0;font-size: 13px;"><?php echo $jb->job_number . ' : ' . $jb->job_type. ' - ' . $jb->tags_name; ?></h6>
                                        <b class="text-muted">
                                            <?= $jb->first_name. ' '. $jb->last_name; ?>
                                        </b><br>
                                       <small class="text-muted" ><?= $jb->mail_add .' '. $jb->cust_city.' '.$jb->cust_state.' '.$jb->cust_zip_code; ?></small><br>
                                       <i> <small class="text-muted" ><?= $jb->job_description; ?></small></i>
                                        <a href="<?=$jb->link; ?>" target=""><small style="color: darkred;"><?=$jb->link; ?></small></a>
                                    </a>
                                </div>
                                <div class="col-lg-2 float-right" style="margin-top:40px !important; ">
                                    <img style="position: absolute;width: 40px;" src="<?= base_url() ?>uploads/users/user-profile/<?= $jb->profile_img; ?>" onerror="this.onerror=null;this.src='<?= base_url() ?>uploads/users/default.png';" alt="user" class="rounded-circle nav-user-img vertical-center">
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
</div>
