<div class="modal fade" id="modal_rate_plan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Rate Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="ratePlanForm">
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row form_line" id="customer_type_group">
                            <div class="col-md-4">
                                Rate Amount
                            </div>
                            <div class="col-md-8">
                                <input type="number" step=".01" class="form-control" name="amount" id="amount"  required/>
                                <input type="hidden" class="form-control" name="id" id="id"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-remove"></i>Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane-o"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_edit_rate_plan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Rate Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editRatePlanForm">
                <input type="hidden" id="rate-plan-id" name="rate-plan-id" value="">
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row form_line" id="customer_type_group">
                            <div class="col-md-4">
                                Rate Amount
                            </div>
                            <div class="col-md-8">
                                <input type="number" step=".01" class="form-control" name="amount" id="edit-rate-plan-amount"  required/>
                                <input type="hidden" class="form-control" name="id" id="id"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-remove"></i>Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane-o"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>