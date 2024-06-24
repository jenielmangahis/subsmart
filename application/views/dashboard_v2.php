<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/dashboard_modals'); ?>
<?php include viewPath('v2/includes/estimate/estimate_modals'); ?>
<?php include viewPath('v2/includes/workorder/workorder_modals'); ?>
<?php include viewPath('v2/widgets/add_widgets'); ?>
<?php include viewPath('v2/includes/calendar/quick_access_calendar_modals'); ?>
<?php include viewPath('v2/includes/calendar/quick_access_calendar_js'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<?php include viewPath('dashboard_v2_js'); ?>
<style>
.loader {
    display: block;
    color: #6a4a86;
    font-size: 10px;
    width: 1em;
    height: 1em;
    border-radius: 50%;
    text-indent: -9999em;
    animation: mulShdSpin 1.3s infinite linear;
    transform: translateZ(0);
}

@keyframes mulShdSpin {

    0%,
    100% {
        box-shadow: 0 -3em 0 0.2em,
            2em -2em 0 0em, 3em 0 0 -1em,
            2em 2em 0 -1em, 0 3em 0 -1em,
            -2em 2em 0 -1em, -3em 0 0 -1em,
            -2em -2em 0 0;
    }

    12.5% {
        box-shadow: 0 -3em 0 0, 2em -2em 0 0.2em,
            3em 0 0 0, 2em 2em 0 -1em, 0 3em 0 -1em,
            -2em 2em 0 -1em, -3em 0 0 -1em,
            -2em -2em 0 -1em;
    }

    25% {
        box-shadow: 0 -3em 0 -0.5em,
            2em -2em 0 0, 3em 0 0 0.2em,
            2em 2em 0 0, 0 3em 0 -1em,
            -2em 2em 0 -1em, -3em 0 0 -1em,
            -2em -2em 0 -1em;
    }

    37.5% {
        box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em,
            3em 0em 0 0, 2em 2em 0 0.2em, 0 3em 0 0em,
            -2em 2em 0 -1em, -3em 0em 0 -1em, -2em -2em 0 -1em;
    }

    50% {
        box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em,
            3em 0 0 -1em, 2em 2em 0 0em, 0 3em 0 0.2em,
            -2em 2em 0 0, -3em 0em 0 -1em, -2em -2em 0 -1em;
    }

    62.5% {
        box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em,
            3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 0,
            -2em 2em 0 0.2em, -3em 0 0 0, -2em -2em 0 -1em;
    }

    75% {
        box-shadow: 0em -3em 0 -1em, 2em -2em 0 -1em,
            3em 0em 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em,
            -2em 2em 0 0, -3em 0em 0 0.2em, -2em -2em 0 0;
    }

    87.5% {
        box-shadow: 0em -3em 0 0, 2em -2em 0 -1em,
            3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em,
            -2em 2em 0 0, -3em 0em 0 0, -2em -2em 0 0.2em;
    }
}

.summary-report-header,
.summary-report-header-sub {
    display: flex;
    align-items: center;
    gap: 10px;
}

.summary-report-header .summary-report-header-sub a {
    text-decoration: none;
    font-weight: bold;
    font-size: 18px;
}

.summary-report-header .icon-summary-leads {
    background-color: #fbedcb;
    color: #c7951c;
    padding: 10px;
}

.summary-report-header .icon-summary-income {
    background-color: #dc35451f;
    color: #dc3545;
    padding: 10px;
}

.summary-report-header .icon-summary-customer {
    background-color: #6ba77c33;
    color: #6ba77c;
    padding: 10px;
}

.summary-report-header .icon-summary-sales {
    background-color: #dad1e0;
    color: #6a4a86;
    padding: 10px;
}

.summary-report-header .icon-summary-estimate {
    background-color: #dad1e0;
    color: #6a4a86;
    padding: 10px;
}

.summary-report-header .icon-summary-appointment {
    background-color: #afd5c39c;
    color: #408854;
    padding: 10px;
}

.summary-report-header .icon-summary-task {
    background-color: #e3778f47;
    color: #dc3545;
    padding: 10px;
}

.summary-report-header .icon-summary i {
    font-size: 25px;
    width: 25px;
}

.summary-report-body {
    text-align: center !important;
}

.summary-report-body h1 {
    font-size: 36px;
    font-weight: 600;
}

.nsm-card-footer {
    display: flex;
    justify-content: end;
}

.nsm-card-footer a {
    font-size: 36px !important;
    border: none;
}


.leads-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 130px;
}

.main-widget-row {
    display: flex;
    gap: 35px;
    flex-wrap: wrap;
    align-content: flex-start;
    justify-content: start;
}

.main-widget-container {
    width: 280px;
    box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .14), 0 2px 1px -1px rgba(0, 0, 0, .12), 0 1px 3px 0 rgba(0, 0, 0, .2);
    border-radius: .75rem;
    height: 340px;
    max-height: 340px;
}

.top-spending {
    font-weight: bold;
    font-size: 12px;
    position: absolute;
    right: 0;
    bottom: -35px;
}

@media screen and (max-width: 1500px) {
    .main-widget-row {
        gap: 20px;
    }

    .main-widget-container {
        width: 260px;
    }

}

@media screen and (max-width: 1366px) {
    .main-widget-container {
        width: 245px;
        height: 310px;
        max-height: 310px;
    }


}

@media screen and (max-width: 1200px) {
    .main-widget-container {
        width: 23%;

    }

}

@media screen and (max-width: 991px) {
    .main-widget-container {
        width: 48%;
    }

}

@media screen and (max-width: 600px) {
    .top-spending {
        right: 0;
        bottom: -62px;
    }

    .main-widget-container {
        width: 100%;
        height: 400px;
        max-height: 400px;
    }
}

.main-widget-container .nsm-card-header {
    height: 50px;
}

.nav-pills .nav-link.active {
    background-color: #6a4a86 !important;
}
</style>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
    <ul class="nsm-fab-options">
        <li
            onclick="window.open('<?php echo base_url('customer/addTicket'); ?>', '_blank', 'location=yes,height=1080,width=1280,scrollbars=yes,status=yes');">
            <div class="nsm-fab-icon">
                <i class="bx bx-chart"></i>
            </div>
            <span class="nsm-fab-label">Add Service Ticket</span>
        </li>
        <li data-bs-toggle="modal" data-bs-target="#new_estimate_modal">
            <div class="nsm-fab-icon">
                <i class="bx bx-chart"></i>
            </div>
            <span class="nsm-fab-label">Add Estimate</span>
        </li>
        <li data-bs-toggle="modal" data-bs-target="#new_workorder_modal">
            <div class="nsm-fab-icon">
                <i class="bx bx-message-alt-add"></i>
            </div>
            <span class="nsm-fab-label">Add Workorder</span>
        </li>
        <li
            onclick="window.open('<?php echo base_url('taskhub/entry'); ?>', '_blank', 'location=yes,height=1080,width=1280,scrollbars=yes,status=yes');">
            <div class="nsm-fab-icon">
                <i class="bx bx-task"></i>
            </div>
            <span class="nsm-fab-label">New Task</span>
        </li>
        <!-- <li onclick="location.href='<?php // echo base_url('customer/add_advance')
                                            ?>'"> -->
        <li class="<?php if ($page->title == '') {
                        echo 'active';
                    } ?>">
            <a class="nsm-page-link" href="javascript:void(0);"
                onclick="window.open('<?php echo base_url('job/new_job1?cus_id=' . $cus_id); ?>', '_blank','location=yes, height=650, width=1200, scrollbars=yes, status=yes');">
                <i class='bx bx-fw bx-message-square-error'></i>
                <span>Jobs</span>
            </a>
        </li>
        <li onclick="location.href='<?php echo base_url('customer'); ?>'">
            <div class="nsm-fab-icon">
                <i class="bx bx-search-alt"></i>
            </div>
            <span class="nsm-fab-label">Find Customer</span>
        </li>
        <li onclick="location.href='<?php echo base_url('job/new_job1'); ?>'">
            <div class="nsm-fab-icon">
                <i class="bx bx-message-square-error"></i>
            </div>
            <span class="nsm-fab-label">Add Job</span>
        </li>
        <li data-bs-toggle="modal" data-bs-target="#quick_links_modal">
            <div class="nsm-fab-icon">
                <i class="bx bx-bookmarks"></i>
            </div>
            <span class="nsm-fab-label">Quick Links</span>
        </li>
        <li data-bs-toggle="modal" data-bs-target="#new_feed_modal">
            <div class="nsm-fab-icon">
                <i class="bx bx-comment"></i>
            </div>
            <span class="nsm-fab-label">News Feed</span>
        </li>
        <?php if( logged('company_id') == 1 ){ ?>
        <li data-bs-toggle="modal" data-bs-target="#news_letter_modal">
            <div class="nsm-fab-icon">
                <i class="bx bx-news"></i>
            </div>
            <span class="nsm-fab-label">Add Newsletter</span>
        </li>
        <?php } ?>
        <li data-bs-toggle="modal" data-bs-target="#manage_widgets_modal">
            <div class="nsm-fab-icon">
                <i class="bx bx-cog"></i>
            </div>
            <span class="nsm-fab-label">Dashboard Settings</span>
        </li>
    </ul>
</div>
<div class="row nsm-page-buttons page-content g-0">
    <div class="col-12 grid-mb text-end">
        <button name="button" type="button" class="nsm-button" id="btn-quick-add-service-ticket">
            <i class='bx bx-fw bx bx-fw bx-note'></i> Add Service Ticket
        </button>
        <button name="button" type="button" class="nsm-button" data-bs-toggle="modal"
            data-bs-target="#new_estimate_modal">
            <i class='bx bx-fw bx-chart'></i> Add Estimate
        </button>
        <button name="button" type="button" class="nsm-button" data-bs-toggle="modal"
            data-bs-target="#new_workorder_modal">
            <i class='bx bx-fw bx-message-alt-add'></i> Add Workorder
        </button>
        <button name="button" type="button" class="nsm-button btn-add-task">
            <i class='bx bx-fw bx-task'></i> New Task
        </button>
        <button name="button" type="button" class="nsm-button"
            onclick="location.href='<?php echo base_url('customer/add_advance'); ?>'">
            <i class='bx bx-fw bx-user-plus'></i> Add Customer
        </button>
        <button name="button" type="button" class="nsm-button"
            onclick="location.href='<?php echo base_url('customer'); ?>'">
            <i class='bx bx-fw bx-search-alt'></i> Find Customer
        </button>
        <button name="button" type="button" class="nsm-button" id="btn-quick-add-job">
            <i class='bx bx-fw bx-message-square-error'></i> Add Job
        </button>
        <button name="button" type="button" class="nsm-button" data-bs-toggle="modal"
            data-bs-target="#quick_links_modal">
            <i class='bx bx-fw bx-bookmarks'></i> Quick Links
        </button>
        <button name="button" type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#new_feed_modal">
            <i class='bx bx-fw bx-comment'></i> News Feed
        </button>

        <?php if( logged('company_id') == 1 ){ ?>
        <button name="button" type="button" class="nsm-button" data-bs-toggle="modal"
            data-bs-target="#news_letter_modal">
            <i class='bx bx-fw bx-news'></i> Add Newsletter
        </button>
        <?php } ?>
        <button name="button" type="button" class="nsm-button primary" data-bs-toggle="modal"
            data-bs-target="#manage_widgets_modal">

            <i class='bx bx-fw bx-cog'></i>
        </button>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12">
        <div class="row  g-3 grid-row-mb nsm-draggable-container2" id="nsm_widgets2">
            <div class="main-widget-row" id="nsm_thumbnail">
                <?php
                foreach ($widgets as $wids) {
                    if ($wids->w_main) {
                        $data['class'] = 'nsm-card nsm-grid2 main-widget-container';
                        $data['isMain'] = false;
                        $data['id'] = $wids->w_id;
                        $data['isListView'] = $wids->w_list_view;
                        $data['isGlobal'] = ($wids->wu_company_id == '0' ? false : true);

                        if ($wids->w_name === 'Expense') {
                            $data = set_expense_graph_data($data);
                        }

                        if ($wids->w_name === 'Bank') {
                            $data = set_bank_widget_data($data);
                        }
                        // if($wids->w_view_link != 'widgets/lead_source'){
                        //     $this->load->view("v2/" . $wids->w_view_link, $data);
                        // }
                        $this->load->view('v2/' . $wids->w_view_link, $data);
                    }
                }
                ?> </div>
        </div>

        <div class="row  g-3 grid-row-mb nsm-draggable-container" id="nsm_widgets">
           <?php
                            if (count($main_widgets) > 0) {
                                foreach ($main_widgets as $wids) {
                                    if ($wids->wu_is_main) {
                                        if ($wids->wu_widget_id == 26) {
                                            echo '<div class="col-12 col-lg-4" id="droppable">';
                                            $data['class'] = 'nsm-card nsm-grid large';
                                        } else {
                                            $data['class'] = 'nsm-card nsm-grid med primary';
                                            echo '<div class="col-12 col-lg-4" id="droppable">';
                                        }

                                        $data['isMain'] = true;
                                        $data['id'] = $wids->w_id;
                                        $data['isGlobal'] = ($wids->wu_company_id == '0' ? false : true);

                                        if ($wids->w_name === 'Expense') {
                                            $data = set_expense_graph_data($data);
                                        }

                                        if ($wids->w_name === 'Bank') {
                                            $data = set_bank_widget_data($data);
                                        }

                                        $this->load->view('v2/' . $wids->w_view_link, $data);

                                        echo '</div>';
                                    }
                                }
                            }
                            ?>

            <?php
            foreach ($widgets as $wids) {
                if (!$wids->wu_is_main && !$wids->w_main) {
                    echo '<div class="col-12 col-lg-4">';
                    $data['class'] = 'nsm-card nsm-grid';
                    $data['isMain'] = false;
                    $data['id'] = $wids->w_id;
                    $data['isGlobal'] = ($wids->wu_company_id == '0' ? false : true);

                    if ($wids->w_name === 'Expense') {
                        $data = set_expense_graph_data($data);
                    }

                    if ($wids->w_name === 'Bank') {
                        $data = set_bank_widget_data($data);
                    }
                    // if($wids->w_view_link != 'widgets/lead_source'){
                    //     $this->load->view("v2/" . $wids->w_view_link, $data);
                    // }
                    $this->load->view('v2/' . $wids->w_view_link, $data);

                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>
</div>

<div class="row nsm-tickertape mb-3 page-content g-0">
    <div class="col-12">
        <div class="nsm-card pb-1 pt-2">
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript"
                    src="https://s3.tradingview.com/external-embedding/embed-widget-tickers.js" async>
                {
                    "symbols": [{
                            "proName": "FOREXCOM:SPXUSD",
                            "title": "S&P 500"
                        },
                        {
                            "proName": "FOREXCOM:NSXUSD",
                            "title": "Nasdaq 100"
                        },
                        {
                            "proName": "FX_IDC:EURUSD",
                            "title": "EUR/USD"
                        },
                        {
                            "proName": "BITSTAMP:BTCUSD",
                            "title": "BTC/USD"
                        },
                        {
                            "proName": "BITSTAMP:ETHUSD",
                            "title": "ETH/USD"
                        }
                    ],
                    "colorTheme": "light",
                    "isTransparent": true,
                    "showSymbolLogo": true,
                    "locale": "en"
                }
                </script>
            </div>
        </div>
    </div>
</div>


<div class="row page-content g-0">
    <div class="col-12">
        <div class="row h-100 g-3">
            <div class="col-12 col-lg-6">
                <div class="nsm-card">
                    <div class="nsm-card-header">
                        <div class="nsm-card-title">
                            <span>Feeds</span>
                        </div>
                    </div>
                    <div class="nsm-card-content">
                        <div class="nsm-widget-table">
                            <?php if ($feeds) { ?>
                            <table class="nsm-table" id="dashboard-feeds">
                                <thead>
                                    <tr>
                                        <td data-name="Activity"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($feeds as $feed) { ?>
                                    <tr>
                                        <td>
                                            <div class="widget-item">
                                                <?php $image = userProfilePicture($feed->sender_id); ?>
                                                <?php if (is_null($image)) { ?>
                                                <div class="nsm-profile">
                                                    <span><?php echo getLoggedNameInitials($feed->sender_id); ?></span>
                                                </div>
                                                <?php } else { ?>
                                                <div class="nsm-profile"
                                                    style="background-image: url('<?php echo $image; ?>');"></div>
                                                <?php } ?>
                                                <div class="content">
                                                    <div class="details">
                                                        <span class="content-title"><?php echo $feed->title; ?></span>
                                                        <span
                                                            class="content-subtitle d-block"><?php echo $feed->message; ?></span>
                                                    </div>
                                                    <div class="controls">
                                                        <span
                                                            class="content-subtitle d-block mt-3"><?php echo date('F d, Y g:i A', strtotime($feed->date_created)); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <?php } else { ?>
                            <div class="nsm-empty">
                                <i class='bx bx-meh-blank'></i>
                                <span>Feed is empty.</span>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="nsm-card">
                    <div class="nsm-card-header">
                        <div class="nsm-card-title">
                            <span>Bulletins</span>
                        </div>
                    </div>
                    <div class="nsm-card-content">
                        <div class="nsm-widget-table">
                            <div id="dashboard-newsletter"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row nsm-tickertape mb-3 page-content g-0">
    <div class="col-12">
        <div class="nsm-card pb-1 pt-2">
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript"
                    src="https://s3.tradingview.com/external-embedding/embed-widget-tickers.js" async>
                {
                    "symbols": [{
                            "proName": "FOREXCOM:SPXUSD",
                            "title": "S&P 500"
                        },
                        {
                            "proName": "FOREXCOM:NSXUSD",
                            "title": "Nasdaq 100"
                        },
                        {
                            "proName": "FX_IDC:EURUSD",
                            "title": "EUR/USD"
                        },
                        {
                            "proName": "BITSTAMP:BTCUSD",
                            "title": "BTC/USD"
                        },
                        {
                            "proName": "BITSTAMP:ETHUSD",
                            "title": "ETH/USD"
                        }
                    ],
                    "colorTheme": "light",
                    "isTransparent": true,
                    "showSymbolLogo": true,
                    "locale": "en"
                }
                </script>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" tabindex="-1" role="dialog" id="drw--modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rename Widget</h5>
                <button name="button" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bx bx-fw bx-x m-0"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="mb-3">
                    <style>
                    #drw--modal .widget-form {
                        display: flex;
                        flex-direction: row;
                        align-items: center;
                        gap: 8px;
                    }

                    #drw--modal .widget-form input {
                        border-radius: .25rem !important;
                    }

                    #drw--modal .widget-form button {
                        border-radius: 5px !important;
                        margin-bottom: 0 !important;
                    }
                    </style>
                    <div class="col-12 col-md">
                        <label class="content-subtitle fw-bold mb-2">Widget Name</label>
                        <div class="input-group widget-form">
                            <input placeholder="Enter widget name" class="form-control nsm-field" maxlength="50">
                            <button name="button" type="button" class="nsm-button primary">
                                Rename
                            </button>
                        </div>
                        <small class="form-text text-muted"></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script type="module" src="<?php echo base_url('assets/js/dashboard/index.js'); ?>"></script>
<?php // include viewPath('tickets/add_modal');
?>
<script>
$(function() {
    $("#dashboard-feeds").nsmPagination({
        itemsPerPage: 5
    });

    load_company_newsletter();
});

function load_company_newsletter() {
    $.ajax({
        url: base_url + 'dashboard/_company_newsletter',
        method: 'post',
        success: function(response) {
            $('#dashboard-newsletter').html(response);
        },
        beforeSend: function() {
            $('#dashboard-newsletter').html("<span class='bx bx-loader bx-spin'></span>");
        },
    });
}

$(document).on('click', '.view-newsletter-details', function() {
    var newsid = $(this).attr('data-id');

    $('#modalViewNewsLetter').modal('show');
    $.ajax({
        url: base_url + 'dashboard/_view_newsletter',
        method: 'post',
        data: {
            newsid: newsid
        },
        success: function(response) {
            $('#modal-view-newsletter-container').html(response);
        },
        beforeSend: function() {
            showLoader($("#modal-view-newsletter-container"));
        },
    });
});

$(document).on('click', '#btn-quick-add-service-ticket', function() {
    var url = base_url + "ticket/_quick_add_service_ticket_form";
    var default_date = moment(new Date());
    var date_selected = default_date.format('YYYY-MM-DD');
    calendar_modal_source = 'quick-add-service-ticket';
    $('#modal-quick-add-service-ticket').modal('show');

    showLoader($("#quick-add-service-ticket-form-container"));

    setTimeout(function() {
        $.ajax({
            type: "GET",
            url: url,
            data: {
                date_selected: date_selected
            },
            success: function(o) {
                $("#quick-add-service-ticket-form-container").html(o);
            }

        });
    });
});

function load_company_newsletter() {
    $.ajax({
        url: base_url + 'widgets/_company_newsletter',
        method: 'post',
        success: function(response) {
            $('#dashboard-newsletter').html(response);
        },
        beforeSend: function() {
            $('#dashboard-newsletter').html("<span class='bx bx-loader bx-spin'></span>");
        },
    });
}

$(document).on('click', '#btn-quick-add-service-ticket', function() {
    var url = base_url + "ticket/_quick_add_service_ticket_form";
    var default_date = moment(new Date());
    var date_selected = default_date.format('YYYY-MM-DD');
    calendar_modal_source = 'quick-add-service-ticket';
    $('#modal-quick-add-service-ticket').modal('show');

    showLoader($("#quick-add-service-ticket-form-container"));

    setTimeout(function() {
        $.ajax({
            type: "GET",
            url: url,
            data: {
                date_selected: date_selected
            },
            success: function(o) {
                $("#quick-add-service-ticket-form-container").html(o);
            }
        });
    }, 500);
});


$(document).on('click', '#btn-quick-add-job', function() {
    var url = base_url + "job/_quick_add_job_form";
    var default_date = moment(new Date());
    var date_selected = default_date.format('YYYY-MM-DD');
    calendar_modal_source = 'quick-add-job';
    $('#modal-quick-select-schedule-type').modal('hide');
    $('#modal-quick-add-job').modal('show');

    showLoader($("#quick-add-job-form-container"));

    setTimeout(function() {
        $.ajax({
            type: "GET",
            url: url,
            data: {
                date_selected: date_selected
            },
            success: function(o) {
                $("#quick-add-job-form-container").html(o);
            }
        });
    }, 500);
});

load_plaid_accounts();

function formatAmount(amount) {
    if (typeof amount !== 'number' || isNaN(amount)) {
        return amount;
    }

    if (amount >= 1000000000) {
        return (amount / 1000000000).toFixed(1) + 'B';
    } else if (amount >= 1000000) {
        return (amount / 1000000).toFixed(1) + 'M';
    } else if (amount >= 1000) {
        return (amount / 1000).toFixed(1) + 'K';
    } else {
        return amount.toLocaleString();
    }
}

var gaugeCharts = [];
var initialChartData = {};

function load_plaid_gauge_chart() {
    var gaugeCanvases = $(".GuageChart");
    gaugeCanvases.each(function() {
        var canvas = $(this);
        var canvasId = canvas.attr("id");
        var dataValue = canvas.data("value");
        var dataRemaining = canvas.data("remaining");
        var dataHighest = canvas.data("highest");
        var ctx = this.getContext('2d'); // Get the canvas context inside each iteration
        var gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(107, 167, 124, 1)'); // Start color
        gradient.addColorStop(1, 'rgba(7, 232, 70, 1)'); // End color
        initialChartData[canvasId] = {
            dataValue,
            dataRemaining,
            dataHighest
        };
        var gaugeData = {
            labels: ['Score', 'Gray Area'],
            datasets: [{
                label: 'Weekly Sales',
                data: [dataValue, dataHighest],
                backgroundColor: [
                    gradient,
                    'rgb(240,240,240)'
                ],
                borderColor: [
                    gradient,
                    'rgb(240,240,240)'
                ],
                borderWidth: 1,
                cutout: '80%',
                circumference: 180,
                rotation: 270
            }]
        };

        var gaugeChartText = {
            id: 'gaugeChartText',
            afterDatasetDraw(chart, args, pluginOptions) {
                const {
                    ctx,
                    data,
                    chartArea: {
                        top,
                        bottom,
                        left,
                        right,
                        width,
                        height
                    },
                    scales: {
                        r
                    }
                } = chart;
                ctx.save();
                const xCoor = chart.getDatasetMeta(0).data[0].x;
                const yCoor = chart.getDatasetMeta(0).data[0].y;
                const amount = data.datasets[0].data[0];
                ctx.font = '10px sans-serif';
                ctx.fillStyle = "rgb(40, 40, 43)";
                ctx.textBaseLine = 'top';
                ctx.textAlign = 'left';
                ctx.fillText('$0', left + 3, yCoor + 12);
                ctx.textAlign = 'right';
                ctx.fillText('$' + formatAmount(dataHighest), right, yCoor + 12);
                ctx.font = '25px sans-serif'
                ctx.textAlign = 'center';
                ctx.textBaseLine = 'bottom';
                ctx.fillText('$' + formatAmount(amount), xCoor, yCoor - 20);
                ctx.font = '15px sans-serif'
                ctx.textAlign = 'center';
                ctx.textBaseLine = 'bottom';
                ctx.fillText('Total Balance', xCoor, yCoor);
            }
        }

        var gaugeConfig = {
            type: 'doughnut',
            data: gaugeData,
            options: {
                aspectRatio: 1.5,
                layout: {
                    padding: 10,
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: false
                    }
                }
            },
            plugins: [gaugeChartText]
        };

        // Render the gauge chart
        var gaugeChart = new Chart(document.getElementById(canvasId), gaugeConfig);
        gaugeCharts.push(gaugeChart);
    });
}



function load_plaid_accounts() {
    var url = base_url + '_load_connected_bank_accounts_thumbnail';
    $('#plaid-accounts-thumbnail').html('<h1><span class="bx bx-loader bx-spin"></span></h1>');
    $.ajax({
        type: "POST",
        url: url,
        success: function(o) {

            $('#plaid-accounts-thumbnail').html(o);
            $('#plaid_label').hide();
            load_plaid_gauge_chart();

            console.log(initialChartData);
        }
    });
}
</script>

<?php include viewPath('v2/includes/footer'); ?>