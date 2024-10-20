<style>
    .image-height{
        height: 100px;
        margin: auto;
    }
</style>
<div class="modal-right-side">
    <div class="modal right fade nsm-modal" tabindex="-1" id="item-modal" role="dialog">
        <div class="modal-dialog" role="document" style="width: 25%">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Product/Service information</span>
                    <button type="button" aria-label="Close" class="close-item-modal"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>
                <div class="modal-body p-0">
                    <table class="table table-hover cursor-pointer" id="types-table">
                        <tbody>
                            <tr data-href="product">
                                <td>
                                    <div class="row" style="height: 117px">
                                        <div class="col-12 col-md-3 image-height">
                                            <div class="type-icon" style="background-image: url('<?php echo base_url(); ?>assets/img/accounting/inventory.png')">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-9 d-flex align-items-center">
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
                                        <div class="col-12 col-md-3 image-height">
                                            <div class="type-icon" style="background-image: url('<?php echo base_url(); ?>assets/img/accounting/non-inventory.png')">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-9 d-flex align-items-center">
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
                                        <div class="col-12 col-md-3 image-height">
                                            <div class="type-icon" style="background-image: url('<?php echo base_url(); ?>assets/img/accounting/service.png')">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-9 d-flex align-items-center">
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
                            <?php if ($field === 'product' || $field === '') : ?>
                                <tr data-href="bundle">
                                    <td>
                                        <div class="row" style="height: 117px">
                                            <div class="col-12 col-md-3 image-height">
                                                <div class="type-icon" style="background-image: url('/assets/img/accounting/bundle.png')">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-9 d-flex align-items-center">
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