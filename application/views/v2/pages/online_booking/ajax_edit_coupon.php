<input type="hidden" name="cid" id="cid" value="<?= $coupon->id; ?>" />
<div class="row">
  <div class="col-6">
    <label>Coupon Name</label> <span class="form-required">*</span>
    <input type="text" name="name" value="<?= $coupon->coupon_name; ?>"  class="form-control" required="" autocomplete="off" />
  </div>
  <div class="col-6">
    <label>Coupon Code</label> <span class="form-required">*</span>
    <input type="text" name="code" id="edit-coupon-code" value="<?= $coupon->coupon_code; ?>"  class="form-control" required="" autocomplete="off" />
  </div>
  <div class="col-6 mt-2">
    <label>Discount Type</label> <span class="form-required">*</span>
    <select name="discount_type" class="form-control coupon-discount-type" required="">
      <option value="1" <?= $coupon->discount_from_total_type == 1 ? 'selected="selected"' : ''; ?>>Percentage %</option>
      <option value="2" <?= $coupon->discount_from_total_type == 2 ? 'selected="selected"' : ''; ?>>Amount $</option>
    </select>
  </div>
  <div class="col-6 mt-2">
    <label>Discount Amount <span class="form-required">*</span>
    <div id="discount_percent_cnt" style="<?= $coupon->discount_from_total_type == 2 ? 'display:none;' : ''; ?>">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">%</span>
          </div>
          <input type="number" step="any" name="discount_percent" value="<?= $coupon->discount_from_total; ?>" class="form-control" />
        </div>
    </div>
    <div id="discount_amount_cnt" style="<?= $coupon->discount_from_total_type == 1 ? 'display:none;' : ''; ?>">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">$</span>
          </div>
          <input type="number" step="any" name="discount_amount" value="<?= $coupon->discount_from_total; ?>" class="form-control" autocomplete="off" />
        </div>
    </div>
  </div>
  <div class="col-6 mt-2">
    <label>Valid From</label>
    <input type="date" name="valid_from" value="<?= date("Y-m-d", strtotime($coupon->date_valid_from)); ?>" class="form-control coupon_valid_from" required="" id="" autocomplete="off" />
  </div>
  <div class="col-6 mt-2">
    <label>Valid To</label>
    <input type="date" name="valid_to" value="<?= date("Y-m-d", strtotime($coupon->date_valid_to)); ?>" class="form-control coupon_valid_to" required="" id="" autocomplete="off" />
  </div>
  <div class="col-6 mt-2">
    <label>Max usage</label>
    <input type="number" name="uses_max" value="<?= $coupon->used_per_coupon; ?>" required="" class="form-control" autocomplete="off" />
  </div>
  <div class="col-6 mt-2">
    <label>Status</label>
    <select name="status" class="form-control" autocomplete="off">
      <option <?= $coupon->status == 1 ? 'selected="selected"' : ''; ?> value="1">Active</option>
      <option <?= $coupon->status == 0? 'selected="selected"' : ''; ?> value="0">Closed</option>
    </select>
  </div>
</div>

<script>
$(function(){
    $('#edit-coupon-code').keyup(editOnlyAllowAlphanumeric);

    function editOnlyAllowAlphanumeric() {
        this.value = this.value.replace(/[^a-zA-Z0-9 _]/g, '');
    }
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