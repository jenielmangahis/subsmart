<div id="item-location-modal" class="modal fade modal-fluid nsm-modal" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <!-- Modal content-->
        <form id="new-location-form" class="w-50 m-auto">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">New Location</span>
                <button type="button" class="cancel-add-location" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
            </div>
            <div class="modal-body">
                <div class="row" style="min-height: 100%">
                    <div class="col-12">
                        <label for="location">Location</label>
                        <input type="text" name="location_name" id="location" class="nsm-field form-control mb-2" placeholder="Maximum 25 characters only">
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input type="checkbox" name="default" id="default-location" class="form-check-input" value="true">
                            <label for="default-location" class="form-check-lable">Set to default location</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="nsm-button success float-end">Save</button>
            </div>
        </div>
        </form>
    </div>
</div>