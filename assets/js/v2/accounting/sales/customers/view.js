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