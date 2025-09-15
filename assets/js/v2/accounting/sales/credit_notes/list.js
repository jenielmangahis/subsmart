$('.dropdown-menu.table-settings, .dropdown-menu.table-filter').on('click', function(e) {
    e.stopPropagation();
});

$("#credit-notes-table").nsmPagination({
    itemsPerPage: 10
});

$('.dropdown-menu#table-rows a.dropdown-item').on('click', function() {
    var count = $(this).html();
    $('.dropdown-menu#table-rows a.dropdown-item.active').removeClass('active');
    $(this).addClass('active');

    $(this).parent().parent().prev().find('span').html(count);
    $('.dropdown-menu#table-rows').prev().dropdown('toggle');

    $("#credit-notes-table").nsmPagination({
        itemsPerPage: parseInt(count)
    });
});

$('.table-filter select:not(#filter-customer)').select2({
    minimumResultsForSearch: -1
});

$('#filter-customer').select2({
    ajax: {
        url: base_url + 'accounting/get-dropdown-choices',
        dataType: 'json',
        data: function(params) {
            var query = {
                search: params.term,
                type: 'public',
                field: 'customer',
                for: 'filter'
            }

            // Query parameters will be ?search=[term]&type=public&field=[type]
            return query;
        }
    },
    templateResult: formatResult,
    templateSelection: optionSelect
});

$(function() {
    $('.datepicker').datepicker({
        format: 'mm/dd/yyyy',
        orientation: 'bottom',
        autoclose: true
    });
});

$('#filter-date').on('change', function() {
    switch($(this).val()) {
        case 'last-365-days' :
            var date = new Date();
            date.setDate(date.getDate() - 365);

            var from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
            var to_date = '';
        break;
        case 'custom' :
            var from_date = $('#filter-from').val();
            var to_date = $('#filter-to').val();
        break;
        case 'today' :
            var date = new Date();
            var from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
            var to_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
        break;
        case 'yesterday' :
            var date = new Date();
            date.setDate(date.getDate() - 1);
            var from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
            var to_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
        break;
        case 'this-week' :
            var date = new Date();
            var from = date.getDate() - date.getDay();
            var to = from + 6;

            var from_date = new Date(date.setDate(from));
            var to_date = new Date(date.setDate(to));

            from_date = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
            to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
        break;
        case 'this-month' :
            var date = new Date();
            var to_date = new Date(date.getFullYear(), date.getMonth() + 1, 0);

            from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
        break;
        case 'this-quarter' :
            var date = new Date();
            var currQuarter = Math.floor(date.getMonth() / 3 + 1);
            
            switch(currQuarter) {
                case 1 :
                    var from_date = '01/01/' + date.getFullYear();
                    var to_date = '03/31/'+ date.getFullYear();
                break;
                case 2 :
                    var from_date = '04/01/' + date.getFullYear();
                    var to_date = '06/30/'+ date.getFullYear();
                break;
                case 3 :
                    var from_date = '07/01/' + date.getFullYear();
                    var to_date = '09/30/'+ date.getFullYear();
                break;
                case 4 :
                    var from_date = '10/01/' + date.getFullYear();
                    var to_date = '12/31/'+ date.getFullYear();
                break;
            }
        break;
        case 'this-year' :
            var date = new Date();

            var from_date = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            var to_date = String(12).padStart(2, '0') + '/' + String(31).padStart(2, '0') + '/' + date.getFullYear();
        break;
        case 'last-week' :
            var date = new Date();
            var from = date.getDate() - date.getDay();

            var from_date = new Date(date.setDate(from - 7));
            var to_date = new Date(date.setDate(date.getDate() + 6));

            from_date = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
            to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
        break;
        case 'last-month' :
            var date = new Date();
            var to_date = new Date(date.getFullYear(), date.getMonth(), 0);

            from_date = String(date.getMonth()).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
        break;
        case 'last-quarter' :
            var date = new Date();
            var currQuarter = Math.floor(date.getMonth() / 3 + 1);
            
            switch(currQuarter) {
                case 1 :
                    var from_date = new Date('01/01/' + date.getFullYear());
                    var to_date = new Date('03/31/'+ date.getFullYear());
                break;
                case 2 :
                    var from_date = new Date('04/01/' + date.getFullYear());
                    var to_date = new Date('06/30/'+ date.getFullYear());
                break;
                case 3 :
                    var from_date = new Date('07/01/' + date.getFullYear());
                    var to_date = new Date('09/30/'+ date.getFullYear());
                break;
                case 4 :
                    var from_date = new Date('10/01/' + date.getFullYear());
                    var to_date = new Date('12/31/'+ date.getFullYear());
                break;
            }

            from_date.setMonth(from_date.getMonth() - 3);
            to_date.setMonth(to_date.getMonth() - 3);

            if(to_date.getDate() === 1) {
                to_date.setDate(to_date.getDate() - 1);
            }

            from_date = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
            to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
        break;
        case 'last-year' :
            var date = new Date();
            date.setFullYear(date.getFullYear() - 1);

            var from_date = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            var to_date = String(12).padStart(2, '0') + '/' + String(31).padStart(2, '0') + '/' + date.getFullYear();
        break;
        default :
            var from_date = '';
            var to_date = '';
        break;
    }

    $('#filter-from').val(from_date);
    $('#filter-to').val(to_date);
});

$('#reset-button').on('click', function() {
    var url = `${base_url}accounting/credit-notes`;
    location.href = url;
});

$('#apply-button').on('click', function() {
    var selected = $('.nsm-counter.selected');

    var filterDate = $('#filter-date-credit-notes').val();
    var filterFrom = $('#filter-from').val();
    var filterTo = $('#filter-to').val();
    var filterCustomer = $('#filter-customer').val();

    var url = `${base_url}accounting/credit-notes?`;

    url += filterDate !== 'last-365-days' ? `date=${filterDate}&` : '';
    url += filterDate !== 'last-365-days' ? `from=${filterFrom.replaceAll('/', '-')}&` : '';
    url += filterDate !== 'last-365-days' ? `to=${filterTo.replaceAll('/', '-')}&` : '';
    url += filterCustomer !== 'all' ? `customer=${filterCustomer}` : '';

    if(url.slice(-1) === '?' || url.slice(-1) === '&' || url.slice(-1) === '#') {
        url = url.slice(0, -1); 
    }
    location.href = url;
});

$('#new-credit-note').on('click', function() {
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

        modalName = '#creditMemoModal';
        initModalFields('creditMemoModal');

        $('#creditMemoModal').modal('show');
    });
});

$('.dropdown-menu.table-settings input[name="col_chk"]').on('change', function() {
    var chk = $(this);
    var dataName = $(this).next().text();

    var index = $(`#credit-notes-table thead td[data-name="${dataName}"]`).index();
    $(`#credit-notes-table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });

    $(`#print_credit_notes_modal table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });

    $(`#print_preview_credit_notes_modal #credit_notes_table_print tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });
});

$("#btn_print_credit_notes").on("click", function() {
    $("#credit_notes_table_print").printThis();
});

$('.export-transactions').on('click', function() {
    if($('#export-form').length < 1) {
        $('body').append(`<form action="/accounting/credit-notes/export" method="post" id="export-form"></form>`);
    }

    var fields = $('#credit-notes-table thead tr td:not(:first-child, :last-child)');
    fields.each(function() {
        $('#export-form').append(`<input type="hidden" name="fields[]" value="${$(this).attr('data-name')}">`);
    });

    var currentUrl = window.location.href.replace('#', '');
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
    $('#export-form').remove();
});

$("#credit-notes-table .copy-transaction").on("click", function (e) {
    e.preventDefault();
  
    var row = $(this).closest("tr");
    var id = row.find(".select-one").val();
    var transactionType = row.find("td:nth-child(3)").text().trim();
    transactionType = transactionType.replaceAll(" ", "-");
    transactionType = transactionType.toLowerCase();
  
    var data = {
      id: id,
      type: row.find("td:nth-child(3)").text().trim(),
    };
  
    $.get(base_url + `accounting/copy-transaction/${transactionType}/${id}`,
      function (res) {
        if ($("div#modal-container").length > 0) {
          $("div#modal-container").html(res);
        } else {
          $("body").append(`
                  <div id="modal-container">
                      ${res}
                  </div>
              `);
        }
  
        $("#modal-container form .modal")
          .parent()
          .attr("onsubmit", "submitModalForm(event, this)")
          .removeAttr("data-href");
  
        modalName = "#" + $("#modal-container form .modal").attr("id");
        initModalFields($("#modal-container form .modal").attr("id"), data);
  
        $(modalName).modal("show");
      }
    );
});

$("#credit-notes-table .view-edit-credit-memo").on("click", function (e) {
    e.preventDefault();
  
    var row = $(this).closest("tr");
    var id = row.find(".select-one").val();
    var transactionType = row.find("td:nth-child(3)").text().trim();
    transactionType = transactionType.replaceAll(" ", "-");
    transactionType = transactionType.toLowerCase();
  
    var data = {
      id: id,
      type: row.find("td:nth-child(3)").text().trim(),
    };
  
    $.get(base_url + "accounting/view-transaction/credit-memo/" + id, function (res) {
        if ($("div#modal-container").length > 0) {
            $("div#modal-container").html(res);
        } else {
            $("body").append(`
                    <div id="modal-container"> 
                        ${res}
                    </div>
                `);
        }

        modalName = "#creditMemoModal";
        initModalFields("creditMemoModal", data);

        $("#creditMemoModal").modal("show");
    });

});

$("#credit-notes-table .void-credit-memo").on("click", function (e) {
    e.preventDefault();
  
    var id = $(this).closest("tr").find(".select-one").val();
  
    Swal.fire({
      title: "Void Credit Memo",
      text: "Are you sure you want to void this credit memo?",
      icon: "question",
      confirmButtonText: "Yes",
      showCancelButton: true,
      cancelButtonText: "No",
      confirmButtonColor: "#2ca01c",
      cancelButtonColor: "#d33",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
            type: 'GET',
            url: base_url + 'accounting/void-transaction/credit-memo/' + id,
            dataType: "JSON",
            success: function(result) {
                if (result.success) {
                    Swal.fire({
                        title: "Void Credit Memo",
                        html: "Data was successfully updated!",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            location.reload();
                        //}
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: result.message,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    });
                }                
            },
            beforeSend: function(){
                Swal.fire({
                    icon: "info",
                    title: "Processing",
                    html: "Please wait while the process is running...",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                });
            }
        });
      }
    });
});

$("#credit-notes-table .send-credit-memo").on("click", function (e) {
e.preventDefault();
var refnumIndex = $(
    '#credit-notes-table thead tr td[data-name="No."]'
).index();
var emailIndex = $(
    '#credit-notes-table thead tr td[data-name="Email"]'
).index();
var customerIndex = $(
    '#credit-notes-table thead tr td[data-name="Customer"]'
).index();

var row = $(this).closest("tr");
var ref_no = $(row.find("td")[refnumIndex]).text().trim();
var id = row.find(".select-one").val();
var email = $(row.find("td")[emailIndex]).text().trim();
var customerName = $(row.find("td")[customerIndex]).text().trim();
var companyName = $(this).attr('data-company');

$("#send-transaction-email span.modal-title").html(
    "Send email to " + customerName
);
$("#send-transaction-email #email-to").val(email);

if( ref_no != '---' ){
    var subject = `Credit Memo #${ref_no} from ${companyName}`;
}else{
    var subject = `Credit Memo from ${companyName}`
}
$("#send-transaction-email #email-subject").val(subject);
$("#send-transaction-email #email-message").val(`Dear ${customerName.trim()},

Your credit memo is attached.  We have reduced your account balance by the amount shown on the credit memo.

Have a great day!
${companyName}`);

$("#send-transaction-email #send-transaction-form").attr(
    "action",
    `${base_url}accounting/customers/send-transaction/credit-memo/${id}`
);
$("#send-transaction-email #send-transaction-form").attr("method", `post`);
$("#send-transaction-email").modal("show");
});

