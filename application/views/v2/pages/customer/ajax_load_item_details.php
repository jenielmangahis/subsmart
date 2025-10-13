<table class="nsm-table" id="job-items-table" style="font-size:14px;">
    <thead>
        <tr>
            <td data-name="Job Number" class="show">Job</td>
            <td data-name="Item Name" class="show">Item</td>                                    
            <td data-name="Quantity">Quantity</td>
            <td data-name="Amount" class="show" style="text-align:right;">Amount</td>
            <td data-name="Manage" class="show"></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($item_details as $item_detail) { ?>
            <?php if( $item_detail->title != '' ){ ?>
            <tr>
                <td class="fw-bold nsm-text-primary show"><?php echo $item_detail->job_number; ?></td>
                <td class="nsm-text-primary show"><?php echo $item_detail->title; ?></td>                                    
                <td><?php echo $item_detail->qty; ?></td>
                <td class="show" style="text-align:right;">$<?php echo number_format($item_detail->job_item_total_amount,2,".",","); ?></td>
                <td class="show">
                    <a class="nsm-button btn-small" href="<?= base_url('job/edit/'.$item_detail->job_id); ?>" target="_new">
                    <i class='bx bxs-edit'></i>
                    </a>
                </td>
            </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>
<script>
$(function(){
    $("#job-items-table").nsmPagination({
        itemsPerPage: 10,
    });
});
</script>