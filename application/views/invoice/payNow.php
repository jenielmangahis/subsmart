<link href="<?php echo $url->assets ?>dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css">

<div style="padding:5% 20%;">
    <div class="row" id="plansItemDiv">
        <div class="col-md-12 table-responsive">
                <table class="table table-hover">
                                        <input type="hidden" name="count" value="0" id="count">
                                        <thead>
                                        <tr style="background-color:#E8E9E8;">
                                            <th><b>Item</b></th>
                                            <th width="" id="qty_type_value"><b>Quantity</b></th>
                                            <th width=""><b>Price</b></th>
                                            <th width=""><b>Discount</b></th>
                                            <th><b>Tax(%)</b></th>
                                            <th><b>Total</b></th>
                                        </tr>
                                        </thead>
                <tbody id="table_body">
                <?php $total_tax = 0; ?>
                <?php foreach ($items as $item ) { ?>
                                                        <tr class="table-items__tr">
                                                            <td valign="top">
                                                                <?php //echo $value['item'] 
                                                                echo $item->title; ?>
                                                            </td>
                                                            <td>
                                                                <?php //echo $value['quantity'] 
                                                                echo $item->qty;?>                    
                                                            </td>
                                                            <td>
                                                                $ <?php //echo number_format($value['price'], 2, '.', ',') 
                                                                echo number_format($item->costing, 2); ?>                    
                                                            </td>
                                                            <td>
                                                                <!-- $0.00                     -->
                                                                $ <?php echo number_format($item->discount, 2); ?>
                                                            </td>
                                                            <td>
                                                                <!-- $<?php //echo number_format($value['tax'], 2, '.', ',') ?> <br> (7.5%)  -->
                                                                <?php //$total_tax += floatval($value['tax']); ?>      
                                                                $<?php echo number_format($item->tax, 2); ?>             
                                                            </td>
                                                            <td>
                                                                $ <?php //echo number_format($value['total'], 2, '.', ',') ?>   
                                                                <?php echo number_format($item->total, 2); ?>                 
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                </tbody>
            </table>
            <!-- <div class="row">
                <a class="link-modal-open pt-1 pl-2" href="javascript:void(0)" id="add_another_invoice"><span
                            class="fa fa-plus-square fa-margin-right"></span>Add Items</a>
                <hr style="display:inline-block; width:91%">
            </div> -->
            <div class="row" style="background-color:white;font-size:16px;">
                                        <div class="col-md-7">
                                        </div>
                                        <div class="col-md-5">
                                            <table class="table table_mobile" style="text-align:left;">
                                                <tr>
                                                    <td>Subtotal</td>
                                                    <!-- <td></td> -->
                                                    <td colspan="2" align="right">$ <span id="span_sub_total_invoice"><?php echo $invoice->sub_total; ?></span>
                                                        <input type="hidden" name="subtotal" id="item_total" value="<?php echo $invoice->sub_total; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td>Taxes</td>
                                                    <!-- <td></td> -->
                                                    <td colspan="2" align="right">$ <span id="total_tax_"><?php echo $invoice->taxes; ?></span><input type="hidden" name="taxes" id="total_tax_input" value="<?php echo $invoice->taxes; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:;"><input type="text" name="adjustment_name" id="adjustment_name" value="<?php echo $invoice->adjustment_name; ?>" placeholder="Adjustment Name" class="form-control" style="width:; display:inline; border: 1px dashed #d1d1d1"></td>
                                                    <td align="center">
                                                    <input type="number" name="adjustment_value" id="adjustment_input" value="<?php echo $invoice->adjustment_value; ?>" class="form-control adjustment_input" style="width:50%;display:inline;">
                                                        <span class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Optional it allows you to adjust the total amount Eg. +10 or -10." data-original-title="" title=""></span>
                                                    </td>
                                                    <td>$ <span id="adjustmentText"><?php echo $invoice->adjustment_value; ?></span></td>
                                                </tr>
                                                <!-- <tr>
                                                    <td>Markup $<span id="span_markup"></td> -->
                                                    <!-- <td><a href="#" data-toggle="modal" data-target="#modalSetMarkup" style="color:#02A32C;">set markup</a></td> -->
                                                    <input type="hidden" name="markup_input_form" id="markup_input_form" class="markup_input" value="0">
                                                <!-- </tr> -->
                                                <tr id="saved" style="color:green;font-weight:bold;display:none;">
                                                    <td>Amount Saved</td>
                                                    <td></td>
                                                    <td><span id="offer_cost">0.00</span><input type="hidden" name="voucher_value" id="offer_cost_input"></td>
                                                </tr>
                                                <tr style="color:blue;font-weight:bold;font-size:16px;">
                                                    <td><b>Grand Total ($)</b></td>
                                                    <td></td>
                                                    <td><b><span id="grand_total"><?php echo $invoice->grand_total; ?></span>
                                                        <input type="hidden" name="grand_total" id="grand_total_input" value="<?php echo $invoice->grand_total; ?>"></b></td>
                                                </tr>
                                            </table>
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
    <br>
    <button type="submit" class="btn btn-primary">Pay Now</button>
</div>

