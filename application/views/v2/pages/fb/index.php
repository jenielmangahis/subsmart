<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/estimate/estimate_modals'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('fb/add') ?>'">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('estimate') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Forms" value="<?php echo (!empty($search)) ? $search : '' ?>">
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Sort by All Forms</span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" href="javascript:void(0);">All Forms</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);">Uncategorized Forms</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);">Deleted Forms</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);">User Defined Folders</a></li>
                            </ul>
                        </div>
                        
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary"  onclick="location.href='<?= base_url('fb/add') ?>'">
                                <i class='bx bx-fw bx-add-to-queue'></i> Create New Form
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Form Name">Form Name</td>
                            <td data-name="Results">Results</td>
                            <td data-name="Favorite">Favorite</td>
                            <td data-name="Daily Results">Daily Results</td>
                            <td data-name="Modified">Modified</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($estimates)) :
                        ?>
                            <?php
                            foreach ($estimates as $estimate) :
                            ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-add-to-queue'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?php echo $estimate->estimate_number; ?></td>
                                    <td>
                                        <label class="d-block"><?php echo $estimate->job_name; ?></label>
                                        <a class="nsm-link" href="<?php echo base_url('customer/view/' . $estimate->customer_id) ?>">
                                            <?php echo get_customer_by_id($estimate->customer_id)->first_name . ' ' . get_customer_by_id($estimate->customer_id)->last_name ?>
                                        </a>
                                    </td>
                                    <td><?php echo date('M d, Y', strtotime($estimate->estimate_date)) ?></td>
                                    <td><?php echo $estimate->estimate_type; ?></td>
                                    <td><span class="nsm-badge <?= $badge ?>"><?= $estimate->status; ?></span></td>
                                    <td>
                                        <?php
                                        $total1 = $estimate->option1_total + $estimate->option2_total;
                                        $total2 = $estimate->bundle1_total + $estimate->bundle2_total;

                                        if ($estimate->estimate_type == 'Option') {
                                            echo '$ ' . floatval($total1);
                                        } elseif ($estimate->estimate_type == 'Bundle') {
                                            echo '$ ' . floatval($total2);
                                        } else {
                                            echo '$ ' . floatval($estimate->grand_total);
                                        }

                                        ?>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="6">
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