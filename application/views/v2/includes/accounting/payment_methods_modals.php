<div class="modal fade nsm-modal" id="print_payment_methods_modal" tabindex="-1" aria-labelledby="print_payment_methods_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_payment_methods_modal_label">Print Payment Methods List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Name">NAME</td>
                            <td data-name="Credit Card">CREDIT CARD</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($methods) > 0) : ?>
                        <?php foreach($methods as $method) : ?>
                        <tr>
                            <td class="fw-bold nsm-text-primary nsm-link default"><?=$method['name']?></td>
                            <td>
                                <?php if($method['credit_card'] === "1") : ?>
                                    <div class="table-row-icon table-checkbox">
                                        <input class="form-check-input select-one table-select" type="checkbox" disabled checked>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="8">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="btn_print_payment_methods">Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="print_preview_payment_methods_modal" tabindex="-1" aria-labelledby="print_preview_payment_methods_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_preview_payment_methods_modal_label">Print Payment Methods List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="w-100" id="payment_methods_table_print">
                    <thead>
                        <tr>
                            <td data-name="Name">NAME</td>
                            <td data-name="Credit Card">CREDIT CARD</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($methods) > 0) : ?>
                        <?php foreach($methods as $method) : ?>
                        <tr>
                            <td class="fw-bold nsm-text-primary nsm-link default"><?=$method['name']?></td>
                            <td>
                                <?php if($method['credit_card'] === "1") : ?>
                                    <div class="table-row-icon table-checkbox">
                                        <input class="form-check-input select-one table-select" type="checkbox" disabled checked>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="8">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>