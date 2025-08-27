<div class="modal fade nsm-modal fade" id="add_payscale_modal" tabindex="-1" aria-labelledby="add_payscale_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" id="add_payscale_form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Add Payscale</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row gy-3">
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Name</label>
                            <input type="text" class="nsm-field form-control" name="payscale_name" required>
                        </div>
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Pay Type</label>
                            <select name="pay_type" class="nsm-field form-select">
                                <?php foreach($optionPayType as $key => $value){ ?>
                                    <option value="<?= $key; ?>"><?= $value; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="edit_payscale_modal" tabindex="-1" aria-labelledby="edit_payscale_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" id="edit_payscale_form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Edit Payscale</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row gy-3">
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Name</label>
                            <input type="text" class="nsm-field form-control" name="payscale_name" required>
                            <input type="hidden" name="pid">
                        </div>
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Pay Type</label>
                            <select name="pay_type" class="nsm-field form-select pay-type">
                                <?php foreach($optionPayType as $key => $value){ ?>
                                    <option value="<?= $key; ?>"><?= $value; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>