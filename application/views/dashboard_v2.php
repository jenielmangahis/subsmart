<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/dashboard_modals'); ?>
<?php include viewPath('v2/includes/estimate/estimate_modals'); ?>
<?php include viewPath('v2/includes/workorder/workorder_modals'); ?>
<?php include viewPath('v2/widgets/add_widgets'); ?>
<?php include viewPath('v2/includes/calendar/quick_access_calendar_modals'); ?>
<?php include viewPath('v2/includes/calendar/quick_access_calendar_js'); ?>
<?php include viewPath('dashboard_v2_js') ?>


<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>    
    <ul class="nsm-fab-options">
        <li onclick="window.open('<?= base_url('customer/addTicket') ?>', '_blank', 'location=yes,height=1080,width=1280,scrollbars=yes,status=yes');">
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
        <li onclick="window.open('<?= base_url('taskhub/entry') ?>', '_blank', 'location=yes,height=1080,width=1280,scrollbars=yes,status=yes');">
            <div class="nsm-fab-icon">
                <i class="bx bx-task"></i>
            </div>
            <span class="nsm-fab-label">New Task</span>
        </li>
        <li onclick="location.href='<?php echo base_url('customer/add_advance') ?>'">
            <div class="nsm-fab-icon">
                <i class="bx bx-user-plus"></i>
            </div>
            <span class="nsm-fab-label">Add Customer</span>
        </li>
        <li onclick="location.href='<?= base_url('customer') ?>'">
            <div class="nsm-fab-icon">
                <i class="bx bx-search-alt"></i>
            </div>
            <span class="nsm-fab-label">Find Customer</span>
        </li>
        <li onclick="location.href='<?php echo base_url('job/new_job1') ?>'">
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
        <li data-bs-toggle="modal" data-bs-target="#news_letter_modal">
            <div class="nsm-fab-icon">
                <i class="bx bx-news"></i>
            </div>
            <span class="nsm-fab-label">Add Newsletter</span>
        </li>
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
        <button name="button" type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#new_estimate_modal">
            <i class='bx bx-fw bx-chart'></i> Add Estimate
        </button>
        <button name="button" type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#new_workorder_modal">
            <i class='bx bx-fw bx-message-alt-add'></i> Add Workorder
        </button>
        <button name="button"type="button" class="nsm-button btn-add-task">
            <i class='bx bx-fw bx-task'></i> New Task
        </button>
        <button name="button" type="button" class="nsm-button" onclick="location.href='<?php echo base_url('customer/add_advance') ?>'">
            <i class='bx bx-fw bx-user-plus'></i> Add Customer
        </button>
        <button name="button" type="button" class="nsm-button" onclick="location.href='<?= base_url('customer') ?>'">
            <i class='bx bx-fw bx-search-alt'></i> Find Customer
        </button>
        <button name="button" type="button" class="nsm-button"  id="btn-quick-add-job">
            <i class='bx bx-fw bx-message-square-error'></i> Add Job
        </button>
        <button name="button" type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#quick_links_modal">
            <i class='bx bx-fw bx-bookmarks'></i> Quick Links
        </button>
        <button name="button" type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#new_feed_modal">
            <i class='bx bx-fw bx-comment'></i> News Feed
        </button>
        <button name="button" type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#news_letter_modal">
            <i class='bx bx-fw bx-news'></i> Add Newsletter
        </button>
        <button name="button" type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#manage_widgets_modal">
            <i class='bx bx-fw bx-cog'></i>
        </button>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12">
        <?php
        if (count($main_widgets) > 0) :
            echo '<div class="row h-100 g-3 grid-row-mb nsm-draggable-container">';

            foreach ($main_widgets as $wids) :
                if ($wids->wu_is_main) :
                    if($wids->wu_widget_id == 26){
                        echo '<div class="col-12 col-lg-4" id="droppable">';
                        $data['class'] = 'nsm-card nsm-grid large';
                        
                    }else{
                        $data['class'] = 'nsm-card nsm-grid med primary';
                        echo '<div class="col-12 col-lg-4" id="droppable">';
                        
                    }
                    
                    $data['isMain'] = True;
                    $data['id'] = $wids->w_id;
                    $data['isGlobal'] = ($wids->wu_company_id == '0' ? false : true);

                    if($wids->w_name === 'Expense') {
                        $data = set_expense_graph_data($data);
                    }

                    if($wids->w_name === 'Bank') {
                        $data = set_bank_widget_data($data);
                    }
                
                    $this->load->view("v2/" . $wids->w_view_link, $data);
                    
                    echo '</div>';
                endif;
            endforeach;

            echo '</div>';
        endif;
        ?>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12">
        <div class="row h-100 g-3 grid-row-mb nsm-draggable-container" id="nsm_widgets">
            <?php
            foreach ($widgets as $wids) :
                if (!$wids->wu_is_main) :
                    echo '<div class="col-12 col-lg-4">';
                    $data['class'] = 'nsm-card nsm-grid';
                    $data['isMain'] = False;
                    $data['id'] = $wids->w_id;
                    $data['isGlobal'] = ($wids->wu_company_id == '0' ? false : true);

                    if($wids->w_name === 'Expense') {
                        $data = set_expense_graph_data($data);
                    }

                    if($wids->w_name === 'Bank') {
                        $data = set_bank_widget_data($data);
                    }
                    // if($wids->w_view_link != 'widgets/lead_source'){
                    //     $this->load->view("v2/" . $wids->w_view_link, $data);
                    // }
                    $this->load->view("v2/" . $wids->w_view_link, $data);

                    echo '</div>';
                    
                endif;
            endforeach;
            ?>
        </div>
    </div>
</div>

<div class="row nsm-tickertape mb-3 page-content g-0">
    <div class="col-12">
        <div class="nsm-card pb-1 pt-2">
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-tickers.js" async>
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
                            <?php
                            if (count($feeds) > 0) :
                                foreach ($feeds as $feed) :
                            ?>
                                    <div class="widget-item">
                                        <div class="content">
                                            <div class="details">
                                                <span class="content-title mb-1"><?= ucfirst($feed->title) ?></span>
                                                <span class="content-subtitle d-block"><?= ucfirst($feed->message) ?></span>
                                            </div>
                                            <div class="controls"></div>
                                        </div>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            <?php
                            else :
                            ?>
                                <div class="nsm-empty">
                                    <i class='bx bx-meh-blank'></i>
                                    <span>Feed is empty.</span>
                                </div>
                            <?php
                            endif;
                            ?>
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
                            <?php
                            if (count($news) > 0) :
                                foreach ($news as $new) :
                            ?>
                                    <div class="widget-item">
                                        <div class="content">
                                            <div class="details">
                                                <span class="content-title mb-1"><?= ucfirst($new->message) ?></span>
                                                <span class="content-subtitle d-block">
                                                    <a href="<?= base_url('' . $new->file_link) ?>" target="_blank" class="nsm-link"><?= ucfirst($new->file_link) ?></a>
                                                </span>
                                            </div>
                                            <div class="controls"></div>
                                        </div>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            <?php
                            else :
                            ?>
                                <div class="nsm-empty">
                                    <i class='bx bx-meh-blank'></i>
                                    <span>Bulletin is empty.</span>
                                </div>
                                <?php
                            endif;
                                ?>
                                </div>
                        </div>
                    </div>
                </div>
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


<script type="module"  src="<?= base_url("assets/js/dashboard/index.js") ?>"></script>
<?php //include viewPath('tickets/add_modal'); ?>
<?php include viewPath('v2/includes/calendar/quick_access_calendar_js'); ?>
<?php include viewPath('v2/includes/calendar/quick_access_calendar_modals'); ?>
<script>
    $(document).on('click', '#btn-quick-add-service-ticket', function(){
       var url = base_url + "ticket/_quick_add_service_ticket_form";
       var default_date = moment(new Date());
       var date_selected = default_date.format('YYYY-MM-DD');
       calendar_modal_source = 'quick-add-service-ticket';
       $('#modal-quick-add-service-ticket').modal('show');

       showLoader($("#quick-add-service-ticket-form-container"));        

       setTimeout(function () {
         $.ajax({
            type: "GET",
            url: url,
            data: {date_selected:date_selected},
            success: function(o)
            {          
               $("#quick-add-service-ticket-form-container").html(o);
            }
         });
       }, 500); 
    });

    
    $(document).on('click', '#btn-quick-add-job', function(){
        var url = base_url + "job/_quick_add_job_form";
        var default_date = moment(new Date());
        var date_selected = default_date.format('YYYY-MM-DD');        
        calendar_modal_source = 'quick-add-job';
        $('#modal-quick-select-schedule-type').modal('hide');
        $('#modal-quick-add-job').modal('show');

        showLoader($("#quick-add-job-form-container"));        

        setTimeout(function () {
          $.ajax({
             type: "GET",
             url: url,
             data: {date_selected:date_selected},
             success: function(o)
             {          
                $("#quick-add-job-form-container").html(o);
             }
          });
        }, 500);
    });

</script>
<?php include viewPath('v2/includes/footer'); ?>
