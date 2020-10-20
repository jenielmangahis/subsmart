<?php if ( !empty($event) ) { ?>
    <div class="row">
        <div class="col-md-8" style="text-align: left;">
            <div class="margin-bottom-sec">
                <div class="bold margin-bottom-sec" style="font-size: 18px; font-weight: 500;">
                    <?php //echo !empty($event->event_description) ? $event->event_description : '-'; ?>
                    <?php echo !empty($event->description) ? $event->description : '-'; ?>
                </div>
                <a class="customer-avatar" href="javascript:void(0);"> 
                    <img class="customer-avatar-img" src="<?php echo base_url('assets/img/customer_sm.png') ?>">
                    <?php echo get_customer_by_id($event->customer_id)->contact_name ?><br />
                    <?php echo get_customer_by_id($event->customer_id)->contact_email ?>
                    <br> <br>
                </a>
            </div>

            <div class="margin-bottom-sec">
                <div class="text-ter text-sm">WHEN (MY TIMEZONE)</div>       
                <?php if ( date('d', strtotime($event->start_date)) == date('d', strtotime($event->end_date)) ) { ?>
                    <?php echo date('l, d M Y', strtotime($event->start_date)) ?>, <?php echo $event->start_time ?> to <?php echo $event->end_time ?> <br> <span class="text-ter"></span>
                <?php } else { ?>
                    <span>From</span>
                    <?php echo date('l, d M Y', strtotime($event->start_date)) ?>, <?php echo $event->start_time ?> to <?php echo $event->end_time ?> <br> <span class="text-ter"></span>
                    <br>
                    <span>From</span>
                    <?php echo date('l, d M Y', strtotime($event->end_date)) ?>, <?php echo $event->start_time ?> to <?php echo $event->end_time ?> <br> <span class="text-ter"></span>
                <?php } ?>

            </div>

            <div class="margin-bottom-sec">
                <div class="text-ter text-sm">NOTIFICATION</div>
                <?php echo ($event->notify_at) ? get_notification_details($event->notify_at) : "None" ?>         
            </div>
            
            <div class="margin-bottom-sec">
                <div class="text-ter text-sm">NOTES</div>
                <?php echo !empty($event->instructions) ? $event->instructions : '-'; ?> 
            </div>
        </div>

        <div class="col-md-4">
            <ul class="calendar-modal-export">
                <li style="text-align: left;"><div class="text-ter text-sm">ADD TO</div></li>
                <!-- <li>
                    <a class="a-default" href="javascript:void(0);" target="_blank">
                        <img src="/assets/images/app/pro/track/events/export_ical_apple.png"> 
                        <span>Apple Calendar</span>
                    </a>
                </li> -->
                <li style="text-align: left !important;">
                    <!-- <img src="<?php echo base_url('assets/img/export_google.png') ?>"> -->
                    <a class="a-default" href="javascript:void(0);" target="_blank">
                        <span class="badge badge-primary">+ Google Calendar</span>
                    </a>
                </li>
                <!-- <li>
                    <a class="a-default" href="javascript:void(0);" target="_blank">
                        <img src="/assets/images/app/pro/track/events/export_outlook.png"> 
                        <span>Outlook Calendar</span>
                    </a>
                </li> -->
            </ul>
        </div>
        <input type="hidden" name="hid_event_id" value="<?php echo $event->id ?>">
    </div>
<?php } ?>