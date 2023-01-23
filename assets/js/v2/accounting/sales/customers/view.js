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

$('#edit-customer-modal select:not(.select2-hidden-accessible)').select2({
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