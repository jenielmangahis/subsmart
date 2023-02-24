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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

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
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('job/new_job1') ?>'">
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
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
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
                <div class="row">
                    <div class="col-6 grid-mb">
                        <div class="nsm-field-group search form-group">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="CUSTOM_JOB_SEARCHBAR" placeholder="Search Job...">
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
                            <!-- <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter by All</span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" data-id="filter_all" href="javascript:void(0);">All</a></li>
                                <li><a class="dropdown-item" data-id="filter_scheduled" href="javascript:void(0);">Scheduled</a></li>
                                <li><a class="dropdown-item" data-id="filter_started" href="javascript:void(0);">Started</a></li>
                                <li><a class="dropdown-item" data-id="filter_approved" href="javascript:void(0);">Approved</a></li>
                                <li><a class="dropdown-item" data-id="filter_invoiced" href="javascript:void(0);">Invoiced</a></li>
                                <li><a class="dropdown-item" data-id="filter_completed" href="javascript:void(0);">Completed</a></li>
                            </ul> -->
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" onclick="location.href='<?= base_url('job/new_job1') ?>'">
                                <i class='bx bx-fw bx-briefcase'></i> New Job
                            </button>
                        </div>
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
                            <td data-name="Tech Rep">Tech Reps</td>
                            <td data-name="Status">Status</td>
                            <td data-name="Amount">Job Amount</td>
                            <td data-name="Job Type">Job Type</td>
                            <td data-name="Job Tag">Job Tag</td>
                            <td data-name="Priority">Priority</td>
                            <td class="d-none" data-name="Status"></td>
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
                                        $badgeCount = 8;
                                        break;
                                endswitch;
                            ?>
                        <tr>
                            <td>
                                <div class="table-row-icon"><i class='bx bx-briefcase'></i></div>
                            </td>
                            <td class="fw-bold nsm-text-primary"><?= jobsmodule__formatJobNumber($job->job_number); ?></td>
                            <td><?php echo date_format(date_create($job->start_date), "m/d/Y"); ?></td>
                            <td><?php echo $job->first_name . ' ' . $job->last_name; ?></td>
                            <td><?php echo $job->FName . ' ' . $job->LName; ?></td>
                            <td>
                                <?php
                                    $employeeFields = [
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
                            <td>
                                <div>
                                    <?php for($x=1;$x<=$badgeCount;$x++){ ?> <span class="nsm-badge primary-enhanced"></span>
                                    <?php } for($y=1;$y < 9 - $badgeCount;$y++){ ?> <span class="nsm-badge primary"></span>
                                    <?php } ?>
                                </div>
                                <small class="content-subtitle d-block mt-1"><?= $job->status; ?></small>
                            </td>
                            <td>$<?php echo number_format((float)$job->amount, 2, '.', ',');  ?></td>
                            <td><?php echo $job->job_type; ?></td>
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
                            <td class="d-none"><?php echo $job->status; ?></td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="<?php echo base_url('job/job_preview/') . $job->id; ?>">Preview</a></li>
                                        
                                        <?php if( $user_type == 7 || $user_type == 1 ){ //Admin ?>
                                        <li><a class="dropdown-item" href="<?php echo base_url('job/new_job1/') . $job->id; ?>">Edit</a></li>
                                        <li class="DELETE_ITEM" onclick="DELETE_JOB(<?php echo $job->id; ?>)"><a class="dropdown-item" href="javascript:void(0);" data-id="<?= $job->id; ?>">Delete</a></li>
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
        </div>
    </div>
</div>

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
    JOB_LIST_TABLE.columns(11).search(this.value).draw();
});

function DELETE_JOB(job_id){
    Swal.fire({
            title: 'Continue to REMOVE this Job?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
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
                            title: 'Success',
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
}

// $(".DELETE_ITEM > a").click(function(event) {
//     var job_id = $(".DELETE_ITEM > a").attr("data-id");
//         Swal.fire({
//             title: 'Continue to REMOVE this Job?',
//             text: "",
//             icon: 'warning',
//             showCancelButton: true,
//             confirmButtonText: 'Yes',
//             cancelButtonText: 'No',
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 $.ajax({
//                     type: "POST",
//                     url: "<?php echo base_url('job/delete_job'); ?>",
//                     data: {
//                         job_id: job_id
//                     }, // serializes the form's elements.
//                     success: function(data) {
//                         if (data === "1") {
//                             Swal.fire({
//                             icon: 'success',
//                             title: 'Success',
//                             text: 'Job deleted successfully!',
//                             }).then((result) => {
//                                 window.location.reload();
//                             });
//                         } else {
//                            Swal.fire({
//                             icon: 'error',
//                             title: 'Error',
//                             text: 'Failed to Delete Job!',
//                             });
//                         }
//                     }
//                 });
//             }
//         });
// });

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
});

// function loadJobs(id = "filter_all") {
//     $(".nsm-table").hide();
//     $("#" + id).show();
// }        
</script>
<?php include viewPath('v2/includes/footer'); ?>