<?php if ( !empty($event) ) { ?>
    <div class="row">
        <div class="col-md-8" style="text-align: left;">
        	<?php if( $event->customer_id ){ ?>
            <div class="margin-bottom-sec">
                <div class="bold margin-bottom-sec" style="font-size: 18px; font-weight: 500;">
                    <?php //echo !empty($event->event_description) ? $event->event_description : '-'; ?>
                    <?php echo !empty($event->description) ? $event->description : '-'; ?>
                </div>
                <a class="customer-avatar" href="javascript:void(0);"> 
                    <img class="customer-avatar-img" src="<?php echo base_url('assets/img/customer_sm.png') ?>">
                    <?php 
                        $customer = acs_prof_get_customer_by_prof_id($event->customer_id);
                    ?>
                    <?php echo $customer->first_name . ' ' . $customer->last_name; ?><br />
                    <?php echo $customer->email; ?>
                    <br> <br>
                </a>
            </div>
        	<?php } ?>

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

            <?php if($event->event_location != ''){ ?>
                <div class="margin-bottom-sec">
                    <div class="text-ter text-sm">LOCATION</div>   
                    <span><?= $event->event_location; ?></span>
                </div>
            <?php } ?>

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
                    <?php 
                        $event_date_from = date("Ymd\THis\Z", strtotime($event->start_date . ' ' . $event->start_time));
                        $event_date_to   = date("Ymd\THis\Z", strtotime($event->end_date . ' ' . $event->end_time));
                        if( $event->customer_id ){
                        	if( $event->description != '' ){
	                            $details = get_customer_by_id($event->customer_id)->contact_name . " - " . $event->description;
	                        }else{  
	                            $details = get_customer_by_id($event->customer_id)->contact_name;
	                        }
                        }else{
                        	$details = $event->description;
                        }
                                                

                        $url_add_google_event = "https://www.google.com/calendar/event?action=TEMPLATE&text=".$event->description."&dates=".$event_date_from."/".$event_date_to."&details=".$details."&location=";
                    ?>
                    <!-- <img src="<?php echo base_url('assets/img/export_google.png') ?>"> -->
                    <ul>
                        <li>
                            <a class="a-default" href="<?= $url_add_google_event; ?>" target="_blank" style="font-size: 21px;">
                                <span class="badge badge-primary" style="padding-top: 10px;padding-bottom:10px;padding-left:10px;width: 166px;text-align: left;"><i class="fa fa-calendar"></i> Google Calendar</span>
                            </a>
                        </li>
                        <li>
                            <a class="a-default" href="<?= base_url("/event/import_outlook_calendar/".$event->id); ?>" target="_blank" style="font-size: 21px;">
                                <span class="badge badge-primary" style="padding-top: 10px;padding-bottom:10px;padding-left:10px;width: 166px;text-align: left;"><i class="fa fa-calendar"></i> Outlook Calendar</span>
                            </a>
                        </li>
                        <li>
                            <a class="a-default" href="<?= base_url("/event/import_outlook_calendar/".$event->id); ?>" target="_blank" style="font-size: 21px;">
                                <span class="badge badge-primary" style="padding-top: 10px;padding-bottom:10px;padding-left:10px;width: 166px;text-align: left;"><i class="fa fa-calendar"></i> Apple Calendar</span>
                            </a>
                        </li>
                    </ul>
                    
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