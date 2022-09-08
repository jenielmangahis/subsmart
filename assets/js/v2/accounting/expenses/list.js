$('.dropdown-menu.table-settings, #expense-table-filters').on('click', function(e) {
    e.stopPropagation();
});

$("#expenses-table").nsmPagination({
    itemsPerPage: parseInt($('#table-rows li a.active').html().trim())
});

$('.dropdown-menu#table-rows a.dropdown-item').on('click', function() {
    var count = $(this).html();
    $('.dropdown-menu#table-rows a.dropdown-item.active').removeClass('active');
    $(this).addClass('active');

    $(this).parent().parent().prev().find('span').html(count);
    $('.dropdown-menu#table-rows').prev().dropdown('toggle');

    $("#expenses-table").nsmPagination({
        itemsPerPage: parseInt(count)
    });
});

$('#select_category_modal #category-id').select2({
    ajax: {
        url: '/accounting/get-dropdown-choices',
        dataType: 'json',
        data: function(params) {
            var query = {
                search: params.term,
                type: 'public',
                field: 'expense-account',
                modal: 'select_category_modal'
            }

            // Query parameters will be ?search=[term]&type=public&field=[type]
            return query;
        }
    },
    templateResult: formatResult,
    templateSelection: optionSelect,
    dropdownParent: $('#select_category_modal')
});

$('#expenses-table tbody select[name="expense_account[]"]').each(function() {
    $(this).select2({
        ajax: {
            url: '/accounting/get-dropdown-choices',
            dataType: 'json',
            data: function(params) {
                var query = {
                    search: params.term,
                    type: 'public',
                    field: 'expense-account'
                }

                // Query parameters will be ?search=[term]&type=public&field=[type]
                return query;
            }
        },
        templateResult: formatResult,
        templateSelection: optionSelect
    });
});

$('#expense-table-filters select').each(function() {
    if($(this).attr('id') !== 'filter-payee' && $(this).attr('id') !== 'filter-category') {
        $(this).select2({
            minimumResultsForSearch: -1
        });
    } else {
        var field = $(this).attr('id') === 'filter-payee' ? 'payee' : 'expense-account';
        $(this).select2({
            ajax: {
                url: '/accounting/get-dropdown-choices',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        field: field,
                        for: 'filter'
                    }
        
                    // Query parameters will be ?search=[term]&type=public&field=[type]
                    return query;
                }
            },
            templateResult: formatResult,
            templateSelection: optionSelect,
            dropdownParent: $('#expense-table-filters')
        });
    }
});

$("#btn_print_expenses").on("click", function() {
    $("#expenses_table_print").printThis();
});

$('.dropdown-menu.table-settings input[name="col_chk"]').on('change', function() {
    var chk = $(this);
    var dataName = $(this).next().text();

    var index = $(`#expenses-table thead td[data-name="${dataName}"]`).index();
    $(`#expenses-table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });

    $(`#print_expenses_modal table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });

    $(`#print_preview_expenses_modal #expenses_table_print tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });
});

$('#expenses-table thead .select-all').on('change', function() {
    $('#expenses-table tbody tr:visible .select-one').prop('checked', $(this).prop('checked')).trigger('change');
});

$('#expenses-table tbody tr:visible .select-one').on('change', function() {
    var checked = $('#expenses-table tbody tr:visible .select-one:checked').length;
    var rows = $('#expenses-table tbody tr:visible .select-one').length;

    $('#expenses-table thead .select-all').prop('checked', checked === rows);

    var printable = true;
    var flag = true;
    $('#expenses-table tbody tr:visible .select-one:checked').each(function() {
        var row = $(this).closest('tr');
        var type = row.find('td:nth-child(3)').text();
        var categoryCol = row.find('td:nth-child(8)');
        if(type !== 'Purchase Order') {
            printable = false;
        }

        if(categoryCol.find('select').length === 0 && $(this).prop('checked')) {
            flag = false;
        }
    });

    if(printable && checked > 0) {
        $('#print-transactions').removeClass('disabled');
    } else {
        $('#print-transactions').addClass('disabled');
    }
    
    if(flag && checked > 0) {
        $('#categorize-selected').removeClass('disabled');
    } else {
        $('#categorize-selected').addClass('disabled');
    }
});

$('#print-transactions').on('click', function(e) {
    e.preventDefault();

    $('#expenses-table').parent().append('<form id="print-transactions-form" action="/accounting/expenses/print-multiple-transactions" method="post" class="d-none" target="_blank"></form>');

    $('#expenses-table tbody tr:visible .select-one:checked').each(function() {
        var row = $(this).closest('tr');
        var transactionType = row.find('td:nth-child(3)').text().trim();
        transactionType = transactionType.replaceAll(' ', '-');
        transactionType = transactionType.toLowerCase();

        if(row.find('td:nth-child(3)').text().trim() === 'Purchase Order') {
            if($(`#print-transactions-form input[value="${$(this).val()}"]`).length === 0) {
                $('#print-transactions-form').append(`<input type="hidden" value ="${transactionType+'_'+$(this).val()}" name="transactions[]">`);
            }
        } else {
            $('#print-transactions-form').find(`input[value="${transactionType+'_'+$(this).val()}"]`).remove();;
        }
    });

    $('#print-transactions-form').submit();

    $('#print-transactions-form').remove();
});

$('#categorize-selected').on('click', function(e) {
    e.preventDefault();

    $('#select_category_modal').modal('show');
});

$('#select_category_modal #category-id').on('change', function() {
    if($(this).val() === 'add-new') {
        dropdownEl = $(this);
        var query = `?modal=expense&field=expense-account`;

        $.get(`/accounting/get-dropdown-modal/account_modal${query}`, function(result) {
            if ($('div#modal-container').length > 0) {
                $('div#modal-container').html(result);
            } else {
                $('body').append(`
                    <div id="modal-container"> 
                        ${result}
                    </div>
                `);
            }

            initAccountModal();
        });
    }
});

$(document).on('submit', '#categorize-selected-form', function(e) {
    e.preventDefault();

    var data = new FormData();

    $('#expenses-table tbody tr:visible input.select-one:checked').each(function() {
        var row = $(this).closest('tr');
        var categoryCell = row.find('td:nth-child(8)');
        var transactionType = row.find('td:nth-child(3)').text().trim();
        transactionType = transactionType.replaceAll(' ', '-');
        transactionType = transactionType.toLowerCase();

        if(categoryCell.find('select').length > 0) {
            data.append('transaction_id[]', $(this).val());
            data.append('transaction_type[]', transactionType);
        }
    });

    $.ajax({
        url: `/accounting/expenses/categorize-transactions/${$('#category-id').val()}`,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            location.reload();
        }
    });
});

$('#print-checks').on('click', function(e) {
    e.preventDefault();

    $('.nsm-sidebar-menu #new-popup ul li a.ajax-modal[data-view="print_checks_modal"]').trigger('click');
});

$('#pay-bills').on('click', function(e) {
    e.preventDefault();

    $('.nsm-sidebar-menu #new-popup ul li a.ajax-modal[data-view="pay_bills_modal"]').trigger('click');
});

function resetExpenseFilter() {
    $('#filter-type').val('all-transactions').trigger('change');
    $('#filter-status').val('all').trigger('change');
    $('#filter-delivery-method').val('any').trigger('change');
    $('#filter-date').val('last-365-days').trigger('change');
    $('#filter-from').val('');
    $('#filter-to').val('');
    $('#filter-payee').html('<option value="all" selected>All</option>').trigger('change');
    $('#filter-category').html('<option value="all" selected>All</option>').trigger('change');

    applyExpenseFilter();
}

function applyExpenseFilter() {

}

$(function() {
    $('.date').datepicker({
        format: 'mm/dd/yyyy',
        orientation: 'bottom',
        autoclose: true
    });
});