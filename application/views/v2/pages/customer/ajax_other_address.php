<button type="button" id="btn-quick-add-other-address" class="nsm-button primary float-end"><i class='bx bx-plus'></i> Add New</button>
<div style="clear:both;"></div>
<div id="form-quick-add-address-container" style="display:none;">
    <form id="frm-quick-add-other-address">
        <input type="hidden" name="prof_id" id="prof-id" value="<?= $prof_id; ?>" />
        <div class="row">
            <div class="col-12">
                <input type="text" placeholder="Address" name="mail_add" id="other-address-mail-add" class="nsm-field form-control mb-2" required="">
            </div>                    
        </div>
        <div class="row">
            <div class="col-5">
                <input type="text" placeholder="City" name="city" id="other-address-city" class="nsm-field form-control mb-2" required="">
            </div>
            <div class="col-4">
                <input type="text" placeholder="State" name="state" id="other-address-state" class="nsm-field form-control mb-2" required="">
            </div>
            <div class="col-3">
                <input type="text" placeholder="Zip" name="zip" id="other-address-zip" class="nsm-field form-control mb-2" required="">
            </div>
            <div class="col-12 text-end">
                <button type="button" id="btn-cancel-quick-add-form" class="nsm-button">Cancel</button>
                <button type="submit" class="nsm-button primary" id="btn-save-other-address">Add</button>
            </div>
        </div>
    </form>
    <hr />
</div>
<table class="table table-borderless mt-4" id="tbl-quick-add-other-address">
    <tbody>
        <tr>
            <td style="width:3%;"><i id="customer-primary-address" class='bx bx-map'></i></td>
            <td><?= $primary_address['mail_add'] . ' ' . $primary_address['city'] . ', ' . $primary_address['state'] . ' ' . $primary_address['zip']; ?></td>
            <td style="width:5%;"><a class="nsm-button btn-small btn-use-other-address" data-id="<?= $primary_address['prof_id']; ?>" data-mailadd="<?= $primary_address['mail_add']; ?>" data-city="<?= $primary_address['city']; ?>" data-state="<?= $primary_address['state']; ?>" data-zip="<?= $primary_address['zip']; ?>" data-address="<?= $primary_address['mail_add'] . ' ' . $primary_address['city'] . ', ' . $primary_address['state'] . ' ' . $primary_address['zip']; ?>" href="javascript:void(0);"><i class='bx bx-plus'></i></a></td>
        </tr>
<?php if( $otherAddress ){ ?>
    <?php foreach($otherAddress as $address){ ?>
        <tr>
            <td style="width:3%;"></td>
            <td><?= $address->mail_add . ' ' . $address->city . ', ' . $address->state . ' ' . $address->zip; ?></td>
            <td style="width:5%;"><a class="nsm-button btn-small btn-use-other-address" data-id="<?= $address->customer_id; ?>" data-mailadd="<?= $address->mail_add; ?>" data-city="<?= $address->city; ?>" data-state="<?= $address->state; ?>" data-zip="<?= $address->zip; ?>" data-address="<?= $address->mail_add . ' ' . $address->city . ', ' . $address->state . ' ' . $address->zip; ?>" href="javascript:void(0);"><i class='bx bx-plus'></i></a></td>
        </tr>
    <?php } ?>
    </tbody>
<?php } ?>
</table>
<script>
$(function(){
    $('#customer-primary-address').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Primary Address';
        } 
    });
    $('#btn-archive').popover('hide');
});
</script>