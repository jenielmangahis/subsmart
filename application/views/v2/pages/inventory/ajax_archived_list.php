<div class="row">
    <div class="col-12 col-md-12 grid-mb text-end">
    <?php if(checkRoleCanAccessModule('invoice', 'delete')){ ?>
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
    <table class="nsm-table archived-items" id="archived-items">
        <thead>
            <tr>
                <?php if(checkRoleCanAccessModule('invoice', 'delete')){ ?>
                <td class="table-icon text-center sorting_disabled">
                    <input class="form-check-input select-all-archived table-select" type="checkbox" name="id_selector" value="0" id="select-all-archived">
                </td>
                <?php } ?>            
                <td data-name="Item">Item</td>
                <td data-name="Model">Model</td>
                <td data-name="Brand">Brand</td>
                <td data-name="Price">Price</td>
                <td data-name="Action" style="width:5%;"></td>                
            </tr>
        </thead>
        <tbody>
            <?php if ($items) { ?>
                <?php foreach($items as $item){ ?>
                    <tr>
                        <td>
                            <input class="form-check-input row-select-archived table-select" name="items[]" type="checkbox" value="<?= $item->id; ?>">
                        </td>
                        <td class="nsm-text-primary"><?= $item->title; ?></td>
                        <td class="nsm-text-primary"><?= $item->model; ?></td>
                        <td class="nsm-text-primary"><?= $item->brand; ?></td>
                        <td class="nsm-text-primary"><?= $item->price; ?></td>
                        <td style="width:5%;">
                            <div class="dropdown table-management">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item btn-restore-item" data-id="<?= $item->id; ?>" data-title="<?= $item->title; ?>" href="javascript:void(0);"><i class='bx bx-recycle'></i> Restore</a></li> 
                                    <li><a class="dropdown-item btn-permanent-delete-item" data-id="<?= $item->id; ?>" data-title="<?= $item->title; ?>" href="javascript:void(0);"><i class='bx bx-trash'></i> Permanent Delete</a></li>     
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            <?php }else{ ?>
                <tr>
                    <td colspan="6">
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
    $("#archived-items").nsmPagination();
});
</script>