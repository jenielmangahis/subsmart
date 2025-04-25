<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/estimate/estimate_modals'); ?>
<style>
.dataTables_filter, .dataTables_length{
    display: none;
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
.nsm-badge{
    font-size:12px;
    display:block;
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
    <ul class="nsm-fab-options">
        <?php if(checkRoleCanAccessModule('estimates', 'write')){ ?>
        <li data-bs-toggle="modal" data-bs-target="#new_estimate_modal">
            <div class="nsm-fab-icon">
                <i class="bx bx-chart"></i>
            </div>
            <span class="nsm-fab-label">New Estimate</span>
        </li>
        <?php } ?>
        <?php if (isset($estimates) && count($estimates) > 0) { ?>
        <li onclick="location.href='<?php echo base_url('estimate/print'); ?>'">
            <div class="nsm-fab-icon">
                <i class="bx bx-printer"></i>
            </div>
            <span class="nsm-fab-label">Print</span>
        </li>
        <?php } ?>
    </ul>
</div>

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
                            For any business, getting customers is only half the battle. creating a job workflow will help track each scheduled ticket from draft to receiving payment.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search">
                        </div>
                    </div>
                    <?php if(checkRoleCanAccessModule('estimates', 'write')){ ?>
                    <div class="col-6 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#new_estimate_modal">
                                <i class='bx bx-fw bx-plus'></i> New Estimate
                            </button>
                        </div>
                    </div>
                    <?php } ?>
                </div>

                <div class="tab-content mt-4">
                    
                    <table class="nsm-table" id="estimate-list-table">
                        <thead>
                            <tr>
                                <td class="table-icon"></td>
                                <td data-name="EstimateNumber">Estimate Number</td>                                       
                                <td data-name="Date" style="width:10%;">Date</td>
                                <td data-name="Status" style="width:8%;">Status</td>
                                <td data-name="Amount" style="text-align:right;">Amount</td>
                                <td data-name="Manage" style="width:3%;"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($estimates)) { ?>
                                <?php
                                    foreach ($estimates as $estimate) {
                                        switch ($estimate->status) {
                                            case 'Draft':
                                                $badge = '';
                                                break;
                                            case 'Submitted':
                                                $badge = 'success';
                                                break;
                                            case 'Accepted':
                                                $badge = 'success';
                                                break;
                                            case 'Invoiced':
                                                $badge = 'primary';
                                                break;
                                            case 'Lost':
                                                $badge = 'secondary';
                                                break;
                                            case 'Declined By Customer':
                                                $badge = 'error';
                                                break;
                                        }

                                        $row_class = '';
                                        if( $estimate->next_remind_date == date("Y-m-d") ){
                                            $row_class = 'with-reminder';
                                        }
                                ?>
                                <tr class="<?= $row_class; ?>">
                                    <td>
                                        <div class="table-row-icon">
                                            <?php if( $row_class == '' ){ ?>
                                                <i class='bx bx-chart'></i>
                                            <?php }else{ ?>
                                                <i class='bx bx-alarm-exclamation'></i>
                                            <?php } ?>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?php echo $estimate->estimate_number; ?></td>     
                                    <td class="nsm-text-primary"><?php echo date('m/d/Y', strtotime($estimate->estimate_date)); ?></td>
                                    <td><span class="nsm-badge <?php echo $badge; ?>"><?php echo $estimate->status; ?></span></td>
                                    <td style="width:10%;text-align:right;">
                                        <?php
                                                        $total1 = ((float) $estimate->option1_total) + ((float) $estimate->option2_total);
                                            $total2 = ((float) $estimate->bundle1_total) + ((float) $estimate->bundle2_total);
                                            echo '$ '.number_format(floatval($estimate->grand_total), 2);

                                            ?>
                                    </td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="<?php echo base_url('estimate/view/'.$estimate->id); ?>">View
                                                        Estimate</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="<?php echo base_url('estimate/view_pdf/'.$estimate->id); ?>"
                                                        target="_new">View PDF</a>
                                                </li>
                                                <?php if(checkRoleCanAccessModule('estimates', 'write')){ ?>
                                                <li>
                                                    <a class="dropdown-item send-item" href="javascript:void(0);"
                                                        acs-id="<?php echo $estimate->customer_id; ?>"
                                                        est-id="<?php echo $estimate->id; ?>">Send to Customer</a>
                                                </li>
                                                <?php } ?>

                                                <?php if ($estimate->status === 'Accepted') { ?>
                                                    <?php if(checkRoleCanAccessModule('estimates', 'write')){ ?>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="<?php echo base_url('job/estimate_job/'.$estimate->id); ?>">Convert to
                                                            Job</a>
                                                    </li>
                                                    <?php } ?>
                                                <?php } ?>
                                                
                                                <?php if(checkRoleCanAccessModule('estimates', 'write')){ ?>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="<?php echo base_url('workorder/estimateConversionWorkorder/'.$estimate->id); ?>">Convert
                                                        to Workorder</a>
                                                </li>
                                                <?php } ?>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="<?php echo base_url('estimate/print/'.$estimate->id); ?>"
                                                        target="_new">Print</a>
                                                </li>

                                                <?php if ($estimate->status !== 'Accepted') { ?>
                                                    <?php if(checkRoleCanAccessModule('estimates', 'write')){ ?>
                                                        <?php if ($estimate->estimate_type == 'Standard') { ?>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="<?php echo base_url('estimate/edit/'.$estimate->id); ?>">Edit</a>
                                                        </li>
                                                        <?php } elseif ($estimate->estimate_type == 'Option') { ?>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="<?php echo base_url('estimate/editOption/'.$estimate->id); ?>">Edit</a>
                                                        </li>
                                                        <?php } else { ?>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="<?php echo base_url('estimate/editBundle/'.$estimate->id); ?>">Edit</a>
                                                            </li>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="8">
                                        <div class="nsm-empty">
                                            <span>No results found.</span>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

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
});
</script>