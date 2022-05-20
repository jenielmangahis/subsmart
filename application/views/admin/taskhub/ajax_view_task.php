<style>
	.taskhub_sidebar_details_caption{
		width: 45%;
		text-align: right;
		padding-top: 0 !important;
	}

	.taskhub_sidebar_details_values{
		width: 55%;
		padding-top: 0 !important;
	}

	.my_card{
		padding: 0 !important;
		margin-bottom: 15px !important;
	}
	.p-40 {
  	padding-top: 40px !important;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<h5 class="box-title"><?= $task->subject; ?>
		<span class="font-weight-lighter">&ensp;#<?= $task->task_id; ?></span>
		<span class="font-weight-lighter border border-dark px-2 rounded" style='color: #ffffff;background-color: <?php echo $task->status_color; ?>'>
			<?= $task->status_text; ?>				
		</span>
		<div class="box-body">
    	<p style="white-space: pre-wrap;" class="text-justify"><?= $task->description; ?></p>
    </div>
    <div class="task-comments">
    	<?php foreach ($updates_and_comments as $key => $value) { ?>
    		<div class="card my_card" style="<?php if($value->is_update == 0){ echo 'border-color: #c0d3eb !important'; } else{ echo 'border-color: #BDADDD !important'; } ?>">
    			<div class="card-header" style="<?php if($value->is_update == 0){ echo 'background-color: #f1f8ff; border-bottom-color: #c0d3eb !important'; } else{ echo 'background-color: #F1EEF7; border-bottom-color: #BDADDD'; } ?>">
    				<?php 
							$date_updated = date_create($value->update_date);
							$date_updated = date_format($date_updated, "F d, Y h:i:s");

							if($value->is_update == 1){
								$update_type = 'updated on';
							} else {
								$update_type = 'commented on';
							} 
						?>
						
						<p style="margin-bottom: 0 !important"><strong><?php echo $value->user; ?></strong><?php echo ' ' . $update_type . ' ' . $date_updated;?></p>
    			</div>
    			<div class="card-body" style="padding-bottom: 0 !important">
						<p style="white-space: pre-wrap;" class="text-justify"><?php echo $value->text; ?></p>							
					</div>
    		</div>
    	<?php } ?>
    </div>
	</div>
</div>