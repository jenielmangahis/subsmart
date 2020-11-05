<?php if ( !empty($upcoming_events) ) { ?>
  <?php foreach($upcoming_events as $upcoming_event) { ?>
    <div class="cue-event" data-calendar="view-event" data-calendar-event-id="<?php echo $upcoming_event->id; ?>" style="padding:10px; border: 1px solid;box-shadow: 3px 4px #888888;background-color: #e6e6e6;">
        <?php 
          $month = date('m', strtotime($upcoming_event->start_date));
          $day  = date('d', strtotime($upcoming_event->start_date));
          $year  = date('Y', strtotime($upcoming_event->start_date));
          $start_time = $upcoming_event->start_time;
          $end_time = $upcoming_event->end_time;
        ?>
        <div class="cue-event-name" style="font-size:20px;">
            <?php echo get_customer_by_id($upcoming_event->customer_id)->contact_name; ?><br />
            <span style="font-size: 13px;"><i class="fa fa-calendar"></i> <?= date('F j, Y', strtotime($upcoming_event->start_date)) ?> - <?php echo $start_time; ?> - <?php echo $end_time; ?></span>
        </div> 

        <?php if( $upcoming_event->event_description != '' ){ ?>
          <div class="upcoming-event-description" style="margin-top: 15px; margin-bottom: 15px;">
            <?= $upcoming_event->event_description ?>
          </div>
        <?php } ?>
    </div>     
    <hr /> 
  <?php } ?>
<?php }else{ ?>
        <div class="cue-event-name">NO UPCOMING EVENTS</div>
<?php } ?>