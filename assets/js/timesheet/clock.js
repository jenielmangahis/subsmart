$(document).ready(function () {
    let counter;
    let break_content = $('#break-duration').text();
    let hours=parseInt(break_content.slice(0,1)),minutes=parseInt(break_content.slice(4,5)),seconds=parseInt(break_content.slice(7,8));
    let pause_time;
    let lunch_h = 0;
    let lunch_m = 0;
    let lunch_s = 0;
    let difference = 0,latest_diff = 0;

    async function notificationRing() {
        const audio = new Audio();
        audio.src = '../assets/css/notification/notification_tone2.mp3';
        audio.muted = false;
        try {
           await audio.play();
        } catch(err) {
            console.log('error');
        }
    }
    if($('#clock-status').val() == 1){
        breakTime();
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
        let selected = this;
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
                   console.log('test');
                    if (data != null){
                        $(selected).attr('id','clockOut');
                        $('.clock').addClass('clock-active');
                        $('#attendanceId').val(data.attendance_id);
                        $('.in').text(data.clock_in_time);
                        $('.out').text(data.clock_out_time);
                        $('#userClockIn').text(data.clock_in_time);
                        $('#userClockOut').text('-');
                        $('#userLunchIn').text('-');
                        $('#userLunchOut').text('-');
                        $('#shiftDuration').text('-');
                        $('#userShiftDuration').text('-');
                        $('#break-duration').text('60:00');
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
        let selected = this;
        let attn_id = $('#attendanceId').val();
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
                        $('#userShiftDuration').text(data.shift_duration);
                        $('.employeeLunch').attr('id',null).attr('disabled',true);
                        $('#unScheduledShift').val(0);
                        $('#autoClockOut').val(2);
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
        let selected = this;
        let attn_id = $('#attendanceId').val();
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
            $.ajax({
                url:'/timesheet/lunchInEmployee',
                type:"POST",
                dataType:'json',
                data:{attn_id:attn_id},
                success:function (data) {
                    if (data != null){
                        console.log('clock-out')
                        $(selected).attr('id','lunchOut');
                        $('.clock').removeClass('clock-active').addClass('clock-break');
                        $('#userLunchIn').text(data.lunch_in);
                        $('#userLunchOut').text(null);
                        $('#lunchStartTime').val(data.timestamp);
                        $('#latestLunchTime').val(data.latest_in);
                        $(selected).children('.btn-lunch').attr('src','/assets/css/timesheet/images/coffee-active.svg');
                        $('#clock-status').val(1);
                        $('#autoClockOut').val(0);
                        // break_end_time = data.end_break;
                        // $('#clock-end-time').val(break_end_time);
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
    function breakTime() {
        let latest_lunch = $('#latestLunchTime').val();
        let start = $('#lunchStartTime').val();
        let now = Date.now() ;
        let output = parseInt(start) * 1000;
        difference = now - output;

        hours = Math.floor(difference / 60 / 60 / 1000);
        minutes =  Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
        seconds = Math.floor((difference % (1000 * 60)) / 1000);
        //Get the present lunch in difference
        if (latest_lunch > 0){
            latest_diff = now - (parseInt(latest_lunch) * 1000)
            lunch_h = Math.floor(latest_diff / 60 / 60 / 1000);
            lunch_m =  Math.floor((latest_diff % (1000 * 60 * 60)) / (1000 * 60));
            lunch_s = Math.floor((latest_diff % (1000 * 60)) / 1000);
        }

        $('#break-duration').text(remainTwoDigit(hours,2)+":"+remainTwoDigit(minutes,2)+":"+remainTwoDigit(seconds,2));
        if (latest_lunch > 0){
            pause_time = remainTwoDigit(lunch_h,2)+":"+remainTwoDigit(lunch_m,2)+":"+remainTwoDigit(lunch_s,2);
        }else{
            pause_time = remainTwoDigit(hours,2)+":"+remainTwoDigit(minutes,2)+":"+remainTwoDigit(seconds,2);
        }

        counter = setTimeout(breakTime, 1000);
    }

    function stopCountdown() {
        clearTimeout(counter);
    }

    function remainTwoDigit(number, targetLength) {
        let output = number + '';
        while (output.length < targetLength) {
            output = '0' + output;
        }
        return output;
    }
    $(document).on('click','#lunchOut',function () {
        let selected = this;
        let attn_id = $('#attendanceId').val();
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
                data:{attn_id:attn_id,pause_time:pause_time},
                success:function (data) {
                    if (data != null){
                        $(selected).attr('id','lunchIn');
                        $('.clock').removeClass('clock-break').addClass('clock-active');
                        $('#userLunchOut').text(data.lunch_time);
                        $(selected).children('.btn-lunch').attr('src','/assets/css/timesheet/images/coffee-static.svg');
                        clearTimeout(counter);
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
    let start_sched = (function() {
        let executed = false;
        return function() {
            if (!executed) {
                executed = true;
                $.ajax({
                    url:"/timesheet/notifyStartSchedule",
                    dataType:"json",
                    data:"POST",
                   success:function (data) {
                       var notify_count = $('#notifyBadge').text();
                       if (notify_count == ''){
                           notify_count = 0;
                       }
                       var count = parseInt(notify_count) + 1;
                       $('#notificationList').prepend(data);
                       $('#notifyBadge').css('visibility','visible').text(count);
                       $('.layer-1').css('animation','animation-layer-1 5000ms infinite');
                       $('.layer-2').css('animation','animation-layer-2 5000ms infinite');
                       $('.layer-3').css('animation','animation-layer-3 5000ms infinite');
                       $('#employeePingStart').val(0);
                       notificationRing();
                   }
                });
            }
        };
    })();
    let overtime = (function() {
        let executed = false;
        return function() {
            if (!executed) {
                executed = true;
                $.ajax({
                    url:"/timesheet/notifyEndSchedule",
                    dataType:"json",
                    data:"POST",
                    success:function (data) {
                        var notify_count = $('#notifyBadge').text();
                        if (notify_count == ''){
                            notify_count = 0;
                        }
                        var count = parseInt(notify_count) + 1;
                        $('#notificationList').prepend(data);
                        $('#notifyBadge').css('visibility','visible').text(count);
                        $('.layer-1').css('animation','animation-layer-1 5000ms infinite');
                        $('.layer-2').css('animation','animation-layer-2 5000ms infinite');
                        $('.layer-3').css('animation','animation-layer-3 5000ms infinite');
                        $('#employeePingEnd').val(0);
                        notificationRing();
                    }
                });
            }
        };
    })();


    let overtimeTimer = (function() {
        let executed = false;
        return function() {
            if (!executed) {
                executed = true;
                let attn_id = $('#attendanceId').val();
                let timerInterval;
                let current_time = new Date();
                let shift_end = $('#unScheduledShift').val();
                let set_time = new Date(shift_end * 1000);
                set_time.setMinutes(set_time.getMinutes() - 10);
                // set_time.setHours(set_time.getHours() + 1);
                let timer = set_time.setSeconds(set_time.getSeconds());
                let difference = timer - current_time.getTime();
                if (difference <= 0){
                    difference = 1000;
                }
                Swal.fire({
                    title: 'Do you want to overtime?',
                    icon:'question',
                    html:'Auto close after <strong></strong> seconds',
                    showDenyButton: true,
                    confirmButtonText: `Yes,I want to`,
                    denyButtonText: `Let's call it a day`,
                    allowOutsideClick: false,
                    timer: difference,
                    timerProgressBar: true,
                    willOpen: () => {
                        const content = Swal.getContent();
                        const $ = content.querySelector.bind(content);
                        timerInterval = setInterval(() => {
                            if((Swal.getTimerLeft() / 1000).toFixed(0) >= 0){
                                Swal.getContent().querySelector('strong').textContent = (Swal.getTimerLeft() / 1000).toFixed(0);
                            }else{
                                clearInterval(timerInterval);
                            }
                        }, 100);
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    let status = 0;
                    if (result.isConfirmed) {
                        status = 1;
                        $.ajax({
                            url:"/timesheet/overtimeApproval",
                            type:"POST",
                            dataType:"json",
                            data:{attn_id:attn_id,status:status},
                            success:function (data) {
                                if (data == 1){
                                    $('#autoClockOut').val(1);
                                    Swal.fire(
                                        {
                                            showConfirmButton: false,
                                            timer: 2000,
                                            title: 'Success',
                                            html: "You can now work more without auto Clock-out.",
                                            icon: 'success'
                                        });
                                }
                            }
                        });
                    } else if (result.isDenied) {
                        status = 0;
                        $.ajax({
                            url:"/timesheet/overtimeApproval",
                            type:"POST",
                            dataType:"json",
                            data:{attn_id:attn_id,status:status},
                            success:function (data) {
                                if (data == 1){
                                    $('#autoClockOut').val(0);
                                    Swal.fire(
                                        {
                                            showConfirmButton: false,
                                            timer: 2000,
                                            title: 'Success',
                                            html: "You will automatically Clock-out once the end of shift comes.",
                                            icon: 'success'
                                        });
                                }
                            }
                        });
                    }
                    if (result.dismiss === Swal.DismissReason.timer) { 
                        autoClockOut(); 
                    }
                });
            }
        };
    })();
    //Auto clock out
    let autoClockOut = (function() {
        let executed = false;
        return function () {
            if (!executed) {
                executed = true;
                let attn_id = $('#attendanceId').val();
                let expected_end_shift = $('#employeeOvertime').val();
                if (expected_end_shift < 1 || expected_end_shift == ''){
                    expected_end_shift = $('#unScheduledShift').val();
                }
                let time_diff = $('#timeDifference').val();
                let end_shift = new Date(expected_end_shift * 1000);
                let time = end_shift.setHours(end_shift.getHours() - (time_diff));
                $.ajax({
                    url:"/timesheet/clockOutEmployee",
                    type:"POST",
                    dataType:'json',
                    data:{attn_id:attn_id,time:time},
                    success:function (data) {
                        if (data != null){
                            // $(selected).attr('id',null);
                            $('#unScheduledShift').val(null);
                            $('.clock').removeClass('clock-active');
                            $('.out').text(data.clock_out_time);
                            $('#userClockOut').text(data.clock_out_time);
                            $('#shiftDuration').text(data.shift_duration);
                            $('#userShiftDuration').text(data.shift_duration);
                            $('.employeeLunch').attr('id',null).attr('disabled',true);
                            $('#employeeOvertime').val(null);
                            Swal.fire(
                                {
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: 'Success',
                                    html: "You are now Clock-out",
                                    icon: 'success'
                                });
                        }else{
                            Swal.fire(
                                {
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: 'Failed',
                                    html: "Something is wrong in the process",
                                    icon: 'warning'
                                });
                        }
                    }
                })
            }
        }
    })();
    // end of auto clock out


    //Live Clock JS
    const deg = 6;
    const hr = document.querySelector("#hr");
    const min = document.querySelector("#min");
    const sec = document.querySelector("#sec");
    if (hr != null){
        setInterval(() => {
            let day = new Date();
        let hh = day.getHours() * 30;
        let mm = day.getMinutes() * deg;
        let ss = day.getSeconds() * deg;
        hr.style.transform = 'rotateZ(' + (hh + (mm / 12)) + 'deg)';
        min.style.transform = 'rotateZ(' + mm + 'deg)';
        sec.style.transform = 'rotateZ(' + ss + 'deg)';
        //Check if there is an schedule
        //Start shift notify
        let current_time = day.getTime();
        let emp_shift = $('#employeeShiftStart').val();
        let emp_overtime = $('#employeeOvertime').val();
        let sched_notify = $('#employeePingStart').val();
        let over_notify = $('#employeePingEnd').val();
        let time_diff = $('#timeDifference').val();
        let overtime_status = $('#autoClockOut').val();

        if (emp_shift > 0 && parseInt(sched_notify) > 0){
            let a = new Date(emp_shift * 1000);
            a.setMinutes(a.getMinutes() - 10);
            let b = a.setHours(a.getHours() - (time_diff));
            if (b <= current_time){
                start_sched();
            }
        }
        // End shift notify
        if (emp_overtime > 0 && overtime_status == 1){
            let c = new Date(emp_overtime * 1000);
            c.setMinutes(c.getMinutes() - 10);
            let d = c.setHours(c.getHours() - (time_diff));
            if(current_time >= d){
                overtimeTimer();
            }
            if (current_time >= d && parseInt(over_notify) > 0){
                overtime();
            }
        }
        //Employee without schedule
            let shift_end = $('#unScheduledShift').val();
        if (overtime_status == 1 && shift_end > 0){
            let f = new Date(shift_end * 1000);
            f.setMinutes(f.getMinutes() - 10);
            let g = f.setHours(f.getHours() - (time_diff));
            if (current_time >= g){
                // overtime();
                overtimeTimer();
            }
        }

        //Auto Clock out
            if (shift_end > 0 && overtime_status < 1){
               let end_shift = new Date(shift_end * 1000);
               let end_of_shift = end_shift.setHours(end_shift.getHours());
               if (end_of_shift <=  current_time){
                    autoClockOut();
               }
            }else if(emp_overtime > 0 && overtime_status < 1){
                let end_shift = new Date(emp_overtime * 1000);
                let end_of_shift = end_shift.setHours(end_shift.getHours() - (time_diff));
                if (end_of_shift <= current_time){
                    autoClockOut();
                }
            }

        });
    }

// end of Live clock

});
