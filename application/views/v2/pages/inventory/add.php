<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/inventory/inventory_settings_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/inventory_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/inventory_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Locations are places, like warehouses, sites, or work vehicles, where inventory is stored. Product items represent products in your inventory stored at a particular location, such as bolts stored in a warehouse. Each product item is associated with a product and a location in nSmarTrac.
                        </div>
                    </div>
                </div>
                <?php echo form_open_multipart('inventory/save_new_item', ['class' => 'form-validate', 'id' => 'form_new_workorder', 'autocomplete' => 'off']); ?>
                <div class="row gy-3">
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span class="d-block">Item Details</span>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="col-12 col-md-3">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">Item Name</label>
                                                <input type="text" name="title" id="title" class="nsm-field form-control" required/>
                                            </div>
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">Item Type</label>
                                                <select name="type" id="type" class="nsm-field form-select" required>
                                                    <option value="Product">Product</option>
                                                    <option value="Service">Service</option>
                                                    <option value="QSP">QSP</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">Brand</label>
                                                <input type="text" name="brand" id="brand" class="nsm-field form-control"/>
                                            </div>
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">Item Group</label>
                                                <select name="item_categories_id" id="item_categories_id" class="nsm-field form-select">
                                                    <option value="">Select</option>
                                                    <?php foreach($item_categories as $cat) : ?>
                                                        <option value="<?= $cat->item_categories_id; ?>"><?= $cat->name; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">Cost Per</label>
                                                <select name="cost_per" id="cost_per" class="nsm-field form-select" required>
                                                    <option value="each" selected>Each</option>
                                                    <option>Weight</option>
                                                    <option>Length</option>
                                                    <option>Area</option>
                                                    <option>Volume</option>
                                                    <option>Other</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">Price</label>
                                                <input type="text" name="price" id="price" class="nsm-field form-control" required/>
                                            </div>
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">Retail Price</label>
                                                <input type="text" name="retail" id="retail" class="nsm-field form-control"/>
                                            </div>
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">Unit</label>
                                                <input type="text" name="units" id="units" class="nsm-field form-control"/>
                                            </div>
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">Cost of Goods</label>
                                                <input type="text" name="COGS" id="COGS" class="nsm-field form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">Vendor</label>
                                                <select name="vendor_id" id="vendor_id" class="nsm-field form-select" required>
                                                    <option value="0">Select</option>
                                                    <?php foreach($vendors as $vendor) : ?>
                                                        <option value="<?= $vendor->id; ?>"><?= $vendor->vendor_name; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">Model Number</label>
                                                <input type="text" name="model" id="model" class="nsm-field form-control"/>
                                            </div>
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">Serial Number</label>
                                                <input type="text" name="serial_number" id="serial_number" class="nsm-field form-control"/>
                                            </div>
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">Product URL</label>
                                                <input type="text" name="url" id="url" class="nsm-field form-control"/>
                                            </div>
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">Points</label>
                                                <input type="text" name="points" id="points" class="nsm-field form-control"/>
                                            </div>
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">Quantity Order</label>
                                                <input type="text" name="qty_order" id="qty_order" class="nsm-field form-control"/>
                                            </div>
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">Reorder Point</label>
                                                <input type="text" name="re_order_points" id="re_order_points" class="nsm-field form-control"/>
                                            </div>
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">Description</label>
                                                <textarea name="description" id="description" class="nsm-field form-control" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Attach Image</label>
                                                <div class="nsm-img-upload m-auto">
                                                    <span class="nsm-upload-label disable-select">Drop or click to upload file</span>
                                                    <input type="file" name="attached_image" class="nsm-upload">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if(count($custom_fields) > 0) : ?>
                    <div class="col-12">
                        <div class="nsm-card">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span class="d-block">Other Details</span>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <?php foreach($custom_fields as $field) : ?>
                                    <div class="col-12 col-md-6">
                                        <div class="row g-3">
                                            <div class="col-6">
                                                <label class="content-subtitle fw-bold d-block mb-2"><?=$field->name?></label>
                                            </div>
                                            <div class="col-6 text-end">
                                                <a href="javascript:void(0);" class="content-subtitle d-block mb-2 nsm-link btn-edit-field" data-id="<?=$field->id?>" data-name="<?=$field->name?>">Edit</a>
                                            </div>
                                        </div>
                                        <input type="text" name="custom_field[<?=$field->id?>]" class="nsm-field form-control"/>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="col-12 text-end">
                        <button type="button" class="nsm-button" onclick="location.href='<?php echo url('inventory') ?>'">Cancel</button>
                        <button type="submit" class="nsm-button primary">Submit</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", ".btn-edit-field", function() {
            let _this = $(this);
            let id = _this.attr("data-id");
            let name = _this.attr("data-name");
            let _modal = $("#custom-field-modal");

            _modal.find(".modal-title").html("Update " + name);
            _modal.find('form').attr('action', `${base_url}inventory/update-custom-field/${id}`);
            _modal.find('#custom-field-name').val(name);
            _modal.modal("show");
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>