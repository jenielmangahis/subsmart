$(document).ready(function () {
    var break_end_time = 0;
    var minutes = 0;
    var seconds = 0;
    var end_of_break = new Date($('#clock-end-time').val()).getTime();
    var get_server_time,break_time;
    function serverTime () {
        var server_time;
            $.ajax({
                url:"/timesheet/serverTime",
                dataType:"json",
                async: false,
                success:function (data) {
                    server_time = data.date_time;
                    break_end_time = data.end_time;
                }
            });
        get_server_time = setTimeout(serverTime, 1000);
        return server_time;
    }
    $('.clock-users').click(function () {
        $('.preview-clock-details').removeClass('visible');
    });
    $('.clock-users').dblclick(function () {
        $('.preview-clock-details').addClass('visible');
    });
    $(document).on('click','#clockIn',function () {
        var clock_in = serverTime();
        clearTimeout(get_server_time);
        Swal.fire({
            title: 'Clock in?',
            html: "Are you sure you want to Clock-in?",
            imageUrl:"/assets/img/timesheet/work.png",
            showCancelButton: true,
            confirmButtonColor: '#2ca01c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, I want to Clock-in!'
        }).then((result) => {
            if (result.value) {
            $.ajax({
               url:'/timesheet/clockInEmployee',
               type:"POST",
               dataType:'json',
               data:{clock_in:clock_in},
               success:function () {

               } 
            });
        }
    });
    });
    // Set the date we're counting down to

    // Update the count down every 1 second
    // var breakTime = setInterval(function() {
    //     // Get today's date and time
    //     var now = new Date(server_time).getTime();
    //     // Find the distance between now an the count down date
    //     var distance = end_of_break - now;
    //
    //     // Time calculations for minutes and seconds
    //     minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    //     seconds = Math.floor((distance % (1000 * 60)) / 1000);
    //     if (!isNaN(minutes) && !isNaN(seconds)){
    //         $('#break-duration').text(remainTwoDigit(minutes,2)+":"+remainTwoDigit(seconds,2));
    //     }
    // }, 1000);
    function breakTime() {
        // Get today's date and time
        var now = new Date(serverTime ()).getTime();
        clearTimeout(get_server_time);
        // Find the distance between now an the count down date
        var distance = end_of_break - now;

        // Time calculations for minutes and seconds
        minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        seconds = Math.floor((distance % (1000 * 60)) / 1000);
        if (!isNaN(minutes) && !isNaN(seconds)){
            $('#break-duration').text(remainTwoDigit(minutes,2)+":"+remainTwoDigit(seconds,2));
        }
        break_time = setTimeout(breakTime, 1000);
    }
    if ($('#clock-status').val() == 0 || $('#clock-status').val() == 2){
        clearInterval(break_time);
    }

    // $('#startBreak').click(function (e) {
    //     if ($(this).attr('disabled')){
    //         e.preventDefault();
    //     }else{
    //         $('.clock').addClass('clock-break');
    //         $(this).attr('disabled',true);
    //         $.ajax({
    //            url:'/timesheet/startBreak',
    //            method:"POST",
    //            dataType:"json",
    //            data:{break_time:break_end_time},
    //            success:function (data) {
    //                end_of_break = new Date(data).getTime();
    //            }
    //         });
    //     }
    //     if ($('#clock-session').val() == 0){
    //         $('#clock-session').val(1);
    //         $('.clock-users + .preview-clock-details').addClass('visible');
    //         $('#stopBreak').css('color','red');
    //     }else{
    //         $('#clock-session').val(0);
    //         $('.clock-users + .preview-clock-details').removeClass('visible');
    //     }
    // });
    // $('#stopBreak').click(function () {
    //     $(this).css('color','grey');
    //     $('.clock').removeClass('clock-break');
    //     $('#startBreak').attr('disabled',false);
    //     clearInterval(breakTime);
    //     $('#clock-session').val(0);
    //     // $('.clock-users + .preview-clock-details').removeClass('visible');
    //     $.ajax({
    //         url:"/timesheet/stopBreak",
    //         type:"POST",
    //         dataType:"json",
    //         data:{minutes:minutes,seconds:seconds},
    //         success:function (data) {
    //             $('#break-duration').text(data);
    //         }
    //     })
    // });
    function remainTwoDigit(number, targetLength) {
        var output = number + '';
        while (output.length < targetLength) {
            output = '0' + output;
        }
        return output;
    }
});

//Live Clock JS
const deg = 6;
const hr = document.querySelector("#hr");
const min = document.querySelector("#min");
const sec = document.querySelector("#sec");
setInterval(() => {
    let day = new Date();
let hh = day.getHours() * 30;
let mm = day.getMinutes() * deg;
let ss = day.getSeconds() * deg;
hr.style.transform = 'rotateZ(' + (hh + (mm / 12)) + 'deg)';
min.style.transform = 'rotateZ(' + mm + 'deg)';
sec.style.transform = 'rotateZ(' + ss + 'deg)';

});
