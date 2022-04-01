<?php include viewPath('v2/includes/header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo url('sms_campaigns/add_sms_blast') ?>'">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Listing the campaigns that are currently running.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter by Status: All Campaigns</span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" data-id="filter_all" href="javascript:void(0);">All Campaigns</a></li>
                                <li><a class="dropdown-item" data-id="filter_active" href="javascript:void(0);">Active Campaigns</a></li>
                                <li><a class="dropdown-item" data-id="filter_scheduled" href="javascript:void(0);">Scheduled</a></li>
                                <li><a class="dropdown-item" data-id="filter_closed" href="javascript:void(0);">Closed</a></li>
                                <li><a class="dropdown-item" data-id="filter_draft" href="javascript:void(0);">Draft</a></li>
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" onclick="location.href='<?php echo url('sms_campaigns/add_sms_blast') ?>'">
                                <i class='bx bx-fw bx-chat'></i> Create SMS Blast
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Campaign">Campaign</td>
                            <td data-name="Send To">Send To</td>
                            <td data-name="Sent on">Sent on</td>
                            <td data-name="Texts">Texts</td>
                            <td data-name="Status">Status</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody id="sms_blast_container">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        let activeTab = 'all';
        loadSMSBlasts();

        $(".select-filter .dropdown-item").on("click", function() {
            let _this = $(this);

            _this.closest(".dropdown").find(".dropdown-toggle span").html("Filter by Status: " + _this.html());

            if (_this.attr("data-id") == "filter_active") {
                loadSMSBlasts('<?= $status_active; ?>');
                activeTab = 'active';
            } else if (_this.attr("data-id") == "filter_scheduled") {
                loadSMSBlasts('<?= $status_scheduled; ?>');
                activeTab = 'scheduled';
            } else if (_this.attr("data-id") == "filter_closed") {
                loadSMSBlasts('<?= $status_closed; ?>');
                activeTab = 'closed';
            } else if (_this.attr("data-id") == "filter_draft") {
                loadSMSBlasts('<?= $status_draft; ?>');
                activeTab = 'draft';
            } else {
                loadSMSBlasts();
                activeTab = 'all';
            }
        });

        $(document).on("click", ".clone-item", function() {
            let campaign_name = $(this).attr("data-name");
            let campaign_id = $(this).attr("data-id");
            let url = "<?php echo base_url(); ?>sms_campaigns/_clone_campaign";

            Swal.fire({
                title: 'Clone Campaign',
                text: "Are you sure you want clone the campaign " + campaign_name + "?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        smsid: campaign_id
                    },
                    dataType: "JSON",
                    success: function(result) {
                        if (result.sms_id > 1) {
                            location.href = "<?php echo base_url(); ?>sms_campaigns/edit_campaign/" + result.sms_id;
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: result.msg,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            });
                        }
                    },
                });
            });
        });

        $(document).on("click", ".close-item", function() {
            let campaign_name = $(this).attr("data-name");
            let campaign_id = $(this).attr("data-id");
            let url = "<?php echo base_url(); ?>sms_campaigns/_close_campaign";

            Swal.fire({
                title: 'Close Campaign',
                text: "Are you sure you want close the campaign " + campaign_name + "?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        smsid: campaign_id
                    },
                    dataType: "JSON",
                    success: function(result) {
                        if (result.is_success == 1) {
                            Swal.fire({
                                title: 'Information',
                                text: result.msg,
                                icon: 'info',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            });

                            if (activeTab == 'all') {
                                loadSMSBlasts();
                            } else if (activeTab == 'active') {
                                loadSMSBlasts('<?= $status_active; ?>');
                            } else if (activeTab == 'scheduled') {
                                loadSMSBlasts('<?= $status_scheduled; ?>');
                            } else if (activeTab == 'closed') {
                                loadSMSBlasts('<?= $status_closed; ?>');
                            } else if (activeTab == 'draft') {
                                loadSMSBlasts('<?= $status_draft; ?>');
                            }
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: result.msg,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            });
                        }
                    },
                });
            });
        });
    });

    function loadSMSBlasts(status = 'all') {
        let _container = $("#sms_blast_container");
        let loader = '<tr><td colspan="7"><div class="nsm-loader"><i class="bx bx-loader-alt bx-spin"></i></div></td></tr>';
        let url = "<?php echo base_url(); ?>sms_campaigns/_load_campaigns/" + status;
        _container.html(loader);


        $.ajax({
            type: 'POST',
            url: url,
            success: function(result) {
                _container.html(result);
                $(".nsm-table").nsmPagination();
            },
        });
    }
</script>
<?php include viewPath('v2/includes/footer'); ?>