<div class="row" style="height: 250px; overflow-y: scroll">
  <div class="col-lg-10 col-md-10 col-sm-12">
    <?php if ( !empty($upcomingJobs) ) { ?>
      <?php foreach($upcomingJobs as $jb){ ?>
        <div class="mb-2 col-lg-12 float-left jobsRow" style="border-bottom: 1px solid #ccc; padding-bottom: 5px; cursor: pointer">
            <div class="col-lg-3 float-left no-padding text-center" style="border-right:1px solid #ccc; padding-right:5px;">
                <a href="<?php echo base_url('workcalender/'); ?>">
                <time style="font-size: 10px; text-align: left;" datetime="2021-02-09" class="icon-calendar-live">
                    <em><?= date('D', strtotime($jb->start_date)) ?></em>
                    <strong><?= date('M', strtotime($jb->start_date)) ?></strong>
                    <span><?= date('d', strtotime($jb->start_date)) ?></span>
                </time>
                </a>
                <div class="job-status text-center mb-2" style="background:<?= $jb->event_color?>; color:white;"><?php echo strtoupper($jb->status); ?></div>
                <span style="font-family: Sarabun, sans-serif !important;color: #9d9e9d;font-weight: 700;" class="text-center">ARRIVAL WINDOW</span><br/>
                <span class="job-caption text-center" style="font-weight:700; color: black; font-family: Sarabun, sans-serif !important; font-size:12px">
                    <?php echo get_format_time($jb->start_time); ?>-<?php echo get_format_time_plus_hours($jb->end_time); ?>
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
      <?php } ?>
    <?php }else{ ?>
      <div class="cue-event-name">NO UPCOMING JOBS</div>
    <?php } ?>
  </div>
</div>
