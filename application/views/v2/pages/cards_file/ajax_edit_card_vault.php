<input type="hidden" value="<?= $cardFile->id; ?>" name="cid" id="cid">
<div class="row">                                                                
    <div class="col-md-12 mt-3">
        <label for="">Your Name (as it appears on your card)</label><br/>
        <input type="text" required="" value="<?= $cardFile->card_owner_first_name; ?>" placeholder="First Name" class="nsm-field form-control" name="card_owner_first_name" id="card_owner_first_name" required="" style="width: 49%;display:inline-block;">
        <input type="text" required="" value="<?= $cardFile->card_owner_last_name; ?>" placeholder="Last Name" class="nsm-field form-control" name="card_owner_last_name" id="card_owner_last_name" style="width: 49%;display:inline-block;" required="">
    </div>
    <div class="col-md-12 mt-3">
        <label for="">Card Number</label>
        <input type="text" required="" value="<?= $cardFile->card_number; ?>" class="nsm-field form-control" name="card_number" id="card_number" required="">
    </div>  
</div>
<div class="row mt-3">
    <div class="col-md-2">
        <div class="form-group" id="customer_type_group">
          <label for="">Expiration</label>
          <select name="expiration_month" class="form-control" required="">
            <option>- month -</option>
            <option value="01" <?= $cardFile->expiration_month == 1 ? 'selected="selected"' : ''; ?>>01 - Jan</option>
            <option value="02" <?= $cardFile->expiration_month == 2 ? 'selected="selected"' : ''; ?>>02 - Feb</option>
            <option value="03" <?= $cardFile->expiration_month == 3 ? 'selected="selected"' : ''; ?>>03 - Mar</option>
            <option value="04" <?= $cardFile->expiration_month == 4 ? 'selected="selected"' : ''; ?>>04 - Apr</option>
            <option value="05" <?= $cardFile->expiration_month == 5 ? 'selected="selected"' : ''; ?>>05 - May</option>
            <option value="06" <?= $cardFile->expiration_month == 6 ? 'selected="selected"' : ''; ?>>06 - Jun</option>
            <option value="07" <?= $cardFile->expiration_month == 7 ? 'selected="selected"' : ''; ?>>07 - Jul</option>
            <option value="08" <?= $cardFile->expiration_month == 8 ? 'selected="selected"' : ''; ?>>08 - Aug</option>
            <option value="09" <?= $cardFile->expiration_month == 9 ? 'selected="selected"' : ''; ?>>09 - Sep</option>
            <option value="10" <?= $cardFile->expiration_month == 10 ? 'selected="selected"' : ''; ?>>10 - Oct</option>
            <option value="11" <?= $cardFile->expiration_month == 11 ? 'selected="selected"' : ''; ?>>11 - Nov</option>
            <option value="12" <?= $cardFile->expiration_month == 12 ? 'selected="selected"' : ''; ?>>12  -Dec</option>
          </select>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group" id="customer_type_group">
          <label for=""><br /></label>
          <select name="expiration_year" class="nsm-field form-control" required="">
            <option>- year-</option>
            <?php for($x = date("Y"); $x <= date("Y",strtotime("+10 years")); $x++){ ?>
              <option <?= $cardFile->expiration_year == $x ? 'selected="selected"' : ''; ?> value="<?= $x; ?>"><?= $x; ?></option>  
            <?php } ?>
          </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group" id="customer_type_group">
          <label for="">Card CVV</label>
          <input type="text" required="" value="<?= $cardFile->card_cvv; ?>" class="nsm-field form-control" name="card_cvv" id="card_cvv" required="">
        </div>
    </div>

    <div class="col-md-5">
        <a href="#" id="edit-help-popover-cvc" style="margin-top: 29px;display: block;color:#259e57;width: 100%;"> Where is CVV</a>
        <div class="hide" id="edit-help-popover-cvc-content" style="display: none;margin-bottom: 20px;">
          <span class="help"> Please insert your card security number/CVV number. For all cards, except American Express, this is the <b>last 3 digits on the back of your card</b>. For American Express, this is the <b>4 digits printed on the front of your card</b>, above the 15 digit card number.</span><br> <img src="<?= base_url("assets/img/cvv.png"); ?>">
        </div>
    </div>
</div> 
<script>
$(function(){
    $('#edit-help-popover-cvc').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return $('#help-popover-cvc-content').html();
        } 
    });  
});
</script>