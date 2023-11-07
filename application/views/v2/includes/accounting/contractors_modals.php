<div class="modal fade nsm-modal" id="contractor-modal" tabindex="-1" role="dialog" aria-labelledby="contractor-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="/accounting/contractors/add" method="post" class="form-validate" novalidate="novalidate">
                <div class="modal-header">
                    <span class="modal-title content-title" id="contractor-modal-label">Add a contractor</span>
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
                            <button type="submit" name="save" class="nsm-button success">Save</button>
                        </div>
                    </div>
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
                    <span class="modal-title content-title" id="contractor-modal-label">Contractor Pay: All Contractors</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row" style="min-height: 100%">
                        <div class="col-12">
                            <div class="row grid-mb">
                                <div class="col-md-2 col-12 grid-mb">
                                    <label for="corresponding-account">Corresponding account in nSmarTrac</label>
                                    <select name="corresponding_account" id="corresponding-account" class="form-control nsm-field"></select>
                                </div>
                                <div class="col-md-2 col-12 grid-mb">
                                    <label for="pay-date">Pay date</label>
                                    <div class="nsm-field-group calendar">
                                        <input type="text" name="pay_date" id="pay-date" class="form-control nsm-field mb-2 date" value="<?=date("m/d/Y")?>" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-8 text-end grid-mb">
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
                                                    <div class="row">
                                                        <div class="col-12 col-md-5 offset-md-7">
                                                            <label for="check-number-<?=$contractor->id?>">Check number</label>
                                                            <input type="text" class="nsm-field form-control" name="check_number[]" id="check-number-<?=$contractor->id?>">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-12 col-md-6">
                                                            <label for="account-<?=$contractor->id?>">Account</label>
                                                            <select name="account[]" id="account-<?=$contractor->id?>" class="nsm-field form-control"></select>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label for="description-<?=$contractor->id?>">Description (optional)</label>
                                                            <input type="text" class="nsm-field form-control" name="description[]" id="description-<?=$contractor->id?>">
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label for="customer-<?=$contractor->id?>">Customer</label>
                                                            <select name="customer[]" id="customer-<?=$contractor->id?>" class="nsm-field form-control"></select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-text">$</span>
                                                        <input type="text" class="nsm-field form-control text-end" placeholder="0.00" name="amount[]" id="amount-<?=$contractor->id?>">
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