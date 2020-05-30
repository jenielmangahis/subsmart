$(document).ready(function () {
  $("#addOnHandInventory").click(function () {
    $("#servicesInventory").hide();
    $("#feesInventory").hide();
    $("#itemGroups").hide();
    $("#newItemInventory").hide();
    $("#newServiceInventory").hide();
    $("#newFeesInventory").hide();
    $("#onHandInventory").fadeIn();
  });

  $("#addServicesInventory").click(function () {
    $("#onHandInventory").hide();
    $("#feesInventory").hide();
    $("#itemGroups").hide();
    $("#newItemInventory").hide();
    $("#newServiceInventory").hide();
    $("#newFeesInventory").hide();
    $("#servicesInventory").fadeIn();
  });

  $("#addFeesInventory").click(function () {
    $("#servicesInventory").hide();
    $("#onHandInventory").hide();
    $("#itemGroups").hide();
    $("#newItemInventory").hide();
    $("#newServiceInventory").hide();
    $("#newFeesInventory").hide();
    $("#feesInventory").fadeIn();
  });

  $("#orderInventory").click(function () {
    $("#servicesInventory").fadeOut();
    $("#onHandInventory").fadeOut();
    $("#feesInventory").fadeOut();
    $("#newItemInventory").fadeOut();
    $("#newServiceInventory").hide();
    $("#newFeesInventory").hide();
    $("#itemGroups").fadeOut();
  });

  $("#vendorInventory").click(function () {
    $("#servicesInventory").fadeOut();
    $("#onHandInventory").fadeOut();
    $("#feesInventory").fadeOut();
    $("#newItemInventory").fadeOut();
    $("#newServiceInventory").hide();
    $("#newFeesInventory").hide();
    $("#itemGroups").fadeOut();
  });

  $("#reportsInventory").click(function () {
    $("#servicesInventory").fadeOut();
    $("#onHandInventory").fadeOut();
    $("#feesInventory").fadeOut();
    $("#newItemInventory").hide();
    $("#newServiceInventory").hide();
    $("#newFeesInventory").hide();
    $("#itemGroups").fadeOut();
  });

  $("#addItemGroups").click(function () {
    $("#servicesInventory").hide();
    $("#onHandInventory").hide();
    $("#feesInventory").hide();
    $("#newItemInventory").hide();
    $("#newServiceInventory").hide();
    $("#newFeesInventory").hide();
    $("#itemGroups").fadeIn();
  });

  $("#addNewItemInventory").click(function () {
    $("#servicesInventory").hide();
    $("#onHandInventory").hide();
    $("#feesInventory").hide();
    $("#itemGroups").hide();
    $("#newServiceInventory").hide();
    $("#newFeesInventory").hide();
    $("#newItemInventory").fadeIn();
  });

  $("#addNewServiceInventory").click(function () {
    $("#servicesInventory").hide();
    $("#onHandInventory").hide();
    $("#feesInventory").hide();
    $("#itemGroups").hide();
    $("#newFeesInventory").hide();
    $("#newItemInventory").hide();
    $("#newServiceInventory").fadeIn();
  });

  $("#addNewFeesInventory").click(function () {
    $("#servicesInventory").hide();
    $("#onHandInventory").hide();
    $("#feesInventory").hide();
    $("#itemGroups").hide();
    $("#newServiceInventory").hide();
    $("#newItemInventory").hide();
    $("#newFeesInventory").fadeIn();
  });

  $("#invoiceCreatedDate, #workOrderCreatedDate, #estimateDate").datetimepicker(
    {
      format: "L",
    }
  );

  $("#expiryDateEstimate, #billingDate, #billingExpDate").datetimepicker({
    format: "L",
  });
});
