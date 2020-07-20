var options = {
  urlGetAllCustomers: base_url + "customer/json_dropdown_customer_list",
};

$(document).ready(function () {
  $("#customers").select2({
    ajax: {
      url: options.urlGetAllCustomers,
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
    placeholder: "Select customer",
    minimumInputLength: 0,
    templateResult: formatRepo,
    templateSelection: formatRepoSelection,
  });

  $("#btnExistingJob").click(function () {
    console.log("test");
    if ($("#selectExistingJob").val()) {
      // $.LoadingOverlay("show");
      window.location.href =
        base_url + "/job/new_job?job_num=" + $("#selectExistingJob").val();
    }
  });
});

function formatRepo(repo) {
  console.log(repo);
  if (repo) {
    return repo.contact_name;
  }

  var $container = $(
    "<div class='select2-result-repository clearfix'>" +
      "<div class='select2-result-repository__meta'>" +
      "<div class='select2-result-repository__title'></div>" +
      "</div>" +
      "</div>" +
      "</div>"
  );

  $container.find(".select2-result-repository__title").text(repo.contact_name);

  return $container;
}

function formatRepoSelection(repo) {
  console.log(repo);
  return repo.contact_name || repo.text;
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
