<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/workorder/workorder_modals'); ?>

<?php

function workordermodule__formatWorkOrderNumber($number) {
    $formatFunc = function ($prefix, $number) {
        $numericPart = (int) str_replace($prefix, '', $number);
        return 'WO-' . str_pad($numericPart, 7, '0', STR_PAD_LEFT);
    };

    if (strpos(strtoupper($number), 'WO-') === 0) {
        return $formatFunc('WO-', $number);
    }

    if (strpos(strtoupper($number), 'WO') === 0) {
        return $formatFunc('WO', $number);
    }

    return $number;
}

?>
<style>
.dataTables_filter, .dataTables_length{
    display: none;
}
</style>
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
        <?php include viewPath('v2/includes/page_navigations/workorder_tabs_v2'); ?>
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
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter primary h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-calendar'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id=""><?= count($scheduledWorkorders); ?></h2>
                                    <span>Total Scheduled Workorders</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter secondary h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-calendar-exclamation'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id=""><?= count($newWorkorders); ?></h2>
                                    <span>Total New Workorders</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row  mt-5">
                    <div class="col-12 col-md-4">
                        <div class="nsm-field-group search form-group">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="CUSTOM_SEARCHBAR" placeholder="Search Workorder">
                        </div>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Sort by <?= $sort_selected; ?></span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" href="<?php echo base_url('workorder') ?>?order=amount-asc">Amount : Lowest</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('workorder') ?>?order=amount-desc">Amount: Highest</a></li>

                                <li><a class="dropdown-item" href="<?php echo base_url('workorder') ?>?order=date-issued-desc">Date Issued: Newest</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('workorder') ?>?order=date-issued-asc">Date Issued: Oldest</a></li>
                                <!-- <li><a class="dropdown-item" href="<?php echo base_url('workorder') ?>?order=event-date-desc">Scheduled Date: Newest</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('workorder') ?>?order=event-date-asc">Scheduled Date: Oldest</a></li> -->

                                <!-- <li><a class="dropdown-item" href="<?php echo base_url('workorder') ?>?order=date-completed-desc">Completed Date: Newest</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('workorder') ?>?order=date-completed-asc">Completed Date: Oldest</a></li> -->
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
                            <?php if(checkRoleCanAccessModule('work-orders', 'write')){ ?>
                            <button type="button" class="nsm-button" onclick="location.href='<?php echo base_url('workorder/work_order_templates') ?>'">
                                <i class='bx bx-fw bx-window-alt'></i> Industry Templates
                            </button>
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#new_workorder_modal">
                                <i class='bx bx-fw bx-task'></i> New Work Order
                            </button>                            
                            <button type="button" class="nsm-button primary" id="archived-workorder-list">
                                <i class='bx bx-fw bx-trash'></i> Manage Archived
                            </button>
                            <?php } ?>
                            <button type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('workorder/settings') ?>'">
                                <i class='bx bx-fw bx-cog'></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <table class="nsm-table" id="workorder-list">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Work Order Number">Work Order Number</td>                            
                            <td data-name="Customer">Customer</td>
                            <td data-name="Employees">Employees</td>
                            <td data-name="Total">Amount</td>
                            <td data-name="Priority">Priority</td>
                            <td data-name="Status">Status</td>
                            <td data-name="Date Created" style="width:8%;">Date Created</td>
                            <td data-name="Manage" style="width:3%;"></td>
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
                                        <div class="table-row-icon"><i class='bx bx-briefcase'></i></div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary" style="width:10%;"><?= workordermodule__formatWorkOrderNumber($workorder->work_order_number) ?></td>
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
                                                if($workorder->work_order_type_id == '4'){
                                                    echo date("M d Y", strtotime($workorder->date_created));
                                                }else if($workorder->work_order_type_id == '3')
                                                {
                                                    echo date("M d Y", strtotime($workorder->date_created));
                                                }
                                                else{
                                                    echo date("M d Y", strtotime($workorder->date_issued));
                                                }
                                            ?>
                                        </label>
                                    </td>
                                    <td><?php echo get_user_by_id($workorder->employee_id)->FName . ' ' . get_user_by_id($workorder->employee_id)->LName ?></td>
                                    <td>$<?= number_format($workorder->grand_total, 2); ?></td>
                                    <td><span class="nsm-badge <?= $prio_badge ?>"><?php echo $workorder->priority; ?></span></td>
                                    <td><span class="nsm-badge <?= $status_badge ?>"><?php echo $workorder->w_status; ?></span></td>
                                    <td><?php echo date('m/d/Y', strtotime($workorder->date_created)) ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('workorder/view/' . $workorder->id) ?>">View</a>
                                                </li>
                                                <?php if(checkRoleCanAccessModule('work-orders', 'write')){ ?>
                                                <li>
                                                    <?php if($workorder->work_order_type_id == '2'){ ?>
                                                        <a class="dropdown-item" tabindex="-1" href="<?php echo base_url('workorder/editAlarm/' . $workorder->id) ?>"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                    <?php }elseif($workorder->work_order_type_id == '3')
                                                    { ?>
                                                    <a class="dropdown-item" tabindex="-1" href="<?php echo base_url('workorder/editWorkorderSolar/' . $workorder->id) ?>"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
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
                                                <?php } ?>
                                                <?php if(checkRoleCanAccessModule('work-orders', 'delete')){ ?>
                                                <li>
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" data-work-id="<?php echo $workorder->id; ?>" data-wo_num="<?php echo $workorder->work_order_number ?>">Delete</a>
                                                </li>
                                                <?php } ?>
                                                <?php if(checkRoleCanAccessModule('work-orders', 'write')){ ?>
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('job/work_order_job/' . $workorder->id) ?>">Convert To Jobs</a>
                                                </li>
                                                <?php } ?>
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
        var LIST_TABLE = $("#workorder-list").DataTable({
            "ordering": false,
            language: {
                processing: '<span>Fetching data...</span>'
            },
        });

        $("#CUSTOM_SEARCHBAR").keyup(function() {
            LIST_TABLE.search($(this).val()).draw()
        });

        //$("#workorder-list").nsmPagination({itemsPerPage:10});

        $("#select-all").on("change", function() {
            let isChecked = $(this).is(":checked");

            if (isChecked)
                $(".nsm-table").find(".select-one").prop("checked", true);
            else
                $(".nsm-table").find(".select-one").prop("checked", false);
        });

        <?php if(checkRoleCanAccessModule('work-orders', 'write')){ ?>
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

        $('#archived-workorder-list').on('click', function(){
            $('#modal-archived-workorder').modal('show');
            $.ajax({
                type: "POST",
                url: base_url + "workorder/_archived_list",  
                success: function(html) {    
                    $('#workorder-archived-list-container').html(html);                          
                },
                beforeSend: function() {
                    $('#workorder-archived-list-container').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $(document).on('click', '.btn-restore-workorder', function(){
            var workorder_id = $(this).attr('data-id');
            var workorder_number = $(this).attr('data-worknumber');

            Swal.fire({
                title: 'Restore Workorder Data',
                html: `Proceed with restoring workoder data <b>${workorder_number}</b>?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {                    
                    $.ajax({
                        type: "POST",
                        url: base_url + "workorder/_restore_archived",
                        data: {workorder_id:workorder_id},
                        dataType:'json',
                        success: function(result) {                            
                            if( result.is_success == 1 ) {
                                $('#modal-archived-workorder').modal('hide');
                                Swal.fire({
                                icon: 'success',
                                title: 'Restore Workorder',
                                text: 'Workorder data was successfully restored.',
                                }).then((result) => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: result.msg,
                                });
                            }
                        }
                    });
                }
            });
        });
        <?php } ?>

        <?php if(checkRoleCanAccessModule('work-orders', 'delete')){ ?>
        $(document).on("click", ".delete-item", function() {
            let id = $(this).attr('data-work-id');
            let wonum = $(this).attr('data-wo_num');

            Swal.fire({
                title: 'Delete Work Order',
                html: `Are you sure you want to delete work order number <b>${wonum}</b>?`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url(); ?>workorder/delete_workorder",
                        data: {id: id},
                        dataType:'json',
                        success: function(result) {
                            if( result.is_success == 1 ){
                                Swal.fire({
                                    title: 'Delete Work Order',
                                    text: 'Workorder deleted successfully!',
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        location.reload();
                                    }
                                });
                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                   text: 'Cannot find data',
                                });
                            }
                            
                        },
                    });
                }
            });
        });
        <?php } ?>
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>