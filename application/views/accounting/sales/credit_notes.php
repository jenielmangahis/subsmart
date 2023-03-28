<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/credit_notes_modals'); ?>

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
                            Credit Notes message
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
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-filter p-3" style="width: max-content">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="filter-date">Date</label>
                                        <select class="nsm-field form-select" name="filter_date" id="filter-date">
                                            <option value="last-365-days" <?=empty($date) || $date === 'last-365-days' ? 'selected' : ''?>>Last 365 days</option>
                                            <option value="custom" <?=$date === 'custom' ? 'selected' : ''?>>Custom</option>
                                            <option value="today" <?=$date === 'today' ? 'selected' : ''?>>Today</option>
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
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control date" value="<?=empty($from_date) ? date("m/d/Y", strtotime("-1 year")) : $from_date?>" id="filter-from">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label for="filter-to">To</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control date" id="filter-to" value="<?=empty($to_date) ? '' : $to_date?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="<?=$type === 'recently-paid' ? 'col-12' : 'col-5'?>">
                                        <label for="filter-customer">Customer</label>
                                        <select class="nsm-field form-select" name="filter_customer" id="filter-customer">
                                            <?php if(empty($customer)) : ?>
                                                <option value="all" selected="selected">All</option>
                                            <?php else : ?>
                                                <option value="<?=$customer->id?>"><?=$customer->name?></option>
                                            <?php endif; ?>
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

                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" id="new-credit-note">
                                <span>
                                    <i class='bx bx-fw bx-list-plus'></i> New Credit Note
                                </span>
                            </button>
                        </div>

                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button export-transactions">
                                <i class='bx bx-fw bx-export'></i> Export
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#print_credit_notes_modal">
                                <i class='bx bx-fw bx-printer'></i>
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                <p class="m-0">Columns</p>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_type" class="form-check-input">
                                    <label for="chk_type" class="form-check-label">Type</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_no" class="form-check-input">
                                    <label for="chk_no" class="form-check-label">No.</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_customer" class="form-check-input">
                                    <label for="chk_customer" class="form-check-label">Customer</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_memo" class="form-check-input">
                                    <label for="chk_memo" class="form-check-label">Memo</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_last_delivered" class="form-check-input">
                                    <label for="chk_last_delivered" class="form-check-label">Last Delivered</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_email" class="form-check-input">
                                    <label for="chk_email" class="form-check-label">Email</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_attachments" class="form-check-input">
                                    <label for="chk_attachments" class="form-check-label">Attachments</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_status" class="form-check-input">
                                    <label for="chk_status" class="form-check-label">Status</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_po_number" class="form-check-input">
                                    <label for="chk_po_number" class="form-check-label">P.O. Number</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_sales_rep" class="form-check-input">
                                    <label for="chk_sales_rep" class="form-check-label">Sales Rep</label>
                                </div>
                                <p class="m-0">Rows</p>
                                <div class="dropdown d-inline-block">
                                    <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                        <span>
                                            50
                                        </span> <i class='bx bx-fw bx-chevron-down'></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" id="table-rows">
                                        <li><a class="dropdown-item active" href="javascript:void(0);">50</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">75</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">100</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">150</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">300</a></li>
                                    </ul>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="compact" class="form-check-input">
                                    <label for="compact" class="form-check-label">Compact</label>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <table class="nsm-table" id="credit-notes-table">
                    <thead>
                        <tr>
                            <td class="table-icon text-center">
                                <input class="form-check-input select-all table-select" type="checkbox">
                            </td>
                            <td data-name="Date">DATE</td>
                            <td data-name="Type">TYPE</td>
                            <td data-name="No.">NO.</td>
                            <td data-name="Customer">CUSTOMER</td>
                            <td data-name="Memo">MEMO</td>
                            <td data-name="Total">TOTAL</td>
                            <td data-name="Last Delivered">LAST DELIVERED</td>
                            <td data-name="Email">EMAIL</td>
                            <td class="table-icon text-center" data-name="Attachments"><i class="bx bx-paperclip"></i></td>
                            <td data-name="Status">STATUS</td>
                            <td data-name="P.O. Number">P.O. Number</td>
                            <td data-name="Sales Rep">SALES REP</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($notes) > 0) : ?>
						<?php foreach($notes as $note) : ?>
                        <tr>
                            <td>
                                <div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" type="checkbox" value="<?=$note['id']?>">
                                </div>
                            </td>
                            <td><?=$note['date']?></td>
                            <td><?=$note['type']?></td>
                            <td><?=$note['no']?></td>
                            <td><?=$note['customer']?></td>
                            <td><?=$note['memo']?></td>
                            <td><?=$note['total']?></td>
                            <td><?=$note['last_delivered']?></td>
                            <td><?=$note['email']?></td>
                            <td><?=$note['attachments']?></td>
                            <td><?=$note['status']?></td>
                            <td><?=$note['po_number']?></td>
                            <td><?=$note['sales_rep']?></td>
                            <td><?=$note['manage']?></td>
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

<script>
    const companyName = "<?=$company->business_name?>";
</script>
<?php include viewPath('v2/includes/footer'); ?>