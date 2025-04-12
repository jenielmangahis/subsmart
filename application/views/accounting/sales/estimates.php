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
                        <?php if(checkRoleCanAccessModule('accounting-estimates', 'delete')){ ?>
                        <div class="dropdown d-inline-block">
                            <input type="hidden" class="nsm-field form-control" id="selected_ids">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                    With Selected
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end batch-actions">
                                <li><a class="dropdown-item disabled dropdown-delete" href="javascript:void(0);" id="delete">Delete</a></li>
                            </ul>
                        </div>
                        <?php } ?>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                    Filter
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-filter p-3" style="width: max-content">
                                <form action="<?php echo base_url('accounting/newEstimateList'); ?>" method="GET">
                                <div class="row">                                    
                                    <div class="col-4">
                                        <label for="filter-from">From</label>
                                        <input type="date" id="filter-from" name="estimate_from" class="nsm-field form-control date" value="<?= $filter_from_date; ?>" required>
                                    </div>
                                    <div class="col-4">
                                        <label for="filter-to">To</label>
                                        <input type="date" id="filter-to" name="estimate_to" class="nsm-field form-control date"value="<?= $filter_to_date; ?>" required>
                                    </div>
                                    <div class="col-4">
                                        <label for="filter-status">Status</label>
                                        <select class="nsm-field form-select" name="filter_status" id="filter-status">
                                            <option value="all" <?= $filter_status == 'all' ? 'selected="selected"' : ''; ?>>All</option>
                                            <?php foreach (get_config_item('estimate_status') as $key => $status) { ?>
                                                <?php if( $status != '' ){ ?>
                                                    <option <?= $filter_status == $status ? 'selected="selected"' : ''; ?> value="<?= $status; ?>"><?= $status ?></option>
                                                <?php } ?>
                                            <?php } ?>
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
                                        <button type="submit" class="nsm-button primary float-end" id="apply-button">
                                            Apply
                                        </button>
                                    </div>
                                </div>
                                </form>
                            </ul>
                        </div>

                        <div class="nsm-page-buttons page-button-container">
                            <?php if(checkRoleCanAccessModule('accounting-estimates', 'write')){ ?>
                            <button type="button" class="nsm-button new-estimate primary" data-toggle="modal">
                                <i class='bx bx-plus'></i> Add New
                            </button>
                            <?php } ?>
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
                <form id="frm-tbl-estimates">
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
                                            <input class="form-check-input select-one table-select" name="row_estimates[<?= $estimate->id; ?>]" value="1" type="checkbox">
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
                                                <li role="presentation">
                                                    <a class="dropdown-item" role="menuitem" tabindex="-1" href="<?php echo base_url('estimate/view/' . $estimate->id) ?>">View Estimate</a>
                                                </li>
                                                <?php if(checkRoleCanAccessModule('accounting-estimates', 'write')){ ?>
                                                    <?php if($estimate->estimate_type == 'Standard'){ ?>
                                                    <li role="presentation"><a class="dropdown-item" role="menuitem" tabindex="-1" href="<?php echo base_url('estimate/edit/' . $estimate->id) ?>">Edit</a>
                                                    </li>
                                                    <?php }elseif($estimate->estimate_type == 'Option'){ ?>
                                                    <li role="presentation"><a class="dropdown-item" role="menuitem" tabindex="-1"
                                                                            href="<?php echo base_url('estimate/editOption/' . $estimate->id) ?>">Edit</a>
                                                    </li>
                                                    <?php }else{ ?>
                                                    <li role="presentation"><a class="dropdown-item" role="menuitem" tabindex="-1"
                                                                            href="<?php echo base_url('estimate/editBundle/' . $estimate->id) ?>">Edit</a>
                                                    </li>
                                                    <?php } ?>
                                                <?php } ?>

                                                <li role="separator" class="divider"></li>
                                                <?php if(checkRoleCanAccessModule('accounting-estimates', 'write')){ ?>
                                                <li role="presentation">
                                                    <a class="dropdown-item clone-estimate" role="menuitem" tabindex="-1" href="javascript:void(0);" data-id="<?php echo $estimate->id ?>" data-wo_num="<?php echo $estimate->estimate_number ?>">Clone Estimate</a>
                                                </li>
                                                <?php } ?>
                                                <?php if(checkRoleCanAccessModule('accounting-estimates', 'write')){ ?>
                                                <li role="presentation">
                                                    <a class="dropdown-item" role="menuitem" tabindex="-1" href="<?php echo base_url('invoice/estimateConversion/'. $estimate->id) ?>">Convert to Invoice</a>
                                                </li>
                                                <?php } ?>
                                                <li role="presentation">
                                                    <a class="dropdown-item" role="menuitem" target="_new" href="<?php echo base_url('estimate/view_pdf/' . $estimate->id) ?>" class="">View PDF</a></li>
                                                <li role="presentation">
                                                    <a class="dropdown-item" role="menuitem" target="_new" href="<?php echo base_url('estimate/print/' . $estimate->id) ?>" class="">Print</a></li>
                                                <li role="presentation">
                                                    <a class="dropdown-item send_to_customer" href="javascript:void(0);" acs-id="<?php echo $estimate->customer_id; ?>" est-id="<?php echo $estimate->id; ?>">Send to Customer</a>
                                                <li><div class="dropdown-divider"></div></li>
                                                
                                                <?php if(checkRoleCanAccessModule('accounting-estimates', 'delete')){ ?>
                                                <li role="presentation">
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" est-number="<?= $estimate->estimate_number; ?>" est-id="<?php echo $estimate->id; ?>">Delete </a>
                                                </li>
                                                <?php } ?>

                                                <?php if(checkRoleCanAccessModule('accounting-estimates', 'write')){ ?>
                                                <li role="presentation">
                                                    <a class="dropdown-item" role="menuitem" href="<?= base_url('job/estimate_job/'. $estimate->id) ?>">Convert to Job</a>
                                                </li>
                                                <?php } ?>
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

    $('#reset-button').on('click', function(){
        location.href = base_url + 'accounting/newEstimateList';
    });

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
        var estimate_number = $(this).attr('est-number');

        Swal.fire({
            title: 'Delete Estimate',
            html: `Are you sure you want to delete estimate number <b>${estimate_number}</b>?`,
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

    $(document).on("click", ".dropdown-delete", function() {
        Swal.fire({
            title: 'Delete Estimate',
            text: "Are you sure you want to delete selected estimates?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + "estimate/_delete_selected_estimates",
                    data: $('#frm-tbl-estimates').serialize(),
                    success: function(result) {
                        Swal.fire({
                            title: 'Delete Estimate',
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