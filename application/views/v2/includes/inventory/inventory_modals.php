<div class="modal fade nsm-modal fade" id="print_inventory_modal" tabindex="-1" aria-labelledby="print_inventory_modal_label" aria-hidden="true">
     <div class="modal-dialog modal-lg modal-dialog-centered">
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

<div class="modal fade nsm-modal fade" id="modal-archived-items" tabindex="-1" aria-labelledby="modal-archived-items-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
         
            <div class="modal-content">
                <form method="post" id="archived-items-list-form">  
                    <div class="modal-header">
                        <span class="modal-title content-title">Archived Inventory Items</span>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                    </div>
                    <div class="modal-body" id="inventory-items-archived-list-container" style="max-height: 800px; overflow: auto;"></div>
                </form>
            </div>
        
    </div>
</div>

<div class="modal fade nsm-modal fade" id="inventory-location-modal" tabindex="-1" aria-labelledby="inventory_location_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <?php echo form_open_multipart(null, ['id' => 'form-add-inventory-location', 'class' => 'form-validate form-add-inventory-location', 'autocomplete' => 'off']); ?>        

            <div class="modal-header">
                <span class="modal-title content-title" id="print_preview_inventory_modal_label">Add New Location</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12 mb-2">
                    <input type="text" class="form-control" maxlength="25" placeholder="Maximum 25 characters only" name="name" id="title" required>
                </div>
                <div class="col-lg-12 mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="DEFAULT_LOCATION">
                    <label class="form-check-label" for="DEFAULT_LOCATION">
                        Set to Default Location
                    </label>
                    <input type="hidden" name="DEFAULT_LOCATION" value="false" readonly>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="nsm-button primary">Save</button>
            </div>                 
            <?php echo form_close(); ?>

        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="inventory-edit-location-modal" tabindex="-1" aria-labelledby="inventory_edit_location_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <?php echo form_open_multipart(null, ['id' => 'form-edit-inventory-location', 'class' => 'form-validate form-edit-inventory-location', 'autocomplete' => 'off']); ?>        
            <input type="hidden" name="lid" value="" id="lid" />
            <input type="hidden" name="default_name" value="" id="default-name" />   
            <div class="modal-header">
                <span class="modal-title content-title" id="print_preview_inventory_modal_label">Update Location</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12 mb-2">
                    <input type="text" class="form-control" maxlength="25" placeholder="Maximum 25 characters only" name="name" id="location-name" required>
                </div>
                <div class="col-lg-12 mb-2">
                    <input class="form-check-input" type="checkbox" name="default_location" value="1" id="default-location">
                    <label class="form-check-label" for="default_location">
                        Set to Default Location
                    </label>
                    <!-- <input type="hidden" name="DEFAULT_LOCATION" value="false" readonly>-->
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="nsm-button primary">Update</button>
            </div>                 
            <?php echo form_close(); ?>

        </div>
    </div>
</div>