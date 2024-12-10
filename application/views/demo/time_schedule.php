<style>
.list-schedules {
    list-style: none;
    padding: 0;
}
.list-schedules li {
    margin: 5px 0;
}
.btn-time-schedule {
    display: inline-block;
    padding: 10px 15px;
    text-decoration: none;
    color: #fff;
    border-radius: 5px;
}
</style>

<div class="pick-time">
  <p><?php echo date("l, M d", strtotime($date)); ?></p>  
  <ul class="list-schedules">
    <?php foreach($schedules_12hr as $index => $schedule_12hr): ?>
      <li>
        <button type="button" 
           class="btn btn-info btn-time-schedule nsmart-button primary" 
           data-key="<?php echo $schedules_24hr[$index]; ?>" data-date="<?php echo $schedule_12hr; ?>" id="demo_time_schedule">
          <?php echo $schedule_12hr; ?>
        </button>
      </li>
    <?php endforeach; ?>
  </ul>
</div>
