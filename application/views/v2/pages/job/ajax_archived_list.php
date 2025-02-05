<table class="nsm-table" id="archived-jobs">
    <thead>
        <tr>
            <td class="table-icon"></td>
            <td data-name="Name">Job Number</td>
            <td data-name="DateArchived">Date Archived</td>
            <td data-name="Action" style="width:5%;"></td>                
        </tr>
    </thead>
    <tbody>
        <?php if ($jobs) { ?>
            <?php foreach($jobs as $job){ ?>
                <tr>
                    <td><div class="table-row-icon"><i class="bx bx-receipt"></i></div></td>
                    <td class="nsm-text-primary"><?= $job->job_number; ?></td>
                    <td class="nsm-text-primary" style="width:25%;"><?= date("m/d/Y G:i A", strtotime($job->archived_date)); ?></td>
                    <td style="width:5%;">
                        <div class="dropdown table-management">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item btn-restore-job" data-id="<?= $job->id; ?>" data-jobnumber="<?= $job->job_number; ?>" href="javascript:void(0);"><i class='bx bx-recycle'></i> Restore</a></li>   
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
    $("#archived-jobs").nsmPagination();
});
</script>