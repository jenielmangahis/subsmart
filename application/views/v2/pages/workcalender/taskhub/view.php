<?php include viewPath('v2/includes/header'); ?>
<?php //include viewPath('v2/includes/calendar/calendar_modals'); ?>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/calendar_tabs'); ?>
    </div>
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
                                            &ensp;<span class="font-weight-lighter border border-dark px-2 rounded" style='color: #ffffff;background-color: <?php echo $taskHub->status_color; ?>'><?php echo $taskHub->status_text; ?></span>
                                        </h5>
                                    </div>
                                    <div class="box-body">
                                        <p style="white-space: pre-wrap;" class="text-justify"><?php echo $taskHub->description; ?></p>
                                    </div>
                                </div>

                                <?php foreach ($updates_and_comments as $key => $value) { ?>
                                    <div class="card my_card" style="margin-bottom: 11px;border: 1px solid #6a4a86;">
                                        <div class="card-header" style="background-color: #f1f8ff; border-bottom-color: #6a4a86 !important;">
                                            <?php 
                                                $date_updated = date_create($value->update_date);
                                                $date_updated = date_format($date_updated, "F d, Y h:i:s");
                                            ?>
                                            
                                            <p style="margin-bottom: 0 !important">
                                                <strong><?php echo $value->user; ?></strong>
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
                                                        if(isset($assignee_name)) {
                                                            echo substr($assignee_name, 1);
                                                        } else {
                                                            echo "Not Specified";
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
                                                        <?php
                                                            switch ($taskHub->status_text):
                                                                case 'New':
                                                                    $task_status = "primary";
                                                                    break;
                                                                case 'Resumed':
                                                                    $task_status = "primary";
                                                                    break;
                                                                case 'On Hold':
                                                                    $task_status = "error";
                                                                    break;
                                                                case 'Completed':
                                                                    $task_status = "success";
                                                                    break;
                                                                case 'Complete':
                                                                    $task_status = "success";
                                                                    break;
                                                                case 'Re-opened':
                                                                    $task_status = "primary";
                                                                    break;
                                                                case 'On Going':
                                                                    $task_status = "secondary";
                                                                    break;
                                                                default:
                                                                    $task_status = "";
                                                                    break;
                                                            endswitch;
                                                        ?>
                                                        <span class="nsm-badge <?= $task_status ?>"><?= $taskHub->status_text != '' ? $taskHub->status_text : 'Draft'; ?></span>                                                        
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

                                        <div class="card my_card" id="card_add_comment">
                                            <div class="card-header">
                                                <h4><i class="fa fa-comment-o"></i>&ensp;Add Comment</h4>
                                            </div>
                                            <div class="card-body" style="padding-bottom: 1.25rem !important">
                                                <div class="form-group" style="margin-bottom: 1rem !important">
                                                    <textarea class="form-control" name="comment" id="comment" autocomplete="off" style="height: 300px !important" placeholder="Place your comment here..."></textarea>
                                                </div>
                                                <div class="col-12 mt-3 text-end">
                                                    <button type="submit" name="btn_back" class="nsm-button" onclick="location.href='<?php echo url('taskhub') ?>'">Go Back to TaskHub List</button>
                                                    <button type="button" name="btn_save" class="nsm-button primary" id="btnAddComment">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
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