<form id="frm_additional_contact" name="modal-form" style="display: block;">
    <div class="validation-error" style="display: none;"></div>

    <?php if (!empty($customer)) { ?>
        <input type="hidden" name="customer_id" value="<?php echo (!empty($customer)) ? $customer->id : '' ?>">
    <?php } ?>

    <?php if (!empty($action)) { ?>
        <input type="hidden" name="action_type" value="<?php echo (!empty($action)) ? $action : '' ?>">
    <?php } ?>

    <?php if (isset($data_index)) { ?>
        <input type="hidden" name="data_index" value="<?php echo (isset($data_index)) ? $data_index : '' ?>">
    <?php } ?>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <label>Contact Name</label> <span data-business-customer="required" class="form-required">*</span>
                <input type="text" name="name" value="<?php echo (!empty($additional_contacts)) ? $additional_contacts['name'] : '' ?>" class="form-control" autocomplete="off">
            </div>
            <div class="col-md-6 col-sm-12">
                <label>Email</label>
                <input type="text" name="email" value="<?php echo (!empty($additional_contacts)) ? $additional_contacts['email'] : '' ?>" class="form-control" autocomplete="off">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <label>Mobile</label> <span class="help help-sm">(to send SMS/Text alerts)</span>
                <input type="text" name="phone" value="<?php echo (!empty($additional_contacts)) ? $additional_contacts['phone'] : '' ?>" class="form-control" autocomplete="off">
            </div>
            <div class="col-md-6 col-sm-12">
                <label>Phone</label> <span class="help help-sm">(other phone number, e.g. landline)</span>
                <input type="text" name="phone_secondary" value="<?php echo (!empty($additional_contacts)) ? $additional_contacts['phone_secondary'] : '' ?>" class="form-control" autocomplete="off">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <label>Notes</label>
                <textarea name="notes" cols="40" rows="2" class="form-control" autocomplete="off"><?php echo (!empty($additional_contacts)) ? $additional_contacts['notes'] : '' ?></textarea>
            </div>
        </div>
    </div>
</form>