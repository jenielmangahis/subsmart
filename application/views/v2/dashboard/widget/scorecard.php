<?php
    $id = trim($thumbnailsWidgetCard->id);
    $title = trim($thumbnailsWidgetCard->title);
    $description = trim($thumbnailsWidgetCard->description);
    $icon = trim($thumbnailsWidgetCard->icon);
    $type = trim($thumbnailsWidgetCard->type);
    $category = trim($thumbnailsWidgetCard->category);
?>
<style>
    .selectize-dropdown .selected {
        background-color: #6a4a8624 !important;
        color: unset !important;
    }
</style>
<div class='card shadow widgetBorder <?php echo "card_$category$id "; ?>'>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h5 class="mt-0 fw-bold">
                    <a role="button" class="text-decoration-none widget-header-widget-default-arrow" href="javascript:void(0)" style="color:#6a4a86 !important">
                        <?php echo "<i class='$icon'></i>&nbsp;&nbsp;$title"; ?> <span class="badge widgetBadge position-absolute opacity-25"><?php echo ucfirst($type); ?></span>
                    </a>
                    <div class="dropdown float-end widgetDropdownMenu display_none">
                        <a href="javascript:void(0)" class="dropdown-toggle text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h text-muted"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item removeDashboardCard" data-id='<?php echo $id; ?>' href="javascript:void(0)">Remove</a></li>
                        </ul>
                    </div>
                </h5>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12">
                <span><?php echo $description; ?></span>
            </div>
        </div>
        <div class="row mb-2 d-none">
            <div class="col-md-12">
                <div class="input-group">
                    <select class="form-select <?php echo "widgetFilter1_$id"; ?>">
                        <option value="all_time">All Time</option>
                        <option value="this_year" selected>This Year</option>
                    </select>
                    <select class="form-select <?php echo "widgetFilter2_$id"; ?>">
                        <option value="recent" selected>Recent</option>
                        <option value="last_7_days">Last 7 Days</option>
                        <option value="last_14_days">Last 14 Days</option>
                        <option value="last_30_days">Last 30 Days</option>
                        <option value="last_60_days">Last 60 Days</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row scorecard_tech_employees">
            <div class="col-md-12">
                <div class="input-group">
                    <select class="form-select <?php echo "tech_employees_$id"; ?>">
                        <option value=""></option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row <?php echo "textDatas_$id"; ?>">
            <div class="col-12 text-nowrap <?php echo "textDataContainer_$id"; ?> mt-3 display_none">
                <div class="d-flex align-items-center mb-3">
                    <img src="https://cdn-icons-png.flaticon.com/512/3541/3541871.png" 
                        alt="Profile Picture" 
                        class="img-thumbnail rounded-circle border me-3 scorecard_profile_img" 
                        style="width: 60px; height: 60px; object-fit: cover;">
                    <div>
                        <h5 class="mb-0 fw-bold scorecard_name"></h5>
                        <span class="text-muted scorecard_others"></span>
                    </div>
                </div>
            </div>

            <div class="col-6 text-nowrap <?php echo "textDataContainer_$id"; ?> display_none">
                <div class="text-center textData border-0">
                    <i class="fas fa-star fs-5 mt-2 mb-2" style="color: #6a4a86ab"></i><br>
                    <small class="text-muted text-uppercase fw-bold">Points</small>
                    <h4 class="scorecard_points">0</h4>
                </div>
            </div>
            <!-- <div class="col-6 text-nowrap <?php echo "textDataContainer_$id"; ?> display_none">
                <div class="text-center textData border-0">
                    <i class="fas fa-tasks fs-5 mt-2 mb-2" style="color: #6a4a86ab"></i><br>
                    <small class="text-muted text-uppercase fw-bold">Jobs</small>
                    <h4 class="scorecard_jobcount">0</h4>
                </div>
            </div>
            <div class="col-6 text-nowrap <?php echo "textDataContainer_$id"; ?> display_none">
                <div class="text-center textData border-0">
                    <i class="fas fa-wrench fs-5 mt-2 mb-2" style="color: #6a4a86ab"></i><br>
                    <small class="text-muted text-uppercase fw-bold">Services</small>
                    <h4 class="scorecard_servicecount">0</h4>
                </div>
            </div> -->
            <div class="col-6 text-nowrap <?php echo "textDataContainer_$id"; ?> display_none">
                <div class="text-center textData border-0">
                    <i class="fas fa-user-check fs-5 mt-2 mb-2" style="color: #6a4a86ab"></i><br>
                    <small class="text-muted text-uppercase fw-bold">Attendance</small>
                    <h4 class="scorecard_attendance">0</h4>
                </div>
            </div>
            <!-- <div class="col-6 text-nowrap <?php echo "textDataContainer_$id"; ?> display_none">
                <div class="text-center textData border-0">
                    <i class="fas fa-comment-dots fs-5 mt-2 mb-2" style="color: #6a4a86ab"></i><br>
                    <small class="text-muted text-uppercase fw-bold">Reviews</small>
                    <h4>230</h4>
                </div>
            </div> -->
            <div class="col-12 text-nowrap <?php echo "textDataContainer_$id"; ?> display_none">
                <div class="textData border-0">
                    <span class="text-muted text-uppercase fw-bold mt-2">Overall Performance</span>
                    <div class="progress mb-2 mt-1">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success scorecard_overall_performance" role="progressbar" style="width: 75%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"><strong>75%</strong></div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-nowrap <?php echo "textDataContainer_$id"; ?> mt-3 display_none">
                <div class="table-responsive text-center">
                        <table class="table table-bordered table-hover">
                            <thead style="background: #00000008;">
                                <tr>
                                    <th>Module</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tickets</td>
                                    <td class="scorecard_ticket_column">182</td>
                                </tr>
                                <tr>
                                    <td>Jobs</td>
                                    <td class="scorecard_job_column">124</td>
                                </tr>
                            </tbody>
                        </table>
                </div>
            </div>
            <div class="col mt-2 <?php echo "graphLoaderContainer_$id"; ?> graphLoader display_none">
                <div class="text-center">
                    <div class="spinner-border text-secondary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="col mt-2 <?php echo "noRecordFoundContainer_$id"; ?> display_none">
                <div class="text-center">No Record Found...</div>
            </div>
            <div class="col mt-2 <?php echo "networkErrorContainer_$id"; ?> display_none">
                <div class="text-center">Unable to retrieve results due to a network error.<br>
                    <small>
                        <a class="text-decoration-none" href="javascript:void(0)" onclick='$(`.<?php echo "widgetFilter1_$id"; ?>`).change();'><i class="fas fa-redo-alt"></i>&nbsp;&nbsp;Refresh</a>
                    </small>
                </div>
            </div>
        </div>
        <strong class="widgetDragHandle">⣿⣿⣿⣿</strong>
        <span class="widgetWidthResizeHandle"></span>
        <span class="widgetHeightResizeHandle"></span>
    </div>
</div>
<script>
    const selectScorecardEmployeeInput = $(".<?php echo "tech_employees_$id"; ?>").selectize({
        placeholder: "Search and select tech employee...",
        valueField: 'employee_id',
        labelField: 'employee',
        searchField: ['employee', 'email', 'phone_m'],
        render: {
            option: function(item, escape) {
                const name = item.employee.trim();
                const splitName = name.split(' ');
                const initials = (splitName[0]?.charAt(0) || '') + (splitName[1]?.charAt(0) || '');

                const phonePattern = /^\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}$/;
                const phone = phonePattern.test(item.phone_m) ? item.phone_m : 'Not Specified';
                const email = item.email ? escape(item.email) : 'Not Specified';
                const recordText = (item.total_points && parseInt(item.total_points) > 0)
                    ? `${item.total_points} points`
                    : '0 point';

                return `
                    <div style="display: flex; align-items: center; padding: 8px;">
                        <div style="
                            width: 40px;
                            height: 40px;
                            background: #6a4a86;
                            color: #fff;
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-weight: bold;
                            margin-right: 12px;
                            font-size: 14px;
                        ">${initials.toUpperCase()}</div>
                        <div style="max-width: 300px; word-wrap: break-word;">
                            <div style="font-weight: bold; word-wrap: break-word;">${escape(item.employee)}</div>
                            <div style="font-size: 12px; color: #555; word-wrap: break-word;">${phone.trim()} / ${email.trim()}</div>
                            <div style="font-size: 12px; color: #888; word-wrap: break-word;">${recordText}</div>
                        </div>
                    </div>
                `;
            },
            item: function(item, escape) {
                return `<div>${escape(item.employee)}</div>`;
            }
        }
    });

    const selectizeScorecardInstance = selectScorecardEmployeeInput[0].selectize;

    $.ajax({
        url: `${window.location.origin}/dashboard/thumbnailWidgetRequest`,
        type: "POST",
        data: {
            category: "tech_employees",
            dateFrom: null,
            dateTo: null,
            filter3: null
        },
        beforeSend: function() {
            $('.scorecard_tech_employees').hide();
            $('.<?php echo "textDataContainer_$id"; ?>').hide();
            $('.<?php echo "tableDataContainer_$id"; ?>').hide();
            $('.<?php echo "graphLoaderContainer_$id"; ?>').show();
            $('.<?php echo "noRecordFoundContainer_$id"; ?>').hide();
            $('.<?php echo "networkErrorContainer_$id"; ?>').hide();
        },
        success: function (response) {
            const employees = JSON.parse(response);

            selectizeScorecardInstance.clearOptions();
            employees.forEach(employees => {
                selectizeScorecardInstance.addOption(employees);
            });
            selectizeScorecardInstance.refreshOptions(false);
            getMyLedger();
            $('.scorecard_tech_employees').show();
            $('.<?php echo "textDataContainer_$id"; ?>').hide();
            $('.<?php echo "tableDataContainer_$id"; ?>').hide();
            $('.<?php echo "graphLoaderContainer_$id"; ?>').hide();
            $('.<?php echo "noRecordFoundContainer_$id"; ?>').hide();
            $('.<?php echo "networkErrorContainer_$id"; ?>').hide();
        },
        error: function () {
            console.error("Failed to fetch user data.");
        }
    });

    $(document).on('change', '.<?php echo "tech_employees_$id"; ?>', function () {
        const employeeID = $(this).val();
        let filter1 = $('.<?php echo "widgetFilter1_$id"; ?> option:selected').val();
        let dateTo = new Date().toISOString().split('T')[0];

        switch (filter1) {
            case 'all_time':
                dateFrom = '1970-01-01';
                break;
            case 'this_year':
                dateFrom = new Date(Date.UTC(new Date().getFullYear(), 0, 1)).toISOString().split('T')[0];
                break;
        }

        if (employeeID != "") {
            $.ajax({
                url: `${window.location.origin}/dashboard/thumbnailWidgetRequest`,
                type: "POST",
                data: {
                    category: "scorecard_lookup",
                    dateFrom: dateTo,
                    dateTo: dateFrom,
                    filter3: employeeID
                },
                beforeSend: function() {
                    $('.<?php echo "textDataContainer_$id"; ?>').hide();
                    $('.<?php echo "tableDataContainer_$id"; ?>').hide();
                    $('.<?php echo "graphLoaderContainer_$id"; ?>').show();
                    $('.<?php echo "noRecordFoundContainer_$id"; ?>').hide();
                    $('.<?php echo "networkErrorContainer_$id"; ?>').hide();
                },
                success: function (response) {
                    const data = JSON.parse(response);
                    const points = (data[0].total_points) ? data[0].total_points : 0;
                    const date_created = new Date(data[0].date_created).getFullYear();
                    // const profileImg = data[0].profile_img ? `${window.origin}/uploads/users/${data[0].profile_img}` : "https://cdn-icons-png.flaticon.com/512/3541/3541871.png";

                    // Temporary img
                    const profileImg = `${window.origin}/uploads/users/default.png`;
                    $('.scorecard_profile_img').attr('src', profileImg);
                    $('.scorecard_name').text(data[0].employee_name);
                    $('.scorecard_others').text(`Rep #${data[0].employee_id} • Since ${date_created}`);
                    $('.scorecard_points').text(points);
                    $('.scorecard_points').parent().parent().attr(`onclick`, `window.open('${window.origin}/users/view/${data[0].employee_id}', '_blank')`);
                    // $('.scorecard_jobcount').text(data[0].job_count);
                    // $('.scorecard_servicecount').text(data[0].ticket_count);
                    $('.scorecard_attendance').text(`${data[0].attendance_percentage}%`);
                    $('.scorecard_attendance').parent().parent().attr(`onclick`, `window.open('${window.origin}/users/view/${data[0].employee_id}', '_blank')`);
                    $('.scorecard_overall_performance').css('width', `${data[0].overall_performance}%`);
                    $('.scorecard_overall_performance > strong').text(`${data[0].overall_performance}%`);
                    $('.scorecard_ticket_column').text(data[0].job_count);
                    $('.scorecard_job_column').text(data[0].ticket_count);

                    $('.<?php echo "textDataContainer_$id"; ?>').show();
                    $('.<?php echo "tableDataContainer_$id"; ?>').show();
                    $('.<?php echo "graphLoaderContainer_$id"; ?>').hide();
                    $('.<?php echo "noRecordFoundContainer_$id"; ?>').hide();
                    $('.<?php echo "networkErrorContainer_$id"; ?>').hide();
                    widgetMasonry = new Masonry(document.getElementById('widgetMasonry'), { percentPosition: true, horizontalOrder: true, });
                },
                error: function () {
                    widgetMasonry = new Masonry(document.getElementById('widgetMasonry'), { percentPosition: true, horizontalOrder: true, });
                    console.error("Failed to fetch user data.");
                }
            });
        }
    });

    function getMyLedger() {
        $.ajax({
            url: `${window.location.origin}/dashboard/thumbnailWidgetRequest`,
            type: "POST",
            data: {
                category: "user_info",
                dateFrom: null,
                dateTo: null,
                filter3: null
            },
            success: function (response) {
                const employee_userinfo = JSON.parse(response);
                $('.<?php echo "tech_employees_$id"; ?>').val(`${employee_userinfo.user_id}`).change();
                
            },
            error: function () {
                console.error("Failed to fetch user data.");
            }
        });
    }

    // $.ajax({
    //     url: `${window.location.origin}/dashboard/thumbnailWidgetRequest`,
    //     type: "POST",
    //     data: {
    //         category: "scorecard",
    //         dateFrom: ($('.<?php echo "widgetFilter1_$id"; ?> option:selected').val() == 'all_time') ? '1970-01-01' : new Date(Date.UTC(new Date().getFullYear(), 0, 1)).toISOString().split('T')[0],
    //         dateTo: new Date().toISOString().split('T')[0],
    //         filter3: null
    //     },
    //     beforeSend: function() {
    //         $('.<?php echo "textDataContainer_$id"; ?>').hide();
    //         $('.<?php echo "tableDataContainer_$id"; ?>').hide();
    //         $('.<?php echo "graphLoaderContainer_$id"; ?>').show();
    //         $('.<?php echo "noRecordFoundContainer_$id"; ?>').hide();
    //         $('.<?php echo "networkErrorContainer_$id"; ?>').hide();
    //     },
    //     success: function (response) {
    //         const tech_rep = JSON.parse(response);
    //         const date_created = new Date(data[0].date_created).getFullYear();
    //         // const profileImg = data[0].profile_img ? `${window.origin}/uploads/users/${data[0].profile_img}` : "https://cdn-icons-png.flaticon.com/512/3541/3541871.png";

    //         // Temporary img
    //         const profileImg = `${window.origin}/uploads/users/default.png`;

    //         $('.scorecard_profile_img').attr('src', profileImg);
    //         $('.scorecard_name').text(data[0].employee_name);
    //         $('.scorecard_others').text(`Rep #${data[0].employee_id} • Since ${date_created}`);
    //         $('.scorecard_points').text(data[0].total_points);
    //         $('.scorecard_jobcount').text(data[0].job_count);
    //         $('.scorecard_servicecount').text(data[0].ticket_count);
    //         $('.scorecard_attendance').text(`${data[0].attendance_percentage}%`);
    //         $('.scorecard_overall_performance').css('width', `${data[0].overall_performance}%`);
    //         $('.scorecard_overall_performance > strong').text(`${data[0].overall_performance}%`);
    //         $('.scorecard_ticket_column').text(data[0].job_count);
    //         $('.scorecard_job_column').text(data[0].ticket_count);

    //         $('.<?php echo "textDataContainer_$id"; ?>').show();
    //         $('.<?php echo "tableDataContainer_$id"; ?>').show();
    //         $('.<?php echo "graphLoaderContainer_$id"; ?>').hide();
    //         $('.<?php echo "noRecordFoundContainer_$id"; ?>').hide();
    //         $('.<?php echo "networkErrorContainer_$id"; ?>').hide();

    //         widgetMasonry = new Masonry(document.getElementById('widgetMasonry'), { percentPosition: true, horizontalOrder: true, });
    //     },
    //     error: function () {
    //         widgetMasonry = new Masonry(document.getElementById('widgetMasonry'), { percentPosition: true, horizontalOrder: true, });
    //         console.error("Failed to fetch Tech Rep data.");
    //     }
    // });
</script>