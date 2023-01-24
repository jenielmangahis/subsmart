import("/assets/js/customer/components/FieldCustomName.js");
$('.dropdown-menu.table-settings, .dropdown-menu.table-filter').on('click', function(e) {
    e.stopPropagation();
});

$("#customers-table").nsmPagination({
    itemsPerPage: parseInt($('#table-rows li a.active').html().trim())
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
        $('#email').removeClass('disabled');
    } else {
        $('#email').addClass('disabled');
    }

    $('#email').attr('href', href);
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
            // document.getElementById('overlay').style.display = "none";
            if(data.success){
                sucess("New Customer has been Added Successfully!",data.profile_id);
            }else{
                error(data.message);
            }
        },error: function (xhr, ajaxOptions, thrownError, data) {
            // document.getElementById('overlay').style.display = "none";
            Swal.fire({
                text: 'Customer profile was successfully updated!',
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value) {
                    // window.location.href=`${base_url}accounting/customers`;
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