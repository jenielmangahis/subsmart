//dropdown checkbox
var expanded = false;
function showCheckboxes() {
    var checkboxes = document.getElementById("checkboxes");
    if (!expanded) {
        checkboxes.style.display = "block";
        expanded = true;
    } else {
        checkboxes.style.display = "none";
        expanded = false;
    }
}

function reloadTagsTable() {
    $('#tags_table').DataTable().ajax.reload();
}

//DataTables JS
$('#group-tags-select2').select2({
    ajax: {
        url: '/accounting/tags/get-group-tags',
        dataType: 'json'
    }
});

$('#tags_table').DataTable({
    autoWidth: false,
    searching: false,
    processing: true,
    serverSide: true,
    lengthChange: false,
    pageLength: 50,
    ordering: false,
    info: false,
    paging: false,
    ajax: {
        url: 'tags/load-all-tags/',
        dataType: 'json',
        contentType: 'application/json', 
        type: 'POST',
        data: function(d) {
            d.columns[0].search.value = $('#search').val();
            return JSON.stringify(d);
        },
        pagingType: 'full_numbers',
    },
    columns: [
        {
            data: null,
            name: 'checkbox',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).html(`
                <div class="d-flex justify-content-center">
                    <div class="checkbox checkbox-sec m-0">
                        <input type="checkbox" value="${rowData.id}" id="${rowData.type}-${rowData.id}">
                        <label for="${rowData.type}-${rowData.id}" class="p-0" style="width: 24px; height: 24px"></label>
                    </div>
                </div>
                `);
            }
        },
        {
            data: 'name',
            name: 'name',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                if(rowData.type === 'group') {
                    $(td).html(`
                    <a class="mr-3 cursor-pointer" data-toggle="collapse" data-target="#child-${row}"><i class="fa fa-chevron-down"></i></a>
                    <span class="${rowData.type}-span-${rowData.id}">${rowData.name} (${rowData.tags.length})</span>
                    <div class="form-group-${rowData.id} hide">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="group_name" value="${rowData.name}" data-id="${rowData.id}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-success" id="submiteUpdateTag" data-type="group" data-id="${rowData.id}">Save</button>
                                <button type="button" class="close float-right text-dark" data-type="group" id="closeFormTag" data-id="${rowData.id}" style="transform: translate(0px, -15px);"><span aria-hidden="true">×</span></button>
                            </div>
                        </div>
                    </div>
                    `);
                } else {
                    $(td).html(`
                    <span class="${rowData.type}-span-${rowData.id}">${rowData.name}</span>
                    <div class="form-${rowData.type}-${rowData.id} hide">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="tags_name" value="${rowData.name}" data-id="${rowData.id}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-success" id="submiteUpdateTag" data-type="${rowData.type}" data-id="${rowData.id}">Save</button>
                                <button type="button" class="close float-right text-dark" data-type="${rowData.type}" id="closeFormTag" data-id="${rowData.id}" style="transform: translate(0px, -15px);"><span aria-hidden="true">×</span></button>
                            </div>
                        </div>
                    </div>
                    `);
                }
            }
        },
        {
            data: 'transactions',
            name: 'transactions',
        },
        {
            data: null,
            name: 'actions',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                if(rowData.type === 'group') {
                    $(td).html(`
                    <div class="dropdown">
                        <button type="button" class="btn btn-success" style="border-radius: 36px 0 0 36px;">Run report</button>
                        <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                            <span class="fa fa-caret-down"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right" data-id="${rowData.id}" data-name="${rowData.name}" data-type="group">
                            <li><a href="javascript:void(0);" id="addNewTag" class="dropdown-item" >Add tag</a></li>
                            <li><a href="javascript:void(0);" id="updateTagGroup" class="dropdown-item">Edit group</a></li>
                            <li><a href="javascript:void(0);" id="deleteGroup" class="dropdown-item">Delete group</a></li>
                        </ul>
                    </div>
                `);
                } else {
                    $(td).html(`
                    <div class="dropdown">
                        <button type="button" class="btn btn-success" style="border-radius: 36px 0 0 36px;">Run report</button>
                        <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                            <span class="fa fa-caret-down"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right" data-id="${rowData.id}" data-type="${rowData.type}">
                            <li><a href="javascript:void(0);" class="dropdown-item" id="updateTagGroup">Edit tag</a></li>
                            <li><a href="javascript:void(0);" class="dropdown-item" id="deleteTag" data-tag_id="${rowData.id}">Delete tag</a></li>
                        </ul>
                    </div>
                    `);
                }
            }
        }
    ],
    fnCreatedRow: function(nRow, aData, iDataIndex) {
        if(aData['type'] === 'group-tag') {
            $(nRow).attr('id', `child-${aData['parentIndex']}`);
            $(nRow).addClass('collapse bg-muted');
        }
    }
});

$(document).on('show.bs.modal', '#createTag', function() {
    $('input[name="tag_name"]').val('');
    $('select[name="group_id"]').html('<option></option>');
});

$(document).on('click', '#addNewTag', function(e) {
    var id = $(this).parent().parent().data('id');
    var name = $(this).parent().parent().data('name');

    $('#createTag').modal('show');

    $('select[name="group_id"]').append(`<option value="${id}" selected>${name}</option>`);
});

$(document).on('click', '#updateTagGroup', function(e) {
    var id = $(this).parent().parent().data('id');
    var type = $(this).parent().parent().data('type');
    var form = $(`.form-${type}-${id}`);
    var span = $(`.${type}-span-${id}`);

    form.removeClass('hide');
    span.addClass('hide');
    span.prev().addClass('hide');
});

$(document).on('change', '#e2', function(){
    var title = $(this).val();
    var color = 'white';
    if(title === 'yellow') {
        color = 'black';
    }
    $(this).css('color', color);
    $(this).css('background-color', title);
});

$(document).on('submit', '#tags_group_form', function(e) {
    e.preventDefault();

    var data = new FormData(document.getElementById('tags_group_form'));

    $.ajax({
        url: '/accounting/tags/add-group-tag',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(res) {
            var result = JSON.parse(res);

            $('#tags_group_form').addClass('hide');
            $('table#tags-group tbody').append(`<tr><td><span>${data.get('tags_group_name')}</span><a href="#" class="float-right text-info">Edit</a></td></tr>`);
            $('table#tags-group').removeClass('hide');
            $('#tags_form').prepend(`<input type="hidden" name="group_id" value="${result.data}">`);
            $('#tags_group_form').prepend(`<input type="hidden" name="group_id" value="${result.data}">`);

            reloadTagsTable();
        }
    });
});

$(document).on('click', 'table#tags-group tbody a', function() {
    if($('#update_group_form').length === 0) {
        $('#tags_group_form').attr('id', 'update_group_form');
    }

    $('#update_group_form').removeClass('hide');
    
    $('table#tags-group').addClass('hide');
});

$(document).on('submit', '#update_group_form', function(e) {
    e.preventDefault();

    var data = new FormData(document.getElementById('update_group_form'));

    $.ajax({
        url:`/accounting/tags/update/${data.get('group_id')}/group`,
        data: {name: data.get('tags_group_name')},
        type:"POST",
        dataType: "json",
        success:function (res) {
            if(res.success === true) {
                $('#update_group_form').addClass('hide');

                $('table#tags-group tbody tr').remove();
                $('table#tags-group tbody').append(`<tr><td><span>${data.get('tags_group_name')}</span><a href="#" class="float-right text-info">Edit</a></td></tr>`);

                $('table#tags-group').removeClass('hide');

                reloadTagsTable();
            } else {
                $('#tag_group_name').addClass('border-danger');
            }
        }
    });
});

$(document).on('submit', '#tags_form', function(e) {
    e.preventDefault();

    var data = new FormData(document.getElementById('tags_form'));

    $.ajax({
        url: '/accounting/tags/add-tag',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(res) {
            var result = JSON.parse(res);
            $('table#group-tags tbody').append(`
            <tr>
                <td>
                    <div class="tag-name-cont">
                        <span>${data.get('tag_name')}</span><a href="#" class="float-right text-info">Edit</a>
                    </div>
                    <form class="hide" id="form-tag-${result.data}">
                        <input type="hidden" name="tag_id" value="${result.data}">
                        <div class="form-row">
                            <div class="col-md-8">
                                <label for="tag_name">Tag name</label>
                                <input type="text" name="update_tag_name" value="${data.get('tag_name')}" class="form-control">
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-success w-100">Save</button>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>`);

            $('#tags_form input#tag_name').val('');
            $('table#group-tags').removeClass('hide');
            reloadTagsTable();
        }
    });
});

$(document).on('click', 'table#group-tags tbody .tag-name-cont a', function() {
    $(this).parent().addClass('hide');
    $(this).parent().next().removeClass('hide');
});

$(document).on('submit', 'table#group-tags tbody form', function(e) {
    e.preventDefault();

    var form = $(this);
    var data = new FormData(document.getElementById(form.attr('id')));

    $.ajax({
        url:`/accounting/tags/update/${data.get('tag_id')}/tag`,
        data: {name: data.get('update_tag_name')},
        type:"POST",
        dataType: "json",
        success:function (res) {
            form.addClass('hide');

            form.prev().children('span').html(data.get('update_tag_name'));
            form.prev().removeClass('hide');

            reloadTagsTable();
        }
    });
});

$(document).on('submit', '#create-tag-form', function(e) {
    e.preventDefault();

    var data = new FormData(document.getElementById('create-tag-form'));

    $.ajax({
        url: '/accounting/tags/add-tag',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(res) {
            var result = JSON.parse(res);
            $('#createTag').modal('hide');

            reloadTagsTable();

            $.toast({
                icon: result.success ? 'success' : 'error',
                heading: result.message,
                text: result.message,
                showHideTransition: 'fade',
                hideAfter: 3000,
                allowToastClose: true,
                position: 'top-right',
                stack: false,
                loader: false,
            });
        }
    });
});

$(document).on('click', '#deleteGroup, #deleteTag', function(e) {
    var id = $(this).parent().parent().data('id');
    var type = $(this).parent().parent().data('type');
    
    $.ajax({
        url:`/accounting/tags/delete/${id}/${type}`,
        type:"DELETE",
        success:function () {
            reloadTagsTable();
        }
    });
});

$(document).on('click', '#closeFormTag', function(e) {
    var target = e.currentTarget.dataset;
    var form = $(`.form-${target.type}-${target.id}`);
    var span = $(`.${target.type}-span-${target.id}`);

    form.addClass('hide');
    span.removeClass('hide');
    span.prev().removeClass('hide');
});

$(document).on('click', '#submiteUpdateTag', function(e) {
    var target = e.currentTarget.dataset;
    var form = $(`.form-${target.type}-${target.id}`);
    var span = $(`.${target.type}-span-${target.id}`);
    var input = $(this).parent().prev().find(`input`).val();

    $.ajax({
        url:`/accounting/tags/update/${target.id}/${target.type}`,
        type:"POST",
        data: {name: input},
        dataType: "json",
        success:function (res) {
            if (res.success) {
                span.text(input);

                form.addClass('hide');
                span.removeClass('hide');
                span.prev().removeClass('hide');
            }
        }
    });
});

$(document).on('keyup', '#search', function() {
    $('#tags_table').DataTable().ajax.reload(null, true);
});

$(document).on('change', '#tags_table thead input[type="checkbox"]', function() {
    $('#tags_table tbody input[type="checkbox"]').prop('checked', $(this).prop('checked'));
});

$(document).on('change', '#tags_table tbody input[type="checkbox"]', function() {
    var flag = true;
    $('#tags_table tbody tr input[type="checkbox"]').each(function() {
        if($(this).prop('checked') === false) {
            flag = false;
        }
    });

    $('#tags_table thead input[type="checkbox"]').prop('checked', flag);
});