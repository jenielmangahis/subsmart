<div class="modal-right-side">
    <div class="modal right fade" id="item-modal" tabindex="" role="dialog"
        aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document" style="width: 25%">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel2">Product/Service information
                    </h3>
                    <button type="button" class="close close-item-modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body p-0">
                    <table class="table table-hover cursor-pointer" id="types-table">
                        <tbody>
                            <tr data-href="product">
                                <td>
                                    <div class="row" style="height: 117px">
                                        <div class="col-sm-3">
                                            <div class="type-icon"
                                                style="background-image: url('/assets/img/accounting/inventory.png')">
                                            </div>
                                        </div>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <div class="type-description">
                                                <h5 class="m-0">Inventory</h5>
                                                <span>Products you buy and/or sell and that
                                                    you track quantities of.</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-href="non-inventory">
                                <td>
                                    <div class="row" style="height: 117px">
                                        <div class="col-sm-3">
                                            <div class="type-icon"
                                                style="background-image: url('/assets/img/accounting/non-inventory.png')">
                                            </div>
                                        </div>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <div class="type-description">
                                                <h5 class="m-0">Non-inventory</h5>
                                                <span>Products you buy and/or sell but don’t
                                                    need to (or can’t) track quantities of,
                                                    for example, nuts and bolts used in an
                                                    installation.</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-href="service">
                                <td>
                                    <div class="row" style="height: 117px">
                                        <div class="col-sm-3">
                                            <div class="type-icon"
                                                style="background-image: url('/assets/img/accounting/service.png')">
                                            </div>
                                        </div>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <div class="type-description">
                                                <h5 class="m-0">Service</h5>
                                                <span>Services that you provide to
                                                    customers, for example, landscaping or
                                                    tax preparation services.</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php if($field === 'product') : ?>
                            <tr data-href="bundle">
                                <td>
                                    <div class="row" style="height: 117px">
                                        <div class="col-sm-3">
                                            <div class="type-icon"
                                                style="background-image: url('/assets/img/accounting/bundle.png')">
                                            </div>
                                        </div>
                                        <div class="col-sm-9 d-flex align-items-center">
                                            <div class="type-description">
                                                <h5 class="m-0">Bundle</h5>
                                                <span>A collection of products and/or
                                                    services that you sell together, for
                                                    example, a gift basket of fruit, cheese,
                                                    and wine.</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>