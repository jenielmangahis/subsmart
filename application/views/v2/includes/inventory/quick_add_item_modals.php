<div class="modal fade nsm-modal" id="modal-product-list" tabindex="-1" role="dialog" aria-labelledby="modal-product-listLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newcustomerLabel">Product List</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bx bx-fw bx-x m-0"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12 col-md-12">    
                        <div class="nsm-field-group search" style="max-width:100% !important;">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_product" name="search" value="" placeholder="Search Product">
                        </div>
                    </div>
                    <div class="product-list-container"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade nsm-modal" id="modal-edit-product-stock" tabindex="-1" role="dialog" aria-labelledby="modal-edit-product-stockLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <form method="POST" id="frm-update-product-stock">
                <div class="modal-header">
                    <h5 class="modal-title" id="newcustomerLabel">Edit Stock</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bx bx-fw bx-x m-0"></i>
                    </button>
                </div>
                <div class="modal-body" id="product-stock-container"></div>
                <div class="modal-footer">                    
                    <div style="float:right;">
                        <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button primary" id="btn-job-submit">Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade nsm-modal" id="modal-services-list" tabindex="-1" role="dialog" aria-labelledby="modal-services-listLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newcustomerLabel">Services List</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bx bx-fw bx-x m-0"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12 col-md-12">    
                        <div class="nsm-field-group search" style="max-width:100% !important;">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_services" name="search" value="" placeholder="Search Services">
                        </div>
                    </div>
                    <div class="services-list-container"></div>
                </div>
            </div>
        </div>
    </div>