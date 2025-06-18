<div class="row">
    <div class="col-12 grid-mb text-end">
        <input type="hidden" id="customer-deal-modal-name" value="" />   
        <div class="dropdown d-inline-block">
            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                <span id="customer-deals-archive-num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end select-filter">                 
                <li><a class="dropdown-item btn-with-selected" id="with-selected-restore" href="javascript:void(0);">Restore</a></li>                                
            </ul>
        </div>
    </div>
</div>
<form id="frm-archive-with-selected">
<table class="nsm-table" id="archived-jobs">
    <thead>
        <tr>
            <td class="table-icon text-center sorting_disabled">
                <input class="form-check-input table-select" type="checkbox" name="" value="0" id="customer-deals-archive-select-all">
            </td>
            <td class="table-icon"></td>
            <td data-name="DealTitle" style="width:40%;">Deal Title</td>
            <td data-name="CustomerName" style="width:20%;">Customer</td>
            <td data-name="ExpectedCloseDate">Expected Close Date</td>
            <td data-name="Action" style="width:5%;"></td>                
        </tr>
    </thead>
    <tbody>
        <?php if ($customerDeals) { ?>
            <?php foreach($customerDeals as $deal){ ?>
                <tr>
                    <td>
                        <input class="form-check-input customer-deals-archive-row-select table-select" name="customerDeals[]" type="checkbox" value="<?= $deal->id; ?>">
                    </td>
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
</form>
<script>
$(function(){
    $("#archived-jobs").nsmPagination();

    $(document).on('change', '#customer-deals-archive-select-all', function(){
        $('.customer-deals-archive-row-select:checkbox').prop('checked', this.checked);  
        let total= $('input[name="customerDeals[]"]:checked').length;
        if( total > 0 ){
            $('#customer-deals-archive-num-checked').text(`(${total})`);
        }else{
            $('#customer-deals-archive-num-checked').text('');
        }
    });

    $(document).on('change', '.customer-deals-archive-row-select', function(){
        let total= $('input[name="customerDeals[]"]:checked').length;
        if( total > 0 ){
            $('#customer-deals-archive-num-checked').text(`(${total})`);
        }else{
            $('#customer-deals-archive-num-checked').text('');
        }
    });
});
</script>