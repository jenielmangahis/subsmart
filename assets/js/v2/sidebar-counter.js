$(function(){
    sidebarStatCount();
    function sidebarStatCount(){
        var url = base_url + 'notification/_calendar_notification_counter';
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: 'json',
             success: function(o)
             {         
                if( o.total_taskhub > 0 ){
                    $('#sidebar-taskhub-counter').html('<span class="badge badge-primary pull-right">'+o.total_taskhub+'</span>')
                }
                if( o.total_company > 0 ){
                    $('#sidebar-company-counter').html('<span class="badge badge-primary pull-right">'+o.total_company+'</span>')
                }
                if( o.total_person > 0 ){
                    $('#sidebar-persons-counter').html('<span class="badge badge-primary pull-right">'+o.total_person+'</span>')
                }
                if( o.total_subscribers > 0 ){
                    $('#sidebar-subscribers-counter').html('<span class="badge badge-primary">'+o.total_subscribers+'</span>')
                }
                if( o.total_calendar_schedule > 0 ){
                    $('#sidebar-calendar-schedule-counter').html('<span class="badge badge-primary pull-right">'+o.total_calendar_schedule+'</span>')   
                }
             }
          });
        }, 100);
    }
});