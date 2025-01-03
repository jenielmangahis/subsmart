<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '<div class="col-12 col-lg-4">';
endif;
?>
<style>
    .nsm-counter.h-100.yellow {
        background-color: #fef5e0;
    }

    i.bx.bx-box.subs {
        background-color: #ffeab9;
        color: #cda030;
    }

    .income-container .income-items .row-items .form-select {
        border-radius: 25px;
        font-size: 16px !important;
        font-weight: 500;
        border: none;
        color: #214548;
    }

    .income-container .income-items .row-items .form-control {
        border-radius: 25px;
        font-size: 16px !important;
        font-weight: 500;
        border-color: #FEA303;
        color: #214548;
    }

    .income-container .income-items {
        width: 100% !important;
        box-sizing: border-box;
        box-shadow: 0px 3px 12px #38747859;
        padding: 20px;
        border-radius: 25px;
        background: #fff;
    }

    @media screen and (max-width: 1366px) {
        .income-container .income-items .form-select {
            width: 100%;
        }

        .income-container .income-items .col-4 {
            width: 50%;
        }

        .income-container .income-items .filter-options {
            width: 55%;
            margin-bottom: 10px;
        }

        .income-container .income-items .col-6 {
            width: 100%;
        }
    }

    @media screen and (max-width: 991px) {

        .income-container .income-items .col-6 {
            width: 50%;
        }
    }

    @media screen and (max-width: 567px) {

        .income-container .income-items .col-6 {
            width: 100%;
        }
    }
</style>
<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Income</span>
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
        <div class="banner mb-5">
            <img src="./assets/img/paid-invoices-banner2.svg" alt="">
        </div>
        <div class="income-container">
            <div class="income-items">
                <div class="row mb-4 mt-2 row-items">
                    <div class="col-4 filter-options">
                        <select class="nsm-field form-select" name="filter_date" id="widget-income-filter-date">
                            <option value="today">Today</option>
                            <option value="custom">Custom</option>
                            <option value="this-week" <?= $date === 'this-week' ? 'selected' : '' ?>>This week</option>
                            <option value="this-month">This month</option>
                            <option value="this-quarter">This quarter</option>
                            <option value="this-year" selected="">This year</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <input type="date" id="widget-income-filter-from" class="nsm-field form-control date"
                            value="<?= date('Y-01-01') ?>" />
                    </div>
                    <div class="col-4">
                        <input type="date" id="widget-income-filter-to" class="nsm-field form-control date"
                            value="<?= date('Y-m-t') ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mb-2">
                        <div class="nsm-counter h-100" style=" background-color: #A888B51a;padding: 20px">
                            <div class="w-100 d-flex align-items-center justify-content-between gap-2 h-100">
                                <div
                                    class=" mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                                    <span>Open Invoices</span>
                                    <h2 id="income-widget-open-invoices"></h2>
                                </div>
                                <div
                                    class="order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                                    <i class="bx bx-receipt" style=" background-color: #A888B5;color: #fff;"></i>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-2">
                        <div class="nsm-counter h-100" style=" background-color: #d9a1a01a;padding: 20px">
                            <div class="w-100 d-flex align-items-center justify-content-between gap-2 h-100">

                                <div
                                    class="mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                                    <span>Overdue Invoices</span>
                                    <h2 id="income-widget-overdue"></h2>
                                </div>
                                <div
                                    class="order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                                    <i class="bx bx-calendar-exclamation"
                                        style=" background-color: #d9a1a0;color: #fff;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-2">
                        <div class="nsm-counter success h-100" style=" background-color: #FEA3031a;padding: 20px">
                            <div class="w-100 d-flex align-items-center justify-content-between gap-2 h-100">

                                <div
                                    class="mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                                    <span>Paid Invoices</span>
                                    <h2 id="income-widget-paid-invoices"></h2>
                                </div>
                                <div
                                    class=" order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                                    <i class="bx bx-badge-check" style=" background-color: #FEA303;color: #fff;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-2">
                        <div class="nsm-counter yellow h-100" style=" background-color: #EFB6C81a;padding: 20px">
                            <div class="w-100 d-flex align-items-center justify-content-between gap-2 h-100">

                                <div
                                    class=" mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                                    <span>Subscription</span>
                                    <h2 id="income-widget-subscriptions"><?php echo "$" . number_format($subs->TOTAL_MMR, 2); ?></h2>
                                </div>
                                <div
                                    class="order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                                    <i class="bx bx-box subs" style=" background-color: #EFB6C8;color: #fff;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        loadIncomeStat();
        $('#widget-income-filter-date').on('change', function() {
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
                    var to_date = String(12).padStart(2, '0') + '/' + String(31).padStart(2, '0') +
                        '/' + date.getFullYear();
                    break;
                default:
                    var from_date = '';
                    var to_date = '';
                    break;
            }

            $('#widget-income-filter-from').val(moment(from_date).format('YYYY-MM-DD'));
            $('#widget-income-filter-to').val(moment(to_date).format('YYYY-MM-DD'));

            loadIncomeStat();
        });

        $('#widget-income-filter-from, #widget-income-filter-to').on('change', function() {
            loadIncomeStat();
        });

        function loadIncomeStat() {
            var filter_date_from = $('#widget-income-filter-from').val();
            var filter_date_to = $('#widget-income-filter-to').val();

            $.ajax({
                url: base_url + 'widgets/_load_income_stat',
                method: 'post',
                data: {
                    filter_date_from: filter_date_from,
                    filter_date_to: filter_date_to
                },
                dataType: 'json',
                success: function(data) {
                    $('#income-widget-open-invoices').text(data.total_open_invoices);
                    $('#income-widget-overdue').text(data.total_overdue_invoices);
                    $('#income-widget-paid-invoices').text('$' + data.total_amount_paid_invoices);
                    $('#income-widget-subscriptions').text('$' + data.total_amount_subscriptions);
                }
            });
        }
    });
</script>
<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '</div>';
endif;
?>
