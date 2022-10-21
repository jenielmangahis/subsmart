$('#edit-contractor-modal [name="contractor_type"]').on('change', function() {
    if($('#edit-contractor-modal #email').length < 1) {
        var row = $(this).closest('.row');

        if($(this).val() === "1") {
            row.append(`<div class="col-12 col-md-3">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control nsm-field" value="">
            </div>
            <div class="col-12 col-md-6">
                <label for="first_name">First <span class="text-danger">*</span></label>
                <input type="text" name="first_name" id="first_name" class="form-control nsm-field" value="">
            </div>
            <div class="col-12 col-md-3">
                <label for="middle_name">Middle</label>
                <input type="text" name="middle_name" id="middle_name" class="form-control nsm-field" value="">
            </div>
            <div class="col-12 col-md-6">
                <label for="last_name">Last <span class="text-danger">*</span></label>
                <input type="text" name="last_name" id="last_name" class="form-control nsm-field" value="">
            </div>
            <div class="col-12 col-md-4">
                <label for="suffix">Suffix</label>
                <input type="text" name="suffix" id="suffix" class="form-control nsm-field" value="">
            </div>
            <div class="col-12">
                <label for="social_sec_num">Social Security number <span class="text-danger">*</span></label>
                <input type="text" name="social_sec_num" id="social_sec_num" class="form-control nsm-field" value="">
            </div>`);
        } else {
            row.append(`<div class="col-12">
                <label for="business_name">Business name <span class="text-danger">*</span></label>
                <input type="text" name="business_name" id="business_name" class="form-control nsm-field" value="">
            </div>
            <div class="col-12">
                <label for="emp_id_num">Employer Identification Number <span class="text-danger">*</span></label>
                <input type="text" name="emp_id_num" id="emp_id_num" class="form-control nsm-field" value="">
            </div>`);
        }

        row.append(`<div class="col-12">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control nsm-field" value="">
        </div>
        <div class="col-12">
            <label for="address">Address <span class="text-danger">*</span></label>
            <textarea name="address" id="address" class="form-control nsm-field" required></textarea>
        </div>
        <div class="col-12 col-md-5">
            <label for="city">City <span class="text-danger">*</span></label>
            <input type="text" name="city" id="city" class="form-control nsm-field" required value="">
        </div>
        <div class="col-12 col-md-2">
            <label for="state">State <span class="text-danger">*</span></label>
            <select name="state" id="state" class="form-select nsm-field" required>
                <option value="AK">AK</option>
                <option value="AL">AL</option>
                <option value="AR">AR</option>
                <option value="AZ">AZ</option>
                <option value="CA">CA</option>
                <option value="CO">CO</option>
                <option value="CT">CT</option>
                <option value="DC">DC</option>
                <option value="DE">DE</option>
                <option value="FL">FL</option>
                <option value="GA">GA</option>
                <option value="HI">HI</option>
                <option value="IA">IA</option>
                <option value="ID">ID</option>
                <option value="IL">IL</option>
                <option value="IN">IN</option>
                <option value="KS">KS</option>
                <option value="KY">KY</option>
                <option value="LA">LA</option>
                <option value="MA">MA</option>
                <option value="MD">MD</option>
                <option value="ME">ME</option>
                <option value="MI">MI</option>
                <option value="MN">MN</option>
                <option value="MO">MO</option>
                <option value="MS">MS</option>
                <option value="MT">MT</option>
                <option value="NC">NC</option>
                <option value="ND">ND</option>
                <option value="NE">NE</option>
                <option value="NH">NH</option>
                <option value="NJ">NJ</option>
                <option value="NM">NM</option>
                <option value="NV">NV</option>
                <option value="NY">NY</option>
                <option value="OH">OH</option>
                <option value="OK">OK</option>
                <option value="OR">OR</option>
                <option value="PA">PA</option>
                <option value="RI">RI</option>
                <option value="SC">SC</option>
                <option value="SD">SD</option>
                <option value="TN">TN</option>
                <option value="TX">TX</option>
                <option value="UT">UT</option>
                <option value="VA">VA</option>
                <option value="VT">VT</option>
                <option value="WA">WA</option>
                <option value="WI">WI</option>
                <option value="WV">WV</option>
                <option value="WY">WY</option>
            </select>
        </div>
        <div class="col-12 col-md-5">
            <label for="zip_code">ZIP code <span class="text-danger">*</span></label>
            <input type="text" name="zip_code" id="zip_code" class="form-control nsm-field" required value="">
        </div>`);

        $('#edit-contractor-modal select').select2({
            minimumResultsForSearch: -1,
            dropdownParent: $('#edit-contractor-modal')
        })
    } else {
        if($(this).val() === "1") {
            $('#business_name, #emp_id_num').parent().remove();

            $(`<div class="col-12 col-md-3">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control nsm-field" value="">
            </div>
            <div class="col-12 col-md-6">
                <label for="first_name">First <span class="text-danger">*</span></label>
                <input type="text" name="first_name" id="first_name" class="form-control nsm-field" value="">
            </div>
            <div class="col-12 col-md-3">
                <label for="middle_name">Middle</label>
                <input type="text" name="middle_name" id="middle_name" class="form-control nsm-field" value="">
            </div>
            <div class="col-12 col-md-6">
                <label for="last_name">Last <span class="text-danger">*</span></label>
                <input type="text" name="last_name" id="last_name" class="form-control nsm-field" value="">
            </div>
            <div class="col-12 col-md-4">
                <label for="suffix">Suffix</label>
                <input type="text" name="suffix" id="suffix" class="form-control nsm-field" value="">
            </div>
            <div class="col-12">
                <label for="social_sec_num">Social Security number <span class="text-danger">*</span></label>
                <input type="text" name="social_sec_num" id="social_sec_num" class="form-control nsm-field" value="">
            </div>`).insertAfter($(this).parent().parent());
        } else {
            $('#title, #first_name, #middle_name, #last_name, #suffix, #social_sec_num').parent().remove();

            $(`<div class="col-12">
                <label for="business_name">Business name <span class="text-danger">*</span></label>
                <input type="text" name="business_name" id="business_name" class="form-control nsm-field" value="">
            </div>
            <div class="col-12">
                <label for="emp_id_num">Employer Identification Number <span class="text-danger">*</span></label>
                <input type="text" name="emp_id_num" id="emp_id_num" class="form-control nsm-field" value="">
            </div>`).insertAfter($(this).parent().parent());
        }
    }
});

$('#edit-contractor-modal select').select2({
    minimumResultsForSearch: -1,
    dropdownParent: $('#edit-contractor-modal')
})