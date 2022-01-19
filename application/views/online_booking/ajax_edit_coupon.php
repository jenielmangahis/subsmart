<?php echo form_input(array('name' => 'cid', 'type' => 'hidden', 'value' => $coupon->id, 'id' => 'cid'));?>
<div class="form-group">
  <label>Coupon Name</label> <span class="form-required">*</span>
  <input type="text" name="name" value="<?php echo $coupon->coupon_name; ?>"  class="form-control" required="" autocomplete="off" />
</div>
<div class="form-group">
  <label>Code</label> <span class="form-required">*</span> &nbsp; <span class="help help-sm">(a unique code, can contain only letters, numbers and - _ .)</span>
  <input type="text" name="code" value="<?php echo $coupon->coupon_code; ?>"  class="form-control" required="" autocomplete="off" />
</div>
<div class="form-group">
  <label>Discount from Total</label> <span class="form-required">*</span>
  <div class="row">
      <div class="col-6">
          <select name="discount_type" class="form-control edit-coupon-discount-type" required="">
            <option <?php echo( $coupon->discount_from_total_type == 1 ? 'selected="selected"' : '' ); ?> value="1">Percentage %</option>
            <option <?php echo( $coupon->discount_from_total_type == 2 ? 'selected="selected"' : '' ); ?> value="2">Amount $</option>
          </select>
      </div>
      <div class="col-6">
        <div id="edit_discount_percent_cnt" class="<?php echo( $coupon->discount_from_total_type == 1 ? 'hide' : '' ); ?>">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">%</span>
              </div>
              <input type="number" name="discount_percent" value="<?php echo $coupon->discount_from_total; ?>" class="form-control" />
            </div>
        </div>
        <div id="edit_discount_amount_cnt" class="<?php echo( $coupon->discount_from_total_type == 2 ? 'hide' : '' ); ?>">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">$</span>
              </div>
              <input type="number" name="discount_amount" value="<?php echo $coupon->discount_from_total; ?>" class="form-control" autocomplete="off" />
            </div>
        </div>
      </div>
  </div>
</div>
<div class="row">
<div class="col-5">
  <div class="form-group">
    <label>Valid From</label>
    <div class="input-group">
        <input type="text" name="valid_from" value="<?php echo date("m/d/Y", strtotime($coupon->date_valid_from)); ?>"  class="form-control coupon_valid_from" required="" id="edit_coupon_valid_from" autocomplete="off" />
        <div class="input-group-addon calendar-button" data-for="coupon_valid_from">
            <span class="fa fa-calendar"></span>
        </div>
    </div>
  </div>
</div>
<div class="col-5">
  <div class="form-group">
    <label>Valid To</label>
    <div class="input-group">
        <input type="text" name="valid_to" value="<?php echo date("m/d/Y", strtotime($coupon->date_valid_to)); ?>"  class="form-control coupon_valid_to" required="" id="edit_coupon_valid_to" autocomplete="off" />
        <div class="input-group-addon calendar-button" data-for="coupon_valid_to">
            <span class="fa fa-calendar"></span>
        </div>
    </div>
  </div>
</div>
</div>
<div class="form-group">
<label>Uses per coupon</label>
<input type="number" name="uses_max" value="<?php echo $coupon->used_per_coupon; ?>" required="" class="form-control" autocomplete="off" />
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
<script>
$(function(){
    $("#edit_coupon_valid_from").datepicker();
    $("#edit_coupon_valid_to").datepicker();

    $(".edit-coupon-discount-type").change(function(){
        var type = $(this).val();
        if( type == 1 ){
            $("#edit_discount_percent_cnt").removeClass("hide");
            $("#edit_discount_amount_cnt").addClass("hide");
        }else{
            $("#edit_discount_percent_cnt").addClass("hide");
            $("#edit_discount_amount_cnt").removeClass("hide");
        }
    });
});

</script>