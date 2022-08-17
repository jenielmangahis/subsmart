<?php include viewPath('v2/includes/accounting_header'); ?>

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
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="send">Send</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="print">Print</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="delete">Delete</a></li>
                            </ul>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                    Filter
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                <div class="row">
                                    <div class="col">
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
                                <div class="row">
                                    <div class="col">
                                        <label for="filter-date">Date</label>
                                        <select class="nsm-field form-select" name="filter_date" id="filter-date">
                                            <option value="this-month">This month</option>
                                            <option value="last-month">Last month</option>
                                            <option value="last-3-months">Last 3 months</option>
                                            <option value="last-6-months">Last 6 months</option>
                                            <option value="last-12-months" selected>Last 12 months</option>
                                            <option value="year-to-date">Year-to-date</option>
                                            <option value="2021">2021</option>
                                            <option value="2020">2020</option>
                                            <option value="2019">2019</option>
                                            <option value="2018">2018</option>
                                            <option value="2017">2017</option>
                                            <option value="2016">2016</option>
                                            <option value="2015">2015</option>
                                            <option value="2014">2014</option>
                                        </select>
                                    </div>
                                </div>
                            </ul>
                        </div>

                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button">
                                <i class='bx bx-fw bx-list-plus'></i> New Estimate
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                <p class="m-0">Columns</p>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="chk_estimate_num" id="chk_estimate_num" class="form-check-input">
                                    <label for="chk_estimate_num" class="form-check-label">Estimate number</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="chk_expiration_date" id="chk_expiration_date" class="form-check-input">
                                    <label for="chk_expiration_date" class="form-check-label">Expiration date</label>
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
                            <td data-name="Date">DATE</td>
                            <td data-name="No.">NO.</td>
                            <td data-name="Customer">CUSTOMER</td>
                            <td data-name="Expiration Date">EXPIRATION DATE</td>
                            <td data-name="PO Number">P.O. NUMBER</td>
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
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <?php
                                    $total1 = floatval($estimate->option1_total) + floatval($estimate->option2_total);
                                    $total2 = $estimate->bundle1_total + $estimate->bundle2_total;

                                    if($estimate->estimate_type == 'Option')
                                    {
                                        echo '$ '.$total1;
                                    }
                                    elseif($estimate->estimate_type == 'Bundle')
                                    {
                                        echo '$ '.$total2;
                                    }
                                    else
                                    {
                                        echo '$ '.$estimate->grand_total; 
                                    }
                                ?>
                            </td>
                            <td><?=$estimate->status?></td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
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