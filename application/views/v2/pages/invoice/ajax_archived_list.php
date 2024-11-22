<table class="nsm-table" id="archived-invoices">
    <thead>
        <tr>
            <td class="table-icon"></td>
            <td data-name="Name">Invoice Number</td>
            <td data-name="Name">Date Deleted</td>
            <td data-name="Action" style="width:5%;"></td>                
        </tr>
    </thead>
    <tbody>
        <?php if ($invoices) { ?>
            <?php foreach($invoices as $invoice){ ?>
                <tr>
                    <td><div class="table-row-icon"><i class="bx bx-receipt"></i></div></td>
                    <td class="nsm-text-primary"><?= $invoice->invoice_number; ?></td>
                    <td class="nsm-text-primary" style="width:25%;"><?= date("m/d/Y G:i A", strtotime($invoice->date_updated)); ?></td>
                    <td style="width:5%;">
                        <div class="dropdown table-management">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item btn-restore-invoice" data-id="<?= $invoice->id; ?>" data-invoicenumber="<?= $invoice->invoice_number; ?>" href="javascript:void(0);"><i class='bx bx-recycle'></i> Restore</a></li>   
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        <?php }else{ ?>
            <tr>
                <td colspan="3">
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
    $("#archived-invoices").nsmPagination();
});
</script>