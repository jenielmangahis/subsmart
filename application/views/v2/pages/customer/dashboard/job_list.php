<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('v2/includes/header'); ?>
<?php 
function jobsmodule__getEmployeeAvatar($employee) {
    $avatar = $employee->avatar;
    $firstName = $employee->FName;
    $lastName = $employee->LName;
    $name = $firstName . ' ' . $lastName;

    if (!jobsmodule__endsWith($avatar, 'default.png')) {
        return "<div title=\"$name\" class=\"nsm-profile\" style=\"background-image: url('$avatar');\"></div>";
    }

    $initials = $firstName[0] . '' . $lastName[0];
    return "<div title=\"$name\" class=\"nsm-profile\"><span>$initials</span></div>";
}
function jobsmodule__endsWith($haystack, $needle) {
    $length = strlen( $needle );
    if(!$length) return true;
    return substr( $haystack, -$length ) === $needle;
}
?>
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
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_module_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button name="button"><i class='bx bx-x'></i></button>
                            For any business, getting customers is only half the battle; creating a job workflow will help track each scheduled ticket from draft to receiving payment.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search">
                        </div>
                    </div>
                    <?php if(checkRoleCanAccessModule('jobs', 'write')){ ?>
                    <div class="col-6 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" onclick="location.href='<?= base_url('job/new?cus_id='.$cus_id); ?>'">
                                <i class='bx bx-fw bx-plus'></i> New Job
                            </button>
                        </div>
                    </div>
                    <?php } ?>
                </div>

                <div class="tab-content mt-4">
                    <table class="nsm-table">
                        <thead>
                            <tr>
                                <td class="table-icon"></td>
                                <td data-name="Job Number">Job Number</td>
                                <td data-name="Date">Date</td>
                                <td data-name="Tech Rep">Assigned Tech</td>    
                                <td data-name="Job Type">Job Type</td>
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
                                                    <?php if ($job->$employeeField == $employee->id): ?>
                                                        <?= jobsmodule__getEmployeeAvatar($employee); ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </td>                          
                                <td><?php echo $job->job_type != '' ? $job->job_type : '---'; ?></td>
                                <td><?php echo $job->status; ?></td>
                                <td style="text-align:right;">$<?php echo number_format((float)$job->amount, 2, '.', ',');  ?></td>
                                <td>
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item view-job-row" href="javascript:void(0);" data-id="<?= $job->id; ?>">View</a>
                                            </li>
                                            <?php if(checkRoleCanAccessModule('jobs', 'write')){ ?>
                                            <li><a class="dropdown-item" href="<?php echo base_url('job/edit/') . $job->id; ?>">Edit</a></li>
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

            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>
<script>
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();
        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));        
        }, 1000));

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
    });
</script>