$('.dropdown-menu.table-settings').on('click', function(e) {
    e.stopPropagation();
});

$("#vendors-table").nsmPagination({
    itemsPerPage: parseInt($('#table-rows li a.active').html().trim())
});

$('.dropdown-menu#table-rows a.dropdown-item').on('click', function() {
    var count = $(this).html();
    $('.dropdown-menu#table-rows a.dropdown-item.active').removeClass('active');
    $(this).addClass('active');

    $(this).parent().parent().prev().find('span').html(count);
    $('.dropdown-menu#table-rows').prev().dropdown('toggle');

    $("#vendors-table").nsmPagination({
        itemsPerPage: parseInt(count)
    });
});

$('.dropdown-menu.table-settings input[name="col_chk"]').on('change', function() {
    var chk = $(this);
    var dataName = $(this).next().text();

    var index = $(`#vendors-table thead td[data-name="${dataName}"]`).index();
    $(`#vendors-table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });

    $(`#print_vendors_modal table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });

    $(`#print_preview_vendors_modal #vendors_table_print tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });
});

$("#btn_print_vendors").on("click", function() {
    $("#vendors_table_print").printThis();
});

$("#search_field").on("input", debounce(function() {
    let _form = $(this).closest("form");

    _form.submit();
}, 1500));

$('#inc_inactive').on('change', function() {
    var currUrl = window.location.href;
    var urlSplit = currUrl.split('/');

    if(currUrl.slice(-1) === '#') {
        currUrl = currUrl.slice(0, -1); 
    }
    
    if($(this).prop('checked')) {
        if(urlSplit[urlSplit.length - 1] === 'vendors') {
            location.href='vendors?status=all';
        } else {
            location.href = currUrl+'&status=all';
        }
    } else {
        if(currUrl.includes('&status=all')) {
            location.href=currUrl.replace('&status=all', '');
        } else {
            location.href=currUrl.replace('status=all', '');
        }
    }
});

$('.export-items').on('click', function() {
    if($('#export-form').length < 1) {
        $('body').append('<form action="/accounting/vendors/export-vendors" method="post" id="export-form"></form>');
    }

    var fields = $('.dropdown-menu.table-settings input[name="col_chk"]:checked');
    fields.each(function() {
        $('#export-form').append(`<input type="hidden" name="fields[]" value="${$(this).attr('id').replace('_chk', '')}">`);
    });

    $('#export-form').append(`<input type="hidden" name="inactive" value="${$('#inc_inactive').prop('checked') ? 1 : 0}">`);
    $('#export-form').append(`<input type="hidden" name="search" value="${$('#search_field').val()}">`);

    if($('.nsm-counter.selected').length > 0) {
        $('#export-form').append(`<input type="hidden" name="transaction" value="${$('.nsm-counter.selected').attr('id')}">`);
    }

    $('#export-form').append(`<input type="hidden" name="column" value="name">`);
    $('#export-form').append(`<input type="hidden" name="order" value="asc">`);

    $('#export-form').submit();
});

$('#export-form').on('submit', function(e) {
    e.preventDefault();
    this.submit();
    $(this).remove();
});

$('#add-vendor-button').on('click', function(e) {
    e.preventDefault();

    $.get(base_url + 'accounting/get-add-vendor-details-modal', function(result) {
        if ($('#modal-container').length > 0) {
            $('div#modal-container').html(`${result}`);
        } else {
            $('body').append(`
                <div id="modal-container">
                    ${result}
                </div>
            `);
        }

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
                        if ($('#vendor-modal').find(`input[name="attachments[]"][value="${ids[i]}"]`).length === 0) {
                            $('#modal-container #vendor-modal #vendAtt').parent().append(`<input type="hidden" name="attachments[]" value="${ids[i]}">`);
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

                $('#modal-container #vendor-modal').find(`input[name="attachments[]"][value="${ids[index]}"]`).remove();

                //remove thumbnail
                var previewElement;
                return (previewElement = file.previewElement) !== null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
            }
        });

        $('#modal-container #vendor-modal select').select2({
            dropdownParent: $('#modal-container #vendor-modal')
        });
        $('#modal-container #vendor-modal .date').datepicker({
            format: 'mm/dd/yyyy',
            orientation: 'bottom',
            autoclose: true
        });

        $('#modal-container #vendor-modal form').attr('action', '/accounting/vendors/add');
        $('#modal-container #vendor-modal form').attr('method', 'post');
        $('#modal-container #vendor-modal form').attr('novalidate', 'novalidate');
        $('#modal-container #vendor-modal form').attr('enctype', 'multipart/form-data');
        $('#modal-container #vendor-modal form').addClass('form-validate');
        $('#modal-container #vendor-modal form').removeAttr('id');

        $('#modal-container #vendor-modal').modal('show');
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

$('#vendors-table .select-all').on('change', function() {
    if($(this).prop('checked')) {
        $('#vendors-table tbody input.select-one').prop('checked', true);
    } else {
        $('#vendors-table tbody input.select-one').prop('checked', false);
    }
});

$('#vendors-table .select-one').on('change', function() {
    var checked = $('#vendors-table tbody tr:visible input.select-one:checked');
    var totalrows = $('#vendors-table tbody tr:visible input.select-one').length;

    $('#vendors-table .select-all').prop('checked', checked.length === totalrows);

    var href = 'mailto:';
    checked.each(function() {
        var row = $(this).closest('tr');
        var email = row.find('td:nth-child(5)').html().trim();

        if(email !== '') {
            href += ' '+email+',';
        }
    });

    if(href !== 'mailto:') {
        $('#email').removeClass('disabled');
    } else {
        $('#email').addClass('disabled');
    }

    if(checked.length > 0) {
        $('#make-inactive').removeClass('disabled');
    } else {
        $('#make-inactive').addClass('disabled');
    }
    $('#email').attr('href', href);
});

$('#make-inactive').on('click', function() {
    var data = new FormData();

    $('#vendors-table tbody input.select-one:checked').each(function() {
        data.append('vendors[]', $(this).val());
    });

    $.ajax({
        url: '/accounting/vendors/make-inactive',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            location.reload();
        }
    });
});

$('#vendors-table .make-inactive').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var data = new FormData();
    data.set('vendors[]', row.find('.select-one').val());

    $.ajax({
        url: '/accounting/vendors/make-inactive',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            location.reload();
        }
    });
});

$('#vendors-table .make-active').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var data = new FormData();
    data.set('vendors[]', row.find('.select-one').val());

    $.ajax({
        url: '/accounting/vendors/make-active',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            location.reload();
        }
    });
});

$('.nsm-counter').on('click', function() {
    var currUrl = window.location.href;

    if(currUrl.slice(-1) === '#') {
        currUrl = currUrl.slice(0, -1); 
    }

    var urlSplit = currUrl.split('/');

    if($(this).hasClass('selected')) {
        if(currUrl.includes(`&transaction=${$(this).attr('id')}`)) {
            location.href = currUrl.replace(`&transaction=${$(this).attr('id')}`, '');
        } else {
            location.href = currUrl.replace(`transaction=${$(this).attr('id')}`, '');
        }
    } else {
        if($('.nsm-counter.selected').length > 0) {
            var selected = $('.nsm-counter.selected').attr('id');
    
            currUrl = currUrl.replace(`transaction=${selected}`, `transaction=${$(this).attr('id')}`);
    
            location.href = currUrl;
        } else {
            if(urlSplit[urlSplit.length - 1] === 'vendors') {
                location.href=`vendors?transaction=${$(this).attr('id')}`;
            } else {
                location.href = currUrl+`&transaction=${$(this).attr('id')}`;
            }
        }
    }
});

$('#vendors-table .create-bill').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');

    $.get('/accounting/get-other-modals/bill_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#billModal #vendor').html(`<option value="${row.find('.select-one').val()}">${row.find('td:nth-child(2)').text().trim()}</option>`).trigger('change');

        modalName = '#billModal';
        initModalFields('billModal');

        $('#billModal').modal('show');
    });
});

$('#vendors-table .create-expense').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');

    $.get('/accounting/get-other-modals/expense_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#expenseModal #payee').html(`<option value="vendor-${row.find('.select-one').val()}">${row.find('td:nth-child(2)').text().trim()}</option>`).trigger('change');

        modalName = '#expenseModal';
        initModalFields('expenseModal');

        $('#expenseModal').modal('show');
    });
});

$('#vendors-table .write-check').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');

    $.get('/accounting/get-other-modals/check_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#checkModal #payee').html(`<option value="vendor-${row.find('.select-one').val()}">${row.find('td:nth-child(2)').text().trim()}</option>`).trigger('change');

        modalName = '#checkModal';
        initModalFields('checkModal');

        $('#checkModal').modal('show');
    });
});

$('#vendors-table .create-purchase-order').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');

    $.get(base_url + 'accounting/get-other-modals/purchase_order_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#purchaseOrderModal #vendor').html(`<option value="vendor-${row.find('.select-one').val()}">${row.find('td:nth-child(2)').text().trim()}</option>`).trigger('change');

        modalName = '#purchaseOrderModal';
        initModalFields('purchaseOrderModal');

        $('#purchaseOrderModal').modal('show');
    });
});