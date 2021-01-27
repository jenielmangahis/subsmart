const GET_OTHER_MODAL_URL = "/accounting/get-other-modals/";
var rowCount = 0;
var rowInputs = '';
var blankRow = '';
var modalName = '';
var tagsListModal = '';
var timesheetInputs = 'input.day-input';
var payrollForm = '';
var payrollFormData = [];

$(function() {
    $(document).on('keyup', timesheetInputs, function(e) {
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

    $(document).on('change', timesheetInputs, function(e) {
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

        
        computeTotalHours();
    });

    $(document).on('change', '#payDownCreditModal input#amount', function() {
        var amount = $(this).val();

        if(amount !== "") {
            $('#payDownCreditModal #total-amount-paid').html(`$${amount}.00`);
        } else {
            $('#payDownCreditModal #total-amount-paid').html('$0.00');
        }
    });

    $(document).on('change', 'table#payroll-table tbody tr td:nth-child(4) input[name="reg_pay_hours[]"], table#payroll-table tbody tr td:nth-child(5) input', function(){
        payrollRowTotal($(this));
        payrollTotal();
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

    $(document).on('click', 'ul#accounting_order li a[data-toggle="modal"], ul#accounting_employees li a', function(e) {
        e.preventDefault();
        var target = e.currentTarget.dataset;
        var view = target.view
        var modal_element = target.target;
        modalName = target.target;

        $.get(GET_OTHER_MODAL_URL+view, function(res) {
            if ($('div#modal-container').length > 0) {
                $('div#modal-container').html(res);
                $(modal_element).modal('show');
            } else {
                $('body').append(`
                    <div id="modal-container"> 
                        ${res}
                    </div>
                `);
                $(modal_element).modal('show');
            }

            if($('div#modal-container table').length > 0) {
                rowCount = $('div#modal-container table tbody tr').length;
                rowInputs = $('div#modal-container table tbody tr:first-child()').html();
                blankRow = $('div#modal-container table tbody tr:nth-child(2)').html();

                $('div#modal-container table.clickable tbody tr:first-child()').html(blankRow);
                $('div#modal-container table.clickable tbody tr:first-child() td:nth-child(2)').html(1);
            }

            if(view === "bank_deposit_modal") {
                $('div#depositModal select#tags').select2({
                    placeholder: 'Start typing to add a tag',
                    allowClear: true,
                    ajax: {
                        url: '/accounting/get-job-tags',
                        dataType: 'json'
                    }
                });
            } else if(view === "weekly_timesheet_modal") {
                tableWeekDate();
            }
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

    $(document).on('click', 'div#depositModal a#open-tags-modal', function(e) {
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

    $(document).on('click', `div#modal-container .full-screen-modal table.clickable tbody tr`, function() {
        if($(this).children('td:nth-child(3)').children('select').length < 1) {
            var rowNum = $(this).children().next().html();

            $(this).html(rowInputs);
            $(this).children('td:nth-child(2)').html(rowNum);
        }
    });

    $(document).on('click', 'div#modal-container table.clickable tbody tr td a.deleteRow', function() {
        $(this).parent().parent().remove();
        if($('div#modal-container table tbody tr').length < rowCount) {
            $('div#modal-container table tbody').append(`<tr>${blankRow}</tr>`)
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

    $(document).on('keyup', '#search-tag', function(){
        $('#tags-table').DataTable().ajax.reload();
    });

    $(document).on('click', 'div#tags-modal table#tags-table tbody tr td a', function(e) {
        e.preventDefault();

        getTagForm(e.currentTarget.dataset, 'update');
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

    $(document).on('change', 'div#transferModal div.modal-body input#transferAmount', function() {
        var val = parseFloat($(this).val()).toFixed(2).toString();
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
    
        $(this).val(string);
    });
});

const payrollRowTotal = (el) => {
    var val = parseFloat($(el).val()).toFixed(2).toString();
    var split = val.includes('.') ? val.split('.') : val;
    var string = "0.00";
    var totalPay = 0.00;
    var rowIndex = $(el).parent().parent().index();
    var payRate = $(`table#payroll-table tbody tr:nth-child(${rowIndex+1}) td:nth-child(2) p span.pay-rate`).html();
    var regPayHours = "0.00";
    var commission = "0.00";

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

    if(el.hasClass('employee-commission')) {
        commission = parseFloat(string);

        regPayHours = $(`table#payroll-table tbody tr:nth-child(${rowIndex+1}) td:nth-child(4) input`).val();
        if(regPayHours === "") {
            regPayHours = 0.00;
        } else {
            regPayHours = parseFloat(regPayHours);
        }
    } else {
        regPayHours = parseFloat(string);

        commission = $(`table#payroll-table tbody tr:nth-child(${rowIndex+1}) td:nth-child(5) input`).val();
        if(commission === "") {
            commission = 0.00;
        } else {
            commission = parseFloat(commission);
        }

        $(el).parent().parent().children('td:nth-child(7)').children().html(string);
    }

    totalPay = parseFloat(parseFloat(regPayHours * parseFloat(payRate)) + commission).toFixed(2);

    $(el).parent().parent().children('td:last-child()').children('p').children('span.total-pay').html(totalPay);
}

const payrollTotal = () => {
    var hours = 0.00;
    var totalPay = 0.00;
    var commission = 0.00;

    $('table#payroll-table tbody tr').each(function() {
        var empTotalHours = $(this).children('td:nth-child(4)').children('input[name="reg_pay_hours[]"]').val();
        if(empTotalHours !== "" && empTotalHours !== undefined) {
            empTotalHours = parseFloat(empTotalHours);
        } else {
            empTotalHours = 0.00;
        }

        hours = parseFloat(parseFloat(hours) + empTotalHours).toFixed(2);;

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

    $('table#payroll-table tfoot tr td:nth-child(4)').html(hours);
    $('table#payroll-table tfoot tr td:nth-child(7)').html(hours);

    $('table#payroll-table tfoot tr td:nth-child(5)').html('$'+commission);

    $('div#payrollModal h2.total-pay').html('$'+totalPay);
    $('table#payroll-table tfoot tr td:last-child() p').html('$'+totalPay);
}

const tableWeekDate = () => {
    var value = $('#weeklyTimesheetModal select#weekDates').val();
    var split = value.split('-');
    var startDateSplit = split[0].split('/');
    var endDateSplit = split[1].split('/');
    var printNum = parseInt(startDateSplit[1]);

    for(var i = 3; printNum <= parseInt(endDateSplit[1]); i++) {
        $(`#weeklyTimesheetModal table#timesheet-table thead th:nth-child(${i}) p:nth-child(2)`).html(printNum);
        printNum++;
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
                    $(td).html(`<span>${rowData.tag_name}</span><a href="#" class="float-right text-info" data-id="${rowData.id}" data-name="${rowData.tag_name}">Edit</a>`);
                }
            }
        ]
    });
}

const getTagForm = (data = {}, method) => {
    $.get('/accounting/get-job-tag-form/', function(res) {
        $('#tags-modal div.modal-dialog div#tags-list').remove();

        if(method === 'create') {
            $('#tags-modal div.modal-dialog').append(`<form class="h-100" id="create-tag-form" onsubmit="submitTagsForm(this, 'create', event)"></form>`);
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
        }
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
        url: '/accounting/submit-job-tag-form',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            var res = JSON.parse(result);

            $('.modal#tags-modal').modal('hide');

            toast(res.success, res.message);
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
    var otherFundsTotal = 0;

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

    $('div#depositModal span.other-funds-total').html(`$${otherFundsTotal}`);
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
        $(`table${table} tbody`).append(`<tr>${blankRow}</tr>`);
        $(`table${table} tbody tr:last-child() td:nth-child(2)`).html(lastRowCount);
    }
}

const clearTableLines = (e) => {
    e.preventDefault();
    var table = e.currentTarget.dataset.target;

    $(`table${table} tbody tr`).each(function(index, value) {
        if(index < rowCount) {
            $(this).children().each(function(){
                $(this).children('input').remove();
                $(this).children('select').remove();
            });
        }
        if(index >= rowCount) {
            $(this).remove();
        }
    });
}

const submitModalForm = (event, el) => {
    event.preventDefault();

    var data = new FormData(document.getElementById($(el).attr('id')));
    if($(el).children().attr('id') === 'payrollModal') {
        data = payrollFormData;
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

            $('div#modal-container div.full-screen-modal .modal').modal('hide');

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
            $('input#startTime, input#endTime').parent().removeClass('hide');
            $('input#startTime, input#endTime').attr('required', 'required');
            $('label[for="time"]').html('Break');
        } else {
            $('input#startTime, input#endTime').parent().addClass('hide')
            $('input#startTime, input#endTime').removeAttr('required', 'required');
            $('label[for="time"]').html('Time');
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