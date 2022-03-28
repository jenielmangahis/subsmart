<div class="row mb-3">
    <div class="col-12 col-md-4 d-flex align-items-center">
        <label class="content-title">Card Number</label>
    </div>
    <div class="col-12 col-md-8">
        <input type="text" name="card_number" class="nsm-field form-control" required value="<?= $billing->credit_card_num; ?>" />
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-4 d-flex align-items-center">
        <label class="content-title">Expiration</label>
    </div>
    <div class="col-12 col-md-8">
        <div class="row">
            <div class="col-4">
                <select class="nsm-field form-select" name="exp_month" id="exp_month" required>
                    <option value="disabled"></option>
                    <option value="01" <?= $cc_date_year[0] == "01" ? 'selected="selected"' : ''; ?>>01</option>
                    <option value="02" <?= $cc_date_year[0] == "02" ? 'selected="selected"' : ''; ?>>02</option>
                    <option value="03" <?= $cc_date_year[0] == "03" ? 'selected="selected"' : ''; ?>>03</option>
                    <option value="04" <?= $cc_date_year[0] == "04" ? 'selected="selected"' : ''; ?>>04</option>
                    <option value="05" <?= $cc_date_year[0] == "05" ? 'selected="selected"' : ''; ?>>05</option>
                    <option value="06" <?= $cc_date_year[0] == "06" ? 'selected="selected"' : ''; ?>>06</option>
                    <option value="07" <?= $cc_date_year[0] == "07" ? 'selected="selected"' : ''; ?>>07</option>
                    <option value="08" <?= $cc_date_year[0] == "08" ? 'selected="selected"' : ''; ?>>08</option>
                    <option value="09" <?= $cc_date_year[0] == "09" ? 'selected="selected"' : ''; ?>>09</option>
                    <option value="10" <?= $cc_date_year[0] == "10" ? 'selected="selected"' : ''; ?>>10</option>
                    <option value="11" <?= $cc_date_year[0] == "11" ? 'selected="selected"' : ''; ?>>11</option>
                    <option value="12" <?= $cc_date_year[0] == "12" ? 'selected="selected"' : ''; ?>>12</option>
                </select>
            </div>
            <div class="col-4">
                <select class="nsm-field form-select" name="exp_year" id="exp_year" required>
                    <option value="disabled"></option>
                    <option value="2021" <?= $cc_date_year[1] == "2021" ? 'selected="selected"' : ''; ?>>2021</option>
                    <option value="2022" <?= $cc_date_year[1] == "2022" ? 'selected="selected"' : ''; ?>>2022</option>
                    <option value="2023" <?= $cc_date_year[1] == "2023" ? 'selected="selected"' : ''; ?>>2023</option>
                    <option value="2024" <?= $cc_date_year[1] == "2024" ? 'selected="selected"' : ''; ?>>2024</option>
                    <option value="2025" <?= $cc_date_year[1] == "2025" ? 'selected="selected"' : ''; ?>>2025</option>
                    <option value="2026" <?= $cc_date_year[1] == "2026" ? 'selected="selected"' : ''; ?>>2026</option>
                    <option value="2027" <?= $cc_date_year[1] == "2027" ? 'selected="selected"' : ''; ?>>2027</option>
                    <option value="2028" <?= $cc_date_year[1] == "2028" ? 'selected="selected"' : ''; ?>>2028</option>
                    <option value="2029" <?= $cc_date_year[1] == "2029" ? 'selected="selected"' : ''; ?>>2029</option>
                    <option value="2030" <?= $cc_date_year[1] == "2030" ? 'selected="selected"' : ''; ?>>2030</option>
                    <option value="2031" <?= $cc_date_year[1] == "2031" ? 'selected="selected"' : ''; ?>>2031</option>
                </select>
            </div>
            <div class="col-4">
                <input type="text" name="cvc" id="cvc" placeholder="CVC" class="nsm-field form-control" value="<?= $billing->credit_card_exp_mm_yyyy; ?>" required maxlength="3" />
            </div>
        </div>
    </div>
</div>