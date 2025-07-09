<div class="row">
    <div class="col-12 grid-mb text-end">
        <div class="dropdown d-inline-block">
            <button type="button" class="nsm-button primary" id="btn-empty-archives">Delete All</button>
            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                <span id="users-archive-num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end select-filter">                 
                <li><a class="dropdown-item btn-with-selected" id="with-selected-restore" href="javascript:void(0);">Restore</a></li>                                
                <li><a class="dropdown-item btn-with-selected" id="with-selected-perma-delete" href="javascript:void(0);">Permanently Delete</a></li>                                
            </ul>
        </div>
    </div>
</div>
<form id="frm-archive-with-selected">
<table class="nsm-table" id="archived-users">
    <thead>
        <tr>
            <td class="table-icon text-center sorting_disabled">
                <input class="form-check-input table-select" type="checkbox" name="" value="0" id="users-archive-select-all">
            </td>
            <td class="table-icon"></td>
            <td data-name="UserName" style="width:40%;">Name</td>                        
            <td data-name="Action" style="width:5%;"></td>                
        </tr>
    </thead>
    <tbody>
        <?php if ($users) { ?>
            <?php foreach($users as $user){ ?>
                <tr>
                    <td class="text-center">
                        <input class="form-check-input users-archive-row-select table-select" name="users[]" type="checkbox" value="<?= $user->id; ?>">
                    </td>
                    <td><div class="table-row-icon"><i class="bx bx-box"></i></div></td>
                    <td class="nsm-text-primary"><?= $user->FName . ' ' . $user->LName; ?></td>
                    <td style="width:5%;">
                        <div class="dropdown table-management">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item btn-restore-user" data-id="<?= $user->id; ?>" data-name="<?= $user->FName . ' ' . $user->LName; ?>" href="javascript:void(0);">Restore</a></li>   
                                <li><a class="dropdown-item btn-permanently-delete-user" data-id="<?= $user->id; ?>" data-name="<?= $user->FName . ' ' . $user->LName; ?>" href="javascript:void(0);">Permanently Delete</a></li>   
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

    $(document).on('change', '#users-archive-select-all', function(){
        $('.users-archive-row-select:checkbox').prop('checked', this.checked);  
        let total= $('input[name="users[]"]:checked').length;
        if( total > 0 ){
            $('#users-archive-num-checked').text(`(${total})`);
        }else{
            $('#users-archive-num-checked').text('');
        }
    });

    $(document).on('change', '.users-archive-row-select', function(){
        let total= $('input[name="users[]"]:checked').length;
        if( total > 0 ){
            $('#users-archive-num-checked').text(`(${total})`);
        }else{
            $('#users-archive-num-checked').text('');
        }
    });
});
</script>