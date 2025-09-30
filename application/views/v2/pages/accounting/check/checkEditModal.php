<?php include viewPath('v2/pages/accounting/check/checkModal.css'); ?>
<?php include viewPath('v2/pages/accounting/check/checkModal.js'); ?>
<div class="container">
    <div class="row checkEditModalContent">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-9 position-relative">
                    <h4 class="fw-bold">Edit Check&ensp;<small class="text-muted fw-normal checkEditSequenceLabel"></small></h4>
                    <p>Edit the details of an existing check.</p> 
                    <div class="badge bg-danger position-absolute checkEditBadge">THIS CHECK IS VOIDED!</div>
                </div>
                <div class="col-lg-3">
                    <div class="float-end">
                        <span class="checkEditTotalAmountLabel fs-5">Total Amount</span>
                        <h3 class="checkEditTotalAmountValueLabel">$0.00</h4>
                    </div>   
                </div>
            </div>
            <button type="button" class="border-0 rounded mx-1 editCheckModalExitButton" data-bs-dismiss="modal"><i class="fas fa-times m-0 text-muted"></i></button>
        </div>
        <div class="col-lg-12">
            <ul class="nav nav-pills mb-3" id="checkEditTemplateStyleTab" role="tablist">
                <li class="nav-item historyNavItem" role="presentation">
                    <button type="button" class="btn btn-light position-relative checkEditHistory" data-bs-toggle="offcanvas" data-bs-target="#checkEditRecentTransactionsOffCanvas" aria-controls="checkEditRecentTransactionsOffCanvas" type="button">
                        <i class="fas fa-history text-muted"></i>
                        <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle checkEditNotificationDot"></span>
                    </button>
                </li>
                <div class="vr navPillSepator"></div>
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link active" id="checkEditStandardTab" data-bs-toggle="pill" data-bs-target="#checkEditStandardPill" type="button" role="tab" aria-controls="checkEditStandardPill" aria-selected="true">Standard</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link" id="checkEditVirtualTab" data-bs-toggle="pill" data-bs-target="#checkEditVirtualPill" type="button" role="tab" aria-controls="checkEditVirtualPill" aria-selected="false">Virtual</button>
                </li>
            </ul>
            <div class="tab-content" id="checkEditTemplateStyleTabContent">
                <div class="tab-pane fade show active" id="checkEditStandardPill" role="tabpanel" aria-labelledby="checkEditStandardTab">
                    <form class="checkEditForm">
                        <div class="row">
                            <div class="col-lg-3 mb-3">
                                <label class="form-label fw-xnormal">Check No.</label>
                                <label class="text-muted float-end highlightTextDisable"><input class="form-check-input checkEditPrintLater" name="checkEditPrintLater" type="checkbox">&ensp;Print Later</label>
                                <input type="number" class="form-control checkEditNo" name="checkEditNo" value="0000" min="0" required>
                                <input type="hidden" class="form-control checkEditID" name="checkEditID">
                            </div>
                            <div class="col-lg-2 mb-3">
                                <label class="form-label fw-xnormal">Permit No.</label>
                                <input type="number" class="form-control checkEditPermitNo" name="checkEditPermitNo" value="0000" min="0" required>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="form-label fw-xnormal">Payee</label>
                                <a class="text-decoration-none float-end checkEditViewPayeeInfo" href="javascript:void(0);">View Info</a>
                                <select class="form-select checkEditPayee" name="checkEditPayee" required></select>
                                <input type="hidden" class="form-control checkEditPayeeType" name="checkEditPayeeType">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label class="form-label fw-xnormal">Bank Account</label>&ensp;<span class="text-muted checkEditBankAccountBalance">$0.00</span>
                                <label class="text-muted float-end highlightTextDisable"></label>
                                <select class="form-select checkEditBankAccount" name="checkEditBankAccount" required></select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 mb-3">
                                <label class="form-label fw-xnormal">Payment Date</label>
                                <input type="date" class="form-control checkEditPaymentDate" name="checkEditPaymentDate" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <div class="col-lg-10 mb-3">
                                <label class="form-label fw-xnormal">Tags</label>
                                <a class="text-decoration-none float-end checkEditClearTags" href="javascript:void(0);">Clear Tags</a>
                                <select class="form-select checkEditTag" name="checkEditTag[]" required></select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="form-label fw-xnormal">Mailing Address</label>
                                <textarea class=" form-control checkEditMailingAddress" name="checkEditMailingAddress" placeholder="Payee's Mailing Address..." required></textarea>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="form-label fw-xnormal">Memo</label>
                                <textarea class=" form-control checkEditMemo" name="checkEditMemo" placeholder="Check's memo..."></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="accordion">
                                    <div class="accordion-item border-0">
                                        <h2 class="accordion-header" id="checkEditCategoryDetails_panel">
                                            <button type="button" class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#checkEditCategoryDetails_collapse" aria-expanded="true" aria-controls="checkEditCategoryDetails_collapse">
                                                <strong>CATEGORY DETAILS</strong>
                                            </button>
                                        </h2>
                                        <div id="checkEditCategoryDetails_collapse" class="accordion-collapse collapse show" aria-labelledby="checkEditCategoryDetails_panel">
                                            <div class="accordion-body p-0 pt-3 pb-3">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <table class="table table-bordered checkEditCategoryTable w-100">
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
                                                                    <td><select class="form-select checkEditCategoryOptionsRow" name="checkEditCategoryOptionsRow[]" required></select></td>
                                                                    <td><input type="text" class="form-control checkEditCategoryDescriptionRow" name="checkEditCategoryDescriptionRow[]"></td>
                                                                    <td><input type="number" class="form-control checkEditCategoryAmountRow" name="checkEditCategoryAmountRow[]" min="0" step="any" required></td>
                                                                    <td class="text-center"><input type="checkbox" class="form-check-input checkEditCategoryBillableRow" name="checkEditCategoryBillableRow[]"></td>
                                                                    <td class="text-center"><input type="checkbox" class="form-check-input checkEditCategoryTaxRow" name="checkEditCategoryTaxRow[]"></td>
                                                                    <td><select class="form-select checkEditCategoryCustomerRow" name="checkEditCategoryCustomerRow[]" required></select></td>
                                                                    <td><button type="button" class="border-0 checkEditDeleteLine"><i class="fas fa-minus text-danger"></i></button></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="input-group">
                                                            <button type="button" class="btn btn-primary checkEditCategoryLine" type="button">Add</button>
                                                            <button type="button" class="btn btn-light checkEditClearCategoryLine" type="button">Clear</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item border-0">
                                        <h2 class="accordion-header" id="checkEditItemDetails_panel">
                                            <button type="button" class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#checkEditItemDetails_collapse" aria-expanded="true" aria-controls="checkEditItemDetails_collapse">
                                                <strong>ITEM DETAILS</strong>
                                            </button>
                                        </h2>
                                        <div id="checkEditItemDetails_collapse" class="accordion-collapse collapse show" aria-labelledby="checkEditItemDetails_panel">
                                            <div class="accordion-body p-0 pt-3 pb-3">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <table class="table table-bordered checkEditItemTable w-100">
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
                                                                    <td><select class="form-select checkEditItemOptionsRow" name="checkEditItemOptionsRow[]"></select></td>
                                                                    <td><input type="text" class="form-control checkEditItemDescriptionRow" name="checkEditItemDescriptionRow[]"></td>
                                                                    <td><input type="number" class="form-control checkEditItemQtyRow" name="checkEditItemQtyRow[]" min="0"></td>
                                                                    <td><input type="number" class="form-control checkEditItemRateRow" name="checkEditItemRateRow[]" min="0" step="any"></td>
                                                                    <td><input type="number" class="form-control checkEditItemAmountRow" name="checkEditItemAmountRow[]" min="0" step="any"></td>
                                                                    <td class="text-center"><input type="checkbox" class="form-check-input checkEditItemBillableRow" name="checkEditItemBillableRow[]"></td>
                                                                    <td class="text-center"><input type="checkbox" class="form-check-input checkEditItemTaxRow" name="checkEditItemTaxRow[]"></td>
                                                                    <td><select class="form-select checkEditItemCustomerRow" name="checkEditItemCustomerRow[]"></select></td>
                                                                    <td><button type="button" class="border-0 checkEditDeleteLine"><i class="fas fa-minus text-danger"></i></button></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="input-group">
                                                            <button type="button" class="btn btn-primary checkEditItemLine" type="button">Add</button>
                                                            <button type="button" class="btn btn-light checkEditClearItemLine" type="button">Clear</button>
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
                                <input type="file" class="form-control checkEditAttachments" name="checkEditAttachments[]" multiple>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary fw-bold float-end checkEditSubmitButton"><i class="fas fa-file-import"></i>&ensp;Update</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="checkEditVirtualPill" role="tabpanel" aria-labelledby="checkEditVirtualTab">
                    <form class="virtualCheckEditForm">
                        <div class="virtualCheckEditContainer">
                            <div class="virtualCheckEditSection">
                                <div class="virtualCheckEditPayerInfoSection position-absolute d-none">
                                    <strong class="virtualCheckEditPayerNameText">{PAYER_NAME}</strong><br>
                                    <span class="virtualCheckEditPayerAddressText">{ADDRESS}</span>
                                </div>
                                <div class="virtualPrintLaterSection position-absolute">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="virtualCheckEditPrintLater">
                                        <label class="form-check-label text-muted" for="virtualCheckEditPrintLater">Print Later</label>
                                    </div>
                                </div>
                                <div class="virtualCheckEditNumberSection position-absolute">
                                    <div class="d-flex align-items-center">
                                        <label for="virtualCheckEditNumberInput" class="me-2">Check No.</label>
                                        <input type="number" id="virtualCheckEditNumberInput" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="virtualCheckEditDateSection position-absolute">
                                    <div class="d-flex align-items-center">
                                        <label for="virtualCheckEditDateInput" class="me-2">Date</label>
                                        <input type="date" id="virtualCheckEditDateInput" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                                    </div>
                                </div>
                                <div class="virtualCheckEditPayeeSection position-absolute">
                                    <div class="d-flex align-items-center">
                                        <strong for="virtualCheckEditPayeeSelect" class="me-2 text-nowrap">Pay to the Order of</strong>
                                        <select id="virtualPayee" name="virtualPayee" class="form-select virtualCheckEditPayeeSelect" required>
                                            <option value="" selected disabled>Select payee...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="virtualCheckEditAmountSection position-absolute">
                                    <div class="input-group">
                                        <div class="input-group-text" id="virtualBtnGroupAddon"><strong>$</strong></div>
                                        <input id="virtualCheckEditAmountInput" type="number" class="form-control" placeholder="0.00" step="any" required>
                                    </div>
                                </div>
                                <div class="virtualCheckEditWrittenAmountSection position-absolute">
                                    <div class="d-flex align-items-center">
                                        <span id="virtualCheckEditWrittenText" class="me-2 text-nowrap">{WRITTEN_AMOUNT}</span>
                                        <strong class="me-2 text-nowrap">Dollars</strong>
                                    </div>
                                </div>
                                <div class="virtualCheckEditBankNameSection position-absolute">
                                    <select id="virtualBankAccount" name="virtualBankAccount" class="form-select virtualCheckEditBankNameSelect" required>
                                        <option value="" selected disabled>Select Bank...</option>
                                    </select>
                                </div>
                                <div class="virtualCheckEditCategoryNameSection position-absolute">
                                    <select name="virtualCategory[]" class="form-select virtualCheckEditCategorySelect" required>
                                        <option value="" selected disabled>Select Category...</option>
                                    </select>
                                </div>
                                <div class="virtualCheckEditMemoSection position-absolute">
                                    <div class="d-flex align-items-center">
                                        <strong for="virtualCheckEditMemoInput" class="me-2 text-nowrap">Memo</strong>
                                        <input type="text" id="virtualCheckEditMemoInput" class="form-control text-muted" placeholder="Specify notes...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <!-- <div class="col-lg-12 virtualCheckEditAttachmentSection"></div> -->
                            <div class="col-lg-12">
                                <div class="float-end">
                                    <button type="submit" class="btn btn-primary fw-bold float-end checkEditSubmitButton"><i class="fas fa-file-import"></i>&ensp;Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="offcanvas offcanvas-start" tabindex="-1" id="checkEditRecentTransactionsOffCanvas" aria-labelledby="checkEditRecentTransactionsOffCanvasLabel">
    <div class="offcanvas-header">
        <h4 class="offcanvas-title fw-bold" id="checkEditRecentTransactionsOffCanvasLabel">Recent Transactions</h4>
        <button type="button" class="border-0 rounded mx-1" data-bs-dismiss="offcanvas"><i class="fas fa-times m-0 text-muted"></i></button>
    </div>
    <div class="offcanvas-body pt-0">
        <div class="row">
            <div class="col-12-md mb-3">
                <span>Displays the recent checks created to track your latest entries.</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 mb-1">
                <div class="input-group float-start">
                    <input class="form-control recentEditCheckTableSearch" type="text" placeholder="Search...">
                    <select class="form-select checkEditCategorySearch"></select>
                </div>
            </div>
            <div class="col-lg-2 mb-1">
                <div class="float-end">
                    <button class="btn btn-light recentEditCheckPrint" type="button" disabled><i class="fas fa-print text-muted"></i>&ensp;Print</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-hover recentEditCheckTable w-100">
                    <thead style="background: #00000008;">
                        <tr>
                            <th class="width0"><input class="form-check-input recentEditCheckAll" type="checkbox"></th>
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
    var recentEditCheckTable;

    function getCheckEditCategoryRowHtml() {
        return `<tr>
            <td><select class="form-select checkEditCategoryOptionsRow" name="checkEditCategoryOptionsRow[]" required></select></td>
            <td><input type="text" class="form-control checkEditCategoryDescriptionRow" name="checkEditCategoryDescriptionRow[]"></td>
            <td><input type="number" class="form-control checkEditCategoryAmountRow" name="checkEditCategoryAmountRow[]" min="0" step="any" required></td>
            <td class="text-center"><input type="checkbox" class="form-check-input checkEditCategoryBillableRow" name="checkEditCategoryBillableRow[]"></td>
            <td class="text-center"><input type="checkbox" class="form-check-input checkEditCategoryTaxRow" name="checkEditCategoryTaxRow[]"></td>
            <td><select class="form-select checkEditCategoryCustomerRow" name="checkEditCategoryCustomerRow[]" required></select></td>
            <td><button type="button" class="border-0 checkEditDeleteLine"><i class="fas fa-minus text-danger"></i></button></td>
        </tr>`;
    }

    function getCheckEditItemRowHtml() {
        return `
            <tr>
                <td><select class="form-select checkEditItemOptionsRow" name="checkEditItemOptionsRow[]"></select></td>
                <td><input type="text" class="form-control checkEditItemDescriptionRow" name="checkEditItemDescriptionRow[]"></td>
                <td><input type="number" class="form-control checkEditItemQtyRow" name="checkEditItemQtyRow[]" min="0"></td>
                <td><input type="number" class="form-control checkEditItemRateRow" name="checkEditItemRateRow[]" min="0" step="any"></td>
                <td><input type="number" class="form-control checkEditItemAmountRow" name="checkEditItemAmountRow[]" min="0" step="any"></td>
                <td class="text-center"><input type="checkbox" class="form-check-input checkEditItemBillableRow" name="checkEditItemBillableRow[]"></td>
                <td class="text-center"><input type="checkbox" class="form-check-input checkEditItemTaxRow" name="checkEditItemTaxRow[]"></td>
                <td><select class="form-select checkEditItemCustomerRow" name="checkEditItemCustomerRow[]"></select></td>
                <td><button type="button" class="border-0 checkEditDeleteLine"><i class="fas fa-minus text-danger"></i></button></td>
            </tr>
        `;
    }

    initSelectizeWithCache({
        selector: '.checkEditPayee',
        url: `${window.origin}/accounting/v2/check/getPayeeDetails/all`,
        valueField: 'id',
        labelField: 'payee_name',
        searchField: 'payee_name',
        optgroupField: 'payee_type',
        placeholder: 'Select Payee...',
        renderOptionAttr: 'payee_type',
    });

    initSelectizeWithCache({
        selector: '.checkEditBankAccount',
        url: `${window.origin}/accounting/v2/check/getAccountDetails/Bank`,
        valueField: 'value',
        labelField: 'text',
        searchField: 'text',
        optgroupField: 'optgroup',
        placeholder: 'Select Bank Account...',
        renderOptionAttr: 'balance',
    });

    initSelectizeWithCache({
        selector: '.checkEditTag',
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
        const $checkEditNoInput = $('.checkEditNo');
        const $sequenceLabel = $('.checkEditSequenceLabel');

        function updateSequenceLabel(value) {
            const paddedValue = value.toString().padStart(4, '0');
            $sequenceLabel.text(`#${paddedValue}`);
        }

        if ($checkEditNoInput.length && $sequenceLabel.length) {
            updateSequenceLabel($checkEditNoInput.val());
        }

        $checkEditNoInput.on('input change', function() {
            updateSequenceLabel($(this).val());
        });
    });

    $(document).on('change', '.checkEditPayee', function() {
        const selectize = $(this)[0].selectize;
        const selectedId = selectize.getValue();

        if (!selectedId) {
            $('.checkEditViewPayeeInfo').hide();
            $('.checkEditMailingAddress').val(null);
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

        $('.checkEditMailingAddress').val(fullAddress);
        $('.checkEditPayeeType').val(payee_type);
        $('.checkEditViewPayeeInfo').fadeIn('fast').attr('href', viewInfoURL).attr('target', '_blank');
    });

    $(document).on('change', '.checkEditBankAccount', function() {
        const selectize = $(this)[0].selectize;
        const selectedId = selectize.getValue();
        const selectedData = selectize.options[selectedId];
        const balance = selectedData?.balance || 0;
        const formattedBalance = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
            minimumFractionDigits: 2
        }).format(parseFloat(balance));

        $('.checkEditBankAccountBalance').text(formattedBalance);
    });

    $(document).on('change', '.checkEditPrintLater', function() {
        const isChecked = $(this).prop('checked');
        const $sequenceLabel = $('.checkEditSequenceLabel');
        const $checkEditNoInput = $('.checkEditNo');

        if (isChecked) {
            $checkEditNoInput.data('original', $checkEditNoInput.val());
            $checkEditNoInput.val('');
            $checkEditNoInput.prop('disabled', true);
            $sequenceLabel.text('Print Later');
        } else {
            const originalValue = $checkEditNoInput.data('original') || '0';
            $checkEditNoInput.val(originalValue);

            const paddedValue = originalValue.toString().padStart(4, '0');
            $sequenceLabel.text(`#${paddedValue}`);
            $checkEditNoInput.prop('disabled', false);
        }
    });

    $(document).on('click', '.checkEditHistory', function() {
        $('.checkEditNotificationDot').hide();
    });

    initSelectizeWithCache({
        selector: '.checkEditCategoryOptionsRow',
        url: `${window.origin}/accounting/v2/check/getAccountDetails/all`,
        valueField: 'value',
        labelField: 'text',
        searchField: 'text',
        optgroupField: 'optgroup',
        placeholder: 'Select Category...',
        renderOptionAttr: 'balance',
    });

    initSelectizeWithCache({
        selector: '.checkEditCategoryCustomerRow',
        url: `${window.origin}/accounting/v2/check/getPayeeDetails/customer`,
        valueField: 'id',
        labelField: 'payee_name',
        searchField: 'payee_name',
        optgroupField: 'payee_type',
        placeholder: 'Select Customer...',
        renderOptionAttr: 'payee_type',
    });

    $('.accordion').on('click', '.checkEditCategoryLine', function() {
        let $tbody = $(this).closest('.accordion-body').find('table tbody');
        let $newRow = $(getCheckEditCategoryRowHtml());
        $tbody.append($newRow);

        initSelectizeWithCache({
            selector: $newRow.find('.checkEditCategoryOptionsRow'),
            url: `${window.origin}/accounting/v2/check/getAccountDetails/all`,
            valueField: 'value',
            labelField: 'text',
            searchField: 'text',
            optgroupField: 'optgroup',
            placeholder: 'Select Category...',
            renderOptionAttr: 'balance',
        });

        initSelectizeWithCache({
            selector: $newRow.find('.checkEditCategoryCustomerRow'),
            url: `${window.origin}/accounting/v2/check/getPayeeDetails/customer`,
            valueField: 'id',
            labelField: 'payee_name',
            searchField: 'payee_name',
            optgroupField: 'payee_type',
            placeholder: 'Select Customer...',
            renderOptionAttr: 'payee_type',
        });
    });

    $('.accordion').on('click', '.checkEditClearCategoryLine', function() {
        let $tbody = $(this).closest('.accordion-body').find('table tbody');
        Swal.fire({
            icon: 'warning',
            title: 'Clear Lines',
            text: 'Are you sure you want to clear all lines?',
            showCancelButton: true,
            confirmButtonText: 'Proceed',
        }).then((result) => {
            if (result.isConfirmed) {
                const $newRow = $(getCheckEditCategoryRowHtml());
                $tbody.html($newRow);

                initSelectizeWithCache({
                    selector: $newRow.find('.checkEditCategoryOptionsRow'),
                    url: `${window.origin}/accounting/v2/check/getAccountDetails/all`,
                    valueField: 'value',
                    labelField: 'text',
                    searchField: 'text',
                    optgroupField: 'optgroup',
                    placeholder: 'Select Category...',
                    renderOptionAttr: 'balance',
                });

                initSelectizeWithCache({
                    selector: $newRow.find('.checkEditCategoryCustomerRow'),
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
        selector: '.checkEditItemOptionsRow',
        url: `${window.origin}/accounting/v2/check/getItemDetails/product_service`,
        valueField: 'id',
        labelField: 'item_name',
        searchField: 'item_name',
        optgroupField: 'item_type',
        placeholder: 'Select Product/Service...',
        renderOptionAttr: 'item_type',
    });

    initSelectizeWithCache({
        selector: '.checkEditItemCustomerRow',
        url: `${window.origin}/accounting/v2/check/getPayeeDetails/customer`,
        valueField: 'id',
        labelField: 'payee_name',
        searchField: 'payee_name',
        optgroupField: 'payee_type',
        placeholder: 'Select Customer...',
        renderOptionAttr: 'payee_type',
    });

    $('.accordion').on('click', '.checkEditItemLine', function() {
        let $tbody = $(this).closest('.accordion-body').find('table tbody');
        let $newRow = $(getCheckEditItemRowHtml());
        $tbody.append($newRow);

        initSelectizeWithCache({
            selector: $newRow.find('.checkEditItemOptionsRow'),
            url: `${window.origin}/accounting/v2/check/getItemDetails/product_service`,
            valueField: 'id',
            labelField: 'item_name',
            searchField: 'item_name',
            optgroupField: 'item_type',
            placeholder: 'Select Product/Service...',
            renderOptionAttr: 'item_type',
        });

        initSelectizeWithCache({
            selector: $newRow.find('.checkEditItemCustomerRow'),
            url: `${window.origin}/accounting/v2/check/getPayeeDetails/customer`,
            valueField: 'id',
            labelField: 'payee_name',
            searchField: 'payee_name',
            optgroupField: 'payee_type',
            placeholder: 'Select Customer...',
            renderOptionAttr: 'payee_type',
        });
    });

    $('.accordion').on('click', '.checkEditClearItemLine', function() {
        let $tbody = $(this).closest('.accordion-body').find('table tbody');
        Swal.fire({
            icon: 'warning',
            title: 'Clear Lines',
            text: 'Are you sure you want to clear all lines?',
            showCancelButton: true,
            confirmButtonText: 'Proceed',
        }).then((result) => {
            if (result.isConfirmed) {
                const $newRow = $(getCheckEditItemRowHtml());
                $tbody.html($newRow);

                initSelectizeWithCache({
                    selector: $newRow.find('.checkEditItemOptionsRow'),
                    url: `${window.origin}/accounting/v2/check/getItemDetails/all`,
                    valueField: 'id',
                    labelField: 'item_name',
                    searchField: 'item_name',
                    optgroupField: 'item_type',
                    placeholder: 'Select Product/Service...',
                    renderOptionAttr: 'item_type',
                });

                initSelectizeWithCache({
                    selector: $newRow.find('.checkEditItemCustomerRow'),
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

    $('.accordion').on('click', '.checkEditDeleteLine', function() {
        let $tbody = $(this).closest('tbody');
        if ($tbody.find('tr').length > 1) {
            $(this).closest('tr').remove();
        }
    });

    $(document).on('change', '.checkEditItemOptionsRow', function() {
        const $row = $(this).closest('tr');
        const selectize = $(this)[0].selectize;
        const selectedId = selectize.getValue();
        const selectedData = selectize.options[selectedId];
        const price = parseFloat(selectedData.item_price) || 0;
        const qty = 1;
        const amount = qty * price;

        $row.find('.checkEditItemQtyRow').val(qty);
        $row.find('.checkEditItemRateRow').val(price.toFixed(2));
        $row.find('.checkEditItemAmountRow').val(amount.toFixed(2));
    });

    $(document).on('input', '.checkEditItemQtyRow', function() {
        const $row = $(this).closest('tr');
        const qty = parseFloat($(this).val()) || 0;
        const rate = parseFloat($row.find('.checkEditItemRateRow').val()) || 0;
        const amount = qty * rate;

        $row.find('.checkEditItemAmountRow').val(amount.toFixed(2));
    });

    $(document).on('input', '.checkEditItemRateRow', function() {
        const $row = $(this).closest('tr');
        const qty = parseFloat($row.find('.checkEditItemQtyRow').val()) || 0;
        const rate = parseFloat($(this).val()) || 0;
        const amount = qty * rate;

        $row.find('.checkEditItemAmountRow').val(amount.toFixed(2));
    });

    initSelectizeWithCache({
        selector: '.checkEditCategorySearch',
        url: `${window.origin}/accounting/v2/check/getAccountDetails/all`,
        valueField: 'text',
        labelField: 'text',
        searchField: 'text',
        optgroupField: 'optgroup',
        placeholder: 'Search Category...',
        renderOptionAttr: 'balance',
    });

    $(document).ready(function() {
        recentEditCheckTable = $('.recentEditCheckTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": {
                "url": `${window.origin}/accounting_controllers/v2/check/getRecentChecksServerside/recentEditTable`,
                "type": "POST",
            },
            "language": {
                "infoFiltered": "",
                // "processing": "<div class='custom-loader'><p>Processing, please wait...</p></div>",
            },
        }).on('draw', function() {
            $('.recentEditCheckAll').prop('checked', false);
            $('#recentEditEntryCheckbox').attr('disabled', 'disabled');
        });

        $('.recentEditCheckTableSearch').keyup(function() {
            recentEditCheckTable.search($(this).val()).draw(false);
        });

        $(document).on('change', '.checkEditCategorySearch', function() {
            recentEditCheckTable.search($(this).val()).draw(false);

        });
    });

    FilePond.registerPlugin(
        FilePondPluginFileEncode,
        FilePondPluginFileValidateType,
        FilePondPluginImagePreview,
        FilePondPluginGetFile,
    );

    FilePond.registerPlugin();

    FilePond.setOptions({
        dropOnPage: true,
        dropOnElement: true
    });

    document.querySelectorAll('.checkEditAttachments').forEach(el => {
        FilePond.create(el, {
            credits: false,
            allowFilePoster: false,
            allowImageEditor: false,
        });
    });

    $(document).on('input change', '.checkEditCategoryAmountRow, .checkEditItemQtyRow, .checkEditItemRateRow, .checkEditItemAmountRow', function() {
        $('.checkEditTotalAmountValueLabel').text(
            new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD'
            })
            .format($('.checkEditCategoryAmountRow, .checkEditItemAmountRow').toArray().reduce((t, el) => t + (parseFloat($(el).val()) || 0), 0))
        );
    });

    ['.checkEditCategoryTable tbody', '.checkEditItemTable tbody'].forEach(selector => {
        const targetNode = document.querySelector(selector);
        if (targetNode) {
            new MutationObserver(() => {
                $('.checkEditTotalAmountValueLabel').text(
                    new Intl.NumberFormat('en-US', {
                        style: 'currency',
                        currency: 'USD'
                    })
                    .format($('.checkEditCategoryAmountRow, .checkEditItemAmountRow').toArray().reduce((t, el) => t + (parseFloat($(el).val()) || 0), 0))
                );
            }).observe(targetNode, {
                childList: true,
                subtree: true
            });
        }
    });

    $('.checkEditForm').on('submit', function (e) {
        e.preventDefault();
        const checkEditForm = $(this);
        let checkEditFormData = new FormData(this);
        
        const pond = FilePond.find(document.querySelector('.checkEditAttachments'));
        if (pond && pond.getFiles().length > 0) {
            pond.getFiles().forEach((fileItem, index) => {
                if (fileItem.file) {
                    checkEditFormData.append(`checkEditAttachments[]`, fileItem.file);
                }
            });
        }

        checkEditFormData.append('check_id', $('.checkEditID').val());

        $.ajax({
            type: "POST",
            url: `${window.origin}/accounting/v2/check/editCheck`,
            data: checkEditFormData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                formDisabler(checkEditForm, true);
            },
            success: function (response) {
                if (response == 1 || (typeof response === 'object' && response.status === 'success')) {
                    Swal.fire({
                        icon: "success",
                        title: "Entry Updated!",
                        html: "Check has been updated successfully.",
                        showConfirmButton: true,
                        confirmButtonText: "Okay",
                    }).then((result) => {
                        try {
                            checkTable.draw(false);
                            recentAddCheckTable.draw(false);
                            recentEditCheckTable.draw(false);
                        } catch (error) {}
                        $('.checkEditNotificationDot').show();
                    });
                } else if (typeof response === 'object' && response.status === 'partial') {
                    Swal.fire({
                        icon: "warning",
                        title: "Partial Success!",
                        html: response.message + "<br><br>Errors: " + response.errors.join(', '),
                        showConfirmButton: true,
                        confirmButtonText: "Okay",
                    });
                } else {
                    let errorMessage = "An error occurred while updating the entry.";
                    if (typeof response === 'object' && response.message) {
                        errorMessage = response.message;
                    }
                    Swal.fire({
                        icon: "error",
                        title: "Update Failed!",
                        html: errorMessage,
                        showConfirmButton: true,
                        confirmButtonText: "Okay",
                    });
                }

                formDisabler($('.virtualCheckEditForm'), false);
                formDisabler(checkEditForm, false);
            },
            error: function (xhr, status, error) {
                formDisabler($('.virtualCheckEditForm'), false);
                Swal.fire({
                    icon: "error",
                    title: "Network Error!",
                    html: "An unexpected error occurred. Please try again!",
                    showConfirmButton: true,
                    confirmButtonText: "Okay",
                });
            },
        });
    });

    $('#virtualCheckEditPrintLater').on('change', function() {
        const value = $(this).prop('checked');
        if (value) {
            $('.checkEditPrintLater').prop('checked', true).change();
            $('#virtualCheckEditNumberInput').val(null).prop('disabled', true);
        } else {
            $('.checkEditPrintLater').prop('checked', false).change();
            $('#virtualCheckEditNumberInput').prop('disabled', false);
            const checkEditNo = $('.checkEditNo').val();
            $('#virtualCheckEditNumberInput').val(checkEditNo).change();
        }
    });

    $('#virtualCheckEditNumberInput').on('input change', function() {
        const value = $(this).val();
        $('.checkEditNo').val(value).change();
    });

    $(document).on('change', '.virtualCheckEditPayeeSelect', function() {
        const selectize = $(this)[0].selectize;
        const id = selectize.getValue();
        const data = selectize.options[id];
        $(".checkEditPayee")[0].selectize.setValue(id);
        $('.checkEditPayeeType').val(data.payee_type).change();
    });

    $(document).on('change', '.virtualCheckEditBankNameSelect', function() {
        const selectize = $(this)[0].selectize;
        const id = selectize.getValue();
        const data = selectize.options[id];
        $('.checkEditBankAccount')[0].selectize.setValue(data.value);
    });

    $(document).on('change', '#virtualCheckEditDateInput', function() {
        const value = $(this).val();
        $('.checkEditPaymentDate').val(value).change();
    });

    $('#virtualCheckEditMemoInput').on('input change', function() {
        const value = $(this).val();
        $('.checkEditMemo').val(value).change();
    });

    $(document).on('change', '.virtualCheckEditCategorySelect', function() {
        const selectize = $(this)[0].selectize;
        const id = selectize.getValue();
        const data = selectize.options[id];
        $('.checkEditCategoryOptionsRow').eq(0)[0].selectize.setValue(data.value);
    });

    $('#virtualCheckEditAmountInput').on('input change', function() {
        const rawValue = $(this).val().trim();
        const value = parseFloat(rawValue);

        if (!isNaN(value)) {
            window.totalAmountInVirtualCheck = value;
            const writtenAmount = virtualNumberToWords(value);
            $('#virtualCheckEditWrittenText').text(writtenAmount);
            $('.checkEditCategoryAmountRow').eq(0).val(value).change();
        } else {
            window.totalAmountInVirtualCheck = 0;
            $('#virtualCheckEditWrittenText').text("{WRITTEN_AMOUNT}");
            $('.checkEditCategoryAmountRow').eq(0).val('').change();
        }
    });

    $(document).on('click', '#checkEditVirtualTab', function() {
        const checkEditPrintLater = $('.checkEditPrintLater').prop('checked');
        const checkEditNo = $('.checkEditNo').val();
        const checkEditNoMinimum = $('.checkEditNo').attr('min');
        const checkEditPayee = $('.checkEditPayee').val();
        const checkEditBankAccount = $('.checkEditBankAccount').val();
        const checkEditPaymentDate = $('.checkEditPaymentDate').val();
        const checkEditMemo = $('.checkEditMemo').val();
        const checkEditCategoryOptionsRow = $('.checkEditCategoryOptionsRow').eq(0).val();
        const checkEditCategoryAmountRow = $('.checkEditCategoryAmountRow').eq(0).val();

        if (checkEditPrintLater) {
            $('#virtualCheckEditPrintLater').prop('checked', true);
            $('#virtualCheckEditNumberInput').val(null).attr('min', checkEditNoMinimum).prop('disabled', true);
        } else {
            $('#virtualCheckEditNumberInput').prop('disabled', false).attr('min', checkEditNo).val(checkEditNo);
            $('#virtualCheckEditPrintLater').prop('checked', false);
        }

        $(".virtualCheckEditPayeeSelect")[0].selectize.setValue(checkEditPayee);
        $(".virtualCheckEditBankNameSelect")[0].selectize.setValue(checkEditBankAccount);
        $('#virtualCheckEditDateInput').val(checkEditPaymentDate);
        $('#virtualCheckEditMemoInput').val(checkEditMemo);
        $(".virtualCheckEditCategorySelect")[0].selectize.setValue(checkEditCategoryOptionsRow);
        $('#virtualCheckEditAmountInput').val(checkEditCategoryAmountRow).change();
    });

    $(document).on('submit', '.virtualCheckEditForm', function(e) {
        e.preventDefault();
        const virtualCheckEditForm = $(this);
        $('.checkEditForm').submit();
    });

    initSelectizeWithCache({
        selector: '.virtualCheckEditPayeeSelect',
        url: `${window.origin}/accounting/v2/check/getPayeeDetails/all`,
        valueField: 'id',
        labelField: 'payee_name',
        searchField: 'payee_name',
        optgroupField: 'payee_type',
        placeholder: 'Select Customer...',
        renderOptionAttr: 'payee_type',
    });

    initSelectizeWithCache({
        selector: '.virtualCheckEditBankNameSelect',
        url: `${window.origin}/accounting/v2/check/getAccountDetails/Bank`,
        valueField: 'value',
        labelField: 'text',
        searchField: 'text',
        optgroupField: 'optgroup',
        placeholder: 'Select Bank Account...',
        renderOptionAttr: 'balance',
    });

    initSelectizeWithCache({
        selector: '.virtualCheckEditCategorySelect',
        url: `${window.origin}/accounting/v2/check/getAccountDetails/all`,
        valueField: 'value',
        labelField: 'text',
        searchField: 'text',
        optgroupField: 'optgroup',
        placeholder: 'Select Category...',
        renderOptionAttr: 'balance',
    });

    $(document).on('click', '.recentEditCheckAll', function() {
        let isChecked = $(this).is(':checked');
        $('.recentEditEntryCheckbox').prop('checked', isChecked).trigger('change');
    });

    $(document).on('change', '.recentEditEntryCheckbox', function() {
        const total = $('.recentEditEntryCheckbox').length;
        const checked = $('.recentEditEntryCheckbox:checked').length;

        if (checked === 0) {
            $('.recentEditCheckAll').prop('checked', false);
        }

        if (checked === total) {
            $('.recentEditCheckAll').prop('checked', true);
        }

        if (checked > 0) {
            $('.recentEditCheckPrint').removeAttr('disabled');
        } else {
            $('.recentEditCheckPrint').attr('disabled', 'disabled');
        }
    });

    $(document).on('click', '.recentEditCheckPrint', function () {
        let ids = getSelectedCheckIds("recent_check_edit_table");

        const pdfSettings = {
            margin: [0, 0, 0, 0],
            html2canvas: { scale: 2 },
            jsPDF: {
                unit: 'in',
                format: [8.5, 11],
                orientation: 'portrait'
            }
        };

        $.ajax({
            url: `${window.origin}/accounting/v2/check/getCheckDetailsForPrint`,
            type: 'POST',
            data: { check_id: ids },
            dataType: 'json',
            beforeSend: function () {
                Swal.fire({
                    icon: "info",
                    title: `Generating ${ids.length} Check to Print`,
                    html: "Please wait while the process is running...",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => Swal.showLoading(),
                });
            },
            success: function (response) {
                let standardHtml = '';
                let voucherHtml = '';

                for (let i = 0; i < response.length; i += 3) {
                    standardHtml += `<div class="standardPageContainer">`;
                    for (let j = 0; j < 3 && i + j < response.length; j++) {
                        standardHtml += buildStandardCheckHtml(response[i + j], j);
                    }
                    standardHtml += `</div>`;
                }

                response.forEach((check) => {
                    voucherHtml += buildVoucherCheckHtml(check);
                });

                const standardEl = document.createElement('div');
                standardEl.innerHTML = standardHtml;

                const voucherEl = document.createElement('div');
                voucherEl.innerHTML = voucherHtml;

                Promise.all([
                    html2pdf().from(standardEl).set(pdfSettings).outputPdf('blob'),
                    html2pdf().from(voucherEl).set(pdfSettings).outputPdf('blob')
                ]).then(([standardBlob, voucherBlob]) => {
                    const standardUrl = URL.createObjectURL(standardBlob);
                    const voucherUrl = URL.createObjectURL(voucherBlob);

                    $('.standardCheckPreview').attr('src', standardUrl);
                    $('.voucherPrintPreview').attr('src', voucherUrl);

                    $('.saveCheckPdf').data('standardBlob', standardBlob);
                    $('.saveCheckPdf').data('voucherBlob', voucherBlob);
                    $('.saveCheckPdf').data('standardFilename', 'check-standard.pdf');
                    $('.saveCheckPdf').data('voucherFilename', 'check-voucher.pdf');

                    $('.checkPrintModal').modal('show');
                    Swal.close();
                });

            },
            error: function () {
                Swal.fire({
                    icon: "error",
                    title: "Network Error!",
                    html: "An unexpected error occurred. Please try again!",
                    showConfirmButton: true,
                    confirmButtonText: "Okay",
                });
            },
        });
    });
</script>

    