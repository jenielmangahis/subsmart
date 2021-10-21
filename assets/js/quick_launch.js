//Quick launch scripts
$(function(){
  
  $(".btn-ql-customer").click(function(){
    var close_modal = $(this).attr('data-modal');
    if (typeof close_modal !== 'undefined' && close_modal !== false) {
        $("#" + close_modal).modal('hide');
        $("#ql-customer-open-modal").val(close_modal);
    }
    $("#modal-ql-add-customer").modal('show');
  });

  $("#frm-ql-add-customer").submit(function(e){
    e.preventDefault();
    var url = base_url + 'quick_add/_add_customer';
    $(".btn-ql-add-customer").html('<span class="spinner-border spinner-border-sm m-0"></span>');
    setTimeout(function () {
        $.ajax({
           type: "POST",
           url: url,
           data: $("#frm-ql-add-customer").serialize(),
           dataType: 'json',
           success: function(o)
           {
              if( o.is_success ){                             
                $("#modal-ql-add-customer").modal('hide');
                $('#frm-ql-add-customer')[0].reset();
                Swal.fire({
                    title: 'Success',
                    text: 'New customer was successfully added',
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#32243d',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.value) {
                      var open_modal = $("#ql-customer-open-modal").val();
                      if( open_modal != '' ){
                        $("#" + open_modal).modal('show');
                      }   
                    }
                });

              }else{
                Swal.fire({
                  icon: 'error',
                  title: 'Cannot create customer.',
                  text: o.msg
                });
              }

              $(".btn-ql-add-customer").html("Save");
           }
        });
    }, 1000);    
  });


});