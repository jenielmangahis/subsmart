const currUrl = window.location.href;
const urlSplit = currUrl.split('/');
const customerId = urlSplit[urlSplit.length - 1].includes('?') ? urlSplit[urlSplit.length - 1].split('?')[0].replace('#', '') : urlSplit[urlSplit.length - 1].replace('#', '');
const customerName = $('span#customer-business-name').html();
import("/assets/js/customer/components/FieldCustomName.js");
$('.edit-customer, .notes-container').on('click', function(e) {
    e.preventDefault();

    $('#edit-customer-modal').modal('show');
});

$('#edit-customer-modal [data-type="customer_sales_area"').select2({
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
    dropdownParent: $('#edit-customer-modal')
});

$('#edit-customer-modal [data-type=billing_rate_plan]').select2({
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
    dropdownParent: $('#edit-customer-modal')
});

$('#edit-customer-modal [data-type=funding_info_activation_fee]').select2({
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
    dropdownParent: $('#edit-customer-modal')
});

$('#edit-customer-modal [data-type=alarm_info_system_type]').select2({
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
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #fk_sa_id").select2({
    placeholder: "Select Sales Area",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #prefix").select2({
    placeholder: "Select Name Prefix",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #suffix").select2({
    placeholder: "Select Name Suffix",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #pay_history").select2({
    placeholder: "Select Pay History",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #mmr").select2({
    placeholder: "Select Month Rate",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #bill_freq").select2({
    placeholder: "Select",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #bill_day").select2({
    placeholder: "Select Billing Day",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #contract_term").select2({
    placeholder: "Select Contract Term",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #bill_method").select2({
    placeholder: "Select Bill Method",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #assign_to").select2({
    placeholder: "Select Assign To",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #purchase_multiple").select2({
    placeholder: "Select Purchase Multiple",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #language").select2({
    placeholder: "Select Language",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #fk_sales_rep_office").select2({
    placeholder: "Select Sales Rep Office",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #technician").select2({
    placeholder: "Select Technician",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #save_by").select2({
    placeholder: "Select Pay History",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #cancel_reason").select2({
    placeholder: "Select Saved By",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #pre_install_survey").select2({
    placeholder: "Select Pre-Install Survey",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #post_install_survey").select2({
    placeholder: "Select Post-Install Survey",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #activation_fee").select2({
    placeholder: "Select Activation Fee",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #lead_source").select2({
    placeholder: "Select Lead Source",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #verification").select2({
    placeholder: "Select Verification",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #warranty_type").select2({
    placeholder: "Select Warranty Type",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #communication_type").select2({
    placeholder: "Select Communication Type",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #acct_type").select2({
    placeholder: "Select Account Type",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #proposed_offset").select2({
    placeholder: "Select Offset",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal .solar_infos").select2({
    placeholder: "Select",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #panel_type").select2({
    placeholder: "Select Panel Type",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #mon_waived").select2({
    placeholder: "Select Monitoring Waived",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #status").select2({
    placeholder: "Select Status",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #customer_type").select2({
    placeholder: "Select Customer Type",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #customer_group").select2({
    placeholder: "Select Customer Group",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #industry_type").select2({
    placeholder: "Select Industry Type",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #pay_method").select2({
    placeholder: "Select Payment Type",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #credit_score").select2({
    placeholder: "Select Credit Score",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #monitoring_waived").select2({
    placeholder: "Select Month",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #frequency").select2({
    placeholder: "Select",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #transaction_category").select2({
    placeholder: "Select Category",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #system_type").select2({
    placeholder: "Select System Type",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #dealer").select2({
    placeholder: "Select Alarm Login",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #monitor_comp").select2({
    placeholder: "Select Company",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #online").select2({
    placeholder: "Select",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #in_service").select2({
    placeholder: "Select",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #collections").select2({
    placeholder: "Select",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #equipment").select2({
    placeholder: "Select",
    dropdownParent: $('#edit-customer-modal')
});

$("#edit-customer-modal #invoice_term").select2({
    placeholder: "",
    dropdownParent: $('#edit-customer-modal')
});

$('#edit-customer-modal div[data-type="customer_birthday"]').birthdaypicker({
    defaultDate: $('#edit-customer-modal div[data-type="customer_birthday"]').data().value ? $('#edit-customer-modal div[data-type="customer_birthday"]').data().value : false,
});

$('#edit-customer-modal div[data-type="customer_birthday"]').find('select').addClass("form-control");

$('#edit-customer-modal .date').datepicker({
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

$("#edit-customer-modal #add_field").click(function () {
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
    $("#edit-customer-modal #custom_field").append(custom_field_form);
});

$("body").delegate(".remove_item_row", "click", function(){
    $(this).parent().parent().remove();
});

$(document).on('click', '#edit-customer-modal #btn-notify-customer-new-pw', function(e){
    e.preventDefault();

    var url = base_url + 'customer/_send_login_details';    
    var cid = $(this).attr('data-id');     

    Swal.fire({
        title: 'Email Notification',
        html: "Are you sure you want to send to customer email their login access?",
        icon: 'question',
        confirmButtonText: 'Proceed',
        showCancelButton: true,
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'POST',
                url: url,
                dataType: 'json',
                data: {cid:cid},
                success: function(o) {
                    if( o.is_success == 1 ){   
                        Swal.fire({
                            title: 'Email Sent!',
                            text: "An email was sent to customer of their login details!",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                            
                            //}
                        });
                    }else{
                      Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: o.msg
                      });
                    }
                },
            });
        }
    });
});

$('#new-invoice').on('click', function() {
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

$('#new-payment').on('click', function() {
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

$('#new-sales-receipt').on('click', function() {
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

$('#new-credit-memo').on('click', function() {
    $.get('/accounting/get-other-modals/credit_memo_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#creditMemoModal #customer').html(`<option value="${customerId}">${customerName}</option>`).trigger('change');

        modalName = '#creditMemoModal';
        initModalFields('creditMemoModal');

        $('#creditMemoModal').modal('show');
    });
});

$('#new-delayed-charge').on('click', function() {
    $.get('/accounting/get-other-modals/delayed_charge_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#delayedChargeModal #customer').html(`<option value="${customerId}">${customerName}</option>`).trigger('change');

        modalName = '#delayedChargeModal';
        initModalFields('delayedChargeModal');

        $('#delayedChargeModal').modal('show');
    });
});

$('#new-time-activity').on('click', function() {
    $.get('/accounting/get-other-modals/single_time_activity_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#singleTimeModal #customer').html(`<option value="${customerId}">${customerName}</option>`).trigger('change');

        modalName = '#singleTimeModal';
        initModalFields('singleTimeModal');

        $('#singleTimeModal').modal('show');
    });
});

$('#new-standard-estimate').on('click', function() {
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

$('#new-options-estimate').on('click', function() {
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

$('#new-bundle-estimate').on('click', function() {
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

$('#edit-customer-form').on('submit', async function(e) {
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
        url: base_url + "accounting/customers/update/"+customerId,
        dataType: 'json',
        data: form.serialize(), // serializes the form's elements.
        success: function(data)
        {
            if(data.success){
                sucess("Customer Updated Successfully!",data.profile_id);
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
                    window.location.href=`${base_url}accounting/customers/view/${customerId}`;
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
            window.location.href=`${base_url}accounting/customers/view/${customerId}`;
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
            window.location.href=`${base_url}accounting/customers/view/${customerId}`;
        }
    });
}