function showOptions(s)
{
    var option_text = s[s.selectedIndex].innerHTML;

    $('#modalAddAccount #name').val(option_text);
}

function check(el)
{
    var x = document.getElementById($(el).attr('id')).checked;
    if(x == true)
    {
        $(el).parent().children('select[name="sub_account_type"]').removeAttr('disabled','disabled');
    }
    else
    {
        $(el).parent().children('select[name="sub_account_type"]').attr('disabled','disabled');

        $.get('/accounting/chart-of-accounts/get-all-account-types', function(result) {
            var res = JSON.parse(result);

            if($(el).attr('id').includes('edit')) {
                var selected = $('#edit_account_type').val();
                $('#edit_account_type').html('');
                for(i in res) {
                    $('#edit_account_type').append(`<option value="${res[i].id}">${res[i].account_name}</option>`);
                }
                $('#edit_account_type').val(selected);
                $('#edit_account_type').trigger('change');
            } else {
                var selected = $('#account_type').val();
                $('#account_type').html('');
                for(i in res) {
                    $('#account_type').append(`<option value="${res[i].id}">${res[i].account_name}</option>`);
                }
                $('#account_type').val(selected);
                $('#account_type').trigger('change');
            }
        });
    }
}

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

$(document).on('change', '#account_type, #edit_account_type', function() {
    var el = $(this);
    var account_id = this.value;
    if(account_id!='')
    {
        $.ajax({
            url:"/accounting/chart-of-accounts/fetch-acc-detail",
            method: "POST",
            data: {account_id:account_id},
            success:function(data)
            {
                if(el.attr('id').includes('edit')) {
                    $("#edit_detail_type").html(data);
                    showOptions(document.getElementById('edit_detail_type'));
                    $('#edit_detail_type').trigger('change');
                }else {
                    $("#detail_type").html(data);
                    showOptions(document.getElementById('detail_type'));
                    $('#detail_type').trigger('change');
                }
            }
        })
    }
});

$(document).on('change', '#detail_type, #edit_detail_type', function() {
    var el = $(this);
    var id = el.val();

    $.ajax({
        url: "/accounting/chart-of-accounts/get-detail-type/"+id,
        success: function(data)
        {
            data = JSON.parse(data);
            
            el.parent().next().html(data.description);
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

$(document).on('click', '#editAccount', function(e){
    var target = e.currentTarget.dataset;
    $.ajax({
        url:"/accounting/chart-of-accounts/edit/" + target.id,
        method: "GET",
        success:function(html)
        {
            $('.append-edit-account').html(html);
            $('#modalEditAccount .date_picker input#edit_time_date').datepicker({
                uiLibrary: 'bootstrap',
                todayBtn: "linked",
                language: "de"
            });
            $('.form-validate').validate();

            //Initialize Select2 Elements

            $('#modalEditAccount .select2').select2({
                dropdownParent: $('#modalEditAccount')
            });

            var element = document.querySelector('#edit_check_sub');
            var switchery = new Switchery(element, {size: 'small'});
            $('#modalEditAccount').modal('show');
        }
    })
});

// $(document).on('click', '#chart-of-accounts-table .view-register', function(e) {
//     e.preventDefault();

    
// });

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