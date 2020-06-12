<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<?php 
    $participants_selected_ids = '';
    $participants_selected_names = '';
    $selected_participants_ids = array();
    if(isset($selected_participants)){
        foreach ($selected_participants as $row) {
            array_push($selected_participants_ids, $row->user_id);

            if($participants_selected_ids == ''){
                $participants_selected_ids .= $row->user_id;
            } else {
                $participants_selected_ids .= ',' . $row->user_id;
            }

            if($participants_selected_names == ''){
                $participants_selected_names .= $row->name;
            } else {
                $participants_selected_names .= ',' . $row->name;
            }   
        }
    }
?>
<div class="wrapper" role="wrapper">
	<?php include viewPath('includes/sidebars/schedule'); ?>

	<!-- page wrapper start -->
    <div wrapper__section>
    	<div class="container-fluid">
    		<div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title"><?php if(isset($id)){ echo 'Edit Task'; }else{echo 'New Task';} ?></h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"><?php if(isset($id)){ echo 'Edit your task.'; }else{ echo 'Add your new task.'; } ?></li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <a href="<?php echo base_url('taskhub') ?>" class="btn btn-primary"
                                   aria-expanded="false">
                                    <i class="mdi mdi-settings mr-2"></i> Go Back to TaskHub
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <?php echo form_open_multipart('taskhub/entry', ['class' => 'form-validate require-validation', 'id' => 'taskhub_entry', 'autocomplete' => 'off']); ?>
                <input type="hidden" name="taskid" id="taskid" value="
                    <?php 
                        if(isset($task)){
                            echo $task->task_id;
                        } else {
                            echo '0';
                        }       
                    ?>
                "/>
                <div class="row custom__border">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>Task Main Information</h3>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="subject">Subject</label>
                                        <input type="text" class="form-control" name="subject" id="subject"
                                               placeholder="Enter Subject" value="<?php 
                                                if((set_value('subject') == '') && (isset($task))){
                                                    echo $task->subject;
                                                } else {
                                                    echo set_value('subject');
                                                }
                                                ?>"required autofocus/>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="estimated_date_complete">Estimated Date of Competion</label>
                                        <input type="date" class="form-control" name="estimated_date_complete" id="estimated_date_complete" value="<?php
                                            if((set_value('estimated_date_complete') == '') && (isset($task))){
                                                echo $task->estimated_date_complete;
                                            } else {
                                                echo set_value('estimated_date_complete');
                                            }
                                        ?>" required>
                                    </div>
                                    <?php if(isset($users_selection)){ ?>
                                        <div class="col-md-3 form-group">
                                            <label for="assigned_to">Assign To</label>
                                            <select class="form-control" name="assigned_to" id="assigned_to">
                                                <option value="">Myself</option>
                                                <?php
                                                  if((set_value('assigned_to') == '') && (isset($task))){
                                                    $sel_assigned_to = $task->assigned_to;
                                                  } else {
                                                    $sel_assigned_to = set_value('assigned_to');
                                                  }

                                                  foreach ($users_selection as $row) {
                                                    $tag = '';
                                                    if($row->id == $sel_assigned_to){
                                                      $tag = ' selected';
                                                    }

                                                    $hidden = '';
                                                    if(in_array($row->id, $selected_participants_ids)){
                                                        $hidden = ' hidden';
                                                    }

                                                    echo '<option value="'. $row->id .'"'. $tag . $hidden . '>' . $row->name .'</option>';
                                                  }
                                                ?>
                                            </select>
                                        </div>
                                    <?php } ?>
                                    <div class="col-md-6 form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description" id="description" autocomplete="off" style="height: 300px !important" placeholder="Enter Description"
                                            required><?php 
                                                if((set_value('description') == '') && (isset($task))){
                                                    echo $task->description;
                                                } else {
                                                    echo set_value('description');
                                                }    
                                            ?></textarea>
                                    </div>
                                    <?php if(isset($status_selection)){ ?>
                                        <div class="col-md-3 form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <?php
                                                  if((empty(set_value('status'))) && (isset($task))){
                                                    $sel_status = $task->status;
                                                  } else {
                                                    $sel_status = set_value('status');  
                                                  }
                                                  
                                                  foreach ($status_selection as $row) {
                                                    $tag = '';
                                                    $sfx = '';
                                                    if($row->status_id == $sel_status){
                                                      $tag = ' selected';
                                                      $sfx = ' - Current';
                                                    }

                                                    echo '<option value="'. $row->status_id .'"'. $tag . '>' . $row->status_text . $sfx . '</option>';
                                                  }
                                                ?>
                                            </select>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-9 form-group">
                                        <label for="participants">Participants</label>
                                        <select class="form-control" name="participants" id="participants">
                                            <option id="always_selected" value="<?php echo $participants_selected_ids; ?>" hidden>
                                                <?php echo $participants_selected_names; ?>
                                            </option>
                                            <?php
                                                $assigned_to = 0;
                                                $created_by = 0;

                                              if(isset($task)){
                                                $assigned_to = $task->assigned_to;
                                                $created_by = $task->assigned_to;
                                              }

                                              foreach ($participants as $row) {
                                                if(($row->id != $assigned_to) && ($row->id != $created_by)){
                                                    if(in_array($row->id, $selected_participants_ids)){
                                                        echo '<option value="'. $row->id .'" class="bg-success">' . $row->name . '</option>';
                                                    } else {
                                                        echo '<option value="'. $row->id .'">' . $row->name . '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="'. $row->id .'" hidden>' . $row->name . '</option>';   
                                                }
                                              }
                                            ?>
                                        </select>
                                    </div>        
                                </div>

                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <button type="submit" class="btn btn-flat btn-primary">Save</button>
                                        <a href="<?php echo url('taskhub') ?>" class="btn btn-danger">Cancel this</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                </div>         	

           	<?php echo form_close(); ?>
    	</div>
    	<!-- end container-fluid -->
    </div>
</div>
<!-- page wrapper end -->

<div id="modal-taskhub-entry-error-alert" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Error</h4>
      </div>
      <div class="modal-body">
        <p id="modal-taskhub-entry-error-alert-message"><?php if(isset($error)){ echo trim($error); } ?></p>  
      </div>
    </div>

  </div>
</div>

<?php include viewPath('includes/footer'); ?>
<script>
    $(document).ready(function(){
        var prev_assigned_to = 0;
        if($('#assigned_to').length){
            prev_assigned_to = $('#assigned_to').val();
        }

        $('#participants').children('option[value="'+ prev_assigned_to +'"]').prop('hidden', true);

        var error_msg = $('#modal-taskhub-entry-error-alert-message').html();
        error_msg = error_msg.trim();

        if(error_msg != ''){
            $('#modal-taskhub-entry-error-alert').modal("show");
        }

        $('#participants').change(function(){
            var sel_index = $(this).prop('selectedIndex');
            var sel_uid = $(this).val();
            var all_sel_ids = '';
            var already_selected = false;

            if(sel_index != 0){
                all_sel_ids = $(this).children('option').eq('0').val();
                all_sel_ids = all_sel_ids.split(',');

                var sel_uid_index = jQuery.inArray(sel_uid, all_sel_ids);
                if(sel_uid_index !== -1){
                    $(this).children('option:selected').removeClass('bg-success');
                    if($('#assigned_to').length){
                        $('#assigned_to').children('option[value="'+ sel_uid +'"]').prop('hidden', false);    
                    }
                    all_sel_ids.splice(sel_uid_index, 1);
                } else { 
                    var assigned_to = 0;
                    if($('#assigned_to').length){
                        assigned_to = $('#assigned_to').val();
                        already_selected = (assigned_to == sel_uid);       
                    }

                    if(!already_selected){
                        $(this).children('option:selected').addClass('bg-success');
                        all_sel_ids.push(sel_uid);
                    }

                }

                if(!already_selected){
                    var new_all_sel_ids = all_sel_ids.join(',');
                    new_all_sel_ids = new_all_sel_ids.replace(/^,|,$/g,'');
                    
                    var new_all_sel_names = '';

                    $(this).children('option.bg-success').each(function(){
                        if(new_all_sel_names == ''){
                            new_all_sel_names = $(this).text().trim();
                        } else {
                            new_all_sel_names += ',' + $(this).text().trim();
                        }
                    });

                    new_all_sel_names = new_all_sel_names.trim();

                    $(this).children('option').eq('0').val(new_all_sel_ids);
                    $(this).children('option').eq('0').text(new_all_sel_names);
                } else {
                    $('#modal-taskhub-entry-error-alert-message').text('User already selected as assignee');
                    $('#modal-taskhub-entry-error-alert').modal("show");    
                }

                $(this).children('option').eq('0').prop('selected', true);
            }
        });

        if($('#assigned_to').length){
            $('#assigned_to').change(function(){
                var selected_assignee = $(this).val();
                if(selected_assignee != prev_assigned_to){
                    var selected_participants = $('#participants').children('option').eq('0').val();
                    if(selected_participants != ""){
                        selected_participants = selected_participants.split(',');

                        var selected_assignee_index = jQuery.inArray(selected_assignee, selected_participants);
                    } else {
                        selected_assignee_index = -1;
                    }

                    if(selected_assignee_index !== -1){
                        $('#modal-taskhub-entry-error-alert-message').text('User already selected as participant');
                        $('#modal-taskhub-entry-error-alert').modal("show");
                        
                        $(this).children('option[value="'+ prev_assigned_to +'"]').prop('selected', true);    
                    } else {
                        $('#participants').children('option[value="'+ prev_assigned_to +'"]').prop('hidden', false);
                        $('#participants').children('option[value="'+ selected_assignee +'"]').prop('hidden', true);

                        prev_assigned_to = selected_assignee;
                    }
                }
            });  
        }
    });
</script>