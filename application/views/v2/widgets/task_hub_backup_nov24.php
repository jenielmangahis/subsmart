<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '<div class="col-12 col-lg-4">';
    endif;
?>
<style>
.widget-taskhub .bx {
    font-size: 23px !important;
    background-color:transparent !important;
}
</style>
<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>TaskHub</span>
        </div>
        <div class="nsm-card-controls">
            <a role="button" class="nsm-button btn-sm m-0 me-2 btn-complete-all" href="javascript:void(0);">
                Clear All
            </a>
            <a role="button" class="nsm-button btn-sm m-0 me-2 btn-add-task" href="javascript:void(0);">
                Add Task
            </a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" onclick="addToMain('<?= $id ?>',<?php echo ($isMain?'1':'0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain?'Remove From Main':'Add to Main') ?></a></li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class='nsm-card-footer widget-taskhub'>
        <div class="row h-100 g-2">
            <div class="col-12 col-md-6">
                <div class="nsm-counter success h-100 mb-2">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                            <i class='bx bx-calendar' ></i>                            
                        </div>
                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                            <h3 id="taskhub-today">0</h3>
                            <span>Today</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="nsm-counter primary h-100 mb-2">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                            <i class='bx bx-calendar-check' ></i>
                        </div>
                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                            <h3 id="taskhub-shared-task">0</h3>
                            <span>Shared Task</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="nsm-counter success h-100 mb-2">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                            <i class='bx bxs-inbox'></i>
                        </div>
                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                            <h2 id="taskhub-activities">0</h2>
                            <span>Activities</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="nsm-counter h-100 mb-2">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                            <i class='bx bxs-flag-alt'></i>
                        </div>
                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                            <h2 id="taskhub-flagged">0</h2>
                            <span>Flagged</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="nsm-counter error h-100 mb-2">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                            <i class='bx bx-check-circle'></i>
                        </div>
                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                            <h2 id="taskhub-done">0</h2>
                            <span>Done</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="nsm-counter primary h-100 mb-2">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                            <i class='bx bx-list-ol' ></i>
                        </div>
                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                            <h2 id="taskhub-my-tasks">0</h2>
                            <span>My Tasks</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    var enable_clear_all = false;
    
    $(document).ready(function(){
        loadTaskhubSummary();
    });

    $(document).on('click','.btn-task-list',function(){
        var url = base_url + 'taskhub/_load_taskhub_list';

        $('#modalTaskHubList').modal('show');
        $(".modal-taskhub-list-container").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             success: function(o)
             {          
                $('.modal-taskhub-list-container').html(o);
             }
          });
        }, 800);        
    });

    $(document).on('click', '.btn-complete-all', function(){
        var url = base_url + 'taskhub/_mark_all_completed';

        Swal.fire({
            title: 'Clear All',
            html: "This will mark all tasks as completed. Proceed with action?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: 'json',
                    success: function(o) {
                        if( o.is_success == 1 ){   
                            Swal.fire({
                                title: 'Update Successful!',
                                text: "Taskhub Data Successfully Updated!",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                //if (result.value) {
                                    location.reload();
                                //}
                            });
                        }else{
                          Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: o.msg
                          });
                        }
                    },
                });
            }
        });
    });

    $(document).on('click','.btn-add-task',function(){
        var url = base_url + 'taskhub/_add_new_task';

        $('#modalTaskHubList').modal('hide');
        $('#modalAddTaskHub').modal('show');
        $(".modal-add-new-task-container").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             success: function(o)
             {          
                $('.modal-add-new-task-container').html(o);
             }
          });
        }, 800);        
    });

    $(document).on('submit', '#frm-add-new-task', function(e){
        e.preventDefault();
        var url = base_url + 'taskhub/_save_task';
        $(".btn-save-task").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-add-new-task")[0]);   

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: 'json',
             contentType: false,
             cache: false,
             processData:false,
             data: formData,
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
                        //if (result.value) {
                        loadTaskhubSummary();
                        //}
                    });
                }else{
                  Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: o.msg
                  });
                } 

                $(".btn-save-task").html('Save');
             }
          });
        }, 800);
    });

    function loadTaskhubSummary(){
        $.ajax({
            url: base_url + 'widgets/_load_taskhub_summary',
            method: 'get',
            data: {},
            dataType: 'json',
            beforeSend: function() {
                var loader = "<span class='bx bx-loader bx-spin'></span>";
                $('#taskhub-today').html(loader);
                $('#taskhub-activities').html(loader);
                $('#taskhub-shared-task').html(loader);
                $('#taskhub-flagged').html(loader);
                $('#taskhub-done').html(loader);
                $('#taskhub-my-tasks').html(loader);
            },
            success: function (data) {
                $('#taskhub-today').html(data.todaysTask);
                $('#taskhub-shared-task').html(data.sharedTasks);
                $('#taskhub-flagged').html(data.flaggedTasks);
                $('#taskhub-activities').html(data.activitiesTasks);
                $('#taskhub-done').html(data.completedTasks);
                $('#taskhub-my-tasks').html(data.totalAssignedTasks);
            },
        });
    }
</script>

<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '</div>';
    endif;
?>