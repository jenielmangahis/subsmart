<div class="modal fade nsm-modal fade" id="new_workorder_modal" tabindex="-1" aria-labelledby="new_workorder_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="new_workorder_modal_label">New Work Order</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row text-center gy-3">
                    <div class="col-12">
                        <label class="content-title">What type of work order you want to create</label>
                    </div>
                    <div class="col-12">
                        <label class="content-subtitle d-block mb-2">Create new work order</label>
                        <?php if (empty($company_work_order_used->work_order_template_id)) : ?>
                            <button type="button" class="nsm-button w-50 primary" onclick="location.href='<?php echo base_url('workorder/NewworkOrder') ?>'">New Work Order</button>
                        <?php elseif ($company_work_order_used->work_order_template_id == '0') : ?>
                            <button type="button" class="nsm-button w-50 primary" onclick="location.href='<?php echo base_url('workorder/NewworkOrder') ?>'">New Work Order</button>
                        <?php elseif ($company_work_order_used->work_order_template_id == '1') : ?>
                            <button type="button" class="nsm-button w-50 primary" onclick="location.href='<?php echo base_url('workorder/workorderInstallation') ?>'">New Work Order</button>
                        <?php elseif ($company_work_order_used->work_order_template_id == '2') : ?>
                            <button type="button" class="nsm-button w-50 primary" onclick="location.href='<?php echo base_url('workorder/addsolarworkorder') ?>'">New Work Order</button>
                        <?php else : ?>
                            <button type="button" class="nsm-button w-50 primary" onclick="location.href='<?php echo base_url('workorder/workorderInstallation') ?>'">New Work Order</button>
                        <?php endif; ?>
                    </div>
                    <?php $company_id = logged('company_id');
                    if ($company_id == '58') : ?>
                        <div class="col-12">
                            <label class="content-subtitle d-block mb-2">Create new System Agreement work order</label>
                            <button type="button" class="nsm-button w-50 primary" onclick="location.href='<?php echo base_url('workorder/workorderInstallation') ?>'">New Alternate Workorder</button>
                        </div>
                    <?php elseif ($company_id == '31') : ?>
                        <div class="col-12">
                            <label class="content-subtitle d-block mb-2">Create new Solar work order</label>
                            <button type="button" class="nsm-button w-50 primary" onclick="location.href='<?php echo base_url('workorder/addsolarworkorder') ?>'">Alternate Solar Form Here</button>
                        </div>
                    <?php endif; ?>
                    <div class="col-12">
                        <label class="content-subtitle d-block mb-2">Existing work order</label>
                        <button type="button" class="nsm-button w-50 primary" onclick="location.href='<?php echo base_url('workorder/NewworkOrder?type=2') ?>'">Existing</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="clone_workorder_modal" tabindex="-1" aria-labelledby="clone_workorder_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="clone_workorder_modal_label">Clone Work Order</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row text-center gy-3">
                    <div class="col-12">
                        <input type="hidden" id="wo_id" name="wo_id">
                        <label class="content-title d-block mb-2">You are going create a new work order based on</label>
                        <label class="content-title d-block mb-2">Work Order Number: <span class="work_order_no"></span></label>
                        <label class="content-subtitle d-block">Afterwards you can edit the newly created work order.</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="clone_workorder">Clone</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="update_field_modal" tabindex="-1" aria-labelledby="update_field_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <?php echo form_open_multipart('workorder/updatecustomField', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="update_field_modal_label">Update Field</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row text-center gy-3">
                    <div class="col-12">
                        <input type="hidden" class="nsm-field form-control" name="custom_id" id="custom_id"><br>
                        <input type="text" placeholder="Name" name="custom_name" id="custom_name_update" class="nsm-field form-control" required />
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="nsm-button primary">Update</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="new_customer_modal" tabindex="-1" aria-labelledby="new_customer_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="frm_new_customer">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">New Customer</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="new_customer_container">
                    <div class="nsm-loader w-100">
                        <i class='bx bx-loader-alt bx-spin'></i>
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

<div class="modal fade nsm-modal fade" id="update_header_modal" tabindex="-1" aria-labelledby="update_header_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="form_update_header">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Update Header</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <textarea name="update_header_content" rows="5" id="editor3" class="nsm-field form-control ckeditor"><?php echo $headers->content; ?></textarea>
                            <input type="hidden" id="company_id_header" value="<?php echo getLoggedCompanyID(); ?>">
                            <input type="hidden" id="update_h_id" value="<?php echo $headers->id; ?>">
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

<div class="modal fade nsm-modal fade" id="update_fields_modal" tabindex="-1" aria-labelledby="update_fields_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form_update_fields">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title"></span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <input type="text" class="nsm-field form-control" name="update_custom_name" id="update_custom_name">
                            <input type="hidden" class="form-control" name="update_custom_id" id="update_custom_id">
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

<div class="modal fade nsm-modal fade" id="add_item_list_modal" tabindex="-1" aria-labelledby="update_fields_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Add List Item</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table" id="select_item_list_table">
                    <thead>
                        <tr>
                            <td data-name="Name">Name</td>
                            <td data-name="Price">Price</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($items)) :
                        ?>
                            <?php foreach ($items as $item) : ?>
                                <tr>
                                    <td class="fw-bold nsm-text-primary"><?php echo $item->title ?></td>
                                    <td><?php echo $item->price; ?></td>
                                    <td class="text-end">
                                        <button type="button" class="nsm-button btn-sm add-item" data-bs-dismiss="modal" data-id="<?= $item->id; ?>" data-quantity="<?= $item->units; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>"><i class='bx bx-fw bx-plus' style="margin: 0 !important;"></i> Add</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="3">
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

<div class="modal fade nsm-modal fade" id="add_by_group_modal" tabindex="-1" aria-labelledby="add_by_group_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Add By Group</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table" id="add_by_group_table">
                    <thead>
                        <tr>
                            <td data-name="Name">Name</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($packages)) :
                        ?>
                            <?php foreach ($packages as $package) : ?>
                                <tr>
                                    <td class="fw-bold nsm-text-primary"><?php echo $package->name; ?></td>
                                    <td class="text-end">
                                        <button type="button" class="nsm-button btn-sm add-group" data-bs-dismiss="modal" data-id="<?= $package->item_categories_id; ?>"><i class='bx bx-fw bx-plus' style="margin: 0 !important;"></i> Add</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="2">
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


<div class="modal fade nsm-modal fade" id="package_modal" tabindex="-1" aria-labelledby="package_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Add/Create Package</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="package_content">
                <div class="row g-3">
                    <div class="col-12">
                        <ul class="nav nav-pills mb-3 nsm-nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-add-package-tab" data-bs-toggle="pill" data-bs-target="#pills-add-package" type="button" role="tab" aria-controls="pills-add-package" aria-selected="true">Add Package</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-create-package-tab" data-bs-toggle="pill" data-bs-target="#pills-create-package" type="button" role="tab" aria-controls="pills-create-package" aria-selected="true">Create Package</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-add-package" role="tabpanel" aria-labelledby="pills-add-package-tab">
                                <table class="nsm-table">
                                    <thead>
                                        <tr>
                                            <td data-name="Package Name">Package Name</td>
                                            <td data-name="Amount">Amount</td>
                                            <td data-name="Manage"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($itemPackages)) :
                                        ?>
                                            <?php foreach ($itemPackages as $pItems) : ?>
                                                <tr>
                                                    <td class="fw-bold nsm-text-primary"><?php echo  $pItems->name; ?></td>
                                                    <td><?php echo  $pItems->amount_set; ?></td>
                                                    <td>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <button type="button" class="nsm-button btn-sm add-packaege" data-bs-dismiss="modal" data-id="<?= $pItems->id; ?>" data-pack-id="<?= $pItems->id; ?>"><i class='bx bx-fw bx-plus' style="margin: 0 !important;"></i> Add</button>
                                                            <i class='bx bx-fw bx-chevron-down m-0 btn-show-items' role="button"></i>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="package-subitem d-none" id="package_subitem_<?= $pItems->id; ?>">
                                                    <td colspan="3">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <label class="content-subtitle fw-bold me-2">Title:</label>
                                                                <label class="content-subtitle">Title</label>
                                                            </div>
                                                            <div class="col-12">
                                                                <label class="content-subtitle fw-bold me-2">Quantity:</label>
                                                                <label class="content-subtitle">Quantity</label>
                                                            </div>
                                                            <div class="col-12">
                                                                <label class="content-subtitle fw-bold me-2">Price:</label>
                                                                <label class="content-subtitle">Price</label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php
                                        else :
                                        ?>
                                            <tr>
                                                <td colspan="3">
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
                            <div class="tab-pane fade" id="pills-create-package" role="tabpanel" aria-labelledby="pills-create-package-tab">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="content-subtitle fw-bold mb-2">Package Name</label>
                                        <input type="text" name="package_name" class="nsm-field form-control" id="package_name" required>
                                        <input type="hidden" name="count" value="0" id="count">
                                    </div>
                                    <div class="col-12">
                                        <table class="nsm-table">
                                            <thead>
                                                <tr>
                                                    <td data-name="Name">Name</td>
                                                    <td data-name="Group">Group</td>
                                                    <td data-name="Quantity">Quantity</td>
                                                    <td data-name="Price">Price</td>
                                                    <td data-name="Manage"></td>
                                                </tr>
                                            </thead>
                                            <tbody id="new_package_items">
                                                <tr class="empty-placeholder">
                                                    <td colspan="5">
                                                        <div class="nsm-empty">
                                                            <span>No items added yet.</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-12 text-end">
                                        <button type="button" class="nsm-button ms-0" data-bs-toggle="modal" data-bs-target="#select_package_item_modal"><i class="bx bx-fw bx-plus-circle"></i> Add Items</button>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold mb-2">Total Price</label>
                                        <input type="text" name="package_price" class="nsm-field form-control" id="package_price" required>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold mb-2">Set Package Price</label>
                                        <input type="text" name="package_price_set" class="nsm-field form-control" id="package_price_set" required>
                                    </div>
                                    <div class="col-12 mt-4 text-end">
                                        <button type="button" class="nsm-button primary" id="btn_create_package">Create/Add Package</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="select_package_item_modal" tabindex="-1" aria-labelledby="select_package_item_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Select Package Item</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table" id="select_package_item_table">
                    <thead>
                        <tr>
                            <td data-name="Name">Name</td>
                            <td data-name="Price">Price</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($items)) :
                        ?>
                            <?php foreach ($items as $item) : ?>
                                <tr>
                                    <td class="fw-bold nsm-text-primary"><?php echo $item->title ?></td>
                                    <td><?php echo $item->price; ?></td>
                                    <td class="text-end">
                                        <button type="button" class="nsm-button btn-sm select-package-item" data-bs-dismiss="modal" data-id="<?= $item->id; ?>" data-quantity="<?= $item->units; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>"><i class='bx bx-fw bx-plus' style="margin: 0 !important;"></i> Add</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="3">
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

<div class="modal fade nsm-modal fade" id="select_checklist_modal" tabindex="-1" aria-labelledby="select_checklist_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Select Checklist</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <?php foreach ($checklists as $key => $checklist) { ?>
                        <?php if (!empty($checklist['items'])) { ?>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input checklist-box" type="checkbox" id="checkist_checkbox_<?= $checklist['header']->id; ?>" value="<?php echo $checklist['header']->id; ?>" item-id="<?php echo $checklist['header']->id; ?>">
                                    <label class="form-check-label" for="checkist_checkbox_<?= $checklist['header']->id; ?>"> <?php echo $checklist['header']->checklist_name; ?> </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row g-3">
                                    <?php foreach ($checklist['items'] as $item) { ?>
                                        <div class="col-12 col-md-3">
                                            <label class="content-subtitle">Test</label>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="btn_add_checklist">Add Selected</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="update_termscon_modal" tabindex="-1" aria-labelledby="update_termscon_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="form_update_termscon">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Update Terms and Conditions</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <textarea name="editor1" rows="5" id="editor1" class="nsm-field form-control ckeditor"><?php echo $terms_conditions->content; ?></textarea>
                            <input type="hidden" id="company_id_modal" value="<?php echo getLoggedCompanyID(); ?>">
                            <input type="hidden" id="update_tc_id" value="<?php echo $terms_conditions->id; ?>">
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

<div class="modal fade nsm-modal fade" id="update_termsuse_modal" tabindex="-1" aria-labelledby="update_termsuse_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="form_update_termsuse">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Update Terms of Use</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <textarea name="update_tu" rows="5" id="editor2" class="nsm-field form-control ckeditor"><?php echo $terms_uses->content; ?></textarea>
                            <input type="hidden" id="company_id_modal" value="<?php echo getLoggedCompanyID(); ?>">
                            <input type="hidden" id="update_tu_id" value="<?php echo $terms_uses->id; ?>">
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

<div class="modal fade nsm-modal fade" id="add_cra_sign_modal" tabindex="-1" aria-labelledby="add_cra_sign_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Company Representative Approval</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class="bx bx-x"></i></button>
                            By Signing below you verify that the above information is true and complete, and you authorize payment and confirmation with nSmarTrac.
                        </div>
                    </div>
                    <div class="col-12">
                        <div id="cra_sign_area">
                            <canvas id="canvasb" class="nsm-sign-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" id="btn_clear_cra_signature">Clear</button>
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="btn_save_cra_signature">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="add_pah_sign_modal" tabindex="-1" aria-labelledby="add_pah_sign_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Primary Account Holder</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class="bx bx-x"></i></button>
                            By Signing below you verify that the above information is true and complete, and you authorize payment and confirmation with nSmarTrac.
                        </div>
                    </div>
                    <div class="col-12">
                        <div id="pah_sign_area">
                            <canvas id="canvas2b" class="nsm-sign-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" id="btn_clear_pah_signature">Clear</button>
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="btn_save_pah_signature">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="add_sah_sign_modal" tabindex="-1" aria-labelledby="add_sah_sign_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Secondary Account Holder</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class="bx bx-x"></i></button>
                            By Signing below you verify that the above information is true and complete, and you authorize payment and confirmation with nSmarTrac.
                        </div>
                    </div>
                    <div class="col-12">
                        <div id="sah_sign_area">
                            <canvas id="canvas3b" class="nsm-sign-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" id="btn_clear_sah_signature">Clear</button>
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="btn_save_sah_signature">Save</button>
            </div>
        </div>
    </div>
</div>