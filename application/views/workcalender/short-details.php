<?php if (!empty($workorder)) { ?>
    <div class="row">
        <div class="col-md-8 col-xs-16">
            <div class="margin-bottom-sec">
                <div class="bold margin-bottom-sec" style="font-size: 18px; font-weight: 500;">Test meeting</div>
                <a class="customer-avatar" href="#"> <img class="customer-avatar-img"
                                                          src="<?php echo base_url('./assets/img/customer_sm.png') ?>">
                    <?php echo $workorder->customer->contact_name ?><br>
                    <?php echo $workorder->customer->contact_email ?><br>
                </a>
            </div>

            <div class="margin-bottom-sec">
                <div class="text-ter text-sm">NOTIFICATION</div>
                <?php if ( (!empty($workorder->customer->notification_method)) && is_serialized($workorder->customer->notification_method)) { ?>

                    <?php foreach (unserialize($workorder->customer->notification_method) as $data) { ?>

                        <span><?php echo $data ?></span>

                    <?php } ?>

                <?php } else { ?>

                    <?php echo $workorder->customer->notification_method ?>

                <?php } ?>
            </div>

        </div>
<!--        <input type="hidden" name="hid_event_id" value="--><?php //echo $event->id ?><!--">-->
    </div>

    <div class="margin-bottom-sec">
        <div class="text-ter text-sm">WORK ORDER</div>
        Lebert Walters (#WO-00<?php echo $workorder->id ?>) <span class="middot">·</span> <a
                href="<?php echo base_url('workorder/view/' . $workorder->id) ?>">view</a>
        <table>
            <tbody>
            <tr>
                <td nowrap=""><span class="text-ter">Assigned to: &nbsp;</span></td>
                <td><?php // echo get_user_by_id($workorder->assign_to)->name ?></td>
            </tr>
            <tr>
                <td nowrap=""><span class="text-ter">Customer:</span></td>
                <td><?php echo $workorder->customer->contact_name ?>
                    , <?php echo $workorder->customer->mobile ?></td>
            </tr>
            <tr>
                <td nowrap=""><span class="text-ter">Location:</span></td>
                <td><?php echo $workorder->customer->street_address ?></td>
            </tr>
            <!-- <tr>
                <td nowrap=""><span class="text-ter">Details:</span></td>
                <td>Replace lynx touch with 2Gig &amp; add 3 outdoor Ip cameras</td>
            </tr> -->
            <tr>
                <td nowrap=""><span class="text-ter">Job Price:</span></td>
                <td>$<?php echo unserialize($workorder->total)['eqpt_cost'] ?></td>
            </tr>
            </tbody>
        </table>
    </div>
<?php } ?>