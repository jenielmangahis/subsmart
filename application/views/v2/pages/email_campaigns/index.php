<?php include viewPath('v2/includes/header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo url('email_campaigns/add_email_blast') ?>'">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row">
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
                                Sort by Status: <span>All</span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" href="javascript:void(0);" data-id="status_all">All</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" data-id="status_active">Active</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" data-id="status_scheduled">Scheduled</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" data-id="status_closed">Closed</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" data-id="status_draft">Draft</a></li>
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" onclick="location.href='<?php echo url('email_campaigns/add_email_blast') ?>'">
                                <i class='bx bx-fw bx-envelope'></i> Create Email Blast
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Campaigns">Campaigns</td>
                            <td data-name="Send To">Send To</td>
                            <td data-name="Sent on">Sent on</td>
                            <td data-name="Status">Status</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody id="sms_blast_container"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        loadEmailBlasts();
        let activeTab = 'all';

        $(".select-filter .dropdown-item").on("click", function() {
            let _this = $(this);

            _this.closest(".dropdown").find(".dropdown-toggle span").html(_this.html());

            switch (_this.attr("data-id")) {
                case "status_active":
                    loadEmailBlasts("<?= $status_active; ?>");
                    activeTab = "1";
                    break;
                case "status_scheduled":
                    loadEmailBlasts("<?= $status_scheduled; ?>");
                    activeTab = "2";
                    break;
                case "status_closed":
                    loadEmailBlasts("<?= $status_closed; ?>");
                    activeTab = "3";
                    break;
                case "status_draft":
                    loadEmailBlasts("<?= $status_draft; ?>");
                    activeTab = "0";
                    break;
                default:
                    activeTab = "all";
                    loadEmailBlasts();
                    break;
            }
        });

        $(document).on("click", ".clone-item", function() {
            let name = $(this).attr("data-name");
            let id = $(this).attr("data-id");
            let url = "<?php echo base_url(); ?>email_campaigns/_clone_campaign";

            Swal.fire({
                title: 'Clone Campaign',
                text: "Are you sure you want clone the campaign " + name + "?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            emailid: id
                        },
                        dataType: "JSON",
                        success: function(result) {
                            if (result.email_id > 1) {
                                location.href = "<?php echo base_url(); ?>email_campaigns/edit_campaign/" + result.email_id;
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
                }
            });
        });

        $(document).on("click", ".close-item", function() {
            let name = $(this).attr("data-name");
            let id = $(this).attr("data-id");
            let url = "<?php echo base_url(); ?>email_campaigns/_close_campaign";

            Swal.fire({
                title: 'Close Campaign',
                text: "Are you sure you want close the campaign " + name + "?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            emailid: id
                        },
                        dataType: "JSON",
                        success: function(result) {
                            if (result.is_success == 1) {
                                Swal.fire({
                                    title: 'Success',
                                    text: result.msg,
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        loadEmailBlasts(activeTab);
                                    }
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: result.msg,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        loadEmailBlasts(activeTab);
                                    }
                                });
                            }
                        },
                    });
                }
            });
        });
    });

    function loadEmailBlasts(status = "all") {
        let _container = $("#sms_blast_container");
        let url = "<?php echo base_url(); ?>email_campaigns/_load_campaigns/" + status;

        _container.html(
            '<tr>' +
            '<td colspan="7">' +
            '<div class="nsm-loader">' +
            '<i class="bx bx-loader-alt bx-spin"></i>' +
            '</div>' +
            '</td>' +
            '</tr>'
        );

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