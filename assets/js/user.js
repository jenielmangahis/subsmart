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