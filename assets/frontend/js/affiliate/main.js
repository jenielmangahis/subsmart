$(document).ready(function () {
    $("#affiliateListTbl").DataTable({
      destroy: true,
    });

    $("#addMailAdd").click(function() {
        $(".hide-address").fadeIn();
        $("#hideMailAdd").show();
        $("#addMailAdd").hide();
    });

    $("#hideMailAdd").click(function() {
        $(".hide-address").hide();
        $("#hideMailAdd").hide();
        $("#addMailAdd").show();
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
  