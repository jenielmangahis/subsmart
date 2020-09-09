$(document).ready(function () {
    var break_end_time = 0;
    var minutes = 0;
    var seconds = 0;
    var end_of_break = new Date($('#clock-end-time').val()).getTime();
    // var serverTime = setInterval(function () {
    //     $.ajax({
    //         url:"/timesheet/serverTime",
    //         dataType:"json",
    //         success:function (data) {
    //             server_time = data.date_time;
    //             break_end_time = data.end_time;
    //         }
    //     });
    // },1000);
    function serverTime () {
        var server_time = 0;
            $.ajax({
                url:"/timesheet/serverTime",
                dataType:"json",
                async: false,
                success:function (data) {
                    server_time = data.date_time;
                    break_end_time = data.end_time;
                }
            });
        setTimeout(serverTime, 1000);
        return server_time;
    }
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
        // Find the distance between now an the count down date
        var distance = end_of_break - now;

        // Time calculations for minutes and seconds
        minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        seconds = Math.floor((distance % (1000 * 60)) / 1000);
        if (!isNaN(minutes) && !isNaN(seconds)){
            $('#break-duration').text(remainTwoDigit(minutes,2)+":"+remainTwoDigit(seconds,2));
        }
        setTimeout(breakTime, 1000);
    }
    if ($('#clock-status').val() == 0 || $('#clock-status').val() == 2){
        clearInterval(breakTime);
    }

    $('#startBreak').click(function (e) {
        if ($(this).attr('disabled')){
            e.preventDefault();
        }else{
            $('.clock').addClass('clock-break');
            $(this).attr('disabled',true);
            $.ajax({
               url:'/timesheet/startBreak',
               method:"POST",
               dataType:"json",
               data:{break_time:break_end_time},
               success:function (data) {
                   end_of_break = new Date(data).getTime();
               }
            });
        }
        if ($('#clock-session').val() == 0){
            $('#clock-session').val(1);
            $('.clock-users + .preview-clock-details').addClass('visible');
            $('#stopBreak').css('color','red');
        }else{
            $('#clock-session').val(0);
            $('.clock-users + .preview-clock-details').removeClass('visible');
        }
    });
    $('#stopBreak').click(function () {
        $(this).css('color','grey');
        $('.clock').removeClass('clock-break');
        $('#startBreak').attr('disabled',false);
        clearInterval(breakTime);
        $('#clock-session').val(0);
        // $('.clock-users + .preview-clock-details').removeClass('visible');
        $.ajax({
            url:"/timesheet/stopBreak",
            type:"POST",
            dataType:"json",
            data:{minutes:minutes,seconds:seconds},
            success:function (data) {
                $('#break-duration').text(data);
            }
        })
    });
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
