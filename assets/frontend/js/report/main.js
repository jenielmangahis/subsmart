var base_url = document.getElementById('siteurl').value;

var options = {
  urlFilterReports: base_url + "reports/filterReports",
  urlFilterProfitLoss: base_url + "reports/profitLoss",
  urlFilterPaymentByMethod: base_url + "reports/paymentByMethod",
  urlFilterPaymentByMonth: base_url + "reports/paymentByMonth",
  urlFilterAccountReceivable: base_url + "reports/accountReceivable",
  urlFilterAccountReceivableResCom: base_url + "reports/accountReceivableResCom",
  urlFilterInvoiceByDate_OLD: base_url + "reports/invoiceByDate",
  urlFilterPaymentByCustomer: base_url + "reports/paymentByCustomer",
  urlFilterPaymentByItem: base_url + "reports/paymentByItem",
  urlFilterPaymentByCustomerGroup: base_url + "reports/paymentByCustomerGroup",
  urlFilterCustomerSource: base_url + "reports/customerSource",
  urlFilterCustomerBySource: base_url + "reports/customerBySource",
  urlFilterCustomerSales: base_url + "reports/customerSales",
  urlReportPreview: base_url + "reports/preview",
  //updates
  urlFilterReportsExpenseByCategory: base_url + "reports/expenseByCategory",
  urlFilterInvoiceByDate: base_url + "reports/invoiceByDate",
  urlfilterWorkOrderByEmployee: base_url + "reports/workOrderByEmployee",
  urlfilterWorkOrderByStatus: base_url + "reports/workOrderByStatus",
  filterCustomerTaxByMonth: base_url + "reports/customerTaxByMonth",

};

function selectReport(startdate, endDate) {
  var type = window.location.pathname.split("/");

  switch (type[5]) {
    case "monthly-closeout":
      filterReportsByMonths(startdate, endDate);
      break;

    case "yearly-closeout":
      filterReportsByMonths(startdate, endDate);
      break;

    case "profit-loss":
      filterReportsProfitLoss(startdate, endDate);
      break;

    case "payment-by-method":
      filterReportsByPaymentMethod(startdate, endDate);
      break;

    case "payment-by-month":
      filterReportsByPaymentMonth(startdate, endDate);
      break;

    case "account-receivable":
      filterReportsByAccountReceivable(startdate, endDate);
      break;

    case "invoice-by-date":
      filterReportsByInvoiceByDate(startdate, endDate);
      break;

    case "account-receivable-com-vs-res":
      filterReportsByAccountReceivableResCom(startdate, endDate);
      break;

    case "payment-by-customer":
      filterReportsPaymentByCustomer(startdate, endDate);
      break;

    case "payment-by-item":
      filterReportsPaymentByItem(startdate, endDate);
      break;

    case "payment-by-customer-group":
      filterReportsPaymentByCustomerGroup(startdate, endDate);
      break;

    case "customer-source":
      filterReportsCustomerSource(startdate, endDate);
      break;

    case "customer-by-source":
      filterReportsCustomerBySource();
      break;

    case "customer-sales":
      filterReportsCustomerSales(startdate, endDate);
      break;

    case "expense-by-category":
      filterReportsExpenseByCategory(startdate, endDate);
      break;

    case "work-order-by-employee":
      filterWorkOrderByEmployee(startdate, endDate);
      break;

    case "work-order-status":
      filterWorkOrderByStatus(startdate, endDate);
      break;
    
    case "customer-tax-by-month":
      filterCustomerTaxByMonth(startdate, endDate);
      break;

  }
}

function filterReportsByMonths(startDate, endDate) {
  $.ajax({
    url: options.urlFilterReports,
    type: "GET",
    data: { startDate: startDate, endDate: endDate },
    beforeSend: function () {
      $(".loader").show();
      $("#reportTable").fadeOut();
    },
    success: function (response) {
      var obj = JSON.parse(response);
      $("#tableToListReport tbody").empty();
      obj.monthly.forEach(monthlyCloseout);

      $(".loader").fadeOut();
      $("#reportTable").fadeIn();
    },
  });
}

function monthlyCloseout(item) {
  $("#tableToListReport").append(
    "<tr><td>" +
      item[0] +
      "</td>" +
      "<td class='text-right'>" +
      item[1] +
      "</td>" +
      "<td class='text-right'>" +
      item[2] +
      "</td>" +
      "<td class='text-right'>" +
      item[3] +
      "</td>" +
      "<td class='text-right'>" +
      item[4] +
      "</td>" +
      "<td class='text-right'>" +
      item[5] +
      "</td>" +
      "<td class='text-right'>" +
      item[6] +
      "</td>" +
      "<td class='text-right'>" +
      item[7] +
      "</td>" +
      "<td class='text-right'>" +
      item[8] +
      "</<td>" +
      "<td class='text-right'>" +
      item[9] +
      "</td></tr>"
  );
}

function filterReportsByInvoiceByDate(startDate, endDate) {
  $.ajax({
    url: options.urlFilterInvoiceByDate,
    type: "GET",
    data: { startDate: startDate, endDate: endDate },
    success: function (response) {
      var obj = JSON.parse(response);
      $("#tableToListReport tbody").empty();
      obj.forEach(invoiceByDateAppend);
    },
  });
}

function filterReportsByAccountReceivable(startDate, endDate) {
  $.ajax({
    url: options.urlFilterAccountReceivable,
    type: "GET",
    data: { startDate: startDate, endDate: endDate },
    success: function (response) {
      var obj = JSON.parse(response);
      $("#tableToListReport tbody").empty();
      obj.forEach(accountReceivableAppend);
    },
  });
}

function filterReportsPaymentByCustomer(startDate, endDate) {
  $.ajax({
    url: options.urlFilterPaymentByCustomer,
    type: "GET",
    data: { startDate: startDate, endDate: endDate },
    success: function (response) {
      var obj = JSON.parse(response);
      $("#tableToListReport tbody").empty();
      obj.forEach(paymentByCustomerAppend);
    },
  });
}

function filterReportsPaymentByItem(startDate, endDate) {
  $.ajax({
    url: options.urlFilterPaymentByItem,
    type: "GET",
    data: { startDate: startDate, endDate: endDate },
    success: function (response) {
      var obj = JSON.parse(response);
      $("#tableToListReport tbody").empty();
      obj.forEach(paymentByItemAppend);
    },
  });
}

function filterReportsPaymentByCustomerGroup(startDate, endDate) {
  $.ajax({
    url: options.urlFilterPaymentByCustomerGroup,
    type: "GET",
    data: { startDate: startDate, endDate: endDate },
    success: function (response) {
      var obj = JSON.parse(response);
      $("#tableToListReport tbody").empty();
      obj.forEach(paymentByCustomerGroupAppend);
    },
  });
}

function filterReportsCustomerSource(startDate, endDate) {
  $.ajax({
    url: options.urlFilterCustomerSource,
    type: "GET",
    data: { startDate: startDate, endDate: endDate },
    success: function (response) {
      var obj = JSON.parse(response);
      $("#tableToListReport tbody").empty();
      obj.forEach(customerSourceAppend);
    },
  });
}

function filterReportsCustomerBySource() {
  $.ajax({
    url: options.urlFilterCustomerBySource,
    type: "GET",
    success: function (response) {
      var obj = JSON.parse(response);
      $("#tableToListReport tbody").empty();
      obj.forEach(customerBySourceAppend);
    },
  });
}

function filterReportsCustomerSales(startDate, endDate) {
  $.ajax({
    url: options.urlFilterCustomerSales,
    type: "GET",
    data: { startDate: startDate, endDate: endDate },
    success: function (response) {
      var obj = JSON.parse(response);
      $("#tableToListReport tbody").empty();
      obj.forEach(customerSalesAppend);
    },
  });
}

function filterReportsByAccountReceivableResCom(startDate, endDate) {
  $.ajax({
    url: options.urlFilterAccountReceivableResCom,
    type: "GET",
    data: { startDate: startDate, endDate: endDate },
    success: function (response) {
      var obj = JSON.parse(response);
      $("#tableToListReport tbody").empty();
      obj.forEach(accountReceivableResComAppend);
    },
  });
}

function filterReportsByPaymentMonth(startDate, endDate) {
  $.ajax({
    url: options.urlFilterPaymentByMonth,
    type: "GET",
    data: { startDate: startDate, endDate: endDate },
    success: function (response) {
      var obj = JSON.parse(response);
      $("#tableToListReport tbody").empty();
      obj.forEach(paymentByMonthAppend);
    },
  });
}

//updates
function filterReportsExpenseByCategory(startDate, endDate) {
  $.ajax({
    url: options.urlFilterReportsExpenseByCategory,
    type: "GET",
    data: { startDate: startDate, endDate: endDate },
    success: function (response) {
      var obj = JSON.parse(response);
      $("#tableToListReport tbody").empty();
      obj.forEach(expenseByCategoryAppend);
    },
  });
}

function filterInvoiceByDate(startDate, endDate) {
  $.ajax({
    url: options.urlFilterInvoiceByDate,
    type: "GET",
    data: { startDate: startDate, endDate: endDate },
    success: function (response) {
      var obj = JSON.parse(response);
      $("#tableToListReport tbody").empty();
      obj.forEach(InvoiceByDateAppend);
    },
  });
}

function filterWorkOrderByEmployee(startDate, endDate) {
  $.ajax({
    url: options.urlfilterWorkOrderByEmployee,
    type: "GET",
    data: { startDate: startDate, endDate: endDate },
    success: function (response) {
      var obj = JSON.parse(response);
      $("#tableToListReport tbody").empty();
      obj.forEach(workOrderByEmployeeAppend);
    },
  });
}

function filterWorkOrderByStatus(startDate, endDate) {
  $.ajax({
    url: options.urlfilterWorkOrderByStatus,
    type: "GET",
    data: { startDate: startDate, endDate: endDate },
    success: function (response) {
      var obj = JSON.parse(response);
      $("#tableToListReport tbody").empty();
      obj.forEach(workOrderByStatusAppend);
    },
  });
}

function filterCustomerTaxByMonth(startDate, endDate) {
  $.ajax({
    url: options.urlfilterCustomerTaxByMonth,
    type: "GET",
    data: { startDate: startDate, endDate: endDate },
    success: function (response) {
      var obj = JSON.parse(response);
      $("#tableToListReport tbody").empty();
      obj.forEach(customerTaxByMonthAppend);
    },
  });
}





function invoiceByDateAppend(item) {
  var myString = item[0];
  var lastChar = myString.charAt(3);

  if (item[2] == "") {
    $("#tableToListReport").append(
      "<tr style='background-color:#ededed; font-weight:bold'><td class='tr--primary tr--bold'>" +
        item[0] +
        "</td>" +
        "<td>" +
        item[1] +
        "<br>" +
        item[2] +
        "</td>" +
        "<td  class='text-right'>" +
        item[3] +
        "</td>" +
        "<td class='text-right'>" +
        item[4] +
        "</td>" +
        "<td class='text-right'>" +
        item[5] +
        "</td>" +
        "<td class='text-right'>" +
        item[6] +
        "</td>" +
        "<td class='text-right'>" +
        item[7] +
        "</td></tr>"
    );
  } else {
    $("#tableToListReport").append(
      "<tr><td class='tr--primary tr--bold'>" +
        item[0] +
        "</td>" +
        "<td>" +
        item[1] +
        "<br>" +
        item[2] +
        "</td>" +
        "<td  class='text-right'>" +
        item[3] +
        "</td>" +
        "<td class='text-right'>" +
        item[4] +
        "</td>" +
        "<td class='text-right'>" +
        item[5] +
        "</td>" +
        "<td class='text-right'>" +
        item[6] +
        "</td>" +
        "<td class='text-right'>" +
        item[7] +
        "</td></tr>"
    );
  }
}

function accountReceivableAppend(item) {
  var myString = item[0];
  var lastChar = myString.charAt(3);

  if (lastChar == ",") {
    $("#tableToListReport").append(
      "<tr style='background-color:#ededed; font-weight:bold'><td class='tr--primary tr--bold'>" +
        item[0] +
        "</td>" +
        "<td>" +
        item[1] +
        "</td>" +
        "<td class='text-right'>" +
        item[2] +
        "</td>" +
        "<td class='text-right'>" +
        item[3] +
        "</td>" +
        "<td class='text-right'>" +
        item[4] +
        "</td>" +
        "<td class='text-right'>" +
        item[5] +
        "</td>" +
        "<td class='text-right'>" +
        item[6] +
        "</td></tr>"
    );
  } else {
    $("#tableToListReport").append(
      "<tr><td class='tr--primary tr--bold'>" +
        item[0] +
        "</td>" +
        "<td>" +
        item[1] +
        "<br>" +
        item[2] +
        "</td>" +
        "<td  class='text-right'>" +
        item[3] +
        "</td>" +
        "<td class='text-right'>" +
        item[4] +
        "</td>" +
        "<td class='text-right'>" +
        item[5] +
        "</td>" +
        "<td class='text-right'>" +
        item[6] +
        "</td>" +
        "<td class='text-right'>" +
        item[7] +
        "</td></tr>"
    );
  }
}

function paymentByCustomerAppend(item) {
  if (item[0] == "Total") {
    $("#tableToListReport").append(
      "<tr style='font-weight: bold;'><td>" +
        item[0] +
        "</td>" +
        "<td>" +
        item[1] +
        "</td>" +
        "<td class='text-right'>" +
        item[2] +
        "</td>" +
        "<td class='text-right'>" +
        item[3] +
        "</td>" +
        "<td class='text-right'>" +
        item[4] +
        "</td></tr>"
    );
  } else {
    $("#tableToListReport").append(
      "<tr><td>" +
        item[0] +
        "</td>" +
        "<td>" +
        item[1] +
        "</td>" +
        "<td class='text-right'>" +
        item[2] +
        "</td>" +
        "<td class='text-right'>" +
        item[3] +
        "</td>" +
        "<td class='text-right'><strong>" +
        item[4] +
        "</strong></td></tr>"
    );
  }
}

function paymentByItemAppend(item) {
  if (item[1] == "") {
    $("#tableToListReport").append(
      "<tr style='font-weight: bold;'><td>" +
        item[0] +
        "</td>" +
        "<td class='text-right'>" +
        item[1] +
        "</td>" +
        "<td class='text-right'>" +
        item[2] +
        "</td>" +
        "<td class='text-right'>" +
        item[3] +
        "</td>" +
        "<td class='text-right'>" +
        item[4] +
        "</td></tr>"
    );
  } else {
    $("#tableToListReport").append(
      "<tr><td>" +
        item[0] +
        "</td>" +
        "<td class='text-right'>" +
        item[1] +
        "</td>" +
        "<td class='text-right'>" +
        item[2] +
        "</td>" +
        "<td class='text-right'>" +
        item[3] +
        "</td>" +
        "<td class='text-right'>" +
        item[4] +
        "</td></tr>"
    );
  }
}

function customerSourceAppend(item) {
  if (item[0] == "Total") {
    $("#tableToListReport").append(
      "<tr style='background-color:#ededed; font-weight: bold;'><td>" +
        item[0] +
        "</td>" +
        "<td class='text-right'>" +
        item[1] +
        "</td>" +
        "<td class='text-right'>" +
        item[2] +
        "</td>" +
        "<td class='text-right'>" +
        item[3] +
        "</td>" +
        "<td class='text-right'>" +
        item[4] +
        "</td></tr>"
    );
  } else {
    $("#tableToListReport").append(
      "<tr><td>" +
        item[0] +
        "</td>" +
        "<td class='text-right'>" +
        item[1] +
        "</td>" +
        "<td class='text-right'>" +
        item[2] +
        "</td>" +
        "<td class='text-right'>" +
        item[3] +
        "</td>" +
        "<td class='text-right'>" +
        item[4] +
        "</td></tr>"
    );
  }
}

function customerBySourceAppend(item) {
  if (item[0] == "Total") {
    $("#tableToListReport").append(
      "<tr style='background-color:#ededed; font-weight: bold;'><td>" +
        item[0] +
        "</td>" +
        "<td class='text-right'>" +
        item[1] +
        "</td>" +
        "<td class='text-right'>" +
        item[2] +
        "</td>" +
        "<td class='text-right'>" +
        item[3] +
        "</td></tr>"
    );
  } else {
    $("#tableToListReport").append(
      "<tr><td>" +
        item[0] +
        "</td>" +
        "<td class='text-right'>" +
        item[1] +
        "</td>" +
        "<td class='text-right'>" +
        item[2] +
        "</td>" +
        "<td class='text-right'>" +
        item[3] +
        "</td></tr>"
    );
  }
}

function expenseByCategoryAppend(item)
{
  if (item[0] == "Total") {
    $("#tableToListReport").append(
      "<tr style='background-color:#ededed; font-weight: bold;'><td>" +
        item[0] +
        "</td>" +
        "<td class='text-right'>" +
        item[1] +
        "</td>" +
        "<td class='text-right'>" +
        item[2] +
        "</td>" +
        "<td class='text-right'>" +
        item[3] +
        "</td></tr>"
    );
  } else {
    $("#tableToListReport").append(
      "<tr><td>" +
        item[0] +
        "</td>" +
        "<td class='text-right'>" +
        item[1] +
        "</td>" +
        "<td class='text-right'>" +
        item[2] +
        "</td>" +
        "<td class='text-right'>" +
        item[3] +
        "</td></tr>"
    );
  }
}

function customerSalesAppend(item) {
  if (item[0] == "Total") {
    $("#tableToListReport").append(
      "<tr style='background-color:#ededed; font-weight: bold;'><td>" +
        item[0] +
        "</td>" +
        "<td class='text-right'>" +
        item[1] +
        "</td>" +
        "<td class='text-right'>" +
        item[2] +
        "</td>" +
        "<td class='text-right'>" +
        item[3] +
        "</td></tr>"
    );
  } else {
    $("#tableToListReport").append(
      "<tr><td>" +
        item[0] +
        "</td>" +
        "<td class='text-right'>" +
        item[1] +
        "</td>" +
        "<td class='text-right'>" +
        item[2] +
        "</td>" +
        "<td class='text-right'>" +
        item[3] +
        "</td></tr>"
    );
  }
}

function customerTaxByMonthAppend(item)
{
  if (item[0] == "Total") {
    $("#tableToListReport").append(
      "<tr style='background-color:#ededed; font-weight: bold;'><td>" +
        item[0] +
        "</td>" +
        "<td class='text-right'>" +
        item[1] +
        "</td>" +
        "<td class='text-right'>" +
        item[2] +
        "</td>" +
        "<td class='text-right'>" +
        item[3] +
        "</td></tr>"
    );
  } else {
    $("#tableToListReport").append(
      "<tr><td>" +
        item[0] +
        "</td>" +
        "<td class='text-right'>" +
        item[1] +
        "</td>" +
        "<td class='text-right'>" +
        item[2] +
        "</td>" +
        "<td class='text-right'>" +
        item[3] +
        "</td></tr>"
    );
  }
}

function workOrderByStatusAppend(item)
{
  if (item[0] == "Total") {
    $("#tableToListReport").append(
      "<tr style='background-color:#ededed; font-weight: bold;'><td>" +
        item[0] +
        "</td>" +
        "<td class='text-right'>" +
        item[1] +
        "</td>" +
        "<td class='text-right'>" +
        item[2] +
        "</td>" +
        "<td class='text-right'>" +
        item[3] +
        "</td></tr>"
    );
  } else {
    $("#tableToListReport").append(
      "<tr><td>" +
        item[0] +
        "</td>" +
        "<td class='text-right'>" +
        item[1] +
        "</td>" +
        "<td class='text-right'>" +
        item[2] +
        "</td>" +
        "<td class='text-right'>" +
        item[3] +
        "</td></tr>"
    );
  }
}

function workOrderByEmployeeAppend(item)
{
  if (item[0] == "Total") {
    $("#tableToListReport").append(
      "<tr style='background-color:#ededed; font-weight: bold;'><td>" +
        item[0] +
        "</td>" +
        "<td class='text-right'>" +
        item[1] +
        "</td>" +
        "<td class='text-right'>" +
        item[2] +
        "</td>" +
        "<td class='text-right'>" +
        item[3] +
        "</td></tr>"
    );
  } else {
    $("#tableToListReport").append(
      "<tr><td>" +
        item[0] +
        "</td>" +
        "<td class='text-right'>" +
        item[1] +
        "</td>" +
        "<td class='text-right'>" +
        item[2] +
        "</td>" +
        "<td class='text-right'>" +
        item[3] +
        "</td></tr>"
    );
  }
}

function InvoiceByDateAppend(item)
{
  if (item[0] == "Total") {
    $("#tableToListReport").append(
      "<tr style='background-color:#ededed; font-weight: bold;'><td>" +
        item[0] +
        "</td>" +
        "<td class='text-right'>" +
        item[1] +
        "</td>" +
        "<td class='text-right'>" +
        item[2] +
        "</td>" +
        "<td class='text-right'>" +
        item[3] +
        "</td></tr>"
    );
  } else {
    $("#tableToListReport").append(
      "<tr><td>" +
        item[0] +
        "</td>" +
        "<td class='text-right'>" +
        item[1] +
        "</td>" +
        "<td class='text-right'>" +
        item[2] +
        "</td>" +
        "<td class='text-right'>" +
        item[3] +
        "</td></tr>"
    );
  }
}

function paymentByCustomerGroupAppend(item) {
  if (item[0] == "Total") {
    $("#tableToListReport").append(
      "<tr style='background-color:#ededed; font-weight: bold;'><td>" +
        item[0] +
        "</td>" +
        "<td class='text-right'>" +
        item[1] +
        "</td>" +
        "<td class='text-right'>" +
        item[2] +
        "</td></tr>"
    );
  } else {
    $("#tableToListReport").append(
      "<tr><td>" +
        item[0] +
        "</td>" +
        "<td class='text-right'>" +
        item[1] +
        "</td>" +
        "<td class='text-right'>" +
        item[2] +
        "</td></tr>"
    );
  }
}

function accountReceivableResComAppend(item) {
  var myString = item[0];
  var lastChar = myString.charAt(3);

  if (lastChar == ",") {
    $("#tableToListReport").append(
      "<tr style='background-color:#ededed; font-weight:bold'><td>" +
        item[0] +
        "</td>" +
        "<td class='border-right'>" +
        "</td>" +
        "<td class='text-right'>" +
        item[1] +
        "</td>" +
        "<td class='text-right'>" +
        item[2] +
        "</td>" +
        "<td class='text-right'>" +
        item[3] +
        "</td>" +
        "<td class='text-right'>" +
        item[4] +
        "</td>" +
        "<td class='text-right'>" +
        item[5] +
        "</td>" +
        "<td class='text-right border-right'>" +
        item[6] +
        "<td class='text-right'>" +
        item[7] +
        "</td>" +
        "<td class='text-right'>" +
        item[8] +
        "</td>" +
        "<td class='text-right'>" +
        item[9] +
        "</td>" +
        "<td class='text-right'>" +
        item[10] +
        "</td>" +
        "<td class='text-right'>" +
        item[11] +
        "</td>" +
        "<td class='text-right'>" +
        item[12] +
        "</td></tr>"
    );
  } else {
    $("#tableToListReport").append(
      "<tr><td>" +
        item[0] +
        "</td>" +
        "<td class='border-right'>" +
        item[1] +
        "<br><span style='color:gray;'>" +
        item[2] +
        "</span></td>" +
        "<td class='text-right'>" +
        item[3] +
        "</td>" +
        "<td class='text-right'>" +
        item[4] +
        "</td>" +
        "<td class='text-right'>" +
        item[5] +
        "</td>" +
        "<td class='text-right'>" +
        item[6] +
        "</td>" +
        "<td class='text-right'>" +
        item[7] +
        "</td>" +
        "<td class='text-right border-right'>" +
        item[8] +
        "</td>" +
        "<td class='text-right'>" +
        item[9] +
        "</td>" +
        "<td class='text-right'>" +
        item[10] +
        "</td>" +
        "<td class='text-right'>" +
        item[11] +
        "</td>" +
        "<td class='text-right'>" +
        item[12] +
        "</td>" +
        "<td class='text-right'>" +
        item[13] +
        "</td>" +
        "<td class='text-right'>" +
        item[14] +
        "</td></tr>"
    );
  }
}

function paymentByMonthAppend(item) {
  var myString = item[0];
  var lastChar = myString[myString.length - 1];

  if (lastChar == "0" || item[0] == "Total") {
    $("#tableToListReport").append(
      "<tr style='background-color:#ededed;'><td class='tr--primary tr--bold'><strong>" +
        item[0] +
        "</strong></td>" +
        "<td>" +
        item[1] +
        "</td>" +
        "<td>" +
        item[2] +
        "</td>" +
        "<td>" +
        item[3] +
        "</td>" +
        "<td class='text-right'><strong>" +
        item[4] +
        "</strong></td></tr>"
    );
  } else {
    $("#tableToListReport").append(
      "<tr><td class='tr--primary tr--bold'>" +
        item[0] +
        "</td>" +
        "<td>" +
        item[1] +
        "</td>" +
        "<td>" +
        item[2] +
        "</td>" +
        "<td>" +
        item[3] +
        "</td>" +
        (item[3] == ""
          ? "<td class='text-right'><strong>"
          : "<td class='text-right'>") +
        item[4] +
        (item[3] == "" ? "</strong></td></tr>" : "</td></tr>")
    );
  }
}

function filterReportsByPaymentMethod(startDate, endDate) {
  $.ajax({
    url: options.urlFilterPaymentByMethod,
    type: "GET",
    data: { startDate: startDate, endDate: endDate },
    success: function (response) {
      var obj = JSON.parse(response);
      $("#tableToListReport tbody").empty();
      obj.forEach(paymentByMethodAppend);
    },
  });
}

function paymentByMethodAppend(item) {
  var myString = item[0];
  var lastChar = myString[myString.length - 1];

  if (lastChar == "0" || item[0] == "Total") {
    $("#tableToListReport").append(
      "<tr style='background-color:#ededed; font-weight:bold'><td class='tr--primary tr--bold'>" +
        item[0] +
        "</td>" +
        "<td class='text-right'>" +
        item[1] +
        "</td></tr>"
    );
  } else {
    $("#tableToListReport").append(
      "<tr><td class='tr--primary tr--bold'>" +
        item[0] +
        "</td>" +
        "<td class='text-right'>" +
        item[1] +
        "</td></tr>"
    );
  }
}

function filterReportsProfitLoss(startDate, endDate) {
  $.ajax({
    url: options.urlFilterProfitLoss,
    type: "GET",
    data: { startDate: startDate, endDate: endDate },
    success: function (response) {
      var obj = JSON.parse(response);
      $("#profitLossRevenue").text(obj[0]);
      $("#profitLossInvoice").text(obj[1]);
      $("#profitLossExpenses").text(obj[2]);
      $("#profitLossNetProfit").text(obj[3]);
    },
  });
}

function weekDateToDate(year, week, day) {
  const firstDayOfYear = new Date(year, 0, 1);
  const days = 2 + day + (week - 1) * 7 - firstDayOfYear.getDay();
  return new Date(year, 0, days);
}

function profileChart() {
  var data = new google.visualization.DataTable();
  data.addColumn("date", "Day");
  data.addColumn("number", "Business Views");
  data.addColumn("number", "Homepage/Search Views");
  data.addRows([
    [new Date("2020-03-31"), 0, 0],
    [new Date("2020-04-01"), 0, 0],
    [new Date("2020-04-02"), 0, 0],
    [new Date("2020-04-03"), 0, 0],
    [new Date("2020-04-04"), 0, 0],
    [new Date("2020-04-05"), 0, 0],
    [new Date("2020-04-06"), 0, 0],
    [new Date("2020-04-07"), 0, 0],
    [new Date("2020-04-08"), 0, 0],
    [new Date("2020-04-09"), 0, 0],
    [new Date("2020-04-10"), 0, 0],
    [new Date("2020-04-11"), 0, 0],
    [new Date("2020-04-12"), 1, 0],
    [new Date("2020-04-13"), 0, 0],
    [new Date("2020-04-14"), 4, 0],
    [new Date("2020-04-15"), 0, 0],
    [new Date("2020-04-16"), 0, 0],
    [new Date("2020-04-17"), 0, 0],
    [new Date("2020-04-18"), 0, 0],
    [new Date("2020-04-19"), 0, 0],
    [new Date("2020-04-20"), 0, 0],
    [new Date("2020-04-21"), 0, 0],
    [new Date("2020-04-22"), 5, 0],
    [new Date("2020-04-23"), 0, 0],
    [new Date("2020-04-24"), 0, 0],
    [new Date("2020-04-25"), 0, 0],
    [new Date("2020-04-26"), 0, 0],
    [new Date("2020-04-27"), 0, 0],
    [new Date("2020-04-28"), 0, 0],
    [new Date("2020-04-29"), 0, 0],
    [new Date("2020-04-30"), 0, 0],
  ]);

  var options = {
    hAxis: {
      title: "Day",
    },
    vAxis: {
      title: "",
      viewWindow: { min: 0 },
      format: "#",
    },
    pointSize: 6,
    series: {
      0: { color: "#0181c1", areaOpacity: 0.2 },
      1: { color: "#ea7305", areaOpacity: 0.05 },
      2: { color: "#45c253", areaOpacity: 0.1 },
    },
    legend: {
      position: "in",
    },
    chartArea: {
      width: $("#chart-profile").width() - 60,
      left: 50,
      top: 20,
    },
  };

  var chart = new google.visualization.AreaChart(
    document.getElementById("chart-profile")
  );

  chart.draw(data, options);
}

function jobsChart() {
  var data = new google.visualization.DataTable();
  data.addColumn("date", "Day");
  data.addColumn("number", "Total Jobs");
  data.addColumn("number", "Exclusive job leads");
  data.addRows([
    [new Date("2020-03-31"), 0, 0],
    [new Date("2020-04-01"), 0, 0],
    [new Date("2020-04-02"), 0, 0],
    [new Date("2020-04-03"), 0, 0],
    [new Date("2020-04-04"), 0, 0],
    [new Date("2020-04-05"), 0, 0],
    [new Date("2020-04-06"), 0, 0],
    [new Date("2020-04-07"), 0, 0],
    [new Date("2020-04-08"), 0, 0],
    [new Date("2020-04-09"), 0, 0],
    [new Date("2020-04-10"), 0, 0],
    [new Date("2020-04-11"), 0, 0],
    [new Date("2020-04-12"), 0, 0],
    [new Date("2020-04-13"), 0, 0],
    [new Date("2020-04-14"), 0, 0],
    [new Date("2020-04-15"), 0, 0],
    [new Date("2020-04-16"), 0, 0],
    [new Date("2020-04-17"), 0, 0],
    [new Date("2020-04-18"), 0, 0],
    [new Date("2020-04-19"), 0, 0],
    [new Date("2020-04-20"), 0, 0],
    [new Date("2020-04-21"), 0, 0],
    [new Date("2020-04-22"), 0, 0],
    [new Date("2020-04-23"), 0, 0],
    [new Date("2020-04-24"), 0, 0],
    [new Date("2020-04-25"), 0, 0],
    [new Date("2020-04-26"), 0, 0],
    [new Date("2020-04-27"), 0, 0],
    [new Date("2020-04-28"), 0, 0],
    [new Date("2020-04-29"), 0, 0],
    [new Date("2020-04-30"), 0, 0],
  ]);
  var options = {
    hAxis: {
      title: "Day",
    },
    vAxis: {
      title: "",
      viewWindow: { min: 0 },
      format: "#",
      ticks: [0, 1, 2],
    },
    pointSize: 6,
    series: {
      0: { color: "#0181c1", areaOpacity: 0.2 },
      1: { color: "#ea7305", areaOpacity: 0.05 },
      2: { color: "#ea7305", areaOpacity: 0.05 },
    },
    legend: {
      position: "in",
    },
    chartArea: {
      width: $("#chart-jobs").width() - 60,
      left: 50,
      top: 20,
    },
  };

  var chart = new google.visualization.ColumnChart(
    document.getElementById("chart-jobs")
  );
  chart.draw(data, options);
}

function dealsChart() {
  var data = new google.visualization.DataTable();
  data.addColumn("date", "Day");
  data.addColumn("number", "Deal Views");
  data.addColumn("number", "Homepage/Search Views");
  data.addRows([
    [new Date("2020-03-31"), 0, 0],
    [new Date("2020-04-01"), 0, 0],
    [new Date("2020-04-02"), 0, 0],
    [new Date("2020-04-03"), 0, 0],
    [new Date("2020-04-04"), 0, 0],
    [new Date("2020-04-05"), 0, 0],
    [new Date("2020-04-06"), 0, 0],
    [new Date("2020-04-07"), 0, 0],
    [new Date("2020-04-08"), 0, 0],
    [new Date("2020-04-09"), 0, 0],
    [new Date("2020-04-10"), 0, 0],
    [new Date("2020-04-11"), 0, 0],
    [new Date("2020-04-12"), 0, 0],
    [new Date("2020-04-13"), 0, 0],
    [new Date("2020-04-14"), 0, 0],
    [new Date("2020-04-15"), 0, 0],
    [new Date("2020-04-16"), 0, 0],
    [new Date("2020-04-17"), 0, 0],
    [new Date("2020-04-18"), 0, 0],
    [new Date("2020-04-19"), 0, 0],
    [new Date("2020-04-20"), 0, 0],
    [new Date("2020-04-21"), 0, 0],
    [new Date("2020-04-22"), 0, 0],
    [new Date("2020-04-23"), 0, 0],
    [new Date("2020-04-24"), 0, 0],
    [new Date("2020-04-25"), 0, 0],
    [new Date("2020-04-26"), 0, 0],
    [new Date("2020-04-27"), 0, 0],
    [new Date("2020-04-28"), 0, 0],
    [new Date("2020-04-29"), 0, 0],
    [new Date("2020-04-30"), 0, 0],
  ]);
  var options = {
    hAxis: {
      title: "Day",
    },
    vAxis: {
      title: "",
      viewWindow: { min: 0 },
      format: "#",
      ticks: [0, 1, 2],
    },
    pointSize: 6,
    series: {
      0: { color: "#0181c1", areaOpacity: 0.2 },
      1: { color: "#ea7305", areaOpacity: 0.05 },
      2: { color: "#45c253", areaOpacity: 0.1 },
    },
    legend: {
      position: "in",
    },
    chartArea: {
      width: $("#chart-deals").width() - 60,
      left: 50,
      top: 20,
    },
  };

  var chart = new google.visualization.AreaChart(
    document.getElementById("chart-deals")
  );
  chart.draw(data, options);
}

window.onload = function () {
  var currYear = new Date().getFullYear();

  selectReport(currYear + "-01-01", currYear + "-12-31");
  var type = window.location.pathname.split("/");

 // if (type[3] === "summary") {
    google.charts.load("current", { packages: ["corechart", "line"] });
    google.charts.setOnLoadCallback(profileChart);
    google.charts.setOnLoadCallback(jobsChart);
    google.charts.setOnLoadCallback(dealsChart);
 // }
};

$(function () {
  $("#daterange").daterangepicker(
    {
      opens: "left",
    },
    function (start, end) {
      $("#fromCustomDate").text(start.format("DD-MMM-YYYY"));
      $("#toCustomDate").text(end.format("DD-MMM-YYYY"));

      $("#fromCustomDateInput").val(start.format("Y-MM-DD"));
      $("#toCustomDateInput").val(end.format("Y-MM-DD"));

      $("#selectedFilter").text("Custom");
      selectReport(start.format("Y-MM-DD"), end.format("Y-MM-DD"));
    }
  );

  $(".selected").on("click", function () {
    $("#selectedFilter").text($(this).attr("data-name"));
    var startDate = $(this).attr("data-date-start");
    var endDate = $(this).attr("data-date-end");

    $("#fromCustomDate").text($(this).attr("data-date-start-value"));
    $("#toCustomDate").text($(this).attr("data-date-end-value"));

    $("#fromCustomDateInput").val($(this).attr("data-date-start"));
    $("#toCustomDateInput").val($(this).attr("data-date-end"));

    selectReport(startDate, endDate);
  });

  $("#downloadPdf, #downloadCsv").on("click", function () {
    var startDate = $("#fromCustomDateInput").val();
    var endDate = $("#toCustomDateInput").val();
    var formatStartDate = $("#fromCustomDate").text();
    var formatEndDate = $("#toCustomDate").text();
    var type = $(this).attr("data-type");
    var format = $(this).attr("data-format");

    var link = document.createElement("a");
    link.href =
      options.urlReportPreview +
      "?format=" +
      format +
      "&type=" +
      type +
      "&start_time=" +
      startDate +
      "&end_time=" +
      endDate +
      "&format_start_time=" +
      formatStartDate +
      "&format_end_time=" +
      formatEndDate;

    document.body.appendChild(link);
    link.click();
  });
});
