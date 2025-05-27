<div class="nsm-card primary">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><i class='bx bx-fw bx-map'></i>Other Address</span>
            <div class="float-end">
                <a class="nsm nsm-button" id="btn-add-address" href="javascript:void(0);"><i class='bx bx-plus'></i></a>
            </div>
        </div>
    </div>
    <div class="nsm-card-content">
        <hr>
        <?php $row = 1; ?>
        <table class="table table-borderless" id="tbl-other-address">
            <tbody>
                <?php foreach($customerAddress as $address){ ?>
                <tr>
                    <td style="width:5%;"><i class='bx bx-map-pin' ></i></td>
                    <td>
                        <input type="hidden" name="otherMailingAddress[]" value="<?= $address->mail_add; ?>" />
                        <input type="hidden" name="otherCity[]" value="<?= $address->city; ?>" />
                        <input type="hidden" name="otherState[]" value="<?= $address->state; ?>" />
                        <input type="hidden" name="otherZip[]" value="<?= $address->zip; ?>" />
                        <?= $address->mail_add . ' ' . $address->city . ', ' . $address->state . ' ' . $address->zip; ?>
                    </td>
                    <td style="width:5%;"><a class="nsm-button btn-small row-address-delete"><i class='bx bx-trash'></i></a></td>
                </tr>    
                <?php $row++; ?>            
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(function(){    
    $('#btn-add-address').on('click', function(){
        $('#modal-create-address').modal('show');
    });

    $('#frm-save-other-address').on('submit', function(e){
        e.preventDefault();

        let other_address_mail_add = $('#other-address-mail-add').val();
        let other_address_city     = $('#other-address-city').val();
        let other_address_state    = $('#other-address-state').val();
        let other_address_zip      = $('#other-address-zip').val();
        let rowAddress = other_address_mail_add + ' ' + other_address_city + ', ' + other_address_state + ' ' + other_address_zip;

        let tblOtherAddress = $('#tbl-other-address'); 
        let tblRowCount = $('#tbl-other-address tbody tr').length + 1;
        let tblRow = `
            <tr>
                <td style="width:5%;"><i class='bx bx-map-pin' ></i></td>
                <td>
                    <input type="hidden" name="otherMailingAddress[${tblRowCount}]" value="${other_address_mail_add}" />
                    <input type="hidden" name="otherCity[${tblRowCount}]" value="${other_address_city}" />
                    <input type="hidden" name="otherState[${tblRowCount}]" value="${other_address_state}" />
                    <input type="hidden" name="otherZip[${tblRowCount}]" value="${other_address_zip}" />
                    ${rowAddress}
                </td>
                <td style="width:5%;"><a class="nsm-button btn-small row-address-delete"><i class='bx bx-trash'></i></a></td>
            </tr>
        `;

        $(tblRow).appendTo(tblOtherAddress);

        $('#modal-create-address').modal('hide');
        $('#frm-save-other-address')[0].reset();
    });

    $(document).on('click', '.row-address-delete', function(){
        $(this).closest('tr').remove();
    });
});
</script>