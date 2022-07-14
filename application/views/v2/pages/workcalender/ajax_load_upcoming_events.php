<table class="nsm-table" id="upcoming_events_table">
    <thead>
        <tr>
            <td></td>
            <td data-name="Event Details"></td>
            <td data-name="Status"></td>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($events)) : ?>
            <?php foreach ($events as $event) : ?>
                <?php if ($e['type'] == 'g-events') { ?>
                    <tr class="schedule-events uevent-view-details" style="cursor: pointer" data-event-id="<?= $e['event_id']; ?>">
                    <?php } else { ?>
                    <tr class="schedule-events" style="cursor: pointer" onclick="location.href='<?= base_url('events/event_preview/' . $e['event_id']) ?>'">
                    <?php } ?>
                    <td>
                        <div class="nsm-list-icon success">
                            <i class='bx bx-calendar-event'></i>
                        </div>
                    </td>
                    <td>
                        <?php if ($e['type'] == 'events') { ?>
                            <label class="content-title" style="cursor: pointer"><?php echo $e['event_number'] . ' : ' . $e['event_type'] . ' - ' . $e['event_tag']; ?></label>
                        <?php } else { ?>
                            <label class="content-title" style="cursor: pointer"><?php echo $e['event_type']; ?></label>
                        <?php } ?>

                        <?php if (!empty($settings['work_order_show_customer']) && $settings['work_order_show_customer'] == 1) : ?>
                            <label class="content-subtitle d-block mb-1" style="cursor: pointer"><?= $e['first_name'] . ' ' . $e['last_name']; ?></label>
                        <?php endif; ?>
                        <label class="content-subtitle d-block mb-1" style="cursor: pointer"><?php echo strtoupper($e['event_title']); ?></label>


                        <input type="hidden" id="<?= $e['event_id']; ?>-event-type" value="<?= $e['type']; ?>" />
                        <input type="hidden" id="<?= $e['event_id']; ?>-event-title" value="<?= $e['event_title']; ?>" />
                        <input type="hidden" id="<?= $e['event_id']; ?>-event-start-date" value="<?= $e['start_date']; ?>" />
                        <input type="hidden" id="<?= $e['event_id']; ?>-event-end-date" value="<?= $e['end_date']; ?>" />
                    </td>
                    <td class="text-end">
                        <span class="nsm-badge success"><?php echo strtoupper($jb->status); ?></span>
                        <label class="content-subtitle mt-1 d-block text-uppercase" style="cursor: pointer">
                            <?= date('M-d-Y', strtotime($e['start_date'])) ?> |
                            <?php if ($e['start_time'] == $e['end_time']) { ?>
                                <?= date("g:i A", strtotime($e['start_time'])); ?>
                            <?php } else { ?>
                                <?= date("g:i A", strtotime($e['start_time'])) . ' - ' . date("g:i A", strtotime($e['end_time'])); ?>
                            <?php } ?>
                        </label>
                    </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4">
                        <div class="nsm-empty">
                            <span>No upcoming events for now.</span>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
    </tbody>
</table>