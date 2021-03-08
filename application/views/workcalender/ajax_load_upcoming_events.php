<div class="row" style="height: 140px; overflow-y: auto;">
  <div class="col-lg-12 col-md-12 col-sm-12">
    <?php if ( !empty($events) ) { ?>
      <?php foreach($events as $event) { ?>
        <?php foreach($event as $e){ ?>
          <div class="mb-2 col-lg-12 float-left jobsRow" style="border-bottom: 1px solid #ccc; padding-bottom: -1px; cursor: pointer">
              <div class="col-20 float-left no-padding text-center" style="min-height:130px;border-right:1px solid #ccc; padding-right:5px;">
                  <time style="font-size: 10px; text-align: left;" datetime="2021-02-09" class="icon-calendar-live">
                      <em><?= date('D', strtotime($e['start_date'])) ?></em>
                      <strong><?= date('M', strtotime($e['start_date'])) ?></strong>
                      <span><?= date('d', strtotime($e['start_date'])) ?></span>
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
                <?php if( $e['type'] == 'g-events' ){ ?>
                  <a href="javascript:void(0);" class="uevent-view-details" data-event-id="<?= $e['event_id']; ?>">
                <?php }else{ ?>
                  <a href="<?= base_url("events/event_preview/" . $e['event_id']) ?>" class="">
                <?php } ?>
                
                  <input type="hidden" id="<?= $e['event_id']; ?>-event-type" value="<?= $e['type']; ?>" />
                  <input type="hidden" id="<?= $e['event_id']; ?>-event-title" value="<?= $e['event_title']; ?>" />
                  <input type="hidden" id="<?= $e['event_id']; ?>-event-start-date" value="<?= $e['start_date']; ?>" />
                  <input type="hidden" id="<?= $e['event_id']; ?>-event-end-date" value="<?= $e['end_date']; ?>" />
                  <h6 style="color:black;font-weight:700; margin:0;"><?php echo strtoupper($e['what_of_even'] . ' - ' . $e['event_description']); ?></h6>
                  <p style="color: #9d9e9d;font-weight: 700; margin-bottom: 0; "><?php echo strtoupper($e['event_title']); ?></p>
                  <?php if( trim($e['address']) != '' ){ ?>
                    <p style="color: #9d9e9d; "><?php echo ucwords(strtolower($e['address'])); ?></p>
                  <?php } ?>
                </a>
              </div>
              <div class="col-lg-2 float-right">
                  <img src="<?= base_url() ?>uploads/users/default.png" alt="user" class="rounded-circle nav-user-img vertical-center events">
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
