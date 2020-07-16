<div class="form-group">
    <label>Coupon Name</label> <span class="form-required">*</span>
    <input type="text" name="name" value="<?php echo $coupon->coupon_name; ?>" class="form-control" autocomplete="off" />
</div>
<div class="form-group">
    <label>Code</label> <span class="form-required">*</span> &nbsp; <span class="help help-sm">(a unique code, can contain only letters, numbers and - _ .)</span>
    <input type="text" name="code" value="<?php echo $coupon->coupon_code; ?>" class="form-control" autocomplete="off" />
</div>
<div class="form-group">
    <label>Discount from Total</label> <span class="form-required">*</span>
    <div class="row">
        <div class="col-sm-8">
            <select name="discount_type" class="form-control coupon-discount-type">
              <option <?php echo( $coupon->discount_from_total_type == 1 ? 'selected="selected"' : '' ); ?> value="1">Percentage %</option>
              <option <?php echo( $coupon->discount_from_total_type == 2 ? 'selected="selected"' : '' ); ?> value="2">Amount $</option>
            </select>
        </div>
        <div id="discount_percent_cnt" class="<?php echo( $coupon->discount_from_total_type == 1 ? 'hide' : '' ); ?>">
            <div class="">
                <div class="input-group">
                    <div class="input-group-addon bold">%</div>
                    <input type="text" name="discount_percent" value="<?php echo $coupon->discount_from_total; ?>" class="form-control" autocomplete="off" />
                </div>
            </div>
        </div>
        <div id="discount_amount_cnt" class="<?php echo( $coupon->discount_from_total_type == 2 ? 'hide' : '' ); ?>">
            <div class="">
                <div class="input-group">
                    <div class="input-group-addon bold">$</div>
                    <input type="text" name="discount_amount" value="<?php echo $coupon->discount_from_total; ?>" class="form-control" autocomplete="off" />
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-sm-8">
            <label>Valid From</label>
            <div class="input-group">
                <input type="text" name="valid_from" value="<?php echo $coupon->date_valid_from; ?>" class="form-control coupon_valid_from" id="coupon_valid_from" autocomplete="off" />
                <div class="input-group-addon calendar-button" data-for="coupon_valid_from">
                    <span class="fa fa-calendar"></span>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <label>Valid To</label>
            <div class="input-group">
                <input type="text" name="valid_to" value="<?php echo $coupon->date_valid_to; ?>" class="form-control coupon_valid_to" id="coupon_valid_to" autocomplete="off" />
                <div class="input-group-addon calendar-button" data-for="coupon_valid_to">
                    <span class="fa fa-calendar"></span>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <label>Uses per coupon</label>
            <input type="text" name="uses_max" value="<?php echo $coupon->used_per_coupon; ?>" class="form-control" autocomplete="off" />
        </div>
    </div>
</div>
<div class="row margin-bottom-sec">
    <div class="col-sm-8">
        <label>Status</label>
        <select name="status" class="form-control" autocomplete="off">
          <option <?php echo( $coupon->status == 1 ? 'selected="selected"' : '' ); ?> value="1">Active</option>
          <option <?php echo( $coupon->status == 0 ? 'selected="selected"' : '' ); ?> value="0">Closed</option>
        </select>
    </div>
</div>  