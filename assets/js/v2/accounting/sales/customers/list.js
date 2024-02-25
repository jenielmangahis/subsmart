import("/assets/js/customer/components/FieldCustomName.js");
$('.dropdown-menu.table-settings, .dropdown-menu.table-filter').on('click', function(e) {
    e.stopPropagation();
});

$("#customers-table").nsmPagination({
    //itemsPerPage: parseInt($('#table-rows li a.active').html().trim())
    itemsPerPage: 10
});

$('.dropdown-menu#table-rows a.dropdown-item').on('click', function() {
    var count = $(this).html();
    $('.dropdown-menu#table-rows a.dropdown-item.active').removeClass('active');
    $(this).addClass('active');

    $(this).parent().parent().prev().find('span').html(count);
    $('.dropdown-menu#table-rows').prev().dropdown('toggle');

    $("#customers-table").nsmPagination({
        itemsPerPage: parseInt(count)
    });
});

$('#customers-table thead .select-all').on('change', function() {
    $('#customers-table tbody tr:visible .select-one').prop('checked', $(this).prop('checked')).trigger('change');
});

$(document).on('change', '#customers-table tbody tr:visible .select-one', function() {
    var checked = $('#customers-table tbody tr:visible input.select-one:checked');
    var totalrows = $('#customers-table tbody tr:visible input.select-one').length;

    $('#customers-table thead .select-all').prop('checked', checked.length === totalrows);

    if(checked.length < 1) {
        $('.batch-actions li a.dropdown-item').addClass('disabled');
    } else {
        $('.batch-actions li a.dropdown-item').removeClass('disabled');
    }

    var href = 'mailto:';
    var index = $('#customers-table thead tr td[data-name="Email"]').index();
    checked.each(function() {
        var row = $(this).closest('tr');
        var email = $(row.find('td')[index]).text().trim();

        if(email !== '') {
            href += ' '+email+',';
        }
    });

    if(href !== 'mailto:') {
        $('#email-action').attr('href', href);
        $('#email-action').removeClass('disabled');
    } else {
        $('#email-action').addClass('disabled');
    }
});

$(document).on('change', '.dropdown-menu.table-settings input[name="col_chk"]', function() {
    var chk = $(this);
    var dataName = $(this).next().text().trim();

    var index = $(`#customers-table thead td[data-name="${dataName}"]`).index();
    $(`#customers-table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });

    $(`#print_customers_modal table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });

    $(`#print_preview_customers_modal #customers_table_print tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });
});

$('#select-customer-type').on('click', function() {
    $('#select-customer-type-modal').modal('show')
});

$("#btn_print_customers").on("click", function() {
    $("#customers_table_print").printThis();
});

$('#customer-type').select2({
    minimumResultsForSearch: -1,
    dropdownParent: $('#select-customer-type-modal')
});

$('#apply-customer-type').on('click', function() {
    var data = new FormData();

    data.set('customer_type', $('#customer-type').val());
    var checked = $('#customers-table tbody tr:visible input.select-one:checked');
    checked.each(function() {
        data.append('customers[]', $(this).val());
    });

    $.ajax({
        url: '/accounting/customers/batch-select-customer-type',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            location.reload();
        }
    });
});

$('#add-customer-modal [data-type="customer_sales_area"').select2({
    placeholder: "Select Sales Area",
    ajax: {
        url: base_url+`Customer_Form/apiGetSalesAreas`,
        dataType: "json",
        data: (params) => {
            return { search: params.term };
        },
        processResults: (response) => {
            return {
                results: response.data.map((item) => ({
                    id: item.sa_id,
                    text: item.sa_name,
                })),
            };
        },
    },
    dropdownParent: $('#add-customer-modal')
});

$('#add-customer-modal [data-type=billing_rate_plan]').select2({
    placeholder: "Select Rate Plan",
    ajax: {
        url: base_url+`/Customer_Form/apiGetRatePlans`,
        dataType: "json",
        data: (params) => {
            return { search: params.term };
        },
        processResults: (response) => {
            return {
                results: response.data.map((item) => ({
                    id: item.amount,
                    text: item.amount,
                })),
            };
        },
    },
    dropdownParent: $('#add-customer-modal')
});

$('#add-customer-modal [data-type=funding_info_activation_fee]').select2({
    placeholder: "Select Activation Fee",
    ajax: {
        url: base_url+`Customer_Form/apiGetActivationFees`,
        dataType: "json",
        data: (params) => {
            return { search: params.term };
        },
        processResults: (response) => {
            return {
                results: response.data.map((item) => ({
                    id: item.amount,
                    text: item.amount,
                })),
            };
        },
    },
    dropdownParent: $('#add-customer-modal')
});

$('#add-customer-modal [data-type=alarm_info_system_type]').select2({
    placeholder: "Select Account Type",
    ajax: {
      url: base_url+`Customer_Form/apiGetSystemPackages`,
      dataType: "json",
      data: (params) => {
            return { search: params.term };
      },
      processResults: (response) => {
        return {
            results: response.data.map((item) => ({
                id: item.name,
                text: item.name,
            })),
        };
      },
    },
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #fk_sa_id").select2({
    placeholder: "Select Sales Area",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #prefix").select2({
    placeholder: "Select Name Prefix",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #suffix").select2({
    placeholder: "Select Name Suffix",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #pay_history").select2({
    placeholder: "Select Pay History",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #mmr").select2({
    placeholder: "Select Month Rate",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #bill_freq").select2({
    placeholder: "Select",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #bill_day").select2({
    placeholder: "Select Billing Day",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #contract_term").select2({
    placeholder: "Select Contract Term",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #bill_method").select2({
    placeholder: "Select Bill Method",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #assign_to").select2({
    placeholder: "Select Assign To",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #purchase_multiple").select2({
    placeholder: "Select Purchase Multiple",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #language").select2({
    placeholder: "Select Language",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #fk_sales_rep_office").select2({
    placeholder: "Select Sales Rep Office",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #technician").select2({
    placeholder: "Select Technician",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #save_by").select2({
    placeholder: "Select Pay History",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #cancel_reason").select2({
    placeholder: "Select Saved By",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #pre_install_survey").select2({
    placeholder: "Select Pre-Install Survey",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #post_install_survey").select2({
    placeholder: "Select Post-Install Survey",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #activation_fee").select2({
    placeholder: "Select Activation Fee",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #lead_source").select2({
    placeholder: "Select Lead Source",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #verification").select2({
    placeholder: "Select Verification",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #warranty_type").select2({
    placeholder: "Select Warranty Type",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #communication_type").select2({
    placeholder: "Select Communication Type",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #acct_type").select2({
    placeholder: "Select Account Type",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #proposed_offset").select2({
    placeholder: "Select Offset",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal .solar_infos").select2({
    placeholder: "Select",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #panel_type").select2({
    placeholder: "Select Panel Type",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #mon_waived").select2({
    placeholder: "Select Monitoring Waived",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #status").select2({
    placeholder: "Select Status",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #customer_type").select2({
    placeholder: "Select Customer Type",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #customer_group").select2({
    placeholder: "Select Customer Group",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #industry_type").select2({
    placeholder: "Select Industry Type",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #pay_method").select2({
    placeholder: "Select Payment Type",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #credit_score").select2({
    placeholder: "Select Credit Score",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #monitoring_waived").select2({
    placeholder: "Select Month",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #frequency").select2({
    placeholder: "Select",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #transaction_category").select2({
    placeholder: "Select Category",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #system_type").select2({
    placeholder: "Select System Type",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #dealer").select2({
    placeholder: "Select Alarm Login",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #monitor_comp").select2({
    placeholder: "Select Company",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #online").select2({
    placeholder: "Select",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #in_service").select2({
    placeholder: "Select",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #collections").select2({
    placeholder: "Select",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #equipment").select2({
    placeholder: "Select",
    dropdownParent: $('#add-customer-modal')
});

$("#add-customer-modal #invoice_term").select2({
    placeholder: "",
    dropdownParent: $('#add-customer-modal')
});

$('#add-customer-modal div[data-type="customer_birthday"]').birthdaypicker({
    defaultDate: $('#add-customer-modal div[data-type="customer_birthday"]').data().value ? $('#add-customer-modal div[data-type="customer_birthday"]').data().value : false,
});

$('#add-customer-modal div[data-type="customer_birthday"]').find('select').addClass("form-control");

$('#add-customer-modal .date').datepicker({
    format: 'mm/dd/yyyy',
    orientation: 'bottom',
    autoclose: true
});

const Password = {
    _pattern: /[a-zA-Z0-9_\-\+\.]/,

    _getRandomByte: function () {
        // http://caniuse.com/#feat=getrandomvalues
        if (window.crypto && window.crypto.getRandomValues) {
            var result = new Uint8Array(1);
            window.crypto.getRandomValues(result);
            return result[0];
        } else if (window.msCrypto && window.msCrypto.getRandomValues) {
            var result = new Uint8Array(1);
            window.msCrypto.getRandomValues(result);
            return result[0];
        } else {
            return Math.floor(Math.random() * 256);
        }
    },

    generate: function (length) {
        return Array.apply(null, { length: length })
        .map(function () {
            var result;
            while (true) {
                result = String.fromCharCode(this._getRandomByte());
                if (this._pattern.test(result)) {
                    return result;
                }
            }
        }, this)
        .join("");
    },
};

const $password = document.querySelector("[data-type=access_info_pass]");
const $passwordBtn = document.querySelector("[data-action=access_info_generate_pass]"); // prettier-ignore

function setPassword() {
  $password.value = Password.generate(16);
}

if ($password.dataset.value.trim().length) {
  $password.value = $password.dataset.value;
} else {
  setPassword();
}
$passwordBtn.addEventListener("click", setPassword);

$('#add-customer-form').on('submit', async function(e) {
    e.preventDefault();
    var form = $(this);

    const formArray = form.serializeArray();
    const payload = {};
    formArray.forEach(({ name, value }) => payload[name] = value);
    const prefixURL = base_url;
    const response = await fetch(`${prefixURL}Customer_Form/apiCheckDuplicate`, { 
        method: "post", 
        body: JSON.stringify(payload),
        headers: { 
            accept: "application/json", 
            "content-type": "application/json"
        }
    });
    const json = await response.json();
    if (json.data && json.message) {
        const duplicateConfirmation = await Swal.fire({
            title: 'Possible duplicate customer',
            html: json.message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#32243d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Save anyway'
        });

        if (!duplicateConfirmation.isConfirmed) {
            return;
        }
    }

    $.ajax({
        type: "POST",
        url: base_url + "accounting/customers/add",
        dataType: 'json',
        data: form.serialize(), // serializes the form's elements.
        success: function(data)
        {
            if(data.success){
                sucess("New Customer has been Added Successfully!",data.profile_id);
            }else{
                error(data.message);
            }
        },error: function (xhr, ajaxOptions, thrownError, data) {
            Swal.fire({
                text: 'Customer profile was successfully updated!',
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value) {
                    window.location.href=`${base_url}accounting/customers`;
                }
            });
        }
    });
});

function error(information){
    Swal.fire({
        title: 'Sorry!',
        text: information,
        icon: 'error',
        showCancelButton: false,
        confirmButtonColor: '#32243d',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ok'
    }).then((result) => {
        if (result.value) {
            window.location.href=`${base_url}accounting/customers`;
        }
    });
}
function sucess(information,id){
    Swal.fire({
        title: 'Good job!',
        text: information,
        icon: 'success',
        showCancelButton: false,
        confirmButtonColor: '#32243d',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ok'
    }).then((result) => {
        if (result.value) {
            window.location.href=`${base_url}accounting/customers/view/${id}`;
        }
    });
}

$("#add-customer-modal #add_field").click(function () {
    const custom_field_form= "<div class=\"row form_line\">\n" +
        "                <div class=\"col-md-5\">\n" +
        "                    Name\n" +
        "                    <input type=\"text\" class=\"form-control\" name=\"custom_name[]\" id=\"office_custom_field1\" value=\"\" />\n" +
        "                </div>\n" +
        "                <div class=\"col-md-5\">\n" +
        "                    Value\n" +
        "                    <input type=\"text\" class=\"form-control\" name=\"custom_value[]\" id=\"office_custom_field1\" value=\"\" />\n" +
        "                </div>\n" +
        "                <div class=\"col-md-2\">\n" +
        "                    <button style=\"margin-top: 23px;\" type=\"button\" class=\"btn btn-primary btn-sm items_remove_btn remove_item_row\"><i class='bx bx-trash'></i></button>\n" +
        "                </div>\n" +
        "            </div>";
    $("#add-customer-modal #custom_field").append(custom_field_form);
});

$("body").delegate(".remove_item_row", "click", function(){
    $(this).parent().parent().remove();
});

$('#customers-table .receive-payment').on('click', function(e) {
    e.preventDefault();
    var customerId = $(this).closest('tr').find('.select-one').val();
    var customerName = $(this).closest('tr').find('td:nth-child(2)').text().split(', ');
    var firstName = customerName[1];
    var lastName = customerName[0];
    customerName = firstName+' '+lastName;

    $.get('/accounting/get-other-modals/receive_payment_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#receivePaymentModal #customer').html(`<option value="${customerId}">${customerName}</option>`).trigger('change');

        modalName = '#receivePaymentModal';
        initModalFields('receivePaymentModal');

        $('#receivePaymentModal').modal('show');
    });
});

$('#customers-table .create-invoice').on('click', function(e) {
    e.preventDefault();
    var customerId = $(this).closest('tr').find('.select-one').val();
    var customerName = $(this).closest('tr').find('td:nth-child(2)').text().split(', ');
    var firstName = customerName[1];
    var lastName = customerName[0];
    customerName = firstName+' '+lastName;

    $.get('/accounting/get-other-modals/invoice_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#invoiceModal #customer').html(`<option value="${customerId}">${customerName}</option>`).trigger('change');

        modalName = '#invoiceModal';
        initModalFields('invoiceModal');

        $('#invoiceModal').modal('show');
    });
});

$('#customers-table .create-sales-receipt').on('click', function(e) {
    e.preventDefault();
    var customerId = $(this).closest('tr').find('.select-one').val();
    var customerName = $(this).closest('tr').find('td:nth-child(2)').text().split(', ');
    var firstName = customerName[1];
    var lastName = customerName[0];
    customerName = firstName+' '+lastName;

    $.get('/accounting/get-other-modals/sales_receipt_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#salesReceiptModal #customer').html(`<option value="${customerId}">${customerName}</option>`).trigger('change');

        modalName = '#salesReceiptModal';
        initModalFields('salesReceiptModal');

        $('#salesReceiptModal').modal('show');
    });
});

$('#customers-table .create-standard-estimate').on('click', function(e) {
    e.preventDefault();
    var customerId = $(this).closest('tr').find('.select-one').val();
    var customerName = $(this).closest('tr').find('td:nth-child(2)').text().split(', ');
    var firstName = customerName[1];
    var lastName = customerName[0];
    customerName = firstName+' '+lastName;

    $.get('/accounting/get-other-modals/standard_estimate_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#standard-estimate-modal #customer').html(`<option value="${customerId}">${customerName}</option>`).trigger('change');

        modalName = '#standard-estimate-modal';
        initModalFields('standard-estimate-modal');

        $('#standard-estimate-modal').modal('show');
    });
});

$('#customers-table .create-options-estimate').on('click', function(e) {
    e.preventDefault();
    var customerId = $(this).closest('tr').find('.select-one').val();
    var customerName = $(this).closest('tr').find('td:nth-child(2)').text().split(', ');
    var firstName = customerName[1];
    var lastName = customerName[0];
    customerName = firstName+' '+lastName;

    $.get('/accounting/get-other-modals/options_estimate_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#options-estimate-modal #customer').html(`<option value="${customerId}">${customerName}</option>`).trigger('change');

        modalName = '#options-estimate-modal';
        initModalFields('options-estimate-modal');

        $('#options-estimate-modal').modal('show');
    });
});

$('#customers-table .create-bundle-estimate').on('click', function(e) {
    e.preventDefault();
    var customerId = $(this).closest('tr').find('.select-one').val();
    var customerName = $(this).closest('tr').find('td:nth-child(2)').text().split(', ');
    var firstName = customerName[1];
    var lastName = customerName[0];
    customerName = firstName+' '+lastName;

    $.get('/accounting/get-other-modals/bundle_estimate_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#bundle-estimate-modal #customer').html(`<option value="${customerId}">${customerName}</option>`).trigger('change');

        modalName = '#bundle-estimate-modal';
        initModalFields('bundle-estimate-modal');

        $('#bundle-estimate-modal').modal('show');
    });
});

$("#search_field").on("input", debounce(function() {
    let _form = $(this).closest("form");

    _form.submit();
}, 1500));

$('.nsm-counter').on('click', function() {
    var currUrl = window.location.href;

    if(currUrl.slice(-1) === '#') {
        currUrl = currUrl.slice(0, -1); 
    }

    var urlSplit = currUrl.split('/');

    if($(this).hasClass('selected')) {
        if(currUrl.includes(`&transaction=${$(this).attr('id')}`)) {
            location.href = currUrl.replace(`&transaction=${$(this).attr('id')}`, '');
        } else {
            location.href = currUrl.replace(`transaction=${$(this).attr('id')}`, '');
        }
    } else {
        if($('.nsm-counter.selected').length > 0) {
            var selected = $('.nsm-counter.selected').attr('id');
    
            currUrl = currUrl.replace(`transaction=${selected}`, `transaction=${$(this).attr('id')}`);
    
            location.href = currUrl;
        } else {
            if(urlSplit[urlSplit.length - 1] === 'customers') {
                location.href=`customers?transaction=${$(this).attr('id')}`;
            } else {
                location.href = currUrl+`&transaction=${$(this).attr('id')}`;
            }
        }
    }
});

$('.export-customers').on('click', function() {
    if($('#export-form').length < 1) {
        $('body').append('<form action="/accounting/customers/export-customers" method="post" id="export-form"></form>');
    }

    var fields = $('.dropdown-menu.table-settings input[name="col_chk"]:checked');
    fields.each(function() {
        $('#export-form').append(`<input type="hidden" name="fields[]" value="${$(this).attr('id').replace('chk_', '')}">`);
    });

    $('#export-form').append(`<input type="hidden" name="search" value="${$('#search_field').val()}">`);

    if($('.nsm-counter.selected').length > 0) {
        $('#export-form').append(`<input type="hidden" name="transaction" value="${$('.nsm-counter.selected').attr('id')}">`);
    }

    $('#export-form').submit();
});

$('#customer-type-modal #save-customer-type').on('click', function() {
    $('#customer-type-modal .modal-body form').submit();
});

$(document).on('submit', '#customer-type-modal #add-customer-type-form', function(e) {
    e.preventDefault();

    var data = new FormData(this);

    $.ajax({
        url: '/accounting/customers/add-customer-type',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            var res = JSON.parse(result);
            
            if(res.success) {
                $('#customer-types-modal table tbody').append(`<tr data-id="${res.data}">
                    <td>${data.get('customer_type_name')}</td>
                    <td>
                        <div class="dropdown table-management">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item edit-customer-type" href="#">Edit</a>
                                </li>
                                <li>
                                    <a class="dropdown-item delete-customer-type" href="#">Delete</a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>`);

                $('#customer-type-modal').modal('hide');
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: 'Unexpected error occured! Try again.',
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonColor: '#32243d',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                });
            }
        }
    });
});

$('#customer-type-modal').on('hidden.bs.modal', function() {
    $('#customer-type-modal form').attr('id', 'add-customer-type-form');
    $('#customer-type-modal form').removeAttr('data-id');
    $('#customer-type-modal #customer-type-name').val('');
});

$(document).on('click', '#customer-types-modal .edit-customer-type', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    var name = row.find('td:first-child').text();

    $('#customer-type-modal form').attr('id', 'edit-customer-type-form');
    $('#customer-type-modal form').attr('data-id', row.data().id);
    $('#customer-type-modal #customer-type-name').val(name);

    $('#customer-type-modal').modal('show');
});

$(document).on('submit', '#customer-type-modal #edit-customer-type-form', function(e) {
    e.preventDefault();

    var form = $(this);
    var data = new FormData(this);

    $.ajax({
        url: '/accounting/customers/update-customer-type/'+form.attr('data-id'),
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            var res = JSON.parse(result);
            
            if(res.success) {
                $(`#customer-types-modal table tbody tr[data-id="${form.attr('data-id')}"]`).find('td:first-child').html(data.get('customer_type_name'));

                $('#customer-type-modal').modal('hide');
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: 'Unexpected error occured! Try again.',
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonColor: '#32243d',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                });
            }
        }
    });
});

$(document).on('click', '#customer-types-modal .delete-customer-type', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    var name = row.find('td:first-child').text();

    Swal.fire({
        title: 'Are you sure?',
        html: `You want to delete <b>${name}</b>?`,
        icon: 'warning',
        showCloseButton: false,
        confirmButtonColor: '#2ca01c',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        cancelButtonText: 'No',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if(result.isConfirmed) {
            $.ajax({
				url: `/accounting/customers/delete-customer-type/${row.data().id}`,
				type: 'DELETE',
				success: function(result) {
                    $(`#customer-types-modal table tbody tr[data-id="${row.data().id}"]`).remove();
				}
			});
        }
    });
});

const $overlay = document.getElementById('overlay');
$("#import-customers-modal #file-upload").change(function(){
    console.log("A file has been selected.");
    const formData = new FormData();
    const fileInput = document.getElementById('file-upload');
    formData.append('file', fileInput.files[0]);

    if ($overlay) $overlay.style.display = "flex";
    fetch(base_url+'customer/getImportData', {
        method: 'POST',
        body: formData
    }) .then(response => response.json() ).then(response => {
        var { data, headers, success, message }  = response;
        if ($overlay) $overlay.style.display = "none";
        if(!success){
            sweetAlert('Sorry!','error',message);
        }else{
            console.log(response);
            $.each(headers,function(i,o){
                $('#import-customers-modal .headersSelector').append(
                    '<option value="'+i+'">'+o+'</option>'
                );
                $('#import-customers-modal #tableHeader').append(
                    '<th><strong>'+o+'</strong></th>'
                );
            });
            csvHeaders = headers;
            customerData = data; // save customer array data
            // process mapping preview
            $.each(data,function(i,o){
                var toAppend = '';
                $.each(o,function(index,data){
                    toAppend += '<td>'+data+'</td>';
                });
                $('#import-customers-modal #imported_customer').append(
                    '<tr>'+toAppend+'</tr>'
                );
            });

            $('#import-customers-modal #nextBtn1').prop("disabled", false);
        }
    }).catch((error) => {
        console.log('Error:', error);
    });
});

$(document).on('click', "#import-customers-modal .step", function () {
    $(this).addClass("active").prevAll().addClass("active");
    $(this).nextAll().removeClass("active");
});

$(document).on('click', "#import-customers-modal .step01", function () {
    $("#import-customers-modal #line-progress").css("width", "8%");
    $("#import-customers-modal .step1").addClass("active").siblings().removeClass("active");
});

$(document).on('click', "#import-customers-modal .step02", function () {
    $("#import-customers-modal #line-progress").css("width", "50%");
    $("#import-customers-modal .step2").addClass("active").siblings().removeClass("active");

    $('#import-customers-modal .modal-footer').html(`<button type="button" class="nsm-button step01">Back</button>
    <button type="button" class="nsm-button primary step03">Next</button>`);
});

$(document).on('click', "#import-customers-modal .step03", function () {
    $("#import-customers-modal #line-progress").css("width", "100%");
    $("#import-customers-modal .step3").addClass("active").siblings().removeClass("active");

    $('#import-customers-modal .modal-footer').html(`<button type="button" class="nsm-button step02">Back</button>
    <button type="button" class="nsm-button primary" id="importCustomer">Import</button>`);
});

$(document).on('click', "#import-customers-modal #importCustomer", function(e) {
    // prepare form data to be posted
    
    var selectedHeader = [];
    $('#import-customers-modal select[name="headers[]"]').each(function() {
        selectedHeader.push(this.value);
    });

    const formData = new FormData();
    formData.append('customers', JSON.stringify(customerData));
    formData.append('mapHeaders', JSON.stringify(selectedHeader));
    formData.append('csvHeaders', JSON.stringify(csvHeaders));
    
    if ($overlay) $overlay.style.display = "flex";
    // perform post request
    fetch(base_url+'customer/importCustomerData', {
        method: 'POST',
        body: formData,
    }) .then(response => response.json() ).then(response => {
        if ($overlay) $overlay.style.display = "none";
        var { customer, csv, mapping, fields, dataValue, office, billing, profile, message, success }  = response;
        if(success){
            sweetAlert('Awesome!','success',message ,1);
        }else{
            sweetAlert('Sorry!','error',message);
        }

        console.log(response);
    }).catch((error) => {
        console.log('Error:', error);
    });
});

function sweetAlert(title,icon,information,is_reload){
    Swal.fire({
        title: title,
        text: information,
        icon: icon,
        showCancelButton: false,
        confirmButtonColor: '#32243d',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ok'
    }).then((result) => {
        if(is_reload === 1){
            if (result.value) {
                window.location.reload();
            }
        }
    });
}

function test(){
    var selectedHeader = [];
    var head = [];
    $('#import-customers-modal select[name="headers[]"]').each(function() {
        selectedHeader.push(this.value);
    });
    var ar = selectedHeader.length;
    for(var x=0; x<ar; x++){
        head.push(x);
    }

    var arHead = head.length;

    for(var x=0; x<ar; x++){
        if(selectedHeader[x] != ""){
            document.getElementById('headersSelector'+x).value = selectedHeader[x];
            var text = "headersSelector"+x+"";
            for(var i=0; i<arHead; i++){
                var text1 = "headersSelector"+i+"";
                if(text != text1){
                    $("#headersSelector"+i+" option[value='"+selectedHeader[x]+"'").remove();
                }
            }
        }
    }
}


$(document).on('click', '#make-inactive', function() {
    var delete_url = base_url + '/accounting/customers/delete_multi_customers';
    var frmData = $("#accountingCustomerTblFrm").serialize();

    Swal.fire({
        title: 'Are you sure?',
        text: "Make the selected function Inactive!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2ca01c',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: delete_url,
                method: "POST",
                data: frmData,
                success: function(data) {
                    console.log(data);
                    if(data.is_success == 0) {
                        Swal.fire(
                            'Updated!',
                            'Customer has been updated to inactive.',
                            'success'
                        );
                    } else {
                        //window.location.reload();
                        Swal.fire(
                            'Updated!',
                            'Customer has been updated to inactive.',
                            'success'
                        );
                    }

                }
            });
        }
    });
    
}); 