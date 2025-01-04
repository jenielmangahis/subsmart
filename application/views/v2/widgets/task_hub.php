<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '<div class="col-12 col-lg-4">';
endif;
?>
<style>
    .widget-taskhub .bx {
        font-size: 23px !important;
        background-color: transparent !important;
    }

    .taskhub-items-container {
        padding: 10px
    }

    .taskhub-items-container .item {
        display: block;
        padding: 10px;
        color: #214548;
        border-radius: 10px;
        gap: 10px;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        box-shadow: 0px 3px 12px #38747859;
        height: 100%;
        width: 90%;
        margin: auto;
    }

    .taskhub-items-container .item .first {
        display: flex;
        gap: 10px;
        align-items: center;
        margin-bottom: 5px;
        justify-content: center;
    }

    .taskhub-items-container .item .first .icons {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        height: 38px;
        width: 40px;
        border-radius: 100%;
    }

    .taskhub-items-container .item .count {
        width: 100%;
        text-align: left;
        color: #281c2d;
    }

    .taskhub-items-container .item .first label {
        font-size: 24px;
        font-weight: bold;
        line-height: 1;
    }

    .taskhub-items-container .item .count p {
        font-size: 14px;
        font-weight: 600;
        margin: 0;
        text-align: center;
    }

    @media screen and (max-width: 1366px) {
        .taskhub-items-container .col-4 {
            width: 50%;
        }
      
    }

    @media screen and (max-width: 991px) {
        .taskhub-items-container .col-4 {
            width: 33%;
        }
    }
    @media screen and (max-width: 567px) {
        .taskhub-items-container .col-4 {
            width: 50%;
        }
    }

    @media screen and (max-width: 390px) {
        .taskhub-items-container .col-4 {
            width: 100%;
        }
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
                    <li><a class="dropdown-item" href="#"
                            onclick="addToMain('<?= $id ?>',<?php echo $isMain ? '1' : '0'; ?>,'<?= $isGlobal ?>' )"><?php echo $isMain ? 'Remove From Main' : 'Add to Main'; ?></a>
                    </li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content">
        <div class="col-md-12">
            <div class="banner mb-3">
                <img src="./assets/img/overdue-invoices-banner2.svg" alt="">
            </div>
            <div class="row taskhub-items-container">

                <div class="col-4 mb-4">
                    <div class="row h-100">
                        <div class="item">
                            <div class="box" style="background:#FEA3032a"></div>
                            <div class="first">
                                <div class="icons" style="color:#FEA303;background:#FEA3031a">
                                    <i class='bx bx-calendar'></i>
                                </div>
                                <label id="taskhub-todaytask"></label>
                            </div>
                            <div class="count">
                                <p>Today</p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-4 mb-4">
                    <div class="row h-100">
                        <div class="item">
                            <div class="box" style="background:#d9a1a02a"></div>

                            <div class="first">
                                <div class="icons" style="color:#d9a1a0;background:#d9a1a01a">
                                    <i class='bx bx-calendar-check'></i>
                                </div>
                                <label id="taskhub-sharedtask">0</label>
                            </div>
                            <div class="count">
                                <p>Shared Task</p>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-4 mb-4">
                    <div class="row h-100">
                        <div class="item">
                            <div class="box" style="background:#A888B52a"></div>
                            <div class="first">
                                <div class="icons" style="color:#A888B5;background:#A888B51a">
                                    <i class='bx bxs-inbox'></i>
                                </div>
                                <label id="taskhub-activities">0</label>
                            </div>
                            <div class="count">
                                <p>Activities</p>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-4 mb-4">
                    <div class="row h-100">
                        <div class="item">
                            <div class="box" style="background:#EFB6C82a"></div>

                            <div class="first">
                                <div class="icons" style="color:#EFB6C8;background:#EFB6C81a">
                                    <i class='bx bxs-flag-alt'></i>
                                </div>
                                <label id="taskhub-flagged">0</label>
                            </div>
                            <div class="count">
                                <p>Flagged</p>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-4 mb-4">
                    <div class="row h-100">
                        <div class="item">
                            <div class="box" style="background:#FEA3032a"></div>
                            <div class="first">
                                <div class="icons" style="color:#FEA303;background:#FEA3031a">
                                    <i class='bx bx-check-circle'></i>
                                </div>
                                <label id="taskhub-done">0</label>
                            </div>
                            <div class="count">
                                <p>Done</p>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-4 mb-4">
                    <div class="row h-100">
                        <div class="item">
                            <div class="box" style="background:#A888B52a"></div>
                            <div class="first">
                                <div class="icons" style="color:#A888B5;background:#A888B51a">
                                    <i class='bx bx-list-ol'></i>
                                </div>
                                <label id="taskhub-mytasks">0</label>
                            </div>
                            <div class="count">
                                <p>My Tasks</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    var enable_clear_all = false;

    $(document).ready(function() {
        loadTaskhubSummary();
    });

    $(document).on('click', '.btn-task-list', function() {
        var url = base_url + 'taskhub/_load_taskhub_list';

        $('#modalTaskHubList').modal('show');
        $(".modal-taskhub-list-container").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function() {
            $.ajax({
                type: "POST",
                url: url,
                success: function(o) {
                    $('.modal-taskhub-list-container').html(o);
                }
            });
        }, 800);
    });

    $(document).on('click', '.btn-complete-all', function() {
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
                        if (o.is_success == 1) {
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
                        } else {
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

    $(document).on('click', '.btn-add-task', function() {
        var url = base_url + 'taskhub/_add_new_task';

        $('#modalTaskHubList').modal('hide');
        $('#modalAddTaskHub').modal('show');
        $(".modal-add-new-task-container").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function() {
            $.ajax({
                type: "POST",
                url: url,
                success: function(o) {
                    $('.modal-add-new-task-container').html(o);
                }
            });
        }, 800);
    });

    $(document).on('submit', '#frm-add-new-task', function(e) {
        e.preventDefault();
        var url = base_url + 'taskhub/_save_task';
        $(".btn-save-task").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-add-new-task")[0]);

        setTimeout(function() {
            $.ajax({
                type: "POST",
                url: url,
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                data: formData,
                success: function(o) {
                    if (o.is_success == 1) {
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
                    } else {
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

    function loadTaskhubSummary() {
        $.ajax({
            url: base_url + 'widgets/_load_taskhub_summary',
            method: 'get',
            data: {},
            dataType: 'json',
            beforeSend: function() {
                var loader = "<span class='bx bx-loader bx-spin'></span>";
                $('#taskhub-backlog').html(loader);
                $('#taskhub-doing').html(loader);
                $('#taskhub-reviewfail').html(loader);
                $('#taskhub-ontesting').html(loader);
                $('#taskhub-review').html(loader);
                $('#taskhub-done').html(loader);
                $('#taskhub-closed').html(loader);

                $('#taskhub-todaytask').html(loader);
                $('#taskhub-sharedtask').html(loader);
                $('#taskhub-mytasks').html(loader);
                $('#taskhub-flagged').html(loader);
                $('#taskhub-activities').html(loader);
            },
            success: function(data) {

                $('#taskhub-backlog').html(data.total_backlog);
                $('#taskhub-doing').html(data.total_task_doing);
                $('#taskhub-reviewfail').html(data.total_task_review_fail);
                $('#taskhub-ontesting').html(data.total_task_on_testing);
                $('#taskhub-review').html(data.total_task_review);
                $('#taskhub-closed').html(data.total_task_closed);

                $('#taskhub-todaytask').html(data.total_today_task);
                $('#taskhub-done').html(data.total_task_done);
                $('#taskhub-sharedtask').html(data.total_shared_task);
                $('#taskhub-mytasks').html(data.total_my_tasks);
                $('#taskhub-flagged').html(data.total_task_flagged);
                $('#taskhub-activities').html(data.total_task_activities);

            },
        });
    }
</script>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '</div>';
endif;
?>
