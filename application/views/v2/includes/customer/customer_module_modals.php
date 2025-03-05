<div class="modal fade nsm-modal fade" id="manage_modules_modal" tabindex="-1" aria-labelledby="manage_modules_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="manage_modules_modal_label">Manage Modules</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-12 mb-2">
                        <label class="content-subtitle">Select the modules you would like to display in your layout</label>
                    </div>
                    <div class="col-12" id="modules_container">
                        <div class="nsm-loader">
                            <i class='bx bx-loader-alt bx-spin'></i>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="widgetIDs" />
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-send-esign" tabindex="-1" aria-labelledby="modal-send-esign_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <input type="hidden" id="customer-esign" value="" />
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="edit_cc_label">Send eSign</span>
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

<div class="modal fade nsm-modal fade" id="statement_claim_modal" tabindex="-1" aria-labelledby="statement_claim_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">     
        <form id="frm-statement-claim" action="<?= base_url('customer/download_statement_of_claims'); ?>" method="POST">   
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title" id="edit_cc_label">Statement of Claim</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="nsm-card primary">
                                <div class="nsm-card-header">
                                    <div class="nsm-card-title">
                                        <span><i class='bx bx-user-circle'></i>Plaintiff</span>
                                    </div>
                                </div> 
                                <div class="nsm-card-content">
                                    <div class="form-group mb-3">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="plaintiff_name" value="<?= $profile_info->first_name . ' ' . $profile_info->last_name; ?>" placeholder="">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Street Address</label>
                                        <input type="text" class="form-control" name="plaintiff_adress" value="<?= $profile_info->mail_add; ?>" placeholder="">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>City, State, Zip</label>
                                        <input type="text" class="form-control" name="plaintiff_city_state_zip" value="<?= $profile_info->city . ', ' . $profile_info->state . ' ' . $profile_info->zip_code; ; ?>" placeholder="">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" name="plaintiff_phone" value="<?= $profile_info->phone_m; ?>" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="nsm-card primary">
                                <div class="nsm-card-header">
                                    <div class="nsm-card-title">
                                        <span><i class='bx bx-user-circle'></i>Defendant</span>
                                    </div>
                                </div>
                                <div class="nsm-card-content">
                                    <div class="form-group mb-3">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="defendant_name" placeholder="">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Street Address</label>
                                        <input type="text" class="form-control" name="defendant_adress" placeholder="">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>City, State, Zip</label>
                                        <input type="text" class="form-control" name="defendant_city_state_zip" placeholder="">
                                    </div>
                                    <!-- <div class="form-group mb-3">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" name="defendant_phone" placeholder="">
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="nsm-card primary">
                                <div class="nsm-card-header">
                                    <div class="nsm-card-title">
                                        <span><i class='bx bx-list-ul'></i>Details</span>
                                    </div>
                                </div>
                                <div class="nsm-card-content">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Case Number</label>
                                                <input type="text" class="form-control" name="soc_case_number" placeholder="">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Division</label>
                                                <input type="text" class="form-control" name="soc_division" placeholder="">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Damage Amount</label>
                                                <input type="number" step="any" value="0.00" class="form-control" name="soc_damage_amount" placeholder="">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Court costs</label>
                                                <input type="number" step="any" value="0.00" class="form-control" name="soc_court_costs" placeholder="">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Sheriff's fees</label>
                                                <input type="number" step="any" value="40.00" class="form-control" name="soc_sheriff_fees" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Plaintiff (or agent)</label>
                                                <input type="text" class="form-control" name="soc_plaintiff_agent" value="<?= $profile_info->first_name . ' ' . $profile_info->last_name; ?>" placeholder="">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Deputy Clerk</label>
                                                <input type="text" class="form-control" name="soc_deputy_clerk" placeholder="">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Commission Expires</label>
                                                <input type="text" class="form-control" name="commission_expires" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary" id="">Create PDF</button>
                </div>
            </div>
        </form>
    </div>
</div>