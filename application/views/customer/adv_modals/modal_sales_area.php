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
                        <div class="form-group" id="customer_type_group">
                            <label for="">Sales Area Name</label><br/>
                            <input type="text" class="form-control" name="sa_name" id="sa_name" required/>
                            <input type="hidden" class="form-control" name="sa_id" id="sa_id" required/>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
