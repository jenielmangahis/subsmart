<?php if(checkRoleCanAccessModule('activity-logs', 'write')){ ?>
<div class="row">
    <div class="col-12 grid-mb text-end">
        <div class="dropdown d-inline-block">
            <button type="button" class="nsm-button primary" id="btn-empty-archives">Empty Archived</button>
            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                <span id="logs-archive-num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
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
<table class="nsm-table" id="archived-logs">
    <thead>
        <tr>
            <?php if(checkRoleCanAccessModule('activity-logs', 'write')){ ?>
            <td class="table-icon text-center sorting_disabled show">
                <input class="form-check-input table-select" type="checkbox" name="" value="0" id="logs-archive-select-all">
            </td>
            <?php } ?>
            <td class="table-icon show"></td>
            <td class="show" data-name="Name" style="width:40%;">Name</td>                        
            <td class="show" data-name="Action" style="width:5%;"></td>                
        </tr>
    </thead>
    <tbody>
        <?php if ($logs) { ?>
            <?php foreach($logs as $log){ ?>
                <tr>
                    <?php if(checkRoleCanAccessModule('activity-logs', 'write')){ ?>
                    <td class="text-center show">
                        <input class="form-check-input logs-archive-row-select table-select" name="logs[]" type="checkbox" value="<?= $log->id; ?>">
                    </td>
                    <?php } ?>
                    <td class="show"><div class="table-row-icon"><i class="bx bx-box"></i></div></td>
                    <td class="fw-bold nsm-text-primary show">
                        <?= $log->first_name . ' ' . $log->last_name; ?>
                        <br /><small class="text-muted"><?= $log->activity_name; ?></small>
                    </td>
                    <td class="show" style="width:5%;">
                        <?php if(checkRoleCanAccessModule('activity-logs', 'write')){ ?>
                        <div class="dropdown table-management">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item btn-restore-log" data-id="<?= $log->id; ?>" data-name="<?= $log->first_name . ' ' . $log->last_name; ?>" href="javascript:void(0);">Restore</a></li>   
                                <li><a class="dropdown-item btn-permanently-delete-log" data-id="<?= $log->id; ?>" data-name="<?= $log->first_name . ' ' . $log->last_name; ?>" href="javascript:void(0);">Permanently Delete</a></li>   
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
    $("#archived-logs").nsmPagination();

    $(document).on('change', '#logs-archive-select-all', function(){
        $('.logs-archive-row-select:checkbox').prop('checked', this.checked);  
        let total= $('#archived-logs input[name="logs[]"]:checked').length;
        if( total > 0 ){
            $('#logs-archive-num-checked').text(`(${total})`);
        }else{
            $('#logs-archive-num-checked').text('');
        }
    });

    $(document).on('change', '.logs-archive-row-select', function(){
        let total= $('#archived-logs input[name="logs[]"]:checked').length;
        if( total > 0 ){
            $('#logs-archive-num-checked').text(`(${total})`);
        }else{
            $('#logs-archive-num-checked').text('');
        }
    });
});
</script>