<?php include viewPath('v2/includes/accounting_header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('events/new_event') ?>'">
        <i class='bx bx-user-plus'></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/sales'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/subtabs/customers_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            When an invoice is created in our CRM, a statement summary of your customer's account listing recent invoices will display here for you to view. The statement shows per invoice not per items.
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <div class="nsm-counter error h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-receipt'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="total_this_year">$<?=number_format($unpaid_last_365, 2)?></h2>
                                    <span>UNPAID LAST 365 DAYS</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="nsm-counter success h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-receipt'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="total_this_year">$0.00</h2>
                                    <span>PAID LAST 30 DAYS</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="nsm-counter secondary h-100 mb-2">
                                    <div class="row h-100">
                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                            <i class='bx bx-receipt'></i>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                            <h2 id="total_this_year">$<?=number_format($due_last_365, 2)?></h2>
                                            <span>OVERDUE</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="nsm-counter h-100 mb-2">
                                    <div class="row h-100">
                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                            <i class='bx bx-receipt'></i>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                            <h2 id="total_this_year">$<?=number_format($not_due_last_365, 2)?></h2>
                                            <span>NOT DUE YET</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="nsm-counter success h-100 mb-2">
                                    <div class="row h-100">
                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                            <i class='bx bx-receipt'></i>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                            <h2 id="total_this_year">$<?=number_format($not_deposited_last30_days, 2)?></h2>
                                            <span>NOT DEPOSITED</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="nsm-counter success h-100 mb-2">
                                    <div class="row h-100">
                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                            <i class='bx bx-receipt'></i>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                            <h2 id="total_this_year">$<?=number_format($deposited_last30_days, 2)?></h2>
                                            <span>DEPOSITED</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="send">Send</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="send-reminder">Send reminder</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="print">Print</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="print-packing-slip">Print packing slip</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="delete">Delete</a></li>
                            </ul>
                        </div>

                        <div class="dropdown d-inline-block">
                            <input type="hidden" class="nsm-field form-control" id="selected_ids">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                    Status
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end batch-actions">
                                <li><a class="dropdown-item active" href="javascript:void(0);" id="all">All</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="needs-attention">Needs attention</a></li>
                                <div class="dropdown-divider"></div>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="unpaid">Unpaid</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="overdue">- Overdue</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="not-due">- Not due</a></li>
                                <div class="dropdown-divider"></div>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="paid">Paid</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="not-deposited">- Not deposited</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="deposited">- Deposited</a></li>
                            </ul>
                        </div>

                        <div class="dropdown d-inline-block">
                            <input type="hidden" class="nsm-field form-control" id="selected_ids">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                    Date
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end batch-actions">
                                <li><a class="dropdown-item" href="javascript:void(0);" id="this-month">This month</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="last-month">Last month</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="last-3-month">Last 3 months</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="last-6-month">Last 6 months</a></li>
                                <li><a class="dropdown-item active" href="javascript:void(0);" id="last-12-month">Last 12 months</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="year-to-date">Year-to-date</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="2021">2021</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="2020">2020</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="2019">2019</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="2018">2018</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="2017">2017</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="2016">2016</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="2015">2015</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="2014">2014</a></li>
                            </ul>
                        </div>

                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button">
                                <i class='bx bx-fw bx-import'></i> Import
                            </button>
                            <button type="button" class="nsm-button">
                                <i class='bx bx-fw bx-list-plus'></i> New
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                <p class="m-0">Columns</p>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="chk_invoice_num" id="chk_invoice_num" class="form-check-input">
                                    <label for="chk_invoice_num" class="form-check-label">Invoice number</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="chk_balance" id="chk_balance" class="form-check-input">
                                    <label for="chk_balance" class="form-check-label">Balance</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="chk_due_date" id="chk_due_date" class="form-check-input">
                                    <label for="chk_due_date" class="form-check-label">Due date</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="chk_po_number" id="chk_po_number" class="form-check-input">
                                    <label for="chk_po_number" class="form-check-label">P.O. Number</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="chk_sales_rep" id="chk_sales_rep" class="form-check-input">
                                    <label for="chk_sales_rep" class="form-check-label">Sales Rep</label>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon text-center">
                                <input class="form-check-input select-all table-select" type="checkbox">
                            </td>
                            <td data-name="Recurring"></td>
                            <td data-name="Date">DATE</td>
                            <td data-name="No.">NO.</td>
                            <td data-name="Customer">CUSTOMER</td>
                            <td data-name="Amount">AMOUNT</td>
                            <td data-name="Status">STATUS</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($invoices) > 0) : ?>
						<?php foreach($invoices as $invoice) : ?>
                        <tr>
                            <td>
                                <div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" type="checkbox">
                                </div>
                            </td>
                            <td></td>
                            <td><?=date("m/d/Y", strtotime($invoice->date_issued))?></td>
                            <td><?=$invoice->invoice_number?></td>
                            <td>
                                <?php
                                $customer = $this->accounting_customers_model->get_by_id($invoice->customer_id);
                                echo $customer->last_name.', '.$customer->first_name;
                                ?>
                            </td>
                            <td>$<?=$invoice->grand_total?></td>
                            <td><?=$invoice->status?></td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="#">View/Edit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Duplicate</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Send</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Share invoice link</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Print</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Print packing slip</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Void</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Delete</a>
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

<?php include viewPath('v2/includes/footer'); ?>