<ul class="list-wait-list">
<?php foreach($waitList as $w){ ?>
  <li>
    <div>
      <?= $w->customer_name . " - " . $w->appointment_type; ?>
      <a class="btn btn-sm btn-primary pull-right btn-edit-waitlist default-popover" data-id="<?= $w->id; ?>" href="javascript:void(0);" data-content="Set an appointment">
        <i class="fa fa-calendar"></i>
      </a>
    </div>
  </li>
<?php } ?>
</ul>

<script>
$(function(){
  $('.default-popover').popover({
    placement : 'top',
    trigger : 'hover',
  });
});
</script>