<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '<div class="col-12 col-lg-4">';
endif;
?>
<style>
    .widget-tile-paid-invoices:hover {
        cursor: pointer;
    }

    .paid-invoices-container .paid-invoices-items {
        color: rgb(47 43 61 / 0.9);
        border-radius: 6px;
        background-image: none;
        padding: 10px;
        position: relative;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .paid-invoices-container .paid-invoices-items .row-items {
        width: 100% !important;
        box-sizing: border-box;
        /* box-shadow: 0px 3px 12px #38747859; */
        padding: 20px;
        border-radius: 25px;
        background: #fff;
    }

    .paid-invoices-container .item {
        display: block;
        padding: 20px 10px;
        color: #214548;
        border-radius: 10px;
        gap: 10px;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        box-shadow: 0px 3px 12px #38747859;
        height: 100%;
    }

    .paid-invoices-container .paid-invoices-items .row-items .form-select {
        border-radius: 25px;
        font-size: 16px !important;
        font-weight: 500;
        border: none;
        color: #214548;
    }



    .paid-invoices-container .paid-invoices-items .row-items .form-control {
        border-radius: 25px;
        font-size: 16px !important;
        font-weight: 500;
        border-color: #FEA303;
        color: #214548;
    }

    .paid-invoices-container .item .first {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
        align-items: center;
        justify-content: center;
    }

    .paid-invoices-container .item .first .icons {
        border-radius: 100%;
    }

    .paid-invoices-container .item .first .icons i {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        height: 38px;
        width: 40px;
        border-radius: 100%;
    }

    .paid-invoices-container .item .first label {
        font-size: 30px;
        font-weight: bold;
        line-height: 1;
    }

    .paid-invoices-container .item .count p {
        font-size: 14px;
        font-weight: 600;
        margin: 0;
        text-align: center;
    }

    @media screen and (max-width: 1366px) {

        .paid-invoices-container .paid-invoices-items .form-select {
            width: 100%;
        }

        .paid-invoices-container .paid-invoices-items .col-4 {
            width: 50%;
        }

        .paid-invoices-container .paid-invoices-items .filter-options {
            width: 55%;
            margin-bottom: 10px;
        }
    }


    @media screen and (max-width: 567px) {
        .paid-invoices-container .paid-invoices-items .col-4 {
            margin-bottom: 10px
        }

        .paid-invoices-container .paid-invoices-items .filter-options {
            width: 100%;
        }

        .paid-invoices-container .paid-invoices-items .row-items {
            padding: 5px;
        }

        .paid-invoices-container .paid-invoices-items {
            margin: unset
        }

        .paid-invoices-container .text-md-start {
            text-align: left !important;
        }

        .paid-invoices-container .paid-invoices-items .col-6 {
            width: 100%;
        }

    }
</style>
<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Paid Invoices</span>
        </div>
        <div class="nsm-card-controls">
            <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?= base_url() ?>">
                See Reports
            </a>
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
        <div class="col-md-12">
            <div class="banner">
                <img src="./assets/img/paid-invoices-banner3.svg" alt="">
            </div>
            <div class="paid-invoices-container">
                <div class="paid-invoices-items">
                    <div class="row row-items">
                        <div class="row mb-5">
                            <div class="col-4 filter-options">
                                <select class="nsm-field form-select" name="filter_date"
                                    id="widget-paid-invoices-filter-date">
                                    <option value="today">Today</option>
                                    <option value="custom">Custom</option>
                                    <option value="this-week" <?= $date === 'this-week' ? 'selected' : '' ?>>This week
                                    </option>
                                    <option value="this-month">This month</option>
                                    <option value="this-quarter">This quarter</option>
                                    <option value="this-year" selected="">This Year</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <input type="date" id="widget-paid-invoices-filter-from"
                                    class="nsm-field form-control date" value="<?= date('Y-01-01') ?>" />
                            </div>
                            <div class="col-4">
                                <input type="date" id="widget-paid-invoices-filter-to"
                                    class="nsm-field form-control date" value="<?= date('Y-m-t') ?>" required>
                            </div>
                        </div>
                        <div class="col-6 mb-4">
                            <div class="item">
                                <div class="first">
                                    <div class="icons" style="color: #A888B5 ; background: #A888B51a;">
                                        <i class='bx bx-dollar-circle'></i>
                                    </div>
                                    <label id="widget-paid-invoices-total-amount">$0.0</label>
                                </div>
                                <div class="count">
                                    <p>Total Amount Paid Invoices</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-4 ">
                            <div class="item">
                                <div class="first">
                                    <div class="icons" style="color: #FEA303;background: #FEA3031a;">
                                        <i class='bx bx-box'></i>
                                    </div>
                                    <label id="widget-paid-invoices-total-number">0</label>
                                </div>
                                <div class="count">
                                    <p>Total Paid invoices</p>
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
        $('#widget-paid-invoices-filter-date').on('change', function() {
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

            $('#widget-paid-invoices-filter-from').val(moment(from_date).format('YYYY-MM-DD'));
            $('#widget-paid-invoices-filter-to').val(moment(to_date).format('YYYY-MM-DD'));

            loadSummaryPaidInvoices();
        });

        loadSummaryPaidInvoices();

        $('#widget-paid-invoices-filter-from, #widget-paid-invoices-filter-to').on('change', function() {
            loadSummaryPaidInvoices();
        });

        function loadSummaryPaidInvoices() {
            var filter_date_from = $('#widget-paid-invoices-filter-from').val();
            var filter_date_to = $('#widget-paid-invoices-filter-to').val();

            $.ajax({
                url: base_url + 'widgets/_load_paid_invoices_summary',
                method: 'post',
                data: {
                    filter_date_from: filter_date_from,
                    filter_date_to: filter_date_to
                },
                dataType: 'json',
                success: function(response) {
                    var total_amount = parseFloat(response.paid_invoices_total_amount);
                    $('#widget-paid-invoices-total-amount').text('$' + total_amount.toLocaleString(
                        undefined, {
                            minimumFractionDigits: 2
                        }));
                    $('#widget-paid-invoices-total-number').text(response
                        .paid_invoices_total_number);
                }
            });
        }

        $('.widget-tile-paid-invoices').on('click', function() {
            location.href = base_url + 'invoice/tab/5';
        });
    });
</script>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '</div>';
endif;
?>
