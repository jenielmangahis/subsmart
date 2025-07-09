<script>
$(function(){
    loadFormPreview();

    $('#popover-custom-form-fields').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Select the fields that will be part of the form and required ones.';
        } 
    });

    $('#popover-custom-form-appearance').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Change the color and size of the font.';
        } 
    });

    $('#popover-custom-form-notification').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Select how you want to be notified on a new inquiry.';
        } 
    });

    $('#popover-custom-form-google-analytics').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Optionally you can enable Google Analytics for this widget. Google analytics tracking is the unique id set on your Google tracking code. e.g. UA-12345-1.';
        } 
    });

    $('#popover-custom-form-snippet-code').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Copy paste code and have your form embed to your site.';
        } 
    });

    $('#btn-add-new-custom-field').on('click', function(){
        $('#modal-add-custom-field').modal('show');
    });

    $(document).on('click', '.row-btn-delete', function(){
        $(this).closest('tr').remove();
    });

    $('#custom-form-notification-email').on('change', function(){
        if( $(this).is(':checked') ){
            $('#notification-email-recipient').show();
        }else{
            $('#notification-email-recipient').hide();
        }
    });

    $('#frm-add-custom-field').on('submit', function(e){
        e.preventDefault();

        let field_name = $('#custom-field-name').val();

        let chk_required = '';
        if( $('#chk-is-required').is(':checked') ){
            chk_required = 'checked=""';
        }

        let chk_visible = '';
        if( $('#chk-is-visible').is(':checked') ){
            chk_visible = 'checked=""';
        }

        let row_count = $('#tbl-custom-fields tbody tr').length + 1;
        let row_html = `
            <tr>
                <td><i class='bx bx-grid-alt'></i></td>
                <td>
                    <input type="hidden" class="form-input" name="customFields[${row_count}][name]" value="${field_name}">
                    ${field_name}
                </td>
                <td style="text-align:center;">
                    <input class="form-check-input" name="customFields[${row_count}][is_required]" type="checkbox" ${chk_required}>
                </td>
                <td style="text-align:center;">
                    <input class="form-check-input" type="checkbox" name="customFields[${row_count}][is_visible]" ${chk_visible}>
                </td>
                <td style="text-align:center;">
                    <button class="nsm-button btn-small default row-btn-delete"><i class='bx bx-trash'></i></button>
                </td>
            </tr>
        `;
        
        const tableBody = $('#tbl-custom-fields tbody');
        tableBody.append(row_html);

        $('#modal-add-custom-field').modal('hide');
        $('#frm-add-custom-field')[0].reset();

    });

    $('#frm-save-lead-contact-form').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + "lead_contact_form/_update_settings",
            dataType: 'json',
            data: $('#frm-save-lead-contact-form').serialize(),
            success: function(data) {    
                $('#btn-update-lead-contact-form').html('Save Changes');                   
                if (data.is_success) {
                    Swal.fire({
                        title: 'Lead Contact Form',
                        text: "Setting was successfully updated",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                           loadFormPreview();
                        //}
                    });                    
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: data.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }
            },
            beforeSend: function() {
                $('#btn-update-lead-contact-form').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    function loadFormPreview()
    {
        $.ajax({
            type: "POST",
            url: base_url + "lead_contact_form/_form_preview",
            success: function(html) {    
                $('#lead-contact-form-preview').html(html);
            },
            beforeSend: function() {
                $('#lead-contact-form-preview').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    }
    
});
</script>