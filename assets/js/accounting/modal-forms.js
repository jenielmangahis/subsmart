const GET_OTHER_MODAL_URL = "/accounting/get-other-modals/";
const vendorModals = ['#expenseModal', '#checkModal', '#billModal', '#vendorCreditModal', '#purchaseOrderModal', '#creditCardCreditModal'];
const customerModals = ['#invoiceModal', '#creditMemoModal', '#salesReceiptModal', '#refundReceiptModal', '#delayedCreditModal', '#delayedChargeModal', '#standard-estimate-modal', '#options-estimate-modal', '#bundle-estimate-modal'];
var rowCount = 0;
var rowInputs = '';
var blankRow = '';
var modalName = '';
var tagsListModal = '';
var timesheetInputs = 'input.day-input';
var payrollForm = '';
var payrollFormData = new FormData();
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

var startDate = null;
var endDate = null;

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
    'markup-account',
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

var targetItemTable = null;

$(function () {
    $(document).on('change', '#adjust-starting-value-modal #location', function () {
        var selected = $(this).children('option:selected');
        var initial_qty = selected[0].dataset.initial_qty;

        $('#adjust-starting-value-modal #initialQty').val(initial_qty);

        computeTotalValue();
    });

    $(document).on('change', '#adjust-starting-value-modal #initialQty, #adjust-starting-value-modal #initialCost', function () {
        computeTotalValue();
    });

    $(document).on('change', '#adjust-starting-value-modal #refNo', function () {
        var value = $(this).val();

        if (value !== "") {
            $('#adjust-starting-value-modal .modal-title span').html('#' + value);
        } else {
            $('#adjust-starting-value-modal .modal-title span').html('');
        }
    });

    $(document).on('keyup', timesheetInputs + ', div#singleTimeModal input#time, div#singleTimeModal input#break', function (e) {
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

    $(document).on('change', timesheetInputs + ', div#singleTimeModal input#time, div#singleTimeModal input#break', function (e) {
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

        if ($(this).attr('id') !== 'time' && $(this).attr('id') !== 'break') {
            computeTotalHours();
            computeTotalBill();
        }
    });

    $(document).on('change', '#payDownCreditModal input#amount', function () {
        var amount = $(this).val();

        if (amount !== "") {
            $('#payDownCreditModal #total-amount-paid').html(`$${amount}`);
        } else {
            $('#payDownCreditModal #total-amount-paid').html('$0.00');
        }
    });

    // $(document).on('change', '#payrollModal table#payroll-table tbody tr td:nth-child(4) input[name="reg_pay_hours[]"], #payrollModal table#payroll-table tbody tr td:nth-child(5) input:not([name="memo[]"])', function() {
    //     payrollRowTotal($(this));
    //     payrollTotal();
    // });

    $(document).on('click', 'div#payrollModal div.modal-footer button#continue-payroll', function () {
        payroll.paySchedule = $('#payrollModal [name="pay_schedule"]:checked').val();
        payroll.paySchedForm = $('div#payrollModal div.modal-body').html();
        var paySchedName = $('#payrollModal [name="pay_schedule"]:checked').next().find('.pay_sched_name').html();
        if (payroll.paySchedule !== "" && payroll.paySchedule !== undefined) {
            $.get('/accounting/get-payroll-form/' + payroll.paySchedule, function (res) {
                $('div#payrollModal .modal-body').html(res);

                $('div#payrollModal .modal-header .modal-title').html('Run Payroll: ' + paySchedName);
                $('div#payrollModal .modal-body select:not(#bank-account)').select2({
                    minimumResultsForSearch: -1,
                    dropdownParent: $('#payrollModal')
                });
                $('div#payrollModal .modal-body select#bank-account').select2({
                    ajax: {
                        url: base_url + 'accounting/get-dropdown-choices',
                        dataType: 'json',
                        data: function (params) {
                            var query = {
                                search: params.term,
                                type: 'public',
                                field: 'bank-account',
                                modal: 'payrollModal'
                            }

                            // Query parameters will be ?search=[term]&type=public&field=[type]
                            return query;
                        }
                    },
                    templateResult: formatResult,
                    templateSelection: optionSelect,
                    dropdownParent: $('#payrollModal')
                });
                $('div#payrollModal .modal-body #payDate, #payrollModal #pay-period-start, #payrollModal #pay-period-end').datepicker({
                    format: 'mm/dd/yyyy',
                    orientation: 'bottom',
                    autoclose: true
                });

                payrollTotal();
            });
            $(this).parent().prepend(`<button class="nsm-button success float-end" type="button" id="preview-payroll">
                Preview Payroll
            </button>`);
            $(this).remove();
            $('div#payrollModal div.modal-footer button#close-payroll-modal').parent().html('<button type="button" class="nsm-button primary" id="back-paysched-select">Back</button>');
        }
    });

    $(document).on('click', 'div#payrollModal div.modal-footer button#back-paysched-select', function () {
        $('div#payrollModal div.modal-body').html(payroll.paySchedForm);
        $(`div#payrollModal div.modal-body input[name="pay_schedule"][value="${payroll.paySchedule}"]`).prop('checked', true);
        $(this).parent().html(`<button type="button" class="nsm-button primary" data-bs-dismiss="modal" id="close-payroll-modal">Cancel</button>`);
        $('div#payrollModal div.modal-footer div.col-md-4:last-child').html(`
        <button class="nsm-button success float-end" type="button" id="continue-payroll">
            Continue
        </button>`);
    });

    $(document).on('change', 'div#payrollModal select#payPeriod', function (e) {
        var selected = $(this).find('option:selected');
        var payDate = selected[0].dataset.pay_date;

        $('div#payrollModal input#payDate').val(payDate);
        $('#payrollModal #payroll-table tbody tr .select-one:checked').each(function () {
            $(this).trigger('change');
        });
    });

    $(document).on('change', '#payrollModal #pay-period-start, #payrollModal #pay-period-end', function (e) {
        $('#payrollModal #payroll-table tbody .select-one:checked').each(function () {
            $(this).trigger('change');
        });
    });

    $(document).on('click', 'div#payrollModal div.modal-footer button#preview-payroll', function () {
        Swal.fire({
            title: 'Are you sure you want to proceed?',
            icon: 'question',
            showCloseButton: false,
            confirmButtonColor: '#2ca01c',
            confirmButtonText: 'Yes',
            showCancelButton: true,
            cancelButtonText: 'No',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                payrollForm = $('div#payrollModal div.modal-body').html();
                // payrollFormData = new FormData();
                // payrollFormData = new FormData(document.getElementById($('div#payrollModal').parent('form').attr('id')));

                payrollFormData.delete('payscale');
                payrollFormData.delete('pay_from_account');
                payrollFormData.delete('pay_period');
                payrollFormData.delete('pay_date');
                payrollFormData.delete('employees[]');
                payrollFormData.delete('reg_pay_hours[]');
                payrollFormData.delete('commission[]');
                payrollFormData.delete('memo[]');

                if ($('#payrollModal #payPeriod').length > 0) {
                    var payPeriod = $('#payrollModal #payPeriod').val();
                } else {
                    var payPeriod = $('#payrollModal #pay-period-start').val() + '-' + $('#payrollModal #pay-period-end').val()
                }

                payrollFormData.set('pay_from_account', $('#bank-account').val());
                payrollFormData.set('pay_period', payPeriod);
                payrollFormData.set('pay_date', $('#payrollModal #payDate').val());

                $('#payrollModal #payroll-table tbody tr .select-one:checked').each(function () {
                    var row = $(this).closest('tr');
                    payrollFormData.append('employees[]', $(this).val());
                    payrollFormData.append('reg_pay_hours[]', row.find('td:nth-child(4)').html());
                    payrollFormData.append('commission[]', row.find('td:nth-child(5)').html().replace('$', ''));
                    payrollFormData.append('memo[]', row.find('[name="memo[]"]').val());
                });

                $.ajax({
                    url: '/accounting/generate-payroll',
                    data: payrollFormData,
                    type: 'post',
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        $('div#payrollModal div.modal-body').html(res);

                        var chartHeight = $('div#payrollModal div.modal-body #payrollChart').parent().prev().height();
                        var chartWidth = $('div#payrollModal div.modal-body #payrollChart').parent().width();

                        $('div#payrollModal #payrollChart').height(chartHeight);
                        $('div#payrollModal #payrollChart').width(chartWidth);

                        var totalNetPay = parseFloat($('div#payrollModal div.modal-body span#total-net-pay').html().replace('$', '').replace(',', '')).toFixed(2);
                        var employeeTax = parseFloat($('div#payrollModal div.modal-body span#total-employee-tax').html().replace('$', '').replace(',', '')).toFixed(2);
                        var employerTax = parseFloat($('div#payrollModal div.modal-body span#total-employer-tax').html().replace('$', '').replace(',', '')).toFixed(2);

                        new Chart('payrollChart', {
                            type: 'doughnut',
                            data: {
                                labels: ['Net Pay', 'Employee', 'Employer'],
                                datasets: [{
                                    label: 'Payroll',
                                    data: [totalNetPay, employeeTax, employerTax],
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(54, 162, 235, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(54, 162, 235, 1)',
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                    },
                                },
                                aspectRatio: 1.5,
                            }
                        });
                    }
                });

                $(this).parent().prepend('<button type="submit" class="nsm-button success float-end">Submit Payroll</button>');
                $(this).remove();
                $('div#payrollModal div.modal-footer button#back-payscale-select').parent().html('<button type="button" class="nsm-button primary" id="back-payroll-form">Back</button>');
            }
        });
    });

    $(document).on('click', 'div#payrollModal div.modal-footer button#back-payroll-form', function () {
        $('div#payrollModal div.modal-body').html(payrollForm);

        $('div#payrollModal div.modal-body select#payFrom').val(payrollFormData.get('pay_from'));
        if ($('#payrollModal #payPeriod').length > 0) {
            $('div#payrollModal div.modal-body select#payPeriod').val(payrollFormData.get('pay_period'));
        } else {
            var payPeriod = payrollFormData.get('pay_period').split('-');
            var start = payPeriod[0];
            var end = payPeriod[1];
            $('#payrollModal #pay-period-start').val(start);
            $('#payrollModal #pay-period-end').val(end);
        }
        $('div#payrollModal div.modal-body input#payDate').val(payrollFormData.get('pay_date'));

        $('div#payrollModal div.modal-body table tbody tr td:nth-child(4)').each(function (index, value) {
            $(this).html(payrollFormData.getAll('reg_pay_hours[]')[index]);
        });

        $('div#payrollModal div.modal-body table tbody tr td:nth-child(5)').each(function (index, value) {
            $(this).html(payrollFormData.getAll('commission[]')[index]);
        });

        $('div#payrollModal div.modal-body table tbody tr td:nth-child(6) input[name="memo[]"]').each(function (index, value) {
            $(this).val(payrollFormData.getAll('memo[]')[index]);
        });

        $(this).parent().html('<button type="button" class="nsm-button primary" data-dismiss="modal" id="back-payscale-select">Back</button>');
        $('div#payrollModal div.modal-footer button[type="submit"]').html('Preview Payroll');
        $('div#payrollModal div.modal-footer button[type="submit"]').attr('id', 'preview-payroll');
        $('div#payrollModal div.modal-footer button[type="submit"]').prop('type', 'button');
    });

    $(document).on('change', 'div#payrollModal #payroll-table input.select-all', function () {
        var table = $(this).closest('table');
        var rows = table.children('tbody').children('tr');

        if ($(this).prop('checked')) {
            rows.each(function () {
                $(this).find('input.select-one').prop('checked', true).trigger('change');
            });
        } else {
            rows.each(function () {
                $(this).find('input.select-one').prop('checked', false);

                $(this).children('td').each(function (index, value) {
                    if (index > 1) {
                        $(this).html('');
                    }
                });
            });

            payrollTotal();
        }
    });

    $(document).on('change', 'div#payrollModal table tbody tr td:first-child() input', function () {
        var table = $(this).parent().parent().parent().parent().parent();
        var checkbox = table.find('input.select-all');
        var rows = table.children('tbody').children('tr');
        var flag = true;
        var empID = $(this).val();
        var row = $(this).closest('tr');

        if ($(this).prop('checked') === false) {
            $(this).parent().parent().parent().children('td').each(function (index, value) {
                if (index > 1) {
                    $(this).html('');
                }
            });

            payrollTotal();
        } else {
            var data = new FormData();

            if ($('#payrollModal #payPeriod').length > 0) {
                var payPeriod = $('#payrollModal #payPeriod').val();
            } else {
                var payPeriod = $('#payrollModal #pay-period-start').val() + '-' + $('#payrollModal #pay-period-end').val()
            }
            data.set('employee_id', empID);
            data.set('pay_period', payPeriod);

            $.ajax({
                url: '/accounting/get-employee-pay-details',
                data: data,
                type: 'post',
                processData: false,
                contentType: false,
                success: function (result) {
                    var res = JSON.parse(result);
                    row.children('td').each(function (index, value) {
                        switch (index) {
                            case 2:
                                $(this).html(res.pay_details !== null && res.pay_details.pay_method === 'direct-deposit' ? 'Direct deposit' : 'Paper check');
                                break;
                            case 3:
                                $(this).html(parseFloat(res.total_hrs).toFixed(2));
                                break;
                            case 4:
                                $(this).html(res.commission !== null ? formatter.format(parseFloat(res.commission)) : formatter.format(parseFloat(0.00)));
                                break;
                            case 5:
                                $(this).html(`<input type="text" name="memo[]" class="form-control nsm-field">`);
                                break;
                            case 6:
                                $(this).html(`<p class="m-0 text-end">${parseFloat(res.total_hrs).toFixed(2)}</p>`);
                                break;
                            case 7:
                                $(this).html(`<p class="m-0 text-end">${formatter.format(parseFloat(res.per_hour_pay))}</p>`);
                                break;
                            case 8:
                                $(this).html(`<p class="m-0 text-end">${formatter.format(parseFloat(res.regular_hrs_pay_total))}</p>`);
                                break;
                            case 9:
                                $(this).html(`<p class="m-0 text-end"><span class="total-pay">${formatter.format(parseFloat(res.total_pay))}</span></p>`);
                                break;
                        }
                    });

                    payrollTotal();
                }
            });
        }

        rows.each(function () {
            if ($(this).children('td:first-child()').children('div').children('input').prop('checked') === false) {
                flag = false;
            }
        });

        checkbox.prop('checked', flag);
    });

    // $(document).on('click', '#new-popup ul li a.ajax-modal', function(e) {
    //     e.preventDefault();
    //     var target = e.currentTarget.dataset;
    //     var view = target.view
    //     var modal_element = target.target;
    //     modalName = target.target;

    //     $.get(GET_OTHER_MODAL_URL + view, function(res) {
    //         if ($('div#modal-container').length > 0) {
    //             $('div#modal-container').html(res);
    //         } else {
    //             $('body').append(`
    //                 <div id="modal-container"> 
    //                     ${res}
    //                 </div>
    //             `);
    //         }

    //         $(`${modal_element} [data-toggle="popover"]`).popover();

    //         if ($('div#modal-container .modal-body table:not(#category-details-table, #item-details-table)').length > 0) {
    //             rowInputs = $('div#modal-container table tbody tr:first-child()').html();
    //             if(modal_element === '#journalEntryModal' || modal_element === '#depositModal') {
    //                 blankRow = $('div#modal-container table tbody tr:last-child()').html();

    //                 $('div#modal-container table.clickable tbody tr:first-child()').remove();
    //                 $('div#modal-container table tbody tr:last-child()').remove();
    //             } else {
    //                 blankRow = $('div#modal-container table tbody tr:nth-child(2)').html();
    //             }

    //             rowCount = $('div#modal-container table tbody tr').length;

    //             $('div#modal-container table.clickable tbody tr:first-child()').html(blankRow);
    //             $('div#modal-container table.clickable tbody tr:first-child() td:nth-child(2)').html(1);
    //         }

    //         if (vendorModals.includes(modal_element)) {
    //             rowCount = 2;
    //             catDetailsInputs = $(`${modal_element} .modal-body table#category-details-table tbody tr:first-child()`).html();
    //             catDetailsBlank = $(`${modal_element} .modal-body table#category-details-table tbody tr:last-child()`).html();

    //             $(`${modal_element} .modal-body table#category-details-table tbody tr:first-child()`).remove();
    //             $(`${modal_element} .modal-body table#category-details-table tbody tr:last-child()`).remove();
    //         }

    //         if (modal_element === '#printChecksModal') {
    //             loadChecksTable();
    //         }

    //         $(`${modal_element} select`).each(function() {
    //             var type = $(this).attr('id');
    //             if (type === undefined) {
    //                 type = $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-');
    //             } else {
    //                 type = type.replaceAll('_', '-');

    //                 if (type.includes('transfer')) {
    //                     type = 'transfer-account';
    //                 }
    //             }

    //             if (dropdownFields.includes(type)) {
    //                 $(this).select2({
    //                     ajax: {
    //                         url: '/accounting/get-dropdown-choices',
    //                         dataType: 'json',
    //                         data: function(params) {
    //                             var query = {
    //                                 search: params.term,
    //                                 type: 'public',
    //                                 field: type,
    //                                 modal: modal_element.replaceAll('#', '')
    //                             }

    //                             // Query parameters will be ?search=[term]&type=public&field=[type]
    //                             return query;
    //                         }
    //                     },
    //                     templateResult: formatResult,
    //                     templateSelection: optionSelect
    //                 });
    //             } else {
    //                 var options = $(this).find('option');
    //                 if (options.length > 10) {
    //                     $(this).select2();
    //                 } else {
    //                     $(this).select2({
    //                         minimumResultsForSearch: -1
    //                     });
    //                 }
    //             }
    //         });

    //         if ($('div#modal-container select#tags').length > 0) {
    //             $('div#modal-container select#tags').select2({
    //                 placeholder: 'Start typing to add a tag',
    //                 allowClear: true,
    //                 ajax: {
    //                     url: '/accounting/get-job-tags',
    //                     dataType: 'json'
    //                 }
    //             });
    //         }
    //         if (view === "weekly_timesheet_modal") {
    //             tableWeekDate(document.getElementById('weekDates'));
    //         }

    //         if ($(`${modal_element} .date`).length > 0) {
    //             $(`${modal_element} .date`).each(function() {
    //                 $(this).datepicker({
    //                     uiLibrary: 'bootstrap'
    //                 });
    //             });
    //         }

    //         if ($(`${modal_element} .attachments`).length > 0) {
    //             var attachmentContId = $(`${modal_element} .attachments .dropzone`).attr('id');
    //             modalAttachments = new Dropzone(`#${attachmentContId}`, {
    //                 url: '/accounting/attachments/attach',
    //                 maxFilesize: 20,
    //                 uploadMultiple: true,
    //                 // maxFiles: 1,
    //                 addRemoveLinks: true,
    //                 init: function() {
    //                     this.on("success", function(file, response) {
    //                         var ids = JSON.parse(response)['attachment_ids'];
    //                         var modal = $(`${modal_element}`);

    //                         for (i in ids) {
    //                             if (modal.find(`input[name="attachments[]"][value="${ids[i]}"]`).length === 0) {
    //                                 modal.find('.attachments').parent().append(`<input type="hidden" name="attachments[]" value="${ids[i]}">`);
    //                             }

    //                             modalAttachmentId.push(ids[i]);
    //                         }
    //                         modalAttachedFiles.push(file);
    //                     });
    //                 },
    //                 removedfile: function(file) {
    //                     var ids = modalAttachmentId;
    //                     var index = modalAttachedFiles.map(function(d, index) {
    //                         if (d == file) return index;
    //                     }).filter(isFinite)[0];

    //                     $(`${modal_element} .attachments`).parent().find(`input[name="attachments[]"][value="${ids[index]}"]`).remove();

    //                     if($('#modal-container form .modal .attachments-container').length > 0) {
    //                         $('#modal-container form .modal .attachments-container #attachment-types').trigger('change');
    //                     }

    //                     //remove thumbnail
    //                     var previewElement;
    //                     return (previewElement = file.previewElement) !== null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
    //                 }
    //             });
    //         }

    //         if ($(`${modal_element} .dropdown`).length > 0) {
    //             $(`${modal_element} .dropdown-menu`).on('click', function(e) {
    //                 e.stopPropagation();
    //             });
    //         }

    //         if (modal_element === '#payBillsModal') {
    //             loadBills();
    //         }

    //         // if(modal_element === '#receivePaymentModal') {

    //         // }

    //         $(modal_element).modal('show');
    //         $(document).off('shown', modal_element);
    //     });
    // });

    $(document).on('hide.bs.modal', '#tags-modal', function (e) {
        if ($('div#modal-container').next('.modal-backdrop').length > 0 ||
            $('div#modal-container').next().next('.modal-backdrop').length > 0
        ) {
            $('div#modal-container').next('.modal-backdrop').remove();
            $('div#modal-container').next().next('.modal-backdrop').remove();
        }
    });

    $(document).on('change', 'div#billPaymentModal select[name="payment_account"]', function () {
        var value = $(this).val();

        $.get('/accounting/get-account-balance/' + value, function (res) {
            var result = JSON.parse(res);

            $('div#billPaymentModal span#account-balance').html(result.balance);
        });
    });

    $(document).on('change', 'div#depositModal select#bank_deposit_account', function () {
        var value = $(this).val();

        $.get('/accounting/get-account-balance/' + value, function (res) {
            var result = JSON.parse(res);

            $('div#depositModal span#account-balance').html(result.balance);
        });
    });

    $(document).on('change', 'div#transferModal #transfer_from_account, div#transferModal #transfer_to_account', function () {
        var el = $(this);
        var value = el.val();

        if (value !== '' && value !== null && value !== 'add-new') {
            $.get('/accounting/get-account-balance/' + value, function (res) {
                var result = JSON.parse(res);

                el.parent().next().find('h3').html(result.balance);
            });
        } else {
            el.parent().next().find('h3').html('');
        }
    });

    $(document).on('change', 'div#payrollModal select#bank-account', function () {
        var value = $(this).val();
        var el = $(this);

        $.get('/accounting/get-account-balance/' + value, function (res) {
            var result = JSON.parse(res);

            el.parent().next().children('h6').html('Balance ' + result.balance);
        });
    });

    $(document).on('click', '#payrollModal #add-employee-button', function (e) {
        e.preventDefault();

        $.get('/accounting/get-employee-modal', function (res) {
            if ($('#modal-container #employee-modal').length > 0) {
                $('#modal-container #employee-modal').remove();
            }

            if ($('div#modal-container').next('.modal-backdrop').length > 0 ||
                $('div#modal-container').next().next('.modal-backdrop').length > 0
            ) {
                $('div#modal-container').next('.modal-backdrop').remove();
                $('div#modal-container').next().next('.modal-backdrop').remove();
            }

            $('div#modal-container').append(res);

            $('#modal-container #employee-modal [name="empPayscale"]').val(payroll.payscale).trigger('change');

            $('#modal-container #employee-modal select').select2({
                minimumResultsForSearch: -1,
                dropdownParent: $('#modal-container #employee-modal')
            });

            $('#modal-container #employee-modal .date').datepicker({
                format: 'mm/dd/yyyy',
                orientation: 'bottom',
                autoclose: true
            });

            $('#modal-container #employee-modal').modal('show');
        });
    });

    $(document).on("click", "#modal-container #employee-modal .password-field", function (e) {
        let _this = $(this);
        let _container = _this.closest(".nsm-field-group");
        let shown = _container.hasClass("show");

        if (e.offsetX > 345) {
            if (shown) {
                _container.removeClass("show").addClass("hide");
                _this.attr("type", "text");
            } else {
                _container.removeClass("hide").addClass("show");
                _this.attr("type", "password");
            }
        }
    });

    $(document).on("submit", "#modal-container #employee-modal #add_employee_form", function (e) {
        let _this = $(this);
        e.preventDefault();

        var url = base_url + "accounting/employees/create";
        _this.find("button[type=submit]").html("Saving");
        _this.find("button[type=submit]").prop("disabled", true);

        $.ajax({
            type: 'POST',
            url: url,
            data: _this.serialize(),
            dataType: "json",
            success: function (res) {
                // var res = JSON.parse(result);

                Swal.fire({
                    title: res.title,
                    text: res.message,
                    icon: res.success ? 'success' : 'error',
                    showCancelButton: false,
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.value) {
                        if (res.success) {
                            if (payroll.payscale === $('#employee-modal #add_employee_form select[name="empPayscale"]').val()) {
                                addEmployeeToPayroll($('#modal-container #employee-modal #employee_email').val());
                            }

                            $("#modal-container #employee-modal").modal('hide');
                            // _this.trigger("reset");
                        }

                        _this.find("button[type=submit]").html("Save");
                        _this.find("button[type=submit]").prop("disabled", false);
                    }
                });
            },
        });
    });

    $(document).on('change', '#modal-container #employee-modal .add-emp-payscale', function () {
        var psid = $(this).val();
        var url = base_url + 'payscale/_get_details'
        $.ajax({
            type: 'POST',
            url: url,
            data: { psid: psid },
            dataType: "json",
            success: function (result) {
                if (result.pay_type == 'Commission Only') {
                    $('#modal-container #employee-modal .add-pay-type-container').hide();
                } else {
                    var rate_label = result.pay_type + ' Rate';
                    $('#modal-container #employee-modal .add-pay-type-container').show();
                    $('#modal-container #employee-modal .add-payscale-pay-type').html(rate_label);
                }
            },
        });
    });

    $(document).on('click', '#modal-container #employee-modal .btn-add-new-commision', function (e) {
        let url = base_url + "user/_add_commission_form";
        $.ajax({
            type: 'POST',
            url: url,
            success: function (o) {
                $("#modal-container #employee-modal #commission-settings tbody").append(o).children(':last').hide().fadeIn(400);
                $("#modal-container #employee-modal #commission-settings tbody tr:last-child select").each(function () {
                    $(this).select2({
                        minimumResultsForSearch: -1,
                        dropdownParent: $("#modal-container #employee-modal")
                    });
                });
            },
        });
    });

    $(document).on("click", "#modal-container #employee-modal .btn-delete-commission-setting-row", function (e) {
        var tableRow = $(this).closest('tr');
        tableRow.find('td').fadeOut('fast',
            function () {
                tableRow.remove();
            }
        );
    });

    $(document).on('click', '#modal-container a#open-tags-modal', function (e) {
        e.preventDefault();
        var target = e.currentTarget.dataset;
        var modal_element = target.target;

        $.get(base_url + 'accounting/get-job-tag-modal/', function (res) {
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
            $('#tags-modal').modal('show');
        });
    });

    $(document).on('keyup', 'div#journalEntryModal input#journalNo', function () {
        if ($(this).val() !== "") {
            var val = $(this).val();
            $('div#journalEntryModal .modal-title span').html(`#${val}`);
        } else {
            $('div#journalEntryModal .modal-title span').html('');
        }
    });

    $(document).on('click', `div#modal-container form .modal table.clickable:not(#category-details-table,#item-details-table,#previous-adjustments-table) tbody tr td:not(:last-child)`, function () {
        var row = $(this).parent();
        if (row.find('input').length < 1) {
            var rowNum = row.find('td:first-child').html();

            row.html(rowInputs);
            row.find('td:first-child()').html(rowNum);

            row.find('select').each(function () {
                var type = $(this).attr('id');
                if (type === undefined) {
                    type = $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-');
                } else {
                    type = type.replaceAll('_', '-');
                }

                if (dropdownFields.includes(type)) {
                    $(this).select2({
                        ajax: {
                            url: base_url + 'accounting/get-dropdown-choices',
                            dataType: 'json',
                            data: function (params) {
                                var query = {
                                    search: params.term,
                                    type: 'public',
                                    field: type,
                                    modal: $('#modal-container form .modal').attr('id')
                                }

                                // Query parameters will be ?search=[term]&type=public&field=[type]
                                return query;
                            }
                        },
                        templateResult: formatResult,
                        templateSelection: optionSelect,
                        dropdownParent: $('#modal-container form .modal')
                    });
                } else {
                    $(this).select2({
                        minimumResultsForSearch: -1,
                        dropdownParent: $('#modal-container form .modal')
                    });
                }
            });
        }
    });

    $(document).on('click', 'div#modal-container .modal-body table#category-details-table tbody tr td:not(:last-child)', function () {
        var row = $(this).parent();
        if (row.find('input').length < 1) {
            var rowNum = row.children().html();

            row.html(catDetailsInputs);
            row.children('td:first-child()').html(rowNum);

            if ($('#modal-container .modal-body #category-details-table thead tr th').length === 12) {
                $(`<td></td>`).insertBefore($('#modal-container .modal .modal-body table#category-details-table tbody tr:last-child td:last-child'));
            }

            row.find('select').each(function () {
                var type = $(this).attr('id');
                if (type === undefined) {
                    type = $(this).attr('name').includes('expense_account') ? 'expense-account' : type;
                    type = $(this).attr('name').includes('category') ? 'category' : type;
                    type = $(this).attr('name').includes('customer') ? 'customer' : type;
                } else {
                    type = type.replaceAll('_', '-');
                }


                if (dropdownFields.includes(type)) {
                    $(this).select2({
                        ajax: {
                            url: base_url + 'accounting/get-dropdown-choices',
                            dataType: 'json',
                            data: function (params) {
                                var query = {
                                    search: params.term,
                                    type: 'public',
                                    field: type,
                                    modal: $('#modal-container form .modal').attr('id')
                                }

                                // Query parameters will be ?search=[term]&type=public
                                return query;
                            }
                        },
                        templateResult: formatResult,
                        templateSelection: optionSelect,
                        dropdownParent: $('#modal-container form .modal')
                    });
                } else {
                    $(this).select2({
                        minimumResultsForSearch: -1,
                        dropdownParent: $('#modal-container form .modal')
                    });
                }
            });
        }
    });

    $(document).on('change', '#depositModal #bank-deposit-table [name="amount[]"], #depositModal #cashBackAmount', function () {
        computeBankDepositeTotal();
    });

    $(document).on('click', 'div#modal-container .modal-body table:not(#category-details-table,#item-details-table, #item-table) tbody tr td button.delete-row', function () {
        var parentTable = $(this).parent().parent().parent().parent();
        $(this).parent().parent().remove();
        if (parentTable.find('tbody tr').length < rowCount) {
            parentTable.find('tbody').append(`<tr>${blankRow}</tr>`);
        }

        var num = 1;

        parentTable.find('tbody tr').each(function () {
            $(this).children('td:first-child()').html(num);
            num++;
        });

        switch (modalName) {
            case '#depositModal':
                computeBankDepositeTotal();
                break;
            case '#journalEntryModal':
                var debit = 0.00;
                var credit = 0.00;

                $('div#journalEntryModal table#journal-table input[name="debits[]"]').each(function () {
                    var rowDebit = $(this).val();
                    if (rowDebit !== "" && rowDebit !== undefined) {
                        rowDebit = parseFloat(rowDebit);
                    } else {
                        rowDebit = 0.00;
                    }

                    debit = parseFloat(parseFloat(debit) + rowDebit).toFixed(2);
                });

                $('div#journalEntryModal table#journal-table input[name="credits[]"]').each(function () {
                    var rowCredit = $(this).val();
                    if (rowCredit !== "" && rowCredit !== undefined) {
                        rowCredit = parseFloat(rowCredit);
                    } else {
                        rowCredit = 0.00;
                    }

                    credit = parseFloat(parseFloat(credit) + rowCredit).toFixed(2);
                });

                $('div#journalEntryModal table#journal-table tfoot tr td:nth-child(3)').html(parseFloat(debit).toFixed(2));
                $('div#journalEntryModal table#journal-table tfoot tr td:nth-child(4)').html(parseFloat(credit).toFixed(2));
                break;
        }
    });

    $(document).on('click', 'div#modal-container .modal-body table#previous-adjustments-table tbody tr td a.deleteRow', function () {
        $(this).parent().parent().remove();
        if ($('div#modal-container .modal-body table#previous-adjustments-table tbody tr').length < rowCount) {
            parentTable.find('tbody').append(`<tr>${blankRow}</tr>`);
        }

        var num = 1;

        $('div#modal-container .modal-body table#previous-adjustments-table tbody tr').each(function () {
            $(this).children('td:first-child').html(num);
            num++;
        });
    });

    $(document).on('click', '#modal-container .modal-body #category-details-table tbody tr td button.delete-row', function () {
        var el = $(this);
        if (el.closest('tr').find('input[name="category_linked_transaction[]"]').length < 1) {
            el.closest('tr').remove();

            if ($('#category-details-table tbody tr').length < rowCount) {
                $('#category-details-table tbody').append(`<tr>${catDetailsBlank}</tr>`);
                if ($('#category-details-table thead tr th').length > $('#category-details-table tbody tr:last-child td').length) {
                    $('<td></td>').insertBefore($('#category-details-table tbody tr:last-child td:last-child'));
                }
            }

            var num = 1;

            $('#category-details-table tbody tr').each(function () {
                $(this).children('td:first-child()').html(num);
                num++;
            });

            computeTransactionTotal();
        } else {
            var linkedTransac = el.closest('tr').find('input[name="category_linked_transaction[]"]').val();
            var linkedTransacType = linkedTransac.split('-')[0].replace('_', ' ');
            var type = linkedTransacType.charAt(0).toUpperCase() + linkedTransacType.slice(1);
            var transacType = $('#modal-container form .modal').attr('id').replace('Modal', '');

            var linkedItemCount = $(`#modal-container form .modal #item-details-table input[name="item_linked_transaction[]"][value="${linkedTransac}"]`).length;
            var linkedCategCount = $(`#modal-container form .modal #category-details-table input[name="category_linked_transaction[]"][value="${linkedTransac}"]`).length;

            var count = linkedItemCount + linkedCategCount;

            if (count > 1) {
                var message = `There are multiple lines for ${type}. Would you like to remove this line from the ${transacType} or unlink the whole transaction?`;
                var confirmButtonText = 'Unlink it';
                var cancelButtonText = 'Remove line';
            } else {
                var message = `Would you also like to unlink ${type}`;
                var confirmButtonText = 'Yes, unlink it';
                var cancelButtonText = 'No, keep it';
            }

            Swal.fire({
                title: message,
                icon: 'warning',
                showCloseButton: false,
                confirmButtonColor: '#2ca01c',
                confirmButtonText: confirmButtonText,
                showCancelButton: true,
                cancelButtonText: cancelButtonText,
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    el.closest('tr').find('.unlink-transaction').trigger('click');
                } else {
                    el.closest('tr').remove();

                    if ($('#category-details-table tbody tr').length < rowCount) {
                        $('#category-details-table tbody').append(`<tr>${catDetailsBlank}</tr>`);
                        if ($('#category-details-table thead tr th').length > $('#category-details-table tbody tr:last-child td').length) {
                            $('<td></td>').insertBefore($('#category-details-table tbody tr:last-child td:last-child'));
                        }
                    }

                    var num = 1;

                    $('#category-details-table tbody tr').each(function () {
                        $(this).children('td:first-child()').html(num);
                        num++;
                    });

                    computeTransactionTotal();
                }
            });
        }
    });

    $(document).on('click', '#modal-container #item-details-table tbody tr td button.delete-row', function () {
        var el = $(this);
        if (el.closest('tr').find('input[name="item_linked_transaction[]"]').length < 1) {
            el.closest('tr').remove();

            computeTransactionTotal();
        } else {
            var linkedTransac = el.closest('tr').find('input[name="item_linked_transaction[]"]').val();
            var linkedTransacType = linkedTransac.split('-')[0].replace('_', ' ');
            var type = linkedTransacType.charAt(0).toUpperCase() + linkedTransacType.slice(1);
            var transacType = $('#modal-container form .modal').attr('id').replace('Modal', '');

            var linkedItemCount = $(`#modal-container form .modal #item-details-table input[name="item_linked_transaction[]"][value="${linkedTransac}"]`).length;
            var linkedCategCount = $(`#modal-container form .modal #category-details-table input[name="category_linked_transaction[]"][value="${linkedTransac}"]`).length;

            var count = linkedItemCount + linkedCategCount;

            if (count > 1) {
                var message = `There are multiple lines for ${type}. Would you like to remove this line from the ${transacType} or unlink the whole transaction?`;
                var confirmButtonText = 'Unlink it';
                var cancelButtonText = 'Remove line';
            } else {
                var message = `Would you also like to unlink ${type}`;
                var confirmButtonText = 'Yes, unlink it';
                var cancelButtonText = 'No, keep it';
            }

            Swal.fire({
                title: message,
                icon: 'warning',
                showCloseButton: false,
                confirmButtonColor: '#2ca01c',
                confirmButtonText: confirmButtonText,
                showCancelButton: true,
                cancelButtonText: cancelButtonText,
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    el.parent().parent().parent().find('.unlink-transaction').trigger('click');
                } else {
                    if ($(`#modal-container form .modal #item-details-table input[name="item_linked_transaction[]"][value="${linkedTransac}"]`).length > 1) {
                        $(`#modal-container form .modal #item-details-table input[name="item_linked_transaction[]"][value="${linkedTransac}"]`).each(function () {
                            $(this).parent().parent().remove();
                        });
                    } else {
                        el.parent().parent().parent().remove();
                    }
                }
            });
        }

        computeTransactionTotal();
    });

    $(document).on('submit', '#tags-modal #create-tag-form, #tags-modal #update-tag-form', function (e) {
        e.preventDefault();

        var data = new FormData(this);
        data.append('method', $(this).attr('id').includes('create') ? 'create' : 'update');

        $.ajax({
            url: '/accounting/submit-job-tag-form',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function (result) {
                var res = JSON.parse(result);

                $('#tags-modal #back-to-tags-list').trigger('click');
                $('#tags-modal #search-tag').trigger('keyup');
            }
        });
    });

    $(document).on('click', '#tags-modal #back-to-tags-list', function () {
        $(this).parent().parent().parent().remove();

        $('#tags-modal div.modal-dialog').append('<div class="modal-content" id="tags-list"></div>');
        $('#tags-modal div.modal-dialog div#tags-list').append(tagsListModal);

        $('#tags-modal #search-tag').trigger('change');
    });

    $(document).on('keyup', '#tags-modal #search-tag', function () {
        var val = $(this).val();
        $.get('/accounting/load-job-tags?search=' + val, function (res) {
            var tags = JSON.parse(res);

            $('#tags-modal #tags-table tbody tr').remove();
            if (tags.length > 0) {
                $.each(tags, function (index, tag) {
                    $('#tags-modal #tags-table tbody').append(`
                    <tr ${tag.type === 'group' ? 'data-toggle="collapse" data-target=".collapse-' + index + '"' : ''}>
                        <td>
                            <span>
                                ${tag.type === 'group' ? '<i class="bx bx-fw bx-chevron-down"></i>' : ''}
                                ${tag.name} ${tag['type'] === 'group' ? '(' + tag.tags.length + ')' : ''}
                            </span>
                        </td>
                        <td><button class="nsm-button edit float-end" data-group-tag="${tag.group_tag_id}" data-type="${tag.type}" data-id="${tag.id}" data-name="${tag.name}">Edit</button></td>
                    </tr>
                    `);

                    if (tag.type === 'group') {
                        $.each(tag.tags, function (key, groupTag) {
                            $('#tags-modal #tags-table tbody').append(`
                            <tr class="collapse collapse-${index}">
                                <td>
                                    <span>&emsp;${groupTag.name}</span>
                                </td>
                                <td><button class="nsm-button edit float-end" data-group-tag="${groupTag.group_tag_id}" data-type="group-tag" data-id="${groupTag.id}" data-name="${groupTag.name}">Edit</button></td>
                            </tr>
                            `);
                        });
                    }
                });
            } else {
                $('#tags-modal #tags-table tbody').append(`
                <tr>
                    <td>
                        <div class="nsm-empty">
                            <span>No results found.</span>
                        </div>
                    </td>
                </tr>
                `)
            }
        });
    });

    $(document).on('click', '#tags-modal #tags-table tr[data-toggle="collapse"]', function (e) {
        var target = e.currentTarget.dataset.target;

        $(target).collapse('toggle');

        if ($(this).find('td:first-child').find('i').hasClass('bx-chevron-down')) {
            $(this).find('td:first-child').find('i').removeClass('bx-chevron-down').addClass('bx-chevron-up');
        } else {
            $(this).find('td:first-child').find('i').removeClass('bx-chevron-up').addClass('bx-chevron-down');
        }
    });

    $(document).on('click', 'div#tags-modal table#tags-table tbody tr td .edit', function (e) {
        e.preventDefault();

        if (e.currentTarget.dataset.type === 'group') {
            editGroupTagForm(e.currentTarget.dataset);
        } else {
            getTagForm(e.currentTarget.dataset, 'update');
        }
    });

    $(document).on('click', 'div#weeklyTimesheetModal button#add-table-line', function (e) {
        e.preventDefault();
        var table = e.currentTarget.dataset.target;
        var lastRow = $(`table${table} tbody tr:last-child() td:first-child()`);
        var lastRowCount = parseInt(lastRow.html());

        for (var i = 0; i < rowCount; i++) {
            lastRowCount++;
            $(`table${table} tbody`).append(`<tr>${rowInputs}</tr>`);
            $(`table${table} tbody tr:last-child() td:first-child()`).html(lastRowCount);

            $(`table${table} tbody tr:last-child() select`).val(null);
            // $(`table${table} tbody tr:last-child() select`).next('span').remove();
            $(`table${table} tbody tr:last-child() input:not([type="checkbox"])`).val('');
            $(`table${table} tbody tr:last-child() textarea`).val('');
            $(`table${table} tbody tr:last-child() textarea`).html('');
            $(`table${table} tbody tr:last-child() input[name="billable[]"]`).attr('id', `billable_${lastRowCount}`).prop('checked', false).trigger('change');
            $(`table${table} tbody tr:last-child() input[name="billable[]"]`).next().attr('for', `billable_${lastRowCount}`);
            $(`table${table} tbody tr:last-child() select`).each(function () {
                var type = $(this).attr('name').includes('customer') ? 'customer' : 'service';
                $(this).select2({
                    ajax: {
                        url: base_url + 'accounting/get-dropdown-choices',
                        dataType: 'json',
                        data: function (params) {
                            var query = {
                                search: params.term,
                                type: 'public',
                                field: type,
                                modal: 'weeklyTimesheetModal'
                            }

                            // Query parameters will be ?search=[term]&type=public&field=[type]
                            return query;
                        }
                    },
                    templateResult: formatResult,
                    templateSelection: optionSelect,
                    dropdownParent: $('#weeklyTimesheetModal')
                });
            });
        }
    });

    $(document).on('click', 'div#weeklyTimesheetModal button#clear-table-line', function (e) {
        e.preventDefault();
        var table = e.currentTarget.dataset.target;

        $(`table${table} tbody tr`).each(function () {
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
            $(`table${table} tbody tr:last-child() select`).select2({
                minimumResultsForSearch: -1,
                dropdownParent: $('#weeklyTimeSsheetModal')
            });
        }

        computeTotalHours();
    });

    $(document).on('click', 'div#modal-container table#timesheet-table tbody tr td a.deleteRow', function () {
        $(this).parent().parent().parent().remove();
        if ($('div#modal-container table tbody tr').length < rowCount) {
            $('div#modal-container table tbody').append(`<tr>${rowInputs}</tr>`)
        }

        var num = 1;

        $('div#modal-container table tbody tr').each(function () {
            $(this).children('td:first-child()').html(num);
            num++;
        });

        computeTotalHours();
    });

    $(document).on('change', 'div#journalEntryModal table#journal-table input[name="debits[]"], div#journalEntryModal table#journal-table input[name="credits[]"]', function () {
        convertToDecimal($(this));

        if ($(this).attr('name') === 'debits[]') {
            $(this).parent().parent().children('td:nth-child(4)').children('input').val('');
        } else {
            $(this).parent().parent().children('td:nth-child(3)').children('input').val('');
        }

        var debit = 0.00;
        var credit = 0.00;

        $('div#journalEntryModal table#journal-table input[name="debits[]"]').each(function () {
            var rowDebit = $(this).val();
            if (rowDebit !== "" && rowDebit !== undefined) {
                rowDebit = parseFloat(rowDebit);
            } else {
                rowDebit = 0.00;
            }

            debit = parseFloat(parseFloat(debit) + rowDebit).toFixed(2);
        });

        $('div#journalEntryModal table#journal-table input[name="credits[]"]').each(function () {
            var rowCredit = $(this).val();
            if (rowCredit !== "" && rowCredit !== undefined) {
                rowCredit = parseFloat(rowCredit);
            } else {
                rowCredit = 0.00;
            }

            credit = parseFloat(parseFloat(credit) + rowCredit).toFixed(2);
        });

        $('div#journalEntryModal table#journal-table tfoot tr td:nth-child(3)').html(parseFloat(debit).toFixed(2));
        $('div#journalEntryModal table#journal-table tfoot tr td:nth-child(4)').html(parseFloat(credit).toFixed(2));
    });

    $(document).on('change', '#statementModal #startDate, #statementModal #endDate', function () {
        if ($('#statementModal #apply-button').length < 1) {
            $(this).parent().parent().parent().append(`<div class="col-12 grid-mb"><button type="button" class="nsm-button" id="apply-button">Apply</button></div>`);
            $('#statementModal .modal-body div.row div.col').children(':last-child').hide();
        }
    });

    $(document).on('change', 'div#statementModal select#statementType, div#statementModal select#customerBalanceStatus, div#statementModal input#statementDate', function () {
        if ($('#statementModal #apply-button').length < 1) {
            $('div#statementModal div.modal-body div.row div.col').children('.row:nth-child(3)').append(`<div class="col-12 grid-mb"><button type="button" class="nsm-button" id="apply-button">Apply</button></div>`);
            $('#statementModal .modal-body div.row div.col').children(':last-child').hide();
        }

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

    $(document).on('change', 'div#statementModal div.modal-body select#statementType', function () {
        if ($(this).val() === '2') {
            $('div#statementModal #startDate').parent().parent().remove();
            $('div#statementModal #endDate').parent().parent().remove();
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

            if ($('div#statementModal #startDate').length === 0) {
                var el = $('#statementModal #customerBalanceStatus').parent();
                var insert = `<div class="col-12 col-md-2 grid-mb">
                    <label for="startDate">Start Date</label>
                    <div class="nsm-field-group calendar">
                        <input type="text" class="form-control nsm-field date" name="start_date" id="startDate" value="${startDate}"/>
                    </div>
                </div>`;
                $(insert).insertAfter(el);

                $(`#statementModal input#startDate`).datepicker({
                    format: 'mm/dd/yyyy',
                    orientation: 'bottom',
                    autoclose: true
                });
            }

            if ($('div#statementModal #endDate').length === 0) {
                var el = $('#statementModal #customerBalanceStatus').parent().next();
                var insert = `<div class="col-12 col-md-2 grid-mb">
                    <label for="endDate">End Date</label>
                    <div class="nsm-field-group calendar">
                        <input type="text" class="form-control nsm-field date" name="end_date" id="endDate" value="${today}"/>
                    </div>
                </div>`;
                $(insert).insertAfter(el);

                $(`#statementModal input#endDate`).datepicker({
                    format: 'mm/dd/yyyy',
                    orientation: 'bottom',
                    autoclose: true
                });
            }
        }
    });

    $(document).on('click', 'div#statementModal button#apply-button', function (e) {
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
            url: '/accounting/get-statement-customers',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function (result) {
                var res = JSON.parse(result);
                var customers = res.customers;
                var withoutEmail = res.withoutEmail;

                var total = '$' + res.total;
                $('div#statementModal span#total-customers').html(customers.length);
                $('div#statementModal span#total-amount').html(`${total.replace('$-', '-$')}`);
                $('div#statementModal span#without-email-count').html(withoutEmail.length);
                $('div#statementModal span#statements-count').html(customers.length);
                $('div#statementModal table#statements-table tbody').html('');
                $('div#statementModal table#missing-email-table tbody').html('');

                if (withoutEmail.length > 0) {
                    $.each(withoutEmail, function (key, cust) {
                        var balance = '$' + cust.balance;
                        $('div#statementModal table#missing-email-table tbody').append(`<tr>
                            <td>
                                <div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" type="checkbox" name="missing_email_customer[]" value="${cust.id}">
                                </div>
                            </td>
                            <td>${cust.name}</td>
                            <td><input type="email" name="no_email[]" class="form-control nsm-field" value="${cust.email}"></td>
                            <td>${balance.replace('$-', '-$')}</td>
                        </tr>`);
                    });
                } else {
                    $('#statementModal #missing-email-table tbody').append(`<tr>
                        <td colspan="4">
                            <div class="nsm-empty">
                                <span>No customers found for the applied filters.</span>
                            </div>
                        </td>
                    </tr>`);
                }

                if (customers.length > 0) {
                    $.each(customers, function (key, customer) {
                        var balance = '$' + customer.balance;
                        $('#statementModal #statements-table tbody').append(`<tr>
                            <td>
                                <div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" type="checkbox" name="customer[]" value="${customer.id}">
                                </div>
                            </td>
                            <td>${customer.name}</td>
                            <td><input type="email" name="email[]" class="form-control nsm-field" value="${customer.email}"></td>
                            <td>${balance.replace('$-', '-$')}</td>
                        </tr>
                        `);
                    });
                } else {
                    $('#statementModal #statements-table tbody').append(`<tr>
                        <td colspan="4">
                            <div class="nsm-empty">
                                <span>No customers found for the applied filters.</span>
                            </div>
                        </td>
                    </tr>`);
                }

                $('div#statementModal div.modal-body button#apply-button').parent().remove();
                $('div#statementModal div.modal-body div.row:last-child()').show();
            }
        });
    });

    $(document).on('change', '#statementModal table tbody input[type="email"]', function () {
        var row = $(this).closest('tr');
        var customerId = row.find('.select-one').val();
        var value = $(this).val();

        if (row.closest('table').attr('id') === 'statements-table') {
            $(`#statementModal #missing-email-table input.select-one[value="${customerId}"]`).closest('tr').find('input[type="email"]').val(value);
        } else {
            $(`#statementModal #statements-table input.select-one[value="${customerId}"]`).closest('tr').find('input[type="email"]').val(value);
        }
    });

    $(document).on('change', '#statementModal table thead input.select-all', function () {
        var table = $(this).closest('table');

        table.children('tbody').find('input.select-one').prop('checked', $(this).prop('checked'));

        if (table.attr('id') === 'statements-table') {
            $('#statementModal #missing-email-table input[type="checkbox"]').prop('checked', $(this).prop('checked'));
        } else {
            table.children('tbody').find('input.select-one').each(function () {
                var val = $(this).val();

                $(`#statementModal #statements-table tbody input[type="checkbox"][value="${val}"]`).prop('checked', $(this).prop('checked'));
            });

            if ($(this).prop('checked') === false) {
                $('#statementModal #statements-table thead input.select-all').prop('checked', false);
            }
        }
    });

    $(document).on('change', '#statementModal table tbody input.select-one', function () {
        var table = $(this).closest('table');
        var totalRows = table.find('tbody tr').length;
        var checked = table.find('input.select-one:checked').length;

        table.find('.select-all').prop('checked', checked === totalRows);

        if (table.attr('id') === 'statements-table') {
            $(`#statementModal #missing-email-table tbody input[type="checkbox"][value="${$(this).val()}"]`).prop('checked', $(this).prop('checked'));

            var missingTableRows = $('#statementModal #missing-email-table tbody tr').length;
            var missingTableChecked = $('#statementModal #missing-email-table tbody input.select-one:checked').length;

            $('#statementModal #missing-email-table thead .select-all').prop('checked', missingTableChecked === missingTableRows);
        } else {
            $(`#statementModal #statements-table tbody input[type="checkbox"][value="${$(this).val()}"]`).prop('checked', $(this).prop('checked'));

            var statementsTableRows = $('#statementModal #statements-table tbody tr').length;
            var statementsTableChecked = $('#statementModal #statements-table tbody input.select-one:checked').length;

            $('#statementModal #statements-table thead .select-all').prop('checked', statementsTableChecked === statementsTableRows);
        }
    });

    $(document).on('change', 'div#singleTimeModal select#startTime, div#singleTimeModal select#endTime, div#singleTimeModal input#time, div#singleTimeModal input#break, #singleTimeModal #billable, #singleTimeModal #hourlyRate, #singleTimeModal #taxable', function () {
        timeActivitySummary();
    });

    $(document).on('change', '#singleTimeModal select#service, #singleTimeModal #billable', function () {
        var service = $('#singleTimeModal #service').val();

        if (service !== null && service !== '' && service !== undefined) {
            if ($('#singleTimeModal #billable').prop('checked')) {
                $.get(base_url + `accounting/get-item-details/${service}`, function (res) {
                    var result = JSON.parse(res);
                    var rate = result.item !== null ? result.item.price : '';

                    $('#singleTimeModal #hourlyRate').val(rate).trigger('change');
                });
            }
        }
    });

    $(document).on('change', 'div.modal select#recurringType', function () {
        var modalId = $('form#modal-form, form#update-recurring-form').children('.modal').attr('id');

        switch ($(this).val()) {
            case 'reminder':
                if ($(this).parent().next().hasClass('col-md-2')) {
                    $(this).parent().next().removeClass('col-md-2');
                    $(this).parent().next().addClass('col-md-3');
                }

                $(this).parent().next().html(`
                    <span>Remind &emsp;</span>
                   <div class="d-flex">
                   <input type="number" name="days_in_advance" id="dayInAdvance" class="form-control nsm-field w-auto">
                   <span>&emsp; days before the transaction date</span>
                   </div>
                `);

                if ($('#modal-container form div.modal div.modal-body select#recurringInterval').length === 0) {
                    if ($('#modal-container form').children('.modal').attr('id') === 'depositModal') {
                        $(`<div class="row recurring-interval-container">${recurrInterval}</div>`).insertAfter($('div#depositModal div.modal-body div.bank-account-details'));
                    } else if (vendorModals.includes(`#${modalId}`)) {
                        $(`<div class="row recurring-interval-container">${recurrInterval}</div>`).insertAfter($(`div#${modalId} div.modal-body div.payee-details`));
                    } else {
                        $(`<div class="row recurring-interval-container">${recurrInterval}</div>`).insertAfter($('div.modal div.modal-body div.recurring-details'));
                    }

                    $(`div.modal input.date`).datepicker({
                        format: 'mm/dd/yyyy',
                        orientation: 'bottom',
                        autoclose: true
                    });
                }
                break;
            case 'unscheduled':
                $('div.modal div.modal-body div.recurring-interval-container').remove();
                $(this).parent().next().removeClass('col-md-3');
                $(this).parent().next().addClass('col-md-2');
                $(this).parent().next().html(`
                    <div class="d-flex justify-content-end align-items-end pb-3 h-100"><span id="modal-help-popover-unscheduled" class="bx bx-fw bx-help-circle" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover" data-bs-content="Unscheduled transactions don’t have timetables; you use them as needed from the Recurring Transactions list."></span></div>
                    `);

                $('#modal-help-popover-unscheduled').popover({
                    placement: 'top',
                    html: true,
                    trigger: "hover focus",
                    content: function () {
                        return 'Unscheduled transactions don’t have timetables; you use them as needed from the Recurring Transactions list.';
                    }
                })
                break;
            case 'scheduled':
                if ($(this).parent().next().hasClass('col-md-2')) {
                    $(this).parent().next().removeClass('col-md-2');
                    $(this).parent().next().addClass('col-md-3');
                }

                $(this).parent().next().html(`
                    <span>Create &emsp;</span>
                    <input type="number" name="days_in_advance" id="dayInAdvance" class="form-control nsm-field w-auto">
                    <span>&emsp; days in advance</span>
                `);

                if ($('#modal-container form div.modal div.modal-body select#recurringInterval').length === 0) {
                    if ($('#modal-container form').children('.modal').attr('id') === 'depositModal') {
                        $(`<div class="row recurring-interval-container">${recurrInterval}</div>`).insertAfter($('div#depositModal div.modal-body div.bank-account-details'));
                    } else if (vendorModals.includes(`#${modalId}`)) {
                        $(`<div class="row recurring-interval-container">${recurrInterval}</div>`).insertAfter($(`div#${modalId} div.modal-body div.payee-details`));
                    } else {
                        $(`<div class="row recurring-interval-container">${recurrInterval}</div>`).insertAfter($('div.modal div.modal-body div.recurring-details'));
                    }

                    $(`div.modal input.date`).datepicker({
                        format: 'mm/dd/yyyy',
                        orientation: 'bottom',
                        autoclose: true
                    });
                }
                break;
        }

        var modalId = $('div#modal-container form div.modal:first-child()').attr('id');

        $(`div#${modalId} select:not(.select2-hidden-accessible)`).select2({
            minimumResultsForSearch: -1,
            dropdownParent: $('#modal-container form .modal')
        });
    });

    $(document).on('change', 'div.modal select[name="recurring_week"]', function () {
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
                minimumResultsForSearch: -1,
                dropdownParent: $('#modal-container form .modal')
            });
        } else {
            $(this).parent().next().find('select[name="recurring_day"]').next().remove();
            $(this).parent().next().find('select[name="recurring_day"]').html(recurringDays);
            $(this).parent().next().find('select[name="recurring_day"]').select2({
                minimumResultsForSearch: -1,
                dropdownParent: $('#modal-container form .modal')
            });
        }
    });

    $(document).on('change', 'div.modal select#endType', function () {
        if ($(this).val() === 'by') {
            $(this).parent().next().remove();
            $(this).parent().parent().append(`
                <div class="col-12 col-md-1">
                    <label for="endDate">End date</label>
                    <div class="nsm-field-group calendar">
                        <input type="text" class="form-control nsm-field date" name="end_date" id="endDate"/>
                    </div>
                </div>
            `);

            $(`div.modal input#endDate`).datepicker({
                format: 'mm/dd/yyyy',
                orientation: 'bottom',
                autoclose: true
            });
        } else if ($(this).val() === 'after') {
            $(this).parent().next().remove();
            $(this).parent().parent().append(`
                <div class="col-12 col-md-1">
                    <div class="row h-100">
                        <div class="col-6 d-flex align-items-end">
                            <input type="number" name="max_occurence" id="maxOccurence" class="form-control nsm-field">
                        </div>
                        <div class="col-6 d-flex align-items-end">occurrences</div>
                    </div>
                </div>
            `);
        } else {
            $(this).parent().next().remove();
        }
    });

    $(document).on('change', 'div.modal select#recurringInterval', function () {
        var fields = '';
        switch ($(this).val()) {
            case 'daily':

                if ($(this).parent().next().hasClass('col-md-4')) {
                    $(this).parent().next().removeClass('col-md-4');
                } else if ($(this).parent().next().hasClass('col-md-3')) {
                    $(this).parent().next().removeClass('col-md-3');
                }

                if ($(this).parent().next().hasClass('col-md-2') === false) {
                    $(this).parent().next().addClass('col-md-2');
                }

                fields = `
                    <div class="col-2 d-flex align-items-end justify-content-center">every</div>
                    <div class="col-8 d-flex align-items-end"><input type="number" value="1" class="form-control nsm-field" name="recurr_every"></div>
                    <div class="col-2 align-items-end d-flex">day</div>
                `;
                break;
            case 'weekly':
                if ($(this).parent().next().hasClass('col-md-4')) {
                    $(this).parent().next().removeClass('col-md-4');
                } else if ($(this).parent().next().hasClass('col-md-2')) {
                    $(this).parent().next().removeClass('col-md-2');
                }

                if ($(this).parent().next().hasClass('col-md-3') === false) {
                    $(this).parent().next().addClass('col-md-3');
                }

                fields = `
                    <div class="col-2 d-flex align-items-end justify-content-center">every</div>
                    <div class="col-10 col-md-4 d-flex align-items-end"><input type="number" value="1" class="form-control nsm-field" name="recurr_every"></div>
                    <div class="col-2 d-flex align-items-end justify-content-center">week(s) on</div>
                    <div class="col-10 col-md-4 d-flex align-items-end">
                        <select class="form-control nsm-field" name="recurring_day">
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
                break;
            case 'yearly':
                if ($(this).parent().next().hasClass('col-md-4')) {
                    $(this).parent().next().removeClass('col-md-4');
                } else if ($(this).parent().next().hasClass('col-md-3')) {
                    $(this).parent().next().removeClass('col-md-3');
                }

                if ($(this).parent().next().hasClass('col-md-2') === false) {
                    $(this).parent().next().addClass('col-md-2');
                }

                fields = `
                    <div class="col-2 d-flex align-items-end justify-content-center">every</div>
                    <div class="col-10 col-md-6 d-flex align-items-end">
                        <select class="form-control nsm-field" name="recurring_month">
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
                    <div class="col-12 col-md-4 d-flex align-items-end">
                        <select class="form-control nsm-field" name="recurring_day">
                            ${recurringDays}
                        </select>
                    </div>
                `;
                break;
            case 'monthly':
                if ($(this).parent().next().hasClass('col-md-3')) {
                    $(this).parent().next().removeClass('col-md-3');
                } else if ($(this).parent().next().hasClass('col-md-2')) {
                    $(this).parent().next().removeClass('col-md-2');
                }

                if ($(this).parent().next().hasClass('col-md-4') === false) {
                    $(this).parent().next().addClass('col-md-4');
                }

                fields = monthlyRecurrFields;
                break;
        }

        $(this).parent().next().children().html(fields);

        $(this).parent().next().children().find('select').each(function () {
            $(this).select2({
                minimumResultsForSearch: -1,
                dropdownParent: $('#modal-container form .modal')
            });
        });
    });

    $(document).on('click', '#showPdfModal button#print-deposit-pdf', function (e) {
        var PDF = document.getElementById('showPdf');
        PDF.focus();
        PDF.contentWindow.print();
    });

    $(document).on('click', '#statementModal div.modal-footer button#save-and-send', function (e) {
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

        customers.each(function () {
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
                success: function (res) {
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

    $(document).on('submit', '#tags-modal #tags-group-form', function (e) {
        e.preventDefault();

        var form = $(this);

        var data = new FormData(document.getElementById(form.attr('id')));

        $.ajax({
            url: '/accounting/tags/add-group-tag',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function (res) {
                var result = JSON.parse(res);

                form.addClass('d-none');
                $('#tags-modal #tags_group tbody').append(`
                    <tr>
                        <td><span>${data.get('tags_group_name')}</span></td>
                        <td><button class="nsm-button float-end">Edit</button></td>
                    </tr>
                `);
                $('#tags-modal #tags_group').removeClass('d-none');
                $('#tags-modal #tags-form').prepend(`<input type="hidden" name="group_id" value="${result.data}">`);
                form.prepend(`<input type="hidden" name="group_id" value="${result.data}">`);
            }
        });
    });

    $(document).on('click', '#tags-modal table#tags_group tbody button', function () {
        if ($('#tags-modal #update-group-form').length === 0) {
            $('#tags-modal #tags-group-form').attr('id', 'update-group-form');
        }

        $('#tags-modal #update-group-form').removeClass('d-none');

        $('#tags-modal table#tags_group').addClass('d-none');
    });

    $(document).on('submit', '#tags-modal #update-group-form, #tags-modal #edit_group_tag', function (e) {
        e.preventDefault();

        var form = $(this);

        var data = new FormData(this);

        $.ajax({
            url: `/accounting/tags/update/${data.get('group_id')}/group`,
            data: { name: data.get('tags_group_name') },
            type: "POST",
            dataType: "json",
            success: function (res) {
                if (form.attr('id') === 'update-group-form') {
                    form.addClass('d-none');
                    $('#tags-modal #tags_group tbody tr').remove();
                    $('#tags-modal #tags_group tbody').append(`<tr><td><span>${data.get('tags_group_name')}</span></td><td><button class="nsm-button float-end">Edit</button></td></tr>`);

                    $('#tags-modal #tags_group').removeClass('d-none');
                } else {
                    $('#tags-modal #back-to-tags-list').trigger('click');
                    $('#tags-modal #search-tag').trigger('keyup');
                }
            }
        });
    });

    $(document).on('submit', '#tags-modal #tags-form', function (e) {
        e.preventDefault();

        var form = $(this);

        var data = new FormData(document.getElementById(form.attr('id')));

        $.ajax({
            url: '/accounting/tags/add-tag',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function (res) {
                var result = JSON.parse(res);
                $('#tags-modal #group_tags tbody').append(`
                <tr>
                    <td>
                        <div class="tag-name-cont">
                            <div class="row">
                                <div class="col-12 col-md-8"><span>${data.get('tag_name')}</span></div>
                                <div class="col-12 col-md-4"><button class="nsm-button float-end">Edit</button></div>
                            </div>
                        </div>
                        <form class="d-none" id="form-tag-${result.data}">
                            <input type="hidden" name="id" value="${result.data}">
                            <div class="row">
                                <div class="col-12 col-md-8">
                                    <label for="tag_name">Tag name</label>
                                    <input type="text" name="tag_name" value="${data.get('tag_name')}" class="form-control nsm-field">
                                </div>
                                <div class="col-12 col-md-4 justify-content-end align-items-end d-flex">
                                    <button type="submit" class="nsm-button success float-end">Save</button>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>`);

                $('#tags-modal #tags-form input#tag-name').val('');
                $('#tags-modal #group_tags').removeClass('d-none');
            }
        });
    });

    $(document).on('click', '#tags-modal table#group_tags tbody .tag-name-cont button', function () {
        $(this).closest('.tag-name-cont').addClass('d-none');
        $(this).closest('.tag-name-cont').next().removeClass('d-none');
    });

    $(document).on('submit', '#tags-modal table#group_tags tbody form', function (e) {
        e.preventDefault();

        var form = $(this);
        var data = new FormData(this);
        data.append('group_id', $('#tags-modal #tags-form [name="group_id"]').val());
        data.append('method', 'update');

        $.ajax({
            url: '/accounting/submit-job-tag-form',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function (res) {
                form.addClass('d-none');

                form.prev().find('span').html(data.get('tag_name'));
                form.prev().removeClass('d-none');
            }
        });
    });

    $(document).on('change', '#inventoryModal #referenceNo', function () {
        $('#inventoryModal .modal-title span').html($(this).val() !== '' ? '#' + $(this).val() : '');
    });

    $(document).on('change', '#inventory-adjustments-table select[name="product[]"]', function () {
        var input = $(this);
        var row = input.closest('tr');

        if (input.val() !== 'add-new') {
            $.get(base_url + `accounting/get-item-details/${input.val()}`, function (res) {
                var result = JSON.parse(res);

                row.children(':nth-child(3)').html(result.item.description);

                var selectElement = row.children(':nth-child(4)').children('select');
                selectElement.empty();

                result.locations.forEach(function (location) {
                    if (!location.disabled) {
                        selectElement.append(`<option value="${location.id}" data-quantity="${location.qty}">${location.name}</option>`);
                    }
                });

                selectElement.on('change', function () {
                    var selectedOption = $(this).find('option:selected');
                    var selectedQuantity = selectedOption.data('quantity');

                    var quantityInput = row.children(':nth-child(6)').children('input');
                    quantityInput.val(selectedQuantity);
                });

                selectElement.trigger('change');

                row.children(':nth-child(7)').children('input').val('');
            });
        }
    });

    $(document).on('change', '#inventory-adjustments-table select[name="location[]"]', function () {
        var selected = $(this).children('option:selected');
        var quantity = selected[0].dataset.quantity;

        $(this).parent().next().addClass('text-right');
        $(this).parent().next().html(quantity);
        $(this).parent().parent().find('input[name="new_qty[]"]').val(quantity);
        $(this).parent().parent().find('input[name="change_in_qty[]"]').val(0);
    });

    $(document).on('change', '#inventory-adjustments-table input[name="new_qty[]"], #inventory-adjustments-table input[name="change_in_qty[]"]', function () {
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
    $(document).on('click', '#modal-container .modal .btn[data-toggle="collapse"]', function (e) {
        if ($(this).attr('aria-expanded') === 'true') {
            $(this).children('i').addClass('fa-caret-down').removeClass('fa-caret-right');
        } else {
            $(this).children('i').addClass('fa-caret-right').removeClass('fa-caret-down');
        }
    });

    $(document).on('change', '#expenseModal #ref_no', function () {
        if ($(this).val() !== "") {
            $('#expenseModal .modal-title span').html('#' + $(this).val());
        } else {
            $('#expenseModal .modal-title span').html('');
        }
    });

    $(document).on('change', '#creditCardCreditModal #ref_no', function () {
        if ($(this).val() !== "") {
            $('#creditCardCreditModal .modal-title span').html('#' + $(this).val());
        } else {
            $('#creditCardCreditModal .modal-title span').html('');
        }
    });

    $(document).on('change', '#checkModal #print_later', function () {
        if ($(this).prop('checked')) {
            $('#checkModal #check_no').prop('disabled', true);
            $('#checkModal #check_no').val('To print').trigger('change');
        } else {
            $('#checkModal #check_no').prop('disabled', false);
            $('#checkModal #check_no').val('').trigger('change');
        }
    });

    $(document).on('change', '#checkModal #check_no', function () {
        if ($(this).val() !== "") {
            $('#checkModal .modal-title span').html('#' + $(this).val());
        } else {
            $('#checkModal .modal-title span').html('');
        }
    });

    $(document).on('change', '#modal-container .modal-body table#category-details-table input[name="category_amount[]"]', function () {
        computeTransactionTotal();
    });

    $(document).on('change', '#modal-container .modal-body table#category-details-table input[name="category_billable[]"]', function () {
        if ($(this).prop('checked')) {
            $(this).parent().parent().parent().find('select[name="category_customer[]"]').prop('required', true);
        } else {
            $(this).parent().parent().parent().find('select[name="category_customer[]"]').prop('required', false);
        }
    });

    $(document).on('change', '#modal-container .modal-body table#category-details-table input[name="category_tax[]"]', function () {
        $(this).parent().parent().parent().find('input[name="category_billable[]"]').prop('checked', true).trigger('change');
    });

    $(document).on('change', '#expenseModal #expense_payment_account', function () {
        var val = $(this).val();

        if (val !== '' && val !== null && val !== 'add-new') {
            $.get('/accounting/get-account-balance/' + val, function (res) {
                var result = JSON.parse(res);

                $('#expenseModal span#account-balance').html(result.balance);
            });
        }
    });

    $(document).on('change', '#creditCardCreditModal #bank_credit_account', function () {
        var val = $(this).val();

        if (val !== '' && val !== null && val !== 'add-new') {
            $.get('/accounting/get-account-balance/' + val, function (res) {
                var result = JSON.parse(res);

                $('#creditCardCreditModal span#account-balance').html(result.balance);
            });
        }
    });

    $(document).on('change', '#checkModal #bank_account', function () {
        var val = $(this).val();

        if (val !== '' && val !== null && val !== 'add-new') {
            $.get('/accounting/get-account-balance/' + val, function (res) {
                var result = JSON.parse(res);

                $('#checkModal span#account-balance').html(result.balance);
            });
        }
    });

    $(document).on('change', '#printChecksModal [name="col_chk"]', function () {
        var chk = $(this);
        var dataName = $(this).next().html();
        var index = $(`#printChecksModal #checks-table tr td[data-name="${dataName}"]`).index();

        $(`#printChecksModal #checks-table tr`).each(function () {
            if (chk.prop('checked')) {
                $($(this).find('td')[index]).show();
            } else {
                $($(this).find('td')[index]).hide();
            }
        });

        $(`#print_printable_checks_modal table tr`).each(function () {
            if (chk.prop('checked')) {
                $($(this).find('td')[index - 1]).show();
            } else {
                $($(this).find('td')[index - 1]).hide();
            }
        });

        $(`#print_preview_printable_checks_modal #printable_checks_table_print tr`).each(function () {
            if (chk.prop('checked')) {
                $($(this).find('td')[index - 1]).show();
            } else {
                $($(this).find('td')[index - 1]).hide();
            }
        });
    });

    $(document).on('change', '#printChecksModal #payment_account', function () {
        var id = $(this).val();

        $.get('/accounting/get-account-balance/' + id, function (res) {
            var result = JSON.parse(res);

            $('#printChecksModal span#account-balance').html(result.balance);
        });
    });

    $(document).on('change', '#payBillsModal #payment_account', function () {
        var id = $(this).val();

        $.get('/accounting/get-account-balance/' + id, function (res) {
            var result = JSON.parse(res);

            $('#payBillsModal span#account-balance').html(result.balance);
        });
    });

    $(document).on('change', '#payBillsModal #table_rows', function () {
        applybillsfilter();
    });

    $(document).on('change', '#modal-container table#item-details-table tbody tr input', function () {
        var quantity = $(this).parent().parent().find('input[name="quantity[]"]').val();
        var price = $(this).parent().parent().find('input[name="item_amount[]"]').val();
        var taxPercentage = $(this).parent().parent().find('input[name="item_tax[]"]').val();
        var discount = $(this).parent().parent().find('input[name="discount[]"]').val();
        var amount = parseFloat(parseFloat(price) * parseFloat(quantity)).toFixed(2);
        var taxAmount = parseFloat(taxPercentage) * amount / 100;
        var total = parseFloat(parseFloat(amount) + parseFloat(taxAmount) - parseFloat(discount)).toFixed(2);

        $(this).parent().parent().find('td span.row-total').html(formatter.format(parseFloat(total)));
        computeTransactionTotal();
    });

    $(document).on('click', '#modal-container button#add_another_items', function (e) {
        e.preventDefault();

        if ($('#modal-container #products_list.modal').length === 0) {
            $.get(base_url + 'accounting/get-products-list-modal', function (res) {
                $('#modal-container').append(res);

                $('#modal-container #products_list table').nsmPagination({
                    itemsPerPage: 10
                });

                $('#modal-container #products_list').modal('show');
            });
        } else {
            $('#modal-container #products_list').modal('show');
        }
    });

    $(document).on('click', '#modal-container #products_list table button', function (e) {
        e.preventDefault();
        var id = e.currentTarget.dataset.id;

        $.get(base_url + 'accounting/get-item-details/' + id, function (res) {
            var result = JSON.parse(res);
            var item = result.item;
            var locations = result.locations;
            var locs = '';
            var item_cost = 0;
            var item_price = 0;

            if (item.cost != null) {
                item_cost = item.cost;
            }

            if (item.price != null) {
                item_price = item.price;
            }

            if (item.type === 'product' || item.type === 'Product' || item.type === 'inventory' || item.type === 'Inventory') {
                locs += '<select name="location[]" class="nsm-field form-control" required>';

                for (var i in locations) {
                    locs += `<option value="${locations[i].id}" data-quantity="${locations[i].qty === "null" ? 0 : locations[i].qty}">${locations[i].name}</option>`;
                }

                locs += '</select>';

                if ($('#modal-container form .modal').attr('id') === 'creditCardCreditModal' || $('#modal-container form .modal').attr('id') === 'vendorCreditModal') {
                    var qtyField = `<input type="number" name="quantity[]" class="form-control text-end" required value="0" max="${locations[0].qty}">`;
                } else {
                    var qtyField = `<input type="number" name="quantity[]" class="form-control text-end" required value="0">`;
                }
            } else {
                var qtyField = `<input type="number" name="quantity[]" class="form-control text-end" required value="0">`;
            }

            if ($('#modal-container form .modal').attr('id') === 'purchaseOrderModal' && $('#modal-container #item-details-table thead th').length > 9) {
                var fields = `
                    <td>${item.title}<input type="hidden" name="item[]" value="${item.id}"></td>
                    <td>${item.type.charAt(0).toUpperCase() + item.type.slice(1)}</td>
                    <td>${locs}</td>
                    <td>${qtyField}</td>
                    <td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="nsm-field form-control text-end" step=".01" value="${item_cost}"></td>
                    <td><input type="number" name="discount[]" onchange="convertToDecimal(this)" class="nsm-field form-control text-end" step=".01" value="0.00"></td>
                    <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="nsm-field form-control text-end" step=".01" value="7.50"></td>
                    <td><span class="row-total">$0.00</span></td>
                    <td class="text-end">0</td>
                    <td>
                        <div class="table-row-icon table-checkbox">
                            <input class="form-check-input table-select" name="item_closed[]" type="checkbox" value="1">
                        </div>
                    </td>
                    <td>
                        <button type="button" class="nsm-button delete-row">
                            <i class='bx bx-fw bx-trash'></i>
                        </button>
                    </td>
                `;
            } else {
                var fields = `
                    <td>${item.title}<input type="hidden" name="item[]" value="${item.id}"></td>
                    <td>${item.type.charAt(0).toUpperCase() + item.type.slice(1)}</td>
                    <td>${locs}</td>
                    <td>${qtyField}</td>
                    <td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="nsm-field form-control text-end" step=".01" value="${item_price}"></td>
                    <td><input type="number" name="discount[]" onchange="convertToDecimal(this)" class="nsm-field form-control text-end" step=".01" value="0.00"></td>
                    <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="nsm-field form-control text-end" step=".01" value="7.50"></td>
                    <td><span class="row-total">$0.00</span></td>
                    <td>
                        <button type="button" class="nsm-button delete-row">
                            <i class='bx bx-fw bx-trash'></i>
                        </button>
                    </td>
                `;
            }

            $('#modal-container form .modal #item-details-table tbody').append(`<tr></tr>`);
            $('#modal-container form .modal #item-details-table tbody tr:last-child').append(fields);
            if ($('#modal-container #item-details-table thead tr th').length > $('#modal-container #item-details-table tbody tr:last-child td')) {
                $(`<td></td>`).insertBefore($('#modal-container .modal table#item-details-table tbody tr:last-child td:last-child'));
            }

            $('#modal-container form .modal #item-details-table tbody tr:last-child select').each(function () {
                $(this).select2({
                    minimumResultsForSearch: -1,
                    dropdownParent: $('#modal-container form .modal')
                });
            });

            if ($('#modal-container form #linked-transaction').length > 0) {
                $('<td></td>').insertBefore('#modal-container form .modal #item-details-table tbody tr:last-child td:last-child');
            }
        });

        $('#modal-container #products_list').modal('hide');
    });

    $(document).on('change', '#creditCardCreditModal #item-details-table select[name="location[]"]', function () {
        var quantity = $(this).find('option:selected')[0].dataset.quantity;

        $(this).parent().parent().find('input[name="quantity[]"]').attr('max', quantity);
    });

    $(document).on('change', '#vendorCreditModal #item-details-table select[name="location[]"]', function () {
        var quantity = $(this).find('option:selected')[0].dataset.quantity;

        $(this).parent().parent().find('input[name="quantity[]"]').attr('max', quantity);
    });

    $(document).on('change', '#vendorCreditModal #ref_no', function () {
        if ($(this).val() !== "") {
            $('#vendorCreditModal .modal-title span').html('#' + $(this).val());
        } else {
            $('#vendorCreditModal .modal-title span').html('');
        }
    });

    $(document).on('change', '#billModal #bill_no', function () {
        if ($(this).val() !== "") {
            $('#billModal .modal-title span').html('#' + $(this).val());
        } else {
            $('#billModal .modal-title span').html('');
        }
    });

    $(document).on('change', '#billModal #terms', function () {
        if ($(this).val() !== 'add-new') {
            var billDate = new Date($('#billModal #bill_date').val());
            var dueDate = new Date(`${billDate.getMonth() + 1}/${billDate.getDate()}/${billDate.getFullYear()}`);

            $.get('/accounting/get-term-details/' + $(this).val(), function (res) {
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
                        var expectedDue = new Date(`${dueDate.getMonth() + 1}/${dueDate.getDate()}/${dueDate.getFullYear()}`);
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

    $(document).on('change', '#checkModal #payee', function () {
        if ($(this).val() !== '' && $(this).val() !== null) {
            var split = $(this).val().split('-');

            switch (split[0]) {
                case 'vendor':
                    $.get(base_url + 'accounting/get-vendor-details/' + split[1], function (res) {
                        var vendor = JSON.parse(res);

                        var vendorName = '';
                        vendorName += vendor.title !== "" && vendor.title !== null ? vendor.title + " " : "";
                        vendorName += vendor.f_name !== "" && vendor.f_name !== null ? vendor.f_name + " " : "";
                        vendorName += vendor.m_name !== "" && vendor.m_name !== null ? vendor.m_name + " " : "";
                        vendorName += vendor.l_name !== "" && vendor.l_name !== null ? vendor.l_name + " " : "";
                        vendorName += vendor.suffix !== "" && vendor.suffix !== null ? vendor.suffix : "";
                        $('#checkModal #mailing_address').html(vendorName.trim());
                        if (vendorName.trim() !== '') {
                            $('#checkModal #mailing_address').append('\n');
                        }
                        var address = '';
                        address += vendor.street !== "" && vendor.street !== null && vendor.street !== 'Not Specified' ? vendor.street + '\n' : "";
                        address += vendor.city !== "" && vendor.city !== null && vendor.city !== 'Not Specified' ? vendor.city + ', ' : "";
                        address += vendor.state !== "" && vendor.state !== null && vendor.state !== 'Not Specified' ? vendor.state + ' ' : "";
                        address += vendor.zip !== "" && vendor.zip !== null && vendor.zip !== 'Not Specified' ? vendor.zip : "";

                        $('#checkModal #mailing_address').append(address.trim());
                    });
                    break;
                case 'customer':
                    $.get(base_url + 'accounting/get-customer-details/' + split[1], function (res) {
                        var customer = JSON.parse(res);

                        var customerName = '';
                        customerName += customer.first_name !== "" && customer.first_name !== null ? customer.first_name + " " : "";
                        customerName += customer.middle_name !== "" && customer.middle_name !== null ? customer.middle_name + " " : "";
                        customerName += customer.last_name !== "" && customer.last_name !== null ? customer.last_name : "";
                        $('#checkModal #mailing_address').html(customerName.trim());
                        if (customerName.trim() !== '') {
                            $('#checkModal #mailing_address').append('\n');
                        }
                        if (customer.business_name !== "" && customer.business_name !== null) {
                            $('#checkModal #mailing_address').append(customer.business_name);
                            $('#checkModal #mailing_address').append('\n');
                        }

                        var address = '';
                        address += customer.mail_add !== "" && customer.mail_add !== null && customer.mail_add !== "Not Specified" ? customer.mail_add + '\n' : "";
                        address += customer.city !== "" && customer.city !== null && customer.city !== 'Not Specified' ? customer.city + ', ' : "";
                        address += customer.state !== "" && customer.state !== null && customer.state !== 'Not Specified' ? customer.state + ' ' : "";
                        address += customer.zip_code !== "" && customer.zip_code !== null && customer.zip_code !== 'Not Specified' ? customer.zip_code + ' ' : "";
                        address += customer.country !== "" && customer.country !== null && customer.country !== 'Not Specified' ? customer.country : "";

                        $('#checkModal #mailing_address').append(address.trim());
                    });
                    break;
                case 'employee':
                    $.get('/accounting/get-employee-details/' + split[1], function (res) {
                        var employee = JSON.parse(res);

                        var employeeName = '';
                        employeeName += employee.FName !== "" && employee.FName !== null ? employee.FName + " " : "";
                        employeeName += employee.LName !== "" && employee.LName !== null ? employee.LName : "";
                        $('#checkModal #mailing_address').html(employeeName.trim());
                        if (employeeName.trim() !== '') {
                            $('#checkModal #mailing_address').append('\n');
                        }
                        var address = '';
                        address += employee.address !== "" && employee.address !== null ? employee.address + '\n' : "";
                        address += employee.city !== "" && employee.city !== null ? employee.city + ', ' : "";
                        address += employee.state !== "" && employee.state !== null ? employee.state + ' ' : "";
                        address += employee.postal_code !== "" && employee.postal_code !== null ? employee.postal_code : "";

                        $('#checkModal #mailing_address').append(address.trim());
                    });
                    break;
            }
        }
    });

    $(document).on('change', '#purchaseOrderModal #vendor, #billModal #vendor, #vendorCreditModal #vendor', function () {
        var modalId = $('#modal-container form .modal').attr('id');
        $.get(base_url + 'accounting/get-vendor-details/' + $(this).val(), function (res) {
            var vendor = JSON.parse(res);

            $(`#${modalId} #email`).val(vendor.email);

            var vendorName = '';
            vendorName += vendor.title !== "" && vendor.title !== null ? vendor.title + " " : "";
            vendorName += vendor.f_name !== "" && vendor.f_name !== null ? vendor.f_name + " " : "";
            vendorName += vendor.m_name !== "" && vendor.m_name !== null ? vendor.m_name + " " : "";
            vendorName += vendor.l_name !== "" && vendor.l_name !== null ? vendor.l_name + " " : "";
            vendorName += vendor.suffix !== "" && vendor.suffix !== null ? vendor.suffix : "";
            $(`#${modalId} #mailing_address`).html(vendorName.trim());
            if (vendorName.trim() !== '') {
                $(`#${modalId} #mailing_address`).append('\n');
            }
            var address = '';
            address += vendor.street !== "" && vendor.street !== null && vendor.street !== "Not Specified" ? vendor.street + '\n' : "";
            address += vendor.city !== "" && vendor.city !== null && vendor.city !== "Not Specified" ? vendor.city + ', ' : "";
            address += vendor.state !== "" && vendor.state !== null && vendor.state !== "Not Specified" ? vendor.state + ' ' : "";
            address += vendor.zip !== "" && vendor.zip !== null && vendor.zip !== "Not Specified" ? vendor.zip : "";

            $(`#${modalId} #mailing_address`).append(address.trim());
        });
    });

    $(document).on('change', '#purchaseOrderModal #customer', function () {
        $.get(base_url + 'accounting/get-customer-details/' + $(this).val(), function (res) {
            var customer = JSON.parse(res);

            var customerName = '';
            customerName += customer.first_name !== "" ? customer.first_name + " " : "";
            customerName += customer.middle_name !== "" ? customer.middle_name + " " : "";
            customerName += customer.last_name !== "" ? customer.last_name : "";
            $('#purchaseOrderModal #shipping_address').html(customerName.trim());
            if (customerName.trim() !== '') {
                $('#purchaseOrderModal #shipping_address').append('\n');
            }
            if (customer.business_name !== "" && customer.business_name !== null) {
                $('#purchaseOrderModal #shipping_address').append(customer.business_name);
                $('#purchaseOrderModal #shipping_address').append('\n');
            }

            var address = '';
            address += customer.mail_add !== "" && customer.mail_add !== null ? customer.mail_add + '\n' : "";
            address += customer.city !== "" && customer.city !== null ? customer.city + ', ' : "";
            address += customer.state !== "" && customer.state !== null ? customer.state + ' ' : "";
            address += customer.zip_code !== "" && customer.zip_code !== null ? customer.zip_code + ' ' : "";
            address += customer.country !== "" && customer.country !== null ? customer.country : "";

            $('#purchaseOrderModal #shipping_address').append(address);
        });
    });

    $(document).on('change', '#payBillsModal #bills-table .payment-amount, #payBillsModal #bills-table .credit-applied', function () {
        if ($(this).hasClass('payment-amount')) {
            var row = $(this).closest('tr');
            var payment = $(this).val();
            var creditApplied = row.find('input.credit-applied');
            creditApplied = creditApplied.length > 0 && creditApplied.val() !== '' ? parseFloat(creditApplied.val()) : 0.00;
        } else {
            var row = $(this).closest('tr');
            var rowData = row.data();
            var balance = parseFloat(row.find('td:nth-child(5)').html());
            var paymentAmount = row.find('input.payment-amount');
            var totalVCredit = parseFloat(rowData.vcredits);
            var creditApplied = parseFloat($(this).val());
            var availableCredit = parseFloat(row.find('.available-credit').html().trim());

            if (creditApplied > availableCredit) {
                row.find('input.payment-amount').val(balance.toFixed(2));
                $(this).val('');
                var payment = balance;
                var creditApplied = 0.00;
            } else {
                var payment = parseFloat(balance - creditApplied).toFixed(2);
                paymentAmount.val(payment);
                paymentAmount = payment;

                var totalCreditApplied = 0.00;
                $(`#payBillsModal #bills-table tr[data-payeeid="${rowData.payeeid}"]`).each(function () {
                    var rowCreditApplied = $(this).find('.credit-applied').val() === '' ? 0.00 : parseFloat($(this).find('.credit-applied').val());
                    totalCreditApplied += rowCreditApplied;
                });
                var remaining_vcredit = totalVCredit - totalCreditApplied;

                $(`#payBillsModal #bills-table tr[data-payeeid="${rowData.payeeid}"] .available-credit`).html(parseFloat(remaining_vcredit).toFixed(2));
            }
        }

        var total = parseFloat(payment) + parseFloat(creditApplied);

        row.find('td:last-child span').html(formatter.format(parseFloat(total)));

        if (parseFloat(total) > 0) {
            row.find('input[type="checkbox"]').prop('checked', true);
            if ($('#payBillsModal #bills-table tbody tr:visible input.select-one:checked').length === $('#payBillsModal #bills-table tbody tr:visible').length) {
                $('#payBillsModal #bills-table thead input.select-all').prop('checked', true);
            }
        } else {
            row.find('input[type="checkbox"]').prop('checked', false);
            $('#payBillsModal #bills-table thead input.select-all').prop('checked', false);
        }

        computeBillsPaymentTotal();
    });

    $(document).on('change', '#payBillsModal #bills-table tbody input.select-one', function () {
        if ($(this).prop('checked')) {
            var openBal = $(this).closest('tr').find('td:nth-child(5)').html();
            $(this).closest('tr').find('input.payment-amount').val(openBal);
            openBal = '$' + openBal;
            $(this).closest('tr').find('td:last-child').children().html(openBal.replace('$-', '-$'));
        } else {
            $(this).closest('tr').find('input.payment-amount').val('');
            $(this).closest('tr').find('td:last-child').children().html('$0.00');
        }

        if ($('#payBillsModal #bills-table tbody tr:visible input.select-one:checked').length === $('#payBillsModal #bills-table tbody tr:visible').length) {
            $('#payBillsModal #bills-table thead tr input.select-all').prop('checked', true);
        } else {
            $('#payBillsModal #bills-table thead tr input.select-all').prop('checked', false);
        }

        computeBillsPaymentTotal();
    });

    $(document).on('change', '#payBillsModal #bills-table input.select-all', function () {
        var isChecked = $(this).prop('checked');

        $('#payBillsModal #bills-table tbody tr input.select-one').each(function () {
            $(this).prop('checked', isChecked);
            $(this).trigger('change');
        });
    });

    $(document).on('change', '#payBillsModal #due_date', function () {
        switch ($(this).val()) {
            case 'last-365-days':
                var date = new Date();
                date.setDate(date.getDate() - 365);

                var from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
                var to_date = '';
                break;
            case 'custom':
                var from_date = $('#payBillsModal #from').val();
                var to_date = $('#payBillsModal #to').val();
                break;
            case 'today':
                var date = new Date();
                var from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
                var to_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
                break;
            case 'yesterday':
                var date = new Date();
                date.setDate(date.getDate() - 1);
                var from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
                var to_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
                break;
            case 'this-week':
                var date = new Date();
                var from = date.getDate() - date.getDay();
                var to = from + 6;

                var from_date = new Date(date.setDate(from));
                var to_date = new Date(date.setDate(to));

                from_date = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
                to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
                break;
            case 'this-month':
                var date = new Date();
                var to_date = new Date(date.getFullYear(), date.getMonth() + 1, 0);

                from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
                to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
                break;
            case 'this-quarter':
                var date = new Date();
                var currQuarter = Math.floor(date.getMonth() / 3 + 1);

                switch (currQuarter) {
                    case 1:
                        var from_date = '01/01/' + date.getFullYear();
                        var to_date = '03/31/' + date.getFullYear();
                        break;
                    case 2:
                        var from_date = '04/01/' + date.getFullYear();
                        var to_date = '06/30/' + date.getFullYear();
                        break;
                    case 3:
                        var from_date = '07/01/' + date.getFullYear();
                        var to_date = '09/30/' + date.getFullYear();
                        break;
                    case 4:
                        var from_date = '10/01/' + date.getFullYear();
                        var to_date = '12/31/' + date.getFullYear();
                        break;
                }
                break;
            case 'this-year':
                var date = new Date();

                var from_date = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
                var to_date = String(12).padStart(2, '0') + '/' + String(31).padStart(2, '0') + '/' + date.getFullYear();
                break;
            case 'last-week':
                var date = new Date();
                var from = date.getDate() - date.getDay();

                var from_date = new Date(date.setDate(from - 7));
                var to_date = new Date(date.setDate(date.getDate() + 6));

                from_date = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
                to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
                break;
            case 'last-month':
                var date = new Date();
                var to_date = new Date(date.getFullYear(), date.getMonth(), 0);

                from_date = String(date.getMonth()).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
                to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
                break;
            case 'last-quarter':
                var date = new Date();
                var currQuarter = Math.floor(date.getMonth() / 3 + 1);

                switch (currQuarter) {
                    case 1:
                        var from_date = new Date('01/01/' + date.getFullYear());
                        var to_date = new Date('03/31/' + date.getFullYear());
                        break;
                    case 2:
                        var from_date = new Date('04/01/' + date.getFullYear());
                        var to_date = new Date('06/30/' + date.getFullYear());
                        break;
                    case 3:
                        var from_date = new Date('07/01/' + date.getFullYear());
                        var to_date = new Date('09/30/' + date.getFullYear());
                        break;
                    case 4:
                        var from_date = new Date('10/01/' + date.getFullYear());
                        var to_date = new Date('12/31/' + date.getFullYear());
                        break;
                }

                from_date.setMonth(from_date.getMonth() - 3);
                to_date.setMonth(to_date.getMonth() - 3);

                if (to_date.getDate() === 1) {
                    to_date.setDate(to_date.getDate() - 1);
                }

                from_date = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
                to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
                break;
            case 'last-year':
                var date = new Date();
                date.setFullYear(date.getFullYear() - 1);

                var from_date = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
                var to_date = String(12).padStart(2, '0') + '/' + String(31).padStart(2, '0') + '/' + date.getFullYear();
                break;
            default:
                var from_date = '';
                var to_date = '';
                break;
        }

        $('#payBillsModal #from').val(from_date);
        $('#payBillsModal #to').val(to_date);
    });

    $(document).on('change', '#payBillsModal #from, #payBillsModal #to', function () {
        $('#payBillsModal #due_date').val('custom').trigger('change');
    });

    $(document).on('change', '#expenseModal #payee', function () {
        if ($(this).val() !== '' && $(this).val() !== null && $(this).val() !== 'add-new' && $('#expenseModal #templateName').length < 1) {
            var split = $(this).val().split('-');
            unlinkTransaction();

            if (split[0] === 'vendor') {
                $.get('/accounting/get-linkable-transactions/expense/' + split[1], function (res) {
                    var transactions = JSON.parse(res);

                    if (transactions.length > 0) {
                        if ($('#expenseModal .attachments-container').length > 0) {
                            $('#expenseModal .attachments-container').parent().parent().remove();
                        }

                        if ($('#expenseModal .transactions-container').length > 0) {
                            $('#expenseModal .transactions-container').parent().remove();
                            $('#expenseModal .close-transactions-container').parent().remove();
                            $('#expenseModal .open-transactions-container').parent().remove();
                        }

                        $('#expenseModal .modal-body .row .col').children('.row:first-child').prepend(`
                            <div class="col-12">
                                <button class="nsm-button close-transactions-container float-end" type="button"><i class="bx bx-fw bx-chevron-right"></i></button>
                            </div>
                        `);

                        $('#expenseModal .modal-body').children('.row').append(`
                            <div class="nsm-callout primary" style="width: 15%">
                                <div class="transactions-container h-100 p-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>Add to Expense</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `);

                        $.each(transactions, function (index, transaction) {
                            var title = transaction.type;
                            title += transaction.number !== '' ? ' #' + transaction.number : '';
                            if ($(`#expenseModal input[name="linked_transaction[]"][value="${transaction.data_type.replace('-', '_')}-${transaction.id}"]`).length < 1) {
                                $('#expenseModal .modal-body .row .nsm-callout .transactions-container .row').append(`
                                    <div class="col-12 grid-mb">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">${title}</h5>
                                                <p class="card-subtitle">${transaction.formatted_date}</p>
                                                <p class="card-text">
                                                    ${transaction.type === 'Purchase Order' ? `<strong>Total</strong>&emsp;${transaction.total}<br><strong>Balance</strong>&emsp;${transaction.balance}` : transaction.amount}
                                                </p>
                                                <ul class="d-flex justify-content-around list-unstyled">
                                                    <li><a href="#" class="add-transaction text-decoration-none" data-id="${transaction.id}" data-type="${transaction.data_type}"><strong>Add</strong></a></li>
                                                    <li><a href="#" class="open-transaction text-decoration-none" data-id="${transaction.id}" data-type="${transaction.data_type}">Open</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                `);
                            }
                        });

                        if ($('#expenseModal .transactions-container .row .col-12').length < 2) {
                            $('#expenseModal .close-transactions-container').trigger('click');
                        }
                    } else {
                        $('#expenseModal .transactions-container').parent().remove();
                        $('#expenseModal .close-transactions-container').parent().remove();
                        $('#expenseModal .open-transactions-container').parent().remove();
                    }
                });
            }
        } else {
            $('#expenseModal .transactions-container').parent().remove();
            $('#expenseModal .close-transactions-container').parent().remove();
            $('#expenseModal .open-transactions-container').parent().remove();
        }
    });

    $(document).on('change', '#checkModal #payee', function () {
        if ($(this).val() !== '' && $(this).val() !== null && $(this).val() !== 'add-new' && $('#checkModal #templateName').length < 1) {
            var split = $(this).val().split('-');
            unlinkTransaction();

            if (split[0] === 'vendor') {
                $.get('/accounting/get-linkable-transactions/check/' + split[1], function (res) {
                    var transactions = JSON.parse(res);

                    if (transactions.length > 0) {
                        if ($('#checkModal .attachments-container').length > 0) {
                            $('#checkModal .attachments-container').parent().parent().remove();
                        }

                        if ($('#checkModal .transactions-container').length > 0) {
                            $('#checkModal .transactions-container').parent().remove();
                            $('#checkModal .close-transactions-container').parent().remove();
                            $('#checkModal .open-transactions-container').parent().remove();
                        }

                        $('#checkModal .modal-body .row .col').children('.row:first-child').prepend(`
                            <div class="col-12">
                                <button class="nsm-button close-transactions-container float-end" type="button"><i class="bx bx-fw bx-chevron-right"></i></button>
                            </div>
                        `);

                        $('#checkModal .modal-body').children('.row').append(`
                            <div class="nsm-callout primary" style="width: 15%">
                                <div class="transactions-container h-100 p-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>Add to Check</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `);

                        $.each(transactions, function (index, transaction) {
                            var title = transaction.type;
                            title += transaction.number !== '' ? '#' + transaction.number : '';
                            if ($(`#checkModal input[name="linked_transaction[]"][value="${transaction.data_type.replace('-', '_')}-${transaction.id}"]`).length < 1) {
                                $('#checkModal .modal-body .row .nsm-callout .transactions-container .row').append(`
                                    <div class="col-12 grid-mb">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">${title}</h5>
                                                <p class="card-subtitle">${transaction.formatted_date}</p>
                                                <p class="card-text">
                                                    ${transaction.type === 'Purchase Order' ? `<strong>Total</strong>&emsp;${transaction.total}<br><strong>Balance</strong>&emsp;${transaction.balance}` : transaction.amount}
                                                </p>
                                                <ul class="d-flex justify-content-around list-unstyled">
                                                    <li><a href="#" class="add-transaction text-decoration-none" data-id="${transaction.id}" data-type="${transaction.data_type}"><strong>Add</strong></a></li>
                                                    <li><a href="#" class="open-transaction text-decoration-none" data-id="${transaction.id}" data-type="${transaction.data_type}">Open</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                `);
                            }
                        });

                        if ($('#checkModal .transactions-container .row .col-12').length < 2) {
                            $('#checkModal .close-transactions-container').trigger('click');
                        }
                    } else {
                        $('#checkModal .transactions-container').parent().remove();
                        $('#checkModal .close-transactions-container').parent().remove();
                        $('#checkModal .open-transactions-container').parent().remove();
                    }
                });
            }
        } else {
            $('#checkModal .transactions-container').parent().remove();
            $('#checkModal .close-transactions-container').parent().remove();
            $('#checkModal .open-transactions-container').parent().remove();
        }
    });

    $(document).on('change', '#billModal #vendor', function () {
        if ($(this).val() !== '' && $(this).val() !== null && $(this).val() !== 'add-new' && $('#billModal #templateName').length < 1) {
            unlinkTransaction();

            $.get('/accounting/get-linkable-transactions/bill/' + $(this).val(), function (res) {
                var transactions = JSON.parse(res);

                if (transactions.length > 0) {
                    if ($('#billModal .attachments-container').length > 0) {
                        $('#billModal .attachments-container').parent().parent().remove();
                    }

                    if ($('#billModal .transactions-container').length > 0) {
                        $('#billModal .transactions-container').parent().remove();
                        $('#billModal .close-transactions-container').parent().remove();
                        $('#billModal .open-transactions-container').parent().remove();
                    }

                    $('#billModal .modal-body .row .col').children('.row:first-child').prepend(`
                        <div class="col-12">
                            <button class="nsm-button close-transactions-container float-end" type="button"><i class="bx bx-fw bx-chevron-right"></i></button>
                        </div>
                    `);

                    $('#billModal .modal-body').children('.row').append(`
                        <div class="nsm-callout primary" style="width: 15%">
                            <div class="transactions-container h-100 p-3">
                                <div class="row">
                                    <div class="col-12">
                                        <h4>Add to Bill</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);

                    $.each(transactions, function (index, transaction) {
                        var title = transaction.type;
                        title += transaction.number !== '' ? '#' + transaction.number : '';
                        if ($(`#billModal input[name="linked_transaction[]"][value="${transaction.data_type.replace('-', '_')}-${transaction.id}"]`).length < 1) {
                            $('#billModal .modal-body .row .nsm-callout .transactions-container .row').append(`
                                <div class="col-12 grid-mb">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">${title}</h5>
                                            <p class="card-subtitle">${transaction.formatted_date}</p>
                                            <p class="card-text">
                                                ${transaction.type === 'Purchase Order' ? `<strong>Total</strong>&emsp;${transaction.total}<br><strong>Balance</strong>&emsp;${transaction.balance}` : transaction.amount}
                                            </p>
                                            <ul class="d-flex justify-content-around list-unstyled">
                                                <li><a href="#" class="add-transaction text-decoration-none" data-id="${transaction.id}" data-type="${transaction.data_type}"><strong>Add</strong></a></li>
                                                <li><a href="#" class="open-transaction text-decoration-none" data-id="${transaction.id}" data-type="${transaction.data_type}">Open</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            `);
                        }
                    });

                    if ($('#billModal .transactions-container .row .col-12').length < 2) {
                        $('#billModal .close-transactions-container').trigger('click');
                    }
                } else {
                    $('#billModal .transactions-container').parent().remove();
                    $('#billModal .close-transactions-container').parent().remove();
                    $('#billModal .open-transactions-container').parent().remove();
                }
            });
        } else {
            $('#billModal .transactions-container').parent().remove();
            $('#billModal .close-transactions-container').parent().remove();
            $('#billModal .open-transactions-container').parent().remove();
        }
    });

    $(document).on('change', '#billPaymentModal #vendor', function () {
        if ($(this).val() !== '' && $(this).val() !== null && $(this).val() !== 'add-new') {
            unlinkTransaction();

            loadBills();
            loadVCredits();

            get_bill_payment_linkable_transactions();
        } else {
            $('#billPaymentModal .transactions-container').parent().remove();
            $('#billPaymentModal .close-transactions-container').parent().remove();
            $('#billPaymentModal .open-transactions-container').parent().remove();
        }
    });

    $(document).on('change', '#billPaymentModal #print_later', function () {
        if ($(this).prop('checked')) {
            $('#billPaymentModal #ref_no').val('To print').prop('disabled', true).trigger('change');
        } else {
            $('#billPaymentModal #ref_no').val('').prop('disabled', false).trigger('change');
        }
    });

    $(document).on('change', '#billPaymentModal #ref_no', function () {
        if ($(this).val() !== "") {
            $('#billPaymentModal .modal-title').html(' Bill Payment #' + $(this).val());
        } else {
            $('#billPaymentModal .modal-title').html(' Bill Payment');
        }
    });

    $(document).on('click', '#modal-container .modal .transactions-container a.add-transaction', function (e) {
        e.preventDefault();
        var data = e.currentTarget.dataset;

        switch (data.type) {
            case 'purchase-order':
                $.get(`/accounting/get-transaction-details/${data.type}/${data.id}`, function (res) {
                    var result = JSON.parse(res);
                    var categories = result.categories;
                    var items = result.items;
                    var details = result.details;

                    var count = 0;

                    var dataType = data.type.replace('-', ' ').replace(/(?:^|\s)\S/g, function (a) { return a.toUpperCase(); });
                    var date = new Date(details.purchase_order_date);
                    var dateString = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
                    var remainingBalance = '$' + parseFloat(details.remaining_balance).toFixed(2);

                    if ($('#modal-container .modal #linked-transaction').length < 1) {
                        $('<td></td>').insertBefore($('#modal-container .modal table#category-details-table thead tr td:last-child'));
                        $('<td></td>').insertBefore($('#modal-container .modal table#item-details-table thead tr td:last-child'));

                        $('#modal-container .modal table#category-details-table tbody tr').each(function () {
                            if ($(this).find('select').length === 0) {
                                $(this).remove();
                            } else {
                                $('<td></td>').insertBefore($(this).find('td:last-child'));
                                count++;
                            }
                        });
                    }

                    if (categories.length > 0) {
                        $.each(categories, function (index, category) {
                            var link = `
                            <td class="overflow-visible">
                                <div class="dropdown">
                                    <a href="#" class="text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bx bx-fw bx-link"></i></a>
                                    <div class="dropdown-menu">
                                        <table class="nsm-table linked-transaction-table">
                                            <thead>
                                                <tr class="linked-transaction-header">
                                                    <td data-name="Type">Type</td>
                                                    <td data-name="Date">Date</td>
                                                    <td data-name="Amount">Amount</td>
                                                    <td data-name="Action"></td>
                                                </tr>
                                            </thead>
                                            <tbody class="linked-transaction-table-body">
                                                <tr class="linked-transaction-row">
                                                    <td><a class="text-decoration-none open-transaction" href="#" data-id="${data.id}" data-type="${data.type}">${dataType}</a></td>
                                                    <td>${dateString}</td>
                                                    <td>${remainingBalance.replace('$-', '-$')}</td>
                                                    <td><button class="nsm-button unlink-transaction" data-type="${data.type}" data-id="${data.id}">Remove</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <input type="hidden" value="${data.type.replace('-', '_') + '-' + details.id}" name="category_linked_transaction[]">
                                <input type="hidden" value="${category.id}" name="transaction_category_id[]">
                            </td>
                            `;

                            count++;
                            var fields = `
                                <td>${count}</td>
                                <td><select name="expense_account[]" class="nsm-field form-control" required=""><option value="${category.expense_account_id}">${category.expense_account}</option></select></td>
                                <td>
                                    <select name="category[]" class="nsm-field form-control">
                                        <option disabled="" selected="">&nbsp;</option>
                                        <option value="fixed">Fixed Cost</option>
                                        <option value="variable">Variable Cost</option>
                                        <option value="periodic">Periodic Cost</option>
                                    </select>
                                </td>
                                <td><input type="text" name="description[]" class="nsm-field form-control" value="${category.description}"></td>
                                <td><input type="number" name="category_amount[]" onchange="convertToDecimal(this)" class="nsm-field form-control text-end" step=".01" value="${parseFloat(category.amount).toFixed(2)}"></td>
                                <td>
                                    <div class="table-row-icon table-checkbox">
                                        <input class="form-check-input table-select" name="category_billable[]" type="checkbox" value="1" ${category.billable === "1" ? 'checked' : ''}>
                                    </div>
                                </td>
                                <td>
                                    <input type="number" name="category_markup[]" class="nsm-field form-control" onchange="convertToDecimal(this)" value="${parseFloat(category.markup_percentage).toFixed(2)}">
                                </td>
                                <td>
                                    <div class="table-row-icon table-checkbox">
                                        <input class="form-check-input table-select" name="category_tax[]" type="checkbox" value="1" ${category.tax === "1" ? 'checked' : ''}>
                                    </div>
                                </td>
                                <td><select name="category_customer[]" class="nsm-field form-control"><option value="${category.customer_id}">${category.customer_name}</option></select></td>
                                ${link}
                                <td><button type="button" class="nsm-button delete-row"><i class='bx bx-fw bx-trash'></i></button></td>
                            `;

                            $('#modal-container .modal table#category-details-table tbody').append(`<tr>${fields}</tr>`);
                        });

                        $('#modal-container .modal table#category-details-table tbody tr:last-child select').each(function () {
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
                                        url: base_url + 'accounting/get-dropdown-choices',
                                        dataType: 'json',
                                        data: function (params) {
                                            var query = {
                                                search: params.term,
                                                type: 'public',
                                                field: type,
                                                modal: $('#modal-container form .modal').attr('id')
                                            }

                                            // Query parameters will be ?search=[term]&type=public
                                            return query;
                                        }
                                    },
                                    templateResult: formatResult,
                                    templateSelection: optionSelect,
                                    dropdownParent: $('#modal-container form .modal')
                                });
                            } else {
                                $(this).select2({
                                    minimumResultsForSearch: -1,
                                    dropdownParent: $('#modal-container form .modal')
                                });
                            }
                        });
                    }

                    if ($('#modal-container .modal #category-details-table tbody:not(.linked-transaction-table-body) tr:not(.linked-transaction-row, .linked-transaction-header').length < rowCount) {
                        var currentCount = $('#modal-container .modal #category-details-table tbody tr:not(.linked-transaction-row, .linked-transaction-header').length;

                        do {
                            $('#modal-container .modal #category-details-table tbody:not(.linked-transaction-table-body)').append(`<tr>${catDetailsBlank}</tr>`);

                            $('<td></td>').insertBefore('#modal-container .modal #category-details-table tbody:not(.linked-transaction-table-body) tr:last-child:not(.linked-transaction-row, .linked-transaction-header) td:last-child');

                            currentCount++;
                        } while (currentCount < rowCount);
                    }

                    if (items.length > 0) {
                        if ($('#modal-container .modal #collapse-item-details').hasClass('show') === false) {
                            $('#modal-container .modal #collapse-item-details').collapse('toggle');
                        }

                        $.each(items, function (index, item) {
                            var locs = '';
                            for (var i in item.locations) {
                                locs += `<option value="${item.locations[i].id}" data-quantity="${item.locations[i].qty === "null" ? 0 : item.locations[i].qty}" ${item.locations[i].id === item.location_id ? 'selected' : ''}>${item.locations[i].name}</option>`;
                            }

                            if ($('#modal-container form .modal').attr('id') === 'creditCardCreditModal' || $('#modal-container form .modal').attr('id') === 'vendorCreditModal') {
                                var qtyField = `<input type="number" name="quantity[]" class="form-control nsm-field text-end" required value="${item.quantity}" max="${item.locations[0].qty}">`;
                            } else {
                                var qtyField = `<input type="number" name="quantity[]" class="form-control nsm-field text-end" required value="${item.quantity}">`;
                            }

                            var link = `
                            <td class="overflow-visible">
                                <div class="dropdown">
                                    <a href="#" class="text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bx bx-fw bx-link"></i></a>
                                    <div class="dropdown-menu">
                                        <table class="nsm-table linked-transaction-table">
                                            <thead>
                                                <tr class="linked-transaction-header">
                                                    <td data-name="Type">Type</td>
                                                    <td data-name="Date">Date</td>
                                                    <td data-name="Amount">Amount</td>
                                                    <td data-name="Action"></td>
                                                </tr>
                                            </thead>
                                            <tbody class="linked-transaction-table-body">
                                                <tr class="linked-transaction-row">
                                                    <td><a class="text-decoration-none open-transaction" href="#" data-id="${data.id}" data-type="${data.type}">${dataType}</a></td>
                                                    <td>${dateString}</td>
                                                    <td>${remainingBalance.replace('$-', '-$')}</td>
                                                    <td><button class="nsm-button unlink-transaction" data-type="${data.type}" data-id="${data.id}">Remove</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <input type="hidden" value="${data.type.replace('-', '_') + '-' + details.id}" name="category_linked_transaction[]">
                                <input type="hidden" value="${category.id}" name="transaction_category_id[]">
                            </td>
                            `;

                            $('#modal-container .modal table#item-details-table tbody').append(`
                                <tr>
                                    <td>${item.details.title}<input type="hidden" name="item[]" value="${item.item_id}"></td>
                                    <td>Product</td>
                                    <td><select name="location[]" class="form-control nsm-field" required>${locs}</select></td>
                                    <td>${qtyField}</td>
                                    <td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="${parseFloat(item.rate).toFixed(2)}"></td>
                                    <td><input type="number" name="discount[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="${parseFloat(item.discount).toFixed(2)}"></td>
                                    <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="${parseFloat(item.tax).toFixed(2)}"></td>
                                    <td><span class="row-total">${formatter.format(parseFloat(item.total))}</span></td>
                                    ${link}
                                    <td><button type="button" class="nsm-button delete-row"><i class="bx bx-fw bx-trash"></i></button></td>
                                </tr>
                            `);

                            $('#modal-container form .modal #item-details-table tbody tr:last-child select').each(function () {
                                $(this).select2({
                                    minimumResultsForSearch: -1,
                                    dropdownParent: $('#modal-container form .modal')
                                });
                            });
                        });
                    }

                    computeTransactionTotal();

                    if ($('#modal-container .modal .close-transactions-container').length > 0) {
                        var button = $('#modal-container .modal .close-transactions-container');
                    } else {
                        var button = $('#modal-container .modal .open-transactions-container');
                    }

                    if ($('#modal-container .modal #linked-transaction').length > 0) {
                        $('#modal-container .modal #linked-transaction').next().find('table tbody').append(`<tr>
                            <td><a class="text-decoration-none open-transaction" href="#" data-id="${data.id}" data-type="${data.type}">${dataType}</a></td>
                            <td>${dateString}</td>
                            <td>${remainingBalance.replace('$-', '-$')}</td>
                            <td><button class="nsm-button unlink-transaction" data-type="${data.type}" data-id="${data.id}">Remove</button></td>
                        </tr>`);

                        var linkedCount = $('#modal-container .modal input[name="linked_transaction[]"]').length;

                        $('#modal-container .modal #linked-transaction').html(`${linkedCount + 1} linked Purchase Orders`);
                    } else {
                        button.parent().append(`
                            <div class="dropdown">
                                <a href="#" class="text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="linked-transaction">1 linked Purchase Order</a>
                                <div class="dropdown-menu">
                                    <table class="nsm-table">
                                        <thead>
                                            <tr>
                                                <td data-name="Type">Type</td>
                                                <td data-name="Date">Date</td>
                                                <td data-name="Amount">Amount</td>
                                                <td data-name="Action"></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><a class="text-decoration-none open-transaction" href="#" data-id="${data.id}" data-type="${data.type}">${dataType}</a></td>
                                                <td>${dateString}</td>
                                                <td>${remainingBalance.replace('$-', '-$')}</td>
                                                <td><button type="button" class="nsm-button unlink-transaction" data-type="${data.type}" data-id="${data.id}">Remove</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        `);
                    }

                    button.parent().append(`<input type="hidden" value="${data.type.replace('-', '_') + '-' + details.id}" name="linked_transaction[]">`);

                    if ($('#modal-container .modal .transactions-container .row div.col-12').length === 1) {
                        $('#modal-container .modal .transactions-container').parent().remove();
                        $('#modal-container .modal .close-transactions-container').remove();
                        $('#modal-container .modal .open-transactions-container').remove();
                    }
                });

                $(this).closest('.card').parent().remove();

                $('#modal-container form .modal .transactions-container .row div.col-12 .add-transaction[data-type="bill"]').each(function () {
                    $(this).closest('.card').parent().remove();
                });

                $('#modal-container form .modal .transactions-container .row div.col-12 .add-transaction[data-type="vendor-credit"]').each(function () {
                    $(this).closest('.card').parent().remove();
                });

                // if ($('#modal-container .modal .transactions-container .row div.col-12').length === 1) {
                //     $('#modal-container .modal .transactions-container').parent().remove();
                //     $('#modal-container .modal .close-transactions-container').remove();
                //     $('#modal-container .modal .open-transactions-container').remove();
                // }
                break;
            case 'bill':
                if ($('#modal-container form .modal').attr('id') !== 'billPaymentModal') {
                    var modalId = $('#modal-container form .modal').attr('id');
                    $('#modal-container form .modal').modal('hide');

                    $.get('/accounting/bill-payment-form/' + data.id, function (res) {
                        if ($('div#modal-container').length > 0) {
                            $('div#modal-container').html(res);
                        } else {
                            $('body').append(`
                                <div id="modal-container"> 
                                    ${res}
                                </div>
                            `);
                        }

                        if (modalId === 'expenseModal') {
                            $('#billPaymentModal #payment_account').prev().attr('for', 'expense_payment_account');
                            $('#billPaymentModal #payment_account').attr('id', 'expense_payment_account');
                        } else if (modalId === 'checkModal') {
                            $('#billPaymentModal #payment_account').prev().html('Bank account');
                            $('#billPaymentModal #payment_account').prev().attr('for', 'bank_account');
                            $('#billPaymentModal #payment_account').attr('id', 'bank_account');
                        }

                        initModalFields('billPaymentModal');

                        $('#billPaymentModal #bills-table').nsmPagination({
                            itemsPerPage: 150
                        });

                        $('#billPaymentModal #vendor-credits-table').nsmPagination({
                            itemsPerPage: 150
                        });

                        $('#billPaymentModal .dropdown-menu').on('click', function (e) {
                            e.stopPropagation();
                        });

                        $(`#billPaymentModal`).modal('show');
                    });
                } else {
                    if ($(`#billPaymentModal #bills-table input.select-one[value="${data.id}"]`).length > 0) {
                        var row = $(`#billPaymentModal #bills-table input.select-one[value="${data.id}"]`).closest('tr');
                        row.find('input.select-one').prop('checked', true);
                        row.find('input[name="bill_payment[]"]').val(row.find('td:nth-child(5)').html().trim());

                        $('#billPaymentModal #bills-table input.select-all').prop('checked', $('#billPaymentModal #bills-table input.select-one:checked').length === $('#billPaymentModal #bills-table tbody tr').length);
                    }

                    $(`#billPaymentModal #bills-table input.select-all`).prop('checked', $('#billPaymentModal #bills-table tbody input.select-one:checked').length === $('#billPaymentModal #bills-table tbody tr').length);

                    $(this).closest('.card').parent().remove();

                    if ($('#billPaymentModal .transactions-container .row div.col-12').length === 1) {
                        $('#billPaymentModal .transactions-container').parent().remove();
                        $('#billPaymentModal .close-transactions-container').parent().remove();
                        $('#billPaymentModal .open-transactions-container').parent().remove();
                    }
                }
                break;
            case 'vendor-credit':
                if ($('#modal-container form .modal').attr('id') === 'billPaymentModal') {
                    if ($(`#billPaymentModal #vendor-credits-table tr[data-type="vendor-credit"] input.select-one[value="${data.id}"]`).length > 0) {
                        $(`#billPaymentModal #vendor-credits-table tr[data-type="vendor-credit"] input.select-one[value="${data.id}"]`).prop('checked', true).trigger('change');
                    }

                    $(`#billPaymentModal #vendor-credits-table input.select-all`).prop('checked', $('#billPaymentModal #vendor-credits-table tbody input.select-one:checked').length === $('#billPaymentModal #vendor-credits-table tbody tr').length);

                    $(this).closest('.card').parent().remove();

                    if ($('#billPaymentModal .transactions-container .row div.col-12').length === 1) {
                        $('#billPaymentModal .transactions-container').parent().remove();
                        $('#billPaymentModal .close-transactions-container').parent().remove();
                        $('#billPaymentModal .open-transactions-container').parent().remove();
                    }
                } else {
                    Swal.fire({
                        text: "You must select a bill before adding a credit",
                        icon: 'warning',
                        showCloseButton: true,
                        confirmButtonColor: '#2ca01c',
                        confirmButtonText: 'OK',
                        timer: 2000
                    })
                }
                break;
            case 'bill-payment':
                if ($('#modal-container form .modal').attr('id') === 'billPaymentModal') {
                    if ($(`#billPaymentModal #vendor-credits-table tr[data-type="bill-payment"] input.select-one[value="${data.id}"]`).length > 0) {
                        $(`#billPaymentModal #vendor-credits-table tr[data-type="bill-payment"] input.select-one[value="${data.id}"]`).prop('checked', true).trigger('change');
                    }

                    $(`#billPaymentModal #vendor-credits-table input.select-all`).prop('checked', $('#billPaymentModal #vendor-credits-table tbody input.select-one:checked').length === $('#billPaymentModal #vendor-credits-table tbody tr').length);

                    $(this).closest('.card').parent().remove();

                    if ($('#billPaymentModal .transactions-container .row div.col-12').length === 1) {
                        $('#billPaymentModal .transactions-container').parent().remove();
                        $('#billPaymentModal .close-transactions-container').parent().remove();
                        $('#billPaymentModal .open-transactions-container').parent().remove();
                    }
                } else {
                    Swal.fire({
                        text: "You must select a bill before adding a credit",
                        icon: 'warning',
                        showCloseButton: true,
                        confirmButtonColor: '#2ca01c',
                        confirmButtonText: 'OK',
                        timer: 2000
                    })
                }
                break;
            case 'delayed-credit':
                $.get(`/accounting/get-transaction-details/${data.type}/${data.id}`, function (res) {
                    var result = JSON.parse(res);
                    var details = result.details;
                    var items = result.items;

                    if (items.length > 0) {
                        if ($('#modal-container form .modal #item-table thead tr td').length < 10) {
                            $('<td></td>').insertBefore($('#modal-container form .modal #item-table thead tr td:last-child'));
                        }

                        var dataType = data.type.replace('-', ' ').replace(/(?:^|\s)\S/g, function (a) { return a.toUpperCase(); });
                        var date = new Date(details.delayed_credit_date);
                        var dateString = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
                        var remainingBalance = '$' + parseFloat(details.remaining_balance).toFixed(2);

                        $.each(items, function (index, item) {
                            if (parseFloat(item.remaining_balance) > 0) {
                                var link = `
                                <td class="overflow-visible">
                                    <div class="dropdown">
                                        <a href="#" class="text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bx bx-fw bx-link"></i></a>
                                        <div class="dropdown-menu">
                                            <table class="nsm-table linked-transaction-table">
                                                <thead>
                                                    <tr class="linked-transaction-header">
                                                        <td data-name="Type">Type</td>
                                                        <td data-name="Date">Date</td>
                                                        <td data-name="Amount">Amount</td>
                                                        <td data-name="Action"></td>
                                                    </tr>
                                                </thead>
                                                <tbody class="linked-transaction-table-body">
                                                    <tr class="linked-transaction-row">
                                                        <td><a class="text-decoration-none open-transaction" href="#" data-id="${data.id}" data-type="${data.type}">${dataType}</a></td>
                                                        <td>${dateString}</td>
                                                        <td>${remainingBalance.replace('$-', '-$')}</td>
                                                        <td><button class="nsm-button unlink-transaction" data-type="${data.type}" data-id="${data.id}">Remove</button></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <input type="hidden" value="${data.type.replace('-', '_') + '-' + details.id}" name="item_linked_transaction[]">
                                    <input type="hidden" value="${item.id}" name="transaction_item_id[]">
                                </td>
                                `;

                                if (item.hasOwnProperty('itemDetails')) {
                                    var itemDetails = item.itemDetails;
                                    var locations = item.locations;
                                    var locs = '';
                                    if (itemDetails.type.toLowerCase() === 'product' || itemDetails.type.toLowerCase() === 'inventory') {
                                        locs += '<select name="location[]" class="form-control nsm-field" required>';
                                        for (var i in locations) {
                                            locs += `<option value="${locations[i].id}">${locations[i].name}</option>`;
                                        }
                                        locs += '</select>';
                                    }

                                    var type = itemDetails.type;

                                    var total = item.total;
                                    if (total.includes('-')) {
                                        total.replace('-', '');
                                    } else {
                                        total = '-' + total;
                                    }
                                    total = '$' + parseFloat(total).toFixed(2);

                                    var fields = `
                                        <td>${itemDetails.title}<input type="hidden" name="item[]" value="${itemDetails.id}"></td>
                                        <td>${type.charAt(0).toUpperCase() + type.slice(1)}</td>
                                        <td>${locs}</td>
                                        <td><input type="number" name="quantity[]" class="form-control nsm-field text-end" required value="-${item.quantity}"></td>
                                        <td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="${parseFloat(item.price).toFixed(2)}"></td>
                                        <td><input type="number" name="discount[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="${parseFloat(item.discount).toFixed(2)}"></td>
                                        <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="${parseFloat(item.tax).toFixed(2)}"></td>
                                        <td><span class="row-total">-${total.replace('$-', '-$')}</span></td>
                                        ${link}
                                        <td><button type="button" class="nsm-button delete-row"><i class='bx bx-fw bx-trash'></i></button></td>
                                    `;

                                    $('#modal-container form .modal #item-table tbody:not(#package-items-table, .linked-transaction-table-body)').append(`<tr>${fields}</tr>`);

                                    $('#modal-container form .modal #item-table tbody:not(#package-items-table) tr:last-child select').select2({
                                        minimumResultsForSearch: -1,
                                        dropdownParent: $('#modal-container form .modal')
                                    });
                                } else {
                                    var packageDetails = item.packageDetails;
                                    var packageContents = item.packageItems;

                                    var total = item.total;
                                    if (total.includes('-')) {
                                        total.replace('-', '');
                                    } else {
                                        total = '-' + total;
                                    }
                                    total = '$' + parseFloat(total).toFixed(2);

                                    var fields = `
                                        <td>${packageDetails.name}<input type="hidden" name="package[]" value="${packageDetails.id}"></td>
                                        <td>Package</td>
                                        <td></td>
                                        <td><input type="number" name="quantity[]" class="form-control nsm-field text-end" required value="-${item.quantity}"></td>
                                        <td><span class="item-amount">${parseFloat(item.price).toFixed(2)}</span></td>
                                        <td></td>
                                        <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="${parseFloat(item.tax).toFixed(2)}"></td>
                                        <td><span class="row-total">-${total.replace('$-', '-$')}</span></td>
                                        ${link}
                                        <td><button type="button" class="nsm-button delete-row"><i class='bx bx-fw bx-trash'></i></button></td>
                                    `;

                                    $('#modal-container form .modal #item-table tbody:not(#package-items-table)').append(`<tr class="package">${fields}</tr>`);

                                    var packageItems = `
                                        <td colspan="3">
                                            <table class="nsm-table">
                                                <thead>
                                                    <tr class="package-item-header">
                                                        <th>Item Name</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="package-items-table">`;

                                    for (var i in packageContents) {
                                        packageItems += `<tr class="package-item"><td>${packageContents[i].details.title}</td><td>${packageContents[i].quantity}</td><td>${parseFloat(packageContents[i].price).toFixed(2)}</td></tr>`;
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
                                        <td></td>
                                    `;

                                    $('#modal-container form .modal #item-table tbody:not(#package-items-table)').append(`<tr class="package-items">${packageItems}</tr>`);
                                }
                            }
                        });

                        $('#modal-container form .modal #item-table tbody:not(#package-items-table) tr:last-child input[name="quantity[]"]').trigger('change');
                    }

                    if ($('#modal-container .modal .close-transactions-container').length > 0) {
                        var button = $('#modal-container .modal .close-transactions-container');
                    } else {
                        var button = $('#modal-container .modal .open-transactions-container');
                    }

                    button.parent().append(`<input type="hidden" value="${data.type.replace('-', '_') + '-' + details.id}" name="linked_transaction[]">`);

                    if ($('#modal-container .modal #linked-transaction').length > 0) {
                        $('#modal-container .modal #linked-transaction').next().find('table tbody').append(`<tr>
                            <td><a class="text-decoration-none open-transaction" href="#" data-id="${data.id}" data-type="${data.type}">${dataType}</a></td>
                            <td>${dateString}</td>
                            <td>${remainingBalance.replace('$-', '-$')}</td>
                            <td><button class="nsm-button unlink-transaction" data-type="${data.type}" data-id="${data.id}">Remove</button></td>
                        </tr>`);


                        var linkedCount = $('#modal-container .modal input[name="linked_transaction[]"]').length;

                        $('#modal-container .modal #linked-transaction').html(`${linkedCount} linked transactions`);
                    } else {
                        button.parent().append(`
                            <div class="dropdown">
                                <a href="#" class="text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="linked-transaction">1 linked Credit</a>
                                <div class="dropdown-menu">
                                    <table class="nsm-table linked-transaction-table">
                                        <thead>
                                            <tr class="linked-transaction-header">
                                                <td data-name="Type">Type</td>
                                                <td data-name="Date">Date</td>
                                                <td data-name="Amount">Amount</td>
                                                <td data-name="Action"></td>
                                            </tr>
                                        </thead>
                                        <tbody class="linked-transaction-table-body">
                                            <tr class="linked-transaction-row">
                                                <td><a class="text-decoration-none open-transaction" href="#" data-id="${data.id}" data-type="${data.type}">${dataType}</a></td>
                                                <td>${dateString}</td>
                                                <td>${remainingBalance.replace('$-', '-$')}</td>
                                                <td><button type="button" class="nsm-button unlink-transaction" data-type="${data.type}" data-id="${data.id}">Remove</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        `);
                    }

                    if ($('#modal-container .modal .transactions-container .row div.col-12').length === 2) {
                        $('#modal-container .modal .transactions-container').parent().remove();
                        $('#modal-container .modal .close-transactions-container').remove();
                        $('#modal-container .modal .open-transactions-container').remove();
                    }
                });

                $(this).parent().parent().parent().parent().parent().remove();
                break;
            case 'delayed-charge':
                $.get(`/accounting/get-transaction-details/${data.type}/${data.id}`, function (res) {
                    var result = JSON.parse(res);
                    var details = result.details;
                    var items = result.items;

                    if (items.length > 0) {
                        if ($('#modal-container form .modal #item-table thead tr td').length < 10) {
                            $('<td></td>').insertBefore($('#modal-container form .modal #item-table thead tr td:last-child'));
                        }

                        var dataType = data.type.replace('-', ' ').replace(/(?:^|\s)\S/g, function (a) { return a.toUpperCase(); });
                        var date = new Date(details.delayed_charge_date);
                        var dateString = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
                        var remainingBalance = '$' + parseFloat(details.remaining_balance).toFixed(2);

                        $.each(items, function (index, item) {
                            if (parseFloat(item.remaining_balance) > 0) {
                                var link = `
                                <td class="overflow-visible">
                                    <div class="dropdown">
                                        <a href="#" class="text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bx bx-fw bx-link"></i></a>
                                        <div class="dropdown-menu">
                                            <table class="nsm-table linked-transaction-table">
                                                <thead>
                                                    <tr class="linked-transaction-header">
                                                        <td data-name="Type">Type</td>
                                                        <td data-name="Date">Date</td>
                                                        <td data-name="Amount">Amount</td>
                                                        <td data-name="Action"></td>
                                                    </tr>
                                                </thead>
                                                <tbody class="linked-transaction-table-body">
                                                    <tr class="linked-transaction-row">
                                                        <td><a class="text-decoration-none open-transaction" href="#" data-id="${data.id}" data-type="${data.type}">${dataType}</a></td>
                                                        <td>${dateString}</td>
                                                        <td>${remainingBalance.replace('$-', '-$')}</td>
                                                        <td><button class="nsm-button unlink-transaction" data-type="${data.type}" data-id="${data.id}">Remove</button></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <input type="hidden" value="${data.type.replace('-', '_') + '-' + details.id}" name="item_linked_transaction[]">
                                    <input type="hidden" value="${item.id}" name="transaction_item_id[]">
                                </td>
                                `;

                                if (item.hasOwnProperty('itemDetails')) {
                                    var itemDetails = item.itemDetails;
                                    var locations = item.locations;
                                    var locs = '';
                                    if (itemDetails.type.toLowerCase() === 'product' || itemDetails.type.toLowerCase() === 'inventory') {
                                        locs += '<select name="location[]" class="form-control nsm-field" required>';
                                        for (var i in locations) {
                                            locs += `<option value="${locations[i].id}">${locations[i].name}</option>`;
                                        }
                                        locs += '</select>';
                                    }

                                    var type = itemDetails.type;

                                    var price = item.price;

                                    var total = item.total;
                                    total = '$' + parseFloat(total).toFixed(2);

                                    var fields = `
                                        <td>${itemDetails.title}<input type="hidden" name="item[]" value="${itemDetails.id}"></td>
                                        <td>${type.charAt(0).toUpperCase() + type.slice(1)}</td>
                                        <td>${locs}</td>
                                        <td><input type="number" name="quantity[]" class="form-control nsm-field text-end" required value="${item.quantity}"></td>
                                        <td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="${parseFloat(item.price).toFixed(2)}"></td>
                                        <td><input type="number" name="discount[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="${parseFloat(item.discount).toFixed(2)}"></td>
                                        <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="${parseFloat(item.tax).toFixed(2)}"></td>
                                        <td><span class="row-total">${total.replace('$-', '-$')}</span></td>
                                        ${link}
                                        <td><button type="button" class="nsm-button delete-row"><i class='bx bx-fw bx-trash'></i></button></td>
                                    `;

                                    $('#modal-container form .modal #item-table tbody:not(#package-items-table, .linked-transaction-table-body)').append(`<tr>${fields}</tr>`);

                                    $('#modal-container form .modal #item-table tbody:not(#package-items-table) tr:last-child select').select2({
                                        minimumResultsForSearch: -1,
                                        dropdownParent: $('#modal-container form .modal')
                                    });
                                } else {
                                    var packageDetails = item.packageDetails;
                                    var packageContents = item.packageItems;

                                    var price = item.price;

                                    if (price.includes('-')) {
                                        price.replace('-', '');
                                    } else {
                                        price = '-' + price;
                                    }

                                    var total = item.total;
                                    total = '$' + parseFloat(total).toFixed(2);

                                    var fields = `
                                        <td>${packageDetails.name}<input type="hidden" name="package[]" value="${packageDetails.id}"></td>
                                        <td>Package</td>
                                        <td></td>
                                        <td><input type="number" name="quantity[]" class="form-control nsm-field text-end" required value="-${item.quantity}"></td>
                                        <td><span class="item-amount">${parseFloat(item.price).toFixed(2)}</span></td>
                                        <td></td>
                                        <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="${parseFloat(item.tax).toFixed(2)}"></td>
                                        <td><span class="row-total">${total.replace('$-', '-$')}</span></td>
                                        ${link}
                                        <td><button type="button" class="nsm-button delete-row"><i class='bx bx-fw bx-trash'></i></button></td>
                                    `;

                                    $('#modal-container form .modal #item-table tbody:not(#package-items-table)').append(`<tr class="package">${fields}</tr>`);

                                    var packageItems = `
                                        <td colspan="3">
                                            <table class="nsm-table">
                                                <thead>
                                                    <tr class="package-item-header">
                                                        <th>Item Name</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="package-items-table">`;

                                    for (var i in packageContents) {
                                        packageItems += `<tr class="package-item"><td>${packageContents[i].details.title}</td><td>${packageContents[i].quantity}</td><td>${parseFloat(packageContents[i].price).toFixed(2)}</td></tr>`;
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
                                        <td></td>
                                    `;

                                    $('#modal-container form .modal #item-table tbody:not(#package-items-table)').append(`<tr class="package-items">${packageItems}</tr>`);
                                }
                            }
                        });

                        $('#modal-container form .modal #item-table tbody:not(#package-items-table) tr:last-child input[name="quantity[]"]').trigger('change');
                    }

                    if ($('#modal-container .modal .close-transactions-container').length > 0) {
                        var button = $('#modal-container .modal .close-transactions-container');
                    } else {
                        var button = $('#modal-container .modal .open-transactions-container');
                    }

                    button.parent().append(`<input type="hidden" value="${data.type.replace('-', '_') + '-' + details.id}" name="linked_transaction[]">`);

                    if ($('#modal-container .modal #linked-transaction').length > 0) {
                        $('#modal-container .modal #linked-transaction').next().find('table tbody').append(`<tr>
                            <td><a class="text-decoration-none open-transaction" href="#" data-id="${data.id}" data-type="${data.type}">${dataType}</a></td>
                            <td>${dateString}</td>
                            <td>${remainingBalance.replace('$-', '-$')}</td>
                            <td><button class="nsm-button unlink-transaction" data-type="${data.type}" data-id="${data.id}">Remove</button></td>
                        </tr>`);


                        var linkedCount = $('#modal-container .modal input[name="linked_transaction[]"]').length;

                        $('#modal-container .modal #linked-transaction').html(`${linkedCount} linked transactions`);
                    } else {
                        button.parent().append(`
                            <div class="dropdown">
                                <a href="#" class="text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="linked-transaction">1 linked Charge</a>
                                <div class="dropdown-menu">
                                    <table class="nsm-table linked-transaction-table">
                                        <thead>
                                            <tr class="linked-transaction-header">
                                                <td data-name="Type">Type</td>
                                                <td data-name="Date">Date</td>
                                                <td data-name="Amount">Amount</td>
                                                <td data-name="Action"></td>
                                            </tr>
                                        </thead>
                                        <tbody class="linked-transaction-table-body">
                                            <tr class="linked-transaction-row">
                                                <td><a class="text-decoration-none open-transaction" href="#" data-id="${data.id}" data-type="${data.type}">${dataType}</a></td>
                                                <td>${dateString}</td>
                                                <td>${remainingBalance.replace('$-', '-$')}</td>
                                                <td><button type="button" class="nsm-button unlink-transaction" data-type="${data.type}" data-id="${data.id}">Remove</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        `);
                    }

                    if ($('#modal-container .modal .transactions-container .row div.col-12').length === 2) {
                        $('#modal-container .modal .transactions-container').parent().remove();
                        $('#modal-container .modal .close-transactions-container').remove();
                        $('#modal-container .modal .open-transactions-container').remove();
                    }
                });

                $(this).parent().parent().parent().parent().parent().remove();
                break;
            case 'estimate':
                $.get(`/accounting/get-transaction-details/${data.type}/${data.id}`, function (res) {
                    var result = JSON.parse(res);
                    var details = result.details;
                    var items = result.items;

                    if (items.length > 0) {
                        if ($('#modal-container form .modal #item-table thead tr td').length < 10) {
                            $('<td></td>').insertBefore($('#modal-container form .modal #item-table thead tr td:last-child'));
                        }

                        var dataType = data.type.replace('-', ' ').replace(/(?:^|\s)\S/g, function (a) { return a.toUpperCase(); });
                        var date = new Date(details.estimate_date);
                        var dateString = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
                        var remainingBalance = '$' + parseFloat(details.remaining_balance).toFixed(2);

                        $.each(items, function (index, item) {
                            var link = `
                            <td class="overflow-visible">
                                <div class="dropdown">
                                    <a href="#" class="text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bx bx-fw bx-link"></i></a>
                                    <div class="dropdown-menu">
                                        <table class="nsm-table linked-transaction-table">
                                            <thead>
                                                <tr class="linked-transaction-header">
                                                    <td data-name="Type">Type</td>
                                                    <td data-name="Date">Date</td>
                                                    <td data-name="Amount">Amount</td>
                                                    <td data-name="Action"></td>
                                                </tr>
                                            </thead>
                                            <tbody class="linked-transaction-table-body">
                                                <tr class="linked-transaction-row">
                                                    <td><a class="text-decoration-none open-transaction" href="#" data-id="${data.id}" data-type="${data.type}">${dataType}</a></td>
                                                    <td>${dateString}</td>
                                                    <td>${remainingBalance.replace('$-', '-$')}</td>
                                                    <td><button class="nsm-button unlink-transaction" data-type="${data.type}" data-id="${data.id}">Remove</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <input type="hidden" value="${data.type.replace('-', '_') + '-' + details.id}" name="item_linked_transaction[]">
                                <input type="hidden" value="${item.id}" name="transaction_item_id[]">
                            </td>
                            `;

                            var itemDetails = item.itemDetails;
                            var locations = item.locations;
                            var locs = '';
                            if (itemDetails.type.toLowerCase() === 'product' || itemDetails.type.toLowerCase() === 'inventory') {
                                locs += '<select name="location[]" class="form-control nsm-field" required>';
                                for (var i in locations) {
                                    locs += `<option value="${locations[i].id}">${locations[i].name}</option>`;
                                }
                                locs += '</select>';
                            }

                            var type = itemDetails.type;

                            var price = item.price;

                            var total = item.total;
                            total = '$' + parseFloat(total).toFixed(2);

                            var fields = `
                                <td>${itemDetails.title}<input type="hidden" name="item[]" value="${itemDetails.id}"></td>
                                <td>${type.charAt(0).toUpperCase() + type.slice(1)}</td>
                                <td>${locs}</td>
                                <td><input type="number" name="quantity[]" class="form-control nsm-field text-end" required value="${item.qty}"></td>
                                <td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="${parseFloat(item.cost).toFixed(2)}"></td>
                                <td><input type="number" name="discount[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="${parseFloat(item.discount).toFixed(2)}"></td>
                                <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="${parseFloat(item.tax).toFixed(2)}"></td>
                                <td><span class="row-total">${total.replace('$-', '-$')}</span></td>
                                ${link}
                                <td><button type="button" class="nsm-button delete-row"><i class='bx bx-fw bx-trash'></i></button></td>
                            `;

                            $('#modal-container form .modal #item-table tbody:not(#package-items-table, .linked-transaction-table-body)').append(`<tr>${fields}</tr>`);

                            $('#modal-container form .modal #item-table tbody:not(#package-items-table) tr:last-child select').select2({
                                minimumResultsForSearch: -1,
                                dropdownParent: $('#modal-container form .modal')
                            });
                        });

                        $('#modal-container form .modal #item-table tbody:not(#package-items-table) tr:last-child input[name="quantity[]"]').trigger('change');
                    }

                    if ($('#modal-container .modal .close-transactions-container').length > 0) {
                        var button = $('#modal-container .modal .close-transactions-container');
                    } else {
                        var button = $('#modal-container .modal .open-transactions-container');
                    }

                    button.parent().append(`<input type="hidden" value="${data.type.replace('-', '_') + '-' + details.id}" name="linked_transaction[]">`);

                    if ($('#modal-container .modal #linked-transaction').length > 0) {
                        $('#modal-container .modal #linked-transaction').next().find('table tbody').append(`<tr>
                            <td><a class="text-decoration-none open-transaction" href="#" data-id="${data.id}" data-type="${data.type}">${dataType}</a></td>
                            <td>${dateString}</td>
                            <td>${remainingBalance.replace('$-', '-$')}</td>
                            <td><button class="nsm-button unlink-transaction" data-type="${data.type}" data-id="${data.id}">Remove</button></td>
                        </tr>`);


                        var linkedCount = $('#modal-container .modal input[name="linked_transaction[]"]').length;

                        $('#modal-container .modal #linked-transaction').html(`${linkedCount} linked transactions`);
                    } else {
                        button.parent().append(`
                            <div class="dropdown">
                                <a href="#" class="text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="linked-transaction">1 linked Estimate</a>
                                <div class="dropdown-menu">
                                    <table class="nsm-table linked-transaction-table">
                                        <thead>
                                            <tr class="linked-transaction-header">
                                                <td data-name="Type">Type</td>
                                                <td data-name="Date">Date</td>
                                                <td data-name="Amount">Amount</td>
                                                <td data-name="Action"></td>
                                            </tr>
                                        </thead>
                                        <tbody class="linked-transaction-table-body">
                                            <tr class="linked-transaction-row">
                                                <td><a class="text-decoration-none open-transaction" href="#" data-id="${data.id}" data-type="${data.type}">${dataType}</a></td>
                                                <td>${dateString}</td>
                                                <td>${remainingBalance.replace('$-', '-$')}</td>
                                                <td><button type="button" class="nsm-button unlink-transaction" data-type="${data.type}" data-id="${data.id}">Remove</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        `);
                    }

                    if ($('#modal-container .modal .transactions-container .row div.col-12').length === 2) {
                        $('#modal-container .modal .transactions-container').parent().remove();
                        $('#modal-container .modal .close-transactions-container').remove();
                        $('#modal-container .modal .open-transactions-container').remove();
                    }
                });

                $(this).parent().parent().parent().parent().parent().remove();
                break;
            case 'billexp-charge':
                $.get(`/accounting/get-transaction-details/${data.type}/${data.id}`, function (res) {
                    var result = JSON.parse(res);
                    var details = result.details;

                    if ($('#modal-container form .modal #item-table thead tr td').length < 10) {
                        $('<td></td>').insertBefore($('#modal-container form .modal #item-table thead tr td:last-child'));
                    }

                    var dataType = data.type.replace('-', ' ').replace(/(?:^|\s)\S/g, function (a) { return a.toUpperCase(); });
                    var date = new Date(details.date);
                    var dateString = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
                    var remainingBalance = '$' + parseFloat(details.amount).toFixed(2);

                    var link = `
                    <td class="overflow-visible">
                        <div class="dropdown">
                            <a href="#" class="text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bx bx-fw bx-link"></i></a>
                            <div class="dropdown-menu">
                                <table class="nsm-table linked-transaction-table">
                                    <thead>
                                        <tr class="linked-transaction-header">
                                            <td data-name="Type">Type</td>
                                            <td data-name="Date">Date</td>
                                            <td data-name="Amount">Amount</td>
                                            <td data-name="Action"></td>
                                        </tr>
                                    </thead>
                                    <tbody class="linked-transaction-table-body">
                                        <tr class="linked-transaction-row">
                                            <td><a class="text-decoration-none open-transaction" href="#" data-id="${data.id}" data-type="${data.type}">${dataType}</a></td>
                                            <td>${dateString}</td>
                                            <td>${remainingBalance.replace('$-', '-$')}</td>
                                            <td><button class="nsm-button unlink-transaction" data-type="${data.type}" data-id="${data.id}">Remove</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <input type="hidden" value="${data.type.replace('-', '_') + '-' + details.id}" name="item_linked_transaction[]">
                        <input type="hidden" value="${details.id}" name="transaction_item_id[]">
                    </td>
                    `;

                    var total = details.amount;
                    total = '$' + parseFloat(total).toFixed(2);

                    var fields = `
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input type="number" name="quantity[]" class="form-control nsm-field text-end" required value="1"></td>
                        <td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="${parseFloat(details.amount).toFixed(2)}"></td>
                        <td><input type="number" name="discount[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="0.00"></td>
                        <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="${parseFloat(details.tax).toFixed(2)}"></td>
                        <td><span class="row-total">${total.replace('$-', '-$')}</span></td>
                        ${link}
                        <td><button type="button" class="nsm-button delete-row"><i class='bx bx-fw bx-trash'></i></button></td>
                    `;

                    $('#modal-container form .modal #item-table tbody:not(#package-items-table, .linked-transaction-table-body)').append(`<tr>${fields}</tr>`);

                    $('#modal-container form .modal #item-table tbody:not(#package-items-table) tr:last-child select').select2({
                        minimumResultsForSearch: -1,
                        dropdownParent: $('#modal-container form .modal')
                    });

                    if (parseFloat(details.markup_percentage) > 0.00) {
                        var markupAmount = parseFloat(details.amount) / 100;
                        var totalMarkup = '$' + parseFloat(markupAmount).toFixed(2);

                        var fields = `
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><input type="number" name="quantity[]" class="form-control nsm-field text-end" required value="1"></td>
                            <td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="${parseFloat(markupAmount).toFixed(2)}"></td>
                            <td><input type="number" name="discount[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="0.00"></td>
                            <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value=""></td>
                            <td><span class="row-total">${totalMarkup.replace('$-', '-$')}</span></td>
                            ${link}
                            <td><button type="button" class="nsm-button delete-row"><i class='bx bx-fw bx-trash'></i></button></td>
                        `;

                        $('#modal-container form .modal #item-table tbody:not(#package-items-table, .linked-transaction-table-body)').append(`<tr>${fields}</tr>`);

                        $('#modal-container form .modal #item-table tbody:not(#package-items-table) tr:last-child select').select2({
                            minimumResultsForSearch: -1,
                            dropdownParent: $('#modal-container form .modal')
                        });
                    }

                    $('#modal-container form .modal #item-table tbody:not(#package-items-table) tr:last-child input[name="quantity[]"]').trigger('change');

                    if ($('#modal-container .modal .close-transactions-container').length > 0) {
                        var button = $('#modal-container .modal .close-transactions-container');
                    } else {
                        var button = $('#modal-container .modal .open-transactions-container');
                    }

                    button.parent().append(`<input type="hidden" value="${data.type.replace('-', '_') + '-' + details.id}" name="linked_transaction[]">`);

                    if ($('#modal-container .modal #linked-transaction').length > 0) {
                        $('#modal-container .modal #linked-transaction').next().find('table tbody').append(`<tr>
                            <td><a class="text-decoration-none open-transaction" href="#" data-id="${data.id}" data-type="${data.type}">${dataType}</a></td>
                            <td>${dateString}</td>
                            <td>${remainingBalance.replace('$-', '-$')}</td>
                            <td><button class="nsm-button unlink-transaction" data-type="${data.type}" data-id="${data.id}">Remove</button></td>
                        </tr>`);


                        var linkedCount = $('#modal-container .modal input[name="linked_transaction[]"]').length;

                        $('#modal-container .modal #linked-transaction').html(`${linkedCount} linked transactions`);
                    } else {
                        button.parent().append(`
                            <div class="dropdown">
                                <a href="#" class="text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="linked-transaction">1 linked Billexp Charge</a>
                                <div class="dropdown-menu">
                                    <table class="nsm-table linked-transaction-table">
                                        <thead>
                                            <tr class="linked-transaction-header">
                                                <td data-name="Type">Type</td>
                                                <td data-name="Date">Date</td>
                                                <td data-name="Amount">Amount</td>
                                                <td data-name="Action"></td>
                                            </tr>
                                        </thead>
                                        <tbody class="linked-transaction-table-body">
                                            <tr class="linked-transaction-row">
                                                <td><a class="text-decoration-none open-transaction" href="#" data-id="${data.id}" data-type="${data.type}">${dataType}</a></td>
                                                <td>${dateString}</td>
                                                <td>${remainingBalance.replace('$-', '-$')}</td>
                                                <td><button type="button" class="nsm-button unlink-transaction" data-type="${data.type}" data-id="${data.id}">Remove</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        `);
                    }

                    if ($('#modal-container .modal .transactions-container .row div.col-12').length === 2) {
                        $('#modal-container .modal .transactions-container').parent().remove();
                        $('#modal-container .modal .close-transactions-container').remove();
                        $('#modal-container .modal .open-transactions-container').remove();
                    }
                });

                $(this).parent().parent().parent().parent().parent().remove();
                break;
        }
    });

    $(document).on('click', '#modal-container .modal .unlink-transaction', function (e) {
        e.preventDefault();
        var data = e.currentTarget.dataset;

        switch ($('#modal-container .modal').attr('id')) {
            case 'invoiceModal':
                $(`#invoiceModal #item-table input[name="item_linked_transaction[]"][value="${data.type.replace('-', '_')}-${data.id}"]`).each(function () {
                    $(this).closest('tr').remove();
                });

                if ($(`#invoiceModal input[name="linked_transaction[]"]`).length > 1) {
                    $(`#invoiceModal #linked-transaction`).next().find(`.unlink-transaction[data-type="${data.type}"][data-id="${data.id}"]`).closest('tr').remove();
                } else {
                    $('#invoiceModal #linked-transaction').parent().remove();

                    $('#invoiceModal #item-table thead tr th:nth-child(9), #invoiceModal #item-table tbody tr td:nth-child(9)').remove();
                }

                $(`#invoiceModal input[name="linked_transaction[]"][value="${data.type.replace('-', '_')}-${data.id}"]`).remove();

                if ($('#invoiceModal input[name="linked_transaction[]"]').length > 0) {
                    if ($('#invoiceModal input[name="linked_transaction[]"]').length > 1) {
                        var linkedCount = $('#invoiceModal input[name="linked_transaction[]"]').length;

                        $('#invoiceModal #linked-transaction').html(`${linkedCount} linked transactions`);
                    } else {
                        var linked = $('#invoiceModal input[name="linked_transaction[]"]').val().split('-');
                        var linkedType = linked[0].replace('delayed_', '');

                        var text = '1 linked ';
                        text += `${linkedType.charAt(0).toUpperCase() + linkedType.slice(1).toLowerCase()} `;

                        $('#invoiceModal #linked-transaction').html(`${text.trim()}`);
                    }
                }

                if ($('#invoiceModal #item-table tbody tr').length > 0) {
                    $('#invoiceModal #item-table tbody input[name="quantity[]"]:first-child').trigger('change');
                } else {
                    $('#invoiceModal .transaction-grand-total').html('$0.00')
                }
                break;
            case 'expenseModal':
                $(`#expenseModal #category-details-table input[name="category_linked_transaction[]"][value="${data.type.replace('-', '_')}-${data.id}"]`).each(function () {
                    $(this).parent().parent().remove();
                });

                if ($('#expenseModal #category-details-table tbody tr').length < rowCount) {
                    var currentCount = $('#expenseModal #category-details-table tbody tr').length;

                    do {
                        $('#expenseModal #category-details-table tbody').append(`<tr>${catDetailsBlank}</tr>`);

                        if ($('#expenseModal #linked-transaction').length > 0) {
                            $('<td></td>').insertBefore('#expenseModal #category-details-table tbody tr:last-child td:last-child');
                        }

                        currentCount++;
                    } while (currentCount < rowCount);
                }

                var i = 1;
                $('#expenseModal #category-details-table tbody tr').each(function () {
                    $(this).find('td:first-child').html(i);

                    i++;
                });

                $(`#expenseModal #item-details-table input[name="item_linked_transaction[]"][value="${data.type.replace('-', '_')}-${data.id}"]`).each(function () {
                    $(this).parent().parent().remove();
                });

                if ($(`#expenseModal input[name="linked_transaction[]"]`).length > 1) {
                    $(`#expenseModal #linked-transaction`).next().find(`.unlink-transaction[data-type="${data.type}"][data-id="${data.id}"]`).parent().parent().remove();
                } else {
                    $('#expenseModal #linked-transaction').parent().remove();

                    $('#expenseModal #item-details-table thead tr th:nth-child(9), #expenseModal #item-details-table tbody tr td:nth-child(9)').remove();
                    $('#expenseModal #category-details-table thead tr th:nth-child(11), #expenseModal #category-details-table tbody tr td:nth-child(11)').remove();
                }

                $(`#expenseModal input[name="linked_transaction[]"][value="${data.type.replace('-', '_')}-${data.id}"]`).remove();

                if ($('#expenseModal input[name="linked_transaction[]"]').length > 0) {
                    if ($('#expenseModal input[name="linked_transaction[]"]').length > 1) {
                        var linkedCount = $('#expenseModal input[name="linked_transaction[]"]').length;

                        $('#expenseModal #linked-transaction').html(`${linkedCount} linked Purchase Orders`);
                    } else {
                        $('#expenseModal #linked-transaction').html(`1 linked Purchase Order`);
                    }
                }

                computeTransactionTotal();

                var payee = $('#expenseModal #payee').val().split('-');
                var url = '/accounting/get-linkable-transactions/expense/' + payee[1];

                if ($('#expenseModal').parent().attr('data-href') !== undefined) {
                    var split = $('#expenseModal').parent().attr('data-href').split('/');
                    url += '?transaction-id=' + split[split.length - 1]
                }

                $.get(url, function (res) {
                    var transactions = JSON.parse(res);

                    if (transactions.length > 0) {
                        if ($('#expenseModal .attachments-container').length > 0) {
                            $('#expenseModal .attachments-container').parent().parent().remove();
                        }

                        $('#expenseModal .open-transactions-container').trigger('click');
                        $('#expenseModal .transactions-container .row .col-12:not(:first-child)').remove();

                        $.each(transactions, function (index, transaction) {
                            var title = transaction.type;
                            title += transaction.number !== '' ? '#' + transaction.number : '';

                            if ($('#expenseModal input[name="linked_transaction[]"]').length === 0 ||
                                $('#expenseModal input[name="linked_transaction[]"]').length > 0 &&
                                transaction.data_type !== 'bill' &&
                                transaction.data_type !== 'vendor-credit' &&
                                $(`#expenseModal input[name="linked_transaction[]"][value="${transaction.data_type.replace('-', '_')}-${transaction.id}"]`).length < 1) {
                                $('#expenseModal .modal-body .row .nsm-callout .transactions-container .row').append(`
                                    <div class="col-12 grid-mb">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">${title}</h5>
                                                <p class="card-subtitle">${transaction.formatted_date}</p>
                                                <p class="card-text">
                                                    ${transaction.type === 'Purchase Order' ? `<strong>Total</strong>&emsp;${transaction.total}<br><strong>Balance</strong>&emsp;${transaction.balance}` : transaction.amount}
                                                </p>
                                                <ul class="d-flex justify-content-around list-unstyled">
                                                    <li><a href="#" class="text-decoration-none add-transaction" data-id="${transaction.id}" data-type="${transaction.data_type}"><strong>Add</strong></a></li>
                                                    <li><a href="#" class="text-decoration-none open-transaction" data-id="${transaction.id}" data-type="${transaction.data_type}">Open</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                `);
                            }
                        });

                        if ($('#expenseModal .transactions-container .row .col-12').length < 2) {
                            $('#expenseModal .close-transactions-container').trigger('click');
                        }
                    } else {
                        $('#expenseModal .transactions-container').parent().remove();
                        $('#expenseModal .close-transactions-container').parent().remove();
                        $('#expenseModal .open-transactions-container').parent().remove();
                    }
                });
                break;
            case 'checkModal':
                $(`#checkModal #category-details-table input[name="category_linked_transaction[]"][value="${data.type.replace('-', '_')}-${data.id}"]`).each(function () {
                    $(this).parent().parent().remove();
                });

                if ($('#checkModal #category-details-table tbody tr').length < rowCount) {
                    var currentCount = $('#checkModal #category-details-table tbody tr').length;

                    do {
                        $('#checkModal #category-details-table tbody').append(`<tr>${catDetailsBlank}</tr>`);

                        if ($('#checkModal #linked-transaction').length > 0) {
                            $('<td></td>').insertBefore('#checkModal #category-details-table tbody tr:last-child td:last-child');
                        }

                        currentCount++;
                    } while (currentCount < rowCount);
                }

                var i = 1;
                $('#checkModal #category-details-table tbody tr').each(function () {
                    $(this).find('td:first-child').html(i);

                    i++;
                });

                $(`#checkModal #item-details-table input[name="item_linked_transaction[]"][value="${data.type.replace('-', '_')}-${data.id}"]`).each(function () {
                    $(this).parent().parent().remove();
                });

                if ($(`#checkModal input[name="linked_transaction[]"]`).length > 1) {
                    $(`#checkModal #linked-transaction`).next().find(`.unlink-transaction[data-type="${data.type}"][data-id="${data.id}"]`).parent().parent().remove();
                } else {
                    $('#checkModal #linked-transaction').parent().remove();

                    $('#checkModal #item-details-table thead tr th:nth-child(9), #checkModal #item-details-table tbody tr td:nth-child(9)').remove();
                    $('#checkModal #category-details-table thead tr th:nth-child(11), #checkModal #category-details-table tbody tr td:nth-child(11)').remove();
                }

                $(`#checkModal input[name="linked_transaction[]"][value="${data.type.replace('-', '_')}-${data.id}"]`).remove();

                if ($('#checkModal input[name="linked_transaction[]"]').length > 0) {
                    if ($('#checkModal input[name="linked_transaction[]"]').length > 1) {
                        var linkedCount = $('#checkModal input[name="linked_transaction[]"]').length;

                        $('#checkModal #linked-transaction').html(`${linkedCount} linked Purchase Orders`);
                    } else {
                        $('#checkModal #linked-transaction').html(`1 linked Purchase Order`);
                    }
                }

                computeTransactionTotal();

                var payee = $('#checkModal #payee').val().split('-');
                var url = '/accounting/get-linkable-transactions/check/' + payee[1];

                if ($('#checkModal').parent().attr('data-href') !== undefined) {
                    var split = $('#checkModal').parent().attr('data-href').split('/');
                    url += '?transaction-id=' + split[split.length - 1]
                }

                $.get(url, function (res) {
                    var transactions = JSON.parse(res);

                    if (transactions.length > 0) {
                        if ($('#checkModal .attachments-container').length > 0) {
                            $('#checkModal .attachments-container').parent().parent().remove();
                        }

                        $('#checkModal .open-transactions-container').trigger('click');
                        $('#checkModal .transactions-container .row .col-12:not(:first-child)').remove();

                        $.each(transactions, function (index, transaction) {
                            var title = transaction.type;
                            title += transaction.number !== '' ? '#' + transaction.number : '';

                            if ($('#checkModal input[name="linked_transaction[]"]').length === 0 ||
                                $('#checkModal input[name="linked_transaction[]"]').length > 0 &&
                                transaction.data_type !== 'bill' &&
                                transaction.data_type !== 'vendor-credit' &&
                                $(`#checkModal input[name="linked_transaction[]"][value="${transaction.data_type.replace('-', '_')}-${transaction.id}"]`).length < 1) {
                                $('#checkModal .modal-body .row .nsm-callout .transactions-container .row').append(`
                                    <div class="col-12 grid-mb">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">${title}</h5>
                                                <p class="card-subtitle">${transaction.formatted_date}</p>
                                                <p class="card-text">
                                                    ${transaction.type === 'Purchase Order' ? `<strong>Total</strong>&emsp;${transaction.total}<br><strong>Balance</strong>&emsp;${transaction.balance}` : transaction.amount}
                                                </p>
                                                <ul class="d-flex justify-content-around list-unstyled">
                                                    <li><a href="#" class="text-decoration-none add-transaction" data-id="${transaction.id}" data-type="${transaction.data_type}"><strong>Add</strong></a></li>
                                                    <li><a href="#" class="text-decoration-none open-transaction" data-id="${transaction.id}" data-type="${transaction.data_type}">Open</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                `);
                            }
                        });

                        if ($('#checkModal .transactions-container .row .col-12').length < 2) {
                            $('#checkModal .close-transactions-container').trigger('click');
                        }
                    } else {
                        $('#checkModal .transactions-container').parent().remove();
                        $('#checkModal .close-transactions-container').parent().remove();
                        $('#checkModal .open-transactions-container').parent().remove();
                    }
                });
                break;
            case 'billModal':
                $(`#billModal #category-details-table input[name="category_linked_transaction[]"][value="${data.type.replace('-', '_')}-${data.id}"]`).each(function () {
                    $(this).parent().parent().remove();
                });

                if ($('#billModal #category-details-table tbody tr').length < rowCount) {
                    var currentCount = $('#billModal #category-details-table tbody tr').length;

                    do {
                        $('#billModal #category-details-table tbody').append(`<tr>${catDetailsBlank}</tr>`);

                        if ($('#billModal #linked-transaction').length > 0) {
                            $('<td></td>').insertBefore('#billModal #category-details-table tbody tr:last-child td:last-child');
                        }

                        currentCount++;
                    } while (currentCount < rowCount);
                }

                var i = 1;
                $('#billModal #category-details-table tbody tr').each(function () {
                    $(this).find('td:first-child').html(i);

                    i++;
                });

                $(`#billModal #item-details-table input[name="item_linked_transaction[]"][value="${data.type.replace('-', '_')}-${data.id}"]`).each(function () {
                    $(this).parent().parent().remove();
                });

                if ($(`#billModal input[name="linked_transaction[]"]`).length > 1) {
                    $(`#billModal #linked-transaction`).next().find(`.unlink-transaction[data-type="${data.type}"][data-id="${data.id}"]`).parent().parent().remove();
                } else {
                    $('#billModal #linked-transaction').parent().remove();

                    $('#billModal #item-details-table thead tr th:nth-child(9), #billModal #item-details-table tbody tr td:nth-child(9)').remove();
                    $('#billModal #category-details-table thead tr th:nth-child(11), #billModal #category-details-table tbody tr td:nth-child(11)').remove();
                }

                $(`#billModal input[name="linked_transaction[]"][value="${data.type.replace('-', '_')}-${data.id}"]`).remove();

                if ($('#billModal input[name="linked_transaction[]"]').length > 0) {
                    if ($('#billModal input[name="linked_transaction[]"]').length > 1) {
                        var linkedCount = $('#billModal input[name="linked_transaction[]"]').length;

                        $('#billModal #linked-transaction').html(`${linkedCount} linked Purchase Orders`);
                    } else {
                        $('#billModal #linked-transaction').html(`1 linked Purchase Order`);
                    }
                }

                computeTransactionTotal();

                var url = '/accounting/get-linkable-transactions/bill/' + $('#billModal #vendor').val();

                if ($('#billModal').parent().attr('data-href') !== undefined) {
                    var split = $('#billModal').parent().attr('data-href').split('/');
                    url += '?transaction-id=' + split[split.length - 1]
                }

                $.get(url, function (res) {
                    var transactions = JSON.parse(res);

                    if (transactions.length > 0) {
                        if ($('#billModal .attachments-container').length > 0) {
                            $('#billModal .attachments-container').parent().parent().remove();
                        }

                        $('#billModal .open-transactions-container').trigger('click');
                        $('#billModal .transactions-container .row .col-12:not(:first-child)').remove();

                        $.each(transactions, function (index, transaction) {
                            var title = transaction.type;
                            title += transaction.number !== '' ? '#' + transaction.number : '';

                            if ($('#billModal input[name="linked_transaction[]"]').length === 0 ||
                                $('#billModal input[name="linked_transaction[]"]').length > 0 &&
                                $(`#billModal input[name="linked_transaction[]"][value="${transaction.data_type.replace('-', '_')}-${transaction.id}"]`).length < 1) {
                                $('#billModal .modal-body .row .nsm-callout .transactions-container .row').append(`
                                    <div class="col-12 grid-mb">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">${title}</h5>
                                                <p class="card-subtitle">${transaction.formatted_date}</p>
                                                <p class="card-text">
                                                    ${transaction.type === 'Purchase Order' ? `<strong>Total</strong>&emsp;${transaction.total}<br><strong>Balance</strong>&emsp;${transaction.balance}` : transaction.amount}
                                                </p>
                                                <ul class="d-flex justify-content-around list-unstyled">
                                                    <li><a href="#" class="text-decoration-none add-transaction" data-id="${transaction.id}" data-type="${transaction.data_type}"><strong>Add</strong></a></li>
                                                    <li><a href="#" class="text-decoration-none open-transaction" data-id="${transaction.id}" data-type="${transaction.data_type}">Open</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                `);
                            }
                        });

                        if ($('#billModal .transactions-container .row .col-12').length < 2) {
                            $('#billModal .close-transactions-container').trigger('click');
                        }
                    } else {
                        $('#billModal .transactions-container').parent().remove();
                        $('#billModal .close-transactions-container').parent().remove();
                        $('#billModal .open-transactions-container').parent().remove();
                    }
                });
                break;
        }

        // $('#modal-container .modal #payee').trigger('change');
        // $('#modal-container .modal #vendor').trigger('change');
        $('#modal-container .modal #customer').trigger('change');
    });

    $(document).on('click', '#modal-container .modal a.open-transaction', function (e) {
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
            case 'delayed-credit':
                var modalName = 'delayedCreditModal';
                break;
            case 'delayed-charge':
                var modalName = 'delayedChargeModal';
                break;
            case 'invoice':
                var modalName = 'invoiceModal';
                break;
            case 'bill-payment':
                var modalName = 'billPaymentModal';
                break;
        }

        $.get(`/accounting/view-transaction/${type}/${id}`, function (res) {
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

            $(`#${modalName}`).modal('show');
        });
    });

    $(document).on('click', '#modal-container form .modal button.close-transactions-container', function (e) {
        e.preventDefault();

        $('#modal-container form .modal .transactions-container').parent().hide();

        $(this).removeClass('close-transactions-container');
        $(this).addClass('open-transactions-container');
        $(this).children().removeClass('bx-chevron-right');
        $(this).children().addClass('bx-chevron-left');
    });

    $(document).on('click', '#modal-container form .modal button.open-transactions-container', function (e) {
        e.preventDefault();

        $('#modal-container form .modal .transactions-container').parent().show();

        $(this).removeClass('open-transactions-container');
        $(this).addClass('close-transactions-container');
        $(this).children().removeClass('bx-chevron-left');
        $(this).children().addClass('bx-chevron-right');
    });

    $(document).on('click', '#billPaymentModal .dropdown-menu', function (e) {
        e.stopPropagation();
    });

    $(document).on('keyup', '#billPaymentModal #search-bill-no', function () {
        loadBills();

        get_bill_payment_linkable_transactions();
    });

    $(document).on('click', '#billPaymentModal #bills-table tbody a', function (e) {
        e.preventDefault();
        var id = e.currentTarget.dataset.id;

        $('#modal-container .modal').modal('hide');

        $.get(`/accounting/view-transaction/bill/` + id, function (res) {
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

            $(`#billModal #vendor`).trigger('change');

            $(`#billModal`).modal('show');
        });
    });

    $(document).on('click', '#billPaymentModal #vendor-credits-table tbody a', function (e) {
        e.preventDefault();
        var id = e.currentTarget.dataset.id;
        var type = e.currentTarget.dataset.type;

        $('#modal-container .modal').modal('hide');

        if (type === 'vendor-credit') {
            $.get(`/accounting/view-transaction/vendor-credit/` + id, function (res) {
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
        } else {
            $.get('/accounting/view-transaction/bill-payment/' + id, function (res) {
                if ($('div#modal-container').length > 0) {
                    $('div#modal-container').html(res);
                } else {
                    $('body').append(`
                        <div id="modal-container"> 
                            ${res}
                        </div>
                    `);
                }

                modalName = '#billPaymentModal';
                initModalFields('vendorCreditModal', { id: id, type: type });

                $('#billPaymentModal #bills-table').nsmPagination({
                    itemsPerPage: 150
                });

                $('#billPaymentModal #vendor-credits-table').nsmPagination({
                    itemsPerPage: 150
                });

                $('#billPaymentModal .dropdown-menu').on('click', function (e) {
                    e.stopPropagation();
                });

                $('#billPaymentModal').modal('show');
            });
        }
    });

    $(document).on('change', '#billPaymentModal #bills-table thead input.select-all', function () {
        $('#billPaymentModal #bills-table tbody input.select-one').prop('checked', $(this).prop('checked')).trigger('change');
    });

    $(document).on('change', '#billPaymentModal #vendor-credits-table thead input.select-all', function () {
        $('#billPaymentModal #vendor-credits-table tbody input.select-one').prop('checked', $(this).prop('checked')).trigger('change');
    });

    $(document).on('change', '#billPaymentModal #bills-table tbody input.select-one', function () {
        var value = $(this).val();
        var row = $(this).closest('tr');

        if ($(this).prop('checked') === false) {
            row.find('input[name="bill_payment[]"]').val('');
        } else {
            row.find('input[name="bill_payment[]"]').val(row.find('td:nth-child(5)').html().trim());
        }

        if ($('#billPaymentModal #bills-table tbody input.select-one:checked').length > 0) {
            if ($('#billPaymentModal #vendor-credits-table input[type="checkbox"]').length < 1) {
                $('#billPaymentModal #vendor-credits-table thead tr td:first-child').html(`<td class="table-icon text-center">
                    <input class="form-check-input select-all table-select" type="checkbox">
                </td>`);

                $('#billPaymentModal #vendor-credits-table tbody tr').each(function () {
                    var id = $(this).find('td:nth-child(2)').find('a').data().id;
                    $(this).find('td:first-child').html(`<div class="table-row-icon table-checkbox">
                        <input class="form-check-input select-one table-select" type="checkbox" value="${id}">
                    </div>`);
                });
            }
        } else {
            $('#billPaymentModal #vendor-credits-table input[type="checkbox"]').remove();
            $('#billPaymentModal #vendor-credits-table input[name="credit_payment[]"]').val('');
        }

        if ($('#billPaymentModal #bills-table tbody input.select-one:checked').length === $('#billPaymentModal #bills-table tbody tr').length) {
            $('#billPaymentModal #bills-table thead input.select-all').prop('checked', true);
        } else {
            $('#billPaymentModal #bills-table thead input.select-all').prop('checked', false);
        }

        var billPayment = 0.00;
        $('#billPaymentModal #bills-table tbody tr input.select-one:checked').each(function () {
            var row = $(this).closest('tr');
            billPayment += row.find('input[name="bill_payment[]"]').val() !== "" ? parseFloat(row.find('input[name="bill_payment[]"]').val()) : 0.00;
        });

        var creditPayment = 0.00;
        $('#billPaymentModal #vendor-credits-table tbody tr input.select-one:checked').each(function () {
            var row = $(this).closest('tr');
            creditPayment += row.find('input[name="credit_payment[]"]').val() !== "" ? parseFloat(row.find('input[name="credit_payment[]"]').val()) : 0.00;
        });

        if ($('#billPaymentModal input[name="payment_amount"]').data('fixed') === undefined) {
            $('#billPaymentModal input[name="payment_amount"]').val(formatter.format(parseFloat(billPayment) - parseFloat(creditPayment)).replace('$', ''));
        }

        var amountToApply = parseFloat($('#billPaymentModal input[name="payment_amount"]').val()) + creditPayment;
        var amountToCredit = amountToApply - billPayment;
        $('#billPaymentModal span.amount-to-apply').html(formatter.format(parseFloat(amountToApply)));
        $('#billPaymentModal span.amount-to-credit').html(formatter.format(parseFloat(amountToCredit)));
        $('#billPaymentModal span.payment-total-amount').html(formatter.format(parseFloat($('#billPaymentModal input[name="payment_amount"]').val())));

        get_bill_payment_linkable_transactions();
    });

    $(document).on('keyup', '#billPaymentModal #search-vcredit-no', function () {
        loadVCredits();

        get_bill_payment_linkable_transactions();
    });

    $(document).on('change', '#billPaymentModal #vcredits_table_rows', function () {
        // $('#billPaymentModal #vendor-credits-table').DataTable().ajax.reload(null, true);
    });

    $(document).on('click', '#billPaymentModal #vcredits-apply-btn', function (e) {
        e.preventDefault();

        // $('#billPaymentModal #vendor-credits-table').DataTable().ajax.reload(null, true);
    });

    $(document).on('click', '#billPaymentModal #vcredits-reset-btn', function (e) {
        e.preventDefault();

        $('#billPaymentModal #vcredit-from').val('').trigger('change');
        $('#billPaymentModal #vcredit-to').val('').trigger('change');
        // $('#billPaymentModal #vendor-credits-table').DataTable().ajax.reload(null, true);
    });

    $(document).on('change', '#billPaymentModal #vendor-credits-table tbody input.select-one', function () {
        var value = $(this).val();
        var row = $(this).closest('tr');

        if ($(this).prop('checked') === false) {
            row.find('input[name="credit_payment[]"]').val('');
        } else {
            row.find('input[name="credit_payment[]"]').val(row.find('td:nth-child(4)').html().trim());
        }

        if ($('#billPaymentModal #vendor-credits-table tbody input.select-one:checked').length === $('#billPaymentModal #vendor-credits-table tbody tr').length) {
            $('#billPaymentModal #vendor-credits-table thead input.select-all').prop('checked', true);
        } else {
            $('#billPaymentModal #vendor-credits-table thead input.select-all').prop('checked', false);
        }

        var billPayment = 0.00;
        $('#billPaymentModal #bills-table tbody tr input.select-one:checked').each(function () {
            var row = $(this).closest('tr');
            billPayment += row.find('input[name="bill_payment[]"]').val() !== "" ? parseFloat(row.find('input[name="bill_payment[]"]').val()) : 0.00;
        });

        var creditPayment = 0.00;
        $('#billPaymentModal #vendor-credits-table tbody tr input.select-one:checked').each(function () {
            var row = $(this).closest('tr');
            creditPayment += row.find('input[name="credit_payment[]"]').val() !== "" ? parseFloat(row.find('input[name="credit_payment[]"]').val()) : 0.00;
        });

        if ($('#billPaymentModal input[name="payment_amount"]').data('fixed') === undefined) {
            $('#billPaymentModal input[name="payment_amount"]').val(formatter.format(parseFloat(billPayment) - parseFloat(creditPayment)).replace('$', ''));
        }

        var amountToApply = parseFloat($('#billPaymentModal input[name="payment_amount"]').val()) + creditPayment;
        var amountToCredit = amountToApply - billPayment;
        $('#billPaymentModal span.amount-to-apply').html(formatter.format(parseFloat(amountToApply)));
        $('#billPaymentModal span.amount-to-credit').html(formatter.format(parseFloat(amountToCredit)));
        $('#billPaymentModal span.payment-total-amount').html(formatter.format(parseFloat($('#billPaymentModal input[name="payment_amount"]').val())));

        get_bill_payment_linkable_transactions();
    });

    $(document).on('change', '#billPaymentModal input[name="payment_amount"]', function () {
        $(this).attr('data-fixed', true);

        var billPayment = 0.00;
        $('#billPaymentModal #bills-table tbody tr input.select-one:checked').each(function () {
            var row = $(this).closest('tr');
            billPayment += row.find('input[name="bill_payment[]"]').val() !== "" ? parseFloat(row.find('input[name="bill_payment[]"]').val()) : 0.00;
        });

        var creditPayment = 0.00;
        $('#billPaymentModal #vendor-credits-table tbody tr input.select-one:checked').each(function () {
            var row = $(this).closest('tr');
            creditPayment += row.find('input[name="credit_payment[]"]').val() !== "" ? parseFloat(row.find('input[name="credit_payment[]"]').val()) : 0.00;
        });

        var amountToApply = parseFloat($(this).val()) + creditPayment;
        var amountToCredit = amountToApply - billPayment;
        $('#billPaymentModal span.amount-to-apply').html(formatter.format(parseFloat(amountToApply)));
        $('#billPaymentModal span.amount-to-credit').html(formatter.format(parseFloat(amountToCredit)));
        $('#billPaymentModal span.payment-total-amount').html(formatter.format(parseFloat($(this).val())));
    });

    $(document).on('change', '#billPaymentModal input[name="bill_payment[]"], #billPaymentModal input[name="credit_payment[]"]', function () {
        var row = $(this).closest('tr');
        var id = row.find('.select-one').val();
        if ($(this).attr('name') === 'bill_payment[]') {
            $(`#billPaymentModal input[name="bills[]"][value="${id}"]`).attr('data-amount', $(this).val());
        } else {
            // $(`#billPaymentModal input[name="credits[]"][value="${id}"]`).attr('data-amount', $(this).val());
        }

        if ($(this).val() === '' || $(this).val() === '0.00') {
            $(this).closest('tr').find('.select-one').prop('checked', false);
            $(this).closest('tr').parent().prev().find('.select-all').prop('checked', false);

            var id = $(this).closest('tr').find('.select-one').val();
            if ($(this).attr('name') === 'bill_payment[]') {
                $(`#billPaymentModal input[name="bills[]"][value="${id}"]`).remove();

                if ($(this).closest('tbody').find('.select-one:checked').length < 1) {
                    $('#billPaymentModal #vendor-credits-table input[type="checkbox"]').closest('td').html('');
                    // $('#billPaymentModal [name="credits[]"]').remove();
                }
            } else {
                // $(`#billPaymentModal input[name="credits[]"][value="${id}"]`).remove();
            }
        } else {
            $(this).closest('tr').find('.select-one').prop('checked', true);

            if ($(this).closest('tbody').find('.select-one:checked').length === $(this).closest('tbody').find('tr').length) {
                $(this).closest('table').find('.select-all').prop('checked', true);
            }

            if ($('#billPaymentModal #vendor-credits-table input[type="checkbox"]').length < 1) {
                $('#billPaymentModal #vendor-credits-table thead tr td:first-child').html(`<td class="table-icon text-center">
                    <input class="form-check-input select-all table-select" type="checkbox">
                </td>`);

                $('#billPaymentModal #vendor-credits-table tbody tr').each(function () {
                    var id = $(this).find('td:nth-child(2)').find('a').data().id;
                    $(this).find('td:first-child').html(`<div class="table-row-icon table-checkbox">
                        <input class="form-check-input select-one table-select" type="checkbox" value="${id}">
                    </div>`);
                });
            }
        }

        var billPayment = 0.00;
        $('#billPaymentModal #bills-table tbody tr input.select-one:checked').each(function () {
            var row = $(this).closest('tr');
            billPayment += row.find('input[name="bill_payment[]"]').val() !== "" ? parseFloat(row.find('input[name="bill_payment[]"]').val()) : 0.00;
        });

        var creditPayment = 0.00;
        $('#billPaymentModal #vendor-credits-table tbody tr input.select-one:checked').each(function () {
            var row = $(this).closest('tr');
            creditPayment += row.find('input[name="credit_payment[]"]').val() !== "" ? parseFloat(row.find('input[name="credit_payment[]"]').val()) : 0.00;
        });

        if ($('#billPaymentModal input[name="payment_amount"]').data('fixed') === undefined) {
            $('#billPaymentModal input[name="payment_amount"]').val(formatter.format(parseFloat(billPayment) - parseFloat(creditPayment)).replace('$', ''));
        }

        var amountToApply = parseFloat($('#billPaymentModal input[name="payment_amount"]').val()) + creditPayment;
        var amountToCredit = amountToApply - billPayment;
        $('#billPaymentModal span.amount-to-apply').html(formatter.format(parseFloat(amountToApply)));
        $('#billPaymentModal span.amount-to-credit').html(formatter.format(parseFloat(amountToCredit)));
        $('#billPaymentModal span.payment-total-amount').html(formatter.format(parseFloat($('#billPaymentModal input[name="payment_amount"]').val())));

        get_bill_payment_linkable_transactions();
    });

    $(document).on('click', '#billPaymentModal #clear-payment', function (e) {
        e.preventDefault();

        // $('#billPaymentModal input[name="bills[]"]').remove();
        // $('#billPaymentModal input[name="credits[]"]').remove();

        $('#billPaymentModal #bills-table input.select-all').prop('checked', false).trigger('change');
        $('#billPaymentModal #vendor-credits-table input.select-all').prop('checked', false).trigger('change');
        $('#billPaymentModal [name="payment_amount"]').val('0.00').removeAttr('data-fixed');
        $('#billPaymentModal span.payment-total-amount').html('$0.00');
        $('#billPaymentModal span.amount-to-apply').html('$0.00');
        $('#billPaymentModal span.amount-to-credit').html('$0.00');

        // $('#billPaymentModal #bills-table').DataTable().ajax.reload(function(json) {
        //     $('#billPaymentModal #bills-table input[name="bill_payment[]"]:last-child').trigger('change');
        // }, true);

        // $('#billPaymentModal #vendor-credits-table').DataTable().ajax.reload(function(json) {
        //     $('#billPaymentModal #vendor-credits-table input[name="credit_payment[]"]:last-child').trigger('change');
        // }, true);
    });

    $(document).on('change', '#payBillsModal #print_later', function () {
        if ($(this).prop('checked')) {
            $('#payBillsModal #starting_check_no').val('To print').prop('disabled', true);
        } else {
            $('#payBillsModal #starting_check_no').val('').prop('disabled', false);
        }
    });

    // do not remove
    var checkID;

    $(document).on('change', '#printChecksModal #payment_account, #printChecksModal #sort-by, #printChecksModal #check-type', function () {
        var data = new FormData();

        data.set('payment_account', $('#printChecksModal #payment_account').val());
        data.set('sort', $('#printChecksModal #sort-by').val());
        data.set('type', $('#printChecksModal #check-type').val());

        $.ajax({
            url: '/accounting/get-checks',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function (result) {
                var checks = JSON.parse(result);

                $('#printChecksModal #checks-table tbody tr').remove();
                $('#print_printable_checks_modal table tbody tr').remove();
                $('#print_preview_printable_checks_modal #printable_checks_table_print tbody tr').remove();

                if (checks.length < 1) {
                    $('#printChecksModal #checks-table tbody').append(`
                    <tr>
                        <td colspan="5"><div class="nsm-empty"><span>No results found.</span></div></td>
                    </tr>
                    `);

                    $('#print_printable_checks_modal table tbody').append(`
                    <tr>
                        <td colspan="4"><div class="nsm-empty"><span>No results found.</span></div></td>
                    </tr>
                    `);

                    $('#print_preview_printable_checks_modal #printable_checks_table_print tbody').append(`
                    <tr>
                        <td colspan="4"><div class="nsm-empty"><span>No results found.</span></div></td>
                    </tr>
                    `);
                } else {
                    checks.forEach(function (check) {
                        $('#printChecksModal #checks-table tbody').append(`
                        <tr>
                            <td>
                                <div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" type="checkbox" value="${check.id}">
                                </div>
                            </td>
                            <td>${check.date}</td>
                            <td>${check.type}</td>
                            <td>${check.payee}</td>
                            <td>${check.amount}</td>
                        </tr>
                        `);

                        $('#print_printable_checks_modal table tbody').append(`
                        <tr>
                            <td>${check.date}</td>
                            <td>${check.type}</td>
                            <td>${check.payee}</td>
                            <td>${check.amount}</td>
                        </tr>
                        `);

                        $('#print_preview_printable_checks_modal #printable_checks_table_print tbody').append(`
                        <tr>
                            <td>${check.date}</td>
                            <td>${check.type}</td>
                            <td>${check.payee}</td>
                            <td>${check.amount}</td>
                        </tr>
                        `);
                    });
                }

                $('#printChecksModal #checks-table').nsmPagination({
                    itemsPerPage: parseInt($('#printChecksModal #checks-table-rows li a.dropdown-item.active').html().trim())
                });

                $('.table-checkbox > input[value="' + window.checkID + '"]').click();
            }
        });
    });

    $(document).on('change', '#printChecksModal #checks-table input.select-all', function () {
        $('#printChecksModal #checks-table tbody tr:visible input[type="checkbox"]').prop('checked', $(this).prop('checked')).trigger('change');
    });

    $(document).on('change', '#printChecksModal #checks-table tbody tr input[type="checkbox"]', function () {
        $('#printChecksModal #selected-checks').html($('#printChecksModal #checks-table tbody tr input[type="checkbox"]:checked').length);

        var notChecked = $('#printChecksModal #checks-table tbody tr:visible input[type="checkbox"]:not(:checked)').length;
        $('#printChecksModal #checks-table input.select-all').prop('checked', notChecked === 0);

        var selectedTotal = parseFloat($('#printChecksModal #selected-checks-total').html().replaceAll(',', '').replace('$', ''));
        var row = $(this).parent().parent().parent();
        var amount = row.find('td:last-child').html();

        if ($(this).prop('checked')) {
            selectedTotal += parseFloat(amount.replace('$', '').replaceAll(',', ''));
        } else {
            selectedTotal -= parseFloat(amount.replace('$', '').replaceAll(',', ''));
        }

        $('#printChecksModal #selected-checks-total').html(formatter.format(parseFloat(selectedTotal)));
    });

    $(document).on('click', '#printChecksModal #add-check-button', function () {
        $('#printChecksModal').modal('hide');
        $('.modal-backdrop:last-child').remove();

        $('.nsm-sidebar-menu #new-popup ul li a.ajax-modal[data-target="#checkModal"]').trigger('click');
    });

    $(document).on('click', '#printChecksModal #remove-from-list', function () {
        var data = new FormData();

        $('#printChecksModal #checks-table tbody tr input.select-one:checked').each(function () {
            var row = $(this).parent().parent().parent();
            var transactionType = row.find('td:nth-child(3)').html();
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
            success: function (result) {
                var res = JSON.parse(result);

                toast(res.success, res.message);

                $('#printChecksModal #checks-table tbody tr input.select-one:checked').each(function () {
                    $(this).closest('tr').remove();
                });
                $('#printChecksModal #checks-table .select-all').prop('checked', false);
                $('#printChecksModal #selected-checks-total').html('$0.00');
                $('#printChecksModal #selected-checks').html('0');

                $('#printChecksModal #checks-table').nsmPagination({
                    itemsPerPage: parseInt($('#printChecksModal #checks-table-rows li a.dropdown-item.active').html().trim())
                });
            }
        });
    });

    $(document).on('click', '#printChecksModal #preview-and-print', function (e) {
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
                var data = new FormData();
                data.set('starting_check_no', $('#printChecksModal #starting-check-no').val());
                data.set('on_first_page_print', $('#printChecksModal #on-first-page-print').val());

                $('#printChecksModal #checks-table tbody tr input[type="checkbox"]:checked').each(function () {
                    var row = $(this).parent().parent().parent();
                    var transactionType = row.find('td:nth-child(3)').html();
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
                    success: function (result) {
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

    $(document).on('click', '#viewPrintChecksModal #preview-and-print', function (e) {
        e.preventDefault();

        let pdfWindow = window.open("");
        pdfWindow.document.write(`<iframe width="100%" height="100%" src="${$('#viewPrintChecksModal iframe').attr('src')}"></iframe>`);
        $(pdfWindow.document).find('body').css('padding', '0');
        $(pdfWindow.document).find('body').css('margin', '0');
        $(pdfWindow.document).find('iframe').css('border', '0');
    });

    $(document).on('hidden.bs.modal', '#viewPrintChecksModal', function () {
        $(this).parent().parent().next('.modal-backdrop').remove();
        $(this).parent().remove();

        var data = new FormData();
        data.set('starting_check_no', $('#printChecksModal #starting-check-no').val());

        $('#printChecksModal #checks-table tbody tr input[type="checkbox"]:checked').each(function () {
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
            success: function (result) {
                $('div#modal-container').append(result);

                $('#successPrintCheck select').select2({
                    dropdownParent: $('#successPrintCheck'),
                    minimumResultsForSearch: -1
                });
                $('#successPrintCheck').modal('show');
            }
        });
    });

    $(document).on('hidden.bs.modal', '#successPrintCheck', function () {
        $(this).parent().parent().next('.modal-backdrop').remove();
        $(this).parent().remove();
        $('#printChecksModal #checks-table input[type="checkbox"]').prop('checked', false);
        $('#printChecksModal #selected-checks').html('0');
        $('#printChecksModal #selected-checks-total').html('$0.00');
    });

    $(document).on('submit', '#modal-container #successPrintCheck #print-success-form', function (e) {
        e.preventDefault();

        var data = new FormData(this);

        $('#printChecksModal #checks-table tbody tr input[type="checkbox"]:checked').each(function () {
            var row = $(this).parent().parent().parent();
            var transactionType = row.find('td:nth-child(3)').html();
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
            success: function (result) {
                // Increment Starting Check after Print
                var currentStartingNo = parseInt($('#starting-check-no').val());
                $('#starting-check-no').val(currentStartingNo + 1);

                $('#successPrintCheck').modal('hide');
                $('#printChecksModal #payment_account').trigger('change');
            }
        });
    });

    $(document).on('click', '#purchaseOrderModal .modal-footer #save-and-print', function (e) {
        e.preventDefault();

        submitType = 'save-and-print';

        $(this).attr('id', 'print-purchase-order');
        $('#modal-container form').submit();
    });

    $(document).on('click', '#purchaseOrderModal .modal-footer #save-and-send', function (e) {
        e.preventDefault();

        submitType = 'save-and-send';

        $('#modal-container form').submit();
    });

    // $(document).on('click', '#purchaseOrderModal .modal-footer #print-purchase-order', function(e) {
    //     e.preventDefault();

    //     printPurchaseOrder();
    // });

    $(document).on('click', '#modal-container form .modal .modal-footer #save', function (e) {
        e.preventDefault();

        submitType = $(this).attr('id');

        $('#modal-container form').submit();
    });

    $(document).on('click', '#singleTimeModal #time-activity-settings-button, #weeklyTimesheetModal #time-activity-settings-button', function (e) {
        e.preventDefault();

        if ($('#singleTimeModal').length > 0) {
            $('#singleTimeModal').parent().prev().modal('show');
        } else {
            $('#weeklyTimesheetModal').parent().prev().modal('show');
        }
    });

    $(document).on('change', '#time-activity-settings #toggle-service, #time-activity-settings #toggle-billable, #time-activity-settings #toggle-cost_rates', function (e) {
        var field = $(this).attr('id').replace('toggle-', '');
        var value = $(this).prop('checked') ? 1 : 0;
        $.get(`/accounting/update-timesheet-settings/${field}/${value}`, function (res) {
            if (res === 'true') {
                switch (field) {
                    case 'service':
                        if (value === 1) {
                            $('#singleTimeModal').find('#service').prop('required', true).parent().show()
                            $('#weeklyTimesheetModal').find('select[name="service[]"]').prop('required', true).parent().show()
                        } else {
                            $('#singleTimeModal').find('#service').prop('required', false).parent().hide();
                            $('#weeklyTimesheetModal').find('select[name="service[]"]').prop('required', false).parent().hide();
                        }
                        break;
                    case 'billable':
                        if (value === 1) {
                            var toAppend = `<div class="row">
                                <div class="col-4 d-flex align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="billable" id="billable" value="1" onchange="showHiddenFields(this)">
                                        <label class="form-check-label" for="billable">Billable(/hr)</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <input type="number" name="hourly_rate" id="hourlyRate" step=".01" class="form-control nsm-field text-end" style="display: none" value="0.00" onchange="convertToDecimal(this)">
                                </div>
                                <div class="col-12">
                                    <div class="form-check" style="display: none">
                                        <input type="checkbox" name="taxable" id="taxable" class="form-check-input" value="1">
                                        <label for="taxable" class="form-check-label">Taxable</label>
                                    </div>
                                </div>
                            </div>`;

                            $(toAppend).insertAfter($('#singleTimeModal #service').parent());

                            $('#weeklyTimesheetModal #timesheet-table tbody tr').each(function () {
                                var number = $(this).find('td:first-child()').html();

                                $(this).find('select[name="customer[]"]').parent().next().append(`
                                <div class="row">
                                    <div class="col d-flex align-items-center pe-0">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input weekly-billable" id="billable_${number}" type="checkbox" name="billable[]" value="1" onchange="showHiddenFields(this)">
                                            <label class="form-check-label" for="billable_${number}">Billable(/hr)</label>
                                        </div>
                                    </div>
                                </div>
                                `);
                            });
                        } else {
                            $('#singleTimeModal').find('#billable').parent().parent().remove();
                            $('#weeklyTimesheetModal').find('input[name="billable[]"]').parent().parent().parent().parent().html('');
                        }

                        if ($('#weeklyTimesheetModal').length > 0) {
                            rowInputs = $('#weeklyTimesheetModal #timesheet-table tbody tr:first-child()').html();
                        }
                        break;
                }
            }
        });
    });

    $(document).on('click', '#weeklyTimesheetModal #copy-last-timesheet', function (e) {
        var name = $('#weeklyTimesheetModal #person_tracking').val();
        if (name !== null) {
            var nameSplit = name.split('-');

            $.get(`/accounting/get-last-timesheet/${nameSplit[0]}/${nameSplit[1]}`, function (result) {
                var res = JSON.parse(result);

                if (res.success === false) {
                    Swal.fire({
                        text: res.message,
                        icon: res.success ? 'success' : 'error',
                        showCloseButton: true,
                        showConfirmButton: false,
                        timer: 2000
                    });
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
                            $('#weeklyTimesheetModal #timesheet-table tbody tr:last-child() input[name="billable[]"]').attr('id', `billable_${count + 1}`).prop('checked', false).trigger('change');
                            $('#weeklyTimesheetModal #timesheet-table tbody tr:last-child() input[name="billable[]"]').next().attr('for', `billable_${count + 1}`);
                        }

                        $($('#weeklyTimesheetModal #timesheet-table tbody tr')[count]).find('[name="customer[]"]').append(`<option value="${activity.customer_id}" selected>${activity.customer_name}</option>`).trigger('change');
                        $($('#weeklyTimesheetModal #timesheet-table tbody tr')[count]).find('[name="service[]"]').append(`<option value="${activity.service_id}" selected>${activity.service_name}</option>`);
                        $($('#weeklyTimesheetModal #timesheet-table tbody tr')[count]).find('[name="description[]"]').val(activity.description);

                        for (var day in hours) {
                            $($('#weeklyTimesheetModal #timesheet-table tbody tr')[count]).find(`[name="${day}_hours[]"]`).val(hours[day]);
                        }

                        $($('#weeklyTimesheetModal #timesheet-table tbody tr')[count]).find('[name="billable[]"]').prop('checked', activity.billable === "1");

                        if (activity.billable === "1") {
                            $($('#weeklyTimesheetModal #timesheet-table tbody tr')[count]).find('[name="billable[]"]').parent().parent().parent().append(`
                            <div class="col g-0">
                                <input type="number" name="hourly_rate[]" step=".01" value="${parseFloat(activity.hourly_rate).toFixed(2)}" onchange="convertToDecimal(this)" class="form-control nsm-field">
                            </div>
                            <div class="col d-flex align-items-center">
                                <div class="form-check">
                                    <input type="checkbox" name="taxable[]" id="taxable_${count + 1}" class="form-check-input" value="1">
                                    <label class="form-check-label" for="taxable_${count + 1}">Taxable</label>
                                </div>
                            </div>`);
                        }

                        $($('#weeklyTimesheetModal #timesheet-table tbody tr')[count]).find('select').each(function () {
                            var field = $(this).attr('name').replace('[]', '');
                            $(this).select2({
                                ajax: {
                                    url: base_url + 'accounting/get-dropdown-choices',
                                    dataType: 'json',
                                    data: function (params) {
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
                                templateSelection: optionSelect,
                                dropdownParent: $('#weeklyTimesheetModal')
                            });
                        });

                        var days = Object.keys(hours);
                        var lastDay = days[days.length - 1];
                        $($('#weeklyTimesheetModal #timesheet-table tbody tr')[count]).find(`[name="${lastDay}_hours[]"]`).trigger('change');

                        count++;
                    }
                }
            });
        } else {
            Swal.fire({
                text: "nSmarTrac can't copy a previous timesheet because one doesn't exist yet for this employee or vendor.",
                icon: 'error',
                showCloseButton: true,
                showConfirmButton: false,
                timer: 2000
            });
        }
    });

    $(document).on('change', '#weeklyTimesheetModal #timesheet-table select[name="service[]"]', function () {
        var el = $(this);
        $.get(base_url + `accounting/get-item-details/${$(this).val()}`, function (res) {
            var result = JSON.parse(res);
            var rate = result.item !== null ? result.item.price : '';

            el.parent().parent().next().find('[name="hourly_rate[]"]').val(rate).trigger('change');
        });
    });

    $(document).on('change', '#weeklyTimesheetModal #timesheet-table input[name="hourly_rate[]"]', function () {
        computeTotalBill();
    });

    $(document).on('change', '#weeklyTimesheetModal .show-field', function () {
        var day = $(this).attr('id').replace('show_', '');

        if ($(this).prop('checked')) {
            $(`#weeklyTimesheetModal #timesheet-table .${day}_field`).show();
            $(`#weeklyTimesheetModal #timesheet-table .${day}_total`).show();
        } else {
            $(`#weeklyTimesheetModal #timesheet-table .${day}_field`).hide();
            $(`#weeklyTimesheetModal #timesheet-table .${day}_total`).hide();
        }
    });

    $(document).on('click', '#weeklyTimesheetModal #save-and-print', function (e) {
        e.preventDefault();

        submitType = 'save-and-print';
        $('#weeklyTimesheetModal').parent('form').submit();
    });

    $(document).on('change', '#modal-container form select', function () {
        var value = $(this).val();
        if (value === 'add-new') {
            dropdownEl = $(this);
            var form = $(this).attr('name').includes('account') ? 'account' : $(this).attr('name').replaceAll('[]', '');
            form = form.includes('customer') ? 'customer' : form;
            form = form === 'category' ? 'item_category' : form;

            switch (form) {
                case 'account':
                    var modal = $('#modal-container').find('.modal:first-child()');
                    var modalName = modal.attr('id').toLowerCase().replaceAll('modal', '');
                    var field = dropdownEl.attr('id');
                    var fieldName = field === undefined ? $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-').toLowerCase() : field.toLowerCase().replaceAll('_', '-');
                    fieldName = fieldName.includes('from') || fieldName.includes('to') ? fieldName.replaceAll('from-', '').replaceAll('to-', '') : fieldName;
                    var query = `?modal=${modalName}&field=${fieldName}`;
                    break;
                case 'product':
                    var query = `?field=product`;
                    form = 'item';
                    break;
                case 'service':
                    var query = `?field=service`;
                    form = 'item';
                    break;
                case 'payee':
                    var query = '?type=payee';
                    break;
                case 'customer':
                    var query = '?type=customer';
                    var modalTitle = 'New Customer';
                    form = 'payee';
                    break;
                case 'vendor':
                    var query = '?type=vendor';
                    var modalTitle = 'New Vendor';
                    form = 'payee';
                    break;
                case 'received_from':
                    var query = '?type=received-from';
                    var modalTitle = '';
                    form = 'payee';
                    break;
                case 'person_tracking':
                    var query = '?type=vendor';
                    var modalTitle = '';
                    form = 'payee';
                    break;
                case 'names':
                    var query = '?type=received-from';
                    var modalTitle = '';
                    form = 'payee';
                    break;
                case 'location_id':
                    form = 'item_location';
                    var query = '';
                    break;
                default:
                    var query = '';
                    break;
            }

            $.get(base_url + `accounting/get-dropdown-modal/${form}_modal${query}`, function (result) {
                if (form !== 'item') {
                    $('#modal-container').append(result);
                } else {
                    $('#modal-container').append(`<div class="full-screen-modal">${result}</div>`)
                }

                switch (form) {
                    case 'account':
                        initAccountModal();
                        break;
                    case 'item_category':
                        $('#modal-container #item-category-modal').modal('show');
                        break;
                    default:
                        if (form !== 'item' && form !== 'payee' && form !== 'item_location') {
                            $(`#modal-container #${form.replaceAll('_', '-')}-modal form`).attr('id', `ajax-add-${form.replaceAll('_', '-')}`);
                            $(`#modal-container #${form.replaceAll('_', '-')}-modal form`).removeAttr('action');
                            $(`#modal-container #${form.replaceAll('_', '-')}-modal form`).removeAttr('method');
                        }

                        if (form === 'payee' && modalTitle !== '') {
                            $('#modal-container #payee-modal .modal-title').html(modalTitle);
                            $('#modal-container #payee-modal #payee_type').select2({
                                minimumResultsForSearch: -1,
                                dropdownParent: $('#modal-container #payee-modal')
                            });

                            $('#modal-container #payee-modal #customer-type').select2({
                                minimumResultsForSearch: -1,
                                dropdownParent: $('#modal-container #payee-modal')
                            });
                        }

                        $(`#modal-container #${form.replaceAll('_', '-')}-modal`).attr('data-bs-backdrop', 'static');
                        $(`#modal-container #${form.replaceAll('_', '-')}-modal`).attr('data-bs-keyboard', 'false');

                        $(`#modal-container #${form.replaceAll('_', '-')}-modal`).modal('show');
                        break;
                }
            });
        }
    });

    $(document).on('change', '#account-modal #account_type', function () {
        $.get('/accounting/get-first-detail-type/' + $(this).val(), function (result) {
            var res = JSON.parse(result);

            $('#account-modal #detail_type').append(`<option value="${res.acc_detail_id}" selected>${res.acc_detail_name}</option>`).trigger('change');
        });
    });

    $(document).on('change', '#account-modal #detail_type', function () {
        var el = $(this);
        var id = el.val();

        $.get('/accounting/chart-of-accounts/get-detail-type/' + id, function (result) {
            var res = JSON.parse(result);

            el.parent().find('div:last-child()').html(res.description);
            $('#account-modal #name').val(res.acc_detail_name);
        });
    });

    $(document).on('click', '#account-modal .close-account-modal', function (e) {
        e.preventDefault();

        if (dropdownEl !== null) {
            dropdownEl.html('').trigger('change');
            $('#modal-container form .modal span#account-balance').html('$0.00');
        }
    });

    $(document).on('click', '#payment-method-modal .close-payment-method', function (e) {
        e.preventDefault();

        if (dropdownEl !== null) {
            dropdownEl.html('').trigger('change');
        }
        $('#payment-method-modal').modal('hide');
    });

    $(document).on('click', '#term-modal .close-term-modal', function (e) {
        e.preventDefault();

        if (dropdownEl !== null) {
            dropdownEl.html('').trigger('change');
        }
        $('#term-modal').modal('hide');
    });

    $(document).on('click', '#item-modal .close-item-modal', function (e) {
        e.preventDefault();

        if (dropdownEl !== null) {
            dropdownEl.html('').trigger('change');
        }
        $('#item-modal').modal('hide');
    });

    $(document).on('click', '#item-category-modal #cancel-add-category', function (e) {
        e.preventDefault();

        dropdownEl.html('').trigger('change');

        $('#item-category-modal').modal('hide');
    });

    $(document).on('hidden.bs.modal', '#account-modal', function () {
        dropdownEl = null;

        $('#account-modal').remove();
    });

    $(document).on('hidden.bs.modal', '#modal-container #payment-method-modal', function () {
        dropdownEl = null;

        $('#modal-container #payment-method-modal').remove();
    });

    $(document).on('hidden.bs.modal', '#modal-container #term-modal', function () {
        dropdownEl = null;

        $('#modal-container #term-modal').remove();
    });

    $(document).on('hidden.bs.modal', '#modal-container #item-modal', function () {
        dropdownEl = null;

        $('#modal-container #item-modal').remove();
    });

    $(document).on('hidden.bs.modal', '#modal-container #item-category-modal', function () {
        dropdownEl = null;

        $('#modal-container #item-category-modal').remove();
    });

    $(document).on('change', '#account-modal #check_sub', function () {
        if ($(this).prop('checked')) {
            $('#account-modal #parent_account').prop('disabled', false);
        } else {
            $('#account-modal #parent_account').prop('disabled', true);
        }
    });

    $(document).on('change', '#account-modal #choose_time', function () {
        if ($(this).val() === 'other') {
            $("#account-modal #balance").val('');
            $("#account-modal #balance").parent().addClass("d-none");
            $("#account-modal #time_date").parent().parent().removeClass("d-none");
        } else {
            $("#account-modal #time_date").val('');
            $("#account-modal #time_date").parent().parent().addClass("d-none");
            $("#account-modal #balance").parent().removeClass("d-none");

            switch ($(this).val()) {
                case 'beginning-of-year':
                    var date = new Date();
                    date.setMonth(11);
                    date.setDate(31);
                    date.setFullYear(date.getFullYear() - 1);
                    break;
                case 'beginning-of-month':
                    var date = new Date();
                    date.setDate(1);
                    date.setDate(date.getDate() - 1);
                    break;
                case 'today':
                    var date = new Date();
                    date.setDate(date.getDate() - 1);
                    break;
            }

            var dateString = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
            $("#account-modal #selected-date").html(dateString);
        }
    });

    $(document).on("change", "#account-modal #time_date", function () {
        $("#account-modal #selected-date").html($(this).val());
        $("#account-modal #balance").parent().removeClass("d-none");
    });

    $(document).on('click', '#modal-container #item-modal #types-table tr', function (e) {
        var type = e.currentTarget.dataset.href;

        itemTypeSelection = $('#modal-container #item-modal .modal-content').html();
        $.get(base_url + 'accounting/item-form/' + type, function (result) {
            $('#item-modal .modal-content').html(result);

            if (type === 'product' || type === 'bundle') {
                var footerHeight = $('#item-modal .modal-footer').outerHeight();
                $('#item-modal .modal-body').css('margin-bottom', footerHeight);
            }

            if (dropdownEl !== null) {
                $('#item-modal form').removeAttr('action');
                $('#item-modal form').removeAttr('method');
                $('#item-modal form').removeAttr('enctype');
                $('#item-modal form').addClass('ajax-add-item');
                $('#item-modal form').attr('id', `ajax-${type}-item-form`);
            }

            $(`#item-modal .date`).datepicker({
                format: 'mm/dd/yyyy',
                orientation: 'bottom',
                autoclose: true
            });

            $('#item-modal select').each(function () {
                var dropdownType = $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-');
                if (dropdownFields.includes(dropdownType)) {
                    $(this).select2({
                        ajax: {
                            url: base_url + 'accounting/get-dropdown-choices',
                            dataType: 'json',
                            data: function (params) {
                                var query = {
                                    search: params.term,
                                    type: 'public',
                                    field: dropdownType,
                                    modal: 'item-modal',
                                    item_type: type
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
                    $(this).select2({
                        minimumResultsForSearch: -1,
                        dropdownParent: $('#item-modal')
                    });
                }
            });

            if (typeof itemFormData !== 'undefined' && itemFormData.has('name') && type !== 'bundle') {
                if (itemFormData.has('id')) {
                    $('#item-modal form').attr('action', `${base_url}/accounting/products-and-services/update/${type}/${itemFormData.get('id')}`);
                    $('#item-modal form').attr('id', `update-${type}-form`);
                    $(`#item-modal a#select-item-type`).attr('onclick', `changeType('${itemFormData.get('type')}')`);
                } else {
                    $(`#item-modal a#select-item-type`).attr('onclick', `changeType('')`);
                }

                for (var data of itemFormData.entries()) {
                    if (data[0] !== 'icon') {
                        if (data[0].includes('category') || data[0].includes('account') || data[0].includes('vendor')) {
                            fillItemDropdownFields(data, type);
                        } else {
                            $('#item-modal form').find(`[name="${data[0]}"]`).val(data[1]).trigger('change');
                        }
                    } else {
                        if (itemFormData.icon !== null && itemFormData.icon !== "" && itemFormData.icon !== undefined) {
                            $('#item-modal form').find('img.image-prev').attr('src', `/uploads/${itemFormData.icon}`);
                            $('#item-modal form').find('img.image-prev').parent().addClass('d-flex justify-content-center');
                            $('#item-modal form').find('img.image-prev').parent().removeClass('hide');
                            $('#item-modal form').find('img.image-prev').parent().prev().addClass('hide');
                        }
                    }
                }

                if (itemFormData.has('rebate_item')) {
                    $('#item-modal form').find('#rebate-item').prop('checked', true).trigger('change');
                }

                if (itemFormData.has('selling')) {
                    $('#item-modal form').find('#selling').prop('checked', true).trigger('change');
                }

                if (itemFormData.has('purchasing')) {
                    $('#item-modal form').find('#purchasing').prop('checked', true).trigger('change');
                }
            }
        });
    });

    $(document).on('click', '#modal-container #item-modal #select-item-type', function (e) {
        e.preventDefault();

        var formId = $('#item-modal form').attr('id');
        var form = document.getElementById(formId);
        itemFormData = new FormData(form);
        $('#modal-container #item-modal .modal-content').html(itemTypeSelection);
    });

    $(document).on('click', '#modal-container #item-modal #remove-item-icon', function (e) {
        e.preventDefault();

        $('#modal-container #item-modal #icon').val('').trigger('change');
    });

    $(document).on('change', '#modal-container #item-modal #icon', function () {
        if ($(this)[0].files && $(this)[0].files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#modal-container #item-modal img.image-prev').attr('src', e.target.result);
            }

            reader.readAsDataURL($(this)[0].files[0]);

            $('#modal-container #item-modal img.image-prev').parent().addClass('d-flex justify-content-center');
            $('#modal-container #item-modal img.image-prev').parent().removeClass('d-none');
            $('#modal-container #item-modal img.image-prev').parent().prev().addClass('d-none');
        } else {
            $('#modal-container #item-modal img.image-prev').parent().removeClass('d-flex justify-content-center');
            $('#modal-container #item-modal img.image-prev').parent().addClass('d-none');
            $('#modal-container #item-modal img.image-prev').parent().prev().removeClass('d-none');
        }
    });

    $(document).on('change', '#modal-container #item-modal #upc-image', function (e) {
        var files = this.files;
        const FR = new FileReader();
        FR.addEventListener("load", function (evt) {
            if (evt.target.result !== '') {
                Quagga.decodeSingle({
                    decoder: {
                        readers: [
                            "code_128_reader",
                            "ean_reader",
                            "ean_8_reader",
                            "code_39_reader",
                            "code_39_vin_reader",
                            "codabar_reader",
                            "upc_reader",
                            "upc_e_reader",
                            "i2of5_reader",
                            "2of5_reader",
                            "code_93_reader"
                        ] // List of active readers
                    },
                    locate: true, // try to locate the barcode in the image
                    src: evt.target.result,
                }, function (result) {
                    if (typeof result !== 'undefined' && result.codeResult) {
                        $('#item-modal #upc').val(result.codeResult.code);
                        // console.log("result", result.codeResult.code);
                    } else {
                        $('#item-modal #upc').val('');
                        var message = 'Please upload a valid UPC barcode image';
                        sweetAlert('Sorry!', 'error', message);
                        // console.log("not detected");
                    }
                });
            }
        });

        FR.readAsDataURL(files[0]);
    });

    // $(document).on('click', '#modal-container #item-modal #storage-locations tbody tr td:not(:last-child)', function () {
    //     if ($(this).parent().find('select[name="location_id[]"]').length < 1) {
    //         $(this).parent().children('td:first-child').append('<select name="location_id[]" class="form-control nsm-field"></select>');
    //         $(this).parent().children('td:nth-child(2)').append('<input type="number" name="quantity[]" class="text-right form-control nsm-field">');

    //         $(this).parent().find('select').select2({
    //             ajax: {
    //                 url: base_url + 'accounting/get-dropdown-choices',
    //                 dataType: 'json',
    //                 data: function (params) {
    //                     var query = {
    //                         search: params.term,
    //                         type: 'public',
    //                         field: 'item-locations',
    //                         modal: 'item-modal'
    //                     }

    //                     // Query parameters will be ?search=[term]&type=public&field=[type]
    //                     return query;
    //                 }
    //             },
    //             templateResult: formatResult,
    //             templateSelection: optionSelect,
    //             dropdownParent: $('#modal-container #item-modal')
    //         });
    //     }
    // });



    $(document).on('click', '#modal-container #item-modal #addBundleItem, #modal-container #item-modal #addLocationLine', function (e) {
        e.preventDefault();

        if ($(this).attr('id').includes('Bundle')) {
            var type = 'item';
            var id_type = 'item';
        } else {
            var type = 'location';
            var id_type = 'location_id';
        }
        $(this).closest('table').children('tbody').append(`
        <tr>
            <td><select name="${id_type}[]" class="form-control"></select></td>
            <td><input type="number" name="quantity[]" class="text-right form-control"></td>
            <td><button type="button" class="nsm-button delete-${type}"><i class='bx bx-fw bx-trash'></i></button></td>
        </tr>
        `);
        $(this).closest('table').find('tbody tr:last-child').find(`select[name="${id_type}[]"]`).select2({
            ajax: {
                url: base_url + 'accounting/get-dropdown-choices',
                dataType: 'json',
                data: function (params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        field: type == 'item' ? 'item' : 'item-locations',
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
    });

    $(document).on('click', '#modal-container #item-modal #bundle-items-table .delete-item, #modal-container #item-modal #storage-locations .delete-location', function (e) {
        e.preventDefault();

        if ($(this).parent().parent().parent().children('tr').length > 0) {
            $(this).parent().parent().remove();
        } else {
            $(this).parent().parent().children('td:not(:last-child)').html('');
        }
    });

    $(document).on('click', '#modal-container #item-modal #bundle-item-form #bundle-items-table tbody tr td:not(:last-child)', function () {
        if ($(this).parent().find('select[name="item[]"]').length < 1) {
            $(this).parent().children('td:first-child').append('<select name="item[]" class="form-control"></select>');
            $(this).parent().children('td:nth-child(2)').append('<input type="number" name="quantity[]" class="text-right form-control">');

            $(this).parent().find('select[name="item[]"]').select2({
                ajax: {
                    url: base_url + 'accounting/get-dropdown-choices',
                    dataType: 'json',
                    data: function (params) {
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

    $(document).on('change', '#modal-container #item-modal #selling, #modal-container #item-modal #purchasing', function () {
        if ($(this).prop('checked') === false) {
            $(this).closest('.row').find('select, input:not([type="checkbox"]), textarea').parent().addClass('d-none');

            if ($(this).attr('id') === 'selling') {
                if ($('#modal-container #item-modal #purchasing').prop('checked') === false) {
                    $('#modal-container #item-modal #purchasing').prop('checked', true).trigger('change');
                }
            } else {
                $('#modal-container #item-modal #selling').prop('checked', true).trigger('change');
            }
        } else {
            $(this).closest('.row').find('select, input:not([type="checkbox"]), textarea').parent().removeClass('d-none')
        }
    });

    $(document).on('click', '#item-modal .modal-footer #save-and-close', function (e) {
        e.preventDefault();

        var formIsValid = true;
        $('#item-modal form').find('input[required], textarea[required]').each(function () {
            if (!$(this).val().trim()) {

                formIsValid = false;
                return false; // Exit the loop early

            }
        });
        $('#item-modal form').find('input[required], textarea[required]').each(function () {
            if (!$(this).val().trim()) {
                $(this).addClass('reset-indicator');
            }
        });

        // If any required field is empty, show SweetAlert and prevent form submission
        if (!formIsValid) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please fill in all required fields.',
                confirmButtonColor: '#6a4a86',
            });
            return false; // Prevent further execution
        }

        // If all required fields are filled, hide the modal and submit the form
        $('#item-modal').modal('hide');
        $('#item-modal form').trigger('submit');

    });

    $(document).on('click', '#item-modal .modal-footer #save-and-new', function (e) {
        e.preventDefault();
        var form = $('#item-modal form');
        var formData = form.serialize();
        var actionUrl = form.attr('action');

        var formIsValid = true;
        $('#item-modal form').find('input[required], textarea[required]').each(function () {
            if (!$(this).val().trim()) {
                $(this).addClass('reset-indicator');
            }
        });
        $('#item-modal form').find('input[required], textarea[required]').each(function () {
            if (!$(this).val().trim()) {
                $(this).addClass('reset-indicator');
                formIsValid = false;
                return false; // Exit the loop early

            }
        });


        if (!formIsValid) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please fill in all required fields.',
                confirmButtonColor: '#6a4a86',
            });
            return false; // Prevent further execution
        }
        form.find('input, select, textarea').addClass('reset-indicator');
        $.ajax({
            url: actionUrl, // Use the form's action URL
            type: 'POST',
            data: formData,
            success: function (response) {
                // Display success message with SweetAlert
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Form submitted successfully.',
                    confirmButtonColor: '#6a4a86',
                    showConfirmButton: false,
                    timer: 1500, // Close alert after 1.5 seconds
                }).then((result) => {
                    // Reopen the modal after SweetAlert closes
                    if (result.dismiss === Swal.DismissReason.timer) {
                        $('#item-modal').modal('show');
                    }
                });

                // Close the current modal
                form.trigger('reset');
                form.find('select').each(function () {
                    $(this).val(null).trigger('change'); // Reset select2 value and trigger change event
                });
                setTimeout(function () {
                    form.find('input, select, textarea').removeClass('reset-indicator');
                }, 2000);

            },
            error: function (xhr, status, error) {
                // Handle error cases, if needed
                console.log('Error:', error);

                // Display error message with SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong. Please try again.',
                    confirmButtonColor: '#6a4a86',
                });
            }
        });


    });

    $(document).on('submit', '#item-category-modal form', function (e) {
        e.preventDefault();

        var data = new FormData(this);

        $.ajax({
            url: '/accounting/ajax-add-item-category',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function (result) {
                var res = JSON.parse(result);

                if (res.success) {
                    dropdownEl.append(`<option value="${res.data.item_categories_id}" selected>${res.data.name}</option>`);
                    dropdownEl.trigger('change');

                    $('#item-category-modal').modal('hide');
                }
            }
        });
    });

    $(document).on('submit', '#item-modal form', function (e) {
        if ($(this).attr('id').includes('ajax')) {
            e.preventDefault();
            var data = new FormData(this);
            var type = $(this).attr('id').replaceAll('ajax-', '').replaceAll('-item-form', '');

            $.ajax({
                url: base_url + 'accounting/ajax-add-item/' + type,
                data: data,
                type: 'post',
                processData: false,
                contentType: false,
                success: function (result) {
                    var res = JSON.parse(result);

                    if (res.success) {
                        dropdownEl.append(`<option value="${res.data.id}" selected>${res.data.title}</option>`);
                        dropdownEl.trigger('change');
                    }
                }
            });
        }

        itemFormData = new FormData();
    });

    $(document).on('submit', '#account-modal #ajax-add-account', function (e) {
        e.preventDefault();
        var choose_time = $('#choose_time').val();
        var balance = $('#balance').val();
        var is_valid = 1;

        if (choose_time == '' || choose_time === null) {
            Swal.fire({
                title: 'Error',
                text: 'Please specify when do you want to track your finances',
                icon: 'error',
                showCancelButton: false,
                confirmButtonText: 'Okay'
            });
            is_valid = 0;
        }

        if (balance == '' || balance === null) {
            Swal.fire({
                title: 'Error',
                text: 'Please specify your account balance',
                icon: 'error',
                showCancelButton: false,
                confirmButtonText: 'Okay'
            });
            is_valid = 0;
        }

        if (is_valid == 1) {
            var data = new FormData(this);

            $.ajax({
                url: base_url + 'accounting/ajax-add-account',
                data: data,
                type: 'post',
                processData: false,
                contentType: false,
                success: function (result) {
                    var res = JSON.parse(result);

                    if (res.success) {
                        dropdownEl.append(`<option value="${res.data.id}" selected>${res.data.name}</option>`);
                        dropdownEl.trigger('change');

                        $('#account-modal').modal('hide');
                    }
                }
            });
        }

    });

    $(document).on('submit', '#payment-method-modal #ajax-add-payment-method', function (e) {
        e.preventDefault();

        var data = new FormData(this);

        $.ajax({
            url: base_url + 'accounting/ajax-add-payment-method',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function (result) {
                var res = JSON.parse(result);

                if (res.success) {
                    dropdownEl.append(`<option value="${res.data.id}" selected>${res.data.name}</option>`);
                    dropdownEl.trigger('change');
                    $('#payment-method-modal').modal('hide');
                } else {
                    alert('Payment method name is required');
                }
            }
        });
    });

    $(document).on('submit', '#term-modal #ajax-add-term', function (e) {
        e.preventDefault();

        var data = new FormData(this);

        $.ajax({
            url: base_url + 'accounting/ajax-add-term',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function (result) {
                var res = JSON.parse(result);

                if (res.success) {
                    dropdownEl.append(`<option value="${res.data.id}" selected>${res.data.name}</option>`);
                    dropdownEl.trigger('change');

                    $('#term-modal').modal('hide');
                }
            }
        });
    });

    // $(document).on('change', '#modal-container form #payee', function() {
    //     if ($(this).val() === 'add-new') {
    //         dropdownEl = $(this);

    //         $.get('/accounting/get-add-payee-modal/payee', function(result) {
    //             $('#modal-container div.full-screen-modal:first-child()').parent().append(result);
    //             $('#modal-container #payee-modal select').select2({
    //                 minimumResultsForSearch: -1,
    //                 dropdownParent: $('#modal-container #payee-modal')
    //             });

    //             $('#modal-container #payee-modal').modal({
    //                 backdrop: 'static',
    //                 keyboard: false
    //             });
    //         });
    //     }
    // });

    // $(document).on('change', '#modal-container #vendor', function() {
    //     if ($(this).val() === 'add-new') {
    //         dropdownEl = $(this);

    //         $.get('/accounting/get-add-payee-modal/vendor', function(result) {
    //             $('#modal-container div.full-screen-modal:first-child()').parent().append(result);

    //             $('#modal-container #payee-modal h4.modal-title').html('New Vendor');
    //             $('#modal-container #payee-modal').modal({
    //                 backdrop: 'static',
    //                 keyboard: false
    //             });
    //         });
    //     }
    // });

    // $(document).on('change', '#modal-container form #person_tracking', function() {
    //     if ($(this).val() === 'add-new') {
    //         dropdownEl = $(this);

    //         $.get('/accounting/get-add-payee-modal/vendor', function(result) {
    //             $('#modal-container div.full-screen-modal:first-child()').parent().append(result);

    //             $('#modal-container #payee-modal').modal({
    //                 backdrop: 'static',
    //                 keyboard: false
    //             });
    //         });
    //     }
    // });

    // $(document).on('change', '#modal-container form [name="category_customer[]"], #modal-container form #customer, #modal-container form [name="customer[]"]', function() {
    //     if ($(this).val() === 'add-new') {
    //         dropdownEl = $(this);

    //         $.get('/accounting/get-add-payee-modal/customer', function(result) {
    //             $('#modal-container div.full-screen-modal:first-child()').parent().append(result);

    //             $('#modal-container #payee-modal h4.modal-title').html('New Customer');
    //             $('#modal-container #payee-modal').modal({
    //                 backdrop: 'static',
    //                 keyboard: false
    //             });
    //         });
    //     }
    // });

    // $(document).on('change', '#modal-container form [name="received_from[]"]', function() {
    //     if ($(this).val() === 'add-new') {
    //         dropdownEl = $(this);

    //         $.get('/accounting/get-add-payee-modal/received-from', function(result) {
    //             $('#modal-container div.full-screen-modal:first-child()').parent().append(result);
    //             $('#modal-container #payee-modal select').select2({
    //                 minimumResultsForSearch: -1,
    //                 dropdownParent: $('#modal-container #payee-modal')
    //             });

    //             $('#modal-container #payee-modal').modal({
    //                 backdrop: 'static',
    //                 keyboard: false
    //             });
    //         });
    //     }
    // });

    // $(document).on('change', '#modal-container form [name="names[]"]', function() {
    //     if ($(this).val() === 'add-new') {
    //         dropdownEl = $(this);

    //         $.get('/accounting/get-add-payee-modal/received-from', function(result) {
    //             $('#modal-container div.full-screen-modal:first-child()').parent().append(result);
    //             $('#modal-container #payee-modal select').select2({
    //                 minimumResultsForSearch: -1,
    //                 dropdownParent: $('#modal-container #payee-modal')
    //             });

    //             $('#modal-container #payee-modal').modal({
    //                 backdrop: 'static',
    //                 keyboard: false
    //             });
    //         });
    //     }
    // });

    $(document).on('submit', '#modal-container #payee-modal #new-payee-form', function (e) {
        e.preventDefault();

        var data = new FormData(this);
        var hasPayeeType = data.has('payee_type');
        if (!data.has('payee_type')) {
            var type = dropdownEl.attr('id') === 'person_tracking' ? 'vendor' : dropdownEl.attr('id');

            if (type === undefined) {
                type = dropdownEl.attr('name').includes('customer') ? 'customer' : type;
                type = dropdownEl.attr('name').includes('vendor') ? 'vendor' : type;
            }

            data.append('payee_type', type);
        }

        $.ajax({
            url: base_url + 'accounting/add-new-payee',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function (result) {
                var res = JSON.parse(result);

                if (data.get('payee_type') === 'vendor') {
                    var name = res.payee.display_name;
                } else {
                    var name = res.payee.first_name + ' ' + res.payee.last_name;
                }

                if (dropdownEl === null && $("#accountingRulesPageWrapper")) {
                    // for accounting rules page
                    $("[data-type='assignments.payee']").append(`<option value="${data.get('payee_type') + '-' + res.payee.id}" selected>${name}</option>`);
                }

                if (dropdownEl !== null) {
                    if (hasPayeeType) {
                        dropdownEl.append(`<option value="${data.get('payee_type') + '-' + res.payee.id}" selected>${name}</option>`).trigger('change');
                    } else {
                        dropdownEl.append(`<option value="${res.payee.id}" selected>${name}</option>`).trigger('change');
                    }
                }

                $('#modal-container #payee-modal').modal('hide');
            }
        });
    });

    $(document).on('submit', '#modal-container #item-location-modal #new-location-form', function (e) {
        e.preventDefault();

        var data = new FormData(this);

        $.ajax({
            url: '/accounting/add-new-location',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function (result) {
                var res = JSON.parse(result);

                var name = data.get('location_name');

                if (dropdownEl !== null) {
                    dropdownEl.append(`<option value="${res.id}" selected>${name}</option>`).trigger('change');
                }

                $('#modal-container #item-location-modal').modal('hide');
            }
        });
    });

    $(document).on('hidden.bs.modal', '#modal-container #payee-modal', function () {
        $('#modal-container #payee-modal').remove();
    });

    $(document).on('change', '#modal-container #payee-modal #payee_type', function () {
        if ($(this).val() === 'customer') {
            var fields = `<div class="col-12">
                <label for="email">Email</label>
                <input data-type="customer_email" type="email" class="form-control nsm-field mb-2" name="email" id="email" required />
            </div>
            <div class="col-12">
                <label for="phone-m">Mobile</label>
                <input type="text" class="form-control nsm-field phone_number mb-2" maxlength="12" placeholder="xxx-xxx-xxxx" name="mobile" id="phone-m" required />
            </div>
            <div class="col-12 mb-2">
                <label for="customer-type">Customer Type</label>
                <select id="customer-type"  name="customer_type"  data-customer-source="dropdown"  class="form-control input_select" required>
                    <option value="Residential">Residential</option>
                    <option value="Business">Business</option>
                </select>
            </div>
            <div class="col-12">
                <label for="street">Address</label>
                <input name="street" id="street" class="form-control nsm-field mb-2" placeholder="Street" required>
            </div>
            <div class="col-12 col-md-6">
                <input name="city" type="text" class="form-control nsm-field mb-2" placeholder="City" required>
            </div>
            <div class="col-12 col-md-6">
                <input name="state" type="text" class="form-control nsm-field mb-2" placeholder="State" required>
            </div>
            <div class="col-12 col-md-6">
                <input name="zip_code" type="text" class="form-control nsm-field mb-2" placeholder="ZIP Code" required>
            </div>
            <div class="col-12 col-md-6">
                <input name="country" type="text" class="form-control nsm-field mb-2" placeholder="Country">
            </div>`;
            $(fields).insertBefore($(this).parent());

            $('#modal-container #payee-modal #customer-type').select2({
                minimumResultsForSearch: -1,
                dropdownParent: $('#modal-container #payee-modal')
            });

            $('#modal-container #payee-modal #add-payee-details').remove();
        } else {
            $('#modal-container #payee-modal #email').parent().remove();
            $('#modal-container #payee-modal #phone-m').parent().remove();
            $('#modal-container #payee-modal #customer-type').parent().remove();
            $('#modal-container #payee-modal #street').parent().remove();
            $('#modal-container #payee-modal input[name="city"]').parent().remove();
            $('#modal-container #payee-modal input[name="state"]').parent().remove();
            $('#modal-container #payee-modal input[name="zip_code"]').parent().remove();
            $('#modal-container #payee-modal input[name="country"]').parent().remove();
            $('#modal-container #payee-modal .modal-footer').prepend(`<button type="button" class="nsm-button" id="add-payee-details"><i class="bx bx-fw bx-plus"></i> Details</button>`);
        }
    });

    $(document).on('click', '#modal-container #payee-modal #add-payee-details', function () {
        var type = $('#modal-container #payee-modal #payee_type').val();
        var name = $('#modal-container #payee-modal #payee_name').val().trim();
        var nameSplit = name.split(' ');

        if (type === undefined) {
            if (dropdownEl.attr('id') === undefined) {
                type = dropdownEl.attr('name').includes('customer') ? 'customer' : 'vendor';
            } else {
                type = dropdownEl.attr('id');
            }
        }

        if (type === 'vendor' || type === 'person_tracking') {
            $.get('/accounting/get-add-vendor-details-modal', function (result) {
                $('#modal-container').append(result);

                var vendorAttachment = new Dropzone(`#vendAtt`, {
                    url: '/accounting/attachments/attach',
                    maxFilesize: 20,
                    uploadMultiple: true,
                    // maxFiles: 1,
                    addRemoveLinks: true,
                    init: function () {
                        this.on("success", function (file, response) {
                            var ids = JSON.parse(response)['attachment_ids'];
                            for (i in ids) {
                                if ($('#vendor-modal').find(`input[name="attachments[]"][value="${ids[i]}"]`).length === 0) {
                                    $('#modal-container #vendor-modal #vendAtt').parent().append(`<input type="hidden" name="attachments[]" value="${ids[i]}">`);
                                }

                                vendAttIds.push(ids[i]);
                            }
                            vendAttFiles.push(file);
                        });
                    },
                    removedfile: function (file) {
                        var ids = vendAttIds;
                        var index = vendAttFiles.map(function (d, index) {
                            if (d == file) return index;
                        }).filter(isFinite)[0];

                        $('#modal-container #vendor-modal').find(`input[name="attachments[]"][value="${ids[index]}"]`).remove();

                        //remove thumbnail
                        var previewElement;
                        return (previewElement = file.previewElement) !== null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
                    }
                });

                $('#modal-container #vendor-modal select').each(function () {
                    var select = $(this);
                    if (select.attr('id') === 'term' || select.attr('id') === 'expense_account') {
                        select.select2({
                            ajax: {
                                url: base_url + 'accounting/get-dropdown-choices',
                                dataType: 'json',
                                data: function (params) {
                                    var query = {
                                        search: params.term,
                                        type: 'public',
                                        field: select.attr('id').replace('_', '-'),
                                        modal: 'vendor-modal'
                                    }

                                    // Query parameters will be ?search=[term]&type=public&field=[type]
                                    return query;
                                }
                            },
                            placeholder: select.attr('id') === 'expense_account' ? "Choose Account" : '',
                            templateResult: formatResult,
                            templateSelection: optionSelect,
                            dropdownParent: $('#modal-container #vendor-modal')
                        });
                    } else {
                        select.select2({
                            minimumResultsForSearch: -1,
                            dropdownParent: $('#modal-container #vendor-modal')
                        });
                    }
                });

                $('#modal-container #vendor-modal .date').datepicker({
                    format: 'mm/dd/yyyy',
                    orientation: 'bottom',
                    autoclose: true
                });

                switch (nameSplit.length.toString()) {
                    case '1':
                        $('#modal-container #vendor-modal #f_name').val(nameSplit[0]);
                        break;
                    case '2':
                        $('#modal-container #vendor-modal #f_name').val(nameSplit[0]);
                        $('#modal-container #vendor-modal #l_name').val(nameSplit[1]);
                        break;
                    case '3':
                        $('#modal-container #vendor-modal #f_name').val(nameSplit[0]);
                        $('#modal-container #vendor-modal #m_name').val(nameSplit[1]);
                        $('#modal-container #vendor-modal #l_name').val(nameSplit[2]);
                        break;
                    case '4':
                        $('#modal-container #vendor-modal #title').val(nameSplit[0]);
                        $('#modal-container #vendor-modal #f_name').val(nameSplit[1]);
                        $('#modal-container #vendor-modal #m_name').val(nameSplit[2]);
                        $('#modal-container #vendor-modal #l_name').val(nameSplit[3]);
                        break;
                    case '5':
                        $('#modal-container #vendor-modal #title').val(nameSplit[0]);
                        $('#modal-container #vendor-modal #f_name').val(nameSplit[1]);
                        $('#modal-container #vendor-modal #m_name').val(nameSplit[2]);
                        $('#modal-container #vendor-modal #l_name').val(nameSplit[3]);
                        $('#modal-container #vendor-modal #suffix').val(nameSplit[4]);
                        break;
                }

                $('#modal-container #vendor-modal #display_name').val(name);
                $('#modal-container #vendor-modal #print_on_check_name').val(name);
                $('#modal-container #payee-modal').modal('hide');

                $('#modal-container #vendor-modal').attr('data-bs-backdrop', 'static');
                $('#modal-container #vendor-modal').attr('data-bs-keyboard', 'false');

                $('#modal-container #vendor-modal').modal('show');
            });
        } else {
            // $.get('/accounting/get-add-customer-details-modal', function(result) {
            //     $('#modal-container').append(result);

            //     var customerAttachment = new Dropzone(`#customerAttachment`, {
            //         url: '/accounting/attachments/attach',
            //         maxFilesize: 20,
            //         uploadMultiple: true,
            //         // maxFiles: 1,
            //         addRemoveLinks: true,
            //         init: function() {
            //             this.on("success", function(file, response) {
            //                 var ids = JSON.parse(response)['attachment_ids'];
            //                 for (i in ids) {
            //                     if ($('#customer-modal').find(`input[name="attachments[]"][value="${ids[i]}"]`).length === 0) {
            //                         $('#modal-container #customer-modal #custAttachment').parent().append(`<input type="hidden" name="attachments[]" value="${ids[i]}">`);
            //                     }

            //                     custAttIds.push(ids[i]);
            //                 }
            //                 custAttFiles.push(file);
            //             });
            //         },
            //         removedfile: function(file) {
            //             var ids = custAttIds;
            //             var index = custAttFiles.map(function(d, index) {
            //                 if (d == file) return index;
            //             }).filter(isFinite)[0];

            //             $('#modal-container #customer-modal').find(`input[name="attachments[]"][value="${ids[index]}"]`).remove();

            //             //remove thumbnail
            //             var previewElement;
            //             return (previewElement = file.previewElement) !== null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
            //         }
            //     });

            //     $('#modal-container #customer-modal select').select2({
            //         minimumResultsForSearch: -1,
            //         dropdownParent: $('#modal-container #customer-modal')
            //     });

            //     $('#modal-container #customer-modal .date').datepicker({
            //         format: 'mm/dd/yyyy',
            //         orientation: 'bottom',
            //         autoclose: true
            //     });

            //     switch (nameSplit.length.toString()) {
            //         case '1':
            //             $('#modal-container #customer-modal #f_name').val(nameSplit[0]);
            //             break;
            //         case '2':
            //             $('#modal-container #customer-modal #f_name').val(nameSplit[0]);
            //             $('#modal-container #customer-modal #l_name').val(nameSplit[1]);
            //             break;
            //         case '3':
            //             $('#modal-container #customer-modal #f_name').val(nameSplit[0]);
            //             $('#modal-container #customer-modal #m_name').val(nameSplit[1]);
            //             $('#modal-container #customer-modal #l_name').val(nameSplit[2]);
            //             break;
            //         case '4':
            //             $('#modal-container #customer-modal #title').val(nameSplit[0]);
            //             $('#modal-container #customer-modal #f_name').val(nameSplit[1]);
            //             $('#modal-container #customer-modal #m_name').val(nameSplit[2]);
            //             $('#modal-container #customer-modal #l_name').val(nameSplit[3]);
            //             break;
            //         case '5':
            //             $('#modal-container #customer-modal #title').val(nameSplit[0]);
            //             $('#modal-container #customer-modal #f_name').val(nameSplit[1]);
            //             $('#modal-container #customer-modal #m_name').val(nameSplit[2]);
            //             $('#modal-container #customer-modal #l_name').val(nameSplit[3]);
            //             $('#modal-container #customer-modal #suffix').val(nameSplit[4]);
            //             break;
            //     }

            //     $('#modal-container #customer-modal #display_name').val(name);
            //     $('#modal-container #customer-modal #print_on_check_name').val(name);
            //     $('#modal-container #payee-modal').modal('hide');

            //     $('#modal-container #customer-modal').attr('data-bs-backdrop', 'static');
            //     $('#modal-container #customer-modal').attr('data-bs-keyboard', 'false');
            //     $('#modal-container #customer-modal').modal('show');
            //     // $('#modal-container #customer-modal').modal({
            //     //     backdrop: 'static',
            //     //     keyboard: false
            //     // });
            // });
        }
    });

    $(document).on('click', '#modal-container #term-modal input[name="payment_term_type"]', function () {
        if ($(this).val() === "1" || $(this).val() === 1) {
            $('#modal-container #term-modal #net-due-days').prop('disabled', false);

            $('#modal-container #term-modal #day-of-month-due, #modal-container #term-modal #minimum-days-to-pay').prop('disabled', true);
            $('#modal-container #term-modal #day-of-month-due, #modal-container #term-modal #minimum-days-to-pay').val('');
        } else if ($(this).val() === "2" || $(this).val() === 2) {
            $('#modal-container #term-modal #net-due-days').val('');
            $('#modal-container #term-modal #net-due-days').prop('disabled', true);

            $('#modal-container #term-modal #day-of-month-due, #modal-container #term-modal #minimum-days-to-pay').prop('disabled', false);
        }
    });

    $(document).on('click', '#modal-container #customer-modal .banking-tab-container a', function (e) {
        e.preventDefault();

        $(this).parent().find('.banking-tab-active').removeClass('active').removeClass('text-decoration-none').addClass('banking-tab').removeClass('banking-tab-active');

        $(this).removeClass('banking-tab');
        $(this).addClass('banking-tab-active');
        $(this).addClass('text-decoration-none');
    });

    $(document).on('change', '#modal-container #vendor-modal #use_display_name', function () {
        if ($(this).prop('checked')) {
            var display_name = $('#modal-container #vendor-modal #display_name').val();
            $('#modal-container #vendor-modal #print_on_check_name').val(display_name);
            $('#modal-container #vendor-modal #print_on_check_name').prop('disabled', true);
        } else {
            $('#modal-container #vendor-modal #print_on_check_name').prop('disabled', false);
        }
    });

    $(document).on('change', '#modal-container #customer-modal #use_display_name', function () {
        if ($(this).prop('checked')) {
            var display_name = $('#modal-container #customer-modal #display_name').val();
            $('#modal-container #customer-modal #print_on_check_name').val(display_name);
            $('#modal-container #customer-modal #print_on_check_name').prop('disabled', true);
        } else {
            $('#modal-container #customer-modal #print_on_check_name').prop('disabled', false);
        }
    });

    $(document).on('change', '#modal-container #customer-modal #sub_customer', function () {
        if ($(this).prop('checked')) {
            $('#modal-container #customer-modal #parent_customer').prop('disabled', false);
            $('#modal-container #customer-modal #bill_with').prop('disabled', false);
        } else {
            $('#modal-container #customer-modal #parent_customer').prop('disabled', true);
            $('#modal-container #customer-modal #bill_with').prop('disabled', true);
        }
    });

    $(document).on('change', '#modal-container #customer-modal #same_as_billing_add', function () {
        if ($(this).prop('checked')) {
            $('#modal-container #customer-modal #shipping_address').prop('disabled', true);
            $('#modal-container #customer-modal #shipping_city').prop('disabled', true);
            $('#modal-container #customer-modal #shipping_state').prop('disabled', true);
            $('#modal-container #customer-modal #shipping_zip').prop('disabled', true);
            $('#modal-container #customer-modal #shipping_country').prop('disabled', true);
        } else {
            $('#modal-container #customer-modal #shipping_address').prop('disabled', false);
            $('#modal-container #customer-modal #shipping_city').prop('disabled', false);
            $('#modal-container #customer-modal #shipping_state').prop('disabled', false);
            $('#modal-container #customer-modal #shipping_zip').prop('disabled', false);
            $('#modal-container #customer-modal #shipping_country').prop('disabled', false);
        }
    });

    $(document).on('change', '#modal-container #customer-modal #cust_tax_exempt', function () {
        if ($(this).prop('checked')) {
            $('#modal-container #customer-modal #tax_rate').prop('disabled', true);
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
                dropdownParent: $('#modal-container #customer-modal')
            });
        } else {
            $('#modal-container #customer-modal #tax_rate').prop('disabled', false);
            $(this).parent().parent().parent().next().html('');
        }
    });

    $(document).on('click', '#modal-container #payee-modal .cancel-add-payee', function (e) {
        dropdownEl.html('').trigger('change');
    });

    $(document).on('click', '#modal-container #location-modal .cancel-add-location', function (e) {
        dropdownEl.html('').trigger('change');
    });

    $(document).on('click', '#modal-container #vendor-modal .cancel-add-vendor', function (e) {
        if (dropdownEl === null && $("#accountingRulesPageWrapper")) {
            // for accounting rules page
            $("[data-type='assignments.payee']").val('').trigger('change');
        }

        if (dropdownEl !== null) {
            dropdownEl.html('').trigger('change');
        }
    });

    $(document).on('click', '#modal-container #customer-modal .cancel-add-customer', function (e) {
        dropdownEl.html('').trigger('change');

        $('#modal-container #customer-modal').modal('hide');
    });

    $(document).on('hidden.bs.modal', '#modal-container #vendor-modal', function (e) {
        dropdownEl = null;

        $('#modal-container #vendor-modal').remove();
    });

    $(document).on('hidden.bs.modal', '#modal-container #customer-modal', function (e) {
        dropdownEl = null;

        $('#modal-container #customer-modal').hide();
    });

    $(document).on('submit', '#modal-container #vendor-modal #add-vendor-form', function (e) {
        e.preventDefault();

        var data = new FormData(this);
        data.set('payee_type', 'vendor');

        $.ajax({
            url: base_url + 'accounting/add-full-payee-details',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function (result) {
                var res = JSON.parse(result);

                var name = res.payee.display_name;

                dropdownEl.append(`<option value="${data.get('payee_type') + '-' + res.payee.id}" selected>${name}</option>`);

                $('#modal-container #vendor-modal').modal('hide');
            }
        });

        $('#modal-container #vendor-modal').modal('hide');
    });

    $(document).on('submit', '#modal-container #customer-modal #add-customer-form', function (e) {
        e.preventDefault();

        var data = new FormData(this);
        data.set('payee_type', 'customer');

        $.ajax({
            url: baseURL + '/accounting/add-full-payee-details',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function (result) {
                var res = JSON.parse(result);

                var name = res.payee.first_name + ' ' + res.payee.last_name;

                dropdownEl.append(`<option value="${data.get('payee_type') + '-' + res.payee.id}" selected>${name}</option>`).trigger('change');

                $('#modal-container #vendor-modal').modal('hide');
            }
        });

        $('#modal-container #customer-modal').modal('hide');
    });

    $(document).on('keyup', '#billPaymentModal #search', function () {
        // $('#billPaymentModal #bills-table').DataTable().ajax.reload(null, true);
    });

    $(document).on('keyup', '#billPaymentModal #search-vcredit-no', function () {
        // $('#billPaymentModal #vendor-credits-table').DataTable().ajax.reload(null, true);
    });

    $(document).on('change', '#billPaymentModal #table_rows', function () {
        // $('#billPaymentModal #bills-table').DataTable().ajax.reload(null, true);
    });

    $(document).on('change', '#billPaymentModal #vcredits_table_rows', function () {
        // $('#billPaymentModal #vendor-credits-table').DataTable().ajax.reload(null, true);
    });

    $(document).on('click', '#modal-container form .modal #show-existing-attachments', function () {
        if ($('#modal-container form .modal .transactions-container').length > 0) {
            $('#modal-container form .modal .transactions-container').parent().remove();
            $('#modal-container form .modal .close-transactions-container').parent().remove();
            $('#modal-container form .modal .open-transactions-container').parent().remove();
        }

        if ($('#modal-container form .modal .attachments-container').length < 1) {
            var transactionType = $('#modal-container form .modal .modal-title').text();
            $('#modal-container form .modal .modal-body').children('.row').append(`
                <div class="col-2 nsm-callout primary">
                    <div class="attachments-container h-100 p-3">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <h4>Add to ${transactionType}</h4>
                                <div class="d-flex justify-content-center">
                                    <select class="form-control nsm-field" id="attachment-types">
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
                minimumResultsForSearch: -1,
                dropdownParent: $('#modal-container form .modal')
            });

            var attachmentType = $('#modal-container form .modal #attachment-types').val();
            $.get(`/accounting/attachments/get-${attachmentType}-attachments-ajax`, function (res) {
                var attachments = JSON.parse(res);

                $.each(attachments, function (index, attachment) {
                    var dateUploaded = new Date(attachment.created_at);
                    var dateString = String(dateUploaded.getMonth() + 1).padStart(2, '0') + '/' + String(dateUploaded.getDate()).padStart(2, '0') + '/' + dateUploaded.getFullYear();

                    if ($('#modal-container form .modal .attachments').parent().find(`input[value="${attachment.id}"]`).length < 1) {
                        $('#modal-container form .modal .attachments-container').children().append(`
                            <div class="col-12 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">${attachment.uploaded_name}.${attachment.file_extension}</h5>
                                        <div class="card-subtitle">
                                            <div class="row">
                                                <div class="col">${dateString}</div>
                                                <div class="col d-flex justify-content-center">${attachment.type === 'Image' ? `<img class="w-50" src="/uploads/accounting/attachments/${attachment.stored_name}">` : ""}</div>
                                            </div>
                                        </div>
                                        <ul class="d-flex justify-content-around list-unstyled">
                                            <li><a href="#" class="text-decoration-none add-attachment" data-id="${attachment.id}"><strong>Add</strong></a></li>
                                            <li><a href="${attachment.type === 'Image' ? `/uploads/accounting/attachments/${attachment.stored_name}` : `/accounting/attachments/download?filename=${attachment.stored_name}`}" target="_blank" class="text-decoration-none">${attachment.type === 'Image' ? 'Preview' : 'Download'}</a></li>
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

    $(document).on('change', '#modal-container form .modal #attachment-types, #existing-attachments-modal #attachment-types', function () {
        var cont = $(this).parent().parent().parent();
        $.get(`/accounting/attachments/get-${$(this).val()}-attachments-ajax`, function (res) {
            var attachments = JSON.parse(res);

            cont.children('div.col-12:not(:first-child)').remove();
            $.each(attachments, function (index, attachment) {
                var dateUploaded = new Date(attachment.created_at);
                var dateString = String(dateUploaded.getMonth() + 1).padStart(2, '0') + '/' + String(dateUploaded.getDate()).padStart(2, '0') + '/' + dateUploaded.getFullYear();

                if ($('#modal-container form .modal .attachments').parent().find(`input[value="${attachment.id}"]`).length < 1) {
                    cont.append(`
                        <div class="col-12 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">${attachment.uploaded_name}.${attachment.file_extension}</h5>
                                    <div class="card-subtitle">
                                        <div class="row">
                                            <div class="col">${dateString}</div>
                                            <div class="col d-flex justify-content-center">${attachment.type === 'Image' ? `<img class="w-50" src="/uploads/accounting/attachments/${attachment.stored_name}">` : ""}</div>
                                        </div>
                                    </div>
                                    <ul class="d-flex justify-content-around list-unstyled">
                                        <li><a href="#" class="text-decoration-none add-attachment" data-id="${attachment.id}"><strong>Add</strong></a></li>
                                        <li><a href="${attachment.type === 'Image' ? `/uploads/accounting/attachments/${attachment.stored_name}` : `/accounting/attachments/download?filename=${attachment.stored_name}`}" target="_blank" class="text-decoration-none">${attachment.type === 'Image' ? 'Preview' : 'Download'}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    `);
                }
            });
        });
    });

    $(document).on('click', '#modal-container form .modal .attachments-container a.add-attachment', function (e) {
        var id = e.currentTarget.dataset.id;
        if ($('#modal-container form .modal .attachments').parent().find(`input[value="${id}"]`).length < 1) {
            $('#modal-container form .modal .attachments').parent().append(`<input type="hidden" name="attachments[]" value="${id}">`);

            $.get('/accounting/get-attachment/' + id, function (res) {
                var attachment = JSON.parse(res);

                modalAttachmentId.push(id);
                var mockFile = {
                    name: `${attachment.uploaded_name}.${attachment.file_extension}`,
                    size: parseInt(attachment.size),
                    dataURL: base_url + "uploads/accounting/attachments/" + attachment.stored_name,
                    accepted: true
                };
                modalAttachments.emit("addedfile", mockFile);
                modalAttachedFiles.push(mockFile);

                modalAttachments.createThumbnailFromUrl(mockFile, modalAttachments.options.thumbnailWidth, modalAttachments.options.thumbnailHeight, modalAttachments.options.thumbnailMethod, true, function (thumbnail) {
                    modalAttachments.emit('thumbnail', mockFile, thumbnail);
                });
                modalAttachments.emit("complete", mockFile);
            });

            $(this).parent().parent().parent().parent().parent().remove();
        }
    });

    $(document).on('click', '#modal-container form #depositModal #delete-deposit', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/deposit/${split[1]}`,
            type: 'DELETE',
            success: function (result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#modal-container form #transferModal #delete-transfer', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/transfer/${split[1]}`,
            type: 'DELETE',
            success: function (result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#modal-container form #transferModal #void-transfer', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.get('/accounting/void-transaction/transfer/' + split[1], function (res) {
            location.reload();
        });
    });

    $(document).on('click', '#modal-container form #journalEntryModal #copy-journal-entry', function (e) {
        e.preventDefault();

        $('#modal-container form').attr('onsubmit', 'submitModalForm(event, this)');
        $('#modal-container form').removeAttr('data-href');
        $('#modal-container form .modal-body .row.journal-entry-details').prepend(`<div class="col-md-12">
            <div class="alert alert-info alert-dismissible mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="mt-0">This is a copy</h6>
                <span>This is a copy of an expense. Revise as needed and save the expense.</span>
            </div>
        </div>`);

        $('#modal-container form .modal-footer .row').children('div:nth-child(2)').addClass('d-flex').html(`<a href="#" class="text-white m-auto" onclick="makeRecurring('journal_entry')">Make Recurring</a>`);
    });

    $(document).on('click', '#modal-container form #journalEntryModal #delete-journal-entry', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/journal/${split[1]}`,
            type: 'DELETE',
            success: function (result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#modal-container form #expenseModal #copy-expense', function (e) {
        e.preventDefault();

        $('#modal-container form').attr('onsubmit', 'submitModalForm(event, this)');
        $('#modal-container form').removeAttr('data-href');
        $('#modal-container form .modal-body .row.payee-details').next().prepend(`<div class="col-md-12">
            <div class="alert alert-info alert-dismissible mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="mt-0">This is a copy</h6>
                <span>This is a copy of an expense. Revise as needed and save the expense.</span>
            </div>
        </div>`);

        $('#modal-container form .modal-footer .row').children('div:nth-child(2)').addClass('d-flex').html(`<a href="#" class="text-white m-auto" onclick="makeRecurring('expense')">Make Recurring</a>`);
    });

    $(document).on('click', '#modal-container form #expenseModal #delete-expense', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/expense/${split[1]}`,
            type: 'DELETE',
            success: function (result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#modal-container form #expenseModal #void-expense', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.get('/accounting/void-transaction/expense/' + split[1], function (res) {
            location.reload();
        });
    });

    $(document).on('click', '#modal-container form #checkModal #copy-check', function (e) {
        e.preventDefault();

        $('#modal-container form').attr('onsubmit', 'submitModalForm(event, this)');
        $('#modal-container form').removeAttr('data-href');
        $('#modal-container form .modal-body .row.payee-details').next().prepend(`<div class="col-md-12">
            <div class="alert alert-info alert-dismissible mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="mt-0">This is a copy</h6>
                <span>This is a copy of a check. Revise as needed and save the check.</span>
            </div>
        </div>`);

        $('#modal-container form .modal-footer .row').children('div:nth-child(2)').find('.dropdown-menu').html(`<a class="dropdown-item" href="#" onclick="saveAndVoid(event)" id="save-and-void">Void</a>`);
    });

    $(document).on('click', '#modal-container form #checkModal #delete-check', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/check/${split[1]}`,
            type: 'DELETE',
            success: function (result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#modal-container form #checkModal #void-check', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.get('/accounting/void-transaction/check/' + split[1], function (res) {
            location.reload();
        });
    });

    $(document).on('click', '#modal-container form #checkModal #print-check', function (e) {
        e.preventDefault();

        $('#modal-container form #checkModal #print_later').prop('checked', true).trigger('change');

        submitType = 'checkModal';
        //submitType = 'save-and-close';

        $('#modal-container form').submit();

        //$('#new-popup #accounting_vendors .ajax-modal[data-view="print_checks_modal"]').trigger('click');
        //$('#print-checks').trigger('click');        
    });

    $(document).on('click', '#modal-container form #billPaymentModal #print-check', function (e) {
        e.preventDefault();

        $('#modal-container form #billPaymentModal #print_later').prop('checked', true).trigger('change');

        submitType = 'save-and-close';

        $('#modal-container form').submit();

        $('#new-popup #accounting_vendors .ajax-modal[data-view="print_checks_modal"]').trigger('click');
    });

    $(document).on('click', '#modal-container form #billModal #copy-bill', function (e) {
        e.preventDefault();

        $('#modal-container form').attr('onsubmit', 'submitModalForm(event, this)');
        $('#modal-container form').removeAttr('data-href');
        $('#modal-container form .modal-body .row.payee-details').next().prepend(`<div class="col-md-12">
            <div class="alert alert-info alert-dismissible my-4" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="mt-0">This is a copy</h6>
                <span>This is a copy of a bill. Revise as needed and save the bill.</span>
            </div>
        </div>`);

        $('#modal-container form .modal-footer .row').children('div:nth-child(2)').addClass('d-flex').html(`<a href="#" class="text-white m-auto" onclick="makeRecurring('bill')">Make Recurring</a>`);
    });

    $(document).on('click', '#modal-container form #billModal #delete-bill', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/bill/${split[1]}`,
            type: 'DELETE',
            success: function (result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#modal-container form #billPaymentModal #void-bill-payment', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.get('/accounting/void-transaction/bill-payment/' + split[1], function (res) {
            location.reload();
        });
    });

    $(document).on('click', '#modal-container form #billPaymentModal #delete-bill-payment', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/bill-payment/${split[1]}`,
            type: 'DELETE',
            success: function (result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#modal-container form #purchaseOrderModal #copy-purchase-order', function (e) {
        e.preventDefault();

        $('#modal-container form').attr('onsubmit', 'submitModalForm(event, this)');
        $('#modal-container form').removeAttr('data-href');
        $('#modal-container form .modal-body .row.payee-details').next().prepend(`<div class="col-md-12">
            <div class="alert alert-info alert-dismissible mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="mt-0">This is a copy</h6>
                <span>This is a copy of a purchase order. Revise as needed and save the purchase order.</span>
            </div>
        </div>`);

        $('#modal-container form .modal-footer .row').children('div:nth-child(2)').find('.dropdown-menu').parent().parent().prev().remove();
        $('#modal-container form .modal-footer .row').children('div:nth-child(2)').find('.dropdown-menu').parent().parent().remove();
    });

    $(document).on('click', '#modal-container form #purchaseOrderModal #delete-purchase-order', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/purchase-order/${split[1]}`,
            type: 'DELETE',
            success: function (result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#modal-container form #vendorCreditModal #copy-vendor-credit', function (e) {
        e.preventDefault();

        $('#modal-container form').attr('onsubmit', 'submitModalForm(event, this)');
        $('#modal-container form').removeAttr('data-href');
        $('#modal-container form .modal-body .row.payee-details').next().prepend(`<div class="col-md-12">
            <div class="alert alert-info alert-dismissible mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="mt-0">This is a copy</h6>
                <span>This is a copy of a vendor credit. Revise as needed and save the vendor credit.</span>
            </div>
        </div>`);

        $('#modal-container form .modal-footer .row').children('div:nth-child(2)').addClass('d-flex').html(`<a href="#" class="text-white m-auto" onclick="makeRecurring('vendor_credit')">Make Recurring</a>`);
    });

    $(document).on('click', '#modal-container form #vendorCreditModal #delete-vendor-credit', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/vendor-credit/${split[1]}`,
            type: 'DELETE',
            success: function (result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#modal-container form #creditCardCreditModal #copy-cc-credit', function (e) {
        e.preventDefault();

        $('#modal-container form').attr('onsubmit', 'submitModalForm(event, this)');
        $('#modal-container form').removeAttr('data-href');
        $('#modal-container form .modal-body .row.payee-details').next().prepend(`<div class="col-md-12">
            <div class="alert alert-info alert-dismissible mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="mt-0">This is a copy</h6>
                <span>This is a copy of a credit card credit. Revise as needed and save the credit card credit.</span>
            </div>
        </div>`);

        $('#modal-container form .modal-footer .row').children('div:nth-child(2)').addClass('d-flex').html(`<a href="#" class="text-white m-auto" onclick="makeRecurring('credit_card_credit')">Make Recurring</a>`);
    });

    $(document).on('click', '#modal-container form #creditCardCreditModal #delete-cc-credit', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/cc-credit/${split[1]}`,
            type: 'DELETE',
            success: function (result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#modal-container form #creditCardCreditModal #void-cc-credit', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.get('/accounting/void-transaction/cc-credit/' + split[1], function (res) {
            location.reload();
        });
    });

    $(document).on('click', '#modal-container form #payDownCreditModal #delete-credit-card-payment', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/credit-card-payment/${split[1]}`,
            type: 'DELETE',
            success: function (result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#modal-container form #payDownCreditModal #void-credit-card-payment', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.get('/accounting/void-transaction/credit-card-payment/' + split[1], function (res) {
            location.reload();
        });
    });
    //singletimemodal
    $(document).on('click', '#modal-container form #singleTimeModal #delete-time-activity', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/time-activity/${split[1]}`,
            type: 'DELETE',
            success: function (result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#modal-container form #receivePaymentModal #void-payment', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.get('/accounting/void-transaction/receive-payment/' + split[1], function (res) {
            location.reload();
        });
    });

    $(document).on('click', '#modal-container form #receivePaymentModal #delete-payment', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/receive-payment/${split[1]}`,
            type: 'DELETE',
            success: function (result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#modal-container form #receivePaymentModal #save-and-print', function (e) {
        e.preventDefault();

        submitType = 'save-and-print';

        $('#modal-container form').submit();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.get('/accounting/print-payment-modal/' + split[1], function (result) {
            $('div#modal-container').append(result);

            $('#viewPrintPaymentModal').modal('show');
        });
    });

    $(document).on('hidden.bs.modal', '#viewPrintPaymentModal', function () {
        $(this).parent().parent().next('.modal-backdrop').remove();
        $(this).parent().remove();
    });

    $(document).on('click', '#viewPrintPaymentModal #preview-and-print', function (e) {
        e.preventDefault();

        let pdfWindow = window.open("");
        pdfWindow.document.write(`<iframe width="100%" height="100%" src="${$('#viewPrintPaymentModal iframe').attr('src')}"></iframe>`);
        $(pdfWindow.document).find('body').css('padding', '0');
        $(pdfWindow.document).find('body').css('margin', '0');
        $(pdfWindow.document).find('iframe').css('border', '0');
    });

    $(document).on('click', '#modal-container form #invoiceModal #copy-invoice', function (e) {
        e.preventDefault();

        $('#modal-container form').attr('onsubmit', 'submitModalForm(event, this)');
        $('#modal-container form').removeAttr('data-href');
        $('#modal-container form .modal-body .row.customer-details').next().prepend(`<div class="col-md-12">
            <div class="alert alert-info alert-dismissible mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="mt-0">This is a copy</h6>
                <span>This is a copy of a invoice. Revise as needed and save the invoice.</span>
            </div>
        </div>`);

        $('#modal-container form .modal-footer .row').children('div:nth-child(2)').find('.dropdown-menu').parent().parent().prev().remove();
        $('#modal-container form .modal-footer .row').children('div:nth-child(2)').find('.dropdown-menu').parent().parent().remove();

        $('#invoiceModal .modal-title span').html('');
        $.get('/accounting/get-last-invoice-number', function (result) {
            $('#invoiceModal #invoice-no').val(result);
        });
    });

    $(document).on('click', '#modal-container form #invoiceModal #void-invoice', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.get('/accounting/void-transaction/invoice/' + split[1], function (res) {
            location.reload();
        });
    });

    $(document).on('click', '#modal-container form #invoiceModal #delete-invoice', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/invoice/${split[1]}`,
            type: 'DELETE',
            success: function (result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#invoiceModal .modal-footer #save-and-print', function (e) {
        e.preventDefault();

        submitType = 'save-and-print';

        $('#modal-container form').submit();
    });

    $(document).on('hidden.bs.modal', '#viewPrintInvoiceModal', function () {
        $(this).parent().parent().next('.modal-backdrop').remove();
        $(this).parent().remove();
    });

    $(document).on('click', '#viewPrintInvoiceModal #preview-and-print', function (e) {
        e.preventDefault();

        let pdfWindow = window.open("");
        pdfWindow.document.write(`<iframe width="100%" height="100%" src="${$('#viewPrintInvoiceModal iframe').attr('src')}"></iframe>`);
        $(pdfWindow.document).find('body').css('padding', '0');
        $(pdfWindow.document).find('body').css('margin', '0');
        $(pdfWindow.document).find('iframe').css('border', '0');
    });

    $(document).on('click', '#modal-container form #creditMemoModal #copy-credit-memo', function (e) {
        e.preventDefault();

        $('#modal-container form').attr('onsubmit', 'submitModalForm(event, this)');
        $('#modal-container form').removeAttr('data-href');
        $('#modal-container form .modal-body .row.customer-details').next().prepend(`<div class="col-md-12">
            <div class="alert alert-info alert-dismissible mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="mt-0">This is a copy</h6>
                <span>This is a copy of a credit memo. Revise as needed and save the credit memo.</span>
            </div>
        </div>`);

        $('#modal-container form .modal-footer .row').children('div:nth-child(2)').find('.dropdown-menu').parent().parent().prev().remove();
        $('#modal-container form .modal-footer .row').children('div:nth-child(2)').find('.dropdown-menu').parent().parent().remove();
    });

    $(document).on('click', '#modal-container form #creditMemoModal #void-credit-memo', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.get('/accounting/void-transaction/credit-memo/' + split[1], function (res) {
            location.reload();
        });
    });

    $(document).on('click', '#modal-container form #creditMemoModal #delete-credit-memo', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/credit-memo/${split[1]}`,
            type: 'DELETE',
            success: function (result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#creditMemoModal .modal-footer #save-and-print', function (e) {
        e.preventDefault();
        submitType = 'save-and-print';

        $('#modal-container form').submit();
    });

    $(document).on('hidden.bs.modal', '#viewPrintCreditMemoModal', function () {
        $(this).parent().parent().next('.modal-backdrop').remove();
        $(this).parent().remove();
    });

    $(document).on('click', '#viewPrintCreditMemoModal #preview-and-print', function (e) {
        e.preventDefault();

        let pdfWindow = window.open("");
        pdfWindow.document.write(`<iframe width="100%" height="100%" src="${$('#viewPrintCreditMemoModal iframe').attr('src')}"></iframe>`);
        $(pdfWindow.document).find('body').css('padding', '0');
        $(pdfWindow.document).find('body').css('margin', '0');
        $(pdfWindow.document).find('iframe').css('border', '0');
    });

    $(document).on('click', '#modal-container form #salesReceiptModal #copy-sales-receipt', function (e) {
        e.preventDefault();

        $('#modal-container form').attr('onsubmit', 'submitModalForm(event, this)');
        $('#modal-container form').removeAttr('data-href');
        $('#modal-container form .modal-body .row.customer-details').next().prepend(`<div class="col-md-12">
            <div class="alert alert-info alert-dismissible mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="mt-0">This is a copy</h6>
                <span>This is a copy of a sales receipt. Revise as needed and save the sales receipt.</span>
            </div>
        </div>`);

        $('#modal-container form .modal-footer .row').children('div:nth-child(2)').find('.dropdown-menu').parent().parent().prev().remove();
        $('#modal-container form .modal-footer .row').children('div:nth-child(2)').find('.dropdown-menu').parent().parent().remove();
    });

    $(document).on('click', '#modal-container #salesReceiptModal #void-sales-receipt', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.get('/accounting/void-transaction/sales-receipt/' + split[1], function (res) {
            location.reload();
        });
    });

    $(document).on('click', '#modal-container form #salesReceiptModal #delete-sales-receipt', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/sales-receipt/${split[1]}`,
            type: 'DELETE',
            success: function (result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#salesReceiptModal .modal-footer #save-and-print', function (e) {
        e.preventDefault();

        submitType = 'save-and-print';

        $('#modal-container form').submit();
    });

    $(document).on('hidden.bs.modal', '#viewPrintSalesReceiptModal', function () {
        $(this).parent().parent().next('.modal-backdrop').remove();
        $(this).parent().remove();
    });

    $(document).on('click', '#viewPrintSalesReceiptModal #preview-and-print', function (e) {
        e.preventDefault();

        let pdfWindow = window.open("");
        pdfWindow.document.write(`<iframe width="100%" height="100%" src="${$('#viewPrintSalesReceiptModal iframe').attr('src')}"></iframe>`);
        $(pdfWindow.document).find('body').css('padding', '0');
        $(pdfWindow.document).find('body').css('margin', '0');
        $(pdfWindow.document).find('iframe').css('border', '0');
    });

    $(document).on('click', '#modal-container form #refundReceiptModal #copy-refund-receipt', function (e) {
        e.preventDefault();

        $('#modal-container form').attr('onsubmit', 'submitModalForm(event, this)');
        $('#modal-container form').removeAttr('data-href');
        $('#modal-container form .modal-body .row.customer-details').next().prepend(`<div class="col-md-12">
            <div class="alert alert-info alert-dismissible mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="mt-0">This is a copy</h6>
                <span>This is a copy of a refund receipt. Revise as needed and save the refund receipt.</span>
            </div>
        </div>`);

        $('#modal-container form .modal-footer .row').children('div:nth-child(2)').find('.dropdown-menu').parent().parent().prev().remove();
        $('#modal-container form .modal-footer .row').children('div:nth-child(2)').find('.dropdown-menu').parent().parent().remove();
    });

    $(document).on('click', '#modal-container #refundReceiptModal #void-refund-receipt', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.get('/accounting/void-transaction/refund-receipt/' + split[1], function (res) {
            location.reload();
        });
    });

    $(document).on('click', '#modal-container form #refundReceiptModal #delete-refund-receipt', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/refund-receipt/${split[1]}`,
            type: 'DELETE',
            success: function (result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#refundReceiptModal .modal-footer #save-and-print', function (e) {
        e.preventDefault();

        submitType = 'save-and-print';

        $('#modal-container form').submit();
    });

    $(document).on('hidden.bs.modal', '#viewPrintRefundReceiptModal', function () {
        $(this).parent().parent().next('.modal-backdrop').remove();
        $(this).parent().remove();
    });

    $(document).on('click', '#viewPrintRefundReceiptModal #preview-and-print', function (e) {
        e.preventDefault();

        let pdfWindow = window.open("");
        pdfWindow.document.write(`<iframe width="100%" height="100%" src="${$('#viewPrintRefundReceiptModal iframe').attr('src')}"></iframe>`);
        $(pdfWindow.document).find('body').css('padding', '0');
        $(pdfWindow.document).find('body').css('margin', '0');
        $(pdfWindow.document).find('iframe').css('border', '0');
    });

    $(document).on('click', '#modal-container form #delayedCreditModal #copy-delayed-credit', function (e) {
        e.preventDefault();

        $('#modal-container form').attr('onsubmit', 'submitModalForm(event, this)');
        $('#modal-container form').removeAttr('data-href');
        $('#modal-container form .modal-body .row.customer-details').next().prepend(`<div class="col-md-12">
            <div class="alert alert-info alert-dismissible mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="mt-0">This is a copy</h6>
                <span>This is a copy of a delayed credit. Revise as needed and save the delayed credit.</span>
            </div>
        </div>`);

        $('#modal-container form .modal-footer .row').children('div:nth-child(2)').addClass('d-flex').html(`<a href="#" class="text-white m-auto" onclick="makeRecurring('delayed_credit')">Make Recurring</a>`);
    });

    $(document).on('click', '#modal-container form #delayedCreditModal #delete-delayed-credit', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/delayed-credit/${split[1]}`,
            type: 'DELETE',
            success: function (result) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#modal-container form #delayedChargeModal #copy-delayed-charge', function (e) {
        e.preventDefault();

        $('#modal-container form').attr('onsubmit', 'submitModalForm(event, this)');
        $('#modal-container form').removeAttr('data-href');
        $('#modal-container form .modal-body .row.customer-details').next().prepend(`<div class="col-md-12">
            <div class="alert alert-info alert-dismissible mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="mt-0">This is a copy</h6>
                <span>This is a copy of a delayed charge. Revise as needed and save the delayed charge.</span>
            </div>
        </div>`);

        $('#modal-container form .modal-footer .row').children('div:nth-child(2)').addClass('d-flex').html(`<a href="#" class="text-white m-auto" onclick="makeRecurring('delayed_charge')">Make Recurring</a>`);
    });

    $(document).on('click', '#modal-container form #delayedChargeModal #delete-delayed-charge', function (e) {
        e.preventDefault();

        var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

        $.ajax({
            url: `/accounting/delete-transaction/delayed-charge/${split[1]}`,
            type: 'DELETE',
            success: function (result) {
                location.reload();
            }
        });
    });

    $(document).on('show.bs.dropdown', '#modal-container form .modal .modal-header .dropdown', function () {
        var table = $(this).find('table.recent-transactions-table');
        var tableId = table.attr('id');

        $.get(base_url + 'accounting/load-recent-transactions?type=' + tableId.replace('recent-', ''), function (res) {
            var transactions = JSON.parse(res);

            if (transactions.length < 1) {
                table.children('tbody').html(`<tr class="empty-table">
                    <td>
                        <div class="nsm-empty">
                            <span>Once you enter some transactions, they’ll appear here.</span>
                        </div>
                    </td>
                </tr>`);
            } else {
                table.children('tbody').html('');
                $.each(transactions, function (key, transaction) {
                    table.children('tbody').append(`<tr data-id="${transaction.id}" onclick="printcheck(${transaction.id}, ${transaction.bank_account_id}, '${transaction.bank_account}')">
                        <td>${transaction.type}</td>
                        <td>${transaction.date}</td>
                        <td>${transaction.amount}</td>
                        <td>${transaction.name}</td>
                    </tr>`);
                });
            }
        });
    });
    // $(document).on('show.bs.dropdown', '#modal-container .modal .modal-header .dropdown', function() {
    //     var tableId = $(this).find('table').attr('id');
    //     if($.fn.DataTable.isDataTable(`#${tableId}`)) {
    //         $(`#${tableId}`).DataTable().clear();
    //         $(`#${tableId}`).DataTable().destroy();
    //     }

    //     $(`#${tableId}`).DataTable({
    //         autoWidth: false,
    //         searching: false,
    //         processing: true,
    //         serverSide: true,
    //         lengthChange: false,
    //         pageLength: 10,
    //         info: false,
    //         ordering: false,
    //         paging: false,
    //         ajax: {
    //             url: '/accounting/load-recent-transactions',
    //             dataType: 'json',
    //             contentType: 'application/json',
    //             type: 'POST',
    //             data: function(d) {
    //                 d.transaction_type = tableId.replace('recent-', '');
    //                 return JSON.stringify(d);
    //             },
    //             pagingType: 'full_numbers'
    //         },
    //         columns: [
    //             {
    //                 data: 'type',
    //                 name: 'type'
    //             },
    //             {
    //                 data: 'date',
    //                 name: 'date'
    //             },
    //             {
    //                 data: 'amount',
    //                 name: 'amount'
    //             },
    //             {
    //                 data: 'name',
    //                 name: 'name'
    //             }
    //         ],
    //         fnCreatedRow: function(row, data, dataIndex) {
    //             $(row).attr('onclick', 'viewTransaction(this)');
    //         },
    //         language: {
    //             emptyTable: `Once you enter some ${tableId.replace('recent-', '').replace('-', ' ')}, they'll appear here.`
    //         }
    //     });
    // });

    $(document).on('click', '#viewPrintPurchaseOrderModal #print-pdf', function (e) {
        e.preventDefault();

        let pdfWindow = window.open("");
        pdfWindow.document.write(`<iframe width="100%" height="100%" src="${$('#viewPrintPurchaseOrderModal iframe').attr('src')}"></iframe>`);
        $(pdfWindow.document).find('body').css('padding', '0');
        $(pdfWindow.document).find('body').css('margin', '0');
        $(pdfWindow.document).find('iframe').css('border', '0');
    });

    $(document).on('hidden.bs.modal', '#viewPrintPurchaseOrderModal', function () {
        $(this).parent().remove();
    });

    $(document).on('click', '#sendEmailModal #print-pdf', function (e) {
        e.preventDefault();

        var src = $('#sendEmailModal iframe').attr('src');

        let pdfWindow = window.open("");
        pdfWindow.document.write(`<iframe width="100%" height="100%" src="${src}"></iframe>`);
        $(pdfWindow.document).find('body').css('padding', '0');
        $(pdfWindow.document).find('body').css('margin', '0');
        $(pdfWindow.document).find('iframe').css('border', '0');
    });

    $(document).on('click', '#sendEmailModal #send-and-close', function (e) {
        e.preventDefault();

        submitType = 'send-and-close';

        $('#sendEmailModal #send-email-form').submit();
    });

    $(document).on('click', '#sendEmailModal #send-and-new', function (e) {
        e.preventDefault();

        submitType = 'send-and-new';

        $('#sendEmailModal #send-email-form').submit();
    })

    $(document).on('submit', '#sendEmailModal #send-email-form', function (e) {
        e.preventDefault();

        var data = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function (result) {
                var res = JSON.parse(result);
                if (res.success === true) {
                    $('#sendEmailModal').modal('hide');

                    switch (submitType) {
                        case 'send-and-close':
                            $('#purchaseOrderModal').modal('hide');
                            break;
                        case 'send-and-new':
                            clearForm();
                            break;
                    }

                    toast(res.success, res.message);
                }
            }
        });
    });

    $(document).on('hidden.bs.modal', '#sendEmailModal', function () {
        $(this).parent().remove();
    });

    $(document).on('change', '#weeklyTimesheetModal #person_tracking, #weeklyTimesheetModal #weekDates', function () {
        var data = new FormData();

        data.set('person_tracking', $('#weeklyTimesheetModal #person_tracking').val());
        data.set('date_range', $('#weeklyTimesheetModal #weekDates').val());

        $.ajax({
            url: '/accounting/get-timesheet-activities',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function (result) {
                $('#weeklyTimesheetModal #clear-table-line').trigger('click');
                var res = JSON.parse(result);
                var activities = res.activities;
                if (activities.length > 0) {
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
                            $('#weeklyTimesheetModal #timesheet-table tbody tr:last-child() input[name="billable[]"]').attr('id', `billable_${count + 1}`).prop('checked', false).trigger('change');
                            $('#weeklyTimesheetModal #timesheet-table tbody tr:last-child() input[name="billable[]"]').next().attr('for', `billable_${count + 1}`);
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
                                <input type="checkbox" name="taxable[]" id="taxable_${count + 1}" class="ml-2 form-check-input" value="1" ${activity.taxable === "1" ? 'checked' : ''}>
                                <label class="form-check-label" for="taxable_${count + 1}">Taxable</label>
                            </div>`);
                        }

                        $($('#weeklyTimesheetModal #timesheet-table tbody tr')[count]).find('select').each(function () {
                            var field = $(this).attr('name').replace('[]', '');

                            $(this).select2({
                                ajax: {
                                    url: base_url + 'accounting/get-dropdown-choices',
                                    dataType: 'json',
                                    data: function (params) {
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
                                templateSelection: optionSelect,
                                dropdownParent: $('#weeklyTimesheetModal')
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

    $(document).on('click', '#modal-container form .modal .modal-footer #save-template', function (e) {
        e.preventDefault();

        submitType = 'save-and-close';

        if ($('#modal-container form').length > 0) {
            $('#modal-form').submit();
        } else {
            $('#update-recurring-form').submit();
        }
    });

    $(document).on('change', '#invoiceModal #customer', function () {
        if ($(this).val() !== '' && $(this).val() !== null && $(this).val() !== 'add-new') {
            $.get(base_url + `accounting/get-customer-details/${$(this).val()}`, function (result) {
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
                    if (customerName.trim() !== '') {
                        $('#invoiceModal #billing-address').append('\n');
                    }
                }
                var billingAdd = '';
                billingAdd += customer.mail_add !== "" ? customer.mail_add + '\n' : "";
                billingAdd += customer.city !== "" ? customer.city + ', ' : "";
                billingAdd += customer.state !== "" ? customer.state + ' ' : "";
                billingAdd += customer.zip_code !== "" ? customer.zip_code + ' ' : "";
                billingAdd += customer.country !== "" ? customer.country : "";

                $('#invoiceModal #billing-address').append(billingAdd.trim());

                var jobLoc = '';
                jobLoc += customer.mail_add !== "" ? customer.mail_add + ' ' : "";
                jobLoc += customer.city !== "" ? customer.city + ', ' : "";
                jobLoc += customer.state !== "" ? customer.state : "";
                $('#invoiceModal #job-location').val(jobLoc.trim());

                $('#invoiceModal #customer-email').val(customer.email);
            });

            if ($('#invoiceModal #templateName').length < 1) {
                $.get(base_url + 'accounting/get-linkable-transactions/invoice/' + $(this).val(), function (res) {
                    var transactions = JSON.parse(res);

                    if (transactions.length > 0) {
                        if ($('#invoiceModal .attachments-container').length > 0) {
                            $('#invoiceModal .attachments-container').parent().parent().remove();
                        }

                        if ($('#invoiceModal .transactions-container').length > 0) {
                            $('#invoiceModal .transactions-container #transaction-type').trigger('change');
                        } else {
                            $('#invoiceModal .transactions-container').parent().remove();

                            $('#invoiceModal .modal-body').children('.row').append(`
                                <div class="nsm-callout primary" style="width: 15%">
                                    <div class="transactions-container h-100 p-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <h4>Add to Invoice</h4>
                                            </div>
                                            <div class="col-12">
                                                <div class="grid-mb">
                                                    <label for="">Filter by</label>
                                                    <select class="form-control nsm-field" id="transaction-type">
                                                        <option value="all">All types</option>
                                                        <option value="charges">Charges</option>
                                                        <option value="credits">Credits</option>
                                                    </select>
                                                </div>
                                                <div class="grid-mb">
                                                    <select class="form-control nsm-field" id="transaction-date">
                                                        <option value="all">All dates</option>
                                                        <option value="this-month">This month</option>
                                                        <option value="last-month">Last month</option>
                                                        <option value="custom">Custom...</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `);

                            $('#invoiceModal #transaction-type, #invoiceModal #transaction-date').select2({
                                minimumResultsForSearch: -1,
                                dropdownParent: $('#invoiceModal')
                            });

                            $.each(transactions, function (index, transaction) {
                                var title = transaction.type;
                                title += transaction.number !== '' ? ' #' + transaction.number : '';

                                if ($(`#invoiceModal input[name="linked_transaction[]"][value="${transaction.data_type.replace('-', '_')}-${transaction.id}"]`).length < 1) {
                                    $('#invoiceModal .modal-body .row .transactions-container .row').append(`
                                    <div class="col-12 grid-mb">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">${title}</h5>
                                                <p class="card-subtitle">${transaction.formatted_date}</p>
                                                <p class="card-text">
                                                    ${transaction.type === 'Purchase Order' ? `<strong>Total</strong>&emsp;${transaction.total}<br><strong>Balance</strong>&emsp;${transaction.balance}` : transaction.amount}
                                                </p>
                                                <ul class="d-flex justify-content-around list-unstyled">
                                                    <li><a href="#" class="text-decoration-none add-transaction" data-id="${transaction.id}" data-type="${transaction.data_type}"><strong>Add</strong></a></li>
                                                    <li><a href="#" class="text-decoration-none open-transaction" data-id="${transaction.id}" data-type="${transaction.data_type}">Open</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                `);
                                }
                            });
                        }

                        if ($('#invoiceModal input[name="linked_transaction[]"]').length < 1) {
                            $('#invoiceModal .close-transactions-container').parent().remove();
                            $('#invoiceModal .open-transactions-container').parent().remove();

                            $('#invoiceModal .modal-body .row .col').children('.row:first-child').prepend(`
                                <div class="col-12">
                                    <button class="nsm-button close-transactions-container float-end" type="button"><i class="bx bx-fw bx-chevron-right"></i></button>
                                </div>
                            `);
                        }
                    } else {
                        $('#invoiceModal .transactions-container').parent().remove();
                        $('#invoiceModal .close-transactions-container').parent().remove();
                        $('#invoiceModal .open-transactions-container').parent().remove();
                    }
                });
            }
        } else {
            $('#invoiceModal .transactions-container').parent().remove();
            $('#invoiceModal .close-transactions-container').parent().remove();
            $('#invoiceModal .open-transactions-container').parent().remove();
        }
    });

    $(document).on('change', '#invoiceModal #transaction-type, #invoiceModal #transaction-date', function () {
        var transactionType = $('#invoiceModal #transaction-type').val();
        var transactionDate = $('#invoiceModal #transaction-date').val();

        if ($(this).attr('id') === 'transaction-date' && $(this).val() === 'custom') {
            var alertHtml = `<div class="row">
                <div class="col-6">
                    <div class="form-group" style="margin: 0 !important">
                        <label for="start-date" class="text-left">Start date</label>
                        <input type="text" id="start-date" class="form-control date" placeholder="MM/dd/yyyy">
                    </div>
                </div>
                <div class="cold-6">
                    <div class="form-group" style="margin: 0 !important">
                        <label for="end-date" class="text-left">End date</label>
                        <input type="text" id="end-date" class="form-control date" placeholder="MM/dd/yyyy">
                    </div>
                </div>
            </div>`;

            Swal.fire({
                title: 'Custom date range',
                html: alertHtml,
                showCloseButton: true,
                confirmButtonColor: '#2ca01c',
                confirmButtonText: 'Done',
                showCancelButton: false,
                onOpen: function () {
                    $('#swal2-content .date').each(function () {
                        $(this).datepicker({
                            uiLibrary: 'bootstrap'
                        });
                    });
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    startDate = new Date($('#swal2-content #start-date').val());
                    endDate = new Date($('#swal2-content #end-date').val());

                    getInvoiceLinkableTransactions(transactionType, transactionDate);
                }
            });
        }

        $('#invoiceModal .transactions-container .row').children('div.col-12:not(:first-child, :nth-child(2))').remove();

        getInvoiceLinkableTransactions(transactionType, transactionDate);
    });

    $(document).on('keyup', '#receivePaymentModal #invoice-no', function (e) {
        $('#receivePaymentModal #invoice-no').removeClass('border-danger');
    });

    $(document).on('keyup', '#receivePaymentModal #search-invoice-no', function () {
        loadCustomerInvoices();
    });

    $(document).on('keyup', '#receivePaymentModal #search-credit-memo-no', function () {
        loadCustomerCredits();
    });

    // $(document).on('change', '#receivePaymentModal #invoices-table thead .select-all', function () {
    //     $('#receivePaymentModal #invoices-table tbody tr:visible input[type="checkbox"]').prop('checked', $(this).prop('checked')).trigger('change');
    // });

    // $(document).on('change', '#receivePaymentModal #invoices-table tbody input[type="checkbox"]', function () {
    //     console.log('#receivePaymentModal #invoices-table tbody input[type="checkbox"] : 8288');
    //     var row = $(this).closest('tr');
    //     if ($(this).prop('checked')) {
    //         $(row).find('input[name="payment[]"]').val(row.children('td:nth-child(5)').html().trim()).trigger('change');
    //     } else {
    //         $(row).find('input[name="payment[]"]').val('').trigger('change');
    //     }

    //     var checked = $('#receivePaymentModal #invoices-table tbody tr:visible input[type="checkbox"]:checked').length;
    //     var all = $('#receivePaymentModal #invoices-table tbody tr:visible input[type="checkbox"]').length;

    //     $('#receivePaymentModal #invoices-table thead .select-all').prop('checked', checked === all);

    //     if ($('#receivePaymentModal #credits-table tbody tr td div.nsm-empty').length < 1) {
    //         $('#receivePaymentModal #credits-table tbody tr').each(function () {
    //             var rowData = $(this).data();
    //             if (checked > 0) {
    //                 if ($(this).find('input[type="checkbox"]').length < 1) {
    //                     $(this).find('td:first-child').html(`
    //                     <div class="table-row-icon table-checkbox">
    //                         <input class="form-check-input select-one table-select" type="checkbox" value="${rowData.type}_${rowData.id}">
    //                     </div>`);
    //                 }
    //             } else {
    //                 $(this).find('td:first-child').html('');
    //             }
    //         });
    //     }
    // });

    $(document).on('change', '#receivePaymentModal #credits-table thead .select-all', function () {
        $('#receivePaymentModal #credits-table tbody tr:visible input[type="checkbox"]').prop('checked', $(this).prop('checked')).trigger('change');
    });

    $(document).on('change', '#receivePaymentModal #credits-table tbody input[type="checkbox"]', function () {
        var row = $(this).closest('tr');
        if ($(this).prop('checked')) {
            $(row).find('input[name="credit_payment[]"]').val(row.children('td:nth-child(4)').html().trim()).trigger('change');
        } else {
            $(row).find('input[name="credit_payment[]"]').val('').trigger('change');
        }

        var checked = $('#receivePaymentModal #credits-table tbody tr:visible input[type="checkbox"]:checked').length;
        var all = $('#receivePaymentModal #credits-table tbody tr:visible input[type="checkbox"]').length;

        $('#receivePaymentModal #credits-table thead .select-all').prop('checked', checked === all);
    });

    $(document).on('change', '#receivePaymentModal #received-amount', function () {
        receivedAmountIsChanged = true;

        var receivedAmount = parseFloat($(this).val());
        var invoiceTotal = 0.00;
        $('#receivePaymentModal #invoices-table tbody input[name="payment[]"]').each(function () {
            var checked = $(this).parent().parent().find('input[type="checkbox"]').prop('checked');
            if (checked) {
                invoiceTotal = parseFloat(invoiceTotal) + parseFloat($(this).val());
            }
        });

        var creditAmount = 0.00;
        $('#receivePaymentModal #credits-table tbody input[name="credit_payment[]"]').each(function () {
            var checked = $(this).parent().parent().find('input[type="checkbox"]').prop('checked');
            if (checked) {
                creditAmount = parseFloat(creditAmount) + parseFloat($(this).val());
            }
        });

        var total = parseFloat(invoiceTotal) - parseFloat(creditAmount);

        var amountToCredit = receivedAmount - parseFloat(total);
        $('#receivePaymentModal span.amount-to-credit').html(formatter.format(parseFloat(amountToCredit)));

        var amountToApply = parseFloat(receivedAmount) + parseFloat(creditAmount);
        $('#receivePaymentModal span.amount-to-apply').html(formatter.format(parseFloat(amountToApply)));

        $('#receivePaymentModal .transaction-total-amount').html(formatter.format(parseFloat(receivedAmount)));

        if (parseFloat(amountToCredit) > 0) {
            $('#receivePaymentModal #credit-message').html(`This transaction will create an additional credit in the amount of ${formatter.format(parseFloat(amountToCredit))}`);
            $('#receivePaymentModal #credit-message').parent().parent().removeClass('d-none');
        } else {
            $('#receivePaymentModal #credit-message').html('');
            $('#receivePaymentModal #credit-message').parent().parent().addClass('d-none');
        }
    });

    $(document).on('change', '#receivePaymentModal #credits-table tbody input[name="credit_payment[]"]', function () {
        var row = $(this).closest('tr');
        var rowData = row.data();

        if ($(this).val() !== '' && $(this).val() !== '0.00') {
            row.find('input[type="checkbox"]').prop('checked', true);

            var checked = $('#receivePaymentModal #credits-table tbody input[type="checkbox"]:checked').length;
            var all = $('#receivePaymentModal #credits-table tbody input[type="checkbox"]').length;
            $('#receivePaymentModal #credits-table thead .select-all').prop('checked', checked === all);
        } else {
            row.find('input[type="checkbox"]').prop('checked', false);
            $('#receivePaymentModal #credits-table thead .select-all').prop('checked', false);
        }

        if ($('#modal-form').attr('data-href') !== false && typeof $('#modal-form').attr('data-href') !== 'undefined') {
            var totalBal = parseFloat(row.children('td:nth-child(4)').html().trim()) + parseFloat(rowData.payment_amount);
            if (parseFloat($(this).val()) > parseFloat(totalBal)) {
                $(this).val(parseFloat(totalBal).toFixed(2));
            }
        } else {
            if (parseFloat($(this).val()) > parseFloat(row.children('td:nth-child(4)').html().trim())) {
                $(this).val(row.children('td:nth-child(4)').html().trim());
            }
        }

        var invoicePayment = 0.00;
        $('#receivePaymentModal #invoices-table tbody input[name="payment[]"]').each(function () {
            var checked = $(this).closest('tr').find('input[type="checkbox"]').prop('checked');
            if (checked) {
                invoicePayment = parseFloat(invoicePayment) + parseFloat($(this).val());
            }
        });

        var creditAmount = 0.00;
        $('#receivePaymentModal #credits-table tbody input[name="credit_payment[]"]').each(function () {
            var checked = $(this).closest('tr').find('input[type="checkbox"]').prop('checked');
            if (checked) {
                creditAmount = parseFloat(creditAmount) + parseFloat($(this).val());
            }
        });

        if (parseFloat(creditAmount) > parseFloat(invoicePayment)) {
            var val = $(this).val();
            var diff = parseFloat(creditAmount) - parseFloat(invoicePayment);
            val = parseFloat(val) - parseFloat(diff);
            val = parseFloat(val).toFixed(2);
            $(this).val(val);

            creditAmount = 0.00;
            $('#receivePaymentModal #credits-table tbody input[name="credit_payment[]"]').each(function () {
                var checked = $(this).parent().parent().find('input[type="checkbox"]').prop('checked');
                if (checked) {
                    creditAmount = parseFloat(creditAmount) + parseFloat($(this).val());
                }
            });
        }

        var total = parseFloat(invoicePayment) - parseFloat(creditAmount);

        if (receivedAmountIsChanged === false) {
            $('#receivePaymentModal #received-amount').val(parseFloat(total).toFixed(2));
            $('#receivePaymentModal span.transaction-total-amount').html(formatter.format(parseFloat(total)));
            $('#receivePaymentModal span.amount-to-apply').html(formatter.format(parseFloat(invoicePayment)));
        } else {
            var receivedAmount = parseFloat($('#receivePaymentModal #received-amount').val());
            var amountToApply = parseFloat(receivedAmount) + parseFloat(creditAmount);
            $('#receivePaymentModal span.amount-to-apply').html(formatter.format(parseFloat(amountToApply)));
            var amountToCredit = parseFloat(receivedAmount) - parseFloat(total);
            $('#receivePaymentModal span.amount-to-credit').html(formatter.format(parseFloat(amountToCredit)));

            if (parseFloat(amountToCredit.replace('$', '').replaceAll(',', '')) > 0) {
                $('#receivePaymentModal #credit-message').html(`This transaction will create an additional credit in the amount of ${formatter.format(parseFloat(amountToCredit))}`);
                $('#receivePaymentModal #credit-message').parent().parent().removeClass('d-none');
            } else {
                $('#receivePaymentModal #credit-message').html('');
                $('#receivePaymentModal #credit-message').parent().parent().addClass('d-none');
            }
        }
    });

    $(document).on('change', '#receivePaymentModal #invoices-table tbody input[name="payment[]"]', function () {
        var row = $(this).closest('tr');
        var rowData = $(this).data();

        if ($(this).val() !== '' && $(this).val() !== "0.00") {
            row.find('input[type="checkbox"]').prop('checked', true);

            var checked = $('#receivePaymentModal #invoices-table tbody tr:visible input[type="checkbox"]:checked').length;
            var all = $('#receivePaymentModal #invoices-table tbody tr:visible input[type="checkbox"]').length;

            $('#receivePaymentModal #invoices-table thead .select-all').prop('checked', checked === all);

            if ($('#modal-form').attr('data-href') !== false && typeof $('#modal-form').attr('data-href') !== 'undefined') {
                var totalBal = parseFloat(row.children('td:nth-child(5)').html().trim()) + parseFloat(rowData.payment_amount);
                if (parseFloat($(this).val()) > parseFloat(totalBal)) {
                    $(this).val(parseFloat(totalBal).toFixed(2));
                }
            } else {
                if (parseFloat($(this).val()) > parseFloat(row.children('td:nth-child(5)').html().trim())) {
                    $(this).val(row.children('td:nth-child(5)').html().trim());
                }
            }
        } else {
            row.find('input[type="checkbox"]').prop('checked', false);
            $('#receivePaymentModal #invoices-table thead .select-all').prop('checked', false);
        }

        var checked = $('#receivePaymentModal #invoices-table tbody tr:visible input[type="checkbox"]:checked').length;

        if ($('#receivePaymentModal #credits-table tbody tr td div.nsm-empty').length < 1) {
            $('#receivePaymentModal #credits-table tbody tr').each(function () {
                var rowData = $(this).data();
                if (checked > 0) {
                    if ($(this).find('input[type="checkbox"]').length < 1) {
                        $(this).find('td:first-child').html(`
                        <div class="table-row-icon table-checkbox">
                            <input class="form-check-input select-one table-select" type="checkbox" value="${rowData.type}_${rowData.id}">
                        </div>`);
                    }
                } else {
                    $(this).find('td:first-child').html('');
                }
            });
        }

        var invoicePayment = 0.00;
        $('#receivePaymentModal #invoices-table tbody input[name="payment[]"]').each(function () {
            var checked = $(this).parent().parent().find('input[type="checkbox"]').prop('checked');
            if (checked) {
                invoicePayment = parseFloat(invoicePayment) + parseFloat($(this).val());
            }
        });

        var creditAmount = 0.00;
        $('#receivePaymentModal #credits-table tbody input[name="credit_payment[]"]').each(function () {
            var checked = $(this).parent().parent().find('input[type="checkbox"]').prop('checked');
            if (checked) {
                creditAmount = parseFloat(creditAmount) + parseFloat($(this).val());
            }
        });

        if (parseFloat(creditAmount) > parseFloat(invoicePayment)) {
            var el = null;
            var val = null;
            $('#receivePaymentModal #credits-table tbody input[name="credit_payment[]"]').each(function () {
                var checked = $(this).parent().parent().find('input[type="checkbox"]').prop('checked');
                if (checked) {
                    el = $(this);
                    val = $(this).val();
                }
            });
            var diff = parseFloat(creditAmount) - parseFloat(invoicePayment);
            val = parseFloat(val) - parseFloat(diff);
            val = parseFloat(val).toFixed(2);
            el.val(val);

            creditAmount = 0.00;
            $('#receivePaymentModal #credits-table tbody input[name="credit_payment[]"]').each(function () {
                var checked = $(this).parent().parent().find('input[type="checkbox"]').prop('checked');
                if (checked) {
                    creditAmount = parseFloat(creditAmount) - parseFloat($(this).val());
                }
            });
        }

        var total = parseFloat(invoicePayment) - parseFloat(creditAmount);

        if (receivedAmountIsChanged === false) {
            $('#receivePaymentModal #received-amount').val(parseFloat(total).toFixed(2));
            $('#receivePaymentModal span.transaction-total-amount').html(formatter.format(parseFloat(total)));
            $('#receivePaymentModal span.amount-to-apply').html(formatter.format(parseFloat(invoicePayment)));
        } else {
            var receivedAmount = parseFloat($('#receivePaymentModal #received-amount').val());
            var amountToApply = parseFloat(receivedAmount) + parseFloat(creditAmount);
            $('#receivePaymentModal span.amount-to-apply').html(formatter.format(parseFloat(amountToApply)));
            var amountToCredit = parseFloat(receivedAmount) - parseFloat(total);
            $('#receivePaymentModal span.amount-to-credit').html(formatter.format(parseFloat(amountToCredit)));

            if (parseFloat(amountToCredit.replace('$', '').replaceAll(',', '')) > 0) {
                $('#receivePaymentModal #credit-message').html(`This transaction will create an additional credit in the amount of ${formatter.format(parseFloat(amountToCredit))}`);
                $('#receivePaymentModal #credit-message').parent().parent().removeClass('d-none');
            } else {
                $('#receivePaymentModal #credit-message').html('');
                $('#receivePaymentModal #credit-message').parent().parent().addClass('d-none');
            }
        }
    });

    $(document).on('click', '#receivePaymentModal #clear-payment', function (e) {
        e.preventDefault();

        $('#receivePaymentModal #received-amount').val('0.00');
        $('#receivePaymentModal span.transaction-total-amount').html('$0.00');
        $('#receivePaymentModal span.amount-to-apply').html('$0.00');
        $('#receivePaymentModal span.amount-to-credit').html('$0.00');

        $('#receivePaymentModal #invoices-table input[type="checkbox"]').prop('checked', false);
        $('#receivePaymentModal #invoices-table tbody input[name="payment[]"]').val('');
        $('#receivePaymentModal #credits-table input[type="checkbox"]').prop('checked', false);
        $('#receivePaymentModal #credits-table tbody input[name="credit_payment[]"]').val('');

        $('#receivePaymentModal #credits-table tbody input[type="checkbox"]').parent().html('');
    });

    $(document).on('change', '#modal-container form #receivePaymentModal #customer', function (e) {
        var id = $(this).val();

        $('#receivePaymentModal #search-invoice-no').val('');
        $('#receivePaymentModal #invoices-from').val('').attr('data-applied', '');
        $('#receivePaymentModal #invoices-to').val('').attr('data-applied', '');
        $('#receivePaymentModal #overdue-invoices-only').prop('checked', false).attr('data-applied', '');

        $('#receivePaymentModal #search-credit-memo-no').val('');
        $('#receivePaymentModal #credit-memo-from').val('').attr('data-applied', '');
        $('#receivePaymentModal #credit-memo-to').val('').attr('data-applied', '');

        var data = new FormData();
        data.set('search', '');
        data.set('from_date', '');
        data.set('to_date', '');
        data.set('overdue', 0);

        $.ajax({
            url: base_url + `accounting/get-customer-invoices/${id}`,
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function (result) {
                var invoices = JSON.parse(result);

                $('#receivePaymentModal #invoices-table tbody').html('');
                if (invoices.length > 0) {
                    $.each(invoices, function (key, invoice) {
                        $('#receivePaymentModal #invoices-table tbody').append(`
                        <tr>
                            <td>
                                <div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" type="checkbox" value="${invoice.id}">
                                </div>
                            </td>
                            <td>${invoice.description}</td>
                            <td>${invoice.due_date}</td>
                            <td>${invoice.original_amount}</td>
                            <td>${invoice.open_balance}</td>
                            <td><input type="number" onchange="convertToDecimal(this)" step=".01" class="form-control nsm-field text-end" name="payment[]"></td>
                        </tr>
                        `);
                    });

                    $('#receivePaymentModal #invoices-table').nsmPagination({
                        itemsPerPage: 50
                    });
                } else {
                    $('#receivePaymentModal #invoices-table tbody').html(`<tr>
                        <td colspan="6">
                            <div class="nsm-empty">
                                <span>There are no transactions matching the criteria.</span>
                            </div>
                        </td>
                    </tr>`);
                }

                $('#receivePaymentModal #invoices-container').show();
            }
        });

        $.ajax({
            url: base_url + `accounting/get-customer-credits/${id}`,
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function (result) {
                var credits = JSON.parse(result);

                $('#receivePaymentModal #credits-table tbody').html('');
                if (credits.length > 0) {
                    $.each(credits, function (key, credit) {
                        if ($('#receivePaymentModal #invoices-table tbody tr input[type="checkbox"]:checked').length > 0) {
                            var checkboxCol = `<div class="table-row-icon table-checkbox">
                                <input class="form-check-input select-one table-select" type="checkbox" value="${credit.type}_${credit.id}">
                            </div>`;
                        } else {
                            var checkboxCol = '';
                        }
                        $('#receivePaymentModal #credits-table tbody').append(`
                        <tr data-id="${credit.id}" data-type="${credit.type}">
                            <td>${checkboxCol}</td>
                            <td>${credit.description}</td>
                            <td>${credit.original_amount}</td>
                            <td>${credit.open_balance}</td>
                            <td><input type="number" onchange="convertToDecimal(this)" step=".01" class="form-control nsm-field text-end" name="credit_payment[]"></td>
                        </tr>
                        `);
                    });

                    $('#receivePaymentModal #credits-table').nsmPagination({
                        itemsPerPage: 50
                    });

                    $('#receivePaymentModal #credits-container').show();
                } else {
                    $('#receivePaymentModal #credits-container').hide();
                }
            }
        });

        $('#receivePaymentModal #payment-summary').show();
    });

    $(document).on('click', '#receivePaymentModal #cancel-find-by-invoice', function () {
        $('#receivePaymentModal #invoice-no').val('');

        $('#findByInvoice').dropdown('toggle');
    });

    $(document).on('click', '#receivePaymentModal #credits-table tbody tr a', function (e) {
        e.preventDefault();

        var url = $(this).attr('href');
        var row = $(this).parent().parent();
        var data = row.data();
        $('#receivePaymentModal').modal('hide');

        $.get(url, function (res) {
            if ($('div#modal-container').length > 0) {
                $('div#modal-container').html(res);
            } else {
                $('body').append(`
                    <div id="modal-container"> 
                        ${res}
                    </div>
                `);
            }

            if (data.type === 'credit-memo') {
                initModalFields('creditMemoModal', data);

                $('#creditMemoModal').modal('show');
            } else {
                initModalFields('receivePaymentModal', data);

                $('#receivePaymentModal').modal('show');
            }
        });
    });

    $(document).on('change', '#creditMemoModal #customer', function () {
        $.get(base_url + `accounting/get-customer-details/${$(this).val()}`, function (result) {
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
                if (customerName.trim() !== '') {
                    $('#creditMemoModal #billing-address').append('\n');
                }
            }
            var address = '';
            address += customer.mail_add !== "" && customer.mail_add !== null ? customer.mail_add + '\n' : "";
            address += customer.city !== "" && customer.city !== null ? customer.city + ', ' : "";
            address += customer.state !== "" && customer.state !== null ? customer.state + ' ' : "";
            address += customer.zip_code !== "" && customer.zip_code !== null ? customer.zip_code + ' ' : "";
            address += customer.country !== "" && customer.country !== null ? customer.country : "";

            $('#creditMemoModal #billing-address').append(address.trim());
            $('#creditMemoModal #email').val(customer.email);
        });
    });

    $(document).on('click', '#modal-container form .modal #add_item', function (e) {
        e.preventDefault();
        console.log('add Items');
        if ($('#modal-container #item_list.modal').length === 0) {
            $.get(base_url + 'accounting/get-items-list-modal', function (res) {
                $('#modal-container').append(res);

                $('#modal-container #item_list table').nsmPagination({
                    itemsPerPage: 10
                });

                $('#modal-container #item_list').modal('show');
            });
        } else {
            $('#modal-container #item_list').modal('show');
        }
    });

    $(document).on('click', '#modal-container #item_list table button', function (e) {
        e.preventDefault();
        var id = e.currentTarget.dataset.id;

        $.get(base_url + 'accounting/get-item-details/' + id, function (res) {
            var result = JSON.parse(res);
            var item = result.item;
            var type = item.type;
            var locations = result.locations;
            var locs = '';

            if (item.type.toLowerCase() === 'product' || item.type.toLowerCase() === 'inventory') {
                locs += '<select name="location[]" class="form-control nsm-field" required>';
                for (var i in locations) {
                    locs += `<option value="${locations[i].id}">${locations[i].name}</option>`;
                }
                locs += '</select>';
            }

            var fields = `
                <td>${item.title}<input type="hidden" name="item[]" value="${item.id}"></td>
                <td>${type.charAt(0).toUpperCase() + type.slice(1)}</td>
                <td>${locs}</td>
                <td><input type="number" name="quantity[]" class="form-control nsm-field text-end" required value="0" min="0" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"></td>
                <td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" min="0" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value="${item.price}"></td>
                <td><input type="number" name="discount[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" min="0" value="0.00"></td>
                <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="7.50"></td>
                <td><span class="row-total">$0.00</span></td>
                <td>
                    <button type="button" class="nsm-button delete-row">
                        <i class='bx bx-fw bx-trash'></i>
                    </button>
                </td>
            `;

            if (targetItemTable !== null) {
                targetItemTable.children('tbody:not(#package-items-table)').append(`<tr>${fields}</tr>`);
                targetItemTable.children('tbody:not(#package-items-table)').children('tr:last-child').children('td:nth-child(3)').remove();
                targetItemTable.children('tbody:not(#package-items-table)').children('tr:last-child').find('input[name="discount[]"]').attr('disabled', false);

                targetItemTable.children('tbody:not(#package-items-table)').children('tr:last-child').find('select').each(function () {
                    $(this).select2({
                        minimumResultsForSearch: -1,
                        dropdownParent: $('#modal-container form .modal')
                    });
                });
            } else {
                $('#modal-container form .modal #item-table tbody:not(#package-items-table)').append(`<tr>${fields}</tr>`);

                if ($('#modal-container #modal-form .modal').attr('id').includes('-estimate-modal')) {
                    $('#modal-container form .modal #item-table tbody:not(#package-items-table) tr:last-child td:nth-child(3)').remove();
                }

                $('#modal-container form .modal #item-table tbody:not(#package-items-table) tr:last-child select').each(function () {
                    $(this).select2({
                        minimumResultsForSearch: -1,
                        dropdownParent: $('#modal-container form .modal')
                    });
                });

                if ($('#modal-container form #linked-transaction').length > 0) {
                    $('<td></td>').insertBefore('#modal-container form .modal #item-table tbody:not(#package-items-table) tr:last-child td:last-child');
                }
            }

            targetItemTable = null;
        });
    });

    $(document).on('click', '#modal-container form #add_group', function (e) {
        e.preventDefault();

        if ($('#modal-container #item_category_list.modal').length === 0) {
            $.get(base_url + 'accounting/get-items-categories-list-modal', function (res) {
                $('#modal-container').append(res);

                $('#modal-container #item_category_list table').nsmPagination({
                    itemsPerPage: 10
                });

                $('#modal-container #item_category_list').modal('show');
            });
        } else {
            $('#modal-container #item_category_list').modal('show');
        }
    });

    $(document).on('click', '#modal-container form #add_create_package', function (e) {
        e.preventDefault();

        if ($('#modal-container #package_list.modal').length === 0) {
            $.get(base_url + 'accounting/get-package-list-modal', function (res) {
                $('#modal-container').append(res);

                $('#modal-container #package_list').modal('show');
            });
        } else {
            $('#modal-container #package_list').modal('show');
        }
    });

    $(document).on('click', '#modal-container #item_category_list table button', function (e) {
        e.preventDefault();
        var id = e.currentTarget.dataset.id;

        $.get(base_url + 'accounting/get-category-items/' + id, function (res) {
            var items = JSON.parse(res);

            for (var i in items) {
                var type = items[i].type;
                var locations = items[i].locations;
                var locs = '';

                if (type.toLowerCase() === 'product' || type.toLowerCase() === 'inventory') {
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
                    <td><input type="number" name="quantity[]" class="form-control nsm-field text-end" required value="0" min="0" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"></td>
                    <td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" min="0" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value="${items[i].price}"></td>
                    <td><input type="number" name="discount[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" min="0" value="0.00"></td>
                    <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="7.50"></td>
                    <td><span class="row-total">$0.00</span></td>
                    <td>
                        <button type="button" class="nsm-button delete-row">
                            <i class='bx bx-fw bx-trash'></i>
                        </button>
                    </td>
                `;

                $('#modal-container form .modal #item-table tbody:not(#package-items-table)').append(`<tr>${fields}</tr>`);

                $('#modal-container form .modal #item-table tbody:not(#package-items-table) tr:last-child select').each(function () {
                    $(this).select2({
                        minimumResultsForSearch: -1,
                        dropdownParent: $('#modal-container form .modal')
                    });
                });

                if ($('#modal-container form #linked-transaction').length > 0) {
                    $('<td></td>').insertBefore('#modal-container form .modal #item-table tbody:not(#package-items-table) tr:last-child td:last-child');
                }
            }
        });
    });

    $(document).on('click', '#modal-container #package_list table#package-table button.addNewPackageToList', function (e) {
        e.preventDefault();
        var id = e.currentTarget.dataset.id;

        $.get(base_url + 'accounting/get-package-details/' + id, function (res) {
            var result = JSON.parse(res);
            var details = result.package;
            var items = result.items;
            var fields = `
                <td style='background-color: #f7f7f7;'><strong>${details.name}</strong><input type="hidden" name="package[]" value="${details.id}"></td>
                <td style='background-color: #f7f7f7;'>Package</td>
                <td style='background-color: #f7f7f7;'></td>
                <td style='background-color: #f7f7f7;'><input type="number" name="quantity[]" class="form-control nsm-field text-end" required value="0" min="0" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"></td>
                <td style='background-color: #f7f7f7;'><span class="item-amount">${parseFloat(details.amount_set).toFixed(2)}</span></td>
                <td style='background-color: #f7f7f7;'></td>
                <td style='background-color: #f7f7f7;'><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="7.50"></td>
                <td style='background-color: #f7f7f7;'><span class="row-total">$0.00</span></td>
                <td style='background-color: #f7f7f7;'>
                    <button type="button" class="nsm-button delete-row">
                        <i class='bx bx-fw bx-trash'></i>
                    </button>
                </td>
            `;

            $('#modal-container form .modal #item-table tbody:not(#package-items-table)').append(`<tr class="package">${fields}</tr>`);

            if ($('#modal-container #modal-form .modal').attr('id').includes('-estimate-modal')) {
                $('#modal-container form .modal #item-table tbody:not(#package-items-table) tr:last-child td:nth-child(3)').remove();
            }

            if ($('#modal-container form #linked-transaction').length > 0) {
                $('<td></td>').insertBefore('#modal-container form .modal #item-table tbody:not(#package-items-table) tr:last-child td:last-child');
            }

            var packageItems = `
                <td colspan="4">
                    <table class="nsm-table" style="margin-left: 35px;">
                        <thead>
                            <tr class="package-item-header">
                                <th>-> Item Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody id="package-items-table">`;

            for (var i in items) {
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
            `;

            $('#modal-container form .modal #item-table tbody:not(#package-items-table)').append(`<tr class="package-items">${packageItems}</tr>`);

            if ($('#modal-container #modal-form .modal').attr('id').includes('-estimate-modal')) {
                $('#modal-container form .modal #item-table tbody:not(#package-items-table) tr:not(.package-item):last-child').children('td:nth-child(2)').remove();
            }

            if ($('#modal-container form #linked-transaction').length > 0) {
                $('<td></td>').insertBefore('#modal-container form .modal #item-table tbody:not(#package-items-table) tr:last-child td:last-child');
            }
        });
    });

    $(document).on('click', '#modal-container #package_list #add_package_item', function (e) {
        e.preventDefault();

        if ($('#modal-container #package_item_list.modal').length === 0) {
            $.get(base_url + 'accounting/get-items-list-modal', function (res) {
                $('#modal-container').append(res);

                $('#modal-container #item_list').attr('id', 'package_item_list');

                $('#modal-container #package_item_list table').nsmPagination({
                    itemsPerPage: 10
                });

                $('#modal-container #package_item_list').modal('show');
            });
        } else {
            $('#modal-container #package_item_list').modal('show');
        }
    });

    $(document).on('click', '#modal-container #package_item_list table button', function (e) {
        e.preventDefault();
        var id = e.currentTarget.dataset.id;

        $.get(base_url + 'accounting/get-item-details/' + id, function (res) {
            var result = JSON.parse(res);
            var item = result.item;

            var fields = `
                <td>${item.title}<input type="hidden" name="item[]" value="${item.id}"></td>
                <td><input type="number" name="quantity[]" class="form-control nsm-field text-end" required value="0" min="0"></td>
                <td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="${item.price}"></td>
                <td><button type="button" class="remove nsm-button"><i class="bx bx-fw bx-trash" aria-hidden="true"></i></a></td>
            `;

            $('#modal-container #package_list #package-items-table tbody').append(`<tr>${fields}</tr>`);
        });
    });

    $(document).on('click', '#modal-container #package_list #package-items-table tbody button.remove', function () {
        $(this).parent().parent().remove();

        var total = 0.00;

        $('#modal-container #package_list #package-items-table tbody tr').each(function () {
            var quantity = $(this).find('[name="quantity[]"]').val();
            var amount = $(this).find('[name="item_amount[]"]').val();
            var rowTotal = parseFloat(amount) * parseFloat(quantity);

            total = parseFloat(total) + parseFloat(rowTotal);
        });

        $('#modal-container #package_list #package_price').val(parseFloat(total).toFixed(2));
    });

    $(document).on('click', '#modal-container #package_list #create-package', function (e) {
        e.preventDefault();

        var data = new FormData();

        data.set('name', $('#modal-container #package_list #package_name').val());
        data.set('total_price', $('#modal-container #package_list #package_price').val());
        data.set('amount_set', $('#modal-container #package_list #package_price_set').val());

        $('#modal-container #package_list #package-items-table tbody tr').each(function () {
            if (data.has('item[]')) {
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
            url: base_url + 'accounting/add-package',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function (result) {
                var res = JSON.parse(result);

                if (res.success) {
                    var appendPackage = `<tr>
                        <td>${res.id}</td>
                        <td>${data.get('name')}</td>
                        <td></td>
                        <td></td>
                        <td>${data.get('amount_set')}</td>
                        <td>
                            <button id="${res.id}" data-id="${res.id}" type="button" data-bs-dismiss="modal" class="nsm-button addNewPackageToList">
                                <span class="bx bx-fw bx-plus"></span>
                            </button>
                        </td>
                        <td>
                            <button type="button" class="nsm-button" data-bs-toggle="collapse" data-bs-target="#demo${res.id}" data-parent="#package-table" id="packageID" data-id="${res.id}">
                                <i class="bx bx-fw bx-caret-down"></i>
                            </button>
                        </td>
                    </tr>`;
                    $('#modal-container #package_list #package-table tbody.panel').append(appendPackage);

                    var appendPackageItems = `<tr id="demo${res.id}" class="collapse">
                        <td colspan="7" class="hiddenRow">
                            <div id="packageItems${res.id}">
                                <table class="nsm-table">
                                    <tbody>`;

                    $('#modal-container #package_list #package-items-table tbody tr').each(function () {
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

                    $('#modal-container #package_list #package-table tbody.panel').append(appendPackageItems);

                    $('#modal-container #package_list #package_name').val('')
                    $('#modal-container #package_list #package_price').val('');
                    $('#modal-container #package_list #package_price_set').val('');

                    $('#modal-container #package_list #package-items-table tbody tr').each(function () {
                        $(this).remove();
                    });
                }
            }
        });
    });

    $(document).on('change', '#modal-container #package_list #package-items-table input[name="quantity[]"], #modal-container #package_list #package-items-table input[name="item_amount[]"]', function () {
        var total = 0.00;

        $('#modal-container #package_list #package-items-table tbody tr').each(function () {
            var quantity = $(this).find('[name="quantity[]"]').val();
            var amount = $(this).find('[name="item_amount[]"]').val();
            var rowTotal = parseFloat(amount) * parseFloat(quantity);

            total = parseFloat(total) + parseFloat(rowTotal);
        });

        $('#modal-container #package_list #package_price').val(parseFloat(total).toFixed(2));
    });

    $(document).on('change', '#modal-container form .modal #item-table tbody tr input', function () {
        var quantityEl = $(this).closest('tr').find('input[name="quantity[]"]');
        var quantity = quantityEl.length > 0 ? quantityEl.val() : 0.00;
        var amountEl = $(this).closest('tr').find('input[name="item_amount[]"]');
        var amount = amountEl.length > 0 ? amountEl.val() : $(this).closest('tr').find('span.item-amount').html();
        var discountEl = $(this).closest('tr').find('input[name="discount[]"]');
        var discount = discountEl.length > 0 ? discountEl.val() : 0.00;
        var taxEl = $(this).closest('tr').find('input[name="item_tax[]"]');
        var tax = taxEl.length > 0 && taxEl.val() !== '' ? taxEl.val() : 0.00;

        var amount = parseFloat(amount === '' ? 0.00 : amount) * parseFloat(quantity === '' ? 0.00 : quantity);
        var taxAmount = parseFloat(tax === '' ? 0.00 : tax) * amount / 100;
        var total = parseFloat(amount) + parseFloat(taxAmount) - parseFloat(discount === '' ? 0.00 : discount);

        $(this).closest('tr').find('.row-total').html(formatter.format(parseFloat(total)));

        var subtotal = 0.00;
        var taxes = 0.00;
        var discounts = 0.00;
        $('#modal-container form .modal #item-table tbody tr:not(.package-items, .package-item, .package-item-header, .linked-transaction-row, .linked-transaction-header)').each(function () {
            var itemAmount = $(this).find('input[name="item_amount[]"]').length > 0 ? $(this).find('input[name="item_amount[]"]').val() : $(this).find('span.item-amount').html();
            var itemQty = $(this).find('input[name="quantity[]"]').length > 0 ? $(this).find('input[name="quantity[]"]').val() : 0;
            var itemDisc = $(this).find('input[name="discount[]"]').length > 0 ? $(this).find('input[name="discount[]"]').val() : 0.00;
            var itemTax = $(this).find('input[name="item_tax[]"]').length > 0 ? $(this).find('input[name="item_tax[]"]').val() : 0.00;

            var itemTotal = parseFloat(itemAmount === '' ? 0.00 : itemAmount) * parseFloat(itemQty === '' ? 0.00 : itemQty);
            var taxAmount = parseFloat(itemTax === '' ? 0.00 : itemTax) * itemTotal / 100;

            subtotal = parseFloat(subtotal) + parseFloat(itemTotal);
            taxes = parseFloat(taxes) + parseFloat(taxAmount);
            discounts = parseFloat(discounts) + parseFloat(itemDisc === '' ? 0.00 : itemDisc);
        });

        $('#modal-container form .modal span.transaction-subtotal').html(formatter.format(parseFloat(subtotal)));
        $('#modal-container form .modal span.transaction-taxes').html(formatter.format(parseFloat(taxes)));
        $('#modal-container form .modal span.transaction-discounts').html(formatter.format(parseFloat(discounts)));
        $('#modal-container form .modal #adjustment_input_cm').trigger('change');
    });

    $(document).on('change', '#modal-container form .modal #adjustment_input_cm', function () {
        var value = $(this).val() === '' ? 0.00 : $(this).val();
        var subtotal = $('#modal-container form .modal span.transaction-subtotal').html().replace('$', '').replaceAll(',', '');
        var taxes = $('#modal-container form .modal span.transaction-taxes').html().replace('$', '').replaceAll(',', '');
        var discounts = $('#modal-container form .modal span.transaction-discounts').html().replace('$', '').replaceAll(',', '');

        var grandTotal = parseFloat(subtotal) + parseFloat(taxes);
        grandTotal -= parseFloat(discounts);
        grandTotal -= parseFloat(value);
        if ($('#modal-container form .modal').attr('id') === 'creditMemoModal' && $('#creditMemoModal #total-payment-amount').length > 0) {
            grandTotal -= parseFloat($('#creditMemoModal #total-payment-amount').html().replace('$', '').replaceAll(',', ''));
        }

        $('#modal-container form .modal span.transaction-adjustment').html(formatter.format(parseFloat(value)));
        $('#modal-container form .modal span.transaction-grand-total').html(formatter.format(parseFloat(grandTotal)));
    });

    $(document).on('click', '#modal-container form .modal #item-table .delete-row', function () {
        var el = $(this);
        if (el.closest('tr').find('input[name="item_linked_transaction[]"]').length < 1) {
            if (el.closest('tr').hasClass('package')) {
                el.closest('tr').next().remove();
            }
            el.closest('tr').remove();

            var subtotal = 0.00;
            var taxes = 0.00;
            var discounts = 0.00;
            $('#modal-container form .modal #item-table tbody tr:not(.package-items, .package-item, .package-item-header)').each(function () {
                var itemAmount = $(this).hasClass('package') ? $(this).find('.item-amount').html().trim() : $(this).find('input[name="item_amount[]"]').val();
                var itemQty = $(this).find('input[name="quantity[]"]').val() === '' ? 0.00 : $(this).find('input[name="quantity[]"]').val();
                var itemDisc = $(this).hasClass('package') ? 0.00 : $(this).find('input[name="discount[]"]').val();
                var itemTax = $(this).find('input[name="item_tax[]"]').val() === '' ? 0.00 : $(this).find('input[name="item_tax[]"]').val();

                var itemTotal = parseFloat(itemAmount === '' ? 0.00 : itemAmount) * parseFloat(itemQty);
                var taxAmount = parseFloat(itemTax) * itemTotal / 100;

                subtotal = parseFloat(subtotal) + parseFloat(itemTotal);
                taxes = parseFloat(taxes) + parseFloat(taxAmount);
                discounts = parseFloat(discounts) + parseFloat(itemDisc === '' ? 0.00 : itemDisc);
            });

            $('#modal-container form .modal span.transaction-subtotal').html(formatter.format(parseFloat(subtotal)));
            $('#modal-container form .modal span.transaction-taxes').html(formatter.format(parseFloat(taxes)));
            $('#modal-container form .modal span.transaction-discounts').html(formatter.format(parseFloat(discounts)));
            $('#modal-container form .modal #adjustment_input_cm').trigger('change');
        } else {
            var linkedTransac = el.closest('tr').find('input[name="item_linked_transaction[]"]').val();
            var linkedTransacType = linkedTransac.split('-')[0].replace('delayed_', '');
            var type = linkedTransacType.charAt(0).toUpperCase() + linkedTransacType.slice(1);
            if ($(`#modal-container form .modal #item-table input[name="item_linked_transaction[]"][value="${linkedTransac}"]`).length > 1) {
                var message = `There are multiple lines for ${type}. Would you like to remove this line from the invoice or unlink the whole transaction?`;
                var confirmButtonText = 'Unlink it';
                var cancelButtonText = 'Remove it';
            } else {
                var message = `Would you also like to unlink ${type}`;
                var confirmButtonText = 'Yes, unlink it';
                var cancelButtonText = 'No, keep it';
            }

            Swal.fire({
                title: message,
                icon: 'warning',
                showCloseButton: false,
                confirmButtonColor: '#2ca01c',
                confirmButtonText: confirmButtonText,
                showCancelButton: true,
                cancelButtonText: cancelButtonText,
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    el.closest('tr').find('.unlink-transaction').trigger('click');
                } else {
                    if ($(`#modal-container form .modal #item-table input[name="item_linked_transaction[]"][value="${linkedTransac}"]`).length > 1) {
                        $(`#modal-container form .modal #item-table input[name="item_linked_transaction[]"][value="${linkedTransac}"]`).each(function () {
                            if ($(this).closest('tr').hasClass('package')) {
                                $(this).closest('tr').next().remove();
                            }
                            $(this).closest('tr').remove();
                        });
                    } else {
                        if (el.closest('tr').hasClass('package')) {
                            el.closest('tr').next().remove();
                        }
                        el.closest('tr').remove();
                    }

                    var subtotal = 0.00;
                    var taxes = 0.00;
                    var discounts = 0.00;
                    $('#modal-container form .modal #item-table tbody tr').each(function () {
                        var itemAmount = $(this).closest('tr').find('input[name="item_amount[]"]').val();
                        var itemQty = $(this).closest('tr').find('input[name="quantity[]"]').val();
                        var itemDisc = $(this).closest('tr').find('input[name="discount[]"]').val();
                        var itemTax = $(this).closest('tr').find('input[name="item_tax[]"]').val();

                        var itemTotal = parseFloat(itemAmount === '' ? 0.00 : itemAmount) * parseFloat(itemQty === '' ? 0.00 : itemQty);
                        var taxAmount = parseFloat(itemTax === '' ? 0.00 : itemTax) * itemTotal / 100;

                        subtotal = parseFloat(subtotal) + parseFloat(itemTotal);
                        taxes = parseFloat(taxes) + parseFloat(taxAmount);
                        discounts = parseFloat(discounts) + parseFloat(itemDisc);
                    });

                    $('#modal-container form .modal span.transaction-subtotal').html(formatter.format(parseFloat(subtotal)));
                    $('#modal-container form .modal span.transaction-taxes').html(formatter.format(parseFloat(taxes)));
                    $('#modal-container form .modal span.transaction-discounts').html(formatter.format(parseFloat(discounts)));
                    $('#modal-container form .modal #adjustment_input_cm').trigger('change');
                }
            });
        }
    });

    $(document).on('change', '#salesReceiptModal #customer', function () {
        $.get(base_url + `accounting/get-customer-details/${$(this).val()}`, function (result) {
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
                if (customerName.trim() !== '') {
                    $('#salesReceiptModal #billing-address').append('\n');
                }
            }
            var address = '';
            var address_with_replace = '';
            address += customer.mail_add !== "" && customer.mail_add !== null ? customer.mail_add + '\n' : "";
            address += customer.city !== "" && customer.city !== null ? customer.city + ', ' : "";
            address += customer.state !== "" && customer.state !== null ? customer.state + ' ' : "";
            address += customer.zip_code !== "" && customer.zip_code !== null ? customer.zip_code + ' ' : "";
            address += customer.country !== "" && customer.country !== null ? customer.country : "";

            address_with_replace = address.replace("NA", "");

            $('#salesReceiptModal #billing-address').html("");
            $('#salesReceiptModal #billing-address').append(address_with_replace.trim());
            $('#salesReceiptModal #email').val(customer.email);
        });
    });

    $(document).on('change', '#refundReceiptModal #refund-from-account', function () {
        var rowEl = $(this).parent().parent();
        var val = $(this).val();

        if (val !== '' && val !== null && val !== 'add-new') {
            $.get('/accounting/get-account-balance/' + val, function (res) {
                var result = JSON.parse(res);

                if (rowEl.find('#check-no').length > 0) {
                    rowEl.children('div.col-md-1:nth-child(3)').find('h4').html(result.balance);
                } else {
                    rowEl.append(`<div class="col-12 col-md-1"><label>Balance</label><h4>${result.balance}</h4></div>`);
                    rowEl.append(`<div class="col-12 col-md-2"><label for="check-no">Check no.</label><input type="text" class="form-control nsm-field mb-2" name="check_no" id="check-no" value="To print" disabled><div class="form-check"><input type="checkbox" name="print_later" value="1" class="form-check-input" id="print-later" checked><label class="form-check-label" for="print-later">Print later</label></div></div>`);
                }
            });
        }
    });

    $(document).on('change', '#refundReceiptModal #print-later', function () {
        if ($(this).prop('checked')) {
            $('#refundReceiptModal #check-no').prop('disabled', true);
            $('#refundReceiptModal #check-no').val('To print').trigger('change');
        } else {
            $('#refundReceiptModal #check-no').prop('disabled', false);
            $('#refundReceiptModal #check-no').val('').trigger('change');
        }
    });

    $(document).on('change', '#refundReceiptModal #customer', function () {
        $.get(base_url + `accounting/get-customer-details/${$(this).val()}`, function (result) {
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
                if (customerName.trim() !== '') {
                    $('#refundReceiptModal #billing-address').append('\n');
                }
            }
            var address = '';
            address += customer.mail_add !== "" && customer.mail_add !== null ? customer.mail_add + '\n' : "";
            address += customer.city !== "" && customer.city !== null ? customer.city + ', ' : "";
            address += customer.state !== "" && customer.state !== null ? customer.state + ' ' : "";
            address += customer.zip_code !== "" && customer.zip_code !== null ? customer.zip_code + ' ' : "";
            address += customer.country !== "" && customer.country !== null ? customer.country : "";

            $('#refundReceiptModal #billing-address').append(address.trim());
            $('#refundReceiptModal #email').val(customer.email);
        });
    });

    $(document).on('change', '#standard-estimate-modal #customer, #options-estimate-modal #customer, #bundle-estimate-modal #customer', function () {
        $.get(base_url + 'accounting/get-customer-details/' + $(this).val(), function (res) {
            var customer = JSON.parse(res);

            var jobLoc = '';
            jobLoc += customer.mail_add !== "" ? customer.mail_add + ' ' : "";
            jobLoc += customer.city !== "" ? customer.city + ', ' : "";
            jobLoc += customer.state !== "" ? customer.state : "";
            $('#modal-form .modal #job-location').val(jobLoc.trim());

            $('#modal-form .modal #customer-email').val(customer.email);
            $('#modal-form .modal #customer-mobile').val(customer.phone_m);
        });
    });

    $(document).on('click', '#options-estimate-modal #option-1-item-table #add_option_1_item, #options-estimate-modal #option-2-item-table #add_option_2_item, #bundle-estimate-modal #bundle-1-item-table #add_bundle_1_item, #bundle-estimate-modal #bundle-2-item-table #add_bundle_2_item', function () {
        if ($('#modal-container #item_list.modal').length === 0) {
            $.get(base_url + 'accounting/get-items-list-modal', function (res) {
                $('#modal-container').append(res);

                $('#modal-container #item_list table').nsmPagination({
                    itemsPerPage: 10
                });

                $('#modal-container #item_list').modal('show');
            });
        } else {
            $('#modal-container #item_list').modal('show');
        }

        targetItemTable = $(this).closest('table.nsm-table');
    });

    $(document).on('change', '#options-estimate-modal #option-1-item-table input, #options-estimate-modal #option-2-item-table input', function () {
        var quantityEl = $(this).closest('tr').find('input[name="quantity[]"]');
        var quantity = quantityEl.length > 0 ? quantityEl.val() : 0.00;
        var amountEl = $(this).closest('tr').find('input[name="item_amount[]"]');
        var amount = amountEl.length > 0 ? amountEl.val() : $(this).closest('tr').find('span.item-amount').html();
        var discountEl = $(this).closest('tr').find('input[name="discount[]"]');
        var discount = discountEl.length > 0 ? discountEl.val() : 0.00;
        var taxEl = $(this).closest('tr').find('input[name="item_tax[]"]');
        var tax = taxEl.length > 0 && taxEl.val() !== '' ? taxEl.val() : 0.00;

        var amount = parseFloat(amount === '' ? 0.00 : amount) * parseFloat(quantity === '' ? 0.00 : quantity);
        var taxAmount = parseFloat(tax === '' ? 0.00 : tax) * amount / 100;
        var total = parseFloat(amount) + parseFloat(taxAmount) - parseFloat(discount === '' ? 0.00 : discount);

        $(this).closest('tr').find('.row-total').html(formatter.format(parseFloat(total)));

        var subtotal = 0.00;
        var taxes = 0.00;
        var grandTotal = 0.00;
        $(this).closest('tbody').find('tr:not(.package-items, .package-item, .package-item-header, .linked-transaction-row, .linked-transaction-header)').each(function () {
            var itemAmount = $(this).find('input[name="item_amount[]"]').length > 0 ? $(this).find('input[name="item_amount[]"]').val() : $(this).find('span.item-amount').html();
            var itemQty = $(this).find('input[name="quantity[]"]').length > 0 ? $(this).find('input[name="quantity[]"]').val() : 0;
            var itemTax = $(this).find('input[name="item_tax[]"]').length > 0 ? $(this).find('input[name="item_tax[]"]').val() : 0.00;

            var itemTotal = parseFloat(itemAmount === '' ? 0.00 : itemAmount) * parseFloat(itemQty === '' ? 0.00 : itemQty);
            var taxAmount = parseFloat(itemTax === '' ? 0.00 : itemTax) * itemTotal / 100;

            subtotal = parseFloat(subtotal) + parseFloat(itemTotal);
            taxes = parseFloat(taxes) + parseFloat(taxAmount);
            grandTotal = parseFloat(grandTotal) + parseFloat($(this).find('.row-total').html().replace('$', ''));
        });

        var table = $(this).closest('table');
        $(this).closest('.accordion-body').find(`table:not(#${table.attr('id')})`).find('span.table-subtotal').html(formatter.format(parseFloat(subtotal)));
        $(this).closest('.accordion-body').find(`table:not(#${table.attr('id')})`).find('span.table-taxes').html(formatter.format(parseFloat(taxes)));
        $(this).closest('.accordion-body').find(`table:not(#${table.attr('id')})`).find('span.table-total').html(formatter.format(parseFloat(grandTotal)));
    });

    $(document).on('change', '#bundle-estimate-modal #bundle-1-item-table input, #bundle-estimate-modal #bundle-2-item-table input', function () {
        var quantityEl = $(this).closest('tr').find('input[name="quantity[]"]');
        var quantity = quantityEl.length > 0 ? quantityEl.val() : 0.00;
        var amountEl = $(this).closest('tr').find('input[name="item_amount[]"]');
        var amount = amountEl.length > 0 ? amountEl.val() : $(this).closest('tr').find('span.item-amount').html();
        var discountEl = $(this).closest('tr').find('input[name="discount[]"]');
        var discount = discountEl.length > 0 ? discountEl.val() : 0.00;
        var taxEl = $(this).closest('tr').find('input[name="item_tax[]"]');
        var tax = taxEl.length > 0 && taxEl.val() !== '' ? taxEl.val() : 0.00;

        var amount = parseFloat(amount === '' ? 0.00 : amount) * parseFloat(quantity === '' ? 0.00 : quantity);
        var taxAmount = parseFloat(tax === '' ? 0.00 : tax) * amount / 100;
        var total = parseFloat(amount) + parseFloat(taxAmount) - parseFloat(discount === '' ? 0.00 : discount);

        $(this).closest('tr').find('.row-total').html(formatter.format(parseFloat(total)));

        var subtotal = 0.00;
        var taxes = 0.00;
        var grandTotal = 0.00;
        $(this).closest('tbody').find('tr:not(.package-items, .package-item, .package-item-header, .linked-transaction-row, .linked-transaction-header)').each(function () {
            var itemAmount = $(this).find('input[name="item_amount[]"]').length > 0 ? $(this).find('input[name="item_amount[]"]').val() : $(this).find('span.item-amount').html();
            var itemQty = $(this).find('input[name="quantity[]"]').length > 0 ? $(this).find('input[name="quantity[]"]').val() : 0;
            var itemTax = $(this).find('input[name="item_tax[]"]').length > 0 ? $(this).find('input[name="item_tax[]"]').val() : 0.00;

            var itemTotal = parseFloat(itemAmount === '' ? 0.00 : itemAmount) * parseFloat(itemQty === '' ? 0.00 : itemQty);
            var taxAmount = parseFloat(itemTax === '' ? 0.00 : itemTax) * itemTotal / 100;

            subtotal = parseFloat(subtotal) + parseFloat(itemTotal);
            taxes = parseFloat(taxes) + parseFloat(taxAmount);
            grandTotal = parseFloat(grandTotal) + parseFloat($(this).find('.row-total').html().replace('$', ''));
        });

        var table = $(this).closest('table');
        var adjustmentVal = $(this).closest('.accordion-body').find(`table:not(#${table.attr('id')})`).find('input[name="adjustment_value"]').val();
        grandTotal -= adjustmentVal === '' ? 0.00 : parseFloat(adjustmentVal);
        $(this).closest('.accordion-body').find(`table:not(#${table.attr('id')})`).find('span.table-subtotal').html(formatter.format(parseFloat(subtotal)));
        $(this).closest('.accordion-body').find(`table:not(#${table.attr('id')})`).find('span.table-taxes').html(formatter.format(parseFloat(taxes)));
        $(this).closest('.accordion-body').find(`table:not(#${table.attr('id')})`).find('span.table-total').html(formatter.format(parseFloat(grandTotal)));

        var transactionTotal = 0.00;
        $('#bundle-estimate-modal .table-total').each(function () {
            var amount = $(this).html().replace('$', '');

            transactionTotal += parseFloat(amount);
        });

        $('#bundle-estimate-modal span.transaction-grand-total').html(formatter.format(transactionTotal));
    });

    $(document).on('change', '#bundle-estimate-modal input[name="adjustment_value"]', function () {
        var value = $(this).val() === '' ? 0.00 : parseFloat($(this).val());
        var subtotal = $(this).closest('table').find('span.table-subtotal').html().replace('$', '');
        var taxes = $(this).closest('table').find('span.table-taxes').html().replace('$', '');

        $(this).closest('td').next().find('span.table-adjustment').html(formatter.format(value));
        var grandTotal = parseFloat(subtotal) + parseFloat(taxes);
        grandTotal -= value;
        $(this).closest('table').find('span.table-total').html(formatter.format(grandTotal));

        var transactionTotal = 0.00;
        $('#bundle-estimate-modal .table-total').each(function () {
            var amount = $(this).html().replace('$', '');

            transactionTotal += parseFloat(amount);
        });

        $('#bundle-estimate-modal span.transaction-grand-total').html(formatter.format(transactionTotal));
    });

    $(document).on('click', '#billableExpenseModal #view-parent-transaction', function (e) {
        var id = $(this).data().id;
        var type = $(this).data().type;

        var data = {
            id: id,
            type: type
        };

        $.get(`/accounting/view-transaction/${type}/${id}`, function (res) {
            if ($('div#modal-container').length > 0) {
                $('div#modal-container').html(res);
            } else {
                $('body').append(`
                    <div id="modal-container"> 
                        ${res}
                    </div>
                `);
            }

            switch (type) {
                case 'expense':
                    initModalFields('expenseModal', data);

                    $('#expenseModal').modal('show');
                    break;
                case 'check':
                    initModalFields('checkModal', data);

                    $('#checkModal').modal('show');
                    break;
                case 'bill':
                    initModalFields('billModal', data);

                    $('#billModal').modal('show');
                    break;
                case 'cc-credit':
                    initModalFields('creditCardCreditModal', data);

                    $('#creditCardCreditModal').modal('show');
                    break;
                case 'vendor-credit':
                    initModalFields('vendorCreditModal', data);

                    $('#vendorCreditModal').modal('show');
                    break;
            }
        });
    });

});

const convertToDecimal = (el) => {
    if ($(el).val() !== '') {
        $(el).val(formatter.format(parseFloat($(el).val())).replace('$', '').replaceAll(',', ''));
    } else {
        $(el).val(0);
    }
}

const payrollRowTotal = (el) => {
    convertToDecimal(el);
    var totalPay = 0.00;
    var row = $(el).closest('tr');
    var payRate = row.find('span.pay-rate').html().replace('$', '');
    var regPayHours = "0.00";
    var commission = el.closest('tr').find('td:nth-child(5)').html();

    regPayHours = parseFloat(row.find('td:nth-child(4)').html()).toFixed(2);

    row.children('td:nth-child(7)').children().html(regPayHours);

    totalPay = parseFloat(parseFloat(regPayHours * parseFloat(payRate))).toFixed(2);

    totalPay = parseFloat(parseFloat(totalPay) + parseFloat(commission)).toFixed(2);

    row.children('td:last-child()').children('p').children('span.total-pay').html(formatter.format(parseFloat(totalPay)));
}

const payrollTotal = () => {
    var hours = 0.00;
    var totalPay = 0.00;
    var totalHrsPay = 0.00;
    var perHourPay = 0.00;
    var commission = 0.00;

    $('div#payrollModal table#payroll-table tbody tr').each(function () {
        if ($(this).find('.select-one').prop('checked')) {
            var empTotalHours = $(this).find('td:nth-child(4)').html();
            if (empTotalHours !== "" && empTotalHours !== undefined) {
                empTotalHours = parseFloat(empTotalHours);
            } else {
                empTotalHours = 0.00;
            }

            perHourPay += parseFloat($(this).find('td:nth-child(8)').text().replace('$', '').replace(',', ''));
            totalHrsPay += parseFloat($(this).find('td:nth-child(9)').text().replace('$', '').replace(',', ''));

            hours = parseFloat(parseFloat(hours) + empTotalHours);

            var empCommission = $(this).children('td:nth-child(5)').html().replace('$', '').replace(',', '');
            if (empCommission !== "" && empCommission !== undefined) {
                empCommission = parseFloat(empCommission);
            } else {
                empCommission = 0.00;
            }

            commission = parseFloat(parseFloat(commission) + empCommission);

            var empTotalPay = $(this).find('.total-pay').html().replace('$', '').replace(',', '');

            if (empTotalPay !== "" && empTotalPay !== undefined) {
                empTotalPay = parseFloat(empTotalPay);
            } else {
                empTotalPay = 0.00;
            }

            totalPay = parseFloat(parseFloat(totalPay) + parseFloat(empTotalPay));
        }
    });

    $('div#payrollModal table#payroll-table tfoot tr:first-child td:nth-child(4)').html(parseFloat(hours).toFixed(2));
    $('div#payrollModal table#payroll-table tfoot tr:first-child td:nth-child(7)').html(parseFloat(hours).toFixed(2));
    $('div#payrollModal table#payroll-table tfoot tr:first-child td:nth-child(8)').html(formatter.format(parseFloat(perHourPay)));
    $('div#payrollModal table#payroll-table tfoot tr:first-child td:nth-child(9)').html(formatter.format(parseFloat(totalHrsPay)));

    $('table#payroll-table tfoot tr:first-child td:nth-child(5)').html(formatter.format(parseFloat(commission)));

    $('div#payrollModal h2.total-pay').html(formatter.format(parseFloat(totalPay)));
    $('table#payroll-table tfoot tr:first-child td:last-child()').html(formatter.format(parseFloat(totalPay)));
}

const addEmployeeToPayroll = (email) => {
    var data = new FormData();

    if ($('#payrollModal #payPeriod').length > 0) {
        var payPeriod = $('#payrollModal #payPeriod').val();
    } else {
        var payPeriod = $('#payrollModal #pay-period-start').val() + '-' + $('#payrollModal #pay-period-end').val()
    }
    data.set('employee_email', email);
    data.set('pay_period', payPeriod);

    $.ajax({
        url: '/accounting/get-employee-pay-details',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function (result) {
            var res = JSON.parse(result);

            $('#payrollModal #payroll-table tbody').append(`
            <tr>
                <td>
                    <div class="table-row-icon table-checkbox">
                        <input class="form-check-input select-one table-select" type="checkbox" value="${res.id}" checked>
                    </div>
                </td>
                <td>
                    <a href="#" class="text-decoration-none">${res.name}</a>
                    <p class="m-0">${res.pay_rate}</p>
                </td>
                <td>${res.pay_details !== null && res.pay_details.pay_method === 'direct-deposit' ? 'Direct deposit' : 'Paper check'}</td>
                <td class="text-end">${parseFloat(res.total_hrs).toFixed(2)}</td>
                <td class="text-end">${res.commission !== null ? formatter.format(parseFloat(res.commission)) : formatter.format(parseFloat(0.00))}</td>
                <td>
                    <input type="text" name="memo[]" class="form-control nsm-field">
                </td>
                <td><p class="m-0 text-end">${parseFloat(res.total_hrs).toFixed(2)}</p></td>
                <td><p class="m-0 text-end">${formatter.format(parseFloat(res.per_hour_pay))}</p></td>
                <td><p class="m-0 text-end">${formatter.format(parseFloat(res.regular_hrs_pay_total))}</p></td>
                <td><p class="m-0 text-end"><span class="total-pay">${formatter.format(parseFloat(res.total_pay))}</span></p></td>
            </tr>`);

            payrollTotal();
        }
    });
}

const tableWeekDate = (el) => {
    var value = $(el).val();
    var split = value.split('-');
    var startDate = new Date(split[0]);
    var endDate = new Date(split[1]);

    for (var i = 3; startDate.getTime() <= endDate.getTime(); i++) {
        $(`#weeklyTimesheetModal table#timesheet-table thead td:nth-child(${i}) p:nth-child(2)`).html(startDate.getDate());
        startDate = new Date(startDate.getTime() + 86400000);
    }
}

const timeActivitySummary = (el) => {
    var date = $('div#singleTimeModal input#date').val();
    var time = $('div#singleTimeModal input#time').val();
    var breakTime = $('div#singleTimeModal input#break').val();
    var billable = $('div#singleTimeModal input#billable').prop('checked');
    var hourlyRate = $('div#singleTimeModal input#hourlyRate').val()
    hourlyRate = formatter.format(parseFloat(hourlyRate));
    var taxable = $('div#singleTimeModal input#taxable').prop('checked');
    var timeSplit = time !== "" ? time.split(':') : "";
    var breakSplit = breakTime !== "" ? breakTime.split(':') : "";
    var hour = 0;
    var minutes = 0;

    if ($('div#singleTimeModal input#startEndTime').prop('checked') === false && time !== "") {
        hour = parseInt(timeSplit[0]);
        minutes = parseInt(timeSplit[1]);

        if (time === '00:00') {
            $('#singleTimeModal #summary').remove();
        } else {
            var hourText = hour > 1 ? 'hours' : hour !== 0 ? 'hour' : '';
            var minuteText = minutes > 1 ? 'minutes' : minutes !== 0 ? 'minute' : '';
            var summary = hour > 0 ? hour + ' ' + hourText + ' ' : '';
            summary += minutes > 0 ? minutes + ' ' + minuteText : '';

            var totalHours = hour > 9 ? hour : '0' + hour;
            totalHours += ":";
            totalHours += minutes > 9 ? minutes : '0' + minutes;

            if (billable) {
                if (hourlyRate !== undefined && hourlyRate !== '$0.00' && hourlyRate !== '$' && totalHours !== undefined) {
                    summary += ' at ' + hourlyRate + ' per hour ='

                    var totalHrsSplit = totalHours.split(':');
                    var rate = parseFloat(hourlyRate.replace('$', '').replaceAll(',', ''));

                    var minutesDecimal = parseInt(totalHrsSplit[1]) / 60;
                    var totalTime = parseFloat(totalHrsSplit[0]) + minutesDecimal;

                    var totalBill = totalTime * rate;
                    totalBill = formatter.format(parseFloat(totalBill));
                    summary += ' ' + totalBill;
                    summary += taxable ? ' plus tax' : '';
                }
            }

            if (summary.trim() !== "") {
                if ($('div#singleTimeModal div#summary').length === 0) {
                    var toAppend = `<div id="summary">
                        <label for="summary">Summary</label>
                        <p>${summary.trim()}</p>
                    </div>`;

                    $(toAppend).insertAfter($('#singleTimeModal #description').parent());
                } else {
                    $('div#singleTimeModal div#summary p').html(summary.trim());
                }
            }
        }
    } else if ($('div#singleTimeModal input#startEndTime').prop('checked') === true) {
        var startTime = $('div#singleTimeModal select#startTime').val();
        var endTime = $('div#singleTimeModal select#endTime').val();

        if (startTime !== "" && endTime !== "" && startTime !== null && endTime !== null) {
            var start = new Date(date + " " + startTime).getTime();
            var end = new Date(date + " " + endTime).getTime();
            var duration = end - start;
            hour = Math.floor((duration / (1000 * 60 * 60)) % 24);
            minutes = Math.floor((duration / (1000 * 60)) % 60);

            hour = hour < 0 ? hour + 24 : hour;
            minutes = minutes < 0 ? minutes + 60 : minutes;

            if (breakSplit !== "") {
                var totalMins = minutes;

                if (hour > 0) {
                    for (i = 1; hour > 0; i++) {
                        totalMins += 60;
                        hour--;
                    }
                }

                var breakHours = parseInt(breakSplit[0]);
                var breakMins = parseInt(breakSplit[1]);
                if (breakHours > 0) {
                    for (i = 1; breakHours > 0; i++) {
                        breakMins += 60;
                        breakHours--;
                    }
                }

                var minutes = totalMins - breakMins;

                for (hour = 0; minutes > 60; hour++) {
                    minutes -= 60;
                }

                var totalHours = hour > 9 ? hour : '0' + hour;
                totalHours += ":";
                totalHours += minutes > 9 ? minutes : '0' + minutes;

                if (breakMins > totalMins) {
                    var summary = "The break time cannot exceed the total time worked. Please correct.";
                } else {
                    var hourText = hour > 1 ? 'hours' : hour !== 0 ? 'hour' : '';
                    var minuteText = minutes > 1 ? 'minutes' : minutes !== 0 ? 'minute' : '';
                    var summary = hour > 0 ? hour + ' ' + hourText + ' ' : '';
                    summary += minutes > 0 ? minutes + ' ' + minuteText : '';

                    if (billable) {
                        if (hourlyRate !== undefined && hourlyRate !== '$0.00' && hourlyRate !== '$' && totalHours !== undefined) {
                            summary += ' at ' + hourlyRate + ' per hour ='

                            var totalHrsSplit = totalHours.split(':');
                            var rate = parseFloat(hourlyRate.replace('$', '').replaceAll(',', ''));

                            var minutesDecimal = parseInt(totalHrsSplit[1]) / 60;
                            var totalTime = parseFloat(totalHrsSplit[0]) + minutesDecimal;

                            var totalBill = totalTime * rate;
                            totalBill = formatter.format(parseFloat(totalBill));
                            summary += ' ' + totalBill;
                            summary += taxable ? ' plus tax' : '';
                        }
                    }
                }
            } else {
                var hourText = hour > 1 ? 'hours' : hour !== 0 ? 'hour' : '';
                var minuteText = minutes > 1 ? 'minutes' : minutes !== 0 ? 'minute' : '';
                var summary = hour > 0 ? hour + ' ' + hourText + ' ' : '';
                summary += minutes > 0 ? minutes + ' ' + minuteText : '';

                var totalHours = hour > 9 ? hour : '0' + hour;
                totalHours += ":";
                totalHours += minutes > 9 ? minutes : '0' + minutes;

                if (billable) {
                    if (hourlyRate !== undefined && hourlyRate !== '$0.00' && hourlyRate !== '$' && totalHours !== undefined) {
                        summary += ' at ' + hourlyRate + ' per hour ='

                        var totalHrsSplit = totalHours.split(':');
                        var rate = parseFloat(hourlyRate.replace('$', '').replaceAll(',', ''));

                        var minutesDecimal = parseInt(totalHrsSplit[1]) / 60;
                        var totalTime = parseFloat(totalHrsSplit[0]) + minutesDecimal;

                        var totalBill = totalTime * rate;
                        totalBill = formatter.format(parseFloat(totalBill));
                        summary += ' ' + totalBill;
                        summary += taxable ? ' plus tax' : '';
                    }
                }
            }

            $('#singleTimeModal #time').val(totalHours);

            if (summary.trim() !== "" && totalHours !== "00:00") {
                if ($('div#singleTimeModal div#summary').length === 0) {
                    var toAppend = `<div id="summary">
                        <label for="summary">Summary</label>
                        <p>${summary.trim()}</p>
                    </div>`;

                    $(toAppend).insertAfter($('#singleTimeModal #description').parent());
                } else {
                    $('div#singleTimeModal div#summary p').html(summary.trim());
                }
            } else {
                $('#singleTimeModal #summary').remove();
            }
        }
    }
}

const computeTotalBill = () => {
    $('#weeklyTimesheetModal #timesheet-table tbody tr').each(function () {
        var rate = $(this).find('[name="hourly_rate[]"]').val();
        var totalHrs = $(this).find('.total-cell').find('p:nth-child(2)').html();

        if (rate !== undefined && rate !== '0.00' && totalHrs !== undefined && totalHrs !== '0:00') {
            var totalHrsSplit = totalHrs.split(':');
            rate = parseFloat(rate);

            var minutesDecimal = parseInt(totalHrsSplit[1]) / 60;
            totalHrs = parseFloat(totalHrsSplit[0]) + minutesDecimal;

            var totalBill = totalHrs * rate;
            if ($(this).find('.weekly-billable').prop('checked')) {
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

    $('#weeklyTimesheetModal #timesheet-table tbody tr').each(function () {
        var rowHours = 00;
        var rowMins = 00;
        var rowFlag = false;

        $(this).find('input.day-input').each(function () {
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

        $(`#weeklyTimesheetModal table#timesheet-table tbody tr td:nth-child(${index})`).each(function () {
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
    $('#weeklyTimesheetModal table#timesheet-table tbody tr .total-cell').each(function () {
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

// const loadTagsDataTable = () => {
//     $('#tags-table').DataTable({
//         autoWidth: false,
//         searching: false,
//         processing: true,
//         serverSide: true,
//         lengthChange: false,
//         ordering: false,
//         info: false,
//         ajax: {
//             url: '/accounting/load-job-tags/',
//             dataType: 'json',
//             contentType: 'application/json',
//             type: 'POST',
//             data: function(d) {
//                 d.columns[0].search.value = $('input#search-tag').val();
//                 return JSON.stringify(d);
//             },
//             pagingType: 'full_numbers',
//         },
//         columns: [
//             {
//                 data: 'tag_name',
//                 name: 'tag_name',
//                 fnCreatedCell: function(td, cellData, rowData, row, col) {
//                     $(td).html(`<span>${rowData.tag_name} ${rowData.type === 'group' ? `(${rowData.tags.length})` : ''}</span><a href="#" class="float-right text-info edit" data-group-tag="${rowData.group_tag_id}" data-type="${rowData.type}" data-id="${rowData.id}" data-name="${rowData.tag_name}">Edit</a>`);

//                     if(rowData.type === 'group') {
//                         $(td).prepend(`<a class="mr-3 cursor-pointer" data-toggle="collapse" data-target="#child-${row}"><i class="fa fa-chevron-down"></i></a>`);
//                     }
//                 }
//             }
//         ],
//         fnCreatedRow: function(nRow, aData, iDataIndex) {
//             if(aData['type'] === 'group-tag') {
//                 $(nRow).attr('id', `child-${aData['parentIndex']}`);
//                 $(nRow).addClass('collapse bg-light');
//             }
//         }
//     });
// }

const editGroupTagForm = (data) => {
    $.get('/accounting/edit-group-tag-form', function (res) {
        $('#tags-modal div.modal-dialog div#tags-list').remove();

        $('#tags-modal div.modal-dialog').append(`<form class="h-100" id="edit_group_tag"></form>`);
        $('#tags-modal div.modal-dialog form').append(res);

        $('#tags-modal div.modal-dialog form input').val(data.name);
        $('#tags-modal div.modal-dialog form input').parent().parent().prepend(`<input type="hidden" name="group_id" value="${data.id}">`);
    });
}

const getTagForm = (data = {}, method) => {
    $.get('/accounting/get-job-tag-form/', function (res) {
        if (method === 'update' && data.groupTag !== null && data.type === 'group-tag') {
            var groupTagName = $(`#tags-modal #tags-table tbody tr td .edit[data-id="${data.groupTag}"][data-type="group"]`).parent().prev().find('span').text().trim();

            groupTagName = groupTagName.slice(0, -4);
        }
        $('#tags-modal div.modal-dialog div#tags-list').remove();

        if (method === 'create') {
            $('#tags-modal div.modal-dialog').append(`<form class="h-100" id="create-tag-form"></form>`);
            // $('#tags-modal div.modal-dialog').append(`<form class="h-100" id="create-tag-form" onsubmit="submitTagsForm(this, 'create', event)"></form>`);
        } else {
            $('#tags-modal div.modal-dialog').append(`<form class="h-100" id="update-tag-form"></form>`);
            // $('#tags-modal div.modal-dialog').append(`<form class="h-100" id="update-tag-form" onsubmit="submitTagsForm(this, 'update', event)"></form>`);
        }

        $('#tags-modal div.modal-dialog form').append(res);

        if (method === 'update') {
            var id = data.id;
            var name = data.name;

            $('#tags-modal div.modal-dialog form h5').html('Edit tag');
            $('#tags-modal div.modal-dialog form input[name="tag_name"]').val(name);
            $('#tags-modal div.modal-dialog form').prepend(`<input type="hidden" name="id" value="${id}">`);

            if (data.groupTag !== null && data.type === 'group-tag') {
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
    $.get('/accounting/get-group-tag-form/', function (res) {
        $('#tags-modal div.modal-dialog div#tags-list').remove();

        $('#tags-modal div.modal-dialog').append(`<div class="h-100"></div>`)
        $('#tags-modal div.modal-dialog div').append(res);
    });
}

const showTagsList = (el) => {
    $(el).parent().parent().parent().remove();

    $('#tags-modal div.modal-dialog').append('<div class="modal-content" id="tags-list"></div>');
    $('#tags-modal div.modal-dialog div#tags-list').append(tagsListModal);
    // loadTagsDataTable();
}

// const submitTagsForm = (el, method = "", e) => {
//     e.preventDefault();

//     var data = new FormData(document.getElementById($(el).attr('id')));
//     data.append('method', method);

//     $.ajax({
//         url: '/accounting/tags/add-tag',
//         data: data,
//         type: 'post',
//         processData: false,
//         contentType: false,
//         success: function(result) {
//             var res = JSON.parse(result);

//             toast(res.success, res.message);

//             showTagsList($(el).children().children('.modal-header').children('button'));
//         }
//     });
// }

const computeBankDepositeTotal = () => {
    var otherFundsTotal = 0.00;

    $('div#depositModal input[name="amount[]"]').each(function () {
        if ($(this).val() !== "") {
            var val = $(this).val();
            otherFundsTotal = (parseFloat(otherFundsTotal) + parseFloat(val)).toFixed(2);
        }
    });

    var cashBackAmount = 0;

    if ($('div#depositModal input[name="cash_back_amount"]').val() !== "") {
        cashBackAmount = $('div#depositModal input[name="cash_back_amount"]').val();
    }

    var totalDepositAmount = (parseFloat(otherFundsTotal) - parseFloat(cashBackAmount)).toFixed(2);

    if (isNaN(totalDepositAmount)) {
        totalDepositAmount = '0.00';
    }

    $('div#depositModal span.other-funds-total').html(formatter.format(parseFloat(otherFundsTotal)));
    $('div#depositModal .transaction-total-amount').html(formatter.format(parseFloat(totalDepositAmount)));
    $('div#depositModal span.total-cash-back').html(formatter.format(parseFloat(totalDepositAmount)));
}

const addTableLines = (e) => {
    e.preventDefault();
    var table = e.currentTarget.dataset.target;
    var lastRow = $(`table${table} tbody tr:last-child() td:first-child()`);
    var lastRowCount = parseInt(lastRow.html());

    for (var i = 0; i < rowCount; i++) {
        lastRowCount++;
        var newRowHtml = '';

        if (table !== '#category-details-table' && table !== '#item-details-table') {
            newRowHtml = `<tr>${blankRow}</tr>`;
        } else {
            newRowHtml = `<tr>${catDetailsBlank}</tr>`;

            if ($(`table${table} thead tr th`).length > $(`table${table} tbody tr:last-child td`).length) {
                newRowHtml = `<td></td>` + newRowHtml;
            }
        }

        $(`table${table} tbody`).append(newRowHtml);
        $(`table${table} tbody tr:last-child() td:first-child()`).html(lastRowCount);

        var deleteButtonHtml = `<button type="button" class="nsm-button delete-row">
            <i class='bx bx-fw bx-trash'></i>
        </button>`;
        $(`table${table} tbody tr:last-child()`).append(`<td>${deleteButtonHtml}</td>`);

        populateDropdowns($(`table${table} tbody tr:last-child()`), table);

        $(`table${table} tbody tr:last-child() .delete-row-btn`).on('click', function () {
            $(this).closest('tr').remove();
            updateRowCount(table);
        });
    }
}

function populateDropdowns(row, table) {
    var productOptions = [];
    var locationOptions = [];

    $(`${table} tbody tr`).each(function () {
        var productId = $(this).find('select[name="product[]"]').val();
        var productName = $(this).find('select[name="product[]"] option:selected').text();
        var locationId = $(this).find('select[name="location[]"]').val();
        var locationName = $(this).find('select[name="location[]"] option:selected').text();

        if (productId && !productOptions.some(option => option.value === productId)) {
            productOptions.push({ value: productId, text: productName });
        }

        if (locationId && !locationOptions.some(option => option.value === locationId)) {
            locationOptions.push({ value: locationId, text: locationName });
        }
    });

    var productSelect = row.find('select[name="product[]"]');
    productSelect.empty();
    productSelect.append('<option value="" selected disabled>Select Product</option>'); // Add empty default option
    productOptions.forEach(function (option) {
        productSelect.append(`<option value="${option.value}">${option.text}</option>`);
    });

    var locationSelect = row.find('select[name="location[]"]');
    locationSelect.empty();
    locationSelect.append('<option value="" selected disabled>Select Location</option>'); // Add empty default option
    locationOptions.forEach(function (option) {
        locationSelect.append(`<option value="${option.value}">${option.text}</option>`);
    });
}

const clearTableLines = (e) => {
    e.preventDefault();
    var table = e.currentTarget.dataset.target;

    if ($('#modal-container .modal a#linked-transaction').length > 0) {
        unlinkTransaction();
        $('#modal-container .modal #payee').trigger('change');
        $('#modal-container .modal #vendor').trigger('change');
    }

    if (table !== '#previous-adjustments-table') {
        $(`table${table} tbody tr`).each(function (index, value) {
            var count = $(this).find('td:first-child()').html();
            if (index < rowCount) {
                if (table !== '#category-details-table' && table !== '#item-details-table') {
                    $(this).html(blankRow);
                } else {
                    if (table === '#category-details-table') {
                        $(this).html(catDetailsBlank);
                    } else {
                        $(this).html(itemDetailsBlank);
                    }
                }
                $(this).find('td:first-child()').html(count);
            }
            if (index >= rowCount - 1) {
                $(this).remove();
            }
        });
    } else {
        $(`${table} tbody`).html('');
    }
}

const submitModalForm = (event, el) => {
    event.preventDefault();

    var data = new FormData(document.getElementById($(el).attr('id')));
    data.set('save_method', submitType);
    var modalId = '#' + $(el).children().attr('id');

    switch (modalId) {
        case '#weeklyTimesheetModal':
            $('#weeklyTimesheetModal #timesheet-table tbody tr').each(function () {
                var customer = $(this).find('select[name="customer[]"]').val();
                if (customer !== "" && customer !== null) {
                    var hours = {
                        'sunday': $('#weeklyTimesheetModal #show_sunday').prop('checked') ? $(this).find('[name="sunday_hours[]"]').val() : null,
                        'monday': $('#weeklyTimesheetModal #show_monday').prop('checked') ? $(this).find('[name="monday_hours[]"]').val() : null,
                        'tuesday': $('#weeklyTimesheetModal #show_tuesday').prop('checked') ? $(this).find('[name="tuesday_hours[]"]').val() : null,
                        'wednesday': $('#weeklyTimesheetModal #show_wednesday').prop('checked') ? $(this).find('[name="wednesday_hours[]"]').val() : null,
                        'thursday': $('#weeklyTimesheetModal #show_thursday').prop('checked') ? $(this).find('[name="thursday_hours[]"]').val() : null,
                        'friday': $('#weeklyTimesheetModal #show_friday').prop('checked') ? $(this).find('[name="friday_hours[]"]').val() : null,
                        'saturday': $('#weeklyTimesheetModal #show_saturday').prop('checked') ? $(this).find('[name="saturday_hours[]"]').val() : null,
                    };

                    if (data.has('hours[]')) {
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
        case '#payBillsModal':
            // var totalAmount = $(`${modalId} span.transaction-total-amount`).html().replace('$', '').trim();;

            $(`${modalId} #bills-table tbody tr`).each(function () {
                var rowData = this.dataset;
                var checkbox = $(this).find('.select-one');
                var payee = rowData.payeeid;
                var credit_applied = $(this).find('input.credit-applied').length > 0 ? $(this).find('input.credit-applied').val() : 0.00;
                var payment_amount = $(this).find('input.payment-amount').val();
                var total_amount = $(this).find('td:last-child span').html().replace('$', '');

                if (checkbox.prop('checked')) {
                    if (data.has('bills[]') === false) {
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
        case '#billPaymentModal':
            data.delete('bills[]');
            data.delete('credits[]');

            $(`${modalId} #bills-table tbody tr`).each(function () {
                if ($(this).find('input[type="checkbox"]').prop('checked')) {
                    if (data.has('bills[]') === false) {
                        data.set('bills[]', $(this).find('input[type="checkbox"]').val());
                        data.set('bill_payment[]', $(this).find('input[name="bill_payment[]"]').val());
                    } else {
                        data.append('bills[]', $(this).find('input[type="checkbox"]').val());
                        data.append('bill_payment[]', $(this).find('input[name="bill_payment[]"]').val());
                    }
                }
            });

            $(`${modalId} #vendor-credits-table tbody tr`).each(function () {
                if ($(this).find('input[type="checkbox"]').prop('checked')) {
                    if (data.has('credits[]') === false) {
                        data.set('credits[]', $(this).find('input[type="checkbox"]').val());
                        data.set('credit_type[]', $(this).data().type);
                        data.set('credit_payment[]', $(this).find('input[name="credit_payment[]"]').val());
                    } else {
                        data.append('credits[]', $(this).find('input[type="checkbox"]').val());
                        data.append('credit_type[]', $(this).data().type);
                        data.append('credit_payment[]', $(this).find('input[name="credit_payment[]"]').val());
                    }
                }
            });

            data.set('fixed_total', $(`${modalId} input[name="payment_amount"]`).attr('data-fixed') !== undefined ? 1 : 0);
            data.set('amount_to_apply', $(`${modalId} span.amount-to-apply`).html().replace('$', '').replaceAll(',', '').trim());
            data.set('amount_to_credit', $(`${modalId} span.amount-to-credit`).html().replace('$', '').replaceAll(',', '').trim());
            break;
        case '#journalEntryModal':
            data.delete('names[]');

            $('#journalEntryModal #journal-table tbody tr select[name="names[]"]').each(function () {
                if (data.has('names[]') === false) {
                    data.set('names[]', $(this).val() === null ? '' : $(this).val());
                } else {
                    data.append('names[]', $(this).val() === null ? '' : $(this).val());
                }
            });
            break;
        case '#depositModal':
            data.delete('received_from[]');
            data.delete('payment_method[]');
            // var totalAmount = $(`#depositModal span.transaction-total-amount`).html().replace('$', '');

            $('#depositModal #bank-deposit-table tbody tr select[name="received_from[]"]').each(function () {
                if (data.has('received_from[]') === false) {
                    data.set('received_from[]', $(this).val() === null ? '' : $(this).val());
                } else {
                    data.append('received_from[]', $(this).val() === null ? '' : $(this).val());
                }
            });

            $('#depositModal #bank-deposit-table tbody tr select[name="payment_method[]"]').each(function () {
                if (data.has('payment_method[]') === false) {
                    data.set('payment_method[]', $(this).val() === null ? '' : $(this).val());
                } else {
                    data.append('payment_method[]', $(this).val() === null ? '' : $(this).val());
                }
            });
            break;
        case '#payrollModal':
            payrollFormData.set('payscale', payroll.payscale);
            data = payrollFormData;
            break;
        case '#commission-payroll-modal':
            data = payrollFormData;
            break;
        case '#bonus-payroll-modal':
            data = payrollFormData;
            break;
        case '#receivePaymentModal':
            data.delete('payment[]');
            data.delete('credit_payment[]');

            data.set('amount_to_credit', $('#receivePaymentModal span.amount-to-credit').html().replace('$', ''));
            data.set('amount_to_apply', $('#receivePaymentModal span.amount-to-apply').html().replace('$', ''));

            $('#receivePaymentModal #invoices-table tbody tr input[type="checkbox"]:checked').each(function () {
                if (data.has('invoice[]') === false) {
                    data.set('invoice[]', $(this).val());
                    data.set('payment[]', $(this).parent().parent().parent().parent().find('input[name="payment[]"]').val());
                } else {
                    data.append('invoice[]', $(this).val());
                    data.append('payment[]', $(this).parent().parent().parent().parent().find('input[name="payment[]"]').val());
                }
            });

            $('#receivePaymentModal #credits-table tbody tr input[type="checkbox"]:checked').each(function () {
                if (data.has('credits[]') === false) {
                    data.set('credits[]', $(this).val());
                    data.set('credit_payment[]', $(this).parent().parent().parent().parent().find('input[name="credit_payment[]"]').val());
                } else {
                    data.append('credits[]', $(this).val());
                    data.append('credit_payment[]', $(this).parent().parent().parent().parent().find('input[name="credit_payment[]"]').val());
                }
            });
            break;
        case '#invoiceModal':

            console.log(data);
            data.set('invoice_no', $('#invoiceModal #invoice-no').val());
            break;
        case '#statementModal':
            data.delete('customer[]');
            data.delete('email[]');
            data.delete('missing_email_customer[]');
            data.delete('no_email[]');

            $('#statementModal #statements-table tbody .select-one:checked').each(function () {
                var row = $(this).closest('tr');

                data.append('customer[]', $(this).val());
                data.append('email[]', row.find('input[name="email[]"]').val());
            });
            break;
    }

    if (customerModals.includes(modalId)) {
        if (modalId !== '#options-estimate-modal' && modalId !== '#bundle-estimate-modal') {
            data.delete('item[]');
            data.delete('package[]');
            data.delete('location[]');
            data.delete('quantity[]');
            data.delete('item_amount[]');
            data.delete('discount[]');
            data.delete('item_tax[]');
            data.delete('item_linked_transaction[]');
            data.delete('transaction_item_id[]');
            $(`${modalId} table#item-table tbody:not(#package-items-table) tr:not(.package-items, .package-item, .package-item-header)`).each(function () {
                if (data.has('item_total[]')) {
                    if ($(this).hasClass('package')) {
                        data.append('item[]', 'package-' + $(this).find('input[name="package[]"]').val());
                        data.append('location[]', null);
                        data.append('item_amount[]', $(this).find('span.item-amount').html());
                        data.append('discount[]', null);
                    } else {
                        data.append('item[]', 'item-' + $(this).find('input[name="item[]"]').val());
                        data.append('location[]', $(this).find('select[name="location[]"]').val());
                        data.append('item_amount[]', $(this).find('input[name="item_amount[]"]').val());
                        data.append('discount[]', $(this).find('input[name="discount[]"]').val());
                    }
                    data.append('item_tax[]', $(this).find('input[name="item_tax[]"]').val());
                    data.append('quantity[]', $(this).find('input[name="quantity[]"]').val());
                    data.append('item_total[]', $(this).find('span.row-total').html().replace('$', ''));
                    data.append('item_linked[]', $(this).find('input[name="item_linked_transaction[]"]').length > 0 ? $(this).find('input[name="item_linked_transaction[]"]').val() : '');
                    data.append('transac_item_id[]', $(this).find('input[name="transaction_item_id[]"]').length > 0 ? $(this).find('input[name="transaction_item_id[]"]').val() : '');
                } else {
                    if ($(this).hasClass('package')) {
                        data.set('item[]', 'package-' + $(this).find('input[name="package[]"]').val());
                        data.set('location[]', null);
                        data.set('item_amount[]', $(this).find('span.item-amount').html());
                        data.set('discount[]', null);
                    } else {
                        data.set('item[]', 'item-' + $(this).find('input[name="item[]"]').val());
                        data.set('location[]', $(this).find('select[name="location[]"]').val());
                        data.set('item_amount[]', $(this).find('input[name="item_amount[]"]').val());
                        data.set('discount[]', $(this).find('input[name="discount[]"]').val());
                    }
                    data.set('item_tax[]', $(this).find('input[name="item_tax[]"]').val());
                    data.set('quantity[]', $(this).find('input[name="quantity[]"]').val());
                    data.set('item_total[]', $(this).find('span.row-total').html().replace('$', ''));
                    data.set('item_linked[]', $(this).find('input[name="item_linked_transaction[]"]').length > 0 ? $(this).find('input[name="item_linked_transaction[]"]').val() : '');
                    data.set('transac_item_id[]', $(this).find('input[name="transaction_item_id[]"]').length > 0 ? $(this).find('input[name="transaction_item_id[]"]').val() : '');
                }
            });

            data.set('total_amount', $(`${modalId} .transaction-grand-total:first-child`).html().replace('$', '').trim());
            data.set('subtotal', $(`${modalId} .transaction-subtotal:first-child`).html().replace('$', '').trim());
            data.set('tax_total', $(`${modalId} .transaction-taxes:first-child`).html().replace('$', '').trim());
            data.set('discount_total', $(`${modalId} .transaction-discounts:first-child`).html().replace('$', '').trim());
        } else {
            data.delete('item[]');
            data.delete('package[]');
            data.delete('location[]');
            data.delete('quantity[]');
            data.delete('item_amount[]');
            data.delete('discount[]');
            data.delete('item_tax[]');
            data.delete('item_linked_transaction[]');
            data.delete('transaction_item_id[]');

            if (modalId === '#options-estimate-modal') {
                var table1 = $('#options-estimate-modal #option-1-item-table');
                var table2 = $('#options-estimate-modal #option-2-item-table');
            } else {
                var table1 = $('#bundle-estimate-modal #bundle-1-item-table');
                var table2 = $('#bundle-estimate-modal #bundle-2-item-table');
            }

            table1.children('tbody:not(#package-items-table)').children('tr:not(.package-items, .package-item, .package-item-header)').each(function () {
                if (data.has('table_1_item_total[]')) {
                    data.append('table_1_item[]', $(this).find('input[name="item[]"]').val());
                    data.append('table_1_location[]', $(this).find('select[name="location[]"]').val());
                    data.append('table_1_item_amount[]', $(this).find('input[name="item_amount[]"]').val());
                    data.append('table_1_discount[]', $(this).find('input[name="discount[]"]').val());
                    data.append('table_1_item_tax[]', $(this).find('input[name="item_tax[]"]').val());
                    data.append('table_1_quantity[]', $(this).find('input[name="quantity[]"]').val());
                    data.append('table_1_item_total[]', $(this).find('span.row-total').html().replace('$', ''));
                } else {
                    data.set('table_1_item[]', $(this).find('input[name="item[]"]').val());
                    data.set('table_1_location[]', $(this).find('select[name="location[]"]').val());
                    data.set('table_1_item_amount[]', $(this).find('input[name="item_amount[]"]').val());
                    data.set('table_1_discount[]', $(this).find('input[name="discount[]"]').val());
                    data.set('table_1_item_tax[]', $(this).find('input[name="item_tax[]"]').val());
                    data.set('table_1_quantity[]', $(this).find('input[name="quantity[]"]').val());
                    data.set('table_1_item_total[]', $(this).find('span.row-total').html().replace('$', ''));
                }
            });

            var t1subtotal = table1.closest('.accordion-body').find(`table:not(#${table1.attr('id')})`).find('.table-subtotal').html().replace('$', '');
            var t1taxes = table1.closest('.accordion-body').find(`table:not(#${table1.attr('id')})`).find('.table-taxes').html().replace('$', '');
            data.set('table_1_subtotal', t1subtotal);
            data.set('table_1_taxes', t1taxes);

            if (modalId === '#bundle-estimate-modal') {
                var t1adjustmentVal = table1.closest('.accordion-body').find(`table:not(#${table1.attr('id')})`).find('input[name="adjustment_value"]').val();
                var t1adjustmentName = table1.closest('.accordion-body').find(`table:not(#${table1.attr('id')})`).find('input[name="adjustment_name"]').val();
                data.set('table_1_adjustment_name', t1adjustmentName);
                data.set('table_1_adjustment', t1adjustmentVal);
            }
            var t1total = table1.closest('.accordion-body').find(`table:not(#${table1.attr('id')})`).find('.table-total').html().replace('$', '');
            data.set('table_1_total', t1total);

            table2.children('tbody:not(#package-items-table)').children('tr:not(.package-items, .package-item, .package-item-header)').each(function () {
                if (data.has('table_2_item_total[]')) {
                    data.append('table_2_item[]', $(this).find('input[name="item[]"]').val());
                    data.append('table_2_location[]', $(this).find('select[name="location[]"]').val());
                    data.append('table_2_item_amount[]', $(this).find('input[name="item_amount[]"]').val());
                    data.append('table_2_discount[]', $(this).find('input[name="discount[]"]').val());
                    data.append('table_2_item_tax[]', $(this).find('input[name="item_tax[]"]').val());
                    data.append('table_2_quantity[]', $(this).find('input[name="quantity[]"]').val());
                    data.append('table_2_item_total[]', $(this).find('span.row-total').html().replace('$', ''));
                } else {
                    data.set('table_2_item[]', $(this).find('input[name="item[]"]').val());
                    data.set('table_2_location[]', $(this).find('select[name="location[]"]').val());
                    data.set('table_2_item_amount[]', $(this).find('input[name="item_amount[]"]').val());
                    data.set('table_2_discount[]', $(this).find('input[name="discount[]"]').val());
                    data.set('table_2_item_tax[]', $(this).find('input[name="item_tax[]"]').val());
                    data.set('table_2_quantity[]', $(this).find('input[name="quantity[]"]').val());
                    data.set('table_2_item_total[]', $(this).find('span.row-total').html().replace('$', ''));
                }
            });

            var t2subtotal = table2.closest('.accordion-body').find(`table:not(#${table2.attr('id')})`).find('.table-subtotal').html().replace('$', '');
            var t2taxes = table2.closest('.accordion-body').find(`table:not(#${table2.attr('id')})`).find('.table-taxes').html().replace('$', '');
            data.set('table_2_subtotal', t2subtotal);
            data.set('table_2_taxes', t2taxes);

            if (modalId === '#bundle-estimate-modal') {
                var t2adjustmentVal = table2.closest('.accordion-body').find(`table:not(#${table2.attr('id')})`).find('input[name="adjustment_value"]').val();
                data.set('table_2_adjustment', t2adjustmentVal);
            }
            var t2total = table2.closest('.accordion-body').find(`table:not(#${table2.attr('id')})`).find('.table-total').html().replace('$', '');
            data.set('table_2_total', t2total);
        }
    }

    if (vendorModals.includes(modalId)) {
        var count = 0;

        if ($(`#modal-container #modal-form ${modalId} #templateName`).length > 0) {
            var totalAmount = 0.00;

            $('#modal-container table#category-details-table input[name="category_amount[]"]').each(function () {
                var value = $(this).val() === "" ? 0.00 : parseFloat($(this).val()).toFixed(2);

                totalAmount = parseFloat(parseFloat(totalAmount) + parseFloat(value)).toFixed(2);
            });

            $('#modal-container table#item-details-table tbody tr td span.row-total').each(function () {
                var value = $(this).html() === "" ? 0.00 : parseFloat($(this).html().replace('$', '').replaceAll(',', '')).toFixed(2);

                totalAmount = parseFloat(parseFloat(totalAmount) + parseFloat(value)).toFixed(2);
            });

            totalAmount = parseFloat(totalAmount).toFixed(2);
        } else {
            var totalAmount = $(`${modalId} span.transaction-total-amount`).html().replace('$', '');
        }

        data.append('total_amount', totalAmount);

        $(`${modalId} table#category-details-table tbody tr`).each(function () {
            var billable = $(this).find('input[name="category_billable[]"]');
            var tax = $(this).find('input[name="category_tax[]"]');

            if (billable.length > 0 && tax.length > 0) {
                if (count === 0) {
                    data.set('category_billable[]', billable.prop('checked') ? "1" : "0");
                    data.set('category_tax[]', tax.prop('checked') ? "1" : "0");
                    data.set('category_linked[]', $(this).find('input[name="category_linked_transaction[]"]').length > 0 ? $(this).find('input[name="category_linked_transaction[]"]').val() : '');
                    data.set('transac_category_id[]', $(this).find('input[name="transaction_category_id[]"]').length > 0 ? $(this).find('input[name="transaction_category_id[]"]').val() : '');
                } else {
                    data.append('category_billable[]', billable.prop('checked') ? "1" : "0");
                    data.append('category_tax[]', tax.prop('checked') ? "1" : "0");
                    data.append('category_linked[]', $(this).find('input[name="category_linked_transaction[]"]').length > 0 ? $(this).find('input[name="category_linked_transaction[]"]').val() : '');
                    data.append('transac_category_id[]', $(this).find('input[name="transaction_category_id[]"]').length > 0 ? $(this).find('input[name="transaction_category_id[]"]').val() : '');
                }
            }

            count++;
        });

        count = 0;
        $(`${modalId} table#item-details-table tbody tr`).each(function () {
            if (count === 0) {
                data.set('item_total[]', $(this).find('td span.row-total').html().replace('$', ''));
                data.set('item_linked[]', $(this).find('input[name="item_linked_transaction[]"]').length > 0 ? $(this).find('input[name="item_linked_transaction[]"]').val() : '');
                data.set('transac_item_id[]', $(this).find('input[name="transaction_item_id[]"]').length > 0 ? $(this).find('input[name="transaction_item_id[]"]').val() : '');
            } else {
                data.append('item_total[]', $(this).find('td span.row-total').html().replace('$', ''));
                data.append('item_linked[]', $(this).find('input[name="item_linked_transaction[]"]').length > 0 ? $(this).find('input[name="item_linked_transaction[]"]').val() : '');
                data.append('transac_item_id[]', $(this).find('input[name="transaction_item_id[]"]').length > 0 ? $(this).find('input[name="transaction_item_id[]"]').val() : '');
            }

            count++;
        });
    }
    data.append('modal_name', $(el).children().attr('id'));
    $.ajax({
        url: base_url + 'accounting/submit-modal-form',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function (result) {
            var res = JSON.parse(result);
            console.log(res.message);
            toast(res.success, removeDuplicateMessages(res.message));

            if (res.success === true) {
                if (submitType === 'save-and-close' || submitType === 'save-and-void') {
                    $(el).children().modal('hide');
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                }

                if (submitType !== 'save-and-close' && submitType !== 'save-and-new' && modalId !== '#payBillsModal') {
                    switch ($(el).children().attr('id')) {
                        case 'expenseModal':
                            var type = 'expense';

                            $('#expenseModal .modal-footer div.row.w-100 div:nth-child(2)').removeClass('d-flex');
                            $('#expenseModal .modal-footer div.row.w-100 div:nth-child(2)').html(`
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <span><a href="#" class="text-dark text-decoration-none" onclick="makeRecurring('expense')">Make Recurring</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span>
                                        <div class="dropup">
                                            <a href="javascript:void(0);" class="text-dark text-decoration-none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
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
                        case 'checkModal':
                            var type = 'check';

                            $('#checkModal .modal-footer div.row.w-100 div:nth-child(2) div.row div.dropup div.dropdown-menu').html(`
                            <a class="dropdown-item" href="#" id="copy-check">Copy</a>
                            <a class="dropdown-item" href="#" id="void-check">Void</a>
                            <a class="dropdown-item" href="#" id="delete-check">Delete</a>
                            <a class="dropdown-item" href="#">Transaction journal</a>
                            <a class="dropdown-item" href="#">Audit history</a>`);
                            break;
                        case 'billModal':
                            var type = 'bill';

                            $('#billModal .modal-footer div.row.w-100 div:nth-child(2)').removeClass('d-flex');
                            $('#billModal .modal-footer div.row.w-100 div:nth-child(2)').html(`
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <span><a href="#" class="text-dark text-decoration-none" onclick="makeRecurring('bill')">Make Recurring</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span>
                                        <div class="dropup">
                                            <a href="javascript:void(0);" class="text-dark text-decoration-none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
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
                        case 'purchaseOrderModal':
                            var type = 'purchase-order';

                            $('#purchaseOrderModal .modal-footer div.row.w-100 div:nth-child(2) div.row div.dropup div.dropdown-menu').append(`
                            <span class="mx-3 divider"></span>
                            <span>
                                <div class="dropup">
                                    <a href="javascript:void(0);" class="text-dark text-decoration-none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" id="copy-purchase-order">Copy</a>
                                        <a class="dropdown-item" href="#" id="delete-purchase-order">Delete</a>
                                        <a class="dropdown-item" href="#">Audit history</a>
                                    </div>
                                </div>
                            </span>`);
                            break;
                        case 'vendorCreditModal':
                            var type = 'vendor-credit';

                            $('#vendorCreditModal .modal-footer div.row.w-100 div:nth-child(2)').removeClass('d-flex');
                            $('#vendorCreditModal .modal-footer div.row.w-100 div:nth-child(2)').html(`
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <span><a href="#" class="text-dark text-decoration-none" onclick="makeRecurring('vendor_credit')">Make Recurring</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span>
                                        <div class="dropup">
                                            <a href="javascript:void(0);" class="text-dark text-decoration-none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
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
                        case 'creditCardCreditModal':
                            var type = 'credit-card-credit';

                            $('#creditCardCreditModal .modal-footer div.row.w-100 div:nth-child(2)').removeClass('d-flex');
                            $('#creditCardCreditModal .modal-footer div.row.w-100 div:nth-child(2)').html(`
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <span><a href="#" class="text-dark text-decoration-none" onclick="makeRecurring('credit_card_credit')">Make Recurring</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span>
                                        <div class="dropup">
                                            <a href="javascript:void(0);" class="text-dark text-decoration-none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
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
                        case 'singleTimeModal':
                            var type = 'time-activity';

                            $('#singleTimeModal .modal-footer div.row.w-100').children('div:nth-child(2)').html(`<a href="#" class="text-dark text-decoration-none m-auto" id="delete-time-activity">Delete</a>`);
                            break;
                        case 'journalEntryModal':
                            var type = 'journal';

                            $('#journalEntryModal .modal-footer div.row.w-100 div:nth-child(2)').removeClass('d-flex');
                            $('#journalEntryModal .modal-footer div.row.w-100 div:nth-child(2)').html(`
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <span><a href="#" class="text-dark text-decoration-none">Reverse</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span><a href="#" class="text-dark text-decoration-none" onclick="makeRecurring('journal_entry')">Make Recurring</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span>
                                        <div class="dropup">
                                            <a href="javascript:void(0);" class="text-dark text-decoration-none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
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
                        case 'inventoryModal':
                            var type = 'inventory-qty-adjust';
                            break;
                        case 'payDownCreditModal':
                            var type = 'credit-card-payment';

                            $('#payDownCreditModal .modal-footer div.row.w-100 div:nth-child(2)').html(`
                            <div class="dropup m-auto">
                                <a href="javascript:void(0);" class="text-dark text-decoration-none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" id="void-credit-card-payment">Void</a>
                                    <a class="dropdown-item" href="#" id="delete-credit-card-payment">Delete</a>
                                    <a class="dropdown-item" href="#">Transaction journal</a>
                                    <a class="dropdown-item" href="#">Audit history</a>
                                </div>
                            </div>`);
                            break;
                        case 'receivePaymentModal':
                            var type = 'receive-payment';

                            $('#receivePaymentModal .modal-footer div.row.w-100 div:nth-child(2)').removeClass('d-flex');
                            $('#receivePaymentModal .modal-footer div.row.w-100 div:nth-child(2)').html(`
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <span><a href="#" class="text-dark text-decoration-none" id="save-and-print">Print</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span>
                                        <div class="dropup">
                                            <a href="javascript:void(0);" class="text-dark text-decoration-none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
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
                        case 'invoiceModal':
                            var type = 'invoice';

                            $('#invoiceModal .modal-footer div.row.w-100 div:nth-child(2) div.row div').append(`
                            <span class="mx-3 divider"></span>
                            <span>
                                <div class="dropup">
                                    <a href="javascript:void(0);" class="text-dark text-decoration-none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
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
                        case 'weeklyTimesheetModal':
                            var type = 'weekly-timesheet';
                            break;
                        case 'creditMemoModal':
                            var type = 'credit-memo';

                            $('#creditMemoModal .modal-footer div.row.w-100 div:nth-child(2) div.row div').append(`
                            <span class="mx-3 divider"></span>
                            <span>
                                <div class="dropup">
                                    <a href="javascript:void(0);" class="text-dark text-decoration-none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
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
                        case 'salesReceiptModal':
                            var type = 'sales-receipt';

                            $('#salesReceiptModal .modal-footer div.row.w-100 div:nth-child(2) div.row div').append(`
                            <span class="mx-3 divider"></span>
                            <span>
                                <div class="dropup">
                                    <a href="javascript:void(0);" class="text-dark text-decoration-none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
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
                        case 'refundReceiptModal':
                            var type = 'refund-receipt';

                            $('#refundReceiptModal .modal-footer div.row.w-100 div:nth-child(2) div.row div').prepend(`
                            <span><a href="#" class="text-dark text-decoration-none">Order checks</a></span>
                            <span class="mx-3 divider"></span>`);
                            $('#refundReceiptModal .modal-footer div.row.w-100 div:nth-child(2) div.row div').append(`
                            <span class="mx-3 divider"></span>
                            <span>
                                <div class="dropup">
                                    <a href="javascript:void(0);" class="text-dark text-decoration-none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" id="copy-refund-receipt">Copy</a>
                                        <a class="dropdown-item" href="#" id="void-refund-receipt">Void</a>
                                        <a class="dropdown-item" href="#" id="delete-refund-receipt">Delete</a>
                                        <a class="dropdown-item" href="#">Transaction journal</a>
                                        <a class="dropdown-item" href="#">Audit history</a>
                                    </div>
                                </div>
                            </span>`);
                            break;
                    }

                    $('#modal-container form').attr('data-href', `/accounting/update-transaction/${type}/${res.data}`);
                    $('#modal-container form').attr('onsubmit', 'updateTransaction(event, this)');
                }

                if (submitType === 'save-and-send' && modalId === '#purchaseOrderModal') {
                    sendPurchaseOrder(res.data);
                }

                if (submitType === 'save-and-print') {
                    switch (type) {
                        case 'purchase-order':
                            printPurchaseOrder();
                            break;
                        case 'weekly-timesheet':
                            printTimesheet(res.data);
                            break;
                        case 'receive-payment':

                            break;
                        case 'invoice':
                            printPreviewInvoice();
                            break;
                        case 'credit-memo':
                            printPreviewCreditMemo();
                            break;
                        case 'sales-receipt':
                            printPreviewSalesReceipt();
                            break;
                        case 'refund-receipt':
                            printPreviewRefundReceipt();
                            break;
                    }
                }

                if (submitType === 'save-and-new') {
                    clearForm();
                    if (modalId == 'creditMemoModal') {

                    }
                }

                if (type == 'check') {
                    load_print_check_modal();
                }
            }

            submitType = '';
        }
    });
}
const removeDuplicateMessages = (htmlMessage) => {

    const lines = htmlMessage.split('\n');

    const uniqueLines = Array.from(new Set(lines));

    const uniqueMessage = uniqueLines.join('\n');
    return uniqueMessage;
};

const printTimesheet = (timesheetId) => {
    $.get(`/accounting/get-timesheet/${timesheetId}`, function (result) {
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

        for (var row in time_activities) {
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
            for (var activity in activities) {
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

                for (var o = 1; dayTotalMins >= 60; o++) {
                    dayTotalHour += 1;
                    dayTotalMins -= 60;
                    totalHours += 1;
                    totalMins -= 60;
                }

                dayTotalHour = dayTotalHour.toString().length === 1 ? "0" + dayTotalHour.toString() : dayTotalHour.toString();
                dayTotalMins = dayTotalMins.toString().length === 1 ? "0" + dayTotalMins.toString() : dayTotalMins.toString();
                totalHours = totalHours.toString().length === 1 ? "0" + totalHours.toString() : totalHours.toString();
                totalMins = totalMins.toString().length === 1 ? "0" + totalMins.toString() : totalMins.toString();
                totalTimes[days[date.getDay()]] = `${dayTotalHour}:${dayTotalMins}`;
                totalTimes['total'] = `${totalHours}:${totalMins}`;
            }

            for (var day in cols) {
                timesheetRow += cols[day];
            }

            for (var i = 1; rowMins >= 60; i++) {
                rowHours = rowHours + 1;
                rowMins = rowMins - 60;
            }

            rowHours = rowHours.toString().length === 1 ? "0" + rowHours.toString() : rowHours.toString();
            rowMins = rowMins.toString().length === 1 ? "0" + rowMins.toString() : rowMins.toString();

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
    if ($(el).attr('id') === 'billable') {
        if ($(el).prop('checked') === true) {
            $(el).parent().parent().next().children('input').show();
            $(el).parent().parent().next().children('input').attr('required', 'required');
            $(el).parent().parent().next().next().children('div').show();
        } else {
            $(el).parent().parent().next().children('input').hide();
            $(el).parent().parent().next().children('input').removeAttr('required');
            $(el).parent().parent().next().next().children('div').hide();
        }
    }

    if ($(el).attr('id') === 'startEndTime') {
        if ($(el).prop('checked') === true) {
            $('div#singleTimeModal select#startTime, select#endTime').parent().show();
            $('div#singleTimeModal select#startTime, select#endTime').prop('required', true);
            $('div#singleTimeModal input#time').parent().addClass('d-none');
            $('div#singleTimeModal input#break').parent().removeClass('d-none');
            // $('div#singleTimeModal label[for="time"]').html('Break');
            // $('div#singleTimeModal input#time').removeAttr('required');
            // $('div#singleTimeModal input#time').val('');
            $('div#singleTimeModal div#summary').remove();
        } else {
            $('select#startTime, select#endTime').parent().hide();
            $('select#startTime, select#endTime').removeAttr('required');
            $('div#singleTimeModal input#time').parent().removeClass('d-none');
            $('div#singleTimeModal input#break').parent().addClass('d-none');
            // $('label[for="time"]').html('Time');
            // $('input#time').prop('required', true);
        }
    }

    if ($(el).hasClass('weekly-billable')) {
        if ($(el).prop('checked') === true) {
            var id = $(el).attr('id');
            var number = id.replace('billable_', '');
            var serviceId = $(el).parent().parent().parent().prev().find('[name="service[]"]').val();

            $.get(base_url + `accounting/get-item-details/${serviceId}`, function (res) {
                var result = JSON.parse(res);
                var rate = result.item !== null ? result.item.price : '';
                $(el).parent().parent().parent().append(`
                <div class="col g-0">
                    <input type="number" name="hourly_rate[]" step=".01" value="${rate}" onchange="convertToDecimal(this)" class="form-control nsm-field">
                </div>
                <div class="col d-flex align-items-center">
                    <div class="form-check">
                        <input type="checkbox" name="taxable[]" id="taxable_${number}" class="form-check-input" value="1">
                        <label class="form-check-label" for="taxable_${number}">Taxable</label>
                    </div>
                </div>`);

                $(el).parent().parent().parent().find('[name="hourly_rate[]"]').trigger('change');
            });
        } else {
            $(el).parent().parent().parent().find('input[name="hourly_rate[]"]').parent().remove();
            $(el).parent().parent().parent().find('input[name="taxable[]"]').parent().parent().remove();
            $(el).closest('tr').find('td.total-cell').find('p:nth-child(3), p:nth-child(4)').remove();
        }
    }
}

const makeRecurring = (modalName) => {
    var modalId = '';

    var templateFields = `<div class="row recurring-details">
        <div class="col-12 grid-mb">
            <h3>Recurring Bank Deposit</h3>
            <div class="row">
                <div class="col-12 col-md-3">
                    <label for="templateName">Template name</label>
                    <input type="text" class="form-control nsm-field" id="templateName" name="template_name">
                </div>
                <div class="col-12 col-md-2">
                    <label for="recurringType">Type</label>
                    <select class="form-control nsm-field" id="recurringType" name="recurring_type">
                        <option value="scheduled">Scheduled</option>
                        <option value="reminder">Reminder</option>
                        <option value="unscheduled">Unscheduled</option>
                    </select>
                </div>
                <div class="col-12 col-md-3 d-flex flex-column p-0 align-items-start">
                    <span>Create &emsp;</span>
                    <div class="d-flex align-items-start justify-content-center"><input type="number" name="days_in_advance" id="dayInAdvance" class="form-control nsm-field w-auto">
                    <span>&emsp; days in advance</span></div>
                </div>
            </div>
        </div>
    </div>`;

    var date = new Date();
    var month = date.getMonth();
    var year = date.getFullYear();
    var totalDays = new Date(year, month + 1, 0).getDate();
    var ends = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'];
    var options = "";
    for (i = 1; i <= totalDays; i++) {
        if ((i % 100) >= 11 && (i % 100) <= 13) {
            var abbreviation = i + 'th';
        } else {
            var abbreviation = i + ends[i % 10];
        }

        options += `<option value="${i}">${abbreviation}</>`;
    }
    options += '<option value="last">Last</option>';

    var intervalFields = `<div class="row recurring-interval-container">
        <div class="col-12 grid-mb">
            <div class="row">
                <div class="col-12 col-md-2">
                    <label for="recurringInterval">Interval</label>
                    <select class="form-control nsm-field" name="recurring_interval" id="recurringInterval">
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly" selected>Monthly</option>
                        <option value="yearly">Yearly</option>
                    </select>
                </div>
                <div class="col-12 col-md-4">
                    <div class="row h-100">
                        <div class="col-1 d-flex align-items-end justify-content-center">on</div>
                        <div class="col-11 col-md-2 d-flex align-items-end">
                            <select name="recurring_week" class="form-control nsm-field">
                                <option value="day">day</option>
                                <option value="first">first</option>
                                <option value="second">second</option>
                                <option value="third">third</option>
                                <option value="fourth">fourth</option>
                                <option value="last">last</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-3 d-flex align-items-end">
                            <select class="form-control nsm-field" name="recurring_day">
                            ${options}
                            </select>
                        </div>
                        <div class="col-2 d-flex align-items-end justify-content-center">of every</div>
                        <div class="col-8 col-md-2 d-flex align-items-end">
                            <input type="number" value="1" class="form-control nsm-field" name="recurr_every">
                        </div>
                        <div class="col-2 align-items-end d-flex">month(s)</div>
                    </div>
                </div>
                <div class="col-12 col-md-1">
                    <label for="startDate">Start date</label>
                    <div class="nsm-field-group calendar">
                        <input type="text" class="form-control nsm-field date" name="start_date" id="startDate"/>
                    </div>
                </div>
                <div class="col-12 col-md-1">
                    <label for="endType">End</label>
                    <select name="end_type" class="form-control nsm-field" id="endType">
                        <option value="none">None</option>
                        <option value="by">By</option>
                        <option value="after">After</option>
                    </select>
                </div>
            </div>
        </div>
    </div>`;

    switch (modalName) {
        case 'bank_deposit':
            modalId = 'depositModal';
            $(templateFields).insertBefore($(`#${modalId} div.modal-body div.row.bank-account-details`));
            $(intervalFields).insertAfter($(`#${modalId} div.modal-body div.row.bank-account-details`));
            $(`#${modalId} .bank-account-details #date`).parent().parent().remove();
            $(`#${modalId} #account-balance`).parent().parent().remove();
            $(`#${modalId} div.modal-body div.row.bank-account-details`).children('div:last-child()').remove();
            $(`#${modalId} #collapse-nsmartrac-payments`).parent().parent().remove();
            break;
        case 'transfer':
            modalId = 'transferModal';
            $(`div#${modalId} div.modal-body`).children('.row').children(':first-child').prepend(intervalFields);
            $(`div#${modalId} div.modal-body`).children('.row').children(':first-child').prepend(templateFields);
            $(`#${modalId} div.modal-body div.recurring-details h3`).html('Recurring Transfer');
            $(`div#${modalId} div.modal-body #date`).parent().parent().remove();
            break;
        case 'journal_entry':
            modalId = 'journalEntryModal';
            $(`div#${modalId} div.modal-body div.row.journal-entry-details`).remove();
            $(`div#${modalId} div.modal-body`).children('.row').children(':first-child').prepend(intervalFields);
            $(`div#${modalId} div.modal-body`).children('.row').children(':first-child').prepend(templateFields);
            $(`#${modalId} div.modal-body div.recurring-details h3`).html('Recurring Journal Entry');
            $(`#${modalId} div.modal-header .modal-title span`).html('');
            break;
        case 'expense':
            modalId = 'expenseModal';
            $(templateFields).insertBefore($(`#${modalId} div.modal-body div.row.payee-details`));
            $(intervalFields).insertAfter($(`#${modalId} div.modal-body div.row.payee-details`));
            $(`#${modalId} div.modal-body div.row.payee-details`).children('div:last-child()').remove();
            $(`#${modalId} #account-balance`).parent().parent().remove();
            $(`#${modalId} label[for="expense_payment_account"]`).html('Account');
            $(`#${modalId} div.modal-body #payment_date`).parent().parent().remove();
            $(`#${modalId} div.modal-body #ref_no`).parent().remove();
            $(`#${modalId} div.modal-body div.recurring-details h3`).html('Recurring Expense');
            break;
        case 'check':
            modalId = 'checkModal';
            $(templateFields).insertBefore($(`#${modalId} div.modal-body div.row.payee-details`));
            $(intervalFields).insertAfter($(`#${modalId} div.modal-body div.row.payee-details`));
            $(`#${modalId} div.modal-body div.row.payee-details`).children('div:last-child()').remove();
            $(`#${modalId} #account-balance`).parent().parent().remove();
            $(`#${modalId} label[for="bank_account"]`).html('Account');
            $(`#${modalId} div.modal-body #payment_date`).parent().parent().html('');
            $(`#${modalId} div.modal-body div.recurring-details h3`).html('Recurring Check');
            break;
        case 'bill':
            modalId = 'billModal';
            $(templateFields).insertBefore($(`#${modalId} div.modal-body div.row.payee-details`));
            $(intervalFields).insertAfter($(`#${modalId} div.modal-body div.row.payee-details`));
            $(`#${modalId} div.modal-body div.row.payee-details`).children('div:last-child()').remove();
            $(`#${modalId} div.modal-body #bill_date`).parent().parent().remove();
            $(`#${modalId} div.modal-body #due_date`).parent().parent().remove();
            $(`#${modalId} div.modal-body #bill_no`).parent().remove();
            $(`#${modalId} div.modal-body div.recurring-details h3`).html('Recurring Bill');
            break;
        case 'purchase_order':
            modalId = 'purchaseOrderModal';
            $(templateFields).insertBefore($(`#${modalId} div.modal-body div.row.payee-details`));
            $(intervalFields).insertAfter($(`#${modalId} div.modal-body div.row.payee-details`));
            $(`#${modalId} div.modal-body div.row.payee-details`).children('div:last-child()').remove();
            $(`#${modalId} div.modal-body #purchase_order_date`).parent().prev().remove();
            $(`#${modalId} div.modal-body #purchase_order_date`).parent().remove();
            $(`#${modalId} div.modal-body #status`).parent().parent().remove();
            $(`#${modalId} div.modal-body div.recurring-details h3`).html('Recurring Purchase Order');
            break;
        case 'vendor_credit':
            modalId = 'vendorCreditModal';
            $(templateFields).insertBefore($(`#${modalId} div.modal-body div.row.payee-details`));
            $(intervalFields).insertAfter($(`#${modalId} div.modal-body div.row.payee-details`));
            $(`#${modalId} div.modal-body div.row.payee-details`).children('div:last-child()').remove();
            $(`#${modalId} div.modal-body #payment_date`).parent().parent().html('');
            $(`#${modalId} div.modal-body #ref_no`).prev().remove();
            $(`#${modalId} div.modal-body #ref_no`).remove();
            $(`#${modalId} div.modal-body div.recurring-details h3`).html('Recurring Vendor Credit');
            break;
        case 'credit_card_credit':
            modalId = 'creditCardCreditModal';
            $(templateFields).insertBefore($(`#${modalId} div.modal-body div.row.payee-details`));
            $(intervalFields).insertAfter($(`#${modalId} div.modal-body div.row.payee-details`));
            $(`#${modalId} div.modal-body div.row.payee-details`).children('div:last-child()').remove();
            $(`#${modalId} div.modal-body #payment_date`).parent().parent().html('');
            $(`#${modalId} div.modal-body #ref_no`).prev().remove();
            $(`#${modalId} div.modal-body #ref_no`).remove();
            $(`#${modalId} #account-balance`).parent().parent().remove();
            $(`#${modalId} label[for="bank_credit_account"]`).html('Account');
            $(`#${modalId} div.modal-body div.recurring-details h3`).html('Recurring Credit Card Credit');
            break;
        case 'credit_memo':
            modalId = 'creditMemoModal';
            $(templateFields).insertBefore($(`#${modalId} div.modal-body div.row.customer-details`));
            $(intervalFields).insertAfter($(`#${modalId} div.modal-body div.row.customer-details`));
            $(`#${modalId} div.modal-body div.row.customer-details`).children('div:last-child()').remove();
            $(`#${modalId} div.modal-body #credit_memo_date`).parent().prev().remove();
            $(`#${modalId} div.modal-body #credit_memo_date`).parent().remove();
            $(`#${modalId} div.modal-body div.recurring-details h3`).html('Recurring Credit Memo');
            $(`#${modalId} div.modal-body #sales-rep`).parent().removeClass('w-100').parent().removeClass('d-flex').removeClass('align-items-end');
            $(`#${modalId} div.modal-body #send-later`).parent().parent().remove();
            break;
        case 'sales_receipt':
            modalId = 'salesReceiptModal';
            $(templateFields).insertBefore($(`#${modalId} div.modal-body div.row.customer-details`));
            $(intervalFields).insertAfter($(`#${modalId} div.modal-body div.row.customer-details`));
            $(`#${modalId} div.modal-body div.recurring-details h3`).html('Recurring Sales Receipt');
            $(`#${modalId} div.modal-body div.row.customer-details`).children('div:last-child()').remove();
            $(`#${modalId} div.modal-body #sales-receipt-date`).parent().prev().remove();
            $(`#${modalId} div.modal-body #sales-receipt-date`).parent().remove();
            $(`#${modalId} div.modal-body #sales-rep`).parent().removeClass('w-100').parent().removeClass('d-flex').removeClass('align-items-end');
            $(`#${modalId} div.modal-body #send-later`).parent().parent().remove();

            var addedFields = `<div class="col-12 col-md-3">`;
            addedFields += `<label>Options</label>`;
            addedFields += `<div class="form-check">`;
            addedFields += `<input type="checkbox" name="auto_send_emails" value="1" class="form-check-input" id="auto-send-emails">`;
            addedFields += `<label class="form-check-label" for="auto-send-emails">Automatically send emails</label>`;
            addedFields += `</div>`;
            addedFields += `<div class="form-check">`;
            addedFields += `<input type="checkbox" name="print_later" value="1" class="form-check-input" id="print-later">`;
            addedFields += `<label class="form-check-label" for="print-later">Print later</label>`;
            addedFields += `</div>`;
            addedFields += `</div>`;
            $(addedFields).insertAfter($(`#${modalId} #email`).parent());
            break;
        case 'refund_receipt':
            modalId = 'refundReceiptModal';
            $(templateFields).insertBefore($(`#${modalId} div.modal-body div.row.customer-details`));
            $(intervalFields).insertAfter($(`#${modalId} div.modal-body div.row.customer-details`));
            $(`#${modalId} div.modal-body div.row.customer-details`).children('div:last-child()').remove();
            $(`#${modalId} div.modal-body #refund-receipt-date`).parent().prev().remove();
            $(`#${modalId} div.modal-body #refund-receipt-date`).parent().remove();
            $(`#${modalId} div.modal-body div.recurring-details h3`).html('Recurring Refund Receipt');
            $(`#${modalId} div.modal-body #sales-rep`).parent().removeClass('w-100').parent().removeClass('d-flex').removeClass('align-items-end');
            break;
        case 'delayed_credit':
            modalId = 'delayedCreditModal';
            $(templateFields).insertBefore($(`#${modalId} div.modal-body div.row.customer-details`));
            $(intervalFields).insertAfter($(`#${modalId} div.modal-body div.row.customer-details`));
            $(`#${modalId} div.modal-body div.row.customer-details`).children('div:last-child()').remove();
            $(`#${modalId} div.modal-body #delayed-credit-date`).parent().parent().parent().remove();
            $(`#${modalId} div.modal-body div.recurring-details h3`).html('Recurring Delayed Credit');
            break;
        case 'delayed_charge':
            modalId = 'delayedChargeModal';
            $(templateFields).insertBefore($(`#${modalId} div.modal-body div.row.customer-details`));
            $(intervalFields).insertAfter($(`#${modalId} div.modal-body div.row.customer-details`));
            $(`#${modalId} div.modal-body div.row.customer-details`).children('div:last-child()').remove();
            $(`#${modalId} div.modal-body #delayed-charge-date`).parent().parent().parent().remove();
            $(`#${modalId} div.modal-body div.recurring-details h3`).html('Recurring Delayed Charge');
            break;
        case 'invoice':
            modalId = 'invoiceModal';
            $(templateFields).insertBefore($(`#${modalId} div.modal-body div.row.customer-details`));
            $(intervalFields).insertAfter($(`#${modalId} div.modal-body div.row.customer-details`));
            $(`#${modalId} div.modal-body div.row.customer-details`).children('div:last-child()').remove();
            $(`#${modalId} div.modal-body div.row.date-row`).remove();
            $(`#${modalId} div.modal-body div.recurring-details h3`).html('Recurring Invoice');
            $(`#${modalId} div.modal-body #shipping-date`).parent().parent().html('');
            $(`#${modalId} div.modal-body #invoice-no`).parent().remove();
            break;
    }

    $(`#${modalId}`).parent().attr('onsubmit', 'submitModalForm(event, this)').removeAttr('data-href');
    $(`#${modalId} .transactions-container`).parent().remove();
    $(`#${modalId} .close-transactions-container`).parent().remove();

    $(`div#${modalId} div.modal-footer div.row.w-100 div:nth-child(2)`).html('');
    $(`div#${modalId} div.modal-footer div.row.w-100 div:last-child()`).html('<button class="nsm-button success float-end" id="save-template">Save template</button>');

    recurrInterval = $(`div#${modalId} div.modal-body div.recurring-interval-container`).html();
    recurringDays = $(`div#${modalId} div.modal-body select[name="recurring_day"]`).html();
    monthlyRecurrFields = $(`div#${modalId} div.modal-body div.recurring-interval-container div div.row div:nth-child(2) div`).html();

    $(`div#${modalId} input.date`).datepicker({
        format: 'mm/dd/yyyy',
        orientation: 'bottom',
        autoclose: true
    });

    $(`div#${modalId} select:not(.select2-hidden-accessible)`).each(function () {
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
                    url: base_url + 'accounting/get-dropdown-choices',
                    dataType: 'json',
                    data: function (params) {
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
                templateSelection: optionSelect,
                dropdownParent: $('#modal-container form .modal')
            });
        } else {
            $(this).select2({
                minimumResultsForSearch: -1,
                dropdownParent: $('#modal-container form .modal')
            });
        }
    });
}

const viewPrint = (id, title = "") => {
    var data = {};
    var flag = false;
    if (title === 'deposit-summary') {
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

        var customers = $('#statements-table tbody input.select-one:checked');

        customers.each(function () {
            data.customers.push($(this).val());
        });

        if (data.customers.length > 0) {
            flag = true;
        }
    }

    if (flag === true) {
        $.ajax({
            url: '/accounting/generate-pdf',
            data: { json: JSON.stringify(data) },
            type: 'post',
            success: function (res) {
                if ($('#modal-container #showPdfModal').length > 0) {
                    $('#modal-container #showPdfModal').parent().remove();
                }

                $('#modal-container').append(res);

                if (title === 'statement-summary') {
                    $('#showPdfModal #download-pdf').remove();
                }
                $('#showPdfModal').modal('show');
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

    $('#adjust-starting-value-modal .total-value').html('$' + parseFloat(totalValue).toFixed(2));
}

const computeTransactionTotal = () => {
    var total = 0.00;

    $('#modal-container table#category-details-table input[name="category_amount[]"]').each(function () {
        var value = $(this).val() === "" ? 0.00 : parseFloat($(this).val()).toFixed(2);

        total = parseFloat(parseFloat(total) + parseFloat(value)).toFixed(2);
    });

    $('#modal-container table#item-details-table tbody tr td span.row-total').each(function () {
        var value = $(this).html() === "" ? 0.00 : parseFloat($(this).html().replace('$', '').replaceAll(',', '')).toFixed(2);

        total = parseFloat(parseFloat(total) + parseFloat(value)).toFixed(2);
    });

    if ($('#modal-container form .modal').attr('id') === 'billModal') {
        if ($('#billModal #total-payment-amount').length > 0) {
            total = parseFloat(total) - parseFloat($('#billModal #total-payment-amount').html());
        }
    }

    $('#modal-container .transaction-total-amount').html(formatter.format(parseFloat(total)));
}

// const loadBills = () => {
//     $('#payBillsModal table#bills-table').DataTable({
//         autoWidth: false,
//         searching: false,
//         processing: true,
//         serverSide: true,
//         lengthChange: false,
//         info: false,
//         pageLength: $('#table_rows').val(),
//         order: [[3, 'asc']],
//         ajax: {
//             url: '/accounting/load-bills/',
//             dataType: 'json',
//             contentType: 'application/json',
//             type: 'POST',
//             data: function(d) {
//                 d.due_date = $(`${modalName} #due_date`).val();
//                 d.from_date = $(`${modalName} #from`).val();
//                 d.to_date = $(`${modalName} #to`).val();
//                 d.payee = $(`${modalName} #pay-bills-vendor`).val();
//                 d.overdue_only = $(`${modalName} #overdue_only`).prop('checked') ? "1" : "0";
//                 d.length = $(`${modalName} #table_rows`).val();
//                 return JSON.stringify(d);
//             },
//             pagingType: 'full_numbers'
//         },
//         columns: [
//             {
//                 data: null,
//                 name: 'checkbox',
//                 orderable: false,
//                 fnCreatedCell: function(td, cellData, rowData, row, col) {
//                     $(td).html(`
//                     <div class="d-flex align-items-center justify-content-center">
//                         <input type="checkbox" value="${rowData.id}">
//                     </div>
//                     `);
//                 }
//             },
//             {
//                 data: 'payee',
//                 name: 'payee',
//                 fnCreatedCell: function(td, cellData, rowData, row, col) {
//                     $(td).html(`${cellData} <input type="hidden" value="${rowData.payee_id}">`);
//                 }
//             },
//             {
//                 data: 'ref_no',
//                 name: 'ref_no'
//             },
//             {
//                 data: 'due_date',
//                 name: 'due_date'
//             },
//             {
//                 data: 'open_balance',
//                 name: 'open_balance',
//             },
//             {
//                 orderable: false,
//                 data: null,
//                 name: 'credit_applied',
//                 orderable: false,
//                 fnCreatedCell: function(td, cellData, rowData, row, col) {
//                     if(rowData.vendor_credits !== null && rowData.vendor_credits !== "" && rowData.vendor_credits !== "0.00") {
//                         var max = parseFloat(rowData.vendor_credits) > parseFloat(rowData.open_balance) ? rowData.open_balance : rowData.vendorCredits;

//                         $(td).html(`
//                         <div class="row">
//                             <div class="col-sm-9">
//                                 <input type="number" class="form-control text-right credit-applied" step=".01" max="${max}" onchange="convertToDecimal(this)">
//                             </div>
//                             <div class="col-sm-3 d-flex align-items-center">
//                                 <span class="available-credit">${rowData.vendor_credits}</span> &nbsp;available
//                             </div>
//                         </div>
//                         `);
//                     } else {
//                         $(td).addClass('text-right');
//                         $(td).html('Not available');
//                     }
//                 }
//             },
//             {
//                 orderable: false,
//                 data: null,
//                 name: 'payment',
//                 fnCreatedCell: function(td, cellData, rowData, row, col) {
//                     $(td).html('<input type="number" class="form-control text-right payment-amount" onchange="convertToDecimal(this)">');
//                 }
//             },
//             {
//                 orderable: false,
//                 data: null,
//                 name: 'total_amount',
//                 fnCreatedCell: function(td, cellData, rowData,row, col) {
//                     $(td).html(`$<span>0.00</span>`);
//                 }
//             }
//         ]
//     });
// }

const resetbillsfilter = () => {
    $('#payBillsModal #due_date').val('last-365-days').trigger('change');
    $('#payBillsModal #from').val('');
    $('#payBillsModal #to').val('');
    $('#payBillsModal #pay-bills-vendor').append('<option value="all">All</option>').trigger('change');
    $('#payBillsModal #overdue_only').prop('checked', false);
    applybillsfilter();
}

const applybillsfilter = () => {
    var data = new FormData();
    data.set('due_date', $('#payBillsModal #due_date').val());
    data.set('from', $('#payBillsModal #from').val());
    data.set('to', $('#payBillsModal #to').val());
    data.set('vendor', $('#payBillsModal #pay-bills-vendor').val());
    data.set('overdue', $('#payBillsModal #overdue_only').prop('checked'));

    $.ajax({
        url: '/accounting/get-payable-bills',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function (result) {
            var bills = JSON.parse(result);

            if (bills.length < 1) {
                $('#payBillsModal #bills-table tbody').html(`<tr>
                    <td colspan="8">
                        <div class="nsm-empty">
                            <span>No results found.</span>
                        </div>
                    </td>
                </tr>`);
            } else {
                $('#payBillsModal #bills-table tbody').html('');
                $.each(bills, function (key, bill) {
                    var creditApplied = '';
                    var noCredit = ['', '0.00', null];
                    if (noCredit.includes(bill.vendor_credits)) {
                        creditApplied = '<span class="float-end">Not available</span>';
                    } else {
                        var max = parseFloat(bill.vendor_credits) > parseFloat(bill.open_balance) ? bill.open_balance : bill.vendor_credits;
                        creditApplied = `<div class="row">
                            <div class="col-12 col-md-9">
                                <input type="number" class="form-control nsm-field text-end credit-applied" step=".01" max="${max}" onchange="convertToDecimal(this)">
                            </div>
                            <div class="col-12 col-md-3 d-md-flex align-items-center">
                                <span class="available-credit">${bill.vendor_credits}</span> &nbsp;available
                            </div>
                        </div>`;
                    }

                    $('#payBillsModal #bills-table tbody').append(`<tr data-vcredits="${bill.vendor_credits}" data-payeeid="${bill.payee_id}">
                    <td>
                        <div class="table-row-icon table-checkbox">
                            <input class="form-check-input select-one table-select" type="checkbox" value="${bill.id}">
                        </div>
                    </td>
                    <td>${bill.payee}</td>
                    <td>${bill.ref_no}</td>
                    <td>${bill.due_date}</td>
                    <td>${bill.open_balance}</td>
                    <td>${creditApplied}</td>
                    <td><input type="number" class="form-control nsm-field text-end payment-amount" onchange="convertToDecimal(this)"></td>
                    <td><span>$0.00</span></td>
                    </tr>`);
                });
            }

            $('#payBillsModal #bills-table').nsmPagination({
                itemsPerPage: parseInt($('#payBillsModal #bills-table-rows li a.dropdown-item.active').html().trim())
            })

            $('#payBillsModal #bills-table thead input.select-all').prop('checked', false);
        }
    });
}

const computeBillsPaymentTotal = () => {
    var total = 0.00;
    $('#payBillsModal #bills-table tbody tr').each(function () {
        if ($(this).find('input.select-one').prop('checked')) {
            total += parseFloat($(this).find('.payment-amount').val());
        }
    });

    $('#payBillsModal span.transaction-total-amount').html(formatter.format(parseFloat(total)));
}

const updateTransaction = (event, el) => {
    event.preventDefault();

    var data = new FormData(document.getElementById($(el).attr('id')));
    data.set('save_method', submitType);
    var modalId = '#' + $(el).children().attr('id');

    switch (modalId) {
        case '#weeklyTimesheetModal':
            $('#weeklyTimesheetModal #timesheet-table tbody tr').each(function () {
                var customer = $(this).find('select[name="customer[]"]').val();
                if (customer !== "" && customer !== null) {
                    var hours = {
                        'sunday': $('#weeklyTimesheetModal #show_sunday').prop('checked') ? $(this).find('[name="sunday_hours[]"]').val() : null,
                        'monday': $('#weeklyTimesheetModal #show_monday').prop('checked') ? $(this).find('[name="monday_hours[]"]').val() : null,
                        'tuesday': $('#weeklyTimesheetModal #show_tuesday').prop('checked') ? $(this).find('[name="tuesday_hours[]"]').val() : null,
                        'wednesday': $('#weeklyTimesheetModal #show_wednesday').prop('checked') ? $(this).find('[name="wednesday_hours[]"]').val() : null,
                        'thursday': $('#weeklyTimesheetModal #show_thursday').prop('checked') ? $(this).find('[name="thursday_hours[]"]').val() : null,
                        'friday': $('#weeklyTimesheetModal #show_friday').prop('checked') ? $(this).find('[name="friday_hours[]"]').val() : null,
                        'saturday': $('#weeklyTimesheetModal #show_saturday').prop('checked') ? $(this).find('[name="saturday_hours[]"]').val() : null,
                    };

                    if (data.has('hours[]')) {
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
        case '#payBillsModal':
            var totalAmount = $(`${modalId} span.transaction-total-amount`).html().replace('$', '');
            data.append('total', totalAmount);

            $(`${modalId} #bills-table tbody tr`).each(function () {
                var checkbox = $(this).find('td:first-child input');
                var payee = $(this).find('td:nth-child(2) input').val();
                var credit_applied = $(this).find('input.credit-applied').length > 0 ? $(this).find('input.credit-applied').val() : 0.00;
                var payment_amount = $(this).find('input.payment-amount').val();
                var total_amount = parseFloat(parseFloat(credit_applied) + parseFloat(payment_amount)).toFixed(2);

                if (checkbox.prop('checked')) {
                    if (data.has('bills[]') === false) {
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
        case '#billPaymentModal':
            data.delete('bills[]');
            data.delete('credits[]');

            $(`${modalId} #bills-table tbody tr`).each(function () {
                if ($(this).find('input[type="checkbox"]').prop('checked')) {
                    if (data.has('bills[]') === false) {
                        data.set('bills[]', $(this).find('input[type="checkbox"]').val());
                        data.set('bill_payment[]', $(this).find('input[name="bill_payment[]"]').val());
                    } else {
                        data.append('bills[]', $(this).find('input[type="checkbox"]').val());
                        data.append('bill_payment[]', $(this).find('input[name="bill_payment[]"]').val());
                    }
                }
            });

            $(`${modalId} #vendor-credits-table tbody tr`).each(function () {
                if ($(this).find('input[type="checkbox"]').prop('checked')) {
                    if (data.has('credits[]') === false) {
                        data.set('credits[]', $(this).find('input[type="checkbox"]').val());
                        data.set('credit_type[]', $(this).data().type);
                        data.set('credit_payment[]', $(this).find('input[name="credit_payment[]"]').val());
                    } else {
                        data.append('credits[]', $(this).find('input[type="checkbox"]').val());
                        data.append('credit_type[]', $(this).data().type);
                        data.append('credit_payment[]', $(this).find('input[name="credit_payment[]"]').val());
                    }
                }
            });

            data.set('fixed_total', $(`${modalId} input[name="payment_amount"]`).attr('data-fixed') !== undefined ? 1 : 0);
            data.set('amount_to_apply', $(`${modalId} span.amount-to-apply`).html().replace('$', '').replaceAll(',', '').trim());
            data.set('amount_to_credit', $(`${modalId} span.amount-to-credit`).html().replace('$', '').replaceAll(',', '').trim());
            break;
        case '#journalEntryModal':
            data.delete('names[]');

            $('#journalEntryModal #journal-table tbody tr select[name="names[]"]').each(function () {
                if (data.has('names[]') === false) {
                    data.set('names[]', $(this).val() === null ? '' : $(this).val());
                } else {
                    data.append('names[]', $(this).val() === null ? '' : $(this).val());
                }
            });
            break;
        case '#depositModal':
            data.delete('received_from[]');
            data.delete('payment_method[]');

            $('#depositModal #bank-deposit-table tbody tr select[name="received_from[]"]').each(function () {
                if (data.has('received_from[]') === false) {
                    data.set('received_from[]', $(this).val() === null ? '' : $(this).val());
                } else {
                    data.append('received_from[]', $(this).val() === null ? '' : $(this).val());
                }
            });

            $('#depositModal #bank-deposit-table tbody tr select[name="payment_method[]"]').each(function () {
                if (data.has('payment_method[]') === false) {
                    data.set('payment_method[]', $(this).val() === null ? '' : $(this).val());
                } else {
                    data.append('payment_method[]', $(this).val() === null ? '' : $(this).val());
                }
            });
            break;
        case '#payrollModal':
            data = payrollFormData;
            break;
        case '#commission-payroll-modal':
            data = payrollFormData;
            break;
        case '#bonus-payroll-modal':
            data = payrollFormData;
            break;
        case '#receivePaymentModal':
            data.delete('payment[]');
            data.delete('credit_payment[]');

            data.set('amount_to_credit', $('#receivePaymentModal span.amount-to-credit').html().replace('$', ''));
            data.set('amount_to_apply', $('#receivePaymentModal span.amount-to-apply').html().replace('$', ''));

            $('#receivePaymentModal #invoices-table tbody tr input[type="checkbox"]:checked').each(function () {
                if (data.has('invoice[]') === false) {
                    data.set('invoice[]', $(this).val());
                    data.set('payment[]', $(this).parent().parent().parent().parent().find('input[name="payment[]"]').val());
                } else {
                    data.append('invoice[]', $(this).val());
                    data.append('payment[]', $(this).parent().parent().parent().parent().find('input[name="payment[]"]').val());
                }
            });

            $('#receivePaymentModal #credits-table tbody tr input[type="checkbox"]:checked').each(function () {
                if (data.has('credits[]') === false) {
                    data.set('credits[]', $(this).val());
                    data.set('credit_payment[]', $(this).parent().parent().parent().parent().find('input[name="credit_payment[]"]').val());
                } else {
                    data.append('credits[]', $(this).val());
                    data.append('credit_payment[]', $(this).parent().parent().parent().parent().find('input[name="credit_payment[]"]').val());
                }
            });
            break;
        case '#invoiceModal':
            data.set('invoice_no', $('#invoiceModal #invoice-no').val());
            break;
    }

    if (customerModals.includes(modalId)) {
        if (modalId !== '#options-estimate-modal' && modalId !== '#bundle-estimate-modal') {
            data.delete('item[]');
            data.delete('package[]');
            data.delete('location[]');
            data.delete('quantity[]');
            data.delete('item_amount[]');
            data.delete('discount[]');
            data.delete('item_tax[]');
            data.delete('item_linked_transaction[]');
            data.delete('transaction_item_id[]');
            $(`${modalId} table#item-table tbody:not(#package-items-table) tr:not(.package-items, .package-item, .package-item-header)`).each(function () {
                if (data.has('item_total[]')) {
                    if ($(this).hasClass('package')) {
                        data.append('item[]', 'package-' + $(this).find('input[name="package[]"]').val());
                        data.append('location[]', null);
                        data.append('item_amount[]', $(this).find('span.item-amount').html());
                        data.append('discount[]', null);
                    } else {
                        data.append('item[]', 'item-' + $(this).find('input[name="item[]"]').val());
                        data.append('location[]', $(this).find('select[name="location[]"]').val());
                        data.append('item_amount[]', $(this).find('input[name="item_amount[]"]').val());
                        data.append('discount[]', $(this).find('input[name="discount[]"]').val());
                    }
                    data.append('item_tax[]', $(this).find('input[name="item_tax[]"]').val());
                    data.append('quantity[]', $(this).find('input[name="quantity[]"]').val());
                    // data.append('item_total[]', $(this).find('span.row-total').html().replace('$', ''));
                    var rowTotalElement = $(this).find('span.row-total');
                    if (rowTotalElement.length > 0) {
                        // Element found, extract its HTML content and replace '$' if necessary
                        var rowTotalHtml = rowTotalElement.html();
                        var rowTotalValue = rowTotalHtml.replace('$', '');

                        // Append the extracted value to the FormData object
                        data.append('item_total[]', rowTotalValue);
                    }
                    data.append('item_linked[]', $(this).find('input[name="item_linked_transaction[]"]').length > 0 ? $(this).find('input[name="item_linked_transaction[]"]').val() : '');
                    data.append('transac_item_id[]', $(this).find('input[name="transaction_item_id[]"]').length > 0 ? $(this).find('input[name="transaction_item_id[]"]').val() : '');
                } else {
                    if ($(this).hasClass('package')) {
                        data.set('item[]', 'package-' + $(this).find('input[name="package[]"]').val());
                        data.set('location[]', null);
                        data.set('item_amount[]', $(this).find('span.item-amount').html());
                        data.set('discount[]', null);
                    } else {
                        data.set('item[]', 'item-' + $(this).find('input[name="item[]"]').val());
                        data.set('location[]', $(this).find('select[name="location[]"]').val());
                        data.set('item_amount[]', $(this).find('input[name="item_amount[]"]').val());
                        data.set('discount[]', $(this).find('input[name="discount[]"]').val());
                    }
                    data.set('item_tax[]', $(this).find('input[name="item_tax[]"]').val());
                    data.set('quantity[]', $(this).find('input[name="quantity[]"]').val());
                    data.set('item_total[]', $(this).find('span.row-total').html().replace('$', ''));
                    data.set('item_linked[]', $(this).find('input[name="item_linked_transaction[]"]').length > 0 ? $(this).find('input[name="item_linked_transaction[]"]').val() : '');
                    data.set('transac_item_id[]', $(this).find('input[name="transaction_item_id[]"]').length > 0 ? $(this).find('input[name="transaction_item_id[]"]').val() : '');
                }
            });

            data.set('total_amount', $(`${modalId} .transaction-grand-total:first-child`).html().replace('$', '').trim());
            data.set('subtotal', $(`${modalId} .transaction-subtotal:first-child`).html().replace('$', '').trim());
            data.set('tax_total', $(`${modalId} .transaction-taxes:first-child`).html().replace('$', '').trim());
            data.set('discount_total', $(`${modalId} .transaction-discounts:first-child`).html().replace('$', '').trim());
        } else {
            data.delete('item[]');
            data.delete('package[]');
            data.delete('location[]');
            data.delete('quantity[]');
            data.delete('item_amount[]');
            data.delete('discount[]');
            data.delete('item_tax[]');
            data.delete('item_linked_transaction[]');
            data.delete('transaction_item_id[]');

            if (modalId === '#options-estimate-modal') {
                var table1 = $('#options-estimate-modal #option-1-item-table');
                var table2 = $('#options-estimate-modal #option-2-item-table');
            } else {
                var table1 = $('#bundle-estimate-modal #bundle-1-item-table');
                var table2 = $('#bundle-estimate-modal #bundle-2-item-table');
            }

            table1.children('tbody:not(#package-items-table)').children('tr:not(.package-items, .package-item, .package-item-header)').each(function () {
                if (data.has('table_1_item_total[]')) {
                    data.append('table_1_item[]', $(this).find('input[name="item[]"]').val());
                    data.append('table_1_location[]', $(this).find('select[name="location[]"]').val());
                    data.append('table_1_item_amount[]', $(this).find('input[name="item_amount[]"]').val());
                    data.append('table_1_discount[]', $(this).find('input[name="discount[]"]').val());
                    data.append('table_1_item_tax[]', $(this).find('input[name="item_tax[]"]').val());
                    data.append('table_1_quantity[]', $(this).find('input[name="quantity[]"]').val());
                    data.append('table_1_item_total[]', $(this).find('span.row-total').html().replace('$', ''));
                } else {
                    data.set('table_1_item[]', $(this).find('input[name="item[]"]').val());
                    data.set('table_1_location[]', $(this).find('select[name="location[]"]').val());
                    data.set('table_1_item_amount[]', $(this).find('input[name="item_amount[]"]').val());
                    data.set('table_1_discount[]', $(this).find('input[name="discount[]"]').val());
                    data.set('table_1_item_tax[]', $(this).find('input[name="item_tax[]"]').val());
                    data.set('table_1_quantity[]', $(this).find('input[name="quantity[]"]').val());
                    data.set('table_1_item_total[]', $(this).find('span.row-total').html().replace('$', ''));
                }
            });

            var t1subtotal = table1.closest('.accordion-body').find(`table:not(#${table1.attr('id')})`).find('.table-subtotal').html().replace('$', '');
            var t1taxes = table1.closest('.accordion-body').find(`table:not(#${table1.attr('id')})`).find('.table-taxes').html().replace('$', '');
            data.set('table_1_subtotal', t1subtotal);
            data.set('table_1_taxes', t1taxes);

            if (modalId === '#bundle-estimate-modal') {
                var t1adjustmentVal = table1.closest('.accordion-body').find(`table:not(#${table1.attr('id')})`).find('input[name="adjustment_value"]').val();
                var t1adjustmentName = table1.closest('.accordion-body').find(`table:not(#${table1.attr('id')})`).find('input[name="adjustment_name"]').val();
                data.set('table_1_adjustment_name', t1adjustmentName);
                data.set('table_1_adjustment', t1adjustmentVal);
            }
            var t1total = table1.closest('.accordion-body').find(`table:not(#${table1.attr('id')})`).find('.table-total').html().replace('$', '');
            data.set('table_1_total', t1total);

            table2.children('tbody:not(#package-items-table)').children('tr:not(.package-items, .package-item, .package-item-header)').each(function () {
                if (data.has('table_2_item_total[]')) {
                    data.append('table_2_item[]', $(this).find('input[name="item[]"]').val());
                    data.append('table_2_location[]', $(this).find('select[name="location[]"]').val());
                    data.append('table_2_item_amount[]', $(this).find('input[name="item_amount[]"]').val());
                    data.append('table_2_discount[]', $(this).find('input[name="discount[]"]').val());
                    data.append('table_2_item_tax[]', $(this).find('input[name="item_tax[]"]').val());
                    data.append('table_2_quantity[]', $(this).find('input[name="quantity[]"]').val());
                    data.append('table_2_item_total[]', $(this).find('span.row-total').html().replace('$', ''));
                } else {
                    data.set('table_2_item[]', $(this).find('input[name="item[]"]').val());
                    data.set('table_2_location[]', $(this).find('select[name="location[]"]').val());
                    data.set('table_2_item_amount[]', $(this).find('input[name="item_amount[]"]').val());
                    data.set('table_2_discount[]', $(this).find('input[name="discount[]"]').val());
                    data.set('table_2_item_tax[]', $(this).find('input[name="item_tax[]"]').val());
                    data.set('table_2_quantity[]', $(this).find('input[name="quantity[]"]').val());
                    data.set('table_2_item_total[]', $(this).find('span.row-total').html().replace('$', ''));
                }
            });

            var t2subtotal = table2.closest('.accordion-body').find(`table:not(#${table2.attr('id')})`).find('.table-subtotal').html().replace('$', '');
            var t2taxes = table2.closest('.accordion-body').find(`table:not(#${table2.attr('id')})`).find('.table-taxes').html().replace('$', '');
            data.set('table_2_subtotal', t2subtotal);
            data.set('table_2_taxes', t2taxes);

            if (modalId === '#bundle-estimate-modal') {
                var t2adjustmentVal = table2.closest('.accordion-body').find(`table:not(#${table2.attr('id')})`).find('input[name="adjustment_value"]').val();
                data.set('table_2_adjustment', t2adjustmentVal);
            }
            var t2total = table2.closest('.accordion-body').find(`table:not(#${table2.attr('id')})`).find('.table-total').html().replace('$', '');
            data.set('table_2_total', t2total);
        }
    }

    if (vendorModals.includes(modalId)) {
        var count = 0;
        var totalAmount = $(`${modalId} span.transaction-total-amount`).html().replace('$', '');
        data.append('total_amount', totalAmount.trim());

        $(`${modalId} table#category-details-table tbody tr`).each(function () {
            var billable = $(this).find('input[name="category_billable[]"]');
            var tax = $(this).find('input[name="category_tax[]"]');

            if (billable.length > 0 && tax.length > 0) {
                if (count === 0) {
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
        $(`${modalId} table#item-details-table tbody tr`).each(function () {
            if (count === 0) {
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
        success: function (result) {
            var res = JSON.parse(result);

            toast(res.success, res.message);

            if (res.success === true) {
                if (submitType === 'save-and-close' || submitType === 'save-and-void') {
                    $(el).children().modal('hide');
                }

                if (submitType === 'save-and-send' && modalId === '#purchaseOrderModal') {
                    sendPurchaseOrder(res.data);
                }

                if (submitType === 'save-and-print') {
                    switch (modalId) {
                        case '#purchaseOrderModal':
                            printPurchaseOrder();
                            break;
                        case '#weeklyTimesheetModal':
                            printTimesheet(res.data);
                            break;
                        case '#receivePaymentModal':

                            break;
                        case '#invoiceModal':
                            printPreviewInvoice();
                            break;
                        case '#creditMemoModal':
                            printPreviewCreditMemo();
                            break;
                        case '#salesReceiptModal':
                            printPreviewSalesReceipt();
                            break;
                        case '#refundReceiptModal':
                            printPreviewRefundReceipt();
                            break;
                    }
                }

                if (submitType === 'save-and-new') {
                    clearForm();
                }
            }

            submitType = '';
            // $('#transactions-table').DataTable().ajax.reload(null, true);
        }
    });
}

const unlinkTransaction = () => {
    if ($('#modal-container .modal#billPaymentModal').length === 0) {
        if ($('#modal-container .modal a#linked-transaction').length > 0) {
            $('#modal-container .modal a#linked-transaction').parent().parent().remove();
            $('#modal-container .modal #category-details-table thead tr th:last-child').remove();
            $('#modal-container .modal #item-details-table thead tr th:last-child').remove();

            var count = 1;
            $('#modal-container .modal #category-details-table tbody tr').each(function (index, value) {
                if ($(this).find('i.fa.fa-link').length > 0) {
                    $(this).remove();
                } else {
                    $(this).find('td:nth-child(2)').html(count);
                    $(this).find('td:nth-child(11)').remove();
                    count++;
                }
            });

            if ($('#modal-container .modal #category-details-table tbody tr').length < rowCount) {
                do {
                    $('#modal-container .modal #category-details-table tbody').append(`<tr>${catDetailsBlank}</tr>`);
                    $('#modal-container .modal #category-details-table tbody tr:last-child td:nth-child(2)').html(count);
                    count++;
                } while ($('#modal-container .modal #category-details-table tbody tr').length < rowCount)
            }

            $('#modal-container .modal #item-details-table tbody tr').each(function () {
                if ($(this).find('i.fa.fa-link').length > 0) {
                    $(this).remove();
                }
            });

            computeTransactionTotal();
        }
    } else if ($('#modal-container #invoiceModal').length > 0) {

    } else {
        if ($('#billPaymentModal #bills-table tbody tr').length > 0) {
            // $('#billPaymentModal input[name="bills[]"]').remove();
            // $('#billPaymentModal input[name="credits[]"]').remove();
            $('#billPaymentModal #search-bill-no').val('');
            $('#billPaymentModal #search-vcredit-no').val('');
            $('#billPaymentModal #bills-from').val('').attr('data-applied', '');
            $('#billPaymentModal #bills-to').val('').attr('data-applied', '');
            $('#billPaymentModal #overdue-bills-only').prop('checked', false).attr('data-applied', 'false');
            $('#billPaymentModal #vcredit-from').val('').attr('data-applied', '');
            $('#billPaymentModal #vcredit-to').val('').attr('data-applied', '');
            $('#billPaymentModal [name="payment_amount"]').val('').removeAttr('data-fixed');
            $('#billPaymentModal #bills-table tbody').html('');
            $('#billPaymentModal #vendor-credits-table tbody').html('');
            $('#billPaymentModal #bills-table .select-all').prop('checked', false);
            $('#billPaymentModal #vendor-credits-table .select-all').closest('td').html('');
            $('#billPaymentModal .payment-total-amount').html('$0.00');
            $('#billPaymentModal .amount-to-apply').html('$0.00');
            $('#billPaymentModal .amount-to-credit').html('$0.00');
        }
    }
}

const initModalFields = (modalName, data = {}) => {
    if (!$.isEmptyObject(data)) {
        var transactionType = data.type;
        transactionType = transactionType.replaceAll(' (Check)', '');
        transactionType = transactionType.replaceAll(' (Credit Card)', '');
        transactionType = transactionType.replaceAll(' ', '-');
        transactionType = transactionType.toLowerCase();
    }

    if ($(`#${modalName} table#category-details-table`).length > 0) {
        rowCount = 2;
        catDetailsInputs = $(`#${modalName} table#category-details-table tbody tr:first-child()`).html();
        catDetailsBlank = $(`#${modalName} table#category-details-table tbody tr:last-child`).html();

        $(`#${modalName} table#category-details-table tbody tr:first-child()`).remove();
        $(`#${modalName} table#category-details-table tbody tr:last-child()`).remove();
    } else {
        if ($('div#modal-container .modal-body table.clickable:not(#category-details-table, #item-details-table)').length > 0) {
            rowInputs = $(`div#modal-container form #${modalName} table tbody tr:first-child()`).html();
            blankRow = $(`div#modal-container form #${modalName} table tbody tr:last-child()`).html();

            switch (modalName) {
                case 'depositModal':
                    rowCount = 2;
                    break;
                case 'journalEntryModal':
                    rowCount = 8;
                    break;
                case 'inventoryModal':
                    rowCount = 2;
                    break;
                case 'weeklyTimesheetModal':
                    rowCount = 3;
                    break;
            }

            $('div#modal-container form .modal table tbody tr:first-child()').remove();
            $('div#modal-container form .modal table tbody tr:last-child()').remove();
        }
    }

    if ($(`#${modalName} select`).length > 0) {
        $(`#${modalName} select`).each(function () {
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
                        url: base_url + 'accounting/get-dropdown-choices',
                        dataType: 'json',
                        data: function (params) {
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
                    templateSelection: optionSelect,
                    dropdownParent: $('#modal-container form .modal')
                });
            } else {
                $(this).select2({
                    minimumResultsForSearch: -1,
                    dropdownParent: $('#modal-container form .modal')
                });
            }
        });
    }

    if ($(`div#${modalName} select#tags`).length > 0) {
        $(`div#${modalName} select#tags`).select2({
            placeholder: 'Start typing to add a tag',
            allowClear: true,
            dropdownParent: $('#modal-container form .modal'),
            ajax: {
                url: base_url + 'accounting/get-job-tags',
                dataType: 'json'
            }
        });
    }

    if ($(`div#${modalName} .date`).length > 0) {
        $(`div#${modalName} .date`).each(function () {
            $(this).datepicker({
                format: 'mm/dd/yyyy',
                orientation: 'bottom',
                autoclose: true
            });
        });
    }

    if ($(`#${modalName} .attachments`).length > 0) {
        var attachmentContId = $(`#${modalName} .attachments .dropzone`).attr('id');
        modalAttachments = new Dropzone(`#${attachmentContId}`, {
            url: '/accounting/attachments/attach',
            maxFilesize: 20,
            uploadMultiple: true,
            // maxFiles: 1,
            addRemoveLinks: true,
            init: function () {
                if (!$.isEmptyObject(data)) {
                    $.getJSON(base_url + 'accounting/get-linked-attachments/' + transactionType + '/' + data.id, function (attachments) {
                        if (attachments.length > 0) {
                            $.each(attachments, function (index, val) {
                                $(`#${modalName}`).find('.attachments').parent().append(`<input type="hidden" name="attachments[]" value="${val.id}">`);

                                modalAttachmentId.push(val.id);
                                var mockFile = {
                                    name: `${val.uploaded_name}.${val.file_extension}`,
                                    size: parseInt(val.size),
                                    dataURL: base_url + "uploads/accounting/attachments/" + val.stored_name,
                                    accepted: true
                                };
                                modalAttachments.emit("addedfile", mockFile);
                                modalAttachedFiles.push(mockFile);

                                modalAttachments.createThumbnailFromUrl(mockFile, modalAttachments.options.thumbnailWidth, modalAttachments.options.thumbnailHeight, modalAttachments.options.thumbnailMethod, true, function (thumbnail) {
                                    modalAttachments.emit('thumbnail', mockFile, thumbnail);
                                });
                                modalAttachments.emit("complete", mockFile);
                            });
                        }
                    });
                }

                this.on("success", function (file, response) {
                    var ids = JSON.parse(response)['attachment_ids'];
                    var modal = $(`#${modalName}`);

                    for (i in ids) {
                        if (modal.find(`input[name="attachments[]"][value="${ids[i]}"]`).length === 0) {
                            modal.find('.attachments').parent().append(`<input type="hidden" name="attachments[]" value="${ids[i]}">`);
                        }

                        modalAttachmentId.push(ids[i]);
                    }
                    modalAttachedFiles.push(file);
                });
            },
            removedfile: function (file) {
                var ids = modalAttachmentId;
                var index = modalAttachedFiles.map(function (d, index) {
                    if (d == file) return index;
                }).filter(isFinite)[0];

                $(`#${modalName} .attachments`).parent().find(`input[name="attachments[]"][value="${ids[index]}"]`).remove();

                //remove thumbnail
                var previewElement;

                if ((previewElement = file.previewElement) !== null) {
                    var remove = (previewElement.parentNode.removeChild(file.previewElement));

                    if ($(`#${attachmentContId} .dz-preview`).length > 0) {
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

// const loadBillPaymentBills = () => {
//     $('#billPaymentModal table#bills-table').DataTable({
//         autoWidth: false,
//         searching: false,
//         processing: true,
//         serverSide: true,
//         lengthChange: false,
//         info: false,
//         pageLength: $('#billPaymentModal #bills_table_rows').val(),
//         ordering: false,
//         ajax: {
//             url: '/accounting/load-bill-payment-bills/',
//             dataType: 'json',
//             contentType: 'application/json',
//             type: 'POST',
//             data: function(d) {
//                 d.search = $('#billPaymentModal #search-bill-no').val();
//                 d.from = $('#billPaymentModal #bills-from').val();
//                 d.to = $('#billPaymentModal #bills-to').val();
//                 d.overdue = $('#billPaymentModal #overdue_bills_only').prop('checked');
//                 d.length = parseInt($('#billPaymentModal #bills_table_rows').val());
//                 d.vendor = $('#billPaymentModal #payee').val();

//                 return JSON.stringify(d);
//             },
//             pagingType: 'full_numbers'
//         },
//         columns: [
//             {
//                 data: 'id',
//                 name: 'id',
//                 orderable: false,
//                 fnCreatedCell: function(td, cellData, rowData, row, col) {
//                     $(td).html(`
//                     <div class="d-flex align-items-center justify-content-center">
//                         <input type="checkbox" value="${cellData}">
//                     </div>
//                     `);

//                     if($(`#billPaymentModal input[name="bills[]"][value="${cellData}"]`).length > 0) {
//                         $(td).children().children('input').prop('checked', true);
//                     }
//                 }
//             },
//             {
//                 data: 'description',
//                 name: 'description'
//             },
//             {
//                 data: 'due_date',
//                 name: 'due_date'
//             },
//             {
//                 data: 'original_amount',
//                 name: 'original_amount'
//             },
//             {
//                 data: 'open_balance',
//                 name: 'open_balance'
//             },
//             {
//                 data: 'payment',
//                 name: 'payment',
//                 fnCreatedCell: function(td, cellData, rowData, row, col) {
//                     $(td).html(`<input type="number" name="bill_payment[]" class="form-control text-right" onchange="convertToDecimal(this)" step="0.01">`);

//                     if($(`#billPaymentModal input[name="bills[]"][value="${rowData.id}"]`).length > 0) {
//                         $(td).children('input').val(cellData);
//                     }
//                 }
//             }
//         ]
//     });
// }

// const loadBillPaymentCredits = () => {
//     $('#billPaymentModal table#vendor-credits-table').DataTable({
//         autoWidth: false,
//         searching: false,
//         processing: true,
//         serverSide: true,
//         lengthChange: false,
//         info: false,
//         pageLength: $('#billPaymentModal #vcredits_table_rows').val(),
//         ordering: false,
//         ajax: {
//             url: '/accounting/load-bill-payment-credits/',
//             dataType: 'json',
//             contentType: 'application/json',
//             type: 'POST',
//             data: function(d) {
//                 d.search = $('#billPaymentModal #search-vcredit-no').val();
//                 d.from = $('#billPaymentModal #vcredit-from').val();
//                 d.to = $('#billPaymentModal #vcredit-to').val();
//                 d.length = parseInt($('#billPaymentModal #vcredits_table_rows').val());
//                 d.vendor = $('#billPaymentModal #payee').val();

//                 return JSON.stringify(d);
//             },
//             pagingType: 'full_numbers'
//         },
//         columns: [
//             {
//                 data: 'id',
//                 name: 'id',
//                 orderable: false,
//                 fnCreatedCell: function(td, cellData, rowData, row, col) {
//                     $(td).html(`
//                     <div class="d-flex align-items-center justify-content-center">
//                         <input type="checkbox" value="${cellData}">
//                     </div>
//                     `);

//                     if($(`#billPaymentModal input[name="credits[]"][value="${cellData}"]`).length > 0) {
//                         $(td).children().children('input').prop('checked', true);
//                     }
//                 }
//             },
//             {
//                 data: 'description',
//                 name: 'description'
//             },
//             {
//                 data: 'original_amount',
//                 name: 'original_amount'
//             },
//             {
//                 data: 'open_balance',
//                 name: 'open_balance'
//             },
//             {
//                 data: 'payment',
//                 name: 'payment',
//                 fnCreatedCell: function(td, cellData, rowData, row, col) {
//                     $(td).html(`<input type="number" name="credit_payment[]" class="form-control text-right" onchange="convertToDecimal(this)" max="${rowData.open_balance}" step="0.01">`);

//                     if($(`#billPaymentModal input[name="credits[]"][value="${rowData.id}"]`).length > 0) {
//                         $(td).children('input').val(cellData);
//                     }
//                 }
//             }
//         ]
//     });
// }

const savePayBills = (e) => {
    e.preventDefault();

    submitType = 'save';
    $('#modal-container form').submit();

    applybillsfilter();
    $('#payBillsModal .transaction-total-amount').html('$0.00');
}

const savePrintPayBills = (e) => {
    e.preventDefault();

    $('#payBillsModal #print_later').prop('checked', true).trigger('change');
    $('#modal-container form').submit();
    var paymentAcc = $('#payBillsModal #payment_account').val();
    $('#payBillsModal').modal('hide');

    $('#new-popup #accounting_vendors a[data-target="#printChecksModal"]').trigger('click');
    $('#printChecksModal #payment_account').val(paymentAcc).trigger('change');
}

const saveClosePayBills = (e) => {
    e.preventDefault();

    $('#modal-container form').submit();

    $('#modal-container .modal').modal('hide');
}

const formatResult = (optionElement) => {
    var searchField = $('.select2-search__field');
    var text = optionElement.text;
    var searchVal = $(searchField[searchField.length - 1]).val();
    if (searchVal === "") {
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
    if ($('#account-modal #choose_time').val() === 'other' && $(el).val() !== '') {
        $('#account-modal #balance').parent().removeClass('hide');
    } else {
        $('#account-modal #balance').parent().addClass('hide');
    }
}

const initAccountModal = () => {
    $('#modal-container #account-modal select').each(function () {
        var id = $(this).attr('id').replaceAll('_', '-');
        switch (id) {
            case 'account-type':
                $(this).select2({
                    ajax: {
                        url: base_url + 'accounting/get-dropdown-choices',
                        dataType: 'json',
                        data: function (params) {
                            var query = {
                                search: params.term,
                                type: 'public',
                                field: id
                            }

                            if (dropdownEl !== null) {
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
                        url: base_url + 'accounting/get-dropdown-choices',
                        dataType: 'json',
                        data: function (params) {
                            var query = {
                                search: params.term,
                                type: 'public',
                                field: id,
                                accType: $('#account-modal #account_type').val()
                            }

                            if (dropdownEl !== null) {
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
                        url: base_url + 'accounting/get-dropdown-choices',
                        dataType: 'json',
                        data: function (params) {
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
                $(this).select2({
                    minimumResultsForSearch: -1,
                    dropdownParent: $('#modal-container #account-modal')
                });
                break;
        }
    });
    var switchEl = $('#modal-container #account-modal #check_sub')[0];
    var switchery = new Switchery(switchEl, { size: 'small' });

    $('#modal-container #account-modal .date').datepicker({
        format: 'mm/dd/yyyy',
        orientation: 'bottom',
        autoclose: true
    });

    if (dropdownEl !== null) {
        $('#modal-container #account-modal form').attr('id', 'ajax-add-account');
        $('#modal-container #account-modal form').removeAttr('action');
        $('#modal-container #account-modal form').removeAttr('method');
        $('#modal-container #account-modal form').removeAttr('novalidate');
        $('#modal-container #account-modal').attr('data-bs-backdrop', 'static');
        $('#modal-container #account-modal').attr('data-bs-keyboard', 'false');
    }
    $('#modal-container #account-modal').modal('show');
}

const changeItemType = (type) => {
    var action = $(`#${type}-item-form`).attr('action');
    var formId = $(`#${type}-item-form`).attr('id');
    form = new FormData(document.getElementById(`${type}-item-form`));
    $(`#${type}-form-modal`).modal('hide');
    $('#type-selection-modal').modal('show');
    $('#type-selection-modal table tbody tr:last-child').hide();

    $(document).on('show.bs.modal', '#inventory-form-modal, #non-inventory-form-modal, #service-form-modal', function () {
        var modalId = $(this).attr('id');
        switch (modalId) {
            case 'inventory-form-modal':
                action = action.replace('/' + type, '/inventory');
                type = 'inventory';
                break;
            case 'non-inventory-form-modal':
                action = action.replace('/' + type, '/non-inventory');
                type = 'non-inventory';
                break;
            case 'service-form-modal':
                action = action.replace('/' + type, '/service');
                type = 'service';
                break;
        }

        $(this).find('form').attr('action', action);
        $(this).find('form').attr('id', `${type}-item-form`);
        if (form.has('name')) {
            for (var data of form.entries()) {
                if (data[0] !== 'icon') {
                    $(this).find(`[name="${data[0]}"]`).val(data[1]).trigger('change');
                } else {
                    if (rowData.icon !== null && rowData.icon !== "") {
                        $(this).find('img.image-prev').attr('src', `/uploads/${rowData.icon}`);
                        $(this).find('img.image-prev').parent().addClass('d-flex justify-content-center');
                        $(this).find('img.image-prev').parent().removeClass('hide');
                        $(this).find('img.image-prev').parent().prev().addClass('hide');
                    }
                }
            }

            if (form.has('selling')) {
                $(this).find('#selling').prop('checked', true).trigger('change');
            }

            if (form.has('purchasing')) {
                $(this).find('#purchasing').prop('checked', true).trigger('change');
            }
        }

        form = new FormData();
    });
}

const fillItemDropdownFields = (data, type) => {
    switch (data[0]) {
        case 'vendor':
            $.get(base_url + `accounting/get-vendor-details/${data[1]}`, function (result) {
                var vendor = JSON.parse(result);
                $('#item-modal form').find(`[name="${data[0]}"]`).append(`<option value="${data[1]}" selected>${vendor.display_name}</option>`);
            });
            break;
        case 'category':
            $.get(`/accounting/get-item-category-details/${data[1]}`, function (result) {
                var category = JSON.parse(result);
                $('#item-modal form').find(`[name="${data[0]}"]`).append(`<option value="${data[1]}" selected>${category.name}</option>`);
            });
            break;
        case 'sales_tax_category':
            $.get(`/accounting/get-sales-tax-category-details/${data[1]}`, function (result) {
                var category = JSON.parse(result);
                $('#item-modal form').find(`[name="${data[0]}"]`).append(`<option value="${data[1]}" selected>${category.name}</option>`);
            });
            break;
        default:
            $.get(`/accounting/get-account-details/${data[1]}`, function (result) {
                var account = JSON.parse(result);

                var flag = true;

                if (data[0] === 'income_account' && type === 'product' && account.type !== 'Income' && account.detail_type !== 'Sales of Product Income') {
                    flag = false;
                }

                var accountTypes = [
                    'Expenses',
                    'Bank',
                    'Accounts receivable (A/R)',
                    'Other Current Assets',
                    'Fixed Assets',
                    'Accounts payable (A/P)',
                    'Credit Card',
                    'Other Current Liabilities',
                    'Long Term Liabilities',
                    'Equity',
                    'Income',
                    'Cost of Goods Sold',
                    'Other Income',
                    'Other Expense'
                ];

                if (data[0] === 'expense_account' && type === 'product' && accountTypes.includes(account.type)) {
                    flag = false;
                }

                if (flag) {
                    $('#item-modal form').find(`[name="${data[0]}"]`).append(`<option value="${data[1]}" selected>${account.name}</option>`);
                }
            });
            break;
    }
}

const billPaymentBillsRows = (el) => {
    $('#billPaymentModal #bills-table-rows a.dropdown-item.active').removeClass('active');
    $(el).addClass('active');

    $(el).parent().parent().prev().find('span').html($(el).text());
    $('#billPaymentModal #bills-table-rows').prev().dropdown('toggle');

    $("#billPaymentModal #bills-table").nsmPagination({
        itemsPerPage: parseInt($(el).text().trim())
    });
}

const loadBills = () => {
    if ($('#modal-container #modal-form').attr('data-href') !== undefined) {
        var billPaymentId = $('#modal-container #modal-form').attr('data-href').replace('/accounting/update-transaction/bill-payment/', '');
        var url = `/accounting/get-bill-payment-bills/${billPaymentId}`
    } else {
        var url = `/accounting/get-bill-payment-bills`;
    }

    var data = new FormData();
    data.set('search', $('#billPaymentModal #search-bill-no').val());
    data.set('from', $('#billPaymentModal #bills-from').attr('data-applied'));
    data.set('to', $('#billPaymentModal #bills-to').attr('data-applied'));
    data.set('overdue', $('#billPaymentModal #overdue-bills-only').attr('data-applied'));
    data.set('vendor', $('#billPaymentModal #vendor').val());

    $.ajax({
        url: url,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function (res) {
            var bills = JSON.parse(res);

            $('#billPaymentModal #bills-table tbody').html('');
            $('#billPaymentModal #bills-table thead input.select-all').prop('checked', false);
            $('#billPaymentModal #vendor-credits-table input[type="checkbox"]').remove();
            $('#billPaymentModal #vendor-credits-table tbody input[name="credit_payment[]"]').val('');
            $('#billPaymentModal input[name="payment_amount"]').val('0.00');
            $('#billPaymentModal input[name="payment_amount"]').removeAttr('data-fixed');
            $('#billPaymentModal span.payment-total-amount').html('$0.00');
            $('#billPaymentModal span.payment-total-amount').html('$0.00');
            $('#billPaymentModal span.amount-to-apply').html('$0.00');
            $('#billPaymentModal span.amount-to-credit').html('$0.00');
            if (bills.length > 0) {
                $.each(bills, function (key, bill) {
                    $('#billPaymentModal #bills-table tbody').append(`<tr>
                        <td>
                            <div class="table-row-icon table-checkbox">
                                <input class="form-check-input select-one table-select" type="checkbox" value="${bill.id}">
                            </div>
                        </td>
                        <td>${bill.description}</td>
                        <td>${bill.due_date}</td>
                        <td>${bill.original_amount}</td>
                        <td>${bill.open_balance}</td>
                        <td><input type="number" value="" name="bill_payment[]" class="form-control nsm-field text-end" onchange="convertToDecimal(this)"></td>
                    </tr>`);
                });

                $('#billPaymentModal #bills-table').nsmPagination({
                    itemsPerPage: parseInt($('#billPaymentModal #bills-table-rows li a.active').html())
                });
            } else {
                $('#billPaymentModal #bills-table tbody').append(`<tr>
                    <td colspan="6">
                        <div class="nsm-empty">
                            <span>No results found.</span>
                        </div>
                    </td>
                </tr>`);
            }
        }
    });
}

const applyBillsFilter = () => {
    $('#billPaymentModal #bills-from').attr('data-applied', $('#billPaymentModal #bills-from').val());
    $('#billPaymentModal #bills-to').attr('data-applied', $('#billPaymentModal #bills-to').val());
    $('#billPaymentModal #overdue-bills-only').attr('data-applied', $('#billPaymentModal #overdue-bills-only').prop('checked'));
    loadBills();
}

const resetBillsFilter = () => {
    $('#billPaymentModal #bills-from').val('');
    $('#billPaymentModal #bills-to').val('');
    $('#billPaymentModal #overdue-bills-only').prop('checked', false);

    $('#billPaymentModal #bills-from').attr('data-applied', '');
    $('#billPaymentModal #bills-to').attr('data-applied', '');
    $('#billPaymentModal #overdue-bills-only').attr('data-applied', 'false');

    loadBills();
}

const billPaymentCreditsRows = (el) => {
    $('#billPaymentModal #credits-table-rows a.dropdown-item.active').removeClass('active');
    $(el).addClass('active');

    $(el).parent().parent().prev().find('span').html($(el).text());
    $('#billPaymentModal #credits-table-rows').prev().dropdown('toggle');

    $("#billPaymentModal #vendor-credits-table").nsmPagination({
        itemsPerPage: parseInt($(el).text().trim())
    });
}

const loadVCredits = () => {
    if ($('#modal-container #modal-form').attr('data-href') !== undefined) {
        var billPaymentId = $('#modal-container #modal-form').attr('data-href').replace('/accounting/update-transaction/bill-payment/', '');
        var url = `/accounting/get-bill-payment-credits/${billPaymentId}`
    } else {
        var url = `/accounting/get-bill-payment-credits`;
    }
    var data = new FormData();

    data.set('search', $('#billPaymentModal #search-vcredit-no').val());
    data.set('from', $('#billPaymentModal #vcredit-from').attr('data-applied'));
    data.set('to', $('#billPaymentModal #vcredit-to').attr('data-applied'));
    data.set('vendor', $('#billPaymentModal #vendor').val());

    $.ajax({
        url: url,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function (res) {
            var credits = JSON.parse(res);

            $('#billPaymentModal #vendor-credits-table tbody').html('');
            // $('#billPaymentModal [name="credits[]"]').remove();
            if (credits.length > 0) {
                $.each(credits, function (key, credit) {
                    $('#billPaymentModal #vendor-credits-table tbody').append(`<tr data-type="${credit.type}">
                        <td>
                            <div class="table-row-icon table-checkbox">
                                <input class="form-check-input select-one table-select" type="checkbox" value="${credit.id}">
                            </div>
                        </td>
                        <td>${credit.description}</td>
                        <td>${credit.original_amount}</td>
                        <td>${credit.open_balance}</td>
                        <td><input type="number" value="" name="credit_payment[]" class="form-control nsm-field text-end" onchange="convertToDecimal(this)" max="${credit.open_balance}" step="0.01"></td>
                    </tr>`);
                });

                $('#billPaymentModal #vendor-credits-table').nsmPagination({
                    itemsPerPage: parseInt($('#billPaymentModal #credits-table-rows li a.active').html())
                });
            } else {
                $('#billPaymentModal #vendor-credits-table tbody').append(`<tr>
                    <td colspan="6">
                        <div class="nsm-empty">
                            <span>No results found.</span>
                        </div>
                    </td>
                </tr>`);
            }
        }
    });
}

const applyCreditsFilter = () => {
    $('#billPaymentModal #vcredit-from').attr('data-applied', $('#billPaymentModal #vcredit-from').val());
    $('#billPaymentModal #vcredit-to').attr('data-applied', $('#billPaymentModal #vcredit-to').val());
    loadVCredits();
}

const resetCreditsFilter = () => {
    $('#billPaymentModal #vcredit-from').val('');
    $('#billPaymentModal #vcredit-to').val('');

    $('#billPaymentModal #vcredit-from').attr('data-applied', '');
    $('#billPaymentModal #vcredit-to').attr('data-applied', '');
    loadVCredits();
}

const viewTransaction = (el, e) => {
    $('#modal-container form .modal').modal('hide');
    $('.modal-backdrop:last-child').remove();

    var table = $(el).parent().parent();
    var data = e.currentTarget.dataset;
    var type = table.attr('id').replace('recent-', '').slice(0, -1).toLowerCase();
    if (type === 'journal-entrie') {
        type = 'journal';
    } else if (type === 'time-activitie') {
        type = 'time-activity';
    }
    data.type = table.attr('id').replace('recent-', '').slice(0, -1).charAt(0).toUpperCase();
    data.type += table.attr('id').replace('recent-', '').slice(0, -1).slice(1);
    data.type = data.type.replace('-', ' ');

    if (data.type === 'Journal entrie') {
        data.type = 'Journal';
    } else if (data.type === 'Cc payment') {
        data.type = 'CC Payment';
    } else if (data.type === 'Time activitie') {
        data.type === 'Time activity';
    }

    $.get(`/accounting/view-transaction/${type}/${data.id}`, function (res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        switch (type) {
            case 'expense':
                initModalFields('expenseModal', data);

                $('#expenseModal').modal('show');
                break;
            case 'check':
                initModalFields('checkModal', data);

                $('#checkModal').modal('show');
                break;
            case 'bill':
                initModalFields('billModal', data);

                $('#billModal').modal('show');
                break;
            case 'cc-credit':
                initModalFields('creditCardCreditModal', data);

                $('#creditCardCreditModal').modal('show');
                break;
            case 'vendor-credit':
                initModalFields('vendorCreditModal', data);

                $('#vendorCreditModal').modal('show');
                break;
            case 'deposit':
                initModalFields('depositModal', data);

                $('#depositModal').modal('show');
                break;
            case 'purchase-order':
                initModalFields('purchaseOrderModal', data);

                $('#purchaseOrderModal').modal('show');
                break;
            case 'transfer':
                initModalFields('transferModal', data);

                $('#transferModal').modal('show');
                break;
            case 'journal':
                initModalFields('journalEntryModal', data);

                $('#journalEntryModal').modal('show');
                break;
            case 'qty-adjustment':
                rowInputs = $('#inventoryModal table#inventory-adjustments-table tbody tr:first-child()').html();
                blankRow = $('#inventoryModal table#inventory-adjustments-table tbody tr:nth-child(2)').html();
                rowCount = $('#inventoryModal table#inventory-adjustments-table tbody tr').length;

                $('#inventoryModal table#inventory-adjustments-table tbody tr:first-child()').html(blankRow);
                $('#inventoryModal table#inventory-adjustments-table tbody tr:first-child() td:first-child').html(1);

                initModalFields('inventoryModal', data);

                $('#inventoryModal').modal('show');
                break;
            case 'cc-payment':
                initModalFields('payDownCreditModal', data);

                $('#payDownCreditModal').modal('show');
                break;
            case 'time-activity':
                initModalFields('singleTimeModal', data);

                $('#singleTimeModal').modal('show');
                break;
            case 'receive-payment':
                initModalFields('receivePaymentModal', data);

                loadPaymentInvoices(data);
                loadPaymentCredits(data);

                $('#receivePaymentModal').modal('show');
                break;
            case 'credit-memo':
                initModalFields('creditMemoModal', data);

                $('#creditMemoModal').modal('show');
                break;
            case 'sales-receipt':
                initModalFields('salesReceiptModal', data);

                $('#salesReceiptModal').modal('show');
                break;
            case 'refund-receipt':
                initModalFields('refundReceiptModal', data);

                $('#refundReceiptModal').modal('show');
                break;
            case 'delayed-credit':
                initModalFields('delayedCreditModal', data);

                $('#delayedCreditModal').modal('show');
                break;
            case 'delayed-charge':
                initModalFields('delayedChargeModal', data);

                $('#delayedChargeModal').modal('show');
                break;
            case 'invoice':
                initModalFields('invoiceModal', data);

                $('#invoiceModal').modal('show');
                break;
        }
    });
}

const saveAndCloseForm = (e) => {
    e.preventDefault();

    submitType = 'save-and-close';

    $('#modal-form').submit();
}

const saveAndNewForm = (e) => {
    e.preventDefault();

    submitType = 'save-and-new';

    $('#modal-form').submit();
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
        if (result.isConfirmed) {
            $('#modal-container form').submit();
        }
    });
}

const clearForm = () => {
    // Clear inputs after saving
    $('#payee').empty().change();
    $('#mailing_address, #memo, #tags').empty().change();
    $('#check_no, #permit_number').val(null).change();
    $("#print_later").prop("checked", false).change();
    $('#account-balance').text('$0.00');
    $('.delete-row').click();
    if (modalName == 'creditMemoModal') {
        $('#sales-rep').empty().change();
        $('#billing-address').val('');
        $('#purchase-order-no').val('');
    }

    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today = mm + '/' + dd + '/' + yyyy;

    $(modalName).parent().attr('onsubmit', 'submitModalForm(event, this)').removeAttr('data-href');
    $(modalName).find('.modal-body #tags').val(null).trigger('change');
    $(modalName).find('.modal-body select').each(function () {
        if (!$(this).attr('id').includes('account') && $(this).find('option').length > 1) {
            if ($(this).attr('id') === 'weekDates') {
                $(this).find('option').each(function () {
                    var value = $(this).attr('value');
                    var valueSplit = value.split('-');

                    var current = new Date();
                    var startDate = new Date(valueSplit[0]);
                    var endDate = new Date(valueSplit[1]);

                    if (current.getTime() >= startDate.getTime() && current.getTime() <= endDate.getTime()) {
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
    if (modalName !== '#time-activity-settings') {
        $(modalName).find('.modal-body input[type="checkbox"]:not(.show-field)').each(function () {
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

    modalAttachmentId = [];
    modalAttachedFiles = [];
    $(modalName).find('.modal-body .dropzone .dz-message').show();

    if ($(modalName).find('.modal-body a#linked-transaction').length > 0) {
        unlinkTransaction();
    }

    if (modalName === '#weeklyTimesheetModal') {
        $(modalName).find('.modal-body #timesheet-table tbody tr').remove();

        var count = 1;
        do {
            $(modalName).find('#timesheet-table tbody').append(`<tr>${rowInputs}</tr>`);
            $(modalName).find('#timesheet-table tbody tr:last-child() td:first-child()').html(count);
            $(modalName).find('#timesheet-table tbody tr:last-child() td:first-child() select').each(function () {
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
                            url: base_url + 'accounting/get-dropdown-choices',
                            dataType: 'json',
                            data: function (params) {
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
                        templateSelection: optionSelect,
                        dropdownParent: $(modalName)
                    });
                } else {
                    $(this).select2({
                        minimumResultsForSearch: -1,
                        dropdownParent: $(modalName)
                    });
                }
            });
            count++;
        } while ($(modalName).find('.modal-body #timesheet-table tbody tr').length < rowCount)
    } else {
        $(modalName).find('.modal-body table tbody tr').each(function (index, value) {
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
    var id = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/purchase-order/', '');

    $.get(`/accounting/print-purchase-order-modal/${id}`, function (result) {
        $('div#modal-container').append(result);

        $('#viewPrintPurchaseOrderModal').modal('show');
    });
}

const sendPurchaseOrder = (purchaseOrderId) => {
    $.get(`/accounting/send-purchase-order-email-modal/${purchaseOrderId}`, function (result) {
        $('div#modal-container').append(result);

        $('#sendEmailModal').modal('show');
    });
}

const findCustByInvoiceNo = () => {
    var invoiceNo = $('#receivePaymentModal #invoice-no').val();
    var data = new FormData();
    data.set('invoice_no', invoiceNo);

    $.ajax({
        url: base_url + 'accounting/find-customer-by-invoice-no',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function (result) {
            var res = JSON.parse(result);

            if (res.success) {
                $('#receivePaymentModal #customer').append(`<option value="${res.customer_id}" selected>${res.customer_name}</option>`).trigger('change');
            } else {
                $('#receivePaymentModal #invoice-no').addClass('border-danger');
                Swal.fire({
                    title: 'Invoice',
                    text: 'No Records Found',
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonText: 'Okay'
                });
            }
        }
    });
}

const cancelFindByInvoice = () => {
    $('#receivePaymentModal #invoice-no').val('');

    $('#receivePaymentModal #findByInvoice').dropdown('toggle');
}

const invoiceTableRows = (el) => {
    $('#receivePaymentModal #invoice-table-rows a.dropdown-item.active').removeClass('active');
    $(el).addClass('active');

    $(el).parent().parent().prev().find('span').html($(el).text());
    $('#receivePaymentModal #invoice-table-rows').prev().dropdown('toggle');

    $("#receivePaymentModal #invoices-table").nsmPagination({
        itemsPerPage: parseInt($(el).text().trim())
    });
}

const creditsTableRows = (el) => {
    $('#receivePaymentModal #credits-table-rows a.dropdown-item.active').removeClass('active');
    $(el).addClass('active');

    $(el).parent().parent().prev().find('span').html($(el).text());
    $('#receivePaymentModal #credits-table-rows').prev().dropdown('toggle');

    $("#receivePaymentModal #credits-table").nsmPagination({
        itemsPerPage: parseInt($(el).text().trim())
    });
}

const applyInvoicesFilter = (e) => {
    e.preventDefault();

    $('#receivePaymentModal #invoices-from').attr('data-applied', $('#receivePaymentModal #invoices-from').val());
    $('#receivePaymentModal #invoices-to').attr('data-applied', $('#receivePaymentModal #invoices-to').val());
    $('#receivePaymentModal #overdue-invoices-only').attr('data-applied', $('#receivePaymentModal #overdue-invoices-only').prop('checked') ? 1 : 0);

    loadCustomerInvoices();
}

const resetInvoicesFilter = (e) => {
    e.preventDefault();

    var href = $('#modal-container form').attr('data-href');
    if (href === false || typeof href === 'undefined') {
        $('#receivePaymentModal #invoices-from').val('');
        $('#receivePaymentModal #invoices-to').val('');
        $('#receivePaymentModal #overdue-invoices-only').prop('checked', false);
        $('#receivePaymentModal #invoices-from').attr('data-applied', '');
        $('#receivePaymentModal #invoices-to').attr('data-applied', '');
        $('#receivePaymentModal #overdue-invoices-only').attr('data-applied', 0);
        loadCustomerInvoices();
    } else {
        var split = href.split('/');
        var data = {
            id: split[split.length - 1]
        };
        // loadPaymentInvoices(data);
    }
}

const applyCreditMemoFilter = (e) => {
    e.preventDefault();

    $('#receivePaymentModal #credit-memo-from').attr('data-applied', $('#receivePaymentModal #credit-memo-from').val());
    $('#receivePaymentModal #credit-memo-to').attr('data-applied', $('#receivePaymentModal #credit-memo-to').val());

    loadCustomerCredits();
}

const resetCreditMemoFilter = (e) => {
    e.preventDefault();

    var href = $('#modal-container form').attr('data-href');
    if (href === false || typeof href === 'undefined') {
        $('#receivePaymentModal #credit-memo-from').val('');
        $('#receivePaymentModal #credit-memo-to').val('');
        $('#receivePaymentModal #credit-memo-from').attr('data-applied', '');
        $('#receivePaymentModal #credit-memo-to').attr('data-applied', '');
        loadCustomerCredits();
    } else {
        var split = href.split('/');
        var data = {
            id: split[split.length - 1]
        };
    }
}

function countCheckedCheckboxes() {
    var checkedCount = $('#invoices-table tbody input[type="checkbox"]:checked').length;
    var totalCount = $('#invoices-table tbody input[type="checkbox"]').length;

    if (checkedCount === totalCount && totalCount > 0) {
        $('#invoices-table .select-all').prop('checked', true);
    } else {
        $('#invoices-table .select-all').prop('checked', false);
    }
}
$(document).on('change', '#invoices-table .select-all', function () {
    // Get the checked status of the "check all" checkbox
    var isChecked = $(this).prop('checked');

    // Set all individual checkboxes' checked status based on the "check all" checkbox
    $('#invoices-table .select-all').prop('checked', isChecked);
    $('#invoices-table .select-one').prop('checked', isChecked);
    console.log("customer invoices clicked select-all" + isChecked);
});

$(document).on('change', '#invoices-table tbody .select-one', function (event) {
    countCheckedCheckboxes();
});

const loadCustomerInvoices = () => {
    var data = new FormData();
    data.set('search', $('#receivePaymentModal #search-invoice-no').val() || '');
    data.set('from_date', ($('#receivePaymentModal #invoices-from').attr('data-applied') !== undefined) ? $('#receivePaymentModal #invoices-from').attr('data-applied') : '');
    data.set('to_date', ($('#receivePaymentModal #invoices-to').attr('data-applied') !== undefined) ? $('#receivePaymentModal #invoices-to').attr('data-applied') : '');
    data.set('overdue', ($('#receivePaymentModal #overdue-invoices-only').attr('data-applied') !== undefined) ? $('#receivePaymentModal #overdue-invoices-only').attr('data-applied') : '');

    var customerId = $('#receivePaymentModal #customer').val();

    if (!customerId) {
        $('#receivePaymentModal #invoices-table tbody').html(`
        <tr>
            <td colspan="6">
                <div class="nsm-empty">
                    <span>There are no transactions matching the criteria.</span>
                </div>
            </td>
        </tr>
    `);
        return;
    }

    $.ajax({
        url: base_url + `accounting/get-customer-invoices/${$('#receivePaymentModal #customer').val() || 'get-customer-invoices'}`,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function (result) {
            var invoices = JSON.parse(result);

            $('#receivePaymentModal #invoices-table tbody').html('');
            if (invoices.length > 0) {
                $.each(invoices, function (key, invoice) {
                    $('#receivePaymentModal #invoices-table tbody').append(`
                    <tr>
                        <td>
                            <div class="table-row-icon table-checkbox">
                                <input class="form-check-input select-one table-select" type="checkbox" value="${invoice.id}">
                            </div>
                        </td>
                        <td>${invoice.description}</td>
                        <td>${invoice.due_date}</td>
                        <td>${invoice.original_amount}</td>
                        <td>${invoice.open_balance}</td>
                        <td><input type="number" onchange="convertToDecimal(this)" step=".01" class="form-control nsm-field text-end" name="payment[]"></td>
                        <td><button type="button" class="nsm-button delete-row"><i class='bx bx-fw bx-trash'></i></button></td>
                    </tr>
                `);
                });

                $('#receivePaymentModal #invoices-table').nsmPagination({
                    itemsPerPage: parseInt($('#receivePaymentModal #invoice-table-rows li a.active').html())
                });
            } else {
                $('#receivePaymentModal #invoices-table tbody').html(`
                <tr>
                    <td colspan="6">
                        <div class="nsm-empty">
                            <span>There are no transactions matching the criteria.</span>
                        </div>
                    </td>
                </tr>
            `);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error fetching invoices:', error);
        }
    });
}

const loadCustomerCredits = () => {
    var data = new FormData();
    data.set('search', $('#receivePaymentModal #search-credit-memo-no').val());
    data.set('from_date', $('#receivePaymentModal #credit-memo-from').attr('data-applied'));
    data.set('to_date', $('#receivePaymentModal #credit-memo-to').attr('data-applied'));

    $.ajax({
        url: base_url + `/accounting/get-customer-credits/${$('#receivePaymentModal #customer').val()}`,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function (result) {
            var credits = JSON.parse(result);

            $('#receivePaymentModal #credits-table tbody').html('');
            if (credits.length > 0) {
                $.each(credits, function (key, credit) {
                    if ($('#receivePaymentModal #invoices-table tbody tr input[type="checkbox"]:checked').length > 0) {
                        var checkboxCol = `<div class="table-row-icon table-checkbox">
                            <input class="form-check-input select-one table-select" type="checkbox" value="${credit.type}_${credit.id}">
                        </div>`;
                    } else {
                        var checkboxCol = '';
                    }
                    $('#receivePaymentModal #credits-table tbody').append(`
                    <tr data-id="${credit.id}" data-type="${credit.type}">
                        <td>${checkboxCol}</td>
                        <td>${credit.description}</td>
                        <td>${credit.original_amount}</td>
                        <td>${credit.open_balance}</td>
                        <td><input type="number" onchange="convertToDecimal(this)" step=".01" class="form-control nsm-field text-end" name="credit_payment[]"></td>
                    </tr>
                    `);
                });

                $('#receivePaymentModal #credits-table').nsmPagination({
                    itemsPerPage: parseInt($('#receivePaymentModal #credits-table-rows li a.active').html())
                });
            } else {
                $('#receivePaymentModal #credits-table tbody').html(`<tr>
                    <td colspan="6">
                        <div class="nsm-empty">
                            <span>There are no transactions matching the criteria.</span>
                        </div>
                    </td>
                </tr>`);
            }
        }
    });
}

const loadPaymentInvoices = (paymentdata) => {
    var data = new FormData();
    data.set('search', $('#receivePaymentModal #search-invoice-no').val());
    data.set('from_date', $('#receivePaymentModal #invoices-from').attr('data-applied') !== undefined ? $('#receivePaymentModal #invoices-from').attr('data-applied') : "");
    data.set('to_date', $('#receivePaymentModal #invoices-to').attr('data-applied') !== undefined ? $('#receivePaymentModal #invoices-to').attr('data-applied') : "");
    data.set('overdue', $('#receivePaymentModal #overdue-invoices-only').attr('data-applied') !== undefined ? $('#receivePaymentModal #overdue-invoices-only').attr('data-applied') : "");

    $.ajax({
        url: `/accounting/load-payment-invoices/${paymentdata.id}`,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function (result) {
            var invoices = JSON.parse(result);

            $('#receivePaymentModal #invoices-table tbody').html('');
            if (invoices.length > 0) {
                $.each(invoices, function (key, invoice) {
                    $('#receivePaymentModal #invoices-table tbody').append(`
                    <tr>
                        <td>
                            <div class="table-row-icon table-checkbox">
                                <input class="form-check-input select-one table-select" type="checkbox" value="${invoice.id}" ${invoice.checked ? 'checked' : ''}>
                            </div>
                        </td>
                        <td>${invoice.description}</td>
                        <td>${invoice.due_date}</td>
                        <td>${invoice.original_amount}</td>
                        <td>${invoice.open_balance}</td>
                        <td><input type="number" onchange="convertToDecimal(this)" step=".01" class="form-control nsm-field text-end" name="payment[]" ${invoice.checked ? `value="${invoice.payment_amount}"` : ''}></td>
                    </tr>
                    `);
                });

                $('#receivePaymentModal #invoices-table').nsmPagination({
                    itemsPerPage: parseInt($('#receivePaymentModal #invoice-table-rows li a.active').html())
                });
            } else {
                $('#receivePaymentModal #invoices-table tbody').html(`<tr>
                    <td colspan="6">
                        <div class="nsm-empty">
                            <span>There are no transactions matching the criteria.</span>
                        </div>
                    </td>
                </tr>`);
            }
        }
    });
}

// const loadPaymentInvoices = (data) => {
//     if($.fn.DataTable.isDataTable(`#receivePaymentModal #invoices-table`)) {
//         $('#receivePaymentModal #invoices-table').DataTable().clear();
//         $('#receivePaymentModal #invoices-table').DataTable().destroy();
//     }
//     $('#receivePaymentModal #invoices-table').DataTable({
//         autoWidth: false,
//         searching: false,
//         processing: true,
//         serverSide: true,
//         lengthChange: false,
//         ordering: false,
//         info: false,
//         ajax: {
//             url: `/accounting/load-payment-invoices/${data.id}`,
//             dataType: 'json',
//             contentType: 'application/json',
//             type: 'POST',
//             data: function(d) {
//                 d.columns[0].search.value = $('#receivePaymentModal #search-invoice-no').val();
//                 d.from_date = $('#receivePaymentModal #invoices-from').val();
//                 d.to_date = $('#receivePaymentModal #invoices-to').val();
//                 d.overdue = $('#receivePaymentModal #overdue_invoices_only').prop('checked') ? 1 : 0;
//                 d.length = $('#receivePaymentModal #invoices_table_rows').val()
//                 return JSON.stringify(d);
//             },
//             pagingType: 'full_numbers',
//         },
//         columns: [
//             {
//                 data: null,
//                 name: 'checkbox',
//                 fnCreatedCell: function(td, cellData, rowData, row, col) {
//                     if(rowData.checked) {
//                         $(td).html(`<div class="d-flex justify-content-center">
//                             <div class="checkbox checkbox-sec m-0">
//                                 <input type="checkbox" id="invoice-${rowData.id}" value="${rowData.id}" checked>
//                                 <label for="invoice-${rowData.id}" class="p-0" style="width: 24px; height: 24px"></label>
//                             </div>
//                         </div>`);
//                     } else {
//                         $(td).html(`<div class="d-flex justify-content-center">
//                             <div class="checkbox checkbox-sec m-0">
//                                 <input type="checkbox" id="invoice-${rowData.id}" value="${rowData.id}">
//                                 <label for="invoice-${rowData.id}" class="p-0" style="width: 24px; height: 24px"></label>
//                             </div>
//                         </div>`);
//                     }
//                 }
//             },
//             {
//                 data: 'description',
//                 name: 'description',
//                 fnCreatedCell: function(td, cellData, rowData, row, col) {
//                     $(td).html(cellData);
//                 }
//             },
//             {
//                 data: 'due_date',
//                 name: 'due_date',
//                 fnCreatedCell: function(td, cellData, rowData, row, col) {
//                     $(td).html(cellData);
//                 }
//             },
//             {
//                 data: 'original_amount',
//                 name: 'original_amount',
//                 fnCreatedCell: function(td, cellData, rowData, row, col) {
//                     $(td).html(cellData);
//                 }
//             },
//             {
//                 data: 'open_balance',
//                 name: 'open_balance',
//                 fnCreatedCell: function(td, cellData, rowData, row, col) {
//                     $(td).html(cellData);
//                 }
//             },
//             {
//                 data: null,
//                 name: 'payment',
//                 fnCreatedCell: function(td, cellData, rowData, row, col) {
//                     if(rowData.checked) {
//                         $(td).html(`<input type="number" onchange="convertToDecimal(this)" step=".01" class="form-control text-right" name="payment[]" value="${rowData.payment_amount}">`);
//                     } else {
//                         $(td).html(`<input type="number" onchange="convertToDecimal(this)" step=".01" class="form-control text-right" name="payment[]">`);
//                     }
//                 }
//             }
//         ]
//     });
// }

const loadPaymentCredits = (paymentdata) => {
    var data = new FormData();
    data.set('search', $('#receivePaymentModal #search-credit-memo-no').val());
    data.set('from_date', $('#receivePaymentModal #credit-memo-from').attr('data-applied') !== undefined ? $('#receivePaymentModal #credit-memo-from').attr('data-applied') : "");
    data.set('to_date', $('#receivePaymentModal #credit-memo-to').attr('data-applied') !== undefined ? $('#receivePaymentModal #credit-memo-to').attr('data-applied') : "");

    $.ajax({
        url: `/accounting/load-payment-credits/${paymentdata.id}`,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function (result) {
            var credits = JSON.parse(result);

            $('#receivePaymentModal #credits-table tbody').html('');
            if (credits.length > 0) {
                $.each(credits, function (key, credit) {
                    if ($('#receivePaymentModal #invoices-table tbody tr input.select-one:checked').length > 0) {
                        var checkboxCol = `<div class="table-row-icon table-checkbox">
                            <input class="form-check-input select-one table-select" type="checkbox" value="${credit.type}_${credit.id}" ${credit.checked ? 'checked' : ''}>
                        </div>`;
                    } else {
                        var checkboxCol = '';
                    }
                    $('#receivePaymentModal #credits-table tbody').append(`
                    <tr data-id="${credit.id}" data-type="${credit.type}">
                        <td>${checkboxCol}</td>
                        <td>${credit.description}</td>
                        <td>${credit.original_amount}</td>
                        <td>${credit.open_balance}</td>
                        <td><input type="number" onchange="convertToDecimal(this)" step=".01" class="form-control nsm-field text-end" name="credit_payment[]" ${credit.checked ? `value="${credit.payment_amount}"` : ''}></td>
                    </tr>
                    `);
                });

                $('#receivePaymentModal #credits-table').nsmPagination({
                    itemsPerPage: parseInt($('#receivePaymentModal #credits-table-rows li a.active').html())
                });
            } else {
                $('#receivePaymentModal #credits-table tbody').html(`<tr>
                    <td colspan="6">
                        <div class="nsm-empty">
                            <span>There are no transactions matching the criteria.</span>
                        </div>
                    </td>
                </tr>`);
            }
        }
    });
}

// const loadPaymentCredits = (data) => {
//     if($.fn.DataTable.isDataTable(`#receivePaymentModal #credits-table`)) {
//         $('#receivePaymentModal #credits-table').DataTable().clear();
//         $('#receivePaymentModal #credits-table').DataTable().destroy();
//     }
//     $('#receivePaymentModal #credits-table').DataTable({
//         autoWidth: false,
//         searching: false,
//         processing: true,
//         serverSide: true,
//         lengthChange: false,
//         ordering: false,
//         info: false,
//         ajax: {
//             url: `/accounting/load-payment-credits/${data.id}`,
//             dataType: 'json',
//             contentType: 'application/json',
//             type: 'POST',
//             data: function(d) {
//                 d.columns[0].search.value = $('#receivePaymentModal #search-credit-memo-no').val();
//                 d.from_date = $('#receivePaymentModal #credit-memo-from').val();
//                 d.to_date = $('#receivePaymentModal #credit-memo-to').val();
//                 d.length = $('#receivePaymentModal #credit_memo_table_rows').val()
//                 return JSON.stringify(d);
//             },
//             pagingType: 'full_numbers',
//         },
//         columns: [
//             {
//                 data: null,
//                 name: 'checkbox',
//                 fnCreatedCell: function(td, cellData, rowData, row, col) {
//                     if(rowData.checked) {
//                         $(td).html(`<div class="d-flex justify-content-center">
//                             <div class="checkbox checkbox-sec m-0">
//                                 <input type="checkbox" id="${rowData.type}-${rowData.id}" value="${rowData.type}_${rowData.id}" checked>
//                                 <label for="${rowData.type}-${rowData.id}" class="p-0" style="width: 24px; height: 24px"></label>
//                             </div>
//                         </div>`);
//                     } else {
//                         $(td).html(`<div class="d-flex justify-content-center">
//                             <div class="checkbox checkbox-sec m-0">
//                                 <input type="checkbox" id="${rowData.type}-${rowData.id}" value="${rowData.type}_${rowData.id}">
//                                 <label for="${rowData.type}-${rowData.id}" class="p-0" style="width: 24px; height: 24px"></label>
//                             </div>
//                         </div>`);
//                     }
//                 }
//             },
//             {
//                 data: 'description',
//                 name: 'description',
//                 fnCreatedCell: function(td, cellData, rowData, row, col) {
//                     $(td).html(cellData);
//                 }
//             },
//             {
//                 data: 'original_amount',
//                 name: 'original_amount',
//                 fnCreatedCell: function(td, cellData, rowData, row, col) {
//                     $(td).html(cellData);
//                 }
//             },
//             {
//                 data: 'open_balance',
//                 name: 'open_balance',
//                 fnCreatedCell: function(td, cellData, rowData, row, col) {
//                     $(td).html(cellData);
//                 }
//             },
//             {
//                 data: null,
//                 name: 'payment',
//                 fnCreatedCell: function(td, cellData, rowData, row, col) {
//                     if(rowData.checked) {
//                         $(td).html(`<input type="number" onchange="convertToDecimal(this)" step=".01" class="form-control text-right" name="credit_payment[]" value="${rowData.payment_amount}">`);
//                     } else {
//                         $(td).html(`<input type="number" onchange="convertToDecimal(this)" step=".01" class="form-control text-right" name="credit_payment[]">`);
//                     }
//                 }
//             }
//         ]
//     });
// }

const printPreviewInvoice = () => {
    var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

    $.get('/accounting/print-invoice-modal/' + split[1], function (result) {
        $('div#modal-container').append(result);

        $('#viewPrintInvoiceModal').modal('show');
    });
}

const printPreviewCreditMemo = () => {
    var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

    $.get(base_url + 'accounting/print-credit-memo-modal/' + split[1], function (result) {
        $('div#modal-container').append(result);

        $('#viewPrintCreditMemoModal').modal('show');
    });
}

const printPreviewSalesReceipt = () => {
    var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

    $.get(base_url + 'accounting/print-sales-receipt-modal/' + split[1], function (result) {
        $('div#modal-container').append(result);

        $('#viewPrintSalesReceiptModal').modal('show');
    });
}

const printPreviewRefundReceipt = () => {
    var split = $('#modal-container form').attr('data-href').replace('/accounting/update-transaction/', '').split('/');

    $.get('/accounting/print-refund-receipt-modal/' + split[1], function (result) {
        $('div#modal-container').append(result);

        $('#viewPrintRefundReceiptModal').modal('show');
    });
}

const getInvoiceLinkableTransactions = (transactionType, transactionDate) => {
    $.get(base_url + 'accounting/get-linkable-transactions/invoice/' + $('#invoiceModal #customer').val(), function (res) {
        var transactions = JSON.parse(res);

        $.each(transactions, function (index, transaction) {
            var title = transaction.type;
            title += transaction.number !== '' ? '#' + transaction.number : '';
            var transacDate = new Date(transaction.date);
            var transacMonth = transacDate.getMonth() + 1;
            var date = new Date();

            var flag = false;
            switch (transactionType) {
                case 'all':
                    switch (transactionDate) {
                        case 'all':
                            flag = true;
                            break;
                        case 'this-month':
                            var month = date.getMonth() + 1;

                            if (month === transacMonth) {
                                flag = true;
                            }
                            break;
                        case 'last-month':
                            var month = date.getMonth();

                            if (month === transacMonth) {
                                flag = true;
                            }
                            break;
                        case 'custom':
                            if (transacDate >= startDate && transacDate <= endDate) {
                                flag = true;
                            }
                            break;
                    }
                    break;
                case 'charges':
                    if (transaction.data_type === 'delayed-charge') {
                        switch (transactionDate) {
                            case 'all':
                                flag = true;
                                break;
                            case 'this-month':
                                var month = date.getMonth() + 1;

                                if (month === transacMonth) {
                                    flag = true;
                                }
                                break;
                            case 'last-month':
                                var month = date.getMonth();

                                if (month === transacMonth) {
                                    flag = true;
                                }
                                break;
                            case 'custom':
                                if (transacDate >= startDate && transacDate <= endDate) {
                                    flag = true;
                                }
                                break;
                        }
                    }
                    break;
                case 'credits':
                    if (transaction.data_type === 'delayed-credit') {
                        switch (transactionDate) {
                            case 'all':
                                flag = true;
                                break;
                            case 'this-month':
                                var month = date.getMonth() + 1;

                                if (month === transacMonth) {
                                    flag = true;
                                }
                                break;
                            case 'last-month':
                                var month = date.getMonth();

                                if (month === transacMonth) {
                                    flag = true;
                                }
                                break;
                            case 'custom':
                                if (transacDate >= startDate && transacDate <= endDate) {
                                    flag = true;
                                }
                                break;
                        }
                    }
                    break;
            }

            if ($(`#invoiceModal input[name="linked_transaction[]"][value="${transaction.data_type.replace('-', '_')}-${transaction.id}"]`).length > 0) {
                flag = false;
            }

            if (flag) {
                $('#invoiceModal .modal-body .row .nsm-callout .transactions-container .row').append(`
                    <div class="col-12 grid-mb">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">${title}</h5>
                                <p class="card-subtitle">${transaction.formatted_date}</p>
                                <p class="card-text">
                                    ${transaction.type === 'Purchase Order' ? `<strong>Total</strong>&emsp;${transaction.total}<br><strong>Balance</strong>&emsp;${transaction.balance}` : transaction.amount}
                                </p>
                                <ul class="d-flex justify-content-around list-unstyled">
                                    <li><a href="#" class="add-transaction text-decoration-none" data-id="${transaction.id}" data-type="${transaction.data_type}"><strong>Add</strong></a></li>
                                    <li><a href="#" class="open-transaction text-decoration-none" data-id="${transaction.id}" data-type="${transaction.data_type}">Open</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                `);
            }
        });
    });
}

const checkTableRows = (el) => {
    var count = $(el).html();
    $('#printChecksModal #checks-table-rows a.dropdown-item.active').removeClass('active');
    $(el).addClass('active');

    $(el).parent().parent().prev().find('span').html(count);
    $('#printChecksModal #checks-table-rows').prev().dropdown('toggle');

    $("#printChecksModal #checks-table").nsmPagination({
        itemsPerPage: parseInt(count)
    });
}

const billTableRows = (el) => {
    var count = $(el).html();
    $('#payBillsModal #bills-table-rows a.dropdown-item.active').removeClass('active');
    $(el).addClass('active');

    $(el).parent().parent().prev().find('span').html(count);
    $('#payBillsModal #bills-table-rows').prev().dropdown('toggle');

    $("#payBillsModal #bills-table").nsmPagination({
        itemsPerPage: parseInt(count)
    });
}

const printcheck = (checkID, bankAccountID, bankAccount) => {
    $.get(GET_OTHER_MODAL_URL + 'print_checks_modal', function (res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
				<div id="modal-container"> 
					${res}
				</div>
			`);
        }

        $(`#printChecksModal select`).each(function () {
            var type = $(this).attr('id');
            if (type === undefined) {
                type = $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-');
            } else {
                type = type.replaceAll('_', '-');

                if (type.includes('transfer')) {
                    type = 'transfer-account';
                }
            }

            if (type === 'payment-account') {
                $(this).select2({
                    ajax: {
                        url: base_url + 'accounting/get-dropdown-choices',
                        dataType: 'json',
                        data: function (params) {
                            var query = {
                                search: params.term,
                                type: 'public',
                                field: type,
                                modal: 'printChecksModal'
                            }

                            // Query parameters will be ?search=[term]&type=public&field=[type]
                            return query;
                        }
                    },
                    templateResult: formatResult,
                    templateSelection: optionSelect,
                    dropdownParent: $('#printChecksModal')
                });
            } else {
                $(this).select2({
                    minimumResultsForSearch: -1,
                    dropdownParent: $('#printChecksModal')
                });
            }
        });

        if ($(`#printChecksModal .dropdown`).length > 0) {
            $(`#printChecksModal .dropdown-menu`).on('click', function (e) {
                e.stopPropagation();
            });
        }

        $('#printChecksModal').on('hidden.bs.modal', function () {
            $('#modal-container').remove();
            $('.modal-backdrop').remove();
        });

        $('#printChecksModal').modal('show');
        const newOption = new Option(bankAccount, bankAccountID, false, false);
        $('#payment_account').append(newOption).val(bankAccountID).change();
        window.checkID = checkID;
    });
}

const addcheck = () => {
    $.get(GET_OTHER_MODAL_URL + 'check_modal', function (res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
				<div id="modal-container"> 
					${res}
				</div>
			`);
        }

        rowCount = 2;
        catDetailsInputs = $(`#checkModal .modal-body table#category-details-table tbody tr:first-child()`).html();
        catDetailsBlank = $(`#checkModal .modal-body table#category-details-table tbody tr:last-child()`).html();

        $(`#checkModal .modal-body table#category-details-table tbody tr:first-child()`).remove();
        $(`#checkModal .modal-body table#category-details-table tbody tr:last-child()`).remove();

        $(`#checkModal select`).each(function () {
            var type = $(this).attr('id');
            if (type === undefined) {
                type = $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-');
            } else {
                type = type.replaceAll('_', '-');

                if (type.includes('transfer')) {
                    type = 'transfer-account';
                }
            }

            const dropdownFields = [
                'customer',
                'payee',
                'expense-account',
                'category',
                'bank-account',
            ];

            if (dropdownFields.includes(type)) {
                $(this).select2({
                    ajax: {
                        url: base_url + 'accounting/get-dropdown-choices',
                        dataType: 'json',
                        data: function (params) {
                            var query = {
                                search: params.term,
                                type: 'public',
                                field: type,
                                modal: 'checkModal'
                            }

                            // Query parameters will be ?search=[term]&type=public&field=[type]
                            return query;
                        }
                    },
                    templateResult: formatResult,
                    templateSelection: optionSelect,
                    dropdownParent: $('#checkModal')
                });
            } else {
                $(this).select2({
                    minimumResultsForSearch: -1,
                    dropdownParent: $('#checkModal')
                });
            }
        });

        if ($('div#modal-container select#tags').length > 0) {
            $('div#modal-container select#tags').select2({
                placeholder: 'Start typing to add a tag',
                dropdownParent: $('#checkModal'),
                allowClear: true,
                ajax: {
                    url: '/accounting/get-job-tags',
                    dataType: 'json'
                }
            });
        }

        if ($(`#checkModal .date`).length > 0) {
            $(`#checkModal .date`).each(function () {
                $(this).datepicker({
                    format: 'mm/dd/yyyy',
                    orientation: 'bottom',
                    autoclose: true
                });
            });
        }

        if ($(`#checkModal .attachments`).length > 0) {
            var attachmentContId = $(`#checkModal .attachments .dropzone`).attr('id');
            modalAttachments = new Dropzone(`#${attachmentContId}`, {
                url: '/accounting/attachments/attach',
                maxFilesize: 20,
                uploadMultiple: true,
                // maxFiles: 1,
                addRemoveLinks: true,
                init: function () {
                    this.on("success", function (file, response) {
                        var ids = JSON.parse(response)['attachment_ids'];
                        var modal = $(`#checkModal`);

                        for (i in ids) {
                            if (modal.find(`input[name="attachments[]"][value="${ids[i]}"]`).length === 0) {
                                modal.find('.attachments').parent().append(`<input type="hidden" name="attachments[]" value="${ids[i]}">`);
                            }

                            modalAttachmentId.push(ids[i]);
                        }
                        modalAttachedFiles.push(file);
                    });
                },
                removedfile: function (file) {
                    var ids = modalAttachmentId;
                    var index = modalAttachedFiles.map(function (d, index) {
                        if (d == file) return index;
                    }).filter(isFinite)[0];

                    $(`#checkModal .attachments`).parent().find(`input[name="attachments[]"][value="${ids[index]}"]`).remove();

                    if ($('#modal-container form .modal .attachments-container').length > 0) {
                        $('#modal-container form .modal .attachments-container #attachment-types').trigger('change');
                    }

                    //remove thumbnail
                    var previewElement;
                    return (previewElement = file.previewElement) !== null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
                }
            });
        }

        if ($(`#checkModal .dropdown`).length > 0) {
            $(`#checkModal .dropdown-menu`).on('click', function (e) {
                e.stopPropagation();
            });
        }

        $('#checkModal').on('hidden.bs.modal', function () {
            $('#modal-container').remove();
            $('.modal-backdrop').remove();
        });

        $('#checkModal').modal('show');
    });
}

function load_print_check_modal() {
    $.get(base_url + 'accounting/get-other-modals/print_checks_modal', function (res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $(`#printChecksModal select`).each(function () {
            var type = $(this).attr('id');
            if (type === undefined) {
                type = $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-');
            } else {
                type = type.replaceAll('_', '-');

                if (type.includes('transfer')) {
                    type = 'transfer-account';
                }
            }

            if (type === 'payment-account') {
                $(this).select2({
                    ajax: {
                        url: base_url + 'accounting/get-dropdown-choices',
                        dataType: 'json',
                        data: function (params) {
                            var query = {
                                search: params.term,
                                type: 'public',
                                field: type,
                                modal: 'printChecksModal'
                            }

                            // Query parameters will be ?search=[term]&type=public&field=[type]
                            return query;
                        }
                    },
                    templateResult: formatResult,
                    templateSelection: optionSelect,
                    dropdownParent: $('#printChecksModal')
                });
            } else {
                $(this).select2({
                    minimumResultsForSearch: -1,
                    dropdownParent: $('#printChecksModal')
                });
            }
        });

        if ($(`#printChecksModal .dropdown`).length > 0) {
            $(`#printChecksModal .dropdown-menu`).on('click', function (e) {
                e.stopPropagation();
            });
        }

        $('#printChecksModal').on('hidden.bs.modal', function () {
            $('#modal-container').remove();
            $('.modal-backdrop').remove();
        });

        $('#printChecksModal').modal('show');
    });
}

const get_bill_payment_linkable_transactions = () => {
    if ($('#billPaymentModal').parent().attr('data-href') !== undefined) {
        var split = $('#billPaymentModal').parent().attr('data-href').split('/');
        var id = split[split.length - 1];

        var query = `?paymentid=${id}`;
    }
    $.get(`/accounting/get-linkable-transactions/bill-payment/${$('#billPaymentModal #vendor').val()}${query ? query : ''}`, function (res) {
        var transactions = JSON.parse(res);

        if (transactions.length > 0) {
            if ($('#billPaymentModal .transactions-container').length > 0) {
                $('#billPaymentModal .transactions-container').parent().remove();
                $('#billPaymentModal .close-transactions-container').parent().remove();
                $('#billPaymentModal .open-transactions-container').parent().remove();
            }

            $('#billPaymentModal .modal-body .row .col').children('.row:first-child').prepend(`
                <div class="col-12">
                    <button class="nsm-button close-transactions-container float-end" type="button"><i class="bx bx-fw bx-chevron-right"></i></button>
                </div>
            `);

            $('#billPaymentModal .modal-body').children('.row').append(`
                <div class="nsm-callout primary" style="width: 15%">
                    <div class="transactions-container h-100 p-3">
                        <div class="row">
                            <div class="col-12">
                                <h4>Add to Bill Payment</h4>
                            </div>
                        </div>
                    </div>
                </div>
            `);

            $.each(transactions, function (index, transaction) {
                if (transaction.type === 'Bill' && $(`#billPaymentModal #bills-table input.select-one[value="${transaction.id}"]:checked`).length === 0 ||
                    transaction.type === 'Vendor Credit' && $(`#billPaymentModal #vendor-credits-table tr[data-type="vendor-credit"] input.select-one[value="${transaction.id}"]:checked`).length === 0 ||
                    $('#billPaymentModal').parent().attr('data-href') === undefined && transaction.data_type === 'bill-payment' && $(`#billPaymentModal #vendor-credits-table tr[data-type="bill-payment"] input.select-one[value="${transaction.id}"]:checked`).length === 0 ||
                    $('#billPaymentModal').parent().attr('data-href') !== undefined && transaction.data_type === 'bill-payment' && transaction.id !== id
                ) {
                    var title = transaction.type;
                    title += transaction.number !== '' ? '#' + transaction.number : '';
                    $('#billPaymentModal .modal-body .row .nsm-callout .transactions-container .row').append(`
                        <div class="col-12 grid-mb">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">${title}</h5>
                                    <p class="card-subtitle">${transaction.formatted_date}</p>
                                    <p class="card-text">
                                        ${transaction.type === 'Purchase Order' ? `<strong>Total</strong>&emsp;${transaction.total}<br><strong>Balance</strong>&emsp;${transaction.balance}` : transaction.amount}
                                    </p>
                                    <ul class="d-flex justify-content-around list-unstyled">
                                        <li><a href="#" class="add-transaction text-decoration-none" data-id="${transaction.id}" data-type="${transaction.data_type}"><strong>Add</strong></a></li>
                                        <li><a href="#" class="open-transaction text-decoration-none" data-id="${transaction.id}" data-type="${transaction.data_type}">Open</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    `);
                }
            });

            if ($('#billPaymentModal .transactions-container .row .col-12').length < 2) {
                $('#billPaymentModal .transactions-container').parent().remove();
                $('#billPaymentModal .close-transactions-container').parent().remove();
                $('#billPaymentModal .open-transactions-container').parent().remove();
            }
        } else {
            $('#billPaymentModal .transactions-container').parent().remove();
            $('#billPaymentModal .close-transactions-container').parent().remove();
            $('#billPaymentModal .open-transactions-container').parent().remove();
        }
    });
}