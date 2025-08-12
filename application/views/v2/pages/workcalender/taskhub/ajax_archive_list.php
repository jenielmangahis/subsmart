<?php if(checkRoleCanAccessModule('taskhub', 'write')){ ?>
<div class="row">
    <div class="col-12 grid-mb text-end">
        <div class="dropdown d-inline-block">
            <button type="button" class="nsm-button primary" id="btn-empty-archives">Empty Archived</button>
            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                <span id="tasks-archive-num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
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
<table class="nsm-table" id="archived-tasks">
    <thead>
        <tr>
            <td class="table-icon text-center sorting_disabled show">
                <input class="form-check-input table-select" type="checkbox" name="" value="0" id="tasks-archive-select-all">
            </td>
            <td class="table-icon show"></td>
            <td class="show" data-name="UserName" style="width:40%;">Tasks</td>                        
            <td class="show" data-name="Action" style="width:5%;"></td>                
        </tr>
    </thead>
    <tbody>
        <?php if ($tasks) { ?>
            <?php foreach($tasks as $task){ ?>
                <tr>
                    <td class="text-center show">
                        <input class="form-check-input tasks-archive-row-select table-select" name="tasks[]" type="checkbox" value="<?= $task->task_id; ?>">
                    </td>
                    <td class="show"><div class="table-row-icon"><i class="bx bx-box"></i></div></td>
                    <td class="fw-bold nsm-text-primary show"><?= $task->title; ?></td>
                    <td class="show" style="width:5%;">
                        <?php if(checkRoleCanAccessModule('taskhub', 'write')){ ?>
                        <div class="dropdown table-management">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item btn-restore-task" data-id="<?= $task->task_id; ?>" data-name="<?= $task->title; ?>" href="javascript:void(0);">Restore</a></li>   
                                <li><a class="dropdown-item btn-permanently-delete-task" data-id="<?= $task->task_id; ?>" data-name="<?= $task->title; ?>" href="javascript:void(0);">Permanently Delete</a></li>   
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
    $("#archived-tasks").nsmPagination();

    $(document).on('change', '#tasks-archive-select-all', function(){
        $('.tasks-archive-row-select:checkbox').prop('checked', this.checked);  
        let total= $('#archived-tasks input[name="tasks[]"]:checked').length;
        if( total > 0 ){
            $('#tasks-archive-num-checked').text(`(${total})`);
        }else{
            $('#tasks-archive-num-checked').text('');
        }
    });

    $(document).on('change', '.tasks-archive-row-select', function(){
        let total= $('#archived-tasks input[name="tasks[]"]:checked').length;
        if( total > 0 ){
            $('#tasks-archive-num-checked').text(`(${total})`);
        }else{
            $('#tasks-archive-num-checked').text('');
        }
    });
});
</script>