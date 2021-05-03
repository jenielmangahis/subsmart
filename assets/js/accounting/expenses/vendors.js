$('#address_chk, #attachments_chk, #phone_chk, #email_chk').on('change', function() {
    var elementId = $(this).attr('id');
    var column = elementId.replace('_chk', '');

    if($(this).prop('checked')) {
        $(`#vendors-table .${column}`).removeClass('hide');
    } else {
        $(`#vendors-table .${column}`).addClass('hide');
    }
});

$(document).on('click', '#vendors-table tbody tr td:not(:first-child,:last-child)', function() {
    var data = table.row($(this).parent()).data();
    
    window.location.href = '/accounting/vendors/view/'+data.id;
});

$(document).on('change', '#new-vendor-modal #use_display_name', function() {
    if($(this).prop('checked')) {
        $('#new-vendor-modal #print_on_check_name').prop('disabled', true);
    } else {
        $('#new-vendor-modal #print_on_check_name').prop('disabled', false);
    }
});

$('.datepicker').datepicker({
    uiLibrary: 'bootstrap',
    todayBtn: "linked",
    language: "de"
});

$('select').select2();

var attachmentId = [];
var attachedFiles = [];
var attachments = new Dropzone('#vendorAttachments', {
    url: '/accounting/vendors/attachments',
    maxFilesize: 20,
    uploadMultiple: true,
    // maxFiles: 1,
    addRemoveLinks: true,
    init: function() {
        this.on("success", function(file, response) {
            var ids = JSON.parse(response)['attachment_ids'];
            for(i in ids) {
                if($('#new-vendor-modal').find(`input[name="attachments[]"][value="${ids[i]}"]`).length === 0) {
                    $('#new-vendor-modal #vendorAttachments').parent().append(`<input type="hidden" name="attachments[]" value="${ids[i]}">`);
                }

                attachmentId.push(ids[i]);
            }
            attachedFiles.push(file);
        });
    },
    removedfile: function(file) {
        var ids = attachmentId;
        var index = attachedFiles.map(function(d, index) {
            if (d == file) return index;
        }).filter(isFinite)[0];

        $('#new-vendor-modal').find(`input[name="attachments[]"][value="${ids[index]}"]`).remove();

        //remove thumbnail
        var previewElement;
        return (previewElement = file.previewElement) !== null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
    }
});

$('#terms').on('change', function() {
    if($(this).val() === 'add-new') {
        $('#payment_term_modal').modal('show');
    }
});

$('#payment_term_modal #payment-term-form').on('submit', function(e) {
    e.preventDefault();

    var data = new FormData(this);

    $.ajax({
        url: '/accounting/terms/ajax-add-term',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(res) {
            var result = JSON.parse(res);

            $('#terms').append(`<option value="${result.data.id}">${result.data.name}</option>`);
            var terms = $('#terms option:not([value=""],[value="add-new"])');

            terms.sort(function(a, b) {
                if (a.text > b.text) return 1;
                if (a.text < b.text) return -1;
                return 0;
            });

            $("#terms").empty().append(`
                <option value="" disabled selected>&nbsp;</option>
                <option value="add-new">&plus; Add new</option> 
            `);
            $("#terms").append(terms);

            $('#payment_term_modal').modal('hide');
        }
    });
});

var table = $('#vendors-table').DataTable({
    autoWidth: false,
    searching: false,
    processing: true,
    serverSide: true,
    lengthChange: false,
    info: false,
    pageLength: $('#table_rows').val(),
    order: [[0, 'asc']],
    ajax: {
        url: 'vendors/load/',
        dataType: 'json',
        contentType: 'application/json',
        type: 'POST',
        data: function(d) {
            d.inactive = $('#inc_inactive').prop('checked') === true ? 1 : 0;
            d.length = $('#table_rows').val();
            d.columns[0].search.value = $('input#search').val();
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
                $(td).html(`<input type="checkbox" value="${rowData.id}">`);
			}
		},
        {
            data: 'name',
            name: 'name',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).html(`<a href="/accounting/vendors/view/${rowData.id}">${cellData}</a>`);

                if(rowData.company_name !== "" && rowData.company_name !== null) {
                    $(td).append(`<p class="m-0 text-muted">${rowData.company_name}</p>`);
                }
            }
        },
        {
            data: 'address',
            name: 'address',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('address');
                if($('#address_chk').prop('checked') === false) {
                    $(td).addClass('hide');
                }
            }
        },
        {
            data: 'phone',
            name: 'phone',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('phone');
                if($('#phone_chk').prop('checked') === false) {
                    $(td).addClass('hide');
                }
            }
        },
        {
            data: 'email',
            name: 'email',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('email');
                if($('#email_chk').prop('checked') === false) {
                    $(td).addClass('hide');
                }
            }
        },
        {
            data: 'attachments',
            name: 'attachments',
            orderable: false,
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('attachments');
                if($('#attachments_chk').prop('checked') === false) {
                    $(td).addClass('hide');
                }
            }
        },
        {
            data: 'open_balance',
            name: 'open_balance'
        },
        {
            orderable: false,
			data: null,
			name: 'action',
			fnCreatedCell: function(td, cellData, rowData,row, col) {
                $(td).html(`
                <div class="btn-group float-right">
                    <button class="btn d-flex align-items-center justify-content-center text-info">
                        Create bill
                    </button>

                    <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>

                    <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                        <a class="dropdown-item" href="#">Create expense</a>
                        <a class="dropdown-item" href="#">Write check</a>
                        <a class="dropdown-item" href="#">Create purchase order</a>
                        <a class="dropdown-item" href="#">Make inactive</a>
                    </div>
                </div>
                `);
            }
        }
    ]
});