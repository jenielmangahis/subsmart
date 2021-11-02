<style>
.list-wait-list .waitlist-draggable {
  margin: 1em 0;
  cursor: move;
}

</style>
<ul class="list-wait-list" id="external-events-list">
<?php foreach($waitList as $w){ ?>
  <li>
      <div class="waitlist-draggable default-popover" style="margin: 0px;width:100% !important; display: inline-block;background-color: #32243d;" data-event='<?= $w->id; ?>' data-content="Drag and drop to calendar to create an appointment">
        <div class="fc-event-main" style="text-align:left;font-size: 17px; padding: 11px;background-color: #32243d; color: #ffffff;">
          <?= $w->customer_name . " - " . $w->appointment_type; ?>
        </div>
      </div>
      <a class="btn btn-sm btn-primary pull-right btn-edit-waitlist default-popover" data-id="<?= $w->id; ?>" href="javascript:void(0);" data-content="Update Waitlist" style="position: relative;top: -46px; left: -9px;">
        <i class="fa fa-calendar"></i>
      </a>
  </li>
<?php } ?>
</ul>

<script>
$(function(){
  $('.default-popover').popover({
    placement : 'top',
    trigger : 'hover',
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