const currUrl = window.location.href;
const urlSplit = currUrl.split('/');
const customerId = urlSplit[urlSplit.length - 1].includes('?') ? urlSplit[urlSplit.length - 1].split('?')[0].replace('#', '') : urlSplit[urlSplit.length - 1].replace('#', '');
const customerName = $('span#customer-business-name').html();
const customerEmail = $('span#customer-email').text().trim();
import("/assets/js/customer/components/FieldCustomName.js");
$('.edit-customer, .notes-container').on('click', function(e) {
    e.preventDefault();
    $('#edit-customer-modal').modal('show');
});

$('#make-inactive').on('click', function(e) {
    //bryann
    Swal.fire({
        title: 'Inactive Customer',
        text: 'Are you sure you want to set customer to inactive?',
        icon: 'question',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonColor: '#2ca01c',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if(result.isConfirmed) {
            var customer_prof_ids = $("#make-inactive").attr("customer-id");
            var update_url = base_url + 'accounting/customers/update_single_customers_status';
            $.ajax({
                url: update_url,
                method: "POST",
                data: {customer_prof_ids:customer_prof_ids},
                success: function(data) {
                    console.log(data);
                    if(data.success == 1) {
                        Swal.fire(
                            'Updated!',
                            'Customer has been updated to inactive.',
                            'success'
                        );
                        location.reload();
                    } else {
                        Swal.fire(
                            'Updated!',
                            'Error updating customer to inactive.',
                            'warning'
                        );
                    }

                }
            });     
        }          
    });    
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

$('#edit-customer-modal .date, #filter-as-of').datepicker({
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
    $.get(base_url + 'accounting/get-other-modals/invoice_modal', function(res) {
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
    $.get(base_url + 'accounting/get-other-modals/receive_payment_modal', function(res) {
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
    $.get(base_url +'accounting/get-other-modals/sales_receipt_modal', function(res) {
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
    $.get(base_url + 'accounting/get-other-modals/credit_memo_modal', function(res) {
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
    $.get(base_url + 'accounting/get-other-modals/delayed_charge_modal', function(res) {
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
    $.get(base_url + 'accounting/get-other-modals/single_time_activity_modal', function(res) {
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
    
    $.get(base_url + 'accounting/get-other-modals/standard_estimate_modal', function(res) {
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
    $.get(base_url + 'accounting/get-other-modals/options_estimate_modal', function(res) {
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
    $.get(base_url + 'accounting/get-other-modals/bundle_estimate_modal', function(res) {
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

$('.dropdown-menu.table-settings, .dropdown-menu.p-3').on('click', function(e) {
    e.stopPropagation();
});

$('#filter-type, #filter-date').select2({
    minimumResultsForSearch: -1
});

$('#apply-button').on('click', function() {
    const noDate = [
        'unbilled-income',
        'recently-paid',
        'recurring-templates'
    ];

    var filterType = $('#filter-type').val();
    var filterDate = $('#filter-date').val();
    var filterAsOf = $('#filter-as-of').val();

    var url = `${base_url}accounting/customers/view/${customerId}?`;

    url += filterType !== 'all' ? `type=${filterType}&` : '';
    url += noDate.includes(filterType) === false && filterDate !== 'all' ? `date=${filterDate}` : '';
    url += filterType === 'unbilled-income' ? `date=${filterAsOf.replaceAll('/', '-')}` : '';

    if(url.slice(-1) === '?' || url.slice(-1) === '&' || url.slice(-1) === '#') {
        url = url.slice(0, -1); 
    }
    location.href = url;
});

$('#reset-button').on('click', function() {
    var url = `${base_url}accounting/customers/view/${customerId}`;
    location.href = url;
});

$(document).on('click', '#transactions-table .view-edit-time-charge', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get(base_url + 'accounting/view-transaction/time-activity/'+id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#singleTimeModal';
        initModalFields('singleTimeModal', data);

        $('#singleTimeModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .view-edit-billable-expense', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get(base_url + 'accounting/view-transaction/billable-expense/'+id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#billableExpenseModal';
        initModalFields('billableExpenseModal', data);

        $('#billableExpenseModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .view-edit-invoice', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get(base_url + 'accounting/view-transaction/invoice/'+id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#invoiceModal';
        initModalFields('invoiceModal', data);

        $('#invoiceModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .view-edit-estimate', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get(base_url + 'accounting/view-transaction/estimate/'+id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        if($('#modal-container #standard-estimate-modal').length > 0) {
            modalName = '#standard-estimate-modal';
        }

        if($('#modal-container #options-estimate-modal').length > 0) {
            modalName = '#options-estimate-modal';
        }

        if($('#modal-container #bundle-estimate-modal').length > 0) {
            modalName = '#bundle-estimate-modal';
        }

        initModalFields(modalName.replace('#', ''), data);
        CKEDITOR.replace('estimate-terms-and-conditions');
        CKEDITOR.replace('estimate-message-to-customer');
        CKEDITOR.replace('estimate-instructions');

        $(modalName).modal('show');
    });
});

$(document).on('click', '#transactions-table .view-edit-credit-memo', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get(base_url + 'accounting/view-transaction/credit-memo/'+id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#creditMemoModal';
        initModalFields('creditMemoModal', data);

        $('#creditMemoModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .view-edit-sales-receipt', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get(base_url + 'accounting/view-transaction/sales-receipt/'+id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#salesReceiptModal';
        initModalFields('salesReceiptModal', data);

        $('#salesReceiptModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .view-edit-refund-receipt', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get('/accounting/view-transaction/refund-receipt/'+id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#refundReceiptModal';
        initModalFields('refundReceiptModal', data);

        $('#refundReceiptModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .view-edit-delayed-credit', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get('/accounting/view-transaction/delayed-credit/'+id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#delayedCreditModal';
        initModalFields('delayedCreditModal', data);

        $('#delayedCreditModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .view-edit-delayed-charge', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get('/accounting/view-transaction/delayed-charge/'+id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#delayedChargeModal';
        initModalFields('delayedChargeModal', data);

        $('#delayedChargeModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .view-edit-payment', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: 'Receive Payment'
    };

    $.get(base_url + 'accounting/view-transaction/receive-payment/'+id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#receivePaymentModal';
        initModalFields('receivePaymentModal', data);

        loadPaymentInvoices(data);
        loadPaymentCredits(data);

        $('#receivePaymentModal').modal('show');
    });
});

$('#update-status-modal #status').on('change', function() {
    if($(this).val() === 'Accepted') {
        $(this).closest('.row').parent().append(`<div class="row grid-mb">
            <div class="col-12">
                <label for="accepted-date">Accepted Date</label>
                <div class="nsm-field-group calendar">
                    <input type="text" class="nsm-field form-control" value="" id="accepted-date" name="accepted_date">
                </div>
            </div>
        </div>`);

        $('#update-status-modal #accepted-date').datepicker({
            format: 'mm/dd/yyyy',
            orientation: 'bottom',
            autoclose: true
        });
    } else {
        $('#update-status-modal #accepted-date').closest('.row').remove();
    }
});

$(document).on('click', '#transactions-table .update-estimate-status', function(e) {
    e.preventDefault();
    var estimateId = $(this).closest('tr').find('.select-one').val();
    var url = `/accounting/customers/update-estimate-status/${estimateId}`;

    $('#update-status-modal #update-estimate-status-form').attr('action', url).attr('method', 'post');
    $('#update-status-modal #status').val($(this).closest('tr').find('td:nth-child(16)').text().trim()).trigger('change');

    $('#update-status-modal').modal('show');
});

$('#update-status-modal').on('hidden.bs.modal', function() {
    $('#update-status-modal #update-estimate-status-form').removeAttr('action').removeAttr('method');
    $('#update-status-modal #status').val('Draft').trigger('change');
});

$('#update-status-modal #status').select2({
    minimumResultsForSearch: -1,
    dropdownParent: $('#update-status-modal')
});

$('#transactions-table .copy-transaction').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();
    var transactionType = row.find('td:nth-child(3)').text().trim();
    transactionType = transactionType.replaceAll(' ', '-');
    transactionType = transactionType.toLowerCase();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get(`/accounting/copy-transaction/${transactionType}/${id}`, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#modal-container form .modal').parent().attr('onsubmit', 'submitModalForm(event, this)').removeAttr('data-href');

        modalName = '#'+$('#modal-container form .modal').attr('id');
        initModalFields($('#modal-container form .modal').attr('id'), data);

        $(modalName).modal('show');
    });
});

$('.export-transactions').on('click', function() {
    if($('#export-form').length < 1) {
        $('body').append(`<form action="/accounting/customers/${customerId}/export-transactions" method="post" id="export-form"></form>`);
    }

    var fields = $('#transactions-table thead tr td:not(:first-child, :last-child)');
    fields.each(function() {
        $('#export-form').append(`<input type="hidden" name="fields[]" value="${$(this).attr('data-name')}">`);
    });

    var currentUrl = currUrl.replace('#', '');
    var urlSplit = currentUrl.split('?');
    var query = urlSplit[1];

    if(query !== undefined) {
        var querySplit = query.split('&');

        $.each(querySplit, function(key, value) {
            var selectedVal = value.split('=');
            $('#export-form').append(`<input type="hidden" name="${selectedVal[0]}" value="${selectedVal[1]}">`);
        });
    }

    $('#export-form').append(`<input type="hidden" name="column" value="date">`);
    $('#export-form').append(`<input type="hidden" name="order" value="desc">`);

    $('#export-form').submit();
});

$('#export-form').on('submit', function(e) {
    e.preventDefault();
    this.submit();
    $(this).remove();
});

$('.dropdown-menu.table-settings input[name="col_chk"]').on('change', function() {
    var chk = $(this);
    var dataName = $(this).next().text();

    var index = $(`#transactions-table thead td[data-name="${dataName}"]`).index();
    $(`#transactions-table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });

    $(`#print_customer_transactions_modal table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });

    $(`#print_preview_customer_transactions_modal #customer_transactions_table_print tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });
});

$("#btn_print_customer_transactions").on("click", function() {
    $("#customer_transactions_table_print").printThis();
});

$('#transactions-table .create-invoice').on('click', function (e) {
    e.preventDefault();

    var id = $(this).closest('tr').find('.select-one').val();
    var type = $(this).closest('tr').find('td:nth-child(3)').text().trim();
    
    $.get(`/accounting/customers/create-invoice/${type.toLowerCase().replaceAll(' ', '-')}/${id}`, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#invoiceModal';
        initModalFields('invoiceModal');

        $('#invoiceModal #customer').trigger('change');
        $('#invoiceModal input[name="quantity[]"]:first-child').trigger('change');

        $(modalName).modal('show');
    });
});

$('#transactions-table .send-estimate').on("click", function(e) {
    e.preventDefault();
    var refnumIndex = $('#transactions-table thead tr td[data-name="No."]').index();
    var emailIndex = $('#transactions-table thead tr td[data-name="Email"]').index();

    var row = $(this).closest('tr');
    var ref_no = $(row.find('td')[refnumIndex]).text().trim();
    var id = row.find('.select-one').val();
    var email = $(row.find('td')[emailIndex]).text().trim();

    $('#send-transaction-email span.modal-title').html('Send email for '+ref_no);
    $('#send-transaction-email #email-to').val(email);
    $('#send-transaction-email #email-subject').val(`Estimate ${ref_no} from ${companyName}`);
    $('#send-transaction-email #email-message').val(`Dear ${customerName.trim()},

Please review the estimate below.  Feel free to contact us if you have any questions.
We look forward to working with you.

Thanks for your business!
${companyName}`);

    $('#send-transaction-email #send-transaction-form').attr('action', `/accounting/customers/send-transaction/estimate/${id}`);
    $('#send-transaction-email #send-transaction-form').attr('method', `post`);
    $('#send-transaction-email').modal('show');
});

$('#transactions-table .delete-invoice').on('click', function(e) {
    e.preventDefault();

    var id = $(this).closest('tr').find('.select-one').val();

    Swal.fire({
        title: 'Delete Invoice',
        text: 'Are you sure you want to delete this invoice?',
        icon: 'question',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonColor: '#2ca01c',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if(result.isConfirmed) {
            $.ajax({
                url: `/accounting/delete-transaction/invoice/${id}`,
                type: 'DELETE',
                success: function(result) {
                    location.reload();
                }
            });
        }
    });
});

$('#transactions-table .void-invoice').on('click', function(e) {
    e.preventDefault();

    var id = $(this).closest('tr').find('.select-one').val();

    Swal.fire({
        title: 'Void Invoice',
        text: 'Are you sure you want to void this invoice?',
        icon: 'question',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonColor: '#2ca01c',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if(result.isConfirmed) {
            $.get('/accounting/void-transaction/invoice/'+id, function(res) {
                location.reload();
            });
        }
    });
});


$('#transactions-table .void-credit-memo').on('click', function(e) {
    e.preventDefault();

    var id = $(this).closest('tr').find('.select-one').val();

    Swal.fire({
        title: 'Void Credit Memo',
        text: 'Are you sure you want to void this credit memo?',
        icon: 'question',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonColor: '#2ca01c',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if(result.isConfirmed) {
            $.get('/accounting/void-transaction/credit-memo/'+id, function(res) {
                location.reload();
            });
        }
    });
});

$('#transactions-table .delete-sales-receipt').on('click', function(e) {
    e.preventDefault();

    var id = $(this).closest('tr').find('.select-one').val();

    Swal.fire({
        title: 'Delete Sales Receipt',
        text: 'Are you sure you want to delete this sales-receipt?',
        icon: 'question',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonColor: '#2ca01c',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if(result.isConfirmed) {
            $.ajax({
                url: `/accounting/delete-transaction/sales-receipt/${id}`,
                type: 'DELETE',
                success: function(result) {
                    location.reload();
                }
            });
        }
    });
});

$('#transactions-table .void-sales-receipt').on('click', function(e) {
    e.preventDefault();

    var id = $(this).closest('tr').find('.select-one').val();

    Swal.fire({
        title: 'Void Sales Receipt',
        text: 'Are you sure you want to void this sales-receipt?',
        icon: 'question',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonColor: '#2ca01c',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if(result.isConfirmed) {
            $.get('/accounting/void-transaction/sales-receipt/'+id, function(res) {
                location.reload();
            });
        }
    });
});

$('#transactions-table .send-sales-receipt').on('click', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    var ref_no = row.find('td:nth-child(4)').text().trim();
    var id = row.find('.select-one').val();
    var email = row.find('td:nth-child(14)').text().trim();

    $('#send-transaction-email span.modal-title').html('Send email for '+ref_no);
    $('#send-transaction-email #email-to').val(email);
    $('#send-transaction-email #email-subject').val(`Sales Receipt #${ref_no} from ${companyName}`);
    $('#send-transaction-email #email-message').val(`Dear ${customerName.trim()},

Please review the sales receipt below.
We appreciate it very much.

Thanks for your business!
${companyName}`);

    $('#send-transaction-email #send-transaction-form').attr('action', `/accounting/customers/send-transaction/sales-receipt/${id}`);
    $('#send-transaction-email #send-transaction-form').attr('method', `post`);
    $('#send-transaction-email').modal('show');
});

$('#transactions-table .send-refund-receipt').on('click', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    var ref_no = row.find('td:nth-child(4)').text().trim();
    var id = row.find('.select-one').val();
    var email = row.find('td:nth-child(14)').text().trim();

    $('#send-transaction-email span.modal-title').html('Send email for '+ref_no);
    $('#send-transaction-email #email-to').val(email);
    $('#send-transaction-email #email-subject').val(`Refund Receipt from ${companyName}`);
    $('#send-transaction-email #email-message').val(`Dear ${customerName.trim()},

Please find your refund receipt attached to this email.

Thank you.

Have a great day!
${companyName}`);

    $('#send-transaction-email #send-transaction-form').attr('action', `/accounting/customers/send-transaction/refund-receipt/${id}`);
    $('#send-transaction-email #send-transaction-form').attr('method', `post`);
    $('#send-transaction-email').modal('show');
});

$('#transactions-table .send-invoice').on('click', function(e) {
    e.preventDefault();
    var refnumIndex = $('#transactions-table thead tr td[data-name="No."]').index();
    var emailIndex = $('#transactions-table thead tr td[data-name="Email"]').index();

    var row = $(this).closest('tr');
    var ref_no = $(row.find('td')[refnumIndex]).text().trim();
    var id = row.find('.select-one').val();
    var email = $(row.find('td')[emailIndex]).text().trim();

    $('#send-transaction-email span.modal-title').html('Send email for '+ref_no);
    $('#send-transaction-email #email-to').val(email);
    $('#send-transaction-email #email-subject').val(`New payment request from ${companyName} - invoice ${ref_no}`);
    $('#send-transaction-email #email-message').val(`Dear ${customerName.trim()},

Here's your invoice! We appreciate your prompt payment.

Thanks for your business!
${companyName}`);

    $('#send-transaction-email #send-transaction-form').attr('action', `/accounting/customers/send-transaction/invoice/${id}`);
    $('#send-transaction-email #send-transaction-form').attr('method', `post`);
    $('#send-transaction-email').modal('show');
});

$('#transactions-table .send-credit-memo').on('click', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    var ref_no = row.find('td:nth-child(4)').text().trim();
    var id = row.find('.select-one').val();
    var email = row.find('td:nth-child(14)').text().trim();

    $('#send-transaction-email span.modal-title').html('Send email for '+ref_no);
    $('#send-transaction-email #email-to').val(email);
    $('#send-transaction-email #email-subject').val(`Credit Memo #${ref_no} from ${companyName}`);
    $('#send-transaction-email #email-message').val(`Dear ${customerName.trim()},

Your credit memo is attached.  We have reduced your account balance by the amount shown on the credit memo.

Have a great day!
${companyName}`);

    $('#send-transaction-email #send-transaction-form').attr('action', `/accounting/customers/send-transaction/credit-memo/${id}`);
    $('#send-transaction-email #send-transaction-form').attr('method', `post`);
    $('#send-transaction-email').modal('show');
});

$('#filter-type').on('change', function() {
    switch($(this).val()) {
        case 'unbilled-income' :
            var date = new Date();
            var dd = String(date.getDate()).padStart(2, '0');
            var mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = date.getFullYear();

            date = mm + '/' + dd + '/' + yyyy;

            $('#filter-date').closest('.row').remove();
            $(`<div class="row">
                <div class="col">
                    <label for="filter-as-of">Unbilled Income As Of</label>
                    <div class="nsm-field-group calendar">
                        <input type="text" name="filter_as_of_date" id="filter-as-of" class="form-control nsm-field date" value="${date}">
                    </div>
                </div>
            </div>`).insertAfter($(this).closest('.row'));

            $('#filter-as-of').datepicker({
                format: 'mm/dd/yyyy',
                orientation: 'bottom',
                autoclose: true
            });
        break;
        case 'recently-paid' :
            $('#filter-date').closest('.row').remove();
            $('#filter-as-of').closest('.row').remove();
        break;
        case 'recurring-templates' :
            $('#filter-date').closest('.row').remove();
            $('#filter-as-of').closest('.row').remove();
        break;
        default :
            $('#filter-as-of').closest('.row').remove();
            if($('#filter-date').length < 1) {
                $(`<div class="row">
                    <div class="col">
                        <label for="filter-date">Date</label>
                        <select class="nsm-field form-select" name="filter_date" id="filter-date" data-applied="all">
                            <option value="all" selected="">All dates</option>
                            <option value="today">Today</option>
                            <option value="yesterday">Yesterday</option>
                            <option value="this-week">This week</option>
                            <option value="this-month">This month</option>
                            <option value="this-quarter">This quarter</option>
                            <option value="this-year">This year</option>
                            <option value="last-week">Last week</option>
                            <option value="last-month">Last month</option>
                            <option value="last-quarter">Last quarter</option>
                            <option value="last-year">Last year</option>
                            <option value="last-365-days">Last 365 days</option>
                        </select>
                    </div>
                </div>`).insertAfter($(this).closest('.row'));

                $('#filter-date').select2({
                    minimumResultsForSearch: -1
                });
            }
        break;
    }
});

$('#transactions-table .edit-recurring-transaction').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var id = row.data().recurring;
    var transactionId = row.find('.select-one').val();
    var type = row.find('td:nth-child(4)').text().trim();

    var modal = '';
    var modalName = '';
    var transactionType = '';

    switch(type) {
        case 'Invoice' :
            transactionType = 'invoice';
            modal = 'invoice';
            modalName = 'invoiceModal';
        break;
        case 'Credit Memo' :
            transactionType = 'credit-memo';
            modal = 'credit_memo';
            modalName = 'creditMemoModal';
        break;
        case 'Sales Receipt' :
            transactionType = 'sales-receipt';
            modal = 'sales_receipt';
            modalName = 'salesReceiptModal';
        break;
        case 'Refund' :
            transactionType = 'refund-receipt';
            modal = 'refund_receipt';
            modalName = 'refundReceiptModal';
        break;
        case 'Credit' :
            transactionType = 'delayed-credit';
            modal = 'delayed_credit';
            modalName = 'delayedCreditModal';
        break;
        case 'Charge' :
            transactionType = 'delayed-charge';
            modal = 'delayed_charge';
            modalName = 'delayedChargeModal';
        break;
    }

    var transactionData = {
        id: transactionId,
        type: transactionType
    };

    $.get(`/accounting/view-transaction/${transactionType}/${transactionId}`, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        initModalFields(modalName, transactionData);

        makeRecurring(modal);

        getRowData(id, modalName);

        $(`#${modalName}`).modal('show');
    });
});

$('#transactions-table .use-recurring-transaction').on('click', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    var transactionId = row.find('.select-one').val();
    var type = row.find('td:nth-child(4)').text().trim();

    var transactionType = '';
    var modalName = '';
    var centerFooter = '';
    switch(type) {
        case 'Invoice' :
            transactionType = 'invoice';
            centerFooter = `<div class="row h-100">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <span><a href="#" class="text-dark" id="save-and-print">Print or Preview</a></span>
                    <span class="mx-3 divider"></span>
                    <span><a href="#" class="text-dark" onclick="makeRecurring('invoice')">Make Recurring</a></span>
                </div>
            </div>`;
            modalName = 'invoiceModal';
        break;
        case 'Credit Memo' :
            transactionType = 'credit-memo';
            centerFooter = `<div class="row h-100">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <span><a href="#" class="text-dark" id="save-and-print">Print or Preview</a></span>
                    <span class="mx-3 divider"></span>
                    <span><a href="#" class="text-dark" onclick="makeRecurring('credit_memo')">Make Recurring</a></span>
                </div>
            </div>`;
            modalName = 'creditMemoModal';
        break;
        case 'Sales Receipt' :
            transactionType = 'sales-receipt';
            centerFooter = `<div class="row h-100">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <span><a href="#" class="text-dark" id="save-and-print">Print or Preview</a></span>
                    <span class="mx-3 divider"></span>
                    <span><a href="#" class="text-dark" onclick="makeRecurring('sales_receipt')">Make Recurring</a></span>
                </div>
            </div>`;
            modalName = 'salesReceiptModal';
        break;
        case 'Refund' :
            transactionType = 'refund-receipt';
            centerFooter = `<div class="row h-100">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <span><a href="#" class="text-dark" id="save-and-print">Print or Preview</a></span>
                    <span class="mx-3 divider"></span>
                    <span><a href="#" class="text-dark" onclick="makeRecurring('refund_receipt')">Make Recurring</a></span>
                </div>
            </div>`;
            modalName = 'refundReceiptModal';
        break;
        case 'Credit' :
            transactionType = 'delayed-credit';
            centerFooter = `<a href="#" class="text-dark m-auto" onclick="makeRecurring('delayed_credit')">Make Recurring</a>`;
            modalName = 'delayedCreditModal';
        break;
        case 'Charge' :
            transactionType = 'delayed-charge';
            centerFooter = `<a href="#" class="text-dark m-auto" onclick="makeRecurring('delayed_charge')">Make Recurring</a>`;
            modalName = 'delayedChargeModal';
        break;
    }

    var transactionData = {
        id: transactionId,
        type: transactionType
    };

    $.get(`/accounting/view-transaction/${transactionType}/${transactionId}`, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        initModalFields(modalName, transactionData);

        $('#billModal .payee-details .transaction-total-amount').parent().next().remove();
        $(`#${modalName} .modal-footer .row .col-md-4:nth-child(2)`).html(centerFooter);

        if($(`#${modalName} .modal-footer .row .col-md-4:nth-child(2)`).children('div:first-child()').hasClass('row') === false) {
            $(`#${modalName} .modal-footer .row .col-md-4:nth-child(2)`).addClass('d-flex');
        }

        $(`#${modalName} .modal-header .modal-title span`).html('');
        $(`#${modalName}`).parent().attr('onsubmit', 'submitModalForm(event, this)').removeAttr('data-href');

        $(`#${modalName}`).modal('show');
    });
});

$('#transactions-table .delete-recurring-transaction').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');

    Swal.fire({
        title: 'Are you sure you want to delete this?',
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
				url: `/accounting/recurring-transactions/delete/${row.data().recurring}`,
				type: 'DELETE',
				success: function(result) {
                    location.reload();
				}
			});
        }
    });
});

$('#transactions-table thead .select-all').on('change', function() {
    $('#transactions-table tbody tr:visible .select-one').prop('checked', $(this).prop('checked')).trigger('change');
});

$(document).on('change', '#transactions-table tbody tr:visible .select-one', function() {
    var checked = $('#transactions-table tbody tr:visible .select-one:checked').length;
    var rows = $('#transactions-table tbody tr:visible .select-one').length;

    $('#transactions-table thead .select-all').prop('checked', checked === rows);

    var printable = true;
    var sendableReminder = true;

    var printableTypes = [
        'Invoice',
        'Estimate',
        'Credit Memo',
        'Sales Receipt',
        'Refund'
    ];

    var invoiceOpenNotStatus = [
        'Draft',
        'Declined',
        'Paid'
    ];

    $('#transactions-table tbody tr:visible .select-one:checked').each(function() {
        var statusIndex = $('#transactions-table thead tr td[data-name="Status"]').index();
        var row = $(this).closest('tr');
        var type = row.find('td:nth-child(3)').text().trim();
        var status = $(row.find('td')[statusIndex]).text().trim();

        if(printableTypes.includes(type) === false) {
            printable = false;
        }

        if(type === 'Invoice' && invoiceOpenNotStatus.includes(status) || type !== 'Invoice') {
            sendableReminder = false;
        }
    });

    if(printable && checked > 0) {
        $('#print-transactions').removeClass('disabled');
        $('#send-transactions').removeClass('disabled');
    } else {
        $('#print-transactions').addClass('disabled');
        $('#send-transactions').addClass('disabled');
    }

    if(sendableReminder && checked > 0) {
        $('#send-reminders').removeClass('disabled');
    } else {
        $('#send-reminders').addClass('disabled');
    }
});

$('#send-transactions').on('click', function(e) {
    var data = new FormData();

    $('#transactions-table tbody .select-one:checked').each(function() {
        var row = $(this).closest('tr');
        var id = $(this).val();
        var typeIndex = $('#transactions-table thead tr td[data-name="Type"]').index();
        var type = $(row.find('td')[typeIndex]).text().trim().toLowerCase();

        data.append('transactions[]', `${type.replaceAll(' ', '_')}-${id}`);
    });

    $.ajax({
        url: `/accounting/send-sales-transactions`,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            var res = JSON.parse(result);

            Swal.fire({
                text: res.message,
                icon: res.success ? 'success' : 'error',
                showConfirmButton: false,
                showCloseButton: true,
                timer: 1500
            })
        }
    });
});

$('#print-transactions').on('click', function(e) {
    if($('#print-transactions-form').length < 1) {
        $('body').append(`<form action="/accounting/print-sales-transactions" method="post" id="print-transactions-form" target="_blank"></form>`);
    }

    $('#transactions-table tbody .select-one:checked').each(function() {
        var row = $(this).closest('tr');
        var id = $(this).val();
        var typeIndex = $('#transactions-table thead tr td[data-name="Type"]').index();
        var type = $(row.find('td')[typeIndex]).text().trim().toLowerCase();

        $('#print-transactions-form').append(`<input type="hidden" name="transactions[]" value="${type.replaceAll(' ', '_')}-${id}">`);
    });

    $('#print-transactions-form').submit();
    $('#print-transactions-form').remove();
});

$('#send-reminders').on('click', function(e) {
    var data = new FormData();

    $('#transactions-table tbody .select-one:checked').each(function() {
        var id = $(this).val();

        data.append('invoices[]', id);
    });

    $.ajax({
        url: `/accounting/send-invoice-reminders`,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            var res = JSON.parse(result);

            Swal.fire({
                text: res.message,
                icon: res.success ? 'success' : 'error',
                showConfirmButton: false,
                showCloseButton: true,
                timer: 1500
            })
        }
    });
});

function getRowData(id, modalName)
{
    $.get(`/accounting/recurring-transactions/get-details/${id}`, function(res) {
        var result = JSON.parse(res);

        if(result.success === false) {
            $.toast({
                icon: result.success ? 'success' : 'error',
                heading: result.success ? 'Success' : 'Error',
                text: result.message,
                showHideTransition: 'fade',
                hideAfter: 3000,
                allowToastClose: true,
                position: 'top-center',
                stack: false,
                loader: false,
            });
        } else {
            var data = result.data;

            set_modal_data(data, modalName);
        }
    });
}

function set_modal_data(data, modalName)
{
    var txnType = data.txn_type.replaceAll(" ", "-");
    $(`#${modalName}`).parent('form').removeAttr('onsubmit').attr('id', 'update-recurring-form').attr('data-href', `/accounting/recurring-transactions/update/${txnType}/${data.id}`);

    $(`#${modalName} #templateName`).val(data.template_name);
    $(`#${modalName} #recurringType`).val(data.recurring_type).trigger('change');
    $(`#${modalName} #dayInAdvance`).val(data.days_in_advance);

    if(data.recurring_interval !== null) {
        $(`#${modalName} #recurringInterval`).val(data.recurring_interval).trigger('change');
    }

    if(data.recurring_week !== null) {
        $(`#${modalName} select[name="recurring_week"]`).val(data.recurring_week).trigger('change');
    }

    if(data.recurring_day !== null) {
        $(`#${modalName} select[name="recurring_day"]`).val(data.recurring_day);
    }

    if(data.recurring_month !== null) {
        $(`#${modalName} select[name="recurring_month"]`).val(data.recurring_month);
    }

    if(data.recurr_every !== null) {
        $(`#${modalName} input[name="recurr_every"]`).val(data.recurr_every);
    }

    if(data.start_date !== null && data.start_date !== "") {
        var start_date = new Date(data.start_date);
        $(`#${modalName} #startDate`).val(`${String(start_date.getMonth() + 1).padStart(2, '0')}/${String(start_date.getDate()).padStart(2, '0')}/${start_date.getFullYear()}`);
    }

    if(data.end_type !== null) {
        $(`#${modalName} #endType`).val(data.end_type).trigger('change');
    }

    if(data.end_by !== null && data.end_type === 'by') {
        var end_date = new Date(data.end_date);
        $(`#${modalName} #endDate`).val(`${String(end_date.getMonth() + 1).padStart(2, '0')}/${String(end_date.getDate()).padStart(2, '0')}/${end_date.getFullYear()}`);
    }

    if(data.max_occurences !== null && data.end_type === 'after') {
        $(`#${modalName} #maxOccurence`).val(data.max_occurences);
    }
}