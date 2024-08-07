const accountId = $('#account').val();
const accountType = $('span#account-type').text().trim();

$(function() {
    $('.date').datepicker({
        format: 'mm/dd/yyyy',
        orientation: 'bottom',
        autoclose: true
    });
});

$('.dropdown-menu.table-settings, .dropdown-menu.table-filters').on('click', function(e) {
    e.stopPropagation();
});

$("#accounts-table").nsmPagination({
    itemsPerPage: parseInt($('#table-rows li a.active').html().trim())
});

$('.dropdown-menu#table-rows a.dropdown-item').on('click', function() {
    var count = $(this).html();
    $('.dropdown-menu#table-rows a.dropdown-item.active').removeClass('active');
    $(this).addClass('active');

    $(this).parent().parent().prev().find('span').html(count);
    $('.dropdown-menu#table-rows').prev().dropdown('toggle');

    $("#registers-table").nsmPagination({
        itemsPerPage: parseInt(count)
    });
});

$('select').each(function() {
    var dropdownType = $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-');
    dropdownType = dropdownType.replace('filter-', '');

    if(dropdownType === 'account') {
        dropdownType = 'register-account';
    }

    if($(this).find('option').length > 1) {
        $(this).select2({
            minimumResultsForSearch: -1
        });
    } else {
        $(this).select2({
            ajax: {
                url: '/accounting/get-dropdown-choices',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        field: dropdownType
                    }
    
                    // Query parameters will be ?search=[term]&type=public&field=[type]
                    return query;
                }
            },
            templateResult: formatResult,
            templateSelection: optionSelect
        });
    }
});

$('.dropdown-menu.table-settings input[name="col_chk"]').on('change', function() {
    var chk = $(this);
    var dataName = $(this).next().text();

    var index = $(`#registers-table thead td[data-name="${dataName}"]`).index();
    $(`#registers-table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });

    $(`#print_registers_modal table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });

    $(`#print_preview_registers_modal #registers_table_print tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });
});

$('#account').on('change', function() {
    location.href = `/accounting/chart-of-accounts/view-register/${$(this).val()}`
});

$('#reset-button').on('click', function() {
    location.href = `${base_url}accounting/chart-of-accounts/view-register/${$('#account').val()}`;
});

$('#apply-button').on('click', function() {
    var url = `${base_url}accounting/chart-of-accounts/view-register/${$('#account').val()}?`;

    url += $('#filter-find').val() !== '' ? `search=${$('#filter-find').val()}&` : '';
    url += $('#filter-reconcile-status').length > 1 && $('#filter-reconcile-status').attr('data-applied') !== 'all' ? `reconcile-status=${$('#filter-reconcile-status').attr('data-applied')}&` : '';
    url += $('#filter-transaction-type').length > 1 && $('#filter-transaction-type').attr('data-applied') !== 'all' ? `transaction-type=${$('#filter-transaction-type').attr('data-applied')}&` : '';
    url += $('#filter-payee').length > 1 && $('#filter-payee').attr('data-applied') !== 'all' ? `payee=${$('#filter-payee').attr('data-applied')}&` : '';
    url += $('#filter-date').val() !== 'all' ? `date=${$('#filter-date').val()}&` : '';
    url += $('#filter-from').val() !== '' ? `from=${$('#filter-from').val()}&` : '';
    url += $('#filter-to').val() !== '' ? `to=${$('#filter-to').val()}&` : '';
    url += $('#chk_show_in_one_line').prop('checked') === false ? `single-line=false&` : '';

    if(url.slice(-1) === '?' || url.slice(-1) === '&' || url.slice(-1) === '#') {
        url = url.slice(0, -1); 
    }
    location.href = url;
});

$('#filter-date').on('change', function() {
    switch($(this).val()) {
        case 'all' :
            $('#filter-from, #filter-to').val('');
        break;
        case 'today' :
            var today = new Date();
            var todayDate = String(today.getDate()).padStart(2, '0');
            var todayMonth = String(today.getMonth() + 1).padStart(2, '0');
            today = todayMonth + '/' + todayDate + '/' + today.getFullYear();

            $('#filter-from, #filter-to').val(today);
        break;
        case 'yesterday' :
            var yesterday = new Date();
            yesterday.setDate(yesterday.getDate() - 1);
            var yesterdayDate = String(yesterday.getDate()).padStart(2, '0');
            var yesterdayMonth = String(yesterday.getMonth() + 1).padStart(2, '0');
            yesterday = yesterdayMonth + '/' + yesterdayDate + '/' + yesterday.getFullYear();

            $('#filter-from, #filter-to').val(yesterday);
        break;
        case 'this-week' :
            var date = new Date();
            var from = date.getDate() - date.getDay();
            var to = from + 6;

            var from_date = new Date(date.setDate(from));
            var to_date = new Date(date.setDate(to));

            from_date = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
            to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();

            $('#filter-from').val(from_date);
            $('#filter-to').val(to_date);
        break;
        case 'this-month' :
            var date = new Date();
            var to_date = new Date(date.getFullYear(), date.getMonth() + 1, 0);

            from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();

            $('#filter-from').val(from_date);
            $('#filter-to').val(to_date);
        break;
        case 'this-quarter' :
            var date = new Date();
            var currQuarter = Math.floor(date.getMonth() / 3 + 1);
                
            switch(currQuarter) {
                case 1 :
                    var from_date = '01/01/' + date.getFullYear();
                    var to_date = '03/31/'+ date.getFullYear();
                break;
                case 2 :
                    var from_date = '04/01/' + date.getFullYear();
                    var to_date = '06/30/'+ date.getFullYear();
                break;
                case 3 :
                    var from_date = '07/01/' + date.getFullYear();
                    var to_date = '09/30/'+ date.getFullYear();
                break;
                case 4 :
                    var from_date = '10/01/' + date.getFullYear();
                    var to_date = '12/31/'+ date.getFullYear();
                break;
            }

            $('#filter-from').val(from_date);
            $('#filter-to').val(to_date);
        break;
        case 'this-year' :
            var date = new Date();
            var from_date = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            var to_date = String(12).padStart(2, '0') + '/' + String(31).padStart(2, '0') + '/' + date.getFullYear();

            $('#filter-from').val(from_date);
            $('#filter-to').val(to_date);
        break;
        case 'last-week' :
            var date = new Date();
            var from = date.getDate() - date.getDay();

            var from_date = new Date(date.setDate(from - 7));
            var to_date = new Date(date.setDate(date.getDate() + 6));

            from_date = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
            to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();

            $('#filter-from').val(from_date);
            $('#filter-to').val(to_date);
        break;
        case 'last-month' :
            var date = new Date();
            var to_date = new Date(date.getFullYear(), date.getMonth(), 0);

            from_date = String(date.getMonth()).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();

            $('#filter-from').val(from_date);
            $('#filter-to').val(to_date);
        break;
        case 'last-quarter' :
            var date = new Date();
            var currQuarter = Math.floor(date.getMonth() / 3 + 1);
                
            switch(currQuarter) {
                case 1 :
                    var from_date = new Date('01/01/' + date.getFullYear());
                    var to_date = new Date('03/31/'+ date.getFullYear());
                break;
                case 2 :
                    var from_date = new Date('04/01/' + date.getFullYear());
                    var to_date = new Date('06/30/'+ date.getFullYear());
                break;
                case 3 :
                    var from_date = new Date('07/01/' + date.getFullYear());
                    var to_date = new Date('09/30/'+ date.getFullYear());
                break;
                case 4 :
                    var from_date = new Date('10/01/' + date.getFullYear());
                    var to_date = new Date('12/31/'+ date.getFullYear());
                break;
            }

            from_date.setMonth(from_date.getMonth() - 3);
            to_date.setMonth(to_date.getMonth() - 3);

            if(to_date.getDate() === 1) {
                to_date.setDate(to_date.getDate() - 1);
            }

            from_date = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
            to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();

            $('#filter-from').val(from_date);
            $('#filter-to').val(to_date);
        break;
        case 'last-year' :
            var date = new Date();
            date.setFullYear(date.getFullYear() - 1);

            var from_date = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            var to_date = String(12).padStart(2, '0') + '/' + String(31).padStart(2, '0') + '/' + date.getFullYear();

            $('#filter-from').val(from_date);
            $('#filter-to').val(to_date);
        break;
    }
});

$('#btn_print_registers').on('click', function() {
    $("#registers_table_print").printThis();
});

$('.export-items').on('click', function() {
    if($('#export-form').length < 1) {
        $('body').append(`<form action="/accounting/chart-of-accounts/view-register/${$('#account').val()}/export-table" method="post" id="export-form"></form>`);
    }

    var fields = $('.dropdown-menu.table-settings input[name="col_chk"]:checked');
    fields.each(function() {
        $('#export-form').append(`<input type="hidden" name="fields[]" value="${$(this).attr('id').replace('chk_', '')}">`);
    });

    var url = window.location.href;
    var filtersString = url.replace(`${base_url}accounting/chart-of-accounts/view-register/${$('#account').val()}`, '');
    if(filtersString.charAt(0) === '?') {
        filtersString = filtersString.slice(1);
    }

    $('#export-form').append(`<input type="hidden" name="search" value="${$('#filter-find').attr('data-applied')}">`);
    $('#export-form').append(`<input type="hidden" name="reconcile_status" value="${$('#filter-reconcile-status').attr('data-applied')}">`);
    $('#export-form').append(`<input type="hidden" name="type" value="${$('#filter-transaction-type').attr('data-applied')}">`);
    $('#export-form').append(`<input type="hidden" name="payee" value="${$('#filter-payee').attr('data-applied')}">`);
    $('#export-form').append(`<input type="hidden" name="from_date" value="${$('#filter-from').attr('data-applied')}">`);
    $('#export-form').append(`<input type="hidden" name="to_date" value="${$('#filter-to').attr('data-applied')}">`);

    $('#export-form').append(`<input type="hidden" name="column" value="date">`);
    $('#export-form').append(`<input type="hidden" name="order" value="desc">`);

    $('#export-form').submit();
});

$('#export-form').on('submit', function(e) {
    e.preventDefault();
    this.submit();
    $(this).remove();
});

$('#registers-table tbody tr').on('click', function() {
    if(accountType !== 'A/R' && accountType !== 'A/P') {
        if($('#chk_show_in_one_line').prop('checked')) {
            if($(this).find('input').length < 1 && !$(this).hasClass('action-row') && $(this).find('.nsm-empty').length < 1) {
                var row = $(this);
                var cols = $(this).find('td');
                if($('#registers-table tbody tr.editting').length > 0) {
                    $('#registers-table tbody tr.editting').next().find('#cancel-edit').trigger('click');
                }
                $(this).addClass('editting');
                var colCount = cols.length;
    
                var actionRow = '<tr class="action-row">';
                actionRow += `<td colspan="${colCount}">
                    <div class="row">
                        <div class="col">
                            <div id="attachments-container"></div>
                            <input type="file" class="d-none form-control" name="files" id="files" multiple>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="m-0">
                                <i class="bx bx-fw bx-paperclip"></i> <a href="#" class="text-decoration-none" id="add-attachment">Add Attachment</a>
                            </h6>
                        </div>
                        <div class="col-6 text-end">
                            <div class="nsm-page-buttons page-button-container">
                                <button type="button" class="nsm-button" id="delete-transaction">
                                    Delete
                                </button>
                                <button type="button" class="nsm-button" id="edit-transaction">
                                    Edit
                                </button>
                                <button type="button" class="nsm-button" id="cancel-edit">
                                    Cancel
                                </button>
                                <button type="button" class="nsm-button primary" id="save-transaction">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </td>`;
                actionRow += '</tr>';
    
                $(actionRow).insertAfter(row);
    
                var type = row.find('td:nth-child(3)').text().trim()
    
                if(type === 'Inventory Starting Value') {
                    $('#registers-table tbody tr.action-row #delete-transaction').remove();
                } else if(type === 'Inventory Qty Adjust') {
                    $('#registers-table tbody tr.action-row #save-transaction').remove();
                }
    
                var noAttachments = [
                    'Inventory Starting Value',
                    'Inventory Qty Adjust',
                    'Credit Card Pmt'
                ];
    
                if(noAttachments.includes(type)) {
                    $('#registers-table tbody tr.action-row #add-attachment').parent().remove();
                }
    
                cols.each(function() {
                    var index = $(this).index();
                    var current = $(this).html();
                    var colData = $(this).data();
    
                    switch($($('#registers-table thead tr td')[index]).data().name) {
                        case 'Date' :
                            $(this).html(`<div class="nsm-field-group calendar"><input type="text" name="date" class="form-control nsm-field date" value="${current}"></div>`);
    
                            if(type === 'Inventory Qty Adjust' || type === 'Bill' || type === 'Invoice') {
                                $(this).find('input').prop('disabled', true);
                            }
    
                            $(this).find('input').datepicker({
                                format: 'mm/dd/yyyy',
                                orientation: 'bottom',
                                autoclose: true
                            });
                        break;
                        case 'Ref No.' :
                            $(this).html(`<input type="text" name="ref_no" class="form-control nsm-field" value="${current}" placeholder="Ref No.">`);
    
                            if(colData.disabled === 'true' || colData.disabled === 1) {
                                $(this).find('input').prop('disabled', true);
                            }
                        break;
                        case 'Type' :
                            $(this).html(`<input type="text" name="type" class="form-control nsm-field" value="${current}" disabled>`);
                        break;
                        case 'Payee' :
                            $(this).html(`<select class="form-select nsm-field" name="payee"></select>`);
    
                            if(current !== "") {
                                if(type !== "Bill" && type !== 'Vendor Credit') {
                                    $(this).find('select').append(`<option value="${colData.type+'-'+colData.id}">${current}</option>`);
                                } else {
                                    $(this).find('select').append(`<option value="${colData.id}">${current}</option>`);
                                }
                            }
    
                            if(colData.disabled === 'true' || colData.disabled === 1) {
                                $(this).find('select').prop('disabled', true);
                                $(this).find('select').select2({
                                    placeholder: 'Payee'
                                });
                            } else {
                                switch(type) {
                                    case 'Expense' :
                                        var fieldName = 'payee';
                                        var modalName = 'expenseModal';
                                    break;
                                    case 'CC Expense' :
                                        var fieldName = 'payee';
                                        var modalName = 'expenseModal';
                                    break;
                                    case 'Check' :
                                        var fieldName = 'payee';
                                        var modalName = 'checkModal';
                                    break;
                                    case 'Bill' :
                                        var fieldName = 'vendor';
                                        var modalName = 'billModal';
                                    break;
                                    case 'Vendor Credit' :
                                        var fieldName = 'vendor';
                                        var modalName = 'vendorCreditModal';
                                    break;
                                    case 'CC-Credit' :
                                        var fieldName = 'payee';
                                        var modalName = 'creditCardCreditModal';
                                    break;
                                    case 'Journal' :
                                        var fieldName = 'names';
                                        var modalName = 'journalEntryModal';
                                    break;
                                }
    
                                $(this).find('select').select2({
                                    placeholder: 'Payee',
                                    ajax: {
                                        url: '/accounting/get-dropdown-choices',
                                        dataType: 'json',
                                        data: function(params) {
                                            var query = {
                                                search: params.term,
                                                type: 'public',
                                                field: fieldName,
                                                modal: modalName
                                            }
    
                                            // Query parameters will be ?search=[term]&type=public&field=[type]
                                            return query;
                                        }
                                    },
                                    templateResult: formatResult,
                                    templateSelection: optionSelect
                                });
                            }
                        break;
                        case 'Account' :
                            switch(type) {
                                case 'Transfer' :
                                    var fieldName = 'transfer-account';
                                    var modalName = 'transferModal';
                                break;
                                case 'Credit Card Pmt' :
                                    var fieldName = colData.field;
                                    var modalName = 'payDownCreditModal';
                                break;
                                case 'Inventory Starting Value' :
                                    var fieldName = colData.field;
                                    var modalName = 'adjust-starting-value-modal';
                                break;
                                case 'Deposit' :
                                    var fieldName = colData.field;
                                    var modalName = 'depositModal';
                                break;
                                case 'Expense' :
                                    var fieldName = colData.field;
                                    var modalName = 'expenseModal';
                                break;
                                case 'CC Expense' :
                                    var fieldName = colData.field;
                                    var modalName = 'expenseModal';
                                break;
                                case 'Check' :
                                    var fieldName = colData.field;
                                    var modalName = 'checkModal';
                                break;
                                case 'CC-Credit' :
                                    var fieldName = colData.field;
                                    var modalName = 'creditCardCreditModal';
                                break;
                            }
    
                            $(this).html(`<select class="form-select nsm-field" name="${fieldName !== undefined ? fieldName.replaceAll('-', '_') : 'account'}" ${current === '-Split-' ? 'disabled' : ''}><option value="${colData.id}">${current}</option></select>`);
    
                            if(colData.disabled === 'true' || colData.disabled === 1) {
                                $(this).find('select').prop('disabled', true);
                                $(this).find('select').select2({
                                    placeholder: 'Account'
                                });
                            } else {
                                $(this).find('select').select2({
                                    placeholder: 'Account',
                                    ajax: {
                                        url: '/accounting/get-dropdown-choices',
                                        dataType: 'json',
                                        data: function(params) {
                                            var query = {
                                                search: params.term,
                                                type: 'public',
                                                field: fieldName,
                                                modal: modalName
                                            }
            
                                            // Query parameters will be ?search=[term]&type=public&field=[type]
                                            return query;
                                        }
                                    },
                                    templateResult: formatResult,
                                    templateSelection: optionSelect
                                });
                            }
                        break;
                        case 'Memo' :
                            $(this).html(`<input type="text" name="memo" class="form-control nsm-field" value="${current}" placeholder="Memo">`);
    
                            if(type === 'Inventory Qty Adjust' || type === 'Invoice' || type === 'Credit Memo') {
                                $(this).find('input').prop('disabled', true);
                            }
                        break;
                        case 'Payment' :
                            if(current === '' && type !== 'Journal') {
                                $(this).html(`<input type="number" name="payment" class="form-control nsm-field font-italic" value="" placeholder="Payment" disabled>`);
                            } else if(colData.disabled === 'true' || colData.disabled === 1) {
                                $(this).html(`<input type="number" name="payment" class="form-control nsm-field text-end" step=".01" value="${current.replaceAll('$', '')}" placeholder="Payment" disabled>`);
                            } else {
                                $(this).html(`<input type="number" name="payment" class="form-control nsm-field text-end" step=".01" value="${current.replaceAll('$', '')}" placeholder="Payment">`);
                            }
    
                            if(type === 'Inventory Qty Adjust') {
                                $(this).find('input').prop('disabled', true);
                            }
                        break;
                        case 'Charge' :
                            if(current === '' && type !== 'Journal') {
                                $(this).html(`<input type="number" name="charge" class="form-control nsm-field font-italic" value="" placeholder="Charge" disabled>`);
                            } else if(colData.disabled === 'true' || colData.disabled === 1) {
                                $(this).html(`<input type="number" name="charge" class="form-control nsm-field text-end" step=".01" value="${current.replaceAll('$', '')}" placeholder="Charge" disabled>`);
                            } else {
                                $(this).html(`<input type="number" name="charge" class="form-control nsm-field text-end" step=".01" value="${current.replaceAll('$', '')}" placeholder="Charge">`);
                            }
    
                            if(type === 'Inventory Qty Adjust') {
                                $(this).find('input').prop('disabled', true);
                            }
                        break;
                        case 'Deposit' :
                            if(current === '' && type !== 'Journal') {
                                $(this).html(`<input type="number" name="deposit" class="form-control nsm-field font-italic" value="" placeholder="Deposit" disabled>`);
                            } else if(colData.disabled === 'true' || colData.disabled === 1) {
                                $(this).html(`<input type="number" name="deposit" class="form-control nsm-field text-end" step=".01" value="${current.replaceAll('$', '')}" placeholder="Deposit" disabled>`);
                            } else {
                                $(this).html(`<input type="number" name="deposit" class="form-control nsm-field text-end" step=".01" value="${current.replaceAll('$', '')}" placeholder="Deposit">`);
                            }
    
                            if(type === 'Inventory Qty Adjust') {
                                $(this).find('input').prop('disabled', true);
                            }
                        break;
                        case 'Increase' :
                            if(current === '' && type !== 'Journal') {
                                $(this).html(`<input type="number" name="increase" class="form-control nsm-field font-italic" value="" placeholder="Increase" disabled>`);
                            } else if(colData.disabled === 'true' || colData.disabled === 1) {
                                $(this).html(`<input type="number" name="increase" class="form-control nsm-field text-end" step=".01" value="${current.replaceAll('$', '')}" placeholder="Increase" disabled>`);
                            } else {
                                $(this).html(`<input type="number" name="increase" class="form-control nsm-field text-end" step=".01" value="${current.replaceAll('$', '')}" placeholder="Increase">`);
                            }
    
                            if(type === 'Inventory Qty Adjust') {
                                $(this).find('input').prop('disabled', true);
                            }
                        break;
                        case 'Decrease' :
                            if(current === '' && type !== 'Journal') {
                                $(this).html(`<input type="number" name="decrease" class="form-control nsm-field font-italic" value="" placeholder="Decrease" disabled>`);
                            } else if(colData.disabled === 'true' || colData.disabled === 1) {
                                $(this).html(`<input type="number" name="decrease" class="form-control nsm-field text-end" step=".01" value="${current.replaceAll('$', '')}" placeholder="Decrease" disabled>`);
                            } else {
                                $(this).html(`<input type="number" name="decrease" class="form-control nsm-field text-end" step=".01" value="${current.replaceAll('$', '')}" placeholder="Decrease">`);
                            }
    
                            if(type === 'Inventory Qty Adjust') {
                                $(this).find('input').prop('disabled', true);
                            }
                        break;
                        case 'Reconcile Status' :
                            $(this).html('');
                        break;
                        case 'Banking Status' :
                            $(this).html('');
                        break;
                        case 'Attachments' :
                            $(this).html(`<input type="text" class="form-control nsm-field" value="${current}" disabled>`);
                        break;
                        case 'Tax' :
                            $(this).html('');
                        break;
                        case 'Balance' :
                            $(this).html(`<input type="number" class="form-control nsm-field text-end" value="${current.replaceAll('$', '').replaceAll(',', '')}" disabled>`);
                        break;
                        case 'Open Balance' :
                            $(this).html(`<input type="number" class="form-control nsm-field text-end" value="${current.replaceAll('$', '').replaceAll(',', '')}" disabled>`);
                        break;
                    }
                });
            }
        } else {
            if($(this).find('input').length < 1 && !$(this).hasClass('action-row') && $(this).find('.nsm-empty').length < 1) {
                var data = $(this).data();
                var cols = $(this).find('td');
                var rows = $(`#registers-table tbody tr[data-type="${data.type}"][data-id="${data.id}"]`);
                var row = $(rows[rows.length - 1]);
                var typeHeader = $('#registers-table thead tr td[data-name="Type"]');
                var typeHeaderRowIndex = typeHeader.parent().index();
    
                var type = $($(rows[typeHeaderRowIndex]).find('td')[typeHeader.index()]).text().trim();
    
                if($('#registers-table tbody tr.editting').length > 0) {
                    $('#registers-table tbody tr.editting').next().find('#cancel-edit').trigger('click');
                }
                $(this).addClass('editting');
                var colCount = cols.length;
    
                var actionRow = '<tr class="action-row">';
                actionRow += `<td colspan="${colCount}">
                    <div class="row">
                        <div class="col">
                            <div id="attachments-container"></div>
                            <input type="file" class="d-none form-control" name="files" id="files" multiple>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="m-0">
                                <i class="bx bx-fw bx-paperclip"></i> <a href="#" class="text-decoration-none" id="add-attachment">Add Attachment</a>
                            </h6>
                        </div>
                        <div class="col-6 text-end">
                            <div class="nsm-page-buttons page-button-container">
                                <button type="button" class="nsm-button" id="delete-transaction">
                                    Delete
                                </button>
                                <button type="button" class="nsm-button" id="edit-transaction">
                                    Edit
                                </button>
                                <button type="button" class="nsm-button" id="cancel-edit">
                                    Cancel
                                </button>
                                <button type="button" class="nsm-button primary" id="save-transaction">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </td>`;
                actionRow += '</tr>';
    
                $(actionRow).insertAfter(row);
    
                rows.each(function(rowIndex) {
                    $(this).addClass('editting');
    
                    $(this).find('td').each(function() {
                        var index = $(this).index();
                        var current = $(this).html();
                        var colData = $(this).data();
    
                        var headerRow = $($('#registers-table thead tr')[rowIndex]);
                        var colHead = $(headerRow.find('td')[index]);
                        switch(colHead.data().name) {
                            case 'Date' :
                                $(this).html(`<div class="nsm-field-group calendar"><input type="text" name="date" class="form-control nsm-field date" value="${current}"></div>`);
    
                                if(type === 'Inventory Qty Adjust' || type === 'Bill' || type === 'Invoice') {
                                    $(this).find('input').prop('disabled', true);
                                }
    
                                $(this).find('input').datepicker({
                                    format: 'mm/dd/yyyy',
                                    orientation: 'bottom',
                                    autoclose: true
                                });
                            break;
                            case 'Ref No.' :
                                $(this).html(`<input type="text" name="ref_no" class="form-control nsm-field" value="${current}" placeholder="Ref No.">`);
    
                                if(colData.disabled === 'true' || colData.disabled === 1) {
                                    $(this).find('input').prop('disabled', true);
                                }
                            break;
                            case 'Type' :
                                $(this).html(`<input type="text" name="type" class="form-control nsm-field" value="${current}" disabled>`);
                            break;
                            case 'Payee' :
                                $(this).html(`<select class="form-select nsm-field" name="payee"></select>`);
    
                                if(current !== "") {
                                    if(type !== "Bill" && type !== 'Vendor Credit') {
                                        $(this).find('select').append(`<option value="${colData.type+'-'+colData.id}">${current}</option>`);
                                    } else {
                                        $(this).find('select').append(`<option value="${colData.id}">${current}</option>`);
                                    }
                                }
    
                                if(colData.disabled === 'true' || colData.disabled === 1) {
                                    $(this).find('select').prop('disabled', true);
                                    $(this).find('select').select2({
                                        placeholder: 'Payee'
                                    });
                                } else {
                                    switch(type) {
                                        case 'Expense' :
                                            var fieldName = 'payee';
                                            var modalName = 'expenseModal';
                                        break;
                                        case 'CC Expense' :
                                            var fieldName = 'payee';
                                            var modalName = 'expenseModal';
                                        break;
                                        case 'Check' :
                                            var fieldName = 'payee';
                                            var modalName = 'checkModal';
                                        break;
                                        case 'Bill' :
                                            var fieldName = 'vendor';
                                            var modalName = 'billModal';
                                        break;
                                        case 'Vendor Credit' :
                                            var fieldName = 'vendor';
                                            var modalName = 'vendorCreditModal';
                                        break;
                                        case 'CC-Credit' :
                                            var fieldName = 'payee';
                                            var modalName = 'creditCardCreditModal';
                                        break;
                                        case 'Journal' :
                                            var fieldName = 'names';
                                            var modalName = 'journalEntryModal';
                                        break;
                                    }
    
                                    $(this).find('select').select2({
                                        placeholder: 'Payee',
                                        ajax: {
                                            url: '/accounting/get-dropdown-choices',
                                            dataType: 'json',
                                            data: function(params) {
                                                var query = {
                                                    search: params.term,
                                                    type: 'public',
                                                    field: fieldName,
                                                    modal: modalName
                                                }
    
                                                // Query parameters will be ?search=[term]&type=public&field=[type]
                                                return query;
                                            }
                                        },
                                        templateResult: formatResult,
                                        templateSelection: optionSelect
                                    });
                                }
                            break;
                            case 'Account' :
                                switch(type) {
                                    case 'Transfer' :
                                        var fieldName = 'transfer-account';
                                        var modalName = 'transferModal';
                                    break;
                                    case 'Credit Card Pmt' :
                                        var fieldName = colData.field;
                                        var modalName = 'payDownCreditModal';
                                    break;
                                    case 'Inventory Starting Value' :
                                        var fieldName = colData.field;
                                        var modalName = 'adjust-starting-value-modal';
                                    break;
                                    case 'Deposit' :
                                        var fieldName = colData.field;
                                        var modalName = 'depositModal';
                                    break;
                                    case 'Expense' :
                                        var fieldName = colData.field;
                                        var modalName = 'expenseModal';
                                    break;
                                    case 'CC Expense' :
                                        var fieldName = colData.field;
                                        var modalName = 'expenseModal';
                                    break;
                                    case 'Check' :
                                        var fieldName = colData.field;
                                        var modalName = 'checkModal';
                                    break;
                                    case 'CC-Credit' :
                                        var fieldName = colData.field;
                                        var modalName = 'creditCardCreditModal';
                                    break;
                                }
    
                                $(this).html(`<select class="form-select nsm-field" name="${fieldName !== undefined ? fieldName.replaceAll('-', '_') : 'account'}" ${current === '-Split-' ? 'disabled' : ''}><option value="${colData.id}">${current}</option></select>`);
    
                                if(colData.disabled === 'true' || colData.disabled === 1) {
                                    $(this).find('select').prop('disabled', true);
                                    $(this).find('select').select2({
                                        placeholder: 'Account'
                                    });
                                } else {
                                    $(this).find('select').select2({
                                        placeholder: 'Account',
                                        ajax: {
                                            url: '/accounting/get-dropdown-choices',
                                            dataType: 'json',
                                            data: function(params) {
                                                var query = {
                                                    search: params.term,
                                                    type: 'public',
                                                    field: fieldName,
                                                    modal: modalName
                                                }
                
                                                // Query parameters will be ?search=[term]&type=public&field=[type]
                                                return query;
                                            }
                                        },
                                        templateResult: formatResult,
                                        templateSelection: optionSelect
                                    });
                                }
                            break;
                            case 'Memo' :
                                $(this).html(`<input type="text" name="memo" class="form-control nsm-field" value="${current}" placeholder="Memo">`);
    
                                if(type === 'Inventory Qty Adjust' || type === 'Invoice' || type === 'Credit Memo') {
                                    $(this).find('input').prop('disabled', true);
                                }
                            break;
                            case 'Payment' :
                                if(current === '' && type !== 'Journal') {
                                    $(this).html(`<input type="number" name="payment" class="form-control nsm-field font-italic" value="" placeholder="Payment" disabled>`);
                                } else if(colData.disabled === 'true' || colData.disabled === 1) {
                                    $(this).html(`<input type="number" name="payment" class="form-control nsm-field text-end" step=".01" value="${current.replaceAll('$', '')}" placeholder="Payment" disabled>`);
                                } else {
                                    $(this).html(`<input type="number" name="payment" class="form-control nsm-field text-end" step=".01" value="${current.replaceAll('$', '')}" placeholder="Payment">`);
                                }
    
                                if(type === 'Inventory Qty Adjust') {
                                    $(this).find('input').prop('disabled', true);
                                }
                            break;
                            case 'Charge' :
                                if(current === '' && type !== 'Journal') {
                                    $(this).html(`<input type="number" name="charge" class="form-control nsm-field font-italic" value="" placeholder="Charge" disabled>`);
                                } else if(colData.disabled === 'true' || colData.disabled === 1) {
                                    $(this).html(`<input type="number" name="charge" class="form-control nsm-field text-end" step=".01" value="${current.replaceAll('$', '')}" placeholder="Charge" disabled>`);
                                } else {
                                    $(this).html(`<input type="number" name="charge" class="form-control nsm-field text-end" step=".01" value="${current.replaceAll('$', '')}" placeholder="Charge">`);
                                }
    
                                if(type === 'Inventory Qty Adjust') {
                                    $(this).find('input').prop('disabled', true);
                                }
                            break;
                            case 'Deposit' :
                                if(current === '' && type !== 'Journal') {
                                    $(this).html(`<input type="number" name="deposit" class="form-control nsm-field font-italic" value="" placeholder="Deposit" disabled>`);
                                } else if(colData.disabled === 'true' || colData.disabled === 1) {
                                    $(this).html(`<input type="number" name="deposit" class="form-control nsm-field text-end" step=".01" value="${current.replaceAll('$', '')}" placeholder="Deposit" disabled>`);
                                } else {
                                    $(this).html(`<input type="number" name="deposit" class="form-control nsm-field text-end" step=".01" value="${current.replaceAll('$', '')}" placeholder="Deposit">`);
                                }
    
                                if(type === 'Inventory Qty Adjust') {
                                    $(this).find('input').prop('disabled', true);
                                }
                            break;
                            case 'Increase' :
                                if(current === '' && type !== 'Journal') {
                                    $(this).html(`<input type="number" name="increase" class="form-control nsm-field font-italic" value="" placeholder="Increase" disabled>`);
                                } else if(colData.disabled === 'true' || colData.disabled === 1) {
                                    $(this).html(`<input type="number" name="increase" class="form-control nsm-field text-end" step=".01" value="${current.replaceAll('$', '')}" placeholder="Increase" disabled>`);
                                } else {
                                    $(this).html(`<input type="number" name="increase" class="form-control nsm-field text-end" step=".01" value="${current.replaceAll('$', '')}" placeholder="Increase">`);
                                }
    
                                if(type === 'Inventory Qty Adjust') {
                                    $(this).find('input').prop('disabled', true);
                                }
                            break;
                            case 'Decrease' :
                                if(current === '' && type !== 'Journal') {
                                    $(this).html(`<input type="number" name="decrease" class="form-control nsm-field font-italic" value="" placeholder="Decrease" disabled>`);
                                } else if(colData.disabled === 'true' || colData.disabled === 1) {
                                    $(this).html(`<input type="number" name="decrease" class="form-control nsm-field text-end" step=".01" value="${current.replaceAll('$', '')}" placeholder="Decrease" disabled>`);
                                } else {
                                    $(this).html(`<input type="number" name="decrease" class="form-control nsm-field text-end" step=".01" value="${current.replaceAll('$', '')}" placeholder="Decrease">`);
                                }
    
                                if(type === 'Inventory Qty Adjust') {
                                    $(this).find('input').prop('disabled', true);
                                }
                            break;
                            case 'Reconcile Status' :
                                $(this).html('');
                            break;
                            case 'Banking Status' :
                                $(this).html('');
                            break;
                            case 'Attachments' :
                                $(this).html(`<input type="text" class="form-control nsm-field" value="${current}" disabled>`);
                            break;
                            case 'Tax' :
                                $(this).html('');
                            break;
                            case 'Balance' :
                                $(this).html(`<input type="number" class="form-control nsm-field text-end" value="${current.replaceAll('$', '').replaceAll(',', '')}" disabled>`);
                            break;
                            case 'Open Balance' :
                                $(this).html(`<input type="number" class="form-control nsm-field text-end" value="${current.replaceAll('$', '').replaceAll(',', '')}" disabled>`);
                            break;
                        }
                    });
                });
            }
        }
    } else {
        var data = $(this).data();
        var transactionType = data.type;
        switch(data.type) {
            case 'CC Expense' :
                transactionType = 'expense';
            break;
            case 'CC Bill Payment' :
                transactionType = 'bill-payment';
            break;
        }
        transactionType = transactionType.replaceAll(' ', '-').toLowerCase();

        $.get(`/accounting/view-transaction/${transactionType}/${data.id}`, function(res) {
            if ($('div#modal-container').length > 0) {
                $('div#modal-container').html(res);
            } else {
                $('body').append(`
                    <div id="modal-container"> 
                        ${res}
                    </div>
                `);
            }

            switch(transactionType) {
                case 'expense' :
                    initModalFields('expenseModal', data);

                    $('#expenseModal').modal('show');
                break;
                case 'check' :
                    initModalFields('checkModal', data);

                    $('#checkModal').modal('show');
                break;
                case 'journal' :
                    initModalFields('journalEntryModal', data);

                    $('#journalEntryModal').modal('show');
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
                case 'bill-payment' :
                    $('#billPaymentModal #vendor').trigger('change');

                    initModalFields('billPaymentModal', data);
            
                    initBillsTable(data);
            
                    $('#billPaymentModal .dropdown-menu').on('click', function(e) {
                        e.stopPropagation();
                    });
            
                    $('#billPaymentModal').modal('show');
                break;
                case 'transfer' :
                    initModalFields('transferModal', data);

                    $('#transferModal #transfer_from_account').trigger('change');
                    $('#transferModal #transfer_to_account').trigger('change');

                    $('#transferModal').modal('show');
                break;
                case 'deposit' :
                    initModalFields('depositModal', data);

                    $('#depositModal').modal('show');
                break;
                case 'inventory-qty-adjust' :
                    rowInputs = $('#inventoryModal table#inventory-adjustments-table tbody tr:first-child()').html();
                    blankRow = $('#inventoryModal table#inventory-adjustments-table tbody tr:nth-child(2)').html();
                    rowCount = $('#inventoryModal table#inventory-adjustments-table tbody tr').length;

                    $('#inventoryModal table#inventory-adjustments-table tbody tr:first-child()').html(blankRow);
                    $('#inventoryModal table#inventory-adjustments-table tbody tr:first-child() td:nth-child(2)').html(1);

                    initModalFields('inventoryModal', data);

                    $('#inventoryModal').modal('show');
                break;
                case 'inventory-starting-value' :
                    initModalFields('adjust-starting-value-modal', data);

                    $('#adjust-starting-value-modal').modal('show');
                break;
                case 'credit-card-pmt' :
                    initModalFields('payDownCreditModal', data);

                    $('#payDownCreditModal').modal('show');
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
});

$(document).on('click', '#registers-table tbody tr.action-row #cancel-edit', function() {
    if($('#chk_show_in_one_line').prop('checked')) {
        var row = $('#registers-table tbody tr.editting');

        row.find('td').each(function() {
            var data = $(this).data();

            $(this).html(data.value);
        });
        $('#registers-table tbody tr.editting').removeClass('editting');
        $('#registers-table tbody tr.action-row').remove();
    } else {
        $('#registers-table tbody tr.editting td').each(function() {
            var el = $(this);
            var data = el.data();

            $(this).html(data.value);
        });

        $('#registers-table tbody tr.editting').removeClass('editting');
        $('#registers-table tbody tr.action-row').remove();
    }
});

$(document).on('click', '#registers-table tbody tr.action-row #save-transaction', function() {
    var data = new FormData();
    var row = $('#registers-table tbody tr.editting:first-child');
    var rowData = row.data();

    $('#registers-table tbody tr.editting td').each(function() {
        if($(this).find('select').length === 0) {
            var field = $(this).find('input');
        } else {
            var field = $(this).find('select');
        }

        if(field.length > 0) {
            data.set(field.attr('name'), field.val());
        }
    });

    $('#registers-table tbody tr.action-row #attachments-container .attachment-item').each(function() {
        var id = $(this).data('id');
        data.append('attachments[]', id);
    });

    if(rowData.hasOwnProperty('child_id')) {
        data.set('child_id', rowData.child_id);
    }

    $.ajax({
        url: '/accounting/chart-of-accounts/'+accountId+'/save-transaction/'+rowData.id,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            location.reload();
        }
    });
});

$(document).on('click', '#registers-table tbody tr.action-row #delete-transaction', function() {
    var html = 'Are you sure you want to delete this transaction?';

    var row = $('#registers-table tbody tr.editting:first-child');
    var data = row.data();
    var transactionType = data.type.replaceAll(' ', '-').toLowerCase();

    switch(data.type) {
        case 'CC Expense' :
            transactionType = 'expense';
        break;
        case 'CC Bill Payment' :
            transactionType = 'bill-payment';
        break;
    }

    var accountRow = $('#registers-table thead tr td[data-name="Account"]').index();
    var account = $(row.find('td')[accountRow]).text().trim();

    if(account === '-Split-') {
        html = 'This is just one part of a split transaction. Deleting it will remove the whole transaction. Are you sure you want to delete?'
    }

    Swal.fire({
        html: html,
        icon: 'warning',
        showCloseButton: false,
        confirmButtonColor: '#2ca01c',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        cancelButtonText: 'No',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if(result.isConfirmed) {
            $.ajax({
                url: `/accounting/delete-transaction/${transactionType}/${data.id}`,
                type: 'DELETE',
                success: function(result) {
                    location.reload();
                }
            });
        }
    });
});

$(document).on('click', '#registers-table tbody tr.action-row #edit-transaction', function() {
    var row = $('#registers-table tbody tr.editting');
    var data = row.data();
    var transactionType = data.type;
    switch(data.type) {
        case 'CC Expense' :
            transactionType = 'expense';
        break;
        case 'CC Bill Payment' :
            transactionType = 'bill-payment';
        break;
    }
    transactionType = transactionType.replaceAll(' ', '-').toLowerCase();

    $.get(`/accounting/view-transaction/${transactionType}/${data.id}`, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        switch(transactionType) {
            case 'expense' :
                initModalFields('expenseModal', data);

                $('#expenseModal').modal('show');
            break;
            case 'check' :
                initModalFields('checkModal', data);

                $('#checkModal').modal('show');
            break;
            case 'journal' :
                initModalFields('journalEntryModal', data);

                $('#journalEntryModal').modal('show');
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
            case 'bill-payment' :
                $('#billPaymentModal #vendor').trigger('change');

                initModalFields('billPaymentModal', data);
        
                initBillsTable(data);
        
                $('#billPaymentModal .dropdown-menu').on('click', function(e) {
                    e.stopPropagation();
                });
        
                $('#billPaymentModal').modal('show');
            break;
            case 'transfer' :
                initModalFields('transferModal', data);

                $('#transferModal #transfer_from_account').trigger('change');
                $('#transferModal #transfer_to_account').trigger('change');

                $('#transferModal').modal('show');
            break;
            case 'deposit' :
                initModalFields('depositModal', data);

                $('#depositModal').modal('show');
            break;
            case 'inventory-qty-adjust' :
                rowInputs = $('#inventoryModal table#inventory-adjustments-table tbody tr:first-child()').html();
                blankRow = $('#inventoryModal table#inventory-adjustments-table tbody tr:nth-child(2)').html();
                rowCount = $('#inventoryModal table#inventory-adjustments-table tbody tr').length;

                $('#inventoryModal table#inventory-adjustments-table tbody tr:first-child()').html(blankRow);
                $('#inventoryModal table#inventory-adjustments-table tbody tr:first-child() td:nth-child(2)').html(1);

                initModalFields('inventoryModal', data);

                $('#inventoryModal').modal('show');
            break;
            case 'inventory-starting-value' :
                initModalFields('adjust-starting-value-modal', data);

		        $('#adjust-starting-value-modal').modal('show');
            break;
            case 'credit-card-pmt' :
                initModalFields('payDownCreditModal', data);

                $('#payDownCreditModal').modal('show');
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
});

$(document).on('click', '#registers-table tbody tr.action-row #add-attachment', function() {
    $('#registers-table tbody tr.action-row input#files').trigger('click');
});

$(document).on('change', '#registers-table tbody tr.action-row input#files', function() {
    var data = new FormData();
    var totalfiles = this.files.length;

    for (var index = 0; index < totalfiles; index++) {
        data.append("files[]", this.files[index]);
    }

    $.ajax({
        url: '/accounting/chart-of-accounts/add-attachment',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            var attachments = JSON.parse(result);

            if($('#registers-table tbody tr.action-row #attachments-container div.attachment-item').length < 1) {
                $('#registers-table tbody tr.action-row #attachments-container').append('<h6 class="mt-0">ATTACHMENTS</h6>');
            }

            for(i in attachments) {
                var html = `<div class="d-inline-block px-1 attachment-item" data-id="${attachments[i].id}">
                    <h6 class="m-0"><a class="text-decoration-none view-attachment">${attachments[i].name}</a class="text-decoration-none">&nbsp;&nbsp;<a href="#" class="text-muted remove-attachment">&times;</a></h6>
                </div>`;
                $('#registers-table tbody tr.action-row #attachments-container').append(html);
            }
        }
    });
});

$('#chk_show_in_one_line').on('change', function() {
    var url = `${base_url}accounting/chart-of-accounts/view-register/${$('#account').val()}?`;

    url += $('#filter-find').attr('data-applied') !== '' ? `search=${$('#filter-find').attr('data-applied')}&` : '';
    url += $('#filter-reconcile-status').length > 1 && $('#filter-reconcile-status').attr('data-applied') !== 'all' ? `reconcile-status=${$('#filter-reconcile-status').attr('data-applied')}&` : '';
    url += $('#filter-transaction-type').length > 1 && $('#filter-transaction-type').attr('data-applied') !== 'all' ? `transaction-type=${$('#filter-transaction-type').attr('data-applied')}&` : '';
    url += $('#filter-payee').length > 1 && $('#filter-payee').attr('data-applied') !== 'all' ? `payee=${$('#filter-payee').attr('data-applied')}&` : '';
    url += $('#filter-date').attr('data-applied') !== 'all' ? `date=${$('#filter-date').attr('data-applied')}&` : '';
    url += $('#filter-from').attr('data-applied') !== '' ? `from=${$('#filter-from').attr('data-applied')}&` : '';
    url += $('#filter-to').attr('data-applied') !== '' ? `to=${$('#filter-to').attr('data-applied')}&` : '';
    url += $(this).prop('checked') === false ? `single-line=false&` : '';

    if(url.slice(-1) === '?' || url.slice(-1) === '&' || url.slice(-1) === '#') {
        url = url.slice(0, -1); 
    }

    location.href = url;
});