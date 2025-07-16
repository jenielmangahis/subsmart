<?php include viewPath('v2/includes/header'); ?>
<style>
#tbl-deals-steals .nsm-badge{
    display:block;
    font-size:14px;
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo url('promote/create_deals') ?>'">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/marketing_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <!-- <button><i class='bx bx-x'></i></button> -->
                            Your items and services offered at very low prices, implying the buyer is getting a great bargain.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter by Status: Active Deals</span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a name="btn_filter" class="dropdown-item" data-id="filter_active" href="javascript:void(0);">Active Deals</a></li>
                                <li><a name="btn_filter" class="dropdown-item" data-id="filter_scheduled" href="javascript:void(0);">Scheduled</a></li>
                                <li><a name="btn_filter" class="dropdown-item" data-id="filter_ended" href="javascript:void(0);">Ended</a></li>
                                <li><a name="btn_filter" class="dropdown-item" data-id="filter_draft" href="javascript:void(0);">Draft</a></li>
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" name="btn_create" class="nsm-button primary" onclick="location.href='<?php echo url('promote/create_deals') ?>'">
                                <i class='bx bx-plus'></i> Add New
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table" id="tbl-deals-steals">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Deal" style="width:60%;">Deal</td>                            
                            <td data-name="Valid" style="width:20%;">Validity</td>
                            <td data-name="Views">Views</td>
                            <td data-name="Status">Status</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody id="deals_container">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        loadDeals();
        let activeTab = '<?= $status_active; ?>';

        $(".select-filter .dropdown-item").on("click", function() {
            let _this = $(this);

            _this.closest(".dropdown").find(".dropdown-toggle span").html("Filter by Status: " + _this.html());

            if (_this.attr("data-id") == "filter_scheduled") {
                loadDeals('<?= $status_scheduled; ?>');
                activeTab = 'scheduled';
            } else if (_this.attr("data-id") == "filter_ended") {
                loadDeals('<?= $status_ended; ?>');
                activeTab = 'closed';
            } else if (_this.attr("data-id") == "filter_draft") {
                loadDeals('<?= $status_draft; ?>');
                activeTab = 'draft';
            } else {
                loadDeals();
                activeTab = '<?= $status_active; ?>';
            }
        });

        $(document).on("click", ".close-item", function() {
            let name = $(this).attr("data-name");
            let id = $(this).attr("data-id");
            let url = "<?php echo base_url(); ?>promote/_close_deal";

            Swal.fire({
                title: 'Close Deal',
                text: "Are you sure you want close this Deal?",
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
                            deal_id: id
                        },
                        dataType: "JSON",
                        success: function(result) {
                            console.log(result);
                            if (result.is_success == 1) {
                                Swal.fire({
                                    title: 'Success',
                                    text: result.msg,
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        loadDeals(activeTab);
                                    }
                                });
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

        $(document).on("click", ".delete-item", function() {
            let name = $(this).attr("data-name");
            let id = $(this).attr("data-id");
            let url = "<?php echo base_url(); ?>promote/_delete_deal";

            Swal.fire({
                title: 'Delete Deal',
                text: "Are you sure you want delete this Deal?",
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
                            deal_id: id
                        },
                        dataType: "JSON",
                        success: function(result) {
                            if (result.is_success == 1) {
                                Swal.fire({
                                    title: 'Good job!',
                                    text: "Data Deleted Successfully!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        loadDeals(activeTab);
                                    }
                                });
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
    });

    function loadDeals(status = '<?= $status_active; ?>') {
        let _container = $("#deals_container");
        let loader = '<tr><td colspan="7"><div class="nsm-loader"><i class="bx bx-loader-alt bx-spin"></i></div></td></tr>';
        let url = base_url + "promote/_load_deals_list/" + status;
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