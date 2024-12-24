<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '<div class="col-12 col-lg-4">';
endif;
?>
<style>
    :root {
        --tech-primary: #281c2d;
        --tech-secondary: #BEAFC2;
        --tech-tertiary: #d9a1a0;
        --tech-quaternary: #F5EFFF;
        --black: #000;
        --tech-green1: #BEAFC2;
        --tech-green2: #FEA303;
        --tech-green3: #281c2d;
    }

    .nsm-widget-table .widget-item .content .details {
        width: 40% !important;
    }

    #user_tech_leaderboard .nsm-profile>span {
        position: relative;
        top: 10px;
        left: 13px;
    }

    .tech-filter {
        height: 150px;
        background: var(--tech-primary);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        padding: 20px;
    }

    .tech-filter .form-select,
    .tech-filter .form-control {
        border-radius: 25px;
        font-size: 16px !important;
        font-weight: 500;
        background: var(--tech-quaternary);
        color: var(--tech-green3);
        border-color: var(--tech-quaternary) !important;
    }

    #user_tech_leaderboard {
        margin: 0 20px;
        background-color: #FFFFFF;
        color: rgb(47 43 61 / 0.9);
        border-radius: 6px;
        background-image: none;
        overflow: hidden;
        box-shadow: 0px 3px 12px #38747859;
        padding: 10px;
        transform: translateY(-60px);
        overflow: auto;
        height: 75%;
    }

    .tech-separator {
        width: 12%;
        height: 7px;
        background: var(--tech-primary);
        border-radius: 25px;
        transform: translateY(-47px);
        float: right;
        margin-right: 20px;
    }

   
</style>
<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span style="color: var(--tech-primary)">Tech Leaderboard</span>
        </div>
        <div class="nsm-card-controls">
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"
                            onclick="addToMain('<?= $id ?>',<?php echo $isMain ? '1' : '0'; ?>,'<?= $isGlobal ?>' )"><?php echo $isMain ? 'Remove From Main' : 'Add to Main'; ?></a>
                    </li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content jobs_stat">
        <div class="nsm-widget-table">
            <div class="tech-filter">
                <div class="col-md-12 mt-3">
                    <div class="row">
                        <div class="col-4">
                            <select class="nsm-field form-select" name="filter_date" id="tech-leader-board-filter-date">
                                <option value="all">All</option>
                                <option value="today">Today</option>
                                <!-- <option value="custom">Custom</option> -->
                                <option value="this-week" <?= $date === 'this-week' ? 'selected' : '' ?>>This week
                                </option>
                                <option value="this-month">This month</option>
                                <option value="this-quarter">This quarter</option>
                                <option value="this-year" selected="">This year</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="date" id="tech-leaderboard-filter-from" class="nsm-field form-control date"
                                disable value="<?= date('Y-01-01') ?>" />
                        </div>
                        <div class="col-4">
                            <input type="date" id="tech-leaderboard-filter-to" class="nsm-field form-control date"
                                disable value="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>
                </div>
            </div>
            <div id="user_tech_leaderboard"></div>
            <div class="tech-separator"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        loadTechLeaderboards();

        $('#tech-leader-board-filter-date').on('change', function() {
            switch ($(this).val()) {
                case 'today':
                    var date = new Date();
                    var from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date
                        .getDate()).padStart(2, '0') + '/' + date.getFullYear();
                    var to_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date
                        .getDate()).padStart(2, '0') + '/' + date.getFullYear();
                    break;
                case 'this-week':
                    var date = new Date();
                    var from = date.getDate() - date.getDay();
                    var to = from + 6;

                    var from_date = new Date(date.setDate(from));
                    var to_date = new Date(date.setDate(to));

                    from_date = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(
                        from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
                    to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date
                        .getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
                    break;
                case 'this-month':
                    var date = new Date();
                    var to_date = new Date(date.getFullYear(), date.getMonth() + 1, 0);

                    from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(1).padStart(
                        2, '0') + '/' + date.getFullYear();
                    to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date
                        .getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
                    break;
                case 'this-quarter':
                    var date = new Date();
                    var currQuarter = Math.floor(date.getMonth() / 3 + 1);

                    switch (currQuarter) {
                        case 1:
                            var from_date = '01/01/' + date.getFullYear();
                            var to_date = '03/31/' + date.getFullYear();
                            break;
                        case 2:
                            var from_date = '04/01/' + date.getFullYear();
                            var to_date = '06/30/' + date.getFullYear();
                            break;
                        case 3:
                            var from_date = '07/01/' + date.getFullYear();
                            var to_date = '09/30/' + date.getFullYear();
                            break;
                        case 4:
                            var from_date = '10/01/' + date.getFullYear();
                            var to_date = '12/31/' + date.getFullYear();
                            break;
                    }
                    break;
                case 'this-year':
                    var date = new Date();

                    var from_date = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') +
                        '/' + date.getFullYear();
                    var to_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date
                        .getDate()).padStart(2, '0') + '/' + date.getFullYear();
                    break;
                default:
                    var from_date = '';
                    var to_date = '';
                    break;
            }

            $('#tech-leaderboard-filter-from').val(moment(from_date).format('YYYY-MM-DD'));
            $('#tech-leaderboard-filter-to').val(moment(to_date).format('YYYY-MM-DD'));

            loadTechLeaderboards();
        });

        $('#tech-leaderboard-filter-from, #tech-leaderboard-filter-to').on('change', function() {
            loadTechLeaderboards();
        });
    });

    function loadTechLeaderboards() {
        var tech_leaderboard_date_from = $('#tech-leaderboard-filter-from').val();
        var tech_leaderboard_date_to = $('#tech-leaderboard-filter-to').val();
        var filter_by = $('#tech-leader-board-filter-date').val();

        $.ajax({
            url: base_url + 'widgets/loadV3TechLeaderBoard',
            method: 'post',
            data: {
                tech_leaderboard_date_from: tech_leaderboard_date_from,
                tech_leaderboard_date_to: tech_leaderboard_date_to,
                filter_by: filter_by
            },
            success: function(response) {
                $('#user_tech_leaderboard').html(response);
            }
        });
    }
</script>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '</div>';
endif;
?>
