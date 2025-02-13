<table class="nsm-table" id="archived-workorders">
    <thead>
        <tr>
            <td class="table-icon"></td>
            <td data-name="Name">Workorder Number</td>
            <td data-name="DateArchived">Date Archived</td>
            <td data-name="Action" style="width:5%;"></td>                
        </tr>
    </thead>
    <tbody>
        <?php if ($workorders) { ?>
            <?php foreach($workorders as $wo){ ?>
                <tr>
                    <td><div class="table-row-icon"><i class="bx bx-receipt"></i></div></td>
                    <td class="nsm-text-primary"><?= $wo->work_order_number; ?></td>
                    <td class="nsm-text-primary" style="width:25%;"><?= date("m/d/Y G:i A", strtotime($wo->date_updated)); ?></td>
                    <td style="width:5%;">
                        <div class="dropdown table-management">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item btn-restore-workorder" data-id="<?= $wo->id; ?>" data-worknumber="<?= $wo->work_order_number; ?>" href="javascript:void(0);"><i class='bx bx-recycle'></i> Restore</a></li>   
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        <?php }else{ ?>
            <tr>
                <td colspan="3">
                    <div class="nsm-empty">
                        <span>No results found</span>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
$(function(){
    $("#archived-workorders").nsmPagination();
});
</script>