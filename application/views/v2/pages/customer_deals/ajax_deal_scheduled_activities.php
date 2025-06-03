<?php if( $activitySchedules ){ ?>  
  <?php foreach($activitySchedules as $activity){ ?>
    <div class="row activity-card" data-type="<?= $activity->activity_type; ?>" data-id="<?= $activity->id; ?>">
      <div class="col-md-2 col-sm-2 col-2">
        <div class="form-check opt-done-container">
          <input class="form-check-input opt-is-done" type="radio" name="activity_is_done" data-deal-id="<?= $activity->customer_deal_id; ?>" data-id="<?= $activity->id; ?>">
        </div>
      </div>
      <div class="col-md-10 col-sm-10 col-10 p-0 activity-info" data-type="<?= $activity->activity_type; ?>" data-id="<?= $activity->id; ?>">
        <div class="activity-name">
          <i class="<?= $activity->activity_type_properties['icon'] ?>"></i> <?= $activity->activity_type; ?>
          <?php if( $activity->priority != 'None' ){ ?>
            <i class="float-end <?= $activity->priority_properties['icon']; ?>" style="color:#ffffff;background-color:<?= $activity->priority_properties['color']; ?>"></i>
          <?php } ?>
        </div>
        <?php 
          $today = date("F j, Y");
          $date  = date("F j, Y", strtotime($activity->date_from));
          if( $today == $date ){
            $date = '<span class="activity-today">Today</span>';
          }elseif( $date == date("F j, Y", strtotime("+1 day")) ){
            $date = 'Tomorrow';
          }elseif( strtotime($activity->date_from) < time() ){
            $date_a = new DateTime($activity->date_from);
            $date_b = new DateTime();
            $difference = $date_a->diff($date_b);
            $days_diff  = $difference->d;
            $date       = $days_diff . ' day overdue';
            if( $days_diff > 1 ){
              $date       = '<span class="activity-overdue-text">' . $days_diff . ' days overdue</span>';
            }
          }
        ?>
        <div class="activity-schedule"><?= $date; ?> &#9679; <?= $activity->owner_firstname . " " . $activity->owner_lastname; ?></div>        
      </div>
      <?php if( $activity->notes != '' ){ ?>
        <div class="col-md-12 col-sm-12 col-12">
          <span class="activity-notes"><?= $activity->notes; ?></span>
        <?php } ?>
        </div>
    </div>
  <?php } ?>
<?php }else{ ?>
<div class="alert alert-secondary text-center" role="alert">
  You have no activities scheduled for this deal
</div>
<?php } ?>
<script>
$(function(){
  $('.opt-is-done').popover({
      placement: 'top',
      html : true, 
      trigger: "hover focus",
      content: function() {
          return 'Mark as done';
      } 
  });
});
</script>