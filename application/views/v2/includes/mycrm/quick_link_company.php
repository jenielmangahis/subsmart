<div class="modal fade nsm-modal fade" id="sidebar-modal-add-multi-account" aria-labelledby="sidebar-modal-add-multi-account-label" aria-hidden="true" style="z-index:9999 !important;">
    <div class="modal-dialog modal-lg">
        <form id="sidebar-add-multi-account-form" method="POST">
            <div class="modal-content" style="width:78% !important;">
                <div class="modal-header">
                    <span class="modal-title content-title"><i class='bx bx-link-alt'></i> Link a company account to <?= $profiledata->business_name; ?></span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <p>Please enter the login and password for the company you would like to link to this login</p>
                    <div class="row">
                        <div class="col-12">                                
                            <label class="content-subtitle fw-bold d-block mb-2">Email</label>
                            <input type="email" class="form-control" name="multi_email" id="sidebar-multi-email" required="">                                
                        </div>
                        <div class="col-12 mt-3">
                            <label class="content-subtitle fw-bold d-block mb-2">Password</label>
                            <input type="password" class="form-control" name="multi_password" id="sidebar-multi-password" required="">
                        </div>
                    </div>
                </div>                    
                <div class="modal-footer">                    
                    <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary" id="btn-sidebar-add-multi-account">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>