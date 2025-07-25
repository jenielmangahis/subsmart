<?php if(checkRoleCanAccessModule('customers', 'write')){ ?>
<div class="row">
    <div class="col-12 grid-mb text-end">
        <div class="dropdown d-inline-block">
            <button type="button" class="nsm-button primary" id="btn-empty-archives">Empty Archived</button>
            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                <span id="customers-archive-num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
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
<table class="nsm-table" id="archived-customers">
    <thead>
        <tr>
            <td class="table-icon text-center sorting_disabled">
                <input class="form-check-input table-select" type="checkbox" name="" value="0" id="customers-archive-select-all">
            </td>
            <td class="table-icon"></td>
            <td data-name="Name">Name</td>
            <td data-name="Name">Date Deleted</td>
            <td data-name="Action" style="width:5%;"></td>                
        </tr>
    </thead>
    <tbody>
        <?php if ($customers) { ?>
            <?php foreach($customers as $customer){ ?>
                <tr>
                    <td class="text-center">
                        <input class="form-check-input customers-archive-row-select table-select" name="customers[]" type="checkbox" value="<?= $customer->prof_id; ?>">
                    </td>
                    <td>
                        <div class="nsm-profile">
                            <?php $initials = ucwords($customer->first_name[0]).ucwords($customer->last_name[0]); ?>
                            <span><?= $initials; ?></span>
                        </div>
                    </td>
                    <td class="nsm-text-primary"><?= $customer->first_name . ' ' . $customer->last_name; ?></td>
                    <td class="nsm-text-primary" style="width:25%;"><?= date("m/d/Y G:i A", strtotime($customer->deleted_at)); ?></td>
                    <td style="width:5%;">
                        <div class="dropdown table-management">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item btn-restore-customer" data-id="<?= $customer->prof_id; ?>" data-name="<?= $customer->first_name . ' ' . $customer->last_name; ?>" href="javascript:void(0);">Restore</a></li>   
                                <li><a class="dropdown-item btn-permanently-delete-customer" data-id="<?= $customer->prof_id; ?>" data-name="<?= $customer->first_name . ' ' . $customer->last_name; ?>" href="javascript:void(0);">Permanently Delete</a></li>  
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
    $("#archived-customers").nsmPagination();

    $(document).on('change', '#customers-archive-select-all', function(){
        $('.customers-archive-row-select:checkbox').prop('checked', this.checked);  
        let total= $('#archived-customers input[name="customers[]"]:checked').length;
        if( total > 0 ){
            $('#customers-archive-num-checked').text(`(${total})`);
        }else{
            $('#customers-archive-num-checked').text('');
        }
    });

    $(document).on('change', '.customers-archive-row-select', function(){
        let total= $('#archived-customers input[name="customers[]"]:checked').length;
        if( total > 0 ){
            $('#customers-archive-num-checked').text(`(${total})`);
        }else{
            $('#customers-archive-num-checked').text('');
        }
    });
});
</script>