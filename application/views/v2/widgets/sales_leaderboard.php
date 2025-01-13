<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '<div class="col-12 col-lg-4">';
endif;
?>

<style>
    .nsm-card .nsm-card-content.wow {
        display: block;
        height: 50px;
    }

    #sales_leaderboard_v2 .nsm-profile>span {
        position: relative;
        top: 10px;
        left: 13px;
    }

    :root {
        --sales-primary: #281c2d;
        --sales-secondary: #BEAFC2;
        --sales-tertiary: #d9a1a0;
        --sales-quaternary: #F5EFFF;
        --black: #000;
        --sales-green1: #BEAFC2;
        --sales-green2: #FEA303;
        --sales-green3: #281c2d;
    }

    .nsm-widget-table .widget-item .content .details {
        width: 40% !important;
    }

    #sales_leaderboard_v2 .nsm-profile>span {
        position: relative;
        top: 10px;
        left: 13px;
    }

    .sales-leaderboard-container .filter .form-select {
        border-radius: 25px;
        font-size: 16px !important;
        font-weight: 500;
        border-color: none;
        border: none;
        color: #214548;
    }

    .sales-leaderboard-container .filter .form-select {
        border-radius: 25px;
        font-size: 16px !important;
        font-weight: 500;
        border-color: none;
        border: none;
        color: #214548;
    }

    .sales-leaderboard-container .filter .form-control {
        border-radius: 25px;
        font-size: 16px !important;
        font-weight: 500;
        border-color: #FEA303;
        color: #214548;
    }

    .sales-leaderboard-container {
        margin: 0 20px;
        background-color: #FFFFFF;
        color: rgb(47 43 61 / 0.9);
        border-radius: 6px;
        background-image: none;
        overflow: hidden;
        box-shadow: 0px 3px 12px #38747859;
        padding: 10px;
        overflow: auto;
    }

    .sales-separator {
        width: 12%;
        height: 7px;
        background: var(--sales-primary);
        border-radius: 25px;
        transform: translateY(-47px);
        float: left;
        margin-left: 20px;
    }

    @media screen and (max-width: 1366px) {

        .sales-leaderboard-container .form-select {
            width: 100%;
        }

        .sales-leaderboard-container .col-4 {
            width: 50%;
        }

        .sales-leaderboard-container .filter-options {
            width: 55%;
            margin-bottom: 10px;
        }

        #sales_leaderboard_v2 {
            transform: unset;
            margin-top: 20px
        }

        #widget-tech-leaderboard .widget-item {
            width: 200px;
        }
    }

    @media screen and (max-width: 768px) {
        #sales_leaderboard_v2 {
            height: unset;
            margin: unset;
            margin-top: 20px;
        }
    }

    @media screen and (max-width: 567px) {
        .sales-leaderboard-container{
            margin: unset;
            margin-top: 20px;
        }
    }


    @media screen and (max-width: 460px) {
        .sales-filter .col-4 {
            width: 100%;
            margin-bottom: 10px;
        }

        .sales-filter {
            height: 200px;
        }

    }
</style>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span style="color: var(--sales-primary)">Sales Leaderboard</span>
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

    <div class="nsm-card-content">
        <div class="banner">
            <img src="./assets/img/sales-leaderboard-banner.svg" alt="">
        </div>
        <div class="sales-leaderboard-container">
            <div class="nsm-widget-table">
                <div class="row mb-4 mt-2 filter">
                    <div class="col-4 filter-options">
                        <select class="nsm-field form-select" name="filter_date" id="sales-leader-board-filter-date">
                            <option value="today">Today</option>
                            <option value="custom">Custom</option>
                            <option value="this-week" <?= $date === 'this-week' ? 'selected' : '' ?>>This week
                            </option>
                            <option value="this-month">This month</option>
                            <option value="this-quarter">This quarter</option>
                            <option value="this-year" selected="">This year</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <input type="date" id="sales-leaderboard-filter-from" class="nsm-field form-control date"
                            value="<?= date('Y-01-01') ?>" />
                    </div>
                    <div class="col-4">
                        <input type="date" id="sales-leaderboard-filter-to" class="nsm-field form-control date"
                            value="<?= date('Y-m-d') ?>" required>
                    </div>
                </div>
                <div id="sales_leaderboard_v2" class="mt-2"></div>
                <!-- <div class="sales-separator"></div> -->

            </div>
        </div>
    </div>

</div>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '</div>';
endif;
?>

<script type="text/javascript">
    $(document).ready(function() {
        loadSalesLeaderboards();

        $('#sales-leader-board-filter-date').on('change', function() {
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

            $('#sales-leaderboard-filter-from').val(moment(from_date).format('YYYY-MM-DD'));
            $('#sales-leaderboard-filter-to').val(moment(to_date).format('YYYY-MM-DD'));

            loadSalesLeaderboards();
        });

        $('#sales-leaderboard-filter-from, #sales-leaderboard-filter-to').on('change', function() {
            loadSalesLeaderboards();
        });
    });

    function loadSalesLeaderboards() {
        var sales_leaderboard_date_from = $('#sales-leaderboard-filter-from').val();
        var sales_leaderboard_date_to = $('#sales-leaderboard-filter-to').val();
        $.ajax({
            url: base_url + 'widgets/loadV2SalesLeaderBoard',
            method: 'post',
            data: {
                sales_leaderboard_date_from: sales_leaderboard_date_from,
                sales_leaderboard_date_to: sales_leaderboard_date_to
            },
            success: function(response) {
                $('#sales_leaderboard_v2').html(response);
            }
        });
    }
</script>
