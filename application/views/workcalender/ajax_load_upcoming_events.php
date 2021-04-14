<div class="row" style="height: 240px; overflow-y: auto;">
  <div class="col-lg-12 col-md-12 col-sm-12">
    <?php if ( !empty($events) ) { ?>
      <?php foreach($events as $event) { ?>
        <?php foreach($event as $e){ ?>
          <div class="mb-2 col-lg-12 float-left jobsRow" style="border-bottom: 1px solid #ccc; padding-bottom: -1px; cursor: pointer">
              <div class="col-20 float-left no-padding text-center" style="min-height:130px;border-right:1px solid #ccc; padding-right:5px;">
                  <time style="font-size: 10px; text-align: left;" datetime="2021-02-09" class="icon-calendar-live">
                      <em><?= date('D', strtotime($e['start_date'])) ?></em>
                      <strong style="background-color: #58c04e;"><?= date('M', strtotime($e['start_date'])) ?></strong>
                      <span><?= date('d', strtotime($e['start_date'])) ?></span>
                  </time>
                  <!-- <div class="job-status text-center mb-2" style="background:<?= $e['event_color']; ?>; color:white;"><?php echo strtoupper($jb->status); ?></div> -->
                  <span class="job-caption text-center" style="font-weight:700; color: black; font-family: Sarabun, sans-serif !important; font-size:11px">
                      <?php if( $e['start_time'] == $e['end_time'] ){ ?>
                        <?= date("g:i A",strtotime($e['start_time'])); ?>
                      <?php }else{ ?>
                        <?= date("g:i A",strtotime($e['start_time'])) . ' - ' . date("g:i A",strtotime($e['end_time'])); ?>
                      <?php } ?>
                  </span>
              </div>
              <div class="col-lg-7 float-left mt-2" style="padding-right: 0;text-align: left;">
                <?php if( $e['type'] == 'g-events' ){ ?>
                  <a href="javascript:void(0);" class="uevent-view-details" data-event-id="<?= $e['event_id']; ?>">
                <?php }else{ ?>
                  <a href="<?= base_url("events/event_preview/" . $e['event_id']) ?>" class="">
                <?php } ?>

                  <input type="hidden" id="<?= $e['event_id']; ?>-event-type" value="<?= $e['type']; ?>" />
                  <input type="hidden" id="<?= $e['event_id']; ?>-event-title" value="<?= $e['event_title']; ?>" />
                  <input type="hidden" id="<?= $e['event_id']; ?>-event-start-date" value="<?= $e['start_date']; ?>" />
                  <input type="hidden" id="<?= $e['event_id']; ?>-event-end-date" value="<?= $e['end_date']; ?>" />
                  <?php if($e['type'] == 'events'){ ?>
                    <h6 style="color:black;font-weight:700; margin:0;font-size: 14px;text-transform: uppercase;"><?php echo $e['event_number'] . ' : ' . $e['event_type']. ' - ' . $e['event_tag']; ?></h6>
                  <?php }else{ ?>
                    <h6 style="color:black;font-weight:700; margin:0;font-size: 14px;text-transform: uppercase;"><?php echo $e['event_type']; ?></h6>
                  <?php } ?>

                      <?php if(!empty($settings['work_order_show_customer']) && $settings['work_order_show_customer'] == 1): ?>
                          <b  style="color:#45a73c;">
                              <?= $e['first_name']. ' '. $e['last_name']; ?>
                          </b><br>
                      <?php endif; ?>

                  <p style="color: #9d9e9d;font-weight: 700; margin-bottom: 0; "><?php echo strtoupper($e['event_title']); ?></p>
                  <?php if( trim($e['address']) != '' ){ ?>
                      <?php if(!empty($settings['work_order_show_details']) && $settings['work_order_show_details'] == 1): ?>
                    <small style="color: #9d9e9d; "><?php echo ucwords(strtolower($e['address'])); ?></small><br>
                      <i> <small class="text-muted" ><?= $e['event_description']; ?></small></i><br>
                      <?php endif; ?>
                      <?php if(!empty($settings['work_order_show_link']) && $settings['work_order_show_link'] == 1): ?>
                      <a href="<?=$e['url_link']; ?>" target=""><small style="color: darkred;"><?=$e['url_link']; ?></small></a>
                      <?php endif; ?>
                  <?php } ?>
                </a>
              </div>
              <div class="col-lg-1 float-right" style="margin-top:40px !important; ">
                  <img style="position: absolute;width: 40px;" src="<?= base_url() ?>uploads/users/user-profile/<?=$e['profile_img']; ?>" onerror="this.onerror=null;this.src='<?= base_url() ?>uploads/users/default.png';"  alt="user" class="rounded-circle nav-user-img vertical-center">
              </div>
          </div>
        <?php } ?>
      <?php } ?>
    <?php }else{ ?>
      <div class="cue-event-name no-data">NO UPCOMING EVENTS</div>
    <?php } ?>
  </div>
</div>

<script>
$(function(){
  $(".uevent-view-details").click(function(){
    var event_id     = $(this).attr("data-event-id");
    var event_type   = $("#" + event_id + "-event-type").val();
    var event_title  = $("#" + event_id + "-event-title").val();
    var event_start_date = $("#" + event_id + "-event-start-date").val();
    var event_end_date   = $("#" + event_id + "-event-end-date").val();

    var message = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" /> Loading...</div>';

    $("#modalEventDetails").modal('show');
    $('#modalEventDetails .modal-body').html("loading...");

    if( event_type == 'events' ){
      var url = base_url + 'event/modal_details/' + event_id;
      $.ajax({
          url: url,
          data: '',
          beforeSend: function () {
              $('.tiva-calendar').html('<div class="loading"><img src="./assets/img/loading.gif" /></div>');
          },
          success: function (response) {

              // console.log(response);
              $(".btn-event-edit").show();
              $(".btn-event-delete").show();
              $(".btn-event-edit-workorder").show();
              $("#modalEventDetails").find('.modal-body').html(response);
          }
      });
    }else{
      var url = base_url + 'workcalender/modal_gevent_details';
      var gData = {
        'gevent_id' : event_id,
        'title' : event_title,
        'start_date' : event_start_date,
        'end_date' : event_end_date,
      };

      $.ajax({
          url: url,
          type: "POST",
          data: gData,
          beforeSend: function () {
              $('.tiva-calendar').html('<div class="loading"><img src="./assets/img/loading.gif" /></div>');
          },
          success: function (response) {

              // console.log(response);
              $(".btn-event-edit").hide();
              $(".btn-event-delete").hide();
              $(".btn-event-edit-workorder").hide();
              $("#modalEventDetails").find('.modal-body').html(response);
          }
      });

    }
  });
});
</script>
