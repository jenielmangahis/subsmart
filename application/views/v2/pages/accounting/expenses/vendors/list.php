<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/vendors_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/expenses'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Vendors are people or companies that you owe money to or subcontractors that work for you.  You can use the vendors tab to add and track them.  Here's how.  Select Expenses, then Vendors.  Select New Vendor.  Complete the fields in the Vendor Information window.  Select Save and close.
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter primary h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-receipt'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="total_this_year"><?=$purchaseOrders?></h2>
                                    <span>PURCHASE ORDERS</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter error h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-receipt'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="total_this_year"><?=$overdueBills?></h2>
                                    <span>OVERDUE</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-receipt'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="pending_total"><?=$openBills?></h2>
                                    <span>OPEN BILLS</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter success h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-receipt'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="paid_total"><?=$paidTransactions?></h2>
                                    <span>PAID LAST 30 DAYS</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <form action="<?php echo base_url('accounting/vendors') ?>" method="get">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search" value="<?php echo (!empty($search)) ? $search : '' ?>">
                            </div>
                        </form>
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
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="email">Email</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="make-inactive">Make inactive</a></li>
                            </ul>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                    Other Actions
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end batch-actions">
                                <li><a class="dropdown-item" href="javascript:void(0);" id="print-checks">Print checks</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="pay-bills">Pay bills</a></li>
                            </ul>
                        </div>

                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button">
                                <i class='bx bx-fw bx-import'></i> Import
                            </button>
                            <button type="button" class="nsm-button">
                                <i class='bx bx-fw bx-list-plus'></i> New
                            </button>
                            <button type="button" class="nsm-button export-items">
                                <i class='bx bx-fw bx-export'></i> Export
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#print_vendors_modal">
                                <i class='bx bx-fw bx-printer'></i>
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                <p class="m-0">Columns</p>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="address_chk" class="form-check-input">
                                    <label for="address_chk" class="form-check-label">Address</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="attachments_chk" class="form-check-input">
                                    <label for="attachments_chk" class="form-check-label">Attachments</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="phone_chk" class="form-check-input">
                                    <label for="phone_chk" class="form-check-label">Phone</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="email_chk" class="form-check-input">
                                    <label for="email_chk" class="form-check-label">Email</label>
                                </div>
                                <p class="m-0">Other</p>
                                <div class="form-check">
                                    <input type="checkbox" <?=$status === 'all' ? 'checked' : ''?> id="inc_inactive" value="1" class="form-check-input">
                                    <label for="inc_inactive" class="form-check-label">Include Inactive</label>
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
                            </ul>
                        </div>
                    </div>
                </div>
                <table class="nsm-table" id="vendors-table">
                    <thead>
                        <tr>
                            <td class="table-icon text-center">
                                <input class="form-check-input select-all table-select" type="checkbox">
                            </td>
                            <td data-name="Vendor">VENDOR/COMPANY</td>
                            <td data-name="Address">ADDRESS</td>
                            <td data-name="Phone">PHONE</td>
                            <td data-name="Email">EMAIL</td>
                            <td class="table-icon text-center" data-name="Attachments">
                                <i class='bx bx-paperclip'></i>
                            </td>
                            <td data-name="Open Balance">OPEN BALANCE</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($vendors) > 0) : ?>
                        <?php foreach($vendors as $vendor) : ?>
                        <tr>
                            <td>
                                <div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" type="checkbox" value="<?=$vendor->id?>">
                                </div>
                            </td>
                            <td class="fw-bold nsm-text-primary nsm-link default" onclick="location.href='<?php echo base_url('accounting/vendors/view/' . $vendor->id) ?>'"><?=$vendor->display_name?></td>
                            <td></td>
                            <td><?=$vendor->phone?></td>
                            <td><?=$vendor->email?></td>
                            <td></td>
                            <td>
                                <?php
                                    $balance = '$'.number_format(floatval($vendor->opening_balance), 2, '.', ',');
                                    echo str_replace('$-', '-$', $balance);
                                ?>
                            </td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="#">Create bill</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Create expense</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Write check</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Create purchase order</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Make inactive</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="8">
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