function showCol(el)
{
    var col = $(el).attr('id').replace('chk-', '');

    if($(el).prop('checked')) {
        $(`#employees-table .${col}`).removeClass('hide');
    } else {
        $(`#employees-table .${col}`).addClass('hide');
    }
}

$('#employee-status').select2({
    minimumResultsForSearch: -1
});

$('#employee-status').on('change', function() {
    table.ajax.reload();
});

$('#search').on('keyup', function() {
    table.ajax.reload();
});

$('#privacy').on('change', function() {
    if($(this).prop('checked')) {
        $('#employees-table tbody .pay-rate').html(`<i class="fa fa-lock"></i>`);
    } else {
        $('#employees-table tbody tr').each(function() {
            var data = table.row($(this)).data();
            
            $(this).find('.pay-rate').html(data.pay_rate);
        });
    }
});

var element = document.querySelector('#privacy');
var switchery = new Switchery(element, {size: 'small'});

var table = $('#employees-table').DataTable({
    autoWidth: false,
    searching: false,
    processing: true,
    serverSide: true,
    lengthChange: false,
    info: false,
    pageLength: 50,
    order: [[0, 'asc']],
    ajax: {
        url: 'employees/load/',
        dataType: 'json',
        contentType: 'application/json',
        type: 'POST',
        data: function(d) {
            d.status = $('#employee-status').val();
            d.columns[0].search.value = $('input#search').val();
            return JSON.stringify(d);
        },
        pagingType: 'full_numbers'
    },
    columns: [
        {
            data: 'name',
            name: 'name'
        },
        {
            data: 'pay_rate',
            name: 'pay_rate',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('pay-rate');
                if($('#chk-pay-rate').prop('checked') === false) {
                    $(td).addClass('hide');
                }
            }
        },
        {
            data: 'pay_method',
            name: 'pay_method',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('pay-method');
                if($('#chk-pay-method').prop('checked') === false) {
                    $(td).addClass('hide');
                }
            }
        },
        {
            data: 'status',
            name: 'status',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).html(`
                <div class="btn-group">
                    <button class="btn" type="button" id="statusDropdownButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ${cellData}&nbsp;&nbsp;<i class="fa fa-chevron-down"></i>
                    </button>

                    <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                        <a class="dropdown-item" href="#">Active</a>
                        <a class="dropdown-item" href="#">Paid leave of absence</a>
                        <a class="dropdown-item" href="#">Unpaid leave of absence</a>
                        <a class="dropdown-item" href="#">Not on payroll</a>
                        <a class="dropdown-item" href="#">Terminated</a>
                        <a class="dropdown-item" href="#">Deceased</a>
                    </div>
                </div>
                `);

                $(td).addClass('status');
                if($('#chk-status').prop('checked') === false) {
                    $(td).addClass('hide');
                }
            }
        },
        {
            data: 'email_address',
            name: 'email_address',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('email-address');
                if($('#chk-email-address').prop('checked') === false) {
                    $(td).addClass('hide');
                }
            }
        },
        {
            data: 'phone_number',
            name: 'phone_number',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('phone-num');
                if($('#chk-phone-num').prop('checked') === false) {
                    $(td).addClass('hide');
                }
            }
        }
    ]
});