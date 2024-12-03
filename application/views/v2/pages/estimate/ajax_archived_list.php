<table class="nsm-table" id="archived-estimates">
    <thead>
        <tr>
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
                    <td><div class="table-row-icon"><i class="bx bx-receipt"></i></div></td>
                    <td class="nsm-text-primary"><?= $estimate->estimate_number; ?></td>
                    <td class="nsm-text-primary" style="width:25%;"><?= date("m/d/Y G:i A", strtotime($estimate->archived_date)); ?></td>
                    <td style="width:5%;">
                        <div class="dropdown table-management">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item btn-restore-estimate" data-id="<?= $estimate->id; ?>" data-estimatenumber="<?= $estimate->estimate_number; ?>" href="javascript:void(0);"><i class='bx bx-recycle'></i> Restore</a></li>   
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
    $("#archived-estimates").nsmPagination();
});
</script>