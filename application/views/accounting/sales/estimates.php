<?php include viewPath('v2/includes/accounting_header'); ?>

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
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
                            <button type="button" class="nsm-button" data-toggle="modal" data-target="#newEstimateModal">
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
                        <tr>
                            <td>
                                <div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" type="checkbox">
                                </div>
                            </td>
                            <td><?=date("m/d/Y", strtotime($estimate->estimate_date))?></td>
                            <td><?=$estimate->estimate_number?></td>
                            <td>
                                <?php
                                $customer = $this->accounting_customers_model->get_by_id($estimate->customer_id);
                                echo $customer->last_name.', '.$customer->first_name;
                                ?>
                            </td>
                            <td><?= date("m/d/Y", strtotime($estimate->expiry_date)); ?></td>
                            <td><?= $estimate->purchase_order_number != '' ? $estimate->purchase_order_number : 'Not Specified'; ?></td>
                            <td><?= $estimate->user_firstname . ' ' . $estimate->user_lastname; ?></td>
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
                                                    <li role="presentation"><a class="dropdown-item" role="menuitem"
                                                                               tabindex="-1"
                                                                               href="#"
                                                                               data-toggle="modal"
                                                                               data-target="#modalCloneEstimate"
                                                                               data-id="<?php echo $estimate->id ?>"
                                                                               data-wo_num="<?php echo $estimate->estimate_number ?>"
                                                                               data-name="WO-00433" class="clone-estimate"><span
                                                                    class="fa fa-files-o icon">

                                                        </span> Clone Estimate</a>
                                                    </li>
                                                    <li role="presentation"><a class="dropdown-item" role="menuitem" tabindex="-1"
                                                                               href="<?php echo base_url('invoice') ?>"
                                                                               data-convert-to-invoice-modal="open"
                                                                               data-id="161983"
                                                                               data-name="WO-00433"><span
                                                                    class="fa fa-money icon"></span> Convert to Invoice</a>
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
                                                        <a class="dropdown-item" href="" acs-id="<?php echo $estimate->customer_id; ?>" est-id="<?php echo $estimate->id; ?>" class="send_to_customer"><span class="fa fa-envelope-o icon"></span> Send to Customer</a>
                                                    <li><div class="dropdown-divider"></div></li>
                                                    <li role="presentation">
                                                        <!-- <a role="menuitem" href="<?php //echo base_url('estimate/delete/' . $estimate->id) ?>>" onclick="return confirm('Do you really want to delete this item ?')" data-delete-modal="open"><span class="fa fa-trash-o icon"></span> Delete</a> -->
                                                        <a class="dropdown-item" href="#" est-id="<?php echo $estimate->id; ?>" id="delete_estimate"><span class="fa fa-trash-o icon"></span> Delete </a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a class="dropdown-item" role="menuitem" href="<?= base_url('job/estimate_job/'. $estimate->id) ?>">
                                                            <span class="fa fa-briefcase icon"></span> Convert to Job</a>
                                                    </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
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


  
<div class="modal fade" id="newEstimateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Estimate</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <p class="text-lg margin-bottom">
            What type of estimate you want to create
        </p><center>
        <div class="margin-bottom text-center" style="width:60%;">
            <div class="help help-sm">Create a regular estimate with items</div>
            <a class="btn btn-primary add-modal__btn-success" style="background-color: #2ab363 !important" href="<?php echo base_url('accounting/addNewEstimate') ?>"><span class="fa fa-file-text-o"></span> Standard Estimate</a>
        </div>
        <div class="margin-bottom" style="width:60%;">
            <div class="help help-sm">Customers can select all <br>or only certain options</div>
            <a class="btn btn-primary add-modal__btn-success" style="background-color: #2ab363 !important" href="<?php echo base_url('accounting/addNewEstimateOptions?type=2') ?>"><span class="fa fa-list-ul fa-margin-right"></span> Options Estimate</a>
        </div>
        <div  class="margin-bottom" style="width:60%;">
            <div class="help help-sm">Customers can select both Bundle Packages to obtain an overall discount</div>
            <a class="btn btn-primary add-modal__btn-success" style="background-color: #2ab363 !important" href="<?php echo base_url('accounting/addNewEstimateBundle?type=3') ?>"><span class="fa fa-cubes"></span> Bundle Estimate</a>
        </div></center>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>

<!-- <script src="<?php echo $url->assets ?>dashboard/js/bootstrap.bundle.min.js"> -->
<?php //include viewPath('includes/footer_accounting'); ?>
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
});
</script>
<?php include viewPath('v2/includes/footer'); ?>