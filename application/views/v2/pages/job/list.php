<?php
function jobsmodule__formatJobNumber($number) {
    $formatFunc = function ($prefix, $number) {
        $numericPart = (int) str_replace($prefix, '', $number);
        return 'JOB-' . str_pad($numericPart, 7, '0', STR_PAD_LEFT);
    };

    if (strpos(strtoupper($number), 'JOB-') === 0) {
        return $formatFunc('JOB-', $number);
    }

    if (strpos(strtoupper($number), 'JOB') === 0) {
        return $formatFunc('JOB', $number);
    }

    return $number;
}


function jobsmodule__endsWith($haystack, $needle) {
    $length = strlen( $needle );
    if(!$length) return true;
    return substr( $haystack, -$length ) === $needle;
}

function jobsmodule__getEmployeeAvatar($employee) {
    $avatar = $employee['avatar'];
    $firstName = $employee['FName'];
    $lastName = $employee['LName'];
    $name = $firstName . ' ' . $lastName;

    if (!jobsmodule__endsWith($avatar, 'default.png')) {
        return "<div title=\"$name\" class=\"nsm-profile\" style=\"background-image: url('$avatar');\"></div>";
    }

    $initials = $firstName[0] . '' . $lastName[0];
    return "<div title=\"$name\" class=\"nsm-profile\"><span>$initials</span></div>";
}
?>
<?php include viewPath('v2/includes/header'); ?>
<style>
    .nsm-table {
        /*display: none;*/
    }
    .nsm-badge.primary-enhanced {
        background-color: #6a4a86;
    }
        table {
        width: 100% !important;
    }
    .dataTables_filter, .dataTables_length{
        display: none;
    }
    table.dataTable thead th, table.dataTable thead td {
    padding: 10px 18px;
    border-bottom: 1px solid lightgray;
}
table.dataTable.no-footer {
     border-bottom: 0px solid #111; 
     margin-bottom: 10px;
}
#CUSTOM_FILTER_DROPDOWN:hover {
     border-color: gray !important; 
     background-color: white !important; 
     color: black !important; 
     cursor: pointer;
}

.techs {
    display: flex;
    padding-left: 12px;
}
.techs > .nsm-profile {
    border: 2px solid #fff;
    box-sizing: content-box;
    margin-left: -12px;
}
.nsm-profile {
    --size: 35px;
    max-width: var(--size);
    height: var(--size);
    min-width: var(--size);
}
</style>

<?php
$scheduled = $started = $approved = $invoiced = $completed = 0;
foreach ($jobs as $job) {
    switch ($job->status) {
        case 'Scheduled':
            $scheduled++;
            break;
        case 'Started':
            $started++;
            break;
        case 'Approved':
            $approved++;
            break;
        case 'Invoiced':
            $invoiced++;
            break;
        case 'Completed':
            $completed++;
            break;
        default:
            break;
    }
}
?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('job/new') ?>'">
        <i class='bx bx-briefcase'></i>
    </div>
</div>

<div class="row page-content g-0">
    <?php if(!empty($this->session->flashdata('alert'))): ?>
        <div class="alert alert-<?= $this->session->flashdata('alert-type') ?>">
            <?= $this->session->flashdata('alert') ?>
        </div>
    <?php endif; ?>

    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/job_tabs_v2'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/job_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            For any business, getting customers is only half the battle; creating a job workflow will help track each scheduled ticket from draft to receiving payment.
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-4">
                        <div class="nsm-counter primary h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-calendar'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id=""><?= count($scheduledJobs); ?></h2>
                                    <span>Total Scheduled Jobs</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="nsm-counter secondary h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-calendar-exclamation'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id=""><?= count($pendingJobs); ?></h2>
                                    <span>Total Pending Jobs</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="nsm-counter success h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-calendar-check'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id=""><?= count($completedJobs); ?></h2>
                                    <span>Total Completed Jobs</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12 col-md-6 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Job" value="">
                        </div>
                    </div> 
                    <div class="col-12 col-md-6 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Sort by <?php echo $sort_by; ?></span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item"
                                        href="<?php echo base_url('job'); ?>?order=added-desc">Newest First</a></li>
                                <li><a class="dropdown-item"
                                        href="<?php echo base_url('job'); ?>?order=added-asc">Oldest First</a></li>                                
                                <li><a class="dropdown-item"
                                        href="<?php echo base_url('job'); ?>?order=job-number-desc">Job Number:
                                        Descending</a></li>
                                <li><a class="dropdown-item"
                                        href="<?php echo base_url('job'); ?>?order=job-number-asc">Job Number:
                                        Ascending</a></li>
                            </ul>
                        </div>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter : <?= $filter; ?></span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a name="btn_filter" class="dropdown-item" data-status="all" href="javascript:void(0);">All</a></li>
                                <li><a name="btn_filter" class="dropdown-item" data-status="Scheduled" href="javascript:void(0);">Scheduled</a></li>
                                <li><a name="btn_filter" class="dropdown-item" data-status="Arrival" href="javascript:void(0);">Arrival</a></li>
                                <li><a name="btn_filter" class="dropdown-item" data-status="Started" href="javascript:void(0);">Started</a></li>
                                <li><a name="btn_filter" class="dropdown-item" data-status="Approved" href="javascript:void(0);">Approved</a></li>
                                <li><a name="btn_filter" class="dropdown-item" data-status="Finished" href="javascript:void(0);">Finished</a></li>
                                <li><a name="btn_filter" class="dropdown-item" data-status="Cancelled" href="javascript:void(0);">Cancelled</a></li>
                                <li><a name="btn_filter" class="dropdown-item" data-status="Invoiced" href="javascript:void(0);">Invoiced</a></li>
                                <li><a name="btn_filter" class="dropdown-item" data-status="Completed" href="javascript:void(0);">Completed</a></li>
                            </ul>
                        </div>
                        <?php if(checkRoleCanAccessModule('jobs', 'write')){ ?>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span id="num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item btn-with-selected" id="with-selected-delete" href="javascript:void(0);" data-action="delete">Delete</a></li>                                
                            </ul>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-nsm" id="btn-new-job"><i class='bx bx-plus' style="position:relative;top:1px;"></i> Job</button>
                            <button type="button" class="btn btn-nsm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class=""><i class='bx bx-chevron-down' ></i></span>
                            </button>
                            <ul class="dropdown-menu">                          
                                <li><a class="dropdown-item" id="btn-export-jobs" href="javascript:void(0);">Export</a></li>                               
                                <li><a class="dropdown-item" id="archived-jobs-list" href="javascript:void(0);">Archived</a></li>                               
                            </ul>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <form id="frm-with-selected">
                <input type="hidden" id="filter-status" />
                <table id="JOB_LIST_TABLE" class="nsm-table w-100">
                    <thead>
                        <tr>
                            <?php if(checkRoleCanAccessModule('jobs', 'write')){ ?>
                            <td class="table-icon text-center sorting_disabled">
                                <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                            </td>
                            <?php } ?>
                            <td class="table-icon"></td>
                            <td data-name="Job Number">Job Number</td>
                            <td data-name="Date">Date</td>
                            <td data-name="Customer">Customer</td>
                            <td data-name="Sales Rep">Sales Rep</td>
                            <td data-name="Tech Rep">Assigned Tech</td>    
                            <td data-name="Job Type">Job Type</td>
                            <td data-name="Job Tag">Job Tag</td>
                            <td data-name="Priority">Priority</td>
                            <td data-name="Status">Status</td>
                            <td data-name="Amount" style="text-align:right">Amount</td>
                            <td data-name="Manage" style="width:5%;"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if (!empty($jobs)) {
                                foreach ($jobs as $job) {
                                switch($job->status):
                                    case "New":
                                        $badgeCount = 1;
                                        break;
                                    case "Scheduled":
                                        $badgeCount = 2;
                                        break;
                                    case "Arrival":
                                        $badgeCount = 3;
                                        break;          
                                    case "Started":
                                        $badgeCount = 4;
                                        break;
                                    case "Approved":
                                        $badgeCount = 5;
                                        break;
                                    case "Closed":
                                        $badgeCount = 6;
                                        break;
                                    case "Invoiced":
                                        $badgeCount = 7;
                                        break;
                                    case "Completed":
                                    case "Finished":
                                        $badgeCount = 8;
                                        break;
                                endswitch;
                            ?>
                        <tr>
                            <?php if(checkRoleCanAccessModule('jobs', 'write')){ ?>
                            <td>
                                <input class="form-check-input row-select table-select" name="jobs[]" type="checkbox" value="<?= $job->id; ?>">
                            </td>
                            <?php } ?>
                            <td>
                                <div class="table-row-icon"><i class='bx bx-briefcase'></i></div>
                            </td>
                            <td class="fw-bold show nsm-text-primary">                                
                                <?= $job->job_number; ?>
                            </td>
                            <td><?php echo date_format(date_create($job->start_date), "m/d/Y"); ?></td>
                            <td><?php echo $job->first_name . ' ' . $job->last_name; ?></td>
                            <td>
                                <?php 
                                    if( $job->FName != '' || $job->LName != '' ){
                                        echo $job->FName . ' ' . $job->LName; 
                                    }else{
                                        echo '---';
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    $employeeFields = [
                                        'employee_id',
                                        'employee2_id',
                                        'employee3_id',
                                        'employee4_id',
                                        'employee5_id',
                                        'employee6_id',
                                    ];
                                ?>
                                <?php if(!empty($employees)): ?>
                                    <div class="techs">
                                        <?php foreach ($employees as $employee): ?>
                                            <?php foreach ($employeeFields as $employeeField): ?>
                                                <?php if ($job->$employeeField == $employee['id']): ?>
                                                    <?= jobsmodule__getEmployeeAvatar($employee); ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </td>                          
                            <td><?php echo $job->job_type != '' ? $job->job_type : '---'; ?></td>
                            <td>
                                <?php if(!empty($tags)): ?>
                                    <?php foreach ($tags as $tag): ?>
                                        <?php if($job->tags == $tag['name']): ?>
                                            <span><?= $tag['name']; ?></span>
                                            <?php break; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </td>
                            <td><?php echo $job->priority; ?></td>
                            <td class="nsm-text-primary"><?php echo $job->status; ?></td>
                            <td style="text-align:right;">
                                <?php 
                                    $total_job = $job->amount + $job->adjustment_value + $job->program_setup + $job->monthly_monitoring + $job->installation_cost + $job->tax_rate;
                                ?>
                                $<?php echo number_format((float)$total_job, 2, '.', ',');  ?>
                            </td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <!-- <a class="dropdown-item" href="<?php echo base_url('job/job_preview/') . $job->id; ?>">Preview</a> -->
                                            <a class="dropdown-item view-job-row" href="javascript:void(0);" data-id="<?= $job->id; ?>" data-job-number="<?= $job->job_number; ?>">View</a>
                                        </li>
                                        
                                        <?php if(checkRoleCanAccessModule('jobs', 'write')){ ?>
                                            <li><a class="dropdown-item" href="<?php echo base_url('job/edit/') . $job->id; ?>">Edit</a></li>
                                        <?php } ?>

                                        <?php if(checkRoleCanAccessModule('jobs', 'delete')){ ?>
                                            <li class="DELETE_ITEM">
                                                <a class="dropdown-item btn-delete-job" href="javascript:void(0);" data-id="<?= $job->id; ?>" data-jobnumber="<?= $job->job_number; ?>">Delete</a>
                                            </li>
                                        <?php } ?>

                                        <?php if( $user_type == 6 ){ //Field tech ?>
                                            <li><a class="dropdown-item add-item" href="<?= base_url('job/edit_job_item/' . $job->id); ?>">Add Item</a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php } } ?>
                    </tbody>
                </table>
                </form>
            </div>

            <div class="modal fade nsm-modal fade" id="modal-quick-view-job" data-source="" tabindex="-1" aria-labelledby="modal-quick-view-upcoming-schedule-label" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">        
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title">View Job : <span id="view-job-number"></span></span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="view-schedule-container"></div>
                        </div>     
                        <div class="modal-footer"></div>                              
                    </div>        
                </div>
            </div>

            <div class="modal fade nsm-modal fade" id="modal-archived-jobs" aria-labelledby="modal-archived-jobs-label" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title">Archived Jobs</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <div class="modal-body" id="jobs-archived-list-container" style="max-height: 800px; overflow: auto;"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php include viewPath('v2/includes/footer'); ?>
<!-- Map files -->
<script src='https://unpkg.com/popper.js/dist/umd/popper.min.js'></script>
<script type="text/javascript" src="https://unpkg.com/maplibre-gl@1.15.2/dist/maplibre-gl.js"></script>
<link rel="stylesheet" type="text/css" href="https://unpkg.com/maplibre-gl@1.15.2/dist/maplibre-gl.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdn.maptiler.com/maptiler-sdk-js/v2.0.3/maptiler-sdk.umd.js"></script>
<link href="https://cdn.maptiler.com/maptiler-sdk-js/v2.0.3/maptiler-sdk.css" rel="stylesheet" />
<script src="https://cdn.maptiler.com/leaflet-maptilersdk/v2.0.0/leaflet-maptilersdk.js"></script>

<link rel="stylesheet" type="text/css" href="https://unpkg.com/@geoapify/geocoder-autocomplete@1.4.0/styles/minimal.css" />
<script src="https://unpkg.com/@geoapify/geocoder-autocomplete@1.4.0/dist/index.min.js"></script>
<!-- End Map files -->
<script type="text/javascript">
$(".nsm-table").nsmPagination();
$("#search_field").on("input", debounce(function() {
    let search = $(this).val();
    if( search == '' ){
        $(".nsm-table").nsmPagination();
    }else{
        tableSearch($(this));        
    }
    
}, 1000));

$(document).on('click', '.btn-delete-job', function(){
    var job_id = $(this).attr('data-id');
    var job_number = $(this).attr('data-jobnumber');
    Swal.fire({
        title: 'Delete Job',
        html: `Are you sure you want to delete job number <b>${job_number}</b>?<br /><br /><small>Deleted data can be restored via archived list.</small>`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Proceed',
        cancelButtonText: 'Cancel',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('job/delete_job'); ?>",
                data: {
                    job_id: job_id
                }, // serializes the form's elements.
                success: function(data) {
                    if (data === "1") {
                        Swal.fire({
                        icon: 'success',
                        title: 'Delete Job',
                        text: 'Job deleted successfully!',
                        }).then((result) => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to Delete Job!',
                        });
                    }
                }
            });
        }
    });
});

$(document).ready(function() {
    $("#filter_all").nsmPagination();
    $("#filter_scheduled").nsmPagination();
    $("#filter_started").nsmPagination();
    $("#filter_approved").nsmPagination();
    $("#filter_invoiced").nsmPagination();
    $("#filter_completed").nsmPagination();

    // $(".select-filter .dropdown-item").on("click", function() {
    //     let status = $(this).attr('data-status');
    //     let _this  = $('#filter-status');        
    //     if( status == 'all' ){
    //         _this.val('');
    //         tableSearch(_this); 
    //         $(".nsm-table").nsmPagination();  
    //     }else{
    //         _this.val(status);
    //         tableSearch(_this);  
    //     }
    // });

    $(".select-filter .dropdown-item").on("click", function() {
        let status = $(this).attr('data-status');
        if( status == 'all' ){
            location.href = base_url + 'job';
        }else{
            location.href = base_url + 'job?status=' + status;
        }
    });

    $(document).on('change', '#select-all', function(){
        $('.row-select:checkbox').prop('checked', this.checked);  
        let total= $('input[name="jobs[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $(document).on('change', '.row-select', function(){
        let total= $('input[name="jobs[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $('#btn-new-job').on('click',function(){
        location.href = base_url + 'job/new';
    });

    $("#btn-export-jobs").on("click", function() {
        location.href = "<?php echo base_url('jobs/export_list'); ?>";
    });

    $(document).on('click', '#with-selected-delete', function(){
        let total= $('input[name="jobs[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Delete Jobs',
                html: `Are you sure you want to delete selected rows?<br /><br /><small>Deleted data can be restored via archived list.</small>`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'job/_archive_selected_jobs',
                        dataType: 'json',
                        data: $('#frm-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                Swal.fire({
                                    title: 'Delete Jobs',
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
                    });

                }
            });
        }        
    });

    $(document).on('click', '#with-selected-restore', function(){
        Swal.fire({
            title: 'Restore Jobs',
            html: `Are you sure you want to restore selected rows?`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: 'POST',
                    url: base_url + 'jobs/_restore_selected_jobs',
                    dataType: 'json',
                    data: $('#frm-archive-with-selected').serialize(),
                    success: function(result) {                        
                        if( result.is_success == 1 ) {
                            $('#modal-archived-jobs').modal('hide');
                            Swal.fire({
                                title: 'Restore Jobs',
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
                });

            }
        });
    });

    $(document).on('click', '#with-selected-perma-delete', function(){
        Swal.fire({
            title: 'Delete Jobs',
            html: `Are you sure you want to <b>permanently delete</b> selected rows? <br/><br/>Note : This cannot be undone.`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: 'POST',
                    url: base_url + 'jobs/_permanently_delete_selected_jobs',
                    dataType: 'json',
                    data: $('#frm-archive-with-selected').serialize(),
                    success: function(result) {                        
                        if( result.is_success == 1 ) {
                            $('#modal-archived-jobs').modal('hide');
                            Swal.fire({
                                title: 'Delete Jobs',
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
                });

            }
        });
    });

    $(document).on('click', '.btn-permanently-delete-job', function(){
        let job_id   = $(this).attr('data-id');
        let job_number = $(this).attr('data-jobnumber');

        Swal.fire({
            title: 'Delete Job',
            html: `Are you sure you want to <b>permanently delete</b> job number <b>${job_number}</b>? <br/><br/>Note : This cannot be undone.`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + 'jobs/_delete_archived_job',
                    data: {
                        job_id: job_id
                    },
                    dataType: "JSON",
                    success: function(result) {
                        $('#modal-archived-jobs').modal('hide');
                        if (result.is_success) {
                            Swal.fire({
                                title: 'Delete Job',
                                html: "Data deleted successfully!",
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
                                title: 'Error',
                                text: result.msg,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            });
                        }
                    },
                });
            }
        });
    });

    $(document).on('click', '#btn-empty-archives', function(){
        let total_records = $('#archived-jobs tbody tr').length;
        Swal.fire({
            title: 'Delete All',
            html: `Are you sure you want to delete all <b>${total_records}</b> archived jobs? <br/><br/>Note : This cannot be undone.`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: 'POST',
                    url: base_url + 'jobs/_delete_all_archived_jobs',
                    dataType: 'json',
                    data: $('#frm-archive-with-selected').serialize(),
                    success: function(result) {                        
                        if( result.is_success == 1 ) {
                            $('#modal-archived-jobs').modal('hide');
                            Swal.fire({
                                title: 'Delete All',
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
                });

            }
        });
    });

    $(".select-filter .dropdown-item").on("click", function() {
        let _this = $(this);

        _this.closest(".dropdown").find(".dropdown-toggle span").html("Filter by " + _this.html());
        loadJobs(_this.attr("data-id"));
    });

    $(document).on('click', '.view-job-row', function(){
        var appointment_id = $(this).attr('data-id');
        var url = base_url + "job/_quick_view_details";  
        var job_number = $(this).attr('data-job-number');

        $('#modal-quick-view-job').modal('show');
        $('#view-job-number').text(job_number);
        showLoader($(".view-schedule-container")); 

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {appointment_id:appointment_id},
             success: function(o)
             {          
                $(".view-schedule-container").html(o);
             }
          });
        }, 500);
    });

    $('#archived-jobs-list').on('click', function(){
        $('#modal-archived-jobs').modal('show');
        $.ajax({
            type: "POST",
            url: base_url + "jobs/_archived_list",  
            success: function(html) {    
                $('#jobs-archived-list-container').html(html);                          
            },
            beforeSend: function() {
                $('#jobs-archived-list-container').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $(document).on('click', '.btn-restore-job', function(){
        var job_id = $(this).attr('data-id');
        var job_number = $(this).attr('data-jobnumber');

        Swal.fire({
            title: 'Restore Job Data',
            html: `Proceed with restoring job data <b>${job_number}</b>?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {                    
                $.ajax({
                    type: "POST",
                    url: base_url + "jobs/_restore_archived",
                    data: {job_id:job_id},
                    dataType:'json',
                    success: function(result) {                            
                        if( result.is_success == 1 ) {
                            $('#modal-archived-jobs').modal('hide');
                            Swal.fire({
                            icon: 'success',
                            title: 'Restore Job Data',
                            text: 'Job data was successfully restored.',
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
}); 
</script>
