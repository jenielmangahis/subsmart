const GET_OTHER_MODAL_URL = "/accounting/get-other-modals/";
const vendorModals = ['#expenseModal', '#checkModal', '#billModal', '#vendorCreditModal', '#purchaseOrderModal', '#creditCardCreditModal'];
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
var payroll =  {};

var modalAttachmentId = [];
var modalAttachedFiles = [];

var catDetailsInputs = '';
var catDetailsBlank = '';
var itemDetailsInputs = '';
var itemDetailsBlank = '';

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

        if(value !== "") {
            $('#adjust-starting-value-modal .modal-title span').html('#'+value);
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

        if(typeof split === "object" && split !== null) {
            split1 = split[0].length == 0 ? "00" : (split[0].length == 1 ? "0"+split[0] : split[0]);

            if(split[1].length > 0 && elVal.includes('.')) {
                var num = split[1].length === 1 ? parseInt(split[1]+"0") : parseInt(split[1]);

                var mins = parseInt(num * 60 / 100).toString();

                split2 = mins.length === 1 ? "0"+mins : mins;
            } else {
                split2 = split[1].length == 1 ? "0"+split[1] : (split[1].length == 0 ? "00" : split[1]);
            }
        } else if(split !== "" && elVal.length <= 2) {
            split1 = split.length == 1 ? "0"+split : split;
        }

        if(textRegex !== null) {
            $(this).val(split1+":"+split2);
        }

        if($(this).attr('id') !== 'time') {
            computeTotalHours();
        }
    });

    $(document).on('change', '#payDownCreditModal input#amount', function() {
        var amount = $(this).val();

        if(amount !== "") {
            $('#payDownCreditModal #total-amount-paid').html(`$${amount}`);
        } else {
            $('#payDownCreditModal #total-amount-paid').html('$0.00');
        }
    });

    $(document).on('change', 'table#payroll-table tbody tr td:nth-child(4) input[name="reg_pay_hours[]"], table#payroll-table tbody tr td:nth-child(5) input', function(){
        payrollRowTotal($(this));
        payrollTotal();
    });

    $(document).on('click', 'div#payrollModal div.modal-footer button#continue-payroll', function() {
        payroll.paySchedule = $('#payrollModal [name="pay_schedule"]:checked').val();
        payroll.paySchedForm = $('div#payrollModal div.modal-body .card-body').html();
        var paySchedName = $('#payrollModal [name="pay_schedule"]:checked').next().find('.pay_sched_name').html();
        if(payroll.paySchedule !== "" && payroll.paySchedule !== undefined) {
            $.get('/accounting/get-payroll-form/'+payroll.paySchedule, function(res) {
                $('div#payrollModal .modal-body .card-body').html(res);

                $('div#payrollModal .modal-header .modal-title').html('Run Payroll: '+paySchedName);
                $('div#payrollModal .modal-body .card-body select').select2();
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
                    {label:"Net Pay",value:netPayPercent},
                    {label:"Employee",value:employeeTaxPercent},
                    {label:"Employer",value:employerTaxPercent}
                ];
                var total = 100;
                var donut_chart = Morris.Donut({
                    element: 'payrollChart',
                    data:Data,
                    resize:true,
                    formatter: function (value, data) {
                    return Math.floor(value/total*100) + '%';
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
            if($(this).children('td:nth-child(4)').children('input').length === 0) {
                $(this).children('td:first-child()').children('div').children('input').prop('checked', false)
            }
        });

        $('div#payrollModal div.modal-body table tbody tr td:nth-child(4) input[name="reg_pay_hours[]"]').each(function(index,value) {
            $(this).val(payrollFormData.getAll('reg_pay_hours[]')[index]);
        });

        $('div#payrollModal div.modal-body table tbody tr td:nth-child(5) input[name="commission[]"]').each(function(index,value) {
            $(this).val(payrollFormData.getAll('commission[]')[index]);
        });

        $('div#payrollModal div.modal-body table tbody tr td:nth-child(6) input[name="memo[]"]').each(function(index,value) {
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

        if($(this).prop('checked')) {
            rows.each(function(){
                $(this).children('td:first-child()').children('div').children('input').prop('checked', true);

                if(table.attr('id') === 'payroll-table') {
                    $(this).children('td').each(function(index, value) {
                        if(index === 2) {
                            $(this).html('<a href="#" class="text-info">Paper check</a>');
                        } else if(index === 3) {
                            $(this).html('<input type="number" name="reg_pay_hours[]" step="0.01" class="form-control w-75 float-right text-right regular-pay-hours">');
                        } else if(index === 4) {
                            $(this).html('<input type="number" name="commission[]" step="0.01" class="form-control w-75 float-right text-right employee-commission">');
                        } else if(index === 5) {
                            $(this).html('<input type="text" name="memo[]" class="form-control">');
                        } else if(index === 6) {
                            $(this).html('<p class="text-right m-0">0.00</p>');
                        } else if(index === 7) {
                            $(this).html('<p class="text-right m-0">$<span class="total-pay">0.00</span></p>');
                        }
                    });
                }
            });
        } else {
            rows.each(function(){
                $(this).children('td:first-child()').children('div').children('input').prop('checked', false);

                if(table.attr('id') === 'payroll-table') {
                    $(this).children('td').each(function(index, value) {
                        if(index > 1) {
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

        if(table.attr('id') === 'payroll-table') {
            if($(this).prop('checked') === false) {
                $(this).parent().parent().parent().children('td').each(function(index, value) {
                    if(index > 1) {
                        $(this).html('');
                    }
                });
            } else {
                $(this).parent().parent().parent().children('td').each(function(index, value) {
                    if(index === 2) {
                        $(this).html('<a href="#" class="text-info">Paper check</a>');
                    } else if(index === 3) {
                        $(this).html('<input type="number" name="reg_pay_hours[]" step="0.01" class="form-control w-75 float-right text-right regular-pay-hours">');
                    } else if(index === 4) {
                        $(this).html('<input type="number" name="commission[]" step="0.01" class="form-control w-75 float-right text-right employee-commission">');
                    } else if(index === 5) {
                        $(this).html('<input type="text" name="memo[]" class="form-control">');
                    } else if(index === 6) {
                        $(this).html('<p class="text-right m-0">0.00</p>');
                    } else if(index === 7) {
                        $(this).html('<p class="text-right m-0">$<span class="total-pay">0.00</span></p>');
                    }
                });
            }
        }

        rows.each(function() {
            if($(this).children('td:first-child()').children('div').children('input').prop('checked') === false) {
                flag = false;
            }
        });

        checkbox.prop('checked', flag);
    });

    $(document).on('click', 'ul#accounting_order li a[data-toggle="modal"], ul#accounting_employees li a, ul#accounting_vendors li a', function(e) {
        e.preventDefault();
        var target = e.currentTarget.dataset;
        var view = target.view
        var modal_element = target.target;
        modalName = target.target;

        $.get(GET_OTHER_MODAL_URL+view, function(res) {
            if ($('div#modal-container').length > 0) {
                $('div#modal-container').html(res);
            } else {
                $('body').append(`
                    <div id="modal-container"> 
                        ${res}
                    </div>
                `);
            }

            if($('div#modal-container table:not(#category-details-table, #item-details-table)').length > 0) {
                rowCount = $('div#modal-container table tbody tr').length;
                rowInputs = $('div#modal-container table tbody tr:first-child()').html();
                blankRow = $('div#modal-container table tbody tr:nth-child(2)').html();

                $('div#modal-container table.clickable tbody tr:first-child()').html(blankRow);
                $('div#modal-container table.clickable tbody tr:first-child() td:nth-child(2)').html(1);
            }

            if(vendorModals.includes(modal_element)) {
                rowCount = 2;
                catDetailsInputs = $(`${modal_element} table#category-details-table tbody tr:first-child()`).html();
                catDetailsBlank = $(`${modal_element} table#category-details-table tbody tr:nth-child(2)`).html();
                // itemDetailsInputs = $(`${modal_element} table#item-details-table tbody tr:first-child()`).html();
                // itemDetailsBlank = $(`${modal_element} table#item-details-table tbody tr:nth-child(2)`).html();

                $(`${modal_element} table#category-details-table tbody tr:first-child()`).html(catDetailsBlank);
                $(`${modal_element} table#category-details-table tbody tr:first-child() td:nth-child(2)`).html(1);

                if($(`${modal_element} table#category-details-table tbody tr`).length > 2) {
                    $(`${modal_element} table#category-details-table tbody tr:first-child()`).remove();
                }

                // $(`${modal_element} table#item-details-table tbody tr:first-child()`).html(itemDetailsBlank);
                // $(`${modal_element} table#item-details-table tbody tr:first-child() td:nth-child(2)`).html(1);
            }

            $(`${modal_element} select`).select2();

            if($('div#modal-container select#tags').length > 0) {
                $('div#modal-container select#tags').select2({
                    placeholder: 'Start typing to add a tag',
                    allowClear: true,
                    ajax: {
                        url: '/accounting/get-job-tags',
                        dataType: 'json'
                    }
                });
            }
            if(view === "weekly_timesheet_modal") {
                tableWeekDate(document.getElementById('weekDates'));
            }

            if($(`${modal_element} .date`).length > 0) {
                $(`${modal_element} .date`).each(function(){
                    $(this).datepicker({
                        uiLibrary: 'bootstrap'
                    });
                });
            }

            if($(`${modal_element} .attachments`).length > 0) {
                var attachmentContId = $(`${modal_element} .attachments .dropzone`).attr('id');
                var attachments = new Dropzone(`#${attachmentContId}`, {
                    url: '/accounting/attachments/attach',
                    maxFilesize: 20,
                    uploadMultiple: true,
                    // maxFiles: 1,
                    addRemoveLinks: true,
                    init: function() {
                        this.on("success", function(file, response) {
                            var ids = JSON.parse(response)['attachment_ids'];
                            var modal = $(`${modal_element}`);

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
                
                        $(`${modal_element} .attachments`).parent().find(`input[name="attachments[]"][value="${ids[index]}"]`).remove();
                
                        //remove thumbnail
                        var previewElement;
                        return (previewElement = file.previewElement) !== null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
                    }
                });
            }

            if($(`${modal_element} .dropdown`).length > 0) {
                $(`${modal_element} .dropdown-menu`).on('click', function(e) {
                    e.stopPropagation();
                });
            }

            if(modal_element === '#payBillsModal') {
                loadBills();
            }

            $(modal_element).modal('show');
            $(document).off('shown', modal_element);
        });
    });

    $(document).on('hide.bs.modal', '#tags-modal', function(e) {
        if($('div#modal-container').next('.modal-backdrop').length > 0 || 
            $('div#modal-container').next().next('.modal-backdrop').length > 0
        ) {
            $('div#modal-container').next('.modal-backdrop').remove();
            $('div#modal-container').next().next('.modal-backdrop').remove();
        }
    });

    $(document).on('change', 'div#depositModal select#bankAccount', function() {
        var value = $(this).val();

        $.get('/accounting/get-account-balance/'+value, function(res) {
            var result = JSON.parse(res);

            $('div#depositModal span#account-balance').html(result.balance);
        });
    });

    $(document).on('change', 'div#transferModal select#transferFrom, div#transferModal select#transferTo', function() {
        var value = $(this).val();
        var id = $(this).attr('id');

        $.get('/accounting/get-account-balance/'+value, function(res) {
            var result = JSON.parse(res);

            $(`div#transferModal h3#${id}Balance`).html(result.balance);
        });
    });

    $(document).on('change', 'div#payrollModal select#payFrom', function() {
        var value = $(this).val();
        var el = $(this);
        
        $.get('/accounting/get-account-balance/'+value, function(res) {
            var result = JSON.parse(res);

            el.parent().parent().next().children('h6').html('Balance '+result.balance);
        });
    });

    $(document).on('click', '#modal-container a#open-tags-modal', function(e) {
        e.preventDefault();
        var target = e.currentTarget.dataset;
        var modal_element = target.target;

        $.get('/accounting/get-job-tag-modal/', function(res) {
            if($('#tags-modal').length > 0) {
                $('#tags-modal').remove();
            }

            if($('div#modal-container').next('.modal-backdrop').length > 0 || 
                $('div#modal-container').next().next('.modal-backdrop').length > 0
            ) {
                $('div#modal-container').next('.modal-backdrop').remove();
                $('div#modal-container').next().next('.modal-backdrop').remove();
            }

            $('div#modal-container').append(res);
            tagsListModal = $('#tags-modal div.modal-dialog div#tags-list').html();
            if(!$.fn.dataTable.isDataTable('#tags-table')) {
                loadTagsDataTable();
            } else {
                $('#tags-table').DataTable().ajax.reload();
            }
            $(modal_element).modal('show');
        });
    });

    $(document).on('keyup', 'div#journalEntryModal input#journalNo', function() {
        if($(this).val() !== "") {
            var val = $(this).val();
            $('div#journalEntryModal h4.modal-title').html(`Journal Entry #${val}`);
        } else {
            $('div#journalEntryModal h4.modal-title').html('Journal Entry');
        }
    });

    $(document).on('click', `div#modal-container .full-screen-modal table.clickable:not(#category-details-table,#item-details-table) tbody tr`, function() {
        if($(this).find('input').length < 1) {
            var rowNum = $(this).children().next().html();

            $(this).html(rowInputs);
            $(this).children('td:nth-child(2)').html(rowNum);

            $(this).find('select').select2();
        }
    });

    $(document).on('click', 'div#modal-container table#category-details-table tbody tr', function() {
        if($(this).find('input').length < 1) {
            var rowNum = $(this).children().next().html();

            $(this).html(catDetailsInputs);
            $(this).children('td:nth-child(2)').html(rowNum);

            $(this).find('select').select2();
        }
    });

    // $(document).on('click', 'div#modal-container table#item-details-table tbody tr', function() {
    //     if($(this).find('input').length < 1) {
    //         var rowNum = $(this).children().next().html();

    //         $(this).html(itemDetailsInputs);
    //         $(this).children('td:nth-child(2)').html(rowNum);

    //         $(this).find('select').select2();
    //     }
    // });

    $(document).on('click', 'div#modal-container table.clickable:not(#category-details-table,#item-details-table) tbody tr td a.deleteRow', function() {
        $(this).parent().parent().remove();
        if($('div#modal-container table tbody tr').length < rowCount) {
            $('div#modal-container table tbody').append(`<tr>${blankRow}</tr>`);
        } 

        var num = 1;
    
        $('div#modal-container table tbody tr').each(function() {
            $(this).children('td:nth-child(2)').html(num);
            num++;
        });

        if(modalName === '#depositModal') {
            updateBankDepositTotal();
        }
    });

    $(document).on('click', '#modal-container #category-details-table tbody tr td a.deleteRow', function() {
        $(this).parent().parent().remove();

        if($('#category-details-table tbody tr').length < rowCount) {
            $('#category-details-table tbody').append(`<tr>${catDetailsBlank}</tr>`);
        }

        var num = 1;
    
        $('#category-details-table tbody tr').each(function() {
            $(this).children('td:nth-child(2)').html(num);
            num++;
        });

        computeTransactionTotal();
    });

    $(document).on('click', '#modal-container #item-details-table tbody tr td a.deleteRow', function() {
        $(this).parent().parent().remove();

        computeTransactionTotal();
    });

    $(document).on('keyup', '#search-tag', function(){
        $('#tags-table').DataTable().ajax.reload();
    });

    $(document).on('click', 'div#tags-modal table#tags-table tbody tr td a.edit', function(e) {
        e.preventDefault();

        if(e.currentTarget.dataset.type === 'group') {
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

        for(var i = 0; i < rowCount; i++) {
            lastRowCount++;
            $(`table${table} tbody`).append(`<tr>${rowInputs}</tr>`);
            $(`table${table} tbody tr:last-child() td:first-child()`).html(lastRowCount);
        }
    });

    $(document).on('click', 'div#weeklyTimesheetModal button#clear-table-line', function(e) {
        e.preventDefault();
        var table = e.currentTarget.dataset.target;

        $(`table${table} tbody tr`).each(function() {
            $(this).remove();
        });

        for(var num = 1; num <= rowCount; num++) {
            $(`table${table} tbody`).append(`<tr>${rowInputs}</tr>`);
            $(`table${table} tbody tr:last-child() td:first-child()`).html(num);
        }

        computeTotalHours();
    });

    $(document).on('click', 'div#modal-container table#timesheet-table tbody tr td a.deleteRow', function() {
        $(this).parent().parent().remove();
        if($('div#modal-container table tbody tr').length < rowCount) {
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

        if($(this).attr('name') === 'debits[]') {
            $(this).parent().parent().children('td:nth-child(5)').children('input').val('');
        } else {
            $(this).parent().parent().children('td:nth-child(4)').children('input').val('');
        }

        var debit = 0.00;
        var credit = 0.00;

        $('div#journalEntryModal table#journal-table input[name="debits[]"]').each(function() {
            var rowDebit = $(this).val();
            if(rowDebit !== "" && rowDebit !== undefined) {
                rowDebit = parseFloat(rowDebit);
            } else {
                rowDebit = 0.00;
            }

            debit = parseFloat(parseFloat(debit) + rowDebit).toFixed(2);
        });

        $('div#journalEntryModal table#journal-table input[name="credits[]"]').each(function() {
            var rowCredit = $(this).val();
            if(rowCredit !== "" && rowCredit !== undefined) {
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

        if($(this).attr('id') === 'statementType') {
            if($(this).val() === '2') {
                $('div#statementModal select#customerBalanceStatus option[value="all"]').remove();
            } else {
                if($('div#statementModal select#customerBalanceStatus option[value="all"]').length === 0) {
                    $('div#statementModal select#customerBalanceStatus').prepend('<option value="all">All</option>');
                }
            }
        }
    });

    $(document).on('change', 'div#statementModal div.modal-body select#statementType', function() {
        if($(this).val() === '2') {
            $('div#statementModal div.modal-body div.card-body div.row:nth-child(3) div:nth-child(2) div').remove();
            $('div#statementModal div.modal-body div.card-body div.row:nth-child(3) div:nth-child(3) div').remove();
        } else {
            var today = new Date();
            var todayDate = String(today.getDate()).padStart(2, '0');
            var todayMonth = String(today.getMonth() + 1).padStart(2, '0');
            today = todayMonth+'/'+todayDate+'/'+today.getFullYear();

            var startDate = new Date();
            startDate.setMonth(startDate.getMonth() - 1);
            var startDateDay = String(startDate.getDate()).padStart(2, '0');
            var startDateMonth = String(startDate.getMonth() + 1).padStart(2, '0');
            startDate = startDateMonth+'/'+startDateDay+'/'+startDate.getFullYear();

            if($('div#statementModal div.modal-body div.card-body div.row:nth-child(3) div:nth-child(2) div').length === 0) {
                $('div#statementModal div.modal-body div.card-body div.row:nth-child(3) div:nth-child(2)').html('<div class="form-group"></div>');
                $('div#statementModal div.modal-body div.card-body div.row:nth-child(3) div:nth-child(2) div').append('<label for="startDate">Start Date</label>');
                $('div#statementModal div.modal-body div.card-body div.row:nth-child(3) div:nth-child(2) div').append(`<input onchange="showApplyButton()" type="text" class="form-control date" name="start_date" id="startDate" value="${startDate}"/>`);

                $(`#statementModal input#startDate`).datepicker({
                    uiLibrary: 'bootstrap'
                });
            }

            if($('div#statementModal div.modal-body div.card-body div.row:nth-child(3) div:nth-child(3) div').length === 0) {
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
        
        if(
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

                if(withoutEmail.length > 0) {
                    for(i in withoutEmail) {
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

                    if($('div#statementModal div#missing-email div.no-results').length > 0) {
                        $('div#statementModal div#missing-email div.no-results').each(function(){
                            $(this).remove();
                        });
                    }
                }

                if(customers.length > 0) {
                    for(i in customers) {
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

                    if($('div#statementModal div#statements-avail div.no-results').length > 0) {
                        $('div#statementModal div#statements-avail div.no-results').each(function(){
                            $(this).remove();
                        });
                    }
                }

                if(withoutEmail.length === 0 && $('div#statementModal div#missing-email div.no-results').length === 0) {
                    $('div#statementModal table#missing-email-table').parent().append(noRecordMessage);
                }

                if(customers.length === 0 && $('div#statementModal div#statements-avail div.no-results').length === 0) {
                    $('div#statementModal table#statements-table').parent().append(noRecordMessage);
                }

                $('div#statementModal div.modal-body button.apply-button').addClass('hide');
                $('div#statementModal div.modal-body div.row:last-child()').removeClass('hide');
            }
        });
    });

    $(document).on('change', 'div#statementModal table tbody input.customer-email', function(){
        var name = $(this).prop('name');
        var value = $(this).val();

        if(name.includes('no_email')) {
            name = name.replace('no_', '');
        } else {
            name = "no_" + name;
        }

        $(`div#statementModal table tbody input[name="${name}"]`).each(function(){
            $(this).val(value);
        });
    });

    $(document).on('change', 'div#statementModal table tbody input.select-customer', function(){
        var name = $(this).prop('name');
        var value = $(this).val();
        var checked = $(this).prop('checked');
        var tableName = 'missing-email-table';
        var flag = true;

        if(name.includes('missing_email')) {
            tableName = 'statements-table';
        }

        var rows = $(`div#statementModal table#${tableName} tbody tr`);
        var checkbox = $(`div#statementModal table#${tableName} thead tr th:first-child() div input`);
        $(`div#statementModal table#${tableName} tbody tr td:first-child() div input[value="${value}"]`).prop('checked', checked);
        rows.each(function() {
            if($(this).children('td:first-child()').children('div').children('input').prop('checked') === false) {
                flag = false;
            }
        });

        checkbox.prop('checked', flag);
    });

    $(document).on('change', 'div#singleTimeModal select#startTime, div#singleTimeModal select#endTime, div#singleTimeModal input#time', function() {
        var date = $('div#singleTimeModal input#date').val();
        var time = $('div#singleTimeModal input#time').val();
        var timeSplit = time !== "" ? time.split(':') : "";
        var hour = 0;
        var minutes = 0;

        if($('div#singleTimeModal input#startEndTime').prop('checked') === false && $(this).attr('id') === 'time') {
            hour = parseInt(timeSplit[0]);
            minutes = parseInt(timeSplit[1]);
        } else if($('div#singleTimeModal input#startEndTime').prop('checked') === true) {
            var startTime = $('div#singleTimeModal select#startTime').val();
            var endTime = $('div#singleTimeModal select#endTime').val();

            if(startTime !== "" && endTime !== "") {
                var start = new Date(date + " " + startTime).getTime();
                var end = new Date(date + " " + endTime).getTime();
                var duration = end - start;
                hour = Math.floor((duration / (1000 * 60 * 60)) % 24);
                minutes = Math.floor((duration / (1000 * 60)) % 60);
    
                hour = hour < 0 ? hour + 24 : hour;
                minutes = minutes < 0 ? minutes + 60 : minutes;

                if(timeSplit !== "") {
                    hour = hour - parseInt(timeSplit[0]);
                    minutes = minutes - parseInt(timeSplit[1]);

                    if(minutes < 0) {
                        for(i = 1; minutes < 0; i++) {
                            minutes = minutes + 60;
                            hour = hour - 1;
                        }
                    }
                }
            }
        }

        var hourText = hour > 1 ? 'hours' : hour !== 0 ? 'hour' : '';
        var minuteText = minutes > 1 ? 'minutes' : minutes !== 0 ? 'minute' : '';
        var summary = hour > 0 ? hour : '';
        summary += ' ' + hourText + ' ';
        summary += minutes > 0 ? minutes : '';
        summary += ' ' + minuteText;

        if(summary.trim() !== "") {
            if($('div#singleTimeModal div.modal-body div.row:nth-child(2) div.col-md-5 div#summary').length === 0){
                $('div#singleTimeModal div.modal-body div.row:nth-child(2) div.col-md-5').append(`
                <div class="form-group" id="summary">
                    <label for="summary">Summary</label>
                    <p>${summary.trim()}</p>
                </div>`);
            } else {
                $('div#singleTimeModal div.modal-body div.row:nth-child(2) div.col-md-5 div#summary p').html(summary.trim());
            }
        }
    });

    $(document).on('change', 'div.modal select#recurringType', function() {
        if($(this).val() === 'reminder') {
            if($(this).parent().next().hasClass('col-md-3')) {
                $(this).parent().next().removeClass('col-md-3');
                $(this).parent().next().addClass('col-md-4');
            }

            $(this).parent().next().children('div').children('div').html(`
                <span>Remind &nbsp;</span>
                <input type="number" name="days_in_advance" id="dayInAdvance" class="form-control" style="width: 20%">
                <span>&nbsp; days before the transaction date</span>
            `);

            if($('form#modal-form div.modal div.modal-body select#recurringInterval, form#update-recurring-form div.modal div.modal-body select#recurringInterval').length === 0) {
                if($('form#modal-form, form#update-recurring-form').children('.modal').attr('id') === 'depositModal') {
                    $('<div class="row recurring-interval-container"></div>').insertAfter($('div.modal div.modal-body div.recurring-bank-account'));
                    $('div.modal div.modal-body div.recurring-interval-container').html(recurrInterval);
                } else {
                    $('<div class="row recurring-interval-container"></div>').insertAfter($('div.modal div.modal-body div.recurring-details'));
                    $('div.modal div.modal-body div.recurring-interval-container').html(recurrInterval);
                }

                $(`div.modal input.date`).datepicker({
                    uiLibrary: 'bootstrap'
                });
            }
        } else if($(this).val() === 'unscheduled') {
            $('div.modal div.modal-body div.recurring-interval-container').remove();
            $(this).parent().next().removeClass('col-md-4');
            $(this).parent().next().addClass('col-md-3');
            $(this).parent().next().children('div').children('div').html(`
                <p class="m-0">Unscheduled transactions don’t have timetables; you use them as needed from the Recurring Transactions list.</p>
            `);
        } else {
            if($(this).parent().next().hasClass('col-md-3')) {
                $(this).parent().next().removeClass('col-md-3');
                $(this).parent().next().addClass('col-md-4');
            }

            $(this).parent().next().children('div').children('div').html(`
                <span>Create &nbsp;</span>
                <input type="number" name="days_in_advance" id="dayInAdvance" class="form-control" style="width: 20%">
                <span>&nbsp; days in advance</span>
            `);

            if($('form#modal-form div.modal div.modal-body select#recurringInterval, form#update-recurring-form div.modal div.modal-body select#recurringInterval').length === 0) {
                if($('form#modal-form, form#update-recurring-form').children('.modal').attr('id') === 'depositModal') {
                    $('<div class="row recurring-interval-container"></div>').insertAfter($('div.modal div.modal-body div.recurring-bank-account'));
                    $('div.modal div.modal-body div.recurring-interval-container').html(recurrInterval);
                } else {
                    $('<div class="row recurring-interval-container"></div>').insertAfter($('div.modal div.modal-body div.recurring-details'));
                    $('div.modal div.modal-body div.recurring-interval-container').html(recurrInterval);
                }

                $(`div.modal input.date`).datepicker({
                    uiLibrary: 'bootstrap'
                });
            }
        }
    });

    $(document).on('change', 'div.modal select[name="recurring_week"]', function(){
        if($(this).val() !== 'day') {
            $(this).next().html(`
                <option value="sunday">Sunday</option>
                <option value="monday" selected>Monday</option>
                <option value="tuesday">Tuesday</option>
                <option value="wednesday">Wednesday</option>
                <option value="thursday">Thursday</option>
                <option value="friday">Friday</option>
                <option value="saturday">Saturday</option>
            `);
        } else {
            $(this).next().html(recurringDays);
        }
    });

    $(document).on('change', 'div.modal select#endType', function(){
        if($(this).val() === 'by') {
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
        } else if($(this).val() === 'after') {
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

    $(document).on('change', 'div.modal select#recurringInterval', function(){
        var fields = '';
        if($(this).val() === 'daily') {
            if($(this).parent().next().hasClass('col-md-4')) {
                $(this).parent().next().removeClass('col-md-4');
            } else if($(this).parent().next().hasClass('col-md-3')) {
                $(this).parent().next().removeClass('col-md-3');
            }

            if($(this).parent().next().hasClass('col-md-2') === false) {
                $(this).parent().next().addClass('col-md-2');
            }

            fields = `
                <span>&nbsp; every &nbsp;</span>
                <input type="number" value="1" class="form-control" name="recurr_every" style="width: 30%">
                <span>&nbsp; day(s)</span>
            `;
        } else if($(this).val() === 'weekly') {
            if($(this).parent().next().hasClass('col-md-4')) {
                $(this).parent().next().removeClass('col-md-4');
            } else if($(this).parent().next().hasClass('col-md-2')) {
                $(this).parent().next().removeClass('col-md-2');
            }

            if($(this).parent().next().hasClass('col-md-3') === false) {
                $(this).parent().next().addClass('col-md-3');
            }

            fields = `
                <span>&nbsp; every &nbsp;</span>
                <input type="number" value="1" class="form-control" name="recurr_every" style="width: 20%">
                <span>&nbsp; week(s) on &nbsp;</span>
                <select class="form-control" name="recurring_day" style="width: auto">
                    <option value="sunday">Sunday</option>
                    <option value="monday" selected>Monday</option>
                    <option value="tuesday">Tuesday</option>
                    <option value="wednesday">Wednesday</option>
                    <option value="thursday">Thursday</option>
                    <option value="friday">Friday</option>
                    <option value="saturday">Saturday</option>
                </select>
            `;
        } else if($(this).val() === 'yearly') {
            if($(this).parent().next().hasClass('col-md-4')) {
                $(this).parent().next().removeClass('col-md-4');
            } else if($(this).parent().next().hasClass('col-md-2')) {
                $(this).parent().next().removeClass('col-md-2');
            }

            if($(this).parent().next().hasClass('col-md-3') === false) {
                $(this).parent().next().addClass('col-md-3');
            }

            fields = `
                <span>&nbsp; every &nbsp;</span>
                <select class="form-control" name="recurring_month" style="width: 40%">
                    <option value="January">January</option>
                    <option value="February">February</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                </select>
                <select class="form-control" name="recurring_day" style="width: 40%">
                ${recurringDays}
                </select>
            `;
        } else {
            if($(this).parent().next().hasClass('col-md-3')) {
                $(this).parent().next().removeClass('col-md-3');
            } else if($(this).parent().next().hasClass('col-md-2')) {
                $(this).parent().next().removeClass('col-md-2');
            }

            if($(this).parent().next().hasClass('col-md-4') === false) {
                $(this).parent().next().addClass('col-md-4');
            }

            fields = monthlyRecurrFields;
        }

        $(this).parent().next().children().children().html(fields);
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

        if(data.customers.length > 0) {
            flag = true;
        }

        if(flag === true) {
            $.ajax({
                url: '/accounting/send-email-form/',
                data: {json: JSON.stringify(data)},
                type: 'post',
                success: function(res) {
                    if($('#statementModal').parent().children('#showEmailModal').length > 0) {
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
        if($('#tags-modal #update-group-form').length === 0) {
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
            url:`/accounting/update-group-tag/${data.get('group_id')}/group`,
            data: {name: data.get('tags_group_name')},
            type:"POST",
            dataType: "json",
            success:function (res) {
                if(form.attr('id') === 'update-group-form') {
                    form.addClass('hide');
                    form.next().children('tbody').children('tr').remove();
                    form.next().children('tbody').append(`<tr><td><span>${data.get('tags_group_name')}</span><a href="#" class="float-right text-info">Edit</a></td></tr>`);

                    form.next().removeClass('hide');
                } else {
                    console.log(res);

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
            url:`/accounting/update-group-tag/${data.get('tag_id')}/tag`,
            data: {name: data.get('update_tag_name')},
            type:"POST",
            dataType: "json",
            success:function (res) {
                form.addClass('hide');

                form.prev().children('span').html(data.get('update_tag_name'));
                form.prev().removeClass('hide');
            }
        });
    });

    $(document).on('change', '#inventory-adjustments-table select[name="product[]"]', function() {
        var input = $(this);

        $.get(`/accounting/get-item-details/${input.val()}`, function(res) {
            var result = JSON.parse(res);

            input.parent().next().html(result.item.description);

            input.parent().next().next().children('select').html('<option value="" disabled selected>&nbsp;</option>');
            for(i in result.locations) {
                input.parent().next().next().children('select').append(`<option value="${result.locations[i].id}" data-quantity="${result.locations[i].qty}">${result.locations[i].name}</option>`);
            }
        });
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
        if($(this).attr('name') === 'new_qty[]') {
            var changeInQty = parseInt(value) - parseInt($(this).parent().prev().html());
            $(this).parent().parent().find('[name="change_in_qty[]"]').val(changeInQty);
        } else {
            var newQty = parseInt($(this).parent().prev().prev().html()) + parseInt(value);
            $(this).parent().parent().find('[name="new_qty[]"]').val(newQty);
        }
    });

    // Expenses modal
    $(document).on('click', '#modal-container .modal .btn[data-toggle="collapse"]', function(e) {
        if($(this).attr('aria-expanded') === 'true') {
            $(this).children('i').addClass('fa-caret-down').removeClass('fa-caret-right');
        } else {
            $(this).children('i').addClass('fa-caret-right').removeClass('fa-caret-down');
        }
    });

    $(document).on('change', '#expenseModal #ref_no', function() {
        if($(this).val() !== "") {
            $('#expenseModal .modal-title span').html('#'+$(this).val());
        } else {
            $('#expenseModal .modal-title span').html('');
        }
    });

    $(document).on('change', '#creditCardCreditModal #ref_no', function() {
        if($(this).val() !== "") {
            $('#creditCardCreditModal .modal-title span').html('#'+$(this).val());
        } else {
            $('#creditCardCreditModal .modal-title span').html('');
        }
    });

    $(document).on('change', '#checkModal #print_later', function() {
        if($(this).prop('checked')) {
            $('#checkModal #check_no').prop('disabled', true);
            $('#checkModal #check_no').val('To print').trigger('change');
        } else {
            $('#checkModal #check_no').prop('disabled', false);
            $('#checkModal #check_no').val('').trigger('change');
        }
    });

    $(document).on('change', '#checkModal #check_no', function() {
        if($(this).val() !== "") {
            $('#checkModal .modal-title span').html('#'+$(this).val());
        } else {
            $('#checkModal .modal-title span').html('');
        }
    });

    $(document).on('change', '#modal-container table#category-details-table input[name="category_amount[]"]', function() {
        computeTransactionTotal();
    });

    // $(document).on('change', '#modal-container table#category-details-table input[name="category_billable[]"], #modal-container table#item-details-table input[name="item_billable[]"]', function() {
    //     if($(this).prop('checked')) {
    //         $(this).parent().parent().parent().find('select[name="category_customer[]"]').prop('required', true);
    //         $(this).parent().parent().parent().find('select[name="item_customer[]"]').prop('required', true);
    //     } else {
    //         $(this).parent().parent().parent().find('select[name="category_customer[]"]').prop('required', false);
    //         $(this).parent().parent().parent().find('select[name="item_customer[]"]').prop('required', false);
    //     }
    // });

    $(document).on('change', '#modal-container table#category-details-table input[name="category_billable[]"]', function() {
        if($(this).prop('checked')) {
            $(this).parent().parent().parent().find('select[name="category_customer[]"]').prop('required', true);
        } else {
            $(this).parent().parent().parent().find('select[name="category_customer[]"]').prop('required', false);
        }
    });

    // $(document).on('change', '#modal-container table#category-details-table input[name="category_tax[]"], #modal-container table#item-details-table input[name="item_tax[]"]', function() {
    //     $(this).parent().parent().parent().find('input[name="category_billable[]"]').prop('checked', true).trigger('change');
    //     $(this).parent().parent().parent().find('input[name="item_billable[]"]').prop('checked', true).trigger('change');
    // });

    $(document).on('change', '#modal-container table#category-details-table input[name="category_tax[]"]', function() {
        $(this).parent().parent().parent().find('input[name="category_billable[]"]').prop('checked', true).trigger('change');
    });

    // $(document).on('change', '#modal-container table#item-details-table select[name="item[]"]', function() {
    //     var el = $(this);
    //     if(el.val() !== "") {
    //         $.get('/accounting/get-item-details/'+el.val(), function(res) {
    //             var result = JSON.parse(res);
    //             var item = result.item;

    //             el.parent().parent().find('input[name="item_description[]"]').val(item.description);
    //             el.parent().parent().find('input[name="quantity[]"]').val(1);
    //             el.parent().parent().find('input[name="rate[]"]').val(item.cost).trigger('change');
    //             el.parent().parent().find('input[name="item_amount[]"]').val(item.cost).trigger('change');
    //         });
    //     } else {
    //         el.parent().parent().find('input[name="item_description[]"]').val('');
    //         el.parent().parent().find('input[name="quantity[]"]').val('');
    //         el.parent().parent().find('input[name="rate[]"]').val('');
    //         el.parent().parent().find('input[name="item_amount[]"]').val('');
    //     }
    // });

    // $(document).on('change', '#modal-container table#item-details-table input[name="item_markup[]"]', function() {
    //     var value = $(this).val();
    //     var amount = $(this).parent().parent().find('input[name="item_amount[]"]').val();
    //     var billable = $(this).parent().parent().find('input[name="item_billable[]"]').prop('checked');

    //     if(value !== "0" && value !== "" && billable && amount !== "" && amount !== 0.00) {
    //         var percent = parseFloat((parseFloat(amount) / 100) * parseFloat(value));
    //         var salesAmount = parseFloat(parseFloat(amount) + percent).toFixed(2);
    //     } else {
    //         var salesAmount = '';
    //     }

    //     $(this).parent().parent().find('input[name="item_sales_amount[]"]').val(salesAmount);
    // });

    // $(document).on('change', '#modal-container table#item-details-table input[name="item_amount[]"]', function() {
    //     if($(this).parent().parent().find('input[name="item_billable[]"]').prop('checked')) {
    //         $(this).parent().parent().find('input[name="item_markup[]"]').trigger('change');
    //     }
    // });

    $(document).on('change', '#expenseModal #payment_account', function() {
        var id = $(this).val();

        $.get('/accounting/get-account-balance/'+id, function(res) {
            var result = JSON.parse(res);

            $('#expenseModal span#account-balance').html(result.balance);
        });
    });

    $(document).on('change', '#creditCardCreditModal #bank_credit_account', function() {
        var id = $(this).val();

        $.get('/accounting/get-account-balance/'+id, function(res) {
            var result = JSON.parse(res);

            $('#creditCardCreditModal span#account-balance').html(result.balance);
        });
    });

    $(document).on('change', '#checkModal #bank_account', function() {
        var id = $(this).val();

        $.get('/accounting/get-account-balance/'+id, function(res) {
            var result = JSON.parse(res);

            $('#checkModal span#account-balance').html(result.balance);
        });
    });

    $(document).on('change', '#payBillsModal #table_rows', function() {
        applybillsfilter();
    });

    // $(document).on('change', '#modal-container table#item-details-table input[name="quantity[]"], #modal-container table#item-details-table input[name="rate[]"]', function() {
    //     var quantity = $(this).parent().parent().find('input[name="quantity[]"]').val();
    //     var rate = $(this).parent().parent().find('input[name="rate[]"]').val();

    //     var amount = parseFloat(parseFloat(rate) * parseInt(quantity)).toFixed(2);

    //     $(this).parent().parent().find('input[name="item_amount[]"]').val(amount).trigger('change');
    // });

    $(document).on('change', '#modal-container table#item-details-table tbody tr input', function() {
        var quantity = $(this).parent().parent().find('input[name="quantity[]"]').val();
        var price = $(this).parent().parent().find('input[name="item_amount[]"]').val();
        var taxPercentage = $(this).parent().parent().find('input[name="item_tax[]"]').val();
        var discount = $(this).parent().parent().find('input[name="discount[]"]').val();
        var amount = parseFloat(parseFloat(price) * parseInt(quantity)).toFixed(2);
        var taxAmount = parseFloat(taxPercentage) * amount / 100;
        var total = parseFloat(parseFloat(amount) + parseFloat(taxAmount) - parseFloat(discount)).toFixed(2);

        $(this).parent().parent().find('td span.row-total').html(total);
        computeTransactionTotal();
    });

    $(document).on('click', '#modal-container a#add_another_items', function(e) {
        e.preventDefault();

        if($('#modal-container #item_list.modal').length === 0) {
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

        $.get('/accounting/get-item-details/'+id, function(res) {
            var result = JSON.parse(res);
            var item = result.item;
            var locations = result.locations;
            var locs = '';

            for(var i in locations) {
                locs += `<option value="${locations[i].id}" data-quantity="${locations[i].qty === "null" ? 0 : locations[i].qty}">${locations[i].name}</option>`;
            }

            if($('#modal-container form#modal-form .modal').attr('id') === 'creditCardCreditModal' || $('#modal-container form#modal-form .modal').attr('id') === 'vendorCreditModal') {
                var qtyField = `<input type="number" name="quantity[]" class="form-control text-right" required value="0" max="${locations[0].qty}">`;
            } else {
                var qtyField = `<input type="number" name="quantity[]" class="form-control text-right" required value="0">`;
            }

            if($('#modal-container form#modal-form .modal').attr('id') === 'purchaseOrderModal' && $('#modal-container #item-details-table thead th').length > 9) {
                var fields = `
                    <td>${item.title}<input type="hidden" name="item[]" value="${item.id}"></td>
                    <td>Product</td>
                    <td><select name="location[]" class="form-control" required>${locs}</select></td>
                    <td>${qtyField}</td>
                    <td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="${item.price}"></td>
                    <td><input type="number" name="discount[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="0.00"></td>
                    <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="7.50"></td>
                    <td>$<span class="row-total">0.00</span></td>
                    <td class="text-right">0</td>
                    <td>
                        <div class="d-flex align-items-center justify-content-center">
                            <input type="checkbox" name="item_closed[]" class="form-check" value="1">
                        </div>
                    </td>
                    <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
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
                    <td>$<span class="row-total">0.00</span></td>
                    <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
                `;
            }

            $('#modal-container form#modal-form .modal #item-details-table tbody').append(`<tr></tr>`);
            $('#modal-container form#modal-form .modal #item-details-table tbody tr:last-child').append(fields);
            $('#modal-container form#modal-form .modal #item-details-table tbody tr:last-child select').select2();
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

    $(document).on('change', '#billModal #terms', function() {
        var billDate = new Date($('#billModal #bill_date').val());
        var dueDate = new Date(`${billDate.getMonth()+1}/${billDate.getDate()}/${billDate.getFullYear()}`);
        $.get('/accounting/get-term-details/'+$(this).val(), function(res) {
            var term = JSON.parse(res);

            if(term.type === "1") {
                dueDate.setDate(dueDate.getDate() + parseInt(term.net_due_days));
            } else {
                if(
                    term.minimum_days_to_pay === null ||
                    term.minimum_days_to_pay === "" ||
                    term.minimum_days_to_pay === "0"
                ) {
                    dueDate.setDate(term.day_of_month_due);
                    if(billDate.getDate() > parseInt(term.day_of_month_due)) {
                        dueDate.setMonth(dueDate.getMonth() + 1);
                    }
                } else {
                    var expectedDue = new Date(`${dueDate.getMonth()+1}/${dueDate.getDate()}/${dueDate.getFullYear()}`);
                    expectedDue.setDate(parseInt(term.day_of_month_due));
                    expectedDue.setDate(expectedDue.getDate() - parseInt(term.minimum_days_to_pay));
                    if(billDate.getDate() > expectedDue.getDate()) {
                        dueDate = new Date(`${dueDate.getMonth() + 2}/${term.day_of_month_due}/${dueDate.getFullYear()}`);
                    } else {
                        dueDate.setDate(parseInt(term.day_of_month_due));
                    }
                }
            }

            dueDate = String(dueDate.getMonth() + 1).padStart(2, '0')+'/'+String(dueDate.getDate()).padStart(2, '0')+'/'+dueDate.getFullYear();

            $('#billModal #due_date').val(dueDate);
        });
    });

    $(document).on('change', '#checkModal #payee', function() {
        var split = $(this).val().split('-');

        switch(split[0]) {
            case 'vendor' :
                $.get('/accounting/get-vendor-details/'+split[1], function(res) {
                    var vendor = JSON.parse(res);

                    var vendorName = '';
                    vendorName += vendor.title !== "" ? vendor.title+" " : "";
                    vendorName += vendor.f_name !== "" ? vendor.f_name+" " : "";
                    vendorName += vendor.m_name !== "" ? vendor.m_name+" " : "";
                    vendorName += vendor.l_name !== "" ? vendor.l_name+" " : "";
                    vendorName += vendor.suffix !== "" ? vendor.suffix : "";
                    $('#checkModal #mailing_address').html(vendorName.trim());
                    $('#checkModal #mailing_address').append('\n');
                    var address = '';
                    address += vendor.street !== "" ? vendor.street : "";
                    address += vendor.city !== "" ? '\n'+vendor.city : "";
                    address += vendor.state !== "" ? ', '+vendor.state : "";
                    address += vendor.zip !== "" ? ' '+vendor.zip : "";

                    $('#checkModal #mailing_address').append(address.trim());
                });
            break;
            case 'customer' :
                $.get('/accounting/get-customer-details/'+split[1], function(res) {
                    var customer = JSON.parse(res);

                    var customerName = '';
                    customerName += customer.first_name !== "" ? customer.first_name+" " : "";
                    customerName += customer.middle_name !== "" ? customer.middle_name+" " : "";
                    customerName += customer.last_name !== "" ? customer.last_name : "";
                    $('#checkModal #mailing_address').html(customerName.trim());
                    $('#checkModal #mailing_address').append('\n');
                    if(customer.business_name !== "" && customer.business_name !== null) {
                        $('#checkModal #mailing_address').append(customer.business_name);
                        $('#checkModal #mailing_address').append('\n');
                    }
                    var address = '';
                    address += customer.mail_add !== "" ? customer.mail_add : "";
                    address += customer.city !== "" ? '\n'+customer.city : "";
                    address += customer.state !== "" ? ', '+customer.state : "";
                    address += customer.zip_code !== "" ? ' '+customer.zip_code : "";
                    address += customer.country !== "" ? ' '+customer.country : "";

                    $('#checkModal #mailing_address').append(address.trim());
                });
            break;
            case 'employee' :
                $.get('/accounting/get-employee-details/'+split[1], function(res) {
                    var employee = JSON.parse(res);

                    var employeeName = '';
                    employeeName += employee.FName !== "" ? employee.FName+" " : "";
                    employeeName += employee.LName !== "" ? employee.LName : "";
                    $('#checkModal #mailing_address').html(employeeName.trim());
                    $('#checkModal #mailing_address').append('\n');
                    var address = '';
                    address += employee.address !== "" ? employee.address : "";
                    address += employee.city !== "" ? '\n'+employee.city : "";
                    address += employee.state !== "" ? ', '+employee.state : "";
                    address += employee.postal_code !== "" ? ' '+employee.postal_code : "";

                    $('#checkModal #mailing_address').append(address.trim());
                });
            break;
        }
    });

    $(document).on('change', '#purchaseOrderModal #vendor, #billModal #vendor, #vendorCreditModal #vendor', function() {
        var modalId = $('#modal-container form#modal-form .modal').attr('id');
        $.get('/accounting/get-vendor-details/'+$(this).val(), function(res) {
            var vendor = JSON.parse(res);

            $(`#${modalId} #email`).val(vendor.email);

            var vendorName = '';
            vendorName += vendor.title !== "" ? vendor.title+" " : "";
            vendorName += vendor.f_name !== "" ? vendor.f_name+" " : "";
            vendorName += vendor.m_name !== "" ? vendor.m_name+" " : "";
            vendorName += vendor.l_name !== "" ? vendor.l_name+" " : "";
            vendorName += vendor.suffix !== "" ? vendor.suffix : "";
            $(`#${modalId} #mailing_address`).html(vendorName.trim());
            $(`#${modalId} #mailing_address`).append('\n');
            var address = '';
            address += vendor.street !== "" ? vendor.street : "";
            address += vendor.city !== "" ? '\n'+vendor.city : "";
            address += vendor.state !== "" ? ', '+vendor.state : "";
            address += vendor.zip !== "" ? ' '+vendor.zip : "";

            $(`#${modalId} #mailing_address`).append(address.trim());
        });
    });

    $(document).on('change', '#purchaseOrderModal #customer', function() {
        $.get('/accounting/get-customer-details/'+$(this).val(), function(res) {
            var customer = JSON.parse(res);

            var customerName = '';
            customerName += customer.first_name !== "" ? customer.first_name+" " : "";
            customerName += customer.middle_name !== "" ? customer.middle_name+" " : "";
            customerName += customer.last_name !== "" ? customer.last_name : "";
            $('#purchaseOrderModal #shipping_address').html(customerName.trim());
            $('#purchaseOrderModal #shipping_address').append('\n');
            if(customer.business_name !== "" && customer.business_name !== null) {
                $('#purchaseOrderModal #shipping_address').append(customer.business_name);
                $('#purchaseOrderModal #shipping_address').append('\n');
            }
            $('#purchaseOrderModal #shipping_address').append(customer.mail_add+'\n'+customer.city+', '+customer.state+' '+customer.zip_code+' '+customer.country);
        });
    });

    $(document).on('change', '#payBillsModal #bills-table .payment-amount, #payBillsModal #bills-table .credit-applied', function() {
        if($(this).hasClass('payment-amount')) {
            var row = $(this).parent().parent();
            var paymentAmount = $(this).val();
            var creditApplied = row.find('input.credit-applied');
            creditApplied = creditApplied.length > 0 ? creditApplied.val() : 0.00;
        } else {
            var row = $(this).parent().parent().parent().parent();
            var paymentAmount = row.find('input.payment-amount').val();
            paymentAmount = paymentAmount === '' ? 0.00 : paymentAmount;
            var creditApplied = $(this).val();
        }

        var total = parseFloat(paymentAmount) + parseFloat(creditApplied);

        row.find('td:last-child span').html(parseFloat(total).toFixed(2));

        if(row.find('input[type="checkbox"]').prop('checked') === false) {
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
        var split = $(this).val().split('-');

        if(split[0] === 'vendor') {
            $.get('/accounting/get-linkable-transactions/expense/'+split[1], function(res) {
                var transactions = JSON.parse(res);

                if(transactions.length > 0) {
                    if($('#expenseModal .transactions-container').length > 0) {
                        $('#expenseModal .transactions-container').parent().remove();
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
                        title += transaction.number !== '' ? '#'+transaction.number : '';
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
    });

    $(document).on('change', '#checkModal #payee', function() {
        var split = $(this).val().split('-');
        if(split[0] === 'vendor') {
            $.get('/accounting/get-linkable-transactions/check/'+split[1], function(res) {
                var transactions = JSON.parse(res);

                if(transactions.length > 0) {
                    if($('#checkModal .transactions-container').length > 0) {
                        $('#checkModal .transactions-container').parent().remove();
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
                                        <h4>Add to Expense</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);

                    $.each(transactions, function(index, transaction) {
                        var title = transaction.type;
                        title += transaction.number !== '' ? '#'+transaction.number : '';
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
    });

    $(document).on('change', '#billModal #vendor', function() {
        $.get('/accounting/get-linkable-transactions/bill/'+$(this).val(), function(res) {
            var transactions = JSON.parse(res);

            if(transactions.length > 0) {
                if($('#billModal .transactions-container').length > 0) {
                    $('#billModal .transactions-container').parent().remove();
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
                                    <h4>Add to Expense</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                `);

                $.each(transactions, function(index, transaction) {
                    var title = transaction.type;
                    title += transaction.number !== '' ? '#'+transaction.number : '';
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
    });

    $(document).on('click', '#modal-container .modal .transactions-container a.add-transaction', function(e) {
        e.preventDefault();
        var data = e.currentTarget.dataset;

        $.get(`/accounting/get-transaction-details/${data.type}/${data.id}`, function(res) {
            var result = JSON.parse(res);
            var categories = result.categories;
            var items = result.items;

            var count = 0;
            $('#modal-container .modal table#category-details-table tbody tr').each(function() {
                if($(this).find('select').length === 0) {
                    $(this).remove();
                } else {
                    count++;
                }
            });

            $.each(categories, function(index, category) {
                count++;
                $('#modal-container .modal table#category-details-table tbody').append(`<tr>${catDetailsInputs}</tr>`);
                $('#modal-container .modal table#category-details-table tbody tr:last-child td:nth-child(2)').html(count);
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

            if($('#modal-container .modal table#category-details-table tbody tr').length === 1) {
                $('#modal-container .modal table#category-details-table tbody').append(`<tr>${catDetailsBlank}</tr>`);
                $('#modal-container .modal table#category-details-table tbody tr:last-child td:nth-child(2)').html(count+1);
            }

            $.each(items, function(index, item) {
                var locs = '';
                for(var i in item.locations) {
                    locs += `<option value="${item.locations[i].id}" data-quantity="${item.locations[i].qty === "null" ? 0 : item.locations[i].qty}" ${item.locations[i].id === item.location_id ? 'selected' : ''}>${item.locations[i].name}</option>`;
                }

                if($('#modal-container form#modal-form .modal').attr('id') === 'creditCardCreditModal' || $('#modal-container form#modal-form .modal').attr('id') === 'vendorCreditModal') {
                    var qtyField = `<input type="number" name="quantity[]" class="form-control text-right" required value="0" max="${item.locations[0].qty}">`;
                } else {
                    var qtyField = `<input type="number" name="quantity[]" class="form-control text-right" required value="0">`;
                }

                $('#modal-container .modal table#item-details-table tbody').append(`
                    <tr>
                        <td>${item.details.title}<input type="hidden" name="item[]" value="${item.item_id}"></td>
                        <td>Product</td>
                        <td><select name="location[]" class="form-control" required>${locs}</select></td>
                        <td><input type="number" name="quantity[]" class="form-control text-right" required value="${item.quantity}"></td>
                        <td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="${parseFloat(item.rate).toFixed(2)}"></td>
                        <td><input type="number" name="discount[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="${parseFloat(item.discount).toFixed(2)}"></td>
                        <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="${parseFloat(item.tax).toFixed(2)}"></td>
                        <td>$<span class="row-total">${parseFloat(item.total).toFixed(2)}</span></td>
                        <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
                    </tr>
                `);
            });

            $('#modal-container .modal table#category-details-table tbody input[name="category_amount[]"]').trigger('change');

            $('#modal-container .modal .transactions-container').parent().remove();
            $('#modal-container .modal a.close-transactions-container').parent().remove();
            $('#modal-container .modal a.open-transactions-container').parent().remove();
        });
    });

    $(document).on('click', '#modal-container .modal .transactions-container a.open-transaction', function(e) {
        e.preventDefault();
        var id = e.currentTarget.dataset.id;
        var type = e.currentTarget.dataset.type;

        $('#modal-container .modal').modal('hide');

        switch(type) {
            case 'purchase-order' :
                var modalName = 'purchaseOrderModal';
            break;
            case 'bill' :
                var modalName = 'billModal';
            break;
            case 'vendor-credit' :
                var modalName = 'vendorCreditModal';
            break;
        }

        $.get(`/accounting/vendors/view-${type}/`+id, function(res) {
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
            catDetailsInputs = $(`#${modalName} table#category-details-table tbody tr:first-child()`).html();
            catDetailsBlank = $(`#${modalName} table#category-details-table tbody tr:last-child`).html();

            if($(`#${modalName} table#category-details-table tbody tr`).length === 2) {
                $(`#${modalName} table#category-details-table tbody tr:first-child()`).html(catDetailsBlank);
                $(`#${modalName} table#category-details-table tbody tr:first-child() td:nth-child(2)`).html(1);
            } else {
                $(`#${modalName} table#category-details-table tbody tr:first-child()`).remove();
            }

            if($(`#${modalName} select`).length > 0) {
                $(`#${modalName} select`).select2();
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
                var transactionAttach = new Dropzone(`#${attachmentContId}`, {
                    url: '/accounting/attachments/attach',
                    maxFilesize: 20,
                    uploadMultiple: true,
                    // maxFiles: 1,
                    addRemoveLinks: true,
                    init: function() {
                        $.getJSON('/accounting/vendors/get-transaction-attachments/'+type+'/'+id, function(data) {
                            if(data.length > 0) {
                                $.each(data, function(index, val) {
                                    $(`#${modalName}`).find('.attachments').parent().append(`<input type="hidden" name="attachments[]" value="${val.id}">`);
        
                                    modalAttachmentId.push(val.id);
                                    var mockFile = {
                                        name: `${val.uploaded_name}.${val.file_extension}`,
                                        size: parseInt(val.size),
                                        dataURL: base_url+"uploads/accounting/attachments/" + val.stored_name,
                                        // size: val.size / 1000000,
                                        accepted: true
                                    };
                                    transactionAttach.emit("addedfile", mockFile);
                                    modalAttachedFiles.push(mockFile);

                                    transactionAttach.createThumbnailFromUrl(mockFile, transactionAttach.options.thumbnailWidth, transactionAttach.options.thumbnailHeight, transactionAttach.options.thumbnailMethod, true, function(thumbnail) {
                                        transactionAttach.emit('thumbnail', mockFile, thumbnail);
                                    });
                                    transactionAttach.emit("complete", mockFile);
                                });
                            }
                        });

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
});

const convertToDecimal = (el) => {
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
}

const payrollRowTotal = (el) => {
    convertToDecimal(el);
    var totalPay = 0.00;
    var rowIndex = $(el).parent().parent().index();
    var payRate = $(`div#payrollModal table#payroll-table tbody tr:nth-child(${rowIndex+1}) td:nth-child(2) p span.pay-rate`).html();
    var regPayHours = "0.00";
    var commission = "0.00";


    if(el.hasClass('employee-commission')) {
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
        var empTotalHours = $(this).children('td:nth-child(4)').children('input[name="reg_pay_hours[]"]').val();
        if(empTotalHours !== "" && empTotalHours !== undefined) {
            empTotalHours = parseFloat(empTotalHours);
        } else {
            empTotalHours = 0.00;
        }

        hours = parseFloat(parseFloat(hours) + empTotalHours).toFixed(2);

        var empCommission = $(this).children('td:nth-child(5)').children('input').val();
        if(empCommission !== "" && empCommission !== undefined) {
            empCommission = parseFloat(empCommission);
        } else {
            empCommission = 0.00;
        }

        commission = parseFloat(parseFloat(commission) + empCommission).toFixed(2);

        var empTotalPay = $(this).children('td:last-child()').children('p').children('span').html();

        if(empTotalPay !== "" && empTotalPay !== undefined) {
            empTotalPay = parseFloat(empTotalPay);
        } else {
            empTotalPay = 0.00;
        }

        totalPay = parseFloat(parseFloat(totalPay) + empTotalPay).toFixed(2);
    });

    $('div#payrollModal table#payroll-table tfoot tr td:nth-child(4)').html(hours);
    $('div#payrollModal table#payroll-table tfoot tr td:nth-child(7)').html(hours);

    $('table#payroll-table tfoot tr td:nth-child(5)').html('$'+commission);

    $('div#payrollModal h2.total-pay').html('$'+totalPay);
    $('table#payroll-table tfoot tr td:last-child() p').html('$'+totalPay);
}

const tableWeekDate = (el) => {
    var value = $(el).val();
    var split = value.split('-');
    var startDate = new Date(split[0]);
    var endDate = new  Date(split[1]);

    for(var i = 3; startDate.getTime() <= endDate.getTime(); i++) {
        $(`#weeklyTimesheetModal table#timesheet-table thead th:nth-child(${i}) p:nth-child(2)`).html(startDate.getDate());
        startDate = new Date(startDate.getTime() + 86400000);
    }
}

const computeTotalHours = () => {
    var input = "";
    var hour = 00;
    var minutes = 00;
    
    $('table#timesheet-table tbody tr').each(function() {
        var rowHours = 00;
        var rowMins = 00;
        var rowFlag = false;

        $(this).find('input.day-input').each(function() {
            input = $(this).val().trim();
            if(input !== "") {
                rowFlag = true;
                var inputSplit = input.length !== 0 ? input.split(':') : "";
                hour = inputSplit !== "" ? parseInt(inputSplit[0]) : 00;
                minutes = inputSplit !== "" ? parseInt(inputSplit[1]) : 00;

                rowHours = rowHours + hour;
                rowMins = rowMins + minutes;
            }
        });

        if(rowFlag === true) {
            for(var i = 1; rowMins >= 60; i++) {
                rowHours = rowHours + 1;
                rowMins = rowMins - 60;
            }
    
            rowHours = rowHours.toString().length === 1 ? "0"+rowHours.toString() : rowHours.toString();
            rowMins = rowMins.toString().length === 1 ? "0"+rowMins.toString() : rowMins.toString();
    
            $(this).find('td.total-cell').html(rowHours+":"+rowMins);
        } else {
            $(this).find('td.total-cell').html("");
        }
    });

    for(var index = 3; index <= 9; index++) {
        var colHours = 00;
        var colMins = 00;
        var colFlag = false;

        $(`#weeklyTimesheetModal table#timesheet-table tbody tr td:nth-child(${index})`).each(function() {
            input = $(this).children('input.day-input').val().trim();
            if(input !== "") {
                colFlag = true;
                var colInputSplit = input.length !== 0 ? input.split(':') : "";
                hour = colInputSplit !== "" ? parseInt(colInputSplit[0]) : 00;
                minutes = colInputSplit !== "" ? parseInt(colInputSplit[1]) : 00;

                colHours = colHours + hour;
                colMins = colMins + minutes;
            }
        });

        if(colFlag === true) {
            for(var i = 1; colMins >= 60; i++) {
                colHours = colHours + 1;
                colMins = colMins - 60;
            }
    
            colHours = colHours.toString().length === 1 ? "0"+colHours.toString() : colHours.toString();
            colMins = colMins.toString().length === 1 ? "0"+colMins.toString() : colMins.toString();
    
            $(`#weeklyTimesheetModal table#timesheet-table tfoot tr td:nth-child(${index})`).html(colHours+":"+colMins);
        } else {
            $(`#weeklyTimesheetModal table#timesheet-table tfoot tr td:nth-child(${index})`).html("");
        }
    }

    var rowTotalHours = 00;
    var rowTotalMins = 00;
    var totalFlag = false;
    $('#weeklyTimesheetModal table#timesheet-table tbody tr td.total-cell').each(function() {
        var rowTotal = $(this).html().trim();
        if(rowTotal !== "") {
            totalFlag = true;
            var totalSplit = rowTotal.length !== 0 ? rowTotal.split(':') : "";
            hour = totalSplit !== "" ? parseInt(totalSplit[0]) : 00;
            minutes = totalSplit !== "" ? parseInt(totalSplit[1]) : 00;

            rowTotalHours = rowTotalHours + hour;
            rowTotalMins = rowTotalMins + minutes;
        }
    });

    if(totalFlag === true) {
        for(var i = 1; rowTotalMins >= 60; i++) {
            rowTotalHours = rowTotalHours + 1;
            rowTotalMins = rowTotalMins - 60;
        }

        rowTotalHours = rowTotalHours.toString().length === 1 ? "0"+rowTotalHours.toString() : rowTotalHours.toString();
        rowTotalMins = rowTotalMins.toString().length === 1 ? "0"+rowTotalMins.toString() : rowTotalMins.toString();

        $('#weeklyTimesheetModal table#timesheet-table tfoot tr td:nth-child(10)').html(rowTotalHours+":"+rowTotalMins);
        $('#weeklyTimesheetModal h2#totalHours').html(rowTotalHours+":"+rowTotalMins);
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
            url: 'load-job-tags/',
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
                fnCreatedCell: function (td, cellData, rowData, row, col) {
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

    $('div#depositModal span.other-funds-total').html(`$${parseFloat(otherFundsTotal).toFixed(2)}`);
    $('div#depositModal h2.total-deposit-amount').html(`$${totalDepositAmount}`);
    $('div#depositModal span.total-cash-back').html(`$${totalDepositAmount}`);
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
            if(table === '#category-details-table') {
                $(`table${table} tbody`).append(`<tr>${catDetailsBlank}</tr>`);
            } else {
                $(`table${table} tbody`).append(`<tr>${itemDetailsBlank}</tr>`);
            }
        }
        $(`table${table} tbody tr:last-child() td:nth-child(2)`).html(lastRowCount);
    }
}

const clearTableLines = (e) => {
    e.preventDefault();
    var table = e.currentTarget.dataset.target;

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
}

const showApplyButton = () => {
    $('div#statementModal div.modal-body button.apply-button').removeClass('hide');
    $('div#statementModal div.modal-body div.card-body div.row:last-child()').addClass('hide');
}

const submitModalForm = (event, el) => {
    event.preventDefault();

    var data = new FormData(document.getElementById($(el).attr('id')));
    var modalId = '#'+$(el).children().attr('id');
    if($(el).children().attr('id') === 'payrollModal' || $(el).children().attr('id') === 'commission-payroll-modal' || $(el).children().attr('id') === 'bonus-payroll-modal') {
        data = payrollFormData;
    } else if(vendorModals.includes(modalId)) {
        var count = 0;
        var totalAmount = $(`${modalId} span.transaction-total-amount`).html();
        data.append('total_amount', totalAmount);

        $(`${modalId} table#category-details-table tbody tr`).each(function() {
            var billable = $(this).find('input[name="category_billable[]"]');
            var tax = $(this).find('input[name="category_tax[]"]');

            if(billable.length > 0 && tax.length > 0) {
                if(count === 0) {
                    data.set('category_billable[]', billable.prop('checked') ? "1" : "0");
                    data.set('category_tax[]', tax.prop('checked') ? "1" : "0");
                } else {
                    data.append('category_billable[]', billable.prop('checked') ? "1" : "0");
                    data.append('category_tax[]', tax.prop('checked') ? "1" : "0");
                }
            }

            count++;
        });

        count = 0;
        $(`${modalId} table#item-details-table tbody tr`).each(function() {
            if(count === 0) {
                data.set('item_total[]', $(this).find('td span.row-total').html());
            } else {
                data.append('item_total[]', $(this).find('td span.row-total').html());
            }

            count++;
        });
    } else if(modalId === '#payBillsModal') {
        var totalAmount = $(`${modalId} span.transaction-total-amount`).html();
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

            if(res.success === true) {
                $(el).children().modal('hide');
            }

            toast(res.success, res.message);
        }
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
            $(el).next().next().removeClass('hide');
            $(el).next().next().attr('required', 'required');
            $(el).parent().next().removeClass('hide');
        } else {
            $(el).next().next().addClass('hide');
            $(el).next().next().removeAttr('required');
            $(el).parent().next().addClass('hide');
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
            $(el).parent().append(`<input type="number" name="hourly_rate[]" class="ml-2 w-25 form-control">
            <input type="checkbox" name="taxable[]" class="ml-2 form-check-input" value="1">
            <label class="form-check-label" for="taxable">Taxable</label>`);
        } else {
            $(el).parent().find('input[name="hourly_rate[]"]').remove();
            $(el).parent().find('input[name="taxable[]"]').remove();
            $(el).parent().find('label[for="taxable"]').remove();
        }
    }
}

const makeRecurring = (modalName) => {
    var modalId = '';
    $.get("/accounting/get-recurring-form-fields/"+modalName, function(res) {
        if(modalName === 'bank_deposit') {
            modalId = 'depositModal';
            $(`div#${modalId} div.modal-body div.row.bank-account-details`).remove();
        } else if(modalName === 'transfer') {
            modalId = 'transferModal';
            $(`div#${modalId} div.modal-body #date`).parent().parent().remove();
        } else if(modalName === 'journal_entry') {
            modalId = 'journalEntryModal';
            $(`div#${modalId} div.modal-body div.row.journal-entry-details`).remove();
        }

        if($(`div#${modalId} input#templateName`).length === 0) {
            $(`div#${modalId} div.modal-body .card-body`).prepend(res);
        }
        $(`div#${modalId} div.modal-footer div.row.w-100 div:nth-child(2)`).html('');
        $(`div#${modalId} div.modal-footer div.row.w-100 div:last-child()`).html('<button class="btn btn-success float-right" type="submit">Save template</button>');

        recurrInterval = $(`div#${modalId} div.modal-body div.recurring-interval-container`).html();
        recurringDays = $(`div#${modalId} div.modal-body select[name="recurring_day"]`).html();
        monthlyRecurrFields = $(`div#${modalId} div.modal-body div.recurring-interval-container div div.form-row div.form-group:nth-child(2) div.row div`).html();

        $(`div#${modalId} input.date`).datepicker({
            uiLibrary: 'bootstrap'
        });
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
    var initalQty = $('#adjust-starting-value-modal #initialQty').val();
    var initialCost = $('#adjust-starting-value-modal #initialCost').val();

    var totalValue = parseFloat(initialCost) * parseInt(initalQty);
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
        var value = $(this).html() === "" ? 0.00 : parseFloat($(this).html()).toFixed(2);

        total = parseFloat(parseFloat(total) + parseFloat(value)).toFixed(2);
    });

    $('#modal-container .transaction-total-amount').html(parseFloat(total).toFixed(2));
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
                d.payee = $(`${modalName} #payee`).val();
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
                        $(td).html(`
                        <div class="row">
                            <div class="col-sm-9">
                                <input type="number" class="form-control text-right credit-applied" step=".01" max="${rowData.vendor_credits}" onchange="convertToDecimal(this)">
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
    $('#payBillsModal table#bills-table').DataTable().ajax.reload();
}

const computeBillsPaymentTotal = () => {
    var total = 0.00;
    $('#payBillsModal #bills-table tbody tr').each(function() {
        if($(this).find('input[type="checkbox"]').prop('checked')) {
            total += parseFloat($(this).find('td:last-child span').html())
        }
    });

    $('#payBillsModal span.transaction-total-amount').html(parseFloat(total).toFixed(2));
}

const updateTransaction = (event, el) => {
    event.preventDefault();

    var data = new FormData(document.getElementById($(el).attr('id')));
    var modalId = '#'+$(el).children().attr('id');

    var totalAmount = $(`${modalId} span.transaction-total-amount`).html();
    data.append('total_amount', totalAmount);

    var count = 0;
    if($(`${modalId} table#category-details-table`).length > 0) {
        $(`${modalId} table#category-details-table tbody tr`).each(function() {
            var billable = $(this).find('input[name="category_billable[]"]');
            var tax = $(this).find('input[name="category_tax[]"]');
    
            if(billable.length > 0 && tax.length > 0) {
                if(count === 0) {
                    data.set('category_billable[]', billable.prop('checked') ? "1" : "0");
                    data.set('category_tax[]', tax.prop('checked') ? "1" : "0");
                } else {
                    data.append('category_billable[]', billable.prop('checked') ? "1" : "0");
                    data.append('category_tax[]', tax.prop('checked') ? "1" : "0");
                }
            }
    
            count++;
        });
    }

    if($(`${modalId} table#item-details-table`).length > 0) {
        count = 0;
        $(`${modalId} table#item-details-table tbody tr`).each(function() {
            if(count === 0) {
                data.set('item_total[]', $(this).find('td span.row-total').html());
            } else {
                data.append('item_total[]', $(this).find('td span.row-total').html());
            }

            count++;
        });
    }

    $.ajax({
        url: $(el).attr('data-href'),
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            var res = JSON.parse(result);

            if(res.success === true) {
                $('#transactions-table').DataTable().ajax.reload();
                $(el).children().modal('hide');
            }

            toast(res.success, res.message);
        }
    });
}