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
    font-size: 26px;
    font-weight: 500;
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
    width: 430px;
    box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .14), 0 2px 1px -1px rgba(0, 0, 0, .12), 0 1px 3px 0 rgba(0, 0, 0, .2);
    border-radius: .75rem;
    height: 390px;
    max-height: 430px;
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
.modal-big-btn{
    height: 53px !important;
    display: block;
    font-size: 20px;
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
                onclick="window.open('<?php echo base_url('job/new_job1?cus_id='.$cus_id); ?>', '_blank','location=yes, height=650, width=1200, scrollbars=yes, status=yes');">
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
        <?php if (logged('company_id') == 1) { ?>
        <li data-bs-toggle="modal" data-bs-target="#news_letter_modal">
            <div class="nsm-fab-icon">
                <i class="bx bx-news"></i>
            </div>
            <span class="nsm-fab-label">Add Newsletter</span>
        </li>
        <?php } ?>
        <li data-bs-toggle="modal" data-bs-target="#dashboardThumbnailWidgetSettingsModal">
            <div class="nsm-fab-icon"><i class="bx bx-cog"></i></div><span class="nsm-fab-label">Dashboard Settings</span>
        </li>
        <!-- <li data-bs-toggle="modal" data-bs-target="#manage_widgets_modal">
            <div class="nsm-fab-icon"><i class="bx bx-cog"></i></div><span class="nsm-fab-label">Dashboard Settings</span>
        </li> -->
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
        <button name="button" type="button" class="nsm-button" id="dashboard-btn-add-customer">
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

        <?php if (logged('company_id') == 1) { ?>
        <button name="button" type="button" class="nsm-button" data-bs-toggle="modal"
            data-bs-target="#news_letter_modal">
            <i class='bx bx-fw bx-news'></i> Add Newsletter
        </button>
        <?php } ?>
        <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#dashboardThumbnailWidgetSettingsModal"><i class='bx bx-fw bx-cog'></i></button>
        <!-- <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#manage_widgets_modal">TEST ONLY</button> -->
    </div>
</div>

<?php 
    $presetThumbnail = [];
    $presetWidget = [];

    if (!empty($thumbnailWidgetPreset) && isset($thumbnailWidgetPreset[0])) {
        $presetThumbnail = json_decode($thumbnailWidgetPreset[0]->thumbnail ?? '[]', true);
        $presetWidget = json_decode($thumbnailWidgetPreset[0]->widget ?? '[]', true);
    }

    $isThumbnailPresent = !empty($presetThumbnail);
    $isWidgetPresent = !empty($presetWidget);

    include viewPath('widgetThumbnailSettings');
?>

<div class="row page-content g-0">
    <div class="col-lg-12">
        <div class="thumbnailLayoutControl display_none">
            <a href="javascript:void(0)" class="text-decoration-none thumbnailCustomizeLayout"><span>Customize Thumbnail Layout</span></a>
            <a href="javascript:void(0)" class="text-decoration-none thumbnailSaveLayout display_none"><span>Save Layout</span></a>&nbsp;&nbsp;
            <a href="javascript:void(0)" class="text-decoration-none thumbnailCancelLayout display_none text-muted"><span>Cancel</span></a>
        </div>
        <div id="thumbnailMasonry" class="row thumbnailSortable thumbnailCardContainers">
            <?php 
                if ($isThumbnailPresent) {
                    foreach ($presetThumbnail as $presetThumbnails) {
                        foreach ($thumbnailWidgetOption as $thumbnailWidgetOptions) {
                            if ($thumbnailWidgetOptions->id == $presetThumbnails['id']) {
                                $thumbnailsWidgetCard = $thumbnailWidgetOptions;
                                $option_cardContainer = "$thumbnailWidgetOptions->category$thumbnailWidgetOptions->id$thumbnailWidgetOptions->type";
                                $option_id = "$thumbnailWidgetOptions->id";
                                
                                $width = $presetThumbnails['width'];
                                $colWidth = $presetThumbnails['colWidth'];
                                $height = $presetThumbnails['height'];
                                $graphState = $presetThumbnails['graphDisplayState'];

                                echo "<div class='col-lg-3 mt-3 $option_cardContainer' data-id='$option_id'>";
                                include viewPath("v2/dashboard/thumbnail/$thumbnailWidgetOptions->category"); 
                                echo "</div>";
                                break;
                            }
                        }
                    }
                }
            ?>
        </div>
    </div>
    <div class="col-lg-12">
        <hr style="margin: 2em;">
    </div>
    <div class="col-lg-12">
        <div class="widgetLayoutControl display_none">
            <a href="javascript:void(0)" class="text-decoration-none widgetCustomizeLayout"><span>Customize Widget Layout</span></a>
            <a href="javascript:void(0)" class="text-decoration-none widgetSaveLayout display_none"><span>Save Layout</span></a>&nbsp;&nbsp;
            <a href="javascript:void(0)" class="text-decoration-none widgetCancelLayout display_none text-muted "><span>Cancel</span></a>
        </div>
        <div id="widgetMasonry" class="row widgetSortable widgetCardContainers">
            <?php 
                if ($isWidgetPresent) {
                    foreach ($presetWidget as $presetWidgets) {
                        foreach ($thumbnailWidgetOption as $thumbnailWidgetOptions) {
                            if ($thumbnailWidgetOptions->id == $presetWidgets['id']) {
                                $thumbnailsWidgetCard = $thumbnailWidgetOptions;
                                $option_cardContainer = "$thumbnailWidgetOptions->category$thumbnailWidgetOptions->id$thumbnailWidgetOptions->type";
                                $option_id = "$thumbnailWidgetOptions->id";
                                
                                $width = $presetWidgets['width'];
                                $colWidth = $presetWidgets['colWidth'];
                                $height = $presetWidgets['height'];
                                $graphState = $presetWidgets['graphDisplayState'];

                                echo "<div class='col-lg-4 mt-3 $option_cardContainer' data-id='$option_id'>";
                                include viewPath("v2/dashboard/widget/$thumbnailWidgetOptions->category"); 
                                echo "</div>";
                                break;
                            }
                        }
                    }
                }
            ?>
        </div>
        <script>
        $(document).ready(function() {
            const graphLoaders = document.querySelectorAll('.graphLoader');

            if (graphLoaders.length === 0) {
                initMasonry();
                return;
            }

            const observer = new MutationObserver(() => {
                const count = $('.graphLoader').filter(function() {
                    return $(this).css('display') !== 'none';
                }).length;

                if (count === 0) {
                    observer.disconnect();
                    initMasonry();
                }
            });

            graphLoaders.forEach(el => {
                observer.observe(el, {
                    attributes: true,
                    attributeFilter: ['style', 'class']
                });
            });

            const initialCount = $('.graphLoader').filter(function() {
                return $(this).css('display') !== 'none';
            }).length;

            if (initialCount === 0) {
                observer.disconnect();
                initMasonry();
            }
        });

        function initMasonry() {
            thumbnailMasonry = new Masonry(document.getElementById('thumbnailMasonry'), {
                percentPosition: true,
                horizontalOrder: true,
            });
            $('.thumbnailLayoutControl').show();

            widgetMasonry = new Masonry(document.getElementById('widgetMasonry'), {
                percentPosition: true,
                horizontalOrder: true,
            });
            $('.widgetLayoutControl').show();
        }
    </script>
    </div>
    <div class="col-lg-12">
        <div class="row row-cols-md-3" id="nsm_widgets2">
                <?php
                    // usort($widgets, function ($a, $b) {
                    //     if ($a->w_sort == 1 && $b->w_sort != 1) {
                    //         return -1;
                    //     }
                    //     if ($a->w_sort != 1 && $b->w_sort == 1) {
                    //         return 1;
                    //     }
                    //     return strcmp($a->w_name, $b->w_name);
                    // });
                    
                    foreach ($widgets as $wids) {
                        if ($wids->w_main && checkRoleCanAccessWidget($wids->w_id)) {
                            echo "
                            ";
                            echo "<div class='col-lg-4 mt-3 divThumbnailCard' data-id='$wids->w_id' id='thumbnail_$wids->w_id'>";
                            // echo "<style>
                            //         div[data-id='$wids->w_id'] {
                            //             min-width: 398.297px;
                            //         }

                            //         div[data-id='$wids->w_id'] > .card {
                            //             min-height: 216.094px;
                            //         }
                            //      </style>"; FOR LATER DEVELOPMENT
                            
                            $data['class'] = 'card';
                            $data['isMain'] = false;
                            $data['id'] = $wids->w_id;
                            $data['isListView'] = $wids->w_list_view;
                            $data['isGlobal'] = ($wids->wu_company_id == '0' ? false : true);

                            if ($wids->w_name === 'Expense') {
                                $data = set_expense_graph_data($data);
                            } elseif ($wids->w_name === 'Bank') {
                                $data = set_bank_widget_data($data);
                            }
                
                            if ($wids->wu_company_id == 1) {
                                $this->load->view('v2/' . $wids->w_view_link, $data);
                            } else {
                                if ($wids->w_name !== 'nSmart Sales' || $wids->w_name !== 'Demo Schedules' || $wids->w_name !== 'Coupon Codes' || $wids->w_name !== 'nSmart Companies' ) {
                                    $this->load->view('v2/' . $wids->w_view_link, $data);
                                }
                            }

                            echo "</div>";
                        }
                    }
                ?> 
        </div>

        <div class="row g-3 grid-row-mb nsm-draggable-container-sortable-main mt-3" id="nsm_widgets">
            <?php
                if (count($main_widgets) > 0) {
                    foreach ($main_widgets as $wids) {
                        if ($wids->wu_is_main && checkRoleCanAccessWidget($wids->w_id)) {
                            if ($wids->wu_widget_id == 26) {
                                echo '<div class="col-12 col-lg-4" id="widget-'.$wids->wu_widget_id.'">';
                                $data['class'] = 'nsm-card nsm-grid large';
                            } else {
                                echo '<div class="col-12 col-lg-4" id="widget-'.$wids->wu_widget_id.'">';
                                $data['class'] = 'nsm-card nsm-grid med primary';
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

                            $this->load->view('v2/'.$wids->w_view_link, $data);

                            echo '</div>';
                        }
                    }
                }
            ?>

            <?php
                foreach ($widgets as $wids) {
                    if (!$wids->wu_is_main && !$wids->w_main && checkRoleCanAccessWidget($wids->w_id)) {
                        echo '<div class="col-12 col-lg-4" data-order="'.$wids->wu_order.'" id="widget-'.$wids->wu_widget_id.'">';
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
                        $this->load->view('v2/'.$wids->w_view_link, $data);

                        echo '</div>';
                    }
                }
            ?>
        </div>
    </div>
    <div class="col-lg-12">
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

<div class="row nsm-tickertape mb-3 page-content g-0 mt-3">
    
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

<!-- <div class="row nsm-tickertape mb-3 page-content g-0">
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
</div> -->

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

<div class="modal fade nsm-modal" tabindex="-1" role="dialog" id="modal-quick-add-customer">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Customer</h5>
                <button name="button" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bx bx-fw bx-x m-0"></i>
                </button>
            </div>
            <div class="modal-body" style="padding:24px;">
                <h3 style="font-size:16px;margin-bottom:33px;">Select which type of customer you want to create</h3>
                <div class="row">
                    <div class="col-md-6">
                        <a class="nsm nsm-button primary modal-big-btn" target="_new" href="<?= base_url('customer/add_advance'); ?>"><i class="bx bx-fw bx-user"></i> Customer</a>
                    </div>
                    <div class="col-md-6">
                        <a class="nsm nsm-button primary modal-big-btn" target="_new" href="<?= base_url('customer/add_lead'); ?>"><i class="bx bx-fw bxs-contact"></i> Leads</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="module" src="<?php echo base_url('assets/js/dashboard/index.js'); ?>"></script>
<?php // include viewPath('tickets/add_modal');?>
<!-- Map files -->
<script src='https://unpkg.com/popper.js/dist/umd/popper.min.js'></script>
<script type="text/javascript" src="https://unpkg.com/maplibre-gl@1.15.2/dist/maplibre-gl.js"></script>
<link rel="stylesheet" type="text/css" href="https://unpkg.com/maplibre-gl@1.15.2/dist/maplibre-gl.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdn.maptiler.com/maptiler-sdk-js/v2.0.3/maptiler-sdk.umd.js"></script>
<link href="https://cdn.maptiler.com/maptiler-sdk-js/v2.0.3/maptiler-sdk.css" rel="stylesheet" />
<script src="https://cdn.maptiler.com/leaflet-maptilersdk/v2.0.0/leaflet-maptilersdk.js"></script>

<link rel="stylesheet" type="text/css" href="https://unpkg.com/@geoapify/geocoder-autocomplete@1.4.0/styles/minimal.css" />
<script src="https://unpkg.com/@geoapify/geocoder-autocomplete@1.4.0/dist/index.min.js"></script>
<!-- End Map files -->
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

collectionGraphThumbnail();

function collectionGraphThumbnail() {

    fetch('<?php echo base_url('Dashboard/collections_graph'); ?>', {}).then(response => response.json())
        .then(
            response => {
                var currentDate    = new Date();
                var month_index    = currentDate.getMonth() + 1;
                var monthlyAmounts = new Array(month_index).fill(0);


                var {
                    success,
                    collection
                } = response;
                var totalCollection = 0;

                if (collection) {
                    for (var x = 0; x < collection.length; x++) {

                        var insA          = new Date(collection[x].date_created);
                        if( insA.getFullYear() < currentDate.getFullYear() ){    
                            var installDate = '2024-01-01';
                        }else if( insA > currentDate ){        
                            var installDate = moment(currentDate).format('YYYY-MM-DD');
                        }else{
                            var installDate = collection[x].date_created;
                        }

                        if (installDate) {
                            var ins = new Date(installDate);
                            var month = ins.getMonth();             
                        
                            if( isNaN(parseFloat(collection[x].grand_total)) ){
                                monthlyAmounts[month] += 0;
                            }else{
                                monthlyAmounts[month] += parseFloat(collection[x].grand_total);
                            }
                        }
                    }

                    var start = 0;
                    var prev_amount = 0;
                    for (i = 0; i < monthlyAmounts.length; ++i) {
                        if( start == 0 ){
                            var amount = monthlyAmounts[i];
                        }else{
                            var amount = monthlyAmounts[i] + prev_amount;
                        }

                        prev_amount = amount;
                        monthlyAmounts[i] = amount;                
                        start++;
                    }
                }

                var collection_data = {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
                        'Nov', 'Dec'
                    ],
                    datasets: [{
                        label: 'Collection',
                        backgroundColor: 'rgb(199 149 28)',
                        borderColor: 'rgb(199 149 28)',
                        data: monthlyAmounts
                    }]
                };

                $('#collectionGraphLoader').hide()

                const collectionGraph = new Chart($('#collectionGraph'), {
                    type: 'line',
                    data: collection_data,
                    options: {
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem, data) {
                                        const amount = tooltipItem.formattedValue;
                                        return '$' + amount.toLocaleString(undefined, {minimumFractionDigits: 2});
                                    }
                                }
                            },
                            legend: {
                                position: 'bottom',
                            },
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                suggestedMax: 10,
                                ticks: {
                                    callback: function(value, index, values) {
                                        return '$' + value.toLocaleString(undefined, {minimumFractionDigits: 2});
                                    }
                                }
                            },
                        },
                        aspectRatio: 1.2,
                    },
                });

                window.collectionGraph = collectionGraph;
            }).catch((error) => {
            console.log(error);
        })
}

function subscriptionThumbnail() {
    fetch('<?php echo base_url('Dashboard/income_subscription'); ?>', {}).then(response => response.json()).then(
        response => {
            var currentDate = new Date();
            var month_index = currentDate.getMonth() + 1;
            var monthlyAmounts = new Array(month_index).fill(0);
            var {
                success,
                mmr
            } = response;

            let status = [];

            if (mmr) {
                for (var x = 0; x < mmr.length; x++) {
                    if (mmr[x].bill_end_date == '0000-00-00' || mmr[x].bill_end_date == '1970-01-01') {
                        var installDate = '2024-01-01';
                    } else {
                        //var installDate = mmr[x].bill_end_date;

                        var insA = new Date(mmr[x].bill_end_date);

                        if (insA.getFullYear() < currentDate.getFullYear()) {
                            var installDate = '2024-01-01';
                        } else if (insA > currentDate) {
                            var installDate = moment(currentDate).format('YYYY-MM-DD');
                        } else {
                            var installDate = mmr[x].bill_end_date;
                        }

                        // var currentYear  = new Date().getFullYear();
                        // var insA     = new Date(mmr[x].bill_end_date);
                        // var insAYear = insA.getFullYear();

                        // if( insAYear < currentYear ){                        
                        //     var installDate = '2024-01-01';
                        // }else if( insAYear > currentYear ){
                        //     var today = new Date();                                     
                        //     var installDate = moment(today).format('YYYY-MM-DD');
                        // }else{
                        //     var installDate = mmr[x].bill_end_date;
                        // }
                    }

                    if (installDate) {
                        var ins = new Date(installDate);
                        var month = ins.getMonth();
                        if (!status.includes(mmr[x].status)) {
                            status.push(mmr[x].status);
                        }
                        if (isNaN(parseFloat(mmr[x].mmr))) {
                            monthlyAmounts[month] += 0;
                        } else {
                            monthlyAmounts[month] += parseFloat(mmr[x].mmr);
                        }
                    }
                }

                var start = 0;
                var prev_amount = 0;
                for (i = 0; i < monthlyAmounts.length; ++i) {
                    if (start == 0) {
                        var amount = monthlyAmounts[i];
                    } else {
                        var amount = monthlyAmounts[i] + prev_amount;
                    }

                    prev_amount = amount;
                    monthlyAmounts[i] = amount;
                    start++;
                }
            }

            let output = '';
            if (status.length > 0) {
                output = '<select class="nsm-field form-select filterSubscriptionStatus" style="width: 90%;border: none;" onChange="filterSubscription()">';
                output += `<option value="">All Status</option>`;
                for (var i = 0; i < status.length; i++) {
                    output += `<option value="${status[i]}">${status[i]}</option>`;
                }
                output += '</select>';
            }

            // $('#filter-subscription-status').html(output);


            var sales_data = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Subscription',
                    backgroundColor: 'rgb(220, 53, 69 ,0.79)',
                    borderColor: 'rgb(220, 53, 69 ,0.79)',
                    data: monthlyAmounts.map(amount => parseFloat(amount.toFixed(2)))
                }]
            };


            $('#IncomeSubscriptioneGraphLoader').hide()


            const subscriptionChart = new Chart($('#income_subscription'), {
                type: 'line',
                data: sales_data,
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    const amount = tooltipItem.raw;
                                    return `$ ${amount.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                                }
                            }
                        },
                        legend: {
                            position: 'bottom',
                        },
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: 10,
                            ticks: {
                                callback: function(value) {
                                    return `$ ${value.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                                }
                            }
                        },
                    },
                    aspectRatio: 1.5,
                }
            });


            window.subscriptionChart = subscriptionChart;
        }).catch((error) => {
        console.log(error);
    })
}
subscriptionThumbnail();

openInvoicesGraphThumbnail();

function openInvoicesGraphThumbnail() {
    fetch('<?php echo base_url('Dashboard/open_invoices_graph'); ?>', {}).then(response => response.json()).then(
        response => {
            var currentDate    = new Date();
            var month_index    = currentDate.getMonth() + 1;
            var monthlyAmounts = new Array(month_index).fill(0);

            var {
                success,
                open_invoices
            } = response;



            if (open_invoices) {
                for (var x = 0; x < open_invoices.length; x++) {
                    var insA          = new Date(open_invoices[x].date_created);
                    if( insA.getFullYear() < currentDate.getFullYear() ){    
                        var installDate = '2024-01-01';
                    }else if( insA > currentDate ){        
                        var installDate = moment(currentDate).format('YYYY-MM-DD');
                    }else{
                        var installDate = open_invoices[x].date_created;
                    }

                    if (installDate) {
                        var ins = new Date(installDate);
                        var month = ins.getMonth();             
                        monthlyAmounts[month] += 1;
                    }
                }

                var start = 0;
                var prev_amount = 0;
                for (i = 0; i < monthlyAmounts.length; ++i) {
                if( start == 0 ){
                    var amount = monthlyAmounts[i];
                }else{
                    var amount = monthlyAmounts[i] + prev_amount;
                }

                prev_amount = amount;
                monthlyAmounts[i] = amount;                
                start++;
                }
            }

            var openinvoices_data = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Open Invoices Count',
                    backgroundColor: 'rgb(220, 53, 69 ,0.79)',
                    borderColor: 'rgb(220, 53, 69 ,0.79)',
                    data: monthlyAmounts
                }]
            };
            $('#OpenInvoicesGraphLoader').hide()

            const OpenInvoicesGraph = new Chart($('#OpenInvoicesGraph'), {
                type: 'bar',
                data: openinvoices_data,
                options: {
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: 10
                        },
                    },
                    aspectRatio: 1.2,
                },
            });

            window.OpenInvoicesGraph = OpenInvoicesGraph;
        }).catch((error) => {
        console.log(error);
    })

}

accountingExpenseGraphThumbnail();

function number_format(number, decimals, dec_point, thousands_sep) {
    number = parseFloat(number).toFixed(decimals);
    const parts = number.split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_sep);
    //console.log('parts.join(dec_point)',parts.join(dec_point))
    return parts.join(dec_point);
}

function accountingExpenseGraphThumbnail() {
    fetch('<?php echo base_url('Dashboard/accounting_expense'); ?>', {}).then(response => response.json()).then(
        response => {

            var {
                success,
                accounting_expense
            } = response;


            let expenseCategory = [];
            let dataTemp = [];
            let total_expense = 0;


            if (accounting_expense) {
                for (var x = 0; x < accounting_expense.length; x++) {

                    if (accounting_expense[x].category) {
                        if (accounting_expense[x].category.name) {
                            expenseCategory.push(accounting_expense[x].category.name)
                            dataTemp.push(accounting_expense[x].total)
                            total_expense += parseInt(accounting_expense[x].total)
                        }
                    }

                }
            }
            let output = '';
            if (expenseCategory.length > 0) {
                output = '<select class="form-select" onChange="filterAccountingExpenseCategory(this.value)">';
                output += `<option value="">All Categories</option>`;
                for (var i = 0; i < expenseCategory.length; i++) {
                    output += `<option value="${expenseCategory[i]}">${expenseCategory[i]}</option>`;
                }
                output += '</select>';
            }

            $('.accountingExpenseFilter').append(output);


            var new_leads_data = {
                labels: expenseCategory,
                datasets: [{
                    label: 'Total leads',
                    data: dataTemp,
                    backgroundColor: [
                        'rgb(106 74 134)',
                        'rgb(199 149 28)',
                        'rgb(64 136 84)',
                        'rgb(220 53 69)',
                        'rgb(206, 128, 255)'
                    ],
                }]
            };

            $('#AccountingExpenseGraphLoader').hide()


            const AccountingExpenseGraph = new Chart($('#AccountingExpenseGraph'), {
                type: 'doughnut',
                data: new_leads_data,
                options: {
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                boxWidth: 10,
                            }
                        },
                    },
                    layout: {
                        padding: {
                            left: 5,
                            right: 5,
                            top: 0,
                        }
                    },
                },
            });

            $(".total_expense_graph_total").html('$ ' + total_expense.toLocaleString(undefined, {minimumFractionDigits: 2}));
            $("#total_expense_graph").html('$' + total_expense.toLocaleString(undefined, {minimumFractionDigits: 2}));


            window.AccountingExpenseGraph = AccountingExpenseGraph;
        }).catch((error) => {
        console.log(error);
    })

}

customerGroupsGraphThumbnail();

function customerGroupsGraphThumbnail() {
    fetch('<?php echo base_url('Dashboard/get_all_customer_group'); ?>', {}).then(response => response.json()).then(
        response => {
            var { success, customer } = response;

            let labelsTemp = [];
            let dataTemp = [];
            let totalCustomer = 0;
            let totalActiveCustomerGroup = 0;

            if (customer) {
                for (var x = 0; x < customer.length; x++) {
                    labelsTemp.push(customer[x].title + ': ' + customer[x].total_customer)
                    dataTemp.push(customer[x].total_customer)
                    totalCustomer += parseInt(customer[x].total_customer)
                    totalActiveCustomerGroup++;
                }
            }

            var customer_graph_data = {
                labels: labelsTemp,
                datasets: [{
                    label: 'Total Customer Groups',
                    data: dataTemp,
                    backgroundColor: [
                        'rgb(106 74 134)',
                        'rgb(64 136 84)',
                        'rgb(220 53 69)',
                        'rgb(206, 128, 255)'
                    ],
                }]
            };
            $('#NewCustomerGraphLoader').hide()


            const NewCustomerWidgetsGraph = new Chart($('#NewCustomerWidgetsGraph'), {
                type: 'pie',
                data: customer_graph_data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                boxWidth: 15,
                            }
                        },
                    },
                    layout: {
                        padding: {
                            left: 0,
                            right: 0,
                            top: 5,
                        }
                    },
                },
            });
            $(".recent-customer-container-count").html(totalCustomer);
            $("#total_customer_graph").html(totalActiveCustomerGroup);


            window.NewCustomerWidgetsGraph = NewCustomerWidgetsGraph;
        }).catch((error) => {
        console.log(error);
    })

}

salesGraphThumbnail();

function salesGraphThumbnail() {
    fetch('<?php echo base_url('Dashboard/sales_graph'); ?>', {}).then(response => response.json()).then(
        response => {
            var monthlyAmounts = new Array(12).fill(0);

            var {
                success,
                open_invoices
            } = response;

            if (open_invoices) {
                for (var x = 0; x < open_invoices.length; x++) {
                    var dueDate = open_invoices[x].due_date;
                    if (dueDate) {
                        var due = new Date(dueDate);
                        var month = due.getMonth();

                        monthlyAmounts[month] += parseFloat(open_invoices[x].grand_total);
                    }
                }
            }

            var sales_graph_data = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Sales',
                    backgroundColor: 'rgb(106, 74, 134)',
                    borderColor: 'rgb(106, 74, 134)',
                    data: monthlyAmounts
                }]
            };
            $('#SalesGraphLoader').hide()

            const SalesWidgetsGraph = new Chart($('#SalesWidgetsGraph'), {
                type: 'line',
                data: sales_graph_data,
                options: {
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    const amount = tooltipItem.formattedValue;
                                    return '$' + amount.toLocaleString(undefined, {minimumFractionDigits: 2});
                                }
                            }
                        },                        
                        legend: {
                            position: 'bottom',
                        },
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: 10,
                            ticks: {
                                callback: function(value, index, values) {
                                    return '$' + value.toLocaleString(undefined, {minimumFractionDigits: 2});
                                }
                            }
                        },                        
                    },
                    aspectRatio: 1.2,
                },
            });

            window.SalesWidgetsGraph = SalesWidgetsGraph;
        }).catch((error) => {
        console.log(error);
    })
}

nsmartSales();

function nsmartSales() {

    fetch('<?php echo base_url('Dashboard/nsmart_sales'); ?>', {}).then(response => response.json()).then(
        response => {
            //var monthlyAmounts = new Array(12).fill(0);
            var currentDate    = new Date();
            var month_index    = currentDate.getMonth() + 1;
            var monthlyAmounts = new Array(month_index).fill(0);            

            var {
                success,
                nsmart_sales
            } = response;

            //console.log('nsmart_sales',nsmart_sales)         

            if (nsmart_sales) {
                for (var x = 0; x < nsmart_sales.length; x++) {

                    var insA = new Date(nsmart_sales[x].plan_date_registered);
                    if( insA.getFullYear() < currentDate.getFullYear() ){    
                        var installDate = '2024-01-01';
                    }else if( insA > currentDate ){        
                        var installDate = moment(currentDate).format('YYYY-MM-DD');
                    }else{
                        var installDate = nsmart_sales[x].plan_date_registered;
                    }                    

                    if (installDate) {
                        var due = new Date(installDate);
                        var month = due.getMonth();
                        monthlyAmounts[month] += parseFloat(nsmart_sales[x].price - nsmart_sales[x].discount );
                    }
                }

                var start = 0;
                var prev_amount = 0;
                for (i = 0; i < monthlyAmounts.length; ++i) {
                    if( start == 0 ){
                        var amount = monthlyAmounts[i];
                    }else{
                        var amount = monthlyAmounts[i] + prev_amount;
                    }

                    prev_amount = amount;
                    monthlyAmounts[i] = amount;                
                    start++;
                }                
            }

            var nsmart_sales_data = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Total Balance',
                    backgroundColor: 'rgb(223 38 5)',
                    borderColor: 'rgb(220, 53, 69 ,0.79)',
                    data: monthlyAmounts
                }]
            };
            $('#nsmartSalesLoader').hide()

            const nsmartSalesGraph = new Chart($('#nsmartSalesGraph'), {
                type: 'bar',
                data: nsmart_sales_data,
                options: {
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    const amount = tooltipItem.formattedValue;
                                    return '$' + amount.toLocaleString(undefined, {minimumFractionDigits: 2});
                                }
                            }
                        },
                        legend: {
                            position: 'bottom',
                        },
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: 10,
                            ticks: {
                                callback: function(value, index, values) {
                                    return '$' + value.toLocaleString(undefined, {minimumFractionDigits: 2});
                                }
                            }
                        },
                    },
                    aspectRatio: 1.2,
                },
            });

            window.nsmartSalesGraph = nsmartSalesGraph;
        }).catch((error) => {
        console.log(error);
    })
}


pastDueGraphThumbnail();

function pastDueGraphThumbnail() {

    fetch('<?php echo base_url('Dashboard/past_due_invoices'); ?>', {}).then(response => response.json()).then(
        response => {
            //var monthlyAmounts = new Array(12).fill(0);
            var currentDate    = new Date();
            var month_index    = currentDate.getMonth() + 1;
            var monthlyAmounts = new Array(month_index).fill(0);            

            var {
                success,
                past_due
            } = response;

            /*if (past_due) {
                for (var x = 0; x < past_due.length; x++) {
                    var dueDate = past_due[x].due_date;
                    if (dueDate) {
                        var due = new Date(dueDate);
                        var month = due.getMonth();

                        monthlyAmounts[month] += parseFloat(past_due[x].balance);
                    }
                }
            }*/

            if (past_due) {
                for (var x = 0; x < past_due.length; x++) {

                    var dueDate = past_due[x].due_date;

                    var insA = new Date(past_due[x].due_date);
                    if( insA.getFullYear() < currentDate.getFullYear() ){    
                        var installDate = '2024-01-01';
                    }else if( insA > currentDate ){        
                        var installDate = moment(currentDate).format('YYYY-MM-DD');
                    }else{
                        var installDate = past_due[x].due_date;
                    }                    

                    if (dueDate) {
                        var due = new Date(dueDate);
                        var month = due.getMonth();
                        monthlyAmounts[month] += parseFloat(past_due[x].balance);
                    }
                }

                var start = 0;
                var prev_amount = 0;
                for (i = 0; i < monthlyAmounts.length; ++i) {
                    if( start == 0 ){
                        var amount = monthlyAmounts[i];
                    }else{
                        var amount = monthlyAmounts[i] + prev_amount;
                    }

                    prev_amount = amount;
                    monthlyAmounts[i] = amount;                
                    start++;
                }                
            }

            var pastdue_data = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Total Balance',
                    backgroundColor: 'rgb(223 38 5)',
                    borderColor: 'rgb(220, 53, 69 ,0.79)',
                    data: monthlyAmounts
                }]
            };
            $('#PastDueGraphLoader').hide()

            const pastDueGraph = new Chart($('#PastDueGraph'), {
                type: 'bar',
                data: pastdue_data,
                options: {
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    const amount = tooltipItem.formattedValue;
                                    return '$' + amount.toLocaleString(undefined, {minimumFractionDigits: 2});
                                }
                            }
                        },
                        legend: {
                            position: 'bottom',
                        },
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: 10,
                            ticks: {
                                callback: function(value, index, values) {
                                    return '$' + value.toLocaleString(undefined, {minimumFractionDigits: 2});
                                }
                            }
                        },
                    },
                    aspectRatio: 1.2,
                },
            });

            window.pastDueGraph = pastDueGraph;
        }).catch((error) => {
        console.log(error);
    })
}


estimateGraphThumbnail();

function estimateGraphThumbnail() {
    fetch('<?php echo base_url('Dashboard/estimate_thumbnail'); ?>', {}).then(response => response.json()).then(
        response => {
            var monthlyAmounts = new Array(12).fill(0);

            var {
                success,
                estimates,
                expired_estimates
            } = response;


            var ctx = document.getElementById('estimate_chart').getContext('2d');
            var gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(106,74,134, 1)');
            gradient.addColorStop(1, 'rgba(142,43,227, 1)');

            const gaugeChartText = {
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

                    // Destructure the data array
                    const [totalEstimate, expiredEstimate] = chart.data.datasets[0].data;

                    const xCoor = chart.getDatasetMeta(0).data[0].x;
                    const yCoor = chart.getDatasetMeta(0).data[0].y;

                    ctx.font = '30px FontAwesome';
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    ctx.fillStyle = '#6a4a86'; // Color of the icon
                    ctx.fillText('\uf681', xCoor, yCoor - 30);

                    ctx.font = '16px sans-serif';
                    ctx.fillStyle = "rgb(40, 40, 43)";
                    ctx.textBaseline = 'top';
                    ctx.textAlign = 'left';
                    ctx.fillText('Open', left + 80, yCoor + 5);
                    ctx.textAlign = 'right';
                    ctx.fillText('Expired', right - 70, yCoor + 5);

                    // Use the destructured variables
                    ctx.textAlign = 'left';
                    ctx.fillText(totalEstimate, left + 90, yCoor + 25);
                    ctx.textAlign = 'right';
                    ctx.fillText(expiredEstimate, right - 80, yCoor + 25);

                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'bottom';
                }
            }



            $('#GuageEstimateLoader').hide()

            const estimateChart = new Chart($('#estimate_chart'), {
                type: 'doughnut',
                data: {
                    labels: ['Open', 'Expired'],
                    datasets: [{
                        data: [estimates, expired_estimates],
                        backgroundColor: [
                            gradient,
                            'rgb(240,240,240)'
                        ],
                        borderColor: [
                            gradient,
                            'rgb(240,240,240)'
                        ],
                        borderWidth: 1,
                        cutout: '70%',
                        circumference: 300,
                        rotation: 210
                    }]
                },
                options: {
                    aspectRatio: 1.5,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            enabled: false
                        }
                    }
                },
            });

            window.estimateChart = estimateChart;
        }).catch((error) => {
        console.log(error);
    })
}

incomeGraphThumbnail()

function incomeGraphThumbnail() {
    fetch('<?php echo base_url('Dashboard/income_thumbnail_graph'); ?>', {}).then(response => response.json()).then(
        response => {
            var currentDate    = new Date();
            var month_index    = currentDate.getMonth() + 1;
            var monthlyAmounts = new Array(month_index).fill(0);

            var {
                success,
                income,
            } = response;


            if (income) {
                for (var x = 0; x < income.length; x++) {
                    var insA          = new Date(income[x].date_created);
                    if( insA.getFullYear() < currentDate.getFullYear() ){    
                        var installDate = '2024-01-01';
                    }else if( insA > currentDate ){        
                        var installDate = moment(currentDate).format('YYYY-MM-DD');
                    }else{
                        var installDate = income[x].date_created;
                    }

                    if (installDate) {
                        var ins = new Date(installDate);
                        var month = ins.getMonth();             
                    
                        if( isNaN(parseFloat(income[x].grand_total)) ){
                            monthlyAmounts[month] += 0;
                        }else{
                            monthlyAmounts[month] += parseFloat(income[x].grand_total);
                        }
                    }
                }

                var start = 0;
                var prev_amount = 0;
                for (i = 0; i < monthlyAmounts.length; ++i) {
                    if( start == 0 ){
                        var amount = monthlyAmounts[i];
                    }else{
                        var amount = monthlyAmounts[i] + prev_amount;
                    }

                    prev_amount = amount;
                    monthlyAmounts[i] = amount;                
                    start++;
                }
            }

            var jobs_data = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Income',
                    backgroundColor: 'rgb(220, 53, 69 ,0.79)',
                    borderColor: 'rgb(220, 53, 69 ,0.79)',
                    data: monthlyAmounts
                }]
            };
            $('#IncomeGraphLoader').hide()

            const IncomeThumbnailGraph = new Chart($('#IncomeThumbnailGraph'), {
                type: 'bar',
                data: jobs_data,
                options: {
                    responsive: true,
                    plugins: {                
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    const amount = tooltipItem.raw; 
                                    return `$ ${amount.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                                }
                            }
                        },
                        legend: {
                            position: 'bottom',                    
                        },
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: 10,
                            ticks: {
                                callback: function(value) {
                                    return `$ ${value.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                                }
                            }
                        },
                    },
                    aspectRatio: 1.5,
                }
            });

            window.IncomeThumbnailGraph = IncomeThumbnailGraph;
        }).catch((error) => {
        console.log(error);
    })
}

jobsGraphThumbnail();

function jobsGraphThumbnail() {
    fetch('<?php echo base_url('Dashboard/jobs_thumbnail_graph'); ?>', {}).then(response => response.json()).then(
        response => {
            var monthlyAmounts = new Array(12).fill(0);

            var {
                success,
                jobs,
                total_jobs
            } = response;


            if (jobs) {
                $('.jobs_count_thumbnail').html(total_jobs);

                for (var x = 0; x < jobs.length; x++) {
                    var date_created = jobs[x].date_created;
                    if (date_created) {
                        var due = new Date(date_created);
                        var month = due.getMonth();

                        monthlyAmounts[month] += 1;
                    }
                }
            }

            var jobs_data = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'jobs',
                    backgroundColor: 'rgb(220, 53, 69 ,0.79)',
                    borderColor: 'rgb(220, 53, 69 ,0.79)',
                    data: monthlyAmounts
                }]
            };
            $('#JobsGraphLoader').hide()

            const JobsThumbnailGraph = new Chart($('#JobsThumbnailGraph'), {
                type: 'bar',
                data: jobs_data,
                options: {
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: 10
                        },
                    },
                    aspectRatio: 1.2,
                },
            });

            window.JobsThumbnailGraph = JobsThumbnailGraph;
        }).catch((error) => {
        console.log(error);
    })

}

unpaidInvoicesGraphThumbnail();

function unpaidInvoicesGraphThumbnail() {
    fetch('<?php echo base_url('Dashboard/unpaid_invoices_graph'); ?>', {}).then(response => response.json()).then(
        response => {
            var currentDate    = new Date();
            var month_index    = currentDate.getMonth() + 1;
            var monthlyAmounts = new Array(month_index).fill(0);

            var {
                success,
                unpaid_invoices
            } = response;

            if (unpaid_invoices) {
                for (var x = 0; x < unpaid_invoices.length; x++) {
                    var dateCreated = new Date(unpaid_invoices[x].date_created);
                    if( dateCreated.getFullYear() < currentDate.getFullYear() ){    
                        var dueDate = '2024-01-01';
                    }else if( dateCreated > currentDate ){        
                        var dueDate = moment(currentDate).format('YYYY-MM-DD');
                    }else{
                        var dueDate = unpaid_invoices[x].date_created;
                    }

                    var dueDate = unpaid_invoices[x].date_created;
                    var total_amount_paid = unpaid_invoices[x].total_amount_paid ? unpaid_invoices[x]
                        .total_amount_paid : 0
                    if (dueDate) {
                        var due = new Date(dueDate);
                        var month = due.getMonth();
                        monthlyAmounts[month] += parseFloat(unpaid_invoices[x].grand_total - total_amount_paid);
                    }

                    var start = 0;
                    var prev_amount = 0;
                    for (i = 0; i < monthlyAmounts.length; ++i) {
                        if( start == 0 ){
                            var amount = monthlyAmounts[i];
                        }else{
                            var amount = monthlyAmounts[i] + prev_amount;
                        }

                        prev_amount = amount;
                        monthlyAmounts[i] = amount;                
                        start++;
                    }
                }
            }

            var unpaid_graph_data = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Unpaid Invoices',
                    backgroundColor: 'rgb(106, 74, 134)',
                    borderColor: 'rgb(106, 74, 134)',
                    data: monthlyAmounts
                }]
            };
            $('#UnpaidInvoicesGraphLoader').hide()

            const UnpaidInvoicesWidgetsGraph = new Chart($('#UnpaidInvoicesWidgetsGraph'), {
                type: 'line',
                data: unpaid_graph_data,
                options: {
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    const amount = tooltipItem.formattedValue;
                                    return '$' + amount.toLocaleString(undefined, {minimumFractionDigits: 2});
                                }
                            }
                        },                        
                        legend: {
                            position: 'bottom',
                        },
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: 10,
                            ticks: {
                                callback: function(value, index, values) {
                                    return '$' + value.toLocaleString(undefined, {minimumFractionDigits: 2});
                                }
                            }
                        },
                    },
                    aspectRatio: 1.2,
                },
            });

            window.UnpaidInvoicesWidgetsGraph = UnpaidInvoicesWidgetsGraph;
        }).catch((error) => {
        console.log(error);
    })
}


newLeadsGraphThumbnail();

function newLeadsGraphThumbnail() {

    fetch('<?php echo base_url('Dashboard/leads_graph'); ?>', {}).then(response => response.json()).then(
        response => {

            var {
                success,
                leads
            } = response;

            let labelsTemp = [];
            let dataTemp = [];
            let totalLeads = 0;


            if (leads) {
                for (var x = 0; x < leads.length; x++) {
                    labelsTemp.push(leads[x].lead_name)
                    dataTemp.push(leads[x].total_leads)
                    totalLeads += parseInt(leads[x].total_leads)
                }
            }


            var new_leads_data = {
                labels: labelsTemp,
                datasets: [{
                    label: 'Total leads',
                    data: dataTemp,
                    backgroundColor: [
                        'rgb(106 74 134)',
                        'rgb(199 149 28)',
                        'rgb(64 136 84)',
                        'rgb(220 53 69)',
                        'rgb(206, 128, 255)'
                    ],
                }]
            };

            $('#NewLeadsGraphLoader').hide()


            const NewLeadsWidgetsGraph = new Chart($('#NewLeadsWidgetsGraph'), {
                type: 'doughnut',
                data: new_leads_data,
                options: {
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                boxWidth: 10,
                            }
                        },
                    },
                    layout: {
                        padding: {
                            left: 5,
                            right: 5,
                            top: 0,
                        }
                    },
                },
            });

            $(".total_leads_graph_total").html(totalLeads);
            $("#total_leads_graph").html(totalLeads);




            window.NewLeadsWidgetsGraph = NewLeadsWidgetsGraph;
        }).catch((error) => {
        console.log(error);
    })

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
            //console.log(initialChartData);
            
        }
    });
}

loadCustomerGroupChart();

function loadCustomerGroupChart() {
    fetch('<?php echo base_url('widgets/_load_customer_group_chart'); ?>', {})
        .then(response => response.json())
        .then(data => {
            const chart_labels = data.chart_labels;
            const chart_data = {
                labels: chart_labels,
                datasets: [{
                    data: data.chart_data,
                    backgroundColor: ['#387478','#EFB6C8' ,'#BEAFC2','#FEA303','#629584','#E2F1E7'],
                    borderWidth: 0.5,
                }],
            };

            // Define the center text plugin
            var centerTextPlugin = {
                id: 'centerTextPlugin',
                afterDatasetDraw(chart) {
                    const {ctx , 
                        chartArea: {
                            top,
                            bottom,
                            left,
                            right,
                            width,
                            height
                        }, } = chart;
                    ctx.save();
                    ctx.font = 'bold 16px Arial';
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'top';
                    ctx.fillStyle = '#333';

                    // Calculate total
                    const total = chart.data.datasets[0].data.reduce((a, b) => Number(a) + Number(b), 0) || 0;

                    // Draw "total" on the first line
                    const text1 = 'Total';
                    ctx.fillText(text1, width / 2, height / 2); // Adjust Y for the first line

                    // Draw the total value on the second line
                    const text2 = total;
                    ctx.font = '22px sans-serif'
                    ctx.fillText(text2, width / 2, height / 2 - 25); // Adjust Y for the second line

                    ctx.restore();
                },
            };

            // Render the chart
            var customerGroup = $('#customer_groups_chart');
            var customerGroupChart = new Chart(customerGroup, {
                type: 'doughnut',
                data: chart_data,
                options: {
                    responsive: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        tooltip: {
                            enabled: true,
                        },
                    },
                    aspectRatio: 1,
                },
                plugins: [centerTextPlugin], // Use the correct plugin
            });
        })
        .catch((error) => {
            console.error(error);
        });
}







</script>

<?php include viewPath('v2/includes/footer'); ?>