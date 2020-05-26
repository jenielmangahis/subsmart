<style>
.list-schedules{
	list-style: none;
}
.list-schedules li{
	margin: 5px;
}
</style>
<div>
  <p><?php echo date("l, M d", strtotime($date)); ?></p>
  <ul class="list-schedules">
  	<?php foreach($schedules as $schedule){ ?>
  		<li><a href="javascript:void(0);" class="btn btn-info"><?php echo $schedule; ?></a></li>
  	<?php } ?>
  </ul>
</div>