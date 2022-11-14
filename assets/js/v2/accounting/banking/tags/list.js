$('.nsm-table tr[data-bs-toggle="collapse"]').on('click', function(e) {
    var target = e.currentTarget.dataset.target;

    $(target).collapse('toggle');

    if($(this).find('td:nth-child(2)').find('i').hasClass('bx-chevron-down')) {
        $(this).find('td:nth-child(2)').find('i').removeClass('bx-chevron-down').addClass('bx-chevron-up');
    } else {
        $(this).find('td:nth-child(2)').find('i').removeClass('bx-chevron-up').addClass('bx-chevron-down');
    }
});

// $("#search_field").on("input", debounce(function() {
//     let _form = $(this).closest("form");

//     _form.submit();
// }, 1500));

$('#create-tag-form').on('submit', function(e) {
    e.preventDefault();

    var data = new FormData(this);

    $.ajax({
        url: '/accounting/tags/add-tag',
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
                    confirmButtonColor: '#2ca01c',
                    confirmButtonText: 'Yes',
                    showCancelButton: true,
                    cancelButtonText: 'No',
                    cancelButtonColor: '#d33',
                    timer: 2000
                });
            }
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
        url: '/accounting/tags/add-group-tag',
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

    $('#tags-table tbody tr input.select-one:checked').each(function() {
        data.append('tags[]', $(this).val());
    });

    Swal.fire({
        title: 'Are you sure you want to delete the selected tags?',
        icon: 'warning',
        showCloseButton: false,
        confirmButtonColor: '#2ca01c',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        cancelButtonText: 'No',
        cancelButtonColor: '#d33'
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
});

$('#tags-table .delete-tag, #tags-table .delete-group').on('click', function(e) {
    e.preventDefault();

    var id = $(this).closest('tr').data('id');
    var type = $(this).closest('tr').data('type');

    Swal.fire({
        title: `Are you sure you want to delete the selected ${type.replace('group-', '')}?`,
        icon: 'warning',
        showCloseButton: false,
        confirmButtonColor: '#2ca01c',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        cancelButtonText: 'No',
        cancelButtonColor: '#d33'
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