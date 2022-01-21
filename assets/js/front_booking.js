$(document).ready(function() {
    $(".qty_plus").click(function(){
      var id  = $(this).attr("data-id");
      var qty = parseInt($("#qty-input-"+id).val());
      var newQty = qty + 1;

      $("#qty-input-"+id).val(newQty);
    });

    $(".qty_minus").click(function(){
      var id  = $(this).attr("data-id");
      var qty = parseInt($("#qty-input-"+id).val());
      if(qty > 1){
        var newQty = qty - 1;
      }else{
        var newQty = 1;
      }

      $("#qty-input-"+id).val(newQty);

    });

    $(".product__img__cnt").click(function(){
      var pid = $(this).attr('data-product-id');
      var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline;" /> Loading...</div>';
      var url = base_url + '/booking/_product_details';

      $("#modalQuickLook").modal('show');
      $(".quick-look-body").html(msg);

      setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {pid:pid},
             success: function(o)
             {
                $(".quick-look-body").html(o);
             }
          });
      }, 1000);
    });

    $(".btn-add-cart").click(function(){
      var pid = $(this).attr("data-id");
      var qty = $("#qty-input-" + pid).val();
      var url = base_url + '/booking/_add_cart_item';
      var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline;" /> Adding item to cart...</div>';

      $(this).html('<span class="spinner-border spinner-border-sm m-0"></span>');

      setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {pid:pid,qty:qty},
             success: function(o)
             {
                Swal.fire({
                    text: 'Your cart was successfully updated',
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#32243d',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    $(this).html('Add to cart');
                    location.reload();
                });                
             }
          });
      }, 1000);
    });

     $(".btn-apply-coupon").click(function(){
      var coupon_code = $("#coupon_code").val();
      var eid = $(this).attr('data-id');
      var url = base_url + '/booking/_add_cart_coupon';
      var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline;" /> Adding item to cart...</div>';

      $(this).html('<span class="spinner-border spinner-border-sm m-0"></span>');

      setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: "json",
             data: {coupon_code:coupon_code, eid:eid},
             success: function(o)
             {
                $('.btn-apply-coupon').html('Apply');

                if( o.is_success == 1 ){
                  Swal.fire({
                      text: 'Coupon code applied',
                      icon: 'success',
                      showCancelButton: false,
                      confirmButtonColor: '#32243d',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Ok'
                  }).then((result) => {
                      location.reload();
                  });  
                }else{
                  Swal.fire({
                    icon: 'error',
                    title: 'Invalid coupon code',
                    text: o.msg
                  });
                }
             }
          });
      }, 1000);
    });

    $(".delete-cart-item").click(function(){
      var pid = $(this).attr("data-id");
      var url = base_url + '/booking/_delete_cart_item';
      var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline;" /> Updating cart items...</div>';

      $(this).html('<span class="spinner-border spinner-border-sm m-0"></span>');

      setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {pid:pid},
             success: function(o)
             {
                $(this).html('<span class="fa fa-trash"></span>');
                Swal.fire({
                    text: 'Your cart was successfully updated',
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#32243d',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    location.reload();
                });
             }
          });
      }, 1000);
      
    });
    
    $(".delete-coupon").click(function(){
      var pid = $(this).attr("data-id");
      var url = base_url + '/booking/_delete_coupon';
      var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline;" /> Removing coupon...</div>';

      $(this).html('<span class="spinner-border spinner-border-sm m-0"></span>');
      
      setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {pid:pid},
             success: function(o)
             {
                Swal.fire({
                    text: 'Coupon code was successfully removed',
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#32243d',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    location.reload();
                });
             }
          });
      }, 1000);
      
    });
});

