<div class="row" style="height: 250px; overflow-y: scroll">
  <div class="col-lg-10 col-md-10 col-sm-12">
    <?php if ( !empty($events) ) { ?>
      <?php foreach($events as $event) { ?>
        <?php foreach($event as $e){ ?>
          <div class="mb-2 col-lg-12 float-left jobsRow" style="border-bottom: 1px solid #ccc; padding-bottom: 5px; cursor: pointer">
              <div class="col-lg-3 float-left no-padding text-center" style="border-right:1px solid #ccc; padding-right:5px;">
                  <time style="font-size: 10px; text-align: left;" datetime="2021-02-09" class="icon-calendar-live">
                      <em><?= date('D', strtotime($jb->date_created)) ?></em>
                      <strong><?= date('M', strtotime($jb->date_created)) ?></strong>
                      <span><?= date('d', strtotime($jb->date_created)) ?></span>
                  </time>
                  <!-- <div class="job-status text-center mb-2" style="background:<?= $e['event_color']; ?>; color:white;"><?php echo strtoupper($jb->status); ?></div> -->                  
                  <span class="job-caption text-center" style="font-weight:700; color: black; font-family: Sarabun, sans-serif !important; font-size:12px">
                      <?php if( $e['start_time'] == $e['end_time'] ){ ?>
                        <?= date("g:i A",strtotime($e['start_time'])); ?>
                      <?php }else{ ?>
                        <?= date("g:i A",strtotime($e['start_time'])) . ' - ' . date("g:i A",strtotime($e['end_time'])); ?>
                      <?php } ?>                      
                  </span>
              </div>
              <div class="col-lg-7 float-left mt-2" style="padding-right: 0;">
                  <h6 style="font-weight:700; margin:0;"><?php echo strtoupper($e['what_of_even'] . ' - ' . $e['event_description']); ?></h6>
                  <p style="color: #9d9e9d;font-weight: 700; margin-bottom: 0; "><?php echo strtoupper($e['event_title']); ?></p>
                  <?php if( trim($e['address']) != '' ){ ?>
                    <p style="color: #9d9e9d; "><?php echo ucwords(strtolower($e['address'])); ?></p>
                  <?php } ?>
                  
              </div>
              <div class="col-lg-2 float-right" style="margin-top:40px !important; ">
                  <img src="<?= base_url() ?>uploads/users/default.png" alt="user" class="rounded-circle nav-user-img vertical-center">
              </div>
          </div>
        <?php } ?>
      <?php } ?>
    <?php }else{ ?>
      <div class="cue-event-name">NO UPCOMING EVENTS</div>
    <?php } ?>
  </div>
</div>

