<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/estimate/estimate_modals'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
    <ul class="nsm-fab-options">
        <li data-bs-toggle="modal" data-bs-target="#new_estimate_modal">
            <div class="nsm-fab-icon">
                <i class="bx bx-chart"></i>
            </div>
            <span class="nsm-fab-label">New Estimate</span>
        </li>
        <?php if (isset($estimates) && count($estimates) > 0) : ?>
            <li onclick="location.href='<?php echo base_url('estimate/print') ?>'">
                <div class="nsm-fab-icon">
                    <i class="bx bx-printer"></i>
                </div>
                <span class="nsm-fab-label">Print</span>
            </li>
        <?php endif; ?>
    </ul>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/estimate_subtabs'); ?>
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
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('estimate') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Estimates" value="<?php echo (!empty($search)) ? $search : '' ?>">
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Sort by Newest First</span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=added-asc">Newest first</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=added-desc">Oldest first</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=date-accepted-desc">Accepted: newest</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=date-accepted-asc">Accepted: oldest</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=number-asc">Number: Asc</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=number-desc">Number: Desc</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=amount-asc">Amount: Lowest</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=amount-desc">Amount: Highest</a></li>
                            </ul>
                        </div>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter by All</span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <?php
                                foreach (get_config_item('estimate_status') as $key => $status) :
                                    if ($key === 0) continue;
                                ?>

                                    <?php
                                    if ($key === 1) :
                                    ?>
                                        <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>">All</a></li>
                                    <?php
                                    endif;
                                    ?>

                                    <li><a class="dropdown-item" href="<?php echo base_url('estimate/tab/' . strtolower($status)) ?>"><?php echo $status; ?></a></li>
                                <?php
                                endforeach;
                                ?>
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#new_estimate_modal">
                                <i class='bx bx-fw bx-chart'></i> New Estimate
                            </button>
                            <?php if (isset($estimates) && count($estimates) > 0) : ?>
                                <button type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('estimate/print') ?>'">
                                    <i class='bx bx-fw bx-printer'></i>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Estimate Number">Estimate Number</td>
                            <td data-name="Job & Customer">Job & Customer</td>
                            <td data-name="Date">Date</td>
                            <td data-name="Type">Type</td>
                            <td data-name="Status">Status</td>
                            <td data-name="Amount">Amount</td>
                            <td data-name="Amount">Is Email Seen</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($estimates)) :
                        ?>
                            <?php
                            foreach ($estimates as $estimate) :
                                switch($estimate->status):
                                    case "Draft":
                                        $badge = "";
                                        break;
                                    case "Submitted":
                                        $badge = "success";
                                        break;
                                    case "Accepted":
                                        $badge = "success";
                                        break;
                                    case "Invoiced":
                                        $badge = "primary";
                                        break;
                                    case "Lost":
                                        $badge = "secondary";
                                        break;
                                    case "Declined By Customer":
                                        $badge = "error";
                                        break;
                                endswitch;
                            ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-chart'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?php echo $estimate->estimate_number; ?></td>
                                    <td>
                                        <label class="d-block"><?php echo $estimate->job_name; ?></label>
                                        <a class="nsm-link" href="<?php echo base_url('customer/preview_/' . $estimate->customer_id) ?>">
                                            <?php echo get_customer_by_id($estimate->customer_id)->first_name . ' ' . get_customer_by_id($estimate->customer_id)->last_name ?>
                                        </a>
                                    </td>
                                    <td><?php echo date('M d, Y', strtotime($estimate->estimate_date)) ?></td>
                                    <td><?php echo $estimate->estimate_type; ?></td>
                                    <td><span class="nsm-badge <?= $badge ?>"><?= $estimate->status; ?></span></td>
                                    <td>
                                        <?php
                                        $total1 = ((float)$estimate->option1_total) + ((float)$estimate->option2_total);
                                        $total2 = ((float)$estimate->bundle1_total) + ((float)$estimate->bundle2_total);

                                        if ($estimate->estimate_type == 'Option') {
                                            echo '$ ' . number_format(floatval($total1),2);
                                        } elseif ($estimate->estimate_type == 'Bundle') {
                                            echo '$ ' . number_format(floatval($total2),2);
                                        } else {
                                            echo '$ ' . number_format(floatval($estimate->grand_total),2);
                                        }

                                        ?>
                                    </td>
                                    <td>
                                        <?php if ($estimate->is_mail_open == 1): ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <path fill="#888888" d="M15 12c0 1.654-1.346 3-3 3s-3-1.346-3-3 1.346-3 3-3 3 1.346 3 3zm9-.449s-4.252 8.449-11.985 8.449c-7.18 0-12.015-8.449-12.015-8.449s4.446-7.551 12.015-7.551c7.694 0 11.985 7.551 11.985 7.551zm-7 .449c0-2.757-2.243-5-5-5s-5 2.243-5 5 2.243 5 5 5 5-2.243 5-5z"/>
                                            </svg>
                                        <?php else: ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <path fill="#888888" d="M11.885 14.988l3.104-3.098.011.11c0 1.654-1.346 3-3 3l-.115-.012zm8.048-8.032l-3.274 3.268c.212.554.341 1.149.341 1.776 0 2.757-2.243 5-5 5-.631 0-1.229-.13-1.785-.344l-2.377 2.372c1.276.588 2.671.972 4.177.972 7.733 0 11.985-8.449 11.985-8.449s-1.415-2.478-4.067-4.595zm1.431-3.536l-18.619 18.58-1.382-1.422 3.455-3.447c-3.022-2.45-4.818-5.58-4.818-5.58s4.446-7.551 12.015-7.551c1.825 0 3.456.426 4.886 1.075l3.081-3.075 1.382 1.42zm-13.751 10.922l1.519-1.515c-.077-.264-.132-.538-.132-.827 0-1.654 1.346-3 3-3 .291 0 .567.055.833.134l1.518-1.515c-.704-.382-1.496-.619-2.351-.619-2.757 0-5 2.243-5 5 0 .852.235 1.641.613 2.342z"/>
                                            </svg>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('estimate/view/' . $estimate->id) ?>">View Estimate</a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('estimate/view_pdf/' . $estimate->id) ?>" target="_new">View PDF</a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item send-item" href="javascript:void(0);" acs-id="<?php echo $estimate->customer_id; ?>" est-id="<?php echo $estimate->id; ?>">Send to Customer</a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item clone-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#clone_estimate_modal" data-id="<?php echo $estimate->id ?>" data-wo_num="<?php echo $estimate->estimate_number ?>" data-name="WO-00433">Clone Estimate</a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item" href="<?= base_url('job/estimate_job/' . $estimate->id) ?>">Convert to Job</a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('invoice/estimateConversion/'. $estimate->id) ?>">Convert to Invoice</a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('estimate/print/' . $estimate->id) ?>" target="_new">Print</a>
                                                </li>

                                                <?php
                                                if ($estimate->estimate_type == 'Standard') :
                                                ?>
                                                    <li>
                                                        <a class="dropdown-item" href="<?php echo base_url('estimate/edit/' . $estimate->id) ?>">Edit</a>
                                                    </li>
                                                <?php
                                                elseif ($estimate->estimate_type == 'Option') :
                                                ?>
                                                    <li>
                                                        <a class="dropdown-item" href="<?php echo base_url('estimate/editOption/' . $estimate->id) ?>">Edit</a>
                                                    </li>
                                                <?php
                                                else :
                                                ?>
                                                    <li>
                                                        <a class="dropdown-item" href="<?php echo base_url('estimate/editBundle/' . $estimate->id) ?>">Edit</a>
                                                    </li>
                                                <?php
                                                endif;
                                                ?>

                                               
                                                <li>
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" est-id="<?php echo $estimate->id; ?>">Delete</a>
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

        $(".select-filter .dropdown-item").on("click", function() {
            let _this = $(this);

            _this.closest(".dropdown").find(".dropdown-toggle span").html("Filter by " + _this.html());
        });

        $("#search_field").on("input", debounce(function() {
            let _form = $(this).closest("form");

            _form.submit();
        }, 1500));

        $(document).on("click", ".clone-item", function() {
            let num = $(this).attr("data-wo_num");
            let id = $(this).attr("data-id");
            let _modal = $("#clone_estimate_modal");

            _modal.find(".work_order_no").text(num);
            _modal.find("#wo_id").val(id);
        });

        $("#clone_workorder").on("click", function() {
            let est_num = $('#wo_id').val();

            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>estimate/duplicate_estimate",
                data: {
                    est_num: est_num
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

        $(document).on("click", ".send-item", function() {
            let id = $(this).attr('acs-id');
            let est_id = $(this).attr('est-id');

            Swal.fire({
                title: 'Sending of Estimate',
                text: "Send this to customer?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url(); ?>estimate/sendEstimateToAcs",
                        data: {
                            id: id,
                            est_id: est_id
                        },
                        success: function(result) {
                            Swal.fire({
                                title: 'Good job!',
                                text: "Successfully sent to Customer!",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                        },
                        error: function() {
                            Swal.fire({
                                title: 'Error',
                                text: "Something went wrong, please try again later.",
                                icon: 'error',
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

        $(document).on("click", ".delete-item", function() {
            let id = $(this).attr('est-id');

            Swal.fire({
                title: 'Delete Estimate',
                text: "Are you sure you want to delete this Estimate?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url(); ?>estimate/delete_estimate",
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