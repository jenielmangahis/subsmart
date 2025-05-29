<table class="nsm-table" id="archived-jobs">
    <thead>
        <tr>
            <td class="table-icon"></td>
            <td data-name="DealTitle">Deal Title</td>
            <td data-name="CustomerName">Customer</td>
            <td data-name="ExpectedCloseDate">Expected Close Date</td>
            <td data-name="Action" style="width:5%;"></td>                
        </tr>
    </thead>
    <tbody>
        <?php if ($customerDeals) { ?>
            <?php foreach($customerDeals as $deal){ ?>
                <tr>
                    <td><div class="table-row-icon"><i class="bx bx-box"></i></div></td>
                    <td class="nsm-text-primary"><?= $deal->deal_title; ?></td>
                    <td class="nsm-text-primary"><?= $deal->customer_firstname . ' ' . $deal->customer_lastname; ?></td>
                    <td class="nsm-text-primary"><?= date("m/d/Y", strtotime($deal->expected_close_date)); ?></td>
                    <td style="width:5%;">
                        <div class="dropdown table-management">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item btn-restore-customer-deal" data-id="<?= $deal->id; ?>" data-title="<?= $deal->deal_title; ?>" href="javascript:void(0);"><i class='bx bx-recycle'></i> Restore</a></li>   
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        <?php }else{ ?>
            <tr>
                <td colspan="5">
                    <div class="nsm-empty">
                        <span>No results found</span>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
$(function(){
    $("#archived-jobs").nsmPagination();
});
</script>