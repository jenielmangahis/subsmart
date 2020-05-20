<form id="frm_serice_address" name="modal-form" style="display: block;" _lpchecked="1">
    <div class="validation-error" style="display: none;"></div>
    <input type="hidden" name="customer_id" value="<?php echo (!empty($customer)) ? $customer->id : '' ?>">
    <input type="hidden" name="action_type" value="<?php echo (!empty($action)) ? $action : '' ?>">
    <input type="hidden" name="data_index" value="<?php echo (isset($data_index)) ? $data_index : '' ?>">
    <input type="hidden" name="row-counter" value="">
    <div class="form-group">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <label>Address</label> <span class="help help-sm">(type in to search for address)</span>
                <input type="text" name="address" value="<?php echo (!empty($service_address)) ? $service_address['address'] : '' ?>" id="customer_address_modal_address" class="form-control" autocomplete="off" placeholder="e.g. 123 Old Oak Drive" requird>
                <input name="latlng" id="customer_address_modal_latlng" type="hidden" value="">
            </div>
            <div class="col-md-6 col-sm-12">
                <label>Suite/Unit</label> <span class="help help-sm">(or apartment, building, floor, PO Box)</span>
                <input type="text" name="address_secondary" value="<?php echo (!empty($service_address)) ? $service_address['address_secondary'] : '' ?>" class="form-control" autocomplete="off" requird>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-4 col-sm-7">
                <label>City </label>
                <input type="text" name="city" value="<?php echo (!empty($service_address)) ? $service_address['city'] : '' ?>" id="customer_address_modal_city" class="form-control" autocomplete="off" requird>
            </div>
            <div class="col-md-3 col-sm-5">
                <label>Zip/Postal Code</label>
                <input type="text" name="zip" value="<?php echo (!empty($service_address)) ? $service_address['zip'] : '' ?>" id="customer_address_modal_zip" class="form-control" autocomplete="off" requird>
            </div>
            <div class="col-md-5 col-sm-12">
                <label>State/Province</label>
                <select name="state" id="customer_address_modal_state" class="form-control">
                    <option value="" selected="selected">- select -</option>
                    <?php foreach ( get_config_item('states') as $key=>$state ) { ?>
                        <?php if ( (!empty($service_address)) && $service_address['state'] == $key ) { ?>
                            <option value="<?php echo $key ?>" selected="selected"><?php echo $state ?></option>
                        <?php } else { ?>
                            <option value="<?php echo $key ?>"><?php echo $state ?></option>
                        <?php } ?>                        
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <hr>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <label>Contact Name</label> <span class="help help-sm">(optional, e.g. tenant or occupant name)</span>
                <input type="text" name="name" value="<?php echo (!empty($service_address)) ? $service_address['name'] : '' ?>" id="customer_address_modal_name" class="form-control" autocomplete="off" requird>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo (!empty($service_address)) ? $service_address['email'] : '' ?>" id="customer_address_modal_email" class="form-control" autocomplete="off" requird>
            </div>
            <div class="col-md-6 col-sm-12">
                <label>Phone</label>
                <input type="text" name="phone" value="<?php echo (!empty($service_address)) ? $service_address['phone'] : '' ?>" id="customer_address_modal_phone" class="form-control" autocomplete="off" requird>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <label>Notes</label>
                <textarea name="notes" cols="40" rows="2" id="customer_address_modal_notes" class="form-control" autocomplete="off"><?php echo (!empty($service_address)) ? $service_address['notes'] : '' ?></textarea>
            </div>
        </div>
    </div>
</form>