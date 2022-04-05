<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_module_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            History of customer purchased items.
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Item Name">Item Name</td>
                            <td data-name="Quantity">Quantity</td>
                            <td data-name="Price">Price</td>
                            <td data-name="Total">Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($inventory)) :
                        ?>
                            <?php
                            foreach ($inventory as $i) :
                            ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-user-pin'></i>
                                        </div>
                                    </td>
                                    <td class="nsm-text-primary" colspan="4">
                                        <label class="nsm-link default d-block fw-bold" onclick="location.href='<?= base_url('job/job_preview/' . $i['job']->id); ?>'"><?= $i['job']->job_number . ' - ' . $i['job']->job_description; ?></label>
                                    </td>
                                </tr>

                                <?php
                                $total_amount = 0;
                                foreach ($i['items'] as $item) :
                                    $total_row_price = $item->price * $item->qty;
                                    $total_amount += $total_row_price;
                                ?>
                                    <tr>
                                        <td>
                                            <div class="table-row-icon">
                                                <i class='bx bx-user-pin'></i>
                                            </div>
                                        </td>
                                        <td class="nsm-text-primary">
                                            <label class="nsm-link default d-block fw-bold"><?= $item->title; ?></label>
                                        </td>
                                        <td><?= $item->qty; ?></td>
                                        <td><?= number_format($item->price, 2); ?></td>
                                        <td><?= number_format($total_row_price, 2); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-user-pin'></i>
                                        </div>
                                    </td>
                                    <td class="nsm-text-primary">
                                        <label class="nsm-link default d-block fw-bold">Total</label>
                                    </td>
                                    <td colspan="3"><?= number_format($total_amount,2); ?></td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="5">
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