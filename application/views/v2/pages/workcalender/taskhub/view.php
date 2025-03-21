<?php include viewPath('v2/includes/header'); ?>
<?php //include viewPath('v2/includes/calendar/calendar_modals'); ?>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/taskhub_tabs'); ?>
    </div>

    <?php
        switch ($taskHub->status):
            case 'Backlog':
                $task_status = "warning";
                break;
            case 'Doing':
                $task_status = "primary";
                break;
            case 'Review Fail':
                $task_status = "error";
                break;
            case 'On Testing':
                $task_status = "success";
                break;
            case 'Review':
                $task_status = "success";
                break;
            case 'Done':
                $task_status = "success";
                break;
            case 'Closed':
                $task_status = "primary";
                break;
            default:
                $task_status = "";
                break;
        endswitch;  
    ?>

    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 grid-mb">
                        <div class="nsm-callout primary">Task details and updates</div>
                    </div>
                </div>                
                <div class="row">
                    <div class="col-8">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span>Task Comments</span>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="box-header with-border">
                                        <h5 class="box-title"><?php echo $taskHub->subject; ?>
                                            <span class="font-weight-lighter">&ensp;#<?php echo $taskHub->task_id; ?></span>
                                            &ensp;
                                            <span class="nsm-badge <?= $task_status ?> px-2 rounded" style="font-size: large;"><?= $taskHub->status != '' ? $taskHub->status : 'Draft'; ?></span>    
                                        </h5>
                                    </div>
                                    <div class="box-body">
                                        <p style="white-space: pre-wrap;" class="text-justify"><?php echo $taskHub->description; ?></p>
                                    </div>
                                </div>

                                <?php foreach ($updates_and_comments as $key => $value) { ?>
                                    <?php $image = userProfilePicture($value->user_id); ?>
                                    <div class="card my_card" style="margin-bottom: 11px;border: 1px solid #6a4a86;">
                                        <div class="card-header" style="background-color: #6a4a86; color:#ffffff; border-bottom-color: #6a4a86 !important;">
                                            <?php 
                                                $date_updated = date_create($value->update_date);
                                                $date_updated = date_format($date_updated, "F d, Y h:i:s");
                                            ?>
                                            
                                            <p style="margin-bottom: 0 !important">
                                                <img src="<?php echo $image; ?>" alt="<?php echo $value->user; ?>" class="img-thumbnail" style="width:25px;">
                                                <strong><?php echo $value->user; ?></strong>

                                                <?php if( checkRoleCanAccessModule('taskhub', 'delete') ){ ?>  
                                                <a href="javascript:void(0)" onClick="javascript:deleteComment(<?php echo $value->comment_id; ?>, <?php echo $taskHub->task_id; ?>);" class="" style="float:right; margin-left: 10px;"><i style="color:#ffffff;" class="bx bx-fw bx-trash"></i></a>
                                                <?php } ?>

                                                <span style="float:right;"><?= $date_updated; ?></span>
                                            </p>
                                        </div>
                                        <div class="card-body" style="padding-bottom: 0 !important">
                                            <p style="white-space: pre-wrap;" class="text-justify"><?php echo $value->text; ?></p>                          
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>                        
                    </div>
                    <div class="col-4">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span>Task Details</span>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>    
                                                    <td class="taskhub_sidebar_details_caption font-weight-bold">Created By:</td>
                                                    <td class="taskhub_sidebar_details_values"><?php echo $taskHub->created_by_name; ?></td>
                                                </tr>
                                                <?php if( $taskHub->customer_name != '' ){ ?>
                                                <tr>
                                                    <td class="taskhub_sidebar_details_caption font-weight-bold">Customer:</td>
                                                    <td class="taskhub_sidebar_details_values"><?php echo $taskHub->customer_name; ?></td>
                                                </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td class="taskhub_sidebar_details_caption font-weight-bold">Assignees:</td>
                                                    <td class="taskhub_sidebar_details_values">
                                                    <?php
                                                        if(isset($assignee_name) && $assignee_name != "") {
                                                            echo substr($assignee_name, 1);
                                                        } else {
                                                            echo "No Assigned User";
                                                        }
                                                    ?>
                                                    </td>
                                                </tr>
                                                    <td class="taskhub_sidebar_details_caption font-weight-bold">Date Created:</td>
                                                    <td class="taskhub_sidebar_details_values"><?php 
                                                            $date_created = date_create($taskHub->date_created);
                                                            echo date_format($date_created, "F d, Y h:i:s"); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="taskhub_sidebar_details_caption font-weight-bold">Due Date:</td>
                                                    <td class="taskhub_sidebar_details_values"><?php 
                                                            $date_due = date_create($taskHub->date_due);
                                                            echo date_format($date_due, "F d, Y"); ?></td>    
                                                </tr>
                                                <tr>
                                                    <td class="taskhub_sidebar_details_caption font-weight-bold">Status:</td>
                                                    <td class="taskhub_sidebar_details_values">
                                                        <span class="nsm-badge <?= $task_status ?>"><?= $taskHub->status != '' ? $taskHub->status : 'Draft'; ?></span>                                                        
                                                    </td>    
                                                </tr>
                                                <tr>
                                                    <td class="taskhub_sidebar_details_caption font-weight-bold">Priority :</td>
                                                    <td class="taskhub_sidebar_details_values">
                                                        <?php
                                                        $class_priority = "";
                                                        $priority_text  = "";
                                                        switch ($taskHub->priority):
                                                            case 'High':
                                                                $priority_text = $taskHub->priority;
                                                                $class_priority = "error";
                                                                break;
                                                            case 'Medium':
                                                                $priority_text = $taskHub->priority;
                                                                $class_priority = "secondary";
                                                                break;
                                                            case 'Low':
                                                                $priority_text = $taskHub->priority;
                                                                $class_priority = "";
                                                                break;
                                                            case 'Urgent':
                                                                $priority_text = $taskHub->priority;
                                                                $class_priority = "error";
                                                                break;
                                                            default:
                                                                $priority_text = 'Not Specified';
                                                                break;
                                                        endswitch;
                                                        ?>
                                                        <span class="nsm-badge <?= $class_priority ?>"><?php echo ucwords($priority_text); ?></span>                                                        
                                                    </td>    
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                        <?php if( checkRoleCanAccessModule('taskhub', 'write') ){ ?> 
                                            <hr />
                                            <div class="form-group" style="margin-bottom: 1rem !important">
                                                <textarea class="form-control" name="comment" id="comment" autocomplete="off" style="height: 300px !important" placeholder="Write your comment"></textarea>
                                            </div>
                                            <div class="col-12 mt-3 text-end">
                                                <button type="submit" name="btn_back" class="nsm-button" onclick="location.href='<?php echo url('taskhub') ?>'">Go Back to TaskHub List</button>
                                                <button type="button" name="btn_save" class="nsm-button primary" id="btnAddComment">Submit</button>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="nsm-card primary mt-2">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span>Activity</span>
                                </div>
                            </div>  
                            <div class="nsm-card-content">
                                                        
                                <ul class="list-group">
                                    <?php foreach($activity_logs as $activity_log) { ?>
                                        <li class="list-group-item">
                                            <i class="fa fa-user" aria-hidden="true"></i> <?php echo date("F j, Y, g:i a", strtotime($activity_log->date_updated)); ?> - <strong><?php echo $activity_log->FName . " " . $activity_log->LName; ?> </strong> <?php echo $activity_log->notes; ?>
                                        </li>
                                    <?php } ?>
                                </ul>                            

                            </div>                                                      
                        </div>                           
                    </div>  
                    <div class="col-4">
                     
                    </div>                  
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function deleteComment(id, task_id) {
        Swal.fire({
            title: 'Delete Comment',
            text: "This will delete selected task comment. Proceed with action?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('taskhub/_delete_selected_task_comment'); ?>",
                    dataType: 'json',
                    data: {id:id, task_id:task_id},
                    success: function(result) {
                        if (result.is_success == 1) {
                            Swal.fire({
                                title: 'Delete Successful!',
                                text: "Taskhub comment is successfully deleted!",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                //if (result.value) {
                                    location.reload();
                                //}
                            });
                        } else {
                            Swal.fire({
                                title: 'An Error Occured',
                                text: result.msg,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                if (result.value) {
                                    //location.reload();
                                }
                            });
                        }
                    },
                });
            }
        });
    }

    $(document).ready(function(){
        var bg_header = '';
        $('#btnAddComment').click(function(){
            if($('#comment').val() == ""){
                Swal.fire({
                    title: 'Error',
                    text: "Please write your comment",
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonText: 'Okay'
                });
            } else {
                $.ajax({
                    type: 'POST',
                    url: base_url + "taskhub/comment/" + <?php echo $taskHub->task_id; ?>,
                    data: {comment:$('#comment').val()},
                    beforeSend: function(){
                       
                    },
                    success: function(data){
                        Swal.fire({
                            title: 'Save Successful!',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            location.reload();  
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        Swal.fire({
                            title: 'Error',
                            text: textStatus,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }
                });
            }
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>