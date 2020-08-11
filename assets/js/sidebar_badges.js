$(function(){

  if( nav_badges == 'calendar' ){
    calendar_badges();
  }

  function calendar_badges(){
    var url = base_url + '/notification/calendar_notification_counter';
    $.ajax({
       type: "GET",
       url: url,
       dataType: 'json',
       data: {},
       success: function(o)
       {  
          if( o.total_events > 0){
            $(".total-schedule").html('<span class="badge badge-primary">'+o.total_events+'</span>');
          }
          if( o.total_taskhub > 0 ){
            $(".total-taskhub").html('<span class="badge badge-primary">'+o.total_taskhub+'</span>');  
          }
          if( o.total_online_booking > 0 ){
            $(".total-online-booking").html('<span class="badge badge-primary">'+o.total_online_booking+'</span>');
          }           
       }
    });
  }
});