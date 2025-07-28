<div class="row">
    <div class="col-12 col-md-12 grid-mb text-end">
    <?php if(checkRoleCanAccessModule('invoice', 'write')){ ?>
        <div class="dropdown d-inline-block">
            <button type="button" class="nsm-button primary" id="btn-empty-invoice-archives">Empty Archived</button>
            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                <span id="num-checked-arhived"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end select-filter"> 
                <li><a class="dropdown-item btn-with-selected" id="with-selected-restore" href="javascript:void(0);" data-action="delete">Restore</a></li> 
                <li><a class="dropdown-item btn-with-selected" id="with-selected-permanent-delete" href="javascript:void(0);" data-action="delete">Permanent Delete</a></li>                              
            </ul>
        </div>   
    <?php } ?>          
    </div>
</div>
<form id="frm-with-selected-archived">
    <table class="nsm-table archived-invoices" id="archived-invoices">
        <thead>
            <tr>
                <?php if(checkRoleCanAccessModule('invoice', 'write')){ ?>
                <td class="table-icon text-center sorting_disabled">
                    <input class="form-check-input select-all-archived table-select" type="checkbox" name="id_selector" value="0" id="select-all-archived">
                </td>
                <?php } ?>            
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
                        <?php if(checkRoleCanAccessModule('invoice', 'write')){ ?>
                        <td>
                            <input class="form-check-input row-select-archived table-select" name="invoice[]" type="checkbox" value="<?= $invoice->id; ?>">
                        </td>
                        <?php } ?>                     
                        <td><div class="table-row-icon"><i class="bx bx-receipt"></i></div></td>
                        <td class="nsm-text-primary"><?= $invoice->invoice_number; ?></td>
                        <td class="nsm-text-primary" style="width:25%;"><?= date("m/d/Y G:i A", strtotime($invoice->date_updated)); ?></td>
                        <td style="width:5%;">
                            <div class="dropdown table-management">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item btn-restore-invoice" data-id="<?= $invoice->id; ?>" data-invoicenumber="<?= $invoice->invoice_number; ?>" href="javascript:void(0);"><i class='bx bx-recycle'></i> Restore</a></li> 
                                    <li><a class="dropdown-item btn-permanent-delete-invoice" data-id="<?= $invoice->id; ?>" data-invoicenumber="<?= $invoice->invoice_number; ?>" href="javascript:void(0);"><i class='bx bx-trash'></i> Permanent Delete</a></li>     
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
</form>
<script>
$(function(){
    $("#archived-invoices").nsmPagination();
});
</script>