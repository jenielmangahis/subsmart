<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/workorder/workorder_modals'); ?>
<style>
    table.dataTable thead th {
        border-bottom: 1px solid #111;
    }

    table.dataTable tfoot th {
        border-top: 1px solid #111;
    }

    tbody,
    td,
    tfoot,
    th,
    thead,
    tr {
        border-color: white;
    }

    td {
        text-align: left;
    }

    .table-icon {
        text-align: center;
        width: 50px;
    }

    /* .work_order {
        width: 150px;
    }

    .badge_order {
        width: 100px;
    } */

    .action {
        text-align: center;
        width: 50px;
    }

    .fa {
        padding: 2px;
    }
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/sales'); ?>
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
                        <!-- <form action="<?php echo base_url('workorder') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" value="<?php echo (!empty($search)) ? $search : '' ?>" placeholder="Search Work Order">
                            </div>
                        </form> -->
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Batch Actions </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" id="delete-selected">Delete</a></li>
                            </ul>
                        </div>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span id="selectedSortOption">Sort by Date Issued: Newest </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" href="<?php echo base_url('/accounting/workorder') ?>?order=date-issued-desc">Date Issued: Newest</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('/accounting/workorder') ?>?order=date-issued-asc">Date Issued: Oldest</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('/accounting/workorder') ?>?order=event-date-desc">Scheduled Date: Newest</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('/accounting/workorder') ?>?order=event-date-asc">Scheduled Date: Oldest</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('/accounting/workorder') ?>?order=date-completed-desc">Completed Date: Newest</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('/accounting/workorder') ?>?order=date-completed-asc">Completed Date: Oldest</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('/accounting/workorder') ?>?order=number-asc">Work Order #: A to Z</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('/accounting/workorder') ?>?order=number-desc">Work Order #: Z to A</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('/accounting/workorder') ?>?order=priority-asc">Priority: A to Z</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('/accounting/workorder') ?>?order=priority-desc">Priority: Z to A</a></li>
                            </ul>
                        </div>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                    Filter by <?= ucwords($tab_status); ?>
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" href="<?php echo base_url('/accounting/workorder') ?>">All</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('/accounting/workorder?status=new') ?>">New</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('/accounting/workorder?status=scheduled') ?>">Scheduled</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('/accounting/workorder?status=started') ?>">Started</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('/accounting/workorder?status=paused') ?>">Paused</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('/accounting/workorder?status=invoiced') ?>">Invoiced</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('/accounting/workorder?status=withdrawn') ?>">Withdrawn</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('/accounting/workorder?status=closed') ?>">Closed</a></li>
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" onclick="location.href='<?php echo base_url('workorder/work_order_templates') ?>'">
                                <i class='bx bx-fw bx-window-alt'></i> Industry Templates
                            </button>
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#new_workorder_modal_accounting">
                                <i class='bx bx-fw bx-task'></i> New Work Order
                            </button>
                            <button type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('workorder/settings') ?>'">
                                <i class='bx bx-fw bx-cog'></i>
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table" id="dataTableWork">
                    <thead>
                        <tr>
                            <td class="table-icon">
                                <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                            </td>
                            <td class="work_order" data-name="Work Order Number">Work Order Number</td>
                            <td class="work_order" data-name="Date Issued">Date Created</td>
                            <td class="work_order" data-name="Customer">Customer</td>
                            <td class="work_order" data-name="Employees">Employees</td>
                            <td class="badge_order" data-name="Priority">Priority</td>
                            <td class="badge_order" data-name="Status">Status</td>
                            <td class="work_order" data-name="Total Amount">Total Amount</td>
                            <td class="action" data-name="Manage"></td>
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
                                    <td class="table-icon">
                                        <div class="table-row-icon table-checkbox">
                                            <input class="form-check-input select-one table-select" type="checkbox" name="id[<?php echo $workorder->id ?>]" value="<?php echo $workorder->id ?>" id="work_order_id_<?php echo $workorder->id ?>">
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?= //workordermodule__formatWorkOrderNumber($workorder->work_order_number) 
                                                                            $workorder->work_order_number ?></td>
                                    <td><?php echo date('M d, Y', strtotime($workorder->date_created)) ?></td>
                                    <td>
                                        <a href="<?php echo base_url('customer/view/' . $workorder->customer_id) ?>" class="nsm-link">
                                            <?php
                                            //echo $workorder->first_name . ' ' .  $workorder->middle_name . ' ' . $workorder->last_name; 
                                            if (empty($workorder->first_name)) {
                                                echo $workorder->contact_name;
                                            } else {

                                                echo $workorder->first_name . ' ' .  $workorder->middle_name . ' ' . $workorder->last_name;
                                            }
                                            ?></a>
                                        <label class="d-block">Issued on:
                                            <?php //echo date_format($workorder->first_name, 'd M Y H:i:s') 
                                            if ($workorder->work_order_type_id == '4') {
                                                echo date("M d Y", strtotime($workorder->date_created));
                                            } else if ($workorder->work_order_type_id == '3') {
                                                echo date("M d Y", strtotime($workorder->date_created));
                                            } else {
                                                echo date("M d Y", strtotime($workorder->date_issued));
                                            }
                                            ?>
                                        </label>
                                    </td>
                                    <td><?php echo get_user_by_id($workorder->employee_id)->FName . ' ' . get_user_by_id($workorder->employee_id)->LName ?></td>
                                    <td><span class="nsm-badge <?= $prio_badge ?>"><?php echo $workorder->priority; ?></span></td>
                                    <td><span class="nsm-badge <?= $status_badge ?>"><?php echo $workorder->w_status; ?></span></td>
                                    <td></td>
                                    <td class="action">
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('workorder/view/' . $workorder->id) ?>">
                                                        <i class="fa fa-eye"></i> View
                                                    </a>
                                                </li>
                                                <li>
                                                    <?php if ($workorder->work_order_type_id == '2') { ?>
                                                        <a class="dropdown-item" tabindex="-1" href="<?php echo base_url('workorder/editAlarm/' . $workorder->id) ?>"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                    <?php } elseif ($workorder->work_order_type_id == '3') { ?>
                                                        <a class="dropdown-item" tabindex="-1" href="<?php echo base_url('workorder/editWorkorderSolar/' . $workorder->id) ?>"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                    <?php  } elseif ($workorder->work_order_type_id == '4') { ?>
                                                        <a class="dropdown-item" tabindex="-1" href="<?php echo base_url('workorder/editInstallation/' . $workorder->id) ?>"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                    <?php } else { ?>
                                                        <a class="dropdown-item" tabindex="-1" href="<?php echo base_url('workorder/edit/' . $workorder->id) ?>"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                    <?php } ?>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item clone-item" href="javascript:void(0);" data-id="<?php echo $workorder->id ?>" data-wo_num="<?php echo $workorder->work_order_number ?>" data-bs-toggle="modal" data-bs-target="#clone_workorder_modal">
                                                        <i class="fa fa-clone"></i> Clone Work Order
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('/accounting/addnewInvoice?workorder_id=' . $workorder->id) ?>">
                                                        <i class="fa fa-plus" style="margin-right: 0.5em;"></i>Create Invoice
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" data-work-id="<?php echo $workorder->id; ?>">
                                                        <i class="fa fa-trash" style="margin-right: 0.5em;"></i>Delete
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('job/work_order_job/' . $workorder->id) ?>">
                                                        <i class="fa fa-exchange"></i> Convert To Jobs
                                                    </a>
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
<!-- //cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css -->
<!-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" /> -->
<script>
    $(document).ready(function() {
        $('#dataTableWork').nsmPagination({
            itemsPerPage: 10
        });

        $('#select-all').click(function() {
            $('.select-one').prop('checked', this.checked);
            logSelectedIds();
        });

        $('.select-one').click(function() {
            if ($('.select-one:checked').length === $('.select-one').length) {
                $('#select-all').prop('checked', true);
            } else {
                $('#select-all').prop('checked', false);
            }
            logSelectedIds();
        });

        function logSelectedIds() {
            var selectedIds = [];
            $('.select-one:checked').each(function() {
                selectedIds.push($(this).val());
            });
            console.log("Selected IDs:", selectedIds);
        }

        $(document).on("click", ".clone-item", function() {
            let num = $(this).attr('data-wo_num');
            let id = $(this).attr('data-id');

            $('.work_order_no').text(num);
            $('#wo_id').val(id);
        });

        $("#clone_workorder").on("click", function() {
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

        $("#delete-selected").click(function() {
            var selectedIds = logSelectedIds();
            console.log('selectedIds', selectedIds);
            if (selectedIds.length > 0) {
                Swal.fire({
                    title: 'Delete Selected Work Orders',
                    text: "Are you sure you want to delete these selected Work Orders?",
                    icon: 'question',
                    confirmButtonText: 'Proceed',
                    showCancelButton: true,
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: 'POST',
                            url: "<?php echo base_url(); ?>workorder/delete_selected_workorders",
                            data: {
                                ids: selectedIds
                            },
                            success: function(result) {
                                Swal.fire({
                                    title: 'Good job!',
                                    text: "Selected Work Orders Deleted Successfully!",
                                    icon: 'success'
                                }).then((result) => {
                                    location.reload();
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error("Failed to delete selected work orders:", error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Failed to delete selected work orders.'
                                });
                            }
                        });
                    }
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Work Orders Selected',
                    text: 'Please select at least one Work Order to delete.',
                });
            }
        });

        function logSelectedIds() {
            var selectedIds = [];
            $('.select-one:checked').each(function() {
                selectedIds.push($(this).val());
            });
            return selectedIds;
        }

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