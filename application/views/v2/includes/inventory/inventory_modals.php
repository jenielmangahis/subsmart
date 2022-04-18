<div class="modal fade nsm-modal fade" id="print_inventory_modal" tabindex="-1" aria-labelledby="print_inventory_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_inventory_modal_label">Print Inventory List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Item">Item</td>
                            <td data-name="Model">Model</td>
                            <td data-name="Brand">Brand</td>
                            <td data-name="Quantity-OH">Quantity-OH</td>
                            <td data-name="Quantity-Ordered">Quantity-Ordered</td>
                            <td data-name="Re-order Point">Re-order Point</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($items)) :
                        ?>
                            <?php
                            foreach ($items as $item) :
                            ?>
                                <tr>
                                    <td class="nsm-text-primary">
                                        <label class="nsm-link default d-block fw-bold"><?php echo $item[0]; ?></label>
                                        <label class="nsm-link default content-subtitle"><?php echo $item[1]; ?></label>
                                    </td>
                                    <td><?php echo $item[7]; ?></td>
                                    <td><?php echo $item[2]; ?></td>
                                    <td><?php echo getItemQtyOH($item[3]); ?></td>
                                    <td><?php echo $item[8]; ?></td>
                                    <td><?php echo $item[9]; ?></td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="6">
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
                <button type="button" class="nsm-button primary" id="btn_print_inventory">Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="print_preview_inventory_modal" tabindex="-1" aria-labelledby="print_preview_inventory_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_preview_inventory_modal_label">Print Inventory List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="w-100" id="inventory_table_print">
                    <thead>
                        <tr>
                            <td data-name="Item">Item</td>
                            <td data-name="Model">Model</td>
                            <td data-name="Brand">Brand</td>
                            <td data-name="Quantity-OH">Quantity-OH</td>
                            <td data-name="Quantity-Ordered">Quantity-Ordered</td>
                            <td data-name="Re-order Point">Re-order Point</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($items)) :
                        ?>
                            <?php
                            foreach ($items as $item) :
                            ?>
                                <tr>
                                    <td class="nsm-text-primary">
                                        <label class="nsm-link default d-block fw-bold"><?php echo $item[0]; ?></label>
                                        <label class="nsm-link default content-subtitle"><?php echo $item[1]; ?></label>
                                    </td>
                                    <td><?php echo $item[7]; ?></td>
                                    <td><?php echo $item[2]; ?></td>
                                    <td><?php echo getItemQtyOH($item[3]); ?></td>
                                    <td><?php echo $item[8]; ?></td>
                                    <td><?php echo $item[9]; ?></td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="6">
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

<div class="modal fade nsm-modal fade" id="inventory_location_modal" tabindex="-1" aria-labelledby="inventory_location_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="inventory_location_modal_label">Locations</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Location">Location</td>
                            <td data-name="Quantity">Quantity</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>