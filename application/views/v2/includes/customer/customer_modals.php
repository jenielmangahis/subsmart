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

<div class="modal fade nsm-modal fade" id="new_sales_area_modal" tabindex="-1" aria-labelledby="new_sales_area_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="new_sales_area_form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Add Sales Area</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="sa_id" id="sa_id" />
                    <div class="row">
                        <div class="col-12">
                            <input type="text" placeholder="Sales Area Name" name="sa_name" id="sa_name" class="nsm-field form-control mb-2" required/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="edit_sales_area_modal" tabindex="-1" aria-labelledby="edit_sales_area_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="edit_sales_area_form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Edit Sales Area</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="sa_id" id="edit_sa_id" value=""/>
                    <div class="row">
                        <div class="col-12">
                            <input type="text" placeholder="Sales Area Name" name="sa_name" id="edit_sa_name" class="nsm-field form-control mb-2" value="" required/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="new_lead_source_modal" tabindex="-1" aria-labelledby="new_lead_source_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="new_lead_source_form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Add Lead Source</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="ls_id" id="ls_id" />
                    <div class="row">
                        <div class="col-12">
                            <input type="text" placeholder="Sales Area Name" name="ls_name" id="ls_name" class="nsm-field form-control mb-2" required/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="edit_lead_source_modal" tabindex="-1" aria-labelledby="edit_lead_source_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="edit_lead_source_form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Edit Lead Source</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="ls_id" id="edit_ls_id" />
                    <div class="row">
                        <div class="col-12">
                            <input type="text" placeholder="Sales Area Name" name="ls_name" id="edit_ls_name" class="nsm-field form-control mb-2" required/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="new_lead_types_modal" tabindex="-1" aria-labelledby="new_lead_types_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="new_lead_types_form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Add Lead Type</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="lead_id" id="lead_id" />
                    <div class="row">
                        <div class="col-12">
                            <input type="text" placeholder="Lead Type Name" name="lead_name" id="lead_name" class="nsm-field form-control mb-2" required/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="edit_lead_type_modal" tabindex="-1" aria-labelledby="edit_lead_type_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="edit_lead_type_form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Edit Lead Type</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="lead_id" id="edit_lead_id" />
                    <div class="row">
                        <div class="col-12">
                            <input type="text" placeholder="Lead Type Name" name="lead_name" id="edit_lead_name" class="nsm-field form-control mb-2" required/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="new_rate_plan_modal" tabindex="-1" aria-labelledby="new_rate_plan_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="new_rate_plan_form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Add Rate Plan</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="id" id="rate_id" />
                    <div class="row">
                        <div class="col-12">
                            <input type="text" placeholder="Plan Name" name="plan_name" id="plan_name" class="nsm-field form-control mb-2" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="number" placeholder="Rate Amount" name="amount" id="amount" class="nsm-field form-control mb-2" required/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="edit_rate_plan_modal" tabindex="-1" aria-labelledby="edit_rate_plan_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="edit_rate_plan_form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Edit Rate Plan</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="rate-plan-id" id="rate_plan_id" />
                    <input type="hidden" class="form-control" name="id" id="edit_rate_id" />
                    <div class="row">
                        <div class="col-12">
                            <input type="text" placeholder="Plan Name" name="plan_name" id="edit_plan_name" class="nsm-field form-control mb-2" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="number" placeholder="Rate Amount" name="amount" id="edit_amount" class="nsm-field form-control mb-2" required/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="new_activation_fee_modal" tabindex="-1" aria-labelledby="new_activation_fee_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="new_activation_fee_form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Add Activation Fee</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="id" id="fee_id" />
                    <div class="row">
                        <div class="col-12">
                            <input type="number" placeholder="Amount" name="amount" id="amount" step=".01" class="nsm-field form-control mb-2" required/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="edit_activation_fee_modal" tabindex="-1" aria-labelledby="edit_activation_fee_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="edit_activation_fee_form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Edit Activation Fee</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="id" id="edit_fee_id" />
                    <div class="row">
                        <div class="col-12">
                            <input type="number" placeholder="Amount" name="amount" id="edit_fee_amount" step=".01" class="nsm-field form-control mb-2" required/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="new_system_package_modal" tabindex="-1" aria-labelledby="new_system_package_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="new_system_package_form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Add System Package Type</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="id" id="system_id" />
                    <div class="row">
                        <div class="col-12">
                            <input type="text" placeholder="Name" name="name" id="system_name" class="nsm-field form-control mb-2" required/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="edit_system_package_modal" tabindex="-1" aria-labelledby="edit_system_package_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="edit_system_package_form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Edit System Package Type</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="id" id="edit_system_id" />
                    <div class="row">
                        <div class="col-12">
                            <input type="text" placeholder="Name" name="name" id="edit_system_name" class="nsm-field form-control mb-2" required/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>