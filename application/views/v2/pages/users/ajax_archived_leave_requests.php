<?php if(checkRoleCanAccessModule('user-settings-leave-requests', 'write')){ ?>
<div class="row">
    <div class="col-12 grid-mb text-end">
        <div class="dropdown d-inline-block">
            <button type="button" class="nsm-button primary" id="btn-empty-archives">Empty Archived</button>
            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                <span id="leave-archive-num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
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
<table class="nsm-table" id="archived-leave-requests">
    <thead>
        <tr>
            <?php if(checkRoleCanAccessModule('user-settings-leave-requests', 'write')){ ?>
            <td class="table-icon text-center sorting_disabled show">
                <input class="form-check-input table-select" type="checkbox" name="" value="0" id="leave-archive-select-all">
            </td>
            <?php } ?>
            <td class="table-icon show"></td>
            <td class="show" data-name="UserName" style="width:40%;">Name</td>      
            <td data-name="Leave Type">Leave Type</td>   
            <td data-name="Date From">From</td>
            <td data-name="Date To">To</td>                              
            <td class="show" data-name="Action" style="width:5%;"></td>                
        </tr>
    </thead>
    <tbody>
        <?php if ($leaveRequests) { ?>
            <?php foreach($leaveRequests as $request){ ?>
                <tr>
                    <?php if(checkRoleCanAccessModule('user-settings-leave-requests', 'write')){ ?>
                    <td class="text-center show">
                        <input class="form-check-input leave-archive-row-select table-select" name="requests[]" type="checkbox" value="<?= $request->id; ?>">
                    </td>
                    <?php } ?>
                    <td class="show"><div class="table-row-icon"><i class="bx bx-box"></i></div></td>
                    <td class="fw-bold nsm-text-primary show"><?= $request->employee; ?></td>
                    <td class="fw-bold nsm-text-primary show"><?= $request->leave_type; ?></td>
                    <td class="nsm-text-primary"><?= date("m/d/Y",strtotime($request->date_from)); ?></td>
                    <td class="nsm-text-primary"><?= date("m/d/Y",strtotime($request->date_to)); ?></td>
                    <td class="show" style="width:5%;">
                        <?php if(checkRoleCanAccessModule('user-settings-leave-requests', 'write')){ ?>
                        <div class="dropdown table-management">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item btn-restore-leave-request" data-id="<?= $request->id; ?>" data-name="<?= $request->employee; ?>" href="javascript:void(0);">Restore</a></li>   
                                <li><a class="dropdown-item btn-permanently-delete-leave-request" data-id="<?= $request->id; ?>" data-name="<?= $request->employee; ?>" href="javascript:void(0);">Permanently Delete</a></li>   
                            </ul>
                        </div>
                        <?php } ?>
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
    $("#archived-leave-requests").nsmPagination();

    $(document).on('change', '#leave-archive-select-all', function(){
        $('.leave-archive-row-select:checkbox').prop('checked', this.checked);  
        let total= $('#archived-leave-requests input[name="requests[]"]:checked').length;
        if( total > 0 ){
            $('#leave-archive-num-checked').text(`(${total})`);
        }else{
            $('#leave-archive-num-checked').text('');
        }
    });

    $(document).on('change', '.leave-archive-row-select', function(){
        let total= $('#archived-leave-requests input[name="requests[]"]:checked').length;
        if( total > 0 ){
            $('#leave-archive-num-checked').text(`(${total})`);
        }else{
            $('#leave-archive-num-checked').text('');
        }
    });
});
</script>