<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/affiliate/affiliate_modals'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
    <ul class="nsm-fab-options">
        <li data-bs-toggle="modal" data-bs-target="#advance_search_modal">
            <div class="nsm-fab-icon">
                <i class="bx bx-search"></i>
            </div>
            <span class="nsm-fab-label">Advance Search</span>
        </li>
        <li onclick="location.href='<?php echo url('affiliate/add') ?>'">
            <div class="nsm-fab-icon">
                <i class="bx bx-group"></i>
            </div>
            <span class="nsm-fab-label">Add New Affiliate</span>
        </li>
        <li class="btn-import-csv">
            <div class="nsm-fab-icon">
                <i class="bx bx-import"></i>
            </div>
            <span class="nsm-fab-label">Import CSV</span>
        </li>
        <li class="btn-export-csv">
            <div class="nsm-fab-icon">
                <i class="bx bx-export"></i>
            </div>
            <span class="nsm-fab-label">Export CSV</span>
        </li>
        <li data-bs-toggle="modal" data-bs-target="#print_affiliate_modal">
            <div class="nsm-fab-icon">
                <i class="bx bx-printer"></i>
            </div>
            <span class="nsm-fab-label">Print</span>
        </li>
    </ul>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/affiliate_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Affiliates partners are other professionals who refer new leads/clients to you. They are often Mortgage Brokers, Realtors, Auto Dealers, whose business depends upon having clients with good credit. Visit Affiliate Payments to set commission options and record payments for your affiliates. To see an overview of revenue from affiliates on your Affiliates Stats Dashboard.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search Affiliate">
                        </div>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#advance_search_modal">
                                <i class='bx bx-fw bx-search'></i> Advance Search
                            </button>
                            <button type="button" class="nsm-button" onclick="location.href='<?php echo url('affiliate/add') ?>'">
                                <i class='bx bx-fw bx-group'></i> Add New Affiliate
                            </button>
                            <button type="button" class="nsm-button btn-import-csv">
                                <i class='bx bx-fw bx-import'></i> Import CSV
                            </button>
                            <button type="button" class="nsm-button btn-export-csv">
                                <i class='bx bx-fw bx-export'></i> Export CSV
                            </button>
                            <button type="button" class="nsm-button primary"  data-bs-toggle="modal" data-bs-target="#print_affiliate_modal">
                                <i class='bx bx-fw bx-printer'></i>
                            </button>
                        </div>
                    </div>
                </div>
                <form action="<?php echo base_url('affiliate/importAffiliates'); ?>" method="post" id="affiliateImportForm" enctype="multipart/form-data">
                    <input type="file" name="file" id="importAffiliateFile" class="d-none" />
                </form>
                <table class="nsm-table" id="affiliates_table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Affiliate Name">Affiliate Name</td>
                            <td data-name="Company">Company</td>
                            <td data-name="Email">Email</td>
                            <td data-name="Phone">Phone</td>
                            <td data-name="Added">Added</td>
                            <td data-name="Status">Status</td>
                            <td data-name="Portal Access">Portal Access</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($affiliates)) :
                        ?>
                            <?php
                            foreach ($affiliates as $affiliate) :
                            ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-group'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?php echo $affiliate->first_name . ' ' . $affiliate->last_name; ?></td>
                                    <td><?php echo $affiliate->company; ?></td>
                                    <td><?php echo $affiliate->email; ?></td>
                                    <td><?php echo $affiliate->phone; ?></td>
                                    <td><?php echo $affiliate->date_created; ?></td>
                                    <td>
                                        <?php
                                        if ($affiliate->status == 'Active') :
                                            $badge = 'success';
                                            $status = 'Active';
                                        else :
                                            $badge = '';
                                            $status = 'Inactive';
                                        endif;
                                        ?>
                                        <span class="nsm-badge <?= $badge ?>"><?php echo $status; ?></span>
                                    </td>
                                    <td>
                                        <?php if ($affiliate->portal_access == 1) : ?>
                                            <span class="nsm-badge success">Yes</span>
                                        <?php else : ?>
                                            <span class="nsm-badge">No</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('affiliate/edit?id=' . $affiliate->id); ?>" data-id="<?php echo $affiliate->id; ?>">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?php echo $affiliate->id; ?>" data-name="<?php echo $affiliate->first_name . ' ' . $affiliate->last_name; ?>">Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="9">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url("assets/js/v2/printThis.js") ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#affiliates_table").nsmPagination();

        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));
        }, 1000));

        $(".btn-import-csv").on("click", function() {
            $("#importAffiliateFile").click();
        });

        $("#importAffiliateFile").on("change", function() {
            $("#affiliateImportForm").submit();
        });

        $("#btn_print_affiliates").on("click", function(){
            $("#affiliates_table_print").printThis();
        });

        $(".btn-export-csv").on("click", function() {
            let link = document.createElement("a");
            link.href = "<?php echo base_url(); ?>affiliate/exportAffiliates";
            
            document.body.appendChild(link);
            link.click();
        });

        $(document).on("click", ".delete-item", function() {
            let id = $(this).attr('data-id');
            let name = $(this).attr("data-name");

            Swal.fire({
                title: 'Delete Affiliate',
                text: "Are you sure you want to delete this affiliate?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url(); ?>affiliate/delete",
                        data: {
                            aid: id
                        },
                        success: function(result) {
                            Swal.fire({
                                title: 'Good job!',
                                text: "Data Deleted Successfully!",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                        },
                    });
                }
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>