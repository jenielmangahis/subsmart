<?php if(checkRoleCanAccessModule('accounting-vendors', 'write')){ ?>
<div class="row">
    <div class="col-12 grid-mb text-end">
        <div class="dropdown d-inline-block">
            <button type="button" class="nsm-button primary" id="btn-empty-archives">Empty Archived</button>
            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                <span id="vendors-archive-num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
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
<table class="nsm-table" id="archived-vendors">
    <thead>
        <tr>
            <?php if(checkRoleCanAccessModule('accounting-vendors', 'write')){ ?>
            <td class="table-icon text-center sorting_disabled show">
                <input class="form-check-input table-select" type="checkbox" name="" value="0" id="vendors-archive-select-all">
            </td>
            <?php } ?>
            <td class="table-icon show"></td>
            <td class="show" data-name="Name" style="width:40%;">Name</td>                        
            <td class="show" data-name="Action" style="width:5%;"></td>                
        </tr>
    </thead>
    <tbody>
        <?php if ($vendors) { ?>
            <?php foreach($vendors as $vendor){ ?>
                <tr>
                    <?php if(checkRoleCanAccessModule('accounting-vendors', 'write')){ ?>
                    <td class="text-center show">
                        <input class="form-check-input vendors-archive-row-select table-select" name="vendors[]" type="checkbox" value="<?= $vendor->id; ?>">
                    </td>
                    <?php } ?>
                    <td class="show"><div class="table-row-icon"><i class="bx bx-box"></i></div></td>
                    <td class="fw-bold nsm-text-primary show"><?= $vendor->f_name . ' ' . $vendor->l_name; ?></td>
                    <td class="show" style="width:5%;">
                        <?php if(checkRoleCanAccessModule('accounting-vendors', 'write')){ ?>
                        <div class="dropdown table-management">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item btn-restore-vendor" data-id="<?= $vendor->id; ?>" data-name="<?= $vendor->f_name . ' ' . $vendor->l_name; ?>" href="javascript:void(0);">Restore</a></li>   
                                <li><a class="dropdown-item btn-permanently-delete-vendor" data-id="<?= $vendor->id; ?>" data-name="<?= $vendor->f_name . ' ' . $vendor->l_name; ?>" href="javascript:void(0);">Permanently Delete</a></li>   
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
    $("#archived-vendors").nsmPagination();

    $(document).on('change', '#vendors-archive-select-all', function(){
        $('.vendors-archive-row-select:checkbox').prop('checked', this.checked);  
        let total= $('#archived-vendors input[name="vendors[]"]:checked').length;
        if( total > 0 ){
            $('#vendors-archive-num-checked').text(`(${total})`);
        }else{
            $('#vendors-archive-num-checked').text('');
        }
    });

    $(document).on('change', '.vendors-archive-row-select', function(){
        let total= $('#archived-vendors input[name="vendors[]"]:checked').length;
        if( total > 0 ){
            $('#vendors-archive-num-checked').text(`(${total})`);
        }else{
            $('#vendors-archive-num-checked').text('');
        }
    });
});
</script>