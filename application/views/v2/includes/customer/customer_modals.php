<div class="modal fade nsm-modal fade" id="payment_history_modal" tabindex="-1" aria-labelledby="payment_history_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="payment_history_modal_label">Payment History</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="payment_history_container"></div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="edit_cc_modal" tabindex="-1" aria-labelledby="edit_cc_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="update_cc_form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title" id="edit_cc_label">Update Credit Card Details</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="bid" id="bid" value="">
                    <div class="row">
                        <div class="col-12" id="card_details"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="new_sales_area_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="new_sales_area_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">        
        <div class="modal-content">
            <form method="POST" id="new_sales_area_form">
                <div class="modal-header">
                    <span class="modal-title content-title">Add Sales Area</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="sa_id" id="sa_id" />
                    <div class="row">
                        <div class="col-12">
                            <input type="text" placeholder="Sales Area Name" name="sa_name" id="sa_name" class="nsm-field form-control mb-2" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </form>
        </div>        
    </div>
</div>

<div class="modal fade nsm-modal fade" id="new_customer_status_modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="new_customer_status_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">        
        <div class="modal-content">
            <form method="POST" id="new_customer_status_form">
                <div class="modal-header">
                    <span class="modal-title content-title">Add Customer Status</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">                    
                    <div class="row">
                        <div class="col-12">
                            <input type="text" placeholder="Status Name" name="status_name" id="cs_name" class="nsm-field form-control mb-2" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="edit_customer_status_modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="edit_customer_status_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">        
        <div class="modal-content">
            <form method="POST" id="edit_customer_status_form">
                <input type="hidden" class="form-control" name="cs_id" id="edit_cs_id" />
                <div class="modal-header">
                    <span class="modal-title content-title">Edit Customer Status</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">                    
                    <div class="row">
                        <div class="col-12">
                            <input type="text" placeholder="Status Name" name="name" id="edit_cs_name" class="nsm-field form-control mb-2" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </form>
        </div>        
    </div>
</div>

<div class="modal fade nsm-modal fade" id="edit_sales_area_modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="edit_sales_area_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" id="edit_sales_area_form">
                <input type="hidden" class="form-control" name="sa_id" id="edit_sa_id" value="" />
                <div class="modal-header">
                    <span class="modal-title content-title">Edit Sales Area</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">                    
                    <div class="row">
                        <div class="col-12">
                            <input type="text" placeholder="Sales Area Name" name="sa_name" id="edit_sa_name" class="nsm-field form-control mb-2" value="" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </form>
        </div>        
    </div>
</div>

<div class="modal fade nsm-modal fade" id="new_lead_source_modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="new_lead_source_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">        
        <div class="modal-content">
            <form method="POST" id="new_lead_source_form">
                <div class="modal-header">
                    <span class="modal-title content-title">Add Lead Source</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="ls_id" id="ls_id" />
                    <div class="row">
                        <div class="col-12">
                            <input type="text" placeholder="Lead Source Name" name="ls_name" id="ls_name" class="nsm-field form-control mb-2" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="edit_lead_source_modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="edit_lead_source_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" id="edit_lead_source_form">
                <div class="modal-header">
                    <span class="modal-title content-title">Edit Lead Source</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="ls_id" id="edit_ls_id" />
                    <div class="row">
                        <div class="col-12">
                            <input type="text" placeholder="Lead Source Name" name="ls_name" id="edit_ls_name" class="nsm-field form-control mb-2" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="new_lead_types_modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="new_lead_types_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">        
        <div class="modal-content">
            <form method="POST" id="new_lead_types_form">
                <div class="modal-header">
                    <span class="modal-title content-title">Add Lead Type</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="lead_id" id="lead_id" />
                    <div class="row">
                        <div class="col-12">
                            <input type="text" placeholder="Lead Type Name" name="lead_name" id="lead_name" class="nsm-field form-control mb-2" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </form>
        </div>        
    </div>
</div>

<div class="modal fade nsm-modal fade" id="edit_lead_type_modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="edit_lead_type_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">        
        <div class="modal-content">
            <form method="POST" id="edit_lead_type_form">                    
                <div class="modal-header">
                    <span class="modal-title content-title">Edit Lead Type</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="lead_id" id="edit_lead_id" />
                    <div class="row">
                        <div class="col-12">
                            <input type="text" placeholder="Lead Type Name" name="lead_name" id="edit_lead_name" class="nsm-field form-control mb-2" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="new_rate_plan_modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="new_rate_plan_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">        
        <div class="modal-content">
            <form method="POST" id="new_rate_plan_form">
                <div class="modal-header">
                    <span class="modal-title content-title">Add Rate Plan</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="id" id="rate_id" />
                    <div class="row">
                        <div class="col-12">
                            <input type="text" placeholder="Plan Name" name="plan_name" id="plan_name" class="nsm-field form-control mb-2" required />
                        </div>
                        <div class="col-6">
                            <input type="number" value="0" step="any" placeholder="Rate Amount" name="plan_amount" id="amount" class="nsm-field form-control mb-2" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </form>
        </div>        
    </div>
</div>

<div class="modal fade nsm-modal fade" id="edit_rate_plan_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="edit_rate_plan_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">        
        <div class="modal-content">
            <form method="POST" id="edit_rate_plan_form">
                <div class="modal-header">
                    <span class="modal-title content-title">Edit Rate Plan</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="rate_plan_id" id="rate_plan_id" />
                    <input type="hidden" class="form-control" name="id" id="edit_rate_id" />
                    <div class="row">
                        <div class="col-12">
                            <input type="text" placeholder="Plan Name" name="plan_name" id="edit_plan_name" class="nsm-field form-control mb-2" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <input type="number" placeholder="Rate Amount" name="plan_amount" id="edit_amount" class="nsm-field form-control mb-2" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="new_activation_fee_modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="new_activation_fee_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">        
        <div class="modal-content">
            <form method="POST" id="new_activation_fee_form">
            <div class="modal-header">
                <span class="modal-title content-title">Add Activation Fee</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" name="id" id="fee_id" />
                <div class="row">
                    <div class="col-12">
                        <input type="number" placeholder="Amount" name="amount" id="amount" step=".01" class="nsm-field form-control mb-2" required />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary">Save</button>
            </div>
            </form>
        </div>        
    </div>
</div>

<div class="modal fade nsm-modal fade" id="edit_activation_fee_modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="edit_activation_fee_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">        
        <div class="modal-content">
            <form method="POST" id="edit_activation_fee_form">
                <div class="modal-header">
                    <span class="modal-title content-title">Edit Activation Fee</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="id" id="edit_fee_id" />
                    <div class="row">
                        <div class="col-12">
                            <input type="number" placeholder="Amount" name="amount" id="edit_fee_amount" step=".01" class="nsm-field form-control mb-2" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="new_system_package_modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="new_system_package_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" id="new_system_package_form">
                <div class="modal-header">
                    <span class="modal-title content-title">Add System Package Type</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <input type="text" placeholder="Name" name="package_name" id="system_name" class="nsm-field form-control mb-2" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="edit_system_package_modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="edit_system_package_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">        
        <div class="modal-content">
            <form method="POST" id="edit_system_package_form">
                <input type="hidden" class="form-control" name="id" id="edit_system_id" />
                <div class="modal-header">
                    <span class="modal-title content-title">Edit System Package Type</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">                    
                    <div class="row">
                        <div class="col-12">
                            <input type="text" placeholder="Name" name="package_name" id="edit_system_name" class="nsm-field form-control mb-2" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_add_financing_category" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Create Financing Payment Category</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>
            <div class="modal-body">
                <form id="frm-add-financing-category">
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="mb-2">Name</label>
                            <div class="input-group mb-3">
                                <input type="text" name="category_name" value="" class="form-control" required="" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="mb-2">Value</label>
                            <div class="input-group mb-3">
                                <input type="text" name="category_value" value="" class="form-control" required="" autocomplete="off" />
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">                        
                        <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="nsm-button primary" id="btn-save-financing-category">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_edit_financing_category" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Edit Financing Payment Category</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>
            <div class="modal-body">
                <form id="frm-edit-financing-category">
                    <input type="hidden" name="catid" id="cat-id" value="" />
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="mb-2">Name</label>
                            <div class="input-group mb-3">
                                <input type="text" name="category_name" id="edit-category-name" value="" class="form-control" required="" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="mb-2">Value</label>
                            <div class="input-group mb-3">
                                <input type="text" name="category_value" id="edit-category-value" value="" class="form-control" required="" autocomplete="off" />
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">                        
                        <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="nsm-button primary" id="btn-update-financing-category">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="print_view_customer_list_modal" tabindex="-1" aria-labelledby="print_view_customer_list_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Print Customer List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="w-100" id="customer_table_print">
                    <?php if (!empty($enabled_table_headers)) : ?>
                        <thead>
                            <tr>
                                <?php if (in_array('name', $enabled_table_headers)) : ?><td data-name="Name">Name</td><?php endif; ?>
                                <?php if (in_array('city', $enabled_table_headers)) : ?><td data-name="City">City</td><?php endif; ?>
                                <?php if (in_array('state', $enabled_table_headers)) : ?><td data-name="State">State</td><?php endif; ?>
                                <?php if (in_array('source', $enabled_table_headers)) : ?><td data-name="Source">Source</td><?php endif; ?>
                                <?php if (in_array('added', $enabled_table_headers)) : ?><td data-name="Added">Added</td><?php endif; ?>
                                <?php if (in_array('sales_rep', $enabled_table_headers)) : ?><td data-name="Sales Rep">Sales Rep</td><?php endif; ?>
                                <?php if (in_array('tech', $enabled_table_headers)) : ?><td data-name="Tech">Tech</td><?php endif; ?>
                                <?php if (in_array('plan_type', $enabled_table_headers)) : ?><td data-name="Plan Type">Plan Type</td><?php endif; ?>
                                <?php if (in_array('subscription_amount', $enabled_table_headers)) : ?><td data-name="Subscription Amount">Subscription Amount</td><?php endif; ?>
                                <?php if (in_array('phone', $enabled_table_headers)) : ?><td data-name="Phone">Phone</td><?php endif; ?>
                                <?php if (in_array('status', $enabled_table_headers)) : ?><td data-name="Status">Status</td><?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($profiles)) :
                            ?>
                                <?php
                                foreach ($profiles as $customer) :
                                    switch ($customer->status):
                                        case "INSTALLED":
                                            $badge = "success";
                                            break;
                                        case "CANCELLED":
                                            $badge = "error";
                                            break;
                                        case "COLLECTIONS":
                                            $badge = "secondary";
                                            break;
                                        case "CHARGED BACK":
                                            $badge = "primary";
                                            break;
                                        default:
                                            $badge = "";
                                            break;
                                    endswitch;

                                    $image = userProfilePicture($customer->id);
                                ?>
                                    <?php if (in_array('name', $enabled_table_headers)) : ?>
                                        <td class="nsm-text-primary">
                                            <label class="nsm-link default d-block fw-bold"><?= ($customer) ? $customer->first_name . ' ' . $customer->last_name : ''; ?></label>
                                            <label class="content-subtitle fst-italic d-block"><?php echo $customer->email; ?></label>
                                        </td>
                                    <?php endif; ?>
                                    <?php if (in_array('city', $enabled_table_headers)) : ?>
                                        <td><?php echo $customer->city; ?></td>
                                    <?php endif; ?>
                                    <?php if (in_array('state', $enabled_table_headers)) : ?>
                                        <td><?php echo $customer->state; ?></td>
                                    <?php endif; ?>
                                    <?php if (in_array('source', $enabled_table_headers)) : ?>
                                        <td><?= $customer->lead_source != "" ? $customer->lead_source : 'n/a'; ?></td>
                                    <?php endif; ?>
                                    <?php if (in_array('added', $enabled_table_headers)) : ?>
                                        <td><?php echo $customer->entered_by; ?></td>
                                    <?php endif; ?>
                                    <?php if (in_array('sales_rep', $enabled_table_headers)) : ?>
                                        <td><?php echo ($customer) ? $customer->FName . ' ' . $customer->LName : ''; ?></td>
                                    <?php endif; ?>
                                    <?php if (in_array('tech', $enabled_table_headers)) : ?>
                                        <td><?= $customer->technician != null ? $customer->technician : 'Not Assigned'; ?></td>
                                    <?php endif; ?>
                                    <?php if (in_array('plan_type', $enabled_table_headers)) : ?>
                                        <td><?php echo $customer->system_type; ?></td>
                                    <?php endif; ?>
                                    <?php if (in_array('subscription_amount', $enabled_table_headers)) : ?>
                                        <td>$<?= $customer->total_amount; ?></td>
                                    <?php endif; ?>
                                    <?php if (in_array('phone', $enabled_table_headers)) : ?>
                                        <td><?php echo $customer->phone_m; ?></td>
                                    <?php endif; ?>
                                    <?php if (in_array('status', $enabled_table_headers)) : ?>
                                        <td><span class="nsm-badge <?= $badge ?>"><?= $customer->status != null ? $customer->status : 'Pending'; ?></span></td>
                                    <?php endif; ?>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
                            <?php
                            else :
                            ?>
                                <tr>
                                    <td colspan="12">
                                        <div class="nsm-empty">
                                            <span>No results found.</span>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endif;
                            ?>
                        </tbody>
                    <?php else : ?>
                        <thead>
                            <tr>
                                <td data-name="Name">Name</td>
                                <td data-name="City">City</td>
                                <td data-name="State">State</td>
                                <td data-name="Source">Source</td>
                                <td data-name="Added">Added</td>
                                <td data-name="Sales Rep">Sales Rep</td>
                                <td data-name="Tech">Tech</td>
                                <td data-name="Plan Type">Plan Type</td>
                                <td data-name="Subscription Amount">Subscription Amount</td>
                                <td data-name="Phone">Phone</td>
                                <td data-name="Status">Status</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($profiles)) :
                            ?>
                                <?php
                                foreach ($profiles as $customer) :
                                    switch ($customer->status):
                                        case "INSTALLED":
                                            $badge = "success";
                                            break;
                                        case "CANCELLED":
                                            $badge = "error";
                                            break;
                                        case "COLLECTIONS":
                                            $badge = "secondary";
                                            break;
                                        case "CHARGED BACK":
                                            $badge = "primary";
                                            break;
                                        default:
                                            $badge = "";
                                            break;
                                    endswitch;

                                    $image = userProfilePicture($customer->id);
                                ?>
                                    <tr>
                                        <td class="nsm-text-primary">
                                            <label class="nsm-link default d-block fw-bold"><?= ($customer) ? $customer->first_name . ' ' . $customer->last_name : ''; ?></label>
                                            <label class="content-subtitle fst-italic d-block"><?php echo $customer->email; ?></label>
                                        </td>
                                        <td><?php echo $customer->city; ?></td>
                                        <td><?php echo $customer->state; ?></td>
                                        <td><?= $customer->lead_source != "" ? $customer->lead_source : 'n/a'; ?></td>
                                        <td><?php echo $customer->entered_by; ?></td>
                                        <td><?php echo ($customer) ? $customer->FName . ' ' . $customer->LName : ''; ?></td>
                                        <td><?= $customer->technician != null ? $customer->technician : 'Not Assigned'; ?></td>
                                        <td><?php echo $customer->system_type; ?></td>
                                        <td>$<?= $customer->total_amount; ?></td>
                                        <td><?php echo $customer->phone_m; ?></td>
                                        <td><span class="nsm-badge <?= $badge ?>"><?= $customer->status != null ? $customer->status : 'Pending'; ?></span></td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
                            <?php
                            else :
                            ?>
                                <tr>
                                    <td colspan="12">
                                        <div class="nsm-empty">
                                            <span>No results found.</span>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endif;
                            ?>
                        </tbody>
                    <?php endif; ?>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="messages_modal" tabindex="-1" aria-labelledby="messages_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" id="frm-send-message">
            <div class="modal-header">
                <span class="modal-title content-title">Messages</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body modal-messages-container"></div>
            </form>                
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="send_email_modal" tabindex="-1" aria-labelledby="send_email_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" id="frm-send-email">
            <input type="hidden" name="cid" id="customer-send-email-eid" />
            <div class="modal-header">
                <span class="modal-title content-title">Send Email</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <input type="text" placeholder="Customer Email" name="customer_email" id="customer-email" class="nsm-field form-control mb-2" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <input type="text" placeholder="Subject" name="customer_email_suject" id="email-subject" class="nsm-field form-control mb-2" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <textarea class="nsm-field form-control mb-2" style="height:250px;" name="customer_email_message" id="email-message" placeholder="Message" required></textarea>                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary" id="btn_send_email">Send</button>
            </div>
            </form>                
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-send-esign" tabindex="-1" aria-labelledby="modal-send-esign_label" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <input type="hidden" id="customer-esign" value="" />
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="edit_cc_label">Send eSign : <span class="bold" id="modal-send-esign-customer-name"></span></span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="customer-send-esign"></div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary" id="btn-customer-send-esign-template">Send</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="print_customer_list_modal" tabindex="-1" aria-labelledby="print_customer_list_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xxl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Print List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="print-customer-list-container"></div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary" id="btn_print_customer_list">Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-create-address" tabindex="-1" aria-labelledby="create-address-modal_label" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Add Address</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <form id="frm-save-other-address">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <input type="text" placeholder="Mail Address" name="mail_add" id="other-address-mail-add" class="nsm-field form-control mb-2" required />
                    </div>                    
                </div>
                <div class="row">
                    <div class="col-5">
                        <input type="text" placeholder="City" name="city" id="other-address-city" class="nsm-field form-control mb-2" required />
                    </div>
                    <div class="col-4">
                        <input type="text" placeholder="State" name="city" id="other-address-state" class="nsm-field form-control mb-2" required />
                    </div>
                    <div class="col-3">
                        <input type="text" placeholder="Zip" name="zip" id="other-address-zip" class="nsm-field form-control mb-2" required />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary" id="btn-save-other-address">Add</button>
            </div>
            </form>                
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-create-lost-reason" tabindex="-1" aria-labelledby="modal-create-lost-reason_label" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Add Lost Reason</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <form id="frm-add-new-lost-reason">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <input type="text" placeholder="Reason" name="lost_reason" id="lost-reason" class="nsm-field form-control mb-2" required />
                    </div>                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary" id="btn-save-lost-reason">Save</button>
            </div>
            </form>                
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-edit-lost-reason" tabindex="-1" aria-labelledby="modal-edit-lost-reason_label" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Edit Lost Reason</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <form id="frm-update-lost-reason">
            <input type="hidden" name="lrid" id="edit-lrid" value="" />
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <input type="text" placeholder="Reason" name="lost_reason" id="edit-lost-reason" class="nsm-field form-control mb-2" required />
                    </div>                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary" id="btn-update-lost-reason">Save</button>
            </div>
            </form>                
        </div>
    </div>
</div>