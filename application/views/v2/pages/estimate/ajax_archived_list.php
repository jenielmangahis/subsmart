<?php if(checkRoleCanAccessModule('estimates', 'write')){ ?>
<div class="row">
    <div class="col-12 grid-mb text-end">
        <div class="dropdown d-inline-block">
            <button type="button" class="nsm-button primary" id="btn-empty-archives">Empty Archived</button>
            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                <span id="estimates-archive-num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end select-filter">                 
                <li><a class="dropdown-item btn-with-selected" id="with-selected-restore" href="javascript:void(0);">Restore</a></li>                                
                <li><a class="dropdown-item btn-with-selected" id="with-selected-perma-delete" href="javascript:void(0);">Permanently Delete</a></li>                                
            </ul>
        </div>
    </div>
</div>
<?php } ?>
<form id="frm-archive-with-selected">
<table class="nsm-table" id="archived-estimates">
    <thead>
        <tr>
            <td class="table-icon text-center sorting_disabled">
                <input class="form-check-input table-select" type="checkbox" name="" value="0" id="estimates-archive-select-all">
            </td>
            <td class="table-icon"></td>
            <td data-name="Name">Estimate Number</td>
            <td data-name="DateArchived">Date Archived</td>
            <td data-name="Action" style="width:5%;"></td>                
        </tr>
    </thead>
    <tbody>
        <?php if ($estimates) { ?>
            <?php foreach($estimates as $estimate){ ?>
                <tr>
                    <td class="text-center">
                        <input class="form-check-input estimates-archive-row-select table-select" name="estimates[]" type="checkbox" value="<?= $estimate->id; ?>">
                    </td>
                    <td><div class="table-row-icon"><i class="bx bx-receipt"></i></div></td>
                    <td class="nsm-text-primary"><?= $estimate->estimate_number; ?></td>
                    <td class="nsm-text-primary" style="width:25%;"><?= date("m/d/Y G:i A", strtotime($estimate->archived_date)); ?></td>
                    <td style="width:5%;">
                        <div class="dropdown table-management">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item btn-restore-estimate" data-id="<?= $estimate->id; ?>" data-estimatenumber="<?= $estimate->estimate_number; ?>" href="javascript:void(0);">Restore</a></li>   
                                <li><a class="dropdown-item btn-permanently-delete-estimate" data-id="<?= $estimate->id; ?>" data-estimatenumber="<?= $estimate->estimate_number; ?>" href="javascript:void(0);">Permanently Delete</a></li>   
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
    $("#archived-estimates").nsmPagination();

    $(document).on('change', '#estimates-archive-select-all', function(){
        $('.estimates-archive-row-select:checkbox').prop('checked', this.checked);  
        let total= $('#archived-estimates input[name="estimates[]"]:checked').length;
        if( total > 0 ){
            $('#estimates-archive-num-checked').text(`(${total})`);
        }else{
            $('#estimates-archive-num-checked').text('');
        }
    });

    $(document).on('change', '.estimates-archive-row-select', function(){
        let total= $('#archived-estimates input[name="estimates[]"]:checked').length;
        if( total > 0 ){
            $('#estimates-archive-num-checked').text(`(${total})`);
        }else{
            $('#estimates-archive-num-checked').text('');
        }
    });
});
</script>