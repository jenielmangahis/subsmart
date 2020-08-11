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
          $(".total-schedule").html('<span class="badge badge-primary">'+o.total_events+'</span>');
          $(".total-taskhub").html('<span class="badge badge-primary">'+o.total_taskhub+'</span>');
          $(".total-online-booking").html('<span class="badge badge-primary">'+o.total_online_booking+'</span>');
       }
    });
  }
});