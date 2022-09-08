<div class="modal fade nsm-modal" id="print_accounts_modal" tabindex="-1" aria-labelledby="print_accounts_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_accounts_modal_label">Print Accounts List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Name">Name</td>
                            <td data-name="Type">Type</td>
                            <td data-name="Detail Type">Detail Type</td>
                            <td data-name="Balance">Balance</td>
                            <td data-name="Bank Balance">Bank Balance</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($accounts)) :
                        ?>
                            <?php
                            foreach ($accounts as $account) :
                            ?>
                                <tr>
                                    <td class="nsm-text-primary">
                                        <label class="nsm-link default d-block fw-bold"><?=$account['name']?></label>
                                    </td>
                                    <td><?=$account['type']?></td>
                                    <td><?=$account['detail_type']?></td>
                                    <td><?=$account['nsmartrac_balance']?></td>
                                    <td><?=$account['bank_balance']?></td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="5">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="btn_print_accounts">Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="print_preview_accounts_modal" tabindex="-1" aria-labelledby="print_preview_accounts_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_preview_accounts_modal_label">Print Accounts List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="w-100" id="accounts_table_print">
                    <thead>
                        <tr>
                            <td data-name="Name">Name</td>
                            <td data-name="Type">Type</td>
                            <td data-name="Detail Type">Detail Type</td>
                            <td data-name="Balance">Balance</td>
                            <td data-name="Bank Balance">Bank Balance</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($accounts)) :
                        ?>
                            <?php
                            foreach ($accounts as $account) :
                            ?>
                                <tr>
                                    <td class="nsm-text-primary">
                                        <label class="nsm-link default d-block fw-bold"><?=$account['name']?></label>
                                    </td>
                                    <td><?=$account['type']?></td>
                                    <td><?=$account['detail_type']?></td>
                                    <td><?=$account['nsmartrac_balance']?></td>
                                    <td><?=$account['bank_balance']?></td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="5">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>