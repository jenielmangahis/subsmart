<div class="row" id="plansItemDiv">
    <div class="col-md-12 table-responsive">
        <table class="table table-hover">
            <input type="hidden" name="count" value="0" id="count">
            <thead>
            <tr>
                <th>Item</th>
                <th>Type</th>
                <th width="100px" id="qty_type_value">Quantity</th>
                <th width="100px">Price</th>
                <th width="100px">Discount</th>
                <th>Tax(%)</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody id="table_body">
            <?php $total_tax = 0; ?>
            <?php foreach ($invoice->invoice_items as $key => $value ) : ?>
                <tr>
                    <td><input type="text" value="<?php echo $value['item'] ?>" class="form-control getItems"
                            onKeyup="getItems(this)" name="item[]">
                        <ul class="suggestions"></ul>
                    </td>
                    <td><select name="item_type[]" class="form-control">
                            <option value="service" <?php echo ($value['quantity'] === "service") ? "selected" : '' ?>>Service</option>
                            <option value="material" <?php echo ($value['quantity'] === "material") ? "selected" : '' ?>>Material</option>
                            <option value="product" <?php echo ($value['quantity'] === "product") ? "selected" : '' ?>>Product</option>
                        </select></td>
                    <td><input type="text" class="form-control quantity" name="quantity[]"
                            data-counter="0" id="quantity_0" value="<?php echo $value['quantity'] ?> "></td>
                    <td><input type="number" class="form-control price" name="price[]"
                            data-counter="0" id="price_0" min="0" value="<?php echo number_format($value['price'], 2, '.', '') ?>"></td>
                    <td><input type="hidden" class="form-control discount" name="discount[]"
                            data-counter="0" id="discount_0" min="0" value="0">
                            <span id="span_discount_0">0.00 (0.00%)</span></td>
                    <td><input type="hidden" class="form-control tax" name="tax[]"
                            data-counter="0" id="tax_0" min="0" value="<?php echo number_format($value['tax'], 2, '.', ',') ?>">
                            <span id="span_tax_0"><?php echo number_format($value['tax'], 2, '.', ',') ?> (7.5%)</span></td>
                    <td><input type="hidden" class="form-control total" name="total[]"
                            data-counter="0" id="total_0" min="0" value="<?php echo number_format($value['total'], 2, '.', ',') ?>">
                            <span id="span_total_0"><?php echo number_format($value['total'], 2, '.', ',') ?></span></td>
                </tr>
                <?php $total_tax += floatval($value['tax']); ?>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="row">
            <a class="link-modal-open pt-1 pl-2" href="javascript:void(0)" id="add_another_invoice"><span
                        class="fa fa-plus-square fa-margin-right"></span>Add Items</a>
            <hr style="display:inline-block; width:91%">
        </div>
        <div class="row">
            <div class="col-md-7">
            &nbsp;
            </div>
            <div class="col-md-5 row pr-0">
                <div class="col-sm-5">
                    <label style="padding: 0 .75rem;">Subtotal</label>
                </div>
                <div class="col-sm-6 text-right pr-3">
                    <label id="invoice_sub_total"><?php echo number_format(floatval($invoice->invoice_totals['sub_total'] - $total_tax), 2, '.', ',') ?></label>
                    <input type="hidden" name="sub_total" id="sub_total_form_input" value='0'>
                </div>
                <div class="col-sm-12">
                    <hr>
                </div>
                <div class="col-sm-4">
                    <input type="text" name="adjustment_name" value="" placeholder="Adjustment" class="form-control" style="width:200px; display:inline; border: 1px dashed #d1d1d1">
                </div>
                <div class="col-sm-4">
                    <input type="text" name="adjustment_total" id="adjustment_input" value="<?php echo $invoice->invoice_totals['adjustment_amount']?>" class="form-control" style="width:100px; display:inline-block">
                </div>
                <div class="col-sm-3 text-right pt-2">
                    <label id="adjustment_amount"><?php echo number_format($invoice->invoice_totals['adjustment_amount'], 2, '.', ',') ?></label>
                    <input type="hidden" name="adjustment_amount" id="adjustment_amount_form_input" value='0'>
                </div>
                <div class="col-sm-12">
                    <hr>
                </div>
                <div class="col-sm-5">
                    <label style="padding: .375rem .75rem;">Grand Total ($)</label>
                </div>
                <div class="col-sm-6 text-right pr-3">
                    <label id="invoice_grand_total"><?php echo number_format($invoice->invoice_totals['grand_total'], 2, '.', ',') ?></label>
                    <input type="hidden" name="grand_total" id="grand_total_form_input" value='0'>
                </div>
                <div class="col-sm-12">
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h5>Payment Options</h5>
        <span class="help help-sm help-block">Select type of payment you're comfortable.</span>
    </div>
    <div class="col-md-4 form-group">
        <select name="deposit_request" class="form-control">
            <option value="1" selected="selected">Stripe</option>
            <option value="2">Paypal</option>
        </select>
    </div>
    <div class="col-md-12">
        <label class="float-left mini-stat-img mr-4">Accept Credit Cards</label>
        <div class="float-left mini-stat-img mr-4"><img src="<?php echo $url->assets ?>frontend/images/credit_cards.png" alt=""></div>
    </div>
</div>
