const currUrl = window.location.href;
const urlSplit = currUrl.split('/');
const contractorId = urlSplit[urlSplit.length - 1].includes('?') ? urlSplit[urlSplit.length - 1].split('?')[0].replace('#', '') : urlSplit[urlSplit.length - 1].replace('#', '');
const contractorName = $('#contractor-display-name').text().trim();

$('#edit-contractor-modal [name="contractor_type"]').on('change', function() {
    if($('#edit-contractor-modal #email').length < 1) {
        var row = $(this).closest('.row');

        if($(this).val() === "1") {
            row.append(`<div class="col-12 col-md-3">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control nsm-field" value="${title}">
            </div>
            <div class="col-12 col-md-6">
                <label for="first_name">First <span class="text-danger">*</span></label>
                <input type="text" name="first_name" id="first_name" class="form-control nsm-field" value="${firstName}">
            </div>
            <div class="col-12 col-md-3">
                <label for="middle_name">Middle</label>
                <input type="text" name="middle_name" id="middle_name" class="form-control nsm-field" value="${middleName}">
            </div>
            <div class="col-12 col-md-6">
                <label for="last_name">Last <span class="text-danger">*</span></label>
                <input type="text" name="last_name" id="last_name" class="form-control nsm-field" value="${lastName}">
            </div>
            <div class="col-12 col-md-4">
                <label for="suffix">Suffix</label>
                <input type="text" name="suffix" id="suffix" class="form-control nsm-field" value="${suffix}">
            </div>
            <div class="col-12">
                <label for="display_name">Display name <span class="text-danger">*</span></label>
                <input type="text" name="display_name" id="display_name" class="form-control nsm-field" value="${contractorName}" required>
            </div>
            <div class="col-12">
                <label for="social_sec_num">Social Security number <span class="text-danger">*</span></label>
                <input type="text" name="social_sec_num" id="social_sec_num" class="form-control nsm-field" value="${socialSecNum}">
            </div>`);
        } else {
            row.append(`<div class="col-12">
                <label for="business_name">Business name <span class="text-danger">*</span></label>
                <input type="text" name="business_name" id="business_name" class="form-control nsm-field" value="">
            </div>
            <div class="col-12">
                <label for="display_name">Display name <span class="text-danger">*</span></label>
                <input type="text" name="display_name" id="display_name" class="form-control nsm-field" value="${contractorName}" required>
            </div>
            <div class="col-12">
                <label for="emp_id_num">Employer Identification Number <span class="text-danger">*</span></label>
                <input type="text" name="emp_id_num" id="emp_id_num" class="form-control nsm-field" value="${employerId}">
            </div>`);
        }

        row.append(`<div class="col-12">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control nsm-field" value="${email}" disabled>
        </div>
        <div class="col-12">
            <label for="address">Address <span class="text-danger">*</span></label>
            <textarea name="address" id="address" class="form-control nsm-field" required>${street}</textarea>
        </div>
        <div class="col-12 col-md-5">
            <label for="city">City <span class="text-danger">*</span></label>
            <input type="text" name="city" id="city" class="form-control nsm-field" required value="${city}">
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
            <input type="text" name="zip_code" id="zip_code" class="form-control nsm-field" required value="${zip}">
        </div>`);

        $('#edit-contractor-modal select').select2({
            minimumResultsForSearch: -1,
            dropdownParent: $('#edit-contractor-modal')
        })
    } else {
        var formData = new FormData($('#edit-contractor-modal form')[0]);
        var displayName = formData.get('display_name');

        if($(this).val() === "1") {
            var num = formData.get('emp_id_num');
            business_name = $('#business_name').val();

            $('#business_name, #display_name, #emp_id_num').parent().remove();

            $(`<div class="col-12 col-md-3">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control nsm-field" value="${title}">
            </div>
            <div class="col-12 col-md-6">
                <label for="first_name">First <span class="text-danger">*</span></label>
                <input type="text" name="first_name" id="first_name" class="form-control nsm-field" value="${firstName}">
            </div>
            <div class="col-12 col-md-3">
                <label for="middle_name">Middle</label>
                <input type="text" name="middle_name" id="middle_name" class="form-control nsm-field" value="${middleName}">
            </div>
            <div class="col-12 col-md-6">
                <label for="last_name">Last <span class="text-danger">*</span></label>
                <input type="text" name="last_name" id="last_name" class="form-control nsm-field" value="${lastName}">
            </div>
            <div class="col-12 col-md-4">
                <label for="suffix">Suffix</label>
                <input type="text" name="suffix" id="suffix" class="form-control nsm-field" value="${suffix}">
            </div>
            <div class="col-12">
                <label for="display_name">Display name <span class="text-danger">*</span></label>
                <input type="text" name="display_name" id="display_name" class="form-control nsm-field" value="${displayName}" required>
            </div>
            <div class="col-12">
                <label for="social_sec_num">Social Security number <span class="text-danger">*</span></label>
                <input type="text" name="social_sec_num" id="social_sec_num" class="form-control nsm-field" value="${num}">
            </div>`).insertAfter($(this).parent().parent());
        } else {
            var num = formData.get('social_sec_num');
            title = $('#title').val();
            firstName = $('#first_name').val();
            middleName = $('#middle_name').val();
            lastName = $('#last_name').val();
            suffix = $('#suffix').val();

            $('#title, #first_name, #middle_name, #last_name, #suffix, #display_name, #social_sec_num').parent().remove();

            $(`<div class="col-12">
                <label for="business_name">Business name <span class="text-danger">*</span></label>
                <input type="text" name="business_name" id="business_name" class="form-control nsm-field" value="${business_name}">
            </div>
            <div class="col-12">
                <label for="display_name">Display name <span class="text-danger">*</span></label>
                <input type="text" name="display_name" id="display_name" class="form-control nsm-field" value="${displayName}" required>
            </div>
            <div class="col-12">
                <label for="emp_id_num">Employer Identification Number <span class="text-danger">*</span></label>
                <input type="text" name="emp_id_num" id="emp_id_num" class="form-control nsm-field" value="${num}">
            </div>`).insertAfter($(this).parent().parent());
        }
    }
});

$('#edit-contractor-modal select').select2({
    minimumResultsForSearch: -1,
    dropdownParent: $('#edit-contractor-modal')
});

$('#write-check').on('click', function(e) {
    e.preventDefault();    

    $.get('/accounting/get-other-modals/check_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#checkModal #payee').append(`<option value="vendor-${contractorId}">${contractorName}</option>`).trigger('change');

        modalName = '#checkModal';
        initModalFields('checkModal');

        $('#checkModal').modal('show');
    });
});

$('#create-expense').on('click', function(e) {
    e.preventDefault();

    $.get('/accounting/get-other-modals/expense_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#expenseModal #payee').append(`<option value="vendor-${contractorId}">${contractorName}</option>`).trigger('change');

        modalName = '#expenseModal';
        initModalFields('expenseModal');

        $('#expenseModal').modal('show');
    });
});

$('#create-bill').on('click', function(e) {
    e.preventDefault();

    $.get('/accounting/get-other-modals/bill_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#billModal #vendor').append(`<option value="${contractorId}">${contractorName}</option>`).trigger('change');

        modalName = '#billModal';
        initModalFields('billModal');

        $('#billModal').modal('show');
    });
});

$('#date-dropdown li a.dropdown-item').on('click', function(e) {
    e.preventDefault();

    var date = $(this).text().trim().replaceAll(' ', '-').toLowerCase();
    var type = $('#type-dropdown li a.dropdown-item.active').text().trim().replaceAll(' ', '-').toLowerCase();
    var method = $('#method-dropdown li a.dropdown-item.active').text().trim().replaceAll(' ', '-').toLowerCase();
    var url = `${base_url}accounting/contractors/view/${contractorId}?`;

    url += date !== 'all' ? `date=${date}&` : '';
    url += type !== 'all' ? `type=${type}&` : '';
    url += method !== 'all' ? `method=${method}` : '';

    if(url.slice(-1) === '&') {
        url = url.slice(0, -1);
    }

    if(url.slice(-1) === '?') {
        url = url.slice(0, -1);
    }

    location.href = url;
});

$('#type-dropdown li a.dropdown-item').on('click', function(e) {
    e.preventDefault();

    var date = $('#date-dropdown li a.dropdown-item.active').text().trim().replaceAll(' ', '-').toLowerCase();
    var type = $(this).text().trim().replaceAll(' ', '-').toLowerCase();
    var method = $('#method-dropdown li a.dropdown-item.active').text().trim().replaceAll(' ', '-').toLowerCase();

    var url = `${base_url}accounting/contractors/view/${contractorId}?`;

    url += date !== 'all' ? `date=${date}&` : '';
    url += type !== 'all' ? `type=${type}&` : '';
    url += method !== 'all' ? `method=${method}` : '';

    if(url.slice(-1) === '&') {
        url = url.slice(0, -1);
    }

    if(url.slice(-1) === '?') {
        url = url.slice(0, -1);
    }

    location.href = url;
});

$('#method-dropdown li a.dropdown-item').on('click', function(e) {
    e.preventDefault();

    var date = $('#date-dropdown li a.dropdown-item.active').text().trim().replaceAll(' ', '-').toLowerCase();
    var type = $('#type-dropdown li a.dropdown-item.active').text().trim().replaceAll(' ', '-').toLowerCase();
    var method = $(this).text().trim().replaceAll(' ', '-').toLowerCase();

    var url = `${base_url}accounting/contractors/view/${contractorId}?`;

    url += date !== 'all' ? `date=${date}&` : '';
    url += type !== 'all' ? `type=${type}&` : '';
    url += method !== 'all' ? `method=${method}` : '';

    if(url.slice(-1) === '&') {
        url = url.slice(0, -1);
    }

    if(url.slice(-1) === '?') {
        url = url.slice(0, -1);
    }

    location.href = url;
});