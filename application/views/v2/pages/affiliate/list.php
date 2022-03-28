<?php include viewPath('v2/includes/header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
    <ul class="nsm-fab-options">
        <li onclick="location.href='<?php echo url('affiliate/add') ?>'">
            <div class="nsm-fab-icon">
                <i class="bx bx-mail-send"></i>
            </div>
            <span class="nsm-fab-label">Add New Affiliate</span>
        </li>
        <li>
            <div class="nsm-fab-icon">
                <i class="bx bx-cog"></i>
            </div>
            <span class="nsm-fab-label">Advance Search</span>
        </li>
    </ul>
</div>

<div class="row">
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
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button">
                                <i class='bx bx-fw bx-search'></i> Advance Search
                            </button>
                            <button type="button" class="nsm-button" onclick="location.href='<?php echo url('affiliate/add') ?>'">
                                <i class='bx bx-fw bx-group'></i> Add New Affiliate
                            </button>
                            <button type="button" class="nsm-button">
                                <i class='bx bx-fw bx-import'></i> Import CSV
                            </button>
                            <button type="button" class="nsm-button">
                                <i class='bx bx-fw bx-export'></i> Export CSV
                            </button>
                            <button type="button" class="nsm-button primary">
                                <i class='bx bx-fw bx-printer'></i>
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
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
                                        else :
                                            $badge = '';
                                        endif;
                                        ?>
                                        <span class="nsm-badge <?= $badge ?>"><?php echo $affiliate->status; ?></span>
                                    </td>
                                    <td>
                                        <?php if ($affiliate->portal_access == 1) : ?>
                                            <span class="nsm-badge success">Yes</span>
                                        <?php else : ?>
                                            <span class="nsm-badge">No</span>
                                        <?php endif; ?>
                                    </td>
                                    <td></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('affiliate/edit?id='.$affiliate->id); ?>" data-id="<?php echo $affiliate->id; ?>">Edit</a>
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

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>