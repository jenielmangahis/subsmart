<style>
.row-numeric{
    text-align:right;
}
</style>
<table class="nsm-table" id="nsm-table-import-workorder">
    <thead>
        <tr>
            <td data-name="ImportWorkorderNumber" class="row-header">Wokorder Number</td>
            <td data-name="ImportCustomer" class="row-header">Customer Name</td>
            <td data-name="ImportSubtotal" class="row-header">Status</td>            
            <td data-name="ImportDateCreated" class="row-header">Date Issued</td>
            <td data-name="ImportGrandTotal" class="row-header" style="text-align:right;">Total Amount</td>                        
            <td data-name="ImportAction"></td>
        </tr>
    </thead>
    <tbody>
    <?php if( $workorders ){ ?>
        <?php foreach($workorders as $wo){ ?>
            <tr>
                <td style="width:15%;"><?= $wo->work_order_number; ?></td>
                <td style="width:35%;"><?= $wo->first_name . ' ' . $wo->last_name; ?></td>
                <td><?= $wo->status; ?></td>                                
                <td style="width:10%;"><?= date("m/d/Y", strtotime($wo->date_created)); ?></td>
                <td class="row-numeric">$<?= number_format($wo->grand_total,2,'.',''); ?></td>                
                <td class="row-numeric" style="width:15%;">
                    <button type="button" class="nsm-button primary small import-popover btn-job-import" data-type='workorder' data-id="<?= $wo->id; ?>">
                        <i class='bx bx-import'></i> Import data
                    </button>
                </td>
            </tr>   
        <?php } ?>
    <?php }else{ ?>
        <tr><td colspan="2">No records found</td></tr>
    <?php } ?>
    </tbody>
</table>
<script>
$(function(){
    $("#nsm-table-import-workorder").nsmPagination();    

    $('.import-popover').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Use workorder data to create job';
        } 
    });
});
</script>