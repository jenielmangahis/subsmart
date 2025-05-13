<?php
    $id = trim($thumbnailsWidgetCard->id);
    $title = trim($thumbnailsWidgetCard->title);
    $description = trim($thumbnailsWidgetCard->description);
    $icon = trim($thumbnailsWidgetCard->icon);
    $type = trim($thumbnailsWidgetCard->type);
    $category = trim($thumbnailsWidgetCard->category);
?>

<div class='card shadow widgetBorder <?php echo "card_$category$id "; ?>'>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h5 class="mt-0 fw-bold">
                    <a role="button" class="text-decoration-none" href="javascript:void(0)" style="color:#6a4a86 !important">
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
        <div class="row <?php echo "textDatas_$id"; ?>">
            <div class="col-12 text-nowrap <?php echo "textDataContainer_$id"; ?> mt-2">
                <div class="d-flex align-items-center mb-3">
                    <img src="https://cdn-icons-png.flaticon.com/512/3541/3541871.png" 
                        alt="Profile Picture" 
                        class="img-thumbnail rounded-circle border me-3 scorecard_profile_img" 
                        style="width: 60px; height: 60px; object-fit: cover;">
                    <div>
                        <h5 class="mb-0 fw-bold scorecard_name">Lauren</h5>
                        <span class="text-muted scorecard_others">Rep #104 • Since 2020</span>
                    </div>
                </div>
            </div>

            <div class="col-6 text-nowrap <?php echo "textDataContainer_$id"; ?>">
                <div class="text-center textData border-0">
                    <i class="fas fa-star fs-5 mt-2 mb-2" style="color: #6a4a86ab"></i><br>
                    <small class="text-muted text-uppercase fw-bold">Points</small>
                    <h4 class="scorecard_points">0</h4>
                </div>
            </div>
            <div class="col-6 text-nowrap <?php echo "textDataContainer_$id"; ?>">
                <div class="text-center textData border-0">
                    <i class="fas fa-tasks fs-5 mt-2 mb-2" style="color: #6a4a86ab"></i><br>
                    <small class="text-muted text-uppercase fw-bold">Jobs</small>
                    <h4 class="scorecard_jobcount">0</h4>
                </div>
            </div>
            <div class="col-6 text-nowrap <?php echo "textDataContainer_$id"; ?>">
                <div class="text-center textData border-0">
                    <i class="fas fa-wrench fs-5 mt-2 mb-2" style="color: #6a4a86ab"></i><br>
                    <small class="text-muted text-uppercase fw-bold">Services</small>
                    <h4 class="scorecard_servicecount">0</h4>
                </div>
            </div>
            <div class="col-6 text-nowrap <?php echo "textDataContainer_$id"; ?>">
                <div class="text-center textData border-0">
                    <i class="fas fa-user-check fs-5 mt-2 mb-2" style="color: #6a4a86ab"></i><br>
                    <small class="text-muted text-uppercase fw-bold">Attendance</small>
                    <h4 class="scorecard_attendance">0</h4>
                </div>
            </div>
            <!-- <div class="col-6 text-nowrap <?php echo "textDataContainer_$id"; ?>">
                <div class="text-center textData border-0">
                    <i class="fas fa-comment-dots fs-5 mt-2 mb-2" style="color: #6a4a86ab"></i><br>
                    <small class="text-muted text-uppercase fw-bold">Reviews</small>
                    <h4>230</h4>
                </div>
            </div> -->
            <div class="col-12 text-nowrap <?php echo "textDataContainer_$id"; ?>">
                <div class="textData border-0">
                    <span class="text-muted text-uppercase fw-bold mt-2">Overall Performance</span>
                    <div class="progress mb-2 mt-1">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success scorecard_overall_performance" role="progressbar" style="width: 75%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"><strong>75%</strong></div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-nowrap <?php echo "textDataContainer_$id"; ?> mt-3">
                <div class="table-responsive text-center">
                        <table class="table table-bordered table-hover">
                            <thead style="background: #00000008;">
                                <tr>
                                    <th>Module</th>
                                    <th>Count</th>
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
    $.ajax({
        url: `${window.location.origin}/dashboard/thumbnailWidgetRequest`,
        type: "POST",
        data: {
            category: "scorecard",
            dateFrom: ($('.<?php echo "widgetFilter1_$id"; ?> option:selected').val() == 'all_time') ? '1970-01-01' : new Date(Date.UTC(new Date().getFullYear(), 0, 1)).toISOString().split('T')[0],
            dateTo: new Date().toISOString().split('T')[0],
            filter3: null
        },
        beforeSend: function() {
            $('.<?php echo "textDataContainer_$id"; ?>').hide();
            $('.<?php echo "tableDataContainer_$id"; ?>').hide();
            $('.<?php echo "graphLoaderContainer_$id"; ?>').show();
            $('.<?php echo "noRecordFoundContainer_$id"; ?>').hide();
            $('.<?php echo "networkErrorContainer_$id"; ?>').hide();
        },
        success: function (response) {
            const tech_rep = JSON.parse(response);
            const date_created = new Date(tech_rep[0].date_created).getFullYear();
            // const profileImg = tech_rep[0].profile_img ? `${window.origin}/uploads/users/${tech_rep[0].profile_img}` : "https://cdn-icons-png.flaticon.com/512/3541/3541871.png";

            // Temporary img
            const profileImg = `${window.origin}/uploads/users/default.png`;

            $('.scorecard_profile_img').attr('src', profileImg);
            $('.scorecard_name').text(tech_rep[0].employee_name);
            $('.scorecard_others').text(`Rep #${tech_rep[0].employee_id} • Since ${date_created}`);
            $('.scorecard_points').text(tech_rep[0].total_points);
            $('.scorecard_jobcount').text(tech_rep[0].job_count);
            $('.scorecard_servicecount').text(tech_rep[0].ticket_count);
            $('.scorecard_attendance').text(`${tech_rep[0].attendance_percentage}%`);
            $('.scorecard_overall_performance').css('width', `${tech_rep[0].overall_performance}%`);
            $('.scorecard_overall_performance > strong').text(`${tech_rep[0].overall_performance}%`);
            $('.scorecard_ticket_column').text(tech_rep[0].job_count);
            $('.scorecard_job_column').text(tech_rep[0].ticket_count);

            $('.<?php echo "textDataContainer_$id"; ?>').show();
            $('.<?php echo "tableDataContainer_$id"; ?>').show();
            $('.<?php echo "graphLoaderContainer_$id"; ?>').hide();
            $('.<?php echo "noRecordFoundContainer_$id"; ?>').hide();
            $('.<?php echo "networkErrorContainer_$id"; ?>').hide();

            widgetMasonry = new Masonry(document.getElementById('widgetMasonry'), { percentPosition: true, horizontalOrder: true, });
        },
        error: function () {
            widgetMasonry = new Masonry(document.getElementById('widgetMasonry'), { percentPosition: true, horizontalOrder: true, });
            console.error("Failed to fetch Tech Rep data.");
        }
    });
</script>