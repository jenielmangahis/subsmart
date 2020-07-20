var options = {
  urlEmployeeList: base_url + "workorder/employee_list_json",
  urlCloneWorkOrder: base_url + "workorder/clone_ajax",
};

$(document).ready(function () {
  // change the install type
  // show company name text box
  $(document).on("change", "#customer_install_type", function (e) {
    if ($(this).val() === "Takeover") {
      $("#customer_company_name").parent().show();
      $("#customer_company_name").attr("disabled", false);
    } else {
      $("#customer_company_name").parent().hide();
      $("#customer_company_name").attr("disabled", true);
    }
  });

  // change the install type
  // show company name text box
  $(document).on("change", "#account_type", function (e) {
    if ($(this).val() === "Other") {
      $(this).next().show();
      $(this).next().find("input").attr("disabled", false);
    } else {
      $(this).next().hide();
      $(this).next().find("input").attr("disabled", true);
    }
  });

  // change the install type
  // show company name text box
  $(document).on("change", "#post_service_lead_source", function (e) {
    if ($(this).val() === "Other") {
      $(this).next().show();
      $(this).next().find("input").attr("disabled", false);
    } else {
      $(this).next().hide();
      $(this).next().find("input").attr("disabled", true);
    }
  });

  // plan type change
  $(document).on("change", "#plan_type", function (e) {
    // alert($(this).val());
    getplanItems($(this).val());
  });

  $("#employee_assign_to").select2({
    ajax: {
      url: options.urlEmployeeList,
      dataType: "json",
      delay: 250,
      data: function (params) {
        return {
          q: params.term, // search term
          page: params.page,
        };
      },
      processResults: function (data, params) {
        // parse the results into the format expected by Select2
        // since we are using custom formatting functions we do not need to
        // alter the remote JSON data, except to indicate that infinite
        // scrolling can be used
        params.page = params.page || 1;

        return {
          results: data,
          // pagination: {
          //   more: (params.page * 30) < data.total_count
          // }
        };
      },
      cache: true,
    },
    placeholder: "Search for a source",
    minimumInputLength: 0,
    templateResult: formatRepo,
    templateSelection: formatRepoSelection,
  });

  // signature for Technician
  $("#smoothed").signaturePad({
    drawOnly: true,
    drawBezierCurves: true,
    lineTop: 200,
  });
  $("#company_representative_approval_signature").on(
    "click touchstart",
    function () {
      var canvas = document.getElementById(
        "company_representative_approval_signature"
      );
      var dataURL = canvas.toDataURL("image/png");
      $("#saveCompanySignatureDB").val(dataURL);
    }
  );

  // signature for Technician
  $("#smoothed2").signaturePad({
    drawOnly: true,
    drawBezierCurves: true,
    lineTop: 200,
  });
  $("#primary_account_holder_signature").on("click touchstart", function () {
    var canvas = document.getElementById("primary_account_holder_signature");
    var dataURL = canvas.toDataURL("image/png");
    $("#savePrimaryAccountSignatureDB").val(dataURL);
  });

  // signature for Technician
  $("#smoothed3").signaturePad({
    drawOnly: true,
    drawBezierCurves: true,
    lineTop: 200,
  });
  $("#secondary_account_holder_signature").on("click touchstart", function () {
    var canvas = document.getElementById("secondary_account_holder_signature");
    var dataURL = canvas.toDataURL("image/png");
    $("#saveSecondaryAccountSignatureDB").val(dataURL);
  });

  $("#datepicker_installation_time").datetimepicker({
    format: "LT",
  });

  $(
    "#customer_contact_dob, #workorder_date, #customer_spouse_contact_dob, #billing_date, #card_exp_date, #date_w_issued"
  ).datetimepicker({
    format: "L",
  });

  // remove item from list
  $(document).on("click", ".remove-data-item", function (e) {
    e.preventDefault();

    var button = $(this);
    var row = $(this).parent().parent();

    if (confirm("Do you really want to delete this item ?")) {
      $(button).attr("disabled", true);
      $(row).css({ opacity: ".50" });

      jQuery.ajax({
        url: $(this).attr("href"),
        type: "DELETE",
        success: function (response) {
          console.log(response);
          $(row).remove();
        },
        error: function (err) {
          $(button).attr("disabled", false);
          $(row).css({ opacity: "1" });
        },
      });
    }
  });

  // workorder clone modal open
  var workorder_id;
  $("#modalCloneWorkorder").on("shown.bs.modal", function (e) {
    workorder_id = $(e.relatedTarget).attr("data-id");

    $(".data_workorder_id").text("WO-00" + workorder_id);
  });

  // workorder clone
  $(document).on("click", "#clone_workorder", function () {
    var button = $(this);

    $(button).attr("disabled", true);
    $(button).text("cloning...");

    jQuery.ajax({
      url: options.urlCloneWorkOrder,
      type: "POST",
      data: { workorder_id: workorder_id },
      success: function (response) {
        console.log(response);
        location.reload();
      },
      error: function (err) {
        $(button).attr("disabled", false);
        $(button).text("Clone Work Order");
      },
    });
  });
});

function formatRepo(repo) {
  console.log(repo);
  if (repo) {
    return repo.name;
  }

  var $container = $(
    "<div class='select2-result-repository clearfix'>" +
      "<div class='select2-result-repository__meta'>" +
      "<div class='select2-result-repository__title'></div>" +
      "</div>" +
      "</div>" +
      "</div>"
  );

  $container.find(".select2-result-repository__title").text(repo.name);

  return $container;
}

function formatRepoSelection(repo) {
  console.log(repo);
  return repo.name || repo.text;
}

function dropdownAccounting(n) {
  var id = $(n).attr("href");
  var sidebar = $("#sidebar").width();
  var s;
  if (sidebar == 40) {
    s = "41px";
  } else if (sidebar == 210) {
    s = "211px";
  } else {
    s = "261px";
  }

  if ($(id).css("display") == "none") {
    $(".sidebar-accounting li ul").hide();
    $("#sidebar ul li > ul").css("left", s);
    $(id).slideDown();
  } else {
    $(id).slideUp();
  }
}
