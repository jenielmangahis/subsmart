<style>
.row-numeric{
    text-align:right;
}
</style>
<table class="nsm-table" id="nsm-table-import-invoice">
    <thead>
        <tr>
            <td data-name="ImportWorkorderNumber" class="row-header">Invoice Number</td>
            <td data-name="ImportCustomer" class="row-header">Customer Name</td>
            <td data-name="ImportSubtotal" class="row-header">Status</td>            
            <td data-name="ImportDateCreated" class="row-header">Date Issued</td>
            <td data-name="ImportDateCreated" class="row-header">Due Date</td>
            <td data-name="ImportGrandTotal" class="row-header" style="text-align:right;">Total Amount</td>                        
            <td data-name="ImportAction"></td>
        </tr>
    </thead>
    <tbody>
    <?php if( $invoices ){ ?>
        <?php foreach($invoices as $inv){ ?>
            <tr>
                <td style="width:15%;"><?= $inv->invoice_number; ?></td>
                <td style="width:20%;"><?= $inv->first_name . ' ' . $inv->last_name; ?></td>
                <td style="width:15%;"><?= $inv->status; ?></td>                                
                <td style="width:10%;"><?= date("m/d/Y", strtotime($inv->date_issued)); ?></td>
                <td style="width:10%;"><?= date("m/d/Y", strtotime($inv->due_date)); ?></td>
                <td class="row-numeric">$<?= number_format($inv->grand_total,2,'.',''); ?></td>                
                <td class="row-numeric" style="width:15%;">
                    <button type="button" class="nsm-button primary small import-popover btn-job-import" data-type='invoice' data-id="<?= $inv->id; ?>">
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
    $("#nsm-table-import-invoice").nsmPagination();    

    $('.import-popover').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Use invoice data to create job';
        } 
    });
});
</script>