<div class="modal-header">
    <span class="modal-title content-title">Product/Service information</span>
    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
</div>
<form id="bundle-item-form" class="h-100" action="<?=url('accounting/products-and-services/bundle/create')?>" method="post" enctype="multipart/form-data">
<div class="modal-body">
    <table class="table">
        <thead>
            <tr>
                <th>
                    <div class="row" style="height: 68.5px;">
                        <div class="col-12 col-sm-2">
                            <div class="type-icon" style="background-image: url('/assets/img/accounting/bundle.png')"></div>
                        </div>
                        <div class="col-12 col-sm-10 d-flex align-items-center">
                            <h5><span>Bundle</span></h5> &nbsp;&nbsp; <a href="#" class="text-decoration-none" id="select-item-type"><span>Change type</span></a>
                        </div>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="mb-2">
                                <label for="name">Name *</label>
                                <textarea name="name" id="name" class="form-control nsm-field" required></textarea>
                            </div>
                            <div class="mb-2">
                                <label for="sku">SKU</label>
                                <input type="text" name="sku" id="sku" class="form-control nsm-field">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <input type="file" name="icon" id="icon" class="d-none">
                            <div class="icon-preview h-75">
                                <div class="no-icon border" onclick="document.getElementById('icon').click()"></div>
                                <div class="preview-uploaded border d-none" onclick="document.getElementById('icon').click()">
                                    <img src="" alt="Preview image" class="image-prev w-100">
                                </div>
                            </div>
                            <ul class="h-25 d-flex justify-content-around list-unstyled">
                                <li class="d-flex align-items-center"><a href="#" onclick="document.getElementById('icon').click()" class="text-muted"><i class="bx bx-fw bx-pencil"></i></a></li>
                                <li class="d-flex align-items-center"><a href="#" id="remove-item-icon" class="text-muted"><i class="bx bx-fw bx-trash"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-12">
                            <label for="price">Price</label>
                            <input type="text" class="form-control nsm-field text-end" id="price" name="price" required onchange="convertToDecimal(this)">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-12">
                            <label>Products/services included in the bundle</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="displayBundle" name="display_on_print" value="1">
                                <label class="form-check-label" for="displayBundle">Display bundle components when printing or sending transactions</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <table class="nsm-table" id="bundle-items-table">
                                <thead>
                                    <tr>
                                        <th width="70%">PRODUCT/SERVICE</th>
                                        <th>QTY</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="cursor-pointer">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <button type="button" class="nsm-button delete-item">
                                                <i class='bx bx-fw bx-trash'></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <button type="button" class="nsm-button delete-item">
                                                <i class='bx bx-fw bx-trash'></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3">
                                            <button type="button" class="nsm-button" id="addBundleItem">
                                                Add lines
                                            </button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="modal-footer position-absolute w-100 bottom-0">
    <div class="btn-group dropup float-end" role="group">
        <button type="button" class="nsm-button success" id="save-and-close">
            Save and close
        </button>
        <div class="btn-group" role="group">
            <button type="button" class="nsm-button success dropdown-toggle" style="margin-left: 0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bx bx-fw bx-chevron-up text-white"></i>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#" id="save-and-new">Save and new</a>
            </div>
        </div>
    </div>
</div>
</form>