<div class="modal fade nsm-modal" id="print_payment_terms_modal" tabindex="-1" aria-labelledby="print_payment_terms_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_payment_terms_modal_label">Print Payment Terms List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Name">NAME</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($terms) > 0) : ?>
                        <?php foreach($terms as $method) : ?>
                        <tr>
                            <td class="fw-bold nsm-text-primary nsm-link default"><?=$method['name']?></td>
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
                <button type="button" class="nsm-button primary" id="btn_print_payment_terms">Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="print_preview_payment_terms_modal" tabindex="-1" aria-labelledby="print_preview_payment_terms_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_preview_payment_terms_modal_label">Print Payment Terms List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="w-100" id="payment_terms_table_print">
                    <thead>
                        <tr>
                            <td data-name="Name">NAME</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($terms) > 0) : ?>
                        <?php foreach($terms as $method) : ?>
                        <tr>
                            <td class="fw-bold nsm-text-primary nsm-link default"><?=$method['name']?></td>
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