<?php if (!empty($plan->items)) { ?>
    <div class="col-md-12 table-responsive">
        <table class="table table-hover">

            <thead>
                <tr>
                    <th>DESCRIPTION</th>
                    <th>Type</th>
                    <th width="100px">Quantity</th>
                    <th>LOCATION</th>
                    <th width="100px">COST</th>
                    <th width="100px">Discount</th>
                    <th>Tax(%)</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody id="table_body">
                <?php
                echo count(unserialize($plan->items));
                $i = 0;
                if ($plan->items != '') { ?>
                    <input type="hidden" name="count" value="<?php echo count(unserialize($plan->items)) - 1; ?>" id="count">
                    <?php
                    foreach (unserialize($plan->items) as $row) { ?>
                        <tr>
                            <td><input type="text" autocomplete="off" class="form-control getItems" onKeyup="getItems(this)" name="item[]" value="<?php echo $row['item'] ?>">
                                <ul class="suggestions"></ul>
                            </td>
                            <td><select name="item_type[]" class="form-control">
                                    <option value="product" <?php if ($row['item_type'] == 'product') echo 'selected'; ?>>Product</option>
                                    <option value="material" <?php if ($row['item_type'] == 'material') echo 'selected'; ?>>Material</option>
                                    <option value="service" <?php if ($row['item_type'] == 'service') echo 'selected'; ?>>Service</option>
                                </select></td>
                            <td><input type="text" class="form-control quantity" name="quantity[]" value="<?php echo $row['quantity'] ?>" data-counter="<?= $i ?>" id="quantity_<?= $i ?>"></td>
                            <td><input type="text" class="form-control" name="location[]" value="<?php echo $row['location'] ?>"></td>
                            <td><input readonly type="number" class="form-control price" name="price[]" data-counter="<?= $i ?>" id="price_<?= $i ?>" min="0" value="<?php echo $row['price'] ?>"></td>
                            <td><input type="number" class="form-control discount" name="discount[]" data-counter="<?= $i ?>" id="discount_<?= $i ?>" min="0" value="<?php echo $row['discount'] ?>" readonly></td>
                            <td><span id="span_tax_<?= $i ?>">0.00 (7.5%)</span></td>
                            <td><span id="span_total_<?= $i ?>">0.00</span></td>
                        </tr>
                    <?php
                        $i++;
                    }
                } else {
                    ?>
                    <input type="hidden" name="count" value="0" id="count">121
                    <tr>
                        <td><input type="text" autocomplete="off" class="form-control getItems" onKeyup="getItems(this)" name="item[]">
                            <ul class="suggestions"></ul>
                        </td>
                        <td><select name="item_type[]" class="form-control">
                                <option value="product">Product</option>
                                <option value="material">Material</option>
                                <option value="service">Service</option>
                            </select></td>
                        <td><input type="text" class="form-control quantity" name="quantity[]" data-counter="0" id="quantity_0" value="1"></td>
                        <td><input type="text" class="form-control" name="location[]"></td>
                        <td><input readonly type="number" class="form-control price" name="price[]" data-counter="0" id="price_0" min="0" value="0"></td>
                        <td><input type="number" class="form-control discount" name="discount[]" data-counter="0" id="discount_0" min="0" value="0" readonly></td>
                        <td><span id="span_tax_0">0.00 (7.5%)</span></td>
                        <td><span id="span_total_0">0.00</span></td>
                    </tr>
                <?php
                } ?>
            </tbody>
        </table>
        <a href="#" class="btn btn-primary" id="add_another">Add Items</a>
    </div>
    <script>
        <?php
        if (count(unserialize($plan->items)) > 0) {
            for ($cc = 0; $cc <= count(unserialize($plan->items)); $cc++) { ?>
                calculation(<?php echo $cc; ?>);
        <?php }
        } ?>
    </script>
<?php
} else { ?>
    <div class="col-md-12 table-responsive">
        <table class="table table-hover">
            <input type="hidden" name="count" value="0" id="count">
            <thead>
                <tr>
                    <th>DESCRIPTION</th>
                    <th>Type</th>
                    <th width="100px">Quantity</th>
                    <th>LOCATION</th>
                    <th width="100px">COST</th>
                    <th width="100px">Discount</th>
                    <th>Tax(%)</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody id="table_body">
                <tr>
                    <td><input type="text" class="form-control getItems" onKeyup="getItems(this)" name="item[]">
                        <ul class="suggestions"></ul>
                    </td>
                    <td><select name="item_type[]" class="form-control">
                            <option value="product">Product</option>
                            <option value="material">Material</option>
                            <option value="service">Service</option>
                        </select></td>
                    <td><input type="text" class="form-control quantity" name="quantity[]" data-counter="0" id="quantity_0" value="1"></td>
                    <td><input type="text" class="form-control" name="location[]"></td>
                    <td><input type="number" class="form-control price" name="price[]" data-counter="0" id="price_0" min="0" value="0"></td>
                    <td><input type="number" class="form-control discount" name="discount[]" data-counter="0" id="discount_0" min="0" value="0" readonly></td>
                    <td><span id="span_tax_0">0.00 (7.5%)</span></td>
                    <td><span id="span_total_0">0.00</span></td>
                </tr>
            </tbody>
        </table>
        <a href="#" class="btn btn-primary" id="add_another">Add Items</a>
    </div>
    <script>
        calculation(0);
    </script>
<?php } ?>