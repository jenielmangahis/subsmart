<?php include viewPath('v2/includes/header'); ?>

<style>
    .nsm-table {
        display: none;
    }
    .nsm-badge.primary-enhanced {
        background-color: #6a4a86;
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
                    <div class="col-12 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter by All</span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" data-id="filter_all" href="javascript:void(0);">All</a></li>
                                <li><a class="dropdown-item" data-id="filter_scheduled" href="javascript:void(0);">Scheduled</a></li>
                                <li><a class="dropdown-item" data-id="filter_started" href="javascript:void(0);">Started</a></li>
                                <li><a class="dropdown-item" data-id="filter_approved" href="javascript:void(0);">Approved</a></li>
                                <li><a class="dropdown-item" data-id="filter_invoiced" href="javascript:void(0);">Invoiced</a></li>
                                <li><a class="dropdown-item" data-id="filter_completed" href="javascript:void(0);">Completed</a></li>
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" onclick="location.href='<?= base_url('job/new_job1') ?>'">
                                <i class='bx bx-fw bx-briefcase'></i> New Job
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table" id="filter_all">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Job Number">Job Number</td>
                            <td data-name="Date">Date</td>
                            <td data-name="Customer">Customer</td>
                            <td data-name="Sales Rep">Sales Rep</td>
                            <td data-name="Tech Rep">Tech Rep</td>
                            <td data-name="Status">Status</td>
                            <td data-name="Amount">Job Amount</td>
                            <td data-name="Job Type">Job Type</td>
                            <td data-name="Job Tag">Job Tag</td>
                            <td data-name="Priority">Priority</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($jobs)) :
                        ?>
                            <?php
                            foreach ($jobs as $job) :
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
                                        <div class="table-row-icon">
                                            <i class='bx bx-briefcase'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?= $job->job_number; ?></td>
                                    <td><?php echo date_format(date_create($job->start_date), "m/d/Y"); ?></td>
                                    <td><?= $job->first_name . ' ' . $job->last_name; ?></td>
                                    <td><?= $job->FName . ' ' . $job->LName; ?></td>
                                    <td></td>
                                    <td>
                                        <?php
                                            for($x=1;$x<=$badgeCount;$x++){
                                                ?>
                                                    <span class="nsm-badge primary-enhanced"></span>
                                                <?php
                                            }
                                            for($y=1;$y < 8 - $badgeCount;$y++){
                                                ?>
                                                    <span class="nsm-badge primary"></span>
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td>$<?= number_format((float)$job->amount, 2, '.', ',');  ?></td>
                                    <td><?php echo $job->job_type; ?></td>
                                    <td><?php echo $job->name; ?></td>
                                    <td><?= $job->priority; ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="<?= base_url('job/job_preview/') . $job->id; ?>">Preview</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="<?= base_url('job/new_job1/') . $job->id; ?>">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?= $job->id; ?>">Delete</a>
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
                                <td colspan="11">
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
                <table class="nsm-table" id="filter_scheduled">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Job Number">Job Number</td>
                            <td data-name="Date">Date</td>
                            <td data-name="Customer">Customer</td>
                            <td data-name="Sales Rep">Sales Rep</td>
                            <td data-name="Tech Rep">Tech Rep</td>
                            <td data-name="Status">Status</td>
                            <td data-name="Amount">Amount</td>
                            <td data-name="Job Type">Job Type</td>
                            <td data-name="Job Tag">Job Tag</td>
                            <td data-name="Priority">Priority</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($jobs)) :
                        ?>
                            <?php
                            if ($scheduled > 0) :
                                foreach ($jobs as $job) :
                                    if ($job->status == 'Scheduled') :
                            ?>
                                        <tr>
                                            <td>
                                                <div class="table-row-icon">
                                                    <i class='bx bx-briefcase'></i>
                                                </div>
                                            </td>
                                            <td class="fw-bold nsm-text-primary"><?= $job->job_number; ?></td>
                                            <td><?php echo date_format(date_create($job->start_date), "m/d/Y"); ?></td>
                                            <td><?= $job->first_name . ' ' . $job->last_name; ?></td>
                                            <td><?= $job->FName . ' ' . $job->LName; ?></td>
                                            <td><?= $job->status; ?></td>
                                            <td>$<?= number_format((float)$job->amount, 2, '.', ',');  ?></td>
                                            <td><?php echo $job->job_type; ?></td>
                                            <td><?php echo $job->name; ?></td>
                                            <td><?= $job->priority; ?></td>
                                            <td>
                                                <div class="dropdown table-management">
                                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item" href="<?= base_url('job/job_preview/') . $job->id; ?>">Preview</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="<?= base_url('job/new_job1/') . $job->id; ?>">Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?= $job->id; ?>">Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    endif;
                                endforeach;
                            else :
                                ?>
                                <tr>
                                    <td colspan="11">
                                        <div class="nsm-empty">
                                            <span>No results found.</span>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endif;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="11">
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
                <table class="nsm-table" id="filter_started">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Job Number">Job Number</td>
                            <td data-name="Date">Date</td>
                            <td data-name="Customer">Customer</td>
                            <td data-name="Sales Rep">Sales Rep</td>
                            <td data-name="Tech Rep">Tech Rep</td>
                            <td data-name="Status">Status</td>
                            <td data-name="Amount">Amount</td>
                            <td data-name="Job Type">Job Type</td>
                            <td data-name="Job Tag">Job Tag</td>
                            <td data-name="Priority">Priority</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($jobs)) :
                        ?>
                            <?php
                            if ($started > 0) :
                                foreach ($jobs as $job) :
                                    if ($job->status == 'Started') :
                            ?>
                                        <tr>
                                            <td>
                                                <div class="table-row-icon">
                                                    <i class='bx bx-briefcase'></i>
                                                </div>
                                            </td>
                                            <td class="fw-bold nsm-text-primary"><?= $job->job_number; ?></td>
                                            <td><?php echo date_format(date_create($job->start_date), "m/d/Y"); ?></td>
                                            <td><?= $job->first_name . ' ' . $job->last_name; ?></td>
                                            <td><?= $job->FName . ' ' . $job->LName; ?></td>
                                            <td><?= $job->status; ?></td>
                                            <td>$<?= number_format((float)$job->amount, 2, '.', ',');  ?></td>
                                            <td><?php echo $job->job_type; ?></td>
                                            <td><?php echo $job->name; ?></td>
                                            <td><?= $job->priority; ?></td>
                                            <td>
                                                <div class="dropdown table-management">
                                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item" href="<?= base_url('job/job_preview/') . $job->id; ?>">Preview</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="<?= base_url('job/new_job1/') . $job->id; ?>">Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?= $job->id; ?>">Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    endif;
                                endforeach;
                            else :
                                ?>
                                <tr>
                                    <td colspan="11">
                                        <div class="nsm-empty">
                                            <span>No results found.</span>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endif;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="11">
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
                <table class="nsm-table" id="filter_approved">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Job Number">Job Number</td>
                            <td data-name="Date">Date</td>
                            <td data-name="Customer">Customer</td>
                            <td data-name="Sales Rep">Sales Rep</td>
                            <td data-name="Tech Rep">Tech Rep</td>
                            <td data-name="Status">Status</td>
                            <td data-name="Amount">Amount</td>
                            <td data-name="Job Type">Job Type</td>
                            <td data-name="Job Tag">Job Tag</td>
                            <td data-name="Priority">Priority</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($jobs)) :
                        ?>
                            <?php
                            if ($approved > 0) :
                                foreach ($jobs as $job) :
                                    if ($job->status == 'Approved') :
                            ?>
                                        <tr>
                                            <td>
                                                <div class="table-row-icon">
                                                    <i class='bx bx-briefcase'></i>
                                                </div>
                                            </td>
                                            <td class="fw-bold nsm-text-primary"><?= $job->job_number; ?></td>
                                            <td><?php echo date_format(date_create($job->start_date), "m/d/Y"); ?></td>
                                            <td><?= $job->first_name . ' ' . $job->last_name; ?></td>
                                            <td><?= $job->FName . ' ' . $job->LName; ?></td>
                                            <td><?= $job->status; ?></td>
                                            <td>$<?= number_format((float)$job->amount, 2, '.', ',');  ?></td>
                                            <td><?php echo $job->job_type; ?></td>
                                            <td><?php echo $job->name; ?></td>
                                            <td><?= $job->priority; ?></td>
                                            <td>
                                                <div class="dropdown table-management">
                                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item" href="<?= base_url('job/job_preview/') . $job->id; ?>">Preview</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="<?= base_url('job/new_job1/') . $job->id; ?>">Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?= $job->id; ?>">Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    endif;
                                endforeach;
                            else :
                                ?>
                                <tr>
                                    <td colspan="11">
                                        <div class="nsm-empty">
                                            <span>No results found.</span>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endif;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="11">
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
                <table class="nsm-table" id="filter_invoiced">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Job Number">Job Number</td>
                            <td data-name="Date">Date</td>
                            <td data-name="Customer">Customer</td>
                            <td data-name="Sales Rep">Sales Rep</td>
                            <td data-name="Tech Rep">Tech Rep</td>
                            <td data-name="Status">Status</td>
                            <td data-name="Amount">Amount</td>
                            <td data-name="Job Type">Job Type</td>
                            <td data-name="Job Tag">Job Tag</td>
                            <td data-name="Priority">Priority</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($jobs)) :
                        ?>
                            <?php
                            if ($invoiced > 0) :
                                foreach ($jobs as $job) :
                                    if ($job->status == 'Invoiced' || $job->status == 'Finished') :
                            ?>
                                        <tr>
                                            <td>
                                                <div class="table-row-icon">
                                                    <i class='bx bx-briefcase'></i>
                                                </div>
                                            </td>
                                            <td class="fw-bold nsm-text-primary"><?= $job->job_number; ?></td>
                                            <td><?php echo date_format(date_create($job->start_date), "m/d/Y"); ?></td>
                                            <td><?= $job->first_name . ' ' . $job->last_name; ?></td>
                                            <td><?= $job->FName . ' ' . $job->LName; ?></td>
                                            <td><?= $job->status; ?></td>
                                            <td>$<?= number_format((float)$job->amount, 2, '.', ',');  ?></td>
                                            <td><?php echo $job->job_type; ?></td>
                                            <td><?php echo $job->name; ?></td>
                                            <td><?= $job->priority; ?></td>
                                            <td>
                                                <div class="dropdown table-management">
                                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item" href="<?= base_url('job/job_preview/') . $job->id; ?>">Preview</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="<?= base_url('job/new_job1/') . $job->id; ?>">Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?= $job->id; ?>">Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    endif;
                                endforeach;
                            else :
                                ?>
                                <tr>
                                    <td colspan="11">
                                        <div class="nsm-empty">
                                            <span>No results found.</span>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endif;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="11">
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
                <table class="nsm-table" id="filter_completed">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Job Number">Job Number</td>
                            <td data-name="Date">Date</td>
                            <td data-name="Customer">Customer</td>
                            <td data-name="Sales Rep">Sales Rep</td>
                            <td data-name="Tech Rep">Tech Rep</td>
                            <td data-name="Status">Status</td>
                            <td data-name="Amount">Amount</td>
                            <td data-name="Job Type">Job Type</td>
                            <td data-name="Job Tag">Job Tag</td>
                            <td data-name="Priority">Priority</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($jobs)) :
                        ?>
                            <?php
                            if ($completed > 0) :
                                foreach ($jobs as $job) :
                                    if ($job->status == 'Completed') :
                            ?>
                                        <tr>
                                            <td>
                                                <div class="table-row-icon">
                                                    <i class='bx bx-briefcase'></i>
                                                </div>
                                            </td>
                                            <td class="fw-bold nsm-text-primary"><?= $job->job_number; ?></td>
                                            <td><?php echo date_format(date_create($job->start_date), "m/d/Y"); ?></td>
                                            <td><?= $job->first_name . ' ' . $job->last_name; ?></td>
                                            <td><?= $job->FName . ' ' . $job->LName; ?></td>
                                            <td><?= $job->status; ?></td>
                                            <td>$<?= number_format((float)$job->amount, 2, '.', ',');  ?></td>
                                            <td><?php echo $job->job_type; ?></td>
                                            <td><?php echo $job->name; ?></td>
                                            <td><?= $job->priority; ?></td>
                                            <td>
                                                <div class="dropdown table-management">
                                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item" href="<?= base_url('job/job_preview/') . $job->id; ?>">Preview</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="<?= base_url('job/new_job1/') . $job->id; ?>">Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?= $job->id; ?>">Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    endif;
                                endforeach;
                            else :
                                ?>
                                <tr>
                                    <td colspan="11">
                                        <div class="nsm-empty">
                                            <span>No results found.</span>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endif;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="11">
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
        loadJobs();

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

        $(document).on("click", ".delete-item", function(event) {
            var ID = $(this).attr("data-id");

            Swal.fire({
                title: 'Continue to REMOVE this Job?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('job/delete_job') ?>",
                        data: {
                            job_id: ID
                        }, // serializes the form's elements.
                        success: function(data) {
                            if (data === "1") {
                                window.location.reload();
                            } else {
                                alert(data);
                            }
                        }
                    });
                }
            });
        });
    });

    function loadJobs(id = "filter_all") {
        $(".nsm-table").hide();
        $("#" + id).show();
    }
</script>
<?php include viewPath('v2/includes/footer'); ?>