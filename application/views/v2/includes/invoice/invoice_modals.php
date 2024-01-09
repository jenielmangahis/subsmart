<div class="modal fade nsm-modal fade" id="clone_invoice_modal" tabindex="-1" aria-labelledby="clone_invoice_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="clone_invoice_modal_label">Clone Invoice</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row text-center gy-3">
                    <div class="col-12">
                        <input type="hidden" id="wo_id" name="est_id">
                        <label class="content-title d-block mb-2">You are going create a new Invoice based on</label>
                        <label class="content-title d-block mb-2">Estimate Number: <span id='clone_invoice_id'></span></label>
                        <label class="content-subtitle d-block">The new invoice will contain the same items (e.g. materials, labour) and you will be able to edit and remove the invoice items as you need.</label>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="clone_invoice">Clone</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="new_tax_rate_modal" tabindex="-1" aria-labelledby="new_tax_rate_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <?php echo form_open_multipart(null, ['class' => 'form-validate', 'id' => 'frm-create-tax-rate', 'autocomplete' => 'off']); ?>
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="new_tax_rate_modal_label">New Tax Rate</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row gy-2">
                    <div class="col-12">
                        <input type="text" placeholder="Tax Name" name="tax_name" class="nsm-field form-control mb-2" required autocomplete="off" />
                    </div>
                    <div class="col-12">
                        <input type="number" placeholder="Rate (%)" name="tax_rate" class="nsm-field form-control mb-2" required autocomplete="off" min="0" />
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_default" id="is_default_checkbox">
                            <label class="form-check-label" for="is_default_checkbox">
                                Set Tax as Default
                            </label>
                        </div>
                        <label class="nsm-subtitle">If set as default this tax will be applied automatically when adding a new item on estimates or invoices.</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="nsm-button primary">Save</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="edit_tax_rate_modal" tabindex="-1" aria-labelledby="edit_tax_rate_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <?php echo form_open_multipart('settings/update_tax_rate', ['class' => 'form-validate', 'id' => 'frm-update-tax-rate', 'autocomplete' => 'off']); ?>
        <?php echo form_input(array('name' => 'tid', 'type' => 'hidden', 'value' => '', 'id' => 'tid')); ?>
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="edit_tax_rate_modal_label">Edit Tax Rate</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="edit_tax_rate_cont">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-loader">
                            <i class='bx bx-loader-alt bx-spin'></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="nsm-button primary">Save</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script>
$(function(){
    $('#frm-create-tax-rate').on('submit', function(e){
        let _this = $(this);
        e.preventDefault();

        var formData = new FormData(this);
        var url = "<?php echo base_url('settings/_add_tax_rate'); ?>";
        _this.find("button[type=submit]").html("Saving");
        _this.find("button[type=submit]").prop("disabled", true);

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            dataType: 'json',
            success: function(result) {
                if( result.is_success == 1 ){                    
                    $('#new_tax_rate_modal').modal('hide');
                    Swal.fire({
                        text: "Tax rate was created successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        location.reload();
                    });
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: result.msg
                    });
                }
                
                _this.trigger("reset");

                _this.find("button[type=submit]").html("Save");
                _this.find("button[type=submit]").prop("disabled", false);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    $('#frm-update-tax-rate').on('submit', function(e){
        let _this = $(this);
        e.preventDefault();

        var formData = new FormData(this);
        var url = "<?php echo base_url('settings/_update_tax_rate'); ?>";
        _this.find("button[type=submit]").html("Saving");
        _this.find("button[type=submit]").prop("disabled", true);

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            dataType: 'json',
            success: function(result) {
                if( result.is_success == 1 ){                    
                    $('#edit_tax_rate_modal').modal('hide');
                    Swal.fire({
                        text: "Tax rate was updated successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        location.reload();
                    });
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: result.msg
                    });
                }
                
                _this.trigger("reset");

                _this.find("button[type=submit]").html("Save");
                _this.find("button[type=submit]").prop("disabled", false);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
});
</script>