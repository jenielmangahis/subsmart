function showCol(el)
{
    var col = $(el).attr('id').replace('chk-', '');

    if($(el).prop('checked')) {
        $(`#employees-table .${col}`).removeClass('hide');
    } else {
        $(`#employees-table .${col}`).addClass('hide');
    }
}

function initElements(method)
{
    $(`#${method}-employee-modal #hire_date`).datepicker({
        uiLibrary: 'bootstrap',
        todayBtn: "linked",
        language: "de"
    });

    $(`#${method}-employee-modal select`).select2();

    $(`#${method}-employee-modal #title`).select2({
        placeholder: 'Select Title',
        allowClear: true,
        width: 'resolve',
        delay: 250,
        ajax: {
            url: '/users/getRoles',
            type: "GET",
            dataType: "json",
            data: function(params) {
                var query = {
                    search: params.term
                };
                return query;
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    });

    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function(html) {
        var switchery = new Switchery(html, {
            size: 'small'
        });
    });

    var fname = [];
    var selected = [];
    var profilePhoto = new Dropzone('#employeeProfilePhoto', {
        url: '/users/profilePhoto',
        acceptedFiles: "image/*",
        maxFilesize: 20,
        maxFiles: 1,
        addRemoveLinks: true,
        init: function() {
            this.on("success", function(file, response) {
                var file_name = JSON.parse(response)['photo'];
                fname.push(file_name.replace(/\"/g, ""));
                selected.push(file);
                $('#photoIdAdd').val(JSON.parse(response)['id']);
                $('#photoNameAdd').val(JSON.parse(response)['photo']);
            });
        },
        removedfile: function(file) {
            var name = fname;
            var index = selected.map(function(d, index) {
                if (d == file) return index;
            }).filter(isFinite)[0];
            $.ajax({
                type: "POST",
                url: base_url + 'users/removeProfilePhoto',
                dataType: 'json',
                data: {
                    name: name,
                    index: index
                },
                success: function(data) {
                    if (data == 1) {
                        $('#photoId').val(null);
                    }
                }
            });
            //remove thumbnail
            var previewElement;
            return (previewElement = file.previewElement) != null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
        }
    });
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

$('#add-employee-button').on('click', function(e) {
    e.preventDefault();

    $.get('/accounting/employees/add', function(res) {
        $('.append-modal').html(res);
        
        initElements('add');

        $('#add-employee-modal').modal('show');
    });
});

$(document).on('click', '.showPass', function() {
    $(this).toggleClass('fa-eye-slash');
    if ($(this).prev('input[type="password"]').length == 1) {
        $(this).prev('input[type="password"]').attr('type', 'text');
        $(this).attr('title', 'Hide password').attr('data-original-title', 'Hide password').tooltip('update').tooltip('show');
    } else {
        $(this).prev('input[type="text"]').attr('type', 'password');
        $(this).attr('title', 'Show password').attr('data-original-title', 'Show password').tooltip('update').tooltip('show');
    }
});

$(document).on('click', '.showConfirmPass', function() {
    $(this).toggleClass('fa-eye-slash');
    if ($(this).prev('input[type="password"]').length == 1) {
        $(this).prev('input[type="password"]').attr('type', 'text');
        $(this).attr('title', 'Hide password').attr('data-original-title', 'Hide password').tooltip('update').tooltip('show');
    } else {
        $(this).prev('input[type="text"]').attr('type', 'password');
        $(this).attr('title', 'Show password').attr('data-original-title', 'Show password').tooltip('update').tooltip('show');
    }
});

var element = document.querySelector('#privacy');
var switchery = new Switchery(element, {size: 'small'});

$(document).on('click', '#employees-table tbody tr', function() {
    var data = table.row($(this)).data();

    $.get('/accounting/employees/edit/'+data.id, function(res) {
        $('.append-modal').html(res);

        initElements('edit');

        $('#edit-employee-modal').modal('show');
    });
});

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