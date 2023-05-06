<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/calendar/calendar_modals'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
    <ul class="nsm-fab-options">
        <li>
            <div class="nsm-fab-icon">
                <i class="bx bx-check"></i>
            </div>
            <span class="nsm-fab-label">Clear All</span>
        </li>
        <!-- <li>
            <div class="nsm-fab-icon">
                <i class="bx bx-search"></i>
            </div>
            <span class="nsm-fab-label">Search Task</span>
        </li> -->
        <li onclick="location.href='<?php echo base_url('taskhub/entry') ?>'">
            <div class="nsm-fab-icon">
                <i class="bx bx-user-plus"></i>
            </div>
            <span class="nsm-fab-label">Add Task</span>
        </li>
    </ul>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/calendar_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 grid-mb">
                        <div class="nsm-callout primary">
                            You can set up Tasks for yourself and assign them to other people in your organization. To Add a Task, in the Account, click on the ‘ + Add ‘ button. There are dropdown options for each field and a date picker.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <?php if( $selected_customer_id == 0 ){ ?>
                            <button name="btn_clear" type="button" class="nsm-button btn-clear-all">
                                <i class='bx bx-fw bx-check'></i> Clear All
                            </button>
                            <button name="btn_add" type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('taskhub/entry'); ?>'">
                                <i class='bx bx-fw bx-plus'></i> Add Task
                            </button>
                            <?php } ?>
                            <!-- <button name="btn_search" type="button" class="nsm-button">
                                <i class='bx bx-fw bx-search'></i> Search Task
                            </button> -->
                            
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Subject">Subject</td>
                            <td data-name="Priority">Priority</td>
                            <td data-name="Customer">Customer</td>
                            <td data-name="Assigned">Assigned</td>
                            <td data-name="Status">Status</td>
                            <td data-name="Date Completion">Date Completion</td>
                            <td data-name="Date Created">Date Created</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($tasks) > 0) : ?>
                            <?php foreach ($tasks as $key => $row) : ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-task'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary nsm-link default" onclick="location.href='<?php echo url('taskhub/view/' . $row->task_id) ?>'"><?php echo $row->subject; ?></td>
                                    <td>
                                        <?php
                                        switch ($row->priority):
                                            case 'High':
                                                $class_priority = "error";
                                                break;
                                            case 'Medium':
                                                $class_priority = "secondary";
                                                break;
                                            case 'Low':
                                                $class_priority = "";
                                                break;
                                        endswitch;
                                        ?>
                                        <span class="nsm-badge <?= $class_priority ?>"><?php echo ucwords($row->priority); ?></span>
                                    </td>
                                    <td><?= getAcsProfileCustomerName($row->prof_id); ?></td>
                                    <td><?= getTaskAssignedUser($row->task_id); ?></td>
                                    <td>
                                    <?php
                                        switch ($row->status_text):
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
                                        <span class="nsm-badge <?= $task_status ?>"><?php echo $row->status_text; ?></span>
                                    </td>
                                    <td><?php echo date("F d, Y", strtotime($row->estimated_date_complete)); ?></td>
                                    <td><?php echo date("F d, Y", strtotime($row->date_created)); ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" name="dropdown_link" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" name="dropdown_edit" href="<?php echo url('taskhub/entry/' . $row->task_id) ?>">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item btn-complete-task" name="dropdown_completed" href="javascript:void(0);" data-subject="<?= $row->subject; ?>" data-id="<?= $row->task_id; ?>">Mark Completed</a>
                                                </li>
                                                <!-- <li>
                                                    <a class="dropdown-item" name="dropdown_updated" href="<?php echo url('taskhub/addupdate/' . $row->task_id) ?>">Add Update</a>
                                                </li> -->
                                                <li>
                                                    <a class="dropdown-item" name="dropdown_view_comments" href="<?php echo url('taskhub/view/' . $row->task_id) ?>">Add Update</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="9">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();

        $(".btn-clear-all").on("click", function() {
            let id = $(this).attr('data-id');
            let name = $(this).attr("data-name");
            let selected_customer_id = '<?= $selected_customer_id; ?>';

            Swal.fire({
                title: 'Clear All',
                text: "This will mark all tasks as completed. Proceed with action?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url('taskhub/_mark_all_completed'); ?>",
                        dataType: 'json',
                        data: {selected_customer_id:selected_customer_id},
                        success: function(result) {
                            if (result.is_success == 1) {
                                Swal.fire({
                                    title: 'Update Successful!',
                                    text: "Taskhub data is successfully updated!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        location.reload();
                                    }
                                });
                            } else {
                                Swal.fire({
                                    title: 'An Error Occured',
                                    text: "No changes will be made.",
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        location.reload();
                                    }
                                });
                            }
                        },
                    });
                }
            });
        });

        $(document).on("click", ".btn-complete-task", function() {
            let id = $(this).attr('data-id');
            let subject = $(this).attr("data-subject");

            Swal.fire({
                title: 'Complete Task',
                text: "Are you sure you want to mark as completed task: " + subject + "?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url('taskhub/_task_mark_completed'); ?>",
                        dataType: 'json',
                        data: {
                            tsid: id
                        },
                        success: function(result) {
                            console.log(result);
                            if (result.is_success == 1) {
                                Swal.fire({
                                    title: 'Update Successful!',
                                    text: "Taskhub data is successfully updated!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        location.reload();
                                    }
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
                                        location.reload();
                                    }
                                });
                            }
                        },
                    });
                }
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>