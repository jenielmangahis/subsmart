<div class="modal fade nsm-modal" id="contractor-modal" tabindex="-1" role="dialog" aria-labelledby="contractor-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <form action="<?php echo base_url() ?>accounting/contractors/add" method="post" class="form-validate" novalidate="novalidate">
                <div class="modal-header">
                    <span class="modal-title content-title" id="contractor-modal-label">Add Contractor</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row gy-3">
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2" for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control nsm-field" name="name" id="name" required>
                        </div>
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2" for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control nsm-field" name="email" id="email" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="btn_modal_close" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn_modal_save" class="nsm-button primary" form="add_employee_form">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="full-screen-modal">
    <div id="pay-contractors-modal" class="modal fade modal-fluid nsm-modal" role="dialog" data-bs-backdrop="false">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title" id="contractor-modal-label">Contractor Pay</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row" style="min-height: 100%">
                        <div class="col-12">
                            <div class="row grid-mb">
                                <div class="col-md-3 col-12 grid-mb">
                                    <label for="corresponding-account">Corresponding account in nSmarTrac</label>
                                    <select name="corresponding_account" id="corresponding-account" class="form-control nsm-field"></select>
                                </div>
                                <div class="col-md-2 col-12 grid-mb">
                                    <label for="pay-date">Pay date</label>
                                    <div class="nsm-field-group calendar">
                                        <input type="text" name="pay_date" id="pay-date" class="form-control nsm-field mb-2 date" value="<?=date("m/d/Y")?>" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-7 text-end grid-mb">
                                    <h6>
                                        TOTAL PAY
                                    </h6>
                                    <h2>
                                        <span class="transaction-total-amount">$0.00</span>
                                    </h2>
                                </div>
                                <div class="col-12">

                                    <table class="nsm-table" id="contractors-list-table">
                                        <thead>
                                            <tr>
                                                <td class="table-icon text-center"></td>
                                                <td class="table-icon text-center">
                                                    <input class="form-check-input select-all table-select" type="checkbox">
                                                </td>
                                                <td data-name="Contractor">CONTRACTOR</td>
                                                <td data-name="Pay Method">PAY METHOD</td>
                                                <td data-name="Transaction Info" width="50%">TRANSACTION INFO</td>
                                                <td data-name="Fixed Pay" class="text-end">FIXED PAY</td>
                                                <td data-name="Total Pay" class="text-end">TOTAL PAY</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($contractors as $contractor) : ?>
                                            <tr>
                                                <td>
                                                    <a href="#" data-bs-toggle="collapse" data-bs-target="#accordion-<?=$contractor->id?>"><i class="bx bx-fw bx-chevron-right"></i></a>
                                                </td>
                                                <td>
                                                    <div class="table-row-icon table-checkbox">
                                                        <input class="form-check-input select-one table-select" type="checkbox" value="<?=$contractor->id?>">
                                                    </div>
                                                </td>
                                                <td><?=$contractor->display_name?></td>
                                                <td>Paper check</td>
                                                <td></td>
                                                <td class="text-end">$0.00</td>
                                                <td class="text-end">$0.00</td>
                                            </tr>
                                            <tr class="clickable collapse-row collapse" id="accordion-<?=$contractor->id?>">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <label for="check-number-<?=$contractor->id?>">Check number</label>
                                                    <input type="text" class="nsm-field form-control" name="check_number[]" id="check-number-<?=$contractor->id?>">
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-12 col-md-4">
                                                            <label for="account-<?=$contractor->id?>">Account</label>
                                                            <select name="account[]" id="account-<?=$contractor->id?>" class="nsm-field form-control"></select>
                                                        </div>
                                                        <div class="col-12 col-md-4">
                                                            <label for="description-<?=$contractor->id?>">Description (optional)</label>
                                                            <input type="text" class="nsm-field form-control" name="description[]" id="description-<?=$contractor->id?>">
                                                        </div>
                                                        <div class="col-12 col-md-4">
                                                            <label for="customer-<?=$contractor->id?>">Customer</label>
                                                            <select name="customer[]" id="customer-<?=$contractor->id?>" class="nsm-field form-control"></select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <label for="amount">&nbsp;</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">$</span>
                                                        <input type="number" class="nsm-field form-control text-end" required placeholder="0.00" min="0" name="amount[]" id="amount-<?=$contractor->id?>">
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" data-bs-toggle="collapse" data-bs-target="#accordion-<?=$contractor->id?>"><i class="bx bx-fw bx-x"></i></a>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="6"><b>TOTAL</b></td>
                                                <td class="text-end">$0.00</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end modal-body -->
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-12 col-md-6">
                            <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-12 col-md-6 text-end">
                            <button type="button" class="nsm-button success" id="preview-contractor-payment">Preview</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="contractor-modal-update" tabindex="-1" role="dialog" aria-labelledby="contractor-modal-update-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <?php echo form_open_multipart(null, ['id' => 'form-update-contractor-field', 'class' => 'form-validate form-update-contractor-field', 'autocomplete' => 'off']); ?>
                <input type="hidden" id="contractor_id" name="contractor_id" value="" />
                <div class="modal-header">
                    <span class="modal-title content-title" id="contractor-modal-label">Update Contractor</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row gy-3">
                        <div class="col-12">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control nsm-field" name="name" id="name" required>
                        </div>
                        <div class="col-12">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control nsm-field" name="email" id="email" required>
                        </div>
                    </div>
                </div>
                <!-- end modal-body -->
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-12 col-md-6">
                            <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-12 col-md-6 text-end">
                            <button type="submit" name="save" class="nsm-button success">Update</button>
                        </div>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>