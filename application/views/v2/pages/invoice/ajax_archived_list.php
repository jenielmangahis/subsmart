<div class="row">
    <div class="col-12 col-md-12 grid-mb text-end">
    <?php if(checkRoleCanAccessModule('invoices', 'write')){ ?>
        <div class="dropdown d-inline-block">
            <button type="button" class="nsm-button primary" id="btn-empty-invoice-archives">Empty Archived</button>
            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                <span id="num-checked-archived"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
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
    <table class="nsm-table" id="archived-invoices">
        <thead>
            <tr>
                <?php if(checkRoleCanAccessModule('invoices', 'write')){ ?>
                <td class="table-icon text-center sorting_disabled show">
                    <input class="form-check-input table-select" type="checkbox" name="id_selector" value="0" id="select-all-archived">
                </td>
                <?php } ?>            
                <td class="table-icon show"></td>
                <td class="show" data-name="Name" style="width:40%;">Invoice Number</td>
                <td class="show" data-name="Action" style="width:5%;"></td>                
            </tr>
        </thead>
        <tbody>
            <?php if ($invoices) { ?>
                <?php foreach($invoices as $invoice){ ?>
                    <tr>
                        <?php if(checkRoleCanAccessModule('invoices', 'write')){ ?>
                        <td class="text-center show">
                            <input class="form-check-input row-select-archived table-select" name="invoice[]" type="checkbox" value="<?= $invoice->id; ?>">
                        </td>
                        <?php } ?>                     
                        <td class="show"><div class="table-row-icon"><i class="bx bx-receipt"></i></div></td>
                        <td class="fw-bold nsm-text-primary show"><?= $invoice->invoice_number; ?></td>
                        <td class="show" style="width:5%;">
                            <?php if(checkRoleCanAccessModule('invoices', 'write')){ ?>
                            <div class="dropdown table-management">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item btn-restore-invoice" data-id="<?= $invoice->id; ?>" data-invoicenumber="<?= $invoice->invoice_number; ?>" href="javascript:void(0);">Restore</a></li> 
                                    <li><a class="dropdown-item btn-permanent-delete-invoice" data-id="<?= $invoice->id; ?>" data-invoicenumber="<?= $invoice->invoice_number; ?>" href="javascript:void(0);">Permanent Delete</a></li>     
                                </ul>
                            </div>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            <?php }else{ ?>
                <tr>
                    <td colspan="4">
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

    $(document).on('change', '#select-all-archived', function(){
        $('.row-select-archived:checkbox').prop('checked', this.checked);  
        let total= $('#archived-invoices input[name="invoice[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked-archived').text(`(${total})`);
        }else{
            $('#num-checked-archived').text('');
        }
    });

    $(document).on('change', '.row-select-archived', function(){
        let total= $('#archived-invoices input[name="invoice[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked-archived').text(`(${total})`);
        }else{
            $('#num-checked-archived').text('');
        }
    });
});
</script>