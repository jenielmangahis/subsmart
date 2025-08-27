<?php if(checkRoleCanAccessModule('service-tickets', 'write')){ ?>
<div class="row">
    <div class="col-12 grid-mb text-end">
        <div class="dropdown d-inline-block">
            <button type="button" class="nsm-button primary" id="btn-empty-archives">Empty Archived</button>
            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                <span id="tickets-archive-num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
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
<table class="nsm-table" id="archived-tickets">
    <thead>
        <tr>
            <td class="table-icon text-center sorting_disabled show">
                <input class="form-check-input table-select" type="checkbox" name="" value="0" id="ticket-archive-select-all">
            </td>
            <td class="table-icon show"></td>
            <td class="show" data-name="Name">Service Ticket Number</td>
            <td class="show" data-name="Action" style="width:5%;"></td>                
        </tr>
    </thead>
    <tbody>
        <?php if ($tickets) { ?>
            <?php foreach($tickets as $ticket){ ?>
                <tr>
                    <td class="table-icon text-center sorting_disabled show">
                        <input class="form-check-input ticket-archive-row-select table-select" name="tickets[]" type="checkbox" value="<?= $ticket->id; ?>">
                    </td>
                    <td class="table-icon show"><div class="table-row-icon"><i class="bx bx-receipt"></i></div></td>
                    <td class="nsm-text-primary show"><?= $ticket->ticket_no; ?></td>
                    <td class="show" style="width:5%;">
                        <div class="dropdown table-management">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item btn-restore-ticket" data-id="<?= $ticket->id; ?>" data-name="<?= $ticket->ticket_no; ?>" href="javascript:void(0);">Restore</a></li>   
                                <li><a class="dropdown-item btn-permanently-delete-ticket" data-id="<?= $ticket->id; ?>" data-name="<?= $ticket->ticket_no; ?>" href="javascript:void(0);">Permanently Delete</a></li>  
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
    $("#archived-tickets").nsmPagination();

    $(document).on('change', '#ticket-archive-select-all', function(){
        $('.ticket-archive-row-select:checkbox').prop('checked', this.checked);  
        let total= $('#archived-tickets input[name="tickets[]"]:checked').length;
        if( total > 0 ){
            $('#tickets-archive-num-checked').text(`(${total})`);
        }else{
            $('#tickets-archive-num-checked').text('');
        }
    });

    $(document).on('change', '.ticket-archive-row-select', function(){
        let total= $('#archived-tickets input[name="tickets[]"]:checked').length;
        if( total > 0 ){
            $('#tickets-archive-num-checked').text(`(${total})`);
        }else{
            $('#tickets-archive-num-checked').text('');
        }
    });
});
</script>