$(document).ready(function () {
  $("#addOnHandInventory, #closeAddNewItem, #cancelAddItemGroups").click(
    function () {
      $("#servicesInventory").hide();
      $("#feesInventory").hide();
      $("#itemGroups").hide();
      $("#newItemInventory").hide();
      $("#newServiceInventory").hide();
      $("#newFeesInventory").hide();
      $("#onHandInventory").fadeIn();
    }
  );

  $("#addServicesInventory, #cancelAddNewService").click(function () {
    $("#onHandInventory").hide();
    $("#feesInventory").hide();
    $("#itemGroups").hide();
    $("#newItemInventory").hide();
    $("#newServiceInventory").hide();
    $("#newFeesInventory").hide();
    $("#servicesInventory").fadeIn();
  });

  $("#addFeesInventory, #cancelAddNewFee").click(function () {
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

  $("#goUpload").click(function () {
    if ($("#attach_img_item").val() == "upload") {
      $("#attach_photo").click();
    }
  });

  $("#save_close_item").click(function () {
    $("#event_type").val(save_close);
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

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    console.log("sdf");
    reader.onload = function (e) {
      $("#img_profile").attr("src", e.target.result).width(100).height(100);
    };

    reader.readAsDataURL(input.files[0]);
  }
}
