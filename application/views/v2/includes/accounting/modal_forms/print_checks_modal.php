<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form id="modal-form">
    <div id="printChecksModal" class="modal fade modal-fluid nsm-modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Print Checks</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row" style="min-height: 100%">
                        <div class="col">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <select name="payment_account" id="payment_account" class="nsm-field form-control mb-2" required>
                                                <option value="<?=$account->id?>"><?=$account->name?></option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 d-flex">
                                            <p style="align-self: center; margin: 0">Balance <span id="account-balance"><?=$balance?></span></p>
                                        </div>
                                        <div class="col-md-2 d-flex">
                                            <p style="align-self: center; margin: 0"><span id="selected-checks">0</span> checks selected <span id="selected-checks-total">$0.00</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 text-end">
                                    <button class="nsm-button mb-2" type="button" id="add-check-button">Add check</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 grid-mb d-flex align-items-end">
                                    <button class="nsm-button" type="button" id="remove-from-list">
                                        Remove from list
                                    </button>
                                </div>
                                <div class="col-md-6 grid-mb text-end">
                                    <div class="d-inline-block">
                                        <label for="starting-check-no" class="float-start">Starting check no.</label>
                                        <input type="number" class="nsm-field form-control" min="0" value="<?=$startingCheckNo?>" id="starting-check-no" required>
                                    </div>
                                    <?php if(!is_null($printSettings) && $printSettings->check_type === "2") : ?>
                                    <div class="d-inline-block">
                                        <label for="on-first-page-print" class="float-start">On first page print</label>
                                        <select id="on-first-page-print" class="nsm-field form-select" required>
                                            <option value="1">1 check</option>
                                            <option value="2">2 checks</option>
                                            <option value="3" selected>3 checks</option>
                                        </select>
                                    </div>
                                    <?php endif; ?>
                                    <div class="dropdown d-inline-block">
                                        <label for="sort-by" class="float-start">Sort by</label>
                                        <select id="sort-by" class="nsm-field form-select" required>
                                            <option value="payee">Sort by Payee</option>
                                            <option value="order-created">Sort by Order created</option>
                                            <option value="date-payee">Sort by Date / Payee</option>
                                            <option value="date-order-created" selected>Sort by Date / Order created</option>
                                        </select>
                                    </div>
                                    <div class="dropdown d-inline-block">
                                        <label for="check-type" class="float-start">Type</label>
                                        <select id="check-type" class="nsm-field form-select" required>
                                            <option value="all-checks" selected>Show all checks</option>
                                            <option value="regular">Show regular checks</option>
                                            <option value="bill-payment">Show bill payment checks</option>
                                        </select>
                                    </div>
                                    <div class="nsm-page-buttons page-button-container">
                                        <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#print_printable_checks_modal">
                                            <i class='bx bx-fw bx-printer'></i>
                                        </button>
                                        <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                            <i class="bx bx-fw bx-cog"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                            <p class="m-0">Columns</p>
                                            <div class="form-check">
                                                <input type="checkbox" checked="checked" name="col_chk" id="chk_date" class="form-check-input">
                                                <label for="chk_date" class="form-check-label">Date</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" checked="checked" name="col_chk" id="chk_type" class="form-check-input">
                                                <label for="chk_type" class="form-check-label">Type</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" checked="checked" name="col_chk" id="chk_payee" class="form-check-input">
                                                <label for="chk_payee" class="form-check-label">Payee</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" checked="checked" name="col_chk" id="chk_amount" class="form-check-input">
                                                <label for="chk_amount" class="form-check-label">Amount</label>
                                            </div>
                                            <p class="m-0">Rows</p>
                                            <div class="dropdown d-inline-block">
                                                <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                                    <span>
                                                        50
                                                    </span> <i class='bx bx-fw bx-chevron-down'></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end" id="checks-table-rows">
                                                    <li><a class="dropdown-item active" href="javascript:void(0);" onclick="checkTableRows(this)">50</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="checkTableRows(this)">75</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="checkTableRows(this)">100</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="checkTableRows(this)">150</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="checkTableRows(this)">300</a></li>
                                                </ul>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <table class="nsm-table" id="checks-table">
                                        <thead>
                                            <tr>
                                                <td class="table-icon text-center">
                                                    <input class="form-check-input select-all table-select" type="checkbox">
                                                </td>
                                                <td data-name="Date">DATE</td>
                                                <td data-name="Type">TYPE</td>
                                                <td data-name="Payee">PAYEE</td>
                                                <td data-name="Amount">AMOUNT</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (count($checks) > 0) : ?>
                                            <?php foreach($checks as $check) : ?>
                                            <tr>
                                                <td>
                                                    <div class="table-row-icon table-checkbox">
                                                        <input class="form-check-input select-one table-select" type="checkbox" value="<?=$check['id']?>">
                                                    </div>
                                                </td>
                                                <td><?=$check['date']?></td>
                                                <td><?=$check['type']?></td>
                                                <td><?=$check['payee']?></td>
                                                <td><?=$check['amount']?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="5">
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
                </div>

                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-md-4">
                            <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Close</button>
                        </div>
                        <div class="col-md-4 d-flex">
                            <a href="#" class="text-dark m-auto text-decoration-none" id="print-checks-setup">Print setup</a>
                        </div>
                        <div class="col-md-4 text-end">
                            <button class="nsm-button success" id="preview-and-print">
                                Preview and print
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</form>
</div>

<div class="modal fade nsm-modal fade" id="print_printable_checks_modal" tabindex="-1" aria-labelledby="print_printable_checks_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_printable_checks_modal_label">Print checks List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Date">Date</td>
                            <td data-name="Type">Type</td>
                            <td data-name="Payee">Payee</td>
                            <td data-name="Amount">Amount</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($checks) > 0) : ?>
                            <?php foreach($checks as $check) : ?>
                            <tr>
                                <td><?=$check['date']?></td>
                                <td><?=$check['type']?></td>
                                <td><?=$check['payee']?></td>
                                <td><?=$check['amount']?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="btn_print_printable_checks">Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="print_preview_printable_checks_modal" tabindex="-1" aria-labelledby="print_preview_printable_checks_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_preview_printable_checks_modal_label">Print Checks List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="w-100" id="printable_checks_table_print">
                    <thead>
                        <tr>
                            <td data-name="Date">Date</td>
                            <td data-name="Type">Type</td>
                            <td data-name="Payee">Payee</td>
                            <td data-name="Amount">Amount</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($checks) > 0) : ?>
                            <?php foreach($checks as $check) : ?>
                            <tr>
                                <td><?=$check['date']?></td>
                                <td><?=$check['type']?></td>
                                <td><?=$check['payee']?></td>
                                <td><?=$check['amount']?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4">
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