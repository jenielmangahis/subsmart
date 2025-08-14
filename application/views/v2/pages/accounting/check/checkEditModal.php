<?php include viewPath('v2/pages/accounting/check/checkModal.css'); ?>
<?php include viewPath('v2/pages/accounting/check/checkModal.js'); ?>
<?php 
$id              = $check_data->id;
$company_id      = $check_data->company_id;
$payee_type      = $check_data->payee_type;
$payee_id        = $check_data->payee_id;
$bank_account_id = $check_data->bank_account_id;
$mailing_address = $check_data->mailing_address;
$payment_date    = $check_data->payment_date;
$check_no        = $check_data->check_no;
$to_print        = ($check_data->to_print == 1) ? true : false;
$permit_no       = $check_data->permit_no;
$tags            = $check_data->tags;
$memo            = $check_data->memo;
$total_amount    = $check_data->total_amount;
$recurring       = $check_data->recurring;
$status          = $check_data->status;
$created_at      = $check_data->created_at;
$updated_at      = $check_data->updated_at;
$last_check_no   = $check_data->last_check_no;
?>

<div class="container">
    <div class="row checkEditModalContent">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-9 position-relative">
                    <h4 class="fw-bold">Edit Check&ensp;<small class="text-muted fw-normal checkEditSequenceLabel"></small></h4>
                    <p>Edit the details of an existing check.</p> 
                    <span class="badge bg-danger position-absolute checkEditBadge">THIS CHECK IS VOIDED!</span>
                </div>
                <div class="col-lg-3">
                    <div class="float-end">
                        <span class="checkEditTotalAmountLabel fs-5">Total Amount</span>
                        <h3 class="checkEditTotalAmountValueLabel">$0.00</h4>
                    </div>   
                </div>
            </div>
            <button class="border-0 rounded mx-1 modalExitButton" data-bs-dismiss="modal"><i class="fas fa-times m-0 text-muted"></i></button>
        </div>
        <div class="col-lg-12">
            <ul class="nav nav-pills mb-3" id="checkEditTemplateStyleTab" role="tablist">
                <li class="nav-item historyNavItem" role="presentation">
                    <button class="btn btn-light position-relative checkEditHistory" data-bs-toggle="offcanvas" data-bs-target="#checkEditRecentTransactionsOffCanvas" aria-controls="checkEditRecentTransactionsOffCanvas" type="button">
                        <i class="fas fa-history text-muted"></i>
                        <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle checkEditNotificationDot"></span>
                    </button>
                </li>
                <div class="vr navPillSepator"></div>
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="checkEditStandardTab" data-bs-toggle="pill" data-bs-target="#checkEditStandardPill" type="button" role="tab" aria-controls="checkEditStandardPill" aria-selected="true">Standard</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="checkEditVirtualTab" data-bs-toggle="pill" data-bs-target="#checkEditVirtualPill" type="button" role="tab" aria-controls="checkEditVirtualPill" aria-selected="false">Virtual</button>
                </li>
            </ul>
                <div class="tab-content" id="checkEditTemplateStyleTabContent">
                    <div class="tab-pane fade show active" id="checkEditStandardPill" role="tabpanel" aria-labelledby="checkEditStandardTab">
                        <form class="checkEditForm">
                            <div class="row">
                                <div class="col-lg-3 mb-3">
                                    <label class="form-label fw-xnormal">Check No.</label>
                                    <label class="text-muted float-end highlightTextDisable"><input class="form-check-input checkEditPrintLater" type="checkbox">&ensp;Print Later</label>
                                    <input type="number" class="form-control checkEditNo" value="0000" min="0" required>
                                </div>
                                <div class="col-lg-2 mb-3">
                                    <label class="form-label fw-xnormal">Permit No.</label>
                                    <input type="number" class="form-control checkEditPermitNo" value="0000" min="0" required>
                                </div>
                                <div class="col-lg-3 mb-3">
                                    <label class="form-label fw-xnormal">Payee</label>
                                    <a class="text-decoration-none float-end checkEditViewPayeeInfo" href="javascript:void(0);">View Info</a>
                                    <select class="form-select checkEditPayee" required></select>
                                    <input class="checkEditPayeeType" type="hidden">
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label class="form-label fw-xnormal">Bank Account</label>&ensp;<span class="text-muted checkEditBankAccountBalance">$0.00</span>
                                    <label class="text-muted float-end highlightTextDisable"></label>
                                    <select class="form-select checkEditBankAccount" required></select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 mb-3">
                                    <label class="form-label fw-xnormal">Payment Date</label>
                                    <input type="date" class="form-control checkEditPaymentDate" value="<?php echo date('Y-m-d'); ?>" required>
                                </div>
                                <div class="col-lg-10 mb-3">
                                    <label class="form-label fw-xnormal">Tags</label>
                                    <select class="form-select checkEditTag" required></select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label fw-xnormal">Mailing Address</label>
                                    <textarea class=" form-control checkEditMailingAddress" placeholder="Payee's Mailing Address..." required></textarea>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label fw-xnormal">Memo</label>
                                    <textarea class=" form-control checkEditMemo" placeholder="Check's memo..."></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <div class="accordion">
                                        <div class="accordion-item border-0">
                                            <h2 class="accordion-header" id="checkEditCategoryDetails_panel">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#checkEditCategoryDetails_collapse" aria-expanded="true" aria-controls="checkEditCategoryDetails_collapse"> 
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
                                                                        <td><select class="form-select checkEditCategoryOptionsRow" required></select></td> 
                                                                        <td><input type="text" class="form-control checkEditCategoryDescriptionRow"></td> 
                                                                        <td><input type="number" class="form-control checkEditCategoryAmountRow" step="any" required></td> 
                                                                        <td class="text-center"><input type="checkbox" class="form-check-input checkEditCategoryBillableRow"></td> 
                                                                        <td class="text-center"><input type="checkbox" class="form-check-input checkEditCategoryTaxRow"></td> 
                                                                        <td><select class="form-select checkEditCategoryCustomerRow" required></select></td> 
                                                                        <td><button class="border-0 checkEditDeleteLine"><i class="fas fa-minus text-danger"></i></button></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="input-group">
                                                                <button class="btn btn-primary checkEditCategoryLine" type="button">Add</button>
                                                                <button class="btn btn-light checkEditClearCategoryLine" type="button">Clear</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item border-0">
                                            <h2 class="accordion-header" id="checkEditItemDetails_panel">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#checkEditItemDetails_collapse" aria-expanded="true" aria-controls="checkEditItemDetails_collapse">
                                                    <strong>ITEM DETAILS</strong>
                                                </button>
                                            </h2>
                                            <div id="checkEditItemDetails_collapse" class="accordion-collapse collapse " aria-labelledby="checkEditItemDetails_panel">
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
                                                                        <td><select class="form-select checkEditItemOptionsRow"></select></td> 
                                                                        <td><input type="text" class="form-control checkEditItemDescriptionRow"></td>
                                                                        <td><input type="number" class="form-control checkEditItemQtyRow"></td>
                                                                        <td><input type="number" class="form-control checkEditItemRateRow" step="any"></td>
                                                                        <td><input type="number" class="form-control checkEditItemAmountRow" step="any"></td>
                                                                        <td class="text-center"><input type="checkbox" class="form-check-input checkEditItemBillableRow"></td>
                                                                        <td class="text-center"><input type="checkbox" class="form-check-input checkEditItemTaxRow"></td>
                                                                        <td><select class="form-select checkEditItemCustomerRow"></select></td>
                                                                        <td><button class="border-0 checkEditDeleteLine"><i class="fas fa-minus text-danger"></i></button></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="input-group">
                                                                <button class="btn btn-primary checkEditItemLine" type="button">Add</button>
                                                                <button class="btn btn-light checkEditClearItemLine" type="button">Clear</button>
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
                                    <input type="file" class="form-control checkEditAttachments" multiple>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary fw-bold float-end">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="checkEditVirtualPill" role="tabpanel" aria-labelledby="checkEditVirtualTab">
                        <p>Use the virtual check template here.</p>
                    </div>
                </div>
        </div>
    </div>
</div>
<div class="offcanvas offcanvas-start" tabindex="-1" id="checkEditRecentTransactionsOffCanvas" aria-labelledby="checkEditRecentTransactionsOffCanvasLabel">
    <div class="offcanvas-header">
        <h4 class="offcanvas-title fw-bold" id="checkEditRecentTransactionsOffCanvasLabel">Recent Transactions</h4>
        <button class="border-0 rounded mx-1" data-bs-dismiss="offcanvas"><i class="fas fa-times m-0 text-muted"></i></button>
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
                    <input class="form-control recentEditCheckTableSearch" type="text" placeholder="Search...">
                    <select class="form-select checkEditCategorySearch"></select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-hover recentEditCheckTable w-100">
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
    var recentEditCheckTable;

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
        let $newRow = $(getCategoryRowHtml());
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
                const $newRow = $(getCategoryRowHtml());
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
        let $newRow = $(getItemRowHtml());
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
                const $newRow = $(getItemRowHtml());
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
                "url": `${window.origin}/accounting_controllers/v2/check/getRecentChecksServerside`,
                "type": "POST",
            },
            "language": {
                "infoFiltered": "",
                // "processing": "<div class='custom-loader'><p>Processing, please wait...</p></div>",
            },
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
        FilePondPluginImagePreview
    );

    FilePond.setOptions({
        dropOnPage: true,
        dropOnElement: true
    });

    document.querySelectorAll('.checkEditAttachments').forEach(el => {
        FilePond.create(el, {
            credits: false,
            allowFilePoster: false,
            allowImageEditor: false
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

        $.ajax({
            type: "POST",
            url: `${window.origin}/accounting/v2/check/addCheck`,
            data: {
                payee_id: $('.checkEditPayee').val(),
                payee_type: $('.checkEditPayeeType').val(),
                bank_account_id: $('.checkEditBankAccount').val(),
                mailing_address: $('.checkEditMailingAddress').val(),
                payment_date: $('.checkEditPaymentDate').val(),
                check_no: $('.checkEditNo').val(),
                to_print: $('.checkEditPrintLater').is(':checked') ? 1 : 0,
                permit_no: $('.checkEditPermitNo').val(),
                tags: $('.checkEditTag').val(),
                memo: $('.checkEditMemo').val(),
                total_amount: $('.checkEditCategoryAmountRow, .checkEditItemAmountRow').toArray().reduce((t, el) => t + (parseFloat($(el).val()) || 0), 0)
            },
            beforeSend: function() {
                Swal.fire({
                    icon: "info",
                    title: "Adding Entry!",
                    html: "Please wait while the uploading process is running...",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                });
            },
            success: function(response) {
                if (response == 1) {
                    Swal.fire({
                        icon: "success",
                        title: "Entry Saved!",
                        html: "Check has been added successfully.",
                        showConfirmButton: true,
                        confirmButtonText: "Okay",
                    });
                    try {
                        recentAddCheckTable.draw(false);
                        recentEditCheckTable.draw(false);
                        checkTable.draw(false);
                    } catch (error) {}
                    $('.checkEditNotificationDot').show();
                    checkEditResetForm();
                    setLastSettings();
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
            error: function(xhr, status, error) {
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
</script>

<script>
    function fillForm() {
        if (!$(".checkEditPayee")[0]?.selectize || 
            !$(".checkEditBankAccount")[0]?.selectize || 
            !$(".checkEditTag")[0]?.selectize) {
            return setTimeout(fillForm, 50);
        }

        var check_no        = "<?php echo $check_no; ?>";
        var permit_no       = "<?php echo $permit_no; ?>";
        var payee_id        = "<?php echo $payee_id; ?>";
        var payee_type      = "<?php echo $payee_type; ?>";
        var bank_account_id = "<?php echo $bank_account_id; ?>";
        var payment_date    = "<?php echo $payment_date; ?>";
        var tags            = "<?php echo $tags; ?>";
        var mailing_address = `<?php echo $mailing_address; ?>`;
        var memo            = `<?php echo $memo; ?>`;
        var to_print        = "<?php echo $to_print; ?>";

        $(".checkEditPrintLater").prop("checked", to_print == 1).change();
        $('.checkEditNo').attr('min', check_no).val(check_no).change();
        $('.checkEditPermitNo').attr('min', permit_no).val(permit_no).change();
        $(".checkEditPayee")[0].selectize.setValue(payee_id);
        $(".checkEditPayeeType").val(payee_type).change();
        $(".checkEditBankAccount")[0].selectize.setValue(bank_account_id);
        $(".checkEditPaymentDate").val(payment_date).change();
        $(".checkEditTag")[0].selectize.setValue(tags.split(','));
        $(".checkEditMailingAddress").val(mailing_address).change();
        $(".checkEditMemo").val(memo).change();
        $('.checkEditContentLoader').remove();
        $('.checkEditModalContent').fadeIn('fast');
    };
    fillForm();
</script>
