<?php include viewPath('v2/includes/header'); ?>
<style>
.box {
    border: 1px solid #dfdfdf;
    padding: 20px;
}
.package-price-original {
    text-decoration: line-through;
}
.text-right{
    text-align: right;
}
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/marketing_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/marketing_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 grid-mb">
                        <div class="nsm-callout primary">Bookings : <?= $dealsSteals->title; ?></div>
                    </div>
                </div>                
                <div class="row">
                    <table class="nsm-table">
                        <thead>
                            <tr>
                                <td class="Date">Date</td>
                                <td data-name="CustomerName">Customer Name</td>
                                <td data-name="DealPrice">Deal Price</td>
                                <td data-name="Manage"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($bookings as $b){ ?>
                            <tr>
                                <td><?= date("d-M-Y H:i", strtotime($b->date_created)); ?></td>
                                <td><?= $b->name; ?></td>
                                <td>$<?= number_format($b->deal_price,2); ?></td>
                                <td>
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" name="dropdown_list" href="<?= base_url('promote/view_booking/' . $b->id); ?>">View</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                          <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/includes/footer'); ?>
<script>
$(function(){
    $(".nsm-table").nsmPagination();
});
</script>