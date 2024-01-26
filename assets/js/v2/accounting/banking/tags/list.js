$('.nsm-table td[data-bs-toggle="collapse"]').on('click', function(e) {
    var target = e.currentTarget.dataset.target;

    $(target).collapse('toggle');

    if($(this).find('i').hasClass('bx-chevron-down')) {
        $(this).find('i').removeClass('bx-chevron-down').addClass('bx-chevron-up');
    } else {
        $(this).find('i').removeClass('bx-chevron-up').addClass('bx-chevron-down');
    }
});

$("#search_field").on("input", debounce(function() {
    let _form = $(this).closest("form");

    _form.submit();
}, 1500));

$('#create-tag-form').on('submit', function(e) {
    e.preventDefault();

    var data = new FormData(this);

    $.ajax({
        url: base_url + 'accounting/tags/add-tag',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(res) {
            var result = JSON.parse(res);

            if(result.success) {
                location.reload();
            } else {
                Swal.fire({
                    html: result.message,
                    icon: 'error',
                    showCloseButton: false,
                    //confirmButtonColor: '#2ca01c',
                    confirmButtonText: 'Yes',
                    showCancelButton: true,
                    cancelButtonText: 'No',
                    //cancelButtonColor: '#d33',
                    timer: 2000
                });
            }
        }
    });
});


$(document).on('submit', '#tags-table .update_data-form', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var id = row.data().id;
    var type = row.data().type;

    var data = new FormData(this);

    $.ajax({
        url:`/accounting/tags/update/${id}/${type}`,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success:function (res) {
            if(row.data().type === 'group') {
                row.attr('data-bs-toggle', 'collapse');
        
                var index = row.index();
                row.attr('data-bs-target', `.collapse-${index}`);

                var childTags = $(`#tags-table tr.collapse-${index}`).length;
                var nameHtml = `<span><i class="bx bx-fw bx-chevron-down"></i> ${data.get('name')} (${childTags})</span>`;
            } else {
                if(row.data().type === 'group-tag') {

                }
                var nameHtml = data.get('name');
            }
            row.html(rowHtml);

            row.find('td:nth-child(2)').html(nameHtml);
        }
    });
});

$('#group').select2({
    ajax: {
        url: '/accounting/tags/get-group-tags',
        dataType: 'json'
    },
    dropdownParent: $('#tag-modal')
});

$(document).on('submit', '#tags-group-form', function(e) {
    e.preventDefault();

    var data = new FormData(this);

    $.ajax({
        url: base_url + 'accounting/tags/add-group-tag',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(res) {
            var result = JSON.parse(res);

            $('#tags-group-form').addClass('d-none');
            $('table#tags-group tbody').append(`<tr><td><span>${data.get('tags_group_name')}</span><a href="#" class="float-end text-decoration-none">Edit</a></td></tr>`);
            $('table#tags-group').removeClass('d-none');
            $('#tags-form').prepend(`<input type="hidden" name="group_id" value="${result.data}">`);
            $('#tags-group-form').prepend(`<input type="hidden" name="group_id" value="${result.data}">`);
            $('#tags-form #tag_name, #tags-form button[type="submit"]').removeAttr('disabled');
            $('#tags-group-form').attr('id', 'update-group-form');
        }
    });
});

$(document).on('click', 'table#tags-group tbody a', function() {
    if($('#update-group-form').length === 0) {
        $('#tags-group-form').attr('id', 'update-group-form');
    }

    $('#update-group-form').removeClass('d-none');

    $('table#tags-group').addClass('d-none');
});

$(document).on('submit', '#update-group-form', function(e) {
    e.preventDefault();

    var data = new FormData(this);

    $.ajax({
        url:`/accounting/tags/update/${data.get('group_id')}/group`,
        data: {name: data.get('tags_group_name')},
        type:"POST",
        dataType: "json",
        success:function (res) {
            if(res.success === true) {
                $('#update-group-form').addClass('d-none');

                if($('table#tags-group tbody tr').length > 0) {
                    $('table#tags-group tbody tr').remove();
                }
                $('table#tags-group tbody').append(`<tr><td><span>${data.get('tags_group_name')}</span><a href="#" class="float-end text-decoration-none">Edit</a></td></tr>`);

                $('table#tags-group').removeClass('d-none');
            } else {
                $('#tag_group_name').addClass('border-danger');
            }
        }
    });
});

$(document).on('submit', '#tags-form', function(e) {
    e.preventDefault();

    var data = new FormData(this);

    $.ajax({
        url: base_url + 'accounting/tags/add-tag',
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
                        <span>${data.get('tag_name')}</span><a href="#" class="float-end text-decoration-none">Edit</a>
                    </div>
                    <form class="d-none" id="form-tag-${result.data}">
                        <input type="hidden" name="tag_id" value="${result.data}">
                        <div class="row">
                            <div class="col-12 col-md-8">
                                <label for="tag_name">Tag name</label>
                                <input type="text" name="update_tag_name" value="${data.get('tag_name')}" class="form-control">
                            </div>
                            <div class="col-12 col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-success w-100">Save</button>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>`);

            $('#tags-form input#tag_name').val('');
            $('table#group-tags').removeClass('d-none');
        }
    });
});

$(document).on('click', 'table#group-tags tbody .tag-name-cont a', function() {
    $(this).parent().addClass('d-none');
    $(this).parent().next().removeClass('d-none');
});

$(document).on('submit', 'table#group-tags tbody form', function(e) {
    e.preventDefault();

    var form = $(this);
    var data = new FormData(this);

    $.ajax({
        url:`/accounting/tags/update/${data.get('tag_id')}/tag`,
        data: {name: data.get('update_tag_name')},
        type:"POST",
        dataType: "json",
        success:function (res) {
            form.addClass('d-none');

            form.prev().children('span').html(data.get('update_tag_name'));
            form.prev().removeClass('d-none');
        }
    });
});

$('#tags-table .select-all').on('change', function() {
    if($(this).prop('checked')) {
        $('#tags-table tbody input.select-one').prop('checked', true);
    } else {
        $('#tags-table tbody input.select-one').prop('checked', false);
    }
});

$('#tags-table .select-one').on('change', function() {
    var row = $(this).closest('tr');
    if($(this).val().includes('group_')) {
        var target = row.attr('data-bs-target').substr(1);

        $(`#tags-table tr.${target}`).find('.select-one').prop('checked', $(this).prop('checked'));
    }
    var checked = $('#tags-table tbody tr input.select-one:checked');
    var totalrows = $('#tags-table tbody tr input.select-one').length;

    $('#tags-table .select-all').prop('checked', checked.length === totalrows);
});

$('#delete-tags-button').on('click', function() {
    var data = new FormData();
    var total_checked = 0;
    $('#tags-table tbody tr input.select-one:checked').each(function() {
        data.append('tags[]', $(this).val());
        total_checked = total_checked + 1;
    });

    if( total_checked > 0 ){
        Swal.fire({
            title: 'Are you sure you want to delete the selected tags?',
            icon: 'question',
            showCloseButton: false,
            //confirmButtonColor: '#2ca01c',
            confirmButtonText: 'Yes',
            showCancelButton: true,
            cancelButtonText: 'No',
            //cancelButtonColor: '#d33'
        }).then((result) => {
            if(result.isConfirmed) {
                $.ajax({
                    url: '/accounting/tags/delete-tags',
                    data: data,
                    type: 'post',
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        location.reload();
                    }
                });
            }
        });
    }else{
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            html: 'Please select tags to delete.'
        });
    }
});

$('#tags-table .delete-tag, #tags-table .delete-group').on('click', function(e) {
    e.preventDefault();

    var id = $(this).closest('tr').data('id');
    var type = $(this).closest('tr').data('type');

    Swal.fire({
        title: `Are you sure you want to delete the selected ${type.replace('group-', '')}?`,
        icon: 'question',
        showCloseButton: false,
        //confirmButtonColor: '#2ca01c',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        cancelButtonText: 'No',
        //cancelButtonColor: '#d33'
    }).then((result) => {
        if(result.isConfirmed) {
            $.ajax({
                url:`/accounting/tags/delete/${id}/${type}`,
                type:"DELETE",
                success:function () {
                    location.reload();
                }
            });
        }
    });
});

$('#tags-table .add-tag').on('click', function(e) {
    var id = $(this).closest('tr').data('id');
    var name = $(this).closest('tr').find('td:nth-child(2)').text().trim().split(' ');
    name.pop();
    name = name.join(' ');

    $('#tag-modal select#group').append(`<option value="${id}" selected>${name}</option>`).trigger('change');

    $('#tag-modal').modal('show');
});

var rowHtml = '';
$('#tags-table .edit-group, #tags-table .edit-tag').on('click', function(e) {
    var id = $(this).closest('tr').data().id;
    var type = $(this).closest('tr').data().type;
    var name = $(this).closest('tr').find('td:nth-child(2)').text().trim().split(' ');

    if(type === 'group') {
        name.pop();
    }
    name = name.join(' ');

    rowHtml = $(this).closest('tr').html();

    $(this).closest('tr').removeAttr('data-bs-target').removeAttr('data-bs-toggle');
    $(this).closest('tr').html(`<td colspan="4">
        <a class="float-end cancel-edit" href="javascript:void(0)"><i class="bx bx-fw bx-x m-0"></i></a>
        <form class="edit-form">
            <div class="row">
                <div class="col-12 col-md-2">
                    <input type="text" name="name" value="${name}" class="form-control nsm-field">
                </div>
                <div class="col-12 col-md-auto">
                    <button class="nsm-button primary">Save</button>
                </div>
                <div class="col-12 col-md-auto">
                    <button class="nsm-button warning cancel-edit">Cancel</button>
                </div>
            </div>
        </form>
    </td>`);
});

$(document).on('click', '#tags-table .cancel-edit', function(e) {
    e.preventDefault();

    if($(this).closest('tr').data().type === 'group') {
        $(this).closest('tr').attr('data-bs-toggle', 'collapse');

        var index = $(this).closest('tr').index();
        $(this).closest('tr').attr('data-bs-target', `.collapse-${index}`);
    }
    $(this).closest('tr').html(rowHtml);
    // location.reload();
    // $(".nsm-page-content").load(window.location + ".nsm-page-content");
    // $(this).hide();
    // (".dropdown-menu .dropdown-menu-end").removeClass("show");
    // document.querySelectorAll(".dropdown-menu .dropdown-menu-end").forEach(function(element) {
    //     element.classList.remove("show");
    //  });
     
});

$(document).on('click', '#tags-table .cancel-edit2', function(e) {
    // e.preventDefault();

    // location.reload();
    // $("#tags-table").load(window.location + "#tags-table");
    $(this).hide();
    (".dropdown-menu .dropdown-menu-end").removeClass("show");
    // console.log($(".dropdown-menu .dropdown-menu-end"));
});

function refreshTable(){
    // $("#tags-table").load("<?php echo base_url('accounting/tags')?>", function(){
    //     setTimeout(refreshTable, 5000);
    // });
    // $("#tags-table").load(window.location + " #tags-table");
    $(".dropdown-menu-end").removeClass("show");
    
}

$(document).on('submit', '#tags-table .edit-form', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var id = row.data().id;
    var type = row.data().type;

    var data = new FormData(this);

    $.ajax({
        url:`/accounting/tags/update/${id}/${type}`,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success:function (res) {
            if(row.data().type === 'group') {
                row.attr('data-bs-toggle', 'collapse');
        
                var index = row.index();
                row.attr('data-bs-target', `.collapse-${index}`);

                var childTags = $(`#tags-table tr.collapse-${index}`).length;
                var nameHtml = `<span><i class="bx bx-fw bx-chevron-down"></i> ${data.get('name')} (${childTags})</span>`;
            } else {
                if(row.data().type === 'group-tag') {

                }
                var nameHtml = data.get('name');
            }
            row.html(rowHtml);

            row.find('td:nth-child(2)').html(nameHtml);
        }
    });
});

