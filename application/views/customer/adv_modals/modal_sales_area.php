<div class="modal fade" id="modal_sales_area" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sales_area_header">Add Sales Area</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="salesAreaForm">
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row form_line" id="customer_type_group">
                            <div class="col-md-4">
                                Sales Area Name
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="sa_name" id="sa_name"  required/>
                                <input type="hidden" class="form-control" name="sa_id" id="sa_id"/>
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

<div class="modal fade" id="modal_edit_sales_area" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Sales Area</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editSalesAreaForm">
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row form_line" id="customer_type_group">
                            <div class="col-md-4">
                                Sales Area Name
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="sa_name" id="edit_sa_name"  required/>
                                <input type="hidden" class="form-control" name="sa_id" id="edit_sa_id"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane-o"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
