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

$('.dropdown-menu.table-settings, .dropdown-menu.p-3').on('click', function(e) {
    e.stopPropagation();
});

$('#filter-type, #filter-date').select2({
    minimumResultsForSearch: -1
});

$('#apply-button').on('click', function() {
    var filterType = $('#filter-type').val();
    var filterDate = $('#filter-date').val();

    var url = `${base_url}accounting/customers/view/${customerId}?`;

    url += filterType !== 'all' ? `type=${filterType}&` : '';
    url += filterDate !== 'all' ? `date=${filterDate}` : '';

    if(url.slice(-1) === '?' || url.slice(-1) === '&' || url.slice(-1) === '#') {
        url = url.slice(0, -1); 
    }
    location.href = url;
});

$('#reset-button').on('click', function() {
    var url = `${base_url}accounting/customers/view/${customerId}`;
    location.href = url;
});

$('#filter-type').on('change', function() {
    var dateFilter = `<div class="row">
        <div class="col">
            <label for="filter-date">Date</label>
            <select class="nsm-field form-select" name="filter_date" id="filter-date" data-applied="all">
                <option value="all">All dates</option>
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
    </div>`;

    switch($(this).val()) {
        case 'all' :
            if($('#filter-date').length < 1) {
                $(dateFilter).insertAfter($(this).closest('.row'));

                $('#filter-date').select2({
                    minimumResultsForSearch: -1
                });
            }
        break;
        case 'all-plus-deposits' :
            if($('#filter-date').length < 1) {
                $(dateFilter).insertAfter($(this).closest('.row'));

                $('#filter-date').select2({
                    minimumResultsForSearch: -1
                });
            }
        break;
        case 'all-invoices' :
            if($('#filter-date').length < 1) {
                $(dateFilter).insertAfter($(this).closest('.row'));

                $('#filter-date').select2({
                    minimumResultsForSearch: -1
                });
            }
        break;
        case 'open-invoices' :
            if($('#filter-date').length < 1) {
                $(dateFilter).insertAfter($(this).closest('.row'));

                $('#filter-date').select2({
                    minimumResultsForSearch: -1
                });
            }
        break;
        case 'overdue-invoices' :
            if($('#filter-date').length < 1) {
                $(dateFilter).insertAfter($(this).closest('.row'));

                $('#filter-date').select2({
                    minimumResultsForSearch: -1
                });
            }
        break;
        case 'open-estimates' :
            if($('#filter-date').length < 1) {
                $(dateFilter).insertAfter($(this).closest('.row'));

                $('#filter-date').select2({
                    minimumResultsForSearch: -1
                });
            }
        break;
        case 'credit-memos' :
            if($('#filter-date').length < 1) {
                $(dateFilter).insertAfter($(this).closest('.row'));

                $('#filter-date').select2({
                    minimumResultsForSearch: -1
                });
            }
        break;
        case 'unbilled-income' :
            
        break;
        case 'recently-paid' :
            $('#filter-date').closest('.row').remove();
        break;
        case 'money-received' :
            if($('#filter-date').length < 1) {
                $(dateFilter).insertAfter($(this).closest('.row'));

                $('#filter-date').select2({
                    minimumResultsForSearch: -1
                });
            }
        break;
        case 'recurring-templates' :
            $('#filter-date').closest('.row').remove();
        break;
        case 'statements' :
            if($('#filter-date').length < 1) {
                $(dateFilter).insertAfter($(this).closest('.row'));

                $('#filter-date').select2({
                    minimumResultsForSearch: -1
                });
            }
        break;
    }
});

$(document).on('click', '#transactions-table .view-edit-invoice', function() {
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get('/accounting/view-transaction/invoice/'+id, function(res) {
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

$(document).on('click', '#transactions-table .view-edit-estimate', function() {
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get('/accounting/view-transaction/estimate/'+id, function(res) {
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

$(document).on('click', '#transactions-table .view-edit-credit-memo', function() {
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get('/accounting/view-transaction/credit-memo/'+id, function(res) {
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

$(document).on('click', '#transactions-table .view-edit-sales-receipt', function() {
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get('/accounting/view-transaction/sales-receipt/'+id, function(res) {
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

$(document).on('click', '#transactions-table .view-edit-refund-receipt', function() {
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

$(document).on('click', '#transactions-table .view-edit-delayed-credit', function() {
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

$(document).on('click', '#transactions-table .view-edit-delayed-charge', function() {
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

$(document).on('click', '#transactions-table .update-estimate-status', function() {
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

    var fields = $('.dropdown-menu.table-settings input[name="col_chk"]:checked');
    fields.each(function() {
        $('#export-form').append(`<input type="hidden" name="fields[]" value="${$(this).attr('id').replace('chk_', '')}">`);
    });
    $('#export-form').append(`<input type="hidden" name="type" value="${$('#filter-type').attr('data-applied')}">`);
    $('#export-form').append(`<input type="hidden" name="date" value="${$('#filter-date').attr('data-applied')}">`);

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