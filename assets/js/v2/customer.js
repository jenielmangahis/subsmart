$(function(){

    $(document).on('click', '.customer-notifications', function(){
        customer_messages_notification();
    });

    $(document).on('click', '.btn-clear-notification', function(){
        customer_clear_notification();
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

    function customer_clear_notification(){
        var url = base_url + 'acs_access/_clear_notifications';
        setTimeout(function () {
          $.ajax({
             dataType:'json',
             type: "POST",
             url: url,
             success: function(o)
             {          
                
                customer_messages_notification();
             }
          });
        }, 100);
    }
});