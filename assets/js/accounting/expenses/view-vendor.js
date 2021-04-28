$('.banking-tab-container a').on('click', function() {
    var activeTab = $(this).parent().find('.banking-tab-active');
    activeTab.removeClass('text-decoration-none');
    activeTab.removeClass('banking-tab-active');
    activeTab.removeClass('active');
    activeTab.addClass('banking-tab');
    $(this).removeClass('banking-tab');
    $(this).addClass('banking-tab-active');
    $(this).addClass('text-decoration-none');
});

$(document).on('change', '#edit-vendor-modal #use_display_name', function() {
    if($(this).prop('checked')) {
        $('#edit-vendor-modal #print_on_check_name').prop('disabled', true);
    } else {
        $('#edit-vendor-modal #print_on_check_name').prop('disabled', false);
    }
});

var attachmentId = [];
var selected = [];
var attachments = new Dropzone('#vendorAttachments', {
    url: '/accounting/vendors/attachments',
    acceptedFiles: "image/*",
    maxFilesize: 20,
    uploadMultiple: true,
    // maxFiles: 1,
    addRemoveLinks: true,
    init: function() {
        this.on("success", function(file, response) {
            var ids = JSON.parse(response)['attachment_ids'];
            for(i in ids) {
                if($('#edit-vendor-modal').find(`input[name="attachments[]"][value="${ids[i]}"]`).length === 0) {
                    $('#edit-vendor-modal #vendorAttachments').parent().append(`<input type="hidden" name="attachments[]" value="${ids[i]}">`);
                }
            }
            // attachmentId.push(file_name.replace(/\"/g, ""));
            // selected.push(file);
        });
    },
    // removedfile: function(file) {
    //     var name = fname;
    //     var index = selected.map(function(d, index) {
    //         if (d == file) return index;
    //     }).filter(isFinite)[0];
    //     $.ajax({
    //         type: "POST",
    //         url: base_url + 'users/removeProfilePhoto',
    //         dataType: 'json',
    //         data: {
    //             name: name,
    //             index: index
    //         },
    //         success: function(data) {
    //             if (data == 1) {
    //                 $('#photoId').val(null);
    //             }
    //         }
    //     });
    //     //remove thumbnail
    //     var previewElement;
    //     return (previewElement = file.previewElement) != null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
    // }
});

$('.datepicker').datepicker({
    uiLibrary: 'bootstrap',
    todayBtn: "linked",
    language: "de"
});

$('.notes-container').on('click', function() {
    $('#edit-vendor-modal').modal('show');
});

$('select').select2();

$('#transactions-table').DataTable({
    autoWidth: false,
    searching: false,
    processing: true,
    serverSide: false,
    lengthChange: false,
    info: false,
    pageLength: $('#table_rows').val(),
    order: [[0, 'asc']],
});