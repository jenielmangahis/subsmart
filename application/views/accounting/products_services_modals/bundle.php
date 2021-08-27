<div class="modal-header">
    <h3 class="modal-title" id="myModalLabel2" >Product/Service information</h3>
    <button type="button" class="close close-item-modal" aria-label="Close">&times;</button>
</div>
<form id="bundle-item-form" action="<?=url('accounting/products-and-services/bundle/create')?>" method="post" enctype="multipart/form-data">
<div class="modal-body">
    <table class="table">
        <thead>
            <tr>
                <th>
                    <div class="row" style="height: 68.5px;">
                        <div class="col-sm-2">
                            <div class="type-icon" style="background-image: url('/assets/img/accounting/bundle.png')"></div>
                        </div>
                        <div class="col-sm-10 d-flex align-items-center">
                            <h5><span>Bundle</span></h5> &nbsp;&nbsp; <a href="#" class="text-info" onclick="selectType('bundle')"><span>Change type</span></a>
                        </div>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group" style="margin-bottom: 12px !important">
                                <label for="name">Name *</label>
                                <textarea name="name" id="name" class="form-control" required></textarea>
                            </div>
                            <div class="form-group" style="margin-bottom: 12px !important">
                                <label for="sku">SKU</label>
                                <input type="text" name="sku" id="sku" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <input type="file" name="icon" id="icon" class="hide">
                            <div class="icon-preview h-75">
                                <div class="no-icon border" onclick="document.getElementById('icon').click()"></div>
                                <div class="preview-uploaded border hide" onclick="document.getElementById('icon').click()">
                                    <img src="" alt="Preview image" class="image-prev w-100">
                                </div>
                            </div>
                            <div class="action-bar h-25 d-flex align-items-center justify-content-center">
                                <ul>
                                    <li><a href="#" onclick="document.getElementById('icon').click()"><i class="fa fa-pencil"></i></li>
                                    <li><a href="#" onclick="removeIcon()"><i class="fa fa-trash-o"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-check" style="margin-bottom: 0 !important">
                                <input type="checkbox" name="rebate_item" id="rebate-item" class="form-check-input" value="1">
                                <label for="rebate-item" class="form-check-lable">Rebate Item</label>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group" style="margin: 0 !important">                                                
                                <label for="description">Description</label>
                                <textarea name="description" id="description" placeholder="Description on sales forms" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Products/services included in the bundle</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="displayBundle" name="display_on_print" value="1">
                                <label class="form-check-label" for="displayBundle">
                                    Display bundle components when printing or sending transactions
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <table class="table table-bordered table-hover" id="bundle-items-table">
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
                                        <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="#" class="text-info" id="addBundleItem"><i class="fa fa-plus"></i> Add lines</a>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="modal-footer">
    <div class="btn-group dropup float-right">
        <button type="submit" class="btn btn-success">
            Save and close
        </button>
        <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Save and new</a>
        </div>
    </div>
</div>
</form>