<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/estimate/estimate_modals'); ?>

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
                            Create an estimate when you want to give your customer a quote, bid, or proposal for work you plan to do. There are 3 forms of estimate: standard, options and bundle (package) The estimate can later be turned into a sales order or an invoice. With this layout you will be able to monitor the status of each estimate.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <!-- <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search by tag name">
                        </div> -->
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <input type="hidden" class="nsm-field form-control" id="selected_ids">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                    Batch Actions
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end batch-actions">
                                <li><a class="dropdown-item disabled dropdown-send" href="javascript:void(0);" id="send">Send</a></li>
                                <li><a class="dropdown-item disabled dropdown-print" href="javascript:void(0);" id="print">Print</a></li>
                                <li><a class="dropdown-item disabled dropdown-delete" href="javascript:void(0);" id="delete">Delete</a></li>
                            </ul>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                    Filter
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-filter p-3" style="width: max-content">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="filter-date">Date</label>
                                        <select class="nsm-field form-select" name="filter_date" id="filter-date-credit-notes">
                                            <option value="last-365-days" <?= $date === 'last-365-days' ? 'selected' : ''?>>Last 365 days</option>
                                            <option value="custom" <?=$date === 'custom' ? 'selected' : ''?>>Custom</option>
                                            <option value="today" <?= empty($date) || $date === 'today' ? 'selected' : ''?>>Today</option>
                                            <option value="yesterday" <?=$date === 'yesterday' ? 'selected' : ''?>>Yesterday</option>
                                            <option value="this-week" <?=$date === 'this-week' ? 'selected' : ''?>>This week</option>
                                            <option value="this-month" <?=$date === 'this-month' ? 'selected' : ''?>>This month</option>
                                            <option value="this-quarter" <?=$date === 'this-quarter' ? 'selected' : ''?>>This quarter</option>
                                            <option value="this-year" <?=$date === 'this-year' ? 'selected' : ''?>>This year</option>
                                            <option value="last-week" <?=$date === 'last-week' ? 'selected' : ''?>>Last week</option>
                                            <option value="last-month" <?=$date === 'last-month' ? 'selected' : ''?>>Last month</option>
                                            <option value="last-quarter" <?=$date === 'last-quarter' ? 'selected' : ''?>>Last quarter</option>
                                            <option value="last-year" <?=$date === 'last-year' ? 'selected' : ''?>>Last year</option>
                                            <option value="all-dates" <?=$date === 'all-dates' ? 'selected' : ''?>>All dates</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="filter-from">From</label>
                                        <input type="date" id="filter-from" class="nsm-field form-control date" value="<?=empty($from_date) ? date("Y-m-d") : $from_date?>" required>
                                    </div>
                                    <div class="col-4">
                                        <label for="filter-to">To</label>
                                        <input type="date" id="filter-to" class="nsm-field form-control date"value="<?=empty($to_date) ? date("Y-m-d") : $to_date?>" required>
                                    </div>
                                    <div class="col-4">
                                        <label for="filter-status">Status</label>
                                        <select class="nsm-field form-select" name="filter_status" id="filter-status">
                                            <option value="all" selected>All</option>
                                            <option value="pending-expired">Pending, expired</option>
                                            <option value="declined">Declined</option>
                                            <option value="accepted">Accepted</option>
                                            <option value="closed-converted">Closed, converted</option>
                                        </select>
                                    </div>
                                </div>                                
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <button type="button" class="nsm-button" id="reset-button">
                                            Reset
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="nsm-button primary float-end" id="apply-button">
                                            Apply
                                        </button>
                                    </div>
                                </div>
                            </ul>
                        </div>

                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button new-estimate" data-toggle="modal">
                                <i class='bx bx-fw bx-list-plus'></i> New Estimate
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                <p class="m-0">Columns</p>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_estimate_num" class="form-check-input">
                                    <label for="chk_estimate_num" class="form-check-label">Estimate Number</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_expiration_date" class="form-check-input">
                                    <label for="chk_expiration_date" class="form-check-label">Expiration Date</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_po_number" class="form-check-input">
                                    <label for="chk_po_number" class="form-check-label">P.O. Number</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_sales_rep" class="form-check-input">
                                    <label for="chk_sales_rep" class="form-check-label">Sales Rep</label>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <table class="nsm-table" id="accounting-estimates">
                    <thead>
                        <tr>
                            <td class="table-icon text-center">
                                <input class="form-check-input select-all table-select" type="checkbox">
                            </td>
                            <td data-name="Date">DATE</td>
                            <td data-name="Estimate Number">ESTIMATE NUMBER</td>
                            <td data-name="Customer">CUSTOMER</td>
                            <td data-name="Expiration Date">EXPIRATION DATE</td>
                            <td data-name="P.O. Number">P.O. NUMBER</td>
                            <td data-name="Sales Rep">SALES REP</td>
                            <td data-name="Amount">AMOUNT</td>
                            <td data-name="Status">STATUS</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($estimates) > 0) : ?>
						<?php foreach($estimates as $estimate) : ?>
                        <?php  $customer = $this->accounting_customers_model->get_by_id($estimate->customer_id); ?>
                        <?php if( $customer){ ?>
                            <tr>
                                <td>
                                    <div class="table-row-icon table-checkbox">
                                        <input class="form-check-input select-one table-select" type="checkbox">
                                    </div>
                                </td>
                                <td><?=date("m/d/Y", strtotime($estimate->estimate_date))?></td>
                                <td><?=$estimate->estimate_number?></td>
                                <td>
                                    <?php echo $customer->last_name.', '.$customer->first_name; ?>
                                </td>
                                <td><?= date("m/d/Y", strtotime($estimate->expiry_date)); ?></td>
                                <td><?= $estimate->purchase_order_number != '' ? $estimate->purchase_order_number : 'Not Specified'; ?></td>
                                <td>
                                    <?php 
                                        if( $estimate->user_firstname != '' ){
                                            echo $estimate->user_firstname . ' ' . $estimate->user_lastname;
                                        }else{
                                            echo 'User not found';
                                        }
                                    ?>                                    
                                </td>
                                <td>
                                    $<?php
                                        $total1 = floatval($estimate->option1_total) + floatval($estimate->option2_total);
                                        $total2 = $estimate->bundle1_total + $estimate->bundle2_total;

                                        if($estimate->estimate_type == 'Option')
                                        {
                                            $grand_total = $total1;
                                        }
                                        elseif($estimate->estimate_type == 'Bundle')
                                        {
                                            $grand_total = $total2;
                                        }
                                        else
                                        {
                                            $grand_total = $estimate->grand_total; 
                                        }

                                        echo $grand_total > 0 ? $grand_total : '0.00';
                                    ?>
                                </td>
                                <td><?=$estimate->status?></td>
                                <td>
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <!-- <li>
                                                <a class="dropdown-item" href="#">Send</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">Convert to invoice</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">Mark accepted</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">View/Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">Duplicate</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">Print</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">Update status</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </li> -->
                                            <li role="presentation">
                                                <a class="dropdown-item" role="menuitem" tabindex="-1"
                                                                                href="<?php echo base_url('estimate/view/' . $estimate->id) ?>"><span
                                                                        class="fa fa-file-text-o icon"></span> View Estimate</a>
                                            </li>

                                                        <?php if($estimate->estimate_type == 'Standard'){ ?>
                                                        <li role="presentation"><a class="dropdown-item" role="menuitem" tabindex="-1"
                                                                                href="<?php echo base_url('estimate/edit/' . $estimate->id) ?>"><span
                                                                        class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                        </li>
                                                        <?php }elseif($estimate->estimate_type == 'Option'){ ?>
                                                        <li role="presentation"><a class="dropdown-item" role="menuitem" tabindex="-1"
                                                                                href="<?php echo base_url('estimate/editOption/' . $estimate->id) ?>"><span
                                                                        class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                        </li>
                                                        <?php }else{ ?>
                                                        <li role="presentation"><a class="dropdown-item" role="menuitem" tabindex="-1"
                                                                                href="<?php echo base_url('estimate/editBundle/' . $estimate->id) ?>"><span
                                                                        class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                        </li>
                                                        <?php } ?>

                                                        <li role="separator" class="divider"></li>
                                                        <li role="presentation">
                                                            <a class="dropdown-item clone-estimate" role="menuitem" tabindex="-1" href="javascript:void(0);" data-id="<?php echo $estimate->id ?>" data-wo_num="<?php echo $estimate->estimate_number ?>">
                                                                <span class="fa fa-files-o icon"></span> Clone Estimate
                                                            </a>
                                                        </li>
                                                        <li role="presentation">
                                                            <a class="dropdown-item" role="menuitem" tabindex="-1" href="<?php echo base_url('invoice/estimateConversion/'. $estimate->id) ?>"><span class="fa fa-money icon"></span> Convert to Invoice</a>
                                                        </li>
                                                        <li role="presentation">
                                                            <a class="dropdown-item" role="menuitem" target="_new" href="<?php echo base_url('estimate/view_pdf/' . $estimate->id) ?>" class="">
                                                            <span class="fa fa-file-pdf-o icon"></span>  View PDF</a></li>
                                                        <li role="presentation">
                                                            <a class="dropdown-item" role="menuitem" target="_new" href="<?php echo base_url('estimate/print/' . $estimate->id) ?>" class="">
                                                            <span class="fa fa-print icon"></span>  Print</a></li>
                                                        <li role="presentation">
                                                            <!-- <a role="menuitem" href="javascript:void(0);" class="btn-send-customer" data-id="<?= $estimate->id; ?>">
                                                            <span class="fa fa-envelope-open-o icon"></span>  Send to Customer</a></li> -->
                                                            <a class="dropdown-item send_to_customer" href="javascript:void(0);" acs-id="<?php echo $estimate->customer_id; ?>" est-id="<?php echo $estimate->id; ?>"><span class="fa fa-envelope-o icon"></span> Send to Customer</a>
                                                        <li><div class="dropdown-divider"></div></li>
                                                        <li role="presentation">
                                                            <a class="dropdown-item delete-item" href="javascript:void(0);" est-id="<?php echo $estimate->id; ?>"><span class="fa fa-trash-o icon"></span> Delete </a>
                                                        </li>
                                                        <li role="presentation">
                                                            <a class="dropdown-item" role="menuitem" href="<?= base_url('job/estimate_job/'. $estimate->id) ?>">
                                                                <span class="fa fa-briefcase icon"></span> Convert to Job</a>
                                                        </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php endforeach; ?>
						<?php else : ?>
						<tr>
							<td colspan="19">
								<div class="nsm-empty">
									<span>No results found.</span>
								</div>
							</td>
						</tr>
						<?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="newEstimateModal" tabindex="-1" aria-labelledby="newEstimateModal_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="newEstimateModal_label">New Estimate</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row text-center gy-3">
                    <div class="col-12">
                        <label class="content-title">What type of estimate you want to create</label>
                    </div>
                    <div class="col-12">
                        <label class="content-subtitle d-block mb-2">Create a regular estimate with items</label>
                        <button type="button" class="nsm-button w-50 primary" onclick="window.open('<?php echo base_url('accounting/addNewEstimate') ?>', '_blank','location=yes, height=650, width=1200, scrollbars=yes, status=yes');" data-bs-dismiss="modal">Standard Estimate</button>
                    </div>
                    <div class="col-12">
                        <label class="content-subtitle d-block mb-2">Customers can select all or only certain options</label>
                        <button type="button" class="nsm-button w-50 primary" onclick="window.open('<?php echo base_url('accounting/addNewEstimateOptions?type=2') ?>', '_blank','location=yes, height=650, width=1200, scrollbars=yes, status=yes');" data-bs-dismiss="modal">Options Estimate</button>
                    </div>
                    <div class="col-12">
                        <label class="content-subtitle d-block mb-2">Customers can select both Bundle Packages to<br>obtain an overall discount</label>
                        <button type="button" class="nsm-button w-50 primary" onclick="window.open('<?php echo base_url('accounting/addNewEstimateBundle?type=3') ?>', '_blank','location=yes, height=650, width=1200, scrollbars=yes, status=yes');" data-bs-dismiss="modal">Bundle Estimate</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    $("#accounting-estimates").nsmPagination({itemsPerPage:10});  

    $(".select-all").click(function(){
        $('.form-check-input').not(this).prop('checked', this.checked);

        var count_rows_list_check = $('.select-all').filter(':checked').length;
        if(count_rows_list_check > 0) {
            $(".dropdown-send").removeClass("disabled");
            $(".dropdown-print").removeClass("disabled");
            $(".dropdown-delete").removeClass("disabled");
        } else {
            $(".dropdown-send").addClass("disabled");
            $(".dropdown-delete").addClass("disabled");
            $(".dropdown-print").addClass("disabled");
        }           
    });

    $(".select-one").click(function(){
        var count_rows_list_check = $('.select-one').filter(':checked').length;
        if(count_rows_list_check > 0) {
            $(".dropdown-send").removeClass("disabled");
            $(".dropdown-print").removeClass("disabled");
            $(".dropdown-delete").removeClass("disabled");
        } else {
            $(".dropdown-send").addClass("disabled");
            $(".dropdown-delete").addClass("disabled");
            $(".dropdown-print").addClass("disabled");
        }            
    });

    $('.dropdown-menu.table-settings input[name="col_chk"]').on('change', function() {
        var chk = $(this);
        var dataName = $(this).next().text();

        var index = $(`#accounting-estimates thead td[data-name="${dataName}"]`).index();
        $(`#accounting-estimates tr`).each(function() {
            if(chk.prop('checked')) {
                $($(this).find('td')[index]).show();
            } else {
                $($(this).find('td')[index]).hide();
            }
        });
    });

    $(document).on("click", ".clone-estimate", function() {
        var num = $(this).attr("data-wo_num");
        var id = $(this).attr("data-id");
        var _modal = $("#clone_estimate_modal");

        _modal.find(".work_order_no").text(num);
        _modal.find("#wo_id").val(id);
        _modal.modal('show');
    });

    $(document).on('click', '.send_to_customer', function(){
        var id = $(this).attr('acs-id');
        var est_id = $(this).attr('est-id');

        Swal.fire({
            title: 'Send Estimate',
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
                            //title: 'Good job!',
                            text: "Estimate waa successfully sent to customer",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.value) {
                                //location.reload();
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
                                //location.reload();
                            }
                        });
                    },

                });
            }
        });
    });
    
    $('.new-estimate').on('click', function(){
        $('#newEstimateModal').modal('show');
    });

    $(document).on("click", ".delete-item", function() {
        var id = $(this).attr('est-id');

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