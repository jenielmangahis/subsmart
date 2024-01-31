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

$('#attach_file_modal select').select2({
    minimumResultsForSearch: -1,
    dropdownParent: $('#attach_file_modal')
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

$('#expenses-table select[name="expense_account[]"]').on('change', function() {
    var val = $(this).val();

    var row = $(this).closest('tr');
    var transactionType = row.find('td:nth-child(3)').text().trim();
    transactionType = transactionType.replaceAll(' ', '-');
    transactionType = transactionType.toLowerCase();
    var transactionId = row.find('.select-one').val();

    var data = new FormData();
    data.set('transaction_type', transactionType);
    data.set('transaction_id', transactionId);
    data.set('new_category', val);

    $.ajax({
        url: '/accounting/expenses/update-transaction-category',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            var res = JSON.parse(result);

            Swal.fire({
                text: res.message,
                icon: res.success ? 'success' : 'error',
                showConfirmButton: false,
                showCloseButton: true,
                timer: 1500
            })
        }
    });
});

$(document).on('click', '#expenses-table .view-edit-expense', function() {
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get('/accounting/view-transaction/expense/'+id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#expenseModal';
        initModalFields('expenseModal', data);

        $('#expenseModal').modal('show');
    });
});

$(document).on('click', '#expenses-table .view-edit-check', function() {
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get('/accounting/view-transaction/check/'+id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#checkModal';
        initModalFields('checkModal', data);

        $('#checkModal').modal('show');
    });
});

$(document).on('click', '#expenses-table .view-edit-bill', function() {
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get('/accounting/view-transaction/bill/'+id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#billModal';
        initModalFields('billModal', data);

        $('#billModal').modal('show');
    });
});

$(document).on('click', '#expenses-table .view-edit-purch-order', function() {
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get('/accounting/view-transaction/purchase-order/'+id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#purchaseOrderModal';
        initModalFields('purchaseOrderModal', data);

        $('#purchaseOrderModal').modal('show');
    });
});

$(document).on('click', '#expenses-table .view-edit-vendor-credit', function() {
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get('/accounting/view-transaction/vendor-credit/'+id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#vendorCreditModal';
        initModalFields('vendorCreditModal', data);

        $('#vendorCreditModal').modal('show');
    });
});

$(document).on('click', '#expenses-table .view-edit-cc-credit', function() {
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get('/accounting/view-transaction/cc-credit/'+id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#creditCardCreditModal';
        initModalFields('creditCardCreditModal', data);

        $('#creditCardCreditModal').modal('show');
    });
});

$(document).on('click', '#expenses-table .view-edit-transfer', function() {
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get('/accounting/view-transaction/transfer/'+id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#transferModal #transfer_from_account, #transferModal #transfer_to_account').trigger('change');

        modalName = '#transferModal';
        initModalFields('transferModal', data);

        $('#transferModal').modal('show');
    });
});

$(document).on('click', '#expenses-table .view-edit-cc-payment', function() {
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get('/accounting/view-transaction/credit-card-pmt/'+id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#payDownCreditModal';
        initModalFields('payDownCreditModal', data);

        $('#payDownCreditModal').modal('show');
    });
});

$(document).on('click', '#expenses-table .view-edit-bill-payment', function() {
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get('/accounting/view-transaction/bill-payment/'+id, function(res) {
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
        initModalFields('billPaymentModal', data);

        $('#billPaymentModal #bills-table').nsmPagination({
            itemsPerPage: 150
        });

        $('#billPaymentModal #vendor-credits-table').nsmPagination({
            itemsPerPage: 150
        });

        $('#billPaymentModal .dropdown-menu').on('click', function(e) {
            e.stopPropagation();
        });

        $('#billPaymentModal').modal('show');
    });
});

$('#expenses-table .copy-transaction').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();
    var transactionType = row.find('td:nth-child(3)').text().trim();
    transactionType = transactionType.replaceAll(' (Check)', '');
    transactionType = transactionType.replaceAll(' (Credit Card)', '');
    transactionType = transactionType.replaceAll(' ', '-');
    transactionType = transactionType.toLowerCase();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get(`/accounting/copy-transaction/${transactionType}/${id}`, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#modal-container form .modal').parent().attr('onsubmit', 'submitModalForm(event, this)').removeAttr('data-href');

        modalName = '#'+$('#modal-container form .modal').attr('id');
        initModalFields($('#modal-container form .modal').attr('id'), data);

        $(modalName).modal('show');
    });
});

$('#expenses-table .copy-to-bill').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();
    var transactionType = row.find('td:nth-child(3)').text().trim();
    transactionType = transactionType.replaceAll(' ', '-');
    transactionType = transactionType.toLowerCase();
    
    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get('/accounting/expenses/copy-to-bill/'+id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#billModal').parent().attr('onsubmit', 'submitModalForm(event, this)').removeAttr('data-href');

        modalName = '#billModal';
        initModalFields('billModal', data);

        $('#billModal').modal('show');
    });
});

$('#expenses-table .delete-transaction').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();
    var transactionType = row.find('td:nth-child(3)').text().trim();
    transactionType = transactionType.replaceAll(' (Check)', '');
    transactionType = transactionType.replaceAll(' (Credit Card)', '');
    transactionType = transactionType.replaceAll(' ', '-');
    transactionType = transactionType.toLowerCase();

    $.ajax({
        url: `/accounting/delete-transaction/${transactionType}/${id}`,
        type: 'DELETE',
        dataType: 'json',
        success: function(result) {
            Swal.fire({
                text: result.message,
                icon: result.success ? 'success' : 'error',
                showConfirmButton: false,
                showCloseButton: true,
                timer: 1500,
                onClose: applyExpenseFilter
            })
        }
    });
});

$('#expenses-table .void-transaction').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();
    var transactionType = row.find('td:nth-child(3)').text().trim();
    transactionType = transactionType.replaceAll(' (Check)', '');
    transactionType = transactionType.replaceAll(' (Credit Card)', '');
    transactionType = transactionType.replaceAll(' ', '-');
    transactionType = transactionType.toLowerCase();

    $.get('/accounting/void-transaction/'+transactionType+'/'+id, function(res) {
        var result = JSON.parse(res);

        Swal.fire({
            text: result.message,
            icon: result.success ? 'success' : 'error',
            showConfirmButton: false,
            showCloseButton: true,
            timer: 1500,
            onClose: applyExpenseFilter
        })
    });
});

$('#expenses-table .view-attachment').on('click', function(e) {
    e.preventDefault();
    var data = e.currentTarget.dataset;

    window.open(data.href, "_blank");
});

Dropzone.autoDiscover = false;
let attachmentsDropzone = null;
$('#expenses-table .attach-file').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();
    var transactionType = row.find('td:nth-child(3)').text().trim();
    transactionType = transactionType.replaceAll(' (Check)', '');
    transactionType = transactionType.replaceAll(' (Credit Card)', '');
    transactionType = transactionType.replaceAll(' ', '-');
    transactionType = transactionType.toLowerCase();

    $('#attach_file_modal form').attr('action', `/accounting/expenses/attach/${transactionType}/${id}`);
    
    if (attachmentsDropzone) {
        attachmentsDropzone.destroy();
    }

    var attachmentContId = $(`#attach_file_modal .attachments .dropzone`).attr('id');
    attachmentsDropzone = new Dropzone(`#${attachmentContId}`, {
        url: `/accounting/expenses/attach-files/${transactionType}/${id}`,
        maxFilesize: 20,
        uploadMultiple: true,
        // maxFiles: 1,
        addRemoveLinks: true,
        init: function() {
            this.on("success", function(file, response) {
                applyExpenseFilter();

                $('#attach_file_modal form').removeAttr('action');
                $('#attach_file_modal').modal('hide');
            });
        },
    });

    $('#attach_file_modal').modal('show');
});

$('#attachments-filter').on('change', function() {
    var transactionType = $('#attach_file_modal form').attr('action').replace('/accounting/expenses/attach/', '').split('/')[0];
    var id = $('#attach_file_modal form').attr('action').replace('/accounting/expenses/attach/', '').split('/')[1];
    $.get(`/accounting/attachments/get-${$(this).val()}-attachments-ajax?type=${transactionType}&id=${id}`, function(res) {
        var attachments = JSON.parse(res);

        $('#attach_file_modal .attachments-container').html('');
        $.each(attachments, function(index, attachment) {
            var date = new Date(attachment.created_at.split(' ')[0]);
            $('#attach_file_modal .attachments-container').append(`
            <div class="col-12 col-md-3">
                <div class="card">
                    <img class="card-img-top m-0" src="/uploads/accounting/attachments/${attachment.stored_name}" alt="${attachment.uploaded_name}.${attachment.file_extension}">
                    <div class="card-body">
                        <h6 class="card-title">${attachment.uploaded_name}.${attachment.file_extension}</h6>
                        <p class="card-subtitle mb-2 text-muted">${String(date.getMonth() + 1).padStart(2, '0')+'/'+String(date.getDate()).padStart(2, '0')+'/'+date.getFullYear()}</p>
                        <ul class="d-flex justify-content-around list-unstyled">
                            <li><a href="#" class="text-decoration-none attach-to-transaction" data-id="${attachment.id}">Add</a></li>
                            <li><a href="/uploads/accounting/attachments/${attachment.stored_name}" target="_blank" class="text-decoration-none">Preview</a></li>
                        </ul>
                    </div>
                </div>
            </div>`);
        });
    });
});

$('#attach_file_modal a.attach-to-transaction').on('click', function(e) {
    e.preventDefault();

    $('#attach_file_modal #attach-file-form').prepend(`<input type="hidden" name="id" value="${e.currentTarget.dataset.id}">`);
    $('#attach_file_modal #attach-file-form').submit();
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

$('.export-items').on('click', function() {
    if($('#export-form').length < 1) {
        $('body').append('<form action="/accounting/expenses/export" method="post" id="export-form"></form>');
    }

    var fields = $('.dropdown-menu.table-settings input[name="col_chk"]:checked');
    fields.each(function() {
        $('#export-form').append(`<input type="hidden" name="fields[]" value="${$(this).attr('id').replace('chk_', '')}">`);
    });
    $('#export-form').append(`<input type="hidden" name="type" value="${$('#filter-type').attr('data-applied')}">`);
    $('#export-form').append(`<input type="hidden" name="status" value="${$('#filter-status').attr('data-applied')}">`);
    $('#export-form').append(`<input type="hidden" name="delivery_method" value="${$('#filter-delivery-method').attr('data-applied')}">`);
    $('#export-form').append(`<input type="hidden" name="date" value="${$('#filter-date').attr('data-applied')}">`);
    $('#export-form').append(`<input type="hidden" name="from_date" value="${$('#filter-from').attr('data-applied')}">`);
    $('#export-form').append(`<input type="hidden" name="to_date" value="${$('#filter-to').attr('data-applied')}">`);
    $('#export-form').append(`<input type="hidden" name="payee" value="${$('#filter-payee').attr('data-applied')}">`);
    $('#export-form').append(`<input type="hidden" name="category" value="${$('#filter-category').attr('data-applied')}">`);

    $('#export-form').append(`<input type="hidden" name="column" value="date">`);
    $('#export-form').append(`<input type="hidden" name="order" value="desc">`);

    $('#export-form').submit();
});

$('#export-form').on('submit', function(e) {
    e.preventDefault();
    this.submit();
    $(this).remove();
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

$('#expenses-print-transactions').on('click', function(e) {
    e.preventDefault();
    var print_url = base_url + 'accounting/expenses/print-multiple-transactions';
    $('#expenses-table').parent().append('<form id="print-transactions-form" action="' + print_url + '" method="post" class="d-none" target="_blank"></form>');
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

$('#expenses-categorize-selected').on('click', function(e) {
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

$('#new-time-activity').on('click', function(e) {
    e.preventDefault();
    $('.nsm-sidebar-menu #new-popup ul li a.ajax-modal[data-view="single_time_activity_modal"]').trigger('click');
});

$('#new-bill').on('click', function(e) {
    e.preventDefault();

    $('.nsm-sidebar-menu #new-popup ul li a.ajax-modal[data-view="bill_modal"]').trigger('click');
});

$('#new-expense').on('click', function(e) {
    e.preventDefault();

    $('.nsm-sidebar-menu #new-popup ul li a.ajax-modal[data-view="expense_modal"]').trigger('click');
});

$('#new-check').on('click', function(e) {
    e.preventDefault();

    $('.nsm-sidebar-menu #new-popup ul li a.ajax-modal[data-view="check_modal"]').trigger('click');
});

$('#new-purchase-order').on('click', function(e) {
    e.preventDefault();

    $('.nsm-sidebar-menu #new-popup ul li a.ajax-modal[data-view="purchase_order_modal"]').trigger('click');
});

$('#new-vendor-credit').on('click', function(e) {
    e.preventDefault();

    $('.nsm-sidebar-menu #new-popup ul li a.ajax-modal[data-view="vendor_credit_modal"]').trigger('click');
});

$('#new-cc-payment').on('click', function(e) {
    e.preventDefault();

    $('.nsm-sidebar-menu #new-popup ul li a.ajax-modal[data-view="pay_down_credit_card_modal"]').trigger('click');
});

$('#filter-from, #filter-to').on('change', function() {
    $('#filter-date').val('custom').trigger('change');
});

$('#filter-date').on('change', function() {
    var val = $(this).val();

    var date = new Date();
    switch(val) {
        case 'last-365-days' :
            date.setDate(date.getDate() - 365);

            var from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
            var to_date = '';
        break;
        case 'custom' :
            var from_date = $('#filter-from').val();
            var to_date = $('#filter-to').val();
        break;
        case 'today' :
            var from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
            var to_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
        break;
        case 'yesterday' :
            date.setDate(date.getDate() - 1);
            var from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
            var to_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
        break;
        case 'this-week' :
            var from = date.getDate() - date.getDay();
            var to = from + 6;

            var from_date = new Date(date.setDate(from));
            var to_date = new Date(date.setDate(to));

            from_date = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
            to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
        break;
        case 'this-month' :
            var to_date = new Date(date.getFullYear(), date.getMonth() + 1, 0);

            from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
        break;
        case 'this-quarter' :
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
        break;
        case 'this-year' :
            var from_date = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            var to_date = String(12).padStart(2, '0') + '/' + String(31).padStart(2, '0') + '/' + date.getFullYear();
        break;
        case 'last-week' :
            var from = date.getDate() - date.getDay();

            var from_date = new Date(date.setDate(from - 7));
            var to_date = new Date(date.setDate(date.getDate() + 6));

            from_date = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
            to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
        break;
        case 'last-month' :
            var to_date = new Date(date.getFullYear(), date.getMonth(), 0);

            from_date = String(date.getMonth()).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
        break;
        case 'last-quarter' :
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
        break;
        case 'last-year' :
            date.setFullYear(date.getFullYear() - 1);

            var from_date = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            var to_date = String(12).padStart(2, '0') + '/' + String(31).padStart(2, '0') + '/' + date.getFullYear();
        break;
        case 'all-dates' :
            var from_date = '';
            var to_date = '';
        break;
    }

    $('#filter-from').val(from_date);
    $('#filter-to').val(to_date);
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
    $('#filter-type').attr('data-applied', $('#filter-type').val());
    $('#filter-status').attr('data-applied', $('#filter-status').val());
    $('#filter-delivery-method').attr('data-applied', $('#filter-delivery-method').val());
    $('#filter-date').attr('data-applied', $('#filter-date').val());
    $('#filter-from').attr('data-applied', $('#filter-from').val());
    $('#filter-to').attr('data-applied', $('#filter-to').val());
    $('#filter-payee').attr('data-applied', $('#filter-payee').val());
    $('#filter-category').attr('data-applied', $('#filter-category').val());

    loadExpenseTransactions();
}

function loadExpenseTransactions() {
    var data = new FormData();

    data.set('type', $('#filter-type').attr('data-applied'));
    data.set('status', $('#filter-status').attr('data-applied'));
    data.set('delivery_method', $('#filter-delivery-method').attr('data-applied'));
    data.set('date', $('#filter-date').attr('data-applied'));
    data.set('from_date', $('#filter-from').attr('data-applied'));
    data.set('to_date', $('#filter-to').attr('data-applied'));
    data.set('payee', $('#filter-payee').attr('data-applied'));
    data.set('category', $('#filter-category').attr('data-applied'));

    $.ajax({
        url: `/accounting/expenses/get-expense-transactions`,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            var transactions = JSON.parse(result);
            $('#expenses-table thead .select-all').prop('checked', false);
            $('#print-transactions').addClass('disabled');
            $('#categorize-selected').addClass('disabled');
            $('#expenses-table tbody').html('');

            if(transactions.length > 0) {
                $.each(transactions, function(index, transaction) {
                    var category = '';

                    if(transaction.category !== '-Split-' && transaction.category !== '') {
                        category = `<select name="expense_account[]" class="form-control nsm-field">
                            <option value="${transaction.category.id}">${transaction.category.name}</option>
                        </select>`
                    } else {
                        category = transaction.category;
                    }

                    var attachments = '';
                    if(transaction.attachments.length > 0) {
                        var extension = ['jpg', 'jpeg', 'png'];
                        attachments += `<div class="dropdown">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="bx bx-fw">${transaction.attachments.length}</i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" style="min-width: 300px">`;
                            $.each(transaction.attachments, function(key, attachment) {
                                attachments += `<li>
                                    <a href="#" class="dropdown-item view-attachment" data-href="/uploads/accounting/attachments/${attachment.stored_name}">
                                        <div class="row">
                                            <div class="col-5 pr-0">
                                                ${extension.includes(attachment.file_extension) ? `<img src='/uploads/accounting/attachments/${attachment.stored_name}' class='m-auto w-100'>` : `<div class='bg-muted text-center d-flex justify-content-center align-items-center h-100 text-white'><p class='m-0'>NO PREVIEW AVAILABLE</p></div>`}
                                            </div>
                                            <div class="col-7">
                                                <div class="d-flex align-items-center h-100 w-100">
                                                    <span class="text-truncate">${attachment.uploaded_name+'.'+attachment.file_extension}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>`;
                            });

                        attachments += `</ul>
                        </div>`;
                    }
                    $('#expenses-table tbody').append(`
                    <tr data-type="${transaction.type}">
                        <td>
                            <div class="table-row-icon table-checkbox">
                                <input class="form-check-input select-one table-select" type="checkbox" value="${transaction.id}">
                            </div>
                        </td>
                        <td>${transaction.date}</td>
                        <td>${transaction.type}</td>
                        <td>${transaction.number === null ? '' : transaction.number}</td>
                        <td>${transaction.payee}</td>
                        <td>${transaction.method}</td>
                        <td>${transaction.source}</td>
                        <td>${category}</td>
                        <td>${transaction.memo}</td>
                        <td>${transaction.due_date}</td>
                        <td>${transaction.balance}</td>
                        <td>${transaction.total}</td>
                        <td>${transaction.status}</td>
                        <td class="overflow-visible">${attachments}</td>
                        <td>${transaction.manage}</td>
                    </tr>
                    `);
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
            } else {
                $('#expenses-table tbody').html(`<tr>
                <td colspan="15">
                    <div class="nsm-empty">
                        <span>No results found.</span>
                    </div>
                </td>
            </tr>`);
            }
        }
    });
}

$(function() {
    $('.date').datepicker({
        format: 'mm/dd/yyyy',
        orientation: 'bottom',
        autoclose: true
    });
});