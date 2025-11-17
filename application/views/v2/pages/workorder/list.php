<?php include viewPath('v2/includes/header'); ?>
<?php //include viewPath('v2/includes/workorder/workorder_modals'); ?>

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
.swal2-html-container{
    overflow:hidden;
}
.user-change-status{
    text-align:left;
}
.techs > .nsm-profile {
    border: 2px solid #fff;
    box-sizing: content-box;
}
.nsm-profile {
    --size: 35px;
    max-width: var(--size);
    height: var(--size);
    min-width: var(--size);
}
.nsm-badge{
    width:90px;
    display:block;
    text-align:center;
}
#workorder-list th:first-child, td:first-child {
  /* text-align:center; */
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
    <ul class="nsm-fab-options">        
        <li data-bs-toggle="modal" data-bs-target="#new_workorder_modal">
            <div class="nsm-fab-icon">
                <i class="bx bx-task"></i>
            </div>
            <span class="nsm-fab-label">New Work Order</span>
        </li>
        <li onclick="location.href='<?php echo base_url('workorder/settings'); ?>'">
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
                                    <h2 id=""><?= count($totalWorkorders); ?></h2>
                                    <span>Total Work Orders</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter success h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-calendar'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id=""><?= count($scheduledWorkorders); ?></h2>
                                    <span>Total Scheduled Work Orders</span>
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
                                    <span>Total New Work Orders</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row  mt-5">
                    <div class="col-12 col-md-4">
                        <div class="nsm-field-group search form-group">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Workorder" value="">
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
                                Filter : <?= ucwords($tab_status); ?>
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" href="<?php echo base_url('workorder') ?>">All</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('workorder?status=new') ?>">New</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('workorder?status=submitted') ?>">Submitted</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('workorder?status=converted') ?>">Converted</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('workorder?status=finished') ?>">Finished</a></li>
                            </ul>
                        </div>
                        <?php if(checkRoleCanAccessModule('work-orders', 'write')){ ?>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span id="num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item btn-with-selected" id="with-selected-change-status" href="javascript:void(0);" data-action="change-status">Change Status</a></li>   
                                <li><a class="dropdown-item btn-with-selected" id="with-selected-delete" href="javascript:void(0);" data-action="delete">Delete</a></li>                                
                            </ul>
                        </div>
                        <?php } ?>
                        <div class="nsm-page-buttons page-button-container">
                            <?php if(checkRoleCanAccessModule('work-orders', 'write')){ ?>
                            <div class="btn-group">
                                <?php if( in_array(logged('company_id'), adi_company_ids()) ){ ?>
                                    <button type="button" class="btn btn-nsm" data-bs-toggle="modal" data-bs-target="#new_workorder_modal"><i class='bx bx-plus' style="position:relative;top:1px;"></i> Work Order</button>
                                <?php }else{ ?>
                                    <button type="button" class="btn btn-nsm" id="btn-add-new-workorder"><i class='bx bx-plus' style="position:relative;top:1px;"></i> Work Order</button>
                                <?php } ?>
                                
                                <button type="button" class="btn btn-nsm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class=""><i class='bx bx-chevron-down' ></i></span>
                                </button>
                                <ul class="dropdown-menu">                                                                    
                                    <li><a class="dropdown-item" href="<?= base_url('invoice'); ?>">Invoices</a></li>  
                                    <li><a class="dropdown-item" id="btn-archived" href="javascript:void(0);">Archived</a></li>                  
                                </ul>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <form id="frm-with-selected">
                <table class="nsm-table" id="workorder-list">
                    <thead>
                        <tr>
                            <?php if(checkRoleCanAccessModule('work-orders', 'write')){ ?>
                            <td class="table-icon text-center sorting_disabled">
                                <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                            </td>
                            <?php } ?>
                            <td class="table-icon"></td>
                            <td data-name="Work Order Number">Work Order Number</td>                            
                            <td data-name="Customer" style="width:20%;">Customer</td>
                            <td data-name="Date" style="width:10%;">Date</td>                            
                            <td data-name="Created By" style="width:10%;">Created By</td>                            
                            <td data-name="Priority" style="width:8%;">Priority</td>
                            <td data-name="Status" style="width:8%;">Status</td>
                            <td data-name="Total" style="text-align:right;width:10%;">Amount</td>                            
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
                                        $status_badge = "primary";
                                        break;
                                    case "Submitted":
                                        $status_badge = "";
                                        break;
                                    case "Converted":
                                        $status_badge = "secondary";
                                        break;
                                    case "Finished":
                                        $status_badge = "success";
                                        break;
                                endswitch;
                            ?>
                                <tr>
                                    <?php if(checkRoleCanAccessModule('work-orders', 'write')){ ?>
                                    <td>
                                        <input class="form-check-input row-select table-select" name="workorders[]" type="checkbox" value="<?= $workorder->id; ?>">
                                    </td>
                                    <?php } ?>
                                    <td>
                                        <div class="table-row-icon"><i class='bx bx-briefcase'></i></div>
                                    </td>
                                    <td class="fw-bold show nsm-text-primary"><?= $workorder->work_order_number; ?></td>                                    
                                    <td class="nsm-text-primary">
                                        <?php                                             
                                            $customer = trim($workorder->first_name) . ' ' . trim($workorder->last_name);
                                            echo $customer;
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            if( in_array(logged('company_id'), adi_company_ids()) ){
                                                if( $workorder->install_date != '' ){
                                                    echo date('m/d/Y', strtotime($workorder->install_date));
                                                }else{
                                                    echo '---';
                                                }
                                            }else{
                                                if( $workorder->date_issued != '' ){
                                                    echo date('m/d/Y', strtotime($workorder->date_issued));
                                                }else{
                                                    echo '---';
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <div class="techs">      
                                            <div class="nsm-profile" style="background-image: url('<?= userProfileImage($workorder->employee_id); ?>');"></div>
                                        </div>
                                    </td>                                    
                                    <td class="nsm-text-primary"><span class="nsm-badge <?= $prio_badge ?>"><?php echo $workorder->priority; ?></span></td>
                                    <td class="nsm-text-primary"><span class="nsm-badge <?= $status_badge ?>"><?php echo $workorder->w_status; ?></span></td>
                                    <td style="text-align:right;">$<?= number_format($workorder->grand_total, 2); ?></td>                                    
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
                                                        <a class="dropdown-item" tabindex="-1" href="<?php echo base_url('workorder/editAlarm/' . $workorder->id) ?>">Edit</a>
                                                    <?php }elseif($workorder->work_order_type_id == '3')
                                                    { ?>
                                                    <a class="dropdown-item" tabindex="-1" href="<?php echo base_url('workorder/editWorkorderSolar/' . $workorder->id) ?>">Edit</a>
                                                    <?php  }elseif($workorder->work_order_type_id == '4'){ ?>
                                                    <a class="dropdown-item" tabindex="-1" href="<?php echo base_url('workorder/editInstallation/' . $workorder->id) ?>">Edit</a>
                                                    <?php } else{ ?>
                                                        <a class="dropdown-item" tabindex="-1" href="<?php echo base_url('workorder/edit/' . $workorder->id) ?>">Edit</a>
                                                    <?php } ?>
                                                </li>                                                
                                                <li>
                                                    <a class="dropdown-item clone-item" href="javascript:void(0);" data-id="<?php echo $workorder->id ?>" data-wo_num="<?php echo $workorder->work_order_number ?>">Clone Work Order</a>
                                                </li>
                                                <?php } ?>
                                                <?php if(checkRoleCanAccessModule('work-orders', 'delete')){ ?>
                                                <li>
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" data-work-id="<?php echo $workorder->id; ?>" data-wo_num="<?php echo $workorder->work_order_number ?>">Delete</a>
                                                </li>
                                                <?php } ?>
                                                <?php if(checkRoleCanAccessModule('work-orders', 'write')){ ?>
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('job/work_order_job/' . $workorder->id) ?>">Convert to Jobs</a>
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
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="new_workorder_modal" tabindex="-1" aria-labelledby="new_workorder_modal_label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title" id="new_workorder_modal_label">New Work Order</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row text-center gy-3">
                        <div class="col-12">
                            <label class="content-title">What type of work order you want to create</label>
                        </div>
                        <div class="col-12">
                            <label class="content-subtitle d-block mb-2">Create new work order</label>
                            <?php if (empty($company_work_order_used->work_order_template_id)) : ?>
                                <button type="button" class="nsm-button w-50 primary" onclick="location.href='<?php echo base_url('workorder/new') ?>'">New Work Order</button>
                            <?php elseif ($company_work_order_used->work_order_template_id == '0') : ?>
                                <button type="button" class="nsm-button w-50 primary" onclick="location.href='<?php echo base_url('workorder/new') ?>'">New Work Order</button>
                            <?php elseif ($company_work_order_used->work_order_template_id == '1') : ?>
                                <button type="button" class="nsm-button w-50 primary" onclick="location.href='<?php echo base_url('workorder/workorderInstallation') ?>'">New Work Order</button>
                            <?php elseif ($company_work_order_used->work_order_template_id == '2') : ?>
                                <button type="button" class="nsm-button w-50 primary" onclick="location.href='<?php echo base_url('workorder/addSolarWorkorder') ?>'">New Work Order</button>
                            <?php else : ?>
                                <button type="button" class="nsm-button w-50 primary" onclick="location.href='<?php echo base_url('workorder/workorderInstallation') ?>'">New Work Order</button>
                            <?php endif; ?>
                        </div>
                        <?php $company_id = logged('company_id');
                        if ($company_id == '58' || $company_id == 1) : ?>
                            <div class="col-12">
                                <label class="content-subtitle d-block mb-2">Create new System Agreement work order</label>
                                <button type="button" class="nsm-button w-50 primary" onclick="location.href='<?php echo base_url('workorder/workorderInstallation') ?>'">New Alternate Workorder</button>
                            </div>
                        <?php elseif ($company_id == '31' || $company_id == 1) : ?>
                            <div class="col-12">
                                <label class="content-subtitle d-block mb-2">Create new Solar work order</label>
                                <button type="button" class="nsm-button w-50 primary" onclick="location.href='<?php echo base_url('workorder/addSolarWorkorder') ?>'">Alternate Solar Form Here</button>
                            </div>
                        <?php endif; ?>
                        <div class="col-12" style="display:none;">
                            <label class="content-subtitle d-block mb-2">Existing work order</label>
                            <button type="button" class="nsm-button w-50 primary" onclick="location.href='<?php echo base_url('workorder/new?type=2') ?>'">Existing</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function() {
        
        $("#workorder-list").nsmPagination({itemsPerPage:10});
        $("#search_field").on("input", debounce(function() {
            let search = $(this).val();
            if( search == '' ){
                $(".nsm-table").nsmPagination();
                $("#workorder-list").find("tbody .nsm-noresult").remove();
            }else{
                tableSearch($(this));        
            }
        }, 1000));

        $(document).on('change', '#select-all', function(){
            $('tr:visible .row-select:checkbox').prop('checked', this.checked);  
            let total= $('tr:visible input[name="workorders[]"]:checked').length;
            if( total > 0 ){
                $('#num-checked').text(`(${total})`);
            }else{
                $('#num-checked').text('');
            }
        });

        $(document).on('change', '.row-select', function(){
            let total= $('input[name="workorders[]"]:checked').length;
            if( total > 0 ){
                $('#num-checked').text(`(${total})`);
            }else{
                $('#num-checked').text('');
            }
        });

        $('#btn-add-new-workorder').on('click', function(){
            location.href = base_url + 'workorder/new';
        });

        

        $("#select-all").on("change", function() {
            let isChecked = $(this).is(":checked");

            if (isChecked)
                $(".nsm-table").find(".select-one").prop("checked", true);
            else
                $(".nsm-table").find(".select-one").prop("checked", false);
        });

        $(document).on('click', '#with-selected-delete', function(){
            let total= $('#workorder-list input[name="workorders[]"]:checked').length;
            if( total <= 0 ){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please select rows',
                });
            }else{
                Swal.fire({
                    title: 'Delete Work Orders',
                    html: `Are you sure you want to delete selected rows?<br /><br /><small>Deleted data can be restored via archived list.</small>`,
                    icon: 'question',
                    confirmButtonText: 'Proceed',
                    showCancelButton: true,
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'POST',
                            url: base_url + 'workorders/_archive_selected_workorders',
                            dataType: 'json',
                            data: $('#frm-with-selected').serialize(),
                            success: function(result) {                        
                                if( result.is_success == 1 ) {
                                    Swal.fire({
                                        title: 'Delete Workorders',
                                        text: "Data deleted successfully!",
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
                                        title: 'Error',
                                        text: result.msg,
                                    });
                                }
                            },
                            beforeSend: function(){
                                Swal.fire({
                                    icon: "info",
                                    title: "Processing",
                                    html: "Please wait while the process is running...",
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    },
                                });
                            }
                        });

                    }
                });
            }        
        });

        $(document).on("click", ".clone-item", function() {
            let wid   = $(this).attr("data-id");
            let workorder_number  = $(this).attr("data-wo_num");        

            Swal.fire({
                title: 'Clone Work Order',
                html: `You are going create a new work order based on work order number <b>${workorder_number}</b>. Afterwards you can edit the newly created work order.`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: base_url + "workorder/duplicate_workorder",
                        data: {
                            wo_num: wid
                        },
                        dataType: "JSON",
                        success: function(result) {
                            if (result.is_success) {
                                var wid = result.wid;
                                Swal.fire({
                                    title: 'Clone Work Order',
                                    html: "Data successfully created!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    //if (result.value) {
                                        location.href = base_url + 'workorder/edit/' + wid;
                                    //}
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: result.msg,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                });
                            }
                        },
                        beforeSend: function(){
                            Swal.fire({
                                icon: "info",
                                title: "Processing",
                                html: "Please wait while the process is running...",
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                showConfirmButton: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                },
                            });
                        }
                    });
                }
            });
        });

        $(document).on('click', '#with-selected-change-status', function(){
            let total= $('#workorder-list input[name="workorders[]"]:checked').length;
            if( total <= 0 ){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please select rows',
                });
            }else{
                let html_content = `
                    <div class="row workorder-change-status">
                        <div class="col-sm-12">
                            <label class="mb-2">Status</label>
                            <div class="input-group mb-3">
                                <select class="form-select" id="with-selected-status">
                                    <option value="New">New</option>
                                    <option value="Submitted">Submitted</option>
                                    <option value="Converted">Converted</option>
                                    <option value="Finished">Finished</option>
                                </select>
                            </div>
                        </div>
                    </div>
                `; 

                Swal.fire({
                    title: 'Change Status',
                    html: html_content,
                    icon: false,
                    confirmButtonColor: '#3085d6',
                    showCancelButton: true,
                    confirmButtonText: 'Save',                    
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        let status  = $('#with-selected-status').val();

                        const form = document.getElementById('frm-with-selected');
                        const formData = new FormData(form);
                        formData.append('status', status); 

                        $.ajax({
                            type: "POST",
                            url: base_url + "workorders/_change_status_selected_workorders",
                            data:formData,
                            processData: false,
                            contentType: false,
                            dataType:'json',
                            success: function(result) {                            
                                if( result.is_success == 1 ) {
                                    Swal.fire({
                                    icon: 'success',
                                    title: 'Change Status',
                                    text: 'Data was updated successfully.',
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
                            },
                            beforeSend: function(){
                                Swal.fire({
                                    icon: "info",
                                    title: "Processing",
                                    html: "Please wait while the process is running...",
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    },
                                });
                            }
                        });
                    }
                });
            }        
        });

        /*$(document).on("click", ".clone-item", function() {
            let num = $(this).attr('data-wo_num');
            let id = $(this).attr('data-id');

            $('.work_order_no').text(num);
            $('#wo_id').val(id);
        });*/

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
                        title: 'Clone Workorder',
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
                beforeSend: function(){
                    Swal.fire({
                        icon: "info",
                        title: "Processing",
                        html: "Please wait while the process is running...",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                    });
                }
            });
        });

        $('#btn-archived').on('click', function(){
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
                title: 'Restore Workorder',
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
                        },
                        beforeSend: function(){
                            Swal.fire({
                                icon: "info",
                                title: "Processing",
                                html: "Please wait while the process is running...",
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                },
                            });
                        }
                    });
                }
            });
        });

        $(document).on('click', '#with-selected-restore', function(){
            let total= $('#archived-workorders input[name="workorders[]"]:checked').length;
            if( total <= 0 ){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please select rows',
                });
            }else{
                Swal.fire({
                    title: 'Restore Work Orders',
                    html: `Are you sure you want to restore selected rows?`,
                    icon: 'question',
                    confirmButtonText: 'Proceed',
                    showCancelButton: true,
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'POST',
                            url: base_url + 'workorders/_restore_selected_workorders',
                            dataType: 'json',
                            data: $('#frm-archive-with-selected').serialize(),
                            success: function(result) {                        
                                if( result.is_success == 1 ) {
                                    $('#modal-archived-workorder').modal('hide');
                                    Swal.fire({
                                        title: 'Restore Work Orders',
                                        text: "Data restored successfully!",
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
                                        title: 'Error',
                                        text: result.msg,
                                    });
                                }
                            },
                            beforeSend: function(){
                                Swal.fire({
                                    icon: "info",
                                    title: "Processing",
                                    html: "Please wait while the process is running...",
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    },
                                });
                            }
                        });

                    }
                });
            }        
        });

        $(document).on('click', '#with-selected-perma-delete', function(){
            let total = $('#archived-workorders input[name="workorders[]"]:checked').length;
            if( total <= 0 ){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please select rows',
                });
            }else{
                Swal.fire({
                    title: 'Delete Work Orders',
                    html: `Are you sure you want to <b>permanently delete</b> selected rows? <br/><br/>Note : This cannot be undone.`,
                    icon: 'question',
                    confirmButtonText: 'Proceed',
                    showCancelButton: true,
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'POST',
                            url: base_url + 'workorders/_permanently_delete_selected_workorders',
                            dataType: 'json',
                            data: $('#frm-archive-with-selected').serialize(),
                            success: function(result) {                        
                                if( result.is_success == 1 ) {
                                    $('#modal-archived-workorder').modal('hide');
                                    Swal.fire({
                                        title: 'Delete Work Orders',
                                        text: "Data deleted successfully!",
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'Okay'
                                    }).then((result) => {
                                        //if (result.value) {
                                            //location.reload();
                                        //}
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: result.msg,
                                    });
                                }
                            },
                            beforeSend: function(){
                                Swal.fire({
                                    icon: "info",
                                    title: "Processing",
                                    html: "Please wait while the process is running...",
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    },
                                });
                            }
                        });

                    }
                });
            }        
        });

        $(document).on('click', '#btn-empty-archives', function(){        
            let total = $('#archived-workorders input[name="workorders[]"]').length;        
            if( total > 0 ){
                Swal.fire({
                    title: 'Empty Archived',
                    html: `Are you sure you want to <b>permanently delete</b> <b>${total}</b> archived workorders? <br/><br/>Note : This cannot be undone.`,
                    icon: 'question',
                    confirmButtonText: 'Proceed',
                    showCancelButton: true,
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'POST',
                            url: base_url + 'workorders/_delete_all_archived_workorders',
                            dataType: 'json',
                            data: $('#frm-archive-with-selected').serialize(),
                            success: function(result) {                        
                                if( result.is_success == 1 ) {
                                    $('#modal-archived-workorder').modal('hide');
                                    Swal.fire({
                                        title: 'Empty Archived',
                                        text: "Data deleted successfully!",
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'Okay'
                                    }).then((result) => {
                                        //if (result.value) {
                                            //location.reload();
                                        //}
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: result.msg,
                                    });
                                }
                            },
                            beforeSend: function(){
                                Swal.fire({
                                    icon: "info",
                                    title: "Processing",
                                    html: "Please wait while the process is running...",
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    },
                                });
                            }
                        });

                    }
                });
            }else{
                Swal.fire({                
                    icon: 'error',
                    title: 'Error',              
                    html: 'Archived is empty',
                });
            }        
        });

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
                                    //if (result.value) {
                                        location.reload();
                                    //}
                                });
                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                   text: 'Cannot find data',
                                });
                            }
                            
                        },
                        beforeSend: function(){
                            Swal.fire({
                                icon: "info",
                                title: "Processing",
                                html: "Please wait while the process is running...",
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                },
                            });
                        }
                    });
                }
            });
        });

        $(document).on('click', '.btn-permanently-delete-workorder', function(){
            let workorder_id  = $(this).attr('data-id');
            let workorder_number = $(this).attr('data-worknumber');

            Swal.fire({
                title: 'Delete Work Order',
                html: `Are you sure you want to <b>permanently delete</b> work order number <b>${workorder_number}</b>? <br/><br/>Note : This cannot be undone.`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: base_url + 'workorders/_delete_archived_workorder',
                        data: {
                            workorder_id: workorder_id
                        },
                        dataType: "JSON",
                        success: function(result) {
                            $('#modal-archived-workorder').modal('hide');
                            if (result.is_success) {
                                Swal.fire({
                                    title: 'Delete Work Order',
                                    html: "Data deleted successfully!",
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
                                    title: 'Error',
                                    text: result.msg,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                });
                            }
                        },
                        beforeSend: function(){
                            Swal.fire({
                                icon: "info",
                                title: "Processing",
                                html: "Please wait while the process is running...",
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                },
                            });
                        }
                    });
                }
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>