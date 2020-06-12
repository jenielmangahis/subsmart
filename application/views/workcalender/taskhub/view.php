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
</style>

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/schedule'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
    	<div class="container-fluid">
    		<div class="card card_holder">
    			<div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h1 class="page-title">Task Hub</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Show task details and comments</li>
                            </ol>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                    <?php //if (hasPermissions('add_plan')): ?>
                                    <a href="<?php echo base_url('taskhub'); ?>" class="btn btn-primary"><i
                                                class="fa fa-plus"></i> Go Back to TaskHub</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <section class="content">
                	<!-- Default box -->
                	<div class="row">
                		<div class="col-md-9">
		                    <div class="box">
		                    	<div class="box-header with-border">
		                            <h5 class="box-title"><?php echo $task->subject; ?>
		                            	<span class="font-weight-lighter">&ensp;#<?php echo $task->id; ?></span>
		                            	&ensp;<span class="font-weight-lighter border border-dark px-2 rounded" style='background-color: <?php echo $task->status_color; ?>'><?php echo $task->status_text; ?></span>
		                        	</h5>
		                        </div>
		                        <div class="box-body">
		                        	<p style="text-indent: 30px; white-space: pre-wrap;" class="text-justify"><?php echo $task->description; ?></p>
		                        </div>
		                    	<div class="box-footer">
									<?php foreach ($updates_and_comments as $key => $value) { ?>
										<div class="card my_card" style="<?php if($value->is_update == 0){ echo 'border-color: #c0d3eb !important'; } else{ echo ''; } ?>">
											<div class="card-header" style="<?php if($value->is_update == 0){ echo 'background-color: #f1f8ff; border-bottom-color: #c0d3eb !important'; } else{ echo ''; } ?>">
												<?php 
													$date_updated = date_create($value->update_date);
													$date_updated = date_format($date_updated, "F d, Y h:i:s");

													if($value->is_update == 1){
														$update_type = 'updated on';
													} else {
														$update_type = 'commented on';
													} 
												?>
												
												<p style="margin-bottom: 0 !important"><strong><?php echo $value->last_updated_by_name; ?></strong><?php echo ' ' . $update_type . ' ' . $date_updated;?></p>
											</div>
											<div class="card-body" style="padding-bottom: 0 !important">
												<?php if($value->is_update == 1){ ?>
													<div class="table-responsive">
														<table class="table table-borderless table-sm">
															<tbody>
																<tr>
																	<td class="font-italic"><strong>Status:</strong><?php echo ' ' . $value->status; ?></td>
																</tr>
																<tr>
																	<td class="font-italic"><strong>Assignee:</strong><?php echo ' ' . $value->assigned_to_name; ?></td>
																</tr>
															</tbody>
														</table>
													</div>		
												<?php } else { ?>
													<p style="white-space: pre-wrap;" class="text-justify"><?php echo $value->comment; ?></p>							
												<?php } ?>
											</div>
										</div>
									<?php } ?>

									<div class="card my_card" id="card_add_comment">
										<div class="card-header">
											<h4>Add Comment</h4>
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
			                				<td class="taskhub_sidebar_details_values"><?php echo $task->assigned_to_name; ?></td>
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
													echo date_format($date_created, "F d, Y") . ' at ' . $task->time_created; ?></td>
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

<div id="modal-taskhub-comment-error-alert" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="comment_modal_header"></h4>
      </div>
      <div class="modal-body">
      	<p id="comment_modal_text"></p>  
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#btnAddComment').click(function(){
			if($('#comment').val() == ""){
				$('#comment_modal_header').text('Information');
				$('#comment_modal_text').text('Please write your comment');
				$('#modal-taskhub-comment-error-alert').modal("show");
			} else {
				$.ajax({
					type: 'POST',
					url: base_url + "taskhub/comment" + <?php echo $task->id; ?>,
					data: {comment:$('#comment').val()},
					success: function(data){
						var result = jQuery.parseJSON(data);
						if(result.error == ""){

						} else {
							$('#comment_modal_header').text('Error');
							$('#comment_modal_text').text(result.error);
							$('#modal-taskhub-comment-error-alert').modal("show");
						}
					}
				});
			}
		});	
	});
</script>