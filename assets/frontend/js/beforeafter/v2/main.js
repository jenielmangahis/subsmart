$(document).ready(function () {
  $("#beforeAfterListTable").DataTable({
    destroy: true,
  });

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

  $(document).on(
    "click",
    ".editDeleteBeforeAfterBtn, #saveBtnAddPhotos",
    function () {
      $.LoadingOverlay("show");
    }
  );
});

function readURL(input, id) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $("#" + id).attr("src", e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
}

function readURLv2(input, id) {
  var limit = 4;
  if (input.files && input.files[0]) {
      var filesize = input.files[0].size / Math.pow(1024,2); 
      if( filesize > limit ){
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            html: 'Can only accept maximum filesize of ' + limit + 'MB'
        });
      }else{
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#" + id).attr("src", e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
      }            
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
