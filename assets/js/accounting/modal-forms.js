const GET_OTHER_MODAL_URL = "/accounting/get-other-modals/";
const vendorModals = ['#expenseModal', '#checkModal', '#billModal', '#vendorCreditModal', '#purchaseOrderModal', '#creditCardCreditModal'];
const customerModals = ['#invoiceModal', '#creditMemoModal', '#salesReceiptModal', '#refundReceiptModal', '#delayedCreditModal', '#delayedChargeModal'];
var rowCount = 0;
var rowInputs = '';
var blankRow = '';
var modalName = '';
var tagsListModal = '';
var timesheetInputs = 'input.day-input';
var payrollForm = '';
var payrollFormData = [];
const noRecordMessage = '<div class="no-results text-center p-4">No customers found for the applied filters.</div>'
var recurrInterval = '';
var recurringDays = '';
var monthlyRecurrFields = '';
var payroll = {};

var modalAttachmentId = [];
var modalAttachedFiles = [];

var vendAttIds = [];
var vendAttFiles = [];

var custAttIds = [];
var custAttFiles = [];

var catDetailsInputs = '';
var catDetailsBlank = '';

var itemTypeSelection = '';

var submitType = 'save-and-close';

var dropdownEl = null;
var modalAttachments = null;
var receivedAmountIsChanged = false;

const formatter = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD'
});

const dropdownFields = [
    'customer',
    'employee',
    'vendor',
    'pay-bills-vendor',
    'payee',
    'received-from',
    'payment-method',
    'names',
    'term',
    'person-tracking',
    'expense-account',
    'expense-payment-account',
    'bank-account',
    'payment-account',
    'bank-credit-account',
    'bank-deposit-account',
    'cash-back-account',
    'funds-account',
    'transfer-account',
    'journal-entry-accounts',
    'inventory-adj-account',
    'credit-card-account',
    'service',
    'product',
    'category',
    'inv-asset-account',
    'income-account',
    'item-expense-account',
    'sales-tax-category',
    'deposit-to-account',
    'refund-from-account'
];
const days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

$(function() {
    $(document).on('change', '#adjust-starting-value-modal #location', function() {
        var selected = $(this).children('option:selected');
        var initial_qty = selected[0].dataset.initial_qty;

        $('#adjust-starting-value-modal #initialQty').val(initial_qty);

        computeTotalValue();
    });

    $(document).on('change', '#adjust-starting-value-modal #initialQty, #adjust-starting-value-modal #initialCost', function() {
        computeTotalValue();
    });

    $(document).on('change', '#adjust-starting-value-modal #refNo', function() {
        var value = $(this).val();

        if (value !== "") {
            $('#adjust-starting-value-modal .modal-title span').html('#' + value);
        } else {
            $('#adjust-starting-value-modal .modal-title span').html('');
        }
    });

    $(document).on('keyup', timesheetInputs + ', div#singleTimeModal input#time', function(e) {
        var el = $(this);
        var charLimit = el.val().length;
        var regex = el.val().match("^([0-1][0-9]|[2][0-3])(:|)([0-5][0-9])$");
        var textRegex = el.val().match("^[^a-zA-Z]*$");

        if (charLimit > 5 || regex === null && textRegex === null) {
            el.addClass('border-danger');
        } else {
            el.removeClass('border-danger');
        }
    });

    $(document).on('change', timesheetInputs + ', div#singleTimeModal input#time', function(e) {
        var elVal = $(this).val().trim();
        var split = elVal.search(':') >= 0 ? elVal.split(':') : (elVal.includes('.') && !elVal.includes(':') ? elVal.split('.') : elVal);
        var split1 = "00";
        var split2 = "00";
        var textRegex = elVal.match("^[^a-zA-Z]*$");

        if (typeof split === "object" && split !== null) {
            split1 = split[0].length == 0 ? "00" : (split[0].length == 1 ? "0" + split[0] : split[0]);

            if (split[1].length > 0 && elVal.includes('.')) {
                var num = split[1].length === 1 ? parseInt(split[1] + "0") : parseInt(split[1]);

                var mins = parseInt(num * 60 / 100).toString();

                split2 = mins.length === 1 ? "0" + mins : mins;
            } else {
                split2 = split[1].length == 1 ? "0" + split[1] : (split[1].length == 0 ? "00" : split[1]);
            }
        } else if (split !== "" && elVal.length <= 2) {
            split1 = split.length == 1 ? "0" + split : split;
        }

        if (textRegex !== null) {
            $(this).val(split1 + ":" + split2);
        }

        if ($(this).attr('id') !== 'time') {
            computeTotalHours();
            computeTotalBill();
        }
    });

    $(document).on('change', '#payDownCreditModal input#amount', function() {
        var amount = $(this).val();

        if (amount !== "") {
            $('#payDownCreditModal #total-amount-paid').html(`$${amount}`);
        } else {
            $('#payDownCreditModal #total-amount-paid').html('$0.00');
        }
    });

    $(document).on('change', '#payrollModal table#payroll-table tbody tr td:nth-child(4) input[name="reg_pay_hours[]"], #payrollModal table#payroll-table tbody tr td:nth-child(5) input:not([name="memo[]"])', function() {
        payrollRowTotal($(this));
        payrollTotal();
    });

    $(document).on('click', 'div#payrollModal div.modal-footer button#continue-payroll', function() {
        payroll.paySchedule = $('#payrollModal [name="pay_schedule"]:checked').val();
        payroll.paySchedForm = $('div#payrollModal div.modal-body .card-body').html();
        var paySchedName = $('#payrollModal [name="pay_schedule"]:checked').next().find('.pay_sched_name').html();
        if (payroll.paySchedule !== "" && payroll.paySchedule !== undefined) {
            $.get('/accounting/get-payroll-form/' + payroll.paySchedule, function(res) {
                $('div#payrollModal .modal-body .card-body').html(res);

                $('div#payrollModal .modal-header .modal-title').html('Run Payroll: ' + paySchedName);
                $('div#payrollModal .modal-body .card-body select:not(#bank-account)').select2();
                $('div#payrollModal .modal-body .card-body select#bank-account').select2({
                    ajax: {
                        url: '/accounting/get-dropdown-choices',
                        dataType: 'json',
                        data: function(params) {
                            var query = {
                                search: params.term,
                                type: 'public',
                                field: 'bank-account'
                            }

                            // Query parameters will be ?search=[term]&type=public&field=[type]
                            return query;
                        }
                    },
                    templateResult: formatResult,
                    templateSelection: optionSelect
                });
                $('div#payrollModal .modal-body .card-body #payDate').datepicker({
                    uiLibrary: 'bootstrap'
                });

                payrollTotal();
            });
            $(this).parent().prepend(`
            <div class="btn-group dropup float-right">
                <button type="button" class="btn btn-success" id="preview-payroll">
                    Preview payroll
                </button>
                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Save for later</a>
                </div>
            </div>`);
            $(this).remove();
            $('div#payrollModal div.modal-footer button#close-payroll-modal').parent().html('<button type="button" class="btn btn-secondary btn-rounded border" id="back-paysched-select">Back</button>');
        }
    });

    $(document).on('click', 'div#payrollModal div.modal-footer button#back-paysched-select', function() {
        $('div#payrollModal div.modal-body .card-body').html(payroll.paySchedForm);
        $(`div#payrollModal div.modal-body .card-body input[name="pay_schedule"][value="${payroll.paySchedule}"]`).prop('checked', true);
        $(this).parent().html(`<button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal" id="close-payroll-modal">Close</button>`);
        $('div#payrollModal div.modal-footer div.col-md-4:last-child').html(`
        <button class="btn btn-success float-right" type="button" id="continue-payroll">
            Continue
        </button>`);
    });

    $(document).on('change', 'div#payrollModal select#payPeriod', function(e) {
        var selected = $(this).find('option:selected');
        var payDate = selected[0].dataset.pay_date;

        $('div#payrollModal input#payDate').val(payDate);
    });

    $(document).on('click', 'div#payrollModal div.modal-footer button#preview-payroll', function() {
        payrollForm = $('div#payrollModal div.modal-body').html();
        payrollFormData = new FormData(document.getElementById($('div#payrollModal').parent('form').attr('id')));

        $.ajax({
            url: '/accounting/generate-payroll',
            data: payrollFormData,
            type: 'post',
            processData: false,
            contentType: false,
            success: function(res) {
                $('div#payrollModal div.modal-body').html(res);

                var chartHeight = $('div#payrollModal div.modal-body div#payrollChart').parent().prev().height();
                var chartWidth = $('div#payrollModal div.modal-body div#payrollChart').parent().width();

                $('div#payrollModal div#payrollChart').height(chartHeight);
                $('div#payrollModal div#payrollChart').width(chartWidth);

                var payrollCost = $('div#payrollModal div.modal-body h1 span#total-payroll-cost').html();
                var totalNetPay = $('div#payrollModal div.modal-body h4 span#total-net-pay').html();
                var employeeTax = $('div#payrollModal div.modal-body h4 span#total-employee-tax').html();
                var employerTax = $('div#payrollModal div.modal-body h4 span#total-employer-tax').html();

                var netPayPercent = parseFloat((parseFloat(totalNetPay) / parseFloat(payrollCost)) * 100).toFixed(2);
                var employeeTaxPercent = parseFloat((parseFloat(employeeTax) / parseFloat(payrollCost)) * 100).toFixed(2);
                var employerTaxPercent = parseFloat((parseFloat(employerTax) / parseFloat(payrollCost)) * 100).toFixed(2);

                var Data = [
                    { label: "Net Pay", value: netPayPercent },
                    { label: "Employee", value: employeeTaxPercent },
                    { label: "Employer", value: employerTaxPercent }
                ];
                var total = 100;
                var donut_chart = Morris.Donut({
                    element: 'payrollChart',
                    data: Data,
                    resize: true,
                    formatter: function(value, data) {
                        return Math.floor(value / total * 100) + '%';
                    }
                });
            }
        });

        $(this).parent().prepend('<button type="submit" class="btn btn-success">Submit Payroll</button>');
        $(this).remove();
        $('div#payrollModal div.modal-footer button#close-payroll-modal').parent().html('<button type="button" class="btn btn-secondary btn-rounded border" id="back-payroll-form">Back</button>');
    });

    $(document).on('click', 'div#payrollModal div.modal-footer button#back-payroll-form', function() {
        $('div#payrollModal div.modal-body').html(payrollForm);

        $('div#payrollModal div.modal-body select#payFrom').val(payrollFormData.get('pay_from'));
        $('div#payrollModal div.modal-body select#payPeriod').val(payrollFormData.get('pay_period'));
        $('div#payrollModal div.modal-body input#payDate').val(payrollFormData.get('pay_date'));

        $('div#payrollModal div.modal-body table tbody tr').each(function() {
            if ($(this).children('td:nth-child(4)').children('input').length === 0) {
                $(this).children('td:first-child()').children('div').children('input').prop('checked', false)
            }
        });

        $('div#payrollModal div.modal-body table tbody tr td:nth-child(4) input[name="reg_pay_hours[]"]').each(function(index, value) {
            $(this).val(payrollFormData.getAll('reg_pay_hours[]')[index]);
        });

        $('div#payrollModal div.modal-body table tbody tr td:nth-child(5) input[name="commission[]"]').each(function(index, value) {
            $(this).val(payrollFormData.getAll('commission[]')[index]);
        });

        $('div#payrollModal div.modal-body table tbody tr td:nth-child(6) input[name="memo[]"]').each(function(index, value) {
            $(this).val(payrollFormData.getAll('memo[]')[index]);
        });

        $(this).parent().html('<button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal" id="close-payroll-modal">Close</button>');
        $('div#payrollModal div.modal-footer button[type="submit"]').html('Preview Payroll');
        $('div#payrollModal div.modal-footer button[type="submit"]').attr('id', 'preview-payroll');
        $('div#payrollModal div.modal-footer button[type="submit"]').prop('type', 'button');
    });

    $(document).on('change', 'div#statementModal table thead th input[name="select_all"], div#statementModal table thead th input[name="select_all"], div#payrollModal table thead th input[name="select_all"]', function() {
        var table = $(this).parent().parent().parent().parent().parent();
        var rows = table.children('tbody').children('tr');

        if ($(this).prop('checked')) {
            rows.each(function() {
                $(this).children('td:first-child()').children('div').children('input').prop('checked', true);

                if (table.attr('id') === 'payroll-table') {
                    $(this).children('td').each(function(index, value) {
                        if (index === 2) {
                            $(this).html('<a href="#" class="text-info">Paper check</a>');
                        } else if (index === 3) {
                            $(this).html('<input type="number" name="reg_pay_hours[]" step="0.01" class="form-control w-75 float-right text-right regular-pay-hours">');
                        } else if (index === 4) {
                            $(this).html('<input type="number" name="commission[]" step="0.01" class="form-control w-75 float-right text-right employee-commission">');
                        } else if (index === 5) {
                            $(this).html('<input type="text" name="memo[]" class="form-control">');
                        } else if (index === 6) {
                            $(this).html('<p class="text-right m-0">0.00</p>');
                        } else if (index === 7) {
                            $(this).html('<p class="text-right m-0">$<span class="total-pay">0.00</span></p>');
                        }
                    });
                }
            });
        } else {
            rows.each(function() {
                $(this).children('td:first-child()').children('div').children('input').prop('checked', false);

                if (table.attr('id') === 'payroll-table') {
                    $(this).children('td').each(function(index, value) {
                        if (index > 1) {
                            $(this).html('');
                        }
                    });
                }
            });
        }
    });

    $(document).on('change', 'div#statementModal table tbody tr td:first-child() input, div#payrollModal table tbody tr td:first-child() input', function() {
        var table = $(this).parent().parent().parent().parent().parent();
        var checkbox = table.children('thead').children('tr').children('th:first-child()').children('div').children('input');
        var rows = table.children('tbody').children('tr');
        var flag = true;

        if (table.attr('id') === 'payroll-table') {
            if ($(this).prop('checked') === false) {
                $(this).parent().parent().parent().children('td').each(function(index, value) {
                    if (index > 1) {
                        $(this).html('');
                    }
                });
            } else {
                $(this).parent().parent().parent().children('td').each(function(index, value) {
                    if (index === 2) {
                        $(this).html('<a href="#" class="text-info">Paper check</a>');
                    } else if (index === 3) {
                        $(this).html('<input type="number" name="reg_pay_hours[]" step="0.01" class="form-control w-75 float-right text-right regular-pay-hours">');
                    } else if (index === 4) {
                        $(this).html('<input type="number" name="commission[]" step="0.01" class="form-control w-75 float-right text-right employee-commission">');
                    } else if (index === 5) {
                        $(this).html('<input type="text" name="memo[]" class="form-control">');
                    } else if (index === 6) {
                        $(this).html('<p class="text-right m-0">0.00</p>');
                    } else if (index === 7) {
                        $(this).html('<p class="text-right m-0">$<span class="total-pay">0.00</span></p>');
                    }
                });
            }
        }

        rows.each(function() {
            if ($(this).children('td:first-child()').children('div').children('input').prop('checked') === false) {
                flag = false;
            }
        });

        checkbox.prop('checked', flag);
    });

    $(document).on('click', '#new-popup ul li a.ajax-modal', function(e) {
        e.preventDefault();
        var target = e.currentTarget.dataset;
        var view = target.view
        var modal_element = target.target;
        modalName = target.target;

        $.get(GET_OTHER_MODAL_URL + view, function(res) {
            if ($('div#modal-container').length > 0) {
                $('div#modal-container').html(res);
            } else {
                $('body').append(`
                    <div id="modal-container"> 
                        ${res}
                    </div>
                `);
            }

            $(`${modal_element} [data-toggle="popover"]`).popover();

            if ($('div#modal-container .modal-body table:not(#category-details-table, #item-details-table)').length > 0) {
                rowInputs = $('div#modal-container table tbody tr:first-child()').html();
                if(modal_element === '#journalEntryModal' || modal_element === '#depositModal') {
                    blankRow = $('div#modal-container table tbody tr:last-child()').html();

                    $('div#modal-container table.clickable tbody tr:first-child()').remove();
                    $('div#modal-container table tbody tr:last-child()').remove();
                } else {
                    blankRow = $('div#modal-container table tbody tr:nth-child(2)').html();
                }

                rowCount = $('div#modal-container table tbody tr').length;

                $('div#modal-container table.clickable tbody tr:first-child()').html(blankRow);
                $('div#modal-container table.clickable tbody tr:first-child() td:nth-child(2)').html(1);
            }

            if (vendorModals.includes(modal_element)) {
                rowCount = 2;
                catDetailsInputs = $(`${modal_element} .modal-body table#category-details-table tbody tr:first-child()`).html();
                catDetailsBlank = $(`${modal_element} .modal-body table#category-details-table tbody tr:last-child()`).html();

                $(`${modal_element} .modal-body table#category-details-table tbody tr:first-child()`).remove();
                $(`${modal_element} .modal-body table#category-details-table tbody tr:last-child()`).remove();
            }

            if (modal_element === '#printChecksModal') {
                loadChecksTable();
            }

            $(`${modal_element} select`).each(function() {
                var type = $(this).attr('id');
                if (type === undefined) {
                    type = $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-');
                } else {
                    type = type.replaceAll('_', '-');

                    if (type.includes('transfer')) {
                        type = 'transfer-account';
                    }
                }

                if (dropdownFields.includes(type)) {
                    $(this).select2({
                        ajax: {
                            url: '/accounting/get-dropdown-choices',
                            dataType: 'json',
                            data: function(params) {
                                var query = {
                                    search: params.term,
                                    type: 'public',
                                    field: type,
                                    modal: modal_element.replaceAll('#', '')
                                }

                                // Query parameters will be ?search=[term]&type=public&field=[type]
                                return query;
                            }
                        },
                        templateResult: formatResult,
                        templateSelection: optionSelect
                    });
                } else {
                    var options = $(this).find('option');
                    if (options.length > 10) {
                        $(this).select2();
                    } else {
                        $(this).select2({
                            minimumResultsForSearch: -1
                        });
                    }
                }
            });

            if ($('div#modal-container select#tags').length > 0) {
                $('div#modal-container select#tags').select2({
                    placeholder: 'Start typing to add a tag',
                    allowClear: true,
                    ajax: {
                        url: '/accounting/get-job-tags',
                        dataType: 'json'
                    }
                });
            }
            if (view === "weekly_timesheet_modal") {
                tableWeekDate(document.getElementById('weekDates'));
            }

            if ($(`${modal_element} .date`).length > 0) {
                $(`${modal_element} .date`).each(function() {
                    $(this).datepicker({
                        uiLibrary: 'bootstrap'
                    });
                });
            }

            if ($(`${modal_element} .attachments`).length > 0) {
                var attachmentContId = $(`${modal_element} .attachments .dropzone`).attr('id');
                modalAttachments = new Dropzone(`#${attachmentContId}`, {
                    url: '/accounting/attachments/attach',
                    maxFilesize: 20,
                    uploadMultiple: true,
                    // maxFiles: 1,
                    addRemoveLinks: true,
                    init: function() {
                        this.on("success", function(file, response) {
                            var ids = JSON.parse(response)['attachment_ids'];
                            var modal = $(`${modal_element}`);

                            for (i in ids) {
                                if (modal.find(`input[name="attachments[]"][value="${ids[i]}"]`).length === 0) {
                                    modal.find('.attachments').parent().append(`<input type="hidden" name="attachments[]" value="${ids[i]}">`);
                                }

                                modalAttachmentId.push(ids[i]);
                            }
                            modalAttachedFiles.push(file);
                        });
                    },
                    removedfile: function(file) {
                        var ids = modalAttachmentId;
                        var index = modalAttachedFiles.map(function(d, index) {
                            if (d == file) return index;
                        }).filter(isFinite)[0];

                        $(`${modal_element} .attachments`).parent().find(`input[name="attachments[]"][value="${ids[index]}"]`).remove();

                        if($('#modal-container form .modal .attachments-container').length > 0) {
                            $('#modal-container form .modal .attachments-container #attachment-types').trigger('change');
                        }

                        //remove thumbnail
                        var previewElement;
                        return (previewElement = file.previewElement) !== null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
                    }
                });
            }

            if ($(`${modal_element} .dropdown`).length > 0) {
                $(`${modal_element} .dropdown-menu`).on('click', function(e) {
                    e.stopPropagation();
                });
            }

            if (modal_element === '#payBillsModal') {
                loadBills();
            }

            // if(modal_element === '#receivePaymentModal') {

            // }

            $(modal_element).modal('show');
            $(document).off('shown', modal_element);
        });
    });

    $(document).on('hide.bs.modal', '#tags-modal', function(e) {
        if ($('div#modal-container').next('.modal-backdrop').length > 0 ||
            $('div#modal-container').next().next('.modal-backdrop').length > 0
        ) {
            $('div#modal-container').next('.modal-backdrop').remove();
            $('div#modal-container').next().next('.modal-backdrop').remove();
        }
    });

    $(document).on('change', 'div#billPaymentModal select[name="payment_account"]', function() {
        var value = $(this).val();

        $.get('/accounting/get-account-balance/' + value, function(res) {
            var result = JSON.parse(res);

            $('div#billPaymentModal span#account-balance').html(result.balance);
        });
    });

    $(document).on('change', 'div#depositModal select#bank_deposit_account', function() {
        var value = $(this).val();

        $.get('/accounting/get-account-balance/' + value, function(res) {
            var result = JSON.parse(res);

            $('div#depositModal span#account-balance').html(result.balance);
        });
    });

    $(document).on('change', 'div#transferModal #transfer_from_account, div#transferModal #transfer_to_account', function() {
        var el = $(this);
        var value = el.val();

        if (value !== '' && value !== null && value !== 'add-new') {
            $.get('/accounting/get-account-balance/' + value, function(res) {
                var result = JSON.parse(res);

                el.parent().parent().next().find('h3').html(result.balance);
            });
        } else {
            el.parent().parent().next().find('h3').html('');
        }
    });

    $(document).on('change', 'div#payrollModal select#bank-account', function() {
        var value = $(this).val();
        var el = $(this);

        $.get('/accounting/get-account-balance/' + value, function(res) {
            var result = JSON.parse(res);

            el.parent().parent().next().children('h6').html('Balance ' + result.balance);
        });
    });

    $(document).on('click', '#modal-container a#open-tags-modal', function(e) {
        e.preventDefault();
        var target = e.currentTarget.dataset;
        var modal_element = target.target;

        $.get('/accounting/get-job-tag-modal/', function(res) {
            if ($('#tags-modal').length > 0) {
                $('#tags-modal').remove();
            }

            if ($('div#modal-container').next('.modal-backdrop').length > 0 ||
                $('div#modal-container').next().next('.modal-backdrop').length > 0
            ) {
                $('div#modal-container').next('.modal-backdrop').remove();
                $('div#modal-container').next().next('.modal-backdrop').remove();
            }

            $('div#modal-container').append(res);
            tagsListModal = $('#tags-modal div.modal-dialog div#tags-list').html();
            if (!$.fn.dataTable.isDataTable('#tags-table')) {
                loadTagsDataTable();
            } else {
                $('#tags-table').DataTable().ajax.reload(null, true);
            }
            $(modal_element).modal('show');
        });
    });

    $(document).on('keyup', 'div#journalEntryModal input#journalNo', function() {
        if ($(this).val() !== "") {
            var val = $(this).val();
            $('div#journalEntryModal h4.modal-title span').html(`#${val}`);
        } else {
            $('div#journalEntryModal h4.modal-title span').html('');
        }
    });

    $(document).on('click', `div#modal-container .full-screen-modal .modal-body table.clickable:not(#category-details-table,#item-details-table,#previous-adjustments-table) tbody tr`, function() {
        if ($(this).find('input').length < 1) {
            var rowNum = $(this).children().next().html();

            $(this).html(rowInputs);
            $(this).children('td:nth-child(2)').html(rowNum);

            $(this).find('select').each(function() {
                var type = $(this).attr('id');
                if (type === undefined) {
                    type = $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-');
                } else {
                    type = type.replaceAll('_', '-');
                }

                if (dropdownFields.includes(type)) {
                    $(this).select2({
                        ajax: {
                            url: '/accounting/get-dropdown-choices',
                            dataType: 'json',
                            data: function(params) {
                                var query = {
                                    search: params.term,
                                    type: 'public',
                                    field: type
                                }

                                // Query parameters will be ?search=[term]&type=public&field=[type]
                                return query;
                            }
                        },
                        templateResult: formatResult,
                        templateSelection: optionSelect
                    });
                } else {
                    var options = $(this).find('option');
                    if (options.length > 10) {
                        $(this).select2();
                    } else {
                        $(this).select2({
                            minimumResultsForSearch: -1
                        });
                    }
                }
            });
        }
    });

    $(document).on('click', 'div#modal-container .modal-body table#category-details-table tbody tr', function() {
        if ($(this).find('input').length < 1) {
            var rowNum = $(this).children().next().html();

            $(this).html(catDetailsInputs);
            $(this).children('td:nth-child(2)').html(rowNum);

            if ($('#modal-container .modal-body #category-details-table thead tr th').length === 12) {
                $(`<td></td>`).insertBefore($('#modal-container .modal .modal-body table#category-details-table tbody tr:last-child td:last-child'));
            }

            $(this).find('#category-billable-1').next().attr('for', `category-billable-${rowNum}`);
            $(this).find('#category-billable-1').attr('id', `category-billable-${rowNum}`);
            $(this).find('#category-tax-1').next().attr('for', `category-tax-${rowNum}`);
            $(this).find('#category-tax-1').attr('id', `category-tax-${rowNum}`);
            $(this).find('select').each(function() {
                var type = $(this).attr('id');
                if (type === undefined) {
                    type = $(this).attr('name').includes('expense_account') ? 'expense-account' : type;
                    type = $(this).attr('name').includes('customer') ? 'customer' : type;
                } else {
                    type = type.replaceAll('_', '-');
                }

                if (dropdownFields.includes(type)) {
                    $(this).select2({
                        ajax: {
                            url: '/accounting/get-dropdown-choices',
                            dataType: 'json',
                            data: function(params) {
                                var query = {
                                    search: params.term,
                                    type: 'public',
                                    field: type
                                }

                                // Query parameters will be ?search=[term]&type=public
                                return query;
                            }
                        },
                        templateResult: formatResult,
                        templateSelection: optionSelect
                    });
                } else {
                    var options = $(this).find('option');
                    if (options.length > 10) {
                        $(this).select2();
                    } else {
                        $(this).select2({
                            minimumResultsForSearch: -1
                        });
                    }
                }
            });
        }
    });

    $(document).on('click', 'div#modal-container .modal-body table.clickable:not(#category-details-table,#item-details-table) tbody tr td a.deleteRow', function() {
        var parentTable = $(this).parent().parent().parent().parent().parent();
        $(this).parent().parent().parent().remove();
        if (parentTable.find('tbody tr').length < rowCount) {
            parentTable.find('tbody').append(`<tr>${blankRow}</tr>`);
        }

        var num = 1;

        parentTable.find('tbody tr').each(function() {
            $(this).children('td:nth-child(2)').html(num);
            num++;
        });

        if (modalName === '#depositModal') {
            updateBankDepositTotal();
        }
    });

    $(document).on('click', 'div#modal-container .modal-body table#previous-adjustments-table tbody tr td a.deleteRow', function() {
        $(this).parent().parent().remove();
        if ($('div#modal-container .modal-body table#previous-adjustments-table tbody tr').length < rowCount) {
            parentTable.find('tbody').append(`<tr>${blankRow}</tr>`);
        }

        var num = 1;

        $('div#modal-container .modal-body table#previous-adjustments-table tbody tr').each(function() {
            $(this).children('td:first-child').html(num);
            num++;
        });
    });

    $(document).on('click', '#modal-container .modal-body #category-details-table tbody tr td a.deleteRow', function() {
        $(this).parent().parent().parent().remove();

        if ($('#category-details-table tbody tr').length < rowCount) {
            $('#category-details-table tbody').append(`<tr>${catDetailsBlank}</tr>`);
            if ($('#category-details-table thead tr th').length > $('#category-details-table tbody tr:last-child td').length) {
                $('<td></td>').insertBefore($('#category-details-table tbody tr:last-child td:last-child'));
            }
        }

        var num = 1;

        $('#category-details-table tbody tr').each(function() {
            $(this).children('td:nth-child(2)').html(num);
            num++;
        });

        computeTransactionTotal();
    });

    $(document).on('click', '#modal-container #item-details-table tbody tr td a.deleteRow', function() {
        $(this).parent().parent().parent().remove();

        computeTransactionTotal();
    });

    $(document).on('keyup', '#search-tag', function() {
        $('#tags-table').DataTable().ajax.reload(null, true);
    });

    $(document).on('click', 'div#tags-modal table#tags-table tbody tr td a.edit', function(e) {
        e.preventDefault();

        if (e.currentTarget.dataset.type === 'group') {
            editGroupTagForm(e.currentTarget.dataset);
        } else {
            getTagForm(e.currentTarget.dataset, 'update');
        }
    });

    $(document).on('click', 'div#weeklyTimesheetModal button#add-table-line', function(e) {
        e.preventDefault();
        var table = e.currentTarget.dataset.target;
        var lastRow = $(`table${table} tbody tr:last-child() td:first-child()`);
        var lastRowCount = parseInt(lastRow.html());

        for (var i = 0; i < rowCount; i++) {
            lastRowCount++;
            $(`table${table} tbody`).append(`<tr>${rowInputs}</tr>`);
            $(`table${table} tbody tr:last-child() td:first-child()`).html(lastRowCount);

            $(`table${table} tbody tr:last-child() select`).val(null);
            $(`table${table} tbody tr:last-child() select`).next('span').remove();
            $(`table${table} tbody tr:last-child() input:not([type="checkbox"])`).val('');
            $(`table${table} tbody tr:last-child() textarea`).val('');
            $(`table${table} tbody tr:last-child() textarea`).html('');
            $(`table${table} tbody tr:last-child() input[name="billable[]"]`).attr('id', `billable_${lastRowCount}`).prop('checked', false).trigger('change');
            $(`table${table} tbody tr:last-child() input[name="billable[]"]`).next().attr('for', `billable_${lastRowCount}`);
            $(`table${table} tbody tr:last-child() select`).each(function() {
                var type = $(this).attr('name').includes('customer') ? 'customer' : 'service';
                $(this).select2({
                    ajax: {
                        url: '/accounting/get-dropdown-choices',
                        dataType: 'json',
                        data: function(params) {
                            var query = {
                                search: params.term,
                                type: 'public',
                                field: type
                            }

                            // Query parameters will be ?search=[term]&type=public&field=[type]
                            return query;
                        }
                    },
                    templateResult: formatResult,
                    templateSelection: optionSelect
                });
            });
        }
    });

    $(document).on('click', 'div#weeklyTimesheetModal button#clear-table-line', function(e) {
        e.preventDefault();
        var table = e.currentTarget.dataset.target;

        $(`table${table} tbody tr`).each(function() {
            $(this).remove();
        });

        for (var num = 1; num <= rowCount; num++) {
            $(`table${table} tbody`).append(`<tr>${rowInputs}</tr>`);
            $(`table${table} tbody tr:last-child() td:first-child()`).html(num);
            $(`table${table} tbody tr:last-child() select`).val(null);
            $(`table${table} tbody tr:last-child() select`).next('span').remove();
            $(`table${table} tbody tr:last-child() input:not([type="checkbox"])`).val('');
            $(`table${table} tbody tr:last-child() textarea`).val('');
            $(`table${table} tbody tr:last-child() textarea`).html('');
            $(`table${table} tbody tr:last-child() input[name="billable[]"]`).attr('id', `billable_${num}`).prop('checked', false).trigger('change');
            $(`table${table} tbody tr:last-child() input[name="billable[]"]`).next().attr('for', `billable_${num}`);
            $(`table${table} tbody tr:last-child() select`).select2();
        }

        computeTotalHours();
    });

    $(document).on('click', 'div#modal-container table#timesheet-table tbody tr td a.deleteRow', function() {
        $(this).parent().parent().parent().remove();
        if ($('div#modal-container table tbody tr').length < rowCount) {
            $('div#modal-container table tbody').append(`<tr>${rowInputs}</tr>`)
        }

        var num = 1;

        $('div#modal-container table tbody tr').each(function() {
            $(this).children('td:first-child()').html(num);
            num++;
        });

        computeTotalHours();
    });

    $(document).on('change', 'div#journalEntryModal table#journal-table input[name="debits[]"], div#journalEntryModal table#journal-table input[name="credits[]"]', function() {
        convertToDecimal($(this));

        if ($(this).attr('name') === 'debits[]') {
            $(this).parent().parent().children('td:nth-child(5)').children('input').val('');
        } else {
            $(this).parent().parent().children('td:nth-child(4)').children('input').val('');
        }

        var debit = 0.00;
        var credit = 0.00;

        $('div#journalEntryModal table#journal-table input[name="debits[]"]').each(function() {
            var rowDebit = $(this).val();
            if (rowDebit !== "" && rowDebit !== undefined) {
                rowDebit = parseFloat(rowDebit);
            } else {
                rowDebit = 0.00;
            }

            debit = parseFloat(parseFloat(debit) + rowDebit).toFixed(2);
        });

        $('div#journalEntryModal table#journal-table input[name="credits[]"]').each(function() {
            var rowCredit = $(this).val();
            if (rowCredit !== "" && rowCredit !== undefined) {
                rowCredit = parseFloat(rowCredit);
            } else {
                rowCredit = 0.00;
            }

            credit = parseFloat(parseFloat(credit) + rowCredit).toFixed(2);
        });

        $('div#journalEntryModal table#journal-table tfoot tr td:nth-child(4)').html(debit);
        $('div#journalEntryModal table#journal-table tfoot tr td:nth-child(5)').html(credit);
    });

    $(document).on('change', 'div#statementModal select#statementType, div#statementModal select#customerBalanceStatus', function() {
        $('div#statementModal div.modal-body button.apply-button').removeClass('hide');
        $('div#statementModal div.modal-body div.card-body div.row:last-child()').addClass('hide');

        if ($(this).attr('id') === 'statementType') {
            if ($(this).val() === '2') {
                $('div#statementModal select#customerBalanceStatus option[value="all"]').remove();
            } else {
                if ($('div#statementModal select#customerBalanceStatus option[value="all"]').length === 0) {
                    $('div#statementModal select#customerBalanceStatus').prepend('<option value="all">All</option>');
                }
            }
        }
    });

    $(document).on('change', 'div#statementModal div.modal-body select#statementType', function() {
        if ($(this).val() === '2') {
            $('div#statementModal div.modal-body div.card-body div.row:nth-child(3) div:nth-child(2) div').remove();
            $('div#statementModal div.modal-body div.card-body div.row:nth-child(3) div:nth-child(3) div').remove();
        } else {
            var today = new Date();
            var todayDate = String(today.getDate()).padStart(2, '0');
            var todayMonth = String(today.getMonth() + 1).padStart(2, '0');
            today = todayMonth + '/' + todayDate + '/' + today.getFullYear();

            var startDate = new Date();
            startDate.setMonth(startDate.getMonth() - 1);
            var startDateDay = String(startDate.getDate()).padStart(2, '0');
            var startDateMonth = String(startDate.getMonth() + 1).padStart(2, '0');
            startDate = startDateMonth + '/' + startDateDay + '/' + startDate.getFullYear();

            if ($('div#statementModal div.modal-body div.card-body div.row:nth-child(3) div:nth-child(2) div').length === 0) {
                $('div#statementModal div.modal-body div.card-body div.row:nth-child(3) div:nth-child(2)').html('<div class="form-group"></div>');
                $('div#statementModal div.modal-body div.card-body div.row:nth-child(3) div:nth-child(2) div').append('<label for="startDate">Start Date</label>');
                $('div#statementModal div.modal-body div.card-body div.row:nth-child(3) div:nth-child(2) div').append(`<input onchange="showApplyButton()" type="text" class="form-control date" name="start_date" id="startDate" value="${startDate}"/>`);

                $(`#statementModal input#startDate`).datepicker({
                    uiLibrary: 'bootstrap'
                });
            }

            if ($('div#statementModal div.modal-body div.card-body div.row:nth-child(3) div:nth-child(3) div').length === 0) {
                $('div#statementModal div.modal-body div.card-body div.row:nth-child(3) div:nth-child(3)').html('<div class="form-group"></div>');
                $('div#statementModal div.modal-body div.card-body div.row:nth-child(3) div:nth-child(3) div').append('<label for="endDate">End Date</label>');
                $('div#statementModal div.modal-body div.card-body div.row:nth-child(3) div:nth-child(3) div').append(`<input onchange="showApplyButton()" type="text" class="form-control date" name="end_date" id="endDate" value="${today}"/>`);

                $(`#statementModal input#endDate`).datepicker({
                    uiLibrary: 'bootstrap'
                });
            }
        }
    });

    $(document).on('click', 'div#statementModal div.modal-body div.card-body button.apply-button', function(e) {
        e.preventDefault();

        var statementType = $('div#statementModal select#statementType').val();
        var custBalStatus = $('div#statementModal select#customerBalanceStatus').val();

        var data = new FormData();
        data.append('statement_type', statementType);
        data.append('cust_bal_status', custBalStatus);

        if (
            $('div#statementModal input#startDate').length !== 0 &&
            $('div#statementModal input#endDate').length !== 0
        ) {
            var startDate = $('div#statementModal input#startDate').val();
            var endDate = $('div#statementModal input#endDate').val();
            data.append('start_date', startDate);
            data.append('end_date', endDate);
        }

        $.ajax({
            url: '/accounting/get-customers',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function(result) {
                var res = JSON.parse(result);
                var customers = res.customers;
                var withoutEmail = res.withoutEmail;

                $('div#statementModal span#total-customers').html(customers.length);
                $('div#statementModal span#total-amount').html(`$${res.total}`);
                $('div#statementModal span#without-email-count').html(withoutEmail.length);
                $('div#statementModal span#statements-count').html(customers.length);
                $('div#statementModal table#statements-table tbody').html('');
                $('div#statementModal table#missing-email-table tbody').html('');

                if (withoutEmail.length > 0) {
                    for (i in withoutEmail) {
                        $('div#statementModal table#missing-email-table tbody').append(`<tr>
                            <td>
                                <div class="form-group d-flex" style="margin-bottom: 0 !important">
                                    <input class="m-auto" type="checkbox" name="missing_email_customer[]" value="${withoutEmail[i]['id']}" checked>
                                </div>
                            </td>
                            <td>${withoutEmail[i]['name']}</td>
                            <td><input type="email" name="no_email[${withoutEmail[i]['id']}]" class="form-control customer-email" value="${withoutEmail[i]['email']}"></td>
                            <td class="text-right">$${withoutEmail[i]['balance']}</td>
                        </tr>`);
                    }

                    if ($('div#statementModal div#missing-email div.no-results').length > 0) {
                        $('div#statementModal div#missing-email div.no-results').each(function() {
                            $(this).remove();
                        });
                    }
                }

                if (customers.length > 0) {
                    for (i in customers) {
                        $('div#statementModal table#statements-table tbody').append(`<tr>
                            <td>
                                <div class="form-group d-flex" style="margin-bottom: 0 !important">
                                    <input class="m-auto" type="checkbox" name="customer[]" value="${customers[i]['id']}" checked>
                                </div>
                            </td>
                            <td>${customers[i]['name']}</td>
                            <td><input type="email" name="email[${customers[i]['id']}]" class="form-control customer-email" value="${customers[i]['email']}"></td>
                            <td class="text-right">$${customers[i]['balance']}</td>
                        </tr>`);
                    }

                    if ($('div#statementModal div#statements-avail div.no-results').length > 0) {
                        $('div#statementModal div#statements-avail div.no-results').each(function() {
                            $(this).remove();
                        });
                    }
                }

                if (withoutEmail.length === 0 && $('div#statementModal div#missing-email div.no-results').length === 0) {
                    $('div#statementModal table#missing-email-table').parent().append(noRecordMessage);
                }

                if (customers.length === 0 && $('div#statementModal div#statements-avail div.no-results').length === 0) {
                    $('div#statementModal table#statements-table').parent().append(noRecordMessage);
                }

                $('div#statementModal div.modal-body button.apply-button').addClass('hide');
                $('div#statementModal div.modal-body div.row:last-child()').removeClass('hide');
            }
        });
    });

    $(document).on('change', 'div#statementModal table tbody input.customer-email', function() {
        var name = $(this).prop('name');
        var value = $(this).val();

        if (name.includes('no_email')) {
            name = name.replace('no_', '');
        } else {
            name = "no_" + name;
        }

        $(`div#statementModal table tbody input[name="${name}"]`).each(function() {
            $(this).val(value);
        });
    });

    $(document).on('change', 'div#statementModal table tbody input.select-customer', function() {
        var name = $(this).prop('name');
        var value = $(this).val();
        var checked = $(this).prop('checked');
        var tableName = 'missing-email-table';
        var flag = true;

        if (name.includes('missing_email')) {
            tableName = 'statements-table';
        }

        var rows = $(`div#statementModal table#${tableName} tbody tr`);
        var checkbox = $(`div#statementModal table#${tableName} thead tr th:first-child() div input`);
        $(`div#statementModal table#${tableName} tbody tr td:first-child() div input[value="${value}"]`).prop('checked', checked);
        rows.each(function() {
            if ($(this).children('td:first-child()').children('div').children('input').prop('checked') === false) {
                flag = false;
            }
        });

        checkbox.prop('checked', flag);
    });

    $(document).on('change', 'div#singleTimeModal select#startTime, div#singleTimeModal select#endTime, div#singleTimeModal input#time, #singleTimeModal #billable, #singleTimeModal #hourlyRate, #singleTimeModal #taxable', function() {
        timeActivitySummary();
    });

    $(document).on('change', '#singleTimeModal select#service, #singleTimeModal #billable', function() {
        var service = $('#singleTimeModal #service').val();

        if($('#singleTimeModal #billable').prop('checked')) {
            $.get(`/accounting/get-item-details/${service}`, function(res) {
                var result = JSON.parse(res);
                var rate = result.item !== null ? result.item.price : '';
    
                $('#singleTimeModal #hourlyRate').val(rate).trigger('change');
            });
        }
    });

    $(document).on('change', 'div.modal select#recurringType', function() {
        var modalId = $('form#modal-form, form#update-recurring-form').children('.modal').attr('id');
        if ($(this).val() === 'reminder') {
            if ($(this).parent().next().hasClass('col-md-3')) {
                $(this).parent().next().removeClass('col-md-3');
                $(this).parent().next().addClass('col-md-4');
            }

            $(this).parent().next().children('div').children('div').html(`
                <span>Remind &nbsp;</span>
                <input type="number" name="days_in_advance" id="dayInAdvance" class="form-control" style="width: 20%">
                <span>&nbsp; days before the transaction date</span>
            `);

            if ($('form#modal-form div.modal div.modal-body select#recurringInterval, form#update-recurring-form div.modal div.modal-body select#recurringInterval').length === 0) {
                if ($('form#modal-form, form#update-recurring-form').children('.modal').attr('id') === 'depositModal') {
                    $(`<div class="row recurring-interval-container">${recurrInterval}</div>`).insertAfter($('div#depositModal div.modal-body div.bank-account-details'));
                } else if(vendorModals.includes(`#${modalId}`)) {
                    $(`<div class="row recurring-interval-container">${recurrInterval}</div>`).insertAfter($(`div#${modalId} div.modal-body div.payee-details`));
                } else {
                    $(`<div class="row recurring-interval-container">${recurrInterval}</div>`).insertAfter($('div.modal div.modal-body div.recurring-details'));
                }

                $(`div.modal input.date`).datepicker({
                    uiLibrary: 'bootstrap'
                });
            }
        } else if ($(this).val() === 'unscheduled') {
            $('div.modal div.modal-body div.recurring-interval-container').remove();
            $(this).parent().next().removeClass('col-md-4');
            $(this).parent().next().addClass('col-md-3');
            $(this).parent().next().children('div').children('div').html(`
                <p class="m-0">Unscheduled transactions don’t have timetables; you use them as needed from the Recurring Transactions list.</p>
            `);
        } else {
            if ($(this).parent().next().hasClass('col-md-3')) {
                $(this).parent().next().removeClass('col-md-3');
                $(this).parent().next().addClass('col-md-4');
            }

            $(this).parent().next().children('div').children('div').html(`
                <span>Create &nbsp;</span>
                <input type="number" name="days_in_advance" id="dayInAdvance" class="form-control" style="width: 20%">
                <span>&nbsp; days in advance</span>
            `);

            if ($('form#modal-form div.modal div.modal-body select#recurringInterval, form#update-recurring-form div.modal div.modal-body select#recurringInterval').length === 0) {
                if ($('form#modal-form, form#update-recurring-form').children('.modal').attr('id') === 'depositModal') {
                    $(`<div class="row recurring-interval-container">${recurrInterval}</div>`).insertAfter($('div#depositModal div.modal-body div.bank-account-details'));
                } else if(vendorModals.includes(`#${modalId}`)) {
                    $(`<div class="row recurring-interval-container">${recurrInterval}</div>`).insertAfter($(`div#${modalId} div.modal-body div.payee-details`));
                } else {
                    $(`<div class="row recurring-interval-container">${recurrInterval}</div>`).insertAfter($('div.modal div.modal-body div.recurring-details'));
                }

                $(`div.modal input.date`).datepicker({
                    uiLibrary: 'bootstrap'
                });
            }
        }

        var modalId = $('div#modal-container form div.modal:first-child()').attr('id');

        $(`div#${modalId} select:not(.select2-hidden-accessible)`).select2({
            minimumResultsForSearch: -1
        });
    });

    $(document).on('change', 'div.modal select[name="recurring_week"]', function() {
        if ($(this).val() !== 'day') {
            $(this).parent().next().find('select[name="recurring_day"]').next().remove();
            $(this).parent().next().find('select[name="recurring_day"]').html(`
                <option value="sunday">Sunday</option>
                <option value="monday" selected>Monday</option>
                <option value="tuesday">Tuesday</option>
                <option value="wednesday">Wednesday</option>
                <option value="thursday">Thursday</option>
                <option value="friday">Friday</option>
                <option value="saturday">Saturday</option>
            `);
            $(this).parent().next().find('select[name="recurring_day"]').select2({
                minimumResultsForSearch: -1
            });
        } else {
            $(this).parent().next().find('select[name="recurring_day"]').next().remove();
            $(this).parent().next().find('select[name="recurring_day"]').html(recurringDays);
            $(this).parent().next().find('select[name="recurring_day"]').select2({
                minimumResultsForSearch: -1
            });
        }
    });

    $(document).on('change', 'div.modal select#endType', function() {
        if ($(this).val() === 'by') {
            $(this).parent().next().remove();
            $(this).parent().parent().append(`
                <div class="col-md-2 form-group">
                    <label for="endDate">End date</label>
                    <input type="text" class="form-control date" name="end_date" id="endDate"/>
                </div>
            `);

            $(`div.modal input#endDate`).datepicker({
                uiLibrary: 'bootstrap'
            });
        } else if ($(this).val() === 'after') {
            $(this).parent().next().remove();
            $(this).parent().parent().append(`
                <div class="col-md-2 form-group">
                    <div class="row m-0 h-100 d-flex">
                        <div class="align-self-end d-flex align-items-center">
                            <input type="number" name="max_occurence" id="maxOccurence" class="form-control" style="width: 50%">
                            <span>&nbsp; occurrences</span>
                        </div>
                    </div>
                </div>
            `);
        } else {
            $(this).parent().next().remove();
        }
    });

    $(document).on('change', 'div.modal select#recurringInterval', function() {
        var fields = '';
        if ($(this).val() === 'daily') {
            if ($(this).parent().next().hasClass('col-md-4')) {
                $(this).parent().next().removeClass('col-md-4');
            } else if ($(this).parent().next().hasClass('col-md-3')) {
                $(this).parent().next().removeClass('col-md-3');
            }

            if ($(this).parent().next().hasClass('col-md-2') === false) {
                $(this).parent().next().addClass('col-md-2');
            }

            fields = `
                <div class="align-items-center col-md-2 d-flex justify-content-center">every</div>
                <div class="col"><input type="number" value="1" class="form-control" name="recurr_every"></div>
                <div class="align-items-center col-md-1 d-flex">day</div>
            `;
        } else if ($(this).val() === 'weekly') {
            if ($(this).parent().next().hasClass('col-md-4')) {
                $(this).parent().next().removeClass('col-md-4');
            } else if ($(this).parent().next().hasClass('col-md-2')) {
                $(this).parent().next().removeClass('col-md-2');
            }

            if ($(this).parent().next().hasClass('col-md-3') === false) {
                $(this).parent().next().addClass('col-md-3');
            }

            fields = `
                <div class="align-items-center col-md-1 d-flex justify-content-center">every</div>
                <div class="col"><input type="number" value="1" class="form-control" name="recurr_every"></div>
                <div class="align-items-center col-md-2 d-flex justify-content-center">week(s) on</div>
                <div class="col">
                    <select class="form-control" name="recurring_day">
                        <option value="sunday">Sunday</option>
                        <option value="monday" selected>Monday</option>
                        <option value="tuesday">Tuesday</option>
                        <option value="wednesday">Wednesday</option>
                        <option value="thursday">Thursday</option>
                        <option value="friday">Friday</option>
                        <option value="saturday">Saturday</option>
                    </select>
                </div>
            `;
        } else if ($(this).val() === 'yearly') {
            if ($(this).parent().next().hasClass('col-md-4')) {
                $(this).parent().next().removeClass('col-md-4');
            } else if ($(this).parent().next().hasClass('col-md-2')) {
                $(this).parent().next().removeClass('col-md-2');
            }

            if ($(this).parent().next().hasClass('col-md-3') === false) {
                $(this).parent().next().addClass('col-md-3');
            }

            fields = `
                <div class="align-items-center col-md-1 d-flex justify-content-center">every</div>
                <div class="col">
                    <select class="form-control" name="recurring_month">
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
                <div class="col">
                    <select class="form-control" name="recurring_day">
                        ${recurringDays}
                    </select>
                </div>
            `;
        } else {
            if ($(this).parent().next().hasClass('col-md-3')) {
                $(this).parent().next().removeClass('col-md-3');
            } else if ($(this).parent().next().hasClass('col-md-2')) {
                $(this).parent().next().removeClass('col-md-2');
            }

            if ($(this).parent().next().hasClass('col-md-4') === false) {
                $(this).parent().next().addClass('col-md-4');
            }

            fields = monthlyRecurrFields;
        }

        $(this).parent().next().children().html(fields);

        $(this).parent().next().children().find('select').each(function() {
            $(this).select2({
                minimumResultsForSearch: -1
            });
        });
    });

    $(document).on('click', '#showPdfModal button#print-deposit-pdf', function(e) {
        var PDF = document.getElementById('showPdf');
        PDF.focus();
        PDF.contentWindow.print();
    });

    $(document).on('click', '#statementModal div.modal-footer button#save-and-send', function(e) {
        e.preventDefault();
        var flag = false;
        var data = {
            title: 'statement-summary',
            customers: [],
            statement_type: $('#statementModal select#statementType').val(),
            statement_date: $('#statementModal input#statementDate').val(),
            cust_bal_status: $('#statementModal select#customerBalanceStatus').val(),
        };

        data.start_date = data.statement_type !== "2" ? $('#statementModal input#startDate').val() : null;
        data.end_date = data.statement_type !== "2" ? $('#statementModal input#endDate').val() : null;

        var customers = $('#statements-table tbody tr td:first-child() input:checked');

        customers.each(function() {
            data.customers.push($(this).val());
        });

        if (data.customers.length > 0) {
            flag = true;
        }

        if (flag === true) {
            $.ajax({
                url: '/accounting/send-email-form/',
                data: { json: JSON.stringify(data) },
                type: 'post',
                success: function(res) {
                    if ($('#statementModal').parent().children('#showEmailModal').length > 0) {
                        $('#statementModal').parent().children('#showEmailModal').remove();
                    }
                    $('#statementModal').parent().append(res);

                    $('#showEmailModal').modal('show');
                }
            });
        } else {
            toast(false, "Please select at least one recipient before attempting to save.");
            return;
        }
    });

    $(document).on('submit', '#tags-modal #tags-group-form', function(e) {
        e.preventDefault();

        var form = $(this);

        var data = new FormData(document.getElementById(form.attr('id')));

        $.ajax({
            url: '/accounting/addTagsGroup',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function(res) {
                var result = JSON.parse(res);

                form.addClass('hide');
                form.next().children('tbody').append(`<tr><td><span>${data.get('tags_group_name')}</span><a href="#" class="float-right text-info">Edit</a></td></tr>`);
                form.next().removeClass('hide');
                $('#tags-modal #tags-form').prepend(`<input type="hidden" name="group_id" value="${result.data}">`);
                form.prepend(`<input type="hidden" name="group_id" value="${result.data}">`);
            }
        });
    });

    $(document).on('click', '#tags-modal table#tags_group tbody a', function() {
        if ($('#tags-modal #update-group-form').length === 0) {
            $('#tags-modal #tags-group-form').attr('id', 'update-group-form');
        }

        $('#tags-modal #update-group-form').removeClass('hide');

        $('#tags-modal table#tags_group').addClass('hide');
    });

    $(document).on('submit', '#tags-modal #update-group-form, #tags-modal #edit_group_tag', function(e) {
        e.preventDefault();

        var form = $(this);

        var data = new FormData(document.getElementById(form.attr('id')));

        $.ajax({
            url: `/accounting/update-group-tag/${data.get('group_id')}/group`,
            data: { name: data.get('tags_group_name') },
            type: "POST",
            dataType: "json",
            success: function(res) {
                if (form.attr('id') === 'update-group-form') {
                    form.addClass('hide');
                    form.next().children('tbody').children('tr').remove();
                    form.next().children('tbody').append(`<tr><td><span>${data.get('tags_group_name')}</span><a href="#" class="float-right text-info">Edit</a></td></tr>`);

                    form.next().removeClass('hide');
                } else {
                    toast(res.success, res.message);

                    showTagsList(form.children().children('.modal-header').children('a'));
                }
            }
        });
    });

    $(document).on('submit', '#tags-modal #tags-form', function(e) {
        e.preventDefault();

        var form = $(this);

        var data = new FormData(document.getElementById(form.attr('id')));

        $.ajax({
            url: '/accounting/addTags',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function(res) {
                var result = JSON.parse(res);
                form.next().children('tbody').append(`
                <tr>
                    <td>
                        <div class="tag-name-cont">
                            <span>${data.get('tag_name')}</span><a href="#" class="float-right text-info">Edit</a>
                        </div>
                        <form class="hide" id="form-tag-${result.data}">
                            <input type="hidden" name="tag_id" value="${result.data}">
                            <div class="form-row">
                                <div class="col-md-8">
                                    <label for="tag_name">Tag name</label>
                                    <input type="text" name="update_tag_name" value="${data.get('tag_name')}" class="form-control">
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <button type="submit" class="btn btn-success w-100">Save</button>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>`);

                $('#tags-modal #tags-form input#tag-name').val('');
                form.next().removeClass('hide');
            }
        });
    });

    $(document).on('click', '#tags-modal table#group_tags tbody .tag-name-cont a', function() {
        $(this).parent().addClass('hide');
        $(this).parent().next().removeClass('hide');
    });

    $(document).on('submit', '#tags-modal table#group_tags tbody form', function(e) {
        e.preventDefault();

        var form = $(this);
        var data = new FormData(document.getElementById(form.attr('id')));

        $.ajax({
            url: `/accounting/update-group-tag/${data.get('tag_id')}/tag`,
            data: { name: data.get('update_tag_name') },
            type: "POST",
            dataType: "json",
            success: function(res) {
                form.addClass('hide');

                form.prev().children('span').html(data.get('update_tag_name'));
                form.prev().removeClass('hide');
            }
        });
    });

    $(document).on('change', '#inventory-adjustments-table select[name="product[]"]', function() {
        var input = $(this);

        if(input.val() !== 'add-new') {
            $.get(`/accounting/get-item-details/${input.val()}`, function(res) {
                var result = JSON.parse(res);
    
                input.parent().next().html(result.item.description);
    
                input.parent().next().next().children('select').html('<option value="" disabled selected>&nbsp;</option>');
                for (i in result.locations) {
                    input.parent().next().next().children('select').append(`<option value="${result.locations[i].id}" data-quantity="${result.locations[i].qty}">${result.locations[i].name}</option>`);
                }
            });
        }
    });

    $(document).on('change', '#inventory-adjustments-table select[name="location[]"]', function() {
        var selected = $(this).children('option:selected');
        var quantity = selected[0].dataset.quantity;

        $(this).parent().next().addClass('text-right');
        $(this).parent().next().html(quantity);
        $(this).parent().parent().find('input[name="new_qty[]"]').val(quantity);
        $(this).parent().parent().find('input[name="change_in_qty[]"]').val(0);
    });

    $(document).on('change', '#inventory-adjustments-table input[name="new_qty[]"], #inventory-adjustments-table input[name="change_in_qty[]"]', function() {
        var value = $(this).val();
        if ($(this).attr('name') === 'new_qty[]') {
            var changeInQty = parseInt(value) - parseInt($(this).parent().prev().html());
            $(this).parent().parent().find('[name="change_in_qty[]"]').val(changeInQty);
        } else {
            var newQty = parseInt($(this).parent().prev().prev().html()) + parseInt(value);
            $(this).parent().parent().find('[name="new_qty[]"]').val(newQty);
        }
    });

    // Expenses modal
    $(document).on('click', '#modal-container .modal .btn[data-toggle="collapse"]', function(e) {
        if ($(this).attr('aria-expanded') === 'true') {
            $(this).children('i').addClass('fa-caret-down').removeClass('fa-caret-right');
        } else {
            $(this).children('i').addClass('fa-caret-right').removeClass('fa-caret-down');
        }
    });

    $(document).on('change', '#expenseModal #ref_no', function() {
        if ($(this).val() !== "") {
            $('#expenseModal .modal-title span').html('#' + $(this).val());
        } else {
            $('#expenseModal .modal-title span').html('');
        }
    });

    $(document).on('change', '#creditCardCreditModal #ref_no', function() {
        if ($(this).val() !== "") {
            $('#creditCardCreditModal .modal-title span').html('#' + $(this).val());
        } else {
            $('#creditCardCreditModal .modal-title span').html('');
        }
    });

    $(document).on('change', '#checkModal #print_later', function() {
        if ($(this).prop('checked')) {
            $('#checkModal #check_no').prop('disabled', true);
            $('#checkModal #check_no').val('To print').trigger('change');
        } else {
            $('#checkModal #check_no').prop('disabled', false);
            $('#checkModal #check_no').val('').trigger('change');
        }
    });

    $(document).on('change', '#checkModal #check_no', function() {
        if ($(this).val() !== "") {
            $('#checkModal .modal-title span').html('#' + $(this).val());
        } else {
            $('#checkModal .modal-title span').html('');
        }
    });

    $(document).on('change', '#modal-container .modal-body table#category-details-table input[name="category_amount[]"]', function() {
        computeTransactionTotal();
    });

    $(document).on('change', '#modal-container .modal-body table#category-details-table input[name="category_billable[]"]', function() {
        if ($(this).prop('checked')) {
            $(this).parent().parent().parent().find('select[name="category_customer[]"]').prop('required', true);
        } else {
            $(this).parent().parent().parent().find('select[name="category_customer[]"]').prop('required', false);
        }
    });

    $(document).on('change', '#modal-container .modal-body table#category-details-table input[name="category_tax[]"]', function() {
        $(this).parent().parent().parent().find('input[name="category_billable[]"]').prop('checked', true).trigger('change');
    });

    $(document).on('change', '#expenseModal #expense_payment_account', function() {
        var val = $(this).val();

        if (val !== '' && val !== null && val !== 'add-new') {
            $.get('/accounting/get-account-balance/' + val, function(res) {
                var result = JSON.parse(res);

                $('#expenseModal span#account-balance').html(result.balance);
            });
        }
    });

    $(document).on('change', '#creditCardCreditModal #bank_credit_account', function() {
        var id = $(this).val();

        $.get('/accounting/get-account-balance/' + id, function(res) {
            var result = JSON.parse(res);

            $('#creditCardCreditModal span#account-balance').html(result.balance);
        });
    });

    $(document).on('change', '#checkModal #bank_account', function() {
        var id = $(this).val();

        $.get('/accounting/get-account-balance/' + id, function(res) {
            var result = JSON.parse(res);

            $('#checkModal span#account-balance').html(result.balance);
        });
    });

    $(document).on('change', '#printChecksModal #payment_account', function() {
        var id = $(this).val();

        $.get('/accounting/get-account-balance/' + id, function(res) {
            var result = JSON.parse(res);

            $('#printChecksModal span#account-balance').html(result.balance);
        });
    });

    $(document).on('change', '#payBillsModal #payment_account', function() {
        var id = $(this).val();

        $.get('/accounting/get-account-balance/' + id, function(res) {
            var result = JSON.parse(res);

            $('#payBillsModal span#account-balance').html(result.balance);
        });
    });

    $(document).on('change', '#payBillsModal #table_rows', function() {
        applybillsfilter();
    });

    $(document).on('change', '#modal-container table#item-details-table tbody tr input', function() {
        var quantity = $(this).parent().parent().find('input[name="quantity[]"]').val();
        var price = $(this).parent().parent().find('input[name="item_amount[]"]').val();
        var taxPercentage = $(this).parent().parent().find('input[name="item_tax[]"]').val();
        var discount = $(this).parent().parent().find('input[name="discount[]"]').val();
        var amount = parseFloat(parseFloat(price) * parseInt(quantity)).toFixed(2);
        var taxAmount = parseFloat(taxPercentage) * amount / 100;
        var total = parseFloat(parseFloat(amount) + parseFloat(taxAmount) - parseFloat(discount)).toFixed(2);
        total = '$'+total;

        $(this).parent().parent().find('td span.row-total').html(formatter.format(parseFloat(total)));
        computeTransactionTotal();
    });

    $(document).on('click', '#modal-container a#add_another_items', function(e) {
        e.preventDefault();

        if ($('#modal-container #products_list.modal').length === 0) {
            $.get('/accounting/get-products-list-modal', function(res) {
                $('#modal-container').append(res);

                $('#modal-container #products_list table').DataTable({
                    autoWidth: false,
                    searching: false,
                    processing: true,
                    lengthChange: false,
                    info: false,
                    pageLength: 10,
                    ordering: false
                });

                $('#modal-container #products_list').modal('show');
            });
        } else {
            $('#modal-container #products_list').modal('show');
        }
    });

    $(document).on('click', '#modal-container #products_list table button', function(e) {
        e.preventDefault();
        var id = e.currentTarget.dataset.id;

        $.get('/accounting/get-item-details/' + id, function(res) {
            var result = JSON.parse(res);
            var item = result.item;
            var locations = result.locations;
            var locs = '';

            for (var i in locations) {
                locs += `<option value="${locations[i].id}" data-quantity="${locations[i].qty === "null" ? 0 : locations[i].qty}">${locations[i].name}</option>`;
            }

            if ($('#modal-container form .modal').attr('id') === 'creditCardCreditModal' || $('#modal-container form .modal').attr('id') === 'vendorCreditModal') {
                var qtyField = `<input type="number" name="quantity[]" class="form-control text-right" required value="0" max="${locations[0].qty}" min="0">`;
            } else {
                var qtyField = `<input type="number" name="quantity[]" class="form-control text-right" required value="0" min="0">`;
            }

            if ($('#modal-container form .modal').attr('id') === 'purchaseOrderModal' && $('#modal-container #item-details-table thead th').length > 9) {
                var fields = `
                    <td>${item.title}<input type="hidden" name="item[]" value="${item.id}"></td>
                    <td>Product</td>
                    <td><select name="location[]" class="form-control" required>${locs}</select></td>
                    <td>${qtyField}</td>
                    <td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="${item.price}"></td>
                    <td><input type="number" name="discount[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="0.00"></td>
                    <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="7.50"></td>
                    <td><span class="row-total">$0.00</span></td>
                    <td class="text-right">0</td>
                    <td>
                        <div class="d-flex align-items-center justify-content-center">
                            <input type="checkbox" name="item_closed[]" class="form-check" value="1">
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="#" class="deleteRow"><i class="fa fa-trash"></i></a>
                        </div>
                    </td>
                `;
            } else {
                var fields = `
                    <td>${item.title}<input type="hidden" name="item[]" value="${item.id}"></td>
                    <td>Product</td>
                    <td><select name="location[]" class="form-control" required>${locs}</select></td>
                    <td>${qtyField}</td>
                    <td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="${item.price}"></td>
                    <td><input type="number" name="discount[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="0.00"></td>
                    <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="7.50"></td>
                    <td><span class="row-total">$0.00</span></td>
                    <td>
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="#" class="deleteRow"><i class="fa fa-trash"></i></a>
                        </div>
                    </td>
                `;
            }

            $('#modal-container form .modal #item-details-table tbody').append(`<tr></tr>`);
            $('#modal-container form .modal #item-details-table tbody tr:last-child').append(fields);
            if ($('#modal-container #item-details-table thead tr th').length > $('#modal-container #item-details-table tbody tr:last-child td')) {
                $(`<td></td>`).insertBefore($('#modal-container .modal table#item-details-table tbody tr:last-child td:last-child'));
            }

            $('#modal-container form .modal #item-details-table tbody tr:last-child select').each(function() {
                if($(this).find('option').length > 10) {
                    $(this).select2();
                } else {
                    $(this).select2({
						minimumResultsForSearch: -1
					});
                }
            });
        });
    });

    $(document).on('change', '#creditCardCreditModal #item-details-table select[name="location[]"]', function() {
        var quantity = $(this).find('option:selected')[0].dataset.quantity;

        $(this).parent().parent().find('input[name="quantity[]"]').attr('max', quantity);
    });

    $(document).on('change', '#vendorCreditModal #item-details-table select[name="location[]"]', function() {
        var quantity = $(this).find('option:selected')[0].dataset.quantity;

        $(this).parent().parent().find('input[name="quantity[]"]').attr('max', quantity);
    });

    $(document).on('change', '#vendorCreditModal #ref_no', function() {
        if ($(this).val() !== "") {
            $('#vendorCreditModal .modal-title span').html('#' + $(this).val());
        } else {
            $('#vendorCreditModal .modal-title span').html('');
        }
    });

    $(document).on('change', '#billModal #bill_no', function() {
        if ($(this).val() !== "") {
            $('#billModal .modal-title span').html('#' + $(this).val());
        } else {
            $('#billModal .modal-title span').html('');
        }
    });

    $(document).on('change', '#billModal #terms', function() {
        if($(this).val() !== 'add-new') {
            var billDate = new Date($('#billModal #bill_date').val());
            var dueDate = new Date(`${billDate.getMonth()+1}/${billDate.getDate()}/${billDate.getFullYear()}`);

            $.get('/accounting/get-term-details/' + $(this).val(), function(res) {
                var term = JSON.parse(res);
    
                if (term.type === "1") {
                    dueDate.setDate(dueDate.getDate() + parseInt(term.net_due_days));
                } else {
                    if (
                        term.minimum_days_to_pay === null ||
                        term.minimum_days_to_pay === "" ||
                        term.minimum_days_to_pay === "0"
                    ) {
                        dueDate.setDate(term.day_of_month_due);
                        if (billDate.getDate() > parseInt(term.day_of_month_due)) {
                            dueDate.setMonth(dueDate.getMonth() + 1);
                        }
                    } else {
                        var expectedDue = new Date(`${dueDate.getMonth()+1}/${dueDate.getDate()}/${dueDate.getFullYear()}`);
                        expectedDue.setDate(parseInt(term.day_of_month_due));
                        expectedDue.setDate(expectedDue.getDate() - parseInt(term.minimum_days_to_pay));
                        if (billDate.getDate() > expectedDue.getDate()) {
                            dueDate = new Date(`${dueDate.getMonth() + 2}/${term.day_of_month_due}/${dueDate.getFullYear()}`);
                        } else {
                            dueDate.setDate(parseInt(term.day_of_month_due));
                        }
                    }
                }
    
                dueDate = String(dueDate.getMonth() + 1).padStart(2, '0') + '/' + String(dueDate.getDate()).padStart(2, '0') + '/' + dueDate.getFullYear();
    
                $('#billModal #due_date').val(dueDate);
            });
        }
    });

    $(document).on('change', '#checkModal #payee', function() {
        if ($(this).val() !== '' && $(this).val() !== null) {
            var split = $(this).val().split('-');

            switch (split[0]) {
                case 'vendor':
                    $.get('/accounting/get-vendor-details/' + split[1], function(res) {
                        var vendor = JSON.parse(res);

                        var vendorName = '';
                        vendorName += vendor.title !== "" ? vendor.title + " " : "";
                        vendorName += vendor.f_name !== "" ? vendor.f_name + " " : "";
                        vendorName += vendor.m_name !== "" ? vendor.m_name + " " : "";
                        vendorName += vendor.l_name !== "" ? vendor.l_name + " " : "";
                        vendorName += vendor.suffix !== "" ? vendor.suffix : "";
                        $('#checkModal #mailing_address').html(vendorName.trim());
                        $('#checkModal #mailing_address').append('\n');
                        var address = '';
                        address += vendor.street !== "" ? vendor.street : "";
                        address += vendor.city !== "" ? '\n' + vendor.city : "";
                        address += vendor.state !== "" ? ', ' + vendor.state : "";
                        address += vendor.zip !== "" ? ' ' + vendor.zip : "";

                        $('#checkModal #mailing_address').append(address.trim());
                    });
                    break;
                case 'customer':
                    $.get('/accounting/get-customer-details/' + split[1], function(res) {
                        var customer = JSON.parse(res);

                        var customerName = '';
                        customerName += customer.first_name !== "" ? customer.first_name + " " : "";
                        customerName += customer.middle_name !== "" ? customer.middle_name + " " : "";
                        customerName += customer.last_name !== "" ? customer.last_name : "";
                        $('#checkModal #mailing_address').html(customerName.trim());
                        $('#checkModal #mailing_address').append('\n');
                        if (customer.business_name !== "" && customer.business_name !== null) {
                            $('#checkModal #mailing_address').append(customer.business_name);
                            $('#checkModal #mailing_address').append('\n');
                        }
                        var address = '';
                        address += customer.mail_add !== "" ? customer.mail_add : "";
                        address += customer.city !== "" ? '\n' + customer.city : "";
                        address += customer.state !== "" ? ', ' + customer.state : "";
                        address += customer.zip_code !== "" ? ' ' + customer.zip_code : "";
                        address += customer.country !== "" ? ' ' + customer.country : "";

                        $('#checkModal #mailing_address').append(address.trim());
                    });
                    break;
                case 'employee':
                    $.get('/accounting/get-employee-details/' + split[1], function(res) {
                        var employee = JSON.parse(res);

                        var employeeName = '';
                        employeeName += employee.FName !== "" ? employee.FName + " " : "";
                        employeeName += employee.LName !== "" ? employee.LName : "";
                        $('#checkModal #mailing_address').html(employeeName.trim());
                        $('#checkModal #mailing_address').append('\n');
                        var address = '';
                        address += employee.address !== "" ? employee.address : "";
                        address += employee.city !== "" ? '\n' + employee.city : "";
                        address += employee.state !== "" ? ', ' + employee.state : "";
                        address += employee.postal_code !== "" ? ' ' + employee.postal_code : "";

                        $('#checkModal #mailing_address').append(address.trim());
                    });
                    break;
            }
        }
    });

    $(document).on('change', '#purchaseOrderModal #vendor, #billModal #vendor, #vendorCreditModal #vendor', function() {
        var modalId = $('#modal-container form#modal-form .modal').attr('id');
        $.get('/accounting/get-vendor-details/' + $(this).val(), function(res) {
            var vendor = JSON.parse(res);

            $(`#${modalId} #email`).val(vendor.email);

            var vendorName = '';
            vendorName += vendor.title !== "" ? vendor.title + " " : "";
            vendorName += vendor.f_name !== "" ? vendor.f_name + " " : "";
            vendorName += vendor.m_name !== "" ? vendor.m_name + " " : "";
            vendorName += vendor.l_name !== "" ? vendor.l_name + " " : "";
            vendorName += vendor.suffix !== "" ? vendor.suffix : "";
            $(`#${modalId} #mailing_address`).html(vendorName.trim());
            $(`#${modalId} #mailing_address`).append('\n');
            var address = '';
            address += vendor.street !== "" ? vendor.street : "";
            address += vendor.city !== "" ? '\n' + vendor.city : "";
            address += vendor.state !== "" ? ', ' + vendor.state : "";
            address += vendor.zip !== "" ? ' ' + vendor.zip : "";

            $(`#${modalId} #mailing_address`).append(address.trim());
        });
    });

    $(document).on('change', '#purchaseOrderModal #customer', function() {
        $.get('/accounting/get-customer-details/' + $(this).val(), function(res) {
            var customer = JSON.parse(res);

            var customerName = '';
            customerName += customer.first_name !== "" ? customer.first_name + " " : "";
            customerName += customer.middle_name !== "" ? customer.middle_name + " " : "";
            customerName += customer.last_name !== "" ? customer.last_name : "";
            $('#purchaseOrderModal #shipping_address').html(customerName.trim());
            $('#purchaseOrderModal #shipping_address').append('\n');
            if (customer.business_name !== "" && customer.business_name !== null) {
                $('#purchaseOrderModal #shipping_address').append(customer.business_name);
                $('#purchaseOrderModal #shipping_address').append('\n');
            }
            $('#purchaseOrderModal #shipping_address').append(customer.mail_add + '\n' + customer.city + ', ' + customer.state + ' ' + customer.zip_code + ' ' + customer.country);
        });
    });

    $(document).on('change', '#payBillsModal #bills-table .payment-amount, #payBillsModal #bills-table .credit-applied', function() {
        if ($(this).hasClass('payment-amount')) {
            var row = $(this).parent().parent();
            var payment = $(this).val();
            var creditApplied = row.find('input.credit-applied');
            creditApplied = creditApplied.length > 0 && creditApplied.val() !== '' ? parseFloat(creditApplied.val()) : 0.00;
        } else {
            var row = $(this).parent().parent().parent().parent();
            var rowData = $('#payBillsModal #bills-table').DataTable().row(row).data();
            var balance = parseFloat(rowData.open_balance);
            var paymentAmount = row.find('input.payment-amount');
            var creditApplied = parseFloat($(this).val());

            var payment = parseFloat(balance - creditApplied).toFixed(2);
            paymentAmount.val(payment);
            paymentAmount = payment;

            var totalVCredit = parseFloat(rowData.vendor_credits);
            var remaining_vcredit = totalVCredit - creditApplied;

            $(this).parent().next().children('span').html(parseFloat(remaining_vcredit).toFixed(2));
        }

        var total = parseFloat(payment) + parseFloat(creditApplied);

        row.find('td:last-child span').html(parseFloat(total).toFixed(2));

        if (row.find('input[type="checkbox"]').prop('checked') === false) {
            row.find('input[type="checkbox"]').prop('checked', true);
        }

        computeBillsPaymentTotal();
    });

    $(document).on('change', '#payBillsModal #bills-table tbody input[type="checkbox"]', function() {
        computeBillsPaymentTotal();
    });

    $(document).on('change', '#payBillsModal #bills-table input#select-all-bills', function() {
        var isChecked = $(this).prop('checked');

        $('#payBillsModal #bills-table tbody tr input[type="checkbox"]').each(function() {
            $(this).prop('checked', isChecked);
            $(this).trigger('change');
        });
    });

    $(document).on('change', '#expenseModal #payee', function() {
        if ($(this).val() !== '' && $(this).val() !== null && $(this).val() !== 'add-new') {
            var split = $(this).val().split('-');
            unlinkTransaction();

            if (split[0] === 'vendor') {
                $.get('/accounting/get-linkable-transactions/expense/' + split[1], function(res) {
                    var transactions = JSON.parse(res);

                    if (transactions.length > 0) {
                        if($('#expenseModal .attachments-container').length > 0) {
                            $('#expenseModal .attachments-container').parent().parent().remove();
                        }

                        if ($('#expenseModal .transactions-container').length > 0) {
                            $('#expenseModal .transactions-container').parent().remove();
                            $('#expenseModal a.close-transactions-container').parent().remove();
                            $('#expenseModal a.open-transactions-container').parent().remove();
                        }

                        $('#expenseModal .modal-body .row .col .card .card-body').children('.row:first-child').prepend(`
                            <div class="col-md-12 px-0 pb-2">
                                <a href="#" class="float-right btn btn-transparent rounded-0 close-transactions-container" style="padding:12px 15px !important">
                                    <i class="fa fa-chevron-right"></i>
                                </a>
                            </div>
                        `);

                        $('#expenseModal .modal-body').children('.row').append(`
                            <div class="col-xl-2">
                                <div class="transactions-container bg-white h-100" style="padding: 15px">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>Add to Expense</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `);

                        $.each(transactions, function(index, transaction) {
                            var title = transaction.type;
                            title += transaction.number !== '' ? '#' + transaction.number : '';
                            $('#expenseModal .modal-body .row .col-xl-2 .transactions-container .row').append(`
                                <div class="col-12">
                                    <div class="card border">
                                        <div class="card-body p-0">
                                            <h5 class="card-title">${title}</h5>
                                            <p class="card-subtitle">${transaction.formatted_date}</p>
                                            <p class="card-text">
                                                <strong>Total</strong> ${transaction.total}
                                                ${transaction.type === 'Purchase Order' ? '<br><strong>Balance</strong> '+transaction.balance : ''}
                                            </p>
                                            <ul class="d-flex justify-content-around">
                                                <li><a href="#" class="text-info add-transaction" data-id="${transaction.id}" data-type="${transaction.data_type}"><strong>Add</strong></a></li>
                                                <li><a href="#" class="text-info open-transaction" data-id="${transaction.id}" data-type="${transaction.data_type}">Open</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            `);
                        });
                    } else {
                        $('#expenseModal .transactions-container').parent().remove();
                        $('#expenseModal a.close-transactions-container').parent().remove();
                        $('#expenseModal a.open-transactions-container').parent().remove();
                    }
                });
            }
        } else {
            $('#expenseModal .transactions-container').parent().remove();
            $('#expenseModal a.close-transactions-container').parent().remove();
            $('#expenseModal a.open-transactions-container').parent().remove();
        }
    });

    $(document).on('change', '#checkModal #payee', function() {
        if ($(this).val() !== '' && $(this).val() !== null) {
            var split = $(this).val().split('-');
            unlinkTransaction();

            if (split[0] === 'vendor') {
                $.get('/accounting/get-linkable-transactions/check/' + split[1], function(res) {
                    var transactions = JSON.parse(res);

                    if (transactions.length > 0) {
                        if($('#checkModal .attachments-container').length > 0) {
                            $('#checkModal .attachments-container').parent().parent().remove();
                        }

                        if ($('#checkModal .transactions-container').length > 0) {
                            $('#checkModal .transactions-container').parent().remove();
                            $('#checkModal a.close-transactions-container').parent().remove();
                            $('#checkModal a.open-transactions-container').parent().remove();
                        }

                        $('#checkModal .modal-body .row .col .card .card-body').children('.row:first-child').prepend(`
                            <div class="col-md-12 px-0 pb-2">
                                <a href="#" class="float-right btn btn-transparent rounded-0 close-transactions-container" style="padding:12px 15px !important">
                                    <i class="fa fa-chevron-right"></i>
                                </a>
                            </div>
                        `);

                        $('#checkModal .modal-body').children('.row').append(`
                            <div class="col-xl-2">
                                <div class="transactions-container bg-white h-100" style="padding: 15px">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>Add to Check</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `);

                        $.each(transactions, function(index, transaction) {
                            var title = transaction.type;
                            title += transaction.number !== '' ? '#' + transaction.number : '';
                            $('#checkModal .modal-body .row .col-xl-2 .transactions-container .row').append(`
                                <div class="col-12">
                                    <div class="card border">
                                        <div class="card-body p-0">
                                            <h5 class="card-title">${title}</h5>
                                            <p class="card-subtitle">${transaction.formatted_date}</p>
                                            <p class="card-text">
                                                <strong>Total</strong> ${transaction.total}
                                                ${transaction.type === 'Purchase Order' ? '<br><strong>Balance</strong> '+transaction.balance : ''}
                                            </p>
                                            <ul class="d-flex justify-content-around">
                                                <li><a href="#" class="text-info add-transaction" data-id="${transaction.id}" data-type="${transaction.data_type}"><strong>Add</strong></a></li>
                                                <li><a href="#" class="text-info open-transaction" data-id="${transaction.id}" data-type="${transaction.data_type}">Open</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            `);
                        });
                    } else {
                        $('#checkModal .transactions-container').parent().remove();
                        $('#checkModal a.close-transactions-container').parent().remove();
                        $('#checkModal a.open-transactions-container').parent().remove();
                    }
                });
            }
        } else {
            $('#checkModal .transactions-container').parent().remove();
            $('#checkModal a.close-transactions-container').parent().remove();
            $('#checkModal a.open-transactions-container').parent().remove();
        }
    });

    $(document).on('change', '#billModal #vendor', function() {
        if ($(this).val() !== '' && $(this).val() !== null) {
            unlinkTransaction();

            $.get('/accounting/get-linkable-transactions/bill/' + $(this).val(), function(res) {
                var transactions = JSON.parse(res);

                if (transactions.length > 0) {
                    if($('#billModal .attachments-container').length > 0) {
                        $('#billModal .attachments-container').parent().parent().remove();
                    }

                    if ($('#billModal .transactions-container').length > 0) {
                        $('#billModal .transactions-container').parent().remove();
                        $('#billModal a.close-transactions-container').parent().remove();
                        $('#billModal a.open-transactions-container').parent().remove();
                    }

                    $('#billModal .modal-body .row .col .card .card-body').children('.row:first-child').prepend(`
                        <div class="col-md-12 px-0 pb-2">
                            <a href="#" class="float-right btn btn-transparent rounded-0 close-transactions-container" style="padding:12px 15px !important">
                                <i class="fa fa-chevron-right"></i>
                            </a>
                        </div>
                    `);

                    $('#billModal .modal-body').children('.row').append(`
                        <div class="col-xl-2">
                            <div class="transactions-container bg-white h-100" style="padding: 15px">
                                <div class="row">
                                    <div class="col-12">
                                        <h4>Add to Bill</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);

                    $.each(transactions, function(index, transaction) {
                        var title = transaction.type;
                        title += transaction.number !== '' ? '#' + transaction.number : '';
                        $('#billModal .modal-body .row .col-xl-2 .transactions-container .row').append(`
                            <div class="col-12">
                                <div class="card border">
                                    <div class="card-body p-0">
                                        <h5 class="card-title">${title}</h5>
                                        <p class="card-subtitle">${transaction.formatted_date}</p>
                                        <p class="card-text">
                                            <strong>Total</strong> ${transaction.total}
                                            ${transaction.type === 'Purchase Order' ? '<br><strong>Balance</strong> '+transaction.balance : ''}
                                        </p>
                                        <ul class="d-flex justify-content-around">
                                            <li><a href="#" class="text-info add-transaction" data-id="${transaction.id}" data-type="${transaction.data_type}"><strong>Add</strong></a></li>
                                            <li><a href="#" class="text-info open-transaction" data-id="${transaction.id}" data-type="${transaction.data_type}">Open</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        `);
                    });
                } else {
                    $('#billModal .transactions-container').parent().remove();
                    $('#billModal a.close-transactions-container').parent().remove();
                    $('#billModal a.open-transactions-container').parent().remove();
                }
            });
        } else {
            $('#billModal .transactions-container').parent().remove();
            $('#billModal a.close-transactions-container').parent().remove();
            $('#billModal a.open-transactions-container').parent().remove();
        }
    });

    $(document).on('change', '#billPaymentModal #vendor', function() {
        if ($(this).val() !== '' && $(this).val() !== null) {
            unlinkTransaction();

            $.get('/accounting/get-linkable-transactions/bill-payment/' + $(this).val(), function(res) {
                var transactions = JSON.parse(res);

                if (transactions.length > 0) {
                    if($('#billPaymentModal .attachments-container').length > 0) {
                        $('#billPaymentModal .attachments-container').parent().parent().remove();
                    }

                    if ($('#billPaymentModal .transactions-container').length > 0) {
                        $('#billPaymentModal .transactions-container').parent().remove();
                        $('#billPaymentModal a.close-transactions-container').parent().remove();
                        $('#billPaymentModal a.open-transactions-container').parent().remove();
                    }

                    $('#billPaymentModal .modal-body .row .col .card .card-body').children('.row:first-child').prepend(`
                        <div class="col-md-12 px-0 pb-2">
                            <a href="#" class="float-right btn btn-transparent rounded-0 close-transactions-container" style="padding:12px 15px !important">
                                <i class="fa fa-chevron-right"></i>
                            </a>
                        </div>
                    `);

                    $('#billPaymentModal .modal-body').children('.row').append(`
                        <div class="col-xl-2">
                            <div class="transactions-container bg-white h-100" style="padding: 15px">
                                <div class="row">
                                    <div class="col-12">
                                        <h4>Add to Bill Payment</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);

                    $.each(transactions, function(index, transaction) {
                        if (transaction.type === 'Bill' && $(`#billPaymentModal input[name="bills[]"][value="${transaction.id}"]`).length === 0 ||
                            transaction.type === 'Vendor Credit' && $(`#billPaymentModal input[name="credits[]"][value="${transaction.id}"]`).length === 0 ||
                            transaction.type === 'Vendor Credit' && $(`#billPaymentModal #vendor-credits-table input[name="credits[]"][value="${transaction.id}"]:checked`).length === 0
                        ) {
                            var title = transaction.type;
                            title += transaction.number !== '' ? '#' + transaction.number : '';
                            $('#billPaymentModal .modal-body .row .col-xl-2 .transactions-container .row').append(`
                                <div class="col-12">
                                    <div class="card border">
                                        <div class="card-body p-0">
                                            <h5 class="card-title">${title}</h5>
                                            <p class="card-subtitle">${transaction.formatted_date}</p>
                                            <p class="card-text">
                                                <strong>Total</strong> ${transaction.total}
                                                ${transaction.type === 'Purchase Order' ? '<br><strong>Balance</strong> '+transaction.balance : ''}
                                            </p>
                                            <ul class="d-flex justify-content-around">
                                                <li><a href="#" class="text-info add-transaction" data-id="${transaction.id}" data-type="${transaction.data_type}"><strong>Add</strong></a></li>
                                                <li><a href="#" class="text-info open-transaction" data-id="${transaction.id}" data-type="${transaction.data_type}">Open</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            `);
                        }
                    });

                    if ($('#billPaymentModal .transactions-container .row .col-12').length < 2) {
                        $('#billPaymentModal .transactions-container').parent().remove();
                        $('#billPaymentModal a.close-transactions-container').parent().remove();
                        $('#billPaymentModal a.open-transactions-container').parent().remove();
                    }
                } else {
                    $('#billPaymentModal .transactions-container').parent().remove();
                    $('#billPaymentModal a.close-transactions-container').parent().remove();
                    $('#billPaymentModal a.open-transactions-container').parent().remove();
                }
            });
        } else {
            $('#billPaymentModal .transactions-container').parent().remove();
            $('#billPaymentModal a.close-transactions-container').parent().remove();
            $('#billPaymentModal a.open-transactions-container').parent().remove();
        }
    });

    $(document).on('click', '#modal-container .modal .transactions-container a.add-transaction', function(e) {
        e.preventDefault();
        var data = e.currentTarget.dataset;

        switch (data.type) {
            case 'purchase-order':
                $.get(`/accounting/get-transaction-details/${data.type}/${data.id}`, function(res) {
                    var result = JSON.parse(res);
                    var categories = result.categories;
                    var items = result.items;
                    var details = result.details;

                    var count = 0;

                    var dataType = data.type.replace('-', ' ').replace(/(?:^|\s)\S/g, function(a) { return a.toUpperCase(); });
                    var date = new Date(details.purchase_order_date);
                    var dateString = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();

                    var link = `
                    <td>
                        <div class="dropdown">
                            <a href="#" class="text-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-link"></i></a>
                            <div class="dropdown-menu dropdown-menu-right p-2" aria-labelledby="linked-transaction" style="min-width: 500px; font-size: 13px">
                                <div class="row">
                                    <div class="col-3"><strong>Type</strong></div>
                                    <div class="col-3"><strong>Date</strong></div>
                                    <div class="col-3"><strong>Amount</strong></div>
                                    <div class="col-3"></div>
                                    <div class="col-3 d-flex align-items-center"><a class="text-info open-transaction" href="#" data-id="${data.id}" data-type="${data.type}">${dataType}</a></div>
                                    <div class="col-3 d-flex align-items-center">${dateString}</div>
                                    <div class="col-3 d-flex align-items-center">$${parseFloat(details.remaining_balance).toFixed(2)}</div>
                                    <div class="col-3 d-flex align-items-center"><button class="btn btn-transparent unlink-transaction" style="font-size: 13px !important">Remove</button></div>
                                </div>
                            </div>
                        </div>
                    </td>
                    `;

                    $('#modal-container .modal table#category-details-table thead tr').append('<th></th>');
                    $('#modal-container .modal table#category-details-table tbody tr').each(function() {
                        if ($(this).find('select').length === 0) {
                            $(this).remove();
                        } else {
                            $(this).find('td:last-child').html('');
                            $(this).append('<td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>');
                            count++;
                        }
                    });

                    if (categories.length > 0) {
                        $.each(categories, function(index, category) {
                            count++;
                            $('#modal-container .modal table#category-details-table tbody').append(`<tr>${catDetailsInputs}</tr>`);
                            $('#modal-container .modal table#category-details-table tbody tr:last-child td:nth-child(2)').html(count);
                            $(link).insertBefore($('#modal-container .modal table#category-details-table tbody tr:last-child td:last-child'));
                            $('#modal-container .modal table#category-details-table tbody tr:last-child select[name="expense_name[]"]').val(category.expense_account_id);
                            $('#modal-container .modal table#category-details-table tbody tr:last-child select[name="category[]"]').val(category.category);
                            $('#modal-container .modal table#category-details-table tbody tr:last-child input[name="description[]"]').val(category.description);
                            $('#modal-container .modal table#category-details-table tbody tr:last-child input[name="category_amount[]"]').val(parseFloat(category.amount).toFixed(2));
                            $('#modal-container .modal table#category-details-table tbody tr:last-child input[name="category_billable[]"]').prop('checked', category.billable === "1");
                            $('#modal-container .modal table#category-details-table tbody tr:last-child input[name="category_markup[]"]').val(parseFloat(category.markup_percentage).toFixed(2));
                            $('#modal-container .modal table#category-details-table tbody tr:last-child input[name="category_tax[]"]').prop('checked', category.tax === "1");
                            $('#modal-container .modal table#category-details-table tbody tr:last-child select[name="category_customer[]"]').val(category.customer_id);
                        });

                        $('#modal-container .modal table#category-details-table tbody select').select2();
                    }

                    if (count === 1) {
                        $('#modal-container .modal table#category-details-table tbody').append(`<tr>${catDetailsBlank}</tr>`);
                        $('#modal-container .modal table#category-details-table tbody tr:last-child td:nth-child(2)').html(count + 1);
                        $(`<td></td>`).insertBefore($('#modal-container .modal table#category-details-table tbody tr:last-child td:last-child'));
                    }

                    $('#modal-container .modal table#item-details-table thead tr').append('<th></th>');
                    if (items.length > 0) {
                        if ($('#modal-container .modal #item-details').hasClass('show') === false) {
                            $('#modal-container .modal button[data-target="#item-details"]').trigger('click');
                        }

                        $.each(items, function(index, item) {
                            var locs = '';
                            for (var i in item.locations) {
                                locs += `<option value="${item.locations[i].id}" data-quantity="${item.locations[i].qty === "null" ? 0 : item.locations[i].qty}" ${item.locations[i].id === item.location_id ? 'selected' : ''}>${item.locations[i].name}</option>`;
                            }

                            if ($('#modal-container form#modal-form .modal').attr('id') === 'creditCardCreditModal' || $('#modal-container form#modal-form .modal').attr('id') === 'vendorCreditModal') {
                                var qtyField = `<input type="number" name="quantity[]" class="form-control text-right" required value="0" max="${item.locations[0].qty}">`;
                            } else {
                                var qtyField = `<input type="number" name="quantity[]" class="form-control text-right" required value="0">`;
                            }

                            $('#modal-container .modal table#item-details-table tbody').append(`
                                <tr>
                                    <td>${item.details.title}<input type="hidden" name="item[]" value="${item.item_id}"></td>
                                    <td>Product</td>
                                    <td><select name="location[]" class="form-control" required>${locs}</select></td>
                                    <td><input type="number" name="quantity[]" class="form-control text-right" required value="${item.quantity}" min="0"></td>
                                    <td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="${parseFloat(item.rate).toFixed(2)}"></td>
                                    <td><input type="number" name="discount[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="${parseFloat(item.discount).toFixed(2)}"></td>
                                    <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="${parseFloat(item.tax).toFixed(2)}"></td>
                                    <td><span class="row-total">${formatter.format(parseFloat(itemTotal))}</span></td>
                                    ${link}
                                    <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
                                </tr>
                            `);
                        });

                        $('#modal-container .modal table#item-details-table tbody select').select2();
                    }

                    computeTransactionTotal();

                    $('#modal-container .modal .transactions-container').parent().remove();

                    if ($('#modal-container .modal a.close-transactions-container').length > 0) {
                        var button = $('#modal-container .modal a.close-transactions-container');
                    } else {
                        var button = $('#modal-container .modal a.open-transactions-container');
                    }

                    button.parent().removeClass('px-0');
                    button.parent().append(`<input type="hidden" value="${data.type.replace('-', '_')+'-'+details.id}" name="linked_transaction">`);
                    button.parent().append(`
                        <div class="dropdown">
                            <a href="#" class="text-info" id="linked-transaction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">1 linked ${dataType}</a>
                            <div class="dropdown-menu p-2" aria-labelledby="linked-transaction" style="min-width: 500px; font-size: 13px">
                                <div class="row">
                                    <div class="col-3"><strong>Type</strong></div>
                                    <div class="col-3"><strong>Date</strong></div>
                                    <div class="col-3"><strong>Amount</strong></div>
                                    <div class="col-3"></div>
                                    <div class="col-3 d-flex align-items-center"><a class="text-info open-transaction" href="#" data-id="${data.id}" data-type="${data.type}">${dataType}</a></div>
                                    <div class="col-3 d-flex align-items-center">${dateString}</div>
                                    <div class="col-3 d-flex align-items-center">$${parseFloat(details.remaining_balance).toFixed(2)}</div>
                                    <div class="col-3 d-flex align-items-center"><button class="btn btn-transparent unlink-transaction" style="font-size: 13px !important">Remove</button></div>
                                </div>
                            </div>
                        </div>
                    `);

                    button.remove();
                });
                break;
            case 'bill':
                if ($('#modal-container .modal').attr('id') !== 'billPaymentModal') {
                    var modalId = $('#modal-container .modal').attr('id');
                    $('#modal-container .modal').modal('hide');

                    $.get('/accounting/bill-payment-form/' + data.id, function(res) {
                        if ($('div#modal-container').length > 0) {
                            $('div#modal-container').html(res);
                        } else {
                            $('body').append(`
                                <div id="modal-container"> 
                                    ${res}
                                </div>
                            `);
                        }

                        if(modalId === 'expenseModal') {
                            $('#billPaymentModal #payment_account').prev().attr('for', 'expense_payment_account');
                            $('#billPaymentModal #payment_account').attr('id', 'expense_payment_account');
                        } else if(modalId === 'checkModal') {
                            $('#billPaymentModal #payment_account').prev().html('Bank account');
                            $('#billPaymentModal #payment_account').prev().attr('for', 'bank_account');
                            $('#billPaymentModal #payment_account').attr('id', 'bank_account');
                        }

                        initModalFields('billPaymentModal');

                        $(`#billPaymentModal #payee`).trigger('change');

                        $('#billPaymentModal .card-body').children('.row:first-child').prepend(`<input type="hidden" name="bills[]" value="${data.id}">`);

                        loadBillPaymentBills();
                        loadBillPaymentCredits();

                        $(`#billPaymentModal`).modal('show');
                    });
                } else {
                    $('#billPaymentModal .card-body').children('.row:first-child').prepend(`<input type="hidden" name="bills[]" value="${data.id}">`);

                    if ($(`#billPaymentModal #bills-table input[type="checkbox"][value="${data.id}"]`).length > 0) {
                        $(`#billPaymentModal #bills-table input[type="checkbox"][value="${data.id}"]`).prop('checked', true);
                        var row = $(`#billPaymentModal #bills-table input[type="checkbox"][value="${data.id}"]`).parent().parent().parent();
                        var rowData = $('#billPaymentModal #bills-table').DataTable().row(row).data();
                        row.find('input[name="bill_payment[]"]').val(rowData.payment).trigger('change');
                    }

                    $(this).parent().parent().parent().parent().parent().remove();

                    if ($('#billPaymentModal .transactions-container .row div.col-12').length === 1) {
                        $('#billPaymentModal .transactions-container').parent().remove();
                        $('#billPaymentModal a.close-transactions-container').parent().remove();
                        $('#billPaymentModal a.open-transactions-container').parent().remove();
                    }
                }
                break;
            case 'vendor-credit':
                if ($('#modal-container .modal').attr('id') === 'billPaymentModal') {
                    $('#billPaymentModal .card-body').children('.row:first-child').prepend(`<input type="hidden" name="credits[]" value="${data.id}">`);

                    if ($(`#billPaymentModal #vendor-credits-table input[type="checkbox"][value="${data.id}"]`).length > 0) {
                        $(`#billPaymentModal #vendor-credits-table input[type="checkbox"][value="${data.id}"]`).prop('checked', true);
                        var row = $(`#billPaymentModal #vendor-credits-table input[type="checkbox"][value="${data.id}"]`).parent().parent().parent();
                        var rowData = $('#billPaymentModal #vendor-credits-table').DataTable().row(row).data();
                        row.find('input[name="credit_payment[]"]').val(rowData.payment).trigger('change');
                    }

                    $(this).parent().parent().parent().parent().parent().remove();

                    if ($('#billPaymentModal .transactions-container .row div.col-12').length === 1) {
                        $('#billPaymentModal .transactions-container').parent().remove();
                        $('#billPaymentModal a.close-transactions-container').parent().remove();
                        $('#billPaymentModal a.open-transactions-container').parent().remove();
                    }
                } else {

                }
                break;
        }
    });

    $(document).on('click', '#modal-container .modal .unlink-transaction', function(e) {
        e.preventDefault();

        unlinkTransaction();

        $('#modal-container .modal #payee').trigger('change');
        $('#modal-container .modal #vendor').trigger('change');
    });

    $(document).on('click', '#modal-container .modal a.open-transaction', function(e) {
        e.preventDefault();
        var id = e.currentTarget.dataset.id;
        var type = e.currentTarget.dataset.type;

        $('#modal-container .modal').modal('hide');

        switch (type) {
            case 'purchase-order':
                var modalName = 'purchaseOrderModal';
                break;
            case 'bill':
                var modalName = 'billModal';
                break;
            case 'vendor-credit':
                var modalName = 'vendorCreditModal';
                break;
        }

        $.get(`/accounting/vendors/view-${type}/` + id, function(res) {
            if ($('div#modal-container').length > 0) {
                $('div#modal-container').html(res);
            } else {
                $('body').append(`
                    <div id="modal-container"> 
                        ${res}
                    </div>
                `);
            }

            initModalFields(modalName, { id: id, type: type });

            $(`#${modalName} #payee`).trigger('change');

            $(`#${modalName}`).modal('show');
        });
    });

    $(document).on('click', '#modal-container .modal a.close-transactions-container', function(e) {
        e.preventDefault();

        $('#modal-container .modal .transactions-container').parent().hide();

        $(this).removeClass('close-transactions-container');
        $(this).addClass('open-transactions-container');
        $(this).children().removeClass('fa-chevron-right');
        $(this).children().addClass('fa-chevron-left');
    });

    $(document).on('click', '#modal-container .modal a.open-transactions-container', function(e) {
        e.preventDefault();

        $('#modal-container .modal .transactions-container').parent().show();

        $(this).removeClass('open-transactions-container');
        $(this).addClass('close-transactions-container');
        $(this).children().removeClass('fa-chevron-left');
        $(this).children().addClass('fa-chevron-right');
    });

    $(document).on('click', '#billPaymentModal .dropdown-menu', function(e) {
        e.stopPropagation();
    });

    $(document).on('keyup', '#billPaymentModal #search-bill-no', function() {
        $('#billPaymentModal #bills-table').DataTable().ajax.reload(function(json) {
            if ($('#billPaymentModal #search-bill-no').val() === '' && $('#billPaymentModal #search-vcredit-no').val() === '') {
                $('#billPaymentModal #bills-table input[name="bill_payment[]"]:last-child').trigger('change');
            } else {
                $('#billPaymentModal #bill-payment-amount').val('0.00');
                $('#billPaymentModal .payment-total-amount').html('0.00');
            }
        }, true);
    });

    $(document).on('change', '#billPaymentModal #bills_table_rows', function() {
        $('#billPaymentModal #bills-table').DataTable().ajax.reload(null, true);
    });

    $(document).on('click', '#billPaymentModal #apply-btn', function(e) {
        e.preventDefault();

        $('#billPaymentModal #bills-table').DataTable().ajax.reload(null, true);
    });

    $(document).on('click', '#billPaymentModal #reset-btn', function(e) {
        e.preventDefault();

        if ($('#billPaymentModal input[name="bills[]"]').length > 1) {
            var length = $('#billPaymentModal input[name="bills[]"]').length;
            var id = $($('#billPaymentModal input[name="bills[]"]')[length - 1]).val();
        } else {
            var id = $('#billPaymentModal input[name="bills[]"]').val();
        }

        $.get('/accounting/get-transaction-details/bill/' + id, function(res) {
            var result = JSON.parse(res);

            var date = new Date(result.details.bill_date);
            var dateString = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();

            $('#billPaymentModal #bills-from').val(dateString).trigger('change');
            $('#billPaymentModal #bills-to').val(dateString).trigger('change');
        });

        $('#billPaymentModal #bills-table').DataTable().ajax.reload(null, true);
    });

    $(document).on('click', '#billPaymentModal #bills-table tbody a', function(e) {
        e.preventDefault();
        var id = e.currentTarget.dataset.id;

        $('#modal-container .modal').modal('hide');

        $.get(`/accounting/vendors/view-bill/` + id, function(res) {
            if ($('div#modal-container').length > 0) {
                $('div#modal-container').html(res);
            } else {
                $('body').append(`
                    <div id="modal-container"> 
                        ${res}
                    </div>
                `);
            }

            initModalFields('billModal', { id: id, type: 'bill' });

            $(`#billModal #payee`).trigger('change');

            $(`#billModal`).modal('show');
        });
    });

    $(document).on('click', '#billPaymentModal #vendor-credits-table tbody a', function(e) {
        e.preventDefault();
        var id = e.currentTarget.dataset.id;

        $('#modal-container .modal').modal('hide');

        $.get(`/accounting/vendors/view-vendor-credit/` + id, function(res) {
            if ($('div#modal-container').length > 0) {
                $('div#modal-container').html(res);
            } else {
                $('body').append(`
                    <div id="modal-container"> 
                        ${res}
                    </div>
                `);
            }

            initModalFields('vendorCreditModal', { id: id, type: 'vendor-credit' });

            $(`#vendorCreditModal #payee`).trigger('change');

            $(`#vendorCreditModal`).modal('show');
        });
    });

    $(document).on('change', '#billPaymentModal #bills-table tbody input[type="checkbox"]', function() {
        var value = $(this).val();
        var row = $(`#billPaymentModal #bills-table input[type="checkbox"][value="${value}"]`).parent().parent().parent();

        if ($(this).prop('checked') === false) {
            $(`#billPaymentModal input[name="bills[]"][value="${value}"]`).remove();
            row.find('input[name="bill_payment[]"]').val('').trigger('change');
        } else {
            $('#billPaymentModal .card-body').children('.row:first-child').prepend(`<input type="hidden" name="bills[]" value="${value}">`);

            $(`#billPaymentModal #bills-table input[type="checkbox"][value="${value}"]`).prop('checked', true);
            var rowData = $('#billPaymentModal #bills-table').DataTable().row(row).data();
            row.find('input[name="bill_payment[]"]').val(rowData.payment).trigger('change');
        }

        $.get('/accounting/get-linkable-transactions/bill-payment/' + $('#billPaymentModal #payee').val(), function(res) {
            var transactions = JSON.parse(res);

            if (transactions.length > 0) {
                if ($('#billPaymentModal .transactions-container').length > 0) {
                    $('#billPaymentModal .transactions-container').parent().remove();
                    $('#billPaymentModal a.close-transactions-container').parent().remove();
                    $('#billPaymentModal a.open-transactions-container').parent().remove();
                }

                $('#billPaymentModal .modal-body .row .col .card .card-body').children('.row:first-child').prepend(`
                    <div class="col-md-12 px-0 pb-2">
                        <a href="#" class="float-right btn btn-transparent rounded-0 close-transactions-container" style="padding:12px 15px !important">
                            <i class="fa fa-chevron-right"></i>
                        </a>
                    </div>
                `);

                $('#billPaymentModal .modal-body').children('.row').append(`
                    <div class="col-xl-2">
                        <div class="transactions-container bg-white h-100" style="padding: 15px">
                            <div class="row">
                                <div class="col-12">
                                    <h4>Add to Bill Payment</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                `);

                $.each(transactions, function(index, transaction) {
                    if (transaction.type === 'Bill' && $(`#billPaymentModal input[name="bills[]"][value="${transaction.id}"]`).length === 0 ||
                        transaction.type === 'Vendor Credit' && $(`#billPaymentModal input[name="credits[]"][value="${transaction.id}"]`).length === 0
                    ) {
                        var title = transaction.type;
                        title += transaction.number !== '' ? '#' + transaction.number : '';
                        $('#billPaymentModal .modal-body .row .col-xl-2 .transactions-container .row').append(`
                            <div class="col-12">
                                <div class="card border">
                                    <div class="card-body p-0">
                                        <h5 class="card-title">${title}</h5>
                                        <p class="card-subtitle">${transaction.formatted_date}</p>
                                        <p class="card-text">
                                            <strong>Total</strong> ${transaction.total}
                                            ${transaction.type === 'Purchase Order' ? '<br><strong>Balance</strong> '+transaction.balance : ''}
                                        </p>
                                        <ul class="d-flex justify-content-around">
                                            <li><a href="#" class="text-info add-transaction" data-id="${transaction.id}" data-type="${transaction.data_type}"><strong>Add</strong></a></li>
                                            <li><a href="#" class="text-info open-transaction" data-id="${transaction.id}" data-type="${transaction.data_type}">Open</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        `);
                    }
                });

                if ($('#billPaymentModal .transactions-container .row div.col-12').length === 1) {
                    $('#billPaymentModal .transactions-container').parent().remove();
                    $('#billPaymentModal a.close-transactions-container').parent().remove();
                    $('#billPaymentModal a.open-transactions-container').parent().remove();
                }
            } else {
                $('#billPaymentModal .transactions-container').parent().remove();
                $('#billPaymentModal a.close-transactions-container').parent().remove();
                $('#billPaymentModal a.open-transactions-container').parent().remove();
            }
        });
    });

    $(document).on('keyup', '#billPaymentModal #search-vcredit-no', function() {
        $('#billPaymentModal #vendor-credits-table').DataTable().ajax.reload(function(json) {
            if ($('#billPaymentModal #search-vcredit-no').val() === '' && $('#billPaymentModal #search-bill-no').val() === '') {
                $('#billPaymentModal #vendor-credits-table input[name="credit_payment[]"]:last-child').trigger('change');
            } else {
                $('#billPaymentModal #bill-payment-amount').val('0.00');
                $('#billPaymentModal .payment-total-amount').html('0.00');
            }
        }, true);
    });

    $(document).on('change', '#billPaymentModal #vcredits_table_rows', function() {
        $('#billPaymentModal #vendor-credits-table').DataTable().ajax.reload(null, true);
    });

    $(document).on('click', '#billPaymentModal #vcredits-apply-btn', function(e) {
        e.preventDefault();

        $('#billPaymentModal #vendor-credits-table').DataTable().ajax.reload(null, true);
    });

    $(document).on('click', '#billPaymentModal #vcredits-reset-btn', function(e) {
        e.preventDefault();

        $('#billPaymentModal #vcredit-from').val('').trigger('change');
        $('#billPaymentModal #vcredit-to').val('').trigger('change');
        $('#billPaymentModal #vendor-credits-table').DataTable().ajax.reload(null, true);
    });

    $(document).on('change', '#billPaymentModal #vendor-credits-table tbody input[type="checkbox"]', function() {
        var value = $(this).val();
        var row = $(`#billPaymentModal #vendor-credits-table input[type="checkbox"][value="${value}"]`).parent().parent().parent();

        if ($(this).prop('checked') === false) {
            $(`#billPaymentModal input[name="credits[]"][value="${value}"]`).remove();
            row.find('input[name="credit_payment[]"]').val('').trigger('change');
        } else {
            $('#billPaymentModal .card-body').children('.row:first-child').prepend(`<input type="hidden" name="credits[]" value="${value}">`);

            $(`#billPaymentModal #vendor-credits-table input[type="checkbox"][value="${value}"]`).prop('checked', true);
            var rowData = $('#billPaymentModal #vendor-credits-table').DataTable().row(row).data();
            row.find('input[name="credit_payment[]"]').val(rowData.payment).trigger('change');
        }

        $.get('/accounting/get-linkable-transactions/bill-payment/' + $('#billPaymentModal #payee').val(), function(res) {
            var transactions = JSON.parse(res);

            if (transactions.length > 0) {
                if ($('#billPaymentModal .transactions-container').length > 0) {
                    $('#billPaymentModal .transactions-container').parent().remove();
                    $('#billPaymentModal a.close-transactions-container').parent().remove();
                    $('#billPaymentModal a.open-transactions-container').parent().remove();
                }

                $('#billPaymentModal .modal-body .row .col .card .card-body').children('.row:first-child').prepend(`
                    <div class="col-md-12 px-0 pb-2">
                        <a href="#" class="float-right btn btn-transparent rounded-0 close-transactions-container" style="padding:12px 15px !important">
                            <i class="fa fa-chevron-right"></i>
                        </a>
                    </div>
                `);

                $('#billPaymentModal .modal-body').children('.row').append(`
                    <div class="col-xl-2">
                        <div class="transactions-container bg-white h-100" style="padding: 15px">
                            <div class="row">
                                <div class="col-12">
                                    <h4>Add to Bill Payment</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                `);

                $.each(transactions, function(index, transaction) {
                    if (transaction.type === 'Bill' && $(`#billPaymentModal input[name="bills[]"][value="${transaction.id}"]`).length === 0 ||
                        transaction.type === 'Vendor Credit' && $(`#billPaymentModal input[name="credits[]"][value="${transaction.id}"]`).length === 0
                    ) {
                        var title = transaction.type;
                        title += transaction.number !== '' ? '#' + transaction.number : '';
                        $('#billPaymentModal .modal-body .row .col-xl-2 .transactions-container .row').append(`
                            <div class="col-12">
                                <div class="card border">
                                    <div class="card-body p-0">
                                        <h5 class="card-title">${title}</h5>
                                        <p class="card-subtitle">${transaction.formatted_date}</p>
                                        <p class="card-text">
                                            <strong>Total</strong> ${transaction.total}
                                            ${transaction.type === 'Purchase Order' ? '<br><strong>Balance</strong> '+transaction.balance : ''}
                                        </p>
                                        <ul class="d-flex justify-content-around">
                                            <li><a href="#" class="text-info add-transaction" data-id="${transaction.id}" data-type="${transaction.data_type}"><strong>Add</strong></a></li>
                                            <li><a href="#" class="text-info open-transaction" data-id="${transaction.id}" data-type="${transaction.data_type}">Open</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        `);
                    }
                });

                if ($('#billPaymentModal .transactions-container .row div.col-12').length === 1) {
                    $('#billPaymentModal .transactions-container').parent().remove();
                    $('#billPaymentModal a.close-transactions-container').parent().remove();
                    $('#billPaymentModal a.open-transactions-container').parent().remove();
                }
            } else {
                $('#billPaymentModal .transactions-container').parent().remove();
                $('#billPaymentModal a.close-transactions-container').parent().remove();
                $('#billPaymentModal a.open-transactions-container').parent().remove();
            }
        });
    });

    $(document).on('change', '#billPaymentModal input[name="credit_payment[]"], #billPaymentModal input[name="bill_payment[]"]', function() {
        var billPayment = 0.00;
        $('#billPaymentModal #bills-table tbody tr').each(function() {
            if ($(this).find('input[type="checkbox"]').prop('checked')) {
                billPayment += $(this).find('input[name="bill_payment[]"]').val() !== "" ? parseFloat($(this).find('input[name="bill_payment[]"]').val()) : 0.00;
            }
        });

        $('#billPaymentModal span.amount-to-apply').html(formatter.format(parseFloat(billPayment)));

        var creditPayment = 0.00;
        $('#billPaymentModal #vendor-credits-table tbody tr').each(function() {
            if ($(this).find('input[type="checkbox"]').prop('checked')) {
                creditPayment += $(this).find('input[name="credit_payment[]"]').val() !== "" ? parseFloat($(this).find('input[name="credit_payment[]"]').val()) : 0.00;
            }
        });

        $('#billPaymentModal span.amount-to-credit').html(formatter.format(parseFloat(creditPayment)));

        billPayment = parseFloat(billPayment.replace('$', '').replaceAll(',', ''));
        creditPayment = parseFloat(creditPayment.replace('$', '').replaceAll(',', ''));

        var amountPaid = parseFloat(billPayment - creditPayment).toFixed(2);

        $('#billPaymentModal #bill-payment-amount').val(amountPaid);
        $('#billPaymentModal .payment-total-amount').html(formatter.format(parseFloat(amountPaid)));
    });

    $(document).on('click', '#billPaymentModal #clear-payment', function(e) {
        e.preventDefault();

        $('#billPaymentModal input[name="bills[]"]').remove();
        $('#billPaymentModal input[name="credits[]"]').remove();

        $('#billPaymentModal #bills-table').DataTable().ajax.reload(function(json) {
            $('#billPaymentModal #bills-table input[name="bill_payment[]"]:last-child').trigger('change');
        }, true);

        $('#billPaymentModal #vendor-credits-table').DataTable().ajax.reload(function(json) {
            $('#billPaymentModal #vendor-credits-table input[name="credit_payment[]"]:last-child').trigger('change');
        }, true);
    });

    $(document).on('change', '#payBillsModal #print_later', function() {
        if ($(this).prop('checked')) {
            $('#payBillsModal #starting_check_no').val('To print').prop('disabled', true);
        } else {
            $('#payBillsModal #starting_check_no').val('').prop('disabled', false);
        }
    });

    $(document).on('change', '#printChecksModal #payment_account, #printChecksModal #sort, #printChecksModal #check-type', function() {
        $('#printChecksModal #checks-table').DataTable().ajax.reload(null, true);
    });

    $(document).on('change', '#printChecksModal #checks-table #select-all-checks', function() {
        $('#printChecksModal #checks-table tbody tr input[type="checkbox"]').prop('checked', $(this).prop('checked')).trigger('change');
    });

    $(document).on('change', '#printChecksModal #checks-table tbody tr input[type="checkbox"]', function() {
        $('#printChecksModal #selected-checks').html($('#printChecksModal #checks-table tbody tr input[type="checkbox"]:checked').length);

        var notChecked = $('#printChecksModal #checks-table tbody tr input[type="checkbox"]:not(:checked)').length;
        $('#printChecksModal #checks-table #select-all-checks').prop('checked', notChecked === 0);

        var selectedTotal = parseFloat($('#printChecksModal #selected-checks-total').html().replaceAll(',', ''));
        var row = $(this).parent().parent().parent();
        var rowData = $('#printChecksModal #checks-table').DataTable().row(row).data();

        if ($(this).prop('checked')) {
            selectedTotal += parseFloat(rowData.amount.replace('$', '').replaceAll(',', ''));
        } else {
            selectedTotal -= parseFloat(rowData.amount.replace('$', '').replaceAll(',', ''));
        }

        $('#printChecksModal #selected-checks-total').html(parseFloat(selectedTotal).toFixed(2));
    });

    $(document).on('click', '#printChecksModal #add-check-button', function() {
        $('#printChecksModal').modal('hide');
        $('.modal-backdrop:last-child').remove();

        $('#new-popup #accounting_vendors a[data-target="#checkModal"]').trigger('click');
    });

    $(document).on('click', '#printChecksModal #remove-from-list', function() {
        var data = new FormData();

        $('#printChecksModal #checks-table tbody tr input[type="checkbox"]:checked').each(function() {
            var row = $(this).parent().parent().parent();
            var rowData = $('#printChecksModal #checks-table').DataTable().row(row).data();
            var transactionType = rowData.type;
            transactionType = transactionType.replaceAll(' (Check)', '');
            transactionType = transactionType.replaceAll(' (Credit Card)', '');
            transactionType = transactionType.replaceAll(' ', '-');
            transactionType = transactionType.toLowerCase();

            if (data.has('id[]') === false) {
                data.set('id[]', $(this).val());
                data.set('type[]', transactionType);
            } else {
                data.append('id[]', $(this).val());
                data.append('type[]', transactionType);
            }
        });

        $.ajax({
            url: '/accounting/remove-to-print',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function(result) {
                var res = JSON.parse(result);

                toast(res.success, res.message);

                $('#printChecksModal #checks-table').DataTable().ajax.reload(null, true);
                $('#printChecksModal #checks-table #select-all-checks').prop('checked', false);
                $('#printChecksModal #selected-checks-total').html('0.00');
                $('#printChecksModal #selected-checks').html('0');
            }
        });
    });

    $(document).on('click', '#printChecksModal #preview-and-print', function(e) {
        e.preventDefault();

        if ($('#printChecksModal #checks-table tbody tr input[type="checkbox"]:checked').length > 0) {
            var form = document.getElementById('modal-form');

            if ($('#printChecksModal #starting-check-no').val() === '') {
                Swal.fire({
                    text: "Please enter a value for the Starting check no. field.",
                    icon: 'warning',
                    showCloseButton: true,
                    confirmButtonColor: '#2ca01c',
                    confirmButtonText: 'OK',
                    timer: 2000
                })
            } else {
                var data = new FormData(form);
                data.delete('sort');
                data.delete('check_type');
                data.delete('table_rows');

                $('#printChecksModal #checks-table tbody tr input[type="checkbox"]:checked').each(function() {
                    var row = $(this).parent().parent().parent();
                    var rowData = $('#printChecksModal #checks-table').DataTable().row(row).data();
                    var transactionType = rowData.type;
                    transactionType = transactionType.replaceAll(' (Check)', '');
                    transactionType = transactionType.replaceAll(' (Credit Card)', '');
                    transactionType = transactionType.replaceAll(' ', '-');
                    transactionType = transactionType.toLowerCase();

                    if (data.has('id[]') === false) {
                        data.set('id[]', $(this).val());
                        data.set('type[]', transactionType);
                    } else {
                        data.append('id[]', $(this).val());
                        data.append('type[]', transactionType);
                    }
                });

                $.ajax({
                    url: '/accounting/print-preview-checks',
                    data: data,
                    type: 'post',
                    processData: false,
                    contentType: false,
                    success: function(result) {
                        $('div#modal-container').append(result);

                        $('#viewPrintChecksModal').modal('show');
                    }
                });
            }
        } else {
            Swal.fire({
                text: "You need to select a check to print.",
                icon: 'warning',
                showCloseButton: true,
                confirmButtonColor: '#2ca01c',
                confirmButtonText: 'OK'
            })
        }
    });

    $(document).on('click', '#viewPrintChecksModal #preview-and-print', function(e) {
        e.preventDefault();

        let pdfWindow = window.open("");
        pdfWindow.document.write(`<iframe width="100%" height="100%" src="${$('#viewPrintChecksModal iframe').attr('src')}"></iframe>`);
        $(pdfWindow.document).find('body').css('padding', '0');
        $(pdfWindow.document).find('body').css('margin', '0');
        $(pdfWindow.document).find('iframe').css('border', '0');
    });

    $(document).on('hidden.bs.modal', '#viewPrintChecksModal', function() {
        $(this).parent().parent().next('.modal-backdrop').remove();
        $(this).parent().remove();

        var data = new FormData();
        data.set('starting_check_no', $('#printChecksModal #starting-check-no').val());

        $('#printChecksModal #checks-table tbody tr input[type="checkbox"]:checked').each(function() {
            if (data.has('checks_selected[]')) {
                data.append('checks_selected[]', $(this).val());
            } else {
                data.set('checks_selected[]', $(this).val());
            }
        });

        $.ajax({
            url: '/accounting/success-print-checks-modal',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function(result) {
                $('div#modal-container').append(result);

                $('#successPrintCheck select').select2({
                    dropdownParent: $('#successPrintCheck'),
                    minimumResultsForSearch: -1
                });
                $('#successPrintCheck').modal('show');
            }
        });
    });

    $(document).on('hidden.bs.modal', '#successPrintCheck', function() {
        $(this).parent().parent().next('.modal-backdrop').remove();
        $(this).parent().remove();
        $('#printChecksModal #checks-table thead input').prop('checked', false);
        $('#printChecksModal #selected-checks').html('0');
        $('#printChecksModal #selected-checks-total').html('0.00');
        $('#printChecksModal #checks-table').DataTable().ajax.reload(null, true);
    });

    $(document).on('submit', '#modal-container #successPrintCheck #print-success-form', function(e) {
        e.preventDefault();

        var data = new FormData(this);

        $('#printChecksModal #checks-table tbody tr input[type="checkbox"]:checked').each(function() {
            var row = $(this).parent().parent().parent();
            var rowData = $('#printChecksModal #checks-table').DataTable().row(row).data();
            var transactionType = rowData.type;
            transactionType = transactionType.replaceAll(' (Check)', '');
            transactionType = transactionType.replaceAll(' (Credit Card)', '');
            transactionType = transactionType.replaceAll(' ', '-');
            transactionType = transactionType.toLowerCase();

            if (data.has('checks_selected[]')) {
                data.append('checks_selected[]', $(this).val());
                data.append('type[]', transactionType);
            } else {
                data.set('checks_selected[]', $(this).val());
                data.set('type[]', transactionType);
            }
        });

        data.set('payment_account', $('#printChecksModal #payment_account').val());

        $.ajax({
            url: '/accounting/success-print-checks',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function(result) {
                $('#successPrintCheck').modal('hide');
            }
        });
    });

    $(document).on('click', '#purchaseOrderModal .modal-footer #save-and-print', function(e) {
        e.preventDefault();

        submitType = 'save-and-print';

        $(this).attr('id', 'print-purchase-order');
        $('#modal-container form#modal-form').submit();
    });

    $(document).on('click', '#purchaseOrderModal .modal-footer #save-and-send', function(e) {
        e.preventDefault();

        submitType = 'save-and-send';

        $('#modal-container form#modal-form').submit();
    });

    // $(document).on('click', '#purchaseOrderModal .modal-footer #print-purchase-order', function(e) {
    //     e.preventDefault();

    //     printPurchaseOrder();
    // });

    $(document).on('click', '#modal-container #modal-form .modal .modal-footer #save', function(e) {
        e.preventDefault();

        submitType = $(this).attr('id');

        $('#modal-container form#modal-form').submit();
    });

    $(document).on('click', '#singleTimeModal #time-activity-settings-button, #weeklyTimesheetModal #time-activity-settings-button', function(e) {
        e.preventDefault();

        if ($('#singleTimeModal').length > 0) {
            $('#singleTimeModal').parent().prev().modal('show');
        } else {
            $('#weeklyTimesheetModal').parent().prev().modal('show');
        }
    });

    $(document).on('change', '#time-activity-settings #toggle-service, #time-activity-settings #toggle-billable, #time-activity-settings #toggle-cost_rates', function(e) {
        var field = $(this).attr('id').replace('toggle-', '');
        var value = $(this).prop('checked') ? 1 : 0;
        $.get(`/accounting/update-timesheet-settings/${field}/${value}`, function(res) {
            if (res === 'true') {
                switch (field) {
                    case 'service':
                        if (value === 1) {
                            $('#singleTimeModal').find('#service').prop('required', true).parent().removeClass('hide');
                            $('#weeklyTimesheetModal').find('select[name="service[]"]').prop('required', true).parent().removeClass('hide');
                        } else {
                            $('#singleTimeModal').find('#service').prop('required', false).parent().addClass('hide');
                            $('#weeklyTimesheetModal').find('select[name="service[]"]').prop('required', false).parent().addClass('hide');
                        }
                        break;
                    case 'billable':
                        if (value === 1) {
                            $('#singleTimeModal').next().children('div.modal').find('.card-body').children('.row:nth-child(2)').children('div:first-child()').append(`
                            <div class="form-check form-check-inline">
                                <div class="checkbox checkbox-sec margin-right ">
                                    <input class="form-check-input" type="checkbox" name="billable" id="billable" value="1" onclick="showHiddenFields(this)">
                                    <label class="form-check-label" for="billable">Billable(/hr)</label>
                                </div>
                                <input type="number" name="hourly_rate" id="hourlyRate" class="w-25 form-control hide">
                            </div>
                            <div class="form-check hide">
                                <div class="checkbox checkbox-sec">
                                    <input type="checkbox" name="taxable" id="taxable" class="form-check-input" value="1">
                                    <label for="taxable" class="form-check-label">Taxable</label>
                                </div>
                            </div>
                            `);

                            $('#weeklyTimesheetModal #timesheet-table tbody tr').each(function() {
                                var number = $(this).find('td:first-child()').html();

                                $(this).find('select[name="customer[]"]').parent().next().append(`
                                <div class="form-check form-check-inline">
                                    <div class="checkbox checkbox-sec margin-right">
                                        <input class="form-check-input weekly-billable" id="billable_${number}" type="checkbox" name="billable[]" value="1" onchange="showHiddenFields(this)">
                                        <label class="form-check-label" for="billable_${number}">Billable(/hr)</label>
                                    </div>
                                </div>
                                `);
                            });
                        } else {
                            $('#singleTimeModal').next().children('div.modal').find('#billable').parent().parent().next().remove();
                            $('#singleTimeModal').next().children('div.modal').find('#billable').parent().parent().remove();
                            $('#weeklyTimesheetModal').find('input[name="billable[]"]').parent().parent().parent().html('');
                        }

                        if ($('#weeklyTimesheetModal').length > 0) {
                            rowInputs = $('#weeklyTimesheetModal #timesheet-table tbody tr:first-child()').html();
                        }
                        break;
                }
            }
        });
    });

    $(document).on('click', '#weeklyTimesheetModal #copy-last-timesheet', function(e) {
        var name = $('#weeklyTimesheetModal #person_tracking').val();
        if (name !== null) {
            var nameSplit = name.split('-');

            $.get(`/accounting/get-last-timesheet/${nameSplit[0]}/${nameSplit[1]}`, function(result) {
                var res = JSON.parse(result);

                if (res.success === false) {
                    toast(res.success, res.message);
                } else {
                    var timesheet = res.data;
                    var time_activities = timesheet.time_activities;

                    var count = 0;
                    for (var row in time_activities) {
                        var activity = time_activities[row];
                        var hours = activity.hours;

                        if ($($('#weeklyTimesheetModal #timesheet-table tbody tr')[count]).length < 1) {
                            $('#weeklyTimesheetModal #timesheet-table tbody').append(`<tr>${rowInputs}</tr>`);
                            $('#weeklyTimesheetModal #timesheet-table tbody tr:last-child() td:first-child()').html(count + 1);

                            $('#weeklyTimesheetModal #timesheet-table tbody tr:last-child() select').val(null);
                            $('#weeklyTimesheetModal #timesheet-table tbody tr:last-child() input:not([type="checkbox"])').val('');
                            $('#weeklyTimesheetModal #timesheet-table tbody tr:last-child() textarea').val('');
                            $('#weeklyTimesheetModal #timesheet-table tbody tr:last-child() textarea').html('');
                            $('#weeklyTimesheetModal #timesheet-table tbody tr:last-child() input[name="billable[]"]').attr('id', `billable_${count+1}`).prop('checked', false).trigger('change');
                            $('#weeklyTimesheetModal #timesheet-table tbody tr:last-child() input[name="billable[]"]').next().attr('for', `billable_${count+1}`);
                        }

                        $($('#weeklyTimesheetModal #timesheet-table tbody tr')[count]).find('[name="customer[]"]').append(`<option value="${activity.customer_id}" selected>${activity.customer_name}</option>`).trigger('change');
                        $($('#weeklyTimesheetModal #timesheet-table tbody tr')[count]).find('[name="service[]"]').append(`<option value="${activity.service_id}" selected>${activity.service_name}</option>`);
                        $($('#weeklyTimesheetModal #timesheet-table tbody tr')[count]).find('[name="description[]"]').val(activity.description);

                        for (var day in hours) {
                            $($('#weeklyTimesheetModal #timesheet-table tbody tr')[count]).find(`[name="${day}_hours[]"]`).val(hours[day]);
                        }

                        $($('#weeklyTimesheetModal #timesheet-table tbody tr')[count]).find('[name="billable[]"]').prop('checked', activity.billable === "1");

                        if (activity.billable === "1") {
                            $($('#weeklyTimesheetModal #timesheet-table tbody tr')[count]).find('[name="billable[]"]').parent().parent().append(`<input type="number" name="hourly_rate[]" step=".01" value="${parseFloat(activity.hourly_rate).toFixed(2)}" onchange="convertToDecimal(this)" class="ml-2 w-25 form-control">
                            <div class="checkbox checkbox-sec">
                                <input type="checkbox" name="taxable[]" id="taxable_${count+1}" class="ml-2 form-check-input" value="1" ${activity.taxable === "1" ? 'checked' : ''}>
                                <label class="form-check-label" for="taxable_${count+1}">Taxable</label>
                            </div>`);
                        }

                        $($('#weeklyTimesheetModal #timesheet-table tbody tr')[count]).find('select').each(function() {
                            var field = $(this).attr('name').replace('[]', '');

                            $(this).select2({
                                ajax: {
                                    url: '/accounting/get-dropdown-choices',
                                    dataType: 'json',
                                    data: function(params) {
                                        var query = {
                                            search: params.term,
                                            type: 'public',
                                            field: field,
                                            modal: 'weeklyTimesheetModal'
                                        }
        
                                        // Query parameters will be ?search=[term]&type=public&field=[type]
                                        return query;
                                    }
                                },
                                templateResult: formatResult,
                                templateSelection: optionSelect
                            });
                        });

                        var days = Object.keys(hours);
                        var lastDay = days[days.length - 1];
                        $($('#weeklyTimesheetModal #timesheet-table tbody tr')[count]).find(`[name="${lastDay}_hours[]"]`).trigger('change');

                        count++;
                    }
                }
            });
        }
    });

    $(document).on('change', '#weeklyTimesheetModal #timesheet-table select[name="service[]"]', function() {
        var el = $(this);
        $.get(`/accounting/get-item-details/${$(this).val()}`, function(res) {
            var result = JSON.parse(res);
            var rate = result.item !== null ? result.item.price : '';

            el.parent().parent().next().find('[name="hourly_rate[]"]').val(rate).trigger('change');
        });
    });

    $(document).on('change', '#weeklyTimesheetModal #timesheet-table input[name="hourly_rate[]"]', function() {
        computeTotalBill();
    });

    $(document).on('change', '#weeklyTimesheetModal .show-field', function() {
        var day = $(this).attr('id').replace('show_', '');

        if ($(this).prop('checked')) {
            $(`#weeklyTimesheetModal #timesheet-table .${day}_field`).show();
            $(`#weeklyTimesheetModal #timesheet-table .${day}_total`).show();
        } else {
            $(`#weeklyTimesheetModal #timesheet-table .${day}_field`).hide();
            $(`#weeklyTimesheetModal #timesheet-table .${day}_total`).hide();
        }
    });

    $(document).on('click', '#weeklyTimesheetModal #save-and-print', function(e) {
        e.preventDefault();

        submitType = 'save-and-print';
        $('#weeklyTimesheetModal').parent('form').submit();
    });

    $(document).on('change', '#modal-container select', function() {
        var value = $(this).val();
        if (value === 'add-new') {
            dropdownEl = $(this);
            var form = $(this).attr('name').includes('account') ? 'account' : $(this).attr('name').replaceAll('[]', '');
            form = form === 'category' ? 'item_category' : form;

            if(form === 'account') {
                var modal = $('#modal-container').find('.modal:first-child()');
                var modalName = modal.attr('id').toLowerCase().replaceAll('modal', '');
                var field = dropdownEl.attr('id');
                var fieldName = field === undefined ? $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-').toLowerCase() : field.toLowerCase().replaceAll('_', '-');
                fieldName = fieldName.includes('from') || fieldName.includes('to') ? fieldName.replaceAll('from-', '').replaceAll('to-', '') : fieldName;
                var query = `?modal=${modalName}&field=${fieldName}`;
            } else if(form === 'product' || form === 'service') {
                var query = `?field=${form}`;
                form = 'item';
            } else {
                var query = '';
            }

            if(!form.includes('payee') && !form.includes('customer') && !form.includes('vendor')) {
                $.get(`/accounting/get-dropdown-modal/${form}_modal${query}`, function(result) {
                    $('#modal-container div.full-screen-modal:first-child()').append(result);
    
                    switch(form) {
                        case 'account' :
                            initAccountModal();
                        break;
                        case 'item_category' :
                            $('#modal-container #item-category-modal').modal('show');
                        break;
                        default :
                            if(form !== 'item') {
                                $(`#modal-container #${form.replaceAll('_', '-')}-modal form`).attr('id', `ajax-add-${form.replaceAll('_', '-')}`);
                                $(`#modal-container #${form.replaceAll('_', '-')}-modal form`).removeAttr('action');
                                $(`#modal-container #${form.replaceAll('_', '-')}-modal form`).removeAttr('method');
                            }

                            $(`#modal-container #${form.replaceAll('_', '-')}-modal`).modal({
                                backdrop: 'static',
                                keyboard: false
                            });
                        break;
                    }
                });
            }
        }
    });

    $(document).on('change', '#modal-container #account-modal #account_type', function() {
        var el = $(this);
        $.get('/accounting/get-first-detail-type/' + el.val(), function(result) {
            var res = JSON.parse(result);

            el.parent().next().find('#detail_type').append(`<option value="${res.acc_detail_id}" selected>${res.acc_detail_name}</option>`).trigger('change');
        });
    });

    $(document).on('change', '#modal-container #account-modal #detail_type', function() {
        var el = $(this);
        var id = el.val();

        $.get('/accounting/chart-of-accounts/get-detail-type/' + id, function(result) {
            var res = JSON.parse(result);

            el.parent().next().html(res.description);
            $('#modal-container #name').val(res.acc_detail_name);
        });
    });

    $(document).on('click', '#account-modal .close-account-modal', function(e) {
        e.preventDefault();

        if(dropdownEl !== null) {
            dropdownEl.val('').trigger('change');
        }
        $('#account-modal').modal('hide');
    });

    $(document).on('click', '#payment-method-modal .close-payment-method', function(e) {
        e.preventDefault();

        if(dropdownEl !== null) {
            dropdownEl.val('').trigger('change');
        }
        $('#payment-method-modal').modal('hide');
    });

    $(document).on('click', '#term-modal .close-term-modal', function(e) {
        e.preventDefault();

        if(dropdownEl !== null) {
            dropdownEl.val('').trigger('change');
        }
        $('#term-modal').modal('hide');
    });

    $(document).on('click', '#item-modal .close-item-modal', function(e) {
        e.preventDefault();

        if(dropdownEl !== null) {
            dropdownEl.val('').trigger('change');
        }
        $('#item-modal').modal('hide');
    });

    $(document).on('click', '#item-category-modal #cancel-add-category', function(e) {
        e.preventDefault();

        dropdownEl.val('').trigger('change');

        $('#item-category-modal').modal('hide');
    });

    $(document).on('hidden.bs.modal', '#modal-container #account-modal', function() {
        dropdownEl = null;

        $('#modal-container #account-modal').remove();
    });

    $(document).on('hidden.bs.modal', '#modal-container #payment-method-modal', function() {
        dropdownEl = null;

        $('#modal-container #payment-method-modal').remove();
    });

    $(document).on('hidden.bs.modal', '#modal-container #term-modal', function() {
        dropdownEl = null;

        $('#modal-container #term-modal').remove();
    });

    $(document).on('hidden.bs.modal', '#modal-container #item-modal', function() {
        dropdownEl = null;

        $('#modal-container #item-modal').remove();
    });

    $(document).on('hidden.bs.modal', '#modal-container #item-category-modal', function() {
        dropdownEl = null;

        $('#modal-container #item-category-modal').remove();
    });

    $(document).on('change', '#account-modal #check_sub', function() {
        if ($(this).prop('checked')) {
            $('#account-modal #parent_account').prop('disabled', false);
        } else {
            $('#account-modal #parent_account').prop('disabled', true);
        }
    });

    $(document).on('change', '#account-modal #choose_time', function() {
        if ($(this).val() === 'other') {
            $('#account-modal #balance').parent().addClass('hide');
            $('#account-modal #balance').val('');
            $('#account-modal #time_date').parent().parent().parent().removeClass('hide');
        } else {
            $('#account-modal #time_date').parent().parent().parent().addClass('hide');
            $('#account-modal #time_date').val('');
            $('#account-modal #balance').parent().removeClass('hide');
        }
    });

    $(document).on('click', '#modal-container #item-modal #types-table tr', function(e) {
        var type = e.currentTarget.dataset.href;

        itemTypeSelection = $('#modal-container #item-modal .modal-content').html();
        $.get('/accounting/item-form/'+type, function(result) {
            $('#item-modal .modal-content').html(result);
    
            if(dropdownEl !== null) {
                $('#item-modal form').removeAttr('action');
                $('#item-modal form').removeAttr('method');
                $('#item-modal form').removeAttr('enctype');
                $('#item-modal form').addClass('ajax-add-item');
                $('#item-modal form').attr('id', `ajax-${type}-item-form`);
            }

            $(`#item-modal .datepicker input`).datepicker({
                uiLibrary: 'bootstrap'
            });
    
            $('#item-modal select').each(function() {
                var dropdownType = $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-');

                if (dropdownFields.includes(dropdownType)) {
                    $(this).select2({
                        ajax: {
                            url: '/accounting/get-dropdown-choices',
                            dataType: 'json',
                            data: function(params) {
                                var query = {
                                    search: params.term,
                                    type: 'public',
                                    field: dropdownType,
                                    modal: 'item-modal'
                                }

                                // Query parameters will be ?search=[term]&type=public&field=[type]
                                return query;
                            }
                        },
                        templateResult: formatResult,
                        templateSelection: optionSelect,
                        dropdownParent: $('#item-modal')
                    });
                } else {
                    var options = $(this).find('option');
                    if (options.length > 10) {
                        $(this).select2({
                            dropdownParent: $('#item-modal')
                        });
                    } else {
                        $(this).select2({
                            minimumResultsForSearch: -1,
                            dropdownParent: $('#item-modal')
                        });
                    }
                }
            });

            if(typeof itemFormData !== 'undefined' && itemFormData.has('name') && type !== 'bundle') {
                if(itemFormData.has('id')) {
                    $('#item-modal form').attr('action', `/accounting/products-and-services/update/${type}/${itemFormData.get('id')}`);
                    $('#item-modal form').attr('id', `update-${type}-form`);
                    $(`#item-modal a#select-item-type`).attr('onclick', `changeType('${itemFormData.get('type')}')`);
                } else {
                    $(`#item-modal a#select-item-type`).attr('onclick', `changeType('')`);
                }

                for(var data  of itemFormData.entries()) {
                    if(data[0] !== 'icon') {
                        if(data[0].includes('category') || data[0].includes('account') || data[0].includes('vendor')) {
                            fillItemDropdownFields(data);
                        } else {
                            $('#item-modal form').find(`[name="${data[0]}"]`).val(data[1]).trigger('change');
                        }
                    } else {
                        if(rowData.icon !== null && rowData.icon !== "") {
                            $('#item-modal form').find('img.image-prev').attr('src', `/uploads/${rowData.icon}`);
                            $('#item-modal form').find('img.image-prev').parent().addClass('d-flex justify-content-center');
                            $('#item-modal form').find('img.image-prev').parent().removeClass('hide');
                            $('#item-modal form').find('img.image-prev').parent().prev().addClass('hide');
                        }
                    }
                }
    
                if(itemFormData.has('rebate_item')) {
                    $('#item-modal form').find('#rebate-item').prop('checked', true).trigger('change');
                }

                if(itemFormData.has('selling')) {
                    $('#item-modal form').find('#selling').prop('checked', true).trigger('change');
                }
    
                if(itemFormData.has('purchasing')) {
                    $('#item-modal form').find('#purchasing').prop('checked', true).trigger('change');
                }
            }
        });
    });

    $(document).on('click', '#modal-container #item-modal #select-item-type', function(e) {
        e.preventDefault();

        $('#modal-container #item-modal .modal-content').html(itemTypeSelection);
    });

    $(document).on('click', '#modal-container #item-modal #remove-item-icon', function(e) {
        e.preventDefault();

        $('#modal-container #item-modal #icon').val('').trigger('change');
    });

    $(document).on('change', '#modal-container #item-modal #icon', function() {
        if($(this)[0].files && $(this)[0].files[0]) {
            var reader = new FileReader();
    
            reader.onload = function(e) {
                $('#modal-container #item-modal img.image-prev').attr('src', e.target.result);
            }
    
            reader.readAsDataURL($(this)[0].files[0]);
    
            $('#modal-container #item-modal img.image-prev').parent().addClass('d-flex justify-content-center');
            $('#modal-container #item-modal img.image-prev').parent().removeClass('hide');
            $('#modal-container #item-modal img.image-prev').parent().prev().addClass('hide');
        } else {
            $('#modal-container #item-modal img.image-prev').parent().removeClass('d-flex justify-content-center');
            $('#modal-container #item-modal img.image-prev').parent().addClass('hide');
            $('#modal-container #item-modal img.image-prev').parent().prev().removeClass('hide');
        }
    });

    $(document).on('click', '#modal-container #item-modal #storage-locations tbody tr td:not(:last-child)', function() {
        if($(this).parent().find('input[name="location_name[]"]').length < 1) {
            $(this).parent().children('td:first-child').append('<input type="text" name="location_name[]" class="form-control">');
            $(this).parent().children('td:nth-child(2)').append('<input type="number" name="quantity[]" class="text-right form-control">');
        }
    });

    $(document).on('click', '#modal-container #item-modal #addBundleItem, #modal-container #item-modal #addLocationLine', function(e) {
        e.preventDefault();
        $(this).prev().children('tbody').append(`
        <tr>
            <td></td>
            <td></td>
            <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
        </tr>
        `);
    });

    $(document).on('click', '#modal-container #item-modal #bundle-items-table .deleteRow, #modal-container #item-modal #storage-locations .deleteRow', function(e) {
        e.preventDefault();
    
        if($(this).parent().parent().parent().children('tr').length > 2) {
            $(this).parent().parent().remove();
        } else {
            $(this).parent().parent().children('td:not(:last-child)').html('');
        }
    });

    $(document).on('click', '#modal-container #item-modal #bundle-item-form #bundle-items-table tbody tr td:not(:last-child)', function() {
        if($(this).parent().find('select[name="item[]"]').length < 1) {
            $(this).parent().children('td:first-child').append('<select name="item[]" class="form-control"></select>');
            $(this).parent().children('td:nth-child(2)').append('<input type="number" name="quantity[]" class="text-right form-control">');

            $(this).parent().find('select[name="item[]"]').select2({
                ajax: {
                    url: '/accounting/get-dropdown-choices',
                    dataType: 'json',
                    data: function(params) {
                        var query = {
                            search: params.term,
                            type: 'public',
                            field: 'item',
                            modal: 'item-modal'
                        }

                        // Query parameters will be ?search=[term]&type=public&field=[type]
                        return query;
                    }
                },
                templateResult: formatResult,
                templateSelection: optionSelect,
                dropdownParent: $('#modal-container #item-modal')
            });
        }
    });

    $(document).on('change', '#modal-container #item-modal #selling, #modal-container #item-modal #purchasing', function() {
        if($(this).prop('checked') === false) {
            $(this).parent().parent().parent().parent().children('div:not(:first-child)').addClass('hide');
    
            if($(this).attr('id') === 'selling') {
                $(this).parent().parent().parent().parent().parent().parent().next().addClass('hide');
    
                if($('#modal-container #item-modal #purchasing').prop('checked') === false) {
                    $('#modal-container #item-modal #purchasing').prop('checked', true).trigger('change');
                }
            } else {
                if($('#modal-container #item-modal #selling').prop('checked') === false) {
                    $('#modal-container #item-modal #selling').prop('checked', true).trigger('change');
                }
            }
        } else {
            $(this).parent().parent().parent().parent().children('div:not(:first-child)').removeClass('hide');
    
            if($(this).attr('id') === 'selling') {
                $(this).parent().parent().parent().parent().parent().parent().next().removeClass('hide');
            }
        }
    });

    $(document).on('click', '#item-modal .modal-footer #save-and-close', function(e) {
        e.preventDefault();

        $('#item-modal form').trigger('submit');
        $('#item-modal').modal('hide');
    });

    $(document).on('click', '#item-modal .modal-footer #save-and-new', function(e) {
        e.preventDefault();

        $('#item-modal form').trigger('submit');
        $('#item-modal form select').val('').trigger('change');
        $('#item-modal form input:not([type="checkbox"])').val('');
        $('#item-modal form input[type="checkbox"]').prop('checked', false);
        $('#item-modal form textarea').val('');
    });

    $(document).on('submit', '#item-category-modal form', function(e) {
        e.preventDefault();

        var data = new FormData(this);

        $.ajax({
            url: '/accounting/ajax-add-item-category',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function(result) {
                var res = JSON.parse(result);

                if(res.success) {
                    dropdownEl.append(`<option value="${res.data.item_categories_id}" selected>${res.data.name}</option>`);
                    dropdownEl.trigger('change');

                    $('#item-category-modal').modal('hide');
                }
            }
        });
    });

    $(document).on('submit', '#item-modal form', function(e) {
        if($(this).attr('id').includes('ajax')) {
            e.preventDefault();
            var data = new FormData(this);
            var type = $(this).attr('id').replaceAll('ajax-', '').replaceAll('-item-form', '');

            $.ajax({
                url: '/accounting/ajax-add-item/'+type,
                data: data,
                type: 'post',
                processData: false,
                contentType: false,
                success: function(result) {
                    var res = JSON.parse(result);

                    if(res.success) {
                        dropdownEl.append(`<option value="${res.data.id}" selected>${res.data.title}</option>`);
                        dropdownEl.trigger('change');
                    }
                }
            });
        }

        itemFormData = new FormData();
    });

    $(document).on('submit', '#account-modal #ajax-add-account', function(e) {
        e.preventDefault();

        var data = new FormData(this);

        $.ajax({
            url: '/accounting/ajax-add-account',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function(result) {
                var res = JSON.parse(result);

                if(res.success) {
                    dropdownEl.append(`<option value="${res.data.id}" selected>${res.data.name}</option>`);
                    dropdownEl.trigger('change');

                    $('#account-modal').modal('hide');
                }
            }
        });
    });

    $(document).on('submit', '#payment-method-modal #ajax-add-payment-method', function(e) {
        e.preventDefault();

        var data = new FormData(this);

        $.ajax({
            url: '/accounting/ajax-add-payment-method',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function(result) {
                var res = JSON.parse(result);

                if(res.success) {
                    dropdownEl.append(`<option value="${res.data.id}" selected>${res.data.name}</option>`);
                    dropdownEl.trigger('change');

                    $('#payment-method-modal').modal('hide');
                }
            }
        });
    });

    $(document).on('submit', '#term-modal #ajax-add-term', function(e) {
        e.preventDefault();

        var data = new FormData(this);

        $.ajax({
            url: '/accounting/ajax-add-term',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function(result) {
                var res = JSON.parse(result);

                if(res.success) {
                    dropdownEl.append(`<option value="${res.data.id}" selected>${res.data.name}</option>`);
                    dropdownEl.trigger('change');

                    $('#term-modal').modal('hide');
                }
            }
        });
    });

    $(document).on('change', '#modal-container #modal-form #payee', function() {
        if ($(this).val() === 'add-new') {
            dropdownEl = $(this);

            $.get('/accounting/get-add-payee-modal/payee', function(result) {
                $('#modal-container div.full-screen-modal:first-child()').parent().append(result);
                $('#modal-container #add-payee-modal select').select2({
                    minimumResultsForSearch: -1,
                    dropdownParent: $('#modal-container #add-payee-modal')
                });

                $('#modal-container #add-payee-modal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });
        }
    });

    $(document).on('change', '#modal-container #vendor', function() {
        if ($(this).val() === 'add-new') {
            dropdownEl = $(this);

            $.get('/accounting/get-add-payee-modal/vendor', function(result) {
                $('#modal-container div.full-screen-modal:first-child()').parent().append(result);

                $('#modal-container #add-payee-modal h4.modal-title').html('New Vendor');
                $('#modal-container #add-payee-modal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });
        }
    });

    $(document).on('change', '#modal-container #modal-form #person_tracking', function() {
        if ($(this).val() === 'add-new') {
            dropdownEl = $(this);

            $.get('/accounting/get-add-payee-modal/vendor', function(result) {
                $('#modal-container div.full-screen-modal:first-child()').parent().append(result);

                $('#modal-container #add-payee-modal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });
        }
    });

    $(document).on('change', '#modal-container #modal-form [name="category_customer[]"], #modal-container #modal-form #customer, #modal-container #modal-form [name="customer[]"]', function() {
        if ($(this).val() === 'add-new') {
            dropdownEl = $(this);

            $.get('/accounting/get-add-payee-modal/customer', function(result) {
                $('#modal-container div.full-screen-modal:first-child()').parent().append(result);

                $('#modal-container #add-payee-modal h4.modal-title').html('New Customer');
                $('#modal-container #add-payee-modal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });
        }
    });

    $(document).on('change', '#modal-container #modal-form [name="received_from[]"]', function() {
        if ($(this).val() === 'add-new') {
            dropdownEl = $(this);

            $.get('/accounting/get-add-payee-modal/received-from', function(result) {
                $('#modal-container div.full-screen-modal:first-child()').parent().append(result);
                $('#modal-container #add-payee-modal select').select2({
                    minimumResultsForSearch: -1,
                    dropdownParent: $('#modal-container #add-payee-modal')
                });

                $('#modal-container #add-payee-modal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });
        }
    });

    $(document).on('change', '#modal-container #modal-form [name="names[]"]', function() {
        if ($(this).val() === 'add-new') {
            dropdownEl = $(this);

            $.get('/accounting/get-add-payee-modal/received-from', function(result) {
                $('#modal-container div.full-screen-modal:first-child()').parent().append(result);
                $('#modal-container #add-payee-modal select').select2({
                    minimumResultsForSearch: -1,
                    dropdownParent: $('#modal-container #add-payee-modal')
                });

                $('#modal-container #add-payee-modal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });
        }
    });

    $(document).on('submit', '#modal-container #add-payee-modal #new-payee-form', function(e) {
        e.preventDefault();

        var data = new FormData(this);
        if (!data.has('payee_type')) {
            var type = dropdownEl.attr('id');

            if (type === undefined) {
                type = dropdownEl.attr('name').includes('customer') ? 'customer' : type;
                type = dropdownEl.attr('name').includes('vendor') ? 'vendor' : type;
            }
        }

        $.ajax({
            url: '/accounting/add-new-payee',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function(result) {
                var res = JSON.parse(result);

                if (data.get('payee_type') === 'vendor') {
                    var name = res.payee.display_name;
                } else {
                    var name = res.payee.first_name + ' ' + res.payee.last_name;
                }

                if (dropdownEl === null && $("#accountingRulesPageWrapper")) {
                    // for accounting rules page
                    $("[data-type='assignments.payee']").append(`<option value="${data.get('payee_type')+'-'+res.payee.id}" selected>${name}</option>`);
                }

                if (dropdownEl !== null) {
                    dropdownEl.append(`<option value="${data.get('payee_type')+'-'+res.payee.id}" selected>${name}</option>`);
                }

                $('#modal-container #add-payee-modal').modal('hide');
            }
        });
    });

    $(document).on('hidden.bs.modal', '#modal-container #add-payee-modal', function() {
        $('#modal-container #add-payee-modal').remove();
    });

    $(document).on('click', '#modal-container #add-payee-modal #add-payee-details', function() {
        var type = $('#modal-container #add-payee-modal #payee_type').val();
        var name = $('#modal-container #add-payee-modal #payee_name').val().trim();
        var nameSplit = name.split(' ');

        if (type === undefined) {
            if (dropdownEl.attr('id') === undefined) {
                type = dropdownEl.attr('name').includes('customer') ? 'customer' : 'vendor';
            } else {
                type = dropdownEl.attr('id');
            }
        }

        if (type === 'vendor' || type === 'person_tracking') {
            $.get('/accounting/get-add-vendor-details-modal', function(result) {
                $('#modal-container').append(result);

                var vendorAttachment = new Dropzone(`#vendAtt`, {
                    url: '/accounting/attachments/attach',
                    maxFilesize: 20,
                    uploadMultiple: true,
                    // maxFiles: 1,
                    addRemoveLinks: true,
                    init: function() {
                        this.on("success", function(file, response) {
                            var ids = JSON.parse(response)['attachment_ids'];
                            for (i in ids) {
                                if ($('#new-vendor-modal').find(`input[name="attachments[]"][value="${ids[i]}"]`).length === 0) {
                                    $('#modal-container #new-vendor-modal #vendAtt').parent().append(`<input type="hidden" name="attachments[]" value="${ids[i]}">`);
                                }

                                vendAttIds.push(ids[i]);
                            }
                            vendAttFiles.push(file);
                        });
                    },
                    removedfile: function(file) {
                        var ids = vendAttIds;
                        var index = vendAttFiles.map(function(d, index) {
                            if (d == file) return index;
                        }).filter(isFinite)[0];

                        $('#modal-container #new-vendor-modal').find(`input[name="attachments[]"][value="${ids[index]}"]`).remove();

                        //remove thumbnail
                        var previewElement;
                        return (previewElement = file.previewElement) !== null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
                    }
                });

                $('#modal-container #new-vendor-modal select').select2({
                    dropdownParent: $('#modal-container #new-vendor-modal')
                });
                $('#modal-container #new-vendor-modal .datepicker').datepicker({
                    uiLibrary: 'bootstrap',
                    todayBtn: "linked",
                    language: "de"
                });

                switch (nameSplit.length.toString()) {
                    case '1':
                        $('#modal-container #new-vendor-modal #f_name').val(nameSplit[0]);
                        break;
                    case '2':
                        $('#modal-container #new-vendor-modal #f_name').val(nameSplit[0]);
                        $('#modal-container #new-vendor-modal #l_name').val(nameSplit[1]);
                        break;
                    case '3':
                        $('#modal-container #new-vendor-modal #f_name').val(nameSplit[0]);
                        $('#modal-container #new-vendor-modal #m_name').val(nameSplit[1]);
                        $('#modal-container #new-vendor-modal #l_name').val(nameSplit[2]);
                        break;
                    case '4':
                        $('#modal-container #new-vendor-modal #title').val(nameSplit[0]);
                        $('#modal-container #new-vendor-modal #f_name').val(nameSplit[1]);
                        $('#modal-container #new-vendor-modal #m_name').val(nameSplit[2]);
                        $('#modal-container #new-vendor-modal #l_name').val(nameSplit[3]);
                        break;
                    case '5':
                        $('#modal-container #new-vendor-modal #title').val(nameSplit[0]);
                        $('#modal-container #new-vendor-modal #f_name').val(nameSplit[1]);
                        $('#modal-container #new-vendor-modal #m_name').val(nameSplit[2]);
                        $('#modal-container #new-vendor-modal #l_name').val(nameSplit[3]);
                        $('#modal-container #new-vendor-modal #suffix').val(nameSplit[4]);
                        break;
                }

                $('#modal-container #new-vendor-modal #display_name').val(name);
                $('#modal-container #new-vendor-modal #print_on_check_name').val(name);
                $('#modal-container #add-payee-modal').modal('hide');
                $('#modal-container #new-vendor-modal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });
        } else {
            $.get('/accounting/get-add-customer-details-modal', function(result) {
                $('#modal-container').append(result);

                var customerAttachment = new Dropzone(`#customerAttachment`, {
                    url: '/accounting/attachments/attach',
                    maxFilesize: 20,
                    uploadMultiple: true,
                    // maxFiles: 1,
                    addRemoveLinks: true,
                    init: function() {
                        this.on("success", function(file, response) {
                            var ids = JSON.parse(response)['attachment_ids'];
                            for (i in ids) {
                                if ($('#new-customer-modal').find(`input[name="attachments[]"][value="${ids[i]}"]`).length === 0) {
                                    $('#modal-container #new-customer-modal #custAttachment').parent().append(`<input type="hidden" name="attachments[]" value="${ids[i]}">`);
                                }

                                custAttIds.push(ids[i]);
                            }
                            custAttFiles.push(file);
                        });
                    },
                    removedfile: function(file) {
                        var ids = custAttIds;
                        var index = custAttFiles.map(function(d, index) {
                            if (d == file) return index;
                        }).filter(isFinite)[0];

                        $('#modal-container #new-customer-modal').find(`input[name="attachments[]"][value="${ids[index]}"]`).remove();

                        //remove thumbnail
                        var previewElement;
                        return (previewElement = file.previewElement) !== null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
                    }
                });

                $('#modal-container #new-customer-modal select').select2({
                    dropdownParent: $('#modal-container #new-customer-modal')
                });

                $('#modal-container #new-customer-modal .datepicker').datepicker({
                    uiLibrary: 'bootstrap',
                    todayBtn: "linked",
                    language: "de"
                });

                switch (nameSplit.length.toString()) {
                    case '1':
                        $('#modal-container #new-customer-modal #f_name').val(nameSplit[0]);
                        break;
                    case '2':
                        $('#modal-container #new-customer-modal #f_name').val(nameSplit[0]);
                        $('#modal-container #new-customer-modal #l_name').val(nameSplit[1]);
                        break;
                    case '3':
                        $('#modal-container #new-customer-modal #f_name').val(nameSplit[0]);
                        $('#modal-container #new-customer-modal #m_name').val(nameSplit[1]);
                        $('#modal-container #new-customer-modal #l_name').val(nameSplit[2]);
                        break;
                    case '4':
                        $('#modal-container #new-customer-modal #title').val(nameSplit[0]);
                        $('#modal-container #new-customer-modal #f_name').val(nameSplit[1]);
                        $('#modal-container #new-customer-modal #m_name').val(nameSplit[2]);
                        $('#modal-container #new-customer-modal #l_name').val(nameSplit[3]);
                        break;
                    case '5':
                        $('#modal-container #new-customer-modal #title').val(nameSplit[0]);
                        $('#modal-container #new-customer-modal #f_name').val(nameSplit[1]);
                        $('#modal-container #new-customer-modal #m_name').val(nameSplit[2]);
                        $('#modal-container #new-customer-modal #l_name').val(nameSplit[3]);
                        $('#modal-container #new-customer-modal #suffix').val(nameSplit[4]);
                        break;
                }

                $('#modal-container #new-customer-modal #display_name').val(name);
                $('#modal-container #new-customer-modal #print_on_check_name').val(name);
                $('#modal-container #add-payee-modal').modal('hide');
                $('#modal-container #new-customer-modal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });
        }
    });

    $(document).on('click', '#modal-container #term-modal input[name="payment_term_type"]', function() {
        if($(this).val() === "1" || $(this).val() === 1) {
            $('#modal-container #term-modal #net-due-days').prop('disabled', false);
    
            $('#modal-container #term-modal #day-of-month-due, #modal-container #term-modal #minimum-days-to-pay').prop('disabled', true);
            $('#modal-container #term-modal #day-of-month-due, #modal-container #term-modal #minimum-days-to-pay').val('');
        } else if($(this).val() === "2" || $(this).val() === 2) {
            $('#modal-container #term-modal #net-due-days').val('');
            $('#modal-container #term-modal #net-due-days').prop('disabled', true);
    
            $('#modal-container #term-modal #day-of-month-due, #modal-container #term-modal #minimum-days-to-pay').prop('disabled', false);
        }
    });

    $(document).on('click', '#modal-container #new-customer-modal .banking-tab-container a', function(e) {
        e.preventDefault();

        $(this).parent().find('.banking-tab-active').removeClass('active').removeClass('text-decoration-none').addClass('banking-tab').removeClass('banking-tab-active');

        $(this).removeClass('banking-tab');
        $(this).addClass('banking-tab-active');
        $(this).addClass('text-decoration-none');
    });

    $(document).on('change', '#modal-container #new-vendor-modal #use_display_name', function() {
        if ($(this).prop('checked')) {
            var display_name = $('#modal-container #new-vendor-modal #display_name').val();
            $('#modal-container #new-vendor-modal #print_on_check_name').val(display_name);
            $('#modal-container #new-vendor-modal #print_on_check_name').prop('disabled', true);
        } else {
            $('#modal-container #new-vendor-modal #print_on_check_name').prop('disabled', false);
        }
    });

    $(document).on('change', '#modal-container #new-customer-modal #use_display_name', function() {
        if ($(this).prop('checked')) {
            var display_name = $('#modal-container #new-customer-modal #display_name').val();
            $('#modal-container #new-customer-modal #print_on_check_name').val(display_name);
            $('#modal-container #new-customer-modal #print_on_check_name').prop('disabled', true);
        } else {
            $('#modal-container #new-customer-modal #print_on_check_name').prop('disabled', false);
        }
    });

    $(document).on('change', '#modal-container #new-customer-modal #sub_customer', function() {
        if ($(this).prop('checked')) {
            $('#modal-container #new-customer-modal #parent_customer').prop('disabled', false);
            $('#modal-container #new-customer-modal #bill_with').prop('disabled', false);
        } else {
            $('#modal-container #new-customer-modal #parent_customer').prop('disabled', true);
            $('#modal-container #new-customer-modal #bill_with').prop('disabled', true);
        }
    });

    $(document).on('change', '#modal-container #new-customer-modal #same_as_billing_add', function() {
        if ($(this).prop('checked')) {
            $('#modal-container #new-customer-modal #shipping_address').prop('disabled', true);
            $('#modal-container #new-customer-modal #shipping_city').prop('disabled', true);
            $('#modal-container #new-customer-modal #shipping_state').prop('disabled', true);
            $('#modal-container #new-customer-modal #shipping_zip').prop('disabled', true);
            $('#modal-container #new-customer-modal #shipping_country').prop('disabled', true);
        } else {
            $('#modal-container #new-customer-modal #shipping_address').prop('disabled', false);
            $('#modal-container #new-customer-modal #shipping_city').prop('disabled', false);
            $('#modal-container #new-customer-modal #shipping_state').prop('disabled', false);
            $('#modal-container #new-customer-modal #shipping_zip').prop('disabled', false);
            $('#modal-container #new-customer-modal #shipping_country').prop('disabled', false);
        }
    });

    $(document).on('change', '#modal-container #new-customer-modal #cust_tax_exempt', function() {
        if ($(this).prop('checked')) {
            $('#modal-container #new-customer-modal #tax_rate').prop('disabled', true);
            $(this).parent().parent().parent().next().append(`
            <div class="col-6">
                <div class="form-ib">
                    <label for="reason_for_exemption">Reason for exemption<span class="text-danger">*</span></label>
                    <select name="reason_for_exemption" id="reason_for_exemption" class="form-control">
                        <option value="">Federal government</option>
                        <option value="">State government</option>
                        <option value="">Local government</option>
                        <option value="">Tribal government</option>
                        <option value="">Charitable organization</option>
                        <option value="">Religious organization</option>
                        <option value="">Hospital</option>
                        <option value="">Resale</option>
                        <option value="">Direct pay permit</option>
                        <option value="">Multiple points of use</option>
                        <option value="">Direct mail</option>
                        <option value="">Industrial production/manufacturing</option>
                        <option value="">Foreign diplomat</option>
                        <option value="">Other</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-ib">
                    <label for="exemption_details">Exemption details</label>
                    <input type="text" class="form-control" name="exemption_details" id="exemption_details">
                </div>
            </div>
            `);
            $(this).parent().parent().parent().next().find('select').select2({
                minimumResultsForSearch: -1,
                dropdownParent: $('#modal-container #new-customer-modal')
            });
        } else {
            $('#modal-container #new-customer-modal #tax_rate').prop('disabled', false);
            $(this).parent().parent().parent().next().html('');
        }
    });

    $(document).on('click', '#modal-container #add-payee-modal .cancel-add-payee', function(e) {
        dropdownEl.val('').trigger('change');

        $('#modal-container #add-payee-modal').modal('hide');
    });

    $(document).on('click', '#modal-container #new-vendor-modal .cancel-add-vendor', function(e) {
        if (dropdownEl === null && $("#accountingRulesPageWrapper")) {
            // for accounting rules page
            $("[data-type='assignments.payee']").val('').trigger('change');
        }

        if (dropdownEl !== null) {
            dropdownEl.val('').trigger('change');
        }

        $('#modal-container #new-vendor-modal').modal('hide');
    });

    $(document).on('click', '#modal-container #new-customer-modal .cancel-add-customer', function(e) {
        dropdownEl.val('').trigger('change');

        $('#modal-container #new-customer-modal').modal('hide');
    });

    $(document).on('hidden.bs.modal', '#modal-container #new-vendor-modal', function(e) {
        dropdownEl = null;

        $('#modal-container #new-vendor-modal').remove();
    });

    $(document).on('hidden.bs.modal', '#modal-container #new-customer-modal', function(e) {
        dropdownEl = null;

        $('#modal-container #new-customer-modal').hide();
    });

    $(document).on('submit', '#modal-container #new-vendor-modal #add-vendor-form', function(e) {
        e.preventDefault();

        var data = new FormData(this);
        data.set('payee_type', 'vendor');

        $.ajax({
            url: '/accounting/add-full-payee-details',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function(result) {
                var res = JSON.parse(result);

                var name = res.payee.display_name;

                dropdownEl.append(`<option value="${data.get('payee_type')+'-'+res.payee.id}" selected>${name}</option>`);

                $('#modal-container #new-vendor-modal').modal('hide');
            }
        });

        $('#modal-container #new-vendor-modal').modal('hide');
    });

    $(document).on('submit', '#modal-container #new-customer-modal #add-customer-form', function(e) {
        e.preventDefault();

        var data = new FormData(this);
        data.set('payee_type', 'customer');

        $.ajax({
            url: baseURL + '/accounting/add-full-payee-details',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function(result) {
                var res = JSON.parse(result);

                var name = res.payee.first_name + ' ' + res.payee.last_name;

                dropdownEl.append(`<option value="${data.get('payee_type')+'-'+res.payee.id}" selected>${name}</option>`);

                $('#modal-container #new-vendor-modal').modal('hide');
            }
        });

        $('#modal-container #new-customer-modal').modal('hide');
    });

    $(document).on('keyup', '#billPaymentModal #search', function() {
        $('#billPaymentModal #bills-table').DataTable().ajax.reload(null, true);
    });

    $(document).on('keyup', '#billPaymentModal #search-vcredit-no', function() {
        $('#billPaymentModal #vendor-credits-table').DataTable().ajax.reload(null, true);
    });

    $(document).on('change', '#billPaymentModal #table_rows', function() {
        $('#billPaymentModal #bills-table').DataTable().ajax.reload(null, true);
    });

    $(document).on('change', '#billPaymentModal #vcredits_table_rows', function() {
        $('#billPaymentModal #vendor-credits-table').DataTable().ajax.reload(null, true);
    });

    $(document).on('click', '#modal-container form .modal #show-existing-attachments', function() {
        if($('#modal-container form .modal .transactions-container').length > 0) {
            $('#modal-container form .modal .transactions-container').parent().remove();
            $('#modal-container form .modal a.close-transactions-container').parent().remove();
            $('#modal-container form .modal a.open-transactions-container').parent().remove();
        }

        if($('#modal-container form .modal .attachments-container').length < 1) {
            var transactionType = $('#modal-container form .modal .modal-title').text();
            $('#modal-container form .modal .modal-body').children('.row').append(`
                <div class="col-xl-2">
                    <div class="bg-white h-100" style="padding: 15px">
                        <div class="row attachments-container">
                            <div class="col-12 pb-3">
                                <h4>Add to ${transactionType}</h4>
                                <div class="d-flex justify-content-center">
                                    <select class="form-control" id="attachment-types">
                                        <option value="unlinked">Unlinked</option>
                                        <option value="all">All</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `);

            $('#modal-container form .modal #attachment-types').select2({
                minimumResultsForSearch: -1
            });

            var attachmentType = $('#modal-container form .modal #attachment-types').val();
            $.get(`/accounting/attachments/get-${attachmentType}-attachments-ajax`, function(res) {
                var attachments = JSON.parse(res);
        
                $.each(attachments, function(index, attachment) {
                    var dateUploaded = new Date(attachment.created_at);
                    var dateString = String(dateUploaded.getMonth() + 1).padStart(2, '0') + '/' + String(dateUploaded.getDate()).padStart(2, '0') + '/' + dateUploaded.getFullYear();

                    if($('#modal-container form .modal .attachments').parent().find(`input[value="${attachment.id}"]`).length < 1) {
                        $('#modal-container form .modal .attachments-container').append(`
                            <div class="col-12">
                                <div class="card border">
                                    <div class="card-body p-0">
                                        <h5 class="card-title">${attachment.uploaded_name}.${attachment.file_extension}</h5>
                                        <div class="card-subtitle">
                                            <div class="row">
                                                <div class="col">${dateString}</div>
                                                <div class="col d-flex justify-content-center">${attachment.type === 'Image' ? `<img class="w-50" src="/uploads/accounting/attachments/${attachment.stored_name}">` : ""}</div>
                                            </div>
                                        </div>
                                        <ul class="d-flex justify-content-around">
                                            <li><a href="#" class="text-info add-attachment" data-id="${attachment.id}"><strong>Add</strong></a></li>
                                            <li><a href="${attachment.type === 'Image' ? `/uploads/accounting/attachments/${attachment.stored_name}` : `/accounting/attachments/download?filename=${attachment.stored_name}`}" target="_blank" class="text-info">${attachment.type === 'Image' ? 'Preview' : 'Download'}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        `);
                    }
                });
            });
        }
    });

    $(document).on('change', '#modal-container form .modal #attachment-types, #existing-attachments-modal #attachment-types', function() {
        var cont = $(this).parent().parent().parent();
        $.get(`/accounting/attachments/get-${$(this).val()}-attachments-ajax`, function(res) {
            var attachments = JSON.parse(res);
    
            cont.children('div.col-12:not(:first-child)').remove();
            $.each(attachments, function(index, attachment) {
                var dateUploaded = new Date(attachment.created_at);
                var dateString = String(dateUploaded.getMonth() + 1).padStart(2, '0') + '/' + String(dateUploaded.getDate()).padStart(2, '0') + '/' + dateUploaded.getFullYear();

                if($('#modal-container form .modal .attachments').parent().find(`input[value="${attachment.id}"]`).length < 1) {
                    cont.append(`
                        <div class="col-12">
                            <div class="card border">
                                <div class="card-body p-0">
                                    <h5 class="card-title">${attachment.uploaded_name}.${attachment.file_extension}</h5>
                                    <div class="card-subtitle">
                                        <div class="row">
                                            <div class="col">${dateString}</div>
                                            <div class="col d-flex justify-content-center">${attachment.type === 'Image' ? `<img class="w-50" src="/uploads/accounting/attachments/${attachment.stored_name}">` : ""}</div>
                                        </div>
                                    </div>
                                    <ul class="d-flex justify-content-around">
                                        <li><a href="#" class="text-info add-attachment" data-id="${attachment.id}"><strong>Add</strong></a></li>
                                        <li><a href="${attachment.type === 'Image' ? `/uploads/accounting/attachments/${attachment.stored_name}` : `/accounting/attachments/download?filename=${attachment.stored_name}`}" target="_blank" class="text-info">${attachment.type === 'Image' ? 'Preview' : 'Download'}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    `);
                }
            });
        });
    });

    $(document).on('click', '#modal-container form .modal .attachments-container a.add-attachment', function(e) {
        var id = e.currentTarget.dataset.id;
        if($('#modal-container form .modal .attachments').parent().find(`input[value="${id}"]`).length < 1) {
            $('#modal-container form .modal .attachments').parent().append(`<input type="hidden" name="attachments[]" value="${id}">`);

            $.get('/accounting/get-attachment/'+id, function(res) {
                var attachment = JSON.parse(res);

                modalAttachmentId.push(id);
                var mockFile = {
                    name: `${attachment.uploaded_name}.${attachment.file_extension}`,
                    size: parseInt(attachment.size),
                    dataURL: base_url+"uploads/accounting/attachments/" + attachment.stored_name,
                    accepted: true
                };
                modalAttachments.emit("addedfile", mockFile);
                modalAttachedFiles.push(mockFile);

                modalAttachments.createThumbnailFromUrl(mockFile, modalAttachments.options.thumbnailWidth, modalAttachments.options.thumbnailHeight, modalAttachments.options.thumbnailMethod, true, function(thumbnail) {
                    modalAttachments.emit('thumbnail', mockFile, thumbnail);
                });
                modalAttachments.emit("complete", mockFile);
            });

            $(this).parent().parent().parent().parent().parent().remove();
        }
    });

    $(document).on('click', '#modal-container form #depositModal #delete-deposit', function(e) {
        e.preventDefault();

        var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/deposit/${split[1]}`,
            type: 'DELETE',
            success: function(result) {
                location.reload();
            }
        });
    });
    
    $(document).on('click', '#modal-container form #transferModal #delete-transfer', function(e) {
        e.preventDefault();

        var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/transfer/${split[1]}`,
            type: 'DELETE',
            success: function(result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#modal-container form #transferModal #void-transfer', function(e) {
        e.preventDefault();

        var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.get('/accounting/void-transaction/transfer/'+split[1], function(res) {
            location.reload();
        });
    });

    $(document).on('click', '#modal-container form #journalEntryModal #copy-journal-entry', function(e) {
        e.preventDefault();

        $('#modal-container form#modal-form').attr('onsubmit', 'submitModalForm(event, this)');
        $('#modal-container form#modal-form').removeAttr('data-href');
        $('#modal-container form#modal-form .modal-body .row.journal-entry-details').prepend(`<div class="col-md-12">
            <div class="alert alert-info alert-dismissible mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="mt-0">This is a copy</h6>
                <span>This is a copy of an expense. Revise as needed and save the expense.</span>
            </div>
        </div>`);

        $('#modal-container form#modal-form .modal-footer .row').children('div:nth-child(2)').addClass('d-flex').html(`<a href="#" class="text-white m-auto" onclick="makeRecurring('journal_entry')">Make Recurring</a>`);
    });

    $(document).on('click', '#modal-container form #journalEntryModal #delete-journal-entry', function(e) {
        e.preventDefault();

        var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/journal/${split[1]}`,
            type: 'DELETE',
            success: function(result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#modal-container form #expenseModal #copy-expense', function(e) {
        e.preventDefault();

        $('#modal-container form#modal-form').attr('onsubmit', 'submitModalForm(event, this)');
        $('#modal-container form#modal-form').removeAttr('data-href');
        $('#modal-container form#modal-form .modal-body .row.payee-details').next().prepend(`<div class="col-md-12">
            <div class="alert alert-info alert-dismissible mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="mt-0">This is a copy</h6>
                <span>This is a copy of an expense. Revise as needed and save the expense.</span>
            </div>
        </div>`);

        $('#modal-container form#modal-form .modal-footer .row').children('div:nth-child(2)').addClass('d-flex').html(`<a href="#" class="text-white m-auto" onclick="makeRecurring('expense')">Make Recurring</a>`);
    });

    $(document).on('click', '#modal-container form #expenseModal #delete-expense', function(e) {
        e.preventDefault();

        var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/expense/${split[1]}`,
            type: 'DELETE',
            success: function(result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#modal-container form #expenseModal #void-expense', function(e) {
        e.preventDefault();

        var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.get('/accounting/void-transaction/expense/'+split[1], function(res) {
            location.reload();
        });
    });

    $(document).on('click', '#modal-container form #checkModal #copy-check', function(e) {
        e.preventDefault();

        $('#modal-container form#modal-form').attr('onsubmit', 'submitModalForm(event, this)');
        $('#modal-container form#modal-form').removeAttr('data-href');
        $('#modal-container form#modal-form .modal-body .row.payee-details').next().prepend(`<div class="col-md-12">
            <div class="alert alert-info alert-dismissible mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="mt-0">This is a copy</h6>
                <span>This is a copy of a check. Revise as needed and save the check.</span>
            </div>
        </div>`);

        $('#modal-container form#modal-form .modal-footer .row').children('div:nth-child(2)').find('.dropdown-menu').html(`<a class="dropdown-item" href="#" onclick="saveAndVoid(event)" id="save-and-void">Void</a>`);
    });

    $(document).on('click', '#modal-container form #checkModal #delete-check', function(e) {
        e.preventDefault();

        var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/check/${split[1]}`,
            type: 'DELETE',
            success: function(result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#modal-container form #checkModal #void-check', function(e) {
        e.preventDefault();

        var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.get('/accounting/void-transaction/check/'+split[1], function(res) {
            location.reload();
        });
    });

    $(document).on('click', '#modal-container form #checkModal #print-check', function(e) {
        e.preventDefault();

        $('#modal-container form #checkModal #print_later').prop('checked', true).trigger('change');

        submitType = 'save-and-close';

        $('#modal-container form#modal-form').submit();

        $('#new-popup #accounting_vendors .ajax-print_checks_modal').trigger('click');
    });

    $(document).on('click', '#modal-container form #billModal #copy-bill', function(e) {
        e.preventDefault();

        $('#modal-container form#modal-form').attr('onsubmit', 'submitModalForm(event, this)');
        $('#modal-container form#modal-form').removeAttr('data-href');
        $('#modal-container form#modal-form .modal-body .row.payee-details').next().prepend(`<div class="col-md-12">
            <div class="alert alert-info alert-dismissible my-4" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="mt-0">This is a copy</h6>
                <span>This is a copy of a bill. Revise as needed and save the bill.</span>
            </div>
        </div>`);

        $('#modal-container form#modal-form .modal-footer .row').children('div:nth-child(2)').addClass('d-flex').html(`<a href="#" class="text-white m-auto" onclick="makeRecurring('bill')">Make Recurring</a>`);
    });

    $(document).on('click', '#modal-container form #billModal #delete-bill', function(e) {
        e.preventDefault();

        var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/bill/${split[1]}`,
            type: 'DELETE',
            success: function(result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#modal-container form #purchaseOrderModal #copy-purchase-order', function(e) {
        e.preventDefault();

        $('#modal-container form#modal-form').attr('onsubmit', 'submitModalForm(event, this)');
        $('#modal-container form#modal-form').removeAttr('data-href');
        $('#modal-container form#modal-form .modal-body .row.payee-details').next().prepend(`<div class="col-md-12">
            <div class="alert alert-info alert-dismissible mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="mt-0">This is a copy</h6>
                <span>This is a copy of a purchase order. Revise as needed and save the purchase order.</span>
            </div>
        </div>`);

        $('#modal-container form#modal-form .modal-footer .row').children('div:nth-child(2)').find('.dropdown-menu').parent().parent().prev().remove();
        $('#modal-container form#modal-form .modal-footer .row').children('div:nth-child(2)').find('.dropdown-menu').parent().parent().remove();
    });

    $(document).on('click', '#modal-container form #purchaseOrderModal #delete-purchase-order', function(e) {
        e.preventDefault();

        var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/purchase-order/${split[1]}`,
            type: 'DELETE',
            success: function(result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#modal-container form #vendorCreditModal #copy-vendor-credit', function(e) {
        e.preventDefault();

        $('#modal-container form#modal-form').attr('onsubmit', 'submitModalForm(event, this)');
        $('#modal-container form#modal-form').removeAttr('data-href');
        $('#modal-container form#modal-form .modal-body .row.payee-details').next().prepend(`<div class="col-md-12">
            <div class="alert alert-info alert-dismissible mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="mt-0">This is a copy</h6>
                <span>This is a copy of a vendor credit. Revise as needed and save the vendor credit.</span>
            </div>
        </div>`);

        $('#modal-container form#modal-form .modal-footer .row').children('div:nth-child(2)').addClass('d-flex').html(`<a href="#" class="text-white m-auto" onclick="makeRecurring('vendor_credit')">Make Recurring</a>`);
    });

    $(document).on('click', '#modal-container form #vendorCreditModal #delete-vendor-credit', function(e) {
        e.preventDefault();

        var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/vendor-credit/${split[1]}`,
            type: 'DELETE',
            success: function(result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#modal-container form #creditCardCreditModal #copy-cc-credit', function(e) {
        e.preventDefault();

        $('#modal-container form#modal-form').attr('onsubmit', 'submitModalForm(event, this)');
        $('#modal-container form#modal-form').removeAttr('data-href');
        $('#modal-container form#modal-form .modal-body .row.payee-details').next().prepend(`<div class="col-md-12">
            <div class="alert alert-info alert-dismissible mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="mt-0">This is a copy</h6>
                <span>This is a copy of a credit card credit. Revise as needed and save the credit card credit.</span>
            </div>
        </div>`);

        $('#modal-container form#modal-form .modal-footer .row').children('div:nth-child(2)').addClass('d-flex').html(`<a href="#" class="text-white m-auto" onclick="makeRecurring('credit_card_credit')">Make Recurring</a>`);
    });

    $(document).on('click', '#modal-container form #creditCardCreditModal #delete-cc-credit', function(e) {
        e.preventDefault();

        var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/cc-credit/${split[1]}`,
            type: 'DELETE',
            success: function(result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#modal-container form #creditCardCreditModal #void-cc-credit', function(e) {
        e.preventDefault();

        var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.get('/accounting/void-transaction/cc-credit/'+split[1], function(res) {
            location.reload();
        });
    });

    $(document).on('click', '#modal-container form #payDownCreditModal #delete-credit-card-payment', function(e) {
        e.preventDefault();

        var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/credit-card-payment/${split[1]}`,
            type: 'DELETE',
            success: function(result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#modal-container form #payDownCreditModal #void-credit-card-payment', function(e) {
        e.preventDefault();

        var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.get('/accounting/void-transaction/credit-card-payment/'+split[1], function(res) {
            location.reload();
        });
    });

    $(document).on('click', '#modal-container form #singleTimeModal #delete-time-activity', function(e) {
        e.preventDefault();

        var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/time-activity/${split[1]}`,
            type: 'DELETE',
            success: function(result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#modal-container form #receivePaymentModal #void-payment', function(e) {
        e.preventDefault();

        var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.get('/accounting/void-transaction/receive-payment/'+split[1], function(res) {
            location.reload();
        });
    });

    $(document).on('click', '#modal-container form #receivePaymentModal #delete-payment', function(e) {
        e.preventDefault();

        var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/receive-payment/${split[1]}`,
            type: 'DELETE',
            success: function(result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#modal-container form #receivePaymentModal #save-and-print', function(e) {
        e.preventDefault();

        submitType = 'save-and-print';

        $('#modal-container form#modal-form').submit();

        var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.get('/accounting/print-payment-modal/'+split[1], function(result) {
            $('div#modal-container').append(result);

            $('#viewPrintPaymentModal').modal('show');
        });
    });

    $(document).on('hidden.bs.modal', '#viewPrintPaymentModal', function() {
        $(this).parent().parent().next('.modal-backdrop').remove();
        $(this).parent().remove();
    });

    $(document).on('click', '#viewPrintPaymentModal #preview-and-print', function(e) {
        e.preventDefault();

        let pdfWindow = window.open("");
        pdfWindow.document.write(`<iframe width="100%" height="100%" src="${$('#viewPrintPaymentModal iframe').attr('src')}"></iframe>`);
        $(pdfWindow.document).find('body').css('padding', '0');
        $(pdfWindow.document).find('body').css('margin', '0');
        $(pdfWindow.document).find('iframe').css('border', '0');
    });

    $(document).on('click', '#modal-container form #invoiceModal #copy-invoice', function(e) {
        e.preventDefault();

        $('#modal-container form#modal-form').attr('onsubmit', 'submitModalForm(event, this)');
        $('#modal-container form#modal-form').removeAttr('data-href');
        $('#modal-container form#modal-form .modal-body .row.customer-details').next().prepend(`<div class="col-md-12">
            <div class="alert alert-info alert-dismissible mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="mt-0">This is a copy</h6>
                <span>This is a copy of a invoice. Revise as needed and save the invoice.</span>
            </div>
        </div>`);

        $('#modal-container form#modal-form .modal-footer .row').children('div:nth-child(2)').find('.dropdown-menu').parent().parent().prev().remove();
        $('#modal-container form#modal-form .modal-footer .row').children('div:nth-child(2)').find('.dropdown-menu').parent().parent().remove();

        $('#invoiceModal .modal-title span').html('');
        $.get('/accounting/get-last-invoice-number', function(result) {
            $('#invoiceModal #invoice-no').val(result);
        });
    });

    $(document).on('click', '#modal-container form #invoiceModal #void-invoice', function(e) {
        e.preventDefault();

        var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.get('/accounting/void-transaction/invoice/'+split[1], function(res) {
            location.reload();
        });
    });

    $(document).on('click', '#modal-container form #invoiceModal #delete-invoice', function(e) {
        e.preventDefault();

        var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/invoice/${split[1]}`,
            type: 'DELETE',
            success: function(result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#invoiceModal .modal-footer #save-and-print', function(e) {
        e.preventDefault();

        submitType = 'save-and-print';

        $('#modal-container form#modal-form').submit();
    });

    $(document).on('hidden.bs.modal', '#viewPrintInvoiceModal', function() {
        $(this).parent().parent().next('.modal-backdrop').remove();
        $(this).parent().remove();
    });

    $(document).on('click', '#viewPrintInvoiceModal #preview-and-print', function(e) {
        e.preventDefault();

        let pdfWindow = window.open("");
        pdfWindow.document.write(`<iframe width="100%" height="100%" src="${$('#viewPrintInvoiceModal iframe').attr('src')}"></iframe>`);
        $(pdfWindow.document).find('body').css('padding', '0');
        $(pdfWindow.document).find('body').css('margin', '0');
        $(pdfWindow.document).find('iframe').css('border', '0');
    });

    $(document).on('click', '#modal-container form #creditMemoModal #copy-credit-memo', function(e) {
        e.preventDefault();

        $('#modal-container form#modal-form').attr('onsubmit', 'submitModalForm(event, this)');
        $('#modal-container form#modal-form').removeAttr('data-href');
        $('#modal-container form#modal-form .modal-body .row.customer-details').next().prepend(`<div class="col-md-12">
            <div class="alert alert-info alert-dismissible mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="mt-0">This is a copy</h6>
                <span>This is a copy of a credit memo. Revise as needed and save the credit memo.</span>
            </div>
        </div>`);

        $('#modal-container form#modal-form .modal-footer .row').children('div:nth-child(2)').find('.dropdown-menu').parent().parent().prev().remove();
        $('#modal-container form#modal-form .modal-footer .row').children('div:nth-child(2)').find('.dropdown-menu').parent().parent().remove();
    });

    $(document).on('click', '#modal-container form #creditMemoModal #void-credit-memo', function(e) {
        e.preventDefault();

        var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.get('/accounting/void-transaction/credit-memo/'+split[1], function(res) {
            location.reload();
        });
    });

    $(document).on('click', '#modal-container form #creditMemoModal #delete-credit-memo', function(e) {
        e.preventDefault();

        var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/credit-memo/${split[1]}`,
            type: 'DELETE',
            success: function(result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#creditMemoModal .modal-footer #save-and-print', function(e) {
        e.preventDefault();

        submitType = 'save-and-print';

        $('#modal-container form#modal-form').submit();
    });

    $(document).on('hidden.bs.modal', '#viewPrintCreditMemoModal', function() {
        $(this).parent().parent().next('.modal-backdrop').remove();
        $(this).parent().remove();
    });

    $(document).on('click', '#viewPrintCreditMemoModal #preview-and-print', function(e) {
        e.preventDefault();

        let pdfWindow = window.open("");
        pdfWindow.document.write(`<iframe width="100%" height="100%" src="${$('#viewPrintCreditMemoModal iframe').attr('src')}"></iframe>`);
        $(pdfWindow.document).find('body').css('padding', '0');
        $(pdfWindow.document).find('body').css('margin', '0');
        $(pdfWindow.document).find('iframe').css('border', '0');
    });

    $(document).on('click', '#modal-container form #salesReceiptModal #copy-sales-receipt', function(e) {
        e.preventDefault();

        $('#modal-container form#modal-form').attr('onsubmit', 'submitModalForm(event, this)');
        $('#modal-container form#modal-form').removeAttr('data-href');
        $('#modal-container form#modal-form .modal-body .row.customer-details').next().prepend(`<div class="col-md-12">
            <div class="alert alert-info alert-dismissible mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="mt-0">This is a copy</h6>
                <span>This is a copy of a sales receipt. Revise as needed and save the sales receipt.</span>
            </div>
        </div>`);

        $('#modal-container form#modal-form .modal-footer .row').children('div:nth-child(2)').find('.dropdown-menu').parent().parent().prev().remove();
        $('#modal-container form#modal-form .modal-footer .row').children('div:nth-child(2)').find('.dropdown-menu').parent().parent().remove();
    });

    $(document).on('click', '#modal-container #salesReceiptModal #void-sales-receipt', function(e) {
        e.preventDefault();

        var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.get('/accounting/void-transaction/sales-receipt/'+split[1], function(res) {
            location.reload();
        });
    });

    $(document).on('click', '#modal-container form #salesReceiptModal #delete-sales-receipt', function(e) {
        e.preventDefault();

        var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/sales-receipt/${split[1]}`,
            type: 'DELETE',
            success: function(result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#salesReceiptModal .modal-footer #save-and-print', function(e) {
        e.preventDefault();

        submitType = 'save-and-print';

        $('#modal-container form#modal-form').submit();
    });

    $(document).on('hidden.bs.modal', '#viewPrintSalesReceiptModal', function() {
        $(this).parent().parent().next('.modal-backdrop').remove();
        $(this).parent().remove();
    });

    $(document).on('click', '#viewPrintSalesReceiptModal #preview-and-print', function(e) {
        e.preventDefault();

        let pdfWindow = window.open("");
        pdfWindow.document.write(`<iframe width="100%" height="100%" src="${$('#viewPrintSalesReceiptModal iframe').attr('src')}"></iframe>`);
        $(pdfWindow.document).find('body').css('padding', '0');
        $(pdfWindow.document).find('body').css('margin', '0');
        $(pdfWindow.document).find('iframe').css('border', '0');
    });

    $(document).on('click', '#modal-container form #refundReceiptModal #copy-refund-receipt', function(e) {
        e.preventDefault();

        $('#modal-container form#modal-form').attr('onsubmit', 'submitModalForm(event, this)');
        $('#modal-container form#modal-form').removeAttr('data-href');
        $('#modal-container form#modal-form .modal-body .row.customer-details').next().prepend(`<div class="col-md-12">
            <div class="alert alert-info alert-dismissible mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="mt-0">This is a copy</h6>
                <span>This is a copy of a refund receipt. Revise as needed and save the refund receipt.</span>
            </div>
        </div>`);

        $('#modal-container form#modal-form .modal-footer .row').children('div:nth-child(2)').find('.dropdown-menu').parent().parent().prev().remove();
        $('#modal-container form#modal-form .modal-footer .row').children('div:nth-child(2)').find('.dropdown-menu').parent().parent().remove();
    });

    $(document).on('click', '#modal-container #refundReceiptModal #void-refund-receipt', function(e) {
        e.preventDefault();

        var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.get('/accounting/void-transaction/refund-receipt/'+split[1], function(res) {
            location.reload();
        });
    });

    $(document).on('click', '#modal-container form #refundReceiptModal #delete-refund-receipt', function(e) {
        e.preventDefault();

        var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/refund-receipt/${split[1]}`,
            type: 'DELETE',
            success: function(result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#refundReceiptModal .modal-footer #save-and-print', function(e) {
        e.preventDefault();

        submitType = 'save-and-print';

        $('#modal-container form#modal-form').submit();
    });

    $(document).on('hidden.bs.modal', '#viewPrintRefundReceiptModal', function() {
        $(this).parent().parent().next('.modal-backdrop').remove();
        $(this).parent().remove();
    });

    $(document).on('click', '#viewPrintRefundReceiptModal #preview-and-print', function(e) {
        e.preventDefault();

        let pdfWindow = window.open("");
        pdfWindow.document.write(`<iframe width="100%" height="100%" src="${$('#viewPrintRefundReceiptModal iframe').attr('src')}"></iframe>`);
        $(pdfWindow.document).find('body').css('padding', '0');
        $(pdfWindow.document).find('body').css('margin', '0');
        $(pdfWindow.document).find('iframe').css('border', '0');
    });

    $(document).on('click', '#modal-container form #delayedCreditModal #copy-delayed-credit', function(e) {
        e.preventDefault();

        $('#modal-container form#modal-form').attr('onsubmit', 'submitModalForm(event, this)');
        $('#modal-container form#modal-form').removeAttr('data-href');
        $('#modal-container form#modal-form .modal-body .row.customer-details').next().prepend(`<div class="col-md-12">
            <div class="alert alert-info alert-dismissible mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="mt-0">This is a copy</h6>
                <span>This is a copy of a delayed credit. Revise as needed and save the delayed credit.</span>
            </div>
        </div>`);

        $('#modal-container form#modal-form .modal-footer .row').children('div:nth-child(2)').addClass('d-flex').html(`<a href="#" class="text-white m-auto" onclick="makeRecurring('delayed_credit')">Make Recurring</a>`);
    });

    $(document).on('click', '#modal-container form #delayedCreditModal #delete-delayed-credit', function(e) {
        e.preventDefault();

        var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/delayed-credit/${split[1]}`,
            type: 'DELETE',
            success: function(result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#modal-container form #delayedChargeModal #copy-delayed-charge', function(e) {
        e.preventDefault();

        $('#modal-container form#modal-form').attr('onsubmit', 'submitModalForm(event, this)');
        $('#modal-container form#modal-form').removeAttr('data-href');
        $('#modal-container form#modal-form .modal-body .row.customer-details').next().prepend(`<div class="col-md-12">
            <div class="alert alert-info alert-dismissible mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="mt-0">This is a copy</h6>
                <span>This is a copy of a delayed charge. Revise as needed and save the delayed charge.</span>
            </div>
        </div>`);

        $('#modal-container form#modal-form .modal-footer .row').children('div:nth-child(2)').addClass('d-flex').html(`<a href="#" class="text-white m-auto" onclick="makeRecurring('delayed_charge')">Make Recurring</a>`);
    });

    $(document).on('click', '#modal-container form #delayedChargeModal #delete-delayed-charge', function(e) {
        e.preventDefault();

        var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/delayed-charge/${split[1]}`,
            type: 'DELETE',
            success: function(result) {
                location.reload();
            }
        });
    });

    $(document).on('show.bs.dropdown', '#modal-container .modal .modal-header .dropdown', function() {
        var tableId = $(this).find('table').attr('id');
        if($.fn.DataTable.isDataTable(`#${tableId}`)) {
            $(`#${tableId}`).DataTable().clear();
            $(`#${tableId}`).DataTable().destroy();
        }

        $(`#${tableId}`).DataTable({
            autoWidth: false,
            searching: false,
            processing: true,
            serverSide: true,
            lengthChange: false,
            pageLength: 10,
            info: false,
            ordering: false,
            paging: false,
            ajax: {
                url: '/accounting/load-recent-transactions',
                dataType: 'json',
                contentType: 'application/json',
                type: 'POST',
                data: function(d) {
                    d.transaction_type = tableId.replace('recent-', '');
                    return JSON.stringify(d);
                },
                pagingType: 'full_numbers'
            },
            columns: [
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'amount',
                    name: 'amount'
                },
                {
                    data: 'name',
                    name: 'name'
                }
            ],
            fnCreatedRow: function(row, data, dataIndex) {
                $(row).attr('onclick', 'viewTransaction(this)');
            },
            language: {
                emptyTable: `Once you enter some ${tableId.replace('recent-', '').replace('-', ' ')}, they'll appear here.`
            }
        });
    });

    $(document).on('click', '#viewPrintPurchaseOrderModal #print-pdf', function(e) {
        e.preventDefault();

        let pdfWindow = window.open("");
        pdfWindow.document.write(`<iframe width="100%" height="100%" src="${$('#viewPrintPurchaseOrderModal iframe').attr('src')}"></iframe>`);
        $(pdfWindow.document).find('body').css('padding', '0');
        $(pdfWindow.document).find('body').css('margin', '0');
        $(pdfWindow.document).find('iframe').css('border', '0');
    });

    $(document).on('hidden.bs.modal', '#viewPrintPurchaseOrderModal', function() {
        $(this).parent().remove();
    });

    $(document).on('click', '#sendEmailModal #print-pdf', function(e) {
        e.preventDefault();

        var src = $('#sendEmailModal iframe').attr('src');

        let pdfWindow = window.open("");
        pdfWindow.document.write(`<iframe width="100%" height="100%" src="${src}"></iframe>`);
        $(pdfWindow.document).find('body').css('padding', '0');
        $(pdfWindow.document).find('body').css('margin', '0');
        $(pdfWindow.document).find('iframe').css('border', '0');
    });

    $(document).on('click', '#sendEmailModal #send-and-close', function(e) {
        e.preventDefault();

        submitType = 'send-and-close';

        $('#sendEmailModal #send-email-form').submit();
    });

    $(document).on('click', '#sendEmailModal #send-and-new', function(e) {
        e.preventDefault();

        submitType = 'send-and-new';

        $('#sendEmailModal #send-email-form').submit();
    })

    $(document).on('submit', '#sendEmailModal #send-email-form', function(e) {
        e.preventDefault();

        var data = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function(result) {
                var res = JSON.parse(result);
                if(res.success === true) {
                    $('#sendEmailModal').modal('hide');

                    switch(submitType) {
                        case 'send-and-close' :
                            $('#purchaseOrderModal').modal('hide');
                        break;
                        case 'send-and-new' :
                            clearForm();
                        break;
                    }

                    toast(res.success, res.message);
                }
            }
        });
    });

    $(document).on('hidden.bs.modal', '#sendEmailModal', function() {
        $(this).parent().remove();
    });

    $(document).on('change', '#weeklyTimesheetModal #person_tracking, #weeklyTimesheetModal #weekDates', function() {
        var data = new FormData();

        data.set('person_tracking', $('#weeklyTimesheetModal #person_tracking').val());
        data.set('date_range', $('#weeklyTimesheetModal #weekDates').val());

        $.ajax({
            url: '/accounting/get-timesheet-activities',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function(result) {
                $('#weeklyTimesheetModal #clear-table-line').trigger('click');
                var res = JSON.parse(result);
                var activities = res.activities;
                if(activities.length > 0) {
                    $('#weeklyTimesheetModal').parent().attr('onsubmit', 'updateTransaction(event, this)').attr('data-href', `/accounting/update-transaction/weekly-timesheet/${res.timesheet.id}`);

                    var count = 0;
                    for (var row in activities) {
                        var activity = activities[row];
                        var hours = activity.hours;

                        if ($($('#weeklyTimesheetModal #timesheet-table tbody tr')[count]).length < 1) {
                            $('#weeklyTimesheetModal #timesheet-table tbody').append(`<tr>${rowInputs}</tr>`);
                            $('#weeklyTimesheetModal #timesheet-table tbody tr:last-child() td:first-child()').html(count + 1);

                            $('#weeklyTimesheetModal #timesheet-table tbody tr:last-child() select').val(null);
                            $('#weeklyTimesheetModal #timesheet-table tbody tr:last-child() input:not([type="checkbox"])').val('');
                            $('#weeklyTimesheetModal #timesheet-table tbody tr:last-child() textarea').val('');
                            $('#weeklyTimesheetModal #timesheet-table tbody tr:last-child() textarea').html('');
                            $('#weeklyTimesheetModal #timesheet-table tbody tr:last-child() input[name="billable[]"]').attr('id', `billable_${count+1}`).prop('checked', false).trigger('change');
                            $('#weeklyTimesheetModal #timesheet-table tbody tr:last-child() input[name="billable[]"]').next().attr('for', `billable_${count+1}`);
                        }

                        $($('#weeklyTimesheetModal #timesheet-table tbody tr')[count]).find('[name="customer[]"]').append(`<option value="${activity.customer_id}" selected>${activity.customer_name}</option>`).trigger('change');
                        $($('#weeklyTimesheetModal #timesheet-table tbody tr')[count]).find('[name="service[]"]').append(`<option value="${activity.service_id}" selected>${activity.service_name}</option>`);
                        $($('#weeklyTimesheetModal #timesheet-table tbody tr')[count]).find('[name="description[]"]').val(activity.description);

                        for (var day in hours) {
                            $($('#weeklyTimesheetModal #timesheet-table tbody tr')[count]).find(`[name="${day}_hours[]"]`).val(hours[day]);
                        }

                        $($('#weeklyTimesheetModal #timesheet-table tbody tr')[count]).find('[name="billable[]"]').prop('checked', activity.billable === "1");

                        if (activity.billable === "1") {
                            $($('#weeklyTimesheetModal #timesheet-table tbody tr')[count]).find('[name="billable[]"]').parent().parent().append(`<input type="number" name="hourly_rate[]" step=".01" value="${parseFloat(activity.hourly_rate).toFixed(2)}" onchange="convertToDecimal(this)" class="ml-2 w-25 form-control">
                            <div class="checkbox checkbox-sec">
                                <input type="checkbox" name="taxable[]" id="taxable_${count+1}" class="ml-2 form-check-input" value="1" ${activity.taxable === "1" ? 'checked' : ''}>
                                <label class="form-check-label" for="taxable_${count+1}">Taxable</label>
                            </div>`);
                        }

                        $($('#weeklyTimesheetModal #timesheet-table tbody tr')[count]).find('select').each(function() {
                            var field = $(this).attr('name').replace('[]', '');

                            $(this).select2({
                                ajax: {
                                    url: '/accounting/get-dropdown-choices',
                                    dataType: 'json',
                                    data: function(params) {
                                        var query = {
                                            search: params.term,
                                            type: 'public',
                                            field: field,
                                            modal: 'weeklyTimesheetModal'
                                        }
        
                                        // Query parameters will be ?search=[term]&type=public&field=[type]
                                        return query;
                                    }
                                },
                                templateResult: formatResult,
                                templateSelection: optionSelect
                            });
                        });

                        var days = Object.keys(hours);
                        var lastDay = days[days.length - 1];
                        $($('#weeklyTimesheetModal #timesheet-table tbody tr')[count]).find(`[name="${lastDay}_hours[]"]`).trigger('change');

                        count++;
                    }
                } else {
                    $('#weeklyTimesheetModal').parent().attr('onsubmit', 'submitModalForm(event, this)').removeAttr('data-href');
                }
            }
        });
    });

    $(document).on('click', '#modal-container form .modal .modal-footer #save-template', function(e) {
        e.preventDefault();

        submitType = 'save-and-close';

        $('#modal-form').submit();
    });

    $(document).on('change', '#invoiceModal #customer', function() {
        $.get(`/accounting/get-customer-details/${$(this).val()}`, function(result) {
            var customer = JSON.parse(result);

            if (customer.business_name !== "" && customer.business_name !== null) {
                $('#invoiceModal #billing-address').append(customer.business_name);
                $('#invoiceModal #billing-address').append('\n');
            } else {
                var customerName = '';
                customerName += customer.first_name !== "" ? customer.first_name + " " : "";
                customerName += customer.middle_name !== "" ? customer.middle_name + " " : "";
                customerName += customer.last_name !== "" ? customer.last_name : "";
                $('#invoiceModal #billing-address').html(customerName.trim());
                $('#invoiceModal #billing-address').append('\n');
            }
            var address = '';
            address += customer.mail_add !== "" ? customer.mail_add : "";
            address += customer.city !== "" ? '\n' + customer.city : "";
            address += customer.state !== "" ? ', ' + customer.state : "";
            address += customer.zip_code !== "" ? ' ' + customer.zip_code : "";
            address += customer.country !== "" ? ' ' + customer.country : "";

            $('#invoiceModal #billing-address').append(address.trim());
            $('#invoiceModal #customer-email').val(customer.email);
        });
    });

    $(document).on('keyup', '#receivePaymentModal #invoice-no', function(e) {
        $('#receivePaymentModal #invoice-no').removeClass('border-danger');
    });

    $(document).on('keyup', '#receivePaymentModal #search-invoice-no', function() {
        $('#receivePaymentModal #invoices-table').DataTable().ajax.reload(null, true);
    });

    $(document).on('change', '#receivePaymentModal #invoices_table_rows', function() {
        $('#receivePaymentModal #invoices-table').DataTable().ajax.reload(null, true);
    });

    $(document).on('change', '#receivePaymentModal #invoices-table thead #select-all-invoices', function() {
        $('#receivePaymentModal #invoices-table tbody input[type="checkbox"]').prop('checked', $(this).prop('checked')).trigger('change');
    });

    $(document).on('change', '#receivePaymentModal #invoices-table tbody input[type="checkbox"]', function() {
        var row = $(this).parent().parent().parent().parent();
        if($(this).prop('checked')) {
            var rowData = $('#receivePaymentModal #invoices-table').DataTable().row(row).data();

            $(row).find('input[name="payment[]"]').val(rowData.open_balance).trigger('change');
        } else {
            $(row).find('input[name="payment[]"]').val('').trigger('change');
        }

        var checked = $('#receivePaymentModal #invoices-table tbody input[type="checkbox"]:checked').length;
        var all = $('#receivePaymentModal #invoices-table tbody input[type="checkbox"]').length;

        $('#receivePaymentModal #invoices-table thead #select-all-invoices').prop('checked', checked === all);

        $('#receivePaymentModal #credit-memo-table tbody tr').each(function() {
            if($(this).find('td.dataTables_empty').length < 1) {
                var rowData = $('#receivePaymentModal #credit-memo-table').DataTable().row($(this)).data();

                if(checked > 0) {
                    if($(this).find('input[type="checkbox"]').length < 1) {
                        $(this).find('td:first-child').html(`<div class="d-flex justify-content-center">
                            <div class="checkbox checkbox-sec m-0">
                                <input type="checkbox" id="${rowData.type}-${rowData.id}" value="${rowData.type}_${rowData.id}">
                                <label for="${rowData.type}-${rowData.id}" class="p-0" style="width: 24px; height: 24px"></label>
                            </div>
                        </div>`);
                    }
                } else {
                    $(this).find('td:first-child').html('');
                }
            }
        });
    });

    $(document).on('change', '#receivePaymentModal #credit-memo-table thead #select-all-credit-memo', function() {
        $('#receivePaymentModal #credit-memo-table tbody input[type="checkbox"]').prop('checked', $(this).prop('checked')).trigger('change');
    });

    $(document).on('change', '#receivePaymentModal #credit-memo-table tbody input[type="checkbox"]', function() {
        var row = $(this).parent().parent().parent().parent();
        if($(this).prop('checked')) {
            var rowData = $('#receivePaymentModal #credit-memo-table').DataTable().row(row).data();

            $(row).find('input[name="credit_payment[]"]').val(rowData.open_balance).trigger('change');
        } else {
            $(row).find('input[name="credit_payment[]"]').val('').trigger('change');
        }

        var checked = $('#receivePaymentModal #credit-memo-table tbody input[type="checkbox"]:checked').length;
        var all = $('#receivePaymentModal #credit-memo-table tbody input[type="checkbox"]').length;

        $('#receivePaymentModal #credit-memo-table thead #select-all-credit-memo').prop('checked', checked === all);
    });

    $(document).on('change', '#receivePaymentModal #received-amount', function() {
        receivedAmountIsChanged = true;

        var receivedAmount = parseFloat($(this).val());
        var invoiceTotal = 0.00;
        $('#receivePaymentModal #invoices-table tbody input[name="payment[]"]').each(function() {
            var checked = $(this).parent().parent().find('input[type="checkbox"]').prop('checked');
            if(checked) {
                invoiceTotal = parseFloat(invoiceTotal) + parseFloat($(this).val());
            }
        });

        var creditAmount = 0.00;
        $('#receivePaymentModal #credit-memo-table tbody input[name="credit_payment[]"]').each(function() {
            var checked = $(this).parent().parent().find('input[type="checkbox"]').prop('checked');
            if(checked) {
                creditAmount = parseFloat(creditAmount) + parseFloat($(this).val());
            }
        });

        var total = parseFloat(invoiceTotal) - parseFloat(creditAmount);

        var amountToCredit = receivedAmount - parseFloat(total);
        $('#receivePaymentModal span.amount-to-credit').html(formatter.format(parseFloat(amountToCredit)));

        if(parseFloat(amountToCredit.replace('$', '').replaceAll(',', '')) > 0) {
            $('#receivePaymentModal #credit-message').html(`This transaction will create an additional credit in the amount of ${formatter.format(parseFloat(amountToCredit))}`);
            $('#receivePaymentModal #credit-message').parent().parent().removeClass('d-none');
        } else {
            $('#receivePaymentModal #credit-message').html('');
            $('#receivePaymentModal #credit-message').parent().parent().addClass('d-none');
        }

        var amountToApply = parseFloat(receivedAmount) + parseFloat(creditAmount);
        $('#receivePaymentModal span.amount-to-apply').html(formatter.format(parseFloat(amountToApply)));

        $('#receivePaymentModal .transaction-total-amount').html(formatter.format(parseFloat(receivedAmount)));
    });

    $(document).on('change', '#receivePaymentModal #credit-memo-table tbody input[name="credit_payment[]"]', function() {
        var row = $(this).parent().parent();
        var rowData = $('#receivePaymentModal #credit-memo-table').DataTable().row(row).data();

        if($(this).val() !== '' && $(this).val() !== '0.00') {
            row.find('input[type="checkbox"]').prop('checked', true);

            var checked = $('#receivePaymentModal #credit-memo-table tbody input[type="checkbox"]:checked').length;
            var all = $('#receivePaymentModal #credit-memo-table tbody input[type="checkbox"]').length;
            $('#receivePaymentModal #credit-memo-table thead #select-all-credit-memo').prop('checked', checked === all);
        } else {
            row.find('input[type="checkbox"]').prop('checked', false);
            $('#receivePaymentModal #credit-memo-table thead #select-all-credit-memo').prop('checked', false);
        }

        if($('#modal-form').attr('data-href') !== false && typeof $('#modal-form').attr('data-href') !== 'undefined') {
            var totalBal = parseFloat(rowData.open_balance) + parseFloat(rowData.payment_amount);
            if(parseFloat($(this).val()) > parseFloat(totalBal)) {
                $(this).val(parseFloat(totalBal).toFixed(2));
            }
        } else {
            if(parseFloat($(this).val()) > parseFloat(rowData.open_balance)) {
                $(this).val(rowData.open_balance);
            }
        }

        var invoicePayment = 0.00;
        $('#receivePaymentModal #invoices-table tbody input[name="payment[]"]').each(function() {
            var checked = $(this).parent().parent().find('input[type="checkbox"]').prop('checked');
            if(checked) {
                invoicePayment = parseFloat(invoicePayment) + parseFloat($(this).val());
            }
        });

        var creditAmount = 0.00;
        $('#receivePaymentModal #credit-memo-table tbody input[name="credit_payment[]"]').each(function() {
            var checked = $(this).parent().parent().find('input[type="checkbox"]').prop('checked');
            if(checked) {
                creditAmount = parseFloat(creditAmount) + parseFloat($(this).val());
            }
        });

        if(parseFloat(creditAmount) > parseFloat(invoicePayment)) {
            var val = $(this).val();
            var diff = parseFloat(creditAmount) - parseFloat(invoicePayment);
            val = parseFloat(val) - parseFloat(diff);
            val = parseFloat(val).toFixed(2);
            $(this).val(val);

            creditAmount = 0.00;
            $('#receivePaymentModal #credit-memo-table tbody input[name="credit_payment[]"]').each(function() {
                var checked = $(this).parent().parent().find('input[type="checkbox"]').prop('checked');
                if(checked) {
                    creditAmount = parseFloat(creditAmount) + parseFloat($(this).val());
                }
            });
        }

        var total = parseFloat(invoicePayment) - parseFloat(creditAmount);

        if(receivedAmountIsChanged === false) {
            $('#receivePaymentModal #received-amount').val(parseFloat(total).toFixed(2));
            $('#receivePaymentModal span.transaction-total-amount').html(formatter.format(parseFloat(total)));
            $('#receivePaymentModal span.amount-to-apply').html(formatter.format(parseFloat(invoicePayment)));
        } else {
            var receivedAmount = parseFloat($('#receivePaymentModal #received-amount').val());
            var amountToApply = parseFloat(receivedAmount) + parseFloat(creditAmount);
            $('#receivePaymentModal span.amount-to-apply').html(formatter.format(parseFloat(amountToApply)));
            var amountToCredit = parseFloat(receivedAmount) - parseFloat(total);
            $('#receivePaymentModal span.amount-to-credit').html(formatter.format(parseFloat(amountToCredit)));

            if(parseFloat(amountToCredit.replace('$', '').replaceAll(',', '')) > 0) {
                $('#receivePaymentModal #credit-message').html(`This transaction will create an additional credit in the amount of ${formatter.format(parseFloat(amountToCredit))}`);
                $('#receivePaymentModal #credit-message').parent().parent().removeClass('d-none');
            } else {
                $('#receivePaymentModal #credit-message').html('');
                $('#receivePaymentModal #credit-message').parent().parent().addClass('d-none');
            }
        }
    });

    $(document).on('change', '#receivePaymentModal #invoices-table tbody input[name="payment[]"]', function() {
        var row = $(this).parent().parent();
        var rowData = $('#receivePaymentModal #invoices-table').DataTable().row(row).data();

        if($(this).val() !== '' && $(this).val() !== "0.00") {
            row.find('input[type="checkbox"]').prop('checked', true);

            var checked = $('#receivePaymentModal #invoices-table tbody input[type="checkbox"]:checked').length;
            var all = $('#receivePaymentModal #invoices-table tbody input[type="checkbox"]').length;

            $('#receivePaymentModal #invoices-table thead #select-all-invoices').prop('checked', checked === all);

            if($('#modal-form').attr('data-href') !== false && typeof $('#modal-form').attr('data-href') !== 'undefined') {
                var totalBal = parseFloat(rowData.open_balance) + parseFloat(rowData.payment_amount);
                if(parseFloat($(this).val()) > parseFloat(totalBal)) {
                    $(this).val(parseFloat(totalBal).toFixed(2));
                }
            } else {
                if(parseFloat($(this).val()) > parseFloat(rowData.open_balance)) {
                    $(this).val(rowData.open_balance);
                }
            }
        } else {
            row.find('input[type="checkbox"]').prop('checked', false);
            $('#receivePaymentModal #invoices-table thead #select-all-invoices').prop('checked', false);
        }

        var invoicePayment = 0.00;
        $('#receivePaymentModal #invoices-table tbody input[name="payment[]"]').each(function() {
            var checked = $(this).parent().parent().find('input[type="checkbox"]').prop('checked');
            if(checked) {
                invoicePayment = parseFloat(invoicePayment) + parseFloat($(this).val());
            }
        });

        var creditAmount = 0.00;
        $('#receivePaymentModal #credit-memo-table tbody input[name="credit_payment[]"]').each(function() {
            var checked = $(this).parent().parent().find('input[type="checkbox"]').prop('checked');
            if(checked) {
                creditAmount = parseFloat(creditAmount) + parseFloat($(this).val());
            }
        });

        if(parseFloat(creditAmount) > parseFloat(invoicePayment)) {
            var el = null;
            var val = null;
            $('#receivePaymentModal #credit-memo-table tbody input[name="credit_payment[]"]').each(function() {
                var checked = $(this).parent().parent().find('input[type="checkbox"]').prop('checked');
                if(checked) {
                    el = $(this);
                    val = $(this).val();
                }
            });
            var diff = parseFloat(creditAmount) - parseFloat(invoicePayment);
            val = parseFloat(val) - parseFloat(diff);
            val = parseFloat(val).toFixed(2);
            el.val(val);

            creditAmount = 0.00;
            $('#receivePaymentModal #credit-memo-table tbody input[name="credit_payment[]"]').each(function() {
                var checked = $(this).parent().parent().find('input[type="checkbox"]').prop('checked');
                if(checked) {
                    creditAmount = parseFloat(creditAmount) - parseFloat($(this).val());
                }
            });
        }

        var total = parseFloat(invoicePayment) - parseFloat(creditAmount);

        if(receivedAmountIsChanged === false) {
            $('#receivePaymentModal #received-amount').val(parseFloat(total).toFixed(2));
            $('#receivePaymentModal span.transaction-total-amount').html(formatter.format(parseFloat(total)));
            $('#receivePaymentModal span.amount-to-apply').html(formatter.format(parseFloat(invoicePayment)));
        } else {
            var receivedAmount = parseFloat($('#receivePaymentModal #received-amount').val());
            var amountToApply = parseFloat(receivedAmount) + parseFloat(creditAmount);
            $('#receivePaymentModal span.amount-to-apply').html(formatter.format(parseFloat(amountToApply)));
            var amountToCredit = parseFloat(receivedAmount) - parseFloat(total);
            $('#receivePaymentModal span.amount-to-credit').html(formatter.format(parseFloat(amountToCredit)));

            if(parseFloat(amountToCredit.replace('$', '').replaceAll(',', '')) > 0) {
                $('#receivePaymentModal #credit-message').html(`This transaction will create an additional credit in the amount of ${formatter.format(parseFloat(amountToCredit))}`);
                $('#receivePaymentModal #credit-message').parent().parent().removeClass('d-none');
            } else {
                $('#receivePaymentModal #credit-message').html('');
                $('#receivePaymentModal #credit-message').parent().parent().addClass('d-none');
            }
        }
    });

    $(document).on('click', '#receivePaymentModal #clear-payment', function(e) {
        e.preventDefault();

        $('#receivePaymentModal #received-amount').val('0.00');
        $('#receivePaymentModal span.transaction-total-amount').html('$0.00');
        $('#receivePaymentModal span.amount-to-apply').html('$0.00');
        $('#receivePaymentModal span.amount-to-credit').html('$0.00');

        $('#receivePaymentModal #invoices-table input[type="checkbox"]').prop('checked', false);
        $('#receivePaymentModal #invoices-table tbody input[name="payment[]"]').val('');
        $('#receivePaymentModal #credit-memo-table input[type="checkbox"]').prop('checked', false);
        $('#receivePaymentModal #credit-memo-table tbody input[name="credit_payment[]"]').val('');
    });

    $(document).on('change', '#modal-container #modal-form #receivePaymentModal #customer', function(e) {
        var id = $(this).val();

        loadCustomerInvoices(id);
        loadCustomerCredits(id);

        if($('#receivePaymentModal #invoices-table tbody tr td:not(.dataTables_empty)').length === 0) {
            $('#receivePaymentModal .display-with-customer:first-child').removeClass('hide');
        }

        if($('#receivePaymentModal #credit-memo-table tbody tr td:not(.dataTables_empty)').length === 0) {
            $('#receivePaymentModal .display-with-customer').removeClass('hide');
        }
    });

    $(document).on('click', '#receivePaymentModal #credit-memo-table tbody tr a', function(e) {
        e.preventDefault();

        var url = $(this).attr('href');
        var row = $(this).parent().parent();
        var data = $('#receivePaymentModal #credit-memo-table').DataTable().row(row).data();
        $('#receivePaymentModal').modal('hide');

        $.get(url, function(res) {
            if ($('div#modal-container').length > 0) {
                $('div#modal-container').html(res);
            } else {
                $('body').append(`
                    <div id="modal-container"> 
                        ${res}
                    </div>
                `);
            }
    
            if(data.type === 'credit-memo') {
                initModalFields('creditMemoModal', data);

                $('#creditMemoModal').modal('show');
            } else {
                initModalFields('receivePaymentModal', data);

                $('#receivePaymentModal').modal('show');
            }
        });
    });

    $(document).on('change', '#creditMemoModal #customer', function() {
        $.get(`/accounting/get-customer-details/${$(this).val()}`, function(result) {
            var customer = JSON.parse(result);

            if (customer.business_name !== "" && customer.business_name !== null) {
                $('#creditMemoModal #billing-address').append(customer.business_name);
                $('#creditMemoModal #billing-address').append('\n');
            } else {
                var customerName = '';
                customerName += customer.first_name !== "" ? customer.first_name + " " : "";
                customerName += customer.middle_name !== "" ? customer.middle_name + " " : "";
                customerName += customer.last_name !== "" ? customer.last_name : "";
                $('#creditMemoModal #billing-address').html(customerName.trim());
                $('#creditMemoModal #billing-address').append('\n');
            }
            var address = '';
            address += customer.mail_add !== "" ? customer.mail_add : "";
            address += customer.city !== "" ? '\n' + customer.city : "";
            address += customer.state !== "" ? ', ' + customer.state : "";
            address += customer.zip_code !== "" ? ' ' + customer.zip_code : "";
            address += customer.country !== "" ? ' ' + customer.country : "";

            $('#creditMemoModal #billing-address').append(address.trim());
            $('#creditMemoModal #email').val(customer.email);
        });
    });

    $(document).on('click', '#modal-container a#add_item', function(e) {
        e.preventDefault();

        if ($('#modal-container #item_list.modal').length === 0) {
            $.get('/accounting/get-items-list-modal', function(res) {
                $('#modal-container').append(res);

                $('#modal-container #item_list table').DataTable({
                    autoWidth: false,
                    searching: false,
                    processing: true,
                    lengthChange: false,
                    info: false,
                    pageLength: 10,
                    ordering: false
                });

                $('#modal-container #item_list').modal('show');
            });
        } else {
            $('#modal-container #item_list').modal('show');
        }
    });

    $(document).on('click', '#modal-container #item_list table button', function(e) {
        e.preventDefault();
        var id = e.currentTarget.dataset.id;

        $.get('/accounting/get-item-details/' + id, function(res) {
            var result = JSON.parse(res);
            var item = result.item;
            var type = item.type;
            var locations = result.locations;
            var locs = '';

            if(item.type.toLowerCase() === 'product' || item.type.toLowerCase() === 'inventory') {
                locs += '<select name="location[]" class="form-control" required>';
                for (var i in locations) {
                    locs += `<option value="${locations[i].id}">${locations[i].name}</option>`;
                }
                locs += '</select>';
            }

            var fields = `
                <td>${item.title}<input type="hidden" name="item[]" value="${item.id}"></td>
                <td>${type.charAt(0).toUpperCase() + type.slice(1)}</td>
                <td>${locs}</td>
                <td><input type="number" name="quantity[]" class="form-control text-right" required value="0" min="0"></td>
                <td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="${item.price}"></td>
                <td><input type="number" name="discount[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="0.00"></td>
                <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="7.50"></td>
                <td><span class="row-total">$0.00</span></td>
                <td>
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="#" class="deleteRow"><i class="fa fa-trash"></i></a>
                    </div>
                </td>
            `;

            if($('#modal-container form#modal-form').length > 0) {
                $('#modal-container form#modal-form .modal #item-table tbody:not(#package-items-table)').append(`<tr>${fields}</tr>`);

                $('#modal-container form#modal-form .modal #item-table tbody:not(#package-items-table) tr:last-child select').select2({
                    minimumResultsForSearch: -1
                });
            } else {
                $('#modal-container form#update-recurring-form .modal #item-table tbody:not(#package-items-table)').append(`<tr>${fields}</tr>`);

                $('#modal-container form#update-recurring-form .modal #item-table tbody:not(#package-items-table) tr:last-child select').select2({
                    minimumResultsForSearch: -1
                });
            }
        });
    });

    $(document).on('click', '#modal-container a#add_group', function(e) {
        e.preventDefault();

        if ($('#modal-container #item_category_list.modal').length === 0) {
            $.get('/accounting/get-items-categories-list-modal', function(res) {
                $('#modal-container').append(res);

                $('#modal-container #item_category_list table').DataTable({
                    autoWidth: false,
                    searching: false,
                    processing: true,
                    lengthChange: false,
                    info: false,
                    pageLength: 10,
                    ordering: false
                });

                $('#modal-container #item_category_list').modal('show');
            });
        } else {
            $('#modal-container #item_category_list').modal('show');
        }
    });

    $(document).on('click', '#modal-container a#add_create_package', function(e) {
        e.preventDefault();

        if ($('#modal-container #package_list.modal').length === 0) {
            $.get('/accounting/get-package-list-modal', function(res) {
                $('#modal-container').append(res);

                $('#modal-container #package_list').modal('show');
            });
        } else {
            $('#modal-container #package_list').modal('show');
        }
    });

    $(document).on('click', '#modal-container #item_category_list table button', function(e) {
        e.preventDefault();
        var id = e.currentTarget.dataset.id;

        $.get('/accounting/get-category-items/' + id, function(res) {
            var items = JSON.parse(res);

            for(var i in items) {
                var type = items[i].type;
                var locations = items[i].locations;
                var locs = '';

                if(type.toLowerCase() === 'product' || type.toLowerCase() === 'inventory') {
                    locs += '<select name="location[]" class="form-control" required>';
                    for (var o in locations) {
                        locs += `<option value="${locations[o].id}">${locations[o].name}</option>`;
                    }
                    locs += '</select>';
                }

                var fields = `
                    <td>${items[i].title}<input type="hidden" name="item[]" value="${items[i].id}"></td>
                    <td>${type.charAt(0).toUpperCase() + type.slice(1)}</td>
                    <td>${locs}</td>
                    <td><input type="number" name="quantity[]" class="form-control text-right" required value="0" min="0"></td>
                    <td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="${items[i].price}"></td>
                    <td><input type="number" name="discount[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="0.00"></td>
                    <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="7.50"></td>
                    <td><span class="row-total">$0.00</span></td>
                    <td>
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="#" class="deleteRow"><i class="fa fa-trash"></i></a>
                        </div>
                    </td>
                `;

                if($('#modal-container form#modal-form').length > 0) {
                    $('#modal-container form#modal-form .modal #item-table tbody:not(#package-items-table)').append(`<tr>${fields}</tr>`);

                    $('#modal-container form#modal-form .modal #item-table tbody:not(#package-items-table) tr:last-child select').select2({
                        minimumResultsForSearch: -1
                    });
                } else {
                    $('#modal-container form#update-recurring-form .modal #item-table tbody:not(#package-items-table)').append(`<tr>${fields}</tr>`);

                    $('#modal-container form#update-recurring-form .modal #item-table tbody:not(#package-items-table) tr:last-child select').select2({
                        minimumResultsForSearch: -1
                    });
                }
            }
        });
    });

    $(document).on('click', '#modal-container #package_list table#package-table button.addNewPackageToList', function(e) {
        e.preventDefault();
        var id = e.currentTarget.dataset.id;

        $.get('/accounting/get-package-details/' + id, function(res) {
            var result = JSON.parse(res);
            var details = result.package;
            var items = result.items;

            var fields = `
                <td>${details.name}<input type="hidden" name="package[]" value="${details.id}"></td>
                <td>Package</td>
                <td></td>
                <td><input type="number" name="quantity[]" class="form-control text-right" required value="0" min="0"></td>
                <td><span class="item-amount">${parseFloat(details.amount_set).toFixed(2)}</span></td>
                <td></td>
                <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="7.50"></td>
                <td><span class="row-total">$0.00</span></td>
                <td>
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="#" class="deleteRow"><i class="fa fa-trash"></i></a>
                    </div>
                </td>
            `;

            if($('#modal-container form#modal-form').length > 0) {
                $('#modal-container form#modal-form .modal #item-table tbody:not(#package-items-table)').append(`<tr class="package">${fields}</tr>`);
            } else {
                $('#modal-container form#update-recurring-form .modal #item-table tbody:not(#package-items-table)').append(`<tr class="package">${fields}</tr>`);
            }

            var packageItems = `
                <td colspan="3">
                    <table class="table m-0 bg-white">
                        <thead>
                            <tr class="package-item-header">
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody id="package-items-table">`;

            for(var i in items) {
                packageItems += `<tr class="package-item"><td>${items[i].details.title}</td><td>${items[i].quantity}</td><td>${parseFloat(items[i].price).toFixed(2)}</td></tr>`;
            }

            packageItems += `
                        </tbody>
                    </table>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            `;

            if($('#modal-container form#modal-form').length > 0) {
                $('#modal-container form#modal-form .modal #item-table tbody:not(#package-items-table)').append(`<tr class="package-items">${packageItems}</tr>`);
            } else {
                $('#modal-container form#update-recurring-form .modal #item-table tbody:not(#package-items-table)').append(`<tr class="package-items">${packageItems}</tr>`);
            }
        });
    });

    $(document).on('click', '#modal-container #package_list #add_package_item', function(e) {
        e.preventDefault();

        if ($('#modal-container #package_item_list.modal').length === 0) {
            $.get('/accounting/get-items-list-modal', function(res) {
                $('#modal-container').append(res);

                $('#modal-container #item_list').attr('id', 'package_item_list');

                $('#modal-container #package_item_list table').DataTable({
                    autoWidth: false,
                    searching: false,
                    processing: true,
                    lengthChange: false,
                    info: false,
                    pageLength: 10,
                    ordering: false
                });

                $('#modal-container #package_item_list').modal('show');
            });
        } else {
            $('#modal-container #package_item_list').modal('show');
        }
    });

    $(document).on('click', '#modal-container #package_item_list table button', function(e) {
        e.preventDefault();
        var id = e.currentTarget.dataset.id;

        $.get('/accounting/get-item-details/' + id, function(res) {
            var result = JSON.parse(res);
            var item = result.item;

            var fields = `
                <td>${item.title}<input type="hidden" name="item[]" value="${item.id}"></td>
                <td><input type="number" name="quantity[]" class="form-control text-right" required value="0" min="0"></td>
                <td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="${item.price}"></td>
                <td><a href="#" class="remove btn btn-sm btn-success" id="149"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
            `;

            $('#modal-container #package_list #package-items-table tbody').append(`<tr>${fields}</tr>`);
        });
    });

    $(document).on('click', '#modal-container #package_list #create-package', function(e) {
        e.preventDefault();

        var data = new FormData();

        data.set('name', $('#modal-container #package_list #package_name').val());
        data.set('total_price', $('#modal-container #package_list #package_price').val());
        data.set('amount_set', $('#modal-container #package_list #package_price_set').val());

        $('#modal-container #package_list #package-items-table tbody tr').each(function() {
            if(data.has('item[]')) {
                data.append('item[]', $(this).find('[name="item[]"]').val());
                data.append('quantity[]', $(this).find('[name="quantity[]"]').val());
                data.append('item_amount[]', $(this).find('[name="item_amount[]"]').val());
            } else {
                data.set('item[]', $(this).find('[name="item[]"]').val());
                data.set('quantity[]', $(this).find('[name="quantity[]"]').val());
                data.set('item_amount[]', $(this).find('[name="item_amount[]"]').val());
            }
        });

        $.ajax({
            url: '/accounting/add-package',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function(result) {
                var res = JSON.parse(result);

                if(res.success) {
                    var appendPackage = `<tr>
                        <td>${res.id}</td>
                        <td>${data.get('name')}</td>
                        <td></td>
                        <td class="text-success"></td>
                        <td class="text-success">${data.get('amount_set')}</td>
                        <td class="text-error">
                            <button id="${res.id}" data-id="${res.id}" type="button" data-dismiss="modal" class="btn btn-sm btn-default addNewPackageToList">
                                <span class="fa fa-plus"></span>
                            </button>
                        </td>
                        <td><a href="#" data-toggle="collapse" data-target="#demo${res.id}" data-parent="#package-table" id="packageID" data-id="${res.id}"><i class="fa fa-sort-down" style="font-size:24px"></i></a></td>
                    </tr>`;
                    $('#modal-container #package_list #package-table tbody').append(appendPackage);

                    var appendPackageItems = `<tr id="demo${res.id}" class="collapse">
                        <td colspan="6" class="hiddenRow">
                            <div id="packageItems<?=$pItems->id?>">
                                <table>
                                    <tbody>`;

                    $('#modal-container #package_list #package-items-table tbody tr').each(function() {
                        appendPackageItems += `<tr>
                            <td></td>
                            <td>${$(this).find('[name="item[]"]').parent().text()}</td>
                            <td>${$(this).find('[name="quantity[]"]').val()}</td>
                            <td>${$(this).find('[name="item_amount[]"]').val()}</td>
                        </tr>`;
                    });

                    appendPackageItems += `</tbody>
                                </table>
                            </div>
                        </td>
                    </tr>`;

                    $('#modal-container #package_list #package-table tbody').append(appendPackageItems);

                    $('#modal-container #package_list #package_name').val('')
                    $('#modal-container #package_list #package_price').val('');
                    $('#modal-container #package_list #package_price_set').val('');

                    $('#modal-container #package_list #package-items-table tbody tr').each(function() {
                        $(this).remove();
                    });
                }
            }
        });
    });

    $(document).on('change', '#modal-container #package_list #package-items-table input[name="quantity[]"], #modal-container #package_list #package-items-table input[name="item_amount[]"]', function() {
        var total = 0.00;

        $('#modal-container #package_list #package-items-table tbody tr').each(function() {
            var quantity = $(this).find('[name="quantity[]"]').val();
            var amount = $(this).find('[name="item_amount[]"]').val();
            var rowTotal = parseFloat(amount) * parseFloat(quantity);

            total = parseFloat(total) + parseFloat(rowTotal);
        });

        $('#modal-container #package_list #package_price').val(parseFloat(total).toFixed(2));
    });

    $(document).on('change', '#modal-container form .modal #item-table tbody tr input', function() {
        var quantityEl = $(this).parent().parent().find('input[name="quantity[]"]');
        var quantity = quantityEl.length > 0 ? quantityEl.val() : 0.00;
        var amountEl = $(this).parent().parent().find('input[name="item_amount[]"]');
        var amount = amountEl.length > 0 ? amountEl.val() : $(this).parent().parent().find('span.item-amount').html();
        var discountEl = $(this).parent().parent().find('input[name="discount[]"]');
        var discount = discountEl.length > 0 ? discountEl.val() : 0.00;
        var taxEl = $(this).parent().parent().find('input[name="item_tax[]"]');
        var tax = taxEl.length > 0 ? taxEl.val() : 0.00;

        var amount = parseFloat(amount) * parseInt(quantity);
        var taxAmount = parseFloat(tax) * amount / 100;
        var total = parseFloat(amount) + parseFloat(taxAmount) - parseFloat(discount);

        $(this).parent().parent().find('.row-total').html(formatter.format(parseFloat(total)));

        var subtotal = 0.00;
        var taxes = 0.00;
        var discounts = 0.00;
        $('#modal-container form .modal #item-table tbody tr:not(.package-items, .package-item, .package-item-header)').each(function() {
            var itemAmount = $(this).find('input[name="item_amount[]"]').length > 0 ? $(this).find('input[name="item_amount[]"]').val() : $(this).find('span.item-amount').html();
            var itemQty = $(this).find('input[name="quantity[]"]').length > 0 ? $(this).find('input[name="quantity[]"]').val() : 0;
            var itemDisc = $(this).find('input[name="discount[]"]').length > 0 ? $(this).find('input[name="discount[]"]').val() : 0.00;
            var itemTax = $(this).find('input[name="item_tax[]"]').length > 0 ? $(this).find('input[name="item_tax[]"]').val() : 0.00;

            var itemTotal = parseFloat(itemAmount) * parseFloat(itemQty);
            var taxAmount = parseFloat(itemTax) * itemTotal / 100;

            subtotal = parseFloat(subtotal) + parseFloat(itemTotal);
            taxes = parseFloat(taxes) + parseFloat(taxAmount);
            discounts = parseFloat(discounts) + parseFloat(itemDisc);
        });

        $('#modal-container form .modal span.transaction-subtotal').html(formatter.format(parseFloat(subtotal)));
        $('#modal-container form .modal span.transaction-taxes').html(formatter.format(parseFloat(taxes)));
        $('#modal-container form .modal span.transaction-discounts').html(formatter.format(parseFloat(discounts)));
        $('#modal-container form .modal #adjustment_input_cm').trigger('change');
    });

    $(document).on('change', '#modal-container form .modal #adjustment_input_cm', function() {
        var value = $(this).val();
        var subtotal = $('#modal-container form .modal span.transaction-subtotal').html().replace('$', '').replaceAll(',', '');
        var taxes = $('#modal-container form .modal span.transaction-taxes').html().replace('$', '').replaceAll(',', '');
        var discounts = $('#modal-container form .modal span.transaction-discounts').html().replace('$', '').replaceAll(',', '');

        var grandTotal = parseFloat(subtotal) + parseFloat(taxes);
        grandTotal -= parseFloat(discounts);
        grandTotal -= parseFloat(value);
        if($('#modal-container form .modal').attr('id') === 'creditMemoModal' && $('#creditMemoModal #total-payment-amount').length > 0) {
            grandTotal -= parseFloat($('#creditMemoModal #total-payment-amount').html().replace('$', '').replaceAll(',', ''));
        }

        $('#modal-container form .modal span.transaction-adjustment').html(formatter.format(parseFloat(value)));
        $('#modal-container form .modal span.transaction-grand-total').html(formatter.format(parseFloat(grandTotal)));
    });

    $(document).on('click', '#modal-container form .modal #item-table .deleteRow', function() {
        if($(this).parent().parent().parent().hasClass('package')) {
            $(this).parent().parent().parent().next().remove();
        }
        $(this).parent().parent().parent().remove();

        var subtotal = 0.00;
        var taxes = 0.00;
        var discounts = 0.00;
        $('#modal-container form .modal #item-table tbody tr').each(function() {
            var itemAmount = $(this).parent().parent().find('input[name="item_amount[]"]').val();
            var itemQty = $(this).parent().parent().find('input[name="quantity[]"]').val();
            var itemDisc = $(this).parent().parent().find('input[name="discount[]"]').val();
            var itemTax = $(this).parent().parent().find('input[name="item_tax[]"]').val();

            var itemTotal = parseFloat(itemAmount) * parseFloat(itemQty);
            var taxAmount = parseFloat(itemTax) * itemTotal / 100;

            subtotal = parseFloat(subtotal) + parseFloat(itemTotal);
            taxes = parseFloat(taxes) + parseFloat(taxAmount);
            discounts = parseFloat(discounts) + parseFloat(itemDisc);
        });

        $('#modal-container form .modal span.transaction-subtotal').html(formatter.format(parseFloat(subtotal)));
        $('#modal-container form .modal span.transaction-taxes').html(formatter.format(parseFloat(taxes)));
        $('#modal-container form .modal span.transaction-discounts').html(formatter.format(parseFloat(discounts)));
        $('#modal-container form .modal #adjustment_input_cm').trigger('change');
    });

    $(document).on('change', '#salesReceiptModal #customer', function() {
        $.get(`/accounting/get-customer-details/${$(this).val()}`, function(result) {
            var customer = JSON.parse(result);

            if (customer.business_name !== "" && customer.business_name !== null) {
                $('#salesReceiptModal #billing-address').append(customer.business_name);
                $('#salesReceiptModal #billing-address').append('\n');
            } else {
                var customerName = '';
                customerName += customer.first_name !== "" ? customer.first_name + " " : "";
                customerName += customer.middle_name !== "" ? customer.middle_name + " " : "";
                customerName += customer.last_name !== "" ? customer.last_name : "";
                $('#salesReceiptModal #billing-address').html(customerName.trim());
                $('#salesReceiptModal #billing-address').append('\n');
            }
            var address = '';
            address += customer.mail_add !== "" ? customer.mail_add : "";
            address += customer.city !== "" ? '\n' + customer.city : "";
            address += customer.state !== "" ? ', ' + customer.state : "";
            address += customer.zip_code !== "" ? ' ' + customer.zip_code : "";
            address += customer.country !== "" ? ' ' + customer.country : "";

            $('#salesReceiptModal #billing-address').append(address.trim());
            $('#salesReceiptModal #email').val(customer.email);
        });
    });

    $(document).on('change', '#refundReceiptModal #refund-from-account', function() {
        var rowEl = $(this).parent().parent().parent();
        var val = $(this).val();

        if (val !== '' && val !== null && val !== 'add-new') {
            $.get('/accounting/get-account-balance/' + val, function(res) {
                var result = JSON.parse(res);

                if(rowEl.find('#check-no').length > 0) {
                    rowEl.children('div.col-md-2:nth-child(3)').find('h4').html(result.balance);
                } else {
                    rowEl.append(`<div class="col-md-2"><div class="form-group"><label>Balance</label><h4>${result.balance}</h4></div></div>`);
                    rowEl.append(`<div class="col-md-2"><div class="form-group"><label for="check-no">Check no.</label><input type="text" class="form-control" name="check_no" id="check-no" value="To print" disabled><div class="form-check"><div class="checkbox checkbox-sec"><input type="checkbox" name="print_later" value="1" class="form-check-input" id="print-later" checked><label class="form-check-label" for="print-later">Print later</label></div></div></div></div>`);
                }
            });
        }
    });

    $(document).on('change', '#refundReceiptModal #print-later', function() {
        if($(this).prop('checked')) {
            $('#refundReceiptModal #check-no').prop('disabled', true);
            $('#refundReceiptModal #check-no').val('To print').trigger('change');
        } else {
            $('#refundReceiptModal #check-no').prop('disabled', false);
            $('#refundReceiptModal #check-no').val('').trigger('change');
        }
    });

    $(document).on('change', '#refundReceiptModal #customer', function() {
        $.get(`/accounting/get-customer-details/${$(this).val()}`, function(result) {
            var customer = JSON.parse(result);

            if (customer.business_name !== "" && customer.business_name !== null) {
                $('#refundReceiptModal #billing-address').append(customer.business_name);
                $('#refundReceiptModal #billing-address').append('\n');
            } else {
                var customerName = '';
                customerName += customer.first_name !== "" ? customer.first_name + " " : "";
                customerName += customer.middle_name !== "" ? customer.middle_name + " " : "";
                customerName += customer.last_name !== "" ? customer.last_name : "";
                $('#refundReceiptModal #billing-address').html(customerName.trim());
                $('#refundReceiptModal #billing-address').append('\n');
            }
            var address = '';
            address += customer.mail_add !== "" ? customer.mail_add : "";
            address += customer.city !== "" ? '\n' + customer.city : "";
            address += customer.state !== "" ? ', ' + customer.state : "";
            address += customer.zip_code !== "" ? ' ' + customer.zip_code : "";
            address += customer.country !== "" ? ' ' + customer.country : "";

            $('#refundReceiptModal #billing-address').append(address.trim());
            $('#refundReceiptModal #email').val(customer.email);
        });
    });
});

const convertToDecimal = (el) => {
    var val = parseFloat($(el).val()).toFixed(2).toString();
    var split = val.includes('.') ? val.split('.') : val;
    var string = "0.00";

    if (typeof split === "object") {
        if (split[0].length === 0) {
            split[0] = "0";
        }

        if (split[1].length === 1) {
            split[1] = split[1] + "0";
        }

        string = split[0] + '.' + split[1];
    } else {
        if (split !== "NaN") {
            string = split + '.00';
        }
    }

    $(el).val(string);
}

const payrollRowTotal = (el) => {
    convertToDecimal(el);
    var totalPay = 0.00;
    var rowIndex = $(el).parent().parent().index();
    var payRate = $(`div#payrollModal table#payroll-table tbody tr:nth-child(${rowIndex+1}) td:nth-child(2) p span.pay-rate`).html();
    var regPayHours = "0.00";
    var commission = "0.00";


    if (el.hasClass('employee-commission')) {
        commission = parseFloat(el.val());

        totalPay = parseFloat(commission).toFixed(2);
    } else {
        regPayHours = parseFloat(el.val()).toFixed(2);

        $(el).parent().parent().children('td:nth-child(7)').children().html(regPayHours);

        totalPay = parseFloat(parseFloat(regPayHours * parseFloat(payRate))).toFixed(2);
    }

    $(el).parent().parent().children('td:last-child()').children('p').children('span.total-pay').html(totalPay);
}

const payrollTotal = () => {
    var hours = 0.00;
    var totalPay = 0.00;
    var commission = 0.00;

    $('div#payrollModal table#payroll-table tbody tr').each(function() {
        var empTotalHours = $(this).find('input[name="reg_pay_hours[]"]').val();
        if (empTotalHours !== "" && empTotalHours !== undefined) {
            empTotalHours = parseFloat(empTotalHours);
        } else {
            empTotalHours = 0.00;
        }

        hours = parseFloat(parseFloat(hours) + empTotalHours).toFixed(2);

        var empCommission = $(this).children('td:nth-child(5)').children('input').val();
        if (empCommission !== "" && empCommission !== undefined) {
            empCommission = parseFloat(empCommission);
        } else {
            empCommission = 0.00;
        }

        commission = parseFloat(parseFloat(commission) + empCommission).toFixed(2);

        var empTotalPay = $(this).children('td:last-child()').children('p').children('span').html();

        if (empTotalPay !== "" && empTotalPay !== undefined) {
            empTotalPay = parseFloat(empTotalPay);
        } else {
            empTotalPay = 0.00;
        }

        totalPay = parseFloat(parseFloat(totalPay) + empTotalPay).toFixed(2);
    });

    $('div#payrollModal table#payroll-table tfoot tr td:nth-child(4)').html(hours);
    $('div#payrollModal table#payroll-table tfoot tr td:nth-child(7)').html(hours);

    $('table#payroll-table tfoot tr td:nth-child(5)').html(formatter.format(parseFloat(commission)));

    $('div#payrollModal h2.total-pay').html(formatter.format(parseFloat(totalPay)));
    $('table#payroll-table tfoot tr td:last-child() p').html(formatter.format(parseFloat(totalPay)));
}

const tableWeekDate = (el) => {
    var value = $(el).val();
    var split = value.split('-');
    var startDate = new Date(split[0]);
    var endDate = new Date(split[1]);

    for (var i = 3; startDate.getTime() <= endDate.getTime(); i++) {
        $(`#weeklyTimesheetModal table#timesheet-table thead th:nth-child(${i}) p:nth-child(2)`).html(startDate.getDate());
        startDate = new Date(startDate.getTime() + 86400000);
    }
}

const timeActivitySummary = (el) => {
    var date = $('div#singleTimeModal input#date').val();
    var time = $('div#singleTimeModal input#time').val();
    var billable = $('div#singleTimeModal input#billable').prop('checked');
    hourlyRate = formatter.format(parseFloat(hourlyRate));
    var taxable = $('div#singleTimeModal input#taxable').prop('checked');
    var timeSplit = time !== "" ? time.split(':') : "";
    var hour = 0;
    var minutes = 0;

    if ($('div#singleTimeModal input#startEndTime').prop('checked') === false && time !== "") {
        hour = parseInt(timeSplit[0]);
        minutes = parseInt(timeSplit[1]);
    } else if ($('div#singleTimeModal input#startEndTime').prop('checked') === true) {
        var startTime = $('div#singleTimeModal select#startTime').val();
        var endTime = $('div#singleTimeModal select#endTime').val();

        if (startTime !== "" && endTime !== "") {
            var start = new Date(date + " " + startTime).getTime();
            var end = new Date(date + " " + endTime).getTime();
            var duration = end - start;
            hour = Math.floor((duration / (1000 * 60 * 60)) % 24);
            minutes = Math.floor((duration / (1000 * 60)) % 60);

            hour = hour < 0 ? hour + 24 : hour;
            minutes = minutes < 0 ? minutes + 60 : minutes;

            if (timeSplit !== "") {
                hour = hour - parseInt(timeSplit[0]);
                minutes = minutes - parseInt(timeSplit[1]);

                if (minutes < 0) {
                    for (i = 1; minutes < 0; i++) {
                        minutes = minutes + 60;
                        hour = hour - 1;
                    }
                }
            }
        }
    }

    var totalHours = hour.length > 1 ? hour : '0'+hour;
    totalHours += ":";
    totalHours += minutes.length > 1 ? hour : '0'+minutes;

    if(totalHours !== "00:00" && Number.isInteger(hour) && Number.isInteger(minutes)) {
        var hourText = hour > 1 ? 'hours' : hour !== 0 ? 'hour' : '';
        var minuteText = minutes > 1 ? 'minutes' : minutes !== 0 ? 'minute' : '';
        var summary = hour > 0 ? hour : '';
        summary += ' ' + hourText + ' ';
        summary += minutes > 0 ? minutes : '';
        summary += ' ' + minuteText;

        if(billable) {
            if (hourlyRate !== undefined && hourlyRate !== '$0.00' && hourlyRate !== '$' && totalHours !== undefined) {
                summary += ' at '+formatter.format(parseFloat(hourlyRate))+' per hour ='

                var totalHrsSplit = totalHours.split(':');
                var rate = parseFloat(hourlyRate.replace('$', '').replaceAll(',', ''));

                var minutesDecimal = parseInt(totalHrsSplit[1]) / 60;
                totalHours = parseFloat(totalHrsSplit[0]) + minutesDecimal;

                var totalBill = totalHours * rate;
                totalBill = formatter.format(parseFloat(totalBill));
                summary += ' '+totalBill;
                summary += taxable ? ' plus tax' : '';
            }
        }

        if (summary.trim() !== "") {
            if ($('div#singleTimeModal div.modal-body div.row:nth-child(2) div.col-md-5 div#summary').length === 0) {
                $('div#singleTimeModal div.modal-body div.row:nth-child(2) div.col-md-5').append(`
                <div class="form-group" id="summary">
                    <label for="summary">Summary</label>
                    <p>${summary.trim()}</p>
                </div>`);
            } else {
                $('div#singleTimeModal div.modal-body div.row:nth-child(2) div.col-md-5 div#summary p').html(summary.trim());
            }
        }
    }
}

const computeTotalBill = () => {
    $('#weeklyTimesheetModal #timesheet-table tbody tr').each(function() {
        var rate = $(this).find('[name="hourly_rate[]"]').val();
        var totalHrs = $(this).find('.total-cell').find('p:nth-child(2)').html();

        if (rate !== undefined && rate !== '0.00' && totalHrs !== undefined && totalHrs !== '0:00') {
            var totalHrsSplit = totalHrs.split(':');
            rate = parseFloat(rate);

            var minutesDecimal = parseInt(totalHrsSplit[1]) / 60;
            totalHrs = parseFloat(totalHrsSplit[0]) + minutesDecimal;

            var totalBill = totalHrs * rate;
            if($(this).find('.weekly-billable').prop('checked')) {
                if ($(this).find('.total-cell').find('p').length < 4) {
                    $(this).find('.total-cell').find('p:nth-child(2)').removeClass('m-0');
                    $(this).find('.total-cell').append(`<p class="text-right m-0">Billable</p>`);
                    $(this).find('.total-cell').append(`<p class="text-right m-0">${formatter.format(parseFloat(totalBill))}</p>`);
                } else {
                    $(this).find('.total-cell').find('p:last-child()').html(`${formatter.format(parseFloat(totalBill))}`);
                }
            }
        }
    });
}

const computeTotalHours = () => {
    var input = "";
    var hour = 00;
    var minutes = 00;

    $('#weeklyTimesheetModal #timesheet-table tbody tr').each(function() {
        var rowHours = 00;
        var rowMins = 00;
        var rowFlag = false;

        $(this).find('input.day-input').each(function() {
            input = $(this).val().trim();
            if (input !== "") {
                rowFlag = true;
                var inputSplit = input.length !== 0 ? input.split(':') : "";
                hour = inputSplit !== "" ? parseInt(inputSplit[0]) : 00;
                minutes = inputSplit !== "" ? parseInt(inputSplit[1]) : 00;

                rowHours = rowHours + hour;
                rowMins = rowMins + minutes;
            }
        });

        if (rowFlag === true) {
            for (var i = 1; rowMins >= 60; i++) {
                rowHours = rowHours + 1;
                rowMins = rowMins - 60;
            }

            rowHours = rowHours.toString().length === 1 ? "0" + rowHours.toString() : rowHours.toString();
            rowMins = rowMins.toString().length === 1 ? "0" + rowMins.toString() : rowMins.toString();

            $(this).find('td.total-cell').html(`
            <p class="text-right m-0">Hrs</p>
            <p class="text-right m-0">${rowHours}:${rowMins}</p>
            `);
        } else {
            $(this).find('td.total-cell').html("");
        }
    });

    for (var index = 3; index <= 9; index++) {
        var colHours = 00;
        var colMins = 00;
        var colFlag = false;

        $(`#weeklyTimesheetModal table#timesheet-table tbody tr td:nth-child(${index})`).each(function() {
            input = $(this).children('input.day-input').val().trim();
            if (input !== "") {
                colFlag = true;
                var colInputSplit = input.length !== 0 ? input.split(':') : "";
                hour = colInputSplit !== "" ? parseInt(colInputSplit[0]) : 00;
                minutes = colInputSplit !== "" ? parseInt(colInputSplit[1]) : 00;

                colHours = colHours + hour;
                colMins = colMins + minutes;
            }
        });

        if (colFlag === true) {
            for (var i = 1; colMins >= 60; i++) {
                colHours = colHours + 1;
                colMins = colMins - 60;
            }

            colHours = colHours.toString().length === 1 ? "0" + colHours.toString() : colHours.toString();
            colMins = colMins.toString().length === 1 ? "0" + colMins.toString() : colMins.toString();

            $(`#weeklyTimesheetModal table#timesheet-table tfoot tr td:nth-child(${index})`).html(colHours + ":" + colMins);
        } else {
            $(`#weeklyTimesheetModal table#timesheet-table tfoot tr td:nth-child(${index})`).html("");
        }
    }

    var rowTotalHours = 00;
    var rowTotalMins = 00;
    var totalFlag = false;
    $('#weeklyTimesheetModal table#timesheet-table tbody tr .total-cell').each(function() {
        var rowTotal = $(this).find('p:nth-child(2)').html();
        if (rowTotal !== "" && rowTotal !== undefined) {
            rowTotal = rowTotal.trim();
            totalFlag = true;
            var totalSplit = rowTotal.length !== 0 ? rowTotal.split(':') : "";
            hour = totalSplit !== "" ? parseInt(totalSplit[0]) : 00;
            minutes = totalSplit !== "" ? parseInt(totalSplit[1]) : 00;

            rowTotalHours = rowTotalHours + hour;
            rowTotalMins = rowTotalMins + minutes;
        }
    });

    if (totalFlag === true) {
        for (var i = 1; rowTotalMins >= 60; i++) {
            rowTotalHours = rowTotalHours + 1;
            rowTotalMins = rowTotalMins - 60;
        }

        rowTotalHours = rowTotalHours.toString().length === 1 ? "0" + rowTotalHours.toString() : rowTotalHours.toString();
        rowTotalMins = rowTotalMins.toString().length === 1 ? "0" + rowTotalMins.toString() : rowTotalMins.toString();

        $('#weeklyTimesheetModal table#timesheet-table tfoot tr td:nth-child(10)').html(rowTotalHours + ":" + rowTotalMins);
        $('#weeklyTimesheetModal h2#totalHours').html(rowTotalHours + ":" + rowTotalMins);
    } else {
        $('#weeklyTimesheetModal table#timesheet-table tfoot tr td:nth-child(10)').html("");
        $('#weeklyTimesheetModal h2#totalHours').html("00:00");
    }
}

const loadTagsDataTable = () => {
    $('#tags-table').DataTable({
        autoWidth: false,
        searching: false,
        processing: true,
        serverSide: true,
        lengthChange: false,
        ordering: false,
        info: false,
        ajax: {
            url: '/accounting/load-job-tags/',
            dataType: 'json',
            contentType: 'application/json',
            type: 'POST',
            data: function(d) {
                d.columns[0].search.value = $('input#search-tag').val();
                return JSON.stringify(d);
            },
            pagingType: 'full_numbers',
        },
        columns: [
            {
                data: 'tag_name',
                name: 'tag_name',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(`<span>${rowData.tag_name} ${rowData.type === 'group' ? `(${rowData.tags.length})` : ''}</span><a href="#" class="float-right text-info edit" data-group-tag="${rowData.group_tag_id}" data-type="${rowData.type}" data-id="${rowData.id}" data-name="${rowData.tag_name}">Edit</a>`);

                    if(rowData.type === 'group') {
                        $(td).prepend(`<a class="mr-3 cursor-pointer" data-toggle="collapse" data-target="#child-${row}"><i class="fa fa-chevron-down"></i></a>`);
                    }
                }
            }
        ],
        fnCreatedRow: function(nRow, aData, iDataIndex) {
            if(aData['type'] === 'group-tag') {
                $(nRow).attr('id', `child-${aData['parentIndex']}`);
                $(nRow).addClass('collapse bg-light');
            }
        }
    });
}

const editGroupTagForm = (data) => {
    $.get('/accounting/edit-group-tag-form', function(res) {
        $('#tags-modal div.modal-dialog div#tags-list').remove();

        $('#tags-modal div.modal-dialog').append(`<form class="h-100" id="edit_group_tag"></form>`);
        $('#tags-modal div.modal-dialog form').append(res);

        $('#tags-modal div.modal-dialog form input').val(data.name);
        $('#tags-modal div.modal-dialog form input').parent().parent().prepend(`<input type="hidden" name="group_id" value="${data.id}">`);
    });
}

const getTagForm = (data = {}, method) => {
    $.get('/accounting/get-job-tag-form/', function(res) {
        if(method === 'update' && data.groupTag !== null && data.type === 'group-tag') {
            var groupTagName = $(`#tags-modal #tags-table tbody tr td a[data-id="${data.groupTag}"][data-type="group"]`).prev().html();

            groupTagName = groupTagName.slice(0, -4);
        }
        $('#tags-modal div.modal-dialog div#tags-list').remove();

        if(method === 'create') {
            $('#tags-modal div.modal-dialog').append(`<form class="h-100" id="create_tag_form" onsubmit="submitTagsForm(this, 'create', event)"></form>`);
        } else {
            $('#tags-modal div.modal-dialog').append(`<form class="h-100" id="update-tag-form" onsubmit="submitTagsForm(this, 'update', event)"></form>`);
        }

        $('#tags-modal div.modal-dialog form').append(res);

        if(method === 'update') {
            var id = data.id;
            var name = data.name;

            $('#tags-modal div.modal-dialog form h5').html('Edit tag');
            $('#tags-modal div.modal-dialog form input[name="tag_name"]').val(name);
            $('#tags-modal div.modal-dialog form').prepend(`<input type="hidden" name="id" value="${id}">`);

            if(data.groupTag !== null && data.type === 'group-tag') {
                $('#tags-modal div.modal-dialog form select#tagGroup').append(`<option value="${data.groupTag}" selected>${groupTagName}</option>`);
            }
        }

        $('#tags-modal #tagGroup').select2({
            dropdownParent: $('#tags-modal'),
            ajax: {
                url: '/accounting/tags/get-group-tags',
                dataType: 'json'
            }
        });
    });
}

const getGroupTagForm = () => {
    $.get('/accounting/get-group-tag-form/', function(res) {
        $('#tags-modal div.modal-dialog div#tags-list').remove();

        $('#tags-modal div.modal-dialog').append(`<div class="h-100"></div>`)
        $('#tags-modal div.modal-dialog div').append(res);
    });
}

const showTagsList = (el) => {
    $(el).parent().parent().parent().remove();

    $('#tags-modal div.modal-dialog').append('<div class="modal-content" id="tags-list"></div>');
    $('#tags-modal div.modal-dialog div#tags-list').append(tagsListModal);
    loadTagsDataTable();
}

const submitTagsForm = (el, method = "", e) => {
    e.preventDefault();
    
    var data = new FormData(document.getElementById($(el).attr('id')));
    data.append('method', method);

    $.ajax({
        url: '/accounting/addTags',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            var res = JSON.parse(result);

            toast(res.success, res.message);

            showTagsList($(el).children().children('.modal-header').children('a'));
        }
    });
}

const updateBankDepositTotal = (el) => {
    var val = parseFloat($(el).val()).toFixed(2).toString();
    var split = val.includes('.') ? val.split('.') : val;
    var string = "0.00";

    if(typeof split === "object") {
        if(split[0].length === 0) {
            split[0] = "0";
        }

        if(split[1].length === 1) {
            split[1] = split[1]+"0";
        }

        string = split[0]+'.'+split[1];
    } else {
        if(split !== "NaN") {
            string = split+'.00';
        }
    }

    $(el).val(string);

    computeBankDepositeTotal();
}

const computeBankDepositeTotal = () => {
    var otherFundsTotal = 0.00;

    $('div#depositModal input[name="amount[]"]').each(function() {
        if($(this).val() !== "") {
            var val = $(this).val();
            otherFundsTotal = (parseFloat(otherFundsTotal) + parseFloat(val)).toFixed(2);
        }
    });

    var cashBackAmount = 0;

    if($('div#depositModal input[name="cash_back_amount"]').val() !== "") {
        cashBackAmount = $('div#depositModal input[name="cash_back_amount"]').val();
    }

    var totalDepositAmount = (parseFloat(otherFundsTotal) - parseFloat(cashBackAmount)).toFixed(2);

    $('div#depositModal span.other-funds-total').html(formatter.format(parseFloat(otherFundsTotal)));
    $('div#depositModal h2.total-deposit-amount').html(formatter.format(parseFloat(totalDepositAmount)));
    $('div#depositModal span.total-cash-back').html(formatter.format(parseFloat(totalDepositAmount)));
}

const addTableLines = (e) => {
    e.preventDefault();
    var table = e.currentTarget.dataset.target;
    var lastRow = $(`table${table} tbody tr:last-child() td:nth-child(2)`)
    var lastRowCount = parseInt(lastRow.html());

    for(var i = 0; i < rowCount; i++) {
        lastRowCount++;
        if(table !== '#category-details-table' && table !== '#item-details-table') {
            $(`table${table} tbody`).append(`<tr>${blankRow}</tr>`);
        } else {
            $(`table${table} tbody`).append(`<tr>${catDetailsBlank}</tr>`);

            if($(`table${table} thead tr th`).length > $(`table${table} tbody tr:last-child td`).length) {
                $(`<td></td>`).insertBefore($(`table${table} tbody tr:last-child td:last-child`));
            }
        }
        $(`table${table} tbody tr:last-child() td:nth-child(2)`).html(lastRowCount);

        $(`table${table} tbody tr:last-child() td select`).select2();
    }
}

const clearTableLines = (e) => {
    e.preventDefault();
    var table = e.currentTarget.dataset.target;

    if($('#modal-container .modal a#linked-transaction').length > 0) {
        unlinkTransaction();
        $('#modal-container .modal #payee').trigger('change');
        $('#modal-container .modal #vendor').trigger('change');
    }

    if(table !== '#previous-adjustments-table') {
        $(`table${table} tbody tr`).each(function(index, value) {
            var count = $(this).find('td:nth-child(2)').html();
            if(index < rowCount) {
                if(table !== '#category-details-table' && table !== '#item-details-table') {
                    $(this).html(blankRow);
                } else {
                    if(table === '#category-details-table') {
                        $(this).html(catDetailsBlank);
                    } else {
                        $(this).html(itemDetailsBlank);
                    }
                }
                $(this).find('td:nth-child(2)').html(count);
            }
            if(index >= rowCount) {
                $(this).remove();
            }
        });
    } else {
        $(`${table} tbody`).html('');
    }
}

const showApplyButton = () => {
    $('div#statementModal div.modal-body button.apply-button').removeClass('hide');
    $('div#statementModal div.modal-body div.card-body div.row:last-child()').addClass('hide');
}

const submitModalForm = (event, el) => {
    event.preventDefault();

    var data = new FormData(document.getElementById($(el).attr('id')));
    data.set('save_method', submitType);
    var modalId = '#'+$(el).children().attr('id');

    switch(modalId) {
        case '#weeklyTimesheetModal' :
            $('#weeklyTimesheetModal #timesheet-table tbody tr').each(function() {
                var customer = $(this).find('select[name="customer[]"]').val();
                if(customer !== "" && customer !== null) {
                    var hours = {
                        'sunday' : $('#weeklyTimesheetModal #show_sunday').prop('checked') ? $(this).find('[name="sunday_hours[]"]').val() : null,
                        'monday' : $('#weeklyTimesheetModal #show_monday').prop('checked') ? $(this).find('[name="monday_hours[]"]').val() : null,
                        'tuesday' : $('#weeklyTimesheetModal #show_tuesday').prop('checked') ? $(this).find('[name="tuesday_hours[]"]').val() : null,
                        'wednesday' : $('#weeklyTimesheetModal #show_wednesday').prop('checked') ? $(this).find('[name="wednesday_hours[]"]').val() : null,
                        'thursday' : $('#weeklyTimesheetModal #show_thursday').prop('checked') ? $(this).find('[name="thursday_hours[]"]').val() : null,
                        'friday' : $('#weeklyTimesheetModal #show_friday').prop('checked') ? $(this).find('[name="friday_hours[]"]').val() : null,
                        'saturday' : $('#weeklyTimesheetModal #show_saturday').prop('checked') ? $(this).find('[name="saturday_hours[]"]').val() : null,
                    };
    
                    if(data.has('hours[]')) {
                        data.append('hours[]', JSON.stringify(hours));
                        data.append('billable[]', $(this).find('[name="billable[]"]').prop('checked') ? 1 : null);
                        data.append('hourly_rate[]', $(this).find('[name="billable[]"]').prop('checked') ? $(this).find('[name="hourly_rate[]"]').val() : null);
                        data.append('taxable[]', $(this).find('[name="billable[]"]').prop('checked') && $(this).find('[name="taxable[]"]').prop('checked') ? 1 : null);
                        data.append('description[]', $(this).find('[name="description[]"]').val());
                    } else {
                        data.set('hours[]', JSON.stringify(hours));
                        data.set('billable[]', $(this).find('[name="billable[]"]').prop('checked') ? 1 : null);
                        data.set('hourly_rate[]', $(this).find('[name="billable[]"]').prop('checked') ? $(this).find('[name="hourly_rate[]"]').val() : null);
                        data.set('taxable[]', $(this).find('[name="billable[]"]').prop('checked') && $(this).find('[name="taxable[]"]').prop('checked') ? 1 : null);
                        data.set('description[]', $(this).find('[name="description[]"]').val());
                    }
                }
            });
        break;
        case '#payBillsModal' :
            var totalAmount = $(`${modalId} span.transaction-total-amount`).html().replace('$', '');
            data.append('total', totalAmount);
    
            $(`${modalId} #bills-table tbody tr`).each(function() {
                var checkbox = $(this).find('td:first-child input');
                var payee = $(this).find('td:nth-child(2) input').val();
                var credit_applied =  $(this).find('input.credit-applied').length > 0 ? $(this).find('input.credit-applied').val() : 0.00;
                var payment_amount =  $(this).find('input.payment-amount').val();
                var total_amount = parseFloat(parseFloat(credit_applied) + parseFloat(payment_amount)).toFixed(2);
    
                if(checkbox.prop('checked')) {
                    if(data.has('bills[]') === false) {
                        data.set('bills[]', checkbox.val());
                        data.set('payee[]', payee);
                        data.set('credit_applied[]', credit_applied);
                        data.set('payment_amount[]', payment_amount);
                        data.set('total_amount[]', total_amount);
                    } else {
                        data.append('bills[]', checkbox.val());
                        data.append('payee[]', payee);
                        data.append('credit_applied[]', credit_applied);
                        data.append('payment_amount[]', payment_amount);
                        data.append('total_amount[]', total_amount);
                    }
                }
            });
        break;
        case '#billPaymentModal' :
            data.delete('bills[]');
            data.delete('credits[]');
    
            $(`${modalId} #bills-table tbody tr`).each(function() {
                if($(this).find('input[type="checkbox"]').prop('checked')) {
                    if(data.has('bills[]') === false) {
                        data.set('bills[]', $(this).find('input[type="checkbox"]').val());
                        data.set('bill_payment[]', $(this).find('input[name="bill_payment[]"]').val());
                    } else {
                        data.append('bills[]', $(this).find('input[type="checkbox"]').val());
                        data.append('bill_payment[]', $(this).find('input[name="bill_payment[]"]').val());
                    }
                }
            });
    
            $(`${modalId} #vendor-credits-table tbody tr`).each(function() {
                if($(this).find('input[type="checkbox"]').prop('checked')) {
                    if(data.has('credits[]') === false) {
                        data.set('credits[]', $(this).find('input[type="checkbox"]').val());
                        data.set('credit_payment[]', $(this).find('input[name="credit_payment[]"]').val());
                    } else {
                        data.append('credits[]', $(this).find('input[type="checkbox"]').val());
                        data.append('credit_payment[]', $(this).find('input[name="credit_payment[]"]').val());
                    }
                }
            });
        break;
        case '#journalEntryModal' :
            data.delete('names[]');

            $('#journalEntryModal #journal-table tbody tr select[name="names[]"]').each(function() {
                if(data.has('names[]') === false) {
                    data.set('names[]', $(this).val() === null ? '' : $(this).val());
                } else {
                    data.append('names[]', $(this).val() === null ? '' : $(this).val());
                }
            });
        break;
        case '#depositModal' :
            data.delete('received_from[]');
            data.delete('payment_method[]');
    
            $('#depositModal #bank-deposit-table tbody tr select[name="received_from[]"]').each(function() {
                if(data.has('received_from[]') === false) {
                    data.set('received_from[]', $(this).val() === null ? '' : $(this).val());
                } else {
                    data.append('received_from[]', $(this).val() === null ? '' : $(this).val());
                }
            });
    
            $('#depositModal #bank-deposit-table tbody tr select[name="payment_method[]"]').each(function() {
                if(data.has('payment_method[]') === false) {
                    data.set('payment_method[]', $(this).val() === null ? '' : $(this).val());
                } else {
                    data.append('payment_method[]', $(this).val() === null ? '' : $(this).val());
                }
            });
        break;
        case '#payrollModal' :
            data = payrollFormData;
        break;
        case '#commission-payroll-modal' :
            data = payrollFormData;
        break;
        case '#bonus-payroll-modal' :
            data = payrollFormData;
        break;
        case '#receivePaymentModal' :
            data.delete('payment[]');
            data.delete('credit_payment[]');

            data.set('amount_to_credit', $('#receivePaymentModal span.amount-to-credit').html().replace('$', ''));
            data.set('amount_to_apply', $('#receivePaymentModal span.amount-to-apply').html().replace('$', ''));

            $('#receivePaymentModal #invoices-table tbody tr input[type="checkbox"]:checked').each(function() {
                if(data.has('invoice[]') === false) {
                    data.set('invoice[]', $(this).val());
                    data.set('payment[]', $(this).parent().parent().parent().parent().find('input[name="payment[]"]').val());
                } else {
                    data.append('invoice[]', $(this).val());
                    data.append('payment[]', $(this).parent().parent().parent().parent().find('input[name="payment[]"]').val());
                }
            });

            $('#receivePaymentModal #credit-memo-table tbody tr input[type="checkbox"]:checked').each(function() {
                if(data.has('credits[]') === false) {
                    data.set('credits[]', $(this).val());
                    data.set('credit_payment[]', $(this).parent().parent().parent().parent().find('input[name="credit_payment[]"]').val());
                } else {
                    data.append('credits[]', $(this).val());
                    data.append('credit_payment[]', $(this).parent().parent().parent().parent().find('input[name="credit_payment[]"]').val());
                }
            });
        break;
        case '#invoiceModal' :
            data.set('invoice_no', $('#invoiceModal #invoice-no').val());
        break;
    }

    if(customerModals.includes(modalId)) {
        data.delete('item[]');
        data.delete('package[]');
        data.delete('location[]');
        data.delete('quantity[]');
        data.delete('item_amount[]');
        data.delete('discount[]');
        data.delete('item_tax[]');
        $(`${modalId} table#item-table tbody:not(#package-items-table) tr:not(.package-items, .package-item, .package-item-header)`).each(function() {
            if(data.has('item_total[]')) {
                if($(this).hasClass('package')) {
                    data.append('item[]', 'package-'+$(this).find('input[name="package[]"]').val());
                    data.append('location[]', null);
                    data.append('item_amount[]', $(this).find('span.item-amount').html());
                    data.append('discount[]', null);
                } else {
                    data.append('item[]', 'item-'+$(this).find('input[name="item[]"]').val());
                    data.append('location[]', $(this).find('select[name="location[]"]').val());
                    data.append('item_amount[]', $(this).find('input[name="item_amount[]"]').val());
                    data.append('discount[]', $(this).find('input[name="discount[]"]').val());
                }
                data.append('item_tax[]', $(this).find('input[name="item_tax[]"]').val());
                data.append('quantity[]', $(this).find('input[name="quantity[]"]').val());
                data.append('item_total[]', $(this).find('span.row-total').html().replace('$', ''));
            } else {
                if($(this).hasClass('package')) {
                    data.set('item[]', 'package-'+$(this).find('input[name="package[]"]').val());
                    data.set('location[]', null);
                    data.set('item_amount[]', $(this).find('span.item-amount').html());
                    data.set('discount[]', null);
                } else {
                    data.set('item[]', 'item-'+$(this).find('input[name="item[]"]').val());
                    data.set('location[]', $(this).find('select[name="location[]"]').val());
                    data.set('item_amount[]', $(this).find('input[name="item_amount[]"]').val());
                    data.set('discount[]', $(this).find('input[name="discount[]"]').val());
                }
                data.set('item_tax[]', $(this).find('input[name="item_tax[]"]').val());
                data.set('quantity[]', $(this).find('input[name="quantity[]"]').val());
                data.set('item_total[]', $(this).find('span.row-total').html().replace('$', ''));
            }
        });

        data.set('total_amount', $(`${modalId} .transaction-grand-total:first-child`).html().replace('$', '').trim());
        data.set('subtotal', $(`${modalId} .transaction-subtotal:first-child`).html().replace('$', '').trim());
        data.set('tax_total', $(`${modalId} .transaction-taxes:first-child`).html().replace('$', '').trim());
        data.set('discount_total', $(`${modalId} .transaction-discounts:first-child`).html().replace('$', '').trim());
    }

    if(vendorModals.includes(modalId)) {
        var count = 0;
        var totalAmount = $(`${modalId} span.transaction-total-amount`).html().replace('$', '');
        data.append('total_amount', totalAmount);

        $(`${modalId} table#category-details-table tbody tr`).each(function() {
            var billable = $(this).find('input[name="category_billable[]"]');
            var tax = $(this).find('input[name="category_tax[]"]');

            if(billable.length > 0 && tax.length > 0) {
                if(count === 0) {
                    data.set('category_billable[]', billable.prop('checked') ? "1" : "0");
                    data.set('category_tax[]', tax.prop('checked') ? "1" : "0");
                    data.set('category_linked[]', $(this).find('i.fa.fa-link').length > 0);
                } else {
                    data.append('category_billable[]', billable.prop('checked') ? "1" : "0");
                    data.append('category_tax[]', tax.prop('checked') ? "1" : "0");
                    data.append('category_linked[]', $(this).find('i.fa.fa-link').length > 0);
                }
            }

            count++;
        });

        count = 0;
        $(`${modalId} table#item-details-table tbody tr`).each(function() {
            if(count === 0) {
                data.set('item_total[]', $(this).find('td span.row-total').html().replace('$', ''));
                data.set('item_linked[]', $(this).find('i.fa.fa-link').length > 0);
            } else {
                data.append('item_total[]', $(this).find('td span.row-total').html().replace('$', ''));
                data.append('item_linked[]', $(this).find('i.fa.fa-link').length > 0);
            }

            count++;
        });
    }
    data.append('modal_name', $(el).children().attr('id'));

    $.ajax({
        url: '/accounting/submit-modal-form',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            var res = JSON.parse(result);

            toast(res.success, res.message);

            if(res.success === true) {
                if(submitType === 'save-and-close' || submitType === 'save-and-void') {
                    $(el).children().modal('hide');
                }

                if(submitType !== 'save-and-close' && submitType !== 'save-and-new' && modalId !== '#payBillsModal') {
                    switch($(el).children().attr('id')) {
                        case 'expenseModal' :
                            var type = 'expense';

                            $('#expenseModal .modal-footer div.row.w-100 div:nth-child(2)').removeClass('d-flex');
                            $('#expenseModal .modal-footer div.row.w-100 div:nth-child(2)').html(`
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <span><a href="#" class="text-white" onclick="makeRecurring('expense')">Make Recurring</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span>
                                        <div class="dropup">
                                            <a href="javascript:void(0);" class="text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#" id="copy-expense">Copy</a>
                                                <a class="dropdown-item" href="#" id="void-expense">Void</a>
                                                <a class="dropdown-item" href="#" id="delete-expense">Delete</a>
                                                <a class="dropdown-item" href="#">Transaction journal</a>
                                                <a class="dropdown-item" href="#">Audit history</a>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                            </div>`);
                        break;
                        case 'checkModal' :
                            var type = 'check';

                            $('#checkModal .modal-footer div.row.w-100 div:nth-child(2) div.row div.dropup div.dropdown-menu').html(`
                            <a class="dropdown-item" href="#" id="copy-check">Copy</a>
                            <a class="dropdown-item" href="#" id="void-check">Void</a>
                            <a class="dropdown-item" href="#" id="delete-check">Delete</a>
                            <a class="dropdown-item" href="#">Transaction journal</a>
                            <a class="dropdown-item" href="#">Audit history</a>`);
                        break;
                        case 'billModal' :
                            var type = 'bill';

                            $('#billModal .modal-footer div.row.w-100 div:nth-child(2)').removeClass('d-flex');
                            $('#billModal .modal-footer div.row.w-100 div:nth-child(2)').html(`
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <span><a href="#" class="text-white" onclick="makeRecurring('bill')">Make Recurring</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span>
                                        <div class="dropup">
                                            <a href="javascript:void(0);" class="text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#" id="copy-bill">Copy</a>
                                                <a class="dropdown-item" href="#" id="delete-bill">Delete</a>
                                                <a class="dropdown-item" href="#">Transaction journal</a>
                                                <a class="dropdown-item" href="#">Audit history</a>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                            </div>`);
                        break;
                        case 'purchaseOrderModal' :
                            var type = 'purchase-order';

                            $('#purchaseOrderModal .modal-footer div.row.w-100 div:nth-child(2) div.row div.dropup div.dropdown-menu').append(`
                            <span class="mx-3 divider"></span>
                            <span>
                                <div class="dropup">
                                    <a href="javascript:void(0);" class="text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" id="copy-purchase-order">Copy</a>
                                        <a class="dropdown-item" href="#" id="delete-purchase-order">Delete</a>
                                        <a class="dropdown-item" href="#">Audit history</a>
                                    </div>
                                </div>
                            </span>`);
                        break;
                        case 'vendorCreditModal' :
                            var type = 'vendor-credit';

                            $('#vendorCreditModal .modal-footer div.row.w-100 div:nth-child(2)').removeClass('d-flex');
                            $('#vendorCreditModal .modal-footer div.row.w-100 div:nth-child(2)').html(`
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <span><a href="#" class="text-white" onclick="makeRecurring('vendor_credit')">Make Recurring</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span>
                                        <div class="dropup">
                                            <a href="javascript:void(0);" class="text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#" id="copy-vendor-credit">Copy</a>
                                                <a class="dropdown-item" href="#" id="delete-vendor-credit">Delete</a>
                                                <a class="dropdown-item" href="#">Transaction journal</a>
                                                <a class="dropdown-item" href="#">Audit history</a>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                            </div>`);
                        break;
                        case 'creditCardCreditModal' :
                            var type = 'credit-card-credit';

                            $('#creditCardCreditModal .modal-footer div.row.w-100 div:nth-child(2)').removeClass('d-flex');
                            $('#creditCardCreditModal .modal-footer div.row.w-100 div:nth-child(2)').html(`
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <span><a href="#" class="text-white" onclick="makeRecurring('credit_card_credit')">Make Recurring</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span>
                                        <div class="dropup">
                                            <a href="javascript:void(0);" class="text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#" id="copy-cc-credit">Copy</a>
                                                <a class="dropdown-item" href="#" id="void-cc-credit">Void</a>
                                                <a class="dropdown-item" href="#" id="delete-cc-credit">Delete</a>
                                                <a class="dropdown-item" href="#">Transaction journal</a>
                                                <a class="dropdown-item" href="#">Audit history</a>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                            </div>`);
                        break;
                        case 'singleTimeModal' :
                            var type = 'time-activity';

                            $('#singleTimeModal .modal-footer div.row.w-100 div:nth-child(2)').html(`<a href="#" class="text-white m-auto" id="delete-time-activity">Delete</a>`);
                        break;
                        case 'journalEntryModal' :
                            var type = 'journal';

                            $('#journalEntryModal .modal-footer div.row.w-100 div:nth-child(2)').removeClass('d-flex');
                            $('#journalEntryModal .modal-footer div.row.w-100 div:nth-child(2)').html(`
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <span><a href="#" class="text-white">Reverse</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span><a href="#" class="text-white" onclick="makeRecurring('journal_entry')">Make Recurring</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span>
                                        <div class="dropup">
                                            <a href="javascript:void(0);" class="text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#" id="copy-journal-entry">Copy</a>
                                                <a class="dropdown-item" href="#" id="delete-journal-entry">Delete</a>
                                                <a class="dropdown-item" href="#">Transaction journal</a>
                                                <a class="dropdown-item" href="#">Audit history</a>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                            </div>`);
                        break;
                        case 'inventoryModal' :
                            var type = 'inventory-qty-adjust';
                        break;
                        case 'payDownCreditModal' :
                            var type = 'credit-card-payment';

                            $('#payDownCreditModal .modal-footer div.row.w-100 div:nth-child(2)').html(`
                            <div class="dropup m-auto">
                                <a href="javascript:void(0);" class="text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" id="void-credit-card-payment">Void</a>
                                    <a class="dropdown-item" href="#" id="delete-credit-card-payment">Delete</a>
                                    <a class="dropdown-item" href="#">Transaction journal</a>
                                    <a class="dropdown-item" href="#">Audit history</a>
                                </div>
                            </div>`);
                        break;
                        case 'receivePaymentModal' :
                            var type = 'receive-payment';

                            $('#receivePaymentModal .modal-footer div.row.w-100 div:nth-child(2)').removeClass('d-flex');
                            $('#receivePaymentModal .modal-footer div.row.w-100 div:nth-child(2)').html(`
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <span><a href="#" class="text-white" id="save-and-print">Print</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span>
                                        <div class="dropup">
                                            <a href="javascript:void(0);" class="text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#" id="void-payment">Void</a>
                                                <a class="dropdown-item" href="#" id="delete-payment">Delete</a>
                                                <a class="dropdown-item" href="#">Transaction journal</a>
                                                <a class="dropdown-item" href="#">Audit history</a>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                            </div>`);
                        break;
                        case 'invoiceModal' :
                            var type = 'invoice';

                            $('#invoiceModal .modal-footer div.row.w-100 div:nth-child(2) div.row div').append(`
                            <span class="mx-3 divider"></span>
                            <span>
                                <div class="dropup">
                                    <a href="javascript:void(0);" class="text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" id="copy-invoice">Copy</a>
                                        <a class="dropdown-item" href="#" id="void-invoice">Void</a>
                                        <a class="dropdown-item" href="#" id="delete-invoice">Delete</a>
                                        <a class="dropdown-item" href="#">Transaction journal</a>
                                        <a class="dropdown-item" href="#">Audit history</a>
                                    </div>
                                </div>
                            </span>`);
                        break;
                        case 'weeklyTimesheetModal' :
                            var type = 'weekly-timesheet';
                        break;
                        case 'creditMemoModal' :
                            var type = 'credit-memo';

                            $('#creditMemoModal .modal-footer div.row.w-100 div:nth-child(2) div.row div').append(`
                            <span class="mx-3 divider"></span>
                            <span>
                                <div class="dropup">
                                    <a href="javascript:void(0);" class="text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" id="copy-credit-memo">Copy</a>
                                        <a class="dropdown-item" href="#" id="void-credit-memo">Void</a>
                                        <a class="dropdown-item" href="#" id="delete-credit-memo">Delete</a>
                                        <a class="dropdown-item" href="#">Transaction journal</a>
                                        <a class="dropdown-item" href="#">Audit history</a>
                                    </div>
                                </div>
                            </span>`);
                        break;
                        case 'salesReceiptModal' :
                            var type = 'sales-receipt';

                            $('#salesReceiptModal .modal-footer div.row.w-100 div:nth-child(2) div.row div').append(`
                            <span class="mx-3 divider"></span>
                            <span>
                                <div class="dropup">
                                    <a href="javascript:void(0);" class="text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" id="copy-sales-receipt">Copy</a>
                                        <a class="dropdown-item" href="#" id="void-sales-receipt">Void</a>
                                        <a class="dropdown-item" href="#" id="delete-sales-receipt">Delete</a>
                                        <a class="dropdown-item" href="#">Transaction journal</a>
                                        <a class="dropdown-item" href="#">Audit history</a>
                                    </div>
                                </div>
                            </span>`);
                        break;
                        case 'refundReceiptModal' :
                            var type = 'refund-receipt';

                            $('#refundReceiptModal .modal-footer div.row.w-100 div:nth-child(2) div.row div').prepend(`
                            <span><a href="#" class="text-white">Order checks</a></span>
                            <span class="mx-3 divider"></span>`);
                            $('#refundReceiptModal .modal-footer div.row.w-100 div:nth-child(2) div.row div').append(`
                            <span class="mx-3 divider"></span>
                            <span>
                                <div class="dropup">
                                    <a href="javascript:void(0);" class="text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" id="copy-refund-receipt">Copy</a>
                                        <?php if($receipt->status !== "4") : ?>
                                        <a class="dropdown-item" href="#" id="void-refund-receipt">Void</a>
                                        <?php endif; ?>
                                        <a class="dropdown-item" href="#" id="delete-refund-receipt">Delete</a>
                                        <a class="dropdown-item" href="#">Transaction journal</a>
                                        <a class="dropdown-item" href="#">Audit history</a>
                                    </div>
                                </div>
                            </span>`);
                        break;
                    }

                    $('#modal-container #modal-form').attr('data-href', `/accounting/update-transaction/${type}/${res.data}`);
                    $('#modal-container #modal-form').attr('onsubmit', 'updateTransaction(event, this)');
                }

                if(submitType === 'save-and-send' && modalId === '#purchaseOrderModal') {
                    sendPurchaseOrder(res.data);
                }

                if(submitType === 'save-and-print') {
                    switch(type) {
                        case 'purchase-order' :
                            printPurchaseOrder();
                        break;
                        case 'weekly-timesheet' :
                            printTimesheet(res.data);
                        break;
                        case 'receive-payment' :

                        break;
                        case 'invoice' :
                            printPreviewInvoice();
                        break;
                        case 'credit-memo' :
                            printPreviewCreditMemo();
                        break;
                        case 'sales-receipt' :
                            printPreviewSalesReceipt();
                        break;
                        case 'refund-receipt' :
                            printPreviewRefundReceipt();
                        break;
                    }
                }

                if(submitType === 'save-and-new') {
                    clearForm();
                }
            }

            submitType = '';
        }
    });
}

const printTimesheet = (timesheetId) => {
    $.get(`/accounting/get-timesheet/${timesheetId}`, function(result) {
        var res = JSON.parse(result);
        var timesheet = res.timesheet;
        var time_activities = timesheet.time_activities;

        var table = '<table style="width: 100%; font-family: Open Sans, sans-serif">';
        table += `<thead style="font-weight: 700;">
            <tr>
                <th>#</th>
                <th width="30%">Details</th>
                <th>Sun</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>`;

        var totalTimes = [];
        totalTimes['sunday'] = '00:00';
        totalTimes['monday'] = '00:00';
        totalTimes['tuesday'] = '00:00';
        totalTimes['wednesday'] = '00:00';
        totalTimes['thursday'] = '00:00';
        totalTimes['friday'] = '00:00';
        totalTimes['saturday'] = '00:00';
        totalTimes['total'] = '00:00';

        for(var row in time_activities) {
            var activities = time_activities[row].time_activities;
            var customer = time_activities[row].customer;
            var service = time_activities[row].service;
            var billable = time_activities[row].billable;
            var rate = time_activities[row].rate;
            var taxable = time_activities[row].taxable;

            var customerName = customer['first_name'] + ' ' + customer['last_name'];
            var serviceName = service.title;

            var timesheetRow = `
            <tr>
                <td>${row}</td>
                <td>
                    <p style="margin: 0">Name: ${customerName}</p>
                    <p style="margin: 0">Service: ${serviceName}</p>
                    ${billable === '1' ? `<p style="margin: 0">Bill at $${parseFloat(rate).toFixed(2)}/hr</p>` : ''}
                    <p style="margin: 0">${taxable === '1' ? 'Taxable ' : ''}Cost at 0.00/hr</p>
                </td>`;

            var rowHours = 00;
            var rowMins = 00;

            var cols = [];
            cols['sunday'] = '<td class="sunday"></td>';
            cols['monday'] = '<td class="monday"></td>';
            cols['tuesday'] = '<td class="tuesday"></td>';
            cols['wednesday'] = '<td class="wednesday"></td>';
            cols['thursday'] = '<td class="thursday"></td>';
            cols['friday'] = '<td class="friday"></td>';
            cols['saturday'] = '<td class="saturday"></td>';
            for(var activity in activities) {
                var date = new Date(activities[activity].date);
                var time = activities[activity].time.slice(0, -3);

                cols[days[date.getDay()]] = `<td class="${days[date.getDay()]}" style="text-align:center">${time}</td>`;

                var timeSplit = time.split(':');
                hour = parseInt(timeSplit[0]);
                minutes = parseInt(timeSplit[1]);

                rowHours = rowHours + hour;
                rowMins = rowMins + minutes;

                var dayTotalSplit = totalTimes[days[date.getDay()]].split(':');
                var totalSplit = totalTimes['total'].split(':');
                var totalHours = parseInt(totalSplit[0]);
                var totalMins = parseInt(totalSplit[1]);
                var dayTotalHour = parseInt(dayTotalSplit[0]);
                var dayTotalMins = parseInt(dayTotalSplit[1]);

                dayTotalHour = dayTotalHour + hour;
                dayTotalMins = dayTotalMins + minutes;
                totalHours = totalHours + hour;
                totalMins = totalMins + minutes;

                for(var o = 1; dayTotalMins >= 60; o++) {
                    dayTotalHour += 1;
                    dayTotalMins -= 60;
                    totalHours += 1;
                    totalMins -= 60;
                }

                dayTotalHour = dayTotalHour.toString().length === 1 ? "0"+dayTotalHour.toString() : dayTotalHour.toString();
                dayTotalMins = dayTotalMins.toString().length === 1 ? "0"+dayTotalMins.toString() : dayTotalMins.toString();
                totalHours = totalHours.toString().length === 1 ? "0"+totalHours.toString() : totalHours.toString();
                totalMins = totalMins.toString().length === 1 ? "0"+totalMins.toString() : totalMins.toString();
                totalTimes[days[date.getDay()]] = `${dayTotalHour}:${dayTotalMins}`;
                totalTimes['total'] = `${totalHours}:${totalMins}`;
            }

            for(var day in cols) {
                timesheetRow += cols[day];
            }

            for(var i = 1; rowMins >= 60; i++) {
                rowHours = rowHours + 1;
                rowMins = rowMins - 60;
            }

            rowHours = rowHours.toString().length === 1 ? "0"+rowHours.toString() : rowHours.toString();
            rowMins = rowMins.toString().length === 1 ? "0"+rowMins.toString() : rowMins.toString();

            var minsDecimal = parseFloat(rowMins) / 60;
            var rowHoursDec = parseFloat(rowHours) + minsDecimal;
            var rowBills = rowHoursDec * parseFloat(rate).toFixed(2);

            timesheetRow += `
            <td class="total">
                <p style="margin:0; text-align: center;">Hrs</p>
                <p style="${billable === "0" ? 'margin:0;' : 'margin-top:0;'} text-align: center;">${rowHours}:${rowMins}</p>
                ${billable === "1" ? '<p style="margin:0; text-align: center">Billable</p>' : ''}
                ${billable === "1" ? `<p style="margin:0; text-align: center">$${parseFloat(rowBills).toFixed(2)}</p>` : ''}
            </td>`;
            timesheetRow += `</tr>`;

            table += timesheetRow;
        }

        table += `</tbody>
            <tfoot>
                <tr">
                    <th></th>
                    <th>TOTAL</th>
                    <th>${totalTimes['sunday']}</th>
                    <th>${totalTimes['monday']}</th>
                    <th>${totalTimes['tuesday']}</th>
                    <th>${totalTimes['wednesday']}</th>
                    <th>${totalTimes['thursday']}</th>
                    <th>${totalTimes['friday']}</th>
                    <th>${totalTimes['saturday']}</th>
                    <th>${totalTimes['total']}</th>
                </tr>
            </tfoot>
        </table>`;

        let tab = window.open("");
        tab.document.write('<title>Print</title>');
        tab.document.write(table);
        $(tab.document).find('body').css('padding', '0');
        $(tab.document).find('body').css('margin', '0');
        $(tab.document).focus();
        tab.print();
    });
}

const toast = (status = true, text = "Success", position = "top-right") => {
    var icon = status ? "success" : "error";
    var heading = status ? "Success" : "Error";

    $.toast({
        icon: icon,
        heading: heading,
        text: text,
        showHideTransition: 'fade',
        hideAfter: 3000,
        allowToastClose: true,
        position: position,
        stack: false,
        loader: false,
    });
}

const showHiddenFields = (el) => {
    if($(el).attr('id') === 'billable') {
        if($(el).prop('checked') === true) {
            $(el).parent().next().removeClass('hide');
            $(el).parent().next().attr('required', 'required');
            $(el).parent().parent().next().removeClass('hide');
        } else {
            $(el).parent().next().addClass('hide');
            $(el).parent().next().removeAttr('required', 'required');
            $(el).parent().parent().next().addClass('hide');
        }
    }

    if($(el).attr('id') === 'startEndTime') {
        if($(el).prop('checked') === true) {
            $('div#singleTimeModal select#startTime, select#endTime').parent().removeClass('hide');
            $('div#singleTimeModal select#startTime, select#endTime').prop('required', true);
            $('div#singleTimeModal label[for="time"]').html('Break');
            $('div#singleTimeModal input#time').removeAttr('required');
            $('div#singleTimeModal input#time').val('');
            $('div#singleTimeModal div#summary').remove();
        } else {
            $('select#startTime, select#endTime').parent().addClass('hide')
            $('select#startTime, select#endTime').removeAttr('required', 'required');
            $('label[for="time"]').html('Time');
            $('input#time').prop('required', true);
        }
    }

    if($(el).hasClass('weekly-billable')) {
        if($(el).prop('checked') === true) {
            var id = $(el).attr('id');
            var number = id.replace('billable_', '');
            var serviceId = $(el).parent().parent().parent().prev().find('[name="service[]"]').val();

            $.get(`/accounting/get-item-details/${serviceId}`, function(res) {
                var result = JSON.parse(res);
                var rate = result.item !== null ? result.item.price : '';
                $(el).parent().parent().append(`<input type="number" name="hourly_rate[]" step=".01" value="${rate}" onchange="convertToDecimal(this)" class="ml-2 w-25 form-control">
                <div class="checkbox checkbox-sec">
                    <input type="checkbox" name="taxable[]" id="taxable_${number}" class="ml-2 form-check-input" value="1">
                    <label class="form-check-label" for="taxable_${number}">Taxable</label>
                </div>`);

                $(el).parent().parent().find('[name="hourly_rate[]"]').trigger('change');
            });
        } else {
            $(el).parent().parent().find('input[name="hourly_rate[]"]').remove();
            $(el).parent().parent().find('input[name="taxable[]"]').parent().remove();
            $(el).parent().parent().parent().parent().parent().parent().find('td.total-cell').find('p:nth-child(3), p:nth-child(4)').remove();
        }
    }
}

const makeRecurring = (modalName) => {
    var modalId = '';

    var templateFields = `<div class="row recurring-details">
        <div class="col-md-12">
            <h3>Recurring Bank Deposit</h3>
            <div class="form-row">
                <div class="col-md-3 form-group">
                    <label for="templateName">Template name</label>
                    <input type="text" class="form-control" id="templateName" name="template_name">
                </div>
                <div class="col-md-2 form-group">
                    <label for="recurringType">Type</label>
                    <select class="form-control" id="recurringType" name="recurring_type">
                        <option value="scheduled">Scheduled</option>
                        <option value="reminder">Reminder</option>
                        <option value="unscheduled">Unscheduled</option>
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <div class="row m-0 h-100 d-flex">
                        <div class="align-self-end d-flex align-items-center">
                            <span>Create &nbsp;</span>
                            <input type="number" name="days_in_advance" id="dayInAdvance" class="form-control" style="width: 20%">
                            <span>&nbsp; days in advance</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>`;

    var date = new Date();
    var month = date.getMonth();
    var year = date.getFullYear();
    var totalDays = new Date(year, month+1, 0).getDate();
    var ends = ['th','st','nd','rd','th','th','th','th','th','th'];
    var options = "";
    for(i = 1; i <= totalDays; i++) {
        if ((i %100) >= 11 && (i%100) <= 13) {
            var abbreviation = i+'th';
        } else {
            var abbreviation = i+ends[i % 10];
        }

        options += `<option value="${i}">${abbreviation}</>`;
    }
    options += '<option value="last">Last</option>';

    var intervalFields = `<div class="row recurring-interval-container">
        <div class="col-md-12">
            <div class="form-row">
                <div class="col-md-2 form-group">
                    <label>Interval</label>
                    <select class="form-control" name="recurring_interval" id="recurringInterval">
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly" selected="">Monthly</option>
                        <option value="yearly">Yearly</option>
                    </select>
                </div>
                <div class="col-md-4 form-group d-flex align-items-end">
                    <div class="form-row w-100">
                        <div class="align-items-center col-md-1 d-flex" style="max-width: 4%">on</div>
                        <div class="col">
                            <select name="recurring_week" class="form-control">
                                <option value="day">day</option>
                                <option value="first">first</option>
                                <option value="second">second</option>
                                <option value="third">third</option>
                                <option value="fourth">fourth</option>
                                <option value="last">last</option>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control" name="recurring_day">
                            ${options}
                            </select>
                        </div>
                        <div class="align-items-center col-md-1 d-flex">of every</div>
                        <div class="col">
                            <input type="number" value="1" class="form-control" name="recurr_every">
                        </div>
                        <div class="align-items-center col d-flex">month(s)</div>
                    </div>
                </div>
                <div class="col-md-2 form-group">
                    <label for="startDate">Start date</label>
                    <input type="text" class="form-control date" name="start_date" id="startDate"/>
                </div>
                <div class="col-md-1 form-group">
                    <label for="endType">End</label>
                    <select name="end_type" class="form-control" id="endType">
                        <option value="none">None</option>
                        <option value="by">By</option>
                        <option value="after">After</option>
                    </select>
                </div>
            </div>
        </div>
    </div>`;
    switch(modalName) {
        case 'bank_deposit' :
            modalId = 'depositModal';
            $(templateFields).insertBefore($(`#${modalId} div.modal-body div.row.bank-account-details`));
            $(intervalFields).insertAfter($(`#${modalId} div.modal-body div.row.bank-account-details`));
            $(`#${modalId} .bank-account-details #date`).parent().parent().parent().remove();
        break;
        case 'transfer' :
            modalId = 'transferModal';
            $(`div#${modalId} div.modal-body .card-body`).prepend(intervalFields);
            $(`div#${modalId} div.modal-body .card-body`).prepend(templateFields);
            $(`#${modalId} div.modal-body div.recurring-details h3`).html('Recurring Transfer');
            $(`div#${modalId} div.modal-body #date`).parent().parent().remove();
        break;
        case 'journal_entry' :
            modalId = 'journalEntryModal';
            $(`div#${modalId} div.modal-body div.row.journal-entry-details`).remove();
            $(`div#${modalId} div.modal-body .card-body`).prepend(intervalFields);
            $(`div#${modalId} div.modal-body .card-body`).prepend(templateFields);
            $(`#${modalId} div.modal-body div.recurring-details h3`).html('Recurring Journal Entry');
            $(`#${modalId} div.modal-header .modal-title span`).html('');
        break;
        case 'expense' :
            modalId = 'expenseModal';
            $(templateFields).insertBefore($(`#${modalId} div.modal-body div.row.payee-details`));
            $(intervalFields).insertAfter($(`#${modalId} div.modal-body div.row.payee-details`));
            $(`div#${modalId} div.modal-body div.row.payee-details`).children('.col-md-4').remove();
            $(`div#${modalId} div.modal-body #payment_date`).parent().parent().parent().remove();
            $(`div#${modalId} div.modal-body #ref_no`).parent().remove();
            $(`#${modalId} div.modal-body div.recurring-details h3`).html('Recurring Expense');
        break;
        case 'check' :
            modalId = 'checkModal';
            $(templateFields).insertBefore($(`#${modalId} div.modal-body div.row.payee-details`));
            $(intervalFields).insertAfter($(`#${modalId} div.modal-body div.row.payee-details`));
            $(`div#${modalId} div.modal-body div.row.payee-details`).children('.col-md-4').remove();
            $(`div#${modalId} div.modal-body #payment_date`).parent().parent().remove();
            $(`#${modalId} div.modal-body div.recurring-details h3`).html('Recurring Check');
        break;
        case 'bill' :
            modalId = 'billModal';
            $(templateFields).insertBefore($(`#${modalId} div.modal-body div.row.payee-details`));
            $(intervalFields).insertAfter($(`#${modalId} div.modal-body div.row.payee-details`));
            $(`div#${modalId} div.modal-body div.row.payee-details`).children('.col-md-4').remove();
            $(`div#${modalId} div.modal-body #bill_date`).parent().parent().remove();
            $(`div#${modalId} div.modal-body #due_date`).parent().parent().remove();
            $(`div#${modalId} div.modal-body #bill_no`).parent().remove();
            $(`#${modalId} div.modal-body div.recurring-details h3`).html('Recurring Bill');
        break;
        case 'purchase_order' :
            modalId = 'purchaseOrderModal';
            $(templateFields).insertBefore($(`#${modalId} div.modal-body div.row.payee-details`));
            $(intervalFields).insertAfter($(`#${modalId} div.modal-body div.row.payee-details`));
            $(`div#${modalId} div.modal-body div.row.payee-details`).children('.col-md-4').remove();
            $(`div#${modalId} div.modal-body #purchase_order_date`).parent().parent().remove();
            $(`#${modalId} div.modal-body div.recurring-details h3`).html('Recurring Purchase Order');
        break;
        case 'vendor_credit' :
            modalId = 'vendorCreditModal';
            $(templateFields).insertBefore($(`#${modalId} div.modal-body div.row.payee-details`));
            $(intervalFields).insertAfter($(`#${modalId} div.modal-body div.row.payee-details`));
            $(`div#${modalId} div.modal-body div.row.payee-details`).children('.col-md-4').remove();
            $(`div#${modalId} div.modal-body #payment_date`).parent().parent().remove();
            $(`div#${modalId} div.modal-body #ref_no`).parent().remove();
            $(`#${modalId} div.modal-body div.recurring-details h3`).html('Recurring Vendor Credit');
        break;
        case 'credit_card_credit' :
            modalId = 'creditCardCreditModal';
            $(templateFields).insertBefore($(`#${modalId} div.modal-body div.row.payee-details`));
            $(intervalFields).insertAfter($(`#${modalId} div.modal-body div.row.payee-details`));
            $(`div#${modalId} div.modal-body div.row.payee-details`).children('.col-md-4').remove();
            $(`div#${modalId} div.modal-body #payment_date`).parent().parent().remove();
            $(`div#${modalId} div.modal-body #ref_no`).parent().remove();
            $(`#${modalId} div.modal-body div.recurring-details h3`).html('Recurring Credit Card Credit');
        break;
        case 'credit_memo' :
            modalId = 'creditMemoModal';
            $(templateFields).insertBefore($(`#${modalId} div.modal-body div.row.customer-details`));
            $(intervalFields).insertAfter($(`#${modalId} div.modal-body div.row.customer-details`));
            $(`div#${modalId} div.modal-body div.row.customer-details`).children('.col-md-4').remove();
            $(`div#${modalId} div.modal-body #credit_memo_date`).parent().parent().remove();
            $(`#${modalId} div.modal-body div.recurring-details h3`).html('Recurring Credit Memo');
            $(`#${modalId} div.modal-body #sales-rep`).parent().removeClass('w-100').parent().removeClass('d-flex').removeClass('align-items-end');
            $(`#${modalId} div.modal-body #send-later`).parent().parent().remove();
        break;
        case 'sales_receipt' :
            modalId = 'salesReceiptModal';
            $(templateFields).insertBefore($(`#${modalId} div.modal-body div.row.customer-details`));
            $(intervalFields).insertAfter($(`#${modalId} div.modal-body div.row.customer-details`));
            $(`#${modalId} div.modal-body div.recurring-details h3`).html('Recurring Sales Receipt');
            $(`div#${modalId} div.modal-body div.row.customer-details`).children('.col-md-4').remove();
            $(`div#${modalId} div.modal-body #sales-receipt-date`).parent().parent().remove();
            $(`#${modalId} div.modal-body #sales-rep`).parent().removeClass('w-100').parent().removeClass('d-flex').removeClass('align-items-end');
            $(`#${modalId} div.modal-body #send-later`).parent().parent().remove();
            
            var addedFields = `<div class="col-md-3">`;
            addedFields += `<div class="form-group">`;
            addedFields += `<label>Options</label>`;
            addedFields += `<div class="form-check">`;
            addedFields += `<div class="checkbox checkbox-sec mr-3">`;
            addedFields += `<input type="checkbox" name="auto_send_emails" value="1" class="form-check-input" id="auto-send-emails">`;
            addedFields += `<label class="form-check-label" for="auto-send-emails">Automatically send emails</label>`;
            addedFields += `</div>`;
            addedFields += `<div class="checkbox checkbox-sec">`;
            addedFields += `<input type="checkbox" name="print_later" value="1" class="form-check-input" id="print-later">`;
            addedFields += `<label class="form-check-label" for="print-later">Print later</label>`;
            addedFields += `</div>`;
            addedFields += `</div>`;
            addedFields += `</div>`;
            addedFields += `</div>`;
            $(addedFields).insertAfter($(`#${modalId} #email`).parent().parent());
        break;
        case 'refund_receipt' :
            modalId = 'refundReceiptModal';
            $(templateFields).insertBefore($(`#${modalId} div.modal-body div.row.customer-details`));
            $(intervalFields).insertAfter($(`#${modalId} div.modal-body div.row.customer-details`));
            $(`div#${modalId} div.modal-body div.row.customer-details`).children('.col-md-4').remove();
            $(`div#${modalId} div.modal-body #refund-receipt-date`).parent().parent().remove();
            $(`#${modalId} div.modal-body div.recurring-details h3`).html('Recurring Refund Receipt');
            $(`#${modalId} div.modal-body #sales-rep`).parent().removeClass('w-100').parent().removeClass('d-flex').removeClass('align-items-end');
        break;
        case 'delayed_credit' :
            modalId = 'delayedCreditModal';
            $(templateFields).insertBefore($(`#${modalId} div.modal-body div.row.customer-details`));
            $(intervalFields).insertAfter($(`#${modalId} div.modal-body div.row.customer-details`));
            $(`div#${modalId} div.modal-body div.row.customer-details`).children('.col-md-4').remove();
            $(`div#${modalId} div.modal-body #delayed-credit-date`).parent().parent().remove();
            $(`#${modalId} div.modal-body div.recurring-details h3`).html('Recurring Delayed Credit');
        break;
        case 'delayed_charge' :
            modalId = 'delayedChargeModal';
            $(templateFields).insertBefore($(`#${modalId} div.modal-body div.row.customer-details`));
            $(intervalFields).insertAfter($(`#${modalId} div.modal-body div.row.customer-details`));
            $(`div#${modalId} div.modal-body div.row.customer-details`).children('.col-md-4').remove();
            $(`div#${modalId} div.modal-body #delayed-charge-date`).parent().parent().remove();
            $(`#${modalId} div.modal-body div.recurring-details h3`).html('Recurring Delayed Charge');
        break;
        case 'invoice' :
            modalId = 'invoiceModal';
            $(templateFields).insertBefore($(`#${modalId} div.modal-body div.row.customer-details`));
            $(intervalFields).insertAfter($(`#${modalId} div.modal-body div.row.customer-details`));
            $(`div#${modalId} div.modal-body div.row.customer-details`).children('.col-md-4').remove();
            $(`div#${modalId} div.modal-body div.row.date-row`).remove();
            $(`#${modalId} div.modal-body div.recurring-details h3`).html('Recurring Invoice');
            $(`div#${modalId} div.modal-body #shipping-date`).parent().parent().remove();
            $(`div#${modalId} div.modal-body #invoice-no`).parent().parent().remove();
        break;
    }

    $(`#${modalId}`).parent().attr('onsubmit', 'submitModalForm(event, this)').removeAttr('data-href');
    $(`#${modalId} .transactions-container`).parent().remove();
    $(`#${modalId} .close-transactions-container`).parent().remove();

    $(`div#${modalId} div.modal-footer div.row.w-100 div:nth-child(2)`).html('');
    $(`div#${modalId} div.modal-footer div.row.w-100 div:last-child()`).html('<button class="btn btn-success float-right" id="save-template">Save template</button>');

    recurrInterval = $(`div#${modalId} div.modal-body div.recurring-interval-container`).html();
    recurringDays = $(`div#${modalId} div.modal-body select[name="recurring_day"]`).html();
    monthlyRecurrFields = $(`div#${modalId} div.modal-body div.recurring-interval-container div div.form-row div.form-group:nth-child(2) div.form-row`).html();

    $(`div#${modalId} input.date`).datepicker({
        uiLibrary: 'bootstrap'
    });

    $(`div#${modalId} select:not(.select2-hidden-accessible)`).each(function() {
        var type = $(this).attr('id');
        if (type === undefined) {
            type = $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-');
        } else {
            type = type.replaceAll('_', '-');

            if (type.includes('transfer')) {
                type = 'transfer-account';
            }
        }

        if (dropdownFields.includes(type)) {
            $(this).select2({
                ajax: {
                    url: '/accounting/get-dropdown-choices',
                    dataType: 'json',
                    data: function(params) {
                        var query = {
                            search: params.term,
                            type: 'public',
                            field: type,
                            modal: modalId
                        }

                        // Query parameters will be ?search=[term]&type=public&field=[type]
                        return query;
                    }
                },
                templateResult: formatResult,
                templateSelection: optionSelect
            });
        } else {
            $(this).select2({
                minimumResultsForSearch: -1
            });
        }
    });
}

const viewPrint = (id, title = "") => {
    var data = {};
    var flag = false;
    if(title === 'deposit-summary') {
        data.received_from = [];
        data.accounts = [];
        data.description = [];
        data.payment_method = [];
        data.reference_no = [];
        data.amount = [];
        data.cash_back_amount = $('#depositModal input#cashBackAmount').val();
        data.deposit_date = $('#depositModal input#date').val();
        data.title = title;
        data.id = id;

        var received_from = $('#bank-deposit-table [name="received_from[]"] option:selected');
        var accounts = $('#bank-deposit-table [name="account[]"] option:selected');
        var description = $('#bank-deposit-table [name="description[]"]');
        var payment_method = $('#bank-deposit-table [name="payment_method[]"] option:selected');
        var reference_no = $('#bank-deposit-table [name="reference_no[]"]');
        var amount = $('#bank-deposit-table [name="amount[]"]');

        for (var i in received_from) {

            var rec_from_val = received_from[i].outerText;
            if (rec_from_val !== undefined && rec_from_val !== "") data.received_from[i] = rec_from_val;
    
            var accounts_val = accounts[i].outerText;
            if (accounts_val !== undefined && accounts_val !== "") data.accounts[i] = accounts_val;
    
            var description_val = description[i].value;
            if (description_val !== undefined && description_val !== "") data.description[i] = description_val;
    
            var payment_method_val = payment_method[i].outerText;
            if (payment_method_val !== undefined && payment_method_val !== "") data.payment_method[i] = payment_method_val;
    
            var reference_no_val = reference_no[i].value;
            if (reference_no_val !== undefined && reference_no_val !== "") data.reference_no[i] = reference_no_val;
    
            var amount_val = amount[i].value;
            if (amount_val !== undefined && amount_val !== "") {
                data.amount[i] = amount_val;
            }
        }

        if (data.received_from.length > 0 &&
            data.accounts.length > 0 &&
            data.description.length > 0 &&
            data.payment_method.length > 0 &&
            data.reference_no.length > 0 &&
            data.amount.length > 0) {
            flag = true;
        }
    } else {
        data.title = title;
        data.id = id;
        data.customers = [];
        data.statement_type = $('#statementModal select#statementType').val();
        data.statement_date = $('#statementModal input#statementDate').val();
        data.cust_bal_status = $('#statementModal select#customerBalanceStatus').val();
        data.start_date = data.statement_type !== "2" ? $('#statementModal input#startDate').val() : null;
        data.end_date = data.statement_type !== "2" ? $('#statementModal input#endDate').val() : null;

        var customers = $('#statements-table tbody tr td:first-child() input:checked');

        customers.each(function() {
            data.customers.push($(this).val());
        });

        if(data.customers.length > 0) {
            flag = true;
        }
    }

    if (flag === true) {
        $.ajax({
            url: '/accounting/generate-pdf',
            data: {json: JSON.stringify(data)},
            type: 'post',
            dataType: "JSON",
            success: function(res) {
                if (res.filename != "") {
                    $('iframe#showPdf').attr('src', "/accounting/show-pdf?pdf=" +res.filename);
                    $('#showPdfModal').modal('show');

                    $('#showPdfModal div.modal-footer a#download-pdf').attr('href', '/accounting/download-pdf?filename='+res.filename);
                }
            }
        });
    } else {
        toast(false, "Please enter and complete at least one line item.");
        return;
    }
}

const computeTotalValue = () => {
    var initialQty = $('#adjust-starting-value-modal #initialQty').val();
    var initialCost = $('#adjust-starting-value-modal #initialCost').val();
    initialQty = initialQty === "" ? 0 : initialQty;
    initialCost = initialCost === "" ? 0.00 : initialCost;

    var totalValue = parseFloat(initialCost) * parseInt(initialQty);
    totalValue = totalValue === 0 ? 0.00 : totalValue

    $('#adjust-starting-value-modal .total-value').html('$'+parseFloat(totalValue).toFixed(2));
}

const computeTransactionTotal = () => {
    var total = 0.00;

    $('#modal-container table#category-details-table input[name="category_amount[]"]').each(function() {
        var value = $(this).val() === "" ? 0.00 : parseFloat($(this).val()).toFixed(2);

        total = parseFloat(parseFloat(total) + parseFloat(value)).toFixed(2);
    });

    $('#modal-container table#item-details-table tbody tr td span.row-total').each(function() {
        var value = $(this).html() === "" ? 0.00 : parseFloat($(this).html().replace('$', '').replaceAll(',', '')).toFixed(2);

        total = parseFloat(parseFloat(total) + parseFloat(value)).toFixed(2);
    });

    $('#modal-container .transaction-total-amount').html(formatter.format(parseFloat(total)));
}

const loadBills = () => {
    $('#payBillsModal table#bills-table').DataTable({
        autoWidth: false,
        searching: false,
        processing: true,
        serverSide: true,
        lengthChange: false,
        info: false,
        pageLength: $('#table_rows').val(),
        order: [[3, 'asc']],
        ajax: {
            url: '/accounting/load-bills/',
            dataType: 'json',
            contentType: 'application/json',
            type: 'POST',
            data: function(d) {
                d.due_date = $(`${modalName} #due_date`).val();
                d.from_date = $(`${modalName} #from`).val();
                d.to_date = $(`${modalName} #to`).val();
                d.payee = $(`${modalName} #pay-bills-vendor`).val();
                d.overdue_only = $(`${modalName} #overdue_only`).prop('checked') ? "1" : "0";
                d.length = $(`${modalName} #table_rows`).val();
                return JSON.stringify(d);
            },
            pagingType: 'full_numbers'
        },
        columns: [
            {
                data: null,
                name: 'checkbox',
                orderable: false,
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(`
                    <div class="d-flex align-items-center justify-content-center">
                        <input type="checkbox" value="${rowData.id}">
                    </div>
                    `);
                }
            },
            {
                data: 'payee',
                name: 'payee',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(`${cellData} <input type="hidden" value="${rowData.payee_id}">`);
                }
            },
            {
                data: 'ref_no',
                name: 'ref_no'
            },
            {
                data: 'due_date',
                name: 'due_date'
            },
            {
                data: 'open_balance',
                name: 'open_balance',
            },
            {
                orderable: false,
                data: null,
                name: 'credit_applied',
                orderable: false,
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    if(rowData.vendor_credits !== null && rowData.vendor_credits !== "" && rowData.vendor_credits !== "0.00") {
                        var max = parseFloat(rowData.vendor_credits) > parseFloat(rowData.open_balance) ? rowData.open_balance : rowData.vendorCredits;

                        $(td).html(`
                        <div class="row">
                            <div class="col-sm-9">
                                <input type="number" class="form-control text-right credit-applied" step=".01" max="${max}" onchange="convertToDecimal(this)">
                            </div>
                            <div class="col-sm-3 d-flex align-items-center">
                                <span class="available-credit">${rowData.vendor_credits}</span> &nbsp;available
                            </div>
                        </div>
                        `);
                    } else {
                        $(td).addClass('text-right');
                        $(td).html('Not available');
                    }
                }
            },
            {
                orderable: false,
                data: null,
                name: 'payment',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html('<input type="number" class="form-control text-right payment-amount" onchange="convertToDecimal(this)">');
                }
            },
            {
                orderable: false,
                data: null,
                name: 'total_amount',
                fnCreatedCell: function(td, cellData, rowData,row, col) {
                    $(td).html(`$<span>0.00</span>`);
                }
            }
        ]
    });
}

const resetbillsfilter = () => {
    $('#payBillsModal #due_date').val('last-365-days').trigger('change');
    $('#payBillsModal #from').val('');
    $('#payBillsModal #to').val('');
    $('#payBillsModal #payee').val('all').trigger('change');
    $('#payBillsModal #overdue_only').prop('checked', false);
    applybillsfilter();
}

const applybillsfilter = () => {
    $('#payBillsModal table#bills-table').DataTable().ajax.reload(null, true);
}

const computeBillsPaymentTotal = () => {
    var total = 0.00;
    $('#payBillsModal #bills-table tbody tr').each(function() {
        if($(this).find('input[type="checkbox"]').prop('checked')) {
            total += parseFloat($(this).find('td:last-child span').html())
        }
    });

    total = '$'+parseFloat(total).toFixed(2);
    $('#payBillsModal span.transaction-total-amount').html(formatter.format(parseFloat(total)));
}

const updateTransaction = (event, el) => {
    event.preventDefault();

    var data = new FormData(document.getElementById($(el).attr('id')));
    data.set('save_method', submitType);
    var modalId = '#'+$(el).children().attr('id');

    switch(modalId) {
        case '#weeklyTimesheetModal' :
            $('#weeklyTimesheetModal #timesheet-table tbody tr').each(function() {
                var customer = $(this).find('select[name="customer[]"]').val();
                if(customer !== "" && customer !== null) {
                    var hours = {
                        'sunday' : $('#weeklyTimesheetModal #show_sunday').prop('checked') ? $(this).find('[name="sunday_hours[]"]').val() : null,
                        'monday' : $('#weeklyTimesheetModal #show_monday').prop('checked') ? $(this).find('[name="monday_hours[]"]').val() : null,
                        'tuesday' : $('#weeklyTimesheetModal #show_tuesday').prop('checked') ? $(this).find('[name="tuesday_hours[]"]').val() : null,
                        'wednesday' : $('#weeklyTimesheetModal #show_wednesday').prop('checked') ? $(this).find('[name="wednesday_hours[]"]').val() : null,
                        'thursday' : $('#weeklyTimesheetModal #show_thursday').prop('checked') ? $(this).find('[name="thursday_hours[]"]').val() : null,
                        'friday' : $('#weeklyTimesheetModal #show_friday').prop('checked') ? $(this).find('[name="friday_hours[]"]').val() : null,
                        'saturday' : $('#weeklyTimesheetModal #show_saturday').prop('checked') ? $(this).find('[name="saturday_hours[]"]').val() : null,
                    };
    
                    if(data.has('hours[]')) {
                        data.append('hours[]', JSON.stringify(hours));
                        data.append('billable[]', $(this).find('[name="billable[]"]').prop('checked') ? 1 : null);
                        data.append('hourly_rate[]', $(this).find('[name="billable[]"]').prop('checked') ? $(this).find('[name="hourly_rate[]"]').val() : null);
                        data.append('taxable[]', $(this).find('[name="billable[]"]').prop('checked') && $(this).find('[name="taxable[]"]').prop('checked') ? 1 : null);
                        data.append('description[]', $(this).find('[name="description[]"]').val());
                    } else {
                        data.set('hours[]', JSON.stringify(hours));
                        data.set('billable[]', $(this).find('[name="billable[]"]').prop('checked') ? 1 : null);
                        data.set('hourly_rate[]', $(this).find('[name="billable[]"]').prop('checked') ? $(this).find('[name="hourly_rate[]"]').val() : null);
                        data.set('taxable[]', $(this).find('[name="billable[]"]').prop('checked') && $(this).find('[name="taxable[]"]').prop('checked') ? 1 : null);
                        data.set('description[]', $(this).find('[name="description[]"]').val());
                    }
                }
            });
        break;
        case '#payBillsModal' :
            var totalAmount = $(`${modalId} span.transaction-total-amount`).html().replace('$', '');
            data.append('total', totalAmount);
    
            $(`${modalId} #bills-table tbody tr`).each(function() {
                var checkbox = $(this).find('td:first-child input');
                var payee = $(this).find('td:nth-child(2) input').val();
                var credit_applied =  $(this).find('input.credit-applied').length > 0 ? $(this).find('input.credit-applied').val() : 0.00;
                var payment_amount =  $(this).find('input.payment-amount').val();
                var total_amount = parseFloat(parseFloat(credit_applied) + parseFloat(payment_amount)).toFixed(2);
    
                if(checkbox.prop('checked')) {
                    if(data.has('bills[]') === false) {
                        data.set('bills[]', checkbox.val());
                        data.set('payee[]', payee);
                        data.set('credit_applied[]', credit_applied);
                        data.set('payment_amount[]', payment_amount);
                        data.set('total_amount[]', total_amount);
                    } else {
                        data.append('bills[]', checkbox.val());
                        data.append('payee[]', payee);
                        data.append('credit_applied[]', credit_applied);
                        data.append('payment_amount[]', payment_amount);
                        data.append('total_amount[]', total_amount);
                    }
                }
            });
        break;
        case '#billPaymentModal' :
            data.delete('bills[]');
            data.delete('credits[]');
    
            $(`${modalId} #bills-table tbody tr`).each(function() {
                if($(this).find('input[type="checkbox"]').prop('checked')) {
                    if(data.has('bills[]') === false) {
                        data.set('bills[]', $(this).find('input[type="checkbox"]').val());
                        data.set('bill_payment[]', $(this).find('input[name="bill_payment[]"]').val());
                    } else {
                        data.append('bills[]', $(this).find('input[type="checkbox"]').val());
                        data.append('bill_payment[]', $(this).find('input[name="bill_payment[]"]').val());
                    }
                }
            });
    
            $(`${modalId} #vendor-credits-table tbody tr`).each(function() {
                if($(this).find('input[type="checkbox"]').prop('checked')) {
                    if(data.has('credits[]') === false) {
                        data.set('credits[]', $(this).find('input[type="checkbox"]').val());
                        data.set('credit_payment[]', $(this).find('input[name="credit_payment[]"]').val());
                    } else {
                        data.append('credits[]', $(this).find('input[type="checkbox"]').val());
                        data.append('credit_payment[]', $(this).find('input[name="credit_payment[]"]').val());
                    }
                }
            });
        break;
        case '#journalEntryModal' :
            data.delete('names[]');

            $('#journalEntryModal #journal-table tbody tr select[name="names[]"]').each(function() {
                if(data.has('names[]') === false) {
                    data.set('names[]', $(this).val() === null ? '' : $(this).val());
                } else {
                    data.append('names[]', $(this).val() === null ? '' : $(this).val());
                }
            });
        break;
        case '#depositModal' :
            data.delete('received_from[]');
            data.delete('payment_method[]');
    
            $('#depositModal #bank-deposit-table tbody tr select[name="received_from[]"]').each(function() {
                if(data.has('received_from[]') === false) {
                    data.set('received_from[]', $(this).val() === null ? '' : $(this).val());
                } else {
                    data.append('received_from[]', $(this).val() === null ? '' : $(this).val());
                }
            });
    
            $('#depositModal #bank-deposit-table tbody tr select[name="payment_method[]"]').each(function() {
                if(data.has('payment_method[]') === false) {
                    data.set('payment_method[]', $(this).val() === null ? '' : $(this).val());
                } else {
                    data.append('payment_method[]', $(this).val() === null ? '' : $(this).val());
                }
            });
        break;
        case '#payrollModal' :
            data = payrollFormData;
        break;
        case '#commission-payroll-modal' :
            data = payrollFormData;
        break;
        case '#bonus-payroll-modal' :
            data = payrollFormData;
        break;
        case '#receivePaymentModal' :
            data.delete('payment[]');
            data.delete('credit_payment[]');

            data.set('amount_to_credit', $('#receivePaymentModal span.amount-to-credit').html().replace('$', ''));
            data.set('amount_to_apply', $('#receivePaymentModal span.amount-to-apply').html().replace('$', ''));

            $('#receivePaymentModal #invoices-table tbody tr input[type="checkbox"]:checked').each(function() {
                if(data.has('invoice[]') === false) {
                    data.set('invoice[]', $(this).val());
                    data.set('payment[]', $(this).parent().parent().parent().parent().find('input[name="payment[]"]').val());
                } else {
                    data.append('invoice[]', $(this).val());
                    data.append('payment[]', $(this).parent().parent().parent().parent().find('input[name="payment[]"]').val());
                }
            });

            $('#receivePaymentModal #credit-memo-table tbody tr input[type="checkbox"]:checked').each(function() {
                if(data.has('credits[]') === false) {
                    data.set('credits[]', $(this).val());
                    data.set('credit_payment[]', $(this).parent().parent().parent().parent().find('input[name="credit_payment[]"]').val());
                } else {
                    data.append('credits[]', $(this).val());
                    data.append('credit_payment[]', $(this).parent().parent().parent().parent().find('input[name="credit_payment[]"]').val());
                }
            });
        break;
        case '#invoiceModal' :
            data.set('invoice_no', $('#invoiceModal #invoice-no').val());
        break;
    }

    if(customerModals.includes(modalId)) {
        data.delete('item[]');
        data.delete('package[]');
        data.delete('location[]');
        data.delete('quantity[]');
        data.delete('item_amount[]');
        data.delete('discount[]');
        data.delete('item_tax[]');
        $(`${modalId} table#item-table tbody:not(#package-items-table) tr:not(.package-items, .package-item, .package-item-header)`).each(function() {
            if(data.has('item_total[]')) {
                if($(this).hasClass('package')) {
                    data.append('item[]', 'package-'+$(this).find('input[name="package[]"]').val());
                    data.append('location[]', null);
                    data.append('item_amount[]', $(this).find('span.item-amount').html());
                    data.append('discount[]', null);
                } else {
                    data.append('item[]', 'item-'+$(this).find('input[name="item[]"]').val());
                    data.append('location[]', $(this).find('select[name="location[]"]').val());
                    data.append('item_amount[]', $(this).find('input[name="item_amount[]"]').val());
                    data.append('discount[]', $(this).find('input[name="discount[]"]').val());
                }
                data.append('item_tax[]', $(this).find('input[name="item_tax[]"]').val());
                data.append('quantity[]', $(this).find('input[name="quantity[]"]').val());
                data.append('item_total[]', $(this).find('span.row-total').html().replace('$', ''));
            } else {
                if($(this).hasClass('package')) {
                    data.set('item[]', 'package-'+$(this).find('input[name="package[]"]').val());
                    data.set('location[]', null);
                    data.set('item_amount[]', $(this).find('span.item-amount').html());
                    data.set('discount[]', null);
                } else {
                    data.set('item[]', 'item-'+$(this).find('input[name="item[]"]').val());
                    data.set('location[]', $(this).find('select[name="location[]"]').val());
                    data.set('item_amount[]', $(this).find('input[name="item_amount[]"]').val());
                    data.set('discount[]', $(this).find('input[name="discount[]"]').val());
                }
                data.set('item_tax[]', $(this).find('input[name="item_tax[]"]').val());
                data.set('quantity[]', $(this).find('input[name="quantity[]"]').val());
                data.set('item_total[]', $(this).find('span.row-total').html().replace('$', ''));
            }
        });

        data.set('total_amount', $(`${modalId} .transaction-grand-total:first-child`).html().replace('$', '').trim());
        data.set('subtotal', $(`${modalId} .transaction-subtotal:first-child`).html().replace('$', '').trim());
        data.set('tax_total', $(`${modalId} .transaction-taxes:first-child`).html().replace('$', '').trim());
        data.set('discount_total', $(`${modalId} .transaction-discounts:first-child`).html().replace('$', '').trim());
    }

    if(vendorModals.includes(modalId)) {
        var count = 0;
        var totalAmount = $(`${modalId} span.transaction-total-amount`).html().replace('$', '');
        data.append('total_amount', totalAmount);

        $(`${modalId} table#category-details-table tbody tr`).each(function() {
            var billable = $(this).find('input[name="category_billable[]"]');
            var tax = $(this).find('input[name="category_tax[]"]');

            if(billable.length > 0 && tax.length > 0) {
                if(count === 0) {
                    data.set('category_billable[]', billable.prop('checked') ? "1" : "0");
                    data.set('category_tax[]', tax.prop('checked') ? "1" : "0");
                    data.set('category_linked[]', $(this).find('i.fa.fa-link').length > 0);
                } else {
                    data.append('category_billable[]', billable.prop('checked') ? "1" : "0");
                    data.append('category_tax[]', tax.prop('checked') ? "1" : "0");
                    data.append('category_linked[]', $(this).find('i.fa.fa-link').length > 0);
                }
            }

            count++;
        });

        count = 0;
        $(`${modalId} table#item-details-table tbody tr`).each(function() {
            if(count === 0) {
                data.set('item_total[]', $(this).find('td span.row-total').html().replace('$', ''));
                data.set('item_linked[]', $(this).find('i.fa.fa-link').length > 0);
            } else {
                data.append('item_total[]', $(this).find('td span.row-total').html().replace('$', ''));
                data.append('item_linked[]', $(this).find('i.fa.fa-link').length > 0);
            }

            count++;
        });
    }
    data.append('modal_name', $(el).children().attr('id'));

    $.ajax({
        url: $(el).attr('data-href'),
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            var res = JSON.parse(result);

            toast(res.success, res.message);

            if(res.success === true) {
                if(submitType === 'save-and-close' || submitType === 'save-and-void') {
                    $(el).children().modal('hide');
                }

                if(submitType === 'save-and-send' && modalId === '#purchaseOrderModal') {
                    sendPurchaseOrder(res.data);
                }

                if(submitType === 'save-and-print') {
                    switch(modalId) {
                        case '#purchaseOrderModal' :
                            printPurchaseOrder();
                        break;
                        case '#weeklyTimesheetModal' :
                            printTimesheet(res.data);
                        break;
                        case '#receivePaymentModal' :

                        break;
                        case '#invoiceModal' :
                            printPreviewInvoice();
                        break;
                        case '#creditMemoModal' :
                            printPreviewCreditMemo();
                        break;
                        case '#salesReceiptModal' :
                            printPreviewSalesReceipt();
                        break;
                        case '#refundReceiptModal' :
                            printPreviewRefundReceipt();
                        break;
                    }
                }

                if(submitType === 'save-and-new') {
                    clearForm();
                }
            }

            submitType = '';
            $('#transactions-table').DataTable().ajax.reload(null, true);
        }
    });
}

const unlinkTransaction = () =>  {
    if($('#modal-container .modal#billPaymentModal').length === 0) {
        if($('#modal-container .modal a#linked-transaction').length > 0) {
            $('#modal-container .modal a#linked-transaction').parent().parent().remove();
            $('#modal-container .modal #category-details-table thead tr th:last-child').remove();
            $('#modal-container .modal #item-details-table thead tr th:last-child').remove();
    
            var count = 1;
            $('#modal-container .modal #category-details-table tbody tr').each(function(index, value) {
                if($(this).find('i.fa.fa-link').length > 0) {
                    $(this).remove();
                } else {
                    $(this).find('td:nth-child(2)').html(count);
                    $(this).find('td:nth-child(11)').remove();
                    count++;
                }
            });
    
            if($('#modal-container .modal #category-details-table tbody tr').length < rowCount) {
                do {
                    $('#modal-container .modal #category-details-table tbody').append(`<tr>${catDetailsBlank}</tr>`);
                    $('#modal-container .modal #category-details-table tbody tr:last-child td:nth-child(2)').html(count);
                    count++;
                } while($('#modal-container .modal #category-details-table tbody tr').length < rowCount)
            }
    
            $('#modal-container .modal #item-details-table tbody tr').each(function() {
                if($(this).find('i.fa.fa-link').length > 0) {
                    $(this).remove();
                }
            });
    
            computeTransactionTotal();
        }
    } else {
        if($('#billPaymentModal input[name="bills[]"]').length > 0 && $('#billPaymentModal #bills-table tbody tr').length > 0) {
            $('#billPaymentModal input[name="bills[]"]').remove();
            $('#billPaymentModal #search-bill-no').val('');
            $('#billPaymentModal #bills-from').val('');
            $('#billPaymentModal #bills-to').val('');
            $('#billPaymentModal #bill-payment-amount').val('');
            // $('#billPaymentModal #bills-table tbody tr').remove();
            // $('#billPaymentModal #vendor-credits-table tbody tr').remove();
            $('#billPaymentModal .payment-total-amount').html('0.00');
            $('#billPaymentModal #bills-table').DataTable().ajax.reload(null, true);
            $('#billPaymentModal #vendor-credits-table').DataTable().ajax.reload(null, true);
        }
    }
}

const initModalFields = (modalName, data = {}) => {
    if(!$.isEmptyObject(data)) {
        var transactionType = data.type;
        transactionType = transactionType.replaceAll(' (Check)', '');
        transactionType = transactionType.replaceAll(' (Credit Card)', '');
        transactionType = transactionType.replaceAll(' ', '-');
        transactionType = transactionType.toLowerCase();
    }

    if($(`#${modalName} table#category-details-table`).length > 0) {
        rowCount = 2;
        catDetailsInputs = $(`#${modalName} table#category-details-table tbody tr:first-child()`).html();
        catDetailsBlank = $(`#${modalName} table#category-details-table tbody tr:last-child`).html();

        $(`#${modalName} table#category-details-table tbody tr:first-child()`).remove();
        $(`#${modalName} table#category-details-table tbody tr:last-child()`).remove();
    } else {
        if($(`#${modalName} .modal-body table.clickable`).length > 0) {
            if(modalName !== 'inventoryModal') {
                rowInputs = $(`div#modal-container #${modalName} .modal-body table tbody tr:first-child()`).html();
                blankRow = $(`div#modal-container #${modalName} .modal-body table tbody tr:last-child()`).html();
                $(`div#modal-container #${modalName} .modal-body table tbody tr:first-child()`).remove();
                $(`div#modal-container #${modalName} .modal-body table tbody tr:last-child()`).remove();
            }
    
            switch(modalName) {
                case 'depositModal' :
                    rowCount = 2;
                break;
                case 'journalEntryModal' :
                    rowCount = 8;
                break;
                case 'inventoryModal' :
                    rowCount = 2;
                break;
                case 'weeklyTimesheetModal' :
                    rowCount = 3;
                break;
            }
        }
    }

    if($(`#${modalName} select`).length > 0) { //
        $(`#${modalName} select`).each(function() {
            var type = $(this).attr('id');
            if (type === undefined) {
                type = $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-').replace('category-', '');
            } else {
                type = type.replaceAll('_', '-');

                if (type.includes('transfer')) {
                    type = 'transfer-account';
                }
            }

            if (dropdownFields.includes(type)) {
                $(this).select2({
                    ajax: {
                        url: '/accounting/get-dropdown-choices',
                        dataType: 'json',
                        data: function(params) {
                            var query = {
                                search: params.term,
                                type: 'public',
                                field: type,
                                modal: modalName
                            }

                            // Query parameters will be ?search=[term]&type=public&field=[type]
                            return query;
                        }
                    },
                    templateResult: formatResult,
                    templateSelection: optionSelect
                });
            } else {
                var options = $(this).find('option');
                if (options.length > 10) {
                    $(this).select2();
                } else {
                    $(this).select2({
                        minimumResultsForSearch: -1
                    });
                }
            }
        });
    }

    if($(`div#${modalName} select#tags`).length > 0) {
        $(`div#${modalName} select#tags`).select2({
            placeholder: 'Start typing to add a tag',
            allowClear: true,
            ajax: {
                url: '/accounting/get-job-tags',
                dataType: 'json'
            }
        });
    }

    if($(`div#${modalName} .date`).length > 0) {
        $(`div#${modalName} .date`).each(function(){
            $(this).datepicker({
                uiLibrary: 'bootstrap'
            });
        });
    }

    if($(`#${modalName} .attachments`).length > 0) {
        var attachmentContId = $(`#${modalName} .attachments .dropzone`).attr('id');
        modalAttachments = new Dropzone(`#${attachmentContId}`, {
            url: '/accounting/attachments/attach',
            maxFilesize: 20,
            uploadMultiple: true,
            // maxFiles: 1,
            addRemoveLinks: true,
            init: function() {
                if(!$.isEmptyObject(data)) {
                    $.getJSON('/accounting/get-linked-attachments/'+transactionType+'/'+data.id, function(attachments) {
                        if(attachments.length > 0) {
                            $.each(attachments, function(index, val) {
                                $(`#${modalName}`).find('.attachments').parent().append(`<input type="hidden" name="attachments[]" value="${val.id}">`);

                                modalAttachmentId.push(val.id);
                                var mockFile = {
                                    name: `${val.uploaded_name}.${val.file_extension}`,
                                    size: parseInt(val.size),
                                    dataURL: base_url+"uploads/accounting/attachments/" + val.stored_name,
                                    accepted: true
                                };
                                modalAttachments.emit("addedfile", mockFile);
                                modalAttachedFiles.push(mockFile);
            
                                modalAttachments.createThumbnailFromUrl(mockFile, modalAttachments.options.thumbnailWidth, modalAttachments.options.thumbnailHeight, modalAttachments.options.thumbnailMethod, true, function(thumbnail) {
                                    modalAttachments.emit('thumbnail', mockFile, thumbnail);
                                });
                                modalAttachments.emit("complete", mockFile);
                            });
                        }
                    });
                }

                this.on("success", function(file, response) {
                    var ids = JSON.parse(response)['attachment_ids'];
                    var modal = $(`#${modalName}`);

                    for(i in ids) {
                        if(modal.find(`input[name="attachments[]"][value="${ids[i]}"]`).length === 0) {
                            modal.find('.attachments').parent().append(`<input type="hidden" name="attachments[]" value="${ids[i]}">`);
                        }

                        modalAttachmentId.push(ids[i]);
                    }
                    modalAttachedFiles.push(file);
                });
            },
            removedfile: function(file) {
                var ids = modalAttachmentId;
                var index = modalAttachedFiles.map(function(d, index) {
                    if (d == file) return index;
                }).filter(isFinite)[0];
        
                $(`#${modalName} .attachments`).parent().find(`input[name="attachments[]"][value="${ids[index]}"]`).remove();

                //remove thumbnail
                var previewElement;

                if((previewElement = file.previewElement) !== null) {
                    var remove = (previewElement.parentNode.removeChild(file.previewElement));
        
                    if($(`#${attachmentContId} .dz-preview`).length > 0) {
                        $(`#${attachmentContId} .dz-message`).hide();
                    } else {
                        $(`#${attachmentContId} .dz-message`).show();
                    }
        
                    return remove;
                } else {
                    return (void 0);
                }
            }
        });
    }
}

const loadBillPaymentBills = () => {
    $('#billPaymentModal table#bills-table').DataTable({
        autoWidth: false,
        searching: false,
        processing: true,
        serverSide: true,
        lengthChange: false,
        info: false,
        pageLength: $('#billPaymentModal #bills_table_rows').val(),
        ordering: false,
        ajax: {
            url: '/accounting/load-bill-payment-bills/',
            dataType: 'json',
            contentType: 'application/json',
            type: 'POST',
            data: function(d) {
                d.search = $('#billPaymentModal #search-bill-no').val();
                d.from = $('#billPaymentModal #bills-from').val();
                d.to = $('#billPaymentModal #bills-to').val();
                d.overdue = $('#billPaymentModal #overdue_bills_only').prop('checked');
                d.length = parseInt($('#billPaymentModal #bills_table_rows').val());
                d.vendor = $('#billPaymentModal #payee').val();

                return JSON.stringify(d);
            },
            pagingType: 'full_numbers'
        },
        columns: [
            {
                data: 'id',
                name: 'id',
                orderable: false,
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(`
                    <div class="d-flex align-items-center justify-content-center">
                        <input type="checkbox" value="${cellData}">
                    </div>
                    `);

                    if($(`#billPaymentModal input[name="bills[]"][value="${cellData}"]`).length > 0) {
                        $(td).children().children('input').prop('checked', true);
                    }
                }
            },
            {
                data: 'description',
                name: 'description'
            },
            {
                data: 'due_date',
                name: 'due_date'
            },
            {
                data: 'original_amount',
                name: 'original_amount'
            },
            {
                data: 'open_balance',
                name: 'open_balance'
            },
            {
                data: 'payment',
                name: 'payment',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(`<input type="number" name="bill_payment[]" class="form-control text-right" onchange="convertToDecimal(this)" step="0.01">`);

                    if($(`#billPaymentModal input[name="bills[]"][value="${rowData.id}"]`).length > 0) {
                        $(td).children('input').val(cellData);
                    }
                }
            }
        ]
    });
}

const loadBillPaymentCredits = () => {
    $('#billPaymentModal table#vendor-credits-table').DataTable({
        autoWidth: false,
        searching: false,
        processing: true,
        serverSide: true,
        lengthChange: false,
        info: false,
        pageLength: $('#billPaymentModal #vcredits_table_rows').val(),
        ordering: false,
        ajax: {
            url: '/accounting/load-bill-payment-credits/',
            dataType: 'json',
            contentType: 'application/json',
            type: 'POST',
            data: function(d) {
                d.search = $('#billPaymentModal #search-vcredit-no').val();
                d.from = $('#billPaymentModal #vcredit-from').val();
                d.to = $('#billPaymentModal #vcredit-to').val();
                d.length = parseInt($('#billPaymentModal #vcredits_table_rows').val());
                d.vendor = $('#billPaymentModal #payee').val();

                return JSON.stringify(d);
            },
            pagingType: 'full_numbers'
        },
        columns: [
            {
                data: 'id',
                name: 'id',
                orderable: false,
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(`
                    <div class="d-flex align-items-center justify-content-center">
                        <input type="checkbox" value="${cellData}">
                    </div>
                    `);

                    if($(`#billPaymentModal input[name="credits[]"][value="${cellData}"]`).length > 0) {
                        $(td).children().children('input').prop('checked', true);
                    }
                }
            },
            {
                data: 'description',
                name: 'description'
            },
            {
                data: 'original_amount',
                name: 'original_amount'
            },
            {
                data: 'open_balance',
                name: 'open_balance'
            },
            {
                data: 'payment',
                name: 'payment',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(`<input type="number" name="credit_payment[]" class="form-control text-right" onchange="convertToDecimal(this)" max="${rowData.open_balance}" step="0.01">`);

                    if($(`#billPaymentModal input[name="credits[]"][value="${rowData.id}"]`).length > 0) {
                        $(td).children('input').val(cellData);
                    }
                }
            }
        ]
    });
}

const loadChecksTable = () => {
    $('#printChecksModal table#checks-table').DataTable({
        autoWidth: false,
        searching: false,
        processing: true,
        serverSide: true,
        lengthChange: false,
        info: false,
        pageLength: $('#printChecksModal #table_rows').val(),
        ordering: false,
        ajax: {
            url: '/accounting/load-checks/',
            dataType: 'json',
            contentType: 'application/json',
            type: 'POST',
            data: function(d) {
                d.length = parseInt($('#printChecksModal #table_rows').val());
                d.payment_account = $('#printChecksModal #payment_account').val();
                d.sort = $('#printChecksModal #sort').val();
                d.type = $('#printChecksModal #check-type').val();

                return JSON.stringify(d);
            },
            pagingType: 'full_numbers'
        },
        columns: [
            {
                data: 'id',
                name: 'id',
                orderable: false,
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(`
                    <div class="d-flex align-items-center justify-content-center">
                        <input type="checkbox" value="${cellData}">
                    </div>
                    `);
                }
            },
            {
                data: 'date',
                name: 'date'
            },
            {
                data: 'type',
                name: 'type'
            },
            {
                data: 'payee',
                name: 'payee'
            },
            {
                data: 'amount',
                name: 'amount'
            }
        ]
    });
}

const savePayBills = (e) => {
    e.preventDefault();

    submitType = 'save';
    $('#modal-container form#modal-form').submit();

    $('#payBillsModal #bills-table').DataTable().ajax.reload(null, true);
    $('#payBillsModal .transaction-total-amount').html('$0.00');
}

const savePrintPayBills = (e) => {
    e.preventDefault();

    $('#payBillsModal #print_later').prop('checked', true).trigger('change');
    $('#modal-container form#modal-form').submit();
    var paymentAcc = $('#payBillsModal #payment_account').val();
    $('#payBillsModal').modal('hide');

    $('#new-popup #accounting_vendors a[data-target="#printChecksModal"]').trigger('click');
    $('#printChecksModal #payment_account').val(paymentAcc).trigger('change');
}

const saveClosePayBills = (e) => {
    e.preventDefault();

    $('#modal-container form#modal-form').submit();

    $('#modal-container .modal').modal('hide');
}

const formatResult = (optionElement) => {
    var searchField = $('.select2-search__field');
    var text = optionElement.text;
    var searchVal = $(searchField[searchField.length - 1]).val();
    if(searchVal === "") {
        return text;
    }

    return $(`<span>${text}</span>`);
}

const optionSelect = (data, container) => {
    var text = data.text;
    text = text.replaceAll('<strong>', '');
    text = text.replaceAll('</strong>', '');
    text = $.trim(text);
    return text;
}

const showBalance = (el) => {
    if($('#account-modal #choose_time').val() === 'other' && $(el).val() !== '') {
        $('#account-modal #balance').parent().removeClass('hide');
    } else {
        $('#account-modal #balance').parent().addClass('hide');
    }
}

const initAccountModal = () => {
$('#modal-container #account-modal select').each(function() {
        var id = $(this).attr('id').replaceAll('_', '-');
        switch (id) {
            case 'account-type':
                $(this).select2({
                    ajax: {
                        url: '/accounting/get-dropdown-choices',
                        dataType: 'json',
                        data: function(params) {
                            var query = {
                                search: params.term,
                                type: 'public',
                                field: id
                            }

                            if(dropdownEl !== null) {
                                var field = dropdownEl.attr('id');
                                var fieldName = field === undefined ? dropdownEl.attr('name').replaceAll('[]', '').replaceAll('_', '-').toLowerCase() : field.toLowerCase().replaceAll('_', '-');
                                fieldName = fieldName.includes('from') || fieldName.includes('to') ? fieldName.replaceAll('from-', '').replaceAll('to-', '') : fieldName;

                                query.dropdown = fieldName
                            }

                            // Query parameters will be ?search=[term]&type=public&field=[type]
                            return query;
                        }
                    },
                    templateResult: formatResult,
                    templateSelection: optionSelect,
                    dropdownParent: $('#modal-container #account-modal')
                });
            break;
            case 'detail-type':
                $(this).select2({
                    ajax: {
                        url: '/accounting/get-dropdown-choices',
                        dataType: 'json',
                        data: function(params) {
                            var query = {
                                search: params.term,
                                type: 'public',
                                field: id,
                                accType: $(this).parent().prev().find('#account_type').val()
                            }

                            if(dropdownEl !== null) {
                                query.dropdown = dropdownEl.attr('name').replaceAll('_', '-');
                            }

                            // Query parameters will be ?search=[term]&type=public&field=[type]
                            return query;
                        }
                    },
                    templateResult: formatResult,
                    templateSelection: optionSelect,
                    dropdownParent: $('#modal-container #account-modal')
                });
            break;
            case 'parent-account':
                $(this).select2({
                    ajax: {
                        url: '/accounting/get-dropdown-choices',
                        dataType: 'json',
                        data: function(params) {
                            var query = {
                                search: params.term,
                                type: 'public',
                                field: id
                            }

                            // Query parameters will be ?search=[term]&type=public&field=[type]
                            return query;
                        }
                    },
                    templateResult: formatResult,
                    templateSelection: optionSelect,
                    dropdownParent: $('#modal-container #account-modal'),
                    placeholder: 'Enter parent account'
                });
            break;
            default:
                if ($(this).find('option').length > 10) {
                    $(this).select2({
                        dropdownParent: $('#modal-container #account-modal')
                    });
                } else {
                    $(this).select2({
                        minimumResultsForSearch: -1,
                        dropdownParent: $('#modal-container #account-modal')
                    });
                }
            break;
        }
    });
    var switchEl = $('#modal-container #account-modal #check_sub').get(0);
    var switchery = new Switchery(switchEl, { size: 'small' });

    $('#modal-container #account-modal .date_picker input').datepicker({
        uiLibrary: 'bootstrap',
        todayBtn: "linked",
        language: "de"
    });

    if(dropdownEl !== null) {
        $('#modal-container #account-modal form').attr('id', 'ajax-add-account');
        $('#modal-container #account-modal form').removeAttr('action');
        $('#modal-container #account-modal form').removeAttr('method');
        $('#modal-container #account-modal form').removeAttr('novalidate');
        $('#modal-container #account-modal').modal({
            backdrop: 'static',
            keyboard: false
        });
    } else {
        $('#modal-container #account-modal').modal('show');
    }
}

const changeItemType = (type) => {
	var action = $(`#${type}-item-form`).attr('action');
	var formId = $(`#${type}-item-form`).attr('id');
	form = new FormData(document.getElementById(`${type}-item-form`));
	$(`#${type}-form-modal`).modal('hide');
	$('#type-selection-modal').modal('show');
	$('#type-selection-modal table tbody tr:last-child').hide();

	$(document).on('show.bs.modal', '#inventory-form-modal, #non-inventory-form-modal, #service-form-modal', function() {
		var modalId = $(this).attr('id');
		switch(modalId) {
			case 'inventory-form-modal' :
				action = action.replace('/'+type, '/inventory');
				type = 'inventory';
			break;
			case 'non-inventory-form-modal' :
				action = action.replace('/'+type, '/non-inventory');
				type = 'non-inventory';
			break;
			case 'service-form-modal' :
				action = action.replace('/'+type, '/service');
				type = 'service';
			break;
		}

		$(this).find('form').attr('action', action);
		$(this).find('form').attr('id', `${type}-item-form`);
		if(form.has('name')) {
			for(var data  of form.entries()) {
				if(data[0] !== 'icon') {
					$(this).find(`[name="${data[0]}"]`).val(data[1]).trigger('change');
				} else {
					if(rowData.icon !== null && rowData.icon !== "") {
						$(this).find('img.image-prev').attr('src', `/uploads/${rowData.icon}`);
						$(this).find('img.image-prev').parent().addClass('d-flex justify-content-center');
						$(this).find('img.image-prev').parent().removeClass('hide');
						$(this).find('img.image-prev').parent().prev().addClass('hide');
					}
				}
			}

			if(form.has('selling')) {
				$(this).find('#selling').prop('checked', true).trigger('change');
			}

			if(form.has('purchasing')) {
				$(this).find('#purchasing').prop('checked', true).trigger('change');
			}
		}

		form = new FormData();
	});
}

const fillItemDropdownFields = (data) => {
    switch(data[0]) {
        case 'vendor' :
            $.get(`/accounting/get-vendor-details/${data[1]}`, function(result) {
                var vendor = JSON.parse(result);
                $('#item-modal form').find(`[name="${data[0]}"]`).append(`<option value="${data[1]}" selected>${vendor.display_name}</option>`);
            });
        break;
        case 'category' :
            $.get(`/accounting/get-item-category-details/${data[1]}`, function(result) {
                var category = JSON.parse(result);
                $('#item-modal form').find(`[name="${data[0]}"]`).append(`<option value="${data[1]}" selected>${category.name}</option>`);
            });
        break;
        case 'sales_tax_category' :
            $.get(`/accounting/get-sales-tax-category-details/${data[1]}`, function(result) {
                var category = JSON.parse(result);
                $('#item-modal form').find(`[name="${data[0]}"]`).append(`<option value="${data[1]}" selected>${category.name}</option>`);
            });
        break;
        default :
            $.get(`/accounting/get-account-details/${data[1]}`, function(result) {
                var account = JSON.parse(result);
                $('#item-modal form').find(`[name="${data[0]}"]`).append(`<option value="${data[1]}" selected>${account.name}</option>`);
            });
        break;
    }
}

const initBillsTable = (data) => {
    $('#billPaymentModal #bills-table').DataTable({
        autoWidth: false,
        searching: false,
        processing: true,
        serverSide: true,
        lengthChange: false,
        info: false,
        pageLength: parseInt($('#billPaymentModal #table_rows').val()),
        ordering: false,
        ajax: {
            url: `/accounting/load-bill-payment-bills/${data.id}`,
            dataType: 'json',
            contentType: 'application/json',
            type: 'POST',
            data: function(d) {
                d.search = $('#billPaymentModal #search').val();
                d.from = $('#billPaymentModal #bills-from').val();
                d.to = $('#billPaymentModal #bills-to').val();
                d.overdue = $('#billPaymentModal #overdue_bills_only').prop('checked');
                d.length = parseInt($('#billPaymentModal #table_rows').val());
                return JSON.stringify(d);
            },
            pagingType: 'full_numbers'
        },
        columns: [
            {
                data: 'id',
                name: 'id',
                orderable: false,
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(`
                    <div class="d-flex align-items-center justify-content-center">
                        <input type="checkbox" value="${cellData}" ${rowData.selected ? 'checked' : ''}>
                    </div>
                    `);
                }
            },
            {
                data: 'description',
                name: 'description'
            },
            {
                data: 'due_date',
                name: 'due_date'
            },
            {
                data: 'original_amount',
                name: 'original_amount'
            },
            {
                data: 'open_balance',
                name: 'open_balance'
            },
            {
                data: 'payment',
                name: 'payment',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(`<input type="number" value="${cellData}" name="bill_payment[]" class="form-control text-right" onchange="convertToDecimal(this)">`);
                }
            }
        ]
    });
}

const initCreditsTable = (data) => {
    $('#billPaymentModal #vendor-credits-table').DataTable({
        autoWidth: false,
        searching: false,
        processing: true,
        serverSide: true,
        lengthChange: false,
        info: false,
        pageLength: parseInt($('#billPaymentModal #vcredits_table_rows').val()),
        ordering: false,
        ajax: {
            url: `/accounting/vendors/${vendorId}/load-bill-payment-credits/${data.id}`,
            dataType: 'json',
            contentType: 'application/json',
            type: 'POST',
            data: function(d) {
                d.search = $('#billPaymentModal #search-vcredit-no').val();
                d.from = $('#billPaymentModal #vcredit-from').val();
                d.to = $('#billPaymentModal #vcredit-to').val();
                d.length = parseInt($('#billPaymentModal #vcredits_table_rows').val());
                return JSON.stringify(d);
            },
            pagingType: 'full_numbers'
        },
        columns: [
            {
                data: 'id',
                name: 'id',
                orderable: false,
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(`
                    <div class="d-flex align-items-center justify-content-center">
                        <input type="checkbox" name="credits[]" value="${cellData}" ${rowData.selected ? 'checked' : ''}>
                    </div>
                    `);
                }
            },
            {
                data: 'description',
                name: 'description'
            },
            {
                data: 'original_amount',
                name: 'original_amount'
            },
            {
                data: 'open_balance',
                name: 'open_balance'
            },
            {
                data: 'payment',
                name: 'payment',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(`<input type="number" name="credit_payment[]" value="${cellData}" class="form-control text-right" onchange="convertToDecimal(this)" max="${rowData.open_balance}" step="0.01">`);
                }
            }
        ]
    });
}

const applyBillsFilter = () => {
    $('#billPaymentModal #bills-table').DataTable().ajax.reload(null, true);
}

const applyCreditsFilter = () => {
    $('#billPaymentModal #vendor-credits-table').DataTable().ajax.reload(null, true);
}

const resetBillsFilter = () => {
    $('#billPaymentModal #bills-from').val('');
    $('#billPaymentModal #bills-to').val('');
    $('#billPaymentModal #overdue_bills_only').prop('checked', false);

    applyBillsFilter();
}

const resetCreditsFilter = () => {
    $('#billPaymentModal #vcredit-from').val('');
    $('#billPaymentModal #vcredit-to').val('');

    applyCreditsFilter();
}

const viewTransaction = (el) => {
    $('#modal-container #modal-form .modal').modal('hide');
    $('.modal-backdrop:last-child').remove();

    var table = $(el).parent().parent();
    var data = table.DataTable().row($(el)).data();
    var type = table.attr('id').replace('recent-', '').slice(0, -1).toLowerCase();
    if(type === 'journal-entrie') {
        type = 'journal';
    } else if(type === 'time-activitie') {
        type = 'time-activity';
    }
    data.type = table.attr('id').replace('recent-', '').slice(0, -1).charAt(0).toUpperCase();
    data.type += table.attr('id').replace('recent-', '').slice(0, -1).slice(1);
    data.type = data.type.replace('-', ' ');

    if(data.type === 'Journal entrie') {
        data.type = 'Journal';
    } else if(data.type === 'Cc payment') {
        data.type = 'CC Payment';
    } else if(data.type === 'Time activitie') {
        data.type === 'Time activity';
    }

    $.get(`/accounting/view-transaction/${type}/${data.id}`, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        switch(type) {
            case 'expense' :
                initModalFields('expenseModal', data);

                $('#expenseModal #payee').trigger('change');

                $('#expenseModal').modal('show');
            break;
            case 'check' :
                initModalFields('checkModal', data);

                $('#checkModal #payee').trigger('change');
        
                $('#checkModal').modal('show');
            break;
            case 'bill' :
                initModalFields('billModal', data);

                $('#billModal').modal('show');
            break;
            case 'cc-credit' :
                initModalFields('creditCardCreditModal', data);

                $('#creditCardCreditModal').modal('show');
            break;
            case 'vendor-credit' :
                initModalFields('vendorCreditModal', data);

                $('#vendorCreditModal').modal('show');
            break;
            case 'deposit' :
                initModalFields('depositModal', data);

                $('#depositModal').modal('show');
            break;
            case 'purchase-order' :
                initModalFields('purchaseOrderModal', data);

                $('#purchaseOrderModal').modal('show');
            break;
            case 'transfer' :
                initModalFields('transferModal', data);

                $('#transferModal').modal('show');
            break;
            case 'journal' :
                initModalFields('journalEntryModal', data);

                $('#journalEntryModal').modal('show');
            break;
            case 'qty-adjustment' :
                rowInputs = $('#inventoryModal table#inventory-adjustments-table tbody tr:first-child()').html();
                blankRow = $('#inventoryModal table#inventory-adjustments-table tbody tr:nth-child(2)').html();
                rowCount = $('#inventoryModal table#inventory-adjustments-table tbody tr').length;

                $('#inventoryModal table#inventory-adjustments-table tbody tr:first-child()').html(blankRow);
                $('#inventoryModal table#inventory-adjustments-table tbody tr:first-child() td:nth-child(2)').html(1);

                initModalFields('inventoryModal', data);

                $('#inventoryModal').modal('show');
            break;
            case 'cc-payment' :
                initModalFields('payDownCreditModal', data);

                $('#payDownCreditModal').modal('show');
            break;
            case 'time-activity' :
                initModalFields('singleTimeModal', data);

                $('#singleTimeModal').modal('show');
            break;
            case 'receive-payment' :
                initModalFields('receivePaymentModal', data);

                loadPaymentInvoices(data);
                loadPaymentCredits(data);

                $('#receivePaymentModal').modal('show');
            break;
            case 'credit-memo' :
                initModalFields('creditMemoModal', data);

                $('#creditMemoModal').modal('show');
            break;
            case 'sales-receipt' :
                initModalFields('salesReceiptModal', data);

                $('#salesReceiptModal').modal('show');
            break;
            case 'refund-receipt' :
                initModalFields('refundReceiptModal', data);

                $('#refundReceiptModal').modal('show');
            break;
            case 'delayed-credit' :
                initModalFields('delayedCreditModal', data);

                $('#delayedCreditModal').modal('show');
            break;
            case 'delayed-charge' :
                initModalFields('delayedChargeModal', data);

                $('#delayedChargeModal').modal('show');
            break;
            case 'invoice' :
                initModalFields('invoiceModal', data);

                $('#invoiceModal').modal('show');
            break;
        }
    });
}

const saveAndCloseForm = (e) => {
    e.preventDefault();

    submitType = 'save-and-close';

    $(modalName).parent().submit();
}

const saveAndNewForm = (e) => {
    e.preventDefault();

    submitType = 'save-and-new';

    $(modalName).parent().submit();
}

const saveAndVoid = (e) => {
    submitType = 'save-and-void';

    Swal.fire({
        title: 'Are you sure you want to void this?',
        icon: 'warning',
        showCloseButton: false,
        confirmButtonColor: '#2ca01c',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        cancelButtonText: 'No',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if(result.isConfirmed) {
            $('#modal-container form#modal-form').submit();
        }
    });
}

const clearForm = () => {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today = mm + '/' + dd + '/' + yyyy;

    $(modalName).parent().attr('onsubmit', 'submitModalForm(event, this)').removeAttr('data-href');
    $(modalName).find('.modal-body #tags').val(null).trigger('change');
    $(modalName).find('.modal-body select').each(function() {
        if(!$(this).attr('id').includes('account') && $(this).find('option').length > 1) {
            if($(this).attr('id') === 'weekDates') {
                $(this).find('option').each(function() {
                    var value = $(this).attr('value');
                    var valueSplit = value.split('-');

                    var current = new Date();
                    var startDate = new Date(valueSplit[0]);
                    var endDate = new Date(valueSplit[1]);

                    if(current.getTime() >= startDate.getTime() && current.getTime() <= endDate.getTime()) {
                        $(this).prop('selected', true);
                    }
                });
            } else {
                $(this).find('option:first-child').prop('selected', true);
            }
            $(this).trigger('change');
        } else {
            $(this).val('').trigger('change');
        }
    });
    $(modalName).find('.modal-body input:not([type="checkbox"],.date,[type="number"],.day-input)').val('').trigger('change');
    $(modalName).find('.modal-body input.date').val(today);
    if(modalName !== '#time-activity-settings') {
        $(modalName).find('.modal-body input[type="checkbox"]:not(.show-field)').each(function() {
            $(this).prop('checked', false).trigger('change');
        });
    }
    $(modalName).find('.modal-body input[type="hidden"]').remove();
    $(modalName).find('.modal-body textarea').html('');
    $(modalName).find('.modal-body textarea').val('');
    $(modalName).find('.modal-body .dropzone .dz-preview').remove();
    $(modalName).find('.modal-body #item-details-table tbody tr').remove();
    $(modalName).find('.modal-body div.form-group#summary').remove();
    $(modalName).find('.modal-body .transaction-total-amount').html('$0.00');
    $(modalName).find('.modal-body #account-balance').html('$0.00');
    $(modalName).find('.modal-body .total-deposit-amount').html('$0.00');

    modalAttachmentId = [];
    modalAttachedFiles = [];
    $(modalName).find('.modal-body .dropzone .dz-message').show();

    if($(modalName).find('.modal-body a#linked-transaction').length > 0) {
        unlinkTransaction();
    }

    if(modalName === '#weeklyTimesheetModal') {
        $(modalName).find('.modal-body #timesheet-table tbody tr').remove();

        var count = 1;
        do {
            $(modalName).find('#timesheet-table tbody').append(`<tr>${rowInputs}</tr>`);
            $(modalName).find('#timesheet-table tbody tr:last-child() td:first-child()').html(count);
            $(modalName).find('#timesheet-table tbody tr:last-child() td:first-child() select').each(function() {
                var type = $(this).attr('id');
                if (type === undefined) {
                    type = $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-');
                } else {
                    type = type.replaceAll('_', '-');

                    if (type.includes('transfer')) {
                        type = 'transfer-account';
                    }
                }

                if (dropdownFields.includes(type)) {
                    $(this).select2({
                        ajax: {
                            url: '/accounting/get-dropdown-choices',
                            dataType: 'json',
                            data: function(params) {
                                var query = {
                                    search: params.term,
                                    type: 'public',
                                    field: type,
                                    modal: modalName.replaceAll('#', '')
                                }

                                // Query parameters will be ?search=[term]&type=public&field=[type]
                                return query;
                            }
                        },
                        templateResult: formatResult,
                        templateSelection: optionSelect
                    });
                } else {
                    var options = $(this).find('option');
                    if (options.length > 10) {
                        $(this).select2();
                    } else {
                        $(this).select2({
                            minimumResultsForSearch: -1
                        });
                    }
                }
            });
            count++;
        } while ($(modalName).find('.modal-body #timesheet-table tbody tr').length < rowCount)
    } else {
        $(modalName).find('.modal-body table tbody tr').each(function(index, value) {
            var table = $(this).parent().parent().attr('id');
            var count = $(this).find('td:nth-child(2)').html();

            if (index < rowCount) {
                if (table !== 'category-details-table' && table !== 'item-details-table' && table !== 'timesheet-table') {
                    $(this).html(blankRow);
                } else {
                    if (table === 'category-details-table') {
                        $(this).html(catDetailsBlank);
                    }
                }
                $(this).find('td:nth-child(2)').html(count);
            }

            if (index >= rowCount) {
                $(this).remove();
            }
        });
    }
}

const printPurchaseOrder = () => {
    var id = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/purchase-order/', '');

    $.get(`/accounting/print-purchase-order-modal/${id}`, function(result) {
        $('div#modal-container').append(result);

        $('#viewPrintPurchaseOrderModal').modal('show');
    });
}

const sendPurchaseOrder = (purchaseOrderId) => {
    $.get(`/accounting/send-purchase-order-email-modal/${purchaseOrderId}`, function(result) {
        $('div#modal-container').append(result);

        $('#sendEmailModal').modal('show');
    });
}

const findCustByInvoiceNo = () => {
    var invoiceNo = $('#receivePaymentModal #invoice-no').val();
    var data = new FormData();
    data.set('invoice_no', invoiceNo);

    $.ajax({
        url: '/accounting/find-customer-by-invoice-no',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            var res = JSON.parse(result);

            if(res.success) {
                $('#receivePaymentModal #customer').append(`<option value="${res.customer_id}" selected>${res.customer_name}</option>`).trigger('change');
            } else {
                $('#receivePaymentModal #invoice-no').addClass('border-danger');
            }
        }
    });
}

const cancelFindByInvoice = () => {
    $('#receivePaymentModal #invoice-no').val('');

    $("body").trigger("click");
}

const applyInvoicesFilter = (e) => {
    e.preventDefault();

    $('#receivePaymentModal #invoices-table').DataTable().ajax.reload(null, true);
}

const resetInvoicesFilter = (e) => {
    e.preventDefault();

    var href = $('#modal-container #modal-form').attr('data-href');
    if(href === false || typeof href === 'undefined') {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = mm + '/' + dd + '/' + yyyy;

        $('#receivePaymentModal #invoices-from').val(today);
        $('#receivePaymentModal #invoices-to').val(today);
        $('#receivePaymentModal #overdue_invoices_only').prop('checked', false);

        var customerId = $('#receivePaymentModal #customer').val();
        loadCustomerInvoices(customerId);
    } else {
        var split = href.split('/');
        var data = {
            id: split[split.length - 1]
        };
        loadPaymentInvoices(data);
    }
}

const applyCreditMemoFilter = (e) => {
    e.preventDefault();

    $('#receivePaymentModal #credit-memo-table').DataTable().ajax.reload(null, true);
}

const resetCreditMemoFilter = (e) => {
    e.preventDefault();

    var href = $('#modal-container #modal-form').attr('data-href');
    if(href === false || typeof href === 'undefined') {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = mm + '/' + dd + '/' + yyyy;

        $('#receivePaymentModal #credit-memo-from').val(today);
        $('#receivePaymentModal #credit-memo-to').val(today);
        $('#receivePaymentModal #overdue_credit_memo_only').prop('checked', false);

        var customerId = $('#receivePaymentModal #customer').val();
        loadCustomerCredits(customerId);
    } else {
        var split = href.split('/');
        var data = {
            id: split[split.length - 1]
        };
        loadPaymentCredits(data);
    }
}

const loadCustomerInvoices = (id) => {
    if($.fn.DataTable.isDataTable(`#receivePaymentModal #invoices-table`)) {
        $('#receivePaymentModal #invoices-table').DataTable().clear();
        $('#receivePaymentModal #invoices-table').DataTable().destroy();
    }

    $('#receivePaymentModal #invoices-table').DataTable({
        autoWidth: false,
        searching: false,
        processing: true,
        serverSide: true,
        lengthChange: false,
        ordering: false,
        info: false,
        ajax: {
            url: `/accounting/load-customer-invoices/${id}`,
            dataType: 'json',
            contentType: 'application/json',
            type: 'POST',
            data: function(d) {
                d.columns[0].search.value = $('#receivePaymentModal #search-invoice-no').val();
                d.from_date = $('#receivePaymentModal #invoices-from').val();
                d.to_date = $('#receivePaymentModal #invoices-to').val();
                d.overdue = $('#receivePaymentModal #overdue_invoices_only').prop('checked') ? 1 : 0;
                d.length = $('#receivePaymentModal #invoices_table_rows').val()
                return JSON.stringify(d);
            },
            pagingType: 'full_numbers',
        },
        columns: [
            {
                data: null,
                name: 'checkbox',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(`<div class="d-flex justify-content-center">
                        <div class="checkbox checkbox-sec m-0">
                            <input type="checkbox" id="invoice-${rowData.id}" value="${rowData.id}">
                            <label for="invoice-${rowData.id}" class="p-0" style="width: 24px; height: 24px"></label>
                        </div>
                    </div>`);
                }
            },
            {
                data: 'description',
                name: 'description',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(cellData);
                }
            },
            {
                data: 'due_date',
                name: 'due_date',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(cellData);
                }
            },
            {
                data: 'original_amount',
                name: 'original_amount',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(cellData);
                }
            },
            {
                data: 'open_balance',
                name: 'open_balance',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(cellData);
                }
            },
            {
                data: null,
                name: 'payment',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(`<input type="number" onchange="convertToDecimal(this)" step=".01" class="form-control text-right" name="payment[]">`);
                }
            }
        ]
    });
}

const loadCustomerCredits = (id) => {
    if($.fn.DataTable.isDataTable(`#receivePaymentModal #credit-memo-table`)) {
        $('#receivePaymentModal #credit-memo-table').DataTable().clear();
        $('#receivePaymentModal #credit-memo-table').DataTable().destroy();
    }

    $('#receivePaymentModal #credit-memo-table').DataTable({
        autoWidth: false,
        searching: false,
        processing: true,
        serverSide: true,
        lengthChange: false,
        ordering: false,
        info: false,
        ajax: {
            url: `/accounting/load-customer-credits/${id}`,
            dataType: 'json',
            contentType: 'application/json',
            type: 'POST',
            data: function(d) {
                d.columns[0].search.value = $('#receivePaymentModal #search-credit-memo-no').val();
                d.from_date = $('#receivePaymentModal #credit-memo-from').val();
                d.to_date = $('#receivePaymentModal #credit-memo-to').val();
                d.length = $('#receivePaymentModal #credit_memo_table_rows').val()
                return JSON.stringify(d);
            },
            pagingType: 'full_numbers',
        },
        columns: [
            {
                data: null,
                name: 'checkbox',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    if($('#receivePaymentModal #invoices-table tbody tr input[type="checkbox"]:checked').length > 0) {
                        $(td).html(`<div class="d-flex justify-content-center">
                            <div class="checkbox checkbox-sec m-0">
                                <input type="checkbox" id="${rowData.type}-${rowData.id}" value="${rowData.type}_${rowData.id}">
                                <label for="${rowData.type}-${rowData.id}" class="p-0" style="width: 24px; height: 24px"></label>
                            </div>
                        </div>`);
                    } else {
                        $(td).html('');
                    }
                }
            },
            {
                data: 'description',
                name: 'description',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(cellData);
                }
            },
            {
                data: 'original_amount',
                name: 'original_amount',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(cellData);
                }
            },
            {
                data: 'open_balance',
                name: 'open_balance',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(cellData);
                }
            },
            {
                data: null,
                name: 'payment',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(`<input type="number" onchange="convertToDecimal(this)" step=".01" class="form-control text-right" name="credit_payment[]">`);
                }
            }
        ]
    });
}

const loadPaymentInvoices = (data) => {
    if($.fn.DataTable.isDataTable(`#receivePaymentModal #invoices-table`)) {
        $('#receivePaymentModal #invoices-table').DataTable().clear();
        $('#receivePaymentModal #invoices-table').DataTable().destroy();
    }
    $('#receivePaymentModal #invoices-table').DataTable({
        autoWidth: false,
        searching: false,
        processing: true,
        serverSide: true,
        lengthChange: false,
        ordering: false,
        info: false,
        ajax: {
            url: `/accounting/load-payment-invoices/${data.id}`,
            dataType: 'json',
            contentType: 'application/json',
            type: 'POST',
            data: function(d) {
                d.columns[0].search.value = $('#receivePaymentModal #search-invoice-no').val();
                d.from_date = $('#receivePaymentModal #invoices-from').val();
                d.to_date = $('#receivePaymentModal #invoices-to').val();
                d.overdue = $('#receivePaymentModal #overdue_invoices_only').prop('checked') ? 1 : 0;
                d.length = $('#receivePaymentModal #invoices_table_rows').val()
                return JSON.stringify(d);
            },
            pagingType: 'full_numbers',
        },
        columns: [
            {
                data: null,
                name: 'checkbox',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    if(rowData.checked) {
                        $(td).html(`<div class="d-flex justify-content-center">
                            <div class="checkbox checkbox-sec m-0">
                                <input type="checkbox" id="invoice-${rowData.id}" value="${rowData.id}" checked>
                                <label for="invoice-${rowData.id}" class="p-0" style="width: 24px; height: 24px"></label>
                            </div>
                        </div>`);
                    } else {
                        $(td).html(`<div class="d-flex justify-content-center">
                            <div class="checkbox checkbox-sec m-0">
                                <input type="checkbox" id="invoice-${rowData.id}" value="${rowData.id}">
                                <label for="invoice-${rowData.id}" class="p-0" style="width: 24px; height: 24px"></label>
                            </div>
                        </div>`);
                    }
                }
            },
            {
                data: 'description',
                name: 'description',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(cellData);
                }
            },
            {
                data: 'due_date',
                name: 'due_date',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(cellData);
                }
            },
            {
                data: 'original_amount',
                name: 'original_amount',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(cellData);
                }
            },
            {
                data: 'open_balance',
                name: 'open_balance',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(cellData);
                }
            },
            {
                data: null,
                name: 'payment',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    if(rowData.checked) {
                        $(td).html(`<input type="number" onchange="convertToDecimal(this)" step=".01" class="form-control text-right" name="payment[]" value="${rowData.payment_amount}">`);
                    } else {
                        $(td).html(`<input type="number" onchange="convertToDecimal(this)" step=".01" class="form-control text-right" name="payment[]">`);
                    }
                }
            }
        ]
    });
}

const loadPaymentCredits = (data) => {
    if($.fn.DataTable.isDataTable(`#receivePaymentModal #credit-memo-table`)) {
        $('#receivePaymentModal #credit-memo-table').DataTable().clear();
        $('#receivePaymentModal #credit-memo-table').DataTable().destroy();
    }
    $('#receivePaymentModal #credit-memo-table').DataTable({
        autoWidth: false,
        searching: false,
        processing: true,
        serverSide: true,
        lengthChange: false,
        ordering: false,
        info: false,
        ajax: {
            url: `/accounting/load-payment-credits/${data.id}`,
            dataType: 'json',
            contentType: 'application/json',
            type: 'POST',
            data: function(d) {
                d.columns[0].search.value = $('#receivePaymentModal #search-credit-memo-no').val();
                d.from_date = $('#receivePaymentModal #credit-memo-from').val();
                d.to_date = $('#receivePaymentModal #credit-memo-to').val();
                d.length = $('#receivePaymentModal #credit_memo_table_rows').val()
                return JSON.stringify(d);
            },
            pagingType: 'full_numbers',
        },
        columns: [
            {
                data: null,
                name: 'checkbox',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    if(rowData.checked) {
                        $(td).html(`<div class="d-flex justify-content-center">
                            <div class="checkbox checkbox-sec m-0">
                                <input type="checkbox" id="${rowData.type}-${rowData.id}" value="${rowData.type}_${rowData.id}" checked>
                                <label for="${rowData.type}-${rowData.id}" class="p-0" style="width: 24px; height: 24px"></label>
                            </div>
                        </div>`);
                    } else {
                        $(td).html(`<div class="d-flex justify-content-center">
                            <div class="checkbox checkbox-sec m-0">
                                <input type="checkbox" id="${rowData.type}-${rowData.id}" value="${rowData.type}_${rowData.id}">
                                <label for="${rowData.type}-${rowData.id}" class="p-0" style="width: 24px; height: 24px"></label>
                            </div>
                        </div>`);
                    }
                }
            },
            {
                data: 'description',
                name: 'description',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(cellData);
                }
            },
            {
                data: 'original_amount',
                name: 'original_amount',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(cellData);
                }
            },
            {
                data: 'open_balance',
                name: 'open_balance',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).html(cellData);
                }
            },
            {
                data: null,
                name: 'payment',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    if(rowData.checked) {
                        $(td).html(`<input type="number" onchange="convertToDecimal(this)" step=".01" class="form-control text-right" name="credit_payment[]" value="${rowData.payment_amount}">`);
                    } else {
                        $(td).html(`<input type="number" onchange="convertToDecimal(this)" step=".01" class="form-control text-right" name="credit_payment[]">`);
                    }
                }
            }
        ]
    });
}

const printPreviewInvoice = () => {
    var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

    $.get('/accounting/print-invoice-modal/'+split[1], function(result) {
        $('div#modal-container').append(result);

        $('#viewPrintInvoiceModal').modal('show');
    });
}

const printPreviewCreditMemo = () => {
    var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

    $.get('/accounting/print-credit-memo-modal/'+split[1], function(result) {
        $('div#modal-container').append(result);

        $('#viewPrintCreditMemoModal').modal('show');
    });
}

const printPreviewSalesReceipt = () => {
    var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

    $.get('/accounting/print-sales-receipt-modal/'+split[1], function(result) {
        $('div#modal-container').append(result);

        $('#viewPrintSalesReceiptModal').modal('show');
    });
}

const printPreviewRefundReceipt = () => {
    var split = $('#modal-container form#modal-form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

    $.get('/accounting/print-refund-receipt-modal/'+split[1], function(result) {
        $('div#modal-container').append(result);

        $('#viewPrintRefundReceiptModal').modal('show');
    });
}