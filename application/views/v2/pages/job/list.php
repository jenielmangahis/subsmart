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
                    <div class="col-6 grid-mb">
                        <div class="nsm-field-group search form-group">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="CUSTOM_JOB_SEARCHBAR" placeholder="Search Job">
                            <input class="d-none" id="CUSTOM_FILTER_SEARCHBAR" type="text" placeholder="Filter" data-index="20">
                        </div>
                    </div>
                    <div class="col-6 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                                <select id="CUSTOM_FILTER_DROPDOWN" class="dropdown-toggle nsm-button">
                                    <option selected value="">All</option>
                                    <option value="Scheduled">Scheduled</option>
                                    <option value="Started">Started</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Invoiced">Invoiced</option>
                                    <option value="Completed">Completed</option>
                                </select>
                        </div>
                        <?php if(checkRoleCanAccessModule('jobs', 'write')){ ?>
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" onclick="location.href='<?= base_url('job/new') ?>'">
                                <i class='bx bx-fw bx-briefcase'></i> New Job
                            </button>
                            <button type="button" class="nsm-button primary" id="archived-jobs-list">
                                <i class='bx bx-fw bx-trash'></i> Manage Archived
                            </button>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <table id="JOB_LIST_TABLE" class="nsm-table w-100">
                    <thead>
                        <tr>
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
                            <td data-name="Manage"></td>
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
                            <td>
                                <div class="table-row-icon"><i class='bx bx-briefcase'></i></div>
                            </td>
                            <td class="fw-bold nsm-text-primary">                                
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
                            <td><?php echo $job->status; ?></td>
                            <td style="text-align:right;">$<?php echo number_format((float)$job->amount, 2, '.', ',');  ?></td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <!-- <a class="dropdown-item" href="<?php echo base_url('job/job_preview/') . $job->id; ?>">Preview</a> -->
                                            <a class="dropdown-item view-job-row" href="javascript:void(0);" data-id="<?= $job->id; ?>">Preview</a>
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
            </div>

            <div class="modal fade nsm-modal fade" id="modal-quick-view-job" data-source="" tabindex="-1" aria-labelledby="modal-quick-view-upcoming-schedule-label" aria-hidden="true">
                <div class="modal-dialog modal-lg">        
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title">View Job</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <div class="modal-body" style="max-height:700px; overflow: auto;">
                            <div class="view-schedule-container row"></div>
                        </div>                                    
                    </div>        
                </div>
            </div>

            <div class="modal fade nsm-modal fade" id="modal-archived-jobs" aria-labelledby="modal-archived-jobs-label" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <form method="post" id="quick-add-event-form">   
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title content-title">Archived Jobs</span>
                                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                            </div>
                            <div class="modal-body" id="jobs-archived-list-container" style="max-height: 800px; overflow: auto;"></div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<?php include viewPath('v2/includes/footer'); ?>
<script type="text/javascript">
var JOB_LIST_TABLE = $("#JOB_LIST_TABLE").DataTable({
    "ordering": false,
    language: {
        processing: '<span>Fetching data...</span>'
    },
});

$("#CUSTOM_JOB_SEARCHBAR").keyup(function() {
    JOB_LIST_TABLE.search($(this).val()).draw()
});
JOB_LIST_TABLE_SETTINGS = JOB_LIST_TABLE.settings();

$('#CUSTOM_FILTER_DROPDOWN').change(function(event) {
    $('#CUSTOM_FILTER_SEARCHBAR').val($('#CUSTOM_FILTER_DROPDOWN').val());
    JOB_LIST_TABLE.columns(9).search(this.value).draw();
});

$(document).on('click', '.btn-delete-job', function(){
    var job_id = $(this).attr('data-id');
    var job_number = $(this).attr('data-jobnumber');
    Swal.fire({
        title: 'Delete Job',
        html: `Are you sure you want to delete job number <b>${job_number}</b>?`,
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
    // loadJobs();

    $("#filter_all").nsmPagination();
    $("#filter_scheduled").nsmPagination();
    $("#filter_started").nsmPagination();
    $("#filter_approved").nsmPagination();
    $("#filter_invoiced").nsmPagination();
    $("#filter_completed").nsmPagination();

    $(".select-filter .dropdown-item").on("click", function() {
        let _this = $(this);

        _this.closest(".dropdown").find(".dropdown-toggle span").html("Filter by " + _this.html());
        loadJobs(_this.attr("data-id"));
    });

    $('.view-job-row').on('click', function(){
        var appointment_id = $(this).attr('data-id');
        var url = base_url + "job/_quick_view_details";  

        $('#modal-quick-view-job').modal('show');
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
                            title: 'Success',
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
