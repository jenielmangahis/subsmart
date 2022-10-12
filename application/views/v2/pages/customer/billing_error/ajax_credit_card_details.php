<style>
.input-group-prepend {
    height: 48px !important;
}
.form_line{
    margin-bottom: 10px;
}
.hide {
    display:none;
}
.plan{
    padding: 0px;
}
.card-type.visa {
    background-position: 0 0;
}
.card-type {
    display: inline-block;
    width: 30px;
    height: 20px;
    background: url(<?= base_url("/assets/img/credit_cards.png"); ?>) no-repeat 0 0;
    background-size: cover;
    vertical-align: middle;
    margin-right: 10px;
}
.card-type.americanexpress {
    background-position: -83px 0;
}
.expired-text{
    color: #fff;
    background-color: #dc3545;
    font-size: 12px;
}
</style>
<div id="credit_card">
    <div class="row form_line">
        <div class="col-md-4">
            Card Number
        </div>
        <div class="col-md-8">
            <input type="text" class="form-control" name="card_number" id="" value="<?= $billing->credit_card_num; ?>" required/>
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-4">
            <label for="">Expiration 
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-4">
                    <select id="exp_month" name="exp_month" class="input_select exp_month" required>
                        <option  value=""></option>
                        <option  value="01" <?= $cc_date_year[0] == "01" ? 'selected="selected"' : ''; ?>>01</option>
                        <option  value="02" <?= $cc_date_year[0] == "02" ? 'selected="selected"' : ''; ?>>02</option>
                        <option  value="03" <?= $cc_date_year[0] == "03" ? 'selected="selected"' : ''; ?>>03</option>
                        <option  value="04" <?= $cc_date_year[0] == "04" ? 'selected="selected"' : ''; ?>>04</option>
                        <option  value="05" <?= $cc_date_year[0] == "05" ? 'selected="selected"' : ''; ?>>05</option>
                        <option  value="06" <?= $cc_date_year[0] == "06" ? 'selected="selected"' : ''; ?>>06</option>
                        <option  value="07" <?= $cc_date_year[0] == "07" ? 'selected="selected"' : ''; ?>>07</option>
                        <option  value="08" <?= $cc_date_year[0] == "08" ? 'selected="selected"' : ''; ?>>08</option>
                        <option  value="09" <?= $cc_date_year[0] == "09" ? 'selected="selected"' : ''; ?>>09</option>
                        <option  value="10" <?= $cc_date_year[0] == "10" ? 'selected="selected"' : ''; ?>>10</option>
                        <option  value="11" <?= $cc_date_year[0] == "11" ? 'selected="selected"' : ''; ?>>11</option>
                        <option  value="12" <?= $cc_date_year[0] == "12" ? 'selected="selected"' : ''; ?>>12</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select id="exp_year" name="exp_year" class="input_select exp_year" required>
                        <option  value=""></option>
                        <option  value="2021" <?= $cc_date_year[1] == "2021" ? 'selected="selected"' : ''; ?>>2021</option>
                        <option  value="2022" <?= $cc_date_year[1] == "2022" ? 'selected="selected"' : ''; ?>>2022</option>
                        <option  value="2023" <?= $cc_date_year[1] == "2023" ? 'selected="selected"' : ''; ?>>2023</option>
                        <option  value="2024" <?= $cc_date_year[1] == "2024" ? 'selected="selected"' : ''; ?>>2024</option>
                        <option  value="2025" <?= $cc_date_year[1] == "2025" ? 'selected="selected"' : ''; ?>>2025</option>
                        <option  value="2026" <?= $cc_date_year[1] == "2026" ? 'selected="selected"' : ''; ?>>2026</option>
                        <option  value="2027" <?= $cc_date_year[1] == "2027" ? 'selected="selected"' : ''; ?>>2027</option>
                        <option  value="2028" <?= $cc_date_year[1] == "2028" ? 'selected="selected"' : ''; ?>>2028</option>
                        <option  value="2029" <?= $cc_date_year[1] == "2029" ? 'selected="selected"' : ''; ?>>2029</option>
                        <option  value="2030" <?= $cc_date_year[1] == "2030" ? 'selected="selected"' : ''; ?>>2030</option>
                        <option  value="2031" <?= $cc_date_year[1] == "2031" ? 'selected="selected"' : ''; ?>>2031</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" maxlength="3" class="form-control" name="cvc" id="cvc" value="<?= $billing->credit_card_exp_mm_yyyy; ?>" placeholder="CVC" required/>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    $(".exp_month").select2({
        placeholder: "Select Month"
    });
    $(".subscription_plans").select2({
        placeholder: "Select Plan"
    });
    $(".exp_year").select2({
        placeholder: "Select Year"
    });
});
</script>