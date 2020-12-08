function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $("#img_profile").attr("src", e.target.result).width(100).height(100);
      };
  
      reader.readAsDataURL(input.files[0]);
    }
  }

function readImageURL(input, targetId) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $("#"+targetId).attr("src", e.target.result).width(100).height(100);
    };

    reader.readAsDataURL(input.files[0]);
  }
}
          
function saveNewAvailability(param) {
  var items = [];
  $.ajax({
    type: "POST",
    url: base_url + "users/add_availability",
    data: param,
    success: function (data) {
      $('#availabilityModal').modal('show');
    },
  });
}