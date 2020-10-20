<?php if ( !empty($event) ) { ?>
<div class="row">
    <div class="col-md-8 col-xs-16">
        <div class="margin-bottom-sec">
            <div class="bold margin-bottom-sec" style="font-size: 18px; font-weight: 500;">Test meeting</div>
            <a class="customer-avatar" href="https://www.markate.com/pro/track/customers/preview/id/492270"> <img class="customer-avatar-img" src="<?php echo base_url('./assets/img/customer_sm.png') ?>">
                <?php echo get_customer_by_id($event->customer_id)->contact_name ?><br>
                <?php echo get_customer_by_id($event->customer_id)->contact_email ?><br>
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
                <!-- Saturday, 14 Mar 2020, 10:00 am to 11:30 am<br> <span class="text-ter">Central Time (UTC -5)</span> -->
            <?php } ?>


        </div>

        <div class="margin-bottom-sec">
            <div class="text-ter text-sm">NOTIFICATION</div>
            <?php echo ($event->notify_at) ? get_notification_details($event->notify_at) : "None" ?>
        </div>

    </div>
    <!-- <div class="col-md-4 col-xs-8 text-left">
        <ul class="calendar-modal-export">
            <li>
                <div class="text-ter text-sm">ADD TO</div>
            </li>
            <li><a class="a-default" href="https://www.markate.com/public/pros/events/export?type=ical&amp;hash=a38a274d272d177eee455721a2de6379:158454:a7a384" target="_blank"><img src="/assets/images/app/pro/track/events/export_ical.png"> <span>Apple Calendar</span></a></li>
            <li><a class="a-default" href="https://www.google.com/calendar/event?action=TEMPLATE&amp;text=Test+meeting&amp;dates=20200314T100000%2F20200314T113000&amp;details=Customer%3A+Test+Customer&amp;location=" target="_blank"><img src="/assets/images/app/pro/track/events/export_google.png"> <span>Google Calendar</span></a></li>
            <li><a class="a-default" href="https://www.markate.com/public/pros/events/export?type=outlook&amp;hash=a38a274d272d177eee455721a2de6379:158454:a7a384" target="_blank"><img src="/assets/images/app/pro/track/events/export_outlook.png"> <span>Outlook Calendar</span></a></li>
        </ul>
    </div> -->
    <input type="hidden" name="hid_event_id" value="<?php echo $event->id ?>">
</div>

<!-- <div class="margin-bottom-sec">
    <div class="text-ter text-sm">DETAILS</div>
    <table>
        <tbody>
            <tr>
                <td><span class="text-ter">Assigned to:&nbsp;</span></td>
                <td>
                    Alarm Direct </td>
            </tr>
            <tr>
                <td><span class="text-ter">Customer:&nbsp;</span></td>
                <td>
                    Test Customer <span class="middot">·</span> <a href="https://www.markate.com/pro/track/customers/preview/id/492270">view</a>
                </td>
            </tr>
            <tr>
                <td><span class="text-ter">Phone:</span></td>
                <td>
                    - </td>
            </tr>
            <tr>
                <td><span class="text-ter">Address:&nbsp;</span></td>
                <td>
                </td>
            </tr>
        </tbody>
    </table>
</div> -->
<?php } ?>