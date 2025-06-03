<!-- Customer Other Address Modal -->
<div class="modal fade nsm-modal" id="other-address-customer" role="dialog" data-bs-backdrop="static" aria-labelledby="otherAddressLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header mb-0">
                <span id="newcustomerLabel" class="modal-title content-title">Other Address</span>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
            </div>
            <div class="modal-body" id="other-address-container"></div>
        </div>
    </div>
</div>
<script>
$(function(){
    $(document).on('click', '.btn-use-different-address', function(){
        let prof_id = $(this).attr('data-id');
        $('#other-address-customer').modal('show');
        $('.btn-use-different-address').popover('hide');

        $.ajax({
            type: "POST",
            url: base_url + "customer/_other_address",
            data:{prof_id:prof_id},
            success: function(html) {   
                $('#other-address-container').html(html);
            },
            beforeSend: function() {
                $('#other-address-container').html('<div class="col"><span class="bx bx-loader bx-spin"></span></div>');
            }
        });
    });

    $(document).on('click', '#btn-quick-add-other-address', function(){
        $('#btn-quick-add-other-address').hide();
        $('#form-quick-add-address-container').show();
    });

    $(document).on('click', '#btn-cancel-quick-add-form', function(){
        $('#btn-quick-add-other-address').show();
        $('#form-quick-add-address-container').hide();
    });

    $(document).on('submit', '#frm-quick-add-other-address', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + "customer/_quick_add_other_address",
            data:$('#frm-quick-add-other-address').serialize(),
            dataType:'json',
            success: function(response) {   
                $('#btn-save-other-address').html('Add');
                
                let prof_id = $('#prof-id').val();
                let other_address = $('#other-address-mail-add').val() + ' ' + $('#other-address-city').val() + ', ' + $('#other-address-state').val() + ' ' + $('#other-address-zip').val();
                let mail_add = $('#other-address-mail-add').val();
                let city = $('#other-address-mail-city').val();
                let state = $('#other-address-mail-state').val();
                let zip = $('#other-address-mail-zip').val();
                let row = `
                    <tr>
                        <td></td>                        
                        <td>${other_address}</td>
                        <td><a class="nsm-button btn-small btn-use-other-address" data-id="${prof_id}" data-mailadd="${mail_add}" data-city="${city}" data-state="${state}" data-zip="${zip}" data-address="${other_address}" href="javascript:void(0);"><i class='bx bx-plus'></i></a></td>
                    </tr>
                `;
                $('#tbl-quick-add-other-address tbody').append(row);

                $('#frm-quick-add-other-address')[0].reset();
                $('#btn-quick-add-other-address').show();
                $('#form-quick-add-address-container').hide();
            },
            beforeSend: function() {
                $('#btn-save-other-address').html('<div class="col"><span class="bx bx-loader bx-spin"></span></div>');
            }
        });
    });
});
</script>