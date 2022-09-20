<div class="modal fade nsm-modal" id="print_vendors_modal" tabindex="-1" aria-labelledby="print_vendors_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_vendors_modal_label">Print Vendors List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Vendor">VENDOR/COMPANY</td>
                            <td data-name="Address">ADDRESS</td>
                            <td data-name="Phone">PHONE</td>
                            <td data-name="Email">EMAIL</td>
                            <td class="table-icon text-center" data-name="Attachments">
                                <i class='bx bx-paperclip'></i>
                            </td>
                            <td data-name="Open Balance">OPEN BALANCE</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($vendors) > 0) : ?>
                        <?php foreach($vendors as $vendor) : ?>
                        <tr>
                            <td><?=$vendor->display_name?></td>
                            <td></td>
                            <td><?=$vendor->phone?></td>
                            <td><?=$vendor->email?></td>
                            <td></td>
                            <td>
                                <?php
                                    $balance = '$'.number_format(floatval($vendor->opening_balance), 2, '.', ',');
                                    echo str_replace('$-', '-$', $balance);
                                ?>
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
                <button type="button" class="nsm-button primary" id="btn_print_vendors">Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="print_preview_vendors_modal" tabindex="-1" aria-labelledby="print_preview_vendors_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_preview_vendors_modal_label">Print vendors List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="w-100" id="vendors_table_print">
                    <thead>
                        <tr>
                            <td data-name="Vendor">VENDOR/COMPANY</td>
                            <td data-name="Address">ADDRESS</td>
                            <td data-name="Phone">PHONE</td>
                            <td data-name="Email">EMAIL</td>
                            <td class="table-icon text-center" data-name="Attachments">
                                <i class='bx bx-paperclip'></i>
                            </td>
                            <td data-name="Open Balance">OPEN BALANCE</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($vendors) > 0) : ?>
                        <?php foreach($vendors as $vendor) : ?>
                        <tr>
                            <td><?=$vendor->display_name?></td>
                            <td></td>
                            <td><?=$vendor->phone?></td>
                            <td><?=$vendor->email?></td>
                            <td></td>
                            <td>
                                <?php
                                    $balance = '$'.number_format(floatval($vendor->opening_balance), 2, '.', ',');
                                    echo str_replace('$-', '-$', $balance);
                                ?>
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