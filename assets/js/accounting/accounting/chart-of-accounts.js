function showdiv(el)
{
    var value = $(el).val();
    var elementId = $(el).attr('id');
    
    if(value === 'Other') {
        if(elementId.includes('edit')) {
            $('#edit_balance').parent().addClass('hide');
            $('#edit_time_date').parent().parent().parent().removeClass('hide');
        } else {
            $('#balance').parent().addClass('hide');
            $('#time_date').parent().parent().parent().removeClass('hide');
        }
    } else {
        if(elementId.includes('edit')) {
            $('#edit_time_date').parent().parent().parent().addClass('hide');
            $('#edit_balance').parent().removeClass('hide');
        } else {
            $('#time_date').parent().parent().parent().addClass('hide');
            $('#balance').parent().removeClass('hide');
        }
    }
}

function col_type()
{
    if($('#chk_type').attr('checked'))
    {
        $('#chk_type').removeAttr('checked');
        $('.type').css('display','none');

    }
    else
    {
        $('#chk_type').attr('checked',"checked");
        $('.type').css('display','');
    }
}
function col_detailtype()
{
    if($('#chk_detail_type').attr('checked'))
    {
        $('#chk_detail_type').removeAttr('checked');
        $('.detailtype').css('display','none');

    }
    else
    {
        $('#chk_detail_type').attr('checked',"checked");
        $('.detailtype').css('display','');
    }
}
function col_nbalance()
{
    if($('#chk_nsmart_balance').attr('checked'))
    {
        $('#chk_nsmart_balance').removeAttr('checked');
        $('.nbalance').css('display','none');

    }
    else
    {
        $('#chk_nsmart_balance').attr('checked',"checked");
        $('.nbalance').css('display','');
    }
}
function col_balance()
{
    if($('#chk_balance').attr('checked'))
    {
        $('#chk_balance').removeAttr('checked');
        $('.balance').css('display','none');

    }
    else
    {
        $('#chk_balance').attr('checked',"checked");
        $('.balance').css('display','');
    }
}

$(function(){
    $('.date_picker input').datepicker({
        uiLibrary: 'bootstrap',
        todayBtn: "linked",
        language: "de"
    });
});

$(document).on('change', '#sub_account_type, #edit_sub_account_type', function() {
    var el = $(this);
    var id = el.val();
    $.get('/accounting/chart-of-accounts/get-account-type/'+id, function(result) {
        var res = JSON.parse(result);

        if(el.attr('id').includes('edit')) {
            $('#edit_account_type').html(`<option value="${res.id}">${res.account_name}</option>`).trigger('change');
        } else {
            $('#account_type').html(`<option value="${res.id}">${res.account_name}</option>`).trigger('change');
        }
    });
});

$(document).ready(function () {

    $('.form-validate').validate();

    //Initialize Select2 Elements

    $('.select2').select2({
        dropdownParent: $('.modal')
    });
    $('#myTabContent select').select2({
        minimumResultsForSearch: -1
    });

    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function (html) {
        var switchery = new Switchery(html, {size: 'small'});
    });

    $("#save").hide();
    $('.editbtn').click(function () {
        if ($("#save").html() == '') {
            $(".edit_field").each(function() {
                $("#save").show();
                $(this).prop('contenteditable', true);
            });
        } else {
            $("#save").hide();
            $(".edit_field").prop('contenteditable', false)
        }

        $("#save").html($("#save").html() == '' ? 'Save' : '')
    });

    $('#modalAddAccount').on('show.bs.modal', function() {
        var detail_type = $(this).find('#detail_type option:selected').text();

        $(this).find('#name').val(detail_type);
    });

    $('#search').on('keyup', function() {
        $('#chart-of-accounts-table').DataTable().ajax.reload();
    });

    $('#table_rows, #inc_inactive').on('change', function() {
        $('#chart-of-accounts-table').DataTable().ajax.reload();
    });

    $('.dropdown-menu').on('click', function(e) {
        e.stopPropagation();
    });

    $('#chart-of-accounts-table').DataTable({
        autoWidth: false,
        searching: false,
        processing: true,
        serverSide: true,
        lengthChange: false,
        info: false,
        pageLength: $('#table_rows').val(),
        order: [[1, 'asc']],
        ajax: {
            url: 'chart-of-accounts/load/',
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
                data: 'name',
                name: 'name',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    if(rowData.status === 1 || rowData.status === "1") {
                        $(td).html(cellData);
                        if(rowData.is_sub_acc) {
                            $(td).html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+cellData);
                        }
                    } else {
                        $(td).html(cellData+' (deleted)');
                    }
                }
            },
            {
                data: 'type',
                name: 'type',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).addClass('type');
                }
            },
            {
                orderable: false,
                data: 'detail_type',
                name: 'detail_type',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).addClass('detailtype');
                }
            },
            {
                data: 'nsmartrac_balance',
                name: 'nsmartrac_balance',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).addClass('nbalance');
                }
            },
            {
                data: 'bank_balance',
                name: 'bank_balance',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).addClass('balance');
                }
            },
            {
                orderable: false,
                data: null,
                name: 'action',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    if(rowData.status === 0 || rowData.status === "0") {
                        $(td).html(`
                        <div class="btn-group float-right">
                            <a href="#" class="btn text-primary d-flex align-items-center justify-content-center make-active">Make active</a>

                            <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Run Report</a>
                            </div>
                        </div>
                        `);
                    } else {
                        $(td).html(`
                        <div class="btn-group float-right">
                            <a href="#" class="btn text-primary d-flex align-items-center justify-content-center view-register">View Register</a>

                            <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);" id="editAccount" data-id="${rowData.id}">Edit</a>
                                <a class="dropdown-item make-inactive" href="#">Make Inactive (Reduce usage)</a>
                                <a class="dropdown-item" href="#">Run Report</a>
                            </div>
                        </div>
                        `);
                    }
                }
            }
        ]
    });

    $(document).on('click', '#chart-of-accounts-table .make-active', function(e) {
        e.preventDefault();
        var row = $(this).parent().parent().parent();
        var rowData = $('#chart-of-accounts-table').DataTable().row(row).data();
    
        $.ajax({
            url:`/accounting/chart-of-accounts/active/${rowData.id}`,
            success: function(res) {
                location.reload();
            }
        });
    });

    $(document).on('click', '#chart-of-accounts-table .make-inactive', function(e) {
        e.preventDefault();
        var row = $(this).parent().parent().parent().parent();
        var rowData = $('#chart-of-accounts-table').DataTable().row(row).data();

        $.ajax({
            url: `/accounting/chart-of-accounts/inactive/${rowData.id}`,
            success: function(res) {
                location.reload();
            }
        });
    });
})

$(document).on('click', '#add-new-account-button', function(e) {
    e.preventDefault();

    $.get('/accounting/get-dropdown-modal/account_modal', function(result) {
        if ($('#modal-container').length > 0) {
            $('div#modal-container').html(`<div class="full-screen-modal">${result}</div>`);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    <div class="full-screen-modal">
                        ${result}
                    </div>
                </div>
            `);
        }

        initAccountModal();
    });
});

$(document).on('click', '#editAccount', function(e){
    var target = e.currentTarget.dataset;
    $.get('/accounting/chart-of-accounts/edit/'+target.id, function(html) {
        if ($('#modal-container').length > 0) {
            $('div#modal-container').html(`<div class="full-screen-modal">${html}</div>`);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    <div class="full-screen-modal">
                        ${html}
                    </div>
                </div>
            `);
        }

        initAccountModal();
    });
});

$('#import_form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
        url:"/accounting/chart-of-accounts/import",
        method:"POST",
        data:new FormData(this),
        contentType:false,
        cache:false,
        processData:false,
        success:function(data){
            load_data();
            console.log(data);
        }
    })
});

$("#save").click(function(){
    $("#save").hide();
    $(".edit_field").each(function() {
        var id = $(this).data('id');
        var acc_name = $(this).html();
        $.ajax({
           url:'/accounting/chart_of_accounts/update_name',
           method: 'post',
           data: {id: id,name:acc_name},
           dataType: 'json',
        });
    });
});

$('#time_date, #edit_time_date').on('change', function() {
    if($(this).val() !== "") {
        if($(this).attr('id') === 'time_date') {
            $('#balance').parent().removeClass('hide');
        } else {
            $('#edit_balance').parent().removeClass('hide');
        }
    }
});