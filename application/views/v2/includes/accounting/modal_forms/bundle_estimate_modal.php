<div class="full-screen-modal">
    <form onsubmit="submitModalForm(event, this)" id="modal-form">
        <div id="bundle-estimate-modal" class="modal fade modal-fluid nsm-modal" role="dialog" data-bs-backdrop="false">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title">Bundle Estimate</span>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="min-height: 100%">
                            <div class="col">
                                <div class="row customer-details">
                                    <div class="col-12 col-md-8 grid-mb">
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <label for="customer">Customer</label>
                                                <select name="customer" id="customer" class="form-control nsm-field" required>
                                                    <?php if(isset($estimate)) : ?>
                                                        <option value="<?=$estimate->customer_id?>">
                                                        <?php
                                                            $customer = $this->accounting_customers_model->get_by_id($estimate->customer_id);
                                                            echo $customer->first_name . ' ' . $customer->last_name;
                                                        ?>
                                                        </option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 text-end grid-mb">
                                        <h6>AMOUNT</h6>
                                        <h2>
                                            <span class="transaction-grand-total">
                                                $0.00
                                            </span>
                                        </h2>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-2">
                                        <label for="customer-email">Customer Email</label>
                                        <input type="text" name="customer_email" id="customer-email" class="form-control nsm-field mb-2" value="" disabled>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label for="customer-mobile">Customer Mobile</label>
                                        <input type="text" name="customer_mobile" id="customer-mobile" class="form-control nsm-field mb-2" value="" disabled>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <label for="job-location">Job Location</label>
                                        <input type="text" name="job_location" id="job-location" class="form-control nsm-field mb-2" value="">
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="job-name">Job Name</label>
                                        <input type="text" name="job_name" id="job-name" class="form-control nsm-field mb-2" value="">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-2">
                                        <label for="estimate-no">Estimate # <span class="text-danger">*</span></label>
                                        <input type="text" name="estimate_no" id="estimate-no" class="form-control nsm-field mb-2" value="">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label for="estimate-date">Estimate Date <span class="text-danger">*</span></label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" name="estimate_date" id="estimate-date" class="form-control nsm-field mb-2" value="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label for="expiry-date">Expiry Date <span class="text-danger">*</span></label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" name="expiry_date" id="expiry-date" class="form-control nsm-field mb-2" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-2">
                                        <label for="purchase-order-no">Purchase Order #</label>
                                        <input type="text" name="purchase_order_no" id="purchase-order-no" class="form-control nsm-field mb-2" value="">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label for="estimate-type">Estimate Type <span class="text-danger">*</span></label>
                                        <select name="estimate_type" id="estimate-type" class="form-control nsm-field">
                                            <option value="Deposit">Deposit</option>
                                            <option value="Partial Payment">Partial Payment</option>
                                            <option value="Final Payment">Final Payment</option>
                                            <option value="Total Due" selected>Total Due</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label for="estimate-status">Estimate Status <span class="text-danger">*</span></label>
                                        <select name="estimate_status" id="estimate-status" class="form-control nsm-field">
                                            <option value="Draft">Draft</option>
                                            <option value="Submitted">Submitted</option>
                                            <option value="Accepted">Accepted</option>
                                            <option value="Declined By Customer">Declined By Customer</option>
                                            <option value="Lost">Lost</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row w-100">
                            <div class="col-md-4">
                                <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                            <div class="col-md-4">
                                <div class="row h-100">
                                    <div class="col-md-12 d-flex align-items-center justify-content-center">
                                        <span><a href="#" class="text-dark text-decoration-none" id="print-or-preview">Print or Preview</a></span>
                                        <span class="mx-3 divider"></span>
                                        <span><a href="#" onclick="makeRecurring('bundle_estimate')" class="text-dark text-decoration-none">Make recurring</a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Split dropup button -->
                                <div class="btn-group float-end" role="group">
                                    <button type="button" class="nsm-button success" id="save-and-send">
                                        Save and send
                                    </button>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="nsm-button success dropdown-toggle" style="margin-left: 0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-fw bx-chevron-up text-white"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#" onclick="saveAndNewForm(event)">Save and new</a>
                                            <a class="dropdown-item" href="#" onclick="saveAndCloseForm(event)">Save and close</a>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="nsm-button float-end" id="save">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--end of modal-->
    </form>
</div>