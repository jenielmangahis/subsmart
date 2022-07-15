<div class="col-12">
    <div class="nsm-card">
        <div class="nsm-card-header">
            <div class="nsm-card-title">
                <span>Order Summary</span>
            </div>
        </div>
        <div class="nsm-card-content">
            <div class="row g-2">
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold d-block">Date Paid</label>
                </div>
                <div class="col-12 col-md-6 text-end">
                    <label class="content-subtitle d-block"><?= date("m/d/Y", strtotime($appointment->date_paid)); ?></label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold d-block">Paid via</label>
                </div>
                <div class="col-12 col-md-6 text-end">
                    <label class="content-subtitle d-block"><?= strtoupper($appointment->payment_gateway); ?></label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold d-block">Items</label>
                </div>
                <div class="col-12 col-md-6 text-end">
                    <label class="content-subtitle d-block">$<?= number_format($appointment->total_item_price, 2); ?></label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold d-block">Discount</label>
                </div>
                <div class="col-12 col-md-6 text-end">
                    <label class="content-subtitle d-block">$<?= number_format($appointment->total_item_discount, 2); ?></label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold d-block">Tax</label>
                </div>
                <div class="col-12 col-md-6 text-end">
                    <label class="content-subtitle d-block">$<?= number_format($appointment->total_tax, 2); ?></label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-title fw-bold d-block">Total</label>
                </div>
                <div class="col-12 col-md-6 text-end">
                    <label class="content-title d-block fw-bold">$<?= number_format($appointment->total_amount, 2); ?></label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="nsm-card">
        <div class="nsm-card-header">
            <div class="nsm-card-title">
                <span>Items</span>
            </div>
        </div>
        <div class="nsm-card-content">
            <table class="nsm-table">
                <thead>
                    <tr>
                        <td data-name="Item Name">Item Name</td>
                        <td data-name="Item Price">Item Price</td>
                        <td data-name="Quantity">Quantity</td>
                        <td data-name="Discount">Discount</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($appointmentItems as $item) { ?>
                        <tr>
                            <td>
                                <input type="text" class="nsm-field form-control" placeholder="Item Name" value="<?= $item->item_name; ?>" readonly>
                            </td>
                            <td>
                                <input type="text" class="nsm-field form-control item-price" placeholder="Item Price" value="<?= number_format($item->item_price,2); ?>" readonly>
                            </td>
                            <td>
                                <input type="text" class="nsm-field form-control item-qty" placeholder="Quantity" value="<?= number_format($item->qty,2); ?>" readonly>
                            </td>
                            <td>
                                <input type="text" class="nsm-field form-control item-discount" placeholder="Item Discount" value="<?= number_format($item->discount_amount,2); ?>" readonly>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>