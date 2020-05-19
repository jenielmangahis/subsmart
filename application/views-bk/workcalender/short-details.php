<!-- <div class="close-details">X</div>
<table>
<tr>
<td><h6><?php echo 'WO-00' . $workorder->id ?></h6></td>
</tr>
<tr>
<td><small><?php echo date('d M, Y h:i:s', strtotime($workorder->workorder_date)) ?></small></td>
</tr><tr>
<td><strong><?php echo $workorder->user->name ?></strong></td>
</tr>
<tr>
<td><a class='btn btn-primary btn-block' href="<?php echo base_url('workcalender/edit/' . $workorder->id) ?>">EDIT</a></td>
</tr>
</table> -->

<?php if (!empty($workorder)) { ?>
    <div class="row">
        <div class="col-md-8 col-xs-16">
            <div class="margin-bottom-sec">
                <div class="bold margin-bottom-sec" style="font-size: 18px; font-weight: 500;">Test meeting</div>
                <a class="customer-avatar" href="#"> <img class="customer-avatar-img" src="<?php echo base_url('./assets/img/customer_sm.png') ?>">
                    <?php echo $workorder->contact_name ?><br>
                    <?php echo $workorder->contact_email ?><br>
                </a>
            </div>
            <!-- <div class="margin-bottom-sec">
                <div class="text-ter text-sm">WHEN (MY TIMEZONE)</div>
                <?php if (date('d', strtotime($event->start_date)) == date('d', strtotime($event->end_date))) { ?>
                    <?php echo date('l, d M Y', strtotime($event->start_date)) ?>, <?php echo $event->start_time ?> to <?php echo $event->end_time ?> <br> <span class="text-ter"></span>
                <?php } else { ?>
                    <span>From</span>
                    <?php echo date('l, d M Y', strtotime($event->start_date)) ?>, <?php echo $event->start_time ?> to <?php echo $event->end_time ?> <br> <span class="text-ter"></span>
                    <br>
                    <span>From</span>
                    <?php echo date('l, d M Y', strtotime($event->end_date)) ?>, <?php echo $event->start_time ?> to <?php echo $event->end_time ?> <br> <span class="text-ter"></span>
                    <!-- Saturday, 14 Mar 2020, 10:00 am to 11:30 am<br> <span class="text-ter">Central Time (UTC -5)</span> -->
        <?php } ?>
        </div> -->

        <div class="margin-bottom-sec">
            <div class="text-ter text-sm">NOTIFICATION</div>
            <?php echo $workorder->notify_by ?>
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

    <div class="margin-bottom-sec">
        <div class="text-ter text-sm">WORK ORDER</div>
        Lebert Walters (#WO-00<?php echo $workorder->id ?>) <span class="middot">·</span> <a href="<?php echo base_url('workorder/view/' . $workorder->id) ?>">view</a>
        <table>
            <tbody>
                <tr>
                    <td nowrap=""><span class="text-ter">Assigned to: &nbsp;</span></td>
                    <td><?php echo get_user_by_id($workorder->assign_to)->name ?></td>
                </tr>
                <tr>
                    <td nowrap=""><span class="text-ter">Customer:</span></td>
                    <td><?php echo $workorder->contact_name ?>, <?php echo $workorder->contact_mobile ?></td>
                </tr>
                <tr>
                    <td nowrap=""><span class="text-ter">Location:</span></td>
                    <td><?php echo $workorder->street_address ?></td>
                </tr>
                <!-- <tr>
                    <td nowrap=""><span class="text-ter">Details:</span></td>
                    <td>Replace lynx touch with 2Gig &amp; add 3 outdoor Ip cameras</td>
                </tr> -->
                <tr>
                    <td nowrap=""><span class="text-ter">Job Price:</span></td>
                    <td>$<?php echo unserialize($workorder->workorder_eqpt_cost)['eqpt_cost'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php } ?>