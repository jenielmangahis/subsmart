$("#rulesTable").nsmPagination({
    itemsPerPage: 10
});

$("#search_field").on("input", debounce(function() {
  let _form = $(this).closest("form");

  _form.submit();
}, 1500));

$('#createRules select').each(function() {
    switch($(this).attr('id')) {
        case 'for-accounts' :
            $(this).select2({
                placeholder: 'Select account',
				allowClear: true,
                ajax: {
                    url: base_url + 'accounting/get-dropdown-choices',
                    dataType: 'json',
                    data: function(params) {
                        var query = {
                            search: params.term,
                            type: 'public',
                            field: 'bank-account',
                            modal: 'create-rules'
                        }

                        // Query parameters will be ?search=[term]&type=public&field=[type]
                        return query;
                    }
                },
                templateResult: formatResult,
                templateSelection: optionSelect,
                dropdownParent: $('#createRules')
            });
        break;
        case 'assign-to-tags' :
            $(this).select2({
                placeholder: 'Start typing to add a tag',
				dropdownParent: $('#createRules'),
				allowClear: true,
				ajax: {
					url: base_url + 'accounting/get-job-tags',
					dataType: 'json'
				}
            });
        break;
        case 'assign-to-category' :
            $(this).select2({
                placeholder: 'Select a category',
                ajax: {
                    url: base_url + 'accounting/get-dropdown-choices',
                    dataType: 'json',
                    data: function(params) {
                        var query = {
                            search: params.term,
                            type: 'public',
                            field: 'account',
                            modal: 'create-rules'
                        }
            
                        // Query parameters will be ?search=[term]&type=public&field=[type]
                        return query;
                    }
                },
                templateResult: formatResult,
                templateSelection: optionSelect,
                dropdownParent: $('#createRules')
            });
        break;
        case 'assign-to-payee' :
            $(this).select2({
                placeholder: '(Recommended)',
                ajax: {
                    url: base_url + 'accounting/get-dropdown-choices',
                    dataType: 'json',
                    data: function(params) {
                        var query = {
                            search: params.term,
                            type: 'public',
                            field: 'payee',
                            modal: 'create-rules'
                        }
            
                        // Query parameters will be ?search=[term]&type=public&field=[type]
                        return query;
                    }
                },
                templateResult: formatResult,
                templateSelection: optionSelect,
                dropdownParent: $('#createRules')
            });
        break;
        case 'assign-to-customer' :
            $(this).select2({
                ajax: {
                    url: base_url + 'accounting/get-dropdown-choices',
                    dataType: 'json',
                    data: function(params) {
                        var query = {
                            search: params.term,
                            type: 'public',
                            field: 'customer',
                            modal: 'create-rules'
                        }
    
                        // Query parameters will be ?search=[term]&type=public&field=[type]
                        return query;
                    }
                },
                templateResult: formatResult,
                templateSelection: optionSelect,
                dropdownParent: $('#createRules')
            });
        break;
        default :
            $(this).select2({
                minimumResultsForSearch: -1,
                dropdownParent: $('#createRules')
            });
        break;
    }
});

$('#assign-to-payee').on('change', function() {
    var assign_to_payee_value = $('#assign-to-payee').val();
    var form = 'payee';
    var modalTitle = 'New Name';

    if(assign_to_payee_value == 'add-new') {
        $("#payee-modal").modal('show');

        $.get(base_url + `accounting/get-dropdown-modal/payee_modal?type=payee`, function (result) {
            if (form !== 'item') {
                $('#modal-container').append(result);
            } else {
                $('#modal-container').append(`<div class="full-screen-modal">${result}</div>`)
            }

            switch (form) {
                case 'account':
                    initAccountModal();
                    break;
                case 'item_category':
                    $('#modal-container #item-category-modal').modal('show');
                    break;
                default:
                    if (form !== 'item' && form !== 'payee' && form !== 'item_location') {
                        $(`#modal-container #${form.replaceAll('_', '-')}-modal form`).attr('id', `ajax-add-${form.replaceAll('_', '-')}`);
                        $(`#modal-container #${form.replaceAll('_', '-')}-modal form`).removeAttr('action');
                        $(`#modal-container #${form.replaceAll('_', '-')}-modal form`).removeAttr('method');
                    }

                    if (form === 'payee' && modalTitle !== '') {
                        $('#modal-container #payee-modal .modal-title').html(modalTitle);
                        $('#modal-container #payee-modal #payee_type').select2({
                            minimumResultsForSearch: -1,
                            dropdownParent: $('#modal-container #payee-modal')
                        });

                        $('#modal-container #payee-modal #customer-type').select2({
                            minimumResultsForSearch: -1,
                            dropdownParent: $('#modal-container #payee-modal')
                        });
                    }

                    $(`#modal-container #${form.replaceAll('_', '-')}-modal`).attr('data-bs-backdrop', 'static');
                    $(`#modal-container #${form.replaceAll('_', '-')}-modal`).attr('data-bs-keyboard', 'false');

                    $(`#modal-container #${form.replaceAll('_', '-')}-modal`).modal('show');
                    break;
            }
        });        
    }
});

$('#assign-to-customer').on('change', function() {
    var assign_to_payee_value = $('#assign-to-customer').val();
    var form = 'payee';
    var modalTitle = 'New Customer';

    if(assign_to_payee_value == 'add-new') {
        $("#payee-modal-customer").modal('show');

        $.get(base_url + `accounting/get-dropdown-modal/payee_modal?type=customer`, function (result) {
            if (form !== 'item') {
                $('#modal-container').append(result);
            } else {
                $('#modal-container').append(`<div class="full-screen-modal">${result}</div>`)
            }

            switch (form) {
                case 'account':
                    initAccountModal();
                    break;
                case 'item_category':
                    $('#modal-container #item-category-modal').modal('show');
                    break;
                default:
                    if (form !== 'item' && form !== 'payee' && form !== 'item_location') {
                        $(`#modal-container #${form.replaceAll('_', '-')}-modal form`).attr('id', `ajax-add-${form.replaceAll('_', '-')}`);
                        $(`#modal-container #${form.replaceAll('_', '-')}-modal form`).removeAttr('action');
                        $(`#modal-container #${form.replaceAll('_', '-')}-modal form`).removeAttr('method');
                    }

                    if (form === 'payee' && modalTitle !== '') {
                        $('#modal-container #payee-modal-customer .modal-title').html(modalTitle);
                        $('#modal-container #payee-modal-customer #payee_type').select2({
                            minimumResultsForSearch: -1,
                            dropdownParent: $('#modal-container #payee-modal-customer')
                        });

                        $('#modal-container #payee-modal-customer #customer-type').select2({
                            minimumResultsForSearch: -1,
                            dropdownParent: $('#modal-container #payee-modal-customer')
                        });
                    }

                    $(`#modal-container #${form.replaceAll('_', '-')}-modal`).attr('data-bs-backdrop', 'static');
                    $(`#modal-container #${form.replaceAll('_', '-')}-modal`).attr('data-bs-keyboard', 'false');

                    $(`#modal-container #${form.replaceAll('_', '-')}-modal`).modal('show');
                    break;
            }
        });        
    }
});

$(document).on('submit', '#new-payee-form', function (e) {
    e.preventDefault();

    var data = new FormData(this);
    var hasPayeeType = data.has('payee_type');
    if (!data.has('payee_type')) {
        var type = dropdownEl.attr('id') === 'person_tracking' ? 'vendor' : dropdownEl.attr('id');

        if (type === undefined) {
            type = dropdownEl.attr('name').includes('customer') ? 'customer' : type;
            type = dropdownEl.attr('name').includes('vendor') ? 'vendor' : type;
        }

        data.append('payee_type', type);
    }

    $.ajax({
        url: base_url + 'accounting/add-new-payee',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function (result) {
            var res = JSON.parse(result);

            if (data.get('payee_type') === 'vendor') {
                var name = res.payee.display_name;
            } else {
                var name = res.payee.first_name + ' ' + res.payee.last_name;
            }

            if (dropdownEl === null && $("#accountingRulesPageWrapper")) {
                // for accounting rules page
                $("[data-type='assignments.payee']").append(`<option value="${data.get('payee_type') + '-' + res.payee.id}" selected>${name}</option>`);
                $("#assign-to-payee").append(`<option value="${data.get('payee_type') + '-' + res.payee.id}" selected>${name}</option>`);   
            }

            if (dropdownEl !== null) {
                if (hasPayeeType) {
                    dropdownEl.append(`<option value="${data.get('payee_type') + '-' + res.payee.id}" selected>${name}</option>`).trigger('change');
                } else {
                    dropdownEl.append(`<option value="${res.payee.id}" selected>${name}</option>`).trigger('change');
                }
            }

            $("#payee-modal").modal('hide');
            $("#payee-modal-customer").modal('hide');
        }
    });

    $("#first_name").val('');
    $("#last_name").val('');

    $(".payee-firstname").val('');
    $(".payee-lastname").val('');
    
    $("#customer_email").val('');
    $("#business_name").val('');
    $("#phone-m").val('');
    $("#street").val('');
    $("#city").val('');
    $("#state").val('');
    $("#zip_code").val('');
    $("#country").val('');    
    
});   

var switchEl = $('#createRules #auto-add-switch')[0];
var switchery = new Switchery(switchEl, { size: 'small' });

$('#createRules #transaction-type').on('change', function() {
    if($(this).val() === 'money-in') {
        $('#createRules #assign-to-transac').html('<option value="deposit" selected>Deposit</option><option value="transfer">Transfer</option><option value="cc-payment">Credit card payment</option>');
        $('#createRules #assign-to-transac').trigger('change');
        $('#createRules #assign-to-customer').parent().parent().parent().remove();
    } else {
        $('#createRules #assign-to-transac').html(`<option value="expenses" selected>Expenses</option>
        <option value="transfer">Transfer</option>
        <option value="check">Check</option>
        <option value="cc-payment">Credit card payment</option>`);
        $('#createRules #assign-to-transac').trigger('change');

        $(`<div class="col-12 grid-mb">
            <div class="row">
                <div class="col-12 col-md-4 d-flex align-items-center">
                    Customer
                </div>
                <div class="col-12 col-md-8">
                    <select name="assign_to_customer" class="nsm-field form-control" id="assign-to-customer">

                    </select>
                </div>
            </div>
        </div>`).insertAfter($('#createRules #assign-to-payee').parent().parent().parent());
    }

    $('#createRules #assign-to-customer').select2({
        ajax: {
            url: base_url + 'accounting/get-dropdown-choices',
            dataType: 'json',
            data: function(params) {
                var query = {
                    search: params.term,
                    type: 'public',
                    field: 'customer',
                    modal: 'create-rules'
                }

                // Query parameters will be ?search=[term]&type=public&field=[type]
                return query;
            }
        },
        templateResult: formatResult,
        templateSelection: optionSelect,
        dropdownParent: $('#createRules')
    });
});

$('#createRules #for-accounts').on('change', function() {
    var get_dropdown_url = base_url + 'accounting/get-dropdown-choices?type=public&field=bank-account&modal=create-rules';
    var values = $(this).val();
    var el = $(this);
    if(values.includes('all-bank-accounts')) {
        $.ajax({
            url: base_url + 'accounting/get-dropdown-choices?type=public&field=bank-account&modal=create-rules',
            //url: get_dropdown_url,
            dataType: 'json',
            success: function(res) {
                var results = res.results;

                for(i = 0; i < results.length; i++)
                {
                    if(results[i].id !== 'all-bank-accounts') {
                        var option = new Option(results[i].text, results[i].id, true, true);
                        el.append(option);
                    }
                }
            }
        });
    }
});

$(document).on('change', '#createRules #conditions-table select[name="field[]"]', function() {
    if($(this).val() === 'amount') {
        $(this).closest('tr').find('select[name="condition[]"]').html(`<option value="doesnt-equal">Doesn't equal</option>
        <option value="eqauls" selected>Equals</option>
        <option value="is-greater-than">Is greater than</option>
        <option value="is-less-than">Is less than</option>`).trigger('change');
    } else {
        $(this).closest('tr').find('select[name="condition[]"]').html(`<option value="contain" selected>Contain</option>
        <option value="doesnt-contain">Doesn't contain</option>
        <option value="is-exactly">Is exactly</option>`).trigger('change');
    }
});

$('#createRules #conditions-table #add-condition').on('click', function(e) {
    e.preventDefault();

    if($('#createRules #conditions-table tbody tr').length === 1) {
        $('#createRules #conditions-table tbody tr:first-child td:last-child').html(`<button class="nsm-button remove-condition"><i class="bx bx-fw bx-trash"></i></button>`);
    }
    $('#createRules #conditions-table tbody').append(`<tr>
        <td>
            <select name="field[]" class="nsm-field form-control">
                <option value="description" selected>Description</option>
                <option value="bank-text">Bank text</option>
                <option value="amount">Amount</option>
            </select>
        </td>
        <td>
            <select name="condition[]" class="nsm-field form-control">
                <option value="contain" selected>Contain</option>
                <option value="doesnt-contain">Doesn't contain</option>
                <option value="is-exactly">Is exactly</option>
            </select>
        </td>
        <td>
            <input required type="text" name="text_rule[]" id="text-rule[]" class="nsm-field form-control text-rule" placeholder="Enter Text">
        </td>
        <td><button class="nsm-button remove-condition"><i class="bx bx-fw bx-trash"></i></button></td>
    </tr>`);

    $('#createRules #conditions-table tbody tr:last-child select').select2({
        minimumResultsForSearch: -1,
        dropdownParent: $('#createRules')
    });
});

$(document).on('click', '#createRules #conditions-table .remove-condition', function(e) {
    e.preventDefault();

    $(this).closest('tr').remove();

    if($('#createRules #conditions-table tbody tr').length === 1) {
        $('#createRules #conditions-table tbody tr:first-child td:last-child').html('');
    }
});

$('#createRules #exclude-rule').on('click', function(e) {
    e.preventDefault();

    $(this).closest('.dropdown-menu').find('.active').removeClass('active');
    $(this).addClass('active');
    $(this).closest('.dropdown-menu').prev().html('Exclude <i class="bx bx-fw bx-chevron-down"></i>');

    do {
        $(this).closest('.grid-mb').next().remove();
    } while($(this).closest('.grid-mb').next().length > 0)
});

$('#createRules #assign-rule').on('click', function(e) {
    e.preventDefault();

    $(this).closest('.dropdown-menu').find('.active').removeClass('active');
    $(this).addClass('active');
    $(this).closest('.dropdown-menu').prev().html('Assign <i class="bx bx-fw bx-chevron-down"></i>');

    if($(this).closest('.grid-mb').next().length < 1) {
        $(`<div class="col-12 grid-mb">
            <div class="row">
                <div class="col-12 col-md-4 d-flex align-items-center">
                    Transaction type
                </div>
                <div class="col-12 col-md-8">
                    <select name="assign_to_transac" class="nsm-field form-control" id="assign-to-transac">
                        <option value="expenses" selected>Expenses</option>
                        <option value="transfer">Transfer</option>
                        <option value="check">Check</option>
                        <option value="cc-payment">Credit card payment</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12 grid-mb">
            <div class="row">
                <div class="col-12 col-md-4 d-flex align-items-center">
                    Category
                </div>
                <div class="col-12 col-md-8">
                    <select name="assign_to_category" class="nsm-field form-control" id="assign-to-category" required></select>
                </div>
            </div>
        </div>
        <div class="col-12 grid-mb">
            <div class="row">
                <div class="col-12 col-md-4"></div>
                <div class="col-12 col-md-8">
                    <button class="nsm-button primary" id="add-split">
                        <i class="bx bx-fw bx-plus"></i> Add a split
                    </button>
                </div>
            </div>
        </div>
        <div class="col-12 grid-mb">
            <div class="row">
                <div class="col-12 col-md-4 d-flex align-items-center">
                    Payee
                </div>
                <div class="col-12 col-md-8">
                    <select name="assign_to_payee" class="nsm-field form-control" id="assign-to-payee"></select>
                </div>
            </div>
        </div>
        <div class="col-12 grid-mb">
            <div class="row">
                <div class="col-12 col-md-4 d-flex align-items-center">
                    Customer
                </div>
                <div class="col-12 col-md-8">
                    <select name="assign_to_customer" class="nsm-field form-control" id="assign-to-customer"></select>
                </div>
            </div>
        </div>
        <div class="col-12 grid-mb">
            <div class="row">
                <div class="col-12 col-md-4 d-flex align-items-center">
                    Tags
                </div>
                <div class="col-12 col-md-8">
                    <select name="assign_to_tags[]" class="nsm-field form-control" id="assign-to-tags" multiple="multiple"></select>
                </div>
            </div>
        </div>
        <div class="col-12 grid-mb">
            <button class="nsm-button primary" id="assign-more">
                <i class="bx bx-fw bx-plus"></i> Assign more
            </button>
        </div>
        <div class="col-12 grid-mb">
            <div class="form-group">
                <label for="">Automatically confirm transactions this rule applies to</label>
                <div class="custom-control custom-switch">
                    <label class="custom-control-label" for="auto-add-switch">Auto-add</label>
                    <input type="checkbox" name="auto" class="custom-control-input" id="auto-add-switch">
                </div>
            </div>
        </div>`).insertAfter($(this).closest('.grid-mb'));

        $('#createRules #assign-to-transac').select2({
            minimumResultsForSearch: -1,
            dropdownParent: $('#createRules')
        });

        $('#createRules #assign-to-category').select2({
            placeholder: 'Select a category',
            ajax: {
                url: base_url + 'accounting/get-dropdown-choices',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        field: 'account',
                        modal: 'create-rules'
                    }
        
                    // Query parameters will be ?search=[term]&type=public&field=[type]
                    return query;
                }
            },
            templateResult: formatResult,
            templateSelection: optionSelect,
            dropdownParent: $('#createRules')
        });

        $('#createRules #assign-to-payee').select2({
            placeholder: '(Recommended)',
            ajax: {
                url: base_url + 'accounting/get-dropdown-choices',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        field: 'payee',
                        modal: 'create-rules'
                    }
        
                    // Query parameters will be ?search=[term]&type=public&field=[type]
                    return query;
                }
            },
            templateResult: formatResult,
            templateSelection: optionSelect,
            dropdownParent: $('#createRules')
        });

        $('#createRules #assign-to-customer').select2({
            ajax: {
                url: base_url + 'accounting/get-dropdown-choices',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        field: 'customer',
                        modal: 'create-rules'
                    }

                    // Query parameters will be ?search=[term]&type=public&field=[type]
                    return query;
                }
            },
            templateResult: formatResult,
            templateSelection: optionSelect,
            dropdownParent: $('#createRules')
        });

        $('#createRules #assign-to-tags').select2({
            placeholder: 'Start typing to add a tag',
            dropdownParent: $('#createRules'),
            allowClear: true,
            ajax: {
                url: base_url + 'accounting/get-job-tags',
                dataType: 'json'
            }
        });

        var switchEl = $('#createRules #auto-add-switch')[0];
        var switchery = new Switchery(switchEl, { size: 'small' });
    }
});

$(document).on('click', '#createRules #add-split', function(e) {
    e.preventDefault();

    $('#createRules #assign-to-category').closest('.grid-mb').html(`
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-group m-0">
                <label for="split-by">Split by</label>
                <select name="split_by" class="nsm-field form-control" id="split-by" required>
                    <option value="percentage" selected>Percentage (%)</option>
                    <option value="amount">Amount ($)</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between">
            <label>Split detail #1</label>
            <button class="nsm-button remove-split-detail float-end"><i class="bx bx-fw bx-trash"></i></button>
        </div>
        <div class="col-12 col-md-6 grid-mb">
            <div class="form-group m-0">
                <label for="split-detail-1-value">Percentage</label>
                <input type="text" id="split-detail-1-value" name="split_detail_value[]" class="nsm-field form-control" value="0" required>
            </div>
        </div>
        <div class="col-12 col-md-6 grid-mb">
            <div class="form-group m-0">
                <label for="split-detail-1-category">Category</label>
                <select name="split_detail_category[]" class="nsm-field form-control" id="split-detail-1-category" required></select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between">
            <label>Split detail #2</label>
            <button class="nsm-button remove-split-detail float-end"><i class="bx bx-fw bx-trash"></i></button>
        </div>
        <div class="col-12 col-md-6 grid-mb">
            <div class="form-group m-0">
                <label for="split-detail-2-value">Percentage</label>
                <input type="text" id="split-detail-2-value" name="split_detail_value[]" class="nsm-field form-control" value="0" required>
            </div>
        </div>
        <div class="col-12 col-md-6 grid-mb">
            <div class="form-group m-0">
                <label for="split-detail-2-category">Category</label>
                <select name="split_detail_category[]" class="nsm-field form-control" id="split-detail-2-category" required></select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 grid-mb"><button class="nsm-button add-line"><i class="bx bx-fw bx-plus"></i> Add a line</button></div>
    </div>`);

    $('#createRules #split-by').select2({
        minimumResultsForSearch: -1,
        dropdownParent: $('#createRules')
    });

    $('#createRules select[name="split_detail_category[]"]').select2({
        placeholder: 'Select a category',
        ajax: {
            url: base_url + 'accounting/get-dropdown-choices',
            dataType: 'json',
            data: function(params) {
                var query = {
                    search: params.term,
                    type: 'public',
                    field: 'account',
                    modal: 'create-rules'
                }
    
                // Query parameters will be ?search=[term]&type=public&field=[type]
                return query;
            }
        },
        templateResult: formatResult,
        templateSelection: optionSelect,
        dropdownParent: $('#createRules')
    });

    $(this).closest('.grid-mb').remove();
    $('#createRules #assign-to-tags').closest('.grid-mb').remove();
});

$(document).on('click', '#createRules .add-line', function(e) {
    e.preventDefault();

    var count = $('#createRules select[name="split_detail_category[]"]').length;

    $(`<div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between">
            <label>Split detail #${count+1}</label>
            <button class="nsm-button remove-split-detail float-end"><i class="bx bx-fw bx-trash"></i></button>
        </div>
        <div class="col-12 col-md-6 grid-mb">
            <div class="form-group m-0">
                <label for="split-detail-${count+1}-value">Percentage</label>
                <input type="text" id="split-detail-${count+1}-value" name="split_detail_value[]" class="nsm-field form-control" value="0" required>
            </div>
        </div>
        <div class="col-12 col-md-6 grid-mb">
            <div class="form-group m-0">
                <label for="split-detail-${count+1}-category">Category</label>
                <select name="split_detail_category[]" class="nsm-field form-control" id="split-detail-${count+1}-category" required></select>
            </div>
        </div>
    </div>`).insertBefore($(this).closest('.row'));

    $(this).closest('.row').prev().find('select[name="split_detail_category[]"]').select2({
        placeholder: 'Select a category',
        ajax: {
            url: base_url + 'accounting/get-dropdown-choices',
            dataType: 'json',
            data: function(params) {
                var query = {
                    search: params.term,
                    type: 'public',
                    field: 'account',
                    modal: 'create-rules'
                }
    
                // Query parameters will be ?search=[term]&type=public&field=[type]
                return query;
            }
        },
        templateResult: formatResult,
        templateSelection: optionSelect,
        dropdownParent: $('#createRules')
    });
});

$(document).on('click', '#createRules .remove-split-detail', function(e) {
    e.preventDefault();

    if($('#createRules .remove-split-detail').length > 2) {
        $(this).closest('.row').remove();

        var count = 1;
        $($('#createRules .remove-split-detail')[0]).closest('.row').parent().find('.row').each(function() {
            if($(this).find('select[name="split_detail_category[]"]').length > 0) {
                $(this).find('.remove-split-detail').prev().html(`Split detail #${count}`);
                $(this).find('input[name="split_detail_value[]"]').prev().attr('for', `split-detail-${count}-value`);
                $(this).find('input[name="split_detail_value[]"]').attr('id', `split-detail-${count}-value`);
                $(this).find('select[name="split_detail_category[]"]').prev().attr('for', `split-detail-${count}-category`);
                $(this).find('select[name="split_detail_category[]"]').attr('id', `split-detail-${count}-category`);

                count++;
            }
        });
    } else {
        $(this).closest('.row').parent().html(`
        <div class="row">
            <div class="col-12 col-md-4 d-flex align-items-center">
                Category
            </div>
            <div class="col-12 col-md-8">
                <select name="assign_to_category" class="nsm-field form-control" id="assign-to-category" required></select>
            </div>
        </div>`);

        $(`<div class="col-12 grid-mb">
            <div class="row">
                <div class="col-12 col-md-4"></div>
                <div class="col-12 col-md-8">
                    <button class="nsm-button primary" id="add-split">
                        <i class="bx bx-fw bx-plus"></i> Add a split
                    </button>
                </div>
            </div>
        </div>`).insertAfter($('#createRules #assign-to-category').closest('.grid-mb'));

        $('#createRules #assign-to-category').select2({
            placeholder: 'Select a category',
            ajax: {
                url: base_url + 'accounting/get-dropdown-choices',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        field: 'account',
                        modal: 'create-rules'
                    }
        
                    // Query parameters will be ?search=[term]&type=public&field=[type]
                    return query;
                }
            },
            templateResult: formatResult,
            templateSelection: optionSelect,
            dropdownParent: $('#createRules')
        });
    }
});

$(document).on('change', '#createRules #split-by', function() {
    if($(this).val() === 'percentage') {
        var fields = $(this).closest('.row').parent().find('select[name="split_detail_category[]"]');
        fields.each(function(index) {
            if($(this).parent().parent().prev().find('label').length > 0) {
                $(this).parent().parent().prev().find('label').html('Percentage');
            } else {
                $(this).parent().parent().prev().html(`<div class="form-group m-0">
                    <label for="split-detail-${index+1}-value">Percentage</label>
                    <input type="text" id="split-detail-${index+1}-value" name="split_detail_value[]" class="nsm-field form-control" value="0" required="">
                </div>`);
            }
        });
    } else {
        var inputs = $(this).closest('.row').parent().find('input[name="split_detail_value[]"]');
        inputs.each(function(index) {
            if((index + 1) < inputs.length) {
                $(this).prev().html('Amount');
            } else {
                $(this).parent().parent().addClass('d-flex');
                $(this).parent().parent().addClass('align-items-center');
                $(this).parent().parent().html('Remainder');
            }
        });
    }
});

$(document).on('click', '#createRules #assign-more', function(e) {
    e.preventDefault();

    $(`<div class="col-12 grid-mb">
        <div class="row">
            <div class="col-12 col-md-4 d-flex align-items-center">
                Replace bank memo
            </div>
            <div class="col-12 col-md-8">
                <textarea name="replace_bank_memo" id="assign-to-bank-memo" class="nsm-field form-control" placeholder="Enter text (required)" required></textarea>
            </div>
        </div>
    </div>
    <div class="col-12 grid-mb">
        <div class="row">
            <div class="col-12 col-md-4"></div>
            <div class="col-12 col-md-8">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="keep-existing-bank-memo">
                    <label class="form-check-label" for="keep-existing-bank-memo">
                        Also keep existing bank memo.
                    </label>
                </div>
            </div>
        </div>
    </div>`).insertBefore($(this).parent());

    $(this).parent().html(`<button class="nsm-button" id="clear">Clear</button>`);
});

$(document).on('click', '#createRules #clear', function(e) {
    e.preventDefault();

    $(this).parent().prev().prev().remove();
    $(this).parent().prev().remove();

    $(this).parent().html(`<button class="nsm-button primary" id="assign-more"><i class="bx bx-fw bx-plus"></i> Assign more</button>`);
});

$(document).on('click', '#button-test-rule', function(e) {
    e.preventDefault();
    var err_count = 0
    $("input[name='text_rule[]']").each(function(){
        if($(this).val() === '') {
            err_count++;
        }
    });

    if(err_count == 0) {
        $("#text-rule-condition-alert").html('<span style="color: blue;"><strong>Congrats, no condition error.</strong></span>');
    } else {
        $("#text-rule-condition-alert").html('<span style="color: red;"><strong>Condition must contain a value.</strong></span>');
    }   
});

$(document).on('submit', '#createRules #addRuleForm', function(e) {
    e.preventDefault();

    var new_rule_url = base_url + 'accounting/rules/save_new_rule';
    var frmData = $("#addRuleForm").serialize();

    $.ajax({
        url: new_rule_url,
        method: "POST",
        data: frmData,
        success: function(data) {
            if(data == 1) {
                Swal.fire({
                    showConfirmButton: false,
                    timer: 2000,
                    title: 'Success',
                    text: "Rule has been added!",
                    icon: 'success'
                });
                setTimeout(function() { 
                    $('.createRuleModalRight').modal('hide');
                    window.location.href = base_url + "accounting/rules";
                }, 2500);                
            } else {
                Swal.fire({
                    showConfirmButton: false,
                    timer: 2000,
                    title: 'Failed',
                    text: "Something is wrong in the process!",
                    icon: 'warning'
                });
                setTimeout(function() { 
                    $('.createRuleModalRight').modal('hide');
                    window.location.href = base_url + "accounting/rules";
                }, 2500);  
            }
        }
    });
});

