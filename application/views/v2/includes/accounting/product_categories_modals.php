<div class="modal-right-side">
    <div class="modal right fade nsm-modal" id="addNewCategory" tabindex="" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title" id="myModalLabel2" >Category information</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <form action="<?=url('accounting/product-categories/create')?>" class="h-100" method="post" id="create-category-form">
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control nsm-field" required>
                        </div>
                        <div class="form-check mb-2">
                            <input type="checkbox" id="sub-category" value="1" class="form-check-input">
                            <label for="sub-category" class="form-check-label">Is a sub-category</label>
                        </div>
                    </div>
                    <div class="modal-footer bottom-0 position-absolute w-100">
                        <button type="submit" class="nsm-button success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>