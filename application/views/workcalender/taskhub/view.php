<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>

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

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/schedule'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
    	<div class="container-fluid">
    		<div class="row p-40">
            <div class="col">
                <h3 class="m-0">
                    Task Hub
                    <a href="<?php echo base_url('taskhub') ?>" class="btn btn-primary" aria-expanded="false" style="float: right;">
                    <i class="mdi mdi-settings mr-2"></i> Go Back to TaskHub
                </a>
                </h3>
            </div>
            <div style="background-color:#fdeac3;padding:.5%;margin-bottom:5px;margin-top:5px;margin-bottom:10px; width:100%;margin-left: 10px;">
                Show task details and comments   
            </div>
        </div>
    		<div class="card card_holder">
                <section class="content">
                	<!-- Default box -->
                	<div class="row">
                		<div class="col-md-9">
		                    <div class="box">
		                    	<div class="box-header with-border">
		                            <h5 class="box-title"><?php echo $task->subject; ?>
		                            	<span class="font-weight-lighter">&ensp;#<?php echo $task->task_id; ?></span>
		                            	&ensp;<span class="font-weight-lighter border border-dark px-2 rounded" style='background-color: <?php echo $task->status_color; ?>'><?php echo $task->status_text; ?></span>
		                        	</h5>
		                        </div>
		                        <div class="box-body">
		                        	<p style="white-space: pre-wrap;" class="text-justify"><?php echo $task->description; ?></p>
		                        </div>
		                    	<div class="box-footer">
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

									<div class="card my_card" id="card_add_comment">
										<div class="card-header">
											<h4><i class="fa fa-comment-o"></i>&ensp;Add Comment</h4>
										</div>
										<div class="card-body" style="padding-bottom: 1.25rem !important">
											<div class="form-group" style="margin-bottom: 1rem !important">
		                                        <textarea class="form-control" name="comment" id="comment" autocomplete="off" style="height: 300px !important" placeholder="Place your comment here..."></textarea>
		                                    </div>
		                                    <div class="form-group" style="margin-bottom: 1rem !important">
	                                        	<button type="button" class="btn btn-flat btn-primary float-right" id="btnAddComment">Submit</button>
	                                        </div>
										</div>
									</div>								
		                        </div>
		                        <!-- /.box-footer-->
		                    </div>
		                </div>
		                <div class="col-md-3 border">
		                	<div class="table-responsive mt-5">
		                		<table class="table table-borderless">
		                			<tbody>
		                				<tr>
			                				<td class="taskhub_sidebar_details_caption font-weight-bold">Created By :</td>
			                				<td class="taskhub_sidebar_details_values"><?php echo $task->created_by_name; ?></td>
			                			</tr>
			                			<tr>
			                				<td class="taskhub_sidebar_details_caption font-weight-bold">Assigned To :</td>
			                				<td class="taskhub_sidebar_details_values"><?php
			                					$assigned_to_name = '';

			                					foreach ($participants as $key => $value) {
			    									if($value->is_assigned == 1){
			    										$assigned_to_name = $value->participant_name;

			    										break;
			    									}
			                					}		

			                					echo $assigned_to_name;
			                				?></td>
			                			</tr>
			                			<tr>
			                				<td class="taskhub_sidebar_details_caption font-weight-bold">Participants :</td>
			                				<?php $first = true; ?>
			                				<?php foreach ($participants as $key => $value) { ?>
			                					<?php if(!$first){ ?>
				                					<tr>
				                					<td class="taskhub_sidebar_details_caption"></td>
				                				<?php } ?>
				                					<td class="taskhub_sidebar_details_values"><?php echo $value->participant_name; ?></td>
				                					</tr>
			                				<?php $first = false; } ?>

			                			<tr>
			                				<td class="taskhub_sidebar_details_caption font-weight-bold">Date Created :</td>
			                				<td class="taskhub_sidebar_details_values"><?php 
			                						$date_created = date_create($task->date_created);
													echo date_format($date_created, "F d, Y h:i:s"); ?></td>
			                			</tr>
			                			<tr>
			                				<td class="taskhub_sidebar_details_caption font-weight-bold">Estimated Date of Completion :</td>
			                				<td class="taskhub_sidebar_details_values"><?php 
			                						$date_estimated = date_create($task->estimated_date_complete);
													echo date_format($date_estimated, "F d, Y"); ?></td>	
			                			</tr>
			                		</tbody>
		                		</table>
		                	</div>
		                </div>
	                </div>
                </section>
    			<!-- end row -->
    		</div>	
    	</div>
    <!-- end container-fluid -->
    </div>
</div>

<div id="modal-taskhub-alert" class="modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" id="modal-taskhub-alert-header">
      	<h4 class="modal-title" id="modal-taskhub-alert-title"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      	<p id="modal-taskhub-alert-text"></p>  
      </div>
    </div>

  </div>
</div>

<div id="modal-taskhub-preloader" class="modal" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-9">
            <h4>Processing. Please Wait...</h4>
            <span><small>Please don't close your browser to avoid system conflicts</small></span>
          </div>
          <div class="col-md-3">
            <div class="spinner-border text-secondary pull-right"></div> 
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script type="text/javascript">
	$(document).ready(function(){
		var bg_header = '';

		$('#btnAddComment').click(function(){
			if($('#comment').val() == ""){
				showTaskHubAlert('Warning', 'Please write your comment', 'warning');	
			} else {
				$.ajax({
					type: 'POST',
					url: base_url + "taskhub/comment/" + <?php echo $task->task_id; ?>,
					data: {comment:$('#comment').val()},
					beforeSend: function(){
						$('#modal-taskhub-preloader').modal('show');
					},
					success: function(data){
						var result = jQuery.parseJSON(data);
						if(result.error == ""){
							location.reload();	
						} else {
							showTaskHubAlert('Error', result.error, 'error');
						}

						$('#modal-taskhub-preloader').modal('hide');
					},
					error: function(jqXHR, textStatus, errorThrown){
						$('#modal-taskhub-preloader').modal('hide');
						
						showTaskHubAlert(textStatus, errorThrown, 'error');	
					}
				});
			}
		});

		$('#modal-taskhub-alert').on('hidden.bs.modal', function(){
			$('#modal-taskhub-alert-header').removeClass(bg_header);	
		});	
	});

	function showTaskHubAlert(title, text, theme){
		if(theme == 'info'){
			bg_header = 'bg-info'; 
		} else if(theme == 'error'){
			bg_header = 'bg-danger';
		} else if(theme == 'warning'){
			bg_header = 'bg-warning';
		}

		$('#modal-taskhub-alert-header').addClass(bg_header);
		$('#modal-taskhub-alert-header').text(title);
		$('#modal-taskhub-alert-text').text(text);
		$('#modal-taskhub-alert').modal("show");
	}
</script>