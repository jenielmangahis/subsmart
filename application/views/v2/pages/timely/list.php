<?php

defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('v2/includes/header');
?>

 <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- FullCalendar CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.css" rel="stylesheet" />

    <!-- FullCalendar JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.js"></script>

    <style>
        .dashboard-container {
            max-width: 100%;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .dashboard-header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }
        .calendar-container {
            margin-top: 20px;
        }
        .details-container {
            margin-top: 20px;
        }
        .screenshot-placeholder {
            width: 100%;
            height: 200px;
            background-color: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: #555;
            border-radius: 5px;
        }
        .fc-day.selected {
        background-color: #4CAF50 !important;
        color: white !important;
    }
    </style>

<div class="row page-content g-0">
    <!-- TABS -->
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/timely_tabs'); ?>
    </div>

    <!-- CALLOUT -->
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            With TimeProof, track work hours, monitor productivity, and stay on top of tasks. Designed for teams, it makes sharing progress and staying aligned effortless.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="dashboard-container">
            <div class="dashboard-header">Employer Timely Dashboard</div>
            <div class="calendar-container">
                <h4>Select Date</h4>
                <div id="calendar"></div>
            </div>
            <div class="details-container">
                <h4>Logs for <span id="selected-date">Select a date</span></h4>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Total Hours</th>
                        </tr>
                    </thead>
                    <tbody id="log-body">
                        <tr>
                            <td colspan="5" class="text-center">No records available</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="screenshot-placeholder" id="screenshot">
                Screenshot Preview
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let logs = {
            '2025-02-05': [
                { name: 'John Doe', timeIn: '08:00 AM', timeOut: '05:00 PM', hours: 9 },
                { name: 'Jane Smith', timeIn: '09:00 AM', timeOut: '06:00 PM', hours: 9 }
            ],
            '2025-02-06': [
                { name: 'Alex Brown', timeIn: '10:00 AM', timeOut: '06:00 PM', hours: 8 },
                { name: 'Olivia Green', timeIn: '07:00 AM', timeOut: '04:00 PM', hours: 9 }
            ]
        };

        function calculateTotalHours() {
            let events = [];
            for (let date in logs) {
                let totalHours = logs[date].reduce((sum, log) => sum + log.hours, 0);
                events.push({
                    title: `Total Hours: ${totalHours} hrs`,
                    start: date,
                    allDay: true
                });
            }
            return events;
        }

        let selectedDate = '';

        $('#calendar').fullCalendar({
            selectable: true,
            select: function(start) {
                let selectedDate = start.format('YYYY-MM-DD');
                $('#selected-date').text(selectedDate);
                loadLogs(selectedDate);
                highlightSelectedDate(selectedDate);
            },
            events: calculateTotalHours()
        });

        function loadLogs(date) {
            let logData = logs[date] || [];
            let logHtml = '';

            if (logData.length > 0) {
                logData.forEach((log, index) => {
                    logHtml += `<tr>
                                    <td>${index + 1}</td>
                                    <td>${log.name}</td>
                                    <td>${log.timeIn}</td>
                                    <td>${log.timeOut}</td>
                                    <td>${log.hours} hrs</td>
                                </tr>`;
                });
            } else {
                logHtml = '<tr><td colspan="5" class="text-center">No records available</td></tr>';
            }

            $('#log-body').html(logHtml);
        }

        function highlightSelectedDate(date) {
            $('.fc-day').removeClass('selected');
            $(`.fc-day[data-date='${date}']`).addClass('selected');
        }
    });
</script>



<?php include viewPath('v2/includes/footer'); ?>
