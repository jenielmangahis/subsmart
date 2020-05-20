$(document).ready(function() {
  selected_folder = {};
  isUpdatePermissions = false;

  $(".form-validate").validate();
  //Initialize Select2 Elements
  $(".select2").select2();

  //Francis scripts 4/14/2020 ph date
  //open folder manager
  $("#btn-folder-manager").click(function() {
    var folder_selected = { selected_folder: 0 };

    if ($("#current_selected_folder_id").length) {
      folder_selected.selected_folder = $("#current_selected_folder_id").val();
    }

    $.ajax({
      type: "GET",
      url: base_url + "folders/getfolders",
      data: folder_selected,
      success: function(data) {
        var result = jQuery.parseJSON(data);
        setFoldersTreeview(result);

        if (folderSelectedIsNotEmpty()) {
          $("#folders_treeview").treeview("selectNode", [
            selected_folder.nodeId
          ]);
          $("#folders_treeview").treeview("revealNode", [
            selected_folder.nodeId
          ]);
          $("#folders_treeview").treeview("expandNode", [
            selected_folder.nodeId
          ]);
        } else {
          selected_folder = $("#folders_treeview").treeview("getSelected");
          if (folderSelectedIsNotEmpty()) {
            selected_folder = selected_folder[0];

            $(".modal-folder-manager-selected").html(
              "Selected : " + selected_folder.path
            );

            $("#folders_treeview").treeview("revealNode", [
              selected_folder.nodeId
            ]);
            $("#folders_treeview").treeview("expandNode", [
              selected_folder.nodeId
            ]);
          }
        }

        $("#modal-folder-manager").modal("show");
      }
    });
  });

  //click create folder
  $("#btn-create-folder-manager").click(function() {
    $("#text-folder-manager").val("");
    $("#text-folder-manager").prop("disabled", false);

    $(".fm_role_access_permissions").each(function(i, obj) {
      $(this).prop("checked", false);
    });

    isUpdatePermissions = false;

    $("#modal-folder-manager-form").modal("show");
  });

  //click save new folder
  $("#btn-save-folder-manager").click(function() {
    var folder_name = $("#text-folder-manager").val();
    var parent_folder_id = 0;
    var permissions = [{}];

    if (selected_folder.length != 0) {
      parent_folder_id = selected_folder.id;
    }

    $(".fm_role_access_permissions").each(function(i, obj) {
      var role_id = $(this).val();
      if ($(this).is(":checked")) {
        permissions.push({ role_id: role_id });
      }
    });

    if (isFolderNameValid(folder_name)) {
      if (!isUpdatePermissions) {
        $.ajax({
          type: "POST",
          url: base_url + "folders/save",
          data: {
            folder_name: folder_name,
            parent_folder_id: parent_folder_id,
            roles: permissions
          },
          success: function(data) {
            var result = jQuery.parseJSON(data);
            if (result.error == "") {
              setFoldersTreeview(result.folders);

              if (folderSelectedIsNotEmpty()) {
                $("#folders_treeview").treeview("selectNode", [
                  selected_folder.nodeId
                ]);
                $("#folders_treeview").treeview("revealNode", [
                  selected_folder.nodeId
                ]);
                $("#folders_treeview").treeview("expandNode", [
                  selected_folder.nodeId
                ]);
              }

              $("#modal-folder-manager-form").modal("hide");
            } else {
              showFolderManagerNotif("Error", result.error);
            }
          }
        });
      } else {
        $.ajax({
          type: "POST",
          url: base_url + "folders/update_permissions",
          data: { folder_id: parent_folder_id, roles: permissions },
          success: function(data) {
            var result = jQuery.parseJSON(data);
            if (result.error == "") {
              showFolderManagerNotif(
                "Information",
                "Permissions successfully updated"
              );
            } else {
              showFolderManagerNotif("Error", result.error);
            }
          }
        });
      }
    } else {
      showFolderManagerNotif("Error", "Folder name is invalid");
    }
  });

  //click delete folder
  $("#btn-delete-folder-manager").click(function() {
    if (!folderSelectedIsNotEmpty()) {
      showFolderManagerNotif("Information", "No folder selected");
    } else {
      showFolderManagerNotif(
        "Confirm",
        "Are you sure you want to delete folder",
        true
      );
    }
  });

  //click confirm delete folder
  $("#btn-modal-folder-manager-confirm-delete").click(function() {
    var folder_id = selected_folder.id;
    var parent_node = $("#folders_treeview").treeview(
      "getParent",
      selected_folder
    );
    if (parent_node == null) {
      parent_node = {};
    }

    $.ajax({
      type: "POST",
      url: base_url + "folders/delete",
      data: { folder_id: folder_id },
      success: function(data) {
        var result = jQuery.parseJSON(data);
        if (result.error == "") {
          setFoldersTreeview(result.folders);

          selected_folder = {};

          if (
            !jQuery.isEmptyObject(parent_node) &&
            parent_node.hasOwnProperty("parentId")
          ) {
            $("#folders_treeview").treeview("revealNode", [parent_node.nodeId]);
            $("#folders_treeview").treeview("expandNode", [parent_node.nodeId]);
          }

          $(".modal-folder-manager-selected").html("Selected : None");
          $("#modal-folder-manager-alert").modal("hide");
        } else {
          showFolderManagerNotif("Error", result.error, false);
        }
      }
    });
  });

  //click edit permission of a folder
  $("#btn-edit-permissions-folder-manager").click(function() {
    if (!folderSelectedIsNotEmpty()) {
      showFolderManagerNotif("Information", "No folder selected");
    } else {
      $(".fm_role_access_permissions").each(function(i, obj) {
        $(this).prop("checked", false);
      });

      var folder_id = selected_folder.id;

      $.ajax({
        type: "GET",
        url: base_url + "folders/getFolderPermissions",
        data: { folder_id: folder_id },
        success: function(data) {
          var result = jQuery.parseJSON(data);
          $.each(result, function(key, val) {
            $(
              'input.fm_role_access_permissions[value="' + val.role_id + '"]'
            ).prop("checked", true);
          });

          isUpdatePermissions = true;

          $("#text-folder-manager").val(selected_folder.text);
          $("#text-folder-manager").prop("disabled", true);

          $("#modal-folder-manager-form").modal("show");
        }
      });
    }
  });

  //event handler for on close of folder manager alert modal
  $("#modal-folder-manager-alert").on("hidden.bs.modal", function() {
    $("#modal-folder-manager-alert-title-div").removeClass();
    $("#modal-folder-manager-alert-title-div").addClass("modal-header");
    $("#btn-modal-folder-manager-confirm-delete").hide();
  });

  //---------------------------------
});

function setFoldersTreeview(folders_data) {
  $("#folders_treeview").treeview({
    expandIcon: "fa fa-folder-o",
    collapseIcon: "fa fa-folder-open-o",
    data: folders_data,
    onNodeSelected: function(event, data) {
      selected_folder = data;
      $(".modal-folder-manager-selected").html(
        "Selected : " + selected_folder.path
      );
    },
    onNodeUnselected: function(event, data) {
      selected_folder = {};
      $(".modal-folder-manager-selected").html("Selected : None");
    }
  });
}

function isFolderNameValid(folder_name) {
  var isValid = true;
  var invalid_chars = ["\\", "/", ":", "*", "?", '"', "<", ">", "|"];
  var invalid_names = [
    "CON",
    "PRN",
    "AUX",
    "NUL",
    "COM1",
    "COM2",
    "COM3",
    "COM4",
    "COM5",
    "COM6",
    "COM7",
    "COM8",
    "COM9",
    "LPT1",
    "LPT2",
    "LPT3",
    "LPT4",
    "LPT5",
    "LPT6",
    "LPT7",
    "LPT8",
    "LPT9"
  ];

  if (!folder_name) {
    isValid = false;
  }

  if (isValid) {
    $.each(invalid_chars, function(key, value) {
      if (folder_name.includes(value)) {
        isValid = false;
        return isValid;
      }
    });

    $.each(invalid_names, function(key, value) {
      if (folder_name.toLowerCase() == value.toLowerCase()) {
        isValid = false;
        return isValid;
      }
    });
  }

  return isValid;
}

function showFolderManagerNotif(title, text, showyesbuttonfordelete = false) {
  var title_class = "bg-info";
  if (title == "Error") {
    title_class = "bg-danger";
  } else if (title == "Confirm") {
    title = "Confirm?";
    title_class = "bg-warning";
  }

  $("#modal-folder-manager-alert-title-div").addClass(title_class);
  $("#modal-folder-manager-alert-title").html(title);
  $("#modal-folder-manager-alert-text").html(text);

  if (showyesbuttonfordelete) {
    $("#btn-modal-folder-manager-confirm-delete").show();
  } else {
    $("#btn-modal-folder-manager-confirm-delete").hide();
  }

  if (!($("#modal-folder-manager-alert").data("bs.modal") || {}).isShown) {
    $("#modal-folder-manager-alert").modal("show");
  }
}

function folderSelectedIsNotEmpty() {
  return (
    !jQuery.isEmptyObject(selected_folder) && selected_folder !== undefined
  );
}

function getplanItems(pid) {
  var site_url = jQuery("#siteurl").val();
  jQuery.ajax({
    url: site_url + "plans/getitems",
    data: { pid: pid },
    type: "GET",
    success: function(data) {
      jQuery("#plansItemDiv")
        .empty()
        .html(data);
    },
    error: function() {
      alert("An error has occurred");
    }
  });
}

$(document).ready(function() {
  $(".form-validate").validate();
  //Initialize Select2 Elements
  $(".select2").select2();
});

function getplanItems(pid) {
  var site_url = jQuery("#siteurl").val();
  jQuery.ajax({
    url: site_url + "plans/getitems",
    data: { pid: pid },
    type: "GET",
    success: function(data) {
      jQuery("#plansItemDiv")
        .empty()
        .html(data);
    },
    error: function() {
      alert("An error has occurred");
    }
  });
}
function getItems(obj) {
  var sk = jQuery(obj).val();
  var site_url = jQuery("#siteurl").val();
  jQuery.ajax({
    url: site_url + "items/getitems",
    data: { sk: sk },
    type: "GET",
    success: function(data) {
      /* alert(data); */
      jQuery(obj)
        .parent()
        .find(".suggestions")
        .empty()
        .html(data);
    },
    error: function() {
      alert("An error has occurred");
    }
  });
}
function setitem(obj, title, price, discount) {
  jQuery(obj)
    .parent()
    .parent()
    .find(".getItems")
    .val(title);
  jQuery(obj)
    .parent()
    .parent()
    .parent()
    .find(".price")
    .val(price);
  jQuery(obj)
    .parent()
    .parent()
    .parent()
    .find(".discount")
    .val(discount);
  var counter = jQuery(obj)
    .parent()
    .parent()
    .parent()
    .find(".price")
    .data("counter");
  jQuery(obj)
    .parent()
    .empty();
  calculation(counter);
}

function previewImage(input, previewDom) {
  if (input.files && input.files[0]) {
    $(previewDom).show();
    var reader = new FileReader();
    reader.onload = function(e) {
      $(previewDom)
        .find("img")
        .attr("src", e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
  } else {
    $(previewDom).hide();
  }
}

function createUsername(name) {
  return name
    .toLowerCase()
    .replace(/ /g, "_")
    .replace(/[^\w-]+/g, "");
}

$(document).on("focusout", ".price", function() {
  var counter = $(this).data("counter");
  calculation(counter);
});

$(document).on("focusout", ".quantity", function() {
  var counter = $(this).data("counter");
  calculation(counter);
});
$(document).on("focusout", ".discount", function() {
  var counter = $(this).data("counter");
  calculation(counter);
});

function calculation(counter) {
  var price = $("#price_" + counter).val();
  var quantity = $("#quantity_" + counter).val();
  var discount = $("#discount_" + counter).val()
    ? $("#discount_" + counter).val()
    : 0;
  var tax = (parseFloat(price) * 7.5) / 100;
  var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
    2
  );
  var total = (
    (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
    parseFloat(discount)
  ).toFixed(2);

  $("#span_total_" + counter).text(total);
  $("#total_" + counter).val(total);
  $("#span_tax_" + counter).text(tax1);
  $("#tax_" + counter).val(tax1);

  var eqpt_cost = 0;
  var subtotal = 0;
  var adjustment_amount = 0;
  var cnt = $("#count").val();

  if (
    $("#adjustment_input").val() &&
    $("#adjustment_input")
      .val()
      .toString().length > 1
  ) {
    adjustment_amount = $("#adjustment_input")
      .val()
      .substr(1);
  }
  for (var p = 0; p <= cnt; p++) {
    var prc = $("#price_" + p).val();
    var quantity = $("#quantity_" + p).val();
    // var discount= $('#discount_' + p).val();
    // eqpt_cost += parseFloat(prc) - parseFloat(discount);
    subtotal += parseFloat($("#span_total_" + p).text());
    eqpt_cost += parseFloat(prc) * parseFloat(quantity);
  }

  $("#adjustment_amount").text(parseFloat(adjustment_amount));
  $("#adjustment_amount_form_input").val(parseFloat(adjustment_amount));
  $("#invoice_sub_total").text(subtotal.toFixed(2));
  $("#sub_total_form_input").val(subtotal.toFixed(2));

  var grandTotal = eval(
    $("#invoice_sub_total").text() + $("#adjustment_input").val()
  );
  $("#invoice_grand_total").text(parseFloat(grandTotal).toFixed(2));
  $("#grand_total_form_input").val(parseFloat(grandTotal).toFixed(2));

  eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
  $("#eqpt_cost").val(eqpt_cost);

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
}
function getplanItems(pid) {
  var site_url = jQuery("#siteurl").val();
  jQuery.ajax({
    url: site_url + "plans/getitems",
    data: { pid: pid },
    type: "GET",
    success: function(data) {
      jQuery("#plansItemDiv")
        .empty()
        .html(data);
    },
    error: function() {
      alert("An error has occurred");
    }
  });
}
function getItems(obj) {
  var sk = jQuery(obj).val();
  var site_url = jQuery("#siteurl").val();
  jQuery.ajax({
    url: site_url + "items/getitems",
    data: { sk: sk },
    type: "GET",
    success: function(data) {
      /* alert(data); */
      jQuery(obj)
        .parent()
        .find(".suggestions")
        .empty()
        .html(data);
    },
    error: function() {
      alert("An error has occurred");
    }
  });
}
function setitem(obj, title, price, discount) {
  jQuery(obj)
    .parent()
    .parent()
    .find(".getItems")
    .val(title);
  jQuery(obj)
    .parent()
    .parent()
    .parent()
    .find(".price")
    .val(price);
  jQuery(obj)
    .parent()
    .parent()
    .parent()
    .find(".discount")
    .val(discount);
  var counter = jQuery(obj)
    .parent()
    .parent()
    .parent()
    .find(".price")
    .data("counter");
  jQuery(obj)
    .parent()
    .empty();
  calculation(counter);
}

function previewImage(input, previewDom) {
  if (input.files && input.files[0]) {
    $(previewDom).show();
    var reader = new FileReader();
    reader.onload = function(e) {
      $(previewDom)
        .find("img")
        .attr("src", e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
  } else {
    $(previewDom).hide();
  }
}

function createUsername(name) {
  return name
    .toLowerCase()
    .replace(/ /g, "_")
    .replace(/[^\w-]+/g, "");
}

$(document).on("focusout", ".price", function() {
  var counter = $(this).data("counter");
  calculation(counter);
});

$(document).on("focusout", ".quantity", function() {
  var counter = $(this).data("counter");
  calculation(counter);
});
$(document).on("focusout", ".discount", function() {
  var counter = $(this).data("counter");
  calculation(counter);
});

function calculation(counter) {
  var price = $("#price_" + counter).val();
  var quantity = $("#quantity_" + counter).val();
  var discount = $("#discount_" + counter).val()
    ? $("#discount_" + counter).val()
    : 0;
  var tax = (parseFloat(price) * 7.5) / 100;
  var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
    2
  );
  var total = (
    (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
    parseFloat(discount)
  ).toFixed(2);

  $("#span_total_" + counter).text(total);
  $("#total_" + counter).val(total);
  $("#span_tax_" + counter).text(tax1);
  $("#tax_" + counter).val(tax1);

  var eqpt_cost = 0;
  var subtotal = 0;
  var adjustment_amount = 0;
  var cnt = $("#count").val();

  if (
    $("#adjustment_input").val() &&
    $("#adjustment_input")
      .val()
      .toString().length > 1
  ) {
    adjustment_amount = $("#adjustment_input")
      .val()
      .substr(1);
  }
  for (var p = 0; p <= cnt; p++) {
    var prc = $("#price_" + p).val();
    var quantity = $("#quantity_" + p).val();
    // var discount= $('#discount_' + p).val();
    // eqpt_cost += parseFloat(prc) - parseFloat(discount);
    subtotal += parseFloat($("#span_total_" + p).text());
    eqpt_cost += parseFloat(prc) * parseFloat(quantity);
  }

  $("#adjustment_amount").text(parseFloat(adjustment_amount));
  $("#adjustment_amount_form_input").val(parseFloat(adjustment_amount));
  $("#invoice_sub_total").text(subtotal.toFixed(2));
  $("#sub_total_form_input").val(subtotal.toFixed(2));

  var grandTotal = eval(
    $("#invoice_sub_total").text() + $("#adjustment_input").val()
  );
  $("#invoice_grand_total").text(parseFloat(grandTotal).toFixed(2));
  $("#grand_total_form_input").val(parseFloat(grandTotal).toFixed(2));

  eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
  $("#eqpt_cost").val(eqpt_cost);

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
}

$(document).on("click", "#add_another", function(e) {
  e.preventDefault();
  var count = parseInt($("#count").val()) + 1;
  $("#count").val(count);

  var html =
    "<tr>\n" +
    "<td>\n" +
    '<input type="text" autocomplete="off" class="form-control getItems" onKeyup="getItems(this)" name="item[]"><ul class="suggestions"></ul>\n' +
    "</td>\n" +
    '<td><select name="item_type[]" class="form-control"><option value="product">Product</option><option value="material">Material</option><option value="service">Service</option></select></td>\n' +
    "<td>\n" +
    '<input type="text" class="form-control quantity" name="quantity[]" data-counter="' +
    count +
    '" id="quantity_' +
    count +
    '" value="1">\n' +
    "</td>\n" +
    "<td>\n" +
    '<input type="text" class="form-control" name="location[]">\n' +
    "</td>\n" +
    "<td>\n" +
    '<input type="number" class="form-control price" name="price[]" data-counter="' +
    count +
    '" id="price_' +
    count +
    '" min="0" value="0">\n' +
    "</td>\n" +
    "<td>\n" +
    '<input type="number" class="form-control discount" name="discount[]" data-counter="' +
    count +
    '" id="discount_' +
    count +
    '" min="0" value="0" readonly>\n' +
    "</td>\n" +
    "<td>\n" +
    '<span id="span_tax_' +
    count +
    '">0.00 (7.5%)</span>\n' +
    "</td>\n" +
    "<td>\n" +
    '<span id="span_total_' +
    count +
    '">0.00</span>\n' +
    "</td>\n" +
    "<td>\n" +
    '<a href="#" class="remove">X</a>\n' +
    "</td>\n" +
    "</tr> ";

  $("#table_body").append(html);
});

$(document).on("click", "#add_another_invoice", function(e) {
  e.preventDefault();
  var count = parseInt($("#count").val()) + 1;
  $("#count").val(count);

  var html =
    "<tr>\n" +
    "<td>\n" +
    '<input type="text" autocomplete="off" class="form-control getItems" onKeyup="getItems(this)" name="item[]"><ul class="suggestions"></ul>\n' +
    "</td>\n" +
    '<td><select name="item_type[]" class="form-control"><option value="service">Service</option><option value="material">Material</option><option value="product">Product</option></select></td>\n' +
    "<td>\n" +
    '<input type="text" class="form-control quantity" name="quantity[]" data-counter="' +
    count +
    '" id="quantity_' +
    count +
    '" value="1">\n' +
    "</td>\n" +
    "<td>\n" +
    '<input type="number" class="form-control price" name="price[]" data-counter="' +
    count +
    '" id="price_' +
    count +
    '" min="0" value="0">\n' +
    "</td>\n" +
    "<td>\n" +
    '<input type="hidden" class="form-control discount" name="discount[]" data-counter="' +
    count +
    '" id="discount_' +
    count +
    '" min="0" value="0">\n' +
    '<span id="span_discount_' +
    count +
    '">0.00 (0.00%)</span>\n' +
    "</td>\n" +
    "<td>\n" +
    '<input type="hidden" class="form-control tax" name="tax[]" data-counter="' +
    count +
    '" id="tax_' +
    count +
    '" min="0" value="0">\n' +
    '<span id="span_tax_' +
    count +
    '">0.00 (7.5%)</span>\n' +
    "</td>\n" +
    "<td>\n" +
    '<input type="hidden" class="form-control total" name="total[]" data-counter="' +
    count +
    '" id="total_' +
    count +
    '" min="0" value="0">\n' +
    '<span id="span_total_' +
    count +
    '">0.00</span>\n' +
    "</td>\n" +
    "<td>\n" +
    '<a href="#" class="remove"><span class="fa fa-trash" /></a>\n' +
    "</td>\n" +
    "</tr> ";

  $("#table_body").append(html);
});

$(document).on("click", ".remove", function(e) {
  e.preventDefault();
  $(this)
    .parent()
    .parent()
    .remove();

  var count = parseInt($("#count").val()) - 1;
  $("#count").val(count);
  calculation(count);
});

$(document).on("change", "#adjustment_input", function(e) {
  e.preventDefault();

  var adjustment_amount = 0;
  var grandTotal = eval(
    $("#invoice_sub_total").text() + $("#adjustment_input").val()
  );

  if ($("#adjustment_input").val()) {
    adjustment_amount = $("#adjustment_input")
      .val()
      .substr(1);
  }

  $("#adjustment_amount").text(parseFloat(adjustment_amount));
  $("#adjustment_amount_form_input").val(parseFloat(adjustment_amount));
  $("#invoice_grand_total").text(parseFloat(grandTotal).toFixed(2));
  $("#grand_total_form_input").val(parseFloat(grandTotal).toFixed(2));
});

function cal_total_due() {
  var eqpt_cost = parseFloat($("#eqpt_cost").val());
  var sales_tax = parseFloat($("#sales_tax").val());
  var inst_cost = parseFloat($("#inst_cost").val());
  var one_time = parseFloat($("#one_time").val());
  var m_monitoring = parseFloat($("#m_monitoring").val());

  var total_due = parseFloat(
    eqpt_cost + sales_tax + inst_cost + one_time + m_monitoring
  ).toFixed(2);

  $("#total_due").text(total_due);
}

$(document).on("click", "#add_another_zone", function(e) {
  e.preventDefault();
  var count = parseInt($("#count").val()) + 1;
  $("#count").val(count);

  var html =
    "<tr>\n" +
    "<td>\n" +
    '<select name="zone[existing][]" class="form-control"><option value="0">No</option><option value="1">Yes</option></select>\n' +
    "</td>\n" +
    // '<td><select name="item_type[]" class="form-control"><option value="product">Product</option><option value="material">Material</option><option value="service">Service</option></select></td>\n'+
    "<td>\n" +
    '<input type="text" class="form-control quantity" name="zone[zone_number][]" data-counter="' +
    count +
    '" id="quantity_' +
    count +
    '" value="1">\n' +
    "</td>\n" +
    "<td>\n" +
    '<select name="zone[repeat_issue][]" class="form-control"> <option value="0">No</option><option value="1">Yes</option></select>\n' +
    "</td>\n" +
    "<td>\n" +
    '<input type="text" class="form-control" name="zone[location][]">\n' +
    "</td>\n" +
    "<td>\n" +
    '<a href="#" class="remove">X</a>\n' +
    "</td>\n" +
    "</tr> ";

  $("#table_body_zone").append(html);
});

$(document).on("click", ".remove", function(e) {
  e.preventDefault();
  $(this)
    .parent()
    .parent()
    .remove();
  var count = parseInt($("#count").val()) - 1;
  $("#count").val(count);
  calculation(count);
});

$(function() {
  $("#date_issued").datepicker();
  $("#date_of_trans").datepicker();
  $("#date_later_midnight").datepicker();
  $("#workorder_date").datepicker();
  $("#contact_dob").datepicker();
  $("#cancel_trans_date").datepicker();
  $("#start_date").datepicker();
  $("#end_time").timepicker({});
  $("#start_time").timepicker({});
  $("#end_date").datepicker();
  $("#inst_date").datepicker();
});

$(document).ready(function() {
  var cookie = {
    create: function(name, value, days) {
      var expires;
      if (days) {
        var date = new Date();
        date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
        expires = "; expires=" + date.toGMTString();
      } else {
        expires = "";
      }
      document.cookie =
        encodeURIComponent(name) +
        "=" +
        JSON.stringify(value) +
        expires +
        "; path=/";
    },
    read: function(name) {
      var nameEQ = encodeURIComponent(name) + "=";
      var ca = document.cookie.split(";");
      for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === " ") c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0)
          return JSON.parse(c.substring(nameEQ.length, c.length));
      }
      return null;
    }
  };
  $(".nav-close").on("click", function() {
    $(".navbar-side").toggleClass("closed");

    if (cookie.read("navsidebar") === "closed") {
      cookie.create("navsidebar", "", 5);
    } else {
      cookie.create("navsidebar", "closed", 5);
    }
  });

  if (cookie.read("navsidebar") === "closed") {
    $(".navbar-side").addClass("closed");
  }

  $(".bcc-toggle").on("click", function() {
    $("#bcc-cnt").fadeToggle();
  });

  $(".send-to-email, .send-cc-email, .send-bcc-email").select2({
    ajax: {
      url: "http://example.org/api/test",
      cache: false
    }
  });

  tinymce.init({
    selector: "textarea#send-email",
    height: 500,
    menubar: false,
    plugins: [
      "advlist autolink lists link image charmap print preview anchor",
      "searchreplace visualblocks code fullscreen",
      "insertdatetime media table paste code help wordcount"
    ],
    toolbar:
      "undo redo | formatselect | " +
      "bold italic backcolor | alignleft aligncenter " +
      "alignright alignjustify | bullist numlist outdent indent | " +
      "removeformat | help",
    content_css: "//www.tiny.cloud/css/codepen.min.css"
  });
});
