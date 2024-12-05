<div class="modal fade" id="quick_add_financing_category" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Create Financing Category</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="frm-quick-add-financing-category">
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

<div class="modal fade" id="quick_add_customer_status" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Create Customer Status</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="frm-quick-add-customer-status">
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="mb-2">Name</label>
                            <div class="input-group mb-3">
                                <input type="text" name="status_name" value="" class="form-control" required="" autocomplete="off" />
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">                        
                        <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="nsm-button primary" id="btn-save-customer-status">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="quick_add_customer_group" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Create Customer Group</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="frm-quick-add-customer-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="mb-2">Name</label>
                            <div class="input-group mb-3">
                                <input type="text" name="group_name" value="" class="form-control" required="" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="mb-2">Description</label>
                            <div class="input-group mb-3">
                                <textarea name="group_description" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">                        
                        <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="nsm-button primary" id="btn-save-customer-group">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="quick_add_sales_area" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Create Sales Area</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="frm-quick-add-sales-area">
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="mb-2">Name</label>
                            <div class="input-group mb-3">
                                <input type="text" name="sa_name" value="" class="form-control" required="" autocomplete="off" />
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">                        
                        <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="nsm-button primary" id="btn-save-sales-area">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="quick_add_rate_plan" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Create Rate Plan</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="frm-quick-add-rate-plan">
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="mb-2">Plan Name</label>
                            <div class="input-group mb-3">
                                <input type="text" name="plan_name" value="" class="form-control" required="" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="mb-2">Plan Amount</label>
                            <div class="input-group mb-3" style="width:40%;">
                                <input type="number" step="any" name="plan_amount" value="" class="form-control" required="" autocomplete="off" />
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">                        
                        <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="nsm-button primary" id="btn-save-rate-plan">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>