<?php if(checkRoleCanAccessModule('events', 'write')){ ?>
<div class="row">
    <div class="col-12 grid-mb text-end">
        <div class="dropdown d-inline-block">
            <button type="button" class="nsm-button primary" id="btn-empty-archives">Empty Archived</button>
            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                <span id="events-archive-num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
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
<table class="nsm-table" id="archived-events w-100">
    <thead>
        <tr>
            <td class="table-icon text-center sorting_disabled show">
                <input class="form-check-input table-select" type="checkbox" name="" value="0" id="events-archive-select-all">
            </td>
            <td class="table-icon"></td>
            <td data-name="EventNumber" style="width:40%;">Event Number</td>                        
            <td data-name="Action" style="width:5%;"></td>                
        </tr>
    </thead>
    <tbody>
        <?php if ($events) { ?>
            <?php foreach($events as $event){ ?>
                <tr>
                    <td class="text-center show">
                        <input class="form-check-input events-archive-row-select table-select" name="events[]" type="checkbox" value="<?= $event->id; ?>">
                    </td>
                    <td class="show"><div class="table-row-icon "><i class="bx bx-box"></i></div></td>
                    <td class="fw-bold nsm-text-primary show"><?= $event->event_number; ?></td>
                    <td class="show" style="width:5%;">
                        <?php if(checkRoleCanAccessModule('events', 'write')){ ?>
                        <div class="dropdown table-management">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item btn-restore-event" data-id="<?= $event->id; ?>" data-number="<?= $event->event_number; ?>" href="javascript:void(0);">Restore</a></li>   
                                <li><a class="dropdown-item btn-permanently-delete-event" data-id="<?= $event->id; ?>" data-number="<?= $event->event_number; ?>" href="javascript:void(0);">Permanently Delete</a></li>   
                            </ul>
                        </div>
                        <?php } ?>
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
    $("#archived-events").nsmPagination();

    $(document).on('change', '#events-archive-select-all', function(){
        $('.events-archive-row-select:checkbox').prop('checked', this.checked);  
        let total= $('#archived-events input[name="events[]"]:checked').length;
        if( total > 0 ){
            $('#events-archive-num-checked').text(`(${total})`);
        }else{
            $('#events-archive-num-checked').text('');
        }
    });

    $(document).on('change', '.events-archive-row-select', function(){
        let total= $('#archived-events input[name="events[]"]:checked').length;
        if( total > 0 ){
            $('#events-archive-num-checked').text(`(${total})`);
        }else{
            $('#events-archive-num-checked').text('');
        }
    });
});
</script>