<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/workorder/workorder_modals'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
    <ul class="nsm-fab-options">
        <li onclick="location.href='<?php echo base_url('workorder/work_order_templates') ?>'">
            <div class="nsm-fab-icon">
                <i class="bx bx-window-alt"></i>
            </div>
            <span class="nsm-fab-label">Industry Templates</span>
        </li>
        <li data-bs-toggle="modal" data-bs-target="#new_workorder_modal">
            <div class="nsm-fab-icon">
                <i class="bx bx-task"></i>
            </div>
            <span class="nsm-fab-label">New Work Order</span>
        </li>
        <li onclick="location.href='<?php echo base_url('workorder/settings') ?>'">
            <div class="nsm-fab-icon">
                <i class="bx bx-cog"></i>
            </div>
            <span class="nsm-fab-label">Settings</span>
        </li>
    </ul>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/workorder_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Work order are are crucial to an organization’s maintenance operation. They help everyone from maintenance managers to technicians organize, assign, prioritize, track, and complete key tasks. When done well, work orders allow you to capture information, share it, and use it to get the work done as efficiently as possible. Our work order has legal headers and two (2) places where you can outline specific terms. This form will empower you team to move forward with each project without looking backward. Signature place holders and specific term(s) statements will help make this work order into a binding agreement.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('workorder') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" value="<?php echo (!empty($search)) ? $search : '' ?>" placeholder="Search Work Order">
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Sort by Date Issued: Newest</span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" href="<?php echo base_url('workorder') ?>?order=date-issued-desc">Date Issued: Newest</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('workorder') ?>?order=date-issued-asc">Date Issued: Oldest</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('workorder') ?>?order=event-date-desc">Scheduled Date: Newest</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('workorder') ?>?order=event-date-asc">Scheduled Date: Oldest</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('workorder') ?>?order=date-completed-desc">Completed Date: Newest</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('workorder') ?>?order=date-completed-asc">Completed Date: Oldest</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('workorder') ?>?order=number-asc">Work Order #: A to Z</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('workorder') ?>?order=number-desc">Work Order #: Z to A</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('workorder') ?>?order=priority-asc">Priority: A to Z</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('workorder') ?>?order=priority-desc">Priority: Z to A</a></li>
                            </ul>
                        </div>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                Filter by <?= ucwords($tab_status); ?>
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" href="<?php echo base_url('workorder') ?>">All</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('workorder?status=new') ?>">New</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('workorder?status=scheduled') ?>">Scheduled</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('workorder?status=started') ?>">Started</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('workorder?status=paused') ?>">Paused</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('workorder?status=invoiced') ?>">Invoiced</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('workorder?status=withdrawn') ?>">Withdrawn</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('workorder?status=closed') ?>">Closed</a></li>
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" onclick="location.href='<?php echo base_url('workorder/work_order_templates') ?>'">
                                <i class='bx bx-fw bx-window-alt'></i> Industry Templates
                            </button>
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#new_workorder_modal">
                                <i class='bx bx-fw bx-task'></i> New Work Order
                            </button>
                            <button type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('workorder/settings') ?>'">
                                <i class='bx bx-fw bx-cog'></i>
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon text-center">
                                <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                            </td>
                            <td data-name="Work Order Number">Work Order Number</td>
                            <td data-name="Date Issued">Date Issued</td>
                            <td data-name="Customer">Customer</td>
                            <td data-name="Employees">Employees</td>
                            <td data-name="Priority">Priority</td>
                            <td data-name="Status">Status</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($workorders)) :
                        ?>
                            <?php
                            foreach ($workorders as $workorder) :
                                switch ($workorder->priority):
                                    case "Emergency":
                                        $prio_badge = "error";
                                        break;
                                    case "Low":
                                        $prio_badge = "secondary";
                                        break;
                                    case "Standard":
                                        $prio_badge = "success";
                                        break;
                                    case "Urgent":
                                        $prio_badge = "primary";
                                        break;
                                endswitch;

                                switch ($workorder->w_status):
                                    case "New":
                                        $status_badge = "success";
                                        break;
                                    case "Draft":
                                        $status_badge = "";
                                        break;
                                    case "Scheduled":
                                        $status_badge = "secondary";
                                        break;
                                    case "Started":
                                        $status_badge = "primary";
                                        break;
                                    case "Paused":
                                        $status_badge = "secondary";
                                        break;
                                    case "Completed":
                                        $status_badge = "success";
                                        break;
                                    case "Invoiced":
                                        $status_badge = "success";
                                        break;
                                    case "Withdrawn":
                                        $status_badge = "success";
                                        break;
                                    case "Closed":
                                        $status_badge = "success";
                                        break;
                                endswitch;
                            ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon table-checkbox">
                                            <input class="form-check-input select-one table-select" type="checkbox" name="id[<?php echo $workorder->id ?>]" value="<?php echo $workorder->id ?>" id="work_order_id_<?php echo $workorder->id ?>">
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?php echo $workorder->work_order_number ?></td>
                                    <td><?php echo date('M d, Y', strtotime($workorder->date_created)) ?></td>
                                    <td>
                                        <a href="<?php echo base_url('customer/view/' . $workorder->customer_id) ?>" class="nsm-link">
                                        <?php 
                                            //echo $workorder->first_name . ' ' .  $workorder->middle_name . ' ' . $workorder->last_name; 
                                            if(empty($workorder->first_name)){
                                                echo $workorder->contact_name;
                                            }else{

                                                echo $workorder->first_name . ' ' .  $workorder->middle_name . ' ' . $workorder->last_name;
                                            }
                                        ?></a>
                                        <label class="d-block">Issued on: 
                                            <?php //echo date_format($workorder->first_name, 'd M Y H:i:s') 
                                                echo date("d M Y H:i:s", strtotime($workorder->date_issued));
                                            ?>
                                        </label>
                                    </td>
                                    <td><?php echo get_user_by_id($workorder->employee_id)->FName . ' ' . get_user_by_id($workorder->employee_id)->LName ?></td>
                                    <td><span class="nsm-badge <?= $prio_badge ?>"><?php echo $workorder->priority; ?></span></td>
                                    <td><span class="nsm-badge <?= $status_badge ?>"><?php echo $workorder->w_status; ?></span></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('workorder/view/' . $workorder->id) ?>">View</a>
                                                </li>
                                                <li>
                                                    <?php if($workorder->work_order_type_id == '2'){ ?>
                                                        <a class="dropdown-item" tabindex="-1" href="<?php echo base_url('workorder/editAlarm/' . $workorder->id) ?>"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                    <?php }elseif($workorder->work_order_type_id == '3')
                                                    { ?>
                                                    <a class="dropdown-item" tabindex="-1" href="<?php echo base_url('workorder/editSolar/' . $workorder->id) ?>"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                    <?php  }elseif($workorder->work_order_type_id == '4'){ ?>
                                                    <a class="dropdown-item" tabindex="-1" href="<?php echo base_url('workorder/editInstallation/' . $workorder->id) ?>"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                    <?php } else{ ?>
                                                        <a class="dropdown-item" tabindex="-1" href="<?php echo base_url('workorder/edit/' . $workorder->id) ?>"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                    <?php } ?>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item clone-item" href="javascript:void(0);" data-id="<?php echo $workorder->id ?>" data-wo_num="<?php echo $workorder->work_order_number ?>" data-bs-toggle="modal" data-bs-target="#clone_workorder_modal">Clone Work Order</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('invoice') ?>">Create Invoice</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" data-work-id="<?php echo $workorder->id; ?>">Delete</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('job/work_order_job/' . $workorder->id) ?>">Convert To Jobs</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="8">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();

        $("#select-all").on("change", function() {
            let isChecked = $(this).is(":checked");

            if (isChecked)
                $(".nsm-table").find(".select-one").prop("checked", true);
            else
                $(".nsm-table").find(".select-one").prop("checked", false);
        });

        $(document).on("click", ".clone-item", function() {
            let num = $(this).attr('data-wo_num');
            let id = $(this).attr('data-id');

            $('.work_order_no').text(num);
            $('#wo_id').val(id);
        });

        $("#clone_workorder").on("click", function(){
            let wo_num = $('#wo_id').val();

            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>workorder/duplicate_workorder",
                data: {
                    wo_num: wo_num
                },
                success: function(result) {
                    Swal.fire({
                        title: 'Good job!',
                        text: "Data Cloned Successfully!",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            location.reload();
                        //}
                    });
                },
            });
        });

        $(document).on("click", ".delete-item", function() {
            let id = $(this).attr('data-work-id');
            console.log(id);

            Swal.fire({
                title: 'Delete Work Order',
                text: "Are you sure you want to delete this Work Order?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url(); ?>workorder/delete_workorder",
                        data: {
                            id: id
                        },
                        success: function(result) {
                            Swal.fire({
                                title: 'Good job!',
                                text: "Data Deleted Successfully!",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                        },
                    });
                }
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>