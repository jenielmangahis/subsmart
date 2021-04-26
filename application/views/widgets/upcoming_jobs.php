<style>
    .jobsRow:hover{
        background: #e8e8fa;
    }
</style>

<div class="<?= $class ?>"  data-id="<?= $id ?>" id="widget_<?= $id ?>">
    <div  class="wid_header">
        <i class="fa fa-calendar" aria-hidden="true"></i> Upcoming Jobs
        
        <div class="float-right">
            <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                <span type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                    &nbsp;<span class="fa fa-ellipsis-v"></span></span>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#" class="dropdown-item" onclick="removeWidget('<?= $id ?>')">Close</a></li>
                    <li><a href="#" class="dropdown-item" onclick="addToMain('<?= $id ?>',<?php echo ($isMain?'1':'0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain?'Remove From Main':'Add to Main') ?></a></li>
                    <li><a href="#" class="dropdown-item">Move</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card" style="border: 2px solid #30233d; margin-top:0; border-radius: 40px; padding:5px;">
        <div style="border: 5px solid #30233d; margin-top:0; border-radius: 40px; box-shadow: 1px 0px 15px 5px rgb(48, 35, 61);">
            <div class="card-body mt-3" style="padding:5px 10px; height: <?= $rawHeight ?>px;">
                <div style="height: <?= $rawHeight-40 ?>px; overflow-y: scroll">
                    <?php
                    $jobCounter = 0;
                    if ($upcomingJobs) {
                        foreach ($upcomingJobs as $jb) :
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
                                        <b style="color:#45a73c;">
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
