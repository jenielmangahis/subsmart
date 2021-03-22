<div class="row" style="height: 250px; overflow-y: auto;">
  <div class="col-lg-12 col-md-12 col-sm-12">
    <?php if ( !empty($upcomingJobs) ) { ?>
      <?php foreach($upcomingJobs as $jb){ ?>
        <div class="mb-2 col-lg-12 float-left jobsRow" style="border-bottom: 1px solid #ccc; padding-bottom: -1px; cursor: pointer">
            <div class="col-20 float-left no-padding text-center" style="border-right:1px solid #ccc; padding-right:5px;">
                <a href="<?php echo base_url('workcalender/'); ?>">
                <time style="font-size: 10px; text-align: left;" datetime="2021-02-09" class="icon-calendar-live">
                    <em><?= date('D', strtotime($jb->start_date)) ?></em>
                    <strong style="background-color: #58c04e;"><?= date('M', strtotime($jb->start_date)) ?></strong>
                    <span><?= date('d', strtotime($jb->start_date)) ?></span>
                </time>
                </a>
                <div class="job-status text-center mb-2" style="background:<?= $jb->event_color?>; color:#ffffff;"><b><?php echo strtoupper($jb->status); ?></b></div>
                <span style="font-family: Sarabun, sans-serif !important;color: #9d9e9d;font-weight: 700;font-size: 10px;" class="text-center">ARRIVAL TIME</span><br/>
                <span class="job-caption text-center" style="font-weight:700; color: black; font-family: Sarabun, sans-serif !important; font-size:12px">
                    <?php echo get_format_time($jb->start_time); ?>-<?php echo get_format_time_plus_hours($jb->end_time); ?>
                </span>
            </div>
            <div class="col-lg-7 float-left mt-2" style="padding-right: 0;text-align: left;">
                <a style="color: #000!important;" href="<?php echo base_url('job/job_preview/' . $jb->id); ?>">
                    <h6 style="font-weight:600; margin:0;font-size: 13px;"><?php echo $jb->job_number . ' : ' . $jb->job_type. ' - ' . $jb->tags_name; ?></h6>
            <?php if(!empty($settings['work_order_show_customer']) && $settings['work_order_show_customer'] == 1): ?>
                    <b class="text-muted">
                        <?= $jb->first_name. ' '. $jb->last_name; ?>
                    </b><br>
            <?php endif; ?>
                    <?php if(!empty($settings['work_order_show_details']) && $settings['work_order_show_details'] == 1): ?>
                        <small class="text-muted" ><?= $jb->mail_add .' '. $jb->cust_city.' '.$jb->cust_state.' '.$jb->cust_zip_code; ?></small><br>
                        <i> <small class="text-muted" ><?= $jb->job_description; ?></small></i><br>
                    <?php endif; ?>
                    <?php if(!empty($settings['work_order_show_price']) && $settings['work_order_show_price'] == 1): ?>
                         Amount : <small>$<?= $jb->amount; ?></small>
                    <?php endif; ?>
                    <?php if(!empty($settings['work_order_show_link']) && $settings['work_order_show_link'] == 1): ?>
                        <a href="<?=$jb->link; ?>" target=""><small style="color: darkred;"><?=$jb->link; ?></small></a>
                    <?php endif; ?>
                </a>
            </div>
            <div class="col-lg-1 float-right">
                <img style="position: absolute;width: 40px;" src="<?= base_url() ?>uploads/users/user-profile/<?= $jb->profile_img; ?>" onerror="this.onerror=null;this.src='<?= base_url() ?>uploads/users/default.png';" alt="user" class="rounded-circle nav-user-img vertical-center">
            </div>
        </div>
      <?php } ?>
    <?php }else{ ?>
      <div class="cue-event-name no-data">NO UPCOMING JOBS</div>
    <?php } ?>
  </div>
</div>
<style>
    .job-status {
        width: 100%;
        background: #32243d;
        color: #ffffff;
        text-align: center;
        font-size: 12px;
        line-height: 1.5;
        margin-top: 10px;
    }
</style>
