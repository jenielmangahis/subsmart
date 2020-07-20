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

  $(
    "#addOnHandInventory, #addServicesInventory, #addFeesInventory, #addItemGroups"
  ).click(function () {
    $.LoadingOverlay("show");
  });

  $("#exportItemsInventory").click(function () {
    $.LoadingOverlay("show");
    exportItems();
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

  $("#serviceTimeEstimate").datetimepicker({
    format: "LT",
  });

  $("#selectInventoryCat").change(function () {
    console.log($("#selectInventoryCat").val());
  });

  $("#serviceItemsTable, #feesItemsTable").DataTable({});

  $("#inventoryOnHandItems, #serviceItemsTable, #feesItemsTable").DataTable({
    ordering: false,
    destroy: true,
  });

  $(".deleteJobCurrentForm").click(function () {
    $.LoadingOverlay("show");
  });

  $(document).on("click", ".editItemBtn", function () {
    $("#itemId").val($(this).data("id"));
    $("#servicesInventory").hide();
    $("#onHandInventory").hide();
    $("#feesInventory").hide();
    $("#itemGroups").hide();
    $("#newServiceInventory").hide();
    $("#newFeesInventory").hide();
    $("#newItemInventory").fadeIn();
    $("#saveAddAnother").text("Edit");
    $("#save_close_item").hide();
    $.LoadingOverlay("show");
    var param = {
      item_id: $(this).data("id"),
    };
    getItemById(param);
  });

  $("#inventoryItemCheckAll").click(function () {
    $(".inventoryItem").not(this).prop("checked", this.checked);
    var selectedIds = [];
    $("input.inventoryItem").each(function () {
      if ($(this).prop("checked")) selectedIds.push($(this).data("id"));
    });
    $("#selectedIds").val(selectedIds);
  });

  $("#inventoryServiceCheckAll").click(function () {
    $(".inventoryService").not(this).prop("checked", this.checked);
    var selectedIds = [];

    $("input.inventoryService").each(function () {
      if ($(this).prop("checked")) selectedIds.push($(this).data("id"));
    });
    $("#selectedIds").val(selectedIds);
  });

  $("#inventoryFeesCheckAll").click(function () {
    $(".inventoryFees").not(this).prop("checked", this.checked);
    var selectedIds = [];

    $("input.inventoryFees").each(function () {
      if ($(this).prop("checked")) selectedIds.push($(this).data("id"));
    });
    $("#selectedIds").val(selectedIds);
  });

  $(".deleteSelect").click(function () {
    $.LoadingOverlay("show");
    var param = {
      ids: $("#selectedIds").val(),
    };
    deleteMultiple(param);
  });
});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $("#img_profile").attr("src", e.target.result).width(100).height(100);
    };

    reader.readAsDataURL(input.files[0]);
  }
}

function exportItems() {
  $.LoadingOverlay("hide");
  var link = document.createElement("a");
  link.href = base_url + "inventory/exportItems";

  document.body.appendChild(link);
  link.click();
}

function getItemById(param) {
  $.ajax({
    type: "POST",
    url: base_url + "inventory/getItemById",
    data: param,
    success: function (response) {
      var obj = JSON.parse(response);
      obj.forEach(populateItem);
      $.LoadingOverlay("hide");
    },
  });
}

function populateItem(item) {
  console.log(item.id);
  $("#itemName").val(item.title);
  $("#descriptionItem").val(item.description);
  $("#brandField").val(item.brand);
  $("#costField").val(item.price);
  $("#unitItem").val(item.units);
  $("#productUrlItem").val(item.url);
  $("#cogsItem").val(item.COGS);
  $("#modelNumItem").val(item.model);
}

function deleteMultiple(param) {
  $.ajax({
    type: "POST",
    url: base_url + "inventory/deleteMultiple",
    data: param,
    success: function (response) {
      window.location.href = "";
    },
  });
}
