$('.date').datepicker({
    format: 'mm/dd/yyyy',
    orientation: 'bottom',
    autoclose: true
});

$('#table-filters').on('click', function (e) {
    e.stopPropagation();
});

$('#filter-employee').select2({
    ajax: {
        url: `${base_url}/accounting/get-dropdown-choices`,
        dataType: 'json',
        data: function (params) {
            var query = {
                search: params.term,
                type: 'public',
                field: 'paycheck-employee'
            }

            // Query parameters will be ?search=[term]&type=public&field=[type]
            return query;
        }
    },
    templateResult: formatResult,
    templateSelection: optionSelect,
});

$('#filter-date-range').select2({
    minimumResultsForSearch: -1
});

$('#filter-date-range').on('change', function (e) {
    var dates = get_start_and_end_dates($(this).val());

    $('#date-range-start').val(dates.start_date);
    $('#date-range-end').val(dates.end_date);
});

$('#date-range-start, #date-range-end').on('change', function (e) {
    $('#filter-date-range').val('custom').trigger('change');
});

$('#apply-filter').on('click', function (e) {
    e.preventDefault();

    var filterDate = $('#filter-date-range').val();
    var filterEmployee = $('#filter-employee').val();
    var url = `${base_url}accounting/employees/paycheck-list?`;

    url += filterEmployee !== 'all' ? `employee=${filterEmployee}&` : '';
    url += filterDate !== 'last-pay-date' ? `date=${filterDate}&` : '';
    url += filterDate !== 'last-pay-date' ? `from=${$('#date-range-start').val().replaceAll('/', '-')}&to=${$('#date-range-end').val().replaceAll('/', '-')}` : '';

    if (url.slice(-1) === '?' || url.slice(-1) === '&' || url.slice(-1) === '#') {
        url = url.slice(0, -1);
    }

    location.href = url;
});

$('#reset-filter').on('click', function (e) {
    e.preventDefault();

    var url = `${base_url}accounting/employees/paycheck-list`;

    location.href = url;
});

$('#export-to-excel').on('click', function (e) {
    e.preventDefault();

    if ($('#export-form').length < 1) {
        $('body').append(`<form action="/accounting/employees/paycheck-list/export" method="post" id="export-form"></form>`);
    }

    $('#export-form').append(`<input type="hidden" name="type" value="excel">`);

    var url = window.location.href;
    var currentUrl = url.replace('#', '');
    var urlSplit = currentUrl.split('?');
    var query = urlSplit[1];

    if (query !== undefined) {
        var querySplit = query.split('&');

        $.each(querySplit, function (key, value) {
            var selectedVal = value.split('=');
            $('#export-form').append(`<input type="hidden" name="${selectedVal[0]}" value="${selectedVal[1]}">`);
        });
    }

    $('#export-form').submit();
    $('#export-form').remove();
});

$('#print-save-pdf-modal #save-as-pdf').on('click', function (e) {
    e.preventDefault();

    if ($('#export-form').length < 1) {
        $('body').append(`<form action="/accounting/employees/paycheck-list/export" method="post" id="export-form"></form>`);
    }

    $('#export-form').append(`<input type="hidden" name="type" value="pdf">`);

    var url = window.location.href;
    var currentUrl = url.replace('#', '');
    var urlSplit = currentUrl.split('?');
    var query = urlSplit[1];

    if (query !== undefined) {
        var querySplit = query.split('&');

        $.each(querySplit, function (key, value) {
            var selectedVal = value.split('=');
            $('#export-form').append(`<input type="hidden" name="${selectedVal[0]}" value="${selectedVal[1]}">`);
        });
    }

    $('#export-form').append(`<input type="hidden" name="orientation" value="${$('#print-save-pdf-modal input[name="pdf_orientation"]:checked').val()}">`);

    $('#export-form').submit();
    $('#export-form').remove();
});

$('#print-save-pdf-modal input[name="pdf_orientation"]').on('change', function () {
    var data = new FormData();

    var url = window.location.href;
    var currentUrl = url.replace('#', '');
    var urlSplit = currentUrl.split('?');
    var query = urlSplit[1];

    if (query !== undefined) {
        var querySplit = query.split('&');

        $.each(querySplit, function (key, value) {
            var selectedVal = value.split('=');
            data.append(selectedVal[0], selectedVal[1]);
            // $('#export-form').append(`<input type="hidden" name="${selectedVal[0]}" value="${selectedVal[1]}">`);
        });
    }

    data.append('orientation', $('#print-save-pdf-modal input[name="pdf_orientation"]:checked').val());

    $.ajax({
        url: '/accounting/employees/paycheck-list/change-orientation',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function (res) {
            $('#print-save-pdf-modal #paychecks-pdf').attr('src', res);
        }
    });
});

$('#print-save-pdf-modal #print-pdf').on('click', function (e) {
    e.preventDefault();

    let pdfWindow = window.open("");
    pdfWindow.document.write(`<iframe width="100%" height="100%" src="${$('#print-save-pdf-modal iframe#paychecks-pdf').attr('src')}"></iframe>`);
    $(pdfWindow.document).find('body').css('padding', '0');
    $(pdfWindow.document).find('body').css('margin', '0');
    $(pdfWindow.document).find('iframe').css('border', '0');
});

$('#paycheck-table .select-all').on('change', function () {
    $('#paycheck-table .select-one').prop('checked', $(this).prop('checked')).trigger('change');
});

$('#paycheck-table .select-one').on('change', function () {
    $('#paycheck-table .select-all').prop('checked', $('#paycheck-table .select-one:checked').length === $('#paycheck-table .select-one').length);

    if ($('#paycheck-table .select-one:checked').length > 0) {
        $('.print-paychecks-button').attr('id', 'print-paychecks');
        $('.print-paychecks-button').prop('disabled', false);
    } else {
        $('.print-paychecks-button').removeAttr('id');
        $('.print-paychecks-button').prop('disabled', true);
    }
});

$(document).on('click', '#print-paychecks', function (e) {
    e.preventDefault();

    if ($('#print-paycheck-form').length < 1) {
        $('body').append(`<form action="/accounting/print-multiple" method="post" id="print-paycheck-form" target="_blank"></form>`);
    }

    $('#paycheck-table .select-one:checked').each(function () {
        var row = $(this).closest('tr');
        var id = row.find('.select-one').val();

        $('#print-paycheck-form').append(`<input type="hidden" name="paycheck_id[]" value="${id}">`);
    });

    $('#print-paycheck-form').submit();
    $('#print-paycheck-form').remove();
});

$('#paycheck-table [name="check_number[]"]').on('change', function () {
    var checkNum = $(this).val();
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = new FormData();
    data.set('check_number', checkNum);

    $.ajax({
        url: `/accounting/update-paycheck-num/${id}`,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function (res) {

        }
    });
});

$('#paycheck-table .print-paycheck').on('click', function (e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    if ($('#print-paycheck-form').length < 1) {
        $('body').append(`<form action="/accounting/print-paycheck" method="post" id="print-paycheck-form" target="_blank"></form>`);
    }

    $('#print-paycheck-form').append(`<input type="hidden" name="paycheck_id" value="${id}">`);

    $('#print-paycheck-form').submit();
    $('#print-paycheck-form').remove();
});

$('#paycheck-table .delete-paycheck').on('click', function (e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    Swal.fire({
        title: 'Are you sure?',
        text: 'You are about to delete this paycheck. This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#aaa',
        confirmButtonText: 'Confirm'
    }).then((result) => {
        if (result.isConfirmed) {
            // Proceed with the delete action
            $.get(`/accounting/delete-paycheck/${id}`, function (res) {
                var result = JSON.parse(res);
                Swal.fire({
                    title: result.success ? 'Delete Successful!' : 'Failed!',
                    text: result.success ? 'Paycheck has been successfully deleted.' : 'Something is wrong in the process.',
                    icon: result.success ? 'success' : 'error',
                    showCancelButton: false,
                    confirmButtonText: 'Okay'
                }).then((r) => {
                    if (r.value && result.success) {
                        location.reload();
                    }
                });
            });
        }
    });
});

$('#paycheck-table .void-paycheck').on('click', function (e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();
    Swal.fire({
        title: 'Are you sure?',
        text: 'You are about to void this paycheck.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#aaa',
        confirmButtonText: 'Confirm'
    }).then((result) => {
        if (result.isConfirmed) {
            $.get(`/accounting/void-paycheck/${id}`, function (res) {
                var result = JSON.parse(res);
                Swal.fire({
                    title: result.success ? 'Void Successful!' : 'Failed!',
                    text: result.success ? 'Paycheck has been successfully voided.' : 'Something is wrong in the process.',
                    icon: result.success ? 'success' : 'error',
                    showCancelButton: false,
                    confirmButtonText: 'Okay',
                    confirmButtonColor: '#6a4a86',
                }).then((r) => {
                    if (r.value) {
                        if (result.success) {
                            location.reload();
                        }
                    }
                });
            });
        }
    });
});

$('#paycheck-table .edit-paycheck').on('click', function (e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();
});

function get_start_and_end_dates(val) {
    switch (val) {
        case 'custom':
            startDate = $(`#date-range-start`).val();
            endDate = $(`#date-range-end`).val();
            break;
        case 'this-month':
            var date = new Date();
            var to_date = new Date(date.getFullYear(), date.getMonth() + 1, 0);

            startDate = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            endDate = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
            break;
        case 'this-quarter':
            var date = new Date();
            var currQuarter = Math.floor(date.getMonth() / 3 + 1);

            switch (currQuarter) {
                case 1:
                    startDate = '01/01/' + date.getFullYear();
                    endDate = '03/31/' + date.getFullYear();
                    break;
                case 2:
                    startDate = '04/01/' + date.getFullYear();
                    endDate = '06/30/' + date.getFullYear();
                    break;
                case 3:
                    startDate = '07/01/' + date.getFullYear();
                    endDate = '09/30/' + date.getFullYear();
                    break;
                case 4:
                    startDate = '10/01/' + date.getFullYear();
                    endDate = '12/31/' + date.getFullYear();
                    break;
            }
            break;
        case 'this-year':
            var date = new Date();

            startDate = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            endDate = String(12).padStart(2, '0') + '/' + String(31).padStart(2, '0') + '/' + date.getFullYear();
            break;
        case 'last-month':
            var date = new Date();
            var to_date = new Date(date.getFullYear(), date.getMonth(), 0);

            startDate = String(date.getMonth()).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            endDate = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
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

            startDate = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
            endDate = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
            break;
        case 'last-year':
            var date = new Date();
            date.setFullYear(date.getFullYear() - 1);

            startDate = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            endDate = String(12).padStart(2, '0') + '/' + String(31).padStart(2, '0') + '/' + date.getFullYear();
            break;
        case 'first-quarter':
            var date = new Date();

            startDate = '01/01/' + date.getFullYear();
            endDate = '03/31/' + date.getFullYear();
            break;
        case 'second-quarter':
            var date = new Date();

            startDate = '04/01/' + date.getFullYear();
            endDate = '06/30/' + date.getFullYear();
            break;
        case 'third-quarter':
            var date = new Date();

            startDate = '07/01/' + date.getFullYear();
            endDate = '09/30/' + date.getFullYear();
            break;
        case 'fourth-quarter':
            var date = new Date();

            startDate = '10/01/' + date.getFullYear();
            endDate = '12/31/' + date.getFullYear();
            break;
    }

    return {
        start_date: startDate,
        end_date: endDate
    };
}

// Pagination
$(document).ready(function () {
    $("#paycheck-table").nsmPagination({
        itemsPerPage: 10,
    });
});

// Paycheck List Search
$(document).ready(function () {
    function performSearch() {
        var searchValue = $('#search_field').val().toLowerCase();
        var hasResults = false;

        $('#paycheck-table tbody tr').each(function () {
            if (!$(this).hasClass('no-results')) {
                var text = $(this).text().toLowerCase();
                if (text.indexOf(searchValue) === -1) {
                    $(this).hide();
                } else {
                    $(this).show();
                    hasResults = true;
                }
            }
        });

        $('#paycheck-table tbody .no-results').remove();

        if (!hasResults) {
            var noResultsRow = '<tr class="no-results">' +
                '<td colspan="9">' +
                '<div class="nsm-empty">' +
                '<span>No results found.</span>' +
                '</div>' +
                '</td>' +
                '</tr>';
            $('#paycheck-table tbody').append(noResultsRow);
        }
    }

    $('#search_field').on('keydown', function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            performSearch();
        }
    });

    $('.nsm-field-group.search').on('click', function () {
        performSearch();
    });
});

// Paycheck List Batch Actions
$(document).ready(function () {
    $('.select-all').on('change', function () {
        $('.select-one').prop('checked', $(this).prop('checked'));
        updateSelectedIds();
    });

    $('.select-one').on('change', function () {
        updateSelectedIds();
    });

    function updateSelectedIds() {
        let selectedIds = [];
        $('.select-one:checked').each(function () {
            selectedIds.push($(this).val());
        });
        $('#selected_ids').val(selectedIds.join(','));
    }

    $('#batch-void').on('click', function () {
        let selectedIds = $('#selected_ids').val();
        if (selectedIds) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to void selected paychecks?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Confirm',
                confirmButtonColor: '#6a4a86',
                cancelButtonText: 'Cancel',
                reverseButtons: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `${base_url}accounting_controllers/employees/batch_void`,
                        method: 'POST',
                        data: {
                            ids: selectedIds
                        },
                        success: function (response) {
                            Swal.fire(
                                'Voided!',
                                'The selected paychecks have been voided.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function (error) {
                            Swal.fire(
                                'Error!',
                                'An error occurred while voiding paychecks.',
                                'error'
                            );
                        }
                    });
                }
            });
        } else {
            Swal.fire(
                'No Selection',
                'Please select at least one paycheck.',
                'info'
            );
        }
    });

    $('#batch-delete').on('click', function () {
        let selectedIds = $('#selected_ids').val();
        if (selectedIds) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to delete selected paychecks?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Confirm',
                confirmButtonColor: '#6a4a86',
                cancelButtonText: 'Cancel',
                reverseButtons: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `${base_url}accounting_controllers/employees/batch_delete`,
                        method: 'POST',
                        data: {
                            ids: selectedIds
                        },
                        success: function (response) {
                            Swal.fire(
                                'Deleted!',
                                'The selected paychecks have been deleted.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function (error) {
                            Swal.fire(
                                'Error!',
                                'An error occurred while deleting paychecks.',
                                'error'
                            );
                        }
                    });
                }
            });
        } else {
            Swal.fire(
                'No Selection',
                'Please select at least one paycheck.',
                'info'
            );
        }
    });
});

$(document).ready(function () {
    $('.void-paychecks-button').on('click', function () {
        fetchVoidedPaychecks();
    });

    function fetchVoidedPaychecks() {
        $.ajax({
            url: `${base_url}accounting_controllers/employees/get_voided_paychecks`,
            method: 'GET',
            success: function (response) {
                let result = JSON.parse(response);
                if (result.success) {
                    displayVoidedPaychecks(result.data);
                } else {
                    Swal.fire('No Results', result.message, 'info');
                }
            },
            error: function (error) {
                Swal.fire('Error!', 'An error occurred while fetching voided paychecks.', 'error');
            }
        });
    }

    function displayVoidedPaychecks(paychecks) {
        let tbody = $('#paycheck-table tbody');
        tbody.empty();

        if (paychecks.length > 0) {
            paychecks.forEach(paycheck => {
                let row = `
                    <tr>
                        <td>
                            <div class="table-row-icon table-checkbox">
                                <input class="form-check-input select-one table-select" type="checkbox" value="${paycheck.id}">
                            </div>
                        </td>
                        <td>${paycheck.pay_date || 'No pay date'}</td>
                        <td>${paycheck.name || 'No name provided'}</td>
                        <td>${paycheck.total_pay ? `$${paycheck.total_pay}` : '0'}</td>
                        <td>${paycheck.net_pay ? `$${paycheck.net_pay}` : '0'}</td>
                        <td>${paycheck.pay_method || 'No payment method'}</td>
                        <td>Void</td>
                        <td>-</td>
                        <td>
                            <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item print-paycheck" href="#">Print</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item delete-paycheck" href="#">Delete</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item void-paycheck" href="#">Void</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item edit-paycheck" href="#">Edit</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                `;
                tbody.append(row);
            });
        } else {
            tbody.append(`
                <tr class="no-results">
                    <td colspan="9">
                        <div class="nsm-empty">
                            <span>No voided paychecks found.</span>
                        </div>
                    </td>
                </tr>
            `);
        }
    }
});
