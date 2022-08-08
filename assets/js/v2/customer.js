$(function(){

    $(document).on('click', '.customer-notifications', function(){
        customer_messages_notification();
    });

    function customer_messages_notification(){
        var url = base_url + 'acs_access/_notifications';
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             success: function(o)
             {          
                
                $("#notifications_container").html(o);
             }
          });
        }, 100);
    }
});