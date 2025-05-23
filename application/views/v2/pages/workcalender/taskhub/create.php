<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/calendar/calendar_modals'); ?>
<style>
    .autocomplete-img {
        height: 50px;
        width: 50px;
        float: left;
    }
    .autocomplete-right {
        display: inline-block;
        width: 80%;
        vertical-align: top;
        margin-left: 15px;
    }    
</style>
<?php
$participants_selected_ids = '';
$participants_selected_names = '';
$selected_participants_ids = array();
$assigned_to = 0;
if (isset($selected_participants)) {
    foreach ($selected_participants as $row) {
        if ($row->is_assigned == 0) {
            array_push($selected_participants_ids, $row->user_id);

            if ($participants_selected_ids == '') {
                $participants_selected_ids .= $row->user_id;
            } else {
                $participants_selected_ids .= ',' . $row->user_id;
            }

            if ($participants_selected_names == '') {
                $participants_selected_names .= $row->name;
            } else {
                $participants_selected_names .= ',' . $row->name;
            }
        } else {
            $assigned_to = $row->user_id;
        }
    }
}
?>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/taskhub_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 grid-mb">
                        <div class="nsm-callout primary">
                            <!-- <button><i class='bx bx-x'></i></button> -->
                            <?php echo $taskhub_tab_subtitle; ?>
                        </div>
                    </div>
                </div>
                <?php echo form_open_multipart(null, ['class' => 'form-validate frm-taskhub-add require-validation', 'id' => 'frm-taskhub-add']); ?>
                <?php
                if (isset($task)) {
                    $task_id = $taskHub->task_id;
                } else {
                    $task_id = '0';
                }
                ?>
                <input type="hidden" name="taskid" id="taskid" value="<?= $task_id ?>" />
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="col-12 col-md-4">
                                        <?php if ((set_value('title') == '') && (isset($taskHub))) {
                                            $title = $taskHub->title;
                                        } else {
                                            $title = set_value('subject');
                                        } ?>
                                        <label class="content-subtitle fw-bold d-block mb-2">Title</label>
                                        <input type="text" name="title" class="nsm-field form-control" value="<?= $title ?>" required>
                                    </div>

                                    <?php if (isset($status_selection)) { ?>
                                        <div class="col-12 col-md-4">
                                            <label class="content-subtitle fw-bold d-block mb-2">Status</label>
                                            <select name="status" id="status-select" class="nsm-field form-select status-select">
                                                <?php foreach($status_selection as $status) { ?>
                                                <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    <?php } ?>

                                    <?php if (isset($users_selection)) { ?>
                                        <div class="col-12 col-md-4">
                                            <label class="content-subtitle fw-bold d-block mb-2">Assign To</label>
                                            <!-- <select class="nsm-field form-select" name="assigned_to" id="assigned_to">
                                                <option value="">Myself</option>
                                                <?php
                                                    /*if (set_value('assigned_to') != '') {
                                                        $sel_assigned_to = set_value('assigned_to');
                                                    }

                                                    foreach ($users_selection as $row) {
                                                        $tag = '';
                                                        if (($row->id == $sel_assigned_to) || ($row->id == $assigned_to)) {
                                                            $tag = ' selected';
                                                        }

                                                        $hidden = '';
                                                        echo '<option value="' . $row->id . '"' . $tag . $hidden . '>' . $row->name . '</option>';
                                                    }*/
                                                ?>
                                            </select> -->
                                            <select name="assigned_to" id="taskhub-user-id" multiple="multiple" class="nsm-field mb-2 form-control" required=""></select>
                                        </div>
                                    <?php } ?>

                                    <div class="col-12 col-md-4">
                                        <label class="content-subtitle fw-bold d-block mb-2">Priority</label>
                                        <select name="priority" id="priority-select" class="nsm-field form-select priority-select">
                                            <?php foreach ($optionPriority as $key => $value) { ?>
                                                <?php if ($task) { ?>
                                                    <option <?= $taskHub->priority == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $key; ?>"><?= $value; ?></option>
                                                <?php } ?>

                                            <?php } ?>
                                        </select>
                                    </div>

                                    <!--
                                    <div class="col-12 col-md-4">
                                        <label class="content-subtitle fw-bold d-block mb-2">Participants</label>
                                        <select class="nsm-field form-select" name="participants" id="participants">
                                            <option id="always_selected" value="<?php echo $participants_selected_ids; ?>" hidden>
                                                <?php echo $participants_selected_names; ?>
                                            </option>
                                            <?php
                                            foreach ($users_selection as $row) {
                                                if ($row->id != $assigned_to) {
                                                    if (in_array($row->id, $selected_participants_ids)) {
                                                        echo '<option value="' . $row->id . '" class="bg-success">' . $row->name . '</option>';
                                                    } else {
                                                        echo '<option value="' . $row->id . '">' . $row->name . '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="' . $row->id . '" hidden>' . $row->name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    -->

                                    <div class="col-12 col-md-4">
                                        <?php
                                        $date = date("m/d/Y");
                                        if (isset($taskHub->date_due)) {                                            
                                            $date = date("m/d/Y",strtotime($taskHub->date_due));
                                        }
                                        ?>
                                        <label class="content-subtitle fw-bold d-block mb-2">Due Date</label>
                                        <input type="text" name="date_due" class="nsm-field form-control datepicker" value="<?= $date ?>" required>
                                    </div>

                                    <div class="col-12 col-md-4">
                                            <label class="content-subtitle fw-bold d-block mb-2">Select a group for this task</label>
                                            <select name="group" id="group-select" class="nsm-field form-select group-select" required>
                                                <option value="0">Select a Group</option>
                                                <?php foreach($taskslists as $row) { ?>
                                                    <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                                                <?php } ?>
                                            </select>
                                    </div>

                                    <div class="col-12">
                                        <label class="content-subtitle fw-bold d-block mb-2">Notes</label>
                                        <textarea name="notes" class="nsm-field form-control ckeditortaskhub" id="ckeditortaskhub" placeholder="Enter Notes" required>
                                            <?php
                                            if ((set_value('notes') == '') && (isset($taskHub))) {
                                                echo $taskHub->notes;
                                            } else {
                                                echo set_value('notes');
                                            }
                                            ?>
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3 text-end">
                        <button type="button" name="btn_back" class="nsm-button" onclick="location.href='<?php echo url('taskhub') ?>'">Go Back to TaskHub List</button>
                        <button type="submit" name="btn_save" class="nsm-button primary">Save</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        CKEDITOR.replace( 'ckeditortaskhub', {});   

        $('#status-select').select2();
        $('#priority-select').select2();
        
        $('#taskhub-user-id').select2({
            ajax: {
                url: base_url + 'autocomplete/_company_users',
                dataType: 'json',
                delay: 250,                
                data: function(params) {
                    return {
                        q: params.term,
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;

                    return {
                        results: data,
                    };
                },
                cache: true
            },
            placeholder: 'Select User',
            maximumSelectionLength: 5,
            minimumInputLength: 0,
            templateResult: formatRepoUser,
            //dropdownParent: $('#modalAddTaskHub'),
            templateSelection: formatRepoSelectionUser
        });  

    });
    
    $(document).ready(function() {
        var prev_assigned_to = 0;
        if ($('#assigned_to').length) {
            prev_assigned_to = $('#assigned_to').val();
        }
        $('#participants').children('option[value="' + prev_assigned_to + '"]').prop('hidden', true);

        $('.datepicker').datepicker({
            format: 'mm/dd/yyyy',
            autoclose: true,
        });

        $("#customer_id").select2({
            ajax: {
                url: base_url + 'autocomplete/_company_customer',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term,
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;

                    return {
                        results: data,
                    };
                },
                cache: true
            },
            placeholder: 'Select Customer',
            minimumInputLength: 0,
            templateResult: formatRepoCustomer,
            templateSelection: formatRepoCustomerSelection,
        });

        $('#participants').change(function() {
            var sel_index = $(this).prop('selectedIndex');
            var sel_uid = $(this).val();
            var all_sel_ids = '';
            var already_selected = false;

            if (sel_index != 0) {
                all_sel_ids = $(this).children('option').eq('0').val();
                all_sel_ids = all_sel_ids.split(',');

                var sel_uid_index = jQuery.inArray(sel_uid, all_sel_ids);
                if (sel_uid_index !== -1) {
                    $(this).children('option:selected').removeClass('nsm-bg-primary');
                    if ($('#assigned_to').length) {
                        $('#assigned_to').children('option[value="' + sel_uid + '"]').prop('hidden', false);
                    }
                    all_sel_ids.splice(sel_uid_index, 1);
                } else {
                    var assigned_to = 0;
                    if ($('#assigned_to').length) {
                        assigned_to = $('#assigned_to').val();
                        already_selected = (assigned_to == sel_uid);
                    }

                    if (!already_selected) {
                        $(this).children('option:selected').addClass('nsm-bg-primary');
                        all_sel_ids.push(sel_uid);
                    }

                }

                if (!already_selected) {
                    var new_all_sel_ids = all_sel_ids.join(',');
                    new_all_sel_ids = new_all_sel_ids.replace(/^,|,$/g, '');

                    var new_all_sel_names = '';

                    $(this).children('option.nsm-bg-primary').each(function() {
                        if (new_all_sel_names == '') {
                            new_all_sel_names = $(this).text().trim();
                        } else {
                            new_all_sel_names += ',' + $(this).text().trim();
                        }
                    });

                    new_all_sel_names = new_all_sel_names.trim();

                    $(this).children('option').eq('0').val(new_all_sel_ids);
                    $(this).children('option').eq('0').text(new_all_sel_names);
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: "User already selected as assignee.",
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    });
                }

                $(this).children('option').eq('0').prop('selected', true);
            }
        });

        if ($('#assigned_to').length) {
            $('#assigned_to').change(function() {
                var selected_assignee = $(this).val();
                if (selected_assignee != prev_assigned_to) {
                    var selected_participants = $('#participants').children('option').eq('0').val();
                    if (selected_participants != "") {
                        selected_participants = selected_participants.split(',');

                        var selected_assignee_index = jQuery.inArray(selected_assignee, selected_participants);
                    } else {
                        selected_assignee_index = -1;
                    }

                    if (selected_assignee_index !== -1) {
                        Swal.fire({
                            title: 'Error',
                            text: "User already selected as participant.",
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });

                        $(this).children('option[value="' + prev_assigned_to + '"]').prop('selected', true);
                    } else {
                        $('#participants').children('option[value="' + prev_assigned_to + '"]').prop('hidden', false);
                        $('#participants').children('option[value="' + selected_assignee + '"]').prop('hidden', true);

                        prev_assigned_to = selected_assignee;
                    }
                }
            });
        }      

        /*$("#frm-taskhub-add").on("submit", function(e) {            
            e.preventDefault();

            let _this = $(this);
            var url   = base_url + 'taskhub/_save_taskhub_task';
            var formData = new FormData($("#frm-taskhub-add")[0]); 
                 
            _this.find("button[type=submit]").html('<span class="bx bx-loader bx-spin"></span>');
            _this.find("button[type=submit]").prop("disabled", true);

            setTimeout(function () {
                $.ajax({
                    type: "POST",
                    url: url,
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData:false,
                    data: formData, //_this.serialize()
                    success: function(o)
                    {          
                        if( o.is_success == 1 ){   
                            $("#modalAddTaskHub").modal("hide");         
                            Swal.fire({
                                title: 'Save Successful!',
                                text: "Task was successfully created.",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                location.href = "<?php echo base_url('taskhub'); ?>";
                            });
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                html: o.msg
                            });
                        } 

                        _this.find("button[type=submit]").html("Save");
                        _this.find("button[type=submit]").prop("disabled", false);                        
                    }
                });
            }, 800); 
        });*/     
        
        $("#frm-taskhub-add").on("submit", function(e) {            
            e.preventDefault();

            var a_to_multiple = $("#taskhub-user-id").val();
            var ContentFromEditor = CKEDITOR.instances.ckeditortaskhub.getData();
            var dataString = $("#frm-taskhub-add").serialize();
                dataString += '&ContentFromEditor='+ContentFromEditor;   
                dataString += '&a_to_multiple=' + a_to_multiple;           

            let _this = $(this);
            var url = "<?php echo base_url('taskhub/_save_taskhub_task'); ?>";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: dataString,
                success: function(result) {
                    var res = JSON.parse(result);
                    if(res.is_success == 1) {
                        Swal.fire({
                            title: 'Save Successful!',
                            text: res.message,
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((o) => {
                            location.href = "<?php echo base_url('taskhub'); ?>";   
                        });                        
                    } else {
                        Swal.fire({
                        icon: 'error',
                        title: 'Cannot Add Task',
                        text: res.msg
                        }); 
                    }

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });        
    });

    function formatRepoCustomerSelection(repo) {
        if (repo.first_name != null) {
            return repo.first_name + ' ' + repo.last_name;
        } else {
            return repo.text;
        }
    }

    function formatRepoCustomer(repo) {
        if (repo.loading) {
            return repo.text;
        }

        var $container = $(
            '<div>' + repo.first_name + ' ' + repo.last_name + '<br /><small>' + repo.phone_m + ' / ' + repo.email + '</small></div>'
        );

        return $container;
    }

    function formatRepoUser(repo) {
        if (repo.loading) {
            return repo.text;
        }

        var $container = $(
            '<div><div class="autocomplete-left"><img class="autocomplete-img" src="' + repo.user_image + '" /></div><div class="autocomplete-right">' + repo.FName + ' ' + repo.LName + '<br /><small>' + repo.email + '</small></div></div>'
        );

        return $container;
    }

    function formatRepoSelectionUser(repo) {
        return (repo.FName) ? repo.FName + ' ' + repo.LName : repo.text;
    }    

</script>
<?php include viewPath('v2/includes/footer'); ?>