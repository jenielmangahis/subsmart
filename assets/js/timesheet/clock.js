$(document).ready(function () {
    var break_end_time = 0;
    var minutes = 0;
    var seconds = 0;
    var remaining_time = 0;
    var get_server_time,countdown;
    var difference = 0;

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
    $(document).on('click','#notificationDP',function () {
        var id = $(this).attr('data-id');
        $.ajax({
           url:"/timesheet/readNotification",
           type:"POST",
           data:{id:id},
           success:function (data) {

           }
        });
    });
    $(document).on('click','#clockIn',function () {
        var selected = this;
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
               // data:{clock_in:clock_in},
               success:function (data) {
                    if (data != null){
                        $(selected).attr('id','clockOut');
                        $('.clock').addClass('clock-active');
                        $('#attendanceId').val(data.attendance_id);
                        $('.in').text(data.clock_in_time);
                        $('.out').text(data.clock_out_time);
                        $('#userClockIn').text(data.clock_in_time);
                        $('.employeeLunch').attr('id','lunchIn').attr('disabled',false);
                        Swal.fire(
                            {
                                showConfirmButton: false,
                                timer: 2000,
                                title: 'Success',
                                html: "You are now Clock-in",
                                icon: 'success'
                            });
                    }
               } 
            });
        }
    });
    });
    $(document).on('click','#clockOut',function () {
        var selected = this;
        var attn_id = $('#attendanceId').val();
        Swal.fire({
            title: 'Clock out?',
            html: "Are you sure you want to Clock-out?",
            imageUrl:"/assets/img/timesheet/clock-out.png",
            showCancelButton: true,
            confirmButtonColor: '#2ca01c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, I want to Clock-out!'
        }).then((result) => {
            if (result.value) {
            $.ajax({
                url:'/timesheet/clockOutEmployee',
                type:"POST",
                dataType:'json',
                data:{attn_id:attn_id},
                success:function (data) {
                    if (data != null){
                        $(selected).attr('id',null);
                        $('.clock').removeClass('clock-active');
                        $('.out').text(data.clock_out_time);
                        $('#userClockOut').text(data.clock_out_time);
                        $('#shiftDuration').text(data.shift_duration);
                        $('.employeeLunch').attr('id',null).attr('disabled',true);
                        Swal.fire(
                            {
                                showConfirmButton: false,
                                timer: 2000,
                                title: 'Success',
                                html: "You are now Clock-out",
                                icon: 'success'
                            });
                    }
                }
            });
        }
    });
    });
    $(document).on('click','#lunchIn',function () {
        var selected = this;
        var attn_id = $('#attendanceId').val();
        Swal.fire({
            title: 'Lunch in?',
            html: "Are you sure you want to Lunch-in?",
            imageUrl:"/assets/img/timesheet/lunch.png",
            showCancelButton: true,
            confirmButtonColor: '#2ca01c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, I want to Lunch-in!'
        }).then((result) => {
            if (result.value) {
            var time = new Date();
            var end_of_break = time.setMinutes(time.getMinutes() + 60);
            $.ajax({
                url:'/timesheet/lunchInEmployee',
                type:"POST",
                dataType:'json',
                data:{attn_id:attn_id,end_of_break:end_of_break},
                success:function (data) {
                    if (data != null){
                        $(selected).attr('id','lunchOut');
                        $('.clock').removeClass('clock-active').addClass('clock-break');
                        $('#userLunchIn').text(data.lunch_in_time);
                        $(selected).children('.fa-coffee').removeClass('fa-coffee').addClass('fa-mug-hot');
                        break_end_time = data.end_break;
                        $('#clock-end-time').val(break_end_time);
                        breakTime();
                        Swal.fire(
                            {
                                showConfirmButton: false,
                                timer: 2000,
                                title: 'Success',
                                html: "You are now Lunch-in",
                                icon: 'success'
                            });
                    }
                }
            });
        }
    });
    });
    if($('#clock-status').val() == 1){
        breakTime();
    }
    function breakTime() {
        var end =  $('#clock-end-time').val();
        // Get today's date and time
        var now = new Date().getTime();
        // clearTimeout(get_server_time);
        // Find the distance between now an the count down date
        difference = end - now;

        // Time calculations for minutes and seconds
        minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
        seconds = Math.floor((difference % (1000 * 60)) / 1000);
        if (seconds >= 0){
            $('#break-duration').text(remainTwoDigit(minutes,2)+":"+remainTwoDigit(seconds,2));
            remaining_time = remainTwoDigit(minutes,2)+":"+remainTwoDigit(seconds,2);
        }else{
            remaining_time = remainTwoDigit(minutes,2)+":"+remainTwoDigit(seconds,2);
            var attn_id = $('#attendanceId').val();
            $.ajax({
                url:'/timesheet/lunchOutEmployee',
                type:"POST",
                dataType:'json',
                data:{attn_id:attn_id,remaining_time:remaining_time},
                success:function (data) {
                    if (data != null){
                        $('.clock').removeClass('clock-break').addClass('clock-active');
                        $('#userLunchOut').text(data.lunch_out_time);
                        $('#clock-end-time').val(data.remaining);
                        $('.employeeLunch').attr('id',null).children('i').removeClass('fa-mug-hot').addClass('fa-coffee');
                        $('#notifyBadge').css('visibility','visible').text(1);
                        $('#notificationList').prepend(data.notifications);
                        $('.layer-1').css('animation','animation-layer-1 5000ms infinite');
                        $('.layer-2').css('animation','animation-layer-2 5000ms infinite');
                        $('.layer-3').css('animation','animation-layer-3 5000ms infinite');
                        stopCountdown();
                        Swal.fire(
                            {
                                showConfirmButton: true,
                                title: 'Success',
                                html: "You are now Lunch-out",
                                icon: 'success'
                            });
                    }
                }
            });
        }
        countdown = setTimeout(breakTime, 1000);
    }
    // clearTimeout(countdown);
    function stopCountdown() {
        clearTimeout(countdown);
    }
    // clearTimeout(countdown);
    function remainTwoDigit(number, targetLength) {
        var output = number + '';
        while (output.length < targetLength) {
            output = '0' + output;
        }
        return output;
    }
    $(document).on('click','#lunchOut',function () {
        var selected = this;
        var attn_id = $('#attendanceId').val();
        Swal.fire({
            title: 'Lunch out?',
            html: "Are you sure you want to Lunch-out?",
            imageUrl:"/assets/img/timesheet/work.png",
            showCancelButton: true,
            confirmButtonColor: '#2ca01c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, I want to Lunch-out!'
        }).then((result) => {
            if (result.value) {
            $.ajax({
                url:'/timesheet/lunchOutEmployee',
                type:"POST",
                dataType:'json',
                data:{attn_id:attn_id,remaining_time:remaining_time},
                success:function (data) {
                    if (data != null){
                        $(selected).attr('id',null);
                        $('.clock').removeClass('clock-break').addClass('clock-active');
                        $('#userLunchOut').text(data.lunch_out_time);
                        $(selected).children('.fa-mug-hot').removeClass('fa-mug-hot').addClass('fa-coffee');
                        $('#clock-end-time').val(data.remaining);
                        clearTimeout(countdown);
                        Swal.fire(
                            {
                                showConfirmButton: false,
                                timer: 2000,
                                title: 'Success',
                                html: "You are now Lunch-out",
                                icon: 'success'
                            });
                    }
                }
            });
        }
    });
    });

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
