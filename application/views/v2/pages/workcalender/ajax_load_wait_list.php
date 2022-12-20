<style>
    .list-wait-list .waitlist-draggable {
        cursor: move;
    }
    .waitlist-details{
        display: inline-block;
        width: 70%;
        line-height: 1px !important;
        overflow: hidden;
    }
    .btn-edit-waitlist{
        display: inline-block;
    }
</style>

<ul class="list-wait-list" id="external-events-list">
    <?php foreach ($waitList as $w) { ?>
        <li>
            <div class="waitlist-draggable default-popover nsm-button m-0" data-event='<?= $w->id; ?>' data-content="Drag and drop to calendar to create an appointment">
                <a class="nsm-button btn-sm primary pull-right btn-edit-waitlist default-popover" data-id="<?= $w->id; ?>" href="javascript:void(0);" data-content="Update Waitlist" style="border: unset;">
                    <i class='bx bx-calendar-edit'></i>
                </a>
                <div class="fc-event-main waitlist-details">
                    <?= $w->appointment_number . " - " . $w->customer_name; ?>
                </div>
            </div>
           
        </li>
    <?php } ?>
</ul>

<script>
    $(function() {
        $('.default-popover').popover({
            placement: 'top',
            trigger: 'hover',
        });

        var containerEl = document.getElementById("external-events-list");
        new FullCalendar.Draggable(containerEl, {
            itemSelector: '.waitlist-draggable',
            eventData: function(eventEl) {
                console.log(eventEl);
                return {
                    title: eventEl.innerText,
                    duration: '02:00'
                };
            }
        });
    });
</script>