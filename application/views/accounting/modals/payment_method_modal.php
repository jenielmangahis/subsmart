<div class="modal fade" id="payment-method-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered m-auto w-25" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Payment Method</h4>
                <button type="button" class="close close-payment-method"><i class="fa fa-times fa-lg"></i></button>
            </div>
            <?php 
                $action = isset($paymentMethod) ? "/accounting/payment-methods/update/$paymentMethod->id" : '/accounting/payment-methods/add';
            ?>
            <form id="payment-method-form" action="<?=$action?>" method="post">
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card p-0 m-0">
                            <div class="card-body" style="max-height: 650px;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" class="form-control" <?=isset($paymentMethod) ? "value='$paymentMethod->name'" : ''?>>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="checkbox checkbox-sec">
                                                <input class="form-check-input" type="checkbox" id="credit_card" name="credit_card" value="1" <?=isset($paymentMethod) && $paymentMethod->credit_card ? 'checked' : ''?>>
                                                <label class="form-check-label" for="credit_card">This is a credit card.</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-sm-6">
                    <button type="button" class="btn btn-secondary btn-rounded border close-payment-method">Close</button>
                </div>
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-success btn-rounded border float-right">Save</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>