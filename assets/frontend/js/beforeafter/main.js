$(document).ready(function () {
  $("img.beforeImgPhoto").click(function () {
    var imgDiv = $(this).next("#fileimage");
    imgDiv.trigger("click");
  });

  $("#job_customer").autocomplete({
    source: getCustomers(),
    change: function (event, ui) {
      $("#job_customer_id").val(ui.item.id);
    },
  });
});

function readURL(input, id) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $("#" + id)
        .attr("src", e.target.result)
        .height(165);
    };

    reader.readAsDataURL(input.files[0]);
  }
}

function capitalizeFirstLetter(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

function getCustomers() {
  var customers = [];
  $.ajax({
    type: "GET",
    url: base_url + "job/getCustomers",
    success: function (data) {
      var result = jQuery.parseJSON(data);
      $.each(result, function (key, val) {
        customers.push({
          id: val.id,
          label:
            capitalizeFirstLetter(val.FName) + capitalizeFirstLetter(val.LName),
        });
      });
    },
  });
  return customers;
}
