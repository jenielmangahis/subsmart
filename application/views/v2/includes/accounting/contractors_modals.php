<div class="modal fade nsm-modal" id="add-contractor-modal" tabindex="-1" role="dialog" aria-labelledby="add-contractor-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="/accounting/contractors/add" method="post" class="form-validate" novalidate="novalidate">
                <div class="modal-header">
                    <span class="modal-title content-title" id="add-contractor-modal-label">Add a contractor</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row gy-3">
                        <div class="col-12">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control nsm-field" name="name" id="name" required>
                        </div>
                        <div class="col-12">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control nsm-field" name="email" id="email" required>
                        </div>
                    </div>
                </div>
                <!-- end modal-body -->
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-12 col-md-6">
                            <button type="button" class="nsm-button primary close-account-modal" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-12 col-md-6 text-end">
                            <button type="submit" name="save" class="nsm-button success">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>