<?php include viewPath('v2/pages/accounting/check/checkModal.css'); ?>
<?php include viewPath('v2/pages/accounting/check/checkModal.js'); ?>
<div class="container">
    <div class="row checkAddModalContent">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-9 position-relative">
                    <h4 class="fw-bold">Add Check&ensp;<small class="text-muted fw-normal checkAddSequenceLabel"></small></h4>
                    <p>Create a check by manually entering the details or by using the virtual check template.</p> 
                    <div class="badge bg-secondary position-absolute checkAddBadge"></div>
                </div>
                <div class="col-lg-3">
                    <div class="float-end">
                        <span class="checkAddTotalAmountLabel fs-5">Total Amount</span>
                        <h3 class="checkAddTotalAmountValueLabel">$0.00</h4>
                    </div>   
                </div>
            </div>
            <button type="button" class="border-0 rounded mx-1 addCheckModalExitButton" data-bs-dismiss="modal"><i class="fas fa-times m-0 text-muted"></i></button>
        </div>
        <div class="col-lg-12">
            <ul class="nav nav-pills mb-3" id="checkAddTemplateStyleTab" role="tablist">
                <li class="nav-item historyNavItem" role="presentation">
                    <button type="button" class="btn btn-light position-relative checkAddHistory" data-bs-toggle="offcanvas" data-bs-target="#checkAddRecentTransactionsOffCanvas" aria-controls="checkAddRecentTransactionsOffCanvas" type="button">
                        <i class="fas fa-history text-muted"></i>
                        <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle checkAddNotificationDot"></span>
                    </button>
                </li>
                <div class="vr navPillSepator"></div>
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link active" id="checkAddStandardTab" data-bs-toggle="pill" data-bs-target="#checkAddStandardPill" type="button" role="tab" aria-controls="checkAddStandardPill" aria-selected="true">Standard</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link" id="checkAddVirtualTab" data-bs-toggle="pill" data-bs-target="#checkAddVirtualPill" type="button" role="tab" aria-controls="checkAddVirtualPill" aria-selected="false">Virtual</button>
                </li>
            </ul>
            <div class="tab-content" id="checkAddTemplateStyleTabContent">
                <div class="tab-pane fade show active" id="checkAddStandardPill" role="tabpanel" aria-labelledby="checkAddStandardTab">
                    <form class="checkAddForm">
                        <div class="row">
                            <div class="col-lg-3 mb-3">
                                <label class="form-label fw-xnormal">Check No.</label>
                                <label class="text-muted float-end highlightTextDisable"><input class="form-check-input checkAddPrintLater" name="checkAddPrintLater" type="checkbox">&ensp;Print Later</label>
                                <input type="number" class="form-control checkAddNo" name="checkAddNo" value="0000" min="0" required>
                            </div>
                            <div class="col-lg-2 mb-3">
                                <label class="form-label fw-xnormal">Permit No.</label>
                                <input type="number" class="form-control checkAddPermitNo" name="checkAddPermitNo" value="0000" min="0" required>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="form-label fw-xnormal">Payee</label>
                                <a class="text-decoration-none float-end checkAddViewPayeeInfo" href="javascript:void(0);">View Info</a>
                                <select class="form-select checkAddPayee" name="checkAddPayee" required></select>
                                <input class="checkAddPayeeType" name="checkAddPayeeType" type="hidden">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label class="form-label fw-xnormal">Bank Account</label>&ensp;<span class="text-muted checkAddBankAccountBalance">$0.00</span>
                                <label class="text-muted float-end highlightTextDisable"></label>
                                <select class="form-select checkAddBankAccount" name="checkAddBankAccount" required></select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 mb-3">
                                <label class="form-label fw-xnormal">Payment Date</label>
                                <input type="date" class="form-control checkAddPaymentDate" name="checkAddPaymentDate" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <div class="col-lg-10 mb-3">
                                <label class="form-label fw-xnormal">Tags</label>
                                <a class="text-decoration-none float-end checkAddClearTags" href="javascript:void(0);">Clear Tags</a>
                                <select class="form-select checkAddTag" name="checkAddTag[]" multiple required></select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="form-label fw-xnormal">Mailing Address</label>
                                <textarea class=" form-control checkAddMailingAddress" name="checkAddMailingAddress" placeholder="Payee's Mailing Address..." required></textarea>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="form-label fw-xnormal">Memo</label>
                                <textarea class=" form-control checkAddMemo" name="checkAddMemo" placeholder="Check's memo..."></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="accordion">
                                    <div class="accordion-item border-0">
                                        <h2 class="accordion-header" id="checkAddCategoryDetails_panel">
                                            <button type="button" class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#checkAddCategoryDetails_collapse" aria-expanded="true" aria-controls="checkAddCategoryDetails_collapse">
                                                <strong>CATEGORY DETAILS</strong>
                                            </button>
                                        </h2>
                                        <div id="checkAddCategoryDetails_collapse" class="accordion-collapse collapse show" aria-labelledby="checkAddCategoryDetails_panel">
                                            <div class="accordion-body p-0 pt-3 pb-3">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <table class="table table-bordered checkAddCategoryTable w-100">
                                                            <thead style="background: #00000008;">
                                                                <tr>
                                                                    <th class="width20">Category</th>
                                                                    <th class="width20">Description</th>
                                                                    <th class="width10">Amount</th>
                                                                    <th class="width0">Billable</th>
                                                                    <th class="width0">Tax</th>
                                                                    <th class="width20">Customer</th>
                                                                    <th class="width0"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td><select class="form-select checkAddCategoryOptionsRow" name="checkAddCategoryOptionsRow[]" required></select></td>
                                                                    <td><input type="text" class="form-control checkAddCategoryDescriptionRow" name="checkAddCategoryDescriptionRow[]"></td>
                                                                    <td><input type="number" class="form-control checkAddCategoryAmountRow" name="checkAddCategoryAmountRow[]" min="0" step="any" required></td>
                                                                    <td class="text-center"><input type="checkbox" class="form-check-input checkAddCategoryBillableRow" name="checkAddCategoryBillableRow[]"></td>
                                                                    <td class="text-center"><input type="checkbox" class="form-check-input checkAddCategoryTaxRow" name="checkAddCategoryTaxRow[]"></td>
                                                                    <td><select class="form-select checkAddCategoryCustomerRow" name="checkAddCategoryCustomerRow[]" required></select></td>
                                                                    <td><button type="button" class="border-0 checkAddDeleteLine"><i class="fas fa-minus text-danger"></i></button></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="input-group">
                                                            <button type="button" class="btn btn-primary checkAddCategoryLine" type="button">Add</button>
                                                            <button type="button" class="btn btn-light checkAddClearCategoryLine" type="button">Clear</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item border-0">
                                        <h2 class="accordion-header" id="checkAddItemDetails_panel">
                                            <button type="button" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#checkAddItemDetails_collapse" aria-expanded="true" aria-controls="checkAddItemDetails_collapse">
                                                <strong>ITEM DETAILS</strong>
                                            </button>
                                        </h2>
                                        <div id="checkAddItemDetails_collapse" class="accordion-collapse collapse" aria-labelledby="checkAddItemDetails_panel">
                                            <div class="accordion-body p-0 pt-3 pb-3">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <table class="table table-bordered checkAddItemTable w-100">
                                                            <thead style="background: #00000008;">
                                                                <tr>
                                                                    <th class="width20">Product/Service</th>
                                                                    <th class="width20">Description</th>
                                                                    <th>Qty</th>
                                                                    <th>Rate</th>
                                                                    <th class="width10">Amount</th>
                                                                    <th class="width0">Billable</th>
                                                                    <th class="width0">Tax</th>
                                                                    <th class="width20">Customer</th>
                                                                    <th class="width0"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td><select class="form-select checkAddItemOptionsRow" name="checkAddItemOptionsRow[]"></select></td>
                                                                    <td><input type="text" class="form-control checkAddItemDescriptionRow" name="checkAddItemDescriptionRow[]"></td>
                                                                    <td><input type="number" class="form-control checkAddItemQtyRow" name="checkAddItemQtyRow[]" min="0"></td>
                                                                    <td><input type="number" class="form-control checkAddItemRateRow" name="checkAddItemRateRow[]" min="0" step="any"></td>
                                                                    <td><input type="number" class="form-control checkAddItemAmountRow" name="checkAddItemAmountRow[]" min="0" step="any"></td>
                                                                    <td class="text-center"><input type="checkbox" class="form-check-input checkAddItemBillableRow" name="checkAddItemBillableRow[]"></td>
                                                                    <td class="text-center"><input type="checkbox" class="form-check-input checkAddItemTaxRow" name="checkAddItemTaxRow[]"></td>
                                                                    <td><select class="form-select checkAddItemCustomerRow" name="checkAddItemCustomerRow[]"></select></td>
                                                                    <td><button type="button" class="border-0 checkAddDeleteLine"><i class="fas fa-minus text-danger"></i></button></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="input-group">
                                                            <button type="button" class="btn btn-primary checkAddItemLine" type="button">Add</button>
                                                            <button type="button" class="btn btn-light checkAddClearItemLine" type="button">Clear</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="form-label fw-xnormal">Attachments</label>
                                <input type="file" class="form-control checkAddAttachments" name="checkAddAttachments[]" multiple>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary fw-bold float-end"><i class="fas fa-file-import"></i>&ensp;Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="checkAddVirtualPill" role="tabpanel" aria-labelledby="checkAddVirtualTab">












<style>
    .virtualCheckAddContainer {
        background-color: #f9f9f9;
        border: 2px solid #000;
        border-radius: 10px;
        font-family: Arial, sans-serif;
        height: 360px;
        margin: auto;
        padding: 20px;
        position: relative;
        top: 5px;
        width: 1299px;
    }

    .virtualCheckAddSection {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .virtualCheckAddNumberSection {
        right: 0;
    }

    .virtualPrintLaterSection {
        right: 70px;
        top: 55px;
    }

    .virtualCheckAddDateSection {
        right: 26px;
        top: 100px;
    }

    .virtualCheckAddPayeeSection {
        top: 150px;
    }

    .virtualCheckAddAmountSection {
        right: 26px;
        top: 150px;
    }

    .virtualCheckAddWrittenAmountSection {
        top: 200px;
    }

    .virtualCheckAddBankNameSection {
        top: 250px;
    }

    .virtualCheckAddCategoryNameSection {
        left: 290px;
        top: 250px;
        width: 170px;
    }

    .virtualCheckAddExpenseAccountSection {
        left: 560px;
        top: 250px;
        width: 240px;
    }

    .virtualCheckAddMemoSection {
        bottom: 20px;
    }

    .virtualTopSection {
        margin-top: -18px;
        position: absolute;
    }

    #virtualCheckAddDateInput {
        width: 180px;
    }

    #virtualCheckAddAmountInput {
        width: 150px;
    }

    #virtualCheckAddMemoInput {
        background: unset;
        border: none;
        border-bottom: 1px solid #ccc;
        border-radius: 0;
        width: 1010px;
    }

    #virtualCheckAddNumberInput {
        width: 59%;
    }

    .virtualCheckAddPayeeSelect {
        width: 925px;
    }

    .virtualCheckAddBankNameSelect,
    .virtualCheckAddCategorySelect,
    .virtualCheckAddExpenseAccountSelect {
        width: 260px !important;
    }

    #virtualCheckAddWrittenText {
        letter-spacing: 4px;
    }
</style>

<form class="virtualCheckAddForm">
    <div class="virtualCheckAddContainer">
        <div class="virtualCheckAddSection">
            <div class="virtualCheckAddPayerInfoSection position-absolute d-none">
                <strong class="virtualCheckAddPayerNameText">{PAYER_NAME}</strong><br>
                <span class="virtualCheckAddPayerAddressText">{ADDRESS}</span>
            </div>
            <div class="virtualPrintLaterSection position-absolute">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="virtualCheckAddPrintLater">
                    <label class="form-check-label text-muted" for="virtualCheckAddPrintLater">Print Later</label>
                </div>
            </div>
            <div class="virtualCheckAddNumberSection position-absolute">
                <div class="d-flex align-items-center">
                    <label for="virtualCheckAddNumberInput" class="me-2">Check No.</label>
                    <input type="number" id="virtualCheckAddNumberInput" class="form-control form-control-sm" required>
                </div>
            </div>
            <div class="virtualCheckAddDateSection position-absolute">
                <div class="d-flex align-items-center">
                    <label for="virtualCheckAddDateInput" class="me-2">Date</label>
                    <input type="date" id="virtualCheckAddDateInput" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
            </div>
            <div class="virtualCheckAddPayeeSection position-absolute">
                <div class="d-flex align-items-center">
                    <strong for="virtualCheckAddPayeeSelect" class="me-2 text-nowrap">Pay to the Order of</strong>
                    <select id="virtualPayee" name="virtualPayee" class="form-select virtualCheckAddPayeeSelect" required>
                        <option value="" selected disabled>Select payee...</option>
                    </select>
                </div>
            </div>
            <div class="virtualCheckAddAmountSection position-absolute">
                <div class="input-group">
                    <div class="input-group-text" id="virtualBtnGroupAddon"><strong>$</strong></div>
                    <input id="virtualCheckAddAmountInput" type="number" class="form-control" placeholder="0.00" step="any" required>
                </div>
            </div>
            <div class="virtualCheckAddWrittenAmountSection position-absolute">
                <div class="d-flex align-items-center">
                    <span id="virtualCheckAddWrittenText" class="me-2 text-nowrap">{WRITTEN_AMOUNT}</span>
                    <strong class="me-2 text-nowrap">Dollars</strong>
                </div>
            </div>
            <div class="virtualCheckAddBankNameSection position-absolute">
                <select id="virtualBankAccount" name="virtualBankAccount" class="form-select virtualCheckAddBankNameSelect" required>
                    <option value="" selected disabled>Select Bank...</option>
                </select>
            </div>
            <div class="virtualCheckAddCategoryNameSection position-absolute">
                <select name="virtualCategory[]" class="form-select virtualCheckAddCategorySelect" required>
                    <option value="" selected disabled>Select Category...</option>
                </select>
            </div>
            <div class="virtualCheckAddMemoSection position-absolute">
                <div class="d-flex align-items-center">
                    <strong for="virtualCheckAddMemoInput" class="me-2 text-nowrap">Memo</strong>
                    <input type="text" id="virtualCheckAddMemoInput" class="form-control text-muted" placeholder="Specify notes...">
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <!-- <div class="col-lg-12 virtualCheckAddAttachmentSection"></div> -->
        <div class="col-lg-12">
            <div class="float-end">
                <button type="submit" class="btn btn-primary fw-bold float-end"><i class="fas fa-file-import"></i>&ensp;Save</button>
            </div>
        </div>
    </div>
</form>

<script>
    $('#virtualCheckAddPrintLater').on('change', function() {
        const value = $(this).prop('checked');
        if (value) {
            $('.checkAddPrintLater').prop('checked', true).change();
            $('#virtualCheckAddNumberInput').val(null).prop('disabled', true);
        } else {
            $('.checkAddPrintLater').prop('checked', false).change();
            $('#virtualCheckAddNumberInput').prop('disabled', false);
            const checkAddNo = $('.checkAddNo').val();
            $('#virtualCheckAddNumberInput').val(checkAddNo).change();
        }
    });

    $('#virtualCheckAddNumberInput').on('input change', function() {
        const value = $(this).val();
        $('.checkAddNo').val(value).change();
    });

    $(document).on('change', '.virtualCheckAddPayeeSelect', function () {
        const selectize = $(this)[0].selectize;
        const id = selectize.getValue();
        const data = selectize.options[id];
        $(".checkAddPayee")[0].selectize.setValue(id);
        $('.checkAddPayeeType').val(data.payee_type).change();
    });

    $(document).on('change', '.virtualCheckAddBankNameSelect', function () {
        const selectize = $(this)[0].selectize;
        const id = selectize.getValue();
        const data = selectize.options[id];
        $('.checkAddBankAccount')[0].selectize.setValue(data.value);
    });

    $(document).on('change', '#virtualCheckAddDateInput', function () {
        const value = $(this).val();
        $('.checkAddPaymentDate').val(value).change();
    });

    $('#virtualCheckAddMemoInput').on('input change', function() {
        const value = $(this).val();
        $('.checkAddMemo').val(value).change();
    });
    
    $(document).on('change', '.virtualCheckAddCategorySelect', function () {
        const selectize = $(this)[0].selectize;
        const id = selectize.getValue();
        const data = selectize.options[id];
        $('.checkAddCategoryOptionsRow').eq(0)[0].selectize.setValue(data.value);
    });

    $('#virtualCheckAddAmountInput').on('input change', function () {
        const rawValue = $(this).val().trim();
        const value = parseFloat(rawValue);

        if (!isNaN(value)) {
            window.totalAmountInVirtualCheck = value;
            const writtenAmount = virtualNumberToWords(value);
            $('#virtualCheckAddWrittenText').text(writtenAmount);
            $('.checkAddCategoryAmountRow').eq(0).val(value).change();
        } else {
            window.totalAmountInVirtualCheck = 0;
            $('#virtualCheckAddWrittenText').text("{WRITTEN_AMOUNT}");
            $('.checkAddCategoryAmountRow').eq(0).val('').change();
        }
    });

    $(document).on('click', '#checkAddVirtualTab', function () {
        const checkAddPrintLater = $('.checkAddPrintLater').prop('checked');
        const checkAddNo = $('.checkAddNo').val();
        const checkAddNoMinimum = $('.checkAddNo').attr('min');
        const checkAddPayee = $('.checkAddPayee').val();
        const checkAddBankAccount = $('.checkAddBankAccount').val();
        const checkAddPaymentDate = $('.checkAddPaymentDate').val();
        const checkAddMemo = $('.checkAddMemo').val();
        const checkAddCategoryOptionsRow = $('.checkAddCategoryOptionsRow').eq(0).val();
        const checkAddCategoryAmountRow = $('.checkAddCategoryAmountRow').eq(0).val();

        if (checkAddPrintLater) {
            $('#virtualCheckAddPrintLater').prop('checked', true);
            $('#virtualCheckAddNumberInput').val(null).attr('min', checkAddNoMinimum).prop('disabled', true);
        } else {
            $('#virtualCheckAddNumberInput').prop('disabled', false).attr('min', checkAddNo).val(checkAddNo);
            $('#virtualCheckAddPrintLater').prop('checked', false);
        }

        $(".virtualCheckAddPayeeSelect")[0].selectize.setValue(checkAddPayee);
        $(".virtualCheckAddBankNameSelect")[0].selectize.setValue(checkAddBankAccount);
        $('#virtualCheckAddDateInput').val(checkAddPaymentDate);
        $('#virtualCheckAddMemoInput').val(checkAddMemo);
        $(".virtualCheckAddCategorySelect")[0].selectize.setValue(checkAddCategoryOptionsRow);
        $('#virtualCheckAddAmountInput').val(checkAddCategoryAmountRow).change();
    });

    $(document).on('submit', '.virtualCheckAddForm', function (e) {
        e.preventDefault();
        const virtualCheckAddForm = $(this);
        formDisabler(virtualCheckAddForm, true);
        $('.checkAddForm').submit();
    });

    initSelectizeWithCache({
        selector: '.virtualCheckAddPayeeSelect',
        url: `${window.origin}/accounting/v2/check/getPayeeDetails/all`,
        valueField: 'id',
        labelField: 'payee_name',
        searchField: 'payee_name',
        optgroupField: 'payee_type',
        placeholder: 'Select Customer...',
        renderOptionAttr: 'payee_type',
    });

    initSelectizeWithCache({
        selector: '.virtualCheckAddBankNameSelect',
        url: `${window.origin}/accounting/v2/check/getAccountDetails/Bank`,
        valueField: 'value',
        labelField: 'text',
        searchField: 'text',
        optgroupField: 'optgroup',
        placeholder: 'Select Bank Account...',
        renderOptionAttr: 'balance',
    });

    initSelectizeWithCache({
        selector: '.virtualCheckAddCategorySelect',
        url: `${window.origin}/accounting/v2/check/getAccountDetails/all`,
        valueField: 'value',
        labelField: 'text',
        searchField: 'text',
        optgroupField: 'optgroup',
        placeholder: 'Select Category...',
        renderOptionAttr: 'balance',
    });

</script>
















                </div>
            </div>
        </div>
    </div>
</div>
<div class="offcanvas offcanvas-start" tabindex="-1" id="checkAddRecentTransactionsOffCanvas" aria-labelledby="checkAddRecentTransactionsOffCanvasLabel">
    <div class="offcanvas-header">
        <h4 class="offcanvas-title fw-bold" id="checkAddRecentTransactionsOffCanvasLabel">Recent Transactions</h4>
        <button type="button" class="border-0 rounded mx-1" data-bs-dismiss="offcanvas"><i class="fas fa-times m-0 text-muted"></i></button>
    </div>
    <div class="offcanvas-body pt-0">
        <div class="row">
            <div class="col-12-md mb-3">
                <span>Displays the recent checks created to track your latest entries.</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-1">
                <div class="input-group">
                    <input class="form-control recentAddCheckTableSearch" type="text" placeholder="Search...">
                    <select class="form-select checkAddCategorySearch"></select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-hover recentAddCheckTable w-100">
                    <thead style="background: #00000008;">
                        <tr>
                            <th>No.</th>
                            <th class="width40">Payee</th>
                            <th>Total</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    var recentAddCheckTable;

    function getCheckAddCategoryRowHtml() {
        return `<tr>
            <td><select class="form-select checkAddCategoryOptionsRow" name="checkAddCategoryOptionsRow[]" required></select></td>
            <td><input type="text" class="form-control checkAddCategoryDescriptionRow" name="checkAddCategoryDescriptionRow[]"></td>
            <td><input type="number" class="form-control checkAddCategoryAmountRow" name="checkAddCategoryAmountRow[]" min="0" step="any" required></td>
            <td class="text-center"><input type="checkbox" class="form-check-input checkAddCategoryBillableRow" name="checkAddCategoryBillableRow[]"></td>
            <td class="text-center"><input type="checkbox" class="form-check-input checkAddCategoryTaxRow" name="checkAddCategoryTaxRow[]"></td>
            <td><select class="form-select checkAddCategoryCustomerRow" name="checkAddCategoryCustomerRow[]" required></select></td>
            <td><button type="button" class="border-0 checkAddDeleteLine"><i class="fas fa-minus text-danger"></i></button></td>
        </tr>`;
    }

    function getCheckAddItemRowHtml() {
        return `
            <tr>
                <td><select class="form-select checkAddItemOptionsRow" name="checkAddItemOptionsRow[]"></select></td>
                <td><input type="text" class="form-control checkAddItemDescriptionRow" name="checkAddItemDescriptionRow[]"></td>
                <td><input type="number" class="form-control checkAddItemQtyRow" name="checkAddItemQtyRow[]" min="0"></td>
                <td><input type="number" class="form-control checkAddItemRateRow" name="checkAddItemRateRow[]" min="0" step="any"></td>
                <td><input type="number" class="form-control checkAddItemAmountRow" name="checkAddItemAmountRow[]" min="0" step="any"></td>
                <td class="text-center"><input type="checkbox" class="form-check-input checkAddItemBillableRow" name="checkAddItemBillableRow[]"></td>
                <td class="text-center"><input type="checkbox" class="form-check-input checkAddItemTaxRow" name="checkAddItemTaxRow[]"></td>
                <td><select class="form-select checkAddItemCustomerRow" name="checkAddItemCustomerRow[]"></select></td>
                <td><button type="button" class="border-0 checkAddDeleteLine"><i class="fas fa-minus text-danger"></i></button></td>
            </tr>
        `;
    }

    initSelectizeWithCache({
        selector: '.checkAddPayee',
        url: `${window.origin}/accounting/v2/check/getPayeeDetails/all`,
        valueField: 'id',
        labelField: 'payee_name',
        searchField: 'payee_name',
        optgroupField: 'payee_type',
        placeholder: 'Select Payee...',
        renderOptionAttr: 'payee_type',
    });

    initSelectizeWithCache({
        selector: '.checkAddBankAccount',
        url: `${window.origin}/accounting/v2/check/getAccountDetails/Bank`,
        valueField: 'value',
        labelField: 'text',
        searchField: 'text',
        optgroupField: 'optgroup',
        placeholder: 'Select Bank Account...',
        renderOptionAttr: 'balance',
    });

    initSelectizeWithCache({
        selector: '.checkAddTag',
        url: `${window.origin}/accounting/v2/check/getTagDetails`,
        valueField: 'tag',
        labelField: 'tag',
        searchField: 'tag',
        optgroupField: 'optgroup',
        placeholder: 'Specify Tags...',
        renderOptionAttr: 'tag',
        multiple: true,
        create: true
    });

    $(document).ready(function() {
        const $checkAddNoInput = $('.checkAddNo');
        const $sequenceLabel = $('.checkAddSequenceLabel');

        function updateSequenceLabel(value) {
            const paddedValue = value.toString().padStart(4, '0');
            $sequenceLabel.text(`#${paddedValue}`);
        }

        if ($checkAddNoInput.length && $sequenceLabel.length) {
            updateSequenceLabel($checkAddNoInput.val());
        }

        $checkAddNoInput.on('input change', function() {
            updateSequenceLabel($(this).val());
        });
    });

    $(document).on('change', '.checkAddPayee', function() {
        const selectize = $(this)[0].selectize;
        const selectedId = selectize.getValue();

        if (!selectedId) {
            $('.checkAddViewPayeeInfo').hide();
            $('.checkAddMailingAddress').val(null);
            return;
        }

        const selectedData = selectize.options[selectedId];
        let payee_type = selectedData.payee_type;
        let viewInfoURL = "";

        let street = selectedData.payee_street || '[Street]';
        let city = selectedData.payee_city || '[City]';
        let state = selectedData.payee_state || '[State]';
        let zip = selectedData.payee_zip_code || '[Zip Code]';
        let fullAddress = `${street}, ${city}, ${state} ${zip}`;

        switch (payee_type) {
            case "employee":
                viewInfoURL = `${window.origin}/users/view/${selectedId}`;
                break;
            case "customer":
                viewInfoURL = `${window.origin}/customer/preview/${selectedId}`;
                break;
            case "vendor":
                viewInfoURL = `${window.origin}/accounting/vendors/view/${selectedId}`;
                break;
        }

        $('.checkAddMailingAddress').val(fullAddress);
        $('.checkAddPayeeType').val(payee_type);
        $('.checkAddViewPayeeInfo').fadeIn('fast').attr('href', viewInfoURL).attr('target', '_blank');
    });

    $(document).on('change', '.checkAddBankAccount', function() {
        const selectize = $(this)[0].selectize;
        const selectedId = selectize.getValue();
        const selectedData = selectize.options[selectedId];
        const balance = selectedData?.balance || 0;
        const formattedBalance = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
            minimumFractionDigits: 2
        }).format(parseFloat(balance));

        $('.checkAddBankAccountBalance').text(formattedBalance);
    });

    $(document).on('change', '.checkAddPrintLater', function() {
        const isChecked = $(this).prop('checked');
        const $sequenceLabel = $('.checkAddSequenceLabel');
        const $checkAddNoInput = $('.checkAddNo');

        if (isChecked) {
            $checkAddNoInput.data('original', $checkAddNoInput.val());
            $checkAddNoInput.val('');
            $checkAddNoInput.prop('disabled', true);
            $sequenceLabel.text('Print Later');
        } else {
            const originalValue = $checkAddNoInput.data('original') || '0';
            $checkAddNoInput.val(originalValue);

            const paddedValue = originalValue.toString().padStart(4, '0');
            $sequenceLabel.text(`#${paddedValue}`);
            $checkAddNoInput.prop('disabled', false);
        }
    });

    $(document).on('click', '.checkAddHistory', function() {
        $('.checkAddNotificationDot').hide();
    });

    initSelectizeWithCache({
        selector: '.checkAddCategoryOptionsRow',
        url: `${window.origin}/accounting/v2/check/getAccountDetails/all`,
        valueField: 'value',
        labelField: 'text',
        searchField: 'text',
        optgroupField: 'optgroup',
        placeholder: 'Select Category...',
        renderOptionAttr: 'balance',
    });

    initSelectizeWithCache({
        selector: '.checkAddCategoryCustomerRow',
        url: `${window.origin}/accounting/v2/check/getPayeeDetails/customer`,
        valueField: 'id',
        labelField: 'payee_name',
        searchField: 'payee_name',
        optgroupField: 'payee_type',
        placeholder: 'Select Customer...',
        renderOptionAttr: 'payee_type',
    });

    $('.accordion').on('click', '.checkAddCategoryLine', function() {
        let $tbody = $(this).closest('.accordion-body').find('table tbody');
        let $newRow = $(getCheckAddCategoryRowHtml());
        $tbody.append($newRow);

        initSelectizeWithCache({
            selector: $newRow.find('.checkAddCategoryOptionsRow'),
            url: `${window.origin}/accounting/v2/check/getAccountDetails/all`,
            valueField: 'value',
            labelField: 'text',
            searchField: 'text',
            optgroupField: 'optgroup',
            placeholder: 'Select Category...',
            renderOptionAttr: 'balance',
        });

        initSelectizeWithCache({
            selector: $newRow.find('.checkAddCategoryCustomerRow'),
            url: `${window.origin}/accounting/v2/check/getPayeeDetails/customer`,
            valueField: 'id',
            labelField: 'payee_name',
            searchField: 'payee_name',
            optgroupField: 'payee_type',
            placeholder: 'Select Customer...',
            renderOptionAttr: 'payee_type',
        });
    });

    $('.accordion').on('click', '.checkAddClearCategoryLine', function() {
        let $tbody = $(this).closest('.accordion-body').find('table tbody');
        Swal.fire({
            icon: 'warning',
            title: 'Clear Lines',
            text: 'Are you sure you want to clear all lines?',
            showCancelButton: true,
            confirmButtonText: 'Proceed',
        }).then((result) => {
            if (result.isConfirmed) {
                const $newRow = $(getCheckAddCategoryRowHtml());
                $tbody.html($newRow);

                initSelectizeWithCache({
                    selector: $newRow.find('.checkAddCategoryOptionsRow'),
                    url: `${window.origin}/accounting/v2/check/getAccountDetails/all`,
                    valueField: 'value',
                    labelField: 'text',
                    searchField: 'text',
                    optgroupField: 'optgroup',
                    placeholder: 'Select Category...',
                    renderOptionAttr: 'balance',
                });

                initSelectizeWithCache({
                    selector: $newRow.find('.checkAddCategoryCustomerRow'),
                    url: `${window.origin}/accounting/v2/check/getPayeeDetails/customer`,
                    valueField: 'id',
                    labelField: 'payee_name',
                    searchField: 'payee_name',
                    optgroupField: 'payee_type',
                    placeholder: 'Select Customer...',
                    renderOptionAttr: 'payee_type',
                });
            }
        });
    });

    initSelectizeWithCache({
        selector: '.checkAddItemOptionsRow',
        url: `${window.origin}/accounting/v2/check/getItemDetails/product_service`,
        valueField: 'id',
        labelField: 'item_name',
        searchField: 'item_name',
        optgroupField: 'item_type',
        placeholder: 'Select Product/Service...',
        renderOptionAttr: 'item_type',
    });

    initSelectizeWithCache({
        selector: '.checkAddItemCustomerRow',
        url: `${window.origin}/accounting/v2/check/getPayeeDetails/customer`,
        valueField: 'id',
        labelField: 'payee_name',
        searchField: 'payee_name',
        optgroupField: 'payee_type',
        placeholder: 'Select Customer...',
        renderOptionAttr: 'payee_type',
    });

    $('.accordion').on('click', '.checkAddItemLine', function() {
        let $tbody = $(this).closest('.accordion-body').find('table tbody');
        let $newRow = $(getCheckAddItemRowHtml());
        $tbody.append($newRow);

        initSelectizeWithCache({
            selector: $newRow.find('.checkAddItemOptionsRow'),
            url: `${window.origin}/accounting/v2/check/getItemDetails/product_service`,
            valueField: 'id',
            labelField: 'item_name',
            searchField: 'item_name',
            optgroupField: 'item_type',
            placeholder: 'Select Product/Service...',
            renderOptionAttr: 'item_type',
        });

        initSelectizeWithCache({
            selector: $newRow.find('.checkAddItemCustomerRow'),
            url: `${window.origin}/accounting/v2/check/getPayeeDetails/customer`,
            valueField: 'id',
            labelField: 'payee_name',
            searchField: 'payee_name',
            optgroupField: 'payee_type',
            placeholder: 'Select Customer...',
            renderOptionAttr: 'payee_type',
        });
    });

    $('.accordion').on('click', '.checkAddClearItemLine', function() {
        let $tbody = $(this).closest('.accordion-body').find('table tbody');
        Swal.fire({
            icon: 'warning',
            title: 'Clear Lines',
            text: 'Are you sure you want to clear all lines?',
            showCancelButton: true,
            confirmButtonText: 'Proceed',
        }).then((result) => {
            if (result.isConfirmed) {
                const $newRow = $(getCheckAddItemRowHtml());
                $tbody.html($newRow);

                initSelectizeWithCache({
                    selector: $newRow.find('.checkAddItemOptionsRow'),
                    url: `${window.origin}/accounting/v2/check/getItemDetails/all`,
                    valueField: 'id',
                    labelField: 'item_name',
                    searchField: 'item_name',
                    optgroupField: 'item_type',
                    placeholder: 'Select Product/Service...',
                    renderOptionAttr: 'item_type',
                });

                initSelectizeWithCache({
                    selector: $newRow.find('.checkAddItemCustomerRow'),
                    url: `${window.origin}/accounting/v2/check/getPayeeDetails/customer`,
                    valueField: 'id',
                    labelField: 'payee_name',
                    searchField: 'payee_name',
                    optgroupField: 'payee_type',
                    placeholder: 'Select Customer...',
                    renderOptionAttr: 'payee_type',
                });
            }
        });
    });

    $('.accordion').on('click', '.checkAddDeleteLine', function() {
        let $tbody = $(this).closest('tbody');
        if ($tbody.find('tr').length > 1) {
            $(this).closest('tr').remove();
        }
    });

    $(document).on('change', '.checkAddItemOptionsRow', function() {
        const $row = $(this).closest('tr');
        const selectize = $(this)[0].selectize;
        const selectedId = selectize.getValue();
        const selectedData = selectize.options[selectedId];
        const price = parseFloat(selectedData.item_price) || 0;
        const qty = 1;
        const amount = qty * price;

        $row.find('.checkAddItemQtyRow').val(qty);
        $row.find('.checkAddItemRateRow').val(price.toFixed(2));
        $row.find('.checkAddItemAmountRow').val(amount.toFixed(2));
    });

    $(document).on('input', '.checkAddItemQtyRow', function() {
        const $row = $(this).closest('tr');
        const qty = parseFloat($(this).val()) || 0;
        const rate = parseFloat($row.find('.checkAddItemRateRow').val()) || 0;
        const amount = qty * rate;

        $row.find('.checkAddItemAmountRow').val(amount.toFixed(2));
    });

    $(document).on('input', '.checkAddItemRateRow', function() {
        const $row = $(this).closest('tr');
        const qty = parseFloat($row.find('.checkAddItemQtyRow').val()) || 0;
        const rate = parseFloat($(this).val()) || 0;
        const amount = qty * rate;

        $row.find('.checkAddItemAmountRow').val(amount.toFixed(2));
    });

    initSelectizeWithCache({
        selector: '.checkAddCategorySearch',
        url: `${window.origin}/accounting/v2/check/getAccountDetails/all`,
        valueField: 'text',
        labelField: 'text',
        searchField: 'text',
        optgroupField: 'optgroup',
        placeholder: 'Search Category...',
        renderOptionAttr: 'balance',
    });

    $(document).ready(function() {
        recentAddCheckTable = $('.recentAddCheckTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": {
                "url": `${window.origin}/accounting_controllers/v2/check/getRecentChecksServerside`,
                "type": "POST",
            },
            "language": {
                "infoFiltered": "",
                // "processing": "<div class='custom-loader'><p>Processing, please wait...</p></div>",
            },
        });

        $('.recentAddCheckTableSearch').keyup(function() {
            recentAddCheckTable.search($(this).val()).draw(false);
        });

        $(document).on('change', '.checkAddCategorySearch', function() {
            recentAddCheckTable.search($(this).val()).draw(false);

        });
    });

    FilePond.registerPlugin(
        FilePondPluginFileEncode,
        FilePondPluginFileValidateType,
        FilePondPluginImagePreview,
        FilePondPluginGetFile
    );

    FilePond.setOptions({
        dropOnPage: true,
        dropOnElement: true
    });

    document.querySelectorAll('.checkAddAttachments, .virtualCheckAddAttachments').forEach(el => {
        FilePond.create(el, {
            credits: false,
            allowFilePoster: false,
            allowImageEditor: false,
        });
    });

    $(document).on('input change', '.checkAddCategoryAmountRow, .checkAddItemQtyRow, .checkAddItemRateRow, .checkAddItemAmountRow', function() {
        $('.checkAddTotalAmountValueLabel').text(
            new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD'
            })
            .format($('.checkAddCategoryAmountRow, .checkAddItemAmountRow').toArray().reduce((t, el) => t + (parseFloat($(el).val()) || 0), 0))
        );
    });

    ['.checkAddCategoryTable tbody', '.checkAddItemTable tbody'].forEach(selector => {
        const targetNode = document.querySelector(selector);
        if (targetNode) {
            new MutationObserver(() => {
                $('.checkAddTotalAmountValueLabel').text(
                    new Intl.NumberFormat('en-US', {
                        style: 'currency',
                        currency: 'USD'
                    })
                    .format($('.checkAddCategoryAmountRow, .checkAddItemAmountRow').toArray().reduce((t, el) => t + (parseFloat($(el).val()) || 0), 0))
                );
            }).observe(targetNode, {
                childList: true,
                subtree: true
            });
        }
    });

    function checkAddResetForm() {
        $('.checkAddBadge').hide();
        $('.checkAddTag')[0].selectize.clear();
        $('.checkAddPayee')[0].selectize.clear();
        $('.checkAddMailingAddress').val('');
        $('.checkAddMemo').val('');

        const $catTbody = $('.checkAddCategoryTable tbody');
        const $newCatRow = $(getCheckAddCategoryRowHtml());
        $catTbody.html($newCatRow);

        initSelectizeWithCache({
            selector: $newCatRow.find('.checkAddCategoryOptionsRow'),
            url: `${window.origin}/accounting/v2/check/getAccountDetails/all`,
            valueField: 'value',
            labelField: 'text',
            searchField: 'text',
            optgroupField: 'optgroup',
            placeholder: 'Select Category...',
            renderOptionAttr: 'balance',
        });

        initSelectizeWithCache({
            selector: $newCatRow.find('.checkAddCategoryCustomerRow'),
            url: `${window.origin}/accounting/v2/check/getPayeeDetails/customer`,
            valueField: 'id',
            labelField: 'payee_name',
            searchField: 'payee_name',
            optgroupField: 'payee_type',
            placeholder: 'Select Customer...',
            renderOptionAttr: 'payee_type',
        });

        const $itemTbody = $('.checkAddItemTable tbody');
        const $newItemRow = $(getCheckAddItemRowHtml());
        $itemTbody.html($newItemRow);

        initSelectizeWithCache({
            selector: $newItemRow.find('.checkAddItemOptionsRow'),
            url: `${window.origin}/accounting/v2/check/getItemDetails/product_service`,
            valueField: 'id',
            labelField: 'item_name',
            searchField: 'item_name',
            optgroupField: 'item_type',
            placeholder: 'Select Product/Service...',
            renderOptionAttr: 'item_type',
        });

        initSelectizeWithCache({
            selector: $newItemRow.find('.checkAddItemCustomerRow'),
            url: `${window.origin}/accounting/v2/check/getPayeeDetails/customer`,
            valueField: 'id',
            labelField: 'payee_name',
            searchField: 'payee_name',
            optgroupField: 'payee_type',
            placeholder: 'Select Customer...',
            renderOptionAttr: 'payee_type',
        });
    
        $('.checkAddAttachments').each(function() {
            const pond = FilePond.find(this);
            if (pond) {
                pond.removeFiles();
            }
        });
    }

    $('.checkAddForm').on('submit', function (e) {
        e.preventDefault();
        const checkAddForm = $(this);
        let checkAddFormData = new FormData(this);
        
        const pond = FilePond.find(document.querySelector('.checkAddAttachments'));
        
        if (pond && pond.getFiles().length > 0) {
            pond.getFiles().forEach((fileItem, index) => {
                if (fileItem.file) {
                    checkAddFormData.append(`checkAddAttachments[]`, fileItem.file);
                }
            });
        }

        $.ajax({
            type: "POST",
            url: `${window.origin}/accounting/v2/check/addCheck`,
            data: checkAddFormData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                formDisabler(checkAddForm, true);
            },
            success: function (response) {
                formDisabler($('.virtualCheckAddForm'), false);
                formDisabler(checkAddForm, false);
                
                if (response == 1) {
                    Swal.fire({
                        icon: "success",
                        title: "Entry Saved!",
                        html: "Check has been added successfully.",
                        showConfirmButton: true,
                        confirmButtonText: "Okay",
                    }).then((result) => {
                        try {
                            checkTable.draw(false);
                            recentAddCheckTable.draw(false);
                            recentEditCheckTable.draw(false);
                        } catch (error) {}
                        $('.checkAddNotificationDot').show();
                        checkAddResetForm();
                        setLastSettings(); 
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Save entry Failed!",
                        html: response.message || "An error occurred while saving the entry.",
                        showConfirmButton: true,
                        confirmButtonText: "Okay",
                    });
                }
            },
            error: function (xhr, status, error) {
                formDisabler($('.virtualCheckAddForm'), false);
                formDisabler(checkAddForm, false);
                Swal.fire({
                    icon: "error",
                    title: "Error!",
                    html: "An unexpected error occurred: " + error,
                    showConfirmButton: true,
                    confirmButtonText: "Okay",
                });
            },
        });
    });
 
    

    // function copyCheck(check_id) {
    //     $.ajax({
    //         type: "POST",
    //         data: { check_id: check_id },
    //         url: `${window.origin}/accounting/v2/check/getCheckDetails`,
    //         success: function(response) {
    //         }
    //     });
    // }
</script>