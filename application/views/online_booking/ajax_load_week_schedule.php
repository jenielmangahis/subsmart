<div class="opt-button-left">
  <a href="javascript:void(0);" class="prev-week-schedule"><span class="fa fa-arrow-left"></span></a>
</div>
<?php foreach($week_schedules as $date => $time){ ?>
<div class="col-day">
  <span class="txt-day"><?php echo date("D", strtotime($date)); ?></span>
  <span class="txt-date"><?php echo date("d-M", strtotime($date)); ?></span>
  <?php if( !empty($time) ){ ?>
  	<?php foreach($time as $t){ ?>
		<?php 
			$is_active = "";
			if(!empty($selected_sched)) {
				if($date == $selected_sched['date'] && $t['time_start'] == $selected_sched['time_start'] && $t['time_end'] == $selected_sched['time_end']) {
					$is_active = 'active';
				}
			}
		?>
  		<div class="container-availability">
			<button class="btn-add-schedule <?php echo $is_active; ?>" data-schedule-date="<?php echo $date; ?>" data-schedule-time-start="<?php echo $t['time_start']; ?>" data-schedule-time-end="<?php echo $t['time_end']; ?>" data-id="<?php echo $t['id']; ?>"><?php echo $t['time_start'] . ' - ' . $t['time_end']; ?></button>
		</div>
  	<?php } ?>
  <?php }else{ ?>
  	<div class="container-availability">
		<button class="unavailable">NOT AVAILABLE</button>
	</div>
  <?php } ?>

</div>
<?php } ?>
<div class="opt-button">
  <a href="javascript:void(0);" class="next-week-schedule"><span class="fa fa-arrow-right"></span></a>
</div>
<script>
var base_url = "<?php echo base_url(); ?>";
$(function(){
	function load_week_schedule(week_start_date, eid){
      var url = base_url + '/booking/_load_week_schedule';
      var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline;" /> Loading schedule...</div>';

      $(".schedule-container").html(msg);

      setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {week_start_date:week_start_date, eid:eid},
             success: function(o)
             {
                $(".schedule-container").html(o);
             }
          });
      }, 1000);
    }

	$(".btn-add-schedule").click(function(){
		$(".btn-add-schedule").removeClass('active');
		$(this).addClass('active');
	});

	$(".next-week-schedule").click(function(){
		load_week_schedule('<?php echo $next_date; ?>','<?php echo $eid; ?>');
	});

	$(".prev-week-schedule").click(function(){
		load_week_schedule('<?php echo $prev_date; ?>','<?php echo $eid; ?>');
	});

	$(".btn-add-schedule").click(function(){
		var url = base_url + '/booking/_set_booking_schedule';
		var sid = $(this).attr('data-id');
		var date = $(this).attr('data-schedule-date');
		var time_start = $(this).attr('data-schedule-time-start');
		var time_end = $(this).attr('data-schedule-time-end');
		$.ajax({
			type: "POST",
			url: url,
			data: {sid:sid,date:date,time_start:time_start,time_end:time_end},
			success: function(o)
			{
				//location.reload();
				$(".btn-primary-grey").css({"background-color": "#44a73c","cursor":"grab","pointer-events": "auto"});
			}
		});
	});
});
</script>
