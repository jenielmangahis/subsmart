$(document).ready(function () {
  $("#addOnHandInventory").click(function () {
    $("#servicesInventory").hide();
    $("#feesInventory").hide();
    $("#itemGroups").hide();
    $("#newItemInventory").hide();
    $("#onHandInventory").fadeIn();
  });

  $("#addServicesInventory").click(function () {
    $("#onHandInventory").hide();
    $("#feesInventory").hide();
    $("#itemGroups").hide();
    $("#newItemInventory").hide();
    $("#servicesInventory").fadeIn();
  });

  $("#addFeesInventory").click(function () {
    $("#servicesInventory").hide();
    $("#onHandInventory").hide();
    $("#itemGroups").hide();
    $("#newItemInventory").hide();
    $("#feesInventory").fadeIn();
  });

  $("#orderInventory").click(function () {
    $("#servicesInventory").fadeOut();
    $("#onHandInventory").fadeOut();
    $("#feesInventory").fadeOut();
    $("#newItemInventory").fadeOut();
    $("#itemGroups").fadeOut();
  });

  $("#vendorInventory").click(function () {
    $("#servicesInventory").fadeOut();
    $("#onHandInventory").fadeOut();
    $("#feesInventory").fadeOut();
    $("#newItemInventory").fadeOut();
    $("#itemGroups").fadeOut();
  });

  $("#reportsInventory").click(function () {
    $("#servicesInventory").fadeOut();
    $("#onHandInventory").fadeOut();
    $("#feesInventory").fadeOut();
    $("#itemGroups").fadeOut();
  });

  $("#addItemGroups").click(function () {
    $("#servicesInventory").hide();
    $("#onHandInventory").hide();
    $("#feesInventory").hide();
    $("#newItemInventory").hide();
    $("#itemGroups").fadeIn();
  });

  $("#addNewItemInventory").click(function () {
    $("#servicesInventory").hide();
    $("#onHandInventory").hide();
    $("#feesInventory").hide();
    $("#itemGroups").hide();
    $("#newItemInventory").fadeIn();
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
