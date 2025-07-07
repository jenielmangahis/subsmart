<div class="modal fade" id="modal-add-custom-field" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Add New Field</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>              
            <div class="modal-body">
                <form id="frm-add-custom-field">   
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="mb-2">Field</label>
                            <div class="input-group mb-3">
                                <input type="text" name="custom_field_name" id="custom-field-name" value="" class="form-control" required="" autocomplete="off" />
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="" id="chk-is-required" checked="">
                                <label class="form-check-label" for="chk-is-required">
                                    Required
                                </label>
                            </div>  
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="" id="chk-is-visible" checked="">
                                <label class="form-check-label" for="chk-is-visible">
                                    Visible
                                </label>
                            </div>
                        </div>
                    </div> 
                </form>
            </div>  
            <div class="modal-footer">
                <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary" id="btn-add-custom-field" form="frm-add-custom-field">Add</button>                
            </div>
        </div>
    </div>
</div>