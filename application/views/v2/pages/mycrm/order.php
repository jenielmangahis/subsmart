<?php include viewPath('v2/includes/header'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/my_crm_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            Listing orders for all your purchases.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search" value="">
                        </div>
                    </div> 
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Order Number" style="width:60%;">Order Number</td>
                            <td data-name="Details">Details</td>
                            <td data-name="Date Added">Date Created</td>
                            <td data-name="Amount">Amount</td>
                            <td data-name="Manage" style="width:3%;"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($payments)) :
                        ?>
                            <?php
                            foreach ($payments as $p) :
                            ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-cart-alt'></i>
                                        </div>
                                    </td>
                                    <td class="nsm-text-primary">
                                        <label class="d-block fw-bold nsm-link default" onclick="location.href='<?= url('mycrm/view_payment/' . $p->id); ?>'"><?= $p->order_number; ?></label>
                                    </td>
                                    <td><?= $p->description; ?></td>
                                    <td><?= date("m/d/Y g:i A", strtotime($p->date_created)); ?></td>
                                    <td style="text-align:right;">$<?= number_format($p->total_amount,2); ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" name="dropdown_link" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" name="dropdown_view" href="<?= base_url("mycrm/view_payment/" . $p->id); ?>">View</a>
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

        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));        
        }, 1000));
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>